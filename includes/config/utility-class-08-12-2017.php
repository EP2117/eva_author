<?php 

$arr_product_type    		= array("1"=>"Raw", "2"=>"Semi", "3"=>"Finished Product");

$arr_so_type    			= array("1"=>"Direct", "2"=>"Phone", "3"=>"Email");

$arr_producton_type    		= array("1"=>"ROOFING", "2"=>"C CHANNEL", "3"=>"ACCESSORIES");

$arr_delivery_type    		= array("1"=>"CUSTOMER", "2"=>"COMPANY");
$arr_cn_type    			= array("1"=>"Returnable Stock", "2"=>"Price Differences");

$payment    			= array("1"=>"Paid", "2"=>"Un Paid");

// Added by MENAKA on 02-Nov-2017
$arr_reserve    			= array("1"=>"Customer", "2"=>" Sales");	

//Login Authendication

$arr_pay_mode    	 = array("1"=>"Cash", "2"=>" Bank");	
$arr_paytype    	 = array("1"=>"Expense", "2"=>"Employee Advance");	
$arr_leave_status    = array("1"=>"Present", "2"=>"Absent");	
$arr_leaveType	  	 = array("1"=>"Addition", "2"=>"Casual" ,"3"=>"Medical","4"=>"Anual","5"=>"Other");


function loginAuthentication()

{

	if(!isset($_SESSION[SESS.'_session_user_id'])) {

		header("Location:".PROJECT_PATH); 



		exit();



	}	



}







//Check  Valid File



function checkValidFile(){



	$file_with_path 	= $_SERVER["PHP_SELF"];



	$parts			 	= explode('/', $file_with_path);



	$file_name 			=  $parts[count($parts) - 1];



	if($file_name != 'index.php') {



		header("Location:".PROJECT_PATH."/404/"); 



		exit();



	}	



}



//Check Request Feild



function checkRequestFields($request_fields, $path, $page){



	if (!$request_fields) { 



		$_SESSION[SESS.'_session_red_alert'] = 'Please fill all required fields';



		header("Location:".$path.'/'.$page.'&msg=5'); 



		exit();



	} else {



		return true;



	}	



}



// Get REal Password



function getRealPassword($password){



	$real_password = substr($password,0,7).substr($password,10,4).substr($password,19,21); 



	return $real_password;



}



//Database insert Format



function dateDatabaseFormat($date){
	$date = implode('-', array_reverse(explode('-', $date)));
	return $date;
}
function NdateDatabaseFormat($date){

$date = implode('-', array_reverse(explode('/', $date)));

return $date;

}
//Date Display Format
function dateGeneralFormat($date){
	$date = implode('-', array_reverse(explode('-', $date)));
	return $date;
}
function dateGeneralFormatN($date){

$date = implode('/', array_reverse(explode('-', $date)));

return $date;

}



//Company Detail



function listCompany(){



	$select_company 	= "	SELECT 
								company_id, 
								company_name, 
								company_logo  
							FROM 
								companies 

				   			WHERE 
								company_active_status 	= 'active' 			AND 
								company_deleted_status 	= 0	

							ORDER BY 
								company_name ASC";

	$result_company 	= mysql_query($select_company);
	$arr_company 		= array();

	while($record_company = mysql_fetch_array($result_company)) {
		$arr_company[] = $record_company;
	}
	return 	$arr_company;	
}



//DataValidation



function dataValidation($value) 



{



	$value = trim(htmlspecialchars($value));



	if(get_magic_quotes_gpc()) { 



		$value = stripslashes($value); 



	}  



	$value = mysql_real_escape_string($value); 



	return $value;



}



//Page Rediretion



function pageRedirection($path)



{



	header("Location:".PROJECT_PATH."/".$path);



	exit();



}



// Getting real IP address



	function getRealIpAddr()



{



	if (!empty($_SERVER['HTTP_CLIENT_IP']))   // Check ip from share internet



	{



	  $ip=$_SERVER['HTTP_CLIENT_IP'];



	}



	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   // To check ip is pass from proxy



	{



	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];



	}



	else



	{



	  $ip=$_SERVER['REMOTE_ADDR'];



	}



	return $ip;



}



//Generating CSRF token



function generateUniqId()



{



	$uniq_id_md5 = md5(uniqid());



	$uniq_id     = substr($uniq_id_md5,0,7).generateRandomString(3).substr($uniq_id_md5,7,4).generateRandomString(5).substr($uniq_id_md5,11,22);



	return $uniq_id;



}



