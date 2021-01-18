<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Leave</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/leave/leave-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/hr-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Leave</h1>
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
					<form name="leave-form" id="leave-form" method="post" data-toggle="validator">
						<input type="hidden" name="id" value="<?php  echo $id = empty($leave_edit['empLeaveId'])?"":$leave_edit['empLeaveId']; ?>" >
					
					<div class="row">
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  
					 	  <div class="panel panel-info">
								
								<div class="panel-heading">
								  	Leave
								</div>
								
								<div class="panel-body">
								
									<div class="col-lg-6">
										
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select class="form-control select2" style="width:100%" name="lv_branchid" id="lv_branchid" required>
											  <option value=""> - Select - </option>
												<?php
													foreach($branch_list as	$get_branch){
														if($leave_edit['lv_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
												<?php
														}
													?>
											</select>
										</div>
										
										<div class="form-group">
											<label class="control-label">Employee Name</label>											
												<input type="text" class="form-control" name="lv_employee" id="lv_employee"  value="<?php  echo empty($leave_edit['employee_name'])?"":$leave_edit['lv_employee_id'].' - '.$leave_edit['employee_name']; ?>" onKeyUp="return getEmployeesName(this.value,this,1);" required>			
										</div>											
										<div class="form-group">
											<label>Employee ID</label>	
											  <input type="text" class="form-control" name="lv_empid" id="lv_empid" readonly="" value="<?php echo empty($leave_edit['lv_employee_id'])?"":$leave_edit['lv_employee_id']; ?>">										
										</div>	
										
										<div class="form-group">
											<label class="control-label">Leave</label>
											<select class="form-control select2" style="width:100%" name="lv_leave" id="lv_leave" required>
											<?php echo $leave = empty($leave_edit['lv_leave'])?"":$leave_edit['lv_leave']; ?>
												  <option value=""> - Select - </option>
												  <option <?php if($leave==1){?> selected <?php }?> value="1">Full</option>
												  <option <?php if($leave==2){ ?> selected <?php }?> value="2">Half</option>
											</select>
										</div>
										<div class="form-group" >
											<label>Leave Type</label>	
											  <select name="lv_leavetype" id="lv_leavetype" class="form-control select2" style="width:100%">
													 <option value=""> - Select - </option>
											  <?php
													foreach($arr_leaveType as $key =>$val){
														if($leave_edit['lv_leavetype'] == $key){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$key?>"><?=$val?></option>
												<?php
													}
													?>
												</select>												
										</div>	
										<div class="form-group">
											<label>Remarks</label>
											<textarea class="form-control" rows="1" name="lv_remarks" id="lv_remarks"><?php echo empty($leave_edit['lv_remarks'])?"":$leave_edit['lv_remarks']; ?></textarea>
										</div>
										
										<div class="form-group">
													<label>payment</label>
													<select name="lv_paymentid" id="lv_paymentid" class="form-control select2" style="width:100%">
														 <option value=""> - Select - </option>
															<?php
																foreach($payment as	$key_value =>$list_value){
																	if($leave_edit['lv_paymentid'] == $key_value){ $select ='selected="selected"'; }else{ $select ='';}
																?>
																	<option <?php echo $select;?>  value="<?=$key_value?>"><?=$list_value?></option>
															<?php
																}
																?>
													</select>
												</div>								
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right lvdate" name="lv_date" id="lv_date" readonly="" value="<?php echo empty($leave_edit['lv_date'])?"":$leave_edit['lv_date']; ?>" required>
											</div>
										</div>		
										
										<div class="form-group" >
											<label>From date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="lv_fromdate" id="lv_fromdate" readonly="" value="<?php echo empty($leave_edit['lv_fromdate'])?"":$leave_edit['lv_fromdate']; ?>" >
											</div>
										</div>	
										<div class="form-group">
											<label>To date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="lv_todate" id="lv_todate" readonly="" value="<?php echo empty($leave_edit['lv_todate'])?"":$leave_edit['lv_todate']; ?>" >
											</div>
										</div>											
										<div class="form-group">
											<label>No.of days</label>	
											  <input type="text" class="form-control pull-right" name="lv_leaveno" id="lv_leaveno" readonly="" value="<?php echo empty($leave_edit['lv_leaveno'])?"":$leave_edit['lv_leaveno']; ?>">									
										</div>	
										<div class="form-group" style="padding-top:30px;">
											<label>Request By</label>	
											  <input type="text" class="form-control pull-right" name="lv_requestbyid" id="lv_requestbyid" value="<?php echo empty($leave_edit['lv_requestbyid'])?"":employeeFn_details($leave_edit['lv_requestbyid']); ?>" onKeyUp="return getEmployeesName(this.value,this,2);">										
										</div>	
										<div class="form-group" style="padding-top:30px;" >
											<label>Approval By</label>	
											  <input type="text" class="form-control pull-right" name="lv_approvalid" id="lv_approvalid" value="<?php echo empty($leave_edit['lv_approvalid'])?"":employeeFn_details($leave_edit['lv_approvalid']); ?>" onKeyUp="return getEmployeesName(this.value,this,2);">										
										</div>	
									</div>						
									
									
								</div>
								
								
						  </div>
						  
						</div>
					
						<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
								<button name="leave_insertupdate" type="submit" class="btn btn-success"><?php echo $btnVal; ?> </button>
								<button type="reset" class="btn btn-danger">Reset </button>
										<input type="button" value="Back" class="btn" onClick="location.href='index.php'">
						</div>	
        			</div>
				
				</form>		
				
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Leave list
							</div>
							<div class="panel-body">
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
								  <form name="leave-form" id="leave-form" method="post"  action="index.php"> 
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>											
												<th>Employee</th>
												<th>Branch</th>
												<th>Start date</th>
												<th>End date</th>
												<th>Date</th>
												<th>Action</th>
												<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit"name="leave_delete" id="leave_delete" value="Delete" class="btn btn-danger"></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($leaveResult as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['employee_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['lv_fromdate']; ?></td> 
												<td><?php echo $result['lv_todate']; ?></td> 
												<td><?php echo $result['lv_date']; ?></td>                                           
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['empLeaveId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td style="text-align:center"><input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $result['empLeaveId']?>"></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</form>
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
		
		$('.lvdate').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,	
		});	
		$('#lv_fromdate').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,	
		});	
		$('#lv_todate').datepicker({
			dateFormat:'dd/mm/yy',	
			changeMonth: true,
			changeYear: true,
			onSelect : function (selectedDate){
				var s_date = $('#lv_fromdate').val().split('/');
				var start  = new Date(s_date[1]+'/'+s_date[0]+'/'+s_date[2]);
				var e_date = selectedDate.split('/');
				var end    = new Date(e_date[1]+'/'+e_date[0]+'/'+e_date[2]);
					 days  = (end - start)/(1000 * 60 * 60 * 24);
					 day   = Math.round(days+1);
					 $("#lv_leaveno").val(day);
			}
		});		
			$( "#leave-form" ).validate({
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

 
