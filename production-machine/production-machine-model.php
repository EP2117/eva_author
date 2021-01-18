<?php
	function insertProductcategory(){
		$production_machine_name              		= trim($_POST['production_machine_name']);
		$production_machine_production_section_id   = trim($_POST['production_machine_production_section_id']);
		$production_machine_active_status     = "active";
		$request_fields 					= ((!empty($production_machine_name)) && (!empty($production_machine_production_section_id)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "production-machine/index.phpindex.php?page=add");
		$production_machine_uniq_id					= generateUniqId();
		$ip									= getRealIpAddr();
		
		$insert_production_machine 			= sprintf("INSERT INTO production_machines  (production_machine_uniq_id, production_machine_name, 
																						production_machine_added_by,production_machine_added_on,  
																						production_machine_added_ip, production_machine_company_id,
																						production_machine_production_section_id) 
																				VALUES ('%s', '%s',
																						'%d', UNIX_TIMESTAMP(NOW()), 
																						'%s', '%d',
																						'%d')", 
																						$production_machine_uniq_id,$production_machine_name, 
																						$_SESSION[SESS.'_session_user_id'],
																						$ip,$_SESSION[SESS.'_session_company_id'],
																						$production_machine_production_section_id); 
		mysql_query($insert_production_machine);
		pageRedirection("production-machine/index.php?page=add");
	}
	function listProductcategory(){
		$select_production_machine		=	"SELECT 
												production_machine_id,
												production_machine_name,
												production_machine_uniq_id
											 FROM 
												production_machines 
											 WHERE 
												production_machine_deleted_status 	= 	0 AND 
												production_machine_active_status 	=	'active'
											 ORDER BY 
												production_machine_name ASC";
		$result_production_machine 		= mysql_query($select_production_machine);
		// Filling up the array
		$production_machine_data 			= array();
		while ($record_production_machine = mysql_fetch_array($result_production_machine))
		{
		 $production_machine_data[] 	= $record_production_machine;
		}
		return $production_machine_data;
	}
	function editProductcategory(){
		$production_machine_id 			= getId('production_machines', 'production_machine_id', 'production_machine_uniq_id', dataValidation($_GET['id'])); 
		
		$select_production_machine		=	"SELECT 
												production_machine_id,
												production_machine_name,
												production_machine_uniq_id,
												production_machine_production_section_id
											 FROM 
												production_machines 
											 WHERE 
												production_machine_deleted_status 	=  0 			AND 
												production_machine_active_status 	= 'active'		AND
												production_machine_id				= '".$production_machine_id."'
											 ORDER BY 
												production_machine_name ASC";
		$result_production_machine 		= mysql_query($select_production_machine);
		$record_production_machine 		= mysql_fetch_array($result_production_machine);
		return $record_production_machine;
	}
	function updateProductcategory(){
		$production_machine_id                   	= trim($_POST['production_machine_id']);
		$production_machine_production_section_id  	= trim($_POST['production_machine_production_section_id']);
		$production_machine_uniq_id               	= trim($_POST['production_machine_uniq_id']);
		$production_machine_name                  	= trim($_POST['production_machine_name']);
		$request_fields 						= ((!empty($production_machine_name)) && (!empty($production_machine_production_section_id)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "production-machine/index.phpindex.php?page=edit&id=".$production_machine_uniq_id);
		$update_production_machine 				= sprintf("	UPDATE 
																production_machines 
															SET 
																production_machine_name 					= '%s',
																production_machine_production_section_id 	= '%d',
																production_machine_modified_by 				= '%d',
																production_machine_modified_on 				= UNIX_TIMESTAMP(NOW()),
																production_machine_modified_ip				= '%s'
															WHERE               
																production_machine_id             			= '%d'
																			 ", 
																$production_machine_name,
																$production_machine_production_section_id, 
																$_SESSION[SESS.'_session_user_id'], 
																$ip, 
																$production_machine_id);
		mysql_query($update_production_machine);
		pageRedirection("production-machine/index.php?page=edit&id=$production_machine_uniq_id");			
		
	}
?>