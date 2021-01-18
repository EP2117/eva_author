<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/employee/employee-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php 
			include "../includes/common/hr-left-menu.php"; 
			?> 
			<div id="page-wrapper">
				<div id="page-inner">				   
					
					<div class="row">
						<div class="col-md-12">
							<h1 class="page-head-line">Employee</h1>
							<h1 id="result" class="page-subhead-line">
								<?php
									if(isset($_GET['msg'])) { echo $msg; }
									?>
							</h1>
						</div>
					</div>					
					<?php 
						if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
			
						?>	
							
						<form id="employee" name="employee" method="post" data-toggle="validator">
							<input type="hidden" name="id" value="<?php  echo $id = empty($empEdit['employee_id'])?"":$empEdit['employee_id']; ?>" >
							
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
							 
									<div class="panel panel-info">
									
										<div class="panel-heading">
											Employee Details
										</div>
										
										<div class="panel-body">
											<div class="col-lg-4">
												
												<div class="form-group">
													<label class="control-label">Employee Name</label>
													<input type="text" name="employee_name" id="employee_name" class="form-control"  onKeyPress="return o_obj.Alpha_Numeric(this,event);" maxlength="25" value="<?php  echo empty($empEdit['employee_name'])?"":$empEdit['employee_name']; ?>" required>
												</div>
												<div class="form-group">
													<label class="control-label">Branch</label>
													<select name="branchid" id="branchid" class="form-control" style="width:100%" required>
														  <option value=""> - Select - </option>
													
														<?php
														foreach($branch_list as	$get_branch){
															if($empEdit['employee_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
														<?php
															}
														?>
													</select>
													
												</div>
												<div class="form-group">
													<label class="control-label">DOB</label>
													 <div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
													  <input type="text" class="form-control pull-right" name="dob" id="dob" readonly value="<?php  echo empty($empEdit['employee_dob'])?"":$empEdit['employee_dob']; ?>" required>
													</div>
												</div>	
												
												<div class="form-group">
													<label>Phone no</label>
													<input type="text" class="form-control" name="phone_no" id="phone_no"  onKeyPress="return o_obj.Numeric_only(this,event);" value="<?php echo empty($empEdit['employee_phone_no'])?"":$empEdit['employee_phone_no']; ?>">										
												</div>	
												<div class="form-group">
													<label>Mobile no</label>
													<input type="text" class="form-control" name="mobile_no" id="mobile_no"  onKeyPress="return o_obj.Numeric_only(this,event);" value="<?php echo empty($empEdit['employee_mobile_no'])?"":$empEdit['employee_mobile_no']; ?>">										
												</div>	
												<div class="form-group">
													<label>Email</label>
													<input type="text" class="form-control" name="email" id="email"   value="<?php echo empty($empEdit['employee_email'])?"":$empEdit['employee_email']; ?>">										
												</div>
												<div class="form-group">
													<label>Address</label>							 							
													<textarea class="form-control" rows="1" cols="3" name="address" id="adress"><?php echo empty($empEdit['employee_address'])?"":$empEdit['employee_address']; ?></textarea>							
												</div>
												<div class="form-group">
													<label>Gender</label></br>	
													<?php $check = empty($empEdit['employee_gender'])?"":$empEdit['employee_gender'];?>													
													&nbsp;&nbsp;<input type="radio" checked name="gender" id="gender" value="1">&nbsp;Male &nbsp;
													<input type="radio" name="gender" id="gender" value="2"	<?php  if($check==2){ echo 'checked'; } ?> >&nbsp;Female									
												</div>	
											
												<div class="form-group">	
													<label>Marital Status</label>
													<select name="marital_status" id="marital_status" class="form-control" style="width:100%">
														<option value=""> - Select - </option>
														<?php
															foreach($arr_meritalStatus as $key => $value) {
																if($empEdit['employee_marital_status'] == $key){ $select ='selected="selected"'; }else{ $select ='';}
															?>
																<option <?php echo $select;?>  value="<?=$key?>"><?=ucfirst($value)?></option>
															<?php
															}
														?>										 
													</select>	
												</div>			
																							
												<div class="form-group">
													<label>Qulification</label>
													<input type="text" class="form-control" name="qulification" id="qulification"  onKeyPress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo empty($empEdit['employee_qulification'])?"":$empEdit['employee_qulification']; ?>">										
												</div>
												<div class="form-group">
													<label>Total Experience</label>
													<input type="text" class="form-control" name="total_exp" id="total_exp"  onKeyPress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo empty($empEdit['employee_total_exp'])?"":$empEdit['employee_total_exp']; ?>">										
												</div>
												
												<div class="form-group">
													<label>Last Working Company</label>
													<input type="text" class="form-control" name="last_company" id="last_company"  onKeyPress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo empty($empEdit['employee_last_company'])?"":$empEdit['employee_last_company']; ?>">										
												</div>	
												<div class="form-group">
													<label>Basic Pay</label>
													<input type="text" class="form-control" name="basic_pay" id="basic_pay"  onKeyPress="return o_obj.Numeric_only(this,event);" value="<?php echo empty($empEdit['employee_basic_pay'])?"":$empEdit['employee_basic_pay']; ?>" onChange="return calulateSalary(this.value,this);">										
												</div>					
											</div>
											
											<div class="col-lg-4">
												
												
												<div class="form-group">
													<label>Deduction(Day)</label>
													<input type="text" class="form-control" name="deduction_day" id="deduction_day"  value="<?php echo empty($empEdit['employee_deduction_day'])?"":$empEdit['employee_deduction_day']; ?>" readonly> 										
												</div>
												<div class="form-group">
													<label>Deduction (Hr)</label>
													<input type="text" class="form-control" name="deduction_hrs" id="deduction_hrs"   value="<?php echo empty($empEdit['employee_deduction_hrs'])?"":$empEdit['employee_deduction_hrs']; ?>" readonly>										
												</div>
												<div class="form-group">
													<label>NRC</label>
													<input type="text" class="form-control" name="nrc" id="nrc"  onKeyPress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo empty($empEdit['employee_nrc'])?"":$empEdit['employee_nrc']; ?>">										
												</div>
												<div class="form-group">
													<label>Employee SSB</label>
													<input type="text" class="form-control" name="employee_ssb" id="employee_ssb" onkeypress='return o_obj.NumericDot_only(this,event);' onchange='return setTwoNumberDecimal(this.value,this);' value="<?php echo empty($empEdit['employee_employee_ssb'])?"":$empEdit['employee_employee_ssb']; ?>" >										
												</div>
												<div class="form-group">
													<label>Employeer SSB</label>
													<input type="text" class="form-control" name="employeer_ssb" id="employeer_ssb" onkeypress='return o_obj.NumericDot_only(this,event);' onchange='return setTwoNumberDecimal(this.value,this);' value="<?php echo empty($empEdit['employee_employeer_ssb'])?"":$empEdit['employee_employeer_ssb']; ?>" >										
												</div>
												
												
												<div class="form-group">
													<label>Total Leave Permit</label>
													<input type="text" class="form-control" name="leave_permit" id="leave_permit"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="return calculate_leavedays(this.value,this);" value="<?php echo empty($empEdit['employee_leave_permit'])?"":$empEdit['employee_leave_permit']; ?>">										
												</div>
												<div class="form-group">
													<label>Medical</label>
													<input type="text" class="form-control leave_day" name="medical_leave" id="medical_leave"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="return calculate_leavedays(this.value,this);" value="<?php echo empty($empEdit['employee_medical_leave'])?"":$empEdit['employee_medical_leave']; ?>">										
												</div>
												<div class="form-group">
													<label>Cascal</label>
													<input type="text" class="form-control leave_day" name="cascal_leave" id="cascal_leave"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="return calculate_leavedays(this.value,this);" value="<?php echo empty($empEdit['employee_cascal_leave'])?"":$empEdit['employee_cascal_leave']; ?>">										
												</div>
												<div class="form-group">
													<label>Annual</label>
													<input type="text" class="form-control leave_day" name="annual_leave" id="annual_leave"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="return calculate_leavedays(this.value,this);" value="<?php echo empty($empEdit['employee_annual_leave'])?"":$empEdit['employee_annual_leave']; ?>">										
												</div>
												<div class="form-group">
													<label>Other</label>
													<input type="text" class="form-control leave_day" name="other_leave" id="other_leave" onKeyPress="return o_obj.Numeric_only(this,event);" onChange="return calculate_leavedays(this.value,this);" value="<?php echo empty($empEdit['employee_other_leave'])?"":$empEdit['employee_other_leave']; ?>">										
												</div>
												<!--<div class="form-group">
													<label class="control-label">DOJ</label>
													 <div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>-->
										<div class="form-group">
													<label>Date Of Joining</label>
													<!--<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>-->
													<input type="text" class="form-control leave_day" name="customized" id="customized"  onKeyPress="return o_obj.Alpha_Numeric(this,event);" onChange="return calculate_leavedays(this.value,this);" value="<?php echo empty($empEdit['employee_customized'])?"":$empEdit['employee_customized']; ?>">
												</div>
												<div class="form-group">
													<label>Status</label></br>
													<select name="status" id="status" class="form-control" style="width:100%" onChange="return status_enabledisable(this.value);">
													<?php $status = empty($empEdit['employee_status'])?"":$empEdit['employee_status'];?>		
														<option value=""> - Select - </option>
														<option <?php if($status==1){?> selected <?php } ?> value="1">Temporary</option>	
														<option <?php if($status==2){?> selected <?php } ?> value="2">Permanent</option>									 
													</select>		
												</div>	
													<div class="form-group">
													<label>Bonus</label></br>	
													<?php $check = empty($empEdit['employee_bonus'])?"":$empEdit['employee_bonus'];?>													
													&nbsp;&nbsp;<input type="radio"  name="bonus" id="bonus_1" value="1" onClick="return status_enabledisable(this.value);" <?php  if($check==1){ echo 'checked'; } ?>>&nbsp;Yes &nbsp;
													<input type="radio" name="bonus" id="bonus_2" value="2" onClick="return status_enabledisable(this.value);" <?php  if($check==2){ echo 'checked'; } ?> >&nbsp;No									
												</div>
											</div>		
											<div class="col-lg-4">
											
												
												<div class="form-group">
													<label>Amount</label>
													<input type="text" class="form-control checkSts" name="bonus_amnt" id="bonus_amnt"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="moneyFrmtFn(this);" value="<?php echo empty($empEdit['employee_bonus_amnt'])?"":$empEdit['employee_bonus_amnt']; ?>">										
												</div>
												
												
												<div class="form-group">
													<label>Allowance</label></br>	
													<?php $check = empty($empEdit['employee_allowance'])?"":$empEdit['employee_allowance'];?>													
													&nbsp;&nbsp;<input type="radio"  name="allowance" id="allowance_1" value="1" onClick="return status_enabledisable(this.value);" <?php  if($check==1){ echo 'checked'; } ?>>&nbsp;Yes &nbsp;
													<input type="radio" name="allowance" id="allowance_2" value="2" onClick="return status_enabledisable(this.value);"	<?php  if($check==2){ echo 'checked'; } ?> >&nbsp;No									
												</div>
												<div class="form-group">
													<label>Phone Allow</label>
													<input type="text" class="form-control checkSts" name="phone_allowance" id="phone_allowance"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="moneyFrmtFn(this);" value="<?php echo empty($empEdit['employee_phone_allowance'])?"":$empEdit['employee_phone_allowance']; ?>">										
												</div>
												<div class="form-group">
													<label>Food Allow</label>
													<input type="text" class="form-control checkSts" name="food_allowance" id="food_allowance"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="moneyFrmtFn(this);" value="<?php echo empty($empEdit['employee_food_allowance'])?"":$empEdit['employee_food_allowance']; ?>">										
												</div>
												
												<div class="form-group">
													<label>Travel Allow</label>
													<input type="text" class="form-control checkSts" name="travel_allowance" id="travel_allowance"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="moneyFrmtFn(this);" value="<?php echo empty($empEdit['employee_travel_allowance'])?"":$empEdit['employee_travel_allowance']; ?>">										
												</div>
												<div class="form-group">
													<label>Other Allow</label>
													<input type="text" class="form-control checkSts" name="other_allowance" id="other_allowance"  onKeyPress="return o_obj.Numeric_only(this,event);" onChange="moneyFrmtFn(this);" value="<?php echo empty($empEdit['employee_other_allowance'])?"":$empEdit['employee_other_allowance']; ?>">										
												</div>
												<div class="form-group">
													<label> Normal OT</label>
													<input type="text" class="form-control" name="overtime_day" id="overtime_day"  value="<?php echo empty($empEdit['employee_overtime_day'])?"":$empEdit['employee_overtime_day']; ?>" >										
												</div>
												<div class="form-group">
													<label>Saturday OT</label>
													<input type="text" class="form-control" name="overtime_hrs" id="overtime_hrs"  value="<?php echo empty($empEdit['employee_overtime_hrs'])?"":$empEdit['employee_overtime_hrs']; ?>" >										
												</div>
												<div class="form-group">
													<label>Device id</label>
													<input type="text" class="form-control" name="device_id" id="device_id"  onKeyPress="return o_obj.Numeric_only(this,event);" value="<?php echo empty($empEdit['employee_device_id'])?"":$empEdit['employee_device_id']; ?>">										
												</div>
												
												<div class="form-group">
													<label>Supporting Pay</label>
													<input type="text" class="form-control" name="gov_bouns" id="gov_bouns" value="<?php echo empty($empEdit['gov_bouns'])?"":$empEdit['gov_bouns']; ?>">										
												</div>
												
												<div class="form-group">
													<label>Without Leave Bonus </label>
													<input type="text" class="form-control" name="without_bouns" id="without_bouns" value="<?php echo empty($empEdit['without_bouns'])?"":$empEdit['without_bouns']; ?>">										
												</div>
												
												<div class="form-group">
													<label>Exp Bonus </label>
													<input type="text" class="form-control" name="exp_bouns" id="exp_bouns"  value="<?php echo empty($empEdit['exp_bouns'])?"":$empEdit['exp_bouns']; ?>">										
												</div>
												
												<div class="form-group">
													<label> Other Bonus</label>
													<input type="text" class="form-control" name="other_bouns" id="other_bouns"  value="<?php echo empty($empEdit['other_bouns'])?"":$empEdit['other_bouns']; ?>">										
												</div>
												
											</div>											
										</div>
										
									</div>
							
								</div>
								
								<div class="col-lg-6">
									<?php  $btnVal = (!$id)?  'Save' : 'Update' ; ?>
										<button name="employee_insertupdate" type="submit" class="btn btn-success"><?php echo $btnVal; ?> </button>
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
								Employee list
							</div>
							<div class="panel-body">
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
								<form name="employee-form" id="employee-form" method="post" enctype="multipart/form-data">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>
												<th>Emp-id</th>											
												<th>Employee name</th>
												<th>Branch</th>
												<th>Mobile</th>
												<th>Address</th>
												<th>Status</th>
												<th>Action</th>
													<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit"name="employee_delete" id="employee_delete" value="Delete" class="btn btn-danger"></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($empResult	as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['employee_id']; ?></td>
												<td><?php echo $result['employee_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['employee_mobile_no']; ?></td>
												<td><?php echo $result['employee_address']; ?></td>
												<td><?php echo $result['employee_status']; ?></td>                                           
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['employee_id']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td style="text-align:center"><input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $result['employee_id']?>"></td>
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
		</div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
    </div>
  <script>
		$('#dataTables-example').DataTable( {
			responsive: true
		} );
		$('#dob').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0",
			maxDate:'0'
		});	
		
		$('#customized').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0",
			maxDate:'0'
		});	
					
		$( "#employee" ).validate({
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
