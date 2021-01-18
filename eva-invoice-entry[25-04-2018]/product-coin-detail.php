<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

 $product_id		= $_REQUEST['prod_id'];
 $total_qty			= $_REQUEST['total_qty']; 
 $row_count			= $_REQUEST['row_cnt'];
 $rate				= $_REQUEST['rate'];
 $exp_qty			=explode(",",$total_qty);
 $product_id_ex			=explode(",",$product_id);
 
 
$select_po_con	= "SELECT
						*
				   FROM
				   		product_con_entry_child_product_details
				   WHERE
				   		product_con_entry_child_product_detail_deleted_status	= 0";
$result_prd 	= mysql_query($select_po_con);
$row_prd_cnt 	= mysql_num_rows($result_prd);
$u				= 0;
$row_start		= 1;

for($c=0;$c<count($product_id_ex);$c++){
$select_prd		= "	SELECT 
						product_name,
						product_uom_name,
						product_product_uom_id,
						product_colour_name,
						product_product_colour_id,
						product_id,
						product_code,
						product_brand_id,
						product_product_category_id
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
						product_id				 IN(".$product_id_ex[$c].")";
$result_prd 	= mysql_query($select_prd);
while($record_prd 	= mysql_fetch_array($result_prd)){
$product_name 		= $record_prd['product_name'];
$product_code 		= $record_prd['product_code'];
$product_id 		= $record_prd['product_id'];
$product_brand_id 	= $record_prd['product_brand_id'];
$product_product_category_id 	= $record_prd['product_product_category_id'];
$tot_qty		= $exp_qty[$u];
$colour_list	= getColourList();
$uom_list		= getProductuomList();
$maxval			= 0;

for($k=1;$k<=$exp_qty[$c];$k++){
	$i				=$row_start;
	$prd_code		= explode(" ",$product_code);		
	$product_no 	= $prd_code[0]."M".substr(('00000'.++$row_prd_cnt),-5);
?>
	<tr>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_code[]" id="product_con_entry_child_product_detail_code_<?=$i?>" value="<?=$product_no?>" class="form-control"  />
			<input type="hidden" name="product_con_entry_child_product_detail_product_id[]" id="product_con_entry_child_product_detail_product_id_<?=$i?>" value="<?=$product_id?>" class="form-control"  />
			<input type="hidden" name="product_con_entry_child_product_detail_product_brand_id[]" id="product_con_entry_child_product_detail_product_brand_id_<?=$i?>" value="<?=$product_brand_id?>" class="form-control"  />
			<input type="hidden" name="product_con_entry_child_product_detail_product_category_id[]" id="product_con_entry_child_product_detail_product_category_id_<?=$i?>" value="<?=$product_product_category_id?>" class="form-control"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_name[]" id="product_con_entry_child_product_detail_name_<?=$i?>" value="<?=$product_name?>" class="form-control"  />
		</td>
		<td>
			<select name="product_con_entry_child_product_detail_color_id[]" id="product_con_entry_child_product_detail_color_id_<?=$i?>" class="form-control select2" style="width:100%" >
				 <option value=""> - Select - </option>
				<?php
					foreach($colour_list as	$get_colour){
				?>
						<option value="<?=$get_colour['product_colour_id']?>"><?=$get_colour['product_colour_name']?></option>
				<?php
					}
					?>
					
			</select>
		</td>
<td>
			
			<select class="form-control" name="product_con_entry_child_product_detail_thick[]" id="product_con_entry_child_product_detail_thick_<?=$i?>" required>
													<option value="">--Select--</option>
													<?php
														foreach($arr_thick as $value => $list){
													?>
														<option value="<?=$value?>"><?=ucfirst($list)?></option>
													<?php
													}
													?>
												</select>
		</td>	
		<td>
			<select name="product_con_entry_child_product_detail_uom_id[]" id="product_con_entry_child_product_detail_uom_id_<?=$i?>" class="form-control select2" style="width:100%" >
				 <option value=""> - Select - </option>
				<?php
					foreach($uom_list as	$get_uom){
				?>
						<option value="<?=$get_uom['product_uom_id']?>"><?=$get_uom['product_uom_name']?></option>
				<?php
					}
					?>
			</select>
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_width_inches[]" id="product_con_entry_child_product_detail_width_inches_<?=$i?>" value="" class="form-control"   onblur="GetWcalc(2,<?=$i?>);" />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_width_mm[]" id="product_con_entry_child_product_detail_width_mm_<?=$i?>" value="" class="form-control" onblur="GetWcalc(3,<?=$i?>);"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_length_feet[]" id="product_con_entry_child_product_detail_length_feet_<?=$i?>" class="form-control"  onblur="GetCLcalc(1,<?=$i?>);" />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_length_mm[]" id="product_con_entry_child_product_detail_length_mm_<?=$i?>" class="form-control" onblur="GetCLcalc(4,<?=$i?>)" />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_ton_qty[]" id="product_con_entry_child_product_detail_ton_qty_<?=$i?>" class="form-control" value="" onBlur="GetWeightClc(<?=$i?>,1); get_curr_mmk_amt(<?=$i?>),getosf_amt(<?=$i?>,3);"   />
		</td>
		<td>
			<input type="text" name="product_con_entry_child_product_detail_kg_qty[]" id="product_con_entry_child_product_detail_kg_qty_<?=$i?>" class="form-control" value="" onBlur="GetWeightClc(<?=$i?>,2);"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_amount_by_currency[]" id="product_con_entry_amount_by_currency_<?=$i?>" class="form-control" value="" onBlur="GetWeightClc(<?=$i?>,2);"  />
		</td>
		<td>
			<input type="text" name="product_con_entry_amount_by_mmk[]" id="product_con_entry_amount_by_mmk_<?=$i?>" class="form-control" value="" onBlur="GetWeightClc(<?=$i?>,2);"  />
		</td>
		
		<td> <input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_width_inches[]" id="product_con_entry_osf_width_inches_<?=$i?>" value="" onBlur="GetWcalcation(<?=$i?>,5);"> </td>
				<td> <input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_width_mm[]" id="product_con_entry_osf_width_mm_<?=$i?>" value="" onBlur="GetWcalcation(<?=$i?>,6);"> </td> 
				<td> <input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_length_feet[]" id="product_con_entry_osf_length_feet_<?=$i?>" value="1.00" onBlur="getcalculation(<?=$i?>,7);"  readonly=""/> </td> 
				<td> <input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_length_m[]" id="product_con_entry_osf_length_m_<?=$i?>"  value="0.3048"onBlur="getcalculation(<?=$i?>,8);" readonly=""> </td>
				<td> <input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_uom_ton[]" id="product_con_entry_osf_uom_ton_<?=$i?>" value=""  readonly="">  </td>
				<td> <input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_uom_kg[]" id="product_con_entry_osf_uom_kg_<?=$i?>" value="" readonly="">
				<input type="hidden" class="form-control" style="text-align:right;" name="product_rate[]" id="product_rate_<?=$i?>" value="<?=$rate; ?>" >
				 </td>
	</tr>
<?php
$row_start		= $row_start+1;		
			
} $u	= $u+1;} }
?>