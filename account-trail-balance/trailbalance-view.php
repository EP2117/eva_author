<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TRAIL BALANCE</title>
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
                        <h1 class="page-head-line">TRAIL BALANCE</h1>
                    </div>
                </div>				
						<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										TRAIL BALANCE							 
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
												TRAIL BALANCE						 
											</div>	
											
											<div class="panel-body">
												<table id="profitloss_table" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>S.no</th>			
															<th>Account deatils</th>
															<th>Credit</th>
															<th>Debit</th>
															
														</tr>
													</thead>
													<tbody>
            <?php 	  
														$s_no = 1; 
														$get_cr_open_amt = 0;
														$get_dr_open_amt = 0;	
														$cr_open_amt = 0;
														$dr_open_amt = 0;	
														$cr_amt = 0;
														$dr_amt = 0;
														$tot_cr_amt = 0;
														$tot_dr_amt = 0;
														$description = '';		
														if(isset($_REQUEST['type']) && $_REQUEST['type'] == 2) {
															if($list_ledger_entry) {
																foreach($list_ledger_entry as $get_value){
															
																	$page=$s_no%2;
																
																	if($page==0){
																		$style="alt";
																	} 
																	else{
																		$style="";
																	}		  
																
																		$get_cr_open_amt = listOpening('C', $_REQUEST['fromdate'], $get_value['account_sub_id'], $_REQUEST['branchid']);
																		$get_dr_open_amt = listOpening('D', $_REQUEST['fromdate'], $get_value['account_sub_id'], $_REQUEST['branchid']);
																		
																		list($get_cr_amt, $get_dr_amt) = getAccountTransaction($_REQUEST['fromdate'], $_REQUEST['todate'], $_REQUEST['branchid'], $get_value['account_sub_id'], 'detail');
																		if (($get_cr_open_amt - $get_dr_open_amt) > 0) {
																			$opening_amount	= $get_cr_open_amt - $get_dr_open_amt;
																		}
																		else{
																			$opening_amount	= $get_dr_open_amt - $get_cr_open_amt;
																		}
																		if($get_value['account_sub_type_id']=="1" || $get_value['account_sub_type_id']=="2" ){
																			$cr_amt = number_format($get_cr_amt + $get_cr_open_amt,2,'.','');
																			$dr_amt = number_format($get_dr_amt + $get_dr_open_amt,2,'.','');
																			//$cr_amt = number_format($get_cr_amt,2,'.','') ;
																			//$dr_amt = number_format($get_dr_amt,2,'.','') ;
																		}else{					
																			$cr_amt = number_format($get_cr_amt,2,'.','') ;
																			$dr_amt = number_format($get_dr_amt,2,'.','') ;	
																		}
																			$cr_amt = number_format($get_cr_amt + $get_cr_open_amt,2,'.','');
																			$dr_amt = number_format($get_dr_amt + $get_dr_open_amt,2,'.','');
																		
																			if (($cr_amt - $dr_amt) > 0) {
																				$cr_amt = ($cr_amt - $dr_amt);
																				$dr_amt = 0;
																			} else {
																				$dr_amt = ($dr_amt - $cr_amt);
																				$cr_amt = 0;										
																			}
																		
																		
																		if($get_value['account_sub_type_id']=="1" || $get_value['account_sub_type_id']=="2" ){
																			if($dr_amt>0 || $cr_amt>0){
																				$dr_amt	= ($dr_amt==0)?$opening_amount:$dr_amt;
																				$cr_amt	= ($cr_amt==0)?$opening_amount:$cr_amt;	
																			}
																		}
																			 
																	if(($cr_amt + $dr_amt) > 0) {		
																	
																			$tot_cr_amt = $tot_cr_amt + $cr_amt;
																			$tot_dr_amt = $tot_dr_amt + $dr_amt;					  
															
														   ?>
																<tr class="<?php echo $style; ?>">
																  <td valign="top"><?php echo $s_no++;?></td>
																  <td valign="top"><?php echo $get_value['account_sub_name']; ?></td>
																  <td valign="top" style="text-align:right"><?php echo number_format($cr_amt,2,'.','');?></td>
																  <td valign="top" style="text-align:right"><?php echo number_format($dr_amt,2,'.','');?></td>
																</tr>
															<?php
																		
																		}
																	}
															}
														
														
														?>
													<?php
														} else {
													?>
													<?php
														if($list_ledger_entry) {
																foreach($list_ledger_entry as $get_value){
															
																	$page=$s_no%2;
																
																	if($page==0){
																		$style="alt";
																	} 
																	else{
																		$style="";
																	}		  
																
																		$get_cr_open_amt = listOpening_head('C', $_REQUEST['fromdate'], $get_value['account_head_id'], $_REQUEST['branchid']);
																		$get_dr_open_amt = listOpening_head('D', $_REQUEST['fromdate'], $get_value['account_head_id'], $_REQUEST['branchid']);
																		
																		list($get_cr_amt, $get_dr_amt) = getAccountTransaction($_REQUEST['fromdate'], $_REQUEST['todate'], $_REQUEST['branchid'], $get_value['account_head_id'], 'summary');
																		if (($get_cr_open_amt - $get_dr_open_amt) > 0) {
																			$opening_amount	= $get_cr_open_amt - $get_dr_open_amt;
																		}
																		else{
																			$opening_amount	= $get_dr_open_amt - $get_cr_open_amt;
																		}
																		if($get_value['account_sub_type_id']=="1" || $get_value['account_sub_type_id']=="2" ){
																			$cr_amt = number_format($get_cr_amt + $get_cr_open_amt,2,'.','');
																			$dr_amt = number_format($get_dr_amt + $get_dr_open_amt,2,'.','');
																			//$cr_amt = number_format($get_cr_amt,2,'.','') ;
																			//$dr_amt = number_format($get_dr_amt,2,'.','') ;
																		}else{					
																			$cr_amt = number_format($get_cr_amt,2,'.','') ;
																			$dr_amt = number_format($get_dr_amt,2,'.','') ;	
																		}
																			$cr_amt = number_format($get_cr_amt + $get_cr_open_amt,2,'.','');
																			$dr_amt = number_format($get_dr_amt + $get_dr_open_amt,2,'.','');
																			if (($cr_amt - $dr_amt) > 0) {
																				$cr_amt = ($cr_amt - $dr_amt);
																				$dr_amt = 0;
																			} else{
																				$dr_amt = ($dr_amt - $cr_amt);
																				$cr_amt = 0;										
																			}
																		
																		if($get_value['account_sub_type_id']=="1" || $get_value['account_sub_type_id']=="2" ){
																			if($dr_amt>0 || $cr_amt>0){
																				$dr_amt	= ($dr_amt==0)?$opening_amount:$dr_amt;
																				$cr_amt	= ($cr_amt==0)?$opening_amount:$cr_amt;	
																			}
																		}
																			 
																	if(($cr_amt + $dr_amt) > 0) {		
																	
																			$tot_cr_amt = $tot_cr_amt + $cr_amt;
																			$tot_dr_amt = $tot_dr_amt + $dr_amt;					  
															
														   ?>
																<tr class="<?php echo $style; ?>">
																  <td valign="top"><?php echo $s_no++;?></td>
																  <td valign="top"><?php echo $get_value['account_head_name']; ?></td>
																  <td valign="top" style="text-align:right"><?php echo number_format($cr_amt,2,'.','');?></td>
																  <td valign="top" style="text-align:right"><?php echo number_format($dr_amt,2,'.','');?></td>
																</tr>
															<?php
																		
																		}
																	}
															}
														
														
														?>
													<?php
														}
													?>
													 <tfoot>
													 <?php
															
															if (($tot_cr_amt - $tot_dr_amt) > 0) {
																$cr_amount = ($tot_cr_amt - $tot_dr_amt);
																$dr_amount = 0;
															} else {
																$dr_amount = ($tot_dr_amt - $tot_cr_amt);
																$cr_amount = 0;										
															}										
											
													 ?>
													 
													 <tr>
													  <td colspan="2" style="text-align:right; font-weight:bold;">Total</td>
													  <td valign="top" style="text-align:right"><?php echo number_format($tot_cr_amt,2,'.','');?></td>
													  <td valign="top" style="text-align:right"><?php echo number_format($tot_dr_amt,2,'.','');?></td>
													</tr>
													
													<tr>
													  <td colspan="2" style="text-align:right; font-weight:bold;">Diff</td>
													  <td valign="top" style="text-align:right"><?php echo number_format($cr_amount,2,'.','');?></td>
													  <td valign="top" style="text-align:right"><?php echo number_format($dr_amount,2,'.','');?></td>
													</tr>
													 <tr>
													  <td colspan="2" style="text-align:right; font-weight:bold;">&nbsp;</td>
													  <td valign="top" style="text-align:right">&nbsp;</td>
													  <td valign="top" style="text-align:right">&nbsp;</td>
													</tr>	
													</tfoot>
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

 
