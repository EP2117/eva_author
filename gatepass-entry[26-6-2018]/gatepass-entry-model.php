<?php
	function GetAutoNo(){
		$select_invoice_no = "SELECT MAX(gatepass_entry_no) AS maxval FROM gatepass_entry 
								  WHERE gatepass_entry_deleted_status =0
								  AND gatepass_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND gatepass_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval = $record_invoice_no['maxval']; 

		if($maxval > 0) {

			$gatepass_entry_no = substr(('00000'.++$maxval),-5);

		} else {

			$gatepass_entry_no = substr(('00000'.++$maxval),-5);

		}
		return $gatepass_entry_no;
	}
	function insertQuotation(){

		$gatepass_entry_no                   				= trim($_POST['gatepass_entry_no']);
		$gatepass_entry_branch_id                   		= trim($_POST['gatepass_entry_branch_id']);
		$gatepass_entry_date                 				= NdateDatabaseFormat($_POST['gatepass_entry_date']);
		$gatepass_entry_customer_id            				= trim($_POST['gatepass_entry_customer_id']);
		$gatepass_entry_address                 			= trim($_POST['gatepass_entry_address']);
		$gatepass_entry_vehicle_no            				= trim($_POST['gatepass_entry_vehicle_no']);
		$gatepass_entry_delivery_type                 		= trim($_POST['gatepass_entry_delivery_type']);
		$gatepass_entry_godown_id            				= trim($_POST['gatepass_entry_godown_id']);
		$gatepass_entry_driver_name            				= trim($_POST['gatepass_entry_driver_name']);
		$gatepass_entry_time                 				= trim($_POST['gatepass_entry_time']);
		$gatepass_entry_delivery_customer_id              	= trim($_POST['gatepass_entry_delivery_customer_id']);
		$gatepass_entry_type_id              				= trim($_POST['gatepass_entry_type_id']);
		$stock_ledger_entry_type							= 'dc-sale';
		//Product Detail
		$gatepass_entry_product_detail_product_type      	= $_POST['gatepass_entry_product_detail_product_type'];
		$gatepass_entry_product_detail_product_id     		= $_POST['gatepass_entry_product_detail_product_id'];
		$gatepass_entry_product_detail_delivery_detail_id   	= $_POST['gatepass_entry_product_detail_delivery_detail_id'];
		$gatepass_entry_product_detail_width_inches  		= isset($_POST['gatepass_entry_product_detail_width_inches'])?$_POST['gatepass_entry_product_detail_width_inches']:'';
		$gatepass_entry_product_detail_width_mm 		  	= isset($_POST['gatepass_entry_product_detail_width_mm'])?$_POST['gatepass_entry_product_detail_width_mm']:'';
	$gatepass_entry_product_detail_s_width_inches 		= isset($_POST['gatepass_entry_product_detail_s_width_inches'])?$_POST['gatepass_entry_product_detail_s_width_inches']:'';
		$gatepass_entry_product_detail_s_width_mm 			= isset($_POST['gatepass_entry_product_detail_s_width_mm'])?$_POST['gatepass_entry_product_detail_s_width_mm']:'';
		$gatepass_entry_product_detail_sl_feet 		  		= isset($_POST['gatepass_entry_product_detail_sl_feet'])?$_POST['gatepass_entry_product_detail_sl_feet']:'';
		$gatepass_entry_product_detail_sl_feet_in 			= isset($_POST['gatepass_entry_product_detail_sl_feet_in'])?$_POST['gatepass_entry_product_detail_sl_feet_in']:'';
		$gatepass_entry_product_detail_sl_feet_mm 			= isset($_POST['gatepass_entry_product_detail_sl_feet_mm'])?$_POST['gatepass_entry_product_detail_sl_feet_mm']:'';
		$gatepass_entry_product_detail_sl_feet_met 			= isset($_POST['gatepass_entry_product_detail_sl_feet_met'])?$_POST['gatepass_entry_product_detail_sl_feet_met']:'';
$gatepass_entry_product_detail_s_weight_inches   			= isset($_POST['gatepass_entry_product_detail_s_weight_inches'])?$_POST['gatepass_entry_product_detail_s_weight_inches']:'';
		$gatepass_entry_product_detail_s_weight_mm   		= isset($_POST['gatepass_entry_product_detail_s_weight_mm'])?$_POST['gatepass_entry_product_detail_s_weight_mm']:'';
		$gatepass_entry_product_detail_qty 			 		= $_POST['gatepass_entry_product_detail_qty'];
		$gatepass_entry_product_detail_tot_length 			= isset($_POST['gatepass_entry_product_detail_tot_length'])?$_POST['gatepass_entry_product_detail_tot_length']:'';
		$gatepass_entry_product_detail_rate 			  		= $_POST['gatepass_entry_product_detail_rate'];
		$gatepass_entry_product_detail_total 				= $_POST['gatepass_entry_product_detail_total'];
		$gatepass_entry_product_detail_color_id 				= isset($_POST['gatepass_entry_product_detail_color_id'])?$_POST['gatepass_entry_product_detail_color_id']:'';
		$gatepass_entry_product_detail_product_thick 			= isset($_POST['gatepass_entry_product_detail_product_thick'])?$_POST['gatepass_entry_product_detail_product_thick']:'';
		$gatepass_entry_product_detail_entry_type 				= $_POST['gatepass_entry_product_detail_entry_type'];
		$request_fields 									= ((!empty($gatepass_entry_branch_id)) && (!empty($gatepass_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "gatepass-entry/index.php?page=add&msg=5");
		$gatepass_entry_uniq_id								= generateUniqId();
		$ip													= getRealIpAddr();
		$insert_gatepass_entry 								= sprintf("INSERT INTO gatepass_entry  (gatepass_entry_uniq_id, gatepass_entry_date,
																					  		  gatepass_entry_customer_id,gatepass_entry_address,
																					  		  gatepass_entry_vehicle_no,gatepass_entry_delivery_type,
																					  		  gatepass_entry_godown_id,gatepass_entry_driver_name,
																							  gatepass_entry_time,gatepass_entry_no,
																					  		  gatepass_entry_branch_id,gatepass_entry_added_by,
																					   		  gatepass_entry_added_on,gatepass_entry_added_ip,
																			   		   		  gatepass_entry_company_id,gatepass_entry_financial_year,
																							  gatepass_entry_delivery_customer_id,gatepass_entry_type_id) 

																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%s', 
																							  '%s', '%s', 
																							  '%d', '%s', 
																							  '%s', '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d',
																							  '%d', '%s')", 
																		  	   		   		 $gatepass_entry_uniq_id, $gatepass_entry_date,
																					   		 $gatepass_entry_customer_id,$gatepass_entry_address,
																							 $gatepass_entry_vehicle_no,$gatepass_entry_delivery_type,
																					  		 $gatepass_entry_godown_id,$gatepass_entry_driver_name,
																					   		 $gatepass_entry_time,$gatepass_entry_no,
																					   		 $gatepass_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $gatepass_entry_delivery_customer_id,$gatepass_entry_type_id);  

		mysql_query($insert_gatepass_entry);
		//echo $insert_gatepass_entry; exit;
		$gatepass_entry_id 							= mysql_insert_id(); 
		// purchase order pproduct details
		for($i = 0; $i < count($gatepass_entry_product_detail_product_id); $i++) { 
		// echo $gatepass_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($gatepass_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$gatepass_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_gatepass_entry_product_detail 		= sprintf("INSERT INTO gatepass_entry_product_details 
																				(gatepass_entry_product_detail_uniq_id,gatepass_entry_product_detail_gatepass_entry_id,
																				 gatepass_entry_product_detail_product_id,
																				 gatepass_entry_product_detail_product_type, gatepass_entry_product_detail_product_thick,
																				 gatepass_entry_product_detail_width_inches,gatepass_entry_product_detail_width_mm,
																				 gatepass_entry_product_detail_s_width_inches,gatepass_entry_product_detail_s_width_mm,
																				 gatepass_entry_product_detail_sl_feet,gatepass_entry_product_detail_sl_feet_in,
																				 gatepass_entry_product_detail_sl_feet_mm,gatepass_entry_product_detail_sl_feet_met,
																				 gatepass_entry_product_detail_s_weight_inches,gatepass_entry_product_detail_s_weight_mm,
																				 gatepass_entry_product_detail_qty,gatepass_entry_product_detail_tot_length,
																				 gatepass_entry_product_detail_rate,gatepass_entry_product_detail_total,
																				 gatepass_entry_product_detail_added_by, gatepass_entry_product_detail_added_on,
																				 gatepass_entry_product_detail_added_ip,gatepass_entry_product_detail_delivery_detail_id,
																				 gatepass_entry_product_detail_delivery_customer_id,gatepass_entry_product_detail_color_id,
																				 gatepass_entry_product_detail_entry_type) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d',
																				'%d', '%d',
																				'%d')", 
																		 $gatepass_entry_product_detail_uniq_id,$gatepass_entry_id,
																		 $gatepass_entry_product_detail_product_id[$i],
																		 $gatepass_entry_product_detail_product_type[$i], $gatepass_entry_product_detail_product_thick[$i],
																		 $gatepass_entry_product_detail_width_inches[$i],$gatepass_entry_product_detail_width_mm[$i],
																		 $gatepass_entry_product_detail_s_width_inches[$i],$gatepass_entry_product_detail_s_width_mm[$i],
																		 $gatepass_entry_product_detail_sl_feet[$i],$gatepass_entry_product_detail_sl_feet_in[$i],
																		 $gatepass_entry_product_detail_sl_feet_mm[$i],$gatepass_entry_product_detail_sl_feet_met[$i],
																		 $gatepass_entry_product_detail_s_weight_inches[$i],$gatepass_entry_product_detail_s_weight_mm[$i],
																		 $gatepass_entry_product_detail_qty[$i],$gatepass_entry_product_detail_tot_length[$i],
																		 $gatepass_entry_product_detail_rate[$i],$gatepass_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$gatepass_entry_product_detail_delivery_detail_id[$i],
																		 $gatepass_entry_delivery_customer_id,$gatepass_entry_product_detail_color_id[$i],
																		 $gatepass_entry_product_detail_entry_type[$i]);
																		// echo $insert_gatepass_entry_product_detail; exit;
				mysql_query($insert_gatepass_entry_product_detail);
			}
		}
		pageRedirection("gatepass-entry/index.php?page=add&msg=1");

	}

	function listQuotation(){

		$select_gatepass_entry		=	"SELECT 

												gatepass_entry_id,

												gatepass_entry_uniq_id,

												gatepass_entry_no,

												gatepass_entry_date,

												customer_name,

												gatepass_entry_address

											 FROM 

												gatepass_entry

											 LEFT JOIN

												customers

											 ON

												customer_id		=  gatepass_entry_customer_id

											 WHERE 

												gatepass_entry_deleted_status 	= 	0 

											 ORDER BY 

												gatepass_entry_no ASC";

		$result_gatepass_entry		= mysql_query($select_gatepass_entry);

		// Filling up the array

		$gatepass_entry_data 		= array();

		while ($record_gatepass_entry = mysql_fetch_array($result_gatepass_entry))

		{

		 $gatepass_entry_data[] 	= $record_gatepass_entry;

		}

		return $gatepass_entry_data;

	}

	function editQuotation(){

		$gatepass_entry_id 			= getId('gatepass_entry', 'gatepass_entry_id', 'gatepass_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_gatepass_entry		=	"SELECT 

												gatepass_entry_uniq_id,  gatepass_entry_date,

												gatepass_entry_customer_id,gatepass_entry_address,

												gatepass_entry_vehicle_no,gatepass_entry_delivery_type,

												gatepass_entry_godown_id,gatepass_entry_driver_name,

												gatepass_entry_time,

												gatepass_entry_no,

												gatepass_entry_branch_id,gatepass_entry_id,

												delivery_customer_no,delivery_customer_date,

												gatepass_entry_delivery_customer_id,
												gatepass_entry_type_id,customer_name,customer_mobile_no,
												customer_billing_address

											 FROM 

												gatepass_entry

											LEFT JOIN

												customers

											ON

												customer_id				= gatepass_entry_customer_id 
											LEFT JOIN

												delivery_customer

											ON

												delivery_customer_id				= gatepass_entry_delivery_customer_id 	

											 WHERE 

												gatepass_entry_deleted_status 	=  0 			AND 

												gatepass_entry_id				= '".$gatepass_entry_id."'

											 ORDER BY 

												gatepass_entry_no ASC";

		$result_gatepass_entry 		= mysql_query($select_gatepass_entry);

		$record_gatepass_entry 		= mysql_fetch_array($result_gatepass_entry);

		return $record_gatepass_entry;

	}

	function editQuotationProductDetail()
 
	{

		$gatepass_entry_id 	= getId('gatepass_entry', 'gatepass_entry_id', 'gatepass_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_gatepass_entry_product_detail 	= "	SELECT 
															gatepass_entry_product_detail_id,
															gatepass_entry_product_detail_product_id,
															gatepass_entry_product_detail_width_inches,gatepass_entry_product_detail_width_mm,
															gatepass_entry_product_detail_s_width_inches,gatepass_entry_product_detail_s_width_mm,
															gatepass_entry_product_detail_sl_feet,gatepass_entry_product_detail_sl_feet_in,
															gatepass_entry_product_detail_sl_feet_mm,gatepass_entry_product_detail_s_weight_inches,
															gatepass_entry_product_detail_s_weight_mm,gatepass_entry_product_detail_tot_length,
															gatepass_entry_product_detail_rate,gatepass_entry_product_detail_sl_feet_met,
															gatepass_entry_product_detail_total,gatepass_entry_product_detail_qty,
															product_name,
															product_code,
															gatepass_entry_product_detail_product_thick ,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															p_uom.product_uom_name as p_uom_name,
															child_uom.product_uom_name as c_uom_name,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name,
															gatepass_entry_product_detail_entry_type
															
														FROM 
															gatepass_entry_product_details 
														LEFT JOIN 
															delivery_customer_product_details 
														ON 
															delivery_customer_product_detail_id  		= gatepass_entry_product_detail_delivery_detail_id
														LEFT JOIN 
															 invoice_entry_product_details 
														ON 
															invoice_entry_product_detail_id	 			= 	delivery_customer_product_detail_invoice_detail_id
														
														LEFT JOIN 
															products 
														ON 
															product_id 									= gatepass_entry_product_detail_product_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 									= product_brand_id	
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id	= gatepass_entry_product_detail_product_id	
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 						= product_product_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 					= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 					= gatepass_entry_product_detail_color_id
															
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 					= gatepass_entry_product_detail_color_id
														WHERE 
															gatepass_entry_product_detail_deleted_status		 	= 0 							AND 
															gatepass_entry_product_detail_gatepass_entry_id 		= '".$gatepass_entry_id."'";
		$result_gatepass_entry_product_detail 	= mysql_query($select_gatepass_entry_product_detail);

		$count_gatepass_entry 					= mysql_num_rows($result_gatepass_entry_product_detail);

		$arr_gatepass_entry_product_detail 	= array();

		

		while($record_gatepass_entry_product_detail = mysql_fetch_array($result_gatepass_entry_product_detail)) {

			$arr_gatepass_entry_product_detail[] = $record_gatepass_entry_product_detail;

		}

		return $arr_gatepass_entry_product_detail;

	}

	function updateQuotation(){

		$gatepass_entry_id                   			= trim($_POST['gatepass_entry_id']);

		$gatepass_entry_uniq_id                			= trim($_POST['gatepass_entry_uniq_id']);

		$gatepass_entry_branch_id                   	= trim($_POST['gatepass_entry_branch_id']);

		$gatepass_entry_date                 			= NdateDatabaseFormat($_POST['gatepass_entry_date']);

		$gatepass_entry_customer_id            			= trim($_POST['gatepass_entry_customer_id']);

		$gatepass_entry_address      					= trim($_POST['gatepass_entry_address']);

		$gatepass_entry_vehicle_no            			= trim($_POST['gatepass_entry_vehicle_no']);

		$gatepass_entry_delivery_type                 	= trim($_POST['gatepass_entry_delivery_type']);

		$gatepass_entry_godown_id            			= trim($_POST['gatepass_entry_godown_id']);

		$gatepass_entry_driver_name            			= trim($_POST['gatepass_entry_driver_name']);

		$gatepass_entry_time                 			= NdateDatabaseFormat($_POST['gatepass_entry_time']);

		$gatepass_entry_delivery_customer_id              	= NdateDatabaseFormat($_POST['gatepass_entry_delivery_customer_id']);

		

		//Product Detail

		$gatepass_entry_product_detail_id      				= $_POST['gatepass_entry_product_detail_id'];
		$gatepass_entry_product_detail_product_type      	= $_POST['gatepass_entry_product_detail_product_type'];
		$gatepass_entry_product_detail_product_id     		= $_POST['gatepass_entry_product_detail_product_id'];
		$gatepass_entry_product_detail_delivery_detail_id   = $_POST['gatepass_entry_product_detail_delivery_detail_id'];
		$gatepass_entry_product_detail_width_inches  		= $_POST['gatepass_entry_product_detail_width_inches'];
		$gatepass_entry_product_detail_width_mm 		  	= isset($_POST['gatepass_entry_product_detail_width_mm'])?$_POST['gatepass_entry_product_detail_width_mm']:'';
		$gatepass_entry_product_detail_s_width_inches 		= isset($_POST['gatepass_entry_product_detail_s_width_inches'])?$_POST['gatepass_entry_product_detail_s_width_inches']:'';
		$gatepass_entry_product_detail_s_width_mm 			= isset($_POST['gatepass_entry_product_detail_s_width_mm'])?$_POST['gatepass_entry_product_detail_s_width_mm']:'';
		$gatepass_entry_product_detail_sl_feet 		  		= isset($_POST['gatepass_entry_product_detail_sl_feet'])?$_POST['gatepass_entry_product_detail_sl_feet']:'';
		$gatepass_entry_product_detail_sl_feet_in 			= isset($_POST['gatepass_entry_product_detail_sl_feet_in'])?$_POST['gatepass_entry_product_detail_sl_feet_in']:'';
		$gatepass_entry_product_detail_sl_feet_mm 			= isset($_POST['gatepass_entry_product_detail_sl_feet_mm'])?$_POST['gatepass_entry_product_detail_sl_feet_mm']:'';
		$gatepass_entry_product_detail_sl_feet_met 			= isset($_POST['gatepass_entry_product_detail_sl_feet_met'])?$_POST['gatepass_entry_product_detail_sl_feet_met']:'';
$gatepass_entry_product_detail_s_weight_inches   			= isset($_POST['gatepass_entry_product_detail_s_weight_inches'])?$_POST['gatepass_entry_product_detail_s_weight_inches']:'';
		$gatepass_entry_product_detail_s_weight_mm   		= isset($_POST['gatepass_entry_product_detail_s_weight_mm'])?$_POST['gatepass_entry_product_detail_s_weight_mm']:'';
		$gatepass_entry_product_detail_qty 			 		= $_POST['gatepass_entry_product_detail_qty'];
		$gatepass_entry_product_detail_tot_length 			= isset($_POST['gatepass_entry_product_detail_tot_length'])?$_POST['gatepass_entry_product_detail_tot_length']:'';
		$gatepass_entry_product_detail_rate 			  	= $_POST['gatepass_entry_product_detail_rate'];
		$gatepass_entry_product_detail_total 				= $_POST['gatepass_entry_product_detail_total'];
		$gatepass_entry_product_detail_color_id 			= isset($_POST['gatepass_entry_product_detail_color_id'])?$_POST['gatepass_entry_product_detail_color_id']:'';
		$gatepass_entry_product_detail_product_thick 		= isset($_POST['gatepass_entry_product_detail_product_thick'])?$_POST['gatepass_entry_product_detail_product_thick']:'';
		$gatepass_entry_product_detail_entry_type 			= $_POST['gatepass_entry_product_detail_entry_type'];

		$request_fields 								= ((!empty($gatepass_entry_branch_id)) && (!empty($gatepass_entry_date)));

		$stock_ledger_entry_type						= 'dc-sale';

		checkRequestFields($request_fields, PROJECT_PATH, "gatepass-entry/index.php?page=edit&id=$gatepass_entry_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 
															gatepass_entry 
														SET 
															gatepass_entry_branch_id 				= '%d',
															gatepass_entry_date 					= '%s',
															gatepass_entry_customer_id 				= '%d',
															gatepass_entry_address 					= '%s',
															gatepass_entry_vehicle_no 				= '%s',
															gatepass_entry_delivery_type 				= '%s',
															gatepass_entry_godown_id 				= '%d',
															gatepass_entry_driver_name 				= '%s',
															gatepass_entry_time 					= '%s',
															gatepass_entry_modified_by 				= '%d',
															gatepass_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),
															gatepass_entry_modified_ip				= '%s'
														WHERE               
															gatepass_entry_id         				= '%d'", 
															$gatepass_entry_branch_id,
															$gatepass_entry_date,
															$gatepass_entry_customer_id,
															$gatepass_entry_address,
															$gatepass_entry_vehicle_no,
															$gatepass_entry_delivery_type,
															$gatepass_entry_godown_id,
															$gatepass_entry_driver_name,
															$gatepass_entry_time,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$gatepass_entry_id); 
		//echo $update_customer; exit;
		mysql_query($update_customer);
		for($i = 0; $i < count($gatepass_entry_product_detail_product_id); $i++) {
			$detail_request_fields = ((!empty($gatepass_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				if(isset($gatepass_entry_product_detail_id[$i]) && (!empty($gatepass_entry_product_detail_id[$i]))) {
					 $update_gatepass_entry_product_detail = sprintf("UPDATE 
																			gatepass_entry_product_details 
																		SET  
																			gatepass_entry_product_detail_width_inches  			= '%f',
																			gatepass_entry_product_detail_width_mm  				= '%f',
																			gatepass_entry_product_detail_s_width_inches  			= '%f',
																			gatepass_entry_product_detail_s_width_mm  				= '%f',
																			gatepass_entry_product_detail_sl_feet  					= '%f',
																			gatepass_entry_product_detail_sl_feet_in  				= '%f',
																			gatepass_entry_product_detail_sl_feet_mm  				= '%f',
																			gatepass_entry_product_detail_s_weight_inches  			= '%f',
																			gatepass_entry_product_detail_s_weight_mm  				= '%f',
																			gatepass_entry_product_detail_tot_length  				= '%f',
																			gatepass_entry_product_detail_qty  						= '%f',
																			gatepass_entry_product_detail_rate  					= '%f',
																			gatepass_entry_product_detail_total  					= '%f',
																			gatepass_entry_product_detail_entry_type				= '%d',
																			gatepass_entry_product_detail_modified_by 				= '%d',
																			gatepass_entry_product_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																			gatepass_entry_product_detail_modified_ip 				= '%s'
																		WHERE 
																			gatepass_entry_product_detail_gatepass_entry_id 	= '%d' AND 
																			gatepass_entry_product_detail_id 					= '%d'",
																			$gatepass_entry_product_detail_width_inches[$i],
																			$gatepass_entry_product_detail_width_mm[$i],
																			$gatepass_entry_product_detail_s_width_inches[$i],
																			$gatepass_entry_product_detail_s_width_mm[$i],
																			$gatepass_entry_product_detail_sl_feet[$i],
																			$gatepass_entry_product_detail_sl_feet_in[$i],
																			$gatepass_entry_product_detail_sl_feet_mm[$i],
																			$gatepass_entry_product_detail_s_weight_inches[$i],
																			$gatepass_entry_product_detail_s_weight_mm[$i],
																			$gatepass_entry_product_detail_tot_length[$i],
																			$gatepass_entry_product_detail_qty[$i],
																			$gatepass_entry_product_detail_rate[$i],
																			$gatepass_entry_product_detail_total[$i],
																			$gatepass_entry_product_detail_entry_type[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$gatepass_entry_id, 
																			$gatepass_entry_product_detail_id[$i]);	
			//	echo $update_gatepass_entry_product_detail; exit;
					mysql_query($update_gatepass_entry_product_detail);
					$detail_id			= $gatepass_entry_product_detail_id[$i];
					
				/*$length_inches										= 	$gatepass_entry_product_detail_length_feet[$i];
				$width_inches										= 	"3";
				$gatepass_entry_detail_id							= 	$gatepass_entry_product_detail_id[$i];
				$stock_ledger_prd_type								= 	$gatepass_entry_product_detail_type[$i];
				stockLedger('out', $gatepass_entry_id, $gatepass_entry_detail_id,$gatepass_entry_product_detail_product_id[$i],$length_inches,$width_inches, ($gatepass_entry_product_detail_qty[$i]*-1), $gatepass_entry_branch_id, $gatepass_entry_customer_id, $gatepass_entry_godown_id, $gatepass_entry_date, $gatepass_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);*/
				} else {

				$gatepass_entry_product_detail_uniq_id = generateUniqId();

				$insert_gatepass_entry_product_detail 		= sprintf("INSERT INTO gatepass_entry_product_details 
																				(gatepass_entry_product_detail_uniq_id,gatepass_entry_product_detail_gatepass_entry_id,
																				 gatepass_entry_product_detail_product_id,
																				 gatepass_entry_product_detail_product_type, gatepass_entry_product_detail_product_thick,
																				 gatepass_entry_product_detail_width_inches,gatepass_entry_product_detail_width_mm,
																				 gatepass_entry_product_detail_s_width_inches,gatepass_entry_product_detail_s_width_mm,
																				 gatepass_entry_product_detail_sl_feet,gatepass_entry_product_detail_sl_feet_in,
																				 gatepass_entry_product_detail_sl_feet_mm,gatepass_entry_product_detail_sl_feet_met,
																				 gatepass_entry_product_detail_s_weight_inches,gatepass_entry_product_detail_s_weight_mm,
																				 gatepass_entry_product_detail_qty,gatepass_entry_product_detail_tot_length,
																				 gatepass_entry_product_detail_rate,gatepass_entry_product_detail_total,
																				 gatepass_entry_product_detail_added_by, gatepass_entry_product_detail_added_on,
																				 gatepass_entry_product_detail_added_ip,gatepass_entry_product_detail_delivery_detail_id,
																				 gatepass_entry_product_detail_delivery_customer_id,gatepass_entry_product_detail_color_id,
																				 gatepass_entry_product_detail_entry_type) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d',
																				'%d', '%d',
																				'%d')", 
																		 $gatepass_entry_product_detail_uniq_id,$gatepass_entry_id,
																		 $gatepass_entry_product_detail_product_id[$i],
																		 $gatepass_entry_product_detail_product_type[$i], $gatepass_entry_product_detail_product_thick[$i],
																		 $gatepass_entry_product_detail_width_inches[$i],$gatepass_entry_product_detail_width_mm[$i],
																		 $gatepass_entry_product_detail_s_width_inches[$i],$gatepass_entry_product_detail_s_width_mm[$i],
																		 $gatepass_entry_product_detail_sl_feet[$i],$gatepass_entry_product_detail_sl_feet_in[$i],
																		 $gatepass_entry_product_detail_sl_feet_mm[$i],$gatepass_entry_product_detail_sl_feet_met[$i],
																		 $gatepass_entry_product_detail_s_weight_inches[$i],$gatepass_entry_product_detail_s_weight_mm[$i],
																		 $gatepass_entry_product_detail_qty[$i],$gatepass_entry_product_detail_tot_length[$i],
																		 $gatepass_entry_product_detail_rate[$i],$gatepass_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$gatepass_entry_product_detail_delivery_detail_id[$i],
																		 $gatepass_entry_delivery_customer_id,$gatepass_entry_product_detail_color_id[$i],
																		 $gatepass_entry_product_detail_entry_type[$i]);
																		// echo $insert_gatepass_entry_product_detail; exit;
				mysql_query($insert_gatepass_entry_product_detail);
				$detail_id  = mysql_insert_id();
				}
				
				
			}
		}
		pageRedirection("gatepass-entry/index.php?page=edit&id=$gatepass_entry_uniq_id&msg=2");			
	}
    function deleteProductdetail()
   {
		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['gatepass_entry_uniq_id'])))
		{
			$product_detail_id 	= $_GET['product_detail_id'];
			$gatepass_entry_uniq_id = $_GET['gatepass_entry_uniq_id'];
			mysql_query("UPDATE gatepass_entry_product_details SET gatepass_entry_product_detail_deleted_status = 1 
						WHERE gatepass_entry_product_detail_id = ".$product_detail_id." ");
			header("Location:index.php?page=edit&id=$gatepass_entry_uniq_id&msg=6");
		}
   } 		
	function deleteInventoryrequest(){

		deleteUniqRecords('gatepass_entry', 'gatepass_entry_deleted_by', 'gatepass_entry_deleted_on' , 'gatepass_entry_deleted_ip','gatepass_entry_deleted_status', 'gatepass_entry_id', 'gatepass_entry_uniq_id', '1');

		

		deleteMultiRecords('gatepass_entry_product_details', 'gatepass_entry_product_detail_deleted_by', 'gatepass_entry_product_detail_deleted_on', 'gatepass_entry_product_detail_deleted_ip', 'gatepass_entry_product_detail_deleted_status', 'gatepass_entry_product_detail_gatepass_entry_id', 'gatepass_entry','gatepass_entry_id','gatepass_entry_uniq_id', '1');  



		

		pageRedirection("gatepass-entry/index.php?msg=7");				

	}

?>