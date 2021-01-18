<?php
	function insertDepartment(){
		$department_name                   	= trim($_POST['department_name']);
		$department_active_status           	= "active";
		$request_fields 				= ((!empty($department_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "department/index.php?page=add");
		$department_uniq_id					= generateUniqId();
		$ip								= getRealIpAddr();
		
		$insert_department 					= sprintf("INSERT INTO departments  (department_uniq_id, department_name, 
																				department_added_by,department_added_on,  
																				department_added_ip, department_company_id) 
																		VALUES ('%s', '%s',
																				'%d', UNIX_TIMESTAMP(NOW()), 
																				'%s', '%d')", 
																				$department_uniq_id,$department_name, 
																				$_SESSION[SESS.'_session_user_id'],
																				$ip,$_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_department);
		pageRedirection("department/index.php?page=add");
	}
	function listDepartment(){
		$select_department		=	"SELECT 
										department_id,
										department_name,
										department_uniq_id
									 FROM 
										departments 
									 WHERE 
										department_deleted_status 	= 	0 AND 
										department_active_status 	=	'active'
									 ORDER BY 
										department_name ASC";
		$result_department 		= mysql_query($select_department);
		// Filling up the array
		$department_data 		= array();
		while ($record_department = mysql_fetch_array($result_department))
		{
		 $department_data[] 	= $record_department;
		}
		return $department_data;
	}
	function editDepartment(){
		$department_id 			= getId('departments', 'department_id', 'department_uniq_id', dataValidation($_GET['id'])); 
		
		$select_department		=	"SELECT 
									department_id,
									department_name,
									department_uniq_id
								 FROM 
									departments 
								 WHERE 
									department_deleted_status 	=  0 			AND 
									department_active_status 	= 'active'		AND
									department_id				= '".$department_id."'
								 ORDER BY 
									department_name ASC";
		$result_department 		= mysql_query($select_department);
		$record_department 		= mysql_fetch_array($result_department);
		return $record_department;
	}
	function updateDepartment(){
		$department_id                   	= trim($_POST['department_id']);
		$department_uniq_id                	= trim($_POST['department_uniq_id']);
		$department_name                   	= trim($_POST['department_name']);
		$request_fields 						= ((!empty($department_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "department/index.php?page=edit&id=".$department_uniq_id);
		$update_department 					= sprintf("	UPDATE 
														departments 
													SET 
														department_name 				= '%s',
														department_modified_by 		= '%d',
														department_modified_on 		= UNIX_TIMESTAMP(NOW()),
														department_modified_ip		= '%s'
													WHERE               
														department_id             	= '%d'
																	 ", 
														$department_name, 
														$_SESSION[SESS.'_session_user_id'], 
														$ip, 
														$department_id);
		mysql_query($update_department);
		pageRedirection("department/?page=edit&id=$department_uniq_id");			
		
	}
?>