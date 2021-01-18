<?php
	function insertProductcategory(){
		$production_section_name              = trim($_POST['production_section_name']);
		$production_section_active_status     = "active";
		$request_fields 					= ((!empty($production_section_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "production-section/index.phpindex.php?page=add");
		$production_section_uniq_id					= generateUniqId();
		$ip									= getRealIpAddr();
		
		$insert_production_section 			= sprintf("INSERT INTO production_sections  (production_section_uniq_id, production_section_name, 
																						production_section_added_by,production_section_added_on,  
																						production_section_added_ip, production_section_company_id) 
																				VALUES ('%s', '%s',
																						'%d', UNIX_TIMESTAMP(NOW()), 
																						'%s', '%d')", 
																						$production_section_uniq_id,$production_section_name, 
																						$_SESSION[SESS.'_session_user_id'],
																						$ip,$_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_production_section);
		pageRedirection("production-section/index.php?page=add");
	}
	function listProductcategory(){
		$select_production_section		=	"SELECT 
												production_section_id,
												production_section_name,
												production_section_uniq_id
											 FROM 
												production_sections 
											 WHERE 
												production_section_deleted_status 	= 	0 AND 
												production_section_active_status 	=	'active'
											 ORDER BY 
												production_section_name ASC";
		$result_production_section 		= mysql_query($select_production_section);
		// Filling up the array
		$production_section_data 			= array();
		while ($record_production_section = mysql_fetch_array($result_production_section))
		{
		 $production_section_data[] 	= $record_production_section;
		}
		return $production_section_data;
	}
	function editProductcategory(){
		$production_section_id 			= getId('production_sections', 'production_section_id', 'production_section_uniq_id', dataValidation($_GET['id'])); 
		
		$select_production_section		=	"SELECT 
												production_section_id,
												production_section_name,
												production_section_uniq_id
											 FROM 
												production_sections 
											 WHERE 
												production_section_deleted_status 	=  0 			AND 
												production_section_active_status 	= 'active'		AND
												production_section_id				= '".$production_section_id."'
											 ORDER BY 
												production_section_name ASC";
		$result_production_section 		= mysql_query($select_production_section);
		$record_production_section 		= mysql_fetch_array($result_production_section);
		return $record_production_section;
	}
	function updateProductcategory(){
		$production_section_id                   	= trim($_POST['production_section_id']);
		$production_section_uniq_id               = trim($_POST['production_section_uniq_id']);
		$production_section_name                  = trim($_POST['production_section_name']);
		$request_fields 						= ((!empty($production_section_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "production-section/index.phpindex.php?page=edit&id=".$production_section_uniq_id);
		$update_production_section 				= sprintf("	UPDATE 
																production_sections 
															SET 
																production_section_name 				= '%s',
																production_section_modified_by 		= '%d',
																production_section_modified_on 		= UNIX_TIMESTAMP(NOW()),
																production_section_modified_ip		= '%s'
															WHERE               
																production_section_id             	= '%d'
																			 ", 
																$production_section_name, 
																$_SESSION[SESS.'_session_user_id'], 
																$ip, 
																$production_section_id);
		mysql_query($update_production_section);
		pageRedirection("production-section/index.php?page=edit&id=$production_section_uniq_id");			
		
	}
?>