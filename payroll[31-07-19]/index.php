<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	
	require_once 'payroll-model.php';		
	
		$branch_list	= getBranchList();
		if(isset($_POST['payrollentry'])){
			generatePayslip();
		}
		if(!isset($_REQUEST['page'])) {
			$list_payroll = listPayroll();
		}
		if(isset($_REQUEST['id']) && (isset($_GET['mm'])) && (isset($_GET['yyyy']))) {
			$list_employee = listEmployee($_REQUEST['mm'],$_REQUEST['yyyy']);
		}	
	require_once 'payroll-view.php';
?>