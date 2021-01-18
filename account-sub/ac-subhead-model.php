<?php 
	function listaccHead(){
		$select_accHead = "SELECT * FROM account_heads WHERE account_head_active_status ='active'  AND account_head_deleted_status =0 ORDER BY account_head_name ASC";
		$result_accHead = mysql_query($select_accHead);
		$arr_branch    = array();
		while($record_accHead = mysql_fetch_array($result_accHead)) {
			$arr_accHead[] = $record_accHead;
		}
		return $arr_accHead;
	}
	function listCurrency(){
		$select_currency = "SELECT * FROM currencies WHERE currency_deleted_status =0 ORDER BY currency_id ASC";
		$result_currency = mysql_query($select_currency);
		$arr_currency    = array();
		
		while($record_currency = mysql_fetch_array($result_currency)) {
			$arr_currency[] = $record_currency;
		}
		return $arr_currency;
	}

	function acaSubheadinsertupdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO account_sub SET account_sub_head_id='".$_REQUEST['account_sub_head_id']."',account_sub_name='".$_REQUEST['account_sub_name']."', account_sub_type_id='".$_REQUEST['account_sub_type_id']."', account_sub_currency_id='".$_REQUEST['account_sub_currency_id']."',account_sub_active_status='".$_REQUEST['account_sub_active_status']."',account_sub_company_id='$bC', account_sub_added_by='$by', account_sub_added_on=NOW(), account_sub_added_ip='$ip' ";
	
		}else{
			
			$query="UPDATE account_sub SET account_sub_head_id='".$_REQUEST['account_sub_head_id']."',account_sub_name='".$_REQUEST['account_sub_name']."', account_sub_type_id='".$_REQUEST['account_sub_type_id']."', account_sub_currency_id='".$_REQUEST['account_sub_currency_id']."',account_sub_active_status='".$_REQUEST['account_sub_active_status']."', account_sub_modified_by='$by', account_sub_modified_on=NOW(), account_sub_modified_ip='$ip' WHERE account_sub_id='".$_REQUEST['id']."' ";
			
		}
		
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			if(empty($_REQUEST['id'])){
				pageRedirection("account-sub/index.php?page=add&msg=1");	
			}else{
				pageRedirection("account-sub/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}
	}
	function listresult(){
		
		$query  = "SELECT account_sub_id,account_sub_name,account_head_name 
				    FROM account_sub
					LEFT JOIN account_heads ON account_sub_head_id = account_head_id
					WHERE account_sub_deleted_status= 0
					ORDER BY account_sub_id DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editResult($id){
		$query  = "SELECT *
				    FROM account_sub 
					WHERE account_sub_id ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function deleteResult(){
		foreach($_REQUEST['deleteCheck'] as $id){
			mysql_query("UPDATE account_sub SET account_sub_deleted_status=1 WHERE account_sub_id ='$id'");
		}
		pageRedirection("account-sub/index.php?&msg=3");
	}

?>