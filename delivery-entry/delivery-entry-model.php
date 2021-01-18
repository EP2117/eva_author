<?php
	function GetAutoNo($invoice_id){
		$select_invoice_no = "SELECT MAX(SUBSTRING_INDEX(delivery_entry_no,'-',-1)) AS maxval FROM delivery_entry 
								  WHERE delivery_entry_deleted_status =0
								  
								  AND delivery_entry_invoice_entry_id  ='".$invoice_id."'
								  AND delivery_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND delivery_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";
								  
								//echo $select_invoice_no;exit;

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval = $record_invoice_no['maxval']; 
//echo $maxval;exit;
		/*if($maxval > 0) {

			$delivery_entry_no = substr(('00000'.++$maxval),-5);

		} else {

			$delivery_entry_no = substr(('00000'.++$maxval),-5);

		}*/
		$delivery_entry_no = $maxval+1; //echo $delivery_entry_no;exit;
		return $delivery_entry_no;
	}
	function insertQuotation(){
   $select_branch	= "SELECT branch_prefix FROM branches WHERE  branch_id = '".$_POST['delivery_entry_branch_id']."' ";
		//echo $select_branch;exit;
		$result_branch = mysql_query($select_branch);
		$res = mysql_fetch_array($result_branch); 

		$delivery_entry_no                   				= trim($_POST['delivery_entry_no']).'-'.GetAutoNo($_POST['delivery_entry_invoice_entry_id']); //echo $delivery_entry_no;exit;
		$delivery_entry_branch_id                   		= trim($_POST['delivery_entry_branch_id']);
		$delivery_entry_date                 				= NdateDatabaseFormat($_POST['delivery_entry_date']);
		$delivery_entry_customer_id            				= trim($_POST['delivery_entry_customer_id']);
		$delivery_entry_address                 			= trim($_POST['delivery_entry_address']);
		$delivery_entry_vehicle_no            				= trim($_POST['delivery_entry_vehicle_no']);
		$delivery_entry_person_name                 		= trim($_POST['delivery_entry_person_name']);
		$delivery_entry_godown_id            				= trim($_POST['delivery_entry_godown_id']);
		$delivery_entry_driver_name            				= trim($_POST['delivery_entry_driver_name']);
		$delivery_entry_time                 				= trim($_POST['delivery_entry_time']);
		$delivery_entry_invoice_entry_id              		= trim($_POST['delivery_entry_invoice_entry_id']);
		$delivery_entry_type_id              				= trim($_POST['delivery_entry_type_id']);
		$stock_ledger_entry_type							= 'dc-sale';
		//Product Detail
		$delivery_entry_product_detail_product_type      	= $_POST['delivery_entry_product_detail_product_type'];
		$delivery_entry_product_detail_product_id     		= $_POST['delivery_entry_product_detail_product_id'];
		$delivery_entry_product_detail_invoice_detail_id   	= $_POST['delivery_entry_product_detail_invoice_detail_id'];
		$delivery_entry_product_detail_width_inches  		= isset($_POST['delivery_entry_product_detail_width_inches'])?$_POST['delivery_entry_product_detail_width_inches']:'';
		$delivery_entry_product_detail_width_mm 		  	= isset($_POST['delivery_entry_product_detail_width_mm'])?$_POST['delivery_entry_product_detail_width_mm']:'';
		
		$delivery_entry_product_detail_sale_length		  	= isset($_POST['delivery_entry_product_detail_sale_length'])?$_POST['delivery_entry_product_detail_sale_length']:'';
		
		
	
	$delivery_entry_product_detail_s_width_inches 			= isset($_POST['delivery_entry_product_detail_s_width_inches'])?$_POST['delivery_entry_product_detail_s_width_inches']:'';
		$delivery_entry_product_detail_s_width_mm 			= isset($_POST['delivery_entry_product_detail_s_width_mm'])?$_POST['delivery_entry_product_detail_s_width_mm']:'';
		$delivery_entry_product_detail_sl_feet 		  		= isset($_POST['delivery_entry_product_detail_sl_feet'])?$_POST['delivery_entry_product_detail_sl_feet']:'';
		$delivery_entry_product_detail_sl_feet_in 			= isset($_POST['delivery_entry_product_detail_sl_feet_in'])?$_POST['delivery_entry_product_detail_sl_feet_in']:'';
		$delivery_entry_product_detail_sl_feet_mm 			= isset($_POST['delivery_entry_product_detail_sl_feet_mm'])?$_POST['delivery_entry_product_detail_sl_feet_mm']:'';
		$delivery_entry_product_detail_sl_feet_met 			= isset($_POST['delivery_entry_product_detail_sl_feet_met'])?$_POST['delivery_entry_product_detail_sl_feet_met']:'';
$delivery_entry_product_detail_s_weight_inches   			= isset($_POST['delivery_entry_product_detail_s_weight_inches'])?$_POST['delivery_entry_product_detail_s_weight_inches']:'';
		$delivery_entry_product_detail_s_weight_mm   		= isset($_POST['delivery_entry_product_detail_s_weight_mm'])?$_POST['delivery_entry_product_detail_s_weight_mm']:'';
		$delivery_entry_product_detail_qty 			 		= $_POST['delivery_entry_product_detail_qty'];
		$delivery_entry_product_detail_tot_length 			= isset($_POST['delivery_entry_product_detail_tot_length'])?$_POST['delivery_entry_product_detail_tot_length']:'';
		$delivery_entry_product_detail_rate 			  	= $_POST['delivery_entry_product_detail_rate'];
		$delivery_entry_product_detail_total 				= $_POST['delivery_entry_product_detail_total'];
		$delivery_entry_product_detail_product_thick 		= $_POST['delivery_entry_product_detail_product_thick'];
		$delivery_entry_product_detail_entry_type 			= $_POST['delivery_entry_product_detail_entry_type'];
		
		$delivery_entry_product_detail_sale_by			= isset($_POST['delivery_entry_product_detail_sale_by'])?$_POST['delivery_entry_product_detail_sale_by']:'';
		
		$request_fields 									= ((!empty($delivery_entry_branch_id)) && (!empty($delivery_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "delivery-entry/index.php?page=add&msg=5");		
		
				
		$delivery_entry_uniq_id								= generateUniqId();
		$ip													= getRealIpAddr();
		$insert_delivery_entry 								= sprintf("INSERT INTO delivery_entry  (delivery_entry_uniq_id, delivery_entry_date,
																					  		  delivery_entry_customer_id,delivery_entry_address,
																					  		  delivery_entry_vehicle_no,delivery_entry_person_name,
																					  		  delivery_entry_godown_id,delivery_entry_driver_name,
																							  delivery_entry_time,delivery_entry_no,
																					  		  delivery_entry_branch_id,delivery_entry_added_by,
																					   		  delivery_entry_added_on,delivery_entry_added_ip,
																			   		   		  delivery_entry_company_id,delivery_entry_financial_year,
																							  delivery_entry_invoice_entry_id,delivery_entry_type_id) 

																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%s', 
																							  '%s', '%s', 
																							  '%d', '%s', 
																							  '%s', '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d',
																							  '%d', '%s')", 
																		  	   		   		 $delivery_entry_uniq_id, $delivery_entry_date,
																					   		 $delivery_entry_customer_id,$delivery_entry_address,
																							 $delivery_entry_vehicle_no,$delivery_entry_person_name,
																					  		 $delivery_entry_godown_id,$delivery_entry_driver_name,
																					   		 $delivery_entry_time,$delivery_entry_no,
																					   		 $delivery_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $delivery_entry_invoice_entry_id,$delivery_entry_type_id);  

		mysql_query($insert_delivery_entry);
		//echo $insert_delivery_entry; exit;
		$delivery_entry_id 							= mysql_insert_id(); 
		// purchase order pproduct details
		for($i = 0; $i < count($delivery_entry_product_detail_product_id); $i++) { 
		
			if($delivery_entry_product_detail_sale_by[$i] == "QTY") {
				$delivery_entry_product_detail_qty_val 	= $delivery_entry_product_detail_qty[$i];
				$delivery_entry_product_detail_sale_feet_val = '';
			}else if($delivery_entry_product_detail_sale_by[$i] == "FEET"){
				$delivery_entry_product_detail_qty_val 	= '';
				$delivery_entry_product_detail_sale_feet_val = $delivery_entry_product_detail_qty[$i];
			}else{
				$delivery_entry_product_detail_qty_val 	= $delivery_entry_product_detail_qty[$i];
				$delivery_entry_product_detail_sale_feet_val = '';
			}
		// echo $delivery_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($delivery_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$delivery_entry_product_detail_uniq_id 	= generateUniqId();
				
				if(isset($delivery_entry_product_detail_sale_length[$i]) && $delivery_entry_product_detail_sale_length[$i] != ''){
					$sale_length 		  	= str_replace("&quot;",'"',$delivery_entry_product_detail_sale_length[$i]);
					$sale_length			= str_replace("&#039;","'",$sale_length);
					
				} else {
					$sale_length = '';
				}
		
				$insert_delivery_entry_product_detail 		= sprintf("INSERT INTO delivery_entry_product_details 
																				(delivery_entry_product_detail_uniq_id,delivery_entry_product_detail_delivery_entry_id,
																				 delivery_entry_product_detail_product_id,
																				 delivery_entry_product_detail_product_type, delivery_entry_product_detail_product_thick,
																				 delivery_entry_product_detail_width_inches,delivery_entry_product_detail_width_mm,
																				 delivery_entry_product_detail_s_width_inches,delivery_entry_product_detail_s_width_mm,delivery_entry_product_detail_sale_length,
																				 delivery_entry_product_detail_sl_feet,delivery_entry_product_detail_sl_feet_in,
																				 delivery_entry_product_detail_sl_feet_mm,delivery_entry_product_detail_sl_feet_met,
																				 delivery_entry_product_detail_s_weight_inches,delivery_entry_product_detail_s_weight_mm,
																				 delivery_entry_product_detail_qty,delivery_entry_product_detail_tot_length,
																				 delivery_entry_product_detail_rate,delivery_entry_product_detail_total,
																				 delivery_entry_product_detail_added_by, delivery_entry_product_detail_added_on,
																				 delivery_entry_product_detail_added_ip,delivery_entry_product_detail_invoice_detail_id,
																				 delivery_entry_product_detail_invoice_entry_id,delivery_entry_product_detail_entry_type,delivery_entry_product_detail_sale_by,delivery_entry_product_detail_sale_feet) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f','%s',																			
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d',
																				'%d', '%d','%s','%f')", 
																		 $delivery_entry_product_detail_uniq_id,$delivery_entry_id,
																		 $delivery_entry_product_detail_product_id[$i],
																		 $delivery_entry_product_detail_product_type[$i], $delivery_entry_product_detail_product_thick[$i],
																		 $delivery_entry_product_detail_width_inches[$i],$delivery_entry_product_detail_width_mm[$i],
																		 $delivery_entry_product_detail_s_width_inches[$i],$delivery_entry_product_detail_s_width_mm[$i],
																		 mysql_real_escape_string($sale_length),
																		 $delivery_entry_product_detail_sl_feet[$i],$delivery_entry_product_detail_sl_feet_in[$i],
																		 $delivery_entry_product_detail_sl_feet_mm[$i],$delivery_entry_product_detail_sl_feet_met[$i],
																		 $delivery_entry_product_detail_s_weight_inches[$i],$delivery_entry_product_detail_s_weight_mm[$i],
																		 $delivery_entry_product_detail_qty_val,$delivery_entry_product_detail_tot_length[$i],
																		 $delivery_entry_product_detail_rate[$i],$delivery_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$delivery_entry_product_detail_invoice_detail_id[$i],
																		 $delivery_entry_invoice_entry_id,$delivery_entry_product_detail_entry_type[$i],
																		 $delivery_entry_product_detail_sale_by[$i],
																		 $delivery_entry_product_detail_sale_feet_val);
																		// echo $insert_delivery_entry_product_detail; exit;
				mysql_query($insert_delivery_entry_product_detail);
				
						
			}
		}
		pageRedirection("delivery-entry/index.php?page=add&msg=1");

	}

	function listQuotation(){
	$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND delivery_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND delivery_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['customerid']))&& !empty($_REQUEST['customerid']))
		{
		$where.="AND delivery_entry_customer_id ='".$_REQUEST['customerid']."'";
		}

		 $select_delivery_entry		=	"SELECT 

												delivery_entry_id,

												delivery_entry_uniq_id,

												delivery_entry_no,

												delivery_entry_date,

												customer_name,

												delivery_entry_address,
												branch_prefix

											 FROM 

												delivery_entry
											 LEFT JOIN
												customers
											 ON
												customer_id		=  delivery_entry_customer_id
											 LEFT JOIN
												branches
											 ON
												branch_id					=  delivery_entry_branch_id
											 WHERE 

												delivery_entry_deleted_status 	= 	0 $where

											 ORDER BY 

												delivery_entry_no ASC";

		$result_delivery_entry		= mysql_query($select_delivery_entry);

		// Filling up the array

		$delivery_entry_data 		= array();

		while ($record_delivery_entry = mysql_fetch_array($result_delivery_entry))

		{

		 $delivery_entry_data[] 	= $record_delivery_entry;

		}

		return $delivery_entry_data;

	}

	function editQuotation(){

		$delivery_entry_id 			= getId('delivery_entry', 'delivery_entry_id', 'delivery_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_delivery_entry		=	"SELECT 
												delivery_entry_uniq_id,  delivery_entry_date,
												delivery_entry_customer_id,delivery_entry_address,
												delivery_entry_vehicle_no,delivery_entry_person_name,
												delivery_entry_godown_id,delivery_entry_driver_name,
												delivery_entry_time,
												delivery_entry_no,
												delivery_entry_branch_id,delivery_entry_id,
												invoice_entry_no,invoice_entry_date,
												delivery_entry_invoice_entry_id,
												delivery_entry_type_id,customer_name,customer_mobile_no,
												branch_prefix
											 FROM 
												delivery_entry
											LEFT JOIN
												invoice_entry
											ON
												invoice_entry_id				= delivery_entry_invoice_entry_id 
											LEFT JOIN
												customers
											ON
												customer_id						= delivery_entry_customer_id  
											LEFT JOIN
												salesmans
											ON
												salesman_id						= invoice_entry_salesman_id 
											 LEFT JOIN
												branches
											 ON
												branch_id					=  delivery_entry_branch_id		
											 WHERE 
												delivery_entry_deleted_status 	=  0 			AND 
												delivery_entry_id				= '".$delivery_entry_id."'
											 ORDER BY 
												delivery_entry_no ASC";

		$result_delivery_entry 		= mysql_query($select_delivery_entry);

		$record_delivery_entry 		= mysql_fetch_array($result_delivery_entry);

		return $record_delivery_entry;

	}

	function editQuotationProductDetail()

	{

		$delivery_entry_id 	= getId('delivery_entry', 'delivery_entry_id', 'delivery_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_delivery_entry_product_detail 	= "	SELECT 
															delivery_entry_product_detail_id,
															delivery_entry_product_detail_product_id,
															delivery_entry_product_detail_product_type,
															
															delivery_entry_product_detail_sale_by,
															delivery_entry_product_detail_sale_feet,
															delivery_entry_product_detail_width_inches,delivery_entry_product_detail_width_mm,
															delivery_entry_product_detail_s_width_inches,delivery_entry_product_detail_s_width_mm,delivery_entry_product_detail_sale_length,
															delivery_entry_product_detail_sl_feet,delivery_entry_product_detail_sl_feet_in,
															delivery_entry_product_detail_sl_feet_mm,delivery_entry_product_detail_s_weight_inches,
															delivery_entry_product_detail_s_weight_mm,delivery_entry_product_detail_tot_length,
															delivery_entry_product_detail_rate,delivery_entry_product_detail_sl_feet_met,
															delivery_entry_product_detail_total,delivery_entry_product_detail_qty,
															product_name,
															product_code,
															delivery_entry_product_detail_product_thick ,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															p_uom.product_uom_name as p_uom_name,
															child_uom.product_uom_name as c_uom_name,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name,
															delivery_entry_product_detail_entry_type
															
														FROM 
															delivery_entry_product_details 
														LEFT JOIN 
															invoice_entry_product_details 
														ON 
															invoice_entry_product_detail_id  		    = delivery_entry_product_detail_invoice_detail_id
														LEFT JOIN 
															quotation_entry_product_details 
														ON 
															quotation_entry_product_detail_id 			= invoice_entry_product_detail_quotation_detail_id
														LEFT JOIN 
															products 
														ON 
															product_id 									= delivery_entry_product_detail_product_id
														
														LEFT JOIN 
															brands 
														ON 
															brand_id 									= product_brand_id
															
														
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id	= delivery_entry_product_detail_product_id	
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 						= product_purchase_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 					= product_con_entry_child_product_detail_uom_id
														LEFT JOIN  
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 					= invoice_entry_product_detail_color_id
															
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 					= product_con_entry_child_product_detail_color_id
														WHERE 
															delivery_entry_product_detail_deleted_status		 	= 0 							AND 
															delivery_entry_product_detail_delivery_entry_id 		= '".$delivery_entry_id."'";
															//echo $select_delivery_entry_product_detail; exit;
		$result_delivery_entry_product_detail 	= mysql_query($select_delivery_entry_product_detail);

		$count_delivery_entry 					= mysql_num_rows($result_delivery_entry_product_detail);

		$arr_delivery_entry_product_detail 	= array();

		

		while($record_delivery_entry_product_detail = mysql_fetch_array($result_delivery_entry_product_detail)) {

			$arr_delivery_entry_product_detail[] = $record_delivery_entry_product_detail;

		}

		return $arr_delivery_entry_product_detail;

	}

	function updateQuotation(){

		$delivery_entry_id                   			= trim($_POST['delivery_entry_id']);

		$delivery_entry_uniq_id                			= trim($_POST['delivery_entry_uniq_id']);

		$delivery_entry_branch_id                   	= trim($_POST['delivery_entry_branch_id']);

		$delivery_entry_date                 			= NdateDatabaseFormat($_POST['delivery_entry_date']);

		$delivery_entry_customer_id            			= trim($_POST['delivery_entry_customer_id']);

		$delivery_entry_address      					= trim($_POST['delivery_entry_address']);

		$delivery_entry_vehicle_no            			= trim($_POST['delivery_entry_vehicle_no']);

		$delivery_entry_person_name                 	= trim($_POST['delivery_entry_person_name']);

		$delivery_entry_godown_id            			= trim($_POST['delivery_entry_godown_id']);

		$delivery_entry_driver_name            			= trim($_POST['delivery_entry_driver_name']);

		$delivery_entry_time                 			= NdateDatabaseFormat($_POST['delivery_entry_time']);

		$delivery_entry_invoice_entry_id              	= NdateDatabaseFormat($_POST['delivery_entry_invoice_entry_id']);

		

		//Product Detail

		$delivery_entry_product_detail_id      				= $_POST['delivery_entry_product_detail_id'];
		$delivery_entry_product_detail_product_type      		= $_POST['delivery_entry_product_detail_product_type'];
		$delivery_entry_product_detail_product_id     		= $_POST['delivery_entry_product_detail_product_id'];
		$delivery_entry_product_detail_invoice_detail_id   	= $_POST['delivery_entry_product_detail_invoice_detail_id'];
		$delivery_entry_product_detail_width_inches  		= isset($_POST['delivery_entry_product_detail_width_inches'])?$_POST['delivery_entry_product_detail_width_inches']:'';
		$delivery_entry_product_detail_width_mm 		  	= isset($_POST['delivery_entry_product_detail_width_mm'])?$_POST['delivery_entry_product_detail_width_mm']:'';
	$delivery_entry_product_detail_s_width_inches 		= isset($_POST['delivery_entry_product_detail_s_width_inches'])?$_POST['delivery_entry_product_detail_s_width_inches']:'';
		$delivery_entry_product_detail_s_width_mm 			= isset($_POST['delivery_entry_product_detail_s_width_mm'])?$_POST['delivery_entry_product_detail_s_width_mm']:'';
		
		$delivery_entry_product_detail_sale_length 			= isset($_POST['delivery_entry_product_detail_sale_length'])?$_POST['delivery_entry_product_detail_sale_length']:'';
		
		$delivery_entry_product_detail_sl_feet 		  		= isset($_POST['delivery_entry_product_detail_sl_feet'])?$_POST['delivery_entry_product_detail_sl_feet']:'';
		$delivery_entry_product_detail_sl_feet_in 			= isset($_POST['delivery_entry_product_detail_sl_feet_in'])?$_POST['delivery_entry_product_detail_sl_feet_in']:'';
		$delivery_entry_product_detail_sl_feet_mm 			= isset($_POST['delivery_entry_product_detail_sl_feet_mm'])?$_POST['delivery_entry_product_detail_sl_feet_mm']:'';
$delivery_entry_product_detail_s_weight_inches   		= isset($_POST['delivery_entry_product_detail_s_weight_inches'])?$_POST['delivery_entry_product_detail_s_weight_inches']:'';
		$delivery_entry_product_detail_sl_feet_met 			= isset($_POST['delivery_entry_product_detail_sl_feet_met'])?$_POST['delivery_entry_product_detail_sl_feet_met']:'';
		$delivery_entry_product_detail_s_weight_mm   		= isset($_POST['delivery_entry_product_detail_s_weight_mm'])?$_POST['delivery_entry_product_detail_s_weight_mm']:'';
		$delivery_entry_product_detail_qty 			 		= $_POST['delivery_entry_product_detail_qty'];
		$delivery_entry_product_detail_tot_length 			= isset($_POST['delivery_entry_product_detail_tot_length'])?$_POST['delivery_entry_product_detail_tot_length']:'';
		$delivery_entry_product_detail_rate 			  		= $_POST['delivery_entry_product_detail_rate'];
		$delivery_entry_product_detail_total 				= $_POST['delivery_entry_product_detail_total'];
		$delivery_entry_product_detail_product_thick 		= $_POST['delivery_entry_product_detail_product_thick'];
		
		$delivery_entry_product_detail_sale_by			= isset($_POST['delivery_entry_product_detail_sale_by'])?$_POST['delivery_entry_product_detail_sale_by']:'';

		$request_fields 								= ((!empty($delivery_entry_branch_id)) && (!empty($delivery_entry_date)));

		$stock_ledger_entry_type						= 'dc-sale';

		checkRequestFields($request_fields, PROJECT_PATH, "delivery-entry/index.php?page=edit&id=$delivery_entry_uniq_id");

		$ip												= getRealIpAddr();

		 $update_customer 					= sprintf("	UPDATE 

															delivery_entry 

														SET 

															delivery_entry_branch_id 				= '%d',

															delivery_entry_date 					= '%s',

															delivery_entry_customer_id 				= '%d',

															delivery_entry_address 					= '%s',

															delivery_entry_vehicle_no 				= '%s',

															delivery_entry_person_name 				= '%s',

															delivery_entry_godown_id 				= '%d',

															delivery_entry_driver_name 				= '%s',

															delivery_entry_time 					= '%s',

															delivery_entry_modified_by 				= '%d',

															delivery_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															delivery_entry_modified_ip				= '%s'

														WHERE               

															delivery_entry_id         				= '%d'", 

															$delivery_entry_branch_id,

															$delivery_entry_date,

															$delivery_entry_customer_id,

															$delivery_entry_address,

															$delivery_entry_vehicle_no,

															$delivery_entry_person_name,

															$delivery_entry_godown_id,

															$delivery_entry_driver_name,

															$delivery_entry_time,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$delivery_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($delivery_entry_product_detail_product_id); $i++) {
			
			if($delivery_entry_product_detail_sale_by[$i] == "QTY") {
				$delivery_entry_product_detail_qty_val 	= $delivery_entry_product_detail_qty[$i];
				$delivery_entry_product_detail_sale_feet_val = '';
			}else if($delivery_entry_product_detail_sale_by[$i] == "FEET"){
				$delivery_entry_product_detail_qty_val 	= '';
				$delivery_entry_product_detail_sale_feet_val = $delivery_entry_product_detail_qty[$i];
			}else{
				$delivery_entry_product_detail_qty_val 	= $delivery_entry_product_detail_qty[$i];
				$delivery_entry_product_detail_sale_feet_val = '';
			}

			$detail_request_fields = ((!empty($delivery_entry_product_detail_product_id[$i])));

			if($detail_request_fields) {
				
				if(isset($delivery_entry_product_detail_sale_length[$i]) && $delivery_entry_product_detail_sale_length[$i] != ''){
					$sale_length 		  	= str_replace("&quot;",'"',$delivery_entry_product_detail_sale_length[$i]);
					$sale_length			= str_replace("&#039;","'",$sale_length);
					
				} else {
					$sale_length = '';
				}

				if(isset($delivery_entry_product_detail_id[$i]) && (!empty($delivery_entry_product_detail_id[$i]))) {
					 $update_delivery_entry_product_detail = sprintf("UPDATE 
																			delivery_entry_product_details 
																		SET  
																			delivery_entry_product_detail_width_inches  			= '%f',
																			delivery_entry_product_detail_width_mm  				= '%f',
																			delivery_entry_product_detail_s_width_inches  			= '%f',
																			delivery_entry_product_detail_s_width_mm  				= '%f',
																			delivery_entry_product_detail_sale_length  				= '%s',
																			delivery_entry_product_detail_sl_feet  					= '%f',
																			delivery_entry_product_detail_sl_feet_in  				= '%f',
																			delivery_entry_product_detail_sl_feet_mm  				= '%f',
																			delivery_entry_product_detail_s_weight_inches  			= '%f',
																			delivery_entry_product_detail_s_weight_mm  				= '%f',
																			delivery_entry_product_detail_tot_length  				= '%f',
																			delivery_entry_product_detail_qty  						= '%f',
																			delivery_entry_product_detail_rate  					= '%f',
																			delivery_entry_product_detail_total  					= '%f',
																			delivery_entry_product_detail_modified_by 				= '%d',
																			delivery_entry_product_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																			delivery_entry_product_detail_modified_ip 				= '%s',
																			delivery_entry_product_detail_sale_by					= '%s',
																			delivery_entry_product_detail_sale_feet 				= '%f'
																		WHERE 
																			delivery_entry_product_detail_delivery_entry_id 	= '%d' AND 
																			delivery_entry_product_detail_id 					= '%d'",
																			$delivery_entry_product_detail_width_inches[$i],
																			$delivery_entry_product_detail_width_mm[$i],
																			$delivery_entry_product_detail_s_width_inches[$i],
																			$delivery_entry_product_detail_s_width_mm[$i],
																			mysql_real_escape_string($sale_length),
																			$delivery_entry_product_detail_sl_feet[$i],
																			$delivery_entry_product_detail_sl_feet_in[$i],
																			$delivery_entry_product_detail_sl_feet_mm[$i],
																			$delivery_entry_product_detail_s_weight_inches[$i],
																			$delivery_entry_product_detail_s_weight_mm[$i],
																			$delivery_entry_product_detail_tot_length[$i],
																			$delivery_entry_product_detail_qty_val,
																			$delivery_entry_product_detail_rate[$i],
																			$delivery_entry_product_detail_total[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$delivery_entry_product_detail_sale_by[$i],
																			$delivery_entry_product_detail_sale_feet_val,
																			$delivery_entry_id, 
																			$delivery_entry_product_detail_id[$i]);	
			//	echo $update_delivery_entry_product_detail; exit;
					mysql_query($update_delivery_entry_product_detail);
					$detail_id			= $delivery_entry_product_detail_id[$i];
					
				/*$length_inches										= 	$delivery_entry_product_detail_length_feet[$i];
				$width_inches										= 	"3";
				$delivery_entry_detail_id							= 	$delivery_entry_product_detail_id[$i];
				$stock_ledger_prd_type								= 	$delivery_entry_product_detail_type[$i];
				stockLedger('out', $delivery_entry_id, $delivery_entry_detail_id,$delivery_entry_product_detail_product_id[$i],$length_inches,$width_inches, ($delivery_entry_product_detail_qty[$i]*-1), $delivery_entry_branch_id, $delivery_entry_customer_id, $delivery_entry_godown_id, $delivery_entry_date, $delivery_entry_no,$stock_ledger_entry_type,$stock_ledger_prd_type);*/
				} else {

				$delivery_entry_product_detail_uniq_id = generateUniqId();

				$insert_delivery_entry_product_detail 		= sprintf("INSERT INTO delivery_entry_product_details 
																				(delivery_entry_product_detail_uniq_id,delivery_entry_product_detail_delivery_entry_id,
																				 delivery_entry_product_detail_product_id,
																				 delivery_entry_product_detail_product_type, delivery_entry_product_detail_product_thick,
																				 delivery_entry_product_detail_width_inches,delivery_entry_product_detail_width_mm,
																				 delivery_entry_product_detail_s_width_inches,delivery_entry_product_detail_s_width_mm,delivery_entry_product_detail_sale_length,
																				 delivery_entry_product_detail_sl_feet,delivery_entry_product_detail_sl_feet_in,
																				 delivery_entry_product_detail_sl_feet_mm,delivery_entry_product_detail_sl_feet_met,
																				 delivery_entry_product_detail_s_weight_inches,delivery_entry_product_detail_s_weight_mm,
																				 delivery_entry_product_detail_qty,delivery_entry_product_detail_tot_length,
																				 delivery_entry_product_detail_rate,delivery_entry_product_detail_total,
																				 delivery_entry_product_detail_added_by, delivery_entry_product_detail_added_on,
																				 delivery_entry_product_detail_added_ip,delivery_entry_product_detail_invoice_detail_id,
																				 delivery_entry_product_detail_invoice_entry_id, delivery_entry_product_detail_sale_by, delivery_entry_product_detail_sale_feet) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', '%s',
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d',
																				'%d','%s','%f')", 
																		 $delivery_entry_product_detail_uniq_id,$delivery_entry_id,
																		 $delivery_entry_product_detail_product_id[$i],
																		 $delivery_entry_product_detail_product_type[$i], $delivery_entry_product_detail_product_thick[$i],
																		 $delivery_entry_product_detail_width_inches[$i],$delivery_entry_product_detail_width_mm[$i],
																		 $delivery_entry_product_detail_s_width_inches[$i],$delivery_entry_product_detail_s_width_mm[$i],
																		 mysql_real_escape_string($sale_length),
																		 $delivery_entry_product_detail_sl_feet[$i],$delivery_entry_product_detail_sl_feet_in[$i],
																		 $delivery_entry_product_detail_sl_feet_mm[$i],$delivery_entry_product_detail_sl_feet_met[$i],
																		 $delivery_entry_product_detail_s_weight_inches[$i],$delivery_entry_product_detail_s_weight_mm[$i],
																		 $delivery_entry_product_detail_qty_val,$delivery_entry_product_detail_tot_length[$i],
																		 $delivery_entry_product_detail_rate[$i],$delivery_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$delivery_entry_product_detail_invoice_detail_id[$i],
																		 $delivery_entry_invoice_entry_id,
																		 $delivery_entry_product_detail_sale_by[$i],
																		 $delivery_entry_product_detail_sale_feet_val);
																		// echo $insert_delivery_entry_product_detail; exit;
				mysql_query($insert_delivery_entry_product_detail);
				$detail_id  = mysql_insert_id();
				}
				
				
			}
		}
		pageRedirection("delivery-entry/index.php?page=edit&id=$delivery_entry_uniq_id&msg=2");			
	}
    function deleteProductdetail()
   {
		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['delivery_entry_uniq_id'])))
		{
			$product_detail_id 	= $_GET['product_detail_id'];
			$delivery_entry_uniq_id = $_GET['delivery_entry_uniq_id'];
			mysql_query("UPDATE delivery_entry_product_details SET delivery_entry_product_detail_deleted_status = 1 
						WHERE delivery_entry_product_detail_id = ".$product_detail_id." ");
			header("Location:index.php?page=edit&id=$delivery_entry_uniq_id&msg=6");
		}
   } 		
	function deleteInventoryrequest(){

		deleteUniqRecords('delivery_entry', 'delivery_entry_deleted_by', 'delivery_entry_deleted_on' , 'delivery_entry_deleted_ip','delivery_entry_deleted_status', 'delivery_entry_id', 'delivery_entry_uniq_id', '1');

		

		deleteMultiRecords('delivery_entry_product_details', 'delivery_entry_product_detail_deleted_by', 'delivery_entry_product_detail_deleted_on', 'delivery_entry_product_detail_deleted_ip', 'delivery_entry_product_detail_deleted_status', 'delivery_entry_product_detail_delivery_entry_id', 'delivery_entry','delivery_entry_id','delivery_entry_uniq_id', '1');  



		

		pageRedirection("delivery-entry/index.php?msg=7");				

	}

?>