<?php 
	function insertUpdateReceivable(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		$credit = explode('-',$_REQUEST['credit_ac']);
		$debit = explode('-',$_REQUEST['debit_ac']);
		
		$req = explode('-',$_REQUEST['request_by']);
		$apprv = explode('-',$_REQUEST['approval_by']);
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO account_receivable SET acR_branchid='".$_REQUEST['branchid']."',acR_payable_typ='".$_REQUEST['payable_typ']."', acR_payment_mode='".$_REQUEST['payment_mode']."', acR_credit_ac='".$credit[0]."', acR_debit_ac='".$debit[0]."', acR_amount='".$_REQUEST['amount']."',acR_amount_mmk='".$_REQUEST['amount_mmk']."', acR_date='".date('Y-m-d',strtotime($_REQUEST['rec_date']))."',acR_chequeno='".$_REQUEST['acR_chequeno']."',acR_chequedate='".$_REQUEST['acR_chequedate']."',acR_ref_details='".$_REQUEST['ref_details']."',acR_narration='".$_REQUEST['narration']."', acR_request_by='".$req[0]."', acR_approval_by='".$apprv[0]."',acR_company_id='$bC', acR_added_by='$by', acR_added_on=NOW(), acR_added_ip='$ip' ";
	
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		}else{
			
			$query="UPDATE account_receivable SET acR_branchid='".$_REQUEST['branchid']."',acR_payable_typ='".$_REQUEST['payable_typ']."', acR_payment_mode='".$_REQUEST['payment_mode']."', acR_credit_ac='".$credit[0]."', acR_debit_ac='".$debit[0]."', acR_amount='".$_REQUEST['amount']."',acR_amount_mmk='".$_REQUEST['amount_mmk']."',acR_date='".date('Y-m-d',strtotime($_REQUEST['rec_date']))."',acR_chequeno='".$_REQUEST['acR_chequeno']."',acR_chequedate='".$_REQUEST['acR_chequedate']."',acR_ref_details='".$_REQUEST['ref_details']."',acR_narration='".$_REQUEST['narration']."', acR_request_by='".$req[0]."', acR_approval_by='".$apprv[0]."', acR_modified_by='$by', acR_modified_on=NOW(), acR_modified_ip='$ip' WHERE acReceivableId='".$_REQUEST['id']."' ";
		$qry = mysql_query($query);
		$last_id = $_REQUEST['id'];
		}
		
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			
				$entry_no 		= "AR".substr(('000000'.$last_id),-5);
				$entry_date		= date('Y-m-d',strtotime($_REQUEST['rec_date']));
				$acc_cr_id		= $credit[0];
				$acc_dr_id		= $debit[0];
				$acc_amount		= $_REQUEST['amount'];
				$acc_amount_mmk	= $_REQUEST['amount_mmk'];
				$entry_remark	= $_REQUEST['narration'];
				$branch_id		= $_REQUEST['branchid'];
				$acc_amount_deb		= ($amount_debit_frgn!=$acc_amount_mmk)?$amount_debit_frgn:0;
				
				update_transaction($last_id, $entry_no, $entry_date, 'account-receivable', $acc_dr_id, $acc_cr_id, 'D', $acc_amount_deb, $entry_remark, $branch_id,$acc_amount_mmk);
				
				$acc_amount_cre		= ($acc_amount!=$acc_amount_mmk)?$acc_amount:0;
				update_transaction($last_id, $entry_no, $entry_date, 'account-receivable', $acc_cr_id, $acc_dr_id, 'C', $acc_amount_cre, $entry_remark, $branch_id,$acc_amount_mmk);			
			
			if(empty($_REQUEST['id'])){
			
			
				pageRedirection("account-receiveable/index.php?page=add&msg=1");	
			}else{
				pageRedirection("account-receiveable/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}
	}
	function listReceivable(){
		
		$query  = "SELECT acReceivableId,branch_name,DATE_FORMAT(acR_date ,'%d-%m-%Y') AS acR_date 
				    FROM account_receivable
					LEFT JOIN branches ON acR_branchid = branch_id
					WHERE acR_deleted_status=0 
					ORDER BY acReceivableId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editReceivable($id){
		$query  = "SELECT *,DATE_FORMAT(acR_date ,'%d-%m-%Y') AS acR_date,
							cre_acc.account_sub_currency_id as  cre_currency_id,
							deb_acc.account_sub_currency_id as  deb_currency_id
				    FROM account_receivable 
					LEFT JOIN
						account_sub as cre_acc
					ON
						cre_acc.account_sub_id		= acR_credit_ac
					LEFT JOIN
						account_sub as deb_acc
					ON
						deb_acc.account_sub_id		= acR_debit_ac	
					WHERE acReceivableId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function deteteReceivable(){
		foreach($_REQUEST['deleteCheck'] as $id){
			DeleteAccountTrasaction($id,'account-receivable');
			mysql_query("UPDATE account_receivable SET acR_deleted_status=1 WHERE acReceivableId ='$id'");
		}
		pageRedirection("account-receiveable/index.php?&msg=3");
	}
	

?>