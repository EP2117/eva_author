<?php
function bank($type){

$select="SELECT *	FROM account_sub WHERE account_sub_deleted_status=	0 AND account_sub_type_id = '".$type."' "; 
//echo $select;exit;
$query=mysql_query($select);
while($result=mysql_fetch_array($query)){

$arr_bank[]=$result;
}
return $arr_bank;
}
   

	function insertInvoice(){
	
     $select_branch	= "SELECT branch_prefix FROM branches WHERE  branch_id = '".$_POST['invoice_entry_branch_id']."' ";
		//echo $select_branch;exit;
		$result_branch = mysql_query($select_branch);
		$res = mysql_fetch_array($result_branch);
		
	//print_r($_POST);exit;
		$invoice_entry_no 								=$res['branch_prefix'].GetAutoNo($_POST['invoice_entry_branch_id']);
		//$invoice_entry_no1                   			= trim($_POST['invoice_entry_no']);
		//$invoice_entry_no    =         empty($invoice_entry_no1)?$res['branch_prefix'].GetAutoNo($_POST['invoice_entry_branch_id']):$invoice_entry_no1;
		//echo $invoice_entry_no;exit;
		$invoice_entry_branch_id                   		= trim($_POST['invoice_entry_branch_id']);
		$invoice_entry_type_id                   		= implode(",",$_POST['invoice_entry_type_id']);
		$invoice_entry_date                 			= NdateDatabaseFormat($_POST['invoice_entry_date']);
		$invoice_entry_customer_id            			= trim($_POST['invoice_entry_customer_id']);
		$invoice_entry_validity_date                 	= NdateDatabaseFormat($_POST['invoice_entry_validity_date']);
		$invoice_entry_gross_amount                 	= trim($_POST['invoice_entry_gross_amount']);
		$invoice_entry_transport_amount                 = trim($_POST['invoice_entry_transport_amount']);
		$invoice_entry_tax_per                 			= (isset($_POST['invoice_entry_tax_per']))?trim($_POST['invoice_entry_tax_per']):'';
		$invoice_entry_tax_amount                 		= (isset($_POST['invoice_entry_tax_per']))?trim($_POST['invoice_entry_tax_amount']):'';
		$invoice_entry_advance_amount                	= trim($_POST['invoice_entry_advance_amount']);
		$invoice_entry_net_amount                 		= trim($_POST['invoice_entry_net_amount']);
		$invoice_entry_total_amount                		= trim($_POST['invoice_entry_total_amount']);
		$invoice_entry_credit_days						= trim($_POST['invoice_entry_credit_days']);
		$invoice_entry_due_date							= NdateDatabaseFormat($_POST['invoice_entry_due_date']);
		$invoice_entry_prd_type							= trim($_POST['invoice_entry_prd_type']);
		$invoice_entry_remarks							= trim($_POST['invoice_entry_remarks']);
		$invoice_entry_dis_per                 			= trim($_POST['invoice_entry_dis_per']);
		$invoice_entry_dis_amount                 		= trim($_POST['invoice_entry_dis_amount']);
		 $invoice_entry_tax_status                    = $_POST['invoice_entry_tax_status'];
		 $invoice_entry_payment_mode                    = $_POST['invoice_entry_payment_mode'];
		 $invoice_entry_acc_bank_id                    = $_POST['invoice_entry_acc_bank_id']; 
		 $invoice_entry_brand_id                    = $_POST['invoice_entry_brand_id']; 
		 
		$request_fields 									= ((!empty($invoice_entry_branch_id)) && (!empty($invoice_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "direct-invoice-entry/index.php?page=add&msg=5");
		$invoice_entry_uniq_id							= generateUniqId();
		$ip													= getRealIpAddr();
		     $insert_invoice_entry 							= sprintf("INSERT INTO invoice_entry  (invoice_entry_uniq_id, invoice_entry_date,
																					  		  invoice_entry_customer_id,invoice_entry_validity_date,
																							  invoice_entry_gross_amount,invoice_entry_transport_amount,
																							  invoice_entry_tax_per,invoice_entry_tax_amount,
																							  invoice_entry_advance_amount,invoice_entry_net_amount,
																					   		  invoice_entry_no,invoice_entry_type_id,
																					  		  invoice_entry_branch_id,invoice_entry_added_by,
																					   		  invoice_entry_added_on,invoice_entry_added_ip,
																			   		   		  invoice_entry_company_id,invoice_entry_financial_year,
																							  invoice_entry_direct_type,invoice_entry_credit_days,
																							  invoice_entry_due_date,invoice_entry_prd_type,
																							  invoice_entry_remark,invoice_entry_dis_per,
																							  invoice_entry_dis_amount, invoice_entry_tax_status,
																							  invoice_entry_payment_mode, invoice_entry_acc_bank_id,
																							  invoice_entry_total_amount,invoice_entry_brand_id) 
																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%s', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%s', '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d','%d',
																							  '%d','%s','%d',
																							  '%s','%f', '%f', '%d',
																							  '%d', '%d','%f','%d')", 
																		  	   		   		 $invoice_entry_uniq_id, $invoice_entry_date,
																					   		 $invoice_entry_customer_id,$invoice_entry_validity_date,
																					   		 $invoice_entry_gross_amount,$invoice_entry_transport_amount,
																							 $invoice_entry_tax_per,$invoice_entry_tax_amount,
																					   		 $invoice_entry_advance_amount,$invoice_entry_net_amount,
																					   		 $invoice_entry_no,$invoice_entry_type_id,
																					   		 $invoice_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],1,
																							 $invoice_entry_credit_days,$invoice_entry_due_date,
																							 $invoice_entry_prd_type,$invoice_entry_remarks,
																							 $invoice_entry_dis_per,$invoice_entry_dis_amount, 
																							 $invoice_entry_tax_status,
																							 $invoice_entry_payment_mode, $invoice_entry_acc_bank_id,
																							 $invoice_entry_total_amount,$invoice_entry_brand_id);
																							 
		//echo $insert_invoice_entry; exit;
		mysql_query($insert_invoice_entry);
		$invoice_entry_id 								= mysql_insert_id(); 
		
		
		//Product Detail