function generateRandomString($length) {



	$alphabet = "0123456789abcdefghijklmnopqrstuvwxyz";



	$pass = array(); //remember to declare $pass as an array



	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache



	for ($i = 0; $i < $length; $i++) {



		$n = rand(0, $alphaLength);



		$pass[] = $alphabet[$n];



	}



	return implode($pass); //turn the array into a string



}



function searchValue($fieldName) 



{



	if(isset($_REQUEST["$fieldName"])) {



		$search_value = $_REQUEST["$fieldName"];



	} else {



		$search_value = '';



	}



	return $search_value;



}



	



function getId($table_name, $pid, $uid ,$uniq_id)



{



	$select_id = "SELECT $pid FROM $table_name WHERE $uid = '".$uniq_id."'";



	$result_id = mysql_query($select_id);



	$record_id = mysql_fetch_array($result_id);



	return $record_id["$pid"];



}

function getBranchList(){



	$select_branch		=	"SELECT 



								branch_id,



								branch_name 



							 FROM 



								branches 



							 WHERE 



								branch_deleted_status 	= 	0 AND 



								branch_active_status 	=	'active'



							 ORDER BY 



								branch_name ASC";



	$result_branch 	= mysql_query($select_branch);



	// Filling up the array



	$branch_data 	= array();



	while ($record_branch = mysql_fetch_array($result_branch))



	{



	 $branch_data[] 	= $record_branch;



	}



	return $branch_data;



}



function getBrandList(){



	$select_brand		=	"SELECT 



								brand_id,



								brand_name 



							 FROM 



								brands 



							 WHERE 



								brand_deleted_status 	= 	0 AND 



								brand_active_status 	=	'active'



							 ORDER BY 



								brand_name ASC";



	$result_brand 	= mysql_query($select_brand);



	// Filling up the array



	$brand_data 	= array();



	while ($record_brand = mysql_fetch_array($result_brand))



	{



	 $brand_data[] 	= $record_brand;



	}



	return $brand_data;



}

function getProductcategory(){



	$select_product_category		=	"SELECT 



											product_category_id,



											product_category_name 



										 FROM 



											product_categories 



										 WHERE 



											product_category_deleted_status 	= 0 					AND 



											product_category_active_status 		= 'active'					



										 ORDER BY 



											product_category_name ASC";



								



	$result_product_category 		= mysql_query($select_product_category);



	// Filling up the array



	$product_category_data 			= array();



	while ($record_product_category = mysql_fetch_array($result_product_category))



	{



	 $product_category_data[] 		= $record_product_category;



	}



	return $product_category_data;



}

function getColourList(){



	$select_product_colour		=	"SELECT 



											product_colour_id,



											product_colour_name 



										 FROM 



											product_colours 



										 WHERE 



											product_colour_deleted_status 	= 0 					AND 



											product_colour_active_status 		= 'active'					



										 ORDER BY 



											product_colour_name ASC";



								



	$result_product_colour 		= mysql_query($select_product_colour);



	// Filling up the array



	$product_colour_data 			= array();



	while ($record_product_colour = mysql_fetch_array($result_product_colour))



	{



	 $product_colour_data[] 		= $record_product_colour;



	}



	return $product_colour_data;



}

function getProductuomList(){



	$select_product_uom		=	"SELECT 



									product_uom_id,



									product_uom_name 



								 FROM 



									product_uoms 



								 WHERE 



									product_uom_deleted_status 		= 0 					AND 



									product_uom_active_status 		= 'active'	



								 ORDER BY 



									product_uom_name ASC";



	$result_product_uom 	= mysql_query($select_product_uom);



	// Filling up the array



	$product_uom_data 		= array();



	while ($record_product_uom = mysql_fetch_array($result_product_uom)){



	 $product_uom_data[] 	= $record_product_uom;



	}



	return $product_uom_data;



}

function getProduct($type=''){



	$where	= '';



	if($type!=''){



		$where	.= "	AND product_type				= 	'".$type."'";	



	}



	$select_product		=	"SELECT 



								product_id,



								product_name 



							 FROM 



								products 



							 WHERE 



								product_deleted_status 		= 0 					AND 



								product_active_status 		= 'active'		$where				



							 ORDER BY 



								product_name ASC";



								



	$result_product 		= mysql_query($select_product);



	// Filling up the array



	$product_data 			= array();



	while ($record_product = mysql_fetch_array($result_product))



	{



	 $product_data[] 		= $record_product;



	}



	return $product_data;



}

