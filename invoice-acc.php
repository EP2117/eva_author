<?php 
	require('includes/config/config.php');

	require_once('includes/config/utility-class.php');
	$branch_id=4;
	$select ="SELECT COUNT(`acc_transaction_voucher_id`) as CNT_TO ,`acc_transaction_voucher_id`,acc_transaction_date  FROM `acc_transaction` WHERE `acc_transaction_deleted_status`=0 AND `acc_transaction_date` BETWEEN '2018-10-13' AND '2018-10-17' AND acc_transaction_type in('direct_Invoice','collection')  GROUP BY acc_transaction_voucher_id  HAVING  CNT_TO >2";
	$query=mysql_query($select);
	$sno=1;
	while($inv_row=mysql_fetch_array($query)){
		
		
		
	 	$Update_acc="UPDATE acc_transaction SET acc_transaction_deleted_status=1  WHERE acc_transaction_voucher_id='".$inv_row['acc_transaction_voucher_id']."' AND acc_transaction_type in('Collection') ";
		mysql_query($Update_acc);
	$sno++;	
	}
	echo 'successfully'.$sno;
?>

