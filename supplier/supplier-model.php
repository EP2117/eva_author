<?php

	//Country List

	function getStateList($country_id=''){

		$select_state		=	"SELECT 

									state_id,

									state_name 

								 FROM 

									states 

								 WHERE 

									state_deleted_status 	= 0 					AND 

									state_active_status 	= 'active'				AND

									state_country_id		= '".$country_id."'

								 ORDER BY 

									state_name ASC";

									

		$result_state 	= mysql_query($select_state);

		// Filling up the array

		$state_data 	= array();

		while ($record_state = mysql_fetch_array($result_state))

		{

		 $state_data[] 	= $record_state;

		}

		return $state_data;

	}

	function getCityList($state_id=''){

		$select_city		=	"SELECT 

									city_id,

									city_name 

								 FROM 

									cities 

								 WHERE 

									city_deleted_status 	= 0 					AND 

									city_active_status 		= 'active'				AND

									city_state_id			= '".$state_id."'

								 ORDER BY 

									city_name ASC";

		$result_city 	= mysql_query($select_city);

		// Filling up the array

		$city_data 	= array();

		while ($record_city = mysql_fetch_array($result_city))

		{

		 $city_data[] 	= $record_city;

		}

		return $city_data;

	}

	function insertSupplier(){

		$supplier_code                   	= trim($_POST['supplier_code']);

		$supplier_name                   	= trim($_POST['supplier_name']);

		$supplier_company_name             	= trim($_POST['supplier_company_name']);

		$supplier_billing_address          	= trim($_POST['supplier_billing_address']);

		$supplier_shipping_address         	= trim($_POST['supplier_shipping_address']);

		$supplier_contact_no              	= trim($_POST['supplier_contact_no']);

		$supplier_email                  	= trim($_POST['supplier_email']);

		$supplier_country_id 				= trim($_POST['supplier_country_id']);

		$supplier_state_id             		= trim($_POST['supplier_state_id']);

		$supplier_line_phone				= trim($_POST['supplier_line_phone']);

		$supplier_city_id             		= trim($_POST['supplier_city_id']);

		$supplier_zip_code        			= trim($_POST['supplier_zip_code']);

		$supplier_fax_no                 	= trim($_POST['supplier_fax_no']);

		$supplier_mobile_no                	= trim($_POST['supplier_mobile_no']);

		

		$supplier_currency_id            	= trim($_POST['supplier_currency_id']);

		$supplier_minimum_credit_per_day    = trim($_POST['supplier_minimum_credit_per_day']);

		$supplier_block_status            	= trim($_POST['supplier_block_status']);

		$supplier_location            		= trim($_POST['supplier_location']);

		$supplier_minimum_sales_limit       = trim($_POST['supplier_minimum_sales_limit']);

		$supplier_supplier_type_id          = trim($_POST['supplier_supplier_type_id']);

		$supplier_total_credit_limit        = trim($_POST['supplier_total_credit_limit']);

		$supplier_payment_days        		= trim($_POST['supplier_payment_days']);

		$supplier_active_status        		= trim($_POST['supplier_active_status']);

		

		//Multi Contact

		$supplier_multi_contact_title      		= $_POST['supplier_multi_contact_title'];

		$supplier_multi_contact_name       		= $_POST['supplier_multi_contact_name'];

		$supplier_multi_contact_department 		= $_POST['supplier_multi_contact_department'];

		$supplier_multi_contact_mobile_no  		= $_POST['supplier_multi_contact_mobile_no'];

		$supplier_multi_contact_email      		= $_POST['supplier_multi_contact_email'];

		$supplier_multi_contact_extn_no   	   	= $_POST['supplier_multi_contact_extn_no'];

		

		$request_fields 					= ((!empty($supplier_name)) && (!empty($supplier_billing_address)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "supplier/index.php?page=add");

		$supplier_uniq_id					= generateUniqId();

		$ip									= getRealIpAddr();

		$select_acc_group = "SELECT account_head_id FROM account_heads
												WHERE account_head_name	 like 'Sundry Creditors' 
												AND account_head_deleted_status = '0' LIMIT 1";
							
							$result_acc_group = mysql_query($select_acc_group);
							
							$row_acc_group = mysql_fetch_array($result_acc_group);
							
							$account_head_id = $row_acc_group['account_head_id'];

		$insert_supplier 					= sprintf("INSERT INTO suppliers  (supplier_uniq_id, supplier_code,supplier_name, 

																			   supplier_company_name, supplier_billing_address, supplier_shipping_address,

																			   supplier_contact_no,supplier_email,supplier_country_id,

																			   supplier_state_id,supplier_line_phone,supplier_city_id,

																			   supplier_zip_code,supplier_fax_no,supplier_mobile_no, 

																			   supplier_currency_id,supplier_minimum_credit_per_day,supplier_block_status,

																			   supplier_location,supplier_minimum_sales_limit,supplier_supplier_type_id,

																			   supplier_total_credit_limit,supplier_payment_days,supplier_active_status,

																			   supplier_added_by,supplier_added_on,supplier_added_ip,

																			   supplier_company_id) 

																	VALUES 	 ('%s', '%s', '%s', 

																			  '%s', '%s', '%s', 

																			  '%s', '%s', '%d',

																			  '%d', '%s', '%d',

																			  '%s', '%s', '%s',

																			  '%d', '%f', '%d',

																			  '%d', '%f', '%d',

																			  '%f', '%d', '%s',

																			  '%s',  UNIX_TIMESTAMP(NOW()), '%d',

																			  '%d')", 

																		  	   $supplier_uniq_id, $supplier_code,$supplier_name, 

																			   $supplier_company_name, $supplier_billing_address, $supplier_shipping_address,

																			   $supplier_contact_no,$supplier_email,$supplier_country_id,

																			   $supplier_state_id,$supplier_line_phone,$supplier_city_id,

																			   $supplier_zip_code,$supplier_fax_no,$supplier_mobile_no, 

																			   $supplier_currency_id,$supplier_minimum_credit_per_day,$supplier_block_status,

																			   $supplier_location,$supplier_minimum_sales_limit,$supplier_supplier_type_id,

																			   $supplier_total_credit_limit,$supplier_payment_days,$supplier_active_status,

																			   $_SESSION[SESS.'_session_user_id'],$ip, $_SESSION[SESS.'_session_company_id']);  

		mysql_query($insert_supplier);

		$supplier_id 						= mysql_insert_id(); 
		 
		
		$insert_accounts = "INSERT INTO account_sub(account_sub_name,account_sub_head_id,account_sub_code_type,account_sub_company_id,account_sub_added_by, 
															account_sub_added_on,account_sub_added_ip,account_sub_master_id) 
													VALUES ('".$supplier_name."', '".$account_head_id."','supplier','".$_SESSION[SESS.'_session_company_id']."',
															'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$supplier_id."')";
															
		mysql_query($insert_accounts);

		for($i=0; $i<count($supplier_multi_contact_title); $i++) {

		

			if((!empty($supplier_multi_contact_title[$i])) && (!empty($supplier_multi_contact_name[$i])) && (!empty($supplier_multi_contact_department[$i])) && (!empty($supplier_multi_contact_mobile_no[$i]))) {

				 $insert_supplier_multi_contact = "INSERT INTO supplier_multi_contacts (supplier_multi_contact_supplier_id,

																						supplier_multi_contact_title, supplier_multi_contact_name,

																						supplier_multi_contact_department,																	                                  														supplier_multi_contact_mobile_no,supplier_multi_contact_email,

																						supplier_multi_contact_extn_no,supplier_multi_contact_added_by,                                 														supplier_multi_contact_added_on,supplier_multi_contact_added_ip) 

																				 VALUES ('".$supplier_id."','".$supplier_multi_contact_title[$i]."',

																						'".$supplier_multi_contact_name[$i]."','".$supplier_multi_contact_department[$i]."',

																						'".$supplier_multi_contact_mobile_no[$i]."','".$supplier_multi_contact_email[$i]."',

																						'".$supplier_multi_contact_extn_no[$i]."',

																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 

				 mysql_query($insert_supplier_multi_contact); 

		   }

		} 

		pageRedirection("supplier/index.php?page=add");

	}

	function listSupplier(){

		$select_branch		=	"SELECT 

									supplier_id,

									supplier_name,

									supplier_code,

									supplier_contact_no,

									supplier_uniq_id,

									supplier_email ,

									supplier_company_name

								 FROM 

									suppliers 

								 WHERE 

									supplier_deleted_status 	= 	0 AND 

									supplier_active_status 	=	'active'

								 ORDER BY 

									supplier_name ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$supplier_data 		= array();

		while ($record_branch = mysql_fetch_array($result_branch))

		{

		 $supplier_data[] 	= $record_branch;

		}

		return $supplier_data;

	}
	
	function getSuppliertypeList(){

		 $select_branch		=	"SELECT 

									supplier_type_id,

									supplier_type_name

								 FROM 

									supplier_types 

								 WHERE 

									supplier_type_deleted_status 	= 	0 

								
								 ORDER BY 

									supplier_type_name ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$supplier_data 		= array();

		while ($record_branch = mysql_fetch_array($result_branch))

		{

		 $supplier_data[] 	= $record_branch;

		}

		return $supplier_data;

	}

	function editSupplier(){

		$supplier_id 			= getId('suppliers', 'supplier_id', 'supplier_uniq_id', dataValidation($_GET['id'])); 

		$select_branch		=	"SELECT 

									supplier_id,

									supplier_name,

									supplier_code,

									supplier_contact_no,

									supplier_uniq_id,

									supplier_email,

									supplier_company_name,

									supplier_mobile_no,

									supplier_billing_address,

									supplier_shipping_address,

									supplier_country_id,

									supplier_state_id,

									supplier_city_id,

									supplier_line_phone,

									supplier_zip_code,

									supplier_fax_no,

									supplier_currency_id,

									supplier_minimum_credit_per_day,

									supplier_block_status,

									supplier_location,

									supplier_minimum_sales_limit,

									supplier_supplier_type_id,

									supplier_total_credit_limit,

									supplier_payment_days,

									supplier_active_status 

								 FROM 

									suppliers 

								 WHERE 

									supplier_deleted_status 	=  0 			AND 

									supplier_active_status 	= 'active'		AND

									supplier_id				= '".$supplier_id."'

								 ORDER BY 

									supplier_name ASC";

		$result_branch 		= mysql_query($select_branch);

		$record_branch 		= mysql_fetch_array($result_branch);

		return $record_branch;

	}

    function editSupplierMultiContact(){

		$supplier_id 					= getId('suppliers', 'supplier_id', 'supplier_uniq_id', dataValidation($_GET['id'])); 

		$select_supplier_multi_contact 	= "SELECT 

											supplier_multi_contact_id,

											supplier_multi_contact_title,

											supplier_multi_contact_name,

											supplier_multi_contact_department,

											supplier_multi_contact_mobile_no,

											supplier_multi_contact_email,

											supplier_multi_contact_extn_no,

											supplier_multi_contact_supplier_id 

										FROM 

											supplier_multi_contacts

										WHERE 

											supplier_multi_contact_supplier_id 		= '".$supplier_id."'	 AND 

											supplier_multi_contact_deleted_status 	= 0"; 

		$result_supplier_multi_contact = mysql_query($select_supplier_multi_contact);

		

		// Filling up the array

		$data_supplier_multi_contact  = array();

		

		while ($record_supplier_multi_contact = mysql_fetch_array($result_supplier_multi_contact))

		{

		 $data_supplier_multi_contact[] 	= $record_supplier_multi_contact;

		}

		return $data_supplier_multi_contact;

   }

	function updateSupplier(){

		$supplier_id                   		= trim($_POST['supplier_id']);

		$supplier_uniq_id                	= trim($_POST['supplier_uniq_id']);

		$supplier_code                   	= trim($_POST['supplier_code']);

		$supplier_name                   	= trim($_POST['supplier_name']);

		$supplier_company_name             	= trim($_POST['supplier_company_name']);

		$supplier_billing_address          	= trim($_POST['supplier_billing_address']);

		$supplier_shipping_address         	= trim($_POST['supplier_shipping_address']);

		$supplier_contact_no              	= trim($_POST['supplier_contact_no']);

		$supplier_email                  	= trim($_POST['supplier_email']);

		$supplier_country_id 				= trim($_POST['supplier_country_id']);

		$supplier_state_id             		= trim($_POST['supplier_state_id']);

		$supplier_line_phone				= trim($_POST['supplier_line_phone']);

		$supplier_city_id             		= trim($_POST['supplier_city_id']);

		$supplier_zip_code        			= trim($_POST['supplier_zip_code']);

		$supplier_fax_no                 	= trim($_POST['supplier_fax_no']);

		$supplier_mobile_no                	= trim($_POST['supplier_mobile_no']);

		

		$supplier_currency_id            	= trim($_POST['supplier_currency_id']);

		$supplier_minimum_credit_per_day    = trim($_POST['supplier_minimum_credit_per_day']);

		$supplier_block_status            	= trim($_POST['supplier_block_status']);

		$supplier_location            		= trim($_POST['supplier_location']);

		$supplier_minimum_sales_limit       = trim($_POST['supplier_minimum_sales_limit']);

		$supplier_supplier_type_id          = trim($_POST['supplier_supplier_type_id']);

		$supplier_total_credit_limit        = trim($_POST['supplier_total_credit_limit']);

		$supplier_payment_days        		= trim($_POST['supplier_payment_days']);

		$supplier_active_status        		= trim($_POST['supplier_active_status']);

		

		//Multi Contact

		$supplier_multi_contact_id      	= $_POST['supplier_multi_contact_id'];

		$supplier_multi_contact_title      	= $_POST['supplier_multi_contact_title'];

		$supplier_multi_contact_name       	= $_POST['supplier_multi_contact_name'];

		$supplier_multi_contact_department 	= $_POST['supplier_multi_contact_department'];

		$supplier_multi_contact_mobile_no  	= $_POST['supplier_multi_contact_mobile_no'];

		$supplier_multi_contact_email      	= $_POST['supplier_multi_contact_email'];

		$supplier_multi_contact_extn_no   	= $_POST['supplier_multi_contact_extn_no'];

		$request_fields 					= ((!empty($supplier_name)) && (!empty($supplier_billing_address)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "supplier/index.php?page=edit&id=".$supplier_uniq_id);

		$update_supplier 					= sprintf("	UPDATE 

															suppliers 

														SET 

															supplier_name 					= '%s',

															supplier_company_name 			= '%s',

															supplier_billing_address 		= '%s',

															supplier_shipping_address 		= '%s',

															supplier_country_id 			= '%d',

															supplier_state_id 				= '%d',

															supplier_city_id 				= '%d',

															supplier_fax_no 				= '%s',

															supplier_email 					= '%s',

															supplier_contact_no 			= '%s',

															supplier_zip_code 				= '%s',

															supplier_line_phone 			= '%s',

															supplier_mobile_no 				= '%s',

															supplier_currency_id 			= '%d',

															supplier_minimum_credit_per_day = '%f',

															supplier_block_status 			= '%d',

															supplier_location 				= '%d',

															supplier_minimum_sales_limit 	= '%f',

															supplier_supplier_type_id 		= '%s',

															supplier_total_credit_limit 	= '%f',

															supplier_payment_days 			= '%d',

															supplier_active_status 			= '%s',

															supplier_modified_by 			= '%d',

															supplier_modified_on 			= UNIX_TIMESTAMP(NOW()),

															supplier_modified_ip			= '%s'

														WHERE               

															supplier_id             		= '%d'", 

															$supplier_name,

															$supplier_company_name,

															$supplier_billing_address,

															$supplier_shipping_address,

															$supplier_country_id,

															$supplier_state_id,

															$supplier_city_id,

															$supplier_fax_no,

															$supplier_email,

															$supplier_contact_no,

															$supplier_zip_code,

															$supplier_line_phone,

															$supplier_mobile_no,

															$supplier_currency_id,

															$supplier_minimum_credit_per_day,

															$supplier_block_status,

															$supplier_location	,

															$supplier_minimum_sales_limit ,

															$supplier_supplier_type_id,

															$supplier_total_credit_limit,

															$supplier_payment_days,

															$supplier_active_status,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$supplier_id); 

		mysql_query($update_supplier);
		
		$update_account = "UPDATE account_sub SET account_sub_name = '".$supplier_name."'
						   			WHERE account_sub_master_id = '".$supplier_id."' AND
									account_sub_code_type = 'supplier' "; 
									
									mysql_query($update_account);	

		for($i=0; $i<count($supplier_multi_contact_title); $i++) {	

			if(!empty($supplier_multi_contact_id[$i])) {

				$update_multi_contact		=	"UPDATE 

													supplier_multi_contacts 

												 SET 

													supplier_multi_contact_title           	= '".$supplier_multi_contact_title[$i]."', 

													supplier_multi_contact_name         	= '".$supplier_multi_contact_name[$i]."', 

													supplier_multi_contact_department   	= '".$supplier_multi_contact_department[$i]."', 

													supplier_multi_contact_mobile_no    	= '".$supplier_multi_contact_mobile_no[$i]."', 

													supplier_multi_contact_email        	= '".$supplier_multi_contact_email[$i]."', 

													supplier_multi_contact_extn_no 	  		= '".$supplier_multi_contact_extn_no[$i]."', 

													supplier_multi_contact_modified_by      = '".$_SESSION[SESS.'_session_user_id']."', 

													supplier_multi_contact_modified_on      = UNIX_TIMESTAMP(NOW()), 

													supplier_multi_contact_modified_ip      = '".$ip."' 

								  				WHERE 

													supplier_multi_contact_id 				= '".$supplier_multi_contact_id[$i]."'";

				mysql_query($update_multi_contact);

			}else {	  

			 if((!empty($supplier_multi_contact_title[$i])) && (!empty($supplier_multi_contact_name[$i])) && (!empty($supplier_multi_contact_department[$i])) && (!empty($supplier_multi_contact_mobile_no[$i]))) {

				 $insert_supplier_multi_contact = "INSERT INTO supplier_multi_contacts (supplier_multi_contact_supplier_id,

																						supplier_multi_contact_title, supplier_multi_contact_name,

																						supplier_multi_contact_department,																	                                  														supplier_multi_contact_mobile_no,supplier_multi_contact_email,

																						supplier_multi_contact_extn_no,supplier_multi_contact_added_by,                                 														supplier_multi_contact_added_on,supplier_multi_contact_added_ip) 

																				 VALUES ('".$supplier_id."','".$supplier_multi_contact_title[$i]."',

																						'".$supplier_multi_contact_name[$i]."','".$supplier_multi_contact_department[$i]."',

																						'".$supplier_multi_contact_mobile_no[$i]."','".$supplier_multi_contact_email[$i]."',

																						'".$supplier_multi_contact_extn_no[$i]."',

																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 

				 mysql_query($insert_supplier_multi_contact); 

			}

		   }

		}				  

		pageRedirection("supplier/?page=edit&id=$supplier_uniq_id");			

	}

    function deleteSupplierMultiContact()

   {

		if((isset($_REQUEST['supplier_multi_contact_id'])) && (isset($_REQUEST['supplier_uniq_id'])))

		{

			$supplier_multi_contact_id 	= $_GET['supplier_multi_contact_id'];

			$supplier_uniq_id = $_GET['supplier_uniq_id'];

			mysql_query("UPDATE supplier_multi_contacts SET supplier_multi_contact_deleted_status = 1 

						WHERE supplier_multi_contact_id = ".$supplier_multi_contact_id." ");

			header("Location:index.php?page=edit&id=$supplier_uniq_id&msg=6");

		}

		

   } 		

	function supplier_delete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		
		    $delete_admin_budget ="UPDATE suppliers SET supplier_deleted_status	 = 1 ,
		 												supplier_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														supplier_deleted_on = UNIX_TIMESTAMP(NOW()),
														supplier_deleted_ip = '".$ip."'
						WHERE supplier_uniq_id = '".$_REQUEST['select_all'][$i]."' ";
		
		mysql_query($delete_admin_budget);
			header("Location:index.php?msg=6");
		
		
		}
	}
	}

?>