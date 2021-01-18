<?php

	function insertQuotation(){

		$product_con_entry_no                   				= trim($_POST['product_con_entry_no']);
		$product_con_entry_branch_id                   			= trim($_POST['product_con_entry_branch_id']);
		$product_con_entry_date                 				= NdateDatabaseFormat($_POST['product_con_entry_date']);
		$product_con_entry_godown_id            				= trim($_POST['product_con_entry_godown_id']);
		$product_con_entry_invoice_entry_id        				= trim($_POST['product_con_entry_invoice_entry_id']);
		$product_con_entry_child_length_feet_tot   				= trim($_POST['product_con_entry_child_length_feet_tot']);
		$stock_ledger_entry_type								= 'product-con-entry';
		//Product Detail
		$product_con_entry_product_detail_product_id     		= $_POST['product_con_entry_product_detail_product_id'];
		$product_con_entry_product_detail_invoice_detail_id   	= $_POST['product_con_entry_product_detail_invoice_detail_id'];
		$product_con_entry_product_detail_width_inches  		= $_POST['product_con_entry_product_detail_width_inches'];
		$product_con_entry_product_detail_width_mm  			= $_POST['product_con_entry_product_detail_width_mm'];
		$product_con_entry_product_detail_length_feet  			= $_POST['product_con_entry_product_detail_length_feet'];
		$product_con_entry_product_detail_length_mm  			= $_POST['product_con_entry_product_detail_length_mm'];
		$product_con_entry_product_detail_qty 					= $_POST['product_con_entry_product_detail_qty'];
		$product_con_entry_product_detail_total_qty 			= $_POST['product_con_entry_product_detail_total_qty'];
		
		$product_con_entry_child_product_detail_code     		= $_POST['product_con_entry_child_product_detail_code'];
		$product_con_entry_child_product_detail_name   			= $_POST['product_con_entry_child_product_detail_name'];
		$product_con_entry_child_product_detail_color_id  		= $_POST['product_con_entry_child_product_detail_color_id'];
		$product_con_entry_child_product_detail_width_inches  	= $_POST['product_con_entry_child_product_detail_width_inches'];
		$product_con_entry_child_product_detail_width_mm  		= $_POST['product_con_entry_child_product_detail_width_mm'];
		$product_con_entry_child_product_detail_length_feet  	= $_POST['product_con_entry_child_product_detail_length_feet'];
		$product_con_entry_child_product_detail_length_mm 		= $_POST['product_con_entry_child_product_detail_length_mm'];
		$product_con_entry_child_product_detail_uom_id 			= $_POST['product_con_entry_child_product_detail_uom_id'];
		$product_con_entry_child_product_detail_total 			= $_POST['product_con_entry_child_product_detail_total'];
		
		$product_con_entry_child_product_detail_con_width_inches  	= $_POST['product_con_entry_child_product_detail_con_width_inches'];
		$product_con_entry_child_product_detail_con_width_mm  		= $_POST['product_con_entry_child_product_detail_con_width_mm'];
		$product_con_entry_child_product_detail_con_length_feet  	= $_POST['product_con_entry_child_product_detail_con_length_feet'];
		$product_con_entry_child_product_detail_con_length_mm 		= $_POST['product_con_entry_child_product_detail_con_length_mm'];
		$product_con_entry_child_product_detail_con_tone 			= $_POST['product_con_entry_child_product_detail_con_tone'];
		$request_fields 											= ((!empty($product_con_entry_branch_id)) && (!empty($product_con_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "product-con-entry/index.php?page=add&msg=5");

		$product_con_entry_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();

		$insert_product_con_entry 							= sprintf("INSERT INTO product_con_entry  (product_con_entry_uniq_id, product_con_entry_date,
																					  		  product_con_entry_godown_id,product_con_entry_no,
																					  		  product_con_entry_branch_id,product_con_entry_added_by,
																					   		  product_con_entry_added_on,product_con_entry_added_ip,
																			   		   		  product_con_entry_company_id,product_con_entry_financial_year,
																							  product_con_entry_invoice_entry_id,product_con_entry_child_length_feet_tot) 

																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d',
																							  '%d', '%f')", 
																		  	   		   		 $product_con_entry_uniq_id, $product_con_entry_date,
																					   		 $product_con_entry_godown_id,$product_con_entry_no,
																					   		 $product_con_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $product_con_entry_invoice_entry_id,$product_con_entry_child_length_feet_tot);  
		mysql_query($insert_product_con_entry);
		//echo $insert_product_con_entry; exit;
		$product_con_entry_id 							= mysql_insert_id(); 

		// purchase order pproduct details
		$product_con_entry_product_detail_uniq_id = generateUniqId();
		$insert_product_con_entry_product_detail 		= sprintf("INSERT INTO product_con_entry_product_details 
																		(product_con_entry_product_detail_uniq_id,product_con_entry_product_detail_product_id,
																		 product_con_entry_product_detail_width_inches,product_con_entry_product_detail_width_mm,
																		 product_con_entry_product_detail_length_mm,product_con_entry_product_detail_length_feet,
																		 product_con_entry_product_detail_total_qty,product_con_entry_product_detail_qty,
																		 product_con_entry_product_detail_invoice_entry_id,
																		 product_con_entry_product_detail_invoice_detail_id,
																		 product_con_entry_product_detail_product_con_entry_id,product_con_entry_product_detail_added_by,
																		 product_con_entry_product_detail_added_on,product_con_entry_product_detail_added_ip) 
															VALUES     ('%s', '%d', 
																		'%f', '%f', 
																		'%f', '%f', 
																		'%f', '%f', 
																		'%d', '%d',
																		'%d', '%d', 
																		UNIX_TIMESTAMP(NOW()), '%s')", 
																		$product_con_entry_product_detail_uniq_id,$product_con_entry_product_detail_product_id,  
																		$product_con_entry_product_detail_width_inches,$product_con_entry_product_detail_width_mm,
																		$product_con_entry_product_detail_length_mm,$product_con_entry_product_detail_length_feet,
																		$product_con_entry_product_detail_total_qty,$product_con_entry_product_detail_qty,
																		$product_con_entry_invoice_entry_id,$product_con_entry_product_detail_invoice_detail_id,
																		$product_con_entry_id, $_SESSION[SESS.'_session_user_id'],$ip);
		mysql_query($insert_product_con_entry_product_detail);
		// Product
		$product_con_entry_detail_id  						= 	mysql_insert_id();
		$length_inches										= 	"1";
		$width_inches										= 	"1";
		$product_detail_qty									= 	$product_con_entry_product_detail_qty;
		$stock_ledger_prd_type								= 	"product-con-detail";
		$product_con_entry_godown_id						= 	"1";
		$product_id											= 	$product_con_entry_product_detail_product_id;
		stockLedger('out',$product_con_entry_id,$product_con_entry_detail_id,$product_id,$length_inches,$width_inches,(-1*$product_detail_qty), $product_con_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_prd_type,'1');
		$product_con_entry_godown_id						= 	"2";
		stockLedger('out',$product_con_entry_id,$product_con_entry_detail_id,$product_id,$length_inches,$width_inches,(-1*$product_detail_qty), $product_con_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_prd_type,'1');

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
																					
																					product_con_entry_child_product_detail_con_width_inches,
																				 	product_con_entry_child_product_detail_con_width_mm,
																				 	product_con_entry_child_product_detail_con_length_feet,
																				 	product_con_entry_child_product_detail_con_length_mm,
																				 	product_con_entry_child_product_detail_con_tone,
																					
																				 	product_con_entry_child_product_detail_invoice_entry_id,
																				 	product_con_entry_child_product_detail_invoice_detail_id,
																				 	product_con_entry_child_product_detail_product_con_entry_id,
																				 	product_con_entry_child_product_detail_added_by,
																				 	product_con_entry_child_product_detail_added_on,
																				 	product_con_entry_child_product_detail_added_ip)  
																	VALUES     	('%s', '%d',
																	 			'%s', '%s',
																				'%d', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f',
																				'%d', '%d',
																				'%d', '%d', 
																				UNIX_TIMESTAMP(NOW()), '%s')", 
																				$product_con_entry_child_product_detail_uniq_id,
																				$product_con_entry_product_detail_product_id, 
																				$product_con_entry_child_product_detail_code[$i], 
																				$product_con_entry_child_product_detail_name[$i], 
																				$product_con_entry_child_product_detail_color_id[$i], 
																				$product_con_entry_child_product_detail_width_inches[$i],
																				$product_con_entry_child_product_detail_width_mm[$i],
																				$product_con_entry_child_product_detail_length_mm[$i],
																				$product_con_entry_child_product_detail_length_feet[$i],
																				$product_con_entry_child_product_detail_uom_id[$i],
																				$product_con_entry_child_product_detail_total[$i],
																				$product_con_entry_child_product_detail_con_width_inches[$i],
																				$product_con_entry_child_product_detail_con_width_mm[$i],
																				$product_con_entry_child_product_detail_con_length_feet[$i],
																				$product_con_entry_child_product_detail_con_length_mm[$i],
																				$product_con_entry_child_product_detail_con_tone[$i],
																				$product_con_entry_invoice_entry_id,
																				$product_con_entry_product_detail_invoice_detail_id,
																				$product_con_entry_id, $_SESSION[SESS.'_session_user_id'],$ip);

				mysql_query($insert_product_con_entry_product_detail);
				$product_con_entry_detail_id  = mysql_insert_id();
				$length_inches										= 	$product_con_entry_child_product_detail_length_feet[$i];
				$width_inches										= 	$product_con_entry_child_product_detail_width_inches[$i];
				$product_detail_qty									= 	"1";
				$stock_ledger_prd_type								= 	"product-con-entry";
				$product_con_entry_godown_id						= "1";
				stockLedger('in',$product_con_entry_id,$product_con_entry_detail_id,$product_con_entry_detail_id,$length_inches,$width_inches,$product_detail_qty, $product_con_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_prd_type,'2');
				$product_con_entry_godown_id						= "2";
				stockLedger('in',$product_con_entry_id,$product_con_entry_detail_id,$product_con_entry_detail_id,$length_inches,$width_inches,$product_detail_qty, $product_con_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_prd_type,'2');
			}
		}
		pageRedirection("product-con-entry/index.php?page=add&msg=1");

	}

	function listQuotation(){

		$select_product_con_entry		=	"SELECT 

												product_con_entry_id,

												product_con_entry_uniq_id,

												product_con_entry_no,

												product_con_entry_date,

												godown_name

											 FROM 

												product_con_entry

											 LEFT JOIN
												godowns
											 ON
												godown_id		=  product_con_entry_godown_id
											 WHERE 

												product_con_entry_deleted_status 	= 	0 

											 ORDER BY 

												product_con_entry_no ASC";

		$result_product_con_entry		= mysql_query($select_product_con_entry);

		// Filling up the array

		$product_con_entry_data 		= array();

		while ($record_product_con_entry = mysql_fetch_array($result_product_con_entry))

		{

		 $product_con_entry_data[] 	= $record_product_con_entry;

		}

		return $product_con_entry_data;

	}

	function editQuotation(){

		$product_con_entry_id 			= getId('product_con_entry', 'product_con_entry_id', 'product_con_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_product_con_entry		=	"SELECT 

												product_con_entry_uniq_id,  product_con_entry_date,
												product_con_entry_godown_id,
												product_con_entry_no,
												product_con_entry_branch_id,product_con_entry_id,
												invoiceNo,pI_invoice_date,
												product_con_entry_invoice_entry_id,
												product_con_entry_child_length_feet_tot
											 FROM 
												product_con_entry
											LEFT JOIN
												purchase_invoice
											ON
												invoiceId							= product_con_entry_invoice_entry_id 
											 WHERE 
												product_con_entry_deleted_status 	=  0 			AND 
												product_con_entry_id				= '".$product_con_entry_id."'
											 ORDER BY 
												product_con_entry_no ASC";

		$result_product_con_entry 		= mysql_query($select_product_con_entry);

		$record_product_con_entry 		= mysql_fetch_array($result_product_con_entry);

		return $record_product_con_entry;

	}

	function editQuotationProductDetail()
	{

		$product_con_entry_id 	= getId('product_con_entry', 'product_con_entry_id', 'product_con_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_product_con_entry_product_detail 	= "	SELECT 

															product_con_entry_product_detail_id,

															product_con_entry_product_detail_product_id,

															product_con_entry_product_detail_width_inches,product_con_entry_product_detail_width_mm,

															product_con_entry_product_detail_length_mm,product_con_entry_product_detail_length_feet,

															product_con_entry_product_detail_total_qty,product_con_entry_product_detail_qty,

															product_name,

															product_uom_name,

															product_code,

															product_colour_name,

															product_thick_ness

														FROM 

															product_con_entry_product_details 

														LEFT JOIN 

															products 

														ON 

															product_id 		= product_con_entry_product_detail_product_id

														LEFT JOIN 

															product_uoms 

														ON 

															product_uom_id 						= product_product_uom_id

														LEFT JOIN 

															product_colours 

														ON 

															product_colour_id 						= product_product_colour_id

														WHERE 
															product_con_entry_product_detail_deleted_status		 	= 0 							AND 

															product_con_entry_product_detail_product_con_entry_id 		= '".$product_con_entry_id."'";

		$result_product_con_entry_product_detail 	= mysql_query($select_product_con_entry_product_detail);

		$count_product_con_entry 					= mysql_num_rows($result_product_con_entry_product_detail);

		$arr_product_con_entry_product_detail 	= array();

		

		while($record_product_con_entry_product_detail = mysql_fetch_array($result_product_con_entry_product_detail)) {

			$arr_product_con_entry_product_detail[] = $record_product_con_entry_product_detail;

		}

		return $arr_product_con_entry_product_detail;

	}
	
	function editChildProductDetail()
	{

		$product_con_entry_id 	= getId('product_con_entry', 'product_con_entry_id', 'product_con_entry_uniq_id', dataValidation($_GET['id'])); 

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
															product_con_entry_child_product_detail_con_width_inches,
															product_con_entry_child_product_detail_con_width_mm,
															product_con_entry_child_product_detail_con_length_feet,
															product_con_entry_child_product_detail_con_length_mm,
															product_con_entry_child_product_detail_con_tone

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
															product_con_entry_child_product_detail_deleted_status		 		= 0 							AND 
															product_con_entry_child_product_detail_type		 					= 1 							AND 
															product_con_entry_child_product_detail_product_con_entry_id 		= '".$product_con_entry_id."'";

		$result_product_con_entry_product_detail 	= mysql_query($select_product_con_entry_child_product_detail);

		$count_product_con_entry 					= mysql_num_rows($result_product_con_entry_product_detail);

		$arr_product_con_entry_product_detail 	= array();

		

		while($record_product_con_entry_product_detail = mysql_fetch_array($result_product_con_entry_product_detail)) {

			$arr_product_con_entry_product_detail[] = $record_product_con_entry_product_detail;

		}

		return $arr_product_con_entry_product_detail;

	}
	function updateQuotation(){

		$product_con_entry_id                   			= trim($_POST['product_con_entry_id']);
		$product_con_entry_uniq_id                			= trim($_POST['product_con_entry_uniq_id']);
		$product_con_entry_branch_id                   		= trim($_POST['product_con_entry_branch_id']);
		$product_con_entry_date                 			= NdateDatabaseFormat($_POST['product_con_entry_date']);
		$product_con_entry_godown_id            			= trim($_POST['product_con_entry_godown_id']);
		$product_con_entry_invoice_entry_id              	= trim($_POST['product_con_entry_invoice_entry_id']);
		$product_con_entry_child_length_feet_tot           	= trim($_POST['product_con_entry_child_length_feet_tot']);
		$stock_ledger_entry_type							= 'product-con-entry';
		//Product Detail

		$product_con_entry_product_detail_id      			= $_POST['product_con_entry_product_detail_id'];
		$product_con_entry_product_detail_product_id     	= $_POST['product_con_entry_product_detail_product_id'];
		$product_con_entry_product_detail_invoice_detail_id = $_POST['product_con_entry_product_detail_invoice_detail_id'];
		$product_con_entry_product_detail_width_inches  	= $_POST['product_con_entry_product_detail_width_inches'];
		$product_con_entry_product_detail_width_mm  		= $_POST['product_con_entry_product_detail_width_mm'];
		$product_con_entry_product_detail_length_mm  		= $_POST['product_con_entry_product_detail_length_mm'];
		$product_con_entry_product_detail_length_feet  		= $_POST['product_con_entry_product_detail_length_feet'];
		$product_con_entry_product_detail_qty 				= $_POST['product_con_entry_product_detail_qty'];
		$product_con_entry_product_detail_total_qty 		= $_POST['product_con_entry_product_detail_total_qty'];
		
		$request_fields 								= ((!empty($product_con_entry_branch_id)) && (!empty($product_con_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "product-con-entry/index.php?page=edit&id=$product_con_entry_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 
															product_con_entry 
														SET 
															product_con_entry_branch_id 				= '%d',
															product_con_entry_date 						= '%s',
															product_con_entry_godown_id 				= '%d',
															product_con_entry_child_length_feet_tot		= '%f',
															product_con_entry_modified_by 				= '%d',
															product_con_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),
															product_con_entry_modified_ip				= '%s'
														WHERE               
															product_con_entry_id         				= '%d'", 
															$product_con_entry_branch_id,
															$product_con_entry_date,
															$product_con_entry_godown_id,
															$product_con_entry_child_length_feet_tot,
															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$product_con_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);
		$update_product_con_entry_product_detail = sprintf("	UPDATE 
																product_con_entry_product_details 
															SET  
																product_con_entry_product_detail_qty  					= '%f',
																product_con_entry_product_detail_width_inches  			= '%f',
																product_con_entry_product_detail_width_mm  				= '%f',
																product_con_entry_product_detail_length_mm  			= '%f',
																product_con_entry_product_detail_length_feet  			= '%f',
																product_con_entry_product_detail_total_qty  			= '%s',
																product_con_entry_product_detail_modified_by 			= '%d',
																product_con_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																product_con_entry_product_detail_modified_ip 			= '%s'
															WHERE 
																product_con_entry_product_detail_product_con_entry_id 	= '%d' AND 
																product_con_entry_product_detail_id 					= '%d'",
																$product_con_entry_product_detail_qty,
																$product_con_entry_product_detail_width_inches,
																$product_con_entry_product_detail_width_mm,
																$product_con_entry_product_detail_length_mm,
																$product_con_entry_product_detail_length_feet,
																$product_con_entry_product_detail_total_qty,
																$_SESSION[SESS.'_session_user_id'], 
																$ip, 
																$product_con_entry_id, 
																$product_con_entry_product_detail_id);	

		mysql_query($update_product_con_entry_product_detail);
		
		$product_con_entry_detail_id  						= 	$product_con_entry_product_detail_id;
		$length_inches										= 	"1";
		$width_inches										= 	"1";
		$product_detail_qty									= 	$product_con_entry_product_detail_qty;
		$stock_ledger_prd_type								= 	"product-con-detail";
		$product_con_entry_godown_id						= 	"1";
		$product_id											= 	$product_con_entry_product_detail_product_id;
		stockLedger('out',$product_con_entry_id,$product_con_entry_detail_id,$product_id,$length_inches,$width_inches,(-1*$product_detail_qty), $product_con_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_prd_type,'1');
		
		$product_con_entry_godown_id						= 	"2";
		stockLedger('out',$product_con_entry_id,$product_con_entry_detail_id,$product_id,$length_inches,$width_inches,(-1*$product_detail_qty), $product_con_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_prd_type,'1');
		
		
		$product_con_entry_child_product_detail_id     				= $_POST['product_con_entry_child_product_detail_id'];
		$product_con_entry_child_product_detail_code     			= $_POST['product_con_entry_child_product_detail_code'];
		$product_con_entry_child_product_detail_code     			= $_POST['product_con_entry_child_product_detail_code'];
		$product_con_entry_child_product_detail_name   				= $_POST['product_con_entry_child_product_detail_name'];
		$product_con_entry_child_product_detail_color_id  			= $_POST['product_con_entry_child_product_detail_color_id'];
		$product_con_entry_child_product_detail_width_inches  		= $_POST['product_con_entry_child_product_detail_width_inches'];
		$product_con_entry_child_product_detail_width_mm  			= $_POST['product_con_entry_child_product_detail_width_mm'];
		$product_con_entry_child_product_detail_length_feet  		= $_POST['product_con_entry_child_product_detail_length_feet'];
		$product_con_entry_child_product_detail_length_mm 			= $_POST['product_con_entry_child_product_detail_length_mm'];
		$product_con_entry_child_product_detail_uom_id 				= $_POST['product_con_entry_child_product_detail_uom_id'];
		$product_con_entry_child_product_detail_total 				= $_POST['product_con_entry_child_product_detail_total'];
		$product_con_entry_child_product_detail_con_width_inches  	= $_POST['product_con_entry_child_product_detail_con_width_inches'];
		$product_con_entry_child_product_detail_con_width_mm  		= $_POST['product_con_entry_child_product_detail_con_width_mm'];
		$product_con_entry_child_product_detail_con_length_feet  	= $_POST['product_con_entry_child_product_detail_con_length_feet'];
		$product_con_entry_child_product_detail_con_length_mm 		= $_POST['product_con_entry_child_product_detail_con_length_mm'];
		$product_con_entry_child_product_detail_con_tone 			= $_POST['product_con_entry_child_product_detail_con_tone'];

		for($i=0;$i<count($product_con_entry_child_product_detail_code);$i++){
				$update_product_con_entry_child_product_detail = sprintf("UPDATE 
																				product_con_entry_child_product_details 
																			SET  
																				product_con_entry_child_product_detail_total  					= '%f',
																				product_con_entry_child_product_detail_width_inches  			= '%f',
																				product_con_entry_child_product_detail_width_mm  				= '%f',
																				product_con_entry_child_product_detail_length_mm  				= '%f',
																				product_con_entry_child_product_detail_length_feet  			= '%f',
																				product_con_entry_child_product_detail_con_width_inches  		= '%f',
																				product_con_entry_child_product_detail_con_width_mm  			= '%f',
																				product_con_entry_child_product_detail_con_length_feet  		= '%f',
																				product_con_entry_child_product_detail_con_length_mm  			= '%f',
																				product_con_entry_child_product_detail_con_tone  				= '%f',
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
																				$_SESSION[SESS.'_session_user_id'], 
																				$ip, 
																				$product_con_entry_id, 
																				$product_con_entry_child_product_detail_id[$i]);
				mysql_query($update_product_con_entry_child_product_detail);
				$product_con_entry_detail_id						= $product_con_entry_child_product_detail_id[$i];
				$length_inches										= 	$product_con_entry_child_product_detail_length_feet[$i];
				$width_inches										= 	$product_con_entry_child_product_detail_width_inches[$i];
				$product_detail_qty									= 	"1";
				$product_con_entry_godown_id						= "1";
				stockLedger('in',$product_con_entry_id,$product_con_entry_detail_id,$product_con_entry_detail_id,$length_inches,$width_inches,$product_detail_qty, $product_con_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_entry_type,'2');
				$product_con_entry_godown_id						= "2";
				stockLedger('in',$product_con_entry_id,$product_con_entry_detail_id,$product_con_entry_detail_id,$length_inches,$width_inches,$product_detail_qty, $product_con_entry_branch_id, $product_con_entry_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_entry_type,'2');
					
		}
		pageRedirection("product-con-entry/index.php?page=edit&id=$product_con_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['product_con_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$product_con_entry_uniq_id = $_GET['product_con_entry_uniq_id'];

			mysql_query("UPDATE product_con_entry_product_details SET product_con_entry_product_detail_deleted_status = 1 

						WHERE product_con_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$product_con_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){
		deleteUniqRecords('product_con_entry', 'product_con_entry_deleted_by', 'product_con_entry_deleted_on' , 'product_con_entry_deleted_ip','product_con_entry_deleted_status', 'product_con_entry_id', 'product_con_entry_uniq_id', '1');

		deleteMultiRecords('product_con_entry_product_details', 'product_con_entry_product_detail_deleted_by', 'product_con_entry_product_detail_deleted_on', 'product_con_entry_product_detail_deleted_ip', 'product_con_entry_product_detail_deleted_status', 'product_con_entry_product_detail_product_con_entry_id', 'product_con_entry','product_con_entry_id','product_con_entry_uniq_id', '1');  

		deleteMultiRecords('product_con_entry_child_product_details', 'product_con_entry_child_product_detail_deleted_by', 'product_con_entry_child_product_detail_deleted_on', 'product_con_entry_child_product_detail_deleted_ip', 'product_con_entry_child_product_detail_deleted_status', 'product_con_entry_child_product_detail_product_con_entry_id', 'product_con_entry','product_con_entry_id','product_con_entry_uniq_id', '1');  

		pageRedirection("product-con-entry/index.php?msg=7");				

	}

?>