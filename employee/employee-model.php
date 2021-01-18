<?php	
	function employeensertUpdate(){		
		
		//extract($_REQUEST);	// important		
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
	
		mysql_query("BEGIN");	
		
		 if(empty($_REQUEST['id'])){
			  
			  $query = "INSERT INTO employees SET employee_name='".$_REQUEST['employee_name']."', employee_branchid='".$_REQUEST['branchid']."', employee_dob='".NdateDatabaseFormat($_REQUEST['dob'])."', employee_phone_no='".$_REQUEST['phone_no']."', employee_mobile_no='".$_REQUEST['mobile_no']."', employee_email='".$_REQUEST['email']."', employee_address='".$_REQUEST['address']."', employee_gender='".$_REQUEST['gender']."', employee_marital_status='".$_REQUEST['marital_status']."', employee_qulification='".$_REQUEST['qulification']."', employee_total_exp='".$_REQUEST['total_exp']."', employee_last_company='".$_REQUEST['last_company']."', employee_basic_pay='".str_replace(',','',$_REQUEST['basic_pay'])."', employee_deduction_day='".str_replace(',','',$_REQUEST['deduction_day'])."', employee_deduction_hrs='".str_replace(',','',$_REQUEST['deduction_hrs'])."', employee_nrc='".$_REQUEST['nrc']."', employee_employee_ssb='".$_REQUEST['employee_ssb']."', employee_employeer_ssb='".$_REQUEST['employeer_ssb']."', employee_leave_permit='".$_REQUEST['leave_permit']."', employee_medical_leave='".$_REQUEST['medical_leave']."', employee_cascal_leave='".$_REQUEST['cascal_leave']."',employee_annual_leave='".$_REQUEST['annual_leave']."', employee_other_leave='".$_REQUEST['other_leave']."', employee_customized='".$_REQUEST['customized']."', employee_status='".$_REQUEST['status']."', employee_bonus='".$_REQUEST['bonus']."',  employee_bonus_amnt='".str_replace(',','',$_REQUEST['bonus_amnt'])."', employee_allowance='".$_REQUEST['allowance']."', employee_phone_allowance='".str_replace(',','',$_REQUEST['phone_allowance'])."', employee_food_allowance='".str_replace(',','',$_REQUEST['food_allowance'])."', employee_travel_allowance='".str_replace(',','',$_REQUEST['travel_allowance'])."', employee_other_allowance='".str_replace(',','',$_REQUEST['other_allowance'])."', employee_overtime_day='".str_replace(',','',$_REQUEST['overtime_day'])."', employee_overtime_hrs='".str_replace(',','',$_REQUEST['overtime_hrs'])."', employee_device_id='".$_REQUEST['device_id']."',employee_company_id='$bC', employee_added_by='$by', employee_added_on=NOW(), employee_added_ip='$ip', gov_bouns='".$_REQUEST['gov_bouns']."', without_bouns='".$_REQUEST['without_bouns']."', exp_bouns='".$_REQUEST['exp_bouns']."', other_bouns='".$_REQUEST['other_bouns']."'";
		
		}else{
		
		 	$query = "UPDATE employees SET employee_name='".$_REQUEST['employee_name']."', employee_branchid='".$_REQUEST['branchid']."', employee_dob='".NdateDatabaseFormat($_REQUEST['dob'])."', employee_phone_no='".$_REQUEST['phone_no']."', employee_mobile_no='".$_REQUEST['mobile_no']."', employee_email='".$_REQUEST['email']."', employee_address='".$_REQUEST['address']."', employee_gender='".$_REQUEST['gender']."', employee_marital_status='".$_REQUEST['marital_status']."', employee_qulification='".$_REQUEST['qulification']."', employee_total_exp='".$_REQUEST['total_exp']."', employee_last_company='".$_REQUEST['last_company']."', employee_basic_pay='".str_replace(',','',$_REQUEST['basic_pay'])."', employee_deduction_day='".str_replace(',','',$_REQUEST['deduction_day'])."', employee_deduction_hrs='".str_replace(",","",$_REQUEST['deduction_hrs'])."', employee_nrc='".$_REQUEST['nrc']."', employee_employee_ssb='".$_REQUEST['employee_ssb']."', employee_employeer_ssb='".$_REQUEST['employeer_ssb']."', employee_leave_permit='".$_REQUEST['leave_permit']."', employee_medical_leave='".$_REQUEST['medical_leave']."', employee_cascal_leave='".$_REQUEST['cascal_leave']."',employee_annual_leave='".$_REQUEST['annual_leave']."', employee_other_leave='".$_REQUEST['other_leave']."', employee_customized='".$_REQUEST['customized']."', employee_status='".$_REQUEST['status']."', employee_bonus='".$_REQUEST['bonus']."',  employee_bonus_amnt='".str_replace(',','',$_REQUEST['bonus_amnt'])."', employee_allowance='".$_REQUEST['allowance']."', employee_phone_allowance='".str_replace(",","",$_REQUEST['phone_allowance'])."', employee_food_allowance='".str_replace(',','',$_REQUEST['food_allowance'])."', employee_travel_allowance='".str_replace(',','',$_REQUEST['travel_allowance'])."', employee_other_allowance='".str_replace(",","",$_REQUEST['other_allowance'])."', employee_overtime_day='".str_replace(",","",$_REQUEST['overtime_day'])."', employee_overtime_hrs='".str_replace(',','',$_REQUEST['overtime_hrs'])."', employee_device_id='".$_REQUEST['device_id']."', employee_modified_by='$by', employee_modified_on=NOW(), employee_modified_ip='$ip', gov_bouns='".$_REQUEST['gov_bouns']."', without_bouns='".$_REQUEST['without_bouns']."', exp_bouns='".$_REQUEST['exp_bouns']."', other_bouns='".$_REQUEST['other_bouns']."' WHERE employee_id='".$_REQUEST['id']."'";//exit;
		
		}
		$qry = mysql_query($query);		
		$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
		
		if(empty($qry)){
			$rollBack=true;
		}
		
		if(empty($rollBack)){	
			mysql_query("COMMIT");	
				
			if(empty($_REQUEST['id'])){
				pageRedirection("employee/index.php?page=add&msg=1");	
			}else{
				pageRedirection("employee/index.php?&msg=2");	
			}			
		}else{	
			mysql_query("ROLLBACK");
					
		}
	}
	
	function listEmployeeview(){
		
		$query  = "SELECT employee_id, employee_name,employee_mobile_no,IF(employee_status=1,'Temporary','Permanent') AS employee_status,employee_address,  branch_name,  DATE_FORMAT(employee_added_on ,'%d/%m/%Y') AS employee_added_on
				    FROM employees
				    LEFT JOIN branches ON employee_branchid = branch_id	 
					WHERE employee_deleted_status=0
					ORDER BY employee_id DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editEmployee($id){
		
		 $array_result = array();		
		 $query  = "SELECT *, DATE_FORMAT(employee_dob ,'%d/%m/%Y') AS employee_dob
				     FROM employees 					
				     WHERE employee_id=$id";					
		
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}	
	function employeedelete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		  $delete_budget_entry ="UPDATE  employees SET employee_deleted_status = 1 ,
		 												employee_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														employee_deleted_on	 = UNIX_TIMESTAMP(NOW()),
														employee_deleted_ip = '".$ip."'
						WHERE employee_id = '".$_REQUEST['select_all'][$i]."' ";//exit;
		
		mysql_query($delete_budget_entry);
			header("Location:index.php");
		
		
		}
	
	}
	
	}
	
?>