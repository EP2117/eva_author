<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ACCOUNTS HEAD</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		
		if($_GET['msg']==1) {
		
			$msg = 'Added successfully';
			
		}elseif($_GET['msg']==2) {
		
			$msg = 'Updated successfully';

		}elseif($_GET['msg']==3) {
		
			$msg = 'Deleted successfully';

		}
	}			
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/account-head/ac-head-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
               <div class="row">
				 <div class="col-md-12">
                        <h1 class="page-head-line">Account Group</h1>
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
					<form name="ac-head-form" id="ac-setup-form" method="post" data-toggle="validator">
						<input type="hidden" name="id" value="<?php  echo $id = empty($resultedit['account_head_id'])?"":$resultedit['account_head_id']; ?>" >
					
					<div class="row">
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  
					 	  <div class="panel panel-info">
								
								<div class="panel-heading">
								  	ACCOUNTS HEAD
									
								</div>
								
								<div class="panel-body">
								
									<div class="col-lg-6">
										
										<div class="form-group">
											<label class="control-label">Accounts Head Name</label>
											<input class="form-control" type="text" name="account_head_name" id="account_head_name" value="<?php echo empty($resultedit['account_head_name'])?"":$resultedit['account_head_name']; ?>" required>
										</div>
										
																				
										<div class="form-group">
											<label class="control-label">Financial Accounts Type 2  <?php
												echo   $val = empty($resultedit['account_head_type1'])?"":$resultedit['account_head_type1'];?> </label>
												
												<select name="account_head_type2" id="account_head_type2" class="form-control" tabindex="1" required onChange="DisplayType3();" required>
												  <option value="">--Select--</option>
												  <?php

												  if(!empty($val)){
														if($val == 'pl') {
															foreach($arr_account_type21 as $arr_key => $arr_value){
																if($resultedit['account_head_type2'] ==$arr_key ){ $select ='selected="selected"'; }else{ $select ='';}
														   ?>
															  <option <?php echo $select;?> value="<?php echo $arr_key; ?>"><?php echo $arr_value; ?></option>
														  <?php } 
															
														} else if($val == 'bs') {
															foreach($arr_account_type22 as $arr_key => $arr_value){
																if($resultedit['account_head_type2'] ==$arr_key ){ $select ='selected="selected"'; }else{ $select ='';}
															   ?>
															  <option <?php echo $select;?> value="<?php echo $arr_key; ?>"><?php echo $arr_value; ?></option>
														  	<?php } 
														}
													}
													?>
												 </select>				
										</div>	
										<div class="form-group">
											<label>Staus</label>
											<?php $selectsts = empty($resultedit['account_head_active_status'])?"":$resultedit['account_head_active_status']; ?>
											<select id="account_head_active_status" name="account_head_active_status" class="form-control" required>
												<option value=''>-- Select --</option>
												<option <?php if($selectsts=='active'){ echo "selected"; } ?> value="active">Active</option>
												<option <?php if($selectsts=='inactive'){ echo "selected"; } ?> value="inactive">Inactive</option>
											</select>

										</div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Financial Accounts Type 1</label>
												<select name="account_head_type1" id="account_head_type1" class="form-control" tabindex="1" required onChange="gettype(this.value);" required >
												  <option value="">-- Select --</option>
												  <?php 
												  	foreach($arr_acc_head as $arr_key => $arr_value){
														if($resultedit['account_head_type1'] ==$arr_key ){ $select ='selected="selected"'; }else{ $select ='';}
												   ?>
													  <option <?php echo $select;?> value="<?php echo $arr_key; ?>"><?php echo $arr_value; ?></option>
												  <?php } ?>
												  </select>
										</div>
										<div class="form-group manuf_inex" id="d_manuf_inex" style="display:none;">
											<label>Financial Accounts Type 3</label>
											<?php $selectsts = empty($resultedit['account_head_type3'])?"":$resultedit['account_head_type3']; ?>
											<select id="account_head_type3" name="account_head_type3" class="form-control" required>
												<option value=''>-- Select --</option>
												<option <?php if($selectsts=='in'){ echo "selected"; } ?> value="in">Income</option>
												<option <?php if($selectsts=='ex'){ echo "selected"; } ?> value="ex">Expenses</option>
											</select>

										</div>
										
									</div>						
									
									
								</div>
								
								
						  </div>
						  
						</div>
					
						<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
								<button name="ac_head_insertupdate" type="submit" class="btn btn-success"><?php echo $btnVal; ?></button>
								<button type="reset" class="btn btn-danger">Reset</button>
						</div>	
						
        			</div>
				
				   </form>		
				
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								ACCOUNTS GROUP
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<form action="index.php" method="post">

									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>											
												<th>Head name</th>
												<th>Type one</th>
												<th>Action</th>
												<th>
													<input name="checkall" id="checkall" onClick="checkedAll(this);" type="checkbox"  />
													<button name="head_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($listResult as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['account_head_name']; ?></td>
												<td><?php echo $arr_acc_head[$result['account_head_type1']]; ?></td>                                           
												<td class="center">
													<a href="index.php?page=edit&id=<?php echo $result['account_head_id']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
													<input name="deleteCheck[]" class="check" value="<?php echo $result['account_head_id']; ?>" type="checkbox" />
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</form>

								</div>
							</div>
						</div>
				<?php } ?>
						
                <!-- /. ROW  -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        &copy; 2018 Authors | Design By : <a href="http://www.authorsmyanmar.com/" target="_blank">AuthorsMyanmar.com</a>
    </div>
	<script>
		$(document).ready(function () {
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
		});
		$("#leave-form").validate({
			rules: {
				lv_branchid: "required",
				lv_employee: "required",	
				lv_leave : "required"
			}
		});	
		
		$( "#ac-setup-form" ).validate({
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

 
