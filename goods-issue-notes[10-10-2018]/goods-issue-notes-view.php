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

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Goods Issue Notes added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Goods Issue Notes updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Goods Issue Notes deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Goods Issue Notes Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Goods Issue Notes deleted successfully</div>';

		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/goods-issue-notes/goods-issue-notes-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/production-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">
					 <div class="col-md-12">
                        <h1 class="page-head-line">Goods Issue Notes</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn btn-success" onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>
                    
                </div>

				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>

				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Goods Issue Notes Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="gin_entry_branch_id" id="gin_entry_branch_id" class="form-control select2" style="width:100%" required>

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

											<select name="gin_entry_production_section_id" id="gin_entry_production_section_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($prd_sec_list	as	$get_prd_sec){

												?>

														<option value="<?=$get_prd_sec['production_section_id']?>"><?=$get_prd_sec['production_section_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>From Warehouse</label>

											<select name="gin_entry_from_godown_id" id="gin_entry_from_godown_id" class="form-control select2">
												  <option value=""> - Select - </option>
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

											<label class="control-label">Type</label>

											<select name="gin_entry_type_id" id="gin_entry_type_id" class="form-control select2" style="width:100%" required onChange="getTableHeader(this.value)">
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
										

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control" name="gin_entry_date" id="gin_entry_date" value="<?=date('d/m/Y')?>" required >

											</div>

										</div>

										<div class="form-group">

											<label>Type</label>

											<select name="gin_entry_type" id="gin_entry_type" class="form-control select2" style="width:100%" >

												  <option value="1">Sales Production </option>

												  <option value="2">Normal Production </option>

												

											</select>

										</div>

										<div class="form-group">

											<label>To Warehouse</label>

											<select name="gin_entry_to_godown_id" id="gin_entry_to_godown_id" class="form-control select2" >
												  <option value=""> - Select - </option>
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

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >

                                    <thead>

                                        <tr i>

                                            <th style=" width:30%;">Production No</th>

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
                                <table class="table table-striped table-bordered table-hover" id="product_detail"   >

                                    <thead style="display:none" class="rls">

                                         <tr>

                                            <th rowspan="2" style="vertical-align:middle; width:10%">PRD CODE</th>
											
											<th rowspan="2" style="vertical-align:middle; width:10%"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle; width:10%"> NAME</th>

                                            <th rowspan="2" style="vertical-align:middle; width:10%"> COLOR</th>
											
											<th rowspan="2" style="vertical-align:middle; width:10%"> THICK</th>

											<th colspan="2" > WIDTH</th>
											<th colspan="2"  > SALES WIDTH</th>
											<th colspan="4" > SALES LENGTH</th>
											<th colspan="4"  > Extra LENGTH</th>
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
                                            <th rowspan="2" style="vertical-align:middle; width:5%"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle; width:5%"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle; width:5%"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle; width:5%"> THICK</th>
											<th colspan="2" style=" width:20%"> WIDTH</th>
											<th colspan="2"  style="width:20%"> SALES WIDTH</th>
											<th colspan="2" style=" width:20%"> SALES WEIGHT</th>
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
									
									<thead style="display:none" class="as">

                                         <tr>

                                            <th style="vertical-align:middle;"> PRD CODE </th>

                                            <th style="vertical-align:middle;">NAME</th>

                                            <th style="vertical-align:middle;">UOM</th>

											<th style="vertical-align:middle;">QTY</th>

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

                                <table class="table table-striped table-bordered table-hover" id="raw_product_detail"  style="width:190%" >

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
											<th>METER</th>
											<th>TONE</th>
											<th>KG</th>
										</tr>

                                    </thead>
									
									

                                    <tbody id="raw_product_detail_display">

									

									</tbody>

								</table>

								</div>

								

								<div class="col-lg-6">

									<button name="gin_entry_insert" type="submit" class="btn btn-success">Save </button>

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

								  	Goods Issue Notes Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="gin_entry_branch_id" id="gin_entry_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$gin_entry_edit['gin_entry_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>Production Section</label>

											<select name="gin_entry_production_section_id" id="gin_entry_production_section_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($prd_sec_list	as	$get_prd_sec){

														$selected	= ($get_prd_sec['production_section_id']==$gin_entry_edit['gin_entry_production_section_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_prd_sec['production_section_id']?>" <?=$selected?>><?=$get_prd_sec['production_section_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										<div class="form-group">

											<label>From Warehouse</label>

											<select name="gin_entry_from_godown_id" id="gin_entry_from_godown_id" class="form-control select2" onChange="GetcustomerDetail()">

												<option value=""> - Select - </option>

												<?php

												foreach($godown_list as $get_godown){

														$selected	= ($get_godown['godown_id']==$gin_entry_edit['gin_entry_from_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

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

											  <input type="text" class="form-control" name="gin_entry_date" id="gin_entry_date" value="<?=dateGeneralFormatN($gin_entry_edit['gin_entry_date'])?>">

											</div>

										</div>

										<div class="form-group">

											<label>Type</label>

											<select name="gin_entry_type" id="gin_entry_type" class="form-control select2" style="width:100%" >

												  <option value="1" <?php if($gin_entry_edit['gin_entry_type']==1){ ?> selected="selected" <?php } ?>>Sales Production </option>

												  <option value="2" <?php if($gin_entry_edit['gin_entry_type']==2){ ?> selected="selected" <?php } ?>>Normal Production </option>

												

											</select>

										</div>

										<div class="form-group">

											<label>To Warehouse</label>

											<select name="gin_entry_to_godown_id" id="gin_entry_to_godown_id" class="form-control select2" onChange="GetcustomerDetail()">

												<option value=""> - Select - </option>

												<?php

												foreach($godown_Wlist as $get_godown){

														$selected	= ($get_godown['godown_id']==$gin_entry_edit['gin_entry_to_godown_id'])?'selected="selected"':'';

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

                                            <th style=" width:30%;">Inv No</th>

                                            <th  style=" width:25%;">Inv Date</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr>

										<td><?=$sales_detail_edit['production_order_no']?></td>

										<td><?=dateGeneralFormatN($sales_detail_edit['production_order_date'])?>

										<input type="hidden"  name="gin_entry_invoice_entry_id" id="gin_entry_invoice_entry_id" value="<?=$gin_entry_edit['gin_entry_invoice_entry_id']?>"  class="dc_id"  /></td>

										

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
								<div style="width:100%; overflow:scroll;">
                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:200%; overflow:scroll;" >

										<?php if($gin_entry_edit['gin_entry_type_id']==1){ ?>
										<tr>
										
										<th rowspan="2" style="vertical-align:middle;">PRD CODE</th>
										
										<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
										
										<th rowspan="2" style="vertical-align:middle;"> NAME</th>
										
										<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
										
										<th rowspan="2" style="vertical-align:middle;"> THICK</th>
										
										<th colspan="2"> WIDTH</th>
										<th colspan="2"> SALES WIDTH</th>
										<th colspan="4"> SALES LENGTH</th>
										<th colspan="4"> Extra LENGTH</th>
										<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th rowspan="2" style="vertical-align:middle;"  nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Length &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
										<th rowspan="2"></th>
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
                                    <?php }elseif($gin_entry_edit['gin_entry_type_id']==2){ ?>
                                        <tr>
                                            <th rowspan="2" style="vertical-align:middle; width:5%"> BRAND</th>

                                            <th rowspan="2" style="vertical-align:middle; width:5%"> NAME</th>
											
											<th rowspan="2" style="vertical-align:middle; width:5%"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle; width:5%"> THICK</th>
											<th colspan="2" style=" width:20%"> WIDTH</th>
											<th colspan="2"  style="width:20%"> SALES WIDTH</th>
											<th colspan="2" style=" width:20%"> SALES WEIGHT</th>
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

 										<?php }else{ ?>
										<tr>
										
										<th style="vertical-align:middle;"> PRD CODE </th>
										<th style="vertical-align:middle;"> BRAND </th>
										
										<th style="vertical-align:middle;">NAME</th>
										
										<th style="vertical-align:middle;">UOM</th>
										
										<th style="vertical-align:middle;">QTY</th>
										
										</tr>
										<?php }?>
									<tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($gin_entry_prd_edit);
										
										foreach($gin_entry_prd_edit as $get_product_detail){
											if($gin_entry_edit['gin_entry_type_id']==1){
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
										
										
											if($gin_entry_edit['gin_entry_type_id']==1){ 
											?>
					
										<tr class="rls" style="display:none">

											<td>

											<?=$product_code?>
											<input type="hidden"  name="gin_entry_product_detail_product_type[]" id="gin_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_type']?>" />

											</td>
											
											<td>

											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="gin_entry_product_detail_product_brand_id[]" id="gin_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="gin_entry_product_detail_product_id[]" id="gin_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="gin_entry_product_detail_id[]" id="gin_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											<input class="form-control" type="hidden"  name="gin_entry_product_detail_product_color_id[]" id="gin_entry_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_color_id']?>">
											</td>

											<td>
												<?=$arr_thick[number_format($get_product_detail['gin_entry_product_detail_product_thick'])]?>
											<input class="form-control" type="hidden"  name="gin_entry_product_detail_product_thick[]" id="gin_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_thick']?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_width_inches[]" id="gin_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_width_mm[]" id="gin_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_s_width_inches[]" id="gin_entry_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_s_width_inches']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />


											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_s_width_mm[]" id="gin_entry_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_s_width_mm']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_sl_feet[]" id="gin_entry_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_sl_feet']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_sl_feet_in[]" id="gin_entry_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_sl_feet_in']?>" onKeyUp="GetLcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_sl_feet_mm[]" id="gin_entry_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_sl_feet_mm']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_sl_feet_met[]" id="gin_entry_product_detail_sl_feet_met<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_sl_feet_met']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_ext_feet[]" id="gin_entry_product_detail_ext_feet<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_ext_feet']?>"  onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_ext_feet_in[]" id="gin_entry_product_detail_ext_feet_in<?=$row_cnt?>" onBlur="GetLcalFeet(2,<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>)"  value="<?= $get_product_detail['gin_entry_product_detail_ext_feet_in']?>"  /> 

											</td>
											
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_ext_feet_mm[]" id="gin_entry_product_detail_ext_feet_mm<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gin_entry_product_detail_ext_feet_mm']?>"  />  

											</td>
											
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_ext_feet_met[]" id="gin_entry_product_detail_ext_feet_met<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gin_entry_product_detail_ext_feet_met']?>"  /> 
											</td>
											

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_qty[]" id="gin_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['gin_entry_product_detail_qty']?>" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_tot_length[]" id="gin_entry_product_detail_tot_length<?=$row_cnt?>"  value="<?=$get_product_detail['gin_entry_product_detail_tot_length']?>" readonly="" />

											</td>
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['gin_entry_product_detail_id']?>&gin_entry_uniq_id=<?php echo $gin_entry_edit['gin_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($gin_entry_edit['gin_entry_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">

											
											<td>
											<input type="hidden"  name="gin_entry_product_detail_product_type[]" id="gin_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_type']?>" />
											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="gin_entry_product_detail_product_brand_id[]" id="gin_entry_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="gin_entry_product_detail_product_id[]" id="gin_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="gin_entry_product_detail_id[]" id="gin_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_product_thick[]" id="gin_entry_product_detail_product_thick<?=$row_cnt?>" value="<?=$arr_thick[$get_product_detail['gin_entry_product_detail_product_thick']]?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_width_inches[]" id="gin_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_width_mm[]" id="gin_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_s_width_inches[]" id="gin_entry_product_detail_s_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_s_width_inches']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_s_width_mm[]" id="gin_entry_product_detail_s_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_s_width_mm']?>" onKeyUp="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											
											<td>
											<input class="form-control" type="text"  name="gin_entry_product_detail_s_weight_inches[]" id="gin_entry_product_detail_s_weight_inches<?=$row_cnt?>" onblur="GetLcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  value="<?=$get_product_detail['gin_entry_product_detail_s_weight_inches']?>"  /> 
 
											</td>
											
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_s_weight_mm[]" id="gin_entry_product_detail_s_weight_mm<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gin_entry_product_detail_s_weight_mm']?>"  />

											</td>
											
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_tot_feet[]" id="gin_entry_product_detail_tot_feet<?=$row_cnt?>" onblur="GetLcalFeet(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gin_entry_product_detail_tot_feet']?>"  />
											</td>
											
											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_tot_meter[]" id="gin_entry_product_detail_tot_meter<?=$row_cnt?>"  value="<?=$get_product_detail['gin_entry_product_detail_tot_meter']?>" />

											</td>
											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['gin_entry_product_detail_id']?>&gin_entry_uniq_id=<?php echo $gin_entry_edit['gin_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }else{ ?>
										
										<tr >

											<td>

											<?=$product_code?>
											

											</td>
											
											<td>
											<input type="hidden"  name="gin_entry_product_detail_product_type[]" id="gin_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_type']?>" />
											<?=$get_product_detail['brand_name']?>

											</td>
											<td>

											<?=$product_name?>

											<input type="hidden"  name="gin_entry_product_detail_product_id[]" id="gin_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_id']?>"  />
											<input type="hidden"  name="gin_entry_product_detail_id[]" id="gin_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_id']?>" />

											</td>
											<td>
											<?=$product_uom_name?>
											
											<input class="form-control" type="hidden"  name="gin_entry_product_detail_product_uom_id[]" id="gin_entry_product_detail_product_uom_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_product_uom_id']?>" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_product_detail_qty[]" id="gin_entry_product_detail_qty<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_product_detail_qty']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />
											<?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['gin_entry_product_detail_id']?>&gin_entry_uniq_id=<?php echo $gin_entry_edit['gin_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?>
											</td>

											

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

										
										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($gin_entry_raw_prd_edit);
										
										foreach($gin_entry_raw_prd_edit as $get_product_detail){
												$product_code		= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name		= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $get_product_detail['product_uom_name'];
												$product_colour_name	= $get_product_detail['product_colour_name'];
										
										
										 
											?>
					
										<tr >

											
											
											<td>
<input type="hidden"  name="gin_entry_raw_product_detail_product_type[]" id="gin_entry_raw_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['	gin_entry_raw_product_detail_product_type']?>" />
											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="gin_entry_raw_product_detail_product_osf_uom_ton[]" id="gin_entry_raw_product_detail_product_osf_uom_ton<?=$row_cnt?>" value="<?=$get_product_detail['product_con_entry_osf_uom_ton']?>" />

											</td>
											<td><?=$product_code?></td>
											<td>

											<?=$product_name?>

											<input type="hidden"  name="gin_entry_raw_product_detail_product_id[]" id="gin_entry_raw_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_raw_product_detail_product_id']?>"  />
											<input type="hidden"  name="gin_entry_raw_product_detail_id[]" id="gin_entry_raw_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_raw_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_raw_product_detail_product_thick[]" id="gin_entry_raw_product_detail_product_thick<?=$row_cnt?>" value="<?=$arr_thick[number_format($get_product_detail['gin_entry_raw_product_detail_product_thick'])]?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_raw_product_detail_width_inches[]" id="gin_entry_raw_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_raw_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="gin_entry_raw_product_detail_width_mm[]" id="gin_entry_raw_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_raw_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_raw_product_detail_sl_feet[]" id="gin_entry_raw_product_detail_sl_feet<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_raw_product_detail_sl_feet']?>" onKeyUp="GetRLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetRTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_raw_product_detail_sl_feet_mm[]" id="gin_entry_raw_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_raw_product_detail_sl_feet_mm']?>" onKeyUp="GetRLcalFeet(2,<?=$row_cnt?>)" onBlur="GetRTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="gin_entry_raw_product_detail_ton[]" id="gin_entry_raw_product_detail_ton<?=$row_cnt?>" value="<?=$get_product_detail['gin_entry_raw_product_detail_ton']?>" onKeyUp="GetRLcalFeet(3,<?=$row_cnt?>)" onBlur="GetRTotalLength(<?=$row_cnt?>)" />

											</td>
											
											

											<td><input class="form-control" type="text"  name="gin_entry_raw_product_detail_kg[]" id="gin_entry_raw_product_detail_kg<?=$row_cnt?>" onblur="GetRLcalFeet(3,<?=$row_cnt?>)" onBlur="GetRTotalLength(<?=$row_cnt?>)" value="<?=$get_product_detail['gin_entry_raw_product_detail_kg']?>"  /> 

											</td>
											
											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['gin_entry_raw_product_detail_id']?>&gin_entry_uniq_id=<?php echo $gin_entry_edit['gin_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php

											$row_cnt	= $row_cnt+1;	

										 } ?>									



									</tbody>

								</table>

								</div>

								

								<div class="col-lg-6">
										<input type="hidden"  name="gin_entry_id" id="gin_entry_id" value="<?=$gin_entry_edit['gin_entry_id']?>" />	
										<input type="hidden"  name="gin_entry_uniq_id" id="gin_entry_uniq_id" value="<?=$gin_entry_edit['gin_entry_uniq_id']?>" />	
									<button name="gin_entry_update" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>

							</div>

						</div>

					</div>

				</div>

				</form>
			<script type="text/javascript">
			getTableHeader(<?=$gin_entry_edit['gin_entry_type_id']?>);
			</script>
				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Goods Issue Notes List

                        </div>
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
                        <div class="panel-body">

                            <div class="table-responsive">

								<form action="index.php" method="post" id="gin_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>Gin No</th>

                                            <th>Date</th>

                                            <th>Request By</th>

                                            <th>Production Section</th>
											<th>Print</th>
                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="gin_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

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

                                            <td><?=$get_quotation['gin_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['gin_entry_date'])?></td>

                                            <td><?=$arr_producton_type[$get_quotation['gin_entry_type']]?></td>

											<td><?=$get_quotation['production_section_name']?></td>
											<td><a href="goods-issue-print.php?id=<?php echo $get_quotation['gin_entry_uniq_id']?>" title="INVOICE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['gin_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['gin_entry_uniq_id']; ?>" type="checkbox" />

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

		

		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Goods Issue Notes Detail</h4>

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

 

			<script>
			/*$('#gin_entry_date').datepicker({
				format: 'dd/mm/yyyy',
			
			});*/
			$( "#gin_entry_date" ).datepicker({
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

