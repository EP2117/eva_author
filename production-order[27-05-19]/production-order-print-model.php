<?php
	function editQuotation(){

		$production_order_id 			= getId('production_order', 'production_order_id', 'production_order_uniq_id', dataValidation($_GET['id'])); 

	 	$select_production_order		=	"SELECT 

												production_order_uniq_id,  production_order_date,

												production_order_production_section_id,

												production_order_department_id,production_order_type,

												 production_order_no,production_order_type_id,

												production_order_branch_id,production_order_id,production_section_name,
												production_order_sw_check,production_order_order_type,branch_name

											 FROM 

												production_order 
												
												LEFT JOIN 
												 branches 
												ON 
												 branch_id 												= production_order_branch_id	
															 
											 LEFT JOIN 
											 production_sections 
										      ON 
											 production_section_id 												= production_order_production_section_id	
											
											 WHERE 

												production_order_deleted_status 	=  0 			AND 

												production_order_id				= '".$production_order_id."'

											 ORDER BY 

												production_order_no ASC";//exit;

		$result_production_order 		= mysql_query($select_production_order);

		$record_production_order 		= mysql_fetch_array($result_production_order);

		return $record_production_order;

	}

	function editQuotationProductDetail()

	{

		$production_order_id 	= getId('production_order', 'production_order_id', 'production_order_uniq_id', dataValidation($_GET['id'])); 

		 $select_production_order_product_detail 	= "	SELECT 
															production_order_product_detail_id,
															production_order_product_detail_product_id,
															production_order_product_detail_width_inches,
															production_order_product_detail_width_mm,
															production_order_product_detail_invoice_detail_id,
															production_order_product_detail_invoice_entry_id,
															production_order_product_detail_product_id,
															production_order_product_detail_product_type,
															production_order_product_detail_product_thick,
															production_order_product_detail_width_inches,
															production_order_product_detail_width_mm,
															production_order_product_detail_s_width_inches,
															production_order_product_detail_s_width_mm,
															production_order_product_detail_sl_feet_met,
															production_order_product_detail_ext_feet,
															production_order_product_detail_ext_feet_in,
															production_order_product_detail_ext_feet_mm,
															production_order_product_detail_ext_feet_met,
															production_order_product_detail_sl_feet_in,
															production_order_product_detail_sl_feet,
															production_order_product_detail_sl_feet_mm,
															production_order_product_detail_s_weight_inches,
															production_order_product_detail_s_weight_mm,
															production_order_product_detail_tot_length,
															production_order_product_detail_qty,
															production_order_product_detail_tot_feet,
															production_order_product_detail_tot_meter,
															product_thick_ness,
															product_name,
															p_uom.product_uom_name as p_uom_name,
															product_code,
															brand_name,
															p_colour.product_colour_name as p_colour_nam,
															production_order_product_detail_entry_type,
															production_order_product_detail_product_color_id
															
														FROM 
															production_order_product_details 
														LEFT JOIN 
															products 
														ON 
															product_id 												= production_order_product_detail_product_id
														LEFT JOIN 
															 brands 
														ON 
															 brand_id 												= product_brand_id	
														
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 									= product_product_uom_id
														
														LEFT JOIN 
															product_colours  as p_colour
														ON 
															p_colour.product_colour_id 								= production_order_product_detail_product_color_id
														
														WHERE 

															production_order_product_detail_deleted_status		 	= 0 							AND 

															production_order_product_detail_production_order_id 		= '".$production_order_id."'";

		$result_production_order_product_detail 	= mysql_query($select_production_order_product_detail);

		$count_production_order 					= mysql_num_rows($result_production_order_product_detail);

		$arr_production_order_product_detail 	= array();

		

		while($record_production_order_product_detail = mysql_fetch_array($result_production_order_product_detail)) {

			$arr_production_order_product_detail[] = $record_production_order_product_detail;

		}

		return $arr_production_order_product_detail;

	}
	
	function editQuotationrawProductDetail()

	{

		$production_order_id 	= getId('production_order', 'production_order_id', 'production_order_uniq_id', dataValidation($_GET['id'])); 

		  $select_production_order_product_detail 	= "	SELECT 
															production_order_raw_product_detail_id,
															production_order_raw_product_detail_uniq_id,
															production_order_raw_product_detail_production_order_id,
															production_order_raw_product_detail_product_color_id,
															production_order_raw_product_detail_product_type,
															production_order_raw_product_detail_product_thick,
															production_order_raw_product_detail_width_inches,
															production_order_raw_product_detail_width_mm,
															production_order_raw_product_detail_sl_feet,
															production_order_raw_product_detail_sl_feet_in,
															production_order_raw_product_detail_sl_feet_mm,
															production_order_raw_product_detail_sl_feet_met,
															production_order_raw_product_detail_ext_feet,
															production_order_raw_product_detail_ext_feet_in,
															production_order_raw_product_detail_ext_feet_mm,
															production_order_raw_product_detail_ext_feet_met,
															production_order_raw_product_detail_tot_length,
															production_order_raw_product_detail_qty,
															product_name,
															p_uom.product_uom_name as p_uom_name,
															product_code,
															brand_name,
															p_colour.product_colour_name as p_colour_nam
															
														FROM 
															production_order_raw_product_details 
														LEFT JOIN 
															products 
														ON 
															product_id 												= production_order_raw_product_detail_product_id
														LEFT JOIN 
															 brands 
														ON 
															 brand_id 												= 	product_brand_id	
														
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 									= product_purchase_uom_id
														
														LEFT JOIN 
															product_colours  as p_colour
														ON 
															p_colour.product_colour_id 								= production_order_raw_product_detail_product_color_id
														
														WHERE 

															production_order_raw_product_detail_deleted_status		 	= 0 							AND 

															production_order_raw_product_detail_production_order_id 		= '".$production_order_id."'";

		$result_production_order_product_detail 	= mysql_query($select_production_order_product_detail);

		$count_production_order 					= mysql_num_rows($result_production_order_product_detail);

		$arr_production_order_product_detail 	= array();

		

		while($record_production_order_product_detail = mysql_fetch_array($result_production_order_product_detail)) {

			$arr_production_order_product_detail[] = $record_production_order_product_detail;

		}

		return $arr_production_order_product_detail;

	}

?>