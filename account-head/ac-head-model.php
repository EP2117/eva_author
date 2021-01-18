<?php 

	function acheadinsertupdate(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO account_heads SET account_head_name='".$_REQUEST['account_head_name']."',account_head_type1='".$_REQUEST['account_head_type1']."', account_head_type2='".$_REQUEST['account_head_type2']."', account_head_type3='".$_REQUEST['account_head_type3']."',account_head_active_status='".$_REQUEST['account_head_active_status']."',	account_head_company_id='$bC', account_head_added_by='$by', account_head_added_on=NOW(), account_head_added_ip='$ip' ";
	
		}else{
			
			$query="UPDATE account_heads SET account_head_name='".$_REQUEST['account_head_name']."',account_head_type1='".$_REQUEST['account_head_type1']."', account_head_type2='".$_REQUEST['account_head_type2']."',account_head_type3='".$_REQUEST['account_head_type3']."', account_head_active_status='".$_REQUEST['account_head_active_status']."', account_head_modified_by='$by', account_head_modified_on=NOW(), account_head_modified_ip='$ip' WHERE account_head_id='".$_REQUEST['id']."' ";
			
		}
		
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			if(empty($_REQUEST['id'])){
				pageRedirection("account-head/index.php?page=add&msg=1");	
			}else{
				pageRedirection("account-head/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}
	}
	function listresult(){
		
		$query  = "SELECT account_head_id,account_head_name,account_head_type1 
				    FROM account_heads WHERE account_head_deleted_status= 0
					ORDER BY account_head_id DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editResult($id){
		$query  = "SELECT *
				    FROM account_heads 
					WHERE account_head_id ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function deleteResult(){
		foreach($_REQUEST['deleteCheck'] as $id){
			mysql_query("UPDATE account_heads SET account_head_deleted_status=1 WHERE account_head_id ='$id'");
		}
		pageRedirection("account-head/index.php?&msg=3");
	}

?>