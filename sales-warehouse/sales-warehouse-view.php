<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Warehouse</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'Added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'Updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'Deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'Already exist!';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		}else {
			$msg = "";
		}

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/sales-warehouse/sales-warehouse-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Sales Warehouse</h1>

                        <h1 class="page-subhead-line">

							<?php

								if(isset($_GET['msg'])) {

									echo $msg;

								}

							?>

						</h1>

                    </div>

                </div>

				<form name="sw_form" id="sw_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Ton Per Feet Setting

								</div>
								<?php
									$inches = "";
									$mm = "";
									$feet = "1";
									$ton = "";
									if($_GET['id'] && $_GET['id'] != "") {
										$inches = $data_edit['inches'];
										$mm = $data_edit['mm'];
										$feet = $data_edit['feet'];
										$ton = $data_edit['ton'];
									}
								?>

								<div class="panel-body">

									<div class="col-lg-12" style="margin-left:0;padding-left:0">
									
										<div class="col-lg-4">											

											<div class="form-group">

												<label  class="control-label">Thick</label>

												<select name="thick" id="thick" class="form-control" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($arr_thick as $key=>$val){
														if($_GET['id'] && $_GET['id'] != "") {
														$select=($data_edit['thick']==$key)?'selected="selected"':'';
														} else {
															$select = '';
														}
													?>
														<option value="<?=$key?>" <?=$select;?>><?=$val?></option>
													<?php
														}
														?>
												</select>

											</div>

										</div>

										<div class="col-lg-4">			

											<div class="form-group">

												<label class="control-label">Inches</label>

												<input class="form-control" type="text" name="inches_txt" id="inches_txt" onkeyup="calcInchesMM('inches')" value="<?php echo $inches; ?>" required />

												<p></p>

											</div>

										</div>
										
										<div class="col-lg-4">			

											<div class="form-group">

												<label class="control-label">MM</label>

												<input class="form-control" type="text" name="mm_txt" id="mm_txt" onkeyup="calcInchesMM('mm')" value="<?php echo $mm; ?>" required />

											</div>

										</div>
									</div>
									
									<div class="col-lg-12" style="margin-left:0;padding-left:0">
									
										<div class="col-lg-4">			

											<div class="form-group">

												<label class="control-label">Feet</label>

												<input class="form-control" type="text" name="feet_txt" id="feet_txt"  required readonly value="<?php echo $feet; ?>" />

												<p></p>

											</div>

										</div>
										<div class="col-lg-4">			

											<div class="form-group">

												<label class="control-label">Ton</label>

												<input class="form-control" type="text" name="ton_txt" id="ton_txt" value="<?php echo $ton; ?>" required />

												<p></p>

											</div>

										</div>
									</div>
									
									<div class="col-lg-12">
										<div>		
											<button name="save_data" type="submit" class="btn btn-success">Save </button>

											<button type="reset" class="btn btn-danger">Reset </button>
											
											<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
										</div>
										<div class="text-right">
											<button type="button" class="btn btn-primary text-right"  onClick="location.href='index.php'">Add New</button>
										</div>

									</div>

								</div>

						</div>

					</div>

        		</div>
				
				</form>
                <!-- /. ROW  -->

			<!-- list start -->
			<?php
				if(isset($data_list) && count($data_list) > 0) {
			?>
			<form id="sw_list_form" method="post">
			<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Data Table

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th class="text-center">S.No</th>

											<th class="text-center">Thick</th>

                                            <th class="text-center">Inches</th>

                                            <th class="text-center">MM</th>
											
											<th class="text-center">Feet</th>

                                            <th class="text-center">Ton</th>

                                            <th>Action</th>
											
											<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit" name="delete_data" id="delete_data" value="Delete" class="btn btn-danger"></th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($data_list	as $data){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td>
											<?php 
											foreach($arr_thick as $key=>$val){ 
												if($data['thick']==$key) {
													echo $val;
												}
											}
											?>
											</td>

                                            <td><?=$data['inches']?></td>

											<td><?=$data['mm']?></td>
											
											<td><?=$data['feet']?></td>
											<td><?=$data['ton']?></td>

                                            <td class="center">

												<a href="index.php?id=<?php echo $data['id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>
											
											<td style="text-align:center"><input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $data['id']; ?>"></td>

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
			</form>
			<?php
				}
			?>
			<!-- list end -->

            </div>

            <!-- /. PAGE INNER  -->

        </div>

        <!-- /. PAGE WRAPPER  -->

    </div>

    <!-- /. WRAPPER  -->

    <div id="footer-sec">

        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>

    </div>

		<script>
			
			$( "#sw_form" ).validate({
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

					/*$('#dataTables-example').dataTable();*/

				});
		//Initialize Select2 Elements

		$(".select2").select2();
		</script>
    </body>

</html>

