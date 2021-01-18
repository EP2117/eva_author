<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OPENING BALANCE</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		
		if($_GET['msg']==1) {
		
			$msg = 'Added successfully';
			
		}elseif($_GET['msg']==2) {
		
			$msg = 'Updated successfully';

		} 
	}		
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/account-opening-balance/openingbalance-javascript.js'; ?>"></script>
<script type="text/javascript">
  function GetCurrecy_amt(id,val){
	 // alert();
	 var cur_id		= $("#ac_currency_id_"+id).val();
	 if(val=='1'){
		 var cur_amt	= $("#frgn_debit_amnt_"+id).val();
	 }
	 else{
		 var cur_amt	= $("#frgn_credit_amnt_"+id).val();
	 }
	 var cur_date	= '';
	$.get("currency-amt.php",
		  {cur_id:cur_id,cur_amt:cur_amt,c_date:cur_date},
		  function(data){
			  if(val=='1'){
				$("#debit_"+id).val(data);
			  }
			  else{
			  	$("#credit_"+id).val(data);
			  }
		 }
	);
 }

</script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
					 <div class="col-md-12">
                        <h1 class="page-head-line">OPENING BALANCE</h1>
                    </div>
                </div>				
					
					 <form id="openibngBalanc" name="openibngBalanc" method="post" action='index.php'>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="panel panel-info">
								
									<div class="panel-heading">	
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-4">										
											<div class="form-group">
												<label>Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if(searchValue('branchid') == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?> value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											
										</div>																				
										<div class="col-lg-4" style="padding-top:30px;">
											<div class="form-group">
												<button name="account_list" type="submit"class="btn btn-danger">Search</button>
											</div>	
										</div>	
										<div class="col-lg-4">										
										</div>	
									</div>
								
								</div>
							</div>
						</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							Opening Balance Details
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table id="openingbalnc-tabl"  class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>S.No</th>	
											<th>Accounts Head</th>	
											<th>Accounts Head Code</th>										
											<th>Sub Account </th>
											<th>Sub Account Code</th>
											<th>Debit</th>
											<th>Credit</th>
											<th>Kyat Debit</th>
											<th>Kyat Credit</th>
											<input type="hidden" name="oP_branch_id" id="oP_branch_id"  value="<?=searchValue('branchid')?>"/>
											</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!empty($resultArray)){
										
										$k	= 0;									
										foreach($resultArray as $result){
										?>
										<tr class="odd gradeX">
											<td><?php echo ($k+1); ?></td>
											<td><?php echo $result['account_head_name']; ?></td>
											<td><?php echo $result['account_head_id']; ?>
												<input type="hidden" name="id_<?php echo $k; ?>" value="<?php echo $result['openingBalanceId']; ?>">
												<input type="hidden" name="ac_subhead_id_<?php echo $k; ?>"  id="ac_subhead_id_<?php echo $k; ?>"value="<?php echo $result['account_sub_id']; ?>">
												<input type="hidden" name="ac_currency_id_<?php echo $k; ?>"  id="ac_currency_id_<?php echo $k; ?>"value="<?php echo $result['account_sub_currency_id']; ?>">
											</td>
											<td><?php echo $result['account_sub_name']; ?></td>
											<td><?php echo $result['account_sub_id']; ?></td>
											<td><input type="text" class="form-control" name="frgn_debit_amnt_<?php echo $k; ?>" id="frgn_debit_amnt_<?php echo $k; ?>"  value="<?php echo $result['oP_frgn_debit_amnt']; ?>" onBlur="GetCurrecy_amt(<?php echo $k; ?>,1);"></td>
											<td><input type="text" class="form-control" name="frgn_credit_amnt_<?php echo $k; ?>" id="frgn_credit_amnt_<?php echo $k; ?>" value="<?php echo $result['oP_frgn_credit_amnt']; ?>" onBlur="GetCurrecy_amt(<?php echo $k; ?>,2);"></td>
											<td><input type="text" class="form-control" name="debit_amnt_<?php echo $k; ?>" id="debit_<?php echo $k; ?>"  value="<?php echo $result['oP_debit_amnt']; ?>"></td>
											<td><input type="text" class="form-control" name="credit_amnt_<?php echo $k; ?>" id="credit_<?php echo $k; ?>" value="<?php echo $result['oP_credit_amnt']; ?>" ></td>
										</tr>
																	   
									 <?php $k++;
									  }
										  $count= count($resultArray);
											echo '<input type="text" style="visibility:hidden" class="form-control" value="'.$count.'" name="op_blnc" id="op_blnc" >';
										
										}
									  ?>
									</tbody>												
								</table>
							</div>
						</div>
						<div class="col-lg-12" style="padding-top:30px;">
							<div class="form-group">
								<button name="opening_balinsertUpdate" type="submit"class="btn btn-success">Update</button>
							</div>	
						</div>	
					</div>			
					</form>	

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
			$('#openingbalnc-tabl').DataTable( {
				scrollY:'700px',
				scrollCollapse:true,
				paging:false,
				scrollX: false,
				"paging":   false,
				"ordering": false,
				"info":     false
			});
		});
		$("#openibngBalanc").validate({
			rules: {
				branchid: "required"
			}
		});					
	</script>

</body>

 
