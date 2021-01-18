<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>STATE</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'State added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'State updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'State deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'State Code already added';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		} 

	}



?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>



<script type="text/javascript" src="<?php echo PROJECT_PATH.'/state/state-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">State</h1>

                        <h1 class="page-subhead-line">

						

						</h1>

                    </div>

                </div>

				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								   State Detail

								</div>

								<div class="panel-body">

									<form name="state_form" id="state_form" method="post" >

										<div class="col-lg-12">			

											<div class="form-group">

												<label class="control-label">Country</label>

												<select name="state_country_id" id="state_country_id" class="form-control" tabindex="1" required>

												  <option value="">Select</option>

												  <?php foreach($countryList as $countryValue){

												   ?>

												  <option value="<?php echo $countryValue['country_id']; ?>"><?php echo $countryValue['country_name']; ?></option>

												  <?php } ?>

												  </select>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">			

											<div class="form-group">

												<label class="control-label">Name</label>

												<input class="form-control" type="text" name="state_name" id="state_name" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">

											<button name="state_insert" type="submit" class="btn btn-success">Save</button>

											<button type="reset" class="btn btn-danger">Reset </button>
											<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

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

								  	State Detail

								</div>

								<div class="panel-body">

									<form name="state_form" method="post" data-toggle="validator">

										<div class="col-lg-12">			

											<div class="form-group">

												<label>Country</label>

												<select name="state_country_id" id="state_country_id" class="form-control" tabindex="1" required>

												  <option value="">Select</option>

												  <?php foreach($countryList as $countryValue){

												  	$selected	= ($state_edit['state_country_id']==$countryValue['country_id'])?'selected="selected"':'';

												   ?>

												  <option value="<?php echo $countryValue['country_id']; ?>" <?=$selected?>><?php echo $countryValue['country_name']; ?></option>

												  <?php } ?>

												  </select>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">			

											<div class="form-group">

												<label>Name</label>

												<input class="form-control" type="text" name="state_name" id="state_name" value="<?=$state_edit['state_name']?>" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">

											<input type="hidden" name="state_id" id="state_id" value="<?=$state_edit['state_id']?>" />

											<button name="state_update" type="submit" class="btn btn-success">Update </button>

											<button type="reset" class="btn btn-danger">Reset </button>
											<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

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

                           State List

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">
								<form action="index.php" method="post" id="state_form" name="state_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

                                            <th>Name</th>

                                            <th>Action</th>
											<th>

												<input name="checkall" onClick="checkedAlls();" type="checkbox"  />

												<button name="delete_state" type="submit" class="btn btn-danger">Delete</button>

											</th>
                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($state_list	as $get_state){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=ucfirst($get_state['state_name'])?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_state['state_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>
											<td>

												<input name="deleteCheck[]" value="<?php echo $get_state['state_id']; ?>" type="checkbox" />

											</td>
                                        </tr>

									<?php } ?>

                                    </tbody>

                                </table>
								
								</form>

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

	  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>

	<script>

		$(document).ready(function () {

			$('#dataTables-example').DataTable( {

				responsive: true

			} );

			/*$('#dataTables-example').dataTable();*/

		});

		$(document).ready(function() {

			$('#state_form').bootstrapValidator({

				container: '#messages',

				feedbackIcons: {

					valid: 'glyphicon glyphicon-ok',

					invalid: 'glyphicon glyphicon-remove',

					validating: 'glyphicon glyphicon-refresh'

				},

				fields: {

					state_name: {

						validators: {

							notEmpty: {

								message: 'The full name is required and cannot be empty'

							}

						}

					}

				}

			});

		});
		
		$( "#state_form" ).validate({
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

