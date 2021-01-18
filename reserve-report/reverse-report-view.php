<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RESERVE REPORT</title>
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
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
					 <div class="col-md-12">
                        <h1 class="page-head-line">RESERVE REPORT</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn btn-warning pull-right" onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>
                </div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>	
					<form name="grn-forms" id="salary-forms" method="post" enctype="multipart/form-data">
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
												<label>Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" >
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
												<label>PO no</label>
												<select name="purchaseid" id="purchaseid" class="form-control select2" style="width:100%" onChange="return requestPoFn(this.value);">
													 <option value=""> - Select - </option>
													  <?php
														foreach($purdetailslist  as $get_po){
															if($editReceipt['grn_purchaseId'] == $get_po['purchaseId']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_po['purchaseId']?>"><?=$get_po['purchaseId']?></option>
													<?php
														}
														?>
												</select>
											</div>			
											<div class="form-group">
												<label>Warehouse</label>
												<select name="warehouseid" id="warehouseid" class="form-control select2" style="width:100%" >
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
												<input type="text" class="form-control"  name="grn_type" id="grn_type" readonly="" value="<?php echo empty($editReceipt['grn_grn_type'])?"":$editReceipt['grn_grn_type']; ?>">
													
											</div>	
											
										</div>																				
										<div class="col-lg-6">
											<div class="form-group">
												<label>GRN Date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control"  name="grn_date" id="grn_date" readonly="" value="<?php echo empty($editReceipt['grn_date'])?"":$editReceipt['grn_date']; ?>" required>	
												</div>
											</div>	
											
											<div class="form-group">
												<label>Supplier location</label>
												<?php  $val = empty($editReceipt['supplier_location'])?"":$editReceipt['supplier_location']; ?>
												<input type="text" class="form-control"  name="supplier_location" id="supplier_location" readonly="" value="<?php echo $val==1?"Loacl":($val==2?"Oversea":""); ?>">	
													
											</div>	
											<div class="form-group">
												<label>Supplier name</label>
												<input type="text" class="form-control"  name="supplier_name" id="supplier_name" readonly="" value="<?php echo empty($editReceipt['supplier_name'])?"":$editReceipt['supplier_name']; ?>">	
													
											</div>			
											<div class="form-group">
												<label>PO date</label>
												<input type="text" class="form-control"  name="po_date" id="po_date" readonly="" value="<?php echo empty($editReceipt['pR_purchase_date'])?"":$editReceipt['pR_purchase_date']; ?>">	
													
											</div>			
									
									</div>		
								</div>
								
								</div>
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									
									<div class="panel-body">
										<table id="receipt_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val = !empty($editReceiptProd) ? count($editReceiptProd) :''; ?>
											<input type="hidden" id="receipt_apnd" name="receipt_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">
												<tr>
													<th rowspan="2" style="width:20%;">Product Name</th>
													<th rowspan="2">Code</th>
													<th rowspan="2" style="width:10%;">UOM</th>
													<th rowspan="2">PO qty</th>
													<th colspan="5" style="text-align:center">Quantity</th>
																										
												</tr>
												<tr>
													<th>Recvd earlier</th>
													<th>Current supply</th>
													<th>Reject</th>
													<th>Accept</th>
													<th>Pending</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
												   for($i=0;$i<count($editReceiptProd);$i++){													
												 ?>
											 <tr id="remove_req_<?php echo $i; ?>">
												<td><?php echo $editReceiptProd[$i]['product_name']; ?>
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
												</tr>
											<?php   }
												  }else{
												 ?>	
												 <tr>
													<td colspan="9" style="text-align:center">No record founds</td>
												</tr>
											 <?php }
											 ?>	
											</tbody>	
											<tfoot>
												<tr>
													<th style="text-align:right;">Remarks</th>
													<th colspan="8"><textarea class="form-control pull-right" rows="1" name="remark" id="remark"><?php echo empty($editReceipt['grn_remarks'])?"":$editReceipt['grn_remarks']; ?></textarea>	
													</th>
												</tr>
											</tfoot>											
										</table>					
									</div>
									
								</div>
								
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Submit' : 'Update' ; ?>
									<button name="receipt_insrtUpdate" type="submit" class="btn btn-primary" onClick="validation();"><?php echo $btnVal; ?> Button</button>
								<button type="reset" class="btn btn-danger">Reset Button</button>
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
							Reserve report list
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Receipt id</th>	
												<th>PO id</th>										
												<th>Warehouse</th>
												<th>Branch</th>
												<th>Date</th>
												<th>Action</th>
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
												<td><?php echo $result['grn_purchaseId']; ?></td>
												<td><?php echo $result['godown_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['grn_date']; ?></td>
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['grnId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
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
		$( "#grn_date" ).datepicker({
			 dateFormat: 'dd/mm/yy',
		});
			
				
	</script>

</body>

 
