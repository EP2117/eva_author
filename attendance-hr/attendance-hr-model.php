<?php 
	

	function employeeList(){
		 $query  = "SELECT employee_id, employee_name
				    FROM employees
					WHERE employee_deleted_status=0
					ORDER BY employee_id DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
	}
	
	function get_attendance($empid,$date){
		 $query  = "SELECT empAtncId,atnc_intime,atnc_outtime,hr_status
				    FROM emp_attendance
					WHERE atnc_deleted_status=0 AND atnc_date ='".date('Y-m-d',strtotime($date))."' AND atnc_employee_id ='".$empid."'";
			$result = mysql_query($query);
			 $result = mysql_query($query);	
			 $array_result = mysql_fetch_array($result);		 
			 return $array_result;
	}
	
	function employeeInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");
			
		for($i=0;$i<$_REQUEST['emp_count'];$i++){
		
			 if(!empty($_REQUEST['intime_'.$i]) or !empty($_REQUEST['outtime_'.$i]) ){
			 
				 if(empty($_REQUEST['id_'.$i])){
						$query="INSERT INTO emp_attendance SET atnc_employee_id='".$_REQUEST['employeeid_'.$i]."',atnc_intime='".$_REQUEST['intime_'.$i]."',atnc_outtime='".$_REQUEST['outtime_'.$i]."', hr_status='".$_REQUEST['hr_status_'.$i]."',atnc_date='".date('Y-m-d',strtotime($_REQUEST['at_date']))."',atnc_company_id='$bC',atnc_added_by='$by',atnc_modified_on=NOW(),atnc_added_ip='$ip' ";
			
				}else{
					  $query="UPDATE emp_attendance SET atnc_intime='".$_REQUEST['intime_'.$i]."',atnc_outtime='".$_REQUEST['outtime_'.$i]."', hr_status='".$_REQUEST['hr_status_'.$i]."',atnc_modified_by='$by',atnc_modified_on=NOW(),atnc_modified_ip='$ip' WHERE empAtncId='".$_REQUEST['id_'.$i]."' AND  atnc_employee_id='".$_REQUEST['employeeid_'.$i]."'AND atnc_date='".date('Y-m-d',strtotime($_REQUEST['at_date']))."' ";
					
				}
						$qry = mysql_query($query);
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
			}
		}
		
		if(empty($rollBack)){
			mysql_query("COMMIT");
				pageRedirection("attendance-hr/index.php?msg=2");	
		}else{
			mysql_query("ROLLBACK");
		}
		
	}
	
?>
