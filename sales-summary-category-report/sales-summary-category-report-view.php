<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sales Summary Category Report</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/sales-summary-category-report/sales-summary-category-report-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/report-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Sales Summary Category Report</h1>
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
                           Sales Summary Category Report
                        </div>
                        <div class="panel-body">
							<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
								<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">Branch</label>
										<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" >
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
								<div class="col-lg-6">
									
									
									<?php if(isset($_REQUEST['search_type_id'])){
											$search_type_id=$_REQUEST['search_type_id'];
										}else{
											$search_type_id='';
										}
									?>
									<!-- <div class="form-group">
										<label>Type</label>
										<select name="search_type_id" id="search_type_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											 <option value="2" <?php if($search_type_id==2) { ?> selected="selected" <?php } ?>>Invoice</option>
											 <option value="1" <?php if($search_type_id==1) { ?> selected="selected" <?php } ?>>Direct Invoice</option>
											
										</select>
									</div> -->
									<?php if(isset($_REQUEST['search_category_id'])){
											$search_type_id=implode(',', $_REQUEST['search_category_id']);
										}else{
											$search_type_id='';
										}
									?>
									<div class="form-group">
										<label>category</label>
										<select name="search_category_id[]" id="search_category_id" class="form-control select2" multiple="" style="width:100%;" >
										 <option value=""> - Select - </option>
										<?php foreach($category as $get_val){
										$cat=(in_array($get_val['product_category_id'],searchValue('search_category_id'))==1)?'selected="selected"':'';
										?>
										<option value="<?=$get_val['product_category_id']?>"  <?=$cat?> > <?=$get_val['product_category_name']?></option>
										
										<?php }?>
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
									  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date" value="<?=searchValue('search_from_date')?>" >
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
                            Summary Category Report Detail
							<?php if(isset($_REQUEST['search_report'])){?>
							<div style="float:right;">
							<a href="<?php echo PROJECT_PATH.'/sales-summary-category-report/sales-summary-category-report-excel.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&search_to_date='.searchValue('search_to_date').'&search_type_id='.searchValue('search_type_id');?>" title="Download Excel" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/excel-icon.png'; ?>" width="28" border="0"   alt="Download Excel" title="Download Excel">
							</a>
						
							<a href="<?php echo PROJECT_PATH.'sales-summary-category-report/sales-summary-category-report-pdf.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&search_to_date='.searchValue('search_to_date').'&search_type_id='.searchValue('search_type_id');?>" title="Download PDF" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/pdf-icon.png'; ?>" width="28" />
							</a> 
						</div>
						<?php }?>
                        </div>
						
                        <div class="panel-body">
                            <div class="table-responsive">
							<?php if(isset($_REQUEST['search_report'])){?>
								<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-invoice-entry" style="width:990px">
                                    <thead >
                                        <tr>
                                            <th style="text-align:center">S.No</th>
											<th style="text-align:center">Category Name</th>
                                          	<th style="text-align:center">Type</th>
                                            <th style="text-align:center">Amount</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										$amt=0;
										foreach($invoice_list as $get_value){
									?>
										 <tr  class="odd gradeX">
										  <td class="text-right"><?php echo $s_no++;?></td>
										  <td><?= $get_value['product_category_name']?></td>
										  <td><?php if($get_value['invoice_entry_direct_type']==1){ echo 'Direct Invoice'; }else{ echo 'Invoice'; } ?></td>
										  <td style="text-align:right"><?php echo number_format($get_value['invoice_entry_net_amount']);?></td>
										</tr>
									<?php $amt=$amt+$get_value['invoice_entry_net_amount']; } ?>
									<tr>
										<td colspan="2">&nbsp;</td>
										<td><b>Total</b></td>
										<td style="text-align:right"><b><?php echo number_format($amt);?></b></td>
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
			/* $('#dataTables-invoice-entry').DataTable( {
				responsive: true
			} ); */
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
