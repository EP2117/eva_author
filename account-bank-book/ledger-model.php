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

	function listReport(){
		$id=$_REQUEST['sub_account'];
					
			 $query = "SELECT DATE_FORMAT(aeA_advance_date ,'%d-%m-%Y') aeA_advance_date,aeA_narration,IF(aeA_credit_ac=$id,aeA_amount,0) credit, IF(aeA_debit_ac=$id,aeA_amount,0) debit  FROM account_payable
						LEFT JOIN account_sub ON account_sub_id=$id
						LEFT JOIN account_heads ON account_sub_head_id=account_head_id
						WHERE (aeA_credit_ac = '".$id."' or aeA_debit_ac ='".$id."' ) AND (aeA_advance_date BETWEEN  '".date('Y-m-d',strtotime($_REQUEST['fromdate']))."' AND '".date('Y-m-d',strtotime($_REQUEST['todate']))."')"; 			
						
						
						
			 $result = mysql_query($query);
			 $response =array();
			 while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			 }
			return $response;
	}
	
?>
