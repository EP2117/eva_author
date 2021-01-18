<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Production Entry</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Entry added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Entry updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Entry deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Entry Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Entry deleted successfully</div>';

		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/production-entry/production-entry-javascript.js'; ?>"></script>
<script>
function GetWDetail(){
	
	var sno = Number($("#work_asign_detail_display >tr").length);
		sno = sno+1;
	var apnd  = '<tr>';
		
		
		apnd += '<td><select class="form-control select2" name="production_entry_work_detail_production_section_id[]" id="production_entry_work_detail_production_section_id'+sno+'" style="width:100%" onChange="GetMachine('+sno+')"><option value=""> - Select - </option><?php foreach($prd_sec_list as $get_prd_sec) { ?> <option value="<?php echo $get_prd_sec['production_section_id']; ?>"> <?php echo $get_prd_sec['production_section_name'];?> </option> <?php } ?></select></td>';
		
		apnd += '<td id="machine_content'+sno+'"><select class="form-control select2" name="production_entry_work_detail_production_machine_id[]" id="production_entry_work_detail_production_machine_id'+sno+'" style="width:100%"> <option value=""> - Select - </option></select></td>';
	
		apnd += '<td><select class="form-control select2" name="production_entry_work_detail_employee_id[]" id="production_entry_work_detail_employee_id'+sno+'" style="width:100%"> <option value=""> - Select - </option><?php foreach($employee_list as $get_employee) { ?> <option value="<?php echo $get_employee['employee_id']; ?>"> <?php echo $get_employee['employee_name'];?> </option> <?php } ?></select></td>';
		
		apnd += '<td><input type="text" class="form-control production_entry_mul_date" style="text-align:right;" name="production_entry_work_detail_from_date[]" id="production_entry_work_detail_from_date'+sno+'" onChange="GetDuedate('+sno+');"></td>';
		apnd += '<td><input type="text" class="form-control production_entry_mul_date" style="text-align:right;" name="production_entry_work_detail_to_date[]" id="production_entry_work_detail_to_date'+sno+'" onChange="GetDuedate('+sno+');"></td>';
		apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="production_entry_work_detail_due[]" id="production_entry_work_detail_due'+sno+'"></td>';
		apnd += '<td><textarea class="form-control" name="production_entry_work_detail_remarks[]" id="production_entry_work_detail_remarks'+sno+'" ></textarea>';
		apnd += '</tr>';			
		
		$("#work_asign_detail_display").append(apnd);
		
			$('#production_entry_work_detail_from_date'+sno).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
			});
		
			$('#production_entry_work_detail_to_date'+sno).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
			});		
 }
	
