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
	function insertvendor(){
		$vendor_code                   	    = trim($_POST['vendor_code']);
		$vendor_name                   	    = trim($_POST['vendor_name']);
		$vendor_address             	    = trim($_POST['vendor_address']);
		$vendor_contact_no          	    = trim($_POST['vendor_contact_no']);
		$vendor_service         	        = trim($_POST['vendor_service']);
		$vendor_spi_in              	    = trim($_POST['vendor_spi_in']);
		$vendor_payment_mode                = trim($_POST['vendor_payment_mode']);
		$vendor_payment_day 				= trim($_POST['vendor_payment_day']);
		$vendor_contract_no             	= trim($_POST['vendor_contract_no']);
		$vendor_contract_vaild_from			= dateDatabaseFormat($_POST['vendor_contract_vaild_from']);
		$vendor_contract_expire_date        = dateDatabaseFormat($_POST['vendor_contract_expire_date']);
		$vendor_active_status        		= trim($_POST['vendor_active_status']);
	
		
	
		
		//Multi Contact
		$vendor_detail_contact_person      		= $_POST['vendor_detail_contact_person'];
		$vendor_detail_designation       		= $_POST['vendor_detail_designation'];
		$vendor_detail_contact_no 		        = $_POST['vendor_detail_contact_no'];
		
		$request_fields 					= ((!empty($vendor_name)) && (!empty($vendor_address)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "vendor/index.php?page=add");
		$vendor_uniq_id					= generateUniqId();
		$ip									= getRealIpAddr();
		
		$insert_vendor					= sprintf("INSERT INTO vendors  (vendor_uniq_id, vendor_code,vendor_name,
		                                                                   vendor_contact_no,vendor_address,vendor_service,
		                                                                   vendor_spi_in,vendor_payment_mode,vendor_payment_day,
		                                                                   vendor_contract_no,vendor_contract_vaild_from,
		                                                                   vendor_contract_expire_date,vendor_active_status,
		                                                                   vendor_added_by,vendor_added_on,vendor_added_ip,
		                                                                   vendor_company_id) 
																	VALUES 	 ('%s', '%s', '%s', 
																			  '%d', '%s', '%s', 
																			  '%s', '%d', '%d',
																			  '%s', '%s', '%s',
																			  '%d', 
																			  '%d',  UNIX_TIMESTAMP(NOW()), '%s',
																			  '%d')", 
																		  	   $vendor_uniq_id, $vendor_code,$vendor_name, 
																			   $vendor_contact_no, $vendor_address, $vendor_service,
																			   $vendor_spi_in,$vendor_payment_mode,$vendor_payment_day,
																			   $vendor_contact_no,$vendor_contract_vaild_from,
																			   $vendor_contract_expire_date,$vendor_active_status,
																			   $_SESSION[SESS.'_session_user_id'],$ip, $_SESSION[SESS.'_session_company_id']);  
		mysql_query($insert_vendor);
		$vendor_id 						= mysql_insert_id(); 
		for($i=0; $i<count($vendor_detail_contact_person); $i++) {
		
			if((!empty($vendor_detail_contact_person[$i])) && (!empty($vendor_detail_contact_no[$i])) ) {
				 $insert_vendor_contact = "INSERT INTO vendor_details (vendor_detail_vendor_id,
																						vendor_detail_contact_person, vendor_detail_designation,
																						vendor_detail_contact_no,												
																						vendor_detail_added_by,
																						vendor_detail_added_on,
																						vendor_detail_added_ip) 
																				 VALUES ('".$vendor_id."','".$vendor_detail_contact_person[$i]."',
																						'".$vendor_detail_designation[$i]."','".$vendor_detail_contact_no[$i]."',
																						
																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 
				 mysql_query($insert_vendor_contact); 
		   }
		} 
		pageRedirection("vendor/index.php?page=add");
	}
	function listvendor(){
     	 	$select_branch		=	"SELECT 
									*
								 FROM 
									vendors 
								 WHERE 
									vendor_active_status 	=  1 AND 
									vendor_status 	=	0
								 ORDER BY 
									vendor_name ASC";
		$result_branch 		= mysql_query($select_branch);
		// Filling up the array
		$customer_data 		= array();
		while ($record_branch = mysql_fetch_array($result_branch))
		{
		 $customer_data[] 	= $record_branch;
		}
		return $customer_data;
	}
	function editvendor(){
		$vendor_id 			= getId('vendors', 'vendor_id', 'vendor_uniq_id', dataValidation($_GET['id'])); 
		 $select_branch		=	"SELECT 
									vendor_id,
									vendor_name,
									vendor_code,
									vendor_contact_no,
									vendor_uniq_id,
								    vendor_address,
								    vendor_service,
								    vendor_spi_in,
								    vendor_payment_mode,
								    vendor_payment_day,
								    vendor_contract_no,
								    vendor_contract_vaild_from,
								    vendor_contract_expire_date,
								    
								
									vendor_active_status 
								 FROM 
									vendors 
								 WHERE 
									vendor_status 	=  0 			AND 
									vendor_active_status 	= 1		AND
									vendor_id				= '".$vendor_id."'
								 ORDER BY 
									vendor_name ASC";
		$result_branch 		= mysql_query($select_branch);
		$record_branch 		= mysql_fetch_array($result_branch);
		return $record_branch;
	}
    function editvendorMultiContact(){
		$vendor_id 			= getId('vendors', 'vendor_id', 'vendor_uniq_id', dataValidation($_GET['id'])); 
		$select_customer_multi_contact 	= "SELECT 
											vendor_detail_id,
											vendor_detail_vendor_id,
											vendor_detail_contact_person,
											vendor_detail_designation,
											vendor_detail_contact_no 
										FROM 
											vendor_details
										WHERE 
											vendor_detail_vendor_id 		= '".$vendor_id."'	 AND 
											vendor_detail_deleted_status 	= 0"; 
		$result_customer_multi_contact = mysql_query($select_customer_multi_contact);
		
		// Filling up the array
		$data_customer_multi_contact  = array();
		
		while ($record_customer_multi_contact = mysql_fetch_array($result_customer_multi_contact))
		{
		 $data_customer_multi_contact[] 	= $record_customer_multi_contact;
		}
		return $data_customer_multi_contact;
   }
	function updatevendor(){
		$vendor_id                          = trim($_POST['vendor_id']);
		$vendor_code                   	    = trim($_POST['vendor_code']);
		$vendor_name                   	    = trim($_POST['vendor_name']);
		$vendor_address             	    = trim($_POST['vendor_address']);
		$vendor_contact_no          	    = trim($_POST['vendor_contact_no']);
		$vendor_service         	        = trim($_POST['vendor_service']);
		$vendor_spi_in              	    = trim($_POST['vendor_spi_in']);
		$vendor_payment_mode                = trim($_POST['vendor_payment_mode']);
		$vendor_payment_day 				= trim($_POST['vendor_payment_day']);
		$vendor_contract_no             	= trim($_POST['vendor_contract_no']);
		$vendor_contract_vaild_from			= dateDatabaseFormat($_POST['vendor_contract_vaild_from']);
		$vendor_contract_expire_date        = dateDatabaseFormat($_POST['vendor_contract_expire_date']);
		$vendor_active_status        		= trim($_POST['vendor_active_status']);
	   
		
	    $vendor_uniq_id  =   $_GET['id']; 
		
		//Multi Contact
		$vendor_detail_contact_person      		= $_POST['vendor_detail_contact_person'];
		$vendor_detail_designation       		= $_POST['vendor_detail_designation'];
		$vendor_detail_contact_no 		        = $_POST['vendor_detail_contact_no'];
		$vendor_detail_id 		                = $_POST['vendor_detail_id'];
		$ip									= getRealIpAddr();
		
		$request_fields 					= ((!empty($vendor_name)) && (!empty($vendor_address)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "vendor/index.php?page=edit&id=".$vendor_uniq_id);
		  $update_vendor 					= sprintf("	UPDATE 
															vendors 
														SET 
															vendor_code 					= '%s',
															vendor_name          			= '%s',
															vendor_address           		= '%s',
															vendor_contact_no 		        = '%d',
															vendor_service 			        = '%d',
															vendor_spi_in 				    = '%s',
															vendor_payment_mode 			= '%d',
															vendor_payment_day 				= '%d',
															vendor_contract_no 				= '%d',
															vendor_contract_vaild_from 		= '%s',
															vendor_contract_expire_date 	= '%s',
														    vendor_active_status         = '%d',           
															vendor_modified_by 			= '%d',
															vendor_modified_on 			= UNIX_TIMESTAMP(NOW()),
															vendor_modified_ip			= '%s'
														WHERE               
															vendor_id             		= '%d'", 
															$vendor_code,
															$vendor_name,
															$vendor_address,
															$vendor_contact_no,
															$vendor_service,
															$vendor_spi_in,
															$vendor_payment_mode,
															$vendor_payment_day,
															$vendor_contract_no,
															$vendor_contract_vaild_from,
															$vendor_contract_expire_date,
															
															$vendor_active_status,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$vendor_id);
		mysql_query($update_vendor);
		for($i=0; $i<count($vendor_detail_contact_person); $i++) {	
			if(!empty($vendor_detail_id[$i])) {
			 	$update_multi_contact		=	"UPDATE 
													vendor_details 
												 SET 
													vendor_detail_contact_person           	= '".$vendor_detail_contact_person[$i]."', 
													vendor_detail_designation         	    = '".$vendor_detail_designation[$i]."', 
													vendor_detail_contact_no   	            = '".$vendor_detail_contact_no[$i]."', 
												 
													vendor_detail_deleted_by      = '".$_SESSION[SESS.'_session_user_id']."', 
													vendor_detail_deleted_on      = UNIX_TIMESTAMP(NOW()), 
													vendor_detail_deleted_ip      = '".$ip."' 
								  				WHERE 
													vendor_detail_id 				= '".$vendor_detail_id[$i]."'";
				mysql_query($update_multi_contact);
			}else {	  
			 if((!empty($vendor_detail_contact_person[$i])) && (!empty($vendor_detail_contact_no[$i])) ) {
				  $insert_customer_multi_contact = "INSERT INTO vendor_details (vendor_detail_contact_person,
																						vendor_detail_designation, vendor_detail_contact_no,
																						vendor_detail_vendor_id,																	                                  														
																						vendor_detail_added_by,vendor_detail_added_on,
																						vendor_detail_added_ip) 
																				 VALUES ('".$vendor_detail_contact_person[$i]."','".$vendor_detail_designation[$i]."',
																						'".$vendor_detail_contact_no[$i]."','".$vendor_id."',
																						
																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 
				 mysql_query($insert_customer_multi_contact); 
			}
		   }
		}				  
		pageRedirection("vendor/index.php?page=edit&id=$vendor_uniq_id");			
	}
    function deleteCustomerMultiContact()
   {
		if((isset($_REQUEST['customer_multi_contact_id'])) && (isset($_REQUEST['customer_uniq_id'])))
		{
			$customer_multi_contact_id 	= $_GET['customer_multi_contact_id'];
			$customer_uniq_id = $_GET['customer_uniq_id'];
			mysql_query("UPDATE customer_multi_contacts SET customer_multi_contact_deleted_status = 1 
						WHERE customer_multi_contact_id = ".$customer_multi_contact_id." ");
			header("Location:index.php?page=edit&id=$customer_uniq_id&msg=6");
		}
		
   } 		
	
?>