  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$branch_id		= $_REQUEST['branch_id'];

		 $select_production_entry		=	"SELECT 

												production_entry_id,

												production_entry_uniq_id,

												production_entry_no,

												production_entry_date,

												production_entry_type,
												production_entry_type_id,
												customer_name,
													
													grn_entry_gin_entry_id,
													
												    production_order_customer_id,
													
												    gin_entry_production_order_id,
													
												    production_order_no
													

											 FROM 

												production_entry
												
											LEFT JOIN 
												(SELECT 
														production_entry_product_detail_production_entry_id, 
													SUM(production_entry_product_detail_qty+production_entry_product_detail_s_weight_inches) AS inv_qty 
												FROM 
													production_entry_product_details  	
												WHERE 
													production_entry_product_detail_deleted_status 				= 0  					
												GROUP BY 
														production_entry_product_detail_production_entry_id) inv_table 
											ON 
														production_entry_product_detail_production_entry_id 				= production_entry_id
													
											 LEFT JOIN 
												(SELECT prn_entry_product_detail_production_entry_id, 
												SUM(prn_entry_product_detail_qty+prn_entry_product_detail_s_weight_inches) AS pdo_qty FROM prn_entry_product_details
												WHERE prn_entry_product_detail_deleted_status = 0 
												GROUP BY prn_entry_product_detail_production_entry_id) pdo_table ON
												prn_entry_product_detail_production_entry_id =	production_entry_id
												
												LEFT JOIN
													
												grn_entry
												 ON
												grn_entry_id															= production_entry_grn_entry_id
												
												LEFT JOIN
												
												gin_entry
												 ON
												gin_entry_id															= grn_entry_gin_entry_id
												
												LEFT JOIN
													
												production_order
													 ON
												production_order_id															= gin_entry_production_order_id	
														
													
												LEFT JOIN
												customers
												 ON
												customer_id															= production_order_customer_id	

												
											 WHERE 
											 

												production_entry_deleted_status 									= 	0 											AND
												IFNULL(pdo_table.pdo_qty,0) 										< IFNULL(inv_table.inv_qty,0)					AND	

												production_entry_branch_id											= 	'".$branch_id."'

											GROUP BY

												production_entry_id

											 ORDER BY 

												production_entry_no ASC";//exit;

		$result_production_entry		= mysql_query($select_production_entry);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>PDO Entry.No</th>

						<th> Date</th>

						<th>Type</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_production_entry = mysql_fetch_array($result_production_entry)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="production_entry_id[]" id="production_entry_id<?php echo $record_production_entry['production_entry_id'];?>" value="<?php echo $record_production_entry['production_entry_id']; ?>" />

						<input type="hidden" name="production_entry_no" id="production_entry_no<?php echo $record_production_entry['production_entry_id'];?>" value="<?php echo $record_production_entry['production_entry_no']; ?>" >

						<input type="hidden" name="production_entry_date" id="production_entry_date<?php echo $record_production_entry['production_entry_id'];?>" value="<?=dateGeneralFormatN($record_production_entry['production_entry_date'])?>" >

						<input type="hidden" name="production_entry_type" id="production_entry_type<?php echo $record_production_entry['production_entry_id'];?>" value="<?=$arr_producton_type[$record_production_entry['production_entry_type']]?>" >
						<input type="hidden" name="production_entry_type_id" id="production_entry_type_id<?php echo $record_production_entry['production_entry_id'];?>" value="<?php echo $record_production_entry['production_entry_type_id']; ?>" >
						<input type="hidden" name="production_order_no" id="production_order_no<?php echo $record_production_entry['production_entry_id'];?>" value="<?php echo $record_production_entry['production_order_no']; ?>" >
						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_production_entry['production_entry_id'];?>" value="<?php echo $record_production_entry['customer_name']; ?>" >
						</td>

						<td><?=$record_production_entry['production_entry_no']?></td>

						<td><?=dateGeneralFormatN($record_production_entry['production_entry_date'])?></td>

						<td><?=$arr_producton_type[$record_production_entry['production_entry_type']]?></td>

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