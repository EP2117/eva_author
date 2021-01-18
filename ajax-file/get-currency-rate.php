<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
    //customer ID
		$date= $_REQUEST['p_date'];	
		$val   = $_REQUEST['val'];
		$query = "SELECT currency_detail_amount
			 FROM   currency_details
			 LEFT JOIN currencies ON  currency_id =  currency_detail_currency_id				
			 WHERE currency_deleted_status=0 AND currency_detail_date='".NdateDatabaseFormat($date)."' and currency_detail_currency_id LIKE '".$val."' ";
		$result = mysql_query($query);
		$response =array();
		$resultData = mysql_fetch_array($result);	 
		
		echo $resultData['currency_detail_amount'];
?>

			 
 
  

 
 