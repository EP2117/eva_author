<?php 
	function insertUpdateAttendance(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO emp_attendance SET atnc_branchid='".$_REQUEST['atnc_branchid']."',atnc_employee_id='".$_REQUEST['atnc_empid']."', atnc_intime='".$_REQUEST['atnc_intime']."', atnc_outtime='".$_REQUEST['atnc_outtime']."', atnc_date='".NdateDatabaseFormat($_REQUEST['atnc_date'])."',  atnc_remark='".$_REQUEST['atnc_remark']."', atnc_company_id='$bC', atnc_added_by='$by', atnc_added_on=NOW(), atnc_added_ip='$ip' ";
		}else{
			
			
			$query="UPDATE emp_attendance SET atnc_branchid='".$_REQUEST['atnc_branchid']."',atnc_employee_id='".$_REQUEST['atnc_empid']."', atnc_intime='".$_REQUEST['atnc_intime']."', atnc_outtime='".$_REQUEST['atnc_outtime']."', atnc_date='".NdateDatabaseFormat($_REQUEST['atnc_date'])."',  atnc_remark='".$_REQUEST['atnc_remark']."', atnc_modified_by='$by', atnc_modified_on=NOW(), atnc_modified_ip='$ip' WHERE empAtncId='".$_REQUEST['id']."' ";
			
		}
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			if(empty($_REQUEST['id'])){
				pageRedirection("attendance/index.php?page=add&msg=1");	
			}else{
				pageRedirection("attendance/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}

	}
	function listAttendance(){
		
		$query  = "SELECT empAtncId,atnc_intime,atnc_outtime, employee_name,branch_name,DATE_FORMAT(atnc_date ,'%d/%m/%Y') AS d_ate
				    FROM emp_attendance
					LEFT JOIN employees ON atnc_employee_id = employee_id
					LEFT JOIN branches ON atnc_branchid = branch_id 
					WHERE atnc_deleted_status=0
					ORDER BY empAtncId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editAttendance($id){
		$query  = "SELECT A.*,employee_name,DATE_FORMAT(atnc_date ,'%d/%m/%Y') AS atnc_date
				    FROM emp_attendance AS A
					LEFT JOIN employees ON atnc_employee_id = employee_id
					WHERE empAtncId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
function attdelete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		  $delete_budget_entry ="UPDATE  emp_attendance SET atnc_deleted_status = 1 ,
		 												atnc_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														atnc_deleted_on	 = UNIX_TIMESTAMP(NOW()),
														atnc_deleted_ip = '".$ip."'
						WHERE empAtncId = '".$_REQUEST['select_all'][$i]."' ";//exit;
		
		mysql_query($delete_budget_entry);
			header("Location:index.php");
		
		
		}
	
	}
	
	}

?>