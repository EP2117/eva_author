  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$m_id = $_GET['m_id'];
	$t_id = $_GET['t_id'];
	

   	if($m_id == '') {

   		$m_id = '""';

   	}

   		$select_product 			= "	SELECT  

											product_code,

											product_name,

											product_uom_name,

											product_colour_name,

											product_thick_ness,

											product_id,
											brand_name,
											product_brand_id,
											product_uom_id

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
												brand_id 												= product_brand_id
										 WHERE 

											product_deleted_status				=	0 											AND

											product_id 							NOT IN (".$m_id.")";

	

	$result_product = mysql_query($select_product);

  

?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#</th>
				  <th width="10%" >Brand</th>
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
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_id'])); ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_name'])); ?>" >

				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_code']; ?>" >
				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['brand_name']; ?>" >
				<input type="hidden" name="product_brand_id" id="product_brand_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_brand_id']; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_uom_name']; ?>" >
				<input type="hidden" name="product_uom_id" id="product_uom_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_uom_id']; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_colour_name']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['product_id'];?>1" value="1" >
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail['product_id'];?>1" value="<?=$t_id?>" >

				</td>
				<td><?php echo $record_so_detail['brand_name']; ?></td>
				<td><?php echo $record_so_detail['product_code']; ?></td>

				<td><?php echo $record_so_detail['product_name']; ?></td>

				<td><?=$record_so_detail['product_uom_name']?></td>

				<td><?=$record_so_detail['product_colour_name']?></td>

				<td><?=$record_so_detail['product_thick_ness']?></td>

			</tr>

<?php  } 
		 /*$query	="SELECT 
		 				product_con_entry_child_product_detail_id,
		 				product_con_entry_child_product_detail_name,
						product_con_entry_child_product_detail_code,
						product_uom_name,
						product_thick_ness,
						product_colour_name
				 FROM 
				 		product_con_entry_child_product_details 
				 LEFT JOIN 
				 		product_uoms 
				 ON 
				 		product_uom_id 											= product_con_entry_child_product_detail_uom_id
				 LEFT JOIN 
						product_colours 
				 ON 
						product_colour_id 										= product_con_entry_child_product_detail_color_id
				 LEFT JOIN 
				 		products 
				 ON 
				 		product_id 												= product_con_entry_child_product_detail_product_id
				 WHERE 
				 		product_con_entry_child_product_detail_deleted_status	= 0 ";
		$result_product = mysql_query($query);
		while ($record_so_detail = mysql_fetch_array($result_product)){
?>

			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="chk_product_id[]" id="chk_product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_id']; ?>2" />
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_id'])); ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_name'])); ?>" >

				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_code']; ?>" >

				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_uom_name']; ?>" >

				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_colour_name']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="2" >
				</td>
				<td><?php echo $record_so_detail['product_con_entry_child_product_detail_code']; ?></td>
				<td><?php echo $record_so_detail['product_con_entry_child_product_detail_name']; ?></td>
				<td><?=$record_so_detail['product_uom_name']?></td>
				<td><?=$record_so_detail['product_colour_name']?></td>
				<td><?=$record_so_detail['product_thick_ness']?></td>

			</tr>

<?php  }*/
 ?>			</tbody>

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