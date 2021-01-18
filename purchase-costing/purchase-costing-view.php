<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>COUNTRY</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'Purchase Costing added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'Purchase Costing updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'Purchase Costing deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'Purchase Costing Code already added';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		} 

	}



?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>



<script type="text/javascript" src="<?php echo PROJECT_PATH.'/purchase-costing/purchase-costing-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Purchase Costing</h1>

                        <h1 class="page-subhead-line">

						

						</h1>

                    </div>

                </div>

				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								   Purchase Costing Detail

								</div>

								<div class="panel-body">

									<form name="pur_costing_form" id="pur_costing_form" method="post" >

										

										<div class="col-lg-12">			

											<div class="form-group">

												<label class="control-label">Name</label>

												<input class="form-control" type="text" name="pur_costing_name" id="pur_costing_name" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">

											<button name="pur_costing_insert" type="submit" class="btn btn-success">Save</button>

											<button type="reset" class="btn btn-danger">Reset</button>
											
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

								  	Purchase Costing Detail

								</div>

								<div class="panel-body">

									<form name="pur_costing_form" method="post" data-toggle="validator">

										<div class="col-lg-12">			

											<div class="form-group">

												<label>Name</label>

												<input class="form-control" type="text" name="pur_costing_name" id="pur_costing_name" value="<?=$pur_costing_edit['pur_costing_name']?>" required>

												<p></p>

											</div>

										</div>

										<div class="col-lg-12">

											<input type="hidden" name="pur_costing_id" id="pur_costing_id" value="<?=$pur_costing_edit['pur_costing_id']?>" />

											<input type="hidden" name="pur_costing_id" id="pur_costing_id" value="<?=$pur_costing_edit['pur_costing_id']?>" />

											<button name="pur_costing_update" type="submit" class="btn btn-success">Submit </button>

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

                           Purchase Costing List

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">
								<form action="index.php" method="post" id="pur_costing_form" name="pur_costing_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

                                            <th>Name</th>

                                            <th>Action</th>
											
											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="delete_pur_costing" type="submit" class="btn btn-danger">Delete</button>

											</th>
                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($pur_costing_list	as $get_pur_costing){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=ucfirst($get_pur_costing['pur_costing_name'])?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_pur_costing['pur_costing_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>
											
											<td>

												<input name="deleteCheck[]" value="<?php echo $get_pur_costing['pur_costing_id']; ?>" type="checkbox" />

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

  

	<script>

		$(document).ready(function () {

			$('#dataTables-example').DataTable( {

				responsive: true

			} );

			/*$('#dataTables-example').dataTable();*/

		});

		$(document).ready(function() {

			$('#pur_costing_form').bootstrapValidator({

				container: '#messages',

				feedbackIcons: {

					valid: 'glyphicon glyphicon-ok',

					invalid: 'glyphicon glyphicon-remove',

					validating: 'glyphicon glyphicon-refresh'

				},

				fields: {

					pur_costing_name: {

						validators: {

							notEmpty: {

								message: 'The full name is required and cannot be empty'

							}

						}

					}

				}

			});

		});
		
		$( "#pur_costing_form" ).validate({
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

