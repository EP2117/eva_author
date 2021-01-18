<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WRITE OFF REPORT</title>
<?php 
	include "../includes/common/header.php";
	
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
                        <h1 class="page-head-line">WRITE OFF REPORT</h1>
                    </div>
                </div>				
						<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										WRITE OFF REPORT							 
									</div>									
									<div class="panel-body">
										<div class="row">
										 <form id="writeof-form" name="stock-form" method="post">
											<div class="col-lg-4">										
												<div class="form-group">
													<label>Branch</label>
													<select name="branchid" id="branchid" class="form-control select2" style="width:100%" >
														 <option value=""> - Select - </option>
														<?php
															foreach($branch_list as	$get_branch){
																if(searchValue('branchid') == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
															?>
																<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
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
															if(searchValue('warehouseid') == $get_godown['godown_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?> value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
														<?php
															}
														?>
													</select>
														
												</div>	
												<div class="form-group">
													<label>Brand</label>
													<select name="brandid" id="brandid" class="form-control select2" style="width:100%" >
														 <option value=""> - Select - </option>
														<?php
														foreach($brand_list as $get){
															if(searchValue('brandid') == $get['brand_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?> value="<?=$get['brand_id']?>"><?=$get['brand_name']?></option>
														<?php
															}
														?>
													</select>
														
												</div>			
											</div>			
											<div class="col-lg-4">
												<div class="form-group">
													<label>From date</label>
													 <input type="text" class="form-control"  name="fromdate" id="fromdate" readonly="" value="<?php echo searchValue('fromdate'); ?>" required>	
														
												</div>
												<div class="form-group">
													<label>To Date</label>
													
													 <input type="text" class="form-control"  name="todate" id="todate" readonly="" value="<?php echo searchValue('todate'); ?>" required>	
												</div>
												
												<div class="form-group" style="padding-top:30px;">
													<button name="stockAvailable" type="submit"class="btn btn-danger">Search</button>
												</div>
											</div>																	
											<div class="col-lg-4">
												<div class="form-group">
													<label>PS 1</label>
													<select name="ps_1" id="ps_1" class="form-control select2" style="width:100%" >
														 <option value=""> - Select - </option>
														<?php
														foreach($prod_category  as	$get){
															if(searchValue('ps_1') == $get['product_category_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?> value="<?=$get['product_category_id']?>"><?=$get['product_category_name']?></option>
														<?php
															}
														?>
													</select>
														
												</div>	
												
												<div class="form-group">
													<label>Product status</label>
													<select name="prod_status" id="prod_status" class="form-control select2" style="width:100%" >
														 <option value=""> - Select - </option>
														<?php
														foreach($writeof_type_arry as $key=>$val){
															if(searchValue('prod_status') == $key){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?> value="<?=$key?>"><?=$val?></option>
														<?php
															}
														?>
													</select>
														
												</div>	
														
											</div>
										</form>
										</div>
									
									</div>
								</div>	
								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-info">
										
											<div class="panel-heading">	
												WRITE OFF REPORT							 
											</div>	
											
											<div class="panel-body">
												<table id="writeof_table" class="table table-striped table-bordered table-hover wrtable">
													<thead>
														<tr>
															<th>S.no</th>
															<th>DM R No</th>
															<th>Date</th>
															<th>Prd Code</th>
															<th>Prd Name</th>
															<th>PS 1</th>
															<th>Brand</th>
															<th>Add Qty</th>
															<th>Less Qty</th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody>
													<?php
														if(!empty($reportList)){
														$s_no	= 1;									
														foreach($reportList as $result){
														?>
														<tr class="odd gradeX">
															<td><?php echo $s_no++; ?></td>
															<td><?php echo $result['writeoffId']; ?></td>
															<td><?php echo $result['wr_date']; ?></td>
															<td><?php echo $result['product_code']; ?></td>
															<td><?php echo $result['product_name']; ?></td>
															<td><?php echo $result['product_category_name']; ?></td>
															<td><?php echo $result['brand_name']; ?></td>
															<td><?php echo $result['wrP_addqty']; ?></td>
															<td><?php echo $result['wrP_lessqty']; ?></td>
															<td><?php echo $writeof_type_arry[$result['dms_product_status']]; ?></td>
														</tr>
														                               
													 <?php }
													    }
													  ?>
													</tbody>										
												</table>					
											</div>
										</div>
									</div>
									
								</div>		
										
								
							</div>	
							
						</div>
				
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
       <?=PROJECT_FOOTER?>
    </div>
	

	<script>
		$(document).ready(function () {
			$('.wrtable').DataTable( {
				responsive: true
			} );	
			
		});
		$( "#fromdate" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			onClose: function( selectedDate ) {
				$( "#todate" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#todate" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			onClose: function( selectedDate ) {
				$( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
		$("#writeof-form").validate({
			rules: {
				branchid:"required",
				warehouseid:"required",
				fromdate: "required",
				todate: "required"
			}
		});	
	</script>

</body>

 
