<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Daily Sales Summary Report</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/sales-credit-note-product-report/sales-credit-note-product-report-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/report-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Daily Sales Summary Report</h1>
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
                           Daily Sales Summary Report
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
								
								<div class="col-lg-4">
									
									<div class="form-group" >
										<label>Sales Man</label>
										<select name="search_sales_man_id" id="search_sales_man_id" class="form-control select2" style="width:100%" > 
											  <option value=""> - Select - </option>
											<?php
												foreach($salesMan_list	as	$get_man){
											?>
													<option value="<?=$get_man['salesman_id']?>" <?php if(searchValue('search_sales_man_id')==$get_man['salesman_id']) { ?> selected="selected" <?php } ?>><?=$get_man['salesman_name']?></option>
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
									</div></div>
									<div class="col-lg-4">
									<div class="form-group" >
										<label>State</label>
										<select name="search_state_id" id="search_state_id" class="form-control select2" style="width:100%" > 
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
                            Daily Sales Summary Report
							
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
                                    <thead  >
										
                                         <tr>
										 <th class="text-center">SNO</th>
										 
											<th style="vertical-align:middle;" nowrap="nowrap" class="text-center">INVOICE NO.</th>
											<th style="vertical-align:middle;" class="text-center"> DATE</th>
											<th style="vertical-align:middle;" class="text-center"> CUSTOMER NAME</th>
											<th style="vertical-align:middle;" class="text-center"> SALES MAN</th>
                                            <th style="vertical-align:middle;" class="text-center"> NET TOTAL</th>
                                           
                                        </tr>
										
                                    </thead>
                                    <tbody >
										<?php 
										$sno =1;
										$product_id='';
										$subqty=0;
										$grandqty=0;
										foreach($invoice_list as $get_val){
										 
										
										
										?>
										<tr>
										<td class="text-right"><?php echo $sno++;?></td>	
											<td><?php echo $get_val['invoice_entry_no'];?></td>
											<td><?php echo dateGeneralFormatN($get_val['invoice_entry_date']);?></td>
											<td><?php echo $get_val['customer_name'];?></td>
											<td><?php echo $get_val['salesman_name'];?></td>
											
											<td style="text-align:right"><?php echo number_format($get_val['invoice_entry_gross_amount']);?></td>
										</tr>
										<?php 
										
										
									
										$grandqty=$grandqty+$get_val['invoice_entry_gross_amount'];
										}?>
										
										<tr>
										<td colspan="3" >&nbsp; </td>
										<td colspan="2"> Grand Total</td>
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
