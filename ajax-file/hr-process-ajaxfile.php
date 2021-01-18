<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'aplicantList':applicantList();
				break;
			case 'aplicantDetails':aplicantDetails();
				break;
			case 'ea_aplicantList':applicantList();
				break;
			case 'ea_aplicantDetails':aplicantDetails();
				break;
			case 'iv_aplicantList':applicantList();
				break;
			case 'iv_aplicantDetails':aplicantDetails();
				break;
			case 'employeeList':applicantList();
				break;
			case 'employeeDetails':aplicantDetails();
				break;
			case 'employees':employees();
				break;
			case 'employee_details':employee_details();
				break;
			case 'performaemployes':performaemployes();
				break;
			case 'performaemployes_details':performaemployes_details();
				break;
		}
		
	}
	
	function applicantList(){
			
		$val    = $_REQUEST['val'];
		
		if($_REQUEST['action'] == 'aplicantList'){
		
			$query  = "SELECT pIVId, pIV_applicant_name 
						FROM hr_pre_interview 
						WHERE pIV_applicant_name LIKE '%$val%' LIMIT 15";
			
		}elseif($_REQUEST['action'] == 'ea_aplicantList'){
			
			$query  = "SELECT cVId, pIV_applicant_name 
						FROM hr_cv_collcetion 
						LEFT JOIN hr_pre_interview ON cV_pIVId = pIVId	
						WHERE pIV_applicant_name LIKE '%$val%' LIMIT 15";
		
		}elseif($_REQUEST['action'] == 'iv_aplicantList'){
			
			$query  = "SELECT emApId, pIV_applicant_name 
						FROM hr_emplyoment_appliaction
						LEFT JOIN hr_cv_collcetion ON emAp_cVId = cVId
						LEFT JOIN hr_pre_interview ON cV_pIVId = pIVId	
						WHERE pIV_applicant_name LIKE '%$val%' LIMIT 15";
						
		}elseif($_REQUEST['action'] == 'employeeList'){
			
			$query  = "SELECT iVId, pIV_applicant_name 
						FROM hr_interview
						LEFT JOIN hr_emplyoment_appliaction ON iV_emApId = emApId
						LEFT JOIN hr_cv_collcetion ON emAp_cVId = cVId
						LEFT JOIN hr_pre_interview ON cV_pIVId = pIVId	
						WHERE pIV_applicant_name LIKE '%$val%' LIMIT 15";
		}
		
			$result = mysql_query($query);
			$array_result = array();
			
			while($result_ary = mysql_fetch_array($result)){				
				array_push($array_result,$result_ary);
			}
		
			echo json_encode($array_result);
	}
	
	function aplicantDetails(){
	
		if($_REQUEST['action'] == 'aplicantDetails'){
		
			$query  = "SELECT pIVId, pIV_applicant_name, pIV_employee_type, DATE_FORMAT(pIV_date ,'%d-%m-%Y') as c_date, department_name, designation,IF(pIV_req_gender='1','Male','Female')  AS gender, pIV_req_gender,pIV_employee_type
						FROM hr_pre_interview 
						LEFT JOIN departments ON pIV_department_id = department_id
						LEFT JOIN designations ON pIV_designation_id = designation_id	
						WHERE pIVId = '".$_REQUEST['id']."' ";
					
		}elseif($_REQUEST['action'] == 'ea_aplicantDetails'){
				
			 $query  = "SELECT pIV_applicant_name,cV_father_name,cV_nrc_no,DATE_FORMAT(cV_dob,'%d-%m-%Y') as dob ,cV_nationality,cV_religion, pIV_employee_type, pIV_employee_type, DATE_FORMAT(pIV_date ,'%d-%m-%Y') as c_date, department_name, designation,IF(pIV_req_gender='1','Male','Female')  AS gender, pIV_req_gender,
			 			(CASE cV_marital_status WHEN 1 THEN 'Single' WHEN 2 THEN 'Married' WHEN 3 THEN 'Divorced' WHEN 4 THEN 'Widowed' END) as cV_marital_status
						FROM hr_cv_collcetion
						LEFT JOIN hr_pre_interview ON cV_pIVId = pIVId	 
						LEFT JOIN departments ON pIV_department_id = department_id
						LEFT JOIN designations ON pIV_designation_id = designation_id	
						WHERE cVId = '".$_REQUEST['id']."' ";
			
		}elseif($_REQUEST['action'] == 'iv_aplicantDetails'){
				
			 $query  = "SELECT pIV_applicant_name,DATE_FORMAT(cV_dob,'%d-%m-%Y') as dob ,pIV_employee_type, pIV_employee_type, pIV_req_gender, DATE_FORMAT(pIV_date ,'%d-%m-%Y') as c_date, department_name, designation
						FROM hr_emplyoment_appliaction
						LEFT JOIN hr_cv_collcetion ON emAp_cVId = cVId
						LEFT JOIN hr_pre_interview ON cV_pIVId = pIVId	 
						LEFT JOIN departments ON pIV_department_id = department_id
						LEFT JOIN designations ON pIV_designation_id = designation_id	
						WHERE emApId = '".$_REQUEST['id']."' ";
			
		}elseif($_REQUEST['action'] == 'employeeDetails'){
			
			  $query  = "SELECT pIV_applicant_name,cV_father_name,cV_nrc_no, cV_marital_status, DATE_FORMAT(cV_dob,'%d-%m-%Y') as dob ,cV_nationality,cV_religion, pIV_employee_type, pIV_employee_type, pIV_req_gender, DATE_FORMAT(pIV_date ,'%d-%m-%Y') as c_date, department_name, designation, IF(pIV_req_gender='1','Male','Female') AS sex
						FROM hr_interview
						LEFT JOIN hr_emplyoment_appliaction ON iV_emApId = emApId
						LEFT JOIN hr_cv_collcetion ON emAp_cVId = cVId
						LEFT JOIN hr_pre_interview ON cV_pIVId = pIVId	 
						LEFT JOIN departments ON pIV_department_id = department_id
						LEFT JOIN designations ON pIV_designation_id = designation_id	
						WHERE iVId = '".$_REQUEST['id']."' ";
		
		}
				
			$result = mysql_query($query);
			$array_result = mysql_fetch_array($result);
			
			echo json_encode($array_result);
	}
	
	function employees(){
		// !important working in many pages. do not change this function u need some changes please put on another functios
		$val    = $_REQUEST['val'];
		$query  = "SELECT employee_id,employee_name 
					FROM hr_employees							
					WHERE employee_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$array_result = array();
			
			while($result_ary = mysql_fetch_array($result)){				
				array_push($array_result,$result_ary);
			}
		
			echo json_encode($array_result);
	}
	
	function employee_details(){
		// !important working in many pages. do not change this function u need some changes please put on another functios
		$id    = $_REQUEST['id'];
		$query  = "SELECT employee_name,employee_id,DATE_FORMAT(emp_date_of_joined,'%d-%m-%Y') AS doj ,emp_department,emp_postion,department_name, designation
					FROM hr_employees
					LEFT JOIN departments ON emp_department = department_id
					LEFT JOIN designations ON emp_postion = designation_id								
					WHERE employee_id='$id'";
			$result = mysql_query($query);
			$array_result = mysql_fetch_array($result);
			
			echo json_encode($array_result);
	}
	
	function performaemployes(){
		
		$val    = $_REQUEST['val'];
		$query  = "SELECT empPerfomaEvalId,employee_name 
					FROM hr_employees_performaevaluation
					LEFT JOIN hr_employees ON pev_empid = employee_id						
					WHERE employee_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$array_result = array();
			
			while($result_ary = mysql_fetch_array($result)){				
				array_push($array_result,$result_ary);
			}
		
			echo json_encode($array_result);
	
	}
	function performaemployes_details(){
		$id    = $_REQUEST['id'];
		$query  = "SELECT pev_empid
					FROM  hr_employees_performaevaluation
					WHERE empPerfomaEvalId='$id'";
			$result = mysql_query($query);
			$array_result = mysql_fetch_array($result);
			
			echo json_encode($array_result);
	}
	
?>
	
	
	
	