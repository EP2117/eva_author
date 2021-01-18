<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GENERAL LEDGER</title>
<?php 
	include "../includes/common/header.php";
	
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/account-ledger/ledger-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">GENERAL LEDGER</h1>
                    </div>
                </div>				
						<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										GENERAL LEDGER							 
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
													<label>Head A/C</label>
														<select name="account_head" id="account_head" class="form-control" style="width:100%" onChange="return headsub_acount(this.value,this);" >
															 <option value=""> - Select - </option>
															<?php
																foreach($head_ac as	$get){
																	if(searchValue('branchid') == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}

																?>
																	<option  value="<?=$get['account_head_id']?>"><?=$get['account_head_name']?></option>
																<?php
																}
																?>
														</select>
														
												</div>	
											</div>			
											<div class="col-lg-4">	
												<div class="form-group">
													<label>Sub A/C</label>
														<select name="sub_account" id="sub_account" class="form-control" style="width:100%" >
															 <option value=""> - Select - </option>
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
													<button name="stockAvailable" type="submit"class="btn btn-danger">Submit</button>
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
												GENERAL LEDGER						 
											</div>	
											
											<div class="panel-body">
												<table id="profitloss_table" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>S.no</th>			
															<th>Date</th>
															<th>Description</th>
															<th>Credit</th>
															<th>Debit</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$array_debit =$array_credit=0;								
														if(!empty($reportList)){
														$s_no	= 1;	
														foreach($reportList as $result){														
														
														if(0<$result['debit']+$result['credit']){
															$array_debit += $result['debit'];
															$array_credit += $result['credit'];
														?>
														<tr class="odd gradeX">
															<td><?php echo $s_no++; ?></td>
															<td><?php echo $result['aeA_advance_date']; ?></td>
															<td><?php echo $result['aeA_narration']; ?></td>
															<td style="text-align:right;"><?php echo ind_oney_format($result['debit']); ?></td>
															<td style="text-align:right;"><?php echo ind_oney_format($result['credit']); ?></td>
															
														</tr>
														                               
													 <?php }
													 	}
													    }
													  ?>
													</tbody>	
													<tfoot>
														<tr>
															<th colspan="3" style="text-align:right;">Opening Balance</th>
															<td colspan="2" style="text-align:right;"><?php  ?></td>
														</tr>
														<tr>
															<th colspan="3" style="text-align:right;">Total</th>
															<td colspan="2" style="text-align:right;"><?php  ?></td>
														</tr>
														<tr>
															<th colspan="3" style="text-align:right;">Closing Balance</th>
															<td colspan="2" style="text-align:right;"><?php  ?></td>
														</tr>
													</tfoot>									
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
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
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
		$("#profit-loss-form").validate({
			rules: {
				branchid:"required",
				account_head:"required",
				sub_account:"required",
				fromdate: "required",
				todate: "required"
			}
		});	
	</script>

</body>

 
