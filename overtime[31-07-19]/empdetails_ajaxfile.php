<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'employeeList':employees_datails();
				break;
			case 'overtimeAmnt':overtimeAmnt();
				break;	
		}
		
	}
	
	function employees_datails(){
			$val    = $_REQUEST['val'];
			
			$query  = "SELECT employee_id, employee_name ,employee_overtime_hrs	
						FROM employees
						WHERE employee_deleted_status='0' and employee_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$array_result = array();
			
			while($result_ary = mysql_fetch_array($result)){				
				array_push($array_result,$result_ary);
			}
		
			echo json_encode($array_result);
	}
	function overtimeAmnt(){
		$id    = $_REQUEST['emp_id'];
		$query  = "SELECT employee_overtime_hrs	
						FROM employees
						WHERE employee_id ='$id'";
			$result = mysql_query($query);
			$array_result = mysql_fetch_array($result);
			echo json_encode($array_result);
	}
	
?>