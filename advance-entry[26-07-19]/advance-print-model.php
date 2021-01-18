<?php


	function editQuotation($id){

		$advance_entry_id 			= getId('advance_entry', 'advance_entry_id', 'advance_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_advance_entry		=	"SELECT 

												*

											 FROM 

												advance_entry 
												LEFT JOIN customers ON customer_id =advance_entry_customer_id
												LEFT JOIN
												branches
											 ON
												branch_id		=  advance_entry_branch_id
											 WHERE 

												advance_entry_deleted_status 	=  0 			AND 

												advance_entry_id				= '".$advance_entry_id."'

											 ORDER BY 

												advance_entry_no ASC";

		$result_advance_entry 		= mysql_query($select_advance_entry);

		$record_advance_entry 		= mysql_fetch_array($result_advance_entry);

		return $record_advance_entry;

	}

	function editQuotationProductDetail($id)

	{

		$advance_entry_id 	= getId('advance_entry', 'advance_entry_id', 'advance_entry_uniq_id', dataValidation($_GET['id'])); 

	 $select_advance_entry_product_detail 		= "SELECT 
															A.*,
															product_name,
															p_uom.product_uom_name as p_uom_name,
															product_code,
															child_uom.product_uom_name as c_uom_name,
															product_thick_ness,
															advance_entry_product_detail_product_type,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															product_con_entry_child_product_detail_width_inches,
															product_con_entry_child_product_detail_product_id,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name
														FROM 
															advance_entry_product_details A
														LEFT JOIN 
															products 
														ON 
															product_id 												= advance_entry_product_detail_product_id
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id				= advance_entry_product_detail_product_id	
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 									= product_purchase_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 								= advance_entry_product_detail_product_color_id
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 												= advance_entry_product_detail_product_brand_id
														WHERE 
															advance_entry_product_detail_deleted_status		 	= 0 							AND 
															advance_entry_product_detail_advance_entry_id 		= '".$advance_entry_id."'";

		$result_advance_entry_product_detail 	= mysql_query($select_advance_entry_product_detail);
		$count_advance_entry 					= mysql_num_rows($result_advance_entry_product_detail);
		$arr_advance_entry_product_detail 	= array();
		while($record_advance_entry_product_detail = mysql_fetch_array($result_advance_entry_product_detail)) {
			$arr_advance_entry_product_detail[] = $record_advance_entry_product_detail;
		}
		return $arr_advance_entry_product_detail;
	}

?>