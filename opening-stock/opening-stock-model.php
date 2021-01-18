<?php

    // Add the new OpeningStock
	function insertOpeningStock(){
		$opening_stock_branch_id                   	= trim($_POST['opening_stock_branch_id']);
		$opening_stock_date                   		= NdateDatabaseFormat($_POST['opening_stock_date']);
		$opening_stock_godown_id          			= trim($_POST['opening_stock_godown_id']);
		
		//Multi Product
		$opening_stock_product_detail_product_id   	= $_POST['opening_stock_product_detail_product_id'];
		$opening_stock_product_detail_uom2 		    = $_POST['opening_stock_product_detail_uom2'];				
				
		$opening_stock_product_detail_qty1 			= $_POST['opening_stock_product_detail_qty1'];
		$opening_stock_product_detail_qty2 			= $_POST['opening_stock_product_detail_qty2'];

		
		$request_fields 							= ((!empty($opening_stock_branch_id)) && (!empty($opening_stock_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "opening-stock/index.php?page=add");
		
		$opening_stock_uniq_id						= generateUniqId();
		$ip											= getRealIpAddr();
		
		$select_stock_no 						= "SELECT 
																MAX(opening_stock_no) AS maxval 
														   FROM 
														   		opening_stock 
								  						   WHERE 
														   		opening_stock_deleted_status 	= 0 												AND
								   								opening_stock_branch_id 		= '".$opening_stock_branch_id."'					AND
								   								opening_stock_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND
								   								opening_stock_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";

		$result_stock_no 						= mysql_query($select_stock_no);
		$record_stock_no 						= mysql_fetch_array($result_stock_no);	
		$maxval 									= $record_stock_no['maxval']; 
		if($maxval > 0) {
			$opening_stock_no 	= substr(('00000'.++$maxval),-5);
		} else {
			$opening_stock_no 	= substr(('00000'.++$maxval),-5);
		}
		
	
		$insert_opening_stock 	= sprintf("INSERT INTO opening_stock (opening_stock_uniq_id, 
																		opening_stock_date,
																		opening_stock_godown_id, 
																		opening_stock_added_by,
																		opening_stock_added_on,
																		opening_stock_added_ip,
																		opening_stock_company_id,
																		opening_stock_financial_year,
																		opening_stock_no,opening_stock_branch_id) 
																	VALUES 	 ('%s', '%s', 
																			  '%d', '%d',
																			  UNIX_TIMESTAMP(NOW()),'%s',
																			  '%d', '%d',
																			  '%s', '%d')", 
																		$opening_stock_uniq_id, 
																		$opening_stock_date, 
																		$opening_stock_godown_id, 
																		$_SESSION[SESS.'_session_user_id'],
																		$ip,
																		$_SESSION[SESS.'_session_company_id'],
																		$_SESSION[SESS.'_session_financial_year'],
																		$opening_stock_no,$opening_stock_branch_id);  

		mysql_query($insert_opening_stock);
		$opening_stock_id 						= mysql_insert_id(); 

		// purchase order pproduct details
		for($po_index = 0; $po_index < count($opening_stock_product_detail_product_id); $po_index++) {
			$detail_request_fields 						= 	((!empty($opening_stock_product_detail_product_id[$po_index])) && 
									 						(!empty($opening_stock_product_detail_qty1[$po_index])));
			if($detail_request_fields) {
				$opening_stock_product_detail_uniq_id  = generateUniqId();
				$insert_opening_stock_product_detail 	= sprintf("INSERT INTO opening_stock_product_details (opening_stock_product_detail_uniq_id,  
																		opening_stock_product_detail_qty1, 
																		opening_stock_product_detail_qty2, 	
																		opening_stock_product_detail_uom2,
																		opening_stock_product_detail_product_id, 
																 		opening_stock_product_detail_opening_stock_id, 
																		opening_stock_product_detail_added_by,
																		opening_stock_product_detail_added_on, 
																		opening_stock_product_detail_added_ip,
																		opening_stock_product_detail_company_id,
																		opening_stock_product_detail_financial_year,	
																		opening_stock_product_detail_branch_id) 
																	VALUES 
																		('%s', '%f', '%f', '%d', '%d', '%d', '%d', UNIX_TIMESTAMP(NOW()), '%s', '%d', '%d', '%d')", 
																		$opening_stock_product_detail_uniq_id, 
																		$opening_stock_product_detail_qty1[$po_index],
																		$opening_stock_product_detail_qty2[$po_index],
																		$opening_stock_product_detail_uom2[$po_index],																		
																		$opening_stock_product_detail_product_id[$po_index],
																		$opening_stock_id, $_SESSION[SESS.'_session_user_id'], $ip,
																		$_SESSION[SESS.'_session_company_id'],																			
																		$_SESSION[SESS.'_session_financial_year'],
																		$opening_stock_branch_id);  

				mysql_query($insert_opening_stock_product_detail);
				$opening_stock_detail_id 						= mysql_insert_id();
				$width_inches									=  $opening_stock_product_detail_qty1[$po_index];
				$length_inches									=  $opening_stock_product_detail_qty2[$po_index];
				$product_detail_qty								= '1';
				$stock_ledger_entry_type                        = "open";
				stockLedger('in',$opening_stock_id,$opening_stock_detail_id,$opening_stock_detail_id,$length_inches,$width_inches,$product_detail_qty, $opening_stock_branch_id, $opening_stock_godown_id, $product_con_entry_godown_id, $product_con_entry_date, $product_con_entry_no,$stock_ledger_entry_type,'1');
				
			}
		
		}
		
		
		pageRedirection("opening-stock/index.php?page=add&msg=1");
	}
	
    // Lis all the OpeningStock	
	function listOpeningStock(){
		$select_opening_stock		=	"SELECT 
											opening_stock_id,
											opening_stock_uniq_id,
											opening_stock_no,
											opening_stock_date,
											godown_name
																					
										 FROM 
											opening_stock
											
										 LEFT JOIN
										 	godowns 
										 ON
											godown_id				= opening_stock_godown_id

										 WHERE 
											opening_stock_deleted_status 	= 	0 
										 ORDER BY 
											opening_stock_no ASC";
		$result_opening_stock		= mysql_query($select_opening_stock);
		// Filling up the array
		$opening_stock_data 		= array();
		while ($record_opening_stock = mysql_fetch_array($result_opening_stock))
		{
		 $opening_stock_data[] 	= $record_opening_stock;
		}
		return $opening_stock_data;
	}
	
    // Edit the OpeningStock	
	function editOpeningStock(){
		$opening_stock_id 			= getId('opening_stock', 'opening_stock_id', 'opening_stock_uniq_id', dataValidation($_GET['id'])); 
		$select_opening_stock		=	"SELECT 
											opening_stock_uniq_id, 
											opening_stock_date,
											opening_stock_no,
											opening_stock_branch_id,
											opening_stock_id,
											opening_stock_godown_id
											
										 FROM 
											opening_stock 
										 WHERE 
											opening_stock_deleted_status 	=  0 	AND 
											opening_stock_id				= '".$opening_stock_id."'
										 ORDER BY 
											opening_stock_no ASC";
		$result_opening_stock 		= mysql_query($select_opening_stock);
		$record_opening_stock 		= mysql_fetch_array($result_opening_stock);
		return $record_opening_stock;
	}
	
    // Edit the OpeningStock	- Product Details
	function editOpeningStockProductDetail()
	{
		$opening_stock_id 	= getId('opening_stock', 'opening_stock_id', 'opening_stock_uniq_id', dataValidation($_GET['id'])); 
		$select_opening_stock_product_detail 	= "	SELECT 
														opening_stock_product_detail_id,
														opening_stock_product_detail_product_id,
														opening_stock_product_detail_qty1,
														opening_stock_product_detail_qty2,
														product_name,
														masterUOM.product_uom_name as UOM1,
														detailUOM.product_uom_name as UOM2,														
														product_code
													FROM 
														opening_stock_product_details 
														
													LEFT JOIN 
														products 
													ON 
														product_id 		= opening_stock_product_detail_product_id
														
													LEFT JOIN 
														product_uoms as masterUOM
													ON 
														masterUOM.product_uom_id 	= product_uom_one_id
														
													LEFT JOIN 
														product_uoms as detailUOM
													ON  
														detailUOM.product_uom_id 	= opening_stock_product_detail_uom2

													WHERE 
														opening_stock_product_detail_deleted_status		 	= 0 						AND 
														opening_stock_product_detail_opening_stock_id 		= '".$opening_stock_id."'";
														
		$result_opening_stock_product_detail 	= mysql_query($select_opening_stock_product_detail);
		$count_opening_stock 					= mysql_num_rows($result_opening_stock_product_detail);
		$arr_opening_stock_product_detail 	= array();
		
		while($record_opening_stock_product_detail = mysql_fetch_array($result_opening_stock_product_detail)) {
			$arr_opening_stock_product_detail[] = $record_opening_stock_product_detail;
		}
		return $arr_opening_stock_product_detail;
	}
	
    // Update the OpeningStock		
	function updateOpeningStock(){
		$opening_stock_id                   		= trim($_POST['opening_stock_id']);
		$opening_stock_uniq_id                		= trim($_POST['opening_stock_uniq_id']);
		$opening_stock_branch_id                    = trim($_POST['opening_stock_branch_id']);
		$opening_stock_date                   		= NdateDatabaseFormat($_POST['opening_stock_date']);
		$opening_stock_godown_id          			= trim($_POST['opening_stock_godown_id']);

		
		//Multi Product
		$opening_stock_product_detail_id      		= $_POST['opening_stock_product_detail_id'];
		$opening_stock_product_detail_product_id   = $_POST['opening_stock_product_detail_product_id'];
		$opening_stock_product_detail_qty1 			= $_POST['opening_stock_product_detail_qty1'];
		$opening_stock_product_detail_qty2 			= $_POST['opening_stock_product_detail_qty2'];		

		$request_fields 	= ((!empty($opening_stock_branch_id)) && (!empty($opening_stock_date)));		
		checkRequestFields($request_fields, PROJECT_PATH, "opening-stock/index.php?page=edit&id=$opening_stock_uniq_id&msg=5");
		$ip									= getRealIpAddr();
		$update_opening_stock					= sprintf("	UPDATE 
															opening_stock 
														SET 
															opening_stock_branch_id 					= '%d',
															opening_stock_godown_id						= '%d',															
															opening_stock_date 							= '%s',
															opening_stock_modified_by 					= '%d',
															opening_stock_modified_on 					= UNIX_TIMESTAMP(NOW()),
															opening_stock_modified_ip					= '%s'
															
														WHERE               
															opening_stock_id         			= '%d'", 
															$opening_stock_branch_id,
															$opening_stock_godown_id,
															$opening_stock_date,
															$_SESSION[SESS.'_session_user_id'], 
															$ip,															
															$opening_stock_id); 
		mysql_query($update_opening_stock);
		for($po_index = 0; $po_index < count($opening_stock_product_detail_product_id); $po_index++) {
			$detail_request_fields = ((!empty($opening_stock_product_detail_product_id[$po_index])) && (!empty($opening_stock_product_detail_qty1[$po_index])) );
			if($detail_request_fields) {
				if(isset($opening_stock_product_detail_id[$po_index]) && (!empty($opening_stock_product_detail_id[$po_index]))) {
					$update_opening_stock_product_detail = sprintf("UPDATE 
																			opening_stock_product_details 
																		SET  
																			opening_stock_product_detail_qty1  				= '%f', 
																			opening_stock_product_detail_qty2  				= '%f', 
																			opening_stock_product_detail_uom_id				= '%d',																																					
																			opening_stock_product_detail_product_id 		= '%d',
																			opening_stock_product_detail_modified_by 		= '%d',
																			opening_stock_product_detail_modified_on 		= UNIX_TIMESTAMP(NOW()),
																			opening_stock_product_detail_modified_ip 		= '%s',
																			opening_stock_product_detail_company_id		= '%d',
																			opening_stock_product_detail_financial_year	= '%d',
																			opening_stock_product_detail_branch_id		= '%d'																				
																			
																		WHERE 
																			opening_stock_product_detail_opening_stock_id 	= '%d' AND 
																			opening_stock_product_detail_id 					= '%d'",
																			$opening_stock_product_detail_qty1[$po_index],
																			$opening_stock_product_detail_qty2[$po_index],	
																			$opening_stock_product_detail_uom_id[$po_index],																			
																			$opening_stock_product_detail_product_id[$po_index],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip,
																			$_SESSION[SESS.'_session_company_id'],																			
																			$_SESSION[SESS.'_session_financial_year'],
																			$opening_stock_branch_id,																			 
																			$opening_stock_id, 
																			$opening_stock_product_detail_id[$po_index]);	
					mysql_query($update_opening_stock_product_detail);
					
				} else {
					$opening_stock_product_detail_uniq_id 		= generateUniqId();
					$insert_opening_stock_product_detail 		= sprintf("INSERT INTO opening_stock_product_details (opening_stock_product_detail_uniq_id,  
																		opening_stock_product_detail_qty1, 
																		opening_stock_product_detail_qty2, 
																		opening_stock_product_detail_uom_id,
																		opening_stock_product_detail_product_id, 
																		opening_stock_product_detail_opening_stock_id, 
																		opening_stock_product_detail_added_by,
																		opening_stock_product_detail_added_on, 
																		opening_stock_product_detail_added_ip,
																		opening_stock_product_detail_company_id,
																		opening_stock_product_detail_financial_year,
																		opening_stock_product_detail_branch_id) 
																	VALUES 
																		('%s', '%f', '%f', '%d', '%d', '%d', '%d', UNIX_TIMESTAMP(NOW()), '%s', '%d', '%d', '%d')", 
																		$opening_stock_product_detail_uniq_id, 
																		$opening_stock_product_detail_qty1[$po_index],
																		$opening_stock_product_detail_qty2[$po_index],	
																		$opening_stock_product_detail_uom_id[$po_index],																			
																		$opening_stock_product_detail_product_id[$po_index],
																		$opening_stock_id, 
																		$_SESSION[SESS.'_session_user_id'], 
																		$ip,
																		$_SESSION[SESS.'_session_company_id'],																			
																		$_SESSION[SESS.'_session_financial_year'],
																		$opening_stock_branch_id);  
					mysql_query($insert_opening_stock_product_detail);
					
				}
			}
		}

		pageRedirection("opening-stock/index.php?page=edit&id=$opening_stock_uniq_id&msg=2");			
	}

    // Delete the OpeningStock			
	function deleteOpeningStock(){
		deleteUniqRecords('opening_stock', 'opening_stock_deleted_by', 'opening_stock_deleted_on' , 'opening_stock_deleted_ip','opening_stock_deleted_status', 'opening_stock_id', 'opening_stock_uniq_id', '1');
		
		deleteMultiRecords('opening_stock_product_details', 'opening_stock_product_detail_deleted_by', 'opening_stock_product_detail_deleted_on', 'opening_stock_product_detail_deleted_ip', 'opening_stock_product_detail_deleted_status', 'opening_stock_product_detail_opening_stock_id', 'opening_stock','opening_stock_id','opening_stock_uniq_id', '1');  
		
		pageRedirection("opening-stock/index.php?msg=3");				
	}
   	
	
?>