<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Expense payable</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/expense-payable/expense-pay-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
				 <div class="col-md-12">
                        <h1 class="page-head-line">Expense payable</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn btn-warning pull-right" onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>	
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>			
					<form name="expensepay-form" id="expensepay-form" method="post">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editResult['acountSetupId'])?"":$editResult['acountSetupId']; ?>" >
					
					<div class="row">
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  
					 	  <div class="panel panel-info">
								
								<div class="panel-heading">
								  	Expense payable
									
								</div>
								
								<div class="panel-body">
								
									<div class="col-lg-6">
										
										<div class="form-group">
											<label>Branch</label>
											<select class="form-control select2" style="width:100%" name="branchid" id="branchid" >
											  <option value=""> - Select - </option>
												<?php
													foreach($branch_list as	$get_branch){
														if($editResult['exP_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
												<?php
														}
													?>
											</select>
										</div>
										
										<div class="form-group">
											<label>Payable type</label>											
												<input type="text" class="form-control" name="payable_typ" id="payable_typ"  value="<?php  echo empty($editResult['exP_debit_ac'])?"":$editResult['exP_debit_ac']; ?>">	
										</div>										
										<div class="form-group">
											<label>Payment mode</label>	
											  <input type="text" class="form-control" name="payment_mode" id="payment_mode" value="<?php echo empty($editResult['exP_payment_mode'])?"":$editResult['exP_payment_mode']; ?>">										
										</div>	
										
										<div class="form-group">
											<label>Credit A/c</label>
											<input type="text" class="form-control" name="credit_ac" id="credit_ac" value="<?php echo empty($editResult['exP_credit_ac'])?"":$editResult['exP_credit_ac']; ?>">				
										</div>
										<div class="form-group" >
											<label>Debit A/c</label>	
											  <input type="text" class="form-control" name="debit_ac" id="debit_ac" value="<?php echo empty($editResult['exP_debit_ac'])?"":$editResult['exP_debit_ac']; ?>">										
										</div>	
										<div class="form-group">
											<label>Amount</label>
											<input type="text" class="form-control" name="amount" id="amount" value="<?php echo empty($editResult['exP_amount'])?"":$editResult['exP_amount']; ?>">				
										</div>
										
																	
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right lvdate" name="expense_date" id="expense_date" readonly="" value="<?php echo empty($editResult['exP_expense_date'])?"":$editResult['exP_expense_date']; ?>">
											</div>
										</div>		
										
										<div class="form-group">
											<label>Ref Details</label>											
												<input type="text" class="form-control" name="ref_details" id="ref_details" value="<?php  echo empty($editResult['exP_ref_details'])?"":$editResult['exP_ref_details']; ?>">	
										</div>										
										<div class="form-group">
											<label>Narration</label>	
											  <textarea class="form-control" rows="1" cols="5" name="narration" id="narration"><?php echo empty($editResult['exP_narration'])?"":$editResult['exP_narration']; ?></textarea>										
										</div>	
										
										<div class="form-group">
											<label>Request by</label>
											<input type="text" class="form-control" name="request_by" id="request_by" value="<?php echo empty($editResult['exP_request_by'])?"":$editResult['exP_request_by']; ?>">				
										</div>
										<div class="form-group">
											<label>Approval by</label>	
											  <input type="text" class="form-control" name="approval_by" id="approval_by" value="<?php echo empty($editResult['exP_approval_by'])?"":$editResult['exP_approval_by']; ?>">										
										</div>	
										
									</div>						
									
									
								</div>
								
								
						  </div>
						  
						</div>
					
						<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Submit' : 'Update' ; ?>
								<button name="expense_insertupdate" type="submit" class="btn btn-primary"><?php echo $btnVal; ?> Button</button>
								<button type="reset" class="btn btn-danger">Reset Button</button>
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
												<td><?php echo $result['exP_expense_date']; ?></td>                                           
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['expensePayId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
													<input name="deleteCheck[]" class="check" value="<?php echo $result['expensePayId']; ?>" type="checkbox" />
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
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
		$('#expense_date').datepicker({	
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear: true,	
		});	
	</script>

</body>

 
