<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

$list_company = getCompanyDetails();
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (PHP_SAPI == 'cli') 
	die('This Report should only be run from a Web Browser');

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=ledger.xls");

	require_once 'cash-model.php';		
	   $branch_list		= getBranchList();
		$head_ac =accountHeadList();	
// Create new PHPExcel object
?>
<table id="profitloss_table" class="table table-striped table-bordered table-hover" border="1">
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