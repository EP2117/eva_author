<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Sale</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">DELIVERY TO CUSTOMER  deleted successfully</div>';
		}  
	}
?>
<script type="text/javascript" src="<?php echo 'delivery-customer-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/reminder-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">GATE PASS ENTRY </h1>
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
                   <!-- Advanced Tables-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           GATE PASS ENTRY 
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
											<label class="control-label">D.O No.</label>
											<input type="text" class="form-control" name="search_entry_no" id="search_entry_no" value="<?=searchValue('search_entry_no')?>" / >
										</div>
									</div>
									</div>
						
						<div class="col-lg-6">
									<div class="form-group">
											<label class="control-label">Customer</label>
											<select name="customerid" id="customerid" class="form-control select2" style="width:100%"  >
												  <option value=""> - Select - </option>
												<?php
													foreach($customer_list	as	$get_customer){
													//$selected	= ($get_branch['customer_id']==searchValue('customerid'))?'selected="selected"':'';
												?>
							          <option value="<?=$get_customer['customer_id']?>" <?php if(searchValue('customerid')==$get_customer['customer_id']) {?> selected="selected" <?php }?>><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>
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
						
						<div class="col-lg-12">	
							&nbsp;
							</div>
			
						<div class="panel-body">
		
                            <div class="table-responsive">
							
							<?php if(isset($_REQUEST['search'])){?>
							
								<form action="index.php" method="post" id="delivery_customer_list_form" name="_list_form" >
                                <table  class="table table-striped table-bordered table-hover" id="dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th width="32">S.No</th>
											
                                            <th width="32">Date</th>
											<th width="50">D.O No.</th>
                                            <th width="111">Customer Name</th>
											
											<th width="98">Product Name</th>
											
											<th width="53">DTC qty</th>
											
											<th width="116">Gate Pass qty</th>
											
											<th width="60">Balance qty</th>
											
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($quotation_list	as $get_quotation){
										$qty=$get_quotation['delivery_customer_product_detail_qty']-$get_quotation['gatepass_entry_product_detail_qty'];
										if($qty>0)
										{
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                          
                                            <td><?=dateGeneralFormatN($get_quotation['delivery_customer_date'])?></td>
											 <td><?=$get_quotation['delivery_customer_no']?></td>
											<td><?=$get_quotation['customer_name']?></td>
											
											<td><?=$get_quotation['product_name']?></td>
											
											<td><?=round($get_quotation['delivery_customer_product_detail_qty'])?></td>
											
											<td><?=round($get_quotation['gatepass_entry_product_detail_qty'])?></td>
											
											<td><?=round($qty)?></td>
											
                                        </tr>
									<?php }} ?>
                                    </tbody>
                                </table>
								</form>
								<?php } ?>
								
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            	</div>
				<?php //} ?>
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
						<h4 class="modal-title" id="myModalLabel">DELIVERY TO CUSTOMER  Detail</h4>
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
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
    </div>
    <!-- /. FOOTER  -->
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
			$(".select2").select2();
			//Date picker
			$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#delivery_customer_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
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
