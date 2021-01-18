<?php 
	function getGgroupList(){
	
		$query = "SELECT acManuCostId,acMC_group_name
		 		  FROM account_manufacturing_costmaster  
				  ORDER BY acMC_group_name DESC ";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}

	function accountDetailsList(){
	
		 $query = "SELECT idMcAcdetailsId,account_head_id,account_head_name,account_head_code,account_sub_id,account_sub_name,account_sub_code,IFNULL(manuCostEntryeId,'') as manuCostEntryeId,IFNULL(ce_debit_amnt,'') as ce_debit_amnt,IFNULL(ce_credit_amnt,'') as ce_credit_amnt
		 		  FROM account_manufacturing_costmaster_acs
				  LEFT JOIN account_sub ON mcA_account_sub_id = account_sub_id
				  LEFT JOIN account_heads ON account_head_id = account_sub_head_id
				  LEFT JOIN account_manu_cost_entry ON idMcAcdetailsId = ce_idMcAcdetailsId
				  WHERE mcA_acManuCostId ='".$_REQUEST['manuc_groupid']."'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	
	function accountInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		for($i=0;$i<$_REQUEST['op_blnc'];$i++){
			 if(empty($_REQUEST['id_'.$i])){
	
				  $query="INSERT INTO account_manu_cost_entry SET ce_idMcAcdetailsId='".$_REQUEST['ac_costmaster_ac_id_'.$i]."',ce_account_sub_id='".$_REQUEST['ac_subhead_id_'.$i]."',ce_debit_amnt='".$_REQUEST['debit_amnt_'.$i]."', ce_credit_amnt='".$_REQUEST['credit_amnt_'.$i]."',ce_company_id='$bC',ce_financial_year=NOW() ";
		
			}else{
				
				  $query="UPDATE account_manu_cost_entry SET ce_idMcAcdetailsId='".$_REQUEST['ac_costmaster_ac_id_'.$i]."',ce_account_sub_id='".$_REQUEST['ac_subhead_id_'.$i]."',ce_debit_amnt='".$_REQUEST['debit_amnt_'.$i]."', ce_credit_amnt='".$_REQUEST['credit_amnt_'.$i]."',ce_company_id='$bC',ce_financial_year=NOW() WHERE manuCostEntryeId='".$_REQUEST['id_'.$i]."' ";
				
			}
					$qry = mysql_query($query);
					if(empty($qry)){					
						$rollBack=true;
						break;
					}
		}
		
		if(empty($rollBack)){
			mysql_query("COMMIT");
			if(empty($_REQUEST['id'])){
				pageRedirection("account-manufac-cost-entry/index.php?msg=1");	
			}else{
				pageRedirection("account-manufac-cost-entry/index.php?msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}
		
	}
	
?>
