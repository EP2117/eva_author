<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

// function for list employees payroll for the month
function getPaySlip($employee_id, $month, $year) 
{
	$select_payroll = "SELECT * FROM payroll 
		                   		LEFT JOIN employees ON payroll_employee_id = employee_id
								WHERE  payroll_employee_id = '".$employee_id."' AND payroll_month = '".$month."' 
								AND payroll_year = '".$year."' AND payroll_deleted_status =0";
	$result_payroll = mysql_query($select_payroll);
	$record_payroll = mysql_fetch_array($result_payroll);		
	return $record_payroll;
	
}

?>