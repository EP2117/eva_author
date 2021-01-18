<?php


	function editQuotation($id){

		$quotation_entry_id 			= getId('quotation_entry', 'quotation_entry_id', 'quotation_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_quotation_entry		=	"SELECT 

												*

											 FROM 

												quotation_entry 
											LEFT JOIN
												customers
											ON
												customer_id						= quotation_entry_customer_id
											 LEFT JOIN
												branches
											 ON
												branch_id		=  quotation_entry_branch_id
											 WHERE 

												quotation_entry_deleted_status 	=  0 			AND 

												quotation_entry_id				= '".$quotation_entry_id."'

											 ORDER BY 

												quotation_entry_no ASC";

		$result_quotation_entry 		= mysql_query($select_quotation_entry);

		$record_quotation_entry 		= mysql_fetch_array($result_quotation_entry);

		return $record_quotation_entry;

	}

	function editQuotationProductDetail($id)

	{

		$quotation_entry_id 	= getId('quotation_entry', 'quotation_entry_id', 'quotation_entry_uniq_id', dataValidation($_GET['id'])); 

	  $select_quotation_entry_product_detail 		= "SELECT 
															A.*,
															product_name,
															p_uom.product_uom_name as p_uom_name,
															product_code,
															
															product_thick_ness,
															quotation_entry_product_detail_product_type,
															p_clr.product_colour_name as p_colour_name,
															brand_name
														FROM 
															quotation_entry_product_details A
														LEFT JOIN 
															products 
														ON 
															product_id 												= quotation_entry_product_detail_product_id
														
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 									= product_purchase_uom_id
														
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 								= quotation_entry_product_detail_product_color_id
														
														LEFT JOIN 
															brands 
														ON 
															brand_id 												= quotation_entry_product_detail_product_brand_id
														WHERE 
															quotation_entry_product_detail_deleted_status		 	= 0 							
															AND quotation_entry_product_detail_mother_child_type=1
															AND quotation_entry_product_detail_quotation_entry_id 		= '".$quotation_entry_id."'";

		$result_quotation_entry_product_detail 	= mysql_query($select_quotation_entry_product_detail);
		$count_quotation_entry 					= mysql_num_rows($result_quotation_entry_product_detail);
		$arr_quotation_entry_product_detail 	= array();
		while($record_quotation_entry_product_detail = mysql_fetch_array($result_quotation_entry_product_detail)) {
			$arr_quotation_entry_product_detail[] = $record_quotation_entry_product_detail;
		}
		 $select_quotation_entry_product_detail1 		= "SELECT 
															A.*,
															child_uom.product_uom_name as p_uom_name,
															quotation_entry_product_detail_product_thick as product_thick_ness,
															quotation_entry_product_detail_product_type,
															product_con_entry_child_product_detail_code as product_code ,
															product_con_entry_child_product_detail_name as product_name,
															product_con_entry_child_product_detail_width_inches,
															product_con_entry_child_product_detail_product_id,
															
															c_clr.product_colour_name as p_colour_name,
															brand_name
														FROM 
															quotation_entry_product_details A
														
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id				= quotation_entry_product_detail_product_id	
														
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
														
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 								= quotation_entry_product_detail_product_color_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 												= quotation_entry_product_detail_product_brand_id
														WHERE 
															quotation_entry_product_detail_deleted_status		 	= 0 
															AND quotation_entry_product_detail_mother_child_type=2 							
															AND  quotation_entry_product_detail_quotation_entry_id 		= '".$quotation_entry_id."'";

		$result_quotation_entry_product_detail1 	= mysql_query($select_quotation_entry_product_detail1);
		$count_quotation_entry1 					= mysql_num_rows($result_quotation_entry_product_detail1);
	
		while($record_quotation_entry_product_detail1 = mysql_fetch_array($result_quotation_entry_product_detail1)) {
			$arr_quotation_entry_product_detail[] = $record_quotation_entry_product_detail1;
		}
		
		return $arr_quotation_entry_product_detail;
	}


?>