<?php 

	function requestReciptInsertUpdate(){
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		if(!empty($_REQUEST['request_receipt']) && $_REQUEST['request_receipt']==1){
		
			$empid = explode(' - ',$_REQUEST['emp_name']);

		
			if(empty($_REQUEST['id'])){
				  
				$query = "INSERT INTO eng_inventory_request_receipt SET iRq_type='".$_REQUEST['request_receipt']."', iRq_branch='".$_REQUEST['branchid']."', iRq_warehouseid='".$_REQUEST['warehouseid']."', iRq_employee='".$empid[0]."',iRq_rqdate='".dateDatabaseFormat($_REQUEST['reqdate'])."',iRq_req_type='".$_REQUEST['req_type']."',iRq_departmentid='".$_REQUEST['departmentid']."',iRq_noofpaking='".$_REQUEST['nopackage']."',iRq_pakingdetails='".$_REQUEST['packingdetails']."',iRq_remarks='".$_REQUEST['remarks']."',iRq_company_id='$bC', iRq_added_by='$by', iRq_added_on=NOW(), iRq_added_ip='$ip'";
			
			}else{
			
				$query = "UPDATE eng_inventory_request_receipt SET iRq_branch='".$_REQUEST['branchid']."', iRq_warehouseid='".$_REQUEST['warehouseid']."', iRq_employee='".$empid[0]."',iRq_rqdate='".dateDatabaseFormat($_REQUEST['reqdate'])."',iRq_req_type='".$_REQUEST['req_type']."',iRq_departmentid='".$_REQUEST['departmentid']."',iRq_noofpaking='".$_REQUEST['nopackage']."',iRq_pakingdetails='".$_REQUEST['packingdetails']."',iRq_remarks='".$_REQUEST['remarks']."', iRq_modified_by='$by', iRq_modified_on=NOW(),iRq_modified_ip='$ip' WHERE inventoryRequestId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=1;$k<=$_REQUEST['request_count'];$k++){
				
					$proid = explode(' - ',$_REQUEST['prod_name_'.$k]);
	
					 if(empty($_REQUEST['reqPid_'.$k])){
					
						$query ="INSERT INTO eng_inventory_request_products SET iRp_inventoryRequestId='".$last_id."', iRp_productid='".$proid[0]."',iRp_qty='".$_REQUEST['qty_'.$k]."',iRp_balance='".$_REQUEST['bal_qty_'.$k]."',iRp_stock='".$_REQUEST['stock_'.$k]."'";
					 
					 }else{
					  
					  $query ="UPDATE eng_inventory_request_products SET iRp_productid='".$proid[0]."',iRp_qty='".$_REQUEST['qty_'.$k]."', iRp_balance='".$_REQUEST['bal_qty_'.$k]."',iRp_stock='".$_REQUEST['stock_'.$k]."' WHERE iRp_inventoryRequestId='".$last_id."' AND invReqProdId='".$_REQUEST['reqPid_'.$k]."'";
	
					 }					  				
						$qry = mysql_query($query);
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
				}
				
			}
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				if(empty($_REQUEST['id'])){
					pageRedirection("eng-inventory-req-rec/index.php?page=add&msg=1");	
				}else{
					pageRedirection("eng-inventory-req-rec/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
			
			
			
		
		}elseif(!empty($_REQUEST['request_receipt']) && $_REQUEST['request_receipt']==2){
			
		
			$empid = explode(' - ',$_REQUEST['employee_rcpt']);
			
			if(empty($_REQUEST['id'])){
				  
				$query = "INSERT INTO eng_inventory_request_receipt SET iRq_type='".$_REQUEST['request_receipt']."',iRq_receiptReferenceId ='".$_REQUEST['request_id']."', iRq_branch='".$_REQUEST['branchid_rcpt']."', iRq_warehouseid='".$_REQUEST['warehouse_rcpt']."', iRq_employee='".$empid[0]."',iRq_rqdate='".dateDatabaseFormat($_REQUEST['date_rcpt'])."',iRq_req_type='".$_REQUEST['req_type']."',iRq_departmentid='".$_REQUEST['departmentid']."',iRq_noofpaking='".$_REQUEST['nopackage_rcpt']."',iRq_pakingdetails='".$_REQUEST['packdetails_rcpt']."',iRq_remarks='".$_REQUEST['remark_rcpt']."',iRq_company_id='$bC', iRq_added_by='$by', iRq_added_on=NOW(), iRq_added_ip='$ip'";
			
			}else{
			
				$query = "UPDATE eng_inventory_request_receipt SET iRq_branch='".$_REQUEST['branchid_rcpt']."', iRq_warehouseid='".$_REQUEST['warehouse_rcpt']."', iRq_employee='".$empid[0]."',iRq_rqdate='".dateDatabaseFormat($_REQUEST['date_rcpt'])."',iRq_req_type='".$_REQUEST['req_type']."',iRq_departmentid='".$_REQUEST['departmentid']."',iRq_noofpaking='".$_REQUEST['nopackage_rcpt']."',iRq_pakingdetails='".$_REQUEST['packdetails_rcpt']."',iRq_remarks='".$_REQUEST['remark_rcpt']."', iRq_modified_by='$by', iRq_modified_on=NOW(),iRq_modified_ip='$ip' WHERE inventoryRequestId='".$_REQUEST['id']."' and iRq_receiptReferenceId ='".$_REQUEST['request_id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=0;$k<$_REQUEST['receipt_count'];$k++){
				
					$proid = explode(' - ',$_REQUEST['prod_name_rcpt_'.$k]);
	
					 if(empty($_REQUEST['idd_'.$k])){
					
						$query ="INSERT INTO eng_inventory_request_products SET iRp_inventoryRequestId='".$last_id."', iRp_productid='".$_REQUEST['productid_rcpt_'.$k]."',iRp_qty='".$_REQUEST['qty_rcpt_'.$k]."',iRp_balance='".$_REQUEST['bal_qty_rcpt_'.$k]."',iRp_stock='".$_REQUEST['stock_rcpt_'.$k]."'";
					 
					 }else{
					  
					  $query ="UPDATE eng_inventory_request_products SET iRp_productid='".$proid[0]."',iRp_qty='".$_REQUEST['qty_rcpt_'.$k]."', iRp_balance='".$_REQUEST['bal_qty_rcpt_'.$k]."',iRp_stock='".$_REQUEST['stock_rcpt_'.$k]."' WHERE iRp_inventoryRequestId='".$last_id."' AND invReqProdId='".$_REQUEST['idd_'.$k]."'";
	
					 }					  				
						$qry = mysql_query($query);
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
				}
				
			}
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				if(empty($_REQUEST['id'])){
					pageRedirection("eng-inventory-req-rec/index.php?page=add&msg=1");	
				}else{
					pageRedirection("eng-inventory-req-rec/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
		
		
		
		
		
		
		
		}
	}
	function listreqRec(){
		
		$query  = "SELECT inventoryRequestId,iRq_type,employee_name,branch_name,department_name,DATE_FORMAT(iRq_rqdate ,'%d-%m-%Y') AS iRq_rqdate
				    FROM eng_inventory_request_receipt
					LEFT JOIN hr_employees ON iRq_employee=employee_id
					LEFT JOIN branches ON iRq_branch = branch_id
					LEFT JOIN departments ON iRq_departmentid=department_id
					ORDER BY inventoryRequestId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editRequest($id){
		$query  = "SELECT *,DATE_FORMAT(iRq_rqdate ,'%d/%m/%Y') AS iRq_rqdate
				    FROM eng_inventory_request_receipt 
					WHERE inventoryRequestId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editRequestproduct($id){
		
		$query = "SELECT A.*,product_name,product_uom_name,product_code,product_cost_price
					FROM eng_inventory_request_products A
		 			JOIN products ON iRp_productid = product_id
					JOIN product_uoms ON product_uom_id = product_uom_one_id
					WHERE iRp_inventoryRequestId='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function editShiftMngmntAtnc($id){
		$query  = "SELECT *,DATE_FORMAT(smA_date ,'%d/%m/%Y') AS smA_date 
				    FROM eng_shift_management_attendance
					WHERE smA_shiftManagementId ='$id'";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
	}


?>
