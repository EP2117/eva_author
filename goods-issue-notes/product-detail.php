  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$production_order_id	= $_REQUEST['production_order_id'];
	$t_id					= $_REQUEST['t_id'];
	$m_id = $_GET['m_id'];

	

   	if($m_id == '') {

   		$m_id = '""';

   	}

   		$select_product 			= "	SELECT  
											production_order_no,
											production_order_date,
											production_order_product_detail_id,
											production_order_product_detail_product_id,
											production_order_product_detail_width_inches,production_order_product_detail_width_mm,
											production_order_product_detail_s_width_inches,production_order_product_detail_s_width_mm,
											production_order_product_detail_sl_feet,production_order_product_detail_sl_feet_in,
											production_order_product_detail_sl_feet_mm,production_order_product_detail_sl_feet_met,
											production_order_product_detail_ext_feet,production_order_product_detail_ext_feet_in,
											production_order_product_detail_ext_feet_mm,production_order_product_detail_ext_feet_met,
											production_order_product_detail_s_weight_inches,production_order_product_detail_s_weight_mm,
											production_order_product_detail_tot_feet,production_order_product_detail_tot_meter,
											production_order_product_detail_qty,production_order_product_detail_tot_length,
											production_order_product_detail_product_thick,
											product_name,
											product_is_opp,
											product_code,
											p_uom.product_uom_name as p_uom_name,
											p_clr.product_colour_name as p_colour_name,
											brand_name,
											inv_table.inv_qty AS received_qty,
											production_order_type_id,
											production_order_product_detail_product_type,
											production_order_product_detail_product_color_id,
											product_product_uom_id,
											production_order_product_detail_mother_child_type,
											product_brand_id as product_brand_id,
											production_order_product_detail_po_qty,
											production_order_product_detail_sale_length,
											production_order_product_detail_sale_by,
											production_order_product_detail_sale_feet
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
												gin_entry_product_detail_po_detail_id	, 
												SUM(gin_entry_product_detail_qty+gin_entry_product_detail_s_weight_inches) AS inv_qty 
											FROM 
												gin_entry_product_details  	
											WHERE 
												gin_entry_product_detail_deleted_status 				= 0  					
											GROUP BY 
												gin_entry_product_detail_po_detail_id) inv_table 
										ON 
											 	gin_entry_product_detail_po_detail_id 	= production_order_product_detail_id		
											
										WHERE 
											production_order_product_detail_deleted_status				=	0 											AND
											((production_order_product_detail_po_qty IS NOT NULL && production_order_product_detail_po_qty != 0) OR production_order_product_detail_po_done = 1) AND
											production_order_product_detail_mother_child_type		=	1 	AND
											production_order_product_detail_production_order_id 			IN (".$production_order_id.")				AND 
											production_order_product_detail_id 							NOT IN (".$m_id.") 								AND	
											IFNULL(inv_table.inv_qty,0) < (production_order_product_detail_po_qty+production_order_product_detail_s_weight_inches)			AND	
											production_order_company_id 								= '".$_SESSION[SESS.'_session_company_id']."'	AND
											production_order_product_detail_entry_type					= '".$t_id."' "; //exit;

	
	//echo "1".$select_product; exit;
	$result_product = mysql_query($select_product);

  

