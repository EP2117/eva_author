<?php
function bank(){

$select="SELECT *	FROM account_sub WHERE account_sub_deleted_status=	0 AND account_sub_type_id = '2'"; 
$query=mysql_query($select);
while($result=mysql_fetch_array($query)){

$arr_bank[]=$result;
}
return $arr_bank;
}


function GetAutoNo($advance_entry_branch_id){

		 $select_invoice_no = "SELECT MAX(advance_entry_no) AS maxval FROM advance_entry 
								  WHERE advance_entry_deleted_status =0
								  AND advance_entry_branch_id = '".$advance_entry_branch_id."'
								  AND advance_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND advance_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		 $maxval = substr($record_invoice_no['maxval'],3,7); 

		if($maxval > 0) { 

			$advance_entry_no = substr(('00000'.++$maxval),-5);
			//echo $advance_entry_no;

		} else {
 
			$advance_entry_no = substr(('00001'.++$maxval),-5);

		}
		return $advance_entry_no;
	}
	function insertQuotation(){
	
	 $select_branch	= "SELECT branch_prefix FROM branches WHERE  branch_id = '".$_POST['advance_entry_branch_id']."' ";
		//echo $select_branch;exit;
		$result_branch = mysql_query($select_branch);
		$res = mysql_fetch_array($result_branch);  //echo $res['branch_prefix'];exit;
		
	
		$advance_entry_no                   			= $res['branch_prefix'].GetAutoNo($_POST['advance_entry_branch_id']);
		//$advance_entry_no    =         empty($advance_entry_no1)?$res['branch_prefix'].GetAutoNo($_POST['advance_entry_branch_id']):$advance_entry_no1;
		$advance_entry_branch_id                   			= trim($_POST['advance_entry_branch_id']);
		$advance_entry_type_id                   			= implode(",",$_POST['advance_entry_type_id']);
		$advance_entry_date                 				= NdateDatabaseFormat($_POST['advance_entry_date']);
		$advance_entry_customer_id            				= trim($_POST['advance_entry_customer_id']);
		$advance_entry_validity_date                 		= NdateDatabaseFormat($_POST['advance_entry_validity_date']);
		$advance_entry_gross_amount                 		= ($_POST['advance_entry_gross_amount']);
		$advance_entry_transport_amount                 	= ($_POST['advance_entry_transport_amount']);
		$advance_entry_tax_per                 				= ($_POST['advance_entry_tax_per']);
		$advance_entry_tax_amount                 			= ($_POST['advance_entry_tax_amount']);
		$advance_entry_advance_amount                		= ($_POST['advance_entry_advance_amount']);
		$advance_entry_net_amount                 			= ($_POST['advance_entry_net_amount']); 
		
		$advance_entry_dis_per                 			= trim($_POST['advance_entry_dis_per']);
		$advance_entry_dis_amount                 		= trim($_POST['advance_entry_dis_amount']);
		$advance_entry_payment_mode                    = trim($_POST['invoice_entry_payment_mode']);
		$advance_entry_acc_bank_id						= trim($_POST['invoice_entry_acc_bank_id']); 
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
																			   		   		  advance_entry_company_id,advance_entry_financial_year,
																							  advance_entry_dis_per,advance_entry_dis_amount, advance_entry_payment_mode, 
																							  advance_entry_acc_bank_id) 
																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%s', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%s', '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d',
																							  '%f', '%f','%d','%d')", 
																		  	   		   		 $advance_entry_uniq_id, $advance_entry_date,
																					   		 $advance_entry_customer_id,$advance_entry_validity_date,
																					   		 $advance_entry_gross_amount,$advance_entry_transport_amount,
																							 $advance_entry_tax_per,$advance_entry_tax_amount,
																					   		 $advance_entry_advance_amount,$advance_entry_net_amount,
																					   		 $advance_entry_no,$advance_entry_type_id,
																					   		 $advance_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],
																							 $_SESSION[SESS.'_session_financial_year'],$advance_entry_dis_per,
																							 $advance_entry_dis_amount,$advance_entry_payment_mode,$advance_entry_acc_bank_id);  
		//echo $insert_advance_entry; exit;
		mysql_query($insert_advance_entry);
		 $advance_entry_id 								= mysql_insert_id(); 
		
		
		//Product Detail
