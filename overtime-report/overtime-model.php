<?php 
	function listOvertime(){
	
	$where = '';
	
	if(!empty($_REQUEST['ot_branchid'])){
			$where	.=" AND ot_branchid = '".$_REQUEST['ot_branchid']."'";
		}
		
		if((isset($_REQUEST['ot_fromdate'])) && !empty($_REQUEST['ot_fromdate']) && isset($_REQUEST['ot_todate'])&& !empty($_REQUEST['ot_todate']))
		{
		$where.="AND ot_date BETWEEN '".NdateDatabaseFormat($_REQUEST['ot_fromdate'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['ot_todate'])."' ";
		}
		
		$query  = "SELECT empOtId,ot_starttime,ot_endtime, employee_name,branch_name, DATE_FORMAT(ot_date ,'%d/%m/%Y') AS ot_date,ot_type_id,
							ot_amount,ot_rate,TIMEDIFF(ot_endtime,ot_starttime) AS diftime
				    FROM emp_overtime
					LEFT JOIN employees ON ot_employee_id = employee_id
					LEFT JOIN branches ON ot_branchid = branch_id 
					WHERE ot_deleted_status=0 $where
					ORDER BY empOtId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	
?>