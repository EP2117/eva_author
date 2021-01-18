<?php 

function get_supplier(){

	$select="SELECT * FROM suppliers WHERE supplier_deleted_status = 0";
	
	$query=mysql_query($select);
	while($result=mysql_fetch_array($query)){
	
	$arr_sup[]=$result;
	
	}
	return $arr_sup;

}


	function purchaseOrderdetails(){
		
		$check_id =  ""; //5
		 $query  = "SELECT 
		 				purchaseId,
						purchase_no,
						supplier_name,
						DATE_FORMAT(pR_purchase_date ,'%d/%m/%Y') AS pR_purchase_date 
						FROM  purchase_order
					LEFT JOIN 
						suppliers 
					ON 
						pR_supplier_id = supplier_id
					LEFT JOIN
						(SELECT
							SUM(pRp_qty+pRp_ton) as po_qty,
							 pRp_purchaseId
						 FROM
						 	purchase_order_products
						 WHERE
						 	pRp_deleted_status			= 0
						 GROUP BY 
						 	pRp_purchaseId) as po_detail
					ON
						pRp_purchaseId		= purchaseId
					LEFT JOIN 
						(SELECT 
							SUM(piP_po_ton+piP_po_qty) AS inv_qty,
							piP_po_id
						FROM 
							purchase_invoice_products
						WHERE 
							piP_deleted_status 				= 0  		 						
						GROUP BY 
							piP_po_id) rcv_table
				  ON	
				  		piP_po_id = purchaseId
							
		 			WHERE pR_deleted_status = 0  AND
					IFNULL(rcv_table.inv_qty,0) 				< po_detail.po_qty	 				 
					ORDER BY purchaseId DESC";
					//echo $query; exit;
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function invoiceInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];
		
		$frn_rate =	0;
		$rate =	0;	
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
			if(empty($_REQUEST['id'])){
			
					$select_inv_no = "SELECT MAX(invoiceNo) AS maxval FROM purchase_invoice 
									  WHERE  	pI_deleted_status =0
									  AND 		pI_branchid = '".$_REQUEST['branchid']."'
									  AND 		pI_company_id = '".$_SESSION[SESS.'_session_company_id']."'";

					$result_inv_no = mysql_query($select_inv_no);
					$record_inv_no = mysql_fetch_array($result_inv_no);	
					$maxval = $record_inv_no['maxval']; 
					if($maxval > 0) {
						$inv_no = substr(('00000'.++$maxval),-5);
					} else {
						$inv_no = substr(('00000'.++$maxval),-5);
					}
			
				  
				$query = "INSERT INTO purchase_invoice SET invoiceNo='".$inv_no."' ,pI_branchid='".$_REQUEST['branchid']."', pI_purchaseId='".$_REQUEST['purchaseid']."', pI_creditamnt='".$_REQUEST['creditamnt']."', pI_creditdays='".$_REQUEST['creditdays']."',pI_invoice_date='".NdateDatabaseFormat($_REQUEST['invoice_date'])."',pI_invoicetotal='".str_replace(',','',$_REQUEST['invoicetotal'])."',pI_cashdiscount='".str_replace(',','',$_REQUEST['cashdiscount'])."',pI_net_total='".str_replace(',','',$_REQUEST['net_total'])."',pI_invoice_total_amt='".str_replace(',','',$_REQUEST['invoice_total_amt'])."',pI_cashdiscount_amt='".str_replace(',','',$_REQUEST['cashdiscount_amt'])."',pI_net_total_amt='".str_replace(',','',$_REQUEST['net_total_amt'])."',pI_remark='".$_REQUEST['remark']."',pI_product_type='".$_REQUEST['invoice_entry_product_type']."', pI_company_id='$bC', pI_added_by='$by', pI_added_on=NOW(), pI_added_ip='$ip',pI_supplier_id='".$_REQUEST['supplier_id']."'";
				//echo $query;exit;
			
			
			}else{ 
			
				$query = "UPDATE purchase_invoice SET pI_branchid='".$_REQUEST['branchid']."', pI_purchaseId='".$_REQUEST['purchaseid']."', pI_creditamnt='".$_REQUEST['creditamnt']."', pI_creditdays='".$_REQUEST['creditdays']."',pI_invoice_date='".NdateDatabaseFormat($_REQUEST['invoice_date'])."',pI_invoicetotal='".str_replace(',','',$_REQUEST['invoicetotal'])."',pI_cashdiscount='".str_replace(',','',$_REQUEST['cashdiscount'])."',pI_net_total='".str_replace(',','',$_REQUEST['net_total'])."',pI_invoice_total_amt='".str_replace(',','',$_REQUEST['invoice_total_amt'])."',pI_cashdiscount_amt='".str_replace(',','',$_REQUEST['cashdiscount_amt'])."',pI_net_total_amt='".str_replace(',','',$_REQUEST['net_total_amt'])."',pI_remark='".$_REQUEST['remark']."', pI_product_type='".$_REQUEST['invoice_entry_product_type']."',pI_modified_by='$by', pI_modified_on=NOW(),pI_modified_ip='$ip',pI_supplier_id='".$_REQUEST['supplier_id']."' WHERE invoiceId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=1;$k<=count($_REQUEST['arr_count']);$k++){ 
				$frn_rate +=$_REQUEST['frgn_rate_'.$k];
		        $rate +=$_REQUEST['rate_'.$k];
				//echo $k;exit;
					
				   if(empty($_REQUEST['pid_'.$k])){
				
						$query ="INSERT INTO purchase_invoice_products SET piP_invoiceId='".$last_id."',piP_product_id='".$_REQUEST['productid'.$k]."',piP_po_qty='".str_replace(',','',$_REQUEST['po_qty_'.$k])."',piP_rate='".str_replace(',','',$_REQUEST['rate_'.$k])."', piP_frgn_rate='".str_replace(',','',$_REQUEST['frgn_rate_'.$k])."', piP_feet_per_qty='".str_replace(',','',$_REQUEST['feet_'.$k])."', piP_po_ton='".str_replace(',','',$_REQUEST['prd_ton_'.$k])."',piP_po_kg='".str_replace(',','',$_REQUEST['prd_kg_'.$k])."',piP_po_loss_ton='".str_replace(',','',$_REQUEST['prd_loss_ton_'.$k])."',piP_po_loss_kg='".str_replace(',','',$_REQUEST['prd_loss_kg_'.$k])."',piP_po_total_ton='".str_replace(',','',$_REQUEST['prd_total_ton_'.$k])."',piP_po_total_kg='".str_replace(',','',$_REQUEST['prd_total_kg_'.$k])."',piP_po_loss_amount='".str_replace(',','',$_REQUEST['prd_loss_amount_'.$k])."', piP_dispercent='".str_replace(',','',$_REQUEST['dispercent_'.$k])."',piP_disamnt='".str_replace(',','',$_REQUEST['disamnt_'.$k])."', piP_disamnt_cur='".str_replace(',','',$_REQUEST['disamnt_cur_'.$k])."', piP_total='".str_replace(',','',$_REQUEST['total_'.$k])."',piP_total_amt='".str_replace(',','',$_REQUEST['total_amt_'.$k])."',piP_frgntotal='".str_replace(',','',$_REQUEST['receive_qty_'.$k])."',piP_po_id='".$_REQUEST['purchaseid']."',piP_po_detail_id='".$_REQUEST['po_detail_id_'.$k]."'";
				
					 }else{
				  $K=$k;
					    $query ="UPDATE purchase_invoice_products SET piP_invoiceId='".$last_id."',piP_product_id='".$_REQUEST['productid'.$K]."',piP_po_qty='".str_replace(',','',$_REQUEST['po_qty_'.$K])."',piP_rate='".str_replace(',','',$_REQUEST['rate_'.$K])."', piP_frgn_rate='".str_replace(',','',$_REQUEST['frgn_rate_'.$K])."',piP_feet_per_qty='".str_replace(',','',$_REQUEST['feet_'.$k])."',piP_po_ton='".str_replace(',','',$_REQUEST['prd_ton_'.$K])."',piP_po_kg='".str_replace(',','',$_REQUEST['prd_kg_'.$K])."',piP_po_loss_ton='".str_replace(',','',$_REQUEST['prd_loss_ton_'.$K])."',piP_po_loss_kg='".str_replace(',','',$_REQUEST['prd_loss_kg_'.$K])."',piP_po_total_ton='".str_replace(',','',$_REQUEST['prd_total_ton_'.$K])."',piP_po_total_kg='".str_replace(',','',$_REQUEST['prd_total_kg_'.$K])."',piP_po_loss_amount='".str_replace(',','',$_REQUEST['prd_loss_amount_'.$K])."', piP_dispercent='".str_replace(',','',$_REQUEST['dispercent_'.$K])."',piP_disamnt='".str_replace(',','',$_REQUEST['disamnt_'.$K])."', piP_disamnt_cur='".str_replace(',','',$_REQUEST['disamnt_cur_'.$K])."',piP_total='".str_replace(',','',$_REQUEST['total_'.$K])."',piP_total_amt='".str_replace(',','',$_REQUEST['total_amt_'.$K])."',piP_frgntotal='".str_replace(',','',$_REQUEST['receive_qty_'.$K])."' WHERE piP_invoiceId='".$last_id."' AND invoiceProductId='".$_REQUEST['pid_'.$K]."'";
					
					 }	
												
					$qry = mysql_query($query);
					
					if(empty($qry)){					
						$rollBack=true;
						break;
				  }	
				  
				}
			} 
		$product_con_entry_child_product_detail_id     			= $_POST['product_con_entry_child_product_detail_id'];		
		$product_con_entry_child_product_detail_product_id     	= $_POST['product_con_entry_child_product_detail_product_id'];
		$product_con_entry_child_product_detail_product_brand_id  	= $_POST['product_con_entry_child_product_detail_product_brand_id'];
		$product_con_entry_child_product_detail_product_category_id   = $_POST['product_con_entry_child_product_detail_product_category_id'];	
		$product_con_entry_child_product_detail_code     		= $_POST['product_con_entry_child_product_detail_code'];
		$product_con_entry_child_product_detail_name   			= $_POST['product_con_entry_child_product_detail_name'];
		$product_con_entry_child_product_detail_color_id  		= $_POST['product_con_entry_child_product_detail_color_id'];
		$product_con_entry_child_product_detail_uom_id 			= $_POST['product_con_entry_child_product_detail_uom_id'];
		$product_con_entry_child_product_detail_thick 			= $_POST['product_con_entry_child_product_detail_thick'];
		$product_con_entry_child_product_detail_width_inches  	= $_POST['product_con_entry_child_product_detail_width_inches'];
		$product_con_entry_child_product_detail_width_mm  		= $_POST['product_con_entry_child_product_detail_width_mm'];
		$product_con_entry_child_product_detail_length_feet  	= $_POST['product_con_entry_child_product_detail_length_feet'];
		$product_con_entry_child_product_detail_length_mm 		= $_POST['product_con_entry_child_product_detail_length_mm'];
		$product_con_entry_child_product_detail_ton_qty 		= $_POST['product_con_entry_child_product_detail_ton_qty'];
		$product_con_entry_child_product_detail_kg_qty 			= $_POST['product_con_entry_child_product_detail_kg_qty'];
		
		$product_con_entry_osf_width_inches  	= $_POST['product_con_entry_osf_width_inches'];
		$product_con_entry_osf_width_mm  		= $_POST['product_con_entry_osf_width_mm'];
		$product_con_entry_osf_length_feet  	= $_POST['product_con_entry_osf_length_feet'];
		$product_con_entry_osf_length_m 		= $_POST['product_con_entry_osf_length_m'];
		$product_con_entry_osf_uom_ton	 		= $_POST['product_con_entry_osf_uom_ton'];
		$product_con_entry_osf_uom_kg	 		= $_POST['product_con_entry_osf_uom_kg'];
		$product_con_entry_amount_by_currency	= $_POST['product_con_entry_amount_by_currency'];
		$product_con_entry_amount_by_mmk 		= $_POST['product_con_entry_amount_by_mmk'];
			
			for($i = 0; $i < count($product_con_entry_child_product_detail_code); $i++) {
				
			$detail_request_fields 						= 	((!empty($product_con_entry_child_product_detail_length_feet[$i])));
			if($detail_request_fields) {
				if(!isset($product_con_entry_child_product_detail_id[$i])){
					$product_con_entry_child_product_detail_uniq_id = generateUniqId();
					$insert_product_con_entry_product_detail 		= sprintf("INSERT INTO product_con_entry_child_product_details 
																						(product_con_entry_child_product_detail_uniq_id,
																						product_con_entry_child_product_detail_product_id,
																						product_con_entry_child_product_detail_code,
																						product_con_entry_child_product_detail_name,
																						product_con_entry_child_product_detail_color_id,
																						product_con_entry_child_product_detail_width_inches,
																						product_con_entry_child_product_detail_width_mm,
																						product_con_entry_child_product_detail_length_mm,
																						product_con_entry_child_product_detail_length_feet,
																						product_con_entry_child_product_detail_uom_id,
																						product_con_entry_child_product_detail_thick_ness,
																						product_con_entry_child_product_detail_ton_qty,
																						product_con_entry_child_product_detail_kg_qty,
																						product_con_entry_child_product_detail_product_con_entry_id,
																						product_con_entry_child_product_detail_added_by,
																						product_con_entry_child_product_detail_added_on,
																						product_con_entry_child_product_detail_added_ip,
																						product_con_entry_osf_width_inches,product_con_entry_osf_width_mm,
																						product_con_entry_osf_length_feet,product_con_entry_osf_length_m,
																						product_con_entry_osf_uom_ton,product_con_entry_osf_uom_kg,
																						product_con_entry_amount_by_currency,product_con_entry_amount_by_mmk,
																						product_con_entry_child_product_detail_product_brand_id,
																						product_con_entry_child_product_detail_product_category_id)  
																		VALUES     	('%s', '%d',
																					'%s',  '%s',
																					'%d', 
																					'%f', '%f', 
																					'%f', '%f', 
																					'%d', '%f', 
																					'%f', '%f',
																					'%d', '%d', 
																					UNIX_TIMESTAMP(NOW()), '%s',
																					'%f','%f','%f',
																					'%f','%f','%f','%f','%f',
																					'%d','%d')", 
																					$product_con_entry_child_product_detail_uniq_id,
																					$product_con_entry_child_product_detail_product_id[$i], 
																					$product_con_entry_child_product_detail_code[$i], 
																					$product_con_entry_child_product_detail_name[$i], 
																					$product_con_entry_child_product_detail_color_id[$i], 
																					$product_con_entry_child_product_detail_width_inches[$i],
																					$product_con_entry_child_product_detail_width_mm[$i],
																					$product_con_entry_child_product_detail_length_mm[$i],
																					$product_con_entry_child_product_detail_length_feet[$i],
																					$product_con_entry_child_product_detail_uom_id[$i],
																					$product_con_entry_child_product_detail_thick[$i],
																					$product_con_entry_child_product_detail_ton_qty[$i],
																					$product_con_entry_child_product_detail_kg_qty[$i],
																					$last_id, $_SESSION[SESS.'_session_user_id'],$ip,
																					$product_con_entry_osf_width_inches[$i],$product_con_entry_osf_width_mm[$i],
																					$product_con_entry_osf_length_feet[$i],$product_con_entry_osf_length_m[$i],
																					$product_con_entry_osf_uom_ton[$i],$product_con_entry_osf_uom_kg[$i],
																					$product_con_entry_amount_by_currency[$i],$product_con_entry_amount_by_mmk[$i],
																					$product_con_entry_child_product_detail_product_brand_id[$i],
																					$product_con_entry_child_product_detail_product_category_id[$i]); 
	
					mysql_query($insert_product_con_entry_product_detail);
					$child_product_detail_id = mysql_insert_id();
				}
				else{
			   		 $update_child	= "UPDATE product_con_entry_child_product_details SET
										  product_con_entry_child_product_detail_width_inches		= '".$product_con_entry_child_product_detail_width_inches[$i]."',
										  product_con_entry_child_product_detail_width_mm			= '".$product_con_entry_child_product_detail_width_mm[$i]."',
										  product_con_entry_child_product_detail_length_feet		= '".$product_con_entry_child_product_detail_length_feet[$i]."',
										  product_con_entry_child_product_detail_length_mm			= '".$product_con_entry_child_product_detail_length_mm[$i]."',
										  product_con_entry_child_product_detail_ton_qty			= '".$product_con_entry_child_product_detail_ton_qty[$i]."',
										  product_con_entry_child_product_detail_kg_qty				= '".$product_con_entry_child_product_detail_kg_qty[$i]."',
										  product_con_entry_child_product_detail_color_id			= '".$product_con_entry_child_product_detail_color_id[$i]."',
										  product_con_entry_child_product_detail_uom_id				= '".$product_con_entry_child_product_detail_uom_id[$i]."',
										  product_con_entry_child_product_detail_thick_ness			= '".$product_con_entry_child_product_detail_thick[$i]."',
										  product_con_entry_osf_width_inches						= '".$product_con_entry_osf_width_inches[$i]."',
										  product_con_entry_osf_width_mm							= '".$product_con_entry_osf_width_mm[$i]."',
										  product_con_entry_osf_length_feet							= '".$product_con_entry_osf_length_feet[$i]."',
										  product_con_entry_osf_length_m							= '".$product_con_entry_osf_length_m[$i]."',
										  product_con_entry_osf_uom_ton								= '".$product_con_entry_osf_uom_ton[$i]."',
										  product_con_entry_osf_uom_kg								= '".$product_con_entry_osf_uom_kg[$i]."',
										  product_con_entry_amount_by_currency						= '".$product_con_entry_amount_by_currency[$i]."',
										  product_con_entry_amount_by_mmk							= '".$product_con_entry_amount_by_mmk[$i]."',
										  product_con_entry_child_product_detail_product_brand_id	= '".$product_con_entry_child_product_detail_product_brand_id[$i]."',
										  product_con_entry_child_product_detail_modified_by		= '".$_SESSION[SESS.'_session_user_id']."',
										  product_con_entry_child_product_detail_modified_on		= UNIX_TIMESTAMP(NOW()),
										  product_con_entry_child_product_detail_modified_ip		= '".$ip."'
									WHERE
										  product_con_entry_child_product_detail_id					= '".$product_con_entry_child_product_detail_id[$i]."' ";
										  
						$child_product_detail_id 					= $product_con_entry_child_product_detail_id[$i];
						mysql_query($update_child);	
				}
				
			}
		} 
		
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				
				if(empty($_REQUEST['id'])){
				
				$entry_no 		= substr(('000000'.$last_id),-5);
				$entry_date		= NdateDatabaseFormat($_REQUEST['invoice_date']);
				$branch_id		= $_REQUEST['branchid'];
				$setup_detail	= GetBranchAccSetup($branch_id);
				$acc_cr_id		= $setup_detail['acS_purchase'];
				$acc_dr_id		= getMasterID($_REQUEST['supplier_id'], 'supplier');
				$acc_amount		= str_replace(',','',$_REQUEST['invoicetotal'])+str_replace(',','',$_REQUEST['cashdiscount']);
				$acc_frn_amount	= ($frn_rate>0)?(str_replace(',','',$_REQUEST['invoice_total_amt'])+str_replace(',','',$_POST['cashdiscount_amt'])):0;
				
				$entry_remark	= $_REQUEST['remark'];
				update_transaction($last_id, $entry_no, $entry_date, 'purchase-invoice', $acc_dr_id, $acc_cr_id, 'D', $acc_amount, $entry_remark, $branch_id,$acc_frn_amount);	
				update_transaction($last_id, $entry_no, $entry_date, 'purchase-invoice', $acc_cr_id, $acc_dr_id, 'C', $acc_amount, $entry_remark, $branch_id,$acc_frn_amount);	
				
				if(str_replace(',','',$_POST['inv_advance_amt'])>0 || str_replace(',','',$_REQUEST['inv_advance'])>0){
					
				$acc_amount		= str_replace(',','',$_REQUEST['inv_advance']);
				$acc_frn_amount	= str_replace(',','',$_REQUEST['inv_advance_amt']);
				
				$acc_cr_id		= $setup_detail['acS_sales_ac2'];
				$entry_remark	= "advance";
				update_transaction($last_id, $entry_no, $entry_date, 'purchase-advance', $acc_dr_id, $acc_cr_id, 'C', $acc_amount, $entry_remark, $branch_id,$acc_frn_amount);	
				update_transaction($last_id, $entry_no, $entry_date, 'purchase-advance', $acc_cr_id, $acc_dr_id, 'D', $acc_amount, $entry_remark, $branch_id,$acc_frn_amount);	
				
				}	
				
				if(str_replace(',','',$_POST['cashdiscount_amt'])>0 || str_replace(',','',$_REQUEST['cashdiscount']>0)){
					$entry_remark	= "discount";
				$acc_amount		= str_replace(',','',$_REQUEST['cashdiscount']);
				$acc_frn_amount	= str_replace(',','',$_REQUEST['cashdiscount_amt']);
				
				$acc_cr_id		= $setup_detail['acS_sales_ac2'];
				
				update_transaction($last_id, $entry_no, $entry_date, 'purchase-discount', $acc_dr_id, $acc_cr_id, 'C', $acc_amount, $entry_remark, $branch_id,$acc_frn_amount);	
				update_transaction($last_id, $entry_no, $entry_date, 'purchase-discount', $acc_cr_id, $acc_dr_id, 'D', $acc_amount, $entry_remark, $branch_id,$acc_frn_amount);	
				
				}	
				
					pageRedirection("eva-invoice-entry/index.php?page=add&msg=1");	
				}else{
					pageRedirection("eva-invoice-entry/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			
			}
	}
	function listinvoice(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND pI_branchid = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND pI_invoice_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['search_supplier_id']))&& !empty($_REQUEST['search_supplier_id']))
		{
		$where.="AND pR_supplier_id ='".$_REQUEST['search_supplier_id']."' ";
		}
		$query  = "SELECT invoiceId,branch_name,DATE_FORMAT(pI_invoice_date ,'%d/%m/%Y') AS pI_invoice_date,invoiceNo,supplier_name,supplier_id,pR_rate,
		pR_supplier_id,pI_product_type
				    FROM purchase_invoice
					LEFT JOIN branches ON pI_branchid = branch_id	
					LEFT JOIN purchase_order ON purchaseId = pI_purchaseId 
					LEFT JOIN suppliers ON pR_supplier_id = supplier_id
					WHERE pI_deleted_status = 0 $where
					ORDER BY invoiceId DESC";
				   // echo $query;
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
	}
	
	 function editInvoicedetail($id){
			  $query  = "SELECT *,supplier_name,supplier_location,DATE_FORMAT(pI_invoice_date ,'%d/%m/%Y') AS pI_invoice_date,DATE_FORMAT(pR_purchase_date ,'%d/%m/%Y') AS pR_purchase_date,pI_purchaseId,pR_advanceAmnt,pR_advance_amount,supplier_mobile_no,supplier_billing_address
				    FROM purchase_invoice 
					LEFT JOIN purchase_order ON purchaseId = pI_purchaseId 
					LEFT JOIN suppliers ON pR_supplier_id = supplier_id
					WHERE 
					pI_deleted_status =0 AND
					invoiceId ='$id'";//exit;
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editInvoiceProduct($id){
		$query = "SELECT A.*,product_name,product_uom_name,product_code,brand_name
					FROM purchase_invoice_products A
		 			LEFT JOIN products ON piP_product_id = product_id
					LEFT JOIN product_uoms ON product_uom_id = product_purchase_uom_id
					LEFT JOIN 
						brands 
					ON 
						brand_id 							= product_brand_id
					WHERE 
					piP_deleted_status=0 AND
					piP_invoiceId='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function editChildProductDetail($id)
	{
			$product_con_entry_id 	= getId('product_con_entry', 'product_con_entry_id', 'product_con_entry_uniq_id', dataValidation($_GET['id'])); 
		$select_product_con_entry_child_product_detail 	= "	SELECT 
															product_con_entry_child_product_detail_id,
															product_con_entry_child_product_detail_product_id,
															product_con_entry_child_product_detail_width_inches,
															product_con_entry_child_product_detail_width_mm,
															product_con_entry_child_product_detail_length_mm,
															product_con_entry_child_product_detail_length_feet,
															product_con_entry_child_product_detail_name,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_ton_qty,
															product_con_entry_child_product_detail_kg_qty,
															product_con_entry_child_product_detail_uom_id,
															product_con_entry_child_product_detail_color_id,
															product_con_entry_child_product_detail_thick_ness,
															product_con_entry_osf_width_inches,
															product_con_entry_osf_width_mm,
															product_con_entry_osf_length_feet,
															product_con_entry_osf_length_m,
															product_con_entry_osf_uom_ton,
															product_con_entry_osf_uom_kg,
															product_con_entry_amount_by_currency,
															product_con_entry_amount_by_mmk,
															product_brand_id
															
														FROM 
															product_con_entry_child_product_details 
														LEFT JOIN products ON product_con_entry_child_product_detail_product_id = product_id
														WHERE 
															product_con_entry_child_product_detail_deleted_status		 		= 0 							AND 
															product_con_entry_child_product_detail_type		 					= 1 							AND 
															product_con_entry_child_product_detail_product_con_entry_id 		= '".$id."'";
		$result_product_con_entry_product_detail 	= mysql_query($select_product_con_entry_child_product_detail);
		$count_product_con_entry 					= mysql_num_rows($result_product_con_entry_product_detail);
		$arr_product_con_entry_product_detail 	= array();
		while($record_product_con_entry_product_detail = mysql_fetch_array($result_product_con_entry_product_detail)) {
			$arr_product_con_entry_product_detail[] = $record_product_con_entry_product_detail;
		}
		return $arr_product_con_entry_product_detail;

	}
	function invoicedelete(){
	
	
	if(isset($_REQUEST['deleteCheck']))
		{//echo 'sdf54';exit;
			
				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck = $checked[$i]; 
					$ip 	= getRealIpAddr();
					
					     $update_addend 	= "UPDATE  purchase_invoice
									SET 
										pI_deleted_status    = '1',
										pI_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
		                                pI_deleted_on        = UNIX_TIMESTAMP(NOW()),
		                                pI_deleted_ip	        = '".$ip."'
								WHERE               
										invoiceId             	= '".$deleteCheck."' ";
										//print_r($update_overtime);//exit;
						mysql_query($update_addend);
						
						$delete 	= "UPDATE  purchase_invoice_products SET piP_deleted_status = '1' ,
											piP_deleted_by ='".$_SESSION[SESS.'_session_user_id']."',
											piP_deleted_on =UNIX_TIMESTAMP(NOW()),
											piP_deleted_ip ='".$ip."'
									WHERE piP_invoiceId	 = '".$deleteCheck."' ";//exit;
						mysql_query($delete);
				
					//Acc Transaction		
					DeleteAccountTrasaction($deleteCheck, 'purchase-invoice');
					DeleteAccountTrasaction($deleteCheck, 'purchase-advance');
					DeleteAccountTrasaction($deleteCheck, 'purchase-discount');
				
				}	
				header("Location:index.php");
		}else{header("Location:index.php");}
		
	
	
	}

function deleteProductdetail()

   {

		if((isset($_REQUEST['invoiceProductId'])) )

		{
			$ip					= getRealIpAddr();
			$invoiceProductId 	= $_GET['invoiceProductId'];
			$invoiceId			= $_GET['invoiceId'];
			$select 			="SELECT * FROM purchase_invoice WHERE invoiceId ='".$invoiceId."'";
			$query=mysql_query($select);
			$result = mysql_fetch_array($query);
			$pI_invoicetotal 	= $result['pI_invoicetotal'];
			$pI_cashdiscount 	= $result['pI_cashdiscount'];
			 
			$pI_net_total 		= $result['pI_net_total'];
			
			
			 $select_details="SELECT * FROM purchase_invoice_products WHERE invoiceProductId = '".$invoiceProductId."' ";
			
			$query_details		=mysql_query($select_details);
			$result_details = mysql_fetch_array($query_details);
			
			 $piP_total 		= $result_details['piP_total'];
			 $piP_frgntotal 	= $result_details['piP_frgntotal'];
			 $piP_disamnt		= $result_details['piP_disamnt'];
			 $piP_dispercent	= $result_details['piP_dispercent'];
			 $piP_rate			= $result_details['piP_rate'];
			 $piP_frgn_rate		= $result_details['piP_frgn_rate'];
			 $piP_disamnt 		= $result_details['piP_disamnt'];
			 
			
			 
			 if($pI_cashdiscount!=''){
			 
			 $total_amt = $pI_cashdiscount - $piP_disamnt;
			 
			 }
			 
			if($piP_dispercent!=''){
				 if(!empty($piP_total)){
					 $total_amt1 	= $piP_rate * $piP_dispercent /100;
					 $total_amt 	= $pI_cashdiscount - $total_amt1;
				 }else{
					$total_amt1 	= $piP_frgn_rate * $piP_dispercent /100;
					$total_amt 		= $pI_cashdiscount - $total_amt1;	
				 }
			 }
			  if(!empty($piP_total)){
					$total_gross 	= $pI_invoicetotal - $piP_total;
					$net_amt 		= $total_gross - $total_amt;
			 }else{
					$total_gross 	= $pI_invoicetotal - $piP_frgntotal;
					$net_amt 		= $total_gross - $total_amt;
			 }
			 
			 
			 
			  $update = "UPDATE purchase_invoice SET pI_invoicetotal ='".$total_gross."',
			  								pI_cashdiscount ='".$total_amt."',
			 								pI_net_total ='".$net_amt."'
			 WHERE invoiceId ='".$invoiceId."'  ";//exit;
			
			 mysql_query($update);
			
		 	$delete 	= "UPDATE  purchase_invoice_products SET piP_deleted_status = '1' ,
								piP_deleted_by ='".$_SESSION[SESS.'_session_user_id']."',
								piP_deleted_on =UNIX_TIMESTAMP(NOW()),
								piP_deleted_ip ='".$ip."'
						WHERE invoiceProductId	 = '".$invoiceProductId."' ";//exit;
			mysql_query($delete);
			
			
			
			header("Location:index.php?page=edit&id=$invoiceId");

		}

		

   } 

?>