$advance_entry_product_detail_product_type      = $_POST['advance_entry_product_detail_product_type'];
$advance_entry_product_detail_product_id     	= $_POST['advance_entry_product_detail_product_id'];
$advance_entry_product_detail_product_uom_id    = $_POST['advance_entry_product_detail_product_uom_id'];
$advance_entry_product_detail_product_brand_id  = isset($_POST['advance_entry_product_detail_product_brand_id'])?$_POST['advance_entry_product_detail_product_brand_id']:'';

$advance_entry_product_detail_width_inches  	= isset($_POST['advance_entry_product_detail_width_inches'])?$_POST['advance_entry_product_detail_width_inches']:'';
$advance_entry_product_detail_width_mm 		  	= isset($_POST['advance_entry_product_detail_width_mm'])?$_POST['advance_entry_product_detail_width_mm']:'';
$advance_entry_product_detail_s_width_inches 	= isset($_POST['advance_entry_product_detail_s_width_inches'])?$_POST['advance_entry_product_detail_s_width_inches']:'';
$advance_entry_product_detail_s_width_mm 		= isset($_POST['advance_entry_product_detail_s_width_mm'])?$_POST['advance_entry_product_detail_s_width_mm']:'';
$advance_entry_product_detail_sl_feet 		  	= isset($_POST['advance_entry_product_detail_sl_feet'])?$_POST['advance_entry_product_detail_sl_feet']:'';
$advance_entry_product_detail_sl_feet_in 		= isset($_POST['advance_entry_product_detail_sl_feet_in'])?$_POST['advance_entry_product_detail_sl_feet_in']:'';
$advance_entry_product_detail_sl_feet_mm 		= isset($_POST['advance_entry_product_detail_sl_feet_mm'])?$_POST['advance_entry_product_detail_sl_feet_mm']:'';
$advance_entry_product_detail_sl_feet_met 		= isset($_POST['advance_entry_product_detail_sl_feet_met'])?$_POST['advance_entry_product_detail_sl_feet_met']:'';
$advance_entry_product_detail_s_weight_inches   = isset($_POST['advance_entry_product_detail_s_weight_inches'])?$_POST['advance_entry_product_detail_s_weight_inches']:'';
$advance_entry_product_detail_s_weight_mm   	= isset($_POST['advance_entry_product_detail_s_weight_mm'])?$_POST['advance_entry_product_detail_s_weight_mm']:'';
$advance_entry_product_detail_qty 			  	= $_POST['advance_entry_product_detail_qty'];
$advance_entry_product_detail_tot_length 		= isset($_POST['advance_entry_product_detail_tot_length'])?$_POST['advance_entry_product_detail_tot_length']:'';
$advance_entry_product_detail_inv_tot_length 		= isset($_POST['advance_entry_product_detail_inv_tot_length'])?$_POST['advance_entry_product_detail_inv_tot_length']:'';
$advance_entry_product_detail_rate 			  	= $_POST['advance_entry_product_detail_rate'];
$advance_entry_product_detail_total 			= $_POST['advance_entry_product_detail_total'];

