<?php   

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');



$inv_date = NdateDatabaseFormat($_GET["inv_date"]);

$cr_day = $_GET["cr_day"];







if(!empty($inv_date)){



 $date = strtotime("+".$cr_day." days", strtotime($inv_date));

    echo  trim(date("d/m/Y", $date));

	





} 







 

  