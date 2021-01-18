  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$brand_id = $_GET['brand_id'];
	$m_id = $_GET['m_id'];
	

   	if($m_id == '') {

   		$m_id = '""';

   	}
		$where		= '';
		if($brand_id != '') {
			$where .= " AND product_brand_id = '".$brand_id."'";
		}
   		$select_product 			= "	SELECT  

											product_code,
											product_name,
											product_uom_name,
											product_colour_name,
											product_thick_ness,
											product_id,
											product_inches_qty,
											brand_name

										FROM 
											products 
										LEFT JOIN 
											product_uoms 
										ON 
											product_uom_id 						= product_purchase_uom_id
										LEFT JOIN 
											product_colours 
										ON 
											product_colour_id 					= product_product_colour_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 							= product_brand_id		
										WHERE 

											product_deleted_status				=	0 	 $where";

	

	$result_product = mysql_query($select_product);

  

?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#</th>

				  <th width="12%" >Code</th>

				  <th width="24%" >Product</th>

				  <th width="10%" >UOM</th>

				  <th width="10%" >Color</th>

				  <th width="10%" >Thick</th>

				  </tr>

			</thead>

			<tbody >

<?php

		while ($record_so_detail = mysql_fetch_array($result_product)){

?>

			<tr class="odd gradeX">

				<td>
					<input type="checkbox" name="chk_product_id[]" id="chk_product_id<?php echo $record_so_detail['product_id'];?>" value="<?php echo $record_so_detail['product_id']; ?>1" />
				<input type="hidden" name="product_id[]" id="product_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_id']; ?>" />

				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo ucfirst($record_so_detail['product_name']); ?>" >

				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_code']; ?>" >

				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_uom_name']; ?>" >

				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_colour_name']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['product_id'];?>1" value="1" >
				<input type="hidden" name="product_inches" id="product_inches<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_inches_qty']; ?>" >
<input type="hidden" name="brand_name" id="brand_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['brand_name']; ?>" >
				</td>

				<td><?php echo $record_so_detail['product_code']; ?></td>

				<td><?php echo $record_so_detail['product_name']; ?></td>

				<td><?=$record_so_detail['product_uom_name']?></td>

				<td><?=$record_so_detail['product_colour_name']?></td>

				<td><?=$record_so_detail['product_thick_ness']?></td>

			</tr>

<?php  } 

 ?>
			</tbody>

		</table>

		</form>

<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$('#product_detail_popup').DataTable( {

					responsive: true

} );

</script>