$advance_entry_product_detail_product_color_id 	= isset($_POST['advance_entry_product_detail_product_color_id'])?$_POST['advance_entry_product_detail_product_color_id']:'';
$advance_entry_product_detail_product_thick 	= isset($_POST['advance_entry_product_detail_product_thick'])?$_POST['advance_entry_product_detail_product_thick']:'';
$advance_entry_product_detail_entry_type 		= isset($_POST['advance_entry_product_detail_entry_type'])?$_POST['advance_entry_product_detail_entry_type']:'';
$advance_entry_product_detail_s_weight_met		=isset($_POST['advance_entry_product_detail_s_weight_met'])?$_POST['advance_entry_product_detail_s_weight_met']:'';

		// purchase order pproduct details
		for($i = 0; $i < count($advance_entry_product_detail_product_id); $i++) {  
		// echo $advance_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($advance_entry_product_detail_product_id[$i])));
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
																				 advance_entry_product_detail_sl_feet_mm,advance_entry_product_detail_sl_feet_met,
																				 advance_entry_product_detail_s_weight_inches,advance_entry_product_detail_s_weight_mm,
																				 advance_entry_product_detail_qty,advance_entry_product_detail_tot_length,
																				 advance_entry_product_detail_rate,advance_entry_product_detail_total,
																				 advance_entry_product_detail_added_by, advance_entry_product_detail_added_on,
																				 advance_entry_product_detail_added_ip ,advance_entry_product_detail_entry_type,
																				  advance_entry_product_detail_s_weight_met) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d','%f' )", 
																		 $advance_entry_product_detail_uniq_id,$advance_entry_id,
																		 $advance_entry_product_detail_product_id[$i],$advance_entry_product_detail_product_uom_id[$i],
																		 $advance_entry_product_detail_product_brand_id[$i],$advance_entry_product_detail_product_color_id[$i],
																		 $advance_entry_product_detail_product_type[$i], $advance_entry_product_detail_product_thick[$i],
																		 $advance_entry_product_detail_width_inches[$i],$advance_entry_product_detail_width_mm[$i],
																		 $advance_entry_product_detail_s_width_inches[$i],$advance_entry_product_detail_s_width_mm[$i],
																		 $advance_entry_product_detail_sl_feet[$i],$advance_entry_product_detail_sl_feet_in[$i],
																		 $advance_entry_product_detail_sl_feet_mm[$i],$advance_entry_product_detail_sl_feet_met[$i],
																		 $advance_entry_product_detail_s_weight_inches[$i],$advance_entry_product_detail_s_weight_mm[$i],
																		 $advance_entry_product_detail_qty[$i],$advance_entry_product_detail_tot_length[$i],
																		 $advance_entry_product_detail_rate[$i],$advance_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$advance_entry_product_detail_entry_type[$i],
																		 $advance_entry_product_detail_s_weight_met[$i]);
																		// echo $insert_advance_entry_product_detail; exit;
				mysql_query($insert_advance_entry_product_detail);
				$detail_id			= mysql_insert_id();
				if($_SESSION[SESS.'_session_user_branch_type']==1){
					if($advance_entry_product_detail_entry_type[$i]=='4'){
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"sales-advance";
								$godown_id										= 	"2";
								$produt_id										=	$advance_entry_product_detail_product_id[$i];
								$produt_qty										=	(-1*$advance_entry_product_detail_qty[$i]);
								
							stockLedger('out',$advance_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $advance_entry_branch_id,  $godown_id, $advance_entry_date, $advance_entry_no,$stock_ledger_entry_type,'1',$advance_entry_net_amount);
							
					}
					else{
					$produt_id											=	$advance_entry_product_detail_product_id[$i];
					$product_colour_id									=	$advance_entry_product_detail_product_color_id[$i];
					$product_thick										=	$advance_entry_product_detail_product_thick[$i];
					$width_inches										= 	$advance_entry_product_detail_width_inches[$i];
					$width_mm											= 	$advance_entry_product_detail_width_mm[$i];
					$ton_qty											= 	$advance_entry_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$advance_entry_product_detail_s_weight_mm[$i];
					$tot_length											= 	$advance_entry_product_detail_tot_length[$i];
					$product_detail_qty									= 	$advance_entry_product_detail_qty[$i];
					$entry_type											= 	"sales-advance";
					reduceRawMaterial($produt_id,$product_thick,$product_colour_id,$width_inches,$tot_length,$advance_entry_no,$advance_entry_date,$advance_entry_id,$detail_id,$advance_entry_branch_id,$entry_type,$advance_entry_product_detail_entry_type[$i],$ton_qty,$kg_qty,$product_detail_qty);	
					}
				}
			}
		}
		$acc_dr_id= '';
			/*$setup_detail	= ($advance_entry_branch_id);
			if($invoice_entry_payment_mode==2){
		   
			$acc_col_dr_id	= $advance_entry_acc_bank_id;
		}
		else{
		    
			$acc_col_dr_id	= $setup_detail['acS_sales_ac2'];
		}*/
		$acc_dr_id		= getMasterID($advance_entry_customer_id, 'customer');
		$acc_cr_id		= $advance_entry_acc_bank_id;
		$currency_amt	= getCurrencyAmt($acc_cr_id,$advance_entry_date);
		$acc_amount		= $advance_entry_advance_amount/$currency_amt;
		
		if($advance_entry_advance_amount>0){ //echo $advance_entry_id;exit;
		update_transaction($advance_entry_id, $advance_entry_no, $advance_entry_date, 'sales-advance', $acc_dr_id, $acc_cr_id, 'D', $advance_entry_advance_amount, $advance_entry_remark, $advance_entry_branch_id,$acc_amount);	
		update_transaction($advance_entry_id, $advance_entry_no, $advance_entry_date, 'sales-advance', $acc_cr_id, $acc_dr_id, 'C', $advance_entry_advance_amount, $advance_entry_remark, $advance_entry_branch_id,$acc_amount);
		}			
		
		//exit;
		pageRedirection("advance-entry/index.php?page=add&msg=1&print_status=1&advance_id=$advance_entry_uniq_id");
	}
	


	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND advance_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND advance_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['advance_entry_customer_id']))&& !empty($_REQUEST['advance_entry_customer_id']))
		{
		$where.="AND advance_entry_customer_id ='".$_REQUEST['advance_entry_customer_id']."'";
		}
		$select_advance_entry		=	"SELECT 

												advance_entry_id,

												advance_entry_uniq_id,

												advance_entry_no,

												advance_entry_date,

												customer_name,

												advance_entry_validity_date,
												branch_prefix

											 FROM 

												advance_entry

											 LEFT JOIN
												customers
											 ON
												customer_id		=  advance_entry_customer_id
											 LEFT JOIN
												branches
											 ON
												branch_id		=  advance_entry_branch_id
											 WHERE 

												advance_entry_deleted_status 	= 	0 $where

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
												LEFT JOIN customers ON customer_id =advance_entry_customer_id
												LEFT JOIN
												branches
											 ON
												branch_id		=  advance_entry_branch_id
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
															p_uom.product_uom_id 									= product_purchase_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 								= advance_entry_product_detail_product_color_id
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
		
		$advance_entry_dis_per                 			= trim($_POST['advance_entry_dis_per']);
		$advance_entry_dis_amount                 		= trim($_POST['advance_entry_dis_amount']);
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
															advance_entry_dis_per 					= '%f',

															advance_entry_dis_amount 					= '%f',

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
															$advance_entry_dis_per,
															$advance_entry_dis_amount,
															$advance_entry_advance_amount,

															$advance_entry_net_amount,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$advance_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

