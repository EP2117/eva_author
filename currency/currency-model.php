<?php
	function insertCurrency(){
		$currency_name                   	= trim($_POST['currency_name']);
		$currency_code                   	= trim($_POST['currency_code']);
		$currency_active_status           	= "active";
		$request_fields 				= ((!empty($currency_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "currency/index.php?page=add");
		$currency_uniq_id					= generateUniqId();
		$ip								= getRealIpAddr();
		
		$insert_currency 					= sprintf("INSERT INTO currencies  (currency_uniq_id, currency_name,
																				currency_code, 
																				currency_added_by,currency_added_on,  
																				currency_added_ip) 
																		VALUES ('%s', '%s',
																				'%s',
																				'%d', UNIX_TIMESTAMP(NOW()), 
																				'%s')", 
																				$currency_uniq_id,$currency_name,
																				$currency_code, 
																				$_SESSION[SESS.'_session_user_id'],
																				$ip); 
		mysql_query($insert_currency);
		pageRedirection("currency/index.php?page=add");
	}
	function listCurrency(){
		$select_currency		=	"SELECT 
										currency_id,
										currency_name,
										currency_code,
										currency_uniq_id
									 FROM 
										currencies 
									 WHERE 
										currency_deleted_status 	= 	0 AND 
										currency_active_status 	=	'active'
									 ORDER BY 
										currency_name ASC";
		$result_currency 		= mysql_query($select_currency);
		// Filling up the array
		$currency_data 		= array();
		while ($record_currency = mysql_fetch_array($result_currency))
		{
		 $currency_data[] 	= $record_currency;
		}
		return $currency_data;
	}
	function editCurrency(){
		$currency_id 			= getId('currencies', 'currency_id', 'currency_uniq_id', dataValidation($_GET['id'])); 
		
		$select_currency		=	"SELECT 
										currency_id,
										currency_name,
										currency_code,
										currency_uniq_id
									 FROM 
										currencies 
									 WHERE 
										currency_deleted_status 	=  0 			AND 
										currency_active_status 	= 'active'		AND
										currency_id				= '".$currency_id."'
									 ORDER BY 
										currency_name ASC";
		$result_currency 		= mysql_query($select_currency);
		$record_currency 		= mysql_fetch_array($result_currency);
		return $record_currency;
	}
	function updateCurrency(){
		$currency_id                   	= trim($_POST['currency_id']);
		$currency_uniq_id               = trim($_POST['currency_uniq_id']);
		$currency_name                  = trim($_POST['currency_name']);
		$currency_code                  = trim($_POST['currency_code']);
		$request_fields 				= ((!empty($currency_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "currency/index.php?page=edit&id=".$currency_uniq_id);
		$update_currency 					= sprintf("	UPDATE 
															currencies 
														SET 
															currency_name 				= '%s',
															currency_code 				= '%s',
															currency_modified_by 		= '%d',
															currency_modified_on 		= UNIX_TIMESTAMP(NOW()),
															currency_modified_ip		= '%s'
														WHERE               
															currency_id             	= '%d'
																		 ", 
															$currency_name, 
															$currency_code,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$currency_id);
		mysql_query($update_currency);
		pageRedirection("currency/?page=edit&id=$currency_uniq_id");			
		
	}
?>