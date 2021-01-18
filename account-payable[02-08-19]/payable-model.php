<?php 
	function insertUpdateAdvance(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		$emp = explode('-',$_REQUEST['empid']);
		
		$credit = explode('-',$_REQUEST['credit_ac']);
		$debit = explode('-',$_REQUEST['debit_ac']);
		
		$req = explode('-',$_REQUEST['request_by']);
		$apprv = explode('-',$_REQUEST['approval_by']);
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO account_payable SET aeA_branchid='".$_REQUEST['branchid']."',aeA_payable_typ='".$_REQUEST['payable_typ']."', aeA_payment_mode='".$_REQUEST['payment_mode']."',aeA_employee_id='".$emp[0]."', aeA_credit_ac='".$credit[0]."', aeA_debit_ac='".$debit[0]."', aeA_amount='".$_REQUEST['amount']."',aeA_advance_date='".date('Y-m-d',strtotime($_REQUEST['expense_date']))."',aeA_chequedate='".dateDatabaseFormat($_REQUEST['aeA_chequedate'])."',aeA_chequeno='".$_REQUEST['aeA_chequeno']."',aeA_ref_details='".$_REQUEST['ref_details']."',aeA_narration='".$_REQUEST['narration']."', aeA_amount_mmk='".$_REQUEST['amount_mmk']."',aeA_request_by='".$req[0]."', aeA_approval_by='".$apprv[0]."',aeA_company_id='$bC', aeA_added_by='$by', aeA_added_on=NOW(), aeA_added_ip='$ip' ";
			// echo $query;exit;
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		}else{
			$query="UPDATE account_payable SET aeA_branchid='".$_REQUEST['branchid']."',aeA_payable_typ='".$_REQUEST['payable_typ']."', aeA_payment_mode='".$_REQUEST['payment_mode']."',aeA_employee_id='".$emp[0]."', aeA_credit_ac='".$credit[0]."', aeA_debit_ac='".$debit[0]."', aeA_amount='".$_REQUEST['amount']."',aeA_advance_date='".date('Y-m-d',strtotime($_REQUEST['expense_date']))."',aeA_chequedate='".dateDatabaseFormat($_REQUEST['aeA_chequedate'])."',aeA_chequeno='".$_REQUEST['aeA_chequeno']."',aeA_ref_details='".$_REQUEST['ref_details']."',aeA_narration='".$_REQUEST['narration']."', aeA_request_by='".$req[0]."', aeA_approval_by='".$apprv[0]."', aeA_modified_by='$by', aeA_modified_on=NOW(),aeA_amount_mmk='".$_REQUEST['amount_mmk']."', aeA_modified_ip='$ip' WHERE 	acpayableId='".$_REQUEST['id']."' ";
			
			// echo $query;exit;
		$qry = mysql_query($query);
		$last_id = $_REQUEST['id'];
			
		}
		
		
			if(!empty($qry)){
				mysql_query("COMMIT");
				
				$amount_debit_frgn = $_REQUEST['amount_debit_frgn'];
				$entry_no 		= "AP".substr(('00000'.$last_id),-5); 
				$entry_date		= date('Y-m-d',strtotime($_REQUEST['expense_date']));
				$acc_cr_id		= $credit[0];
				$acc_dr_id		= $debit[0];
				$acc_amount		= $_REQUEST['amount'];
				$acc_amount_mmk	= $_REQUEST['amount_mmk'];
				$entry_remark	= $_REQUEST['narration'];
				$branch_id		= $_REQUEST['branchid'];
				$acc_amount_deb		= ($amount_debit_frgn!=$acc_amount_mmk)?$amount_debit_frgn:0;
				/*update_transaction($last_id, $entry_no, $entry_date, 'account-payable', $acc_dr_id, $acc_cr_id, 'D', $acc_amount_deb, $entry_remark, $branch_id,$acc_amount_mmk);	
				$acc_amount_cre		= ($acc_amount!=$acc_amount_mmk)?$acc_amount:0;
				update_transaction($last_id, $entry_no, $entry_date, 'account-payable', $acc_cr_id, $acc_dr_id, 'C', $acc_amount_cre, $entry_remark, $branch_id,$acc_amount_mmk);			
				*/
				update_transaction($last_id, $entry_no, $entry_date, 'account-payable', $acc_cr_id, $acc_dr_id, 'D', $acc_amount_mmk, $entry_remark, $branch_id, $acc_amount_deb);	
				$acc_amount_cre		= ($acc_amount!=$acc_amount_mmk)?$acc_amount:0;
				update_transaction($last_id, $entry_no, $entry_date, 'account-payable', $acc_dr_id, $acc_cr_id, 'C', $acc_amount_mmk, $entry_remark, $branch_id, $acc_amount_cre);			
				
				
			if(empty($_REQUEST['id'])){
				pageRedirection("account-payable/index.php?page=add&msg=1");	
			}else{
				pageRedirection("account-payable/index.php?&msg=2");	
			}	
			
		}else{
			mysql_query("ROLLBACK");
		}
	}
	function listAdvance(){
	    $where='';
	    if(!empty($_REQUEST['branchid']))
	    {
	        $where.="AND aeA_branchid ='".$_REQUEST['branchid']."'";
	    }
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND aeA_advance_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		
		$query  = "SELECT acpayableId,branch_name,DATE_FORMAT(aeA_advance_date ,'%d/%m/%Y') AS aeA_advance_date 
				    FROM account_payable
					LEFT JOIN branches ON aeA_branchid = branch_id 
					WHERE aeA_deleted_status=0 $where
					ORDER BY acpayableId DESC";
				   // echo $query;exit;
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editAdvance($id){
		$query  = "SELECT *,DATE_FORMAT(aeA_advance_date ,'%d-%m-%Y') AS aeA_advance_date,
							cre_acc.account_sub_currency_id as  cre_currency_id,
							deb_acc.account_sub_currency_id as  deb_currency_id
				    FROM account_payable 
					LEFT JOIN
						account_sub as cre_acc
					ON
						cre_acc.account_sub_id		= aeA_credit_ac
					LEFT JOIN
						account_sub as deb_acc
					ON
						deb_acc.account_sub_id		= aeA_debit_ac	
					WHERE acpayableId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function deteteAdvance(){
		foreach($_REQUEST['deleteCheck'] as $id){
		
			DeleteAccountTrasaction($id,'account-payable');
			mysql_query("UPDATE account_payable SET aeA_deleted_status=1 WHERE acpayableId ='$id'");
		}
		pageRedirection("account-payable/index.php?&msg=3");
	}
	

?>