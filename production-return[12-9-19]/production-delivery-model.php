<?php

	function insertprn(){

		$prn_entry_branch_id                   				= trim($_POST['prn_entry_branch_id']);
		$prn_entry_date                 					= NdateDatabaseFormat($_POST['prn_entry_date']);
		$prn_entry_from_godown_id            				= trim($_POST['prn_entry_from_godown_id']);
		$prn_entry_production_section_id          			= trim($_POST['prn_entry_production_section_id']);
		$prn_entry_to_godown_id      						= trim($_POST['prn_entry_to_godown_id']);
		$prn_entry_type_id     								= trim($_POST['prn_entry_type_id']);
		$prn_entry_production_entry_id						= trim($_POST['prn_entry_production_entry_id']);
		
	
		//Product Detail
		$prn_entry_product_detail_product_type      		= $_POST['prn_entry_product_detail_product_type'];
		$prn_entry_product_detail_production_detail_id     	= $_POST['prn_entry_product_detail_production_detail_id'];
		$prn_entry_product_detail_product_id     			= $_POST['prn_entry_product_detail_product_id'];
		$prn_entry_product_detail_product_colour_id			= $_POST['prn_entry_product_detail_product_colour_id'];
		$prn_entry_product_detail_product_thick			  	= isset($_POST['prn_entry_product_detail_product_thick'])?$_POST['prn_entry_product_detail_product_thick']:'';
		$prn_entry_product_detail_width_inches		  		= isset($_POST['prn_entry_product_detail_width_inches'])?$_POST['prn_entry_product_detail_width_inches']:'';
		$prn_entry_product_detail_width_mm 		  			= isset($_POST['prn_entry_product_detail_width_mm'])?$_POST['prn_entry_product_detail_width_mm']:'';
		$prn_entry_product_detail_s_width_inches 			= isset($_POST['prn_entry_product_detail_s_width_inches'])?$_POST['prn_entry_product_detail_s_width_inches']:'';
		$prn_entry_product_detail_s_width_mm 				= isset($_POST['prn_entry_product_detail_s_width_mm'])?$_POST['prn_entry_product_detail_s_width_mm']:'';
		$prn_entry_product_detail_sl_feet 		  			= isset($_POST['prn_entry_product_detail_sl_feet'])?$_POST['prn_entry_product_detail_sl_feet']:'';
		$prn_entry_product_detail_sl_feet_in 				= isset($_POST['prn_entry_product_detail_sl_feet_in'])?$_POST['prn_entry_product_detail_sl_feet_in']:'';
		$prn_entry_product_detail_sl_feet_mm 				= isset($_POST['prn_entry_product_detail_sl_feet_mm'])?$_POST['prn_entry_product_detail_sl_feet_mm']:'';
		$prn_entry_product_detail_sl_feet_met 				= isset($_POST['prn_entry_product_detail_sl_feet_met'])?$_POST['prn_entry_product_detail_sl_feet_met']:'';
		$prn_entry_product_detail_ext_feet 		  			= isset($_POST['prn_entry_product_detail_ext_feet'])?$_POST['prn_entry_product_detail_ext_feet']:'';
		$prn_entry_product_detail_ext_feet_in 				= isset($_POST['prn_entry_product_detail_ext_feet_in'])?$_POST['prn_entry_product_detail_ext_feet_in']:'';
		$prn_entry_product_detail_ext_feet_mm 				= isset($_POST['prn_entry_product_detail_ext_feet_mm'])?$_POST['prn_entry_product_detail_ext_feet_mm']:'';
		$prn_entry_product_detail_ext_feet_met 				= isset($_POST['prn_entry_product_detail_ext_feet_met'])?$_POST['prn_entry_product_detail_ext_feet_met']:'';
		$prn_entry_product_detail_s_weight_inches 			= isset($_POST['prn_entry_product_detail_s_weight_inches'])?$_POST['prn_entry_product_detail_s_weight_inches']:'';
		$prn_entry_product_detail_s_weight_mm   		= isset($_POST['prn_entry_product_detail_s_weight_mm'])?$_POST['prn_entry_product_detail_s_weight_mm']:'';
		$prn_entry_product_detail_qty 			  	= $_POST['prn_entry_product_detail_qty'];
		$prn_entry_product_detail_tot_length 		= isset($_POST['prn_entry_product_detail_tot_length'])?$_POST['prn_entry_product_detail_tot_length']:'';
		$prn_entry_product_detail_sw_check			= isset($_POST['prn_entry_product_detail_sw_check'])?$_POST['prn_entry_product_detail_sw_check']:'';
		$prn_entry_product_detail_tot_meter 			= $_POST['prn_entry_product_detail_tot_meter'];
		$prn_entry_product_detail_tot_feet 			  		= $_POST['prn_entry_product_detail_tot_feet'];
		$prn_entry_product_detail_mother_child_type 			  		= $_POST['prn_entry_product_detail_mother_child_type'];
		

		$request_fields 									= ((!empty($prn_entry_branch_id)) && (!empty($prn_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "production-return/index.php?page=add&msg=5");

		$prn_entry_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();

		

		$select_prn_entry_no						= "SELECT 

																	MAX(prn_entry_no) AS maxval 

															   FROM 

																	 prn_entry 

															   WHERE 

																	prn_entry_deleted_status 	= 0 												AND

																	prn_entry_branch_id 		= '".$prn_entry_branch_id."'						AND

																	prn_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND

																	prn_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_prn_entry_no 						= mysql_query($select_prn_entry_no);

		$record_prn_entry_no 						= mysql_fetch_array($result_prn_entry_no);	

		$maxval 											= $record_prn_entry_no['maxval']; 

		if($maxval > 0) {

			$prn_entry_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$prn_entry_no 							= substr(('00000'.++$maxval),-5);

		}

		

		

		 $insert_prn_entry 					= sprintf("INSERT INTO prn_entry  (prn_entry_uniq_id, prn_entry_date,

																			  prn_entry_from_godown_id,prn_entry_to_godown_id,

																			  prn_entry_production_section_id,prn_entry_production_entry_id,

																			  prn_entry_no,

																			  prn_entry_branch_id,prn_entry_added_by,

																			  prn_entry_added_on,prn_entry_added_ip,

																			  prn_entry_company_id,prn_entry_financial_year,
																			  prn_entry_type_id) 

															VALUES 	 		 ('%s', '%s', 

																			  '%d', '%d', 

																			  '%d', '%d',

																			  '%s',

																			  '%d', '%d', 

																			   UNIX_TIMESTAMP(NOW()),

																			  '%s', '%d', '%d','%d')", 

																			 $prn_entry_uniq_id, $prn_entry_date,

																			 $prn_entry_from_godown_id,$prn_entry_to_godown_id,

																			 $prn_entry_production_section_id,$prn_entry_production_entry_id,

																			 $prn_entry_no,

																			 $prn_entry_branch_id,$_SESSION[SESS.'_session_user_id'],

																			 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																			 $prn_entry_type_id); 

		mysql_query($insert_prn_entry);

		//echo $insert_pdo_entry; exit;

		$prn_entry_id 						= mysql_insert_id(); 
		for($i = 0; $i < count($prn_entry_product_detail_product_id); $i++) { 
		// echo $pdo_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($prn_entry_product_detail_product_id[$i])) );
			if($detail_request_fields) {
				$prn_entry_product_detail_uniq_id 	= generateUniqId();
				 $insert_prn_entry_product_detail 		= sprintf("INSERT INTO prn_entry_product_details 
																				(prn_entry_product_detail_uniq_id,prn_entry_product_detail_prn_entry_id,
																				 prn_entry_product_detail_production_detail_id,
																				 prn_entry_product_detail_production_entry_id,
																				 prn_entry_product_detail_product_id,
																				 prn_entry_product_detail_product_colour_id,
																				 prn_entry_product_detail_product_type, 
																				 prn_entry_product_detail_product_thick,
																				 prn_entry_product_detail_width_inches,prn_entry_product_detail_width_mm,
																				 prn_entry_product_detail_s_width_inches,prn_entry_product_detail_s_width_mm,
																				 prn_entry_product_detail_sl_feet,prn_entry_product_detail_sl_feet_in,
																				 prn_entry_product_detail_sl_feet_mm,prn_entry_product_detail_sl_feet_met,
																				 prn_entry_product_detail_ext_feet,prn_entry_product_detail_ext_feet_in,
																				 prn_entry_product_detail_ext_feet_mm,prn_entry_product_detail_ext_feet_met,
																				 prn_entry_product_detail_qty,prn_entry_product_detail_tot_length,
																				 prn_entry_product_detail_added_by, prn_entry_product_detail_added_on,
																				 prn_entry_product_detail_added_ip,prn_entry_product_detail_sw_check,
																				 prn_entry_product_detail_tot_meter,prn_entry_product_detail_tot_feet,
																				 prn_entry_product_detail_s_weight_inches,
																				 prn_entry_product_detail_s_weight_mm,
																				 prn_entry_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d','%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f','%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' ,'%d','%d','%d' ,'%d','%d','%d'   )", 
																		 $prn_entry_product_detail_uniq_id,$prn_entry_id,
																		 $prn_entry_product_detail_production_detail_id[$i],$prn_entry_production_entry_id,
																		 $prn_entry_product_detail_product_id[$i],$prn_entry_product_detail_product_colour_id[$i],
																		 $prn_entry_product_detail_product_type[$i], $prn_entry_product_detail_product_thick[$i],
																		 $prn_entry_product_detail_width_inches[$i],$prn_entry_product_detail_width_mm[$i],
																		 $prn_entry_product_detail_s_width_inches[$i],$prn_entry_product_detail_s_width_mm[$i],
																		 $prn_entry_product_detail_sl_feet[$i],$prn_entry_product_detail_sl_feet_in[$i],
																		 $prn_entry_product_detail_sl_feet_mm[$i],$prn_entry_product_detail_sl_feet_met[$i],
																		 $prn_entry_product_detail_ext_feet[$i],$prn_entry_product_detail_ext_feet_in[$i],
																		 $prn_entry_product_detail_ext_feet_mm[$i],$prn_entry_product_detail_ext_feet_met[$i],
																		 $prn_entry_product_detail_qty[$i],$prn_entry_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$prn_entry_product_detail_sw_check[$i],
																		 $prn_entry_product_detail_tot_meter[$i],$prn_entry_product_detail_tot_feet[$i],
																		 $prn_entry_product_detail_s_weight_inches[$i],
																		 $prn_entry_product_detail_s_weight_mm[$i],
																		 $prn_entry_product_detail_mother_child_type[$i]);
																		// echo $insert_pdo_entry_product_detail; exit;
				mysql_query($insert_prn_entry_product_detail);
				$detail_id											= 	mysql_insert_id();
				
				
				if($prn_entry_type_id==4){
							$produt_id											=	$prn_entry_product_detail_product_id[$i];
							$product_colour_id									=	1;
							$product_thick										=	1;
							$width_inches										= 	1;
							$width_mm											= 	1;
							$length_feet										= 	1; 
							$length_meter										= 	1;
							$product_detail_qty									= 	$prn_entry_product_detail_qty[$i];
							$stock_ledger_entry_type							= 	"production-entry-fin";
							$product_con_entry_godown_id						= 	$prn_entry_from_godown_id;
							$child_type											= 	$prn_entry_product_detail_mother_child_type[$i];
							//echo $product_detail_qty;exit;
							stockLedger($child_type,'in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							
							if(isset($prn_entry_product_detail_sw_check[$i]) && $prn_entry_product_detail_sw_check[$i]==1){ 
								$product_con_entry_godown_id						= 	$prn_entry_from_godown_id;
								stockLedger($child_type,'in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
							
							$product_con_entry_godown_id						= 	$prn_entry_to_godown_id;
							stockLedger($child_type,'out',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$product_detail_qty), $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							
				}
				else{		
							$produt_id											=	$prn_entry_product_detail_product_id[$i];
							$product_colour_id									=	$prn_entry_product_detail_product_colour_id[$i];
							$product_thick										=	$prn_entry_product_detail_product_thick[$i];
							$width_inches										= 	$prn_entry_product_detail_width_inches[$i];
							$width_mm											= 	$prn_entry_product_detail_width_mm[$i];
							$length_feet										= 	$prn_entry_product_detail_sl_feet[$i];
							$length_meter										= 	$prn_entry_product_detail_sl_feet_met[$i];
							if($prn_entry_type_id==1){
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$rec_product['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$ton_qty										= 	$total_ton*$length_feet;
								$kg_qty											= 	$ton_qty*1000;
							}
							else{
								$ton_qty										= 	$prn_entry_product_detail_s_weight_inches[$i];
								$kg_qty											= 	$prn_entry_product_detail_s_weight_mm[$i];
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$rec_product['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$length_feet									= 	($prn_entry_product_detail_sl_feet[$i]/$total_ton);
								
								$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
								$length_meter									= 	$product_cal['3'];
							}
							$product_detail_qty									= 	$prn_entry_product_detail_qty[$i]; //echo $product_detail_qty;exit;
							$stock_ledger_entry_type							= 	"production-return-fin";
							$child_type											= 	$prn_entry_product_detail_mother_child_type[$i];
							
							
							/*stockLedger('in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);*/
							
							$product_con_entry_godown_id						= 	$prn_entry_to_godown_id;
							
							if(isset($prn_entry_product_detail_sw_check[$i]) && $prn_entry_product_detail_sw_check[$i]==1){ //echo $product_detail_qty;exit;
								
							stockLedger($child_type,'in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id, '2', $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
							
							}//echo $product_detail_qty;exit;
							stockLedger($child_type,'in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id, '1', $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
							$product_con_entry_godown_id						= 	$prn_entry_from_godown_id;
							
							//$product_con_entry_godown_id						= 	"3";
							
							
							stockLedger($child_type,'out',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$product_detail_qty), $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
				}				
				
				
			}
		}
	
		$prn_entry_raw_product_detail_product_id      		= $_POST['prn_entry_raw_product_detail_product_id'];
		$prn_entry_raw_product_detail_product_type     		= $_POST['prn_entry_raw_product_detail_product_type'];
		$prn_entry_raw_product_detail_production_detail_id	= $_POST['prn_entry_raw_product_detail_production_detail_id'];
		$prn_entry_raw_product_detail_product_colour_id		= $_POST['prn_entry_raw_product_detail_product_colour_id'];
		$prn_entry_raw_product_detail_product_thick      	= $_POST['prn_entry_raw_product_detail_product_thick'];
		$prn_entry_raw_product_detail_width_inches     		= $_POST['prn_entry_raw_product_detail_width_inches'];
		$prn_entry_raw_product_detail_width_mm     			= $_POST['prn_entry_raw_product_detail_width_mm'];
		$prn_entry_raw_product_detail_sl_feet				= $_POST['prn_entry_raw_product_detail_sl_feet'];
		$prn_entry_raw_product_detail_sl_feet_mm      		= $_POST['prn_entry_raw_product_detail_sl_feet_mm'];
		$prn_entry_raw_product_detail_ton			     	= $_POST['prn_entry_raw_product_detail_ton'];
		$prn_entry_raw_product_detail_kg	     			= $_POST['prn_entry_raw_product_detail_kg'];
		
		
		for($i = 0; $i < count($prn_entry_raw_product_detail_product_id); $i++) { 
		// echo $pdo_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($prn_entry_raw_product_detail_product_id[$i])) && 
									 							(!empty($prn_entry_raw_product_detail_sl_feet[$i])));
			if($detail_request_fields) {
				$prn_entry_raw_product_detail_uniq_id 	= generateUniqId();
				  $insert_prn_entry_raw_product_detail 		= sprintf("INSERT INTO prn_entry_raw_product_details 
																				(prn_entry_raw_product_detail_uniq_id,
																				 prn_entry_raw_product_detail_prn_entry_id,
																				 prn_entry_raw_product_detail_production_detail_id,
																				 prn_entry_raw_product_detail_product_id,
																				 prn_entry_raw_product_detail_product_colour_id,
																				 prn_entry_raw_product_detail_product_type,
																				 prn_entry_raw_product_detail_product_thick, 
																				 prn_entry_raw_product_detail_width_inches,
																				 prn_entry_raw_product_detail_width_mm,prn_entry_raw_product_detail_sl_feet,
																				 prn_entry_raw_product_detail_sl_feet_mm,prn_entry_raw_product_detail_ton,
																				 
																				 prn_entry_raw_product_detail_kg,
																				 prn_entry_raw_product_detail_added_by, prn_entry_raw_product_detail_added_on,
																				 prn_entry_raw_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d','%d', 
																				'%d','%d', 
																				'%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $prn_entry_raw_product_detail_uniq_id,$prn_entry_id,
																		 $prn_entry_raw_product_detail_production_detail_id[$i],
																		 $prn_entry_raw_product_detail_product_id[$i],
																		 $prn_entry_raw_product_detail_product_colour_id[$i],
																		 $prn_entry_raw_product_detail_product_type[$i],
																		 $prn_entry_raw_product_detail_product_thick[$i], 
																		 $prn_entry_raw_product_detail_width_inches[$i],
																		 $prn_entry_raw_product_detail_width_mm[$i],
																		 $prn_entry_raw_product_detail_sl_feet[$i],
																		 $prn_entry_raw_product_detail_sl_feet_mm[$i],
																		 $prn_entry_raw_product_detail_ton[$i],$prn_entry_raw_product_detail_kg[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
																		 //echo $insert_prn_entry_raw_product_detail; exit;
				mysql_query($insert_prn_entry_raw_product_detail);
				
				$detail_id			= mysql_insert_id();
						$produt_id											=	$prn_entry_product_detail_product_id[$i];
							$product_colour_id								=	$prn_entry_product_detail_product_colour_id[$i];
							$product_thick									=	$prn_entry_product_detail_product_thick[$i];
							$width_inches									= 	$prn_entry_product_detail_width_inches[$i];
							$width_mm										= 	$prn_entry_product_detail_width_mm[$i];
							$length_feet									= 	$prn_entry_product_detail_sl_feet[$i];
							$length_meter									= 	$prn_entry_product_detail_sl_feet_met[$i];
						$ton_qty											= 	$prn_entry_product_detail_s_weight_inches[$i];
						$kg_qty												= 	$prn_entry_product_detail_s_weight_mm[$i];
						$product_detail_qty									= 	$prn_entry_product_detail_qty[$i];
						$stock_ledger_entry_type							= 	"purchase-entry-raw";
						$product_con_entry_godown_id						= 	$prn_entry_to_godown_id;
						stockLedger('1','in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$product_colour_id,$product_thick);
				
			}
		}
		//exit;
		pageRedirection("production-return/index.php?page=add&msg=1");

	}

	function listQuotation(){
	$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND prn_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND prn_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}

	  	$select_pdo_entry		=	"SELECT 

												prn_entry_id,

												prn_entry_uniq_id,

												prn_entry_no,

												prn_entry_date,

												prn_entry_from_godown_id,

												godown_name,
												customer_name,
													customer_billing_address,
													customer_mobile_no,
													production_order_customer_id,
													
													gin_entry_production_order_id,
													production_order_no
											 FROM 

												prn_entry
												
												LEFT JOIN
													
														production_entry
													 ON
														production_entry_id															= prn_entry_production_entry_id	
														
											LEFT JOIN
												grn_entry
												 ON
												grn_entry_id															= production_entry_grn_entry_id
												
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

												godowns

											 ON

												godown_id							=  prn_entry_from_godown_id

											 WHERE 

												prn_entry_deleted_status 		= 	0	$where

											 ORDER BY 

												prn_entry_no ASC";

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

		$prn_entry_id 			= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_pdo_entry		=	"SELECT 

												prn_entry_uniq_id,  prn_entry_no,

												prn_entry_date,prn_entry_from_godown_id,

												prn_entry_to_godown_id,prn_entry_production_section_id,

												prn_entry_production_entry_id, prn_entry_branch_id,
												prn_entry_type_id,prn_entry_id

											 FROM 

												prn_entry 
											
											 WHERE 

												prn_entry_deleted_status 	=  0 			AND 

												prn_entry_id				= '".$prn_entry_id."'

											 ORDER BY 

												prn_entry_no ASC";

		$result_pdo_entry 		= mysql_query($select_pdo_entry);

		$record_pdo_entry 		= mysql_fetch_array($result_pdo_entry);

		return $record_pdo_entry;

	}

	function editSalesdetail(){

		$pdo_entry_id 			= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$production_entry_id 	= getId('prn_entry', 'prn_entry_production_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

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

		$prn_entry_id 	= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id',  dataValidation($_GET['id'])); 

		 $select_pdo_entry_product_detail 	= "	SELECT 
														prn_entry_product_detail_id,
														prn_entry_product_detail_prn_entry_id,
														prn_entry_product_detail_product_id,prn_entry_product_detail_product_colour_id
														prn_entry_product_detail_product_type,prn_entry_product_detail_product_thick,
														prn_entry_product_detail_width_inches,prn_entry_product_detail_width_mm,
														prn_entry_product_detail_s_width_inches,prn_entry_product_detail_s_width_mm,
														prn_entry_product_detail_sl_feet,prn_entry_product_detail_sl_feet_in,
														prn_entry_product_detail_sl_feet_mm,prn_entry_product_detail_sl_feet_met,
														prn_entry_product_detail_ext_feet,prn_entry_product_detail_ext_feet_in,
														prn_entry_product_detail_ext_feet_mm,prn_entry_product_detail_ext_feet_met,
														prn_entry_product_detail_qty,prn_entry_product_detail_tot_length,
														prn_entry_product_detail_sw_check, prn_entry_product_detail_product_colour_id,
														product_name,
														product_code,
														product_colour_name,
														brand_name,
														product_uom_name,
														prn_entry_product_detail_s_weight_inches,
														prn_entry_product_detail_s_weight_mm,
														prn_entry_product_detail_tot_feet,
														prn_entry_product_detail_tot_meter
													
														
													FROM 
														prn_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= prn_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_brand_id
														
													LEFT JOIN 
														product_uoms
													ON 
														product_uom_id 									= product_product_uom_id
													
													LEFT JOIN 
														product_colours 
													ON 
														product_colour_id 								= prn_entry_product_detail_product_colour_id
														
													WHERE 
														prn_entry_product_detail_deleted_status		 	= 0 							AND 
														prn_entry_product_detail_prn_entry_id 		= '".$prn_entry_id."'";
		//echo $select_pdo_entry_product_detail;exit;
		$result_pdo_entry_product_detail 	= mysql_query($select_pdo_entry_product_detail);
		$count_pdo_entry 					= mysql_num_rows($result_pdo_entry_product_detail);
		$arr_pdo_entry_product_detail 		= array();
		while($record_pdo_entry_product_detail = mysql_fetch_array($result_pdo_entry_product_detail)) {
			$arr_pdo_entry_product_detail[] = $record_pdo_entry_product_detail;
		}
		return $arr_pdo_entry_product_detail;
	}
function editQuotationrawProductDetail()

	{

		$prn_entry_id 	= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id',  dataValidation($_GET['id'])); 

		 $select_pdo_entry_product_detail 	= "	SELECT 
														*
													FROM 
														 prn_entry_raw_product_details 
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id 		= 	prn_entry_raw_product_detail_product_id
													
													LEFT JOIN 
														products 
													ON 
														product_id 		= 	product_con_entry_child_product_detail_product_id
														
													LEFT JOIN 
														brands 
													ON 
														brand_id 		= product_brand_id
														
													LEFT JOIN 
														product_uoms
													ON 
														product_uom_id 									= product_product_uom_id
													
													LEFT JOIN 
														product_colours 
													ON 
														product_colour_id 								= prn_entry_raw_product_detail_product_colour_id
														
													WHERE 
														prn_entry_raw_product_detail_deleted_status		 	= 0 							AND 
														prn_entry_raw_product_detail_prn_entry_id 		= '".$prn_entry_id."'";
		//echo $select_pdo_entry_product_detail;exit;												
		$result_pdo_entry_product_detail 	= mysql_query($select_pdo_entry_product_detail);
		$count_pdo_entry 					= mysql_num_rows($result_pdo_entry_product_detail);
		$arr_pdo_entry_product_detail 		= array();
		while($record_pdo_entry_product_detail = mysql_fetch_array($result_pdo_entry_product_detail)) {
			$arr_pdo_entry_product_detail[] = $record_pdo_entry_product_detail;
		}
		return $arr_pdo_entry_product_detail;
	}


	function updateQuotation(){

		$prn_entry_branch_id                   			= trim($_POST['prn_entry_branch_id']);
		$prn_entry_date                 				= NdateDatabaseFormat($_POST['prn_entry_date']);
		$prn_entry_from_godown_id            			= trim($_POST['prn_entry_from_godown_id']);
		$prn_entry_production_section_id          		= trim($_POST['prn_entry_production_section_id']);
		$prn_entry_to_godown_id      					= trim($_POST['prn_entry_to_godown_id']);
		$prn_entry_type_id     							= trim($_POST['prn_entry_type_id']);
		$prn_entry_production_entry_id					= trim($_POST['prn_entry_production_entry_id']);
	
		//Product Detail
		$prn_entry_product_detail_product_type      		= $_POST['prn_entry_product_detail_product_type'];
		$prn_entry_product_detail_production_detail_id     	= $_POST['prn_entry_product_detail_production_detail_id'];
		$prn_entry_product_detail_product_id     			= $_POST['prn_entry_product_detail_product_id'];
		$prn_entry_product_detail_product_colour_id			= $_POST['prn_entry_product_detail_product_colour_id']; 
		$prn_entry_product_detail_product_thick			  	= isset($_POST['prn_entry_product_detail_product_thick'])?$_POST['prn_entry_product_detail_product_thick']:'';
		$prn_entry_product_detail_width_inches		  		= isset($_POST['prn_entry_product_detail_width_inches'])?$_POST['prn_entry_product_detail_width_inches']:'';
		$prn_entry_product_detail_width_mm 		  			= isset($_POST['prn_entry_product_detail_width_mm'])?$_POST['prn_entry_product_detail_width_mm']:'';
		$prn_entry_product_detail_s_width_inches 			= isset($_POST['prn_entry_product_detail_s_width_inches'])?$_POST['prn_entry_product_detail_s_width_inches']:'';
		$prn_entry_product_detail_s_width_mm 				= isset($_POST['prn_entry_product_detail_s_width_mm'])?$_POST['prn_entry_product_detail_s_width_mm']:'';
		$prn_entry_product_detail_sl_feet 		  			= isset($_POST['prn_entry_product_detail_sl_feet'])?$_POST['prn_entry_product_detail_sl_feet']:'';
		$prn_entry_product_detail_sl_feet_in 				= isset($_POST['prn_entry_product_detail_sl_feet_in'])?$_POST['prn_entry_product_detail_sl_feet_in']:'';
		$prn_entry_product_detail_sl_feet_mm 				= isset($_POST['prn_entry_product_detail_sl_feet_mm'])?$_POST['prn_entry_product_detail_sl_feet_mm']:'';
		$prn_entry_product_detail_sl_feet_met 				= isset($_POST['prn_entry_product_detail_sl_feet_met'])?$_POST['prn_entry_product_detail_sl_feet_met']:'';
		$prn_entry_product_detail_ext_feet 		  			= isset($_POST['prn_entry_product_detail_ext_feet'])?$_POST['prn_entry_product_detail_ext_feet']:'';
		$prn_entry_product_detail_ext_feet_in 				= isset($_POST['prn_entry_product_detail_ext_feet_in'])?$_POST['prn_entry_product_detail_ext_feet_in']:'';
		$prn_entry_product_detail_ext_feet_mm 				= isset($_POST['prn_entry_product_detail_ext_feet_mm'])?$_POST['prn_entry_product_detail_ext_feet_mm']:'';
		$prn_entry_product_detail_ext_feet_met 				= isset($_POST['prn_entry_product_detail_ext_feet_met'])?$_POST['prn_entry_product_detail_ext_feet_met']:'';
		$prn_entry_product_detail_s_weight_inches 			= isset($_POST['prn_entry_product_detail_s_weight_inches'])?$_POST['prn_entry_product_detail_s_weight_inches']:'';
		$prn_entry_product_detail_s_weight_mm   		= isset($_POST['prn_entry_product_detail_s_weight_mm'])?$_POST['prn_entry_product_detail_s_weight_mm']:'';
		$prn_entry_product_detail_qty 			  	= $_POST['prn_entry_product_detail_qty'];
		$prn_entry_product_detail_tot_length 		= isset($_POST['prn_entry_product_detail_tot_length'])?$_POST['prn_entry_product_detail_tot_length']:'';
		$prn_entry_product_detail_sw_check			= isset($_POST['prn_entry_product_detail_sw_check'])?$_POST['prn_entry_product_detail_sw_check']:'';
		$prn_entry_product_detail_tot_meter 			= $_POST['prn_entry_product_detail_tot_meter'];
		$prn_entry_product_detail_tot_feet 			  		= $_POST['prn_entry_product_detail_tot_feet'];
		//Product Detail

		$prn_entry_product_detail_id      			= $_POST['prn_entry_product_detail_id'];
		$prn_entry_id                   			= trim($_POST['prn_entry_id']);
		$prn_entry_uniq_id							= $_POST['prn_entry_uniq_id'];
		


		$request_fields 						= ((!empty($prn_entry_branch_id)) && (!empty($prn_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "production-return/index.php?page=edit&id=$prn_entry_uniq_id");

		$ip												= getRealIpAddr();

		   $update_customer 					= sprintf("	UPDATE 
															prn_entry 
														SET 
															prn_entry_branch_id 				= '%d',
															prn_entry_date 						= '%s',
															prn_entry_from_godown_id 			= '%d',
															prn_entry_production_section_id 	= '%d',
															prn_entry_to_godown_id 				= '%d',
															prn_entry_modified_by 				= '%d',
															prn_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),
															prn_entry_modified_ip				= '%s'
														WHERE               
															prn_entry_id         				= '%d'", 

															$prn_entry_branch_id,
															$prn_entry_date,
															$prn_entry_from_godown_id,
															$prn_entry_production_section_id,
															$prn_entry_to_godown_id,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$prn_entry_id);

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($prn_entry_product_detail_product_id); $i++) { //echo 'prakash';exit;
		// echo $pdo_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($prn_entry_product_detail_product_id[$i])) );
			if($detail_request_fields) { // echo $prn_entry_product_detail_id[$i];exit;
				if(!empty($prn_entry_product_detail_id[$i])) {  
				//echo $prn_entry_product_detail_product_colour_id[$i];exit;

					  $update_pdo_entry_product_detail = sprintf("UPDATE 
																			prn_entry_product_details 
																		SET 
																		
																		prn_entry_product_detail_width_inches			= '%f',
																		prn_entry_product_detail_width_mm				= '%f',
																		prn_entry_product_detail_s_width_inches			= '%f',
																		prn_entry_product_detail_s_width_mm				= '%f',
																		prn_entry_product_detail_sl_feet				= '%f',
																		prn_entry_product_detail_sl_feet_in				= '%f',
																		prn_entry_product_detail_sl_feet_mm				= '%f',
																		prn_entry_product_detail_sl_feet_met			= '%f',
																		prn_entry_product_detail_ext_feet				= '%f',
																		prn_entry_product_detail_ext_feet_in			= '%f',
																		prn_entry_product_detail_ext_feet_mm			= '%f',
																		prn_entry_product_detail_ext_feet_met			= '%f',
																		prn_entry_product_detail_s_weight_inches		= '%f',
																		prn_entry_product_detail_s_weight_mm			= '%f',
																		prn_entry_product_detail_qty					= '%f',
																		prn_entry_product_detail_tot_length				= '%f',
																		prn_entry_product_detail_sw_check 				= '%d',
																		prn_entry_product_detail_tot_meter				= '%f',
																		prn_entry_product_detail_tot_feet 				= '%f',
																		prn_entry_product_detail_s_weight_inches		= '%f',
																		prn_entry_product_detail_s_weight_mm			= '%f',
																		prn_entry_product_detail_product_thick  		= '%f',
																		prn_entry_product_detail_modified_by 			= '%d',
																		prn_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																		prn_entry_product_detail_modified_ip 			= '%s'
																	WHERE 
																		prn_entry_product_detail_prn_entry_id 			= '%d' AND 
																		prn_entry_product_detail_id 					= '%d'",
																		$prn_entry_product_detail_width_inches[$i],
																		$prn_entry_product_detail_width_mm[$i],
																		$prn_entry_product_detail_s_width_inches[$i],
																		$prn_entry_product_detail_s_width_mm[$i],
																		$prn_entry_product_detail_sl_feet[$i],
																		$prn_entry_product_detail_sl_feet_in[$i],
																		$prn_entry_product_detail_sl_feet_mm[$i],
																		$prn_entry_product_detail_sl_feet_met[$i],
																		$prn_entry_product_detail_ext_feet[$i],
																		$prn_entry_product_detail_ext_feet_in[$i],
																		$prn_entry_product_detail_ext_feet_mm[$i],
																		$prn_entry_product_detail_ext_feet_met[$i],
																		$prn_entry_product_detail_s_weight_inches[$i],
																		$prn_entry_product_detail_s_weight_mm[$i],
																		$prn_entry_product_detail_qty[$i],
																		$prn_entry_product_detail_tot_length[$i],
																		$prn_entry_product_detail_sw_check[$i],
																		$prn_entry_product_detail_tot_meter[$i],			
																		$prn_entry_product_detail_tot_feet[$i],			
																		$prn_entry_product_detail_s_weight_inches[$i],		
																		$prn_entry_product_detail_s_weight_mm[$i],			
																		$prn_entry_product_detail_product_thick[$i],
																		$_SESSION[SESS.'_session_user_id'], 
																		$ip, 
																		$prn_entry_id, 
																		$prn_entry_product_detail_id[$i]);	
			//	echo $update_pdo_entry_product_detail; exit;
					mysql_query($update_pdo_entry_product_detail);

				} else {
				$prn_entry_product_detail_uniq_id 	= generateUniqId();
				if(!empty($prn_entry_product_detail_product_id[$i])){
				  $insert_prn_entry_product_detail 		= sprintf("INSERT INTO prn_entry_product_details 
																				(prn_entry_product_detail_uniq_id,prn_entry_product_detail_prn_entry_id,
																				 prn_entry_product_detail_production_detail_id,prn_entry_product_detail_production_entry_id,
																				 prn_entry_product_detail_product_id,prn_entry_product_detail_product_colour_id,
																				 prn_entry_product_detail_product_type, prn_entry_product_detail_product_thick,
																				 prn_entry_product_detail_width_inches,prn_entry_product_detail_width_mm,
																				 prn_entry_product_detail_s_width_inches,prn_entry_product_detail_s_width_mm,
																				 prn_entry_product_detail_sl_feet,prn_entry_product_detail_sl_feet_in,
																				 prn_entry_product_detail_sl_feet_mm,prn_entry_product_detail_sl_feet_met,
																				 prn_entry_product_detail_ext_feet,prn_entry_product_detail_ext_feet_in,
																				 prn_entry_product_detail_ext_feet_mm,prn_entry_product_detail_ext_feet_met,
																				 prn_entry_product_detail_qty,prn_entry_product_detail_tot_length,
																				 prn_entry_product_detail_added_by, prn_entry_product_detail_added_on,
																				 prn_entry_product_detail_added_ip,prn_entry_product_detail_sw_check,
																				 prn_entry_product_detail_tot_meter,prn_entry_product_detail_tot_feet,
																				 prn_entry_product_detail_s_weight_inches,prn_entry_product_detail_s_weight_mm) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d','%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f','%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' ,'%d','%d','%d' ,'%d','%d'   )", 
																		 $prn_entry_product_detail_uniq_id,$prn_entry_id,
																		 $prn_entry_product_detail_production_detail_id[$i],$prn_entry_production_entry_id,
																		 $prn_entry_product_detail_product_id[$i],$prn_entry_product_detail_product_colour_id[$i],
																		 $prn_entry_product_detail_product_type[$i], $prn_entry_product_detail_product_thick[$i],
																		 $prn_entry_product_detail_width_inches[$i],$prn_entry_product_detail_width_mm[$i],
																		 $prn_entry_product_detail_s_width_inches[$i],$prn_entry_product_detail_s_width_mm[$i],
																		 $prn_entry_product_detail_sl_feet[$i],$prn_entry_product_detail_sl_feet_in[$i],
																		 $prn_entry_product_detail_sl_feet_mm[$i],$prn_entry_product_detail_sl_feet_met[$i],
																		 $prn_entry_product_detail_ext_feet[$i],$prn_entry_product_detail_ext_feet_in[$i],
																		 $prn_entry_product_detail_ext_feet_mm[$i],$prn_entry_product_detail_ext_feet_met[$i],
																		 $prn_entry_product_detail_qty[$i],$prn_entry_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$prn_entry_product_detail_sw_check[$i],
																		 $prn_entry_product_detail_tot_meter[$i],$prn_entry_product_detail_tot_feet[$i],
																		 $prn_entry_product_detail_s_weight_inches[$i],$prn_entry_product_detail_s_weight_mm[$i]);
																		// echo $insert_pdo_entry_product_detail; exit;
				mysql_query($insert_prn_entry_product_detail);
				}
			}
		 }
		}

		//Raw Product Detail
		$prn_entry_raw_product_detail_product_id      		= $_POST['prn_entry_raw_product_detail_product_id'];
		$prn_entry_raw_product_detail_product_type     		= $_POST['prn_entry_raw_product_detail_product_type'];
		$prn_entry_raw_product_detail_production_detail_id			= $_POST['prn_entry_raw_product_detail_production_detail_id'];
		$prn_entry_raw_product_detail_product_colour_id		= $_POST['prn_entry_raw_product_detail_product_colour_id'];
		$prn_entry_raw_product_detail_product_thick      	= $_POST['prn_entry_raw_product_detail_product_thick'];
		$prn_entry_raw_product_detail_width_inches     		= $_POST['prn_entry_raw_product_detail_width_inches'];
		$prn_entry_raw_product_detail_width_mm     			= $_POST['prn_entry_raw_product_detail_width_mm'];
		$prn_entry_raw_product_detail_sl_feet				= $_POST['prn_entry_raw_product_detail_sl_feet'];
		$prn_entry_raw_product_detail_sl_feet_mm      		= $_POST['prn_entry_raw_product_detail_sl_feet_mm'];
		$prn_entry_raw_product_detail_ton			     	= $_POST['prn_entry_raw_product_detail_ton'];
		$prn_entry_raw_product_detail_kg	     			= $_POST['prn_entry_raw_product_detail_kg'];
		$prn_entry_raw_product_detail_id	     			= $_POST['prn_entry_raw_product_detail_id'];
		
		for($i = 0; $i < count($prn_entry_raw_product_detail_product_id); $i++) { //echo 'prakash';exit;
		// echo $pdo_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($prn_entry_raw_product_detail_product_id[$i])) && 
									 							(!empty($prn_entry_raw_product_detail_ton[$i])));
			if($detail_request_fields) {
				if(!empty($prn_entry_raw_product_detail_id[$i]) && (!empty($prn_entry_raw_product_detail_ton[$i]))) {

					   $update_pdo_entry_product_detail = sprintf("UPDATE 
																			prn_entry_raw_product_details 
																		SET 
																		
																		prn_entry_raw_product_detail_width_inches			= '%f',
																		prn_entry_raw_product_detail_width_mm				= '%f',
																		prn_entry_raw_product_detail_sl_feet				= '%f',
																		prn_entry_raw_product_detail_sl_feet_mm				= '%f',
																		prn_entry_raw_product_detail_ton					= '%f',
																		prn_entry_raw_product_detail_kg						= '%f',
																		prn_entry_raw_product_detail_modified_by 			= '%d',
																		prn_entry_raw_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																		prn_entry_raw_product_detail_modified_ip 			= '%s'
																	WHERE 
																		prn_entry_raw_product_detail_id 					= '%d'",
																		
																		$prn_entry_raw_product_detail_width_inches[$i],
																		$prn_entry_raw_product_detail_width_mm[$i],
																		$prn_entry_raw_product_detail_sl_feet[$i],
																		$prn_entry_raw_product_detail_sl_feet_mm[$i],
																		$prn_entry_raw_product_detail_ton[$i],
																		$prn_entry_raw_product_detail_kg[$i],
																		$_SESSION[SESS.'_session_user_id'], 
																		$ip, 
																		
																		$prn_entry_raw_product_detail_id[$i]);
			//	echo $update_pdo_entry_product_detail; exit;
					mysql_query($update_pdo_entry_product_detail);

				} else {
				$prn_entry_product_detail_uniq_id 	= generateUniqId();
				if(!empty($prn_entry_raw_product_detail_ton[$i])){
				  $insert_prn_entry_raw_product_detail 		= sprintf("INSERT INTO prn_entry_raw_product_details 
																				(prn_entry_raw_product_detail_uniq_id,prn_entry_raw_product_detail_prn_entry_id,
																				 prn_entry_raw_product_detail_production_detail_id,prn_entry_raw_product_detail_product_id,
																				 prn_entry_raw_product_detail_product_colour_id,prn_entry_raw_product_detail_product_type,
																				 prn_entry_raw_product_detail_product_thick, prn_entry_raw_product_detail_width_inches,
																				 prn_entry_raw_product_detail_width_mm,prn_entry_raw_product_detail_sl_feet,
																				 prn_entry_raw_product_detail_sl_feet_mm,prn_entry_raw_product_detail_ton,
																				 prn_entry_raw_product_detail_kg,
																				 prn_entry_raw_product_detail_added_by, prn_entry_raw_product_detail_added_on,
																				 prn_entry_raw_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d','%d', 
																				'%d','%d', 
																				'%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $prn_entry_raw_product_detail_uniq_id,$prn_entry_id,
																		 $prn_entry_raw_product_detail_production_detail_id[$i],$prn_entry_raw_product_detail_product_id[$i],
																		 $prn_entry_raw_product_detail_product_colour_id[$i],$prn_entry_raw_product_detail_product_type[$i],
																		 $prn_entry_raw_product_detail_product_thick[$i], $prn_entry_raw_product_detail_width_inches[$i],
																		 $prn_entry_raw_product_detail_width_mm[$i],
																		 $prn_entry_raw_product_detail_sl_feet[$i],$prn_entry_raw_product_detail_sl_feet_mm[$i],
																		 $prn_entry_raw_product_detail_ton[$i],$prn_entry_raw_product_detail_kg[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
																		// echo $insert_pdo_entry_product_detail; exit;
				mysql_query($insert_prn_entry_raw_product_detail);
				}
			}
		 }
		}
		    $detail_id =$prn_entry_product_detail_id[$i];
			
			if($prn_entry_type_id==4){
							$produt_id											=	$prn_entry_product_detail_product_id[$i];
							$product_colour_id									=	1;
							$product_thick										=	1;
							$width_inches										= 	1;
							$width_mm											= 	1;
							$length_feet										= 	1; 
							$length_meter										= 	1;
							$product_detail_qty									= 	$prn_entry_product_detail_qty[$i];
							$stock_ledger_entry_type							= 	"production-entry-fin";
							$product_con_entry_godown_id						= 	"3";
							//echo $product_detail_qty;exit;
							stockLedger('in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							
							if(isset($prn_entry_product_detail_sw_check[$i]) && $prn_entry_product_detail_sw_check[$i]==1){
								$product_con_entry_godown_id						= 	"2";
								stockLedger('in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
							
							$product_con_entry_godown_id						= 	"3";
							stockLedger('out',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$product_detail_qty), $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							
				}
				else{	
							$produt_id											=	$prn_entry_product_detail_product_id[$i];
							$product_colour_id									=	$prn_entry_product_detail_product_colour_id[$i];
							$product_thick										=	$prn_entry_product_detail_product_thick[$i];
							$width_inches										= 	$prn_entry_product_detail_width_inches[$i];
							$width_mm											= 	$prn_entry_product_detail_width_mm[$i];
							$length_feet										= 	$prn_entry_product_detail_sl_feet[$i];
							$length_meter										= 	$prn_entry_product_detail_sl_feet_met[$i];
							if($prn_entry_type_id==1){
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$rec_product['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$ton_qty										= 	$total_ton*$length_feet;
								$kg_qty											= 	$ton_qty*1000;
							}
							else{
								$ton_qty										= 	$prn_entry_product_detail_s_weight_inches[$i];
								$kg_qty											= 	$prn_entry_product_detail_s_weight_mm[$i];
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$rec_product['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$length_feet									= 	($prn_entry_product_detail_sl_feet[$i]/$total_ton);
								
								$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
								$length_meter									= 	$product_cal['3'];
							}
							$product_detail_qty									= 	$prn_entry_product_detail_qty[$i]; //echo $product_detail_qty;exit;
							$stock_ledger_entry_type							= 	"production-return-fin";
							$product_con_entry_godown_id						= 	"1";
							stockLedger('in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
							
							if(isset($prn_entry_product_detail_sw_check[$i]) && $prn_entry_product_detail_sw_check[$i]==1){
								$product_con_entry_godown_id						= 	"2";
							stockLedger('in',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
							
							$product_con_entry_godown_id						= 	"3";
							stockLedger('out',$prn_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$product_detail_qty), $prn_entry_branch_id,  $product_con_entry_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
				}
				
		
		
		
		pageRedirection("production-return/index.php?page=edit&id=$prn_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['prn_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$prn_entry_uniq_id = $_GET['prn_entry_uniq_id'];
			
			if($_REQUEST['type']==2){
			
					mysql_query("UPDATE prn_entry_raw_product_details SET prn_entry_raw_product_detail_deleted_status = 1 

						WHERE prn_entry_raw_product_detail_id = ".$product_detail_id." ");
			
			}else{

			mysql_query("UPDATE pdo_entry_product_details SET pdo_entry_product_detail_deleted_status = 1 

						WHERE pdo_entry_product_detail_id = ".$product_detail_id." ");
			}
			header("Location:index.php?page=edit&id=$pdo_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('prn_entry', 'prn_entry_deleted_by', 'prn_entry_deleted_on' , 'prn_entry_deleted_ip','prn_entry_deleted_status', 'prn_entry_id', 'prn_entry_uniq_id', '1');
			
	$checked = $_POST['deleteCheck'];
	$ip = getRealIpAddr();
	$count = count($checked);
	for($i=0; $i < $count; $i++) {
		$deleteCheck = $checked[$i]; 
		$id = getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', $deleteCheck); 
		
		$delete	=	sprintf("UPDATE prn_entry_product_details
								  SET    prn_entry_product_detail_deleted_by    = '%d',  
										 prn_entry_product_detail_deleted_on    = UNIX_TIMESTAMP(NOW()),
										 prn_entry_product_detail_deleted_ip    = '%s',
										 prn_entry_product_detail_deleted_status= '%d'
								  WHERE  prn_entry_product_detail_prn_entry_id  = '%d'",
								  $_SESSION[SESS.'_session_user_id'], $ip,'1',  
								  $id);  //exit;

		 mysql_query($delete);
		
	 	$deleterRecord = sprintf("UPDATE prn_entry_raw_product_details
								  SET    prn_entry_raw_product_detail_deleted_by    = '%d',  
										 prn_entry_raw_product_detail_deleted_on    = UNIX_TIMESTAMP(NOW()),
										 prn_entry_raw_product_detail_deleted_ip    = '%s',
										 prn_entry_raw_product_detail_deleted_status= '%d'
								  WHERE  prn_entry_raw_product_detail_prn_entry_id  = '%d'",
								  $_SESSION[SESS.'_session_user_id'], $ip,'1',  
								  $id);  //exit;

		 mysql_query($deleterRecord); 
		 
		 $deleterStock = sprintf("UPDATE stock_ledger
								  SET    stock_ledger_deleted_by    = '%d',  
										 stock_ledger_deleted_on    = UNIX_TIMESTAMP(NOW()),
										 stock_ledger_deleted_ip    = '%s',
										 stock_ledger_status= '%d'
								  WHERE  stock_ledger_entry_id  = '%d' AND 
								         stock_ledger_entry_type ='production-return-fin'",
								  $_SESSION[SESS.'_session_user_id'], $ip,'1',  
								  $id);  //exit;
								  
						//  echo $deleterStock;exit;

		 mysql_query($deleterStock); 

	}

		

		pageRedirection("production-return/index.php?msg=7");				

	}

?>