  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$branch_id		= $_REQUEST['branch_id'];

		$select_invoice_entry		=	"SELECT 

											invoice_entry_id,

											invoice_entry_uniq_id,

											invoice_entry_no,

											invoice_entry_date,

											customer_name,

											invoice_entry_net_amount

									 FROM 

										invoice_entry

									 LEFT JOIN

										customers

									 ON

										customer_id													=  invoice_entry_customer_id

									 WHERE 

										invoice_entry_deleted_status 									= 	0 											AND
										invoice_entry_type 												= 	1 											AND
										invoice_entry_branch_id											= 	'".$branch_id."'

									GROUP BY

										invoice_entry_id

									 ORDER BY 

										invoice_entry_no ASC";

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

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="invoice_entry_id[]" id="invoice_entry_id<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?php echo $record_invoice_entry['invoice_entry_id']; ?>" />

						<input type="hidden" name="invoice_entry_no" id="invoice_entry_no<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?php echo $record_invoice_entry['invoice_entry_no']; ?>" >

						<input type="hidden" name="invoice_entry_date" id="invoice_entry_date<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?=dateGeneralFormat($record_invoice_entry['invoice_entry_date'])?>" >

						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_invoice_entry['invoice_entry_id'];?>" value="<?=$record_invoice_entry['customer_name']?>" >

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