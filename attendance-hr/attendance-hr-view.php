<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Attendance</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_REQUEST['msg'])) {
		
		if($_REQUEST['msg']==1) {
		
			$msg = 'Added successfully';
			
		}elseif($_REQUEST['msg']==2) {
		
			$msg = 'Updated successfully';

		} 
	}		
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/attendance-hr/openingbalance-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/hr-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
				<div class="row">
				 <div class="col-md-12">
                        <h1 class="page-head-line">Employee Attendance</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
                    </div>	
				 </div>	
					 <form id="attendance-hr" name="attendance-hr" method="post">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="panel panel-info">
								
									<div class="panel-heading">	
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-4">										
											<div class="form-group">
											<label>Date</label>
											  <input type="text" class="form-control pull-right" name="at_date" id="at_date" readonly="" value="<?php echo searchValue('at_date'); ?>">
										</div>		
											
										</div>																				
										<div class="col-lg-4" style="padding-top:30px;">
											<div class="form-group">
												<button name="employee_list" type="submit"class="btn btn-danger">Search</button>
											</div>	
										</div>	
										<div class="col-lg-4">										
										</div>	
									</div>
								
								</div>
							</div>
						</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							Employee Attendance
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table id="openingbalnc-tabl"  class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>S.No</th>	
											<th>Emp No</th>	
											<th>Emp Name</th>										
											<th>In time </th>
											<th>Out time</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!empty($resultArray)){
										$k	= 0;									
										foreach($resultArray as $result){
											$getResult = get_attendance($result['employee_id'],$_REQUEST['at_date']);
										?>
										<tr class="odd gradeX">
											<td><?php echo ($k+1); ?></td>
											<td><?php echo $result['employee_id']; ?></td>
											<td><?php echo $result['employee_name']; ?>
												<input type="hidden" name="id_<?php echo $k; ?>" value="<?php echo empty($getResult['empAtncId'])?"":$getResult['empAtncId']; ?>" >
												<input type="hidden" name="employeeid_<?php echo $k; ?>" value="<?php echo $result['employee_id']; ?>">
											</td>
											<td><input type="text" class="form-control timepicker" name="intime_<?php echo $k; ?>" id="intime_<?php echo $k; ?>"  value="<?php echo empty($getResult['atnc_intime'])?"":$getResult['atnc_intime']; ?>"></td>
											<td><input type="text" class="form-control timepicker" name="outtime_<?php echo $k; ?>" id="outtime_<?php echo $k; ?>"  value="<?php echo empty($getResult['atnc_outtime'])?"":$getResult['atnc_outtime']; ?>"></td>

											<td>
												<select name="hr_status_<?php echo $k; ?>" id="hr_status_<?php echo $k; ?>" class="form-control select2" style="width:100%" >
													<?php
													foreach($arr_leave_status as $key=>$val){
														if($getResult['hr_status'] == $key){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$key?>"><?=$val?></option>
													<?php
													}
													?>
												</select>
											
											</td>
										</tr>
																	   
									 <?php $k++;
									  }
										  $count= count($resultArray);
											echo '<input type="text" style="visibility:hidden" class="form-control" value="'.$count.'" name="emp_count" id="op_blnc" >';
										
										}
									  ?>
									</tbody>												
								</table>
							</div>
						</div>
						<div class="col-lg-12" style="padding-top:30px;">
							<div class="form-group">
								<button name="opening_balinsertUpdate" type="submit"class="btn btn-success">Update</button>
							</div>	
						</div>	
					</div>			
					</form>	

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
			$('#openingbalnc-tabl').DataTable( {
				scrollY:'700px',
				scrollCollapse:true,
				paging:false,
				scrollX: false,
				"paging":   false,
				"ordering": false,
				"info":     false
			});
		});
		$('.timepicker').timepicker({ 
			'timeFormat': 'H:i:s'
		 });
		$( "#at_date" ).datepicker({
			 dateFormat: 'dd-mm-yy',
			 changeMonth:true,
			 changeYear:true,
			 maxDate:'0'
		});
		$("#attendance-hr").validate({
			rules: {
				at_date: "required"
			}
		});					
	</script>

</body>

 
