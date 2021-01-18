<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Branch</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = 'Branch added successfully';
		} else if($_GET['msg']==5) {
			$msg = 'Branch updated successfully';
		} else if($_GET['msg']==3) {
			$msg = 'Branch deleted successfully';
		} else if($_GET['msg']==4) {
			$msg = 'Branch Code already added';
		}else if($_GET['msg']==2) {
			$msg = 'Please fill all required fields';
		} 
	}

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/branch/branch-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Branch</h1>
                        <h1 class="page-subhead-line">
						
						</h1>
                    </div>
                </div>
				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								   Branch Add
								</div>
								<div class="panel-body">
									<form name="branch_form" id="branch_form" method="post" data-toggle="validator">
										<div class="col-lg-4">			
											<div class="form-group">
												<label class="control-label">Name</label>
												<input class="form-control" type="text" name="branch_name" id="branch_name" required>
												<p></p>
											</div>
											<div class="form-group">
												<label class="control-label">Code Type</label>
												<select class="form-control select2" name="branch_code_type" id="branch_code_type" onChange="checkCode(this.value)" required>
												  <option value="1">Manual</option>
												  <option value="2">Automatic</option>
												  
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Country</label>
												<select class="form-control select2" name="branch_country_id" id="branch_country_id" onChange="getState(this.value)" required>
													<option value="">--Select--</option>
												<?php
												  	foreach($country_list	as	$get_country){
												?>
												  		<option value="<?=$get_country['country_id']?>"><?=$get_country['country_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Office No</label>
												<input class="form-control" type="number"  name="branch_office_no" id="branch_office_no"  data-bind="value:replyNumber" >
											</div>
											<div class="form-group">
												<label>Zip Code</label>
												<input class="form-control" type="text"  name="branch_zip_code" id="branch_zip_code">
											</div>
										</div>
										<div class="col-lg-8">			
											<div class="form-group">
												<label class="control-label">Address</label>
												<textarea name="branch_address" id="branch_address" class="form-control" style="height:35px;" required></textarea>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="form-group">
												<label>Code</label>
												<div id="pro_id">
												<input class="form-control" type="text"  name="branch_code" id="branch_code">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label>State/Division</label>
												<div id="stateDiv">
												<select class="form-control select2" name="branch_state_id" id="branch_state_id">
												  <option value="">--Select--</option>
												</select>
												</div>
											</div>
											<div class="form-group">
												<label>Line Phone</label>
												<input class="form-control" type="number"  name="branch_line_phone" id="branch_line_phone" onKeyPress="return isNumber(event)">
											</div>
											<div class="form-group">
												<label>Fax No</label>
												<input class="form-control" type="text"  name="branch_fax_no" id="branch_fax_no">
											</div>
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label>City</label>
												<div id="cityDiv">
												<select class="form-control select2" name="branch_city_id" id="branch_city_id">
												  <option value="">--Select--</option>
												</select>
												</div>
											</div>
											<div class="form-group">
												<label>Email ID</label>
												<input class="form-control" type="email"  name="branch_email" id="branch_email">
											</div>
											<div class="form-group">
												<label>Prefix</label>
												<input class="form-control" type="text"  name="branch_prefix" id="branch_prefix">
											</div>
										</div>
										<div class="col-lg-6">
											<button name="branch_insert" type="submit" class="btn btn-success">Save </button>
											<button type="reset" class="btn btn-danger">Reset </button>
											<button type="button" class="btn " onClick="location.href='index.php'">Back </button>
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
								  	Branch Edit
								</div>
								<div class="panel-body">
									<form name="branch_form" method="post" data-toggle="validator">
										<div class="col-lg-4">			
											<div class="form-group">
												<label>Name</label>
												<input class="form-control" type="text" name="branch_name" id="branch_name" value="<?=$branch_edit['branch_name']?>" required>
												<p></p>
											</div>
										</div>
										<div class="col-lg-8">			
											<div class="form-group">
												<label>Code</label>
												<div id="pro_id">
												<input class="form-control" type="text"  name="branch_code" id="branch_code"  value="<?=$branch_edit['branch_code']?>">
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Address</label>
												<textarea name="branch_address" id="branch_address" class="form-control" ><?=$branch_edit['branch_address']?></textarea>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Country</label>
												<select class="form-control" name="branch_country_id" id="branch_country_id" onChange="getState(this.value)">
													<option value="">--Select--</option>
												<?php
												  	foreach($country_list	as	$get_country){
														$selected = ($get_country['country_id']==$branch_edit['branch_country_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_country['country_id']?>" <?=$selected?> ><?=$get_country['country_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Office No</label>
												<input class="form-control" type="text"  name="branch_office_no" id="branch_office_no" value="<?=$branch_edit['branch_office_no']?>" onKeyPress="return isNumber(event)">
											</div>
											<div class="form-group">
												<label>Zip Code</label>
												<input class="form-control" type="text"  name="branch_zip_code" id="branch_zip_code" value="<?=$branch_edit['branch_zip_code']?>">
											</div>
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label>State/Division</label>
												<div id="stateDiv">
												<select class="form-control select2" name="branch_state_id" id="branch_state_id">
												  <option value="">--Select--</option>
												<?php
												  	foreach($state_list	as	$get_state){
														$selected = ($get_state['state_id']==$branch_edit['branch_state_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_state['state_id']?>" <?=$selected?> ><?=$get_state['state_name']?></option>
												<?php
													}
												?>												
												</select>
												</div>
											</div>
											<div class="form-group">
												<label>Line Phone</label>
												<input class="form-control" type="number"  name="branch_line_phone" id="branch_line_phone"  value="<?=$branch_edit['branch_line_phone']?>"  min="0" data-bind="value:replyNumber" >
											</div>
											<div class="form-group">
												<label>Fax No</label>
												<input class="form-control" type="text"  name="branch_fax_no" id="branch_fax_no" value="<?=$branch_edit['branch_fax_no']?>">
											</div>
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label>City</label>
												<div id="cityDiv">
												<select class="form-control select2" name="branch_city_id" id="branch_city_id">
												  <option value="">--Select--</option>
												<?php
												  	foreach($city_list	as	$get_city){
														$selected = ($get_city['city_id']==$branch_edit['branch_city_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_city['city_id']?>" <?=$selected?> ><?=$get_city['city_name']?></option>
												<?php
													}
												?>
												</select>
												</div>
											</div>
											<div class="form-group">
												<label>Email ID</label>
												<input class="form-control" type="text"  name="branch_email" id="branch_email"  value="<?=$branch_edit['branch_email']?>">
											</div>
											<div class="form-group">
												<label>Prefix</label>
												<input class="form-control" type="text"  name="branch_prefix" id="branch_prefix"  value="<?=$branch_edit['branch_prefix']?>">
											</div>
										</div>
										<div class="col-lg-6">
											<input type="hidden" name="branch_id" id="branch_id" value="<?=$branch_edit['branch_id']?>" />
											<input type="hidden" name="branch_uniq_id" id="branch_uniq_id" value="<?=$branch_edit['branch_uniq_id']?>" />
											<button name="branch_update" type="submit" class="btn btn-success">Update </button>
											<button type="reset" class="btn btn-danger">Reset </button>
											<button type="button" class="btn " onClick="location.href='index.php'">Back </button>
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
                           Data Table
                        </div>
						
                        <div class="panel-body">
							&nbsp;
							<div style="text-align:right; padding-right:50px;"> 
							<button type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add </button></div>
							</div>
							&nbsp;
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>Code</th>
                                            <th>Name</th>
                                            <th>Office No</th>
                                            <th>Email ID</th>
                                           	<!-- <th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($branch_list	as $get_branch){
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_branch['branch_code']?></td>
                                            <td><?=ucfirst($get_branch['branch_name'])?></td>
                                            <td><?=ucfirst($get_branch['branch_office_no'])?></td>
											<td><?=ucfirst($get_branch['branch_email'])?></td>
                                            <!--<td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_branch['branch_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
      										</td>-->
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
			
			$( "#branch_form" ).validate({
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
