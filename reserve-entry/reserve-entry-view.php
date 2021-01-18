<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>RESERVE ENTRY</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Reserve Entry added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Reserve Entry updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Reserve Entry deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Reserve Entry Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Reserve Entry deleted successfully</div>';

		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/reserve-entry/reserve-entry-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Reserve Entry</h1>
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

								  	Reserve Entry Details

								</div>

								<div class="panel-body">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="reserve_entry_branch_id" id="reserve_entry_branch_id" class="form-control select2" style="width:100%" required>
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
											<select name="reserve_entry_godown_id" id="reserve_entry_godown_id" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($godown_list	as	$get_godown){
												?>
														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Reserve From</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="reserve_entry_from_date" id="reserve_entry_from_date" >
											</div>
										</div>
										
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="reserve_entry_date" id="reserve_entry_date" required value="<?=date('d/m/Y')?>">
											</div>
										</div>
										<div class="form-group">

											<label class="control-label">Type</label>

											<select name="reserve_entry_type_id" id="reserve_entry_type_id" class="form-control select2" style="width:100%" required onChange="getTableHeader(this.value)">
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
										
										<div class="form-group">
											<label>Reserve To</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="reserve_entry_to_date" id="reserve_entry_to_date" >
											</div>
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
											<th colspan="2"  > LENGTH</th>
											<th colspan="2" >WEIGHT</th>
											<th rowspan="2" > Qty</th>

                                        </tr>
										<tr>
											<th>FEET </th>
											<th>METER</th>
											<th>TON</th>
											<th>KG</th>
										</tr>
                                    </thead>
									<thead style="display:none" class="as">

                                         <tr>


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

									<button name="reserve_entry_insert" type="submit" class="btn btn-success">Save </button>

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

								  	Reserve Entry Details

								</div>

								<div class="panel-body">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Branch</label>
											<select name="reserve_entry_branch_id" id="reserve_entry_branch_id" class="form-control select2" style="width:100%">
												<?php
													foreach($branch_list	as	$get_branch){
														$selected	= ($get_branch['branch_id']==$reserve_edit['reserve_entry_branch_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										
										
										<div class="form-group">
											<label>Warehouse</label>
											<select name="reserve_entry_godown_id" id="reserve_entry_godown_id" class="form-control select2" style="width:100%">
												<?php
													foreach($godown_list	as	$get_godown){
														$selected	= ($get_godown['godown_id']==$reserve_edit['reserve_entry_godown_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Reserve From</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="reserve_entry_from_date" id="reserve_entry_from_date" value="<?=dateGeneralFormatN($reserve_edit['reserve_entry_from_date'])?>">
											</div>
										</div>
										
										
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="reserve_entry_date" id="reserve_entry_date" required  value="<?=dateGeneralFormatN($reserve_edit['reserve_entry_date'])?>"/>
											</div>
												
												
										</div>
										<div class="form-group">

											<label class="control-label">Type</label>
											<input type="text" class="form-control pull-right" name="reserve_entry_type_name" id="reserve_entry_type_name" value="<?=$arrQuotationType[$reserve_edit['reserve_entry_type_id']]?>">

										</div>
										<div class="form-group">
											<label>Reserve To</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="reserve_entry_to_date" id="reserve_entry_to_date" value="<?=dateGeneralFormatN($reserve_edit['reserve_entry_to_date'])?>">
											</div>
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

                        

								</div>

								<div class="table-responsive">
								
								
								

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style="width:200%" border="0" >
										<?php if($reserve_edit ['reserve_entry_type_id']==1){ ?> 
                                         <thead class="rls"  >
                                         <tr>
											<th rowspan="2" style="vertical-align:middle; %"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle; "> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOUR </th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"  > WIDTH</th>
											<th colspan="2"  > LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;">QTY</th>
                                        </tr>
										<tr>
											<th>INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>MET</th>
										</tr>
                                    </thead>
										
										
										<?php }elseif($reserve_edit ['reserve_entry_type_id']==2){?>
                                         <thead class="rws">
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;w"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"  > LENGTH</th>
											<th colspan="2" >WEIGHT</th>
											<th rowspan="2" > Qty</th>

                                        </tr>
										<tr>
											<th>FEET </th>
											<th>METER</th>
											<th>TON</th>
											<th>KG</th>
										</tr>
                                    </thead>
                                   <!-- </thead>-->
								   <?php }elseif($reserve_edit ['reserve_entry_type_id']==4){?>

                                        <thead  class="as">

                                         <tr>


                                            <th style="vertical-align:middle; width:30%">NAME</th>

                                            <th style="vertical-align:middle; width:30%">UOM</th>

											<th style="vertical-align:middle; width:40%">QTY</th>


                                        </tr>

                                    </thead>
								<?php }?>
                                    <!--</thead>-->
                                  

                                    <tbody id="product_detail_display">

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($reserve_entry_prd_edit);

										foreach($reserve_entry_prd_edit as $get_product_detail){
										if($reserve_edit ['reserve_entry_type_id']==1){
										?>
										<tr>
										
											<td ><?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="reserve_entry_product_detail_product_id[]" id="reserve_entry_product_detail_product_id" value="<?=$get_product_detail['reserve_entry_product_detail_product_id']?>" class="sd_id"  />
											<input type="hidden"  name="reserve_entry_product_detail_type[]" id="reserve_entry_product_detail_type" value="2"/>

											<input type="hidden"  name="reserve_entry_product_detail_id[]" id="reserve_entry_product_detail_id" value="<?=$get_product_detail['reserve_entry_product_detail_id']?>" /><input type="hidden"  name="reserve_entry_product_detail_osf_uom_ton[]" id="reserve_entry_product_detail_osf_uom_ton" value="<?=$get_product_detail['product_con_entry_osf_uom_ton']?>" />
											
											</td>
											<td > <?=$get_product_detail['product_con_entry_child_product_detail_name']?></td>
											<td><?=$get_product_detail['product_colour_name']?></td>
											<td> <?=$arr_thick[$get_product_detail['product_con_entry_child_product_detail_thick_ness']]?></td>
											
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_width_inches[]" id="reserve_entry_product_detail_width_inches"   value="<?=$get_product_detail['product_con_entry_child_product_detail_width_inches']?>"  readonly /></td> 
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_width_mm[]" id="reserve_entry_product_detail_width_mm"   value="<?=$get_product_detail['product_con_entry_child_product_detail_width_mm']?>"  readonly/></td>
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_length_feet[]" id="reserve_entry_product_detail_length_feet"  value="<?=$get_product_detail['product_con_entry_child_product_detail_length_feet']?>" readonly /></td> 
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_length_meter[]" id="reserve_entry_product_detail_length_meter"   value="<?=$get_product_detail['product_con_entry_child_product_detail_length_mm']?>"  readonly/></td>
			
									<td><input class="form-control" type="text"  name="reserve_entry_product_detail_qty[]" id="reserve_entry_product_detail_qty"  value="<?=$get_product_detail['reserve_entry_product_detail_qty']?>" /></td>
			
											
										</tr>
										
										<?php }elseif($reserve_edit ['reserve_entry_type_id']==2){
										$product_name=$get_product_detail['product_name'];
										$product_colour_name=$get_product_detail['product_colour_name'];
										$product_thick_ness=$get_product_detail['product_con_entry_child_product_detail_thick_ness'];
										?>
										<tr>
											<td ><?=$get_product_detail['brand_name']?>
											<input type="hidden"  name="reserve_entry_product_detail_product_id[]" id="reserve_entry_product_detail_product_id" value="<?=$get_product_detail['reserve_entry_product_detail_product_id']?>" class="sd_id"  />
											<input type="hidden"  name="reserve_entry_product_detail_type[]" id="reserve_entry_product_detail_type" value="2"/>

											<input type="hidden"  name="reserve_entry_product_detail_id[]" id="reserve_entry_product_detail_id" value="<?=$get_product_detail['reserve_entry_product_detail_id']?>" /><input type="hidden"  name="reserve_entry_product_detail_osf_uom_ton[]" id="reserve_entry_product_detail_osf_uom_ton" value="<?=$get_product_detail['product_con_entry_osf_uom_ton']?>" /></td>
											<td ><?=$product_name?></td>
											<td ><?= $product_colour_name;?></td>
											<td ><?= $arr_thick[$product_thick_ness];?></td>
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_length_feet[]" id="reserve_entry_product_detail_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['product_con_entry_child_product_detail_length_feet']?>"readonly /></td> 
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_length_meter[]" id="reserve_entry_product_detail_length_meter<?=$row_cnt?>"   value="<?=$get_product_detail['product_con_entry_child_product_detail_length_mm']?>"  readonly/></td>
												
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_tone[]" id="reserve_entry_product_detail_tone<?=$row_cnt?>"  value="<?=$get_product_detail['product_con_entry_child_product_detail_ton_qty']?>" readonly /></td> 
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_kg[]" id="reserve_entry_product_detail_kg<?=$row_cnt?>"   value="<?=$get_product_detail['product_con_entry_child_product_detail_kg_qty']?>"  readonly/></td>
											<td><input class="form-control" type="text"  name="reserve_entry_product_detail_qty[]" id="reserve_entry_product_detail_qty<?=$row_cnt?>" onBlur="GetTotalLength(<?=$row_cnt?>)"  value="<?=$get_product_detail['reserve_entry_product_detail_qty']?>" /></td>
										</tr>
										<?php }else{
										$product_name=$get_product_detail['product_name'];
										$product_uom_name=$get_product_detail['product_uom_name'];
										
										?>
										<tr>

											<td>

											<?=$product_name?>

											</td>

											<td>

											<?=$product_uom_name?>

											<input type="hidden"  name="reserve_entry_product_detail_product_id[]" id="reserve_entry_product_detail_product_id" value="<?=$get_product_detail['reserve_entry_product_detail_product_id']?>" class="sd_id"  />
											<input type="hidden"  name="reserve_entry_product_detail_type[]" id="reserve_entry_product_detail_type" value="1"/>

											<input type="hidden"  name="reserve_entry_product_detail_id[]" id="reserve_entry_product_detail_id" value="<?=$get_product_detail['reserve_entry_product_detail_id']?>" />

											</td>

											<td>

											<input class="form-control" type="text"  name="reserve_entry_product_detail_qty[]" id="reserve_entry_product_detail_qty<?=$row_cnt?>" value="<?=$get_product_detail['reserve_entry_product_detail_qty']?>"   />

											</td>

											

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['reserve_entry_product_detail_id']?>&reserve_entry_uniq_id=<?php echo $reserve_edit ['reserve_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

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
							<div class="col-lg-6">

										<input type="hidden"  name="reserve_entry_id" id="reserve_entry_id" value="<?=$reserve_edit['reserve_entry_id']?>" />	

										<input type="hidden"  name="reserve_entry_uniq_id" id="reserve_entry_uniq_id" value="<?=$reserve_edit['reserve_entry_uniq_id']?>" />	

									<button name="reserve_entry_update" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

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

                           Reserve Entry List

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
										  <input type="text" class="form-control pull-right" name="reserve_entry_from_date" id="reserve_entry_from_date" autocomplete="off"  value="<?=searchValue('reserve_entry_from_date')?>"  >
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
										  <input type="text" class="form-control pull-right" name="reserve_entry_to_date" id="reserve_entry_to_date" autocomplete="off"  value="<?=searchValue('reserve_entry_to_date')?>"  />
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

								<form action="index.php" method="post" id="reserve_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>SO.No.</th>
                                            <th>Date</th>
                                            <th>Warehouse</th>
                                            <th>Action</th>
											<th>
												<input name="checkall" onClick="checkedAll();" type="checkbox"  />
												<button name="reserve_entry_delete" type="submit" class="btn btn-danger">Delete</button>
											</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($reserve_list	as $get_reserve){
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_reserve['reserve_entry_no']?></td>
                                            <td><?=dateGeneralFormatN($get_reserve['reserve_entry_date'])?></td>
											<td><?=$get_reserve['godown_name']?></td>
											
                                            <td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_reserve['reserve_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
      										</td>
											<td>
												<input name="deleteCheck[]" value="<?php echo $get_reserve['reserve_entry_uniq_id']; ?>" type="checkbox" />
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

		

		<div class="modal fade" id="RawModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Raw Product Detail</h4>

					</div>

					<div class="modal-body">

						<div class="table-responsive">

							<div id="raw_detail_content">

							</div>

						</div>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

						<button type="button" class="btn btn-primary" onClick="AddRawdetail()"  data-dismiss="modal">Save changes</button>

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

 

<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">

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

   /* $('#reserve_entry_date').datepicker({

      autoclose: true

    });*/

	$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#reserve_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
			$( "#reserve_entry_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#reserve_entry_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#reserve_entry_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#reserve_entry_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
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

