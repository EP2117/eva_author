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
//print_r($_SESSION);exit;

	function reciptInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id']; 
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
			if(empty($_REQUEST['id'])){
				  
				 $query = "INSERT INTO grn_details SET grn_branchid='".$_REQUEST['branchid']."', grn_purchaseId='".$_REQUEST['purchaseid']."', grn_warehouseid='".$_REQUEST['warehouseid']."',grn_grn_type='".$_REQUEST['grn_type']."',grn_date='".NdateDatabaseFormat($_REQUEST['grn_date'])."',grn_typ='".$_REQUEST['typ']."',grn_remarks='".$_REQUEST['remark']."',grn_company_id='$bC', grn_added_by='$by', grn_added_on=NOW(), grn_added_ip='$ip' ";
			//echo $query;exit;
			}else{
			
				$query = "UPDATE grn_details SET grn_branchid='".$_REQUEST['branchid']."', grn_purchaseId='".$_REQUEST['purchaseid']."', grn_warehouseid='".$_REQUEST['warehouseid']."',grn_grn_type='".$_REQUEST['grn_type']."',grn_date='".NdateDatabaseFormat($_REQUEST['grn_date'])."',grn_typ='".$_REQUEST['typ']."',grn_remarks='".$_REQUEST['remark']."',grn_modified_by='$by', grn_modified_on=NOW(),grn_modified_ip='$ip' WHERE grnId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			$grn_no		= substr(('00000'.$last_id),-5);
			if(empty($qry)){ //echo 154;exit;
			
				$rollBack=true;
				
			}else{ //echo 148498;exit;			
				
				
				for($k=0;$k<=count($_REQUEST['arr_count']);$k++){ // $_REQUEST['reject_qty_'.$k];exit;
				
					if(isset($_REQUEST['feet_'.$k]) && $_REQUEST['feet_'.$k] != "") {
						$feet_per_qty = $_REQUEST['feet_'.$k];
					} else {
						$feet_per_qty = 0;
					}
					
					if(!empty($_REQUEST['accept_qty_'.$k]) && 0<$_REQUEST['accept_qty_'.$k]){
						 if(empty($_REQUEST['pid_'.$k])){
							 $query ="INSERT INTO grn_details_products SET grnP_grnId='".$last_id."',grnP_product_id='".$_REQUEST['productid_'.$k]."',grnP_poqty='".$_REQUEST['po_qty_'.$k]."',grnP_feet_per_qty='".$feet_per_qty."',grnP_received_earlier='".$_REQUEST['received_qty_'.$k]."', grnP_curnt_supply='".$_REQUEST['current_qty_'.$k]."',grnP_reject='".$_REQUEST['reject_qty_'.$k]."',grnP_accept='".$_REQUEST['accept_qty_'.$k]."',grnP_pending='".$_REQUEST['pending_qty_'.$k]."',grnP_po_id='".$_REQUEST['poid_'.$k]."',grnP_podetail_id='".$_REQUEST['podetailsid_'.$k]."',grnP_invoice_id='".$_REQUEST['purchaseid']."',grnP_mother_child_type='".$_REQUEST['grn_mother_child_type'.$k]."' ";
							 //echo $query;exit;
						$qry = mysql_query($query);
						$grn_detail_id	= mysql_insert_id();    
						 }else{
					 	   $query ="UPDATE grn_details_products SET grnP_grnId='".$last_id."',grnP_product_id='".$_REQUEST['productid_'.$k]."',grnP_poqty='".$_REQUEST['po_qty_'.$k]."',grnP_feet_per_qty='".$feet_per_qty."',grnP_received_earlier='".$_REQUEST['received_qty_'.$k]."', grnP_curnt_supply='".$_REQUEST['current_qty_'.$k]."',grnP_reject='".$_REQUEST['reject_qty_'.$k]."',grnP_accept='".$_REQUEST['accept_qty_'.$k]."',grnP_pending='".$_REQUEST['pending_qty_'.$k]."' WHERE grnProdId='".$_REQUEST['pid_'.$k]."'";
						$qry = mysql_query($query); 
						$grn_detail_id	= $_REQUEST['pid_'.$k];
						 }	
							$length_feet									= 	"1";
							$length_meter									= 	"1";
							$ton_qty										= 	"1";
							$kg_qty											= 	"1";
							$product_detail_qty								= 	"1";
							$stock_ledger_entry_type						= 	"purchase-grn-finished";
							
						//	echo $_REQUEST['productid_'.$k];exit;
						
						//echo $_SESSION[SESS.'_session_user_branch_type'];exit;
						if($_REQUEST['typ'] == 1) {
							$sale_feet = $feet_per_qty * $_REQUEST['accept_qty_'.$k];
							//For Accessories, add feet par quantity in stock ledger
							if($_REQUEST['branchid']==4){
							$godown_id										= 	"1";
							stockLedger_opp($feet_per_qty,$_REQUEST['grn_mother_child_type'.$k],'in',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,$_REQUEST['accept_qty_'.$k], $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,$_REQUEST['typ'],'','','','',$sale_feet);
									
							$godown_id										= 	"2";
							stockLedger_opp($feet_per_qty,$_REQUEST['grn_mother_child_type'.$k],'in',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,$_REQUEST['accept_qty_'.$k], $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,$_REQUEST['typ'],'','','','',$sale_feet);
						   }
						   else{
							  // echo $_REQUEST['warehouseid'];exit;
							$godown_id										= 	$_REQUEST['warehouseid'];
							stockLedger_opp($feet_per_qty,$_REQUEST['grn_mother_child_type'.$k],'in',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,$_REQUEST['accept_qty_'.$k], $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,$_REQUEST['typ'],'','','','',$sale_feet);
							$godown_id										= 	"2";
							stockLedger_opp($feet_per_qty,$_REQUEST['grn_mother_child_type'.$k],'in',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,$_REQUEST['accept_qty_'.$k], $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,$_REQUEST['typ'],'','','','',$sale_feet);
						   }
						}
						else {
							if($_REQUEST['branchid']==4){
							$godown_id										= 	"1";
							stockLedger($_REQUEST['grn_mother_child_type'.$k],'in',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,$_REQUEST['accept_qty_'.$k], $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,$_REQUEST['typ']);
									
							$godown_id										= 	"2";
							stockLedger($_REQUEST['grn_mother_child_type'.$k],'in',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,$_REQUEST['accept_qty_'.$k], $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,$_REQUEST['typ']);
						   }
						   else{
							  // echo $_REQUEST['warehouseid'];exit;
							$godown_id										= 	$_REQUEST['warehouseid'];
							stockLedger($_REQUEST['grn_mother_child_type'.$k],'in',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,$_REQUEST['accept_qty_'.$k], $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,$_REQUEST['typ']);
							$godown_id										= 	"2";
							stockLedger($_REQUEST['grn_mother_child_type'.$k],'in',$last_id,$grn_detail_id,$_REQUEST['productid_'.$k],$length_feet,$length_meter,$ton_qty,$kg_qty,$_REQUEST['accept_qty_'.$k], $_REQUEST['branchid'],  $godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type,$_REQUEST['typ']);
						   }
						}
						
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
					 }	
				}
				
				$grn_child_product_detail_product_id		= $_REQUEST['grn_child_product_detail_product_id'];	
				$grn_child_product_detail_id				= $_REQUEST['grn_child_product_detail_id']; 
				$grn_child_product_detail_inv_detail_id		= $_REQUEST['grn_child_product_detail_inv_detail_id'];
				$grn_child_product_detail_code				= $_REQUEST['grn_child_product_detail_code'];	
				$grn_child_product_detail_name				= $_REQUEST['grn_child_product_detail_name'];
				$grn_child_product_detail_color_id			= $_REQUEST['grn_child_product_detail_color_id'];	
				$grn_child_product_detail_thick_ness		= $_REQUEST['grn_child_product_detail_thick_ness'];
				$grn_child_product_detail_uom_id			= $_REQUEST['grn_child_product_detail_uom_id'];	 
				$grn_child_product_detail_width_inches		= $_REQUEST['grn_child_product_detail_width_inches'];
				$grn_child_product_detail_width_mm			= $_REQUEST['grn_child_product_detail_width_mm'];	
				$grn_child_product_detail_length_feet		= $_REQUEST['grn_child_product_detail_length_feet'];
				$grn_child_product_detail_length_mm			= $_REQUEST['grn_child_product_detail_length_mm'];	
				$grn_child_product_detail_ton_qty			= $_REQUEST['grn_child_product_detail_ton_qty'];
				$grn_child_product_detail_kg_qty			= $_REQUEST['grn_child_product_detail_kg_qty'];	
				$grn_child_mother_child_type			    = $_REQUEST['grn_child_mother_child_type'];	
				
				 
				for($l=0; $l < count($grn_child_product_detail_product_id); $l++){
						$child_uniq_id = generateUniqId(); 	
							if(empty($grn_child_product_detail_id[$l])){
							//echo $grn_child_mother_child_type[$l]; exit;
		$insert_child	= sprintf("INSERT INTO   grn_child_product_details (grn_child_product_detail_uniq_id, grn_child_product_detail_product_id,
												  grn_child_product_detail_code, grn_child_product_detail_name,
												  grn_child_product_detail_grn_id, grn_child_product_detail_inv_detail_id, grn_child_product_detail_color_id,
												  grn_child_product_detail_thick_ness, grn_child_product_detail_uom_id, grn_child_product_detail_width_inches,
												  grn_child_product_detail_width_mm, grn_child_product_detail_length_feet, grn_child_product_detail_length_mm,
												  grn_child_product_detail_ton_qty, grn_child_product_detail_kg_qty,
												  grn_child_product_detail_company_id, grn_child_product_detail_branch_id, 
												  grn_child_product_detail_financial_year,
												  grn_child_product_detail_added_by, grn_child_product_detail_added_on, grn_child_product_detail_added_ip,
												  grn_child_product_detail_invoice_id,grn_child_mother_child_type)
										  VALUES 	 ('%s', '%d', 
										  			  '%s', '%s',
										  			  '%d', '%d', '%d',
													  '%f', '%d', '%f', 
													  '%f', '%f', '%f',
													  '%f', '%f',
													  '%d', '%d', '%d', 
													  '%d', UNIX_TIMESTAMP(NOW()), '%s', '%d' , '%d' )",
												 $child_uniq_id,$grn_child_product_detail_product_id[$l],
												 $grn_child_product_detail_code[$l],$grn_child_product_detail_name[$l],
												 $last_id, $grn_child_product_detail_inv_detail_id[$l],$grn_child_product_detail_color_id[$l],
												 $grn_child_product_detail_thick_ness[$l],$grn_child_product_detail_uom_id[$l],$grn_child_product_detail_width_inches[$l],
												 $grn_child_product_detail_width_mm[$l],$grn_child_product_detail_length_feet[$l],$grn_child_product_detail_length_mm[$l],
												 $grn_child_product_detail_ton_qty[$l],$grn_child_product_detail_kg_qty[$l],
												 $_SESSION[SESS.'_session_company_id'],$_REQUEST['branchid'],$_SESSION[SESS.'_session_financial_year'],
												 $_SESSION[SESS.'_session_user_id'], $ip,$_REQUEST['purchaseid'],$grn_child_mother_child_type[$l]);
												// echo $insert_child;exit;
						$qry_child = mysql_query($insert_child);
							$child_product_detail_id = mysql_insert_id();			
							}else{
							
			   $update_child	= "UPDATE grn_child_product_details SET
										  grn_child_product_detail_width_inches		= '".$grn_child_product_detail_product_id[$l]."',
										  grn_child_product_detail_width_mm			= '".$grn_child_product_detail_width_mm[$l]."',
										  grn_child_product_detail_length_feet		= '".$grn_child_product_detail_length_feet[$l]."',
										  grn_child_product_detail_length_mm		= '".$grn_child_product_detail_length_mm[$l]."',
										  grn_child_product_detail_ton_qty			= '".$grn_child_product_detail_ton_qty[$l]."',
										  grn_child_product_detail_kg_qty			= '".$grn_child_product_detail_kg_qty[$l]."',
										  grn_child_product_detail_modified_by		= '".$_SESSION[SESS.'_session_user_id']."',
										  grn_child_product_detail_modified_on		= UNIX_TIMESTAMP(NOW()),
										  grn_child_product_detail_modified_ip		= '".$ip."'
									WHERE
										  grn_child_product_detail_id				= '".$grn_child_product_detail_id[$l]."' ";
									//echo $update_child; exit;
						mysql_query($update_child);	
							 $child_product_detail_id		= $grn_child_product_detail_id[$l];
							}
							$produt_id											=	$grn_child_product_detail_product_id[$l];
							$length_feet										= 	$grn_child_product_detail_length_feet[$l];
							$length_meter										= 	$grn_child_product_detail_length_mm[$l];
							$ton_qty											= 	$grn_child_product_detail_ton_qty[$l];
							$kg_qty												= 	$grn_child_product_detail_kg_qty[$l];
							$width_inches										=   $grn_child_product_detail_width_inches[$l];
							$width_mm											=   $grn_child_product_detail_width_mm[$l];
							$color_id											= 	$grn_child_product_detail_color_id[$l];
							$thick												= 	$grn_child_product_detail_thick_ness[$l];
							$child_type											= 	$grn_child_mother_child_type[$l];
							$product_detail_qty									= 	"1";
							$stock_ledger_entry_type							= 	"purchase-grn-raw";
							//$_SESSION[SESS.'_session_user_branch_type']
							if($_REQUEST['branchid']==4){
								$product_con_entry_godown_id						= 	"1";
								stockLedger($child_type,'in',$last_id,$child_product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $_REQUEST['branchid'],  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['grn_date']),$grn_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
								$child_produt_d										= Child_prod_detail($produt_id);
								$product_con_entry_godown_id						= 	"2";
								stockLedger($child_type,'in',$last_id,$child_product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $_REQUEST['branchid'],  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
							}
							else{
								$product_con_entry_godown_id						= 	$_REQUEST['warehouseid'];
								stockLedger($child_type,'in',$last_id,$child_product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $_REQUEST['branchid'],  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['grn_date']),$grn_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
								$product_con_entry_godown_id						= 	"2";
								stockLedger($child_type,'in',$last_id,$child_product_detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $_REQUEST['branchid'],  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['grn_date']), $grn_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
								
							}
				
				}
				
				
			}
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				
				if(empty($_REQUEST['id'])){
					pageRedirection("eva-grn/index.php?page=add&msg=1");	
				}else{
					pageRedirection("eva-grn/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
			
			
			
		
		
	}
	function listreqRec(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND grn_branchid = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND grn_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['search_supplier_id']))&& !empty($_REQUEST['search_supplier_id']))
		{
		$where.="AND pR_supplier_id ='".$_REQUEST['search_supplier_id']."' ";
		}
		$query  = "SELECT grnId,grn_purchaseId,branch_name,godown_name,DATE_FORMAT(grn_date ,'%d/%m/%Y') AS grn_date,supplier_name,
						 invoiceNo
				    FROM grn_details
					LEFT JOIN branches ON grn_branchid = branch_id	
					LEFT JOIN godowns ON grn_warehouseid = godown_id
					JOIN purchase_invoice ON grn_purchaseId = invoiceId
					JOIN purchase_order ON purchaseId = pI_purchaseId
					LEFT JOIN suppliers ON pR_supplier_id = supplier_id 
					WHERE grn_deleted_status =0	 $where
					ORDER BY grnId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editReceiptdetails($id){
		 $query  = "SELECT A.*,supplier_name,supplier_location,DATE_FORMAT(grn_date ,'%d/%m/%Y') AS grn_date,DATE_FORMAT(pR_purchase_date ,'%d/%m/%Y') AS pR_purchase_date
				    FROM grn_details A 
					LEFT JOIN
						purchase_invoice
					ON
							invoiceId			=  grn_purchaseId
					LEFT JOIN purchase_order ON pI_purchaseId = purchaseId
					LEFT JOIN suppliers ON pR_supplier_id = supplier_id
					WHERE 
					grn_deleted_status =0
					AND grnId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editReceiptproduct($id){
		
		  $query = "SELECT A.*,product_name,product_uom_name,product_code
					FROM grn_details_products A
		 			LEFT JOIN products ON grnP_product_id = product_id
					LEFT JOIN product_uoms ON product_uom_id = product_purchase_uom_id
					WHERE
					grnP_deleted_status =0 AND
					 grnP_grnId='$id'"; 
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	function editReceiptproductChild($id){
		
		 $query = "SELECT *,product_uom_name, product_colour_name
					FROM grn_child_product_details
					LEFT JOIN product_uoms ON product_uom_id = grn_child_product_detail_uom_id
					LEFT JOIN product_colours ON product_colour_id = grn_child_product_detail_color_id
					WHERE
					grn_child_product_detail_deleted_status = 0 AND
					 grn_child_product_detail_grn_id ='$id'"; 
				//	echo $query; exit;
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
														grn_details_products
													WHERE
														grnP_deleted_status		= 0	AND
														grnP_grnId				= '".$deleteCheck."'";
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
														stock_ledger_entry_type             	= 'purchase-grn-finished' 					AND
														stock_ledger_entry_id					= '".$deleteCheck."'						AND
														stock_ledger_entry_detail_id			= '".$resultData['grnProdId']."'";
							mysql_query($update_ps_detail);
					 }
					$select_grn_ch_detal			= "SELECT
															*
														FROM
															grn_child_product_details
														WHERE
															grn_child_product_detail_deleted_status		= 0	AND
															grn_child_product_detail_grn_id				= '".$deleteCheck."'";
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
														stock_ledger_entry_type             	= 'purchase-grn-raw' 											AND
														stock_ledger_entry_id					= '".$deleteCheck."'											AND
														stock_ledger_entry_detail_id			= '".$resultChData['grn_child_product_detail_id']."'";
							mysql_query($update_cs_detail);
					 }
					 
						$update_c_detail 	= "UPDATE  grn_child_product_details
												SET 
													grn_child_product_detail_deleted_status    = '1',
													grn_child_product_detail_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
													grn_child_product_detail_deleted_on        = UNIX_TIMESTAMP(NOW()),
													grn_child_product_detail_deleted_ip	       = '".$ip."'
											WHERE               
													grn_child_product_detail_grn_id             = '".$deleteCheck."' ";
						mysql_query($update_c_detail);
						$update_p_detail 	= "UPDATE  grn_details_products
												SET 
													grnP_deleted_status    = '1',
													grnP_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
													grnP_deleted_on        = UNIX_TIMESTAMP(NOW()),
													grnP_deleted_ip	        = '".$ip."'
											WHERE               
													grnP_grnId             	= '".$deleteCheck."' ";
						mysql_query($update_p_detail);
					
					     $update_addend 	= "UPDATE  grn_details
									SET 
										grn_deleted_status    = '1',
										grn_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
		                                grn_deleted_on        = UNIX_TIMESTAMP(NOW()),
		                                grn_deleted_ip	        = '".$ip."'
								WHERE               
										grnId             	= '".$deleteCheck."' ";
										//print_r($update_overtime);//exit;
					mysql_query($update_addend);
				
				
					
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
