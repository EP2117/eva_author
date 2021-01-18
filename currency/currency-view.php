<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>BRAND</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'Currency added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'Currency updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'Currency deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'Currency Code already added';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		} 

	}



?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>



<script type="text/javascript" src="<?php echo PROJECT_PATH.'/currency/currency-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Currency</h1>

                        <h1 class="page-subhead-line">

						

						</h1>

                    </div>

                </div>

				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								   Currency Detail

								</div>

								<div class="panel-body">

									<form name="currency_form" id="currency_form" method="post" >

										<div class="col-lg-6">			

											<div class="form-group">

												<label class="control-label">Code</label>

												<input class="form-control" type="text" name="currency_code" id="currency_code" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-6">			

											<div class="form-group">

												<label class="control-label">Name</label>

												<input class="form-control" type="text" name="currency_name" id="currency_name" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">

											<button name="currency_insert" type="submit" class="btn btn-success">Save </button>

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

								  	Currency Detail

								</div>

								<div class="panel-body">

									<form name="currency_form" method="post" data-toggle="validator">

										<div class="col-lg-6">			

											<div class="form-group">

												<label>Code</label>

												<input class="form-control" type="text" name="currency_code" id="currency_code" required value="<?=$currency_edit['currency_code']?>">

												<p></p>

											</div>

										</div>

										<div class="col-lg-6">			

											<div class="form-group">

												<label>Name</label>

												<input class="form-control" type="text" name="currency_name" id="currency_name" value="<?=$currency_edit['currency_name']?>" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">

											<input type="hidden" name="currency_id" id="currency_id" value="<?=$currency_edit['currency_id']?>" />

											<input type="hidden" name="currency_uniq_id" id="currency_uniq_id" value="<?=$currency_edit['currency_uniq_id']?>" />

											<button name="currency_update" type="submit" class="btn btn-success">Update </button>

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

                           Currency List

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

										foreach($currency_list	as $get_brand){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=ucfirst($get_brand['currency_name'])?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_brand['currency_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

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

	<script>
		$( "#currency_form" ).validate({
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

		$(document).ready(function() {

			$('#currency_form').bootstrapValidator({

				container: '#messages',

				feedbackIcons: {

					valid: 'glyphicon glyphicon-ok',

					invalid: 'glyphicon glyphicon-remove',

					validating: 'glyphicon glyphicon-refresh'

				},

				fields: {

					currency_name: {

						validators: {

							notEmpty: {

								message: 'The full name is required and cannot be empty'

							}

						}

					}

				}

			});

		});

</script>



</body>

</html>

