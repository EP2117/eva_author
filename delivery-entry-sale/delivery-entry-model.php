<?php

	function insertQuotation(){

		$do_god_entry_no                   					= trim($_POST['do_god_entry_no']);
		$do_god_entry_branch_id                   			= trim($_POST['do_god_entry_branch_id']);
		$do_god_entry_date                 					= NdateDatabaseFormat($_POST['do_god_entry_date']);

		$do_god_entry_customer_id            				= trim($_POST['do_god_entry_customer_id']);

		$do_god_entry_godown_id            					= trim($_POST['do_god_entry_godown_id']);



		$do_god_entry_production_order_id              		= NdateDatabaseFormat($_POST['do_god_entry_production_order_id']);

		$stock_ledger_entry_type							= 'dc-warehouse';

		//Product Detail
		$do_god_entry_product_detail_type     				= $_POST['do_god_entry_product_detail_type'];
		$do_god_entry_product_detail_product_id     		= $_POST['do_god_entry_product_detail_product_id'];
		$do_god_entry_product_detail_production_detail_id   = $_POST['do_god_entry_product_detail_production_detail_id'];
		$do_god_entry_product_detail_length_feet  			= $_POST['do_god_entry_product_detail_length_feet'];
		$do_god_entry_product_detail_length_inches  		= $_POST['do_god_entry_product_detail_length_inches'];
		$do_god_entry_product_detail_length_mm  			= $_POST['do_god_entry_product_detail_length_mm'];
		$do_god_entry_product_detail_length_meter  			= $_POST['do_god_entry_product_detail_length_meter'];
		$do_god_entry_product_detail_qty 					= $_POST['do_god_entry_product_detail_qty'];
		$do_god_entry_product_detail_remarks 				= $_POST['do_god_entry_product_detail_remarks'];
		$request_fields 									= ((!empty($do_god_entry_branch_id)) && (!empty($do_god_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "delivery-entry-sale/index.php?page=add&msg=5");
		$do_god_entry_uniq_id							= generateUniqId();
		$ip													= getRealIpAddr();

		$insert_do_god_entry 							= sprintf("INSERT INTO do_god_entry  (do_god_entry_uniq_id, do_god_entry_date,

																					  		  do_god_entry_customer_id,do_god_entry_godown_id,

																					  		  do_god_entry_no,

																					  		  do_god_entry_branch_id,do_god_entry_added_by,

																					   		  do_god_entry_added_on,do_god_entry_added_ip,

																			   		   		  do_god_entry_company_id,do_god_entry_financial_year,

																							  do_god_entry_production_order_id) 

																			VALUES 	 		 ('%s', '%s', 

																							  '%d', '%d', 

																							  '%s',

																							  '%d', '%d', 

																							   UNIX_TIMESTAMP(NOW()),

																							  '%s', '%d', '%d',

																							  '%d')", 

																		  	   		   		 $do_god_entry_uniq_id, $do_god_entry_date,

																					   		 $do_god_entry_customer_id,$do_god_entry_godown_id,

																							 $do_god_entry_no,

																					   		 $do_god_entry_branch_id,$_SESSION[SESS.'_session_user_id'],

																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],

																							 $do_god_entry_production_order_id);  

		mysql_query($insert_do_god_entry);

		//echo $insert_do_god_entry; exit;

		$do_god_entry_id 							= mysql_insert_id(); 

		// purchase order pproduct details

		for($i = 0; $i < count($do_god_entry_product_detail_product_id); $i++) {

			$detail_request_fields 						= 	((!empty($do_god_entry_product_detail_product_id[$i])) && 

									 						(!empty($do_god_entry_product_detail_qty[$i])));

			if($detail_request_fields) {

				$do_god_entry_product_detail_uniq_id = generateUniqId();

				$insert_do_god_entry_product_detail 		= sprintf("INSERT INTO do_god_entry_product_details 

																				(do_god_entry_product_detail_uniq_id,do_god_entry_product_detail_product_id,

																				 do_god_entry_product_detail_length_feet,do_god_entry_product_detail_length_inches,

																				 do_god_entry_product_detail_length_mm,do_god_entry_product_detail_length_meter,

																				 do_god_entry_product_detail_remarks,do_god_entry_product_detail_qty,

																				 do_god_entry_product_detail_production_order_id,do_god_entry_product_detail_production_detail_id,

																				 do_god_entry_product_detail_do_god_entry_id,do_god_entry_product_detail_added_by,

																				 do_god_entry_product_detail_added_on,do_god_entry_product_detail_added_ip,
																				 do_god_entry_product_detail_type) 

																	VALUES     ('%s', '%d', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%s', '%f', 

																				'%d', '%d',

																				'%d', '%d', 

																				UNIX_TIMESTAMP(NOW()), '%s',
																				'%d')", 

																				$do_god_entry_product_detail_uniq_id,$do_god_entry_product_detail_product_id[$i],  

																				$do_god_entry_product_detail_length_feet[$i],$do_god_entry_product_detail_length_inches[$i],

																				$do_god_entry_product_detail_length_mm[$i],$do_god_entry_product_detail_length_meter[$i],

																				$do_god_entry_product_detail_remarks[$i],$do_god_entry_product_detail_qty[$i],

																				$do_god_entry_production_order_id,$do_god_entry_product_detail_production_detail_id[$i],

																				$do_god_entry_id, $_SESSION[SESS.'_session_user_id'],$ip,
																				$do_god_entry_product_detail_type[$i]);

				mysql_query($insert_do_god_entry_product_detail);
				$do_god_entry_detail_id 							= mysql_insert_id(); 
					
				$length_inches										= $do_god_entry_product_detail_length_feet[$i];
				$width_inches										= "3";
				$stock_ledger_prd_type								= 	$do_god_entry_product_detail_type[$i];
				stockLedger('out',$do_god_entry_id,$do_god_entry_detail_id,$do_god_entry_product_detail_product_id[$i],$length_inches,$width_inches,($do_god_entry_product_detail_qty[$i]*-1), $do_god_entry_branch_id, $do_god_entry_customer_id, $do_god_entry_godown_id, $do_god_entry_date, $do_god_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);
			}

		

		}

		pageRedirection("delivery-entry-sale/index.php?page=add&msg=1");

	}

	function listQuotation(){

		$select_do_god_entry		=	"SELECT 

												do_god_entry_id,

												do_god_entry_uniq_id,

												do_god_entry_no,

												do_god_entry_date,

												customer_name,

												do_god_entry_address

											 FROM 

												do_god_entry

											 LEFT JOIN

												customers

											 ON

												customer_id		=  do_god_entry_customer_id

											 WHERE 

												do_god_entry_deleted_status 	= 	0 

											 ORDER BY 

												do_god_entry_no ASC";

		$result_do_god_entry		= mysql_query($select_do_god_entry);

		// Filling up the array

		$do_god_entry_data 		= array();

		while ($record_do_god_entry = mysql_fetch_array($result_do_god_entry))

		{

		 $do_god_entry_data[] 	= $record_do_god_entry;

		}

		return $do_god_entry_data;

	}

	function editQuotation(){

		$do_god_entry_id 			= getId('do_god_entry', 'do_god_entry_id', 'do_god_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_do_god_entry		=	"SELECT 

												do_god_entry_uniq_id,  do_god_entry_date,

												do_god_entry_customer_id,do_god_entry_address,

												do_god_entry_vehicle_no,do_god_entry_person_name,

												do_god_entry_godown_id,do_god_entry_driver_name,

												do_god_entry_time,

												do_god_entry_no,

												do_god_entry_branch_id,do_god_entry_id,

												production_order_no,production_order_date,

												do_god_entry_production_order_id

											 FROM 

												do_god_entry

											LEFT JOIN

												production_order

											ON

												production_order_id				= do_god_entry_production_order_id 

											 WHERE 

												do_god_entry_deleted_status 	=  0 			AND 

												do_god_entry_id				= '".$do_god_entry_id."'

											 ORDER BY 

												do_god_entry_no ASC";

		$result_do_god_entry 		= mysql_query($select_do_god_entry);

		$record_do_god_entry 		= mysql_fetch_array($result_do_god_entry);

		return $record_do_god_entry;

	}

	function editQuotationProductDetail()

	{

		$do_god_entry_id 	= getId('do_god_entry', 'do_god_entry_id', 'do_god_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_do_god_entry_product_detail 	= "	SELECT 
															do_god_entry_product_detail_id,
															do_god_entry_product_detail_product_id,
															do_god_entry_product_detail_length_feet,do_god_entry_product_detail_length_inches,
															do_god_entry_product_detail_length_mm,do_god_entry_product_detail_length_meter,
															do_god_entry_product_detail_remarks,do_god_entry_product_detail_qty,
															product_name,
															product_code,
															do_god_entry_product_detail_type,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															p_uom.product_uom_name as p_uom_name,
															child_uom.product_uom_name as c_uom_name,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name
														FROM 
															do_god_entry_product_details 
														LEFT JOIN 
															products 
														ON 
															product_id 		= do_god_entry_product_detail_product_id
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id					= production_order_product_detail_product_id	
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 										= product_product_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 									= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 									= product_product_colour_id
															
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 									= product_con_entry_child_product_detail_color_id
														WHERE 
															do_god_entry_product_detail_deleted_status		 			= 0 							AND 
															do_god_entry_product_detail_do_god_entry_id 				= '".$do_god_entry_id."'";

		$result_do_god_entry_product_detail 	= mysql_query($select_do_god_entry_product_detail);

		$count_do_god_entry 					= mysql_num_rows($result_do_god_entry_product_detail);

		$arr_do_god_entry_product_detail 	= array();

		

		while($record_do_god_entry_product_detail = mysql_fetch_array($result_do_god_entry_product_detail)) {

			$arr_do_god_entry_product_detail[] = $record_do_god_entry_product_detail;

		}

		return $arr_do_god_entry_product_detail;

	}

	function updateQuotation(){

		$do_god_entry_id                   					= trim($_POST['do_god_entry_id']);
		$do_god_entry_uniq_id                				= trim($_POST['do_god_entry_uniq_id']);
		$do_god_entry_branch_id                   			= trim($_POST['do_god_entry_branch_id']);
		$do_god_entry_date                 					= NdateDatabaseFormat($_POST['do_god_entry_date']);
		$do_god_entry_customer_id            				= trim($_POST['do_god_entry_customer_id']);
		$do_god_entry_godown_id      						= trim($_POST['do_god_entry_godown_id']);
		$do_god_entry_production_order_id              		= trim($_POST['do_god_entry_production_order_id']);

		

		//Product Detail
		$do_god_entry_product_detail_type      				= $_POST['do_god_entry_product_detail_type'];
		$do_god_entry_product_detail_id      				= $_POST['do_god_entry_product_detail_id'];
		$do_god_entry_product_detail_product_id     		= $_POST['do_god_entry_product_detail_product_id'];
		$do_god_entry_product_detail_production_detail_id 	= $_POST['do_god_entry_product_detail_production_detail_id'];
		$do_god_entry_product_detail_length_feet  			= $_POST['do_god_entry_product_detail_length_feet'];
		$do_god_entry_product_detail_length_inches  		= $_POST['do_god_entry_product_detail_length_inches'];
		$do_god_entry_product_detail_length_mm  			= $_POST['do_god_entry_product_detail_length_mm'];
		$do_god_entry_product_detail_length_meter  			= $_POST['do_god_entry_product_detail_length_meter'];
		$do_god_entry_product_detail_qty 					= $_POST['do_god_entry_product_detail_qty'];
		$do_god_entry_product_detail_remarks 				= $_POST['do_god_entry_product_detail_remarks'];
		$request_fields 									= ((!empty($do_god_entry_branch_id)) && (!empty($do_god_entry_date)));
		$stock_ledger_entry_type							= 'dc-warehouse';
		checkRequestFields($request_fields, PROJECT_PATH, "delivery-entry-sale/index.php?page=edit&id=$do_god_entry_uniq_id");
		$ip												= getRealIpAddr();
		$update_customer 					= sprintf("	UPDATE 

															do_god_entry 

														SET 

															do_god_entry_branch_id 					= '%d',

															do_god_entry_date 						= '%s',

															do_god_entry_customer_id 				= '%d',

															do_god_entry_godown_id 					= '%d',

															do_god_entry_modified_by 				= '%d',

															do_god_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															do_god_entry_modified_ip				= '%s'

														WHERE               

															do_god_entry_id         				= '%d'", 

															$do_god_entry_branch_id,

															$do_god_entry_date,

															$do_god_entry_customer_id,

															$do_god_entry_godown_id,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$do_god_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($do_god_entry_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($do_god_entry_product_detail_product_id[$i])) &&

									 (!empty($do_god_entry_product_detail_qty[$i])));

			if($detail_request_fields) {

				if(isset($do_god_entry_product_detail_id[$i]) && (!empty($do_god_entry_product_detail_id[$i]))) {

					$update_do_god_entry_product_detail = sprintf("	UPDATE 

																			do_god_entry_product_details 

																		SET  

																			do_god_entry_product_detail_qty  					= '%f',

																			do_god_entry_product_detail_length_feet  			= '%f',

																			do_god_entry_product_detail_length_inches  		= '%f',

																			do_god_entry_product_detail_length_mm  			= '%f',

																			do_god_entry_product_detail_length_meter  		= '%f',

																			do_god_entry_product_detail_remarks  				= '%s',

																			do_god_entry_product_detail_modified_by 			= '%d',

																			do_god_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),

																			do_god_entry_product_detail_modified_ip 			= '%s'

																		WHERE 

																			do_god_entry_product_detail_do_god_entry_id 	= '%d' AND 

																			do_god_entry_product_detail_id 					= '%d'",

																			$do_god_entry_product_detail_qty[$i],

																			$do_god_entry_product_detail_length_feet[$i],

																			$do_god_entry_product_detail_length_inches[$i],

																			$do_god_entry_product_detail_length_mm[$i],

																			$do_god_entry_product_detail_length_meter[$i],

																			$do_god_entry_product_detail_remarks[$i],

																			$_SESSION[SESS.'_session_user_id'], 

																			$ip, 

																			$do_god_entry_id, 

																			$do_god_entry_product_detail_id[$i]);	

					mysql_query($update_do_god_entry_product_detail);

					$do_god_entry_detail_id 							= $do_god_entry_product_detail_id[$i]; 
						
					$length_inches										= $do_god_entry_product_detail_length_feet[$i];
					$width_inches										= "3";
					$stock_ledger_prd_type									= $do_god_entry_product_detail_type[$i];
					stockLedger('out',$do_god_entry_id,$do_god_entry_detail_id,$do_god_entry_product_detail_product_id[$i],$length_inches,$width_inches,($do_god_entry_product_detail_qty[$i]*-1), $do_god_entry_branch_id, $do_god_entry_customer_id, $do_god_entry_godown_id, $do_god_entry_date, $do_god_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);

				} else {
				$do_god_entry_product_detail_uniq_id = generateUniqId();
					$insert_do_god_entry_product_detail 		= sprintf("INSERT INTO do_god_entry_product_details 

																				(do_god_entry_product_detail_uniq_id,do_god_entry_product_detail_product_id,

																				 do_god_entry_product_detail_length_feet,do_god_entry_product_detail_length_inches,

																				 do_god_entry_product_detail_length_mm,do_god_entry_product_detail_length_meter,

																				 do_god_entry_product_detail_remarks,do_god_entry_product_detail_qty,

																				 do_god_entry_product_detail_production_order_id,do_god_entry_product_detail_production_detail_id,

																				 do_god_entry_product_detail_do_god_entry_id,do_god_entry_product_detail_added_by,

																				 do_god_entry_product_detail_added_on,do_god_entry_product_detail_added_ip,
																				 do_god_entry_product_detail_type) 

																	VALUES     ('%s', '%d', 

																				'%f', '%f', 

																				'%f', '%f', 

																				'%s', '%f', 

																				'%d', '%d',

																				'%d', '%d', 

																				UNIX_TIMESTAMP(NOW()), '%s',
																				'%d')", 

																				$do_god_entry_product_detail_uniq_id,$do_god_entry_product_detail_product_id[$i],  

																				$do_god_entry_product_detail_length_feet[$i],$do_god_entry_product_detail_length_inches[$i],

																				$do_god_entry_product_detail_length_mm[$i],$do_god_entry_product_detail_length_meter[$i],

																				$do_god_entry_product_detail_remarks[$i],$do_god_entry_product_detail_qty[$i],

																				$do_god_entry_production_order_id,$do_god_entry_product_detail_production_detail_id[$i],

																				$do_god_entry_id, $_SESSION[SESS.'_session_user_id'],$ip,
																				$do_god_entry_product_detail_type[$i]);

				mysql_query($insert_do_god_entry_product_detail);
				
				$do_god_entry_detail_id 							= mysql_insert_id(); 
					
				$length_inches										= $do_god_entry_product_detail_length_feet[$i];
				$width_inches										= "3";
				$stock_ledger_prd_type								= $do_god_entry_product_detail_type[$i];
				stockLedger('out',$do_god_entry_id,$do_god_entry_detail_id,$do_god_entry_product_detail_product_id[$i],$length_inches,$width_inches,($do_god_entry_product_detail_qty[$i]*-1), $do_god_entry_branch_id, $do_god_entry_customer_id, $do_god_entry_godown_id, $do_god_entry_date, $do_god_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);
				}
			}
		}
		pageRedirection("delivery-entry-sale/index.php?page=edit&id=$do_god_entry_uniq_id&msg=2");			
	}

    function deleteProductdetail()
   {
		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['do_god_entry_uniq_id'])))
		{
			$product_detail_id 	= $_GET['product_detail_id'];
			$do_god_entry_uniq_id = $_GET['do_god_entry_uniq_id'];
			mysql_query("UPDATE do_god_entry_product_details SET do_god_entry_product_detail_deleted_status = 1 
						WHERE do_god_entry_product_detail_id = ".$product_detail_id." ");
			header("Location:index.php?page=edit&id=$do_god_entry_uniq_id&msg=6");
		}
	   } 		

	function deleteInventoryrequest(){
		deleteUniqRecords('do_god_entry', 'do_god_entry_deleted_by', 'do_god_entry_deleted_on' , 'do_god_entry_deleted_ip','do_god_entry_deleted_status', 'do_god_entry_id', 'do_god_entry_uniq_id', '1');
		deleteMultiRecords('do_god_entry_product_details', 'do_god_entry_product_detail_deleted_by', 'do_god_entry_product_detail_deleted_on', 'do_god_entry_product_detail_deleted_ip', 'do_god_entry_product_detail_deleted_status', 'do_god_entry_product_detail_do_god_entry_id', 'do_god_entry','do_god_entry_id','do_god_entry_uniq_id', '1');  
		pageRedirection("delivery-entry-sale/index.php?msg=7");				
	}

?>