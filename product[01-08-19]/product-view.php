	<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml"> 

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Product</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		} 

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/product/product-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Product</h1>

                        <h1 class="page-subhead-line">

							<?php

								if(isset($_GET['msg'])) {

									echo $msg;

								}

							?>

						</h1>

                    </div>

                </div>

				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>

				<form name="product_form" id="product_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Product Details

								</div>

								<div class="panel-body">

										<div class="col-lg-6">

											<div class="form-group">

												<label class="control-label">Brand</label>

												<select class="form-control select2" name="product_brand_id" id="product_brand_id" required>

													<option value="">--Select--</option>

												<?php

												  	foreach($brand_list	as	$get_brand){

												?>

												  		<option value="<?=$get_brand['brand_id']?>"  ><?=$get_brand['brand_name']?></option>

												<?php

													}

												?>

												</select>

											</div>

											<div class="form-group">

												<label class="control-label">Product Type</label>

												<select class="form-control" name="product_type" id="product_type" required onChange="get_raw_detail(this.value);">

													<option value="">--Select--</option>

													<?php

														foreach($arr_product_type as $value => $list){

													?>

														<option value="<?=$value?>"><?=ucfirst($list)?></option>

													<?php

													}

													?>

												</select>

											</div>

											<!--<div class="form-group">

												<label class="control-label">UOM</label>

												<select class="form-control select2" name="product_product_uom_id" id="product_product_uom_id" required>

													<option value="">--Select--</option>

												<?php

												  	foreach($product_uom_list	as	$get_product_uom){

												?>

												  		<option value="<?=$get_product_uom['product_uom_id']?>"  ><?=$get_product_uom['product_uom_name']?></option>

												<?php

													}

												?>

												</select>

											</div>-->

											<!--<div class="form-group">

												<label>Inches</label>

												<input class="form-control" type="number"  name="product_inches_qty" id="product_inches_qty"  readonly=""  />

											</div>-->

											<!--<div class="form-group">

												<label>Thick</label>

												<select class="form-control"  name="product_thick_ness" id="product_thick_ness" >
													<option value=""> --Select-- </option>
												<?php foreach($arr_thick as $key_val=>$get_val){?>
													
												<option value="<?=$key_val?>"><?=$get_val?></option>
												<?php } ?>
												 
												</select>
												

											</div>-->
											<!--<div class="form-group" style="display:none" id="type_one">

												<label>type</label>

												<select class="form-control"  name="product_type_one" id="product_type_one" >
													<option value=""> --Select-- </option>
												<?php

													foreach($arrQuotationType as $key => $value){

												?>

														<option value="<?=$key?>"><?=$value?></option>

												<?php

													}

												?>
												 
												</select>
												

											</div>-->
											
											<div class="form-group">

												<label>Purchase UOM</label>

												<select class="form-control select2" name="product_purchase_uom_id" id="product_purchase_uom_id">

													<option value="">--Select--</option>

												<?php

												  	foreach($product_uom_list	as	$get_product_uom){

												?>

												  		<option value="<?=$get_product_uom['product_uom_id']?>"  ><?=$get_product_uom['product_uom_name']?></option>

												<?php

													}

												?>

												</select>

											</div>

										</div>

										<div class="col-lg-6">

												<div class="form-group">

												<label class="control-label">Category</label>

												<select class="form-control select2" name="product_product_category_id" id="product_product_category_id" required/>

												  <option value="">--Select--</option>

													<?php

														foreach($product_category_list	as	$get_product_category){

													?>

												  		<option value="<?=$get_product_category['product_category_id']?>"  ><?=$get_product_category['product_category_name']?></option>

													<?php

														}

													?>

												</select>

											</div>

											<div class="form-group">

												<label>Code Type</label>

												<select class="form-control select2" name="product_code_type" id="product_code_type" onChange="checkCode(this.value)">

												  <option value="1">Manual</option>

												  <option value="2">Automatic</option>

												  

												</select>

											</div>

											<!--<div class="form-group">

												<label>Colour</label>

												<select class="form-control select2" name="product_product_colour_id" id="product_product_colour_id">

													<option value="">--Select--</option>

												<?php

												  	foreach($product_colour_list	as	$get_product_colour){

												?>

												  		<option value="<?=$get_product_colour['product_colour_id']?>"  ><?=$get_product_colour['product_colour_name']?></option>

												<?php

													}

												?>

												</select>

											</div>-->

											

											<!--<div class="form-group">

												<label>MM</label>

												<input class="form-control" type="number"  name="product_mm_qty" id="product_mm_qty" readonly=""  />

											</div>-->
											<!--<div class="form-group">

											<label>Production Type</label>

											<select name="product_production_type" id="product_production_type" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
												<?php
													foreach($arr_producton_type	as	$value=>$list){
												?>
														<option value="<?=$value?>"><?=$list?></option>
												<?php
													}
												?>
											</select>

										</div>-->
										
										<div class="form-group">

												<label class="control-label">Name</label>

												<input class="form-control" type="text"  name="product_name" id="product_name"  required/>

											</div>

											<div class="form-group">

												<label class="control-label">Code</label>

												<div id="pro_id">

												<input class="form-control" type="text"  name="product_code" id="product_code" required>

												</div>

											</div>
										
										</div> 

										<?php /*?><div class="col-lg-4">

											

											<!--<div class="form-group">

												<label>Feet</label>

												<input class="form-control" type="text"  name="product_feet_qty" id="product_feet_qty" onBlur="Getcalc('1')" />

											</div>-->

											<!--<div class="form-group">

												<label>Meter</label>

												<input class="form-control" type="text"  name="product_meter_qty" id="product_meter_qty" readonly="" />

											</div>-->
											

										</div> <?php */?>

								</div>

						</div>

					</div>

        		</div>

				

				<div class="row">

					<div class="col-md-12">

						<!-- Advanced Tables -->

						<div class="panel panel-info"  style="display:none" id="multi_contact">

							<div class="panel-heading">

							  Selling Cost Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6" >

									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="multi-contact" >

                                    <thead>

                                        <tr>

                                            <th>Raw Product </th>

                                            <th>Uom</th>

                                            <th>Thick</th>
											
											<th>Require Line</th>

                                        </tr>

                                    </thead>

                                    <tbody id="multi-contact-display">

										<tr  class="odd gradeX">

										<td width="12%">

											<select name="product_detail_raw_product_id[]" id="product_detail_raw_product_id_1" class="form-control select2">

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

										<input name="product_detail_raw_product_uom[]" type="text" value="" class="form-control" id="product_detail_raw_product_uom_1"  />

										</td>

										<td width="17%">

										<input name="product_detail_raw_product_thick[]" type="text" value="" class="form-control" id="product_detail_raw_product_thick_1"/>

										</td>
										
										<td width="17%">

										<input name="product_detail_raw_product_require_line[]" type="text" value="" class="form-control" id="product_detail_raw_product_require_line_1"/>

										</td>

									  </tr>

									</tbody>

								</table>

								</div>

								

							</div>

						</div>
									
					</div>
				
				<div class="col-md-12" style="display:none" id="multi_contacts">

						<!-- Advanced Tables -->

						<div class="panel panel-info"  >

							<div class="panel-heading">

							  Second Raw Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6" >

									<button  type="button" onClick="SecondDivRow()"class="glyphicon glyphicon-plus"></button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="multi-contacts" >

                                    <thead>

                                        <tr>

                                            <th>Raw Product </th>

                                            <th>Uom</th>

                                            <!--<th>Thick</th>-->
											
											<th>Require Line</th>

                                        </tr>

                                    </thead>

                                    <tbody id="multi-contact-displays">

										<tr  class="odd gradeX">

										<td width="12%">

											<select name="product_detail_raw_product_id1[]" id="product_detail_raw_product_id1_1" class="form-control select2">

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

										<input name="product_detail_raw_product_uom1[]" type="text" value="" class="form-control" id="product_detail_raw_product_uom1_1"  />

										</td>

										<!--<td width="17%">

										<input name="product_detail_raw_product_thick1[]" type="text" value="" class="form-control" id="product_detail_raw_product_thick1_1"/>

										</td>-->
										
										<td width="17%">

										<input name="product_detail_raw_product_require_line1[]" type="text" value="" class="form-control" id="product_detail_raw_product_require_line1_1"/>

										</td>

									  </tr>

									</tbody>

								</table>

								</div>

								

							</div>

						
					</div>
					</div>
									<div class="col-lg-6">

									<button name="product_insert" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>
				</div>

				</form>

				<?php }else if((isset($_GET['page']))  && (isset($_GET['id'])) && ($_GET['page']=='edit')) {

				?>

				<form name="product_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Product Details

								</div>

								

								<div class="panel-body">

										<div class="col-lg-6">

											<div class="form-group">

												<label>Brand</label>

												<select class="form-control select2" name="product_brand_id" id="product_brand_id">

													<option value="">--Select--</option>

												<?php

												  	foreach($brand_list	as	$get_brand){

														$selected	= ($product_edit['product_brand_id']==$get_brand['brand_id'])?'selected="selected"':'';

												?>

												  		<option value="<?=$get_brand['brand_id']?>" <?=$selected?>  ><?=$get_brand['brand_name']?></option>

												<?php

													}

												?>

												</select>

											</div>

											<div class="form-group">

												<label>Product Type</label>

												<select class="form-control" name="product_type" id="product_type" onChange="get_raw_detail(this.value);">

													<option value="">--Select--</option>

													<?php

														foreach($arr_product_type as $value => $list){

														$selected	= ($product_edit['product_type']==$value)?'selected="selected"':'';

													?>

														<option value="<?=$value?>" <?=$selected?>><?=ucfirst($list)?></option>

													<?php

													}

													?>

												</select>

											</div>

											<!--<div class="form-group">

												<label>UOM</label>

												<select class="form-control select2" name="product_product_uom_id" id="product_product_uom_id">

													<option value="">--Select--</option>

												<?php

												  	foreach($product_uom_list	as	$get_product_uom){

														$selected	= ($product_edit['product_product_uom_id']==$get_product_uom['product_uom_id'])?'selected="selected"':'';

												?>

												  		<option value="<?=$get_product_uom['product_uom_id']?>" <?=$selected?> ><?=$get_product_uom['product_uom_name']?></option>

												<?php

													}

												?>

												</select>

											</div>-->

											

											<!--<div class="form-group">

												<label>MM</label>

												<input class="form-control" type="number"  name="product_mm_qty" id="product_mm_qty" value="<?=$product_edit['product_mm_qty']?>" readonly=""  />

											</div>-->

											<!--<div class="form-group">

											<label>Production Type</label>

											<select name="product_production_type" id="product_production_type" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($arr_producton_type	as	$value=>$list){
														$selected	= ($product_edit['product_production_type']==$value)?'selected="selected"':'';
												?>

														<option value="<?=$value?>" <?=$selected?>><?=$list?></option>

												<?php

													}

												?>

											</select>

										</div>-->
										
										<div class="form-group">

												<label>Purchase UOM</label>

													<select class="form-control select2" name="product_purchase_uom_id" id="product_purchase_uom_id">

													<option value="">--Select--</option>

												<?php

												  	foreach($product_uom_list	as	$get_product_uom){
													$selected	= ($product_edit['product_purchase_uom_id']==$get_product_uom['product_uom_id'])?'selected="selected"':'';
												?>

												  		<option value="<?=$get_product_uom['product_uom_id']?>" <?=$selected?>  ><?=$get_product_uom['product_uom_name']?></option>

												<?php

													}

												?>

												</select>

											</div>
										
										</div>

										<div class="col-lg-4">

												<div class="form-group">

												<label>Category</label>

												<select class="form-control select2" name="product_product_category_id" id="product_product_category_id"/>

												  <option value="">--Select--</option>

													<?php

														foreach($product_category_list	as	$get_product_category){

													$selected	= ($product_edit['product_product_category_id']==$get_product_category['product_category_id'])?'selected="selected"':'';

												?>

													<option value="<?=$get_product_category['product_category_id']?>" <?=$selected?> ><?=$get_product_category['product_category_name']?></option>

													<?php

														}

													?>

												</select>

											</div>

											<?php /*?>

											<div class="form-group">

												<label>Colour</label>

												<select class="form-control select2" name="product_product_colour_id" id="product_product_colour_id">

													<option value="">--Select--</option>

												<?php

												  	foreach($product_colour_list	as	$get_product_colour){

													$selected	= ($product_edit['product_product_colour_id']==$get_product_colour['product_colour_id'])?'selected="selected"':'';

												?>

												  		<option value="<?=$get_product_colour['product_colour_id']?>" <?=$selected?> ><?=$get_product_colour['product_colour_name']?></option>

												<?php

													}

												?>

												</select>

											</div>

											

											

											<!--<div class="form-group">

												<label>Feet</label>

												<input class="form-control" type="text"  name="product_feet_qty" id="product_feet_qty" onBlur="Getcalc('1')" value="<?=$product_edit['product_feet_qty']?>"  />

											</div>-->

											<!--<div class="form-group">

												<label>Meter</label>

												<input class="form-control" type="text"  name="product_meter_qty" id="product_meter_qty" readonly=""  value="<?=$product_edit['product_meter_qty']?>" />

											</div>-->
											
										</div> <?php */?>

										<div class="col-lg-6">

											<div class="form-group">

												<label>Name</label>

												<input class="form-control" type="text"  name="product_name" id="product_name" value="<?=$product_edit['product_name']?>"   min="0"/>

											</div>

											<div class="form-group">

												<label>Code</label>

												<div id="pro_id">

												<input class="form-control" type="text"  name="product_code" id="product_code" value="<?=$product_edit['product_code']?>"  >

												</div>

											</div>

											<!--<div class="form-group">

												<label>Inches</label>

												<input class="form-control" type="number"  name="product_inches_qty" id="product_inches_qty" value="<?=$product_edit['product_inches_qty']?>"  readonly=""  />

											</div>-->

											<!--<div class="form-group">

												<label>Thick</label>

												
												<select class="form-control"  name="product_thick_ness" id="product_thick_ness" >
													<option value=""> --Select-- </option>
												<?php foreach($arr_thick as $key_val=>$get_val){?>
													
												<option value="<?=$key_val?>" <?php if($product_edit['product_thick_ness']==$key_val){echo 'selected="selected"';} ?>><?=$get_val?></option>
												<?php } ?>
												 
												</select>

											</div>-->
											
											<!--<div class="form-group" <?php if($product_edit['product_type']==3){?>style="display:block"<?php }else{ ?> style="display:none" <?php }?> id="type_one">

												<label>type</label>

												<select class="form-control"  name="product_type_one" id="product_type_one" >
													<option value=""> --Select-- </option>
												<?php

													foreach($arrQuotationType as $key => $value){

												?>

														<option value="<?=$key?>"<?php if($product_edit['product_type_one']==$key){echo 'selected="selected"';} ?>><?=$value?></option>

												<?php

													}

												?>
												 
												</select>
												

											</div>-->

										</div>

								</div>

						</div>

					</div>

        		</div>

				

				<div class="row">

					<div class="col-md-12">

						<!-- Advanced Tables -->

						<div class="panel panel-info" <?php if($product_edit['product_type']==3){?> style="display:block" <?php }else{ ?> style="display:none"<?php }?> >

							<div class="panel-heading">

							  Selling Cost Details

							</div>

							<div class="panel-body" >

								<div class="col-lg-6">

									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="multi-contact">

                                    <thead>

                                        <tr>

                                            <th>Raw Product </th>

                                            <th>Uom</th>

                                            <th>Brand</th>
											
											 <th>Require Line</th>

                                        </tr>

                                    </thead>

                                    <tbody id="multi-contact-display">

										<?PHP 

										$i=1;

										foreach($product_detail_edit as $get_product_det){

										?>

										<tr  class="odd gradeX">

										<td width="12%">

											<select name="product_detail_raw_product_id[]" id="product_detail_raw_product_id_<?=$i?>" class="form-control select2">

												  <option value=""> - Select - </option>

												<?php

												  	foreach($raw_product_list	as	$get_product){

													$selected	= ($get_product_det['product_detail_raw_product_id']==$get_product['product_id'])?'selected="selected"':'';

												?>

												  		<option value="<?=$get_product['product_id']?>" <?=$selected?>><?=$get_product['product_name']?></option>

												<?php

													}

												?>

											</select>

										</td>

										<td width="17%">

										<input name="product_detail_raw_product_uom[]" type="text"  class="form-control" id="product_detail_raw_product_uom_<?=$i?>"  value="<?=$get_product_det['product_uom_name']?>" />

										</td>

										<td width="17%">

										<input name="brand_name[]" type="text" class="form-control" id="brand_name_<?=$i?>" value="<?=$get_product_det['brand_name']?>"/>

										<input name="product_detail_id[]" type="hidden" class="form-control" id="product_detail_id<?=$i?>" value="<?=$get_product_det['product_detail_id']?>"/>

										</td>
										<td width="17%">

										<input name="product_detail_raw_product_require_line[]" type="text"  class="form-control" id="product_detail_raw_product_require_line_<?=$i?>"  value="<?=$get_product_det['product_detail_raw_product_require_line']?>" />

										</td>

									  </tr>

									  	<?php

										$i	= $i+1;

										}

										?>

									  	<tr  class="odd gradeX">

										<td width="12%">

											<select name="product_detail_raw_product_id[]" id="product_detail_raw_product_id_<?=$i?>" class="form-control select2">

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

										<input name="product_detail_raw_product_uom[]" type="text" value="" class="form-control" id="product_detail_raw_product_uom_<?=$i?>"  />

										</td>

										<td width="17%">

										<input name="brand_name[]" type="text" value="" class="form-control" id="brand_name_<?=$i?>	"/>

										</td>
										<td width="17%">

										<input name="product_detail_raw_product_require_line[]" type="text"  class="form-control" id="product_detail_raw_product_require_line_<?=$i?>"  value="" />

										</td>

									  </tr>

									</tbody>

								</table>

								</div>

								

							</div>

						</div>
							
					</div>
					
					<div class="col-md-12" <?php if($product_edit['product_type']==3){?> style="display:block" <?php }else{ ?> style="display:none"<?php }?>>

						<!-- Advanced Tables -->

						<div class="panel panel-info" >

							<div class="panel-heading">

							  Second Raw Details

							</div>

							<div class="panel-body" >

								<div class="col-lg-6">

									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="multi-contact">

                                    <thead>

                                        <tr>

                                            <th>Raw Product </th>

                                            <th>Uom</th>

                                           <th>Brand</th>
											
											 <th>Require Line</th>

                                        </tr>

                                    </thead>

                                    <tbody id="multi-contact-display">

										<?PHP 

										$i=1;

										foreach($edit_product_details as $get_product_det){

										?>

										<tr  class="odd gradeX">

										<td width="12%">

											<select name="product_detail_raw_product_id1[]" id="product_detail_raw_product_id1_<?=$i?>" class="form-control select2">

												  <option value=""> - Select - </option>

												<?php

												  	foreach($raw_product_list	as	$get_product){

													$selected	= ($get_product_det['product_detail_raw_product_id1']==$get_product['product_id'])?'selected="selected"':'';

												?>

												  		<option value="<?=$get_product['product_id']?>" <?=$selected?>><?=$get_product['product_name']?></option>

												<?php

													}

												?>

											</select>

										</td>

										<td width="17%">

										<input name="product_detail_raw_product_uom[]" type="text"  class="form-control" id="product_detail_raw_product_uom_<?=$i?>"  value="<?=$get_product_det['product_uom_name']?>" />

										</td>

										<td width="17%">

										<input name="brand_name[]" type="text" class="form-control" id="brand_name_<?=$i?>" value="<?=$get_product_det['brand_name']?>"/>

										</td>
										<td width="17%">

										<input name="product_detail_raw_product_require_line1[]" type="text"  class="form-control" id="product_detail_raw_product_require_line1_<?=$i?>"  value="<?=$get_product_det['product_detail_raw_product_require_line1']?>" />
<input name="product_details_id[]" type="hidden" class="form-control" id="product_details_id<?=$i?>" value="<?=$get_product_det['product_details_id']?>"/>
										</td>

									  </tr>

									  	<?php

										$i	= $i+1;

										}

										?>

									  	<tr  class="odd gradeX">

										<td width="12%">

											<select name="product_detail_raw_product_id1[]" id="product_detail_raw_product_id1_<?=$i?>" class="form-control select2">

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

										<input name="product_detail_raw_product_uom[]" type="text" value="" class="form-control" id="product_detail_raw_product_uom_<?=$i?>"  />

										</td>

										<td width="17%">

										<input name="brand_name[]" type="text" value="" class="form-control" id="brand_name_<?=$i?>	"/>

										</td>
										<td width="17%">

										<input name="product_detail_raw_product_require_line1[]" type="text"  class="form-control" id="product_detail_raw_product_require_line1_<?=$i?>"  value="" />

										</td>

									  </tr>

									</tbody>

								</table>

								</div>

								

							</div>

						</div>
							
					</div>
					</div>
					<div class="col-lg-12">
							<div class="col-lg-6">

											<input type="hidden" name="product_id" id="product_id" value="<?=$product_edit['product_id']?>" />

											<input type="hidden" name="product_uniq_id" id="product_uniq_id" value="<?=$product_edit['product_uniq_id']?>" />

									<button name="product_update" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>
				 </div> 

				</form>

				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Data Table

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>Code</th>

                                            <th>Name</th>

                                            <th>Product Type</th>

                                            <th>Brand</th>

                                            <!--<th>Category</th>-->

                                            <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($product_list	as $get_branch){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=$get_branch['product_code']?></td>

                                            <td><?=ucfirst($get_branch['product_name'])?></td>

                                            <td><?=ucfirst($arr_product_type[$get_branch['product_type']])?></td>

											<td><?=ucfirst($get_branch['brand_name'])?></td>

											<!--<td><?=ucfirst($get_branch['product_category_name'])?></td>-->

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_branch['product_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

                                        </tr>

									<?php } ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <!--End Advanced Tables -->

                </div>

            	</div>

				<?php } ?>

                <!-- /. ROW  -->



            </div>

            <!-- /. PAGE INNER  -->

        </div>

        <!-- /. PAGE WRAPPER  -->

    </div>

    <!-- /. WRAPPER  -->

    <div id="footer-sec">

        <?=PROJECT_FOOTER?>

    </div>

			<script>
		
		$( "#product_form" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
		});	
		
				$(document).ready(function () {

					$('#dataTables-example').DataTable( {

						responsive: true

					} );

					/*$('#dataTables-example').dataTable();*/

				});

		

		//Initialize Select2 Elements

		$(".select2").select2();

				

		</script>



</body>

</html>

