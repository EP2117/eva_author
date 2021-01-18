  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$branch_id		= $_REQUEST['branch_id'];
	$gin_type		= $_REQUEST['gin_type'];
	 $select_gin_entry		=	"SELECT 
											gin_entry_id,
											gin_entry_uniq_id,
											gin_entry_no,
											gin_entry_date,
											gin_entry_type,
											customer_name,production_order_customer_id,
											gin_entry_production_order_id,production_order_no,
											gin_entry_type_id,production_order_type	
										 FROM 
											gin_entry
										LEFT JOIN 
											(SELECT 
												gin_entry_product_detail_gin_entry_id, 
												SUM(gin_entry_product_detail_qty+gin_entry_product_detail_s_weight_inches) AS prd_qty 
											FROM 
												gin_entry_product_details  	
											WHERE 
												gin_entry_product_detail_deleted_status 					= 0  					
											GROUP BY 
												gin_entry_product_detail_gin_entry_id) prd_table 
										ON 
											gin_entry_product_detail_gin_entry_id					= gin_entry_id	
										LEFT JOIN 
											(SELECT 
												grn_entry_product_detail_gin_entry_id, 
												SUM(grn_entry_product_detail_qty+grn_entry_product_detail_s_weight_inches) AS gin_qty 
											FROM 
												grn_entry_product_details  	
											WHERE 
												grn_entry_product_detail_deleted_status 						= 0  					
											GROUP BY 
												grn_entry_product_detail_gin_entry_id) gin_table 
										ON 
											grn_entry_product_detail_gin_entry_id 						= gin_entry_id		
											
											LEFT JOIN
													
										production_order
										ON
										production_order_id			= gin_entry_production_order_id	
														
										LEFT JOIN
											customers
											 ON
										   customer_id			= production_order_customer_id	
											
											WHERE 
											gin_entry_deleted_status 									= 	0 			AND
											IFNULL(gin_table.gin_qty,0) 	< IFNULL(prd_table.prd_qty,0)				AND									
											gin_entry_branch_id											= 	'".$branch_id."'
										GROUP BY
											gin_entry_id
										ORDER BY 
											gin_entry_no ASC";

	$result_gin_entry		= mysql_query($select_gin_entry);
?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>GIN.No</th>

						<th> Date</th>

						<th>Type</th>
						
						<th>Customer</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_gin_entry = mysql_fetch_array($result_gin_entry)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="gin_entry_id[]" id="gin_entry_id<?php echo $record_gin_entry['gin_entry_id'];?>" value="<?php echo $record_gin_entry['gin_entry_id']; ?>" />

						<input type="hidden" name="gin_entry_no" id="gin_entry_no<?php echo $record_gin_entry['gin_entry_id'];?>" value="<?php echo $record_gin_entry['gin_entry_no']; ?>" >

						<input type="hidden" name="gin_entry_date" id="gin_entry_date<?php echo $record_gin_entry['gin_entry_id'];?>" value="<?=dateGeneralFormat($record_gin_entry['gin_entry_date'])?>" >

						<input type="hidden" name="gin_entry_type" id="gin_entry_type<?php echo $record_gin_entry['gin_entry_id'];?>" value="<?=($record_gin_entry['production_order_type']>0)?$arr_producton_type[$record_gin_entry['production_order_type']]:""?>" >
						<input type="hidden" name="gin_entry_type_id" id="gin_entry_type_id<?php echo $record_gin_entry['gin_entry_id'];?>" value="<?=$record_gin_entry['gin_entry_type_id']?>" >
						<input type="hidden" name="production_order_no" id="production_order_no<?php echo $record_gin_entry['gin_entry_id'];?>" value="<?=$record_gin_entry['production_order_no']?>" >
						
					<input type="hidden" name="customer_name" id="customer_name<?php echo $record_gin_entry['gin_entry_id'];?>" value="<?=$record_gin_entry['customer_name']?>" >
						

						</td>

						<td><?=$record_gin_entry['gin_entry_no']?></td>

						<td><?=dateGeneralFormat($record_gin_entry['gin_entry_date'])?></td>

						<td><?=($record_gin_entry['gin_entry_type_id']>0)?$arrQuotationType[$record_gin_entry['gin_entry_type_id']]:""?></td>
						
						<td><?=$record_gin_entry['customer_name']?></td>

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