<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PURCHASE ORDER</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-purchase-order/eva-po-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">PURCHASE ORDER</h1>
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
					<form name="purchase-entry-forms" id="purchase-entry-forms" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editPurchase['purchaseId'])?"":$editPurchase['purchaseId']; ?>" >

						<div class="row">
							
							<div id="request" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Purchase order					 
									</div>
									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editPurchase['pR_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											<div class="form-group">
												<label class="control-label">Supplier Location</label>
												<select name="supplier_location" id="supplier_location" class="form-control select2" style="width:100%" required onChange="return getsupplier(this.value);">
												<?php $slocation = empty($editPurchase['pR_supplier_location'])?"":$editPurchase['pR_supplier_location']; ?>
													 <option value=""> - Select - </option>
													  <option <?php if($slocation==1){?> selected="selected" <?php }?> value="1">Local</option>
													  <option <?php if($slocation==2){?> selected="selected" <?php }?>value="2">Oversea</option>
												</select>
											</div>		
											<div class="form-group">
												<label class="control-label">Supplier name</label>
												<select name="supplier_name" id="supplier_name" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
													
													foreach($supplier_list as $get_value){
														if($editPurchase['pR_supplier_id'] == $get_value['supplier_id']){ $select ='selected="selected"'; }else{  $select="";}
													?>
														<option <?php echo $select; ?> value="<?=$get_value['supplier_id']?>"><?=$get_value['supplier_name']?></option>
													<?php
														}
													?>
													
												</select>
											</div>		
											<div class="form-group">
												<label >Currency</label>
												<select name="currency" id="currency" class="form-control select2" style="width:100%" onChange="return currency_rate(this.value,this);" >
													 <option value=""> - Select - </option>
													
													
													<?php
													foreach($currency_list as $get_currency){
														if($editPurchase['pR_currency_id'] == $get_currency['currency_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_currency['currency_id']?>"><?=$get_currency['currency_name']?></option>
													<?php
														}
													?>
												</select>
											</div>	
											<?php $var = empty($editPurchase['pR_rate'])?"":$editPurchase['pR_rate']; ?>
											<div class="form-group" id="s_rate"<?php if(1<=$var){ ?>style="display:block;"<?php }else{?> style="display:none;" <?php }?>>
												<label>Rate</label>
												<input type="text" class="form-control"  name="rate" id="rate" value="<?php echo empty($editPurchase['pR_rate'])?"":$editPurchase['pR_rate']; ?>"  >	
											</div>	
											 <div class="form-group">
												<!-- added class="control-label" by AuthorsMM -->
												<label class="control-label">Brand</label>
												<!-- added 'required' by AuthorsMM -->
												<select name="po_brand_id" id="po_brand_id" class="form-control select2" style="width:100%"  required>
													 <option value=""> - Select - </option>
													<?php
													foreach($brand_list as $get_brand){
														if($editPurchase['pR_brand_id'] == $get_brand['brand_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_brand['brand_id']?>"><?=$get_brand['brand_name']?></option>
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
												  <input type="text" class="form-control rqrcdate"  name="purchase_date" id="purchase_date" readonly="" value="<?php echo empty($editPurchase['pR_purchase_date'])?date('d/m/Y'):dateGeneralFormatN($editPurchase['pR_purchase_date']); ?>" required >	
												</div>
											</div>	
											
											<div class="form-group">
												<label>Purchase order method</label>
												<select name="purchase_od_method" id="purchase_od_method" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													 <?php
														foreach($purchasemethod_array as $key=>$val){
															if($editPurchase['pR_purchase_od_method'] == $key){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$key?>"><?=$val?></option>
													<?php
														}
														?>
												</select>
											</div>		
											
											<div class="form-group">
												<label>Payment terms</label>
												<select name="payment_terms" id="payment_terms" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													 <?php
														foreach($paymentterms_array as $key=>$val){
															if($editPurchase['pR_payment_terms'] == $key){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$key?>"><?=$val?></option>
													<?php
														}
														?>
												</select>
											</div>	
											<div class="form-group">
												<label>Shipment no</label>
													<input type="text" class="form-control"  name="shipment_id" id="shipment_id" value="<?php echo empty($editPurchase['pR_shipment_id'])?"":$editPurchase['pR_shipment_id']; ?>"  >	
											</div>	
											<div class="form-group">
												<label>Arrival date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control rqrcdate"  name="arrival_date" id="arrival_date" readonly="" value="<?php echo empty($editPurchase['pR_arrival_date'])?"":dateGeneralFormatN($editPurchase['pR_arrival_date']); ?>"  >	
												</div>
											</div>		
										
										
									</div>
									
								</div>		
								</div>						
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									
									<div class="panel-body" style="overflow:auto">
										
										<table id="purcase_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val = !empty($editpurchaseProd) ? count($editpurchaseProd) :''; ?>
												<tr>
													<th style="width:20%; vertical-align:middle;" class="text-center">Product Name</th>
													<th  style="width:10%; vertical-align:middle;" class="text-center">Brand</th>
													<!--<th style="width:7%; vertical-align:middle;" class="text-center">Uom</th> -->
													<th style="width:8%; vertical-align:middle;" class="text-center">Rate</th>
													<th style="width:10%; vertical-align:middle;" class="text-center">Frg:rate</th>
													<th style="width:8%; vertical-align:middle;" class="text-center">Qty</th>
													<th style="width:8%; vertical-align:middle;" class="text-center">Feet</th>
													<th style="width:8%; vertical-align:middle;" class="text-center">Ton</th>
													<th style="width:8%; vertical-align:middle;" class="text-center">Kg</th>
													<th style="width:8%; vertical-align:middle;" nowrap="nowrap" class="text-center">Rate By <br />Currency</th>
													<th style="width:20%; vertical-align:middle;" nowrap="nowrap" class="text-center">Unit price</th>
													<th width="5%" class="text-center" style="vertical-align:middle;">
													<input type="hidden" id="product_apnd" name="product_count" value="<?php echo (0<$count_val ? $count_val :0); ?>">
													<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
													</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												
												
												if(0<$count_val){
												$count_id = count($editpurchaseProd);
												   for($i=1;$i<=count($editpurchaseProd);$i++){
													$j=$i-1;
												 ?>
												<tr id="remove_req_<?php echo $i; ?>">
												
													<td>
														<input type="hidden" name="arr_count[]" value="<?php echo $i; ?>" class="arr_count">
														<input type="hidden" name="prod_id_<?php echo $i; ?>" value="<?php echo $editpurchaseProd[$j]['pRp_product_id']; ?>" class="sd_id">
														<input type="hidden" name="pid_<?php echo $i; ?>" value="<?php echo $editpurchaseProd[$j]['purOrdPorductId']; ?>" class="pid" >																
														<div class="ui-widget"><input type="text" class="form-control prod_name" name="prod_name_<?php echo $i; ?>" id="prod_name_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editpurchaseProd[$j]['product_name']; ?>" style="min-width:150px;">
														</div>
													</td>
													<td  id="prod_brand_<?php echo $i; ?>" class="prod_brand_td">																
														<input type="text" class="form-control prod_brand" name="prod_brand_<?php echo $i; ?>" id="prod_brand_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editpurchaseProd[$j]['brand_name']; ?>" readonly="" style="min-width:120px;">
														
														<input type="hidden" name="prod_uom_<?php echo $i; ?>" id="prod_uom_<?php echo $i; ?>" value="<?php echo $editpurchaseProd[$j]['product_uom_name']; ?>">
													</td>
													<!--<td  id="prod_uom_<?php echo $i; ?>" class="prod_uom_td">																
														<input type="text" class="form-control prod_uom" name="prod_uom_<?php echo $i; ?>" id="prod_uom_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editpurchaseProd[$j]['product_uom_name']; ?>" readonly="" style="min-width:60px;">
													</td>-->												
													
													
													<td>																
														<input type="text" class="form-control rate" style="text-align:right;width:80px;" name="rate_<?php echo $i; ?>" id="rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo number_format($editpurchaseProd[$j]['pRp_rate']); ?>" onChange="return get_currency_amt(<?php echo $i; ?>),amnt_calulation_Qty(this.value,this,<?php echo $i; ?>,1);">
													</td>
													<td>																
														<input type="text" class="form-control frignrate" style="text-align:right;width:90px;" name="frignrate_<?php echo $i; ?>" id="frignrate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo number_format($editpurchaseProd[$j]['pRp_frignrate'],2); ?>" onChange="return amnt_calulation_Qty(this.value,this,<?php echo $i; ?>,2);">
													</td>
													<!--<td>																
														<input type="text" class="form-control" name="stock_<?php echo $i; ?>" id="stock_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editpurchaseProd[$j]['iRp_qty']; ?>">
													</td>-->
													<td>																
														<input type="text" style="width:70px;" class="form-control qty" name="qty_<?php echo $i; ?>" id="qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editpurchaseProd[$j]['pRp_qty']; ?>"   onBlur="return get_currency_amt(<?php echo $i; ?>);">
													</td>
													
													<!-- Added by AuthorsMM -->
													<td>
														<b>Feet/Qty</b>
														<input type="text" style="width:90px;" class="form-control feet normal-txtbox" name="feet_<?php echo $i; ?>" id="feet_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editpurchaseProd[$j]['pRp_feet_per_qty']; ?>"   onBlur="return get_total_feet(<?php echo $i; ?>);">
														<?php
															$qty = $editpurchaseProd[$j]['pRp_qty']=="" || $editpurchaseProd[$j]['pRp_qty'] <= 0 ? 0 : $editpurchaseProd[$j]['pRp_qty'];
															$total_feet = $qty * $editpurchaseProd[$j]['pRp_feet_per_qty'];
														?>
														<b>Total Feet</b>
														<input type="text" class="form-control total_feet normal-txtbox" name="total_feet_<?php echo $i; ?>" id="total_feet_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $total_feet; ?>" readonly />
													</td>
													<!-- End -->
													
													<td><input type="text" style="width:90px;" class="form-control prod_ton" name="prod_ton_<?php echo $i; ?>" id="prod_ton_<?php echo $i; ?>"  onBlur="return ton_calculation(<?=$i?>,1),get_currency_amt(<?php echo $i; ?>),amnt_calulation_Qty(this.value,this,<?php echo $i; ?>,2);" value="<?php echo $editpurchaseProd[$j]['pRp_ton']; ?>"></td>
													<td><input style="width:100px; type="text" class="form-control prod_kg" name="prod_kg_<?php echo $i; ?>" id="prod_kg_<?php echo $i; ?>"  onBlur="return ton_calculation(<?=$i?>,2);" value="<?php echo $editpurchaseProd[$j]['pRp_kg']; ?>"></td>
													
													<td >																
														<input type="text" class="form-control unit_cur_amnt" style="text-align:right;width:120px;" name="rate_by_currency_<?php echo $i; ?>" id="rate_by_currency_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo number_format($editpurchaseProd[$j]['pRp_rate_by_currency'],2); ?>">
													</td>
													<td>																
														<input type="text" class="form-control unit_amnt" style="text-align:right; width:130px;" name="unitprice_<?php echo $i; ?>" id="unitprice_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo number_format($editpurchaseProd[$j]['pRp_unitprice']); ?>">
													</td>
													<td><?php if($count_id>1){?>
													<a href="index.php?purOrdPorductId=<?=$editpurchaseProd[$j]['purOrdPorductId']?>&purchaseId=<?php echo $editPurchase['purchaseId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a>	<?php } ?>
													</td>
												</tr>
											<?php   }
												  }
											 ?>	
											</tbody>	
											<tfoot>
												<tr>
													
													<th colspan="8" style="text-align:right;">Total</th>
													<th colspan="">
													<input type="text" class="form-control" style="text-align:right" name="tot_amount" id="tot_amount"  onkeypress="return o_obj.Alpha_Numeric(this,event);"  value="<?php echo empty($editPurchase['pR_tot_amount'])?"":number_format($editPurchase['pR_tot_amount'],2); ?>"  ></th><th>
													<input type="text" class="form-control" style="text-align:right" name="total_amnt" id="total_amnt"  onkeypress="return o_obj.Alpha_Numeric(this,event);"  value="<?php echo empty($editPurchase['pR_totalAmnt'])?"":number_format($editPurchase['pR_totalAmnt']); ?>"  ></th>
												
												</tr>
												<tr>
													
													<th colspan="8" style="text-align:right;">Advance</th>
													<th colspan="">
													<input type="text" class="form-control"  style="text-align:right"  name="advance_amount" id="advance_amount"  onkeypress="return o_obj.Alpha_Numeric(this,event);"  value="<?php echo empty($editPurchase['pR_advanceAmnt'])?"":number_format($editPurchase['pR_advance_amount'],2); ?>" onKeyUp="net_amount();" ></th><th>
													<input type="text" class="form-control"  style="text-align:right"  name="advance_amnt" id="advance_amnt"  onkeypress="return o_obj.Alpha_Numeric(this,event);"  value="<?php echo empty($editPurchase['pR_advanceAmnt'])?"":number_format($editPurchase['pR_advanceAmnt']); ?>" onKeyUp="get_net_amt();" ></th>
													
												</tr>
												<tr>
													
													<th colspan="8" style="text-align:right;">Net Total</th>
													<th colspan="">
													<input type="text" class="form-control"  style="text-align:right"  name="net_tot_amount" id="net_tot_amount"  onkeypress="return o_obj.Alpha_Numeric(this,event);"  value="<?php echo empty($editPurchase['pR_net_total_amount'])?"":number_format($editPurchase['pR_net_total_amount'],2); ?>"  ></th><th>
													<input type="text" class="form-control"  style="text-align:right"  name="net_total_amnt" id="net_total_amnt"  onkeypress="return o_obj.Alpha_Numeric(this,event);"  value="<?php echo empty($editPurchase['pR_net_total_amnt'])?"":number_format($editPurchase['pR_net_total_amnt']); ?>"  ></th>
													
												</tr>
												<tr>
													<th style="text-align:right;">Remarks</th>
													<th colspan="10"><textarea class="form-control pull-right" rows="1" name="remarks" id="remarks"><?php echo empty($editPurchase['pR_remarks'])?"":$editPurchase['pR_remarks']; ?></textarea>	</th>
												</tr>
											</tfoot>											
										</table>					
									</div>
									
								</div>
								
							</div>
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="purchaseorder" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
								<button type="reset" class="btn btn-danger">Reset </button>
								<input type="button" value="Back" class="btn" onClick="location.href='index.php'">
								
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default"> 
							<div class="panel-heading">
								Purchase List
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
								  <form name="eva-po-form" id="eva-po-form" method="post"  action="index.php"> 
									<table class="table table-striped table-bordered table-hover" id="dataTables-eva-po">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Purchase No</th>										
												<th>Branch</th>
												<th>Supplier</th>
												<th>Purchase date</th>
												<th>Arrival date</th>
												<th>Print</th>
												<th>Action</th>
												<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit"name="po_delete" id="po_delete" value="Delete" class="btn btn-danger"></th>
                                        </tr>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($purchaseList as $result){
											$edit_status = editStatus('purchase_invoice','pI_purchaseId',$result['purchaseId'],'pI_deleted_status');
											$delete_status = deleteStatus();
											if($delete_status == 1)
											{ 
											$delete_status = $edit_status;
											}
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['purchase_no']; ?></td> 
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['supplier_name']; ?></td>
												<td><?php echo dateGeneralFormatN($result['pR_purchase_date']); ?></td>
												<td><?php echo dateGeneralFormatN($result['pR_arrival_date']); ?></td>
												<td><a href="eva-po-print.php?id=<?php echo $result['purchaseId']?>" title="ADVANCE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
												
												<td class="center">
												<?php if($edit_status == 1)
												{
												 //echo $edit_status;
												 ?>
												<a href="index.php?page=edit&id=<?php echo $result['purchaseId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;<?php } ?> </td> 
												<td style="text-align:center">
                                                 <?php if($delete_status == 1)
												 {
												 ?>
                                                <input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $result['purchaseId']?>"><?php } ?></td>
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
	
	
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
	<script>
	
	
	
		$(document).ready(function () {
			$('#dataTables-eva-po').DataTable( {
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
		$( ".rqrcdate" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
		
			$( "#production_planning_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#production_planning_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
		$( "#purchase-entry-forms" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
		});
		
		$('#myModal').on('show.bs.modal', function (e) {
				e.stopPropagation();
			});
		
		</script>

</body>

 
