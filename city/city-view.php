<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>CITY</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'City added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'City updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'City deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'City Code already added';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		} 

	}



?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>



<script type="text/javascript" src="<?php echo PROJECT_PATH.'/city/city-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">City</h1>

                        <h1 class="page-subhead-line">

						

						</h1>

                    </div>

                </div>

				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								   City Detail

								</div>

								<div class="panel-body">

									<form name="city_form" id="city_form" method="post" >

										<div class="col-lg-12">			

											<div class="form-group">

												<label class="control-label">Country</label>

												<select name="city_country_id" id="city_country_id" class="form-control" tabindex="1" required onChange="getState(this.value)" required>

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

												<label class="control-label">City</label>

												<div id="stateDiv">

												<select name="city_state_id" id="city_state_id" class="form-control" tabindex="1" required>

												  <option value="">Select</option>

												  </select>

												</div>

											</div>

										</div>

										<div class="col-lg-12">			

											<div class="form-group">

												<label class="control-label">Name</label>

												<input class="form-control" type="text" name="city_name" id="city_name" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">

											<button name="city_insert" type="submit" class="btn btn-success">Save </button>

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

								  	City Detail

								</div>

								<div class="panel-body">

									<form name="city_form" method="post" data-toggle="validator">

										<div class="col-lg-12">			

											<div class="form-group">

												<label>Country</label>

												<select name="city_country_id" id="city_country_id" class="form-control" tabindex="1" required>

												  <option value="">Select</option>

												  <?php foreach($countryList as $countryValue){

												  	$selected	= ($city_edit['city_country_id']==$countryValue['country_id'])?'selected="selected"':'';

												   ?>

												  <option value="<?php echo $countryValue['country_id']; ?>" <?=$selected?>><?php echo $countryValue['country_name']; ?></option>

												  <?php } ?>

												  </select>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">			

											<div class="form-group">

												<label>City</label>

												<div id="stateDiv">

												<select name="city_state_id" id="city_state_id" class="form-control" tabindex="1" required>

												  <option value="">Select</option>

												  <?php foreach($state_list as $stateValue){

												  	$selected	= ($city_edit['city_state_id']==$stateValue['state_id'])?'selected="selected"':'';

												   ?>

												  <option value="<?php echo $stateValue['state_id']; ?>" <?=$selected?>><?php echo $stateValue['state_name']; ?></option>

												  <?php } ?>

												  </select>

												</div>

											</div>

										</div>

										<div class="col-lg-12">			

											<div class="form-group">

												<label>Name</label>

												<input class="form-control" type="text" name="city_name" id="city_name" value="<?=$city_edit['city_name']?>" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">

											<input type="hidden" name="city_id" id="city_id" value="<?=$city_edit['city_id']?>" />

											<button name="city_update" type="submit" class="btn btn-success">Update </button>

											<button type="reset" class="btn btn-danger">Reset</button>
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

                           City List

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">
							<form action="index.php" method="post" id="city_list_form" name="city_list_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

                                            <th>Name</th>

                                            <th>Action</th>
											
											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="delete_city" type="submit" class="btn btn-danger">Delete</button>

											</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($city_list	as $get_city){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=ucfirst($get_city['city_name'])?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_city['city_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>
											
											<td>

												<input name="deleteCheck[]" value="<?php echo $get_city['city_id']; ?>" type="checkbox" />

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

			$('#city_form').bootstrapValidator({

				container: '#messages',

				feedbackIcons: {

					valid: 'glyphicon glyphicon-ok',

					invalid: 'glyphicon glyphicon-remove',

					validating: 'glyphicon glyphicon-refresh'

				},

				fields: {

					city_name: {

						validators: {

							notEmpty: {

								message: 'The full name is required and cannot be empty'

							}

						}

					}

				}

			});

		});
		
		$( "#city_form" ).validate({
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

