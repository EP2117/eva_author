<?php  

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$count					= $_REQUEST['count'];

	$raw_product_list		= getProduct();

?>	

	

	<tr  class="odd gradeX">

	<td>

		<select name="product_detail_raw_product_id1[]" id="product_detail_raw_product_id1_<?=$count?>" class="form-control select2">

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

	<!--<td width="17%">

	<input name="product_detail_raw_product_uom1[]" type="text" value="" class="form-control" id="product_detail_raw_product_uom1_<?=$count?>"  />

	</td>

	<td width="17%">

	<input name="brand_name[]" type="text" value="" class="form-control" id="brand_name_<?=$count?>"/>

	</td>
	
	<td width="17%">

        <input name="product_detail_raw_product_require_line1[]" type="text" value="" class="form-control" id="product_detail_raw_product_require_line_1"/>
   </td>-->

  </tr>

