  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$production_order_id	= $_REQUEST['production_order_id'];

	$m_id = $_GET['m_id'];

	

   	if($m_id == '') {

   		$m_id = '""';

   	}

   		$select_product 			= "	SELECT  

											production_order_no,
											production_order_date,
											product_code, 
											product_name,
											production_order_product_detail_qty,
											production_order_product_detail_id,
											production_order_product_detail_product_id,
											product_thick_ness,
											production_order_product_detail_length_feet,production_order_product_detail_length_inches,
											production_order_product_detail_length_mm,production_order_product_detail_length_meter,
											production_order_product_detail_type,
											product_con_entry_child_product_detail_code,
											product_con_entry_child_product_detail_name,
											p_uom.product_uom_name as p_uom_name,
											child_uom.product_uom_name as c_uom_name,
											p_clr.product_colour_name as p_colour_name,
											c_clr.product_colour_name as c_colour_name,
											production_order_product_detail_id,
											inv_table.inv_qty AS received_qty
										FROM 
											production_order_product_details 
										LEFT JOIN 
											production_order 
										ON 
											production_order_id 						= production_order_product_detail_production_order_id
										LEFT JOIN 
											products 
										ON 
											product_id 							= production_order_product_detail_product_id
										LEFT JOIN 
											product_con_entry_child_product_details 
										ON 
											product_con_entry_child_product_detail_id					= production_order_product_detail_product_id	
										LEFT JOIN 
											product_uoms as p_uom
										ON 
											p_uom.product_uom_id 										= product_product_uom_id
										LEFT JOIN 
											product_uoms as  child_uom
										ON 
											child_uom.product_uom_id 									= product_con_entry_child_product_detail_uom_id
										LEFT JOIN 
											product_colours as p_clr 
										ON 
											p_clr.product_colour_id 									= product_product_colour_id
											
										LEFT JOIN 
											product_colours as c_clr 
										ON 
											c_clr.product_colour_id 									= product_con_entry_child_product_detail_color_id
										LEFT JOIN 
											(SELECT 
												do_god_entry_product_detail_production_detail_id, 
												SUM(do_god_entry_product_detail_qty) AS inv_qty 
											FROM 
												do_god_entry_product_details  	
											WHERE 
												do_god_entry_product_detail_deleted_status 				= 0  					
											GROUP BY 
												do_god_entry_product_detail_production_detail_id) inv_table 
										ON 
											do_god_entry_product_detail_production_detail_id 				= production_order_product_detail_id	
										WHERE 
											production_order_product_detail_deleted_status		=	0 											AND
											production_order_product_detail_production_order_id IN (".$production_order_id.")			AND 
											production_order_product_detail_id 					NOT IN (".$m_id.") 								AND	
											IFNULL(inv_table.inv_qty,0) 							< production_order_product_detail_qty			AND
											production_order_company_id 						= '".$_SESSION[SESS.'_session_company_id']."' ";//exit;

	

	$result_product = mysql_query($select_product);

  

?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#</th>

				  <th width="12%" >SO.No</th>

				  <th width="10%" >Date</th>	  

				  <th width="12%" >Code</th>

				  <th width="24%" >Product</th>

				  <th width="10%" >UOM</th>

				  <th width="9%" >SO Qty </th>

				  <th width="10%" >DC Qty </th>

				  <th width="8%" >Balance Qty </th>

				  </tr>

			</thead>

			<tbody >

<?php

		while ($record_so_detail = mysql_fetch_array($result_product)){

			  $balance_qty = $record_so_detail['production_order_product_detail_qty'] - $record_so_detail['received_qty'];
				if($record_so_detail['production_order_product_detail_type']==1){
					$product_code			= $record_so_detail['product_code'];
					$product_name			= $record_so_detail['product_name'];
					$product_uom_name		= $record_so_detail['p_uom_name'];
					$product_colour_name	= $record_so_detail['p_colour_name'];
				}
				else{
					$product_code			= $record_so_detail['product_con_entry_child_product_detail_code'];
					$product_name			= $record_so_detail['product_con_entry_child_product_detail_name'];
					$product_uom_name		= $record_so_detail['c_uom_name'];
					$product_colour_name	= $record_so_detail['c_colour_name'];
				}
?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" name="production_order_product_detail_id[]" id="production_order_product_detail_id<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_id']; ?>" />

				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >

				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $product_code; ?>" >

				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $product_uom_name; ?>" >

				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $product_colour_name; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >

				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_product_id']; ?>" >

				<input type="hidden" name="production_order_product_detail_length_feet" id="production_order_product_detail_length_feet<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_length_feet']; ?>" />

				<input type="hidden" name="production_order_product_detail_length_inches" id="production_order_product_detail_length_inches<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_length_inches']; ?>" />

				<input type="hidden" name="production_order_product_detail_length_mm" id="production_order_product_detail_length_mm<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_length_mm']; ?>" />

				<input type="hidden" name="production_order_product_detail_length_meter" id="production_order_product_detail_length_meter<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_length_meter']; ?>" />
				<input type="hidden" name="production_order_product_detail_type" id="production_order_product_detail_type<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_type']; ?>" />
				

				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $balance_qty; ?>" />

				</td>

				<td><?=$record_so_detail['production_order_no']?></td>

				<td><?=dateGeneralFormat($record_so_detail['production_order_date'])?></td>

				<td><?php echo $product_code; ?></td>

				<td><?php echo $product_name; ?></td>

				<td><?=$product_uom_name?></td>

				<td><?=$record_so_detail['production_order_product_detail_qty']?></td>

				<td><?=$record_so_detail['received_qty']?></td>

				<td><?=$balance_qty?></td>

			</tr>

<?php  } ?>

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

