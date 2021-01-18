<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PRODUCTION ORDER DETAILS</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Order deleted successfully</div>';
		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/production-order-sale/production-order-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/sales-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Production Order</h1>

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

								  	Production Order Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											
											<input type="hidden" class="form-control" name="production_order_no" id="production_order_no" value="<?= $invoice_entry_no?>" style="width:460px;" readonly required>
										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="production_order_branch_id" id="production_order_branch_id" class="form-control select2" style="width:100%" required>

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

											<label class="control-label">Production Section</label>

											<select name="production_order_production_section_id" id="production_order_production_section_id" class="form-control select2" style="width:100%" >

												  <option value=""> - Select - </option>

												<?php

													foreach($prd_sec_list as $get_prd_sec){

												?>

														<option value="<?=$get_prd_sec['production_section_id']?>"><?=$get_prd_sec['production_section_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label class="control-label">Customer</label>

											<select name="production_order_customer_id" id="production_order_customer_id" class="form-control select2" onChange="GetcustomerDetail()" required>

												<option value=""> - Select - </option>

												<?php

												foreach($customer_list as $get_customer){

												?>

														<option value="<?=$get_customer['customer_id']?>"><?=$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Contact No.</label>

											  <input type="text" class="form-control" name="production_order_contact_no" id="production_order_contact_no" >

										</div>
                                        <div class="form-group " style="padding-top:05px;">

											<label class="control-label" >Type</label><br/>	
											<?php $sno=1;
													foreach($arrQuotationType as $key => $value){
												?>
							<input type="radio" name="production_order_type_id[]"  id="production_order_type_id<?=$sno?>" value="<?=$key?>" onClick="getTableHeader(this.value,<?=$sno++?>)"  /> <?=$value?><br/>
												<?php
													}
												?>
										</div>
										<!--<div class="form-group">

											<label class="control-label">Type</label>

											<select name="production_order_type_id" id="production_order_type_id" class="form-control select2" style="width:100%" required onChange="getTableHeader(this.value)">
												  <option value=""> - Select - </option>
												<?php
													foreach($arrQuotationType as $key => $value){
												?>
														<option value="<?=$key?>"><?=$value?></option>
												<?php
													}
												?>
											</select>

										</div>-->
									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="production_order_date" id="production_order_date" value="<?=date('d/m/Y')?>"  required>

											</div>

										</div>

										<div class="form-group">

											<label>Department</label>

											<select name="production_order_department_id" id="production_order_department_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($department_list	as	$get_department){

												?>

														<option value="<?=$get_department['department_id']?>"><?=$get_department['department_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Address</label>

											<textarea class="form-control" name="production_order_address" id="production_order_address"  ></textarea>

										</div>

										<div class="form-group">

											<label>Production Type</label>

											<select name="production_order_type" id="production_order_type" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($arr_producton_type	as	$value=>$list){

												?>

														<option value="<?=$value?>"><?=$list?></option>

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

                                        <tr>
                                            <th style=" width:30%;">Inv No</th>
                                            <th  style=" width:25%;">Inv Date</th>
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
											
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>

											<th rowspan="2" style="vertical-align:middle;">QTY</th>


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
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES WEIGHT</th>

                                        </tr>

										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> INCHES</th>
											<th> MM</th>
											<th> TON</th>
											<th> KG</th>
                                            <th> Met</th>
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
											
											<th rowspan="2" style="vertical-align:middle;"> Total Length</th>

											<th rowspan="2" style="vertical-align:middle;">QTY</th>

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

                                        </tr>

                                    </thead>

                                    <tbody id="product_detail_display">

									

									</tbody>

								</table>
								</div>
								<div class="col-lg-6">
									<button name="production_order_insert" type="submit" class="btn btn-success">Save </button>
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

								  	Production Order Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label>P.O No.</label>
											<input type="text" class="form-control" name="production_order_no" id="production_order_no" style="width:460px;"  value="<?=$production_order_edit['production_order_no']?>">
										</div>
									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="production_order_branch_id" id="production_order_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$production_order_edit['production_order_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Production Section</label>

											<select name="production_order_production_section_id" id="production_order_production_section_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($prd_sec_list	as	$get_prd_sec){

														$selected	= ($get_prd_sec['production_section_id']==$production_order_edit['production_order_production_section_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_prd_sec['production_section_id']?>" <?=$selected?>><?=$get_prd_sec['production_section_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Customer</label>

											<select name="production_order_customer_id" id="production_order_customer_id" class="form-control select2" onChange="GetcustomerDetail()">

												<option value=""> - Select - </option>

												<?php

												foreach($customer_list as $get_customer){

														$selected	= ($get_customer['customer_id']==$production_order_edit['production_order_customer_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_customer['customer_id']?>" <?=$selected?>><?=$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Contact No.</label>

											  <input type="text" class="form-control" name="production_order_contact_no" id="production_order_contact_no" value="<?=$production_order_edit['customer_contact_no']?>" >

										</div>
                                        
										<div class="form-group " style="padding-top:05px;">

											<label class="control-label" >Type</label><br/>	
											<?php
													$sno=1;
													
													$arr_type	= explode(",",$production_order_edit['production_order_type_id']);
												foreach($arrQuotationType as $key => $value){
												$checked = (in_array($key,$arr_type)==1)?"checked=checked":'';
												?>
							<input type="radio" name="production_order_type_id[]"  id="production_order_type_id<?=$sno?>" value="<?=$key?>" <?=$checked?> onClick="getTableHeader(this.value,<?=$sno++?>)" /> <?=$value?><br/>
												<?php
													}
												?>
										</div>
                                       <!-- <div class="form-group">

											<label class="control-label">Type</label>

											<select name="production_order_type_id" id="production_order_type_id" class="form-control select2" style="width:100%" required onChange="getTableHeader(this.value)">
												  <option value=""> - Select - </option>
												<?php
													foreach($arrQuotationType as $key => $value){
												?>
														<option value="<?=$key?>" <?php if($production_order_edit['production_order_type_id']==$key){?> selected <?php }?>><?=$value?></option>
												<?php
													}
												?>
											</select>

										</div>-->

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="production_order_date" id="production_order_date" value="<?=dateGeneralFormatN($production_order_edit['production_order_date'])?>">

											</div>

										</div>

										<div class="form-group">

											<label>Department</label>

											<select name="production_order_department_id" id="production_order_department_id" class="form-control select2" style="width:100%" >

												  <option value=""> - Select - </option>

												<?php

													foreach($department_list	as	$get_department){

														$selected	= ($get_department['department_id']==$production_order_edit['production_order_department_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_department['department_id']?>" <?=$selected?>><?=$get_department['department_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Address</label>

											<textarea class="form-control" name="production_order_address" id="production_order_address"  ><?=$production_order_edit['customer_billing_address']?></textarea>

										</div>

										<div class="form-group">

											<label>Production Type</label>

											<select name="production_order_type" id="production_order_type" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($arr_producton_type	as	$value=>$list){

														$selected	= ($value==$production_order_edit['production_order_type'])?'selected="selected"':'';

												?>

														<option value="<?=$value?>" <?=$selected?>><?=$list?></option>

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

										<td><?=$sales_detail_edit['invoice_entry_no']?></td>

										<td><?=dateGeneralFormatN($sales_detail_edit['invoice_entry_date'])?>

										<input type="hidden"  name="production_order_invoice_entry_id" id="production_order_invoice_entry_id" value="<?=$production_order_edit['production_order_invoice_entry_id']?>"  class="dc_id"  /></td>

										

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
											
											<th rowspan="2" style="vertical-align:middle;"> Total Length</th>

											<th rowspan="2" style="vertical-align:middle;"> QTY </th>

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
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES WEIGHT</th>

                                        </tr>

										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th> INCHES</th>
											<th> MM</th>
											<th> TON</th>
											<th> KG</th>
                                            <th> Met</th>
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
											
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>

											<th rowspan="2" style="vertical-align:middle;">QTY</th>

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


                                        </tr>

                                    </thead>

                                    <tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($production_order_prd_edit);
										
										foreach($production_order_prd_edit as $get_product_detail){
										
											//if($get_product_detail['production_order_product_detail_product_type']==1){
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['product_colour_name'];
											/*}
											else{
												$product_code			= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name			= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name		= $get_product_detail['c_uom_name'];
												$product_colour_name	= $get_product_detail['c_colour_name'];
											}
										*/
											if($production_order_edit['production_order_type_id']==1){ 
											?>
					
										<tr class="rls" style="display:none">

											
											
											<td>
											<input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type"value="<?=$get_product_detail['production_order_product_detail_mother_child_type']?>"  />
<input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_type']?>"  />

											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="production_order_product_detail_product_brand_id[]" id="production_order_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_id']?>"  />
											<input type="hidden"  name="production_order_product_detail_id[]" id="production_order_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick<?=$row_cnt?>" value="<?=$arr_thick[number_format($get_product_detail['production_order_product_detail_product_thick'],0)]?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />


											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_width_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_sl_feet[]" id="production_order_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_sl_feet']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_sl_feet_in[]" id="production_order_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_sl_feet_in']?>" onKeyUp="GetLcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_sl_feet_mm[]" id="production_order_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_sl_feet_mm']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_tot_length[]" id="production_order_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['production_order_product_detail_tot_length']?>" readonly />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['production_order_product_detail_qty']?>" onBlur="GetTotalLength(<?=$row_cnt?>)" onKeyUp="get_stock(<?=$row_cnt?>)" />
                                            <input class="form-control" type="hidden"  name="production_order_product_detail_max_qty[]" id="production_order_product_detail_max_qty<?=$row_cnt?>"  value="<?=$get_product_detail['production_order_product_detail_max_qty']?>" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_order_product_detail_id']?>&production_order_uniq_id=<?php echo $production_order_edit['production_order_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($production_order_edit['production_order_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">

											
											<td>
											<input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type"value="<?=$get_product_detail['production_order_product_detail_mother_child_type']?>"  />
<input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_type']?>" />

											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="production_order_product_detail_product_brand_id[]" id="production_order_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_id']?>"  />
											<input type="hidden"  name="production_order_product_detail_id[]" id="production_order_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick<?=$row_cnt?>" value="<?=$arr_thick[number_format($get_product_detail['production_order_product_detail_product_thick'],0)]?>"   />

											</td>


											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />


											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_width_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_weight_inches[]" id="production_order_product_detail_s_weight_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_weight_inches']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)"  />
											</td>
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_weight_mm[]" id="production_order_product_detail_s_weight_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_weight_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)"  />
											</td>
                                            
                                            <td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_weight_met[]" id="production_order_product_detail_s_weight_met<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_weight_met']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)"  />

											</td>

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_order_product_detail_id']?>&production_order_uniq_id=<?php echo $production_order_edit['production_order_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($production_order_edit['production_order_type_id']==3){ ?>
										
										<tr class="ccs" style="display:none">

											
											
											<td>
<input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_type']?>" />

											<?=$get_product_detail['brand_name']?>

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_id']?>"  />
											<input type="hidden"  name="production_order_product_detail_id[]" id="production_order_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_thick']?>" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_s_width_mm']?>"  onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_sl_feet[]" id="production_order_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_sl_feet']?>" onKeyUp="GetWcalFeet(1,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_sl_feet_in[]" id="production_order_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_sl_feet_in']?>" onKeyUp="GetWcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_sl_feet_mm[]" id="production_order_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_sl_feet_mm']?>" onKeyUp="GetWcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_tot_length[]" id="production_order_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['production_order_product_detail_tot_length']?>" readonly />

											</td>


											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['production_order_product_detail_qty']?>"  onBlur="get_stock(<?php echo $row_cnt; ?>);">

											</td>

											
										

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_order_product_detail_id']?>&production_order_uniq_id=<?php echo $production_order_edit['production_order_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }else{ ?>
										
										<tr class="as" style="display:none">

											
											
											<td>
											<input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type"value="<?=$get_product_detail['production_order_product_detail_mother_child_type']?>"  />
<input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_type']?>" />

											<?=$product_name?>

											<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_product_id']?>"  />
											<input type="hidden"  name="production_order_product_detail_id[]" id="production_order_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['production_order_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_uom_name?>
											</td>


											<td>

											<input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['production_order_product_detail_qty']?>" />

											</td>



											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['production_order_product_detail_id']?>&production_order_uniq_id=<?php echo $production_order_edit['production_order_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php 
										 }

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>
								
								</table>

								</div>

								<div class="col-lg-6">

								<input type="hidden"  name="production_order_id" id="production_order_id" value="<?=$production_order_edit['production_order_id']?>" />	

								<input type="hidden"  name="production_order_uniq_id" id="production_order_uniq_id" value="<?=$production_order_edit['production_order_uniq_id']?>" />	
									<button name="production_order_update" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>


								</div>

							</div>

						</div>

					</div>

				</div>

				

				</form>
			<script type="text/javascript">
			getTableHeader(<?=$production_order_edit['production_order_type_id']?>);
			</script>

				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Production Order List

                        </div>

                        <div class="panel-body">
							<form action="index.php" method="post" id="so_list_form" name="so_list_form" >
						
							<div class="col-lg-6">

									<div class="form-group">

										<label class="control-label">Branch</label>

										<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" required>

											  <option value=""> - Select - </option>

											<?php

												foreach($branch_list	as	$get_branch){
											$selected	= ($get_branch['branch_id']==searchValue('search_branch_id'))?'selected="selected"':'';
											?>

													<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

											<?php

												}

											?>

										</select>

									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">

											<label class="control-label">Customer</label>

											<select name="customerid" id="customerid" class="form-control select2" style="width:100%"  >

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){
													//$selected	= ($get_branch['customer_id']==searchValue('customerid'))?'selected="selected"':'';

												?>

							          <option value="<?=$get_customer['customer_id']?>" <?php if(searchValue('customerid')==$get_customer['customer_id']) {?> selected="selected" <?php }?>><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>
										</div>
									<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">From Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date" autocomplete="off"  value="<?=searchValue('search_from_date')?>"  >
										</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">To Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_to_date" id="search_to_date" autocomplete="off"  value="<?=searchValue('search_to_date')?>"  />
										</div>
									</div>
									</div>
							<div class="col-lg-12">
								<button name="search" type="submit" class="btn btn-success">Search </button>
								<button type="reset" class="btn btn-danger">Reset </button>
							</div>
							</form>
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">
							<?php if(isset($_REQUEST['search'])){?>

								<form action="index.php" method="post" id="production_order_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>INV.No.</th>

                                            <th>Date</th>
											<th>Customer</th>
                                            <th>Request By</th>

                                            <th>Production Section</th>

                                            <th>Print</th>
											<th>Action</th>
											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="production_order_entry_delete" type="submit" class="btn btn-danger">Delete</button>

											</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;
										$inv_no  = 1;

										foreach($quotation_list	as $get_quotation){
										$edit_status =editStatus('gin_entry_product_details','gin_entry_product_detail_po_detail_id',$get_quotation['production_order_uniq_id'],'gin_entry_product_detail_deleted_status');
										$delete_status = deleteStatus();
										if($delete_status ==1){
										  $delete_status = $edit_status;
										}

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=$get_quotation['production_order_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['production_order_date'])?></td>
											
											<td><?=$get_quotation['customer_name']?></td>
                                            <td><?=$arr_producton_type[$get_quotation['production_order_type']]?></td>

											<td><?=$get_quotation['production_section_name']?></td>
											<td>
											<a href="production-order-print.php?id=<?php echo $get_quotation['production_order_uniq_id']?>" title="INVOICE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
                                            <td class="center">
											<?php if($edit_status == 1){ ?>

												<a href="index.php?page=edit&id=<?php echo $get_quotation['production_order_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>
												
												&nbsp;&nbsp;
												<?php }?>

      										</td>

											<td>
											<?php if($delete_status == 1){ ?>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['production_order_uniq_id']; ?>" type="checkbox" />
												<?php }?>

											</td>

                                        </tr>

									<?php } ?>

                                    </tbody>

                                </table>

								</form>
								<?php } ?>

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

						<h4 class="modal-title" id="myModalLabel">Production Order Detail</h4>

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

       <?=PROJECT_FOOTER?>

    </div>
    <!-- /. FOOTER  -->
	<script>
	
	
	$(document).ready(function () {
		$('#dataTables-example').DataTable( {
			responsive: true
		} );
	});
	$(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
	//Initialize Select2 Elements
	$(".select2").select2();
	//$('.datatable').DataTable()
	$(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_order_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
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

