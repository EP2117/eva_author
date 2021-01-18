<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'employeeList':employees();
				break;
			case 'accountList':accountList();
				break;
		}
		
	}
	function employees(){
	
		$val   = $_REQUEST['val'];
	    $query = "SELECT employee_id,employee_name
				 FROM employees 
				 WHERE employee_deleted_status=0 and employee_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	
	function accountList(){
	
		$val   = $_REQUEST['val'];
	    $query = "SELECT account_sub_id,account_sub_name,account_sub_currency_id
				 FROM  account_sub 
				 WHERE account_sub_deleted_status=0 and account_sub_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	
	
?>

		