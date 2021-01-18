  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$branch_id		= $_REQUEST['branch_id'];

		 $select_production_order		=	"SELECT 

													production_order_id,

													production_order_uniq_id,

													production_order_no,

													production_order_date,

													customer_name,
													inv_table.inv_qty as re_qty,
													do_table.do_qty as do_qty

											 FROM 

												production_order

											 LEFT JOIN

												customers

											 ON

												customer_id													=  production_order_customer_id
												
											LEFT JOIN 
												(SELECT 
													production_order_product_detail_production_order_id , 
													SUM(production_order_product_detail_qty) AS inv_qty 
												FROM 
													production_order_product_details  	
												WHERE 
													production_order_product_detail_deleted_status 				= 0  					
												GROUP BY 
													production_order_product_detail_production_order_id ) inv_table 
											ON 
													production_order_product_detail_production_order_id  				= production_order_id
													
											LEFT JOIN 
											(SELECT 
												do_god_entry_product_detail_production_order_id, 
												SUM(do_god_entry_product_detail_qty) AS do_qty 
											FROM 
												do_god_entry_product_details  	
											WHERE 
												do_god_entry_product_detail_deleted_status 				= 0  					
											GROUP BY 
												do_god_entry_product_detail_production_order_id) do_table 
										ON 
											do_god_entry_product_detail_production_order_id 				= production_order_id	

											 WHERE 

												production_order_deleted_status 							= 	0 											AND
												IFNULL(do_table.do_qty,0) 									< IFNULL(inv_table.inv_qty,0)				AND	

												production_order_branch_id									= 	'".$branch_id."'

											GROUP BY

												production_order_id

											 ORDER BY 

												production_order_no ASC";//exit;

		$result_production_order		= mysql_query($select_production_order);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>PO.No</th>

						<th>Date</th>

						<th>Customer Name</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_production_order = mysql_fetch_array($result_production_order)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="production_order_id[]" id="production_order_id<?php echo $record_production_order['production_order_id'];?>" value="<?php echo $record_production_order['production_order_id']; ?>" />

						<input type="hidden" name="production_order_no" id="production_order_no<?php echo $record_production_order['production_order_id'];?>" value="<?php echo $record_production_order['production_order_no']; ?>" >

						<input type="hidden" name="production_order_date" id="production_order_date<?php echo $record_production_order['production_order_id'];?>" value="<?=dateGeneralFormat($record_production_order['production_order_date'])?>" >

						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_production_order['production_order_id'];?>" value="<?=$record_production_order['customer_name']?>" >

						</td>

						<td><?=$record_production_order['production_order_no']?></td>

						<td><?=dateGeneralFormat($record_production_order['production_order_date'])?></td>

						<td><?=$record_production_order['customer_name']?></td>

					</tr>

		<?php  } ?>

					</tbody>

				</table>

		</form>

<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$('#so_detail_popup').DataTable( {

					responsive: true

} );

</script>