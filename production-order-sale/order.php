<?php

	require_once('../includes/config/config.php');
	$order_id = $_GET['order_id'];
	$reset_po = mysql_query("UPDATE production_order_product_details SET production_order_product_detail_po_qty = 0, production_order_product_detail_non_po_qty = 0, production_order_product_detail_po_done = 0 WHERE production_order_product_detail_production_order_id = ".$order_id) or die(mysql_error());
	
	$reset_status = mysql_query("UPDATE production_order SET production_order_process_status = 0 WHERE production_order_id = ".$order_id) or die(mysql_error());
	
	echo "success";
?>