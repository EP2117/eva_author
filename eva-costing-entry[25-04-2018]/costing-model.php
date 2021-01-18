<?php 

	
	function invoiceList(){
		
		 $query  = "SELECT 
		 				invoiceId,
						invoiceNo,
						supplier_name,
						pI_invoice_date 
				    FROM 
						purchase_invoice
					LEFT JOIN	
						purchase_order 
					ON 
						purchaseId	= pI_purchaseId 
					LEFT JOIN 
						suppliers 
					ON 
						supplier_id = pR_supplier_id
					WHERE 
						pR_deleted_status = 0 			
					ORDER BY purchaseId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}




	function costingInsertUpdate(){
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
			if(empty($_REQUEST['id'])){
				  
				  $query = "INSERT INTO costing_entry SET cs_invoiceId='".$_REQUEST['invoiceId']."', cs_branchid='".$_REQUEST['branchid']."', cs_port_location='".$_REQUEST['port_location']."', cs_port_name='".$_REQUEST['port_name']."',cs_costingdate='".NdateDatabaseFormat($_REQUEST['costingdate'])."',cs_total_rate='".$_REQUEST['total_rate']."',cs_total_frgnrate='".$_REQUEST['total_frgnrate']."',cs_added_by='$bC', cs_added_on=NOW(), cs_added_ip='$ip'";
			
			
			}else{
			
				$query = "UPDATE costing_entry SET cs_invoiceId='".$_REQUEST['invoiceId']."', cs_branchid='".$_REQUEST['branchid']."', cs_port_location='".$_REQUEST['port_location']."', cs_port_name='".$_REQUEST['port_name']."',cs_costingdate='".NdateDatabaseFormat($_REQUEST['costingdate'])."',cs_total_rate='".$_REQUEST['total_rate']."',cs_total_frgnrate='".$_REQUEST['total_frgnrate']."',cs_modified_by='$by', cs_modified_on=NOW(),cs_modified_ip='$ip' WHERE costingId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
			/*echo '<pre>';
				print_r($_REQUEST);exit;*/
				for($k=0;$k<=count($_REQUEST['payment_count']);$k++){//echo $_REQUEST['costingname_'.$k];exit;
					
					 if(empty($_REQUEST['cid'][$k])){
					if((!empty($_REQUEST['costingname'][$k]))){
						  $query ="INSERT INTO costing_entry_details SET c_costingId='".$last_id."',c_currencyId='".$_REQUEST['currencyid'][$k]."',c_rate='".$_REQUEST['rate'][$k]."',c_frgnrate='".$_REQUEST['frgnrate'][$k]."',c_amount_cur='".$_REQUEST['amount_cur'][$k]."', c_amount='".$_REQUEST['amount'][$k]."',c_remarks='".$_REQUEST['remark'][$k]."',c_costingname='".$_REQUEST['costingname'][$k]."'";
						 $qry = mysql_query($query);
					 }
					 }else{
					  
					  $query ="UPDATE costing_entry_details SET c_cost_id='".$_REQUEST['costingId'][$k]."',c_currencyId='".$_REQUEST['currencyid'][$k]."',c_rate='".$_REQUEST['rate'][$k]."',c_frgnrate='".$_REQUEST['frgnrate'][$k]."',c_amount_cur='".$_REQUEST['amount_cur'][$k]."',c_amount='".$_REQUEST['amount'][$k]."',c_remarks='".$_REQUEST['remark'][$k]."',c_costingname='".$_REQUEST['costingname'][$k]."' WHERE c_costingId='".$last_id."' AND costId='".$_REQUEST['cid'][$k]."'";
	$qry = mysql_query($query);
					 }
										  				
						
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
				}
				
			}
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				if(empty($_REQUEST['id'])){
					pageRedirection("eva-costing-entry/index.php?page=add&msg=1");	
				}else{
					pageRedirection("eva-costing-entry/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
			
	}
	function listCosting(){
		
		$query  = "SELECT costingId,branch_name,cs_port_location,cs_port_name,DATE_FORMAT(cs_costingdate ,'%d/%m/%Y') AS cs_costingdate
				    FROM costing_entry
					LEFT JOIN branches ON cs_branchid = branch_id
					WHERE cs_deleted_status =0	
					ORDER BY costingId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editCosting($id){
		$query  = "SELECT *,DATE_FORMAT(cs_costingdate ,'%d/%m/%Y') AS cs_costingdate
				    FROM costing_entry 
					WHERE costingId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editRequestproduct($id){
		
		 $query = "SELECT *
					FROM costing_entry_details 
					WHERE c_costingId='$id'";//exit;
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	function costingdelete(){
	
	
	if(isset($_REQUEST['deleteCheck']))
		{//echo 'sdf54';exit;
			
				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck = $checked[$i]; 
					$ip 	= getRealIpAddr();
					
					
					     $update_addend 	= "UPDATE  costing_entry
									SET 
										cs_deleted_status    = '1',
										cs_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
		                                cs_deleted_on        = UNIX_TIMESTAMP(NOW()),
		                                cs_deleted_ip	        = '".$ip."'
								WHERE               
										costingId             	= '".$deleteCheck."' ";
										//print_r($update_overtime);//exit;
				mysql_query($update_addend);
				
				
					
				}	
				header("Location:index.php");
		}else{header("Location:index.php");}
		
	
	
	}

?>
