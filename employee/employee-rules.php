<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Interview</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/hr-employee/employee-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/hr-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Employee rules apply</h1>
						<button class="btn btn-info pull-right" onClick="location.href='index.php'">Back</button>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) { echo $msg; }
							?>
						</h1>
											
                    </div>
                </div>	
							
					<form name="emp_rulesApply" method="post" data-toggle="validator">
						<input type="hidden" name="id" value="<?php echo $id = empty($empruleEdit['empRulesId'])?"":$empruleEdit['empRulesId']; ?>" >

						<div class="row">
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div class="panel panel-info">							
									<div class="panel-heading">
										Attendacne and Off Day
									</div>
									
									<div class="panel-body">
										
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="10%">Conditions</th>
														<th width="15%">Day</th>
														<th width="10%">From Day</th>
														<th width="10%">To Day</th>
														<th width="12%">In Time</th>
														<th width="12%">Out Time</th>
														<th width="40%">Remarks</th>
													</tr>	
												</thead>
												<tbody>
												<?php
													$atncid = empty($empruleEdit['rls_ruleattendance_id'])?array('0'):explodefn($empruleEdit['rls_ruleattendance_id']); 
													for($i=0;$i<count($ruleAtnc);$i++ ){?>
													<tr>
														<td><input type="checkbox" name="ruleattendance_id[]" id="ruleattendance_id" value="<?php echo $ruleAtnc[$i]['empRuleAtncId']; ?>"  <?php if(in_array($ruleAtnc[$i]['empRuleAtncId'],$atncid)){ echo 'checked="checked"'; }?>/>&nbsp;<?php echo $ruleAtnc[$i]['rlAtnc_rulename'];?></td>
														<td><?php echo $arr_mstrAtnc[$ruleAtnc[$i]['rlAtnc_daytype']];?></td>
														<td><?php echo $arr_mstrAtncDays[$ruleAtnc[$i]['rlAtnc_fromdate']];?></td>
														<td><?php echo $arr_mstrAtncDays[$ruleAtnc[$i]['rlAtnc_todate']];?></td>
														<td><?php echo $ruleAtnc[$i]['rlAtnc_intime'];?></td>	
														<td><?php echo $ruleAtnc[$i]['rlAtnc_outtime'];?></td>	
														<td><?php echo $ruleAtnc[$i]['rlAtnc_remark'];?></td>									
													</tr>	
												<?php
													} 
												?>
													
																								
												</tbody>										
											</table>
										</div>
																		
									</div>								
								</div>		
								
								<div class="panel panel-info">							
									<div class="panel-heading">
										Leave	
									</div>
									
									<div class="panel-body">
										
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="10%">Conditions</th>
														<th width="15%">Title</th>
														<th width="15%">Experience</th>
														<th width="15%">Duration Date/time</th>															
														<th width="15%">Expire</th>														
														<th width="45%">Remarks</th>
													</tr>	
												</thead>
												<tbody>
												<?php 
													$leaveid = empty($empruleEdit['rls_ruleleave_id'])?array('0'):explodefn($empruleEdit['rls_ruleleave_id']); 
													for($i=0;$i<count($ruleLeave);$i++ ){?>
													<tr>
														<td><input type="checkbox" name="ruleleave_id[]" id="ruleleave_id"  value="<?php echo $ruleLeave[$i]['empRuleLeaveId']; ?>"  <?php if(in_array($ruleLeave[$i]['empRuleLeaveId'],$leaveid)){ echo 'checked="checked"'; }?>/>&nbsp;<?php echo $ruleLeave[$i]['rlLeav_rulename'];?></td>
														<td><?php echo $arr_leaveReason[$ruleLeave[$i]['rlLeav_leavetype']]; ?></td>
														<td><?php echo empty($ruleLeave[$i]['rlLeav_experience'])?'':$arr_mstrLeaveexperience[$ruleLeave[$i]['rlLeav_experience']];?></td>
														<td><?php  
																	if($ruleLeave[$i]['rlLeav_daytime']==1){
																		echo $ruleLeave[$i]['rlLeav_durationday']."&nbsp;days";
																	}elseif($ruleLeave[$i]['rlLeav_daytime']==2){
																		echo $ruleLeave[$i]['rlLeav_durationtime']."&nbsp;hours";
																	}
															?>
														</td>
														<td><?php echo $arr_mstrLeaveExpire[$ruleLeave[$i]['rlLeav_expire']];?></td>	
														<td><?php
															 
																if(!empty($ruleLeave[$i]['rlLeav_condition'])){
																	$k=1;
																	foreach(explode(',',$ruleLeave[$i]['rlLeav_condition']) as $val){
																		echo $k.".&nbsp;".$arr_mstrLeaveconditions[$val]."</br>";
																	$k++;
																	}
																}
															 ?>
														</td>
																						
													</tr>	
												<?php
													} 
												?>
												</tbody>										
											</table>
										</div>
																		
									</div>								
								</div>			
	
								<div class="panel panel-info">							
									<div class="panel-heading">
										Performance Evaluation
									</div>
									
									<div class="panel-body">
										
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="15%">#</th>
														<th width="25%">Position</th>
														<th width="20%">Mark</th>
														<th width="10%">Grade</th>
														<th width="25%">Remarks</th>	
													</tr>	
												</thead>
												<tbody>
												<?php
													$performnc = empty($empruleEdit['rls_ruleperformance_id'])?array('0'):explodefn($empruleEdit['rls_ruleperformance_id']);  
													for($i=0;$i<count($ruleperformance);$i++ ){?>
													<tr>
														<td><input type="checkbox" name="ruleperformance_id[]" id="performance" value="<?php echo $ruleperformance[$i]['empRulePerformceId']; ?>" <?php if(in_array($ruleperformance[$i]['empRulePerformceId'],$performnc)){ echo 'checked="checked"'; }?> />&nbsp;<?php echo $ruleperformance[$i]['rlPer_rulename'];?></td>
														<td><?php echo positionfn($ruleperformance[$i]['rlPer_position']); ?></td>
														<td><?php echo $arr_mstrmarks[$ruleperformance[$i]['rlPer_mark']];?></td>
														<td><?php echo $arr_mstrgrades[$ruleperformance[$i]['rlPer_grade']];?></td>
														<td><?php echo $ruleperformance[$i]['rlPer_remark'];?></td>
																						
													</tr>	
												<?php
													} 
												?>
												</tbody>										
											</table>
										</div>
																		
									</div>								
								</div>	
								
								<div class="panel panel-info">							
									<div class="panel-heading">
										Overtime
									</div>
									
									<div class="panel-body">
										
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="10%">#</th>
														<th width="15%">Days</th>
														<th width="10%">Position</th>
														<th width="10%">Starting Time</th>
														<th width="10%">Food Expense</th>
														<th width="20%">Overtime Amount</th>
														<th width="25%">Remark</th>
													</tr>	
												</thead>
												<tbody>
												<?php 
													$overtime = empty($empruleEdit['rls_ruleovertime_id'])?array('0'):explodefn($empruleEdit['rls_ruleovertime_id']); 
													for($i=0;$i<count($ruleOvertime);$i++ ){?>
													<tr>
														<td><input type="checkbox" name="ruleovertime_id[]" id="ruleovertime_id" value="<?php echo $ruleOvertime[$i]['empRuleOvertimeId']; ?>" <?php if(in_array($ruleOvertime[$i]['empRuleOvertimeId'],$overtime)){ echo 'checked="checked"'; }?> />&nbsp;<?php echo $ruleOvertime[$i]['rlOt_rulename'];?></td>
														<td><?php echo $arr_mstrOvertime_rule[$ruleOvertime[$i]['rlOt_daystype']];?></td>
														<td><?php echo positionfn($ruleOvertime[$i]['rlOt_position']);?></td>
														<td><?php echo $ruleOvertime[$i]['rlOt_overtime'];?></td>
														<td><?php echo $ruleOvertime[$i]['rlOt_foodexpense'];?></td>
														<td><?php echo $ruleOvertime[$i]['rlOt_overtimeamnt'];?></td>
														<td><?php echo $ruleOvertime[$i]['rlOt_remark'];?></td>
																						
													</tr>	
												<?php
													} 
												?>
													
												</tbody>										
											</table>
										</div>
																		
									</div>								
								</div>		
								
								
								<div class="panel panel-info">							
									<div class="panel-heading">
										Compensation
									</div>
									
									<div class="panel-body">
										
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="10%">#</th>
														<th width="15%">Title</th>
														<th width="15%">For whom?</th>
														<th width="15%">Narration</th>
														<th width="15%">Amount</th>														
														<th width="30%">Remarks</th>
													</tr>	
												</thead>
												<tbody>
												<?php 
												$compensation = empty($empruleEdit['rls_rulecompensation_id'])?array('0'):explodefn($empruleEdit['rls_rulecompensation_id']);
													for($i=0;$i<count($ruleCompensation);$i++ ){?>
													<tr>
														<td><input type="checkbox" name="rulecompensation_id[]" id="rulecompensation_id" value="<?php echo $ruleCompensation[$i]['empRuleCompensinId']; ?>"  <?php if(in_array($ruleCompensation[$i]['empRuleCompensinId'],$compensation)){ echo 'checked="checked"'; }?> />&nbsp;<?php echo $ruleCompensation[$i]['rlCmpsn_rulename'];?></td>
														<td><?php echo $ruleCompensation[$i]['rlCmpsn_titlename'];?></td>
														<td><?php if($ruleCompensation[$i]['rlCmpsn_forwhom']==1){
																	echo 'Employee';
																  }elseif($ruleCompensation[$i]['rlCmpsn_forwhom']==2){
																  	echo 'Family';
																  }?></td>
														<td><?php echo $ruleCompensation[$i]['rlCmpsn_narration'];?></td>
														<td><?php echo $ruleCompensation[$i]['rlCmpsn_amount'];?></td>
														<td><?php echo $ruleCompensation[$i]['rlCmpsn_remark'];?></td>
																						
													</tr>	
												<?php
													} 
												?>
												</tbody>										
											</table>
										</div>
																		
									</div>								
								</div>	
								
								
								<div class="panel panel-info">							
									<div class="panel-heading">
										Salary Deduction
									</div>
									
									<div class="panel-body">
										
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="15%">#</th>
														<th width="15%">Title</th>
														<th width="15%">Fines Name</th>
														<th width="15%">Fines Amount</th>														
														<th width="40%">Remark</th>
													</tr>	
												</thead>
												<tbody>
												<?php 
												$salarydeduct = empty($empruleEdit['rls_rulesalarydeduct_id'])?array('0'):explodefn($empruleEdit['rls_rulesalarydeduct_id']);
													for($i=0;$i<count($ruleSalarydeduct);$i++ ){?>
													<tr>
														<td><input type="checkbox" name="rulesalarydeduct_id[]" id="rulesalarydeduct_id"  value="<?php echo $ruleSalarydeduct[$i]['empRuleSalaryDeductId']; ?>"  <?php if(in_array($ruleSalarydeduct[$i]['empRuleSalaryDeductId'],$salarydeduct)){ echo 'checked="checked"'; }?>  />&nbsp;<?php echo $ruleSalarydeduct[$i]['rlSd_rulename'];?></td>
														<td><?php echo $arr_mstrSalaryDeducttypes[$ruleSalarydeduct[$i]['rlSd_salarydeducttype']];?></td>
														<td><?php echo $arr_mstrSalaryDeductFines[$ruleSalarydeduct[$i]['rlSd_fines']];?></td>
														<td><?php echo $ruleSalarydeduct[$i]['rlSd_amount'];?></td>
														<td><?php echo $ruleSalarydeduct[$i]['rlSd_remark'];?></td>
																						
													</tr>	
												<?php
													} 
												?>
																							
												</tbody>										
											</table>
										</div>
																		
									</div>								
								</div>		
								
								<div class="panel panel-info">							
									<div class="panel-heading">
										Salary Allowance
									</div>
									
									<div class="panel-body">
										
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="15%">#</th>
														<th width="15%">Title</th>
														<th width="15%">Allowance</th>
														<th width="15%">Fines Amount</th>
														<th width="40%">Remark</th>
													</tr>	
												</thead>
												<tbody>
												<?php 
													$salaryalwnc = empty($empruleEdit['rls_rulesalaryallowance_id'])?array('0'):explodefn($empruleEdit['rls_rulesalaryallowance_id']);
													for($i=0;$i<count($ruleSalaryallowance);$i++ ){?>
													<tr>
														<td><input type="checkbox" name="rulesalaryallowance_id[]" id="rulesalaryallowance_id" value="<?php echo $ruleSalaryallowance[$i]['empRuleSalaryAllowanceId']; ?>"  <?php if(in_array($ruleSalaryallowance[$i]['empRuleSalaryAllowanceId'],$salaryalwnc)){ echo 'checked="checked"'; }?> />&nbsp;<?php echo $ruleSalaryallowance[$i]['rlSa_rulename'];?></td>
														<td><?php echo $ruleSalaryallowance[$i]['rlSa_titlename'];?></td>
														<td><?php echo $ruleSalaryallowance[$i]['rlSa_allowance'];?></td>
														<td><?php echo $ruleSalaryallowance[$i]['rlSa_fineamnt'];?></td>
														<td><?php echo $ruleSalaryallowance[$i]['rlSa_remark'];?></td>
																						
													</tr>	
												<?php
													} 
												?>
												</tbody>										
											</table>
										</div>
																		
									</div>								
								</div>	
								
								
								<div class="panel panel-info">							
									<div class="panel-heading">
										SSB
									</div>
									
									<div class="panel-body">
										
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="20%">#</th>
														<th width="20%">Position</th>
														<th width="20%">Basic Salary</th>
														<th width="40%">Remarks</th>
													</tr>	
												</thead>
												<tbody>
												<?php 
													$ssb = empty($empruleEdit['rls_rulessb_id'])?array('0'):explodefn($empruleEdit['rls_rulessb_id']);
													for($i=0;$i<count($ruleSSB);$i++ ){?>
													<tr>
														<td><input type="checkbox" name="rulessb_id[]" id="rulessb_id" value="<?php echo $ruleSSB[$i]['empRuleSSBId']; ?>"   <?php if(in_array($ruleSSB[$i]['empRuleSSBId'],$ssb)){ echo 'checked="checked"'; }?> />&nbsp;<?php echo $ruleSSB[$i]['rlSsb_rulename'];?></td>
														<td><?php echo positionfn($ruleSSB[$i]['rlSsb_position']);?></td>
														<td><?php echo $ruleSSB[$i]['rlSsb_basicsalary'];?></td>
														<td><?php echo $ruleSSB[$i]['rlSsb_remark'];?></td>
																						
													</tr>	
												<?php
													} 
												?>
													
												</tbody>										
											</table>
										</div>
																		
									</div>								
								</div>		
	

								
							</div>
							
							<div class="col-lg-6">
							 <?php  $btnVal = (!$id)?  'Submit' : 'Update' ; ?>
								<button name="emp_rules" type="submit" class="btn btn-primary"><?php echo $btnVal; ?> Button</button>
								<button type="reset" class="btn btn-danger">Reset Button</button>
							</div>
							
						</div>
					</form>
				
						
					
								
             
			 

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
	
 <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
	     <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="../plugins/iCheck/icheck.min.js"></script>
	<script src="../plugins/select2/select2.full.min.js"></script>

	<!-- bootstrap datepicker -->
	<script src="../plugins/daterangepicker/daterangepicker.js"></script>
	<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="../assets/js/jquery-DOM.js"></script>

	<script>
			
		$('#cv_collection_date ,#dob').datepicker({	
			format: 'dd/mm/yyyy',
			startDate: '-3d'
		});	
				
	</script>

</body>

 
