<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Overtime</title>
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
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/overtime/overtime-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/report-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Overtime Report</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) { echo $msg; }
							?>
						</h1>
                    </div>
                </div>	
				
				
				<form name="leave-form" id="leave-form" method="post" data-toggle="validator">
						<input type="hidden" name="id" value="<?php  echo $id = empty($leave_edit['empLeaveId'])?"":$leave_edit['empLeaveId']; ?>" >
					
					<div class="row">
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  
					 	  <div class="panel panel-info">
								
								<div class="panel-heading">
								  	Leave
								</div>
								
								<div class="panel-body">
								
									<div class="col-lg-6">
										
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select class="form-control select2" style="width:100%" name="ot_branchid" id="ot_branchid" required>
											  <option value=""> - Select - </option>
												<?php
													foreach($branch_list as	$get_branch){
														if(searchValue('ot_branchid') == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
													?>
														<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
												<?php
														}
													?>
											</select>
										</div>
										</div>
								
										<div class="form-group" >
											<label>From date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="ot_fromdate" id="ot_fromdate" readonly="" value="<?php echo searchValue('ot_fromdate'); ?>" >
											</div>
										</div>
										<div class="col-lg-6">	
										<div class="form-group">
											<label>To date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="ot_todate" id="ot_todate" readonly="" value="<?php echo searchValue('ot_todate'); ?>" >
											</div>
										</div>											
									</div>						
									
									
								</div>
								
								
						  </div>
						  
						</div>
					
						<div class="col-lg-6">
							
								<button name="search" type="submit" class="btn btn-success">Search</button>
								<button type="reset" class="btn btn-danger">Reset </button>
						</div>	
        			</div>
					
				
				</form>	
				<div style="float:right;">
				<a href="<?php echo PROJECT_PATH.'/overtime-report/overtime-excel.php?ot_fromdate='.searchValue('ot_fromdate').'&ot_branchid='.searchValue('ot_branchid').'&ot_todate='.searchValue('ot_todate');?>" title="Download Excel" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/excel-icon.png'; ?>" width="28" border="0"   alt="Download Excel" title="Download Excel">
							</a>
						
						<!--	<a href="<?php echo PROJECT_PATH.'sales-invoice-entry-report/invoice-entry-report-pdf.php?search_from_date='.searchValue('search_from_date').'&search_branch_id='.searchValue('search_branch_id').'&search_customer_id='.searchValue('search_customer_id').'&search_entry_no='.searchValue('search_entry_no').'&search_to_date='.searchValue('search_to_date').'&search_sales_man_id='.searchValue('search_sales_man_id');?>" title="Download PDF" target="_blank">
							<img src="<?php echo PROJECT_PATH.'/images/pdf-icon.png'; ?>" width="28" /></a>-->
				</div>			
						
					<div class="panel panel-default">
							
							<div class="panel-body">
							
							&nbsp;
								<div class="table-responsive">
									<form name="overtime-form" id="overtime-form" method="post" data-toggle="validator">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>											
												<th>Employee</th>
												<th>Branch</th>
												<th>OT type</th>
												<th>In-Time</th>
												<th>Out-Time</th>
												<th>Total Hrs</th>
												<th>Date</th>
												<th>Rate</th>
												<th>Amount</th>
												</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($otList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['employee_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php if($result['ot_type_id']==1){ echo "Normal"; }elseif($result['ot_type_id']==2){ echo "Sat"; }else{ echo "";} ?></td>
												<td><?php echo $result['ot_starttime']; ?></td>
												<td><?php echo $result['ot_endtime']; ?></td>
												<td><?php echo $result['diftime']; ?></td>  
												<td><?php echo $result['ot_date']; ?></td>  
												<td><?php echo $result['ot_rate']; ?></td>  
												<td><?php echo $result['ot_amount']; ?></td> 
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</form>
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
			$('#dataTables-example').DataTable( {
				responsive: true
			} );
						
		});
		$('#ot_date').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,	
		});	
		
		$('#ot_fromdate').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,	
		});	
		
		$('#ot_todate').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,	
		});	
		$('.timepicker').timepicker({ 
			'timeFormat': 'H:i:s'
		 });
		 
		$( "#overtime-form" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
		});	  
			//overtime-form	
	</script>

</body>

 
