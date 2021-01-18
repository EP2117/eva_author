<?php 
	function insertUpdateExpense(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO account_expense_payable SET exP_branchid='".$_REQUEST['branchid']."',exP_payable_typ='".$_REQUEST['payable_typ']."', exP_payment_mode='".$_REQUEST['payment_mode']."', exP_credit_ac='".$_REQUEST['credit_ac']."', exP_debit_ac='".$_REQUEST['debit_ac']."', exP_amount='".$_REQUEST['amount']."',exP_expense_date='".date('Y-m-d',strtotime($_REQUEST['expense_date']))."',exP_ref_details='".$_REQUEST['ref_details']."',exP_narration='".$_REQUEST['narration']."', exP_request_by='".$_REQUEST['request_by']."', exP_approval_by='".$_REQUEST['approval_by']."',exP_company_id='$bC', exP_added_by='$by', exP_added_on=NOW(), exP_added_ip='$ip' ";
	
	
		}else{
			
			$query="UPDATE account_expense_payable SET exP_branchid='".$_REQUEST['branchid']."',exP_payable_typ='".$_REQUEST['payable_typ']."', exP_payment_mode='".$_REQUEST['payment_mode']."', exP_credit_ac='".$_REQUEST['credit_ac']."', exP_debit_ac='".$_REQUEST['debit_ac']."', exP_amount='".$_REQUEST['amount']."',exP_expense_date='".date('Y-m-d',strtotime($_REQUEST['expense_date']))."',exP_ref_details='".$_REQUEST['ref_details']."',exP_narration='".$_REQUEST['narration']."', exP_request_by='".$_REQUEST['request_by']."', exP_approval_by='".$_REQUEST['approval_by']."', exP_modified_by='$by', exP_modified_on=NOW(), exP_modified_ip='$ip' WHERE expensePayId='".$_REQUEST['id']."' ";
			
		}
		
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			if(empty($_REQUEST['id'])){
				pageRedirection("expense-payable/index.php?page=add&msg=1");	
			}else{
				pageRedirection("expense-payable/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}
	}
	function listExpense(){
		
		$query  = "SELECT expensePayId,branch_name,DATE_FORMAT(	exP_expense_date ,'%d-%m-%Y') AS 	exP_expense_date 
				    FROM account_expense_payable
					LEFT JOIN branches ON exP_branchid = branch_id 
					ORDER BY expensePayId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editExpense($id){
		$query  = "SELECT *,DATE_FORMAT(exP_expense_date ,'%d-%m-%Y') AS exP_expense_date
				    FROM account_expense_payable 
					WHERE expensePayId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function deteteExpense(){
		foreach($_REQUEST['deleteCheck'] as $id){
			mysql_query("UPDATE account_expense_payable SET exP_deleted_status=1 WHERE expensePayId ='$id'");
		}
		pageRedirection("expense-payable/index.php?&msg=3");
	}
	

?>