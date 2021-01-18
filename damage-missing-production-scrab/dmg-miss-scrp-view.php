<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DEMAGE,MISSING ,MANUFACTURING SCRP</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/damage-missing-production-scrab/dmg-miss-scrp-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
					 <div class="col-md-12">
                        <h1 class="page-head-line">DEMAGE,MISSING ,MANUFACTURING SCRP</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn " onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>
                </div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>	
					<form name="dmgmsing-scrp-form" id="dmgmsing-scrp-form" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editdms['dmgMsgScrpId'])?"":$editdms['dmgMsgScrpId']; ?>" >

						<div class="row">
							
							<div id="request" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
							
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Demage & Missing Product Request Entry								 
									</div>
									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editdms['dms_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											<div class="form-group">
												<label class="control-label">Warehouse</label>
												<select name="warehouseid" id="warehouseid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
													foreach($godown_list as	$get_godown){
														if($editdms['dms_warehouseid'] == $get_godown['godown_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
													<?php
														}
													?>
													
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Brand</label>
												<select name="brandid" id="brandid" class="form-control select2" style="width:100%" required >
													 <option value=""> - Select - </option>
													 <?php
														foreach($brand_list as	$get){
															if($editdms['dms_brandid'] == $get['brand_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get['brand_id']?>"><?=$get['brand_name']?></option>
													<?php
														}
														?>
												</select>
											</div>		
											<div class="form-group">
												<label>Product status</label>
												<select name="productstatus" id="productstatus" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													foreach($product_status_arry as	$key=>$val){
														if($editdms['dms_product_status'] == $key){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$key?>"><?=$val?></option>
													<?php
														}
													?>
													
												</select>
											</div>	
											<div class="form-group">
												<label>Type</label>
												<select name="type" id="type" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													foreach($type_arry as $key=>$val){
														if($editdms['dms_type'] == $key){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$key?>"><?=$val?></option>
													<?php
														}
													?>
												</select>
											</div>					
											<!--<div class="form-group">
												<label>Product</label>
													<input type="text" class="form-control" name="product" id="product"  onkeypress="return o_obj.Alpha_Numeric(this,event);" onKeyUp="return getemployee(this.value,this);" value="<?php echo empty($editdms['dms_productid'])?"":$editdms['dms_productid'].' - '.$editdms['dms_productid']; ?>">
											</div>-->
																					
										</div>																				
										<div class="col-lg-6">
											<div class="form-group">
												<label class="control-label">Date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control dmsdate"  name="ds_date" id="ds_date" readonly="" value="<?php echo empty($editdms['dms_date'])?"":$editdms['dms_date']; ?>" required >	
												</div>
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
												<input type="text" class="form-control" name="width" id="width"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo empty($editdms['dms_width'])?"":$editdms['dms_width']; ?>">
											</div>	
											
											
											
											<div class="form-group">
												<label>Thick</label>
													<input type="text" class="form-control" name="thick" id="thick"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo empty($editdms['dms_thick'])?"":$editdms['dms_thick']; ?>">
											</div>	
											<div class="form-group">
												<label>Po entry type</label>
												<select name="poentrytype" id="poentrytype" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													foreach($poentry_type_arry as $key=>$val){
														if($editdms['dms_po_entrytype'] == $key){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$key?>"><?=$val?></option>
													<?php
														}
													?>
													
												</select>
											</div>			
										
									</div>
									
								</div>		
								</div>						
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									
									<div class="panel-body">
										<table id="mising_dmg_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val = !empty($editdmsProd) ? count($editdmsProd) :''; ?>
												<tr style="">
													<th style="width:20%;">Product Name</th>
													<th>Product Code</th>
													<th>UOM 1</th>
													<!--<th>UOM 2</th>-->
													<th>Color </th>
													<th>Thick</th>
													<th>Width</th>
													<th>Length</th>
													<th>Qty</th>
												<!--	<th>Rate</th>
													<th>Amount</th>-->
													<td width="5%">
													<input type="hidden" id="mising_dmg_apnd" name="mising_dmg_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">
													<button class="glyphicon glyphicon-plus" title="Add row" type="button" onClick="addReqRow()"></button>	
													</td>
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
												   for($i=1;$i<=count($editdmsProd);$i++){
													$j=$i-1;
												 ?>
												<tr id="remove_req_<?php echo $i; ?>">
												
														
													
													<td>
														<input type="hidden" name="pid_<?php echo $i; ?>" value="<?php echo $editdmsProd[$j]['dmsProductId']; ?>">																
														<input type="text" class="form-control" name="prod_name_<?php echo $i; ?>" id="prod_name_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['product_con_entry_child_product_detail_id'].' - '.$editdmsProd[$j]['product_con_entry_child_product_detail_code'].' - '.$editdmsProd[$j]['product_con_entry_child_product_detail_name']; ?>" onKeyUp="return get_product(this.value,this,<?php echo $i; ?>,1);">
														
													</td>
													<td>																
														<input type="text" class="form-control" name="prod_code_<?php echo $i; ?>" id="prod_code_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['product_con_entry_child_product_detail_code']; ?>" readonly="">
													</td>
													<td>																
														<input type="text" class="form-control" name="prod_uom_one_<?php echo $i; ?>" id="prod_uom_one_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['product_uom_name']; ?>" readonly="">
													</td>
												<!--	<td>																
														<input type="text" class="form-control" name="prod_uom_two_<?php echo $i; ?>" id="prod_uom_two_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['product_uom_name']; ?>" readonly>
													</td>-->
													<td>																
														<input type="text" class="form-control" name="color_<?php echo $i; ?>" id="color_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['product_colour_name']; ?>" readonly>
													</td>
													<td>																
														<input type="text" class="form-control" name="thick_<?php echo $i; ?>" id="thick_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['product_con_entry_child_product_detail_thick_ness']; ?>" readonly>
													</td>
													<td>																
														<input type="text" class="form-control" name="width_<?php echo $i; ?>" id="width_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['product_con_entry_child_product_detail_width_inches']; ?>" readonly>
													</td>
													<td>																
														<input type="text" class="form-control" name="length_<?php echo $i; ?>" id="length_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['length']; ?>" readonly>
													</td>
													<td>																
														<input type="text" class="form-control" name="qty_<?php echo $i; ?>" id="qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['dmsP_qty']; ?>" onChange="return mant_calculate(this.value,this,'<?php echo $i; ?>',1);">
													</td>
													<!--<td>																
														<input type="text" class="form-control"  style="text-align:right" name="rate_<?php echo $i; ?>" id="rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['dmsP_rate']; ?>" readonly>
													</td>
													<td>																
														<input type="text" class="form-control"  style="text-align:right" name="amount_<?php echo $i; ?>" id="amount_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdmsProd[$j]['dmsP_amount']; ?>" readonly>
													</td>-->
													<td><?php /*if($arr_cnt>1) {*/ ?><a href="index.php?dmsProductId=<?=$editdmsProd[$j]['dmsProductId']?>&dms_id=<?=$editdmsProd[$j]['dmsP_dmgMsgScrpId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php // } ?></td>	
												</tr>
											<?php   }
												  }else{
												 ?>	
												 <tr id="remove_employees_1">
													<td>
													<input type="hidden" name="pid_1" value="">
													<input type="text" class="form-control" name="prod_name_1" id="prod_name_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" onKeyUp="return get_product(this.value,this,1,1);"></td>
													<td><input type="text" class="form-control" name="prod_code_1" id="prod_code_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
													<td><input type="text" class="form-control" name="prod_uom_one_1" id="prod_uom_one_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
<!--													<td><input type="text" class="form-control" name="prod_uom_two_1" id="prod_uom_two_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
-->													<td><input type="text" class="form-control" name="color_1" id="color_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
													<td><input type="text" class="form-control" name="thick_1" id="thick_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
													<td><input type="text" class="form-control" name="width_1" id="width_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
													<td><input type="text" class="form-control" name="length_1" id="length_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
													<td><input type="text" class="form-control" name="qty_1" id="qty_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" onChange="return mant_calculate(this.value,this,1,1);" ></td>
<!--												<td><input type="text" class="form-control" name="rate_1" id="rate_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
													<td><input type="text" class="form-control" name="amount_1" id="amount_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);" readonly></td>
-->													<td>
														<button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onClick="removeRow(1)"></button>
													</td>
												</tr>
											 <?php }
											 ?>	
											</tbody>	
																					
										</table>					
									</div>
									
								</div>
								
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="dms_insrtUpdate" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
								<button type="reset" class="btn btn-danger">Reset </button>
								<!--<input type="button" class="btn " onClick="location.href='index.php'" value="Back">-->
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Damage & missing,scrp list
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<form action="index.php" method="post">

									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Id</th>	
<!--												<th>Type</th>										
-->												<th>Warehouse</th>
												<th>Branch</th>
												<th>Date</th>
												<th>Action</th>
												<th>
													<input name="checkall" id="checkall" onClick="checkedAll(this);" type="checkbox"  />
													<button name="dms_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($dmsList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['dmgMsgScrpId']; ?></td>
<!--												<td><?php if($result['dms_select_type']==1){echo "Damage & Missing Product";}elseif($result['dms_select_type']==2){ echo "Manufacturing Scrp Product";} ?></td>
-->												<td><?php echo $result['godown_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['dms_date']; ?></td>
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['dmgMsgScrpId']?>&ds_date=<?php echo $result['dms_date']; ?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												
												<td>
												<input name="deleteCheck[]" class="check" value="<?php echo $result['dmgMsgScrpId']; ?>" type="checkbox" />
											</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</form>
								</div>
							</div>
						</div>
				<?php } ?>
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
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
			
		});
		$( ".dmsdate" ).datepicker({
			 dateFormat: 'dd/mm/yy',
		});
			
		$("#dmgmsing-scrp-form").validate({
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

 
