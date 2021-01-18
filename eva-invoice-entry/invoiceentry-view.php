<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INVOICE ENTRY</title>
<?php 
	include "../includes/common/header.php";
	//require_once "../includes/utility-class.php";
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
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required onChange="get_po(this.value);">
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
												<input type="hidden" class="form-control"  name="purchaseid" id="purchaseid" value="<?php echo empty($editInvoice['pI_purchaseId'])?"":$editInvoice['pI_purchaseId']; ?>"   />					<input type="text" readonly class="form-control"  name="purchaseNo" id="purchaseNo" value="<?php echo empty($editInvoice['purchase_no'])?"":$editInvoice['purchase_no']; ?>"   />	<?php }else{ ?>
												
												<select name="purchaseid" id="purchaseid" class="form-control " style="width:100%" onChange="return purchasedetails(this.value);" required>
													 <option value=""> - Select - </option>
													
												</select>
												<?php } ?>
											</div>			
											
											
											<div class="form-group">
												<label class="control-label">Credit amount</label>
												<input type="text" class="form-control"  name="creditamnt" id="creditamnt" value="<?php echo empty($editInvoice['pI_creditamnt'])?"":$editInvoice['pI_creditamnt']; ?>"  >	
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
										
												  <option value="2"  <?php if(isset($editInvoice['pI_product_type']) && $editInvoice['pI_product_type']=="2" ){ ?> selected="selected" <?php } ?>> Raw</option>
												  <option value="3"  <?php if(isset($editInvoice['pI_product_type']) && $editInvoice['pI_product_type']=="3" ){ ?> selected="selected" <?php } ?>> Finished </option>
												  <option value="1"  <?php if(isset($editInvoice['pI_product_type']) && $editInvoice['pI_product_type']=="1" ){ ?> selected="selected" <?php } ?>> Accessories </option>
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
												  <input type="text" class="form-control"  name="invoice_date" id="invoice_date" readonly value="<?php echo empty($editInvoice['pI_invoice_date'])?date('d/m/Y'):$editInvoice['pI_invoice_date']; ?>" required>	
												</div>
											</div>	
												<div class="form-group">
												<label>Supplier location</label>
												<?php  $val = empty($editInvoice['supplier_location'])?"":$editInvoice['supplier_location']; ?>
												<input type="text" class="form-control"  name="supplier_location" id="supplier_location" readonly value="<?php echo $val==1?"Loacl":($val==2?"Oversea":""); ?>">	
											</div>		
											<div class="form-group">
												<label>Supplier name</label>
												<input type="text" class="form-control"  name="supplier_name" id="supplier_name" value="<?php echo empty($editInvoice['supplier_name'])?"":$editInvoice['supplier_name']; ?>" readonly >
												<input type="hidden"  name="supplier_id" id="supplier_id" value="<?php echo empty($editInvoice['supplier_id'])?"":$editInvoice['supplier_id']; ?>" readonly >	
											</div>		
											
										
											<div class="form-group">
												<label>PO date</label>
												<input type="text" class="form-control"  name="po_date" id="po_date" readonly value="<?php echo empty($editInvoice['pR_purchase_date'])?"":$editInvoice['pR_purchase_date']; ?>">	
													
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
										<div style="width:100%; overflow:auto">
										<table id="invoice_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val = !empty($editInvoiceProd) ? count($editInvoiceProd) :''; ?>
											<input type="hidden" id="invoice_apnd" name="invoice_count" value="<?php echo (0<$count_val ? $count_val :0); ?>">
												
												<tr style="">
													<th style="width:10%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Product Name/Code</th>
													<!--<th style="width:10%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">UOM</th>-->
													<th style="width:8%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Brand</th>
													<th style="width:8%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Qty</th>
													<th style="width:8%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Rate</th>
													<th style="width:8%;vertical-align:middle" rowspan="2"  nowrap="nowrap" class="text-center">Frg:Rate</th>
													<th style="width:8%;vertical-align:middle" rowspan="2"  nowrap="nowrap" class="text-center">Feet</th>
													<th style="width:16%;text-align:center;vertical-align:middle" colspan="2" >purchase</th>
													<th style="width:16%;text-align:center;vertical-align:middle" colspan="2">Loss</th>
													<th style="width:16%;text-align:center;vertical-align:middle" colspan="2">Total</th>
													<th style="width:8%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Loss Amt</th>
													<!--<th style="width:8%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Discnt(%)</th>
													<th style="width:8%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Discnt</th>
													<th style="width:8%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Discnt(CUR)</th>-->
													<th style="width:11%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Rate By Currency </th>
													<th style="width:11%;vertical-align:middle" rowspan="2" nowrap="nowrap" class="text-center">Total</th>
													<th style="width:11%;vertical-align:middle"rowspan="2" nowrap="nowrap" class="text-center">Inc Qty</th>
																									
												</tr>
												<tr style="">
													<th style="width:8%;vertical-align:middle" nowrap="nowrap" class="text-center">Ton</th>
													<th style="width:8%;vertical-align:middle" nowrap="nowrap" class="text-center">Kg</th>
													<th style="width:8%;vertical-align:middle" nowrap="nowrap" class="text-center">Ton</th>
													<th style="width:8%;vertical-align:middle" nowrap="nowrap" class="text-center">Kg</th>
													<th style="width:8%;vertical-align:middle" nowrap="nowrap" class="text-center">Ton</th>
													<th style="width:8%;border:solid 1px #ddd;vertical-align:middle" nowrap="nowrap" class="text-center">Kg</th>
													
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
													<td style="min-width:150px;">
													<?php echo $editInvoiceProd[$k]['product_name']."-".$editInvoiceProd[$k]['product_code']; ?>
														<input type="hidden" name="arr_count[]" value="<?php echo $i; ?>">
														<input type="hidden" name="pid_<?php echo $i; ?>" value="<?php echo $editInvoiceProd[$k]['invoiceProductId']; ?>">																
														<input type="hidden" class="pd_id" name="productid<?php echo $i; ?>" id="productid_<?php echo $i; ?>"   value="<?php echo $editInvoiceProd[$k]['piP_product_id']; ?>"  >
													</td>
													<!--<td style="width:60px;"><?php echo $editInvoiceProd[$k]['product_uom_name']; ?></td>-->
													<td style="min-width:120px;"><?php echo $editInvoiceProd[$k]['brand_name']; ?></td>
													<td>
														<input type="text" class="form-control" name="po_qty_<?php echo $i; ?>" id="po_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_po_qty']); ?>" style="width:80px;" readonly>

													</td>
													<td>
													
													<input type="text" class="form-control" style="text-align:right; width:100px;" name="rate_<?php echo $i; ?>" id="rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_rate']); ?>" readonly></td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;width:120px;" name="frgn_rate_<?php echo $i; ?>" id="frgn_rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_frgn_rate']); ?>" readonly>
													</td>
													<!-- Added by AuthorsMM -->
													<td>
														<b>Feet/Qty</b>
														<input type="text" class="form-control feet normal-txtbox" name="feet_<?php echo $i; ?>" id="feet_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editInvoiceProd[$k]['piP_feet_per_qty']; ?>" style="width:100px;" readonly />
														<?php
															$qty = $editInvoiceProd[$k]['piP_po_qty']=="" || $editInvoiceProd[$k]['piP_po_qty'] <= 0 ? 0 : $editInvoiceProd[$k]['piP_po_qty'];
															$total_feet = $qty * $editInvoiceProd[$k]['piP_feet_per_qty'];
														?>
														<b>Total Feet</b>
														<input type="text" class="form-control total_feet normal-txtbox" name="total_feet_<?php echo $i; ?>" id="total_feet_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $total_feet; ?>" style="width:100px;" readonly />
													</td>
													<!-- End -->
													<td>																
														<input type="text" class="form-control" name="prd_ton_<?php echo $i; ?>" id="prd_ton_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo sprintf('%0.2f',$editInvoiceProd[$k]['piP_po_ton']); ?>" style="width:100px;">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_kg_<?php echo $i; ?>" id="prd_kg_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_po_kg']); ?>" style="width:100px;">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_loss_ton_<?php echo $i; ?>" id="prd_loss_ton_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" onBlur="ton_calculation('<?php echo $i; ?>',1);GetLossamt('<?php echo $i; ?>');" value="<?php echo sprintf('%0.2f',$editInvoiceProd[$k]['piP_po_loss_ton']); ?>" style="width:90px;">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_loss_kg_<?php echo $i; ?>" id="prd_loss_kg_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_po_loss_kg']); ?>" onBlur="ton_calculation('<?php echo $i; ?>',2);" style="width:90px;">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_total_ton_<?php echo $i; ?>" id="prd_total_ton_<?php echo $i; ?>"   onChange="" value="<?php echo sprintf('%0.2f',$editInvoiceProd[$k]['piP_po_total_ton']); ?>" style="width:100px;">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_total_kg_<?php echo $i; ?>" id="prd_total_kg_<?php echo $i; ?>"  onChange="" value="<?php echo round($editInvoiceProd[$k]['piP_po_total_kg']); ?>" style="width:100px;">
													</td>
													<td>																
														<input type="text" class="form-control" name="prd_loss_amount_<?php echo $i; ?>" id="prd_loss_amount_<?php echo $i; ?>"  onChange="" value="<?php echo round($editInvoiceProd[$k]['piP_po_loss_amount']); ?>" style="width:100px;">
														
														<input type="hidden" class="form-control" name="dispercent_<?php echo $i; ?>" id="dispercent_<?php echo $i; ?>" value="<?php echo round($editInvoiceProd[$k]['piP_dispercent']); ?>" >
														
														<input type="hidden" class="form-control" name="disamnt_<?php echo $i; ?>" id="disamnt_<?php echo $i; ?>" value="<?php echo round($editInvoiceProd[$k]['piP_disamnt']); ?>" > <input type="hidden" class="form-control discount" style="text-align:right;" name="discount_'<?php echo $i; ?>'" id="discount_'<?php echo $i; ?>'" >
														
														<input type="hidden" class="form-control" name="disamnt_cur_<?php echo $i; ?>" id="disamnt_cur_<?php echo $i; ?>"  value="<?php echo round($editInvoiceProd[$k]['piP_disamnt_cur']); ?>" > <input type="hidden" class="form-control discount" style="text-align:right;" name="discount_'<?php echo $i; ?>'" id="discount_'<?php echo $i; ?>'" >
														
														
													</td>
													<!--<td>																
														<input type="text" class="form-control" style="text-align:right; width:100px;" name="dispercent_<?php echo $i; ?>" id="dispercent_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_dispercent']); ?>" onKeyUp="return discountcalulation(<?php echo $i; ?>);" >
													</td>
													<td>																
														<input type="text" class="form-control" style="text-align:right; width:100px;" name="disamnt_<?php echo $i; ?>" id="disamnt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_disamnt']); ?>" onChange="return discountcalulation(this.value,this,<?php echo $i; ?>,2);" readonly> <input type="hidden" class="form-control discount" style="text-align:right;" name="discount_'<?php echo $i; ?>'" id="discount_'<?php echo $i; ?>'" >
													</td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;width:100px;" name="disamnt_cur_<?php echo $i; ?>" id="disamnt_cur_<?php echo $i; ?>"  value="<?php echo round($editInvoiceProd[$k]['piP_disamnt_cur']); ?>" onChange="return discountcalulation(this.value,this,<?php echo $i; ?>,2);" readonly> <input type="hidden" class="form-control discount" style="text-align:right;" name="discount_'<?php echo $i; ?>'" id="discount_'<?php echo $i; ?>'" >
													</td>-->
													<td><input type="text" class="form-control unit_amount" style="text-align:right; width:150px;" name="total_amt_<?php echo $i; ?>" id="total_amt_<?php echo $i; ?>"  readonly value="<?php echo round($editInvoiceProd[$k]['piP_total_amt']); ?>" ></td>
													<td>																
														<input type="text" class="form-control unit_amnt" style="text-align:right;width:150px;" name="total_<?php echo $i; ?>" id="total_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_total']); ?>">
													</td>
													<td>																
														<input type="text" class="form-control rec_qty" style="text-align:right;width:60px;" name="receive_qty_<?php echo $i; ?>" id="receive_qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo round($editInvoiceProd[$k]['piP_frgntotal']); ?>">
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
														<input type="text" class="form-control" style="text-align:right;"  name="invoice_total_amt" id="invoice_total_amt" value="<?php echo empty($editInvoice['pI_invoice_total_amt'])?"":number_format($editInvoice['pI_invoice_total_amt']); ?>" readonly> 
													</th>
													<th colspan="3">
														<input type="text" class="form-control" style="text-align:right;"  name="invoicetotal" id="invoicetotal" value="<?php echo empty($editInvoice['pI_invoicetotal'])?"":number_format($editInvoice['pI_invoicetotal']); ?>" readonly> 
													</th>
												</tr>
												<tr>
													<th colspan="8" style="text-align:right;">Cash Discount</th>
													<th colspan="3">
														<input type="text" class="form-control"  style="text-align:right;" name="cashdiscount_amt" id="cashdiscount_amt" value="<?php echo empty($editInvoice['pI_cashdiscount_amt'])?"":number_format($editInvoice['pI_cashdiscount_amt']); ?>"  readonly>
													</th>
													<th colspan="3">
														<input type="text" class="form-control"  style="text-align:right;" name="cashdiscount" id="cashdiscount" value="<?php echo empty($editInvoice['pI_cashdiscount'])?"":number_format($editInvoice['pI_cashdiscount']); ?>"  readonly>
													</th>
												</tr>
												<tr>
													<th colspan="8" style="text-align:right;">Advance</th>
													<th colspan="3">
														<input type="text" class="form-control"  style="text-align:right;" name="inv_advance_amt" id="inv_advance_amt" value="<?php echo empty($editInvoice['pR_advance_amount'])?"":number_format($editInvoice['pR_advance_amount']); ?>"  onKeyUp="net_amunt();">
													</th>
													<th colspan="3">
														<input type="text" class="form-control"  style="text-align:right;" name="inv_advance" id="inv_advance" value="<?php echo empty($editInvoice['pR_advanceAmnt'])?"":number_format($editInvoice['pR_advanceAmnt']); ?>"  onKeyUp="net_amunt();">
													</th>
												</tr>
												<tr>
													<th colspan="8" style="text-align:right;">Net total</th>
													<th colspan="3">
														<input type="text" class="form-control" style="text-align:right;"  name="net_total_amt" id="net_total_amt" value="<?php echo empty($editInvoice['pI_net_total_amt'])?"":number_format($editInvoice['pI_net_total_amt']); ?>" readonly>  	
													</th>
													<th colspan="3">
														<input type="text" class="form-control" style="text-align:right;"  name="net_total" id="net_total" value="<?php echo empty($editInvoice['pI_net_total'])?"":number_format($editInvoice['pI_net_total']); ?>" readonly>  	
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
							<div class="panel-body" style="overflow:auto;">
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="child_product_detail" width="100%">
                                    <thead>
										<!--<tr>
											<th colspan="12">&nbsp;</th>									
											<th colspan="6" style="text-align:center">One Square Feet</th>
										</tr>-->
										<tr style="">
											<th rowspan="2" style="vertical-align:middle" class="text-center">Code</th>
											<th rowspan="2" style="vertical-align:middle" class="text-center">Product Name</th>
											<th rowspan="2" style="vertical-align:middle" class="text-center">Color</th>
											<th rowspan="2" style="vertical-align:middle" class="text-center">Thick</th>
											<!--<th rowspan="2" style="vertical-align:middle" class="text-center">UOM</th>-->	
											<th colspan="2" style="vertical-align:middle" class="text-center">Width</th>
											<th colspan="2" style="vertical-align:middle" class="text-center">Length</th>
											<th colspan="2"  style="vertical-align:middle" class="text-center">Qty</th>
											<th rowspan="2"  style="vertical-align:middle" class="text-center">Amount by Currency</th>
											<th rowspan="2"  style="vertical-align:middle;border:solid 1px #ddd;" class="text-center">Amount by MMK</th>	
											<!-- <th rowspan="2"  style="text-align:center;border:solid 1px #ddd;"></th> -->
											
											<!-- <th style="width:16%;text-align:center" colspan="2">Width</th>
											<th style="width:16%;text-align:center" colspan="2">Length</th>
											<th style="width:16%;text-align:center" colspan="2">Uom</th> -->	
										</tr>
										<tr>
											<th class="text-center">Inches</th>
											<th class="text-center">Mm</th>
											<th class="text-center">Feet</th>
											<th class="text-center">M</th>
											<th class="text-center">Ton</th>
											<th style="border:solid 1px #ddd;" class="text-center">Kg</th>
											<!--<th style="width:8%;">Inches</th>
											<th style="width:8%;">MM</th>
											<th style="width:8%;">Feet</th>
											<th style="width:8%;">M</th>
											<th style="width:8%;">Ton</th>
											<th style="width:8%;">Kg</th>-->
											
										</tr>
									</thead>
										<tbody id="child_product_detail_display">										
										<?php
											$ft_total = 0;
											$m_total = 0;
											$ton_total = 0;
											$kg_total = 0;
											$amt_total = 0;
											$amtmmk_total = 0;
											if(isset($edit_child_prod) && count($edit_child_prod) != 0){
											$i	= 1;
											foreach($edit_child_prod as $get_child_prod){
										?>
											<tr>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_code[]" id="product_con_entry_child_product_detail_code_<?=$i?>" value="<?=$get_child_prod['product_con_entry_child_product_detail_code']?>" class="form-control" style="min-width:130px;" />
													<input type="hidden" name="product_con_entry_child_product_detail_product_id[]" id="product_con_entry_child_product_detail_product_id_<?=$i?>" value="<?=$get_child_prod['product_con_entry_child_product_detail_product_id']?>" class="form-control"  />
													<input type="hidden" name="product_con_entry_child_product_detail_product_brand_id[]" id="product_con_entry_child_product_detail_product_brand_id_<?=$i?>" value="<?=$get_child_prod['product_brand_id']?>" class="form-control"  />
													
													<input type="hidden" name="product_con_entry_child_product_detail_id[]" id="product_con_entry_child_product_detail_id<?=$i?>" value="<?=$get_child_prod['product_con_entry_child_product_detail_id']?>" class="form-control"  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_name[]" id="product_con_entry_child_product_detail_name_<?=$i?>" value="<?=$get_child_prod['product_con_entry_child_product_detail_name']?>" class="form-control" style="min-width:150px;" />
												</td>
												<td>
													<select name="product_con_entry_child_product_detail_color_id[]" id="product_con_entry_child_product_detail_color_id_<?=$i?>" class="form-control" style="width:100px" >
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
													<select class="form-control" style="min-width:80px;" name="product_con_entry_child_product_detail_thick[]" id="product_con_entry_child_product_detail_thick_<?=$i?>" required>
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
												
												<input type="hidden" name="product_con_entry_child_product_detail_uom_id[]" idid="product_con_entry_child_product_detail_uom_id_<?=$i?>"  value="<?=$get_child_prod['product_con_entry_child_product_detail_uom_id']?>" />
												</td>	
												
												<!--<td>
													<select name="product_con_entry_child_product_detail_uom_id[]" id="product_con_entry_child_product_detail_uom_id_<?=$i?>" class="form-control select2" style="width:80px" >
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
												</td>-->
												
												
												<td>
													<input type="text" name="product_con_entry_child_product_detail_width_inches[]" id="product_con_entry_child_product_detail_width_inches_<?=$i?>" value="<?=sprintf('%0.0f',$get_child_prod['product_con_entry_child_product_detail_width_inches']);?>" class="form-control"   onblur="GetWcalc(2,<?=$i?>);" style="width:100px;" />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_width_mm[]" id="product_con_entry_child_product_detail_width_mm_<?=$i?>" value="<?=sprintf('%0.0f',$get_child_prod['product_con_entry_child_product_detail_width_mm']);?>" class="form-control" onBlur="GetWcalc(3,<?=$i?>);" style="width:100px;"  />
												</td>
												<?php
													$ft_total = $ft_total + $get_child_prod['product_con_entry_child_product_detail_length_feet'];
													$m_total = $m_total + $get_child_prod['product_con_entry_child_product_detail_length_mm'];
													$ton_total = $ton_total + $get_child_prod['product_con_entry_child_product_detail_ton_qty'];
													$kg_total = $kg_total + $get_child_prod['product_con_entry_child_product_detail_kg_qty'];
													$amt_total = $amt_total + $get_child_prod['product_con_entry_amount_by_currency'];
													$amtmmk_total = $amtmmk_total + $get_child_prod['product_con_entry_amount_by_mmk'];
												?>
												<td>													
													<input type="text" name="product_con_entry_child_product_detail_length_feet[]" id="product_con_entry_child_product_detail_length_feet_<?=$i?>" value="<?=sprintf('%0.2f',$get_child_prod['product_con_entry_child_product_detail_length_feet']); ?>" class="form-control"  onblur="GetCLcalc(1,<?=$i?>);"  style="width:100px;" />
												</td>
												
												<td>
													<input type="text" name="product_con_entry_child_product_detail_length_mm[]" id="product_con_entry_child_product_detail_length_mm_<?=$i?>" value="<?=sprintf('%0.2f',$get_child_prod['product_con_entry_child_product_detail_length_mm']); ?>"  class="form-control" onBlur="GetCLcalc(4,<?=$i?>)" style="width:100px;" />
													</td>
												<td>
													<input type="text" style="width:100px;" name="product_con_entry_child_product_detail_ton_qty[]" 
													id="product_con_entry_child_product_detail_ton_qty_<?=$i?>" class="form-control" value="<?=sprintf('%0.2f',$get_child_prod['product_con_entry_child_product_detail_ton_qty']);?>"  onBlur="GetWeightClc(<?=$i?>,1); get_curr_mmk_amt(<?=$i?>),getosf_amt(<?=$i?>,3);" />
												</td>
												<td>
													<input type="text" style="width:100px;" name="product_con_entry_child_product_detail_kg_qty[]" 
													id="product_con_entry_child_product_detail_kg_qty_<?=$i?>" class="form-control" value="<?=round($get_child_prod['product_con_entry_child_product_detail_kg_qty']); ?>"  onChange="GetWeightClc(<?=$i?>,2);"  />
												</td>
												<td>
			<input type="text" name="product_con_entry_amount_by_currency[]" id="product_con_entry_amount_by_currency_<?=$i?>" class="form-control" value="<?=round($get_child_prod['product_con_entry_amount_by_currency'])?>"  style="width:150px;" />
		</td>
		<td>
			<input type="text" name="product_con_entry_amount_by_mmk[]" id="product_con_entry_amount_by_mmk_<?=$i?>" class="form-control" value="<?=round($get_child_prod['product_con_entry_amount_by_mmk']);?>"  style="width:150px;" />
		</td>
													<!--Edited text fields as hidden fields by AuthorsMM -->
													<input type="hidden" class="form-control" name="product_con_entry_osf_width_inches[]" id="product_con_entry_osf_width_inches_<?php echo $i; ?>"  value="<?php echo $get_child_prod['product_con_entry_osf_width_inches']; ?>" >
													<input type="hidden" name="product_con_entry_osf_width_mm[]" id="product_con_entry_osf_width_mm_<?php echo $i; ?>" value="<?php echo $get_child_prod['product_con_entry_osf_width_mm']; ?>">
													<input type="hidden" name="product_con_entry_osf_length_feet[]" id="product_con_entry_osf_length_feet_<?php echo $i; ?>"  value="<?php echo $get_child_prod['product_con_entry_osf_length_feet']; ?>">
													<input type="hidden" name="product_con_entry_osf_length_m[]" id="product_con_entry_osf_length_m_<?php echo $i; ?>" value="<?php echo $get_child_prod['product_con_entry_osf_length_m']; ?>">
													<input type="hidden" name="product_con_entry_osf_uom_ton[]" id="product_con_entry_osf_uom_ton_<?php echo $i; ?>"  value="<?php echo $get_child_prod['product_con_entry_osf_uom_ton']; ?>">
													<input type="hidden" name="product_con_entry_osf_uom_kg[]" id="product_con_entry_osf_uom_kg_<?php echo $i; ?>" value="<?php echo $get_child_prod['product_con_entry_osf_uom_kg']; ?>">
													<!-- end Edited text fields-->
													<input type="hidden" class="form-control" style="text-align:right;" name="product_rate_[]" id="product_rate_<?=$i?>" value="<?=$get_child_prod['product_con_entry_amount_by_currency']/$get_child_prod['product_con_entry_child_product_detail_ton_qty']; ?>" >
											</tr>
											
																				
										<?php $i	= $i+1;} 
										} 
										else if(count($edit_child_prod) <= 0) {
										?>
										<tr id = 'empty_row'><td colspan="15" style="hight:1px;"></td></tr>
										<?php
										} else { ?>
										<tr id = 'empty_row'><td colspan="15" style="hight:1px;"></td></tr>
										<?php	
											}
										?>
										
										</tbody>
										<tfoot>
											<!-- Added By AuthorsMM for Total values -->
										<tr style="border:solid 1px #ddd;">
											<th colspan="6" class="text-right"><b>Total</b></th>
											<th class="ft_total text-right"><?php echo sprintf('%0.2f',$ft_total); ?></th>
											<th class="m_total text-right"><?php echo sprintf('%0.2f',$m_total); ?></th>
											<th class="ton_total text-right"><?php echo sprintf('%0.2f',$ton_total); ?></th>
											<th class="kg_total text-right"><?php echo round($kg_total); ?></th>
											<th class="amt_total text-right"><?php echo number_format($amt_total); ?></th>
											<th class="amtmmk_total text-right"><?php echo number_format($amtmmk_total); ?></th>
										</tr>
										<!-- END for Total values -->
										</tfoot>
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
								<?php if(isset($_REQUEST['search'])){?>
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
												<th>Print</th>
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
											if($result['pI_product_type']==1 || $result['pI_product_type']==4){
											$edit_status =  editStatus('grn_details_products', 'grnP_invoice_id',$result['invoiceId'], 'grnP_deleted_status');
											}else{
												
											$edit_status = editStatus('grn_child_product_details', 'grn_child_product_detail_invoice_id',$result['invoiceId'], 'grn_child_product_detail_deleted_status');
											}
			$delete_status = deleteStatus();

			if($delete_status == 1)	{

				$delete_status = $edit_status;			

			}	
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['invoiceNo']; ?></td>
												<td><?php echo $result['supplier_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['pI_invoice_date']; ?></td>
												 <td><a href="eva-invoice-print.php?id=<?php echo $result['invoiceId']?>" title="INVOICE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>                                     
												<td class="center">
												<?php  if($edit_status == 1){ ?>
												<a href="index.php?page=edit&id=<?php echo $result['invoiceId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												 <?php } ?></td>
												
												<td>
                                                <?php if($delete_status == 1) { ?>
												<input name="deleteCheck[]" value="<?php echo $result['invoiceId']; ?>" type="checkbox" />
												<?php } ?> </td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</form>
								</div>
							</div>
						</div>
				<?php }} ?>
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
	
	<input type="hidden" value="<?php print_r($arr_thick); ?>" id="arr_thick">
	<input type="hidden" value="<?php print_r($colour_list); ?>" id="colour_list">
	<script>
		
		$(document).ready(function () {
			colour_list = "";
			arr_thick = "";
			<?php
				foreach($colour_list as	$get_colour){
			?>
					colour_list +='<option value="<?php echo $get_colour['product_colour_id']; ?>"><?php echo $get_colour['product_colour_name']; ?></option>';
			<?php
				}
			?>
			
			<?php
				foreach($arr_thick as $value => $list){
			?>
					arr_thick +='<option value="<?php echo $value; ?>"><?php echo ucfirst($list); ?></option>';
			<?php
				}
			?>
				
			$('#dataTables-eva-invoice').DataTable( {
				responsive: true
			} );
			/*$('#dataTables-example').dataTable();*/
		});
		
		$(function() {
		
		//Added by AuthorsMM
		/* $(document).on('change', 'input', function() { 
			var $val = $(this).val();
			$(this).attr('value',$val);
		});
		
		$(document).on('change', 'select', function() { 
			var $val = $(this).val();
			$('.id_100 option[value=val2]').attr('selected','selected');
		}); */
		//End
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
			
			/* $('#child_product_detail').DataTable( {
				scrollY:true,
				scrollX:true,
				scrollCollapse: true,
				paging: false,
				"searching": false,
				"paging": false
			}); */	
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

 
