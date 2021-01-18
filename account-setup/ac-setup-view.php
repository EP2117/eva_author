<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>A/C Settup</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/account-setup/ac-setup-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/finance-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
				<div class="row">
				 <div class="col-md-12">
                        <h1 class="page-head-line">Account setup</h1>
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
					<form name="ac-setup-form" id="ac-setup-form" method="post" data-toggle="validator">
						<input type="hidden" name="id" value="<?php  echo $id = empty($ac_edit['acountSetupId'])?"":$ac_edit['acountSetupId']; ?>" >
					
					<div class="row">
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  
					 	  <div class="panel panel-info">
								
								<div class="panel-heading">
								  	Account setup
									
								</div>
								
								<div class="panel-body">
								
									<div class="col-lg-6">
										
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select class="form-control select2" style="width:100%" name="branchid" id="branchid" required>
											  <option value=""> - Select - </option>
												<?php
													foreach($branch_list as	$get_branch){
														if($ac_edit['acS_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
												<?php
														}
													?>
											</select>
										</div>
										
										<div class="form-group">
											<label class="control-label">Sales</label>											
												<input type="text" class="form-control" name="sales" id="sales" onFocus="return getAccountName(this.value,this);"  value="<?php  echo empty($ac_edit['acS_sales'])?"":accounts_details($ac_edit['acS_sales']); ?>" required onKeyUp="return getAccountName(this.value,this);" onKeyUp="">	
										</div>										
										<div class="form-group">
											<label>Sales Return</label>	
											  <input type="text" class="form-control" name="sales_return" id="sales_return" onFocus="return getAccountName(this.value,this);" value="<?php echo empty($ac_edit['acS_sales_return'])?"":accounts_details($ac_edit['acS_sales_return']); ?>" onKeyUp="return getAccountName(this.value,this);">										
										</div>	
										
										<div class="form-group">
											<label class="control-label">Bank</label>
											<input type="text" class="form-control" name="sales_ac1" id="sales_ac1" onFocus="return getAccountName(this.value,this);" value="<?php echo empty($ac_edit['acS_sales_ac1'])?"":accounts_details($ac_edit['acS_sales_ac1']); ?>" required onKeyUp="return getAccountName(this.value,this);">				
										</div>
										<div class="form-group" >
											<label>Cash</label>	
											  <input type="text" class="form-control" name="sales_ac2" id="sales_ac2" onFocus="return getAccountName(this.value,this);" value="<?php echo empty($ac_edit['acS_sales_ac2'])?"":accounts_details($ac_edit['acS_sales_ac2']); ?>" onKeyUp="return getAccountName(this.value,this);">										
										</div>	
										<div class="form-group">
											<label>AC</label>
											<input type="text" class="form-control" name="sales_ac3" id="sales_ac3" onFocus="return getAccountName(this.value,this);" value="<?php echo empty($ac_edit['acS_sales_ac3'])?"":accounts_details($ac_edit['acS_sales_ac3']); ?>" onKeyUp="return getAccountName(this.value,this);">				
										</div>
										
																	
									</div>
									
									<div class="col-lg-6">
										<!--<div class="form-group">
											<label>Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right lvdate"  name="ac_date" id="ac_date" readonly="" value="<?php echo empty($ac_edit['acS_ac_date'])?"":$ac_edit['acS_ac_date']; ?>">
											</div>
										</div>		
										-->
										<div class="form-group">
											<label>Purchase</label>											
												<input type="text" class="form-control" name="purchase" id="purchase" onFocus="return getAccountName(this.value,this);" value="<?php  echo empty($ac_edit['acS_purchase'])?"":accounts_details($ac_edit['acS_purchase']); ?>" onKeyUp="return getAccountName(this.value,this);">	
										</div>										
										<div class="form-group">
											<label>Purchase Return</label>	
											  <input type="text" class="form-control" name="purchase_return" id="purchase_return" onFocus="return getAccountName(this.value,this);" value="<?php echo empty($ac_edit['acS_purchase_return'])?"":accounts_details($ac_edit['acS_purchase_return']); ?>" onKeyUp="return getAccountName(this.value,this);">										
										</div>	
										
										<div class="form-group">
											<label>AC</label>
											<input type="text" class="form-control" name="purchase_ac1" id="purchase_ac1" onFocus="return getAccountName(this.value,this);" value="<?php echo empty($ac_edit['acS_purchase_ac1'])?"":accounts_details($ac_edit['acS_purchase_ac1']); ?>" onKeyUp="return getAccountName(this.value,this);">				
										</div>
										<div class="form-group">
											<label>AC</label>	
											  <input type="text" class="form-control" name="purchase_ac2" id="purchase_ac2" onFocus="return getAccountName(this.value,this);" value="<?php echo empty($ac_edit['acS_purchase_ac2'])?"":accounts_details($ac_edit['acS_purchase_ac2']); ?>" onKeyUp="return getAccountName(this.value,this);">										
										</div>	
										<div class="form-group">
											<label>AC</label>
											<input type="text" class="form-control" name="purchase_ac3" id="purchase_ac3" onFocus="return getAccountName(this.value,this);" value="<?php echo empty($ac_edit['acS_purchase_ac3'])?"":accounts_details($ac_edit['acS_purchase_ac3']); ?>" onKeyUp="return getAccountName(this.value,this);">				
										</div>
									</div>						
									
									
								</div>
								
								
						  </div>
						  
						</div>
					
						<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
								<button name="ac_setup_insertupdate" type="submit" class="btn btn-success"><?php echo $btnVal; ?></button>
								<button type="reset" class="btn btn-danger">Reset</button>
						</div>	
						
        			</div>
				
				   </form>		
				
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Account Setup 
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>											
												<th>Branch</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($ACSetupResult as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['acountSetupId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
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
       <?=PROJECT_FOOTER?>
    </div>
	<script>
		$(document).ready(function () {
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
		});
		
		$('.lvdate').datepicker({	
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear: true,	
		});	
		$('#lv_fromdate').datepicker({	
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear: true,	
		});	
		$('#lv_todate').datepicker({
			dateFormat:'dd-mm-yy',	
			changeMonth: true,
			changeYear: true,
			onSelect : function (selectedDate){
				var s_date = $('#lv_fromdate').val().split('-');
				var start  = new Date(s_date[1]+'/'+s_date[0]+'/'+s_date[2]);
				var e_date = selectedDate.split('-');
				var end    = new Date(e_date[1]+'/'+e_date[0]+'/'+e_date[2]);
					 days  = (end - start)/(1000 * 60 * 60 * 24);
					 day   = Math.round(days+1);
					 $("#lv_leaveno").val(day);
			}
		});		
		$("#leave-form").validate({
			rules: {
				lv_branchid: "required",
				lv_employee: "required",	
				lv_leave : "required",
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

 
