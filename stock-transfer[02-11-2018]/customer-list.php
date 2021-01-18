<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$detail_mode			= (isset($_REQUEST['detail_mode']))?$_REQUEST['detail_mode']:'1';
	if($detail_mode==1){
		$select_customer		=	"SELECT 
										customer_id,
										customer_name 
									 FROM 
										customers 
									 WHERE 
										customer_deleted_status 	= 	0 AND 
										customer_active_status 	=	'active'
									 ORDER BY 
										customer_name ASC";
		$result_customer 	=  mysql_query($select_customer);
		$select 		= '<select name="reserve_entry_product_detail_customer_id[]" id="reserve_entry_product_detail_customer_id"  class="form-control select2" >
							<option value=""> - Select - </option>';
		while($record_customer = mysql_fetch_array($result_customer)) {
			$select 	.= '<option value="'.$record_customer['customer_id'].'">'.ucwords($record_customer['customer_name']).'</option>'; 
		}
		$select 		.= '</select>';
		echo $select;
	}
	else{
		$select_salesmode		=	"SELECT 
										salesmode_id,
										salesmode_name 
									 FROM 
										salesmodes 
									 WHERE 
										salesmode_deleted_status 	= 	0 AND 
										salesmode_active_status 	=	'active'
									 ORDER BY 
										salesmode_name ASC";
		$result_salesmode 	=  mysql_query($select_salesmode);
		$select 		= '<select name="reserve_entry_product_detail_customer_id[]" id="reserve_entry_product_detail_customer_id"  class="form-control select2" >
							<option value=""> - Select - </option>';
		while($record_salesmode = mysql_fetch_array($result_salesmode)) {
			$select 	.= '<option value="'.$record_salesmode['salesmode_id'].'">'.ucwords($record_salesmode['salesmode_name']).'</option>'; 
		}
		$select 		.= '</select>';
		echo $select;
	}
?>
