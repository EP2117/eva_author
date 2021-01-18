<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>PRODUCTION RETURN DETAILS</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Return added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Return updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Return deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Return Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Production Return deleted successfully</div>';

		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/production-return/production-return-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/production-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Production Return</h1>

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

								  	Production Return Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="prn_entry_branch_id" id="prn_entry_branch_id" class="form-control select2" style="width:100%" required>

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

											<label >From Warehouse</label>

											<select name="prn_entry_from_godown_id" id="prn_entry_from_godown_id" class="form-control select2" >
												<?php

												foreach($godown_list as $get_godown){

												?>

														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label class="control-label">Production Section</label>

											<select name="prn_entry_production_section_id" id="prn_entry_production_section_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($production_section_list	as	$get_production_section){

												?>

											<option value="<?=$get_production_section['production_section_id']?>"><?=$get_production_section['production_section_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="prn_entry_date" id="prn_entry_date" required>

											</div>

										</div>

										<div class="form-group">

											<label>To Warehouse</label>

											<select name="prn_entry_to_godown_id" id="prn_entry_to_godown_id" class="form-control select2">
												<?php

												foreach($godown_Wlist as $get_godown){

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

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >

                                    <thead>

                                        <tr i>

                                            <th style=" width:30%;">Produc Entry No</th>

                                            <th style=" width:25%;">Date</th>

                                            <th style=" width:25%;">Type</th>

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

							Raw Product Details

							</div>

							<div class="panel-body">

								

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="raw_product_detail"  style="width:100%" >

                                    <thead style="display:none" class="rls">

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE</th>
											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>



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

                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>

                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY</th>

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

                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>
											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length</th>


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

							  Product Details

							</div>

							<div class="panel-body">

								

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style="width:100%" >

                                    <thead style="display:none" class="rls">

                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE</th>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length </th>
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

                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>

                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;"> QTY</th>

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

                                            <th rowspan="2" style="vertical-align:middle;"> PRD CODE </th>
											
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>

											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;"> Total Length</th>


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
									

                                    <tbody id="product_detail_display">

									

									</tbody>

								</table>

								</div>

								<div class="col-lg-6">

									<button name="prn_entry_insert" type="submit" class="btn btn-success">Save </button>

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

								  	Production Return Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="prn_entry_branch_id" id="prn_entry_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$prn_entry_edit['prn_entry_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<div class="form-group">

											<label>From Warehouse</label>

											<select name="prn_entry_from_godown_id" id="prn_entry_from_godown_id" class="form-control select2">
												<?php

												foreach($godown_list as $get_godown){

														$selected	= ($get_godown['godown_id']==$prn_entry_edit['prn_entry_from_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Production Section</label>

											<select name="prn_entry_production_section_id" id="prn_entry_production_section_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($production_section_list	as	$get_production_section){

														$selected	= ($get_production_section['production_section_id']==$prn_entry_edit['prn_entry_production_section_id'])?'selected="selected"':'';

												?>

											<option value="<?=$get_production_section['production_section_id']?>" <?=$selected?>><?=$get_production_section['production_section_name']?></option>

												<?php

													}

												?>

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

											  <input type="text" class="form-control" name="prn_entry_date" id="prn_entry_date" value="<?=dateGeneralFormatN($prn_entry_edit['prn_entry_date'])?>">

											</div>

										</div>

										<div class="form-group">

											<label>To Warehouse</label>

											<select name="prn_entry_to_godown_id" id="prn_entry_to_godown_id" class="form-control select2">

												<?php

												foreach($godown_Wlist as $get_godown){

														$selected	= ($get_godown['godown_id']==$prn_entry_edit['prn_entry_to_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

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

                                            <th style=" width:30%;">Produc Entry No</th>

                                            <th  style=" width:25%;">	Date</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr>

										<td><?=$sales_detail_edit['production_entry_no']?></td>

										<td><?=dateGeneralFormatN($sales_detail_edit['production_entry_date'])?>

										<input type="hidden"  name="prn_entry_invoice_entry_id" id="prn_entry_invoice_entry_id" value="<?=$prn_entry_edit['prn_entry_invoice_entry_id']?>"  class="dc_id"  /></td>

										

										</tr>

									</tbody>

								</table>

								</div>

							</div>

						</div>

					</div>

				</div>

				<!-- Stock Out Detail-->

				<div class="row">

					<div class="col-md-12">

						<!-- Advanced Tables -->

						<div class="panel panel-info">

							<div class="panel-heading">

							Raw Product Details

							</div>

							<div class="panel-body">

								

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="raw_product_detail"  style=" width:100%" >

                                    <thead>

                                        <tr>

                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE </th>

                                            <th rowspan="2" style="vertical-align:middle;">NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;">UOM</th>

                                            <th rowspan="2" style="vertical-align:middle;">COLOR</th>

                                            <th rowspan="2" style="vertical-align:middle;">THICK</th>

											<th colspan="4">WIDTH</th>

											<th colspan="4">LENGTH</th>

											<th colspan="2">EXTRA LENGTH</th>

											<th rowspan="2" style="vertical-align:middle;">QTY</th>

                                        </tr>

										<tr>

											<th >FEET</th>

											<th >INCHES</th>

											<th >MM</th>

											<th >M</th>

											<th >FEET</th>

											<th >INCHES</th>

											<th >MM</th>

											<th >M</th>

											<th >FEET</th>

											<th >MM</th>

										</tr>

                                    </thead>

                                    <tbody id="raw_product_detail_display">

										<?php

											$row_cnt	= 1;
										$arr_cnt =count($prn_entry_raw_prd_edit);
										foreach($prn_entry_raw_prd_edit as $get_product_detail){

										?>

										<tr>

											<td>

											<?=$get_product_detail['product_code']?>

											</td>

											<td>

											<?=$get_product_detail['product_name']?>

											<input type="hidden"  name="prn_entry_raw_product_detail_raw_product_id[]" id="prn_entry_raw_product_detail_raw_product_id" value="<?=$get_product_detail['production_entry_raw_product_detail_raw_product_id']?>" />

											<input type="hidden"  name="prn_entry_raw_product_detail_id[]" id="prn_entry_raw_product_detail_id" value="<?=$get_product_detail['production_entry_raw_product_detail_id']?>" />

											<input type="hidden"  name="prn_entry_raw_product_detail_product_id[]" id="prn_entry_raw_product_detail_product_id" value="<?=$get_product_detail['production_entry_raw_product_detail_product_id']?>"   class="sd_id" />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_uom[]" id="product_uom<?=$row_cnt?>" value="<?=$get_product_detail['product_uom_name']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_colour[]" id="product_colour<?=$row_cnt?>" value="<?=$get_product_detail['product_colour_name']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_thick_ness[]" id="product_thick_ness<?=$row_cnt?>" value="<?=$get_product_detail['product_thick_ness']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_width_feet[]" id="prn_entry_raw_product_detail_width_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_width_feet']?>"  onblur="Getcalc(1,<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_width_inches[]" id="prn_entry_raw_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_width_inches']?>"  onblur="Getcalc(2,<?=$row_cnt?>)"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_width_mm[]" id="prn_entry_raw_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_width_mm']?>"  onblur="Getcalc(3,<?=$row_cnt?>)"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_width_meter[]" id="prn_entry_raw_product_detail_width_meter<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_width_meter']?>" onBlur="Getcalc(4,<?=$row_cnt?>)"     />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_length_feet[]" id="prn_entry_raw_product_detail_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_length_feet']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_length_inches[]" id="prn_entry_raw_product_detail_length_inches<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_length_inches']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_length_mm[]" id="prn_entry_raw_product_detail_length_mm<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_length_mm']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_length_meter[]" id="prn_entry_raw_product_detail_length_meter<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_length_meter']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_ext_length_feet[]" id="prn_entry_raw_product_detail_ext_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_ext_length_feet']?>"   />

									

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_ext_length_meter[]" id="prn_entry_raw_product_detail_ext_length_meter<?=$row_cnt?>" value="<?=$get_product_detail['production_entry_raw_product_detail_ext_length_meter']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_raw_product_detail_qty[]" id="prn_entry_raw_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['production_entry_raw_product_detail_qty']?>" />

											</td>
											<td><?php if($arr_cnt>1) { ?><a href="index.php?prn_entry_product_detail_id=<?=$get_product_detail['production_entry_raw_product_detail_id']?>&prn_entry_uniq_id=<?php echo $prn_entry_edit['prn_entry_uniq_id']?>&product_detail_deletes=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?> </td>
										

									</tr>

										<?php

										$row_cnt = $row_cnt+1;

										}

								  

								?>

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

								

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >

                                    <thead>

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle;">PRD CODE </th>

                                            <th rowspan="2" style="vertical-align:middle;">NAME</th>

                                            <th rowspan="2" style="vertical-align:middle;">UOM</th>

                                            <th rowspan="2" style="vertical-align:middle;">COLOR</th>

                                            <th rowspan="2" style="vertical-align:middle;">THICK</th>

											<th colspan="4">WIDTH</th>

											<th colspan="4">LENGTH</th>

											<th colspan="2">EXTRA LENGTH</th>

											<th rowspan="2" style="vertical-align:middle;">QTY</th>

                                        </tr>

										<tr>

											<th >FEET</th>

											<th >INCHES</th>

											<th >MM</th>

											<th >M</th>

											<th >FEET</th>

											<th >INCHES</th>

											<th >MM</th>

											<th >M</th>

											<th >FEET</th>

											<th >MM</th>

										</tr>

                                    </thead>

                                    <tbody id="product_detail_display">

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($prn_entry_prd_edit);

										foreach($prn_entry_prd_edit as $get_product_detail){
										
											
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_nam'];
												$product_thick_ness		= $get_product_detail['product_thick_ness'];
											

										?>

										<tr>

											<td>

											<?=$product_code?>

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="prn_entry_product_detail_product_id[]" id="prn_entry_product_detail_product_id" value="<?=$get_product_detail['prn_entry_product_detail_product_id']?>" />
											<input type="hidden"  name="prn_entry_product_detail_type[]" id="prn_entry_product_detail_type" value="<?=$get_product_detail['prn_entry_product_detail_type']?>" />
											<input type="hidden"  name="prn_entry_product_detail_id[]" id="prn_entry_product_detail_id" value="<?=$get_product_detail['prn_entry_product_detail_id']?>" />

											<input type="hidden"  name="prn_entry_product_detail_invoice_detail_id[]" id="prn_entry_product_detail_invoice_detail_id" value="<?=$get_product_detail['prn_entry_product_detail_invoice_detail_id']?>"   class="sd_id" />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_uom[]" id="product_uom<?=$row_cnt?>" value="<?=$product_uom_name?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_colour[]" id="product_colour<?=$row_cnt?>" value="<?=$product_colour_name?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="product_thick_ness[]" id="product_thick_ness<?=$row_cnt?>" value="<?=$get_product_detail['product_thick_ness']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_width_feet[]" id="prn_entry_product_detail_width_feet<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_width_feet']?>"  onblur="Getcalc(1,<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_width_inches[]" id="prn_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_width_inches']?>"  onblur="Getcalc(2,<?=$row_cnt?>)"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_width_mm[]" id="prn_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_width_mm']?>"  onblur="Getcalc(3,<?=$row_cnt?>)"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_width_meter[]" id="prn_entry_product_detail_width_meter<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_width_meter']?>" onBlur="Getcalc(4,<?=$row_cnt?>)"     />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_length_feet[]" id="prn_entry_product_detail_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_length_feet']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_length_inches[]" id="prn_entry_product_detail_length_inches<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_length_inches']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_length_mm[]" id="prn_entry_product_detail_length_mm<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_length_mm']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_length_meter[]" id="prn_entry_product_detail_length_meter<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_length_meter']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_ext_length_feet[]" id="prn_entry_product_detail_ext_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_ext_length_feet']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_ext_length_meter[]" id="prn_entry_product_detail_ext_length_meter<?=$row_cnt?>" value="<?=$get_product_detail['prn_entry_product_detail_ext_length_meter']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="prn_entry_product_detail_qty[]" id="prn_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['prn_entry_product_detail_qty']?>" />

											</td>

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['prn_entry_product_detail_id']?>&prn_entry_uniq_id=<?php echo $prn_entry_edit['prn_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>

								</table>

								</div>

								<div class="col-lg-6">

										<input type="hidden"  name="prn_entry_id" id="prn_entry_id" value="<?=$prn_entry_edit['prn_entry_id']?>" />	

										<input type="hidden"  name="prn_entry_uniq_id" id="prn_entry_uniq_id" value="<?=$prn_entry_edit['prn_entry_uniq_id']?>" />	

									<button name="prn_entry_update" type="submit" class="btn btn-success">Update </button>

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

                           Production Return List

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
							<div class="col-lg-12">
								<button name="search" type="submit" class="btn btn-success">Search </button>
								<button type="reset" class="btn btn-danger">Reset </button>
							</div>
							</form>
&nbsp;					
						<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">
							<?php if(isset($_REQUEST['search'])){?>

								<form action="index.php" method="post" id="prn_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>INV.No.</th>

                                            <th>Date</th>

                                            <th>Godown</th>

                                            <th>Production Section</th>

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="prn_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

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

                                            <td><?=$get_quotation['prn_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['prn_entry_date'])?></td>

                                            <td><?=$get_quotation['godown_name']?></td>

											<td><?=$get_quotation['production_section_name']?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['prn_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['prn_entry_uniq_id']; ?>" type="checkbox" />

											</td>

                                        </tr>

									<?php } ?>

                                    </tbody>

                                </table>

								</form>
								<?php }?>

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

		

		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Production Return Detail</h4>

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

        <?=PROJECT_FOOTER?>

    </div>

    <!-- /. FOOTER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

    <!-- JQUERY SCRIPTS -->

  



			<script>

				$(document).ready(function () {

					$('#dataTables-example').DataTable( {

						responsive: true

					} );

					/*$('#dataTables-example').dataTable();*/

				});

		//Initialize Select2 Elements

			$(".select2").select2();

			//$('.datatable').DataTable()

	//Date picker

   /* $('#prn_entry_date').datepicker({

      autoclose: true

    });*/

	

	$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#prn_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
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

