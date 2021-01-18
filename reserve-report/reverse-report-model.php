<?php 

	function purchaseOrderdetails(){
		
		 $query  = "SELECT purchaseId FROM  purchase_order
					ORDER BY purchaseId DESC";
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
		
		mysql_query("BEGIN");	
		
			if(empty($_REQUEST['id'])){
				  
				 $query = "INSERT INTO grn_details SET grn_branchid='".$_REQUEST['branchid']."', grn_purchaseId='".$_REQUEST['purchaseid']."', grn_warehouseid='".$_REQUEST['warehouseid']."',grn_grn_type='".$_REQUEST['grn_type']."',grn_date='".dateDatabaseFormat($_REQUEST['grn_date'])."',grn_remarks='".$_REQUEST['remark']."',grn_company_id='$bC', grn_added_by='$by', grn_added_on=NOW(), grn_added_ip='$ip'";
			
			}else{
			
				$query = "UPDATE grn_details SET grn_branchid='".$_REQUEST['branchid']."', grn_purchaseId='".$_REQUEST['purchaseid']."', grn_warehouseid='".$_REQUEST['warehouseid']."',grn_grn_type='".$_REQUEST['grn_type']."',grn_date='".dateDatabaseFormat($_REQUEST['grn_date'])."',grn_remarks='".$_REQUEST['remark']."',grn_modified_by='$by', grn_modified_on=NOW(),grn_modified_ip='$ip' WHERE grnId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=0;$k<$_REQUEST['receipt_count'];$k++){
				
					if(!empty($_REQUEST['accept_qty_'.$k]) && 0<$_REQUEST['accept_qty_'.$k]){
						 if(empty($_REQUEST['pid_'.$k])){
					
					
							$query ="INSERT INTO grn_details_products SET grnP_grnId='".$last_id."',grnP_product_id='".$_REQUEST['productid_'.$k]."',grnP_poqty='".$_REQUEST['po_qty_'.$k]."',grnP_received_earlier='".$_REQUEST['received_qty_'.$k]."', grnP_curnt_supply='".$_REQUEST['current_qty_'.$k]."',grnP_reject='".$_REQUEST['reject_qty_'.$k]."',grnP_accept='".$_REQUEST['accept_qty_'.$k]."',grnP_pending='".$_REQUEST['pending_qty_'.$k]."'";
					
						 }else{
					  
					 	 $query ="UPDATE grn_details_products SET grnP_grnId='".$last_id."',grnP_product_id='".$_REQUEST['productid_'.$k]."',grnP_poqty='".$_REQUEST['po_qty_'.$k]."',grnP_received_earlier='".$_REQUEST['received_qty_'.$k]."', grnP_curnt_supply='".$_REQUEST['current_qty_'.$k]."',grnP_reject='".$_REQUEST['reject_qty_'.$k]."',grnP_accept='".$_REQUEST['accept_qty_'.$k]."',grnP_pending='".$_REQUEST['pending_qty_'.$k]."' WHERE grnP_grnId='".$last_id."' AND grnProdId='".$_REQUEST['pid_'.$k]."'";
	
						 }	
						 			  				
						$qry = mysql_query($query);
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
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
		
		$query  = "SELECT grnId,grn_purchaseId,branch_name,godown_name,DATE_FORMAT(grn_date ,'%d-%m-%Y') AS grn_date
				    FROM grn_details
					LEFT JOIN branches ON grn_branchid = branch_id	
					LEFT JOIN godowns ON grn_warehouseid = godown_id	
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
					JOIN purchase_order ON grn_purchaseId = purchaseId
					LEFT JOIN suppliers ON pR_supplier_id = supplier_id
					WHERE grnId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editReceiptproduct($id){
		
		$query = "SELECT A.*,product_name,product_uom_name,product_code
					FROM grn_details_products A
		 			JOIN products ON grnP_product_id = product_id
					JOIN product_uoms ON product_uom_id = product_product_uom_id
					WHERE grnP_grnId='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	

?>
