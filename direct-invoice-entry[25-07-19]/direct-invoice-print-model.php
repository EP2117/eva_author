<?php


	function editInvoice($id){

		//$invoice_entry_id 			= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_invoice_entry		=	"SELECT 
												*,customer_name,customer_billing_address,customer_mobile_no
											 FROM 

												invoice_entry 
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

												invoice_entry_id				= '".$id."'

											 ORDER BY 

												invoice_entry_no ASC";
											//echo	$select_invoice_entry; exit;
		$result_invoice_entry 		= mysql_query($select_invoice_entry);

		$record_invoice_entry 		= mysql_fetch_array($result_invoice_entry);

		return $record_invoice_entry;

	}

	function editInvoiceProductDetail($id)

	{

		//$invoice_entry_id 	= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', dataValidation($_GET['id'])); 

	   $select_invoice_entry_product_detail 		= "SELECT 
															A.*,
															product_name,
															p_uom.product_uom_name as p_uom_name,
															product_code,
															child_uom.product_uom_name as c_uom_name,
															product_thick_ness,
															invoice_entry_product_detail_product_type,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															product_con_entry_child_product_detail_width_inches,
															product_con_entry_child_product_detail_product_id,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name
														FROM 
															invoice_entry_product_details A
														LEFT JOIN 
															products 
														ON 
															product_id 												= invoice_entry_product_detail_product_id
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id				= invoice_entry_product_detail_product_id	
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 									= product_purchase_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 								= product_purchase_uom_id
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 								= invoice_entry_product_detail_color_id
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 								= invoice_entry_product_detail_color_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 												= 	product_brand_id
														WHERE 
															invoice_entry_product_detail_deleted_status		 	= 0 							AND 
															invoice_entry_product_detail_invoice_entry_id 		= '".$id."'";
														//echo	$select_invoice_entry_product_detail; exit;

		$result_quotation_entry_product_detail 	= mysql_query($select_invoice_entry_product_detail);
		$count_quotation_entry 					= mysql_num_rows($result_quotation_entry_product_detail);
		$arr_quotation_entry_product_detail 	= array();
		while($record_quotation_entry_product_detail = mysql_fetch_array($result_quotation_entry_product_detail)) {
			$arr_quotation_entry_product_detail[] = $record_quotation_entry_product_detail;
		}
		return $arr_quotation_entry_product_detail;
	}

	
?>