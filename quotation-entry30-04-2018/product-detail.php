<link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');
	$m_id = $_GET['m_id'];
   	if($m_id == '') {
   		$m_id = '""';
   	}
	$t_id = $_GET['t_id'];
	
	
?>
		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#</th>

				  <th width="12%" >Code</th>
				 <th width="12%" >Brand name</th>
				  <th width="12%" >Product</th>

				  <th width="10%" >UOM</th>

				 <th width="5%" >Entry</th>

				  </tr>

			</thead>

			<tbody >


<?php
   		$select_product 			= "SELECT  

											product_code,

											product_name,

											product_uom_name,

											product_colour_name,

											product_thick_ness,

											product_id,
											product_inches_qty,product_purchase_uom_id,brand_name,
											product_brand_id,
											product_colour_id,
											product_mm_qty,
											product_inches_qty,
											product_feet_qty

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

											product_deleted_status				=	0 											AND
											product_id 							NOT IN (".$m_id.")";

	$result_product = mysql_query($select_product);

  

?>

<?php

		while ($record_so_detail = mysql_fetch_array($result_product)){

?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" class="check_prd_id" name="chk_product_id[]" id="chk_product_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_id']; ?>1" />

				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_id'])); ?>" >

				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_name'])); ?>" >

				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_code']; ?>" >

				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['brand_name']; ?>" >

				<input type="hidden" name="product_brand_id" id="product_brand_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_brand_id']; ?>" >

				<input type="hidden" name="product_uom_id" id="product_uom_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_purchase_uom_id']; ?>" >

				<input type="hidden" name="product_uom_name" id="product_uom_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_uom_name']; ?>" >

				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_colour_name']; ?>" >

				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_colour_id']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >

				<input type="hidden" name="product_thick_ness_val" id="product_thick_ness_val<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >

				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['product_id'];?>1" value="1" >

				<input type="hidden" name="product_inches" id="product_inches<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_inches_qty']; ?>" >

				<input type="hidden" name="product_inches_mm" id="product_inches_mm<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $record_so_detail['product_mm_qty']; ?>" >

				<input type="hidden" name="mas_product_id" id="mas_product_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_id'])); ?>" >
				<input type="hidden" name="product_t_id" id="product_t_id<?php echo $record_so_detail['product_id'];?>1" value="<?php echo $t_id; ?>" >
				</td>

				<td><?php echo $record_so_detail['product_code']; ?></td>
				<td><?php echo $record_so_detail['brand_name']; ?></td>

				<td><?php echo $record_so_detail['product_name']; ?></td>

				<td><?=$record_so_detail['product_uom_name']?></td>

				<td><input type="text" name="count_product_id" style="width:70px;"  id="count_product_id<?php echo $record_so_detail['product_id'];?>1" value="1" ></td>	

			</tr>

<?php  }

	?>
<?php 
 /*if($t_id == 1 || $t_id == 2 || $t_id == 3 )	{ 
			$select_product 			= "SELECT  
											product_con_entry_child_product_detail_id,
											product_con_entry_child_product_detail_name,
											product_con_entry_child_product_detail_code,
											product_uom_name,product_con_entry_child_product_detail_uom_id,
											product_colour_name,product_con_entry_child_product_detail_color_id,
											product_con_entry_child_product_detail_thick_ness,
											product_con_entry_child_product_detail_width_inches,product_con_entry_child_product_detail_width_mm,
											product_con_entry_child_product_detail_length_mm,product_con_entry_child_product_detail_length_feet,
											product_con_entry_child_product_detail_ton_qty,
											product_con_entry_child_product_detail_kg_qty,
											product_con_entry_child_product_detail_product_id,brand_name,brand_id,
											product_con_entry_child_product_detail_color_id, product_colour_name
										FROM 

											product_con_entry_child_product_details 

										LEFT JOIN 
											products 
										ON 
											product_id 							= product_con_entry_child_product_detail_product_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 							= product_brand_id
										LEFT JOIN 
											product_uoms 
										ON 
											product_uom_id 						= product_con_entry_child_product_detail_uom_id

										LEFT JOIN 

											product_colours 

										ON 

											product_colour_id 					= product_con_entry_child_product_detail_color_id 

										WHERE 

											product_deleted_status				=	0 											AND

											product_id 							NOT IN (".$m_id.")";

	$result_product = mysql_query($select_product);

  

?>



<?php

		while ($record_so_detail = mysql_fetch_array($result_product)){

?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" name="chk_product_id[]" id="chk_product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_id']; ?>2" />
				
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_id'])); ?>" >
				
				<input type="hidden" name="mas_product_id" id="mas_product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_product_id'])); ?>" >
				
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_name'])); ?>" >
				
				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['brand_name'])); ?>" >
				<input type="hidden" name="product_brand_id" id="product_brand_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['brand_id'])); ?>" >
				
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_code']; ?>" >

				<input type="hidden" name="product_uom_name" id="product_uom_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_uom_name']; ?>" >
				
				<input type="hidden" name="product_uom_id" id="product_uom_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_uom_id']; ?>" >

				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_colour_name']; ?>" >
				
				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_color_id']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_thick_ness']; ?>" >
				
				<input type="hidden" name="product_thick_ness_val" id="product_thick_ness_val<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $arr_thick[$record_so_detail['product_con_entry_child_product_detail_thick_ness']]; ?>" >
				
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="2" >
				
				<input type="hidden" name="product_inches" id="product_inches<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_width_inches']; ?>" >
				
				<input type="hidden" name="product_inches_mm" id="product_inches_mm<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_width_mm']; ?>" >

				</td>

				<td><?php echo $record_so_detail['product_con_entry_child_product_detail_code']; ?></td>
				
				<td><?php echo $record_so_detail['brand_name']; ?></td>

				<td><?php echo $record_so_detail['product_con_entry_child_product_detail_name']; ?></td>

				<td><?=$record_so_detail['product_uom_name']?></td>

				<td><?=$record_so_detail['product_colour_name']?></td>

				<td><?=$record_so_detail['product_con_entry_child_product_detail_thick_ness']?></td>

				<td><?=$record_so_detail['product_con_entry_child_product_detail_width_inches']?></td>

				<td><?=$record_so_detail['product_con_entry_child_product_detail_length_feet']?></td>
				<td><input type="text" name="count_product_id" style="width:70px;"  id="count_product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="1" ></td>
			
			</tr>

<?php  }

	?>
	

<?php } */?>

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
$('#product_detail_popup_other').DataTable( {

					responsive: true

} );

</script>