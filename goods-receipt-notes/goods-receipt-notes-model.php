<?php
	function insertQuotation(){

		$grn_entry_branch_id                   			= trim($_POST['grn_entry_branch_id']);
		$grn_entry_date                 				= NdateDatabaseFormat($_POST['grn_entry_date']);
		$grn_entry_production_section_id            	= trim($_POST['grn_entry_production_section_id']);
		$grn_entry_from_godown_id          				= trim($_POST['grn_entry_from_godown_id']);
		$grn_entry_to_godown_id      					= trim($_POST['grn_entry_to_godown_id']);
		$grn_entry_type     							= 0;
		$grn_entry_gin_entry_id     					= trim($_POST['grn_entry_gin_entry_id']);
		$grn_entry_type_id     							= trim($_POST['grn_entry_type_id']);
		//Product Detail
		
		$grn_entry_product_detail_product_type      = $_POST['grn_entry_product_detail_product_type'];
		$grn_entry_product_detail_gin_detail_id     = $_POST['grn_entry_product_detail_gin_detail_id'];
		$grn_entry_product_detail_product_id     	= $_POST['grn_entry_product_detail_product_id'];
		$grn_entry_product_detail_product_colour_id	= $_POST['grn_entry_product_detail_product_colour_id'];
		$grn_entry_product_detail_product_thick  	= isset($_POST['grn_entry_product_detail_product_thick'])?$_POST['grn_entry_product_detail_product_thick']:'';
		$grn_entry_product_detail_width_inches  	= isset($_POST['grn_entry_product_detail_width_inches'])?$_POST['grn_entry_product_detail_width_inches']:'';
		$grn_entry_product_detail_width_mm 		  	= isset($_POST['grn_entry_product_detail_width_mm'])?$_POST['grn_entry_product_detail_width_mm']:'';
		$grn_entry_product_detail_s_width_inches 	= isset($_POST['grn_entry_product_detail_s_width_inches'])?$_POST['grn_entry_product_detail_s_width_inches']:'';
		$grn_entry_product_detail_s_width_mm 		= isset($_POST['grn_entry_product_detail_s_width_mm'])?$_POST['grn_entry_product_detail_s_width_mm']:'';
		$grn_entry_product_detail_sl_feet 		  	= isset($_POST['grn_entry_product_detail_sl_feet'])?$_POST['grn_entry_product_detail_sl_feet']:'';
		$grn_entry_product_detail_sl_feet_in 		= isset($_POST['grn_entry_product_detail_sl_feet_in'])?$_POST['grn_entry_product_detail_sl_feet_in']:'';
		$grn_entry_product_detail_sl_feet_mm 		= isset($_POST['grn_entry_product_detail_sl_feet_mm'])?$_POST['grn_entry_product_detail_sl_feet_mm']:'';
		$grn_entry_product_detail_sl_feet_met 		= isset($_POST['grn_entry_product_detail_sl_feet_met'])?$_POST['grn_entry_product_detail_sl_feet_met']:'';
		$grn_entry_product_detail_ext_feet 		  	= isset($_POST['grn_entry_product_detail_ext_feet'])?$_POST['grn_entry_product_detail_ext_feet']:'';
		$grn_entry_product_detail_ext_feet_in 		= isset($_POST['grn_entry_product_detail_ext_feet_in'])?$_POST['grn_entry_product_detail_ext_feet_in']:'';
		$grn_entry_product_detail_ext_feet_mm 		= isset($_POST['grn_entry_product_detail_ext_feet_mm'])?$_POST['grn_entry_product_detail_ext_feet_mm']:'';
		$grn_entry_product_detail_ext_feet_met 		= isset($_POST['grn_entry_product_detail_ext_feet_met'])?$_POST['grn_entry_product_detail_ext_feet_met']:'';
		$grn_entry_product_detail_s_weight_inches   = isset($_POST['grn_entry_product_detail_s_weight_inches'])?$_POST['grn_entry_product_detail_s_weight_inches']:'';
		$grn_entry_product_detail_s_weight_mm   	= isset($_POST['grn_entry_product_detail_s_weight_mm'])?$_POST['grn_entry_product_detail_s_weight_mm']:'';
		$grn_entry_product_detail_qty 			  	= $_POST['grn_entry_product_detail_qty'];
		$grn_entry_product_detail_tot_length 		= isset($_POST['grn_entry_product_detail_tot_length'])?$_POST['grn_entry_product_detail_tot_length']:'';
		
		$grn_entry_product_detail_s_weight_ton 		= isset($_POST['grn_entry_product_detail_s_weight_ton'])?$_POST['grn_entry_product_detail_s_weight_ton']:'';
		$grn_entry_product_detail_s_weight_kg 		= isset($_POST['grn_entry_product_detail_s_weight_kg'])?$_POST['grn_entry_product_detail_s_weight_kg']:'';
		$grn_entry_product_detail_tot_length_feet 	= isset($_POST['grn_entry_product_detail_tot_length_feet'])?$_POST['grn_entry_product_detail_tot_length_feet']:'';
		$grn_entry_product_detail_tot_length_meter 	= isset($_POST['grn_entry_product_detail_tot_length_meter'])?$_POST['grn_entry_product_detail_tot_length_meter']:'';
		$grn_entry_product_detail_tot_feet 			= isset($_POST['grn_entry_product_detail_tot_feet'])?$_POST['grn_entry_product_detail_tot_feet']:'';
		$grn_entry_product_detail_tot_meter 		= isset($_POST['grn_entry_product_detail_tot_meter'])?$_POST['grn_entry_product_detail_tot_meter']:'';
		$grn_entry_product_detail_mother_child_type 			  	= $_POST['grn_entry_product_detail_mother_child_type'];

		$grn_entry_raw_product_detail_product_type      = $_POST['grn_entry_raw_product_detail_product_type'];
		$grn_entry_raw_product_detail_gin_detail_id     = $_POST['grn_entry_raw_product_detail_gin_detail_id'];
		$grn_entry_raw_product_detail_product_id     	= $_POST['grn_entry_raw_product_detail_product_id'];
		$grn_entry_raw_product_detail_product_colour_id	= $_POST['grn_entry_raw_product_detail_product_colour_id'];
		$grn_entry_raw_product_detail_product_thick  	= isset($_POST['grn_entry_raw_product_detail_product_thick'])?$_POST['grn_entry_raw_product_detail_product_thick']:'';
		$grn_entry_raw_product_detail_width_inches  	= isset($_POST['grn_entry_raw_product_detail_width_inches'])?$_POST['grn_entry_raw_product_detail_width_inches']:'';
		$grn_entry_raw_product_detail_width_mm 		  	= isset($_POST['grn_entry_raw_product_detail_width_mm'])?$_POST['grn_entry_raw_product_detail_width_mm']:'';
		$grn_entry_raw_product_detail_sl_feet 		  	= isset($_POST['grn_entry_raw_product_detail_sl_feet'])?$_POST['grn_entry_raw_product_detail_sl_feet']:'';
		$grn_entry_raw_product_detail_sl_feet_mm 		= isset($_POST['grn_entry_raw_product_detail_sl_feet_mm'])?$_POST['grn_entry_raw_product_detail_sl_feet_mm']:'';
		$grn_entry_raw_product_detail_ton 			  	= $_POST['grn_entry_raw_product_detail_ton'];
		$grn_entry_raw_product_detail_kg 				= isset($_POST['grn_entry_raw_product_detail_kg'])?$_POST['grn_entry_raw_product_detail_kg']:'';
		$grn_entry_raw_product_detail_mother_child_type 			  	= $_POST['grn_entry_raw_product_detail_mother_child_type'];
		
		$request_fields 									= ((!empty($grn_entry_branch_id)) && (!empty($grn_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "goods-receipt-notes/index.php?page=add&msg=5");

		$grn_entry_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();
		/*echo "<pre>";
		print_r($_POST);exit;*/

		$select_grn_entry_no						= "SELECT 

																	MAX(grn_entry_no) AS maxval 

															   FROM 

																	grn_entry 

															   WHERE 

																	grn_entry_deleted_status 	= 0 												AND

																	grn_entry_status				= '1'												AND

																	grn_entry_branch_id 		= '".$grn_entry_branch_id."'						AND

																	grn_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND

																	grn_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_grn_entry_no 						= mysql_query($select_grn_entry_no);

		$record_grn_entry_no 						= mysql_fetch_array($result_grn_entry_no);	

		$maxval 											= $record_grn_entry_no['maxval']; 

		if($maxval > 0) {

			$grn_entry_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$grn_entry_no 							= substr(('00000'.++$maxval),-5);

		}

		

		

		$insert_grn_entry 					= sprintf("INSERT INTO grn_entry  (grn_entry_uniq_id, grn_entry_date,

																					  		  grn_entry_production_section_id,grn_entry_from_godown_id,

																					   		  grn_entry_to_godown_id,grn_entry_type,

																					   		  grn_entry_gin_entry_id, grn_entry_no,

																					  		  grn_entry_branch_id,grn_entry_added_by,

																					   		  grn_entry_added_on,grn_entry_added_ip,

																			   		   		  grn_entry_company_id,grn_entry_financial_year,
																							  grn_entry_type_id) 

																			VALUES 	 		 ('%s', '%s', 

																							  '%d', '%d', 

																							  '%d', '%d',

																							  '%d', '%s',

																							  '%d', '%d', 

																							   UNIX_TIMESTAMP(NOW()),

																							  '%s', '%d', '%d',
																							  '%d')", 

																		  	   		   		 $grn_entry_uniq_id, $grn_entry_date,

																					   		 $grn_entry_production_section_id,$grn_entry_from_godown_id,

																					   		 $grn_entry_to_godown_id,$grn_entry_type,

																					   		 $grn_entry_gin_entry_id,$grn_entry_no,

																					   		 $grn_entry_branch_id,$_SESSION[SESS.'_session_user_id'],

																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $grn_entry_type_id);  

		mysql_query($insert_grn_entry);

		//echo $insert_grn_entry; exit;
		$grn_entry_id 						= mysql_insert_id(); 
		for($i = 0; $i < count($grn_entry_product_detail_product_id); $i++) { 
		// echo $grn_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($grn_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$grn_entry_product_detail_uniq_id 	= generateUniqId();
				 $insert_grn_entry_product_detail 		= sprintf("INSERT INTO grn_entry_product_details 
																				(grn_entry_product_detail_uniq_id,grn_entry_product_detail_grn_entry_id,
																				 grn_entry_product_detail_gin_detail_id,
																				 grn_entry_product_detail_gin_entry_id,
																				 grn_entry_product_detail_product_id,
																				 grn_entry_product_detail_product_colour_id,
																				 grn_entry_product_detail_product_type, 
																				 grn_entry_product_detail_product_thick,
																				 grn_entry_product_detail_width_inches,grn_entry_product_detail_width_mm,
																				 grn_entry_product_detail_s_width_inches,grn_entry_product_detail_s_width_mm,
																				 grn_entry_product_detail_sl_feet,grn_entry_product_detail_sl_feet_in,
																				 grn_entry_product_detail_sl_feet_mm,grn_entry_product_detail_sl_feet_met,
																				 grn_entry_product_detail_ext_feet,grn_entry_product_detail_ext_feet_in,
																				 grn_entry_product_detail_ext_feet_mm,grn_entry_product_detail_ext_feet_met,
																				 grn_entry_product_detail_s_weight_inches,
																				 grn_entry_product_detail_s_weight_mm,
																				 grn_entry_product_detail_qty,grn_entry_product_detail_tot_length,
																				 grn_entry_product_detail_tot_feet,grn_entry_product_detail_tot_meter,
																				 grn_entry_product_detail_added_by, grn_entry_product_detail_added_on,
																				 grn_entry_product_detail_added_ip,grn_entry_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d' )", 
																		 $grn_entry_product_detail_uniq_id,$grn_entry_id,
																		 $grn_entry_product_detail_gin_detail_id[$i],$grn_entry_gin_entry_id,
																		 $grn_entry_product_detail_product_id[$i],
																		 $grn_entry_product_detail_product_colour_id[$i],
																		 $grn_entry_product_detail_product_type[$i], 
																		 $grn_entry_product_detail_product_thick[$i],
																		 $grn_entry_product_detail_width_inches[$i],$grn_entry_product_detail_width_mm[$i],
																		 $grn_entry_product_detail_s_width_inches[$i],
																		 $grn_entry_product_detail_s_width_mm[$i],
																		 $grn_entry_product_detail_sl_feet[$i],$grn_entry_product_detail_sl_feet_in[$i],
																		 $grn_entry_product_detail_sl_feet_mm[$i], $grn_entry_product_detail_sl_feet_met[$i],
																		 $grn_entry_product_detail_ext_feet[$i],$grn_entry_product_detail_ext_feet_in[$i],
																		 $grn_entry_product_detail_ext_feet_mm[$i],$grn_entry_product_detail_ext_feet_met[$i],
																		 $grn_entry_product_detail_s_weight_inches[$i],
																		 $grn_entry_product_detail_s_weight_mm[$i],
																		 $grn_entry_product_detail_qty[$i],$grn_entry_product_detail_tot_length[$i],
																		 $grn_entry_product_detail_tot_feet[$i],$grn_entry_product_detail_tot_meter[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $grn_entry_product_detail_mother_child_type[$i]);
																		//echo $insert_grn_entry_product_detail; exit;
				mysql_query($insert_grn_entry_product_detail);
			}
		}
		// purchase order pproduct details
		// echo $grn_entry_raw_product_detail_qty[$i]; exit;
		for($i = 0; $i < count($grn_entry_raw_product_detail_product_id); $i++) { 
		// echo $grn_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($grn_entry_raw_product_detail_product_id[$i])) && 
									 							(!empty($grn_entry_raw_product_detail_ton[$i])));
			if($detail_request_fields) {
				$grn_entry_raw_product_detail_uniq_id 	= generateUniqId();
				$insert_grn_entry_raw_product_detail 		= sprintf("INSERT INTO grn_entry_raw_product_details 
																				(grn_entry_raw_product_detail_uniq_id,
																				grn_entry_raw_product_detail_grn_entry_id,
																				 grn_entry_raw_product_detail_product_id,
																				 grn_entry_raw_product_detail_gin_detail_id,
																				 grn_entry_raw_product_detail_gin_entry_id,
																				 grn_entry_raw_product_detail_product_colour_id,
																				 grn_entry_raw_product_detail_product_type,
																				  grn_entry_raw_product_detail_product_thick,
																				 grn_entry_raw_product_detail_width_inches,
																				 grn_entry_raw_product_detail_width_mm,
																				 grn_entry_raw_product_detail_sl_feet,grn_entry_raw_product_detail_sl_feet_mm,
																				 grn_entry_raw_product_detail_ton,grn_entry_raw_product_detail_kg,
																				 grn_entry_raw_product_detail_added_by, grn_entry_raw_product_detail_added_on,
																				 grn_entry_raw_product_detail_added_ip,
																				 grn_entry_raw_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )", 
																		 $grn_entry_raw_product_detail_uniq_id,$grn_entry_id,
																		 $grn_entry_raw_product_detail_product_id[$i],
																		 $grn_entry_raw_product_detail_gin_detail_id[$i],
																		 $grn_entry_gin_entry_id,$grn_entry_raw_product_detail_product_colour_id[$i],
																		 $grn_entry_raw_product_detail_product_type[$i], 
																		 $grn_entry_raw_product_detail_product_thick[$i],
																		 $grn_entry_raw_product_detail_width_inches[$i],
																		 $grn_entry_raw_product_detail_width_mm[$i],
																		 $grn_entry_raw_product_detail_sl_feet[$i],
																		 $grn_entry_raw_product_detail_sl_feet_mm[$i],
																		 $grn_entry_raw_product_detail_ton[$i],$grn_entry_raw_product_detail_kg[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$grn_entry_raw_product_detail_mother_child_type[$i]);
				mysql_query($insert_grn_entry_raw_product_detail);
				$grn_detail_id	= mysql_insert_id();
							$produt_id											=	$grn_entry_raw_product_detail_product_id[$i];
							$length_feet										= 	$grn_entry_raw_product_detail_sl_feet[$i];
							$length_meter										= 	$grn_entry_raw_product_detail_sl_feet_mm[$i];
							$ton_qty											= 	$grn_entry_raw_product_detail_ton[$i];
							$kg_qty												= 	$grn_entry_raw_product_detail_kg[$i];
							$width_inches										=   $grn_entry_raw_product_detail_width_inches[$i];
							$width_mm											=   $grn_entry_raw_product_detail_width_mm[$i];
							$color_id											= 	$grn_entry_raw_product_detail_product_colour_id[$i];
							$thick												= 	$grn_entry_raw_product_detail_product_thick[$i];
							$product_detail_qty									= 	"1";
							$stock_ledger_entry_type							= 	"manufacture-grn-raw";
							$product_con_entry_godown_id						= 	"1";
							$mother_child_type						= 	$grn_entry_raw_product_detail_mother_child_type[$i];
							stockLedger($mother_child_type,'out',$grn_entry_id,$grn_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$product_detail_qty), $grn_entry_branch_id,  $product_con_entry_godown_id, NdateDatabaseFormat($grn_entry_date), $grn_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
							$product_con_entry_godown_id						= 	"3";
							stockLedger($mother_child_type,'in',$grn_entry_id,$grn_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $grn_entry_branch_id,  $product_con_entry_godown_id, NdateDatabaseFormat($grn_entry_date), $grn_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
				
				
			}
		}
		pageRedirection("goods-receipt-notes/index.php?page=add&msg=1");
	}
	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND grn_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND grn_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		$select_grn_entry		=	"SELECT 

												grn_entry_id,
												grn_entry_uniq_id,
												grn_entry_no,
												grn_entry_date,
												grn_entry_from_godown_id,
												production_section_name,
												customer_name,grn_entry_gin_entry_id,
												production_order_customer_id,
												gin_entry_production_order_id,
												production_order_no,
												grn_entry_type
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


											 LEFT JOIN
												production_sections
											 ON
												production_section_id		=  grn_entry_production_section_id
											 WHERE 

												grn_entry_deleted_status 	= 	0									AND

												grn_entry_status				= '1'  $where

											 ORDER BY 

												grn_entry_no ASC";
												//echo $select_grn_entry;exit;

		$result_grn_entry		= mysql_query($select_grn_entry);
		// Filling up the array
		$grn_entry_data 		= array();
		while ($record_grn_entry = mysql_fetch_array($result_grn_entry)){
		 $grn_entry_data[] 	= $record_grn_entry;
		}
		return $grn_entry_data;
	}

	function editQuotation(){

		$grn_entry_id 			= getId('grn_entry', 'grn_entry_id', 'grn_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_grn_entry		=	"SELECT 

												grn_entry_uniq_id,  grn_entry_date,

												grn_entry_production_section_id,grn_entry_from_godown_id,

												grn_entry_to_godown_id,grn_entry_type,

												grn_entry_gin_entry_id, grn_entry_no,

												grn_entry_branch_id,grn_entry_id,
												grn_entry_type_id

											 FROM 

												grn_entry 
												
												
											 WHERE 

												grn_entry_deleted_status 	=  0 			AND 

												grn_entry_id				= '".$grn_entry_id."'

											 ORDER BY 

												grn_entry_no ASC";

		$result_grn_entry 		= mysql_query($select_grn_entry);

		$record_grn_entry 		= mysql_fetch_array($result_grn_entry);

		return $record_grn_entry;

	}

	function editSalesdetail(){

		$grn_entry_id 			= getId('grn_entry', 'grn_entry_id', 'grn_entry_uniq_id', dataValidation($_GET['id'])); 

		$gin_entry_id 	= getId('grn_entry', 'grn_entry_gin_entry_id', 'grn_entry_uniq_id', dataValidation($_GET['id'])); 

			$select_grn_entry		=	"SELECT 

													gin_entry_no,

													gin_entry_date,

													gin_entry_type,
													
													customer_name,
													customer_billing_address,
													customer_mobile_no,
													production_order_customer_id,
													
													gin_entry_production_order_id,
													production_order_no

												 FROM 

													gin_entry 
													
													LEFT JOIN
													
														production_order
													 ON
														production_order_id															= gin_entry_production_order_id	
														
														LEFT JOIN
														customers
													 ON
														customer_id															= production_order_customer_id	



												 WHERE 

													gin_entry_deleted_status 	=  0 						AND 

													gin_entry_id					= '".$gin_entry_id."'

												 ORDER BY 

													gin_entry_no ASC";

		

		$result_grn_entry 		= mysql_query($select_grn_entry);

		$record_grn_entry 		= mysql_fetch_array($result_grn_entry);

		return $record_grn_entry;

	}
	function editQuotationProductDetail()

	{

		$grn_entry_id 	= getId('grn_entry', 'grn_entry_id', 'grn_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_grn_entry_product_detail 	= "	SELECT 
														grn_entry_product_detail_id,
														grn_entry_product_detail_product_id,
														grn_entry_product_detail_width_inches,grn_entry_product_detail_width_mm,
														grn_entry_product_detail_s_width_inches,grn_entry_product_detail_s_width_mm,
														grn_entry_product_detail_sl_feet,grn_entry_product_detail_sl_feet_in,
														grn_entry_product_detail_sl_feet_mm,grn_entry_product_detail_s_weight_inches,
														grn_entry_product_detail_s_weight_mm,grn_entry_product_detail_tot_length,
														grn_entry_product_detail_gin_detail_id,grn_entry_product_detail_qty,
														grn_entry_product_detail_product_thick,
														product_name,
														product_code,
														
														p_uom.product_uom_name as p_uom_name,
														
														p_clr.product_colour_name as p_colour_name,
														
														brand_name,grn_entry_product_detail_product_type,
														grn_entry_product_detail_ext_feet,
														grn_entry_product_detail_ext_feet_in,
														grn_entry_product_detail_ext_feet_mm,
														grn_entry_product_detail_ext_feet_met,
														grn_entry_product_detail_sl_feet_met,
														grn_entry_product_detail_tot_feet,
														grn_entry_product_detail_tot_meter,grn_entry_product_detail_mother_child_type
													FROM 
														grn_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= grn_entry_product_detail_product_id
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
														p_clr.product_colour_id 								= grn_entry_product_detail_product_colour_id
													WHERE 
														grn_entry_product_detail_deleted_status		 	= 0 							AND 
														grn_entry_product_detail_mother_child_type =1 AND 
														grn_entry_product_detail_grn_entry_id 		= '".$grn_entry_id."'";
			//echo $select_grn_entry_product_detail;exit;												
		$result_grn_entry_product_detail 	= mysql_query($select_grn_entry_product_detail);
		$count_grn_entry 					= mysql_num_rows($result_grn_entry_product_detail);
		$arr_grn_entry_product_detail 		= array();
		while($record_grn_entry_product_detail = mysql_fetch_array($result_grn_entry_product_detail)) {
			$arr_grn_entry_product_detail[] = $record_grn_entry_product_detail;
		}
		
		$select_grn_entry_product_detail1 	= "	SELECT 
														grn_entry_product_detail_id,
														grn_entry_product_detail_product_id,
														grn_entry_product_detail_width_inches,grn_entry_product_detail_width_mm,
														grn_entry_product_detail_s_width_inches,grn_entry_product_detail_s_width_mm,
														grn_entry_product_detail_sl_feet,grn_entry_product_detail_sl_feet_in,
														grn_entry_product_detail_sl_feet_mm,grn_entry_product_detail_s_weight_inches,
														grn_entry_product_detail_s_weight_mm,grn_entry_product_detail_tot_length,
														grn_entry_product_detail_gin_detail_id,grn_entry_product_detail_qty,
														grn_entry_product_detail_product_thick,
														product_con_entry_child_product_detail_code as product_code,
														product_con_entry_child_product_detail_name as product_name,
														child_uom.product_uom_name as p_uom_name,
														c_clr.product_colour_name as p_colour_name,
														brand_name,grn_entry_product_detail_product_type,
														grn_entry_product_detail_ext_feet,
														grn_entry_product_detail_ext_feet_in,
														grn_entry_product_detail_ext_feet_mm,
														grn_entry_product_detail_ext_feet_met,
														grn_entry_product_detail_sl_feet_met,
														grn_entry_product_detail_tot_feet,
														grn_entry_product_detail_tot_meter,
														grn_entry_product_detail_mother_child_type
													FROM 
														grn_entry_product_details 
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= grn_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_con_entry_child_product_detail_product_brand_id
														
													
													LEFT JOIN 
														product_uoms as  child_uom
													ON 
														child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
													
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= grn_entry_product_detail_product_colour_id
														
													WHERE 
														grn_entry_product_detail_deleted_status	   = 0 							AND 
														grn_entry_product_detail_mother_child_type = 2 		AND 
														grn_entry_product_detail_grn_entry_id 	   = '".$grn_entry_id."'";
		$result_grn_entry_product_detail1 	= mysql_query($select_grn_entry_product_detail1);
		$count_grn_entry1 					= mysql_num_rows($result_grn_entry_product_detail1);
		
		while($record_grn_entry_product_detail1 = mysql_fetch_array($result_grn_entry_product_detail1)) {
			$arr_grn_entry_product_detail[] = $record_grn_entry_product_detail1;
		}
		
		
		return $arr_grn_entry_product_detail;

	}

	function editQuotationRawProductDetail()

	{

		$grn_entry_id 	= getId('grn_entry', 'grn_entry_id', 'grn_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_grn_entry_raw_product_detail 	= "	SELECT 
														grn_entry_raw_product_detail_id,
														grn_entry_raw_product_detail_product_id,
														grn_entry_raw_product_detail_width_inches,grn_entry_raw_product_detail_width_mm,
														grn_entry_raw_product_detail_sl_feet,
														grn_entry_raw_product_detail_sl_feet_mm,
														grn_entry_raw_product_detail_ton,grn_entry_raw_product_detail_kg,
														grn_entry_raw_product_detail_product_thick,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														brand_name,
														product_colour_name,
														product_uom_name,
														grn_entry_raw_product_detail_product_type,
														grn_entry_raw_product_detail_gin_detail_id,
														product_con_entry_child_product_detail_color_id,
														grn_entry_raw_product_detail_mother_child_type
													FROM 
														grn_entry_raw_product_details 
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= grn_entry_raw_product_detail_product_id	
													LEFT JOIN 
														products 
													ON 
														product_id 							= product_con_entry_child_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 							=  	product_con_entry_child_product_detail_product_brand_id
													LEFT JOIN 
														product_uoms 
													ON 
														product_uom_id 						= product_con_entry_child_product_detail_uom_id
			
													LEFT JOIN 
			
														product_colours 
													ON 
														product_colour_id 					= product_con_entry_child_product_detail_color_id 
														
													WHERE 
														grn_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														grn_entry_raw_product_detail_grn_entry_id 		= '".$grn_entry_id."'";
		$result_grn_entry_raw_product_detail 	= mysql_query($select_grn_entry_raw_product_detail);
		$count_grn_entry 					= mysql_num_rows($result_grn_entry_raw_product_detail);
		$arr_grn_entry_raw_product_detail 		= array();
		while($record_grn_entry_raw_product_detail = mysql_fetch_array($result_grn_entry_raw_product_detail)) {
			$arr_grn_entry_raw_product_detail[] = $record_grn_entry_raw_product_detail;
		}
		return $arr_grn_entry_raw_product_detail;

	}



	function updateQuotation(){

		$grn_entry_id                   				= trim($_POST['grn_entry_id']);
		$grn_entry_no                   				= trim($_POST['grn_entry_no']);
		$grn_entry_uniq_id                				= trim($_POST['grn_entry_uniq_id']);

		$grn_entry_branch_id                   			= trim($_POST['grn_entry_branch_id']);

		$grn_entry_date                 				= NdateDatabaseFormat($_POST['grn_entry_date']);

		$grn_entry_production_section_id            	= trim($_POST['grn_entry_production_section_id']);

		$grn_entry_from_godown_id          				= trim($_POST['grn_entry_from_godown_id']);

		$grn_entry_to_godown_id      					= trim($_POST['grn_entry_to_godown_id']);

		$grn_entry_type     							= 0;

		$grn_entry_gin_entry_id     					= trim($_POST['grn_entry_gin_entry_id']);
		//Product Detail

		$grn_entry_product_detail_id      						= $_POST['grn_entry_product_detail_id'];
		$grn_entry_product_detail_product_type      = $_POST['grn_entry_product_detail_product_type'];
		$grn_entry_product_detail_gin_detail_id     = $_POST['grn_entry_product_detail_gin_detail_id'];
		$grn_entry_product_detail_product_id     	= $_POST['grn_entry_product_detail_product_id'];
		$grn_entry_product_detail_product_thick  	= isset($_POST['grn_entry_product_detail_product_thick'])?$_POST['grn_entry_product_detail_product_thick']:'';
		$grn_entry_product_detail_width_inches  	= isset($_POST['grn_entry_product_detail_width_inches'])?$_POST['grn_entry_product_detail_width_inches']:'';
		$grn_entry_product_detail_width_mm 		  	= isset($_POST['grn_entry_product_detail_width_mm'])?$_POST['grn_entry_product_detail_width_mm']:'';
		$grn_entry_product_detail_s_width_inches 	= isset($_POST['grn_entry_product_detail_s_width_inches'])?$_POST['grn_entry_product_detail_s_width_inches']:'';
		$grn_entry_product_detail_s_width_mm 		= isset($_POST['grn_entry_product_detail_s_width_mm'])?$_POST['grn_entry_product_detail_s_width_mm']:'';
		$grn_entry_product_detail_sl_feet 		  	= isset($_POST['grn_entry_product_detail_sl_feet'])?$_POST['grn_entry_product_detail_sl_feet']:'';
		$grn_entry_product_detail_sl_feet_in 		= isset($_POST['grn_entry_product_detail_sl_feet_in'])?$_POST['grn_entry_product_detail_sl_feet_in']:'';
		$grn_entry_product_detail_sl_feet_mm 		= isset($_POST['grn_entry_product_detail_sl_feet_mm'])?$_POST['grn_entry_product_detail_sl_feet_mm']:'';
		$grn_entry_product_detail_s_weight_inches   = isset($_POST['grn_entry_product_detail_s_weight_inches'])?$_POST['grn_entry_product_detail_s_weight_inches']:'';
		$grn_entry_product_detail_s_weight_mm   	= isset($_POST['grn_entry_product_detail_s_weight_mm'])?$_POST['grn_entry_product_detail_s_weight_mm']:'';
		$grn_entry_product_detail_qty 			  	= $_POST['grn_entry_product_detail_qty'];
		$grn_entry_product_detail_tot_length 		= isset($_POST['grn_entry_product_detail_tot_length'])?$_POST['grn_entry_product_detail_tot_length']:'';
		$grn_entry_product_detail_tot_feet 			  	= $_POST['grn_entry_product_detail_tot_feet'];
		$grn_entry_product_detail_tot_meter 			  	= $_POST['grn_entry_product_detail_tot_meter'];
		$grn_entry_product_detail_mother_child_type 			  	= $_POST['grn_entry_product_detail_mother_child_type'];
		
		$grn_entry_product_detail_s_weight_ton 		= isset($_POST['grn_entry_product_detail_s_weight_ton'])?$_POST['grn_entry_product_detail_s_weight_ton']:'';
		$grn_entry_product_detail_s_weight_kg 		= isset($_POST['grn_entry_product_detail_s_weight_kg'])?$_POST['grn_entry_product_detail_s_weight_kg']:'';
		$grn_entry_product_detail_tot_length_feet 	= isset($_POST['grn_entry_product_detail_tot_length_feet'])?$_POST['grn_entry_product_detail_tot_length_feet']:'';
		$grn_entry_product_detail_tot_length_meter 	= isset($_POST['grn_entry_product_detail_tot_length_meter'])?$_POST['grn_entry_product_detail_tot_length_meter']:'';
		
		$grn_entry_raw_product_detail_id      			= $_POST['grn_entry_raw_product_detail_id'];
		$grn_entry_raw_product_detail_product_type      = $_POST['grn_entry_raw_product_detail_product_type'];
		$grn_entry_raw_product_detail_gin_detail_id     = $_POST['grn_entry_raw_product_detail_gin_detail_id'];
		$grn_entry_raw_product_detail_product_id     	= $_POST['grn_entry_raw_product_detail_product_id'];
		$grn_entry_raw_product_detail_product_colour_id     	= $_POST['grn_entry_raw_product_detail_product_colour_id'];
		$grn_entry_raw_product_detail_product_thick  	= isset($_POST['grn_entry_raw_product_detail_product_thick'])?$_POST['grn_entry_raw_product_detail_product_thick']:'';
		$grn_entry_raw_product_detail_width_inches  	= isset($_POST['grn_entry_raw_product_detail_width_inches'])?$_POST['grn_entry_raw_product_detail_width_inches']:'';
		$grn_entry_raw_product_detail_width_mm 		  	= isset($_POST['grn_entry_raw_product_detail_width_mm'])?$_POST['grn_entry_raw_product_detail_width_mm']:'';
		$grn_entry_raw_product_detail_s_width_inches 	= isset($_POST['grn_entry_raw_product_detail_s_width_inches'])?$_POST['grn_entry_raw_product_detail_s_width_inches']:'';
		$grn_entry_raw_product_detail_s_width_mm 		= isset($_POST['grn_entry_raw_product_detail_s_width_mm'])?$_POST['grn_entry_raw_product_detail_s_width_mm']:'';
		$grn_entry_raw_product_detail_sl_feet 		  	= isset($_POST['grn_entry_raw_product_detail_sl_feet'])?$_POST['grn_entry_raw_product_detail_sl_feet']:'';
		$grn_entry_raw_product_detail_sl_feet_in 		= isset($_POST['grn_entry_raw_product_detail_sl_feet_in'])?$_POST['grn_entry_raw_product_detail_sl_feet_in']:'';
		$grn_entry_raw_product_detail_sl_feet_mm 		= isset($_POST['grn_entry_raw_product_detail_sl_feet_mm'])?$_POST['grn_entry_raw_product_detail_sl_feet_mm']:'';
		$grn_entry_raw_product_detail_s_weight_inches   = isset($_POST['grn_entry_raw_product_detail_s_weight_inches'])?$_POST['grn_entry_raw_product_detail_s_weight_inches']:'';
		$grn_entry_raw_product_detail_s_weight_mm   	= isset($_POST['grn_entry_raw_product_detail_s_weight_mm'])?$_POST['grn_entry_raw_product_detail_s_weight_mm']:'';
		$grn_entry_raw_product_detail_qty 			  	= $_POST['grn_entry_raw_product_detail_qty'];
		$grn_entry_raw_product_detail_tot_length 		= isset($_POST['grn_entry_raw_product_detail_tot_length'])?$_POST['grn_entry_raw_product_detail_tot_length']:'';
		
		$grn_entry_raw_product_detail_ton 			  	= $_POST['grn_entry_raw_product_detail_ton'];
		$grn_entry_raw_product_detail_kg 			  	= $_POST['grn_entry_raw_product_detail_kg'];
		$grn_entry_raw_product_detail_mother_child_type 			  	= $_POST['grn_entry_raw_product_detail_mother_child_type'];

		$request_fields 						= ((!empty($grn_entry_branch_id)) && (!empty($grn_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "goods-receipt-notes/index.php?page=edit&id=$grn_entry_uniq_id");

		$ip												= getRealIpAddr();

		 $update_customer 					= sprintf("	UPDATE 

															grn_entry 

														SET 

															grn_entry_branch_id 					= '%d',

															grn_entry_date 						= '%s',

															grn_entry_production_section_id 		= '%d',

															grn_entry_from_godown_id 				= '%d',

															grn_entry_to_godown_id 				= '%d',

															grn_entry_type 						= '%s',

															grn_entry_modified_by 				= '%d',

															grn_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															grn_entry_modified_ip				= '%s'

														WHERE               

															grn_entry_id         				= '%d'", 

															$grn_entry_branch_id,

															$grn_entry_date,

															$grn_entry_production_section_id,

															$grn_entry_from_godown_id,

															$grn_entry_to_godown_id,

															$grn_entry_type,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$grn_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($grn_entry_product_detail_product_id); $i++) { 
		// echo $grn_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($grn_entry_product_detail_product_id[$i])) );
			if($detail_request_fields) {
				if(isset($grn_entry_product_detail_id[$i]) && (!empty($grn_entry_product_detail_id[$i]))) {

					 $update_grn_entry_product_detail = sprintf("UPDATE 
																			grn_entry_product_details 
																		SET  
																			grn_entry_product_detail_width_inches  			= '%f',
																			grn_entry_product_detail_width_mm  				= '%f',
																			grn_entry_product_detail_s_width_inches  		= '%f',
																			grn_entry_product_detail_s_width_mm  			= '%f',
																			grn_entry_product_detail_sl_feet  				= '%f',
																			grn_entry_product_detail_sl_feet_in  			= '%f',
																			grn_entry_product_detail_sl_feet_mm  			= '%f',
																			grn_entry_product_detail_s_weight_inches  		= '%f',
																			grn_entry_product_detail_s_weight_mm  			= '%f',
																			grn_entry_product_detail_tot_length  				= '%f',
																			grn_entry_product_detail_qty  					= '%f',
																			grn_entry_product_detail_tot_feet				= '%f',
																			grn_entry_product_detail_tot_meter				= '%f',
																			grn_entry_product_detail_modified_by 			= '%d',
																			grn_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			grn_entry_product_detail_modified_ip 			= '%s'
																		WHERE 
																			grn_entry_product_detail_grn_entry_id 			= '%d' AND 
																			grn_entry_product_detail_id 					= '%d'",
																			$grn_entry_product_detail_width_inches[$i],
																			$grn_entry_product_detail_width_mm[$i],
																			$grn_entry_product_detail_s_width_inches[$i],
																			$grn_entry_product_detail_s_width_mm[$i],
																			$grn_entry_product_detail_sl_feet[$i],
																			$grn_entry_product_detail_sl_feet_in[$i],
																			$grn_entry_product_detail_sl_feet_mm[$i],
																			$grn_entry_product_detail_s_weight_inches[$i],
																			$grn_entry_product_detail_s_weight_mm[$i],
																			$grn_entry_product_detail_tot_length[$i],
																			$grn_entry_product_detail_qty[$i],
																			$grn_entry_product_detail_tot_feet[$i],
																			$grn_entry_product_detail_tot_meter[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$grn_entry_id, 
																			$grn_entry_product_detail_id[$i]);	
			//	echo $update_grn_entry_product_detail; exit;
					mysql_query($update_grn_entry_product_detail);

				} else {
				
				
				if(!empty($grn_entry_product_detail_product_id[$i])){
				$grn_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_grn_entry_product_detail 		= sprintf("INSERT INTO grn_entry_product_details 
																				(grn_entry_product_detail_uniq_id,grn_entry_product_detail_grn_entry_id,
																				 grn_entry_product_detail_gin_detail_id,grn_entry_product_detail_gin_entry_id,
																				 grn_entry_product_detail_product_id,grn_entry_product_detail_product_colour_id,
																				 grn_entry_product_detail_product_type, grn_entry_product_detail_product_thick,
																				 grn_entry_product_detail_width_inches,grn_entry_product_detail_width_mm,
																				 grn_entry_product_detail_s_width_inches,grn_entry_product_detail_s_width_mm,
																				 grn_entry_product_detail_sl_feet,grn_entry_product_detail_sl_feet_in,
																				 grn_entry_product_detail_sl_feet_mm,grn_entry_product_detail_sl_feet_met,
																				 grn_entry_product_detail_ext_feet,grn_entry_product_detail_ext_feet_in,
																				 grn_entry_product_detail_ext_feet_mm,grn_entry_product_detail_ext_feet_met,
																				 grn_entry_product_detail_s_weight_inches,grn_entry_product_detail_s_weight_mm,
																				 grn_entry_product_detail_qty,grn_entry_product_detail_tot_length,
																				 grn_entry_product_detail_tot_feet,grn_entry_product_detail_tot_meter,
																				 grn_entry_product_detail_added_by, grn_entry_product_detail_added_on,
																				 grn_entry_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $grn_entry_product_detail_uniq_id,$grn_entry_id,
																		 $grn_entry_product_detail_gin_detail_id[$i],$grn_entry_gin_entry_id,
																		 $grn_entry_product_detail_product_id[$i],$grn_entry_product_detail_product_colour_id[$i],
																		 $grn_entry_product_detail_product_type[$i], $grn_entry_product_detail_product_thick[$i],
																		 $grn_entry_product_detail_width_inches[$i],$grn_entry_product_detail_width_mm[$i],
																		 $grn_entry_product_detail_s_width_inches[$i],$grn_entry_product_detail_s_width_mm[$i],
																		 $grn_entry_product_detail_sl_feet[$i],$grn_entry_product_detail_sl_feet_in[$i],
																		 $grn_entry_product_detail_sl_feet_mm[$i], $grn_entry_product_detail_sl_feet_met[$i],
																		 $grn_entry_product_detail_ext_feet[$i],$grn_entry_product_detail_ext_feet_in[$i],
																		 $grn_entry_product_detail_ext_feet_mm[$i], $grn_entry_product_detail_ext_feet_met[$i],
																		 $grn_entry_product_detail_s_weight_inches[$i],$grn_entry_product_detail_s_weight_mm[$i],
																		 $grn_entry_product_detail_qty[$i],$grn_entry_product_detail_tot_length[$i],
																		 $grn_entry_product_detail_tot_feet[$i],$grn_entry_product_detail_tot_meter[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
																		// echo $insert_grn_entry_product_detail;exit;
																		 
											mysql_query($insert_grn_entry_product_detail);							 
				
				}
				
			 }
			}
		}
		

		// purchase order pproduct details

		// echo $grn_entry_raw_product_detail_qty[$i]; exit;

		for($i = 0; $i < count($grn_entry_raw_product_detail_product_id); $i++) { //echo $grn_entry_raw_product_detail_ton[$i];exit;
		// echo $grn_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($grn_entry_product_detail_product_id[$i])) && 
									 							(!empty($grn_entry_raw_product_detail_ton[$i])));
			if($detail_request_fields) {
			
				if(isset($grn_entry_raw_product_detail_id[$i]) && (!empty($grn_entry_raw_product_detail_id[$i]))) {

				 $update_grn_entry_raw_product_detail = sprintf("UPDATE 
																		grn_entry_raw_product_details 
																	SET  
																		grn_entry_raw_product_detail_width_inches  			= '%f',
																		grn_entry_raw_product_detail_width_mm  				= '%f',
																		grn_entry_raw_product_detail_sl_feet		  		= '%f',
																		grn_entry_raw_product_detail_sl_feet_mm  			= '%f',
																		grn_entry_raw_product_detail_ton	  				= '%f',
																		grn_entry_raw_product_detail_kg			  			= '%f',
																		grn_entry_raw_product_detail_modified_by 			= '%d',
																		grn_entry_raw_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																		grn_entry_raw_product_detail_modified_ip 			= '%s'
																	WHERE 
																		grn_entry_raw_product_detail_grn_entry_id 			= '%d' AND 
																		grn_entry_raw_product_detail_id 					= '%d'",
																		$grn_entry_raw_product_detail_width_inches[$i],
																		$grn_entry_raw_product_detail_width_mm[$i],
																		$grn_entry_raw_product_detail_sl_feet[$i],
																		$grn_entry_raw_product_detail_sl_feet_mm[$i],
																		$grn_entry_raw_product_detail_ton[$i],
																		$grn_entry_raw_product_detail_kg[$i],
																		$_SESSION[SESS.'_session_user_id'], 
																		$ip, 
																		$grn_entry_id, 
																		$grn_entry_raw_product_detail_id[$i]);
		//	echo $update_grn_entry_raw_product_detail; exit;
				mysql_query($update_grn_entry_raw_product_detail);
				$grn_detail_id		= $grn_entry_raw_product_detail_id[$i];
			} else {
				$grn_entry_raw_product_detail_uniq_id 	= generateUniqId();
				$insert_grn_entry_raw_product_detail 		= sprintf("INSERT INTO grn_entry_raw_product_details 
																				(grn_entry_raw_product_detail_uniq_id,grn_entry_raw_product_detail_grn_entry_id,
																				 grn_entry_raw_product_detail_product_id,grn_entry_raw_product_detail_gin_detail_id,
																				 grn_entry_raw_product_detail_gin_entry_id,grn_entry_raw_product_detail_product_colour_id,
																				 grn_entry_raw_product_detail_product_type, grn_entry_raw_product_detail_product_thick,
																				 grn_entry_raw_product_detail_width_inches,grn_entry_raw_product_detail_width_mm,
																				 grn_entry_raw_product_detail_sl_feet,grn_entry_raw_product_detail_sl_feet_mm,
																				 grn_entry_raw_product_detail_ton,grn_entry_raw_product_detail_kg,
																				 grn_entry_raw_product_detail_added_by, grn_entry_raw_product_detail_added_on,
																				 grn_entry_raw_product_detail_added_ip,grn_entry_raw_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d' )", 
																		 $grn_entry_raw_product_detail_uniq_id,$grn_entry_id,
																		 $grn_entry_raw_product_detail_product_id[$i],$grn_entry_raw_product_detail_gin_detail_id[$i],
																		 $grn_entry_gin_entry_id,$grn_entry_raw_product_detail_product_colour_id[$i],
																		 $grn_entry_raw_product_detail_product_type[$i], $grn_entry_raw_product_detail_product_thick[$i],
																		 $grn_entry_raw_product_detail_width_inches[$i],$grn_entry_raw_product_detail_width_mm[$i],
																		 $grn_entry_raw_product_detail_sl_feet[$i],$grn_entry_raw_product_detail_sl_feet_mm[$i],
																		 $grn_entry_raw_product_detail_ton[$i],$grn_entry_raw_product_detail_kg[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$grn_entry_raw_product_detail_mother_child_type[$i]);
				mysql_query($insert_grn_entry_raw_product_detail);
				$grn_detail_id		= mysql_insert_id();
			}
			
							$produt_id											=	$grn_entry_raw_product_detail_product_id[$i];
							$length_feet										= 	$grn_entry_raw_product_detail_sl_feet[$i];
							$length_meter										= 	$grn_entry_raw_product_detail_sl_feet_mm[$i];
							$ton_qty											= 	$grn_entry_raw_product_detail_ton[$i];
							$kg_qty												= 	$grn_entry_raw_product_detail_kg[$i];
							$width_inches										=   $grn_entry_raw_product_detail_width_inches[$i];
							$width_mm											=   $grn_entry_raw_product_detail_width_mm[$i];
							$color_id											= 	$grn_entry_raw_product_detail_product_colour_id[$i];
							$thick												= 	$grn_entry_raw_product_detail_product_thick[$i];
							$mother_child_type									= 	$grn_entry_raw_product_detail_mother_child_type[$i];
							$product_detail_qty									= 	"1";
							$stock_ledger_entry_type							= 	"manufacture-grn-raw";
							$product_con_entry_godown_id						= 	$grn_entry_from_godown_id;
							stockLedger($mother_child_type,'out',$grn_entry_id,$grn_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$product_detail_qty), $grn_entry_branch_id,  $product_con_entry_godown_id, NdateDatabaseFormat($grn_entry_date), $grn_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
							$product_con_entry_godown_id						= 	$grn_entry_to_godown_id;
							stockLedger($mother_child_type,'in',$grn_entry_id,$grn_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $grn_entry_branch_id,  $product_con_entry_godown_id, NdateDatabaseFormat($grn_entry_date), $grn_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
			
		 }
		}
		pageRedirection("goods-receipt-notes/index.php?page=edit&id=$grn_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['grn_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$grn_entry_uniq_id = $_GET['grn_entry_uniq_id'];
		
			if($_REQUEST['type']==1){
			mysql_query("UPDATE grn_entry_product_details SET grn_entry_product_detail_deleted_status = 1 

						WHERE grn_entry_product_detail_id = ".$product_detail_id." ");
			
			}else{
			
			mysql_query("UPDATE grn_entry_raw_product_details SET grn_entry_raw_product_detail_deleted_status = 1 

						WHERE grn_entry_raw_product_detail_id = ".$product_detail_id." ");
				$grn_entry_id 	= getId('grn_entry', 'grn_entry_id', 'grn_entry_uniq_id', dataValidation($_GET['grn_entry_uniq_id'])); 
						
					     $update_cs_detail 	= "UPDATE  stock_ledger
													SET 
														stock_ledger_status    					= '1',
														stock_ledger_deleted_by    	   			= '".$_SESSION[SESS.'_session_user_id']."',
														stock_ledger_deleted_on 				= UNIX_TIMESTAMP(NOW()),
														stock_ledger_deleted_ip    				= '".$ip."'
												WHERE               
														stock_ledger_entry_type             	= 'manufacture-grn-raw' 										AND
														stock_ledger_entry_id					= '".$grn_entry_id."'											AND
														stock_ledger_entry_detail_id			= '".$product_detail_id."'";
							mysql_query($update_cs_detail);
						
						
			
			}
			
			header("Location:index.php?page=edit&id=$grn_entry_uniq_id&msg=6");
		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('grn_entry', 'grn_entry_deleted_by', 'grn_entry_deleted_on' , 'grn_entry_deleted_ip','grn_entry_deleted_status', 'grn_entry_id', 'grn_entry_uniq_id', '1');

		

		deleteMultiRecords('grn_entry_product_details', 'grn_entry_product_detail_deleted_by', 'grn_entry_product_detail_deleted_on', 'grn_entry_product_detail_deleted_ip', 'grn_entry_product_detail_deleted_status', 'grn_entry_product_detail_grn_entry_id', 'grn_entry','grn_entry_id','grn_entry_uniq_id', '1'); 
		
		
				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck 					= $checked[$i]; 
					$grn_entry_id 					= getId('grn_entry', 'grn_entry_id', 'grn_entry_uniq_id', $deleteCheck); 
					$select_grn_ch_detal			= "SELECT
															*
														FROM
															grn_entry_raw_product_details
														WHERE
															grn_entry_raw_product_detail_deleted_status		= 0	AND
															grn_entry_raw_product_detail_grn_entry_id				= '".$grn_entry_id."'";
					 $result_grn_ch_detal 			= mysql_query($select_grn_ch_detal);
					 $response =array();
					 while($resultChData = mysql_fetch_array($result_grn_ch_detal)){
					     $update_cs_detail 	= "UPDATE  stock_ledger
													SET 
														stock_ledger_status    					= '1',
														stock_ledger_deleted_by    	   			= '".$_SESSION[SESS.'_session_user_id']."',
														stock_ledger_deleted_on 				= UNIX_TIMESTAMP(NOW()),
														stock_ledger_deleted_ip    				= '".$ip."'
												WHERE               
														stock_ledger_entry_type             	= 'manufacture-grn-raw' 										AND
														stock_ledger_entry_id					= '".$grn_entry_id."'											AND
														stock_ledger_entry_detail_id			= '".$resultChData['grn_entry_raw_product_detail_id']."'";
							mysql_query($update_cs_detail);
					 }
				}

			
		
		deleteMultiRecords('grn_entry_raw_product_details', 'grn_entry_raw_product_detail_deleted_by', 'grn_entry_raw_product_detail_deleted_on', 'grn_entry_raw_product_detail_deleted_ip', 'grn_entry_raw_product_detail_deleted_status', 'grn_entry_raw_product_detail_grn_entry_id', 'grn_entry','grn_entry_id','grn_entry_uniq_id', '1');  


		pageRedirection("goods-receipt-notes/index.php?msg=7");				

	}

?>