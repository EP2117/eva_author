<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gatepass Entry</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Gatepass Entry  added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Gatepass Entry  updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Gatepass Entry  deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Gatepass Entry  Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Gatepass Entry  deleted successfully</div>';
		}  
	}
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/gatepass-entry/gatepass-entry-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Gatepass Entry </h1>

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

				<form name="customer_form" method="post" id="customer_form" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Gatepass Entry  Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="control-label">D.O No.</label>
											<input type="text" class="form-control" name="gatepass_entry_no" id="gatepass_entry_no" value="<?=$gatepass_entry_no;?>" style="width:460px;" readonly="" required>
										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="gatepass_entry_branch_id" id="gatepass_entry_branch_id" class="form-control select2" style="width:100%" required >

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

											<label class="control-label">Customer</label>

											<select name="gatepass_entry_customer_id" id="gatepass_entry_customer_id" class="form-control select2" style="width:100%" required>

												<option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){

												?>

												<option value="<?=$get_customer['customer_id']?>"><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label >Warehouse</label>

											<select name="gatepass_entry_godown_id" id="gatepass_entry_godown_id" class="form-control select2" style="width:100%">
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
											<label>Vehicle Number</label>
											<input type="text" class="form-control" name="gatepass_entry_vehicle_no" id="gatepass_entry_vehicle_no" >
										</div>


									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="gatepass_entry_date" id="gatepass_entry_date" value="<?=date('d/m/Y')?>" required>

											</div>

										</div>

										<div class="form-group">

											<label>Address</label>

											 <textarea name="gatepass_entry_address" id="gatepass_entry_address" class="form-control" ></textarea>

										</div>
										<div class="form-group">
											
																						<label>Driver Name</label>
											
																						<input type="text" class="form-control" name="gatepass_entry_driver_name" id="gatepass_entry_driver_name" >
											
																					</div>	
										<div class="form-group">
											
										<label>Delivery By</label>

										<input type="text" class="form-control" name="gatepass_entry_delivery_type" id="gatepass_entry_delivery_type" >

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

                                              <th style=" width:30%;">Del Cus No</th>

                                            <th  style=" width:25%;">Del Cus Date</th>

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


								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="product_detail_rls"  style="width:100%;display:none" >

                                    <thead>

                                         <tr>

											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="4"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>
                                        </tr>

										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>M</th>
										</tr>

                                    </thead>
                                    <tbody id="product_detail_rls_display">
									</tbody>
								</table>

                                <table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:none" >

                                    
									<thead>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> INCHES</th>
											<th> MM</th>
											<th> TON</th>
											<th> KG</th>
										</tr>

                                    </thead>
                                    <tbody id="product_detail_rws_display">

									

									</tbody>

								</table>

                                <table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%;display:none" >
                                    
									<thead>
                                         <tr>
                                            <th style="vertical-align:middle;">NAME</th>
                                            <th style="vertical-align:middle;">UOM</th>
											<th style="vertical-align:middle;">QTY</th>
                                        </tr>

                                    </thead>

                                    <tbody id="product_detail_as_display">
									</tbody>

								</table>

								</div>
								<div class="col-lg-12">

									<button name="gatepass_entry_insert" type="submit" class="btn btn-success">Save </button>
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

				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Gatepass Entry  Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="gatepass_entry_branch_id" id="gatepass_entry_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$gatepass_entry_edit['gatepass_entry_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Customer</label>

											<select name="gatepass_entry_customer_id" id="gatepass_entry_customer_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_prd_sec){

														$selected	= ($get_prd_sec['customer_id']==$gatepass_entry_edit['gatepass_entry_customer_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_prd_sec['customer_id']?>" <?=$selected?>><?=$get_prd_sec['customer_code']."-".$get_prd_sec['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<div class="form-group">

											<label>Warehouse</label>

											<select name="gatepass_entry_godown_id" id="gatepass_entry_godown_id" class="form-control select2" style="width:100%">
												<?php

													foreach($godown_list	as	$get_godown){

														$selected	= ($get_godown['godown_id']==$gatepass_entry_edit['gatepass_entry_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>
										<div class="form-group">
											<label>Vehicle Number</label>
											<input type="text" class="form-control" name="gatepass_entry_vehicle_no" id="gatepass_entry_vehicle_no" value="<?=$gatepass_entry_edit['gatepass_entry_vehicle_no']?>" />
										</div>

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="gatepass_entry_date" id="gatepass_entry_date" value="<?=dateGeneralFormatN($gatepass_entry_edit['gatepass_entry_date'])?>">

											</div>

										</div>

										

										<div class="form-group">

											<label>Address</label>

											 <textarea name="gatepass_entry_address" id="gatepass_entry_address" class="form-control" ><?=$gatepass_entry_edit['gatepass_entry_address']?></textarea>

										</div>
										<div class="form-group">
											
											<label>Driver Name</label>

											<input type="text" class="form-control" name="gatepass_entry_driver_name" id="gatepass_entry_driver_name"  value="<?=$gatepass_entry_edit['gatepass_entry_driver_name']?>"/>

										</div>	
										<div class="form-group">
											
										<label>Delivery By</label>

										<input type="text" class="form-control" name="gatepass_entry_delivery_type" id="gatepass_entry_delivery_type"  value="<?=$gatepass_entry_edit['gatepass_entry_delivery_type']?>"/>

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

                                        <tr>

                                            <th style=" width:30%;">Del Cus No</th>

                                            <th  style=" width:25%;">Del Cus Date</th>

                                        </tr> 

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr>

                                            <td style=" width:30%;"><?=$gatepass_entry_edit['delivery_customer_no']?></th>

                                            <th  style=" width:25%;"><?=dateGeneralFormatN($gatepass_entry_edit['delivery_customer_date'])?>

											<input type="hidden"  name="gatepass_entry_invoice_entry_id" id="gatepass_entry_invoice_entry_id" value='<?=$gatepass_entry_edit['gatepass_entry_invoice_entry_id']?>'  class='dc_id'  />

											</th>

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
								
								 <table class="table table-striped table-bordered table-hover" id="product_detail_rls"  style="width:100%;display:none" > <!--display:none-->

                                    <thead>

                                        <tr>

											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="4"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>
                                        </tr>

										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>M</th>
										</tr>

                                    </thead>
                                    <tbody id="product_detail_rls_display">
									
									<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($gatepass_entry_prd_edit);
										
										foreach($gatepass_entry_prd_edit as $get_product_detail){
											if($get_product_detail['gatepass_entry_product_detail_entry_type']==1){ 
											$product_brand_name =$get_product_detail['brand_name'];
											$product_name =$get_product_detail['product_name'];
											$product_colour_name =$get_product_detail['p_colour_name'];
											$product_thick_ness_val =$arr_thick[$get_product_detail['gatepass_entry_product_detail_product_thick']];
											?>
										<tr class="rls" ><!--style="display:none"-->
											<td><?=$product_brand_name?><input type="hidden"  name="gatepass_entry_product_detail_id[]" id="gatepass_entry_product_detail_id" value="<?=$get_product_detail['gatepass_entry_product_detail_id']?>" /></td> 
											<td><?=$product_name?> 
											<input type="hidden"  name="gatepass_entry_product_detail_product_id[]" id="gatepass_entry_product_detail_product_id" value="<?=$get_product_detail['gatepass_entry_product_detail_product_id']?>" />
											<input type="hidden"  name="gatepass_entry_product_detail_product_type[]" id="gatepass_entry_product_detail_product_type" value="<?=$get_product_detail['gatepass_entry_product_detail_product_type']?>" />
											<input type="hidden"  name="gatepass_entry_product_detail_delivery_detail_id[]" id="gatepass_entry_product_detail_delivery_detail_id" value="<?=$get_product_detail['gatepass_entry_product_detail_delivery_detail_id']?>" />
											<input type="hidden"  name="gatepass_entry_product_detail_entry_type[]" id="gatepass_entry_product_detail_entry_type" value="<?=$get_product_detail['gatepass_entry_product_detail_entry_type']?>" /></td>
											
											<td><?=$product_colour_name?><input type="hidden"  name="gatepass_entry_product_detail_color_id[]" id="gatepass_entry_product_detail_color_id<?=$row_cnt?>" value="<?=$get_product_detail['gatepass_entry_product_detail_color_id']?>"   /></td>
											
											<td><?=$product_thick_ness_val?><input type="hidden"  name="gatepass_entry_product_detail_product_thick[]" id="gatepass_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['gatepass_entry_product_detail_product_thick']?>"   /></td>
											
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_width_inches[]" onBlur="GetTotalLength(<?=$row_cnt?>)"  id="gatepass_entry_product_detail_width_inches<?=$row_cnt?>"  onkeyup="GetLcalc(2,<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_width_inches']?>"  /></td> 
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_width_mm[]" id="gatepass_entry_product_detail_width_mm<?=$row_cnt?>"  onkeyup="GetLcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_width_mm']?>"  /></td>
											
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_width_inches[]" id="gatepass_entry_product_detail_s_width_inches<?=$row_cnt?>"   onkeyup="GetLcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_s_width_inches']?>" /></td> 
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_width_mm[]" id="gatepass_entry_product_detail_s_width_mm<?=$row_cnt?>" onKeyUp="GetLcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_s_width_mm']?>" /></td>
											
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_sl_feet[]" id="gatepass_entry_product_detail_sl_feet<?=$row_cnt?>" onblur="GetLcalFeet(1,<?=$row_cnt?>)"   onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_sl_feet']?>"  /></td>  
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_sl_feet_in[]" id="gatepass_entry_product_detail_sl_feet_in<?=$row_cnt?>" onblur="GetLcalFeet(1,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  value="<?=$get_product_detail['gatepass_entry_product_detail_sl_feet_in']?>"  /> </td> 
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_sl_feet_mm[]" id="gatepass_entry_product_detail_sl_feet_mm<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_sl_feet_mm']?>"  />  </td>  
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_sl_feet_met[]" id="gatepass_entry_product_detail_sl_feet_met<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_sl_feet_met']?>"  />   
											<input type="hidden" name="gatepass_entry_product_detail_s_weight_inches[]" id="gatepass_entry_product_detail_s_weight_inches<?=$row_cnt?>" value="<?=$get_product_detail['gatepass_entry_product_detail_s_weight_inches']?>"   />
											<input type="hidden"  name="gatepass_entry_product_detail_s_weight_mm[]" id="gatepass_entry_product_detail_s_weight_mm<?=$row_cnt?>"  value="<?=$get_product_detail['gatepass_entry_product_detail_s_weight_mm']?>"   /></td>
											
											<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_qty[]" id="gatepass_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['gatepass_entry_product_detail_qty']?>"  onBlur="GetTotalLength(<?=$row_cnt?>)" /></td>
											 <td><input class="form-control" type="text"  name="gatepass_entry_product_detail_tot_length[]" id="gatepass_entry_product_detail_tot_length<?=$row_cnt?>" readonly value="<?=$get_product_detail['gatepass_entry_product_detail_tot_length']?>"   /></td>
											
											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['gatepass_entry_product_detail_id']?>&gatepass_entry_uniq_id=<?php echo $gatepass_entry_edit['gatepass_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php $row_cnt++;} }?>
									
									
									</tbody>
								</table>

                                <table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:none" ><!--display:none-->

                                    
									<thead>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> INCHES</th>
											<th> MM</th>
											<th> TON</th>
											<th> KG</th>
										</tr>

                                    </thead>
                                    <tbody id="product_detail_rws_display">

									<?php 
										foreach($gatepass_entry_prd_edit as $get_product_detail){
											if($get_product_detail['gatepass_entry_product_detail_entry_type']==2){ 
											$product_brand_name =$get_product_detail['brand_name'];
											$product_name =$get_product_detail['product_name'];
											$product_colour_name =$get_product_detail['p_colour_name'];
											$product_thick_ness_val =$arr_thick[$get_product_detail['gatepass_entry_product_detail_product_thick']];
											?>
										<tr class="rls" ><!--style="display:none"-->
											
										<td><?=$product_brand_name?><input type="hidden"  name="gatepass_entry_product_detail_id[]" id="gatepass_entry_product_detail_id" value="<?=$get_product_detail['gatepass_entry_product_detail_id']?>" /></td>
										<td><?=$product_name?><input type="hidden"  name="gatepass_entry_product_detail_product_id[]" id="gatepass_entry_product_detail_product_id" value="<?=$get_product_detail['gatepass_entry_product_detail_product_id']?>" />
										<input type="hidden"  name="gatepass_entry_product_detail_product_type[]" id="gatepass_entry_product_detail_product_type" value="<?=$get_product_detail['gatepass_entry_product_detail_product_type']?>" />
										<input type="hidden"  name="gatepass_entry_product_detail_delivery_detail_id[]" id="gatepass_entry_product_detail_delivery_detail_id" value="<?=$get_product_detail['gatepass_entry_product_detail_delivery_detail_id']?>" />
										<input type="hidden"  name="gatepass_entry_product_detail_entry_type[]" id="gatepass_entry_product_detail_entry_type" value="<?=$get_product_detail['gatepass_entry_product_detail_entry_type']?>" /></td>
										
										<td><?=$product_colour_name?>
										<input type="hidden"  name="gatepass_entry_product_detail_color_id[]" id="gatepass_entry_product_detail_color_id<?=$row_cnt?>" value="<?=$get_product_detail['gatepass_entry_product_detail_color_id']?>"   /></td>
										
										<td><?=$product_thick_ness_val?>
										<input type="hidden"  name="gatepass_entry_product_detail_product_thick[]" id="gatepass_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['gatepass_entry_product_detail_product_thick']?>"   /></td>
										
										<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_width_inches[]" id="gatepass_entry_product_detail_width_inches<?=$row_cnt?>"  onkeyup="GetLcalc(2,<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_width_inches']?>"  /></td> 
										<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_width_mm[]" id="gatepass_entry_product_detail_width_mm<?=$row_cnt?>"   onkeyup="GetLcalc(3,<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_width_mm']?>"  /></td>
										
										
										
										<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_width_inches[]" id="gatepass_entry_product_detail_s_width_inches<?=$row_cnt?>"   onkeyup="GetLcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_s_width_inches']?>" /></td> 
										<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_width_mm[]" id="gatepass_entry_product_detail_s_width_mm<?=$row_cnt?>" onKeyUp="GetLcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gatepass_entry_product_detail_s_width_mm']?>" />
										<input type="hidden"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_qty']?>" /></td>
										
										<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_weight_inches[]" id="gatepass_entry_product_detail_s_weight_inches<?=$row_cnt?>"   onblur="GetWeightClc(1,<?=$row_cnt?>)"  value="<?=$get_product_detail['gatepass_entry_product_detail_s_weight_inches']?>"   /></td> 
										<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_weight_mm[]" id="gatepass_entry_product_detail_s_weight_mm<?=$row_cnt?>"   onblur="GetWeightClc(2,<?=$row_cnt?>)"  value="<?=$get_product_detail['gatepass_entry_product_detail_s_weight_mm']?>"   /></td>
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['gatepass_entry_product_detail_id']?>&gatepass_entry_uniq_id=<?php echo $gatepass_entry_edit['gatepass_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php $row_cnt++;} }?>

									</tbody>

								</table>

                                <table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%;display:none" ><!--display:none-->
                                    
									<thead>
                                         <tr>
                                            <th style="vertical-align:middle;">NAME</th>
                                            <th style="vertical-align:middle;">UOM</th>
											<th style="vertical-align:middle;">QTY</th>
                                        </tr>

                                    </thead> 

                                    <tbody id="product_detail_as_display">
									
									<?php 
										foreach($gatepass_entry_prd_edit as $get_product_detail){
											if($get_product_detail['gatepass_entry_product_detail_entry_type']==4){ 
											$product_brand_name =$get_product_detail['brand_name'];
											$product_uom =$get_product_detail['p_uom_name'];
											
											?>
										<tr class="rls" ><!--style="display:none"-->
										<td><?=$product_name?><input type="hidden"  name="gatepass_entry_product_detail_id[]" id="gatepass_entry_product_detail_id" value="<?=$get_product_detail['gatepass_entry_product_detail_id']?>" />
										<input type="hidden"  name="gatepass_entry_product_detail_product_id[]" id="gatepass_entry_product_detail_product_id" value="<?=$get_product_detail['gatepass_entry_product_detail_product_id']?>" />
										<input type="hidden"  name="gatepass_entry_product_detail_product_type[]" id="gatepass_entry_product_detail_product_type" value="<?=$get_product_detail['gatepass_entry_product_detail_product_type']?>" />
										<input type="hidden"  name="gatepass_entry_product_detail_delivery_detail_id[]" id="gatepass_entry_product_detail_delivery_detail_id" value="<?=$get_product_detail['gatepass_entry_product_detail_delivery_detail_id']?>" />
										<input type="hidden"  name="gatepass_entry_product_detail_entry_type[]" id="gatepass_entry_product_detail_entry_type" value="<?=$get_product_detail['gatepass_entry_product_detail_entry_type']?>" /></td>
										<td><?=$product_uom?></td>
										<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_qty[]" id="gatepass_entry_product_detail_qty<?=$row_cnt?>" value="<?=$get_product_detail['gatepass_entry_product_detail_qty']?>"   /></td>
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['gatepass_entry_product_detail_id']?>&gatepass_entry_uniq_id=<?php echo $gatepass_entry_edit['gatepass_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
										</tr>
										
										<?php $row_cnt++;} }?>
									</tbody>

								</table>
								</div>

								<div class="col-lg-6">

										<input type="hidden"  name="gatepass_entry_id" id="gatepass_entry_id" value="<?=$gatepass_entry_edit['gatepass_entry_id']?>" />	

										<input type="hidden"  name="gatepass_entry_uniq_id" id="gatepass_entry_uniq_id" value="<?=$gatepass_entry_edit['gatepass_entry_uniq_id']?>" />	

									<button name="gatepass_entry_update" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
								</div>

							</div>

						</div>

					</div>

				</div>

				

				</form>
			<script type="text/javascript">
			getTableHeader('<?=$gatepass_entry_edit['gatepass_entry_type_id']?>');
			</script>

				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Gatepass Entry  List

                        </div>

                        <div class="panel-body">
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">

								<form action="index.php" method="post" id="gatepass_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>INV.No.</th>

                                            <th>Date</th>

                                            <th>Customer</th>
											
											<th>Print</th>

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="gatepass_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

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

                                            <td><?=$get_quotation['gatepass_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['gatepass_entry_date'])?></td>

											<td><?=$get_quotation['customer_name']?></td>
											<td><a href="gatepass-print.php?id=<?php echo $get_quotation['gatepass_entry_uniq_id']?>" title="GATEPASS PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
                                            <td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_quotation['gatepass_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['gatepass_entry_uniq_id']; ?>" type="checkbox" />

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
		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Gatepass Entry  Detail</h4>

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
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
    <!-- /. WRAPPER  -->

    <div id="footer-sec">

        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>

    </div>

    <!-- /. FOOTER  -->

		<script>

				$(document).ready(function () {
					$('#dataTables-example').DataTable( {
						responsive: true
					} );
					/*$('#dataTables-example').dataTable();*/
				});

				//Initialize Select2 Elements

			$(".select2").select2();

			//Date picker


			$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#gatepass_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
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

