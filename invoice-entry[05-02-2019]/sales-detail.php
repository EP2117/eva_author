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

											quotation_entry_type_id,
											quotation_entry_transport_amount,
											quotation_entry_gross_amount,
											quotation_entry_tax_per,
											quotation_entry_tax_amount,
											quotation_entry_advance_amount,
											quotation_entry_net_amount
									 FROM 

										quotation_entry

									 LEFT JOIN

										customers

									 ON

										customer_id														=  quotation_entry_customer_id
									LEFT JOIN 
										(SELECT 
											quotation_entry_product_detail_quotation_entry_id, 
											SUM(quotation_entry_product_detail_qty+quotation_entry_product_detail_s_weight_inches) AS qta_qty 
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
											SUM(invoice_entry_product_detail_qty+invoice_entry_product_detail_s_weight_inches) AS inv_qty 
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
				
					$select_invoice_no = "SELECT invoice_entry_no FROM invoice_entry 
											  WHERE invoice_entry_deleted_status =0
											  AND invoice_entry_direct_type =2
											  AND invoice_entry_quotation_entry_id	= '".$record_quotation_entry['quotation_entry_id']."'
											  AND invoice_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
											  AND invoice_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";
			
					$result_invoice_no = mysql_query($select_invoice_no);
					$record_invoice_no = mysql_num_rows($result_invoice_no);	
					$inv_cnt			= $record_invoice_no+1;
		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="quotation_entry_id[]" id="quotation_entry_id<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?php echo $record_quotation_entry['quotation_entry_id']; ?>" />

						<input type="hidden" name="quotation_entry_no" id="quotation_entry_no<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?php echo $record_quotation_entry['quotation_entry_no']; ?>" >

						<input type="hidden" name="quotation_entry_date" id="quotation_entry_date<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=dateGeneralFormatN($record_quotation_entry['quotation_entry_date'])?>" >

						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['customer_name']?>" >
					<input type="hidden" name="advance_amount" id="advance_amount<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['quotation_entry_advance_amount']?>" >
					<input type="hidden" name="gross_amount" id="gross_amount<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['quotation_entry_gross_amount']?>" >
					<input type="hidden" name="transport_amount" id="transport_amount<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['quotation_entry_transport_amount']?>" >
					<input type="hidden" name="tax_per" id="tax_per<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['quotation_entry_tax_per']?>" >
					<input type="hidden" name="tax_amount" id="tax_amount<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['quotation_entry_tax_amount']?>" >
					<input type="hidden" name="net_amount" id="net_amount<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['quotation_entry_net_amount']?>" >
					<input type="hidden" name="quotation_entry_type_id" id="quotation_entry_type_id<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$record_quotation_entry['quotation_entry_type_id']?>" >
					<input type="hidden" name="quotation_entry_inv_cnt" id="quotation_entry_inv_cnt<?php echo $record_quotation_entry['quotation_entry_id'];?>" value="<?=$inv_cnt?>" >
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
											advance_entry_transport_amount,
											advance_entry_net_amount,
											advance_entry_advance_amount,
											advance_entry_type_id,
											advance_entry_gross_amount,
											advance_entry_tax_amount,
											advance_entry_tax_per
	
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
		$record_invoice_no = mysql_num_rows($result_advance_entry);	
		$inv_cnt			= $record_invoice_no+1;
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
					<input type="hidden" name="gross_amount" id="gross_amount<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['advance_entry_gross_amount']?>" >
					<input type="hidden" name="transport_amount" id="transport_amount<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['advance_entry_transport_amount']?>" >
					<input type="hidden" name="tax_per" id="tax_per<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['advance_entry_tax_per']?>" >
					<input type="hidden" name="tax_amount" id="tax_amount<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['advance_entry_tax_amount']?>" >
					<input type="hidden" name="net_amount" id="net_amount<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['advance_entry_net_amount']?>" >
					<input type="hidden" name="advance_entry_type_id" id="advance_entry_type_id<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['advance_entry_type_id']?>" >
					<input type="hidden" name="quotation_entry_type_id" id="quotation_entry_type_id<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$record_advance_entry['advance_entry_type_id']?>" >
					<input type="hidden" name="quotation_entry_inv_cnt" id="quotation_entry_inv_cnt<?php echo $record_advance_entry['advance_entry_id'];?>" value="<?=$inv_cnt?>" >
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