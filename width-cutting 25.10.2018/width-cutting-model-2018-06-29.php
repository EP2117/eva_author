<?php

	function insertQuotation(){
		$width_cutting_branch_id                   			= trim($_POST['width_cutting_branch_id']);
		$width_cutting_date                 				= NdateDatabaseFormat($_POST['width_cutting_date']);
		$width_cutting_godown_id      						= trim($_POST['width_cutting_godown_id']);
		$width_cutting_type     							= implode(",",$_POST['width_cutting_type']);
		$width_cutting_sw_check      						= trim($_POST['width_cutting_sw_check']);
		//Product Detail
		$width_cutting_product_detail_product_id     	 	= $_POST['width_cutting_product_detail_product_id'];
		$width_cutting_product_detail_product_brand_id 	 	= $_POST['width_cutting_product_detail_product_brand_id'];
		$width_cutting_product_detail_width_inches  		= $_POST['width_cutting_product_detail_width_inches'];
		$width_cutting_product_detail_width_mm  			= $_POST['width_cutting_product_detail_width_mm'];
		$width_cutting_product_detail_length_feet  			= $_POST['width_cutting_product_detail_length_feet'];
		$width_cutting_product_detail_length_mm  			= $_POST['width_cutting_product_detail_length_mm'];
		$width_cutting_product_detail_qty 					= $_POST['width_cutting_product_detail_qty'];
		$width_cutting_product_detail_product_thick_ness	= $_POST['product_thick_ness'];
		$width_cutting_product_detail_product_colour_id		= $_POST['width_cutting_product_detail_product_colour_id'];
		
		$width_cutting_width_detail_name     	 			= $_POST['width_cutting_width_detail_name'];
		$width_cutting_width_detail_width_inches_one		= $_POST['width_cutting_width_detail_width_inches_one'];
		$width_cutting_width_detail_width_inches_two  		= $_POST['width_cutting_width_detail_width_inches_two'];
		$width_cutting_width_detail_width_inches_three  	= $_POST['width_cutting_width_detail_width_inches_three'];
		$width_cutting_width_detail_width_inches_four  		= $_POST['width_cutting_width_detail_width_inches_four'];
		$width_cutting_width_detail_inches_qty 				= $_POST['width_cutting_width_detail_inches_qty'];
		$width_cutting_width_detail_length 					= $_POST['width_cutting_width_detail_length'];
		$width_cutting_width_detail_length_qty 				= $_POST['width_cutting_width_detail_length_qty'];
		
		$width_cutting_width_detail_width_mm_one 				= $_POST['width_cutting_width_detail_width_mm_one'];
		$width_cutting_width_detail_width_mm_two 				= $_POST['width_cutting_width_detail_width_mm_two'];
		$width_cutting_width_detail_width_mm_three 				= $_POST['width_cutting_width_detail_width_mm_three'];
		$width_cutting_width_detail_width_mm_four 				= $_POST['width_cutting_width_detail_width_mm_four'];
		
		
		$stock_ledger_prd_type 								= "width-cutting";

		$request_fields 									= ((!empty($width_cutting_branch_id)) && (!empty($width_cutting_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "width-cutting/index.php?page=add&msg=5");
		$width_cutting_uniq_id								= generateUniqId();
		$ip													= getRealIpAddr();
		$select_width_cutting_no							= "SELECT 
																	MAX(width_cutting_no) AS maxval 
															   FROM
																	width_cutting 
															   WHERE 
																	width_cutting_deleted_status 	= 0 												AND
																	width_cutting_branch_id 		= '".$width_cutting_branch_id."'						AND
																	width_cutting_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND
																	width_cutting_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";
		$result_width_cutting_no 						= mysql_query($select_width_cutting_no);
		$record_width_cutting_no 						= mysql_fetch_array($result_width_cutting_no);	
		$maxval 										= $record_width_cutting_no['maxval']; 
		if($maxval > 0) {
			$width_cutting_no 							= substr(('00000'.++$maxval),-5);
		} else {
			$width_cutting_no 							= substr(('00000'.++$maxval),-5);
		}
		$insert_width_cutting 							= sprintf("INSERT INTO width_cutting(width_cutting_uniq_id, width_cutting_date,
																					   	width_cutting_godown_id,
																					   	width_cutting_type,width_cutting_no,
																					   	width_cutting_branch_id,width_cutting_added_by,
																					  	width_cutting_added_on,width_cutting_added_ip,
																					   	width_cutting_company_id,width_cutting_financial_year,
																						width_cutting_sw_check) 
																	VALUES 	 		 (	'%s', '%s', 
																					  	'%d', 
																					  	'%d', '%s',
																					  	'%d', '%d', 
																					  	 UNIX_TIMESTAMP(NOW()),
																					  	'%s', '%d', '%d',
																						'%d')", 
																					 	$width_cutting_uniq_id, $width_cutting_date,
																					 	$width_cutting_godown_id,$width_cutting_type,$width_cutting_no,
																					 	$width_cutting_branch_id,$_SESSION[SESS.'_session_user_id'],
																					 	$ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																						$width_cutting_sw_check);  
		mysql_query($insert_width_cutting);
		//echo $insert_width_cutting; exit;
		$width_cutting_id 								= mysql_insert_id(); 
		// purchase order pproduct details
			$detail_request_fields 						= 	((!empty($width_cutting_product_detail_product_id)) && 
									 						(!empty($width_cutting_product_detail_qty)));
			if($detail_request_fields) {
				$width_cutting_product_detail_uniq_id 		= generateUniqId();
				$insert_width_cutting_product_detail 		= sprintf("INSERT INTO width_cutting_product_details 
																				(width_cutting_product_detail_uniq_id,width_cutting_product_detail_product_id,
																				 width_cutting_product_detail_width_inches,width_cutting_product_detail_width_mm,
																				 width_cutting_product_detail_length_feet,width_cutting_product_detail_length_mm,
																				 width_cutting_product_detail_qty,width_cutting_product_detail_width_cutting_id,
																				 width_cutting_product_detail_added_by, width_cutting_product_detail_added_on,
																				 width_cutting_product_detail_added_ip) 

																	VALUES     ('%s', '%d', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%d', 
																				'%d', 
																				UNIX_TIMESTAMP(NOW()), '%s')", 
																				$width_cutting_product_detail_uniq_id,$width_cutting_product_detail_product_id,  
																				$width_cutting_product_detail_width_inches,$width_cutting_product_detail_width_mm,
																				$width_cutting_product_detail_length_feet,$width_cutting_product_detail_length_mm,
																				$width_cutting_product_detail_qty,$width_cutting_id, 
																				$_SESSION[SESS.'_session_user_id'],$ip);
				mysql_query($insert_width_cutting_product_detail);
				$product_detail_id	 										= mysql_insert_id();
			}
			for($i = 0; $i < count($width_cutting_width_detail_name); $i++) {
				$detail_request_fields 						= 	((!empty($width_cutting_width_detail_name[$i])) && 
																((!empty($width_cutting_width_detail_width_inches_one[$i])) || (!empty($width_cutting_width_detail_width_inches_two[$i])) || (!empty($width_cutting_width_detail_width_inches_three[$i])) || (!empty($width_cutting_width_detail_width_inches_four[$i])) ));
				if($detail_request_fields) {
					$width_cutting_width_detail_uniq_id 	= generateUniqId();
					 $insert_width_cutting_width_detail 		= sprintf("INSERT INTO width_cutting_width_details 
																					(width_cutting_width_detail_uniq_id,width_cutting_width_detail_product_id,
																					 width_cutting_width_detail_width_inches_one,width_cutting_width_detail_width_inches_two,
																					 width_cutting_width_detail_width_inches_three,width_cutting_width_detail_width_inches_four,
																					 width_cutting_width_detail_inches_qty,width_cutting_width_detail_length,
																					 width_cutting_width_detail_length_qty,width_cutting_width_detail_name,
																					 width_cutting_width_detail_width_cutting_id,
																					 width_cutting_width_detail_added_by, width_cutting_width_detail_added_on,
																					 width_cutting_width_detail_added_ip,width_cutting_width_detail_width_mm_one,
																					 width_cutting_width_detail_width_mm_two,width_cutting_width_detail_width_mm_three,
																					 width_cutting_width_detail_width_mm_four) 
																		VALUES     ('%s', '%d', 
																					'%f', '%f', 
																					'%f', '%f', 
																					'%f', '%f',
																					'%f', '%s', '%d', 
																					'%d', 
																					UNIX_TIMESTAMP(NOW()), '%s',
																					'%f', '%f', 
																					'%f', '%f')", 
																					$width_cutting_width_detail_uniq_id,$width_cutting_product_detail_product_id,  
																					$width_cutting_width_detail_width_inches_one[$i],
																					$width_cutting_width_detail_width_inches_two[$i],
																					$width_cutting_width_detail_width_inches_three[$i],
																					$width_cutting_width_detail_width_inches_four[$i],
																					$width_cutting_width_detail_inches_qty[$i],
																					$width_cutting_width_detail_length[$i],
																					$width_cutting_width_detail_length_qty[$i],
																					$width_cutting_width_detail_name[$i],$width_cutting_id, 
																					$_SESSION[SESS.'_session_user_id'],$ip,
																					$width_cutting_width_detail_width_mm_one[$i],
																					 $width_cutting_width_detail_width_mm_two[$i],$width_cutting_width_detail_width_mm_three[$i],
																					 $width_cutting_width_detail_width_mm_four[$i]);
					mysql_query($insert_width_cutting_width_detail);
					$width_detail_id	 										= mysql_insert_id();
					//$width_cutting_godown_id								= "1";
				
				$width_val											= $width_cutting_product_detail_width_inches;
				$sales_width_val									= ($width_cutting_width_detail_width_inches_one[$i]+$width_cutting_width_detail_width_inches_two[$i]+
																	  $width_cutting_width_detail_width_inches_three[$i]+$width_cutting_width_detail_width_inches_four[$i]);
				$sales_length_val									= $width_cutting_width_detail_length[$i]*$width_cutting_width_detail_length_qty[$i];	
				$sales_width_val;		 
				$total_length										= (($sales_width_val * $sales_length_val ) / $width_val);
				$prd_calc_val										=  GetPdCalc('1',$total_length);
				$product_cal										=  explode("@",$prd_calc_val);
				$produt_id											=  $width_cutting_product_detail_product_id;
				$length_feet										=  $total_length;
				$length_meter										= 	$product_cal[3];
				$get_raw_val										=	Child_prod_detail($produt_id);
				$brand_id											= 	$width_cutting_product_detail_product_brand_id[$i];
				
				$thick												= 	$width_cutting_product_detail_product_thick_ness;
				$width_inches										= 	$width_cutting_product_detail_width_inches;
				$width_mm											= 	$width_cutting_product_detail_width_mm;
				$product_colour_id									= 	$width_cutting_product_detail_product_colour_id;
				$total_ton											=  	GetTotallenWei($brand_id,$thick,$width_inches,'');
						
				$ton_qty											= 	$total_ton*$length_feet;
				$kg_qty												= 	$ton_qty*1000;
				$product_detail_qty									= 	"-1";
				$stock_ledger_entry_type							= 	"width-cutting-mother";
				$product_con_entry_godown_id						= 	"1";
				stockLedger('out',$width_cutting_id,$width_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $width_cutting_branch_id,  $product_con_entry_godown_id, $width_cutting_date, $width_cutting_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$product_colour_id,$thick);
				if(isset($width_cutting_sw_check) && $width_cutting_sw_check==2){
					$produt_id											= $get_raw_val['product_con_entry_child_product_detail_product_id'];
					$product_con_entry_godown_id						= 	"2";
					stockLedger('out',$width_cutting_id,$width_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $width_cutting_branch_id,  $product_con_entry_godown_id, $width_cutting_date, $width_cutting_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$product_colour_id,$thick);
				}
				
					
				}
			}
			$get_raw_val												=	Child_prod_detail($produt_id);
			$width_cutting_product_id									= $get_raw_val['product_con_entry_child_product_detail_product_id'];
			$product_con_entry_child_product_detail_code     			= $_POST['product_con_entry_child_product_detail_code'];
			$product_con_entry_child_product_detail_name   				= $_POST['product_con_entry_child_product_detail_name'];
			$product_con_entry_child_product_detail_color_id  			= $_POST['product_con_entry_child_product_detail_color_id'];
			$product_con_entry_child_product_detail_thick_ness			= $_POST['product_con_entry_child_product_detail_thick_ness'];
			$product_con_entry_child_product_detail_width_inches  		= $_POST['product_con_entry_child_product_detail_width_inches'];
			$product_con_entry_child_product_detail_width_mm  			= $_POST['product_con_entry_child_product_detail_width_mm'];
			$product_con_entry_child_product_detail_length_feet  		= $_POST['product_con_entry_child_product_detail_length_feet'];
			$product_con_entry_child_product_detail_length_mm 			= $_POST['product_con_entry_child_product_detail_length_mm'];
			$product_con_entry_child_product_detail_uom_id 				= $_POST['product_con_entry_child_product_detail_uom_id'];
			$product_con_entry_child_product_detail_total 				= $_POST['product_con_entry_child_product_detail_total'];
			$product_con_entry_child_product_detail_product_brand_id 	= $_POST['product_con_entry_child_product_detail_product_brand_id'];
			$product_con_entry_child_product_detail_product_category_id	= $_POST['product_con_entry_child_product_detail_product_category_id'];
			
			for($i = 0; $i < count($product_con_entry_child_product_detail_code); $i++) {
			$detail_request_fields 						= 	((!empty($product_con_entry_child_product_detail_length_feet[$i])));
			if($detail_request_fields) {
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
																					product_con_entry_child_product_detail_type,
																					product_con_entry_child_product_detail_mas_product_id,
																					product_con_entry_child_product_detail_product_brand_id,
																					product_con_entry_child_product_detail_product_category_id)  
																	VALUES     	('%s', '%d',
																	 			'%s', '%s',
																				'%d', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%d', '%f', 
																				'%f', '%d',
																				'%d', 
																				UNIX_TIMESTAMP(NOW()),'%s',
																				'%d', '%d', '%d', '%d')", 
																				$product_con_entry_child_product_detail_uniq_id,
																				$width_cutting_product_id, 
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
																				$width_cutting_id, $_SESSION[SESS.'_session_user_id'],$ip,
																				"2",$width_cutting_product_detail_product_id,
																				$product_con_entry_child_product_detail_product_brand_id[$i],
																				$product_con_entry_child_product_detail_product_category_id[$i]);

				mysql_query($insert_product_con_entry_product_detail);
				$product_con_entry_detail_id 		 					= mysql_insert_id();
				$produt_id											=	$product_con_entry_detail_id;
				$length_feet										= 	$product_con_entry_child_product_detail_length_feet[$i];
				$length_meter										= 	$product_con_entry_child_product_detail_length_mm[$i];
				$ton_qty											= 	$product_con_entry_child_product_detail_total[$i];
				$kg_qty												= 	$product_con_entry_child_product_detail_total[$i]*1000;
				$width_inches										= 	$product_con_entry_child_product_detail_width_inches[$i];
				$width_mm											= 	$product_con_entry_child_product_detail_width_mm[$i];
				$product_colour_id									= 	$product_con_entry_child_product_detail_color_id[$i];
				$product_thick										= 	$product_con_entry_child_product_detail_thick_ness[$i];
				$product_detail_qty									= 	"1";
				$stock_ledger_entry_type							= 	"width-cutting-child";
				$product_con_entry_godown_id						= 	$width_cutting_godown_id;
				stockLedger('in',$width_cutting_id,$product_con_entry_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $width_cutting_branch_id,  $product_con_entry_godown_id, $width_cutting_date, $width_cutting_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$product_colour_id,$product_thick);
				
			}
		}
			pageRedirection("width-cutting/index.php?page=add&msg=1");
	}

	function listQuotation(){
		$select_width_cutting		=	"SELECT 
											width_cutting_id,
											width_cutting_uniq_id,
											width_cutting_no,
											width_cutting_date
										 FROM 
											width_cutting
										 WHERE 
											width_cutting_deleted_status 	= 	0 	
										 ORDER BY 
											width_cutting_no ASC";

		$result_width_cutting		= mysql_query($select_width_cutting);
		// Filling up the array

		$width_cutting_data 		= array();
		while ($record_width_cutting = mysql_fetch_array($result_width_cutting))
		{
		 $width_cutting_data[] 	= $record_width_cutting;
		}
		return $width_cutting_data;
	}
	function editQuotation(){
		$width_cutting_id 			= getId('width_cutting', 'width_cutting_id', 'width_cutting_uniq_id', dataValidation($_GET['id'])); 
		$select_width_cutting		=	"SELECT 
												width_cutting_uniq_id,  width_cutting_date,
												width_cutting_godown_id,width_cutting_type,
												width_cutting_no,
												width_cutting_branch_id,width_cutting_id,
												width_cutting_sw_check
											 FROM 
												width_cutting 
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
															brand_name
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
															brand_id 								= product_con_entry_child_product_detail_product_brand_id
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
															product_con_entry_child_product_detail_deleted_status		 	= 0 							AND 
															product_con_entry_child_product_detail_type		 					= 2 							AND 
															product_con_entry_child_product_detail_product_con_entry_id 		= '".$width_cutting_id."'";

		$result_product_con_entry_product_detail 	= mysql_query($select_product_con_entry_child_product_detail);

		$count_product_con_entry 					= mysql_num_rows($result_product_con_entry_product_detail);

		$arr_product_con_entry_product_detail 	= array();

		

		while($record_product_con_entry_product_detail = mysql_fetch_array($result_product_con_entry_product_detail)) {

			$arr_product_con_entry_product_detail[] = $record_product_con_entry_product_detail;

		}

		return $arr_product_con_entry_product_detail;

	}
	function updateQuotation(){

		$width_cutting_id                   				= trim($_POST['width_cutting_id']);
		$width_cutting_uniq_id                				= trim($_POST['width_cutting_uniq_id']);
		$width_cutting_branch_id                   			= trim($_POST['width_cutting_branch_id']);
		$width_cutting_date                 				= NdateDatabaseFormat($_POST['width_cutting_date']);
		$width_cutting_production_section_id            	= trim($_POST['width_cutting_production_section_id']);
		$width_cutting_godown_id      						= trim($_POST['width_cutting_godown_id']);
		$width_cutting_type     							= trim($_POST['width_cutting_type']);
		$width_cutting_sw_check     						= trim($_POST['width_cutting_sw_check']);

		$width_cutting_so_entry_id     						= trim($_POST['width_cutting_so_entry_id']);
		//Multi Contact
		$width_cutting_product_detail_id      				= $_POST['width_cutting_product_detail_id'];
		$width_cutting_product_detail_product_id     		= $_POST['width_cutting_product_detail_product_id'];
		$width_cutting_product_detail_width_feet  			= $_POST['width_cutting_product_detail_width_feet'];
		$width_cutting_product_detail_width_inches  		= $_POST['width_cutting_product_detail_width_inches'];
		$width_cutting_product_detail_width_mm  			= $_POST['width_cutting_product_detail_width_mm'];
		$width_cutting_product_detail_width_meter  			= $_POST['width_cutting_product_detail_width_meter'];
		$width_cutting_product_detail_length_feet  			= $_POST['width_cutting_product_detail_length_feet'];
		$width_cutting_product_detail_length_inches  		= $_POST['width_cutting_product_detail_length_inches'];
		$width_cutting_product_detail_length_mm  			= $_POST['width_cutting_product_detail_length_mm'];
		$width_cutting_product_detail_length_meter  		= $_POST['width_cutting_product_detail_length_meter'];
		$width_cutting_product_detail_ext_length_feet  		= $_POST['width_cutting_product_detail_ext_length_feet'];
		$width_cutting_product_detail_ext_length_meter  	= $_POST['width_cutting_product_detail_ext_length_meter'];
		$width_cutting_product_detail_qty 					= $_POST['width_cutting_product_detail_qty'];
		
		$width_cutting_width_detail_width_mm_one 				= $_POST['width_cutting_width_detail_width_mm_one'];
		$width_cutting_width_detail_width_mm_two 				= $_POST['width_cutting_width_detail_width_mm_two'];
		$width_cutting_width_detail_width_mm_three 				= $_POST['width_cutting_width_detail_width_mm_three'];
		$width_cutting_width_detail_width_mm_four 				= $_POST['width_cutting_width_detail_width_mm_four'];

		$request_fields 						= ((!empty($width_cutting_branch_id)) && (!empty($width_cutting_date)));

		$stock_ledger_entry_type							= "";

		checkRequestFields($request_fields, PROJECT_PATH, "width-cutting/index.php?page=edit&id=$width_cutting_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 
															width_cutting 
														SET 

															width_cutting_branch_id 				= '%d',
															width_cutting_date 						= '%s',
															width_cutting_production_section_id 	= '%d',
															width_cutting_customer_id 				= '%d',
															width_cutting_godown_id 				= '%d',
															width_cutting_sw_check 					= '%d',
															width_cutting_type 						= '%s',
															width_cutting_modified_by 				= '%d',
															width_cutting_modified_on 				= UNIX_TIMESTAMP(NOW()),
															width_cutting_modified_ip				= '%s'
														WHERE               
															width_cutting_id         				= '%d'", 
															$width_cutting_branch_id,
															$width_cutting_date,
															$width_cutting_production_section_id,
															$width_cutting_customer_id,
															$width_cutting_godown_id,
															$width_cutting_sw_check,
															$width_cutting_type,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$width_cutting_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);
			$detail_request_fields = ((!empty($width_cutting_product_detail_product_id[$i])) &&
									 (!empty($width_cutting_product_detail_qty[$i])));
			if($detail_request_fields) {
					$update_width_cutting_product_detail = sprintf("	UPDATE 

																			width_cutting_product_details 
																		SET  
																			width_cutting_product_detail_qty  					= '%f',
																			width_cutting_product_detail_width_feet  			= '%f',
																			width_cutting_product_detail_width_inches  			= '%f',
																			width_cutting_product_detail_width_mm  				= '%f',
																			width_cutting_product_detail_width_meter  			= '%f',
																			width_cutting_product_detail_length_feet  			= '%f',
																			width_cutting_product_detail_length_inches  		= '%f',
																			width_cutting_product_detail_length_mm  			= '%f',
																			width_cutting_product_detail_length_meter  			= '%f',
																			width_cutting_product_detail_ext_length_feet  		= '%f',
																			width_cutting_product_detail_ext_length_meter  		= '%f',
																			width_cutting_product_detail_modified_by 			= '%d',
																			width_cutting_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			width_cutting_product_detail_modified_ip 			= '%s'

																		WHERE 

																			width_cutting_product_detail_width_cutting_id 		= '%d' AND 
																			width_cutting_product_detail_id 					= '%d'",
																			$width_cutting_product_detail_qty[$i],
																			$width_cutting_product_detail_width_feet[$i],
																			$width_cutting_product_detail_width_inches[$i],
																			$width_cutting_product_detail_width_mm[$i],
																			$width_cutting_product_detail_width_meter[$i],
																			$width_cutting_product_detail_length_feet[$i],
																			$width_cutting_product_detail_length_inches[$i],
																			$width_cutting_product_detail_length_mm[$i],
																			$width_cutting_product_detail_length_meter[$i],
																			$width_cutting_product_detail_ext_length_feet[$i],
																			$width_cutting_product_detail_ext_length_meter[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$width_cutting_id, 
																			$width_cutting_product_detail_id[$i]);	

					mysql_query($update_width_cutting_product_detail);
			}
		$width_cutting_width_detail_id     	 				= $_POST['width_cutting_width_detail_id'];
		$width_cutting_width_detail_name     	 			= $_POST['width_cutting_width_detail_name'];
		$width_cutting_width_detail_width_inches_one		= $_POST['width_cutting_width_detail_width_inches_one'];
		$width_cutting_width_detail_width_inches_two  		= $_POST['width_cutting_width_detail_width_inches_two'];
		$width_cutting_width_detail_width_inches_three  	= $_POST['width_cutting_width_detail_width_inches_three'];
		$width_cutting_width_detail_width_inches_four  		= $_POST['width_cutting_width_detail_width_inches_four'];
		$width_cutting_width_detail_inches_qty 				= $_POST['width_cutting_width_detail_inches_qty'];
		$width_cutting_width_detail_length 					= $_POST['width_cutting_width_detail_length'];
		$width_cutting_width_detail_length_qty 				= $_POST['width_cutting_width_detail_length_qty'];
		for($i = 0; $i < count($width_cutting_width_detail_name); $i++) {
				$detail_request_fields 						= 	((!empty($width_cutting_width_detail_name[$i])));
				if($detail_request_fields) {
				    //echo "uben"; exit;
					if(isset($width_cutting_width_detail_id[$i])){
							$update_width_cutting_product_detail = sprintf("UPDATE 
																				width_cutting_width_details 
																			SET  
																				width_cutting_width_detail_name  					= '%f',
																				width_cutting_width_detail_width_inches_one  		= '%f',
																				width_cutting_width_detail_width_inches_two  		= '%f',
																				width_cutting_width_detail_width_inches_three  		= '%f',
																				width_cutting_width_detail_width_inches_four  		= '%f',
																				width_cutting_width_detail_inches_qty  				= '%f',
																				width_cutting_width_detail_length  					= '%f',
																				width_cutting_width_detail_length_qty  				= '%f',
																				width_cutting_width_detail_modified_by 				= '%d',
																				width_cutting_width_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																				width_cutting_width_detail_modified_ip 				= '%s',
																				width_cutting_width_detail_width_mm_one				= '%f',
																				width_cutting_width_detail_width_mm_two				= '%f',
																				width_cutting_width_detail_width_mm_three			= '%f',
																				width_cutting_width_detail_width_mm_four			= '%f'
																			WHERE 
							
																				width_cutting_width_detail_width_cutting_id 		= '%d' AND 
																				width_cutting_width_detail_id 						= '%d'",
																				$width_cutting_width_detail_name[$i],
																				$width_cutting_width_detail_width_inches_one[$i],
																				$width_cutting_width_detail_width_inches_two[$i],
																				$width_cutting_width_detail_width_inches_three[$i],
																				$width_cutting_width_detail_width_inches_four[$i],
																				$width_cutting_width_detail_inches_qty[$i],
																				$width_cutting_width_detail_length[$i],
																				$width_cutting_width_detail_length_qty[$i],
																				$_SESSION[SESS.'_session_user_id'], 
																				$ip, 
																				$width_cutting_width_detail_width_mm_one[$i],
																				$width_cutting_width_detail_width_mm_two[$i],
																				$width_cutting_width_detail_width_mm_three[$i],
																				$width_cutting_width_detail_width_mm_four[$i],
																				$width_cutting_id, 
																				$width_cutting_product_detail_id[$i]);	
					mysql_query($update_width_cutting_product_detail);
					$width_detail_id	 										= $width_cutting_product_detail_id[$i];
					}
					else{
					$width_cutting_width_detail_uniq_id 	= generateUniqId();
					$insert_width_cutting_width_detail 		= sprintf("INSERT INTO width_cutting_width_details 
																					(width_cutting_width_detail_uniq_id,width_cutting_width_detail_product_id,
																					 width_cutting_width_detail_width_inches_one,width_cutting_width_detail_width_inches_two,
																					 width_cutting_width_detail_width_inches_three,width_cutting_width_detail_width_inches_four,
																					 width_cutting_width_detail_inches_qty,width_cutting_width_detail_length,
																					 width_cutting_width_detail_length_qty,width_cutting_width_detail_name,
																					 width_cutting_width_detail_width_cutting_id,
																					 width_cutting_width_detail_added_by, width_cutting_width_detail_added_on,
																					 width_cutting_width_detail_added_ip) 
																		VALUES     ('%s', '%d', 
																					'%f', '%f', 
																					'%f', '%f', 
																					'%f', '%f',
																					'%f', '%s', '%d', 
																					'%d', 
																					UNIX_TIMESTAMP(NOW()), '%s')", 
																					$width_cutting_width_detail_uniq_id,$width_cutting_product_detail_product_id,  
																					$width_cutting_width_detail_width_inches_one[$i],
																					$width_cutting_width_detail_width_inches_two[$i],
																					$width_cutting_width_detail_width_inches_three[$i],
																					$width_cutting_width_detail_width_inches_four[$i],
																					$width_cutting_width_detail_inches_qty[$i],
																					$width_cutting_width_detail_length[$i],
																					$width_cutting_width_detail_length_qty[$i],
																					$width_cutting_width_detail_name[$i],$width_cutting_id, 
																					$_SESSION[SESS.'_session_user_id'],$ip);
					mysql_query($insert_width_cutting_width_detail);
					
					
					}
					$width_inches					= $width_cutting_product_detail_width_inches[0];
					$length_inches					= $width_cutting_width_detail_length[$i];
					$product_qty					= $width_cutting_width_detail_length_qty[$i];
					$product_id						= $width_cutting_product_detail_product_id[0];
					$stock_ledger_prd_type			= 	"width-cutting-mother";
					stockLedger('out',$width_cutting_id,$width_detail_id,$product_id,$length_inches,$width_inches,
								 (-1*$product_qty),$width_cutting_branch_id, $width_cutting_godown_id, $width_cutting_godown_id, $width_cutting_date, $width_cutting_no,$stock_ledger_prd_type,"2");
					$width_cutting_godown_id								= "2";
					stockLedger('out',$width_cutting_id,$width_detail_id,$product_id,$length_inches,$width_inches,
								 (-1*$product_qty),$width_cutting_branch_id, $width_cutting_godown_id, $width_cutting_godown_id, $width_cutting_date, $width_cutting_no,$stock_ledger_prd_type,"2");
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
																				$width_cutting_product_detail_product_id, 
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
																				$width_cutting_id, $_SESSION[SESS.'_session_user_id'],$ip,
																				"2");

				mysql_query($insert_product_con_entry_product_detail);
				$product_con_entry_detail_id 		 					= mysql_insert_id();
				}
				$length_inches										= 	$product_con_entry_child_product_detail_length_feet[$i];
				$width_inches										= 	$product_con_entry_child_product_detail_width_inches[$i];
				$product_detail_qty									= 	"1";
				$stock_ledger_entry_type							=   "width-cutting";
				$width_cutting_godown_id							= "1";
				stockLedger('in',$width_cutting_id,$product_con_entry_detail_id,$product_con_entry_detail_id,$length_inches,$width_inches,$product_detail_qty, $width_cutting_branch_id, $width_cutting_godown_id, $width_cutting_godown_id, $width_cutting_date, $width_cutting_no,$stock_ledger_entry_type,"2");
				$width_cutting_godown_id							= "2";
				stockLedger('in',$width_cutting_id,$product_con_entry_detail_id,$product_con_entry_detail_id,$length_inches,$width_inches,$product_detail_qty, $width_cutting_branch_id, $width_cutting_godown_id, $width_cutting_godown_id, $width_cutting_date, $width_cutting_no,$stock_ledger_entry_type,"2");
		}
		pageRedirection("width-cutting/index.php?page=edit&id=$width_cutting_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['width_cutting_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$width_cutting_uniq_id = $_GET['width_cutting_uniq_id'];

			mysql_query("UPDATE width_cutting_product_details SET width_cutting_product_detail_deleted_status = 1 

						WHERE width_cutting_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$width_cutting_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('width_cutting', 'width_cutting_deleted_by', 'width_cutting_deleted_on' , 'width_cutting_deleted_ip','width_cutting_deleted_status', 'width_cutting_id', 'width_cutting_uniq_id', '1');

		

		deleteMultiRecords('width_cutting_product_details', 'width_cutting_product_detail_deleted_by', 'width_cutting_product_detail_deleted_on', 'width_cutting_product_detail_deleted_ip', 'width_cutting_product_detail_deleted_status', 'width_cutting_product_detail_width_cutting_id', 'width_cutting','width_cutting_id','width_cutting_uniq_id', '1');  



		

		pageRedirection("width-cutting/index.php?msg=7");				

	}

?>