<?php 
	function insertUpdateOvertime(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO emp_overtime SET ot_branchid='".$_REQUEST['ot_branchid']."',ot_employee_id='".$_REQUEST['ot_empid']."', ot_starttime='".$_REQUEST['ot_starttime']."', ot_endtime='".$_REQUEST['ot_endtime']."',ot_date='".NdateDatabaseFormat($_REQUEST['ot_date'])."', ot_amount='".$_REQUEST['ot_amount']."', ot_aprovalamnt='".$_REQUEST['ot_aprovalamnt']."', ot_requestby='".$_REQUEST['ot_requestby']."',ot_approvalby='".$_REQUEST['ot_approvalby']."',  ot_remarks='".$_REQUEST['ot_remarks']."',ot_company_id='$bC', ot_added_by='$by', ot_added_on=NOW(), ot_added_ip='$ip', ot_type_id='".$_REQUEST['ot_type_id']."', ot_rate='".$_REQUEST['ot_rate']."' ";
			
		}else{
			
			$query="UPDATE emp_overtime SET ot_branchid='".$_REQUEST['ot_branchid']."',ot_employee_id='".$_REQUEST['ot_empid']."', ot_starttime='".$_REQUEST['ot_starttime']."', ot_endtime='".$_REQUEST['ot_endtime']."',ot_date='".NdateDatabaseFormat($_REQUEST['ot_date'])."', ot_amount='".$_REQUEST['ot_amount']."', ot_aprovalamnt='".$_REQUEST['ot_aprovalamnt']."', ot_requestby='".$_REQUEST['ot_requestby']."',ot_approvalby='".$_REQUEST['ot_approvalby']."',  ot_remarks='".$_REQUEST['ot_remarks']."', ot_modified_by='$by', ot_modified_on=NOW(), ot_modified_ip='$ip', ot_type_id='".$_REQUEST['ot_type_id']."', ot_rate='".$_REQUEST['ot_rate']."' WHERE empOtId='".$_REQUEST['id']."' ";
			
		}
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			if(empty($_REQUEST['id'])){
				pageRedirection("overtime/index.php?page=add&msg=1");	
			}else{
				pageRedirection("overtime/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}
		
	}
	function listOvertime(){
		
		$query  = "SELECT empOtId,ot_starttime,ot_endtime, employee_name,branch_name, DATE_FORMAT(ot_date ,'%d/%m/%Y') AS ot_date
				    FROM emp_overtime
					LEFT JOIN employees ON ot_employee_id = employee_id
					LEFT JOIN branches ON ot_branchid = branch_id 
					WHERE ot_deleted_status=0
					ORDER BY empOtId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editOvertime($id){
		 $query  = "SELECT A.*,employee_name,DATE_FORMAT(ot_date ,'%d/%m/%Y') AS ot_date,TIMEDIFF(ot_endtime,ot_starttime) AS diftime
				    FROM emp_overtime AS A
					LEFT JOIN employees ON ot_employee_id = employee_id
					WHERE empOtId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}

	function overtimedelete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		  $delete_budget_entry ="UPDATE  emp_overtime SET ot_deleted_status = 1 ,
		 												ot_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														ot_deleted_on	 = UNIX_TIMESTAMP(NOW()),
														ot_deleted_ip = '".$ip."'
						WHERE empOtId = '".$_REQUEST['select_all'][$i]."' ";//exit;
		
		mysql_query($delete_budget_entry);
			header("Location:index.php");
		
		
		}
	
	}
	
	}

?>