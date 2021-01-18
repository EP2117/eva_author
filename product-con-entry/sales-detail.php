  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$branch_id		= $_REQUEST['branch_id'];

		$select_invoice_entry		=	"SELECT 

											invoiceId,
											invoiceNo,
											pI_invoice_date,
											pI_net_total

									 FROM 

										purchase_invoice

									 WHERE 

										pI_deleted_status 									= 	0 											AND
										pI_branchid											= 	'".$branch_id."'

									GROUP BY
										invoiceId
									 ORDER BY 
										invoiceNo ASC";

		$result_invoice_entry		= mysql_query($select_invoice_entry);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>
						<th>#</th>
						<th>Invoice.No</th>
						<th>Date</th>
					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_invoice_entry = mysql_fetch_array($result_invoice_entry)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="invoice_entry_id[]" id="invoice_entry_id<?php echo $record_invoice_entry['invoiceId'];?>" value="<?php echo $record_invoice_entry['invoiceId']; ?>" />

						<input type="hidden" name="invoice_entry_no" id="invoice_entry_no<?php echo $record_invoice_entry['invoiceId'];?>" value="<?php echo $record_invoice_entry['invoiceNo']; ?>" >

						<input type="hidden" name="invoice_entry_date" id="invoice_entry_date<?php echo $record_invoice_entry['invoiceId'];?>" value="<?=dateGeneralFormat($record_invoice_entry['pI_invoice_date'])?>" >


						</td>

						<td><?=$record_invoice_entry['invoiceNo']?></td>

						<td><?=dateGeneralFormatN($record_invoice_entry['pI_invoice_date'])?></td>

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