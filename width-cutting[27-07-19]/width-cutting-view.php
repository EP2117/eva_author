<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>WIDTH CUTTING ENTRY DETAILS</title>

<?php 

	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Width Cutting Entry added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Width Cutting Entry updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Width Cutting Entry deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Width Cutting Entry Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Width Cutting Entry deleted successfully</div>';
		}  
	}

?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/width-cutting/width-cutting-javascript.js?ver='.strtotime(date('Y-m-d H:i:s')); ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/production-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">
                        <h1 class="page-head-line">Width Cutting Entry</h1>
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

				<form name="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Width Cutting Entry Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="width_cutting_branch_id" id="width_cutting_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

												?>

														<option value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>
										<div class="form-group">
											<label>MOTHER COIN CUTTING&nbsp;&nbsp;</label>
											<input type="checkbox"  name="width_cutting_type[]" id="width_cutting_type" value="1" >
										</div>
										<div class="form-group">
											<label>CHILD COIN CUTTING&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
											<input type="checkbox"  name="width_cutting_type[]" id="width_cutting_type" value="2"  >
										</div>
										<div class="form-group">
											<label>SALES WAREHOUSE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
											<input type="checkbox"  name="width_cutting_sw_check" id="width_cutting_sw_check" value="2"  >
										</div>
									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control" name="width_cutting_date" id="width_cutting_date"  value="<?=date('d/m/Y')?>"/>
											</div>
										</div>
										<div class="form-group">
											<label>Warehouse</label>
											<select name="width_cutting_godown_id" id="width_cutting_godown_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($godown_list	as	$get_godown){
												?>

														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
												<?php
													}
												?>

											</select>

										</div>
                                        
                                        <div class="form-group">

											<label class="control-label">Brand</label>

											<select name="width_cutting_brand_id" id="width_cutting_brand_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($brand_list	as	$get_brand){

												?>

														<option value="<?=$get_brand['brand_id']?>"><?=$get_brand['brand_name']?></option>

												<?php

													}

												?>

											</select>

										</div>
									</div>

								</div>

						</div>

						

					</div>

        		</div>

				<div class="row">

					<div class="col-md-12">

						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  Product Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align:middle;">BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE </th>
                                            <th rowspan="2" style="vertical-align:middle;">NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;">UOM</th>
                                            <th rowspan="2" style="vertical-align:middle;">COLOR</th>
                                            <th rowspan="2" style="vertical-align:middle;">THICK</th>
											<th colspan="2">WIDTH</th>
											<th colspan="2">LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">TONE</th>
                                        </tr>
										<tr>
											<th >INCHES</th>
											<th >MM</th>
											<th >FEET</th>
											<th >MM</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_display">
									</tbody>
								</table>
								</div>
							</div>
						</div>
						<div class="panel panel-info">
							<div class="panel-heading">
							  Width Cutting
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetWidthDetail();" class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="width_product_detail"  style=" width:100%" >
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:middle;">#</th>
											<th >WIDTH</th>
											<th >INCHES 1</th>
											<th >MM 1</th>
											<th >INCHES 2</th>
											<th >MM 2</th>
											<th >INCHES 3</th>
											<th >MM 3</th>
											<th >INCHES 4</th>
											<th >MM 4</th>
											<th >QTY</th>
											<th >LENGTH</th>
											<th >QTY</th>
										</tr>
                                    </thead>
                                    <tbody id="width_detail_display">
									</tbody>
								</table>
								</div>
							</div>
						</div>
						<div class="panel panel-info">

							<div class="panel-heading">

							 Child  Product Details

							</div>

							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetChildDetail();"  class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="child_product_detail"  style=" width:100%" >
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align:middle;">BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE </th>
                                            <th rowspan="2" style="vertical-align:middle;">NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;">UOM</th>
                                            <th rowspan="2" style="vertical-align:middle;">COLOR</th>
                                            <th rowspan="2" style="vertical-align:middle;">Thick</th>
											<th colspan="2">WIDTH</th>
											<th colspan="2">LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">TONE</th>
                                        </tr>
										<tr>
											<th >INCHES</th>
											<th >MM</th>
											<th >FEET</th>
											<th >METER</th>
										</tr>
                                    </thead>
                                    <tbody id="child_product_detail_display">
									</tbody>
								</table>
								</div>
							</div>

						</div>
						<div class="col-lg-6">

									<button name="width_cutting_insert" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>
					</div>

				</div>

				

				</form>

				

				<?php }else if((isset($_GET['page']))  && (isset($_GET['id'])) && ($_GET['page']=='edit')) {

				?>

				<form name="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Width Cutting Entry Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="width_cutting_branch_id" id="width_cutting_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$width_cutting_edit['width_cutting_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<div class="form-group">

											<label>Production Type</label>

											<select name="width_cutting_type" id="width_cutting_type" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($arr_producton_type	as	$value=>$list){

														$selected	= ($value==$width_cutting_edit['width_cutting_type'])?'selected="selected"':'';

												?>

														<option value="<?=$value?>" <?=$selected?>><?=$list?></option>

												<?php

													}

												?>

											</select>

										</div>

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="width_cutting_date" id="width_cutting_date" value="<?=dateGeneralFormatN($width_cutting_edit['width_cutting_date'])?>">

											</div>

										</div>

										<div class="form-group">

											<label>Warehouse</label>

											<select name="width_cutting_godown_id" id="width_cutting_godown_id" class="form-control select2" style="width:100%" >

												  <option value=""> - Select - </option>

												<?php

													foreach($godown_list	as	$get_godown){

														$selected	= ($get_godown['godown_id']==$width_cutting_edit['width_cutting_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>
                                        
                                         <div class="form-group">

											<label class="control-label">Brand</label>

											<select name="width_cutting_brand_id" id="width_cutting_brand_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($brand_list	as	$get_brand){

												?>

														<option value="<?=$get_brand['brand_id']?>" <?php if($width_cutting_edit['width_cutting_brand_id']==$get_brand['brand_id']){?> selected <?php }?>><?=$get_brand['brand_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										

										

									</div>

								</div>

						</div>

						

					</div>

        		</div>

				

				

				

				<div class="row">

					<div class="col-md-12">

						<!-- Advanced Tables -->

						<div class="panel panel-info">

							<div class="panel-heading">

							  Product Details

							</div>

							<div class="panel-body">

								

								<div class="table-responsive">

                               
							    <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >

                                    <thead>

                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;">BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE </th>

                                            <th rowspan="2" style="vertical-align:middle;">NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;">UOM</th>

                                            <th rowspan="2" style="vertical-align:middle;">COLOR</th>

                                            <th rowspan="2" style="vertical-align:middle;">THICK</th>

											<th colspan="2">WIDTH</th>

											<th colspan="2">LENGTH</th>


											<th rowspan="2" style="vertical-align:middle;">TONE</th>

                                        </tr>

										<tr>


											<th >INCHES</th>

											<th >MM</th>


											<th >FEET</th>


											<th >MM</th>


										</tr>

                                    </thead>

                                    <tbody id="product_detail_display">

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($width_cutting_prd_edit);

										foreach($width_cutting_prd_edit as $get_product_detail){

										?>

										<tr>
											<td>

											<?=$get_product_detail['brand_name']?>

											</td>
											<td>

											<?=$get_product_detail['product_code']?>

											</td>

											<td>

											<?=$get_product_detail['product_name']?>

											<input type="hidden"  name="width_cutting_product_detail_product_id[]" id="width_cutting_product_detail_product_id" value="<?=$get_product_detail['width_cutting_product_detail_product_id']?>" class="sd_id"  />

											<input type="hidden"  name="width_cutting_product_detail_id[]" id="width_cutting_product_detail_id" value="<?=$get_product_detail['width_cutting_product_detail_id']?>" />
							<input type="hidden"  name="width_cutting_product_detail_product_brand_id[]" id="width_cutting_product_detail_product_brand_id" value="<?=$get_product_detail['product_con_entry_child_product_detail_product_brand_id']?>" />
							<input type="hidden"  name="width_cutting_product_detail_product_colour_id[]" id="width_cutting_product_detail_product_colour_id" value="<?=$get_product_detail['product_con_entry_child_product_detail_color_id']?>" />
							<input type="hidden"  name="width_cutting_product_detail_osf_uom_ton[]" id="width_cutting_product_detail_osf_uom_ton" value="<?=$get_product_detail['product_con_entry_osf_uom_ton']?>" />
											</td>

											<td>

											<input class="form-control" type="text"  name="product_uom[]" id="product_uom<?=$row_cnt?>" value="<?=$get_product_detail['product_uom_name']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_colour[]" id="product_colour<?=$row_cnt?>" value="<?=$get_product_detail['product_colour_name']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_thick_ness[]" id="product_thick_ness<?=$row_cnt?>" value="<?=$arr_thick[$get_product_detail['product_thick_ness']]?>"   />
											<input class="form-control" type="hidden"  name="width_cutting_product_detail_product_thick_ness[]" id="width_cutting_product_detail_product_thick_ness<?=$row_cnt?>" value="<?=$get_product_detail['product_thick_ness']?>"   />
											</td>


											<td>

											<input class="form-control" type="text"  name="width_cutting_product_detail_width_inches[]" id="width_cutting_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_product_detail_width_inches']?>"  onblur="Getcalc(2,<?=$row_cnt?>)"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="width_cutting_product_detail_width_mm[]" id="width_cutting_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_product_detail_width_mm']?>"  onblur="Getcalc(3,<?=$row_cnt?>)"   />

											</td>


											<td>

											<input class="form-control" type="text"  name="width_cutting_product_detail_length_feet[]" id="width_cutting_product_detail_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_product_detail_length_feet']?>"   />

											</td>


											<td>
											<input class="form-control" type="text"  name="width_cutting_product_detail_length_mm[]" id="width_cutting_product_detail_length_mm<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_product_detail_length_mm']?>"   />

											</td>
											<td>
											<input class="form-control" type="text"  name="width_cutting_product_detail_qty[]" id="width_cutting_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['width_cutting_product_detail_qty']?>" />
											</td>

											

										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>

								</table>

								</div>

								

							</div>

						</div>
						<div class="panel panel-info">
							<div class="panel-heading">
							  Width Cutting
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetWidthDetail();" class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="width_product_detail"  style=" width:100%" >
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:middle;">#</th>
											<th >WIDTH</th>
											<th >INCHES 1</th>
											<th >INCHES 2</th>
											<th >INCHES 3</th>
											<th >INCHES 4</th>
											<th >QTY</th>
											<th >LENGTH</th>
											<th >QTY</th>
										</tr>
                                    </thead>
                                    <tbody id="width_detail_display">
									<?php 

										$row_cnt	= 1;
										$arr_cnt	= count($width_cutting_width_edit);
										foreach($width_cutting_width_edit as $get_product_detail){
										?>

										<tr>
											<td><?=$row_cnt?></td>
											<td>
											<input class="form-control" type="text"  name="width_cutting_width_detail_name[]" id="width_cutting_width_detail_name<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_width_detail_name']?>"   />
											<input type="hidden"  name="width_cutting_width_detail_id[]" id="width_cutting_width_detail_id" value="<?=$get_product_detail['width_cutting_width_detail_id']?>" />
											</td>
											<td>
											<input class="form-control" type="text"  name="width_cutting_width_detail_width_inches_one[]" id="width_cutting_width_detail_width_inches_one<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_width_detail_width_inches_one']?>"  onBlur="GetWDcalc(<?=$i?>);"   />
											</td>
											<td>
											<input class="form-control" type="text"  name="width_cutting_width_detail_width_inches_two[]" id="width_cutting_width_detail_width_inches_two<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_width_detail_width_inches_two']?>" onBlur="GetWDcalc(<?=$i?>);"  />

											</td>
											<td>
											<input class="form-control" type="text"  name="width_cutting_width_detail_width_inches_three[]" id="width_cutting_width_detail_width_inches_three<?=$row_cnt?>"  value="<?=$get_product_detail['width_cutting_width_detail_width_inches_three']?>" onBlur="GetWDcalc(<?=$i?>);" />
											</td>

											<td>

											<input class="form-control" type="text"  name="width_cutting_width_detail_width_inches_four[]" id="width_cutting_width_detail_width_inches_four<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_width_detail_width_inches_four']?>" onBlur="GetWDcalc(<?=$i?>);"   />

											</td>
											<td>
											<input class="form-control" type="text"  name="width_cutting_width_detail_inches_qty[]" id="width_cutting_width_detail_inches_qty<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_width_detail_inches_qty']?>" readonly   />
											</td>
											<td>
											<input class="form-control" type="text"  name="width_cutting_width_detail_length[]" id="width_cutting_width_detail_inches_qty<?=$row_cnt?>" value="<?=$get_product_detail['width_cutting_width_detail_length']?>"   />
											</td>
											
											<td>
											<input class="form-control" type="text"  name="width_cutting_width_detail_length_qty[]" id="width_cutting_width_detail_length_qty<?=$row_cnt?>"  value="<?=$get_product_detail['width_cutting_width_detail_length_qty']?>" />
											</td>

											

										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>	
									</tbody>
								</table>
								</div>
								

							</div>

						</div>
						<div class="panel panel-info">

							<div class="panel-heading">

							 Child  Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">
									<button type="button" onClick="GetChildDetail();"  class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="child_product_detail"  style=" width:100%" >
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align:middle;">BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE </th>
                                            <th rowspan="2" style="vertical-align:middle;">NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;">UOM</th>
                                            <th rowspan="2" style="vertical-align:middle;">COLOR</th>
											<th rowspan="2" style="vertical-align:middle;">Thick</th>

											<th colspan="2">WIDTH</th>
											<th colspan="2">LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">TONE</th>
                                        </tr>
										<tr>
											<th >INCHES</th>
											<th >MM</th>
											<th >FEET</th>
											<th >MM</th>
										</tr>
                                    </thead>
                                    <tbody id="child_product_detail_display">
										<?php
											foreach($product_con_entry_child_prd_edit as $get_chd_prd_detail){
											?>
											<tr>
												<td><?=$get_chd_prd_detail['brand_name']?></td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_code[]" id="product_con_entry_child_product_detail_code_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_code']?>" class="form-control" readonly  />
													<input type="hidden" name="product_con_entry_child_product_detail_id[]" id="product_con_entry_child_product_detail_id_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_id']?>" class="form-control"  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_name[]" id="product_con_entry_child_product_detail_name_<?=$i?>" class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_name']?>"  readonly=""  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_uom[]" id="product_con_entry_child_product_detail_uom_<?=$i?>" value="<?=$get_chd_prd_detail['product_uom_name']?>" class="form-control" readonly   />
													<input type="hidden" name="product_con_entry_child_product_detail_uom_id[]" id="product_con_entry_child_product_detail_uom_id_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_uom_id']?>" />
												</td>
												
												<td>
													<input type="text" name="product_con_entry_child_product_detail_color[]" id="product_con_entry_child_product_detail_color_<?=$i?>" value="<?=$get_chd_prd_detail['product_colour_name']?>" class="form-control"  readonly=""   />
													<input type="hidden" name="product_con_entry_child_product_detail_color_id[]" id="product_con_entry_child_product_detail_color_id<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_color_id']?>" />
													<input type="hidden" name="product_con_entry_child_product_detail_thick_ness[]" id="product_con_entry_child_product_detail_thick_ness<?=$i?>"  value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_thick_ness']?>"   />
													
												</td>
												<td>
												<input type="text" name="product_con_entry_child_product_detail_thick_ness_val[]" id="product_con_entry_child_product_detail_thick_ness_val<?=$i?>"  class="form-control"  value="<?=$arr_thick[$get_chd_prd_detail['product_con_entry_child_product_detail_thick_ness']]?>"   />
												<input type="hidden" name="product_con_entry_child_product_detail_thick_ness[]" id="product_con_entry_child_product_detail_thick_ness<?=$i?>"  value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_thick_ness']?>"   />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_width_inches[]" id="product_con_entry_child_product_detail_width_inches_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_width_inches']?>" class="form-control"   readonly="" />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_width_mm[]" id="product_con_entry_child_product_detail_width_mm_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_width_mm']?>" class="form-control" readonly  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_length_feet[]" id="product_con_entry_child_product_detail_length_feet_<?=$i?>" class="form-control"  value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_length_feet']?>" onBlur="GetCHLcalc();" />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_length_mm[]" id="product_con_entry_child_product_detail_length_mm_<?=$i?>" class="form-control"  value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_length_mm']?>"/>
												</td>
												
												<td>
													<input type="text" name="product_con_entry_child_product_detail_total[]" id="product_con_entry_child_product_detail_total_<?=$i?>" class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_total']?>" onBlur="GetCHLcalc();"    />
												</td>
												
											</tr>
											<?php } ?>
									</tbody>
								</table>
								</div>
							</div>

						</div>
						<div class="col-lg-6">

								<input type="hidden"  name="width_cutting_id" id="width_cutting_id" value="<?=$width_cutting_edit['width_cutting_id']?>" />	

								<input type="hidden"  name="width_cutting_uniq_id" id="width_cutting_uniq_id" value="<?=$width_cutting_edit['width_cutting_uniq_id']?>" />	

							<button name="width_cutting_update" type="submit" class="btn btn-success">Save </button>

							<button type="reset" class="btn btn-danger">Reset </button>
							
							<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

						</div>
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

                           Width Cutting Entry List

                        </div>
						<form action="index.php" method="post" id="so_list_form" name="so_list_form" >
						
							<div class="col-lg-6">

									<div class="form-group">

										<label class="control-label">Branch</label>

										<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" required>

											  <option value=""> - Select - </option>

											<?php

												foreach($branch_list	as	$get_branch){
											$selected	= ($get_branch['branch_id']==searchValue('search_branch_id'))?'selected="selected"':'';
											?>

													<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

											<?php

												}

											?>

										</select>

									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">From Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date" autocomplete="off"  value="<?=searchValue('search_from_date')?>"  >
										</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">To Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_to_date" id="search_to_date" autocomplete="off"  value="<?=searchValue('search_to_date')?>"  />
										</div>
									</div>
									</div>
							<div class="col-lg-12">
								<button name="search" type="submit" class="btn btn-success">Search </button>
								<button type="reset" class="btn btn-danger">Reset </button>
							</div>
							</form>
							<?php if(isset($_REQUEST['search'])){?>
                        <div class="panel-body">
						&nbsp;
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							&nbsp;
                            <div class="table-responsive">

								<form action="index.php" method="post" id="width_cutting_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>INV.No.</th>

                                            <th>Date</th>
											<th>Product Code</th>
											<th>Product Name</th>
											<th>Brand</th>
                                            <th>Action</th>
											<th>Print</th>
											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="width_cutting_entry_delete" type="submit" class="btn btn-danger">Delete</button>

											</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($quotation_list	as $get_quotation){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=$get_quotation['width_cutting_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['width_cutting_date'])?></td>
											
											<td><?=$get_quotation['product_con_entry_child_product_detail_code']?></td>
											
											<td><?=$get_quotation['product_con_entry_child_product_detail_name']?></td>
											
											<td><?=$get_quotation['brand_name']?></td>
											
										    <td class="center">
											

												<a href="index.php?page=edit&id=<?php echo $get_quotation['width_cutting_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>
											<td><a href="width-print.php?id=<?php echo $get_quotation['width_cutting_uniq_id']?>" title="INVOICE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
                                           

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['width_cutting_uniq_id']; ?>" type="checkbox" />

											</td>

                                        </tr>

									<?php } ?>

                                    </tbody>

                                </table>

								</form>

                            </div>

                        </div>

                    </div>
					<?php }?>

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

	<div class="panel-body">

                            

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

                                <div class="modal-dialog" style="width: 800px;">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h4 class="modal-title" id="myModalLabel">Product List</h4>

                                        </div>

                                        <div class="modal-body">

											<div class="table-responsive">

												<div id="dynamic-content"> 

												</div>

											</div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="button" class="btn btn-primary" onClick="AddproductDetail()"  data-dismiss="modal">Select Product</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

						

	<div class="panel-body">

		

		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Width Cutting Entry Detail</h4>

					</div>

					<div class="modal-body">

						<div class="table-responsive">

							<div id="so_detail_content">

							</div>

						</div>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

						<button type="button" class="btn btn-primary" onClick="AddSodetail()"  data-dismiss="modal">Save changes</button>

					</div>

				</div>

			</div>

		</div>

	</div>					

    <!-- /. WRAPPER  -->

    <div id="footer-sec">

        <?=PROJECT_FOOTER?>

    </div>

    <!-- /. FOOTER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

    <!-- JQUERY SCRIPTS -->

 

<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">

			<script>

				$(document).ready(function () {

					$('#dataTables-example').DataTable( {

						responsive: true

					} );

					/*$('#dataTables-example').dataTable();*/

				});
				
				$(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });

		//Initialize Select2 Elements

			$(".select2").select2();

			//$('.datatable').DataTable()

	//Date picker

   /* $('#width_cutting_date').datepicker({

      autoclose: true

    });*/

	$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#width_cutting_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
				$( "#invoice_entry_validity_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'',changeMonth:true,changeYear:true,});
			});

	
			

		</script>



</body>

</html>

