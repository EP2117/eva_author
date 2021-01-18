<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'employeeList':employees_datails();
				break;
		}
		
	}
	
	function employees_datails(){
			$val    = $_REQUEST['val'];
			
			$query  = "SELECT employee_id, employee_name 
						FROM employees
						WHERE employee_deleted_status='0' and employee_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$array_result = array();
			
			while($result_ary = mysql_fetch_array($result)){				
				array_push($array_result,$result_ary);
			}
		
			echo json_encode($array_result);
	}
	
?>