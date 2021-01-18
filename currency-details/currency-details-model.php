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
	
	
	function listBalance()
	{
		$arr_account    = array();
		if(isset($_REQUEST['search'])){	
			$where = " ";
			if(isset($_REQUEST['paymentdate']) && !empty($_REQUEST['paymentdate'])){
				$where = " AND  currency_detail_date	= '".NdateDatabaseFormat($_REQUEST['paymentdate'])."' ";	
			}
			  $select_account = "SELECT 
									*
							   FROM
									currencies
							   LEFT JOIN
							   		currency_details
							   ON
							   		(currency_detail_currency_id	= currency_id $where)
							   WHERE
									currency_deleted_status		= 0				AND
									currency_default			= '0'
							 GROUP BY 
							 		currency_id
							 ORDER BY 
							 		currency_id";
			$result_account = mysql_query($select_account);
			$count_account  = mysql_num_rows($result_account);
			
			if($count_account >0) {
				while($record_account = mysql_fetch_array($result_account)) {
					
					$arr_account[] = $record_account;
				}
				return $arr_account;
				
			} else {
				return 	$count_account;	
			}
		}
		return $arr_account;
	}
	

	function updateCurrency(){
		$currency_id					= $_REQUEST['currency_id'];
		$currency_amt					= $_REQUEST['currency_amt'];
		$currency_date					= NdateDatabaseFormat($_REQUEST['currency_date']);		
		$currency_detail_id				= $_REQUEST['currency_detail_id'];
		$ip 							= getRealIpAddr();
		for($index = 0; $index < count($currency_id); $index++) {
				 $select_balance = "SELECT 
										currency_detail_id 
								   FROM 
								   		currency_details 
								   WHERE 	
								   		currency_detail_id 	= '".$currency_detail_id[$index]."' "; 
				$result_balance = mysql_query($select_balance);	
				$count_balance  = mysql_num_rows($result_balance);
				if($count_balance > 0){
					$update_open_balance = sprintf("UPDATE currency_details SET currency_detail_amount 				= '%f'
																			WHERE  currency_detail_id             	= '%d'", 
																		 $currency_amt[$index],$currency_detail_id[$index]);
					mysql_query($update_open_balance);		
					
				} else {
				
				 	 $insert_open_balance 	= sprintf("INSERT INTO currency_details (currency_detail_currency_id, currency_detail_amount, 
																					 currency_detail_date,
																					 currency_detail_added_by,currency_detail_added_on,
																					 currency_detail_added_ip) 
																			VALUES ('%d', '%f','%s','%d','UNIX_TIMESTAMP(NOW())', '%s')", 
																					$currency_id[$index], $currency_amt[$index], $currency_date,
																					$_SESSION[SESS.'_session_user_id'],$ip); 																	
					mysql_query($insert_open_balance);	
					$opening_balance_id = mysql_insert_id();
				}
				
				 //financialid check						
			
	
		}
		
		header("Location:index.php?search=&currency_detail_date=".$_REQUEST['currency_date']);	
	}

?>