?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#<input type="checkbox" name="All_check" id="All_check" class="check_all" onclick="GetCheck()" /></th>

				  <th width="12%" >SO.No</th>

				  <th width="10%" >Date</th>	  

				  <th width="12%" >Code</th>

				  <th width="24%" >Product</th>

				  <th width="10%" >UOM</th>

				  <!--<th width="9%" >SO Qty </th>

				  <th width="10%" >DC Qty </th>

				  <th width="8%" >Balance Qty </th>-->
				  
				  <th width="9%" >PO Qty </th>

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
				<td><?=$record_so_detail['received_qty'];?>
				<input type="checkbox" name="production_order_product_detail_id[]" id="production_order_product_detail_id<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_id']; ?>1"   class="prd_checkbox" />
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >
				
				<input type="hidden" name="product_is_opp" id="product_is_opp<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['product_is_opp']; ?>" >
				<input type="hidden" name="product_sale_by" id="product_sale_by<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_sale_by']; ?>" >
				<input type="hidden" name="product_sale_feet" id="product_sale_feet<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_sale_feet']; ?>" >
				
				
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $product_code; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $product_uom_name; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $product_colour_name; ?>" >
				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_product_color_id']; ?>" >
				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['brand_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $arr_thick[number_format($record_so_detail['production_order_product_detail_product_thick'],0)]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_product_thick']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_s_width_inches" id="product_s_width_inches<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_s_width_mm" id="product_s_width_mm<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_s_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="product_sl_feet<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_sl_feet']; ?>" />

				<input type="hidden" name="product_sl_feet_in" id="product_sl_feet_in<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_sl_feet_in']; ?>" />
				
				<input type="hidden" name="product_sl_feet_mm" id="product_sl_feet_mm<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_sl_feet_mm']; ?>" />
				
				<input type="hidden" name="product_sl_feet_met" id="product_sl_feet_met<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_sl_feet_met']; ?>" />
				
				<input type="hidden" name="product_ext_feet" id="product_ext_feet<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_ext_feet']; ?>" />

				<input type="hidden" name="product_ext_feet_in" id="product_ext_feet_in<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_ext_feet_in']; ?>" />
				
				<input type="hidden" name="product_ext_feet_mm" id="product_ext_feet_mm<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_ext_feet_mm']; ?>" />
				
				<input type="hidden" name="product_ext_feet_met" id="product_ext_feet_met<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_ext_feet_met']; ?>" />
				
				<input type="hidden" name="product_s_weight_inches" id="product_s_weight_inches<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_s_weight_mm" id="product_s_weight_mm<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_s_weight_mm']; ?>" />
				<input type="hidden" name="product_tot_feet" id="product_tot_feet<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_tot_feet']; ?>" />
				<input type="hidden" name="product_tot_meter" id="product_tot_meter<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_tot_meter']; ?>" />
				
				
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_tot_length']; ?>" />

				<!--<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $balance_qty; ?>" />-->
				
				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_po_qty']; ?>" />
				<input type="hidden" name="product_detail_sale_length" id="product_detail_sale_length<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo htmlspecialchars($record_so_detail['production_order_product_detail_sale_length']); ?>" />
				
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $t_id; ?>" />
				<!--<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="3" />-->
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_product_type'];?>" />
				
				<input type="hidden" name="uom_id" id="uom_id<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['product_product_uom_id']; ?>" />
                <input type="hidden" name="mother_child_type" id="mother_child_type<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?=$record_so_detail['production_order_product_detail_mother_child_type']?>" />
                <input type="hidden" name="product_brand_id" id="product_brand_id<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?=$record_so_detail['product_brand_id']?>" />
				</td>
				<td><?=$record_so_detail['production_order_no']?></td>
				<td><?=dateGeneralFormatN($record_so_detail['production_order_date'])?></td>
				<td><?php echo $product_code; ?></td>
				<td><?php echo $product_name; ?></td>
				<td><?=$product_uom_name?></td>
				<!--<td><?=$record_so_detail['production_order_product_detail_qty']?></td>
				<td><?=$record_so_detail['received_qty']?></td>
				<td><?=$balance_qty?></td>-->
				<td><?=$record_so_detail['production_order_product_detail_po_qty']?></td>
			</tr>

<?php  }

