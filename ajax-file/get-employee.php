<?php 
	require_once('../includes/config/config.php');
    //employee ID
	$employee_id 		= $_GET["employee_id"];
	
	$select_employee 	=   "SELECT 
								employee_no,
								position_name, 
								department_name
							 FROM 
								employees
							 LEFT JOIN
								departments
							 ON
								department_id						=  employee_department_id
							 LEFT JOIN
								positions
							 ON
								position_id							=  employee_designation_id
							 WHERE 
								employee_id 						 = '".$employee_id."' 	AND 
								employee_deleted_status 	= 0 
							 ORDER BY 
								employee_name ASC";	
	$result_employee 	=  mysql_query($select_employee);
	$record_employee 	= mysql_fetch_array($result_employee);
	
	echo $record_employee['department_name']."@".$record_employee['position_name'];
?>

			 
 
  

 
 