<?php

	function insertQuotation(){

		$gin_entry_branch_id                   			= trim($_POST['gin_entry_branch_id']);
		$gin_entry_date                 				= NdateDatabaseFormat($_POST['gin_entry_date']);
		$gin_entry_production_section_id            	= trim($_POST['gin_entry_production_section_id']);
		$gin_entry_from_godown_id          				= trim($_POST['gin_entry_from_godown_id']);
		$gin_entry_to_godown_id      					= trim($_POST['gin_entry_to_godown_id']);
		$gin_entry_type     							= trim($_POST['gin_entry_type']);
		$gin_entry_type_id     							= trim($_POST['gin_entry_type_id']);
		$gin_entry_production_order_id     				= trim($_POST['gin_entry_production_order_id']);

		//Product Detail
		$gin_entry_product_detail_product_type      = $_POST['gin_entry_product_detail_product_type'];
		$gin_entry_product_detail_po_detail_id     	= $_POST['gin_entry_product_detail_po_detail_id'];
		$gin_entry_product_detail_product_id     	= $_POST['gin_entry_product_detail_product_id'];
		$gin_entry_product_detail_product_color_id 	= $_POST['gin_entry_product_detail_product_color_id'];
		$gin_entry_product_detail_product_thick  	= isset($_POST['gin_entry_product_detail_product_thick'])?$_POST['gin_entry_product_detail_product_thick']:'';
		$gin_entry_product_detail_width_inches  	= isset($_POST['gin_entry_product_detail_width_inches'])?$_POST['gin_entry_product_detail_width_inches']:'';
		$gin_entry_product_detail_width_mm 		  	= isset($_POST['gin_entry_product_detail_width_mm'])?$_POST['gin_entry_product_detail_width_mm']:'';
		$gin_entry_product_detail_s_width_inches 	= isset($_POST['gin_entry_product_detail_s_width_inches'])?$_POST['gin_entry_product_detail_s_width_inches']:'';
		$gin_entry_product_detail_s_width_mm 		= isset($_POST['gin_entry_product_detail_s_width_mm'])?$_POST['gin_entry_product_detail_s_width_mm']:'';
		$gin_entry_product_detail_sl_feet 		  	= isset($_POST['gin_entry_product_detail_sl_feet'])?$_POST['gin_entry_product_detail_sl_feet']:'';
		$gin_entry_product_detail_sl_feet_in 		= isset($_POST['gin_entry_product_detail_sl_feet_in'])?$_POST['gin_entry_product_detail_sl_feet_in']:'';
		$gin_entry_product_detail_sl_feet_mm 		= isset($_POST['gin_entry_product_detail_sl_feet_mm'])?$_POST['gin_entry_product_detail_sl_feet_mm']:'';
		$gin_entry_product_detail_sl_feet_met 		= isset($_POST['gin_entry_product_detail_sl_feet_met'])?$_POST['gin_entry_product_detail_sl_feet_met']:'';
		$gin_entry_product_detail_ext_feet 		  	= isset($_POST['gin_entry_product_detail_ext_feet'])?$_POST['gin_entry_product_detail_ext_feet']:'';
		$gin_entry_product_detail_ext_feet_in 		= isset($_POST['gin_entry_product_detail_ext_feet_in'])?$_POST['gin_entry_product_detail_ext_feet_in']:'';
		$gin_entry_product_detail_ext_feet_mm 		= isset($_POST['gin_entry_product_detail_ext_feet_mm'])?$_POST['gin_entry_product_detail_ext_feet_mm']:'';
		$gin_entry_product_detail_ext_feet_met 		= isset($_POST['gin_entry_product_detail_ext_feet_met'])?$_POST['gin_entry_product_detail_ext_feet_met']:'';
		$gin_entry_product_detail_s_weight_inches   = isset($_POST['gin_entry_product_detail_s_weight_inches'])?$_POST['gin_entry_product_detail_s_weight_inches']:'';
		$gin_entry_product_detail_s_weight_mm   	= isset($_POST['gin_entry_product_detail_s_weight_mm'])?$_POST['gin_entry_product_detail_s_weight_mm']:'';
		$gin_entry_product_detail_qty 			  	= $_POST['gin_entry_product_detail_qty'];
		$gin_entry_product_detail_tot_length 		= isset($_POST['gin_entry_product_detail_tot_length'])?$_POST['gin_entry_product_detail_tot_length']:'';
		$gin_entry_product_detail_tot_feet 			= isset($_POST['gin_entry_product_detail_tot_feet'])?$_POST['gin_entry_product_detail_tot_feet']:'';
		$gin_entry_product_detail_tot_meter 		= isset($_POST['gin_entry_product_detail_tot_meter'])?$_POST['gin_entry_product_detail_tot_meter']:'';
		$gin_entry_product_detail_mother_child_type 		= ($_POST['gin_entry_product_detail_mother_child_type']);

		$gin_entry_raw_product_detail_product_type      = $_POST['gin_entry_raw_product_detail_product_type'];
		$gin_entry_raw_product_detail_product_id     	= $_POST['gin_entry_raw_product_detail_product_id'];
		$gin_entry_raw_product_detail_product_color_id 	= $_POST['gin_entry_raw_product_detail_product_color_id'];
		$gin_entry_raw_product_detail_product_thick  	= isset($_POST['gin_entry_raw_product_detail_product_thick'])?$_POST['gin_entry_raw_product_detail_product_thick']:'';
		$gin_entry_raw_product_detail_width_inches  	= isset($_POST['gin_entry_raw_product_detail_width_inches'])?$_POST['gin_entry_raw_product_detail_width_inches']:'';
		$gin_entry_raw_product_detail_width_mm 		  	= isset($_POST['gin_entry_raw_product_detail_width_mm'])?$_POST['gin_entry_raw_product_detail_width_mm']:'';
		$gin_entry_raw_product_detail_sl_feet 		  	= isset($_POST['gin_entry_raw_product_detail_sl_feet'])?$_POST['gin_entry_raw_product_detail_sl_feet']:'';
		$gin_entry_raw_product_detail_sl_feet_mm 		= isset($_POST['gin_entry_raw_product_detail_sl_feet_mm'])?$_POST['gin_entry_raw_product_detail_sl_feet_mm']:'';
		$gin_entry_raw_product_detail_ton 		  		= isset($_POST['gin_entry_raw_product_detail_ton'])?$_POST['gin_entry_raw_product_detail_ton']:'';
		$gin_entry_raw_product_detail_kg 				= isset($_POST['gin_entry_raw_product_detail_kg'])?$_POST['gin_entry_raw_product_detail_kg']:'';
		$gin_entry_raw_product_detail_mother_child_type = ($_POST['gin_entry_raw_product_detail_mother_child_type']);
		

		

		$request_fields 									= ((!empty($gin_entry_branch_id)) && (!empty($gin_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "goods-issue-notes/index.php?page=add&msg=5");

		$gin_entry_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();

		

		$select_gin_entry_no						= "SELECT 

																	MAX(gin_entry_no) AS maxval 

															   FROM 

																	gin_entry 

															   WHERE 

																	gin_entry_deleted_status 	= 0 												AND

																	gin_entry_status				= '1'												AND

																	gin_entry_branch_id 		= '".$gin_entry_branch_id."'						AND

																	gin_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND

																	gin_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_gin_entry_no 						= mysql_query($select_gin_entry_no);

		$record_gin_entry_no 						= mysql_fetch_array($result_gin_entry_no);	

		$maxval 											= $record_gin_entry_no['maxval']; 

		if($maxval > 0) {

			$gin_entry_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$gin_entry_no 							= substr(('00000'.++$maxval),-5);

		}

		

		

		$insert_gin_entry 					= sprintf("INSERT INTO gin_entry  (gin_entry_uniq_id, gin_entry_date,

																					  		  gin_entry_production_section_id,gin_entry_from_godown_id,

																					   		  gin_entry_to_godown_id,gin_entry_type,

																					   		  gin_entry_production_order_id, gin_entry_no,

																					  		  gin_entry_branch_id,gin_entry_added_by,

																					   		  gin_entry_added_on,gin_entry_added_ip,

																			   		   		  gin_entry_company_id,gin_entry_financial_year,
																							  gin_entry_type_id) 

																			VALUES 	 		 ('%s', '%s', 

																							  '%d', '%d', 

																							  '%d', '%d',

																							  '%d', '%s',

																							  '%d', '%d', 

																							   UNIX_TIMESTAMP(NOW()),

																							  '%s', '%d', '%d', '%d' )", 

																		  	   		   		 $gin_entry_uniq_id, $gin_entry_date,

																					   		 $gin_entry_production_section_id,$gin_entry_from_godown_id,

																					   		 $gin_entry_to_godown_id,$gin_entry_type,

																					   		 $gin_entry_production_order_id,$gin_entry_no,

																					   		 $gin_entry_branch_id,$_SESSION[SESS.'_session_user_id'],

																			   		     	$ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							$gin_entry_type_id);  

		mysql_query($insert_gin_entry);

		//echo $insert_gin_entry; exit;

		$gin_entry_id 						= mysql_insert_id(); 

		

		

		for($i = 0; $i < count($gin_entry_product_detail_product_id); $i++) { 
		// echo $gin_entry_product_detail_product_color_id[$i]; exit;
			$detail_request_fields 							= 	((!empty($gin_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$gin_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_gin_entry_product_detail 		= sprintf("INSERT INTO gin_entry_product_details 
																				(gin_entry_product_detail_uniq_id,gin_entry_product_detail_gin_entry_id,
																				 gin_entry_product_detail_po_detail_id,gin_entry_product_detail_po_entry_id,
																				 gin_entry_product_detail_product_id,gin_entry_product_detail_product_color_id,
																				 gin_entry_product_detail_product_type, gin_entry_product_detail_product_thick,
																				 gin_entry_product_detail_width_inches,gin_entry_product_detail_width_mm,
																				 gin_entry_product_detail_s_width_inches,gin_entry_product_detail_s_width_mm,
																				 gin_entry_product_detail_sl_feet,gin_entry_product_detail_sl_feet_in,
																				 gin_entry_product_detail_sl_feet_mm,gin_entry_product_detail_sl_feet_met,
																				 gin_entry_product_detail_ext_feet,gin_entry_product_detail_ext_feet_in,
																				 gin_entry_product_detail_ext_feet_mm,gin_entry_product_detail_ext_feet_met,
																				 gin_entry_product_detail_s_weight_inches,gin_entry_product_detail_s_weight_mm,
																				 gin_entry_product_detail_qty,gin_entry_product_detail_tot_length,
																				 gin_entry_product_detail_tot_feet,gin_entry_product_detail_tot_meter,
																				 gin_entry_product_detail_added_by, gin_entry_product_detail_added_on,
																				 gin_entry_product_detail_added_ip,gin_entry_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' ,'%d')", 
																		 $gin_entry_product_detail_uniq_id,$gin_entry_id,
																		 $gin_entry_product_detail_po_detail_id[$i],$gin_entry_production_order_id,
																		 $gin_entry_product_detail_product_id[$i],$gin_entry_product_detail_product_color_id[$i],
																		 $gin_entry_product_detail_product_type[$i], $gin_entry_product_detail_product_thick[$i],
																		 $gin_entry_product_detail_width_inches[$i],$gin_entry_product_detail_width_mm[$i],
																		 $gin_entry_product_detail_s_width_inches[$i],$gin_entry_product_detail_s_width_mm[$i],
																		 $gin_entry_product_detail_sl_feet[$i],$gin_entry_product_detail_sl_feet_in[$i],
																		 $gin_entry_product_detail_sl_feet_mm[$i],$gin_entry_product_detail_sl_feet_met[$i],
																		 $gin_entry_product_detail_ext_feet[$i],$gin_entry_product_detail_ext_feet_in[$i],
																		 $gin_entry_product_detail_ext_feet_mm[$i],$gin_entry_product_detail_ext_feet_met[$i],
																		 $gin_entry_product_detail_s_weight_inches[$i],$gin_entry_product_detail_s_weight_mm[$i],
																		 $gin_entry_product_detail_qty[$i],$gin_entry_product_detail_tot_length[$i],
																		 $gin_entry_product_detail_tot_feet[$i],$gin_entry_product_detail_tot_meter[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$gin_entry_product_detail_mother_child_type[$i]);
																		 //echo $insert_gin_entry_product_detail; exit;
				mysql_query($insert_gin_entry_product_detail);
			}
		}
		

		// purchase order pproduct details

		// echo $gin_entry_raw_product_detail_qty[$i]; exit;

		for($i = 0; $i < count($gin_entry_raw_product_detail_product_id); $i++) {  
		// echo $gin_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($gin_entry_raw_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$gin_entry_raw_product_detail_uniq_id 	= generateUniqId();
				 $insert_gin_entry_raw_product_detail 		= sprintf("INSERT INTO gin_entry_raw_product_details 
																				(gin_entry_raw_product_detail_uniq_id,gin_entry_raw_product_detail_gin_entry_id,
																				 gin_entry_raw_product_detail_product_id,gin_entry_raw_product_detail_product_color_id,
																				 gin_entry_raw_product_detail_product_type, gin_entry_raw_product_detail_product_thick,
																				 gin_entry_raw_product_detail_width_inches,gin_entry_raw_product_detail_width_mm,
																				 gin_entry_raw_product_detail_sl_feet,gin_entry_raw_product_detail_sl_feet_mm,
																				 gin_entry_raw_product_detail_ton,gin_entry_raw_product_detail_kg,
																				 gin_entry_raw_product_detail_added_by, gin_entry_raw_product_detail_added_on,
																				 gin_entry_raw_product_detail_added_ip,gin_entry_raw_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' , '%d')", 
																		 $gin_entry_raw_product_detail_uniq_id,$gin_entry_id,
																		 $gin_entry_raw_product_detail_product_id[$i], $gin_entry_raw_product_detail_product_color_id[$i],
																		 $gin_entry_raw_product_detail_product_type[$i], $gin_entry_raw_product_detail_product_thick[$i],
																		 $gin_entry_raw_product_detail_width_inches[$i],$gin_entry_raw_product_detail_width_mm[$i],
																		 $gin_entry_raw_product_detail_sl_feet[$i],$gin_entry_raw_product_detail_sl_feet_mm[$i],
																		 $gin_entry_raw_product_detail_ton[$i],$gin_entry_raw_product_detail_kg[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$gin_entry_raw_product_detail_mother_child_type[$i]);
				mysql_query($insert_gin_entry_raw_product_detail);
			}
		}
		pageRedirection("goods-issue-notes/index.php?page=add&msg=1");
		
	}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND gin_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND gin_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		
		$select_gin_entry		=	"SELECT 

												gin_entry_id,

												gin_entry_uniq_id,

												gin_entry_no,

												gin_entry_date,

												gin_entry_from_godown_id,

												production_section_name,

												gin_entry_type,
												customer_name,production_order_type,
												production_order_no

											 FROM 

												gin_entry

											 LEFT JOIN

												production_sections

											 ON

												production_section_id		=  gin_entry_production_section_id
											LEFT JOIN

												production_order

											 ON

												production_order_id		=  gin_entry_production_order_id
											 LEFT JOIN
												customers
											 ON
												customer_id															= production_order_customer_id	

											 WHERE 

												gin_entry_deleted_status 	= 	0									AND

												gin_entry_status				= '1' 	$where

											 ORDER BY 

												gin_entry_no ASC";

		$result_gin_entry		= mysql_query($select_gin_entry);

		// Filling up the array

		$gin_entry_data 		= array();

		while ($record_gin_entry = mysql_fetch_array($result_gin_entry))

		{

		 $gin_entry_data[] 	= $record_gin_entry;

		}

		return $gin_entry_data;

	}

	function editQuotation(){

		$gin_entry_id 			= getId('gin_entry', 'gin_entry_id', 'gin_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_gin_entry		=	"SELECT 

												gin_entry_uniq_id,  gin_entry_date,

												gin_entry_production_section_id,gin_entry_from_godown_id,

												gin_entry_to_godown_id,gin_entry_type,

												gin_entry_production_order_id, gin_entry_no,

												gin_entry_branch_id,gin_entry_id,branch_name,
												gin_entry_type_id,from_godown.godown_name AS godown_name, to_godown.godown_name as godown_name_to

											 FROM 

												gin_entry 
												
												LEFT JOIN branches ON branch_id = gin_entry_branch_id
												
												LEFT JOIN godowns from_godown ON from_godown.godown_id = gin_entry_from_godown_id
												
												LEFT JOIN godowns to_godown ON to_godown.godown_id = gin_entry_to_godown_id 

											 WHERE 

												gin_entry_deleted_status 	=  0 			AND 

												gin_entry_id				= '".$gin_entry_id."'

											 ORDER BY 

												gin_entry_no ASC";
												//echo $select_gin_entry;exit;

		$result_gin_entry 		= mysql_query($select_gin_entry);

		$record_gin_entry 		= mysql_fetch_array($result_gin_entry);

		return $record_gin_entry;

	}

	function editSalesdetail(){

		$gin_entry_id 			= getId('gin_entry', 'gin_entry_id', 'gin_entry_uniq_id', dataValidation($_GET['id'])); 

		$production_order_id 	= getId('gin_entry', 'gin_entry_production_order_id', 'gin_entry_uniq_id', dataValidation($_GET['id'])); 

			$select_gin_entry		=	"SELECT 

													production_order_no,

													production_order_date,

													production_order_type,
													
													customer_name
												 FROM 

													production_order 
													LEFT JOIN
														customers
													 ON
														customer_id															= production_order_customer_id	

												 WHERE 

													production_order_deleted_status 	=  0 						AND 

													production_order_id					= '".$production_order_id."'

												 ORDER BY 

													production_order_no ASC";

		

		$result_gin_entry 		= mysql_query($select_gin_entry);

		$record_gin_entry 		= mysql_fetch_array($result_gin_entry);

		return $record_gin_entry;

	}

	function editQuotationProductDetail()

	{

		$gin_entry_id 	= getId('gin_entry', 'gin_entry_id', 'gin_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_gin_entry_product_detail 	= "	SELECT 
														gin_entry_product_detail_id,
														gin_entry_product_detail_product_id,
														gin_entry_product_detail_width_inches,gin_entry_product_detail_width_mm,
														gin_entry_product_detail_s_width_inches,gin_entry_product_detail_s_width_mm,
														gin_entry_product_detail_sl_feet,gin_entry_product_detail_sl_feet_in,
														gin_entry_product_detail_sl_feet_mm,gin_entry_product_detail_s_weight_inches,
														gin_entry_product_detail_s_weight_mm,gin_entry_product_detail_tot_length,
														gin_entry_product_detail_po_detail_id,gin_entry_product_detail_qty,
														gin_entry_product_detail_product_thick,gin_entry_product_detail_tot_feet,
														product_name,gin_entry_product_detail_tot_meter,
														product_code,
														p_uom.product_uom_name as uom_name,
														p_clr.product_colour_name as colour_name,
														brand_name,gin_entry_product_detail_product_type,
														gin_entry_product_detail_sl_feet_met,
														gin_entry_product_detail_ext_feet,
														gin_entry_product_detail_ext_feet_in,
														gin_entry_product_detail_ext_feet_mm,
														gin_entry_product_detail_ext_feet_met ,
														gin_entry_product_detail_product_color_id,
														gin_entry_product_detail_mother_child_type,
														product_product_uom_id as uom_id,
														product_brand_id as product_brand_id
													FROM 
														gin_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= gin_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_brand_id
													
													LEFT JOIN 
														product_uoms as p_uom
													ON 
														p_uom.product_uom_id 									= product_product_uom_id
													
													LEFT JOIN 
														product_colours as p_clr 
													ON 
														p_clr.product_colour_id 								= gin_entry_product_detail_product_color_id
													WHERE 
														gin_entry_product_detail_deleted_status		 	= 0 							AND 
														gin_entry_product_detail_mother_child_type		=1		AND
														gin_entry_product_detail_gin_entry_id 		= '".$gin_entry_id."'";
														
													//echo $select_gin_entry_product_detail;exit;
		$result_gin_entry_product_detail 	= mysql_query($select_gin_entry_product_detail);
		$count_gin_entry 					= mysql_num_rows($result_gin_entry_product_detail);
		$arr_gin_entry_product_detail 		= array();
		while($record_gin_entry_product_detail = mysql_fetch_array($result_gin_entry_product_detail)) {
			$arr_gin_entry_product_detail[] = $record_gin_entry_product_detail;
		}
		
		$select_gin_entry_product_detail1 	= "	SELECT 
														gin_entry_product_detail_id,
														gin_entry_product_detail_product_id,
														gin_entry_product_detail_width_inches,gin_entry_product_detail_width_mm,
														gin_entry_product_detail_s_width_inches,gin_entry_product_detail_s_width_mm,
														gin_entry_product_detail_sl_feet,gin_entry_product_detail_sl_feet_in,
														gin_entry_product_detail_sl_feet_mm,gin_entry_product_detail_s_weight_inches,
														gin_entry_product_detail_s_weight_mm,gin_entry_product_detail_tot_length,
														gin_entry_product_detail_po_detail_id,gin_entry_product_detail_qty,
														gin_entry_product_detail_product_thick,gin_entry_product_detail_tot_feet,
														gin_entry_product_detail_tot_meter,
														product_con_entry_child_product_detail_code as product_code,
														product_con_entry_child_product_detail_name as product_name,
														child_uom.product_uom_name as uom_name,
														c_clr.product_colour_name as colour_name,
														brand_name,gin_entry_product_detail_product_type,
														gin_entry_product_detail_sl_feet_met,
														gin_entry_product_detail_ext_feet,
														gin_entry_product_detail_ext_feet_in,
														gin_entry_product_detail_ext_feet_mm,
														gin_entry_product_detail_ext_feet_met ,
														gin_entry_product_detail_product_color_id,
														gin_entry_product_detail_mother_child_type,
														product_con_entry_child_product_detail_uom_id as uom_id
													FROM 
														gin_entry_product_details 
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= gin_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_con_entry_child_product_detail_product_brand_id
														
													LEFT JOIN 
														product_uoms as child_uom
													ON 
														child_uom.product_uom_id 									= product_con_entry_child_product_detail_uom_id
													
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= gin_entry_product_detail_product_color_id
														
													WHERE 
														gin_entry_product_detail_deleted_status		 	= 0 							AND 
														gin_entry_product_detail_mother_child_type		=2		AND
														gin_entry_product_detail_gin_entry_id 		= '".$gin_entry_id."'";
														
											//echo $select_gin_entry_product_detail1;exit;
		$result_gin_entry_product_detail1 	= mysql_query($select_gin_entry_product_detail1);
		$count_gin_entry1 					= mysql_num_rows($result_gin_entry_product_detail1);
	
		while($record_gin_entry_product_detail1 = mysql_fetch_array($result_gin_entry_product_detail1)) {
			$arr_gin_entry_product_detail[] = $record_gin_entry_product_detail1;
		}
		return $arr_gin_entry_product_detail;

	}

	function editQuotationRawProductDetail()

	{

		$gin_entry_id 	= getId('gin_entry', 'gin_entry_id', 'gin_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_gin_entry_raw_product_detail 	= "	SELECT 
														gin_entry_raw_product_detail_id,
														gin_entry_raw_product_detail_product_id,
														gin_entry_raw_product_detail_width_inches,gin_entry_raw_product_detail_width_mm,
														gin_entry_raw_product_detail_sl_feet,
														gin_entry_raw_product_detail_sl_feet_mm,
														gin_entry_raw_product_detail_product_thick,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														brand_name,gin_entry_raw_product_detail_ton,
														gin_entry_raw_product_detail_kg,
														product_colour_name,
														product_uom_name,
														gin_entry_raw_product_detail_product_type,
														product_con_entry_osf_uom_ton	 
													FROM 
														gin_entry_raw_product_details 
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= gin_entry_raw_product_detail_product_id		
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
														gin_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														gin_entry_raw_product_detail_gin_entry_id 		= '".$gin_entry_id."'";
		$result_gin_entry_raw_product_detail 	= mysql_query($select_gin_entry_raw_product_detail);
		$count_gin_entry 					= mysql_num_rows($result_gin_entry_raw_product_detail);
		$arr_gin_entry_raw_product_detail 		= array();
		while($record_gin_entry_raw_product_detail = mysql_fetch_array($result_gin_entry_raw_product_detail)) {
			$arr_gin_entry_raw_product_detail[] = $record_gin_entry_raw_product_detail;
		}
		return $arr_gin_entry_raw_product_detail;

	}



	function updateQuotation(){

		$gin_entry_id                   						= trim($_POST['gin_entry_id']);

		$gin_entry_uniq_id                						= trim($_POST['gin_entry_uniq_id']);

		$gin_entry_branch_id                   			= trim($_POST['gin_entry_branch_id']);

		$gin_entry_date                 				= NdateDatabaseFormat($_POST['gin_entry_date']);

		$gin_entry_production_section_id            	= trim($_POST['gin_entry_production_section_id']);

		$gin_entry_from_godown_id          				= trim($_POST['gin_entry_from_godown_id']);

		$gin_entry_to_godown_id      					= trim($_POST['gin_entry_to_godown_id']);

		$gin_entry_type     							= trim($_POST['gin_entry_type']);

		$gin_entry_production_order_id     				= trim($_POST['gin_entry_production_order_id']);

		

		//Product Detail
		$gin_entry_product_detail_id     			= $_POST['gin_entry_product_detail_id'];
		$gin_entry_product_detail_product_type      = $_POST['gin_entry_product_detail_product_type'];
		$gin_entry_product_detail_po_detail_id     	= $_POST['gin_entry_product_detail_po_detail_id'];
		$gin_entry_product_detail_product_id     	= $_POST['gin_entry_product_detail_product_id'];
		$gin_entry_product_detail_product_color_id 	= $_POST['gin_entry_product_detail_product_color_id'];
		$gin_entry_product_detail_product_thick  	= isset($_POST['gin_entry_product_detail_product_thick'])?$_POST['gin_entry_product_detail_product_thick']:'';
		$gin_entry_product_detail_width_inches  	= isset($_POST['gin_entry_product_detail_width_inches'])?$_POST['gin_entry_product_detail_width_inches']:'';
		$gin_entry_product_detail_width_mm 		  	= isset($_POST['gin_entry_product_detail_width_mm'])?$_POST['gin_entry_product_detail_width_mm']:'';
		$gin_entry_product_detail_s_width_inches 	= isset($_POST['gin_entry_product_detail_s_width_inches'])?$_POST['gin_entry_product_detail_s_width_inches']:'';
		$gin_entry_product_detail_s_width_mm 		= isset($_POST['gin_entry_product_detail_s_width_mm'])?$_POST['gin_entry_product_detail_s_width_mm']:'';
		$gin_entry_product_detail_sl_feet 		  	= isset($_POST['gin_entry_product_detail_sl_feet'])?$_POST['gin_entry_product_detail_sl_feet']:'';
		$gin_entry_product_detail_sl_feet_in 		= isset($_POST['gin_entry_product_detail_sl_feet_in'])?$_POST['gin_entry_product_detail_sl_feet_in']:'';
		$gin_entry_product_detail_sl_feet_mm 		= isset($_POST['gin_entry_product_detail_sl_feet_mm'])?$_POST['gin_entry_product_detail_sl_feet_mm']:'';
		$gin_entry_product_detail_sl_feet_met 		= isset($_POST['gin_entry_product_detail_sl_feet_met'])?$_POST['gin_entry_product_detail_sl_feet_met']:'';
		$gin_entry_product_detail_ext_feet 		  	= isset($_POST['gin_entry_product_detail_ext_feet'])?$_POST['gin_entry_product_detail_ext_feet']:'';
		$gin_entry_product_detail_ext_feet_in 		= isset($_POST['gin_entry_product_detail_ext_feet_in'])?$_POST['gin_entry_product_detail_ext_feet_in']:'';
		$gin_entry_product_detail_ext_feet_mm 		= isset($_POST['gin_entry_product_detail_ext_feet_mm'])?$_POST['gin_entry_product_detail_ext_feet_mm']:'';
		$gin_entry_product_detail_ext_feet_met 		= isset($_POST['gin_entry_product_detail_ext_feet_met'])?$_POST['gin_entry_product_detail_ext_feet_met']:'';
		$gin_entry_product_detail_s_weight_inches   = isset($_POST['gin_entry_product_detail_s_weight_inches'])?$_POST['gin_entry_product_detail_s_weight_inches']:'';
		$gin_entry_product_detail_s_weight_mm   	= isset($_POST['gin_entry_product_detail_s_weight_mm'])?$_POST['gin_entry_product_detail_s_weight_mm']:'';
		$gin_entry_product_detail_qty 			  	= $_POST['gin_entry_product_detail_qty'];
		$gin_entry_product_detail_tot_length 		= isset($_POST['gin_entry_product_detail_tot_length'])?$_POST['gin_entry_product_detail_tot_length']:'';
		$gin_entry_product_detail_tot_feet 			= isset($_POST['gin_entry_product_detail_tot_feet'])?$_POST['gin_entry_product_detail_tot_feet']:'';
		$gin_entry_product_detail_tot_meter 		= isset($_POST['gin_entry_product_detail_tot_meter'])?$_POST['gin_entry_product_detail_tot_meter']:'';

		
	$gin_entry_raw_product_detail_id      			= $_POST['gin_entry_raw_product_detail_id'];
	$gin_entry_raw_product_detail_product_type      = $_POST['gin_entry_raw_product_detail_product_type'];
	$gin_entry_raw_product_detail_product_id     	= $_POST['gin_entry_raw_product_detail_product_id'];
	$gin_entry_raw_product_detail_product_thick  	= isset($_POST['gin_entry_raw_product_detail_product_thick'])?$_POST['gin_entry_raw_product_detail_product_thick']:'';
	$gin_entry_raw_product_detail_width_inches  	= isset($_POST['gin_entry_raw_product_detail_width_inches'])?$_POST['gin_entry_raw_product_detail_width_inches']:'';
	$gin_entry_raw_product_detail_width_mm 		  	= isset($_POST['gin_entry_raw_product_detail_width_mm'])?$_POST['gin_entry_raw_product_detail_width_mm']:'';
	$gin_entry_raw_product_detail_s_width_inches 	= isset($_POST['gin_entry_raw_product_detail_s_width_inches'])?$_POST['gin_entry_raw_product_detail_s_width_inches']:'';
	$gin_entry_raw_product_detail_s_width_mm 		= isset($_POST['gin_entry_raw_product_detail_s_width_mm'])?$_POST['gin_entry_raw_product_detail_s_width_mm']:'';
	$gin_entry_raw_product_detail_sl_feet 		  	= isset($_POST['gin_entry_raw_product_detail_sl_feet'])?$_POST['gin_entry_raw_product_detail_sl_feet']:'';
	$gin_entry_raw_product_detail_sl_feet_in 		= isset($_POST['gin_entry_raw_product_detail_sl_feet_in'])?$_POST['gin_entry_raw_product_detail_sl_feet_in']:'';
	$gin_entry_raw_product_detail_sl_feet_mm 		= isset($_POST['gin_entry_raw_product_detail_sl_feet_mm'])?$_POST['gin_entry_raw_product_detail_sl_feet_mm']:'';
	$gin_entry_raw_product_detail_s_weight_inches   = isset($_POST['gin_entry_raw_product_detail_s_weight_inches'])?$_POST['gin_entry_raw_product_detail_s_weight_inches']:'';
	$gin_entry_raw_product_detail_s_weight_mm   	= isset($_POST['gin_entry_raw_product_detail_s_weight_mm'])?$_POST['gin_entry_raw_product_detail_s_weight_mm']:'';
	$gin_entry_raw_product_detail_qty 			  	= $_POST['gin_entry_raw_product_detail_qty'];
	$gin_entry_raw_product_detail_tot_length 		= isset($_POST['gin_entry_raw_product_detail_tot_length'])?$_POST['gin_entry_raw_product_detail_tot_length']:'';
	$gin_entry_raw_product_detail_ton				= isset($_POST['gin_entry_raw_product_detail_ton'])?$_POST['gin_entry_raw_product_detail_ton']:'';
	$gin_entry_raw_product_detail_kg				= isset($_POST['gin_entry_raw_product_detail_kg'])?$_POST['gin_entry_raw_product_detail_kg']:'';
	
	$gin_entry_product_detail_mother_child_type	 = isset($_POST['gin_entry_product_detail_mother_child_type'])?$_POST['gin_entry_product_detail_mother_child_type']:'';
		$request_fields 						= ((!empty($gin_entry_branch_id)) && (!empty($gin_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "goods-issue-notes/index.php?page=edit&id=$gin_entry_uniq_id");

		$ip												= getRealIpAddr();

		 $update_customer 					= sprintf("	UPDATE 

															gin_entry 

														SET 

															gin_entry_branch_id 					= '%d',

															gin_entry_date 						= '%s',

															gin_entry_production_section_id 		= '%d',

															gin_entry_from_godown_id 				= '%d',

															gin_entry_to_godown_id 				= '%d',

															gin_entry_type 						= '%s',

															gin_entry_modified_by 				= '%d',

															gin_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															gin_entry_modified_ip				= '%s'

														WHERE               

															gin_entry_id         				= '%d'", 

															$gin_entry_branch_id,

															$gin_entry_date,

															$gin_entry_production_section_id,

															$gin_entry_from_godown_id,

															$gin_entry_to_godown_id,

															$gin_entry_type,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$gin_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);
		for($i = 0; $i < count($gin_entry_product_detail_product_id); $i++) { 
		// echo $gin_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($gin_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
			
				if(isset($gin_entry_product_detail_id[$i]) && (!empty($gin_entry_product_detail_id[$i]))) {

					 $update_gin_entry_product_detail = sprintf("UPDATE 
																			gin_entry_product_details 
																		SET  
																			gin_entry_product_detail_width_inches  			= '%f',
																			gin_entry_product_detail_width_mm  				= '%f',
																			gin_entry_product_detail_s_width_inches  		= '%f',
																			gin_entry_product_detail_s_width_mm  			= '%f',
																			gin_entry_product_detail_sl_feet  				= '%f',
																			gin_entry_product_detail_sl_feet_in  			= '%f',
																			gin_entry_product_detail_sl_feet_mm  			= '%f',
																			gin_entry_product_detail_s_weight_inches  		= '%f',
																			gin_entry_product_detail_s_weight_mm  			= '%f',
																			gin_entry_product_detail_tot_length  			= '%f',
																			gin_entry_product_detail_qty  					= '%f',
																			gin_entry_product_detail_mother_child_type		= '%d',
																			gin_entry_product_detail_modified_by 			= '%d',
																			gin_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			gin_entry_product_detail_modified_ip 			= '%s'
																		WHERE 
																			gin_entry_product_detail_gin_entry_id 			= '%d' AND 
																			gin_entry_product_detail_id 					= '%d'",
																			$gin_entry_product_detail_width_inches[$i],
																			$gin_entry_product_detail_width_mm[$i],
																			$gin_entry_product_detail_s_width_inches[$i],
																			$gin_entry_product_detail_s_width_mm[$i],
																			$gin_entry_product_detail_sl_feet[$i],
																			$gin_entry_product_detail_sl_feet_in[$i],
																			$gin_entry_product_detail_sl_feet_mm[$i],
																			$gin_entry_product_detail_s_weight_inches[$i],
																			$gin_entry_product_detail_s_weight_mm[$i],
																			$gin_entry_product_detail_tot_length[$i],
																			$gin_entry_product_detail_qty[$i],
																			$gin_entry_product_detail_mother_child_type[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$gin_entry_id, 
																			$gin_entry_product_detail_id[$i]); 
			//	echo $update_gin_entry_product_detail; exit;
					mysql_query($update_gin_entry_product_detail);

				} else {
				$gin_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_gin_entry_product_detail 		= sprintf("INSERT INTO gin_entry_product_details 
																				(gin_entry_product_detail_uniq_id,gin_entry_product_detail_gin_entry_id,
																				 gin_entry_product_detail_po_detail_id,gin_entry_product_detail_po_entry_id,
																				 gin_entry_product_detail_product_id,
																				 gin_entry_product_detail_product_type, gin_entry_product_detail_product_thick,
																				 gin_entry_product_detail_width_inches,gin_entry_product_detail_width_mm,
																				 gin_entry_product_detail_s_width_inches,gin_entry_product_detail_s_width_mm,
																				 gin_entry_product_detail_sl_feet,gin_entry_product_detail_sl_feet_in,
																				 gin_entry_product_detail_sl_feet_mm,
																				 gin_entry_product_detail_s_weight_inches,gin_entry_product_detail_s_weight_mm,
																				 gin_entry_product_detail_qty,gin_entry_product_detail_tot_length,
																				 gin_entry_product_detail_added_by, gin_entry_product_detail_added_on,
																				 gin_entry_product_detail_added_ip,gin_entry_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )", 
																		 $gin_entry_product_detail_uniq_id,$gin_entry_id,
																		 $gin_entry_product_detail_po_detail_id[$i],$gin_entry_production_order_id,
																		 $gin_entry_product_detail_product_id[$i],
																		 $gin_entry_product_detail_product_type[$i], $gin_entry_product_detail_product_thick[$i],
																		 $gin_entry_product_detail_width_inches[$i],$gin_entry_product_detail_width_mm[$i],
																		 $gin_entry_product_detail_s_width_inches[$i],$gin_entry_product_detail_s_width_mm[$i],
																		 $gin_entry_product_detail_sl_feet[$i],$gin_entry_product_detail_sl_feet_in[$i],
																		 $gin_entry_product_detail_sl_feet_mm[$i],
																		 $gin_entry_product_detail_s_weight_inches[$i],$gin_entry_product_detail_s_weight_mm[$i],
																		 $gin_entry_product_detail_qty[$i],$gin_entry_product_detail_tot_length[$i],
																	$_SESSION[SESS.'_session_user_id'],$ip,$gin_entry_product_detail_mother_child_type[$i]);
																		// echo $insert_gin_entry_product_detail; exit;
				mysql_query($insert_gin_entry_product_detail);
			}
			}
		}
		

		// purchase order pproduct details

		// echo $gin_entry_raw_product_detail_qty[$i]; exit;

		for($i = 0; $i < count($gin_entry_raw_product_detail_product_id); $i++) { 
		// echo $gin_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($gin_entry_product_detail_product_id[$i])) && 
									 							(!empty($gin_entry_product_detail_qty[$i])));
			if($detail_request_fields) {
				if(isset($gin_entry_raw_product_detail_id[$i]) && (!empty($gin_entry_raw_product_detail_id[$i]))) {

				 $update_gin_entry_raw_product_detail = sprintf("UPDATE 
																		gin_entry_raw_product_details 
																	SET  
																		gin_entry_raw_product_detail_width_inches  			= '%f',
																		gin_entry_raw_product_detail_width_mm  				= '%f',
																		gin_entry_raw_product_detail_sl_feet  				= '%f',
																		gin_entry_raw_product_detail_sl_feet_mm  			= '%f',
																		gin_entry_raw_product_detail_ton					= '%f',
																		gin_entry_raw_product_detail_kg						= '%f',
																		gin_entry_raw_product_detail_modified_by 			= '%d',
																		gin_entry_raw_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																		gin_entry_raw_product_detail_modified_ip 			= '%s'
																	WHERE 
																		gin_entry_raw_product_detail_gin_entry_id 			= '%d' AND 
																		gin_entry_raw_product_detail_id 					= '%d'",
																		$gin_entry_raw_product_detail_width_inches[$i],
																		$gin_entry_raw_product_detail_width_mm[$i],
																		$gin_entry_raw_product_detail_sl_feet[$i],
																		$gin_entry_raw_product_detail_sl_feet_mm[$i],
																		$gin_entry_raw_product_detail_ton[$i],
																		$gin_entry_raw_product_detail_kg[$i],
																		$_SESSION[SESS.'_session_user_id'], 
																		$ip, 
																		$gin_entry_id, 
																		$gin_entry_raw_product_detail_id[$i]);
		//	echo $update_gin_entry_raw_product_detail; exit;
				mysql_query($update_gin_entry_raw_product_detail);

			} else {
				$gin_entry_raw_product_detail_uniq_id 	= generateUniqId();
				$insert_gin_entry_raw_product_detail 		= sprintf("INSERT INTO gin_entry_raw_product_details 
																				(gin_entry_raw_product_detail_uniq_id,gin_entry_raw_product_detail_gin_entry_id,
																				 gin_entry_raw_product_detail_product_id,
																				 gin_entry_raw_product_detail_product_type, gin_entry_raw_product_detail_product_thick,
																				 gin_entry_raw_product_detail_width_inches,gin_entry_raw_product_detail_width_mm,
																				 gin_entry_raw_product_detail_s_width_inches,gin_entry_raw_product_detail_s_width_mm,
																				 gin_entry_raw_product_detail_sl_feet,gin_entry_raw_product_detail_sl_feet_in,
																				 gin_entry_raw_product_detail_sl_feet_mm,
																				 gin_entry_raw_product_detail_s_weight_inches,gin_entry_raw_product_detail_s_weight_mm,
																				 gin_entry_raw_product_detail_qty,gin_entry_raw_product_detail_tot_length,
																				 gin_entry_raw_product_detail_added_by, gin_entry_raw_product_detail_added_on,
																				 gin_entry_raw_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $gin_entry_raw_product_detail_uniq_id,$gin_entry_id,
																		 $gin_entry_raw_product_detail_product_id[$i],
																		 $gin_entry_raw_product_detail_product_type[$i], $gin_entry_raw_product_detail_product_thick[$i],
																		 $gin_entry_raw_product_detail_width_inches[$i],$gin_entry_raw_product_detail_width_mm[$i],
																		 $gin_entry_raw_product_detail_s_width_inches[$i],$gin_entry_raw_product_detail_s_width_mm[$i],
																		 $gin_entry_raw_product_detail_sl_feet[$i],$gin_entry_raw_product_detail_sl_feet_in[$i],
																		 $gin_entry_raw_product_detail_sl_feet_mm[$i],
																		 $gin_entry_raw_product_detail_s_weight_inches[$i],$gin_entry_raw_product_detail_s_weight_mm[$i],
																		 $gin_entry_raw_product_detail_qty[$i],$gin_entry_raw_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
																		// echo $insert_gin_entry_raw_product_detail; exit;
				mysql_query($insert_gin_entry_raw_product_detail);
			}
			}
		}
		pageRedirection("goods-issue-notes/index.php?page=edit&id=$gin_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['gin_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$gin_entry_uniq_id = $_GET['gin_entry_uniq_id'];

			mysql_query("UPDATE gin_entry_product_details SET gin_entry_product_detail_deleted_status = 1 

						WHERE gin_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$gin_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('gin_entry', 'gin_entry_deleted_by', 'gin_entry_deleted_on' , 'gin_entry_deleted_ip','gin_entry_deleted_status', 'gin_entry_id', 'gin_entry_uniq_id', '1');

		

		deleteMultiRecords('gin_entry_product_details', 'gin_entry_product_detail_deleted_by', 'gin_entry_product_detail_deleted_on', 'gin_entry_product_detail_deleted_ip', 'gin_entry_product_detail_deleted_status', 'gin_entry_product_detail_gin_entry_id', 'gin_entry','gin_entry_id','gin_entry_uniq_id', '1');  



		deleteMultiRecords('gin_entry_raw_product_details', 'gin_entry_raw_product_detail_deleted_by', 'gin_entry_raw_product_detail_deleted_on', 'gin_entry_raw_product_detail_deleted_ip', 'gin_entry_raw_product_detail_deleted_status', 'gin_entry_raw_product_detail_gin_entry_id', 'gin_entry','gin_entry_id','gin_entry_uniq_id', '1'); 

		pageRedirection("goods-issue-notes/index.php?msg=7");				

	}

?>