<?php

	function insertQuotation(){

		$production_entry_branch_id                   			= trim($_POST['production_entry_branch_id']);
		$production_entry_date                 					= NdateDatabaseFormat($_POST['production_entry_date']);
		$production_entry_production_type            			= trim($_POST['production_entry_production_type']);
		$production_entry_godown_id          					= trim($_POST['production_entry_godown_id']);
		$production_entry_vendor_id      						= trim($_POST['production_entry_vendor_id']);
		$production_entry_type     								= trim($_POST['production_entry_type']);
		$production_entry_type_id     							= trim($_POST['production_entry_type_id']);
		$production_entry_grn_entry_id     						= trim($_POST['production_entry_grn_entry_id']);
		$production_entry_grn_date                 				= NdateDatabaseFormat($_POST['production_entry_grn_date']);
		$production_entry_remarks								= trim($_POST['production_entry_remarks']);
		//Product Detail
		$production_entry_product_detail_product_type      	= $_POST['production_entry_product_detail_product_type'];
		$production_entry_product_detail_grn_detail_id     	= $_POST['production_entry_product_detail_grn_detail_id'];
		$production_entry_product_detail_product_id     	= $_POST['production_entry_product_detail_product_id'];
		$production_entry_product_detail_product_colour_id	= $_POST['production_entry_product_detail_product_colour_id'];
		$production_entry_product_detail_product_thick  	= isset($_POST['production_entry_product_detail_product_thick'])?$_POST['production_entry_product_detail_product_thick']:'';
		$production_entry_product_detail_width_inches  		= isset($_POST['production_entry_product_detail_width_inches'])?$_POST['production_entry_product_detail_width_inches']:'';
		$production_entry_product_detail_width_mm 		  	= isset($_POST['production_entry_product_detail_width_mm'])?$_POST['production_entry_product_detail_width_mm']:'';
		$production_entry_product_detail_s_width_inches 	= isset($_POST['production_entry_product_detail_s_width_inches'])?$_POST['production_entry_product_detail_s_width_inches']:'';
		$production_entry_product_detail_s_width_mm 		= isset($_POST['production_entry_product_detail_s_width_mm'])?$_POST['production_entry_product_detail_s_width_mm']:'';
		$production_entry_product_detail_sl_feet 		  	= isset($_POST['production_entry_product_detail_sl_feet'])?$_POST['production_entry_product_detail_sl_feet']:'';
		$production_entry_product_detail_sl_feet_in 		= isset($_POST['production_entry_product_detail_sl_feet_in'])?$_POST['production_entry_product_detail_sl_feet_in']:'';
		$production_entry_product_detail_sl_feet_mm 		= isset($_POST['production_entry_product_detail_sl_feet_mm'])?$_POST['production_entry_product_detail_sl_feet_mm']:'';
		$production_entry_product_detail_sl_feet_met 		= isset($_POST['production_entry_product_detail_sl_feet_met'])?$_POST['production_entry_product_detail_sl_feet_met']:'';
		$production_entry_product_detail_ext_feet 		  	= isset($_POST['production_entry_product_detail_ext_feet'])?$_POST['production_entry_product_detail_ext_feet']:'';
		$production_entry_product_detail_ext_feet_in 		= isset($_POST['production_entry_product_detail_ext_feet_in'])?$_POST['production_entry_product_detail_ext_feet_in']:'';
		$production_entry_product_detail_ext_feet_mm 		= isset($_POST['production_entry_product_detail_ext_feet_mm'])?$_POST['production_entry_product_detail_ext_feet_mm']:'';
		$production_entry_product_detail_ext_feet_met 		= isset($_POST['production_entry_product_detail_ext_feet_met'])?$_POST['production_entry_product_detail_ext_feet_met']:'';
		$production_entry_product_detail_s_weight_inches 	= isset($_POST['production_entry_product_detail_s_weight_inches'])?$_POST['production_entry_product_detail_s_weight_inches']:'';
		$production_entry_product_detail_s_weight_mm   		= isset($_POST['production_entry_product_detail_s_weight_mm'])?$_POST['production_entry_product_detail_s_weight_mm']:'';
		$production_entry_product_detail_qty 			  	= $_POST['production_entry_product_detail_qty'];
		$production_entry_product_detail_tot_length 		= isset($_POST['production_entry_product_detail_tot_length'])?$_POST['production_entry_product_detail_tot_length']:'';
		$production_entry_product_detail_tot_feet 			  	= $_POST['production_entry_product_detail_tot_feet'];
		$production_entry_product_detail_tot_meter 			  	= $_POST['production_entry_product_detail_tot_meter'];
		
		$production_entry_raw_product_detail_product_type      	= $_POST['production_entry_raw_product_detail_product_type'];
		$production_entry_raw_product_detail_grn_detail_id     	= $_POST['production_entry_raw_product_detail_grn_detail_id'];
		$production_entry_raw_product_detail_product_id     	= $_POST['production_entry_raw_product_detail_product_id'];
		$production_entry_raw_product_detail_product_colour_id	= $_POST['production_entry_raw_product_detail_product_colour_id'];
		$production_entry_raw_product_detail_product_thick  	= isset($_POST['production_entry_raw_product_detail_product_thick'])?$_POST['production_entry_raw_product_detail_product_thick']:'';
		$production_entry_raw_product_detail_width_inches  		= isset($_POST['production_entry_raw_product_detail_width_inches'])?$_POST['production_entry_raw_product_detail_width_inches']:'';
		$production_entry_raw_product_detail_width_mm 		  	= isset($_POST['production_entry_raw_product_detail_width_mm'])?$_POST['production_entry_raw_product_detail_width_mm']:'';
		$production_entry_raw_product_detail_sl_feet 		  	= isset($_POST['production_entry_raw_product_detail_sl_feet'])?$_POST['production_entry_raw_product_detail_sl_feet']:'';
		$production_entry_raw_product_detail_sl_feet_mm 		= isset($_POST['production_entry_raw_product_detail_sl_feet_mm'])?$_POST['production_entry_raw_product_detail_sl_feet_mm']:'';
		$production_entry_raw_product_detail_ton 			  	= $_POST['production_entry_raw_product_detail_ton'];
		$production_entry_raw_product_detail_kg 				= isset($_POST['production_entry_raw_product_detail_kg'])?$_POST['production_entry_raw_product_detail_kg']:'';
		
		

		// Work Assign Detail
		$production_entry_work_detail_production_section_id     = $_POST['production_entry_work_detail_production_section_id'];
		$production_entry_work_detail_production_machine_id   	= $_POST['production_entry_work_detail_production_machine_id'];
		$production_entry_work_detail_employee_id     			= $_POST['production_entry_work_detail_employee_id'];
		$production_entry_work_detail_from_date     			= $_POST['production_entry_work_detail_from_date'];
		$production_entry_work_detail_to_date     				= $_POST['production_entry_work_detail_to_date'];
		$production_entry_work_detail_due     					= $_POST['production_entry_work_detail_due'];
		$production_entry_work_detail_remarks  					= $_POST['production_entry_work_detail_remarks'];

		// Dam Product Detail

		$production_entry_dam_product_detail_product_type      	= $_POST['production_entry_dam_product_detail_product_type'];
		$production_entry_dam_product_detail_grn_detail_id     	= $_POST['production_entry_dam_product_detail_grn_detail_id'];
		$production_entry_product_detail_grn_entry_id     		= $_POST['production_entry_product_detail_grn_entry_id'];
		$production_entry_dam_product_detail_product_id     	= $_POST['production_entry_dam_product_detail_product_id'];
		$production_entry_dam_product_detail_product_colour_id	= $_POST['production_entry_dam_product_detail_product_colour_id'];
		$production_entry_dam_product_detail_product_thick  	= isset($_POST['production_entry_dam_product_detail_product_thick'])?$_POST['production_entry_dam_product_detail_product_thick']:'';
		$production_entry_dam_product_detail_width_inches  		= isset($_POST['production_entry_dam_product_detail_width_inches'])?$_POST['production_entry_dam_product_detail_width_inches']:'';
		$production_entry_dam_product_detail_width_mm 		  	= isset($_POST['production_entry_dam_product_detail_width_mm'])?$_POST['production_entry_dam_product_detail_width_mm']:'';
		$production_entry_dam_product_detail_sl_feet 		  	= isset($_POST['production_entry_dam_product_detail_sl_feet'])?$_POST['production_entry_dam_product_detail_sl_feet']:'';
		$production_entry_dam_product_detail_sl_feet_mm 		= isset($_POST['production_entry_dam_product_detail_sl_feet_mm'])?$_POST['production_entry_dam_product_detail_sl_feet_mm']:'';
		$production_entry_dam_product_detail_ton 			  	= $_POST['production_entry_dam_product_detail_ton'];
		$production_entry_dam_product_detail_kg 				= isset($_POST['production_entry_dam_product_detail_kg'])?$_POST['production_entry_dam_product_detail_kg']:'';

		

		$request_fields 										= ((!empty($production_entry_branch_id)) && (!empty($production_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "production-entry/index.php?page=add&msg=5");

		$production_entry_uniq_id								= generateUniqId();

		$ip														= getRealIpAddr();

		

		$select_production_entry_no								= "SELECT 

																		MAX(production_entry_no) AS maxval 

																   FROM 

																		production_entry 

																   WHERE 

																		production_entry_deleted_status 	= 0 												AND

																		production_entry_branch_id 		= '".$production_entry_branch_id."'						AND

																		production_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND

																		production_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_production_entry_no 						= mysql_query($select_production_entry_no);

		$record_production_entry_no 						= mysql_fetch_array($result_production_entry_no);	

		$maxval 											= $record_production_entry_no['maxval']; 

		if($maxval > 0) {

			$production_entry_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$production_entry_no 							= substr(('00000'.++$maxval),-5);

		}

		

		

		$insert_production_entry 							= sprintf("INSERT INTO production_entry  (production_entry_uniq_id, production_entry_date,

																					  		  production_entry_production_type,production_entry_godown_id,

																					   		  production_entry_vendor_id,production_entry_type,

																					   		  production_entry_grn_entry_id, production_entry_no,

																					  		  production_entry_branch_id,production_entry_added_by,

																					   		  production_entry_added_on,production_entry_added_ip,

																			   		   		  production_entry_company_id,production_entry_financial_year,

																							  production_entry_grn_date,production_entry_remarks,
																							  production_entry_type_id) 

																			VALUES 	 		 ('%s', '%s', 

																							  '%s', '%d', 

																							  '%d', '%d',

																							  '%d', '%s',

																							  '%d', '%d', 

																							   UNIX_TIMESTAMP(NOW()),

																							  '%s', '%d', '%d',

																							  '%s', '%s', '%d')", 

																		  	   		   		 $production_entry_uniq_id, $production_entry_date,

																					   		 $production_entry_production_type,$production_entry_godown_id,

																					   		 $production_entry_vendor_id,$production_entry_type,

																					   		 $production_entry_grn_entry_id,$production_entry_no,

																					   		 $production_entry_branch_id,$_SESSION[SESS.'_session_user_id'],

																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],

																							 $production_entry_grn_date,$production_entry_remarks,
																							 $production_entry_type_id);  

		mysql_query($insert_production_entry);

		//echo $insert_production_entry; exit;

		$production_entry_id 						= mysql_insert_id(); 
		for($i = 0; $i < count($production_entry_product_detail_product_id); $i++) { 
		// echo $pdo_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($production_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$production_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_production_entry_product_detail 		= sprintf("INSERT INTO production_entry_product_details 
																				(production_entry_product_detail_uniq_id,production_entry_product_detail_production_entry_id,
																				 production_entry_product_detail_grn_detail_id,production_entry_product_detail_grn_entry_id,
																				 production_entry_product_detail_product_id,production_entry_product_detail_product_colour_id,
																				 production_entry_product_detail_product_type, production_entry_product_detail_product_thick,
																				 production_entry_product_detail_width_inches,production_entry_product_detail_width_mm,
																				 production_entry_product_detail_s_width_inches,production_entry_product_detail_s_width_mm,
																				 production_entry_product_detail_sl_feet,production_entry_product_detail_sl_feet_in,
																				 production_entry_product_detail_sl_feet_mm,production_entry_product_detail_sl_feet_met,
																				 production_entry_product_detail_ext_feet,production_entry_product_detail_ext_feet_in,
																				 production_entry_product_detail_ext_feet_mm,production_entry_product_detail_ext_feet_met,
																				 production_entry_product_detail_s_weight_inches,production_entry_product_detail_s_weight_mm,
																				 production_entry_product_detail_qty,production_entry_product_detail_tot_length,
																				 production_entry_product_detail_tot_feet,production_entry_product_detail_tot_meter,
																				 production_entry_product_detail_added_by, production_entry_product_detail_added_on,
																				 production_entry_product_detail_added_ip) 
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
																				'%d', UNIX_TIMESTAMP(NOW()), '%s')", 
																		 $production_entry_product_detail_uniq_id,$production_entry_id,
																		 $production_entry_product_detail_grn_detail_id[$i],$production_entry_product_detail_grn_entry_id,
																		 $production_entry_product_detail_product_id[$i],$production_entry_product_detail_product_colour_id[$i],
																		 $production_entry_product_detail_product_type[$i], $production_entry_product_detail_product_thick[$i],
																		 $production_entry_product_detail_width_inches[$i],$production_entry_product_detail_width_mm[$i],
																		 $production_entry_product_detail_s_width_inches[$i],$production_entry_product_detail_s_width_mm[$i],
																		 $production_entry_product_detail_sl_feet[$i],$production_entry_product_detail_sl_feet_in[$i],
																		 $production_entry_product_detail_sl_feet_mm[$i], $production_entry_product_detail_sl_feet_met[$i],
																		 $production_entry_product_detail_ext_feet[$i],$production_entry_product_detail_ext_feet_in[$i],
																		 $production_entry_product_detail_ext_feet_mm[$i], $production_entry_product_detail_ext_feet_met[$i],
																		 $production_entry_product_detail_s_weight_inches[$i],$production_entry_product_detail_s_weight_mm[$i],
																		 $production_entry_product_detail_qty[$i],$production_entry_product_detail_tot_length[$i],
																		 $production_entry_product_detail_tot_feet[$i],$production_entry_product_detail_tot_meter[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
				mysql_query($insert_production_entry_product_detail);
				$detail_id		= mysql_insert_id();
				if($production_entry_type_id==4){
							$produt_id											=	$production_entry_product_detail_product_id[$i];
							$product_colour_id									=	1;
							$product_thick										=	1;
							$width_inches										= 	1;
							$width_mm											= 	1;
							$length_feet										= 	1;
							$length_meter										= 	1;
							$product_detail_qty									= 	$production_entry_product_detail_qty[$i];
							$stock_ledger_entry_type							= 	"production-entry-fin";
							$product_con_entry_godown_id						= 	"3";
							stockLedger('in',$production_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $production_entry_branch_id,  $product_con_entry_godown_id, $production_entry_date, $production_entry_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
				}
				else{		
							$produt_id											=	$production_entry_product_detail_product_id[$i];
							$product_colour_id									=	$production_entry_product_detail_product_colour_id[$i];
							$product_thick										=	$production_entry_product_detail_product_thick[$i];
							$width_inches										= 	$production_entry_product_detail_width_inches[$i];
							$width_mm											= 	$production_entry_product_detail_width_mm[$i];
							$length_feet										= 	$production_entry_product_detail_sl_feet[$i];
							$length_meter										= 	$production_entry_product_detail_sl_feet_met[$i];
							if($production_entry_type_id==1){
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$rec_product['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$ton_qty										= 	$total_ton*$length_feet;
								$kg_qty											= 	$ton_qty*1000;
							}
							else{
								$ton_qty										= 	$production_entry_product_detail_s_weight_inches[$i];
								$kg_qty											= 	$production_entry_product_detail_s_weight_mm[$i];
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$rec_product['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$length_feet									= 	($production_entry_product_detail_sl_feet[$i]/$total_ton);
								
								$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
								$length_meter									= 	$product_cal['3'];
							}
							$product_detail_qty									= 	$production_entry_product_detail_qty[$i];
							$stock_ledger_entry_type							= 	"production-entry-fin";
							$product_con_entry_godown_id						= 	"3";
							stockLedger('in',$production_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $production_entry_branch_id,  $product_con_entry_godown_id, $production_entry_date, $production_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
				}
				
			}
		}

		// purchase order pproduct details

		// echo $production_entry_raw_product_detail_qty[$i]; exit;

		for($i = 0; $i < count($production_entry_raw_product_detail_product_id); $i++) { 
		// echo $production_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($production_entry_raw_product_detail_product_id[$i])) && 
									 							(!empty($production_entry_raw_product_detail_ton[$i])));
			if($detail_request_fields) {
				$production_entry_raw_product_detail_uniq_id 	= generateUniqId();
				$insert_production_entry_raw_product_detail 		= sprintf("INSERT INTO production_entry_raw_product_details 
																				(production_entry_raw_product_detail_uniq_id,
																				 production_entry_raw_product_detail_production_entry_id,
																				 production_entry_raw_product_detail_product_id,
																				 production_entry_raw_product_detail_grn_detail_id,
																				 production_entry_raw_product_detail_grn_entry_id,
																				 production_entry_raw_product_detail_product_colour_id,
																				 production_entry_raw_product_detail_product_type,
																				 production_entry_raw_product_detail_product_thick,
																				 production_entry_raw_product_detail_width_inches,production_entry_raw_product_detail_width_mm,
																				 production_entry_raw_product_detail_sl_feet,production_entry_raw_product_detail_sl_feet_mm,
																				 production_entry_raw_product_detail_ton,production_entry_raw_product_detail_kg,
																				 production_entry_raw_product_detail_added_by, production_entry_raw_product_detail_added_on,
																				 production_entry_raw_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $production_entry_raw_product_detail_uniq_id,$production_entry_id,
																		 $production_entry_raw_product_detail_product_id[$i],
																		 $production_entry_raw_product_detail_grn_detail_id[$i],
																		 $production_entry_grn_entry_id,$production_entry_raw_product_detail_product_colour_id[$i],
																		 $production_entry_raw_product_detail_product_type[$i],
																		 $production_entry_raw_product_detail_product_thick[$i],
																		 $production_entry_raw_product_detail_width_inches[$i],$production_entry_raw_product_detail_width_mm[$i],
																		 $production_entry_raw_product_detail_sl_feet[$i],$production_entry_raw_product_detail_sl_feet_mm[$i],
																		 $production_entry_raw_product_detail_ton[$i],$production_entry_raw_product_detail_kg[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
				mysql_query($insert_production_entry_raw_product_detail);
				$detail_id = mysql_insert_id();
							$produt_id											=	$production_entry_raw_product_detail_product_id[$i];
							$length_feet										= 	$production_entry_raw_product_detail_sl_feet[$i];
							$length_meter										= 	$production_entry_raw_product_detail_sl_feet_mm[$i];
							$ton_qty											= 	$production_entry_raw_product_detail_ton[$i];
							$kg_qty												= 	$production_entry_raw_product_detail_kg[$i];
							$width_inches										=   $production_entry_raw_product_detail_width_inches[$i];
							$width_mm											=   $production_entry_raw_product_detail_width_mm[$i];
							$color_id											= 	$production_entry_raw_product_detail_product_colour_id[$i];
							$thick												= 	$production_entry_raw_product_detail_product_thick[$i];
							
							$product_detail_qty									= 	"-1";
							$stock_ledger_entry_type							= 	"production-entry-raw";
							$product_con_entry_godown_id						= 	"3";
							stockLedger('out',$production_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $production_entry_branch_id,  $product_con_entry_godown_id, $production_entry_date, $production_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
			}
		}
		// Work Assign details
		for($i = 0; $i < count($production_entry_work_detail_production_section_id); $i++) {

			$detail_request_fields 									= 	((!empty($production_entry_work_detail_production_section_id[$i])));

			if($detail_request_fields) {

				$production_entry_work_detail_uniq_id 		= generateUniqId();

				$insert_production_entry_work_detail 		= sprintf("INSERT INTO production_entry_work_details 

																				(production_entry_work_detail_uniq_id,  

																				 production_entry_work_detail_production_section_id,

																				 production_entry_work_detail_production_machine_id,

																				 production_entry_work_detail_employee_id,production_entry_work_detail_from_date,

																				 production_entry_work_detail_to_date,production_entry_work_detail_due,

																				 production_entry_work_detail_remarks,production_entry_work_detail_production_entry_id,

																				 production_entry_work_detail_added_by,

																				 production_entry_work_detail_added_on,production_entry_work_detail_added_ip) 

																	VALUES     ('%s',

																 				'%d', '%d',

																				'%d', '%s', 

																				'%s', '%d', 

																				'%s', '%d', 

																				'%d', 

																				UNIX_TIMESTAMP(NOW()), '%s')", 

																				$production_entry_work_detail_uniq_id,

																		 		$production_entry_work_detail_production_section_id[$i],

																				$production_entry_work_detail_production_machine_id[$i],  

																				$production_entry_work_detail_employee_id[$i],

																				NdateDatabaseFormat($production_entry_work_detail_from_date[$i]),

																				NdateDatabaseFormat($production_entry_work_detail_to_date[$i]),

																				$production_entry_work_detail_due[$i],

																				$production_entry_work_detail_remarks[$i],$production_entry_id, 

																				$_SESSION[SESS.'_session_user_id'],$ip);

				mysql_query($insert_production_entry_work_detail);

			}

		}		

		// Damage product details

		for($i = 0; $i < count($production_entry_dam_product_detail_product_id); $i++) {

			$detail_request_fields 									= 	((!empty($production_entry_dam_product_detail_product_id[$i])));

			if($detail_request_fields) {

				$production_entry_dam_product_detail_uniq_id 		= generateUniqId();

				$insert_production_entry_dam_product_detail 		= sprintf("INSERT INTO production_entry_dam_product_details 
																				(production_entry_dam_product_detail_uniq_id,
																				 production_entry_dam_product_detail_production_entry_id,
																				 production_entry_dam_product_detail_product_id,
																				 production_entry_dam_product_detail_grn_detail_id,
																				 production_entry_dam_product_detail_grn_entry_id,
																				 production_entry_dam_product_detail_product_colour_id,
																				 production_entry_dam_product_detail_product_type,
																				 production_entry_dam_product_detail_product_thick,
																				 production_entry_dam_product_detail_width_inches,production_entry_dam_product_detail_width_mm,
																				 production_entry_dam_product_detail_sl_feet,production_entry_dam_product_detail_sl_feet_mm,
																				 production_entry_dam_product_detail_ton,production_entry_dam_product_detail_kg,
																				 production_entry_dam_product_detail_added_by, production_entry_dam_product_detail_added_on,
																				 production_entry_dam_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $production_entry_dam_product_detail_uniq_id,$production_entry_id,
																		 $production_entry_dam_product_detail_product_id[$i],
																		 $production_entry_dam_product_detail_grn_detail_id[$i],
																		 $production_entry_grn_entry_id,$production_entry_dam_product_detail_product_colour_id[$i],
																		 $production_entry_dam_product_detail_product_type[$i],
																		 $production_entry_dam_product_detail_product_thick[$i],
																		 $production_entry_dam_product_detail_width_inches[$i],$production_entry_dam_product_detail_width_mm[$i],
																		 $production_entry_dam_product_detail_sl_feet[$i],$production_entry_dam_product_detail_sl_feet_mm[$i],
																		 $production_entry_dam_product_detail_ton[$i],$production_entry_dam_product_detail_kg[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);

				mysql_query($insert_production_entry_dam_product_detail);

			}

		}
		pageRedirection("production-entry/index.php?page=add&msg=1");

	}

	function listQuotation(){

		$select_production_entry		=	"SELECT 

												production_entry_id,

												production_entry_uniq_id,

												production_entry_no,

												production_entry_date,

												production_entry_godown_id,

												godown_name,

												production_entry_type

											 FROM 

												production_entry

											 LEFT JOIN

												godowns

											 ON

												godown_id							=  production_entry_godown_id

											 WHERE 

												production_entry_deleted_status 	= 	0	 

											 ORDER BY 

												production_entry_no ASC";

		$result_production_entry		= mysql_query($select_production_entry);

		// Filling up the array

		$production_entry_data 		= array();

		while ($record_production_entry = mysql_fetch_array($result_production_entry))

		{

		 $production_entry_data[] 	= $record_production_entry;

		}

		return $production_entry_data;

	}

	function editQuotation(){

		$production_entry_id 			= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_production_entry		=	"SELECT 

												production_entry_uniq_id,  production_entry_date,

												production_entry_production_type,production_entry_godown_id,

												production_entry_vendor_id,production_entry_type,production_entry_remarks,

												production_entry_grn_entry_id, production_entry_no,

												production_entry_branch_id,production_entry_id,production_entry_grn_date,production_entry_type_id 

											 FROM 

												production_entry 

											 WHERE 

												production_entry_deleted_status 	=  0 			AND 

												production_entry_id				= '".$production_entry_id."'

											 ORDER BY 

												production_entry_no ASC";

		$result_production_entry 		= mysql_query($select_production_entry);

		$record_production_entry 		= mysql_fetch_array($result_production_entry);

		return $record_production_entry;

	}

	function editSalesdetail(){

		$production_entry_id 				= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		$grn_entry_id 				= getId('production_entry', 'production_entry_grn_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

			$select_production_entry		=	"SELECT 

													grn_entry_no,

													grn_entry_date,

													grn_entry_type

												 FROM 

													grn_entry 

												 WHERE 

													grn_entry_deleted_status 	=  0 						AND 

													grn_entry_id					= '".$grn_entry_id."'

												 ORDER BY 

													grn_entry_no ASC";

		

		$result_production_entry 		= mysql_query($select_production_entry);

		$record_production_entry 		= mysql_fetch_array($result_production_entry);

		return $record_production_entry;

	}

	function editQuotationProductDetail()

	{

		$production_entry_id 	= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_production_entry_product_detail 	= "	SELECT 
														production_entry_product_detail_id,
														production_entry_product_detail_product_id,
														production_entry_product_detail_width_inches,production_entry_product_detail_width_mm,
														production_entry_product_detail_s_width_inches,production_entry_product_detail_s_width_mm,
														production_entry_product_detail_sl_feet,production_entry_product_detail_sl_feet_in,
														production_entry_product_detail_sl_feet_mm,production_entry_product_detail_s_weight_inches,
														production_entry_product_detail_s_weight_mm,production_entry_product_detail_tot_length,
														production_entry_product_detail_grn_detail_id,production_entry_product_detail_qty,
														production_entry_product_detail_product_thick,
														product_name,
														product_code,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														p_uom.product_uom_name as p_uom_name,
														child_uom.product_uom_name as c_uom_name,
														p_clr.product_colour_name as p_colour_name,
														c_clr.product_colour_name as c_colour_name,
														brand_name,production_entry_product_detail_product_type,
														production_entry_product_detail_sl_feet_met,
														production_entry_product_detail_ext_feet,
														production_entry_product_detail_ext_feet_in,
														production_entry_product_detail_ext_feet_mm,
														production_entry_product_detail_ext_feet_met,
														production_entry_product_detail_tot_feet,
														production_entry_product_detail_tot_meter 
													FROM 
														production_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= production_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_brand_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= production_entry_product_detail_product_id	
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
														p_clr.product_colour_id 								= production_entry_product_detail_product_colour_id
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= production_entry_product_detail_product_colour_id
														
													WHERE 
														production_entry_product_detail_deleted_status		 	= 0 							AND 
														production_entry_product_detail_production_entry_id 		= '".$production_entry_id."'";
		$result_production_entry_product_detail 	= mysql_query($select_production_entry_product_detail);
		$count_production_entry 					= mysql_num_rows($result_production_entry_product_detail);
		$arr_production_entry_product_detail 		= array();
		while($record_production_entry_product_detail = mysql_fetch_array($result_production_entry_product_detail)) {
			$arr_production_entry_product_detail[] = $record_production_entry_product_detail;
		}
		return $arr_production_entry_product_detail;
	}

	function editQuotationRawProductDetail()

	{

		$production_entry_id 	= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_production_entry_raw_product_detail 	= "	SELECT 
														production_entry_raw_product_detail_id,
														production_entry_raw_product_detail_product_id,
														production_entry_raw_product_detail_width_inches,production_entry_raw_product_detail_width_mm,
														production_entry_raw_product_detail_product_thick,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														brand_name,
														product_colour_name,
														product_uom_name,
														production_entry_raw_product_detail_product_type,
														production_entry_raw_product_detail_grn_detail_id,
														production_entry_raw_product_detail_kg,
														production_entry_raw_product_detail_ton,
														production_entry_raw_product_detail_sl_feet,
														production_entry_raw_product_detail_sl_feet_mm,
														product_con_entry_osf_uom_ton
													FROM 
														production_entry_raw_product_details 
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= production_entry_raw_product_detail_product_id	
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
														production_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														production_entry_raw_product_detail_production_entry_id 		= '".$production_entry_id."'";
		$result_production_entry_raw_product_detail 	= mysql_query($select_production_entry_raw_product_detail);
		$count_production_entry 					= mysql_num_rows($result_production_entry_raw_product_detail);
		$arr_production_entry_raw_product_detail 		= array();
		while($record_production_entry_raw_product_detail = mysql_fetch_array($result_production_entry_raw_product_detail)) {
			$arr_production_entry_raw_product_detail[] = $record_production_entry_raw_product_detail;
		}
		return $arr_production_entry_raw_product_detail;

	}


	function editQuotationDamProductDetail()

	{

		$production_entry_id 	= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_production_entry_dam_product_detail 	= "	SELECT 

																production_entry_dam_product_detail_id,

																production_entry_dam_product_detail_product_id,

																product_name,

																product_uom_name,

																product_code,

																product_colour_name,

																product_thick_ness,brand_name,
																production_entry_dam_product_detail_width_inches,
																production_entry_dam_product_detail_width_mm,
																production_entry_dam_product_detail_sl_feet,
																production_entry_dam_product_detail_sl_feet_mm,
																production_entry_dam_product_detail_ton,
																production_entry_dam_product_detail_kg,
																product_con_entry_osf_uom_ton,
																product_con_entry_child_product_detail_thick_ness,
																product_con_entry_child_product_detail_color_id,
																product_con_entry_child_product_detail_code,
																product_con_entry_child_product_detail_name

															FROM 

																production_entry_dam_product_details 
															LEFT JOIN 
																product_con_entry_child_product_details 
															ON 
																product_con_entry_child_product_detail_id			= production_entry_dam_product_detail_product_id
															LEFT JOIN 

																products 

															ON 

																product_id 											= production_entry_dam_product_detail_product_id
																
																LEFT JOIN 

																	brands 
	
																ON 
	
																	brand_id										=product_brand_id

															LEFT JOIN 

																product_uoms 

															ON 

																product_uom_id 										= product_product_uom_id

															LEFT JOIN 

																product_colours 

															ON 

																product_colour_id 										= product_con_entry_child_product_detail_color_id

															WHERE 

																production_entry_dam_product_detail_deleted_status		= 0 							AND 

																production_entry_dam_product_detail_production_entry_id 		= '".$production_entry_id."'";

		$result_production_entry_dam_product_detail 	= mysql_query($select_production_entry_dam_product_detail);

		$count_production_entry 					= mysql_num_rows($result_production_entry_dam_product_detail);

		$arr_production_entry_dam_product_detail 	= array();

		

		while($record_production_entry_dam_product_detail = mysql_fetch_array($result_production_entry_dam_product_detail)) {

			$arr_production_entry_dam_product_detail[] = $record_production_entry_dam_product_detail;

		}

		return $arr_production_entry_dam_product_detail;

	}

	

	function editWorkDetail()

	{

		$production_entry_id 	= getId('production_entry', 'production_entry_id', 'production_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_production_entry_work_detail 	= "	SELECT 

															*	

														FROM 

															production_entry_work_details 

														WHERE 

															production_entry_work_detail_deleted_status		= 0 							AND 

															production_entry_work_detail_production_entry_id 		= '".$production_entry_id."'";

		$result_production_entry_work_detail 	= mysql_query($select_production_entry_work_detail);

		$count_production_entry 					= mysql_num_rows($result_production_entry_work_detail);

		$arr_production_entry_work_detail 	= array();

		

		while($record_production_entry_work_detail = mysql_fetch_array($result_production_entry_work_detail)) {

			$arr_production_entry_work_detail[] = $record_production_entry_work_detail;

		}

		return $arr_production_entry_work_detail;

	}

	function updateQuotation(){

		$production_entry_id                   							= trim($_POST['production_entry_id']);

		$production_entry_uniq_id                						= trim($_POST['production_entry_uniq_id']);

		$production_entry_branch_id                   			= trim($_POST['production_entry_branch_id']);

		$production_entry_date                 					= NdateDatabaseFormat($_POST['production_entry_date']);

		$production_entry_production_type            			= trim($_POST['production_entry_production_type']);

		$production_entry_godown_id          					= trim($_POST['production_entry_godown_id']);

		$production_entry_vendor_id      						= trim($_POST['production_entry_vendor_id']);

		$production_entry_type     								= trim($_POST['production_entry_type']);

		$production_entry_grn_entry_id     				= trim($_POST['production_entry_grn_entry_id']);

		$production_entry_grn_date                 				= NdateDatabaseFormat($_POST['production_entry_grn_date']);
		$production_entry_remarks								= trim($_POST['production_entry_remarks']);
		

		//Product Detail

		$production_entry_product_detail_id      						= $_POST['production_entry_product_detail_id'];
		$production_entry_product_detail_product_type      = $_POST['production_entry_product_detail_product_type'];
		$production_entry_product_detail_grn_detail_id     = $_POST['production_entry_product_detail_grn_detail_id'];
		$production_entry_product_detail_product_id     	= $_POST['production_entry_product_detail_product_id'];
		$production_entry_product_detail_product_thick  	= isset($_POST['production_entry_product_detail_product_thick'])?$_POST['production_entry_product_detail_product_thick']:'';
		$production_entry_product_detail_width_inches  	= isset($_POST['production_entry_product_detail_width_inches'])?$_POST['production_entry_product_detail_width_inches']:'';
		$production_entry_product_detail_width_mm 		  	= isset($_POST['production_entry_product_detail_width_mm'])?$_POST['production_entry_product_detail_width_mm']:'';
		$production_entry_product_detail_s_width_inches 	= isset($_POST['production_entry_product_detail_s_width_inches'])?$_POST['production_entry_product_detail_s_width_inches']:'';
		$production_entry_product_detail_s_width_mm 		= isset($_POST['production_entry_product_detail_s_width_mm'])?$_POST['production_entry_product_detail_s_width_mm']:'';
		$production_entry_product_detail_sl_feet 		  	= isset($_POST['production_entry_product_detail_sl_feet'])?$_POST['production_entry_product_detail_sl_feet']:'';
		$production_entry_product_detail_sl_feet_in 		= isset($_POST['production_entry_product_detail_sl_feet_in'])?$_POST['production_entry_product_detail_sl_feet_in']:'';
		$production_entry_product_detail_sl_feet_mm 		= isset($_POST['production_entry_product_detail_sl_feet_mm'])?$_POST['production_entry_product_detail_sl_feet_mm']:'';
		$production_entry_product_detail_s_weight_inches   = isset($_POST['production_entry_product_detail_s_weight_inches'])?$_POST['production_entry_product_detail_s_weight_inches']:'';
		$production_entry_product_detail_s_weight_mm   	= isset($_POST['production_entry_product_detail_s_weight_mm'])?$_POST['production_entry_product_detail_s_weight_mm']:'';
		$production_entry_product_detail_qty 			  	= $_POST['production_entry_product_detail_qty'];
		$production_entry_product_detail_tot_length 		= isset($_POST['production_entry_product_detail_tot_length'])?$_POST['production_entry_product_detail_tot_length']:'';
		$production_entry_product_detail_tot_feet 			  	= $_POST['production_entry_product_detail_tot_feet'];
		$production_entry_product_detail_tot_meter 			  	= $_POST['production_entry_product_detail_tot_meter'];
		
		$production_entry_raw_product_detail_id      			= $_POST['production_entry_raw_product_detail_id'];
		$production_entry_raw_product_detail_product_type      	= $_POST['production_entry_raw_product_detail_product_type'];
		$production_entry_raw_product_detail_grn_detail_id    	= $_POST['production_entry_raw_product_detail_grn_detail_id'];
		$production_entry_raw_product_detail_product_id     	= $_POST['production_entry_raw_product_detail_product_id'];
		$production_entry_raw_product_detail_product_thick  	= isset($_POST['production_entry_raw_product_detail_product_thick'])?$_POST['production_entry_raw_product_detail_product_thick']:'';
		$production_entry_raw_product_detail_width_inches  	= isset($_POST['production_entry_raw_product_detail_width_inches'])?$_POST['production_entry_raw_product_detail_width_inches']:'';
		$production_entry_raw_product_detail_width_mm 		  	= isset($_POST['production_entry_raw_product_detail_width_mm'])?$_POST['production_entry_raw_product_detail_width_mm']:'';
		$production_entry_raw_product_detail_s_width_inches 	= isset($_POST['production_entry_raw_product_detail_s_width_inches'])?$_POST['production_entry_raw_product_detail_s_width_inches']:'';
		$production_entry_raw_product_detail_s_width_mm 		= isset($_POST['production_entry_raw_product_detail_s_width_mm'])?$_POST['production_entry_raw_product_detail_s_width_mm']:'';
		$production_entry_raw_product_detail_sl_feet 		  	= isset($_POST['production_entry_raw_product_detail_sl_feet'])?$_POST['production_entry_raw_product_detail_sl_feet']:'';
		$production_entry_raw_product_detail_sl_feet_in 		= isset($_POST['production_entry_raw_product_detail_sl_feet_in'])?$_POST['production_entry_raw_product_detail_sl_feet_in']:'';
		$production_entry_raw_product_detail_sl_feet_mm 		= isset($_POST['production_entry_raw_product_detail_sl_feet_mm'])?$_POST['production_entry_raw_product_detail_sl_feet_mm']:'';
		$production_entry_raw_product_detail_s_weight_inches   = isset($_POST['production_entry_raw_product_detail_s_weight_inches'])?$_POST['production_entry_raw_product_detail_s_weight_inches']:'';
		$production_entry_raw_product_detail_s_weight_mm   	= isset($_POST['production_entry_raw_product_detail_s_weight_mm'])?$_POST['production_entry_raw_product_detail_s_weight_mm']:'';
		$production_entry_raw_product_detail_qty 			  	= $_POST['production_entry_raw_product_detail_qty'];
		$production_entry_raw_product_detail_tot_length 		= isset($_POST['production_entry_raw_product_detail_tot_length'])?$_POST['production_entry_raw_product_detail_tot_length']:'';


		

		// Work Assign Detail

		$production_entry_work_detail_id      							= $_POST['production_entry_work_detail_id'];

		$production_entry_work_detail_production_section_id    	 		= $_POST['production_entry_work_detail_production_section_id'];

		$production_entry_work_detail_production_machine_id   			= $_POST['production_entry_work_detail_production_machine_id'];

		$production_entry_work_detail_employee_id     					= $_POST['production_entry_work_detail_employee_id'];

		$production_entry_work_detail_from_date     					= $_POST['production_entry_work_detail_from_date'];

		$production_entry_work_detail_to_date     						= $_POST['production_entry_work_detail_to_date'];

		$production_entry_work_detail_due     							= $_POST['production_entry_work_detail_due'];

		$production_entry_work_detail_remarks  					=		 $_POST['production_entry_work_detail_remarks'];



		

		//Dam Product Detail

		$production_entry_dam_product_detail_id      					= $_POST['production_entry_dam_product_detail_id'];

		$production_entry_dam_product_detail_product_id     			= $_POST['production_entry_dam_product_detail_product_id'];

		$production_entry_dam_product_detail_raw_product_id  			= $_POST['production_entry_dam_product_detail_raw_product_id'];

		$production_entry_dam_product_detail_width_feet  				= $_POST['production_entry_dam_product_detail_width_feet'];

		$production_entry_dam_product_detail_width_inches  				= $_POST['production_entry_dam_product_detail_width_inches'];

		$production_entry_dam_product_detail_width_mm  					= $_POST['production_entry_dam_product_detail_width_mm'];

		$production_entry_dam_product_detail_width_meter  				= $_POST['production_entry_dam_product_detail_width_meter'];

		$production_entry_dam_product_detail_length_feet  				= $_POST['production_entry_dam_product_detail_length_feet'];

		$production_entry_dam_product_detail_length_inches  			= $_POST['production_entry_dam_product_detail_length_inches'];

		$production_entry_dam_product_detail_length_mm  				= $_POST['production_entry_dam_product_detail_length_mm'];

		$production_entry_dam_product_detail_length_meter  				= $_POST['production_entry_dam_product_detail_length_meter'];

		$production_entry_dam_product_detail_ext_length_feet  			= $_POST['production_entry_dam_product_detail_ext_length_feet'];

		$production_entry_dam_product_detail_ext_length_meter  			= $_POST['production_entry_dam_product_detail_ext_length_meter'];

		$production_entry_dam_product_detail_qty 						= $_POST['production_entry_dam_product_detail_qty'];

		

		$request_fields 						= ((!empty($production_entry_branch_id)) && (!empty($production_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "production-entry/index.php?page=edit&id=$production_entry_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 

															production_entry 

														SET 

															production_entry_branch_id 					= '%d',

															production_entry_date 						= '%s',
															production_entry_grn_date 						= '%s',
															production_entry_production_type 			= '%s',

															production_entry_godown_id 					= '%d',

															production_entry_vendor_id 					= '%d',

															production_entry_type 						= '%s',
															
															production_entry_remarks 					= '%s',

															production_entry_modified_by 				= '%d',

															production_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															production_entry_modified_ip				= '%s'

														WHERE               

															production_entry_id         				= '%d'", 

															$production_entry_branch_id,

															$production_entry_date,
															$production_entry_grn_date,

															$production_entry_production_type,

															$production_entry_godown_id,

															$production_entry_vendor_id,

															$production_entry_type,
															
															$production_entry_remarks,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$production_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($production_entry_product_detail_product_id); $i++) { 
		// echo $production_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($production_entry_product_detail_product_id[$i])) && 
									 							(!empty($production_entry_product_detail_tot_feet[$i])));
			if($detail_request_fields) {
				if(isset($production_entry_product_detail_id[$i]) && (!empty($production_entry_product_detail_id[$i]))) {

					 $update_production_entry_product_detail = sprintf("UPDATE 
																			production_entry_product_details 
																		SET  
																			production_entry_product_detail_width_inches  			= '%f',
																			production_entry_product_detail_width_mm  				= '%f',
																			production_entry_product_detail_s_width_inches  		= '%f',
																			production_entry_product_detail_s_width_mm  			= '%f',
																			production_entry_product_detail_sl_feet  				= '%f',
																			production_entry_product_detail_sl_feet_in  			= '%f',
																			production_entry_product_detail_sl_feet_mm  			= '%f',
																			production_entry_product_detail_s_weight_inches  		= '%f',
																			production_entry_product_detail_s_weight_mm  			= '%f',
																			production_entry_product_detail_tot_length  			= '%f',
																			production_entry_product_detail_qty  					= '%f',
																			production_entry_product_detail_tot_meter				= '%f',
																			production_entry_product_detail_tot_feet				= '%f',
																			production_entry_product_detail_modified_by 			= '%d',
																			production_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			production_entry_product_detail_modified_ip 			= '%s'
																		WHERE 
																			production_entry_product_detail_production_entry_id 			= '%d' AND 
																			production_entry_product_detail_id 					= '%d'",
																			$production_entry_product_detail_width_inches[$i],
																			$production_entry_product_detail_width_mm[$i],
																			$production_entry_product_detail_s_width_inches[$i],
																			$production_entry_product_detail_s_width_mm[$i],
																			$production_entry_product_detail_sl_feet[$i],
																			$production_entry_product_detail_sl_feet_in[$i],
																			$production_entry_product_detail_sl_feet_mm[$i],
																			$production_entry_product_detail_s_weight_inches[$i],
																			$production_entry_product_detail_s_weight_mm[$i],
																			$production_entry_product_detail_tot_length[$i],
																			$production_entry_product_detail_qty[$i],
																			$production_entry_product_detail_tot_meter[$i],
																			$production_entry_product_detail_tot_feet[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$production_entry_id, 
																			$production_entry_product_detail_id[$i]);	
			//	echo $update_production_entry_product_detail; exit;
					mysql_query($update_production_entry_product_detail);

				} else {
				$production_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_production_entry_product_detail 		= sprintf("INSERT INTO production_entry_product_details 
																				(production_entry_product_detail_uniq_id,production_entry_product_detail_production_entry_id,
																				 production_entry_product_detail_grn_detail_id,production_entry_product_detail_grn_entry_id,
																				 production_entry_product_detail_product_id,production_entry_product_detail_product_colour_id,
																				 production_entry_product_detail_product_type, production_entry_product_detail_product_thick,
																				 production_entry_product_detail_width_inches,production_entry_product_detail_width_mm,
																				 production_entry_product_detail_s_width_inches,production_entry_product_detail_s_width_mm,
																				 production_entry_product_detail_sl_feet,production_entry_product_detail_sl_feet_in,
																				 production_entry_product_detail_sl_feet_mm,production_entry_product_detail_sl_feet_met,
																				 production_entry_product_detail_ext_feet,production_entry_product_detail_ext_feet_in,
																				 production_entry_product_detail_ext_feet_mm,production_entry_product_detail_ext_feet_met,
																				 production_entry_product_detail_s_weight_inches,production_entry_product_detail_s_weight_mm,
																				 production_entry_product_detail_qty,production_entry_product_detail_tot_length,
																				 production_entry_product_detail_tot_feet,production_entry_product_detail_tot_meter,
																				 production_entry_product_detail_added_by, production_entry_product_detail_added_on,
																				 production_entry_product_detail_added_ip) 
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
																				'%d', UNIX_TIMESTAMP(NOW()), '%s')", 
																		 $production_entry_product_detail_uniq_id,$production_entry_id,
																		 $production_entry_product_detail_grn_detail_id[$i],$production_entry_product_detail_grn_entry_id,
																		 $production_entry_product_detail_product_id[$i],$production_entry_product_detail_product_colour_id[$i],
																		 $production_entry_product_detail_product_type[$i], $production_entry_product_detail_product_thick[$i],
																		 $production_entry_product_detail_width_inches[$i],$production_entry_product_detail_width_mm[$i],
																		 $production_entry_product_detail_s_width_inches[$i],$production_entry_product_detail_s_width_mm[$i],
																		 $production_entry_product_detail_sl_feet[$i],$production_entry_product_detail_sl_feet_in[$i],
																		 $production_entry_product_detail_sl_feet_mm[$i], $production_entry_product_detail_sl_feet_met[$i],
																		 $production_entry_product_detail_ext_feet[$i],$production_entry_product_detail_ext_feet_in[$i],
																		 $production_entry_product_detail_ext_feet_mm[$i], $production_entry_product_detail_ext_feet_met[$i],
																		 $production_entry_product_detail_s_weight_inches[$i],$production_entry_product_detail_s_weight_mm[$i],
																		 $production_entry_product_detail_qty[$i],$production_entry_product_detail_tot_length[$i],
																		 $production_entry_product_detail_tot_feet[$i],$production_entry_product_detail_tot_meter[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
				mysql_query($insert_production_entry_product_detail);
			}
		 }
		}
		

		// purchase order pproduct details

		// echo $production_entry_raw_product_detail_qty[$i]; exit;

		for($i = 0; $i < count($production_entry_raw_product_detail_product_id); $i++) { 
		// echo $production_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($production_entry_product_detail_product_id[$i])) && 
									 							(!empty($production_entry_raw_product_detail_ton[$i])));
			if($detail_request_fields) {
				if(isset($production_entry_raw_product_detail_id[$i]) && (!empty($production_entry_raw_product_detail_id[$i]))) {

				$update_production_entry_raw_product_detail = sprintf("UPDATE 
																		production_entry_raw_product_details 
																	SET  
																		production_entry_raw_product_detail_width_inches  			= '%f',
																		production_entry_raw_product_detail_width_mm  				= '%f',
																		production_entry_raw_product_detail_sl_feet  				= '%f',
																		production_entry_raw_product_detail_sl_feet_mm  			= '%f',
																		production_entry_raw_product_detail_ton  					= '%f',
																		production_entry_raw_product_detail_kg  					= '%f',
																		production_entry_raw_product_detail_modified_by 			= '%d',
																		production_entry_raw_product_detail_modified_on 			= NIX_TIMESTAMP(NOW()),
																		production_entry_raw_product_detail_modified_ip 			= '%s'
																	WHERE 
																		production_entry_raw_product_detail_production_entry_id 			= '%d' AND 
																		production_entry_raw_product_detail_id 					= '%d'",
																		$production_entry_raw_product_detail_width_inches[$i],
																		$production_entry_raw_product_detail_width_mm[$i],
																		$production_entry_raw_product_detail_sl_feet[$i],
																		$production_entry_raw_product_detail_sl_feet_mm[$i],
																		$production_entry_raw_product_detail_ton[$i],
																		$production_entry_raw_product_detail_kg[$i],
																		$_SESSION[SESS.'_session_user_id'], 
																		$ip, 
																		$production_entry_id, 
																		$production_entry_raw_product_detail_id[$i]);	
		//	echo $update_production_entry_raw_product_detail; exit;
				mysql_query($update_production_entry_raw_product_detail);

			} else {
				$production_entry_raw_product_detail_uniq_id 	= generateUniqId();
				$insert_production_entry_raw_product_detail 		= sprintf("INSERT INTO production_entry_raw_product_details 
																				(production_entry_raw_product_detail_uniq_id,
																				 production_entry_raw_product_detail_production_entry_id,
																				 production_entry_raw_product_detail_product_id,
																				 production_entry_raw_product_detail_grn_detail_id,
																				 production_entry_raw_product_detail_grn_entry_id,
																				 production_entry_raw_product_detail_product_colour_id,
																				 production_entry_raw_product_detail_product_type,
																				 production_entry_raw_product_detail_product_thick,
																				 production_entry_raw_product_detail_width_inches,production_entry_raw_product_detail_width_mm,
																				 production_entry_raw_product_detail_sl_feet,production_entry_raw_product_detail_sl_feet_mm,
																				 production_entry_raw_product_detail_ton,production_entry_raw_product_detail_kg,
																				 production_entry_raw_product_detail_added_by, production_entry_raw_product_detail_added_on,
																				 production_entry_raw_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $production_entry_raw_product_detail_uniq_id,$production_entry_id,
																		 $production_entry_raw_product_detail_product_id[$i],
																		 $production_entry_raw_product_detail_grn_detail_id[$i],
																		 $production_entry_grn_entry_id,$production_entry_raw_product_detail_product_colour_id[$i],
																		 $production_entry_raw_product_detail_product_type[$i],
																		 $production_entry_raw_product_detail_product_thick[$i],
																		 $production_entry_raw_product_detail_width_inches[$i],$production_entry_raw_product_detail_width_mm[$i],
																		 $production_entry_raw_product_detail_sl_feet[$i],$production_entry_raw_product_detail_sl_feet_mm[$i],
																		 $production_entry_raw_product_detail_ton[$i],$production_entry_raw_product_detail_kg[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
				mysql_query($insert_production_entry_raw_product_detail);
				
			}
		 }
		}
		

		// Work Assign details
		for($i = 0; $i < count($production_entry_work_detail_production_section_id); $i++) {

			$detail_request_fields 									= 	((!empty($production_entry_work_detail_production_section_id[$i])));

			if($detail_request_fields) {

				if(isset($production_entry_work_detail_id[$i]) && (!empty($production_entry_work_detail_id[$i]))) {

				 	$update_production_entry_work_detail = sprintf("	UPDATE 

																			production_entry_work_details 

																		SET  

																			production_entry_work_detail_production_section_id  	= '%d',

																			production_entry_work_detail_production_machine_id  	= '%d',

																			production_entry_work_detail_employee_id  				= '%d',

																			production_entry_work_detail_from_date  				= '%s',

																			production_entry_work_detail_to_date  					= '%s',

																			production_entry_work_detail_due  						= '%d',

																			production_entry_work_detail_remarks  					= '%s',

																			production_entry_work_detail_modified_by 				= '%d',

																			production_entry_work_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),

																			production_entry_work_detail_modified_ip 				= '%s'

																		WHERE 

																			production_entry_work_detail_production_entry_id 		= '%d' AND 

																			production_entry_work_detail_id 							= '%d'",

																			$production_entry_work_detail_production_section_id[$i],

																			$production_entry_work_detail_production_machine_id[$i],

																			$production_entry_work_detail_employee_id[$i],

																			NdateDatabaseFormat($production_entry_work_detail_from_date[$i]),

																			NdateDatabaseFormat($production_entry_work_detail_to_date[$i]),

																			$production_entry_work_detail_due[$i],

																			$production_entry_work_detail_remarks[$i],

																			$_SESSION[SESS.'_session_user_id'], 

																			$ip, 

																			$production_entry_id, 

																			$production_entry_work_detail_id[$i]);	

					//echo $update_production_entry_work_detail; exit;
					mysql_query($update_production_entry_work_detail);

				} else {

				$production_entry_work_detail_uniq_id 		= generateUniqId();

				$insert_production_entry_work_detail 		= sprintf("INSERT INTO production_entry_work_details 

																				(production_entry_work_detail_uniq_id,  

																				 production_entry_work_detail_production_section_id,

																				 production_entry_work_detail_production_machine_id,

																				 production_entry_work_detail_employee_id,production_entry_work_detail_from_date,

																				 production_entry_work_detail_to_date,production_entry_work_detail_due,

																				 production_entry_work_detail_remarks,production_entry_work_detail_production_entry_id,

																				 production_entry_work_detail_added_by,

																				 production_entry_work_detail_added_on,production_entry_work_detail_added_ip) 

																	VALUES     ('%s',

																 				'%d', '%d',

																				'%d', '%s', 

																				'%s', '%d', 

																				'%s', '%d', 

																				'%d', 

																				UNIX_TIMESTAMP(NOW()), '%s')", 

																				$production_entry_work_detail_uniq_id,

																		 		$production_entry_work_detail_production_section_id[$i],

																				$production_entry_work_detail_production_machine_id[$i],  

																				$production_entry_work_detail_employee_id[$i],

																				NdateDatabaseFormat($production_entry_work_detail_from_date[$i]),

																				NdateDatabaseFormat($production_entry_work_detail_to_date[$i]),

																				$production_entry_work_detail_due[$i],

																				$production_entry_work_detail_remarks[$i],$production_entry_id, 

																				$_SESSION[SESS.'_session_user_id'],$ip);

				mysql_query($insert_production_entry_work_detail);

				}

			}

		}

		//Dam Product Detail

		for($i = 0; $i < count($production_entry_dam_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($production_entry_dam_product_detail_raw_product_id[$i])) &&

									 (!empty($production_entry_dam_product_detail_qty[$i])));

			if($detail_request_fields) {

				if(isset($production_entry_dam_product_detail_id[$i]) && (!empty($production_entry_dam_product_detail_id[$i]))) {

					$update_production_entry_dam_product_detail = sprintf("	UPDATE 

																			production_entry_dam_product_details 

																		SET  

																			production_entry_dam_product_detail_qty  					= '%f',

																			production_entry_dam_product_detail_width_feet  			= '%f',

																			production_entry_dam_product_detail_width_inches  			= '%f',

																			production_entry_dam_product_detail_width_mm  				= '%f',

																			production_entry_dam_product_detail_width_meter  			= '%f',

																			production_entry_dam_product_detail_length_feet  			= '%f',

																			production_entry_dam_product_detail_length_inches  		= '%f',

																			production_entry_dam_product_detail_length_mm  			= '%f',

																			production_entry_dam_product_detail_length_meter  			= '%f',

																			production_entry_dam_product_detail_ext_length_feet  		= '%f',

																			production_entry_dam_product_detail_ext_length_meter  		= '%f',

																			production_entry_dam_product_detail_modified_by 			= '%d',

																			production_entry_dam_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),

																			production_entry_dam_product_detail_modified_ip 			= '%s'

																		WHERE 

																			production_entry_dam_product_detail_production_entry_id 			= '%d' AND 

																			production_entry_dam_product_detail_id 					= '%d'",

																			$production_entry_dam_product_detail_qty[$i],

																			$production_entry_dam_product_detail_width_feet[$i],

																			$production_entry_dam_product_detail_width_inches[$i],

																			$production_entry_dam_product_detail_width_mm[$i],

																			$production_entry_dam_product_detail_width_meter[$i],

																			$production_entry_dam_product_detail_length_feet[$i],

																			$production_entry_dam_product_detail_length_inches[$i],

																			$production_entry_dam_product_detail_length_mm[$i],

																				$production_entry_dam_product_detail_length_meter[$i],

																			$production_entry_dam_product_detail_ext_length_feet[$i],

																			$production_entry_dam_product_detail_ext_length_meter[$i],

																			$_SESSION[SESS.'_session_user_id'], 

																			$ip, 

																			$production_entry_id, 

																			$production_entry_dam_product_detail_id[$i]);	

					mysql_query($update_production_entry_dam_product_detail);

				} else {

				$production_entry_dam_product_detail_uniq_id = generateUniqId();

				$insert_production_entry_dam_product_detail 		= sprintf("INSERT INTO production_entry_dam_product_details 

																				(production_entry_dam_product_detail_uniq_id,  

																				 production_entry_dam_product_detail_raw_product_id,production_entry_dam_product_detail_product_id,

																				 production_entry_dam_product_detail_width_feet,production_entry_dam_product_detail_width_inches,

																				 production_entry_dam_product_detail_width_mm,production_entry_dam_product_detail_width_meter,

																				 production_entry_dam_product_detail_length_feet,production_entry_dam_product_detail_length_inches,

																				 production_entry_dam_product_detail_length_mm,production_entry_dam_product_detail_length_meter,

																				 production_entry_dam_product_detail_ext_length_feet,

																				 production_entry_dam_product_detail_ext_length_meter,

																				 production_entry_dam_product_detail_qty,

																				 production_entry_dam_product_detail_production_entry_id,

																				 production_entry_dam_product_detail_added_by,

																				 production_entry_dam_product_detail_added_on,production_entry_dam_product_detail_added_ip) 

																	VALUES     ('%s',

																 				'%d', '%d',

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%d', 

																				'%d', 

																				UNIX_TIMESTAMP(NOW()), '%s')", 

																				$production_entry_dam_product_detail_uniq_id,

																		 		$production_entry_dam_product_detail_raw_product_id[$i],

																				$production_entry_dam_product_detail_product_id[$i],  

																				$production_entry_dam_product_detail_width_feet[$i],

																				$production_entry_dam_product_detail_width_inches[$i],

																				$production_entry_dam_product_detail_width_mm[$i],

																				$production_entry_dam_product_detail_width_meter[$i],

																				$production_entry_dam_product_detail_length_feet[$i],

																				$production_entry_dam_product_detail_length_inches[$i],

																				$production_entry_dam_product_detail_length_mm[$i],

																				$production_entry_dam_product_detail_length_meter[$i],

																		 		$production_entry_dam_product_detail_ext_length_feet[$i],

																		 		$production_entry_dam_product_detail_ext_length_meter[$i],

																				$production_entry_dam_product_detail_qty[$i],$production_entry_id, 

																				$_SESSION[SESS.'_session_user_id'],$ip);

				mysql_query($insert_production_entry_dam_product_detail);

				}

			}

		

		}

		pageRedirection("production-entry/index.php?page=edit&id=$production_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['production_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$production_entry_uniq_id = $_GET['production_entry_uniq_id'];
			
			if($_REQUEST['type']==1){
			
			mysql_query("UPDATE production_entry_product_details SET production_entry_product_detail_deleted_status = 1 

						WHERE production_entry_product_detail_id = ".$product_detail_id." ");
			}else{
			
			mysql_query("UPDATE production_entry_raw_product_details SET production_entry_raw_product_detail_deleted_status = 1 

						WHERE production_entry_raw_product_detail_id = ".$product_detail_id." ");
			}
			header("Location:index.php?page=edit&id=$production_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('production_entry', 'production_entry_deleted_by', 'production_entry_deleted_on' , 'production_entry_deleted_ip','production_entry_deleted_status', 'production_entry_id', 'production_entry_uniq_id', '1');

		

		deleteMultiRecords('production_entry_product_details', 'production_entry_product_detail_deleted_by', 'production_entry_product_detail_deleted_on', 'production_entry_product_detail_deleted_ip', 'production_entry_product_detail_deleted_status', 'production_entry_product_detail_production_entry_id', 'production_entry','production_entry_id','production_entry_uniq_id', '1');  

		deleteMultiRecords('production_entry_raw_product_details', 'production_entry_raw_product_detail_deleted_by', 'production_entry_raw_product_detail_deleted_on', 'production_entry_raw_product_detail_deleted_ip', 'production_entry_raw_product_detail_deleted_status', 'production_entry_raw_product_detail_production_entry_id	', 'production_entry','production_entry_id','production_entry_uniq_id', '1');  

		

		pageRedirection("production-entry/index.php?msg=7");				

	}

?>