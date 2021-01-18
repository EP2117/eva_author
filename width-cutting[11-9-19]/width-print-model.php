<?php

	function editQuotation(){
		$width_cutting_id 			= getId('width_cutting', 'width_cutting_id', 'width_cutting_uniq_id', dataValidation($_GET['id'])); 
		$select_width_cutting		=	"SELECT 
												width_cutting_uniq_id,  width_cutting_date,
												width_cutting_godown_id,width_cutting_type,
												width_cutting_no,
												width_cutting_branch_id,width_cutting_id,
												width_cutting_sw_check,branch_name,godown_name
											 FROM 
												width_cutting 
												LEFT JOIN 
												branches 
												ON 
												branch_id 										= width_cutting_branch_id
												LEFT JOIN 
												godowns 
												ON 
												godown_id 										= width_cutting_godown_id
												
											 WHERE 
												width_cutting_deleted_status 	=  0 							AND 
												width_cutting_id				= '".$width_cutting_id."'
											 ORDER BY 
												width_cutting_no ASC";

		$result_width_cutting 		= mysql_query($select_width_cutting);

		$record_width_cutting 		= mysql_fetch_array($result_width_cutting);

		return $record_width_cutting;

	}

	function editQuotationProductDetail()
	{

		$width_cutting_id 	= getId('width_cutting', 'width_cutting_id', 'width_cutting_uniq_id', dataValidation($_GET['id'])); 
		 $select_width_cutting_product_detail 	= "	SELECT 
															width_cutting_product_detail_id,
															width_cutting_product_detail_product_id,
															width_cutting_product_detail_width_inches,
															width_cutting_product_detail_width_mm,
															width_cutting_product_detail_length_feet,
															width_cutting_product_detail_length_mm,
															width_cutting_product_detail_qty,
															product_con_entry_child_product_detail_name as product_name,
															product_uom_name,
															product_con_entry_child_product_detail_code as product_code,
															product_colour_name,
															product_con_entry_child_product_detail_thick_ness as product_thick_ness,
															brand_name,
															product_con_entry_child_product_detail_product_brand_id,
															product_con_entry_child_product_detail_color_id,
															product_con_entry_osf_uom_ton
														FROM 
															width_cutting_product_details 
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id 		= width_cutting_product_detail_product_id
														LEFT JOIN 
															product_uoms 
														ON 
															product_uom_id 									= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours 
														ON 
															product_colour_id 								= product_con_entry_child_product_detail_color_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 										= product_con_entry_child_product_detail_product_brand_id
														WHERE 
															width_cutting_product_detail_deleted_status		 	= 0 							AND 
															width_cutting_product_detail_width_cutting_id 		= '".$width_cutting_id."'";
		$result_width_cutting_product_detail 	= mysql_query($select_width_cutting_product_detail);

		$count_width_cutting 					= mysql_num_rows($result_width_cutting_product_detail);

		$arr_width_cutting_product_detail 	= array();

		

		while($record_width_cutting_product_detail = mysql_fetch_array($result_width_cutting_product_detail)) {

			$arr_width_cutting_product_detail[] = $record_width_cutting_product_detail;

		}

		return $arr_width_cutting_product_detail;

	}
	function editWidthDetail(){
		$width_cutting_id 	= getId('width_cutting', 'width_cutting_id', 'width_cutting_uniq_id', dataValidation($_GET['id'])); 
		$select_width_cutting_width_detail 	= "	SELECT 
															width_cutting_width_detail_id,
															width_cutting_width_detail_product_id,
															width_cutting_width_detail_width_inches_one,
															width_cutting_width_detail_width_inches_two,
															width_cutting_width_detail_width_inches_three,
															width_cutting_width_detail_width_inches_four,
															width_cutting_width_detail_inches_qty,
															width_cutting_width_detail_length,
															width_cutting_width_detail_length_qty,
															width_cutting_width_detail_name,
															width_cutting_width_detail_width_mm_one ,				
															width_cutting_width_detail_width_mm_two ,				
															width_cutting_width_detail_width_mm_three, 				
															width_cutting_width_detail_width_mm_four 				
														FROM 
															width_cutting_width_details 
														WHERE 
															width_cutting_width_detail_deleted_status		 	= 0 							AND 
															width_cutting_width_detail_width_cutting_id 		= '".$width_cutting_id."'";

		$result_width_cutting_width_detail 	= mysql_query($select_width_cutting_width_detail);
		$count_width_cutting 					= mysql_num_rows($result_width_cutting_width_detail);
		$arr_width_cutting_width_detail 	= array();
		while($record_width_cutting_width_detail = mysql_fetch_array($result_width_cutting_width_detail)) {
			$arr_width_cutting_width_detail[] = $record_width_cutting_width_detail;
		}
		return $arr_width_cutting_width_detail;
	}
	function editChildProductDetail()
	{

		$width_cutting_id 	= getId('width_cutting', 'width_cutting_id', 'width_cutting_uniq_id', dataValidation($_GET['id'])); 

		$select_product_con_entry_child_product_detail 	= "	SELECT 

															product_con_entry_child_product_detail_id,
															product_con_entry_child_product_detail_product_id,
															product_con_entry_child_product_detail_width_inches,product_con_entry_child_product_detail_width_mm,
															product_con_entry_child_product_detail_length_mm,product_con_entry_child_product_detail_length_feet,
															product_con_entry_child_product_detail_total,
															product_con_entry_child_product_detail_name,
															product_uom_name,
															product_con_entry_child_product_detail_code,
															product_colour_name,
															product_con_entry_child_product_detail_uom_id,
															product_con_entry_child_product_detail_color_id,
															product_con_entry_child_product_detail_thick_ness,
															brand_name

														FROM 
															product_con_entry_child_product_details 
														LEFT JOIN 
															product_uoms 
														ON 
															product_uom_id 							= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours 
														ON 
															product_colour_id 						= product_con_entry_child_product_detail_color_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 								= product_con_entry_child_product_detail_product_brand_id	
														WHERE 
															product_con_entry_child_product_detail_deleted_status		 		= 0 							AND 
															product_con_entry_child_product_detail_type		 					= 2 							AND 
															product_con_entry_child_product_detail_product_con_entry_id 		= '".$width_cutting_id."'		AND
															product_con_entry_child_product_detail_entry_type					= 'width-cutting'";

		$result_product_con_entry_product_detail 	= mysql_query($select_product_con_entry_child_product_detail);

		$count_product_con_entry 					= mysql_num_rows($result_product_con_entry_product_detail);

		$arr_product_con_entry_product_detail 	= array();

		

		while($record_product_con_entry_product_detail = mysql_fetch_array($result_product_con_entry_product_detail)) {

			$arr_product_con_entry_product_detail[] = $record_product_con_entry_product_detail;

		}

		return $arr_product_con_entry_product_detail;

	}
?>