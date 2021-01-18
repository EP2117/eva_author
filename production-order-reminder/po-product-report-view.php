<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Production Order</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'sales-advance-product-report-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/reminder-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Production Order Reminder</h1>
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
                           Production Order Reminder
                        </div>
                        <div class="panel-body">
							<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
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
										<label class="control-label">From Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date"  value="<?=searchValue('search_from_date')?>" >
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
										  <input type="text" class="form-control pull-right" name="search_to_date" id="search_to_date" value="<?=searchValue('search_to_date')?>" />
										</div>
									</div>
								</div>
								<div class="row" style="margin-left:3px;margin-right:3px;">
								<div class="col-lg-6">
								<div class="form-group">
										<label>Production No.</label>
										<input type="text" name="search_entry_no" id="search_entry_no"  class="form-control"  value="<?=searchValue('search_entry_no')?>"/>
									</div>
								
								</div>
								
								<div class="col-lg-6">
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
								<div class="col-lg-6">
								<div class="form-group">
											<label>Production Type</label>
											<select name="production_order_type" id="production_order_type" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($arr_product_type	as	$value=>$list){
													$selected	= ($value==searchValue('production_order_type'))?'selected="selected"':'';
												?>
														<option value="<?=$value?>" <?=$selected?>><?=$list?></option>
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
					
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            PO Report Detail
							<div style="float:right;">
							<a href="<?php echo PROJECT_PATH.'/production-order-reminder/po-product-report-excel.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&search_customer_id='.searchValue('search_customer_id').'&search_entry_no='.searchValue('search_entry_no').'&search_to_date='.searchValue('search_to_date');?>" title="Download Excel" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/excel-icon.png'; ?>" width="28" border="0"   alt="Download Excel" title="Download Excel">
							</a>
						
							<a href="<?php echo PROJECT_PATH.'production-order-reminder/po-product-report-pdf.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&search_customer_id='.searchValue('search_customer_id').'&search_entry_no='.searchValue('search_entry_no').'&search_to_date='.searchValue('search_to_date');?>" title="Download PDF" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/pdf-icon.png'; ?>" width="28" />
							</a> 
						</div>
						
                        </div>
						
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
							<?php if(isset($_REQUEST['search_report'])){?>
								<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
                                
								<div style="overflow-x:scroll; width:990px;">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example" align="auto" style="size:auto">
                                    <thead  >
										
                                         <tr >
										    <th>S.No</th>
											<th>Date</th>
                                            <th>PO No</th>
											<th>Customer Name</th>
											<th>Product Name</th>
                                            <th>PO QTY</th>
											<th>Production QTY</th>
											<th>Bal QTY</th>
										</tr>
                                    </thead>
                                    <tbody >
										<?php 
										$sno 		=1;
										$bal_kg     ='';
										$po_qty		='';
										$pe_qty		='';
										$bal_qty	='';
										
										
										
										foreach($invoice_list as $get_val){
										
										$bal_kg = $get_val['production_order_product_detail_qty']-$get_val['production_entry_product_detail_qty'];
										if($bal_kg>0){
										?>
										<tr>
											<td><?=$sno++?></td>
                                            <td><?=dateGeneralFormatN($get_val['production_order_date'])?></td>
                                            <td><?=$get_val['production_order_no']?></td>
                                            <td><?=$get_val['customer_name']?></td>
											<td><?=$get_val['product_name']?></td>
                                            <td><?=round($get_val['production_order_product_detail_qty'])?></td>
                                            <td><?=round($get_val['production_entry_product_detail_qty'])?></td>
                                            <td><?=round($bal_kg)?></td>
										</tr>
										<?php 
										
										  $po_qty		+=$get_val['production_order_product_detail_qty'];
									 	  $pe_qty		+=$get_val['production_entry_product_detail_qty'];
									 	  $bal_qty		+=$bal_kg;
										 }?>
										<?php 
										 
										   } ?>
									<tr>
										<td colspan="4">&nbsp;</td>
										<td><b>Total</b></td>
										<td style="text-align:right"><b><?php echo $po_qty;?></b></td>
										<td style="text-align:right"><b><?php echo $pe_qty;?></b></td>
										<td style="text-align:right"><b><?php echo $bal_qty;?></b></td>
									</tr>
										
										
										
										
									</tbody>
								</table>
								</div>
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
					$('#dataTables-example').DataTable( {
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
