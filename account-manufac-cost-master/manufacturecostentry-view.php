<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MANUFACTURING COST MASTER</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/account-manufac-cost-master/manufacturecostentry-javascript.js'; ?>"></script>
<script>
	function addAcRow(){
 	
	var last_val = $("#ac_apnd").val();
	var sno      = parseInt(last_val)+1;
	
	var apnd  = '<tr id="remove_ac_'+sno+'">';
		
		apnd += '<td><input type="hidden" name="id_'+sno+'" value=""><select name="account_head_'+sno+'" id="account_head_'+sno+'" class="form-control" style="width:100%" onChange="return headsub_acount(this.value,this,'+sno+');" ><option value=""> - Select - </option><?php foreach($head_ac as $get){?><option value="<?=$get['account_head_id']?>"><?=$get['account_head_name']?></option><?php } ?></select></td>';
		apnd += '<td><select name="sub_account_'+sno+'"id="sub_account_'+sno+'" class="form-control" style="width:100%" ><option value=""> - Select - </option> </select></td>';
		apnd += '<td><input type="text" class="form-control"  style="text-align:right;" name="credit_amnt_'+sno+'" id="credit_amnt_'+sno+'"></td>';
		apnd += '<td><input type="text" class="form-control unit_amnt" style="text-align:right;" name="debit_amnt_'+sno+'" id="debit_amnt_'+sno+'"></td>';
		
		apnd += '<td><button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onclick="removeRow('+sno+')"></button></td>';
		apnd += '</tr>';
		
		$("#ac_apnd").val(sno);
		$("#acount_table >tbody").append(apnd);
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
                        <h1 class="page-head-line">MANUFACTURING COST MASTER</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
								<button  type="submit" class="btn " onClick="location.href='index.php'">Back</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>
                </div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>	
					<form name="purchase-entry-forms" id="salary-forms" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editValue['acManuCostId'])?"":$editValue['acManuCostId']; ?>" >

						<div class="row">
							
							<div id="request" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										MANUFACTURING COST MASTER				 
									</div>
									
									<div class="panel-body">
										
										<div class="col-lg-4">										
											<div class="form-group">
												<label class="control-label">Group name</label>
												
												<input type="text" class="form-control" name="group_name" id="group_name" value="<?php  echo $id = empty($editValue['acMC_group_name'])?"":$editValue['acMC_group_name']; ?>" required>
											</div>	
																		
										</div>																				
										<div class="col-lg-4">
											
										</div>
										<div class="col-lg-4"></div>
									
								</div>		
								</div>						
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									
									<div class="panel-body">
										<table id="acount_table" class="table table-striped table-bordered table-hover">
											<thead>
											<?php $count_val = !empty($editValueAc) ? count($editValueAc) :''; ?>
												<tr>
													<th style="width:20%;">Accounts Head</th>
													<th style="width:20%;">Sub Account </th>
													<th style="width:20%;">Credit</th>
													<th style="width:20%;">Debit</th>
													<td width="5%">
													<input type="hidden" id="ac_apnd" name="ac_count" value="<?php echo (0<$count_val ? $count_val :1); ?>">
													<button class="glyphicon glyphicon-plus" title="Add row" type="button" onClick="addAcRow()"></button>	
													</td>
												</tr>
											</thead>
											<tbody>
											<?php 
												
												if(0<$count_val){
												   for($i=1;$i<=count($editValueAc);$i++){
													$j=$i-1;
													 $subhead = accountSubHeadList($editValueAc[$j]['mcA_account_head_id']);
													
												 ?>
												<tr id="remove_req_<?php echo $i; ?>">
												
													<td>
														<input type="hidden" name="ac_id_<?php echo $i; ?>" value="<?php echo $editValueAc[$j]['idMcAcdetailsId']; ?>">																
														<select name="account_head_<?php echo $i; ?>" id="account_head_<?php echo $i; ?>" class="form-control" style="width:100%" onChange="return headsub_acount(this.value,this,'<?php echo $i; ?>');" >
															 <option value=""> - Select - </option>
															<?php
																foreach($head_ac as	$get){
																	if($editValueAc[$j]['mcA_account_head_id'] == $get['account_head_id']){ $select ='selected="selected"'; }else{ $select="";}
																?>
																	<option <?php echo $select;?>  value="<?=$get['account_head_id']?>"><?=$get['account_head_name']?></option>
															<?php
																}
																?>
														</select>
													</td>
												
													<td>																
														<select name="sub_account_<?php echo $i; ?>" id="sub_account_<?php echo $i; ?>" class="form-control" style="width:100%" >
															 <option value=""> - Select - </option>
															 <?php
															
															 
																foreach($subhead as	$get){
																	if($editValueAc[$j]['mcA_account_sub_id'] == $get['account_sub_id']){ $select ='selected="selected"'; }else{ $select="";}
																?>
																	<option <?php echo $select;?>  value="<?=$get['account_sub_id']?>"><?=$get['account_sub_name']?></option>
															<?php
																}
																?>
														</select>
													</td>
													<td>																
														<input type="text" class="form-control" style="text-align:right;" name="credit_amnt_<?php echo $i; ?>" id="credit_amnt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editValueAc[$j]['mcA_debit_amount']; ?>">
													</td>
													
													<td>																
														<input type="text" class="form-control" style="text-align:right;"  name="debit_amnt_<?php echo $i; ?>" id="debit_amnt_<?php echo $i; ?>"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo $editValueAc[$j]['mcA_credit_amount']; ?>">
													</td>
													<td>
														
													</td>
												</tr>
											<?php   }
												  }else{
												 ?>	
												 <tr id="remove_ac_1">
													<td>
														<input type="hidden" name="ac_id_1" value="">																
														<select name="account_head_1" id="account_head_1" class="form-control" style="width:100%" onChange="return headsub_acount(this.value,this,1);" >
															 <option value=""> - Select - </option>
															<?php
																foreach($head_ac as	$get){
																?>
																	<option  value="<?=$get['account_head_id']?>"><?=$get['account_head_name']?></option>
																<?php
																}
																?>
														</select>
													</td>
												
													<td>																
														<select name="sub_account_1" id="sub_account_1" class="form-control" style="width:100%" >
															 <option value=""> - Select - </option>
														</select>
													</td>
													<td><input type="text" class="form-control" style="text-align:right;" name="credit_amnt_1" id="credit_amnt_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);"></td>
													<td><input type="text" class="form-control" style="text-align:right;"  name="debit_amnt_1" id="debit_amnt_1"  onkeypress="return o_obj.Alpha_Numeric(this,event);"></td>
													<td>
														<button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onClick="removeRow(1)"></button>
													</td>
												</tr>
											 <?php }
											 ?>	
											</tbody>	
																			
										</table>					
									</div>
									
								</div>
								
							</div>
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="accountgroup" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?></button>
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Manufacture group list
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Group name</th>										
												<th>Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($resultList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['acMC_group_name']; ?></td> 
												<td><?php echo $result['acMC_date']; ?></td>
												                                      
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['acManuCostId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
				<?php } ?>
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
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
			
		});
		$( "#ms_date" ).datepicker({
			 dateFormat: 'dd-mm-yy',
			 changeMonth:true,
			 changeYear:true
		});
			
		$( "#salary-forms" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
		});	
		
	</script>

</body>

 
