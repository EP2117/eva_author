<?php 
	function generatePayslip()
	{ 
			
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		$month_cnt     = strlen($_REQUEST['p_month']);
		$month			= ($month_cnt==1)?"0".$_REQUEST['p_month']:$_REQUEST['p_month'];
		$year      = date('Y', strtotime($_REQUEST['p_year']));
	    $totDays   = date("t",strtotime($year.'-'.$month));
		$monthyear = $month.'-'.$_REQUEST['p_year'];
		$yearmonth = $_REQUEST['p_year'].'-'.$month;
		mysql_query("BEGIN");	

		   $select_query  = "SELECT 
		   						employee_id,
								employee_basic_pay,
								gov_bouns,
								without_bouns,
								exp_bouns,
								employee_bonus,
								employee_allowance,
								employee_bonus_amnt,
		  						(employee_phone_allowance+employee_food_allowance+employee_travel_allowance+employee_other_allowance) emp_allowane,
		 						(SELECT COUNT(atnc_employee_id) FROM emp_attendance WHERE atnc_employee_id= employee_id AND DATE_FORMAT(atnc_date ,'%Y-%m') ='".$yearmonth."') emp_attendance,
								IFNULL((SELECT sum(lv_paymentid) FROM emp_leave where lv_employee_id=employee_id AND lv_deleted_status=0 AND DATE_FORMAT(lv_date ,'%Y-%m') ='".$yearmonth."'),0) emp_paid_leave,
								IFNULL((SELECT sum(lv_leaveno) FROM emp_leave where lv_employee_id=employee_id AND  DATE_FORMAT(lv_date ,'%Y-%m') ='".$yearmonth."'),0) emp_leave,
								IFNULL((SELECT SUM(ad_amount) FROM emp_advance WHERE ad_employee_id= employee_id AND DATE_FORMAT(ad_date ,'%Y-%m') ='".$yearmonth."'),0) emp_advance
								
		 					FROM employees 
							LEFT JOIN branches ON employee_branchid  =  branch_id
							WHERE employee_branchid ='".$_REQUEST['p_branchid']."' AND employee_status=2 AND employee_deleted_status = 0  ORDER BY employee_id ASC "; 
			//echo $select_query;exit;
		  $result = mysql_query($select_query);
			
			while($resultData = mysql_fetch_array($result)){
				$per_day_salary 				= $resultData['employee_basic_pay']/$totDays;
				$per_hours_sal					= ($per_day_salary/8);
				
				
			//	$loss_of_pay					= $per_day_salary*$resultData['emp_paid_leave'];
			    $loss_of_pay=get_leave($resultData['employee_id'],$yearmonth);
				//$loss_of_pay					= $per_day_salary*$resultData['emp_paid_leave'];
				if($resultData['employee_bonus']==1){
				$employee_bonus_amnt=$resultData['employee_bonus_amnt'];
				$gov_bouns 						= $resultData['gov_bouns'];
				$without_bouns 					= ($resultData['emp_leave']>0)?$resultData['without_bouns']:0;
				$exp_bouns 						= $resultData['exp_bouns'];
				}else{
				$employee_bonus_amnt			= 0;
				$gov_bouns 						= 0;
				$without_bouns 					= 0;
				$exp_bouns 						= 0;
				}
				$ot_amt_sat=get_ot_sat($resultData['employee_id'],$yearmonth);
				$ot_amt=get_ot($resultData['employee_id'],$yearmonth)-$ot_amt_sat;
				
				//$em_lev_amt=$resultData['emp_leave']-$resultData['emp_paid_leave'];
				$total_earnings					= $resultData['employee_basic_pay']+$resultData['emp_allowane']+$gov_bouns+$without_bouns+$exp_bouns+$employee_bonus_amnt+$ot_amt_sat+$ot_amt;
				$total_deduct					= $resultData['emp_advance']+$loss_of_pay;
				$net_salary						= $total_earnings-$total_deduct;

				$working_day 					= $totDays - $resultData['emp_leave'];

				$query_exit = "SELECT payroll_id FROM payroll 
								WHERE payroll_branchid='".$_REQUEST['p_branchid']."' AND payroll_employee_id = '".$resultData['employee_id']."'  AND payroll_mm_yyyy = '".$monthyear."' AND payroll_deleted_status = 0"; 
								
				$exist_empid = mysql_query($query_exit);
				$ex_empid = mysql_fetch_array($exist_empid); 
					
					
					if(empty($ex_empid['payroll_id'])){
					
						 $query="INSERT INTO payroll SET payroll_branchid='".$_REQUEST['p_branchid']."',payroll_mm_yyyy='".$monthyear."',payroll_month='".$_REQUEST['p_month']."',payroll_year='".$_REQUEST['p_year']."', payroll_employee_id='".$resultData['employee_id']."', payroll_no_of_working_days='".$totDays."', payroll_no_of_worked='".$working_day."', payroll_no_of_leaves='".$resultData['emp_leave']."', payroll_basic_pay='".$resultData['employee_basic_pay']."',payroll_allowance_amount='".$resultData['emp_allowane']."',payroll_overtime_amount='".$ot_amt."',payroll_gov_bouns='".$gov_bouns."', payroll_without_bouns='".$without_bouns."', payroll_exp_bouns='".$exp_bouns."',  payroll_earning_amount='".$total_earnings."',payroll_advance_amount='".$resultData['emp_advance']."',payroll_loss_of_pay='".$loss_of_pay."',payroll_deduction_amount='".$total_deduct."',payroll_net_amount='".$net_salary."',payroll_branch_id='$bC', payroll_added_by='$by', payroll_added_on=NOW(), payroll_added_ip='$ip',payroll_bonus_amnt='".$employee_bonus_amnt."',payroll_no_of_overtime_saturday='".$ot_amt_sat."' ";
					
					}else{
						
						  $query="UPDATE payroll SET payroll_no_of_working_days='".$totDays."', payroll_no_of_worked='".$working_day."', payroll_no_of_leaves='".$resultData['emp_leave']."', payroll_basic_pay='".$resultData['employee_basic_pay']."',payroll_allowance_amount='".$resultData['emp_allowane']."',payroll_overtime_amount='".$ot_amt."',payroll_gov_bouns='".$gov_bouns."', payroll_without_bouns='".$without_bouns."', payroll_exp_bouns='".$exp_bouns."',payroll_earning_amount='".$total_earnings."',payroll_advance_amount='".$resultData['emp_advance']."',payroll_loss_of_pay='".$loss_of_pay."',payroll_deduction_amount='".$total_deduct."',payroll_net_amount='".$net_salary."',payroll_branch_id='$bC', payroll_modified_by='$by', payroll_modified_on=NOW(), payroll_modified_ip='$ip',payroll_bonus_amnt='".$employee_bonus_amnt."',payroll_no_of_overtime_saturday='".$ot_amt_sat."' where payroll_id ='".$ex_empid['payroll_id']."' ";
						
					}	
					$qry = mysql_query($query);
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
				
			}//////end while
		 
		if(empty($rollBack)){	
			mysql_query("COMMIT");	
			if(empty($_REQUEST['id'])){
				pageRedirection("payroll/index.php?msg=1");	
			}else{
				pageRedirection("payroll/index.php?msg=2");	
			}		
		}else{	
			mysql_query("ROLLBACK");
			
		}
			
	}
	
	
	function listPayroll()
	{	
	  	$select_payroll = "SELECT payroll_id, payroll_month, payroll_year FROM payroll 
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
	
	
	function listEmployee($mnth,$year)
	{
		$date = $year.'-'.$mnth.'-01'; 
		 $query = "SELECT employee_id, employee_name FROM employees 
						WHERE employee_deleted_status=0 ORDER BY employee_id ASC";
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
	}
	
	function countOvertime($month, $year, $employee_id){
		$from_date 	= $year.'-'.$month.'-01'; 
		$to_date 	= $year.'-'.$month.'-31'; 
  		 $select_ot_count = "SELECT TIMEDIFF(ot_endtime,ot_starttime) as dif FROM 0   WHERE ot_employee_id = '".$employee_id."' AND ot_deleted_status = 0"; 
		$result_ot_count = mysql_query($select_ot_count);
		$total_time		 = 0;
		while($record_ot_count = mysql_fetch_array($result_ot_count))
		{
			//echo $record_ot_count['dif']; exit;
			list($hour, $minute) = explode(':', $record_ot_count['dif']);
			$minutes += $hour * 60;
			$minutes += $minute;
			$total_time	= $total_time+$record_ot_count['dif'];
		}
		 $hours = floor($minutes / 60);
			return $hours.".".$minutes;

	}
	function get_ot($Eid,$yearmonth){
	$select="SELECT sum(ot_amount) as otamt FROM emp_overtime WHERE ot_employee_id ='".$Eid."' AND ot_deleted_status=0 AND DATE_FORMAT(ot_date ,'%Y-%m') ='".$yearmonth."' ";
	//echo $select;exit;
	$query1=mysql_query($select);
	$query=mysql_fetch_array($query1);
	return $query['otamt'];
	}
	
	function get_ot_sat($Eid,$yearmonth){
	$select="SELECT sum(ot_amount) as otamt FROM emp_overtime WHERE ot_employee_id ='".$Eid."' AND ot_deleted_status=0 AND DATE_FORMAT(ot_date ,'%Y-%m') ='".$yearmonth."' AND DAYNAME(ot_date)='Saturday' ";
	
	$query1=mysql_query($select);
	$query=mysql_fetch_array($query1);
	return $query['otamt'];
	}
	
	function get_leave($Eid,$yearmonth){
	  $select="SELECT sum(lv_paymentid) as otamt FROM  emp_leave WHERE lv_deleted_status =0 AND lv_employee_id ='".$Eid."' AND DATE_FORMAT(lv_date ,'%Y-%m') ='".$yearmonth."'  ";
	//echo $select;exit;
	$query1=mysql_query($select);
	$query=mysql_fetch_array($query1);
	return $query['otamt'];  
	}
?>