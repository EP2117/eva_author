<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Sale</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Delivery Entry added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Delivery Entry updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Delivery Entry deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added'; 
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Delivery Entry Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Delivery Entry deleted successfully</div>';
		}  
	}
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'delivery-entry-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/report-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DAILY SALES REPORT</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) {
									echo $msg;
								}
							?>
						</h1>
                    </div>
                </div>
				<script type="text/javascript">
			getTableHeader(<?=$delivery_entry_edit['delivery_entry_type_id']?>);
			</script>
				
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Daily Sales Report
                        </div>
						
						<form action="index.php" method="post" id="so_list_form" name="so_list_form" >
                                <div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" >
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
													$selected	= ($get_customer['customer_id']==searchValue('customerid'))?'selected="selected"':'';
												?>
							          <option value="<?=$get_customer['customer_id']?>" <?=$selected?>><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										</div>
										
										<div class="col-lg-6">
									<div class="form-group">
											<label class="control-label">Product Category</label>
											<select name="product_categoryid" id="product_categoryid" multiple="" class="form-control select2" style="width:100%"  >
												  <option value=""> - Select - </option>
												<?php
													foreach($product_catageory	as	$get_prdt){
													$selected	= ($get_prdt['product_category_id']==searchValue('product_categoryid'))?'selected="selected"':'';
												?>
							          <option value="<?=$get_prdt['product_category_id']?>" <?=$selected?>><?=$get_prdt['product_category_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										</div>
										<?php if(isset($_REQUEST['search_type_id'])){
											$search_type_id=$_REQUEST['search_type_id'];
										}else{
											$search_type_id='';
										}
									?>
									<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">Type</label>
										<select name="search_type_id" id="search_type_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											 <option value="2" <?php if($search_type_id==2) { ?> selected="selected" <?php } ?>>Invoice</option>
											 <option value="1" <?php if($search_type_id==1) { ?> selected="selected" <?php } ?>>Direct Invoice</option>
											
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
										  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date" autocomplete ="off"  value="<?=searchValue('search_from_date')?>"  >
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
										  <input type="text" class="form-control pull-right" name="search_to_date" id="search_to_date" autocomplete ="off"  value="<?=searchValue('search_to_date')?>"  />
										</div>
									</div>
									</div>
									</div>
								<div class="col-lg-12">
									<button name="search" type="submit" class="btn btn-success">Search </button>
									<button name="reset" type="reset" class="btn btn-danger">Reset </button>
								</div>
								</form>
                      	<div class="col-lg-12">	
							&nbsp;
							</div>
						<div style="float:right;">
							<a href="<?php echo PROJECT_PATH.'/daily-sales-report/quotation-entry-report-excel.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&customerid='.searchValue('customerid').'&search_entry_no='.searchValue('search_entry_no').'&search_to_date='.searchValue('search_to_date').'&search_type_id='.searchValue('search_type_id');?>" title="Download Excel" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/excel-icon.png'; ?>" width="28" border="0"   alt="Download Excel" title="Download Excel">
							</a>
						
							<a href="<?php echo PROJECT_PATH.'daily-sales-report/quotation-entry-report-pdf.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&customerid='.searchValue('customerid').'&product_categoryid='.searchValue('product_categoryid').'&search_to_date='.searchValue('search_to_date').'&search_type_id='.searchValue('search_type_id');?>" title="Download PDF" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/pdf-icon.png'; ?>" width="28" />
							</a> 
						</div>
                            <div class="table-responsive">
						   <?php if(isset($_REQUEST['search'])){?> 
								<form action="index.php" method="post" id="delivery_entry_list_form" name="_list_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
											<th class="text-center">INV.No.</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Customer Name</th>
											<th class="text-center">Type</th>
											<th class="text-center">Amount</th>
																						
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
											$s_no	= 1;
											$customer_id	= '';
											$amt=0;
										foreach($quotation_list	as $get_quotation){
										if($customer_id!=$get_quotation['product_product_category_id'])
										{
										?>
										<tr>

											<td colspan="6" style="text-align:center"><strong><?=$get_quotation['product_category_name']?></strong></td>

										</tr>

										<?php

											$customer_id = $get_quotation['product_product_category_id'];

										}
										?>
                                        <tr class="odd gradeX">
                                            <td class="text-right"><?=$s_no++?></td>
                                            <td><?=$get_quotation['delivery_customer_no']?></td>
                                            <td><?=dateGeneralFormatN($get_quotation['delivery_customer_date'])?></td>
											<td><?=$get_quotation['customer_name']?></td>
											<td><?php if($get_quotation['invoice_entry_direct_type']==1){ echo 'Direct Invoice'; }else{ echo 'Invoice'; } ?></td>
											<td class="text-right"><?=number_format($get_quotation['invoice_entry_product_detail_total'])?></td>
											
                                        </tr>
										<?php $amt=$amt+$get_quotation['invoice_entry_product_detail_total']; } ?>
									<tr>
										<td colspan="5" class="text-right"><b>Total</b></td>
										<td class="text-right"><b><?=number_format($amt)?></b></td>
									</tr>
								
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
			
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	<div class="panel-body">
                            
                            <div class="modal fade" id="myModal" tabindex ="-1" role ="dialog" aria-labelledby ="myModalLabel" aria-hidden ="true"  style="display: none;">
                                <div class="modal-dialog" style="width: 800px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss ="modal" aria-hidden ="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                        </div>
                                        <div class="modal-body">
											<div class="table-responsive">
												<div id="dynamic-content">
												</div>
											</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss ="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onClick ="AddproductDetail()"  data-dismiss ="modal">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
	<div class="panel-body">
		<div class="modal fade" id="soModal" tabindex ="-1" role ="dialog" aria-labelledby ="myModalLabel" aria-hidden ="true"  style="display: none;">
			<div class="modal-dialog" style="width: 800px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss ="modal" aria-hidden ="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Delivery Entry Detail</h4>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<div id="so_detail_content">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss ="modal">Close</button>
						<button type="button" class="btn btn-primary" onClick ="AddSodetail()"  data-dismiss ="modal">Save changes</button>
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
				
				$(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
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
				$( "#delivery_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
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
