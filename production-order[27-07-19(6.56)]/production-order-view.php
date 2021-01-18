<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PRODUCTION ORDER DETAILS</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order deleted successfully</div>';
		}  
	}
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/production-order/production-order-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php if($_SESSION[SESS.'_session_user_branch_type']==1){  include "../includes/common/production-left-menu.php"; } else{ include "../includes/common/sales-left-menu.php"; } ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Production Order</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn btn-success" onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>
                </div>
				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>
				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Production Order Details
								</div>
								<div class="panel-body">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Order Type</label>
											<select name="production_order_order_type" id="production_order_order_type" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($arr_product_order as	$product_order_key => $product_order_val){
												?>
														<option value="<?=$product_order_key?>"><?=$product_order_val?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="production_order_branch_id" id="production_order_branch_id" class="form-control select2" style="width:100%" required>
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
											<label class="control-label">Production Section</label>
											<select name="production_order_production_section_id" id="production_order_production_section_id" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($prd_sec_list	as	$get_prd_sec){
												?>
														<option value="<?=$get_prd_sec['production_section_id']?>"><?=$get_prd_sec['production_section_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Production Type</label>
											<select name="production_order_type" id="production_order_type" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($arr_producton_type	as	$value=>$list){
												?>
														<option value="<?=$value?>"><?=$list?></option>
												<?php
													}
												?>
											</select>
										</div>
                                        <div class="form-group">

											<label class="control-label">Brand</label>

											<select name="production_order_brand_id" id="production_order_brand_id" class="form-control select2" style="width:100%" required>

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
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control" name="production_order_date" id="production_order_date" value="<?=date('d/m/Y')?>"required>
											</div>
										</div>
										<div class="form-group">
											<label>Department</label>
											<select name="production_order_department_id" id="production_order_department_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($department_list	as	$get_department){
												?>
														<option value="<?=$get_department['department_id']?>"><?=$get_department['department_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										
										<div class="form-group">
											<label class="control-label">Type</label>
											<?php
													foreach($arrQuotationType as $key => $value){
												?>
							<input type="checkbox" name="production_order_type_id[]"  id="production_order_type_id<?=$key?>" value="<?=$key?>" onClick="getTableHeader(this.value)" /> <?=$value?><br/>
												<?php
													}
												?>
										</div>
										
										<div class="form-group">
											<label class="control-label">SALES WAREHOUSE</label>
                                            <select name="production_order_sw_check" id="production_order_sw_check" class="form-control " required>
                                            <option value="">-Select-</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            </select>
										</div>
                                        
                                        
									</div>
                                    
								</div>
						</div>
						
					</div>
        		</div>
                  <div id="error_msg" style="color:#F00" >
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
                                <table class="table table-striped table-bordered table-hover product_detail_rls_d" id="product_detail_rls"  style="width:180%;display:none">
                                    <thead  >
										<tr>
											<td colspan="20"><button type="button" onClick="GetDetail('1');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>
											<th rowspan="2" style="vertical-align:middle; width:10%"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle; width:10%"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle; width:20%"> COLOUR </th>
											<th rowspan="2" style="vertical-align:middle; width:10%"> THICK</th>
											<th colspan="2" style="width:20%"> WIDTH</th>
											<th colspan="2"  style="width:20%"> SALES WIDTH</th>
											<th colspan="4"  style="width:40%"> SALES LENGTH</th>
											<th colspan="4"  style="width:40%"> EXTR LENGTH</th>
											<th rowspan="2" style="vertical-align:middle; width:10%">QTY</th>
											<th rowspan="2" style="vertical-align:middle; width:10%"> Total Length </th>
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>MET</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>MET</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rls_display">
									</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:none">
									<thead>
										<tr>
											<td colspan="18"><button type="button" onClick="GetDetail('2');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle; width:5%"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;width:5%"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;width:5%"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;width:5%"> THICK</th>
											<th colspan="2" style="width:20%" > WIDTH</th>
											<th colspan="2" style="width:20%"> SALES WIDTH</th>
											<th colspan="2"style="width:20%" > SALES WEIGHT</th>
											<th colspan="2" style="width:20%"> TOTAL LENGTH</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> INCHES</th>
											<th> MM</th>
											<th>TON</th>
											<th>KG</th>
											<th>FEET </th>
											<th>METER</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rws_display">
									</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%; display:none" >
									
									<thead >
										<tr>
											<td colspan="16"><button type="button" onClick="GetDetail('4');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>
                                            <th style="vertical-align:middle; width:30%">NAME</th>
                                            <th style="vertical-align:middle; width:30%">UOM</th>
											<th style="vertical-align:middle; width:40%">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_detail_as_display">
									
									</tbody>
								</table>
								
								</div>
								<div class="col-lg-6">
									<button name="production_order_insert" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
								</div>
							</div>
						</div>
						<?php /*?><div class="panel panel-info">
							<div class="panel-heading">
							  Raw Product Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetRawDetail();" data-toggle="modal" data-target="#RawModal" data-id="1" class="glyphicon glyphicon-plus"></button>
                           
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="raw_product_detail"  style=" width:100%" >
									<thead class="raw_rls">
                                         <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="4"> SALES LENGTH</th>
											<th colspan="4"> EXTR LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>MET</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>MET</th>
										</tr>
                                    </thead>
                                    <tbody id="raw_product_detail_display">
									</tbody>
								</table>
								
								</div>
								
							</div>
						</div><?php */?>
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
								  	Production Order Details
								</div>
								<div class="panel-body">
									<div class="col-lg-6">
									<div class="form-group">
											<label class="control-label">Order Type</label>
											<select name="production_order_order_type" id="production_order_order_type" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($arr_product_order as	$product_order_key => $product_order_val){
													
													$selected	= ($product_order_key==$production_order_edit['production_order_order_type'])?'selected="selected"':'';
												?>
														<option value="<?=$product_order_key?>" <?=$selected?>><?=$product_order_val?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Branch</label>
											<select name="production_order_branch_id" id="production_order_branch_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
														$selected	= ($get_branch['branch_id']==$production_order_edit['production_order_branch_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Production Section</label>
											<select name="production_order_production_section_id" id="production_order_production_section_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($prd_sec_list	as	$get_prd_sec){
														$selected	= ($get_prd_sec['production_section_id']==$production_order_edit['production_order_production_section_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_prd_sec['production_section_id']?>" <?=$selected?>><?=$get_prd_sec['production_section_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Production Type</label>
											<select name="production_order_type" id="production_order_type" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($arr_producton_type	as	$value=>$list){
														$selected	= ($value==$production_order_edit['production_order_type'])?'selected="selected"':'';
												?>
														<option value="<?=$value?>" <?=$selected?>><?=$list?></option>
												<?php
													}
												?>
											</select>
										</div>
                                         <div class="form-group">
											<label class="control-label">Brand</label>
											<select name="production_order_brand_id" id="production_order_brand_id" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($brand_list	as	$get_brand){
														$selected	= ($get_brand['brand_id']==$production_order_edit['production_order_brand_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_brand['brand_id']?>" <?=$selected?>><?=$get_brand['brand_name']?></option>
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
											  <input type="text" class="form-control" name="production_order_date" id="production_order_date" value="<?=dateGeneralFormatN($production_order_edit['production_order_date'])?>">
											</div>
										</div>
										<div class="form-group">
											<label>Department</label>
											<select name="production_order_department_id" id="production_order_department_id" class="form-control select2" style="width:100%" >
												  <option value=""> - Select - </option>
												<?php
													foreach($department_list	as	$get_department){
														$selected	= ($get_department['department_id']==$production_order_edit['production_order_department_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_department['department_id']?>" <?=$selected?>><?=$get_department['department_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										
										<div class="form-group">
											<label class="control-label">Type</label>
											<select name="production_order_type_id" id="production_order_type_id" class="form-control select2" style="width:100%" required onChange="getTableHeader(this.value)">
												  <option value=""> - Select - </option>
												<?php
													foreach($arrQuotationType as $key => $value){
													$selected	= ($key==$production_order_edit['production_order_type_id'])?'selected="selected"':'';
												?>
														<option value="<?=$key?>" <?=$selected?>><?=$value?></option>
												<?php
													}
												?>
											</select>
										</div>
										
										<div class="form-group">
											<label class="control-label">SALES WAREHOUSE</label>
											<!--<input type="checkbox" name="production_order_sw_check" id="production_order_sw_check" value="" <?php if($production_order_edit['production_order_sw_check']==1){echo 'checked=""';}?>>-->
                                            <select name="production_order_sw_check" id="production_order_sw_check" class="form-control ">
                                            <option value="">-Select-</option>
                                            <option value="yes" <?php if($production_order_edit['production_order_sw_check']=='yes'){?> selected<?php }?>>Yes</option>
                                            <option value="no" <?php if($production_order_edit['production_order_sw_check']=='no'){?> selected<?php }?>>No</option>
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
								
								<div class="table-responsive" sty>
                                
								<table class="table table-striped table-bordered table-hover product_detail_rls_d" id="product_detail_rls"  style="width:180%;display:<?=($production_order_edit['production_order_type_id']==1)?"block":"none";?>">
                                    <thead  >
										
                                        <tr>
											<td colspan="20"><button type="button" onClick="GetDetail('1');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>
											<th rowspan="2" style="vertical-align:middle; width:6%"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle; width:6%"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle; width:6%"> COLOUR </th>
											<th rowspan="2" style="vertical-align:middle; width:6%"> THICK</th>
											<th colspan="2" style="width:15%; text-align:center"> WIDTH</th>
											<th colspan="2"  style="width:15%; text-align:center"> SALES WIDTH</th>
											<th colspan="4"  style="width:25%; text-align:center"> SALES LENGTH</th>
											<th colspan="4"  style="width:25%; text-align:center"> EXTR LENGTH</th>
											<th rowspan="2" style="vertical-align:middle; width:10%">QTY</th>
											<th rowspan="2" style="vertical-align:middle; width:10%"> Total Length </th>
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>MET</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
											<th>MET</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rls_display">
										<?php 
										$row_cnt	= 0;
										$arr_cnt	= count($production_order_prd_edit);
										foreach($production_order_prd_edit as $get_product_detail){
										
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_nam'];
												$product_thick_ness		= $get_product_detail['production_order_product_detail_product_thick'];
										
										if($get_product_detail['production_order_product_detail_entry_type']==1){
										?>
										<tr>
										
											<td ><?=$get_product_detail['brand_name']?>
                                            <input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="<?=$get_product_detail['production_order_product_detail_mother_child_type']?>" />
											<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="<?=$get_product_detail['production_order_product_detail_product_id']?>" class="sd_id"  />
											<input type="hidden"  name="production_order_product_detail_type[]" id="production_order_product_detail_type" value="<?=$get_product_detail['production_order_product_detail_type']?>"/>
<input type="hidden"  name="production_order_product_detail_entry_type[]" id="production_order_product_detail_entry_type" value="<?=$get_product_detail['production_order_product_detail_entry_type']?>"/>  
											<input type="hidden"  name="production_order_product_detail_id[]" id="production_order_product_detail_id" value="<?=$get_product_detail['production_order_product_detail_id']?>" /></td>
											<td > <?=$product_name?></td>
											<td><?=$product_colour_name?>
											<input type="hidden"  name="production_order_product_detail_product_color_id[]" id="production_order_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_color_id']?>" class="form-control"  />
											</td>
											<td > <?=$arr_thick[number_format($product_thick_ness)]?>
												<input type="hidden"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_thick']?>" class="form-control"  />
											</td>
											<td ><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches<?=$row_cnt?>"  onBlur="GetWcalc(2,<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_width_inches']?>" style=" width:80%"  /></td> 
											<td><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm<?=$row_cnt?>"  onBlur="GetWcalc(3,<?=$row_cnt?>);GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_width_mm']?>" /></td>
											
											<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches<?=$row_cnt?>"   onkeyup="GetLcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_s_width_inches']?>" /></td> 
											<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm<?=$row_cnt?>" onKeyUp="GetLcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"value="<?=$get_product_detail['production_order_product_detail_s_width_mm']?>" /></td>
											
											<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet[]" id="production_order_product_detail_sl_feet<?=$row_cnt?>" onBlur="GetLcalFeet(1,<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>);"  value="<?=$get_product_detail['production_order_product_detail_sl_feet']?>"/></td> 
											<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_in[]" id="production_order_product_detail_sl_feet_in<?=$row_cnt?>" onblur="GetLcalFeet(1,<?=$row_cnt?>);GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_sl_feet_in']?>"/></td>
											<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_mm[]" id="production_order_product_detail_sl_feet_mm<?=$row_cnt?>" onBlur="GetTotalLength(<?=$row_cnt?>);"  value="<?=$get_product_detail['production_order_product_detail_sl_feet_mm']?>"/></td>
											<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_met[]" id="production_order_product_detail_sl_feet_met<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_sl_feet_met']?>"/></td>
											
											<td><input class="form-control" type="text"  name="production_order_product_detail_ext_feet[]" id="production_order_product_detail_ext_feet<?=$row_cnt?>" onBlur="GetLcalFeetExtr(1,<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>);"  value="<?=$get_product_detail['production_order_product_detail_ext_feet']?>"/></td> 
											<td><input class="form-control" type="text"  name="production_order_product_detail_ext_feet_in[]" id="production_order_product_detail_ext_feet_in<?=$row_cnt?>" onblur="GetLcalFeetExtr(1,<?=$row_cnt?>);GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_ext_feet_in']?>" /></td>
											<td><input class="form-control" type="text"  name="production_order_product_detail_ext_feet_mm[]" id="production_order_product_detail_ext_feet_mm<?=$row_cnt?>" onBlur="GetTotalLength(<?=$row_cnt?>);"  value="<?=$get_product_detail['production_order_product_detail_ext_feet_mm']?>"/></td>
											<td ><input class="form-control" type="text"  name="production_order_product_detail_ext_feet_met[]" id="production_order_product_detail_ext_feet_met<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_ext_feet_met']?>" /><input type="hidden"  name="production_order_product_detail_s_weight_inches[]" id="production_order_product_detail_s_weight_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_weight_inches']?>"/><input type="hidden"  name="production_order_product_detail_s_weight_mm[]" id="production_order_product_detail_s_weight_mm<?=$row_cnt?>"  value="<?=$get_product_detail['production_order_product_detail_s_weight_mm']?>"/></td>
											
											<td><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty<?=$row_cnt?>" onBlur="GetTotalLength(<?=$row_cnt?>);GetTotalLength(3,<?=$row_cnt?>);discountPerFind(<?=$row_cnt?>);" value="<?=$get_product_detail['production_order_product_detail_qty']?>" /></td> 
											<td><input class="form-control" type="text"  name="production_order_product_detail_tot_length[]" id="production_order_product_detail_tot_length<?=$row_cnt?>" readonly  value="<?=$get_product_detail['production_order_product_detail_tot_length']?>"/><input  type="hidden"  name="production_order_product_detail_inv_tot_length[]" id="production_order_product_detail_inv_tot_length<?=$row_cnt?>" readonly value="<?=$get_product_detail['production_order_product_detail_inv_tot_length']?>"   /></td>
			
										</tr>
										
										<?php $row_cnt++;}
										}
										
										?>
									</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:<?=($production_order_edit['production_order_type_id']==2)?"block":"none";?>">
									<thead>
										<tr>
											<td colspan="16"><button type="button" onClick="GetDetail('2');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle; width:5%">BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;width:5%">NAME</th>
											<th rowspan="2" style="vertical-align:middle;width:5%">COLOR</th>
											<th rowspan="2" style="vertical-align:middle;width:5%">THICK</th>
											<th colspan="2" style="width:20%" >WIDTH</th>
											<th colspan="2" style="width:20%">SALES WIDTH</th>
											<th colspan="2" style="width:20%" >SALES WEIGHT</th>
											<th colspan="2" style="width:20%">TOTAL LENGTH</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> INCHES</th>
											<th> MM</th>
											<th>TON</th>
											<th>KG</th>
											<th>FEET </th>
											<th>METER</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rws_display">
									<?php 
										$row_cnt	= 0;
										$arr_cnt	= count($production_order_prd_edit);
										foreach($production_order_prd_edit as $get_product_detail){
										
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_nam'];
												$product_thick_ness		= $get_product_detail['production_order_product_detail_product_thick'];
										
										if($get_product_detail['production_order_product_detail_entry_type']==2){
										?>
										<tr>
											<td ><?=$get_product_detail['brand_name']?>
                                             <input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="<?=$get_product_detail['production_order_product_detail_mother_child_type']?>" />
											<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="<?=$get_product_detail['production_order_product_detail_product_id']?>" class="sd_id"  />
											<input type="hidden"  name="production_order_product_detail_type[]" id="production_order_product_detail_type" value="<?=$get_product_detail['production_order_product_detail_type']?>"/>
											<input type="hidden"  name="production_order_product_detail_id[]" id="production_order_product_detail_id" value="<?=$get_product_detail['production_order_product_detail_id']?>" /></td>
											<td ><?=$product_name?></td>
											<td><?=$product_colour_name?>
											<input type="hidden"  name="production_order_product_detail_product_color_id[]" id="production_order_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_color_id']?>" class="form-control"  />
											</td>
											<td> <?=$arr_thick[number_format($product_thick_ness)]?>
												<input type="hidden"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_thick']?>" class="form-control"  />
											</td>
											 <td ><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches<?=$row_cnt?>"  onBlur="GetWcalc(2,<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_width_inches']?>" /></td> 
 <td ><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm<?=$row_cnt?>"   onBlur="GetWcalc(3,<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_width_mm']?>" /></td>
			 <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches<?=$row_cnt?>"   onkeyup="GetLcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_s_width_inches']?>"/></td> 
			 <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm<?=$row_cnt?>" onKeyUp="GetLcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_s_width_mm']?>"/></td>
			
			 <td ><input class="form-control" type="text"  name="production_order_product_detail_s_weight_inches[]" id="production_order_product_detail_s_weight_inches<?=$row_cnt?>"  onblur="GetWeightClc(1,<?=$row_cnt?>),RawdiscountPerFind(<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_s_weight_inches']?>" /></td> 
			 <td ><input class="form-control" type="text"  name="production_order_product_detail_s_weight_mm[]" id="production_order_product_detail_s_weight_mm<?=$row_cnt?>"  onblur="GetWeightClc(2,<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_s_weight_mm']?>"/><input type="hidden"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['production_order_product_detail_qty']?>"/></td>
			
			
			 <td><input class="form-control" type="text"  name="production_order_product_detail_tot_feet[]" id="production_order_product_detail_tot_feet<?=$row_cnt?>" onBlur="GetTotalFeet(1,<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_tot_feet']?>"/></td> 
			 <td ><input class="form-control" type="text"  name="production_order_product_detail_tot_meter[]" id="production_order_product_detail_tot_meter<?=$row_cnt?>"  onBlur="GetTotalFeet(4,<?=$row_cnt?>)" value="<?=$get_product_detail['production_order_product_detail_tot_meter']?>"/></td>
										</tr>
										
										<?php $row_cnt++; }
										}
										
										?>
									</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%; display:<?=($production_order_edit['production_order_type_id']==4)?"block":"none";?>" >
									
									<thead >
										<tr>
											<td colspan="3"><button type="button" onClick="GetDetail('4');" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button></td>
										</tr>
                                         <tr>
                                            <th style="vertical-align:middle; width:30%">NAME</th>
                                            <th style="vertical-align:middle; width:30%">UOM</th>
											<th style="vertical-align:middle; width:40%">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_detail_as_display">
										<?php 
										$row_cnt	= 0;
										$arr_cnt	= count($production_order_prd_edit);
										foreach($production_order_prd_edit as $get_product_detail){
										
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_nam'];
												$product_thick_ness		= $get_product_detail['production_order_product_detail_product_thick'];
										
										if($get_product_detail['production_order_product_detail_entry_type']==4){
										?>
										<tr>
											<td>
											<?=$product_name?>
                                             <input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="<?=$get_product_detail['production_order_product_detail_mother_child_type']?>" />
<input type="hidden"  name="production_order_product_detail_id[]" id="production_order_product_detail_id" value="<?=$get_product_detail['production_order_product_detail_id']?>" />
											</td> 
											<td style="width:30%"><?=$product_uom_name?><input type="hidden"  name="production_order_product_detail_product_uom_id[]" id="production_order_product_detail_product_uom_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_uom_id']?>" /></td>
			
			<td style="width:40%"><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty<?=$row_cnt?>"  onBlur="AccdiscountPerFind(<?=$row_cnt?>)"  value="<?=$get_product_detail['production_order_product_detail_qty']?>"/></td>
											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_order_product_detail_id']?>&production_order_uniq_id=<?php echo $production_order_edit['production_order_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
										</tr>
										
										<?php $row_cnt++;}
										}   
										
										?>
									</tbody>
								</table>
								</div>
	
								
							</div>
							</div>
						
					</div>
							<div class="col-lg-6">
										<input type="hidden"  name="production_order_id" id="production_order_id" value="<?=$production_order_edit['production_order_id']?>" />	
										<input type="hidden"  name="production_order_uniq_id" id="production_order_uniq_id" value="<?=$production_order_edit['production_order_uniq_id']?>" />	
									<button name="production_order_update" type="submit" class="btn btn-success">Save </button>
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
                           Production Order List
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
						
                            <div class="table-responsive">
								<form action="index.php" method="post" id="production_order_list_form" name="_list_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>PO No</th>
                                            <th>Date</th>
                                            <th>Request By</th>
                                            <th>Godown</th>
											<th>Print</th>
                                            <th>Action</th>
											<th>
												<input name="checkall" onClick="checkedAll();" type="checkbox"  />
												<button name="production_order_entry_delete" type="submit" class="btn btn-danger">Delete</button>
											</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($quotation_list	as $get_quotation){
										$edit_status =editStatus('gin_entry_product_details','gin_entry_product_detail_po_detail_id',$get_quotation['production_order_uniq_id'],'gin_entry_product_detail_deleted_status');
										$delete_status = deleteStatus();
										if($delete_status ==1){
										  $delete_status = $edit_status;
										}
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_quotation['production_order_no']?></td>
                                            <td><?=dateGeneralFormatN($get_quotation['production_order_date'])?></td>
                                            <td><?=$arr_producton_type[$get_quotation['production_order_type']]?></td>
											<td><?=$get_quotation['production_section_name']?></td>
											<td><a href="production-order-print.php?id=<?php echo $get_quotation['production_order_uniq_id']?>" title="INVOICE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
                                            <td class="center">
											<?php //if($edit_status == 1){ ?>
												<a href="index.php?page=edit&id=<?php echo $get_quotation['production_order_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
												<?php //}?>
      										</td>
											<td>
											<?php //if($delete_status == 1){ ?>
												<input name="deleteCheck[]" value="<?php echo $get_quotation['production_order_uniq_id']; ?>" type="checkbox" />
												<?php //}?>
											</td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
								</form>
                            </div>
                        </div>
                    </div>
					<?php } ?>
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
		
		<div class="modal fade" id="RawModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">
			<div class="modal-dialog" style="width: 800px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Raw Product Detail</h4>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<div id="raw_detail_content">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onClick="AddRawdetail()"  data-dismiss="modal">Save changes</button>
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
			$('#product_detail_rls').DataTable( {
				scrollY:true,
				scrollX:true,
				scrollCollapse: true,
				paging: false,
				"searching": false,
				"info":false,
				"oLanguage": {"sZeroRecords": "", "sEmptyTable": ""}
				
			});
			$(".select2").select2();
			//$('.datatable').DataTable()
	//Date picker
   /* $('#production_order_date').datepicker({
      autoclose: true
    });*/
	$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#production_order_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
				$( "#invoice_entry_validity_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'',changeMonth:true,changeYear:true,});
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
