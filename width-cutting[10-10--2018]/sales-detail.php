  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$branch_id		= $_REQUEST['branch_id'];

		$select_so_entry		=	"SELECT 
											so_entry_id,
											so_entry_uniq_id,
											so_entry_no,
											so_entry_date,
											customer_name,
											so_entry_so_type,
											so_entry_net_amount,
											so_entry_delivery_by
									 FROM 
										so_entry
									 LEFT JOIN
										customers
									 ON
										customer_id													=  so_entry_customer_id
									 WHERE 
										so_entry_deleted_status 									= 	0 											AND
										so_entry_branch_id											= 	'".$branch_id."'
									GROUP BY
										so_entry_id
									 ORDER BY 
										so_entry_no ASC";

		$result_so_entry		= mysql_query($select_so_entry);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>
						<th>#</th>
						<th>SO.No</th>
						<th>SO Date</th>
						<th>Customer Name</th>
						<th>SO Type</th>
					</tr>
					</thead>
					<tbody >
		<?php
				while ($record_so_entry = mysql_fetch_array($result_so_entry)){
		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="so_entry_id[]" id="so_entry_id<?php echo $record_so_entry['so_entry_id'];?>" value="<?php echo $record_so_entry['so_entry_id']; ?>" />

						<input type="hidden" name="so_entry_no" id="so_entry_no<?php echo $record_so_entry['so_entry_id'];?>" value="<?php echo $record_so_entry['so_entry_no']; ?>" >

						<input type="hidden" name="so_entry_date" id="so_entry_date<?php echo $record_so_entry['so_entry_id'];?>" value="<?=dateGeneralFormat($record_so_entry['so_entry_date'])?>" >

						<input type="hidden" name="customer_name" id="customer_name<?php echo $record_so_entry['so_entry_id'];?>" value="<?=$record_so_entry['customer_name']?>" >

						</td>

						<td><?=$record_so_entry['so_entry_no']?></td>

						<td><?=dateGeneralFormat($record_so_entry['so_entry_date'])?></td>

						<td><?=$record_so_entry['customer_name']?></td>

						<td><?=$arr_so_type[$record_so_entry['so_entry_so_type']]?></td>

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