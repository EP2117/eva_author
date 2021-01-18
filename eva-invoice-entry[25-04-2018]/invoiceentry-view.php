<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INVOICE ENTRY</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-invoice-entry/invoiceentry-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">INVOICE ENTRY</h1>
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
					<form name="invoice-forms" id="invoice-forms" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editInvoice['invoiceId'])?"":$editInvoice['invoiceId']; ?>" >

						<div class="row">
						
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Invoice entry								 
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editInvoice['pI_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											
											
											<div class="form-group">
												<label class="control-label">PO No</label>
										<?php if(!empty($editInvoice['pI_purchaseId'])){ ?>		
												<input type="hidden" class="form-control"  name="purchaseid" id="purchaseid" value="<?php echo empty($editInvoice['pI_purchaseId'])?"":$editInvoice['pI_purchaseId']; ?>"   />					<input type="text" readonly="" class="form-control"  name="purchaseNo" id="purchaseNo" value="<?php echo empty($editInvoice['purchase_no'])?"":$editInvoice['purchase_no']; ?>"   />	<?php }else{ ?>
												
												<select name="purchaseid" id="purchaseid" class="form-control select2" style="width:100%" onChange="return purchasedetails(this.value);" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($purdetailslist  as $get_po){
															if($editInvoice['pI_purchaseId'] == $get_po['purchaseId']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_po['purchaseId']?>"><?=$get_po['purchase_no']."-".$get_po['pR_purchase_date']."-".$get_po['supplier_name']?></option>
													<?php
														}
														?>
												</select>
												<?php } ?>
											</div>			
											
											
											<div class="form-group">
												<label class="control-label">Credit amount</label>
												<input type="text" class="form-control"  name="creditamnt" id="creditamnt" value="<?php echo empty($editInvoice['pI_creditamnt'])?"":$editInvoice['pI_creditamnt']; ?>"   required>	
											</div>		
											<div class="form-group">
												<label class="control-label">Credit days</label>
													<input type="text" class="form-control" name="creditdays" id="creditdays"  value="<?php echo empty($editInvoice['pI_creditdays'])?"":$editInvoice['pI_creditdays']; ?>" onKeyUp="return getemployee(this.value,this);" requried>
													<input type="hidden" class="form-control" name="purchase_exc_rate" id="purchase_exc_rate"  value="<?php echo empty($editInvoice['pR_rate'])?"":$editInvoice['pR_rate']; ?>" >
											</div>	
											<div class="form-group">

											<label>Product Type</label>

											<select name="invoice_entry_product_type" id="invoice_entry_product_type" class="form-control" style="width:100%">
												  <option value=""> - Select - </option>
												  <option value="1" <?php if(isset($editInvoice['pI_product_type']) && $editInvoice['pI_product_type']=="1" ){ ?> selected="selected" <?php } ?>> Both </option>
												  <option value="2"  <?php if(isset($editInvoice['pI_product_type']) && $editInvoice['pI_product_type']=="2" ){ ?> selected="selected" <?php } ?>> Raw</option>
												  <option value="3"  <?php if(isset($editInvoice['pI_product_type']) && $editInvoice['pI_product_type']=="3" ){ ?> selected="selected" <?php } ?>> Finished </option>
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
												  <input type="text" class="form-control"  name="invoice_date" id="invoice_date" readonly="" value="<?php echo empty($editInvoice['pI_invoice_date'])?date('d/m/Y'):$editInvoice['pI_invoice_date']; ?>" required>	
												</div>
											</div>	
												<div class="form-group">
												<label>Supplier location</label>
												<?php  $val = empty($editInvoice['supplier_location'])?"":$editInvoice['supplier_location']; ?>
												<input type="text" class="form-control"  name="supplier_location" id="supplier_location" readonly="" value="<?php echo $val==1?"Loacl":($val==2?"Oversea":""); ?>">	
											</div>		
											<div class="form-group">
												<label>Supplier name</label>
												<input type="text" class="form-control"  name="supplier_name" id="supplier_name" value="<?php echo empty($editInvoice['supplier_name'])?"":$editInvoice['supplier_name']; ?>" readonly >
												<input type="hidden"  name="supplier_id" id="supplier_id" value="<?php echo empty($editInvoice['supplier_id'])?"":$editInvoice['supplier_id']; ?>" readonly >	
											</div>		
											
										
											<div class="form-group">
												<label>PO date</label>
												<input type="text" class="form-control"  name="po_date" id="po_date" readonly="" value="<?php echo empty($editInvoice['pR_purchase_date'])?"":$editInvoice['pR_purchase_date']; ?>">	
													
											</div>	
										
									</div>
									
								</div>		
								</div>
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									<div class="col-lg-6">
									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
									</div>
									<div class="panel-body">
										<div style="width:100%; overflow:scroll">
										<table id="invoice_table" class="table table-striped table-bordered table-hover" >
											<thead>
											<?php $count_val = !empty($editInvoiceProd) ? count($editInvoiceProd) :''; ?>
											<input type="hidden" id="invoice_apnd" name="invoice_count" value="<?php echo (0<$count_val ? $count_val :0); ?>">
												
												<tr style="">
													<th style="width:10%;" rowspan="2" nowrap="nowrap">Product Name/Code</th>
													<th style="width:10%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;UOM&nbsp;&nbsp;</th>
													<th style="width:8%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;Brand&nbsp;&nbsp;</th>
													<th style="width:8%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;&nbsp;Qty&nbsp;&nbsp;&nbsp;</th>
													<th style="width:8%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;Rate&nbsp;&nbsp;</th>
													<th style="width:8%;" rowspan="2"  nowrap="nowrap">&nbsp;&nbsp;Frg:Rate&nbsp;&nbsp;</th>
													<th style="width:16%;text-align:center" colspan="2" >purchase</th>
													<th style="width:16%;text-align:center" colspan="2">Loss</th>
													<th style="width:16%;text-align:center" colspan="2">Total</th>
													<th style="width:8%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Loss Amt &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:8%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Discnt(%) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:8%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Discnt &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:8%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Discnt(CUR) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:11%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Rate By Currency &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:11%;" rowspan="2" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:11%;"rowspan="2" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Inc Qty &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
																									
												</tr>
												<tr style="">
													<th style="width:8%;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ton &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:8%;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Kg &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:8%;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Ton &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:8%;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Kg &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:8%;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Ton &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													<th style="width:8%;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Kg &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
													
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
												$count_id = count($editInvoiceProd);
												   for($i=1;$i<=count($editInvoiceProd);$i++){	
												   	$k	= $i-1;												
												 ?>
											 	<tr>
													<td>
													<?php echo $editInvoiceProd[$k]['product_name']."-".$editInvoiceProd[$k]['product_code']; ?>
														<input type="hidden" name="arr_count[]" value="<?php echo $i; ?>">
														<input type="hidden" name="pid_<?php echo $i; ?>" value="<?php echo $editInvoiceProd[$k]['invoiceProductId']; ?>">																
														<input type="hidden" class="pd_id" name="productid<?php echo $i; ?>" id="productid_<?php echo $i; ?>"   value="<?php echo $editInvoiceProd[$k]['piP_product_id']; ?>"  >
													</td>
													<td><?php echo $editInvoiceProd[$k]['product_uom_name']; ?></td>
													<td><?php echo $editInvoiceProd[$k]['brand_name']; ?></td>
													<td>
														<input type="text" class="form-control" name="po_qty_<?php echo $i; ?>" id="po_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_po_qty']; ?>">
													</td>
													<td>
													
													<input type="text" class="form-control" style="text-align:right;" name="rate_<?php echo $i; ?>" id="rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_rate']; ?>" readonly=""></td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="frgn_rate_<?php echo $i; ?>" id="frgn_rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_frgn_rate']; ?>" readonly="">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_ton_<?php echo $i; ?>" id="prd_ton_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_po_ton']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_kg_<?php echo $i; ?>" id="prd_kg_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_po_kg']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_loss_ton_<?php echo $i; ?>" id="prd_loss_ton_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_po_loss_ton']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_loss_kg_<?php echo $i; ?>" id="prd_loss_kg_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_po_loss_kg']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_total_ton_<?php echo $i; ?>" id="prd_total_ton_<?php echo $i; ?>"   onChange="" value="<?php echo $editInvoiceProd[$k]['piP_po_total_ton']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_total_kg_<?php echo $i; ?>" id="prd_total_kg_<?php echo $i; ?>"  onChange="" value="<?php echo $editInvoiceProd[$k]['piP_po_total_kg']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_loss_amount_<?php echo $i; ?>" id="prd_loss_amount_<?php echo $i; ?>"  onChange="" value="<?php echo $editInvoiceProd[$k]['piP_po_loss_amount']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="dispercent_<?php echo $i; ?>" id="dispercent_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_dispercent']; ?>" onKeyUp="return discountcalulation(<?php echo $i; ?>);" >
													</td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="disamnt_<?php echo $i; ?>" id="disamnt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_disamnt']; ?>" onChange="return discountcalulation(this.value,this,<?php echo $i; ?>,2);" readonly=""> <input type="hidden" class="form-control discount" style="text-align:right;" name="discount_'<?php echo $i; ?>'" id="discount_'<?php echo $i; ?>'" >
													</td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="disamnt_<?php echo $i; ?>" id="disamnt_<?php echo $i; ?>"  value="<?php echo $editInvoiceProd[$k]['piP_disamnt_cur']; ?>" onChange="return discountcalulation(this.value,this,<?php echo $i; ?>,2);" readonly=""> <input type="hidden" class="form-control discount" style="text-align:right;" name="discount_'<?php echo $i; ?>'" id="discount_'<?php echo $i; ?>'" >
													</td>
													<td><input type="text" class="form-control unit_amount" style="text-align:right;" name="total_amt_<?php echo $i; ?>" id="total_amt_<?php echo $i; ?>"  readonly value="<?php echo $editInvoiceProd[$k]['piP_total_amt']; ?>"></td>
													<td>																
														<input type="text" class="form-control unit_amnt" style="text-align:right;" name="total_<?php echo $i; ?>" id="total_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_total']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control rec_qty" style="text-align:right;" name="receive_qty_<?php echo $i; ?>" id="receive_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_frgntotal']; ?>">
													</td>
																										
												</tr>
											<?php   }
												  }else{
												 ?>	
											 <?php }
											 ?>	
										</table>
										</div>
										<table  class="table table-striped table-bordered table-hover" style="width:200%">
										<tfoot>
												<tr>
													<th colspan="8" style="text-align:right;">Total</th>
													<th colspan="3">
														<input type="text" class="form-control" style="text-align:right;"  name="invoice_total_amt" id="invoice_total_amt" value="<?php echo empty($editInvoice['pI_invoice_total_amt'])?"":$editInvoice['pI_invoice_total_amt']; ?>" readonly> 
													</th>
													<th colspan="3">
														<input type="text" class="form-control" style="text-align:right;"  name="invoicetotal" id="invoicetotal" value="<?php echo empty($editInvoice['pI_invoicetotal'])?"":$editInvoice['pI_invoicetotal']; ?>" readonly> 
													</th>
												</tr>
												<tr>
													<th colspan="8" style="text-align:right;">Cash Discount</th>
													<th colspan="3">
														<input type="text" class="form-control"  style="text-align:right;" name="cashdiscount_amt" id="cashdiscount_amt" value="<?php echo empty($editInvoice['pI_cashdiscount_amt'])?"":$editInvoice['pI_cashdiscount_amt']; ?>"  readonly>
													</th>
													<th colspan="3">
														<input type="text" class="form-control"  style="text-align:right;" name="cashdiscount" id="cashdiscount" value="<?php echo empty($editInvoice['pI_cashdiscount'])?"":$editInvoice['pI_cashdiscount']; ?>"  readonly>
													</th>
												</tr>
												<tr>
													<th colspan="8" style="text-align:right;">Advance</th>
													<th colspan="3">
														<input type="text" class="form-control"  style="text-align:right;" name="inv_advance_amt" id="inv_advance_amt" value="<?php echo empty($editInvoice['pR_advance_amount'])?"":$editInvoice['pR_advance_amount']; ?>"  >
													</th>
													<th colspan="3">
														<input type="text" class="form-control"  style="text-align:right;" name="inv_advance" id="inv_advance" value="<?php echo empty($editInvoice['pR_advanceAmnt'])?"":$editInvoice['pR_advanceAmnt']; ?>"  >
													</th>
												</tr>
												<tr>
													<th colspan="8" style="text-align:right;">Net total</th>
													<th colspan="3">
														<input type="text" class="form-control" style="text-align:right;"  name="net_total_amt" id="net_total_amt" value="<?php echo empty($editInvoice['pI_net_total_amt'])?"":$editInvoice['pI_net_total_amt']; ?>" readonly>  	
													</th>
													<th colspan="3">
														<input type="text" class="form-control" style="text-align:right;"  name="net_total" id="net_total" value="<?php echo empty($editInvoice['pI_net_total'])?"":$editInvoice['pI_net_total']; ?>" readonly>  	
													</th>
												</tr>
												<tr>
													<th style="text-align:right;">Remarks</th>
													<th colspan="10">
														<textarea class="form-control pull-right" rows="1" name="remark" id="remark"><?php echo empty($editInvoice['pI_remark'])?"":$editInvoice['pI_remark']; ?></textarea>	
													</th>
												</tr>
											</tfoot>
										</table>					
									</div>
									
								</div>
								<div class="panel panel-info">
							<div class="panel-heading">
							 Child Product Details
							</div>
							<div class="panel-body">
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="child_product_detail"  style=" width:150%" >
                                    <thead>
										<tr>
											<th colspan="12">&nbsp;</th>
											<th colspan="6" style="text-align:center">One Square Feet</th>
										</tr>
										<tr style="">
											<th rowspan="2" style="width:10%">Code</th>
											<th rowspan="2" style="width:10%;">Product Name</th>
											<th rowspan="2"  style="width:10%">&nbsp;&nbsp;&nbsp;Color&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2"  style="width:10%">&nbsp;&nbsp;&nbsp;Thick&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="width:10%;">&nbsp;&nbsp;&nbsp;UOM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>	
											<th colspan="2" style="text-align:center; width:15%">Width</th>
											<th colspan="2" style="text-align:center; width:15%">Length</th>
											<th colspan="2"  style="text-align:center; width:15%">Qty</th>
											<th rowspan="2"  style="text-align:center; width:15%">Amount by Currency</th>
											<th rowspan="2"  style="text-align:center; width:15%">Amount by MMK</th>	
											<th style="width:16%;text-align:center" colspan="2">Width</th>
											<th style="width:16%;text-align:center" colspan="2">Length</th>
											<th style="width:16%;text-align:center" colspan="2">Uom</th>	
										</tr>
										<tr>
											<th>Inches</th>
											<th>Mm</th>
											<th>Feet</th>
											<th>M</th>
											<th>Ton</th>
											<th>Kg</th>
											<th style="width:8%;">Inches</th>
											<th style="width:8%;">MM</th>
											<th style="width:8%;">Feet</th>
											<th style="width:8%;">M</th>
											<th style="width:8%;">Ton</th>
											<th style="width:8%;">Kg</th>
											
										</tr>
									</thead>
										<tbody id="child_product_detail_display">
										<?php
											if(isset($edit_child_prod)){
											$i	= 1;
											foreach($edit_child_prod as $get_child_prod){
										?>
											<tr>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_code[]" id="product_con_entry_child_product_detail_code_<?=$i?>" value="<?=$get_child_prod['product_con_entry_child_product_detail_code']?>" class="form-control"  />
													<input type="hidden" name="product_con_entry_child_product_detail_product_id[]" id="product_con_entry_child_product_detail_product_id_<?=$i?>" value="<?=$get_child_prod['product_con_entry_child_product_detail_product_id']?>" class="form-control"  />
													<input type="hidden" name="product_con_entry_child_product_detail_product_brand_id[]" id="product_con_entry_child_product_detail_product_brand_id_<?=$i?>" value="<?=$get_child_prod['product_brand_id']?>" class="form-control"  />
													
													<input type="hidden" name="product_con_entry_child_product_detail_id[]" id="product_con_entry_child_product_detail_id<?=$i?>" value="<?=$get_child_prod['product_con_entry_child_product_detail_id']?>" class="form-control"  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_name[]" id="product_con_entry_child_product_detail_name_<?=$i?>" value="<?=$get_child_prod['product_con_entry_child_product_detail_name']?>" class="form-control"  />
												</td>
												<td>
													<select name="product_con_entry_child_product_detail_color_id[]" id="product_con_entry_child_product_detail_color_id_<?=$i?>" class="form-control" style="width:100%" >
														 <option value=""> - Select - </option>
														<?php
															foreach($colour_list as	$get_colour){
														 	$selected	= ($get_colour['product_colour_id']==$get_child_prod['product_con_entry_child_product_detail_color_id'])?'selected="selected"':''; 
														?>
																<option value="<?=$get_colour['product_colour_id']?>" <?=$selected?>><?=$get_colour['product_colour_name']?></option>
														<?php
															}
															?>
															
													</select>
												</td>
										<td>
													<select class="form-control" name="product_con_entry_child_product_detail_thick[]" id="product_con_entry_child_product_detail_thick_<?=$i?>" required>
													<option value="">--Select--</option>
													<?php
														foreach($arr_thick as $value => $list){
															$selected	= ($get_child_prod['product_con_entry_child_product_detail_thick_ness']==$value)?'selected="selected"':'';
													?>
														<option value="<?=$value?>" <?=$selected?>><?=ucfirst($list)?></option>
													<?php
													}
													?>
												</select>
												</td>	
												<td>
													<select name="product_con_entry_child_product_detail_uom_id[]" id="product_con_entry_child_product_detail_uom_id_<?=$i?>" class="form-control select2" style="width:100%" >
														 <option value=""> - Select - </option>
														<?php
															foreach($uom_list as	$get_uom){
														$selected	= ($get_uom['product_uom_id']==$get_child_prod['product_con_entry_child_product_detail_uom_id'])?'selected="selected"':'';
														?>
																<option value="<?=$get_uom['product_uom_id']?>" <?=$selected?>><?=$get_uom['product_uom_name']?></option>
														<?php
															}
															?>
													</select>
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_width_inches[]" id="product_con_entry_child_product_detail_width_inches_<?=$i?>" value="<?=number_format($get_child_prod['product_con_entry_child_product_detail_width_inches'],4)?>" class="form-control"   onblur="GetWcalc(2,<?=$i?>);" />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_width_mm[]" id="product_con_entry_child_product_detail_width_mm_<?=$i?>" value="<?=number_format($get_child_prod['product_con_entry_child_product_detail_width_mm'],2)?>" class="form-control" onBlur="GetWcalc(3,<?=$i?>);"  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_length_feet[]" id="product_con_entry_child_product_detail_length_feet_<?=$i?>" value="<?=number_format($get_child_prod['product_con_entry_child_product_detail_length_feet'],4)?>" class="form-control"  onblur="GetCLcalc(1,<?=$i?>);"  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_length_mm[]" id="product_con_entry_child_product_detail_length_mm_<?=$i?>" value="<?=number_format($get_child_prod['product_con_entry_child_product_detail_length_mm'],2)?>"  class="form-control" onBlur="GetCLcalc(4,<?=$i?>)" />
													</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_ton_qty[]" 
													id="product_con_entry_child_product_detail_ton_qty_<?=$i?>" class="form-control" value="<?=number_format($get_child_prod['product_con_entry_child_product_detail_ton_qty'],2)?>"  onBlur="GetWeightClc(<?=$i?>,1); get_curr_mmk_amt(<?=$i?>),getosf_amt(<?=$i?>,3);" />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_kg_qty[]" 
													id="product_con_entry_child_product_detail_kg_qty_<?=$i?>" class="form-control" value="<?=number_format($get_child_prod['product_con_entry_child_product_detail_kg_qty'],2)?>"  onChange="GetWeightClc(<?=$i?>,2);"  />
												</td>
												<td>
			<input type="text" name="product_con_entry_amount_by_currency[]" id="product_con_entry_amount_by_currency_<?=$i?>" class="form-control" value="<?=number_format($get_child_prod['product_con_entry_amount_by_currency'],2)?>"   />
		</td>
		<td>
			<input type="text" name="product_con_entry_amount_by_mmk[]" id="product_con_entry_amount_by_mmk_<?=$i?>" class="form-control" value="<?=number_format($get_child_prod['product_con_entry_amount_by_mmk'],2)?>"   />
		</td>
												<td>																
														<input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_width_inches[]" id="product_con_entry_osf_width_inches_<?php echo $i; ?>"  value="<?php echo number_format($get_child_prod['product_con_entry_osf_width_inches'],4); ?>" onBlur="GetWcalcation(<?=$i?>,5);">
													</td>
													
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_width_mm[]" id="product_con_entry_osf_width_mm_<?php echo $i; ?>" value="<?php echo number_format($get_child_prod['product_con_entry_osf_width_mm'],4); ?>" onBlur="GetWcalcation(<?=$i?>,6);">
													</td>
													
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_length_feet[]" id="product_con_entry_osf_length_feet_<?php echo $i; ?>"  value="<?php echo number_format($get_child_prod['product_con_entry_osf_length_feet'],4); ?>" onBlur="getcalculation(<?=$i?>,7);">
													</td>
													
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_length_m[]" id="product_con_entry_osf_length_m_<?php echo $i; ?>" value="<?php echo number_format($get_child_prod['product_con_entry_osf_length_m'],4); ?>" onBlur="getcalculation(<?=$i?>,8);">
													</td>
													
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_uom_ton[]" id="product_con_entry_osf_uom_ton_<?php echo $i; ?>"  value="<?php echo number_format($get_child_prod['product_con_entry_osf_uom_ton'],4); ?>" onKeyUp="getosf_amt(<?=$i?>,3);">
													</td>
													
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="product_con_entry_osf_uom_kg[]" id="product_con_entry_osf_uom_kg_<?php echo $i; ?>" value="<?php echo number_format($get_child_prod['product_con_entry_osf_uom_kg'],4); ?>">
													</td>
													<input type="hidden" class="form-control" style="text-align:right;" name="product_rate_[]" id="product_rate_<?=$i?>" value="<?=number_format($get_child_prod['product_con_entry_amount_by_currency']/$get_child_prod['product_con_entry_child_product_detail_ton_qty'],4); ?>" >
											</tr>
																				
										<?php $i	= $i+1;} } ?>
										</tbody>
								</table>
								
								</div>
								
							</div>
						</div>
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
								<button name="invoice_insrtUpdate" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
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
								Invoice list
							</div>
							<div class="panel-body">
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
								<form name="invoice_form" id="invoice_form" action="index.php" method="post">
									<table class="table table-striped table-bordered table-hover" id="dataTables-eva-invoice">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Invoice no</th>										
												<th>Supplier</th>
												<th>Branch</th>
												<th>Date</th>
												<th>Action</th>
												<th>
												<input name="checkall" onClick="checkedall();" type="checkbox"  />
												<button name="invoice_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($invoiceList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['invoiceNo']; ?></td>
												<td><?php echo $result['supplier_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['pI_invoice_date']; ?></td>
												                                      
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['invoiceId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												
												<td>
												<input name="deleteCheck[]" value="<?php echo $result['invoiceId']; ?>" type="checkbox" />
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


	
	
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
	<script>
		$(document).ready(function () {
			$('#dataTables-eva-invoice').DataTable( {
				responsive: true
			} );
			/*$('#dataTables-example').dataTable();*/
		});
			
			$('#child_product_detail').DataTable( {
				scrollY:true,
				scrollX:true,
				scrollCollapse: true,
				paging: false,
				"searching": false,
				"paging": false
			});	
		//Initialize Select2 Elements
		$(".select2").select2();
	 $(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#invoice_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
		
			$( "#production_planning_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#production_planning_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
		$( "#invoice-forms" ).validate({
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

 
