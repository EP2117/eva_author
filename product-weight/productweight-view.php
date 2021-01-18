<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Interview</title>
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
<script>
/*
function GetWcalc(calculation_id,id){
	if(calculation_id==2){
		var calc_amount 	= document.getElementById('width_inches_'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('width_mm_'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('width_inches_'+id).value 		= data_t[1];
			document.getElementById('width_mm_'+id).value 			= data_t[2];
		}

	);

}*/

function GetWcalc(calculation_id,id){
	if(calculation_id==2){
		var calc_amount 	= parseFloat(document.getElementById('width_inches_'+id).value);
		var total=	(25.4*calc_amount);
		document.getElementById('width_mm_'+id).value=total.toFixed(4);	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('width_mm_'+id).value;	
		var total=	(0.0393701*calc_amount);
		document.getElementById('width_inches_'+id).value=total.toFixed(4);
	}
	else if(calculation_id==4){
		var calc_amount 	= document.getElementById('length_feet_'+id).value;	
		var total=	(0.3048*calc_amount);
		document.getElementById('length_mm_'+id).value=total.toFixed(4);
	}
	else if(calculation_id==5){
		var calc_amount 	= document.getElementById('length_mm_'+id).value;	
		var total=	(3.28084*calc_amount);
		document.getElementById('length_feet_'+id).value=total.toFixed(4);
	}
	else if(calculation_id==6){
		var calc_amount 	= document.getElementById('weight_ton_'+id).value;	
		var total=	(calc_amount*1000);
		document.getElementById('weight_mm_'+id).value=total.toFixed(4);
	}
	else if(calculation_id==7){
		var calc_amount 	= document.getElementById('weight_mm_'+id).value;	
		var total=	(0.0001/calc_amount);
		document.getElementById('weight_ton_'+id).value=total.toFixed(4);
	}
}

function addRow(){
 	
	var last_val = $("#prodweight_apnd").val();
	var sno      = parseInt(last_val)+1;
	var apnd  = '<tr id="remove_lanuage_'+sno+'">';
		apnd += '<td><input type="hidden" name="wg_id_'+sno+'" value=""><select class="form-control" style="width:100%" name="thick_'+sno+'"  id="thick_'+sno+'"><option value="">--Select--</option><?php foreach($arr_thick as $value => $list){?><option value="<?=$value?>"><?=ucfirst($list)?></option><?php } ?></select></td>';
		apnd += '<td><input type="text" class="form-control" name="width_inches_'+sno+'" id="width_inches_'+sno+'"  onBlur="GetWcalc(2,'+sno+')"  value=""></td>';
		apnd += '<td><input type="text" class="form-control" name="width_mm_'+sno+'" id="width_mm_'+sno+'" value="" onBlur="GetWcalc(3,'+sno+')"  ></td>';
		apnd += '<td><input type="text" class="form-control" name="length_feet_'+sno+'" id="length_feet_'+sno+'" onBlur="GetWcalc(4,'+sno+')" value=""></td>';
		apnd += '<td><input type="text" class="form-control" name="length_mm_'+sno+'" id="length_mm_'+sno+'" onBlur="GetWcalc(5,'+sno+')" value=""></td>';
		apnd += '<td><input type="text" class="form-control" name="weight_ton_'+sno+'" id="weight_ton_'+sno+'" onBlur="GetWcalc(6,'+sno+')" value=""></td>';
		apnd += '<td><input type="text" class="form-control" name="weight_mm_'+sno+'" id="weight_mm_'+sno+'" onBlur="GetWcalc(7,'+sno+')" value=""></td>';
		apnd += '<td><button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onclick="removeRow('+sno+')"></button></td>';
		apnd += '</tr>';			
		$("#prodweight_apnd").val(sno);
		$("#lanuage >tbody").append(apnd);
 }
	
