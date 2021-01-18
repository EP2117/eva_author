<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>STOCK TRANSFER</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Transfer added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Transfer updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Transfer deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Transfer Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Transfer deleted successfully</div>';
		}  
	}
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/stock-transfer/stock-transfer-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
					 <div class="col-md-12">
                        <h1 class="page-head-line">Stock Transfer</h1>
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
				<form name="customer_form" id="customer_form" method="post" data-toggle="validator" >
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Stock Transfer Details
								</div>
								<div class="panel-body">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="stock_transfer_branch_id" id="stock_transfer_branch_id" class="form-control select2" style="width:100%" required>
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

											<label>From Warehouse</label>

											<select name="stock_transfer_from_godown_id" id="stock_transfer_from_godown_id" class="form-control select2">
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

											<label>Type</label>

											<select name="stock_transfer_type" id="stock_transfer_type" class="form-control select2" style="width:100%" onChange="GetProddisplay()" >

												  <option value="1">With Production </option>

												  <option value="2">Without Production </option>

												

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

											  <input type="text" class="form-control" name="stock_transfer_date" id="stock_transfer_date" required value="<?=date('d/m/Y')?>">

											</div>

										</div>

										

										<div class="form-group">

											<label>To Warehouse</label>

											<select name="stock_transfer_to_godown_id" id="stock_transfer_to_godown_id" class="form-control select2" >
												<?php

												foreach($godown_Wlist as $get_godown){

												?>

														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										
										<div class="form-group c_type_id" style="display:none">

											<label class="control-label">Product Type</label>

											<select name="stock_transfer_type_id" id="stock_transfer_type_id" class="form-control select2" style="width:100%" required onChange="getTableHeader(this.value)">
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

								</div>

						</div>

						

					</div>

        		</div>

				

				<div class="row prduc_detail" >

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

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style="width:190%" >
									<thead class="rls"  style="display:none">
                                         <tr>
											<th rowspan="2" style="vertical-align:middle; %"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle; "> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOUR </th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"  > WIDTH</th>
											<th colspan="2"  > LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;">Tot Len</th>
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>MET</th>
										</tr>
                                    </thead>
									<thead style="display:none" class="rws">
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;w"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"  > WIDTH</th>
											<th colspan="2" >WEIGHT</th>
											<th rowspan="2" > Qty</th>

                                        </tr>
										<tr>
											<th>INCHES </th>
											<th>MM</th>
											<th>TON</th>
											<th>KG</th>
										</tr>
                                    </thead>
									<thead style="display:none" class="as">

                                         <tr>

                                            <th style="vertical-align:middle; width:30%">CODE</th>
                                            <th style="vertical-align:middle; width:30%">NAME</th>

                                            <th style="vertical-align:middle; width:30%">UOM</th>

											<th style="vertical-align:middle; width:40%">QTY</th>


                                        </tr>

                                    </thead>
                                    <tbody id="product_detail_display">
									</tbody>
								</table>

								</div>
								<div class="col-lg-6">

									<button name="stock_transfer_insert" type="submit" class="btn btn-success">Save </button>

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

								  	Stock Transfer Details

								</div>
                                
                                
                                <div class="panel-body">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="stock_transfer_branch_id" id="stock_transfer_branch_id" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
														$selected	= ($get_branch['branch_id']==$stock_transfer_edit['stock_transfer_branch_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										
										<div class="form-group">

											<label>From Warehouse</label>

											<select name="stock_transfer_from_godown_id" id="stock_transfer_from_godown_id" class="form-control select2">
												<?php

												foreach($godown_list as $get_godown){
													$selected	= ($get_godown['godown_id']==$stock_transfer_edit['stock_transfer_from_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

												
										<div class="form-group">

											<label>Type</label>

											<select name="stock_transfer_type" id="stock_transfer_type" class="form-control select2" style="width:100%" onChange="GetProddisplay()" >

												  <option value="1" <?php if($stock_transfer_edit['stock_transfer_type']==1){?> selected <?php }?>>With Production </option>

												  <option value="2" <?php if($stock_transfer_edit['stock_transfer_type']==2){?> selected <?php }?>>Without Production </option>

												

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

											  <input type="text" class="form-control" name="stock_transfer_date" id="stock_transfer_date" required value="<?=dateGeneralFormatN($stock_transfer_edit['stock_transfer_date'])?>">

											</div>

										</div>

										

										<div class="form-group">

											<label>To Warehouse</label>

											<select name="stock_transfer_to_godown_id" id="stock_transfer_to_godown_id" class="form-control select2" >
												<?php

												foreach($godown_Wlist as $get_godown){
														$selected	= ($get_godown['godown_id']==$stock_transfer_edit['stock_transfer_to_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										
										<div class="form-group c_type_id" style="($stock_transfer_edit['stock_transfer_type']!=2)?display:none:''">

											<label class="control-label">Product Type</label>

											<select name="stock_transfer_type_id" id="stock_transfer_type_id" class="form-control select2" style="width:100%" required onChange="getTableHeader(this.value)">
												  <option value=""> - Select - </option>
												<?php
													foreach($arrQuotationType as $key => $value){
														$selected	= ($key==$stock_transfer_edit['stock_transfer_type_id'])?'selected="selected"':'';
												?>
														<option value="<?=$key?>" <?=$selected?>><?=$value?></option>
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

										<input type="hidden"  name="stock_transfer_type_id" id="stock_transfer_type_id" value="<?=$stock_transfer_edit['stock_transfer_type_id']?>"  />
										<input type="hidden"  name="stock_transfer_production_order_id" id="stock_transfer_production_order_id" value="<?=$stock_transfer_edit['stock_transfer_production_order_id']?>"  />
                                     
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

							  Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:190%" >

                                   <!--<thead class="rls"  style="display:none">-->
								   <?php if($stock_transfer_edit['stock_transfer_type_id']==1){ ?>
                                         <tr>
											<th rowspan="2" style="vertical-align:middle; %"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle; "> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOUR </th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"  > WIDTH</th>
											<th colspan="2"  > LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
											<th rowspan="2" style="vertical-align:middle;">Tot Len</th>
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>MET</th>
										</tr>
                                   <!-- </thead>
									<thead style="display:none" class="rws">-->
									<?php }elseif($stock_transfer_edit['stock_transfer_type_id']==2){ ?>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;w"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"  > WIDTH</th>
											<th colspan="2" >WEIGHT</th>
											<th rowspan="2" > Qty</th>

                                        </tr>
										<tr>
											<th>INCHES </th>
											<th>MM</th>
											<th>TON</th>
											<th>KG</th>
										</tr>
                                    <!--</thead>
									<thead style="display:none" class="as">-->
									
									<?php }else{?>

                                         <tr>
											<th style="vertical-align:middle; ">PRODUCT CODE</th>
											
										<!--	<th style="vertical-align:middle; ">BRAND</th>-->

                                            <th style="vertical-align:middle; ">PRODUCT NAME</th>

                                            <th style="vertical-align:middle;">UOM</th>

											<th style="vertical-align:middle; ">QTY</th>


                                        </tr>
										
										<?php }?>

                                    <!--</thead>-->


                                    
									<tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($stock_transfer_prd_edit);
										
										foreach($stock_transfer_prd_edit as $get_product_detail){
											if($get_product_detail['stock_transfer_product_detail_product_type']==1){
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
										
										
											if($stock_transfer_edit['stock_transfer_type_id']==1){ 
											?>
					
										<tr class="rls" style="display:none">

											<!--<td>

											<?=$product_code?>
                                            
											

											</td>-->
											
											<td>
                                            
                                            <input type="hidden"  name="stock_transfer_product_detail_mother_chile_type[]" id="stock_transfer_product_detail_mother_chile_type" value="<?=$get_product_detail['stock_transfer_product_detail_mother_chile_type']?>" />
<input type="hidden"  name="stock_transfer_product_detail_product_type[]" id="stock_transfer_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_type']?>" />
											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="stock_transfer_product_detail_product_brand_id[]" id="stock_transfer_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="stock_transfer_product_detail_product_id[]" id="stock_transfer_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_id']?>"  />
											<input type="hidden"  name="stock_transfer_product_detail_id[]" id="stock_transfer_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_colour_name?>
                                            <input type="hidden"  name="stock_transfer_product_detail_product_color_id[]" id="stock_transfer_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_color_id']?>" />
											</td>

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_product_thick[]" id="stock_transfer_product_detail_product_thick<?=$row_cnt?>" value="<?=$arr_thick[$get_product_detail['stock_transfer_product_detail_product_thick']]?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_width_inches[]" id="stock_transfer_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_width_mm[]" id="stock_transfer_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_length_feet[]" id="stock_transfer_product_detail_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_length_feet']?>" onKeyUp="GetWcalS(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />
											</td>

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_length_meter[]" id="stock_transfer_product_detail_length_meter<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_length_meter']?>" onKeyUp="GetWcalS(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_qty[]" id="stock_transfer_product_detail_qty<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_qty']?>" onKeyUp="GetLcalFeet(1,<?=$row_cnt?>)"  onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_tot_length[]" id="stock_transfer_product_detail_tot_length<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_tot_length']?>" onKeyUp="GetLcalFeet(2,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>)" />

											</td>
											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['stock_transfer_product_detail_id']?>&stock_transfer_uniq_id=<?php echo $stock_transfer_edit['stock_transfer_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }elseif($stock_transfer_edit['stock_transfer_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">

											<td>
                                             <input type="hidden"  name="stock_transfer_product_detail_mother_chile_type[]" id="stock_transfer_product_detail_mother_chile_type<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_mother_chile_type']?>" />
<input type="hidden"  name="stock_transfer_product_detail_product_type[]" id="stock_transfer_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_type']?>" />
											<?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="stock_transfer_product_detail_product_brand_id[]" id="stock_transfer_product_detail_product_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_brand_id']?>" />

											</td>

											<td>

											<?=$product_name?>

											<input type="hidden"  name="stock_transfer_product_detail_product_id[]" id="stock_transfer_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_id']?>"  />
											<input type="hidden"  name="stock_transfer_product_detail_id[]" id="stock_transfer_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_uom_name?>
                                               <input type="hidden"  name="stock_transfer_product_detail_product_color_id[]" id="stock_transfer_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_color_id']?>" />

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_product_thick[]" id="stock_transfer_product_detail_product_thick<?=$row_cnt?>" value="<?=$arr_thick[$get_product_detail['stock_transfer_product_detail_product_thick']]?>"   />

											</td>

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_width_inches[]" id="stock_transfer_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_width_inches']?>" onKeyUp="GetWcalc(2,<?=$row_cnt?>)"  />

											</td>

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_width_mm[]" id="stock_transfer_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_width_mm']?>" onKeyUp="GetWcalc(3,<?=$row_cnt?>)"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_weight_tone[]" id="stock_transfer_product_detail_weight_tone<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_weight_tone']?>"  />

											</td>
											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_weight_kg[]" id="stock_transfer_product_detail_weight_kg<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_weight_kg']?>"  />

											</td>
											
											
											
											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_qty[]" id="stock_transfer_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['stock_transfer_product_detail_qty']?>" />

											</td>
											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['stock_transfer_product_detail_id']?>&stock_transfer_uniq_id=<?php echo $stock_transfer_edit['stock_transfer_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>
										
										<?php }else{ ?>
										
										<tr class="as" style="display:none">

											<td>

											<?=$product_code?>
                                             <input type="hidden"  name="stock_transfer_product_detail_mother_chile_type[]" id="stock_transfer_product_detail_mother_chile_type" value="<?=$get_product_detail['stock_transfer_product_detail_mother_chile_type']?>" />
											<input type="hidden"  name="stock_transfer_product_detail_product_type[]" id="stock_transfer_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_type']?>" />

											</td>
											
											<!--<td>

											<?=$get_product_detail['brand_name']?>

											</td>-->

											<td>

											<?=$product_name?>

											<input type="hidden"  name="stock_transfer_product_detail_product_id[]" id="stock_transfer_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_id']?>"  />
											<input type="hidden"  name="stock_transfer_product_detail_id[]" id="stock_transfer_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_uom_name?>
                                             <input type="hidden"  name="stock_transfer_product_detail_product_color_id[]" id="stock_transfer_product_detail_product_color_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_product_color_id']?>" />
											</td>

											<td>

											<input class="form-control" type="text"  name="stock_transfer_product_detail_qty[]" id="stock_transfer_product_detail_qty<?=$row_cnt?>" value="<?=$get_product_detail['stock_transfer_product_detail_qty']?>" onBlur="GetTotalLength(<?=$row_cnt?>)"  />

											</td>

											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['stock_transfer_product_detail_id']?>&stock_transfer_uniq_id=<?php echo $stock_transfer_edit['stock_transfer_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

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

				<div class="row">

					
						<div class="col-lg-6">
										<input type="hidden"  name="stock_transfer_id" id="stock_transfer_id" value="<?=$stock_transfer_edit['stock_transfer_id']?>" />	
										<input type="hidden"  name="stock_transfer_uniq_id" id="stock_transfer_uniq_id" value="<?=$stock_transfer_edit['stock_transfer_uniq_id']?>" />	
									<button name="stock_transfer_update" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>
				</div><!--end-->

				</form>
			<script type="text/javascript">
			getTableHeader(<?=$stock_transfer_edit['stock_transfer_type_id']?>);
			</script>
				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Stock Transfer List

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
                        <div class="panel-body">

                            <div class="table-responsive">
                                <?php if(isset($_REQUEST['search'])){?>

								<form action="index.php" method="post" id="stock_transfer_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>S.T. No</th>

                                            <th>Date</th>


                                            <th>Product Type</th>
											
											<th>Print</th>

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="stock_transfer_entry_delete" type="submit" class="btn btn-danger">Delete</button>

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

                                            <td><?=$get_quotation['stock_transfer_no']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['stock_transfer_date'])?></td>


											<td><?=$arrQuotationType[$get_quotation['stock_transfer_type_id']]?></td>
											<td><a href="stock-print.php?id=<?php echo $get_quotation['stock_transfer_uniq_id']?>" title="STOCK PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['stock_transfer_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['stock_transfer_uniq_id']; ?>" type="checkbox" />

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

						<h4 class="modal-title" id="myModalLabel">Stock Transfer Detail</h4>

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

 

			<script>
			/*$('#stock_transfer_date').datepicker({
				format: 'dd/mm/yyyy',
			
			});*/
			$( "#stock_transfer_date" ).datepicker({
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
		
		$(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });

		</script>



</body>

</html>

