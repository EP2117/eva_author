<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Direct Invoice Entry</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Quotation Entry deleted successfully</div>';

		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/direct-invoice-entry/direct-invoice-entry-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/sales-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Direct Invoice Entry </h1>

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

								  	Invoice Entry Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="control-label">Invoice No.</label>
											<input type="text" class="form-control" name="invoice_entry_no" id="invoice_entry_no" value="<?=$invoice_entry_no?>" readonly="" style="width:460px;" required>
										</div>
									</div>
									<div class="col-lg-6" >

										<div class="form-group" style="padding-top:05px;">

											<label class="control-label">Branch</label>

											<select name="invoice_entry_branch_id" id="invoice_entry_branch_id" class="form-control select2" style="width:100%" required>

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

										<div class="form-group" style="padding-top:05px;">

											<label class="control-label">Customer</label>

											<select name="invoice_entry_customer_id" id="invoice_entry_customer_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){

												?>

														<option value="<?=$get_customer['customer_id']?>"><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group " style="padding-top:05px;">

											<label class="control-label" >Type</label>

											<select name="invoice_entry_type_id" id="invoice_entry_type_id" class="form-control select2" style="width:100%" required onChange="getTableHeader(this.value)">

												  <option value=""> - Select - </option>

												<?php

													foreach($arrQuotationType as $key => $value){

												?>

														<option value="<?=$key?>"><?=$value?></option>

												<?php

													}

												?>

											</select>

										</div>

									<div class="form-group" style="padding-top:05px;">

											<label>Credit Days</label>

											<input type="text" class="form-control" name="invoice_entry_credit_days" id="invoice_entry_credit_days" onBlur="getDueDate();" >

										</div>
									</div>

									<div class="col-lg-6">

										<div class="form-group" >

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="invoice_entry_date" id="invoice_entry_date" required>

											</div>

										</div>

										<div class="form-group">

											<label>Validity Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="invoice_entry_validity_date" id="invoice_entry_validity_date" >

											</div>

										</div>

										<div class="form-group">

											<label>Due Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="invoice_entry_due_date" id="invoice_entry_due_date" >

											</div>

										</div>

									<div class="form-group">

											<label class="control-label">Production Type</label>

											<select name="invoice_entry_prd_type" id="invoice_entry_prd_type" class="form-control" style="width:100%">
												  <option value="1"> With Production </option>
												  <option value="2"> Without Production</option>
											</select>

										</div>


									</div><!---->

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

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style="width:100%" >

                                    <thead style="display:none" class="rls">

                                         <tr>

                                            
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>
											<th rowspan="2" style="vertical-align:middle;"> Rate</th>
											<th rowspan="2" style="vertical-align:middle;"> Amount</th>
                                        </tr>

										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="rws">

                                         <tr>

                                            

                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY</th>

											<th rowspan="2" style="vertical-align:middle;"> Rate</th>

											<th rowspan="2" style="vertical-align:middle;"> Amount</th>

                                        </tr>

										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> TON</th>
											<th> KG</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="ccs">

                                         <tr>

                                           
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length</th>


											<th rowspan="2" style="vertical-align:middle;"> Rate</th>

											<th rowspan="2" style="vertical-align:middle;"> Amount</th>

                                        </tr>

										<tr>
											<th> INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="as">

                                         <tr>

                                            

                                            <th style="vertical-align:middle;">NAME</th>

                                            <th style="vertical-align:middle;">UOM</th>

											<th style="vertical-align:middle;">QTY</th>

											<th style="vertical-align:middle;">Rate</th>

											<th style="vertical-align:middle;">TOTAL</th>

                                        </tr>

                                    </thead>

                                    <tbody id="product_detail_display">

									

									</tbody>

								</table>

								<table class="table table-striped table-bordered table-hover" style=" width:100%" >

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Gross</td>

										<td style="width:20%"><input type="text" class="form-control" name="invoice_entry_gross_amount" id="invoice_entry_gross_amount" ></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Transportation Charges</td>

										<td><input type="text" class="form-control" name="invoice_entry_transport_amount" id="invoice_entry_transport_amount" onBlur="totalAmount()" ></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td>Tax</td>

										<td style="width:20%"><input type="text" class="form-control" name="invoice_entry_tax_per" id="invoice_entry_tax_per" onBlur="totalAmount()" ></td>

										<td><input type="text" class="form-control" name="invoice_entry_tax_amount" id="invoice_entry_tax_amount" ></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Advance</td>

										<td><input type="text" class="form-control" name="invoice_entry_advance_amount" id="invoice_entry_advance_amount" onBlur="totalAmount()" ></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Total</td>

										<td><input type="text" class="form-control" name="invoice_entry_net_amount" id="invoice_entry_net_amount"  ></td>

									</tr>

								</table>

								</div>

								

								<div class="col-lg-6">

									<button name="invoice_entry_insert" type="submit" class="btn btn-success">Save </button>
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

				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Invoice Entry Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Invoice No.</label>
											<input type="text" class="form-control" name="invoice_entry_no" id="invoice_entry_no" style="width:460px;" value="<?=$invoice_entry_edit['invoice_entry_no']?>" >
										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="invoice_entry_branch_id" id="invoice_entry_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$invoice_entry_edit['invoice_entry_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Production Section</label>

											<select name="invoice_entry_customer_id" id="invoice_entry_customer_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_prd_sec){

														$selected	= ($get_prd_sec['customer_id']==$invoice_entry_edit['invoice_entry_customer_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_prd_sec['customer_id']?>" <?=$selected?>><?=$get_prd_sec['customer_code']."-".$get_prd_sec['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label class="control-label">Type</label>
												<?php $val = $invoice_entry_edit['invoice_entry_type_id']; ?>
											<input type="hidden" name="invoice_entry_type_id" id="invoice_entry_type_id" value="<?=$invoice_entry_edit['invoice_entry_type_id']?>" required><input type="text" name="invoice_entry_type" id="invoice_entry_type" value="<?=$arrQuotationType[$val]?>" class="form-control" readonly="" >

										</div>
										<div class="form-group">

											<label>Credit Days</label>

											<input type="text" class="form-control" name="invoice_entry_credit_days" id="invoice_entry_credit_days" onBlur="getDueDate();"  value="<?=$invoice_entry_edit['invoice_entry_credit_days']?>"/>

										</div>
										
									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="invoice_entry_date" id="invoice_entry_date" value="<?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_date'])?>">

											</div>

										</div>

										<div class="form-group">

											<label>Validity Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="invoice_entry_validity_date" id="invoice_entry_validity_date" value="<?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_validity_date'])?>" />

											</div>

										</div>

										<div class="form-group">

											<label>Due Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="invoice_entry_due_date" id="invoice_entry_due_date" value="<?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_due_date'])?>" >

											</div>

										</div>

										<div class="form-group">

											<label>Production Type</label>

											<?php $invoice_entry_prd_type = ($invoice_entry_edit['invoice_entry_prd_type']=='1')?'With Production':'Without Production'; ?>
											<input type="text" class="form-control" name="invoice_entry_prd_type" id="invoice_entry_prd_type" value="<?=$invoice_entry_prd_type?>" >
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

							  Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >

                                    <thead style="display:none" class="rls">

                                         <tr>

                                            
											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY </th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length</th>


											<th rowspan="2" style="vertical-align:middle;"> Rate</th>

											<th rowspan="2" style="vertical-align:middle;"> Amount</th>

                                        </tr>

										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="rws">

                                         <tr>

                                            

                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY</th>

											<th rowspan="2" style="vertical-align:middle;"> Rate</th>

											<th rowspan="2" style="vertical-align:middle;"> Amount</th>

                                        </tr>

										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> TON</th>
											<th> KG</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="ccs">

                                         <tr>

                                            
											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>


											<th rowspan="2" style="vertical-align:middle;"> Rate</th>

											<th rowspan="2" style="vertical-align:middle;"> Amount</th>

                                        </tr>

										<tr>
											<th> INCHES</th>
											<th>MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>FT.IN</th>
											<th>MM</th>
										</tr>

                                    </thead>
									<thead style="display:none" class="as">

                                         <tr>

                                           

                                            <th style="vertical-align:middle;">NAME</th>

                                            <th style="vertical-align:middle;">UOM</th>

											<th style="vertical-align:middle;">QTY</th>

											<th style="vertical-align:middle;">Rate</th>

											<th style="vertical-align:middle;">TOTAL</th>

                                        </tr>

                                    </thead>

                                    <tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 1;

										$arr_cnt	= count($invoice_entry_prd_edit);

										foreach($invoice_entry_prd_edit as $get_product_detail){
										
											if($get_product_detail['invoice_entry_product_detail_product_type']==1){
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

										
										
										if($invoice_entry_edit['invoice_entry_type_id']==1){ ?>
				
										<tr class="rls" style="display:none">

											
											
											<td>
<input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_type']?>" />


											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="invoice_entry_product_detail_product_brand_id[]" id="invoice_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											<input class="form-control" type="hidden"  name="invoice_entry_product_detail_product_color_id[]" id="invoice_entry_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_color_id']?>"   />
											<input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_uom_id']?>"   />
											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_product_thick[]" id="invoice_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_thick']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_s_width_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_sl_feet']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_sl_feet_in']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_sl_feet_mm']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_qty']?>" onBlur="discountPerFind(<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>);" />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_tot_length[]" id="invoice_entry_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_tot_length']?>" readonly="" />

											</td>


											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_rate']?>" onBlur="discountPerFind(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_total']?>" readonly="" />

											</td>

											<td><?php if($arr_cnt>1) { ?><a href="index.php?invoice_entry_product_detail_id=<?=$get_product_detail['invoice_entry_product_detail_id']?>&invoice_entry_uniq_id=<?php echo $invoice_entry_edit['invoice_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($invoice_entry_edit['invoice_entry_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">

											
											<td>
<input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_type']?>" />

											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="invoice_entry_product_detail_product_brand_id[]" id="invoice_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="invoice_entry_product_detail_mas_product_id[]" id="invoice_entry_product_detail_mas_product_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											<input class="form-control" type="hidden"  name="invoice_entry_product_detail_product_color_id[]" id="invoice_entry_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_color_id']?>"   />
											<input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_uom_id']?>"   />
											</td>

											<td>

											<input type="hidden"  name="invoice_entry_product_detail_product_thick[]" id="invoice_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_thick']?>"   />
											<input class="form-control" type="text"  name="invoice_entry_product_detail_product_thick_val[]" id="invoice_entry_product_detail_product_thick_val<?=$row_cnt?>" value="<?=$arr_thick[number_format($get_product_detail['invoice_entry_product_detail_product_thick'])]?>"   />
											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_s_weight_inches']?>" onBlur="GetWeightClc(1,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_s_weight_mm']?>" onBlur="GetWeightClc(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_qty']?>" onBlur="discountPerFind(<?=$row_cnt?>)"  />

											</td>


											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_rate']?>" onBlur="discountPerFind(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_total']?>" readonly="" />

											</td>

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['invoice_entry_product_detail_id']?>&invoice_entry_uniq_id=<?php echo $invoice_entry_edit['invoice_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($invoice_entry_edit['invoice_entry_type_id']==3){ ?>
										
										<tr class="ccs" style="display:none">

											
											<td>
<input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_type']?>" />

											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="invoice_entry_product_detail_product_brand_id[]" id="invoice_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											<input class="form-control" type="hidden"  name="invoice_entry_product_detail_product_color_id[]" id="invoice_entry_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_color_id']?>"   />
											<input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_uom_id']?>"   />
											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_product_thick[]" id="invoice_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_thick']?>" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_s_width_mm']?>"  onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_sl_feet']?>" onKeyUp="GetWcalFeet(1,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_sl_feet_in']?>" onKeyUp="GetWcalFeet(1,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_sl_feet_mm']?>" onKeyUp="GetWcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_qty']?>"  onBlur="discountPerFind(<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>);"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_tot_length[]" id="invoice_entry_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_tot_length']?>" readonly="" />

											</td>



											
											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_rate']?>" onBlur="discountPerFind(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_total']?>" readonly="" />

											</td>

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['invoice_entry_product_detail_id']?>&invoice_entry_uniq_id=<?php echo $invoice_entry_edit['invoice_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }else{ ?>
										
										<tr class="as" style="display:none">

											
											
											<td>
<input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_type']?>" />

											<?=$product_name?>

											<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_uom_name?>
											<input class="form-control" type="hidden"  name="invoice_entry_product_detail_product_color_id[]" id="invoice_entry_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_color_id']?>"   />
											<input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_uom_id']?>"   />
											</td>


											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_qty']?>" onBlur="discountPerFind(<?=$row_cnt?>)"  />

											</td>


											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_rate']?>" onBlur="discountPerFind(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_total']?>" />

											</td>

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['invoice_entry_product_detail_id']?>&invoice_entry_uniq_id=<?php echo $invoice_entry_edit['invoice_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php 
										 }

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>

								</table>

								<table class="table table-striped table-bordered table-hover" style=" width:100%" >

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Gross</td>

										<td style="width:20%;text-align:right"><input type="text" class="form-control" name="invoice_entry_gross_amount" id="invoice_entry_gross_amount" value="<?=number_format($invoice_entry_edit['invoice_entry_gross_amount'],2,'.','')?>" ></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2">Transportation Charges</td>

										<td style="text-align:right"><input type="text" class="form-control" name="invoice_entry_transport_amount" id="invoice_entry_transport_amount" onBlur="totalAmount()"  value="<?=number_format($invoice_entry_edit['invoice_entry_transport_amount'],2,'.','')?>"/></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td>Tax</td>

										<td style="width:20%;text-align:right"><input type="text" class="form-control" name="invoice_entry_tax_per" id="invoice_entry_tax_per" onBlur="totalAmount()"  value="<?=number_format($invoice_entry_edit['invoice_entry_tax_per'],2,'.','')?>"/></td>

										<td style="text-align:right"><input type="text" class="form-control" name="invoice_entry_tax_amount" id="invoice_entry_tax_amount" value="<?=number_format($invoice_entry_edit['invoice_entry_tax_amount'],2,'.','')?>" /></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2" >Advance</td>

										<td style="text-align:right"><input type="text" class="form-control" name="invoice_entry_advance_amount" id="invoice_entry_advance_amount" onBlur="totalAmount()"  value="<?=number_format($invoice_entry_edit['invoice_entry_advance_amount'],2,'.','')?>"/></td>

									</tr>

									<tr>

										<td style="width:50%">&nbsp;</td>

										<td colspan="2" >Total</td>

										<td style="text-align:right;"><input type="text" class="form-control" name="invoice_entry_net_amount" id="invoice_entry_net_amount"   value="<?=number_format($invoice_entry_edit['invoice_entry_net_amount'],2,'.','')?>"/></td>

									</tr>

								</table>

								</div>

								<div class="col-lg-6">
								<input type="hidden"  name="invoice_entry_id" id="invoice_entry_id" value="<?=$invoice_entry_edit['invoice_entry_id']?>" />	
								<input type="hidden"  name="invoice_entry_uniq_id" id="invoice_entry_uniq_id" value="<?=$invoice_entry_edit['invoice_entry_uniq_id']?>" />	
									<button name="invoice_entry_update" type="submit" class="btn btn-success">Save </button>
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
                           Invoice Entry List
                        </div>

                        <div class="panel-body">
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">

								<form action="index.php" method="post" id="quotation_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>INV.No.</th>

                                            <th>Date</th>

                                            <th>Customer</th>

                                            <th>Validity Date</th>

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="quotation_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

											</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($invoice_list	as $get_invoice){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=$get_invoice['invoice_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_invoice['invoice_entry_date'])?></td>

											<td><?=$get_invoice['customer_name']?></td>

                                            <td><?=dateGeneralFormatN($get_invoice['invoice_entry_validity_date'])?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_invoice['invoice_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_invoice['invoice_entry_uniq_id']; ?>" type="checkbox" />

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

		

		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Quotation Entry Detail</h4>

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
<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
    <div id="footer-sec">

        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>

    </div>

    <!-- /. FOOTER  -->
			<script>
			$(document).ready(function () {
				$('#dataTables-example').DataTable( {
					responsive: true
				} );
			});
			//Initialize Select2 Elements
			$(".select2").select2();
			$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#invoice_entry_due_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
				$( "#invoice_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
				$( "#invoice_entry_validity_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'',changeMonth:true,changeYear:true,});
			});
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

<!-- 
<tbody id="product_detail_display">

										<?php 

										$row_cnt	= 1;

										$arr_cnt	= count($quotation_entry_prd_edit);

										foreach($quotation_entry_prd_edit as $get_product_detail){
										
											

										?>

										<tr>

											<td>

											<?=$get_product_detail['product_code']?>

											</td>

											<td>

											<?=$get_product_detail['product_name']?>

											<input type="hidden"  name="quotation_entry_product_detail_product_id[]" id="quotation_entry_product_detail_product_id" value="<?=$get_product_detail['quotation_entry_product_detail_product_id']?>" class="sd_id"  />

											<input type="hidden"  name="quotation_entry_product_detail_id[]" id="quotation_entry_product_detail_id" value="<?=$get_product_detail['quotation_entry_product_detail_id']?>" />
											<input type="hidden"  name="quotation_entry_product_detail_type[]" id="quotation_entry_product_detail_type" value="<?=$get_product_detail['quotation_entry_product_detail_type']?>" />
											</td>

											<td>

											<input class="form-control" type="text"  name="product_uom[]" id="product_uom<?=$row_cnt?>" value="<?=$get_product_detail['p_uom_name']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_length_feet[]" id="quotation_entry_product_detail_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['quotation_entry_product_detail_length_feet']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_length_inches[]" id="quotation_entry_product_detail_length_inches<?=$row_cnt?>" value="<?=$get_product_detail['quotation_entry_product_detail_length_inches']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_length_mm[]" id="quotation_entry_product_detail_length_mm<?=$row_cnt?>" value="<?=$get_product_detail['quotation_entry_product_detail_length_mm']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_length_meter[]" id="quotation_entry_product_detail_length_meter<?=$row_cnt?>" value="<?=$get_product_detail['quotation_entry_product_detail_length_meter']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_width_inches[]" id="quotation_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['product_inches_qty']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_qty[]" id="quotation_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['quotation_entry_product_detail_qty']?>" />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_total_length[]" id="quotation_entry_product_detail_total_length<?=$row_cnt?>"  value="<?=$get_product_detail['quotation_entry_product_detail_total_length']?>" />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_rate[]" id="quotation_entry_product_detail_rate<?=$row_cnt?>"  value="<?=$get_product_detail['quotation_entry_product_detail_rate']?>" />

											</td>

											<td>

											<input class="form-control" type="text"  name="quotation_entry_product_detail_amount[]" id="quotation_entry_product_detail_amount<?=$row_cnt?>"  value="<?=$get_product_detail['quotation_entry_product_detail_amount']?>" />

											</td>

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['quotation_entry_product_detail_id']?>&quotation_entry_uniq_id=<?php echo $quotation_entry_edit['quotation_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>

-->