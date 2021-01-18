<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Engineering</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-product-con-entry/coin-entry-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Inventory Request & Receipt</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) { echo $msg; }
							?>
						</h1>
                    </div>
                </div>				
				<?php
					if((isset($_GET['page'])) && ($_GET['page']=='add')){ 
				?>
					<form name="coin_forms" id="coin_forms" method="post" enctype="multipart/form-data">
						<div class="row">
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="panel panel-info">
									<div class="panel-heading">	
										Inventory product receipt									 
									</div>									
									<div class="panel-body">
										<div class="col-lg-6">										
											<div class="form-group">
												<label>Branch</label>
												<select name="product_con_entry_branch_id" id="product_con_entry_branch_id" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
														?>
															<option value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
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
												  <input type="text" class="form-control"  name="product_con_entry_date" id="product_con_entry_date" readonly="" value="" required>	
												</div>
											</div>	
										</div>
									
									</div>		
								</div>
								<div class="panel panel-info">
									<div class="panel-heading">
									  Invoice Detail
									</div>
									<div class="panel-body">
										<div class="col-lg-6">
											<button type="button" onClick="GetSodetail();" data-toggle="modal" data-target="#soModal" data-id="1" class="glyphicon glyphicon-plus"></button>
										</div>
										<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >
											<thead>
												<tr>
													<th style=" width:30%;">Inv No</th>
													<th  style=" width:25%;">Inv Date</th>
												</tr>
											</thead>
											<tbody id="so_detail_display">
											</tbody>
										</table>
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
											<?php $count_val = !empty($editRequstProd) ? count($editRequstProd) :''; ?>
											<input type="hidden" id="receipt_apnd" name="receipt_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">
												<tr style="">
													<th rowspan="2" style="width:20%;">Product Name</th>
													<th rowspan="2">Code</th>
													<th rowspan="2">Uom</th>
													<th rowspan="2">Color</th>
													<th colspan="2" style="text-align:center">Width</th>
													<th colspan="2" style="text-align:center">Length</th>
													<th rowspan="2">Total</th>	
													<th rowspan="2">Total qty</th>													
												</tr>
												<tr>
													<th>Inches</th>
													<th>Mm</th>
													<th>Ft</th>
													<th>Mm</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												   for($i=0;$i<count($editRequstProd);$i++){													
												 ?>
											 <tr id="remove_req_<?php echo $i; ?>">
												<td>
														<input type="hidden" name="idd_<?php echo $i; ?>" value="<?php echo $editRequstProd[$i]['invReqProdId']; ?>">																
														<div class="ui-widget"><input type="text" class="form-control" name="prod_name_rcpt_<?php echo $i; ?>" id="prod_name_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['iRp_productid'].' - '.$editRequstProd[$i]['product_name']; ?>" onKeyUp="return get_product(this.value,this,<?php echo $i; ?>,2 );">
														</div>
													</td>
													<td>																
														<input type="text" class="form-control" name="prod_code_rcpt_<?php echo $i; ?>" id="prod_code_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['product_code']; ?>" readonly="">
													</td>
													<td>																
														<input type="text" class="form-control" name="prod_uom_rcpt_<?php echo $i; ?>" id="prod_uom_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['product_uom_name']; ?>" readonly="">
													</td>
													<td>																
														<input type="text" class="form-control" name="qty_rcpt_<?php echo $i; ?>" id="qty_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['iRp_qty']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="bal_qty_rcpt_<?php echo $i; ?>" id="bal_qty_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['iRp_balance']; ?>">
													</td><td>																
														<input type="text" class="form-control" name="stock_rcpt_<?php echo $i; ?>" id="stock_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['iRp_stock']; ?>">
													</td>
													<td>
														
													</td>
												</tr>
											<?php   }
											 ?>	
											</tbody>	
										</table>					
									</div>
									
								</div>
								
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Submit' : 'Update' ; ?>
									<button name="request_insrtUpdate" type="submit" class="btn btn-primary" onClick="validation();"><?php echo $btnVal; ?> Button</button>
								<button type="reset" class="btn btn-danger">Reset Button</button>
							</div>
							
						</div>
					</form>
				<?php
					} 
					if((isset($_GET['page'])) && ($_GET['page']=='edit')){ 	
						
					?>	
					<form name="coin_forms" id="coin_forms" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editRequst['inventoryRequestId'])?"":$editRequst['inventoryRequestId']; ?>" >

						<div class="row">
						
							
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Inventory product receipt									 
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label>Branch</label>
												<select name="product_con_entry_branch_id" id="product_con_entry_branch_id" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editRequst['iRq_branch'] == $get_branch['branch_id']){ $select ='selected="selected"'; }
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											
											
											<div class="form-group">
												<label>Invoice no</label>
												<select name="request_id" id="request_id" class="form-control select2" style="width:100%" onChange="return requestIdFn(this.value);">
													 <option value=""> - Select - </option>
													  <?php
														foreach($inventoryReqlist  as $get_Req){
															if($editRequst['iRq_receiptReferenceId'] == $get_Req['inventoryRequestId']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_Req['inventoryRequestId']?>"><?=$get_Req['inventoryRequestId']?></option>
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
												  <input type="text" class="form-control"  name="date_rcpt" id="date_rcpt" readonly="" value="<?php echo empty($editRequst['iRq_receiptReferenceId'])?"":$editRequst['iRq_receiptReferenceId']; ?>" required>	
												</div>
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
											<?php $count_val = !empty($editRequstProd) ? count($editRequstProd) :''; ?>
											<input type="hidden" id="receipt_apnd" name="receipt_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">
												<tr style="">
													<th rowspan="2" style="width:20%;">Product Name</th>
													<th rowspan="2">Code</th>
													<th rowspan="2">Uom</th>
													<th rowspan="2">Color</th>
													<th colspan="2" style="text-align:center">Width</th>
													<th colspan="2" style="text-align:center">Length</th>
													<th rowspan="2">Total</th>	
													<th rowspan="2">Total qty</th>													
												</tr>
												<tr>
													<th>Inches</th>
													<th>Mm</th>
													<th>Ft</th>
													<th>Mm</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
												   for($i=0;$i<count($editRequstProd);$i++){													
												 ?>
											 <tr id="remove_req_<?php echo $i; ?>">
												<td>
														<input type="hidden" name="idd_<?php echo $i; ?>" value="<?php echo $editRequstProd[$i]['invReqProdId']; ?>">																
														<div class="ui-widget"><input type="text" class="form-control" name="prod_name_rcpt_<?php echo $i; ?>" id="prod_name_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['iRp_productid'].' - '.$editRequstProd[$i]['product_name']; ?>" onKeyUp="return get_product(this.value,this,<?php echo $i; ?>,2 );">
														</div>
													</td>
													<td>																
														<input type="text" class="form-control" name="prod_code_rcpt_<?php echo $i; ?>" id="prod_code_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['product_code']; ?>" readonly="">
													</td>
													<td>																
														<input type="text" class="form-control" name="prod_uom_rcpt_<?php echo $i; ?>" id="prod_uom_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['product_uom_name']; ?>" readonly="">
													</td>
													<td>																
														<input type="text" class="form-control" name="qty_rcpt_<?php echo $i; ?>" id="qty_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['iRp_qty']; ?>">
													</td>
													<td>																
														<input type="text" class="form-control" name="bal_qty_rcpt_<?php echo $i; ?>" id="bal_qty_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['iRp_balance']; ?>">
													</td><td>																
														<input type="text" class="form-control" name="stock_rcpt_<?php echo $i; ?>" id="stock_rcpt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editRequstProd[$i]['iRp_stock']; ?>">
													</td>
													<td>
														
													</td>
												</tr>
											<?php   }
												  }else{
												 ?>	
												 <tr>
													<td colspan="8" style="text-align:center">No record founds</td>
												</tr>
											 <?php }
											 ?>	
											</tbody>	
										</table>					
									</div>
									
								</div>
								
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Submit' : 'Update' ; ?>
									<button name="request_insrtUpdate" type="submit" class="btn btn-primary" onClick="validation();"><?php echo $btnVal; ?> Button</button>
								<button type="reset" class="btn btn-danger">Reset Button</button>
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Request Receipt list
							</div>
							<div class="panel-body">
								<div class="table-responsive">
										<form name="coin_forms" id="coin_forms" method="post" enctype="multipart/form-data">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Type</th>										
												<th>Employee</th>
												<th>Branch</th>
												<th>Department</th>
												<th>Date</th>
												<th>Action</th>
												<th>
												<input name="checkall" onClick="checkedall();" type="checkbox"  />
												<button name="inventory_delete" type="submit" class="btn btn-danger">Delete</button>
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
												<td><?php if($result['iRq_type']==1){echo "Rrequest";}elseif($result['iRq_type']==2){ echo "Receipt";} ?></td> 
												<td><?php echo $result['employee_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['department_name']; ?></td>
												<td><?php echo $result['iRq_rqdate']; ?></td>
												                                      
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['inventoryRequestId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
												<input name="deleteCheck[]" value="<?php echo $result['inventoryRequestId']; ?>" type="checkbox" />
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
		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Invoice Detail</h4>

					</div>

					<div class="modal-body">

						<div class="table-responsive">

							<div id="so_detail_content">

							</div>

						</div>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

						<button type="button" class="btn btn-primary" onClick="AddSodetail()"  data-dismiss="modal">Save changes</button>

					</div>

				</div>

			</div>

		</div>
	</div>

	<script>
		$(document).ready(function () {
			$.noConflict();
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
			
		});
		$( "#product_con_entry_date" ).datepicker({
			 dateFormat: 'dd/mm/yy',
		});
			
				
	</script>

</body>

 