</script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/production-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Production Entry</h1>

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

				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Production Entry Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="production_entry_branch_id" id="production_entry_branch_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

												?>

														<option value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<div class="form-group">

											<label class="control-label">Warehouse</label>

											<select name="production_entry_godown_id" id="production_entry_godown_id" class="form-control select2" required>

												<?php

												foreach($godown_list as $get_godown){

												?>

														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<!--<div class="form-group">

											<label class="control-label">Production Type</label>

											<input type="text" class="form-control" name="production_entry_production_type" id="production_entry_production_type" required >

										</div>-->

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="production_entry_date" id="production_entry_date" value="<?=date('d/m/Y')?>" required>

											</div>

										</div>
										<div class="form-group">
										
																					<label>Grn Date</label>
										
																					 <div class="input-group date">
										
																					  <div class="input-group-addon">
										
																						<i class="fa fa-calendar"></i>
										
																					  </div>
										
																					  <input type="text" class="form-control" name="production_entry_grn_date" id="production_entry_grn_date" >
										
																					</div>
										
																				</div>
										<div class="form-group">

											<label>Type</label>

											<select name="production_entry_type" id="production_entry_type" class="form-control select2" style="width:100%" onChange="return vendorFn(this.value,this);" >

												  <option value="1">Own </option>

												  <option value="2">Out Source </option>

												

											</select>

										</div>
										<div class="form-group" style="display:none" id="vendr_id">

											<label>Vendor</label>

											<select name="production_entry_vendor_id" id="production_entry_vendor_id" class="form-control select2" style="width:100%">

												<option value=""> - Select - </option>

												<?php

												foreach($vendor_list as $get_vendor){

												?>

														<option value="<?=$get_vendor['vendor_id']?>"><?=$get_vendor['vendor_name']?></option>

												<?php

													}

												?>

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

							  ENTRY DETAILS

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetSodetail();" data-toggle="modal" data-target="#soModal" data-id="1" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >

                                    <thead>

                                        <tr i>

                                            <th style=" width:30%;">GRN No</th>

                                            <th  style=" width:25%;">Date</th>

                                            <th  style=" width:25%;">Type</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

										

									</tbody>

								</table>

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

							  Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">
								<div style="width:100%; overflow:scroll;">
                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style="width:190%" >

                                    <thead style="display:none" class="rls">

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle; width:10%">PRD CODE</th>
											
											<th rowspan="2" style="vertical-align:middle; width:10%"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle; width:10%"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle; width:10%"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle; width:10%"> THICK</th>

											<th colspan="2" style="width:20%"> WIDTH</th>
											<th colspan="2" style="width:20%"> SALES WIDTH</th>
											<th colspan="4" style="width:40%"> SALES LENGTH</th>
											<th colspan="4" style="width:40%"> Extra LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;"  nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Length &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>

                                        </tr>

										<tr>
											<th >&nbsp;&nbsp;INCHES&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;INCHES&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp; FEET &nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp; FT.IN &nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp; FEET &nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FT.IN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>

                                    </thead>
									
									<thead style="display:none" class="rws">

                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>

                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY</th>
											<th colspan="2" style=""> SALES WEIGHT</th>
											<th colspan="2"  nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL LENGTH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											
                                        </tr>

										<tr>
											<th nowrap="nowrap"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  FEET &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; METER &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="ccs">

                                         <tr>

                                            <th style="vertical-align:middle;"> PRD CODE </th>
											
											<th style="vertical-align:middle;"> BRAND</th>

                                            <th style="vertical-align:middle;"> NAME</th>

                                            <th style="vertical-align:middle;"> UOM</th>
											
											<th style="vertical-align:middle;"> QTY</th>
											
                                        </tr>
										
                                    </thead>
									

                                    <tbody id="product_detail_display">

									

									</tbody>

								</table>
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

							Raw Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetRawDetail();" data-toggle="modal" data-target="#raw_popup" data-id="1" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="raw_product_detail"  style="width:100%" >

                                    <thead >

                                          <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
											<th rowspan="2" style="vertical-align:middle;"> CODE</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES LENGTH</th>
											<th colspan="2" style="vertical-align:middle;"> Weight</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
										</tr>

                                    </thead>
									
									

                                    <tbody id="raw_product_detail_display">

									

									</tbody>

								</table>

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

							  Work Assign

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetWDetail();" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="work_asign_detail"  style=" width:100%" >

                                    <thead>

                                        

										<tr>

											<th style="width:15%">Section</th>

											<th  style="width:20%">Machine</th>

											<th  style="width:20%">Employee</th>

											<th style="width:15%">From</th>

											<th style="width:15%">To</th>

											<th >Due</th>

											<th style="width:15%">Remarks</th>

										</tr>

                                    </thead>

                                    <tbody id="work_asign_detail_display">

										<tr>

											<td>

												<select name="production_entry_work_detail_production_section_id[]" id="production_entry_work_detail_production_section_id1" class="form-control select2" style="width:100%" onChange="GetMachine(1)">

												  <option value=""> - Select - </option>

												<?php

													foreach($prd_sec_list	as	$get_prd_sec){

												?>

														<option value="<?=$get_prd_sec['production_section_id']?>"><?=$get_prd_sec['production_section_name']?></option>

												<?php

													}

												?>

											</select>

											</td>

											<td id="machine_content1">

												<select name="production_entry_work_detail_production_machine_id[]" id="production_entry_work_detail_production_machine_id1" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

											</select>

											</td>

											<td>

												<select name="production_entry_work_detail_employee_id[]" id="production_entry_work_detail_employee_id1" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												  <?php

													foreach($employee_list	as	$get_employee){

												?>

														<option value="<?=$get_employee['employee_id']?>"><?=$get_employee['employee_name']?></option>

												<?php

													}

												?>

											</select>

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_from_date[]" id="production_entry_work_detail_from_date1"  onChange="GetDuedate('1');"  />

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_to_date[]" id="production_entry_work_detail_to_date1" onChange="GetDuedate('1');" >

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_due[]" id="production_entry_work_detail_due1" style="width:50px;" >

											</td>

											<td>

												 <textarea class="form-control" name="production_entry_work_detail_remarks[]" id="production_entry_work_detail_remarks1" ></textarea>

											</td>

										</tr>

									</tbody>

								</table>

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

							Damage Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetDamDetail();" data-toggle="modal" data-target="#dam_popup" data-id="1" class="glyphicon glyphicon-plus">                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dam_product_detail"  style=" width:100%" >

                                    <thead >

                                          <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES LENGTH</th>
											<th colspan="2" style="vertical-align:middle;"> Weight</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
										</tr>

                                    </thead>

                                    <tbody id="dam_product_detail_display">

									

									</tbody>

								</table>

								</div>

								<div class="col-lg-12">
								<div class="form-group">

											<label>Remark</label>
											
											<textarea id="production_entry_remarks" name="production_entry_remarks" class="form-control"></textarea>
											
											</div>
								</div>

								<div class="col-lg-6">

									<button name="production_entry_insert" type="submit" class="btn btn-success">Save </button>

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

								  	Production Entry Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="production_entry_branch_id" id="production_entry_branch_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
														$selected	= ($get_branch['branch_id']==$production_entry_edit['production_entry_branch_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Warehouse</label>
											<select name="production_entry_godown_id" id="production_entry_godown_id" class="form-control select2" onChange="GetcustomerDetail()">
												<option value=""> - Select - </option>
												<?php
												foreach($godown_list as $get_godown){
														$selected	= ($get_godown['godown_id']==$production_entry_edit['production_entry_godown_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>
												<?php
													}
												?>

											</select>

										</div>

									
<!--
										<div class="form-group">

											<label>Production Type</label>

											<input type="text" class="form-control" name="production_entry_production_type" id="production_entry_production_type" value="<?=$production_entry_edit['production_entry_production_type']?>" >

										</div>-->

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="production_entry_date" id="production_entry_date" value="<?=dateGeneralFormatN($production_entry_edit['production_entry_date'])?>">

											</div>

										</div>
										<div class="form-group">
									
																				<label>Grn Date</label>
									
																				 <div class="input-group date">
									
																				  <div class="input-group-addon">
									
																					<i class="fa fa-calendar"></i>
									
																				  </div>
									
																				  <input type="text" class="form-control" name="production_entry_grn_date" id="production_entry_grn_date" value="<?=dateGeneralFormatN($production_entry_edit['production_entry_grn_date'])?>" >
									
																				</div>
									
																			</div>

										<div class="form-group">

											<label>Type</label>

											<select name="production_entry_type" id="production_entry_type" class="form-control select2" style="width:100%"  onChange="return vendorFn(this.value,this);">

												  <option value="1" <?php if($production_entry_edit['production_entry_type']==1){ ?> selected="selected" <?php } ?>>Own</option>

												  <option value="2" <?php if($production_entry_edit['production_entry_type']==2){ ?> selected="selected" <?php } ?>>Out Sourse Production </option>
											</select>

										</div>
										<div class="form-group" <?php if($production_entry_edit['production_entry_type']==1){?> style="display:none"<?php }else{?> style="display:block" <?php } ?> id="vendr_id">

											<label>Vendor</label>

											<select name="production_entry_vendor_id" id="production_entry_vendor_id" class="form-control select2" >

												<option value=""> - Select - </option>

												<?php

												foreach($vendor_list as $get_vendor){

														$selected	= ($get_vendor['vendor_id']==$production_entry_edit['production_entry_vendor_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_vendor['vendor_id']?>" <?=$selected?>><?=$get_vendor['vendor_name']?></option>

												<?php

													}

												?>

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

							  ENTRY DETAILS

							</div>

							<div class="panel-body">

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >

                                    <thead>

                                        <tr >

                                            <th style=" width:30%;">Inv No</th>

                                            <th  style=" width:25%;">Inv Date</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr>

										<td><?=$sales_detail_edit['grn_entry_no']?></td>

										<td><?=dateGeneralFormatN($sales_detail_edit['grn_entry_date'])?>

										<input type="hidden"  name="production_entry_grn_entry_id" id="production_entry_grn_entry_id" value="<?=$production_entry_edit['production_entry_grn_entry_id']?>"  class="dc_id"  /></td>

										

										</tr>

									</tbody>

								</table>

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

							  Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">
								<div  style="width:100%; overflow:scroll">
                                <table class="table table-striped table-bordered table-hover" id="product_detail" >

                                    
                                     <!--<thead style="display:none" class="rls">-->
											<?php if($production_entry_edit['production_entry_type_id']==1){ ?>
                                         <tr>

                                            
											
											<th rowspan="2" style="vertical-align:middle; width:10%"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle; width:10%"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle; width:10%"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle; width:10%"> THICK</th>

											<th colspan="2" style="width:20%"> WIDTH</th>
											<th colspan="2" style="width:20%"> SALES WIDTH</th>
											<th colspan="4" style="width:40%"> SALES LENGTH</th>
											<th colspan="4" style="width:40%"> Extra LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;width:10%" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;width:10%" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Length &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

                                        </tr>

										<tr>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th  nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INCHES& nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FEET &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FT.IN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FEET &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FT.IN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>

                                  <!--  </thead>
												<?php }elseif($production_entry_edit['production_entry_type_id']==2){ ?>
									<thead style="display:none" class="rws">-->

                                         <tr>
                                        

                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; COLOR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;"  nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; THICK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											
											
											<th colspan="2" style="" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL LENGTH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											
                                        </tr>

										<tr>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FEET &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; METER &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										

                                    <!--</thead>
									<thead style="display:none" class="ccs">-->
									<?php }elseif($production_entry_edit['production_entry_type_id']==4){ ?>
                                         <tr>

                                            <th style="vertical-align:middle;"> PRD CODE </th>
											
											<th style="vertical-align:middle;"> BRAND</th>

                                            <th style="vertical-align:middle;"> NAME</th>

                                            <th style="vertical-align:middle;"> UOM</th>
											
											<th style="vertical-align:middle;"> QTY</th>
											
                                        </tr>
										<?php }?>
                                  <!--  </thead>-->
									


                                    
									<tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($production_entry_prd_edit);
										
										foreach($production_entry_prd_edit as $get_product_detail){
											if($get_product_detail['production_entry_product_detail_product_type']==1){
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
											}
											else{
												$product_code		= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name		= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $get_product_detail['c_uom_name'];
												$product_colour_name	= $get_product_detail['c_colour_name'];
											}
										
										
											if($production_entry_edit['production_entry_type_id']==1){ 
											?>
					
										<tr class="rls" style="display:none">

										
											
											<td>
<input type="hidden"  name="production_entry_product_detail_product_type[]" id="production_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_type']?>" />

											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="production_entry_product_detail_product_brand_id[]" id="production_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="production_entry_product_detail_product_id[]" id="production_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="production_entry_product_detail_id[]" id="production_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_id']?>" />
											<input type="hidden"  name="production_entry_product_detail_grn_detail_id[]" id="production_entry_product_detail_grn_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_grn_detail_id']?>" />
											</td>

											<td>
											<?=$product_colour_name?>
											</td>

											<td>
												<?=$arr_thick[$get_product_detail['production_entry_product_detail_product_thick']]?>
											<input class="form-control" type="hidden"  name="production_entry_product_detail_product_thick[]" id="production_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_thick']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_width_inches[]" id="production_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_width_mm[]" id="production_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_s_width_inches[]" id="production_entry_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />


											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_s_width_mm[]" id="production_entry_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_s_width_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_sl_feet[]" id="production_entry_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_sl_feet']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_sl_feet_in[]" id="production_entry_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_sl_feet_in']?>" onKeyUp="GetLcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_sl_feet_mm[]" id="production_entry_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_sl_feet_mm']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td><input class="form-control" type="text"  name="production_entry_product_detail_sl_feet_met[]" id="production_entry_product_detail_sl_feet_met<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_entry_product_detail_sl_feet_met']?>" /> </td>
											
											
											<td> <input class="form-control" type="text"  name="production_entry_product_detail_ext_feet[]" id="production_entry_product_detail_ext_feet<?=$row_cnt?>" onblur="GetLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_entry_product_detail_ext_feet']?>" /> </td>
											 
											<td><input class="form-control" type="text"  name="production_entry_product_detail_ext_feet_in[]" id="production_entry_product_detail_ext_feet_in<?=$row_cnt?>" onblur="GetLcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  value="<?=$get_product_detail['production_entry_product_detail_ext_feet_in']?>" /> </td>
											
											<td><input class="form-control" type="text"  name="production_entry_product_detail_ext_feet_mm[]" id="production_entry_product_detail_ext_feet_mm<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_entry_product_detail_ext_feet_mm']?>" /> </td> 
											
											<td><input class="form-control" type="text"  name="production_entry_product_detail_ext_feet_met[]" id="production_entry_product_detail_ext_feet_met<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['production_entry_product_detail_ext_feet_met']?>"  /> </td> 
											
											
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_qty[]" id="production_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['production_entry_product_detail_qty']?>" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_tot_length[]" id="production_entry_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['production_entry_product_detail_tot_length']?>" readonly="" />

											</td>
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_entry_product_detail_id']?>&production_entry_uniq_id=<?php echo $production_entry_edit['production_entry_uniq_id']?>&type=1&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($production_entry_edit['production_entry_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">

											<td>
<input type="hidden"  name="production_entry_product_detail_product_type[]" id="production_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_type']?>" />
											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="production_entry_product_detail_product_brand_id[]" id="production_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="production_entry_product_detail_product_id[]" id="production_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="production_entry_product_detail_id[]" id="production_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_id']?>" />
											<input type="hidden"  name="production_entry_product_detail_grn_detail_id[]" id="production_entry_product_detail_grn_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_grn_detail_id']?>" />
											</td>

											<td>
											<?=$product_colour_name?>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_product_thick[]" id="production_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$arr_thick[$get_product_detail['production_entry_product_detail_product_thick']]?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_width_inches[]" id="production_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_width_mm[]" id="production_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)"  />

											</td>
											
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_s_width_inches[]" id="production_entry_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_s_width_mm[]" id="production_entry_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_s_width_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_s_weight_inches[]" id="production_entry_product_detail_s_weight_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_s_weight_inches']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)"  />

											</td>

											
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_s_weight_mm[]" id="production_entry_product_detail_s_weight_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_s_weight_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)"  />

											</td>
											
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_tot_feet[]" id="production_entry_product_detail_tot_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_tot_feet']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)"  />

											</td>

											
											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_tot_meter[]" id="production_entry_product_detail_tot_meter<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_tot_meter']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)"  />

											</td>



											

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_entry_product_detail_id']?>&production_entry_uniq_id=<?php echo $production_entry_edit['production_entry_uniq_id']?>&type=1&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($production_entry_edit['production_entry_type_id']==4){ ?>
										
										<tr >

											<td>

											<?=$product_code?>
											<input type="hidden"  name="production_entry_product_detail_product_type[]" id="production_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_type']?>" />

											</td>
											
											<td>

											<?=$get_product_detail['brand_name']?>

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="production_entry_product_detail_product_id[]" id="production_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="production_entry_product_detail_id[]" id="production_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_id']?>" />
											<input type="hidden"  name="production_entry_product_detail_grn_detail_id[]" id="production_entry_product_detail_grn_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_grn_detail_id']?>" />
											</td>

											<td>
											<?=$product_uom_name?>
											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_product_detail_qty[]" id="production_entry_product_detail_qty<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_product_detail_qty']?>" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>
											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_entry_product_detail_id']?>&production_entry_uniq_id=<?php echo $production_entry_edit['production_entry_uniq_id']?>&type=1&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>
								</table>
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

							Raw Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetRawDetail();" data-toggle="modal" data-target="#raw_popup" data-id="1" class="glyphicon glyphicon-plus">

									</button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="raw_product_detail"  style=" width:100%" >

                                    
                                     <thead >

                                          <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES LENGTH</th>
											<th colspan="2" style="vertical-align:middle;"> Weight</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
										</tr>

                                    </thead>
									

                                    <tbody id="raw_product_detail_display">

										
										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($production_entry_raw_prd_edit);
										
										foreach($production_entry_raw_prd_edit as $get_product_detail){
												$product_code		= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name		= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $get_product_detail['product_uom_name'];
												$product_colour_name	= $get_product_detail['product_colour_name'];
										
										
								
											?>
					
										<tr >

											
											<td>
											<input type="hidden"  name="production_entry_raw_product_detail_product_type[]" id="production_entry_raw_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_product_type']?>" />
											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="production_entry_raw_product_detail_product_brand_id[]" id="production_entry_raw_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_product_brand_id']?>" />
<input type="hidden"  name="production_entry_raw_product_detail_osf_ton[]" id="production_entry_raw_product_detail_osf_ton<?=$row_cnt?>" value="<?=$get_product_detail['product_con_entry_osf_uom_ton']?>" />
											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="production_entry_raw_product_detail_product_id[]" id="production_entry_raw_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_product_id']?>"  />
											<input type="hidden"  name="production_entry_raw_product_detail_id[]" id="production_entry_raw_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_id']?>" />
											<input type="hidden"  name="production_entry_raw_product_detail_grn_detail_id[]" id="production_entry_raw_product_detail_grn_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_grn_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											</td>

											<td>

											<input  type="hidden"  name="production_entry_raw_product_detail_product_thick[]" id="production_entry_raw_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_product_thick']?>"   />
											<input class="form-control" type="text"  name="production_entry_raw_product_detail_product_thick[]" id="production_entry_raw_product_detail_product_thick<?=$row_cnt?>" value="<?=$arr_thick[$get_product_detail['production_entry_raw_product_detail_product_thick']]?>"   />
											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_raw_product_detail_width_inches[]" id="production_entry_raw_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_raw_product_detail_width_mm[]" id="production_entry_raw_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_raw_product_detail_sl_feet[]" id="production_entry_raw_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_sl_feet']?>" onKeyUp="GetRLcalS(2,<?=$row_cnt?>)" onBlur="GetRTotalLength(<?=$row_cnt?>)" />


											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_raw_product_detail_sl_feet_mm[]" id="production_entry_raw_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_sl_feet_mm']?>" onKeyUp="GetRLcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											

											<td>

											<input class="form-control" type="text"  name="production_entry_raw_product_detail_ton[]" id="production_entry_raw_product_detail_ton<?=$row_cnt?>"  value="<?=$get_product_detail['production_entry_raw_product_detail_ton']?>"  onBlur="GetRTotalLength(<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_entry_raw_product_detail_kg[]" id="production_entry_raw_product_detail_kg<?=$row_cnt?>"  value="<?=$get_product_detail['production_entry_raw_product_detail_kg']?>" readonly="" />

											</td>
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_entry_raw_product_detail_id']?>&production_entry_uniq_id=<?php echo $production_entry_edit['production_entry_uniq_id']?>&type=2&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>									



									</tbody>

								</table>

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

							  Work Assign

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetWDetail();" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="work_asign_detail"  style=" width:100%" >

                                    <thead>

                                        

										<tr>

											<th style="width:15%">Section</th>

											<th  style="width:20%">Machine</th>

											<th  style="width:20%">Employee</th>

											<th style="width:15%">From</th>

											<th style="width:15%">To</th>

											<th >Due</th>

											<th style="width:15%">Remarks</th>

										</tr>

                                    </thead>

                                    <tbody id="work_asign_detail_display">

										<?php

										$row_cnt	= 1;

										$arr_cnt	= count($production_entry_work_edit);

										foreach($production_entry_work_edit as $get_work_detail){

										$prd_mac_list		= getProductionMachineList($get_work_detail['production_entry_work_detail_production_section_id']);

										?>

										<tr>

											<td>

												<input type="hidden" name="production_entry_work_detail_id[]" id="production_entry_work_detail_id" value="<?=$get_work_detail['production_entry_work_detail_id']?>" />

												<select name="production_entry_work_detail_production_section_id[]" id="production_entry_work_detail_production_section_id<?=$row_cnt?>" class="form-control select2" style="width:100%" onChange="GetMachine(<?=$row_cnt?>)">

												  <option value=""> - Select - </option>

												<?php

													foreach($prd_sec_list	as	$get_prd_sec){

													$selected = ($get_prd_sec['production_section_id']==$get_work_detail['production_entry_work_detail_production_section_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_prd_sec['production_section_id']?>" <?=$selected?>><?=$get_prd_sec['production_section_name']?></option>

												<?php

													}

												?>

											</select>

											</td>

											<td id="machine_content<?=$row_cnt?>">

												<select name="production_entry_work_detail_production_machine_id[]" id="production_entry_work_detail_production_machine_id<?=$row_cnt?>" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												  <?php

													foreach($prd_mac_list	as	$get_prd_mac){

													$selected = ($get_prd_mac['production_machine_id']==$get_work_detail['production_entry_work_detail_production_machine_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_prd_mac['production_machine_id']?>" <?=$selected?>><?=$get_prd_mac['production_machine_name']?></option>

												<?php

													}

												?>

											</select>

											</td>

											<td>

												<select name="production_entry_work_detail_employee_id[]" id="production_entry_work_detail_employee_id<?=$row_cnt?>" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												  <?php

													foreach($employee_list	as	$get_employee){

													$selected = ($get_employee['employee_id']==$get_work_detail['production_entry_work_detail_employee_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_employee['employee_id']?>" <?=$selected?>><?=$get_employee['employee_name']?></option>

												<?php

													}

												?>

											</select>

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_from_date[]" id="production_entry_work_detail_from_date<?=$row_cnt?>" value="<?=dateGeneralFormatN($get_work_detail['production_entry_work_detail_from_date'])?>" />

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_to_date[]" id="production_entry_work_detail_to_date<?=$row_cnt?>" value="<?=dateGeneralFormatN($get_work_detail['production_entry_work_detail_to_date'])?>" />

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_due[]" id="production_entry_work_detail_due<?=$row_cnt?>" style="width:50px;" value="<?=$get_work_detail['production_entry_work_detail_due']?>"/>

											</td>

											<td>

												 <textarea class="form-control" name="production_entry_work_detail_remarks[]" id="production_entry_work_detail_remarks<?=$row_cnt?>" ><?=$get_work_detail['production_entry_work_detail_remarks']?></textarea>

											</td>

										</tr>

									<?php $row_cnt = $row_cnt+1; }  ?>

										<tr>

											<td>

												<select name="production_entry_work_detail_production_section_id[]" id="production_entry_work_detail_production_section_id<?=$row_cnt?>" class="form-control select2" style="width:100%" onChange="GetMachine(1)">

												  <option value=""> - Select - </option>

												<?php

													foreach($prd_sec_list	as	$get_prd_sec){

												?>

														<option value="<?=$get_prd_sec['production_section_id']?>"><?=$get_prd_sec['production_section_name']?></option>

												<?php

													}

												?>

											</select>

											</td>

											<td id="machine_content1">

												<select name="production_entry_work_detail_production_machine_id[]" id="production_entry_work_detail_production_machine_id<?=$row_cnt?>" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

											</select>

											</td>

											<td>

												<select name="production_entry_work_detail_employee_id[]" id="production_entry_work_detail_employee_id<?=$row_cnt?>" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												  <?php

													foreach($employee_list	as	$get_employee){

												?>

														<option value="<?=$get_employee['employee_id']?>"><?=$get_employee['employee_name']?></option>

												<?php

													}

												?>

											</select>

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_from_date[]" id="production_entry_work_detail_from_date<?=$row_cnt?>" >

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_to_date[]" id="production_entry_work_detail_to_date<?=$row_cnt?>" >

											</td>

											<td>

												 <input type="text" class="form-control" name="production_entry_work_detail_due[]" id="production_entry_work_detail_due<?=$row_cnt?>" style="width:50px;" >

											</td>

											<td>

												 <textarea class="form-control" name="production_entry_work_detail_remarks[]" id="production_entry_work_detail_remarks<?=$row_cnt?>" ></textarea>

											</td>

										</tr>

									</tbody>

								</table>

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

							Damage Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetDamDetail();" data-toggle="modal" data-target="#dam_popup" data-id="1" class="glyphicon glyphicon-plus">                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dam_product_detail"  style=" width:100%" >

                                     <thead >

                                          <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES LENGTH</th>
											<th colspan="2" style="vertical-align:middle;"> Weight</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
										</tr>

                                    </thead>

                                    <tbody id="dam_product_detail_display">

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($production_entry_dam_prd_edit);

										foreach($production_entry_dam_prd_edit as $get_product_detail){

										?>

										<tr>

											<td>

											<?=$get_product_detail['brand_name']?>

											</td>

											<td>

											<?=$get_product_detail['product_con_entry_child_product_detail_name']?>

											<input type="hidden"  name="production_entry_dam_product_detail_raw_product_id[]" id="production_entry_dam_product_detail_raw_product_id" value="<?=$get_product_detail['production_entry_dam_product_detail_raw_product_id']?>" />

											<input type="hidden"  name="production_entry_dam_product_detail_id[]" id="production_entry_dam_product_detail_id" value="<?=$get_product_detail['production_entry_dam_product_detail_id']?>" />

											<input type="hidden"  name="production_entry_dam_product_detail_product_id[]" id="production_entry_dam_product_detail_product_id" value="<?=$get_product_detail['production_entry_dam_product_detail_product_id']?>"   class="sd_id" />
											<input type="hidden"  name="production_entry_dam_product_detail_product_osf_ton[]" id="production_entry_dam_product_detail_product_osf_ton<?=$row_cnt?>" value="<?=$get_product_detail['product_con_entry_osf_uom_ton']?>" />

											</td>

											<!--<td>

											<input class="form-control" type="text"  name="product_uom[]" id="product_uom<?=$row_cnt?>" value="<?=$get_product_detail['product_uom_name']?>"   />

											</td>-->

											<td>

											<input class="form-control" type="text"  name="product_colour[]" id="product_colour<?=$row_cnt?>" value="<?=$get_product_detail['product_colour_name']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_thick_ness[]" id="product_thick_ness<?=$row_cnt?>" value="<?=$arr_thick[$get_product_detail['product_con_entry_child_product_detail_thick_ness']]?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_dam_product_detail_width_inches[]" id="production_entry_dam_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_dam_product_detail_width_inches']?>"  onblur="Getcalc(1,<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_dam_product_detail_width_mm[]" id="production_entry_dam_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_dam_product_detail_width_mm']?>"  onblur="Getcalc(2,<?=$row_cnt?>)"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_dam_product_detail_sl_feet[]" id="production_entry_dam_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_dam_product_detail_sl_feet']?>"  onblur="Getcalc(3,<?=$row_cnt?>)"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_dam_product_detail_sl_feet_mm[]" id="production_entry_dam_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_dam_product_detail_sl_feet_mm']?>" onBlur="Getcalc(4,<?=$row_cnt?>)"     />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_dam_product_detail_ton[]" id="production_entry_dam_product_detail_ton<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_dam_product_detail_ton']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_entry_dam_product_detail_kg[]" id="production_entry_dam_product_detail_kg<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_dam_product_detail_kg']?>"   />

											</td>

											

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_entry_dam_product_detail_id']?>&production_entry_uniq_id=<?php echo $production_entry_edit['production_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>

									

									</tbody>

								</table>

								</div>
								<div class="col-lg-12">
								<div class="form-group">

											<label>Remark</label>
											
											<textarea id="production_entry_remarks" name="production_entry_remarks" class="form-control"><?=$production_entry_edit['production_entry_remarks'] ?></textarea>
											
											</div>
								</div>
								<div class="col-lg-6">

										<input type="hidden"  name="production_entry_id" id="production_entry_id" value="<?=$production_entry_edit['production_entry_id']?>" />	

										<input type="hidden"  name="production_entry_uniq_id" id="production_entry_uniq_id" value="<?=$production_entry_edit['production_entry_uniq_id']?>" />	

									<button name="production_entry_update" type="submit" class="btn btn-success">Update </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>

							</div>

						</div>

					</div>

				</div>

				</form>
			<script type="text/javascript">
			getTableHeader(<?=$production_entry_edit['production_entry_type_id']?>);
			</script>
				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Production Entry List

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">

								<form action="index.php" method="post" id="production_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>PO No</th>

                                            <th>Date</th>

                                            <th>Type</th>

                                            <th>Warehouse</th>

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="production_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

											</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($quotation_list	as $get_quotation){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=$get_quotation['production_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['production_entry_date'])?></td>

                                            <td><?php if($get_quotation['production_entry_type']==1){ echo "OWN"; } else{ echo "OUT SOURSE";}?></td>

											<td><?=$get_quotation['godown_name']?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['production_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['production_entry_uniq_id']; ?>" type="checkbox" />

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

	<div class="panel-body">

                            

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

                                <div class="modal-dialog" style="width: 800px;">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>

                                        </div>

                                        <div class="modal-body">

											<div class="table-responsive">

												<div id="dynamic-content">

												</div>

											</div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="button" class="btn btn-primary" onClick="AddproductDetail()"  data-dismiss="modal">Save changes</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

	<div class="panel-body">

                            

                            <div class="modal fade" id="raw_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

                                <div class="modal-dialog" style="width: 800px;">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h4 class="modal-title" id="myModalLabel">Raw Product Details</h4>

                                        </div>

                                        <div class="modal-body">

											<div class="table-responsive">

												<div id="raw_product_content">

												</div>

											</div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="button" class="btn btn-primary" onClick="AddRawproductDetail()"  data-dismiss="modal">Save changes</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>	

	<div class="panel-body">

                            

                            <div class="modal fade" id="dam_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

                                <div class="modal-dialog" style="width: 800px;">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h4 class="modal-title" id="myModalLabel">Damage Product Details</h4>

                                        </div>

                                        <div class="modal-body">

											<div class="table-responsive">

												<div id="dam_product_content">

												</div>

											</div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="button" class="btn btn-primary" onClick="AddDamproductDetail()"  data-dismiss="modal">Save changes</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>									

	<div class="panel-body">

		

		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Production Entry Detail</h4>

					</div>

					<div class="modal-body">

						<div class="table-responsive">

							<div id="so_detail_content">

							</div>

						</div>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

						<button type="button" class="btn btn-primary" onClick="AddSodetail()"  data-dismiss="modal">Save changes</button>

					</div>

				</div>

			</div>

		</div>

	</div>					

    <!-- /. WRAPPER  -->

    <div id="footer-sec">

        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>

    </div>

    <!-- /. FOOTER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

    <!-- JQUERY SCRIPTS -->

			<script>
			$('#production_entry_date').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
			});
			$('#production_entry_work_detail_from_date1').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
			});
		
			$('#production_entry_work_detail_to_date1').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
			});		
			$('#production_entry_grn_date').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
			});	
			$('.production_entry_mul_date').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'dd/mm/yy',
			});	
				$(document).ready(function () {

					$('#dataTables-example').DataTable( {

						responsive: true

					} );

					/*$('#dataTables-example').dataTable();*/

				});

		//Initialize Select2 Elements

			$(".select2").select2();
			
			$( "#customer_form" ).validate({
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

