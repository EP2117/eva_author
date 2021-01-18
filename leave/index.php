<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'leave-model.php';		
	
	
	$arr_salary = array("1"=>"Supporting Pay", "2"=>"Without Leave Bonus", "3"=>" Basic Salary");
		$branch_list		= getBranchList();
		if(isset($_POST['leave_insertupdate'])){
			insertUpdateLeave();
		}
		if(!isset($_REQUEST['page'])) {
			$leaveResult = listLeave();
		}
		if(isset($_REQUEST['id'])) {
			$leave_edit   = editLeave($_REQUEST['id']);	
		}	
		if(isset($_REQUEST['leave_delete'])) {
			leave_delete();	
		}
	require_once 'leave-view.php';
?>