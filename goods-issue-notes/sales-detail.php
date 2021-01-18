  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');
	$branch_id		= $_REQUEST['branch_id'];
	$gin_type		= $_REQUEST['gin_type'];
	$gin_entry_type_id		= $_REQUEST['gin_entry_type_id'];
	$gin_entry_type		= $_REQUEST['gin_entry_type'];
	if($gin_entry_type==1){
 	$select_production_order		=	"SELECT 
											production_order_id,
											production_order_uniq_id,
											production_order_no,
											production_order_date,
											production_order_type,
											production_order_type_id,
											customer_name	
										 FROM 
											production_order
										 LEFT JOIN
										 	customers
										 ON
										 	customer_id															= production_order_customer_id
										 LEFT JOIN 
											(SELECT 
												production_order_product_detail_production_order_id, 
												SUM(production_order_product_detail_po_qty+production_order_product_detail_s_weight_inches) AS prd_qty 
											FROM 
												production_order_product_details  	
											WHERE 
												production_order_product_detail_deleted_status 					= 0  					
											GROUP BY 
												production_order_product_detail_production_order_id) prd_table 
										ON 
											production_order_product_detail_production_order_id					= production_order_id	
										LEFT JOIN 
											(SELECT 
												gin_entry_product_detail_po_entry_id, 
												SUM(gin_entry_product_detail_qty+gin_entry_product_detail_s_weight_inches) AS gin_qty 
											FROM 
												gin_entry_product_details  	
											WHERE 
												gin_entry_product_detail_deleted_status 						= 0  					
											GROUP BY 
												gin_entry_product_detail_po_entry_id) gin_table 
										ON 
											gin_entry_product_detail_po_entry_id 						= production_order_id																		 										WHERE 
											production_order_deleted_status 							= 	0 											AND
											production_order_process_status 							= 	1											AND
											IFNULL(gin_table.gin_qty,0) 								< IFNULL(prd_table.prd_qty,0)					AND									
											production_order_branch_id									= 	'".$branch_id."' 							AND
											production_order_status ='1' AND 
											production_order_type_id									LIKE '%".$gin_entry_type_id."%'		
										GROUP BY
											production_order_id
										ORDER BY 
											production_order_no ASC";
											
										//	echo $select_production_order;exit;

	$result_production_order		= mysql_query($select_production_order);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>Production.No</th>

						<th> Date</th>

						<th>Type</th>
						<th>Customer</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_production_order = mysql_fetch_array($result_production_order)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="production_order_id[]" id="production_order_id<?php echo $record_production_order['production_order_id'];?>" value="<?php echo $record_production_order['production_order_id']; ?>" />

						<input type="hidden" name="production_order_no" id="production_order_no<?php echo $record_production_order['production_order_id'];?>" value="<?php echo $record_production_order['production_order_no']; ?>" >

						<input type="hidden" name="production_order_date" id="production_order_date<?php echo $record_production_order['production_order_id'];?>" value="<?=dateGeneralFormat($record_production_order['production_order_date'])?>" >

						<input type="hidden" name="production_order_type" id="production_order_type<?php echo $record_production_order['production_order_id'];?>" value="<?=$arr_producton_type[$record_production_order['production_order_type']]?>" >
					<input type="hidden" name="production_order_type_id" id="production_order_type_id<?php echo $record_production_order['production_order_id'];?>" value="<?=$record_production_order['production_order_type_id']?>" >
					<input type="hidden" name="customer_name" id="customer_name<?php echo $record_production_order['production_order_id'];?>" value="<?=$record_production_order['customer_name']?>" >
						</td>

						<td><?=$record_production_order['production_order_no']?></td>

						<td><?=dateGeneralFormat($record_production_order['production_order_date'])?></td>

						<td><?=$arr_producton_type[$record_production_order['production_order_type']]?></td>
						<td><?=$record_production_order['customer_name']?></td>
					</tr>

		<?php  } ?>

					</tbody>

				</table>

		</form>
        <?php }  if($gin_entry_type==2){
 	$select_production_order		=	"SELECT 
											production_order_id,
											production_order_uniq_id,
											production_order_no,
											production_order_date,
											production_order_type,
											production_order_type_id,
											customer_name	
										 FROM 
											production_order
										 LEFT JOIN
										 	customers
										 ON
										 	customer_id															= production_order_customer_id
										 LEFT JOIN 
											(SELECT 
												production_order_product_detail_production_order_id, 
												SUM(production_order_product_detail_po_qty+production_order_product_detail_s_weight_inches) AS prd_qty 
											FROM 
												production_order_product_details  	
											WHERE 
												production_order_product_detail_deleted_status 					= 0  					
											GROUP BY 
												production_order_product_detail_production_order_id) prd_table 
										ON 
											production_order_product_detail_production_order_id					= production_order_id	
										LEFT JOIN 
											(SELECT 
												gin_entry_product_detail_po_entry_id, 
												SUM(gin_entry_product_detail_qty+gin_entry_product_detail_s_weight_inches) AS gin_qty 
											FROM 
												gin_entry_product_details  	
											WHERE 
												gin_entry_product_detail_deleted_status 						= 0  					
											GROUP BY 
												gin_entry_product_detail_po_entry_id) gin_table 
										ON 
											gin_entry_product_detail_po_entry_id 						= production_order_id																		 										WHERE 
											production_order_deleted_status 							= 	0 											AND
											production_order_process_status 							= 	1											AND
											IFNULL(gin_table.gin_qty,0) 								< IFNULL(prd_table.prd_qty,0)					AND									
											production_order_branch_id									= 	'".$branch_id."' 							AND
											production_order_status ='2' AND 
											production_order_type_id									LIKE '%".$gin_entry_type_id."%'		
										GROUP BY
											production_order_id
										ORDER BY 
											production_order_no ASC";
											
										//	echo $select_production_order;exit;

	$result_production_order		= mysql_query($select_production_order);

?>

		<form method="get" name="so_list_form" id="so_list_form"  >

				<table class="table datatable table-bordered" id="so_detail_popup">

					<thead>

					<tr>

						<th>#</th>

						<th>Production.No</th>

						<th> Date</th>

						<th>Type</th>
						<th>Customer</th>

					</tr>

					</thead>

					<tbody >

		<?php

				while ($record_production_order = mysql_fetch_array($result_production_order)){

		?>

					<tr class="odd gradeX">

						<td>

						<input type="radio" name="production_order_id[]" id="production_order_id<?php echo $record_production_order['production_order_id'];?>" value="<?php echo $record_production_order['production_order_id']; ?>" />

						<input type="hidden" name="production_order_no" id="production_order_no<?php echo $record_production_order['production_order_id'];?>" value="<?php echo $record_production_order['production_order_no']; ?>" >

						<input type="hidden" name="production_order_date" id="production_order_date<?php echo $record_production_order['production_order_id'];?>" value="<?=dateGeneralFormat($record_production_order['production_order_date'])?>" >

						<input type="hidden" name="production_order_type" id="production_order_type<?php echo $record_production_order['production_order_id'];?>" value="<?=$arr_producton_type[$record_production_order['production_order_type']]?>" >
					<input type="hidden" name="production_order_type_id" id="production_order_type_id<?php echo $record_production_order['production_order_id'];?>" value="<?=$record_production_order['production_order_type_id']?>" >
					<input type="hidden" name="customer_name" id="customer_name<?php echo $record_production_order['production_order_id'];?>" value="<?=$record_production_order['customer_name']?>" >
						</td>

						<td><?=$record_production_order['production_order_no']?></td>

						<td><?=dateGeneralFormat($record_production_order['production_order_date'])?></td>

						<td><?=$arr_producton_type[$record_production_order['production_order_type']]?></td>
						<td><?=$record_production_order['customer_name']?></td>
					</tr>

		<?php  } ?>

					</tbody>

				</table>

		</form>
        <?php }?>

<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$('#so_detail_popup').DataTable( {

					responsive: true

} );

</script>