$advance_entry_product_detail_product_type      = $_POST['advance_entry_product_detail_product_type'];
$advance_entry_product_detail_product_id     	= $_POST['advance_entry_product_detail_product_id'];
$advance_entry_product_detail_product_uom_id    = $_POST['advance_entry_product_detail_product_uom_id'];
$advance_entry_product_detail_product_brand_id  = isset($_POST['advance_entry_product_detail_product_brand_id'])?$_POST['advance_entry_product_detail_product_brand_id']:'';

$advance_entry_product_detail_width_inches  	= isset($_POST['advance_entry_product_detail_width_inches'])?$_POST['advance_entry_product_detail_width_inches']:'';
$advance_entry_product_detail_width_mm 		  	= isset($_POST['advance_entry_product_detail_width_mm'])?$_POST['advance_entry_product_detail_width_mm']:'';
$advance_entry_product_detail_s_width_inches 	= isset($_POST['advance_entry_product_detail_s_width_inches'])?$_POST['advance_entry_product_detail_s_width_inches']:'';
$advance_entry_product_detail_s_width_mm 		= isset($_POST['advance_entry_product_detail_s_width_mm'])?$_POST['advance_entry_product_detail_s_width_mm']:'';
$advance_entry_product_detail_sl_feet 		  	= isset($_POST['advance_entry_product_detail_sl_feet'])?$_POST['advance_entry_product_detail_sl_feet']:'';
$advance_entry_product_detail_sl_feet_in 		= isset($_POST['advance_entry_product_detail_sl_feet_in'])?$_POST['advance_entry_product_detail_sl_feet_in']:'';
$advance_entry_product_detail_sl_feet_mm 		= isset($_POST['advance_entry_product_detail_sl_feet_mm'])?$_POST['advance_entry_product_detail_sl_feet_mm']:'';
$advance_entry_product_detail_sl_feet_met 		= isset($_POST['advance_entry_product_detail_sl_feet_met'])?$_POST['advance_entry_product_detail_sl_feet_met']:'';
$advance_entry_product_detail_s_weight_inches   = isset($_POST['advance_entry_product_detail_s_weight_inches'])?$_POST['advance_entry_product_detail_s_weight_inches']:'';
$advance_entry_product_detail_s_weight_mm   	= isset($_POST['advance_entry_product_detail_s_weight_mm'])?$_POST['advance_entry_product_detail_s_weight_mm']:'';
$advance_entry_product_detail_qty 			  	= $_POST['advance_entry_product_detail_qty'];
$advance_entry_product_detail_tot_length 		= isset($_POST['advance_entry_product_detail_tot_length'])?$_POST['advance_entry_product_detail_tot_length']:'';
$advance_entry_product_detail_inv_tot_length 		= isset($_POST['advance_entry_product_detail_inv_tot_length'])?$_POST['advance_entry_product_detail_inv_tot_length']:'';
$advance_entry_product_detail_rate 			  	= $_POST['advance_entry_product_detail_rate'];
$advance_entry_product_detail_total 			= $_POST['advance_entry_product_detail_total'];

