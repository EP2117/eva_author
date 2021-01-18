<?php
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
		$bank_code                   	= trim($_POST['bank_code']);
		$bank_name                   	= trim($_POST['bank_name']);
		$bank_address         			= trim($_POST['bank_address']);
		$bank_email                  	= trim($_POST['bank_email']);
		$bank_country_id 				= trim($_POST['bank_country_id']);
		$bank_state_id             		= trim($_POST['bank_state_id']);
		$bank_city_id             		= trim($_POST['bank_city_id']);
		$bank_zip_code        			= trim($_POST['bank_zip_code']);
		$bank_fax_no                 	= trim($_POST['bank_fax_no']);
		$bank_active_status				= 'active';
		//Multi Contact
		$bank_multi_contact_title      		= $_POST['bank_multi_contact_title'];
		$bank_multi_contact_name       		= $_POST['bank_multi_contact_name'];
		$bank_multi_contact_department 		= $_POST['bank_multi_contact_department'];
		$bank_multi_contact_mobile_no  		= $_POST['bank_multi_contact_mobile_no'];
		$bank_multi_contact_email      		= $_POST['bank_multi_contact_email'];
		$bank_multi_contact_extn_no   	   	= $_POST['bank_multi_contact_extn_no'];
		
		$request_fields 					= ((!empty($bank_name)) && (!empty($bank_address)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "bank/index.php?page=add&msg=2");
		$bank_uniq_id					= generateUniqId();
		$ip									= getRealIpAddr();
		
		$select_acc_group = "SELECT account_head_id FROM account_heads
												WHERE account_head_name	 like 'Bank' 
												AND account_head_deleted_status = '0' LIMIT 1";
		$result_acc_group = mysql_query($select_acc_group);
		
		$row_acc_group = mysql_fetch_array($result_acc_group);
		
		$account_head_id = $row_acc_group['account_head_id'];
		
		
		$insert_bank 					= sprintf("INSERT INTO banks  (bank_uniq_id, bank_code,bank_name, 
																		bank_address,bank_email,bank_country_id,
																		bank_state_id,bank_city_id,bank_zip_code,
																		bank_fax_no,bank_active_status,
																		bank_added_by,bank_added_on,bank_added_ip,
																		bank_company_id) 
																VALUES ('%s', '%s', '%s', 
																		'%s', '%s', '%d',
																		'%d', '%d', '%s',
																		'%s', '%s',
																		'%s',  UNIX_TIMESTAMP(NOW()), '%d',
																		'%d')", 
																		$bank_uniq_id, $bank_code,$bank_name, 
																		$bank_address,$bank_email,$bank_country_id,
																		$bank_state_id,$bank_city_id,$bank_zip_code,
																		$bank_fax_no,$bank_active_status,
																		$_SESSION[SESS.'_session_user_id'],$ip, $_SESSION[SESS.'_session_company_id']);
		//echo $insert_bank; exit;																  
		mysql_query($insert_bank);
		$bank_id 						= mysql_insert_id(); 
		
		
		$insert_accounts = "INSERT INTO account_sub(account_sub_name,account_sub_head_id,account_sub_code_type,account_sub_company_id,account_sub_added_by, 
															account_sub_added_on,account_sub_added_ip,account_sub_master_id,account_sub_type_id) 
													VALUES ('".$bank_name."', '".$account_head_id."','bank','".$_SESSION[SESS.'_session_company_id']."',
															'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$bank_id."', '2')";
															
		mysql_query($insert_accounts);
		
		
		for($i=0; $i<count($bank_multi_contact_title); $i++) {
			if((!empty($bank_multi_contact_title[$i])) && (!empty($bank_multi_contact_name[$i])) && (!empty($bank_multi_contact_department[$i])) && (!empty($bank_multi_contact_mobile_no[$i]))) {
				 $insert_bank_multi_contact = "INSERT INTO bank_multi_contacts (bank_multi_contact_bank_id,
																						bank_multi_contact_title, bank_multi_contact_name,
																						bank_multi_contact_department,																	                                  														bank_multi_contact_mobile_no,bank_multi_contact_email,
																						bank_multi_contact_extn_no,bank_multi_contact_added_by,                                 														
																						bank_multi_contact_added_on,bank_multi_contact_added_ip) 
																				 VALUES ('".$bank_id."','".$bank_multi_contact_title[$i]."',
																						'".$bank_multi_contact_name[$i]."','".$bank_multi_contact_department[$i]."',
																						'".$bank_multi_contact_mobile_no[$i]."','".$bank_multi_contact_email[$i]."',
																						'".$bank_multi_contact_extn_no[$i]."',
																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 
				 mysql_query($insert_bank_multi_contact); 
		   }
		} 
		pageRedirection("bank/index.php?page=add");
	}
	function listCustomer(){
		$select_branch		=	"SELECT 
									bank_id,
									bank_name,
									bank_code,
									bank_uniq_id,
									bank_email 
								 FROM 
									banks 
								 WHERE 
									bank_deleted_status 	= 	0 AND 
									bank_active_status 	=	'active'
								 ORDER BY 
									bank_name ASC";
		$result_branch 		= mysql_query($select_branch);
		// Filling up the array
		$bank_data 		= array();
		while ($record_branch = mysql_fetch_array($result_branch))
		{
		 $bank_data[] 	= $record_branch;
		}
		return $bank_data;
	}
	function editCustomer(){
		$bank_id 			= getId('banks', 'bank_id', 'bank_uniq_id', dataValidation($_GET['id'])); 
		$select_branch		=	"SELECT 
									bank_id,
									bank_name,
									bank_code,
									bank_uniq_id,
									bank_email,
									bank_address,
									bank_country_id,
									bank_state_id,
									bank_city_id,
									bank_zip_code,
									bank_fax_no,
									bank_active_status 
								 FROM 
									banks 
								 WHERE 
									bank_deleted_status 	=  0 			AND 
									bank_active_status 	= 'active'		AND
									bank_id				= '".$bank_id."'
								 ORDER BY 
									bank_name ASC";
		$result_branch 		= mysql_query($select_branch);
		$record_branch 		= mysql_fetch_array($result_branch);
		return $record_branch;
	}
    function editCustomerMultiContact(){
		$bank_id 					= getId('banks', 'bank_id', 'bank_uniq_id', dataValidation($_GET['id'])); 
		$select_bank_multi_contact 	= "SELECT 
											bank_multi_contact_id,
											bank_multi_contact_title,
											bank_multi_contact_name,
											bank_multi_contact_department,
											bank_multi_contact_mobile_no,
											bank_multi_contact_email,
											bank_multi_contact_extn_no,
											bank_multi_contact_bank_id 
										FROM 
											bank_multi_contacts
										WHERE 
											bank_multi_contact_bank_id 		= '".$bank_id."'	 AND 
											bank_multi_contact_deleted_status 	= 0"; 
		$result_bank_multi_contact = mysql_query($select_bank_multi_contact);
		
		// Filling up the array
		$data_bank_multi_contact  = array();
		
		while ($record_bank_multi_contact = mysql_fetch_array($result_bank_multi_contact))
		{
		 $data_bank_multi_contact[] 	= $record_bank_multi_contact;
		}
		return $data_bank_multi_contact;
   }
	function updateCustomer(){
		$bank_id                   		= trim($_POST['bank_id']);
		$bank_uniq_id                	= trim($_POST['bank_uniq_id']);
		$bank_code                   	= trim($_POST['bank_code']);
		$bank_name                   	= trim($_POST['bank_name']);
		$bank_address         			= trim($_POST['bank_address']);
		$bank_email                  	= trim($_POST['bank_email']);
		$bank_country_id 				= trim($_POST['bank_country_id']);
		$bank_state_id             		= trim($_POST['bank_state_id']);
		$bank_city_id             		= trim($_POST['bank_city_id']);
		$bank_zip_code        			= trim($_POST['bank_zip_code']);
		$bank_fax_no                 	= trim($_POST['bank_fax_no']);
		$bank_active_status        		= trim($_POST['bank_active_status']);
		
		//Multi Contact
		$bank_multi_contact_id      	= $_POST['bank_multi_contact_id'];
		$bank_multi_contact_title      	= $_POST['bank_multi_contact_title'];
		$bank_multi_contact_name       	= $_POST['bank_multi_contact_name'];
		$bank_multi_contact_department 	= $_POST['bank_multi_contact_department'];
		$bank_multi_contact_mobile_no  	= $_POST['bank_multi_contact_mobile_no'];
		$bank_multi_contact_email      	= $_POST['bank_multi_contact_email'];
		$bank_multi_contact_extn_no   	= $_POST['bank_multi_contact_extn_no'];
		$request_fields 				= ((!empty($bank_name)) && (!empty($bank_address)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "bank/index.php?page=edit&id=".$bank_uniq_id);
		$update_bank 					= sprintf("	UPDATE 
															banks 
														SET 
															bank_name 				= '%s',
															bank_code 				= '%s',
															bank_address 			= '%s',
															bank_country_id 		= '%d',
															bank_state_id 			= '%d',
															bank_city_id 			= '%d',
															bank_fax_no 			= '%s',
															bank_email 				= '%s',
															bank_zip_code 			= '%s',
															bank_active_status 		= '%s',
															bank_modified_by 		= '%d',
															bank_modified_on 		= UNIX_TIMESTAMP(NOW()),
															bank_modified_ip		= '%s'
														WHERE               
															bank_id             	= '%d'", 
															$bank_name,
															$bank_code,
															$bank_address,
															$bank_country_id,
															$bank_state_id,
															$bank_city_id,
															$bank_fax_no,
															$bank_email,
															$bank_zip_code,
															$bank_active_status,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$bank_id); 
		mysql_query($update_bank);
		for($i=0; $i<count($bank_multi_contact_title); $i++) {	
			if(!empty($bank_multi_contact_id[$i])) {
				$update_multi_contact		=	"UPDATE 
													bank_multi_contacts 
												 SET 
													bank_multi_contact_title          = '".$bank_multi_contact_title[$i]."', 
													bank_multi_contact_name         	= '".$bank_multi_contact_name[$i]."', 
													bank_multi_contact_department   	= '".$bank_multi_contact_department[$i]."', 
													bank_multi_contact_mobile_no    	= '".$bank_multi_contact_mobile_no[$i]."', 
													bank_multi_contact_email        	= '".$bank_multi_contact_email[$i]."', 
													bank_multi_contact_extn_no 	  	= '".$bank_multi_contact_extn_no[$i]."', 
													bank_multi_contact_modified_by    = '".$_SESSION[SESS.'_session_user_id']."', 
													bank_multi_contact_modified_on    = UNIX_TIMESTAMP(NOW()), 
													bank_multi_contact_modified_ip    = '".$ip."' 
								  				WHERE 
													bank_multi_contact_id 			= '".$bank_multi_contact_id[$i]."'";
				mysql_query($update_multi_contact);
			}else {	  
			 if((!empty($bank_multi_contact_title[$i])) && (!empty($bank_multi_contact_name[$i])) && (!empty($bank_multi_contact_department[$i])) && (!empty($bank_multi_contact_mobile_no[$i]))) {
				 $insert_bank_multi_contact = "INSERT INTO bank_multi_contacts (bank_multi_contact_bank_id,
																						bank_multi_contact_title, bank_multi_contact_name,
																						bank_multi_contact_department,																	                                  														bank_multi_contact_mobile_no,bank_multi_contact_email,
																						bank_multi_contact_extn_no,bank_multi_contact_added_by,                                 														
																						bank_multi_contact_added_on,bank_multi_contact_added_ip) 
																				 VALUES ('".$bank_id."','".$bank_multi_contact_title[$i]."',
																						'".$bank_multi_contact_name[$i]."','".$bank_multi_contact_department[$i]."',
																						'".$bank_multi_contact_mobile_no[$i]."','".$bank_multi_contact_email[$i]."',
																						'".$bank_multi_contact_extn_no[$i]."',
																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 
				 mysql_query($insert_bank_multi_contact); 
			}
		   }
		}				  
		pageRedirection("bank/?page=edit&id=$bank_uniq_id");			
	}
    function deleteCustomerMultiContact()
   {
		if((isset($_REQUEST['bank_multi_contact_id'])) && (isset($_REQUEST['bank_uniq_id'])))
		{
			$bank_multi_contact_id 	= $_GET['bank_multi_contact_id'];
			$bank_uniq_id = $_GET['bank_uniq_id'];
			mysql_query("UPDATE bank_multi_contacts SET bank_multi_contact_deleted_status = 1 
						WHERE bank_multi_contact_id = ".$bank_multi_contact_id." ");
			header("Location:index.php?page=edit&id=$bank_uniq_id&msg=6");
		}	
		
   } 		
   function deleteBank(){
		deleteUniqRecords('banks', 'bank_deleted_by', '	bank_deleted_on' , 'bank_deleted_ip','bank_deleted_status', 'bank_id', 'bank_uniq_id', '1');
		
		deleteMultiRecords('bank_multi_contacts', 'bank_multi_contact_deleted_by', 'bank_multi_contact_deleted_on', 'bank_multi_contact_deleted_ip', 'bank_multi_contact_deleted_status', 'bank_multi_contact_bank_id', 'banks','bank_id','bank_uniq_id', '1');  
		
		
	
		pageRedirection("bank/index.php?msg=3");				
	}
   	
   
	
?>