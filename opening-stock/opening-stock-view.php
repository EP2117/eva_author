<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OPENING STOCK ENTRY</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Opening Stock Entry added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Opening Stock Entry updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Opening Stock Entry deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Opening Stock Entry Product Detail deleted successfully</div>';
		} 
	}

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/opening-stock/opening-stock-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">OPENING STOCK ENTRY</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) {
									echo $msg;
								}
							?>
						</h1>
                    </div>
                </div>
				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>
				<form name="opening_stock_form" id='opening_stock_form' method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Opening Stock Entry Detail
								</div>
								<div class="panel-body">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="opening_stock_branch_id" id="opening_stock_branch_id" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
												?>
														<option value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Warehouse</label>
											<select name="opening_stock_godown_id" id="opening_stock_godown_id" class="form-control select2" style="width:100%" onChange="return GetDetail();" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($godown_list	as	$get_godown){
												?>
														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
												<?php
													}
												?>
											</select>
										</div>

									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="opening_stock_date" id="opening_stock_date" required>
											</div>
										</div>
										
									</div>
									
								</div>
						</div>
					</div>
        		</div>
				
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  Product Details
							</div>
							<div class="panel-body">
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >
                                    <thead>
                                        <tr>
                                            <th style=" width:20%;">Product Code </th>
                                            <th style=" width:20%;">Product Name</th>
                                            <th style=" width:10%;">UOM 1</th>
                                            <th style=" width:10%;">UOM 2</th>											
                                            <th style=" width:10%;">Inches(width)</th>
                                            <th style=" width:10%;">Feet(Length)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_detail_display">
										<tr><td colspan="6" style="text-align:center">No records available</td></tr>
									</tbody>
								</table>
								</div>
								
								
								<div class="col-lg-6">
									<button name="opening_stock_insert" type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-danger">Reset</button>
									<button type="button" class="btn "  onclick="location.href='index.php'"  >Back</button>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				</form>
				
				<?php }else if((isset($_GET['page']))  && (isset($_GET['id'])) && ($_GET['page']=='edit')) {
				?>
				<form name="opening_stock_form" id='opening_stock_form' method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Stock Transfer Entry Detail
								</div>
								<div class="panel-body">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Branch</label>
											<select name="opening_stock_branch_id" id="opening_stock_branch_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
														$selected	= ($get_branch['branch_id']==$opening_stock_edit['opening_stock_branch_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										
										
										<div class="form-group">
											<label>Warehouse</label>
											<select name="opening_stock_godown_id" id="opening_stock_godown_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($godown_list	as	$get_godown){
														$selected	= ($get_godown['godown_id']==$opening_stock_edit['opening_stock_godown_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" name="opening_stock_date" id="opening_stock_date" required  value="<?=dateGeneralFormatN($opening_stock_edit['opening_stock_date'])?>"/>
											</div>
												
												
										</div>
									</div>
								</div>
						</div>
						
					</div>
        		</div>
				
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  Product Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
                            </button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >
                                    <thead>
                                        <tr>
                                            <th >Product Code </th>
                                            <th >Product Name</th>
                                            <th >UOM 1</th>
                                            <th >UOM 2</th>											
                                            <th style=" width:10%;">Inches(width)</th>
                                            <th style=" width:10%;">Feet(Length)</th>								
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_detail_display">
										<?php 
										$row_cnt	= 0;
										$arr_cnt	= count($opening_stock_prd_edit);
										foreach($opening_stock_prd_edit as $get_product_detail){
										?>
										<tr>
											<td>
											<input class="form-control" type="text"  name="opening_stock_product_detail_product_code" 
											id="opening_stock_product_detail_product_code<?=$row_cnt?>" value="<?=$get_product_detail['product_code']?>"  />
											</td>
											<td>
											<input class="form-control" type="text"  name="opening_stock_product_detail_product_name" 
											id="opening_stock_product_detail_product_name" value="<?=$get_product_detail['product_name']?>"  />
											<input type="hidden"  name="opening_stock_product_detail_product_id[]" id="opening_stock_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['opening_stock_product_detail_product_id']?>"  class="dc_id"  />
											<input type="hidden"  name="opening_stock_product_detail_id[]" id="opening_stock_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['opening_stock_product_detail_id']?>"  />
											</td>
											<td>
											<input class="form-control" type="text"  name="opening_stock_product_detail_uom1[]" id="opening_stock_product_detail_uom1<?=$row_cnt?>" value="<?=$get_product_detail['UOM1']?>"  />
											</td>
											<td>
											<input class="form-control" type="text"  name="opening_stock_product_detail_uom2[]" id="opening_stock_product_detail_uom2<?=$row_cnt?>" value="<?=$get_product_detail['UOM1']?>"  />
											</td>											
											<td>
											<input class="form-control" type="text"  name="opening_stock_product_detail_qty1[]" id="opening_stock_product_detail_qty1<?=$row_cnt?>" value="<?=$get_product_detail['opening_stock_product_detail_qty1']?>" onBlur="discountPerFind(<?=$row_cnt?>)"  /></td>
											<td>
											<input class="form-control" type="text"  name="opening_stock_product_detail_qty2[]" id="opening_stock_product_detail_qty2<?=$row_cnt?>" value="<?=$get_product_detail['opening_stock_product_detail_qty2']?>" onBlur="discountPerFind(<?=$row_cnt?>)"  /></td>
											
											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['opening_stock_product_detail_id']?>&opening_stock_uniq_id=<?php echo $opening_stock_edit['opening_stock_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>	
											</tr>										
											<?php
											$row_cnt	= $row_cnt+1;
										}
										?>
									</tbody>
								</table>
								</div>
								
								<div class="col-lg-6">
										<input type="hidden"  name="opening_stock_id" id="opening_stock_id" value="<?=$opening_stock_edit['opening_stock_id']?>" />	
										<input type="hidden"  name="opening_stock_uniq_id" id="opening_stock_uniq_id" value="<?=$opening_stock_edit['opening_stock_uniq_id']?>" />	
									<button name="opening_stock_update" type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-danger">Reset</button>
									<button type="button" class="btn "  onclick="location.href='index.php'"  >Back</button>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				</form>
				<?php
				} else{?>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Opening Stock List
                        </div>
                        <div class="panel-body">
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>													
                            <div class="table-responsive">
								<form action="index.php" method="post" id="opening_stock_list_form" name="opening_stock_list_form" >
							
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>SO.No.</th>
                                            <th>Date</th>
                                            <th>Warehouse</th>
                                            <th>Action</th>
											<th>
												<input name="checkall" onClick="checkedAll();" type="checkbox"  />
												<button name="opening_stock_delete" type="submit" class="btn btn-danger">Delete</button>
											</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($opening_stock_list as $get_stock){
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_stock['opening_stock_no']?></td>
                                            <td><?=dateGeneralFormatN($get_stock['opening_stock_date'])?></td>
											<td><?=$get_stock['godown_name']?></td>
											
                                            <td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_stock['opening_stock_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
      										</td>
											<td>
												<input name="deleteCheck[]" value="<?php echo $get_stock['opening_stock_uniq_id']; ?>" type="checkbox" />
											</td>
											
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
							 </form>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            	</div>
				<?php } ?>
                <!-- /. ROW  -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	<div class="panel-body">
                            
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">
                                <div class="modal-dialog">
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
                                            <button type="button" class="btn btn-primary" onClick="AddproductDetail()"  data-dismiss="modal">Submit</button>
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->

	<script>
		$('#dataTables_opening_stock').DataTable( {
			responsive: true
		} );
	
		$('#opening_stock_date').datepicker({	
			dateFormat:'dd/mm/yy',
			changeMonth: true,
			changeYear: true,	
		});		
	
		$( "#opening_stock_form" ).validate({
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
</html>