function getCountryList(){



	$select_country		=	"SELECT 



								country_id,



								country_name 



							 FROM 



								countries 



							 WHERE 



								country_deleted_status 	= 	0 AND 



								country_active_status 	=	'active'



							 ORDER BY 



								country_name ASC";



	$result_country 	= mysql_query($select_country);



	// Filling up the array



	$country_data 	= array();



	while ($record_country = mysql_fetch_array($result_country))



	{



	 $country_data[] 	= $record_country;



	}



	return $country_data;



}

function getCustomertypeList(){



	$select_customer_type		=	"SELECT 



										customer_type_id,



										customer_type_name 



									 FROM 



										customer_types 



									 WHERE 



										customer_type_deleted_status 	= 	0 AND 



										customer_type_active_status 	=	'active'



									 ORDER BY 



										customer_type_name ASC";



	$result_customer_type 		= mysql_query($select_customer_type);



	// Filling up the array



	$customer_type_data 	= array();



	while ($record_customer_type = mysql_fetch_array($result_customer_type))



	{



	 $customer_type_data[] 	= $record_customer_type;



	}



	return $customer_type_data;



}

function getCurrencyList(){



	$select_currency		=	"SELECT 



									currency_id,



									currency_name 



								 FROM 



									currencies 



								 WHERE 



									currency_deleted_status	 	= 	0  		AND



									currency_active_status 		=	'active'



								 ORDER BY 



									currency_name ASC";



	$result_currency 	= mysql_query($select_currency);



	// Filling up the array



	$currency_data 	= array();



	while ($record_currency = mysql_fetch_array($result_currency))



	{



	 $currency_data[] 	= $record_currency;



	}



	return $currency_data;



}

function getProductionSectionList(){



	$select_production_section		=	"SELECT 



										production_section_id,



										production_section_name 



									 FROM 



										production_sections 



									 WHERE 



										production_section_deleted_status 	= 	0 AND 



										production_section_active_status 	=	'active'



									 ORDER BY 



										production_section_name ASC";



	$result_production_section 		= mysql_query($select_production_section);



	// Filling up the array



	$production_section_data 	= array();



	while ($record_production_section = mysql_fetch_array($result_production_section))



	{



	 $production_section_data[] 	= $record_production_section;



	}



	return $production_section_data;



}

function getCustomerList(){



	$select_customer		=	"SELECT 



									customer_id,

									customer_name, 

									customer_code

								 FROM 



									customers 



								 WHERE 



									customer_deleted_status 	= 	0 AND 



									customer_active_status 	=	'active'



								 ORDER BY 



									customer_name ASC";



	$result_customer 		= mysql_query($select_customer);



	// Filling up the array



	$customer_data 	= array();



	while ($record_customer = mysql_fetch_array($result_customer))



	{



	 $customer_data[] 	= $record_customer;



	}



	return $customer_data;



}

function getDepartmentList(){



	$select_department		=	"SELECT 



									department_id,



									department_name 



								 FROM 



									departments 



								 WHERE 



									department_deleted_status	 	= 	0  		AND



									department_active_status 		=	'active'



								 ORDER BY 



									department_name ASC";



	$result_department 	= mysql_query($select_department);



	// Filling up the array



	$department_data 	= array();



	while ($record_department = mysql_fetch_array($result_department))



	{



	 $department_data[] 	= $record_department;



	}



	return $department_data;



}

function getGodownList(){




	$select_godown		=	"SELECT 



								godown_id,



								godown_name 



							 FROM 



								godowns 



							 WHERE 



								godown_deleted_status 	= 	0 AND 



								godown_active_status 	=	'active'



							 ORDER BY 



								godown_name ASC";



	$result_godown 		= mysql_query($select_godown);



	// Filling up the array



	$godown_data 	= array();



	while ($record_godown = mysql_fetch_array($result_godown))



	{



	 $godown_data[] 		= $record_godown;



	}



	return $godown_data;



}

function getEmployeeList(){



	$select_employee		=	"SELECT 



									employee_id,



									employee_name 



								 FROM 



									employees 



								 WHERE 



									employee_deleted_status	 	= 	0  



								 ORDER BY 



									employee_name ASC";



	$result_employee 	= mysql_query($select_employee);



	// Filling up the array



	$employee_data 	= array();



	while ($record_employee = mysql_fetch_array($result_employee))



	{



	 $employee_data[] 	= $record_employee;



	}



	return $employee_data;



}

