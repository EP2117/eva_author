<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Customer</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'Customer added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'Customer updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'Customer deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'Customer Code already added';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = 'Deleted Contact Detail succesfull';

		} 

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/customer/customer-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Customer</h1>

                        <h1 class="page-subhead-line">

						

						</h1>

                    </div>

                </div>

				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>

				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Customer Details

								</div>

								<div class="panel-body">

									

										<div class="col-lg-3">			

											<div class="form-group">

												<label class="control-label">Name</label>

												<input class="form-control" type="text" name="customer_name" id="customer_name"  required/>
												<input class="form-control" type="hidden" name="customer_id" id="customer_id" />

												<p></p>

											</div>

										</div>
										
										<div class="col-lg-3">			

											<div class="form-group">

												<label class="control-label">Code</label>

												<select id="customer_code_gen" name="customer_code_gen" class="form-control" onChange="get_customeCode(this.value);">
													<option value="1">manual</option>
													<option value="2">Automatic</option>
												</select>

												<p></p>

											</div>

										</div>

										<div class="col-lg-3">			

											<div class="form-group">

												<label class="control-label">&nbsp;</label>

												<input class="form-control" type="text"  name="customer_code" id="customer_code"  required/>

											</div>

										</div>

										<div class="col-lg-3">	

											<div class="form-group">

												<label class="control-label">Company Name</label>

												<input class="form-control" type="text"  name="customer_company_name" id="customer_company_name"  />

											</div>

										</div>

										<div class="col-lg-12">

											<div class="form-group">

												<labelclass="control-label" >Billing Address</label>

												<textarea name="customer_billing_address" id="customer_billing_address" class="form-control" ></textarea>

											</div>

										</div>

										<div class="col-lg-12">

											<div class="form-group">

												<label class="control-label">Address</label>

												<textarea name="customer_shipping_address" id="customer_shipping_address" class="form-control" ></textarea>

											</div>

										</div>

										<div class="col-lg-4">

											<div class="form-group">

												<label class="control-label">Country</label>

												<select class="form-control" name="customer_country_id" id="customer_country_id" onChange="getState(this.value)" required>

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

												<label class="control-label">Mobile No</label>

												<input class="form-control" type="number"  name="customer_mobile_no" id="customer_mobile_no" required/>

											</div>

											<div class="form-group">

												<label>Email ID</label>

												<input class="form-control" type="text"  name="customer_email" id="customer_email"/ >

											</div>

										</div>

										<div class="col-lg-4">

												<div class="form-group">

												<label>State/Division</label>

												<div id="stateDiv">

												<select class="form-control select2" name="customer_state_id" id="customer_state_id"/>

												  <option value="">--Select--</option>

												</select>

												</div>

											</div>

											<div class="form-group">

												<label>Line Phone</label>

												<input class="form-control" type="number"  name="customer_line_phone" id="customer_line_phone"  min="0" />

											</div>

											<div class="form-group">

												<label>Zip Code</label>

												<input class="form-control" type="text"  name="customer_zip_code" id="customer_zip_code" >

											</div>

										</div>

										<div class="col-lg-4">

											<div class="form-group">

												<label>City</label>

												<div id="cityDiv">

												<select class="form-control select2" name="customer_city_id" id="customer_city_id">

												  <option value="">--Select--</option>

												</select>

												</div>

											</div>

											<div class="form-group">

												<label>Contact No</label>

												<input class="form-control" type="number"  name="customer_contact_no" id="customer_contact_no"  min="0"/>

											</div>

											<div class="form-group">

												<label>Fax No</label>

												<input class="form-control" type="text"  name="customer_fax_no" id="customer_fax_no" />

											</div>

										</div>

								</div>

						</div>

					</div>

        		</div>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Account Details

								</div>

								<div class="panel-body">

									<div class="col-lg-4">

										<div class="form-group">

											<label>Currency Type</label>

											<select class="form-control" name="customer_currency_id" id="customer_currency_id" />

												<option value="">--Select--</option>

											<?php

												foreach($currency_list	as	$get_currency){

											?>

													<option value="<?=$get_currency['currency_id']?>"  ><?=$get_currency['currency_name']?></option>

											<?php

												}

											?>

											</select>

										</div>

										<div class="form-group">

											<label>Minimum Credit/Day</label>

											<input class="form-control" type="text"  name="customer_minimum_credit_per_day" id="customer_minimum_credit_per_day"/>

										</div>

										<div class="form-group">

											<label>Block</label>

											<input class="flat-red" type="radio"  name="customer_block_status" id="customer_block_status"  value="1"  /> Yes &nbsp;&nbsp;

											<input class="flat-red" type="radio"  name="customer_block_status" id="customer_block_status" checked="checked"   value="2" /> No 

										</div>

									</div>

									<div class="col-lg-4">

										<div class="form-group">

											<label>Location</label>

											<select class="form-control select2" name="customer_location" id="customer_location">

												<option value="1">Local</option>

												<option value="2">Oversea</option>

											</select>

										</div>

										<div class="form-group">

											<label>Min Sales Limits</label>

											<input class="form-control" type="text"  name="customer_minimum_sales_limit" id="customer_minimum_sales_limit" />

										</div>

										

										<div class="form-group">

											<label>Customer Type</label>

											<select class="form-control" name="customer_customer_type_id" id="customer_customer_type_id" >

												<option value="">--Select--</option>

											<?php

												foreach($customer_type_list	as	$get_customer_type){

											?>

													<option value="<?=$get_customer_type['customer_type_id']?>"  ><?=$get_customer_type['customer_type_name']?></option>

											<?php

												}

											?>

											</select>

										</div>

									</div>

									<div class="col-lg-4">

										<div class="form-group">

											<label>Total Credit Limits</label>

											<input class="form-control" type="text"  name="customer_total_credit_limit" id="customer_total_credit_limit" />

										</div>

										<div class="form-group">

											<label>Payment Days</label>

											<input class="form-control" type="text"  name="customer_payment_days" id="customer_payment_days" />

										</div>

										<div class="form-group">

											<label>Status</label>

											<select class="form-control select2" name="customer_active_status" id="customer_active_status">

												<option value="active">Active</option>

												<option value="inactice">InActive</option>

											</select>

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

											<select name="customer_multi_contact_title[]" id="customer_multi_contact_title[]" class="form-control select2">

												  <option value=""> - Select - </option>

												   <option value="Mr.">Mr.</option> 

												  <option value="Mrs.">Mrs.</option>  

												  <option value="Miss.">Miss.</option>  

											</select>

										</td>

										<td width="17%">

										<input name="customer_multi_contact_name[]" type="text" value=""  id="customer_multi_contact_name[]" class="form-control"  /> 

										</td>

										<td width="16%">

										<input name="customer_multi_contact_department[]" type="text" value="" class="form-control" id="customer_multi_contact_department[]"  />

										</td>

										<td width="17%">

										<input name="customer_multi_contact_mobile_no[]" type="number" value="" class="form-control" id="customer_multi_contact_mobile_no[]"  />

										</td>

										<td width="17%">

										<input name="customer_multi_contact_email[]" type="email" value="" class="form-control" id="customer_multi_contact_email[]"/>

										</td>

										<td width="18%">

										<input name="customer_multi_contact_extn_no[]" type="text" value="" class="form-control" id="customer_multi_contact_extn_no[]" />

										</td>

									  </tr>

									</tbody>

								</table>

								</div>

								<div class="col-lg-6">

									<button name="customer_insert" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>

							</div>

						</div>

					</div>

				</div>

				</form>

				<?php }else if((isset($_GET['page']))  && (isset($_GET['id'])) && ($_GET['page']=='edit')) {

				?>

				<form name="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Customer Details

								</div>

								<div class="panel-body">

									

										<div class="col-lg-4">			

											<div class="form-group">

												<label>Name</label>

												<input class="form-control" type="text" name="customer_name" id="customer_name" value="<?=$customer_edit['customer_name']?>"  required />

												<p></p>

											</div>

										</div>

										<div class="col-lg-4">			

											<div class="form-group">

												<label>Code</label>

												<input class="form-control" type="text"  name="customer_code" id="customer_code"  value="<?=$customer_edit['customer_code']?>"    readonly=""/>

											</div>

										</div>

										<div class="col-lg-4">	

											<div class="form-group">

												<label>Company Name</label>

												<input class="form-control" type="text"  name="customer_company_name" id="customer_company_name"  value="<?=$customer_edit['customer_company_name']?>"   />

											</div>

										</div>

										<div class="col-lg-12">

											<div class="form-group">

												<label>Billing Address</label>

												<textarea name="customer_billing_address" id="customer_billing_address" class="form-control" ><?=$customer_edit['customer_billing_address']?></textarea>

											</div>

										</div>

										<div class="col-lg-12">

											<div class="form-group">

												<label>Address</label>

												<textarea name="customer_shipping_address" id="customer_shipping_address" class="form-control" ><?=$customer_edit['customer_shipping_address']?></textarea>

											</div>

										</div>

										<div class="col-lg-4">

											<div class="form-group">

												<label>Country</label>

												<select class="form-control" name="customer_country_id" id="customer_country_id" onChange="getState(this.value)">

													<option value="">--Select--</option>

												<?php

												  	foreach($country_list	as	$get_country){

														$selected = ($get_country['country_id']==$customer_edit['customer_country_id'])?'selected="selected"':'';

												?>

												  		<option value="<?=$get_country['country_id']?>" <?=$selected?> ><?=$get_country['country_name']?></option>

												<?php

													}

												?>

												</select>

											</div>

											<div class="form-group">

												<label>Mobile No</label>

												<input class="form-control" type="number"  name="customer_mobile_no" id="customer_mobile_no" value="<?=$customer_edit['customer_mobile_no']?>"/>

											</div>

											<div class="form-group">

												<label>Email ID</label>

												<input class="form-control" type="text"  name="customer_email" id="customer_email" value="<?=$customer_edit['customer_email']?>"/ >

											</div>

										</div>

										<div class="col-lg-4">

												<div class="form-group">

												<label>State/Division</label>

												<div id="stateDiv">

												<select class="form-control select2" name="customer_state_id" id="customer_state_id" >

												  <option value="">--Select--</option>

												<?php

												  	foreach($state_list	as	$get_state){

														$selected = ($get_state['state_id']==$customer_edit['customer_state_id'])?'selected="selected"':'';

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

												<input class="form-control" type="number"  name="customer_line_phone" id="customer_line_phone"  min="0" value="<?=$customer_edit['customer_line_phone']?>" />

											</div>

											<div class="form-group">

												<label>Zip Code</label>

												<input class="form-control" type="text"  name="customer_zip_code" id="customer_zip_code" value="<?=$customer_edit['customer_zip_code']?>" />

											</div>

										</div>

										<div class="col-lg-4">

											<div class="form-group">

												<label>City</label>

												<div id="cityDiv">

												<select class="form-control select2" name="customer_city_id" id="customer_city_id">

												  <option value="">--Select--</option>

												<?php

												  	foreach($city_list	as	$get_city){

														$selected = ($get_city['city_id']==$customer_edit['customer_city_id'])?'selected="selected"':'';

												?>

												  		<option value="<?=$get_city['city_id']?>" <?=$selected?> ><?=$get_city['city_name']?></option>

												<?php

													}

												?>

												</select>

												</div>

											</div>

											<div class="form-group">

												<label>Contact No</label>

												<input class="form-control" type="number"  name="customer_contact_no" id="customer_contact_no"  min="0" value="<?=$customer_edit['customer_contact_no']?>"/>

											</div>

											<div class="form-group">

												<label>Fax No</label>

												<input class="form-control" type="text"  name="customer_fax_no" id="customer_fax_no" value="<?=$customer_edit['customer_fax_no']?>" />

											</div>

										</div>

								</div>

						</div>

					</div>

        		</div>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Account Details

								</div>

								<div class="panel-body">

									<div class="col-lg-4">

										<div class="form-group">

											<label>Currency Type</label>

											<select class="form-control" name="customer_currency_id" id="customer_currency_id" />

												<option value="">--Select--</option>

											<?php

												foreach($currency_list	as	$get_currency){

														$selected = ($get_currency['currency_id']==$customer_edit['customer_currency_id'])?'selected="selected"':'';

											?>

													<option value="<?=$get_currency['currency_id']?>"  <?=$selected ?>><?=$get_currency['currency_name']?></option>

											<?php

												}

											?>

											</select>

										</div>

										<div class="form-group">

											<label>Minimum Credit/Day</label>

											<input class="form-control" type="text"  name="customer_minimum_credit_per_day" id="customer_minimum_credit_per_day" value="<?=$customer_edit['customer_minimum_credit_per_day']?>"/>

										</div>

										<div class="form-group">

											<label>Block</label>

											<input class="flat-red" type="radio"  name="customer_block_status" id="customer_block_status" <?php if($customer_edit['customer_currency_id']==1){ ?> checked="checked" <?php } ?> value="1" /> Yes &nbsp;&nbsp;

											 <input  class="flat-red" type="radio"  name="customer_block_status" id="customer_block_status" <?php if($customer_edit['customer_currency_id']==2){ ?> checked="checked" <?php } ?> checked="checked"  value="2"  /> No 

										</div>

									</div>

									<div class="col-lg-4">

										<div class="form-group">

											<label>Location</label>

											<select class="form-control select2" name="customer_location" id="customer_location">

												<option value="1" <?php if($customer_edit['customer_location']==1){ ?> selected="selected" <?php } ?>>Local</option>

												<option value="2" <?php if($customer_edit['customer_location']==2){ ?> selected="selected" <?php } ?>>Oversea</option>

											</select>

										</div>

										<div class="form-group">

											<label>Min Sales Limits</label>

											<input class="form-control" type="text"  name="customer_minimum_sales_limit" id="customer_minimum_sales_limit"  value="<?=$customer_edit['customer_minimum_credit_per_day']?>"/>

										</div>

										

										<div class="form-group">

											<label>Customer Type</label>

											<select class="form-control" name="customer_customer_type_id" id="customer_customer_type_id" >

												<option value="">--Select--</option>

											<?php

												foreach($customer_type_list	as	$get_customer_type){

													$selected = ($get_customer_type['customer_type_id']==$customer_edit['customer_customer_type_id'])?'selected="selected"':'';

											?>

													<option value="<?=$get_customer_type['customer_type_id']?>" <?=$selected?> ><?=$get_customer_type['customer_type_name']?></option>

											<?php

												}

											?>

											</select>

										</div>

									</div>

									<div class="col-lg-4">

										<div class="form-group">

											<label>Total Credit Limits</label>

											<input class="form-control" type="text"  name="customer_total_credit_limit" id="customer_total_credit_limit"  value="<?=$customer_edit['customer_total_credit_limit']?>"/>

										</div>

										<div class="form-group">

											<label>Payment Days</label>

											<input class="form-control" type="text"  name="customer_payment_days" id="customer_payment_days" value="<?=$customer_edit['customer_payment_days']?>" />

										</div>

										<div class="form-group">

											<label>Status</label>

											<select class="form-control select2" name="customer_active_status" id="customer_active_status">

												<option value="active" <?php if($customer_edit['customer_active_status']=="active"){ ?> selected="selected" <?php } ?>>Active</option>

												<option value="inactice" <?php if($customer_edit['customer_active_status']=="inactice"){ ?> selected="selected" <?php } ?>>InActive</option>

											</select>

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

											foreach($customer_con_edit as $get_customer_con){

										?>

											<tr  class="odd gradeX">

												<td width="12%">

													<input name="customer_multi_contact_id[]" type="hidden" value="<?=$get_customer_con['customer_multi_contact_id']?>"  id="customer_multi_contact_id[]" /> 

													<select name="customer_multi_contact_title[]" id="customer_multi_contact_title[]" class="form-control select2">

														  <option value=""> - Select - </option>

														   <option value="Mr." <?php if($get_customer_con['customer_multi_contact_title']=="Mr."){ ?> selected="selected" <?php } ?>>Mr.</option> 

														  <option value="Mrs." <?php if($get_customer_con['customer_multi_contact_title']=="Mrs."){ ?> selected="selected" <?php } ?>>Mrs.</option>  

														  <option value="Miss." <?php if($get_customer_con['customer_multi_contact_title']=="Miss."){ ?> selected="selected" <?php } ?>>Miss.</option>  

													</select>

												</td>

												<td width="17%">

												<input name="customer_multi_contact_name[]" type="text" id="customer_multi_contact_name[]" class="form-control" value="<?=$get_customer_con['customer_multi_contact_name']?>"  /> 

												</td>

												<td width="16%">

												<input name="customer_multi_contact_department[]" type="text" class="form-control" id="customer_multi_contact_department[]" value="<?=$get_customer_con['customer_multi_contact_department']?>" />

												</td>

												<td width="17%">

												<input name="customer_multi_contact_mobile_no[]" type="number" class="form-control" id="customer_multi_contact_mobile_no[]"  value="<?=$get_customer_con['customer_multi_contact_mobile_no']?>"/>

												</td>

												<td width="17%">

												<input name="customer_multi_contact_email[]" type="email" class="form-control" id="customer_multi_contact_email[]" value="<?=$get_customer_con['customer_multi_contact_email']?>"/>

												</td>

												<td width="18%">

												<input name="customer_multi_contact_extn_no[]" type="text" class="form-control" id="customer_multi_contact_extn_no[]" value="<?=$get_customer_con['customer_multi_contact_extn_no']?>"/>

												<a href="index.php?customer_multi_contact_id=<?=$get_customer_con['customer_multi_contact_id']?>&customer_uniq_id=<?php echo $customer_edit['customer_uniq_id']?>&multi_contact_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a>

												</td>

											  </tr>

										<?php

											}

										?>

										<tr  class="odd gradeX">

										<td width="12%">

											<select name="customer_multi_contact_title[]" id="customer_multi_contact_title[]" class="form-control select2">

												  <option value=""> - Select - </option>

												   <option value="Mr.">Mr.</option> 

												  <option value="Mrs.">Mrs.</option>  

												  <option value="Miss.">Miss.</option>  

											</select>

										</td>

										<td width="17%">

										<input name="customer_multi_contact_name[]" type="text" value=""  id="customer_multi_contact_name[]" class="form-control"  /> 

										</td>

										<td width="16%">

										<input name="customer_multi_contact_department[]" type="text" value="" class="form-control" id="customer_multi_contact_department[]"  />

										</td>

										<td width="17%">

										<input name="customer_multi_contact_mobile_no[]" type="number" value="" class="form-control" id="customer_multi_contact_mobile_no[]"  />

										</td>

										<td width="17%">

										<input name="customer_multi_contact_email[]" type="email" value="" class="form-control" id="customer_multi_contact_email[]"/>

										</td>

										<td width="18%">

										<input name="customer_multi_contact_extn_no[]" type="text" value="" class="form-control" id="customer_multi_contact_extn_no[]" />

										</td>

									  </tr>

									</tbody>

								</table>

								</div>

								<div class="col-lg-6">

											<input type="hidden" name="customer_id" id="customer_id" value="<?=$customer_edit['customer_id']?>" />

											<input type="hidden" name="customer_uniq_id" id="customer_uniq_id" value="<?=$customer_edit['customer_uniq_id']?>" />

									<button name="customer_update" type="submit" class="btn btn-success">Update </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

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
								<form action="index.php" method="post" name="customer_form"  id="customer_form" enctype="multipart/form-data">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>Code</th>

                                            <th>Name</th>
											
											<th>Phone No.</th>
											
											<th>Address</th>

                                            <!--<th>Office No</th>

                                            <th>Email ID</th>-->

                                            <th>Action</th>
											<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit"name="customer_delete" id="customer_delete" value="Delete" class="btn btn-danger"></th>
                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($customer_list	as $get_branch){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=$get_branch['customer_code']?></td>

                                            <td><?=ucfirst($get_branch['customer_name'])?></td>
											
											<td><?=ucfirst($get_branch['customer_mobile_no'])?></td>

											<td><?=ucfirst($get_branch['customer_billing_address'])?></td>

                                            <!--<td><?=ucfirst($get_branch['customer_contact_no'])?></td>

											<td><?=ucfirst($get_branch['customer_email'])?></td>-->

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_branch['customer_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>
											
											<td style="text-align:center"><input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $get_branch['customer_uniq_id']?>"></td>


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

        <?=PROJECT_FOOTER?>

    </div>

			<script>
		$( "#customer_form" ).validate({
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

