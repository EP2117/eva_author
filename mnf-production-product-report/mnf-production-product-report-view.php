<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Production Order Report</title>
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
                        <h1 class="page-head-line"> Production Order Report</h1>
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
                           Production Order Report
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
										<label>Production Order No.</label>
										<input type="text" name="search_entry_no" id="search_entry_no"  class="form-control"  value="<?=searchValue('search_entry_no')?>"/>
									</div>
								
								</div>
								
								<div class="col-lg-8">
									<div class="form-group" >
										<label>Production Section</label>
										<select name="search_supplier_id" id="search_supplier_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
												foreach($supplier_list	as	$get_supplier){
											?>
													<option value="<?=$get_supplier['supplier_id']?>" <?php if(searchValue('search_supplier_id')==$get_supplier['supplier_id']) { ?> selected="selected" <?php } ?>><?=$get_supplier['supplier_name']?></option>
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
								</div>
								
								
								<div class="col-lg-4">
								
									
									
								</div>
								<div class="col-lg-4">
								<div class="form-group" >
										<label>Product</label>
										<select name="search_prodcut_id" id="search_prodcut_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php $arr_list=get_products_arr();
											foreach($arr_list	as	$get_state){
											?>
													<option value="<?=$get_state['product_id']?>" <?php if(searchValue('search_prodcut_id')==$get_state['product_id']) { ?> selected="selected" <?php } ?>><?=$get_state['product_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
									
								</div>
								<div class="col-lg-4">
								
								<div class="form-group" >
										<label>Product Type</label>
										<select name="search_product_type" id="search_product_type" class="form-control select2" style="width:100%" required>
											  <option value=""> - Select - </option>
											<?php
												foreach($arrQuotationType	as $key_val=>$get_val){
											?>
													<option value="<?=$key_val?>" <?php if(searchValue('search_product_type')==$key_val) { ?> selected="selected" <?php } ?>><?=$get_val?></option>
											<?php
												}
											?>
										</select>
									</div>
								</div>
								</div>
							
								<div class="col-lg-12">
									<button name="search" type="submit" class="btn btn-primary">Search</button>
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
					<?php if(isset($_REQUEST['search'])){ //echo 'test';exit;?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Production Order Report
							
							<div style="float:right;">
							
							</a> 
						</div>
						
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
								<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
                                
								<?php 
								?>
								<div style="overflow:scroll">
								<table class="table table-striped table-bordered table-hover" id="product_detail_rls" >
                                    <thead  >
										<?php if($_REQUEST['search_product_type']==1){ ?>		
                                         <tr>
											 <th rowspan="2" >#</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap"> PO No. </th>
											<th rowspan="2" style="vertical-align:middle;"> Date</th>
											<th rowspan="2" style="vertical-align:middle;"> Production Section</th>
											<th rowspan="2" style="vertical-align:middle;"> Product Code</th>
											<th rowspan="2" style="vertical-align:middle;"> Product Name</th>
											<th rowspan="2" style="vertical-align:middle;"> Brand</th>
                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											<th rowspan="2" style="vertical-align:middle;"> Thick</th>
											<th colspan="2"> Width</th>
											<th colspan="2"> Length</th>
											<th colspan="2" style="vertical-align:middle;"> Qty</th>
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>METER</th>
										</tr>
										<?php }elseif($_REQUEST['search_product_type']==2){ ?> 
										 <tr>
											 <th rowspan="2" >#</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap"> PO No. </th>
											<th rowspan="2" style="vertical-align:middle;"> Date</th>
											<th rowspan="2" style="vertical-align:middle;"> Production Section</th>
											<th rowspan="2" style="vertical-align:middle;"> Product Code</th>
											<th rowspan="2" style="vertical-align:middle;"> Product Name</th>
											<th rowspan="2" style="vertical-align:middle;"> Brand</th>
                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											<th rowspan="2" style="vertical-align:middle;"> Thick</th>
											<th colspan="2"> Width</th>
											<th colspan="2" style="vertical-align:middle;"> Weight</th>
											<th colspan="2" style="vertical-align:middle;"> Qty</th>
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>TON</th>
											<th>KG</th>
										</tr>
										<?php }elseif($_REQUEST['search_product_type']==4){ ?> 
										 <tr>
											 <th rowspan="2" >#</th>
											<th style="vertical-align:middle;" nowrap="nowrap"> PO No. </th>
											<th style="vertical-align:middle;"> Date</th>
											<th style="vertical-align:middle;"> Production Section</th>
											<th style="vertical-align:middle;"> Product Code</th>
											<th style="vertical-align:middle;"> Product Name</th>
											<th style="vertical-align:middle;"> Brand</th>
											<th style="vertical-align:middle;"> Qty</th>
                                        </tr>
										
										<?php }  ?>
                                    </thead>
                                    <tbody >
										<?php 
										$sno =1;
										$product_id='';
										$subqty=0;
										$grandqty=0;
										$subamt=0;
										$grandamt=0;
										foreach($invoice_list as $get_val){
											if($_REQUEST['search_product_type']==1){ 
											
											$product_thick_ness		= $get_val['production_order_product_detail_product_thick'];
										?>
										<tr>
										<td><?php echo $sno++;?></td>	
											<td><?php echo $get_val['production_order_no'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['production_order_date']);?></td>
											<td><?php echo $get_val['production_section_name'];?></td>
											<td><?php echo $get_val['product_code'];?></td>
											<td><?php echo $get_val['product_name'];?></td>
											<td><?php echo $get_val['brand_name'];?></td>
											<td><?php echo $get_val['product_colour_name'];?></td>
											<td><?php echo $arr_thick[number_format($product_thick_ness)];?></td>
											<td><?php echo $get_val['production_order_product_detail_s_width_inches'];?></td>
											<td><?php echo $get_val['production_order_product_detail_s_width_mm'];?></td>
											<td><?php echo $get_val['production_order_product_detail_sl_feet'];?></td>
											<td><?php echo $get_val['production_order_product_detail_sl_feet_mm'];?></td>
											<td><?php echo $get_val['production_order_product_detail_qty'];?></td>
										</tr>
										<?php 
										}elseif($_REQUEST['search_product_type']==2){
										?>
										<tr>
										<td><?php echo $sno++;?></td>	
											<td><?php echo $get_val['production_order_no'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['production_order_date']);?></td>
											<td><?php echo $get_val['production_section_name'];?></td>
											<td><?php echo $get_val['product_code'];?></td>
											<td><?php echo $get_val['product_name'];?></td>
											<td><?php echo $get_val['brand_name'];?></td>
											<td><?php echo $get_val['product_colour_name'];?></td>
											<td><?php echo $get_val['production_order_product_detail_product_thick'];?></td>
											<td><?php echo $get_val['production_order_product_detail_s_width_inches'];?></td>
											<td><?php echo $get_val['production_order_product_detail_s_width_mm'];?></td>
											<td><?php echo number_format($get_val['production_order_product_detail_s_weight_inches'],2,'.','');?></td>
											<td><?php echo $get_val['production_order_product_detail_s_weight_mm'];?></td>
											<td><?php echo $get_val['production_order_product_detail_qty'];?></td>
										</tr>
										<?php 
										}elseif($_REQUEST['search_product_type']==4){
										?>
										<tr>
										<td><?php echo $sno++;?></td>	
											<td><?php echo $get_val['production_order_no'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['production_order_date']);?></td>
											<td><?php echo $get_val['production_section_name'];?></td>
											<td><?php echo $get_val['product_code'];?></td>
											<td><?php echo $get_val['product_name'];?></td>
											<td><?php echo $get_val['brand_name'];?></td>
											<td><?php echo $get_val['production_order_product_detail_qty'];?></td>
										</tr>
										<?php
										}
										}
										?>
										
										
										
										
									</tbody>
								</table>
								</div>
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
			$( "#invoice_list_form" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
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
		
		
		</script>

</body>
</html>
