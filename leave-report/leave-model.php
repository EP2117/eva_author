<?php 
	
	function listLeave(){
	
	$where = '';
	
	if(!empty($_REQUEST['lv_branchid'])){
			$where	.=" AND lv_branchid = '".$_REQUEST['lv_branchid']."'";
		}
		
		if((isset($_REQUEST['lv_fromdate'])) && !empty($_REQUEST['lv_fromdate']) && isset($_REQUEST['lv_todate'])&& !empty($_REQUEST['lv_todate']))
		{
		$where.="AND lv_todate BETWEEN '".NdateDatabaseFormat($_REQUEST['lv_fromdate'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['lv_todate'])."' ";
		}
		
		$query  = "SELECT empLeaveId,DATE_FORMAT(lv_fromdate ,'%d/%m/%Y') AS lv_fromdate ,DATE_FORMAT(lv_todate ,'%d/%m/%Y') AS lv_todate,DATE_FORMAT(lv_date ,'%d/%m/%Y') AS lv_date, employee_name ,branch_name ,lv_paymentid,lv_leave,lv_leavetype,lv_leave_salary_type,lv_leaveno
				    FROM emp_leave
					LEFT JOIN employees ON lv_employee_id = employee_id
					LEFT JOIN branches ON lv_branchid = branch_id 
					WHERE lv_deleted_status =0 $where
					ORDER BY empLeaveId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	

?>