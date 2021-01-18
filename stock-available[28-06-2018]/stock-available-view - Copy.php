<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stock Ledger</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = 'Added successfully';
		}elseif($_GET['msg']==2) {
			$msg = 'Updated successfully';
		} 
	}		
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/stock-available/stock-available-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
					 <div class="col-md-12">
                        <h1 class="page-head-line">STOCK AVAILABILITY</h1>
                    </div>
                </div>				
					
					 <form id="stock-form" name="stock-form" method="post">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										STOCK AVAILABILITY							 
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-4">										
											<div class="form-group">
												<label>Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if(searchValue('branchid') == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?> value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											<div class="form-group">
												<label>Warehouse</label>
												<select name="warehouseid" id="warehouseid" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													 <option value="1" <?php if(searchValue('warehouseid')==1){ ?> selected="selected" <?php } ?> > Main Warehouse </option>
													 <option value="2" <?php if(searchValue('warehouseid')==2){ ?> selected="selected" <?php } ?>> Sales Warehouse  </option>
													 <option value="3" <?php if(searchValue('warehouseid')==3){ ?> selected="selected" <?php } ?>> Manufacture Warehouse  </option>
												</select>
													
											</div>
											<div class="form-group">
												<label>From date</label>
												  <input type="text" class="form-control"  name="from_date" id="from_date" value="<?php echo searchValue('from_date'); ?>" readonly="" >	
											</div>	
											
											<div class="form-group">
												<label>To date</label>
												<input type="text" class="form-control"  name="to_date" id="to_date" value="<?php echo searchValue('to_date'); ?>" readonly>	
													
											</div>	
										</div>																				
										<div class="col-lg-4">
											<div class="form-group">
												<label>Brand</label>
												<select name="brandid" id="brandid" class="form-control select2" style="width:100%" >
													<option value=""> - Select - </option>
													<?php
													foreach($brand_list as $get){
														if(searchValue('brandid') == $get['brand_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get['brand_id']?>"><?=$get['brand_name']?></option>
													<?php
														}
													?>
												</select>
													
											</div>	
											<div class="form-group">
												<label>Type</label>
												<select name="type" id="type" class="form-control" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
														foreach($type_arry as $key=>$val){
															if(searchValue('type') == $val){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option value="<?=$key?>"><?=$val?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											<div class="form-group">
												<label>Product Status</label>
												<select name="product_status" id="product_status" class="form-control select2" style="width:100%" onChange="return requestPoFn(this.value);">
													 <option value=""> - Select - </option>
													 <?php
														foreach($prodStatus_arry as	$key=>$val){
															if(searchValue('product_status') == $val){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option value="<?=$key?>"><?=$val?></option>
													<?php
														}
														?>
												</select>
											</div>			
											<div class="form-group">
												<label>Product category</label>
												<select name="category" id="category" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													foreach($prod_category  as	$get){
														if(searchValue('category') == $get['product_category_id']){ $select = 'selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get['product_category_id']?>"><?=$get['product_category_name']?></option>
													<?php
														}
													?>
												</select>	
													
											</div>	
									
										</div>	
										<div class="col-lg-4">										
											<div class="form-group">
												<label>Product</label>
												<input type="text" class="form-control"  name="productname" id="productname" >
													
											</div>
											<div class="form-group">
												<label>Color</label>
												<select name="colorid" id="colorid" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													foreach($color_list as	$get_color){
														if($editdms['dms_colorid'] == $get_color['product_colour_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_color['product_colour_id']?>"><?=$get_color['product_colour_name']?></option>
													<?php
														}
													?>
													
												</select>
													
											</div>	
											<div class="form-group">
												<label>Width</label>
												<input type="text" class="form-control"  name="width" id="width">
											</div>			
											
											<div class="form-group">
												<label>Thik</label>
												<input type="text" class="form-control"  name="thik" id="thik">
													
											</div>	
											
										</div>	
										<div class="col-lg-12">
											<button name="stockAvailable" type="submit"class="btn btn-danger">Serach</button>
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</form>	
					<div class="panel panel-default">
						<div class="panel-heading">
							Stock availability list  
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table id="stock_table"  class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>S.No</th>	
											<th>Product code</th>	
											<th>Product name</th>										
											<th>Brand</th>
											<th>Product status</th>
											<th>Uom</th>
											<th>Purchase Feet</th>
											<th>Sales Feet</th>
											<th>Closing Feet</th>
											<th>Type</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!empty($stockList)){
										$s_no	= 1;									
										foreach($stockList as $result){
											$open_qty		= stock_opening(searchValue('from_date'),$result['product_id'],$result['stock_ledger_prd_type']);
											$closing_feet	= 	$open_qty+$result['closing_bal']; 
											
											if($result['stock_ledger_prd_type']==1){
												$product_code		= $result['product_code'];
												$product_name		= $result['product_name'];
												$product_uom_name	= $result['p_uom_name'];
											}
											else{
												$product_code		= $result['product_con_entry_child_product_detail_code'];
												$product_name		= $result['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $result['c_uom_name'];
											}
											
										?>
										<tr class="odd gradeX">
											<td><?php echo $s_no++; ?></td>
											<td><?php echo $product_code; ?></td>
											<td><?php echo $product_name; ?></td>
											<td><?php echo $result['brand_name']; ?></td>
											<td></td>
											<td><?php echo $product_uom_name; ?></td>
											<td><?php echo $result['pur_qty']; ?></td>
											<td><?php echo $result['sal_qty']; ?></td>
											<td><?php echo $closing_feet; ?></td>
											<td><?php //echo $result['product_name']; ?></td>
											<td><?php //echo $result['product_name']; ?></td>
										</tr>
																	   
									 <?php }
										}
									  ?>
									</tbody>												
								</table>
							</div>
						</div>
					</div>			

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
	

	<script>
		$(document).ready(function () {
			$('#stock_table').DataTable( {
				 "pageLength": 15,
				responsive: true
				
			} );	
			
		});
		
		$( "#from_date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			onClose: function( selectedDate ) {
				$( "#to_date" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#to_date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			onClose: function( selectedDate ) {
				$( "#from_date" ).datepicker( "option", "minDate", selectedDate );
			}
		});			
		$("#stock-form").validate({
				rules: {
					branchid: "required",
					warehouseid: "required",
					from_date: "required",
					to_date: "required"	
				}
			});					
	</script>

</body>

 
