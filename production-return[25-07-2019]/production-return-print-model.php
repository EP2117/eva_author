<?php


	function editQuotation(){

		$prn_entry_id 			= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_pdo_entry		=	"SELECT 

												prn_entry_uniq_id,  prn_entry_no,

												prn_entry_date,prn_entry_from_godown_id,

												prn_entry_to_godown_id,prn_entry_production_section_id,

												prn_entry_production_entry_id, prn_entry_branch_id,
												prn_entry_type_id,prn_entry_id,branch_name,production_section_name

											 FROM 

												prn_entry 
												
											   LEFT JOIN 
													branches 
												ON 
													branch_id 												= prn_entry_branch_id
													
												LEFT JOIN 
												production_sections 
											ON 
												production_section_id 												= prn_entry_production_section_id
											
											
											 WHERE 

												prn_entry_deleted_status 	=  0 			AND 

												prn_entry_id				= '".$prn_entry_id."'

											 ORDER BY 

												prn_entry_no ASC";

		$result_pdo_entry 		= mysql_query($select_pdo_entry);

		$record_pdo_entry 		= mysql_fetch_array($result_pdo_entry);

		return $record_pdo_entry;

	}

	function editSalesdetail(){

		$pdo_entry_id 			= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$production_entry_id 	= getId('prn_entry', 'prn_entry_production_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

			$select_pdo_entry		=	"SELECT 

													production_entry_no,

													production_entry_date,

													production_entry_type

												 FROM 

													production_entry 

												 WHERE 

													production_entry_deleted_status 	=  0 						AND 

													production_entry_id					= '".$production_entry_id."'

												 ORDER BY 

													production_entry_no ASC";

		

		$result_pdo_entry 		= mysql_query($select_pdo_entry);

		$record_pdo_entry 		= mysql_fetch_array($result_pdo_entry);

		return $record_pdo_entry;

	}

	function editQuotationProductDetail()

	{

		$prn_entry_id 	= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id',  dataValidation($_GET['id'])); 

		 $select_pdo_entry_product_detail 	= "	SELECT 
														prn_entry_product_detail_id,
														prn_entry_product_detail_prn_entry_id,
														prn_entry_product_detail_product_id,prn_entry_product_detail_product_colour_id
														prn_entry_product_detail_product_type,prn_entry_product_detail_product_thick,
														prn_entry_product_detail_width_inches,prn_entry_product_detail_width_mm,
														prn_entry_product_detail_s_width_inches,prn_entry_product_detail_s_width_mm,
														prn_entry_product_detail_sl_feet,prn_entry_product_detail_sl_feet_in,
														prn_entry_product_detail_sl_feet_mm,prn_entry_product_detail_sl_feet_met,
														prn_entry_product_detail_ext_feet,prn_entry_product_detail_ext_feet_in,
														prn_entry_product_detail_ext_feet_mm,prn_entry_product_detail_ext_feet_met,
														prn_entry_product_detail_qty,prn_entry_product_detail_tot_length,
														prn_entry_product_detail_sw_check, 
														product_name,
														product_code,
														product_colour_name,
														brand_name,
														product_uom_name,
														prn_entry_product_detail_s_weight_inches,
														prn_entry_product_detail_s_weight_mm,
														prn_entry_product_detail_tot_feet,
														prn_entry_product_detail_tot_meter
													
														
													FROM 
														prn_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= prn_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_brand_id
														
													LEFT JOIN 
														product_uoms
													ON 
														product_uom_id 									= product_product_uom_id
													
													LEFT JOIN 
														product_colours 
													ON 
														product_colour_id 								= prn_entry_product_detail_product_colour_id
														
													WHERE 
														prn_entry_product_detail_deleted_status		 	= 0 							AND 
														prn_entry_product_detail_prn_entry_id 		= '".$prn_entry_id."'";
		//echo $select_pdo_entry_product_detail;exit;
		$result_pdo_entry_product_detail 	= mysql_query($select_pdo_entry_product_detail);
		$count_pdo_entry 					= mysql_num_rows($result_pdo_entry_product_detail);
		$arr_pdo_entry_product_detail 		= array();
		while($record_pdo_entry_product_detail = mysql_fetch_array($result_pdo_entry_product_detail)) {
			$arr_pdo_entry_product_detail[] = $record_pdo_entry_product_detail;
		}
		return $arr_pdo_entry_product_detail;
	}
function editQuotationrawProductDetail()

	{

		$prn_entry_id 	= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id',  dataValidation($_GET['id'])); 

		 $select_pdo_entry_product_detail 	= "	SELECT 
														*
													FROM 
														 prn_entry_raw_product_details 
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id 		= 	prn_entry_raw_product_detail_product_id
													
													LEFT JOIN 
														products 
													ON 
														product_id 		= 	product_con_entry_child_product_detail_product_id
														
													LEFT JOIN 
														brands 
													ON 
														brand_id 		= product_brand_id
														
													LEFT JOIN 
														product_uoms
													ON 
														product_uom_id 									= product_product_uom_id
													
													LEFT JOIN 
														product_colours 
													ON 
														product_colour_id 								= prn_entry_raw_product_detail_product_colour_id
														
													WHERE 
														prn_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														prn_entry_raw_product_detail_prn_entry_id 		= '".$prn_entry_id."'";
		//echo $select_pdo_entry_product_detail;exit;												
		$result_pdo_entry_product_detail 	= mysql_query($select_pdo_entry_product_detail);
		$count_pdo_entry 					= mysql_num_rows($result_pdo_entry_product_detail);
		$arr_pdo_entry_product_detail 		= array();
		while($record_pdo_entry_product_detail = mysql_fetch_array($result_pdo_entry_product_detail)) {
			$arr_pdo_entry_product_detail[] = $record_pdo_entry_product_detail;
		}
		return $arr_pdo_entry_product_detail;
	}
?>