<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account Receivable</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		
		if($_GET['msg']==1) {
		
			$msg = 'Added successfully';
			
		}elseif($_GET['msg']==2) {
		
			$msg = 'Updated successfully';

		}elseif($_GET['msg']==3) {
		
			$msg = 'Deleted successfully';

		} 
	}			
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/account-receiveable/ac-receivable-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
				<div class="row">
				 <div class="col-md-12">
                        <h1 class="page-head-line">Account Receivable</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn " onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>
				</div>	
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>			
					<form name="acreceivable-form" id="expensepay-form" method="post">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editResult['acReceivableId'])?"":$editResult['acReceivableId']; ?>" >
					
					<div class="row">
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  
					 	  <div class="panel panel-info">
								
								<div class="panel-heading">
								  Account Receivable
									
								</div>
								
								<div class="panel-body">
								
									<div class="col-lg-6">
										
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select class="form-control select2" style="width:100%" name="branchid" id="branchid" required>
											  <option value=""> - Select - </option>
												<?php
													foreach($branch_list as	$get_branch){
														if($editResult['acR_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
												<?php
														}
													?>
											</select>
										</div>
										
										<div class="form-group">
											<label class="control-label">Receiable type</label>											
												<select class="form-control select2" style="width:100%" name="payable_typ" id="payable_typ" required>
											 	 <option value=""> - Select - </option>
												<?php
													foreach($arr_paytype as	$key=>$val){
														if($editResult['acR_payable_typ'] == $key){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$key?>"><?=$val?></option>
												<?php
														}
													?>
											</select>
										</div>										
										<div class="form-group">
											<?php  $type = empty($editResult['acR_payment_mode'])?"":$editResult['acR_payment_mode'];  ?>
											<label class="control-label">Payment mode</label>	
											  <select class="form-control select2" style="width:100%" name="payment_mode" id="payment_mode" onChange="return pay_mode(this.value);" required>
											 	 <option value=""> - Select - </option>
												<?php
													foreach($arr_pay_mode as $key=>$val){
														if($editResult['acR_payment_mode'] == $key){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$key?>"><?=$val?></option>
												<?php
														}
													?>
											</select>										
										</div>	
										
										<div class="form-group">
											<label>Credit A/c</label>
											<input type="text" class="form-control" name="credit_ac" id="credit_ac" value="<?php echo empty($editResult['acR_credit_ac'])?"":accounts_details($editResult['acR_credit_ac']); ?>" onFocus="return getAccountName(this.value,this,'credit');" onKeyUp="return getAccountName(this.value,this,'credit');">
											<input type="hidden" class="form-control" name="credit_cur_id" id="credit_cur_id" value="<?php echo empty($editResult['cre_currency_id'])?"":$editResult['cre_currency_id']; ?>">					
										</div>
										<div class="form-group" >
											<label>Debit A/c</label>	
											  <input type="text" class="form-control" name="debit_ac" id="debit_ac" value="<?php echo empty($editResult['acR_debit_ac'])?"":accounts_details($editResult['acR_debit_ac']); ?>" onFocus="return getAccountName(this.value,this,'debit');" onKeyUp="return getAccountName(this.value,this,'debit');">	
											  <input type="hidden" class="form-control" name="debit_cur_id" id="debit_cur_id" value="<?php echo empty($editResult['deb_currency_id'])?"":$editResult['deb_currency_id']; ?>">
											<input type="hidden" class="form-control" name="amount_debit_frgn" id="amount_debit_frgn" value="">	  									
										</div>	
										<div class="form-group">
											<label>Amount</label>
											<input type="text" class="form-control" name="amount" id="amount" value="<?php echo empty($editResult['acR_amount'])?"":$editResult['acR_amount']; ?>" onBlur="GetCurrecy_amt();">				
											<div id="t_amount_mmk"></div>
										</div>
										<div class="form-group" style="display:none" id="ref">
											<label>Ref Details</label>											
												<input type="text" class="form-control" name="ref_details" id="ref_details" value="<?php  echo empty($editResult['acR_ref_details'])?"":$editResult['acR_ref_details']; ?>">	
										</div>	
																	
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right lvdate" name="rec_date" id="rec_date" readonly="" value="<?php echo empty($editResult['acR_date'])?"":$editResult['acR_date']; ?>" required>
											</div>
										</div>		
										
																			
										<div class="form-group">
											<label>Narration</label>	
											  <textarea class="form-control" rows="1" cols="5" name="narration" id="narration"><?php echo empty($editResult['acR_narration'])?"":$editResult['acR_narration']; ?></textarea>										
										</div>	
										
										<div class="form-group">
											<label>Request by</label>
											<input type="text" class="form-control" name="request_by" id="request_by" value="<?php echo empty($editResult['acR_request_by'])?"":employeeFn_details($editResult['acR_request_by']); ?>" onFocus="return getEmployeesName(this.value,this);">				
										</div>
										<div class="form-group">
											<label>Approval by</label>	
											  <input type="text" class="form-control" name="approval_by" id="approval_by" value="<?php echo empty($editResult['acR_approval_by'])?"":employeeFn_details($editResult['acR_approval_by']); ?>" onFocus="return getEmployeesName(this.value,this);">										
										</div>
										<div class="form-group" id="r_chq" <?php if($type==1){?> style="display:none"<?php }else{?> style="display:block" <?php }?>>
											<label>Chequeno</label>
											 
											  <input type="text" class="form-control pull-right" name="acR_chequeno" id="acR_chequeno"  value="<?php echo empty($editResult['acR_chequeno'])?"":$editResult['acR_chequeno']; ?>">
											
										</div>
										
										<div class="form-group" id="r_date" <?php if($type==1){?> style="display:none"<?php }else{?> style="display:block" <?php }?>>
											<label>Cheque Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right lvdate" name="acR_chequedate" id="acR_chequedate" readonly="" value="<?php echo empty($editResult['acR_chequedate'])?"":dateGeneralFormatN($editResult['acR_chequedate']); ?>">
											</div>
										</div>
										<div class="form-group">
											<label>Amount In MMK</label>	
											  <input type="text" class="form-control" name="amount_mmk" id="amount_mmk" readonly="" value="<?php echo empty($editResult['acR_amount_mmk'])?"":$editResult['acR_amount_mmk']; ?>">									
										</div>		
										
									</div>						
									
									
								</div>
								
								
						  </div>
						  
						</div>
					
						<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
								<button name="acreceivable_insertupdate" type="submit" class="btn btn-success"><?php echo $btnVal; ?></button>
								<button type="reset" class="btn btn-danger">Reset</button>
						</div>	
						
        			</div>
				
				   </form>		
				
				<?php 
					}else{ 
					?>			
						<div class="panel panel-default">
							<div class="panel-heading">
								Account Setup 
							</div>
							<div class="panel-body">
								<form action="index.php" method="post">

								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>											
												<th>Branch</th>
												<th>Date</th>
												<th>Action</th>
												<th>
													<input name="checkall" id="checkall" onClick="checkedAll(this);" type="checkbox"  />
													<button name="expense_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($listResult as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['acR_date']; ?></td>                                           
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['acReceivableId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
													<input name="deleteCheck[]" class="check" value="<?php echo $result['acReceivableId']; ?>" type="checkbox" />
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
								</form>
								
							</div>

						</div>
						
				<?php } ?>
						
                <!-- /. ROW  -->

            </div>
			
            <!-- /. PAGE INNER  -->
        </div>
		
        <!-- /. PAGE WRAPPER  -->
    </div>
	
	
    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
	<script>
		$(document).ready(function () {
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
		});
		$('#rec_date').datepicker({	
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear: true,	
		});	
		$('.lvdate').datepicker({	
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear: true,	
		});
		$( "#expensepay-form" ).validate({
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

 
