<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DEBIT NOTE</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-debit-note/debit-note-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Debit note</h1>
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
					<form name="debit-forms" id="debit-forms" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editDebit['debitnoteId'])?"":$editDebit['debitnoteId']; ?>" >

						<div class="row">
						
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Debit note									 
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editDebit['d_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											
											
											<div class="form-group">
												<label class="control-label">Inv no</label>
												<select name="purchaseid" id="purchaseid" class="form-control select2" style="width:100%" onChange="return product_list(this.value);" required>
													 <option value=""> - Select - </option>
													   <?php
														foreach($purdetailslist  as $get_po){
															if($editDebit['d_purchaseId'] == $get_po['invoiceId']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_po['invoiceId']?>"><?=$get_po['invoiceNo']?></option>
													<?php
														}
														?>
												</select>
											</div>			
											
											<div class="form-group">
												<label  class="control-label">Type</label>
											
												
												<select name="type" id="type" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													  <?php
														foreach($debit_type  as $key => $val){
															if($editDebit['d_type'] == $key){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$key?>"><?=$val?></option>
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
												  <input type="text" class="form-control" name="debitdate" id="debitdate" readonly="" value="<?php echo empty($editDebit['d_debitdate'])?"":$editDebit['d_debitdate']; ?>" required>	
												</div>
											</div>	
											<div class="form-group">
												<label>Supplier location</label>
												<?php  $val = empty($editDebit['supplier_location'])?"":$editDebit['supplier_location']; ?>
												<input type="text" class="form-control"  name="supplier_location" id="supplier_location" readonly="" value="<?php echo $val==1?"Loacl":($val==2?"Oversea":""); ?>">	
											</div>	
											<div class="form-group">
												<label>Supplier name</label>
												<input type="text" class="form-control" id="supplier_name" value="<?php echo empty($editDebit['supplier_name'])?"":$editDebit['supplier_name']; ?>" readonly >	
											</div>		
											
											
											<div class="form-group">
												<label>Warehouse</label>
												<input type="text" class="form-control" id="po_date" value="<?php echo empty($editDebit['pR_purchase_date'])?"":$editDebit['pR_purchase_date']; ?>" readonly >	
											</div>			
										
										
									</div>
									
								</div>		
								</div>
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									
									<div class="panel-body">
										<table id="debit_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val = !empty($editDebitProd) ? count($editDebitProd) :''; ?>
											<input type="hidden" id="debit_apnd" name="debit_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">
												<tr style="">
													<th style="width:20%;">Product Name</th>
													<th style="width:10%;">Code</th>
													<th style="width:10%;">UOM</th>
													<th style="width:10%;">PO qty</th>
													<th style="width:10%;">Rate</th>
													<th style="width:10%;">Qty</th>
													<th style="width:15%;">Amount</th>													
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
												   for($i=0;$i<count($editDebitProd);$i++){													
												 ?>
											 <tr id="remove_req_<?php echo $i; ?>">
													<td><?php echo $editDebitProd[$i]['product_name']; ?>
														<input type="hidden" name="pid_<?php echo $i; ?>" value="<?php echo $editDebitProd[$i]['debitProductId']; ?>">																
														<input type="hidden" class="form-control" name="productid_<?php echo $i; ?>" id="productid_<?php echo $i; ?>"  value="<?php echo $editDebitProd[$i]['dp_product_id']; ?>" >
														
													</td>
													<td>																
														<?php echo $editDebitProd[$i]['product_code']; ?>
													</td>
													<td>																
														<?php echo $editDebitProd[$i]['product_uom_name']; ?>
													</td>
													<td>																
														<input type="text" class="form-control" name="poqty_<?php echo $i; ?>" id="poqty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editDebitProd[$i]['dp_poqty']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="rate_<?php echo $i; ?>" id="rate_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editDebitProd[$i]['dp_rate']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="qty_<?php echo $i; ?>" id="qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editDebitProd[$i]['dp_qty']; ?>" onChange="return amntcalculate(this,this.value,'<?php echo $i; ?>');">
													</td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="amount_<?php echo $i; ?>" id="amount_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editDebitProd[$i]['dp_amount']; ?>">
													</td>
												</tr>
											<?php   }
												  }else{
												 ?>	
												 <tr>
													<td colspan="7" style="text-align:center">No record founds</td>
												</tr>
											 <?php }
											 ?>	
											</tbody>	
											<tfoot>
												<tr>
													<th style="text-align:right;">Remarks</th>
													<th colspan="6"><textarea class="form-control pull-right" rows="1" name="remark" id="remark"><?php echo empty($editDebit['d_remark'])?"":$editDebit['d_remark']; ?></textarea></th>
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
										<table id="child_receipt_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val_chld = !empty($editReceiptProdChild) ? count($editReceiptProdChild) :''; ?>
											<input type="hidden" id="child_receipt_apnd" name="child_receipt_count" value="<?php echo (0<$count_val_chld ? $count_val_chld :1); ?>">
												<tr>
													<th rowspan="2">Code</th>
													<th rowspan="2" style="">Product Name</th>
													<th rowspan="2" style="">Color</th>
													<th rowspan="2">Thick</th>
													<th rowspan="2" style="">UOM</th>
													<th colspan="2" style="">Width</th>
													<th colspan="2" style="">Length</th>
													<th colspan="2" style="">QTY</th>
												</tr>
												<tr>
													<th>Inch</th>
													<th>MM</th>
													<th>Feet</th>
													<th>MM</th>
													<th>Ton</th>
													<th>KG</th>
												</tr>
											</thead>
												<tbody>
											<?php 
												
													if(0<$count_val_chld){ $j=0;
													$count_child_id = count($editReceiptProdChild);
												   foreach($editReceiptProdChild as $editChild){													
												 ?>
											 <tr id="remove_child_req_<?php echo $j; ?>">
											 
											 <td>
											 <input type="hidden" name="purchase_debit_note_child_product_id[]" id="purchase_debit_note_child_product_id<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_id']?>" class="form-control"  />	
											 <input type="hidden" name="purchase_debit_note_child_product_code[]" id="purchase_debit_note_child_product_code_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_code']?>" class="form-control"  />	
											 <input type="hidden" name="purchase_debit_note_child_product_product_id[]" id="purchase_debit_note_child_product_product_id_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_product_id']?>"  /><input type="hidden" name="purchase_debit_note_child_product_inv_detail_id[]" id="purchase_debit_note_child_product_inv_detail_id_'+i+'" value=" <?=$editChild['purchase_debit_note_child_product_inv_detail_id']?>"  />
											 <?=$editChild['purchase_debit_note_child_product_code']?>
											 </td>
											 
												<td><?php echo $editChild['purchase_debit_note_child_product_name']; ?>
												<input type="hidden" name="purchase_debit_note_child_product_name[]" id="purchase_debit_note_child_product_name<?=$j?>" value="<?php echo $editChild['purchase_debit_note_child_product_name']; ?>" class="form-control"  />																
													
												</td>
												
												<td><input type="hidden" name="purchase_debit_note_child_product_color_id[]" id="purchase_debit_note_child_product_color_id_<?=$j?>" value="<?= $editChild['purchase_debit_note_child_product_code']; ?>"/><?=$editChild['product_colour_name']?> </td>
												
												<td>																
													<input type="hidden" name="purchase_debit_note_child_product_thick_ness[]" id="purchase_debit_note_child_product_thick_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_thick_ness']?>" class="form-control"  />
													<?=$editChild['purchase_debit_note_child_product_thick_ness']?>
												</td>
												
												<td>																
													<input type="hidden" name="purchase_debit_note_child_product_uom_id[]" id="purchase_debit_note_child_product_uom_id_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_uom_id']?>" class="form-control"  />
													<?=$editChild['product_uom_name']?>
												</td>
												
												<td>																
													<input type="text" name="purchase_debit_note_child_product_width_inches[]" id="purchase_debit_note_child_product_width_inches_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_width_inches']?>" class="form-control" onBlur="GetWcalc(2,<?=$j?>);"/>
												</td>
												
												<td>																
													<input type="text" name="purchase_debit_note_child_product_width_mm[]" id="purchase_debit_note_child_product_width_mm_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_width_mm']?>" class="form-control" onBlur="GetWcalc(3,<?=$j?>);"/>
												</td>
												<td>																
													<input type="text" name="purchase_debit_note_child_product_length_feet[]" id="purchase_debit_note_child_product_length_feet_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_length_feet']?>" class="form-control" onBlur="GetCLcalc(1,<?=$j?>);"/>
												</td>
												<td>																
													<input type="text" name="purchase_debit_note_child_product_length_mm[]" id="purchase_debit_note_child_product_length_mm_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_length_mm']?>" class="form-control" onBlur="GetCLcalc(3,<?=$j?>);"/>
												</td>
												<td>																
													<input type="text" name="purchase_debit_note_child_product_ton_qty[]" id="purchase_debit_note_child_product_ton_qty_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_ton_qty']?>" class="form-control" />
												</td>
												<td>																
													<input type="text" name="purchase_debit_note_child_product_kg_qty[]" id="purchase_debit_note_child_product_kg_qty_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_kg_qty']?>" class="form-control" />
												</td>
												<td>
												<input type="hidden" name="purchase_debit_note_child_product_id[]" id="purchase_debit_note_child_product_id_<?=$j?>" value="<?=$editChild['purchase_debit_note_child_product_id']?>" />
												<?php if($count_child_id>1){?><a href="index.php?grnProdChildId=<?=$editChild['purchase_debit_note_child_product_id']?>&grnId=<?=$editReceipt['grnId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
												
												</tr>
											<?php   $j = $j + 1;}
												  }
												 ?>	
											</tbody>
																						
										</table>					
									</div>
									
								</div>
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="debit_nsrtUpdate" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
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
								Debit list
							</div>
							<div class="panel-body">
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
									<form name="debit-forms" id="debit-forms" method="post" enctype="multipart/form-data">
									<table class="table table-striped table-bordered table-hover" id="dataTables-debit">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Debitnote id</th>										
												<th>Purchase id</th>
												<th>Branch</th>
												<th>Type</th>
												<th>Date</th>
												<th>Action</th>
												<th>
												<input name="checkall" onClick="checkedall();" type="checkbox"  />
												<button name="debit_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($debitList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['debitnoteId']; ?></td> 
												<td><?php echo $result['d_purchaseId']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $debit_type[$result['d_type']]; ?></td>
												<td><?php echo $result['d_debitdate']; ?></td>
												                                      
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['debitnoteId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
												<input name="deleteCheck[]" value="<?php echo $result['debitnoteId']; ?>" type="checkbox" />
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


	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
	<script>
		$(document).ready(function () {
			$('#dataTables-debit').DataTable( {
				responsive: true
			} );
			/*$('#dataTables-example').dataTable();*/
		});
				
		//Initialize Select2 Elements
		$(".select2").select2();
	 $(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#debitdate" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
		
			$( "#production_planning_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#production_planning_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
		$( "#debit-forms" ).validate({
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

 
