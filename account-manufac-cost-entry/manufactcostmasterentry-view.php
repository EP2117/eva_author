<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MANUFACTURING COST ENTRY</title>
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
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
					 <div class="col-md-12">
                        <h1 class="page-head-line">MANUFACTURING COST ENTRY</h1>
                    </div>
                </div>				
					
					 <form id="openibngBalanc" name="openibngBalanc" method="post">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="panel panel-info">
								
									<div class="panel-heading">	
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-4">										
											<div class="form-group">
												<label>Group head name</label>
												<select name="manuc_groupid" id="manuc_groupid" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
														foreach($group_list as $get){
															if(searchValue('manuc_groupid') == $get['acManuCostId']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?> value="<?=$get['acManuCostId']?>"><?=$get['acMC_group_name']?></option>
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
							MANUFACTURING COST ENTRY
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
											<th>Credit</th>
											<th>Debit</th>
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
												<input type="hidden" name="id_<?php echo $k; ?>" value="<?php echo $result['manuCostEntryeId']; ?>">
												<input type="hidden" name="ac_costmaster_ac_id_<?php echo $k; ?>" value="<?php echo $result['idMcAcdetailsId']; ?>">
												<input type="hidden" name="ac_subhead_id_<?php echo $k; ?>" value="<?php echo $result['account_sub_id']; ?>">
											</td>
											<td><?php echo $result['account_sub_name']; ?></td>
											<td><?php echo $result['account_sub_id']; ?></td>
											<td><input type="text" class="form-control" name="debit_amnt_<?php echo $k; ?>" id="debit_<?php echo $k; ?>"  value="<?php echo $result['ce_debit_amnt']; ?>"></td>
											<td><input type="text" class="form-control" name="credit_amnt_<?php echo $k; ?>" id="credit_<?php echo $k; ?>" value="<?php echo $result['ce_credit_amnt']; ?>" ></td>
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

 