// Get Vendor  -  Added by MENAKA on 04-SEP-2017



function getVendorList(){







	$select_vendor = "SELECT vendor_id, vendor_code, vendor_name FROM vendors WHERE vendor_status=0 ORDER BY vendor_name ASC "; 



	$result_vendor = mysql_query($select_vendor);



	$vendor_data = array();



	while($record_vendor = mysql_fetch_array($result_vendor)){



		$vendor_data[] = $record_vendor;		



	}



	return $vendor_data;	



}

function getProductionMachineList($production_section_id=''){



	$where	= '';



	if($production_section_id!=''){



		$where	.= "	AND production_machine_production_section_id				= 	'".$production_section_id."'";	



	}

	

	$select_production_machine 	=   "SELECT 

									production_machine_id, 

									production_machine_name 

								 FROM 

									production_machines 

								 WHERE 

									production_machine_deleted_status 	= 0  $where

								 ORDER BY 

									production_machine_name ASC";	

	$result_production_machine 	=  mysql_query($select_production_machine);



	// Filling up the array



	$production_machine_data 			= array();



	while ($record_production_machine= mysql_fetch_array($result_production_machine))



	{



	 $production_machine_data[] 		= $record_production_machine;



	}



	return $production_machine_data;



}

function getSalesmanList(){



	$select_salesman		=	"SELECT 



									salesman_id,



									salesman_name 



								 FROM 



									salesmans 



								 WHERE 



									salesman_deleted_status 	= 	0 AND 



									salesman_active_status 	=	'active'



								 ORDER BY 



									salesman_name ASC";



	$result_salesman 		= mysql_query($select_salesman);



	// Filling up the array



	$salesman_data 	= array();



	while ($record_salesman = mysql_fetch_array($result_salesman))



	{



	 $salesman_data[] 	= $record_salesman;



	}



	return $salesman_data;



}

//Added byu MENAKA - on 2-Nov-2017.
//Product Status

function getProductstatus(){

	$select_product_status		=	"SELECT 

											product_status_id,

											product_status_name 

										 FROM 

											product_status 

										 WHERE 

											product_status_deleted_status 	= 0 					AND 

											product_status_active_status 		= 'active'					

										 ORDER BY 

											product_status_name ASC";

								

	$result_product_status 		= mysql_query($select_product_status);

	// Filling up the array

	$product_status_data 			= array();

	while ($record_product_status = mysql_fetch_array($result_product_status))

	{

	 $product_status_data[] 		= $record_product_status;

	}

	return $product_status_data;

}


//Added byu MENAKA - on 2-Nov-2017.
// Sales Mode
function getSalesmodeList(){

	$select_salesmode		=	"SELECT 

									salesmode_id,

									salesmode_name 

								 FROM 

									salesmodes 

								 WHERE 

									salesmode_deleted_status 	= 	0 AND 

									salesmode_active_status 	=	'active'

								 ORDER BY 

									salesmode_name ASC";

	$result_salesmode 	= mysql_query($select_salesmode);

	// Filling up the array

	$salesmode_data 	= array();

	while ($record_salesmode = mysql_fetch_array($result_salesmode))

	{

	 $salesmode_data[] 	= $record_salesmode;

	}

	return $salesmode_data;

}
// Added by MENAKA on 02-Nov-2017
// Delete the Record 

function deleteUniqRecords($table_name, $deleted_by, $deleted_on, $deleted_ip, $deleted_status, $deleted_id, $uniq_id, $status)

{

	$checked 		= $_POST['deleteCheck'];

	$ip 			= getRealIpAddr();

	$count 			= count($checked);

	for($i=0; $i < $count; $i++) {

		$deleteCheck = $checked[$i]; 

		$id = getId($table_name, $deleted_id, $uniq_id, $deleteCheck); 

	 	   $deleterRecord = sprintf("UPDATE $table_name

								  SET    $deleted_by     = '%d',  

										 $deleted_on     = UNIX_TIMESTAMP(NOW()),

										 $deleted_ip     = '%s',

										 $deleted_status = '%d'

								  WHERE  $deleted_id     = '%d'

								  LIMIT 1",

								  $_SESSION[SESS.'_session_user_id'], mysql_real_escape_string($ip),$status,  

								  $id);  

		 mysql_query($deleterRecord);  

	}

}


