<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/attendance/attendance-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/hr-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Attendance</h1>
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
					<form name="attendance-form" id="attendance-form" method="post" data-toggle="validator">
						<input type="hidden" name="id" value="<?php  echo $id = empty($Atnc_edit['empAtncId'])?"":$Atnc_edit['empAtncId']; ?>" >
						
						<div class="row">
						
							<div class="col-md-12 col-sm-12 col-xs-12">					   
							   <div class="panel panel-info">
										
										<div class="panel-heading">
											Attendance 
										</div>
										
										<div class="panel-body">
											
											<div class="col-lg-6">
												
												<div class="form-group">
													<label class="control-label">Branch</label>
													<select class="form-control select2" style="width:100%" name="atnc_branchid" id="atnc_branchid" required>
														<option value=""> - Select - </option>
														<?php
														foreach($branch_list as	$get_branch){
														  if($Atnc_edit['atnc_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
														 ?>
															<option <?php echo $select;?> value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
												
												<div class="form-group">
													<label class="control-label">Employee name</label>											
													<input type="text" class="form-control" name="atnc_employee" id="atnc_employee" onKeyUp="return getEmployeesName(this.value);" value="<?php  echo empty($Atnc_edit['employee_name'])?"":$Atnc_edit['atnc_employee_id'].' - '.$Atnc_edit['employee_name']; ?>" required>	
												</div>
												
												<div class="form-group">
													<label>Employee Id</label>											
													<input type="text" class="form-control" name="atnc_empid" id="atnc_empid" value="<?php echo empty($Atnc_edit['atnc_employee_id'])?"":$Atnc_edit['atnc_employee_id']; ?>" readonly="">		
												</div>
												
											</div>									
											
											<div class="col-lg-6">
												
												<div class="form-group">
													<label class="control-label">Date</label>
													<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>											
													   <input type="text" class="form-control" name="atnc_date" id="atnc_date" readonly="" value="<?php echo empty($Atnc_edit['atnc_date'])?"":$Atnc_edit['atnc_date']; ?>" required>
													</div>
												</div>
												
												<div class="form-group">
													<label>From time</label>
													<input type="text" class="form-control timepicker" name="atnc_intime" id="atnc_intime" value="<?php echo empty($Atnc_edit['atnc_outtime'])?"":$Atnc_edit['atnc_outtime']; ?>">
												</div>
												<div class="form-group">
													<label>To time</label>											
													<input type="text" class="form-control timepicker" name="atnc_outtime" id="atnc_outtime" value="<?php echo empty($Atnc_edit['atnc_outtime'])?"":$Atnc_edit['atnc_outtime']; ?>">
												</div>
												<div class="form-group">
													<label>Remark</label>
													<textarea  class="form-control " rows="1" id="atnc_remark" name="atnc_remark"><?php echo empty($Atnc_edit['atnc_remark'])?"":$Atnc_edit['atnc_remark']; ?></textarea>
												</div>
											</div>
											
																	
										</div>	
										
								</div>						
							</div>
							
							<div class="col-lg-6">
								<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
										<button name="atnc_addedit" type="submit" class="btn btn-success"><?php echo $btnVal; ?> </button>
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
								Attendance list
							</div>
							<div class="panel-body">
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
								<form name="attendance-form" id="attendance-form" method="post" data-toggle="validator">
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
												<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit"name="emp_delete" id="emp_delete" value="Delete" class="btn btn-danger"></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($atnceResult as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['employee_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['atnc_intime']; ?></td>
												<td><?php echo $result['atnc_outtime']; ?></td>
												<td><?php echo $result['d_ate']; ?></td>                                           
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['empAtncId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td style="text-align:center"><input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $result['empAtncId']?>"></td>
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
        <?=PROJECT_FOOTER?>
    </div>
	

	<script>
	$( "#attendance-form" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
		});	
		$(document).ready(function () {
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
		});
		$('#atnc_date').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,	
		});	
		$('.timepicker').timepicker({ 
			'timeFormat': 'H:i:s'
		 });
						
	</script>

</body>

 
