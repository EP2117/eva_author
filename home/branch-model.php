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
	function insertBranch(){
		$branch_code                   	= trim($_POST['branch_code']);
		$branch_name                   	= trim($_POST['branch_name']);
		$branch_address                	= trim($_POST['branch_address']);
		$branch_country_id 				= trim($_POST['branch_country_id']);
		$branch_state_id             	= trim($_POST['branch_state_id']);
		$branch_city_id             	= trim($_POST['branch_city_id']);
		$branch_fax_no                 	= trim($_POST['branch_fax_no']);
		$branch_email                  	= trim($_POST['branch_email']);
		$branch_office_no              	= trim($_POST['branch_office_no']);
		$branch_zip_code        		= trim($_POST['branch_zip_code']);
		$branch_line_phone				= trim($_POST['branch_line_phone']);
		$branch_active_status           = "active";
		$request_fields 				= ((!empty($branch_name)) && (!empty($branch_address)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "home/index.php?page=add");
		$branch_uniq_id					= generateUniqId();
		$ip								= getRealIpAddr();
		
		$insert_branch 					= sprintf("INSERT INTO branches  (branch_uniq_id, branch_code,branch_name, 
																		  branch_address, branch_country_id, branch_state_id,
																		  branch_city_id,branch_line_phone,
																		  branch_fax_no,branch_email,branch_office_no,
																		  branch_zip_code,branch_added_by,branch_added_on,  
																		  branch_added_ip, branch_company_id) 
																VALUES ('%s', '%s', '%s', 
																		'%s', '%d', '%d', 
																		'%d', '%s',
																		'%s', '%s', '%s',
																		'%s', '%d', UNIX_TIMESTAMP(NOW()), 
																		'%s', '%d')", 
																		  $branch_uniq_id, $branch_code, $branch_name, 
																		  $branch_address, $branch_country_id,$branch_state_id,
																		  $branch_city_id, $branch_line_phone,
																		  $branch_fax_no, $branch_email,$branch_office_no,
																		  $branch_zip_code,$_SESSION[SESS.'_session_user_id'],
																		  $ip, $_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_branch);
		pageRedirection("home/index.php?page=add");
	}
	function listBranch(){
		$select_branch		=	"SELECT 
									branch_id,
									branch_name,
									branch_code,
									branch_office_no,
									branch_uniq_id,
									branch_email 
								 FROM 
									branches 
								 WHERE 
									branch_deleted_status 	= 	0 AND 
									branch_active_status 	=	'active'
								 ORDER BY 
									branch_name ASC";
		$result_branch 		= mysql_query($select_branch);
		// Filling up the array
		$branch_data 		= array();
		while ($record_branch = mysql_fetch_array($result_branch))
		{
		 $branch_data[] 	= $record_branch;
		}
		return $branch_data;
	}
	function editBranch(){
		$branch_id 			= getId('branches', 'branch_id', 'branch_uniq_id', dataValidation($_GET['id'])); 
		$select_branch		=	"SELECT 
									branch_id,
									branch_name,
									branch_code,
									branch_office_no,
									branch_uniq_id,
									branch_email,
									branch_address,
									branch_country_id,
									branch_state_id,
									branch_city_id,
									branch_line_phone,
									branch_zip_code,
									branch_fax_no 
								 FROM 
									branches 
								 WHERE 
									branch_deleted_status 	=  0 			AND 
									branch_active_status 	= 'active'		AND
									branch_id				= '".$branch_id."'
								 ORDER BY 
									branch_name ASC";
		$result_branch 		= mysql_query($select_branch);
		$record_branch 		= mysql_fetch_array($result_branch);
		return $record_branch;
	}
	function updateBranch(){
		$branch_id                   	= trim($_POST['branch_id']);
		$branch_uniq_id                	= trim($_POST['branch_uniq_id']);
		$branch_code                   	= trim($_POST['branch_code']);
		$branch_name                   	= trim($_POST['branch_name']);
		$branch_address                	= trim($_POST['branch_address']);
		$branch_country_id 				= trim($_POST['branch_country_id']);
		$branch_state_id             	= trim($_POST['branch_state_id']);
		$branch_city_id             	= trim($_POST['branch_city_id']);
		$branch_fax_no                 	= trim($_POST['branch_fax_no']);
		$branch_email                  	= trim($_POST['branch_email']);
		$branch_office_no              	= trim($_POST['branch_office_no']);
		$branch_zip_code        		= trim($_POST['branch_zip_code']);
		$branch_line_phone				= trim($_POST['branch_line_phone']);
		$request_fields 				= ((!empty($branch_name)) && (!empty($branch_address)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "home/index.php?page=edit&id=".$branch_uniq_id);
		$update_branch 					= sprintf("	UPDATE 
														branches 
													SET 
														branch_name 			= '%s',
														branch_address 			= '%s',
														branch_country_id 		= '%d',
														branch_state_id 		= '%d',
														branch_city_id 			= '%d',
														branch_fax_no 			= '%s',
														branch_email 			= '%s',
														branch_office_no 		= '%s',
														branch_zip_code 		= '%s',
														branch_line_phone 		= '%s',
														branch_modified_by 		= '%d',
														branch_modified_on 		= UNIX_TIMESTAMP(NOW()),
														branch_modified_ip		= '%s'
													WHERE               
														branch_id             	= '%d'
																	 ", 
														$branch_name, 
														$branch_address,
														$branch_country_id, 
														$branch_state_id,
														$branch_city_id, 
														$branch_fax_no,
														$branch_email, 
														$branch_office_no, 
														$branch_zip_code,
														$branch_line_phone,
														$_SESSION[SESS.'_session_user_id'], 
														$ip, 
														$branch_id);
		mysql_query($update_branch);
		pageRedirection("home/?page=edit&id=$branch_uniq_id");			
		
	}
?>