</script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/left-menu.php";
			if(isset($_GET['msg'])) {
				if($_GET['msg']==1) {
					$txt = 'style="color:green"';
					$msg = 'Added successfully';
				} 
			}
		 ?> 
        <div id="page-wrapper">
            <div id="page-inner">
				<div class="row">
					<div class="col-md-12">
					<h1 class="page-head-line">Product weight</h1>
					 <div class="col-lg-11 page-subhead-line">
						<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
					</div>
					 <div class="col-lg-1">
						<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
							<button  type="submit" class="btn btn-warning pull-right" onClick="location.href='index.php'">Back</button>
						<?php }else{?>
							<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
						<?php } ?>
					</div>
					</div>	
				</div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
					?>
					<form name="prodweight" id="prodweight" method="post" data-toggle="validator">
						<input type="hidden" name="id" value="<?php  echo $id = empty($result_edit[0]['wc_brand_id'])?"":$result_edit[0]['wc_brand_id']; ?>" >
						
						<div class="row">
							
							<div class="col-md-12 col-sm-12 col-xs-12">
							
								<div class="panel panel-info">
								
								<div class="panel-heading">
									Brand
								</div>
								
								<div class="panel-body">
									<div class="col-lg-4">
										<div class="form-group">
											<label class="control-label">Brand</label>
												<select class="form-control select2" name="product_brand_id" id="product_brand_id" required>
													<option value="">--Select--</option>
												<?php
												  	foreach($brand_list	as	$get_brand){
													$selected	= ($result_edit[0]['wc_brand_id']==$get_brand['brand_id'])?'selected="selected"':'';
												?>
												  	<option <?=$selected?> value="<?=$get_brand['brand_id']?>"  ><?=$get_brand['brand_name']?></option>
												<?php
													}
												?>
												</select>
										</div>
									</div>
									<div class="col-lg-8"></div>
								</div>
							</div>
								<div class="panel panel-info">
									
									<div class="panel-heading">
										Weight master
									</div>
									
									<div class="panel-body">
										<div class="table-responsive">																		
											<table id="lanuage" class="table table-striped table-bordered table-hover">
												<?php $count_lang = !empty($result_edit) ? count($result_edit) :''; ?>
												<thead>
													<tr>
														<th rowspan="2" width="15%" style="text-align:center;" valign="middle">Thick</th>
														<th colspan="2" style="text-align:center">Width</th>
														<th colspan="2" style="text-align:center">Length</th>	
														<th colspan="2" style="text-align:center">Weight</th>												
														<td rowspan="2" style="text-align:center" valign="middle" width="5%"><input type="hidden" name="prodweight_apnd" id="prodweight_apnd" value="<?php echo (0<$count_lang ? $count_lang :1); ?>">
															<button class="glyphicon glyphicon-plus" title="Add row" type="button" onClick="addRow();"></button>	
														</td>
													</tr>
													<tr>
														<th style="text-align:center">Inches</th>
														<th style="text-align:center">MM</th>
														<th style="text-align:center">Feet</th>
														<th style="text-align:center">MM</th>
														<th style="text-align:center">Ton</th>
														<th style="text-align:center">KG</th>
													</tr>
													
												</thead>
												<tbody>
												<?php 															
													if(0<$count_lang){
													   for($i=1;$i<=count($result_edit);$i++){
														$j=$i-1;
													 ?>
													<tr id="remove_lanuage_<?php echo $i; ?>">
														
														<td>
															<input type="hidden" name="wg_id_<?php echo $i; ?>" value="<?php echo $result_edit[$j]['weightcalcId']; ?>">
															<select class="form-control" style="width:100%" name="thick_<?php echo $i; ?>" id="thick_<?php echo $i; ?>" required>
																<option value="">--Select--</option>
																<?php
																	foreach($arr_thick as $value => $list){
																	$selected	= ($result_edit[$j]['wc_thickid']==$value)?'selected="selected"':'';
																?>
																	<option <?=$selected?> value="<?=$value?>"><?=ucfirst($list)?></option>
																<?php
																}
																?>
															</select>
															
														</td>													
														<td><input type="text" class="form-control" name="width_inches_<?php echo $i; ?>" id="width_inches_<?php echo $i; ?>" value="<?php echo $result_edit[$j]['wc_wight_inches']; ?>"  onBlur="GetWcalc(2,<?php echo $i; ?>)"></td>
														<td><input type="text" class="form-control" name="width_mm_<?php echo $i; ?>" id="width_mm_<?php echo $i; ?>" value="<?php echo $result_edit[$j]['wc_wight_mm']; ?>" onBlur="GetWcalc(3,<?php echo $i; ?>)"></td>
														<td><input type="text" class="form-control" name="length_feet_<?php echo $i; ?>" id="length_feet_<?php echo $i; ?>" value="<?php echo $result_edit[$j]['wc_length_feet']; ?>" onBlur="GetWcalc(4,<?php echo $i; ?>)"></td>
														<td><input type="text" class="form-control" name="length_mm_<?php echo $i; ?>" id="length_mm_<?php echo $i; ?>" value="<?php echo $result_edit[$j]['wc_length_mm']; ?>" onBlur="GetWcalc(5,<?php echo $i; ?>)"></td>
														<td><input type="text" class="form-control" name="weight_ton_<?php echo $i; ?>" id="weight_ton_<?php echo $i; ?>" value="<?php echo $result_edit[$j]['wc_weight_ton']; ?>" onBlur="GetWcalc(6,<?php echo $i; ?>)"></td>
														<td><input type="text" class="form-control" name="weight_mm_<?php echo $i; ?>" id="weight_mm_<?php echo $i; ?>" value="<?php echo $result_edit[$j]['wc_weight_mm']; ?>" onBlur="GetWcalc(7,<?php echo $i; ?>)"></td>										
														<td valign="middle">
															<button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onClick="removeRow(1)"></button>
														</td>											
														
													</tr>
													<?php }
														    }else{
														 ?>
													<tr id="remove_lanuage_1">
														<td>
															<input type="hidden" name="wg_id_1" value="">
															<select class="form-control" style="width:100%" name="thick_1" id="thick_1" required>
																<option value="">--Select--</option>
																<?php
																	foreach($arr_thick as $value => $list){
																?>
																	<option value="<?=$value?>"><?=ucfirst($list)?></option>
																<?php
																}
																?>
															</select>
															
														</td>													
														<td><input type="text" class="form-control" name="width_inches_1" id="width_inches_1"  onBlur="GetWcalc(2,1)" ></td>
														<td><input type="text" class="form-control" name="width_mm_1" id="width_mm_1" onBlur="GetWcalc(3,1)" ></td>
														<td><input type="text" class="form-control" name="length_feet_1" id="length_feet_1" onBlur="GetWcalc(4,1)"></td>
														<td><input type="text" class="form-control" name="length_mm_1" id="length_mm_1" onBlur="GetWcalc(5,1)"></td>
														<td><input type="text" class="form-control" name="weight_ton_1" id="weight_ton_1"  onBlur="GetWcalc(6,1)"></td>
														<td><input type="text" class="form-control" name="weight_mm_1" id="weight_mm_1" onBlur="GetWcalc(7,1)"></td>										
														<td valign="middle">
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
							
								
								
							</div>	
							
							<div class="col-lg-6">
								<?php  $btnVal = (!$id)?  'Submit' : 'Update' ; ?>
										<button name="prodweight" type="submit" class="btn btn-primary"><?php echo $btnVal; ?> Button</button>
										<button type="reset" class="btn btn-danger">Reset Button</button>
										<input type="button" class="btn" value="Back" onClick="location.href='index.php'">
							</div>		
					
					  </div>
					</form>				
				<?php 
					}else{ 
					?>	
						
						<div class="panel panel-default">
							<div class="panel-heading">
								Product weight List
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<form action="index.php" method="post" name="application_form" id="application_form">
									<table class="table table-striped table-bordered table-hover" id="dataTables_emp_app">
										<thead>
											<tr>
												<th>S.No</th>											
												
												<th>Brand</th>
												
												<th>Action</th>
												<th><input name="checkall" onClick="checkedall();" type="checkbox"  />
												<button name="app_form" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($proweight AS $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												
												<td><?php echo $result['brand_name']; ?></td>												
												                                      
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['brand_id']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td>
												<input name="deleteCheck[]" value="<?php echo $result['brand_id']; ?>" type="checkbox" />
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
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        &copy; <?=PROJECT_FOOTER?>
    </div>
	<script>
		$(document).ready(function () {
			$('#dataTables-example').DataTable( {
				responsive: true
			} );
					
		});		
	</script>
	
	

</body>

</body>
</html>
