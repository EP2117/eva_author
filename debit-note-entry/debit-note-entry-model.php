<?php 

function get_supplier(){

	$select="SELECT * FROM suppliers WHERE supplier_deleted_status = 0";
	
	$query=mysql_query($select);
	while($result=mysql_fetch_array($query)){
	
	$arr_sup[]=$result;
	
	}
	return $arr_sup;

}


	/*function purchaseOrderdetails(){
		
		 $query  = "SELECT purchaseId,purchase_no,supplier_name FROM  purchase_order 
		 LEFT JOIN suppliers ON supplier_id = pR_supplier_id
		 WHERE pR_deleted_status = 0 
					ORDER BY purchaseId DESC";
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}*/

	/* function purchaseOrderdetails(){
			
			 $query  = "SELECT invoiceId,invoiceNo,supplier_name FROM  purchase_invoice
			 LEFT JOIN	purchase_order ON purchaseId	= pI_purchaseId 
			 LEFT JOIN suppliers ON supplier_id = pR_supplier_id
			 WHERE pR_deleted_status = 0 
						ORDER BY purchaseId DESC";
			$result = mysql_query($query);
			$array_result = array();
			while($resultData = mysql_fetch_array($result)){
				$array_result[] = $resultData;
			}
			return $array_result;
			
		} */
		
	function purchaseOrderdetails(){
			
			 $query  = "SELECT 
			 				invoiceId,
							invoiceNo,
							supplier_name 
						FROM  
							purchase_invoice
						LEFT JOIN
							(SELECT
								SUM(piP_po_qty+piP_po_ton) as po_qty,
							 	piP_invoiceId
							 FROM
								purchase_invoice_products
							 WHERE
								piP_deleted_status			= 0		AND
								piP_frgntotal				= 0
							 GROUP BY 
								piP_invoiceId) as inv_detail
						ON
							piP_invoiceId		= invoiceId
						LEFT JOIN 
							(SELECT 
								(grnP_reject+grnP_accept) AS received_qty,
								grnP_invoice_id
							FROM 
								grn_details_products	  	
							WHERE 
								grnP_deleted_status 				= 0 				
							GROUP BY 
								grnP_invoice_id) rcv_table
						ON	
							grnP_invoice_id = invoiceId
						LEFT JOIN
							(SELECT
								SUM(product_con_entry_child_product_detail_length_feet) as po_chd_qty,
							 	product_con_entry_child_product_detail_product_con_entry_id
							 FROM
								product_con_entry_child_product_details
							 WHERE
								product_con_entry_child_product_detail_deleted_status			= 0			AND
								product_con_entry_child_product_detail_type		 				= 1 							 
							 GROUP BY 
								product_con_entry_child_product_detail_product_con_entry_id) as inv_chd_detail
						ON
							product_con_entry_child_product_detail_product_con_entry_id		= invoiceId
						LEFT JOIN 
							(SELECT 
								grn_child_product_detail_length_feet AS received_chd_qty,
								grn_child_product_detail_invoice_id
							FROM 
								grn_child_product_details
							WHERE 
								grn_child_product_detail_deleted_status 				= 0  				
							GROUP BY 
								grn_child_product_detail_invoice_id) rcv_chd_table
						ON	
							grn_child_product_detail_invoice_id 			= invoiceId
			 			LEFT JOIN	
							purchase_order 
						ON 
							purchaseId	= pI_purchaseId 
			 			LEFT JOIN 
							suppliers 
						ON 
							supplier_id = pR_supplier_id
						WHERE 
							pR_deleted_status = 0 			AND
							(IFNULL(rcv_table.received_qty,0) 				< inv_detail.po_qty OR IFNULL(rcv_chd_table.received_chd_qty,0) < inv_chd_detail.po_chd_qty)
						GROUP BY 
							invoiceId
						ORDER BY invoiceNo DESC";
			$result = mysql_query($query);
			$array_result = array();
			while($resultData = mysql_fetch_array($result)){
				$array_result[] = $resultData;
			}
			return $array_result;
			
		}


	function reciptInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id']; 
		$ip	= getRealIpAddr();	
		//added by AuthorsMM
		if($_REQUEST['dn_entry_type_one_id'] == 1){
			//Raw type
			$stock_ledger_mother_child_type = 2;
		} else if($_REQUEST['dn_entry_type_one_id'] == 2) {
			//not raw type
			$stock_ledger_mother_child_type = 1;
		} else {
			$stock_ledger_mother_child_type = 0;
		}
		//echo 'test';exit;
		
		mysql_query("BEGIN");	
		
			if(empty($_REQUEST['dn_entry_id'])){
				
				  
				  $query = "INSERT INTO  dn_entry SET dn_entry_branch_id='".$_REQUEST['branchid']."', dn_entry_date='".NdateDatabaseFormat($_REQUEST['grn_date'])."', dn_entry_invoice_id='".$_REQUEST['purchaseid']."',dne_frgn_rate='".$_REQUEST['dne_frgn_rate']."',dn_entry_type_one_id='".$_REQUEST['dn_entry_type_one_id']."',dn_entry_type_two_id='".$_REQUEST['dn_entry_type_two_id']."',dn_entry_warehouseid='".$_REQUEST['dn_entry_warehouseid']."', dn_entry_company_id='$bC', dn_entry_added_by='$by', dn_entry_added_on=NOW(), dn_entry_added_ip='$ip'";
				 // echo $query;exit;
			
			}else{
			
				$query = "UPDATE dn_entry SET dn_entry_branch_id='".$_REQUEST['branchid']."', dn_entry_date='".NdateDatabaseFormat($_REQUEST['grn_date'])."', dn_entry_invoice_id='".$_REQUEST['purchaseid']."',dne_frgn_rate='".$_REQUEST['dne_frgn_rate']."',dn_entry_type_one_id='".$_REQUEST['dn_entry_type_one_id']."',dn_entry_type_two_id='".$_REQUEST['dn_entry_type_two_id']."',dn_entry_warehouseid='".$_REQUEST['dn_entry_warehouseid']."',dn_entry_modified_by='$by', dn_entry_modified_on=NOW(),dn_entry_modified_ip='$ip' WHERE dn_entry_id='".$_REQUEST['dn_entry_id']."'";
			//echo $query;exit;
			}
			$qry = mysql_query($query) or die(mysql_error());		
			$last_id = !empty($_REQUEST['dn_entry_id']) ? $_REQUEST['dn_entry_id'] : mysql_insert_id();
			$grn_no		= substr(('00000'.$last_id),-5);
			if(empty($qry)){
				$rollBack=true;
				
			}else{
				for($k=0;$k<$_REQUEST['receipt_count'];$k++){
					
					//Added by AuthorsMM
					if(isset($_REQUEST['feet_'.$k]) && $_REQUEST['feet_'.$k] != "") {
						$feet_per_qty =  $_REQUEST['feet_'.$k];
					} else {
						$feet_per_qty = 0;
					}
					//End
					
					if(!empty($_REQUEST['qty_'.$k]) && 0<$_REQUEST['qty_'.$k]){  //echo $_REQUEST['productid_'.$k];exit;
						 
						 if(empty($_REQUEST['dn_entry_product_detail_id_'.$k])){
							
								
								 $query ="INSERT INTO  dn_entry_product_details SET dn_entry_product_detail_dn_entry_id='".$last_id."',dn_entry_product_detail_invoice_id='".$_REQUEST['invoiceId_'.$k]."',dn_entry_product_detail_invoice_detail_id='".$_REQUEST['invoicedetailId_'.$k]."',dn_entry_product_detail_productid='".$_REQUEST['productid_'.$k]."', dn_entry_product_detail_po_qty=".$_REQUEST['po_qty_'.$k].",dn_entry_product_detail_qty='".$_REQUEST['qty_'.$k]."',dn_entry_product_detail_feet_per_qty='".$feet_per_qty."',dn_entry_product_detail_rate='".$_REQUEST['rate_'.$k]."',dn_entry_product_detail_f_rate='".$_REQUEST['f_rate_'.$k]."',
dn_entry_product_detail_tot_amount='".$_REQUEST['tot_amount_'.$k]."',dn_entry_product_detail_tot_amount_cur='".$_REQUEST['tot_amount_cur_'.$k]."',
								  dn_entry_product_detail_added_by='$by',dn_entry_product_detail_added_on=NOW(),dn_entry_product_detail_added_ip='$ip' ";
								//echo $qry;exit;  
								
								$qry = mysql_query($query);
								$grn_detail_id	= mysql_insert_id(); 
						
						 }else{

						 	 /*$query ="UPDATE dn_entry_product_details SET dn_entry_product_detail_dn_entry_id='".$last_id."',dn_entry_product_detail_productid='".$_REQUEST['productid_'.$k]."', dn_entry_product_detail_po_qty=".$_REQUEST['po_qty_'.$k].",dn_entry_product_detail_qty='".$_REQUEST['qty_'.$k]."',dn_entry_product_detail_feet_per_qty='".$feet_per_qty."',dn_entry_product_detail_rate='".$_REQUEST['rate_'.$k]."',dn_entry_product_detail_f_rate='".$_REQUEST['f_rate_'.$k]."',dn_entry_product_detail_tot_amount='".$_REQUEST['tot_amount_'.$k]."',
dn_entry_product_detail_tot_amount_cur='".$_REQUEST['tot_amount_cur_'.$k]."',dn_entry_product_detail_tot_amount='".$_REQUEST['tot_amount_'.$k]."',dn_entry_product_detail_modified_by='$by',dn_entry_product_detail_modified_on=NOW(),dn_entry_product_detail_modified_ip='$ip' WHERE dn_entry_product_detail_dn_entry_id='".$last_id."' AND dn_entry_product_detail_id='".$_REQUEST['dn_entry_product_detail_id_'.$k]."'";*/
							
							$query ="UPDATE dn_entry_product_details SET dn_entry_product_detail_dn_entry_id='".$last_id."',dn_entry_product_detail_po_qty=".$_REQUEST['po_qty_'.$k].",dn_entry_product_detail_qty='".$_REQUEST['qty_'.$k]."',dn_entry_product_detail_feet_per_qty='".$feet_per_qty."',dn_entry_product_detail_rate='".$_REQUEST['rate_'.$k]."',dn_entry_product_detail_f_rate='".$_REQUEST['f_rate_'.$k]."',dn_entry_product_detail_tot_amount='".$_REQUEST['tot_amount_'.$k]."',
dn_entry_product_detail_tot_amount_cur='".$_REQUEST['tot_amount_cur_'.$k]."',dn_entry_product_detail_tot_amount='".$_REQUEST['tot_amount_'.$k]."',dn_entry_product_detail_modified_by='$by',dn_entry_product_detail_modified_on=NOW(),dn_entry_product_detail_modified_ip='$ip' WHERE dn_entry_product_detail_dn_entry_id='".$last_id."' AND dn_entry_product_detail_id='".$_REQUEST['dn_entry_product_detail_id_'.$k]."'";

					//echo $query;exit;
							$qry = mysql_query($query);
							$grn_detail_id	= $_REQUEST['pid_'.$k];

						}	
						
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
							$length_feet									= 	"1";
							$length_meter									= 	"1";
							$ton_qty										= 	"1";
							$kg_qty											= 	"1";
							$product_detail_qty								= 	"1";
							$stock_ledger_entry_type						= 	"debit-note-acc";
							
							if($_REQUEST['dn_entry_type_one_id'] == 2){
								//For Accessories Type
								if($_SESSION[SESS.'_session_user_branch_type']==1){
									$godown_id										= 	"1";
									stockLedger_opp($feet_per_qty,$stock_ledger_mother_child_type,'out',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$_REQUEST['qty_'.$k]), $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,'1');
											
										$godown_id													= 	"2";
									stockLedger_opp($feet_per_qty,$stock_ledger_mother_child_type,'out',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$_REQUEST['qty_'.$k]), $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,'1');
								}
							} else {
								//raw type
								if($_SESSION[SESS.'_session_user_branch_type']==1){
									$godown_id										= 	"1";
									stockLedger($stock_ledger_mother_child_type,'out',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$_REQUEST['qty_'.$k]), $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,'1');
											
										$godown_id													= 	"2";
									stockLedger($stock_ledger_mother_child_type,'out',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$_REQUEST['qty_'.$k]), $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,'1');
								}
							}
							/*else{
								$godown_id										= 	$_REQUEST['dn_entry_warehouseid'];
							stockLedger('out',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,(-1*$_REQUEST['qty_'.$k]), $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,'1');
							}*/
						
						
											
					 }	
					 
					if($grn_detail_id>0){ 
					 //Acc transaction	
					$date = NdateDatabaseFormat($_REQUEST['grn_date']);
					$branch_id		= $_REQUEST['branchid'];
					$setup_detail	= GetBranchAccSetup($branch_id);
					$cash_id		= $setup_detail['acS_sales_ac2'];
					$acc_dr_id		= $cash_id;
					$acc_cr_id		= getMasterID($_REQUEST['supplier_id'], 'supplier');
					$acc_amount		= $_REQUEST['tot_amount_'.$k];
					$acc_amount_cur	= $_REQUEST['tot_amount_cur_'.$k];
					$entry_remark	= "debit note";
					
					update_transaction($grn_detail_id, $grn_no, $date, 'debit-note-acc', $acc_dr_id, $acc_cr_id, 'D', $acc_amount, $entry_remark, $branch_id,$acc_amount_cur);	
					update_transaction($grn_detail_id, $grn_no, $date, 'debit-note-acc', $acc_cr_id, $acc_dr_id, 'C', $acc_amount, $entry_remark, $branch_id,$acc_amount_cur);
					}
					 
				}
				
				$dne_child_detail_product_id			= $_REQUEST['dne_child_detail_product_id'];	
				$dne_child_detail_id					= $_REQUEST['dne_child_detail_id']; 
				$dne_child_detail_pro_dteial_id			= $_REQUEST['dne_child_detail_pro_dteial_id'];
				$dne_child_detail_color_id				= $_REQUEST['dne_child_detail_color_id'];	
				$dne_child_detail_thick					= $_REQUEST['dne_child_detail_thick'];
				$dne_child_detail_width_inches			= $_REQUEST['dne_child_detail_width_inches'];	
				$dne_child_detail_width_mm				= $_REQUEST['dne_child_detail_width_mm'];
				$dne_child_detail_length_feet			= $_REQUEST['dne_child_detail_length_feet'];	 
				$dne_child_detail_length_mm				= $_REQUEST['dne_child_detail_length_mm'];
				$dne_child_detail_uom_id				= $_REQUEST['dne_child_detail_uom_id'];	
				$dne_child_detail_ton_qty				= $_REQUEST['dne_child_detail_ton_qty'];
				$dne_child_detail_kg_qty				= $_REQUEST['dne_child_detail_kg_qty'];	
				$dne_child_detail_rate					= $_REQUEST['dne_child_detail_rate'];
				$dne_child_detail_frg_rate				= $_REQUEST['dne_child_detail_frg_rate'];	
				$dne_child_detail_dw_inches				= $_REQUEST['dne_child_detail_dw_inches'];	
				$dne_child_detail_dw_mm					= $_REQUEST['dne_child_detail_dw_mm'];
				$dne_child_detail_dnl_feet				= $_REQUEST['dne_child_detail_dnl_feet'];	
				$dne_child_detail_dnl_feet_ing			= $_REQUEST['dne_child_detail_dnl_feet_ing'];
				$dne_child_detail_dnl_m					= $_REQUEST['dne_child_detail_dnl_m'];	 
				$dne_child_detail_dw_kg					= $_REQUEST['dne_child_detail_dw_kg'];
				$dne_child_detail_dnl_dw_ton			= $_REQUEST['dne_child_detail_dnl_dw_ton'];	
				$dne_child_detail_amount				= $_REQUEST['dne_child_detail_amount'];
				$dne_child_detail_amount_cur			= $_REQUEST['dne_child_detail_amount_cur'];
				
				for($l=0; $l < count($dne_child_detail_product_id); $l++){ //echo 'test';exit;
						$child_uniq_id = generateUniqId(); 	
							if(empty($dne_child_detail_id[$l])){ 
								$insert_child	= sprintf("INSERT INTO   dn_entry_child_details (dne_child_detail_uniq_id,dne_child_detail_dn_entry_id, dne_child_detail_color_id,
														  dne_child_detail_product_id, dne_child_detail_pro_dteial_id,
														  dne_child_detail_thick, dne_child_detail_width_inches, dne_child_detail_width_mm,
														  dne_child_detail_length_feet, dne_child_detail_length_mm, dne_child_detail_uom_id,
														  dne_child_detail_ton_qty, dne_child_detail_kg_qty, dne_child_detail_rate,
														  dne_child_detail_frg_rate, dne_child_detail_dw_inches,
														  dne_child_detail_dw_mm, dne_child_detail_dnl_feet, 
														  dne_child_detail_dnl_m,dne_child_detail_dw_kg	,dne_child_detail_dnl_dw_ton,
														  dne_child_detail_amount,dne_child_detail_amount_cur,
														  dne_child_detail_financial_year,
														  dne_child_detail_added_by, dne_child_detail_added_on, dne_child_detail_added_ip,dne_child_detail_branch_id)
												  VALUES 	 ('%s', '%d', '%d', 
															  '%d', '%d',
															  '%d', '%f', '%f',
															  '%f', '%f', '%d', 
															  '%f', '%f', '%f',
															  '%f', '%f',
															  '%f', '%f',
															  '%f', '%f',
															  '%f', '%f','%f',
															  '%d', 
															  '%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )",
														 $child_uniq_id,$last_id,$dne_child_detail_color_id[$l],
														 $dne_child_detail_product_id[$l],$dne_child_detail_pro_dteial_id[$l],
														 $dne_child_detail_thick[$l], $dne_child_detail_width_inches[$l],$dne_child_detail_width_mm[$l],
														 $dne_child_detail_length_feet[$l],$dne_child_detail_length_mm[$l],$dne_child_detail_uom_id[$l],
														 $dne_child_detail_ton_qty[$l],$dne_child_detail_kg_qty[$l],$dne_child_detail_rate[$l],
														 $dne_child_detail_frg_rate[$l],$dne_child_detail_dw_inches[$l],
														 $dne_child_detail_dw_mm[$l],$dne_child_detail_dnl_feet[$l],
														 $dne_child_detail_dnl_m[$l],$dne_child_detail_dw_kg[$l],
														 $dne_child_detail_dnl_dw_ton[$l],$dne_child_detail_amount[$l],$dne_child_detail_amount_cur[$l],
														$_SESSION[SESS.'_session_financial_year'],
														 $_SESSION[SESS.'_session_user_id'], $ip ,$_REQUEST['branchid']);
							//echo $insert_child;exit;
								$qry_child = mysql_query($insert_child);
								$child_product_detail_id = mysql_insert_id();			
									}else{
					    			$update_child	= "UPDATE dn_entry_child_details SET
													  dne_child_detail_rate		= '".$dne_child_detail_rate[$l]."',
													  dne_child_detail_frg_rate			= '".$dne_child_detail_frg_rate[$l]."',
													  dne_child_detail_dw_inches		= '".$dne_child_detail_dw_inches[$l]."',
													  dne_child_detail_dw_mm			= '".$dne_child_detail_dw_mm[$l]."',
													  dne_child_detail_dnl_feet			= '".$dne_child_detail_dnl_feet[$l]."',
													  dne_child_detail_dnl_m			= '".$dne_child_detail_dnl_m[$l]."',
													  dne_child_detail_dw_kg			= '".$dne_child_detail_dw_kg[$l]."',
													  dne_child_detail_dnl_dw_ton		= '".$dne_child_detail_dnl_dw_ton[$l]."',
													  dne_child_detail_amount			= '".$dne_child_detail_amount[$l]."',
													  dne_child_detail_amount_cur		= '".$dne_child_detail_amount_cur[$l]."',
													  dne_child_detail_modified_by		= '".$_SESSION[SESS.'_session_user_id']."',
													  dne_child_detail_modified_on		= UNIX_TIMESTAMP(NOW()),
													  dne_child_detail_modified_ip		= '".$ip."'
												WHERE
													  dne_child_detail_id				= '".$dne_child_detail_id[$l]."' ";
										//echo $update_child;exit;			  
													  
								mysql_query($update_child);	
								$child_product_detail_id		 = $dne_child_detail_id[$l];
								}								
									
							$produt_id											=	$dne_child_detail_product_id[$l];
							$length_feet										= 	$dne_child_detail_dnl_feet[$l];
							$length_meter										= 	$dne_child_detail_dnl_m[$l];
							$ton_qty											= 	$dne_child_detail_dnl_dw_ton[$l];
							$kg_qty												= 	$dne_child_detail_dw_kg[$l];
							
							$width_inches										=   $dne_child_detail_width_inches[$l];
							$width_mm											=   $dne_child_detail_width_mm[$l];
							$color_id											= 	$dne_child_detail_color_id[$l];
							$thick												= 	$dne_child_detail_thick[$l];
							//echo $ton_qty; exit();
							$product_detail_qty									= 	"-1";
							$stock_ledger_entry_type						    = 	"purchase-debit-note";
							if($_SESSION[SESS.'_session_user_branch_type']==1){
							$product_con_entry_godown_id						= 	"1";
							//echo $produt_id;
							
							stockLedger($stock_ledger_mother_child_type,'out',$last_id,$child_product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $_REQUEST['branchid'],  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
							
							//$child_produt_d										= Child_prod_detail($produt_id);
							//$produt_id											= $child_produt_d['product_con_entry_child_product_detail_product_id'];
							//echo $produt_id;
							$product_con_entry_godown_id						= "2";
							stockLedger($stock_ledger_mother_child_type,'out',$last_id,$child_product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $_REQUEST['branchid'],  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
							}
							/*else{
								$product_con_entry_godown_id						= 	$_REQUEST['dn_entry_warehouseid'];
								stockLedger('out',$last_id,$child_product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $_REQUEST['branchid'],  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
							}*/
									
					//Acc transaction	
					$date = NdateDatabaseFormat($_REQUEST['grn_date']);
					$branch_id		= $_REQUEST['branchid'];
					$setup_detail	= GetBranchAccSetup($branch_id);
					$cash_id		= $setup_detail['acS_sales_ac2']; 
					$acc_dr_id		= $cash_id;
					$acc_cr_id		= getMasterID($_REQUEST['supplier_id'], 'supplier'); //echo $acc_cr_id; exit;
					$acc_amount		= $dne_child_detail_amount[$l];
					$acc_amount_cur	= $dne_child_detail_amount_cur[$l];
					$entry_remark	= "debit note";
					//echo $child_product_detail_id; exit;
					update_transaction($child_product_detail_id, $grn_no, $date, 'debit-note-raw', $acc_dr_id, $acc_cr_id, 'D', $acc_amount, $entry_remark, $branch_id, $acc_amount_cur);	
					update_transaction($child_product_detail_id, $grn_no, $date, 'debit-note-raw', $acc_cr_id, $acc_dr_id, 'C', $acc_amount, $entry_remark, $branch_id, $acc_amount_cur);
						
						
						
									
									
						}
					}
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				if(empty($_REQUEST['id'])){ //echo 'tsset';exit;
					
					pageRedirection("debit-note-entry/index.php?page=add&msg=1");	
				}else{
					pageRedirection("debit-note-entry/index.php?page=edit&id=".$_REQUEST['dn_entry_id']."&msg=2");	
				}	
			}else{	//echo 'tsset';exit;
				mysql_query("ROLLBACK");
				
			}
			
		
	}
	function listreqRec(){
	$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND dn_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND dn_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['search_supplier_id']))&& !empty($_REQUEST['search_supplier_id']))
		{
		$where.="AND pR_supplier_id ='".$_REQUEST['search_supplier_id']."' ";
		}
		$query  = "SELECT dn_entry_id,dn_entry_uniq_id,dn_entry_no,dn_entry_type_one_id,DATE_FORMAT(dn_entry_date ,'%d/%m/%Y') AS dn_entry_date,supplier_name,
						 invoiceNo,branch_name, supplier_id 
				    FROM dn_entry
					LEFT JOIN branches ON dn_entry_branch_id = branch_id	
					JOIN purchase_invoice ON dn_entry_invoice_id = invoiceId
					JOIN purchase_order ON purchaseId = pI_purchaseId
					LEFT JOIN suppliers ON pR_supplier_id = supplier_id
					WHERE dn_entry_deleted_status =0 $where	
					ORDER BY dn_entry_id DESC";
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editdebitdetails($id){

		$query  = "SELECT *,DATE_FORMAT(dn_entry_date ,'%d/%m/%Y') AS dn_entry_date
				    FROM dn_entry 	
				    LEFT JOIN purchase_invoice ON dn_entry_invoice_id = invoiceId 
				    LEFT JOIN purchase_order ON purchaseId	= pI_purchaseId 
					LEFT JOIN suppliers ON supplier_id = pR_supplier_id				
					WHERE dn_entry_deleted_status =0
					AND dn_entry_id ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editdebitproduct($id){
		
		  $query = "SELECT *
					FROM dn_entry_product_details
		 			LEFT JOIN products ON dn_entry_product_detail_productid = product_id
					LEFT JOIN product_uoms ON product_uom_id = product_purchase_uom_id
					WHERE
					dn_entry_product_detail_deleted_status =0 AND
					 dn_entry_product_detail_dn_entry_id='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	function editdebitproductChild($id){
			$query = "SELECT *,product_uom_name, product_colour_name
					FROM  dn_entry_child_details
					LEFT JOIN product_con_entry_child_product_details ON dne_child_detail_pro_dteial_id = product_con_entry_child_product_detail_id 
					LEFT JOIN products ON dne_child_detail_product_id = product_id
					LEFT JOIN product_uoms ON product_uom_id = product_purchase_uom_id
					LEFT JOIN product_colours ON product_colour_id = product_con_entry_child_product_detail_color_id
					WHERE
					dne_child_detail_deleted_status = 0 AND
					dne_child_detail_dn_entry_id ='$id'"; 
		 
			//echo  $query;exit;
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	
	function delete_grn(){
	
	if(isset($_REQUEST['deleteCheck']))
		{//echo 'sdf54';exit;
			
				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck = $checked[$i]; 
					$ip 	= getRealIpAddr();
					
					$select_grn_detal			= "SELECT
														*
												    FROM
														dn_entry_product_details
													WHERE
														dn_entry_product_detail_deleted_status		= 0	AND
														dn_entry_product_detail_dn_entry_id			= '".$deleteCheck."'";
					 $result_grn_det 			= mysql_query($select_grn_detal);
					 $response =array();
					 while($resultData = mysql_fetch_array($result_grn_det)){
					     $update_ps_detail 	= "UPDATE  stock_ledger
													SET 
														stock_ledger_status    					= '1',
														stock_ledger_deleted_by    	   			= '".$_SESSION[SESS.'_session_user_id']."',
														stock_ledger_deleted_on 				= UNIX_TIMESTAMP(NOW()),
														stock_ledger_deleted_ip    				= '".$ip."'
												WHERE               
														stock_ledger_entry_type             	= 'debit-note-acc' 											AND
														stock_ledger_entry_id					= '".$deleteCheck."'										AND
														stock_ledger_entry_detail_id			= '".$resultData['dn_entry_product_detail_id']."'";
							mysql_query($update_ps_detail);
					 }
					$select_grn_ch_detal			= "SELECT
															*
														FROM
															dn_entry_child_details
														WHERE
															dne_child_detail_deleted_status		= 0	AND
															dne_child_detail_dn_entry_id		= '".$deleteCheck."'";
					 $result_grn_ch_detal 			= mysql_query($select_grn_ch_detal);
					 $response =array();
					 while($resultChData = mysql_fetch_array($result_grn_ch_detal)){
					     $update_cs_detail 	= "UPDATE  stock_ledger
													SET 
														stock_ledger_status    					= '1',
														stock_ledger_deleted_by    	   			= '".$_SESSION[SESS.'_session_user_id']."',
														stock_ledger_deleted_on 				= UNIX_TIMESTAMP(NOW()),
														stock_ledger_deleted_ip    				= '".$ip."'
												WHERE               
														stock_ledger_entry_type             	= 'purchase-debit-note' 										AND
														stock_ledger_entry_id					= '".$deleteCheck."'											AND
														stock_ledger_entry_detail_id			= '".$resultChData['dne_child_detail_id']."'";
							mysql_query($update_cs_detail);
					 }
					 
						$update_c_detail 	= "UPDATE  dn_entry_child_details
												SET 
													dne_child_detail_deleted_status    		= '1',
													dne_child_detail_deleted_by    	   		= '".$_SESSION[SESS.'_session_user_id']."',
													dne_child_detail_deleted_on        		= UNIX_TIMESTAMP(NOW()),
													dne_child_detail_deleted_ip	       		= '".$ip."'
											WHERE               
													dne_child_detail_dn_entry_id     = '".$deleteCheck."' ";
						mysql_query($update_c_detail);
						$update_p_detail 	= "UPDATE  dn_entry_product_details
												SET 
													dn_entry_product_detail_deleted_status    = '1',
													dn_entry_product_detail_deleted_by    	  = '".$_SESSION[SESS.'_session_user_id']."',
													dn_entry_product_detail_deleted_on        = UNIX_TIMESTAMP(NOW()),
													dn_entry_product_detail_deleted_ip	      = '".$ip."'
											WHERE               
													dn_entry_product_detail_dn_entry_id       = '".$deleteCheck."' ";
						mysql_query($update_p_detail);
					
								 $update_addend 	= "UPDATE  dn_entry
											SET 
												dn_entry_deleted_status    = '1',
												dn_entry_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
												dn_entry_deleted_on        = UNIX_TIMESTAMP(NOW()),
												dn_entry_deleted_ip	       = '".$ip."'
										WHERE               
												dn_entry_id             	= '".$deleteCheck."' ";
												//print_r($update_overtime);//exit;
							mysql_query($update_addend);
				
					//Acc Transaction		
					DeleteAccountTrasaction($deleteCheck, 'debit-note-acc');
					DeleteAccountTrasaction($deleteCheck, 'debit-note-raw');
				
					
				}	
				header("Location:index.php");
		}else{header("Location:index.php");}
		
	
	
	}
	
	function deleteProductdetail()
    {

		if((isset($_REQUEST['grnProdId'])) )

		{
$ip												= getRealIpAddr();
		$grnProdId 	= $_GET['grnProdId'];
		$grnId 	= $_GET['grnId'];

			
			
		 $delete = "UPDATE  grn_details_products SET grnP_deleted_status = '1' ,
								grnP_deleted_by ='".$_SESSION[SESS.'_session_user_id']."',
								grnP_deleted_on =UNIX_TIMESTAMP(NOW()),
								grnP_deleted_ip ='".$ip."'
						WHERE grnProdId	 = '".$grnProdId."' ";//exit;
			mysql_query($delete);

			header("Location:index.php?page=edit&id=$grnId");

		}

		

   } 

?>