$invoice_entry_product_detail_product_type      = $_POST['invoice_entry_product_detail_product_type'];
$invoice_entry_product_detail_product_id     	= $_POST['invoice_entry_product_detail_product_id'];
$invoice_entry_product_detail_product_uom_id    = $_POST['invoice_entry_product_detail_product_uom_id'];
$invoice_entry_product_detail_product_brand_id  = isset($_POST['invoice_entry_product_detail_product_brand_id'])?$_POST['invoice_entry_product_detail_product_brand_id']:'';
$invoice_entry_product_detail_product_color_id  = isset($_POST['invoice_entry_product_detail_product_color_id'])?$_POST['invoice_entry_product_detail_product_color_id']:'';
$invoice_entry_product_detail_product_thick  	= isset($_POST['invoice_entry_product_detail_product_thick'])?$_POST['invoice_entry_product_detail_product_thick']:'';
$invoice_entry_product_detail_width_inches  	= isset($_POST['invoice_entry_product_detail_width_inches'])?$_POST['invoice_entry_product_detail_width_inches']:'';
$invoice_entry_product_detail_width_mm 		  	= isset($_POST['invoice_entry_product_detail_width_mm'])?$_POST['invoice_entry_product_detail_width_mm']:'';
$invoice_entry_product_detail_s_width_inches 	= isset($_POST['invoice_entry_product_detail_s_width_inches'])?$_POST['invoice_entry_product_detail_s_width_inches']:'';
$invoice_entry_product_detail_s_width_mm 		= isset($_POST['invoice_entry_product_detail_s_width_mm'])?$_POST['invoice_entry_product_detail_s_width_mm']:'';
$invoice_entry_product_detail_sl_feet 		  	= isset($_POST['invoice_entry_product_detail_sl_feet'])?$_POST['invoice_entry_product_detail_sl_feet']:'';
$invoice_entry_product_detail_sl_feet_in 		= isset($_POST['invoice_entry_product_detail_sl_feet_in'])?$_POST['invoice_entry_product_detail_sl_feet_in']:'';
$invoice_entry_product_detail_sl_feet_mm 		= isset($_POST['invoice_entry_product_detail_sl_feet_mm'])?$_POST['invoice_entry_product_detail_sl_feet_mm']:'';
$invoice_entry_product_detail_sl_feet_met 		= isset($_POST['invoice_entry_product_detail_sl_feet_met'])?$_POST['invoice_entry_product_detail_sl_feet_met']:'';
$invoice_entry_product_detail_s_weight_inches   = isset($_POST['invoice_entry_product_detail_s_weight_inches'])?$_POST['invoice_entry_product_detail_s_weight_inches']:'';
$invoice_entry_product_detail_s_weight_mm   	= isset($_POST['invoice_entry_product_detail_s_weight_mm'])?$_POST['invoice_entry_product_detail_s_weight_mm']:'';

