  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$branch_id		= $_REQUEST['branch_id'];

	$gin_type		= $_REQUEST['gin_type'];

		   $select_grn_entry		=	"SELECT 
												grn_entry_id,
												grn_entry_uniq_id,
												grn_entry_no,
												grn_entry_date,
												grn_entry_type,
												grn_entry_type_id
											 FROM 
												grn_entry
											 LEFT JOIN 
												(SELECT 
													grn_entry_product_detail_grn_entry_id, 
													SUM(grn_entry_product_detail_qty+grn_entry_product_detail_s_weight_inches) AS prd_qty 
												FROM 
													grn_entry_product_details  	
												WHERE 
													grn_entry_product_detail_deleted_status 					= 0  					
												GROUP BY 
													grn_entry_product_detail_grn_entry_id) prd_table 
											ON 
												grn_entry_product_detail_grn_entry_id					= grn_entry_id	
											LEFT JOIN	
												(SELECT 
													production_entry_product_detail_grn_entry_id, 
													SUM(production_entry_product_detail_qty+production_entry_product_detail_s_weight_inches) AS inv_qty 
												FROM 
													production_entry_product_details  	
												WHERE 
													production_entry_product_detail_deleted_status 						= 0  					
												GROUP BY 
													production_entry_product_detail_grn_entry_id) inv_table 
												ON 
												production_entry_product_detail_grn_entry_id 					= grn_entry_id																				
											WHERE 
												grn_entry_deleted_status 									= 	0 											AND
												IFNULL(inv_table.inv_qty,0) 										< IFNULL(prd_table.prd_qty,0)					AND									
												grn_entry_branch_id											= 	'".$branch_id."'						
											GROUP BY
												grn_entry_id
											 ORDER BY 
												grn_entry_no ASC";
												

		$result_grn_entry		= mysql_query($select_grn_entry);
		//echo $select_grn_entry; exit;
?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>Production.No</th>

						<th> Date</th>

						<th>Type</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_grn_entry = mysql_fetch_array($result_grn_entry)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="grn_entry_id[]" id="grn_entry_id<?php echo $record_grn_entry['grn_entry_id'];?>" value="<?php echo $record_grn_entry['grn_entry_id']; ?>" />

						<input type="hidden" name="grn_entry_no" id="grn_entry_no<?php echo $record_grn_entry['grn_entry_id'];?>" value="<?php echo $record_grn_entry['grn_entry_no']; ?>" >

						<input type="hidden" name="grn_entry_date" id="grn_entry_date<?php echo $record_grn_entry['grn_entry_id'];?>" value="<?=dateGeneralFormat($record_grn_entry['grn_entry_date'])?>" >

						<input type="hidden" name="grn_entry_type" id="grn_entry_type<?php echo $record_grn_entry['grn_entry_id'];?>" value="" >
						<input type="hidden" name="grn_entry_type_id" id="grn_entry_type_id<?php echo $record_grn_entry['grn_entry_id'];?>" value="<?php echo $record_grn_entry['grn_entry_type_id']; ?>" >

						</td>

						<td><?=$record_grn_entry['grn_entry_no']?></td>

						<td><?=dateGeneralFormat($record_grn_entry['grn_entry_date'])?></td>

						<td></td>

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