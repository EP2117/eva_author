<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'department-model.php';
		if(isset($_POST['department_insert'])){
			insertDepartment();
		}
		if(!isset($_REQUEST['page'])) {
			$department_list	= listDepartment();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$department_edit	= editDepartment();
		}
		if(isset($_POST['department_update'])){
			updateDepartment();
		}
	require_once 'department-view.php';
?>