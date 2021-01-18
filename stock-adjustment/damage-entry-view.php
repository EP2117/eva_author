<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Stock Adjust</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Damage Entry added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Damage Entry updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Damage Entry deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Damage Entry Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Damage Entry deleted successfully</div>';

		}  

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/stock-adjustment/damage-entry-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/inventory-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">
					 <div class="col-md-12">
                        <h1 class="page-head-line">Stock Adjust</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='stock_adjustment_insert' || $_GET['page']=='edit')){ ?>
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
								  	Stock Adjustment Details
								</div>
								<div class="panel-body">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="stock_adjustment_branch_id" id="stock_adjustment_branch_id" class="form-control select2" style="width:100%" required>
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
											<label  class="control-label">Warehouse</label>
											<select name="stock_adjustment_godown_id" id="stock_adjustment_godown_id" class="form-control select2" style="width:100%" required>
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
												<label>Brand</label>
												<select name="stock_adjustment_brand_id" id="stock_adjustment_brand_id" class="form-control select2" style="width:100%" >
													<option value=""> - Select - </option>
													<?php
													foreach($brand_list as $get){
														if(searchValue('stock_adjustment_brand_id') == $get['brand_id']){ $select ='selected="selected"'; }else{ $select="";}													?>
														<option  value="<?=$get['brand_id']?>"><?=$get['brand_name']?></option>
													<?php
														}
													?>
												</select>
													
											</div>	

										
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label  class="control-label">Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="stock_adjustment_date" id="stock_adjustment_date" required >
											</div>
										</div>
										

										<div class="form-group" >

											<label class="control-label">Product Type</label>

											<select name="stock_adjustment_type_id" id="stock_adjustment_type_id" class="form-control select2" style="width:100%" required onChange="GetProddisplay()">
												  <option value=""> - Select - </option>
												<?php
													foreach($arr_product_type as $key => $value){
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

			
				<div class="row prduc_detail"  >
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

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style="width:190%" >
									<thead class="rls"  style="display:none">
                                          <tr>
											<th rowspan="3" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="3" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="3" style="vertical-align:middle;"> UOM</th>
                                            <th rowspan="3" style="vertical-align:middle;"> Color</th>
											<th rowspan="3" style="vertical-align:middle;"> THICK</th>
											<th colspan="4"> ADD</th>
											<th colspan="4">LESS</th>
											
                                        </tr>
										<tr>
										<th colspan="2">SALES LENG</th>
										<th colspan="2">WEIGHT</th>
										<th colspan="2">SALES LENG</th>
										<th colspan="2">WEIGHT</th>
										</tr>
										<tr>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
											
										</tr>
                                    </thead>
									
									<thead style="display:none" class="as">

                                         <tr>


                                            <th style="vertical-align:middle; width:30%">NAME</th>

                                            <th style="vertical-align:middle; width:30%">UOM</th>

											<th style="vertical-align:middle; width:40%">ADD QTY</th>
											
											<th style="vertical-align:middle; width:40%">LESS QTY</th>


                                        </tr>

                                    </thead>
                                    <tbody id="product_detail_display">
									</tbody>
								</table>

								</div>
								<div class="col-lg-6">

									<button name="stock_adjustment_insert" type="submit" class="btn btn-success">Save </button>

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

								Stock Adjust Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="stock_adjustment_branch_id" id="stock_adjustment_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$stock_adjustment_edit['stock_adjustment_branch_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

										<div class="form-group">

											<label>From Warehouse<?php echo $stock_adjustment_edit['stock_adjustment_godown_id'];?></label>

											<select name="stock_adjustment_godown_id" id="stock_adjustment_godown_id" class="form-control select2" onChange="GetcustomerDetail()">

												<option> - Select - </option>

												<?php

												foreach($godown_list as $get_godown){

														$selected	= ($get_godown['godown_id']==$stock_adjustment_edit['stock_adjustment_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

												<?php

													}

												?>

											</select>

										</div>
										<div class="form-group">
												<label>Brand</label>
												<select name="stock_adjustment_brand_id" id="stock_adjustment_brand_id" class="form-control select2" style="width:100%" >
													<option value=""> - Select - </option>
													<?php
													foreach($brand_list as $get){
														$selected = ($get['brand_id']==$stock_adjustment_edit['stock_adjustment_brand_id'])?'selected="selected"':'';
													?>
														<option <?=$selected?> value="<?=$get['brand_id']?>"><?=$get['brand_name']?></option>
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

											  <input type="text" class="form-control" name="stock_adjustment_date" id="stock_adjustment_date" value="<?=dateGeneralFormatN($stock_adjustment_edit['stock_adjustment_date'])?>">

											</div>

										<div class="form-group" >

											<label class="control-label">Product Type <?=$stock_adjustment_edit['stock_adjustment_type_id']?></label>

											<select name="stock_adjustment_type_id" id="stock_adjustment_type_id" class="form-control select2" style="width:100%" required onChange="GetProddisplay()">
												  <option value=""> - Select - </option>
												<?php
													foreach($arr_product_type as $key => $value){
													
													//$selected	= ($key==$stock_adjustment_edit['stock_adjustment_type_id'])?'selected="selected"':'';
												?>
														<option value="<?=$key?>" <?php if($key==$stock_adjustment_edit['stock_adjustment_type_id']){echo 'selected="selected"';}?> ><?=$value?></option>
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

							  Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>


								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:190%" >

                                 <!--   <thead style="display:none" class="rls">-->
										<?php if($stock_adjustment_edit['stock_adjustment_type_id']==1 || $stock_adjustment_edit['stock_adjustment_type_id']==3){ ?>
                                      <!--   <thead class="rls"  style="display:none">-->
                                          <tr>
											<th rowspan="3" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="3" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="3" style="vertical-align:middle;"> UOM</th>
                                            <th rowspan="3" style="vertical-align:middle;"> Color</th>
											<th rowspan="3" style="vertical-align:middle;"> THICK</th>
											<th colspan="4"> ADD</th>
											<th colspan="4">LESS</th>
											
                                        </tr>
										<tr>
										<th colspan="2">SALES LENG</th>
										<th colspan="2">WEIGHT</th>
										<th colspan="2">SALES LENG</th>
										<th colspan="2">WEIGHT</th>
										</tr>
										<tr>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
											
										</tr>
                                    <!--</thead>
									
									<thead style="display:none" class="as">
-->										<?php }else{?>
                                           <tr>


                                            <th style="vertical-align:middle; width:30%">NAME</th>

                                            <th style="vertical-align:middle; width:30%">UOM</th>

											<th style="vertical-align:middle; width:40%">ADD QTY</th>
											
											<th style="vertical-align:middle; width:40%">LESS QTY</th>


                                        </tr>
										
										<?php }?>

                                   <!-- </thead>-->

                                 
									                                    
									<tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($stock_adjustment_prd_edit);
										
										foreach($stock_adjustment_prd_edit as $get_product_detail){
											if($stock_adjustment_edit['stock_adjustment_type_id']==1 || $stock_adjustment_edit['stock_adjustment_type_id']==3){ 
												$product_code		= $get_product_detail['product_code'];
												$product_name		= $get_product_detail['product_name'];
												$product_uom_name	= $get_product_detail['product_uom_name'];
												$product_colour_name	= $get_product_detail['product_colour_name'];
												$product_brand_name		= $get_product_detail['brand_name'];											}
											else{
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['product_uom_name'];
												$product_colour_name	= $get_product_detail['product_colour_name'];
												$product_brand_name		= $get_product_detail['brand_name'];
											}
										
										
											if($stock_adjustment_edit['stock_adjustment_type_id']==1 || $stock_adjustment_edit['stock_adjustment_type_id']==3){ 
											?>
					
										<tr >
										<td><?=$product_brand_name?>
										<input type="hidden"  name="stock_adjustment_product_detail_product_id[]" id="stock_adjustment_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_adjustment_product_detail_product_id']?>"  />
											<input type="hidden"  name="stock_adjustment_product_detail_id[]" id="stock_adjustment_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_adjustment_product_detail_id']?>" /></td>
										<td><?=$product_name?></td>
										<td><?=$product_uom_name?></td>
										<td><?=$product_colour_name?></td>
										<td><?=$get_product_detail['product_thick_ness']?></td>
										<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_feet[]" id="stock_adjustment_product_detail_add_feet<?=$row_cnt?>"  value="<?=$get_product_detail['stock_adjustment_product_detail_add_feet']?>" onChange="GetLcalFeet(1,<?=$row_cnt?>)"  /></td> 
										<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_mm[]" id="stock_adjustment_product_detail_add_mm<?=$row_cnt?>" value="<?=$get_product_detail['stock_adjustment_product_detail_add_mm']?>" onChange="GetLcalFeet(4,<?=$row_cnt?>)"    /></td>
										
										<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_tone[]" id="stock_adjustment_product_detail_add_tone<?=$row_cnt?>"  onChange="GetWeightClc(1,<?=$row_cnt?>)" value="<?=$get_product_detail['stock_adjustment_product_detail_add_tone']?>"/>
										
										</td>
										<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_kg[]" id="stock_adjustment_product_detail_add_kg<?=$row_cnt?>"  value="<?=$get_product_detail['stock_adjustment_product_detail_add_kg']?>" onChange="GetWeightClc(3,<?=$row_cnt?>)" /></td>
										
										
										<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_feet[]" id="stock_adjustment_product_detail_less_feet<?=$row_cnt?>"  value="<?=$get_product_detail['stock_adjustment_product_detail_less_feet']?>" onChange="GetLcalFeet1(1,<?=$row_cnt?>)"  /></td> 
										<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_mm[]" id="stock_adjustment_product_detail_less_mm<?=$row_cnt?>" value="<?=$get_product_detail['stock_adjustment_product_detail_less_mm']?>" onChange="GetLcalFeet1(4,<?=$row_cnt?>)"    /></td>
										
										<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_tone[]" id="stock_adjustment_product_detail_less_tone<?=$row_cnt?>"  onChange="GetWeightClc1(1,<?=$row_cnt?>)" value="<?=$get_product_detail['stock_adjustment_product_detail_less_tone']?>"/>
										
										</td>
										<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_kg[]" id="stock_adjustment_product_detail_less_kg<?=$row_cnt?>"  value="<?=$get_product_detail['stock_adjustment_product_detail_less_kg']?>" onChange="GetWeightClc1(3,<?=$row_cnt?>)" /></td>
											

										</tr>
										
										<?php }else{ ?>
										
										<tr >

											<td>

											<?=$product_code?>
											<input type="hidden"  name="stock_adjustment_product_detail_product_type[]" id="stock_adjustment_product_detail_product_type<?=$row_cnt?>"  value="<?=$get_product_detail['stock_adjustment_product_detail_product_type']?>" />

											</td>
											
											<!--<td>

											<?=$get_product_detail['brand_name']?>

											</td>-->

											<td>

											<?=$product_name?>

											<input type="hidden"  name="stock_adjustment_product_detail_product_id[]" id="stock_adjustment_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_adjustment_product_detail_product_id']?>"  />
											<input type="hidden"  name="stock_adjustment_product_detail_id[]" id="stock_adjustment_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['stock_adjustment_product_detail_id']?>" />

											</td>

											<td>
											<?=$product_uom_name?>
											</td>

											<td>

											<input class="form-control" type="text"  name="stock_adjustment_product_detail_add_qty[]" id="stock_adjustment_product_detail_add_qty<?=$row_cnt?>" value="<?=$get_product_detail['stock_adjustment_product_detail_add_qty']?>" onChange="GetTotalLength(<?=$row_cnt?>)"  />

											</td>
											
											<td>

											<input class="form-control" type="text"  name="stock_adjustment_product_detail_less_qty[]" id="stock_adjustment_product_detail_less_qty<?=$row_cnt?>" value="<?=$get_product_detail['stock_adjustment_product_detail_less_qty']?>" onChange="GetTotalLength(<?=$row_cnt?>)"  />

											</td>
								
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['stock_adjustment_product_detail_id']?>&stock_adjustment_uniq_id=<?php echo $stock_adjustment_edit['stock_adjustment_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

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
										<input type="hidden"  name="stock_adjustment_id" id="stock_adjustment_id" value="<?=$stock_adjustment_edit['stock_adjustment_id']?>" />	
										<input type="hidden"  name="stock_adjustment_uniq_id" id="stock_adjustment_uniq_id" value="<?=$stock_adjustment_edit['stock_adjustment_uniq_id']?>" />	
									<button name="stock_adjustment_update" type="submit" class="btn btn-success">Save </button>

									<button type="reset" class="btn btn-danger">Reset </button>
									
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>

								</div>
				</div>

				</form>
			<script type="text/javascript">
			getTableHeader(<?=$stock_adjustment_edit['stock_adjustment_type_id']?>);
			</script>
				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                       Stock Adjust List

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

								<form action="index.php" method="post" id="stock_adjustment_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>S.T. No</th>

                                            <th>Date</th>


                                            <th>Product Type</th>

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="stock_adjustment_entry_delete" type="submit" class="btn btn-danger">Delete</button>

											</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($so_return_list	as $get_quotation){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=$get_quotation['product_code']?></td>

                                            <td><?=dateGeneralFormatN($get_quotation['stock_adjustment_date'])?></td>


											<td><?=$arr_product_type[$get_quotation['stock_adjustment_type_id']]?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_quotation['stock_adjustment_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['stock_adjustment_uniq_id']; ?>" type="checkbox" />

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

                                            <button type="button" class="btn btn-primary" onClick="AddproductDetail()"  data-dismiss="modal">Save changes</button><!--AddRawproductDetail-->

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

						<h4 class="modal-title" id="myModalLabel">Damage Entry Detail</h4>

					</div>

					<div class="modal-body">

						<div class="table-responsive">

							<div id="so_detail_content">

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

    <!-- /. WRAPPER  -->

    <div id="footer-sec">

        <?=PROJECT_FOOTER?>

    </div>

 

			<script>
			/*$('#stock_adjustment_date').datepicker({
				format: 'dd/mm/yyyy',
			
			});*/
			$( "#stock_adjustment_date" ).datepicker({
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
				
				$(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
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

