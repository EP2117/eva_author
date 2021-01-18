<?php


	function editQuotation(){

		$production_entry_id 			= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_production_entry		=	"SELECT 

												production_entry_uniq_id,  production_entry_date,

												production_entry_production_type,production_entry_godown_id,

												production_entry_vendor_id,production_entry_type,production_entry_remarks,

												production_entry_grn_entry_id, production_entry_no,

												production_entry_branch_id,production_entry_id,production_entry_grn_date,production_entry_type_id 

											 FROM 

												production_entry 

											 WHERE 

												production_entry_deleted_status 	=  0 			AND 

												production_entry_id				= '".$production_entry_id."'

											 ORDER BY 

												production_entry_no ASC";

		$result_production_entry 		= mysql_query($select_production_entry);

		$record_production_entry 		= mysql_fetch_array($result_production_entry);

		return $record_production_entry;

	}

	function editSalesdetail(){

		$production_entry_id 				= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		$grn_entry_id 				= getId('production_entry', 'production_entry_grn_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

			 $select_production_entry		=	"SELECT 

													grn_entry_no,

													grn_entry_date,

													grn_entry_type,
													
													customer_name,customer_mobile_no,
													
													grn_entry_gin_entry_id,customer_billing_address,
													
												    production_order_customer_id,
													
												    gin_entry_production_order_id,
													
												    production_order_no
													
												 FROM 

													grn_entry 
													
												LEFT JOIN
												gin_entry
												 ON
												gin_entry_id															= grn_entry_gin_entry_id
												
												LEFT JOIN
													
												production_order
													 ON
												production_order_id															= gin_entry_production_order_id	
														
													
												LEFT JOIN
												customers
												 ON
												customer_id															= production_order_customer_id	


												 WHERE 

													grn_entry_deleted_status 	=  0 						AND 

													grn_entry_id					= '".$grn_entry_id."'

												 ORDER BY 

													grn_entry_no ASC";

		

		$result_production_entry 		= mysql_query($select_production_entry);

		$record_production_entry 		= mysql_fetch_array($result_production_entry);

		return $record_production_entry;

	}

	function editQuotationProductDetail()

	{

		$production_entry_id 	= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_production_entry_product_detail 	= "	SELECT 
														production_entry_product_detail_id,
														production_entry_product_detail_product_id,
														production_entry_product_detail_width_inches,production_entry_product_detail_width_mm,
														production_entry_product_detail_s_width_inches,production_entry_product_detail_s_width_mm,
														production_entry_product_detail_sl_feet,production_entry_product_detail_sl_feet_in,
														production_entry_product_detail_sl_feet_mm,production_entry_product_detail_s_weight_inches,
														production_entry_product_detail_s_weight_mm,production_entry_product_detail_tot_length,
														production_entry_product_detail_grn_detail_id,production_entry_product_detail_qty,
														production_entry_product_detail_product_thick,
														product_name,
														product_code,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														p_uom.product_uom_name as p_uom_name,
														child_uom.product_uom_name as c_uom_name,
														p_clr.product_colour_name as p_colour_name,
														c_clr.product_colour_name as c_colour_name,
														brand_name,production_entry_product_detail_product_type,
														production_entry_product_detail_sl_feet_met,
														production_entry_product_detail_ext_feet,
														production_entry_product_detail_ext_feet_in,
														production_entry_product_detail_ext_feet_mm,
														production_entry_product_detail_ext_feet_met,
														production_entry_product_detail_tot_feet,
														production_entry_product_detail_tot_meter 
													FROM 
														production_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= production_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_brand_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= production_entry_product_detail_product_id	
													LEFT JOIN 
														product_uoms as p_uom
													ON 
														p_uom.product_uom_id 									= product_product_uom_id
													LEFT JOIN 
														product_uoms as  child_uom
													ON 
														child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
													LEFT JOIN 
														product_colours as p_clr 
													ON 
														p_clr.product_colour_id 								= production_entry_product_detail_product_colour_id
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= production_entry_product_detail_product_colour_id
														
													WHERE 
														production_entry_product_detail_deleted_status		 	= 0 							AND 
														production_entry_product_detail_production_entry_id 		= '".$production_entry_id."'";
													//	echo $select_production_entry_product_detail; exit;
		$result_production_entry_product_detail 	= mysql_query($select_production_entry_product_detail);
		$count_production_entry 					= mysql_num_rows($result_production_entry_product_detail);
		$arr_production_entry_product_detail 		= array();
		while($record_production_entry_product_detail = mysql_fetch_array($result_production_entry_product_detail)) {
			$arr_production_entry_product_detail[] = $record_production_entry_product_detail;
		}
		return $arr_production_entry_product_detail;
	}

	function editQuotationRawProductDetail()

	{

		$production_entry_id 	= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_production_entry_raw_product_detail 	= "	SELECT 
														production_entry_raw_product_detail_id,
														production_entry_raw_product_detail_product_id,
														production_entry_raw_product_detail_width_inches,production_entry_raw_product_detail_width_mm,
														production_entry_raw_product_detail_product_thick,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														brand_name,
														product_colour_name,
														product_uom_name,
														production_entry_raw_product_detail_product_type,
														production_entry_raw_product_detail_grn_detail_id,
														production_entry_raw_product_detail_kg,
														production_entry_raw_product_detail_ton,
														production_entry_raw_product_detail_sl_feet,
														production_entry_raw_product_detail_sl_feet_mm,
														product_con_entry_osf_uom_ton
													FROM 
														production_entry_raw_product_details 
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= production_entry_raw_product_detail_product_id	
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
														production_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														production_entry_raw_product_detail_production_entry_id 		= '".$production_entry_id."'";
		$result_production_entry_raw_product_detail 	= mysql_query($select_production_entry_raw_product_detail);
		$count_production_entry 					= mysql_num_rows($result_production_entry_raw_product_detail);
		$arr_production_entry_raw_product_detail 		= array();
		while($record_production_entry_raw_product_detail = mysql_fetch_array($result_production_entry_raw_product_detail)) {
			$arr_production_entry_raw_product_detail[] = $record_production_entry_raw_product_detail;
		}
		return $arr_production_entry_raw_product_detail;

	}


	function editQuotationDamProductDetail()

	{

		$production_entry_id 	= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_production_entry_dam_product_detail 	= "	SELECT 

																production_entry_dam_product_detail_id,

																production_entry_dam_product_detail_product_id,

																product_name,

																product_uom_name,

																product_code,

																product_colour_name,

																product_thick_ness,brand_name,
																production_entry_dam_product_detail_width_inches,
																production_entry_dam_product_detail_width_mm,
																production_entry_dam_product_detail_sl_feet,
																production_entry_dam_product_detail_sl_feet_mm,
																production_entry_dam_product_detail_ton,
																production_entry_dam_product_detail_kg,
																product_con_entry_osf_uom_ton,
																product_con_entry_child_product_detail_thick_ness,
																product_con_entry_child_product_detail_color_id,
																product_con_entry_child_product_detail_code,
																product_con_entry_child_product_detail_name

															FROM 

																production_entry_dam_product_details 
															LEFT JOIN 
																product_con_entry_child_product_details 
															ON 
																product_con_entry_child_product_detail_id			= production_entry_dam_product_detail_product_id
															LEFT JOIN 

																products 

															ON 

																product_id 											= production_entry_dam_product_detail_product_id
																
																LEFT JOIN 

																	brands 
	
																ON 
	
																	brand_id										=product_brand_id

															LEFT JOIN 

																product_uoms 

															ON 

																product_uom_id 										= product_product_uom_id

															LEFT JOIN 

																product_colours 

															ON 

																product_colour_id 										= product_con_entry_child_product_detail_color_id

															WHERE 

																production_entry_dam_product_detail_deleted_status		= 0 							AND 

																production_entry_dam_product_detail_production_entry_id 		= '".$production_entry_id."'";

		$result_production_entry_dam_product_detail 	= mysql_query($select_production_entry_dam_product_detail);

		$count_production_entry 					= mysql_num_rows($result_production_entry_dam_product_detail);

		$arr_production_entry_dam_product_detail 	= array();

		

		while($record_production_entry_dam_product_detail = mysql_fetch_array($result_production_entry_dam_product_detail)) {

			$arr_production_entry_dam_product_detail[] = $record_production_entry_dam_product_detail;

		}

		return $arr_production_entry_dam_product_detail;

	}

	

	function editWorkDetail()

	{

		$production_entry_id 	= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_production_entry_work_detail 	= "	SELECT 

															*	

														FROM 

															production_entry_work_details 
															
															LEFT JOIN production_sections ON production_section_id = production_entry_work_detail_production_section_id
															
															LEFT JOIN production_machines ON production_machine_id = production_entry_work_detail_production_machine_id
															
															LEFT JOIN employees ON employee_id = production_entry_work_detail_employee_id

														WHERE 

															production_entry_work_detail_deleted_status		= 0 							AND 

															production_entry_work_detail_production_entry_id 		= '".$production_entry_id."'";

		$result_production_entry_work_detail 	= mysql_query($select_production_entry_work_detail);

		$count_production_entry 					= mysql_num_rows($result_production_entry_work_detail);

		$arr_production_entry_work_detail 	= array();

		

		while($record_production_entry_work_detail = mysql_fetch_array($result_production_entry_work_detail)) {

			$arr_production_entry_work_detail[] = $record_production_entry_work_detail;

		}

		return $arr_production_entry_work_detail;

	}

?>