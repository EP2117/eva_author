<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GENERAL LEDGER</title>
<?php 
	include "../includes/common/header.php";
	
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/account-manufacture/account-manufacture-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Manufacture	 Report</h1>
                    </div>
               	 </div>				
						<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Manufacture	 Report		 				 
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
													
										</div>
										<div class="col-lg-12">
											<div class="col-lg-4">
												<div class="form-group">
													<label>From date</label>
													 <input type="text" class="form-control"  name="fromdate" id="fromdate" readonly="" value="<?php echo searchValue('fromdate'); ?>" required>	
														
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>To Date</label>
													
													 <input type="text" class="form-control"  name="todate" id="todate" readonly="" value="<?php echo searchValue('todate'); ?>" required>	
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group" style="padding-top:25px;">
													<button name="stockAvailable" type="submit"class="btn btn-danger">Search</button>
												</div>
														
											</div>
										</div>																	
											
										</form>
										</div>
									
									</div>
								</div>	
								<?php if(isset($_REQUEST['stockAvailable'])){ ?>
								<div class="row">
									<div class="col-lg-12">
										<div class="panel-body">
												<table id="profitloss_table" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th rowspan="2">S.no</th>			
															<th rowspan="2">Acc Head</th>
															<th rowspan="2">Acc Sub</th>
															<th>Credit</th>
															<th>Debit</th>
														</tr>
														
													</thead>
													<tbody>
													<?php 
													$s_no					= 0;
									
											$cr_amt = 0;
									
											$dr_amt = 0;
											$desc = '';
											$tot_cr_amt	= 0;
											$tot_dr_amt	= 0;
										  if($list_transaction) {
												$s_no	= 1;
											  foreach($list_transaction as $get_record){
													
													$cr_amt		= $get_record['cr_amt'];
													$dr_amt		= $get_record['dr_amt'];
													$tot_cr_amt = $tot_cr_amt + $cr_amt;
										
													$tot_dr_amt = $tot_dr_amt + $dr_amt;		   
										
										
											   ?>
										
													<tr class="<?php echo $style; ?>">
													  <td valign="top"><?php echo $s_no++;?></td>
													  <td valign="top"><?php echo $get_record['account_head_name'];?></td>
													  <td valign="top"><?php echo $get_record['account_sub_name'];?></td>
													  <td valign="top" style="text-align:right"><?php echo number_format($cr_amt,2);?></td>
													  <td valign="top" style="text-align:right"><?php echo number_format($dr_amt,2);?></td>
													</tr>

            
														                               
													  <?php }
											}
											
											?>
											 <tr>

												  <td colspan="3" style="text-align:right; font-weight:bold;">Total</td>
									
												  <td valign="top" style="text-align:right"><?php echo number_format($tot_cr_amt,2);?></td>
									
												  <td valign="top" style="text-align:right"><?php echo number_format($tot_dr_amt,2);?></td>
												</tr>
											 
													</tbody>	
																							
												</table>					
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
				account_head:"required",
				fromdate: "required",
				todate: "required"
			}
		});	
	</script>

</body>

 
