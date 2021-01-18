<?php
	function GetAutoNo($branch_id){
		$select_invoice_no = "SELECT MAX(credit_note_entry_no) AS maxval FROM credit_note_entry 
								  WHERE credit_note_entry_deleted_status =0
								  AND credit_note_entry_branch_id = '".$branch_id."'
								  AND credit_note_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND credit_note_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval = $record_invoice_no['maxval']; 

		if($maxval > 0) {

			$credit_note_entry_no = substr(('00000'.++$maxval),-5);

		} else {

			$credit_note_entry_no = substr(('00000'.++$maxval),-5);

		}
		return $credit_note_entry_no;
	}
	function insertQuotation(){
	
	$select_branch	= "SELECT branch_prefix FROM branches WHERE  branch_id = '".$_POST['credit_note_entry_branch_id']."' ";
		//echo $select_branch;exit;
		$result_branch = mysql_query($select_branch);
		$res = mysql_fetch_array($result_branch); 
	/*echo "<pre>";
	print_r($_POST);exit;*/
$credit_note_entry_no =$res['branch_prefix'].GetAutoNo($_POST['credit_note_entry_branch_id']); //echo $invoice_entry_no;exit;


		$credit_note_entry_branch_id                   		= trim($_POST['credit_note_entry_branch_id']);
		//$credit_note_entry_no                   				= trim($_POST['credit_note_entry_no']);
		$credit_note_entry_date                 				= NdateDatabaseFormat($_POST['credit_note_entry_date']);
		
		$credit_note_entry_customer_id          				= trim($_POST['credit_note_entry_customer_id']);
		
		$credit_note_entry_type     							= trim($_POST['credit_note_entry_type']);
		$credit_note_entry_invoice_entry_id     				= trim($_POST['credit_note_entry_invoice_entry_id']);
		$credit_note_entry_type_id								= trim($_POST['credit_note_entry_type_id']);
		$credit_note_entry_sw_type     							= trim($_POST['credit_note_entry_sw_type']);
		$credit_note_entry_godown_id							= trim($_POST['credit_note_entry_godown_id']);		
		
		
		//Product Detail	
		$credit_note_entry_product_detail_product_type      	= $_POST['credit_note_entry_product_detail_product_type'];
		$credit_note_entry_product_detail_product_id     		= $_POST['credit_note_entry_product_detail_product_id'];
		$credit_note_entry_product_detail_quotation_detail_id   = $_POST['credit_note_entry_product_detail_invoice_detail_id'];
		$credit_note_entry_product_detail_width_inches  		= isset($_POST['credit_note_entry_product_detail_width_inches'])?$_POST['credit_note_entry_product_detail_width_inches']:'';
		$credit_note_entry_product_detail_width_mm 		  		= isset($_POST['credit_note_entry_product_detail_width_mm'])?$_POST['credit_note_entry_product_detail_width_mm']:'';
		$credit_note_entry_product_detail_s_width_inches 		= isset($_POST['credit_note_entry_product_detail_s_width_inches'])?$_POST['credit_note_entry_product_detail_s_width_inches']:'';
		$credit_note_entry_product_detail_s_width_mm 			= isset($_POST['credit_note_entry_product_detail_s_width_mm'])?$_POST['credit_note_entry_product_detail_s_width_mm']:'';
		$credit_note_entry_product_detail_sl_feet 		  		= isset($_POST['credit_note_entry_product_detail_sl_feet'])?$_POST['credit_note_entry_product_detail_sl_feet']:'';
		$credit_note_entry_product_detail_sl_feet_in 			= isset($_POST['credit_note_entry_product_detail_sl_feet_in'])?$_POST['credit_note_entry_product_detail_sl_feet_in']:'';
		$credit_note_entry_product_detail_sl_feet_mm 			= isset($_POST['credit_note_entry_product_detail_sl_feet_mm'])?$_POST['credit_note_entry_product_detail_sl_feet_mm']:'';
		$credit_note_entry_product_detail_sl_feet_met 			= isset($_POST['credit_note_entry_product_detail_sl_feet_met'])?$_POST['credit_note_entry_product_detail_sl_feet_met']:'';
		$credit_note_entry_product_detail_s_weight_inches   	= isset($_POST['credit_note_entry_product_detail_s_weight_inches'])?$_POST['credit_note_entry_product_detail_s_weight_inches']:'';
		$credit_note_entry_product_detail_s_weight_mm   		= isset($_POST['credit_note_entry_product_detail_s_weight_mm'])?$_POST['credit_note_entry_product_detail_s_weight_mm']:'';
		$credit_note_entry_product_detail_qty 			 		= $_POST['credit_note_entry_product_detail_qty'];
		$credit_note_entry_product_detail_max_qty 			 	= $_POST['credit_note_entry_product_detail_max_qty'];
		$credit_note_entry_product_detail_tot_length 			= isset($_POST['credit_note_entry_product_detail_tot_length'])?$_POST['credit_note_entry_product_detail_tot_length']:'';
		$credit_note_entry_product_detail_inv_tot_length 		= isset($_POST['credit_note_entry_product_detail_inv_tot_length'])?$_POST['credit_note_entry_product_detail_inv_tot_length']:'';
		$credit_note_entry_product_detail_rate 			  		= $_POST['credit_note_entry_product_detail_rate'];
		$credit_note_entry_product_detail_total 				= $_POST['credit_note_entry_product_detail_total'];
		$credit_note_entry_product_detail_product_thick 		= isset($_POST['credit_note_entry_product_detail_product_thick'])?$_POST['credit_note_entry_product_detail_product_thick']:'';
		$credit_note_entry_product_detail_product_color_id 		= isset($_POST['credit_note_entry_product_detail_product_color_id'])?$_POST['credit_note_entry_product_detail_product_color_id']:'';
		$credit_note_entry_product_detail_entry_type 			= $_POST['credit_note_entry_product_detail_entry_type'];
		
		$credit_note_entry_product_is_opp					= isset($_POST['credit_note_entry_product_is_opp'])?$_POST['credit_note_entry_product_is_opp']:'0';
		$credit_note_entry_product_detail_sale_by			= isset($_POST['credit_note_entry_product_detail_sale_by'])?$_POST['credit_note_entry_product_detail_sale_by']:'';
		$credit_note_entry_product_opp_feet_per_qty		= isset($_POST['credit_note_entry_product_opp_feet_per_qty'])?$_POST['credit_note_entry_product_opp_feet_per_qty']:'0';
		
		

		$request_fields 									   = ((!empty($credit_note_entry_branch_id)) && (!empty($credit_note_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "credit-note-entry/index.php?page=add&msg=5");

		$credit_note_entry_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();

		 $insert_credit_note_entry 					= sprintf("INSERT INTO credit_note_entry  (credit_note_entry_uniq_id, credit_note_entry_date,

																					  		  credit_note_entry_customer_id,

																					   		  credit_note_entry_type,

																					   		  credit_note_entry_invoice_entry_id, credit_note_entry_no,

																					  		  credit_note_entry_branch_id,credit_note_entry_added_by,

																					   		  credit_note_entry_added_on,credit_note_entry_added_ip,

																			   		   		  credit_note_entry_company_id,credit_note_entry_financial_year,
																							  credit_note_entry_type_id,credit_note_entry_sw_type,
																							  credit_note_entry_godown_id) 

																			VALUES 	 		 ('%s', '%s', 

																							  '%d', '%d',

																							  '%d', '%s',

																							  '%d', '%d', 

																							   UNIX_TIMESTAMP(NOW()),

																							  '%s', '%d', '%d' , '%s', '%d' , '%d')", 

																		  	   		   		 $credit_note_entry_uniq_id, $credit_note_entry_date,

																					   		 $credit_note_entry_customer_id,

																					   		 $credit_note_entry_type,

																					   		 $credit_note_entry_invoice_entry_id,$credit_note_entry_no,

																					   		 $credit_note_entry_branch_id,$_SESSION[SESS.'_session_user_id'],

																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $credit_note_entry_type_id,$credit_note_entry_sw_type,$credit_note_entry_godown_id); 

		mysql_query($insert_credit_note_entry);

		//echo $insert_credit_note_entry; exit;

		$credit_note_entry_id 						= mysql_insert_id(); 

		// purchase order pproduct details
		$acc_amount = 0;
		$acc_amount_mmk = 0;
		for($i = 0; $i < count($credit_note_entry_product_detail_product_id); $i++) { 
		
			if($credit_note_entry_product_detail_sale_by[$i] == "QTY") {
				$credit_note_entry_product_detail_qty_val 	= $credit_note_entry_product_detail_qty[$i];
				$credit_note_entry_product_detail_sale_feet = $credit_note_entry_product_detail_qty[$i] * $credit_note_entry_product_opp_feet_per_qty[$i];
			}else if($credit_note_entry_product_detail_sale_by[$i] == "FEET"){
				$credit_note_entry_product_detail_qty_val = $credit_note_entry_product_detail_qty[$i]/$credit_note_entry_product_opp_feet_per_qty[$i];	
				$credit_note_entry_product_detail_sale_feet = $credit_note_entry_product_detail_qty[$i];
			}else{
				$credit_note_entry_product_detail_qty_val 	= $credit_note_entry_product_detail_qty[$i];
				$credit_note_entry_product_detail_sale_feet = '';
			}
				
				
			$acc_amount_mmk = $acc_amount_mmk + $credit_note_entry_product_detail_total[$i];
		// echo $credit_note_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($credit_note_entry_product_detail_product_id[$i])) );
			if($detail_request_fields) {
				$credit_note_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_credit_note_entry_product_detail 		= sprintf("INSERT INTO credit_note_entry_product_details 
																				(credit_note_entry_product_detail_uniq_id,
																				credit_note_entry_product_detail_credit_note_entry_id,
																				 credit_note_entry_product_detail_product_id,
																				 credit_note_entry_product_detail_product_type, 
																				 credit_note_entry_product_detail_product_thick,
																				 credit_note_entry_product_detail_width_inches,
																				 credit_note_entry_product_detail_width_mm,
																				 credit_note_entry_product_detail_s_width_inches,
																				 credit_note_entry_product_detail_s_width_mm,
																				 credit_note_entry_product_detail_sl_feet,
																				 credit_note_entry_product_detail_sl_feet_in,
																				 credit_note_entry_product_detail_sl_feet_mm,
																				 credit_note_entry_product_detail_sl_feet_met,
																				 credit_note_entry_product_detail_s_weight_inches,
																				 credit_note_entry_product_detail_s_weight_mm,
																				 credit_note_entry_product_detail_qty,
																				 credit_note_entry_product_detail_tot_length,
																				 credit_note_entry_product_detail_rate,credit_note_entry_product_detail_total,
																				 credit_note_entry_product_detail_added_by,
																				  credit_note_entry_product_detail_added_on,
																				 credit_note_entry_product_detail_added_ip,
																				 credit_note_entry_product_detail_invoice_detail_id,
																				 credit_note_entry_product_detail_invoice_entry_id,
																				 credit_note_entry_product_detail_color_id,
																				 credit_note_entry_product_detail_entry_type,
																				 credit_note_entry_product_detail_max_qty,
																				 credit_note_entry_product_detail_sale_by,
																				 credit_note_entry_product_detail_sale_feet) 
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
																				'%d','%d', '%d','%f','%s','%f')", 
																		 $credit_note_entry_product_detail_uniq_id,$credit_note_entry_id,
																		 $credit_note_entry_product_detail_product_id[$i],
																		 $credit_note_entry_product_detail_product_type[$i], 
																		 $credit_note_entry_product_detail_product_thick[$i],
																		 $credit_note_entry_product_detail_width_inches[$i],
																		 $credit_note_entry_product_detail_width_mm[$i],
																		 $credit_note_entry_product_detail_s_width_inches[$i],
																		 $credit_note_entry_product_detail_s_width_mm[$i],
																		 $credit_note_entry_product_detail_sl_feet[$i],
																		 $credit_note_entry_product_detail_sl_feet_in[$i],
																		 $credit_note_entry_product_detail_sl_feet_mm[$i],
																		 $credit_note_entry_product_detail_sl_feet_met[$i],
																		 $credit_note_entry_product_detail_s_weight_inches[$i],
																		 $credit_note_entry_product_detail_s_weight_mm[$i],
																		 $credit_note_entry_product_detail_qty_val,
																		 $credit_note_entry_product_detail_tot_length[$i],
																		 $credit_note_entry_product_detail_rate[$i],
																		 $credit_note_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $credit_note_entry_product_detail_invoice_detail_id[$i],
																		 $credit_note_entry_invoice_entry_id,
																		 $credit_note_entry_product_detail_product_color_id[$i],
																		 $credit_note_entry_product_detail_entry_type[$i],
																		 $credit_note_entry_product_detail_max_qty[$i],
																		 $credit_note_entry_product_detail_sale_by[$i],
																		 $credit_note_entry_product_detail_sale_feet);
																		// echo $insert_credit_note_entry_product_detail; exit;
				mysql_query($insert_credit_note_entry_product_detail);
				
				$detail_id			= mysql_insert_id();
				if($credit_note_entry_type	=="1"){
					if($credit_note_entry_product_detail_entry_type[$i]=='4'){
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"credit-note";
								$godown_id										= 	"2";
								$produt_id										=	$credit_note_entry_product_detail_product_id[$i];
								$produt_qty										=	$credit_note_entry_product_detail_qty_val;
								
								$sale_feet 										=   $credit_note_entry_product_detail_sale_feet;
								
								$product_mother_child_type = $credit_note_entry_product_detail_mother_child_type[$i];
								
								if($credit_note_entry_product_is_opp[$i] == 1) {
									if(isset($_POST['credit_note_entry_sw_type']) && $_POST['credit_note_entry_sw_type']) {
										stockLedger_opp($credit_note_entry_product_opp_feet_per_qty[$i],$product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1','','','','',$sale_feet);
									}
									
									$godown_id											= 	$credit_note_entry_godown_id;
									stockLedger_opp($credit_note_entry_product_opp_feet_per_qty[$i],$product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1','','','','',$sale_feet);
									
								} else {
									if(isset($_POST['credit_note_entry_sw_type']) && $_POST['credit_note_entry_sw_type']) {
										stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1');
									}
									
									$godown_id											= 	$credit_note_entry_godown_id;
									stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1');
								}
							/* stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1');
								$godown_id											= 	"1";
							stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1'); */
							
							
							//added in account transaction
							/* $entry_no 		= $credit_note_entry_no;
							$entry_date		= $credit_note_entry_date;
							$acc_amount		= $credit_note_entry_detail_amount[$po_index];
							$entry_remark	= $credit_note_entry_detail_remarks[$po_index];
							$branch_id		= $credit_note_entry_branch_id;
							$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
							//$bank_id		= getMasterID($collection_entry_detail_bank_id[$po_index], 'bank');
							$bank_id		= $credit_note_entry_detail_bank_id[$po_index];
							$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
							$cash_id		= $setup_detail['acS_sales_ac2'];
							$acc_cr_id		= ($pay_mode==1)?$cash_id:$bank_id;
							$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
							$acc_amount_mmk	= $acc_amount/$currency_amt;
							//update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);	
							//update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);	
							$acc_amount_mmk	= $acc_amount/$currency_amt;
							$acc_amount_mmk	= ($acc_amount_mmk==$acc_amount)?0:$acc_amount_mmk;
							update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount, $entry_remark, $branch_id,$acc_amount_mmk);	
							$dr_currency_amt	= getCurrencyAmt($acc_dr_id,$collection_entry_date);
							$acc_amount_mmk	= $acc_amount/$dr_currency_amt;
							$acc_amount_mmk	= ($acc_amount_mmk==$acc_amount)?0:$acc_amount_mmk;
							update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount , $entry_remark, $branch_id,$acc_amount_mmk); */
							
							/* $entry_no 		= $credit_note_entry_no;
							$entry_date		= $credit_note_entry_date;
							$acc_amount = 0;
							$entry_remark = '';
							$branch_id		= $credit_note_entry_branch_id;
							$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
							$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
							$cash_id		= $setup_detail['acS_sales_ac2'];
							$acc_cr_id = $cash_id;
							$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
							$acc_amount_mmk = $credit_note_entry_product_detail_total[$i];
							update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);
							update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount_mmk , $entry_remark, $branch_id,$acc_amount); */
							
					}
					else{
					$produt_id											=	$credit_note_entry_product_detail_product_id[$i];
					$product_colour_id									=	$credit_note_entry_product_detail_product_color_id[$i];
					$product_thick										=	$credit_note_entry_product_detail_product_thick[$i];
					$width_inches										= 	$credit_note_entry_product_detail_width_inches[$i];
					$width_mm											= 	$credit_note_entry_product_detail_width_mm[$i];
					$ton_qty											= 	$credit_note_entry_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$credit_note_entry_product_detail_s_weight_mm[$i];
					$tot_length											= 	$credit_note_entry_product_detail_tot_length[$i];
					$product_detail_qty									= 	$credit_note_entry_product_detail_qty_val;
					$entry_type											= 	"credit-note";
					reduceRawMaterialIn($produt_id,$product_thick,$product_colour_id,$width_inches,$tot_length,$credit_note_entry_no,$credit_note_entry_date,$credit_note_entry_id,$detail_id,$credit_note_entry_branch_id,$entry_type,$credit_note_entry_type_id,$ton_qty,$kg_qty,$product_detail_qty);
					
					$produt_id											=	$credit_note_entry_product_detail_product_id[$i];
					$product_colour_id									=	$credit_note_entry_product_detail_product_color_id[$i];
					$product_thick										=	$credit_note_entry_product_detail_product_thick[$i];
					$width_inches										= 	$credit_note_entry_product_detail_width_inches[$i];
					$width_mm											= 	$credit_note_entry_product_detail_width_mm[$i];
					$length_feet										= 	$credit_note_entry_product_detail_sl_feet[$i];
					$length_meter										= 	$credit_note_entry_product_detail_sl_feet_met[$i];
					$rec_product										= 	getProductGetail($produt_id);
					if($credit_note_entry_product_detail_entry_type[$i]==1){
						$brand_id										= 	$rec_product['product_brand_id'];
						$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
						$ton_qty										= 	$total_ton*$length_feet;
						$kg_qty											= 	$ton_qty*1000;
						$product_detail_qty								= 	$credit_note_entry_product_detail_qty_val;
					}
					/*else{
						$ton_qty											= 	$credit_note_entry_product_detail_s_weight_inches[$i];
						$kg_qty												= 	$credit_note_entry_product_detail_s_weight_mm[$i];
						$rec_product									= 	getProductGetail($produt_id);
						$brand_id										= 	$rec_product['product_brand_id'];
						$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
						$length_feet									= 	($prn_entry_product_detail_sl_feet[$i]/$total_ton);
						
						$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
						$length_meter									= 	$product_cal['3'];
						$product_detail_qty								= 1;
					}*/
					$stock_ledger_entry_type							= 	"credit-note-fin";
					
					$product_con_entry_godown_id						= 	$credit_note_entry_godown_id;
					$product_mother_child_type = $credit_note_entry_product_detail_mother_child_type[$i];
					
					if(isset($_POST['credit_note_entry_sw_type']) && $_POST['credit_note_entry_sw_type']) {
						stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $credit_note_entry_branch_id, '2', $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
						
						stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $credit_note_entry_branch_id, $product_con_entry_godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
					} else {
						stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $credit_note_entry_branch_id, $product_con_entry_godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);
					}
							
							
							
				/* $entry_no 		= $credit_note_entry_no;
				$entry_date		= $credit_note_entry_date;
				$acc_amount		= $credit_note_entry_detail_amount[$po_index];
				$entry_remark	= $credit_note_entry_detail_remarks[$po_index];
				$branch_id		= $credit_note_entry_branch_id;
				$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
				//$bank_id		= getMasterID($collection_entry_detail_bank_id[$po_index], 'bank');
				$bank_id		= $credit_note_entry_detail_bank_id[$po_index];
				$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
				$cash_id		= $setup_detail['acS_sales_ac2'];
				$acc_cr_id		= ($pay_mode==1)?$cash_id:$bank_id;
				$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
				$acc_amount_mmk	= $acc_amount/$currency_amt;
				//update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);	
				//update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);	
				$acc_amount_mmk	= $acc_amount/$currency_amt;
				$acc_amount_mmk	= ($acc_amount_mmk==$acc_amount)?0:$acc_amount_mmk;
				update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount, $entry_remark, $branch_id,$acc_amount_mmk);	
				$dr_currency_amt	= getCurrencyAmt($acc_dr_id,$collection_entry_date);
				$acc_amount_mmk	= $acc_amount/$dr_currency_amt;
				$acc_amount_mmk	= ($acc_amount_mmk==$acc_amount)?0:$acc_amount_mmk;
				update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount , $entry_remark, $branch_id,$acc_amount_mmk); */
				
				/* $entry_no 		= $credit_note_entry_no;
				$entry_date		= $credit_note_entry_date;
				$acc_amount = 0;
				$entry_remark = '';
				$branch_id		= $credit_note_entry_branch_id;
				$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
				$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
				$cash_id		= $setup_detail['acS_sales_ac2'];
				$acc_cr_id = $cash_id;
				$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
				$acc_amount_mmk = $credit_note_entry_product_detail_total[$i];
				update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);
				update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount_mmk , $entry_remark, $branch_id,$acc_amount); */
							
				}
				} else if($credit_note_entry_type == "2") {
						/* $entry_no 		= $credit_note_entry_no;
						$entry_date		= $credit_note_entry_date;
						$acc_amount = 0;
						$entry_remark = '';
						$branch_id		= $credit_note_entry_branch_id;
						$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
						$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
						$cash_id		= $setup_detail['acS_sales_ac2'];
						$acc_cr_id = $cash_id;
						$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
						$acc_amount_mmk = $credit_note_entry_product_detail_total[$i];
						update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);
						update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount_mmk , $entry_remark, $branch_id,$acc_amount); */
				}
				else {}
			}
		}
		
		//Insert into Account Transaction
		$entry_no 		= $credit_note_entry_no;
		$entry_date		= $credit_note_entry_date;
		$acc_amount = 0;
		$entry_remark = '';
		$branch_id		= $credit_note_entry_branch_id;
		$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
		$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
		$cash_id		= $setup_detail['acS_sales_ac2'];
		$acc_cr_id = $cash_id;
		$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
		update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);
		update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount_mmk , $entry_remark, $branch_id,$acc_amount);
							
		pageRedirection("credit-note-entry/index.php?page=add&msg=1");

	}

	function listQuotation(){
        
        $where = '';
        
        if(isset($_REQUEST['search_branch_id']) && !empty($_REQUEST['search_branch_id'])){
                 $where .= " AND credit_note_entry_branch_id = '".$_REQUEST['search_branch_id']."' ";
        }
        if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND credit_note_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['customerid']))&& !empty($_REQUEST['customerid']))
		{
		$where.="AND credit_note_entry_customer_id ='".$_REQUEST['customerid']."'";
		}
        
        
		$select_credit_note_entry		=	"SELECT 

												credit_note_entry_id,

												credit_note_entry_uniq_id,

												credit_note_entry_no,

												credit_note_entry_date,

												credit_note_entry_customer_id,

												production_section_name,

												credit_note_entry_type

											 FROM 

												credit_note_entry

											 LEFT JOIN

												production_sections

											 ON

												production_section_id		=  credit_note_entry_production_section_id

											 WHERE 

												credit_note_entry_deleted_status 	= 	0									AND

												credit_note_entry_status				= '1' 
												
												$where

											 ORDER BY 

												credit_note_entry_no ASC";

		$result_credit_note_entry		= mysql_query($select_credit_note_entry);

		// Filling up the array

		$credit_note_entry_data 		= array();

		while ($record_credit_note_entry = mysql_fetch_array($result_credit_note_entry))

		{

		 $credit_note_entry_data[] 	= $record_credit_note_entry;

		}

		return $credit_note_entry_data;

	}

	function editQuotation(){

		$credit_note_entry_id 			= getId('credit_note_entry', 'credit_note_entry_id', 'credit_note_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_credit_note_entry		=	"SELECT 

												credit_note_entry_uniq_id,  credit_note_entry_date,

												credit_note_entry_production_section_id,credit_note_entry_customer_id,

												credit_note_entry_department_id,credit_note_entry_type,

												credit_note_entry_invoice_entry_id, credit_note_entry_no,

												credit_note_entry_branch_id,credit_note_entry_id,

												customer_billing_address,

												customer_contact_no,
												credit_note_entry_type_id 	

											 FROM 

												credit_note_entry 

											LEFT JOIN

												customers

											ON

												customer_id							= 	credit_note_entry_customer_id

											 WHERE 

												credit_note_entry_deleted_status 	=  0 			AND 

												credit_note_entry_id				= '".$credit_note_entry_id."'

											 ORDER BY 

												credit_note_entry_no ASC";

		$result_credit_note_entry 		= mysql_query($select_credit_note_entry);

		$record_credit_note_entry 		= mysql_fetch_array($result_credit_note_entry);

		return $record_credit_note_entry;

	}

	function editSalesdetail(){

		$credit_note_entry_id 			= getId('credit_note_entry', 'credit_note_entry_id', 'credit_note_entry_uniq_id', dataValidation($_GET['id'])); 

		$invoice_entry_id 					= getId('credit_note_entry', 'credit_note_entry_invoice_entry_id', 'credit_note_entry_uniq_id', dataValidation($_GET['id'])); 

			$select_credit_note_entry		=	"SELECT 

													invoice_entry_no,

													invoice_entry_date

												 FROM 

													invoice_entry 

												 WHERE 

													invoice_entry_deleted_status 	=  0 						AND 

													invoice_entry_id					= '".$invoice_entry_id."'

												 ORDER BY 

													invoice_entry_no ASC";

		

		$result_credit_note_entry 		= mysql_query($select_credit_note_entry);

		$record_credit_note_entry 		= mysql_fetch_array($result_credit_note_entry);

		return $record_credit_note_entry;

	}

	function editQuotationProductDetail()

	{

		$credit_note_entry_id 	= getId('credit_note_entry', 'credit_note_entry_id', 'credit_note_entry_uniq_id', dataValidation($_GET['id'])); 

		  $select_credit_note_entry_product_detail 	= "	SELECT 
															credit_note_entry_product_detail_id,
															credit_note_entry_product_detail_product_id,
															credit_note_entry_product_detail_width_inches,credit_note_entry_product_detail_width_mm,
															credit_note_entry_product_detail_s_width_inches,credit_note_entry_product_detail_s_width_mm,
															credit_note_entry_product_detail_sl_feet,credit_note_entry_product_detail_sl_feet_in,
															credit_note_entry_product_detail_sl_feet_mm,credit_note_entry_product_detail_s_weight_inches,
															credit_note_entry_product_detail_s_weight_mm,credit_note_entry_product_detail_tot_length,
															credit_note_entry_product_detail_qty,
															product_name,credit_note_entry_product_detail_max_qty,
															product_code, product_is_opp,
															credit_note_entry_product_detail_product_thick ,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															p_uom.product_uom_name as p_uom_name,
															child_uom.product_uom_name as c_uom_name,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name,
															credit_note_entry_product_detail_product_type,
															credit_note_entry_product_detail_rate,
															credit_note_entry_product_detail_total,
															credit_note_entry_product_detail_entry_type,
															credit_note_entry_product_detail_sl_feet_met,
															credit_note_entry_product_detail_sale_by,
															credit_note_entry_product_detail_sale_feet
															
														FROM 
															credit_note_entry_product_details 
														LEFT JOIN 
															invoice_entry_product_details 
														ON 
															invoice_entry_product_detail_id  		    = credit_note_entry_product_detail_invoice_detail_id
														LEFT JOIN 
															quotation_entry_product_details 
														ON 
															quotation_entry_product_detail_id 			= invoice_entry_product_detail_quotation_detail_id
														
														LEFT JOIN 
															products 
														ON 
															product_id 									= credit_note_entry_product_detail_product_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 									= product_brand_id	
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id	= credit_note_entry_product_detail_product_id	
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
															p_clr.product_colour_id 					= credit_note_entry_product_detail_color_id	
															
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 					= credit_note_entry_product_detail_color_id	
														WHERE 
															credit_note_entry_product_detail_deleted_status		 	= 0 							AND 
															credit_note_entry_product_detail_credit_note_entry_id 		= '".$credit_note_entry_id."'";
		$result_credit_note_entry_product_detail 	= mysql_query($select_credit_note_entry_product_detail);

		$arr_credit_note_entry_product_detail 		= array();
		while($record_credit_note_entry_product_detail = mysql_fetch_array($result_credit_note_entry_product_detail)) {
			$arr_credit_note_entry_product_detail[] = $record_credit_note_entry_product_detail;
		}
		return $arr_credit_note_entry_product_detail;

	}

	function updateQuotation(){

		$credit_note_entry_id                   				= trim($_POST['credit_note_entry_id']);
		$credit_note_entry_no                   				= trim($_POST['credit_note_entry_no']);
		$credit_note_entry_uniq_id                			= trim($_POST['credit_note_entry_uniq_id']);

		$credit_note_entry_branch_id                   		= trim($_POST['credit_note_entry_branch_id']);

		$credit_note_entry_date                 				= NdateDatabaseFormat($_POST['credit_note_entry_date']);
	
		$credit_note_entry_customer_id          				= trim($_POST['credit_note_entry_customer_id']);

		$credit_note_entry_type     							= trim($_POST['credit_note_entry_type']);

		$credit_note_entry_invoice_entry_id     					= trim($_POST['credit_note_entry_invoice_entry_id']);

		//Multi Contact

		$credit_note_entry_product_detail_id      			= $_POST['credit_note_entry_product_detail_id'];

		$credit_note_entry_product_detail_product_type      	= $_POST['credit_note_entry_product_detail_product_type'];
		$credit_note_entry_product_detail_product_id     		= $_POST['credit_note_entry_product_detail_product_id'];
		$credit_note_entry_product_detail_quotation_detail_id   = $_POST['credit_note_entry_product_detail_invoice_detail_id'];
		$credit_note_entry_product_detail_width_inches  		= isset($_POST['credit_note_entry_product_detail_width_inches'])?$_POST['credit_note_entry_product_detail_width_inches']:'';
		$credit_note_entry_product_detail_width_mm 		  		= isset($_POST['credit_note_entry_product_detail_width_mm'])?$_POST['credit_note_entry_product_detail_width_mm']:'';
		$credit_note_entry_product_detail_s_width_inches 		= isset($_POST['credit_note_entry_product_detail_s_width_inches'])?$_POST['credit_note_entry_product_detail_s_width_inches']:'';
		$credit_note_entry_product_detail_s_width_mm 			= isset($_POST['credit_note_entry_product_detail_s_width_mm'])?$_POST['credit_note_entry_product_detail_s_width_mm']:'';
		$credit_note_entry_product_detail_sl_feet 		  		= isset($_POST['credit_note_entry_product_detail_sl_feet'])?$_POST['credit_note_entry_product_detail_sl_feet']:'';
		$credit_note_entry_product_detail_sl_feet_in 			= isset($_POST['credit_note_entry_product_detail_sl_feet_in'])?$_POST['credit_note_entry_product_detail_sl_feet_in']:'';
		$credit_note_entry_product_detail_sl_feet_mm 			= isset($_POST['credit_note_entry_product_detail_sl_feet_mm'])?$_POST['credit_note_entry_product_detail_sl_feet_mm']:'';
		$credit_note_entry_product_detail_sl_feet_met 			= isset($_POST['credit_note_entry_product_detail_sl_feet_met'])?$_POST['credit_note_entry_product_detail_sl_feet_met']:'';
		$credit_note_entry_product_detail_s_weight_inches   	= isset($_POST['credit_note_entry_product_detail_s_weight_inches'])?$_POST['credit_note_entry_product_detail_s_weight_inches']:'';
		$credit_note_entry_product_detail_s_weight_mm   		= isset($_POST['credit_note_entry_product_detail_s_weight_mm'])?$_POST['credit_note_entry_product_detail_s_weight_mm']:'';
		$credit_note_entry_product_detail_qty 			 		= $_POST['credit_note_entry_product_detail_qty'];
		$credit_note_entry_product_detail_max_qty 			 		= $_POST['credit_note_entry_product_detail_max_qty'];
		$credit_note_entry_product_detail_tot_length 			= isset($_POST['credit_note_entry_product_detail_tot_length'])?$_POST['credit_note_entry_product_detail_tot_length']:'';
		$credit_note_entry_product_detail_rate 			  		= $_POST['credit_note_entry_product_detail_rate'];
		$credit_note_entry_product_detail_total 				= $_POST['credit_note_entry_product_detail_total'];
		$credit_note_entry_product_detail_product_thick 		= isset($_POST['credit_note_entry_product_detail_product_thick'])?$_POST['credit_note_entry_product_detail_product_thick']:'';
		$credit_note_entry_product_detail_color_id 				= isset($_POST['credit_note_entry_product_detail_color_id'])?$_POST['credit_note_entry_product_detail_color_id']:'';
		$credit_note_entry_product_detail_entry_type 			= isset($_POST['credit_note_entry_product_detail_entry_type'])?$_POST['credit_note_entry_product_detail_entry_type']:'';
		
		$credit_note_entry_product_is_opp						= isset($_POST['credit_note_entry_product_is_opp'])?$_POST['credit_note_entry_product_is_opp']:'0';
		$credit_note_entry_product_detail_sale_by				= isset($_POST['credit_note_entry_product_detail_sale_by'])?$_POST['credit_note_entry_product_detail_sale_by']:'';
		$credit_note_entry_product_opp_feet_per_qty				= isset($_POST['credit_note_entry_product_opp_feet_per_qty'])?$_POST['credit_note_entry_product_opp_feet_per_qty']:'0';
		
		$request_fields 						= ((!empty($credit_note_entry_branch_id)) && (!empty($credit_note_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "credit-note-entry/index.php?page=edit&id=$credit_note_entry_uniq_id");
		$ip												= getRealIpAddr();
		 $update_customer 					= sprintf("	UPDATE 
															credit_note_entry 
														SET 
															credit_note_entry_branch_id 				= '%d',
															credit_note_entry_date 						= '%s',
															
															credit_note_entry_customer_id 				= '%d',
															
															credit_note_entry_type 						= '%d',
															credit_note_entry_modified_by 				= '%d',
															credit_note_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),
															credit_note_entry_modified_ip				= '%s'
														WHERE               
															credit_note_entry_id         				= '%d'", 
															$credit_note_entry_branch_id,
															$credit_note_entry_date,
															
															$credit_note_entry_customer_id,
															
															$credit_note_entry_type,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$credit_note_entry_id);

		//echo $update_customer; exit;

		mysql_query($update_customer);
		$acc_amount = 0;
		$acc_amount_mmk = 0;
		for($i = 0; $i < count($credit_note_entry_product_detail_product_id); $i++) {
			
			if($credit_note_entry_product_detail_sale_by[$i] == "QTY") {
				$credit_note_entry_product_detail_qty_val 	= $credit_note_entry_product_detail_qty[$i];
				$credit_note_entry_product_detail_sale_feet = $credit_note_entry_product_detail_qty[$i] * $credit_note_entry_product_opp_feet_per_qty[$i];
			}else if($credit_note_entry_product_detail_sale_by[$i] == "FEET"){
				$credit_note_entry_product_detail_qty_val = $credit_note_entry_product_detail_qty[$i]/$credit_note_entry_product_opp_feet_per_qty[$i];	
				$credit_note_entry_product_detail_sale_feet = $credit_note_entry_product_detail_qty[$i];
			}else{
				$credit_note_entry_product_detail_qty_val 	= $credit_note_entry_product_detail_qty[$i];
				$credit_note_entry_product_detail_sale_feet = '';
			}
			
			$acc_amount_mmk = $acc_amount_mmk + $credit_note_entry_product_detail_total[$i];
			$detail_request_fields = ((!empty($credit_note_entry_product_detail_product_id[$i])) );

			if($detail_request_fields) {

				if(!empty($credit_note_entry_product_detail_id[$i])) {

				 	   $update_credit_note_entry_product_detail = sprintf("UPDATE 
																			credit_note_entry_product_details 
																		SET  
																			credit_note_entry_product_detail_width_inches  			= '%f',
																			credit_note_entry_product_detail_width_mm  				= '%f',
																			credit_note_entry_product_detail_s_width_inches  			= '%f',
																			credit_note_entry_product_detail_s_width_mm  				= '%f',
																			credit_note_entry_product_detail_sl_feet  					= '%f',
																			credit_note_entry_product_detail_sl_feet_in  				= '%f',
																			credit_note_entry_product_detail_sl_feet_mm  				= '%f',
																			credit_note_entry_product_detail_s_weight_inches  			= '%f',
																			credit_note_entry_product_detail_s_weight_mm  				= '%f',
																			credit_note_entry_product_detail_tot_length  				= '%f',
																			credit_note_entry_product_detail_qty  						= '%f',
																			credit_note_entry_product_detail_max_qty 					= '%f',
																			credit_note_entry_product_detail_total 						= '%f',
																			credit_note_entry_product_detail_modified_by 				= '%d',
																			credit_note_entry_product_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																			credit_note_entry_product_detail_modified_ip 				= '%s',
																			credit_note_entry_product_detail_sale_by	 				= '%s',
																			credit_note_entry_product_detail_sale_feet	 				= '%f'
																		WHERE 
																			credit_note_entry_product_detail_credit_note_entry_id 	= '%d' AND 
																			credit_note_entry_product_detail_id 					= '%d'",
																			$credit_note_entry_product_detail_width_inches[$i],
																			$credit_note_entry_product_detail_width_mm[$i],
																			$credit_note_entry_product_detail_s_width_inches[$i],
																			$credit_note_entry_product_detail_s_width_mm[$i],
																			$credit_note_entry_product_detail_sl_feet[$i],
																			$credit_note_entry_product_detail_sl_feet_in[$i],
																			$credit_note_entry_product_detail_sl_feet_mm[$i],
																			$credit_note_entry_product_detail_s_weight_inches[$i],
																			$credit_note_entry_product_detail_s_weight_mm[$i],
																			$credit_note_entry_product_detail_tot_length[$i],
																			$credit_note_entry_product_detail_qty_val,
																			$credit_note_entry_product_detail_max_qty[$i],
																			$credit_note_entry_product_detail_total[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$credit_note_entry_product_detail_sale_by[$i],
																			$credit_note_entry_product_detail_sale_feet,
																			$credit_note_entry_id, 
																			$credit_note_entry_product_detail_id[$i]);
			//	echo $update_credit_note_entry_product_detail; exit;
					mysql_query($update_credit_note_entry_product_detail); 

					$detail_id			= 	$credit_note_entry_product_detail_id[$i];

				} else {

					$credit_note_entry_product_detail_uniq_id 	= generateUniqId();

					 $insert_credit_note_entry_product_detail 		= sprintf("INSERT INTO credit_note_entry_product_details 
																				(credit_note_entry_product_detail_uniq_id,credit_note_entry_product_detail_credit_note_entry_id,
																				 credit_note_entry_product_detail_product_id,
																				 credit_note_entry_product_detail_product_type, credit_note_entry_product_detail_product_thick,
																				 credit_note_entry_product_detail_width_inches,credit_note_entry_product_detail_width_mm,
																				 credit_note_entry_product_detail_s_width_inches,credit_note_entry_product_detail_s_width_mm,
																				 credit_note_entry_product_detail_sl_feet,credit_note_entry_product_detail_sl_feet_in,
																				 credit_note_entry_product_detail_sl_feet_mm,credit_note_entry_product_detail_sl_feet_met,
																				 credit_note_entry_product_detail_s_weight_inches,credit_note_entry_product_detail_s_weight_mm,
																				 credit_note_entry_product_detail_qty,credit_note_entry_product_detail_tot_length,
																				 credit_note_entry_product_detail_rate,credit_note_entry_product_detail_total,
																				 credit_note_entry_product_detail_added_by, credit_note_entry_product_detail_added_on,
																				 credit_note_entry_product_detail_added_ip,credit_note_entry_product_detail_invoice_detail_id,
																				 credit_note_entry_product_detail_invoice_entry_id,credit_note_entry_product_detail_color_id,credit_note_entry_product_detail_sale_by,credit_note_entry_product_detail_sale_feet) 
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
																				'%d','%d','%s','%f')", 
																		 $credit_note_entry_product_detail_uniq_id,$credit_note_entry_id,
																		 $credit_note_entry_product_detail_product_id[$i],
																		 $credit_note_entry_product_detail_product_type[$i], $credit_note_entry_product_detail_product_thick[$i],
																		 $credit_note_entry_product_detail_width_inches[$i],$credit_note_entry_product_detail_width_mm[$i],
																		 $credit_note_entry_product_detail_s_width_inches[$i],$credit_note_entry_product_detail_s_width_mm[$i],
																		 $credit_note_entry_product_detail_sl_feet[$i],$credit_note_entry_product_detail_sl_feet_in[$i],
																		 $credit_note_entry_product_detail_sl_feet_mm[$i],$credit_note_entry_product_detail_sl_feet_met[$i],
																		 $credit_note_entry_product_detail_s_weight_inches[$i],$credit_note_entry_product_detail_s_weight_mm[$i],
																		 $credit_note_entry_product_detail_qty_val,$credit_note_entry_product_detail_tot_length[$i],
																		 $credit_note_entry_product_detail_rate[$i],$credit_note_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$credit_note_entry_product_detail_invoice_detail_id[$i],
																		 $credit_note_entry_invoice_entry_id,$credit_note_entry_product_detail_color_id[$i],
																		 $credit_note_entry_product_detail_sale_by[$i],
																		 $credit_note_entry_product_detail_sale_feet);
																		// echo $insert_credit_note_entry_product_detail; exit;
				mysql_query($insert_credit_note_entry_product_detail);
				$detail_id			= mysql_insert_id();
				}
				
				
				
				if($credit_note_entry_type	=="1"){
					if($credit_note_entry_product_detail_entry_type[$i]=='4'){
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"credit-note";
								$godown_id										= 	"2";
								$produt_id										=	$credit_note_entry_product_detail_product_id[$i];
								$produt_qty										=	$credit_note_entry_product_detail_qty_val;
								$product_mother_child_type = $credit_note_entry_product_detail_mother_child_type[$i];
								
								$sale_feet 										= $credit_note_entry_product_detail_sale_feet;
								
								if($credit_note_entry_product_is_opp[$i] == 1) {
									stockLedger_opp($credit_note_entry_product_opp_feet_per_qty[$i],$credit_note_entry_product_detail_entry_type[$i],'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1','','','','',$sale_feet);
									
									$godown_id											= 	"1";
									stockLedger_opp($credit_note_entry_product_opp_feet_per_qty[$i],$product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1','','','','',$sale_feet);
									
								} else {
									stockLedger($credit_note_entry_product_detail_entry_type[$i],'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1');
							
									$godown_id											= 	"1";
									stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1');
								}
								
							/* stockLedger($credit_note_entry_product_detail_entry_type[$i],'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1');
							
							$godown_id											= 	"1";
							stockLedger($product_mother_child_type,'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $credit_note_entry_branch_id,  $godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type,'1'); */
							
							
							/* $entry_no 		= $credit_note_entry_no;
							$entry_date		= $credit_note_entry_date;
							$acc_amount = 0;
							$entry_remark = '';
							$branch_id		= $credit_note_entry_branch_id;
							$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
							$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
							$cash_id		= $setup_detail['acS_sales_ac2'];
							$acc_cr_id = $cash_id;
							$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
							$acc_amount_mmk = $credit_note_entry_product_detail_total[$i];
							update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);
							update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount_mmk , $entry_remark, $branch_id,$acc_amount); */
					}
					else{
					$produt_id											=	$credit_note_entry_product_detail_product_id[$i];
					$product_colour_id									=	$credit_note_entry_product_detail_product_color_id[$i];
					$product_thick										=	$credit_note_entry_product_detail_product_thick[$i];
					$width_inches										= 	$credit_note_entry_product_detail_width_inches[$i];
					$width_mm											= 	$credit_note_entry_product_detail_width_mm[$i];
					$ton_qty											= 	$credit_note_entry_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$credit_note_entry_product_detail_s_weight_mm[$i];
					$tot_length											= 	$credit_note_entry_product_detail_tot_length[$i];
					$product_detail_qty									= 	$credit_note_entry_product_detail_qty_val;
					$entry_type											= 	"credit-note";
					reduceRawMaterialIn($produt_id,$product_thick,$product_colour_id,$width_inches,$tot_length,$credit_note_entry_no,$credit_note_entry_date,$credit_note_entry_id,$detail_id,$credit_note_entry_branch_id,$entry_type,$credit_note_entry_type_id,$ton_qty,$kg_qty,$product_detail_qty);
					
					$produt_id											=	$credit_note_entry_product_detail_product_id[$i];
					$product_colour_id									=	$credit_note_entry_product_detail_product_color_id[$i];
					$product_thick										=	$credit_note_entry_product_detail_product_thick[$i];
					$width_inches										= 	$credit_note_entry_product_detail_width_inches[$i];
					$width_mm											= 	$credit_note_entry_product_detail_width_mm[$i];
					$length_feet										= 	$credit_note_entry_product_detail_sl_feet[$i];
					$length_meter										= 	$credit_note_entry_product_detail_sl_feet_met[$i];
					$rec_product										= 	getProductGetail($produt_id);
					if($credit_note_entry_product_detail_entry_type[$i]==1){
						$brand_id										= 	$rec_product['product_brand_id'];
						$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
						$ton_qty										= 	$total_ton*$length_feet;
						$kg_qty											= 	$ton_qty*1000;
						$product_detail_qty								= 	$credit_note_entry_product_detail_qty_val;
					}
					else{
						$ton_qty										= 	$credit_note_entry_product_detail_s_weight_inches[$i];
						$kg_qty											= 	$credit_note_entry_product_detail_s_weight_mm[$i];
						$rec_product									= 	getProductGetail($produt_id);
						$brand_id										= 	$rec_product['product_brand_id'];
						$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
						$length_feet									= 	($prn_entry_product_detail_sl_feet[$i]/$total_ton);
						
						$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
						$length_meter									= 	$product_cal['3'];
						$product_detail_qty								= '1';
					}
					
					$stock_ledger_entry_type							= 	"credit-note-fin";
					
					$product_con_entry_godown_id						= 	"1";
					$product_mother_child_type = $credit_note_entry_product_detail_mother_child_type[$i];
							stockLedger($credit_note_entry_product_detail_entry_type[$i],'in',$credit_note_entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $credit_note_entry_branch_id, $product_con_entry_godown_id, $credit_note_entry_date, $credit_note_entry_no,$stock_ledger_entry_type, '3',$width_inches,$width_mm,$product_colour_id,$product_thick);	
							
							/* $entry_no 		= $credit_note_entry_no;
							$entry_date		= $credit_note_entry_date;
							$acc_amount = 0;
							$entry_remark = '';
							$branch_id		= $credit_note_entry_branch_id;
							$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
							$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
							$cash_id		= $setup_detail['acS_sales_ac2'];
							$acc_cr_id = $cash_id;
							$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
							$acc_amount_mmk = $credit_note_entry_product_detail_total[$i];
							update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);
							update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount_mmk , $entry_remark, $branch_id,$acc_amount); */
				}
				} else {
					/* $entry_no 		= $credit_note_entry_no;
					$entry_date		= $credit_note_entry_date;
					$acc_amount = 0;
					$entry_remark = '';
					$branch_id		= $credit_note_entry_branch_id;
					$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
					$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
					$cash_id		= $setup_detail['acS_sales_ac2'];
					$acc_cr_id = $cash_id;
					$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
					$acc_amount_mmk = $credit_note_entry_product_detail_total[$i];
					update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);
					update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount_mmk , $entry_remark, $branch_id,$acc_amount); */
				}

			}

		

		}
		
		//Update Account Transaction//Insert into Account Transaction
		$entry_no 		= $credit_note_entry_no;
		$entry_date		= $credit_note_entry_date;
		$acc_amount = 0;
		$entry_remark = '';
		$branch_id		= $credit_note_entry_branch_id;
		$acc_dr_id		= getMasterID($credit_note_entry_customer_id, 'customer');
		$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
		$cash_id		= $setup_detail['acS_sales_ac2'];
		$acc_cr_id = $cash_id;
		$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
		update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D',$acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);
		update_transaction($credit_note_entry_id , $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C',$acc_amount_mmk , $entry_remark, $branch_id,$acc_amount);

		pageRedirection("credit-note-entry/index.php?page=edit&id=$credit_note_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['credit_note_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$credit_note_entry_uniq_id = $_GET['credit_note_entry_uniq_id'];

			mysql_query("UPDATE credit_note_entry_product_details SET credit_note_entry_product_detail_deleted_status = 1 

						WHERE credit_note_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$credit_note_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('credit_note_entry', 'credit_note_entry_deleted_by', 'credit_note_entry_deleted_on' , 'credit_note_entry_deleted_ip','credit_note_entry_deleted_status', 'credit_note_entry_id', 'credit_note_entry_uniq_id', '1');

		

		deleteMultiRecords('credit_note_entry_product_details', 'credit_note_entry_product_detail_deleted_by', 'credit_note_entry_product_detail_deleted_on', 'credit_note_entry_product_detail_deleted_ip', 'credit_note_entry_product_detail_deleted_status', 'credit_note_entry_product_detail_credit_note_entry_id', 'credit_note_entry','credit_note_entry_id','credit_note_entry_uniq_id', '1');  



		

		pageRedirection("credit-note-entry/index.php?msg=7");				

	}

?>