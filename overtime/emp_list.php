<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	


			$emp_id    = $_REQUEST['emp_id'];
			 $id	= $_REQUEST['id'];
			if($id==1){
			 $query  = "SELECT employee_basic_pay	
						FROM employees
						WHERE employee_deleted_status='0' and 	employee_id = '$emp_id' ";//exit;
			$result = mysql_query($query);
			$array_result = array();
			
			$result_ary = mysql_fetch_array($result);				
			
		
		$cal = ($result_ary['employee_basic_pay']*12)/(52*44)*2;
		
			echo $cal;

			}else{
			
			$query  = "SELECT employee_basic_pay	
						FROM employees
						WHERE employee_deleted_status='0' and 	employee_id = '$emp_id' ";
			$result = mysql_query($query);
			$array_result = array();
			
			$result_ary = mysql_fetch_array($result);				
			
			$cal = ($result_ary['employee_basic_pay']*12)/(52*44)*2;
		
			echo $cal;
			
			
			}
			
			
	
	
?>