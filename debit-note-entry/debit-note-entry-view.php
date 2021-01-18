 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DEBIT NOTE ENTRY</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/debit-note-entry/debit-note-entry-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DEBIT NOTE ENTRY</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) { echo $msg; }
							?>
						</h1>
                    </div>
                </div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>	
					<form name="grn-forms" id="grn-forms" method="post" enctype="multipart/form-data">
						<input type="hidden" name="dn_entry_id" value="<?php  echo $dn_entry_id = empty($editResult['dn_entry_id'])?"":$editResult['dn_entry_id']; ?>" >

						<div class="row">
						
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Debit note entry								 
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editResult['dn_entry_branch_id'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>													
											</div>	

											<div class="form-group">
												<label class="control-label">Invoice no</label>
												<select name="purchaseid" id="purchaseid" class="form-control" style="width:100%" onChange="return requestPoFn(this.value);" required>
													 <option value=""> - Select - </option>
													  <?php
														foreach($purdetailslist  as $get_po){
															if($editResult['dn_entry_invoice_id'] == $get_po['invoiceId']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_po['invoiceId']?>"><?=$get_po['invoiceNo'].' - '.$get_po['supplier_name']?></option>
													<?php
														}
														?>
												</select>
											</div>	

											<div class="form-group">
												<label class="control-label">Warehouse</label>
												<select name="dn_entry_warehouseid" id="dn_entry_warehouseid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
													foreach($godown_list as	$get_godown){
														if($editResult['dn_entry_warehouseid'] == $get_godown['godown_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
													<?php
														}
													?>
												</select>													
											</div>	

											<div class="form-group">
												<label>Type 1</label>
												<select name="dn_entry_type_one_id" id="dn_entry_type_one_id" class="form-control select2" style="width:100%" required onChange="GetDisplayPrdt()">
													<?php  $entryoneid = empty($editResult['dn_entry_type_one_id'])?"":$editResult['dn_entry_type_one_id']; ?>
													 <option value=""> - Select - </option>										
														<option <?php if($entryoneid==1){ echo "selected"; }?> value="1">Raw Material</option>
														<option <?php if($entryoneid==2){ echo "selected"; }?> value="2">Accessories</option>
													
												</select>													
											</div>

											<div class="form-group">
												<label>Type 2</label>
												<select name="dn_entry_type_two_id" id="dn_entry_type_two_id" class="form-control select2" style="width:100%" required>
													<?php  $entrytwoid = empty($editResult['dn_entry_type_two_id'])?"":$editResult['dn_entry_type_two_id']; ?>
													 <option value=""> - Select - </option>
														<option <?php if($entrytwoid==1){ echo "selected"; }?> value="1">Stock</option>
														<option <?php if($entrytwoid==2){ echo "selected"; }?> value="2">Account</option>
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
												  <input type="text" class="form-control"  name="grn_date" id="grn_date" readonly value="<?php echo empty($editResult['dn_entry_date'])?date('d/m/Y'):$editResult['dn_entry_date']; ?>" required>	
												</div>
											</div>	
											
											<div class="form-group">
												<label>Supplier location</label>
												<?php  $val = empty($editResult['supplier_location'])?"":$editResult['supplier_location']; ?>
												<input type="text" class="form-control"  name="supplier_location" id="supplier_location" readonly value="<?php echo $val==1?"Local":($val==2?"Oversea":""); ?>">														
											</div>	

											<div class="form-group">
												<label>Supplier name</label>
												<input type="text" class="form-control"  name="supplier_name" id="supplier_name" readonly value="<?php echo empty($editResult['supplier_name'])?"":$editResult['supplier_name']; ?>">	<input type="hidden"  name="supplier_id" id="supplier_id" readonly value="<?php echo empty($editResult['supplier_id'])?"":$editResult['supplier_id']; ?>">													
											</div>			

											<div class="form-group">
												<label>PO date</label>
												<input type="text" class="form-control"  name="po_date" id="po_date" readonly value="<?php echo empty($editResult['pR_purchase_date'])?"":$editResult['pR_purchase_date']; ?>">
												<input type="hidden" class="form-control"  name="dne_frgn_rate" id="dne_frgn_rate" readonly value="<?php echo empty($editResult['dne_frgn_rate'])?"":$editResult['dne_frgn_rate']; ?>">
											</div>		
									
									</div>		
								</div>
								
								
								
								
								<div class="panel panel-info" id="product_detail_panel"  <?php if($entryoneid==2){?> style="display:block" <?php }else{?> style="display:none" <?php } ?>>
								
									<div class="panel-heading">	
										Product Details								 
									</div>

									<div class="col-lg-6">
										<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
									</div>

									<div class="panel-body">
										
										<table id="receipt_table" class="table table-striped table-bordered table-hover">
											
											<thead>
												
												<?php $count_val = !empty($editdebitproduct) ? count($editdebitproduct) :'';  ?>
												
												<input type="hidden" id="receipt_apnd" name="receipt_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">

												<tr>
													<th style="text-align:center">Product Name</th>
													<th style="text-align:center">Code</th>
													<th style="text-align:center">UOM</th>
													<th style="text-align:center">PO qty</th>
													<th style="text-align:center">Rate</th>
													<th style="text-align:center">Frgn Rate</th>
													<th style="text-align:center">Qty</th>
													<th style="text-align:center">Feet/Qty</th>
													<th style="text-align:center">Total Feet</th>
													<th style="text-align:center">Amount By Cur</th>
													<th style="text-align:center">Amount By MMK</th>

												</tr>
											</thead>

											<tbody>
											<?php 
												
												if(0<$count_val){//print_r($editdebitproduct);exit;
													$count_id = count($editdebitproduct);
												   for($i=0;$i<count($editdebitproduct);$i++){													
												 ?>
											 <tr id="remove_req_<?php echo $i; ?>">
												<td><?php echo $editdebitproduct[$i]['product_name']; ?>
													<input type="hidden" id="invoice_id_<?php echo $editdebitproduct[$i]['dn_entry_product_detail_invoice_detail_id']; ?>" name ="invoice_id_<?php echo $editdebitproduct[$i]['dn_entry_product_detail_invoice_detail_id']; ?>" value="" />
													<input type="hidden" name="dn_entry_product_detail_id_<?php echo $i; ?>" value="<?php echo $editdebitproduct[$i]['dn_entry_product_detail_id']; ?>">
													
													<input type="hidden" class="form-control" name="productid_<?php echo $i; ?>" id="productid_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdebitproduct[$i]['dn_entry_product_detail_productid']; ?>">
													
													<input type="hidden" class="form-control" name="pid_<?php echo $i; ?>" id="pid_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdebitproduct[$i]['dn_entry_product_detail_id']; ?>">
													
													<!--<input type="hidden" class="form-control" name="productid_<?php echo $i; ?>" id="productid_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdebitproduct[$i]['grnP_product_id']; ?>"> -->
													
												</td>
												
												<td><?php echo $editdebitproduct[$i]['product_code']; ?></td>
												
												<td><?php echo $editdebitproduct[$i]['product_uom_name']; ?></td>
												
												<td>																
													<input type="text" class="form-control" name="po_qty_<?php echo $i; ?>" id="po_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdebitproduct[$i]['dn_entry_product_detail_po_qty']; ?>" readonly>
												</td>
												
												<td>																
													<input type="text" class="form-control" name="rate_<?php echo $i; ?>" id="rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdebitproduct[$i]['dn_entry_product_detail_rate']; ?>" readonly>
												</td>
												<td>																
													<input type="text" class="form-control" name="f_rate_<?php echo $i; ?>" id="f_rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdebitproduct[$i]['dn_entry_product_detail_f_rate']; ?>" readonly>
												</td>
												<td>																
													<input type="text" class="form-control" name="qty_<?php echo $i; ?>" id="qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdebitproduct[$i]['dn_entry_product_detail_qty']; ?>" onChange="return product_count(this.value,this,<?php echo $i; ?>);">
												</td>
												<!-- Added by AuthorsMM -->
												<td>																
													<input type="text" class="form-control" name="feet_<?php echo $i; ?>" id="feet_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editdebitproduct[$i]['dn_entry_product_detail_feet_per_qty']; ?>" onChange="return total_feet(this.value,this,<?php echo $i; ?>);" readonly />
												</td>
												<?php
													$qty = $editdebitproduct[$i]['dn_entry_product_detail_qty']=="" || $editdebitproduct[$i]['dn_entry_product_detail_qty'] <= 0 ? 0 : $editdebitproduct[$i]['dn_entry_product_detail_qty'];
													$total_feet = $qty * $editdebitproduct[$i]['dn_entry_product_detail_feet_per_qty'];
												?>
												<td>																
													<input type="text" class="form-control" name="total_feet_<?php echo $i; ?>" id="total_feet_<?php echo $i; ?>" value="<?php echo $total_feet; ?>" readonly />
												</td>
												<!-- End -->
												<td>																
													<input type="text" class="form-control" name="tot_amount_cur_<?php echo $i; ?>" id="tot_amount_cur_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editdebitproduct[$i]['dn_entry_product_detail_tot_amount_cur']); ?>" onChange="return product_count(this.value,this,<?php echo $i; ?>);">
												</td>
												<td>																
													<input type="text" class="form-control" name="tot_amount_<?php echo $i; ?>" id="tot_amount_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editdebitproduct[$i]['dn_entry_product_detail_tot_amount']); ?>" onChange="return product_count(this.value,this,<?php echo $i; ?>);">
												</td>
												
												<td></td>
												<!--<td><?php if($count_id>1){?><a href="index.php?grnProdId=<?=$editdebitproduct[$i]['grnProdId']?>&grnId=<?=$editReceipt['grnId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>-->
												
												</tr>
											<?php   }
												  }else{
												 ?>	
												 <!--<tr>
													<td colspan="9" style="text-align:center">No record founds</td>
												</tr>-->
											 <?php }
											 ?>	
											</tbody>	
																						
										</table>	

										</div>
									
								</div>

								<div   class="panel panel-info" id="child_product_detail_panel" <?php if($entryoneid==1){?> style="display:block" <?php }else{?> style="display:none" <?php }?> >
								
									<div class="panel-heading">	
										Child Product Details								 
									</div>

									<div class="col-lg-6">
										
										<button type="button" onClick="GetCDetail();" data-toggle="modal" data-target="#CmyModal" data-id="1" class="glyphicon glyphicon-plus"></button>

									</div>

									<div class="panel-body" >
										<div  style="width:100%; overflow:auto;">													
										<table id="child_receipt_table" class="table table-striped table-bordered table-hover">
										

												<thead>
													<tr>
													<th style="width:10%;vertical-align:middle;" nowrap="nowrap" class="text-center">Code</th>
													<th style="vertical-align:middle;" nowrap="nowrap">Product Name</th>
													<th nowrap="nowrap"  style="vertical-align:middle;" class="text-center">Color</th>
													<th class="text-center" nowrap="nowrap" style="vertical-align:middle;">Thick</th>
													<th class="text-center" style="vertical-align:middle;">Width</th>
													<th class="text-center" style="vertical-align:middle;">Length</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">UOM</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">QTY</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Rate</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Frg Rate</th>
													<th class="text-center" style="vertical-align:middle;">Debit Width</th>
													<th class="text-center" style="vertical-align:middle;">Debit Note Length</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Debit Weight</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Amount By</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Amount By <br />MMK</th>
												</tr>
												<!--<tr>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Inches</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">MM</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Feet</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">METER</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Ton</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">KG</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Inches</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">MM</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Feet</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Feet.In</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">METER</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">KG</th>
													<th nowrap="nowrap" style="vertical-align:middle;" class="text-center">Ton</th>
													
												</tr>-->
												</thead>
												<tbody>
												<?php $count_val = !empty($editdebitproductChild) ? count($editdebitproductChild) :'';
													if(0<$count_val){

												 	  for($i=0;$i<count($editdebitproductChild);$i++){												
												 ?>
													
														<tr>
															<td><?php echo $editdebitproductChild[$i]['product_con_entry_child_product_detail_code']; ?>
																<input type="hidden" id="c_invoice_id_<?php echo $editdebitproductChild[$i]['dne_child_detail_pro_dteial_id']; ?>" name ="c_invoice_id_<?php echo $editdebitproductChild[$i]['dne_child_detail_pro_dteial_id']; ?>" value="" />
																<input type="hidden" name="dne_child_detail_product_id[]" id="dne_child_detail_product_id_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_product_id']; ?>"  />
																
																<input type="hidden" name="dne_child_detail_id[]" id="dne_child_detail_id<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_id']; ?>" />
																
																<input type="hidden" name="dne_child_detail_code[]" id="dne_child_detail_code_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_id']; ?>"/>
																
																<input type="hidden" name="dne_child_detail_pro_dteial_id[]" id="dne_child_detail_pro_dteial_id_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_pro_dteial_id']; ?>"  />
															</td>
															
															<td><?php echo $editdebitproductChild[$i]['product_con_entry_child_product_detail_name']; ?><input type="hidden" name="dne_child_detail_name[]" id="dne_child_detail_name_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_product_id']; ?>"/></td>
															
															<td><?php echo $editdebitproductChild[$i]['product_colour_name']; ?><input type="hidden" name="dne_child_detail_color_id[]" id="dne_dne_child_detail_color_id_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_color_id']; ?>"/>  </td> 
															
															<td><?php echo $arr_thick[$editdebitproductChild[$i]['product_con_entry_child_product_detail_thick_ness']]; ?><input type="hidden" name="dne_child_detail_thick[]" id="dne_child_detail_thick_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['product_con_entry_child_product_detail_thick_ness']; ?>" class="form-control"  /></td>
															
															<td>
																<b>Inches</b>
																<input type="text" name="dne_child_detail_width_inches[]" id="dne_child_detail_width_inches_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_width_inches']; ?>" class="form-control normal-txtbox" onBlur="GetWcalc(2,'<?php echo $i; ?>');" readonly />
																<b>MM</b>
																<input type="text" name="dne_child_detail_width_mm[]" id="dne_child_detail_width_mm_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_width_mm']; ?>" class="form-control normal-txtbox" onBlur="GetWcalc(3,'<?php echo $i; ?>');" readonly />
															</td>
															
															<td>
																<b>Feet</b>
																<input type="text" name="dne_child_detail_length_feet[]" id="dne_child_detail_length_feet_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_length_feet']; ?>" class="form-control normal-txtbox" onBlur="GetCLcalc(1,'<?php echo $i; ?>');" readonly />
																<b>METER</b>
																<input type="text" name="dne_child_detail_length_mm[]" id="dne_child_detail_length_mm_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_length_mm']; ?>"  class="form-control normal-txtbox" onBlur="GetCLcalc(3,'<?php echo $i; ?>')" readonly />
															</td>
															
															<td>
																<?php echo $editdebitproductChild[$i]['dne_child_detail_uom_id']; ?>
																<input type="hidden" name="dne_child_detail_uom_id[]" id="dne_child_detail_uom_id_<?php echo $i; ?>" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_uom_id']; ?>" class="form-control"  />
															</td>
															
															<td>
																<b>Ton</b>
																<input type="text" name="dne_child_detail_ton_qty[]" id="dne_child_detail_ton_qty_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_ton_qty']; ?>"  readonly />
																<b>KG</b>
																<input type="text" name="dne_child_detail_kg_qty[]" id="dne_child_detail_kg_qty_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_kg_qty']; ?>" readonly />
															</td> 
															
															<td>
																<input type="text" name="dne_child_detail_rate[]" id="dne_child_detail_rate_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_rate']; ?>" style="margin-top:20px;" readonly />
															</td> 
															
															<td>																
																<input type="text" name="dne_child_detail_frg_rate[]" id="dne_child_detail_frg_rate_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_frg_rate']; ?>" style="margin-top:20px;" readonly />
															</td>
															
															<td>
																<b>Inches</b>
																<input type="text" name="dne_child_detail_dw_inches[]" id="dne_child_detail_dw_inches_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_dw_inches']; ?>" onBlur="GetLcalD(2,'<?php echo $i; ?>'),GetWeightClc(1,'<?php echo $i; ?>')" />
																<b>MM</b>
																<input type="text" name="dne_child_detail_dw_mm[]" id="dne_child_detail_dw_mm_<?php echo $i; ?>" class="form-control normal-txtbox" onBlur="GetLcalD(3,'<?php echo $i; ?>'),GetWeightClc(1,'<?php echo $i; ?>')" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_dw_mm']; ?>"  />
															</td>
															
															<td>
																<b>Feet</b>
																<input type="text" name="dne_child_detail_dnl_feet[]" id="dne_child_detail_dnl_feet_<?php echo $i; ?>" class="form-control normal-txtbox"  onBlur="GetDFeet(1,'<?php echo $i; ?>'),GetWeightClc(1,'<?php echo $i; ?>')" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_dnl_feet']; ?>" />
																<!--<b>Feet.In</b>-->
																<input type="hidden" name="dne_child_detail_dnl_feet_ing[]" id="dne_child_detail_dnl_feet_ing_<?php echo $i; ?>" class="form-control normal-txtbox"  onBlur="GetDFeet(2,'+i+')" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_dnl_feet_ing']; ?>" />
																<b>METER</b>
																<input type="text" name="dne_child_detail_dnl_m[]" id="dne_child_detail_dnl_m_<?php echo $i; ?>" class="form-control normal-txtbox"   onBlur="GetDFeet(3,'<?php echo $i; ?>')" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_dnl_m']; ?>" />
															</td>
															
															<td>
																<b>KG</b>
																<input type="text" name="dne_child_detail_dw_kg[]" id="dne_child_detail_dw_kg_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_dw_kg']; ?>"  readonly />
																<b>Ton</b>
																<input type="text" name="dne_child_detail_dnl_dw_ton[]" id="dne_child_detail_dnl_dw_ton_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo $editdebitproductChild[$i]['dne_child_detail_dnl_dw_ton']; ?>"   readonly />
															</td>
															
															<td>
																<input type="text" name="dne_child_detail_amount_cur[]" id="dne_child_detail_amount_cur_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo round($editdebitproductChild[$i]['dne_child_detail_amount_cur']); ?>" style="margin-top:20px;"  readonly />
															</td>
															<td>
																<input type="text" name="dne_child_detail_amount[]" id="dne_child_detail_amount_<?php echo $i; ?>" class="form-control normal-txtbox" value="<?php echo round($editdebitproductChild[$i]['dne_child_detail_amount']); ?>"  style="margin-top:20px;" readonly />
															</td>
														
															
														</tr>

													<?php 
														} 
													}
													?>

												</tbody>
										</table>	
										</div>				
									</div>									
									
								</div>

							</div>
							
							<div class="col-lg-6">
								<?php  $btnVal = (!$dn_entry_id)?  'Save' : 'Update' ; ?>
								<button name="dne_insrtUpdate" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
								<button type="reset" class="btn btn-danger">Reset </button>
								<input type="button" class="btn " onClick="location.href='index.php'" value="Back">
							</div>
							
						</div>

					</form>	

				<?php 
					}else{ 
					?>			
					
						<div class="panel panel-default">
							
							<div class="panel-heading">
								Debit note list
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

											<label class="control-label">Supplier Name</label>

											
											<select name="search_supplier_id" id="search_supplier_id" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													
													foreach($supplier_list as $get_value){
													$selected	= ($get_value['supplier_id'] == searchValue('search_supplier_id'))?'selected="selected"':'';
													
													?>
														<option value="<?=$get_value['supplier_id']?>" <?=$selected?>><?=$get_value['supplier_name']?></option>
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
								<div class="col-lg-12" style="text-align:right">
									<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
								</div>
								&nbsp;
								<div class="table-responsive">
								<?php if(isset($_REQUEST['search'])){?>
									<form name="grn-form" id="grn-form" action="index.php" method="post">
									<table class="table table-striped table-bordered table-hover" id="dataTables-eva-grn">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>DN id</th>	
												<th>PO id</th>	
												<th>Supplier</th>									
												<th>Type</th>
												<th>Branch</th>
												<th>Date</th>
												<th>Action</th>
												<th>
												<input name="checkall" onClick="checkedall();" type="checkbox"  />
												<button name="grn_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($reqRecList as $result){
												if($result['dn_entry_type_one_id']=='1'){
													$debit_type	= "Raw Material";
												}
												else{
													$debit_type	= "Accessories";
												}
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo substr(('00000'.$result['dn_entry_id']),-5); ?></td>
												<td><?php echo $result['invoiceNo']; ?></td>
												<td><?php echo $result['supplier_name']; ?></td>
												<td><?php echo $debit_type; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['dn_entry_date']; ?></td>
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['dn_entry_id']?>" title="" class="glyphicon glyphicon-pencil pull-left"	
												</td>
												<td>
												<input name="deleteCheck[]" value="<?php echo $result['dn_entry_id']; ?>" type="checkbox" />
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

				<?php } ?>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
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
								<div class="text-center h4">
									
									<img src="../images/loading.gif" /><br />
									<small>Loading Products...</small>
								</div>
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
		<div class="modal fade" id="CmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">
			<div class="modal-dialog" style="width: 800px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Child Product Detail</h4>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<div id="child-dynamic-content">
								<div class="text-center h4">
									
									<img src="../images/loading.gif" /><br />
									<small>Loading Products...</small>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onClick="AddCproductDetail()"  data-dismiss="modal">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
	
	<script>				
		
		$(document).ready(function () {
			
			$('#dataTables-eva-grn').DataTable( {
				responsive: true
			} );
			
			
			var from = $('#pic_from').val();
			var to	 = $('#pic_to').val();
			
			$( "#grn_date" ).datepicker({
				dateFormat:'dd/mm/yy',
				minDate:from,
				maxDate:''
			});
			
			$( "#production_planning_from_date" ).datepicker({
				dateFormat:'dd/mm/yy',
				minDate:from,
				maxDate:'', 
				onClose: function( selectedDate ) { 
					$( "#production_planning_to_date" ).datepicker( "option", "minDate", selectedDate )
				}
			});

			$( "#production_planning_to_date" ).datepicker({
				dateFormat:'dd/mm/yy',
				minDate:from, 
				maxDate:'',
				onClose: function( selectedDate ) { 
					$( "#production_planning_from_date" ).datepicker( "option", "maxDate", selectedDate )
				}
			});


			$( "#grn-forms" ).validate({
				 
				  highlight: function (element, errorClass) {
					$(element).closest('.form-group').addClass('has-error');
				  },
				  unhighlight: function (element, errorClass) {
						$(element).closest('.form-group').removeClass('has-error');
				  },
				  errorPlacement: function(error, element){}
			});



			$(".select2").select2();
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

 
