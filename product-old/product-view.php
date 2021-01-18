<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		} 
	}

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/product/product-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Product</h1>
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
				<form name="product_form" method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Product Details
								</div>
								<div class="panel-body">
										<div class="col-lg-4">
											<div class="form-group">
												<label>Brand</label>
												<select class="form-control select2" name="product_brand_id" id="product_brand_id">
													<option value="">--Select--</option>
												<?php
												  	foreach($brand_list	as	$get_brand){
												?>
												  		<option value="<?=$get_brand['brand_id']?>"  ><?=$get_brand['brand_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Product Type</label>
												<select class="form-control" name="product_type" id="product_type">
													<option value="">--Select--</option>
													<?php
														foreach($arr_product_type as $value => $list){
													?>
														<option value="<?=$value?>"><?=ucfirst($list)?></option>
													<?php
													}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>UOM</label>
												<select class="form-control select2" name="product_uom_id" id="product_uom_id">
													<option value="">--Select--</option>
												<?php
												  	foreach($product_uom_list	as	$get_product_uom){
												?>
												  		<option value="<?=$get_product_uom['product_uom_id']?>"  ><?=$get_product_uom['product_uom_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Inches</label>
												<input class="form-control" type="number"  name="product_inches_qty" id="product_inches_qty"   />
											</div>
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label>Category</label>
												<select class="form-control select2" name="product_product_category_id" id="product_product_category_id"/>
												  <option value="">--Select--</option>
													<?php
														foreach($product_category_list	as	$get_product_category){
													?>
												  		<option value="<?=$get_product_category['product_category_id']?>"  ><?=$get_product_category['product_category_name']?></option>
													<?php
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Code Type</label>
												<select class="form-control select2" name="product_code_type" id="product_code_type" onChange="checkCode(this.value)">
												  <option value="1">Manual</option>
												  <option value="2">Automatic</option>
												  
												</select>
											</div>
											<div class="form-group">
												<label>Colour</label>
												<select class="form-control select2" name="product_uom_two_id" id="product_uom_two_id">
													<option value="">--Select--</option>
												<?php
												  	foreach($product_colour_list	as	$get_product_colour){
												?>
												  		<option value="<?=$get_product_colour['product_colour_id']?>"  ><?=$get_product_colour['product_colour_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label>MM</label>
												<input class="form-control" type="number"  name="product_mm_qty" id="product_mm_qty"  />
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Name</label>
												<input class="form-control" type="text"  name="product_name" id="product_name"  />
											</div>
											<div class="form-group">
												<label>Code</label>
												<div id="pro_id">
												<input class="form-control" type="text"  name="product_code" id="product_code">
												</div>
											</div>
											<div class="form-group">
												<label>Feet</label>
												<input class="form-control" type="number"  name="product_feet_qty" id="product_feet_qty" />
											</div>
											<div class="form-group">
												<label>Meter</label>
												<input class="form-control" type="number"  name="product_meter_qty" id="product_meter_qty" />
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
									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="multi-contact">
                                    <thead>
                                        <tr>
                                            <th>Raw Product </th>
                                            <th>Uom</th>
                                            <th>RAW THICK</th>
                                        </tr>
                                    </thead>
                                    <tbody id="multi-contact-display">
										<tr  class="odd gradeX">
										<td width="12%">
											<select name="product_detail_raw_product_id[]" id="product_detail_raw_product_id[]" class="form-control select2">
												  <option value=""> - Select - </option>
												<?php
												  	foreach($raw_product_list	as	$get_product){
												?>
												  		<option value="<?=$get_product['product_id']?>"  ><?=$get_product['product_name']?></option>
												<?php
													}
												?>
											</select>
										</td>
										<td width="17%">
										<input name="product_detail_uom[]" type="text" value="" class="form-control" id="product_detail_uom_0"  />
										</td>
										<td width="17%">
										<input name="product_detail_thick_ness[]" type="text" value="" class="form-control" id="product_detail_thick_ness_0[]"  />
										</td>
									  </tr>
									</tbody>
								</table>
								</div>
								<div class="col-lg-6">
									<button name="product_insert" type="submit" class="btn btn-primary">Submit Button</button>
									<button type="reset" class="btn btn-danger">Reset Button</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				</form>
				<?php }else if((isset($_GET['page']))  && (isset($_GET['id'])) && ($_GET['page']=='edit')) {
				?>
				<form name="product_form" method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Product Details
								</div>
								<div class="panel-body">
										<div class="col-lg-4">
											<div class="form-group">
												<label>Brand</label>
												<select class="form-control select2" name="product_brand_id" id="product_brand_id">
													<option value="">--Select--</option>
												<?php
												  	foreach($brand_list	as	$get_brand){
														$selected	= ($product_edit['product_brand_id']==$get_brand['brand_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_brand['brand_id']?>" <?=$selected?>  ><?=$get_brand['brand_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
											<label>Category</label>
											<select class="form-control select2" name="product_product_category_id" id="product_product_category_id"/>
											  <option value="">--Select--</option>
												<?php
													foreach($product_category_list	as	$get_product_category){
													$selected	= ($product_edit['product_product_category_id']==$get_product_category['product_category_id'])?'selected="selected"':'';
												?>
													<option value="<?=$get_product_category['product_category_id']?>" <?=$selected?> ><?=$get_product_category['product_category_name']?></option>
												<?php
													}
												?>
											</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Product Type</label>
												<select class="form-control" name="product_type" id="product_type">
													<option value="">--Select--</option>
													<?php
														foreach($arr_product_type as $value => $list){
														$selected	= ($product_edit['product_type']==$value)?'selected="selected"':'';
													?>
														<option value="<?=$value?>" <?=$selected?>><?=ucfirst($list)?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Code</label>
												<input class="form-control" type="text"  name="product_code" id="product_code" value="<?=$product_edit['product_code']?>">
											</div>
										</div>
										<div class="col-lg-8">
											<div class="form-group"  >
												<label>Name</label>
												<input class="form-control" type="text"  name="product_name" id="product_name" value="<?=$product_edit['product_name']?>"  min="0"/>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>UOM1</label>
												<select class="form-control select2" name="product_uom_one_id" id="product_uom_one_id">
													<option value="">--Select--</option>
												<?php
												  	foreach($product_uom_list	as	$get_product_uom){
														$selected	= ($product_edit['product_uom_one_id']==$get_product_uom['product_uom_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_product_uom['product_uom_id']?>" <?=$selected?> ><?=$get_product_uom['product_uom_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Max Qty</label>
												<input class="form-control" type="number"  name="product_max_qty" id="product_max_qty"  value="<?=$product_edit['product_max_qty']?>" min="0"/>
											</div>
											<div class="form-group">
												<label>Status</label>
												<select class="form-control select2" name="product_active_status" id="product_active_status">
													<option value="active" <?php if($product_edit['product_active_status']=="active"){ ?> selected="selected" <?php } ?>>Active</option>
													<option value="inactice" <?php if($product_edit['product_active_status']=="inactice"){ ?> selected="selected" <?php } ?>>InActive</option>
												</select>
											</div>
											
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>UOM2</label>
												<select class="form-control select2" name="product_uom_two_id" id="product_uom_two_id">
													<option value="">--Select--</option>
												<?php
												  	foreach($product_uom_list	as	$get_product_uom){
														$selected	= ($product_edit['product_uom_two_id']==$get_product_uom['product_uom_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_product_uom['product_uom_id']?>" <?=$selected?>  ><?=$get_product_uom['product_uom_name']?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Min Qty</label>
												<input class="form-control" type="number"  name="product_min_qty" id="product_min_qty" value="<?=$product_edit['product_min_qty']?>"  min="0"/>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>UOM1=UOM2</label>
												<input class="form-control" type="number"  name="product_uom_two_qty" id="product_uom_two_qty" value="<?=$product_edit['product_uom_two_qty']?>" />
											</div>
											<div class="form-group">
												<label>Cost Price</label>
												<input class="form-control" type="number"  name="product_cost_price" id="product_cost_price" value="<?=$product_edit['product_cost_price']?>" />
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
							  Selling Cost Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="multi-contact">
                                    <thead>
                                        <tr>
                                            <th>Branch </th>
                                            <th>Sales Mode</th>
                                            <th>Sales Types</th>
                                            <th>Payment Days</th>
                                            <th>Selling price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="multi-contact-display">
										<?PHP 
										foreach($product_detail_edit as $get_product_det){
										?>
										<tr  class="odd gradeX">
										<td width="12%">
													<input name="product_detail_id[]" type="hidden" value="<?=$get_product_det['product_detail_id']?>"  id="product_detail_id[]" /> 
											<select name="product_detail_branch_id[]" id="product_detail_branch_id[]" class="form-control select2">
												  <option value=""> - Select - </option>
												<?php
												  	foreach($branch_list	as	$get_branch){
														$selected	= ($get_product_det['product_detail_branch_id']==$get_branch['branch_id'])?'selected="selected"':'';
												?>
												  		<option value="<?=$get_branch['branch_id']?>"  <?=$selected?> ><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</td>
										<td width="17%">
											<select name="product_detail_salesmode_id[]" id="product_detail_salesmode_id[]" class="form-control select2">
												  <option value=""> - Select - </option>
												  <?php
												  	foreach($salesmode_list as	$get_salesmode){
														$selected	= ($get_product_det['product_detail_salesmode_id']==$get_salesmode['salesmode_id'])?'selected="selected"':'';
													?>
															<option value="<?=$get_salesmode['salesmode_id']?>" <?=$selected?> ><?=$get_salesmode['salesmode_name']?></option>
													<?php
														}
													?>
												  
											</select>
										</td>
										<td width="16%">
											<select name="product_detail_sales_type[]" id="product_detail_sales_type[]" class="form-control select2">
												<option value=""> - Select - </option>
												<?php
												foreach($arr_sales_type as $value => $list) {
														$selected	= ($get_product_det['product_detail_sales_type']==$value)?'selected="selected"':'';
												?>
													<option value="<?=$value?>" <?=$selected?>><?=ucfirst($list)?></option>
												<?php
												}
												?>
											</select>
										</td>
										<td width="17%">
										<input name="product_detail_payment_days[]" type="number"  class="form-control" id="product_detail_payment_days[]" value="<?=$get_product_det['product_detail_payment_days']?>"  />
										</td>
										<td width="17%">
										<input name="product_detail_selling_price[]" type="number" class="form-control" id="product_detail_selling_price[]" value="<?=$get_product_det['product_detail_selling_price']?>" />
										</td>
									  </tr>
									  	<?php
										}
										?>
									  	<tr  class="odd gradeX">
										<td width="12%">
											<select name="product_detail_branch_id[]" id="product_detail_branch_id[]" class="form-control select2">
												  <option value=""> - Select - </option>
												<?php
												  	foreach($branch_list	as	$get_branch){
												?>
												  		<option value="<?=$get_branch['branch_id']?>"  ><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</td>
										<td width="17%">
											<select name="product_detail_salesmode_id[]" id="product_detail_salesmode_id[]" class="form-control select2">
												  <option value=""> - Select - </option>
												  <?php
												  	foreach($salesmode_list as	$get_salesmode){
													?>
															<option value="<?=$get_salesmode['salesmode_id']?>"  ><?=$get_salesmode['salesmode_name']?></option>
													<?php
														}
													?>
												  
											</select>
										</td>
										<td width="16%">
											<select name="product_detail_sales_type[]" id="product_detail_sales_type[]" class="form-control select2">
												<option value=""> - Select - </option>
												<?php
												foreach($arr_sales_type as $value => $list) {
												?>
													<option value="<?=$value?>"><?=ucfirst($list)?></option>
												<?php
												}
												?>
											</select>
										</td>
										<td width="17%">
										<input name="product_detail_payment_days[]" type="number" value="" class="form-control" id="product_detail_payment_days[]"  />
										</td>
										<td width="17%">
										<input name="product_detail_selling_price[]" type="number" value="" class="form-control" id="product_detail_selling_price[]"/>
										</td>
									  </tr>
									</tbody>
								</table>
								</div>
								<div class="col-lg-6">
											<input type="hidden" name="product_id" id="product_id" value="<?=$product_edit['product_id']?>" />
											<input type="hidden" name="product_uniq_id" id="product_uniq_id" value="<?=$product_edit['product_uniq_id']?>" />
									<button name="product_update" type="submit" class="btn btn-primary">Submit Button</button>
									<button type="reset" class="btn btn-danger">Reset Button</button>
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
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>Code</th>
                                            <th>Name</th>
                                            <th>Product Type</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($product_list	as $get_branch){
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_branch['product_code']?></td>
                                            <td><?=ucfirst($get_branch['product_name'])?></td>
                                            <td><?=ucfirst($arr_product_type[$get_branch['product_type']])?></td>
											<td><?=ucfirst($get_branch['brand_name'])?></td>
											<td><?=ucfirst($get_branch['product_category_name'])?></td>
                                            <td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_branch['product_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
      										</td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
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
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
	     <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="../plugins/select2/select2.full.min.js"></script>
	
			<script>
				$(document).ready(function () {
					$('#dataTables-example').DataTable( {
						responsive: true
					} );
					/*$('#dataTables-example').dataTable();*/
				});
		
		//Initialize Select2 Elements
		$(".select2").select2();
				
		</script>

</body>
</html>