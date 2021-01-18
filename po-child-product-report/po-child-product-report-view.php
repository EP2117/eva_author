<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Purchase Product Wise Report(Child)</title>
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
                        <h1 class="page-head-line"> Purchase Product Wise Report(Child)</h1>
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
                           Purchase Product Wise Report(Child)
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
										<label>Supplier</label>
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
                            Purchase Product Wise Report(Child) Detail
							
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
								<div style="overflow:scroll">
								<table class="table table-striped table-bordered table-hover" id="product_detail_rls" >
                                    <thead  >
										
                                         <tr>
										 <th rowspan="2" class="text-center" style="vertical-align:middle;">#</th>
										 
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap" class="text-center" > Po Number</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> DATE</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> SUPPLIER NAME</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> PRODUCT CODE</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> PRODUCT NAME</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;" class="text-center"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> THICK</th>
											<!--<th colspan="2"> WIDTH</th>-->
											<th colspan="2" class="text-center"> LENGTH</th>
											<th colspan="2" style="vertical-align:middle;" class="text-center"> Weight</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> Cost Currency / Ton</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> Cost MMK / Ton</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> Amount (Currency)</th>
											<th rowspan="2" style="vertical-align:middle;" class="text-center"> Amount (MMK)</th>
											
                                        </tr>
										<tr>
											<!--<th>INCHES</th>
											<th>MM</th>-->
											<th class="text-center">FEET</th>
											<th class="text-center">METER</th>
											<th class="text-center">TON</th>
											<th class="text-center">KG</th>
										</tr>
                                    </thead>
                                    <tbody >
										<?php 
										$sno =1;
										$product_id='';
										$subqty=0;
										$grandqty=0;
										$subamt=0;
										$grandamt=0;
										
										//Added by AuthorsMM
										$ft_total = 0;
										$m_total  = 0;
										$ton_total= 0;
										$kg_total = 0;
										$currency_per_ton_total = 0;
										$mmk_per_ton_total = 0;
										$currency_total = 0;
										$mmk_total = 0;
										
										foreach($invoice_list as $get_val){
										//Added by AuthorsMM
										$currency_per_ton = $get_val['product_con_entry_amount_by_currency']/$get_val['product_con_entry_child_product_detail_ton_qty'];
										$mmk_per_ton = $get_val['product_con_entry_amount_by_mmk']/$get_val['product_con_entry_child_product_detail_ton_qty'];
										
										//Added by AuthorsMM
										$ft_total = $ft_total + $get_val['product_con_entry_child_product_detail_length_feet'];
										$m_total  = $m_total + $get_val['product_con_entry_child_product_detail_length_mm'];
										$ton_total= $ton_total + $get_val['product_con_entry_child_product_detail_ton_qty'];
										$kg_total = $kg_total + $get_val['product_con_entry_child_product_detail_kg_qty'];
										$currency_per_ton_total = $currency_per_ton_total + $currency_per_ton;
										$mmk_per_ton_total = $mmk_per_ton_total + $mmk_per_ton;
										$currency_total = $currency_total + $get_val['product_con_entry_amount_by_currency'];
										$mmk_total = $mmk_total + $get_val['product_con_entry_amount_by_mmk'];
										
										?>
										<tr>
										<td class="text-right"><?php echo $sno++;?></td>	
											<td><?php echo $get_val['invoiceNo'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['pI_invoice_date']);?></td>
											<td><?php echo $get_val['supplier_name'];?></td>
											<td><?php echo $get_val['product_con_entry_child_product_detail_code'];?></td>
											<td><?php echo $get_val['product_con_entry_child_product_detail_name'];?></td>
											<td><?php echo $get_val['brand_name'];?></td>
											<td><?php echo $get_val['product_colour_name'];?></td>
											<td class="text-right"><?php echo $arr_thick[$get_val['product_con_entry_child_product_detail_thick_ness']];?></td>
											<!--<td><?php echo $get_val['product_con_entry_child_product_detail_width_inches'];?></td>
											<td><?php echo $get_val['product_con_entry_child_product_detail_width_mm'];?></td>-->
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['product_con_entry_child_product_detail_length_feet']);?></td>
											<td class="text-right"><?php echo round($get_val['product_con_entry_child_product_detail_length_mm']);?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['product_con_entry_child_product_detail_ton_qty']);?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $get_val['product_con_entry_child_product_detail_kg_qty']);?></td>
											<td class="text-right"><?php echo number_format($currency_per_ton); ?></td>
											<td class="text-right"><?php echo number_format($mmk_per_ton); ?></td>
											<td class="text-right"><?php echo number_format($get_val['product_con_entry_amount_by_currency']);?></td>
											<td class="text-right"><?php echo number_format($get_val['product_con_entry_amount_by_mmk']);?></td>
											
										</tr>
										<?php 
										}?>
										
										
										<!-- Added by AuthorsMM -->
										<tr>
											<td colspan="9" class="text-right">Total</td>
											<td class="text-right"><?php echo sprintf('%0.2f', $ft_total); ?></td>
											<td class="text-right"><?php echo round($m_total); ?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $ton_total); ?></td>
											<td class="text-right"><?php echo sprintf('%0.2f', $kg_total); ?></td>
											<td class="text-right"><?php echo number_format($currency_per_ton_total); ?></td>
											<td class="text-right"><?php echo number_format($mmk_per_ton_total); ?></td>
											<td class="text-right"><?php echo number_format($currency_total); ?></td>
											<td class="text-right"><?php echo number_format($mmk_total); ?></td>
										</tr>
										
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
