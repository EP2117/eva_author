<?php
	function GetAutoNo(){
		 $select_invoice_no = "SELECT MAX(invoice_entry_no) AS maxval FROM invoice_entry 
								  WHERE invoice_entry_deleted_status =0
								  AND invoice_entry_direct_type =2
								  AND invoice_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND invoice_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval = $record_invoice_no['maxval']; 

		if($maxval > 0) {

			$invoice_entry_no = substr(('00000'.++$maxval),-5);

		} else {

			$invoice_entry_no = substr(('00000'.++$maxval),-5);

		}
		return $invoice_entry_no;
	}
	function insertQuotation(){

		$invoice_entry_no                   				= trim($_POST['invoice_entry_no']);
		$invoice_entry_branch_id                   			= trim($_POST['invoice_entry_branch_id']);
		$invoice_entry_date                 				= NdateDatabaseFormat($_POST['invoice_entry_date']);
		$invoice_entry_type            						= trim($_POST['invoice_entry_type']);
		$invoice_entry_prd_type            					= trim($_POST['invoice_entry_prd_type']);
		$invoice_entry_type_id            					= trim($_POST['invoice_entry_type_id']);
		$invoice_entry_customer_id            				= trim($_POST['invoice_entry_customer_id']);
		$invoice_entry_validity_date                 		= NdateDatabaseFormat($_POST['invoice_entry_validity_date']);
		$invoice_entry_credit_days            				= trim($_POST['invoice_entry_credit_days']);
		$invoice_entry_due_date                 			= NdateDatabaseFormat($_POST['invoice_entry_due_date']);
		$invoice_entry_godown_id            				= trim($_POST['invoice_entry_godown_id']);
		$invoice_entry_salesman_id            				= trim($_POST['invoice_entry_salesman_id']);
		$invoice_entry_gross_amount                 		= NdateDatabaseFormat($_POST['invoice_entry_gross_amount']);
		$invoice_entry_transport_amount                 	= NdateDatabaseFormat($_POST['invoice_entry_transport_amount']);
		$invoice_entry_tax_per                 				= NdateDatabaseFormat($_POST['invoice_entry_tax_per']);
		$invoice_entry_tax_amount                 			= NdateDatabaseFormat($_POST['invoice_entry_tax_amount']);
		$invoice_entry_advance_amount                		= NdateDatabaseFormat($_POST['invoice_entry_advance_amount']);
		$invoice_entry_net_amount                 			= NdateDatabaseFormat($_POST['invoice_entry_net_amount']);
		$invoice_entry_quotation_entry_id              		= NdateDatabaseFormat($_POST['invoice_entry_quotation_entry_id']);
		$invoice_entry_remark								= trim($_POST['invoice_entry_remark']);

		//Product Detail
		$invoice_entry_product_detail_product_type      	= $_POST['invoice_entry_product_detail_product_type'];
$invoice_entry_product_detail_product_id     		= $_POST['invoice_entry_product_detail_product_id'];
$invoice_entry_product_detail_quotation_detail_id   = $_POST['invoice_entry_product_detail_quotation_detail_id'];
$invoice_entry_product_detail_width_inches  		= isset($_POST['invoice_entry_product_detail_width_inches'])?$_POST['invoice_entry_product_detail_width_inches']:'';
$invoice_entry_product_detail_width_mm 		  		= isset($_POST['invoice_entry_product_detail_width_mm'])?$_POST['invoice_entry_product_detail_width_mm']:'';
$invoice_entry_product_detail_s_width_inches 		= isset($_POST['invoice_entry_product_detail_s_width_inches'])?$_POST['invoice_entry_product_detail_s_width_inches']:'';
$invoice_entry_product_detail_s_width_mm 			= isset($_POST['invoice_entry_product_detail_s_width_mm'])?$_POST['invoice_entry_product_detail_s_width_mm']:'';
$invoice_entry_product_detail_sl_feet 		  		= isset($_POST['invoice_entry_product_detail_sl_feet'])?$_POST['invoice_entry_product_detail_sl_feet']:'';
$invoice_entry_product_detail_sl_feet_in 			= isset($_POST['invoice_entry_product_detail_sl_feet_in'])?$_POST['invoice_entry_product_detail_sl_feet_in']:'';
$invoice_entry_product_detail_sl_feet_mm 			= isset($_POST['invoice_entry_product_detail_sl_feet_mm'])?$_POST['invoice_entry_product_detail_sl_feet_mm']:'';
$invoice_entry_product_detail_sl_feet_met 			= isset($_POST['invoice_entry_product_detail_sl_feet_met'])?$_POST['invoice_entry_product_detail_sl_feet_met']:'';
$invoice_entry_product_detail_s_weight_inches   	= isset($_POST['invoice_entry_product_detail_s_weight_inches'])?$_POST['invoice_entry_product_detail_s_weight_inches']:'';
$invoice_entry_product_detail_s_weight_mm   		= isset($_POST['invoice_entry_product_detail_s_weight_mm'])?$_POST['invoice_entry_product_detail_s_weight_mm']:'';
$invoice_entry_product_detail_qty 			 		= $_POST['invoice_entry_product_detail_qty'];
$invoice_entry_product_detail_tot_length 			= isset($_POST['invoice_entry_product_detail_tot_length'])?$_POST['invoice_entry_product_detail_tot_length']:'';
$invoice_entry_product_detail_inv_tot_length 		= isset($_POST['invoice_entry_product_detail_inv_tot_length'])?$_POST['invoice_entry_product_detail_inv_tot_length']:'';
$invoice_entry_product_detail_rate 			  		= $_POST['invoice_entry_product_detail_rate'];
$invoice_entry_product_detail_total 				= $_POST['invoice_entry_product_detail_total'];

$invoice_entry_product_detail_product_thick 		= isset($_POST['invoice_entry_product_detail_product_thick'])?$_POST['invoice_entry_product_detail_product_thick']:'';
$invoice_entry_product_detail_color_id 				= isset($_POST['invoice_entry_product_detail_color_id'])?$_POST['invoice_entry_product_detail_color_id']:'';
$invoice_entry_product_detail_entry_type 			= isset($_POST['invoice_entry_product_detail_entry_type'])?$_POST['invoice_entry_product_detail_entry_type']:'';
		
		
		$request_fields 									= ((!empty($invoice_entry_branch_id)) && (!empty($invoice_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "invoice-entry/index.php?page=add&msg=5");
		$invoice_entry_uniq_id							= generateUniqId();
		$ip												= getRealIpAddr();
		$insert_invoice_entry 							= sprintf("INSERT INTO invoice_entry  (invoice_entry_uniq_id, invoice_entry_date,
																					  		  invoice_entry_customer_id,invoice_entry_validity_date,
																					  		  invoice_entry_credit_days,invoice_entry_due_date,
																					  		  invoice_entry_godown_id,invoice_entry_salesman_id,
																							  invoice_entry_gross_amount,invoice_entry_transport_amount,
																							  invoice_entry_tax_per,invoice_entry_tax_amount,
																							  invoice_entry_advance_amount,invoice_entry_net_amount,
																					   		  invoice_entry_no,
																					  		  invoice_entry_branch_id,invoice_entry_added_by,
																					   		  invoice_entry_added_on,invoice_entry_added_ip,
																			   		   		  invoice_entry_company_id,invoice_entry_financial_year,
																							  invoice_entry_quotation_entry_id,invoice_entry_type,
																							  invoice_entry_prd_type,invoice_entry_type_id,
																							  invoice_entry_direct_type,invoice_entry_remark) 

																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%s', 
																							  '%d', '%s', 
																							  '%d', '%d', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d',
																							  '%d', '%d', '%d', '%s','%d','%s')", 
																		  	   		   		 $invoice_entry_uniq_id, $invoice_entry_date,
																					   		 $invoice_entry_customer_id,$invoice_entry_validity_date,
																							 $invoice_entry_credit_days,$invoice_entry_due_date,
																					  		 $invoice_entry_godown_id,$invoice_entry_salesman_id,
																					   		 $invoice_entry_gross_amount,$invoice_entry_tax_amount,
																					   		 $invoice_entry_tax_per,$invoice_entry_validity_date,
																					   		 $invoice_entry_advance_amount,$invoice_entry_net_amount,
																					   		 $invoice_entry_no,
																					   		 $invoice_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $invoice_entry_quotation_entry_id,$invoice_entry_type,
																							 $invoice_entry_prd_type,$invoice_entry_type_id,2,$invoice_entry_remark);  

		mysql_query($insert_invoice_entry);

		//echo $insert_invoice_entry; exit;

		$invoice_entry_id 							= mysql_insert_id(); 

		// purchase order pproduct details

		for($i = 0; $i < count($invoice_entry_product_detail_product_id); $i++) { 
		// echo $invoice_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($invoice_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$invoice_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_invoice_entry_product_detail 		= sprintf("INSERT INTO invoice_entry_product_details 
																				(invoice_entry_product_detail_uniq_id,invoice_entry_product_detail_invoice_entry_id,
																				 invoice_entry_product_detail_product_id,
																				 invoice_entry_product_detail_product_type, invoice_entry_product_detail_product_thick,
																				 invoice_entry_product_detail_width_inches,invoice_entry_product_detail_width_mm,
																				 invoice_entry_product_detail_s_width_inches,invoice_entry_product_detail_s_width_mm,
																				 invoice_entry_product_detail_sl_feet,invoice_entry_product_detail_sl_feet_in,
																				 invoice_entry_product_detail_sl_feet_mm,invoice_entry_product_detail_sl_feet_met,
																				 invoice_entry_product_detail_s_weight_inches,invoice_entry_product_detail_s_weight_mm,
																				 invoice_entry_product_detail_qty,invoice_entry_product_detail_tot_length,
																				 invoice_entry_product_detail_rate,invoice_entry_product_detail_total,
																				 invoice_entry_product_detail_added_by, invoice_entry_product_detail_added_on,
																				 invoice_entry_product_detail_added_ip,invoice_entry_product_detail_quotation_detail_id,
																				 invoice_entry_product_detail_quotation_entry_id,invoice_entry_product_detail_color_id,
																				 invoice_entry_product_detail_entry_type) 
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
																		 $invoice_entry_product_detail_uniq_id,$invoice_entry_id,
																		 $invoice_entry_product_detail_product_id[$i],
																		 $invoice_entry_product_detail_product_type[$i], $invoice_entry_product_detail_product_thick[$i],
																		 $invoice_entry_product_detail_width_inches[$i],$invoice_entry_product_detail_width_mm[$i],
																		 $invoice_entry_product_detail_s_width_inches[$i],$invoice_entry_product_detail_s_width_mm[$i],
																		 $invoice_entry_product_detail_sl_feet[$i],$invoice_entry_product_detail_sl_feet_in[$i],
																		 $invoice_entry_product_detail_sl_feet_mm[$i],$invoice_entry_product_detail_sl_feet_met[$i],
																		 $invoice_entry_product_detail_s_weight_inches[$i],$invoice_entry_product_detail_s_weight_mm[$i],
																		 $invoice_entry_product_detail_qty[$i],$invoice_entry_product_detail_tot_length[$i],
																		 $invoice_entry_product_detail_rate[$i],$invoice_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$invoice_entry_product_detail_quotation_detail_id[$i],
																		 $invoice_entry_quotation_entry_id,$invoice_entry_product_detail_color_id[$i],
																		 $invoice_entry_product_detail_entry_type[$i]);
																		// echo $insert_invoice_entry_product_detail; exit;
				mysql_query($insert_invoice_entry_product_detail);
				$detail_id			= mysql_insert_id();
				if($invoice_entry_type==1 && $_SESSION[SESS.'_session_user_branch_type']==1){
					if($invoice_entry_product_detail_entry_type[$i]=='4'){
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"invoice-advance";
								$godown_id										= 	"2";
								$produt_id										=	$invoice_entry_product_detail_product_id[$i];
								$produt_qty										=	(-1*$invoice_entry_product_detail_qty[$i]);
							stockLedger('out',$invoice_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $invoice_entry_branch_id,  $godown_id, $invoice_entry_date, $invoice_entry_no,$stock_ledger_entry_type,'1');
					}
					else{
					$produt_id											=	$invoice_entry_product_detail_product_id[$i];
					$product_colour_id									=	$invoice_entry_product_detail_color_id[$i];
					$product_thick										=	$invoice_entry_product_detail_product_thick[$i];
					$width_inches										= 	$invoice_entry_product_detail_width_inches[$i];
					$width_mm											= 	$invoice_entry_product_detail_width_mm[$i];
					$ton_qty											= 	$invoice_entry_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$invoice_entry_product_detail_s_weight_mm[$i];
					$tot_length											= 	$invoice_entry_product_detail_inv_tot_length[$i];
					$detail_qty											= 	$invoice_entry_product_detail_qty[$i];
					$entry_type											= 	"invoice-advance";
					reduceRawMaterial($produt_id,$product_thick,$product_colour_id,$width_inches,$tot_length,$invoice_entry_no,$invoice_entry_date,$invoice_entry_id,$detail_id,$invoice_entry_branch_id,$entry_type,$invoice_entry_product_detail_entry_type[$i],$ton_qty,$kg_qty,$detail_qty);	
					}
				}

			}
		}
		
		$setup_detail	= GetBranchAccSetup($invoice_entry_branch_id);
		$acc_dr_id		= $setup_detail['acS_sales'];
		$acc_cr_id		= getMasterID($invoice_entry_customer_id, 'customer');
		
		update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'Invoice', $acc_dr_id, $acc_cr_id, 'D', $invoice_entry_net_amount, $invoice_entry_remark, $invoice_entry_branch_id);	
		update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'Invoice', $acc_cr_id, $acc_dr_id, 'C', $invoice_entry_net_amount, $invoice_entry_remark, $invoice_entry_branch_id);			
		
		
		pageRedirection("invoice-entry/index.php?page=add&msg=1");

	}

	function listQuotation(){

		$select_invoice_entry		=	"SELECT 

												invoice_entry_id,

												invoice_entry_uniq_id,

												invoice_entry_no,

												invoice_entry_date,

												customer_name,

												invoice_entry_validity_date

											 FROM 

												invoice_entry

											 LEFT JOIN

												customers

											 ON

												customer_id		=  invoice_entry_customer_id

											 WHERE 

												invoice_entry_deleted_status 	= 	0  AND 
												invoice_entry_direct_type 		= 2

											 ORDER BY 

												invoice_entry_no ASC";

		$result_invoice_entry		= mysql_query($select_invoice_entry);

		// Filling up the array

		$invoice_entry_data 		= array();

		while ($record_invoice_entry = mysql_fetch_array($result_invoice_entry))

		{

		 $invoice_entry_data[] 	= $record_invoice_entry;

		}

		return $invoice_entry_data;

	}

	function editQuotation(){

		$invoice_entry_id 			= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_invoice_entry		=	"SELECT 

												invoice_entry_uniq_id,  invoice_entry_date,
												invoice_entry_customer_id,invoice_entry_validity_date,
												invoice_entry_credit_days,invoice_entry_due_date,
												invoice_entry_godown_id,invoice_entry_salesman_id,
												invoice_entry_gross_amount,invoice_entry_transport_amount,
												invoice_entry_tax_per,invoice_entry_tax_amount,
												invoice_entry_advance_amount,invoice_entry_net_amount,
												invoice_entry_no,invoice_entry_type_id,
												invoice_entry_branch_id,invoice_entry_id,
												quotation_entry_no,quotation_entry_date,
												advance_entry_no,advance_entry_date,
												invoice_entry_quotation_entry_id,invoice_entry_type,
												invoice_entry_prd_type,invoice_entry_remark,customer_name

											 FROM 

												invoice_entry

											LEFT JOIN

												quotation_entry

											ON

												quotation_entry_id				= invoice_entry_quotation_entry_id  AND  invoice_entry_type = '1'
											LEFT JOIN

												advance_entry

											ON

												advance_entry_id				= invoice_entry_quotation_entry_id  AND  invoice_entry_type = '2'
											LEFT JOIN

												customers

											ON

												customer_id						= invoice_entry_customer_id  
											 WHERE 

												invoice_entry_deleted_status 	=  0 			AND 

												invoice_entry_id				= '".$invoice_entry_id."'

											 ORDER BY 

												invoice_entry_no ASC";

		$result_invoice_entry 		= mysql_query($select_invoice_entry);

		$record_invoice_entry 		= mysql_fetch_array($result_invoice_entry);

		return $record_invoice_entry;

	}

	function editQuotationProductDetail()
	{
		$invoice_entry_id 						= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', dataValidation($_GET['id'])); 
		 $select_invoice_entry_product_detail 	= "	SELECT 
														invoice_entry_product_detail_id,
														invoice_entry_product_detail_product_id,
														invoice_entry_product_detail_width_inches,invoice_entry_product_detail_width_mm,
														invoice_entry_product_detail_s_width_inches,invoice_entry_product_detail_s_width_mm,
														invoice_entry_product_detail_sl_feet,invoice_entry_product_detail_sl_feet_in,
														invoice_entry_product_detail_sl_feet_mm,invoice_entry_product_detail_s_weight_inches,
														invoice_entry_product_detail_s_weight_mm,invoice_entry_product_detail_tot_length,
														invoice_entry_product_detail_rate,invoice_entry_product_detail_quotation_detail_id,
														invoice_entry_product_detail_total,invoice_entry_product_detail_qty,
														invoice_entry_product_detail_product_thick,invoice_entry_product_detail_sl_feet_met,
														product_name,
														product_code,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														p_uom.product_uom_name as p_uom_name,
														child_uom.product_uom_name as c_uom_name,
														p_clr.product_colour_name as p_colour_name,
														c_clr.product_colour_name as c_colour_name,
														brand_name,invoice_entry_product_detail_product_type,
														invoice_entry_product_detail_entry_type ,
														brand_name
													FROM 
														invoice_entry_product_details 
													LEFT JOIN 
														quotation_entry_product_details 
													ON 
														quotation_entry_product_detail_id 		= invoice_entry_product_detail_quotation_detail_id
													LEFT JOIN 
														products 
													ON 
														product_id 								= invoice_entry_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 								= product_brand_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= invoice_entry_product_detail_product_id	
													LEFT JOIN 
														product_uoms as p_uom
													ON 
														p_uom.product_uom_id 									= product_purchase_uom_id
													LEFT JOIN 
														product_uoms as  child_uom
													ON 
														child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
													LEFT JOIN 
														product_colours as p_clr 
													ON 
														p_clr.product_colour_id 								= invoice_entry_product_detail_color_id
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= invoice_entry_product_detail_color_id
														
													WHERE 
														invoice_entry_product_detail_deleted_status		 	= 0 							AND 
														invoice_entry_product_detail_invoice_entry_id 		= '".$invoice_entry_id."'";
		$result_invoice_entry_product_detail 	= mysql_query($select_invoice_entry_product_detail);
		$count_invoice_entry 					= mysql_num_rows($result_invoice_entry_product_detail);
		$arr_invoice_entry_product_detail 		= array();
		while($record_invoice_entry_product_detail = mysql_fetch_array($result_invoice_entry_product_detail)) {
			$arr_invoice_entry_product_detail[] = $record_invoice_entry_product_detail;
		}
		return $arr_invoice_entry_product_detail;
	}
	function updateQuotation(){
		$invoice_entry_id                   			= trim($_POST['invoice_entry_id']);
		$invoice_entry_uniq_id                			= trim($_POST['invoice_entry_uniq_id']);
		$invoice_entry_type                				= trim($_POST['invoice_entry_type']);
		$invoice_entry_branch_id                   		= trim($_POST['invoice_entry_branch_id']);
		$invoice_entry_date                 			= NdateDatabaseFormat($_POST['invoice_entry_date']);
		$invoice_entry_customer_id            			= trim($_POST['invoice_entry_customer_id']);
		$invoice_entry_validity_date      				= NdateDatabaseFormat($_POST['invoice_entry_validity_date']);
		$invoice_entry_credit_days            			= trim($_POST['invoice_entry_credit_days']);
		$invoice_entry_due_date                 		= NdateDatabaseFormat($_POST['invoice_entry_due_date']);
		$invoice_entry_godown_id            			= trim($_POST['invoice_entry_godown_id']);
		$invoice_entry_salesman_id            			= trim($_POST['invoice_entry_salesman_id']);
		$invoice_entry_gross_amount                 	= NdateDatabaseFormat($_POST['invoice_entry_gross_amount']);
		$invoice_entry_transport_amount                 = NdateDatabaseFormat($_POST['invoice_entry_transport_amount']);
		$invoice_entry_tax_per                 			= NdateDatabaseFormat($_POST['invoice_entry_tax_per']);
		$invoice_entry_tax_amount                 		= NdateDatabaseFormat($_POST['invoice_entry_tax_amount']);
		$invoice_entry_advance_amount                	= NdateDatabaseFormat($_POST['invoice_entry_advance_amount']);
		$invoice_entry_net_amount                 		= NdateDatabaseFormat($_POST['invoice_entry_net_amount']);
		$invoice_entry_quotation_entry_id              	= NdateDatabaseFormat($_POST['invoice_entry_quotation_entry_id']);
		$invoice_entry_remark							= trim($_POST['invoice_entry_remark']);
		

		//Product Detail
		
	$invoice_entry_product_detail_id      				= $_POST['invoice_entry_product_detail_id'];
	$invoice_entry_product_detail_product_type      	= $_POST['invoice_entry_product_detail_product_type'];
	$invoice_entry_product_detail_product_id     		= $_POST['invoice_entry_product_detail_product_id'];
	$invoice_entry_product_detail_quotation_detail_id   = $_POST['invoice_entry_product_detail_quotation_detail_id'];
	$invoice_entry_product_detail_width_inches  		= isset($_POST['invoice_entry_product_detail_width_inches'])?$_POST['invoice_entry_product_detail_width_inches']:'';
	$invoice_entry_product_detail_width_mm 		  		= isset($_POST['invoice_entry_product_detail_width_mm'])?$_POST['invoice_entry_product_detail_width_mm']:'';
	$invoice_entry_product_detail_s_width_inches 		= isset($_POST['invoice_entry_product_detail_s_width_inches'])?$_POST['invoice_entry_product_detail_s_width_inches']:'';
	$invoice_entry_product_detail_s_width_mm 			= isset($_POST['invoice_entry_product_detail_s_width_mm'])?$_POST['invoice_entry_product_detail_s_width_mm']:'';
	$invoice_entry_product_detail_sl_feet 		  		= isset($_POST['invoice_entry_product_detail_sl_feet'])?$_POST['invoice_entry_product_detail_sl_feet']:'';
	$invoice_entry_product_detail_sl_feet_in 			= isset($_POST['invoice_entry_product_detail_sl_feet_in'])?$_POST['invoice_entry_product_detail_sl_feet_in']:'';
	$invoice_entry_product_detail_sl_feet_mm 			= isset($_POST['invoice_entry_product_detail_sl_feet_mm'])?$_POST['invoice_entry_product_detail_sl_feet_mm']:'';
	$invoice_entry_product_detail_sl_feet_met 			= isset($_POST['invoice_entry_product_detail_sl_feet_met'])?$_POST['invoice_entry_product_detail_sl_feet_met']:'';
	$invoice_entry_product_detail_s_weight_inches   	= isset($_POST['invoice_entry_product_detail_s_weight_inches'])?$_POST['invoice_entry_product_detail_s_weight_inches']:'';
	$invoice_entry_product_detail_s_weight_mm   		= isset($_POST['invoice_entry_product_detail_s_weight_mm'])?$_POST['invoice_entry_product_detail_s_weight_mm']:'';
	$invoice_entry_product_detail_qty 			 		= $_POST['invoice_entry_product_detail_qty'];
	$invoice_entry_product_detail_tot_length 			= isset($_POST['invoice_entry_product_detail_tot_length'])?$_POST['invoice_entry_product_detail_tot_length']:'';
	$invoice_entry_product_detail_inv_tot_length 		= isset($_POST['invoice_entry_product_detail_inv_tot_length'])?$_POST['invoice_entry_product_detail_inv_tot_length']:'';
	$invoice_entry_product_detail_rate 			  		= $_POST['invoice_entry_product_detail_rate'];
	$invoice_entry_product_detail_total 				= $_POST['invoice_entry_product_detail_total'];
	
	$invoice_entry_product_detail_product_thick 		= isset($_POST['invoice_entry_product_detail_product_thick'])?$_POST['invoice_entry_product_detail_product_thick']:'';
	$invoice_entry_product_detail_color_id 				= isset($_POST['invoice_entry_product_detail_color_id'])?$_POST['invoice_entry_product_detail_color_id']:'';
	$invoice_entry_product_detail_entry_type 			= isset($_POST['invoice_entry_product_detail_entry_type'])?$_POST['invoice_entry_product_detail_entry_type']:'';
	
		$request_fields 						= ((!empty($invoice_entry_branch_id)) && (!empty($invoice_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "invoice-entry/index.php?page=edit&id=$invoice_entry_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 

															invoice_entry 

														SET 

															invoice_entry_branch_id 				= '%d',

															invoice_entry_date 						= '%s',

															invoice_entry_customer_id 				= '%d',

															invoice_entry_validity_date 			= '%s',

															invoice_entry_credit_days 				= '%d',

															invoice_entry_due_date 					= '%s',

															invoice_entry_godown_id 				= '%d',

															invoice_entry_salesman_id 				= '%d',

															invoice_entry_gross_amount 				= '%f',

															invoice_entry_transport_amount 			= '%f',

															invoice_entry_tax_per 					= '%f',

															invoice_entry_tax_amount 				= '%f',

															invoice_entry_advance_amount 			= '%f',

															invoice_entry_net_amount 				= '%f',

															invoice_entry_modified_by 				= '%d',

															invoice_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															invoice_entry_modified_ip				= '%s',
															invoice_entry_remark					= '%s'

														WHERE               

															invoice_entry_id         				= '%d'", 

															$invoice_entry_branch_id,

															$invoice_entry_date,

															$invoice_entry_customer_id,

															$invoice_entry_validity_date,

															$invoice_entry_credit_days,

															$invoice_entry_due_date,

															$invoice_entry_godown_id,

															$invoice_entry_salesman_id,

															$invoice_entry_gross_amount,

															$invoice_entry_transport_amount,

															$invoice_entry_tax_per,

															$invoice_entry_tax_amount,

															$invoice_entry_advance_amount,

															$invoice_entry_net_amount,

															$_SESSION[SESS.'_session_user_id'], 

															$ip,$invoice_entry_remark, 

															$invoice_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($invoice_entry_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($invoice_entry_product_detail_product_id[$i])));

			if($detail_request_fields) {

				if(isset($invoice_entry_product_detail_id[$i]) && (!empty($invoice_entry_product_detail_id[$i]))) {

					$update_invoice_entry_product_detail = sprintf("UPDATE 
																			invoice_entry_product_details 
																		SET  
																			invoice_entry_product_detail_width_inches  			= '%f',
																			invoice_entry_product_detail_width_mm  				= '%f',
																			invoice_entry_product_detail_s_width_inches  		= '%f',
																			invoice_entry_product_detail_s_width_mm  			= '%f',
																			invoice_entry_product_detail_sl_feet  				= '%f',
																			invoice_entry_product_detail_sl_feet_in  			= '%f',
																			invoice_entry_product_detail_sl_feet_mm  			= '%f',
																			invoice_entry_product_detail_s_weight_inches  		= '%f',
																			invoice_entry_product_detail_s_weight_mm  			= '%f',
																			invoice_entry_product_detail_tot_length  			= '%f',
																			invoice_entry_product_detail_qty  					= '%f',
																			invoice_entry_product_detail_rate  					= '%f',
																			invoice_entry_product_detail_total  				= '%f',
																			invoice_entry_product_detail_modified_by 			= '%d',
																			invoice_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			invoice_entry_product_detail_modified_ip 			= '%s'
																		WHERE 
																			invoice_entry_product_detail_invoice_entry_id 	= '%d' AND 
																			invoice_entry_product_detail_id 					= '%d'",
																			$invoice_entry_product_detail_width_inches[$i],
																			$invoice_entry_product_detail_width_mm[$i],
																			$invoice_entry_product_detail_s_width_inches[$i],
																			$invoice_entry_product_detail_s_width_mm[$i],
																			$invoice_entry_product_detail_sl_feet[$i],
																			$invoice_entry_product_detail_sl_feet_in[$i],
																			$invoice_entry_product_detail_sl_feet_mm[$i],
																			$invoice_entry_product_detail_s_weight_inches[$i],
																			$invoice_entry_product_detail_s_weight_mm[$i],
																			$invoice_entry_product_detail_tot_length[$i],
																			
																			$invoice_entry_product_detail_qty[$i],
																			$invoice_entry_product_detail_rate[$i],
																			$invoice_entry_product_detail_total[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$invoice_entry_id, 
																			$invoice_entry_product_detail_id[$i]);	
			//	echo $update_invoice_entry_product_detail; exit;
					mysql_query($update_invoice_entry_product_detail);
					$detail_id	= $invoice_entry_product_detail_id[$i];

				} else {
				$invoice_entry_product_detail_uniq_id 	= generateUniqId();
				 $insert_invoice_entry_product_detail 		= sprintf("INSERT INTO invoice_entry_product_details 
																				(invoice_entry_product_detail_uniq_id,invoice_entry_product_detail_invoice_entry_id,
																				 invoice_entry_product_detail_product_id,
																				 invoice_entry_product_detail_product_type, invoice_entry_product_detail_product_thick,
																				 invoice_entry_product_detail_width_inches,invoice_entry_product_detail_width_mm,
																				 invoice_entry_product_detail_s_width_inches,invoice_entry_product_detail_s_width_mm,
																				 invoice_entry_product_detail_sl_feet,invoice_entry_product_detail_sl_feet_in,
																				 invoice_entry_product_detail_sl_feet_mm,invoice_entry_product_detail_sl_feet_met,
																				 invoice_entry_product_detail_s_weight_inches,invoice_entry_product_detail_s_weight_mm,
																				 invoice_entry_product_detail_qty,invoice_entry_product_detail_tot_length,
																				 invoice_entry_product_detail_rate,invoice_entry_product_detail_total,
																				 invoice_entry_product_detail_added_by, invoice_entry_product_detail_added_on,
																				 invoice_entry_product_detail_added_ip,invoice_entry_product_detail_quotation_detail_id,
																				 invoice_entry_product_detail_quotation_entry_id,invoice_entry_product_detail_color_id,
																				 invoice_entry_product_detail_entry_type) 
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
																		 $invoice_entry_product_detail_uniq_id,$invoice_entry_id,
																		 $invoice_entry_product_detail_product_id[$i],
																		 $invoice_entry_product_detail_product_type[$i], $invoice_entry_product_detail_product_thick[$i],
																		 $invoice_entry_product_detail_width_inches[$i],$invoice_entry_product_detail_width_mm[$i],
																		 $invoice_entry_product_detail_s_width_inches[$i],$invoice_entry_product_detail_s_width_mm[$i],
																		 $invoice_entry_product_detail_sl_feet[$i],$invoice_entry_product_detail_sl_feet_in[$i],
																		 $invoice_entry_product_detail_sl_feet_mm[$i],$invoice_entry_product_detail_sl_feet_met[$i],
																		 $invoice_entry_product_detail_s_weight_inches[$i],$invoice_entry_product_detail_s_weight_mm[$i],
																		 $invoice_entry_product_detail_qty[$i],$invoice_entry_product_detail_tot_length[$i],
																		 $invoice_entry_product_detail_rate[$i],$invoice_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$invoice_entry_product_detail_quotation_detail_id[$i],
																		 $invoice_entry_quotation_entry_id,$invoice_entry_product_detail_color_id[$i],
																		 $invoice_entry_product_detail_entry_type[$i]);
																		// echo $insert_invoice_entry_product_detail; exit;
				mysql_query($insert_invoice_entry_product_detail);
				$detail_id	= mysql_insert_id();
				}
				if($invoice_entry_type==1 && $_SESSION[SESS.'_session_user_branch_type']==1){
					if($invoice_entry_product_detail_entry_type[$i]=='4'){
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"invoice-advance";
								$godown_id										= 	"2";
								$produt_id										=	$invoice_entry_product_detail_product_id[$i];
								$produt_qty										=	(-1*$invoice_entry_product_detail_qty[$i]);
							stockLedger('out',$invoice_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $invoice_entry_branch_id,  $godown_id, $invoice_entry_date, $invoice_entry_no,$stock_ledger_entry_type,'1');
					}
					else{
					
					$produt_id											=	$invoice_entry_product_detail_product_id[$i];
					$product_colour_id									=	$invoice_entry_product_detail_color_id[$i];
					$product_thick										=	$invoice_entry_product_detail_product_thick[$i];
					$width_inches										= 	$invoice_entry_product_detail_width_inches[$i];
					$width_mm											= 	$invoice_entry_product_detail_width_mm[$i];
					$ton_qty											= 	$invoice_entry_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$invoice_entry_product_detail_s_weight_mm[$i];
					$tot_length											= 	$invoice_entry_product_detail_inv_tot_length[$i];
					$product_detail_qty									= $invoice_entry_product_detail_qty[$i];
					$entry_type											= 	"invoice-advance";
					reduceRawMaterial($produt_id,$product_thick,$product_colour_id,$width_inches,$tot_length,$invoice_entry_no,$invoice_entry_date,$invoice_entry_id,$detail_id,$invoice_entry_branch_id,$entry_type,$invoice_entry_product_detail_entry_type[$i],$ton_qty,$kg_qty,$product_detail_qty);	
					}
				}
			}
		}
		pageRedirection("invoice-entry/index.php?page=edit&id=$invoice_entry_uniq_id&msg=2");			
	}

    function deleteProductdetail()
   {
		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['invoice_entry_uniq_id'])))
		{
			$product_detail_id 	= $_GET['product_detail_id'];
			$invoice_entry_uniq_id = $_GET['invoice_entry_uniq_id'];
			mysql_query("UPDATE 
							invoice_entry_product_details SET invoice_entry_product_detail_deleted_status = 1 
						WHERE invoice_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$invoice_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('invoice_entry', 'invoice_entry_deleted_by', 'invoice_entry_deleted_on' , 'invoice_entry_deleted_ip','invoice_entry_deleted_status', 'invoice_entry_id', 'invoice_entry_uniq_id', '1');

		

		deleteMultiRecords('invoice_entry_product_details', 'invoice_entry_product_detail_deleted_by', 'invoice_entry_product_detail_deleted_on', 'invoice_entry_product_detail_deleted_ip', 'invoice_entry_product_detail_deleted_status', 'invoice_entry_product_detail_invoice_entry_id', 'invoice_entry','invoice_entry_id','invoice_entry_uniq_id', '1');  



		

		pageRedirection("invoice-entry/index.php?msg=7");				

	}

?>