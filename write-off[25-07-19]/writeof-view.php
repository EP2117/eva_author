<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WRITE OFF</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		
		if($_GET['msg']==1) {
		
			$msg = 'Added successfully';
			
		}elseif($_GET['msg']==2) {
		
			$msg = 'Updated successfully';

		} elseif($_GET['msg']==6) {
		
			$msg = 'Deleted successfully';

		} 
	}		
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/write-off/writeof-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">WRITE OFF</h1>
                         <div class="col-lg-11 page-subhead-line">
							<h1><?php if(isset($_GET['msg'])) { echo $msg; } ?></h1>
						</div>
						<div class="col-lg-1">
							<?php if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ ?>
							<?php }else{?>
								<button type="submit" class="btn btn-primary pull-right" style="padding-right:" onClick="location.href='index.php?page=add'">Add new</button>
							<?php } ?>
						</div>
                    </div>
                </div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>	
					<form name="writeof-form" id="writeof-form" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editwriteoff['writeoffId'])?"":$editwriteoff['writeoffId']; ?>" >
						
						<div class="row">
						
							<div id="receipt" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										WRITE OFF							 
									</div>									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required onChange="get_po(this.value)">
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editwriteoff['wr_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select ='';}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											<div class="form-group">
												<label class="control-label">Warehouse</label>
												<select name="warehouseid" id="warehouseid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
													foreach($godown_list as	$get_godown){
														if($editwriteoff['wr_warehouseid'] == $get_godown['godown_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
													<?php
														}
													?>
												</select>
													
											</div>	
											<div class="form-group">
												<label>Select id</label>
												<input type="hidden" name="write_off_type_id" id="write_off_type_id" value="<?php  echo $id = isset($editwriteoff['write_off_type_id'])?$editwriteoff['write_off_type_id']:""; ?>" >
												<select name="dmgmsg_Scrp_id" id="dmgmsg_Scrp_id" class="form-control" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													foreach($dmgmsg_scrp as	$get_id){
														if($editwriteoff['wr_dmgMsgScrpId'] == $get_id['damage_entry_id']){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$get_id['damage_entry_id']?>"><?=$get_id['damage_entry_no']."-".dateGeneralFormatN($get_id['damage_entry_date'])."-".$arr_damage[$get_id['damage_entry_type_id']]?></option>
													<?php
														}
													?>
												</select>
											</div>		
										</div>																				
										<div class="col-lg-6">
											<div class="form-group">
												<label class="control-label">Write off Date</label>
												
												  <input type="text" class="form-control"  name="write_date" id="write_date" readonly value="<?php echo empty($editwriteoff['wr_date'])?date('d/m/Y'):$editwriteoff['wr_date']; ?>" required>	
											</div>	
											<div class="form-group">
												<label>Type</label>
												<select name="writeof_type" id="writeof_type" class="form-control select2" style="width:100%" >
													 <option value=""> - Select - </option>
													<?php
													foreach($writeof_type_arry as $key=>$val){
														if($editwriteoff['wr_type'] == $key){ $select ='selected="selected"'; }else{ $select="";}
													?>
														<option <?php echo $select;?> value="<?=$key?>"><?=$val?></option>
													<?php
														}
													?>
												</select>
											</div>		
											
									</div>		
								</div>
								
								</div>
								
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Product Details								 
									</div>
									<div class="panel-body">
										<div class="col-lg-6">
		
											<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
		
										</div>
										<table class="table table-striped table-bordered table-hover" id="product_detail"  style="width:190%" >
									<?php
									$wr_type_id= empty($editwriteoff['wr_type_id'])?"":$editwriteoff['wr_type_id'];
									
									$rls_status	= (isset($editwriteoff['wr_type_id']) && $editwriteoff['wr_type_id'] =='2')?'':'none';
									$as_status	= (isset($editwriteoff['wr_type_id']) && $editwriteoff['wr_type_id'] =='1')?'':'none';
									?>
									
									<thead class="rls"  style="display:<?=$rls_status?>">
                                          <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> Color</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES LENGTH</th>
											<th colspan="2" style="vertical-align:middle;"> Weight</th>
                                        </tr>
										<tr>
											<th> INCHES</th>
											<th>MM</th>
											<th>FEET</th>
											<th>MM</th>
											<th>TONE</th>
											<th>KG</th>
										</tr>
                                    </thead>
									<thead style="display:<?=$as_status?>" class="as">

                                         <tr>


                                            <th style="vertical-align:middle; width:30%">NAME</th>

                                            <th style="vertical-align:middle; width:30%">UOM</th>

											<th style="vertical-align:middle; width:40%">QTY</th>


                                        </tr>

                                    </thead>
                                    <tbody id="product_detail_display">
									<?php 
									
									
									$count_eduction = !empty($editwriteoffProd) ? count($editwriteoffProd) :''; 
									if(0<$count_eduction){
									for($c=1;$c<=count($editwriteoffProd);$c++){
									$d=$c-1;
									if($wr_type_id==2){?>
									<tr>
									<td><?=$editwriteoffProd[$d]['brand_name'] ?></td>
									
									<td ><?=$editwriteoffProd[$d]['product_con_entry_child_product_detail_name'] ?><input type="hidden" name="writeoff_entry_product_detail_product_id[]" id="writeoff_entry_product_detail_product_id<?php echo $c; ?>" value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_product_id'] ?>" />
									<input type="hidden"  name="writeoff_entry_product_detail_product_type[]" id="writeoff_entry_product_detail_product_type<?php echo $c; ?>"  value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_product_type'] ?>" />
									<input type="hidden"  name="writeoff_entry_product_detail_id[]" id="writeoff_entry_product_detail_id<?php echo $c; ?>"  value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_id'] ?>" />
									</td>
									
									<td >	<?=$editwriteoffProd[$d]['product_colour_name']?></td>	
									
									<td >	<?=$arr_thick[$editwriteoffProd[$d]['writeoff_entry_product_detail_product_thick']]?></td>	
									 
									<td> <input  class="form-control" type="text"  name="writeoff_entry_product_detail_width_inches[]" id="writeoff_entry_product_detail_width_inches<?php echo $c; ?>"  onBlur="GetWcalc(2,<?php echo $c; ?>)"value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_width_inches']?>" class="form-control" /></td>
									 
									<td> <input  class="form-control" type="text"  name="writeoff_entry_product_detail_width_mm[]" id="writeoff_entry_product_detail_width_mm<?php echo $c; ?>"   onBlur="GetWcalc(3,<?php echo $c; ?>)" value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_width_mm']?>"  class="form-control"/></td>
									
									<td> <input  class="form-control" type="text"  name="writeoff_entry_product_detail_length_feet[]" id="writeoff_entry_product_detail_length_feet<?php echo $c; ?>"  value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_length_feet']?>" onBlur="GetLcalFeet(1,<?php echo $c; ?>)" class="form-control" /></td> 
									
									<td> <input  class="form-control" type="text"  name="writeoff_entry_product_detail_length_mm[]" id="writeoff_entry_product_detail_length_mm<?php echo $c; ?>" value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_length_mm']?>" onBlur="GetLcalFeet(3,<?php echo $c; ?>)"  class="form-control"  /></td>
									
									<td> <input  class="form-control" type="text"  name="writeoff_entry_product_detail_weight_tone[]" id="writeoff_entry_product_detail_weight_tone<?php echo $c; ?>"  onBlur="GetWeightClc(1,<?php echo $c; ?>)" value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_weight_tone']?>"  class="form-control"  /></td>
									
									<td> <input class="form-control" type="text"  name="writeoff_entry_product_detail_weight_kg[]" id="writeoff_entry_product_detail_weight_kg<?php echo $c; ?>" readonly  value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_weight_kg']?>"  onBlur="GetWeightClc(2,<?php echo $c; ?>)" class="form-control" /></td>
									
									<td><?php if($c>1) { ?><a href="index.php?product_detail_id=<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_id']?>&uniq_id=<?php echo $editwriteoff['writeoffId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

									</tr>
									<?php }else{?>
									
									<tr>
									<td ><?=$editwriteoffProd[$d]['product_name'] ?><input type="hidden"  name="writeoff_entry_product_detail_product_id[]" id="writeoff_entry_product_detail_product_id<?php echo $c; ?>" value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_product_id'] ?>" />
									<input type="hidden"  name="writeoff_entry_product_detail_product_type[]" id="writeoff_entry_product_detail_product_type<?php echo $c; ?>"  value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_product_type'] ?>" />
									<input type="hidden"  name="writeoff_entry_product_detail_id[]" id="writeoff_entry_product_detail_id<?php echo $c; ?>"  value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_id'] ?>" />
									</td>
			
									<td >	<?=$editwriteoffProd[$d]['product_uom_name']?></td>
			
									<td style="width:40%"><input class="form-control" type="text"  name="writeoff_entry_product_detail_qty[]" id="writeoff_entry_product_detail_qty<?php echo $c; ?>"  onBlur="AccdiscountPerFind(<?php echo $c; ?>)" value="<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_qty'] ?>"  /></td>
									<td><?php if($c>1) { ?><a href="index.php?product_detail_id=<?=$editwriteoffProd[$d]['writeoff_entry_product_detail_id']?>&uniq_id=<?php echo $editwriteoff['writeoffId']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
			</tr>
									<?php }?>
									
									<?php  } } ?>
									</tbody>
								</table>					
									</div>
									
								</div>
								
							</div>
							
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="writeof_insrtUpdate" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
								<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Write off
							</div>
							<form action="index.php" method="post" id="so_list_form" name="so_list_form" >
						
							<div class="col-lg-6">

									<div class="form-group">

										<label class="control-label">Branch</label>

										<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" required>

											  <option value=""> - Select - </option>

											<?php

												foreach($branch_list	as	$get_branch){
											$selected	= ($get_branch['branch_id']==searchValue('search_branch_id'))?'selected="selected"':'';
											?>

													<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>

											<?php

												}

											?>

										</select>

									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">From Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date" autocomplete="off"  value="<?=searchValue('search_from_date')?>"  >
										</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">To Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_to_date" id="search_to_date" autocomplete="off"  value="<?=searchValue('search_to_date')?>"  />
										</div>
									</div>
									</div>
							<div class="col-lg-12">
								<button name="search" type="submit" class="btn btn-success">Search </button>
								<button type="reset" class="btn btn-danger">Reset </button>
							</div>
							</form>
							<div class="panel-body">
								<div class="table-responsive">
								    <?php if(isset($_REQUEST['search'])){?>
										<form name="writeof-form" id="writeof-form" method="post" enctype="multipart/form-data">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Writeof id</th>	
												<th>Dmg-Msing-scrp id</th>	
												<th>Type</th>									
												<th>Warehouse</th>
												<th>Branch</th>
												<th>Date</th>
												<th>Action</th>
												<th style="text-align:center"><input type="checkbox" name="select_all" id="select_all" value="" onClick="checkedall();"> <input type="submit"name="writeof_delete" id="writeof_delete" value="Delete" class="btn btn-danger"></th>
                                        </tr>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($writeofList as $result){
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo substr(('00000'.$result['writeoffId']),-5); ?></td>
												<td><?php echo $result['damage_entry_no']; ?></td>
												<td><?php echo $writeof_type_arry[$result['wr_type']]; ?></td>
												<td><?php echo $result['godown_name']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['wr_date']; ?></td>
												<td class="center">
												<a href="index.php?page=edit&id=<?php echo $result['writeoffId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
												</td>
												<td style="text-align:center"><input type="checkbox" id="select_all" name="select_all[]" value="<?php echo $result['writeoffId']?>"></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</form>
									<?php }?>
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
       <?=PROJECT_FOOTER?>
    </div>
	
<div class="panel-body">

                            

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

                                <div class="modal-dialog" style="width: 800px;">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>

                                        </div>

                                        <div class="modal-body">

											<div class="table-responsive">

												<div id="dynamic-content">

												</div>

											</div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="button" class="btn btn-primary" onClick="AddproductDetail()"  data-dismiss="modal">Save changes</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
	<script>
	
	
	function get_po(branch_id){
		//alert('test');
		$.get("product-detail.php",{branch_id:branch_id,action:'po'},function(data){
							 
							 $("#dmgmsg_Scrp_id").html(data);
							 
							 });
	
	}

	
		$(document).ready(function () {
			$('#dataTables-example').DataTable( {
				responsive: true
			} );	
			
		});
		
		$(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
		$( "#write_date" ).datepicker({
			 dateFormat: 'dd/mm/yy',
			 changeMonth:true,
			 changeYear:true
		});
			
		$( "#writeof-form" ).validate({
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

 