$invoice_entry_product_detail_qty 			  	= $_POST['invoice_entry_product_detail_qty'];
$invoice_entry_product_detail_tot_length 		= isset($_POST['invoice_entry_product_detail_tot_length'])?$_POST['invoice_entry_product_detail_tot_length']:'';
$invoice_entry_product_detail_inv_tot_length 	= isset($_POST['invoice_entry_product_detail_inv_tot_length'])?$_POST['invoice_entry_product_detail_inv_tot_length']:'';
$invoice_entry_product_detail_rate 			 	= $_POST['invoice_entry_product_detail_rate'];
$invoice_entry_product_detail_total 			= $_POST['invoice_entry_product_detail_total'];
$invoice_entry_product_detail_entry_type 		= $_POST['invoice_entry_product_detail_entry_type'];
$invoice_entry_product_detail_s_weight_met		= $_POST['invoice_entry_product_detail_s_weight_met'];
$invoice_entry_product_detail_mother_child_type		= $_POST['invoice_entry_product_detail_mother_child_type'];

		// purchase order pproduct details
		for($i = 0; $i < count($invoice_entry_product_detail_product_id); $i++) { 
		// echo $invoice_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($invoice_entry_product_detail_product_id[$i])) );
			if($detail_request_fields) {
				$invoice_entry_product_detail_uniq_id 	= generateUniqId();
				    if((($invoice_entry_product_detail_entry_type[$i]!=2) && $invoice_entry_product_detail_qty[$i]>0) || (($invoice_entry_product_detail_entry_type[$i]==2) && $invoice_entry_product_detail_s_weight_inches[$i]>0)){
				   $insert_invoice_entry_product_detail 		= sprintf("INSERT INTO invoice_entry_product_details 
																				(invoice_entry_product_detail_uniq_id,
																				invoice_entry_product_detail_invoice_entry_id,
																				 invoice_entry_product_detail_product_id,
																				 invoice_entry_product_detail_product_type, 
																				 invoice_entry_product_detail_product_thick,
																				 invoice_entry_product_detail_width_inches,
																				 invoice_entry_product_detail_width_mm,
																				 invoice_entry_product_detail_s_width_inches,
																				 invoice_entry_product_detail_s_width_mm,
																				 invoice_entry_product_detail_sl_feet,
																				 invoice_entry_product_detail_sl_feet_in,
																				 invoice_entry_product_detail_sl_feet_mm,
																				 invoice_entry_product_detail_sl_feet_met,
																				 invoice_entry_product_detail_s_weight_inches,
																				 invoice_entry_product_detail_s_weight_mm,
																				 invoice_entry_product_detail_qty,invoice_entry_product_detail_tot_length,
																				 invoice_entry_product_detail_rate,invoice_entry_product_detail_total,
																				 invoice_entry_product_detail_added_by, invoice_entry_product_detail_added_on,
																				 invoice_entry_product_detail_added_ip,invoice_entry_product_detail_color_id,
																				 invoice_entry_product_detail_entry_type,
																				 invoice_entry_product_detail_s_weight_met,
																				 invoice_entry_product_detail_mother_child_type) 
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
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d','%d','%f','%d')", 
																		 $invoice_entry_product_detail_uniq_id,$invoice_entry_id,
																		 $invoice_entry_product_detail_product_id[$i],
																		 $invoice_entry_product_detail_product_type[$i], 
																		 $invoice_entry_product_detail_product_thick[$i],
																		 $invoice_entry_product_detail_width_inches[$i],
																		 $invoice_entry_product_detail_width_mm[$i],
																		 $invoice_entry_product_detail_s_width_inches[$i],
																		 $invoice_entry_product_detail_s_width_mm[$i],
																		 $invoice_entry_product_detail_sl_feet[$i],
																		 $invoice_entry_product_detail_sl_feet_in[$i],
																		 $invoice_entry_product_detail_sl_feet_mm[$i],
																		 $invoice_entry_product_detail_sl_feet_met[$i],
																		 $invoice_entry_product_detail_s_weight_inches[$i],
																		 $invoice_entry_product_detail_s_weight_mm[$i],
																		 $invoice_entry_product_detail_qty[$i],
																		 $invoice_entry_product_detail_tot_length[$i],
																		 $invoice_entry_product_detail_rate[$i],
																		 $invoice_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $invoice_entry_product_detail_product_color_id[$i],
																		 $invoice_entry_product_detail_entry_type[$i],
																		 $invoice_entry_product_detail_s_weight_met[$i],
																		 $invoice_entry_product_detail_mother_child_type[$i]);
																//echo $insert_invoice_entry_product_detail; 
				mysql_query($insert_invoice_entry_product_detail);
				$detail_id			= mysql_insert_id();
	         }//echo $invoice_entry_product_detail_entry_type[$i];exit;
					if($invoice_entry_product_detail_entry_type[$i]=='3'){
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"invoice-direct";
								$godown_id										= 	"2"; //echo $length_feet;exit;
								$produt_id										=	$invoice_entry_product_detail_product_id[$i];
								$child_type										=	$invoice_entry_product_detail_mother_child_type[$i];
								
								$produt_qty										=	(-1*$invoice_entry_product_detail_qty[$i]);
								
							stockLedger($child_type,'out',$invoice_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $invoice_entry_branch_id,  $godown_id, $invoice_entry_date, $invoice_entry_no,$stock_ledger_entry_type,'1');
					}
					else{  //echo $invoice_entry_product_detail_s_weight_inches[$i];exit;
					$produt_id											=	$invoice_entry_product_detail_product_id[$i];
					$product_colour_id									=	$invoice_entry_product_detail_product_color_id[$i];
					$product_thick										=	$invoice_entry_product_detail_product_thick[$i];
					$width_inches										= 	$invoice_entry_product_detail_width_inches[$i];
					$width_mm											= 	$invoice_entry_product_detail_width_mm[$i];
					$ton_qty											= 	$invoice_entry_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$invoice_entry_product_detail_s_weight_mm[$i];
					$tot_length											= 	$invoice_entry_product_detail_tot_length[$i]; //echo $tot_length;exit;
					
					$child_type										    =	$invoice_entry_product_detail_mother_child_type[$i];
					$entry_type											= 	"invoice-direct";
					$length_feet										= 	$invoice_entry_product_detail_sl_feet[$i];
					$length_meter										= 	$invoice_entry_product_detail_sl_feet_met[$i];
					$godown_id										= 	"2";
					$produt_qty										=	(-1);
					//echo $ton_qty;
					/*reduceRawMaterial($child_type,$produt_id,$product_thick,$product_colour_id,$width_inches,$tot_length,$invoice_entry_no,$invoice_entry_date,$invoice_entry_id,$detail_id,$invoice_entry_branch_id,$entry_type,$invoice_entry_product_detail_entry_type[$i],$ton_qty,$kg_qty,$produt_qty,$invoice_entry_product_detail_sl_feet[$i]);*/

	stockLedger($child_type,'out',$invoice_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $invoice_entry_branch_id,  $godown_id, $invoice_entry_date, $invoice_entry_no,$entry_type,'2',$width_inches,$width_mm,$product_colour_id,$product_thick);
				}
			}
		}
		 $acc_dr_id= '';
		$setup_detail	= GetBranchAccSetup($invoice_entry_branch_id);
		
		if($invoice_entry_payment_mode==2){
		   
			$acc_col_dr_id	= $invoice_entry_acc_bank_id;
		}else{
		    
			$acc_col_dr_id	= $setup_detail['acS_sales_ac2'];
		}
		$acc_cr_id		= getMasterID($invoice_entry_customer_id, 'customer');
		$acc_dr_id		= $setup_detail['acS_sales'];
		$currency_amt	= getCurrencyAmt($acc_cr_id,$invoice_entry_date);
		$acc_amount		= $invoice_entry_net_amount/$currency_amt;
		//$acc_amount	= 0;
		
		if($invoice_entry_net_amount>0){
		update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'direct_Invoice', $acc_dr_id, $acc_cr_id, 'D', $invoice_entry_net_amount, $invoice_entry_remark, $invoice_entry_branch_id, $acc_amount);	
		update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'direct_Invoice', $acc_cr_id, $acc_dr_id, 'C', $invoice_entry_net_amount, $invoice_entry_remark, $invoice_entry_branch_id, $acc_amount);	
		}
		
		if($invoice_entry_advance_amount>0){
			update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'advance_invoice', $acc_col_dr_id, $acc_cr_id, 'C', $invoice_entry_advance_amount, $invoice_entry_remark, $invoice_entry_branch_id, $acc_amount);	
			update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'advance_invoice', $acc_cr_id, $acc_col_dr_id, 'D', $invoice_entry_advance_amount, $invoice_entry_remark, $invoice_entry_branch_id, $acc_amount);			
		}
		
		pageRedirection("direct-invoice-entry/index.php?page=add&msg=1&print_status=1&inv_id=$invoice_entry_id");
		
	}
	
