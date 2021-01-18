<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'employee-model.php';		
		$branch_list	= getBranchList();
		$arr_meritalStatus	  = array("1"=>"Single", "2"=>"Married","3"=>"Divorced", "4"=>"Widowed");

		if(isset($_REQUEST['employee_insertupdate'])){
			employeensertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$empResult = listEmployeeview();
		}
		if(isset($_REQUEST['id'])) {
			$empEdit   = editEmployee($_REQUEST['id']);	
		}
		if(isset($_REQUEST['employee_delete'])){
		employeedelete();
		
		}
	require_once 'employee-view.php';
?>	
		