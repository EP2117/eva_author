<?php 
	function insertUpdateJournal(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		$credit = explode('-',$_REQUEST['credit_ac']);
		$debit = explode('-',$_REQUEST['debit_ac']);
		
		$req = explode('-',$_REQUEST['request_by']);
		$apprv = explode('-',$_REQUEST['approval_by']);
		
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO account_journal SET acJ_branchid='".$_REQUEST['branchid']."', acJ_credit_ac='".$credit[0]."', acJ_debit_ac='".$debit[0]."', acJ_amount='".$_REQUEST['amount']."', acJ_amount_mmk='".$_REQUEST['amount_mmk']."',acJ_date='".date('Y-m-d',strtotime($_REQUEST['journal_date']))."',acJ_narration='".$_REQUEST['narration']."', acJ_request_by='".$req[0]."', acJ_approval_by='".$apprv[0]."',acJ_company_id='$bC', acJ_added_by='$by', acJ_added_on=NOW(), acJ_added_ip='$ip' ";
		//	 echo $query;exit;
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
	
		}else{
			
			$query="UPDATE account_journal SET acJ_branchid='".$_REQUEST['branchid']."', acJ_credit_ac='".$credit[0]."', acJ_debit_ac='".$debit[0]."', acJ_amount='".$_REQUEST['amount']."', acJ_amount_mmk='".$_REQUEST['amount_mmk']."',acJ_date='".date('Y-m-d',strtotime($_REQUEST['journal_date']))."',acJ_narration='".$_REQUEST['narration']."', acJ_request_by='".$req[0]."', acJ_approval_by='".$apprv[0]."', acJ_modified_by='$by', acJ_modified_on=NOW(), acJ_modified_ip='$ip' WHERE acJournalId='".$_REQUEST['id']."' ";
			//echo $query;exit;
		$qry = mysql_query($query);
		$last_id = $_REQUEST['id'];
		}
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			
				$entry_no 		= "AJ".substr(('000000'.$last_id),-5);
				$entry_date		= date('Y-m-d',strtotime($_REQUEST['journal_date']));
				$acc_cr_id		= $credit[0];
				$acc_dr_id		= $debit[0];
				$acc_amount		= $_REQUEST['amount'];
				$acc_amount_mmk	= $_REQUEST['amount_mmk'];
				$entry_remark	= $_REQUEST['narration'];
				$branch_id		= $_REQUEST['branchid'];
				update_transaction($last_id, $entry_no, $entry_date, 'account-journal', $acc_dr_id, $acc_cr_id, 'D', $acc_amount, $entry_remark, $branch_id,$acc_amount_mmk);	
				update_transaction($last_id, $entry_no, $entry_date, 'account-journal', $acc_cr_id, $acc_dr_id, 'C', $acc_amount, $entry_remark, $branch_id,$acc_amount_mmk);		
					
			if(empty($_REQUEST['id'])){
				pageRedirection("journal/index.php?page=add&msg=1");	
			}else{
				pageRedirection("journal/index.php?&msg=2");	
			}
				
		}else{
			mysql_query("ROLLBACK");
		}
	}
	function listJournal(){
	    $where='';
	    if(!empty($_REQUEST['branchid']))
	    {
	        $where.="AND acJ_branchid ='".$_REQUEST['branchid']."'";
	    }
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND acJ_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		
		$query  = "SELECT acJournalId,branch_name,DATE_FORMAT(acJ_date ,'%d/%m/%Y') AS acJ_date 
				    FROM account_journal
					LEFT JOIN branches ON acJ_branchid = branch_id $where
					ORDER BY acJournalId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editJournal($id){
		$query  = "SELECT *,DATE_FORMAT(acJ_date ,'%d-%m-%Y') AS acJ_date
				    FROM  account_journal 
					WHERE acJournalId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function deteteJournal(){
		foreach($_REQUEST['deleteCheck'] as $id){
			mysql_query("UPDATE  account_journal SET acJ_deleted_status=1 WHERE acJournalId ='$id'");
		}
		pageRedirection("expense-payable/index.php?&msg=3");
	}
	

?>