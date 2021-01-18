<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CREDIT NOTE ENTRY DETAILS</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Credit Note added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Credit Note updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Credit Note deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Credit Note Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Credit Note deleted successfully</div>';
		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/credit-note-entry/credit-note-entry-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/sales-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Credit Note</h1>

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

				<form name="customer_form" id="customer_form" method="post" data-toggle="validator" >

				<div class="row">
					
					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Credit Note Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
						
											<input type="hidden" class="form-control" name="credit_note_entry_no" id="credit_note_entry_no"  readonly="" style="width:460px;" required>
										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="credit_note_entry_branch_id" id="credit_note_entry_branch_id" class="form-control select2" style="width:100%" required>

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

											<label class="control-label">Customer</label>

											<select name="credit_note_entry_customer_id" style="width:100%;" id="credit_note_entry_customer_id" class="form-control select2" onChange="GetcustomerDetail()">

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

											<label> Type</label>

											<select name="credit_note_entry_type" id="credit_note_entry_type" class="form-control select2" style="width:100%">

												  <option value=""> -- Select -- </option>

													<option value="1">Stock</option>
													<option value="2">Account</option>

											
											</select>

										</div>
										
										<div class="form-group">

											<label> Sales Warehouse</label>

										  <input type="checkbox" class="checkbox" name="credit_note_entry_sw_type" id="credit_note_entry_sw_type" va;ue='1'>


										</div>
									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="credit_note_entry_date" id="credit_note_entry_date"  value="<?=date('d/m/Y')?>"  required>

											</div>

										</div>

										

										<div class="form-group">

											<label>Address</label>

											<textarea class="form-control" name="credit_note_entry_address" id="credit_note_entry_address"  ></textarea>

										</div>

										
										<div class="form-group">
										
											<label >Extra Warehouse</label>

											<select name="credit_note_entry_godown_id" id="credit_note_entry_godown_id" class="form-control select2" style="width:100%">
												<?php
													foreach($godown_list	as	$get_godown){
												?>
														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
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
                                <table class="table table-striped table-bordered table-hover" id="product_detail_rls"  style="width:100%;display:none">
									
                                    <thead  >
                                         <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="4"> SALES LENGTH</th>
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
											<th>Met</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rls_display">
									</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:none">
									
									<thead>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> Rate</th>
											<th rowspan="2" style="vertical-align:middle;"> Amount</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>TON</th>
											<th>KG</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rws_display">
									
									</tbody>

								</table>
								<table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%; display:none" >
									
									<thead >

                                         <tr>


                                            <th style="vertical-align:middle;">NAME</th>

                                            <th style="vertical-align:middle;">UOM</th>

											<!--<th style="vertical-align:middle;">QTY</th>-->
											<th style="vertical-align:middle;">SALE BY</th>

											<th style="vertical-align:middle;">Rate</th>

											<th style="vertical-align:middle;">TOTAL</th>

                                        </tr>

                                    </thead>

                                    <tbody id="product_detail_as_display">

									

									</tbody>

								</table>
								</div>
								<div class="col-lg-6">
									<button name="credit_note_entry_insert" type="submit" class="btn btn-success">Save </button>
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
											<input type="text" class="form-control" name="credit_note_entry_no" id="credit_note_entry_no" style="width:460px;"  value="<?=$credit_note_entry_edit['credit_note_entry_no']?>">
										</div>
									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="credit_note_entry_branch_id" id="credit_note_entry_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$credit_note_entry_edit['credit_note_entry_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<div class="form-group">

											<label>Customer</label>

											<select name="credit_note_entry_customer_id" id="credit_note_entry_customer_id" class="form-control select2" style="width:100%" onChange="GetcustomerDetail()">

												<option value=""> - Select - </option>

												<?php

												foreach($customer_list as $get_customer){

														$selected	= ($get_customer['customer_id']==$credit_note_entry_edit['credit_note_entry_customer_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_customer['customer_id']?>" <?=$selected?>><?=$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Production Type</label>

											<select name="credit_note_entry_type" id="credit_note_entry_type" class="form-control select2" style="width:100%">

												<option value=""> - Select - </option>
												<option value="1" <?php if($credit_note_entry_edit['credit_note_entry_type']==1){echo 'selected="selected"';}?>>Stock</option>
												<option value="2" <?php if($credit_note_entry_edit['credit_note_entry_type']==2){echo 'selected="selected"';}?>>Account</option>

											</select>

										</div>

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="credit_note_entry_date" id="credit_note_entry_date" value="<?=dateGeneralFormatN($credit_note_entry_edit['credit_note_entry_date'])?>">

											</div>

										</div>

										

										<div class="form-group">

											<label>Address</label>

											<textarea class="form-control" name="credit_note_entry_address" id="credit_note_entry_address"  ><?=$credit_note_entry_edit['customer_billing_address']?></textarea>

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

										<input type="hidden"  name="credit_note_entry_invoice_entry_id" id="credit_note_entry_invoice_entry_id" value="<?=$credit_note_entry_edit['credit_note_entry_invoice_entry_id']?>"  class="dc_id"  /></td>

										

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
								
								<table class="table table-striped table-bordered table-hover" id="product_detail_rls" style="width:100%;" ><!--style="width:100%;display:none"-->
									
                                    <thead  >
                                         <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="4"> SALES LENGTH</th>
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
											<th>Met</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rls_display">
									<?php 
									
									$row_cnt	= 0;

										$arr_cnt	= count($credit_note_entry_prd_edit);
										
										foreach($credit_note_entry_prd_edit as $get_product_detail){ 
										
											//if($get_product_detail['credit_note_entry_product_detail_product_type']==1){
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
											/*}
											else{
												$product_code			= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name			= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name		= $get_product_detail['c_uom_name'];
												$product_colour_name	= $get_product_detail['c_colour_name'];
											}*/
										
											if($get_product_detail['credit_note_entry_product_detail_entry_type']==1){  ?> 
											
										<tr>
											<td><?=$get_product_detail['brand_name']?></td>
											
											<td><?=$product_name?>
											
											<input type="hidden"  name="credit_note_entry_product_is_opp[]" id="credit_note_entry_product_is_opp" value="0" />
											<input type="hidden"  name="credit_note_entry_product_opp_feet_per_qty[]" id="credit_note_entry_product_opp_feet_per_qty" value="0" />
											<input type="hidden"  name="credit_note_entry_product_detail_sale_by[]" id="credit_note_entry_product_detail_sale_by" value="" />
											
											<input type="hidden"  name="credit_note_entry_product_detail_mother_child_type[]" id="credit_note_entry_product_detail_mother_child_type" value="<?=$get_product_detail['credit_note_entry_product_detail_entry_type']?>" /><input type="hidden"  name="credit_note_entry_product_detail_id[]" id="credit_note_entry_product_detail_id" value="<?=$get_product_detail['credit_note_entry_product_detail_id']?>" />
											<input type="hidden" name="credit_note_entry_product_detail_product_id[]" id="credit_note_entry_product_detail_product_id" value="<?=$get_product_detail['credit_note_entry_product_detail_product_id']?>" />
											<input type="hidden"  name="credit_note_entry_product_detail_product_type[]" id="credit_note_entry_product_detail_product_type" value="<?=$get_product_detail['credit_note_entry_product_detail_product_type']?>" />
											<input type="hidden"  name="credit_note_entry_product_detail_entry_type[]" id="credit_note_entry_product_detail_entry_type" value="<?=$get_product_detail['credit_note_entry_product_detail_entry_type']?>" /></td>
											
											<td> <?=$product_colour_name?>
											</td>
			
											<td> <?=$arr_thick[$get_product_detail['credit_note_entry_product_detail_product_thick']]?><!--<input class="form-control" type="hidden"  name="credit_note_entry_product_detail_product_thick[]" id="credit_note_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['credit_note_entry_product_detail_entry_type']?>"/>--></td>
											
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_width_inches[]"               id="credit_note_entry_product_detail_width_inches<?=$row_cnt?>"  onkeyup="GetLcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_width_inches']?>" readonly /></td>
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_width_mm[]" id="credit_note_entry_product_detail_width_mm<?=$row_cnt?> "  onkeyup="GetLcalc(3,<?=$row_cnt?> )" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_width_mm']?>" readonly /></td> 
			
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_width_inches[]"            id="credit_note_entry_product_detail_s_width_inches<?=$row_cnt?>"   onkeyup="GetLcalS(2,<?=$row_cnt ?> )" onBlur="GetTotalLength(<?=$row_cnt ?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_s_width_inches']?>" readonly/></td> 
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_width_mm[]"                  id="credit_note_entry_product_detail_s_width_mm<?=$row_cnt?>" onKeyUp="GetLcalS(3,<?=$row_cnt?> )" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_s_width_mm']?>" readonly/></td>
											
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_sl_feet[]" id="credit_note_entry_product_detail_sl_feet<?=$row_cnt?>" onBlur="GetLcalFeet(1,<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_sl_feet']?>" readonly /></td> 
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_sl_feet_in[]" id="credit_note_entry_product_detail_sl_feet_in<?=$row_cnt?>" onBlur="GetLcalFeet(1,<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>)"  value="<?=$get_product_detail['credit_note_entry_product_detail_sl_feet_in']?>" readonly /></td>
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_sl_feet_mm[]" id="credit_note_entry_product_detail_sl_feet_mm<?=$row_cnt?>" onBlur="GetLcalFeet(3,<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_sl_feet_mm']?>" readonly /> </td> 
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_sl_feet_met[]" id="credit_note_entry_product_detail_sl_feet_met<?=$row_cnt?>" onBlur="GetLcalFeet(3,<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_sl_feet_met']?>" readonly /> 
											<input type="hidden" name="credit_note_entry_product_detail_s_weight_inches[]" id="credit_note_entry_product_detail_s_weight_inches<?=$row_cnt?> " value=""   />
											<input type="hidden"  name="credit_note_entry_product_detail_s_weight_mm[]" id="credit_note_entry_product_detail_s_weight_mm<?=$row_cnt?>" value=""   /></td> 
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_qty'])?>" onBlur="GetTotalLength(<?=$row_cnt?>),discountPerFind(<?=$row_cnt?>)"  onKeyUp="get_stock(<?=$row_cnt?>)"/>
                                            <input class="form-control" type="hidden"  name="credit_note_entry_product_detail_max_qty[]" id="credit_note_entry_product_detail_max_qty<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_max_qty'])?>"  /></td>
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_tot_length[]" id="credit_note_entry_product_detail_tot_length<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_tot_length'])?>"  readonly />
											<input  type="hidden"  name="credit_note_entry_product_detail_inv_tot_length[]" id="credit_note_entry_product_detail_inv_tot_length<?=$row_cnt?>" readonly value="<?=round($get_product_detail['credit_note_entry_product_detail_inv_tot_length'])?>"   /></td> 
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_rate[]" id="credit_note_entry_product_detail_rate<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_rate'])?>"  readonly /></td> 
											<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_total[]" id="credit_note_entry_product_detail_total<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_total'])?>"  readonly  /></td> 
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['credit_note_entry_product_detail_id']?>&credit_note_entry_uniq_id=<?php echo $credit_note_entry_edit['credit_note_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
																			
										</tr> 
											<?php $row_cnt++; } }?>
									</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:none"><!--display:none-->
									
									<thead>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> Rate</th>
											<th rowspan="2" style="vertical-align:middle;"> Amount</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th> MM</th>
											<th>INCHES</th>
											<th>MM</th>
											<th>TON</th>
											<th>KG</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rws_display">
									<?php foreach($credit_note_entry_prd_edit as $get_product_detail){ 
										
											
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
											
										
											if($get_product_detail['credit_note_entry_product_detail_entry_type']==2){?>
											
											<tr>
												<td><?=$get_product_detail['brand_name']?></td>
												<td><?=$product_name?>
												
												<input type="hidden"  name="credit_note_entry_product_is_opp[]" id="credit_note_entry_product_is_opp" value="0" />
												<input type="hidden"  name="credit_note_entry_product_opp_feet_per_qty[]" id="credit_note_entry_product_opp_feet_per_qty" value="0" />
												<input type="hidden"  name="credit_note_entry_product_detail_sale_by[]" id="credit_note_entry_product_detail_sale_by" value="" />
											
												<input type="hidden"  name="credit_note_entry_product_detail_mother_child_type[]" id="credit_note_entry_product_detail_mother_child_type" value="<?=$get_product_detail['credit_note_entry_product_detail_entry_type']?>" />
												<input type="hidden"  name="credit_note_entry_product_detail_id[]" id="credit_note_entry_product_detail_id" value="<?=$get_product_detail['credit_note_entry_product_detail_id']?>" />
												<input type="hidden"  name="credit_note_entry_product_detail_id[]" id="credit_note_entry_product_detail_id" value="<?=$get_product_detail['credit_note_entry_product_detail_id']?>" />
												<input type="hidden"  name="credit_note_entry_product_detail_product_id[]" id="credit_note_entry_product_detail_product_id" value="<?=$get_product_detail['credit_note_entry_product_detail_product_id']?>" />
												<input type="hidden"  name="credit_note_entry_product_detail_product_type[]" id="credit_note_entry_product_detail_product_type" value="<?=$get_product_detail['credit_note_entry_product_detail_product_type']?>" />
												<input type="hidden"  name="credit_note_entry_product_detail_entry_type[]" id="credit_note_entry_product_detail_entry_type" value="<?=$get_product_detail['credit_note_entry_product_detail_entry_type']?>" /></td>
												<td><?=$product_colour_name?></td>
			
												<td><?=$arr_thick[$get_product_detail['credit_note_entry_product_detail_product_thick']]?></td>
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_width_inches[]" id="credit_note_entry_product_detail_width_inches<?=$row_cnt?>"  onkeyup="GetLcalc(2,<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_width_inches']?>" readonly /></td> 
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_width_mm[]" id="credit_note_entry_product_detail_width_mm<?=$row_cnt?>"   onkeyup="GetLcalc(3,<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_width_mm']?>" readonly /></td>
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_width_inches[]" id="credit_note_entry_product_detail_s_width_inches<?=$row_cnt?>"   onkeyup="GetLcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_s_width_inches']?>" readonly/></td> 
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_width_mm[]" id="credit_note_entry_product_detail_s_width_mm<?=$row_cnt?>" onKeyUp="GetLcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['credit_note_entry_product_detail_s_width_mm']?>" readonly /></td>
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_weight_inches[]" id="credit_note_entry_product_detail_s_weight_inches<?=$row_cnt?>"  onblur="GetWeightClc(1,<?=$row_cnt?>),RawdiscountPerFind(<?=$row_cnt?>)"   value="<?=$get_product_detail['credit_note_entry_product_detail_s_weight_inches']?>"   /></td> 
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_weight_mm[]" id="credit_note_entry_product_detail_s_weight_mm<?=$row_cnt?>"  onblur="GetWeightClc(1,<?=$row_cnt?>)"  value="<?=$get_product_detail['credit_note_entry_product_detail_s_weight_mm']?>"   />
												<input type="hidden"  name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_qty'])?>" /></td>
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_rate[]" id="credit_note_entry_product_detail_rate<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_rate'])?>"  onBlur="RawdiscountPerFind(<?=$row_cnt?>)"    /></td> 
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_total[]" id="credit_note_entry_product_detail_total<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_total'])?>"   /></td>
												<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['credit_note_entry_product_detail_id']?>&credit_note_entry_uniq_id=<?php echo $credit_note_entry_edit['credit_note_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
			
											</tr>
											
											<?php $row_cnt++;} }?>
									</tbody>

								</table>
								<table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%;display:none" ><!-- display:none-->
									
									<thead >

                                         <tr>


                                            <th style="vertical-align:middle;">NAME</th>

                                            <th style="vertical-align:middle;">UOM</th>

											<!--<th style="vertical-align:middle;">QTY</th>-->
											<th style="vertical-align:middle;">SALE BY</th>

											<th style="vertical-align:middle;">Rate</th>

											<th style="vertical-align:middle;">TOTAL</th>

                                        </tr>

                                    </thead>

                                    <tbody id="product_detail_as_display">

									<?php foreach($credit_note_entry_prd_edit as $get_product_detail){ 
										
											
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
											
										
											if($get_product_detail['credit_note_entry_product_detail_entry_type']==4){?>
											
											<tr>
												<td><?=$product_name?>
												
												<input class="form-control" type="hidden"  name="credit_note_entry_product_detail_max_qty[]" id="credit_note_entry_product_detail_max_qty<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_max_qty'])?>"  />
												
												<input type="hidden"  name="credit_note_entry_product_detail_mother_child_type[]" id="credit_note_entry_product_detail_mother_child_type" value="<?=$get_product_detail['credit_note_entry_product_detail_entry_type']?>" /><input type="hidden"  name="credit_note_entry_product_detail_id[]" id="credit_note_entry_product_detail_id" value="<?=$get_product_detail['credit_note_entry_product_detail_id']?>" />
												<input type="hidden"  name="credit_note_entry_product_detail_product_id[]" id="credit_note_entry_product_detail_product_id" value="<?=$get_product_detail['credit_note_entry_product_detail_product_id']?>" />
													<input type="hidden"  name="credit_note_entry_product_detail_product_type[]" id="credit_note_entry_product_detail_product_type" value="<?=$get_product_detail['credit_note_entry_product_detail_product_type']?>"/>
													
													<input type="hidden"  name="credit_note_entry_product_detail_entry_type[]" id="credit_note_entry_product_detail_entry_type" value="<?=$get_product_detail['credit_note_entry_product_detail_entry_type']?>" /></td>
												
												<td><?=$product_uom_name?></td>
												
												<td>
													<?php
														if($get_product_detail['product_is_opp'] == 1) {
															$result_opp = mysql_query("Select stock_ledger_product_feet_per_quantity From stock_ledger Where stock_ledger_type = 'in' AND stock_ledger_product_id = ".$get_product_detail['credit_note_entry_product_detail_product_id']." LIMIT 1");
															$opp_arr = mysql_fetch_assoc($result_opp);
															$feet_per_qty = $opp_arr['stock_ledger_product_feet_per_quantity'];
													?>
													<input type="hidden" name="credit_note_entry_product_opp_feet_per_qty[]" id="credit_note_entry_product_opp_feet_per_qty<?=$row_cnt?>" value="<?php echo $feet_per_qty; ?>" >
													<input type="hidden" name="credit_note_entry_product_is_opp[]" id="credit_note_entry_product_is_opp<?=$row_cnt?>" value="1" >
													<?php
														} else {
													?>
													<input type="hidden" name="credit_note_entry_product_opp_feet_per_qty[]" id="credit_note_entry_product_opp_feet_per_qty<?=$row_cnt?>" value="0" >
													<input type="hidden" name="credit_note_entry_product_is_opp[]" id="credit_note_entry_product_is_opp<?=$row_cnt?>" value="0" >
													<?php
														}
													?>
												
													<?php
														if($get_product_detail['credit_note_entry_product_detail_sale_by'] == "FEET") {
													?>
														<input class="form-control" type="text" style="width:20%;display:inline-block;" name="credit_note_entry_product_detail_sale_by[]" id="credit_note_entry_product_detail_sale_by<?=$row_cnt?>" value="FEET" readonly />&nbsp;&nbsp;&nbsp;
														<input class="form-control" type="text" style="width:60%;display:inline-block;" name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty<?=$row_cnt?>" value="<?=round($get_product_detail['credit_note_entry_product_detail_sale_feet'])?>" onKeyUp="get_amt_note(<?=$row_cnt?>);" />
													<?php
														}
														else {
													?>
														<input class="form-control" type="text" style="width:20%;display:inline-block;" name="credit_note_entry_product_detail_sale_by[]" id="credit_note_entry_product_detail_sale_by<?=$row_cnt?>" value="QTY" readonly />&nbsp;&nbsp;&nbsp;
														<input class="form-control" type="text" style="width:60%;display:inline-block;" name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty<?=$row_cnt?>" value="<?=round($get_product_detail['credit_note_entry_product_detail_qty'])?>" onKeyUp="get_amt_note(<?=$row_cnt?>);" />
													<?php
														}
													?>
													
												</td>												
												
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_rate[]" id="credit_note_entry_product_detail_rate<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_rate'])?>" /></td>
												<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_total[]" id="credit_note_entry_product_detail_total<?=$row_cnt?>"  value="<?=round($get_product_detail['credit_note_entry_product_detail_total'])?>" /></td>
												<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['credit_note_entry_product_detail_id']?>&credit_note_entry_uniq_id=<?php echo $credit_note_entry_edit['credit_note_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
			
											</tr>
											
											<?php $row_cnt++;} }?>

									</tbody>

								</table>

                                

								</div>

								<div class="col-lg-6">

								<input type="hidden"  name="credit_note_entry_id" id="credit_note_entry_id" value="<?=$credit_note_entry_edit['credit_note_entry_id']?>" />	

								<input type="hidden"  name="credit_note_entry_uniq_id" id="credit_note_entry_uniq_id" value="<?=$credit_note_entry_edit['credit_note_entry_uniq_id']?>" />	
									<button name="credit_note_entry_update" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>


								</div>

							</div>

						</div>

					</div>

				</div>

				

				</form>
			<script type="text/javascript">
			getTableHeader('<?=$credit_note_entry_edit['credit_note_entry_type_id']?>');
			</script>

				<?php

				} else{?>


    <form name="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Production Order Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="col-lg-6">
									<div class="form-group">
											<label>Branch</label>

											<select name="search_branch_id" id="search_branch_id" style="width:100%" class="form-control select2" >
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
									<button name="search" type="submit" class="btn btn-success"> Search </button>
								</div>
								<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>

							</div>

						</div>

					</div>

				</div>

				

				</form>
				
				<?php if(isset($_REQUEST['search'])){?>
    

				<div class="row">

                <div class="col-md-12">
                        
                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Credit Note Entry List

                        </div>

                        <div class="panel-body">
							
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">
							

								<form action="index.php" method="post" id="credit_note_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>INV.No.</th>

                                            <th>Date</th>

                                            <th>Request By</th>
											
											<!--th>Print</th>-->

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="credit_note_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

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

                                            <td><?=$get_quotation['credit_note_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['credit_note_entry_date'])?></td>

                                            <td><?=$arr_credit_type[$get_quotation['credit_note_entry_type']]?></td>

											<!--<td><a href="credit-note-print.php?id=<?php echo $get_quotation['credit_note_entry_uniq_id']?>" title="INVOICE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td> -->
                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['credit_note_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['credit_note_entry_uniq_id']; ?>" type="checkbox" />

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
			<?php } ?>

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
		$( "#credit_note_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
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

