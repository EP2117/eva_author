  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$branch_id					= $_REQUEST['branch_id'];
	$select_invoice_entry		=	"SELECT 
											invoice_entry_id,
											invoice_entry_uniq_id,
											invoice_entry_no,
											invoice_entry_date,
											customer_name,
											invoice_entry_net_amount,
											invoice_entry_type_id
									 FROM 
										invoice_entry
									 LEFT JOIN
										customers
									 ON
										customer_id													=  invoice_entry_customer_id
									LEFT JOIN 
										(SELECT 
											invoice_entry_product_detail_invoice_entry_id, 
											SUM(invoice_entry_product_detail_qty+invoice_entry_product_detail_s_weight_inches) AS inv_qty 
										FROM 
											invoice_entry_product_details  	
										WHERE 
											invoice_entry_product_detail_deleted_status 				= 0  					
										GROUP BY 
											invoice_entry_product_detail_invoice_entry_id) inv_table 
									ON 
										invoice_entry_product_detail_invoice_entry_id 				= invoice_entry_id
									LEFT JOIN 
											(SELECT 
												delivery_entry_product_detail_invoice_entry_id	, 
												SUM(delivery_entry_product_detail_qty) AS del_qty 
											FROM 
												delivery_entry_product_details  	
											WHERE 
												delivery_entry_product_detail_deleted_status 				= 0  					
											GROUP BY 
												delivery_entry_product_detail_invoice_entry_id) del_table 
									ON 
											delivery_entry_product_detail_invoice_entry_id 	= invoice_entry_id
									 WHERE 
										invoice_entry_deleted_status 									= 	0 											AND
										IFNULL(del_table.del_qty,0) 									< IFNULL(inv_table.inv_qty,0)					AND	
										invoice_entry_branch_id											= 	'".$branch_id."'
									GROUP BY
										invoice_entry_id
									 ORDER BY 
										invoice_entry_no ASC";//exit;

		$result_invoice_entry		= mysql_query($select_invoice_entry);

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

				while ($record_invoice_entry = mysql_fetch_array($result_invoice_entry)){
				$select_invoice_no = "SELECT delivery_entry_no FROM delivery_entry 
										  WHERE delivery_entry_deleted_status =0
										  AND delivery_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
										  AND delivery_entry_invoice_entry_id	= '".$record_invoice_entry['invoice_entry_id']."'
										  AND delivery_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";
		
				$result_invoice_no = mysql_query($select_invoice_no);
				$record_invoice_no = mysql_num_rows($result_invoice_no);	
				$dc_cnt			= $record_invoice_no+1;
		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="invoice_entry_id[]" id="invoice_entry_id<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?php echo $record_invoice_entry['invoice_entry_id']; ?>" />
						<input type="hidden" name="invoice_entry_no" id="invoice_entry_no<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?php echo $record_invoice_entry['invoice_entry_no']; ?>" >
						<input type="hidden" name="invoice_entry_date" id="invoice_entry_date<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?=dateGeneralFormat($record_invoice_entry['invoice_entry_date'])?>" >
						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?=$record_invoice_entry['customer_name']?>" >
						<input type="hidden" name="invoice_entry_type_id" id="invoice_entry_type_id<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?=$record_invoice_entry['invoice_entry_type_id']?>" >
						<input type="hidden" name="invoice_entry_dc_cnt" id="invoice_entry_dc_cnt<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?=$dc_cnt?>" >
						</td>

						<td><?=$record_invoice_entry['invoice_entry_no']?></td>

						<td><?=dateGeneralFormat($record_invoice_entry['invoice_entry_date'])?></td>

						<td><?=$record_invoice_entry['customer_name']?></td>

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