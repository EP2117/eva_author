<?php

function GetAutoNo(){
		$select_invoice_no = "SELECT MAX(advance_entry_no) AS maxval FROM advance_entry 
								  WHERE advance_entry_deleted_status =0
								  AND advance_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND advance_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval = $record_invoice_no['maxval']; 

		if($maxval > 0) {

			$advance_entry_no = substr(('00000'.++$maxval),-5);

		} else {

			$advance_entry_no = substr(('00000'.++$maxval),-5);

		}
		return $advance_entry_no;
	}
	function insertQuotation(){
		$advance_entry_no                   				= trim($_POST['advance_entry_no']);
		$advance_entry_branch_id                   			= trim($_POST['advance_entry_branch_id']);
		$advance_entry_type_id                   			= trim($_POST['advance_entry_type_id']);
		$advance_entry_date                 				= NdateDatabaseFormat($_POST['advance_entry_date']);
		$advance_entry_customer_id            				= trim($_POST['advance_entry_customer_id']);
		$advance_entry_validity_date                 		= NdateDatabaseFormat($_POST['advance_entry_validity_date']);
		$advance_entry_gross_amount                 		= ($_POST['advance_entry_gross_amount']);
		$advance_entry_transport_amount                 	= ($_POST['advance_entry_transport_amount']);
		$advance_entry_tax_per                 				= ($_POST['advance_entry_tax_per']);
		$advance_entry_tax_amount                 			= ($_POST['advance_entry_tax_amount']);
		$advance_entry_advance_amount                		= ($_POST['advance_entry_advance_amount']);
		$advance_entry_net_amount                 			= ($_POST['advance_entry_net_amount']);
		
		$request_fields 									= ((!empty($advance_entry_branch_id)) && (!empty($advance_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "advance-entry/index.php?page=add&msg=5");
		$advance_entry_uniq_id							= generateUniqId();
		$ip													= getRealIpAddr();
		$insert_advance_entry 							= sprintf("INSERT INTO advance_entry  (advance_entry_uniq_id, advance_entry_date,
																					  		  advance_entry_customer_id,advance_entry_validity_date,
																							  advance_entry_gross_amount,advance_entry_transport_amount,
																							  advance_entry_tax_per,advance_entry_tax_amount,
																							  advance_entry_advance_amount,advance_entry_net_amount,
																					   		  advance_entry_no,advance_entry_type_id,
																					  		  advance_entry_branch_id,advance_entry_added_by,
																					   		  advance_entry_added_on,advance_entry_added_ip,
																			   		   		  advance_entry_company_id,advance_entry_financial_year) 
																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%s', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%s', '%d',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d')", 
																		  	   		   		 $advance_entry_uniq_id, $advance_entry_date,
																					   		 $advance_entry_customer_id,$advance_entry_validity_date,
																					   		 $advance_entry_gross_amount,$advance_entry_transport_amount,
																							 $advance_entry_tax_per,$advance_entry_tax_amount,
																					   		 $advance_entry_advance_amount,$advance_entry_net_amount,
																					   		 $advance_entry_no,$advance_entry_type_id,
																					   		 $advance_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year']);  
		//echo $insert_advance_entry; exit;
		mysql_query($insert_advance_entry);
		$advance_entry_id 								= mysql_insert_id(); 
		
		
		//Product Detail
$advance_entry_product_detail_product_type      = $_POST['advance_entry_product_detail_product_type'];
$advance_entry_product_detail_product_id     	= $_POST['advance_entry_product_detail_product_id'];
$advance_entry_product_detail_product_uom_id    = $_POST['advance_entry_product_detail_product_uom_id'];
$advance_entry_product_detail_product_brand_id  = isset($_POST['advance_entry_product_detail_product_brand_id'])?$_POST['advance_entry_product_detail_product_brand_id']:'';
$advance_entry_product_detail_product_color_id  = isset($_POST['advance_entry_product_detail_product_color_id'])?$_POST['advance_entry_product_detail_product_color_id']:'';
$advance_entry_product_detail_product_thick  	= isset($_POST['advance_entry_product_detail_product_thick'])?$_POST['advance_entry_product_detail_product_thick']:'';
$advance_entry_product_detail_width_inches  	= isset($_POST['advance_entry_product_detail_width_inches'])?$_POST['advance_entry_product_detail_width_inches']:'';
$advance_entry_product_detail_width_mm 		  	= isset($_POST['advance_entry_product_detail_width_mm'])?$_POST['advance_entry_product_detail_width_mm']:'';
$advance_entry_product_detail_s_width_inches 	= isset($_POST['advance_entry_product_detail_s_width_inches'])?$_POST['advance_entry_product_detail_s_width_inches']:'';
$advance_entry_product_detail_s_width_mm 		= isset($_POST['advance_entry_product_detail_s_width_mm'])?$_POST['advance_entry_product_detail_s_width_mm']:'';
$advance_entry_product_detail_sl_feet 		  	= isset($_POST['advance_entry_product_detail_sl_feet'])?$_POST['advance_entry_product_detail_sl_feet']:'';
$advance_entry_product_detail_sl_feet_in 		= isset($_POST['advance_entry_product_detail_sl_feet_in'])?$_POST['advance_entry_product_detail_sl_feet_in']:'';
$advance_entry_product_detail_sl_feet_mm 		= isset($_POST['advance_entry_product_detail_sl_feet_mm'])?$_POST['advance_entry_product_detail_sl_feet_mm']:'';
$advance_entry_product_detail_s_weight_inches   = isset($_POST['advance_entry_product_detail_s_weight_inches'])?$_POST['advance_entry_product_detail_s_weight_inches']:'';
$advance_entry_product_detail_s_weight_mm   	= isset($_POST['advance_entry_product_detail_s_weight_mm'])?$_POST['advance_entry_product_detail_s_weight_mm']:'';
$advance_entry_product_detail_qty 			  	= $_POST['advance_entry_product_detail_qty'];
$advance_entry_product_detail_tot_length 		= isset($_POST['advance_entry_product_detail_tot_length'])?$_POST['advance_entry_product_detail_tot_length']:'';
$advance_entry_product_detail_rate 			  	= $_POST['advance_entry_product_detail_rate'];
$advance_entry_product_detail_total 			= $_POST['advance_entry_product_detail_total'];

		// purchase order pproduct details
		for($i = 0; $i < count($advance_entry_product_detail_product_id); $i++) { 
		// echo $advance_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($advance_entry_product_detail_product_id[$i])) && 
									 							(!empty($advance_entry_product_detail_qty[$i])));
			if($detail_request_fields) {
				$advance_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_advance_entry_product_detail 		= sprintf("INSERT INTO advance_entry_product_details 
																				(advance_entry_product_detail_uniq_id,advance_entry_product_detail_advance_entry_id,
																				 advance_entry_product_detail_product_id,advance_entry_product_detail_product_uom_id,
																				 advance_entry_product_detail_product_brand_id,advance_entry_product_detail_product_color_id,
																				 advance_entry_product_detail_product_type, advance_entry_product_detail_product_thick,
																				 advance_entry_product_detail_width_inches,advance_entry_product_detail_width_mm,
																				 advance_entry_product_detail_s_width_inches,advance_entry_product_detail_s_width_mm,
																				 advance_entry_product_detail_sl_feet,advance_entry_product_detail_sl_feet_in,
																				 advance_entry_product_detail_sl_feet_mm,
																				 advance_entry_product_detail_s_weight_inches,advance_entry_product_detail_s_weight_mm,
																				 advance_entry_product_detail_qty,advance_entry_product_detail_tot_length,
																				 advance_entry_product_detail_rate,advance_entry_product_detail_total,
																				 advance_entry_product_detail_added_by, advance_entry_product_detail_added_on,
																				 advance_entry_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $advance_entry_product_detail_uniq_id,$advance_entry_id,
																		 $advance_entry_product_detail_product_id[$i],$advance_entry_product_detail_product_uom_id[$i],
																		 $advance_entry_product_detail_product_brand_id[$i],$advance_entry_product_detail_product_color_id[$i],
																		 $advance_entry_product_detail_product_type[$i], $advance_entry_product_detail_product_thick[$i],
																		 $advance_entry_product_detail_width_inches[$i],$advance_entry_product_detail_width_mm[$i],
																		 $advance_entry_product_detail_s_width_inches[$i],$advance_entry_product_detail_s_width_mm[$i],
																		 $advance_entry_product_detail_sl_feet[$i],$advance_entry_product_detail_sl_feet_in[$i],
																		 $advance_entry_product_detail_sl_feet_mm[$i],
																		 $advance_entry_product_detail_s_weight_inches[$i],$advance_entry_product_detail_s_weight_mm[$i],
																		 $advance_entry_product_detail_qty[$i],$advance_entry_product_detail_tot_length[$i],
																		 $advance_entry_product_detail_rate[$i],$advance_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
																		// echo $insert_advance_entry_product_detail; exit;
				mysql_query($insert_advance_entry_product_detail);
				$detail_id			= mysql_insert_id();
				if($advance_entry_product_detail_product_type[$i]==1){				
						$length_inches										= 	"1";
						$width_inches										= 	"1";
						$product_detail_qty									= 	(-1*$advance_entry_product_detail_qty[$i]);
						$product_id											=   $advance_entry_product_detail_product_id[$i];
						$stock_ledger_prd_type								= 	"sales-advance";
								
						$godown_id											= 	"2";
						stockLedger('in',$advance_entry_id,$detail_id,$product_id,$length_inches,$width_inches,$product_detail_qty, $advance_entry_branch_id, $godown_id, $godown_id, $advance_entry_date, '',$stock_ledger_prd_type,'1');
				}
				elseif($advance_entry_product_detail_product_type[$i]==2){
							$produt_id											=	$advance_entry_product_detail_product_id[$i];
							$length_inches										= 	$advance_entry_product_detail_tot_length[$i];
							$width_inches										= 	$advance_entry_product_detail_width_inches[$i];
							$product_detail_qty									= 	"-1";
							$stock_ledger_prd_type								= 	"sales-advance";
							$product_con_entry_godown_id						= 	"2";
							stockLedger('in',$advance_entry_id,$detail_id,$produt_id,$length_inches,$width_inches,$product_detail_qty, $advance_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $advance_entry_date, $grn_no,$stock_ledger_prd_type, '2');
				}
			}
		}
		pageRedirection("advance-entry/index.php?page=add&msg=1");
	}

	function listQuotation(){

		$select_advance_entry		=	"SELECT 

												advance_entry_id,

												advance_entry_uniq_id,

												advance_entry_no,

												advance_entry_date,

												customer_name,

												advance_entry_validity_date

											 FROM 

												advance_entry

											 LEFT JOIN

												customers

											 ON

												customer_id		=  advance_entry_customer_id

											 WHERE 

												advance_entry_deleted_status 	= 	0 

											 ORDER BY 

												advance_entry_no ASC";

		$result_advance_entry		= mysql_query($select_advance_entry);

		// Filling up the array

		$advance_entry_data 		= array();

		while ($record_advance_entry = mysql_fetch_array($result_advance_entry))

		{

		 $advance_entry_data[] 	= $record_advance_entry;

		}

		return $advance_entry_data;

	}

	function editQuotation(){

		$advance_entry_id 			= getId('advance_entry', 'advance_entry_id', 'advance_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_advance_entry		=	"SELECT 

												*

											 FROM 

												advance_entry 

											 WHERE 

												advance_entry_deleted_status 	=  0 			AND 

												advance_entry_id				= '".$advance_entry_id."'

											 ORDER BY 

												advance_entry_no ASC";

		$result_advance_entry 		= mysql_query($select_advance_entry);

		$record_advance_entry 		= mysql_fetch_array($result_advance_entry);

		return $record_advance_entry;

	}

	function editQuotationProductDetail()

	{

		$advance_entry_id 	= getId('advance_entry', 'advance_entry_id', 'advance_entry_uniq_id', dataValidation($_GET['id'])); 

	 $select_advance_entry_product_detail 		= "SELECT 
															A.*,
															product_name,
															p_uom.product_uom_name as p_uom_name,
															product_code,
															child_uom.product_uom_name as c_uom_name,
															product_thick_ness,
															advance_entry_product_detail_product_type,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															product_con_entry_child_product_detail_width_inches,
															product_con_entry_child_product_detail_product_id,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name
														FROM 
															advance_entry_product_details A
														LEFT JOIN 
															products 
														ON 
															product_id 												= advance_entry_product_detail_product_id
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id				= advance_entry_product_detail_product_id	
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
														LEFT JOIN 
															brands 
														ON 
															brand_id 												= advance_entry_product_detail_product_brand_id
														WHERE 
															advance_entry_product_detail_deleted_status		 	= 0 							AND 
															advance_entry_product_detail_advance_entry_id 		= '".$advance_entry_id."'";

		$result_advance_entry_product_detail 	= mysql_query($select_advance_entry_product_detail);
		$count_advance_entry 					= mysql_num_rows($result_advance_entry_product_detail);
		$arr_advance_entry_product_detail 	= array();
		while($record_advance_entry_product_detail = mysql_fetch_array($result_advance_entry_product_detail)) {
			$arr_advance_entry_product_detail[] = $record_advance_entry_product_detail;
		}
		return $arr_advance_entry_product_detail;
	}

	function updateQuotation(){

		$advance_entry_id                   				= trim($_POST['advance_entry_id']);
		$advance_entry_uniq_id                			= trim($_POST['advance_entry_uniq_id']);
		$advance_entry_branch_id                   		= trim($_POST['advance_entry_branch_id']);
		$advance_entry_type_id							= trim($_POST['advance_entry_type_id']);
		$advance_entry_date                 				= NdateDatabaseFormat($_POST['advance_entry_date']);
		$advance_entry_customer_id            			= trim($_POST['advance_entry_customer_id']);
		$advance_entry_validity_date      				= NdateDatabaseFormat($_POST['advance_entry_validity_date']);
		$advance_entry_gross_amount                 		= trim($_POST['advance_entry_gross_amount']);
		$advance_entry_transport_amount                 	= trim($_POST['advance_entry_transport_amount']);
		$advance_entry_tax_per                 			= trim($_POST['advance_entry_tax_per']);
		$advance_entry_tax_amount                 		= trim($_POST['advance_entry_tax_amount']);
		$advance_entry_advance_amount                		= trim($_POST['advance_entry_advance_amount']);
		$advance_entry_net_amount                 		= trim($_POST['advance_entry_net_amount']);
		//$advance_entry_so_entry_id     					= trim($_POST['advance_entry_so_entry_id']);
		
		$request_fields 									= ((!empty($advance_entry_branch_id)) && (!empty($advance_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "advance-entry/index.php?page=edit&id=$advance_entry_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 

															advance_entry 

														SET 

															advance_entry_branch_id 					= '%d',

															advance_entry_date 						= '%s',

															advance_entry_customer_id 				= '%d',

															advance_entry_validity_date 				= '%s',

															advance_entry_gross_amount 				= '%f',

															advance_entry_transport_amount 			= '%f',

															advance_entry_tax_per 					= '%f',

															advance_entry_tax_amount 					= '%f',

															advance_entry_advance_amount 				= '%f',

															advance_entry_net_amount 					= '%f',

															advance_entry_modified_by 				= '%d',

															advance_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															advance_entry_modified_ip				= '%s'

														WHERE               

															advance_entry_id         				= '%d'", 

															$advance_entry_branch_id,

															$advance_entry_date,

															$advance_entry_customer_id,

															$advance_entry_validity_date,

															$advance_entry_gross_amount,

															$advance_entry_transport_amount,

															$advance_entry_tax_per,

															$advance_entry_tax_amount,

															$advance_entry_advance_amount,

															$advance_entry_net_amount,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$advance_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

$advance_entry_product_detail_product_type      = $_POST['advance_entry_product_detail_product_type'];
$advance_entry_product_detail_product_id     	  = $_POST['advance_entry_product_detail_product_id'];
$advance_entry_product_detail_product_uom_id    = $_POST['advance_entry_product_detail_product_uom_id'];
$advance_entry_product_detail_product_brand_id  = isset($_POST['advance_entry_product_detail_product_brand_id'])?$_POST['advance_entry_product_detail_product_brand_id']:'';
$advance_entry_product_detail_product_color_id  = isset($_POST['advance_entry_product_detail_product_color_id'])?$_POST['advance_entry_product_detail_product_color_id']:'';
$advance_entry_product_detail_product_thick  	  = isset($_POST['advance_entry_product_detail_product_thick'])?$_POST['advance_entry_product_detail_product_thick']:'';
$advance_entry_product_detail_width_inches  	  = isset($_POST['advance_entry_product_detail_width_inches'])?$_POST['advance_entry_product_detail_width_inches']:'';
$advance_entry_product_detail_width_mm 		  = isset($_POST['advance_entry_product_detail_width_mm'])?$_POST['advance_entry_product_detail_width_mm']:'';
$advance_entry_product_detail_s_width_inches 	  = isset($_POST['advance_entry_product_detail_s_width_inches'])?$_POST['advance_entry_product_detail_s_width_inches']:'';
$advance_entry_product_detail_s_width_mm 		  = isset($_POST['advance_entry_product_detail_s_width_mm'])?$_POST['advance_entry_product_detail_s_width_mm']:'';
$advance_entry_product_detail_sl_feet 		  = isset($_POST['advance_entry_product_detail_sl_feet'])?$_POST['advance_entry_product_detail_sl_feet']:'';
$advance_entry_product_detail_sl_feet_in 		  = isset($_POST['advance_entry_product_detail_sl_feet_in'])?$_POST['advance_entry_product_detail_sl_feet_in']:'';
$advance_entry_product_detail_sl_feet_mm 		  = isset($_POST['advance_entry_product_detail_sl_feet_mm'])?$_POST['advance_entry_product_detail_sl_feet_mm']:'';

$advance_entry_product_detail_s_weight_inches   = isset($_POST['advance_entry_product_detail_s_weight_inches'])?$_POST['advance_entry_product_detail_s_weight_inches']:'';
$advance_entry_product_detail_s_weight_mm   	  = isset($_POST['advance_entry_product_detail_s_weight_mm'])?$_POST['advance_entry_product_detail_s_weight_mm']:'';

$advance_entry_product_detail_qty 			  = $_POST['advance_entry_product_detail_qty'];
$advance_entry_product_detail_tot_length 		  = isset($_POST['advance_entry_product_detail_tot_length'])?$_POST['advance_entry_product_detail_tot_length']:'';
$advance_entry_product_detail_rate 			  = $_POST['advance_entry_product_detail_rate'];
$advance_entry_product_detail_total 			  = $_POST['advance_entry_product_detail_total'];

$advance_entry_product_detail_id 			  	  = $_POST['advance_entry_product_detail_id'];

		for($i = 0; $i < count($advance_entry_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($advance_entry_product_detail_product_id[$i])) &&

									 (!empty($advance_entry_product_detail_qty[$i])));

			if($detail_request_fields) { 

				if(isset($advance_entry_product_detail_id[$i]) && (!empty($advance_entry_product_detail_id[$i]))) {

					$update_advance_entry_product_detail = sprintf("UPDATE 

																			advance_entry_product_details 

																		SET  

																			advance_entry_product_detail_width_inches  			= '%f',

																			advance_entry_product_detail_width_mm  				= '%f',

																			advance_entry_product_detail_s_width_inches  			= '%f',

																			advance_entry_product_detail_s_width_mm  				= '%f',

																			advance_entry_product_detail_sl_feet  				= '%f',
																			
																			advance_entry_product_detail_sl_feet_in  				= '%f',
																			
																			advance_entry_product_detail_sl_feet_mm  				= '%f',
																			
																			advance_entry_product_detail_s_weight_inches  		= '%f',
																			
																			advance_entry_product_detail_s_weight_mm  			= '%f',

																			advance_entry_product_detail_tot_length  				= '%f',
																			
																			advance_entry_product_detail_qty  					= '%f',

																			advance_entry_product_detail_rate  					= '%f',

																			advance_entry_product_detail_total  					= '%f',

																			advance_entry_product_detail_modified_by 				= '%d',

																			advance_entry_product_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),

																			advance_entry_product_detail_modified_ip 				= '%s'

																		WHERE 

																			advance_entry_product_detail_advance_entry_id 	= '%d' AND 

																			advance_entry_product_detail_id 					= '%d'",

																			$advance_entry_product_detail_width_inches[$i],

																			$advance_entry_product_detail_width_mm[$i],

																			$advance_entry_product_detail_s_width_inches[$i],

																			$advance_entry_product_detail_s_width_mm[$i],

																			$advance_entry_product_detail_sl_feet[$i],
																			
																			$advance_entry_product_detail_sl_feet_in[$i],
																			
																			$advance_entry_product_detail_sl_feet_mm[$i],
																			
																			$advance_entry_product_detail_s_weight_inches[$i],
																			
																			$advance_entry_product_detail_s_weight_mm[$i],

																			$advance_entry_product_detail_tot_length[$i],
																			
																			$advance_entry_product_detail_qty[$i],

																			$advance_entry_product_detail_rate[$i],

																			$advance_entry_product_detail_total[$i],

																			$_SESSION[SESS.'_session_user_id'], 

																			$ip, 

																			$advance_entry_id, 

																			$advance_entry_product_detail_id[$i]);	
			//	echo $update_advance_entry_product_detail; exit;
					mysql_query($update_advance_entry_product_detail);

					$detail_id	= $advance_entry_product_detail_id[$i];	

				} else {

					$advance_entry_product_detail_uniq_id 	= generateUniqId();

					$insert_advance_entry_product_detail 	= sprintf("INSERT INTO advance_entry_product_details 
																				(advance_entry_product_detail_uniq_id,advance_entry_product_detail_advance_entry_id,
																				 advance_entry_product_detail_product_id,advance_entry_product_detail_product_uom_id,
																				 advance_entry_product_detail_product_brand_id,advance_entry_product_detail_product_color_id,
																				 advance_entry_product_detail_product_type, advance_entry_product_detail_product_thick,
																				 advance_entry_product_detail_width_inches,advance_entry_product_detail_width_mm,
																				 advance_entry_product_detail_s_width_inches,advance_entry_product_detail_s_width_mm,
																				 advance_entry_product_detail_sl_feet,advance_entry_product_detail_sl_feet_in,
																				 advance_entry_product_detail_sl_feet_mm,
																				 advance_entry_product_detail_s_weight_inches,advance_entry_product_detail_s_weight_mm,
																				 advance_entry_product_detail_qty,advance_entry_product_detail_tot_length,
																				 advance_entry_product_detail_rate,advance_entry_product_detail_total,
																				 advance_entry_product_detail_added_by, advance_entry_product_detail_added_on,
																				 advance_entry_product_detail_added_ip) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s' )", 
																		 $advance_entry_product_detail_uniq_id,$advance_entry_id,
																		 $advance_entry_product_detail_product_id[$i],$advance_entry_product_detail_product_uom_id[$i],
																		 $advance_entry_product_detail_product_brand_id[$i],$advance_entry_product_detail_product_color_id[$i],
																		 $advance_entry_product_detail_product_type[$i], $advance_entry_product_detail_product_thick[$i],
																		 $advance_entry_product_detail_width_inches[$i],$advance_entry_product_detail_width_mm[$i],
																		 $advance_entry_product_detail_s_width_inches[$i],$advance_entry_product_detail_s_width_mm[$i],
																		 $advance_entry_product_detail_sl_feet[$i],$advance_entry_product_detail_sl_feet_in[$i],
																		 $advance_entry_product_detail_sl_feet_mm[$i],
																		 $advance_entry_product_detail_s_weight_inches[$i],$advance_entry_product_detail_s_weight_mm[$i],
																		 $advance_entry_product_detail_qty[$i],$advance_entry_product_detail_tot_length[$i],
																		 $advance_entry_product_detail_rate[$i],$advance_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip);
					//echo $insert_advance_entry_product_detail; exit;
					mysql_query($insert_advance_entry_product_detail);
					$detail_id	= mysql_insert_id();
				}
				
				if($advance_entry_product_detail_product_type[$i]==1){				
						$length_inches										= 	"1";
						$width_inches										= 	"1";
						$product_detail_qty									= 	(-1*$advance_entry_product_detail_qty[$i]);
						$product_id											=   $advance_entry_product_detail_product_id[$i];
						$stock_ledger_prd_type								= 	"sales-advance";
								
						$godown_id											= 	"2";
						stockLedger('in',$advance_entry_id,$detail_id,$product_id,$length_inches,$width_inches,$product_detail_qty, $advance_entry_branch_id, $godown_id, $godown_id, $advance_entry_date, '',$stock_ledger_prd_type,'1');
				}
				elseif($advance_entry_product_detail_product_type[$i]==2){
							$produt_id											=	$advance_entry_product_detail_product_id[$i];
							$length_inches										= 	$advance_entry_product_detail_tot_length[$i];
							$width_inches										= 	$advance_entry_product_detail_width_inches[$i];
							$product_detail_qty									= 	"-1";
							$stock_ledger_prd_type								= 	"sales-advance";
							$product_con_entry_godown_id						= 	"2";
							stockLedger('in',$advance_entry_id,$detail_id,$produt_id,$length_inches,$width_inches,$product_detail_qty, $advance_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $advance_entry_date, $grn_no,$stock_ledger_prd_type, '2');
				}

			}

		

		}

		pageRedirection("advance-entry/index.php?page=edit&id=$advance_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['advance_entry_uniq_id'])))

		{

			$product_detail_id 		 = $_GET['product_detail_id'];

			$advance_entry_uniq_id = $_GET['advance_entry_uniq_id'];

			mysql_query("UPDATE advance_entry_product_details SET advance_entry_product_detail_deleted_status = 1 

						WHERE advance_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$advance_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('advance_entry', 'advance_entry_deleted_by', 'advance_entry_deleted_on' , 'advance_entry_deleted_ip','advance_entry_deleted_status', 'advance_entry_id', 'advance_entry_uniq_id', '1');

		

		deleteMultiRecords('advance_entry_product_details', 'advance_entry_product_detail_deleted_by', 'advance_entry_product_detail_deleted_on', 'advance_entry_product_detail_deleted_ip', 'advance_entry_product_detail_deleted_status', 'advance_entry_product_detail_advance_entry_id', 'advance_entry','advance_entry_id','advance_entry_uniq_id', '1');  



		

		pageRedirection("advance-entry/index.php?msg=7");				

	}

?>