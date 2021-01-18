	<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bank</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Bank added successfully</div>';
		} else if($_GET['msg']==5) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Bank updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Bank deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Bank Code already added';
		}else if($_GET['msg']==2) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = 'Deleted Contact Detail succesfull';
		} 
	}

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/bank/bank-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Bank</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) {
									echo $msg;
								}
							?>						
						</h1>
                    </div>
                </div>
				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>
				<form name="bank_form" id="bank_form" method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Bank Details
								</div>
								<div class="panel-body">
									
										<div class="col-lg-4">			
											<div class="form-group">
												<label class="control-label">Name</label>
												<input class="form-control" type="text" name="bank_name" id="bank_name"  required />
												<p></p>
											</div>
										</div>
										<div class="col-lg-4">			
											
											<div class="form-group">
												<label class="control-label">Code Type</label>
												<select class="form-control select2" name="bank_type" id="bank_type" onChange="checkCode(this.value)" required>
												  <option value="1">Manual</option>
												  <option value="2">Automatic</option>
												  
												</select>
											</div>
										</div>
										<div class="col-lg-4">	
											<div class="form-group">
												<label class="control-label">Code</label>
												<div id="pro_id">
												<input class="form-control" type="text"  name="bank_code" id="bank_code"  required/>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label class="control-label">Address</label>
												<textarea name="bank_address" id="bank_address" class="form-control" required></textarea>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="control-label">Country</label>
												<select class="form-control" name="bank_country_id" id="bank_country_id" onChange="getState(this.value)" required>
													<option value="">--Select--</option>
												<?php
												  	foreach($country_list	as	$get_country){
												?>
												  		<option value="<?=$get_country['country_id']?>"  ><?=$get_country['country_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Email ID</label>
												<input class="form-control" type="text"  name="bank_email" id="bank_email" required/ >
											</div>
											
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label class="control-label">State/Division</label>
												<div id="stateDiv">
												<select class="form-control select2" name="bank_state_id" id="bank_state_id" required/>
												  <option value="">--Select--</option>
												</select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label">Zip Code</label>
												<input class="form-control" type="text"  name="bank_zip_code" id="bank_zip_code" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="control-label">City</label>
												<div id="cityDiv">
												<select class="form-control select2" name="bank_city_id" id="bank_city_id" required>
												  <option value="">--Select--</option>
												</select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label">Fax No</label>
												<input class="form-control" type="text"  name="bank_fax_no" id="bank_fax_no" required/>
											</div>
										</div>
								</div>
						</div>
					</div>
        		</div>
				
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  Contact Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="multi-contact">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Contact No</th>
                                            <th>Email ID</th>
											<th>Extension No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<tr  class="odd gradeX">
										<td width="12%">
											<select name="bank_multi_contact_title[]" id="bank_multi_contact_title[]" class="form-control select2">
												  <option value=""> - Select - </option>
												   <option value="Mr.">Mr.</option> 
												  <option value="Mrs.">Mrs.</option>  
												  <option value="Miss.">Miss.</option>  
											</select>
										</td>
										<td width="17%">
										<input name="bank_multi_contact_name[]" type="text" value=""  id="bank_multi_contact_name[]" class="form-control"  /> 
										</td>
										<td width="16%">
										<input name="bank_multi_contact_department[]" type="text" value="" class="form-control" id="bank_multi_contact_department[]"  />
										</td>
										<td width="17%">
										<input name="bank_multi_contact_mobile_no[]" type="number" value="" class="form-control" id="bank_multi_contact_mobile_no[]"  />
										</td>
										<td width="17%">
										<input name="bank_multi_contact_email[]" type="email" value="" class="form-control" id="bank_multi_contact_email[]"/>
										</td>
										<td width="18%">
										<input name="bank_multi_contact_extn_no[]" type="text" value="" class="form-control" id="bank_multi_contact_extn_no[]" />
										</td>
									  </tr>
									</tbody>
								</table>
								</div>
								<div class="col-lg-6">
									<button name="bank_insert" type="submit" class="btn btn-primary">Submit Button</button>
									<button type="reset" class="btn btn-danger">Reset Button</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				</form>
				<?php }else if((isset($_GET['page']))  && (isset($_GET['id'])) && ($_GET['page']=='edit')) {
				?>
				<form name="bank_form" method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Bank Details
								</div>
								<div class="panel-body">
									
										<div class="col-lg-4">			
											<div class="form-group">
												<label>Name</label>
												<input class="form-control" type="text" name="bank_name" id="bank_name" value="<?=$bank_edit['bank_name']?>"  required />
												<p></p>
											</div>
										</div>
										<div class="col-lg-8">			
											<div class="form-group">
												<label>Code</label>
												<input class="form-control" type="text"  name="bank_code" id="bank_code"  value="<?=$bank_edit['bank_code']?>"   />
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Address</label>
												<textarea name="bank_address" id="bank_address" class="form-control" ><?=$bank_edit['bank_address']?></textarea>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Country</label>
												<select class="form-control" name="bank_country_id" id="bank_country_id" onChange="getState(this.value)">
													<option value="">--Select--</option>
												<?php
												  	foreach($country_list	as	$get_country){
														$selected = ($get_country['country_id']==$bank_edit['bank_country_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_country['country_id']?>" <?=$selected?> ><?=$get_country['country_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											
											<div class="form-group">
												<label>Email ID</label>
												<input class="form-control" type="text"  name="bank_email" id="bank_email" value="<?=$bank_edit['bank_email']?>"/ >
											</div>
											<div class="form-group">
												<label>Status</label>
												<select class="form-control select2" name="bank_active_status" id="bank_active_status">
													<option value="active" <?php if($bank_edit['bank_active_status']=="active"){ ?> selected="selected" <?php } ?>>Active</option>
													<option value="inactice" <?php if($bank_edit['bank_active_status']=="inactice"){ ?> selected="selected" <?php } ?>>InActive</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label>State/Division</label>
												<div id="stateDiv">
												<select class="form-control select2" name="bank_state_id" id="bank_state_id" >
												  <option value="">--Select--</option>
												<?php
												  	foreach($state_list	as	$get_state){
														$selected = ($get_state['state_id']==$bank_edit['bank_state_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_state['state_id']?>" <?=$selected?> ><?=$get_state['state_name']?></option>
												<?php
													}
												?>												
												</select>
												</div>
											</div>
											
											<div class="form-group">
												<label>Zip Code</label>
												<input class="form-control" type="text"  name="bank_zip_code" id="bank_zip_code" value="<?=$bank_edit['bank_zip_code']?>" />
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>City</label>
												<div id="cityDiv">
												<select class="form-control select2" name="bank_city_id" id="bank_city_id">
												  <option value="">--Select--</option>
												<?php
												  	foreach($city_list	as	$get_city){
														$selected = ($get_city['city_id']==$bank_edit['bank_city_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_city['city_id']?>" <?=$selected?> ><?=$get_city['city_name']?></option>
												<?php
													}
												?>
												</select>
												</div>
											</div>
											
											<div class="form-group">
												<label>Fax No</label>
												<input class="form-control" type="text"  name="bank_fax_no" id="bank_fax_no" value="<?=$bank_edit['bank_fax_no']?>" />
											</div>
										</div>
								</div>
						</div>
					</div>
        		</div>
				
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  Contact Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="multi-contact">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Contact No</th>
                                            <th>Email ID</th>
											<th>Extension No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											foreach($bank_con_edit as $get_bank_con){
										?>
											<tr  class="odd gradeX">
												<td width="12%">
													<input name="bank_multi_contact_id[]" type="hidden" value="<?=$get_bank_con['bank_multi_contact_id']?>"  id="bank_multi_contact_id[]" /> 
													<select name="bank_multi_contact_title[]" id="bank_multi_contact_title[]" class="form-control select2">
														  <option value=""> - Select - </option>
														   <option value="Mr." <?php if($get_bank_con['bank_multi_contact_title']=="Mr."){ ?> selected="selected" <?php } ?>>Mr.</option> 
														  <option value="Mrs." <?php if($get_bank_con['bank_multi_contact_title']=="Mrs."){ ?> selected="selected" <?php } ?>>Mrs.</option>  
														  <option value="Miss." <?php if($get_bank_con['bank_multi_contact_title']=="Miss."){ ?> selected="selected" <?php } ?>>Miss.</option>  
													</select>
												</td>
												<td width="17%">
												<input name="bank_multi_contact_name[]" type="text" id="bank_multi_contact_name[]" class="form-control" value="<?=$get_bank_con['bank_multi_contact_name']?>"  /> 
												</td>
												<td width="16%">
												<input name="bank_multi_contact_department[]" type="text" class="form-control" id="bank_multi_contact_department[]" value="<?=$get_bank_con['bank_multi_contact_department']?>" />
												</td>
												<td width="17%">
												<input name="bank_multi_contact_mobile_no[]" type="number" class="form-control" id="bank_multi_contact_mobile_no[]"  value="<?=$get_bank_con['bank_multi_contact_mobile_no']?>"/>
												</td>
												<td width="17%">
												<input name="bank_multi_contact_email[]" type="email" class="form-control" id="bank_multi_contact_email[]" value="<?=$get_bank_con['bank_multi_contact_email']?>"/>
												</td>
												<td width="18%">
												<input name="bank_multi_contact_extn_no[]" type="text" class="form-control" id="bank_multi_contact_extn_no[]" value="<?=$get_bank_con['bank_multi_contact_extn_no']?>"/>
												<a href="index.php?bank_multi_contact_id=<?=$get_bank_con['bank_multi_contact_id']?>&bank_uniq_id=<?php echo $bank_edit['bank_uniq_id']?>&multi_contact_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a>
												</td>
											  </tr>
										<?php
											}
										?>
										<tr  class="odd gradeX">
										<td width="12%">
											<select name="bank_multi_contact_title[]" id="bank_multi_contact_title[]" class="form-control select2">
												  <option value=""> - Select - </option>
												   <option value="Mr.">Mr.</option> 
												  <option value="Mrs.">Mrs.</option>  
												  <option value="Miss.">Miss.</option>  
											</select>
										</td>
										<td width="17%">
										<input name="bank_multi_contact_name[]" type="text" value=""  id="bank_multi_contact_name[]" class="form-control"  /> 
										</td>
										<td width="16%">
										<input name="bank_multi_contact_department[]" type="text" value="" class="form-control" id="bank_multi_contact_department[]"  />
										</td>
										<td width="17%">
										<input name="bank_multi_contact_mobile_no[]" type="number" value="" class="form-control" id="bank_multi_contact_mobile_no[]"  />
										</td>
										<td width="17%">
										<input name="bank_multi_contact_email[]" type="email" value="" class="form-control" id="bank_multi_contact_email[]"/>
										</td>
										<td width="18%">
										<input name="bank_multi_contact_extn_no[]" type="text" value="" class="form-control" id="bank_multi_contact_extn_no[]" />
										</td>
									  </tr>
									</tbody>
								</table>
								</div>
								<div class="col-lg-6">
											<input type="hidden" name="bank_id" id="bank_id" value="<?=$bank_edit['bank_id']?>" />
											<input type="hidden" name="bank_uniq_id" id="bank_uniq_id" value="<?=$bank_edit['bank_uniq_id']?>" />
									<button name="bank_update" type="submit" class="btn btn-primary">Submit Button</button>
									<button type="reset" class="btn btn-danger">Reset Button</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				</form>
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
                            <div class="table-responsive">
							   <form name="bank_form" id="bank_form" action="index.php" method="post">							
                                <table class="table table-striped table-bordered table-hover" id="dataTables-bank">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>Code</th>
                                            <th>Name</th>
                                            <th>Email ID</th>
                                            <th>Action</th>
											<th>
												<input name="checkall" onClick="checkedAll();" type="checkbox"  />
												<button name="bank_delete" type="submit" class="btn btn-danger">Delete</button>
											</th>

											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($bank_list	as $get_bank){
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_bank['bank_code']?></td>
                                            <td><?=ucfirst($get_bank['bank_name'])?></td>
											<td><?=ucfirst($get_bank['bank_email'])?></td>
                                            <td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_bank['bank_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
      										</td>
											<td>
												<input name="deleteCheck[]" value="<?php echo $get_bank['bank_uniq_id']; ?>" type="checkbox" />
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
   
	
			<script>
				$(document).ready(function () {
					$('#dataTables-bank').DataTable( {
						responsive: true
					} );
					/*$('#dataTables-example').dataTable();*/
				});
				
				$( "#bank_form" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
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
