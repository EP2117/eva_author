<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	


			$emp_id    = $_REQUEST['emp_id'];
			 $id	= $_REQUEST['id'];
			if($id==1){
			 $query  = "SELECT employee_overtime_day	
						FROM employees
						WHERE employee_deleted_status='0' and 	employee_id = '$emp_id' ";//exit;
			$result = mysql_query($query);
			$array_result = array();
			
			$result_ary = mysql_fetch_array($result);				
			
		
		
			echo $result_ary['employee_overtime_day'];

			}else{
			
			$query  = "SELECT employee_overtime_hrs	
						FROM employees
						WHERE employee_deleted_status='0' and 	employee_id = '$emp_id' ";
			$result = mysql_query($query);
			$array_result = array();
			
			$result_ary = mysql_fetch_array($result);				
			
		
		
			echo $result_ary['employee_overtime_hrs'];
			
			
			}
			
			
	
	
?>