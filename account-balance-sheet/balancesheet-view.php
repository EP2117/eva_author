<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BALANCE SHEET</title>
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
                        <h1 class="page-head-line">BALANCE SHEET</h1>
                    </div>
                </div>				
						<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										BALANCE SHEET							 
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
											<div class="col-lg-3">	
												<div class="form-group">
													<label>Type</label>
													<select name="type" id="type" class="form-control select2" style="width:100%" >
														 <option value=""> - Select - </option>
															<option <?php if(searchValue('type') == 1){ echo 'selected="selected"'; }?> value="1">Summary</option>
															<option <?php if(searchValue('type') == 2){ echo 'selected="selected"'; }?> value="2">Detail</option>
															
													</select>
														
												</div>	
											</div>			
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
										</div>
										<div class="col-lg-12">
											<div class="col-lg-3">
												<div class="form-group">
													<button name="stockAvailable" type="submit"class="btn btn-danger">Search</button>
												</div>
														
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
												BALANCE SHEET						 
											</div>	
											
											<div class="panel-body">
												<table id="profitloss_table" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Liabilies/Asset</th>
															<th>Credit</th>
															<th>Debit</th>
															
														</tr>
													</thead>
													<tbody>
													<?php 	  
													$s_no = 1; 
													$get_credit_total	= 0;
													$get_debit_total	= 0;
													$accounts_group_id	= '';
													$get_sub_credit_total	= 0;
													$get_sub_debit_total	= 0;
													$search_report_type		= $_REQUEST['type'];
													
												if($list_ledger_entry) {
													foreach($list_ledger_entry as $get_value){
													$accounts_id	= (isset($get_value['account_id']))?$get_value['accounts_id']:'';
										
													$page=$s_no%2;
													if($page==0){
														$style="alt";
													} 
													else{
														$style="";
													}
													if($search_report_type=="2" && $accounts_group_id!=$get_value['accounts_group_id']){
														if($s_no!=1){
														?>
															<tr >
															  <td valign="top"><strong>Sub Total</strong></td>
															  
															  <td valign="top" style="text-align:right; font-size:15px;"><strong><?php echo $get_sub_credit_total     ?></strong></td>
															  <td valign="top" style="text-align:right; font-size:15px;"><strong><?php echo $get_sub_debit_total     ?></strong></td>
															</tr>
														<?php
														$get_sub_credit_total	= 0;
														$get_sub_debit_total	= 0;
														}
														?>
															<tr>
																<td colspan="3" style="text-align:center; font-size:14px;"><strong><?=$get_value['account_group_name']?></strong></td>
															</tr>
														<?php
														$accounts_group_id		= $get_value['accounts_group_id'];
													}	
													 ?>
														<tr class="" onClick="Getdisplay(<?=$accounts_id?>)">
													  <td valign="top"><?php if($search_report_type=="1"){  echo $get_value['account_group_name']; } else{ echo 	$get_value['accounts_name']; }  ?></td>
													  
													  <td valign="top" style="text-align:right; font-size:15px;"><?php echo $get_value['credit_amount'];     ?></td>
													  <td valign="top" style="text-align:right; font-size:15px;"><?php echo $get_value['debit_amount'];     ?></td>
													  
													</tr>
													<?php 
													$get_sub_credit_total	= $get_sub_credit_total+$get_value['credit_amount'];
													$get_sub_debit_total	= $get_sub_debit_total+$get_value['debit_amount'] ;
										
													$get_credit_total	= $get_credit_total+$get_value['credit_amount'];
													$get_debit_total	= $get_debit_total+$get_value['debit_amount'] ;
													 
														$s_no	= $s_no+1;
														}
														?>
														<?php
														if($search_report_type=="2"){
														?>
															<tr >
															  <td valign="top"><strong>Sub Total</strong></td>
															  
															  <td valign="top" style="text-align:right; font-size:15px;"><strong><?php echo $get_sub_credit_total     ?></strong></td>
															  <td valign="top" style="text-align:right; font-size:15px;"><strong><?php echo $get_sub_debit_total     ?></strong></td>
															</tr>
														<?php
														}
														?>	
														
													<tr class="<?php echo $style; ?>">
													  <td valign="top"><strong>Total</strong></td>
													  
													  <td valign="top" style="text-align:right; font-size:15px;"><strong><?php echo $get_credit_total     ?></strong></td>
													  <td valign="top" style="text-align:right; font-size:15px;"><strong><?php echo $get_debit_total     ?></strong></td>
													  
													</tr>
														<?php
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
				type:"required",
				fromdate: "required",
				todate: "required"
			}
		});	
	</script>

</body>

 
