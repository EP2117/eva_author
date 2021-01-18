<?php
	function insertSuspens(){ //echo 'ggdchf';exit;
		$stock_adjustment_branch_id                   				= trim($_POST['stock_adjustment_branch_id']);
		$stock_adjustment_date                 						= NdateDatabaseFormat($_POST['stock_adjustment_date']);
		$stock_adjustment_godown_id      							= trim($_POST['stock_adjustment_godown_id']);
		$stock_adjustment_brand_id      							= trim($_POST['stock_adjustment_brand_id']);
		
		$stock_adjustment_product_detail_product_id     			= $_POST['stock_adjustment_product_detail_product_id'];
		
		$stock_adjustment_product_detail_add_qty 					= $_POST['stock_adjustment_product_detail_add_qty'];
		$stock_adjustment_product_detail_less_qty 					= $_POST['stock_adjustment_product_detail_less_qty'];
		$stock_adjustment_product_detail_add_feet 					= $_POST['stock_adjustment_product_detail_add_feet'];
		$stock_adjustment_product_detail_add_mm 					= $_POST['stock_adjustment_product_detail_add_mm'];
		$stock_adjustment_product_detail_add_tone 					= $_POST['stock_adjustment_product_detail_add_tone'];
		$stock_adjustment_product_detail_add_kg 					= $_POST['stock_adjustment_product_detail_add_kg'];
		$stock_adjustment_product_detail_less_feet 					= $_POST['stock_adjustment_product_detail_less_feet'];
		$stock_adjustment_product_detail_less_mm 					= $_POST['stock_adjustment_product_detail_less_mm'];
		$stock_adjustment_product_detail_less_tone 					= $_POST['stock_adjustment_product_detail_less_tone'];
		$stock_adjustment_product_detail_less_kg 					= $_POST['stock_adjustment_product_detail_less_kg'];//print_r($_POST);exit;
		$stock_adjustment_type_id 					                = $_POST['stock_adjustment_type_id'];
		$stock_adjustment_product_detail_uniq_id  					                = $_POST['stock_adjustment_product_detail_uniq_id '];
		$request_fields 											= ((!empty($stock_adjustment_branch_id)) && (!empty($stock_adjustment_date)));
	    checkRequestFields($request_fields, PROJECT_PATH, "stock-adjustment/index.php?page=add&msg=5");
		$stock_adjustment_uniq_id									= generateUniqId();
		$ip															= getRealIpAddr();
		
		$select_stock_adjustment_no									= "SELECT 
																			MAX(stock_adjustment_no) AS maxval 
																	   FROM 
																			stock_adjustment 
																	   WHERE 
																			stock_adjustment_deleted_status 	= 0 												AND
																			stock_adjustment_branch_id 		= '".$stock_adjustment_branch_id."'					AND
																			stock_adjustment_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND
																			stock_adjustment_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";

		$result_stock_adjustment_no 								= mysql_query($select_stock_adjustment_no);
		$record_stock_adjustment_no 								= mysql_fetch_array($result_stock_adjustment_no);	
		$maxval 													= $record_stock_adjustment_no['maxval']; 
		if($maxval > 0) {
			$stock_adjustment_no 									= substr(('00000'.++$maxval),-5);
		} else {
			$stock_adjustment_no 									= substr(('00000'.++$maxval),-5);
		}
		//echo 'bchdbgj';
		//
		$insert_stock_adjustment 									= sprintf("INSERT INTO stock_adjustment  (stock_adjustment_uniq_id, stock_adjustment_date,
																									   stock_adjustment_no,stock_adjustment_branch_id,
																									  stock_adjustment_added_by,
																									   stock_adjustment_added_on,stock_adjustment_added_ip,
																									   stock_adjustment_company_id,stock_adjustment_financial_year,
																									   stock_adjustment_type_id,stock_adjustment_godown_id,
																									   stock_adjustment_brand_id) 
																							VALUES 	 ('%s', '%s', 
																									  '%s', '%d',
																									   '%d',
																									   UNIX_TIMESTAMP(NOW()),
																									  '%s', '%d', '%d','%s','%s','%s')", 
																									   $stock_adjustment_uniq_id, $stock_adjustment_date,
																									   $stock_adjustment_no,$stock_adjustment_branch_id,
																									   $_SESSION[SESS.'_session_user_id'],
																									   $ip, $_SESSION[SESS.'_session_company_id'],
																									   $_SESSION[SESS.'_session_financial_year'],
																									   $stock_adjustment_type_id,$stock_adjustment_godown_id,
																									   $stock_adjustment_brand_id);  
		
		//echo $insert_stock_adjustment;
		mysql_query($insert_stock_adjustment);
		// purchase order pproduct details 
		$stock_adjustment_id 						= mysql_insert_id();
		
		for($po_index = 0; $po_index < count($stock_adjustment_product_detail_product_id); $po_index++) { 
	//	echo $stock_adjustment_product_detail_product_id[$po_index]; exit;
			$detail_request_fields 							= 	((!empty($stock_adjustment_product_detail_product_id[$po_index])));
			if($detail_request_fields) {
				$damage_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_stock_adjustment_product_detail 		= sprintf("INSERT INTO stock_adjustment_product_details (stock_adjustment_product_detail_uniq_id,  
																										stock_adjustment_product_detail_product_id,
																										stock_adjustment_product_detail_stock_adjustment_id,
																										 stock_adjustment_product_detail_added_by,
																										stock_adjustment_product_detail_added_on,
																									   stock_adjustment_product_detail_added_ip, 
																									   stock_adjustment_product_detail_add_feet,
																									   stock_adjustment_product_detail_add_mm,
																									   stock_adjustment_product_detail_add_tone,
																									   stock_adjustment_product_detail_add_kg,
																									   stock_adjustment_product_detail_less_feet,
																									   stock_adjustment_product_detail_less_mm,
																									   stock_adjustment_product_detail_less_tone,
																									   stock_adjustment_product_detail_less_kg,
																									   stock_adjustment_product_detail_add_qty,
																									   stock_adjustment_product_detail_less_qty)
																									    VALUES 
																										('%s','%s','%d', '%d', UNIX_TIMESTAMP(NOW()),
																										 '%s','%d', '%d',
																									  '%d','%d','%d', '%d',
																									  '%d','%d','%d','%d')", 
																$stock_adjustment_product_detail_uniq_id,$stock_adjustment_product_detail_product_id[$po_index],
																$stock_adjustment_id, $_SESSION[SESS.'_session_user_id'],$ip,
																									   $stock_adjustment_product_detail_add_feet[$po_index],
																									   $stock_adjustment_product_detail_add_mm[$po_index],
																									   $stock_adjustment_product_detail_add_tone[$po_index],
																									   $stock_adjustment_product_detail_add_kg[$po_index],
																									   $stock_adjustment_product_detail_less_feet[$po_index],
																									   $stock_adjustment_product_detail_less_mm[$po_index],
																									   $stock_adjustment_product_detail_less_tone[$po_index],
																									   $stock_adjustment_product_detail_less_kg[$po_index],
																									   $stock_adjustment_product_detail_add_qty[$po_index],
																									   $stock_adjustment_product_detail_less_qty[$po_index]);
										//echo $insert_stock_adjustment_product_detail;exit;
				mysql_query($insert_stock_adjustment_product_detail);
				$entry_detail_id	= mysql_insert_id();
				if($stock_adjustment_product_detail_add_tone[$po_index]>0){
					$stock_ledger_entry_type		= "stock-adjustment-add";//print_r($_POST);exit;
					stockLedger("in",$stock_adjustment_id,$entry_detail_id,$stock_adjustment_product_detail_product_id[$po_index],$stock_adjustment_date,$stock_adjustment_godown_id,'',$stock_adjustment_product_detail_add_qty[$po_index],$stock_adjustment_product_detail_add_qty[$po_index],$stock_adjustment_product_detail_add_feet[$po_index],$stock_adjustment_product_detail_add_mm[$po_index],$stock_adjustment_product_detail_add_tone[$po_index],$stock_adjustment_product_detail_add_kg[$po_index],'',$stock_adjustment_no,$stock_ledger_entry_type,'',$stock_adjustment_branch_id,$stock_adjustment_batch_id);
				}
				if($stock_adjustment_product_detail_less_tone[$po_index]>0){
					$stock_ledger_entry_type		= "stock-adjustment-less";
					stockLedger("out",$stock_adjustment_id,$entry_detail_id,$stock_adjustment_product_detail_product_id[$po_index],$stock_adjustment_date,$stock_adjustment_godown_id,'',$stock_adjustment_product_detail_less_qty[$po_index],$stock_adjustment_product_detail_less_qty[$po_index],$stock_adjustment_product_detail_less_feet[$po_index],$stock_adjustment_product_detail_less_mm[$po_index],$stock_adjustment_product_detail_less_tone[$po_index],$stock_adjustment_product_detail_less_kg[$po_index],'',$stock_adjustment_no,$stock_ledger_entry_type,'',$stock_adjustment_branch_id,$stock_adjustment_batch_id);
				}
			}
		
		}
		pageRedirection("stock-adjustment/index.php?page=add&msg=1");
	}
	function listSalesreturn(){
	$where		= '';
		if(isset($_REQUEST['fromdate']) && (!empty($_REQUEST['fromdate'])) && isset($_REQUEST['todate']) && 
		(!empty($_REQUEST['todate']))) {
	$where .= " AND stock_adjustment_date BETWEEN '".NdateDatabaseFormat($_REQUEST['fromdate'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['todate'])."'";	
					   }
		 if(!empty($_REQUEST['brandid'])){
				$where .= " AND product_brand_id='".$_REQUEST['brandid']."'";
		 	}
		$select_stock_adjustment		=	"SELECT 
												stock_adjustment_id,
												stock_adjustment_uniq_id,
												stock_adjustment_no,
												stock_adjustment_date,
												product_code,
												stock_adjustment_type_id
											 FROM 
												stock_adjustment_product_details
												
												LEFT JOIN 
													stock_adjustment 
												ON 
													stock_adjustment_id	= stock_adjustment_product_detail_stock_adjustment_id	
												
												LEFT JOIN 
													products 
												ON 
													product_id	= stock_adjustment_product_detail_product_id	
						
										  LEFT JOIN 
												brands 
											ON 
												product_brand_id = brand_id
											 WHERE 
												stock_adjustment_deleted_status 	= 	0 $where 
											 ORDER BY 
												stock_adjustment_no ASC";
												
												//echo $select_stock_adjustment;exit;
		$result_stock_adjustment		= mysql_query($select_stock_adjustment);
		// Filling up the array
		$stock_adjustment_data 		= array();
		while ($record_stock_adjustment = mysql_fetch_array($result_stock_adjustment))
		{
		 $stock_adjustment_data[] 	= $record_stock_adjustment;
		}
		return $stock_adjustment_data;
	}
	function editQuotation(){
	
		$stock_adjustment_id 			= getId('stock_adjustment', 'stock_adjustment_id', 'stock_adjustment_uniq_id', dataValidation($_GET['id'])); 
		$select_stock_adjustment		=	"SELECT 
												stock_adjustment_uniq_id,stock_adjustment_id, stock_adjustment_date,
												stock_adjustment_no,stock_adjustment_branch_id,
												stock_adjustment_godown_id,product_code,
												stock_adjustment_type_id,
												product_code,
												product_name,
												product_uom_name,
												product_colour_name,
												product_thick_ness,
												product_id,
												brand_name,
												product_brand_id,
												product_uom_id,
												stock_adjustment_brand_id
											
											 FROM 
												stock_adjustment_product_details
												
												LEFT JOIN 
													stock_adjustment 
												ON 
													stock_adjustment_id	= stock_adjustment_product_detail_stock_adjustment_id	
												
												LEFT JOIN 
													products 
												ON 
													product_id	= stock_adjustment_product_detail_product_id	
													LEFT JOIN 
													product_uoms 
												ON 
													product_uom_id 						= product_product_uom_id
												LEFT JOIN 
													product_colours 
												ON 
													product_colour_id 					= product_product_colour_id
										     LEFT JOIN 
												brands 
											  ON 
												stock_adjustment_brand_id = brand_id
											 WHERE 
												stock_adjustment_deleted_status 	= 	0 
												AND stock_adjustment_id ='".$stock_adjustment_id."'
											 ORDER BY 
												stock_adjustment_no ASC";
												//echo $select_stock_adjustment;
		$result_stock_adjustment 		= mysql_query($select_stock_adjustment);
		$record_stock_adjustment 		= mysql_fetch_array($result_stock_adjustment);
		return $record_stock_adjustment;
	}
	function editQuotationProductDetail()
	{
		$stock_adjustment_id 	= getId('stock_adjustment', 'stock_adjustment_id', 'stock_adjustment_uniq_id', dataValidation($_GET['id'])); 
		$select_stock_adjustment_product_detail 	= "	SELECT 
														stock_adjustment_product_detail_id,
														stock_adjustment_product_detail_product_id,
														stock_adjustment_product_detail_add_feet,
													    stock_adjustment_product_detail_add_mm,
													    stock_adjustment_product_detail_add_tone,
													    stock_adjustment_product_detail_add_kg,
													    stock_adjustment_product_detail_less_feet,
													    stock_adjustment_product_detail_less_mm,
													    stock_adjustment_product_detail_less_tone,
													    stock_adjustment_product_detail_less_kg,
													    stock_adjustment_product_detail_remarks,
														product_code,
														product_name,
														product_uom_name,
														product_colour_name,
														product_thick_ness,
														product_id,
														brand_name,
														product_brand_id,
														product_uom_id
													FROM 
														stock_adjustment_product_details
													 LEFT JOIN 
														stock_adjustment 
													ON 
														stock_adjustment_id 			= stock_adjustment_product_detail_stock_adjustment_id
														
													LEFT JOIN 
														products 
													ON 
														product_id 								= stock_adjustment_product_detail_product_id
													
													LEFT JOIN 
															product_uoms 
														ON 
															product_uom_id 						= product_product_uom_id
														LEFT JOIN 
															product_colours 
														ON 
															product_colour_id 					= product_product_colour_id
										     LEFT JOIN 
												brands 
											  ON 
												product_brand_id = brand_id
													
													WHERE 
														stock_adjustment_product_detail_deleted_status		 	= 0 							AND 
														stock_adjustment_product_detail_stock_adjustment_id 		= '".$stock_adjustment_id."'";
														
														//echo $select_stock_adjustment_product_detail ;exit;
		$result_stock_adjustment_product_detail 	= mysql_query($select_stock_adjustment_product_detail);
		$count_stock_adjustment 					= mysql_num_rows($result_stock_adjustment_product_detail);
		$arr_stock_adjustment_product_detail 	= array();
		
		while($record_stock_adjustment_product_detail = mysql_fetch_array($result_stock_adjustment_product_detail)) {
			$arr_stock_adjustment_product_detail[] = $record_stock_adjustment_product_detail;
		}
		return $arr_stock_adjustment_product_detail;
	}
	function updateQuotation(){ 
		$stock_adjustment_branch_id                   				= trim($_POST['stock_adjustment_branch_id']);
		$stock_adjustment_date                 						= NdateDatabaseFormat($_POST['stock_adjustment_date']);
		$stock_adjustment_godown_id      							= trim($_POST['stock_adjustment_godown_id']);
		$stock_adjustment_brand_id      							= trim($_POST['stock_adjustment_brand_id']);
		//$stock_adjustment_damage_entry_id     						= trim($_POST['stock_adjustment_damage_entry_id']);
		//$stock_adjustment_batch_id      							= trim($_POST['stock_adjustment_batch_id']);
		//Product Detail
		$stock_adjustment_product_detail_product_id     			= $_POST['stock_adjustment_product_detail_product_id'];
		//$stock_adjustment_product_detail_damage_entry_detail_id  	= $_POST['stock_adjustment_product_detail_damage_entry_detail_id'];
		$stock_adjustment_product_detail_add_qty 					= $_POST['stock_adjustment_product_detail_add_qty'];
		$stock_adjustment_product_detail_less_qty 					= $_POST['stock_adjustment_product_detail_less_qty'];
		
		$stock_adjustment_product_detail_add_feet 					= $_POST['stock_adjustment_product_detail_add_feet'];
		$stock_adjustment_product_detail_add_mm 					= $_POST['stock_adjustment_product_detail_add_mm'];
		$stock_adjustment_product_detail_add_tone 					= $_POST['stock_adjustment_product_detail_add_tone'];
		$stock_adjustment_product_detail_add_kg 					= $_POST['stock_adjustment_product_detail_add_kg'];
		$stock_adjustment_product_detail_less_feet 					= $_POST['stock_adjustment_product_detail_less_feet'];
		$stock_adjustment_product_detail_less_mm 					= $_POST['stock_adjustment_product_detail_less_mm'];
		$stock_adjustment_product_detail_less_tone 					= $_POST['stock_adjustment_product_detail_less_tone'];
		$stock_adjustment_product_detail_less_kg 					= $_POST['stock_adjustment_product_detail_less_kg'];
		$stock_adjustment_uniq_id									=$_POST['stock_adjustment_uniq_id'];
		//$stock_adjustment_product_detail_remarks 					= $_POST['stock_adjustment_product_detail_remarks'];
		$stock_adjustment_type_id 					                = $_POST['stock_adjustment_type_id'];
		$stock_adjustment_id 					                = $_POST['stock_adjustment_id'];
		$request_fields 						= ((!empty($stock_adjustment_branch_id)) && (!empty($stock_adjustment_date)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "stock-adjustment/index.php?page=edit&id=$stock_adjustment_uniq_id");
		$ip												= getRealIpAddr();//print_r($_POST);
		$update_customer 					= sprintf("	UPDATE 
															stock_adjustment 
														SET 
															stock_adjustment_branch_id 				= '%d',
															stock_adjustment_godown_id 				= '%s',
															stock_adjustment_brand_id 				= '%s',
															stock_adjustment_date 						= '%s',
															stock_adjustment_modified_by 				= '%d',
															stock_adjustment_modified_on 				= UNIX_TIMESTAMP(NOW()),
															stock_adjustment_modified_ip				= '%s',
															stock_adjustment_type_id					='%s'
														WHERE               
															stock_adjustment_id         				= '%d'", 
															$stock_adjustment_branch_id,
															$stock_adjustment_godown_id,
															$stock_adjustment_brand_id,
															$stock_adjustment_date,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, $stock_adjustment_type_id,
															$stock_adjustment_id); 
		echo $update_customer;// exit;
		mysql_query($update_customer);
		for($po_index = 0; $po_index < count($stock_adjustment_product_detail_product_id); $po_index++) {
			$detail_request_fields = ((!empty($stock_adjustment_product_detail_product_id[$po_index])));
			if($detail_request_fields) {
				if(isset($stock_adjustment_product_detail_id[$po_index]) && (!empty($stock_adjustment_product_detail_id[$po_index]))) {
					$update_stock_adjustment_product_detail = sprintf("	UPDATE 
																			stock_adjustment_product_details 
																		SET  
																		stock_adjustment_product_detail_add_feet	= '%s',
																	   stock_adjustment_product_detail_add_mm		= '%s',
																	   stock_adjustment_product_detail_add_tone		= '%s',
																	   stock_adjustment_product_detail_add_kg		= '%s',
																	   stock_adjustment_product_detail_less_feet	= '%s',
																	   stock_adjustment_product_detail_less_mm		= '%s',
																	   stock_adjustment_product_detail_less_tone	= '%s',
																	   stock_adjustment_product_detail_less_kg		= '%s',
																		stock_adjustment_product_detail_modified_by 			= '%d',
																		stock_adjustment_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																		stock_adjustment_product_detail_modified_ip 			= '%s',
																		 stock_adjustment_product_detail_add_qty		= '%s',
																		  stock_adjustment_product_detail_less_qty		= '%s'
																		WHERE 
																			stock_adjustment_product_detail_stock_adjustment_id 	= '%d' AND 
																			stock_adjustment_product_detail_id 					= '%d'",
																			$stock_adjustment_product_detail_add_feet[$po_index],
																									   $stock_adjustment_product_detail_add_mm[$po_index],
																									   $stock_adjustment_product_detail_add_tone[$po_index],
																									   $stock_adjustment_product_detail_add_kg[$po_index],
																									   $stock_adjustment_product_detail_less_feet[$po_index],
																									   $stock_adjustment_product_detail_less_mm[$po_index],
																									   $stock_adjustment_product_detail_less_tone[$po_index],
																									   $stock_adjustment_product_detail_less_kg[$po_index],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$stock_adjustment_id, 
																			$stock_adjustment_product_detail_id[$po_index],
																			$stock_adjustment_product_detail_add_qty[$po_index],
																			$stock_adjustment_product_detail_less_qty[$po_index]);	
																			echo $update_stock_adjustment_product_detail;exit;
					mysql_query($update_stock_adjustment_product_detail);
					$entry_detail_id		= $stock_adjustment_product_detail_id[$po_index];
					
				} else {
					$stock_adjustment_product_detail_uniq_id 		= generateUniqId();
					$insert_stock_adjustment_product_detail 		= sprintf("INSERT INTO stock_adjustment_product_details (stock_adjustment_product_detail_uniq_id,  
																stock_adjustment_product_detail_product_id,
																stock_adjustment_product_detail_stock_adjustment_id, stock_adjustment_product_detail_added_by,
																stock_adjustment_product_detail_added_on, stock_adjustment_product_detail_added_ip, 
																stock_adjustment_product_detail_add_feet,
																									   stock_adjustment_product_detail_add_mm,
																									   stock_adjustment_product_detail_add_tone,
																									   stock_adjustment_product_detail_add_kg,
																									   stock_adjustment_product_detail_less_feet,
																									   stock_adjustment_product_detail_less_mm,
																									   stock_adjustment_product_detail_less_tone,
																									   stock_adjustment_product_detail_less_kg) VALUES 
																('%s','%s','%d', '%d', UNIX_TIMESTAMP(NOW()), '%s','%d', '%d',
																									  '%d','%d','%d', '%d',
																									  '%d','%d')", 
																$stock_adjustment_product_detail_uniq_id,$stock_adjustment_product_detail_product_id[$po_index],
																$stock_adjustment_id, $_SESSION[SESS.'_session_user_id'],$ip,
																$stock_adjustment_product_detail_add_feet[$po_index],
																									   $stock_adjustment_product_detail_add_mm[$po_index],
																									   $stock_adjustment_product_detail_add_tone[$po_index],
																									   $stock_adjustment_product_detail_add_kg[$po_index],
																									   $stock_adjustment_product_detail_less_feet[$po_index],
																									   $stock_adjustment_product_detail_less_mm[$po_index],
																									   $stock_adjustment_product_detail_less_tone[$po_index],
																									   $stock_adjustment_product_detail_less_kg[$po_index]);
					mysql_query($insert_stock_adjustment_product_detail);
					$entry_detail_id		= mysql_insert_id();	
				}
				if($stock_adjustment_product_detail_add_qty[$po_index]>0){
					$stock_ledger_entry_type		= "stock-adjustment-add";
					stockLedger("in",$stock_adjustment_id,$entry_detail_id,$stock_adjustment_product_detail_product_id[$po_index],$stock_adjustment_date,$stock_adjustment_godown_id,'',$stock_adjustment_product_detail_add_qty[$po_index],$stock_adjustment_product_detail_add_qty[$po_index],$stock_adjustment_product_detail_add_feet[$po_index],$stock_adjustment_product_detail_add_mm[$po_index],$stock_adjustment_product_detail_add_tone[$po_index],$stock_adjustment_product_detail_add_kg[$po_index],'',$stock_adjustment_no,$stock_ledger_entry_type,'',$stock_adjustment_branch_id,$stock_adjustment_batch_id);
				}
				if($stock_adjustment_product_detail_less_qty[$po_index]>0){
					$stock_ledger_entry_type		= "stock-adjustment-less";
					stockLedger("out",$stock_adjustment_id,$entry_detail_id,$stock_adjustment_product_detail_product_id[$po_index],$stock_adjustment_date,$stock_adjustment_godown_id,'',$stock_adjustment_product_detail_less_qty[$po_index],$stock_adjustment_product_detail_less_qty[$po_index],$stock_adjustment_product_detail_less_feet[$po_index],$stock_adjustment_product_detail_less_mm[$po_index],$stock_adjustment_product_detail_less_tone[$po_index],$stock_adjustment_product_detail_less_kg[$po_index],'',$stock_adjustment_no,$stock_ledger_entry_type,'',$stock_adjustment_branch_id,$stock_adjustment_batch_id);
				}
			}
		
		}
		pageRedirection("stock-adjustment/index.php?page=edit&id=$stock_adjustment_uniq_id&msg=2");			
	}
    function deleteProductdetail()
   {
		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['stock_adjustment_uniq_id'])))
		{
			$product_detail_id 	= $_GET['product_detail_id'];
			$stock_adjustment_uniq_id = $_GET['stock_adjustment_uniq_id'];
			mysql_query("UPDATE stock_adjustment_product_details SET stock_adjustment_product_detail_deleted_status = 1 
						WHERE stock_adjustment_product_detail_id = ".$product_detail_id." ");
			header("Location:index.php?page=edit&id=$stock_adjustment_uniq_id&msg=6");
		}
		
   } 
   function ReceivedQty($detail_id){
   		$select_rec_qty			= "SELECT 
										SUM(stock_adjustment_product_detail_add_qty+stock_adjustment_product_detail_less_qty) AS sus_qty 
									FROM 
										stock_adjustment_product_details  	
									WHERE 
										stock_adjustment_product_detail_deleted_status 				= 0  					AND
										stock_adjustment_product_detail_damage_entry_detail_id		= '".$detail_id."'					
									GROUP BY 
										stock_adjustment_product_detail_damage_entry_detail_id";
		$result_rec_qty			= mysql_query($select_rec_qty);
		$record_rec_qty 		= mysql_fetch_array($result_rec_qty);
		return $record_rec_qty['sus_qty'];
   }		
	function deleteSuspensentry(){
		deleteUniqRecords('stock_adjustment', 'stock_adjustment_deleted_by', 'stock_adjustment_deleted_on' , 'stock_adjustment_deleted_ip','stock_adjustment_deleted_status', 'stock_adjustment_id', 'stock_adjustment_uniq_id', '1');
		
		deleteMultiRecords('stock_adjustment_product_details', 'stock_adjustment_product_detail_deleted_by', 'stock_adjustment_product_detail_deleted_on', 'stock_adjustment_product_detail_deleted_ip', 'stock_adjustment_product_detail_deleted_status', 'stock_adjustment_product_detail_stock_adjustment_id', 'stock_adjustment','stock_adjustment_id','stock_adjustment_uniq_id', '1');  
		
		pageRedirection("stock-adjustment/index.php?msg=7");				
	}

?>