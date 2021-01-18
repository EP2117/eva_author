<?php
date_default_timezone_set("Asia/Kolkata");
require_once 'payroll-model-pdf.php';
$employee_id = $_GET['employee_id'];
$month = $_GET['month'];
$year = $_GET['year'];
$payroll_detail = getPaySlip($employee_id,$month,$year);
?>
 <link type="text/css" rel="stylesheet" href="<?php echo PROJECT_PATH; ?>/css/report-style.css" media="screen">
<div class="page">
<table style="width: 98%;" cellspacing="0"  class="report-outer-table">
 	 
   <tr>
   <td   style="width:100%; text-align:center; font-size:16px; font-weight:bold; padding-bottom:10px;" ><strong>PAYSLIP FOR THE MONTH OF <?php echo strtoupper(date("F", mktime(0, 0, 0, $month, 10)))."'".$year;?> </strong></td>
   </tr>	
</table>
 <table cellspacing="0" style="width:98%; " class="report-table-border-bottom">
 <tr>
   <td style="width:50%;" class="report-table-view-font report-border-left"><table cellspacing="0" style="width:100%;" >
     <tr>
       <td class="report-table-view-font" style="width:50%; padding:3px"><strong>Name of the Employee </strong></td>
       <td style="width:50%; padding:3px" class="report-table-view-font"><span class="report-table-view-font" style="width:50%; padding:3px"><?php echo ucwords($payroll_detail['employee_name']);?></span></td>
     </tr>
     <tr>
       <td class="report-table-view-font" style="width:50%; padding:3px"><strong>Employee Code </strong></td>
       <td style="width:50%; padding:3px" class="report-table-view-font"><span class="report-table-view-font" style="width:50%; padding:3px"><?php echo $payroll_detail['employee_id'];?></span></td>
     </tr>
     
     <tr>
       <td class="report-table-view-font" style="width:50%; padding:3px"><strong>Month</strong></td>
       <td style="width:50%; padding:3px" class="report-table-view-font"><?php echo date("F", mktime(0, 0, 0, $month, 10));?></td>
     </tr>
     
    <!-- <tr>
       <td class="report-table-view-font" style="width:50%; padding:3px"><strong>Designation</strong></td>
       <td style="width:50%; padding:3px" class="report-table-view-font "><?php //echo ucwords($payroll_detail['designation']);?></td>
     </tr>-->
       
   </table></td>
    <td style="width:50%;" class="report-table-view-font report-border-right" valign="top">
	<table cellspacing="0" style="width:100%;">
      <tr>
        <td class="report-table-view-font" style="width:50%; padding:3px"><strong>No of Days in the Month </strong></td>
        <td style="width:50%; padding:3px" class="report-table-view-font "><?php echo round($payroll_detail['payroll_no_of_working_days']);?></td>
      </tr>
      <tr>
        <td class="report-table-view-font" style="width:50%; padding:3px"><strong>No of Days Worked  </strong></td>
        <td style="width:50%; padding:3px" class="report-table-view-font "><?php echo number_format($payroll_detail['payroll_no_of_worked'],1);?></td>
      </tr>
      <tr>
        <td class="report-table-view-font" style="width:50%; padding:3px"><strong>Leave Taken </strong></td>
        <td style="width:50%; padding:3px" class="report-table-view-font "><?php echo number_format($payroll_detail['payroll_no_of_leaves'],1);?></td>
      </tr>
      
     <!-- <tr>
        <td class="report-table-view-font" style="width:50%; padding:3px"><strong>Department</strong></td>
        <td style="width:50%; padding:3px" class="report-table-view-font "><?php //echo ucwords($payroll_detail['department_name']);?></td>
      </tr>-->
    </table></td>
   </tr>
  </table> 
  <table cellspacing="0" style="width:98%; " class="report-table-border-bottom">
