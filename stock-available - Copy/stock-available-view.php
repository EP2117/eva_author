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
												<label>Warehouse </label>
												<select name="warehouseid[]" id="warehouseid" class="form-control select2" multiple="" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													
													
													foreach($godown_list as	$get_godown){
													if((in_array($get_godown['godown_id'],searchValue('warehouseid'))==1)){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
													<?php
														}
													?>
												</select>
													
											</div>
											<div class="form-group">
												<label>From date</label>
												  <input type="text" class="form-control"  name="from_date" id="from_date" value="<?php echo searchValue('from_date'); ?>" readonly >	
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
															if(searchValue('type') == $key){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option value="<?=$key?>" <?=$select?>><?=$val?></option>
														<?php
															}
														?>
												</select>
													
											</div>	
											<div class="form-group">
												<label>Product Status</label>
												<select name="product_status" id="product_status" class="form-control select2" style="width:100%" onChange="return requestPoFn(this.value);" required>
													 <option value="1" <?php if(searchValue('product_status')==1){ ?> selected="selected" <?php } ?> >Accessories </option>
													 <option value="2" <?php if(searchValue('product_status')==2){ ?> selected="selected" <?php } ?> > Raw</option>
													 <option value="3" <?php if(searchValue('product_status')==3){ ?> selected="selected" <?php } ?> > Finished Goods</option>
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
												<input type="text" class="form-control"  name="productname" id="productname" value="<?=searchValue('productname') ?>" >
													
											</div>
											<div class="form-group">
												<label>Color</label>
												<select name="colorid" id="colorid" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													foreach($color_list as	$get_color){
														if(searchValue('colorid')  == $get_color['product_colour_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_color['product_colour_id']?>"><?=$get_color['product_colour_name']?></option>
													<?php
														}
													?>
													
												</select>
													
											</div>	
											<div class="form-group">
												<label>Width</label>
												<input type="text" class="form-control"  name="width" id="width" value="<?=searchValue('width') ?>">
											</div>			
											
											<div class="form-group">
												<label>Thik</label>
												<select name="thik" id="thik" class="form-control" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
														foreach($arr_thick as $key=>$val){
															if(searchValue('thik') == $key){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option value="<?=$key?>" <?=$select?>><?=$val?></option>
													<?php
														}
														?>
												</select>	
											</div>	
											
										</div>
										<div class="col-lg-4">										
											<div class="form-group">
												<label>Product Code</label>
												<input type="text" class="form-control"  name="productcode" id="productcode" value="<?=searchValue('productcode') ?>" >
													
											</div>
										</div>	
										<div class="col-lg-12">
											<button name="stockAvailable" type="submit"class="btn btn-danger">Search</button>
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</form>	
					<div class="panel panel-default">
						<div class="panel-heading">
							Stock availability list  <a href="<?php echo PROJECT_PATH.'/stock-available/stock-print.php?brandid='.searchValue('brandid').'&type='.searchValue('type').'&product_status='.searchValue('product_status').'&category='.searchValue('category').'&productname='.searchValue('productname').'&colorid='.searchValue('colorid').'&width='.searchValue('width').'&branchid='.searchValue('branchid').'&warehouseid='.searchValue('warehouseid').'&from_date='.searchValue('from_date').'&to_date='.searchValue('to_date').'&thik='.searchValue('thik').'&productcode='.searchValue('productcode');  ?>" title="Download PDF" target="_blank" align="right">
							<img src="<?php echo PROJECT_PATH.'/images/pdf-icon.png'; ?>" width="28" border="0"   alt="Download PDF" title="Download PDF">
							</a>
							<a href="<?php echo PROJECT_PATH.'/stock-available/stock-available-excel.php?brandid='.searchValue('brandid').'&type='.searchValue('type').'&product_status='.searchValue('product_status').'&category='.searchValue('category').'&productname='.searchValue('productname').'&colorid='.searchValue('colorid').'&width='.searchValue('width').'&branchid='.searchValue('branchid').'&warehouseid='.searchValue('warehouseid').'&from_date='.searchValue('from_date').'&to_date='.searchValue('to_date').'&thik='.searchValue('thik').'&productcode='.searchValue('productcode');  ?>" title="Download PDF" target="_blank" align="right">
							<img src="<?php echo PROJECT_PATH.'/images/excel-icon.png'; ?>" width="28" border="0"   alt="Download PDF" title="Download PDF">
							</a>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
							<?php 
								if(isset($_REQUEST['stockAvailable'])){
								$product_status		= (isset($_REQUEST['product_status']))?$_REQUEST['product_status']:''; 
								if($product_status==2){
							?>
								<table id="stock_table dataTables-example"  class="table table-striped table-bordered table-hover"  style="width:195%">
									<thead>
										<tr>
											<th rowspan="2" style="width:5%">S.No</th>	
											<th rowspan="2"  style="width:10%">Product code</th>	
											<th rowspan="2"  style="width:10%">Brand</th>	
											<th rowspan="2"  style="width:10%">Product name</th>										
											<th rowspan="2" style="width:10%">Color</th>
											<th rowspan="2" style="width:10%">Thick</th>
											<th colspan="2" >Width</th>
											<th colspan="2"  >Pur length</th>
											<th colspan="2"  >Pur Weight</th>
											<th colspan="2"  >Sale length</th>
											<th colspan="2"  >Sale Weight</th>
											<th colspan="2"  >Clo length</th>
											<th colspan="2"  >Clo Weight</th>
										</tr>
										<tr>
											<th   style="width:10%">INCHES</th>
											<th   style="width:10%">MM</th>
											<th   style="width:10%">FEET</th>
											<th   style="width:10%">METER</th>
											<th   style="width:10%">TONE</th>
											<th  style="width:10%">KG</th>
											<th  style="width:10%">FEET</th>
											<th  style="width:10%">METER</th>
											<th  style="width:10%">TONE</th>
											<th  style="width:10%">KG</th>
											<th  style="width:10%">FEET</th>
											<th  style="width:10%">METER</th>
											<th  style="width:10%">TONE</th>
											<th style="width:10%" >KG</th>
										</tr>
									</thead>
									<tbody>
									<?php $amt=0;
									    $ton=0;		
										if(!empty($stockList)){
										$s_no	= 1;	
																
										foreach($stockList as $result){
											//$open_qty		= stock_opening(searchValue('from_date'),$result['product_id'],$result['stock_ledger_prd_type']);
											//$closing_feet	= 	$open_qty+$result['closing_bal']; 
												$product_code			= $result['product_code'];
												$product_name			= $result['product_name'];
												$product_uom_name		= $result['product_uom_name'];
												$product_width_inches	= $result['product_con_entry_child_product_detail_width_inches'];
												$product_width_mm		= $result['product_con_entry_child_product_detail_width_mm'];
												//$product_thick_ness		= $result['product_con_entry_child_product_detail_thick_ness'];
												$product_thick_ness		= ($result['stock_ledger_thick_ness']==0)?'':$arr_thick[$result['stock_ledger_thick_ness']];
										?>
										<tr class="odd gradeX">
											<td><?php echo $s_no++; ?></td>
											<td><?php echo $product_code; ?></td>
											<td><?php echo $result['brand_name']; ?></td>
											<td><?php echo $product_name; ?></td>
											<td><?php echo $result['product_colour_name']; ?></td>
											<td><?php echo $product_thick_ness; ?></td>
											<td><?php echo $product_width_inches; ?></td>
											<td><?php echo $product_width_mm; ?></td>
											<td><?php echo number_format($result['pur_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_length_feet']*0.3048,2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_weight_kg'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_length_feet']*0.3048,2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_weight_kg'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_length_feet']*0.3048,2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_weight_kg'],2,'.',''); ?></td>
										
										</tr>
                                       
																   
									 <?php
									$amt=$amt+$result['closing_length_feet']; 
									$ton=$ton+$result['closing_weight_tone'];	}
										}
									  ?>
									</tbody>
                                     <tfoot>
                                        <?php 
									  ?>
										<tr >
											
                                            <td colspan="15">&nbsp;</td>								
											<td ><b>Total</b></td>
											<td ><b><?php echo number_format($amt,2,'.','');?></b></td><td ></td>
											<td ><b><?php echo number_format($ton,2,'.','');?></b></td><td ></td>
										</tr>
                                        </tfoot>
                                   													
								</table>
							<?php }elseif($product_status==3){
							?>
							<table  class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:195%">
									<thead>
										<tr>
											<th rowspan="2" style="width:5%">S.No</th>	
											<th rowspan="2"  style="width:10%">Product code</th>	
											<th rowspan="2"  style="width:10%">Brand</th>	
											<th rowspan="2"  style="width:10%">Product name</th>										
											<th rowspan="2" style="width:10%">Color</th>
											<th rowspan="2" style="width:10%">Thick</th>
											<th colspan="2" >Width</th>
											<th colspan="2" >length</th>
											<th colspan="2" >Weight</th>
											<th rowspan="2" >Pur Qty</th>
											<th rowspan="2" >Sale Qty</th>
											<th rowspan="2" >Closing Qty</th>
										</tr>
										<tr>
											<th   style="width:10%">INCHES</th>
											<th   style="width:10%">MM</th>
											<th   style="width:10%">FEET</th>
											<th   style="width:10%">METER</th>
											<th   style="width:10%">TONE</th>
											<th  style="width:10%">KG</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!empty($stockList)){
										$s_no	= 1;									
										foreach($stockList as $result){
											//$open_qty		= stock_opening(searchValue('from_date'),$result['product_id'],$result['stock_ledger_prd_type']);
											//$closing_feet	= 	$open_qty+$result['closing_bal']; 
												$product_code			= $result['product_code'];
												$product_name			= $result['product_name'];
												$product_uom_name		= $result['product_uom_name'];
												$product_width_inches	= $result['stock_ledger_width_inches'];
												$product_width_mm		= $result['stock_ledger_width_mm'];
												$product_thick_ness		= ($result['stock_ledger_thick_ness']==0)?'':$arr_thick[$result['stock_ledger_thick_ness']];
										?>
										<tr class="odd gradeX">
											<td><?php echo $s_no++; ?></td>
											<td><?php echo $product_code; ?></td>
											<td><?php echo $result['brand_name']; ?></td>
											<td><?php echo $product_name; ?></td>
											<td><?php echo $result['product_colour_name']; ?></td>
											<td><?php echo $product_thick_ness; ?></td>
											<td><?php echo $product_width_inches; ?></td>
											<td><?php echo $product_width_mm; ?></td>
											<td><?php echo number_format($result['stock_ledger_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['stock_ledger_length_feet']*0.3048,2,'.',''); ?></td>
											<td><?php echo number_format($result['stock_ledger_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['stock_ledger_weight_kg'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_qty'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_qty'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_qty'],2,'.',''); ?></td>
										</tr>
																	   
									 <?php }
										}
									  ?>
									</tbody>		
                                     									
								</table>
							<?php
							
							} elseif($product_status==1){
							?>
							<table id="dataTables-example"  class="table table-striped table-bordered table-hover" style="width:100%">
									<thead>
										<tr>
											<th  style="width:5%">S.No</th>	
											<th  style="width:10%">Product code</th>	
											<th   style="width:10%">Brand</th>	
											<th  style="width:10%">Product name</th>										
											<th >Pur Qty</th>
											<th  >Sale Qty</th>
											<th  >Closing Qty</th>
										</tr>
										
									</thead>
									<tbody>
									<?php
										if(!empty($stockList)){
										$s_no	= 1;									
										foreach($stockList as $result){
												$product_code			= $result['product_code'];
												$product_name			= $result['product_name'];
												$product_uom_name		= $result['product_uom_name'];
										?>
										<tr class="odd gradeX">
											<td><?php echo $s_no++; ?></td>
											<td><?php echo $product_code; ?></td>
											<td><?php echo $result['brand_name']; ?></td>
											<td><?php echo $product_name; ?></td>
											<td><?php echo number_format($result['pur_qty'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_qty'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_qty'],2,'.',''); ?></td>
										</tr>
																	   
									 <?php }
										}
									  ?>
									</tbody>
                                   											
								</table>
							<?php
							
							}} ?>
							</div>
						</div>
					</div>			

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
    </div>
	

	<script>
		$(document).ready(function () {//alert();
				$('#dataTables-example').DataTable( {
					responsive: true
				} );
			});
			$('#stock_table').DataTable( {
				fixedHeader: true,
				scrollY:300,
				scrollX:true,
				scrollCollapse: true,
				paging: false,
				"searching": false,
				"paging": false
			});
		$( "#from_date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy'
		});
		$( "#to_date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
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

 
