<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GATEPASS</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		
		if($_GET['msg']==1) {
			$msg = 'Added successfully';
		}elseif($_GET['msg']==2) {
			$msg = 'Updated successfully';
		}elseif($_GET['msg']==3) {
			$msg = 'Deleted successfully';
		} 
		
		
	}		
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/gate-pass/gatepass-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DELIVERY TO CUSTOMER (GATEPASS)</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn btn-success" onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>
				   
                </div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>	
					<form name="gatpassid" id="gatpassid" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($gpdetailEdit['gatePassId'])?"":$gpdetailEdit['gatePassId']; ?>" >

						<div class="row">
						
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										GATEPASS	
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($gpdetailEdit['gp_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
											</div>	
											<div class="form-group">
												<label class="control-label">Gate pass no</label>
												<select name="gatepassno" id="gatepassno" class="form-control select2" style="width:100%" onChange="return requestPoFn(this.value);" required>
													 <option value=""> - Select - </option>
													  <?php
														foreach($production_delivery  as $get_id){
															if($gpdetailEdit['gp_pdo_entry_id'] == $get_id['pdo_entry_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_id['pdo_entry_id']?>"><?=$get_id['pdo_entry_id']?></option>
													<?php
														}
														?>
												</select>
											</div>			
											
											<div class="form-group">
												<label >Customer name</label>
												<input type="text" class="form-control"  name="cust_name" id="cust_name" readonly="" value="<?php echo empty($gpdetailEdit['customer_name'])?"":$gpdetailEdit['customer_name']; ?>" >
													
											</div>	
											<div class="form-group">
												<label>Vehicle no</label>
												<input type="text" class="form-control"  name="vechile_no" id="vechile_no" readonly="" value="<?php echo empty($gpdetailEdit['pdo_entry_vehicle_no'])?"":$gpdetailEdit['pdo_entry_vehicle_no']; ?>">
													
											</div>	
										</div>																				
										<div class="col-lg-6">
											<div class="form-group">
												<label class="control-label">Date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control"  name="gate_passdate" id="gate_passdate" readonly="" value="<?php echo empty($gpdetailEdit['gp_date'])?"":$gpdetailEdit['gp_date']; ?>" required>	
												</div>
											</div>	
											<div class="form-group">
												<label>Deliver by</label>
												<input type="text" class="form-control"  name="deliver_by" id="deliver_by"   value="<?php echo empty($gpdetailEdit['pdo_entry_delivery_type'])?"":$arr_delivery_type[$gpdetailEdit['pdo_entry_delivery_type']]; ?>" readonly="">	
													
											</div>	
											<div class="form-group">
												<label>Driver name</label>
												<input type="text" class="form-control"  name="driver_name" id="driver_name"  value="<?php echo empty($gpdetailEdit['pdo_entry_driver_name'])?"":$gpdetailEdit['pdo_entry_driver_name']; ?>" readonly="">	
													
											</div>			
												
									</div>		
								</div>
								
								</div>
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										DELIVERY PRODUCT DETAILS						 
									</div>
									
									<div class="panel-body">
										<div class="table-responsive">
											<table id="product_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val = !empty($gpproductsEdit) ? count($gpproductsEdit) :''; ?>
											<input type="hidden" id="prod_apnd" name="prod_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">
												<tr>
													<th rowspan="2" style="width:20%;">Product Name</th>
													<th rowspan="2">Code</th>
													<th rowspan="2">Color</th>
													<th rowspan="2">Thik</th>
													<th colspan="2" style="text-align:center">Width</th>
													<th colspan="2" style="text-align:center">Length</th>	
													<th rowspan="2" style="width:10%;">UOM</th>
													<th rowspan="2" style="width:10%;">Qty</th>
												</tr>
												<tr>
													<th>Inches</th>
													<th>MM</th>
													<th>Feet</th>
													<th>MM</th>
												</tr>
												
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
												   for($i=0;$i<count($gpproductsEdit);$i++){													
												 ?>
											 <tr id="remove_req_<?php echo $i; ?>">
												<td><?php echo $gpproductsEdit[$i]['product_name']; ?>
													<input type="hidden" name="pid_<?php echo $i; ?>" value="<?php echo $gpproductsEdit[$i]['gpProductdetailsId']; ?>">																
													<input type="hidden" class="form-control" name="pdo_entryid_<?php echo $i; ?>" id="pdo_entryid_<?php echo $i; ?>" value="<?php echo $gpproductsEdit[$i]['pdo_entry_id']; ?>">
													<input type="hidden" class="form-control" name="productid_<?php echo $i; ?>" id="productid_<?php echo $i; ?>" value="<?php echo $gpproductsEdit[$i]['pdo_entry_product_detail_product_id']; ?>">
													
												</td>
												
												<td><?php echo $gpproductsEdit[$i]['product_code']; ?></td>
												<td><?php echo $gpproductsEdit[$i]['product_colour_name']; ?></td>
												<td><?php echo $gpproductsEdit[$i]['product_thick_ness']; ?></td>
												<td><?php echo $gpproductsEdit[$i]['pdo_entry_product_detail_width_inches']; ?></td>
												<td><?php echo $gpproductsEdit[$i]['pdo_entry_product_detail_width_mm']; ?></td>
												<td><?php echo $gpproductsEdit[$i]['pdo_entry_product_detail_width_inches']; ?></td>
												<td><?php echo $gpproductsEdit[$i]['pdo_entry_product_detail_length_feet']; ?></td>
												<td><?php echo $gpproductsEdit[$i]['product_uom_name']; ?></td>
												<td>																
													<input type="text" class="form-control" name="qty_<?php echo $i; ?>" id="qty_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $gpproductsEdit[$i]['pdo_entry_product_detail_qty']; ?>">
												</td>
												</tr>
											<?php   }
												  }
												 ?>	
												
											
											</tbody>	
																						
										</table>	
										</div>				
									</div>
									
								</div>
								
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="gatepass_insert" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?></button>
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Gatepass list
							</div>
							<div class="panel-body">
								<div class="table-responsive">
								<form action="index.php" method="post">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Gatepass id</th>	
												<th>Product delivery id</th>										
												<th>Customer</th>
												<th>Deliver by</th>
												<th>Date</th>
												<th>Action</th>
												<th>
													<input name="checkall" id="checkall" onClick="checkedAll(this);" type="checkbox"  />
													<button name="gatepass_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($gpList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['gatePassId']; ?></td>
												<td><?php echo $result['gp_pdo_entry_id']; ?></td>
												<td><?php echo $result['customer_name']; ?></td>
												<td><?php echo $arr_delivery_type[$result['pdo_entry_delivery_type']]; ?></td>
												<td><?php echo $result['gp_date']; ?></td>
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['gatePassId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
													<input name="deleteCheck[]" class="check" value="<?php echo $result['gatePassId']; ?>" type="checkbox" />
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
			$('#dataTables-example,#product_table').DataTable( {
				responsive: true
			} );	
			
		});
		$( "#gate_passdate" ).datepicker({
			 changeMonth:true,
			 changeYear:true,
			 dateFormat: 'dd/mm/yy',
		});
		
		
		$( "#gatpassid" ).validate({
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

 
