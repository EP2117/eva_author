<?php

	function insertCustomertype(){

		$customer_type_name                   	= trim($_POST['customer_type_name']);

		$customer_type_active_status           	= "active";

		$request_fields 						= ((!empty($customer_type_name)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "customer-type/index.php?page=add");

		$customer_type_uniq_id					= generateUniqId();

		$ip										= getRealIpAddr();

		

		$insert_customer_type 					= sprintf("INSERT INTO customer_types  (customer_type_uniq_id, customer_type_name, 

																						customer_type_added_by,customer_type_added_on,  

																						customer_type_added_ip, customer_type_company_id) 

																				VALUES ('%s', '%s',

																						'%d', UNIX_TIMESTAMP(NOW()), 

																						'%s', '%d')", 

																						$customer_type_uniq_id,$customer_type_name, 

																						$_SESSION[SESS.'_session_user_id'],

																						$ip,$_SESSION[SESS.'_session_company_id']); 

		mysql_query($insert_customer_type);

		pageRedirection("customer-type/index.php?page=add");

	}

	function listCustomertype(){

		$select_customer_type		=	"SELECT 

											customer_type_id,

											customer_type_name,

											customer_type_uniq_id

										 FROM 

											customer_types 

										 WHERE 

											customer_type_deleted_status 	= 	0 AND 

											customer_type_active_status 	=	'active'

										 ORDER BY 

											customer_type_name ASC";

		$result_customer_type 		= mysql_query($select_customer_type);

		// Filling up the array

		$customer_type_data 		= array();

		while ($record_customer_type = mysql_fetch_array($result_customer_type))

		{

		 $customer_type_data[] 	= $record_customer_type;

		}

		return $customer_type_data;

	}

	function editCustomertype(){

		$customer_type_id 			= getId('customer_types', 'customer_type_id', 'customer_type_uniq_id', dataValidation($_GET['id'])); 

		

		$select_customer_type		=	"SELECT 

											customer_type_id,

											customer_type_name,

											customer_type_uniq_id

										 FROM 

											customer_types 

										 WHERE 

											customer_type_deleted_status 	=  0 			AND 

											customer_type_active_status 	= 'active'		AND

											customer_type_id				= '".$customer_type_id."'

										 ORDER BY 

											customer_type_name ASC";

		$result_customer_type 		= mysql_query($select_customer_type);

		$record_customer_type 		= mysql_fetch_array($result_customer_type);

		return $record_customer_type;

	}

	function updateCustomertype(){

		$customer_type_id                   	= trim($_POST['customer_type_id']);

		$customer_type_uniq_id                	= trim($_POST['customer_type_uniq_id']);

		$customer_type_name                   	= trim($_POST['customer_type_name']);

		$request_fields 						= ((!empty($customer_type_name)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "customer-type/index.php?page=edit&id=".$customer_type_uniq_id);

		$update_customer_type 					= sprintf("	UPDATE 

																customer_types 

															SET 

																customer_type_name 				= '%s',

																customer_type_modified_by 		= '%d',

																customer_type_modified_on 		= UNIX_TIMESTAMP(NOW()),

																customer_type_modified_ip		= '%s'

															WHERE               

																customer_type_id             	= '%d'

																			 ", 

																$customer_type_name, 

																$_SESSION[SESS.'_session_user_id'], 

																$ip, 

																$customer_type_id);

		mysql_query($update_customer_type);

		pageRedirection("customer-type/?page=edit&id=$customer_type_uniq_id");			

		

	}
	function customer_delete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		
		    $delete_admin_budget ="UPDATE customer_types SET customer_type_deleted_status	 = 1 ,
		 												customer_type_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														customer_type_deleted_on = UNIX_TIMESTAMP(NOW()),
														customer_type_deleted_ip = '".$ip."'
						WHERE customer_type_uniq_id = '".$_REQUEST['select_all'][$i]."' ";
		
		mysql_query($delete_admin_budget);
			header("Location:index.php?msg=6");
		
		
		}
	}
	}

?>