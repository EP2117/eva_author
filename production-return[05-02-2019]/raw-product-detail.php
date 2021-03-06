  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

	$m_id = $_GET['m_id'];
   	if($m_id == '') {
   		$m_id = '""';
   	}
		 $select_production_entry_raw_product_detail 	= "	SELECT production_entry_id, 
														production_entry_raw_product_detail_id,
														production_entry_raw_product_detail_product_id,
														production_entry_raw_product_detail_width_inches,production_entry_raw_product_detail_width_mm,
														production_entry_raw_product_detail_sl_feet,production_entry_raw_product_detail_sl_feet_mm,
														production_entry_raw_product_detail_ton,
														production_entry_raw_product_detail_kg,
														production_entry_raw_product_detail_product_thick,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														brand_name,
														product_colour_name,
														product_uom_name,
														production_entry_raw_product_detail_product_type,
														production_entry_no,
														production_entry_date,
														product_con_entry_child_product_detail_product_id,
														production_entry_type_id,
														production_entry_raw_product_detail_product_colour_id
														 
													FROM 
														production_entry_raw_product_details 
													LEFT JOIN
														production_entry
													ON
														production_entry_id								= production_entry_raw_product_detail_production_entry_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id	= production_entry_raw_product_detail_product_id	
													LEFT JOIN 
														products 
													ON 
														product_id 									= product_con_entry_child_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 									= product_brand_id
													LEFT JOIN 
														product_uoms 
													ON 
														product_uom_id 								= product_con_entry_child_product_detail_uom_id
			
													LEFT JOIN 
			
														product_colours 
													ON 
														product_colour_id 							= production_entry_raw_product_detail_product_colour_id 
														
													WHERE 
														production_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														production_entry_raw_product_detail_production_entry_id 			IN(".$m_id.")";
		$result_production_entry_raw_product_detail 	= mysql_query($select_production_entry_raw_product_detail);

  

?>

		<form method="get" name="raw_product_list_form" id="raw_product_list_form"  >

		<table class="table datatable table-bordered" id="raw_product_detail_popup">

			<thead>

				<tr>


				  <th width="5%" >#<input type="checkbox" name="All_check" id="All_check" class="check_all" onclick="GetCheck()" /></th>

				  <th width="12%" >SO.No</th>

				  <th width="10%" >Date</th>	  

				  <th width="12%" >Code</th>

				  <th width="24%" >Product</th>

				  <th width="10%" >UOM</th>

				  <th width="9%" >Ton </th>
				  </tr>

			</thead>

			<tbody >

<?php

		while ($record_so_detail = mysql_fetch_array($result_production_entry_raw_product_detail)){
			  $balance_qty = $record_so_detail['production_entry_raw_product_detail_ton'] - 0;
					$product_code			= $record_so_detail['product_con_entry_child_product_detail_code'];
					$product_name			= $record_so_detail['product_con_entry_child_product_detail_name'];
					$product_uom_name		= $record_so_detail['product_uom_name'];
					$product_colour_name	= $record_so_detail['product_colour_name'];
?>

			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="production_entry_raw_product_detail_id[]" id="production_entry_raw_product_detail_id<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_id']; ?>"  class="prd_checkbox" />
				<input type="hidden" name="mas_product_id" id="raw_mas_product_id<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_id" id="raw_product_id<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo$record_so_detail['production_entry_raw_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_name" id="raw_product_name<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >
				<input type="hidden" name="product_code" id="raw_product_code<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $product_code; ?>" >
				<input type="hidden" name="product_uom" id="raw_product_uom<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $product_uom_name; ?>" >
				<input type="hidden" name="product_colour_name" id="raw_product_colour_name<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $product_colour_name; ?>" >
				<input type="hidden" name="product_colour_id" id="raw_product_colour_id<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_product_colour_id']; ?>" >
				<input type="hidden" name="product_brand_name" id="raw_product_brand_name<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['brand_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="raw_product_thick_ness<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $arr_thick[$record_so_detail['production_entry_raw_product_detail_product_thick']]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_product_thick']; ?>" >
				<input type="hidden" name="product_id" id="raw_product_id<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_width_inches" id="raw_product_width_inches<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="raw_product_width_mm<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="raw_product_sl_feet<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_sl_feet']; ?>" />

				
				<input type="hidden" name="product_sl_feet_mm" id="raw_product_sl_feet_mm<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_sl_feet_mm']; ?>" />
				
				
				
				<input type="hidden" name="raw_product_ton" id="raw_product_ton<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_ton']; ?>" />

				<input type="hidden" name="product_kg" id="raw_product_kg<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_kg']; ?>" />
				<input type="hidden" name="product_type_id" id="raw_product_type_id<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_type_id']; ?>" />
				<input type="hidden" name="product_type" id="raw_product_type<?php echo $record_so_detail['production_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_raw_product_detail_product_type']; ?>" />
				
				</td>
				<td><?=$record_so_detail['production_entry_no']?></td>
				<td><?=dateGeneralFormatN($record_so_detail['production_entry_date'])?></td>
				<td><?php echo $product_code; ?></td>
				<td><?php echo $product_name; ?></td>
				<td><?=$product_uom_name?></td>
				<td><?=$record_so_detail['production_entry_raw_product_detail_ton']?></td>
			</tr>

<?php  } ?>

			</tbody>

		</table>

		</form>
<!--$select_production_entry_raw_product_detail 	= "	SELECT production_entry_id, 
														production_entry_raw_product_detail_id,
														production_entry_raw_product_detail_product_id,
														production_entry_raw_product_detail_width_inches,production_entry_raw_product_detail_width_mm,
														production_entry_raw_product_detail_sl_feet,production_entry_raw_product_detail_sl_feet_mm,
														production_entry_raw_product_detail_ton,
														production_entry_raw_product_detail_kg,
														production_entry_raw_product_detail_product_thick,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														brand_name,
														product_colour_name,
														product_uom_name,
														production_entry_raw_product_detail_product_type,
														production_entry_no,
														production_entry_date,
														product_con_entry_child_product_detail_product_id,
														production_entry_type_id,
														production_entry_raw_product_detail_product_colour_id
														 
													FROM 
														production_entry_raw_product_details 
													LEFT JOIN
														production_entry
													ON
														production_entry_id								= production_entry_raw_product_detail_production_entry_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id	= production_entry_raw_product_detail_product_id	
													LEFT JOIN 
														products 
													ON 
														product_id 									= product_con_entry_child_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 									= product_brand_id
													LEFT JOIN 
														product_uoms 
													ON 
														product_uom_id 								= product_con_entry_child_product_detail_uom_id
			
													LEFT JOIN 
			
														product_colours 
													ON 
														product_colour_id 							= production_entry_raw_product_detail_product_colour_id 
														
													WHERE 
														production_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														production_entry_raw_product_detail_production_entry_id 			IN(".$m_id.")";-->
<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

function GetCheck(){
	if(document.getElementById('All_check').checked==true){
		$('.prd_checkbox').each(function(){ this.checked = true; });
	}
	else{
		$('.prd_checkbox').each(function(){ this.checked = false; });
	}
}

$('#raw_product_detail_popup').DataTable( {

					responsive: true

} );
</script>