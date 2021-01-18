<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
		$raw_product_list		= getProduct();
		$row_cnt				= $_REQUEST['count'];
?>	
	
	<tr  class="odd gradeX">
		<td width="12%">
			<select name="product_detail_raw_product_id[]" id="product_detail_raw_product_id_<?=$row_cnt?>" class="form-control select2">
				  <option value=""> - Select - </option>
				<?php
					foreach($raw_product_list	as	$get_product){
				?>
						<option value="<?=$get_product['product_id']?>"  ><?=$get_product['product_name']?></option>
				<?php
					}
				?>
			</select>
		</td>
		<td width="17%">
		<input name="product_detail_uom[]" type="text" value="" class="form-control" id="product_detail_uom_<?=$row_cnt?>"  />
		</td>
		<td width="17%">
		<input name="product_detail_thick_ness[]" type="text" value="" class="form-control" id="product_detail_thick_ness_<?=$row_cnt?>"  />
		</td>
	  </tr>
