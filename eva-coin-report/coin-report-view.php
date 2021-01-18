<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>COIN REPORT</title>
<?php 
	include "../includes/common/header.php";
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-coin-report/coin-report-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Coin Report</h1>
                        <h1 class="page-subhead-line">
							
						</h1>
                    </div>
                </div>				
				
						<div class="row">
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Coin Report									 
									</div>	
									<form action="index.php" id="coin_form" name="coin_form" method="post">								
									<div class="panel-body">
										<?php if(isset($_POST['branchid_rcpt'])) {
										
													$branchid_rcpt = $_POST['branchid_rcpt'];   
												} else {
													$branchid_rcpt = ''; 
													
													
												}
												
												 if(isset($_POST['from_date_rcpt'])) {
										
													$from_date_rcpt = $_POST['from_date_rcpt'];   
												} else {
													$from_date_rcpt = ''; 
													
													
												}
												
												 if(isset($_POST['to_date_rcpt'])) {
										
													$to_date_rcpt = $_POST['to_date_rcpt'];   
												} else {
													$to_date_rcpt = ''; 
													
													
												}
					
					
					?>
										<div class="col-lg-6">										
											<div class="form-group">
												<label>Branch</label>
												<select name="branchid_rcpt" id="branchid_rcpt" class="form-control select2" style="width:100%"  >
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															
														?>
															<option <?php if($branchid_rcpt == $get_branch['branch_id']){ echo 'selected="selected"'; }?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											
											<div class="form-group">
												<label>To date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control"  name="to_date_rcpt" id="to_date_rcpt" readonly="" value="<?php echo $to_date_rcpt;  ?>" required>	
												</div>
											</div>	
												
																				
										</div>																				
										<div class="col-lg-6">
												
											<div class="form-group">
												<label>From date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control"  name="from_date_rcpt" id="from_date_rcpt" readonly="" value="<?php echo $from_date_rcpt;  ?>" required>	
												</div>
											</div>	
												
												
										
									</div>
									
									<div class="col-lg-12">
									<div style="text-align:center">
									<button class="btn btn-success" id="search" name="search">Search</button>
									</div>
									</div>
									
								</div>		
								</div>
								</form>
								<?php if(isset($_REQUEST['search'])){?>
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									
									<div class="panel-body">
									
									<form action="index.php" method="post">
										<table id="receipt_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val = !empty($editRequstProd) ? count($editRequstProd) :''; ?>
											<input type="hidden" id="receipt_apnd" name="receipt_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">
												<tr>
													<th rowspan="2" style="width:20%;">Product Name</th>
													<th rowspan="2">Code</th>
													<th rowspan="2">UOM</th>
													
													
													<th colspan="2" style="text-align:center">Width</th>
													<th colspan="2" style="text-align:center">Length</th>
													<th rowspan="2">Qty</th>	
												</tr>
												<tr>
													<th>FEET</th>
													<th>INCHES</th>
													<th>MM</th>
													<th>METERS</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if($search_list){
												   foreach($search_list as $editRequstProd){													
												 ?>
												 <tr id="remove_req_<?php echo $i; ?>">
													<td>
													<?php echo $editRequstProd['product_name']; ?>
														
													</td>
													<td>																
													<?php echo $editRequstProd['product_code']; ?>	
													</td>
													<td>																
													<?php echo $editRequstProd['product_uom_name']; ?>	
													</td>
													<td>																
													<?php echo $editRequstProd['product_con_entry_product_detail_width_inches']; ?>	
													</td>
													<td>																
													<?php echo $editRequstProd['product_con_entry_product_detail_width_mm']; ?>	
													</td><td>																
													<?php echo $editRequstProd['product_con_entry_product_detail_length_feet']; ?>	
													</td>
													<td>
													<?php echo $editRequstProd['product_con_entry_product_detail_length_mm']; ?>	
													</td>
													<td>
													<?php echo $editRequstProd['product_con_entry_product_detail_qty']; ?>	
													</td>
												</tr>
												<?php if(!empty($editRequstProd['product_con_entry_product_detail_product_con_entry_id'])){?>
												<table id="receipt_table" class="table table-striped table-bordered table-hover">
											<thead>
											
												<tr>
													<th rowspan="2" style="width:20%;">Product Code</th>
													<th rowspan="2">Name</th>
													
													<th rowspan="2">Color</th>
													
													
													<th colspan="2" style="text-align:center">Width</th>
													<th colspan="2" style="text-align:center">Length</th>
													<th rowspan="2">UOM</th>
													<th rowspan="2">Total</th>	
												</tr>
												<tr>
													<th>Inches</th>
													<th>MM</th>
													<th>FT</th>
													<th>MM</th>
												</tr>
											</thead>
												<?php $select ="SELECT * FROM product_con_entry_child_product_details 
												LEFT JOIN product_colours ON product_colour_id= product_con_entry_child_product_detail_color_id
												LEFT JOIN product_uoms ON product_uom_id= product_con_entry_child_product_detail_uom_id
												WHERE 	product_con_entry_child_product_detail_product_con_entry_id ='".$editRequstProd['product_con_entry_product_detail_product_con_entry_id']."'";
												$query =mysql_query($select);
												while($result = mysql_fetch_array($query)){
												
												?> 
												<tr id="remove_req_<?php echo $i; ?>">
													<td>
													<?php echo $result['product_con_entry_child_product_detail_code']; ?>
														
													</td>
													<td>																
													<?php echo $result['product_con_entry_child_product_detail_name']; ?>	
													</td>
													<td>																
													<?php echo $result['product_colour_name']; ?>	
													</td>
													<td>																
													<?php echo $result['product_con_entry_child_product_detail_width_inches']; ?>	
													</td>
													<td>																
													<?php echo $result['product_con_entry_child_product_detail_width_mm']; ?>	
													</td><td>																
													<?php echo $result['product_con_entry_child_product_detail_length_feet']; ?>	
													</td>
													<td>
													<?php echo $result['product_con_entry_child_product_detail_length_mm']; ?>	
													</td>
													<td>
													<?php echo $result['product_uom_name']; ?>	
													</td>
													<td>
													<?php echo $result['product_con_entry_child_product_detail_total']; ?>	
													</td>
												</tr>
												<?php }?>
												<?php }?>
												
											<?php   }
												  }else{
												 ?>	
												 <tr>
													<td colspan="12" style="text-align:center">No record founds</td>
												</tr>
											 <?php }
											 ?>	
											 
											</tbody>	
										</table>	
										</form>		
																		
									</div>
									
								</div>
								
							</div>
							<?php }?>
							<!--<div class="col-lg-6">							
								<button name="request_insrtUpdate" type="submit" class="btn btn-primary" onClick="validation();"> Check</button>
								<button type="reset" class="btn btn-danger">Download</button>
							</div>-->
							
						</div>
					
				
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
    </div>
	
<script src="../assets/js/jquery-1.10.2.js"></script>
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
	<script src="../assets/js/jquery.timepicker.js"></script>

	<script>
		$(document).ready(function () {
			$.noConflict();
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
			
		});
	
		$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#from_date_rcpt" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
				$( "#to_date_rcpt" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'',changeMonth:true,changeYear:true,});
			});
			
				
	</script>

</body>

 