function GetAutoNo($invoice_entry_branch_id)
{

		//echo $res;

		
      
		 $select_invoice_no = "SELECT MAX(SUBSTRING(invoice_entry_no,3,8))  AS maxval FROM invoice_entry 
								  WHERE invoice_entry_deleted_status =0
								  AND invoice_entry_direct_type =1
								  AND invoice_entry_branch_id = '".$invoice_entry_branch_id."'
								  AND invoice_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND invoice_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."'
								  AND invoice_entry_no !='OB' "; 

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	
//echo $select_invoice_no;exit;
		$maxval = $record_invoice_no['maxval']; 

//echo $record_invoice_no['maxval'];echo "<br>";
//echo $maxval;exit;
		if($maxval > 0) {

			$invoice_entry_no = substr(('00000'.++$maxval),-5);

		} else {

			$invoice_entry_no = substr(('00000'.++$maxval),-5);

		}
		return $invoice_entry_no;
	}
	function listInvoice(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND invoice_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND invoice_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['search_customer_id']))&& !empty($_REQUEST['search_customer_id']))
		{
		$where.="AND invoice_entry_customer_id ='".$_REQUEST['search_customer_id']."'";
		}
		 $select_invoice_entry		=	"SELECT 

												*

											 FROM 

												invoice_entry

											 LEFT JOIN

												customers

											 ON

												customer_id		=  invoice_entry_customer_id
											 LEFT JOIN
												branches
											 ON
												branch_id		=  invoice_entry_branch_id
											 WHERE 

												invoice_entry_deleted_status 	= 	0 AND
												invoice_entry_direct_type		=   1 $where
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

	function editInvoice(){

		$invoice_entry_id 			= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_invoice_entry		=	"SELECT 
												*
											 FROM 

												invoice_entry 
											LEFT JOIN
												customers
											ON
												customer_id						= invoice_entry_customer_id  
											LEFT JOIN
												salesmans
											ON
												salesman_id						= invoice_entry_salesman_id 
											 LEFT JOIN
												branches
											 ON
												branch_id		=  invoice_entry_branch_id													
											 WHERE 

												invoice_entry_deleted_status 	=  0 			AND 

												invoice_entry_id				= '".$invoice_entry_id."'

											 ORDER BY 

												invoice_entry_no ASC";

		$result_invoice_entry 		= mysql_query($select_invoice_entry);

		$record_invoice_entry 		= mysql_fetch_array($result_invoice_entry);

		return $record_invoice_entry;

	}

	function editInvoiceProductDetail()

	{

		$invoice_entry_id 	= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', dataValidation($_GET['id'])); 

	   $select_invoice_entry_product_detail 		= "SELECT 
															A.*,
															product_name,
															p_uom.product_uom_name as p_uom_name,
															product_code,
															product_thick_ness,
															invoice_entry_product_detail_product_type,
															p_clr.product_colour_name as p_colour_name,
															brand_name,
															product_brand_id as brand_id ,
															product_purchase_uom_id as uom_id
														FROM 
															invoice_entry_product_details A
														LEFT JOIN 
															products 
														ON 
															product_id 												= invoice_entry_product_detail_product_id
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 									= product_purchase_uom_id
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 								= invoice_entry_product_detail_color_id
														
														LEFT JOIN 
															brands 
														ON 
															brand_id 												= 	product_brand_id
														WHERE 
															invoice_entry_product_detail_deleted_status		 	= 0 
															AND invoice_entry_product_detail_mother_child_type=1
															AND 
															invoice_entry_product_detail_invoice_entry_id 		= '".$invoice_entry_id."'";

		$result_quotation_entry_product_detail 	= mysql_query($select_invoice_entry_product_detail);
		$count_quotation_entry 					= mysql_num_rows($result_quotation_entry_product_detail);
		$arr_quotation_entry_product_detail 	= array();
		while($record_quotation_entry_product_detail = mysql_fetch_array($result_quotation_entry_product_detail)) {
			$arr_quotation_entry_product_detail[] = $record_quotation_entry_product_detail;
		}
		 $select_invoice_entry_product_detail1 		= "SELECT 
															A.*,
															product_uom_name as p_uom_name,
															thick_val as product_thick_ness,
															invoice_entry_product_detail_product_type,
															product_con_entry_child_product_detail_code as product_code,
															product_con_entry_child_product_detail_name as product_name,
															product_con_entry_child_product_detail_width_inches,
															product_con_entry_child_product_detail_product_id,
															product_colour_name as p_colour_name,
															brand_name,
															product_con_entry_child_product_detail_product_brand_id as brand_id ,
															product_con_entry_child_product_detail_uom_id as uom_id
														FROM 
															invoice_entry_product_details A
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id				= invoice_entry_product_detail_product_id	
														LEFT JOIN 
															product_uoms 
														ON 
															product_uom_id 								= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours  
														ON 
															product_colour_id 								= product_con_entry_child_product_detail_color_id
														LEFT JOIN 
															thickness  
														ON 
															thick_id 								= invoice_entry_product_detail_product_thick
														LEFT JOIN 
															brands 
														ON 
															brand_id 												= 	product_con_entry_child_product_detail_product_brand_id
														WHERE 
															invoice_entry_product_detail_deleted_status		 	= 0 
															AND invoice_entry_product_detail_mother_child_type=2
															AND invoice_entry_product_detail_invoice_entry_id 		= '".$invoice_entry_id."'";
		//echo $select_invoice_entry_product_detail1;exit;
		$result_quotation_entry_product_detail1 	= mysql_query($select_invoice_entry_product_detail1);
		$count_quotation_entry1 					= mysql_num_rows($result_quotation_entry_product_detail1);

		while($record_quotation_entry_product_detail1 = mysql_fetch_array($result_quotation_entry_product_detail1)) {
			$arr_quotation_entry_product_detail[] = $record_quotation_entry_product_detail1;
		}
		return $arr_quotation_entry_product_detail;
	}

	function updateinvoice(){
		$invoice_entry_id                   			= trim($_POST['invoice_entry_id']);
		$invoice_entry_uniq_id                			= trim($_POST['invoice_entry_uniq_id']);
		$invoice_entry_no                			    = trim($_POST['invoice_entry_no']);
		$invoice_entry_branch_id                   		= trim($_POST['invoice_entry_branch_id']);
		$invoice_entry_type_id							= implode(",",$_POST['invoice_entry_type_id']);
		$invoice_entry_date                 			= NdateDatabaseFormat($_POST['invoice_entry_date']);
		$invoice_entry_customer_id            			= trim($_POST['invoice_entry_customer_id']);
		$invoice_entry_validity_date      				= NdateDatabaseFormat($_POST['invoice_entry_validity_date']);
		$invoice_entry_gross_amount                 	= trim($_POST['invoice_entry_gross_amount']);
		$invoice_entry_transport_amount                 = trim($_POST['invoice_entry_transport_amount']);
    	$invoice_entry_tax_per                 			= (isset($_POST['invoice_entry_tax_per']))?trim($_POST['invoice_entry_tax_per']):'';
		$invoice_entry_tax_amount                 		= (isset($_POST['invoice_entry_tax_per']))?trim($_POST['invoice_entry_tax_amount']):'';
		$invoice_entry_advance_amount                	= trim($_POST['invoice_entry_advance_amount']);
		$invoice_entry_net_amount                 		= trim($_POST['invoice_entry_net_amount']);
		$invoice_entry_total_amount                		= trim($_POST['invoice_entry_total_amount']);
		$invoice_entry_remarks                 			= trim($_POST['invoice_entry_remarks']);
		//$invoice_entry_so_entry_id     					= trim($_POST['invoice_entry_so_entry_id']);
		$invoice_entry_dis_per                 			= trim($_POST['invoice_entry_dis_per']);
		$invoice_entry_dis_amount                 		= trim($_POST['invoice_entry_dis_amount']);
		$invoice_entry_credit_days						= trim($_POST['invoice_entry_credit_days']);
		$invoice_entry_due_date							= NdateDatabaseFormat($_POST['invoice_entry_due_date']);
		$invoice_entry_prd_type							= trim($_POST['invoice_entry_prd_type']);
		
		$invoice_entry_tax_status						= $_POST['invoice_entry_tax_status'];
		$invoice_entry_payment_mode                    = $_POST['invoice_entry_payment_mode'];
		 $invoice_entry_acc_bank_id                    = $_POST['invoice_entry_acc_bank_id'];
		 $invoice_entry_brand_id                    = $_POST['invoice_entry_brand_id']; 
	
		$request_fields 									= ((!empty($invoice_entry_branch_id)) && (!empty($invoice_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "direct-invoice-entry/index.php?page=edit&id=$invoice_entry_uniq_id");
		$ip												= getRealIpAddr();

		 $update_customer 					= sprintf("	UPDATE 
															invoice_entry 
														SET 
															invoice_entry_branch_id 			= '%d',
															invoice_entry_date 					= '%s',
															invoice_entry_customer_id 			= '%d',
															invoice_entry_validity_date 		= '%s',
															invoice_entry_gross_amount 			= '%f',
															invoice_entry_transport_amount 		= '%f',
															invoice_entry_tax_per 				= '%f',
															invoice_entry_tax_amount 			= '%f',
															invoice_entry_dis_per 				= '%f',
															invoice_entry_dis_amount 			= '%f',
															invoice_entry_advance_amount 		= '%f',
															invoice_entry_net_amount 			= '%f',
															invoice_entry_total_amount 			= '%f',
															invoice_entry_remark 				= '%s',
															invoice_entry_modified_by 			= '%d',
															invoice_entry_modified_on 			= UNIX_TIMESTAMP(NOW()),
															invoice_entry_modified_ip			= '%s',
															invoice_entry_credit_days			='%d',
															invoice_entry_brand_id				='%d',
															invoice_entry_due_date				='%s', 
															invoice_entry_tax_status			='%d',
															invoice_entry_payment_mode			='%d',
															invoice_entry_acc_bank_id			='%d'
														WHERE               
															invoice_entry_id         				= '%d'", 
															$invoice_entry_branch_id,
															$invoice_entry_date,
															$invoice_entry_customer_id,
															$invoice_entry_validity_date,
															$invoice_entry_gross_amount,
															$invoice_entry_transport_amount,
															$invoice_entry_tax_per,
															$invoice_entry_tax_amount,
															$invoice_entry_dis_per,
															$invoice_entry_dis_amount,
															$invoice_entry_advance_amount,
															$invoice_entry_net_amount,
															$invoice_entry_total_amount,
															$invoice_entry_remarks,
															$_SESSION[SESS.'_session_user_id'], 
															$ip,$invoice_entry_credit_days,
															$invoice_entry_brand_id,
															$invoice_entry_due_date,
															$invoice_entry_tax_status,
															$invoice_entry_payment_mode,
															$invoice_entry_acc_bank_id,
															$invoice_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

$invoice_entry_product_detail_product_type      = $_POST['invoice_entry_product_detail_product_type'];
$invoice_entry_product_detail_product_id     	= $_POST['invoice_entry_product_detail_product_id'];
$invoice_entry_product_detail_product_uom_id    = $_POST['invoice_entry_product_detail_product_uom_id'];
$invoice_entry_product_detail_product_brand_id  = isset($_POST['invoice_entry_product_detail_product_brand_id'])?$_POST['invoice_entry_product_detail_product_brand_id']:'';
$invoice_entry_product_detail_product_color_id  = isset($_POST['invoice_entry_product_detail_product_color_id'])?$_POST['invoice_entry_product_detail_product_color_id']:'';
$invoice_entry_product_detail_product_thick  	= isset($_POST['invoice_entry_product_detail_product_thick'])?$_POST['invoice_entry_product_detail_product_thick']:'';
$invoice_entry_product_detail_width_inches  	= isset($_POST['invoice_entry_product_detail_width_inches'])?$_POST['invoice_entry_product_detail_width_inches']:'';
$invoice_entry_product_detail_width_mm 		  	= isset($_POST['invoice_entry_product_detail_width_mm'])?$_POST['invoice_entry_product_detail_width_mm']:'';
$invoice_entry_product_detail_s_width_inches 	= isset($_POST['invoice_entry_product_detail_s_width_inches'])?$_POST['invoice_entry_product_detail_s_width_inches']:'';
$invoice_entry_product_detail_s_width_mm 		= isset($_POST['invoice_entry_product_detail_s_width_mm'])?$_POST['invoice_entry_product_detail_s_width_mm']:'';
$invoice_entry_product_detail_sl_feet 		  	= isset($_POST['invoice_entry_product_detail_sl_feet'])?$_POST['invoice_entry_product_detail_sl_feet']:'';
$invoice_entry_product_detail_sl_feet_in 		= isset($_POST['invoice_entry_product_detail_sl_feet_in'])?$_POST['invoice_entry_product_detail_sl_feet_in']:'';
$invoice_entry_product_detail_sl_feet_mm 		= isset($_POST['invoice_entry_product_detail_sl_feet_mm'])?$_POST['invoice_entry_product_detail_sl_feet_mm']:'';
$invoice_entry_product_detail_sl_feet_met 		= isset($_POST['invoice_entry_product_detail_sl_feet_met'])?$_POST['invoice_entry_product_detail_sl_feet_met']:'';
$invoice_entry_product_detail_s_weight_inches   = isset($_POST['invoice_entry_product_detail_s_weight_inches'])?$_POST['invoice_entry_product_detail_s_weight_inches']:'';
$invoice_entry_product_detail_s_weight_mm   	= isset($_POST['invoice_entry_product_detail_s_weight_mm'])?$_POST['invoice_entry_product_detail_s_weight_mm']:'';

$invoice_entry_product_detail_qty 			  	= $_POST['invoice_entry_product_detail_qty'];
$invoice_entry_product_detail_tot_length 		= isset($_POST['invoice_entry_product_detail_tot_length'])?$_POST['invoice_entry_product_detail_tot_length']:'';
$invoice_entry_product_detail_inv_tot_length 	= isset($_POST['invoice_entry_product_detail_inv_tot_length'])?$_POST['invoice_entry_product_detail_inv_tot_length']:'';
$invoice_entry_product_detail_rate 			 	= $_POST['invoice_entry_product_detail_rate'];
$invoice_entry_product_detail_total 			= $_POST['invoice_entry_product_detail_total'];
$invoice_entry_product_detail_entry_type 		= $_POST['invoice_entry_product_detail_entry_type'];
$invoice_entry_product_detail_s_weight_met		= $_POST['invoice_entry_product_detail_s_weight_met'];
$invoice_entry_product_detail_mother_child_type		= $_POST['invoice_entry_product_detail_mother_child_type'];

$invoice_entry_product_detail_id 			  	  = $_POST['invoice_entry_product_detail_id'];

	/*echo "<pre>";
	print_r($_POST);exit;*/

		for($i = 0; $i < count($invoice_entry_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($invoice_entry_product_detail_product_id[$i])) &&

									 (!empty($invoice_entry_product_detail_qty[$i])));

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
																			invoice_entry_product_detail_modified_ip 			= '%s',
																			invoice_entry_product_detail_color_id		= '%d',
																			invoice_entry_product_detail_product_thick			= '%d'	,
																			invoice_entry_product_detail_s_weight_met			='%f'	
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
																			$invoice_entry_product_detail_product_color_id[$i],
																			$invoice_entry_product_detail_product_thick[$i],
																			$invoice_entry_product_detail_s_weight_met[$i],
																			$invoice_entry_id, 
																			$invoice_entry_product_detail_id[$i]);	
		//echo $update_invoice_entry_product_detail; exit;
					mysql_query($update_invoice_entry_product_detail);

					$detail_id=$invoice_entry_product_detail_id[$i];


				} else {

					$invoice_entry_product_detail_uniq_id 	= generateUniqId();

					  if((($invoice_entry_product_detail_entry_type[$i]!=2) && $invoice_entry_product_detail_qty[$i]>0) || (($invoice_entry_product_detail_entry_type[$i]==2) && $invoice_entry_product_detail_s_weight_inches[$i]>0)){
					   $insert_invoice_entry_product_detail 		= sprintf("INSERT INTO invoice_entry_product_details 
																				(invoice_entry_product_detail_uniq_id,
																				invoice_entry_product_detail_invoice_entry_id,
																				 invoice_entry_product_detail_product_id,
																				 invoice_entry_product_detail_product_type, 
																				 invoice_entry_product_detail_product_thick,
																				 invoice_entry_product_detail_width_inches,
																				 invoice_entry_product_detail_width_mm,
																				 invoice_entry_product_detail_s_width_inches,
																				 invoice_entry_product_detail_s_width_mm,
																				 invoice_entry_product_detail_sl_feet,
																				 invoice_entry_product_detail_sl_feet_in,
																				 invoice_entry_product_detail_sl_feet_mm,
																				 invoice_entry_product_detail_sl_feet_met,
																				 invoice_entry_product_detail_s_weight_inches,
																				 invoice_entry_product_detail_s_weight_mm,
																				 invoice_entry_product_detail_qty,invoice_entry_product_detail_tot_length,
																				 invoice_entry_product_detail_rate,invoice_entry_product_detail_total,
																				 invoice_entry_product_detail_added_by, invoice_entry_product_detail_added_on,
																				 invoice_entry_product_detail_added_ip,invoice_entry_product_detail_color_id,
																				 invoice_entry_product_detail_entry_type,
																				 invoice_entry_product_detail_s_weight_met,
																				 invoice_entry_product_detail_mother_child_type) 
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
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d','%d','%f','%d')", 
																		 $invoice_entry_product_detail_uniq_id,$invoice_entry_id,
																		 $invoice_entry_product_detail_product_id[$i],
																		 $invoice_entry_product_detail_product_type[$i], 
																		 $invoice_entry_product_detail_product_thick[$i],
																		 $invoice_entry_product_detail_width_inches[$i],
																		 $invoice_entry_product_detail_width_mm[$i],
																		 $invoice_entry_product_detail_s_width_inches[$i],
																		 $invoice_entry_product_detail_s_width_mm[$i],
																		 $invoice_entry_product_detail_sl_feet[$i],
																		 $invoice_entry_product_detail_sl_feet_in[$i],
																		 $invoice_entry_product_detail_sl_feet_mm[$i],
																		 $invoice_entry_product_detail_sl_feet_met[$i],
																		 $invoice_entry_product_detail_s_weight_inches[$i],
																		 $invoice_entry_product_detail_s_weight_mm[$i],
																		 $invoice_entry_product_detail_qty[$i],
																		 $invoice_entry_product_detail_tot_length[$i],
																		 $invoice_entry_product_detail_rate[$i],
																		 $invoice_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $invoice_entry_product_detail_product_color_id[$i],
																		 $invoice_entry_product_detail_entry_type[$i],
																		 $invoice_entry_product_detail_s_weight_met[$i],
																		 $invoice_entry_product_detail_mother_child_type[$i]);
																//echo $insert_invoice_entry_product_detail; exit;
				mysql_query($insert_invoice_entry_product_detail);
				$detail_id			= mysql_insert_id();
				}
				
				}
				
						if($invoice_entry_product_detail_entry_type[$i]=='3'){
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"invoice-direct";
								$godown_id										= 	"2"; //echo $length_feet;exit;
								$produt_id										=	$invoice_entry_product_detail_product_id[$i];
								$child_type										=	$invoice_entry_product_detail_mother_child_type[$i];
								$produt_qty										=	(-1*$invoice_entry_product_detail_qty[$i]);
							stockLedger($child_type,'out',$invoice_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $invoice_entry_branch_id,  $godown_id, $invoice_entry_date, $invoice_entry_no,$stock_ledger_entry_type,'1');
					}
					else{  //echo $invoice_entry_product_detail_s_weight_inches[$i];exit;
					$produt_id											=	$invoice_entry_product_detail_product_id[$i];
					$product_colour_id									=	$invoice_entry_product_detail_product_color_id[$i];
					$product_thick										=	$invoice_entry_product_detail_product_thick[$i];
					$width_inches										= 	$invoice_entry_product_detail_width_inches[$i];
					$width_mm											= 	$invoice_entry_product_detail_width_mm[$i];
					$ton_qty											= 	$invoice_entry_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$invoice_entry_product_detail_s_weight_mm[$i];
					$tot_length											= 	$invoice_entry_product_detail_tot_length[$i]; //echo $tot_length;exit;
					
					$child_type										    =	$invoice_entry_product_detail_mother_child_type[$i];
					$entry_type											= 	"invoice-direct";
					$length_feet										= 	$invoice_entry_product_detail_sl_feet[$i];
					$length_meter										= 	$invoice_entry_product_detail_sl_feet_met[$i];
					$godown_id										= 	"2";
					$produt_qty										=	(-1);
					//echo $ton_qty;
					/*reduceRawMaterial($child_type,$produt_id,$product_thick,$product_colour_id,$width_inches,$tot_length,$invoice_entry_no,$invoice_entry_date,$invoice_entry_id,$detail_id,$invoice_entry_branch_id,$entry_type,$invoice_entry_product_detail_entry_type[$i],$ton_qty,$kg_qty,$produt_qty,$invoice_entry_product_detail_sl_feet[$i]);*/

	stockLedger($child_type,'out',$invoice_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $invoice_entry_branch_id,  $godown_id, $invoice_entry_date, $invoice_entry_no,$entry_type,'2',$width_inches,$width_mm,$product_colour_id,$product_thick);
				}	
				}


				

		

		}
        
        $acc_dr_id= '';
		$setup_detail	= GetBranchAccSetup($invoice_entry_branch_id);
		
		if($invoice_entry_payment_mode==2){
		   
			$acc_col_dr_id	= $invoice_entry_acc_bank_id;
		}else{
		    
			$acc_col_dr_id	= $setup_detail['acS_sales_ac2'];
		}
		$acc_cr_id		= getMasterID($invoice_entry_customer_id, 'customer');
		$acc_dr_id		= $setup_detail['acS_sales'];
		$currency_amt	= getCurrencyAmt($acc_cr_id,$invoice_entry_date);
		$acc_amount	= $invoice_entry_net_amount/$currency_amt;
		//$acc_amount	= 0;
		 
		if($invoice_entry_net_amount>0){
		update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'direct_Invoice', $acc_dr_id, $acc_cr_id, 'D', $invoice_entry_net_amount, $invoice_entry_remark, $invoice_entry_branch_id, $acc_amount);	
		update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'direct_Invoice', $acc_cr_id, $acc_dr_id, 'C', $invoice_entry_net_amount, $invoice_entry_remark, $invoice_entry_branch_id, $acc_amount);	
		}
		
		if($invoice_entry_advance_amount>0){
			update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'advance_invoice', $acc_col_dr_id, $acc_cr_id, 'C', $invoice_entry_advance_amount, $invoice_entry_remark, $invoice_entry_branch_id, $acc_amount);	
			update_transaction($invoice_entry_id, $invoice_entry_no, $invoice_entry_date, 'advance_invoice', $acc_cr_id, $acc_col_dr_id, 'D', $invoice_entry_advance_amount, $invoice_entry_remark, $invoice_entry_branch_id, $acc_amount);			
		}
		
		pageRedirection("direct-invoice-entry/index.php?page=edit&id=$invoice_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['invoice_entry_product_detail_id'])) && (isset($_REQUEST['invoice_entry_uniq_id'])))

		{

			$invoice_entry_product_detail_id 		 = $_GET['invoice_entry_product_detail_id'];

			$invoice_entry_uniq_id = $_GET['invoice_entry_uniq_id'];
			
			$select ="SELECT * FROM invoice_entry WHERE invoice_entry_uniq_id='".$invoice_entry_uniq_id."'";
			$query=mysql_query($select);
			$result=mysql_fetch_array($query);
			$gross 				=$result['invoice_entry_gross_amount'];
			$transport_amount 	=$result['invoice_entry_transport_amount'];
			$tax_per			=$result['invoice_entry_tax_per'];
			$advance_amt		=$result['invoice_entry_advance_amount'];
			
			$selecte_detail="SELECT invoice_entry_product_detail_total FROM invoice_entry_product_details WHERE invoice_entry_product_detail_id='".$invoice_entry_product_detail_id."'";
			$query_detail=mysql_query($selecte_detail);
			$result_detail=mysql_fetch_array($query_detail);
			$product_detail_total		=$result_detail['invoice_entry_product_detail_total'];
			
			$tot_groos =$gross -$product_detail_total;
			
			$tax_amt=($tot_groos/$tax_per);
			
			$net_total=$tot_groos +$transport_amount-$advance_amt;
			
			 $Update="UPDATE invoice_entry SET invoice_entry_gross_amount ='".$tot_groos."',
												invoice_entry_transport_amount ='".$transport_amount."',
												invoice_entry_tax_amount	='".$tax_amt."',
												invoice_entry_net_amount  ='".$net_total."' 
												WHERE invoice_entry_uniq_id='".$invoice_entry_uniq_id."'";
			mysql_query($Update);									

			$product_detail_id 			= $_REQUEST['invoice_entry_product_detail_id'];
			$invoice_entry_uniq_id 		= $_REQUEST['invoice_entry_uniq_id'];
			$stock_ledger_entry_type	= "invoice-direct";
			$invoice_entry_id 			= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', $invoice_entry_uniq_id); 
			DeleteStockLedger($stock_ledger_entry_type,$invoice_entry_id,$invoice_entry_product_detail_id,"out");

			mysql_query("UPDATE invoice_entry_product_details SET invoice_entry_product_detail_deleted_status = 1 

						WHERE invoice_entry_product_detail_id = ".$invoice_entry_product_detail_id." ");

			header("Location:index.php?page=edit&id=$invoice_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){
	
		$checked      = $_POST['deleteCheck'];
		$count 		  = count($checked);
		for($i=0; $i < $count; $i++) 
		{ 
			$deleteCheck 					= $checked[$i]; 
			$invoice_entry_id 				= getId('invoice_entry', 'invoice_entry_id', 'invoice_entry_uniq_id', $deleteCheck); 
			$select_grn_ch_detal			= "SELECT
													*
												FROM
													invoice_entry_product_details
												WHERE
													invoice_entry_product_detail_deleted_status		= 0							AND
													invoice_entry_product_detail_invoice_entry_id	= '".$invoice_entry_id."'";
												//	echo $select_grn_ch_detal;exit;
			 $result_grn_ch_detal 			= mysql_query($select_grn_ch_detal);
			 $response =array();
			 $stock_ledger_entry_type		= "invoice-direct";
			 while($resultChData = mysql_fetch_array($result_grn_ch_detal)){
					$stock_ledger_entry_detail_id	= $resultChData['invoice_entry_product_detail_id'];
					DeleteStockLedger($stock_ledger_entry_type,$invoice_entry_id,$stock_ledger_entry_detail_id,'out');
			 }
			 
			 $ip												= getRealIpAddr();
			   $update="UPDATE acc_transaction SET acc_transaction_deleted_status=1,
															acc_transaction_deleted_by 			= '".$_SESSION[SESS.'_session_user_id']."',
															acc_transaction_deleted_on 			= UNIX_TIMESTAMP(NOW()),
															acc_transaction_deleted_ip			= '".$ip."'
															WHERE acc_transaction_voucher_id='".$invoice_entry_id."' AND acc_transaction_type				='advance_invoice'
			 ";
			mysql_query($update); 
			$update_dIN="UPDATE acc_transaction SET acc_transaction_deleted_status=1,
															acc_transaction_deleted_by 			= '".$_SESSION[SESS.'_session_user_id']."',
															acc_transaction_deleted_on 			= UNIX_TIMESTAMP(NOW()),
															acc_transaction_deleted_ip			= '".$ip."'
															WHERE acc_transaction_voucher_id='".$invoice_entry_id."' AND acc_transaction_type				='direct_Invoice'
			 ";
			mysql_query($update_dIN);
		}
	

	

		deleteUniqRecords('invoice_entry', 'invoice_entry_deleted_by', 'invoice_entry_deleted_on' , 'invoice_entry_deleted_ip','invoice_entry_deleted_status', 'invoice_entry_id', 'invoice_entry_uniq_id', '1');

		

		deleteMultiRecords('invoice_entry_product_details', 'invoice_entry_product_detail_deleted_by', 'invoice_entry_product_detail_deleted_on', 'invoice_entry_product_detail_deleted_ip', 'invoice_entry_product_detail_deleted_status', 'invoice_entry_product_detail_invoice_entry_id', 'invoice_entry','invoice_entry_id','invoice_entry_uniq_id', '1');  



		

		pageRedirection("direct-invoice-entry/index.php?msg=7");				

	}

?>