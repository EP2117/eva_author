<?php

	function insertQuotation(){
		$reserve_entry_branch_id                   	= trim($_POST['reserve_entry_branch_id']);
		$reserve_entry_date                   		= NdateDatabaseFormat($_POST['reserve_entry_date']);
		$reserve_entry_from_date          			= NdateDatabaseFormat($_POST['reserve_entry_from_date']);
		$reserve_entry_to_date          			= NdateDatabaseFormat($_POST['reserve_entry_to_date']);
		$reserve_entry_godown_id          			= NdateDatabaseFormat($_POST['reserve_entry_godown_id']);
		$reserve_entry_type_id          			= NdateDatabaseFormat($_POST['reserve_entry_type_id']);
		//Multi Contact
		$reserve_entry_product_detail_product_id    = $_POST['reserve_entry_product_detail_product_id'];
		$reserve_entry_product_detail_qty 			= $_POST['reserve_entry_product_detail_qty'];
		$reserve_entry_product_detail_length_feet 	= $_POST['reserve_entry_product_detail_length_feet'];
		$reserve_entry_product_detail_length_meter	= $_POST['reserve_entry_product_detail_length_meter'];
		$reserve_entry_product_detail_tone 			= $_POST['reserve_entry_product_detail_tone'];
		$reserve_entry_product_detail_kg 			= $_POST['reserve_entry_product_detail_kg'];
		$reserve_entry_product_detail_osf_uom_ton	= $_POST['reserve_entry_product_detail_osf_uom_ton'];
		$request_fields 							= ((!empty($reserve_entry_branch_id)) && (!empty($reserve_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "reserve-entry/index.php?page=add&msg=5");
		$reserve_entry_uniq_id						= generateUniqId();
		$ip												= getRealIpAddr();
		
		$select_quotation_no 							= "SELECT 
																MAX(reserve_entry_no) AS maxval 
														   FROM 
														   		reserve_entry 
								  						   WHERE 
														   		reserve_entry_deleted_status 	= 0 												AND
								   								reserve_entry_branch_id 		= '".$reserve_entry_branch_id."'					AND
								   								reserve_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND
								   								reserve_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";

		$result_quotation_no 							= mysql_query($select_quotation_no);
		$record_quotation_no 							= mysql_fetch_array($result_quotation_no);	
		$maxval 										= $record_quotation_no['maxval']; 
		if($maxval > 0) {
			$reserve_entry_no 						= substr(('00000'.++$maxval),-5);
		} else {
			$reserve_entry_no 						= substr(('00000'.++$maxval),-5);
		}
		
		
		$insert_reserve_entry 						= sprintf("INSERT INTO reserve_entry (reserve_entry_uniq_id, reserve_entry_date,
																						reserve_entry_from_date,reserve_entry_to_date,
																						reserve_entry_godown_id,reserve_entry_added_by,
																						reserve_entry_added_on,reserve_entry_added_ip,
																						reserve_entry_company_id,reserve_entry_financial_year,
																						reserve_entry_no,reserve_entry_branch_id,
																						reserve_entry_type_id) 
																			VALUES 	 ('%s', '%s', 
																					  '%s', '%s',
																					  '%d', '%d',
																					  UNIX_TIMESTAMP(NOW()),'%s',
																					  '%d', '%d',
																					  '%s', '%d',
																					  '%d')", 
																					   $reserve_entry_uniq_id, $reserve_entry_date, 
																					   $reserve_entry_from_date, $reserve_entry_to_date,
																					  $reserve_entry_godown_id, $_SESSION[SESS.'_session_user_id'],
																					   $ip,
																					   $_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																					   $reserve_entry_no,$reserve_entry_branch_id,
																					   $reserve_entry_type_id);  
		 mysql_query($insert_reserve_entry);
		//echo $insert_reserve_entry; exit;
		$reserve_entry_id 						= mysql_insert_id(); 
		// purchase order pproduct details
		for($po_index = 0; $po_index < count($reserve_entry_product_detail_product_id); $po_index++) {
			$detail_request_fields 						= 	((!empty($reserve_entry_product_detail_product_id[$po_index])) && 
									 						(!empty($reserve_entry_product_detail_qty[$po_index])));
			if($detail_request_fields) {
				$reserve_entry_product_detail_uniq_id = generateUniqId();
				 $insert_reserve_entry_product_detail 		= sprintf("INSERT INTO reserve_entry_product_details (reserve_entry_product_detail_uniq_id,  
																reserve_entry_product_detail_qty, 
																reserve_entry_product_detail_product_id, 
																reserve_entry_product_detail_reserve_entry_id, 
																reserve_entry_product_detail_added_by,
																reserve_entry_product_detail_added_on, 
																reserve_entry_product_detail_added_ip,
																reserve_entry_product_detail_company_id,
																reserve_entry_product_detail_branch_id,
																reserve_entry_product_detail_financial_year) 
															VALUES 
																('%s', '%f','%d', '%d', '%d', UNIX_TIMESTAMP(NOW()), '%s',  '%d',  '%d',  '%d')", 
																$reserve_entry_product_detail_uniq_id, 
																$reserve_entry_product_detail_qty[$po_index],
																$reserve_entry_product_detail_product_id[$po_index],
																$reserve_entry_id, 
																$_SESSION[SESS.'_session_user_id'], 
																$ip,
																$_SESSION[SESS.'_session_company_id'],
																$_SESSION[SESS.'_session_financial_year'],
																$reserve_entry_branch_id);
				mysql_query($insert_reserve_entry_product_detail);
				$grn_detail_id	= mysql_insert_id();
						$produt_id											=	$reserve_entry_product_detail_product_id[$po_index];
					if($reserve_entry_type_id==4){
						$width_inches										=   "1";
						$width_mm											=   "1";
						$color_id											= 	"1";
						$thick												= 	"1";
						$length_feet										= 	"1";
						$length_meter										= 	"1";
						$ton_qty											= 	"1";
						$kg_qty												= 	"1";
						$prd_type											= 	"1";
					}
					else{
						$raw_prd_detail										= 	Child_prod_detail($produt_id);
						$width_inches										=   $raw_prd_detail['product_con_entry_child_product_detail_width_inches'];
						$width_mm											=   $raw_prd_detail['product_con_entry_child_product_detail_width_mm'];
						$color_id											= 	$raw_prd_detail['product_con_entry_child_product_detail_color_id'];
						$thick												= 	$raw_prd_detail['product_con_entry_child_product_detail_thick_ness'];
						$length_feet										= 	$reserve_entry_product_detail_length_feet[$po_index];
						$length_meter										= 	$reserve_entry_product_detail_length_meter[$po_index];
						if($reserve_entry_type_id==1){
							$brand_id										= 	$raw_prd_detail['product_brand_id'];
							$total_ton										=  	$reserve_entry_product_detail_osf_uom_ton[$po_index];
							$ton_qty										= 	$total_ton*$reserve_entry_product_detail_length_feet[$po_index];
							$kg_qty											= 	$ton_qty*1000;
						}
						else{
							$ton_qty											= 	$reserve_entry_product_detail_tone[$po_index];
							$kg_qty												= 	$reserve_entry_product_detail_kg[$po_index];
						}
						$prd_type												= "2";
					}
					
					$product_detail_qty									= 	$reserve_entry_product_detail_qty[$po_index];
					$stock_ledger_entry_type							= 	"reserve-entry";
					$product_con_entry_godown_id						= 	$reserve_entry_godown_id;
					stockLedger('out',$reserve_entry_id,$grn_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$product_detail_qty), $reserve_entry_branch_id,  $product_con_entry_godown_id, $reserve_entry_date, $reserve_entry_no,$stock_ledger_entry_type, $prd_type,$width_inches,$width_mm,$color_id,$thick);
				
				
			}
		
		}
		pageRedirection("reserve-entry/index.php?page=add&msg=1");
	}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND reserve_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['reserve_entry_from_date'])) && !empty($_REQUEST['reserve_entry_from_date']) &&
		 isset($_REQUEST['reserve_entry_to_date'])&& !empty($_REQUEST['reserve_entry_to_date']))
		{
		$where.="AND reserve_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['reserve_entry_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['reserve_entry_to_date'])."' ";
		}
		
		$select_reserve_entry		=	"SELECT 
											reserve_entry_id,
											reserve_entry_uniq_id,
											reserve_entry_no,
											reserve_entry_date,
											reserve_entry_to_date,
											reserve_entry_from_date,
											godown_name
										 FROM 
											reserve_entry
										 LEFT JOIN
										 	godowns
										ON
											godown_id				= reserve_entry_godown_id
										 WHERE 
											reserve_entry_deleted_status 	= 	0 $where
										 ORDER BY 
											reserve_entry_no ASC";
		$result_reserve_entry		= mysql_query($select_reserve_entry);
		// Filling up the array
		$reserve_entry_data 		= array();
		while ($record_reserve_entry = mysql_fetch_array($result_reserve_entry))
		{
		 $reserve_entry_data[] 	= $record_reserve_entry;
		}
		return $reserve_entry_data;
	}

	function editQuotation(){
		$reserve_entry_id 			= getId('reserve_entry', 'reserve_entry_id', 'reserve_entry_uniq_id', dataValidation($_GET['id'])); 
		$select_reserve_entry		=	"SELECT 
											reserve_entry_uniq_id, 
											reserve_entry_date,
											reserve_entry_from_date,
											reserve_entry_to_date,
											reserve_entry_no,
											reserve_entry_branch_id,
											reserve_entry_id,
											reserve_entry_godown_id,
											reserve_entry_type_id
										 FROM 
											reserve_entry 
										 WHERE 
											reserve_entry_deleted_status 	=  0 			AND 
											reserve_entry_id				= '".$reserve_entry_id."'
										 ORDER BY 
											reserve_entry_no ASC";
		$result_reserve_entry 		= mysql_query($select_reserve_entry);
		$record_reserve_entry 		= mysql_fetch_array($result_reserve_entry);
		return $record_reserve_entry;
	}

	function editQuotationProductDetail()

	{
		$reserve_entry_id 	= getId('reserve_entry', 'reserve_entry_id', 'reserve_entry_uniq_id', dataValidation($_GET['id'])); 
		  $select_reserve_entry_product_detail 	= "	SELECT 
														reserve_entry_product_detail_id,
														reserve_entry_product_detail_product_id,
														reserve_entry_product_detail_qty,
														reserve_entry_product_detail_mode,
														reserve_entry_product_detail_customer_id,
														product_name,
														product_uom_name,
														product_code,
														product_con_entry_child_product_detail_thick_ness,
														product_colour_name,
														product_con_entry_child_product_detail_width_inches,
														product_con_entry_child_product_detail_width_mm,
														product_con_entry_child_product_detail_length_mm,
														product_con_entry_child_product_detail_length_feet,
														brand_name,
														product_con_entry_child_product_detail_ton_qty,
														product_con_entry_child_product_detail_kg_qty,
														brand_name,
														product_con_entry_child_product_detail_name,
														product_con_entry_osf_uom_ton
														
													FROM 
														reserve_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= reserve_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													 ON 
															brand_id 									= product_brand_id
													LEFT JOIN 
														product_uoms  
													ON 
														product_uom_id 										= product_uom_one_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id 			= reserve_entry_product_detail_product_id
													 LEFT JOIN 
															product_colours 
													 ON 
															product_colour_id 								= product_con_entry_child_product_detail_color_id
													WHERE 
														reserve_entry_product_detail_deleted_status		 	= 0 						AND 
														reserve_entry_product_detail_reserve_entry_id 		= '".$reserve_entry_id."'";
		$result_reserve_entry_product_detail 	= mysql_query($select_reserve_entry_product_detail);
		$count_reserve_entry 					= mysql_num_rows($result_reserve_entry_product_detail);
		$arr_reserve_entry_product_detail 	= array();
		
		while($record_reserve_entry_product_detail = mysql_fetch_array($result_reserve_entry_product_detail)) {
			$arr_reserve_entry_product_detail[] = $record_reserve_entry_product_detail;
		}
		return $arr_reserve_entry_product_detail;
	}
	

	function updateQuotation(){
		$reserve_entry_id                   		= trim($_POST['reserve_entry_id']);
		$reserve_entry_uniq_id                		= trim($_POST['reserve_entry_uniq_id']);
		$reserve_entry_branch_id                   	= trim($_POST['reserve_entry_branch_id']);
		$reserve_entry_date                   		= NdateDatabaseFormat($_POST['reserve_entry_date']);
		$reserve_entry_from_date          			= NdateDatabaseFormat($_POST['reserve_entry_from_date']);
		$reserve_entry_to_date          			= NdateDatabaseFormat($_POST['reserve_entry_to_date']);
		$reserve_entry_godown_id          			= trim($_POST['reserve_entry_godown_id']);
		
		//Multi Contact
		$reserve_entry_product_detail_id      		= $_POST['reserve_entry_product_detail_id'];
		$reserve_entry_product_detail_product_id     = $_POST['reserve_entry_product_detail_product_id'];
		$reserve_entry_product_detail_qty 			= $_POST['reserve_entry_product_detail_qty'];
		$reserve_entry_product_detail_mode 			= $_POST['reserve_entry_product_detail_mode'];
		$reserve_entry_product_detail_customer_id 	= $_POST['reserve_entry_product_detail_customer_id'];
		$product_con_entry_osf_uom_ton 				= $_POST['product_con_entry_osf_uom_ton'];
		$request_fields 						= ((!empty($reserve_entry_branch_id)) && (!empty($reserve_entry_date)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "reserve-entry/index.php?page=edit&id=$reserve_entry_uniq_id&msg=5");
		$ip												= getRealIpAddr();
		 $update_customer 					= sprintf("	UPDATE 
															reserve_entry 
														SET 
															reserve_entry_branch_id 				= '%d',
															reserve_entry_from_date 				= '%s',
															reserve_entry_to_date 					= '%s',
															reserve_entry_godown_id					= '%d',
															reserve_entry_date 						= '%s',
															reserve_entry_modified_by 				= '%d',
															reserve_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),
															reserve_entry_modified_ip				= '%s'
															
														WHERE               
															reserve_entry_id         			= '%d'", 
															$reserve_entry_branch_id,
															$reserve_entry_from_date,
															$reserve_entry_to_date,
															$reserve_entry_godown_id,
															$reserve_entry_date,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$reserve_entry_id); 
		mysql_query($update_customer);
		for($po_index = 0; $po_index < count($reserve_entry_product_detail_product_id); $po_index++) {
			$detail_request_fields = ((!empty($reserve_entry_product_detail_product_id[$po_index])) && (!empty($reserve_entry_product_detail_qty[$po_index])) );
			if($detail_request_fields) {
				if(isset($reserve_entry_product_detail_id[$po_index]) && (!empty($reserve_entry_product_detail_id[$po_index]))) {
					$update_reserve_entry_product_detail = sprintf("	UPDATE 
																			reserve_entry_product_details 
																		SET  
																			reserve_entry_product_detail_qty  				= '%f', 
																			reserve_entry_product_detail_product_id 		= '%d',
																			reserve_entry_product_detail_mode 				= '%d',
																			reserve_entry_product_detail_customer_id 		= '%d',
																			reserve_entry_product_detail_modified_by 		= '%d',
																			reserve_entry_product_detail_modified_on 		= UNIX_TIMESTAMP(NOW()),
																			reserve_entry_product_detail_modified_ip 		= '%s',
																			reserve_entry_product_detail_company_id 		= '%d',
																			reserve_entry_product_detail_financial_year 	= '%d',
																			reserve_entry_product_detail_branch_id			= '%d'																			
																			
																		WHERE 
																			reserve_entry_product_detail_reserve_entry_id 	= '%d' AND 
																			reserve_entry_product_detail_id 					= '%d'",
																			$reserve_entry_product_detail_qty[$po_index],
																			$reserve_entry_product_detail_product_id[$po_index],
																			$reserve_entry_product_detail_mode[$po_index],
																			$reserve_entry_product_detail_customer_id[$po_index],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$_SESSION[SESS.'_session_company_id'],
																			$_SESSION[SESS.'_session_financial_year'],
																			$reserve_entry_branch_id,																			
																			$reserve_entry_id, 
																			$reserve_entry_product_detail_id[$po_index]);	
					mysql_query($update_reserve_entry_product_detail);
					
				} else {
					$reserve_entry_product_detail_uniq_id 		= generateUniqId();
					$insert_reserve_entry_product_detail 		= sprintf("INSERT INTO reserve_entry_product_details (reserve_entry_product_detail_uniq_id,  
																	reserve_entry_product_detail_qty, 
																	reserve_entry_product_detail_product_id, 
																	reserve_entry_product_detail_mode,
																	reserve_entry_product_detail_customer_id,
																	reserve_entry_product_detail_reserve_entry_id, 
																	reserve_entry_product_detail_added_by,
																	reserve_entry_product_detail_added_on, 
																	reserve_entry_product_detail_added_ip,
																	reserve_entry_product_detail_company_id,
																	reserve_entry_product_detail_financial_year,
																	reserve_entry_product_detail_branch_id) 
																VALUES 
																	('%s', '%f', '%d', '%d', '%d', '%d', '%d', UNIX_TIMESTAMP(NOW()), '%s')", 
																	$reserve_entry_product_detail_uniq_id, 
																	$reserve_entry_product_detail_qty[$po_index],
																	$reserve_entry_product_detail_product_id[$po_index],
																	$reserve_entry_product_detail_mode[$po_index],
																	$reserve_entry_product_detail_customer_id[$po_index],
																	$reserve_entry_id, 
																	$_SESSION[SESS.'_session_user_id'], 
																	$ip,
																	$_SESSION[SESS.'_session_company_id'],
																	$_SESSION[SESS.'_session_financial_year'],
																	$reserve_entry_branch_id);
					mysql_query($insert_reserve_entry_product_detail);
				}
			}
		
		}
		pageRedirection("reserve-entry/index.php?page=edit&id=$reserve_entry_uniq_id&msg=2");			
	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['production_order_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$production_order_uniq_id = $_GET['production_order_uniq_id'];

			mysql_query("UPDATE production_order_product_details SET production_order_product_detail_deleted_status = 1 

						WHERE production_order_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$production_order_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('production_order', 'production_order_deleted_by', 'production_order_deleted_on' , 'production_order_deleted_ip','production_order_deleted_status', 'production_order_id', 'production_order_uniq_id', '1');

		

		deleteMultiRecords('production_order_product_details', 'production_order_product_detail_deleted_by', 'production_order_product_detail_deleted_on', 'production_order_product_detail_deleted_ip', 'production_order_product_detail_deleted_status', 'production_order_product_detail_production_order_id', 'production_order','production_order_id','production_order_uniq_id', '1');  



		

		pageRedirection("production-order/index.php?msg=7");				

	}

?>