$select_product 			= "	SELECT  
											production_order_no,
											production_order_date,
											production_order_product_detail_id,
											production_order_product_detail_product_id,
											production_order_product_detail_width_inches,production_order_product_detail_width_mm,
											production_order_product_detail_s_width_inches,production_order_product_detail_s_width_mm,
											production_order_product_detail_sl_feet,production_order_product_detail_sl_feet_in,
											production_order_product_detail_sl_feet_mm,production_order_product_detail_sl_feet_met,
											production_order_product_detail_ext_feet,production_order_product_detail_ext_feet_in,
											production_order_product_detail_ext_feet_mm,production_order_product_detail_ext_feet_met,
											production_order_product_detail_s_weight_inches,production_order_product_detail_s_weight_mm,
											production_order_product_detail_tot_feet,production_order_product_detail_tot_meter,
											production_order_product_detail_qty,production_order_product_detail_tot_length,
											production_order_product_detail_product_thick,
											product_con_entry_child_product_detail_name,
											product_con_entry_child_product_detail_code,
											p_uom.product_uom_name as p_uom_name,
											p_clr.product_colour_name as p_colour_name,
											brand_name,
											inv_table.inv_qty AS received_qty,
											production_order_type_id,product_con_entry_child_product_detail_color_id,
											production_order_product_detail_product_type,
											production_order_product_detail_product_color_id,
											product_con_entry_child_product_detail_uom_id,
											production_order_product_detail_mother_child_type,
											product_con_entry_child_product_detail_product_brand_id as product_brand_id,
											production_order_product_detail_po_qty,
											production_order_product_detail_sale_length,
											production_order_product_detail_sale_by,
											production_order_product_detail_sale_feet
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

											product_con_entry_child_product_details 
										ON 
											product_con_entry_child_product_detail_id 		= production_order_product_detail_product_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 									= product_con_entry_child_product_detail_product_brand_id
										LEFT JOIN 
											product_uoms as p_uom
										ON 
											p_uom.product_uom_id 						= product_con_entry_child_product_detail_uom_id
										LEFT JOIN 
											product_colours as p_clr 
										ON 
											p_clr.product_colour_id 					= product_con_entry_child_product_detail_color_id
											LEFT JOIN 
											(SELECT 
												gin_entry_product_detail_po_detail_id	, 
												SUM(gin_entry_product_detail_qty+gin_entry_product_detail_s_weight_inches) AS inv_qty 
											FROM 
												gin_entry_product_details  	
											WHERE 
												gin_entry_product_detail_deleted_status 				= 0  					
											GROUP BY 
												gin_entry_product_detail_po_detail_id) inv_table 
										ON 
											 	gin_entry_product_detail_po_detail_id 	= production_order_product_detail_id		
											
										WHERE 
											production_order_product_detail_deleted_status				=	0 											AND
											((production_order_product_detail_po_qty IS NOT NULL && production_order_product_detail_po_qty != 0) OR production_order_product_detail_po_done = 1) AND
											production_order_product_detail_mother_child_type		=	'2' 											AND
											production_order_product_detail_production_order_id 			IN (".$production_order_id.")				AND 
											production_order_product_detail_id 							NOT IN (".$m_id.") 								AND	
											IFNULL(inv_table.inv_qty,0) > (production_order_product_detail_po_qty+production_order_product_detail_s_weight_inches)			AND	
											production_order_company_id 								= '".$_SESSION[SESS.'_session_company_id']."'	AND
											production_order_product_detail_entry_type					= '".$t_id."' "; //exit;

	
	//echo "2".$select_product; exit;
	$result_product = mysql_query($select_product); ?>
    
    <?php

		while ($record_so_detail1 = mysql_fetch_array($result_product)){
			  $balance_qty = $record_so_detail1['production_order_product_detail_qty'] - $record_so_detail1['received_qty'];
					$product_code			= $record_so_detail1['product_con_entry_child_product_detail_code'];
					$product_name			= $record_so_detail1['product_con_entry_child_product_detail_name'];
					$product_uom_name		= $record_so_detail1['p_uom_name'];
					$product_colour_name	= $record_so_detail1['p_colour_name'];
											
?>

			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="production_order_product_detail_id[]" id="production_order_product_detail_id<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_id']; ?>2"   class="prd_checkbox" />
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >
				
				<input type="hidden" name="product_is_opp" id="product_is_opp<?php echo $record_so_detail['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_is_opp']; ?>" >
				<input type="hidden" name="product_sale_by" id="product_sale_by<?php echo $record_so_detail['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail['production_order_product_detail_sale_by']; ?>" >
				<input type="hidden" name="product_sale_feet" id="product_sale_feet<?php echo $record_so_detail['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail['production_order_product_detail_sale_feet']; ?>" >
				
				
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $product_code; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $product_uom_name; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $product_colour_name; ?>" >
				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['product_con_entry_child_product_detail_color_id']; ?>" >
				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['brand_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $arr_thick[number_format($record_so_detail1['production_order_product_detail_product_thick'],0)]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_product_thick']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_s_width_inches" id="product_s_width_inches<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_s_width_mm" id="product_s_width_mm<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_s_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="product_sl_feet<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_sl_feet']; ?>" />

				<input type="hidden" name="product_sl_feet_in" id="product_sl_feet_in<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_sl_feet_in']; ?>" />
				
				<input type="hidden" name="product_sl_feet_mm" id="product_sl_feet_mm<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_sl_feet_mm']; ?>" />
				
				<input type="hidden" name="product_sl_feet_met" id="product_sl_feet_met<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_sl_feet_met']; ?>" />
				
				<input type="hidden" name="product_ext_feet" id="product_ext_feet<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_ext_feet']; ?>" />

				<input type="hidden" name="product_ext_feet_in" id="product_ext_feet_in<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_ext_feet_in']; ?>" />
				
				<input type="hidden" name="product_ext_feet_mm" id="product_ext_feet_mm<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_ext_feet_mm']; ?>" />
				
				<input type="hidden" name="product_ext_feet_met" id="product_ext_feet_met<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_ext_feet_met']; ?>" />
				
				<input type="hidden" name="product_s_weight_inches" id="product_s_weight_inches<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_s_weight_mm" id="product_s_weight_mm<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_s_weight_mm']; ?>" />
				<input type="hidden" name="product_tot_feet" id="product_tot_feet<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_tot_feet']; ?>" />
				<input type="hidden" name="product_tot_meter" id="product_tot_meter<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_tot_meter']; ?>" />
				
				
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['production_order_product_detail_tot_length']; ?>" />

				<!--<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $balance_qty; ?>" />-->
				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo $record_so_detail['production_order_product_detail_po_qty']; ?>" />
				<input type="hidden" name="product_detail_sale_length" id="product_detail_sale_length<?php echo $record_so_detail['production_order_product_detail_id'];?>1" value="<?php echo htmlspecialchars($record_so_detail['production_order_product_detail_sale_length']); ?>" />
				
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $t_id; ?>" />
				<!--<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="3" />-->
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail['production_order_product_detail_product_type'];?>" />
				
				<input type="hidden" name="uom_id" id="uom_id<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?php echo $record_so_detail1['product_con_entry_child_product_detail_uom_id']; ?>" />
                <input type="hidden" name="mother_child_type" id="mother_child_type<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?=$record_so_detail1['production_order_product_detail_mother_child_type']?>" />
                <input type="hidden" name="product_brand_id" id="product_brand_id<?php echo $record_so_detail1['production_order_product_detail_id'];?>2" value="<?=$record_so_detail1['product_brand_id']?>" />
                
				</td>
				<td><?=$record_so_detail1['production_order_no']?></td>
				<td><?=dateGeneralFormatN($record_so_detail1['production_order_date'])?></td>
				<td><?php echo $product_code; ?></td>
				<td><?php echo $product_name; ?></td>
				<td><?=$product_uom_name?></td>
				<!--<td><?=$record_so_detail1['production_order_product_detail_qty']?></td>
				<td><?=$record_so_detail1['received_qty']?></td>
				<td><?=$balance_qty?></td>-->
				
				<td><?=$record_so_detail1['production_order_product_detail_po_qty']?></td>
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
function GetCheck(){
	if(document.getElementById('All_check').checked==true){
		$('.prd_checkbox').each(function(){ this.checked = true; });
	}
	else{
		$('.prd_checkbox').each(function(){ this.checked = false; });
	}
}

</script>


