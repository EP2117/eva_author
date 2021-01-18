<?php 
	function insertUpdateLeave(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO emp_leave SET lv_branchid='".$_REQUEST['lv_branchid']."',lv_employee_id='".$_REQUEST['lv_empid']."', lv_leave='".$_REQUEST['lv_leave']."', lv_leavetype='".$_REQUEST['lv_leavetype']."', lv_fromdate='".NdateDatabaseFormat($_REQUEST['lv_fromdate'])."', lv_todate='".NdateDatabaseFormat($_REQUEST['lv_todate'])."',lv_leaveno='".$_REQUEST['lv_leaveno']."',lv_requestbyid='".$_REQUEST['lv_requestbyid']."',lv_approvalid='".$_REQUEST['lv_approvalid']."', lv_remarks='".$_REQUEST['lv_remarks']."',lv_paymentid='".$_REQUEST['lv_paymentid']."', lv_date='".NdateDatabaseFormat($_REQUEST['lv_date'])."',lv_company_id='$bC', lv_added_by='$by', lv_added_on=NOW(), lv_added_ip='$ip',lv_leave_salary_type ='".implode(",",$_POST['lv_leave_salary_type'])."' ";
			// echo  $query;exit;
	
		}else{
			
			 $query="UPDATE emp_leave SET lv_branchid='".$_REQUEST['lv_branchid']."',lv_employee_id='".$_REQUEST['lv_empid']."', lv_leave='".$_REQUEST['lv_leave']."', lv_leavetype='".$_REQUEST['lv_leavetype']."', lv_fromdate='".NdateDatabaseFormat($_REQUEST['lv_fromdate'])."', lv_todate='".NdateDatabaseFormat($_REQUEST['lv_todate'])."',lv_leaveno='".$_REQUEST['lv_leaveno']."',lv_requestbyid='".$_REQUEST['lv_requestbyid']."',lv_approvalid='".$_REQUEST['lv_approvalid']."', lv_remarks='".$_REQUEST['lv_remarks']."',lv_paymentid='".$_REQUEST['lv_paymentid']."', lv_date='".NdateDatabaseFormat($_REQUEST['lv_date'])."', lv_modified_by='$by', lv_modified_on=NOW(), lv_modified_ip='$ip' WHERE empLeaveId='".$_REQUEST['id']."',lv_leave_salary_type ='".$_POST['lv_leave_salary_type']."' ";//exit;
			
		}
		
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			if(empty($_REQUEST['id'])){
				pageRedirection("leave/index.php?page=add&msg=1");	
			}else{
				pageRedirection("leave/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
		}
	}
	function listLeave(){
		
		$query  = "SELECT empLeaveId,DATE_FORMAT(lv_fromdate ,'%d/%m/%Y') AS lv_fromdate ,DATE_FORMAT(lv_todate ,'%d/%m/%Y') AS lv_todate,DATE_FORMAT(lv_date ,'%d/%m/%Y') AS lv_date, employee_name ,branch_name ,lv_paymentid
				    FROM emp_leave
					LEFT JOIN employees ON lv_employee_id = employee_id
					LEFT JOIN branches ON lv_branchid = branch_id 
					WHERE lv_deleted_status =0
					ORDER BY empLeaveId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editLeave($id){
		$query  = "SELECT A.*,employee_name,DATE_FORMAT(lv_fromdate ,'%d/%m/%Y') AS lv_fromdate ,DATE_FORMAT(lv_todate ,'%d/%m/%Y') AS lv_todate,DATE_FORMAT(lv_date ,'%d/%m/%Y') AS lv_date, datediff(lv_todate,lv_fromdate) as days
				    FROM emp_leave AS A
					LEFT JOIN employees ON lv_employee_id = employee_id
					WHERE empLeaveId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
function leave_delete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		  $delete_budget_entry ="UPDATE  emp_leave SET lv_deleted_status = 1 ,
		 												lv_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														lv_deleted_on	 = UNIX_TIMESTAMP(NOW()),
														lv_deleted_ip = '".$ip."'
						WHERE empLeaveId = '".$_REQUEST['select_all'][$i]."' ";//exit;
		
		mysql_query($delete_budget_entry);
			header("Location:index.php");
		
		
		}
	
	}
	
	}

?>