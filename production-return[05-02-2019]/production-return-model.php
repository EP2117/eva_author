<?php

	function insertQuotation(){

		$prn_entry_branch_id                   					= trim($_POST['prn_entry_branch_id']);

		$prn_entry_date                 						= NdateDatabaseFormat($_POST['prn_entry_date']);

		$prn_entry_from_godown_id            					= trim($_POST['prn_entry_from_godown_id']);

		$prn_entry_to_godown_id          						= trim($_POST['prn_entry_to_godown_id']);

		$prn_entry_production_section_id     					= trim($_POST['prn_entry_production_section_id']);

		$prn_entry_production_entry_id     						= trim($_POST['prn_entry_production_entry_id']);

		

		//Product Detail

		$prn_entry_product_detail_product_id     				= $_POST['prn_entry_product_detail_product_id'];
		$prn_entry_product_detail_type     						= $_POST['prn_entry_product_detail_type'];
		$prn_entry_product_detail_production_entry_detail_id  	= $_POST['prn_entry_product_detail_production_entry_detail_id'];

		$prn_entry_product_detail_width_feet  					= $_POST['prn_entry_product_detail_width_feet'];

		$prn_entry_product_detail_width_inches  				= $_POST['prn_entry_product_detail_width_inches'];

		$prn_entry_product_detail_width_mm  					= $_POST['prn_entry_product_detail_width_mm'];

		$prn_entry_product_detail_width_meter  					= $_POST['prn_entry_product_detail_width_meter'];

		$prn_entry_product_detail_length_feet  					= $_POST['prn_entry_product_detail_length_feet'];

		$prn_entry_product_detail_length_inches  				= $_POST['prn_entry_product_detail_length_inches'];

		$prn_entry_product_detail_length_mm  					= $_POST['prn_entry_product_detail_length_mm'];

		$prn_entry_product_detail_length_meter  				= $_POST['prn_entry_product_detail_length_meter'];

		$prn_entry_product_detail_ext_length_feet  				= $_POST['prn_entry_product_detail_ext_length_feet'];

		$prn_entry_product_detail_ext_length_meter  			= $_POST['prn_entry_product_detail_ext_length_meter'];

		$prn_entry_product_detail_qty 							= $_POST['prn_entry_product_detail_qty'];

		

		$request_fields 										= ((!empty($prn_entry_branch_id)) && (!empty($prn_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "production-return/index.php?page=add&msg=5");

		$prn_entry_uniq_id										= generateUniqId();

		$ip														= getRealIpAddr();

		

		$select_prn_entry_no									= "SELECT 

																		MAX(prn_entry_no) AS maxval 

																   FROM 

																		prn_entry 

																   WHERE 

																		prn_entry_deleted_status 	= 0 												AND

																		prn_entry_branch_id 		= '".$prn_entry_branch_id."'						AND

																		prn_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND

																		prn_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_prn_entry_no 									= mysql_query($select_prn_entry_no);

		$record_prn_entry_no 									= mysql_fetch_array($result_prn_entry_no);	

		$maxval 												= $record_prn_entry_no['maxval']; 

		if($maxval > 0) {

			$prn_entry_no 										= substr(('00000'.++$maxval),-5);

		} else {

			$prn_entry_no 										= substr(('00000'.++$maxval),-5);

		}

		

		

		$insert_prn_entry 					= sprintf("INSERT INTO prn_entry  (prn_entry_uniq_id, prn_entry_date,

																			  prn_entry_from_godown_id,prn_entry_to_godown_id,

																			  prn_entry_production_section_id,

																			  prn_entry_production_entry_id, prn_entry_no,

																			  prn_entry_branch_id,prn_entry_added_by,

																			  prn_entry_added_on,prn_entry_added_ip,

																			  prn_entry_company_id,prn_entry_financial_year) 

															VALUES 	 		 ('%s', '%s', 

																			  '%d', '%d', 

																			  '%d',

																			  '%d', '%s',

																			  '%d', '%d', 

																			   UNIX_TIMESTAMP(NOW()),

																			  '%s', '%d', '%d')", 

																			 $prn_entry_uniq_id, $prn_entry_date,

																			 $prn_entry_from_godown_id,$prn_entry_to_godown_id,

																			 $prn_entry_production_section_id,

																			 $prn_entry_production_entry_id,$prn_entry_no,

																			 $prn_entry_branch_id,$_SESSION[SESS.'_session_user_id'],

																			 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year']);  

		mysql_query($insert_prn_entry);

		//echo $insert_prn_entry; exit;

		$prn_entry_id 						= mysql_insert_id(); 
		for($i = 0; $i < count($prn_entry_product_detail_product_id); $i++) {

			$detail_request_fields 						= 	((!empty($prn_entry_product_detail_product_id[$i])) && 

									 						(!empty($prn_entry_product_detail_qty[$i])));

			if($detail_request_fields) {

				$prn_entry_product_detail_uniq_id 		= generateUniqId();

				$insert_prn_entry_product_detail 		= sprintf("INSERT INTO prn_entry_product_details 

																				(prn_entry_product_detail_uniq_id, prn_entry_product_detail_production_entry_id, 

																				 prn_entry_product_detail_production_entry_detail_id,

																				 prn_entry_product_detail_product_id,

																				 prn_entry_product_detail_width_feet,prn_entry_product_detail_width_inches,

																				 prn_entry_product_detail_width_mm,prn_entry_product_detail_width_meter,

																				 prn_entry_product_detail_length_feet,prn_entry_product_detail_length_inches,

																				 prn_entry_product_detail_length_mm,prn_entry_product_detail_length_meter,

																				 prn_entry_product_detail_ext_length_feet,prn_entry_product_detail_ext_length_meter,

																				 prn_entry_product_detail_qty,prn_entry_product_detail_prn_entry_id,

																				 prn_entry_product_detail_added_by,

																				 prn_entry_product_detail_added_on,prn_entry_product_detail_added_ip,
																				 prn_entry_product_detail_type) 

																	VALUES     ('%s', '%d', 

																 				'%d', '%d',

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%d', 

																				'%d', 

																				UNIX_TIMESTAMP(NOW()), '%s','%d')", 

																				$prn_entry_product_detail_uniq_id, $prn_entry_production_entry_id, 

																		 		$prn_entry_product_detail_production_entry_detail_id[$i],

																		 		$prn_entry_product_detail_product_id[$i],  

																				$prn_entry_product_detail_width_feet[$i],$prn_entry_product_detail_width_inches[$i],

																				$prn_entry_product_detail_width_mm[$i],$prn_entry_product_detail_width_meter[$i],

																				$prn_entry_product_detail_length_feet[$i],$prn_entry_product_detail_length_inches[$i],

																				$prn_entry_product_detail_length_mm[$i],$prn_entry_product_detail_length_meter[$i],

																		 		$prn_entry_product_detail_ext_length_feet[$i],

																		 		$prn_entry_product_detail_ext_length_meter[$i],

																				$prn_entry_product_detail_qty[$i],$prn_entry_id,

																				$_SESSION[SESS.'_session_user_id'],$ip,$prn_entry_product_detail_type[$i]); 

				mysql_query($insert_prn_entry_product_detail);
					$prn_entry_detail_id	= mysql_insert_id();
					$stock_ledger_entry_type							=  "production-return";
					$length_inches										= 	$prn_entry_product_detail_length_feet[$i];
					$width_inches										= 	$prn_entry_product_detail_width_inches[$i];
					$stock_ledger_prd_type								= 	$prn_entry_product_detail_type[$i];
					
					
					
					stockLedger('out',$prn_entry_id,$prn_entry_detail_id,$prn_entry_product_detail_product_id[$i],$length_inches,$width_inches,($prn_entry_product_detail_qty[$i]*-1), $prn_entry_branch_id, '0', $prn_entry_from_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);
					stockLedger('in',$prn_entry_id,$prn_entry_detail_id,$prn_entry_product_detail_product_id[$i],$length_inches,$width_inches,$prn_entry_product_detail_qty[$i], $prn_entry_branch_id, '0', $prn_entry_to_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);
			}

		

		}		

		pageRedirection("production-return/index.php?page=add&msg=1");

	}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND prn_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		$select_prn_entry		=	"SELECT 

												prn_entry_id,

												prn_entry_uniq_id,

												prn_entry_no,

												prn_entry_date,

												prn_entry_to_godown_id,

												godown_name,

												production_section_name

											 FROM 

												prn_entry

											 LEFT JOIN

												godowns

											 ON

												godown_id						=  prn_entry_from_godown_id

											 LEFT JOIN

												production_sections

											 ON

												production_section_id			=  prn_entry_production_section_id

											 WHERE 

												prn_entry_deleted_status 		= 	0	 $where

											 ORDER BY 

												prn_entry_no ASC";

		$result_prn_entry		= mysql_query($select_prn_entry);

		// Filling up the array

		$prn_entry_data 		= array();

		while ($record_prn_entry = mysql_fetch_array($result_prn_entry))

		{

		 $prn_entry_data[] 	= $record_prn_entry;

		}

		return $prn_entry_data;

	}

	function editQuotation(){

		$prn_entry_id 			= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_prn_entry		=	"SELECT 

												prn_entry_uniq_id,  prn_entry_date,

												prn_entry_from_godown_id,prn_entry_to_godown_id,

												prn_entry_production_section_id,

												prn_entry_production_entry_id, prn_entry_no,

												prn_entry_branch_id,prn_entry_id

											 FROM 

												prn_entry 

											 WHERE 

												prn_entry_deleted_status 	=  0 			AND 

												prn_entry_id				= '".$prn_entry_id."'

											 ORDER BY 

												prn_entry_no ASC";

		$result_prn_entry 		= mysql_query($select_prn_entry);

		$record_prn_entry 		= mysql_fetch_array($result_prn_entry);

		return $record_prn_entry;

	}

	function editSalesdetail(){

		$prn_entry_id 			= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$production_entry_id 	= getId('prn_entry', 'prn_entry_production_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

			$select_prn_entry		=	"SELECT 

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

		

		$result_prn_entry 		= mysql_query($select_prn_entry);

		$record_prn_entry 		= mysql_fetch_array($result_prn_entry);

		return $record_prn_entry;

	}

	function editQuotationProductDetail()

	{

		$prn_entry_id 	= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_prn_entry_product_detail 	= "	SELECT 

													prn_entry_product_detail_id,

													prn_entry_product_detail_product_id,

													prn_entry_product_detail_width_feet,prn_entry_product_detail_width_inches,

													prn_entry_product_detail_width_mm,prn_entry_product_detail_width_meter,

													prn_entry_product_detail_length_feet,prn_entry_product_detail_length_inches,

													prn_entry_product_detail_length_mm,prn_entry_product_detail_length_meter,

													prn_entry_product_detail_ext_length_feet,prn_entry_product_detail_ext_length_meter,

													prn_entry_product_detail_qty,

													prn_entry_product_detail_production_entry_detail_id,
													prn_entry_product_detail_type,
													product_thick_ness,
													product_name,
													p_uom.product_uom_name as p_uom_name,
													product_code,
													
													p_colour.product_colour_name as p_colour_nam

												FROM 

													prn_entry_product_details 

												LEFT JOIN 

													products 

												ON 

													product_id 									= prn_entry_product_detail_product_id

													
												LEFT JOIN 
													product_uoms as p_uom
												ON 
													p_uom.product_uom_id 									= product_product_uom_id
												
												LEFT JOIN 
													product_colours  as p_colour
												ON 
													p_colour.product_colour_id 								= product_product_colour_id
												

												WHERE 

													prn_entry_product_detail_deleted_status		= 0 							AND 

													prn_entry_product_detail_prn_entry_id 		= '".$prn_entry_id."'";

		$result_prn_entry_product_detail 	= mysql_query($select_prn_entry_product_detail);

		$count_prn_entry 					= mysql_num_rows($result_prn_entry_product_detail);

		$arr_prn_entry_product_detail 	= array();

		

		while($record_prn_entry_product_detail = mysql_fetch_array($result_prn_entry_product_detail)) {

			$arr_prn_entry_product_detail[] = $record_prn_entry_product_detail;

		}

		return $arr_prn_entry_product_detail;

	}

	function editQuotationRawProductDetail()

	{

		$prn_entry_id 	= getId('prn_entry', 'prn_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$production_entry_id 	= getId('prn_entry', 'prn_entry_production_entry_id', 'prn_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_production_entry_raw_product_detail 	= "	SELECT 

															production_entry_raw_product_detail_id,

															production_entry_raw_product_detail_raw_product_id,

															production_entry_raw_product_detail_product_id,

															production_entry_raw_product_detail_width_feet,production_entry_raw_product_detail_width_inches,

															production_entry_raw_product_detail_width_mm,production_entry_raw_product_detail_width_meter,

															production_entry_raw_product_detail_length_feet,production_entry_raw_product_detail_length_inches,

															production_entry_raw_product_detail_length_mm,production_entry_raw_product_detail_length_meter,

															production_entry_raw_product_detail_ext_length_feet,production_entry_raw_product_detail_ext_length_meter,

															production_entry_raw_product_detail_qty,

															product_name,

															product_uom_name,

															product_code,

															product_colour_name,

															product_thick_ness

														FROM 

															production_entry_raw_product_details 

														LEFT JOIN

															production_entry

														ON

															production_entry_id											= production_entry_raw_product_detail_production_entry_id

														LEFT JOIN 

															products 

														ON 

															product_id 												= production_entry_raw_product_detail_raw_product_id

														LEFT JOIN 

															product_uoms 

														ON 

															product_uom_id 											= product_product_uom_id

														LEFT JOIN 

															product_colours 

														ON 

															product_colour_id 										= product_product_colour_id

														WHERE 

															production_entry_raw_product_detail_deleted_status				= 0 							AND 

															production_entry_raw_product_detail_production_entry_id 		= '".$production_entry_id."'";

		$result_production_entry_raw_product_detail 	= mysql_query($select_production_entry_raw_product_detail);

		$count_production_entry 					= mysql_num_rows($result_production_entry_raw_product_detail);

		$arr_production_entry_raw_product_detail 	= array();

		$row_cnt		= 1;

		while($get_product_detail = mysql_fetch_array($result_production_entry_raw_product_detail)) {

			$arr_production_entry_raw_product_detail[] = $get_product_detail;

		}

		return $arr_production_entry_raw_product_detail;

	}

	function updateQuotation(){

		$prn_entry_id                   						= trim($_POST['prn_entry_id']);

		$prn_entry_uniq_id                						= trim($_POST['prn_entry_uniq_id']);

		$prn_entry_branch_id                   					= trim($_POST['prn_entry_branch_id']);

		$prn_entry_date                 						= NdateDatabaseFormat($_POST['prn_entry_date']);

		$prn_entry_from_godown_id            					= trim($_POST['prn_entry_from_godown_id']);

		$prn_entry_to_godown_id          						= trim($_POST['prn_entry_to_godown_id']);

		$prn_entry_production_section_id     					= trim($_POST['prn_entry_production_section_id']);

		$prn_entry_production_entry_id     						= trim($_POST['prn_entry_production_entry_id']);

		

		//Product Detail

		$prn_entry_product_detail_id      						= $_POST['prn_entry_product_detail_id'];

		$prn_entry_product_detail_product_id     				= $_POST['prn_entry_product_detail_product_id'];

		$prn_entry_product_detail_production_entry_detail_id  	= $_POST['prn_entry_product_detail_production_entry_detail_id'];

		$prn_entry_product_detail_width_feet  					= $_POST['prn_entry_product_detail_width_feet'];

		$prn_entry_product_detail_width_inches  				= $_POST['prn_entry_product_detail_width_inches'];

		$prn_entry_product_detail_width_mm  					= $_POST['prn_entry_product_detail_width_mm'];

		$prn_entry_product_detail_width_meter  					= $_POST['prn_entry_product_detail_width_meter'];

		$prn_entry_product_detail_length_feet  					= $_POST['prn_entry_product_detail_length_feet'];

		$prn_entry_product_detail_length_inches  				= $_POST['prn_entry_product_detail_length_inches'];

		$prn_entry_product_detail_length_mm  					= $_POST['prn_entry_product_detail_length_mm'];

		$prn_entry_product_detail_length_meter  				= $_POST['prn_entry_product_detail_length_meter'];

		$prn_entry_product_detail_ext_length_feet  				= $_POST['prn_entry_product_detail_ext_length_feet'];

		$prn_entry_product_detail_ext_length_meter  			= $_POST['prn_entry_product_detail_ext_length_meter'];

		$prn_entry_product_detail_qty 							= $_POST['prn_entry_product_detail_qty'];

		//Rwa Product Detail

		$prn_entry_raw_product_detail_id      					= $_POST['prn_entry_raw_product_detail_id'];
		$prn_entry_product_detail_type      					= $_POST['prn_entry_product_detail_type'];
		$prn_entry_raw_product_detail_product_id     			= $_POST['prn_entry_raw_product_detail_product_id'];

		$prn_entry_raw_product_detail_raw_product_id  			= $_POST['prn_entry_raw_product_detail_raw_product_id'];

		$prn_entry_raw_product_detail_width_feet  				= $_POST['prn_entry_raw_product_detail_width_feet'];

		$prn_entry_raw_product_detail_width_inches  			= $_POST['prn_entry_raw_product_detail_width_inches'];

		$prn_entry_raw_product_detail_width_mm  				= $_POST['prn_entry_raw_product_detail_width_mm'];

		$prn_entry_raw_product_detail_width_meter  				= $_POST['prn_entry_raw_product_detail_width_meter'];

		$prn_entry_raw_product_detail_length_feet  				= $_POST['prn_entry_raw_product_detail_length_feet'];

		$prn_entry_raw_product_detail_length_inches  			= $_POST['prn_entry_raw_product_detail_length_inches'];

		$prn_entry_raw_product_detail_length_mm  				= $_POST['prn_entry_raw_product_detail_length_mm'];

		$prn_entry_raw_product_detail_length_meter  			= $_POST['prn_entry_raw_product_detail_length_meter'];

		$prn_entry_raw_product_detail_ext_length_feet  			= $_POST['prn_entry_raw_product_detail_ext_length_feet'];

		$prn_entry_raw_product_detail_ext_length_meter  		= $_POST['prn_entry_raw_product_detail_ext_length_meter'];

		$prn_entry_raw_product_detail_qty 						= $_POST['prn_entry_raw_product_detail_qty'];

		

		$request_fields 						= ((!empty($prn_entry_branch_id)) && (!empty($prn_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "production-return/index.php?page=edit&id=$prn_entry_uniq_id");

		$ip														= getRealIpAddr();

		$update_customer 										= sprintf("	UPDATE 

																				prn_entry 

																			SET 

																				prn_entry_branch_id 				= '%d',

																				prn_entry_date 						= '%s',

																				prn_entry_from_godown_id 			= '%d',

																				prn_entry_to_godown_id 				= '%d',

																				prn_entry_production_section_id 	= '%d',

																				prn_entry_modified_by 				= '%d',

																				prn_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

																				prn_entry_modified_ip				= '%s'

																			WHERE               

																				prn_entry_id         				= '%d'", 

																				$prn_entry_branch_id,

																				$prn_entry_date,

																				$prn_entry_from_godown_id,

																				$prn_entry_to_godown_id,

																				$prn_entry_production_section_id,

																				$_SESSION[SESS.'_session_user_id'], 

																				$ip, 

																				$prn_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($prn_entry_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($prn_entry_product_detail_product_id[$i])) &&

									 (!empty($prn_entry_product_detail_qty[$i])));

			if($detail_request_fields) {

				if(isset($prn_entry_product_detail_id[$i]) && (!empty($prn_entry_product_detail_id[$i]))) {

					$update_prn_entry_product_detail = sprintf("	UPDATE 

																			prn_entry_product_details 

																		SET  

																			prn_entry_product_detail_qty  					= '%f',

																			prn_entry_product_detail_width_feet  			= '%f',

																			prn_entry_product_detail_width_inches  			= '%f',

																			prn_entry_product_detail_width_mm  				= '%f',

																			prn_entry_product_detail_width_meter  			= '%f',

																			prn_entry_product_detail_length_feet  			= '%f',

																			prn_entry_product_detail_length_inches  		= '%f',

																			prn_entry_product_detail_length_mm  			= '%f',

																			prn_entry_product_detail_length_meter  			= '%f',

																			prn_entry_product_detail_ext_length_feet  		= '%f',

																			prn_entry_product_detail_ext_length_meter  		= '%f',

																			prn_entry_product_detail_modified_by 			= '%d',

																			prn_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),

																			prn_entry_product_detail_modified_ip 			= '%s'

																		WHERE 

																			prn_entry_product_detail_prn_entry_id 	= '%d' AND 

																			prn_entry_product_detail_id 					= '%d'",

																			$prn_entry_product_detail_qty[$i],

																			$prn_entry_product_detail_width_feet[$i],

																			$prn_entry_product_detail_width_inches[$i],

																			$prn_entry_product_detail_width_mm[$i],

																			$prn_entry_product_detail_width_meter[$i],

																			$prn_entry_product_detail_length_feet[$i],

																			$prn_entry_product_detail_length_inches[$i],

																			$prn_entry_product_detail_length_mm[$i],

																			$prn_entry_product_detail_length_meter[$i],

																			$prn_entry_product_detail_ext_length_feet[$i],

																			$prn_entry_product_detail_ext_length_meter[$i],

																			$_SESSION[SESS.'_session_user_id'], 

																			$ip, 

																			$prn_entry_id, 

																			$prn_entry_product_detail_id[$i]);	

					mysql_query($update_prn_entry_product_detail);

					$prn_entry_detail_id				= $prn_entry_product_detail_id[$i];	

				} else {

					$prn_entry_product_detail_uniq_id 	= generateUniqId();

				$insert_prn_entry_product_detail 		= sprintf("INSERT INTO prn_entry_product_details 

																				(prn_entry_product_detail_uniq_id, prn_entry_product_detail_invoice_entry_id, 

																				 prn_entry_product_detail_prn_entry_detail_id,prn_entry_product_detail_product_id,

																				 prn_entry_product_detail_width_feet,prn_entry_product_detail_width_inches,

																				 prn_entry_product_detail_width_mm,prn_entry_product_detail_width_meter,

																				 prn_entry_product_detail_length_feet,prn_entry_product_detail_length_inches,

																				 prn_entry_product_detail_length_mm,prn_entry_product_detail_length_meter,

																				 prn_entry_product_detail_ext_length_feet,prn_entry_product_detail_ext_length_meter,

																				 prn_entry_product_detail_qty,prn_entry_product_detail_prn_entry_id,

																				 prn_entry_product_detail_added_by,

																				 prn_entry_product_detail_added_on,prn_entry_product_detail_added_ip,
																				 prn_entry_product_detail_type) 

																	VALUES     ('%s', '%d', 

																 				'%d', '%d',

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%f', '%d', 

																				'%d', 

																				UNIX_TIMESTAMP(NOW()), '%s', '%d')", 

																				$prn_entry_product_detail_uniq_id, $prn_entry_production_entry_id, 

																		 $prn_entry_product_detail_prn_entry_detail_id[$i],$prn_entry_product_detail_product_id[$i],  

																				$prn_entry_product_detail_width_feet[$i],$prn_entry_product_detail_width_inches[$i],

																				$prn_entry_product_detail_width_mm[$i],$prn_entry_product_detail_width_meter[$i],

																				$prn_entry_product_detail_length_feet[$i],$prn_entry_product_detail_length_inches[$i],

																				$prn_entry_product_detail_length_mm[$i],$prn_entry_product_detail_length_meter[$i],

																		 $prn_entry_product_detail_ext_length_feet[$i],$prn_entry_product_detail_ext_length_meter[$i],

																				$prn_entry_product_detail_qty[$i],$prn_entry_id, $_SESSION[SESS.'_session_user_id'],$ip,
																				$prn_entry_product_detail_type[$i]);

				mysql_query($insert_prn_entry_product_detail);
					$prn_entry_detail_id	= mysql_insert_id();
				}
					$stock_ledger_entry_type							=  "production-return";
					$length_inches										= 	$prn_entry_product_detail_length_feet[$i];
					$width_inches										= 	$prn_entry_product_detail_width_inches[$i];
					$stock_ledger_prd_type								= 	$prn_entry_product_detail_type[$i];
					stockLedger('out',$prn_entry_id,$prn_entry_detail_id,$prn_entry_product_detail_product_id[$i],$length_inches,$width_inches,($prn_entry_product_detail_qty[$i]*-1), $prn_entry_branch_id, '0', $prn_entry_from_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);
					stockLedger('in',$prn_entry_id,$prn_entry_detail_id,$prn_entry_product_detail_product_id[$i],$length_inches,$width_inches,$prn_entry_product_detail_qty[$i], $prn_entry_branch_id, '0', $prn_entry_to_godown_id, $prn_entry_date, $prn_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);
			}

		

		}

		

		

		pageRedirection("production-return/index.php?page=edit&id=$prn_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['prn_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$prn_entry_uniq_id = $_GET['prn_entry_uniq_id'];

			mysql_query("UPDATE prn_entry_product_details SET prn_entry_product_detail_deleted_status = 1 

						WHERE prn_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$prn_entry_uniq_id&msg=6");

		}

		

   } 		
	
	 function deleteProductdetails()

   {

		if((isset($_REQUEST['prn_entry_product_detail_id'])) && (isset($_REQUEST['prn_entry_uniq_id'])))

		{

			$prn_entry_product_detail_id 	= $_GET['prn_entry_product_detail_id'];

			$prn_entry_uniq_id = $_GET['prn_entry_uniq_id'];

			mysql_query("UPDATE production_entry_raw_product_details SET production_entry_raw_product_detail_deleted_status = 1 

						WHERE production_entry_raw_product_detail_id = ".$prn_entry_product_detail_id." ");

			header("Location:index.php?page=edit&id=$prn_entry_uniq_id&msg=6");

		}

		

   } 
	
	function deleteInventoryrequest(){

		deleteUniqRecords('prn_entry', 'prn_entry_deleted_by', 'prn_entry_deleted_on' , 'prn_entry_deleted_ip','prn_entry_deleted_status', 'prn_entry_id', 'prn_entry_uniq_id', '1');

		

		deleteMultiRecords('prn_entry_product_details', 'prn_entry_product_detail_deleted_by', 'prn_entry_product_detail_deleted_on', 'prn_entry_product_detail_deleted_ip', 'prn_entry_product_detail_deleted_status', 'prn_entry_product_detail_prn_entry_id', 'prn_entry','prn_entry_id','prn_entry_uniq_id', '1');  



		

		pageRedirection("production-return/index.php?msg=7");				

	}

?>