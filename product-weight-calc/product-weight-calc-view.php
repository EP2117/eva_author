<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Product Weight Calc</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'Production Section added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'Production Section updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'Production Section deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'Production Section Code already added';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		} 

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/production-section/production-section-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Product Weight Calc</h1>

                        <h1 class="page-subhead-line">

						

						</h1>

                    </div>

                </div>

				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								    Product Weight Calc Detail

								</div>

								<div class="panel-body">

									<form name="pwc_form" id="pwc_form" method="post" data-toggle="validator">

										
										<div class="col-lg-12">			
										
											<div class="form-group">
	
												<label class="control-label">Name</label>
	
												<select name="pwc_product_id" id="pwc_product_id" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($product_list as	$get_product){
														?>
															<option value="<?=$get_product['product_id']?>"><?=$get_product['product_name']?></option>
													<?php
														}
														?>
												</select>
	
												<p></p>
	
											</div>
											
										</div>
										<div class="col-lg-12">			

											<div class="form-group">

												<label class="control-label">Thick</label>

												<select class="form-control" name="pwc_thick_ness" id="pwc_thick_ness" required>
													<option value="">--Select--</option>
													<?php
														foreach($arr_thick as $value => $list){
													?>
														<option value="<?=$value?>"><?=ucfirst($list)?></option>
													<?php
													}
													?>
												</select>
											</div>

										</div>
										<div class="col-lg-12">			
										
											<div class="form-group">
	
												<label class="control-label">Name</label>
	
												<select name="pwc_type" id="pwc_type" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													 <option value="1">1 Ton </option>
													 <option value="2">1 Kg </option>
												</select>
	
												<p></p>
	
											</div>
											
										</div>
										<div class="col-lg-12">			
											<div class="form-group">
												<label class="control-label">Weight</label>
												<input type="text" class="form-control"  name="pwc_weight" id="pwc_weight" value=""   required>	
											</div>
										</div>
										<div class="col-lg-12">

											<button name="pwc_insert" type="submit" class="btn btn-success">Save </button>

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

								  	Product Weight Calc

								</div>

								<div class="panel-body">

									<form name="pwc_form" method="post" data-toggle="validator">

										<div class="col-lg-12">			
										
											<div class="form-group">
	
												<label class="control-label">Name</label>
	
												<select name="pwc_product_id" id="pwc_product_id" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($product_list as	$get_product){
															$selected	= ($pwc_edit['pwc_product_id']==$get_product['product_id'])?'selected="selected"':'';
														?>
															<option value="<?=$get_product['product_id']?>" <?=$selected?>><?=$get_product['product_name']?></option>
													<?php
														}
														?>
												</select>
	
												<p></p>
	
											</div>
											
										</div>
										<div class="col-lg-12">			

											<div class="form-group">

												<label class="control-label">Thick</label>

												<select class="form-control" name="pwc_thick_ness" id="pwc_thick_ness" required>
													<option value="">--Select--</option>
													<?php
														foreach($arr_thick as $value => $list){
															$selected	= ($pwc_edit['pwc_thick_ness']==$value)?'selected="selected"':'';
													?>
														<option value="<?=$value?>" <?=$selected?>><?=ucfirst($list)?></option>
													<?php
													}
													?>
												</select>
											</div>

										</div>
										<div class="col-lg-12">			
										
											<div class="form-group">
	
												<label class="control-label">Type</label>
	
												<select name="pwc_type" id="pwc_type" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													 <option value="1" <?php if($pwc_edit['pwc_type']==1){ ?> selected="selected" <?php } ?>>1 Ton </option>
													 <option value="2" <?php if($pwc_edit['pwc_type']==2){ ?> selected="selected" <?php } ?>>1 Kg </option>
												</select>
	
												<p></p>
	
											</div>
											
										</div>
										<div class="col-lg-12">			
											<div class="form-group">
												<label class="control-label">Weight</label>	
												<input type="text" class="form-control"  name="pwc_weight" id="pwc_weight" value="<?=$pwc_edit['pwc_weight']?>"   required>	
											</divpwc_weight										></div>

										<div class="col-lg-12">

											<input type="hidden" name="pwc_id" id="pwc_id" value="<?=$pwc_edit['pwc_id']?>" />

											<input type="hidden" name="pwc_uniq_id" id="pwc_uniq_id" value="<?=$pwc_edit['pwc_uniq_id']?>" />

											<button name="pwc_update" type="submit" class="btn btn-success">Update </button>

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

                           Product Weight Calc List

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

                                            <th>Product</th>
                                            <th>Thick</th>
                                            <th>Type</th>
                                            <th>Weight</th>
                                            <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;
										foreach($pwc_list	as $get_product_weight_cal){
										$pwc_type_val	= '';
										if($get_product_weight_cal['pwc_type']==1){
											$pwc_type_val	= "1 Ton";
										}elseif($get_product_weight_cal['pwc_type']==2){
											$pwc_type_val	= "1 Kg";
										}
									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=ucfirst($get_product_weight_cal['product_name'])?></td>
                                            <td><?=$arr_thick[$get_product_weight_cal['pwc_thick_ness']]?></td>
                                            <td><?=$pwc_type_val?></td>
                                            <td><?=$get_product_weight_cal['pwc_weight']?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_product_weight_cal['pwc_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

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
			$( "#pwc_form" ).validate({
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

