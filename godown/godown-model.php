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
		$godown_code                   	= trim($_POST['godown_code']);
		$godown_name                   	= trim($_POST['godown_name']);
		$godown_address         		= trim($_POST['godown_address']);
		$godown_email                  	= trim($_POST['godown_email']);
		$godown_country_id 				= trim($_POST['godown_country_id']);
		$godown_state_id             	= trim($_POST['godown_state_id']);
		$godown_city_id             	= trim($_POST['godown_city_id']);
		$godown_zip_code        		= trim($_POST['godown_zip_code']);
		$godown_fax_no                 	= trim($_POST['godown_fax_no']);
		$godown_active_status			= 'active';
		//Multi Contact
		$godown_multi_contact_title      		= $_POST['godown_multi_contact_title'];
		$godown_multi_contact_name       		= $_POST['godown_multi_contact_name'];
		$godown_multi_contact_department 		= $_POST['godown_multi_contact_department'];
		$godown_multi_contact_mobile_no  		= $_POST['godown_multi_contact_mobile_no'];
		$godown_multi_contact_email      		= $_POST['godown_multi_contact_email'];
		$godown_multi_contact_extn_no   	   	= $_POST['godown_multi_contact_extn_no'];
		
		$request_fields 					= ((!empty($godown_name)) && (!empty($godown_address)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "godown/index.php?page=add&msg=2");
		$godown_uniq_id					= generateUniqId();
		$ip									= getRealIpAddr();
		
		$insert_godown 					= sprintf("INSERT INTO godowns  (godown_uniq_id, godown_code,godown_name, 
																		godown_address,godown_email,godown_country_id,
																		godown_state_id,godown_city_id,godown_zip_code,
																		godown_fax_no,godown_active_status,
																		godown_added_by,godown_added_on,godown_added_ip,
																		godown_company_id) 
																VALUES ('%s', '%s', '%s', 
																		'%s', '%s', '%d',
																		'%d', '%d', '%s',
																		'%s', '%s',
																		'%s',  UNIX_TIMESTAMP(NOW()), '%d',
																		'%d')", 
																		$godown_uniq_id, $godown_code,$godown_name, 
																		$godown_address,$godown_email,$godown_country_id,
																		$godown_state_id,$godown_city_id,$godown_zip_code,
																		$godown_fax_no,$godown_active_status,
																		$_SESSION[SESS.'_session_user_id'],$ip, $_SESSION[SESS.'_session_company_id']);
		//echo $insert_godown; exit;																  
		mysql_query($insert_godown);
		$godown_id 						= mysql_insert_id(); 
		for($i=0; $i<count($godown_multi_contact_title); $i++) {
			if((!empty($godown_multi_contact_title[$i])) && (!empty($godown_multi_contact_name[$i])) && (!empty($godown_multi_contact_department[$i])) && (!empty($godown_multi_contact_mobile_no[$i]))) {
				 $insert_godown_multi_contact = "INSERT INTO godown_multi_contacts (godown_multi_contact_godown_id,
																						godown_multi_contact_title, godown_multi_contact_name,
																						godown_multi_contact_department,																	                                  														godown_multi_contact_mobile_no,godown_multi_contact_email,
																						godown_multi_contact_extn_no,godown_multi_contact_added_by,                                 														
																						godown_multi_contact_added_on,godown_multi_contact_added_ip) 
																				 VALUES ('".$godown_id."','".$godown_multi_contact_title[$i]."',
																						'".$godown_multi_contact_name[$i]."','".$godown_multi_contact_department[$i]."',
																						'".$godown_multi_contact_mobile_no[$i]."','".$godown_multi_contact_email[$i]."',
																						'".$godown_multi_contact_extn_no[$i]."',
																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 
				 mysql_query($insert_godown_multi_contact); 
		   }
		} 
		pageRedirection("godown/index.php?page=add");
	}
	function listCustomer(){
		$select_branch		=	"SELECT 
									godown_id,
									godown_name,
									godown_code,
									godown_uniq_id,
									godown_email 
								 FROM 
									godowns 
								 WHERE 
									godown_deleted_status 	= 	0 AND 
									godown_active_status 	=	'active'
								 ORDER BY 
									godown_name ASC";
		$result_branch 		= mysql_query($select_branch);
		// Filling up the array
		$godown_data 		= array();
		while ($record_branch = mysql_fetch_array($result_branch))
		{
		 $godown_data[] 	= $record_branch;
		}
		return $godown_data;
	}
	function editCustomer(){
		$godown_id 			= getId('godowns', 'godown_id', 'godown_uniq_id', dataValidation($_GET['id'])); 
		$select_branch		=	"SELECT 
									godown_id,
									godown_name,
									godown_code,
									godown_uniq_id,
									godown_email,
									godown_address,
									godown_country_id,
									godown_state_id,
									godown_city_id,
									godown_zip_code,
									godown_fax_no,
									godown_active_status 
								 FROM 
									godowns 
								 WHERE 
									godown_deleted_status 	=  0 			AND 
									godown_active_status 	= 'active'		AND
									godown_id				= '".$godown_id."'
								 ORDER BY 
									godown_name ASC";
		$result_branch 		= mysql_query($select_branch);
		$record_branch 		= mysql_fetch_array($result_branch);
		return $record_branch;
	}
    function editCustomerMultiContact(){
		$godown_id 					= getId('godowns', 'godown_id', 'godown_uniq_id', dataValidation($_GET['id'])); 
		$select_godown_multi_contact 	= "SELECT 
											godown_multi_contact_id,
											godown_multi_contact_title,
											godown_multi_contact_name,
											godown_multi_contact_department,
											godown_multi_contact_mobile_no,
											godown_multi_contact_email,
											godown_multi_contact_extn_no,
											godown_multi_contact_godown_id 
										FROM 
											godown_multi_contacts
										WHERE 
											godown_multi_contact_godown_id 		= '".$godown_id."'	 AND 
											godown_multi_contact_deleted_status 	= 0"; 
		$result_godown_multi_contact = mysql_query($select_godown_multi_contact);
		
		// Filling up the array
		$data_godown_multi_contact  = array();
		
		while ($record_godown_multi_contact = mysql_fetch_array($result_godown_multi_contact))
		{
		 $data_godown_multi_contact[] 	= $record_godown_multi_contact;
		}
		return $data_godown_multi_contact;
   }
	function updateCustomer(){
		$godown_id                   		= trim($_POST['godown_id']);
		$godown_uniq_id                		= trim($_POST['godown_uniq_id']);
		$godown_code                   		= trim($_POST['godown_code']);
		$godown_name                   		= trim($_POST['godown_name']);
		$godown_address         			= trim($_POST['godown_address']);
		$godown_email                  		= trim($_POST['godown_email']);
		$godown_country_id 					= trim($_POST['godown_country_id']);
		$godown_state_id             		= trim($_POST['godown_state_id']);
		$godown_city_id             		= trim($_POST['godown_city_id']);
		$godown_zip_code        			= trim($_POST['godown_zip_code']);
		$godown_fax_no                 		= trim($_POST['godown_fax_no']);
		$godown_active_status        		= trim($_POST['godown_active_status']);
		
		//Multi Contact
		$godown_multi_contact_id      		= $_POST['godown_multi_contact_id'];
		$godown_multi_contact_title      	= $_POST['godown_multi_contact_title'];
		$godown_multi_contact_name       	= $_POST['godown_multi_contact_name'];
		$godown_multi_contact_department 	= $_POST['godown_multi_contact_department'];
		$godown_multi_contact_mobile_no  	= $_POST['godown_multi_contact_mobile_no'];
		$godown_multi_contact_email      	= $_POST['godown_multi_contact_email'];
		$godown_multi_contact_extn_no   	= $_POST['godown_multi_contact_extn_no'];
		$request_fields 					= ((!empty($godown_name)) && (!empty($godown_address)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "godown/index.php?page=edit&id=".$godown_uniq_id);
		$update_godown 					= sprintf("	UPDATE 
															godowns 
														SET 
															godown_name 				= '%s',
															godown_address 				= '%s',
															godown_country_id 			= '%d',
															godown_state_id 			= '%d',
															godown_city_id 				= '%d',
															godown_fax_no 				= '%s',
															godown_email 				= '%s',
															godown_zip_code 			= '%s',
															godown_active_status 		= '%s',
															godown_modified_by 			= '%d',
															godown_modified_on 			= UNIX_TIMESTAMP(NOW()),
															godown_modified_ip			= '%s'
														WHERE               
															godown_id             		= '%d'", 
															$godown_name,
															$godown_address,
															$godown_country_id,
															$godown_state_id,
															$godown_city_id,
															$godown_fax_no,
															$godown_email,
															$godown_zip_code,
															$godown_active_status,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$godown_id); 
		mysql_query($update_godown);
		for($i=0; $i<count($godown_multi_contact_title); $i++) {	
			if(!empty($godown_multi_contact_id[$i])) {
				$update_multi_contact		=	"UPDATE 
													godown_multi_contacts 
												 SET 
													godown_multi_contact_title          = '".$godown_multi_contact_title[$i]."', 
													godown_multi_contact_name         	= '".$godown_multi_contact_name[$i]."', 
													godown_multi_contact_department   	= '".$godown_multi_contact_department[$i]."', 
													godown_multi_contact_mobile_no    	= '".$godown_multi_contact_mobile_no[$i]."', 
													godown_multi_contact_email        	= '".$godown_multi_contact_email[$i]."', 
													godown_multi_contact_extn_no 	  	= '".$godown_multi_contact_extn_no[$i]."', 
													godown_multi_contact_modified_by    = '".$_SESSION[SESS.'_session_user_id']."', 
													godown_multi_contact_modified_on    = UNIX_TIMESTAMP(NOW()), 
													godown_multi_contact_modified_ip    = '".$ip."' 
								  				WHERE 
													godown_multi_contact_id 			= '".$godown_multi_contact_id[$i]."'";
				mysql_query($update_multi_contact);
			}else {	  
			 if((!empty($godown_multi_contact_title[$i])) && (!empty($godown_multi_contact_name[$i])) && (!empty($godown_multi_contact_department[$i])) && (!empty($godown_multi_contact_mobile_no[$i]))) {
				 $insert_godown_multi_contact = "INSERT INTO godown_multi_contacts (godown_multi_contact_godown_id,
																						godown_multi_contact_title, godown_multi_contact_name,
																						godown_multi_contact_department,																	                                  														godown_multi_contact_mobile_no,godown_multi_contact_email,
																						godown_multi_contact_extn_no,godown_multi_contact_added_by,                                 														
																						godown_multi_contact_added_on,godown_multi_contact_added_ip) 
																				 VALUES ('".$godown_id."','".$godown_multi_contact_title[$i]."',
																						'".$godown_multi_contact_name[$i]."','".$godown_multi_contact_department[$i]."',
																						'".$godown_multi_contact_mobile_no[$i]."','".$godown_multi_contact_email[$i]."',
																						'".$godown_multi_contact_extn_no[$i]."',
																						'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 
				 mysql_query($insert_godown_multi_contact); 
			}
		   }
		}				  
		pageRedirection("godown/?page=edit&id=$godown_uniq_id");			
	}
    function deleteCustomerMultiContact()
   {
		if((isset($_REQUEST['godown_multi_contact_id'])) && (isset($_REQUEST['godown_uniq_id'])))
		{
			$godown_multi_contact_id 	= $_GET['godown_multi_contact_id'];
			$godown_uniq_id = $_GET['godown_uniq_id'];
			mysql_query("UPDATE godown_multi_contacts SET godown_multi_contact_deleted_status = 1 
						WHERE godown_multi_contact_id = ".$godown_multi_contact_id." ");
			header("Location:index.php?page=edit&id=$godown_uniq_id&msg=6");
		}
		
   } 		
	
?>