<?php

	function insertQuotation(){
		$recycle_entry_branch_id                   			= trim($_POST['recycle_entry_branch_id']);
		$recycle_entry_date                 				= NdateDatabaseFormat($_POST['recycle_entry_date']);
		$recycle_entry_godown_id      						= trim($_POST['recycle_entry_godown_id']);
		$recycle_entry_type     							= trim($_POST['recycle_entry_type']);
		//Product Detail
		$recycle_entry_product_detail_product_id     	 	= $_POST['recycle_entry_product_detail_product_id'];
		$recycle_entry_product_detail_product_colour_id   	= $_POST['recycle_entry_product_detail_product_colour_id'];
		$recycle_entry_product_detail_product_thick_ness  	= $_POST['recycle_entry_product_detail_product_thick_ness'];
		$recycle_entry_product_detail_width_inches  		= $_POST['recycle_entry_product_detail_width_inches'];
		$recycle_entry_product_detail_width_mm  			= $_POST['recycle_entry_product_detail_width_mm'];
		$recycle_entry_product_detail_length_feet  			= $_POST['recycle_entry_product_detail_length_feet'];
		$recycle_entry_product_detail_length_mm  			= $_POST['recycle_entry_product_detail_length_mm'];
		$recycle_entry_product_detail_qty 					= $_POST['recycle_entry_product_detail_qty'];
		
		$recycle_entry_width_detail_name     	 			= $_POST['recycle_entry_width_detail_name'];
		$recycle_entry_width_detail_width_inches_one		= $_POST['recycle_entry_width_detail_width_inches_one'];
		$recycle_entry_width_detail_width_inches_two  		= $_POST['recycle_entry_width_detail_width_inches_two'];
		$recycle_entry_width_detail_width_inches_three  	= $_POST['recycle_entry_width_detail_width_inches_three'];
		$recycle_entry_width_detail_width_inches_four  		= $_POST['recycle_entry_width_detail_width_inches_four'];
		$recycle_entry_width_detail_inches_qty 				= $_POST['recycle_entry_width_detail_inches_qty'];
		$recycle_entry_width_detail_length 					= $_POST['recycle_entry_width_detail_length'];
		$recycle_entry_width_detail_length_qty 				= $_POST['recycle_entry_width_detail_length_qty'];
		$recycle_entry_product_detail_osf_uom_ton			= $_POST['recycle_entry_product_detail_osf_uom_ton'];
		
		$stock_ledger_prd_type 								= "recycle-entry";

		$request_fields 									= ((!empty($recycle_entry_branch_id)) && (!empty($recycle_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "recycle-entry/index.php?page=add&msg=5");
		$recycle_entry_uniq_id								= generateUniqId();
		$ip													= getRealIpAddr();
		$select_recycle_entry_no							= "SELECT 
																	MAX(recycle_entry_no) AS maxval 
															   FROM
																	recycle_entry 
															   WHERE 
																	recycle_entry_deleted_status 	= 0 												AND
																	recycle_entry_branch_id 		= '".$recycle_entry_branch_id."'						AND
																	recycle_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND
																	recycle_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";
		$result_recycle_entry_no 						= mysql_query($select_recycle_entry_no);
		$record_recycle_entry_no 						= mysql_fetch_array($result_recycle_entry_no);	
		$maxval 										= $record_recycle_entry_no['maxval']; 
		if($maxval > 0) {
			$recycle_entry_no 							= substr(('00000'.++$maxval),-5);
		} else {
			$recycle_entry_no 							= substr(('00000'.++$maxval),-5);
		}
		$insert_recycle_entry 							= sprintf("INSERT INTO recycle_entry(recycle_entry_uniq_id, recycle_entry_date,
																					   	recycle_entry_godown_id,
																					   	recycle_entry_type,recycle_entry_no,
																					   	recycle_entry_branch_id,recycle_entry_added_by,
																					  	recycle_entry_added_on,recycle_entry_added_ip,
																					   	recycle_entry_company_id,recycle_entry_financial_year) 
																	VALUES 	 		 (	'%s', '%s', 
																					  	'%d', 
																					  	'%d', '%s',
																					  	'%d', '%d', 
																					  	 UNIX_TIMESTAMP(NOW()),
																					  	'%s', '%d', '%d')", 
																					 	$recycle_entry_uniq_id, $recycle_entry_date,
																					 	$recycle_entry_godown_id,$recycle_entry_type,$recycle_entry_no,
																					 	$recycle_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																					 	$ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year']);  
		mysql_query($insert_recycle_entry);
		//echo $insert_recycle_entry; exit;
		$recycle_entry_id 								= mysql_insert_id(); 
		// purchase order pproduct details
			$detail_request_fields 						= 	((!empty($recycle_entry_product_detail_product_id)) && 
									 						(!empty($recycle_entry_product_detail_qty)));
			if($detail_request_fields) {
				$recycle_entry_product_detail_uniq_id 		= generateUniqId();
				$insert_recycle_entry_product_detail 		= sprintf("INSERT INTO recycle_entry_product_details 
																				(recycle_entry_product_detail_uniq_id,recycle_entry_product_detail_product_id,
																				 recycle_entry_product_detail_width_inches,recycle_entry_product_detail_width_mm,
																				 recycle_entry_product_detail_length_feet,recycle_entry_product_detail_length_mm,
																				 recycle_entry_product_detail_qty,recycle_entry_product_detail_recycle_entry_id,
																				 recycle_entry_product_detail_added_by, recycle_entry_product_detail_added_on,
																				 recycle_entry_product_detail_added_ip) 

																	VALUES     ('%s', '%d', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%d', 
																				'%d', 
																				UNIX_TIMESTAMP(NOW()), '%s')", 
																				$recycle_entry_product_detail_uniq_id,$recycle_entry_product_detail_product_id,  
																				$recycle_entry_product_detail_width_inches,$recycle_entry_product_detail_width_mm,
																				$recycle_entry_product_detail_length_feet,$recycle_entry_product_detail_length_mm,
																				$recycle_entry_product_detail_qty,$recycle_entry_id, 
																				$_SESSION[SESS.'_session_user_id'],$ip);
				mysql_query($insert_recycle_entry_product_detail);
				$product_detail_id	 										= mysql_insert_id();
				
				if($recycle_entry_type==2){
					$produt_id											=  $recycle_entry_product_detail_product_id;
					$product_colour_id									=	$recycle_entry_product_detail_product_colour_id;
					$product_thick										=	$recycle_entry_product_detail_product_thick_ness;
					$width_inches										= 	$recycle_entry_product_detail_width_inches;
					$width_mm											= 	$recycle_entry_product_detail_width_mm;
					
					$length_feet										=   $recycle_entry_product_detail_length_feet;
					$length_meter										= 	$product_cal[3];
					//$get_raw_val										=	Child_prod_detail($produt_id);
					//$brand_id											= 	$get_raw_val['product_brand_id'];
					//$total_ton											=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
					$total_ton											= 	$recycle_entry_product_detail_osf_uom_ton;
					$ton_qty											= 	$total_ton*$length_feet;
					$kg_qty												= 	$ton_qty*1000;
					$product_detail_qty									= 	"1";
					$stock_ledger_entry_type							= 	"re-cycle-mother";
					$product_con_entry_godown_id						= 	"1";
					stockLedger('in',$recycle_entry_id,$product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $recycle_entry_branch_id,  $product_con_entry_godown_id, $recycle_entry_date, $recycle_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$product_colour_id,$product_thick);
					
					$child_produt_d										= Child_prod_detail($produt_id);
					$produt_id											= $child_produt_d['product_con_entry_child_product_detail_product_id'];
					$product_con_entry_godown_id						= 	"2";
					stockLedger('in',$recycle_entry_id,$product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $recycle_entry_branch_id,  $product_con_entry_godown_id, $recycle_entry_date, $recycle_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$product_colour_id,$product_thick);
			}
					
				
				
				
			}
			for($i = 0; $i < count($recycle_entry_width_detail_name); $i++) {
				$detail_request_fields 						= 	((!empty($recycle_entry_width_detail_name[$i])) && 
																((!empty($recycle_entry_width_detail_width_inches_one[$i])) || (!empty($recycle_entry_width_detail_width_inches_two[$i])) || (!empty($recycle_entry_width_detail_width_inches_three[$i])) || (!empty($recycle_entry_width_detail_width_inches_four[$i])) ));
				if($detail_request_fields) {
					$recycle_entry_width_detail_uniq_id 	= generateUniqId();
					 $insert_recycle_entry_width_detail 		= sprintf("INSERT INTO recycle_entry_width_details 
																					(recycle_entry_width_detail_uniq_id,recycle_entry_width_detail_product_id,
																					 recycle_entry_width_detail_width_inches_one,recycle_entry_width_detail_width_inches_two,
																					 recycle_entry_width_detail_width_inches_three,recycle_entry_width_detail_width_inches_four,
																					 recycle_entry_width_detail_inches_qty,recycle_entry_width_detail_length,
																					 recycle_entry_width_detail_length_qty,recycle_entry_width_detail_name,
																					 recycle_entry_width_detail_recycle_entry_id,
																					 recycle_entry_width_detail_added_by, recycle_entry_width_detail_added_on,
																					 recycle_entry_width_detail_added_ip) 
																		VALUES     ('%s', '%d', 
																					'%f', '%f', 
																					'%f', '%f', 
																					'%f', '%f',
																					'%f', '%s', '%d', 
																					'%d', 
																					UNIX_TIMESTAMP(NOW()), '%s')", 
																					$recycle_entry_width_detail_uniq_id,$recycle_entry_product_detail_product_id,  
																					$recycle_entry_width_detail_width_inches_one[$i],
																					$recycle_entry_width_detail_width_inches_two[$i],
																					$recycle_entry_width_detail_width_inches_three[$i],
																					$recycle_entry_width_detail_width_inches_four[$i],
																					$recycle_entry_width_detail_inches_qty[$i],
																					$recycle_entry_width_detail_length[$i],
																					$recycle_entry_width_detail_length_qty[$i],
																					$recycle_entry_width_detail_name[$i],$recycle_entry_id, 
																					$_SESSION[SESS.'_session_user_id'],$ip);
				mysql_query($insert_recycle_entry_width_detail);
				$width_detail_id	 										= mysql_insert_id();
				}
			}
			$product_con_entry_child_product_detail_code     		= $_POST['product_con_entry_child_product_detail_code'];
			$product_con_entry_child_product_detail_name   			= $_POST['product_con_entry_child_product_detail_name'];
			$product_con_entry_child_product_detail_color_id  		= $_POST['product_con_entry_child_product_detail_color_id'];
			$product_con_entry_child_product_detail_thick_ness		= $_POST['product_con_entry_child_product_detail_thick_ness'];
			$product_con_entry_child_product_detail_width_inches  	= $_POST['product_con_entry_child_product_detail_width_inches'];
			$product_con_entry_child_product_detail_width_mm  		= $_POST['product_con_entry_child_product_detail_width_mm'];
			$product_con_entry_child_product_detail_length_feet  	= $_POST['product_con_entry_child_product_detail_length_feet'];
			$product_con_entry_child_product_detail_length_mm 		= $_POST['product_con_entry_child_product_detail_length_mm'];
			$product_con_entry_child_product_detail_uom_id 			= $_POST['product_con_entry_child_product_detail_uom_id'];
			$product_con_entry_child_product_detail_total 			= $_POST['product_con_entry_child_product_detail_total'];
			$product_con_entry_child_product_detail_product_brand_id 	= $_POST['product_con_entry_child_product_detail_product_brand_id'];
			$product_con_entry_child_product_detail_product_category_id	= $_POST['product_con_entry_child_product_detail_product_category_id'];
			
			$get_raw_val											=	Child_prod_detail($produt_id);
			$width_cutting_product_id								= $get_raw_val['product_con_entry_child_product_detail_product_id'];
			for($i = 0; $i < count($product_con_entry_child_product_detail_code); $i++) {
			$detail_request_fields 						= 	((!empty($product_con_entry_child_product_detail_length_feet[$i])));
			if($detail_request_fields) {
				$product_con_entry_child_product_detail_uniq_id = generateUniqId();
				$ton_qty										= $product_con_entry_child_product_detail_total[$i];
				$kg_qty											= $product_con_entry_child_product_detail_total[$i]*1000;
				$osf_feet										= "1";
				$osf_feet_mm									= number_format(($osf_feet*304.8),'4','.','');
				$product_feet									= $product_con_entry_child_product_detail_length_feet[$i];
				$osf_ton										= ($osf_feet/$product_feet)*$ton_qty;
				$osf_ton_kg										= $osf_ton*1000;
				
				
				$insert_product_con_entry_product_detail 		= sprintf("INSERT INTO product_con_entry_child_product_details 
																					(product_con_entry_child_product_detail_uniq_id,
																					product_con_entry_child_product_detail_product_id,
																					product_con_entry_child_product_detail_code,
																					product_con_entry_child_product_detail_name,
																					product_con_entry_child_product_detail_color_id,
																				 	product_con_entry_child_product_detail_width_inches,
																				 	product_con_entry_child_product_detail_width_mm,
																				 	product_con_entry_child_product_detail_length_mm,
																				 	product_con_entry_child_product_detail_length_feet,
																				 	product_con_entry_child_product_detail_uom_id,
																				 	product_con_entry_child_product_detail_total,
																					product_con_entry_child_product_detail_thick_ness,
																			 		product_con_entry_child_product_detail_product_con_entry_id,
																				 	product_con_entry_child_product_detail_added_by,
																				 	product_con_entry_child_product_detail_added_on,
																				 	product_con_entry_child_product_detail_added_ip,
																					product_con_entry_child_product_detail_type,
																					product_con_entry_child_product_detail_mas_product_id,
																					product_con_entry_child_product_detail_product_brand_id,
																					product_con_entry_child_product_detail_product_category_id,
																					product_con_entry_child_product_detail_ton_qty,
																					product_con_entry_child_product_detail_kg_qty,
																					product_con_entry_osf_length_feet,
																					product_con_entry_osf_length_m,
																					product_con_entry_osf_uom_ton,
																					product_con_entry_osf_uom_kg,
																					product_con_entry_child_product_detail_entry_type))  
																	VALUES     	('%s', '%d',
																	 			'%s', '%s',
																				'%d', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%d', '%f', 
																				'%f', '%d',
																				'%d', 
																				UNIX_TIMESTAMP(NOW()),'%s',
																				'%d', '%d', '%d', '%d','%f', '%f','%f', '%f','%f', '%f', '%s')", 
																				$product_con_entry_child_product_detail_uniq_id,
																				$product_detail_product_id, 
																				$product_con_entry_child_product_detail_code[$i], 
																				$product_con_entry_child_product_detail_name[$i], 
																				$product_con_entry_child_product_detail_color_id[$i], 
																				$product_con_entry_child_product_detail_width_inches[$i],
																				$product_con_entry_child_product_detail_width_mm[$i],
																				$product_con_entry_child_product_detail_length_mm[$i],
																				$product_con_entry_child_product_detail_length_feet[$i],
																				$product_con_entry_child_product_detail_uom_id[$i],
																				$product_con_entry_child_product_detail_total[$i],
																				$product_con_entry_child_product_detail_thick_ness[$i],
																				$recycle_entry_id, $_SESSION[SESS.'_session_user_id'],$ip,
																				"2",$recycle_entry_product_detail_product_id,
																				$product_con_entry_child_product_detail_product_brand_id[$i],
																				$product_con_entry_child_product_detail_product_category_id[$i],
																				$ton_qty,$kg_qty,$osf_feet,$osf_feet_mm,$osf_ton,$osf_ton_kg,
																				'recycle-entry');

				mysql_query($insert_product_con_entry_product_detail);
				$product_con_entry_detail_id 		 					= mysql_insert_id();
				$produt_id											=	$product_con_entry_detail_id;
				$product_colour_id									=	$product_con_entry_child_product_detail_color_id[$i];
				$product_thick										=	$product_con_entry_child_product_detail_thick_ness[$i];
				$width_inches										= 	$product_con_entry_child_product_detail_width_inches[$i];
				$width_mm											= 	$product_con_entry_child_product_detail_width_mm[$i];
				$length_feet										= 	$product_con_entry_child_product_detail_length_feet[$i];
				$length_meter										= 	$product_con_entry_child_product_detail_length_mm[$i];
				$ton_qty											= 	$product_con_entry_child_product_detail_total[$i];
				$kg_qty												= 	$product_con_entry_child_product_detail_total[$i]*1000;
				$product_detail_qty									= 	"1";
				$stock_ledger_entry_type							= 	"recycle-child";
				$product_con_entry_godown_id						= 	"1";
				stockLedger('in',$recycle_entry_id,$product_con_entry_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $recycle_entry_branch_id,  $product_con_entry_godown_id, $recycle_entry_date, $recycle_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$product_colour_id,$product_thick);
				$child_produt_d										= Child_prod_detail($recycle_entry_product_detail_product_id);
				$produt_id											= $child_produt_d['product_con_entry_child_product_detail_product_id'];
				$product_con_entry_godown_id						= 	"2";
				stockLedger('in',$recycle_entry_id,$product_con_entry_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $recycle_entry_branch_id,  $product_con_entry_godown_id, $recycle_entry_date, $recycle_entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$product_colour_id,$product_thick);
				
			}
		}
			pageRedirection("recycle-entry/index.php?page=add&msg=1");
	}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND recycle_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND recycle_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		$select_recycle_entry		=	"SELECT 
											recycle_entry_id,
											recycle_entry_uniq_id,
											recycle_entry_no,
											recycle_entry_date
										 FROM 
											recycle_entry
										 WHERE 
											recycle_entry_deleted_status 	= 	0 	 $where
										 ORDER BY 
											recycle_entry_no ASC";
		$result_recycle_entry		= mysql_query($select_recycle_entry);
		// Filling up the array
		$recycle_entry_data 		= array();
		while ($record_recycle_entry = mysql_fetch_array($result_recycle_entry))
		{
		 $recycle_entry_data[] 	= $record_recycle_entry;
		}
		return $recycle_entry_data;
	}
	function editQuotation(){
		$recycle_entry_id 			= getId('recycle_entry', 'recycle_entry_id', 'recycle_entry_uniq_id', dataValidation($_GET['id'])); 
		 $select_recycle_entry		=	"SELECT 
												recycle_entry_uniq_id,  recycle_entry_date,
												recycle_entry_godown_id,recycle_entry_type,
												recycle_entry_no,
												recycle_entry_branch_id,recycle_entry_id
												
											 FROM 
												recycle_entry 
											 WHERE 
												recycle_entry_deleted_status 	=  0 							AND 
												recycle_entry_id				= '".$recycle_entry_id."'
											 ORDER BY 
												recycle_entry_no ASC";

		$result_recycle_entry 		= mysql_query($select_recycle_entry);

		$record_recycle_entry 		= mysql_fetch_array($result_recycle_entry);

		return $record_recycle_entry;

	}

	function editQuotationProductDetail()
	{

		$recycle_entry_id 	= getId('recycle_entry', 'recycle_entry_id', 'recycle_entry_uniq_id', dataValidation($_GET['id'])); 
		$select_recycle_entry_product_detail 	= "	SELECT 
															recycle_entry_product_detail_id,
															recycle_entry_product_detail_product_id,
															recycle_entry_product_detail_width_inches,
															recycle_entry_product_detail_width_mm,
															recycle_entry_product_detail_length_feet,
															recycle_entry_product_detail_length_mm,
															recycle_entry_product_detail_qty,
															product_con_entry_child_product_detail_name as product_name,
															product_uom_name,
															product_con_entry_child_product_detail_code as product_code,
															product_colour_name,
															product_con_entry_child_product_detail_thick_ness as product_thick_ness
														FROM 
															recycle_entry_product_details 
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id 		= recycle_entry_product_detail_product_id
														LEFT JOIN 
															product_uoms 
														ON 
															product_uom_id 									= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours 
														ON 
															product_colour_id 								= product_con_entry_child_product_detail_color_id
														WHERE 
															recycle_entry_product_detail_deleted_status		 	= 0 							AND 
															recycle_entry_product_detail_recycle_entry_id 		= '".$recycle_entry_id."'";
		$result_recycle_entry_product_detail 	= mysql_query($select_recycle_entry_product_detail);

		$count_recycle_entry 					= mysql_num_rows($result_recycle_entry_product_detail);

		$arr_recycle_entry_product_detail 	= array();

		

		while($record_recycle_entry_product_detail = mysql_fetch_array($result_recycle_entry_product_detail)) {

			$arr_recycle_entry_product_detail[] = $record_recycle_entry_product_detail;

		}

		return $arr_recycle_entry_product_detail;

	}
	function editWidthDetail(){
		$recycle_entry_id 	= getId('recycle_entry', 'recycle_entry_id', 'recycle_entry_uniq_id', dataValidation($_GET['id'])); 
		$select_recycle_entry_width_detail 	= "	SELECT 
															recycle_entry_width_detail_id,
															recycle_entry_width_detail_product_id,
															recycle_entry_width_detail_width_inches_one,
															recycle_entry_width_detail_width_inches_two,
															recycle_entry_width_detail_width_inches_three,
															recycle_entry_width_detail_width_inches_four,
															recycle_entry_width_detail_inches_qty,
															recycle_entry_width_detail_length,
															recycle_entry_width_detail_length_qty,
															recycle_entry_width_detail_name
														FROM 
															recycle_entry_width_details 
														WHERE 
															recycle_entry_width_detail_deleted_status		 	= 0 							AND 
															recycle_entry_width_detail_recycle_entry_id 		= '".$recycle_entry_id."'";

		$result_recycle_entry_width_detail 	= mysql_query($select_recycle_entry_width_detail);
		$count_recycle_entry 					= mysql_num_rows($result_recycle_entry_width_detail);
		$arr_recycle_entry_width_detail 	= array();
		while($record_recycle_entry_width_detail = mysql_fetch_array($result_recycle_entry_width_detail)) {
			$arr_recycle_entry_width_detail[] = $record_recycle_entry_width_detail;
		}
		return $arr_recycle_entry_width_detail;
	}
	function editChildProductDetail()
	{

		$recycle_entry_id 	= getId('recycle_entry', 'recycle_entry_id', 'recycle_entry_uniq_id', dataValidation($_GET['id'])); 

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
															product_con_entry_child_product_detail_thick_ness

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
														WHERE 
															product_con_entry_child_product_detail_deleted_status		 	= 0 							AND 
															product_con_entry_child_product_detail_type		 				= 2 							AND 
															product_con_entry_child_product_detail_entry_type		 		= 'recycle-entry'				AND 
															product_con_entry_child_product_detail_product_con_entry_id 	= '".$recycle_entry_id."'	";

		$result_product_con_entry_product_detail 	= mysql_query($select_product_con_entry_child_product_detail);

		$count_product_con_entry 					= mysql_num_rows($result_product_con_entry_product_detail);

		$arr_product_con_entry_product_detail 	= array();

		

		while($record_product_con_entry_product_detail = mysql_fetch_array($result_product_con_entry_product_detail)) {

			$arr_product_con_entry_product_detail[] = $record_product_con_entry_product_detail;

		}

		return $arr_product_con_entry_product_detail;

	}
	function updateQuotation(){

		$recycle_entry_id                   				= trim($_POST['recycle_entry_id']);
		$recycle_entry_uniq_id                				= trim($_POST['recycle_entry_uniq_id']);
		$recycle_entry_branch_id                   			= trim($_POST['recycle_entry_branch_id']);
		$recycle_entry_date                 				= NdateDatabaseFormat($_POST['recycle_entry_date']);
		$recycle_entry_production_section_id            	= trim($_POST['recycle_entry_production_section_id']);
		$recycle_entry_godown_id      						= trim($_POST['recycle_entry_godown_id']);
		$recycle_entry_type     							= trim($_POST['recycle_entry_type']);
		$recycle_entry_sw_check     						= trim($_POST['recycle_entry_sw_check']);

		$recycle_entry_so_entry_id     						= trim($_POST['recycle_entry_so_entry_id']);
		//Multi Contact
		$recycle_entry_product_detail_id      				= $_POST['recycle_entry_product_detail_id'];
		$recycle_entry_product_detail_product_id     		= $_POST['recycle_entry_product_detail_product_id'];
		$recycle_entry_product_detail_width_feet  			= $_POST['recycle_entry_product_detail_width_feet'];
		$recycle_entry_product_detail_width_inches  		= $_POST['recycle_entry_product_detail_width_inches'];
		$recycle_entry_product_detail_width_mm  			= $_POST['recycle_entry_product_detail_width_mm'];
		$recycle_entry_product_detail_width_meter  			= $_POST['recycle_entry_product_detail_width_meter'];
		$recycle_entry_product_detail_length_feet  			= $_POST['recycle_entry_product_detail_length_feet'];
		$recycle_entry_product_detail_length_inches  		= $_POST['recycle_entry_product_detail_length_inches'];
		$recycle_entry_product_detail_length_mm  			= $_POST['recycle_entry_product_detail_length_mm'];
		$recycle_entry_product_detail_length_meter  		= $_POST['recycle_entry_product_detail_length_meter'];
		$recycle_entry_product_detail_ext_length_feet  		= $_POST['recycle_entry_product_detail_ext_length_feet'];
		$recycle_entry_product_detail_ext_length_meter  	= $_POST['recycle_entry_product_detail_ext_length_meter'];
		$recycle_entry_product_detail_qty 					= $_POST['recycle_entry_product_detail_qty'];

		$request_fields 						= ((!empty($recycle_entry_branch_id)) && (!empty($recycle_entry_date)));

		$stock_ledger_entry_type							= "";

		checkRequestFields($request_fields, PROJECT_PATH, "recycle-entry/index.php?page=edit&id=$recycle_entry_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 
															recycle_entry 
														SET 

															recycle_entry_branch_id 				= '%d',
															recycle_entry_date 						= '%s',
															recycle_entry_production_section_id 	= '%d',
															recycle_entry_customer_id 				= '%d',
															recycle_entry_godown_id 				= '%d',
															recycle_entry_sw_check 					= '%d',
															recycle_entry_type 						= '%s',
															recycle_entry_modified_by 				= '%d',
															recycle_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),
															recycle_entry_modified_ip				= '%s'
														WHERE               
															recycle_entry_id         				= '%d'", 
															$recycle_entry_branch_id,
															$recycle_entry_date,
															$recycle_entry_production_section_id,
															$recycle_entry_customer_id,
															$recycle_entry_godown_id,
															$recycle_entry_sw_check,
															$recycle_entry_type,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$recycle_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);
			$detail_request_fields = ((!empty($recycle_entry_product_detail_product_id[$i])) &&
									 (!empty($recycle_entry_product_detail_qty[$i])));
			if($detail_request_fields) {
					$update_recycle_entry_product_detail = sprintf("	UPDATE 

																			recycle_entry_product_details 
																		SET  
																			recycle_entry_product_detail_qty  					= '%f',
																			recycle_entry_product_detail_width_feet  			= '%f',
																			recycle_entry_product_detail_width_inches  			= '%f',
																			recycle_entry_product_detail_width_mm  				= '%f',
																			recycle_entry_product_detail_width_meter  			= '%f',
																			recycle_entry_product_detail_length_feet  			= '%f',
																			recycle_entry_product_detail_length_inches  		= '%f',
																			recycle_entry_product_detail_length_mm  			= '%f',
																			recycle_entry_product_detail_length_meter  			= '%f',
																			recycle_entry_product_detail_ext_length_feet  		= '%f',
																			recycle_entry_product_detail_ext_length_meter  		= '%f',
																			recycle_entry_product_detail_modified_by 			= '%d',
																			recycle_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			recycle_entry_product_detail_modified_ip 			= '%s'

																		WHERE 

																			recycle_entry_product_detail_recycle_entry_id 		= '%d' AND 
																			recycle_entry_product_detail_id 					= '%d'",
																			$recycle_entry_product_detail_qty[$i],
																			$recycle_entry_product_detail_width_feet[$i],
																			$recycle_entry_product_detail_width_inches[$i],
																			$recycle_entry_product_detail_width_mm[$i],
																			$recycle_entry_product_detail_width_meter[$i],
																			$recycle_entry_product_detail_length_feet[$i],
																			$recycle_entry_product_detail_length_inches[$i],
																			$recycle_entry_product_detail_length_mm[$i],
																			$recycle_entry_product_detail_length_meter[$i],
																			$recycle_entry_product_detail_ext_length_feet[$i],
																			$recycle_entry_product_detail_ext_length_meter[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$recycle_entry_id, 
																			$recycle_entry_product_detail_id[$i]);	

					mysql_query($update_recycle_entry_product_detail);
					
					
					
					
			}
		$recycle_entry_width_detail_id     	 				= $_POST['recycle_entry_width_detail_id'];
		$recycle_entry_width_detail_name     	 			= $_POST['recycle_entry_width_detail_name'];
		$recycle_entry_width_detail_width_inches_one		= $_POST['recycle_entry_width_detail_width_inches_one'];
		$recycle_entry_width_detail_width_inches_two  		= $_POST['recycle_entry_width_detail_width_inches_two'];
		$recycle_entry_width_detail_width_inches_three  	= $_POST['recycle_entry_width_detail_width_inches_three'];
		$recycle_entry_width_detail_width_inches_four  		= $_POST['recycle_entry_width_detail_width_inches_four'];
		$recycle_entry_width_detail_inches_qty 				= $_POST['recycle_entry_width_detail_inches_qty'];
		$recycle_entry_width_detail_length 					= $_POST['recycle_entry_width_detail_length'];
		$recycle_entry_width_detail_length_qty 				= $_POST['recycle_entry_width_detail_length_qty'];
		for($i = 0; $i < count($recycle_entry_width_detail_name); $i++) {
				$detail_request_fields 						= 	((!empty($recycle_entry_width_detail_name[$i])));
				if($detail_request_fields) {
				    //echo "uben"; exit;
					if(isset($recycle_entry_width_detail_id[$i])){
							$update_recycle_entry_product_detail = sprintf("UPDATE 
																				recycle_entry_width_details 
																			SET  
																				recycle_entry_width_detail_name  					= '%f',
																				recycle_entry_width_detail_width_inches_one  		= '%f',
																				recycle_entry_width_detail_width_inches_two  		= '%f',
																				recycle_entry_width_detail_width_inches_three  		= '%f',
																				recycle_entry_width_detail_width_inches_four  		= '%f',
																				recycle_entry_width_detail_inches_qty  				= '%f',
																				recycle_entry_width_detail_length  					= '%f',
																				recycle_entry_width_detail_length_qty  				= '%f',
																				recycle_entry_width_detail_modified_by 				= '%d',
																				recycle_entry_width_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																				recycle_entry_width_detail_modified_ip 				= '%s'
																			WHERE 
							
																				recycle_entry_width_detail_recycle_entry_id 		= '%d' AND 
																				recycle_entry_width_detail_id 						= '%d'",
																				$recycle_entry_width_detail_name[$i],
																				$recycle_entry_width_detail_width_inches_one[$i],
																				$recycle_entry_width_detail_width_inches_two[$i],
																				$recycle_entry_width_detail_width_inches_three[$i],
																				$recycle_entry_width_detail_width_inches_four[$i],
																				$recycle_entry_width_detail_inches_qty[$i],
																				$recycle_entry_width_detail_length[$i],
																				$recycle_entry_width_detail_length_qty[$i],
																				$_SESSION[SESS.'_session_user_id'], 
																				$ip, 
																				$recycle_entry_id, 
																				$recycle_entry_product_detail_id[$i]);	
					mysql_query($update_recycle_entry_product_detail);
					$width_detail_id	 										= $recycle_entry_product_detail_id[$i];
					}
					else{
					$recycle_entry_width_detail_uniq_id 	= generateUniqId();
					$insert_recycle_entry_width_detail 		= sprintf("INSERT INTO recycle_entry_width_details 
																					(recycle_entry_width_detail_uniq_id,recycle_entry_width_detail_product_id,
																					 recycle_entry_width_detail_width_inches_one,recycle_entry_width_detail_width_inches_two,
																					 recycle_entry_width_detail_width_inches_three,recycle_entry_width_detail_width_inches_four,
																					 recycle_entry_width_detail_inches_qty,recycle_entry_width_detail_length,
																					 recycle_entry_width_detail_length_qty,recycle_entry_width_detail_name,
																					 recycle_entry_width_detail_recycle_entry_id,
																					 recycle_entry_width_detail_added_by, recycle_entry_width_detail_added_on,
																					 recycle_entry_width_detail_added_ip) 
																		VALUES     ('%s', '%d', 
																					'%f', '%f', 
																					'%f', '%f', 
																					'%f', '%f',
																					'%f', '%s', '%d', 
																					'%d', 
																					UNIX_TIMESTAMP(NOW()), '%s')", 
																					$recycle_entry_width_detail_uniq_id,$recycle_entry_product_detail_product_id,  
																					$recycle_entry_width_detail_width_inches_one[$i],
																					$recycle_entry_width_detail_width_inches_two[$i],
																					$recycle_entry_width_detail_width_inches_three[$i],
																					$recycle_entry_width_detail_width_inches_four[$i],
																					$recycle_entry_width_detail_inches_qty[$i],
																					$recycle_entry_width_detail_length[$i],
																					$recycle_entry_width_detail_length_qty[$i],
																					$recycle_entry_width_detail_name[$i],$recycle_entry_id, 
																					$_SESSION[SESS.'_session_user_id'],$ip);
					mysql_query($insert_recycle_entry_width_detail);
					
					
					}
					$recycle_entry_godown_id								= "1";
					$width_inches					= $recycle_entry_product_detail_width_inches[0];
					$length_inches					= $recycle_entry_width_detail_length[$i];
					$product_qty					= $recycle_entry_width_detail_length_qty[$i];
					$product_id						= $recycle_entry_product_detail_product_id[0];
					$stock_ledger_prd_type			= 	"recycle-entry-mother";
					stockLedger('out',$recycle_entry_id,$width_detail_id,$product_id,$length_inches,$width_inches,
								 (-1*$product_qty),$recycle_entry_branch_id, $recycle_entry_godown_id, $recycle_entry_godown_id, $recycle_entry_date, $recycle_entry_no,$stock_ledger_prd_type,"2");
					$recycle_entry_godown_id								= "2";
					stockLedger('out',$recycle_entry_id,$width_detail_id,$product_id,$length_inches,$width_inches,
								 (-1*$product_qty),$recycle_entry_branch_id, $recycle_entry_godown_id, $recycle_entry_godown_id, $recycle_entry_date, $recycle_entry_no,$stock_ledger_prd_type,"2");
				}
			}	
		
		$product_con_entry_child_product_detail_id     			= $_POST['product_con_entry_child_product_detail_id'];
		$product_con_entry_child_product_detail_code     		= $_POST['product_con_entry_child_product_detail_code'];
		$product_con_entry_child_product_detail_name   			= $_POST['product_con_entry_child_product_detail_name'];
		$product_con_entry_child_product_detail_color_id  		= $_POST['product_con_entry_child_product_detail_color_id'];
		$product_con_entry_child_product_detail_width_inches  	= $_POST['product_con_entry_child_product_detail_width_inches'];
		$product_con_entry_child_product_detail_width_mm  		= $_POST['product_con_entry_child_product_detail_width_mm'];
		$product_con_entry_child_product_detail_length_feet  	= $_POST['product_con_entry_child_product_detail_length_feet'];
		$product_con_entry_child_product_detail_length_mm 		= $_POST['product_con_entry_child_product_detail_length_mm'];
		$product_con_entry_child_product_detail_uom_id 			= $_POST['product_con_entry_child_product_detail_uom_id'];
		$product_con_entry_child_product_detail_total 			= $_POST['product_con_entry_child_product_detail_total'];
		$product_con_entry_child_product_detail_thick_ness 		= $_POST['product_con_entry_child_product_detail_thick_ness'];
		for($i=0;$i<count($product_con_entry_child_product_detail_code);$i++){
				if(isset($product_con_entry_child_product_detail_id[$i])){
					$update_product_con_entry_child_product_detail = sprintf("	UPDATE 
																			product_con_entry_child_product_details 
																		SET  
																			product_con_entry_child_product_detail_total  					= '%f',
																			product_con_entry_child_product_detail_width_inches  			= '%f',
																			product_con_entry_child_product_detail_width_mm  				= '%f',
																			product_con_entry_child_product_detail_length_mm  				= '%f',
																			product_con_entry_child_product_detail_length_feet  			= '%f',
																			product_con_entry_child_product_detail_total  					= '%f',
																			product_con_entry_child_product_detail_thick_ness  				= '%f',
																			product_con_entry_child_product_detail_modified_by 				= '%d',
																			product_con_entry_child_product_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																			product_con_entry_child_product_detail_modified_ip 				= '%s'
																		WHERE 
																			product_con_entry_child_product_detail_product_con_entry_id 	= '%d' AND 
																			product_con_entry_child_product_detail_id 					= '%d'",
																			$product_con_entry_child_product_detail_total[$i],
																			$product_con_entry_child_product_detail_width_inches[$i],
																			$product_con_entry_child_product_detail_width_mm[$i],
																			$product_con_entry_child_product_detail_length_mm[$i],
																			$product_con_entry_child_product_detail_length_feet[$i],
																			$product_con_entry_child_product_detail_total[$i],
																			$product_con_entry_child_product_detail_thick_ness[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$product_con_entry_id, 
																			$product_con_entry_child_product_detail_id[$i]);
					mysql_query($update_product_con_entry_child_product_detail);
					$product_con_entry_detail_id				= $product_con_entry_child_product_detail_id[$i];
				}
				else{
				$product_con_entry_child_product_detail_uniq_id = generateUniqId();
				$insert_product_con_entry_product_detail 		= sprintf("INSERT INTO product_con_entry_child_product_details 
																					(product_con_entry_child_product_detail_uniq_id,
																					product_con_entry_child_product_detail_product_id,
																					product_con_entry_child_product_detail_code,
																					product_con_entry_child_product_detail_name,
																					product_con_entry_child_product_detail_color_id,
																				 	product_con_entry_child_product_detail_width_inches,
																				 	product_con_entry_child_product_detail_width_mm,
																				 	product_con_entry_child_product_detail_length_mm,
																				 	product_con_entry_child_product_detail_length_feet,
																				 	product_con_entry_child_product_detail_uom_id,
																				 	product_con_entry_child_product_detail_total,
																					product_con_entry_child_product_detail_thick_ness,
																			 		product_con_entry_child_product_detail_product_con_entry_id,
																				 	product_con_entry_child_product_detail_added_by,
																				 	product_con_entry_child_product_detail_added_on,
																				 	product_con_entry_child_product_detail_added_ip,
																					product_con_entry_child_product_detail_type)  
																	VALUES     	('%s', '%d',
																	 			'%s', '%s',
																				'%d', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%d', '%f', 
																				'%f', '%d',
																				'%d', 
																				UNIX_TIMESTAMP(NOW()),'%s',
																				'%d')", 
																				$product_con_entry_child_product_detail_uniq_id,
																				$recycle_entry_product_detail_product_id, 
																				$product_con_entry_child_product_detail_code[$i], 
																				$product_con_entry_child_product_detail_name[$i], 
																				$product_con_entry_child_product_detail_color_id[$i], 
																				$product_con_entry_child_product_detail_width_inches[$i],
																				$product_con_entry_child_product_detail_width_mm[$i],
																				$product_con_entry_child_product_detail_length_mm[$i],
																				$product_con_entry_child_product_detail_length_feet[$i],
																				$product_con_entry_child_product_detail_uom_id[$i],
																				$product_con_entry_child_product_detail_total[$i],
																				$product_con_entry_child_product_detail_thick_ness[$i],
																				$recycle_entry_id, $_SESSION[SESS.'_session_user_id'],$ip,
																				"2");

				mysql_query($insert_product_con_entry_product_detail);
				$product_con_entry_detail_id 		 					= mysql_insert_id();
				}
				$length_inches										= 	$product_con_entry_child_product_detail_length_feet[$i];
				$width_inches										= 	$product_con_entry_child_product_detail_width_inches[$i];
				$product_detail_qty									= 	"1";
				$stock_ledger_entry_type							=   "recycle-entry";
				$recycle_entry_godown_id							= "1";
				stockLedger('in',$recycle_entry_id,$product_con_entry_detail_id,$product_con_entry_detail_id,$length_inches,$width_inches,$product_detail_qty, $recycle_entry_branch_id, $recycle_entry_godown_id, $recycle_entry_godown_id, $recycle_entry_date, $recycle_entry_no,$stock_ledger_entry_type,"2");
				$recycle_entry_godown_id							= "2";
				stockLedger('in',$recycle_entry_id,$product_con_entry_detail_id,$product_con_entry_detail_id,$length_inches,$width_inches,$product_detail_qty, $recycle_entry_branch_id, $recycle_entry_godown_id, $recycle_entry_godown_id, $recycle_entry_date, $recycle_entry_no,$stock_ledger_entry_type,"2");
		}
		pageRedirection("recycle-entry/index.php?page=edit&id=$recycle_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['recycle_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$recycle_entry_uniq_id = $_GET['recycle_entry_uniq_id'];

			mysql_query("UPDATE recycle_entry_product_details SET recycle_entry_product_detail_deleted_status = 1 

						WHERE recycle_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$recycle_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('recycle_entry', 'recycle_entry_deleted_by', 'recycle_entry_deleted_on' , 'recycle_entry_deleted_ip','recycle_entry_deleted_status', 'recycle_entry_id', 'recycle_entry_uniq_id', '1');
		
		
				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck = $checked[$i]; 
					$recycle_entry_id 			= getId('recycle_entry', 'recycle_entry_id', 'recycle_entry_uniq_id',$deleteCheck); 
					$select_prn_detal			= "SELECT
															*
														FROM
															recycle_entry_product_details
														WHERE
															recycle_entry_product_detail_deleted_status					= 0	AND
															recycle_entry_product_detail_recycle_entry_id				= '".$recycle_entry_id."'";

					 $result_prn_detal 			= mysql_query($select_prn_detal);
					 $response =array();
					 while($record_prn_detal = mysql_fetch_array($result_prn_detal)){
					     $update_cs_detail 	= "UPDATE  stock_ledger
													SET 
														stock_ledger_status    					= '1',
														stock_ledger_deleted_by    	   			= '".$_SESSION[SESS.'_session_user_id']."',
														stock_ledger_deleted_on 				= UNIX_TIMESTAMP(NOW()),
														stock_ledger_deleted_ip    				= '".$ip."'
												WHERE               
														stock_ledger_entry_type             	= 're-cycle-mother' 											AND
														stock_ledger_entry_id					= '".$recycle_entry_id."'										AND
														stock_ledger_entry_detail_id			= '".$record_prn_detal['recycle_entry_width_detail_id']."'";

							mysql_query($update_cs_detail);

					 }
					$select_grn_ch_detal			= "SELECT
															*
														FROM
															product_con_entry_child_product_details
														WHERE
															product_con_entry_child_product_detail_deleted_status					= 0							AND
															product_con_entry_child_product_detail_type		 						= 2 						AND 
															product_con_entry_child_product_detail_product_con_entry_id				= '".$recycle_entry_id."'	AND
															product_con_entry_child_product_detail_entry_type						= 'width-cutting'";

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
														stock_ledger_entry_type             	= 'recycle-entry' 											AND
														stock_ledger_entry_id					= '".$recycle_entry_id."'											AND
														stock_ledger_entry_detail_id			= '".$resultChData['product_con_entry_child_product_detail_id']."'	";

							mysql_query($update_cs_detail);
							
					     	$update_prd_con 	= "UPDATE  product_con_entry_child_product_details
													SET 
														product_con_entry_child_product_detail_deleted_status    			= '1',
														product_con_entry_child_product_detail_deleted_by    	   			= '".$_SESSION[SESS.'_session_user_id']."',
														product_con_entry_child_product_detail_deleted_on 					= UNIX_TIMESTAMP(NOW()),
														product_con_entry_child_product_detail_deleted_ip    				= '".$ip."'
												WHERE               
														product_con_entry_child_product_detail_id							= '".$resultChData['product_con_entry_child_product_detail_id']."'";

							mysql_query($update_prd_con);
							

					 }

				}
		

		deleteMultiRecords('recycle_entry_product_details', 'recycle_entry_product_detail_deleted_by', 'recycle_entry_product_detail_deleted_on', 'recycle_entry_product_detail_deleted_ip', 'recycle_entry_product_detail_deleted_status', 'recycle_entry_product_detail_recycle_entry_id', 'recycle_entry','recycle_entry_id','recycle_entry_uniq_id', '1');  



		

			pageRedirection("recycle-entry/index.php?msg=7");				

	}

?>