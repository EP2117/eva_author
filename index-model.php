<?php

checkValidFile();

function getFinancialYear(){

	$select_financial_years 	=	"SELECT 

										financial_year_id, 

										financial_year_from, 

										financial_year_to 

							   		 FROM  

									 	financial_years 

							  	 	 WHERE 

									 	financial_year_status		= 0 

							   		 ORDER BY 

									 	financial_year_to DESC";

	$result_financial_years 	= mysql_query($select_financial_years);

	$arr_financial_year 		= array();

	while($record_financial_years = mysql_fetch_array($result_financial_years)) {

		$arr_financial_year[] 	= $record_financial_years;

	}

	return $arr_financial_year;

}



function userAuthentication(){

	$user_username       		= dataValidation($_POST['user_name']);

	$user_password       		= dataValidation($_POST['user_password']);

	$user_financial_year 		= dataValidation($_POST['user_financial_year']);

	$user_language       		= "en";

	$request_fields 			= ((!empty($user_username)) && (!empty($user_password)) &&  (!empty($user_financial_year)));

	$select_user 				= 	"SELECT 

										user_id, 

										user_uniq_id, 

										user_username, 

										user_password, 

					       				user_name, 

										user_level, 

										user_branch_ids, 

										user_company_ids, 

										user_last_login,

										user_accessibilities,
										user_branch_type

									 FROM   

									 	users 

									 WHERE  

									 	user_username      			= '".$user_username."' 			AND

					    				user_active_status 			= 'active'						AND

					    				user_delete_status 			= 0";

	//echo $select_user; exit;									 

	$result_user 				= mysql_query($select_user);

	$count_user  				= mysql_num_rows($result_user);

	if($count_user == 1) {

		$record_user      		= mysql_fetch_array($result_user);

		$user_password    		= md5($user_password);

		$user_db_password 		= getRealPassword($record_user['user_password']);

		if($user_password == $user_db_password){

			$_SESSION[SESS.'_session_user_id']              	= $record_user['user_id'];

			$_SESSION[SESS.'_session_user_uniq_id']         	= $record_user['user_uniq_id'];

			$_SESSION[SESS.'_session_user_name']            	= $record_user['user_name'];

			$_SESSION[SESS.'_session_user_username']        	= $record_user['user_username'];

			$_SESSION[SESS.'_session_user_level']           	= $record_user['user_level'];

			$_SESSION[SESS.'_session_user_last_login']      	= $record_user['user_last_login'];

			$_SESSION[SESS.'_session_user_accessibilities']  	= explode(',', $record_user['user_accessibilities']);

			$_SESSION[SESS.'_session_user_language']        	= $user_language;

			$_SESSION[SESS.'_session_financial_year']  	  		= $user_financial_year;

			$_SESSION[SESS.'_session_user_branch_ids']      	= $record_user['user_branch_ids'];

			$_SESSION[SESS.'_session_user_company_ids']     	= $record_user['user_company_ids'];
			$_SESSION[SESS.'_session_user_branch_type']     	= $record_user['user_branch_type'];
			// Finantial Year 
			
			$select_currency  									= "SELECT 
																		currency_id
																   FROM
																		currencies
																   WHERE
																		currency_active_status			= 'active'			AND
																		currency_deleted_status			= '0'				AND
																		currency_default				= '1'  				
																   GROUP BY 
																		currency_id
																    ORDER BY 
																		currency_id";
			$result_currency 									= mysql_query($select_currency);
			$record_currency 									= mysql_fetch_array($result_currency);
			$_SESSION[SESS.'_default_currency_id']     			= $record_currency['currency_id'];
			

			$select_financial_years 							= "	SELECT 

																		financial_year_from, 

																		financial_year_to, 

																		financial_year_form_date, 

																		financial_year_to_date  

																	FROM  

																		financial_years 


																   	WHERE 

																		financial_year_status				=	0 										AND

																    	financial_year_id 					= '".$_SESSION[SESS.'_session_financial_year']."'";

			$result_financial_years 							= mysql_query($select_financial_years);		

			$record_financial_years 							= mysql_fetch_array($result_financial_years);	

			$_SESSION[SESS.'_session_financial_year_value']		= $record_financial_years['financial_year_from'].'-'.$record_financial_years['financial_year_to'];

			$_SESSION[SESS.'_financial_year_form_date']			= dateGeneralFormatN($record_financial_years['financial_year_form_date']);

			$_SESSION[SESS.'_financial_year_to_date']			= dateGeneralFormatN($record_financial_years['financial_year_to_date']);

			//Company Detail

			$data_company										= listCompany();
			if(count($data_company)>1){

				header("Location:".PROJECT_PATH."/company/"); 

			}

			else{ 	

				$_SESSION[SESS.'_session_company_id']    		= $data_company[0]['company_id'];

				$_SESSION[SESS.'_session_company_name']  		= $data_company[0]['company_name'];

				$_SESSION[SESS.'_session_company_logo']  		= $data_company[0]['company_logo'];

				header("Location:".PROJECT_PATH."/home/index.php"); 

			}

			exit();

		}

		else{

			$_SESSION[SESS.'_session_alert_msg'] 				= 'Invalide username or password';

			header("Location:".PROJECT_PATH."/?msg=1");  

			exit();

		}

	}

	else{

		$_SESSION[SESS.'_session_alert_msg'] 					= 'Invalide username or password';

		header("Location:".PROJECT_PATH."/?msg=1");  

		exit();

	}

}

?>