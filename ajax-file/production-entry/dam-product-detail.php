  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

	$m_id = $_GET['m_id'];
   	if($m_id == '') {
   		$m_id = '""';
   	}
		 $select_grn_entry_raw_product_detail 	= "	SELECT 
														grn_entry_raw_product_detail_id,
														grn_entry_raw_product_detail_product_id,
														grn_entry_raw_product_detail_width_inches,grn_entry_raw_product_detail_width_mm,
														grn_entry_raw_product_detail_sl_feet,grn_entry_raw_product_detail_sl_feet_mm,
														grn_entry_raw_product_detail_ton,
														grn_entry_raw_product_detail_kg,
														grn_entry_raw_product_detail_product_thick,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														brand_name,
														product_colour_name,
														product_uom_name,
														grn_entry_raw_product_detail_product_type,
														grn_entry_no,
														grn_entry_date,
														product_con_entry_child_product_detail_product_id,
														grn_entry_type_id,
														grn_entry_raw_product_detail_product_colour_id
														 
													FROM 
														grn_entry_raw_product_details 
													LEFT JOIN
														grn_entry
													ON
														grn_entry_id								= grn_entry_raw_product_detail_grn_entry_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id	= grn_entry_raw_product_detail_product_id	
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
														product_colour_id 							= grn_entry_raw_product_detail_product_colour_id 
														
													WHERE 
														grn_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														grn_entry_raw_product_detail_grn_entry_id 			IN(".$m_id.")
													GROUP BY 
													grn_entry_raw_product_detail_id";
		$result_grn_entry_raw_product_detail 	= mysql_query($select_grn_entry_raw_product_detail);

  

?>

		<form method="get" name="dam_product_list_form" id="dam_product_list_form"  >

		<table class="table datatable table-bordered" id="dam_product_detail_popup">

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

		while ($record_so_detail = mysql_fetch_array($result_grn_entry_raw_product_detail)){
			  $balance_qty = $record_so_detail['grn_entry_raw_product_detail_ton'] - 0;
					$product_code			= $record_so_detail['product_con_entry_child_product_detail_code'];
					$product_name			= $record_so_detail['product_con_entry_child_product_detail_name'];
					$product_uom_name		= $record_so_detail['product_uom_name'];
					$product_colour_name	= $record_so_detail['product_colour_name'];
?>

			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="grn_entry_raw_product_detail_id[]" id="grn_entry_raw_product_detail_id<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_id']; ?>" />
				<input type="hidden" name="mas_product_id" id="raw_mas_product_id<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_id" id="dam_product_id<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo$record_so_detail['grn_entry_raw_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_name" id="dam_product_name<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >
				<input type="hidden" name="product_code" id="dam_product_code<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $product_code; ?>" >
				<input type="hidden" name="product_uom" id="dam_product_uom<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $product_uom_name; ?>" >
				<input type="hidden" name="product_colour_name" id="dam_product_colour_name<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $product_colour_name; ?>" >
				<input type="hidden" name="product_colour_id" id="dam_product_colour_id<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_product_colour_id']; ?>" >
				<input type="hidden" name="product_brand_name" id="dam_product_brand_name<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['brand_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="dam_product_thick_ness<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $arr_thick[$record_so_detail['grn_entry_raw_product_detail_product_thick']]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="dam_product_thick_ness_id<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_product_thick']; ?>" >
				<input type="hidden" name="product_id" id="dam_product_id<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_width_inches" id="dam_product_width_inches<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="dam_product_width_mm<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="dam_product_sl_feet<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_sl_feet']; ?>" />

				
				<input type="hidden" name="product_sl_feet_mm" id="dam_product_sl_feet_mm<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_sl_feet_mm']; ?>" />
				
				
				
				<input type="hidden" name="raw_product_ton" id="dam_product_ton<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_ton']; ?>" />

				<input type="hidden" name="product_kg" id="dam_product_kg<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_kg']; ?>" />
				<input type="hidden" name="product_type_id" id="dam_product_type_id<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_type_id']; ?>" />
				<input type="hidden" name="product_type" id="dam_product_type<?php echo $record_so_detail['grn_entry_raw_product_detail_id'];?>" value="<?php echo $record_so_detail['grn_entry_raw_product_detail_product_type']; ?>" />
				
				</td>
				<td><?=$record_so_detail['grn_entry_no']?></td>
				<td><?=dateGeneralFormatN($record_so_detail['grn_entry_date'])?></td>
				<td><?php echo $product_code; ?></td>
				<td><?php echo $product_name; ?></td>
				<td><?=$product_uom_name?></td>
				<td><?=$record_so_detail['grn_entry_raw_product_detail_ton']?></td>
			</tr>

<?php  } ?>

			</tbody>

		</table>

		</form>

<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$('#dam_product_detail_popup').DataTable( {

					responsive: true

} );

</script>