function deleteMultiRecords($table_name, $deleted_by, $deleted_on, $deleted_ip, $deleted_status, $deleted_id, $main_table, $main_return_field, $main_passing_uniq_id, $status)

{

	

	$checked = $_POST['deleteCheck'];

	$ip = getRealIpAddr();

	$count = count($checked);

	for($i=0; $i < $count; $i++) {

	

		$deleteCheck = $checked[$i]; 

		

		$id = getId($main_table, $main_return_field, $main_passing_uniq_id, $deleteCheck); 

	 	$deleterRecord = sprintf("UPDATE $table_name

								  SET    $deleted_by     = '%d',  

										 $deleted_on     = UNIX_TIMESTAMP(NOW()),

										 $deleted_ip     = '%s',

										 $deleted_status = '%d'

								  WHERE  $deleted_id     = '%d'",

								  $_SESSION[SESS.'_session_user_id'], mysql_real_escape_string($ip),$status,  

								  $id);  //exit;

		 mysql_query($deleterRecord);  

	}

}


///prakash

$arr_acc_head    		= array("pl"=>"Profit & Loss", "bs"=>"Balance Sheet");

$arr_account_type22    		= array("l"=>"Liability", "a"=>"Assets");

$arr_account_type21			= array("op"=>"Opening Stock", "pu"=>"Purchase","ci"=>"Carriage inwards", "sa"=>"Sales","cl"=>"Closing Stock", "in"=>"Income", "ex"=>"Expenses");

$arr_acc_type_two   		= array("1"=>"Current income tax liabilities", "2"=>"Other current liabilities", "3"=>"Property, Plant And Equipment","4"=>"Imprest Account");

$arr_acc_sub_code_type   		= array("cash"=>"Cash", "bank"=>"Bank","customer"=>"Customer", "supplier"=>"Supplier","other"=>"Other");

function searchArryList($arr, $value) 
{
//echo $arr;
	$result = ' ';
	foreach($arr as $arr_value => $arr_list) {
	//echo $value;exit;
		if($arr_value == $value) {
			$result = $arr_list;//exit;
		}
	}
	return $result;
}



///
function ind_oney_format($num){
	if($num==""){
		return "0.00"; 
	}elseif($num==0){
		return "0.00"; 
	}else{
		$num=number_format($num,2,'.','');
		$explrestunits = "" ;
		$num=preg_replace('/,+/', '', $num);
		$words = explode(".", $num);
		$des="00";
		if(count($words)<=2){
			$num=$words[0];
			if($num<0){
				$sym='-';
				$num=substr($num, 1);
			}
			if(count($words)>=2){$des=$words[1];}
			if(strlen($des)<2){$des="$des0";}else{$des=substr($des,0,2);}
		}
		if(strlen($num)>3){
			$lastthree = substr($num, strlen($num)-3, strlen($num));
			$restunits = substr($num, 0, strlen($num)-3); 
			$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; 
			$expunit = str_split($restunits, 2);
			for($i=0; $i<sizeof($expunit); $i++){
				if($i==0){
					$explrestunits .= (int)$expunit[$i].","; 
				}else{
					$explrestunits .= $expunit[$i].",";
				}
			}
			$thecash = $explrestunits.$lastthree;
		} else {
			$thecash = $num;
		}
		//if($sym=="-"){
			//return "$sym$thecash.$des"; 
		//}else{
		return "$thecash.$des"; 
		//}
	}
}


