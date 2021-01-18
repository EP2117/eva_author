<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery To Customer</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  deleted successfully</div>';
		}  
	}
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/delivery-customer/delivery-customer-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">DELIVERY TO CUSTOMER </h1>

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

								  	DELIVERY TO CUSTOMER  Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="control-label">D.O No.</label>
											<input type="text" class="form-control" name="delivery_customer_no" id="delivery_customer_no" value="" style="width:460px;" readonly="" required>
										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="delivery_customer_branch_id" id="delivery_customer_branch_id" class="form-control select2" style="width:100%" required>

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

											<select name="delivery_customer_customer_id" id="delivery_customer_customer_id" class="form-control select2" style="width:100%" required>

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

											<select name="delivery_customer_godown_id" id="delivery_customer_godown_id" class="form-control select2" style="width:100%">
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
											<input type="text" class="form-control" name="delivery_customer_vehicle_no" id="delivery_customer_vehicle_no" >
										</div>


									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="delivery_customer_date" id="delivery_customer_date" value="<?=date('d/m/Y')?>" required>

											</div>

										</div>

										<div class="form-group">

											<label>Address</label>

											 <textarea name="delivery_customer_address" id="delivery_customer_address" class="form-control" ></textarea>

										</div>
										<div class="form-group">
											
											<label>Driver Name</label>

											<input type="text" class="form-control" name="delivery_customer_driver_name" id="delivery_customer_driver_name" >

										</div>	
										<div class="form-group">
											
										<label>Delivery By</label>

										<input type="text" class="form-control" name="delivery_customer_delivery_type" id="delivery_customer_delivery_type" >

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

                                            <th style=" width:30%;">Inv No</th>

                                            <th  style=" width:25%;">Inv Date</th>

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

									<button name="delivery_customer_insert" type="submit" class="btn btn-success">Save </button>
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

								  	DELIVERY TO CUSTOMER  Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="delivery_customer_branch_id" id="delivery_customer_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$delivery_customer_edit['delivery_customer_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>
											
										</div>

										<div class="form-group">

											<label>Customer</label>

											<select name="delivery_customer_customer_id" id="delivery_customer_customer_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_prd_sec){

														$selected	= ($get_prd_sec['customer_id']==$delivery_customer_edit['delivery_customer_customer_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_prd_sec['customer_id']?>" <?=$selected?>><?=$get_prd_sec['customer_code']."-".$get_prd_sec['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<div class="form-group">

											<label>Warehouse</label>

											<select name="delivery_customer_godown_id" id="delivery_customer_godown_id" class="form-control select2" style="width:100%">
												<?php

													foreach($godown_list	as	$get_godown){

														$selected	= ($get_godown['godown_id']==$delivery_customer_edit['delivery_customer_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>
										<div class="form-group">
											<label>Vehicle Number</label>
											<input type="text" class="form-control" name="delivery_customer_vehicle_no" id="delivery_customer_vehicle_no" value="<?=$delivery_customer_edit['delivery_customer_vehicle_no']?>" />
										</div>
									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="delivery_customer_date" id="delivery_customer_date" value="<?=dateGeneralFormatN($delivery_customer_edit['delivery_customer_date'])?>">

											</div>

										</div>

										

										<div class="form-group">

											<label>Address</label>

											 <textarea name="delivery_customer_address" id="delivery_customer_address" class="form-control" ><?=$delivery_customer_edit['delivery_customer_address']?></textarea>

										</div>
										<div class="form-group">
											
											<label>Driver Name</label>

											<input type="text" class="form-control" name="delivery_customer_driver_name" id="delivery_customer_driver_name" value="<?=$delivery_customer_edit['delivery_customer_driver_name']?>" />

										</div>	
										<div class="form-group">
											
										<label>Delivery By</label>

										<input type="text" class="form-control" name="delivery_customer_delivery_type" id="delivery_customer_delivery_type" value="<?=$delivery_customer_edit['delivery_customer_delivery_type']?>" />

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

                                        <tr>

                                            <th style=" width:30%;">Invoice No</th>

                                            <th  style=" width:25%;">Invoice Date</th>

                                        </tr>

										

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr>

                                            <td style=" width:30%;"><?=$delivery_customer_edit['invoice_entry_no']?></th>

                                            <th  style=" width:25%;"><?=dateGeneralFormatN($delivery_customer_edit['invoice_entry_date'])?>

	<input type="hidden"  name="delivery_customer_invoice_entry_id" id="delivery_customer_invoice_entry_id" value='<?=$delivery_customer_edit['delivery_customer_invoice_entry_id']?>'  class='dc_id'  />										
<input type="hidden"  name="delivery_customer_prd_type" id="delivery_customer_prd_type" value='<?=$delivery_customer_edit['invoice_entry_type_id']?>'  class=''  />
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
								 <table class="table table-striped table-bordered table-hover" id="product_detail_rls"  style="width:100%;display:none" ><!--display:none-->

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

										$arr_cnt	= count($delivery_customer_prd_edit);
										
										foreach($delivery_customer_prd_edit as $get_product_detail){
											if($get_product_detail['delivery_customer_product_detail_entry_type']==1){ 
											?>
										<tr>	
											<td>
<input type="hidden"  name="delivery_customer_product_detail_product_type[]" id="delivery_customer_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_product_type']?>" />
<input type="hidden"  name="delivery_customer_product_detail_entry_type[]" id="delivery_customer_product_detail_entry_type<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_entry_type']?>" />
											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="delivery_customer_product_detail_product_brand_id[]" id="delivery_customer_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_product_brand_id']?>" />
											</td>
											<td>
											<?=$get_product_detail['product_name']?>
											<input type="hidden"  name="delivery_customer_product_detail_product_id[]" id="delivery_customer_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_product_id']?>"  />
											<input type="hidden"  name="delivery_customer_product_detail_id[]" id="delivery_customer_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_id']?>" />

											</td>
											<td>
											<?=$get_product_detail['p_colour_name']?>
											<input type="hidden"  name="delivery_customer_product_detail_color_id[]" id="delivery_customer_product_detail_color_id<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_color_id']?>"   />
											</td>
											<td>
											<input type="hidden"  name="delivery_customer_product_detail_product_thick[]" id="delivery_customer_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_product_thick']?>"   />
											<input class="form-control" type="text"  name="delivery_customer_product_detail_product_thick_val[]" id="delivery_customer_product_detail_product_thick_val<?=$row_cnt?>" value="<?=$arr_thick[$get_product_detail['delivery_customer_product_detail_product_thick']]?>"   />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_width_inches[]" id="delivery_customer_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_width_mm[]" id="delivery_customer_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_s_width_inches[]" id="delivery_customer_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_s_width_mm[]" id="delivery_customer_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_s_width_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_sl_feet[]" id="delivery_customer_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_sl_feet']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_sl_feet_in[]" id="delivery_customer_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_sl_feet_in']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_sl_feet_mm[]" id="delivery_customer_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_sl_feet_mm']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_sl_feet_met[]" id="delivery_customer_product_detail_sl_feet_met<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_sl_feet_met']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_qty[]" id="delivery_customer_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['delivery_customer_product_detail_qty']?>"  onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>
											<td>
											<input class="form-control" type="text"  name="delivery_customer_product_detail_tot_length[]" id="delivery_customer_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['delivery_customer_product_detail_tot_length']?>" readonly="" />
											</td>
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['delivery_customer_product_detail_id']?>&delivery_customer_uniq_id=<?php echo $delivery_customer_edit['delivery_customer_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
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
										foreach($delivery_customer_prd_edit as $get_product_detail){
											if($get_product_detail['delivery_customer_product_detail_entry_type']==2){ 
											?>
										<tr>	
											<td><?=$get_product_detail['brand_name']?></td>
											 <td><?=$get_product_detail['product_name']?>
											 <input type="hidden"  name="delivery_customer_product_detail_id[]" id="delivery_customer_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_id']?>" />
											 <input type="hidden"  name="delivery_customer_product_detail_product_id[]" id="delivery_customer_product_detail_product_id" value="<?=$get_product_detail['delivery_customer_product_detail_product_id']?>" />
											 <input type="hidden"  name="delivery_customer_product_detail_product_type[]" id="delivery_customer_product_detail_product_type" value="<?=$get_product_detail['delivery_customer_product_detail_product_type']?>" />
											 <input type="hidden"  name="delivery_customer_product_detail_invoice_detail_id[]" id="delivery_customer_product_detail_invoice_detail_id" value="<?=$get_product_detail['delivery_customer_product_detail_invoice_detail_id']?>" />
											 <input type="hidden"  name="delivery_customer_product_detail_entry_type[]" id="delivery_customer_product_detail_entry_type" value="<?=$get_product_detail['delivery_customer_product_detail_entry_type']?>" /></td>
													
												<td><?=$get_product_detail['p_colour_name']?><input type="hidden"  name="delivery_customer_product_detail_color_id[]" id="delivery_customer_product_detail_color_id<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_color_id']?>"   /></td>
													
												<td><?=$arr_thick[$get_product_detail['delivery_customer_product_detail_product_thick']]?></td>
													 
												<td><input class="form-control" type="text"  name="delivery_customer_product_detail_width_inches[]" id="delivery_customer_product_detail_width_inches<?=$row_cnt?>"  onkeyup="GetLcalc(2,<?=$row_cnt?>)" value="<?=$get_product_detail['delivery_customer_product_detail_width_inches']?>"  /></td> 
												<td><input class="form-control" type="text"  name="delivery_customer_product_detail_width_mm[]" id="delivery_customer_product_detail_width_mm<?=$row_cnt?>"   onkeyup="GetLcalc(3,<?=$row_cnt?>)" value="<?=$get_product_detail['delivery_customer_product_detail_width_mm']?>"  /></td>
																										
												<td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_width_inches[]" id="delivery_customer_product_detail_s_width_inches<?=$row_cnt?>"   onkeyup="GetLcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['delivery_customer_product_detail_s_width_inches']?>" /></td> 
												<td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_width_mm[]" id="delivery_customer_product_detail_s_width_mm<?=$row_cnt?>" onKeyUp="GetLcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['delivery_customer_product_detail_s_width_mm']?>" />
												<input type="hidden"  name="delivery_customer_product_detail_qty[]" id="delivery_customer_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['delivery_customer_product_detail_qty']?>" /></td>
													
												<td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_weight_inches[]" id="delivery_customer_product_detail_s_weight_inches<?=$row_cnt?>"  onblur="GetWeightClc(1,<?=$row_cnt?>)"   value="<?=$get_product_detail['delivery_customer_product_detail_s_weight_inches']?>"   /></td> 
												<td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_weight_mm[]" id="delivery_customer_product_detail_s_weight_mm<?=$row_cnt?>"  onblur="GetWeightClc(2,<?=$row_cnt?>)"  value="<?=$get_product_detail['delivery_customer_product_detail_s_weight_mm']?>"   /></td>
																					<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['delivery_customer_product_detail_id']?>&delivery_customer_uniq_id=<?php echo $delivery_customer_edit['delivery_customer_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
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
										foreach($delivery_customer_prd_edit as $get_product_detail){
											if($get_product_detail['delivery_customer_product_detail_entry_type']==4){  //echo 'dfsg';exit;
											?>
										<tr>	
											
											 <td><?=$get_product_detail['product_name']?>
											 <input type="hidden"  name="delivery_customer_product_detail_id[]" id="delivery_customer_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_id']?>" />
											 <input type="hidden"  name="delivery_customer_product_detail_product_id[]" id="delivery_customer_product_detail_product_id" value="<?=$get_product_detail['delivery_customer_product_detail_product_id']?>" />
	<input type="hidden"  name="delivery_customer_product_detail_product_type[]" id="delivery_customer_product_detail_product_type" value="<?=$get_product_detail['delivery_customer_product_detail_product_type']?>" />
	<input type="hidden"  name="delivery_customer_product_detail_invoice_detail_id[]" id="delivery_customer_product_detail_invoice_detail_id" value="<?=$get_product_detail['delivery_customer_product_detail_invoice_detail_id']?>" />
	<input type="hidden"  name="delivery_customer_product_detail_entry_type[]" id="delivery_customer_product_detail_entry_type" value="<?=$get_product_detail['delivery_customer_product_detail_entry_type']?>" />
											
											</td>
													
											<td><?=$get_product_detail['p_uom_name']?></td>
			
			<td><input class="form-control" type="text"  name="delivery_customer_product_detail_qty[]" id="delivery_customer_product_detail_qty<?=$row_cnt?>" value="<?=$get_product_detail['delivery_customer_product_detail_qty']?>"  /></td>
													
												
												<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['delivery_customer_product_detail_id']?>&delivery_customer_uniq_id=<?php echo $delivery_customer_edit['delivery_customer_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
											</tr>
											
											<?php $row_cnt++;} }?>
									</tbody>

								</table>

                                

								

								</div>

								<!--<div class="col-lg-6">

										<div class="form-group">

											<label>Vehicle Number</label>

											<input type="text" class="form-control" name="delivery_customer_vehicle_no" id="delivery_customer_vehicle_no" value="<?=$delivery_customer_edit['delivery_customer_vehicle_no']?>" / >

										</div>

										<div class="form-group">

											<label>Delivery  Person Name</label>

											<input type="text" class="form-control" name="delivery_customer_person_name" id="delivery_customer_person_name" value="<?=$delivery_customer_edit['delivery_customer_person_name']?>" /  >

										</div>

										

										

									</div>

								<div class="col-lg-6">

										<div class="form-group">

											<label>Driver Name</label>

											<input type="text" class="form-control" name="delivery_customer_driver_name" id="delivery_customer_driver_name" value="<?=$delivery_customer_edit['delivery_customer_driver_name']?>" / >

										</div>

										<div class="form-group">

											<label>Time</label>

											<input type="time" class="form-control" name="delivery_customer_time" id="delivery_customer_time" value="<?=$delivery_customer_edit['delivery_customer_time']?>" / >

										</div>

									</div>-->

								<div class="col-lg-6">

										<input type="hidden"  name="delivery_customer_id" id="delivery_customer_id" value="<?=$delivery_customer_edit['delivery_customer_id']?>" />	

										<input type="hidden"  name="delivery_customer_uniq_id" id="delivery_customer_uniq_id" value="<?=$delivery_customer_edit['delivery_customer_uniq_id']?>" />	

									<button name="delivery_customer_update" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
								</div>

							</div>

						</div>

					</div>

				</div>       

				

				</form>
			<script type="text/javascript">
			getTableHeader('<?=$delivery_customer_edit['delivery_customer_type_id']?>');
			</script>

				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           DELIVERY TO CUSTOMER  List

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

											<label class="control-label">Customer</label>

											<select name="customerid" id="customerid" class="form-control select2" style="width:100%"  >

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){
													//$selected	= ($get_branch['customer_id']==searchValue('customerid'))?'selected="selected"':'';

												?>

							          <option value="<?=$get_customer['customer_id']?>" <?php if(searchValue('customerid')==$get_customer['customer_id']) {?> selected="selected" <?php }?>><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>

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
                        <div class="panel-body">
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">
							<?php if(isset($_REQUEST['search'])){?>

								<form action="index.php" method="post" id="delivery_customer_list_form" name="_list_form" >

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

												<button name="delivery_customer_entry_delete" type="submit" class="btn btn-danger">Delete</button>

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

                                            <td><?=$get_quotation['branch_prefix'].$get_quotation['delivery_customer_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['delivery_customer_date'])?></td>

											<td><?=$get_quotation['customer_name']?></td>
											<td><a href="delivery-print.php?id=<?php echo $get_quotation['delivery_customer_uniq_id']?>" title="DELIVERY PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['delivery_customer_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['delivery_customer_uniq_id']; ?>" type="checkbox" />

											</td>

                                        </tr>

									<?php } ?>

                                    </tbody>

                                </table>

								</form>
								<?php }?>

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

						<h4 class="modal-title" id="myModalLabel">DELIVERY TO CUSTOMER  Detail</h4>

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

        <?=PROJECT_FOOTER?>

    </div>

    <!-- /. FOOTER  -->

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

			//Date picker


			$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#delivery_customer_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
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

