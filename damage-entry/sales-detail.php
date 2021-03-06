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
											production_entry_type_id	
										 FROM 
											production_entry
										 LEFT JOIN 
											(SELECT 
												production_entry_dam_product_detail_production_entry_id, 
												SUM(production_entry_dam_product_detail_ton) AS prd_qty 
											FROM 
												production_entry_dam_product_details  	
											WHERE 
												production_entry_dam_product_detail_deleted_status 					= 0  					
											GROUP BY 
												production_entry_dam_product_detail_production_entry_id) prd_table 
										ON 
											production_entry_dam_product_detail_production_entry_id					= production_entry_id																		 										WHERE 
											production_entry_deleted_status 									= 	0 											AND
											production_entry_branch_id											= 	'".$branch_id."'     						
										GROUP BY
											production_entry_id
										ORDER BY 
											production_entry_no ASC";

	$result_production_entry		= mysql_query($select_production_entry);

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

				while ($record_production_entry = mysql_fetch_array($result_production_entry)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="production_entry_id[]" id="production_entry_id<?php echo $record_production_entry['production_entry_id'];?>" value="<?php echo $record_production_entry['production_entry_id']; ?>" />

						<input type="hidden" name="production_entry_no" id="production_entry_no<?php echo $record_production_entry['production_entry_id'];?>" value="<?php echo $record_production_entry['production_entry_no']; ?>" >

						<input type="hidden" name="production_entry_date" id="production_entry_date<?php echo $record_production_entry['production_entry_id'];?>" value="<?=dateGeneralFormat($record_production_entry['production_entry_date'])?>" >

						<input type="hidden" name="production_entry_type" id="production_entry_type<?php echo $record_production_entry['production_entry_id'];?>" value="<?=$arr_producton_type[$record_production_entry['production_entry_type']]?>" >
					<input type="hidden" name="production_entry_type_id" id="production_entry_type_id<?php echo $record_production_entry['production_entry_id'];?>" value="<?=$record_production_entry['production_entry_type_id']?>" >
                    
						</td>

						<td><?=$record_production_entry['production_entry_no']?></td>

						<td><?=dateGeneralFormat($record_production_entry['production_entry_date'])?></td>

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