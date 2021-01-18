<?php 
	function insertUpdateadvance(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){
		 
			 $query="INSERT INTO emp_advance SET ad_branchid='".$_REQUEST['ad_branchid']."',ad_employee_id='".$_REQUEST['ad_empid']."', ad_date='".NdateDatabaseFormat($_REQUEST['ad_date'])."', ad_amount='".$_REQUEST['ad_amount']."', ad_requestby='".$_REQUEST['ad_requestby']."', ad_approvalby='".$_REQUEST['ad_approvalby']."', ad_remarks='".$_REQUEST['ad_remarks']."',ad_company_id='$bC', ad_added_by='$by', ad_added_on=NOW(), ad_added_ip='$ip' ";
		
		}else{
			
			 $query="UPDATE emp_advance SET ad_branchid='".$_REQUEST['ad_branchid']."',ad_employee_id='".$_REQUEST['ad_empid']."', ad_date='".NdateDatabaseFormat($_REQUEST['ad_date'])."', ad_amount='".$_REQUEST['ad_amount']."', ad_requestby='".$_REQUEST['ad_requestby']."', ad_approvalby='".$_REQUEST['ad_approvalby']."', ad_remarks='".$_REQUEST['ad_remarks']."', ad_modified_by='$by', ad_modified_on=NOW(), ad_modified_ip='$ip' WHERE empAdvanceId='".$_REQUEST['id']."' ";
			
		}
		
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			if(empty($_REQUEST['id'])){
				pageRedirection("advance/index.php?page=add&msg=1");	
			}else{
				pageRedirection("advance/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}
		
	}
	function listadvance(){
		
		$query  = "SELECT empAdvanceId,ad_amount,employee_name,branch_name, DATE_FORMAT(ad_date ,'%d/%m/%Y') AS ad_date
				    FROM emp_advance
					LEFT JOIN employees ON ad_employee_id = employee_id
					LEFT JOIN branches ON ad_branchid = branch_id 
					WHERE ad_deleted_status=0
					ORDER BY empAdvanceId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editAdvance($id){
		
		$query  = "SELECT A.*,employee_name,DATE_FORMAT(ad_date,'%d/%m/%Y') AS ad_date
				    FROM emp_advance AS A
					LEFT JOIN employees ON ad_employee_id = employee_id
					WHERE empAdvanceId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function advancedelete(){
	
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		  $delete_budget_entry ="UPDATE  emp_advance SET ad_deleted_status = 1 ,
		 												ad_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														ad_deleted_on	 = UNIX_TIMESTAMP(NOW()),
														ad_deleted_ip = '".$ip."'
						WHERE empAdvanceId = '".$_REQUEST['select_all'][$i]."' ";//exit;
		
		mysql_query($delete_budget_entry);
			header("Location:index.php");
		
		
		}
	
	}
	
	
	}


?>