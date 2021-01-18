  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$branch_id					= $_REQUEST['branch_id'];
	$select_delivery_customer		=	"SELECT 
											delivery_customer_id,
											delivery_customer_uniq_id,
											delivery_customer_no,
											delivery_customer_date,
											customer_name,
											delivery_customer_type_id
									 FROM 
										delivery_customer
									 LEFT JOIN
										customers
									 ON
										customer_id													=  delivery_customer_customer_id
									LEFT JOIN 
										(SELECT 
											delivery_customer_product_detail_delivery_customer_id, 
											SUM(delivery_customer_product_detail_qty+delivery_customer_product_detail_s_weight_inches) AS inv_qty 
										FROM 
											delivery_customer_product_details  	
										WHERE 
											delivery_customer_product_detail_deleted_status 				= 0  					
										GROUP BY 
											delivery_customer_product_detail_delivery_customer_id) inv_table 
									ON 
										delivery_customer_product_detail_delivery_customer_id 				= delivery_customer_id
									LEFT JOIN 
											(SELECT 
												gatepass_entry_product_detail_delivery_customer_id	, 
												SUM(gatepass_entry_product_detail_qty) AS del_qty 
											FROM 
												gatepass_entry_product_details  	
											WHERE 
												gatepass_entry_product_detail_deleted_status 				= 0  					
											GROUP BY 
												gatepass_entry_product_detail_delivery_customer_id) del_table 
									ON 
											gatepass_entry_product_detail_delivery_customer_id 				= delivery_customer_id
									 WHERE 
										delivery_customer_deleted_status 									= 	0 											AND
										IFNULL(del_table.del_qty,0) 									< IFNULL(inv_table.inv_qty,0)					AND	
										delivery_customer_branch_id											= 	'".$branch_id."'
									GROUP BY
										delivery_customer_id
									 ORDER BY 
										delivery_customer_no ASC";//exit;

		$result_delivery_customer		= mysql_query($select_delivery_customer);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>Invoice.No</th>

						<th>Date</th>

						<th>Customer Name</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_delivery_customer = mysql_fetch_array($result_delivery_customer)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="delivery_customer_id[]" id="delivery_customer_id<?php echo $record_delivery_customer['delivery_customer_id'];?>" value="<?php echo $record_delivery_customer['delivery_customer_id']; ?>" />
						<input type="hidden" name="delivery_customer_no" id="delivery_customer_no<?php echo $record_delivery_customer['delivery_customer_id'];?>" value="<?php echo $record_delivery_customer['delivery_customer_no']; ?>" >
						<input type="hidden" name="delivery_customer_date" id="delivery_customer_date<?php echo $record_delivery_customer['delivery_customer_id'];?>" value="<?=dateGeneralFormat($record_delivery_customer['delivery_customer_date'])?>" >
						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_delivery_customer['delivery_customer_id'];?>" value="<?=$record_delivery_customer['customer_name']?>" >
						<input type="hidden" name="delivery_customer_type_id" id="delivery_customer_type_id<?php echo $record_delivery_customer['delivery_customer_id'];?>" value="<?=$record_delivery_customer['delivery_customer_type_id']?>" >
						</td>

						<td><?=$record_delivery_customer['delivery_customer_no']?></td>

						<td><?=dateGeneralFormat($record_delivery_customer['delivery_customer_date'])?></td>

						<td><?=$record_delivery_customer['customer_name']?></td>

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