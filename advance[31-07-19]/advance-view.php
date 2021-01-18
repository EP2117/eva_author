<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Advance</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/advance/advance-javascript.js'; ?>"></script>

</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/hr-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Advance</h1>
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
						<form id="advance" name="advance" method="post">
							<input type="hidden" name="id" value="<?php  echo $id = empty($salarydeduct_edit['empAdvanceId'])?"":$salarydeduct_edit['empAdvanceId']; ?>" >
							<div class="row">
								
								<div class="col-md-12 col-sm-12 col-xs-12">
									
									<div class="panel panel-info">
									
										<div class="panel-heading">
											Advance
										</div>
										
										<div class="panel-body">
											
											<div class="col-lg-6">
												
												<div class="form-group">
													<label class="control-label">Branch</label>
													<select name="ad_branchid" id="ad_branchid" class="form-control select2" style="width:100%" required>
														  <option value=""> - Select - </option>
														<?php
														foreach($branch_list as	$get_branch){
															if($salarydeduct_edit['ad_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
												
												<div class="form-group">
													<label class="control-label">Employee Name</label>											
															<input type="text" class="form-control" name="ad_employee" id="ad_employee" onKeyUp="return getEmployeesName(this.value,this,1);" value="<?php  echo empty($salarydeduct_edit['employee_name'])?"":$salarydeduct_edit['ad_employee_id'].' - '.$salarydeduct_edit['employee_name']; ?>" required>		
												</div>
												<div class="form-group">
													<label>Employee id</label>	
													  <input type="text" class="form-control" name="ad_empid" id="ad_empid" value="<?php  echo empty($salarydeduct_edit['ad_employee_id'])?"":$salarydeduct_edit['ad_employee_id']; ?>" readonly>										
												</div>	
												<div class="form-group">
													<label>Amount</label>
													<input type="text" class="form-control" name="ad_amount" id="ad_amount" value="<?php  echo empty($salarydeduct_edit['ad_amount'])?"":$salarydeduct_edit['ad_amount']; ?>">									
												</div>		
																			
											</div>
											<div class="col-lg-6">
											
												<div class="form-group">
													<label class="control-label">Date</label>
													 <div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
													  <input type="text" class="form-control" name="ad_date" id="ad_date" value="<?php  echo empty($salarydeduct_edit['ad_date'])?"":$salarydeduct_edit['ad_date']; ?>" readonly="" required>
													</div>
												</div>										
												<div class="form-group">
													<label>Request by</label>											
													<input type="text" class="form-control" name="ad_requestby" id="ad_requestby" value="<?php  echo empty($salarydeduct_edit['ad_requestby'])?"":employeeFn_details($salarydeduct_edit['ad_requestby']); ?>" onKeyUp="return getEmployeesName(this.value,this,2);">	
												</div>
												<div class="form-group">
													<label>Approval by</label>
													<input type="text" class="form-control" name="ad_approvalby" id="ad_approvalby" value="<?php  echo empty($salarydeduct_edit['ad_approvalby'])?"":employeeFn_details($salarydeduct_edit['ad_approvalby']); ?>" onKeyUp="return getEmployeesName(this.value,this,2);">									
												</div>
												<div class="form-group">
													<label>Remarks</label>
													<textarea id="ad_remarks" name="ad_remarks" class="form-control" rows="1"><?php  echo empty($salarydeduct_edit['ad_remarks'])?"":$salarydeduct_edit['ad_remarks']; ?></textarea>									
												</div>
												
											</div>	
																			
										</div>
										
									</div>
								</div>		
								<div class="col-lg-6">
								<?php  $btnVal = (!$id)?  'Save' : 'Update' ; ?>
									<button name="advanceinsert_upadet" type="submit" class="btn btn-success"><?php echo $btnVal; ?> </button>
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
								Advance list
							</div>
							<div class="panel-body">
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
									<form id="advance" name="advance" method="post" action="index.php">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>											
												<th>Employee</th>
												<th>Branch</th>
												<th>Advance amnt</th>
												<th>Date</th>
												<th>Action</th>
												<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit"name="advance_delete" id="advance_delete" value="Delete" class="btn btn-danger"></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($salaryDeductList	as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['employee_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['ad_amount']; ?></td>
												<td><?php echo $result['ad_date']; ?></td>                                           
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['empAdvanceId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td style="text-align:center"><input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $result['empAdvanceId']?>"></td>
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
		$('#ad_date').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
		});	
		
			
			$( "#advance" ).validate({
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

 
