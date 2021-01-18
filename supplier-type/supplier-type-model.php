
<?php

	function insertCustomertype(){

		$supplier_type_name                   	= trim($_POST['supplier_type_name']);

		$supplier_type_active_status           	= "active";

		$request_fields 						= ((!empty($supplier_type_name)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "supplier-type/index.php?page=add");

		$supplier_type_uniq_id					= generateUniqId();

		$ip										= getRealIpAddr();

		

		$insert_supplier_type 					= sprintf("INSERT INTO supplier_types  (supplier_type_uniq_id, supplier_type_name, 

																						supplier_type_added_by,supplier_type_added_on,  

																						supplier_type_added_ip, supplier_type_company_id) 

																				VALUES ('%s', '%s',

																						'%d', UNIX_TIMESTAMP(NOW()), 

																						'%s', '%d')", 

																						$supplier_type_uniq_id,$supplier_type_name, 

																						$_SESSION[SESS.'_session_user_id'],

																						$ip,$_SESSION[SESS.'_session_company_id']); 

		mysql_query($insert_supplier_type);

		pageRedirection("supplier-type/index.php?page=add");

	}

	function listCustomertype(){

		$select_supplier_type		=	"SELECT 

											supplier_type_id,

											supplier_type_name,

											supplier_type_uniq_id

										 FROM 

											supplier_types 

										 WHERE 

											supplier_type_deleted_status 	= 	0 AND 

											supplier_type_active_status 	=	'active'

										 ORDER BY 

											supplier_type_name ASC";

		$result_supplier_type 		= mysql_query($select_supplier_type);

		// Filling up the array

		$supplier_type_data 		= array();

		while ($record_supplier_type = mysql_fetch_array($result_supplier_type))

		{

		 $supplier_type_data[] 	= $record_supplier_type;

		}

		return $supplier_type_data;

	}

	function editCustomertype(){

		$supplier_type_id 			= getId('supplier_types', 'supplier_type_id', 'supplier_type_uniq_id', dataValidation($_GET['id'])); 

		

		$select_supplier_type		=	"SELECT 

											supplier_type_id,

											supplier_type_name,

											supplier_type_uniq_id

										 FROM 

											supplier_types 

										 WHERE 

											supplier_type_deleted_status 	=  0 			AND 

											supplier_type_active_status 	= 'active'		AND

											supplier_type_id				= '".$supplier_type_id."'

										 ORDER BY 

											supplier_type_name ASC";

		$result_supplier_type 		= mysql_query($select_supplier_type);

		$record_supplier_type 		= mysql_fetch_array($result_supplier_type);

		return $record_supplier_type;

	}

	function updateCustomertype(){

		$supplier_type_id                   	= trim($_POST['supplier_type_id']);

		$supplier_type_uniq_id                	= trim($_POST['supplier_type_uniq_id']);

		$supplier_type_name                   	= trim($_POST['supplier_type_name']);

		$request_fields 						= ((!empty($supplier_type_name)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "supplier-type/index.php?page=edit&id=".$supplier_type_uniq_id);

		$update_supplier_type 					= sprintf("	UPDATE 

																supplier_types 

															SET 

																supplier_type_name 				= '%s',

																supplier_type_modified_by 		= '%d',

																supplier_type_modified_on 		= UNIX_TIMESTAMP(NOW()),

																supplier_type_modified_ip		= '%s'

															WHERE               

																supplier_type_id             	= '%d'

																			 ", 

																$supplier_type_name, 

																$_SESSION[SESS.'_session_user_id'], 

																$ip, 

																$supplier_type_id);

		mysql_query($update_supplier_type);

		pageRedirection("supplier-type/?page=edit&id=$supplier_type_uniq_id");			

		

	}

	function asupplier_delete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		
		    $delete_admin_budget ="UPDATE supplier_types SET supplier_type_deleted_status	 = 1 ,
		 												supplier_type_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														supplier_type_deleted_on = UNIX_TIMESTAMP(NOW()),
														supplier_type_deleted_ip = '".$ip."'
						WHERE supplier_type_uniq_id = '".$_REQUEST['select_all'][$i]."' ";
		
		mysql_query($delete_admin_budget);
			header("Location:index.php?msg=6");
		
		
		}
	}
	}

?>
