<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GOOD RECEIPT NOTE</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-grn/eva-grn-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">GOOD RECEIPT NOTE</h1>
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
						<input type="hidden" name="id" value="<?php  echo $id = empty($editReceipt['grnId'])?"":$editReceipt['grnId']; ?>" >

						<div class="row">
						
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Goods receipt note								 
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required onChange="get_po(this.value);">
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editReceipt['grn_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
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
														if($editReceipt['grn_purchaseId'] == $get_po['invoiceId']){ $select ='selected="selected"'; }else{ $select="";}
														?>
												<option <?php echo $select;?>  value="<?=$get_po['invoiceId']?>"><?=$get_po['invoiceNo'].' - '.$get_po['supplier_name']?></option>
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
														if($editReceipt['grn_warehouseid'] == $get_godown['godown_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
													<?php
														}
													?>
												</select>
													
											</div>	
											<div class="form-group">
												<label>GRN type</label>
												<input type="text" class="form-control"  name="grn_type" id="grn_type" readonly value="<?php echo empty($editReceipt['grn_grn_type'])?"":$editReceipt['grn_grn_type']; ?>">
													
											</div>	
											
											
											<div class="form-group">
												<label class="control-label">Type</label>
												<select name="typ" id="typ" class="form-control" style="width:100%" required onChange="return get_typ(this.value);">
												<option value=""> - Select - </option>
												<?php echo $typ = empty($editReceipt['grn_typ'])?"0":$editReceipt['grn_typ']; ?>													
													  <option <?php if($typ==3){?> selected="selected" <?php }?> value="3">Finished products</option>
													  <option <?php if($typ==2){?> selected="selected" <?php }?>value="2">Raw products</option>
													  <option <?php if($typ==1){?> selected="selected" <?php }?>value="1">Accessories</option>
												</select>
											</div>		
										</div>																				
										<div class="col-lg-6">
											<div class="form-group">
												<label class="control-label">GRN Date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control"  name="grn_date" id="grn_date" readonly value="<?php echo empty($editReceipt['grn_date'])?date('d/m/Y'):$editReceipt['grn_date']; ?>" required>	
												</div>
											</div>	
											
											<div class="form-group">
												<label>Supplier location</label>
												<?php  $val = empty($editReceipt['supplier_location'])?"":$editReceipt['supplier_location']; ?>
												<input type="text" class="form-control"  name="supplier_location" id="supplier_location" readonly value="<?php echo $val==1?"Loacl":($val==2?"Oversea":""); ?>">	
													
											</div>	
											<div class="form-group">
												<label>Supplier name</label>
												<input type="text" class="form-control"  name="supplier_name" id="supplier_name" readonly value="<?php echo empty($editReceipt['supplier_name'])?"":$editReceipt['supplier_name']; ?>">	
													
											</div>			
											<div class="form-group">
												<label>PO date</label>
												<input type="text" class="form-control"  name="po_date" id="po_date" readonly value="<?php echo empty($editReceipt['pR_purchase_date'])?"":$editReceipt['pR_purchase_date']; ?>">	
													
											</div>			
									
									</div>		
								</div>
								
								</div>
								
								<div class="panel panel-info" id="finishgoods" <?php if($typ==2){?> style="display:none" <?php }?>>
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									<div class="col-lg-6">
									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
									</div>
									<div class="panel-body">
										<table id="receipt_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php   $count_val = !empty($editReceiptProd) ? count($editReceiptProd) :'';  ?>
											<input type="hidden" id="receipt_apnd" name="receipt_count" value="<?php echo (0<$count_val ? $count_val :0); ?>">
												<tr>
													<th rowspan="2" style="width:20%;vertical-align:middle;" class="text-center">Product Name</th>
													<th rowspan="2" style="vertical-align:middle;" class="text-center">Code</th>
													<th rowspan="2" style="width:10%;vertical-align:middle;" class="text-center">UOM</th>
													<th rowspan="2" style="vertical-align:middle;" class="text-center">PO qty</th>													
													<th colspan="5" style="vertical-align:middle;" class="text-center">Quantity</th>
													<th rowspan="2" id="feet_th" <?php if($typ!=1){?> style="vertical-align:middle;display:none" <?php } else { ?> style="vertical-align:middle;" <?php } ?> class="text-center">Feet</th>													
												</tr>
												<tr>
													<th class="text-center">Recvd earlier</th>
													<th class="text-center">Current supply</th>
													<th class="text-center">Reject</th>
													<th class="text-center">Accept</th>
													<th class="text-center" style="border:solid 1px #ddd;">Pending</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
													$count_id = count($editReceiptProd);
												   for($k=1;$k<=count($editReceiptProd);$k++){	$i=$k-1;											
												 ?>
											 <tr id="remove_req_<?php echo $i; ?>">
												<td><?php echo $editReceiptProd[$i]['product_name']; ?>
												<input type="hidden" name="arr_count[]" value="<?php echo $i; ?>">
													<input type="hidden" name="pid_<?php echo $i; ?>" value="<?php echo $editReceiptProd[$i]['grnProdId']; ?>">																
													<input type="hidden" class="form-control" name="productid_<?php echo $i; ?>" id="productid_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editReceiptProd[$i]['grnP_product_id']; ?>">
													
												</td> 
												
												<td><?php echo $editReceiptProd[$i]['product_code']; ?></td>
												
												<td><?php echo $editReceiptProd[$i]['product_uom_name']; ?></td>
												
												<td>																
													<input type="text" class="form-control" name="po_qty_<?php echo $i; ?>" id="po_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editReceiptProd[$i]['grnP_poqty']; ?>" readonly>
												</td>
												
												<td>																
													<input type="text" class="form-control" name="received_qty_<?php echo $i; ?>" id="received_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editReceiptProd[$i]['grnP_received_earlier']; ?>" readonly>
												</td>
												
												<td>																
													<input type="text" class="form-control" name="current_qty_<?php echo $i; ?>" id="current_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editReceiptProd[$i]['grnP_curnt_supply']; ?>" onChange="return product_count(this.value,this,<?php echo $i; ?>);">
												</td>
												
												<td>																
													<input type="text" class="form-control" name="reject_qty_<?php echo $i; ?>" id="reject_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editReceiptProd[$i]['grnP_reject']; ?>" onChange="return product_count(this.value,this,<?php echo $i; ?>);">
												</td>
												<td>																
													<input type="text" class="form-control" name="accept_qty_<?php echo $i; ?>" id="accept_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editReceiptProd[$i]['grnP_accept']; ?>" readonly>
												</td>
												<td>																
													<input type="text" class="form-control" name="pending_qty_<?php echo $i; ?>" id="pending_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editReceiptProd[$i]['grnP_pending']; ?>" readonly>
												</td>
												
												<!-- Added by AuthorsMM -->
												<td class="feet_td" <?php if($typ!=1){?> style="display:none;" <?php } ?>>
													<b>Feet/Qty</b>
													<input type="text" class="form-control feet normal-txtbox" name="feet_<?php echo $i; ?>" id="feet_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editReceiptProd[$i]['grnP_feet_per_qty']; ?>" readonly />
													<?php
														$qty = $editReceiptProd[$i]['grnP_accept']=="" || $editReceiptProd[$i]['grnP_accept'] <= 0 ? 0 : $editReceiptProd[$i]['grnP_accept'];
														$total_feet = $qty * $editReceiptProd[$i]['grnP_feet_per_qty'];
													?>
													<b>Total Feet</b>
													<input type="text" class="form-control total_feet normal-txtbox" name="total_feet_<?php echo $i; ?>" id="total_feet_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $total_feet; ?>" readonly />
												</td>
												<!-- End -->
												
												<td><?php if($count_id>1){?><a href="index.php?grnProdId=<?=$editReceiptProd[$i]['grnProdId']?>&grnId=<?=$editReceipt['grnId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
												
												
												</tr>
											<?php   }
												  }else{
												 ?>	
												 <!--<tr>
													<td colspan="10" style="text-align:center">No record founds</td>
												</tr>-->
											 <?php }
											 ?>	
											</tbody>	
											<tfoot>
												<tr>
													<th style="text-align:right;">Remarks</th>
													<th colspan="9"><textarea class="form-control pull-right" rows="1" name="remark" id="remark"><?php echo empty($editReceipt['grn_remarks'])?"":$editReceipt['grn_remarks']; ?></textarea>	
													</th>
												</tr>
											</tfoot>											
										</table>					
									</div>
									
								</div>
								<div class="panel panel-info" id="rawgoods" <?php if($typ==2){?> style="display:block" <?php }else{?> style="display:none"<?php }?>>
								
									<div class="panel-heading">	
										Child Product Details	
										<?php 
											$ft_total = 0;
											$m_total = 0;
											$ton_total = 0;
											$kg_total = 0;
										?>
									</div>
									<div class="col-lg-6">
									<button type="button" onClick="GetCDetail();" data-toggle="modal" data-target="#CmyModal" data-id="1" class="glyphicon glyphicon-plus"></button>
									</div>
									<div class="panel-body">
										<table id="child_receipt_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val_chld = !empty($editReceiptProdChild) ? count($editReceiptProdChild) :''; ?>
											<input type="hidden" id="child_receipt_apnd" name="child_receipt_count" value="<?php echo (0<$count_val_chld ? $count_val_chld :1); ?>">
												<tr>
													<th rowspan="2" style="vertical-align:middle;" class="text-center">Code</th>
													<th rowspan="2" style="vertical-align:middle;" class="text-center">Product Name</th>
													<th rowspan="2" style="vertical-align:middle;" class="text-center">Color</th>
													<th rowspan="2" style="vertical-align:middle;" class="text-center">Thick</th>
													<th rowspan="2" style="vertical-align:middle;" class="text-center">UOM</th>
													<th colspan="2" style="vertical-align:middle;" class="text-center">Width</th>
													<th colspan="2" style="vertical-align:middle;" class="text-center">Length</th>
													<th colspan="2" style="vertical-align:middle;" class="text-center">QTY</th>
												</tr>
												<tr>
													<th class="text-center">Inch</th>
													<th class="text-center">MM</th>
													<th class="text-center">Feet</th>
													<th class="text-center">M</th>
													<th class="text-center">Ton</th>
													<th class="text-center">KG</th>
												</tr>
											</thead>
												<tbody>
												<?php 
												
													if(0<$count_val_chld){ $j=0;
													$count_child_id = count($editReceiptProdChild);
												   foreach($editReceiptProdChild as $editChild){													
												 ?>
											 <tr id="remove_child_req_<?php echo $j; ?>">
											 
											 <td><input type="hidden" name="grn_child_product_detail_code[]" id="grn_child_product_detail_code_<?=$j?>" value="<?=$editChild['grn_child_product_detail_code']?>" class="form-control"  />	
											 <input type="hidden" name="grn_child_product_detail_product_id[]" id="grn_child_product_detail_product_id_<?=$j?>" value="<?=$editChild['grn_child_product_detail_product_id']?>"  /><input type="hidden" name="grn_child_product_detail_inv_detail_id[]" id="grn_child_product_detail_inv_detail_id_'+i+'" value=" <?=$editChild['grn_child_product_detail_inv_detail_id']?>"  />
											 <?=$editChild['grn_child_product_detail_code']?>
											 </td>
											 
												<td><?php echo $editChild['grn_child_product_detail_name']; ?>
												<input type="hidden" name="grn_child_product_detail_name[]" id="grn_child_product_detail_name<?=$j?>" value="<?php echo $editChild['grn_child_product_detail_name']; ?>" class="form-control"  />																
													
												</td>
												
												<td><input type="hidden" name="grn_child_product_detail_color_id[]" id="grn_child_product_detail_color_id_<?=$j?>" value="<?= $editChild['grn_child_product_detail_color_id']; ?>"/><?=$editChild['product_colour_name']?> </td>
												
												<td>																
													<input type="hidden" name="grn_child_product_detail_thick_ness[]" id="grn_child_product_detail_thick_<?=$j?>" value="<?=$editChild['grn_child_product_detail_thick_ness']?>" class="form-control"  />
													<?=$arr_thick[$editChild['grn_child_product_detail_thick_ness']]?>
												</td>
												
												<td>																
													<input type="hidden" name="grn_child_product_detail_uom_id[]" id="grn_child_product_detail_uom_id_<?=$j?>" value="<?=$editChild['grn_child_product_detail_uom_id']?>" class="form-control"  />
													<?=$editChild['product_uom_name']?>
												</td>
												
												<td>																
													<input type="text" name="grn_child_product_detail_width_inches[]" id="grn_child_product_detail_width_inches_<?=$j?>" value="<?=number_format($editChild['grn_child_product_detail_width_inches'])?>" class="form-control" onBlur="GetWcalc(2,<?=$j?>);" readonly />
												</td>
												
												<td>																
													<input type="text" name="grn_child_product_detail_width_mm[]" id="grn_child_product_detail_width_mm_<?=$j?>" value="<?=number_format($editChild['grn_child_product_detail_width_mm'])?>" class="form-control" onBlur="GetWcalc(3,<?=$j?>);" readonly />
												</td>
												<?php 
													$ft_total = $ft_total + $editChild['grn_child_product_detail_length_feet'];
													$m_total = $m_total + $editChild['grn_child_product_detail_length_mm'];
													$ton_total = $ton_total + $editChild['grn_child_product_detail_ton_qty'];
													$kg_total = $kg_total + $editChild['grn_child_product_detail_kg_qty'];
												?>
												<td>																
													<input type="text" name="grn_child_product_detail_length_feet[]" id="grn_child_product_detail_length_feet_<?=$j?>" value="<?=$editChild['grn_child_product_detail_length_feet']?>" class="form-control" onBlur="GetCLcalc(1,<?=$j?>);" readonly />
												</td>
												<td>																
													<input type="text" name="grn_child_product_detail_length_mm[]" id="grn_child_product_detail_length_mm_<?=$j?>" value="<?=$editChild['grn_child_product_detail_length_mm']?>" class="form-control" onBlur="GetCLcalc(3,<?=$j?>);" readonly />
												</td>
												<td>																
													<input type="text" name="grn_child_product_detail_ton_qty[]" id="grn_child_product_detail_ton_qty_<?=$j?>" value="<?=$editChild['grn_child_product_detail_ton_qty']?>" class="form-control" onBlur="GetWeightClc(<?=$j?>,1)" readonly />
												</td>
												<td>																
													<input type="text" name="grn_child_product_detail_kg_qty[]" id="grn_child_product_detail_kg_qty_<?=$j?>" value="<?=$editChild['grn_child_product_detail_kg_qty']?>" class="form-control"  onBlur="GetWeightClc(<?=$j?>,2)" readonly />
												</td>
												<td>
												<input type="hidden" name="grn_child_product_detail_id[]" id="grn_child_product_detail_id_<?=$j?>" value="<?=$editChild['grn_child_product_detail_id']?>" />
												<?php if($count_child_id>1){?><a href="index.php?grnProdChildId=<?=$editChild['grn_child_product_detail_id']?>&grnId=<?=$editReceipt['grnId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
												
												</tr>
											<?php   $j = $j + 1;}
												  }else{
												 ?>	
												 <tr>
													<td colspan="11" style="text-align:center">No record founds</td>
												</tr>
											 <?php }
											 ?>	
											</tbody>
											<tfoot>
											<!-- Added By AuthorsMM for Total values -->
											<tr style="border:solid 1px #ddd;">
												<th colspan="7" class="text-right"><b>Total</b></th>
												<th class="ft_total text-right"><?php echo $ft_total; ?></th>
												<th class="m_total text-right"><?php echo $m_total; ?></th>
												<th class="ton_total text-right"><?php echo $ton_total; ?></th>
												<th class="kg_total text-right"><?php echo $kg_total; ?></th>
											</tr>
											<!-- END for Total values -->
										</tfoot>
																						
										</table>					
									</div>
									
								</div>
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="receipt_insrtUpdate" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
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
								Receipt list
							</div>
							<form action="index.php" method="post" id="so_list_form" name="so_list_form" >

                                <div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" >

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
												<th>Receipt id</th>	
												<th>PO id</th>	
												<th>Supplier</th>									
												<th>Warehouse</th>
												<th>Branch</th>
												<th>Date</th>
												<th>Print</th>
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
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['grnId']; ?></td>
												<td><?php echo $result['invoiceNo']; ?></td>
												<td><?php echo $result['supplier_name']; ?></td>
												<td><?php echo $result['godown_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['grn_date']; ?></td>
												<td><a href="eva-grn-print.php?id=<?php echo $result['grnId']?>" title="INVOICE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['grnId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
												<input name="deleteCheck[]" value="<?php echo $result['grnId']; ?>" type="checkbox" />
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</form>
									<?php } ?>
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
<?php /*<script src="../assets/js/jquery-1.10.2.js"></script>
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
	<script src="../plugins/iCheck/icheck.min.js"></script>
	<script src="../plugins/select2/select2.full.min.js"></script>

	<!-- bootstrap datepicker -->
	<script src="../plugins/daterangepicker/daterangepicker.js"></script>
	<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="../assets/js/jquery-DOM.js"></script>
	<script src="../assets/js/jquery.timepicker.js"></script>*/?>

	
	
	
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
	<script>
		$(document).ready(function () {
			$('#dataTables-eva-grn').DataTable( {
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
	 $(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#grn_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
		
			$( "#production_planning_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#production_planning_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
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
		
		</script>

</body>

 
