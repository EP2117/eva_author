<?php   

$mm_yyyy = $_GET["mm_yyyy"];
$month_year_picker = explode('/',$mm_yyyy);
$month = $month_year_picker[0]; 
$year  = $month_year_picker[1];
echo cal_days_in_month(CAL_GREGORIAN, $month, $year).'/'.$month.'/'.$year;





 
  