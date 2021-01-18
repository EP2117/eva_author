<?php 
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
	
	
	  $select='SELECT * FROM customers WHERE customer_deleted_status=1 ';
	$query=mysql_query($select);
	while($row=mysql_fetch_array($query)){
	
		 $update="UPDATE account_sub SET account_sub_deleted_status=1 WHERE account_sub_master_id='".$row['customer_id']."' AND account_sub_head_id=17";
		mysql_query($update);
	//echo $update;echo '<br/>';
	}
	echo 'successfull';
	
?>
