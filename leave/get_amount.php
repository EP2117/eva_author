<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	


			$emp_id    = $_REQUEST['emp_id'];
			 $id	= $_REQUEST['id']; //print_r($_REQUEST['checkedVals']);
			 $leave = explode(",",dataValidation($_REQUEST['checkedVals']));
			 $type = dataValidation($_REQUEST['type']);
			 $no_days = dataValidation($_REQUEST['no_days']);
			// echo $leave ;exit;
			 $amount = 0;
			 $cal1 = 0;
			 $cal =0;
			 $cal2 =0;
			 
			if(in_array(1,$leave)){
			 $query  = "SELECT gov_bouns	
						FROM employees
						WHERE employee_deleted_status='0' and 	employee_id = '$emp_id' ";//exit;
						
			$result = mysql_query($query);
			$array_result = array();
			
			$result_ary = mysql_fetch_array($result);				
			
		
		$cal = ($result_ary['gov_bouns']/30);
		
			
			}if(in_array(2,$leave)){
			
			$query  = "SELECT without_bouns	
						FROM employees
						WHERE employee_deleted_status='0' and 	employee_id = '$emp_id' ";
			$result = mysql_query($query);
			$array_result = array();
			
			$result_ary = mysql_fetch_array($result);				
			
			$cal1 = ($result_ary['without_bouns']/2);
		
			
			
			}
			if(in_array(3,$leave)){
			
			$query  = "SELECT employee_basic_pay	
						FROM employees
						WHERE employee_deleted_status='0' and 	employee_id = '$emp_id' ";
			$result = mysql_query($query);
			$array_result = array();
			
			$result_ary = mysql_fetch_array($result);				
			
			$cal2 = ($result_ary['employee_basic_pay']/30);
		
			
			}
			$amount = $cal+$cal1+$cal2;
			if($type==1)
			{
			echo $no_days*$amount;
			}else{
			echo ($no_days*$amount)/2;
			}
			
			
	
	
?>