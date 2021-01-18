<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Overtime</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/overtime/overtime-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/hr-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Overtime</h1>
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
						<form name="overtime-form" id="overtime-form" method="post" data-toggle="validator">
							<input type="hidden" name="id" value="<?php  echo $id = empty($ot_edit['empOtId'])?"":$ot_edit['empOtId']; ?>" >
							
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-xs-12">
									
									<div class="panel panel-info">
									
										<div class="panel-heading">
											Overtime
										</div>
										
										<div class="panel-body">
											
											<div class="col-lg-6">
												
												<div class="form-group">
													<label class="control-label">Branch</label>
													<select name="ot_branchid" id="ot_branchid" class="form-control select2" style="width:100%" required>
														 <option value=""> - Select - </option>
														<?php
														foreach($branch_list as	$get_branch){
														  if($ot_edit['ot_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
														 ?>
															<option <?php echo $select;?> value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
												
												<div class="form-group">
													<label class="control-label">Employee Name</label>											
														<input type="text" class="form-control" name="ot_employee" id="ot_employee" onKeyUp="return getEmployeesName(this.value,this,1);" value="<?php  echo empty($ot_edit['employee_name'])?"":$ot_edit['ot_employee_id'].' - '.$ot_edit['employee_name']; ?>" required>		
													
													
												</div>
												<div class="form-group">
													<label>Employee id</label>	
													  <input type="text" class="form-control" name="ot_empid" id="ot_empid" value="<?php  echo empty($ot_edit['ot_employee_id'])?"":$ot_edit['ot_employee_id']; ?>" readonly> 										
												</div>	
												<div class="form-group">
													<label class="control-label"> OT Type</label>
													<select id="ot_type_id" name="ot_type_id" class="form-control" onChange="get_amt(this.value);" required>
														<option value="">--Select--</option>
														<option value="1">Normal</option>
														<option value="2">Sat</option>
													</select>
												</div>
												<div class="form-group">
													<label>Rate</label>
													<input type="text" class="form-control" name="ot_rate" id="ot_rate" value="<?php  echo empty($ot_edit['ot_rate'])?"":$ot_edit['ot_rate']; ?>" readonly> 			
												</div>
												<div class="form-group">
														<label>From Time</label>
														<input type="text" class="form-control timepicker" name="ot_starttime" id="ot_starttime" value="<?php  echo empty($ot_edit['ot_starttime'])?"":$ot_edit['ot_starttime']; ?>"  onChange="return countTimer();">									
													</div>
												<div class="form-group">
														<label>To Time</label>
														<input type="text" class="form-control timepicker" name="ot_endtime" id="ot_endtime" value="<?php  echo empty($ot_edit['ot_endtime'])?"":$ot_edit['ot_endtime']; ?>" onChange="countTimer(); get_tot_amt();" >										
													</div>
												<div class="form-group">
													<label>Total hrs</label>
													<input type="text" class="form-control" name="ot_durationtime" id="ot_durationtime" value="<?php  echo empty($ot_edit['diftime'])?"":$ot_edit['diftime']; ?>" readonly="" >									
												</div>
																			
											
											</div>
											<div class="col-lg-6">
												
												<div class="form-group">
													<label class="control-label">Date</label>
													 <div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
													  <input type="text" class="form-control" name="ot_date" id="ot_date" value="<?php  echo empty($ot_edit['ot_date'])?"":$ot_edit['ot_date']; ?>" readonly="" required>
													</div>
												</div>												
												
												
												<div class="form-group" >
														<label>Amount</label>
														<input type="text" class="form-control" name="ot_amount" id="ot_amount" value="<?php  echo empty($ot_edit['ot_amount'])?"":$ot_edit['ot_amount']; ?>" readonly >									
													</div>
												<div class="form-group">
														<label>Aproval amnt</label>
														<input type="text" class="form-control" name="ot_aprovalamnt" id="ot_aprovalamnt" value="<?php  echo empty($ot_edit['ot_aprovalamnt'])?"":$ot_edit['ot_aprovalamnt']; ?>" >										
													</div>
												<div class="form-group">
													<label>Request By</label>
													<input type="text" class="form-control" name="ot_requestby" id="ot_requestby" value="<?php  echo empty($ot_edit['ot_requestby'])?"":employeeFn_details($ot_edit['ot_requestby']); ?>"  onKeyUp="return getEmployeesName(this.value,this,2);">									
												</div>
												<div class="form-group">
													<label>Approval By</label>
													<input type="text" class="form-control" name="ot_approvalby" id="ot_approvalby" value="<?php  echo empty($ot_edit['ot_approvalby'])?"":employeeFn_details($ot_edit['ot_approvalby']); ?>"  onKeyUp="return getEmployeesName(this.value,this,2);">									
												</div>
												<div class="form-group">
													<label>Remarks</label>
													<textarea id="ot_remarks" name="ot_remarks" class="form-control" rows="1"><?php  echo empty($ot_edit['ot_remarks'])?"":$ot_edit['ot_remarks']; ?></textarea>									
												</div>	
											</div>	
																			
										</div>
												
									</div>
											
								</div>
								<div class="col-lg-6">
								<?php  $btnVal = (!$id)?  'Save' : 'Update' ; ?>
									<button name="ot_insert_update" type="submit" class="btn btn-success"><?php echo $btnVal; ?> </button>
									<button type="reset" class="btn btn-danger">Reset</button>
											<input type="button" value="Back" class="btn" onClick="location.href='index.php'">
								</div>		
							
							</div>	
							
							
									
						</form>
						
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Overtime list
							</div>
							<div class="panel-body">
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
									<form name="overtime-form" id="overtime-form" method="post" data-toggle="validator">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>											
												<th>Employee</th>
												<th>Branch</th>
												<th>In-Time</th>
												<th>Out-Time</th>
												<th>Date</th>
												<th>Action</th>
													<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit"name="overtime_delete" id="overtime_delete" value="Delete" class="btn btn-danger"></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($otList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['employee_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['ot_starttime']; ?></td>
												<td><?php echo $result['ot_endtime']; ?></td>
												<td><?php echo $result['ot_date']; ?></td>                                           
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['empOtId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td style="text-align:center"><input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $result['empOtId']?>"></td>
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
	
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
    </div>
	<script>
		$(document).ready(function () {
			$('#dataTables-example').DataTable( {
				responsive: true
			} );
						
		});
		$('#ot_date').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,	
		});	
		$('.timepicker').timepicker({ 
			'timeFormat': 'H:i:s'
		 });
		 
		$( "#overtime-form" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
		});	  
			//overtime-form	
	</script>

</body>

 
