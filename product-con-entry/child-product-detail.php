<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

$total_qty		= $_REQUEST['total_qty'];
$product_id		= $_REQUEST['product_id'];
$width_inches	= $_REQUEST['width_inches'];
$width_mm		= $_REQUEST['width_mm'];

$select_prd		= "	SELECT 
						product_name,
						product_uom_name,
						product_product_uom_id,
						product_colour_name,
						product_product_colour_id
					FROM
						products
					LEFT JOIN
						product_uoms
					ON
						product_uom_id					= product_product_uom_id 
					LEFT JOIN
						product_colours
					ON
						product_colour_id					= product_product_colour_id 
				    WHERE
				   		product_deleted_status	= 0										AND
						product_id				= '".$product_id."'";
$result_prd 	= mysql_query($select_prd);
$record_prd 	= mysql_fetch_array($result_prd);
$product_name 	= $record_prd['product_name'];
$maxval			= 0;						
for($i=1;$i<=$total_qty;$i++){
	$product_no 	= $product_name.substr(('00000'.++$maxval),-5);
?>
	<tr>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_code[]" id="product_con_entry_child_product_detail_code_<?=$i?>" value="<?=$product_no?>" class="form-control"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_name[]" id="product_con_entry_child_product_detail_name_<?=$i?>" value="<?=$product_name?>" class="form-control"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_color[]" id="product_con_entry_child_product_detail_color_<?=$i?>" value="<?=$record_prd['product_colour_name']?>" class="form-control"  />
			<input type="hidden" name="product_con_entry_child_product_detail_color_id[]" id="product_con_entry_child_product_detail_color_id_<?=$i?>" value="<?=$record_prd['product_product_colour_id']?>"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_width_inches[]" id="product_con_entry_child_product_detail_width_inches_<?=$i?>" value="<?=$width_inches?>" class="form-control"   readonly="" />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_width_mm[]" id="product_con_entry_child_product_detail_width_mm_<?=$i?>" value="<?=$width_mm?>" class="form-control" readonly=""  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_length_feet[]" id="product_con_entry_child_product_detail_length_feet_<?=$i?>" class="form-control"  onblur="GetCLcalc(1,<?=$i?>); ChildtotalAmount();" />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_length_mm[]" id="product_con_entry_child_product_detail_length_mm_<?=$i?>" class="form-control" onblur="GetCLcalc(3,<?=$i?>)" />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_uom[]" id="product_con_entry_child_product_detail_uom_<?=$i?>" value="<?=$record_prd['product_uom_name']?>" class="form-control"  />
			<input type="hidden" name="product_con_entry_child_product_detail_uom_id[]" id="product_con_entry_child_product_detail_uom_id_<?=$i?>" value="<?=$record_prd['product_product_uom_id']?>"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_total[]" id="product_con_entry_child_product_detail_total_<?=$i?> " class="form-control" value="" onblur="ChildtotalAmount();" />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_con_width_inches[]" id="product_con_entry_child_product_detail_con_width_inches_<?=$i?>" value="" class="form-control" onblur="GetCCWcalc(2,<?=$i?>);"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_con_width_mm[]" id="product_con_entry_child_product_detail_con_width_mm_<?=$i?>"  class="form-control"   onblur="GetCCWcalc(3,<?=$i?>);"/>
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_con_length_feet[]" id="product_con_entry_child_product_detail_con_length_feet_<?=$i?>" class="form-control"  onblur="GetCCLcalc(1,<?=$i?>);"/>
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_con_length_mm[]" id="product_con_entry_child_product_detail_con_length_mm_<?=$i?>"  class="form-control" onblur="GetCCLcalc(3,<?=$i?>);"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_con_tone[]" id="product_con_entry_child_product_detail_con_tone_<?=$i?>" class="form-control" onblur="GetCLcalc(1,<?=$i?>);" />
		</td>
	</tr>
<?php			
}
?>