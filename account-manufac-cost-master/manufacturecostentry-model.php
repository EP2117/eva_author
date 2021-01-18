<?php 
	function accountHeadList(){
	
		$query = "SELECT account_head_name,account_head_id
				 FROM account_heads 
				 ORDER BY account_head_name ASC ";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function accountSubHeadList($id){
	
		$query = "SELECT account_sub_name,account_sub_id
					 FROM account_sub 
					  WHERE account_sub_head_id ='".$id."'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	function acgroupInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
			if(empty($_REQUEST['id'])){
				  
				$query = "INSERT INTO account_manufacturing_costmaster SET  acMC_group_name='".$_REQUEST['group_name']."', acMC_date=NOW(),acMC_company_id='$bC', acMC_added_by='$by', acMC_added_on=NOW(), acMC_added_ip='$ip'";
			
						}else{
			
				 $query = "UPDATE account_manufacturing_costmaster SET acMC_group_name='".$_REQUEST['group_name']."', acMC_modified_by='$by', acMC_modified_on=NOW(),acMC_modified_ip='$ip' WHERE acManuCostId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=1;$k<=$_REQUEST['ac_count'];$k++){
				
					 if(empty($_REQUEST['ac_id_'.$k])){
					
						$query ="INSERT INTO account_manufacturing_costmaster_acs SET mcA_acManuCostId='".$last_id."', mcA_account_head_id='".$_REQUEST['account_head_'.$k]."',mcA_account_sub_id='".$_REQUEST['sub_account_'.$k]."',mcA_debit_amount='".$_REQUEST['credit_amnt_'.$k]."',mcA_credit_amount='".$_REQUEST['debit_amnt_'.$k]."'";
					 
					 }else{
					  
					  $query ="UPDATE account_manufacturing_costmaster_acs SET mcA_acManuCostId='".$last_id."', mcA_account_head_id='".$_REQUEST['account_head_'.$k]."',mcA_account_sub_id='".$_REQUEST['sub_account_'.$k]."',mcA_debit_amount='".$_REQUEST['credit_amnt_'.$k]."',mcA_credit_amount='".$_REQUEST['debit_amnt_'.$k]."' WHERE mcA_acManuCostId='".$last_id."' AND idMcAcdetailsId='".$_REQUEST['ac_id_'.$k]."'";
	
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
					pageRedirection("account-manufac-cost-master/index.php?page=add&msg=1");	
				}else{
					pageRedirection("account-manufac-cost-master/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
			
			
			
		
	}
	function listResult(){
		
		$query  = "SELECT acManuCostId,acMC_group_name,DATE_FORMAT(acMC_date ,'%d-%m-%Y') AS acMC_date
				    FROM account_manufacturing_costmaster
					ORDER BY acManuCostId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editGroupResult($id){
		 $query  = "SELECT *,DATE_FORMAT(acMC_date ,'%d-%m-%Y') AS acMC_date
				    FROM account_manufacturing_costmaster 
					WHERE acManuCostId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editValueAcdetails($id){
		
		$query = "SELECT * FROM account_manufacturing_costmaster_acs 
					WHERE mcA_acManuCostId='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	

?>
