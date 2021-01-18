<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DEPARTMENT</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = 'Department added successfully';
		} else if($_GET['msg']==5) {
			$msg = 'Department updated successfully';
		} else if($_GET['msg']==3) {
			$msg = 'Department deleted successfully';
		} else if($_GET['msg']==4) {
			$msg = 'Department Code already added';
		}else if($_GET['msg']==2) {
			$msg = 'Please fill all required fields';
		} 
	}

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/department/department-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Department</h1>
                        <h1 class="page-subhead-line">
						
						</h1>
                    </div>
                </div>
				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								   Department Detail
								</div>
								<div class="panel-body">
									<form name="department_form" method="post" data-toggle="validator">
										<div class="col-lg-12">			
											<div class="form-group">
												<label>Name</label>
												<input class="form-control" type="text" name="department_name" id="department_name" required>
												<p></p>
											</div>
										</div>
										<div class="col-lg-12">
											<button name="department_insert" type="submit" class="btn btn-primary">Submit Button</button>
											<button type="reset" class="btn btn-danger">Reset Button</button>
										</div>
									</form>
								</div>
						</div>
					</div>
        		</div>
				<?php }else if((isset($_GET['page']))  && (isset($_GET['id'])) && ($_GET['page']=='edit')) {
				?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Department Detail
								</div>
								<div class="panel-body">
									<form name="department_form" method="post" data-toggle="validator">
										<div class="col-lg-12">			
											<div class="form-group">
												<label>Name</label>
												<input class="form-control" type="text" name="department_name" id="department_name" value="<?=$department_edit['department_name']?>" required>
												<p></p>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="hidden" name="department_id" id="department_id" value="<?=$department_edit['department_id']?>" />
											<input type="hidden" name="department_uniq_id" id="department_uniq_id" value="<?=$department_edit['department_uniq_id']?>" />
											<button name="department_update" type="submit" class="btn btn-primary">Submit Button</button>
											<button type="reset" class="btn btn-danger">Reset Button</button>
										</div>
									</form>
								</div>
						</div>
					</div>
        		</div>
				<?php
				} else{?>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Department List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($department_list	as $get_department){
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=ucfirst($get_department['department_name'])?></td>
                                            <td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_department['department_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
      										</td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            	</div>
				<?php } ?>
                <!-- /. ROW  -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
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
	
			<script>
				$(document).ready(function () {
					$('#dataTables-example').DataTable( {
						responsive: true
					} );
					/*$('#dataTables-example').dataTable();*/
				});
				
				
				$("[name='my-checkbox']").bootstrapSwitch();
				
				
				//Flat red color scheme for iCheck
		$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		  checkboxClass: 'icheckbox_flat-green',
		  radioClass: 'iradio_flat-green'
		});
		
		//Initialize Select2 Elements
		$(".select2").select2();
				
		</script>

</body>
</html>
