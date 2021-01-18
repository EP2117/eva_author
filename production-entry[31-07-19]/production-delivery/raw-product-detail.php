  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$m_id = $_GET['m_id'];
	
   	if($m_id == '') {
   		$m_id = '""';
   	}
   		$select_product 			= "	SELECT  
											product_code,
											product_name,
											product_uom_name,
											product_colour_name,
											product_detail_raw_product_id,
											product_thick_ness,
											product_detail_product_id
										FROM 
											product_details 
										LEFT JOIN 
											products 
										ON 
											product_id 													= product_detail_raw_product_id
										LEFT JOIN 
											product_uoms 
										ON 
											product_uom_id 												= product_product_uom_id
										LEFT JOIN 
											product_colours 
										ON 
											product_colour_id 											= product_product_colour_id
										WHERE 
											product_detail_deleted_status				=	0 									AND
											product_detail_product_id 					 		IN (".$m_id.") 								";
	
	$result_product = mysql_query($select_product);
  
?>
		<form method="get" name="raw_product_list_form" id="raw_product_list_form"  >
		<table class="table datatable table-bordered" id="raw_product_detail_popup">
			<thead>
				<tr>
				  <th width="5%" >#</th>
				  <th width="12%" >Code</th>
				  <th width="24%" >Product</th>
				  <th width="10%" >UOM</th>
				  <th width="9%" >Color </th>
				  <th width="10%" >Thick </th>
				  </tr>
			</thead>
			<tbody >
<?php
		while ($record_so_detail = mysql_fetch_array($result_product)){
?>
			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="product_detail_raw_product_id[]" id="product_detail_raw_product_id<?php echo $record_so_detail['product_detail_raw_product_id'];?>" value="<?php echo $record_so_detail['product_detail_raw_product_id']; ?>" />
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_detail_raw_product_id'];?>" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_name'])); ?>" >
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_detail_raw_product_id'];?>" value="<?php echo $record_so_detail['product_code']; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['product_detail_raw_product_id'];?>" value="<?php echo $record_so_detail['product_uom_name']; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['product_detail_raw_product_id'];?>" value="<?php echo $record_so_detail['product_colour_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['product_detail_raw_product_id'];?>" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['product_detail_raw_product_id'];?>" value="<?php echo $record_so_detail['product_detail_product_id']; ?>" >
				</td>
				<td><?php echo $record_so_detail['product_code']; ?></td>
				<td><?php echo $record_so_detail['product_name']; ?></td>
				<td><?=$record_so_detail['product_uom_name']?></td>
				<td><?=$record_so_detail['product_colour_name']?></td>
				<td><?=$record_so_detail['product_thick_ness']?></td>
			</tr>
<?php  } ?>
			</tbody>
		</table>
		</form>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$('#raw_product_detail_popup').DataTable( {
					responsive: true
} );
</script>