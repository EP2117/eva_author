<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PROFIT & LOSS</title>
<?php 
	include "../includes/common/header.php";
	
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-grn/eva-grn-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">PROFIT & LOSS</h1>
                    </div>
                </div>				
						<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										PROFIT & LOSS							 
									</div>									
									<div class="panel-body">
										<div class="row">
										 <form id="profit-loss-form" name="stock-form" method="post">
										<div class="col-lg-12">
											<div class="col-lg-3">										
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
											</div>
											<!--<div class="col-lg-3">	
												<div class="form-group">
													<label>Type</label>
													<select name="type" id="type" class="form-control select2" style="width:100%" >
														 <option value=""> - Select - </option>
															<option <?php if(searchValue('type') == 1){ echo 'selected="selected"'; }?> value="1">Summary</option>
															<option <?php if(searchValue('type') == 2){ echo 'selected="selected"'; }?> value="2">Detail</option>
															
													</select>
														
												</div>	
											</div>-->		
											<div class="col-lg-3">
												<div class="form-group">
													<label>From date</label>
													 <input type="text" class="form-control"  name="fromdate" id="fromdate" readonly="" value="<?php echo searchValue('fromdate'); ?>" required>	
														
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>To Date</label>
													
													 <input type="text" class="form-control"  name="todate" id="todate" readonly="" value="<?php echo searchValue('todate'); ?>" required>	
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label>&nbsp;</label>
													<button name="stockAvailable" type="submit"class="form-control btn btn-danger">Search</button>
												</div>
														
											</div>
										</div>
										<!--<div class="col-lg-12">
											<div class="col-lg-3">
												<div class="form-group">
													<button name="stockAvailable" type="submit"class="btn btn-danger">Search</button>
												</div>
														
											</div>
										</div>-->																	
											
										</form>
										</div>
									
									</div>
								</div>	
								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-info">
										
											<div class="panel-heading">	
												PROFIT & LOSS							 
											</div>	
											
											<div class="panel-body">
											<?php
												if(isset($_REQUEST['stockAvailable'])){
											?>
												<table id="profitloss_table" class="table table-striped table-bordered table-hover">
															<tr>
															  <th>Total Net Sale</th>
															  <th></th>
															</tr>
													<?php
													$sale_entry_total = 0;
													if($sale_entry) {
														foreach($sale_entry as $get_value){
												   ?>
														<tr>
														  <td><?php echo $get_value['product_category_name']?></td>
														  <td class="text-right"><?php echo number_format($get_value['invoice_entry_net_amount']);?></td>
														</tr>
														
														<?php 
															$sale_entry_total = $sale_entry_total + $get_value['invoice_entry_net_amount'];
																			
																}
															}
														?>
														<!--<tr>
														  <th>Sale Return/Refund</th>	  
														  <th>Amount</th>
														</tr>-->
													<?php
													$credit_entry_total = 0;
													$net_sale = 0;
													if($sale_return_entry) {
														foreach($sale_return_entry as $get_value){
												   ?>
														<tr>
														  <td>Sale Return/Refund</td>
														  <td class="text-right"><?php echo number_format($get_value['credit_entry_amount']);?></td>
														</tr>
													<?php 
														$credit_entry_total = $credit_entry_total + $get_value['credit_entry_amount'];
															}
														}	
														$net_sale = $sale_entry_total - $credit_entry_total;
													?>
													<tr>
														<th>Net Sale</th>														
														<th class="text-right"><?php echo number_format($net_sale); ?></th>
													</tr>
													<tr>
														<th>Cost of Good Sold</th>
														<th></th>
													</tr>
													
													<?php
													$purchase_total = 0;
													if($purchase_entry) {
														foreach($purchase_entry as $get_value){
												   ?>
													<tr>
													  <td><?php echo "Purchase"; ?></td>
													  <td class="text-right"><?php echo number_format($get_value['purchase_amount']);?></td>
													</tr>
													
													<?php 
														$purchase_total = $purchase_total + $get_value['purchase_amount'];				
															}
														}
													?>
													
													<?php
													$purchase_return_total = 0;
													if($purchase_return_entry) {
														foreach($purchase_return_entry as $get_value){
												   ?>
													<tr>
													  <td><?php echo "Purchase Return"; ?></td>
													  <td class="text-right"><?php echo number_format($get_value['debit_entry_amount']);?></td>
													</tr>
													
													<?php 
														$purchase_return_total = ($purchase_return_total + $get_value['debit_entry_amount']) * -1;
															}
														}
													?>
													
													<?php
													//print_r($transaction_entry);
													$transaction_total = $purchase_total - $purchase_return_total;
													if($transaction_entry) {
														foreach($transaction_entry as $get_value){
												   ?>
													<tr>
													  <td><?php echo $arr_account_type21[$get_value['account_head_type2']]; ?></td>
													  <td class="text-right"><?php echo number_format($get_value['transaction_amount']);?></td>
													</tr>
													
													<?php 
																if($get_value['account_head_type2'] == 'op' || $get_value['account_head_type2'] == 'ci' || $get_value['account_head_type2'] == 'mf') {
																	$transaction_total = $transaction_total + $get_value['transaction_amount'];
																} else {
																	$transaction_total = $transaction_total - $get_value['transaction_amount'];
																}				
															}
														}
														$gross_profit = $net_sale - $transaction_total;
													?>
													
													<tr>
														<th>Gross Profit</th>
														<th class="text-right"><?php echo number_format($gross_profit);?> </th>
													</tr>
													
													<?php
													//print_r($income_entry);
													$income_total = 0;
													$expense_total = 0;
													if($income_expense_entry) {
														foreach($income_expense_entry as $get_key => $get_value_arr){
															if($get_key == 'in') {
																echo "<tr><th>Income</th><th></th></tr>";
															}
															else if($get_key == 'ex') {
																	echo "<tr><th>Expense</th><th></th></tr>";
															}else{}
															
															foreach($get_value_arr as $get_value){
												   ?>
													<tr>
													  <td><?php echo $get_value['account_name']; ?></td>
													  <td class="text-right"><?php echo number_format($get_value['transaction_amount']);?></td>
													</tr>
													
													<?php 
															if($get_value['account_head_type2'] == 'in') {
																$income_total = $income_total + $get_value['transaction_amount'];
															}
															else if($get_value['account_head_type2'] == 'ex') {
																$expense_total = $expense_total + $get_value['transaction_amount'];
															}else{}
																
															}
														}
													}
														
													?>
													
													<tr>
														<th>Total Expenditure</th>
														<th class="text-right"><?php echo number_format($income_total - $expense_total); ?></th>
													</tr>
													
													<tr>
														<th>Net Profit  Before Tax</th>
														<th class="text-right">
															<?php 
																$before_tax = ($gross_profit + $income_total) - $expense_total;
																echo number_format($before_tax); 
															?>
														</th>
													</tr>
													
													<tr>
														<th>Taxation</th>
														<th class="text-right">
															<?php 
																$tax = $before_tax/25;
																echo number_format($tax); 
															?>
														</th>
													</tr>
													
													<tr>
														<th>Net Profit After Tax</th>
														<th class="text-right">
															<?php 
																echo number_format($before_tax - $tax); 
															?>
														</th>
													</tr>
													 
												</table>
												<?php
													}
												?>
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
			$('#profitloss_table').DataTable( {
				responsive: true
			} );	
			
		});
		$( "#fromdate" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			dateFormat:'dd/mm/yy',
			onClose: function( selectedDate ) {
				$( "#todate" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#todate" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			dateFormat:'dd/mm/yy',
			onClose: function( selectedDate ) {
				$( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
		$("#profit-loss-form").validate({
			rules: {
				branchid:"required",
				//type:"required",
				fromdate: "required",
				todate: "required"
			}
		});	
	</script>

</body>

 
