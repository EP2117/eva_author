<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Delivery - Gate pass</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Delivery added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Delivery updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Delivery deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Delivery Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Delivery deleted successfully</div>';

		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/production-delivery/production-delivery-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/production-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Delivery - Gate pass</h1>

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

				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Production Delivery Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="pdo_entry_branch_id" id="pdo_entry_branch_id" class="form-control select2" style="width:100%" required>

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

											<label class="control-label">Warehouse</label>

											<select name="pdo_entry_godown_id" id="pdo_entry_godown_id" class="form-control select2" required>

												<?php

												foreach($godown_list as $get_godown){

												?>

														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label class="control-label">Customer</label>

											<select name="pdo_entry_customer_id" id="pdo_entry_customer_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){

												?>

														<option value="<?=$get_customer['customer_id']?>"><?=$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<div class="form-group">

											<label>Vehicle No.</label>

											<input type="text" class="form-control" name="pdo_entry_vehicle_no" id="pdo_entry_vehicle_no" >

										</div>

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="pdo_entry_date" id="pdo_entry_date" required>

											</div>

										</div>

										<div class="form-group">

											<label>Type</label>

											<select name="pdo_entry_delivery_type" id="pdo_entry_delivery_type" class="form-control select2" style="width:100%" >

												  <option value=""> - Select - </option>

												<?php

												foreach($arr_delivery_type as $value=>$list){

												?>	

														<option value="<?=$value?>"><?=$list?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Driver</label>

											<input type="text" class="form-control" name="pdo_entry_driver_name" id="pdo_entry_driver_name" >

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

							  ENTRY DETAILS

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetSodetail();" data-toggle="modal" data-target="#soModal" data-id="1" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >

                                    <thead>

                                        <tr i>

                                            <th style=" width:30%;">PDO Entry.No</th>

                                            <th style=" width:25%;">Date</th>

                                            <th style=" width:25%;">Type</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

									</tbody>

								</table>

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

                            </button>

								</div>

								<table class="table table-striped table-bordered table-hover" id="product_detail"  style="width:190%" >

                                    <thead style="display:none" class="rls">

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle; width:10%">PRD CODE</th>
											
											<th rowspan="2" style="vertical-align:middle; width:10%"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle; width:10%"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle; width:10%"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle; width:10%"> THICK</th>

											<th colspan="2" style="width:20%"> WIDTH</th>
											<th colspan="2" style="width:20%"> SALES WIDTH</th>
											<th colspan="4" style="width:40%"> SALES LENGTH</th>
											<th colspan="4" style="width:40%"> Extra LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;width:10%">QTY</th>
											<th rowspan="2" style="vertical-align:middle;width:10%"> Total Length </th>

                                        </tr>

										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>Met</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>Met</th>
										</tr>

                                    </thead>
									
									<thead style="display:none" class="rws">

                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>

                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY</th>
											<th colspan="2" style=""> SALES WEIGHT</th>
											<th colspan="2" style=""> TOTAL LENGTH</th>
											
                                        </tr>

										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> TON</th>
											<th> KG</th>
											<th> TON</th>
											<th> KG</th>
											<th> FEET</th>
											<th> METER</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="ccs">

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>
											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length</th>
                                        </tr>

										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
										</tr>

                                    </thead>
									

                                    <tbody id="product_detail_display">

									

									</tbody>

								</table>

								<div class="col-lg-6">

									<button name="pdo_entry_insert" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>

							</div>

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

								  	Production Delivery Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="pdo_entry_branch_id" id="pdo_entry_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$pdo_entry_edit['pdo_entry_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Warehouse</label>

											<select name="pdo_entry_godown_id" id="pdo_entry_godown_id" class="form-control select2">

												<option value=""> - Select - </option>

												<?php

												foreach($godown_list as $get_godown){

														$selected	= ($get_godown['godown_id']==$pdo_entry_edit['pdo_entry_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Customer</label>

											<select name="pdo_entry_customer_id" id="pdo_entry_customer_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){

														$selected	= ($get_customer['customer_id']==$pdo_entry_edit['pdo_entry_customer_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_customer['customer_id']?>" <?=$selected?>><?=$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Vehicle No.</label>

											<input type="text" class="form-control" name="pdo_entry_vehicle_no" id="pdo_entry_vehicle_no"  value="<?=$pdo_entry_edit['pdo_entry_vehicle_no']?>"/>

										</div>

										

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="pdo_entry_date" id="pdo_entry_date" value="<?=dateGeneralFormatN($pdo_entry_edit['pdo_entry_date'])?>">

											</div>

										</div>

										<div class="form-group">

											<label>Type</label>

											<select name="pdo_entry_delivery_type" id="pdo_entry_delivery_type" class="form-control select2" style="width:100%" >

												  <option value=""> - Select - </option>

												<?php

												foreach($arr_delivery_type as $value=>$list){

													$selected = ($pdo_entry_edit['pdo_entry_delivery_type']==$value)?'selected="selected"':'';

												?>	

														<option value="<?=$value?>" <?=$selected?>><?=$list?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Driver</label>

											<input type="text" class="form-control" name="pdo_entry_driver_name" id="pdo_entry_driver_name"  value="<?=$pdo_entry_edit['pdo_entry_driver_name']?>"/>

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

							  ENTRY DETAILS

							</div>

							<div class="panel-body">

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >

                                    <thead>

                                        <tr >

                                            <th style=" width:30%;">PDO Entry.No</th>

                                            <th  style=" width:25%;">	Date</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr>

										<td><?=$sales_detail_edit['production_entry_no']?></td>

										<td><?=dateGeneralFormatN($sales_detail_edit['production_entry_date'])?>

										<input type="hidden"  name="pdo_entry_invoice_entry_id" id="pdo_entry_invoice_entry_id" value="<?=$pdo_entry_edit['pdo_entry_invoice_entry_id']?>"  class="dc_id"  /></td>

										

										</tr>

									</tbody>

								</table>

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

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >

                                    
                                    <thead style="display:none" class="rls">

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE</th>
											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY </th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length</th>



                                        </tr>

										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="rws">

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>

                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY</th>
                                        </tr>

										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> TON</th>
											<th> KG</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="ccs">

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>
											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>


                                        </tr>

										<tr>
											<th> INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
										</tr>

                                    </thead>
									


                                    
									<tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($pdo_entry_prd_edit);
										
										foreach($pdo_entry_prd_edit as $get_product_detail){
											if($get_product_detail['pdo_entry_product_detail_product_type']==1){
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
											}
											else{
												$product_code		= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name		= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $get_product_detail['c_uom_name'];
												$product_colour_name	= $get_product_detail['c_colour_name'];
											}
										
										
											if($pdo_entry_edit['pdo_entry_type_id']==1){ 
											?>
					
										<tr class="rls" style="display:none">

											<td>

											<?=$product_code?>
											<input type="hidden"  name="pdo_entry_product_detail_product_type[]" id="pdo_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_type']?>" />

											</td>
											
											<td>

											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="pdo_entry_product_detail_product_brand_id[]" id="pdo_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="pdo_entry_product_detail_product_id[]" id="pdo_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="pdo_entry_product_detail_id[]" id="pdo_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_id']?>" />
											<input type="hidden"  name="pdo_entry_product_detail_production_detail_id[]" id="pdo_entry_product_detail_production_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_production_detail_id']?>" />
											</td>

											<td>
											<?=$product_colour_name?>
											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_product_thick[]" id="pdo_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_thick']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_width_inches[]" id="pdo_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_width_mm[]" id="pdo_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_s_width_inches[]" id="pdo_entry_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />


											</td>

											<td>


											<input class="form-control" type="text"  name="pdo_entry_product_detail_s_width_mm[]" id="pdo_entry_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_s_width_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet[]" id="pdo_entry_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_sl_feet']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet_in[]" id="pdo_entry_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_sl_feet_in']?>" onKeyUp="GetLcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet_mm[]" id="pdo_entry_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_sl_feet_mm']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_qty[]" id="pdo_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['pdo_entry_product_detail_qty']?>" />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_tot_length[]" id="pdo_entry_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['pdo_entry_product_detail_tot_length']?>" readonly="" />

											</td>
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['pdo_entry_product_detail_id']?>&pdo_entry_uniq_id=<?php echo $pdo_entry_edit['pdo_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($pdo_entry_edit['pdo_entry_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">

											<td>

											<?=$product_code?>
											<input type="hidden"  name="pdo_entry_product_detail_product_type[]" id="pdo_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_type']?>" />

											</td>
											
											<td>

											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="pdo_entry_product_detail_product_brand_id[]" id="pdo_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="pdo_entry_product_detail_product_id[]" id="pdo_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="pdo_entry_product_detail_id[]" id="pdo_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_id']?>" />
											<input type="hidden"  name="pdo_entry_product_detail_production_detail_id[]" id="pdo_entry_product_detail_production_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_production_detail_id']?>" />
											</td>

											<td>
											<?=$product_uom_name?>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_product_thick[]" id="pdo_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_thick']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_width_inches[]" id="pdo_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_width_mm[]" id="pdo_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_qty[]" id="pdo_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['pdo_entry_product_detail_qty']?>" />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_s_weight_inches[]" id="pdo_entry_product_detail_s_weight_inches<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_s_weight_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_s_weight_mm[]" id="pdo_entry_product_detail_s_weight_mm<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_s_weight_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)"  />

											</td>



											

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['pdo_entry_product_detail_id']?>&pdo_entry_uniq_id=<?php echo $pdo_entry_edit['pdo_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($pdo_entry_edit['pdo_entry_type_id']==3){ ?>
										
										<tr class="ccs" style="display:none">

											<td>

											<?=$product_code?>
											<input type="hidden"  name="pdo_entry_product_detail_product_type[]" id="pdo_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_type']?>" />

											</td>
											
											<td>

											<?=$get_product_detail['brand_name']?>

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="pdo_entry_product_detail_product_id[]" id="pdo_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="pdo_entry_product_detail_id[]" id="pdo_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_id']?>" />
											<input type="hidden"  name="pdo_entry_product_detail_production_detail_id[]" id="pdo_entry_product_detail_production_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_production_detail_id']?>" />
											</td>

											<td>
											<?=$product_colour_name?>
											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_product_thick[]" id="pdo_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_product_thick']?>" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_width_inches[]" id="pdo_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_width_mm[]" id="pdo_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_s_width_inches[]" id="pdo_entry_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_s_width_mm[]" id="pdo_entry_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_s_width_mm']?>"  onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet[]" id="pdo_entry_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_sl_feet']?>" onKeyUp="GetWcalFeet(1,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet_in[]" id="pdo_entry_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_sl_feet_in']?>" onKeyUp="GetWcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet_mm[]" id="pdo_entry_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['pdo_entry_product_detail_sl_feet_mm']?>" onKeyUp="GetWcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_qty[]" id="pdo_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['pdo_entry_product_detail_qty']?>"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="pdo_entry_product_detail_tot_length[]" id="pdo_entry_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['pdo_entry_product_detail_tot_length']?>" readonly="" />

											</td>


											

											

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['pdo_entry_product_detail_id']?>&pdo_entry_uniq_id=<?php echo $pdo_entry_edit['pdo_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>
								</table>

								</div>

								<div class="col-lg-6">

										<input type="hidden"  name="pdo_entry_id" id="pdo_entry_id" value="<?=$pdo_entry_edit['pdo_entry_id']?>" />	

										<input type="hidden"  name="pdo_entry_uniq_id" id="pdo_entry_uniq_id" value="<?=$pdo_entry_edit['pdo_entry_uniq_id']?>" />	

									<button name="pdo_entry_update" type="submit" class="btn btn-success">Save  </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>

							</div>

						</div>

					</div>

				</div>

			<script type="text/javascript">
			getTableHeader(<?=$pdo_entry_edit['pdo_entry_type_id']?>);
			</script>

				</form>

				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Production Delivery List

                        </div>

                        <div class="panel-body">
						&nbsp;
						<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">

								<form action="index.php" method="post" id="pdo_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>INV.No.</th>

                                            <th>Date</th>

                                            <th>Delivery By</th>

                                            <th>Customer</th>

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="pdo_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

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

                                            <td><?=$get_quotation['pdo_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['pdo_entry_date'])?></td>

                                            <td><?=$arr_delivery_type[$get_quotation['pdo_entry_delivery_type']]?></td>

											<td><?=$get_quotation['customer_name']?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['pdo_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['pdo_entry_uniq_id']; ?>" type="checkbox" />

											</td>

                                        </tr>

									<?php } ?>

                                    </tbody>

                                </table>

								</form>

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

	<div class="panel-body">

                            

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

                                <div class="modal-dialog" style="width: 800px;">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>

                                        </div>

                                        <div class="modal-body">

											<div class="table-responsive">

												<div id="dynamic-content">

												</div>

											</div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="button" class="btn btn-primary" onClick="AddproductDetail()"  data-dismiss="modal">Save changes</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

	<div class="panel-body">

                            

                            <div class="modal fade" id="raw_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

                                <div class="modal-dialog" style="width: 800px;">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h4 class="modal-title" id="myModalLabel">Raw Product Details</h4>

                                        </div>

                                        <div class="modal-body">

											<div class="table-responsive">

												<div id="raw_product_content">

												</div>

											</div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="button" class="btn btn-primary" onClick="AddRawproductDetail()"  data-dismiss="modal">Save changes</button>

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

						<h4 class="modal-title" id="myModalLabel">Production Delivery Detail</h4>

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

        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>

    </div>

    <!-- /. FOOTER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

    <!-- JQUERY SCRIPTS -->

    



			<script>

				$(document).ready(function () {

					$('#dataTables-example').DataTable( {

						responsive: true

					} );

					/*$('#dataTables-example').dataTable();*/

				});
			$('#product_detail').DataTable( {
				scrollY:true,
				scrollX:true,
				scrollCollapse: true,
				paging: false,
				"searching": false,
				"info":false
			});
		//Initialize Select2 Elements

			$(".select2").select2();

			//$('.datatable').DataTable()

	//Date picker

   /* $('#pdo_entry_date').datepicker({

      autoclose: true

    });*/


$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#pdo_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
			});
			
		$( "#customer_form" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
		});	
		</script>



</body>

</html>

