<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payroll</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		
		if($_GET['msg']==1) {
		
			$msg = 'Payroll process successfully';
			
		}elseif($_GET['msg']==2) {
		
			$msg = 'Updated successfully';

		} 
	}	
?>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/hr-left-menu.php"; ?> 
        <div id="page-wrapper">
             <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Payroll</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn btn-warning pull-right" onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Generate payroll</button>
							<?php } ?>
						</div>
                    </div>
                </div>				
				<?php 
				 if((isset($_GET['page'])) && ($_GET['page']=='add')){
				  ?>
					 <form id="payroll-form" name="payroll-form" method="post">
						<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
								<div class="panel panel-info">
								
									<div class="panel-heading">
										Payroll process
									</div>
									
									<div class="panel-body">
									
										<div class="col-lg-12">
										
											<div class="col-lg-3">
												<div class="form-group">
													<label>Branch</label>
													<select name="p_branchid" id="p_branchid" class="form-control" style="width:100%">
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
												
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Month</label>
													<select name="p_month" id="p_month" class="form-control" style="width:100%">
														<?php 
															 $y_mnth = date("m");
															for ($m=1; $m<=12; $m++) {
															 $month = date('F', mktime(0,0,0,$m, 1, date('Y'))); ?>
															<option  <?php if($y_mnth==$m){?> selected="selected" <?php } ?> value="<?php echo $m;?>"><?php echo $month;?></option>
															<?php	 
															 }
														?>
													</select>	
												</div>
												
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Year</label>
													<select name="p_year" id="p_year" class="form-control" style="width:100%">
													  <?php 
														$y_past = date("Y")-5; 
														$y_current = date("Y");
														for($i=date("Y");$i>$y_past;$i--){ ?>
														<option <?php if($y_current==$i){?> selected="selected" <?php } ?>><?php echo  $i; ?></option><?php
														}
													  ?>
													</select>	
												</div>
												
											</div>
											<div class="col-lg-3" style="padding-top:30px;">
												<button name="payrollentry" type="submit" class="btn btn-danger">Payroll generate</button>
											</div>
										</div>
									</div>
									
								</div>		
							</div>
					
						</div>
	
					</form>	
				<?php 
				}elseif((isset($_GET['page'])) && ($_GET['page']=='edit')){
				  ?>
				      <div class="row">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							   <div class="panel panel-info">
									<div class="panel-heading">
										Payroll Process
									</div>
									
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover" id="dataTables">
											<thead>
											  <tr>
												<th width="3%">S.No</th>
												<th width="13%">Employee No </th>
												<th width="80%">Name</th>
												<th width="4%" class="sorttable_nosort">Payslip</th>
												</tr>
											</thead>
											 <tbody>
											  <?php 
											   if(!empty($list_employee)){			  
												$sno = 1; 
												foreach($list_employee as $result) { 
												  ?>
												  <tr class="odd gradeX">
													<td><?php echo $sno++; ?></td>
													<td><?php echo $result['employee_id']; ?></td>
													<td><?php echo ucwords($result['employee_name']); ?></td>
													<td><a href="payroll-pdf.php?month=<?php echo $_GET['mm'];?>&year=<?php echo $_GET['yyyy'];?>&employee_id=<?php echo $result['employee_id'];?>" target="_blank"><img src="../images/view-icon.png" width="15" border="0" alt="Payslip" title="Payslip"></a></td>
													</tr>
												 <?php 
													}
												 } 
												 ?>
											  </tbody>
											
											</table>
										</div>
									</div>
									
								</div>
							</div>
							
					   </div>
				<?php 
					}else{ 
					?>	
						
						<div class="panel panel-default">
							<div class="panel-heading">
								Payroll summary
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>											
												<th>Month</th>
												<th>Year</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
											if(!empty($list_payroll)){
											$s_no	= 1;									
											foreach($list_payroll as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo date('F', mktime(0,0,0,$result['payroll_month'], 1, date('Y'))); ?></td>
												<td><?php echo $result['payroll_year']; ?></td>
												<td class="center">
												<a href="<?php echo PROJECT_PATH;?>/payroll/index.php?page=edit&id&mm=<?php echo $result['payroll_month']; ?>&yyyy=<?php echo $result['payroll_year']; ?>"><img src="../images/view-icon.png" width="15" border="0" alt="View" title="View"></a>
												</td>
											</tr>
										<?php } 
											}
										?>
										</tbody>
									</table>
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
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
		});	
		$("#payroll-form").validate({
				rules: {
					p_branchid: "required",
					p_month: "required",
					p_year: "required",	
				}
			});			
	</script>

</body>

 
