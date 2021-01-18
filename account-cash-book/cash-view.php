<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CASH & BANK</title>
<?php 
	include "../includes/common/header.php";
	
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/account-cash-book/cash-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">CASH & BANK</h1>
                    </div>
                </div>				
						<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										CASH & BANK							 
									</div>									
									<div class="panel-body">
										<div class="row">
										 <form id="profit-loss-form" name="stock-form" method="post">
										<div class="col-lg-12">
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
											</div>
										
											<div class="col-lg-4">
												<div class="form-group">
													<label>From date</label>
													 <input type="text" class="form-control"  name="fromdate" id="fromdate" readonly value="<?php echo searchValue('fromdate'); ?>" required>	
														
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>To Date</label>
													
													 <input type="text" class="form-control"  name="todate" id="todate" readonly value="<?php echo searchValue('todate'); ?>" required>	
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="col-lg-4">
												<div class="form-group">
												<label>Payment mode</label>	
												 <select class="form-control select2" style="width:100%" name="payment_mode" id="payment_mode" >
													 <option value=""> - Select - </option>
													<?php
														foreach($arr_pay_mode as $key=>$val){
															if(searchValue('payment_mode') == $key){ $select ='selected="selected"'; }else{ $select ='';}
														?>
															<option <?php echo $select;?>  value="<?=$key?>"><?=$val?></option>
													<?php
															}
														?>
													<option <?php if(searchValue('payment_mode') == 0){ echo $select ='selected="selected"'; } ?> value="0"> All </option>
												</select>						
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Credit A/c</label>
											<input type="text" class="form-control" name="sub_account" id="sub_account" value="<?php echo searchValue('sub_account'); ?>" onKeyUp="return getAccountName(this.value,this);">
												</div>
											</div>
												
											<div class="col-lg-4">
												<div class="form-group" style="padding-top:30px;">
													<button name="stockAvailable" type="submit"class="btn btn-danger">Search</button>
												</div>
														
											</div>
											<div class="col-lg-2"></div>
										</div>																	
											
										</form>
										</div>
									
									</div>
								</div>	
								<?php if(isset($_REQUEST['stockAvailable'])){ ?>
                                
                                <div class="panel-heading">
							
							<a href="<?php echo PROJECT_PATH.'/account-cash-book/stock-available-excel.php?fromdate='.searchValue('fromdate').'&todate='.searchValue('todate').'&account_sub_id='.searchValue('account_sub_id').'&branchid='.searchValue('branchid').'&sub_account='.searchValue('sub_account').'&payment_mode='.searchValue('payment_mode');  ?>" title="Download PDF" target="_blank" align="right">
							<img src="<?php echo PROJECT_PATH.'/images/excel-icon.png'; ?>" width="28" border="0"   alt="Download PDF" title="Download PDF">
							</a>
						</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-info">
										
											<div class="panel-heading">	
												CASH & BANK BOOK							 
											</div>	
											
											<div class="panel-body">
												<table id="profitloss_table" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th rowspan="2">S.no</th>			
															<th rowspan="2">Vou no</th>
															<th rowspan="2">Date</th>
															<th rowspan="2">Description</th>
															<th colspan="2">MMK</th>
															<th colspan="2">FRGN</th>			
														</tr>
														<tr>
															<th>Credit</th>
															<th>Debit</th>
															<th>Credit</th>
															<th>Debit</th>
														</tr>
													</thead>
													<tbody>
													<?php 
													$s_no		= 0;
													$fromdate	= NdateDatabaseFormat($_REQUEST['fromdate']);
													$todate	= NdateDatabaseFormat($_REQUEST['todate']);
													$list_cash_entry		= createDateRangeArray($fromdate,$todate);
													$val = explode(' - ',$_REQUEST['sub_account']);
													$id = $val[0];
													
													for($i=0; $i<count($list_cash_entry); $i++) {
													
													$cr_open_amt = 0;
													$dr_open_amt = 0;
																  
													$list_transaction = listTransaction($list_cash_entry[$i], $id, $_REQUEST['branchid']);
													list($get_cr_open_amt,$get_cr_open_amt_mmk) = listOpening('C', $list_cash_entry[$i], $id, $_REQUEST['branchid']);
													list($get_dr_open_amt,$get_dr_open_amt_mmk) = listOpening('D', $list_cash_entry[$i], $id, $_REQUEST['branchid']);
													//echo $get_cr_open_amt.'-'.$get_dr_open_amt;exit;
													
													if (($get_cr_open_amt - $get_dr_open_amt) > 0) {
														$cr_open_amt = ($get_cr_open_amt - $get_dr_open_amt);
														$dr_open_amt = 0;
													} else {
														$dr_open_amt = ($get_dr_open_amt - $get_cr_open_amt);
														$cr_open_amt = 0;										
													}	
															  
													if (($get_cr_open_amt_mmk - $get_dr_open_amt_mmk) > 0) {
														$cr_open_amt_mmk = ($get_cr_open_amt_mmk - $get_dr_open_amt_mmk);
														$dr_open_amt_mmk = 0;
													} else {
														$dr_open_amt_mmk = ($get_dr_open_amt_mmk - $get_cr_open_amt_mmk);
														$cr_open_amt_mmk = 0;										
													}
													$page=$s_no%2;
													if($page==0){
													$style="alt";
													} 
													else{
													$style="";
													}
													//echo $dr_open_amt."=".$cr_open_amt;exit;
									?>
												<tr class="<?php echo $style; ?>">
									
												  <td colspan="3" valign="top"><strong><?php echo dateGeneralFormatN($list_cash_entry[$i]); ?></strong></td>
									
												  <td valign="top" style="text-align:right"><strong>Opening Balance</strong></td>
									
												  <td valign="top" style="text-align:right"><?php echo number_format($cr_open_amt,2);?></td>
									
												  <td valign="top" style="text-align:right"><?php echo number_format($dr_open_amt,2);?></td>
                                                  
												  <td valign="top" style="text-align:right"><?php echo number_format($cr_open_amt_mmk,2);?></td>
									
												  <td valign="top" style="text-align:right"><?php echo number_format($dr_open_amt_mmk,2);?></td>
									
												</tr>
									
									<?php				
									
											$cr_amt = 0;
									
											$dr_amt = 0;
									
											$tot_cr_amt = $cr_open_amt;
									
											$tot_dr_amt = $dr_open_amt;
											
											$tot_cr_amt_mmk = $cr_open_amt_mmk;
											$tot_dr_amt_mmk = $dr_open_amt_mmk;
									
											$desc = '';
											
										  if($list_transaction) {
												$s_no	= 1;
											  foreach($list_transaction as $get_record){
												   if($get_record['acc_transaction_cord'] == 'D') {
										
														$desc = 'By '.$get_record['account_name1'].'<br/>'.$get_record['acc_transaction_remark'];	
										
														$cr_amt = $get_record['acc_transaction_amount_mmk'];
														$cr_amt_mmk = $get_record['acc_transaction_amount'];
														$dr_amt_mmk = 0;
														$dr_amt = 0;
										
												   } else {
										
														$desc = 'To '.$get_record['account_name1'].'<br/>'.$get_record['acc_transaction_remark'];
										
														$dr_amt = $get_record['acc_transaction_amount_mmk'];	
														$dr_amt_mmk = $get_record['acc_transaction_amount'];	
														$cr_amt = 0;
														$cr_amt_mmk	= 0;
										
												   }
										
													$tot_cr_amt = $tot_cr_amt + $cr_amt;
										
													$tot_dr_amt = $tot_dr_amt + $dr_amt;		   
										
													$tot_cr_amt_mmk = $tot_cr_amt_mmk + $cr_amt_mmk;
										
													$tot_dr_amt_mmk = $tot_dr_amt_mmk + $dr_amt_mmk;		   
										
											   ?>
										
													<tr class="<?php echo $style; ?>">
										
													  <td valign="top"><?php echo $s_no++;?></td>
										
													  <td valign="top"><?php echo $get_record['acc_transaction_no'];?></td>
										
													  <td valign="top"><?php echo dateGeneralFormat($get_record['acc_transaction_date']);?></td>
										
													  <td valign="top"><?php echo $desc;?></td>
										
													  <td valign="top" style="text-align:right"><?php echo number_format($cr_amt,2);?></td>
										
													  <td valign="top" style="text-align:right"><?php echo number_format($dr_amt,2);?></td>
													  <td valign="top" style="text-align:right"><?php echo number_format($cr_amt_mmk,2);?></td>
										
													  <td valign="top" style="text-align:right"><?php echo number_format($dr_amt_mmk,2);?></td>
										
													</tr>

            
														                               
													  <?php }
											}
											if (($tot_cr_amt - $tot_dr_amt) > 0) {
							
												$cr_close_amt = ($tot_cr_amt - $tot_dr_amt);
							
												$dr_close_amt = 0;
							
											} else {
							
												$dr_close_amt = ($tot_dr_amt - $tot_cr_amt);
							
												$cr_close_amt = 0;										
							
											}				
																		
											if (($tot_cr_amt_mmk - $tot_dr_amt_mmk) > 0) {
							
												$cr_close_amt_mmk = ($tot_cr_amt_mmk - $tot_dr_amt_mmk);
							
												$dr_close_amt_mmk = 0;
							
											} else {
							
												$dr_close_amt_mmk = ($tot_dr_amt_mmk - $tot_cr_amt_mmk);
							
												$cr_close_amt_mmk = 0;										
							
											}
											}
											?>
											 <tr>

              <td colspan="4" style="text-align:right; font-weight:bold;">Total</td>

              <td valign="top" style="text-align:right"><?php echo number_format($tot_cr_amt,2);?></td>

              <td valign="top" style="text-align:right"><?php echo number_format($tot_dr_amt,2);?></td>
			  <td valign="top" style="text-align:right"><?php echo number_format($tot_cr_amt_mmk,2);?></td>

              <td valign="top" style="text-align:right"><?php echo number_format($tot_dr_amt_mmk,2);?></td>

		    </tr>

			

			 <tr>

              <td colspan="4" style="text-align:right; font-weight:bold;">Closing Balance</td>

              <td valign="top" style="text-align:right"><?php echo number_format($cr_close_amt,2);?></td>

              <td valign="top" style="text-align:right"><?php echo number_format($dr_close_amt,2);?></td>
              <td valign="top" style="text-align:right"><?php echo number_format($cr_close_amt_mmk,2);?></td>

              <td valign="top" style="text-align:right"><?php echo number_format($dr_close_amt_mmk,2);?></td>
		    </tr>	

			

			 <tr>

              <td colspan="4" style="text-align:right; font-weight:bold;">&nbsp;</td>

              <td valign="top" style="text-align:right">&nbsp;</td>

              <td valign="top" style="text-align:right">&nbsp;</td>
												  <td valign="top" style="text-align:right">&nbsp;</td>
									
												  <td valign="top" style="text-align:right">&nbsp;</td>
		    </tr>
													</tbody>	
																							
												</table>					
											</div>
										</div>
									</div>
									
								</div>	
								<?php } ?>	
										
								
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
			/*$('#profitloss_table').DataTable( {
				responsive: true
			} );*/	
			
		});
		$( "#fromdate" ).datepicker({
			
			changeMonth: true,
			dateFormat: 'dd/mm/yy', 
			onClose: function( selectedDate ) {
				$( "#todate" ).datepicker( "option", "minDate", selectedDate );
			}
		});//defaultDate: "+1w",
		$( "#todate" ).datepicker({
			
			changeMonth: true,
			dateFormat: 'dd/mm/yy', 
			onClose: function( selectedDate ) {
				$( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );
			}
		}); //defaultDate: "+1w",
		$("#profit-loss-form").validate({
			rules: {
				fromdate: "required",
				todate: "required",
				sub_account:"required",
				payment_mode:"required"
				
			}
		});	
	</script>

</body>

 
