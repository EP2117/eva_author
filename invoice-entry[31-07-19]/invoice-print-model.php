<?php
	function editQuotation($id){

		$invoice_entry_id 			= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_invoice_entry		=	"SELECT 

												invoice_entry_uniq_id,  invoice_entry_date,
												invoice_entry_customer_id,invoice_entry_validity_date,
												invoice_entry_credit_days,invoice_entry_due_date,
												invoice_entry_godown_id,invoice_entry_salesman_id,
												invoice_entry_gross_amount,invoice_entry_transport_amount,
												invoice_entry_tax_per,invoice_entry_tax_amount,
												invoice_entry_advance_amount,invoice_entry_net_amount,
												invoice_entry_no,invoice_entry_type_id,
												invoice_entry_branch_id,invoice_entry_id,
												quotation_entry_no,quotation_entry_date,
												advance_entry_no,advance_entry_date,
												invoice_entry_quotation_entry_id,invoice_entry_type,
												invoice_entry_prd_type,invoice_entry_remark,customer_name,
												customer_billing_address,customer_mobile_no,salesman_name,
												invoice_entry_remark, invoice_entry_tax_status,
												branch_prefix,invoice_entry_total_amount

											 FROM 

												invoice_entry

											LEFT JOIN

												quotation_entry

											ON

												quotation_entry_id				= invoice_entry_quotation_entry_id  AND  invoice_entry_type = '1'
											LEFT JOIN

												advance_entry

											ON

												advance_entry_id				= invoice_entry_quotation_entry_id  AND  invoice_entry_type = '2'
											LEFT JOIN
												customers
											ON
												customer_id						= invoice_entry_customer_id  
											LEFT JOIN
												salesmans
											ON
												salesman_id						= invoice_entry_salesman_id 
											LEFT JOIN
												branches
											 ON
												branch_id		=  invoice_entry_branch_id	 
											 WHERE 

												invoice_entry_deleted_status 	=  0 			AND 

												invoice_entry_id				= '".$invoice_entry_id."'

											 ORDER BY 

												invoice_entry_no ASC";

		$result_invoice_entry 		= mysql_query($select_invoice_entry);

		$record_invoice_entry 		= mysql_fetch_array($result_invoice_entry);

		return $record_invoice_entry;

	}

	function editQuotationProductDetail($id)
	{
		$invoice_entry_id 						= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', dataValidation($_GET['id'])); 
		 $select_invoice_entry_product_detail 	= "	SELECT 
														invoice_entry_product_detail_id,
														invoice_entry_product_detail_product_id,
														invoice_entry_product_detail_width_inches,invoice_entry_product_detail_width_mm,
														invoice_entry_product_detail_s_width_inches,invoice_entry_product_detail_s_width_mm,
														invoice_entry_product_detail_sl_feet,invoice_entry_product_detail_sl_feet_in,
														invoice_entry_product_detail_sl_feet_mm,invoice_entry_product_detail_s_weight_inches,
														invoice_entry_product_detail_s_weight_mm,invoice_entry_product_detail_tot_length,
														invoice_entry_product_detail_rate,invoice_entry_product_detail_quotation_detail_id,
														invoice_entry_product_detail_total,invoice_entry_product_detail_qty,
														invoice_entry_product_detail_product_thick,invoice_entry_product_detail_sl_feet_met,
														product_name,invoice_entry_product_detail_s_weight_met,
														product_code,
														p_uom.product_uom_name as p_uom_name,
														
														p_clr.product_colour_name as p_colour_name,
														
														brand_name,invoice_entry_product_detail_product_type,
														invoice_entry_product_detail_entry_type ,
														brand_name,
														invoice_entry_product_detail_mother_child_type
													FROM 
														invoice_entry_product_details 
													LEFT JOIN 
														quotation_entry_product_details 
													ON 
														quotation_entry_product_detail_id 		= invoice_entry_product_detail_quotation_detail_id
													LEFT JOIN 
														products 
													ON 
														product_id 								= invoice_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 								= product_brand_id
													LEFT JOIN 
														product_uoms as p_uom
													ON 
														p_uom.product_uom_id 									= product_purchase_uom_id
													
													LEFT JOIN 
														product_colours as p_clr 
													ON 
														p_clr.product_colour_id 								= invoice_entry_product_detail_color_id
													
														
													WHERE 
														invoice_entry_product_detail_deleted_status		 	= 0 							AND 
														invoice_entry_product_detail_mother_child_type		= 1								AND 
														invoice_entry_product_detail_invoice_entry_id 		= '".$invoice_entry_id."'";
		$result_invoice_entry_product_detail 	= mysql_query($select_invoice_entry_product_detail);
		$count_invoice_entry 					= mysql_num_rows($result_invoice_entry_product_detail);
		$arr_invoice_entry_product_detail 		= array();
		while($record_invoice_entry_product_detail = mysql_fetch_array($result_invoice_entry_product_detail)) {
			$arr_invoice_entry_product_detail[] = $record_invoice_entry_product_detail;
		}
		 $select_invoice_entry_product_detail1 	= "	SELECT 
														invoice_entry_product_detail_id,
														invoice_entry_product_detail_product_id,
														invoice_entry_product_detail_width_inches,invoice_entry_product_detail_width_mm,
														invoice_entry_product_detail_s_width_inches,invoice_entry_product_detail_s_width_mm,
														invoice_entry_product_detail_sl_feet,invoice_entry_product_detail_sl_feet_in,
														invoice_entry_product_detail_sl_feet_mm,invoice_entry_product_detail_s_weight_inches,
														invoice_entry_product_detail_s_weight_mm,invoice_entry_product_detail_tot_length,
														invoice_entry_product_detail_rate,invoice_entry_product_detail_quotation_detail_id,
														invoice_entry_product_detail_total,invoice_entry_product_detail_qty,
														invoice_entry_product_detail_product_thick,invoice_entry_product_detail_sl_feet_met,
														invoice_entry_product_detail_s_weight_met,
														product_con_entry_child_product_detail_code as product_code,
														product_con_entry_child_product_detail_name as product_name,
														
														child_uom.product_uom_name as p_uom_name,
														
														c_clr.product_colour_name as p_colour_name,
														brand_name,invoice_entry_product_detail_product_type,
														invoice_entry_product_detail_entry_type ,
														brand_name,
														invoice_entry_product_detail_mother_child_type
													FROM 
														invoice_entry_product_details 
													LEFT JOIN 
														quotation_entry_product_details 
													ON 
														quotation_entry_product_detail_id 		= invoice_entry_product_detail_quotation_detail_id
													
													
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= invoice_entry_product_detail_product_id	
													
													LEFT JOIN 
														product_uoms as  child_uom
													ON 
														child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
													
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= invoice_entry_product_detail_color_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 								= product_con_entry_child_product_detail_product_brand_id
														
													WHERE 
														invoice_entry_product_detail_deleted_status		 	= 0 							AND 
														invoice_entry_product_detail_mother_child_type		=2								AND 
														invoice_entry_product_detail_invoice_entry_id 		= '".$invoice_entry_id."'";
		$result_invoice_entry_product_detail1 	= mysql_query($select_invoice_entry_product_detail1);
		$count_invoice_entry1 					= mysql_num_rows($result_invoice_entry_product_detail1);
		
		while($record_invoice_entry_product_detail1 = mysql_fetch_array($result_invoice_entry_product_detail1)) {
			$arr_invoice_entry_product_detail[] = $record_invoice_entry_product_detail1;
		}
		
		return $arr_invoice_entry_product_detail;
	}
	
?>