  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$dmgmsg_Scrp_id = $_GET['dmgmsg_Scrp_id'];
		 $select_damage_entry_product_detail 	= "	SELECT 
		 												damage_entry_id, 
														damage_entry_product_detail_id,
														damage_entry_product_detail_product_id,
														damage_entry_product_detail_width_inches,damage_entry_product_detail_width_mm,
														damage_entry_product_detail_length_feet,damage_entry_product_detail_length_mm,
														damage_entry_product_detail_weight_tone,
														damage_entry_product_detail_weight_kg,
														damage_entry_product_detail_product_thick,
														damage_entry_product_detail_product_type,
														damage_entry_no,
														damage_entry_date,
														product_con_entry_child_product_detail_product_id,
														damage_entry_type_id,
														product_con_entry_child_product_detail_color_id,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														product_code,
														product_name,
														p_uom.product_uom_name as p_uom_name,
														child_uom.product_uom_name as c_uom_name,
														p_clr.product_colour_name as p_colour_name,
														c_clr.product_colour_name as c_colour_name,
														product_con_entry_child_product_detail_width_inches,
														brand_name,
														product_inches_qty,
														product_con_entry_osf_uom_ton
													FROM 
														damage_entry_product_details 
													LEFT JOIN
														damage_entry
													ON
														damage_entry_id											= damage_entry_product_detail_damage_entry_id
													LEFT JOIN 
														products 
													ON 
														product_id 												= damage_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_brand_id	
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= damage_entry_product_detail_product_id	
													LEFT JOIN 
														product_uoms as p_uom
													ON 
														p_uom.product_uom_id 									= product_product_uom_id
													LEFT JOIN 
														product_uoms as  child_uom
													ON 
														child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
													LEFT JOIN 
														product_colours as p_clr 
													ON 
														p_clr.product_colour_id 								= product_product_colour_id
														
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
														
													WHERE 
														damage_entry_product_detail_deleted_status		 	= 0 							AND 
														damage_entry_product_detail_damage_entry_id 			IN(".$dmgmsg_Scrp_id.")";
		$result_damage_entry_product_detail 	= mysql_query($select_damage_entry_product_detail);

  

?>

		<form method="get" name="raw_product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>


				  <th width="5%" >#</th>

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

		while ($record_so_detail = mysql_fetch_array($result_damage_entry_product_detail)){
			  $balance_qty = $record_so_detail['damage_entry_product_detail_weight_tone'] - 0;
					if($record_so_detail['damage_entry_type_id']==1){
						$product_code			= $record_so_detail['product_code'];
						$product_name			= $record_so_detail['product_name'];
						$product_uom_name		= $record_so_detail['p_uom_name'];
						$product_colour_name	= $record_so_detail['p_colour_name'];
						$product_inches_qty		= $record_so_detail['product_inches_qty'];
					}
					else{
						$product_code			= $record_so_detail['product_con_entry_child_product_detail_code'];
						$product_name			= $record_so_detail['product_con_entry_child_product_detail_name'];
						$product_uom_name		= $record_so_detail['c_uom_name'];
						$product_colour_name	= $record_so_detail['c_colour_name'];
						$product_inches_qty		= $record_so_detail['product_con_entry_child_product_detail_width_inches'];
					}
					
?>

			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="damage_entry_product_detail_id[]" id="damage_entry_product_detail_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_id']; ?>" />
				<input type="hidden" name="mas_product_id" id="raw_mas_product_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo$record_so_detail['damage_entry_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $product_code; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $product_uom_name; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $product_colour_name; ?>" >
				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_color_id']; ?>" >
				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['brand_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $arr_thick[$record_so_detail['damage_entry_product_detail_product_thick']]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_product_thick']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_length_feet" id="product_length_feet<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_length_feet']; ?>" />

				
				<input type="hidden" name="product_length_mm" id="product_length_mm<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_length_mm']; ?>" />
				
				
				
				<input type="hidden" name="product_tone" id="product_tone<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_weight_tone']; ?>" />

				<input type="hidden" name="product_kg" id="product_kg<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_weight_kg']; ?>" />
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_type_id']; ?>" />
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_product_type']; ?>" />
				<input type="hidden" name="brand_name" id="brand_name<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['brand_name']; ?>" />
				<input type="hidden" name="osf_uom_ton" id="osf_uom_ton<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_osf_uom_ton']; ?>" />
				</td>
				<td><?=$record_so_detail['damage_entry_no']?></td>
				<td><?=dateGeneralFormatN($record_so_detail['damage_entry_date'])?></td>
				<td><?php echo $product_code; ?></td>
				<td><?php echo $product_name; ?></td>
				<td><?=$product_uom_name?></td>
				<td><?=$record_so_detail['damage_entry_product_detail_weight_tone']?></td>
			</tr>

<?php  } ?>

			</tbody>

		</table>

		</form>
<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$('#product_detail_popup').DataTable( {

					responsive: true

} );

</script>