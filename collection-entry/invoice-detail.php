  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$branch_id			= $_REQUEST['branch_id'];
	$customer_id		= $_REQUEST['customer_id'];
	$m_id = $_GET['m_id'];

	

   	if($m_id == '') {

   		$m_id 		= '""';

   	}

  $select_invoice		=	"SELECT 

										invoice_entry_id,

										invoice_entry_uniq_id,

										invoice_entry_no,

										invoice_entry_date,

										customer_name,

										customer_code, credit_table.credit_amount AS credit_amount,
										invoice_entry_total_amount,

										
										 invoice_entry_net_amount,

										SUM(IFNULL(rcv_table.rcv_amount,0)+IFNULL(credit_table.credit_amount,0)+invoice_entry_advance_amount) as received_amt,
										invoice_entry_customer_id
										

									 FROM 

										invoice_entry

									 LEFT JOIN

										customers

									 ON

										customer_id												= invoice_entry_customer_id

									LEFT JOIN 

										(SELECT 

											collection_entry_detail_invoice_entry_id, 

											SUM(collection_entry_detail_amount+collection_entry_detail_disc_amount) AS rcv_amount 

										FROM 

											collection_entry_details  	

										WHERE 

											collection_entry_detail_deleted_status 				= 0  					

										GROUP BY 

											collection_entry_detail_invoice_entry_id) rcv_table 

									ON 

										collection_entry_detail_invoice_entry_id 				= invoice_entry_id		
										
										
										
										LEFT JOIN 

										(SELECT 

											credit_note_entry_product_detail_invoice_entry_id, 

											SUM(credit_note_entry_product_detail_total) AS credit_amount 

										FROM 

											 credit_note_entry_product_details  	

										WHERE 

											credit_note_entry_product_detail_deleted_status 				= 0  					

										GROUP BY 

											credit_note_entry_product_detail_invoice_entry_id) credit_table 

									ON 

										credit_note_entry_product_detail_invoice_entry_id 				= invoice_entry_id								 
						 

									 WHERE 

										invoice_entry_deleted_status 							= 	0 															AND

										invoice_entry_branch_id									= 	'".$branch_id."'											AND
										invoice_entry_customer_id								= 	'".$customer_id."'											AND
										invoice_entry_id 										NOT IN (".$m_id.") 												AND	

										IFNULL(rcv_table.rcv_amount,0) 							< invoice_entry_total_amount											

									GROUP BY

										invoice_entry_id

								 ORDER BY 

										invoice_entry_no ASC";//exit;

	//echo $select_invoice;exit;

	$result_invoice		= mysql_query($select_invoice);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

		<table class="table datatable table-bordered" id="pr_detail_popup">

			<thead>

			<tr>

				<th>#</th>

				<th>Inv.No</th>

				<th>Date</th>

				<th>Sup Code</th>

				<th>Name</th>

				<th>Invice Amount</th>

				<th>Paid</th>

				<th>Bal</th>

			</tr>

			</thead>

			<tbody >

<?php

		while ($record_invoice = mysql_fetch_array($result_invoice)){

?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" name="invoice_entry_id[]" id="invoice_entry_id<?php echo $record_invoice['invoice_entry_id'];?>" value="<?php echo $record_invoice['invoice_entry_id']; ?>" />
				<input type="hidden" name="invoice_entry_customer_id" id="invoice_entry_customer_id<?php echo $record_invoice['invoice_entry_id'];?>" value="<?php echo $record_invoice['invoice_entry_customer_id']; ?>" />

				<input type="hidden" name="invoice_entry_no" id="invoice_entry_no<?php echo $record_invoice['invoice_entry_id'];?>" value="<?php echo $record_invoice['invoice_entry_no']; ?>" />

				<input type="hidden" name="invoice_entry_date" id="invoice_entry_date<?php echo $record_invoice['invoice_entry_id'];?>" value="<?=dateGeneralFormat($record_invoice['invoice_entry_date'])?>" />

				<input type="hidden" name="invoice_entry_net_amount" id="invoice_entry_net_amount<?php echo $record_invoice['invoice_entry_id'];?>" value="<?php echo $record_invoice['invoice_entry_total_amount']; ?>" >

				<input type="hidden" name="damage_stock_balance_amount" id="damage_stock_balance_amount<?php echo $record_invoice['invoice_entry_id'];?>" value="<?=number_format($record_invoice['invoice_entry_total_amount']-$record_invoice['received_amt'],2,'.','')?>" />

				<input type="hidden" name="received_amt" id="received_amt<?php echo $record_invoice['invoice_entry_id'];?>" value="<?=number_format($record_invoice['received_amt'],2,'.','')?>" />
				

				</td>

				<td><?=$record_invoice['invoice_entry_no']?></td>

				<td><?=dateGeneralFormat($record_invoice['invoice_entry_date'])?></td>

				<td><?=$record_invoice['customer_code']?></td>

				<td><?=$record_invoice['customer_name']?></td>

				<td><?=number_format($record_invoice['invoice_entry_total_amount'],2,'.','')?></td>

				<td><?=number_format($record_invoice['received_amt'],2,'.','')?></td>

				<td><?=number_format($record_invoice['invoice_entry_total_amount']-$record_invoice['received_amt'],2,'.','')?></td>

				

			</tr>

<?php  } ?>

			</tbody>

		</table>

		</form>

<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$('#pr_detail_popup').DataTable( {

					responsive: true

} );

</script>