<tr>
   <td style="width:50%;" class="report-table-view-font report-border-left report-border-right" valign="top"><table cellspacing="0" style="width:100%;" >
     
     <tr>
       <td class="report-table-view-font report-border-right report-border-bottom" style="width:50%; padding:3px"><strong>Earning</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font report-border-bottom"><strong>Amount </strong></td>
     </tr>
     <tr>
       <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>Basic Pay </strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font"><?php echo $payroll_detail['payroll_basic_pay'];?></td>
     </tr>
	  <?php if($payroll_detail['payroll_allowance_amount']>0){ ?>
     <tr>
       <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>Allowance</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font"><?php echo $payroll_detail['payroll_allowance_amount'];?></td>
     </tr>
	  <?php } ?>
	 <?php if($payroll_detail['payroll_overtime_amount']>0){ ?>
	 <tr>
       <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>OT Amount</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font"><?php echo $payroll_detail['payroll_overtime_amount'];?></td>
     </tr>
	 <?php } ?>
     <?php if($payroll_detail['payroll_no_of_overtime_saturday']>0){ ?>
	 <tr>
       <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>OT Saturday Amount</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font"><?php echo $payroll_detail['payroll_no_of_overtime_saturday'];?></td>
     </tr>
	 <?php } ?>
	 <?php if($payroll_detail['payroll_gov_bouns']>0){ ?>
	 <tr>
       <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>Supporting Pay</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font"><?php echo $payroll_detail['payroll_gov_bouns'];?></td>
     </tr>
	 <?php } ?>
	 <?php if($payroll_detail['payroll_without_bouns']>0){ ?>
	 <tr>
       <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>Without Leave Bonus</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font"><?php echo $payroll_detail['payroll_without_bouns'];?></td>
     </tr>
	 <?php } ?>
	 <?php if($payroll_detail['payroll_exp_bouns']>0){ ?>
	 <tr>
       <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>Exp bonus</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font"><?php echo $payroll_detail['payroll_exp_bouns'];?></td>
     </tr>
	 <?php } ?>
      <?php if($payroll_detail['payroll_bonus_amnt']>0){ ?>
	 <tr>
       <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>Other Bonus</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font"><?php echo $payroll_detail['payroll_bonus_amnt'];?></td>
     </tr>
	 <?php } ?>
     <tr>
       <td class="report-border-top report-border-right report-table-view-font" style="width:50%; padding:3px"><strong>Total</strong></td>
       <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font report-border-top"><span style="width:25%; padding:5px; text-align:right"><strong><?php echo number_format($payroll_detail['payroll_earning_amount'],2);?></strong></span></td>
     </tr>
     
     
       
   </table></td>
    <td style="width:50%;" class="report-table-view-font report-border-right" valign="top">
	<table cellspacing="0" style="width:100%; ">
      
      <tr>
        <td class="report-table-view-font report-border-right report-border-bottom" style="width:50%; padding:3px"><strong>Deductions</strong></td>
        <td style="width:50%; padding:3px; text-align:right" class="report-table-view-font report-border-bottom"><strong>Amount  </strong></td>
      </tr>
	   <?php if($payroll_detail['payroll_advance_amount']>0){ ?>
      <tr>
        <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>Advance Amount </strong></td>
        <td style="width:50%; padding:3px;text-align:right" class="report-table-view-font "><?php echo number_format($payroll_detail['payroll_advance_amount'],2);?></td>
      </tr>
	  <?php } ?>
	 
	  <?php if($payroll_detail['payroll_loss_of_pay']>0){ ?>
      <tr>
        <td class="report-table-view-font report-border-right" style="width:50%; padding:3px"><strong>Loss Of Pay </strong></td>
        <td style="width:50%; padding:3px;text-align:right" class="report-table-view-font "><?php echo number_format($payroll_detail['payroll_loss_of_pay'],2);?></td>
      </tr>
	  <?php } ?>
      <tr>
        <td class="report-table-view-font report-border-right  report-border-top" style="width:50%; padding:3px"><strong>Total</strong></td>
        <td style="width:50%; padding:3px;text-align:right" class="report-table-view-font  report-border-top"><span class="report-border-right" style="width:25%; padding:5px; text-align:right"><strong><?php echo number_format($payroll_detail['payroll_deduction_amount'],2);?></strong></span></td>
      </tr>
    </table></td>
   </tr>
  </table>
  <table cellspacing="0" style="width:98%; " class="report-table-border-bottom">
 
 <tr>
   <td style="width:25%; padding:5px; text-align:left" class="report-border-left"><strong>&nbsp; </strong></td>
   <td style="width:25%; padding:5px; text-align:right">&nbsp;</td>
   <td style="width:25%; padding:5px; padding-left:32px; text-align:left" class="report-background"><strong>Net take-home pay </strong></td>
   <td style="width:25%; padding:5px; text-align:right" class="report-border-right report-background" ><strong> <?php echo number_format($payroll_detail['payroll_net_amount'],2);?></strong></td>
 </tr>
  </table>
</div>
