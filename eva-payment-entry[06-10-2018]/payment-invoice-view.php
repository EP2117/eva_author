<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PAYMENT ENTRY</title>
<?php 

	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		
		if($_GET['msg']==1) {
		
			$msg = 'Added successfully';
			
		}elseif($_GET['msg']==2) {
		
			$msg = 'Updated successfully';

		} 
	}		
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-payment-entry/payment-invoice-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">payment Entry</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) { echo $msg; }
							?>
						</h1>
                    </div>
                </div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>	
					<form name="payment_invoice_forms" id="payment_invoice_forms" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editPayment['paymentId'])?"":$editPayment['paymentId']; ?>" >

						<div class="row">
						
							
							<div id="request" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Payment Entry								 
									</div>
									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required >
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editPayment['p_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											<div class="form-group">
												<label  class="control-label">Supplier location</label>
												<select name="supplier_location" id="supplier_location" class="form-control select2" style="width:100%" required onChange="return getsupplier(this.value);">
													 <?php $slocation = empty($editPayment['p_supplier_location'])?"":$editPayment['p_supplier_location']; ?>
													 <option value=""> - Select - </option>
													  <option <?php if($slocation==1){?> selected="selected" <?php }?> value="1">Local</option>
													  <option <?php if($slocation==2){?> selected="selected" <?php }?>value="2">Oversea</option>
												</select>
											</div>		
											<div class="form-group">
												<label>Currency</label>
												<select name="payment_currency_id" id="payment_currency_id" class="form-control select2" style="width:100%" onChange="GetcurRate()" >
													 <option value=""> - Select - </option>
													<?php foreach($arr_curr as $get_val){?>
													<option  value="<?= $get_val['currency_id']?>" <?php if(isset($editPayment['payment_currency_id']) && $editPayment['payment_currency_id']==$get_val['currency_id']){echo 'selected="selected"';} ?>><?=$get_val['currency_name']?></option>
													<? }?>
													
												</select>
											</div>											
										</div>																				
										<div class="col-lg-6">
											<div class="form-group">
												<label  class="control-label">Date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control rqrcdate"  name="paymentdate" id="paymentdate" readonly="" value="<?php echo empty($editPayment['p_paymentdate'])?date('d/m/Y'):$editPayment['p_paymentdate']; ?>" required >	
												</div>
											</div>	
											<div class="form-group">
												<label class="control-label">Supplier name</label>
													<select name="supplier_name" id="supplier_name" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($arr_supplier as	$get_branch){
															if($editPayment['p_supplier_name'] == $get_branch['supplier_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['supplier_id']?>"><?=$get_branch['supplier_name']?></option>
													<?php
														}
														?>
													
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Currency Rate</label>
													 <input type="text" class="form-control"  name="payment_currency_rate" id="payment_currency_rate"  value="<?php echo empty($editPayment['payment_currency_rate'])?"":$editPayment['payment_currency_rate']; ?>"  >	
											</div>
									</div>
									
								</div>		
								</div>						
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Invoice entry details
										<div style="text-align: right;">
										<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus" ></button>							 </div>
									</div>
									

									<div class="panel-body">
										<table id="payment_table" class="table table-striped table-bordered table-hover" style="width:200%">
											<thead>
											<?php $count_val = !empty($editPaymentdetails) ? count($editPaymentdetails) :''; ?>
												<tr style="">
													<th >Invoice no<input type="hidden" id="payment_apnd" name="payment_count" value="<?php echo (0<$count_val ? $count_val :1); ?>"></th>
													<th>Purchase amnt Cur</th>
													<th>Advance amnt  Cur</th>
													<th>Purchase amnt</th>
													<th>Advance amnt</th>
													<th>Paid amnt By Cur</th>
													<th>Paid amnt By MMK</th>
													<th>Amount</th>
													<th>Amount Cur</th>
													<th>Balance By Cur</th>
													<th>Balance By MMK</th>
													<th>Disc Per</th>
													<th>Disc</th>
													
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
												
												$count_id =count($editPaymentdetails);
												   for($i=1;$i<=count($editPaymentdetails);$i++){
													$j=$i-1;
												 ?>
												<tr id="remove_req_<?php echo $i; ?>">
												
														
													<td>
														<input type="hidden" name="iid_<?php echo $i; ?>" value="<?php echo $editPaymentdetails[$j]['paymentInvioiceId']; ?>">																
														<div class="ui-widget"><input type="hidden" class="form-control" name="invoiceid_<?php echo $i; ?>" id="invoiceid_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pi_invoiceId']; ?>" onKeyUp="return get_invoice(this.value,this,<?php echo $i; ?>,1);"><?php echo $editPaymentdetails[$j]['invoiceNo']; ?>
														</div>
													</td>
													<td>																
														<input type="text" class="form-control" name="purchaseamnt_cur_<?php echo $i; ?>" id="purchaseamnt_cur_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pI_invoice_total_amt']; ?>" >
													</td>
													<td>																
														<input type="text" class="form-control" name="advanceamnt_cur_<?php echo $i; ?>" id="advanceamnt_cur_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pR_advance_amount']; ?>" >
													</td>
													<td>																
														<input type="text" class="form-control" name="purchaseamnt_<?php echo $i; ?>" id="purchaseamnt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pI_invoicetotal']; ?>" >
													</td>
													<td>																
														<input type="text" class="form-control" name="advanceamnt_<?php echo $i; ?>" id="advanceamnt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pR_advanceAmnt']; ?>" >
													</td>
													
													<td>																
														<input type="text" class="form-control" name="paidamnt_cur_<?php echo $i; ?>" id="paidamnt_cur_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pi_paidamnt_cur']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="paidamnt_<?php echo $i; ?>" id="paidamnt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pi_paidamnt']; ?>">
													</td>
													
													
													
		
													<td>																
														<input type="text" class="form-control" name="amount_<?php echo $i; ?>" id="amount_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pi_amount']; ?>" onChange="return balance_calculation(this.value,this,'<?php echo $i; ?>');"></td>
													<td>
														
														<input  type="text" class="form-control" name="amount_cur_<?php echo $i; ?>" id="amount_cur_<?php echo $i; ?>"   value="<?php echo $editPaymentdetails[$j]['pi_amount_cur']; ?>" >
													</td>
													<td>																
														<input type="text" class="form-control" name="balanceamnt_cur_<?php echo $i; ?>" id="balanceamnt_cur_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pi_balanceamnt_cur']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="balanceamnt_<?php echo $i; ?>" id="balanceamnt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editPaymentdetails[$j]['pi_balanceamnt']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" class='form-control'  name="pay_det_desc_per_<?php echo $i; ?>" id="pay_det_desc_per<?php echo $i; ?>" value="<?php echo $editPaymentdetails[$j]['pi_descount_per']; ?>"  />
													</td>
													<td>																
														<input type="text" class="form-control" class='form-control'  name="pay_det_desc_amount_<?php echo $i; ?>" id="pay_det_desc_amount_<?php echo $i; ?>" value="<?php echo $editPaymentdetails[$j]['pi_descount_amt']; ?>" />
													</td>
													<td>
														<?php if($count_id>1){?>
													<a href="index.php?paymentInvioiceId=<?=$editPaymentdetails[$j]['paymentInvioiceId']?>&paymentId=<?php echo $editPayment['paymentId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a>	<?php } ?>
													</td>
												</tr>
											<?php   }
												  }else{
												 ?>	
												 
											 <?php }
											 ?>	
											</tbody>	
																						
										</table>					
									</div>
									
								</div>
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Payment details							 
									</div>
									
									<div class="panel-body">
										<div class="col-lg-3">										
											<div class="form-group">
												<label>Payment term</label>
												<select name="paymentterm" id="paymentterm" class="form-control select2" style="width:100%" onChange="get_paymentterm(this.value);" >
													 <option value=""> - Select - </option>
													
													<option  value="1" <?php if(isset($editPayment['p_paymentterm']) && $editPayment['p_paymentterm']==1){echo 'selected="selected"';} ?>>Cash</option>
													<option  value="2" <?php if(isset($editPayment['p_paymentterm']) && $editPayment['p_paymentterm']==2){echo 'selected="selected"';} ?>>Bank</option>
													
												</select>
													
											</div>	
											
																					
										</div>																				
										<div class="col-lg-3" id="d_bankname">										
											<div class="form-group">
												<label>Bank name</label>
												<select name="bankname" id="bankname" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
														foreach($arr_bank as	$get_bank){
															if($editPayment['p_bankname'] == $get_bank['bank_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_bank['bank_id']?>"><?=$get_bank['bank_name']?></option>
													<?php
														}
														?>
													
												</select>	
											</div>	
											
																					
										</div>	
										<div class="col-lg-3" id="d_acno">										
											<div class="form-group">
												<label>Bank A/c no</label>
												<input type="text" class="form-control" name="acno" id="acno"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo empty($editPayment['p_acno'])?"":$editPayment['p_acno']; ?>">
													
											</div>	
											
																					
										</div>	
									</div>		
								</div>
							</div>
							
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="payment_insrtUpdate" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
								<button type="reset" class="btn btn-danger">Reset </button>
								<input type="button" class="btn " onClick="location.href='index.php'" value="Back">
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Payment Entry List
							</div>
							<div class="panel-body">
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
								<form name="payment_invoice_forms" id="payment_invoice_forms" method="post" enctype="multipart/form-data">
									<table class="table table-striped table-bordered table-hover" id="dataTables-payment">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Payment id</th>
												<th>Supplier</th>
												<th>Branch</th>
												<th>Date</th>
												<th>Action</th>
												<th>
												<input name="checkall" onClick="checkedall();" type="checkbox"  />
												<button name="payment_invoice_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($paymentList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['paymentId']; ?></td> 
												<td><?php echo $result['supplier_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['p_paymentdate']; ?></td>
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['paymentId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
												<input name="deleteCheck[]" value="<?php echo $result['paymentId']; ?>" type="checkbox" />
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
    <div id="footer-sec">
        &copy; 2018 Authors | Design By : <a href="http://www.authorsmyanmar.com/" target="_blank">WWW.Authorsmyanmar.com</a>
    </div>
	


	
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
	<script>
		$(document).ready(function () {
			$('#dataTables-payment').DataTable( {
				responsive: true
			} );
			/*$('#dataTables-example').dataTable();*/
		});
				
		//Initialize Select2 Elements
		$(".select2").select2();
	 $(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#paymentdate" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
		
			$( "#production_planning_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#production_planning_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
		$( "#payment_invoice_forms" ).validate({
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

 
