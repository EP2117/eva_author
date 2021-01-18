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

	function insertCustomer(){

		$customer_code                   	= trim($_POST['customer_code']);

		$customer_name                   	= trim($_POST['customer_name']);

		$customer_company_name             	= trim($_POST['customer_company_name']);

		$customer_billing_address          	= trim($_POST['customer_billing_address']);

		$customer_shipping_address         	= trim($_POST['customer_shipping_address']);

		$customer_contact_no              	= trim($_POST['customer_contact_no']);

		$customer_email                  	= trim($_POST['customer_email']);

		$customer_country_id 				= trim($_POST['customer_country_id']);

		$customer_state_id             		= trim($_POST['customer_state_id']);

		$customer_line_phone				= trim($_POST['customer_line_phone']);

		$customer_city_id             		= trim($_POST['customer_city_id']);

		$customer_zip_code        			= trim($_POST['customer_zip_code']);

		$customer_fax_no                 	= trim($_POST['customer_fax_no']);

		$customer_mobile_no                	= trim($_POST['customer_mobile_no']);
		$customer_code_gen                	= trim($_POST['customer_code_gen']);
		

		$customer_currency_id            	= trim($_POST['customer_currency_id']);

		$customer_minimum_credit_per_day    = trim($_POST['customer_minimum_credit_per_day']);

		$customer_block_status            	= trim($_POST['customer_block_status']);

		$customer_location            		= trim($_POST['customer_location']);

		$customer_minimum_sales_limit       = trim($_POST['customer_minimum_sales_limit']);

		$customer_customer_type_id          = trim($_POST['customer_customer_type_id']);

		$customer_total_credit_limit        = trim($_POST['customer_total_credit_limit']);

		$customer_payment_days        		= trim($_POST['customer_payment_days']);

		$customer_active_status        		= trim($_POST['customer_active_status']);

		

		//Multi Contact

		$customer_multi_contact_title      	= $_POST['customer_multi_contact_title'];

		$customer_multi_contact_name       	= $_POST['customer_multi_contact_name'];

		$customer_multi_contact_department 	= $_POST['customer_multi_contact_department'];

		$customer_multi_contact_mobile_no  	= $_POST['customer_multi_contact_mobile_no'];

		$customer_multi_contact_email      	= $_POST['customer_multi_contact_email'];

		$customer_multi_contact_extn_no   	= $_POST['customer_multi_contact_extn_no'];

		

		$request_fields 					= ((!empty($customer_name)) && (!empty($customer_billing_address)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "customer/index.php?page=add");

		$customer_uniq_id					= generateUniqId();

		$ip									= getRealIpAddr();
							
							
				

		 $insert_customer 					= sprintf("INSERT INTO customers  (customer_uniq_id, customer_code,customer_name, 

																			   customer_company_name, customer_billing_address, customer_shipping_address,

																			   customer_contact_no,customer_email,customer_country_id,

																			   customer_state_id,customer_line_phone,customer_city_id,

																			   customer_zip_code,customer_fax_no,customer_mobile_no, 

																			   customer_currency_id,customer_minimum_credit_per_day,customer_block_status,

																			   customer_location,customer_minimum_sales_limit,customer_customer_type_id,

																			   customer_total_credit_limit,customer_payment_days,customer_active_status,

																			   customer_added_by,customer_added_on,customer_added_ip,

																			   customer_company_id,customer_code_gen) 

																	VALUES 	 ('%s', '%s', '%s', 

																			  '%s', '%s', '%s', 

																			  '%s', '%s', '%d',

																			  '%d', '%s', '%d',

																			  '%s', '%s', '%s',

																			  '%d', '%f', '%d',

																			  '%d', '%f', '%d',

																			  '%f', '%d', '%s',

																			  '%s',  UNIX_TIMESTAMP(NOW()), '%d',

																			  '%d', '%d')", 

																		  	   $customer_uniq_id, $customer_code,$customer_name, 

																			   $customer_company_name, $customer_billing_address, $customer_shipping_address,

																			   $customer_contact_no,$customer_email,$customer_country_id,

																			   $customer_state_id,$customer_line_phone,$customer_city_id,

																			   $customer_zip_code,$customer_fax_no,$customer_mobile_no, 

																			   $customer_currency_id,$customer_minimum_credit_per_day,$customer_block_status,

																			   $customer_location,$customer_minimum_sales_limit,$customer_customer_type_id,

																			   $customer_total_credit_limit,$customer_payment_days,$customer_active_status,

																			   $_SESSION[SESS.'_session_user_id'],$ip, $_SESSION[SESS.'_session_company_id'],
																			   $customer_code_gen); 

		mysql_query($insert_customer);

		$customer_id 						= mysql_insert_id(); 
		
		$select_acc_group = "SELECT account_head_id FROM account_heads
												WHERE account_head_name	 like 'Sundry Debtors' 
												AND account_head_deleted_status = '0' LIMIT 1";
							
							$result_acc_group = mysql_query($select_acc_group);
							
							$row_acc_group = mysql_fetch_array($result_acc_group);
							
							$account_head_id = $row_acc_group['account_head_id'];
		
		$insert_accounts = "INSERT INTO account_sub(account_sub_name,account_sub_head_id,account_sub_code_type,account_sub_company_id,account_sub_added_by, 
															account_sub_added_on,account_sub_added_ip,account_sub_master_id) 
													VALUES ('".$customer_name."', '".$account_head_id."','customer','".$_SESSION[SESS.'_session_company_id']."',
															'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$customer_id."')";
															
		mysql_query($insert_accounts);

		for($i=0; $i<count($customer_multi_contact_title); $i++) {

		

			if((!empty($customer_multi_contact_title[$i])) && (!empty($customer_multi_contact_name[$i])) && (!empty($customer_multi_contact_department[$i])) && (!empty($customer_multi_contact_mobile_no[$i]))) {

				 $insert_customer_multi_contact = "INSERT INTO customer_multi_contacts (customer_multi_contact_customer_id,

																						customer_multi_contact_title, customer_multi_contact_name,

																						customer_multi_contact_department,																	                                  														customer_multi_contact_mobile_no,customer_multi_contact_email,

																						customer_multi_contact_extn_no,customer_multi_contact_added_by,                                 														customer_multi_contact_added_on,customer_multi_contact_added_ip) 

																				 VALUES ('".$customer_id."','".$customer_multi_contact_title[$i]."',

																						'".$customer_multi_contact_name[$i]."','".$customer_multi_contact_department[$i]."',

																						'".$customer_multi_contact_mobile_no[$i]."','".$customer_multi_contact_email[$i]."',

																						'".$customer_multi_contact_extn_no[$i]."',

																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 

				 mysql_query($insert_customer_multi_contact); 

		   }

		} 

		pageRedirection("customer/index.php?page=add");

	}

	function listCustomer(){

		$select_branch		=	"SELECT 

									customer_id,

									customer_name,

									customer_code,

									customer_contact_no,

									customer_uniq_id,

									customer_email ,
									customer_mobile_no,
									customer_billing_address,

									customer_company_name

								 FROM 

									customers 

								 WHERE 

									customer_deleted_status 	= 	0 AND 

									customer_active_status 	=	'active'

								 ORDER BY 

									customer_id ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$customer_data 		= array();
		$i					= 0;
		
		while ($record_branch = mysql_fetch_array($result_branch))

		{

		   $customer_data[] 	= $record_branch;
			/*$branch_code = 'C'.substr(('000000'.++$i),-6);
			mysql_query("UPDATE
							customers
						SET
							customer_code	= '".$branch_code."',
							customer_code_gen	= '2'
						WHERE
							customer_id		= '".$record_branch['customer_id']."'");*/
		}

		return $customer_data;

	}

	function editCustomer(){

		$customer_id 			= getId('customers', 'customer_id', 'customer_uniq_id', dataValidation($_GET['id'])); 

		$select_branch		=	"SELECT 

									customer_id,

									customer_name,

									customer_code,

									customer_contact_no,

									customer_uniq_id,

									customer_email,

									customer_company_name,

									customer_mobile_no,

									customer_billing_address,

									customer_shipping_address,

									customer_country_id,

									customer_state_id,

									customer_city_id,

									customer_line_phone,

									customer_zip_code,

									customer_fax_no,

									customer_currency_id,

									customer_minimum_credit_per_day,

									customer_block_status,

									customer_location,

									customer_minimum_sales_limit,

									customer_customer_type_id,

									customer_total_credit_limit,

									customer_payment_days,

									customer_active_status 

								 FROM 

									customers 

								 WHERE 

									customer_deleted_status 	=  0 			AND 

									customer_active_status 	= 'active'		AND

									customer_id				= '".$customer_id."'

								 ORDER BY 

									customer_name ASC";

		$result_branch 		= mysql_query($select_branch);

		$record_branch 		= mysql_fetch_array($result_branch);

		return $record_branch;

	}

    function editCustomerMultiContact(){

		$customer_id 					= getId('customers', 'customer_id', 'customer_uniq_id', dataValidation($_GET['id'])); 

		$select_customer_multi_contact 	= "SELECT 

											customer_multi_contact_id,

											customer_multi_contact_title,

											customer_multi_contact_name,

											customer_multi_contact_department,

											customer_multi_contact_mobile_no,

											customer_multi_contact_email,

											customer_multi_contact_extn_no,

											customer_multi_contact_customer_id 

										FROM 

											customer_multi_contacts

										WHERE 

											customer_multi_contact_customer_id 		= '".$customer_id."'	 AND 

											customer_multi_contact_deleted_status 	= 0"; 

		$result_customer_multi_contact = mysql_query($select_customer_multi_contact);

		

		// Filling up the array

		$data_customer_multi_contact  = array();

		

		while ($record_customer_multi_contact = mysql_fetch_array($result_customer_multi_contact))

		{

		 $data_customer_multi_contact[] 	= $record_customer_multi_contact;

		}

		return $data_customer_multi_contact;

   }

	function updateCustomer(){

		$customer_id                   		= trim($_POST['customer_id']);

		$customer_uniq_id                	= trim($_POST['customer_uniq_id']);

		$customer_code                   	= trim($_POST['customer_code']);

		$customer_name                   	= trim($_POST['customer_name']);

		$customer_company_name             	= trim($_POST['customer_company_name']);

		$customer_billing_address          	= trim($_POST['customer_billing_address']);

		$customer_shipping_address         	= trim($_POST['customer_shipping_address']);

		$customer_contact_no              	= trim($_POST['customer_contact_no']);

		$customer_email                  	= trim($_POST['customer_email']);

		$customer_country_id 				= trim($_POST['customer_country_id']);

		$customer_state_id             		= trim($_POST['customer_state_id']);

		$customer_line_phone				= trim($_POST['customer_line_phone']);

		$customer_city_id             		= trim($_POST['customer_city_id']);

		$customer_zip_code        			= trim($_POST['customer_zip_code']);

		$customer_fax_no                 	= trim($_POST['customer_fax_no']);

		$customer_mobile_no                	= trim($_POST['customer_mobile_no']);

		

		$customer_currency_id            	= trim($_POST['customer_currency_id']);

		$customer_minimum_credit_per_day    = trim($_POST['customer_minimum_credit_per_day']);

		$customer_block_status            	= trim($_POST['customer_block_status']);

		$customer_location            		= trim($_POST['customer_location']);

		$customer_minimum_sales_limit       = trim($_POST['customer_minimum_sales_limit']);

		$customer_customer_type_id          = trim($_POST['customer_customer_type_id']);

		$customer_total_credit_limit        = trim($_POST['customer_total_credit_limit']);

		$customer_payment_days        		= trim($_POST['customer_payment_days']);

		$customer_active_status        		= trim($_POST['customer_active_status']);

		

		//Multi Contact

		$customer_multi_contact_id      	= $_POST['customer_multi_contact_id'];

		$customer_multi_contact_title      	= $_POST['customer_multi_contact_title'];

		$customer_multi_contact_name       	= $_POST['customer_multi_contact_name'];

		$customer_multi_contact_department 	= $_POST['customer_multi_contact_department'];

		$customer_multi_contact_mobile_no  	= $_POST['customer_multi_contact_mobile_no'];

		$customer_multi_contact_email      	= $_POST['customer_multi_contact_email'];

		$customer_multi_contact_extn_no   	= $_POST['customer_multi_contact_extn_no'];

		$request_fields 					= ((!empty($customer_name)) && (!empty($customer_billing_address)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "customer/index.php?page=edit&id=".$customer_uniq_id);

		$update_customer 					= sprintf("	UPDATE 

															customers 

														SET 

															customer_name 					= '%s',

															customer_company_name 			= '%s',

															customer_billing_address 		= '%s',

															customer_shipping_address 		= '%s',

															customer_country_id 			= '%d',

															customer_state_id 				= '%d',

															customer_city_id 				= '%d',

															customer_fax_no 				= '%s',

															customer_email 					= '%s',

															customer_contact_no 			= '%s',

															customer_zip_code 				= '%s',

															customer_line_phone 			= '%s',

															customer_mobile_no 				= '%s',

															customer_currency_id 			= '%d',

															customer_minimum_credit_per_day = '%f',

															customer_block_status 			= '%d',

															customer_location 				= '%d',

															customer_minimum_sales_limit 	= '%f',

															customer_customer_type_id 		= '%s',

															customer_total_credit_limit 	= '%f',

															customer_payment_days 			= '%d',

															customer_active_status 			= '%s',

															customer_modified_by 			= '%d',

															customer_modified_on 			= UNIX_TIMESTAMP(NOW()),

															customer_modified_ip			= '%s'

														WHERE               

															customer_id             		= '%d'", 

															$customer_name,

															$customer_company_name,

															$customer_billing_address,

															$customer_shipping_address,

															$customer_country_id,

															$customer_state_id,

															$customer_city_id,

															$customer_fax_no,

															$customer_email,

															$customer_contact_no,

															$customer_zip_code,

															$customer_line_phone,

															$customer_mobile_no,

															$customer_currency_id,

															$customer_minimum_credit_per_day,

															$customer_block_status,

															$customer_location	,

															$customer_minimum_sales_limit ,

															$customer_customer_type_id,

															$customer_total_credit_limit,

															$customer_payment_days,

															$customer_active_status,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$customer_id); 

		mysql_query($update_customer);
		
			$update_account = "UPDATE account_sub SET account_sub_name = '".$customer_name."'
						   			WHERE account_sub_master_id = '".$customer_id."' AND
									account_sub_code_type = 'customer' "; 	
		mysql_query($update_account);							

		for($i=0; $i<count($customer_multi_contact_title); $i++) {	

			if(!empty($customer_multi_contact_id[$i])) {

				$update_multi_contact		=	"UPDATE 

													customer_multi_contacts 

												 SET 

													customer_multi_contact_title           	= '".$customer_multi_contact_title[$i]."', 

													customer_multi_contact_name         	= '".$customer_multi_contact_name[$i]."', 

													customer_multi_contact_department   	= '".$customer_multi_contact_department[$i]."', 

													customer_multi_contact_mobile_no    	= '".$customer_multi_contact_mobile_no[$i]."', 

													customer_multi_contact_email        	= '".$customer_multi_contact_email[$i]."', 

													customer_multi_contact_extn_no 	  		= '".$customer_multi_contact_extn_no[$i]."', 

													customer_multi_contact_modified_by      = '".$_SESSION[SESS.'_session_user_id']."', 

													customer_multi_contact_modified_on      = UNIX_TIMESTAMP(NOW()), 

													customer_multi_contact_modified_ip      = '".$ip."' 

								  				WHERE 

													customer_multi_contact_id 				= '".$customer_multi_contact_id[$i]."'";

				mysql_query($update_multi_contact);

			}else {	  

			 if((!empty($customer_multi_contact_title[$i])) && (!empty($customer_multi_contact_name[$i])) && (!empty($customer_multi_contact_department[$i])) && (!empty($customer_multi_contact_mobile_no[$i]))) {

				 $insert_customer_multi_contact = "INSERT INTO customer_multi_contacts (customer_multi_contact_customer_id,

																						customer_multi_contact_title, customer_multi_contact_name,

																						customer_multi_contact_department,																	                                  														customer_multi_contact_mobile_no,customer_multi_contact_email,

																						customer_multi_contact_extn_no,customer_multi_contact_added_by,                                 														customer_multi_contact_added_on,customer_multi_contact_added_ip) 

																				 VALUES ('".$customer_id."','".$customer_multi_contact_title[$i]."',

																						'".$customer_multi_contact_name[$i]."','".$customer_multi_contact_department[$i]."',

																						'".$customer_multi_contact_mobile_no[$i]."','".$customer_multi_contact_email[$i]."',

																						'".$customer_multi_contact_extn_no[$i]."',

																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 

				 mysql_query($insert_customer_multi_contact); 

			}

		   }

		}				  

		pageRedirection("customer/?page=edit&id=$customer_uniq_id");			

	}

    function customer_delete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		
		    $delete_admin_budget ="UPDATE customers SET customer_deleted_status	 = 1 ,
		 												customer_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														customer_deleted_on = UNIX_TIMESTAMP(NOW()),
														customer_deleted_ip = '".$ip."'
						WHERE customer_uniq_id = '".$_REQUEST['select_all'][$i]."' ";
		
		mysql_query($delete_admin_budget);
			header("Location:index.php?msg=6");
		
		
		}
	}
	}
 		

	

?>