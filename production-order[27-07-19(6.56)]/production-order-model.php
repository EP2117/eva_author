<?php

	function insertQuotation(){

		$production_order_branch_id                   		= trim($_POST['production_order_branch_id']);

		$production_order_date                 				= NdateDatabaseFormat($_POST['production_order_date']);

		$production_order_production_section_id            	= trim($_POST['production_order_production_section_id']);

		$production_order_department_id      				= trim($_POST['production_order_department_id']);

		$production_order_type     							= trim($_POST['production_order_type']);
		$production_order_order_type						= trim($_POST['production_order_order_type']);
		$production_order_type_id							= implode(",",$_POST['production_order_type_id']);
		$production_order_sw_check							= trim($_POST['production_order_sw_check']);
		$production_order_brand_id							= trim($_POST['production_order_brand_id']);
		//Product Detail

$production_order_product_detail_product_id     	 = $_POST['production_order_product_detail_product_id'];
$production_order_product_detail_product_uom_id    = $_POST['production_order_product_detail_product_uom_id'];
$production_order_product_detail_product_brand_id  = isset($_POST['production_order_product_detail_product_brand_id'])?$_POST['production_order_product_detail_product_brand_id']:'';
$production_order_product_detail_product_color_id  = isset($_POST['production_order_product_detail_product_color_id'])?$_POST['production_order_product_detail_product_color_id']:'';
$production_order_product_detail_product_thick    = isset($_POST['production_order_product_detail_product_thick'])?$_POST['production_order_product_detail_product_thick']:'';
$production_order_product_detail_width_inches  	  = isset($_POST['production_order_product_detail_width_inches'])?$_POST['production_order_product_detail_width_inches']:'';
$production_order_product_detail_width_mm 		  = isset($_POST['production_order_product_detail_width_mm'])?$_POST['production_order_product_detail_width_mm']:'';
$production_order_product_detail_s_width_inches   = isset($_POST['production_order_product_detail_s_width_inches'])?$_POST['production_order_product_detail_s_width_inches']:'';
$production_order_product_detail_s_width_mm 	  = isset($_POST['production_order_product_detail_s_width_mm'])?$_POST['production_order_product_detail_s_width_mm']:'';
$production_order_product_detail_sl_feet 		  = isset($_POST['production_order_product_detail_sl_feet'])?$_POST['production_order_product_detail_sl_feet']:'';
$production_order_product_detail_sl_feet_in 	  = isset($_POST['production_order_product_detail_sl_feet_in'])?$_POST['production_order_product_detail_sl_feet_in']:'';
$production_order_product_detail_sl_feet_mm 	 = isset($_POST['production_order_product_detail_sl_feet_mm'])?$_POST['production_order_product_detail_sl_feet_mm']:'';
$production_order_product_detail_sl_feet_met 	  = isset($_POST['production_order_product_detail_sl_feet_met'])?$_POST['production_order_product_detail_sl_feet_met']:'';
$production_order_product_detail_ext_feet 		  = isset($_POST['production_order_product_detail_ext_feet'])?$_POST['production_order_product_detail_ext_feet']:'';
$production_order_product_detail_ext_feet_in 	  = isset($_POST['production_order_product_detail_ext_feet_in'])?$_POST['production_order_product_detail_ext_feet_in']:'';
$production_order_product_detail_ext_feet_mm 	  = isset($_POST['production_order_product_detail_ext_feet_mm'])?$_POST['production_order_product_detail_ext_feet_mm']:'';
$production_order_product_detail_ext_feet_met 	  = isset($_POST['production_order_product_detail_ext_feet_met'])?$_POST['production_order_product_detail_ext_feet_met']:'';
$production_order_product_detail_qty 			  = $_POST['production_order_product_detail_qty'];
$production_order_product_detail_tot_length 	  = isset($_POST['production_order_product_detail_tot_length'])?$_POST['production_order_product_detail_tot_length']:'';

$production_order_product_detail_s_weight_inches 	  = isset($_POST['production_order_product_detail_s_weight_inches'])?$_POST['production_order_product_detail_s_weight_inches']:'';
$production_order_product_detail_s_weight_mm 	  = isset($_POST['production_order_product_detail_s_weight_mm'])?$_POST['production_order_product_detail_s_weight_mm']:'';

$production_order_product_detail_tot_feet 	  = isset($_POST['production_order_product_detail_tot_feet'])?$_POST['production_order_product_detail_tot_feet']:'';
$production_order_product_detail_tot_meter 	  = isset($_POST['production_order_product_detail_tot_meter'])?$_POST['production_order_product_detail_tot_meter']:'';
$production_order_product_detail_entry_type 	  = $_POST['production_order_product_detail_entry_type'];
$production_order_product_detail_mother_child_type 	  = $_POST['production_order_product_detail_mother_child_type'];
$production_order_product_detail_inv_tot_length 	  = $_POST['production_order_product_detail_inv_tot_length'];
		$request_fields 									= ((!empty($production_order_branch_id)) && (!empty($production_order_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "production-order/index.php?page=add&msg=5");

		$production_order_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();

		

		$select_production_order_no							= "SELECT 

																	MAX(production_order_no) AS maxval 

															   FROM 

																	production_order 

															   WHERE 

																	production_order_deleted_status 	= 0 												AND
						
																	production_order_branch_id 		= '".$production_order_branch_id."'						AND

																	production_order_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND
																	 production_order_status				= '2'     AND
																	production_order_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";

//echo $select_production_order_no;exit;

		$result_production_order_no 						= mysql_query($select_production_order_no);

		$record_production_order_no 						= mysql_fetch_array($result_production_order_no);	

		$maxval 											= $record_production_order_no['maxval']; 

		if($maxval > 0) {

			$production_order_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$production_order_no 							= substr(('00000'.++$maxval),-5);

		}

		

		

		$insert_production_order 					= sprintf("INSERT INTO production_order  (production_order_uniq_id, production_order_date,
																					  		  production_order_production_section_id,
																							  production_order_department_id,
																					   		  production_order_type,production_order_no,
																					  		  production_order_branch_id,production_order_added_by,
																					   		  production_order_added_on,production_order_added_ip,
																			   		   		  production_order_company_id,production_order_financial_year,
																							  production_order_status,production_order_order_type,
																							  production_order_type_id,
																							  production_order_sw_check,production_order_brand_id) 

																			VALUES 	 		 ('%s', '%s', 

																							  '%d', '%d', 

																							  '%d', '%s',

																							  '%d', '%d', 

																							   UNIX_TIMESTAMP(NOW()),

																							  '%s', '%d', '%d',

																							  '%d' ,'%d','%s',
																							  '%s','%d')", 

																		  	   		   		 $production_order_uniq_id, $production_order_date,
																					   		 $production_order_production_section_id,
																							 $production_order_department_id,
																					   		 $production_order_type,$production_order_no,
																					   		 $production_order_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],
																							 $_SESSION[SESS.'_session_financial_year'],
																							 '2',$production_order_order_type,$production_order_type_id,
																							 $production_order_sw_check,$production_order_brand_id);  

		mysql_query($insert_production_order);
		//echo $insert_production_order; exit;
		$production_order_id 						= mysql_insert_id(); 
		// purchase order pproduct details
		
		/*echo "<pre>";
		print_r($_POST);exit;*/
		for($i = 0; $i < count($production_order_product_detail_product_id); $i++) { 
			$detail_request_fields 							= 	((!empty($production_order_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$production_order_product_detail_uniq_id 	= generateUniqId();
				$insert_production_order_product_detail 		= sprintf("INSERT INTO production_order_product_details 
																				(production_order_product_detail_uniq_id,
																				production_order_product_detail_production_order_id,
																				 production_order_product_detail_product_id,
																				 production_order_product_detail_product_color_id,
																				 production_order_product_detail_product_type, 
																				 production_order_product_detail_product_thick,
																				 production_order_product_detail_width_inches,
																				 production_order_product_detail_width_mm,
																				 production_order_product_detail_s_width_inches,
																				 production_order_product_detail_s_width_mm,
																				 production_order_product_detail_sl_feet,
																				 production_order_product_detail_sl_feet_in,
																				 production_order_product_detail_sl_feet_mm,
																				 production_order_product_detail_sl_feet_met,
																				 production_order_product_detail_ext_feet,
																				 production_order_product_detail_ext_feet_in,
																				 production_order_product_detail_ext_feet_mm,
																				 production_order_product_detail_ext_feet_met,
																				 production_order_product_detail_qty,
																				 production_order_product_detail_tot_length,
																				 production_order_product_detail_s_weight_inches,
																				 production_order_product_detail_s_weight_mm,
																				 production_order_product_detail_tot_feet,
																				 production_order_product_detail_tot_meter,
																				 production_order_product_detail_added_by, 
																				 production_order_product_detail_added_on,
																				 production_order_product_detail_added_ip,
																				 production_order_product_detail_entry_type,
																				 production_order_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
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
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d' , '%d' )", 
																		 $production_order_product_detail_uniq_id,$production_order_id,
																		 $production_order_product_detail_product_id[$i],
																		 $production_order_product_detail_product_color_id[$i],
																		 "1", $production_order_product_detail_product_thick[$i],
																		 $production_order_product_detail_width_inches[$i],
																		 $production_order_product_detail_width_mm[$i],
																		 $production_order_product_detail_s_width_inches[$i],
																		 $production_order_product_detail_s_width_mm[$i],
																		 $production_order_product_detail_sl_feet[$i],
																		 $production_order_product_detail_sl_feet_in[$i],
																		 $production_order_product_detail_sl_feet_mm[$i],
																		 $production_order_product_detail_sl_feet_met[$i],
																		  $production_order_product_detail_ext_feet[$i],
																		  $production_order_product_detail_ext_feet_in[$i],
																		 $production_order_product_detail_ext_feet_mm[$i],
																		 $production_order_product_detail_ext_feet_met[$i],
																		 $production_order_product_detail_qty[$i],
																		 $production_order_product_detail_tot_length[$i],
																		 $production_order_product_detail_s_weight_inches[$i],
																		 $production_order_product_detail_s_weight_mm[$i],
																		  $production_order_product_detail_tot_feet[$i],
																		  $production_order_product_detail_tot_meter[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $production_order_product_detail_entry_type[$i],
																		 $production_order_product_detail_mother_child_type[$i]);
				//echo $insert_production_order_product_detail; exit;
				mysql_query($insert_production_order_product_detail);
				$detail_id	= mysql_insert_id();
				//if($_SESSION[SESS.'_session_user_branch_type']==2){
					if($production_order_product_detail_entry_type[$i]=='4'){ //echo 'test';exit;
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"prodution-order";
								$godown_id										= 	"2";
								$produt_id										=	$production_order_product_detail_product_id[$i];
								$produt_qty										=	(-1*$production_order_product_detail_qty[$i]);
								$child_type										=	$production_order_product_detail_mother_child_type[$i];
								
							if($production_order_sw_check=='yes'){// echo 'fd';exit;
							stockLedger($child_type,'out',$production_order_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $production_order_branch_id,  $godown_id, $production_order_date, $production_order_no,$stock_ledger_entry_type,'1');
							}
					}
					else{
						// echo 'test1';exit;
					
					$entry_type											= 	"prodution-order";
					$produt_id											=	$production_order_product_detail_product_id[$i];
					$product_colour_id									=	$production_order_product_detail_product_color_id[$i];
					$product_thick										=	$production_order_product_detail_product_thick[$i];
					$width_inches										= 	$production_order_product_detail_width_inches[$i];
					$width_mm											= 	$production_order_product_detail_width_mm[$i];
					$ton_qty											= 	$production_order_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$production_order_product_detail_s_weight_mm[$i];
					$tot_length											= 	$production_order_product_detail_inv_tot_length[$i]; 
					$child_type										    =	$production_order_product_detail_mother_child_type[$i];
					$length_feet										= 	$production_order_product_detail_sl_feet[$i];
					$length_meter										= 	$production_order_product_detail_sl_feet_met[$i];
					$godown_id											= 	"2";
					$produt_qty											=	(-1);
					//echo $ton_qty;

					if($production_order_sw_check=='yes'){
	stockLedger($child_type,'out',$production_order_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $production_order_branch_id,  $godown_id, $production_order_date, $production_order_no,$entry_type,'2',$width_inches,$width_mm,$product_colour_id,$product_thick);
					}	

					}
				//}				
			}
		}
		
		//exit;
		// raw Product Detail
		pageRedirection("production-order/index.php?page=add&msg=1");

	}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND production_order_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND production_order_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		
		$select_production_order		=	"SELECT 

												production_order_id,

												production_order_uniq_id,

												production_order_no,

												production_order_date,

												production_section_name,

												production_order_type,
												production_order_brand_id

											 FROM 

												production_order

											 LEFT JOIN

												production_sections

											 ON

												production_section_id		=  production_order_production_section_id

											 WHERE 

												production_order_deleted_status 	= 	0 								AND

												production_order_status				= '2' $where

											 ORDER BY 

												production_order_no ASC";

		$result_production_order		= mysql_query($select_production_order);

		// Filling up the array

		$production_order_data 		= array();

		while ($record_production_order = mysql_fetch_array($result_production_order))

		{

		 $production_order_data[] 	= $record_production_order;

		}

		return $production_order_data;

	}

	function editQuotation(){

		$production_order_id 			= getId('production_order', 'production_order_id', 'production_order_uniq_id', dataValidation($_GET['id'])); 

		$select_production_order		=	"SELECT 

												production_order_uniq_id,  production_order_date,
												production_order_production_section_id,
												production_order_department_id,production_order_type,
												 production_order_no,production_order_type_id,
												production_order_branch_id,production_order_id,
												production_order_sw_check,production_order_order_type,
												production_order_brand_id

											 FROM 

												production_order 

											 WHERE 

												production_order_deleted_status 	=  0 			AND 

												production_order_id				= '".$production_order_id."'

											 ORDER BY 

												production_order_no ASC";

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
															production_order_product_detail_mother_child_type,
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
															product_id 			= production_order_product_detail_product_id
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

															production_order_product_detail_deleted_status		 	= 0 		AND 
															production_order_product_detail_mother_child_type	 	= '1' 	AND 
															production_order_product_detail_production_order_id 		= '".$production_order_id."'";

		$result_production_order_product_detail 	= mysql_query($select_production_order_product_detail);

		$count_production_order 					= mysql_num_rows($result_production_order_product_detail);

		$arr_production_order_product_detail 	= array();

		

		while($record_production_order_product_detail = mysql_fetch_array($result_production_order_product_detail)) {

			$arr_production_order_product_detail[] = $record_production_order_product_detail;

		}
		
		 $select_production_order_product_detail1 	= "	SELECT 
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
															production_order_product_detail_mother_child_type,
															product_con_entry_child_product_detail_name as product_name,
															p_uom.product_uom_name as p_uom_name,
															product_con_entry_child_product_detail_code as product_code,
															brand_name,
															p_colour.product_colour_name as p_colour_nam,
															production_order_product_detail_entry_type,
															production_order_product_detail_product_color_id
															
														FROM 
															production_order_product_details 
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id	= production_order_product_detail_product_id
														LEFT JOIN 
															 brands 
														ON 
															 brand_id 		= product_con_entry_child_product_detail_product_brand_id	
														
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 	= product_con_entry_child_product_detail_uom_id
														
														LEFT JOIN 
															product_colours  as p_colour
														ON 
															p_colour.product_colour_id 	= product_con_entry_child_product_detail_color_id
														
														WHERE 

															production_order_product_detail_deleted_status		 	= 0 							AND 
															production_order_product_detail_mother_child_type	 	= '2' 	AND 

															production_order_product_detail_production_order_id 		= '".$production_order_id."'";
															
															//echo $select_production_order_product_detail1;exit;

		$result_production_order_product_detail1 	= mysql_query($select_production_order_product_detail1);

		$count_production_order1 					= mysql_num_rows($result_production_order_product_detail1);

		

		while($record_production_order_product_detail1 = mysql_fetch_array($result_production_order_product_detail1)) {

			$arr_production_order_product_detail[] = $record_production_order_product_detail1;

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

	function updateQuotation(){

		$production_order_id                   				= trim($_POST['production_order_id']);
		$production_order_uniq_id                			= trim($_POST['production_order_uniq_id']);
		$production_order_branch_id                   		= trim($_POST['production_order_branch_id']);
		$production_order_date                 				= NdateDatabaseFormat($_POST['production_order_date']);
		$production_order_production_section_id            	= trim($_POST['production_order_production_section_id']);
		$production_order_department_id      				= trim($_POST['production_order_department_id']);
		$production_order_type     							= trim($_POST['production_order_type']);
		$production_order_brand_id     						= trim($_POST['production_order_brand_id']);
		$production_order_so_entry_id     					= trim($_POST['production_order_so_entry_id']);
		//Multi Contact

		
		
		$production_order_product_detail_id				   		= $_POST['production_order_product_detail_id'];
		$production_order_product_detail_product_id     	 = $_POST['production_order_product_detail_product_id'];
		$production_order_product_detail_product_uom_id    = $_POST['production_order_product_detail_product_uom_id'];
		$production_order_product_detail_product_brand_id  = isset($_POST['production_order_product_detail_product_brand_id'])?$_POST['production_order_product_detail_product_brand_id']:'';
		$production_order_product_detail_product_color_id  = isset($_POST['production_order_product_detail_product_color_id'])?$_POST['production_order_product_detail_product_color_id']:'';
		$production_order_product_detail_product_thick    = isset($_POST['production_order_product_detail_product_thick'])?$_POST['production_order_product_detail_product_thick']:'';
		$production_order_product_detail_width_inches  	  = isset($_POST['production_order_product_detail_width_inches'])?$_POST['production_order_product_detail_width_inches']:'';
		$production_order_product_detail_width_mm 		  = isset($_POST['production_order_product_detail_width_mm'])?$_POST['production_order_product_detail_width_mm']:'';
		$production_order_product_detail_s_width_inches   = isset($_POST['production_order_product_detail_s_width_inches'])?$_POST['production_order_product_detail_s_width_inches']:'';
		$production_order_product_detail_s_width_mm 	  = isset($_POST['production_order_product_detail_s_width_mm'])?$_POST['production_order_product_detail_s_width_mm']:'';
		$production_order_product_detail_sl_feet 		  = isset($_POST['production_order_product_detail_sl_feet'])?$_POST['production_order_product_detail_sl_feet']:'';
		$production_order_product_detail_sl_feet_in 	  = isset($_POST['production_order_product_detail_sl_feet_in'])?$_POST['production_order_product_detail_sl_feet_in']:'';
		$production_order_product_detail_sl_feet_mm 	 = isset($_POST['production_order_product_detail_sl_feet_mm'])?$_POST['production_order_product_detail_sl_feet_mm']:'';
		$production_order_product_detail_sl_feet_met 	  = isset($_POST['production_order_product_detail_sl_feet_met'])?$_POST['production_order_product_detail_sl_feet_met']:'';
		$production_order_product_detail_ext_feet 		  = isset($_POST['production_order_product_detail_ext_feet'])?$_POST['production_order_product_detail_ext_feet']:'';
		$production_order_product_detail_ext_feet_in 	  = isset($_POST['production_order_product_detail_ext_feet_in'])?$_POST['production_order_product_detail_ext_feet_in']:'';
		$production_order_product_detail_ext_feet_mm 	  = isset($_POST['production_order_product_detail_ext_feet_mm'])?$_POST['production_order_product_detail_ext_feet_mm']:'';
		$production_order_product_detail_ext_feet_met 	  = isset($_POST['production_order_product_detail_ext_feet_met'])?$_POST['production_order_product_detail_ext_feet_met']:'';
		$production_order_product_detail_qty 			  = $_POST['production_order_product_detail_qty'];
		$production_order_product_detail_tot_length 	  = isset($_POST['production_order_product_detail_tot_length'])?$_POST['production_order_product_detail_tot_length']:'';
		$production_order_product_detail_s_weight_inches  = isset($_POST['production_order_product_detail_s_weight_inches'])?$_POST['production_order_product_detail_s_weight_inches']:'';
		$production_order_product_detail_s_weight_mm 	  = isset($_POST['production_order_product_detail_s_weight_mm'])?$_POST['production_order_product_detail_s_weight_mm']:'';
		$production_order_product_detail_tot_feet 	      = isset($_POST['production_order_product_detail_tot_feet'])?$_POST['production_order_product_detail_tot_feet']:'';
		$production_order_product_detail_tot_meter 	      = isset($_POST['production_order_product_detail_tot_meter'])?$_POST['production_order_product_detail_tot_meter']:'';
		$production_order_product_detail_entry_type 	  = $_POST['production_order_product_detail_entry_type'];
		$production_order_product_detail_inv_tot_length   = $_POST['production_order_product_detail_inv_tot_length'];
		$production_order_product_detail_mother_child_type= $_POST['production_order_product_detail_mother_child_type'];
				
		
		// Raw Product Detail
		

		$request_fields 						= ((!empty($production_order_branch_id)) && (!empty($production_order_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "production-order/index.php?page=edit&id=$production_order_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 
															production_order 
														SET 
															production_order_branch_id 					= '%d',
															production_order_date 						= '%s',
															production_order_production_section_id 		= '%d',
															production_order_customer_id 				= '%d',
															production_order_department_id 				= '%d',
															production_order_brand_id     				= '%d',
															production_order_type 						= '%s',
															production_order_modified_by 				= '%d',
															production_order_modified_on 				= UNIX_TIMESTAMP(NOW()),
															production_order_modified_ip				= '%s'
														WHERE               
															production_order_id         				= '%d'", 
															$production_order_branch_id,
															$production_order_date,
															$production_order_production_section_id,
															$production_order_customer_id,
															$production_order_department_id,
															$production_order_brand_id,
															$production_order_type,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$production_order_id); 
		//echo $update_customer; exit;
		mysql_query($update_customer);
		for($i = 0; $i < count($production_order_product_detail_product_id); $i++) {
			$detail_request_fields = ((!empty($production_order_product_detail_product_id[$i])));
			if($detail_request_fields) { 

				if(!empty($production_order_product_detail_id[$i])) {

					
					
					
					 $update_production_order_product_detail = sprintf("	UPDATE 
																			production_order_product_details 
																		SET  
																			production_order_product_detail_width_inches  			= '%f',
																			production_order_product_detail_width_mm	  			= '%f',
																			production_order_product_detail_s_width_inches  		= '%f',
																			production_order_product_detail_s_width_mm				= '%f',
																			production_order_product_detail_sl_feet  				= '%f',
																			production_order_product_detail_sl_feet_in  			= '%f',
																			production_order_product_detail_sl_feet_mm  			= '%f',
																			production_order_product_detail_ext_feet  				= '%f',
																			production_order_product_detail_sl_feet_met  			= '%f',
																			production_order_product_detail_ext_feet_in  			= '%f',
																			production_order_product_detail_ext_feet_mm  			= '%f',
																			production_order_product_detail_ext_feet_met			= '%f',
																			production_order_product_detail_modified_by 			= '%d',
																			production_order_product_detail_mother_child_type		= '%d',
																			production_order_product_detail_qty						= '%f',
																			production_order_product_detail_tot_length				= '%f',
																			production_order_product_detail_product_color_id		= '%d',
																			production_order_product_detail_product_thick			= '%d',
																			production_order_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			production_order_product_detail_modified_ip 			= '%s'
																		WHERE 
																			production_order_product_detail_id 				= '%d'",
																			$production_order_product_detail_width_inches[$i],
																			$production_order_product_detail_width_mm[$i],
																			$production_order_product_detail_s_width_inches[$i],
																			$production_order_product_detail_s_width_mm[$i],
																			$production_order_product_detail_sl_feet[$i],
																			$production_order_product_detail_sl_feet_in[$i],
																			$production_order_product_detail_sl_feet_mm[$i],
																			$production_order_product_detail_ext_feet[$i],
																			$production_order_product_detail_sl_feet_met[$i],
																			$production_order_product_detail_ext_feet_in[$i],
																			$production_order_product_detail_ext_feet_mm[$i],
																			$production_order_product_detail_ext_feet_met[$i],
																			$_SESSION[SESS.'_session_user_id'],
																			$production_order_product_detail_mother_child_type[$i],
																			$production_order_product_detail_qty[$i],
																			$production_order_product_detail_tot_length[$i],
																			$production_order_product_detail_product_color_id[$i],
																			$production_order_product_detail_product_thick[$i],
																			
																			$ip, 
																			$production_order_product_detail_id[$i]);
					mysql_query($update_production_order_product_detail);
				} else {

					$production_order_product_detail_uniq_id 	= generateUniqId();

				$insert_production_order_product_detail 		= sprintf("INSERT INTO production_order_product_details 
																				(production_order_product_detail_uniq_id,
																				production_order_product_detail_production_order_id,
																				 production_order_product_detail_product_id,
																				 production_order_product_detail_product_color_id,
																				 production_order_product_detail_product_type, 
																				 production_order_product_detail_product_thick,
																				 production_order_product_detail_width_inches,
																				 production_order_product_detail_width_mm,
																				 production_order_product_detail_s_width_inches,
																				 production_order_product_detail_s_width_mm,
																				 production_order_product_detail_sl_feet,
																				 production_order_product_detail_sl_feet_in,
																				 production_order_product_detail_sl_feet_mm,
																				 production_order_product_detail_sl_feet_met,
																				 production_order_product_detail_ext_feet,
																				 production_order_product_detail_ext_feet_in,
																				 production_order_product_detail_ext_feet_mm,
																				 production_order_product_detail_ext_feet_met,
																				 production_order_product_detail_qty,
																				 production_order_product_detail_tot_length,
																				 production_order_product_detail_s_weight_inches,
																				 production_order_product_detail_s_weight_mm,
																				 production_order_product_detail_tot_feet,
																				 production_order_product_detail_tot_meter,
																				 production_order_product_detail_added_by, 
																				 production_order_product_detail_added_on,
																				 production_order_product_detail_added_ip,
																				 production_order_product_detail_entry_type,
																				 production_order_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
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
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d','%d' )", 
																		 $production_order_product_detail_uniq_id,$production_order_id,
																		 $production_order_product_detail_product_id[$i],
																		 $production_order_product_detail_product_color_id[$i],
																		 "1", $production_order_product_detail_product_thick[$i],
																		 $production_order_product_detail_width_inches[$i],
																		 $production_order_product_detail_width_mm[$i],
																		 $production_order_product_detail_s_width_inches[$i],
																		 $production_order_product_detail_s_width_mm[$i],
																		 $production_order_product_detail_sl_feet[$i],
																		 $production_order_product_detail_sl_feet_in[$i],
																		 $production_order_product_detail_sl_feet_mm[$i],
																		 $production_order_product_detail_sl_feet_met[$i],
																		  $production_order_product_detail_ext_feet[$i],
																		  $production_order_product_detail_ext_feet_in[$i],
																		 $production_order_product_detail_ext_feet_mm[$i],
																		 $production_order_product_detail_ext_feet_met[$i],
																		 $production_order_product_detail_qty[$i],
																		 $production_order_product_detail_tot_length[$i],
																		 $production_order_product_detail_s_weight_inches[$i],
																		 $production_order_product_detail_s_weight_mm[$i],
																		  $production_order_product_detail_tot_feet[$i],
																		  $production_order_product_detail_tot_meter[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $production_order_product_detail_entry_type[$i],
																		 $production_order_product_detail_mother_child_type[$i]);
																		//echo $insert_production_order_product_detail; exit;
				mysql_query($insert_production_order_product_detail);

				}

			}

		

		}  

		pageRedirection("production-order/index.php?page=edit&id=$production_order_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['production_order_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$production_order_uniq_id = $_GET['production_order_uniq_id'];

			mysql_query("UPDATE production_order_product_details SET production_order_product_detail_deleted_status = 1 

						WHERE production_order_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$production_order_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('production_order', 'production_order_deleted_by', 'production_order_deleted_on' , 'production_order_deleted_ip','production_order_deleted_status', 'production_order_id', 'production_order_uniq_id', '1');

		

		deleteMultiRecords('production_order_product_details', 'production_order_product_detail_deleted_by', 'production_order_product_detail_deleted_on', 'production_order_product_detail_deleted_ip', 'production_order_product_detail_deleted_status', 'production_order_product_detail_production_order_id', 'production_order','production_order_id','production_order_uniq_id', '1');  



		

		pageRedirection("production-order/index.php?msg=7");				

	}

?>