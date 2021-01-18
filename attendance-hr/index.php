<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'attendance-hr-model.php';		
		if(isset($_POST['employee_list'])){
			$resultArray = employeeList();
		}
		if(isset($_POST['opening_balinsertUpdate'])){
			 employeeInsertUpdate();
		}
		
	require_once 'attendance-hr-view.php';
?>