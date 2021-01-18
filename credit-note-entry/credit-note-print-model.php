<?php
		function editQuotation(){

		$credit_note_entry_id 			= getId('credit_note_entry', 'credit_note_entry_id', 'credit_note_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_credit_note_entry		=	"SELECT 

												credit_note_entry_uniq_id,  credit_note_entry_date,

												credit_note_entry_production_section_id,credit_note_entry_customer_id,

												credit_note_entry_department_id,credit_note_entry_type,

												credit_note_entry_invoice_entry_id, credit_note_entry_no,

												credit_note_entry_branch_id,credit_note_entry_id,

												customer_billing_address,

												customer_contact_no,customer_name,
												credit_note_entry_type_id 	

											 FROM 

												credit_note_entry 

											LEFT JOIN

												customers

											ON

												customer_id							= 	credit_note_entry_customer_id
												

											 WHERE 

												credit_note_entry_deleted_status 	=  0 			AND 

												credit_note_entry_id				= '".$credit_note_entry_id."'

											 ORDER BY 

												credit_note_entry_no ASC";

		$result_credit_note_entry 		= mysql_query($select_credit_note_entry);

		$record_credit_note_entry 		= mysql_fetch_array($result_credit_note_entry);

		return $record_credit_note_entry;

	}

	function editSalesdetail(){

		$credit_note_entry_id 			= getId('credit_note_entry', 'credit_note_entry_id', 'credit_note_entry_uniq_id', dataValidation($_GET['id'])); 

		$invoice_entry_id 					= getId('credit_note_entry', 'credit_note_entry_invoice_entry_id', 'credit_note_entry_uniq_id', dataValidation($_GET['id'])); 

			$select_credit_note_entry		=	"SELECT 

													invoice_entry_no,

													invoice_entry_date

												 FROM 

													invoice_entry 

												 WHERE 

													invoice_entry_deleted_status 	=  0 						AND 

													invoice_entry_id					= '".$invoice_entry_id."'

												 ORDER BY 

													invoice_entry_no ASC";

		

		$result_credit_note_entry 		= mysql_query($select_credit_note_entry);

		$record_credit_note_entry 		= mysql_fetch_array($result_credit_note_entry);

		return $record_credit_note_entry;

	}

	function editQuotationProductDetail()

	{

		$credit_note_entry_id 	= getId('credit_note_entry', 'credit_note_entry_id', 'credit_note_entry_uniq_id', dataValidation($_GET['id'])); 

		  $select_credit_note_entry_product_detail 	= "	SELECT 
															credit_note_entry_product_detail_id,
															credit_note_entry_product_detail_product_id,
															credit_note_entry_product_detail_width_inches,credit_note_entry_product_detail_width_mm,
															credit_note_entry_product_detail_s_width_inches,credit_note_entry_product_detail_s_width_mm,
															credit_note_entry_product_detail_sl_feet,credit_note_entry_product_detail_sl_feet_in,
															credit_note_entry_product_detail_sl_feet_mm,credit_note_entry_product_detail_s_weight_inches,
															credit_note_entry_product_detail_s_weight_mm,credit_note_entry_product_detail_tot_length,
															credit_note_entry_product_detail_qty,
															product_name,
															product_code,
															credit_note_entry_product_detail_product_thick ,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															p_uom.product_uom_name as p_uom_name,
															child_uom.product_uom_name as c_uom_name,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name,
															credit_note_entry_product_detail_product_type,
															credit_note_entry_product_detail_rate,
															credit_note_entry_product_detail_total,
															credit_note_entry_product_detail_entry_type,
															credit_note_entry_product_detail_sl_feet_met
															
														FROM 
															credit_note_entry_product_details 
														LEFT JOIN 
															invoice_entry_product_details 
														ON 
															invoice_entry_product_detail_id  		    = credit_note_entry_product_detail_invoice_detail_id
														LEFT JOIN 
															quotation_entry_product_details 
														ON 
															quotation_entry_product_detail_id 			= invoice_entry_product_detail_quotation_detail_id
														
														LEFT JOIN 
															products 
														ON 
															product_id 									= credit_note_entry_product_detail_product_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 									= product_brand_id	
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id	= credit_note_entry_product_detail_product_id	
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 						= product_purchase_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 					= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 					= credit_note_entry_product_detail_color_id	
															
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 					= credit_note_entry_product_detail_color_id	
														WHERE 
															credit_note_entry_product_detail_deleted_status		 	= 0 							AND 
															credit_note_entry_product_detail_credit_note_entry_id 		= '".$credit_note_entry_id."'";
		$result_credit_note_entry_product_detail 	= mysql_query($select_credit_note_entry_product_detail);

		$arr_credit_note_entry_product_detail 		= array();
		while($record_credit_note_entry_product_detail = mysql_fetch_array($result_credit_note_entry_product_detail)) {
			$arr_credit_note_entry_product_detail[] = $record_credit_note_entry_product_detail;
		}
		return $arr_credit_note_entry_product_detail;

	}

	
?>