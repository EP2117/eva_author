<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>QUOTATION</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry deleted successfully</div>';

		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/quotation-entry/quotation-entry-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/sales-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Quotation Entry</h1>

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

								  	Quotation Entry Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="control-label">Quotation No.</label>
											<input type="text" class="form-control" name="quotation_entry_no" id="quotation_entry_no" value="<?=$quotation_entry_no?>" style="width:460px;" readonly="" required>
										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="quotation_entry_branch_id" id="quotation_entry_branch_id" class="form-control select2" style="width:100%" required>

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

											<select name="quotation_entry_customer_id" id="quotation_entry_customer_id" class="form-control select2" style="width:100%" required>

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

											<label class="control-label">Type</label><br/>	

											
											
											<?php
													foreach($arrQuotationType as $key => $value){
												?>

							<input type="checkbox" name="quotation_entry_type_id[]"  id="quotation_entry_type_id<?=$key?>" value="<?=$key?>" onClick="getTableHeader(this.value)" /> <?=$value?><br/>

												<?php
													}
												?>

										</div>

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="quotation_entry_date" id="quotation_entry_date" required>

											</div>

										</div>

										<div class="form-group">

											<label>Validity Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="quotation_entry_validity_date" id="quotation_entry_validity_date" >

											</div>

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
									<div  style="width:100%; overflow:scroll">
									<table class="table table-striped table-bordered table-hover" id="product_detail_rls" style="display:none">
										<thead>
										<tr>
											<td colspan="16">
										<button type="button" onClick="GetDetail('1');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
										</td>
										</tr>
	
											 <tr>
												<th rowspan="2" style="vertical-align:middle;"> BRAND </th>
												<th rowspan="2" style="vertical-align:middle;"> NAME </th>
												<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
												<th rowspan="2" style="vertical-align:middle;"> THICK</th>
												<th colspan="2"> WIDTH rew</th>
												<th colspan="2"> SALES WIDTH</th>
												<th colspan="4"> SALES LENGTH</th>
												<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Length &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											</tr>
											<tr>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FEET &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FT.IN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											</tr>
										</thead>
										<tbody id="product_detail_rls_display">
										</tbody>
									</table>
									</div>
									<div  style="width:100%; overflow:scroll">
									<table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:none">
										<thead>
											<tr>
												<td colspan="16"><button type="button" onClick="GetDetail('2');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
											</tr>
											 <tr>
												<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
												<th rowspan="2" style="vertical-align:middle;"> NAME</th>
												<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
												<th rowspan="2" style="vertical-align:middle;"> THICK</th>
												<th colspan="2"> WIDTH</th>
												<th colspan="2"> SALES WIDTH</th>
												<th colspan="2"> SALES WEIGHT</th>
												<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											</tr>
											<tr>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											</tr>
										</thead>
										<tbody id="product_detail_rws_display">
										</tbody>
	
									</table>
									</div>
									<table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%; display:none" >
										
										<thead >
											<tr>
												<td colspan="16"><button type="button" onClick="GetDetail('4');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
											</tr>
											 <tr>
	
	
												<th style="vertical-align:middle;">NAME</th>
	
												<th style="vertical-align:middle;">UOM</th>
	
												<th style="vertical-align:middle;">QTY</th>
	
												<th style="vertical-align:middle;">Rate</th>
	
												<th style="vertical-align:middle;">TOTAL</th>
	
											</tr>
	
										</thead>
	
										<tbody id="product_detail_as_display">
	
										
	
										</tbody>
	
									</table>
									<table class="table table-striped table-bordered table-hover" style=" width:100%" >
	
										<tr>
	
											<td style="width:50%">&nbsp;</td>
	
											<td colspan="2">Gross</td>
	
											<td style="width:20%"><input type="text" class="form-control" name="quotation_entry_gross_amount" id="quotation_entry_gross_amount"  value="0.00"></td>
	
										</tr>
	
										<tr>
	
											<td style="width:50%">&nbsp;</td>
	
											<td colspan="2">Transportation Charges</td>
	
											<td><input type="text" class="form-control" name="quotation_entry_transport_amount" id="quotation_entry_transport_amount" value="0.00" onBlur="totalAmount()" ></td>
	
										</tr>
										<tr>

										<td style="width:50%">&nbsp;</td>

										<td>Dis</td>

										<td style="width:20%"><input type="text" class="form-control" name="quotation_entry_dis_per" id="quotation_entry_dis_per" onBlur="totalAmount()" value="0"></td>

										<td><input type="text" class="form-control" name="quotation_entry_dis_amount" id="quotation_entry_dis_amount" value="0.00" ></td>

									</tr>
										<tr>
	
											<td style="width:50%">&nbsp;</td>
	
											<td>Tax</td>
	
											<td style="width:20%"><input type="text" class="form-control" name="quotation_entry_tax_per" value="21" id="quotation_entry_tax_per" onBlur="totalAmount()"  ></td>
	
											<td><input type="text" class="form-control" name="quotation_entry_tax_amount" id="quotation_entry_tax_amount"  value="0.00"></td>
	
										</tr>
	
										<tr>
	
											<td style="width:50%">&nbsp;</td>
	
											<td colspan="2">Advance</td>
	
											<td><input type="text" class="form-control" name="quotation_entry_advance_amount" id="quotation_entry_advance_amount" onBlur="totalAmount()"  value="0.00"></td>
	
										</tr>
	
										<tr>
	
											<td style="width:50%">&nbsp;</td>
	
											<td colspan="2">Total</td>
	
											<td><input type="text" class="form-control" name="quotation_entry_net_amount" id="quotation_entry_net_amount"  value="0.00" ></td>
	
										</tr>
	
									</table>
								
								</div>

								

								<div class="col-lg-6">

									<button name="quotation_entry_insert" type="submit" class="btn btn-success">Save </button>
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

								  	Quotation Entry Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Quotation No.</label>
											<input type="text" class="form-control" name="quotation_entry_no" id="quotation_entry_no" style="width:460px;" value="<?=$quotation_entry_edit['quotation_entry_no']?>" >
										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="quotation_entry_branch_id" id="quotation_entry_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$quotation_entry_edit['quotation_entry_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Production Section</label>

											<select name="quotation_entry_customer_id" id="quotation_entry_customer_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_prd_sec){

														$selected	= ($get_prd_sec['customer_id']==$quotation_entry_edit['quotation_entry_customer_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_prd_sec['customer_id']?>" <?=$selected?>><?=$get_prd_sec['customer_code']."-".$get_prd_sec['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label class="control-label">Type</label>
												<?php $val = $quotation_entry_edit['quotation_entry_type_id']; ?>
											<input type="hidden" name="quotation_entry_type_id" id="quotation_entry_type_id" value="<?=$quotation_entry_edit['quotation_entry_type_id']?>" required><input type="text" name="quotation_entry_type" id="quotation_entry_type" value="<?=$arrQuotationType[$val]?>" class="form-control" readonly="" >

										</div>

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="quotation_entry_date" id="quotation_entry_date" value="<?=dateGeneralFormatN($quotation_entry_edit['quotation_entry_date'])?>">

											</div>

										</div>

										<div class="form-group">

											<label>Validity Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="quotation_entry_validity_date" id="quotation_entry_validity_date" value="<?=dateGeneralFormatN($quotation_entry_edit['quotation_entry_validity_date'])?>" />

											</div>

										</div>

										
										<div class="form-group">

											<label class="control-label">Type</label>
											<?php
												$arr_type	= explode(",",$quotation_entry_edit['quotation_entry_type_id']);
												foreach($arrQuotationType as $key => $value){
												$checked = (in_array($key,$arr_type)==1)?"checked=checked":'';
											?>
											
											<input type="checkbox" name="quotation_entry_type_id[]"  id="quotation_entry_type_id<?=$key?>" value="<?=$key?>" <?=$checked?>? onClick="getTableHeader(this.value)" /> <?=$value?><br/>
											
											<?php
												}
											?>
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
								<div  style="width:100%; overflow:scroll">
								<table class="table table-striped table-bordered table-hover" id="product_detail_rls"  style="width:100%;display:none"><!--display:none-->
									
                                    <thead  >
										<tr>
											<td colspan="16"><button type="button" onClick="GetDetail('1');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="4"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Length &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										<tr>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FEET &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FT.IN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rls_display">
									<?php $row_cnt	= 1;

										$arr_cnt	= count($quotation_entry_prd_edit);

										foreach($quotation_entry_prd_edit as $get_product_detail){
										
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
												$product_brand_name		= $get_product_detail['brand_name'];

										
										
										if($get_product_detail['quotation_entry_product_detail_entry_type']==1){ ?>
							<tr>
								<td><?=$product_brand_name?></td><td><?=$product_name?><input type="hidden"  name="quotation_entry_product_detail_product_id[]" id="quotation_entry_product_detail_product_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_id']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_product_brand_id[]" id="quotation_entry_product_detail_product_brand_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_brand_id']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_product_type[]" id="quotation_entry_product_detail_product_type<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_type']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_entry_type[]" id="quotation_entry_product_detail_entry_type<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_entry_type']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_id[]" id="quotation_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['quotation_entry_product_detail_id']?>" />
								</td>
							
								<td><select  name="quotation_entry_product_detail_product_color_id[]" id="quotation_entry_product_detail_product_color_id<?=$row_cnt?>" onFocus="get_color(<?=$row_cnt?>,1);">
								<option value=""> --Select-- </option>
								<?php foreach($arr_color as $get_val){ 
								$select =($get_val['product_colour_id']==$get_product_detail['quotation_entry_product_detail_product_color_id'])?'selected="selected"':'';?>
								
								<option value="<?=$get_val['product_colour_id'];?>" <?=$select; ?>> <?=$get_val['product_colour_name'];?> </option>
								<?php }?>
								</select>
								<input type="hidden"  name="quotation_entry_product_detail_product_uom_id[]" id="quotation_entry_product_detail_product_uom_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_uom_id']?>"   /></td>
								
								<td><select  name="quotation_entry_product_detail_product_thick[]" id="quotation_entry_product_detail_product_thick<?=$row_cnt; ?>" onFocus="get_color(<?=$row_cnt; ?>,2);">
								<option value=""> --Select-- </option>
								<?php foreach($arr_thick as $key => $get_val){ 
								$select =($key==$get_product_detail['quotation_entry_product_detail_product_thick'])?'selected="selected"':'';?>
								
								<option value="<?=$key;?>" <?=$select; ?>> <?=$get_val;?> </option>
								<?php }?>
								</select>
								</td>
								
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_inches[]" id="quotation_entry_product_detail_width_inches<?=$row_cnt; ?>"   onBlur="GetTotalLength(<?=$row_cnt; ?>),GetWcalc(2,<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_width_inches']?>"   /></td> 
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_mm[]" id="quotation_entry_product_detail_width_mm<?=$row_cnt; ?>"  onBlur="GetTotalLength(<?=$row_cnt; ?>),GetWcalc(3,<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_width_mm']?>"   /></td>
								
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_width_inches[]" id="quotation_entry_product_detail_s_width_inches<?=$row_cnt; ?>"   onkeyup="GetLcalS(2,<?=$row_cnt; ?>)" onBlur="GetTotalLength(<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_s_width_inches']?>" /></td> 
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_width_mm[]" id="quotation_entry_product_detail_s_width_mm<?=$row_cnt; ?>" onKeyUp="GetLcalS(3,<?=$row_cnt; ?>)" onBlur="GetTotalLength(<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_s_width_mm']?>" /></td>
								
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet[]" id="quotation_entry_product_detail_sl_feet<?=$row_cnt; ?>" onBlur="GetLcalFeet(1,<?=$row_cnt; ?>),GetTotalLength(<?=$row_cnt; ?>);"  value="<?=$get_product_detail['quotation_entry_product_detail_sl_feet']?>" /></td> 
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet_in[]" id="quotation_entry_product_detail_sl_feet_in<?=$row_cnt; ?>" onblur="GetLcalFeet(1,<?=$row_cnt; ?>)" onBlur="GetTotalLength(<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_sl_feet_in']?>"  /></td>
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet_mm[]" id="quotation_entry_product_detail_sl_feet_mm<?=$row_cnt; ?>" onBlur="GetTotalLength(<?=$row_cnt; ?>);" value="<?=$get_product_detail['quotation_entry_product_detail_sl_feet_mm']?>"  /></td>
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet_met[]" id="quotation_entry_product_detail_sl_feet_met<?=$$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_sl_feet_met']?>"/>
								<input type="hidden"  name="quotation_entry_product_detail_s_weight_inches[]" id="quotation_entry_product_detail_s_weight_inches<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_s_weight_inches']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_s_weight_mm[]" id="quotation_entry_product_detail_s_weight_mm<?=$row_cnt; ?>"  value="<?=$get_product_detail['quotation_entry_product_detail_s_weight_mm']?>" /></td>
								
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_qty[]" id="quotation_entry_product_detail_qty<?=$row_cnt; ?>" onBlur="GetTotalLength(<?=$row_cnt; ?>)"  onBlur="GetTotalLength(3,<?=$row_cnt; ?>),discountPerFind(<?=$row_cnt; ?>);"  value="<?=$get_product_detail['quotation_entry_product_detail_qty']?>"  /></td> 
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_tot_length[]" id="quotation_entry_product_detail_tot_length<?=$row_cnt; ?>" readonly value="<?=$get_product_detail['quotation_entry_product_detail_tot_length']?>"  />
								 <input  type="hidden"  name="quotation_entry_product_detail_inv_tot_length[]" id="quotation_entry_product_detail_inv_tot_length<?=$row_cnt; ?>"   value="<?=$get_product_detail['quotation_entry_product_detail_inv_tot_length']?>" /></td>
								 <td><input class="form-control" type="text"  name="quotation_entry_product_detail_rate[]" id="quotation_entry_product_detail_rate<?=$row_cnt; ?>"   onBlur="discountPerFind(<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_rate']?>" /></td>
					
								 <td><input class="form-control" type="text"  name="quotation_entry_product_detail_total[]" id="quotation_entry_product_detail_total<?=$row_cnt; ?>"   value="<?=number_format($get_product_detail['quotation_entry_product_detail_total'],2)?>" /></td>
								 <td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['quotation_entry_product_detail_id']?>&quotation_entry_uniq_id=<?php echo $quotation_entry_edit['quotation_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
						</tr>
										
										<?php $row_cnt++; }}?>
									</tbody>
								</table>
								</div>

                                <table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:none"><!--display:none-->
									<thead>
										<tr>
											<td colspan="14"><button type="button" onClick="GetDetail('2');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> Rate</th>
											<th rowspan="2" style="vertical-align:middle;"> Amount</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>TON</th>
											<th>KG</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rws_display">
										<?php //$row_cnt	= 0;

										$arr_cnt	= count($quotation_entry_prd_edit);


										foreach($quotation_entry_prd_edit as $get_product_detail){
										
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
												$product_brand_name		= $get_product_detail['brand_name'];

										
										
										if($get_product_detail['quotation_entry_product_detail_entry_type']==2){ ?>
							<tr>
								<td><?=$product_brand_name?></td><td><?=$product_name?><input type="hidden"  name="quotation_entry_product_detail_product_id[]" id="quotation_entry_product_detail_product_id" value="<?=$get_product_detail['quotation_entry_product_detail_product_id']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_mas_product_id[]" id="quotation_entry_product_detail_mas_product_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_mas_product_id']?>" /> 
								<input type="hidden"  name="quotation_entry_product_detail_product_brand_id[]" id="quotation_entry_product_detail_product_brand_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_brand_id']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_product_type[]" id="quotation_entry_product_detail_product_type<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_type']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_entry_type[]" id="quotation_entry_product_detail_entry_type<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_entry_type']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_id[]" id="quotation_entry_product_detail_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_id']?>" /></td>
								
								<td><select    name="quotation_entry_product_detail_product_color_id[]" id="quotation_entry_product_detail_product_color_id<?=$row_cnt; ?>" >
								<option value=""> --Select-- </option>
								<?php foreach($arr_color as $get_val){ 
								$select =($get_val['product_colour_id']==$get_product_detail['quotation_entry_product_detail_product_color_id'])?'selected="selected"':'';?>
								
								<option value="<?=$get_val['product_colour_id'];?>" <?=$select; ?>> <?=$get_val['product_colour_name'];?> </option>
								<?php }?>
								</select>
								<input type="hidden"  name="quotation_entry_product_detail_product_uom_id[]" id="quotation_entry_product_detail_product_uom_id<?=$row_cnt; ?>" value=""   /></td>
								
								<td><select    name="quotation_entry_product_detail_product_thick[]" id="quotation_entry_product_detail_product_thick<?=$row_cnt; ?>" >
								<option value=""> --Select-- </option>
								<?php foreach($arr_thick as $key => $get_val){ 
								$select =($key==$get_product_detail['quotation_entry_product_detail_product_thick'])?'selected="selected"':'';?>
								
								<option value="<?=$key;?>" <?=$select; ?>> <?=$get_val;?> </option>
								<?php }?>
								</select>
								</td>
								
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_inches[]" id="quotation_entry_product_detail_width_inches<?=$row_cnt; ?>"  onBlur="GetWcalc(2,<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_width_inches']?>"   /></td> 
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_mm[]" id="quotation_entry_product_detail_width_mm<?=$row_cnt; ?>"   onBlur="GetWcalc(3,<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_width_mm']?>"  /></td>
					
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_width_inches[]" id="quotation_entry_product_detail_s_width_inches<?=$row_cnt; ?>"   onkeyup="GetLcalS(2,<?=$row_cnt; ?>)" onBlur="GetTotalLength(<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_s_width_inches']?>"/></td> 
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_width_mm[]" id="quotation_entry_product_detail_s_width_mm<?=$row_cnt; ?>" onKeyUp="GetLcalS(3,<?=$row_cnt; ?>)" onBlur="GetTotalLength(<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_s_width_mm']?>"/></td>
					
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_weight_inches[]" id="quotation_entry_product_detail_s_weight_inches<?=$row_cnt; ?>"  onblur="GetWeightClc(1,<?=$row_cnt; ?>),RawdiscountPerFind(<?=$row_cnt; ?>)"  value="<?=$get_product_detail['quotation_entry_product_detail_s_weight_inches']?>"/></td> 
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_weight_mm[]" id="quotation_entry_product_detail_s_weight_mm<?=$row_cnt; ?>"  onblur="GetWeightClc(2,<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_s_weight_mm']?>"/>
								<input type="hidden"  name="quotation_entry_product_detail_qty[]" id="quotation_entry_product_detail_qty<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_qty']?>" /></td>
								
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_rate[]" id="quotation_entry_product_detail_rate<?=$row_cnt; ?>" onBlur="RawdiscountPerFind(<?=$row_cnt; ?>)" value="<?=$get_product_detail['quotation_entry_product_detail_rate']?>" /></td>
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_total[]" id="quotation_entry_product_detail_total<?=$row_cnt; ?>"  value="<?=number_format($get_product_detail['quotation_entry_product_detail_total'],0,"","")?>"/></td>
								<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['quotation_entry_product_detail_id']?>&quotation_entry_uniq_id=<?php echo $quotation_entry_edit['quotation_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>	
													
							</tr>
										
										<?php $row_cnt++; }}?>
									
									</tbody>

								</table>
								
								<table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%;display:none" ><!-- display:none-->
									
									<thead >
										<tr> 
											<td colspan="14"><button type="button" onClick="GetDetail('4');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>


                                            <th style="vertical-align:middle;">NAME</th>

                                            <th style="vertical-align:middle;">UOM</th>

											<th style="vertical-align:middle;">QTY</th>

											<th style="vertical-align:middle;">Rate</th>

											<th style="vertical-align:middle;">TOTAL</th>

                                        </tr>

                                    </thead>

                                    <tbody id="product_detail_as_display">

									<?php //$row_cnt	= 0;

										$arr_cnt	= count($quotation_entry_prd_edit);

										foreach($quotation_entry_prd_edit as $get_product_detail){
										
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
												$product_brand_name		= $get_product_detail['brand_name'];

										
										
										if($get_product_detail['quotation_entry_product_detail_entry_type']==4){ ?>
							<tr>
								<td><?=$product_name?><input type="hidden"  name="quotation_entry_product_detail_product_id[]" id="quotation_entry_product_detail_product_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_id']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_product_type[]" id="quotation_entry_product_detail_product_type<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_type']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_entry_type[]" id="quotation_entry_product_detail_entry_type<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_entry_type']?>" />
								<input type="hidden"  name="quotation_entry_product_detail_id[]" id="quotation_entry_product_detail_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_id']?>" /></td>
								
								<td><?=$product_uom_name?><input type="hidden"  name="quotation_entry_product_detail_product_uom_id[]" id="quotation_entry_product_detail_product_uom_id<?=$row_cnt; ?>" value="<?=$get_product_detail['quotation_entry_product_detail_product_uom_id']?>"  /></td>
								
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_qty[]" id="quotation_entry_product_detail_qty<?=$row_cnt; ?>"  onBlur="AccdiscountPerFind(<?=$row_cnt; ?>)"  value="<?=$get_product_detail['quotation_entry_product_detail_qty']?>"/></td>
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_rate[]" id="quotation_entry_product_detail_rate<?=$row_cnt; ?>" onBlur="AccdiscountPerFind(<?=$row_cnt; ?>)"   value="<?=$get_product_detail['quotation_entry_product_detail_rate']?>"/></td>
								<td><input class="form-control" type="text"  name="quotation_entry_product_detail_total[]" id="quotation_entry_product_detail_total<?=$row_cnt; ?>"   value="<?=number_format($get_product_detail['quotation_entry_product_detail_total'],0);?>"/></td>
								<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['quotation_entry_product_detail_id']?>&quotation_entry_uniq_id=<?php echo $quotation_entry_edit['quotation_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>	
													
							</tr>
										
										<?php $row_cnt++; }}?>

									</tbody>

								</table>

								<table class="table table-striped table-bordered table-hover" style=" width:100%" >

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Gross</td>

										<td style="width:20%"><input type="text" class="form-control" name="quotation_entry_gross_amount" id="quotation_entry_gross_amount" value="<?=number_format($quotation_entry_edit['quotation_entry_gross_amount'],0,"","")?>" ></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Transportation Charges</td>

										<td><input type="text" class="form-control" name="quotation_entry_transport_amount" id="quotation_entry_transport_amount" onBlur="totalAmount()"  value="<?=number_format($quotation_entry_edit['quotation_entry_transport_amount'],0,"","")?>"/></td>

									</tr>
									<tr>

										<td style="width:50%">&nbsp;</td>

										<td>Dis</td>

										<td style="width:20%"><input type="text" class="form-control" name="quotation_entry_dis_per" id="quotation_entry_dis_per" onBlur="totalAmount()" value="<?=number_format($quotation_entry_edit['quotation_entry_dis_per'],0,"","");?>"></td>

										<td><input type="text" class="form-control" name="quotation_entry_dis_amount" id="quotation_entry_dis_amount" value="<?=number_format($quotation_entry_edit['quotation_entry_dis_amount'],0,"","")?>" ></td>

									</tr>
									<tr>

										<td style="width:50%">&nbsp;</td>

										<td>Tax</td>

										<td style="width:20%"><input type="text" class="form-control" name="quotation_entry_tax_per" id="quotation_entry_tax_per" onBlur="totalAmount()"  value="<?=number_format($quotation_entry_edit['quotation_entry_tax_per'],0,"","")?>"/></td>

										<td><input type="text" class="form-control" name="quotation_entry_tax_amount" id="quotation_entry_tax_amount" value="<?=number_format($quotation_entry_edit['quotation_entry_tax_amount'],0)?>" /></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Advance</td>

										<td><input type="text" class="form-control" name="quotation_entry_advance_amount" id="quotation_entry_advance_amount" onBlur="totalAmount()"  value="<?=number_format($quotation_entry_edit['quotation_entry_advance_amount'],0,"","")?>"/></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Total</td>

										<td><input type="text" class="form-control" name="quotation_entry_net_amount" id="quotation_entry_net_amount"   value="<?=number_format($quotation_entry_edit['quotation_entry_net_amount'],0,"","")?>"/></td>

									</tr>

								</table>

								</div>

								<div class="col-lg-6">
								<input type="hidden"  name="quotation_entry_id" id="quotation_entry_id" value="<?=$quotation_entry_edit['quotation_entry_id']?>" />	
								<input type="hidden"  name="quotation_entry_uniq_id" id="quotation_entry_uniq_id" value="<?=$quotation_entry_edit['quotation_entry_uniq_id']?>" />	
									<button name="quotation_entry_update" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
								</div>

							</div>

						</div>

					</div>

				</div>

				

				</form>
				<script type="text/javascript">
				getTableHeader(1);
				</script>
				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">
                           Quotation Entry List
                        </div>

                        <div class="panel-body">
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">

								<form action="index.php" method="post" id="quotation_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>INV.No.</th>

                                            <th>Date</th>

                                            <th>Customer</th>

                                            <th>Validity Date</th>

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="quotation_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

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

                                            <td><?=$get_quotation['quotation_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['quotation_entry_date'])?></td>

											<td><?=$get_quotation['customer_name']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['quotation_entry_validity_date'])?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['quotation_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['quotation_entry_uniq_id']; ?>" type="checkbox" />

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

						<h4 class="modal-title" id="myModalLabel">Quotation Entry Detail</h4>

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
<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
    <div id="footer-sec">

        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>

    </div>

    <!-- /. FOOTER  -->
			<script>
			$(document).ready(function () {
				$('#dataTables-example').DataTable( {
					responsive: true
				} );
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
			$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#quotation_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
				$( "#quotation_entry_validity_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'',changeMonth:true,changeYear:true,});
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

