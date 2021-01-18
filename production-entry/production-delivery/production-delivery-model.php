<?php

	function insertQuotation(){

		$pdo_entry_branch_id                   			= trim($_POST['pdo_entry_branch_id']);
		$pdo_entry_date                 				= NdateDatabaseFormat($_POST['pdo_entry_date']);
		$pdo_entry_customer_id            				= trim($_POST['pdo_entry_customer_id']);
		$pdo_entry_godown_id          					= trim($_POST['pdo_entry_godown_id']);
		$pdo_entry_vehicle_no      						= trim($_POST['pdo_entry_vehicle_no']);
		$pdo_entry_delivery_type     					= trim($_POST['pdo_entry_delivery_type']);
		$pdo_entry_type_id     							= trim($_POST['pdo_entry_type_id']);
		$pdo_entry_driver_name     						= trim($_POST['pdo_entry_driver_name']);
		$pdo_entry_production_entry_id     				= trim($_POST['pdo_entry_production_entry_id']);
		
		
		//Product Detail
		$pdo_entry_product_detail_product_type      	= $_POST['pdo_entry_product_detail_product_type'];
		$pdo_entry_product_detail_production_detail_id     	= $_POST['pdo_entry_product_detail_production_detail_id'];
		$pdo_entry_product_detail_product_id     	= $_POST['pdo_entry_product_detail_product_id'];
		$pdo_entry_product_detail_product_colour_id	= $_POST['pdo_entry_product_detail_product_colour_id'];
		$pdo_entry_product_detail_product_thick  	= isset($_POST['pdo_entry_product_detail_product_thick'])?$_POST['pdo_entry_product_detail_product_thick']:'';
		$pdo_entry_product_detail_width_inches  		= isset($_POST['pdo_entry_product_detail_width_inches'])?$_POST['pdo_entry_product_detail_width_inches']:'';
		$pdo_entry_product_detail_width_mm 		  	= isset($_POST['pdo_entry_product_detail_width_mm'])?$_POST['pdo_entry_product_detail_width_mm']:'';
		$pdo_entry_product_detail_s_width_inches 	= isset($_POST['pdo_entry_product_detail_s_width_inches'])?$_POST['pdo_entry_product_detail_s_width_inches']:'';
		$pdo_entry_product_detail_s_width_mm 		= isset($_POST['pdo_entry_product_detail_s_width_mm'])?$_POST['pdo_entry_product_detail_s_width_mm']:'';
		$pdo_entry_product_detail_sl_feet 		  	= isset($_POST['pdo_entry_product_detail_sl_feet'])?$_POST['pdo_entry_product_detail_sl_feet']:'';
		$pdo_entry_product_detail_sl_feet_in 		= isset($_POST['pdo_entry_product_detail_sl_feet_in'])?$_POST['pdo_entry_product_detail_sl_feet_in']:'';
		$pdo_entry_product_detail_sl_feet_mm 		= isset($_POST['pdo_entry_product_detail_sl_feet_mm'])?$_POST['pdo_entry_product_detail_sl_feet_mm']:'';
		$pdo_entry_product_detail_sl_feet_met 		= isset($_POST['pdo_entry_product_detail_sl_feet_met'])?$_POST['pdo_entry_product_detail_sl_feet_met']:'';
		$pdo_entry_product_detail_ext_feet 		  	= isset($_POST['pdo_entry_product_detail_ext_feet'])?$_POST['pdo_entry_product_detail_ext_feet']:'';
		$pdo_entry_product_detail_ext_feet_in 		= isset($_POST['pdo_entry_product_detail_ext_feet_in'])?$_POST['pdo_entry_product_detail_ext_feet_in']:'';
		$pdo_entry_product_detail_ext_feet_mm 		= isset($_POST['pdo_entry_product_detail_ext_feet_mm'])?$_POST['pdo_entry_product_detail_ext_feet_mm']:'';
		$pdo_entry_product_detail_ext_feet_met 		= isset($_POST['pdo_entry_product_detail_ext_feet_met'])?$_POST['pdo_entry_product_detail_ext_feet_met']:'';
		$pdo_entry_product_detail_s_weight_inches 	= isset($_POST['pdo_entry_product_detail_s_weight_inches'])?$_POST['pdo_entry_product_detail_s_weight_inches']:'';
		$pdo_entry_product_detail_s_weight_mm   		= isset($_POST['pdo_entry_product_detail_s_weight_mm'])?$_POST['pdo_entry_product_detail_s_weight_mm']:'';
		$pdo_entry_product_detail_qty 			  	= $_POST['pdo_entry_product_detail_qty'];
		$pdo_entry_product_detail_tot_length 		= isset($_POST['pdo_entry_product_detail_tot_length'])?$_POST['pdo_entry_product_detail_tot_length']:'';

		

		$request_fields 									= ((!empty($pdo_entry_branch_id)) && (!empty($pdo_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "production-delivery/index.php?page=add&msg=5");

		$pdo_entry_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();

		

		$select_pdo_entry_no						= "SELECT 

																	MAX(pdo_entry_no) AS maxval 

															   FROM 

																	pdo_entry 

															   WHERE 

																	pdo_entry_deleted_status 	= 0 												AND

																	pdo_entry_branch_id 		= '".$pdo_entry_branch_id."'						AND

																	pdo_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND

																	pdo_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_pdo_entry_no 						= mysql_query($select_pdo_entry_no);

		$record_pdo_entry_no 						= mysql_fetch_array($result_pdo_entry_no);	

		$maxval 											= $record_pdo_entry_no['maxval']; 

		if($maxval > 0) {

			$pdo_entry_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$pdo_entry_no 							= substr(('00000'.++$maxval),-5);

		}

		

		

		$insert_pdo_entry 					= sprintf("INSERT INTO pdo_entry  (pdo_entry_uniq_id, pdo_entry_date,

																			  pdo_entry_customer_id,pdo_entry_godown_id,

																			  pdo_entry_vehicle_no,pdo_entry_delivery_type,

																			  pdo_entry_driver_name,

																			  pdo_entry_production_entry_id, pdo_entry_no,

																			  pdo_entry_branch_id,pdo_entry_added_by,

																			  pdo_entry_added_on,pdo_entry_added_ip,

																			  pdo_entry_company_id,pdo_entry_financial_year,
																			  pdo_entry_type_id) 

															VALUES 	 		 ('%s', '%s', 

																			  '%d', '%d', 

																			  '%s', '%d',

																			  '%s',

																			  '%d', '%s',

																			  '%d', '%d', 

																			   UNIX_TIMESTAMP(NOW()),

																			  '%s', '%d', '%d',
																			  '%d')", 

																			 $pdo_entry_uniq_id, $pdo_entry_date,

																			 $pdo_entry_customer_id,$pdo_entry_godown_id,

																			 $pdo_entry_vehicle_no,$pdo_entry_delivery_type,

																			 $pdo_entry_driver_name,

																			 $pdo_entry_production_entry_id,$pdo_entry_no,

																			 $pdo_entry_branch_id,$_SESSION[SESS.'_session_user_id'],

																			 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																			 $pdo_entry_type_id);  

		mysql_query($insert_pdo_entry);

		//echo $insert_pdo_entry; exit;

		$pdo_entry_id 						= mysql_insert_id(); 
		for($i = 0; $i < count($pdo_entry_product_detail_product_id); $i++) { 
		// echo $pdo_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($pdo_entry_product_detail_product_id[$i])) && 
									 							(!empty($pdo_entry_product_detail_qty[$i])));
			if($detail_request_fields) {
				$pdo_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_pdo_entry_product_detail 		= sprintf("INSERT INTO pdo_entry_product_details 
																				(pdo_entry_product_detail_uniq_id,pdo_entry_product_detail_pdo_entry_id,
																				 pdo_entry_product_detail_production_detail_id,pdo_entry_product_detail_production_entry_id,
																				 pdo_entry_product_detail_product_id,
																				 pdo_entry_product_detail_product_type, pdo_entry_product_detail_product_thick,
																				 pdo_entry_product_detail_width_inches,pdo_entry_product_detail_width_mm,
																				 pdo_entry_product_detail_s_width_inches,pdo_entry_product_detail_s_width_mm,
																				 pdo_entry_product_detail_sl_feet,pdo_entry_product_detail_sl_feet_in,
																				 pdo_entry_product_detail_sl_feet_mm,
																				 pdo_entry_product_detail_s_weight_inches,pdo_entry_product_detail_s_weight_mm,
																				 pdo_entry_product_detail_qty,pdo_entry_product_detail_tot_length,
																				 pdo_entry_product_detail_added_by, pdo_entry_product_detail_added_on,
																				 pdo_entry_product_detail_added_ip) 
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
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $pdo_entry_product_detail_uniq_id,$pdo_entry_id,
																		 $pdo_entry_product_detail_production_detail_id[$i],$pdo_entry_production_entry_id,
																		 $pdo_entry_product_detail_product_id[$i],
																		 $pdo_entry_product_detail_product_type[$i], $pdo_entry_product_detail_product_thick[$i],
																		 $pdo_entry_product_detail_width_inches[$i],$pdo_entry_product_detail_width_mm[$i],
																		 $pdo_entry_product_detail_s_width_inches[$i],$pdo_entry_product_detail_s_width_mm[$i],
																		 $pdo_entry_product_detail_sl_feet[$i],$pdo_entry_product_detail_sl_feet_in[$i],
																		 $pdo_entry_product_detail_sl_feet_mm[$i],
																		 $pdo_entry_product_detail_s_weight_inches[$i],$pdo_entry_product_detail_s_weight_mm[$i],
																		 $pdo_entry_product_detail_qty[$i],$pdo_entry_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
																		// echo $insert_pdo_entry_product_detail; exit;
				mysql_query($insert_pdo_entry_product_detail);
			}
		}
		exit;
		pageRedirection("production-delivery/index.php?page=add&msg=1");

	}

	function listQuotation(){

		$select_pdo_entry		=	"SELECT 

												pdo_entry_id,

												pdo_entry_uniq_id,

												pdo_entry_no,

												pdo_entry_date,

												pdo_entry_godown_id,

												customer_name,

												pdo_entry_delivery_type

											 FROM 

												pdo_entry

											 LEFT JOIN

												customers

											 ON

												customer_id						=  pdo_entry_customer_id

											 WHERE 

												pdo_entry_deleted_status 		= 	0	

											 ORDER BY 

												pdo_entry_no ASC";

		$result_pdo_entry		= mysql_query($select_pdo_entry);

		// Filling up the array

		$pdo_entry_data 		= array();

		while ($record_pdo_entry = mysql_fetch_array($result_pdo_entry))

		{

		 $pdo_entry_data[] 	= $record_pdo_entry;

		}

		return $pdo_entry_data;

	}

	function editQuotation(){

		$pdo_entry_id 			= getId('pdo_entry', 'pdo_entry_id', 'pdo_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_pdo_entry		=	"SELECT 

												pdo_entry_uniq_id,  pdo_entry_date,

												pdo_entry_customer_id,pdo_entry_godown_id,

												pdo_entry_vehicle_no,pdo_entry_delivery_type,

												pdo_entry_production_entry_id, pdo_entry_no,

												pdo_entry_branch_id,pdo_entry_id,

												pdo_entry_driver_name,pdo_entry_type_id

											 FROM 

												pdo_entry 

											 WHERE 

												pdo_entry_deleted_status 	=  0 			AND 

												pdo_entry_id				= '".$pdo_entry_id."'

											 ORDER BY 

												pdo_entry_no ASC";

		$result_pdo_entry 		= mysql_query($select_pdo_entry);

		$record_pdo_entry 		= mysql_fetch_array($result_pdo_entry);

		return $record_pdo_entry;

	}

	function editSalesdetail(){

		$pdo_entry_id 			= getId('pdo_entry', 'pdo_entry_id', 'pdo_entry_uniq_id', dataValidation($_GET['id'])); 

		$production_entry_id 	= getId('pdo_entry', 'pdo_entry_production_entry_id', 'pdo_entry_uniq_id', dataValidation($_GET['id'])); 

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

		$pdo_entry_id 	= getId('pdo_entry', 'pdo_entry_id', 'pdo_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_pdo_entry_product_detail 	= "	SELECT 
														pdo_entry_product_detail_id,
														pdo_entry_product_detail_product_id,
														pdo_entry_product_detail_width_inches,pdo_entry_product_detail_width_mm,
														pdo_entry_product_detail_s_width_inches,pdo_entry_product_detail_s_width_mm,
														pdo_entry_product_detail_sl_feet,pdo_entry_product_detail_sl_feet_in,
														pdo_entry_product_detail_sl_feet_mm,pdo_entry_product_detail_s_weight_inches,
														pdo_entry_product_detail_s_weight_mm,pdo_entry_product_detail_tot_length,
														pdo_entry_product_detail_production_detail_id,pdo_entry_product_detail_qty,
														pdo_entry_product_detail_product_thick,
														product_name,
														product_code,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														p_uom.product_uom_name as p_uom_name,
														child_uom.product_uom_name as c_uom_name,
														p_clr.product_colour_name as p_colour_name,
														c_clr.product_colour_name as c_colour_name,
														brand_name,pdo_entry_product_detail_product_type 
													FROM 
														pdo_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= pdo_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_brand_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= pdo_entry_product_detail_product_id	
													LEFT JOIN 
														product_uoms as p_uom
													ON 
														p_uom.product_uom_id 									= product_product_uom_id
													LEFT JOIN 
														product_uoms as  child_uom
													ON 
														child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
													LEFT JOIN 
														product_colours as p_clr 
													ON 
														p_clr.product_colour_id 								= product_product_colour_id
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
														
													WHERE 
														pdo_entry_product_detail_deleted_status		 	= 0 							AND 
														pdo_entry_product_detail_pdo_entry_id 		= '".$pdo_entry_id."'";
		$result_pdo_entry_product_detail 	= mysql_query($select_pdo_entry_product_detail);
		$count_pdo_entry 					= mysql_num_rows($result_pdo_entry_product_detail);
		$arr_pdo_entry_product_detail 		= array();
		while($record_pdo_entry_product_detail = mysql_fetch_array($result_pdo_entry_product_detail)) {
			$arr_pdo_entry_product_detail[] = $record_pdo_entry_product_detail;
		}
		return $arr_pdo_entry_product_detail;
	}



	function updateQuotation(){

		$pdo_entry_id                   						= trim($_POST['pdo_entry_id']);

		$pdo_entry_uniq_id                						= trim($_POST['pdo_entry_uniq_id']);

		$pdo_entry_branch_id                   			= trim($_POST['pdo_entry_branch_id']);

		$pdo_entry_date                 				= NdateDatabaseFormat($_POST['pdo_entry_date']);

		$pdo_entry_customer_id            				= trim($_POST['pdo_entry_customer_id']);

		$pdo_entry_godown_id          					= trim($_POST['pdo_entry_godown_id']);

		$pdo_entry_vehicle_no      						= trim($_POST['pdo_entry_vehicle_no']);

		$pdo_entry_delivery_type     					= trim($_POST['pdo_entry_delivery_type']);

		$pdo_entry_driver_name     						= trim($_POST['pdo_entry_driver_name']);

		$pdo_entry_production_entry_id     				= trim($_POST['pdo_entry_production_entry_id']);

		

		//Product Detail

		$pdo_entry_product_detail_id      						= $_POST['pdo_entry_product_detail_id'];

		$pdo_entry_product_detail_product_type      	= $_POST['pdo_entry_product_detail_product_type'];
		$pdo_entry_product_detail_production_detail_id   = $_POST['pdo_entry_product_detail_production_detail_id'];
		$pdo_entry_product_detail_product_id     		= $_POST['pdo_entry_product_detail_product_id'];
		$pdo_entry_product_detail_product_thick  		= isset($_POST['pdo_entry_product_detail_product_thick'])?$_POST['pdo_entry_product_detail_product_thick']:'';
		$pdo_entry_product_detail_width_inches  		= isset($_POST['pdo_entry_product_detail_width_inches'])?$_POST['pdo_entry_product_detail_width_inches']:'';
		$pdo_entry_product_detail_width_mm 		  		= isset($_POST['pdo_entry_product_detail_width_mm'])?$_POST['pdo_entry_product_detail_width_mm']:'';
		$pdo_entry_product_detail_s_width_inches 		= isset($_POST['pdo_entry_product_detail_s_width_inches'])?$_POST['pdo_entry_product_detail_s_width_inches']:'';
		$pdo_entry_product_detail_s_width_mm 			= isset($_POST['pdo_entry_product_detail_s_width_mm'])?$_POST['pdo_entry_product_detail_s_width_mm']:'';
		$pdo_entry_product_detail_sl_feet 		  		= isset($_POST['pdo_entry_product_detail_sl_feet'])?$_POST['pdo_entry_product_detail_sl_feet']:'';
		$pdo_entry_product_detail_sl_feet_in 			= isset($_POST['pdo_entry_product_detail_sl_feet_in'])?$_POST['pdo_entry_product_detail_sl_feet_in']:'';
		$pdo_entry_product_detail_sl_feet_mm 			= isset($_POST['pdo_entry_product_detail_sl_feet_mm'])?$_POST['pdo_entry_product_detail_sl_feet_mm']:'';
		$pdo_entry_product_detail_s_weight_inches   	= isset($_POST['pdo_entry_product_detail_s_weight_inches'])?$_POST['pdo_entry_product_detail_s_weight_inches']:'';
		$pdo_entry_product_detail_s_weight_mm   		= isset($_POST['pdo_entry_product_detail_s_weight_mm'])?$_POST['pdo_entry_product_detail_s_weight_mm']:'';
		$pdo_entry_product_detail_qty 			  		= $_POST['pdo_entry_product_detail_qty'];
		$pdo_entry_product_detail_tot_length 			= isset($_POST['pdo_entry_product_detail_tot_length'])?$_POST['pdo_entry_product_detail_tot_length']:'';


		$request_fields 						= ((!empty($pdo_entry_branch_id)) && (!empty($pdo_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "production-delivery/index.php?page=edit&id=$pdo_entry_uniq_id");

		$ip												= getRealIpAddr();

		 $update_customer 					= sprintf("	UPDATE 

															pdo_entry 

														SET 

															pdo_entry_branch_id 				= '%d',

															pdo_entry_date 						= '%s',

															pdo_entry_customer_id 				= '%d',

															pdo_entry_godown_id 				= '%d',

															pdo_entry_vehicle_no 				= '%s',

															pdo_entry_delivery_type 			= '%s',

															pdo_entry_driver_name 				= '%s',

															pdo_entry_modified_by 				= '%d',

															pdo_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															pdo_entry_modified_ip				= '%s'

														WHERE               

															pdo_entry_id         				= '%d'", 

															$pdo_entry_branch_id,

															$pdo_entry_date,

															$pdo_entry_customer_id,

															$pdo_entry_godown_id,

															$pdo_entry_vehicle_no,

															$pdo_entry_delivery_type,

															$pdo_entry_driver_name,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$pdo_entry_id);//exit; 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($pdo_entry_product_detail_product_id); $i++) { 
		// echo $pdo_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($pdo_entry_product_detail_product_id[$i])) && 
									 							(!empty($pdo_entry_product_detail_qty[$i])));
			if($detail_request_fields) {
				if(isset($pdo_entry_product_detail_id[$i]) && (!empty($pdo_entry_product_detail_id[$i]))) {

					$update_pdo_entry_product_detail = sprintf("UPDATE 
																			pdo_entry_product_details 
																		SET  
																			pdo_entry_product_detail_width_inches  			= '%f',
																			pdo_entry_product_detail_width_mm  				= '%f',
																			pdo_entry_product_detail_s_width_inches  		= '%f',
																			pdo_entry_product_detail_s_width_mm  			= '%f',
																			pdo_entry_product_detail_sl_feet  				= '%f',
																			pdo_entry_product_detail_sl_feet_in  			= '%f',
																			pdo_entry_product_detail_sl_feet_mm  			= '%f',
																			pdo_entry_product_detail_s_weight_inches  		= '%f',
																			pdo_entry_product_detail_s_weight_mm  			= '%f',
																			pdo_entry_product_detail_tot_length  				= '%f',
																			pdo_entry_product_detail_qty  					= '%f',
																			pdo_entry_product_detail_modified_by 			= '%d',
																			pdo_entry_product_detail_modified_on 			= NIX_TIMESTAMP(NOW()),
																			pdo_entry_product_detail_modified_ip 			= '%s'
																		WHERE 
																			pdo_entry_product_detail_pdo_entry_id 			= '%d' AND 
																			pdo_entry_product_detail_id 					= '%d'",
																			$pdo_entry_product_detail_width_inches[$i],
																			$pdo_entry_product_detail_width_mm[$i],
																			$pdo_entry_product_detail_s_width_inches[$i],
																			$pdo_entry_product_detail_s_width_mm[$i],
																			$pdo_entry_product_detail_sl_feet[$i],
																			$pdo_entry_product_detail_sl_feet_in[$i],
																			$pdo_entry_product_detail_sl_feet_mm[$i],
																			$pdo_entry_product_detail_s_weight_inches[$i],
																			$pdo_entry_product_detail_s_weight_mm[$i],
																			$pdo_entry_product_detail_tot_length[$i],
																			$pdo_entry_product_detail_qty[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$pdo_entry_id, 
																			$pdo_entry_product_detail_id[$i]);	
			//	echo $update_pdo_entry_product_detail; exit;
					mysql_query($update_pdo_entry_product_detail);

				} else {
				$pdo_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_pdo_entry_product_detail 		= sprintf("INSERT INTO pdo_entry_product_details 
																				(pdo_entry_product_detail_uniq_id,pdo_entry_product_detail_pdo_entry_id,
																				 pdo_entry_product_detail_production_detail_id,pdo_entry_product_detail_production_entry_id,
																				 pdo_entry_product_detail_product_id,
																				 pdo_entry_product_detail_product_type, pdo_entry_product_detail_product_thick,
																				 pdo_entry_product_detail_width_inches,pdo_entry_product_detail_width_mm,
																				 pdo_entry_product_detail_s_width_inches,pdo_entry_product_detail_s_width_mm,
																				 pdo_entry_product_detail_sl_feet,pdo_entry_product_detail_sl_feet_in,
																				 pdo_entry_product_detail_sl_feet_mm,
																				 pdo_entry_product_detail_s_weight_inches,pdo_entry_product_detail_s_weight_mm,
																				 pdo_entry_product_detail_qty,pdo_entry_product_detail_tot_length,
																				 pdo_entry_product_detail_added_by, pdo_entry_product_detail_added_on,
																				 pdo_entry_product_detail_added_ip) 
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
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $pdo_entry_product_detail_uniq_id,$pdo_entry_id,
																		 $pdo_entry_product_detail_production_detail_id[$i],$pdo_entry_production_entry_id,
																		 $pdo_entry_product_detail_product_id[$i],
																		 $pdo_entry_product_detail_product_type[$i], $pdo_entry_product_detail_product_thick[$i],
																		 $pdo_entry_product_detail_width_inches[$i],$pdo_entry_product_detail_width_mm[$i],
																		 $pdo_entry_product_detail_s_width_inches[$i],$pdo_entry_product_detail_s_width_mm[$i],
																		 $pdo_entry_product_detail_sl_feet[$i],$pdo_entry_product_detail_sl_feet_in[$i],
																		 $pdo_entry_product_detail_sl_feet_mm[$i],
																		 $pdo_entry_product_detail_s_weight_inches[$i],$pdo_entry_product_detail_s_weight_mm[$i],
																		 $pdo_entry_product_detail_qty[$i],$pdo_entry_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
																		// echo $insert_pdo_entry_product_detail; exit;
				mysql_query($insert_pdo_entry_product_detail);
			}
		 }
		}

		

		

		//Raw Product Detail


		pageRedirection("production-delivery/index.php?page=edit&id=$pdo_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['pdo_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$pdo_entry_uniq_id = $_GET['pdo_entry_uniq_id'];

			mysql_query("UPDATE pdo_entry_product_details SET pdo_entry_product_detail_deleted_status = 1 

						WHERE pdo_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$pdo_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('pdo_entry', 'pdo_entry_deleted_by', 'pdo_entry_deleted_on' , 'pdo_entry_deleted_ip','pdo_entry_deleted_status', 'pdo_entry_id', 'pdo_entry_uniq_id', '1');

		

		deleteMultiRecords('pdo_entry_product_details', 'pdo_entry_product_detail_deleted_by', 'pdo_entry_product_detail_deleted_on', 'pdo_entry_product_detail_deleted_ip', 'pdo_entry_product_detail_deleted_status', 'pdo_entry_product_detail_pdo_entry_id', 'pdo_entry','pdo_entry_id','pdo_entry_uniq_id', '1');  



		

		pageRedirection("production-delivery/index.php?msg=7");				

	}

?>