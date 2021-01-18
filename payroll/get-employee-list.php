<?php  
require_once('../project-config/utility-function.php'); 
require_once('../project-config/project-config.php');
?>
<table width="100%" id="mytable">
  <thead>
    <tr>
      <th width="2%">#</th>
      <th width="13%">Employee No</th>
      <th width="26%">Employee Name</th>
      <th width="16%">Gross Salary</th>
      <th width="16%">Deductions</th>
      <th width="13%">Earning</th>
      <th width="14%">Net Salary</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$index=0;
	$mm_yyyy = '01/'.dataValidation($_GET['mm_yyyy']); 
	$date = dateDatabaseFormat($mm_yyyy);
	$month_year = dataValidation($_GET['mm_yyyy']);
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
	                            employee_medical_allawance_amt, employee_convenience_amt, employee_pf_status, employee_esi_status, employee_insurence_amt
						 FROM  employees 
		                 WHERE employee_date_of_join <= LAST_DAY('".$date."')
						 AND employee_status != 'resign' AND employee_active_status='active' AND employee_deleted_status=0
						 ORDER BY employee_code ASC";
		$result_employees = mysql_query($select_employees);		
		$count_employees = mysql_num_rows($result_employees);
		if($count_employees > 0){					  
             $sno = 1; 
				while ($record_employees = mysql_fetch_array($result_employees)) {
					
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

					$no_of_leaves = 4;
					
					// Calculate eraning
					$total_allawance = ($employee_basic_pay_amt + $employee_da_amt + $employee_hra_amt + $employee_special_allawance_amt + 
					                    $employee_medical_allawance_amt + $employee_convenience_amt);
										
					// Calculate per day salary
					$per_day_salary = $total_allawance / $no_of_working_days;	
					
					// Calculate loss of pay
					$loss_of_pay =  $no_of_leaves * $per_day_salary;
					

					
					
					// Calculate PF
					if($employee_pf_status!=0) { 
					
						$employee_pf = ((($total_allawance - ($loss_of_pay + $employee_insurence_amt)) * 60) * $payroll_setting_employee_pf) / 100;
						$employer_pf = ((($total_allawance - ($loss_of_pay + $employee_insurence_amt)) * 60) * $payroll_setting_employer_pf) / 100;
						
					} else {
						$employee_pf = 0;
						$employer_pf = 0;
					}
					
					
					// Calculate ESI
					if($employee_esi_status!=0) { 
					
						$employee_esi = (($total_allawance - ($loss_of_pay + $employee_insurence_amt))  * $payroll_setting_employee_esi) / 100;
						$employer_esi = (($total_allawance - ($loss_of_pay + $employee_insurence_amt))  * $payroll_setting_employer_esi) / 100;
						
					} else {
					
						$employee_esi = 0;
						$employer_esi = 0;
					}
					
					// Calculate total deduction
					$total_deduction  = $loss_of_pay + $employee_insurence_amt + $employee_pf + $employee_esi; 
					
	?>
    <tr class="<?php echo rowStyle($sno); ?>">
      <td><?php echo $sno++; ?></td>
      <td><?php echo $record_employees['employee_code']; ?>
        <input type="hidden" name="payroll_employee_id[]" id="payroll_employee_id<?php echo $index; ?>" class="textbox-payroll"  value="<?php echo $record_employees['employee_id']; ?>" /></td>
      <td><?php echo ucwords($record_employees['employee_name']); ?></td>
      <td><input type="text" name="payroll_employee_gross_salary[]" id="payroll_employee_gross_salary<?php echo $index; ?>" class="textbox-payroll" style="text-align:right;" value=""  onchange="calculateNetSalary('<?php echo $index; ?>');" onkeyup="calculateNetSalary('<?php echo $index; ?>');" /></td>
      <td><input type="text" name="payroll_employee_deductions[]" id="payroll_employee_deductions<?php echo $index; ?>" class="textbox-payroll" style="text-align:right;" value="0" onchange="calculateNetSalary('<?php echo $index; ?>');" onkeyup="calculateNetSalary('<?php echo $index; ?>');" /></td>
      <td><input type="text" name="payroll_employee_earning[]" id="payroll_employee_earning<?php echo $index; ?>" class="textbox-payroll" style="text-align:right;" value="0" onchange="calculateNetSalary('<?php echo $index; ?>');" onkeyup="calculateNetSalary('<?php echo $index; ?>');" /></td>
      <td><input type="text" name="payroll_employee_net_salary[]" id="payroll_employee_net_salary<?php echo $index; ?>" class="textbox-payroll" style="text-align:right;" value="" readonly="readonly" />
        <input type="hidden" name="order_cover_no" id="count" value="<?php echo $index; ?>" />
      </td>
    </tr>
    <?php  $index++; } 
			 } else {?>
    <tr>
      <td colspan="7" align="center" class="text_orange"><?php echo "No record(s) found"; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>