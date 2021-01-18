<?php 

	require_once('../includes/config/config.php');

    //supplier ID

	$product_id  	= $_REQUEST["product_id"];
	 $sql="SELECT COUNT(*) as count_id FROM product_con_entry_child_product_details
		WHERE  product_con_entry_child_product_detail_product_id='".$product_id."'";
		
		$result=mysql_query($sql);
		$res= mysql_fetch_array($result);
		echo $res['count_id'];
?>