<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Credit Note Product Entry</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/sales-quotation-product-report/sales-quotation-product-report-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/report-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Credit Note Product Report</h1>
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
                           Credit Note Product Report
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
									<?php /*foreach($arr_product_type as $key=> $getvale){ 
									$ser_val=searchValue('search_raw');
									$value =isset($ser_val)?$ser_val:0;
									$select =(in_array($key,$value))?'checked="checked"':"";?>
									<input type="checkbox" id="search_raw" name="search_raw[]" value="<?php echo $key?>" <?=$select?>  > &nbsp;&nbsp; <?php echo $getvale;?><br/>
									
									<?php } */
									// print_r(searchValue('search_raw'));exit;
												$arr_type	= (isset($_REQUEST['search_raw']))?$_REQUEST['search_raw']:'0';
												//print_r($arr_type);exit;
												foreach($arrQuotationType as $key => $value){
												$checked = (in_array($key,$arr_type)==1)?"checked=checked":'';
											?> 
											
											<input type="checkbox" name="search_raw[]"  id="search_raw<?=$key?>" value="<?=$key?>" <?=$checked?> /> <?=$value?><br/>
											 
											<?php
												}
									
									 ?> 
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
                            Credit Note Product Report Detail
							
							<div style="float:right;">
							<a href="<?php echo PROJECT_PATH.'/sales-quotation-product-report/sales-quotation-product-report-excel.php?search_prodcut_id='.searchValue('search_prodcut_id').'&search_state_id='.searchValue('search_state_id').'&search_township_id='.searchValue('search_township_id').'&search_thick_id='.searchValue('search_thick_id').'&search_branch_id='.searchValue('search_branch_id').'&search_from_date='.searchValue('search_from_date').'&search_to_date='.searchValue('search_to_date').'&search_entry_no='.searchValue('search_entry_no').'&search_customer_id='.searchValue('search_customer_id').'&search_color_id='.searchValue('search_color_id').'&search_brand_id='.searchValue('search_brand_id');?>" title="Download Excel" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/excel-icon.png'; ?>" width="28" border="0"   alt="Download Excel" title="Download Excel">
							</a>
						
							<a href="<?php echo PROJECT_PATH.'sales-quotation-product-report/sales-quotation-product-report-pdf.php?search_prodcut_id='.searchValue('search_prodcut_id').'&search_raw='.$arrs_search_raws.'&search_state_id='.searchValue('search_state_id').'&search_township_id='.searchValue('search_township_id').'&search_thick_id='.searchValue('search_thick_id').'&search_branch_id='.searchValue('search_branch_id').'&search_from_date='.searchValue('search_from_date').'&search_to_date='.searchValue('search_to_date').'&search_entry_no='.searchValue('search_entry_no').'&search_customer_id='.searchValue('search_customer_id').'&search_color_id='.searchValue('search_color_id').'&search_brand_id='.searchValue('search_brand_id');?>" title="Download PDF" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/pdf-icon.png'; ?>" width="28" />
							</a> 
						</div>
						
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
								<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
                                
								<?php 
								?>
								<table class="table table-striped table-bordered table-hover" id="product_detail_rls" >
                                    <thead  >
										
                                         <tr>
										 <th rowspan="2" >#</th>
										 
											<th rowspan="2" style="vertical-align:middle;"> QUOTATION NO</th>
											<th rowspan="2" style="vertical-align:middle;"> DATE</th>
											<th rowspan="2" style="vertical-align:middle;"> CUSTOMER NAME</th>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> UOM</th>
                                           <!-- <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>-->
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> LENGTH</th>
											<th colspan="2"> WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY </th>
											<!--<th rowspan="2" style="vertical-align:middle;"> TOTAL LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;"> Rate</th>
											<th rowspan="2" style="vertical-align:middle;"> Amount</th>-->
											
											
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MILI</th>
											<th>FEET</th>
											<th>METER</th>
											<th>TON</th>
											<th>KG</th>
											
										</tr>
                                    </thead>
                                    <tbody >
										<?php 
										$sno =1;
										$product_id='';
										$subqty=0;
										$grandqty=0;
										foreach($invoice_list as $get_val){
										if($product_id!=$get_val['credit_note_entry_product_detail_product_id']){
										if($sno!=1){ ?>
										<tr><td colspan="10" >&nbsp; </td>
											<td colspan="2" > Sub Total</td>
											<td style="text-align:right"><?php echo round($subqty);?>
											</td>
										</tr>
										
										<?php }
										$subqty=0;
										?>
										<tr>
											<td colspan="18" style="text-align:center"> <?php echo $get_val['product_name'];?></td>
										</tr>
										
										<?php } 
										
										
										?>
										<tr>
										<td><?php echo $sno++;?></td>	
											<td><?php echo $get_val['credit_note_entry_no'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['quotation_entry_date']);?></td>
											<td><?php echo $get_val['customer_name'];?></td>
											<td><?php echo $get_val['brand_name'];?></td>
											<td><?php echo $get_val['product_uom_name'];?></td>
											<?php /*<td><?php echo $get_val['product_colour_name'];?></td>
											<td><?php echo $arr_thick[$get_val['invoice_entry_product_detail_product_thick']];?></td>*/?>
											<td><?php echo sprintf('%0.2f',$get_val['credit_note_entry_product_detail_s_width_inches']);?></td>
											<td><?php echo sprintf('%0.2f',$get_val['credit_note_entry_product_detail_s_width_mm']);?></td>
											<td><?php echo sprintf('%0.2f',$get_val['credit_note_entry_product_detail_sl_feet']);?></td>
											<td><?php echo round($get_val['credit_note_entry_product_detail_sl_feet_met']);?></td>
											<td><?php echo sprintf('%0.2f',$get_val['credit_note_entry_product_detail_s_weight_inches']);?></td>
											<td><?php echo sprintf('%0.2f',$get_val['credit_note_entry_product_detail_s_weight_mm']);?></td>
											<td class="text-right"><?php echo round($get_val['credit_note_entry_product_detail_qty']);?></td>
											<?php /*<td><?php echo $get_val['invoice_entry_product_detail_tot_length'];?></td>
											<td><?php echo $get_val['invoice_entry_product_detail_rate'];?></td>
											<td><?php echo $get_val['invoice_entry_product_detail_total'];?></td>*/?>
											
										</tr>
										<?php 
										
										//$product_id=$get_val['credit_note_entry_product_detail_product_id'];
										//$subqty=$subqty+$get_val['quotation_entry_product_detail_qty'];
										//$grandqty=$grandqty+$get_val['quotation_entry_product_detail_qty'];
										}?>
										<tr><td colspan="10" >&nbsp; </td>
											<td colspan="2" > Sub Total</td>
											<td style="text-align:right"><?php echo number_format($subqty);?>
											</td>
											
										</tr>
										<tr>
										<td colspan="10" >&nbsp; </td>
										<td colspan="2" > Grand Total</td>
											<td style="text-align:right"><?php echo number_format($grandqty);?>
											</td>
										</tr>
									</tbody>
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
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
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