$advance_entry_product_detail_product_color_id 	= isset($_POST['advance_entry_product_detail_product_color_id'])?$_POST['advance_entry_product_detail_product_color_id']:'';
$advance_entry_product_detail_product_thick 	= isset($_POST['advance_entry_product_detail_product_thick'])?$_POST['advance_entry_product_detail_product_thick']:'';
$advance_entry_product_detail_entry_type 		= isset($_POST['advance_entry_product_detail_entry_type'])?$_POST['advance_entry_product_detail_entry_type']:'';
$advance_entry_product_detail_s_weight_met		=isset($_POST['advance_entry_product_detail_s_weight_met'])?$_POST['advance_entry_product_detail_s_weight_met']:'';


$advance_entry_product_detail_id 			  	  = $_POST['advance_entry_product_detail_id'];

		for($i = 0; $i < count($advance_entry_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($advance_entry_product_detail_product_id[$i])) &&

									 (!empty($advance_entry_product_detail_qty[$i])));

			if($detail_request_fields) { 

				if(isset($advance_entry_product_detail_id[$i]) && (!empty($advance_entry_product_detail_id[$i]))) {

					 $update_advance_entry_product_detail = sprintf("UPDATE 
																			advance_entry_product_details 
																		SET  
																			advance_entry_product_detail_product_color_id		= '%d',
																			advance_entry_product_detail_product_thick			= '%d',
																			advance_entry_product_detail_width_inches  			= '%f',
																			advance_entry_product_detail_width_mm  				= '%f',
																			advance_entry_product_detail_s_width_inches  		= '%f',
																			advance_entry_product_detail_s_width_mm  			= '%f',
																			advance_entry_product_detail_sl_feet  				= '%f',
																			advance_entry_product_detail_sl_feet_in  			= '%f',
																			advance_entry_product_detail_sl_feet_mm  			= '%f',
																			advance_entry_product_detail_s_weight_inches  		= '%f',
																			advance_entry_product_detail_s_weight_mm  			= '%f',
																			advance_entry_product_detail_tot_length  			= '%f',
																			advance_entry_product_detail_qty  					= '%f',
																			advance_entry_product_detail_rate  					= '%f',
																			advance_entry_product_detail_total  				= '%f',
																			advance_entry_product_detail_modified_by 			= '%d',
																			advance_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			advance_entry_product_detail_modified_ip 			= '%s',
																			advance_entry_product_detail_s_weight_met			='%f'
																		WHERE 
																			advance_entry_product_detail_advance_entry_id 		= '%d' AND 
																			advance_entry_product_detail_id 					= '%d'",
																			$advance_entry_product_detail_product_color_id[$i],
																			$advance_entry_product_detail_product_thick[$i],
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
																			$advance_entry_product_detail_id[$i],
																			$advance_entry_product_detail_s_weight_met[$i]);	
			//	echo $update_advance_entry_product_detail; exit;
					mysql_query($update_advance_entry_product_detail);

					$detail_id	= $advance_entry_product_detail_id[$i];	

				} else {

					$advance_entry_product_detail_uniq_id 	= generateUniqId();

					 $insert_advance_entry_product_detail 		= sprintf("INSERT INTO advance_entry_product_details 
																				(advance_entry_product_detail_uniq_id,advance_entry_product_detail_advance_entry_id,
																				 advance_entry_product_detail_product_id,advance_entry_product_detail_product_uom_id,
																				 advance_entry_product_detail_product_brand_id,advance_entry_product_detail_product_color_id,
																				 advance_entry_product_detail_product_type, advance_entry_product_detail_product_thick,
																				 advance_entry_product_detail_width_inches,advance_entry_product_detail_width_mm,
																				 advance_entry_product_detail_s_width_inches,advance_entry_product_detail_s_width_mm,
																				 advance_entry_product_detail_sl_feet,advance_entry_product_detail_sl_feet_in,
																				 advance_entry_product_detail_sl_feet_mm,advance_entry_product_detail_sl_feet_met,
																				 advance_entry_product_detail_s_weight_inches,advance_entry_product_detail_s_weight_mm,
																				 advance_entry_product_detail_qty,advance_entry_product_detail_tot_length,
																				 advance_entry_product_detail_rate,advance_entry_product_detail_total,
																				 advance_entry_product_detail_added_by, advance_entry_product_detail_added_on,
																				 advance_entry_product_detail_added_ip,advance_entry_product_detail_entry_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )", 
																		 $advance_entry_product_detail_uniq_id,$advance_entry_id,
																		 $advance_entry_product_detail_product_id[$i],$advance_entry_product_detail_product_uom_id[$i],
																		 $advance_entry_product_detail_product_brand_id[$i],$advance_entry_product_detail_product_color_id[$i],
																		 $advance_entry_product_detail_product_type[$i], $advance_entry_product_detail_product_thick[$i],
																		 $advance_entry_product_detail_width_inches[$i],$advance_entry_product_detail_width_mm[$i],
																		 $advance_entry_product_detail_s_width_inches[$i],$advance_entry_product_detail_s_width_mm[$i],
																		 $advance_entry_product_detail_sl_feet[$i],$advance_entry_product_detail_sl_feet_in[$i],
																		 $advance_entry_product_detail_sl_feet_mm[$i],$advance_entry_product_detail_sl_feet_met[$i],
																		 $advance_entry_product_detail_s_weight_inches[$i],$advance_entry_product_detail_s_weight_mm[$i],
																		 $advance_entry_product_detail_qty[$i],$advance_entry_product_detail_tot_length[$i],
																		 $advance_entry_product_detail_rate[$i],$advance_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$advance_entry_product_detail_entry_type[$i]);exit;
																		// echo $insert_advance_entry_product_detail; exit;
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
		
			$setup_detail	= GetBranchAccSetup($advance_entry_branch_id);
		$acc_dr_id		= getMasterID($advance_entry_customer_id, 'customer');
		$acc_cr_id		= $setup_detail['acS_sales_ac1'];
		$currency_amt	= getCurrencyAmt($acc_cr_id,$advance_entry_date);
		$acc_amount		= $advance_entry_advance_amount/$currency_amt;
		
		if($advance_entry_advance_amount>0){
		update_transaction($advance_entry_id, $advance_entry_no, $advance_entry_date, 'sales-advance', $acc_dr_id, $acc_cr_id, 'D', $advance_entry_advance_amount, $advance_entry_remark, $advance_entry_branch_id,$acc_amount);	
		update_transaction($advance_entry_id, $advance_entry_no, $advance_entry_date, 'sales-advance', $acc_cr_id, $acc_dr_id, 'C', $advance_entry_advance_amount, $advance_entry_remark, $advance_entry_branch_id,$acc_amount);			
		}
		
		pageRedirection("advance-entry/index.php?page=edit&id=$advance_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['advance_entry_uniq_id'])))

		{

			$product_detail_id 		 	= $_GET['product_detail_id'];
			$advance_entry_uniq_id 		= $_GET['advance_entry_uniq_id'];
			$stock_ledger_entry_type	= "sales-advance";
			$advance_entry_id 			= getId('advance_entry', 'advance_entry_id', 'advance_entry_uniq_id', $advance_entry_uniq_id); 
			DeleteStockLedger($stock_ledger_entry_type,$advance_entry_id,$product_detail_id);
			mysql_query("UPDATE 
							advance_entry_product_details 
						 SET 
						  	advance_entry_product_detail_deleted_status = 1 
						WHERE 
							advance_entry_product_detail_id = ".$product_detail_id." ");
			header("Location:index.php?page=edit&id=$advance_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){
		$checked      = $_POST['deleteCheck'];
		$count 		  = count($checked);
		for($i=0; $i < $count; $i++) 
		{ 
			$deleteCheck 					= $checked[$i]; 
			$advance_entry_id 			= getId('advance_entry', 'advance_entry_id', 'advance_entry_uniq_id', $deleteCheck); 
			$select_grn_ch_detal			= "SELECT
													*
												FROM
													advance_entry_product_details
												WHERE
													advance_entry_product_detail_deleted_status		= 0							AND
													advance_entry_product_detail_advance_entry_id	= '".$advance_entry_id."'";
			 $result_grn_ch_detal 			= mysql_query($select_grn_ch_detal);
			 $response =array();
			 $stock_ledger_entry_type		= "sales-advance";
			 while($resultChData = mysql_fetch_array($result_grn_ch_detal)){
					$stock_ledger_entry_detail_id	= $resultChData['advance_entry_product_detail_id'];
					DeleteStockLedger($stock_ledger_entry_type,$advance_entry_id,$stock_ledger_entry_detail_id);
			 }
		}
				
		deleteUniqRecords('advance_entry', 'advance_entry_deleted_by', 'advance_entry_deleted_on' , 'advance_entry_deleted_ip','advance_entry_deleted_status', 'advance_entry_id', 'advance_entry_uniq_id', '1');
		

		deleteMultiRecords('advance_entry_product_details', 'advance_entry_product_detail_deleted_by', 'advance_entry_product_detail_deleted_on', 'advance_entry_product_detail_deleted_ip', 'advance_entry_product_detail_deleted_status', 'advance_entry_product_detail_advance_entry_id', 'advance_entry','advance_entry_id','advance_entry_uniq_id', '1');  



		

		pageRedirection("advance-entry/index.php?msg=7");				

	}

?>