  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');
	
	$branch_id		= $_REQUEST['branch_id'];
	$entry_type		= $_REQUEST['entry_type'];
	if($entry_type==1){
		$select_quotation_entry		=	"SELECT 

											quotation_entry_id,

											quotation_entry_uniq_id,

											quotation_entry_no,

											quotation_entry_date,

											customer_name,

											quotation_entry_net_amount,
											quotation_entry_advance_amount

									 FROM 

										quotation_entry

									 LEFT JOIN

										customers

									 ON

										customer_id														=  quotation_entry_customer_id
									LEFT JOIN 
										(SELECT 
											quotation_entry_product_detail_quotation_entry_id, 
											SUM(quotation_entry_product_detail_qty) AS qta_qty 
										FROM 
											quotation_entry_product_details  	
										WHERE 
											quotation_entry_product_detail_deleted_status 				= 0  					
										GROUP BY 
											quotation_entry_product_detail_quotation_entry_id) qta_table 
									ON 
										quotation_entry_product_detail_quotation_entry_id 				= quotation_entry_id	
										
									LEFT JOIN 
										(SELECT 
											invoice_entry_product_detail_quotation_entry_id, 
											SUM(invoice_entry_product_detail_qty) AS inv_qty 
										FROM 
											invoice_entry_product_details  	
										WHERE 
											invoice_entry_product_detail_deleted_status 					= 0  					
										GROUP BY 
											invoice_entry_product_detail_quotation_entry_id) inv_table 
									ON 
										invoice_entry_product_detail_quotation_entry_id 					= quotation_entry_id	
									 WHERE 
										quotation_entry_deleted_status 										= 	0 											AND
										IFNULL(inv_table.inv_qty,0) 										< IFNULL(qta_table.qta_qty,0)					AND									
										quotation_entry_branch_id											= 	'".$branch_id."'

									GROUP BY

										quotation_entry_id

									 ORDER BY 

										quotation_entry_no ASC";

		$result_quotation_entry		= mysql_query($select_quotation_entry);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>Quotation.No</th>

						<th>Date</th>

						<th>Customer Name</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_quotation_entry = mysql_fetch_array($result_quotation_entry)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="quotation_entry_id[]" id="quotation_entry_id<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?php echo $record_quotation_entry['quotation_entry_id']; ?>" />

						<input type="hidden" name="quotation_entry_no" id="quotation_entry_no<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?php echo $record_quotation_entry['quotation_entry_no']; ?>" >

						<input type="hidden" name="quotation_entry_date" id="quotation_entry_date<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=dateGeneralFormatN($record_quotation_entry['quotation_entry_date'])?>" >

						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['customer_name']?>" >
					<input type="hidden" name="advance_amount" id="advance_amount<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['quotation_entry_advance_amount']?>" >

						</td>

						<td><?=$record_quotation_entry['quotation_entry_no']?></td>

						<td><?=dateGeneralFormatN($record_quotation_entry['quotation_entry_date'])?></td>

						<td><?=$record_quotation_entry['customer_name']?></td>

					</tr>

		<?php  } ?>

					</tbody>

				</table>

		</form>
<?php
	}
	else{
$select_advance_entry		=	"SELECT 

											advance_entry_id,

											advance_entry_uniq_id,

											advance_entry_no,

											advance_entry_date,

											customer_name,

											advance_entry_net_amount,
											advance_entry_advance_amount
	
									 FROM 

										advance_entry

									 LEFT JOIN

										customers

									 ON

										customer_id													=  advance_entry_customer_id

									 WHERE 

										advance_entry_deleted_status 									= 	0 											AND

										advance_entry_branch_id											= 	'".$branch_id."'

									GROUP BY

										advance_entry_id

									 ORDER BY 

										advance_entry_no ASC";

		$result_advance_entry		= mysql_query($select_advance_entry);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>Advance.No</th>

						<th>Date</th>

						<th>Customer Name</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_advance_entry = mysql_fetch_array($result_advance_entry)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="quotation_entry_id[]" id="quotation_entry_id<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?php echo $record_advance_entry['advance_entry_id']; ?>" />

						<input type="hidden" name="quotation_entry_no" id="quotation_entry_no<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?php echo $record_advance_entry['advance_entry_no']; ?>" >

						<input type="hidden" name="quotation_entry_date" id="quotation_entry_date<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=dateGeneralFormatN($record_advance_entry['advance_entry_date'])?>" >

						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['customer_name']?>" >
				<input type="hidden" name="advance_amount" id="advance_amount<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['advance_entry_advance_amount']?>" >
						</td>

						<td><?=$record_advance_entry['advance_entry_no']?></td>

						<td><?=dateGeneralFormatN($record_advance_entry['advance_entry_date'])?></td>

						<td><?=$record_advance_entry['customer_name']?></td>

					</tr>

		<?php  } ?>

					</tbody>

				</table>

		</form>
<?php
	}
?>
<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$('#so_detail_popup').DataTable( {

					responsive: true

} );

</script>