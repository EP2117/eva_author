<?php
	function GetAutoNo(){
		$select_invoice_no = "SELECT MAX(delivery_customer_no) AS maxval FROM delivery_customer 
								  WHERE delivery_customer_deleted_status =0
								  AND delivery_customer_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND delivery_customer_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval = $record_invoice_no['maxval']; 

		if($maxval > 0) {

			$delivery_customer_no = substr(('00000'.++$maxval),-5);

		} else {

			$delivery_customer_no = substr(('00000'.++$maxval),-5);

		}
		return $delivery_customer_no;
	}
	function insertQuotation(){

		$delivery_customer_no                   				= trim($_POST['delivery_customer_no']);
		$delivery_customer_branch_id                   		= trim($_POST['delivery_customer_branch_id']);
		$delivery_customer_date                 				= NdateDatabaseFormat($_POST['delivery_customer_date']);
		$delivery_customer_customer_id            				= trim($_POST['delivery_customer_customer_id']);
		$delivery_customer_address                 			= trim($_POST['delivery_customer_address']);
		$delivery_customer_vehicle_no            				= trim($_POST['delivery_customer_vehicle_no']);
		$delivery_customer_delivery_type                 		= trim($_POST['delivery_customer_delivery_type']);
		$delivery_customer_godown_id            				= trim($_POST['delivery_customer_godown_id']);
		$delivery_customer_driver_name            				= trim($_POST['delivery_customer_driver_name']);
		$delivery_customer_time                 				= trim($_POST['delivery_customer_time']);
		$delivery_customer_invoice_entry_id              		= trim($_POST['delivery_customer_invoice_entry_id']);
		$delivery_customer_type_id              				= trim($_POST['delivery_customer_type_id']);
		$stock_ledger_entry_type								= 'dc-sale';
		//Product Detail
		$delivery_customer_product_detail_product_type      	= $_POST['delivery_customer_product_detail_product_type'];
		$delivery_customer_product_detail_product_id     		= $_POST['delivery_customer_product_detail_product_id'];
		$delivery_customer_product_detail_invoice_detail_id   	= $_POST['delivery_customer_product_detail_invoice_detail_id'];
		$delivery_customer_product_detail_width_inches  		= isset($_POST['delivery_customer_product_detail_width_inches'])?$_POST['delivery_customer_product_detail_width_inches']:'';
		$delivery_customer_product_detail_width_mm 		  	= isset($_POST['delivery_customer_product_detail_width_mm'])?$_POST['delivery_customer_product_detail_width_mm']:'';
	$delivery_customer_product_detail_s_width_inches 		= isset($_POST['delivery_customer_product_detail_s_width_inches'])?$_POST['delivery_customer_product_detail_s_width_inches']:'';
		$delivery_customer_product_detail_s_width_mm 			= isset($_POST['delivery_customer_product_detail_s_width_mm'])?$_POST['delivery_customer_product_detail_s_width_mm']:'';
		$delivery_customer_product_detail_sl_feet 		  		= isset($_POST['delivery_customer_product_detail_sl_feet'])?$_POST['delivery_customer_product_detail_sl_feet']:'';
		$delivery_customer_product_detail_sl_feet_in 			= isset($_POST['delivery_customer_product_detail_sl_feet_in'])?$_POST['delivery_customer_product_detail_sl_feet_in']:'';
		$delivery_customer_product_detail_sl_feet_mm 			= isset($_POST['delivery_customer_product_detail_sl_feet_mm'])?$_POST['delivery_customer_product_detail_sl_feet_mm']:'';
		$delivery_customer_product_detail_sl_feet_met 			= isset($_POST['delivery_customer_product_detail_sl_feet_met'])?$_POST['delivery_customer_product_detail_sl_feet_met']:'';
$delivery_customer_product_detail_s_weight_inches   			= isset($_POST['delivery_customer_product_detail_s_weight_inches'])?$_POST['delivery_customer_product_detail_s_weight_inches']:'';
		$delivery_customer_product_detail_s_weight_mm   		= isset($_POST['delivery_customer_product_detail_s_weight_mm'])?$_POST['delivery_customer_product_detail_s_weight_mm']:'';
		$delivery_customer_product_detail_qty 			 		= $_POST['delivery_customer_product_detail_qty'];
		$delivery_customer_product_detail_tot_length 			= isset($_POST['delivery_customer_product_detail_tot_length'])?$_POST['delivery_customer_product_detail_tot_length']:'';
		$delivery_customer_product_detail_rate 			  		= $_POST['delivery_customer_product_detail_rate'];
		$delivery_customer_product_detail_total 				= $_POST['delivery_customer_product_detail_total'];
		$delivery_customer_product_detail_color_id 				= isset($_POST['delivery_customer_product_detail_color_id'])?$_POST['delivery_customer_product_detail_color_id']:'';
		$delivery_customer_product_detail_product_thick 			= isset($_POST['delivery_customer_product_detail_product_thick'])?$_POST['delivery_customer_product_detail_product_thick']:'';
		$delivery_customer_product_detail_entry_type			= $_POST['delivery_customer_product_detail_entry_type'];
		
		$request_fields 									= ((!empty($delivery_customer_branch_id)) && (!empty($delivery_customer_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "delivery-customer/index.php?page=add&msg=5");
		$delivery_customer_uniq_id								= generateUniqId();
		$ip													= getRealIpAddr();
		$insert_delivery_customer 								= sprintf("INSERT INTO delivery_customer  (delivery_customer_uniq_id, delivery_customer_date,
																					  		  delivery_customer_customer_id,delivery_customer_address,
																					  		  delivery_customer_vehicle_no,delivery_customer_delivery_type,
																					  		  delivery_customer_godown_id,delivery_customer_driver_name,
																							  delivery_customer_time,delivery_customer_no,
																					  		  delivery_customer_branch_id,delivery_customer_added_by,
																					   		  delivery_customer_added_on,delivery_customer_added_ip,
																			   		   		  delivery_customer_company_id,delivery_customer_financial_year,
																							  delivery_customer_invoice_entry_id,delivery_customer_type_id) 

																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%s', 
																							  '%s', '%s', 
																							  '%d', '%s', 
																							  '%s', '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d',
																							  '%d', '%s')", 
																		  	   		   		 $delivery_customer_uniq_id, $delivery_customer_date,
																					   		 $delivery_customer_customer_id,$delivery_customer_address,
																							 $delivery_customer_vehicle_no,$delivery_customer_delivery_type,
																					  		 $delivery_customer_godown_id,$delivery_customer_driver_name,
																					   		 $delivery_customer_time,$delivery_customer_no,
																					   		 $delivery_customer_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $delivery_customer_invoice_entry_id,$delivery_customer_type_id);  

		mysql_query($insert_delivery_customer);
		//echo $insert_delivery_customer; exit;
		$delivery_customer_id 							= mysql_insert_id(); 
		// purchase order pproduct details
		for($i = 0; $i < count($delivery_customer_product_detail_product_id); $i++) { 
		// echo $delivery_customer_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($delivery_customer_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$delivery_customer_product_detail_uniq_id 	= generateUniqId();
				$insert_delivery_customer_product_detail 		= sprintf("INSERT INTO delivery_customer_product_details 
																				(delivery_customer_product_detail_uniq_id,delivery_customer_product_detail_delivery_customer_id,
																				 delivery_customer_product_detail_product_id,
																				 delivery_customer_product_detail_product_type, delivery_customer_product_detail_product_thick,
																				 delivery_customer_product_detail_width_inches,delivery_customer_product_detail_width_mm,
																				 delivery_customer_product_detail_s_width_inches,delivery_customer_product_detail_s_width_mm,
																				 delivery_customer_product_detail_sl_feet,delivery_customer_product_detail_sl_feet_in,
																				 delivery_customer_product_detail_sl_feet_mm,delivery_customer_product_detail_sl_feet_met,
																				 delivery_customer_product_detail_s_weight_inches,delivery_customer_product_detail_s_weight_mm,
																				 delivery_customer_product_detail_qty,delivery_customer_product_detail_tot_length,
																				 delivery_customer_product_detail_rate,delivery_customer_product_detail_total,
																				 delivery_customer_product_detail_added_by, delivery_customer_product_detail_added_on,
																				 delivery_customer_product_detail_added_ip,delivery_customer_product_detail_invoice_detail_id,
																				 delivery_customer_product_detail_invoice_entry_id,delivery_customer_product_detail_color_id,
																				 delivery_customer_product_detail_entry_type) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d',
																				'%d', '%d',
																				'%d')", 
																		 $delivery_customer_product_detail_uniq_id,$delivery_customer_id,
																		 $delivery_customer_product_detail_product_id[$i],
																		 $delivery_customer_product_detail_product_type[$i], $delivery_customer_product_detail_product_thick[$i],
																		 $delivery_customer_product_detail_width_inches[$i],$delivery_customer_product_detail_width_mm[$i],
																		 $delivery_customer_product_detail_s_width_inches[$i],$delivery_customer_product_detail_s_width_mm[$i],
																		 $delivery_customer_product_detail_sl_feet[$i],$delivery_customer_product_detail_sl_feet_in[$i],
																		 $delivery_customer_product_detail_sl_feet_mm[$i],$delivery_customer_product_detail_sl_feet_met[$i],
																		 $delivery_customer_product_detail_s_weight_inches[$i],$delivery_customer_product_detail_s_weight_mm[$i],
																		 $delivery_customer_product_detail_qty[$i],$delivery_customer_product_detail_tot_length[$i],
																		 $delivery_customer_product_detail_rate[$i],$delivery_customer_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$delivery_customer_product_detail_invoice_detail_id[$i],
																		 $delivery_customer_invoice_entry_id,$delivery_customer_product_detail_color_id[$i],
																		 $delivery_customer_product_detail_entry_type[$i]);
																		// echo $insert_delivery_customer_product_detail; exit;
				mysql_query($insert_delivery_customer_product_detail);
					$detail_id			= mysql_insert_id();



				if($delivery_customer_product_detail_entry_type[$i]==4){
							$produt_id											=	$delivery_customer_product_detail_product_id[$i];
							$product_colour_id									=	1;
							$product_thick										=	1;
							$width_inches										= 	1;
							$width_mm											= 	1;
							$length_feet										= 	1;
							$length_meter										= 	1;
							$product_detail_qty									= 	(-1*$delivery_customer_product_detail_qty[$i]);
							$stock_ledger_entry_type							= 	"production-entry-fin";
							if($_SESSION[SESS.'_session_user_branch_type']==1){
								$product_con_entry_godown_id						= 	"1";
								stockLedger('out',$delivery_customer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $delivery_customer_branch_id,  $product_con_entry_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
							else{
								$product_con_entry_godown_id						= 	$delivery_customer_godown_id;
								stockLedger('out',$delivery_customer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $delivery_customer_branch_id,  $product_con_entry_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
				}
				else{		
							$produt_id											=	$delivery_customer_product_detail_product_id[$i];
							$product_colour_id									=	$delivery_customer_product_detail_color_id[$i];
							$product_thick										=	$delivery_customer_product_detail_product_thick[$i];
							$width_inches										= 	$delivery_customer_product_detail_width_inches[$i];
							$width_mm											= 	$delivery_customer_product_detail_width_mm[$i];
							$length_feet										= 	$delivery_customer_product_detail_sl_feet[$i];
							$length_meter										= 	$delivery_customer_product_detail_sl_feet_met[$i];
							if($delivery_customer_product_detail_entry_type[$i]==1){
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$get_raw_val['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$ton_qty										= 	$total_ton*$length_feet;
								$kg_qty											= 	$ton_qty*1000;
								$product_detail_qty									= 	(-1*$delivery_customer_product_detail_qty[$i]);
							}
							else{
								$ton_qty										= 	$delivery_customer_product_detail_s_weight_inches[$i];
								$kg_qty											= 	$delivery_customer_product_detail_s_weight_mm[$i];
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$get_raw_val['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$length_feet									= 	($delivery_customer_product_detail_sl_feet[$i]/$total_ton);
								
								$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
								$length_meter									= 	$product_cal['3'];
								$product_detail_qty								=  1;
								
							}
							$stock_ledger_entry_type							= 	"delivery-customer";
							if($_SESSION[SESS.'_session_user_branch_type']==1){
								$product_con_entry_godown_id						= 	"1";
								stockLedger('out',$delivery_customer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $delivery_customer_branch_id,  $product_con_entry_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
							else{
								$product_con_entry_godown_id						= 	$delivery_customer_godown_id;
								stockLedger('out',$delivery_customer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $delivery_customer_branch_id,  $product_con_entry_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
				}				
			}
		}
		pageRedirection("delivery-customer/index.php?page=add&msg=1");

	}

	function listQuotation(){

		$select_delivery_customer		=	"SELECT 

												delivery_customer_id,

												delivery_customer_uniq_id,

												delivery_customer_no,

												delivery_customer_date,

												customer_name,

												delivery_customer_address

											 FROM 

												delivery_customer

											 LEFT JOIN

												customers

											 ON

												customer_id		=  delivery_customer_customer_id

											 WHERE 

												delivery_customer_deleted_status 	= 	0 

											 ORDER BY 

												delivery_customer_no ASC";

		$result_delivery_customer		= mysql_query($select_delivery_customer);

		// Filling up the array

		$delivery_customer_data 		= array();

		while ($record_delivery_customer = mysql_fetch_array($result_delivery_customer))

		{

		 $delivery_customer_data[] 	= $record_delivery_customer;

		}

		return $delivery_customer_data;

	}

	function editQuotation(){

		$delivery_customer_id 			= getId('delivery_customer', 'delivery_customer_id', 'delivery_customer_uniq_id', dataValidation($_GET['id'])); 

		$select_delivery_customer		=	"SELECT 

												delivery_customer_uniq_id,  delivery_customer_date,

												delivery_customer_customer_id,delivery_customer_address,

												delivery_customer_vehicle_no,delivery_customer_delivery_type,

												delivery_customer_godown_id,delivery_customer_driver_name,

												delivery_customer_time,

												delivery_customer_no,

												delivery_customer_branch_id,delivery_customer_id,

												invoice_entry_no,invoice_entry_date,

												delivery_customer_invoice_entry_id,
												delivery_customer_type_id

											 FROM 

												delivery_customer

											LEFT JOIN

												invoice_entry

											ON

												invoice_entry_id				= delivery_customer_invoice_entry_id 

											 WHERE 

												delivery_customer_deleted_status 	=  0 			AND 

												delivery_customer_id				= '".$delivery_customer_id."'

											 ORDER BY 

												delivery_customer_no ASC";

		$result_delivery_customer 		= mysql_query($select_delivery_customer);

		$record_delivery_customer 		= mysql_fetch_array($result_delivery_customer);

		return $record_delivery_customer;

	}

	function editQuotationProductDetail()

	{

		$delivery_customer_id 	= getId('delivery_customer', 'delivery_customer_id', 'delivery_customer_uniq_id', dataValidation($_GET['id'])); 

		$select_delivery_customer_product_detail 	= "	SELECT 
															delivery_customer_product_detail_id,
															delivery_customer_product_detail_product_id,
															delivery_customer_product_detail_width_inches,delivery_customer_product_detail_width_mm,
															delivery_customer_product_detail_s_width_inches,delivery_customer_product_detail_s_width_mm,
															delivery_customer_product_detail_sl_feet,delivery_customer_product_detail_sl_feet_in,
															delivery_customer_product_detail_sl_feet_mm,delivery_customer_product_detail_s_weight_inches,
															delivery_customer_product_detail_s_weight_mm,delivery_customer_product_detail_tot_length,
															delivery_customer_product_detail_rate,delivery_customer_product_detail_sl_feet_met,
															delivery_customer_product_detail_total,delivery_customer_product_detail_qty,
															product_name,
															product_code,
															delivery_customer_product_detail_product_thick ,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															p_uom.product_uom_name as p_uom_name,
															child_uom.product_uom_name as c_uom_name,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name,
															delivery_customer_product_detail_entry_type
															
														FROM 
															delivery_customer_product_details 
														LEFT JOIN 
															invoice_entry_product_details 
														ON 
															invoice_entry_product_detail_id  		    = delivery_customer_product_detail_invoice_detail_id
														LEFT JOIN 
															quotation_entry_product_details 
														ON 
															quotation_entry_product_detail_id 			= invoice_entry_product_detail_quotation_detail_id
														
														LEFT JOIN 
															products 
														ON 
															product_id 									= delivery_customer_product_detail_product_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 									= product_brand_id	
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id	= delivery_customer_product_detail_product_id	
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
															p_clr.product_colour_id 					= delivery_customer_product_detail_color_id
															
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 					= delivery_customer_product_detail_color_id
														WHERE 
															delivery_customer_product_detail_deleted_status		 	= 0 							AND 
															delivery_customer_product_detail_delivery_customer_id 		= '".$delivery_customer_id."'";
		$result_delivery_customer_product_detail 	= mysql_query($select_delivery_customer_product_detail);

		$count_delivery_customer 					= mysql_num_rows($result_delivery_customer_product_detail);

		$arr_delivery_customer_product_detail 	= array();

		

		while($record_delivery_customer_product_detail = mysql_fetch_array($result_delivery_customer_product_detail)) {

			$arr_delivery_customer_product_detail[] = $record_delivery_customer_product_detail;

		}

		return $arr_delivery_customer_product_detail;

	}

	function updateQuotation(){

		$delivery_customer_id                   			= trim($_POST['delivery_customer_id']);

		$delivery_customer_uniq_id                			= trim($_POST['delivery_customer_uniq_id']);

		$delivery_customer_branch_id                   	= trim($_POST['delivery_customer_branch_id']);

		$delivery_customer_date                 			= NdateDatabaseFormat($_POST['delivery_customer_date']);

		$delivery_customer_customer_id            			= trim($_POST['delivery_customer_customer_id']);

		$delivery_customer_address      					= trim($_POST['delivery_customer_address']);

		$delivery_customer_vehicle_no            			= trim($_POST['delivery_customer_vehicle_no']);

		$delivery_customer_delivery_type                 	= trim($_POST['delivery_customer_delivery_type']);

		$delivery_customer_godown_id            			= trim($_POST['delivery_customer_godown_id']);

		$delivery_customer_driver_name            			= trim($_POST['delivery_customer_driver_name']);

		$delivery_customer_time                 			= NdateDatabaseFormat($_POST['delivery_customer_time']);

		$delivery_customer_invoice_entry_id              	= NdateDatabaseFormat($_POST['delivery_customer_invoice_entry_id']);

		

		//Product Detail

		$delivery_customer_product_detail_id      				= $_POST['delivery_customer_product_detail_id'];
		$delivery_customer_product_detail_product_type      		= $_POST['delivery_customer_product_detail_product_type'];
		$delivery_customer_product_detail_product_id     		= $_POST['delivery_customer_product_detail_product_id'];
		$delivery_customer_product_detail_invoice_detail_id   	= $_POST['delivery_customer_product_detail_invoice_detail_id'];
		$delivery_customer_product_detail_width_inches  		= isset($_POST['delivery_customer_product_detail_width_inches'])?$_POST['delivery_customer_product_detail_width_inches']:'';
		$delivery_customer_product_detail_width_mm 		  	= isset($_POST['delivery_customer_product_detail_width_mm'])?$_POST['delivery_customer_product_detail_width_mm']:'';
	$delivery_customer_product_detail_s_width_inches 		= isset($_POST['delivery_customer_product_detail_s_width_inches'])?$_POST['delivery_customer_product_detail_s_width_inches']:'';
		$delivery_customer_product_detail_s_width_mm 			= isset($_POST['delivery_customer_product_detail_s_width_mm'])?$_POST['delivery_customer_product_detail_s_width_mm']:'';
		$delivery_customer_product_detail_sl_feet 		  		= isset($_POST['delivery_customer_product_detail_sl_feet'])?$_POST['delivery_customer_product_detail_sl_feet']:'';
		$delivery_customer_product_detail_sl_feet_in 			= isset($_POST['delivery_customer_product_detail_sl_feet_in'])?$_POST['delivery_customer_product_detail_sl_feet_in']:'';
		$delivery_customer_product_detail_sl_feet_mm 			= isset($_POST['delivery_customer_product_detail_sl_feet_mm'])?$_POST['delivery_customer_product_detail_sl_feet_mm']:'';
		$delivery_customer_product_detail_sl_feet_met 			= isset($_POST['delivery_customer_product_detail_sl_feet_met'])?$_POST['delivery_customer_product_detail_sl_feet_met']:'';
$delivery_customer_product_detail_s_weight_inches   		= isset($_POST['delivery_customer_product_detail_s_weight_inches'])?$_POST['delivery_customer_product_detail_s_weight_inches']:'';
		$delivery_customer_product_detail_s_weight_mm   		= isset($_POST['delivery_customer_product_detail_s_weight_mm'])?$_POST['delivery_customer_product_detail_s_weight_mm']:'';
		$delivery_customer_product_detail_qty 			 		= $_POST['delivery_customer_product_detail_qty'];
		$delivery_customer_product_detail_tot_length 			= isset($_POST['delivery_customer_product_detail_tot_length'])?$_POST['delivery_customer_product_detail_tot_length']:'';
		$delivery_customer_product_detail_rate 			  		= $_POST['delivery_customer_product_detail_rate'];
		$delivery_customer_product_detail_total 				= $_POST['delivery_customer_product_detail_total'];

		$request_fields 								= ((!empty($delivery_customer_branch_id)) && (!empty($delivery_customer_date)));

		$stock_ledger_entry_type						= 'dc-sale';

		checkRequestFields($request_fields, PROJECT_PATH, "delivery-customer/index.php?page=edit&id=$delivery_customer_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 

															delivery_customer 

														SET 

															delivery_customer_branch_id 				= '%d',

															delivery_customer_date 					= '%s',

															delivery_customer_customer_id 				= '%d',

															delivery_customer_address 					= '%s',

															delivery_customer_vehicle_no 				= '%s',

															delivery_customer_delivery_type 				= '%s',

															delivery_customer_godown_id 				= '%d',

															delivery_customer_driver_name 				= '%s',

															delivery_customer_time 					= '%s',

															delivery_customer_modified_by 				= '%d',

															delivery_customer_modified_on 				= UNIX_TIMESTAMP(NOW()),

															delivery_customer_modified_ip				= '%s'

														WHERE               

															delivery_customer_id         				= '%d'", 

															$delivery_customer_branch_id,

															$delivery_customer_date,

															$delivery_customer_customer_id,

															$delivery_customer_address,

															$delivery_customer_vehicle_no,

															$delivery_customer_delivery_type,

															$delivery_customer_godown_id,

															$delivery_customer_driver_name,

															$delivery_customer_time,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$delivery_customer_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($delivery_customer_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($delivery_customer_product_detail_product_id[$i])));

			if($detail_request_fields) {

				if(isset($delivery_customer_product_detail_id[$i]) && (!empty($delivery_customer_product_detail_id[$i]))) {
					 $update_delivery_customer_product_detail = sprintf("UPDATE 
																			delivery_customer_product_details 
																		SET  
																			delivery_customer_product_detail_width_inches  			= '%f',
																			delivery_customer_product_detail_width_mm  				= '%f',
																			delivery_customer_product_detail_s_width_inches  			= '%f',
																			delivery_customer_product_detail_s_width_mm  				= '%f',
																			delivery_customer_product_detail_sl_feet  					= '%f',
																			delivery_customer_product_detail_sl_feet_in  				= '%f',
																			delivery_customer_product_detail_sl_feet_mm  				= '%f',
																			delivery_customer_product_detail_s_weight_inches  			= '%f',
																			delivery_customer_product_detail_s_weight_mm  				= '%f',
																			delivery_customer_product_detail_tot_length  				= '%f',
																			delivery_customer_product_detail_qty  						= '%f',
																			delivery_customer_product_detail_rate  					= '%f',
																			delivery_customer_product_detail_total  					= '%f',
																			delivery_customer_product_detail_modified_by 				= '%d',
																			delivery_customer_product_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																			delivery_customer_product_detail_modified_ip 				= '%s'
																		WHERE 
																			delivery_customer_product_detail_delivery_customer_id 	= '%d' AND 
																			delivery_customer_product_detail_id 					= '%d'",
																			$delivery_customer_product_detail_width_inches[$i],
																			$delivery_customer_product_detail_width_mm[$i],
																			$delivery_customer_product_detail_s_width_inches[$i],
																			$delivery_customer_product_detail_s_width_mm[$i],
																			$delivery_customer_product_detail_sl_feet[$i],
																			$delivery_customer_product_detail_sl_feet_in[$i],
																			$delivery_customer_product_detail_sl_feet_mm[$i],
																			$delivery_customer_product_detail_s_weight_inches[$i],
																			$delivery_customer_product_detail_s_weight_mm[$i],
																			$delivery_customer_product_detail_tot_length[$i],
																			$delivery_customer_product_detail_qty[$i],
																			$delivery_customer_product_detail_rate[$i],
																			$delivery_customer_product_detail_total[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$delivery_customer_id, 
																			$delivery_customer_product_detail_id[$i]);	
			//	echo $update_delivery_customer_product_detail; exit;
					mysql_query($update_delivery_customer_product_detail);
					$detail_id			= $delivery_customer_product_detail_id[$i]; 
					
				/*$length_inches										= 	$delivery_customer_product_detail_length_feet[$i];
				$width_inches										= 	"3";
				$delivery_customer_detail_id							= 	$delivery_customer_product_detail_id[$i];
				$stock_ledger_prd_type								= 	$delivery_customer_product_detail_type[$i];
				stockLedger('out', $delivery_customer_id, $delivery_customer_detail_id,$delivery_customer_product_detail_product_id[$i],$length_inches,$width_inches, ($delivery_customer_product_detail_qty[$i]*-1), $delivery_customer_branch_id, $delivery_customer_customer_id, $delivery_customer_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type,$stock_ledger_prd_type);*/
				} else {

				$delivery_customer_product_detail_uniq_id = generateUniqId();

				$insert_delivery_customer_product_detail 		= sprintf("INSERT INTO delivery_customer_product_details 
																				(delivery_customer_product_detail_uniq_id,delivery_customer_product_detail_delivery_customer_id,
																				 delivery_customer_product_detail_product_id,
																				 delivery_customer_product_detail_product_type, delivery_customer_product_detail_product_thick,
																				 delivery_customer_product_detail_width_inches,delivery_customer_product_detail_width_mm,
																				 delivery_customer_product_detail_s_width_inches,delivery_customer_product_detail_s_width_mm,
																				 delivery_customer_product_detail_sl_feet,delivery_customer_product_detail_sl_feet_in,
																				 delivery_customer_product_detail_sl_feet_mm,delivery_customer_product_detail_sl_feet_met,
																				 delivery_customer_product_detail_s_weight_inches,delivery_customer_product_detail_s_weight_mm,
																				 delivery_customer_product_detail_qty,delivery_customer_product_detail_tot_length,
																				 delivery_customer_product_detail_rate,delivery_customer_product_detail_total,
																				 delivery_customer_product_detail_added_by, delivery_customer_product_detail_added_on,
																				 delivery_customer_product_detail_added_ip,delivery_customer_product_detail_invoice_detail_id,
																				 delivery_customer_product_detail_invoice_entry_id) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d',
																				'%d')", 
																		 $delivery_customer_product_detail_uniq_id,$delivery_customer_id,
																		 $delivery_customer_product_detail_product_id[$i],
																		 $delivery_customer_product_detail_product_type[$i], $delivery_customer_product_detail_product_thick[$i],
																		 $delivery_customer_product_detail_width_inches[$i],$delivery_customer_product_detail_width_mm[$i],
																		 $delivery_customer_product_detail_s_width_inches[$i],$delivery_customer_product_detail_s_width_mm[$i],
																		 $delivery_customer_product_detail_sl_feet[$i],$delivery_customer_product_detail_sl_feet_in[$i],
																		 $delivery_customer_product_detail_sl_feet_mm[$i],$delivery_customer_product_detail_sl_feet_met[$i],
																		 $delivery_customer_product_detail_s_weight_inches[$i],$delivery_customer_product_detail_s_weight_mm[$i],
																		 $delivery_customer_product_detail_qty[$i],$delivery_customer_product_detail_tot_length[$i],
																		 $delivery_customer_product_detail_rate[$i],$delivery_customer_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$delivery_customer_product_detail_invoice_detail_id[$i],
																		 $delivery_customer_invoice_entry_id);
																		// echo $insert_delivery_customer_product_detail; exit;
				mysql_query($insert_delivery_customer_product_detail);
				$detail_id  = mysql_insert_id();
				}
				if($delivery_customer_product_detail_entry_type[$i]==4){
							$produt_id											=	$delivery_customer_product_detail_product_id[$i];
							$product_colour_id									=	1;
							$product_thick										=	1;
							$width_inches										= 	1;
							$width_mm											= 	1;
							$length_feet										= 	1;
							$length_meter										= 	1;
							$product_detail_qty									= 	(-1*$delivery_customer_product_detail_qty[$i]);
							$stock_ledger_entry_type							= 	"production-entry-fin";
							if($_SESSION[SESS.'_session_user_branch_type']==1){
								$product_con_entry_godown_id						= 	"1";
								stockLedger('out',$delivery_customer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $delivery_customer_branch_id,  $product_con_entry_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
							else{
								$product_con_entry_godown_id						= 	$delivery_customer_godown_id;
								stockLedger('out',$delivery_customer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $delivery_customer_branch_id,  $product_con_entry_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type, '1',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
				}
				else{		
							$produt_id											=	$delivery_customer_product_detail_product_id[$i];
							$product_colour_id									=	$delivery_customer_product_detail_color_id[$i];
							$product_thick										=	$delivery_customer_product_detail_product_thick[$i];
							$width_inches										= 	$delivery_customer_product_detail_width_inches[$i];
							$width_mm											= 	$delivery_customer_product_detail_width_mm[$i];
							$length_feet										= 	$delivery_customer_product_detail_sl_feet[$i];
							$length_meter										= 	$delivery_customer_product_detail_sl_feet_met[$i];
							if($delivery_customer_product_detail_entry_type[$i]==1){
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$get_raw_val['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$ton_qty										= 	$total_ton*$length_feet;
								$kg_qty											= 	$ton_qty*1000;
								$product_detail_qty									= 	(-1*$delivery_customer_product_detail_qty[$i]);
							}
							else{
								$ton_qty										= 	$delivery_customer_product_detail_s_weight_inches[$i];
								$kg_qty											= 	$delivery_customer_product_detail_s_weight_mm[$i];
								$rec_product									= 	getProductGetail($produt_id);
								$brand_id										= 	$get_raw_val['product_brand_id'];
								$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
								$length_feet									= 	($delivery_customer_product_detail_sl_feet[$i]/$total_ton);
								
								$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
								$length_meter									= 	$product_cal['3'];
								$product_detail_qty								= '1';
							}
							$stock_ledger_entry_type							= 	"delivery-customer";
							if($_SESSION[SESS.'_session_user_branch_type']==1){
								$product_con_entry_godown_id						= 	"1";
								stockLedger('out',$delivery_customer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $delivery_customer_branch_id,  $product_con_entry_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
							else{
								$product_con_entry_godown_id						= 	$delivery_customer_godown_id;
								stockLedger('out',$delivery_customer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $delivery_customer_branch_id,  $product_con_entry_godown_id, $delivery_customer_date, $delivery_customer_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
							}
				}
				
			}
		}
		pageRedirection("delivery-customer/index.php?page=edit&id=$delivery_customer_uniq_id&msg=2");			
	}
    function deleteProductdetail()
   {
		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['delivery_customer_uniq_id'])))
		{
			$product_detail_id 	= $_GET['product_detail_id'];
			$delivery_customer_uniq_id = $_GET['delivery_customer_uniq_id'];
			mysql_query("UPDATE delivery_customer_product_details SET delivery_customer_product_detail_deleted_status = 1 
						WHERE delivery_customer_product_detail_id = ".$product_detail_id." ");
			header("Location:index.php?page=edit&id=$delivery_customer_uniq_id&msg=6");
		}
   } 		
	function deleteInventoryrequest(){

		deleteUniqRecords('delivery_customer', 'delivery_customer_deleted_by', 'delivery_customer_deleted_on' , 'delivery_customer_deleted_ip','delivery_customer_deleted_status', 'delivery_customer_id', 'delivery_customer_uniq_id', '1');

		

		deleteMultiRecords('delivery_customer_product_details', 'delivery_customer_product_detail_deleted_by', 'delivery_customer_product_detail_deleted_on', 'delivery_customer_product_detail_deleted_ip', 'delivery_customer_product_detail_deleted_status', 'delivery_customer_product_detail_delivery_customer_id', 'delivery_customer','delivery_customer_id','delivery_customer_uniq_id', '1');  



		

		pageRedirection("delivery-customer/index.php?msg=7");				

	}

?>