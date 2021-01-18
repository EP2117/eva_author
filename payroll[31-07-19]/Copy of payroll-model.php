<?php 
require_once('../project-config/utility-function.php'); 

if(getFileName() == 'index') {  
		
// Generate payslip
	function generatePayslip()
	{
	    
		if(isset($_POST['generate_payslip']) && ($_SESSION['session_csrf_token'] == $_POST['token'])) {
			 
			 $payroll_mm_yyyy = dataValidation($_POST['payroll_mm_yyyy']);
			$month_year_picker = explode('/',$payroll_mm_yyyy);
			$payroll_month = $month_year_picker[0]; 
			$payroll_year  = $month_year_picker[1];
			$ip            = getRealIpAddr();
			
			$select_payroll_mm_yyyy = "SELECT payroll_month, payroll_year FROM payroll 
			                           WHERE payroll_month ='".$payroll_month."' 
									   AND payroll_year ='".$payroll_year."' 
									   AND payroll_deleted_status=0";
			$result_payroll_mm_yyyy = mysql_query($select_payroll_mm_yyyy);
			$count_payroll_mm_yyyy  = mysql_num_rows($result_payroll_mm_yyyy);
			if($count_payroll_mm_yyyy == 0) {

				$mm_yyyy = '01/'.dataValidation($_POST['payroll_mm_yyyy']); 
				$date = dateDatabaseFormat($mm_yyyy);
				$month_year = dataValidation($_POST['payroll_mm_yyyy']);
				$month_year = explode("/",$month_year);
				$month = $month_year[0];
				$year  = $month_year[1];
				
				// Get ESI & PF percentage from payroll_settings 
				$select_payroll_settings = "SELECT  payroll_setting_employee_esi, payroll_setting_employer_esi, 
													payroll_setting_employee_pf, payroll_setting_employer_pf  
											FROM payroll_settings WHERE payroll_setting_id=1";
				$result_payroll_settings = mysql_query($select_payroll_settings);
				$record_payroll_settings = mysql_fetch_array($result_payroll_settings);
				
				$payroll_setting_employee_esi = $record_payroll_settings['payroll_setting_employee_esi'];
				$payroll_setting_employer_esi = $record_payroll_settings['payroll_setting_employer_esi'];
				$payroll_setting_employee_pf  = $record_payroll_settings['payroll_setting_employee_pf'];
				$payroll_setting_employer_pf  = $record_payroll_settings['payroll_setting_employer_pf'];
				
				// List employees 	
				$select_employees = "SELECT employee_id, employee_code, employee_name, employee_basic_pay_amt, employee_da_amt, employee_hra_amt, employee_special_allawance_amt, 
											employee_medical_allawance_amt, employee_convenience_amt, employee_pf_status, employee_esi_status, employee_insurence_amt,
											employee_date_of_join
									 FROM  employees 
									 WHERE employee_date_of_join <= LAST_DAY('".$date."')
									 AND employee_status = 'resign' AND employee_active_status='active' AND employee_deleted_status=0
									 ORDER BY employee_code ASC";
					$result_employees = mysql_query($select_employees);		
					$count_employees = mysql_num_rows($result_employees);
					if($count_employees > 0) {			
						  
						 $sno = 1; 
							while ($record_employees = mysql_fetch_array($result_employees)) {
								$payroll_uniq_id                = generateUniqId();
								$employee_id                    = $record_employees['employee_id'];
								$employee_date_of_join          = $record_employees['employee_date_of_join'];
								$employee_basic_pay_amt         = $record_employees['employee_basic_pay_amt'];
								$employee_da_amt                = $record_employees['employee_da_amt'];
								$employee_hra_amt               = $record_employees['employee_hra_amt'];
								$employee_special_allawance_amt = $record_employees['employee_special_allawance_amt'];
								$employee_medical_allawance_amt = $record_employees['employee_medical_allawance_amt'];
								$employee_convenience_amt       = $record_employees['employee_convenience_amt'];
								$employee_insurence_amt         = $record_employees['employee_insurence_amt'];
								$employee_pf_status             = $record_employees['employee_pf_status'];
								$employee_esi_status            = $record_employees['employee_esi_status'];
								
								$no_of_working_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
								
								
								
								$select_attendance = "SELECT SUM(attendance_lop_days) AS no_of_leaves, COUNT(*) AS total_days FROM attendance 
								                      WHERE YEAR(attendance_date) = '".$payroll_year."' 
													  AND MONTH(attendance_date) = '".$payroll_month."' 
													  AND attendance_employee_id = '".$employee_id."'"; 
								$result_attendance = mysql_query($select_attendance);	
								$record_attendance = mysql_fetch_array($result_attendance)	;
								
								$total_days   = $record_attendance['total_days'];
								$no_of_leaves = $record_attendance['no_of_leaves']; 
								
								$no_of_worked   = $total_days - $no_of_leaves;
								
								// Calculate eraning
								$total_allawance = ($employee_basic_pay_amt + $employee_da_amt + $employee_hra_amt + $employee_special_allawance_amt + 
													$employee_medical_allawance_amt + $employee_convenience_amt);
													
								// Calculate per day salary
								$per_day_salary = $total_allawance / $no_of_working_days;	
								
								// Calculate loss of pay
								$loss_of_pay =  $no_of_leaves * $per_day_salary; 
								
			
								// Calculate employee advance amount
								$select_salary_advance = "SELECT SUM(salary_advance_amount) as salary_advance_amount FROM salary_advance
								                          WHERE salary_advance_mm_yyyy = '".$payroll_mm_yyyy."' 
														  AND salary_advance_employee_id = '".$employee_id."'"; 
								$result_salary_advance = mysql_query($select_salary_advance);	
								$record_salary_advance = mysql_fetch_array($result_salary_advance);
								$salary_advance_amount = $record_salary_advance['salary_advance_amount'];
								
								
								// Calculate PF
								if($employee_pf_status!=0) { 
								
									$employee_pf = (((($total_allawance - $loss_of_pay) * 60) / 100) * $payroll_setting_employee_pf) / 100;
									$employer_pf = (((($total_allawance - $loss_of_pay) * 60) / 100) * $payroll_setting_employer_pf) / 100;
									
								} else {
									$employee_pf = 0;
									$employer_pf = 0;
								}
								
								
								// Calculate ESI
								if($employee_esi_status!=0) { 
								
									$employee_esi = (($total_allawance - $loss_of_pay)  * $payroll_setting_employee_esi) / 100;
									$employer_esi = (($total_allawance - $loss_of_pay)  * $payroll_setting_employer_esi) / 100;
									
								} else {
								
									$employee_esi = 0;
									$employer_esi = 0;
								}
								
								//Calculate Professional Tax
								$select_pt_slab = "SELECT professional_tax_slab_amount FROM professional_tax_slab
								                          WHERE professional_tax_slab_from <= '".$total_allawance."' 
														  AND professional_tax_slab_to >= '".$total_allawance."'"; 
								$result_pt_slab = mysql_query($select_pt_slab);	
								$record_pt_slab = mysql_fetch_array($result_pt_slab);
								$payroll_pt_amount = $record_pt_slab['professional_tax_slab_amount'];								
								
								// Calculate total deduction
								$total_deduction  = $loss_of_pay + $employee_insurence_amt + $employee_pf + $employee_esi + $payroll_pt_amount + $salary_advance_amount; 
								
								
								$payroll_employee_net_salary = $total_allawance - $total_deduction;
								
								$insert_payroll = sprintf("INSERT INTO payroll (payroll_uniq_id, payroll_mm_yyyy, payroll_month, payroll_year, payroll_employee_id, 
								                                                payroll_no_of_working_days, payroll_no_of_worked, payroll_no_of_leaves, payroll_basic_pay, 
																				payroll_da, payroll_hra, payroll_special_allawance, payroll_medical_allawance, 
																				payroll_convenience, payroll_insurence, payroll_loss_of_pay, payroll_salary_advance,
																				payroll_employee_pf_percentage, 
																				payroll_employee_pf_amount, payroll_employer_pf_percentage, 
																				payroll_employer_pf_amount, payroll_employee_esi_percentage, 
																				payroll_employee_esi_amount, payroll_employer_esi_percentage, 
																				payroll_employer_esi_amount, payroll_pt_amount,
																				payroll_pf_status, payroll_esi_status, 
																				payroll_employee_earning, payroll_employee_deduction, payroll_employee_net_salary, 
																				payroll_added_by, payroll_added_on, payroll_added_ip)
														   VALUES('%s', '%s','%d', '%d', '%d', '%d', '%f', '%f', '%f', '%f', '%f', '%f', '%f', '%f', '%f', '%f', '%f', '%f',
														          '%f', '%f', '%f', '%f', '%f', '%f', '%f', '%f', '%d', %d, '%f', '%f', '%f', '%d', UNIX_TIMESTAMP(NOW()), '%s')", 
														   $payroll_uniq_id, $payroll_mm_yyyy, $month, $year, $employee_id, $no_of_working_days, 
														   $payroll_no_of_worked, $no_of_leaves,  $employee_basic_pay_amt, 
														   $employee_da_amt, $employee_hra_amt, $employee_special_allawance_amt, $employee_medical_allawance_amt,
														   $employee_convenience_amt, $employee_insurence_amt, $loss_of_pay ,$salary_advance_amount, 
														   $payroll_setting_employee_pf, $employee_pf,  
														   $payroll_setting_employer_pf, $employer_pf, $payroll_setting_employee_esi, $employee_esi, 
														   $payroll_setting_employer_esi, $employer_esi, $payroll_pt_amount, $employee_pf_status, $employee_esi_status, 
														   $total_allawance, $total_deduction, $payroll_employee_net_salary, $_SESSION['session_admin_user_id'], $ip); 
								
								mysql_query($insert_payroll);
						}				
				}				
					
				$_SESSION['session_msg'] = 'Payroll generated successfully';
				header("Location:".PROJECT_PATH."/payroll/?page=add");
				exit();	
			} else {
				$_SESSION['session_alert_msg'] = 'Payroll already generated for this month..!';
				header("Location:".PROJECT_PATH."/payroll/?page=add");
				exit();
			}
		
		
		} 
	}
	
	
	function listPayroll()
	{	
	  	$select_payroll = "SELECT payroll_id,  payroll_month, payroll_year FROM payroll 
						   WHERE payroll_deleted_status =0 
		                   GROUP BY payroll_year DESC, payroll_month DESC"; 
		$result_payroll = mysql_query($select_payroll);
		$count_payroll  = mysql_num_rows($result_payroll);
		if($count_payroll > 0){
			$arr_payroll = array();
			while ($record_payroll = mysql_fetch_array($result_payroll)) {
				   $arr_payroll[]  = $record_payroll;
			}
			return $arr_payroll;
		} else {
			return $count_payroll;
		}
	}
	
	
	function listEmployee()
	{
		if(strlen($_GET['mm'])==1) {
			$date = $_GET['yyyy'].'-0'.$_GET['mm'].'-01'; 
		} else {
			$date = $_GET['yyyy'].'-'.$_GET['mm'].'-01'; 
		}
		
		//$date = dateDatabaseFormat($mm_yyyy);
		$select_employees = "SELECT employee_id, employee_code 	, employee_name FROM  employees 
		                     WHERE  employee_date_of_join <= LAST_DAY('".$date."')
						 AND  employee_active_status='active' AND employee_deleted_status=0
							 ORDER BY employee_code 	 ASC";
		$result_employees = mysql_query($select_employees);		
		$count_employees = mysql_num_rows($result_employees);
		if($count_employees > 0){
			$arr_employees = array();
			while ($record_employees = mysql_fetch_array($result_employees)) {
				   $arr_employees[]  = $record_employees;
			}
			return $arr_employees;
		} else {
			return $count_employees;
		}
	}

	// List Department records form department table with the  edit
	function editDepartment()  
	{
		if(isset($_GET['id'])) {	   
		$edit_department = "SELECT  department_id, department_uniq_id,department_name, department_modified_on, department_modified_ip, 
							   department_added_on, department_added_by,department_modified_by,
							   department_added_ip,add_user.admin_user_username as add_admin_user_username,
							   update_user.admin_user_username as update_admin_user_username 
								  
					    FROM   departments
						LEFT JOIN admin_users ON admin_user_id =department_added_by
					    LEFT JOIN admin_users AS add_user ON add_user.admin_user_id=department_added_by 
						LEFT JOIN admin_users AS update_user ON update_user.admin_user_id=department_modified_by  
						WHERE  department_uniq_id='".dataValidation($_GET['id'])."'";

			$result_department = mysql_query($edit_department);
			$record_department = mysql_fetch_array($result_department);
			return $record_department;
		}
   }
   // update Department into department table   	department_order 
	function updateDepartment()
	{
		if(isset($_POST['update_department']) && ($_SESSION['session_csrf_token'] == $_POST['token'])) { 
		
		    $department_id             	= $_POST['department_id'];
			$department_uniq_id        	= $_POST['department_uniq_id'];
 			$department_name    		= dataValidation($_POST['department_name']);
			$ip                   = getRealIpAddr(); 									 
				
			if(!empty($department_name))  {					 
			
				// Department update in database table
				$update_department = sprintf("UPDATE departments SET department_name      = '%s',
																department_modified_by    = '%d',
																department_modified_on    =  UNIX_TIMESTAMP(NOW()),
																department_modified_ip    = '%s'	  	
												 WHERE          department_uniq_id        = '%s'", 
												$department_name, $_SESSION['session_admin_user_id'], $ip, $department_uniq_id);
						
					mysql_query($update_department);  
		 
					//redirect the page
					$_SESSION['session_msg'] = 'Department updated successfully';
					header("Location:".PROJECT_PATH."/department?page=edit&id=$department_uniq_id");
					exit();
					
			}
		
		} 
	}
	
	//Delete Department into department table
	function deleteDepartment()
	{
		if(isset($_POST['delete_department']) && ($_SESSION['session_csrf_token'] == $_POST['token'])) { 
			deleteRecords('departments', 'department_deleted_by', 'department_deleted_on', 'department_deleted_ip', 'department_deleted_status', 'department_id', '1');
			$_SESSION['session_msg'] = 'Department deleted successfully';
			header("Location:".PROJECT_PATH."/department/index");
			exit;
		}
	} 		
 

}

?>