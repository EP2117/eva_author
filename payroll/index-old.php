<?php  
// Project Config
require_once('../project-config/utility-function.php'); 
require_once('../project-config/project-config.php');
// Checking login status
if( (isset($_SESSION['session_admin_user_uniq_id']))) {
    // Model page
	require_once 'payroll-model.php';
	
	if(isset($_POST['generate_payslip'])) {
		generatePayslip();
	}
	

	
	
	$list_payroll = listPayroll();
	$arr_branch = branches();
	
	if((isset($_GET['page'])) && ($_GET['page']=='view') && (isset($_GET['mm'])) && (isset($_GET['yyyy'])) ) { 
		$list_employee= listEmployee();
		
	}
	//Department Edit function
	if(isset($_GET['id'])) {
		$edit_department = editDepartment();
	}
	
	//Department Update function
	if(isset($_POST['update_department'])) {
		updateDepartment();
	}
	
	//Department Delete function
	if(isset($_POST['delete_department'])) {
		deleteDepartment();
	}
	
	// View page	 
	require_once 'payroll-view.php';
	
} else {

	// Redirect to login page if accessing this page without login
	header("Location:../index");
	exit();
}		
?>