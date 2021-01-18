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
											production_order_product_detail_id,
											production_order_product_detail_product_id,
											production_order_product_detail_s_width_inches,production_order_product_detail_s_width_mm,
											production_order_product_detail_sl_feet,production_order_product_detail_sl_feet_in,
											production_order_product_detail_sl_feet_mm,production_order_product_detail_sl_feet_met,
											production_order_product_detail_s_weight_inches,production_order_product_detail_s_weight_mm,
											production_order_product_detail_qty,production_order_product_detail_tot_length,
											production_order_product_detail_product_thick,
											product_name,
											product_code,
											p_uom.product_uom_name as p_uom_name,
											p_clr.product_colour_name as p_colour_name,
											brand_name,
											inv_table.inv_qty AS received_qty,
											production_order_type_id,
											production_order_product_detail_product_type,
											production_order_product_detail_product_color_id
										FROM 
											production_order_product_details 
										LEFT JOIN 
											production_order 
										ON 
											production_order_id 							= production_order_product_detail_production_order_id
										LEFT JOIN 
											products 
										ON 
											product_id 									= production_order_product_detail_product_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 									= product_brand_id
										LEFT JOIN 
											product_uoms as p_uom
										ON 
											p_uom.product_uom_id 						= product_purchase_uom_id
										LEFT JOIN 
											product_colours as p_clr 
										ON 
											p_clr.product_colour_id 					= production_order_product_detail_product_color_id
											LEFT JOIN 
											(SELECT 
												stock_transfer_product_detail_po_detail_id	, 
												SUM(stock_transfer_product_detail_qty+stock_transfer_product_detail_weight_tone) AS inv_qty 
											FROM 
												stock_transfer_product_details  	
											WHERE 
												stock_transfer_product_detail_deleted_status 				= 0  					
											GROUP BY 
												stock_transfer_product_detail_po_detail_id	) inv_table 
										ON 
											 	stock_transfer_product_detail_po_detail_id 	= production_order_product_detail_id		
											
										WHERE 
											production_order_product_detail_deleted_status				=	0 											AND
											production_order_product_detail_production_order_id 			IN (".$production_order_id.")							AND 
											production_order_product_detail_id 							NOT IN (".$m_id.") 								AND	
											IFNULL(inv_table.inv_qty,0) 								< (production_order_product_detail_qty+production_order_product_detail_s_weight_inches)			AND	
											production_order_company_id 								= '".$_SESSION[SESS.'_session_company_id']."' ";

	
	//echo $select_product; exit;
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
					$product_code			= $record_so_detail['product_code'];
					$product_name			= $record_so_detail['product_name'];
					$product_uom_name		= $record_so_detail['p_uom_name'];
					$product_colour_name	= $record_so_detail['p_colour_name'];
				
											
?>

			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="production_order_product_detail_id[]" id="production_order_product_detail_id<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_id']; ?>" />
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $product_code; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $product_uom_name; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $product_colour_name; ?>" >
				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_product_color_id']; ?>" >
				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['brand_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $arr_thick[number_format($record_so_detail['production_order_product_detail_product_thick'],0)]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_product_thick']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_product_id']; ?>" >

				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_s_width_mm']; ?>" />
				<input type="hidden" name="product_length_feet" id="product_length_feet<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_sl_feet']; ?>" />
				<input type="hidden" name="product_length_mm" id="product_length_mm<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_sl_feet_met']; ?>" />
				
				
				<input type="hidden" name="product_tone" id="product_tone<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_kg" id="product_kg<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_s_weight_mm']; ?>" />
				
				
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_tot_length']; ?>" />

				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $balance_qty; ?>" />
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_type_id']; ?>" />
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="<?php echo $record_so_detail['production_order_product_detail_product_type']; ?>" />
				<input type="hidden" name="osf_uom_ton" id="osf_uom_ton<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="" >
                <input type="hidden" name="product_mother_child_type" id="product_mother_child_type<?php echo $record_so_detail['production_order_product_detail_id'];?>" value="" >
				
				</td>
				<td><?=$record_so_detail['production_order_no']?></td>
				<td><?=dateGeneralFormatN($record_so_detail['production_order_date'])?></td>
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