function stockLedger($stock_ledger_type, $stock_ledger_entry_id, $stock_ledger_entry_detail_id,$stock_ledger_product_id, $length_inches,$width_inches,$stock_ledger_product_quantity,$branch_id, $stock_ledger_customer_id, $stock_ledger_godown_id, $stock_ledger_date, $stock_ledger_trans_no,$stock_ledger_entry_type,
$stock_ledger_prd_type) {



$ip = getRealIpAddr();

		$select_ledger	= "	Select
								*
							FROM
								 stock_ledger
							WHERE
								stock_ledger_status				= '0'												AND
								stock_ledger_company_id			= '".$_SESSION[SESS.'_session_company_id']."'		AND
								stock_ledger_financial_year		= '".$_SESSION[SESS.'_session_financial_year']."'	AND
								stock_ledger_branch_id			= '".$branch_id."'									AND
								stock_ledger_entry_id			= '".$stock_ledger_entry_id."'						AND
								stock_ledger_entry_detail_id	= '".$stock_ledger_entry_detail_id."'				AND
								stock_ledger_product_id			= '".$stock_ledger_product_id."'					AND	
								stock_ledger_entry_type			= '".$stock_ledger_entry_type."'					AND
								stock_ledger_prd_type			= '".$stock_ledger_prd_type."'"; 
		$result_ledger	= mysql_query($select_ledger);

		$rows_ledger	= mysql_num_rows($result_ledger);
			if ( $rows_ledger == 0 ) {
					$insert_stock_ledger = "INSERT INTO stock_ledger(	stock_ledger_type,
																		stock_ledger_entry_id,
																		stock_ledger_entry_detail_id,
																		stock_ledger_product_id,
																		stock_ledger_date,
																		stock_ledger_product_length_inches,
																		stock_ledger_product_width_inches,
																		stock_ledger_product_quantity,
																		stock_ledger_godown_id,
																		stock_ledger_customer_id,
																		stock_ledger_trans_no,
																		stock_ledger_entry_type,
																		stock_ledger_prd_type,
																		stock_ledger_added_by,
																		stock_ledger_added_on,
																		stock_ledger_added_ip,	
																		stock_ledger_company_id, 
																		stock_ledger_branch_id,
																		stock_ledger_financial_year,
																		stock_ledger_status) 

																VALUES ('".$stock_ledger_type."',
																		'".$stock_ledger_entry_id."',
																		'".$stock_ledger_entry_detail_id."',
																		'".$stock_ledger_product_id."',
																		'".$stock_ledger_date."',
																		'".$length_inches."',
																		'".$width_inches."',
																		'".$stock_ledger_product_quantity."',
																		'".$stock_ledger_godown_id."',
																		'".$stock_ledger_customer_id."',
																		'".$stock_ledger_trans_no."',
																		'".$stock_ledger_entry_type."',
																		'".$stock_ledger_prd_type."',
																		'".$_SESSION[SESS.'_session_user_id']."',
																		UNIX_TIMESTAMP(NOW()) , 
																		'".$ip."',
																		'".$_SESSION[SESS.'_session_company_id']."',
																		'".$branch_id."',
																		'".$_SESSION[SESS.'_session_financial_year']."',
																		0)";  
					mysql_query($insert_stock_ledger);
			}else{
					

						$update_stock_ledger = "UPDATE stock_ledger SET stock_ledger_purchase_entry_date 	= 	'".$stock_ledger_date."',
																		stock_ledger_product_id				=	'".$stock_ledger_product_id."',
																		stock_ledger_date					=	'".$stock_ledger_date."',
																		stock_ledger_product_length_inches	=	'".$length_inches."',
																		stock_ledger_product_width_inches	=	'".$width_inches."',
																		stock_ledger_product_quantity		=	'".$stock_ledger_product_quantity."',
																		stock_ledger_prd_type				=	'".$stock_ledger_prd_type."',
																		stock_ledger_godown_id				=	'".$stock_ledger_godown_id."',
																		stock_ledger_customer_id			=	'".$stock_ledger_customer_id."',
																		stock_ledger_modified_by			=	'".$_SESSION[SESS.'_session_user_id']."',
																		stock_ledger_modified_on			=	UNIX_TIMESTAMP(NOW()) , 
																		stock_ledger_modified_ip			=	'".$ip."',	
																		stock_ledger_branch_id				=	'".$branch_id."' 
																WHERE	

																		stock_ledger_entry_detail_id		=	'".$stock_ledger_entry_detail_id."'			 AND
																		stock_ledger_type					= '".$stock_ledger_type."'						  AND
																		stock_ledger_entry_type				= '".$stock_ledger_entry_type."' ";   

						

						mysql_query($update_stock_ledger);		

						
			}


}
function employeeFn_details($id){
	$query  = "SELECT employee_id,employee_name
				FROM employees 
				WHERE employee_id ='$id'";
				
	 $result = mysql_query($query);	
	 $array_result = mysql_fetch_array($result);		 
	 return $array_result['employee_id'].' - '.$array_result['employee_name'];
}

function accounts_details($id){
	$query  = "SELECT account_sub_id,account_sub_name
				FROM account_sub 
				WHERE account_sub_id ='$id'";
				
	 $result = mysql_query($query);	
	 $array_result = mysql_fetch_array($result);		 
	 return $array_result['account_sub_id'].' - '.$array_result['account_sub_name'];
}

?>