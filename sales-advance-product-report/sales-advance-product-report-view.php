<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Advance Product Entry</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry   deleted successfully</div>';
		} 
	}

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/sales-advance-product-report/sales-advance-product-report-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/report-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Advance Product Report</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) {
									echo $msg;
								}
							?>
						</h1>
                    </div>
                </div>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Advance Product Report
                        </div>
                        <div class="panel-body">
							<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
								<div class="col-lg-4">
									<div class="form-group" style="margin-top:05px;">
										<label class="control-label">Branch</label>
										<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" required>
											  <option value=""> - Select - </option>
											<?php
												foreach($branch_list	as	$get_branch){
											?>
													<option value="<?=$get_branch['branch_id']?>" <?php if(searchValue('search_branch_id')==$get_branch['branch_id']) { ?> selected="selected" <?php } ?>><?=$get_branch['branch_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
									
									
								</div>
								<div class="col-lg-4">
								<div class="form-group">
										<label class="control-label">From Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date"  value="<?=searchValue('search_from_date')?>" required>
										</div>
									</div>
									
									
									
								</div>
								
								<div class="col-lg-4">
								
									<div class="form-group">
										<label class="control-label">To Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_to_date" id="search_to_date" value="<?=searchValue('search_to_date')?>" required/>
										</div>
									</div>
								</div>
								<div class="row" style="margin-left:3px;margin-right:3px;">
								<div class="col-lg-4">
								<div class="form-group">
										<label>Invoice No.</label>
										<input type="text" name="search_entry_no" id="search_entry_no"  class="form-control"  value="<?=searchValue('search_entry_no')?>"/>
									</div>
								
								</div>
								
								<div class="col-lg-8">
									<div class="form-group" >
										<label>Customer</label>
										<select name="search_customer_id" id="search_customer_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
												foreach($customer_list	as	$get_customer){
											?>
													<option value="<?=$get_customer['customer_id']?>" <?php if(searchValue('search_customer_id')==$get_customer['customer_id']) { ?> selected="selected" <?php } ?>><?=$get_customer['customer_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
								
								</div>
								</div>
								<div class="row" style="margin-left:3px;margin-right:3px;">
								<div class="col-lg-4">
								<div class="form-group" >
										<label>Color</label>
										<select name="search_color_id" id="search_color_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
												foreach($color_arr	as	$get_color){
											?>
													<option value="<?=$get_color['product_colour_id']?>" <?php if(searchValue('search_color_id')==$get_color['product_colour_id']) { ?> selected="selected" <?php } ?>><?=$get_color['product_colour_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
									
									<div class="form-group" >
										<label>Brand</label>
										<select name="search_brand_id" id="search_brand_id" class="form-control select2" style="width:100%" onChange="getCity(this.value,2);">
											  <option value=""> - Select - </option>
											<?php
												foreach($brand_arr	as	$get_val){
											?>
													<option value="<?=$get_val['brand_id']?>" <?php if(searchValue('search_brand_id')==$get_val['brand_id']) { ?> selected="selected" <?php } ?>><?=$get_val['brand_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
								
								</div>
								
							
								<div class="col-lg-4">
								
								<div class="form-group" >
										<label>Thick</label>
										<select name="search_thick_id" id="search_thick_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
												foreach($arr_thick	as $key_val=>$get_val){
											?>
													<option value="<?=$key_val?>" <?php if(searchValue('search_thick_id')==$key_val) { ?> selected="selected" <?php } ?>><?=$get_val?></option>
											<?php
												}
											?>
										</select>
									</div>
									
									<div class="form-group" >
										<label>Township</label>
										<select name="search_township_id" id="search_township_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
											$get_township	=get_township(searchValue('search_township_id'));
												foreach($get_township	as	$get_val){
											?>
													<option value="<?=$get_val['city_id']?>" <?php if(searchValue('search_township_id')==$get_val['city_id']) { ?> selected="selected" <?php } ?>><?=$get_val['city_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
									
									
								</div>
								
								
								<div class="col-lg-4">
								<div class="form-group" >
										<label>State</label>
										<select name="search_state_id" id="search_state_id" class="form-control select2" style="width:100%" onChange="getCity(this.value,1);"> 
											  <option value=""> - Select - </option>
											<?php
												foreach($state_list	as	$get_state){
											?>
													<option value="<?=$get_state['state_id']?>" <?php if(searchValue('search_state_id')==$get_state['state_id']) { ?> selected="selected" <?php } ?>><?=$get_state['state_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
									
									
								</div>
								
								</div>
							<div class="row" style="margin-left:3px;margin-right:3px;">
								
								<!--<div class="col-lg-2">
									<label>Raw 				</label><br/>
									<label>Finished Good </label><br/>
									<label>Accessories </label>
								</div>
								
								<div class="col-lg-2">
								<?php  //  $arr_exp=implode(",",searchValue('search_raw')); ?>
								<input type="checkbox" id="search_raw" name="search_raw[]" value="1"<?php if (in_array(1,searchValue('search_raw'))) { ?> checked="checked" <?php } ?>><br/>
								<input type="checkbox" id="search_raw" name="search_raw[]" value="3"<?php if (in_array(3,searchValue('search_raw'))) { ?> checked="checked" <?php } ?>><br/>
								<input type="checkbox" id="search_raw" name="search_raw[]" value="2"<?php if (in_array(2,searchValue('search_raw'))) { ?> checked="checked" <?php } ?>>
								</div>-->
								
								<div class="col-lg-4">
									<?php foreach($arr_product_type as $key=> $getvale){ 
									$ser_val=searchValue('search_raw');
									$value =isset($ser_val)?$ser_val:0;
									$select =(in_array($key,$value))?'checked="checked"':"";?>
									<input type="radio" id="search_raw" name="search_raw[]" value="<?php echo $key?>" <?=$select?>  > &nbsp;&nbsp; <?php echo $getvale;?><br/>
									
									<?php }?> 
								</div>
								
								<div class="col-lg-8">
								<div class="form-group" >
										<label>Product</label>
										<select name="search_prodcut_id" id="search_prodcut_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php $arr_list=get_products_arr(searchValue('search_prodcut_id'));
											foreach($arr_list	as	$get_state){
											?>
													<option value="<?=$get_state['product_id']?>" <?php if(searchValue('search_prodcut_id')==$get_state['product_id']) { ?> selected="selected" <?php } ?>><?=$get_state['product_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
									
									<label>With Amount &nbsp;&nbsp; <input type="checkbox" id="search_with_amt" name="search_with_amt" value="search_with_amt" <?php if(searchValue('search_with_amt')=='search_with_amt') { ?> checked="checked" <?php } ?>></label>&nbsp;&nbsp; <label>Without Amount &nbsp;&nbsp; <input type="checkbox" id="search_without_amt" name="search_without_amt" value="search_without_amt" <?php if(searchValue('search_without_amt')=='search_without_amt') { ?> checked="checked" <?php } ?>></label>
								</div>
								</div>
								<div class="col-lg-12">
									<button name="search_report" type="submit" class="btn btn-primary">Search</button>
									<button type="reset" class="btn btn-danger">Reset </button>
								</div>
							</form>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            	</div>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
					<?php if(isset($_REQUEST['search_report'])){?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Advance Report Detail
							
							<div style="float:right;">
							<?php /*<a href="<?php echo PROJECT_PATH.'/sales-invoice-entry-report/invoice-entry-report-excel.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&search_customer_id='.searchValue('search_customer_id').'&search_entry_no='.searchValue('search_entry_no').'&search_to_date='.searchValue('search_to_date').'&search_sales_man_id='.searchValue('search_sales_man_id');?>" title="Download Excel" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/excel-icon.png'; ?>" width="28" border="0"   alt="Download Excel" title="Download Excel">
							</a>
						
							<a href="<?php echo PROJECT_PATH.'sales-invoice-entry-report/invoice-entry-report-pdf.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&search_customer_id='.searchValue('search_customer_id').'&search_entry_no='.searchValue('search_entry_no').'&search_to_date='.searchValue('search_to_date').'&search_sales_man_id='.searchValue('search_sales_man_id');?>" title="Download PDF" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/pdf-icon.png'; ?>" width="28" /> */?>
							</a> 
						</div>
						
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
								<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
                                
								<?php 
								?>
								<table class="table table-striped table-bordered table-hover" id="product_detail_rls" >
									<?php
										if($_REQUEST['search_raw'][0] == 1) {
											//Raw type
									?>
                                    <thead >
										
                                         <tr>
										 <th rowspan="2" class="text-center" style="vertical-align:middle;">#</th>
										 
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> ADVANCE NO</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> DATE</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> CUSTOMER NAME</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> BRAND</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> THICK</th>
											<!--<th colspan="2"> WIDTH</th>-->
											<th colspan="2" class="text-center"> SALES WIDTH</th>
											<th colspan="3" class="text-center"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center">Rate</th>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<th rowspan="2" style="vertical-align:middle;" class="text-center">Amount</th>
											<?php } ?>
										</tr>
										<tr>
											<!--<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>-->
											<th class="text-center">INCHES</th>
											<th class="text-center">MM</th>
											<th class="text-center">TON</th>
											<th class="text-center">KG</th>
											<th class="text-center">Met</th>
										</tr>
                                    </thead>
                                    <tbody >
										<?php 
										$sno =1;
										$product_id='';
										$subinches = 0;
										$submm = 0;
										$subton = 0;
										$subkg = 0;
										$submet = 0;
										$subrate = 0;
										$subtotal = 0;
										$grandinches = 0;
										$grandmm = 0;
										$grandton = 0;
										$grandkg = 0;
										$grandmet = 0;
										$grandrate = 0;
										$grandtotal = 0;
										foreach($invoice_list as $get_val){
										if($product_id!=$get_val['advance_entry_product_detail_product_id']){
										if($sno!=1){ ?>
										<tr>
											<td colspan="8" class="text-right"> Sub Total</td>
											<td style="text-align:right"><?php //echo number_format($subinches,3,'.','');?></td>
											<td style="text-align:right"><?php //echo number_format($submm,3,'.','');?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $subton);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $subkg);?></td>
											<td style="text-align:right"><?php echo round($submet);?></td>
											<td style="text-align:right"><?php //echo number_format($subrate,3,'.','');?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td style="text-align:right"><?php echo number_format($subtotal);?></td>
											<?php } ?>
											
										</tr>
										
										<?php }
												$subinches = 0;
												$submm = 0;
												$subton = 0;
												$subkg = 0;
												$submet = 0;
												$subrate = 0;
												$subtotal = 0;
										?>
										<tr>
											<td colspan="18" style="text-align:center"> <?php echo $get_val['product_name'];?></td>
										</tr>
										
										<?php } 
										
										
										?>
										<tr>
										<td class="text-right"><?php echo $sno++;?></td>	
											<td><?php echo $get_val['advance_entry_no'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['advance_entry_date']);?></td>
											<td><?php echo $get_val['customer_name'];?></td>
											<td><?php echo $get_val['brand_name'];?></td>
											<td><?php echo $get_val['product_name'];?></td>
											<td><?php echo $get_val['product_colour_name'];?></td>
											<td class="text-right"><?php echo $arr_thick[$get_val['advance_entry_product_detail_product_thick']];?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_s_width_inches']);?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_s_width_mm']);?></td>
											<!--<td><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_sl_feet']);?></td>
											<td><?php echo round($get_val['advance_entry_product_detail_sl_feet_met']);?></td>-->
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_s_weight_inches']);?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_s_weight_mm']);?></td>
											<td class="text-right"><?php echo round($get_val['advance_entry_product_detail_s_weight_met']);?></td>
											<td class="text-right"><?php echo number_format($get_val['advance_entry_product_detail_rate']);?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td class="text-right"><?php echo number_format($get_val['advance_entry_product_detail_total']);?></td>
											<?php } ?>
										</tr>
										<?php 
										
										$product_id=$get_val['advance_entry_product_detail_product_id'];
										$subinches=$subinches+$get_val['advance_entry_product_detail_s_width_inches'];
										$submm = $submm+$get_val['advance_entry_product_detail_s_width_mm'];
										$subton = $subton+$get_val['advance_entry_product_detail_s_weight_inches'];
										$subkg = $subkg+$get_val['advance_entry_product_detail_s_weight_mm'];
										$submet = $submet+$get_val['advance_entry_product_detail_s_weight_met'];
										$subrate = $subrate+$get_val['advance_entry_product_detail_rate'];
										$subtotal = $subtotal+$get_val['advance_entry_product_detail_total'];
										$grandinches=$grandinches+$get_val['advance_entry_product_detail_s_width_inches'];
										$grandmm = $grandmm+$get_val['advance_entry_product_detail_s_width_mm'];
										$grandton = $grandton+$get_val['advance_entry_product_detail_s_weight_inches'];
										$grandkg = $grandkg+$get_val['advance_entry_product_detail_s_weight_mm'];
										$grandmet = $grandmet+$get_val['advance_entry_product_detail_s_weight_met'];
										$grandrate = $grandrate+$get_val['advance_entry_product_detail_rate'];
										$grandtotal = $grandtotal+$get_val['advance_entry_product_detail_total'];
										}?>
										
										<tr>
											<td colspan="8" class="text-right"> Sub Total</td>
											<td style="text-align:right"><?php //echo number_format($subinches,3,'.','');?></td>
											<td style="text-align:right"><?php// echo number_format($submm,3,'.','');?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $subton);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $subkg);?></td>
											<td style="text-align:right"><?php echo round($submet);?></td>
											<td style="text-align:right"><?php //echo number_format($subrate,3,'.','');?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td style="text-align:right"><?php echo number_format($subtotal);?></td>
											<?php } ?>
										</tr>
										<tr>
											<td colspan="8" class="text-right"> Grand Total</td>
											<td style="text-align:right"><?php //echo number_format($grandinches,3,'.','');?></td>
											<td style="text-align:right"><?php //echo number_format($grandmm,3,'.','');?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $grandton);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $grandkg);?></td>
											<td style="text-align:right"><?php echo round($grandmet);?></td>
											<td style="text-align:right"><?php //echo number_format($grandrate,3,'.','');?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td style="text-align:right"><?php echo number_format($grandtotal);?></td>
											<?php } ?>
										</tr>
										
									</tbody>
									<?php
										}
										else if($_REQUEST['search_raw'][0]==2) {
											//Accessories Type
									?>
										<thead>
										
                                         <tr>
											<th class="text-center" style="vertical-align:middle;">#</th>
											<th style="vertical-align:middle;" class="text-center"> ADVANCE NO</th>
											<th style="vertical-align:middle;" class="text-center"> DATE</th>
											<th style="vertical-align:middle;" class="text-center"> CUSTOMER NAME</th>
                                            <th style="vertical-align:middle;" class="text-center">NAME</th>
                                            <th style="vertical-align:middle;" class="text-center">UOM</th>
											<th style="vertical-align:middle;" class="text-center">QTY</th>
											<th style="vertical-align:middle;" class="text-center">Rate</th>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<th style="vertical-align:middle;" class="text-center">TOTAL</th>
											<?php } ?>

                                        </tr>
                                    </thead>
                                    <tbody >
										<?php 
										$sno =1;
										$product_id='';
										$subqty=0;
										$subrate = 0;
										$subtotal = 0;
										$grandqty=0;
										$grandrate = 0;
										$grandtotal = 0;
										foreach($invoice_list as $get_val){
										if($product_id!=$get_val['advance_entry_product_detail_product_id']){
										if($sno!=1){ ?>
										<tr>
											<td colspan="6" class="text-right"> Sub Total</td>
											<td style="text-align:right"><?php echo round($subqty);?>
											<td style="text-align:right"><?php //echo number_format($subrate,3,'.','');?>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td style="text-align:right"><?php echo number_format($subtotal);?>
											</td>
											<?php } ?>
										</tr>
										
										<?php }
										$subqty=0;
										$subrate = 0;
										$subtotal = 0;
										?>
										<tr>
											<td colspan="9" style="text-align:center;"> <?php echo $get_val['product_name'];?></td>
										</tr>
										
										<?php } 
										
										
										?>
										<tr>
										<td class="text-right"><?php echo $sno++;?></td>	
											<td><?php echo $get_val['advance_entry_no'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['advance_entry_date']);?></td>
											<td><?php echo $get_val['customer_name'];?></td>
											<!--<td><?php echo $get_val['brand_name'];?></td>-->
											<td><?php echo $get_val['product_name'];?></td>
											<td><?php echo $get_val['product_uom_name'];?></td>
											<td class="text-right"><?php echo round($get_val['advance_entry_product_detail_qty']);?></td>
											<td class="text-right"><?php echo number_format($get_val['advance_entry_product_detail_rate']);?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td class="text-right"><?php echo number_format($get_val['advance_entry_product_detail_total']);?></td>
											<?php } ?>
										</tr>
										<?php 
										
										$product_id=$get_val['advance_entry_product_detail_product_id'];
										$subqty=$subqty+$get_val['advance_entry_product_detail_qty'];
										$subrate=$subrate+$get_val['advance_entry_product_detail_rate'];
										$subtotal=$subtotal+$get_val['advance_entry_product_detail_total'];
										$grandqty=$grandqty+$get_val['advance_entry_product_detail_qty'];
										$grandrate=$grandrate+$get_val['advance_entry_product_detail_rate'];
										$grandtotal=$grandtotal+$get_val['advance_entry_product_detail_total'];
										}?>
										<tr>
											<td colspan="6" class="text-right"> Sub Total</td>
											<td class="text-right"><?php echo round($subqty);?>
											<td class="text-right"><?php //echo number_format($subrate,3,'.','');?>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td class="text-right"><?php echo number_format($subtotal);?>
											</td>
											<?php } ?>
										</tr>
										<tr>
										<td colspan="6" class="text-right"> Grand Total</td>
										<td class="text-right"><?php echo round($grandqty);?></td>
										<td class="text-right"><?php //echo number_format($grandrate,3,'.','');?></td>
										<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
										<td class="text-right"><?php echo number_format($grandtotal);?></td>
										<?php } ?>
										</tr>
									</tbody>
								<!-- end accessories -->
									<?php
										}
										else if($_REQUEST['search_raw'][0] == 3) {
											//Finished Good Type
									?>
										<thead>
										
                                         <tr>
										 <th rowspan="2" class="text-center" style="vertical-align:middle">#</th>
										 
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> QUOTATION NO</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> DATE</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> CUSTOMER NAME</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> BRAND</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> THICK</th>
											<!--<th colspan="2"> WIDTH</th>-->
											<th colspan="2" class="text-center"> SALES WIDTH</th>
											<th colspan="4" class="text-center"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center">QTY</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center">Total <br /> Length </th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center">Rate</th>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<th rowspan="2" style="vertical-align:middle;" class="text-center">Amount</th>
											<?php } ?>
										</tr>
										<tr>
											<!--<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>-->
											<th class="text-center">INCHES</th>
											<th class="text-center">MM</th>
											<th class="text-center">FEET</th>
											<th class="text-center">FT.IN</th>
											<th class="text-center">MM</th>
											<th class="text-center">Met</th>
										</tr>
                                    </thead>
                                    <tbody >
										<?php 
										$sno =1;
										$product_id='';
										$subqty=0;
										$sublength = 0;
										$subinches = 0;
										$submm = 0;
										$subft = 0;
										$subftin = 0;
										$sublmm = 0;
										$submet = 0;
										$subrate = 0;
										$subtotal = 0;										
										$grandqty=0;
										$grandinches = 0;
										$grandmm = 0;
										$grandft = 0;
										$grandftin = 0;
										$grandlmm = 0;
										$grandmet = 0;
										$grandrate = 0;
										$grandtotal = 0;
										$grandlength = 0;
										
										foreach($invoice_list as $get_val){
										if($product_id!=$get_val['advance_entry_product_detail_product_id']){
										if($sno!=1){ ?>
										<tr>
											<td colspan="8" class="text-right"> Sub Total</td>
											<td style="text-align:right"><?php //echo number_format($subinches,3,'.','');?></td>
											<td style="text-align:right"><?php //echo number_format($submm,3,'.','');?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $subft);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $subftin);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $sublmm);?></td>
											<td style="text-align:right"><?php echo round($submet);?></td>
											<td style="text-align:right"><?php echo round($subqty);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $sublength);?></td>
											<td style="text-align:right"><?php //echo number_format($subrate,3,'.','');?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td style="text-align:right"><?php echo number_format($subtotal);?></td>
											<?php } ?>
										</tr>
										
										<?php }
										$subqty=0;
										$sublength = 0;
										$subinches = 0;
										$submm = 0;
										$subft = 0;
										$subftin = 0;
										$sublmm = 0;
										$submet = 0;
										$subrate = 0;
										$subtotal = 0;
										?>
										<tr>
											<td colspan="18" style="text-align:center"> <?php echo $get_val['product_name'];?></td>
										</tr>
										
										<?php } 
										
										
										?>
										<tr>
										<td class="text-right"><?php echo $sno++;?></td>	
											<td><?php echo $get_val['advance_entry_no'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['advance_entry_date']);?></td>
											<td><?php echo $get_val['customer_name'];?></td>
											<td><?php echo $get_val['brand_name'];?></td>
											<td><?php echo $get_val['product_name'];?></td>
											<!--<td><?php echo $get_val['product_uom_name'];?></td>-->
											<td><?php echo $get_val['product_colour_name'];?></td>
											<td class="text-right"><?php echo $arr_thick[$get_val['advance_entry_product_detail_product_thick']];?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_s_width_inches']);?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_s_width_mm']);?></td>
											<!--<td><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_sl_feet']);?></td>
											<td><?php echo round($get_val['advance_entry_product_detail_sl_feet_met']);?></td>-->
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_sl_feet']);?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_sl_feet_in']);?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_sl_feet_mm']); ?></td>
											<td class="text-right"><?php echo round($get_val['advancen_entry_product_detail_sl_feet_met']); ?></td>
											<td class="text-right"><?php echo round($get_val['advance_entry_product_detail_qty']);?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['advance_entry_product_detail_tot_length']);?></td>
											<td class="text-right"><?php echo number_format($get_val['advance_entry_product_detail_rate']);?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td class="text-right"><?php echo number_format($get_val['advance_entry_product_detail_total']);?></td>
											<?php } ?>
										</tr>
										<?php 
										
										$product_id=$get_val['advance_entry_product_detail_product_id'];
										$subqty=$subqty+$get_val['advance_entry_product_detail_qty'];
										$sublength=$sublength+$get_val['advance_entry_product_detail_tot_length'];
										$subinches=$subinches+$get_val['advance_entry_product_detail_s_width_inches'];
										$submm = $submm+$get_val['advance_entry_product_detail_s_width_mm'];
										$subft = $subft+$get_val['advance_entry_product_detail_sl_feet'];
										$subftin = $subftin+$get_val['advance_entry_product_detail_sl_feet_in'];
										$sublmm= $sublmm+$get_val['advance_entry_product_detail_sl_feet_mm'];
										$submet = $submet+$get_val['advance_entry_product_detail_sl_feet_met'];
										$subrate = $subrate+$get_val['advance_entry_product_detail_rate'];
										$subtotal = $subtotal+$get_val['advance_entry_product_detail_total'];
										$grandinches=$grandinches+$get_val['advance_entry_product_detail_s_width_inches'];
										$grandmm = $grandmm+$get_val['advance_entry_product_detail_s_width_mm'];
										$grandft = $grandft+$get_val['advance_entry_product_detail_sl_feet'];
										$grandftin = $grandftin+$get_val['advance_entry_product_detail_sl_feet_in'];
										$grandlmm= $grandlmm+$get_val['advance_entry_product_detail_sl_feet_mm'];
										$grandmet = $grandmet+$get_val['advance_entry_product_detail_sl_feet_met'];
										$grandrate = $grandrate+$get_val['advance_entry_product_detail_rate'];
										$grandtotal = $grandtotal+$get_val['advance_entry_product_detail_total'];
										$grandqty=$grandqty+$get_val['advance_entry_product_detail_qty'];
										$grandlength=$grandlength+$get_val['advance_entry_product_detail_tot_length'];
										}?>
										<tr>
											<td colspan="8" class="text-right"> Sub Total</td>
											<td style="text-align:right"><?php //echo number_format($subinches,3,'.','');?></td>
											<td style="text-align:right"><?php //echo number_format($submm,3,'.','');?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $subft);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $subftin);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $sublmm);?></td>
											<td style="text-align:right"><?php echo round($submet);?></td>
											<td style="text-align:right"><?php echo round($subqty);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $sublength);?></td>
											<td style="text-align:right"><?php //echo number_format($subrate,3,'.','');?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td style="text-align:right"><?php echo number_format($subtotal);?></td>
											<?php } ?>
										</tr>
										<tr>
											<td colspan="8" class="text-right"> Grand Total</td>
											<td style="text-align:right"><?php //echo number_format($grandinches,3,'.','');?></td>
											<td style="text-align:right"><?php //echo number_format($grandmm,3,'.','');?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $grandft);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $grandftin);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $grandlmm);?></td>
											<td style="text-align:right"><?php echo round($grandmet);?></td>
											<td style="text-align:right"><?php echo round($grandqty);?></td>
											<td style="text-align:right"><?php echo sprintf('%0.2f', $grandlength);?></td>
											<td style="text-align:right"><?php //echo number_format($grandrate,3,'.','');?></td>
											<?php 
											 $search_with_amt=searchValue('search_with_amt');
											if($search_with_amt=='search_with_amt'){?>
											<td style="text-align:right"><?php echo number_format($grandtotal);?></td>
											<?php } ?>
										</tr>
									</tbody>
									<?php
										} else {}
									?>
								</table>
								</form>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                
				<?php }?>
				</div>
            	</div>
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
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
	<script>
		$(document).ready(function () {
			$('#dataTables-invoice-entry').DataTable( {
				responsive: true
			} );
			/*$('#dataTables-example').dataTable();*/
		});
				
		//Initialize Select2 Elements
		$(".select2").select2();
	 $(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
		$( "#invoice_list_form" ).validate({
			
			  rules: {
					'search_raw[]': {
						required: true,
					}
				},
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){
					if(element.attr("name") == "search_raw[]") {
						error.appendTo( element.parent("div"));
					} 
			  }
		});
		
		</script>

</body>
</html>
