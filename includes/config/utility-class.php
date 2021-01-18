<?php 

$arr_product_type    		= array("1"=>"Raw", "2"=>"Semi", "3"=>"Finished Product");

$arr_product_type    		= array("1"=>"Raw", "2"=>"Accessories", "3"=>"Finished Good");

$arr_so_type    			= array("1"=>"Direct", "2"=>"Phone", "3"=>"Email");

//$arr_producton_type    		= array("1"=>"ROOFING", "2"=>"C CHANNEL", "3"=>"ACCESSORIES");
$select_cat 	= "	SELECT 
								*  
							FROM 
								product_categories
				   			WHERE 
								product_category_deleted_status 	= 0	
							ORDER BY 
								product_category_name ASC";

	$result_cat 	= mysql_query($select_cat);
	$arr_producton_type = array();
	$i					= 0;
	while($record_cat = mysql_fetch_array($result_cat)) {
		$arr_producton_type[$record_cat['product_category_id']] = $record_cat['product_category_name'];
	}


$arr_delivery_type    		= array("1"=>"CUSTOMER", "2"=>"COMPANY");
$arr_cn_type    			= array("1"=>"Returnable Stock", "2"=>"Price Differences");

$payment    				= array("1"=>"Paid", "2"=>"Un Paid");

// Added by MENAKA on 02-Nov-2017
$arr_reserve    			= array("1"=>"Customer", "2"=>" Sales");	

//Login Authendication

$arr_pay_mode    	 	= array("1"=>"Cash", "2"=>" Bank");	
$arr_paytype    	 	= array("1"=>"Expense", "2"=>"Employee Advance");	
$arr_leave_status    	= array("1"=>"Present", "2"=>"Absent");	
$arr_leaveType	  	 	= array("1"=>"Addition", "2"=>"Casual" ,"3"=>"Medical","4"=>"Anual","5"=>"Other");
$arrQuotationType		= array("1"=>"Raw Length Sales", "2"=>"Raw Weight Sales" ,"4"=>"Accessories Sales");
//$arr_thick	  	 		= array("1"=>"0.1", "2"=>"0.2" ,"3"=>"0.3","4"=>"0.4","5"=>"0.5","6"=>"0.6", "7"=>"0.7" ,"8"=>"0.8","9"=>"0.9","10"=>"1.0");

	$select_company 	= "	SELECT 
								thick_id, 
								thick_val  
							FROM 
								thickness 
				   			WHERE 
								thick_deleted_status 	= 0	
							ORDER BY 
								thick_val ASC";

	$result_company 	= mysql_query($select_company);
	$arr_thick 		= array();
	$i					= 0;
	while($record_company = mysql_fetch_array($result_company)) {
		$arr_thick[$record_company['thick_id']] = $record_company['thick_val'];
	}


$arr_product_order		= array("1"=>"Branch", "2"=>" Own");	
$arr_damage				= array("1"=>"Accessories", "2"=>"Raw Materials" ,"3"=>"Manufacturing Scrp");
define("DAMAGE", serialize($arr_damage));
//prakash 

$arr_credit_type	   = array("1"=>"Stock", "2"=>"Account");
 function diff_days($to_date,$from_date){  
			return (strtotime($from_date) - strtotime($to_date)) / 86400;  
} 	

function getCompanyDetails()
{
	 $select_company = 'SELECT *
	                       FROM companies WHERE company_id = "'.$_SESSION[SESS.'_session_company_id'].'"';
	
	$result = mysql_query($select_company);
	$row = mysql_fetch_array($result);
	return $row;
}

function get_branch_name($branch_id){
	  $select_module_branch = "SELECT 
									branch_id, 
									branch_name,
									branch_code
							 FROM 
							 		branches 
							 WHERE  
							 		branch_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'				AND 
							 		branch_active_status 	='active'  													AND 
									branch_deleted_status 	= 0 														AND
									branch_id				= '".$branch_id."' ";
	$result_module_branch = mysql_query($select_module_branch);
	$record_module_branch = mysql_fetch_array($result_module_branch);

		return $branch_name	=	$record_module_branch['branch_name'];	
	
//	return $branch_name		  = strtoupper(substr($record_module_branch['branch_name'],0,3)); 
}

function loginAuthentication()

{

	if(!isset($_SESSION[SESS.'_session_user_id'])) {

		header("Location:".PROJECT_PATH); 



		exit();



	}	



}

function GetPdCalc($calculation_id,$calc_amount){
	if($calculation_id==1){

		return number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format(($calc_amount*304.8),'4','.','')."@".number_format(($calc_amount*0.3048),'4','.','');

	}

	if($calculation_id==2){

		return number_format(($calc_amount/12),'4','.','')."@".number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*25.4),'4','.','')."@".number_format(($calc_amount*0.0254),'4','.','');

	}

	if($calculation_id==3){

		return number_format(($calc_amount/304.8),'4','.','')."@".number_format(($calc_amount/25.4),'4','.','')."@".number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*0.001),'4','.','');

	}

	if($calculation_id==4){

		return number_format(($calc_amount/0.3048),'4','.','')."@".number_format(($calc_amount/0.0254),'4','.','')."@".number_format(($calc_amount*1000),'4','.','')."@".number_format(($calc_amount*1),'4','.','');

	}
	
	if($calculation_id==5){

		return number_format(($calc_amount/12),'4','.','')."@".number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*25.4),'4','.','')."@".number_format(($calc_amount*0.0254),'4','.','');

	}

	if($calculation_id==6){

		return number_format(($calc_amount/304.8),'4','.','')."@".number_format(($calc_amount/25.4),'4','.','')."@".number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*0.001),'4','.','');

	}
	
	if($calculation_id==7){

		return number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format(($calc_amount*304.8),'4','.','')."@".number_format(($calc_amount*0.3048),'4','.','');

	}
	
	if($calculation_id==8){

		return  number_format(($calc_amount/0.3048),'4','.','')."@".number_format(($calc_amount/0.0254),'4','.','')."@".number_format(($calc_amount*1000),'4','.','')."@".number_format(($calc_amount*1),'4','.','');

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

    // echo $select_id;exit;

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
								product_code,
								product_name,
								product_uom_name,
								product_thick_ness,
								product_id,
								product_inches_qty,
								product_purchase_uom_id,
								brand_name,
								product_brand_id,
								product_mm_qty,
								product_inches_qty,
								product_feet_qty 
							 FROM 
								products 
							LEFT JOIN 
								product_uoms 
							ON 
								product_uom_id 						= product_purchase_uom_id
							LEFT JOIN 
								brands 
							ON 
								brand_id 							= product_brand_id
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
function getPurCostingList(){



	$select_pur_costing		=	"SELECT 
								pur_costing_id,
								pur_costing_name 
							 FROM 
								pur_costings 
							 WHERE 
								pur_costing_deleted_status 	= 	0 AND 
								pur_costing_active_status 	=	'active'
							 ORDER BY 
								pur_costing_name ASC";
	$result_pur_costing 	= mysql_query($select_pur_costing);
	// Filling up the array
	$pur_costing_data 	= array();
	while ($record_pur_costing = mysql_fetch_array($result_pur_costing))
	{
	 $pur_costing_data[] 	= $record_pur_costing;
	}
	return $pur_costing_data;
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

function getGodownList($id=''){

	$where	= '';
	if($id!=''){
		$where.=" AND godown_id ='".$id."'";
	}

	$select_godown		=	"SELECT 



								godown_id,



								godown_name 



							 FROM 



								godowns 



							 WHERE 



								godown_deleted_status 	= 	0 AND 



								godown_active_status 	=	'active'

								$where

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

function getBankList(){
	$select_bank		=	"SELECT 
								bank_id,
								bank_name 
							 FROM 
								banks 
							 WHERE 
								bank_deleted_status 	= 	0 AND 
								bank_active_status 		=	'active'
							 ORDER BY 
								bank_name ASC";
	$result_bank 		= mysql_query($select_bank);
	// Filling up the array
	$bank_data 	= array();
	while ($record_bank = mysql_fetch_array($result_bank))
	{
	 $bank_data[] 		= $record_bank;
	}
	return $bank_data;
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

function deleteUniqRecords($table_name, $deleted_by, $deleted_on, $deleted_ip, $deleted_status, $deleted_id, $uniq_id, $status,$acc_type='')

{

	$checked 		= $_POST['deleteCheck'];

	$ip 			= getRealIpAddr();

	$count 			= count($checked);

	for($i=0; $i < $count; $i++) {

		$deleteCheck = $checked[$i]; 

		$id = getId($table_name, $deleted_id, $uniq_id, $deleteCheck); 
		//echo $id;exit;

	 	   $deleterRecord = sprintf("UPDATE $table_name

								  SET    $deleted_by     = '%d',  

										 $deleted_on     = UNIX_TIMESTAMP(NOW()),

										 $deleted_ip     = '%s',

										 $deleted_status = '%d'

								  WHERE  $deleted_id     = '%d'

								  LIMIT 1",

								  $_SESSION[SESS.'_session_user_id'], mysql_real_escape_string($ip),$status,  

								  $id);
								  
								 // echo $deleterRecord;exit;  

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

$arr_account_type21			= array("op"=>"Opening Stock", "pu"=>"Purchase","ci"=>"Carriage inwards", "co"=>"Carriage outwards","sa"=>"Sales","cl"=>"Closing Stock", "in"=>"Income", "ex"=>"Expenses", "mf"=>"Manufacture");

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
function stockLedger($stock_ledger_mother_child_type,$stock_ledger_type, $stock_ledger_entry_id, $stock_ledger_entry_detail_id,$stock_ledger_product_id, $stock_ledger_length_feet,$stock_ledger_length_meter,$stock_ledger_weight_tone,$stock_ledger_weight_kg,$stock_ledger_product_quantity,$stock_ledger_branch_id, $stock_ledger_godown_id, $stock_ledger_date, $stock_ledger_trans_no,$stock_ledger_entry_type,$stock_ledger_prd_type,$width_inches='',$width_mm='',$product_colour_id='',$product_thick='') {
$ip = getRealIpAddr();

		 $select_ledger	= "	Select
								*
							FROM
								 stock_ledger
							WHERE
								stock_ledger_status				= '0'												AND
								stock_ledger_company_id			= '".$_SESSION[SESS.'_session_company_id']."'		AND
								stock_ledger_financial_year		= '".$_SESSION[SESS.'_session_financial_year']."'	AND
								stock_ledger_branch_id			= '".$stock_ledger_branch_id."'									AND
								stock_ledger_entry_id			= '".$stock_ledger_entry_id."'						AND
								stock_ledger_entry_detail_id	= '".$stock_ledger_entry_detail_id."'				AND
								stock_ledger_product_id			= '".$stock_ledger_product_id."'					AND	
								stock_ledger_godown_id			= '".$stock_ledger_godown_id."'						AND	
								stock_ledger_entry_type			= '".$stock_ledger_entry_type."'					AND
								stock_ledger_prd_type			= '".$stock_ledger_prd_type."'						AND
								stock_ledger_type				= '".$stock_ledger_type."'"; 
								
							//	echo $select_ledger	;exit;
		$result_ledger	= mysql_query($select_ledger);

		$rows_ledger	= mysql_num_rows($result_ledger);
			if ( $rows_ledger == 0 ) {
					  $insert_stock_ledger = "INSERT INTO stock_ledger(	stock_ledger_type,
																		stock_ledger_entry_id,
																		stock_ledger_entry_detail_id,
																		stock_ledger_product_id,
																		stock_ledger_date,
																		stock_ledger_colour_id,
																		stock_ledger_thick_ness,
																		stock_ledger_width_inches,
																		stock_ledger_width_mm,
																		stock_ledger_length_feet,
																		stock_ledger_length_meter,
																		stock_ledger_weight_tone,
																		stock_ledger_weight_kg,
																		stock_ledger_product_quantity,
																		stock_ledger_godown_id,
																		stock_ledger_trans_no,
																		stock_ledger_entry_type,
																		stock_ledger_prd_type,
																		stock_ledger_added_by,
																		stock_ledger_added_on,
																		stock_ledger_added_ip,	
																		stock_ledger_company_id, 
																		stock_ledger_branch_id,
																		stock_ledger_financial_year,
																		stock_ledger_status,
																		stock_ledger_mother_child_type) 

																VALUES ('".$stock_ledger_type."',
																		'".$stock_ledger_entry_id."',
																		'".$stock_ledger_entry_detail_id."',
																		'".$stock_ledger_product_id."',
																		'".$stock_ledger_date."',
																		'".$product_colour_id."',
																		'".$product_thick."',
																		'".$width_inches."',
																		'".$width_mm."',
																		'".$stock_ledger_length_feet."',
																		'".$stock_ledger_length_meter."',
																		'".$stock_ledger_weight_tone."',
																		'".$stock_ledger_weight_kg."',
																		'".$stock_ledger_product_quantity."',
																		'".$stock_ledger_godown_id."',
																		'".$stock_ledger_trans_no."',
																		'".$stock_ledger_entry_type."',
																		'".$stock_ledger_prd_type."',
																		'".$_SESSION[SESS.'_session_user_id']."',
																		UNIX_TIMESTAMP(NOW()) , 
																		'".$ip."',
																		'".$_SESSION[SESS.'_session_company_id']."',
																		'".$stock_ledger_branch_id."',
																		'".$_SESSION[SESS.'_session_financial_year']."',
																		0,'".$stock_ledger_mother_child_type."')"; 
												//echo $insert_stock_ledger;exit;
					mysql_query($insert_stock_ledger);
			}else{
					
					$record = mysql_fetch_array($result_ledger);
						 $update_stock_ledger = "UPDATE stock_ledger SET stock_ledger_date 	= 	'".$stock_ledger_date."',
																		stock_ledger_product_id				=	'".$stock_ledger_product_id."',
																		stock_ledger_date					=	'".$stock_ledger_date."',
																		stock_ledger_width_inches			=	'".$width_inches."',
																		stock_ledger_width_mm				=	'".$width_mm."',
																		stock_ledger_length_feet			=	'".$stock_ledger_length_feet."',
																		stock_ledger_length_meter			=	'".$stock_ledger_length_meter."',
																		stock_ledger_weight_tone			=	'".$stock_ledger_weight_tone."',
																		stock_ledger_weight_kg				=	'".$stock_ledger_weight_kg."',
																		stock_ledger_product_quantity		=	'".$stock_ledger_product_quantity."',
																		stock_ledger_prd_type				=	'".$stock_ledger_prd_type."',
																		stock_ledger_colour_id				=	'".$product_colour_id."',
																		stock_ledger_godown_id				=	'".$stock_ledger_godown_id."',
																		stock_ledger_modified_by			=	'".$_SESSION[SESS.'_session_user_id']."',
																		stock_ledger_modified_on			=	UNIX_TIMESTAMP(NOW()) , 
																		stock_ledger_modified_ip			=	'".$ip."',	
																		stock_ledger_branch_id				=	'".$stock_ledger_branch_id."' 
																WHERE	

																		stock_ledger_id		=	'".$record['stock_ledger_id']."' ";   

						
					//echo $update_stock_ledger; exit;
						mysql_query($update_stock_ledger);		

						
			}


}
function stockLedger_opp($feet_per_qty,$stock_ledger_mother_child_type,$stock_ledger_type, $stock_ledger_entry_id, $stock_ledger_entry_detail_id,$stock_ledger_product_id, $stock_ledger_length_feet,$stock_ledger_length_meter,$stock_ledger_weight_tone,$stock_ledger_weight_kg,$stock_ledger_product_quantity,$stock_ledger_branch_id, $stock_ledger_godown_id, $stock_ledger_date, $stock_ledger_trans_no,$stock_ledger_entry_type,$stock_ledger_prd_type,$width_inches='',$width_mm='',$product_colour_id='',$product_thick='',$sale_feet='') {
$ip = getRealIpAddr();
	if($sale_feet == "") {
		$sale_feet = 0;
	}
	
	//echo $stock_ledger_product_id. "ccc"; exit();
		 $select_ledger	= "	Select
								*
							FROM
								 stock_ledger
							WHERE
								stock_ledger_status				= '0'												AND
								stock_ledger_company_id			= '".$_SESSION[SESS.'_session_company_id']."'		AND
								stock_ledger_financial_year		= '".$_SESSION[SESS.'_session_financial_year']."'	AND
								stock_ledger_branch_id			= '".$stock_ledger_branch_id."'									AND
								stock_ledger_entry_id			= '".$stock_ledger_entry_id."'						AND
								stock_ledger_entry_detail_id	= '".$stock_ledger_entry_detail_id."'				AND
								stock_ledger_product_id			= '".$stock_ledger_product_id."'					AND	
								stock_ledger_godown_id			= '".$stock_ledger_godown_id."'						AND	
								stock_ledger_entry_type			= '".$stock_ledger_entry_type."'					AND
								stock_ledger_prd_type			= '".$stock_ledger_prd_type."'						AND
								stock_ledger_type				= '".$stock_ledger_type."'"; 
								
							//	echo $select_ledger	;exit;
		$result_ledger	= mysql_query($select_ledger);

		$rows_ledger	= mysql_num_rows($result_ledger);
			if ( $rows_ledger == 0 ) {
					  $insert_stock_ledger = "INSERT INTO stock_ledger(	stock_ledger_type,
																		stock_ledger_entry_id,
																		stock_ledger_entry_detail_id,
																		stock_ledger_product_id,
																		stock_ledger_date,
																		stock_ledger_colour_id,
																		stock_ledger_thick_ness,
																		stock_ledger_width_inches,
																		stock_ledger_width_mm,
																		stock_ledger_length_feet,
																		stock_ledger_length_meter,
																		stock_ledger_weight_tone,
																		stock_ledger_weight_kg,
																		stock_ledger_product_quantity,
																		stock_ledger_product_feet_per_quantity,
																		stock_ledger_product_feet,
																		stock_ledger_godown_id,
																		stock_ledger_trans_no,
																		stock_ledger_entry_type,
																		stock_ledger_prd_type,
																		stock_ledger_added_by,
																		stock_ledger_added_on,
																		stock_ledger_added_ip,	
																		stock_ledger_company_id, 
																		stock_ledger_branch_id,
																		stock_ledger_financial_year,
																		stock_ledger_status,
																		stock_ledger_mother_child_type) 

																VALUES ('".$stock_ledger_type."',
																		'".$stock_ledger_entry_id."',
																		'".$stock_ledger_entry_detail_id."',
																		'".$stock_ledger_product_id."',
																		'".$stock_ledger_date."',
																		'".$product_colour_id."',
																		'".$product_thick."',
																		'".$width_inches."',
																		'".$width_mm."',
																		'".$stock_ledger_length_feet."',
																		'".$stock_ledger_length_meter."',
																		'".$stock_ledger_weight_tone."',
																		'".$stock_ledger_weight_kg."',
																		'".$stock_ledger_product_quantity."',
																		'".$feet_per_qty."',
																		'".$sale_feet."',
																		'".$stock_ledger_godown_id."',
																		'".$stock_ledger_trans_no."',
																		'".$stock_ledger_entry_type."',
																		'".$stock_ledger_prd_type."',
																		'".$_SESSION[SESS.'_session_user_id']."',
																		UNIX_TIMESTAMP(NOW()) , 
																		'".$ip."',
																		'".$_SESSION[SESS.'_session_company_id']."',
																		'".$stock_ledger_branch_id."',
																		'".$_SESSION[SESS.'_session_financial_year']."',
																		0,'".$stock_ledger_mother_child_type."')"; 
												//echo $insert_stock_ledger;exit;
					mysql_query($insert_stock_ledger);
			}else{
					
					$record = mysql_fetch_array($result_ledger);
						 $update_stock_ledger = "UPDATE stock_ledger SET stock_ledger_date 	= 	'".$stock_ledger_date."',
																		stock_ledger_product_id				=	'".$stock_ledger_product_id."',
																		stock_ledger_date					=	'".$stock_ledger_date."',
																		stock_ledger_length_feet			=	'".$stock_ledger_length_feet."',
																		stock_ledger_length_meter			=	'".$stock_ledger_length_meter."',
																		stock_ledger_weight_tone			=	'".$stock_ledger_weight_tone."',
																		stock_ledger_weight_kg				=	'".$stock_ledger_weight_kg."',
																		stock_ledger_product_quantity		=	'".$stock_ledger_product_quantity."',
																		stock_ledger_product_feet_per_quantity		=	'".$feet_per_qty."',
																		stock_ledger_product_feet		=	'".$sale_feet."',
																		stock_ledger_prd_type				=	'".$stock_ledger_prd_type."',
																		stock_ledger_colour_id				=	'".$product_colour_id."',
																		stock_ledger_godown_id				=	'".$stock_ledger_godown_id."',
																		stock_ledger_modified_by			=	'".$_SESSION[SESS.'_session_user_id']."',
																		stock_ledger_modified_on			=	UNIX_TIMESTAMP(NOW()) , 
																		stock_ledger_modified_ip			=	'".$ip."',	
																		stock_ledger_branch_id				=	'".$stock_ledger_branch_id."' 
																WHERE	

																		stock_ledger_id		=	'".$record['stock_ledger_id']."' ";   

						
					//echo $update_stock_ledger; exit;
						mysql_query($update_stock_ledger) or die(mysql_error());		

						
			}


}
function DeleteStockLedger($stock_ledger_entry_type,$invoice_entry_id,$invoice_entry_product_detail_id,$stock_ledger_type){
				$ip = getRealIpAddr();
						 $update_stock_ledger = "UPDATE 
						 							stock_ledger 
												SET 
													stock_ledger_status				= '1',
													stock_ledger_deleted_by			=	'".$_SESSION[SESS.'_session_user_id']."',
													stock_ledger_deleted_on			=	UNIX_TIMESTAMP(NOW()) , 
													stock_ledger_deleted_ip			=	'".$ip."'
												WHERE	
													stock_ledger_entry_id				= '".$invoice_entry_id."'			 			AND
													stock_ledger_entry_detail_id		= '".$invoice_entry_product_detail_id."'			AND
													stock_ledger_type					= '".$stock_ledger_type."'						  	AND
													stock_ledger_entry_type				= '".$stock_ledger_entry_type."' ";   

						//echo $update_stock_ledger;exit;
						mysql_query($update_stock_ledger);		
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
function GetTotallenWei($brand_id,$thickid,$width_inches,$val){
		  $query = "SELECT
		 			 wc_weight_ton
		 			FROM 
						weight_calulation
		 			WHERE 
						wc_brand_id		= '".$brand_id."' 									AND
						wc_thickid		= '".$thickid."'									AND
						wc_wight_inches	= '".$width_inches."'								AND
						wc_length_feet	= '1'"; 
						
		 $result = mysql_query($query);
		 $record = mysql_fetch_array($result);	
		return $record['wc_weight_ton'];
}
function getProductGetail($product_id){
	$select_product		=	"SELECT 
								*
							 FROM 
								products 
							 WHERE 
								product_deleted_status 		= 0 					AND 
								product_id 					= '".$product_id."' 					AND
								product_active_status 		= 'active'						
							 ORDER BY 
								product_name ASC";
								
								//echo $select_product;exit;

	$result_product 		= mysql_query($select_product);
	return $record_product  = mysql_fetch_array($result_product);
}
function Child_prod_detail($product_id){
	$select_product		=	"SELECT 
								*
							 FROM 
								product_con_entry_child_product_details
							 LEFT JOIN
							 	products
							 ON
							 	product_id													=  product_con_entry_child_product_detail_product_id
							 WHERE 
								product_con_entry_child_product_detail_deleted_status 		= 0 					AND 
								product_con_entry_child_product_detail_product_id 					= '".$product_id."'					
							 ORDER BY 
								product_con_entry_child_product_detail_id ASC";
								
							//	echo 	$select_product	;exit;
								

	$result_product 		= mysql_query($select_product);
	return $record_product  = mysql_fetch_array($result_product);
}

function getRawProductGetail($product_id){
	$select_product			=	"SELECT 
									*
								 FROM 
									product_details 
								 LEFT JOIN
								 	products
								ON
									product_id							= product_detail_raw_product_id
								 WHERE 
									product_detail_deleted_status 		= 0 					AND 
									product_detail_product_id 			= '".$product_id."' 					
								 ORDER BY 
									product_detail_product_id ASC";

	$result_product_status 		= mysql_query($select_product);
	while ($record_product_status = mysql_fetch_array($result_product_status)){
	 $product_status_data[] 		= $record_product_status;
	}
	return $product_status_data;
}
function getSecRawProductGetail($product_id){
	$select_product			=	"SELECT 
									*
								 FROM 
									product_details_one 
								 LEFT JOIN
								 	products
								ON
									product_id							= product_detail_raw_product_id1
								 WHERE 
									product_detail_deleted_status 		= 0 					AND 
									product_detail_product_id1 			= '".$product_id."' 					
								 ORDER BY 
									product_detail_product_id1  ASC";

	$result_product_status 		= mysql_query($select_product);
	while ($record_product_status = mysql_fetch_array($result_product_status)){
	 $product_status_data[] 		= $record_product_status;
	}
	return $product_status_data;
}


function width_cutting_product_details($product_id, $width_cutting_id){
	$select_product		=	"SELECT 
								*
							 FROM 
								width_cutting_product_details
							
							 WHERE 
								width_cutting_product_detail_deleted_status 		= 0 					AND 
								width_cutting_product_detail_product_id 					= '".$product_id."'	 AND 
								width_cutting_product_detail_width_cutting_id 					= '".$width_cutting_id."'	 ";

	$result_product 		= mysql_query($select_product);
	return $record_product  = mysql_fetch_array($result_product);
}


function reduceRawMaterial($stock_ledger_mother_child_type,$product_id,$thick,$color_id,$width_inches,$tot_len,$entry_no,$entry_date,$entry_id,$detail_id,$branch_id,$entry_type,$type_id,$ton_qty,$kg_qty,$product_detail_qty1,$sl_feet){ 
				
				$product_detail_qty											= empty($product_detail_qty1)?'1':$product_detail_qty1;
				$rec_product												= 	getProductGetail($product_id);
				$get_raw													=  getRawProductGetail($product_id);
				
				//print_r($rec_product);exit;
			if($rec_product['product_type']==3 && count($get_raw)>0){  
				
				if(isset($get_raw)){ 
					foreach($get_raw as $get_raw_val){
						$rec_product										= 	getProductGetail($get_raw_val['product_detail_raw_product_id']);
						$brand_id											= 	$get_raw_val['product_brand_id'];
						$total_ton											=  	GetTotallenWei($brand_id,$thick,$width_inches,'');
						if($type_id==1){
							$length_feet										= 	$tot_len;
							$product_cal										=   explode("@",GetPdCalc('1',$tot_len));
							$length_meter										= 	$product_cal['3'];
							$ton_qty											= 	$total_ton*$length_feet;
							$kg_qty												= 	$ton_qty*1000;
						}
						else{
							//$length_feet										= 	$ton_qty/$total_ton;
							$length_feet										= 	$sl_feet;
							$product_cal										=   explode("@",GetPdCalc('1',$length_feet));
							$length_meter										= 	$product_cal['3'];
						}
						$product_cal										=   explode("@",GetPdCalc('2',$width_inches));
						$width_mm											= 	$product_cal['2'];							
						$product_detail_qty									= 	(-1*$product_detail_qty);
						$stock_ledger_entry_type							= 	$entry_type;
						$product_con_entry_godown_id						= 	"2";
						$produt_id											= $get_raw_val['product_detail_raw_product_id'];
						stockLedger($stock_ledger_mother_child_type,'out',$entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $branch_id,  	$product_con_entry_godown_id, $entry_date, $entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick	);
					}
					
				}
				$get_sec_raw												=  getSecRawProductGetail($product_id);
				if(isset($get_sec_raw)){
					foreach($get_sec_raw as $get_raw_val){
						$rec_product										= 	getProductGetail($get_raw_val['product_detail_raw_product_id1']);
						$brand_id											= 	$get_raw_val['product_brand_id'];
						$total_ton											=  	GetTotallenWei($brand_id,$thick,$width_inches,'');
						if($type_id==1){
							$length_feet									= 	$tot_len;
							$product_cal									=   explode("@",GetPdCalc('1',$tot_len));
							$length_meter									= 	$product_cal['3'];
							$ton_qty										= 	$total_ton*$length_feet;
							$kg_qty											= 	$ton_qty*1000;
						}
						else{
							$length_feet									= 	$ton_qty/$total_ton; 
							$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
							$length_meter									= 	$product_cal['3'];
						}
						$product_cal										=   explode("@",GetPdCalc('2',$width_inches));
						$width_mm											= 	$product_cal['2'];							
						$product_detail_qty									= 	(-1*$product_detail_qty);
						$stock_ledger_entry_type							= 	$entry_type;
						$product_con_entry_godown_id						= 	"2";
						$width_inches										= '';
						$width_mm											= '';
						$color_id											= '';
						$thick												= '';
						$produt_id											= $get_raw_val['product_detail_raw_product_id1'];
						//echo $ton_qty;exit;
						stockLedger($stock_ledger_mother_child_type,'out',$entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $branch_id,  	$product_con_entry_godown_id, $entry_date, $entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
					}
				}
			}
			else{ 
					$brand_id											= 	$rec_product['product_brand_id'];
					$total_ton											=  	GetTotallenWei($brand_id,$thick,$width_inches,'');
					if($type_id==1){
						$length_feet										= 	$tot_len;
						$product_cal										=   explode("@",GetPdCalc('1',$tot_len));
						$length_meter										= 	$product_cal['3'];
						$ton_qty											= 	$total_ton*$length_feet;
						$kg_qty												= 	$ton_qty*1000;
					}
					else{
						$length_feet										= 	$ton_qty/$total_ton; //echo $total_ton;exit;
						$product_cal										=   explode("@",GetPdCalc('1',$length_feet));
						$length_meter										= 	$product_cal['3'];
					}
					$product_cal										=   explode("@",GetPdCalc('2',$width_inches));
					$width_mm											= 	$product_cal['2'];							
					$product_detail_qty									= 	(-1*$product_detail_qty);
					$stock_ledger_entry_type							= 	$entry_type;
					$product_con_entry_godown_id						= 	"2";
					//echo $ton_qty;exit;
					stockLedger($stock_ledger_mother_child_type,'out',$entry_id,$detail_id,$product_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $branch_id,  	$product_con_entry_godown_id, $entry_date, $entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
			}
}
function reduceRawMaterialIn($product_id,$thick,$color_id,$width_inches,$tot_len,$entry_no,$entry_date,$entry_id,$detail_id,$branch_id,$entry_type,$type_id,$ton_qty,$kg_qty,$product_detail_qty){ 
				$product_detail_qty										= 1;
				$rec_product											= 	getProductGetail($product_id);
				$get_raw												=  getRawProductGetail($product_id);
			if($rec_product['product_type']==3 && count($get_raw)>0){
				foreach($get_raw as $get_raw_val){
					$rec_product										= 	getProductGetail($get_raw_val['product_detail_raw_product_id']);
					$brand_id											= 	$get_raw_val['product_brand_id'];
					$total_ton											=  	GetTotallenWei($brand_id,$thick,$width_inches,'');
					if($type_id==1){
						$length_feet										= 	$tot_len;
						$product_cal										=   explode("@",GetPdCalc('1',$tot_len));
						$length_meter										= 	$product_cal['3'];
						$ton_qty											= 	$total_ton*$length_feet;
						$kg_qty												= 	$ton_qty*1000;
					}
					else{
						$length_feet										= 	$ton_qty/$total_ton;
						$product_cal										=   explode("@",GetPdCalc('1',$length_feet));
						$length_meter										= 	$product_cal['3'];
					}
					$product_cal										=   explode("@",GetPdCalc('2',$width_inches));
					$width_mm											= 	$product_cal['2'];							
					$product_detail_qty									= 	$product_detail_qty;
					$stock_ledger_entry_type							= 	$entry_type;
					$product_con_entry_godown_id						= 	"2";
					$produt_id											= $get_raw_val['product_detail_raw_product_id'];
					stockLedger('in',$entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $branch_id,  	$product_con_entry_godown_id, $entry_date, $entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
				}
				$get_raw												=  getSecRawProductGetail($product_id);
				foreach($get_raw as $get_raw_val){
					$rec_product										= 	getProductGetail($get_raw_val['product_detail_raw_product_id1']);
					$brand_id											= 	$get_raw_val['product_brand_id'];
					$total_ton											=  	GetTotallenWei($brand_id,$thick,$width_inches,'');
					if($type_id==1){
						$length_feet										= 	$tot_len;
						$product_cal										=   explode("@",GetPdCalc('1',$tot_len));
						$length_meter										= 	$product_cal['3'];
						$ton_qty											= 	$total_ton*$length_feet;
						$kg_qty												= 	$ton_qty*1000;
					}
					else{
						$length_feet										= 	$ton_qty/$total_ton;
						$product_cal										=   explode("@",GetPdCalc('1',$length_feet));
						$length_meter										= 	$product_cal['3'];
					}
					
					$product_cal										=   explode("@",GetPdCalc('2',$width_inches));
					$width_mm											= 	$product_cal['2'];							
					$product_detail_qty									= 	$product_detail_qty;
					$stock_ledger_entry_type							= 	$entry_type;
					$product_con_entry_godown_id						= 	"2";
					$width_inches										= '';
					$width_mm											= '';
					$color_id											= '';
					$thick												= '';
					$produt_id											= $get_raw_val['product_detail_raw_product_id1'];
					stockLedger('in',$entry_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $branch_id,  	$product_con_entry_godown_id, $entry_date, $entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
				}
				
			}
			else{
					$brand_id											= 	$rec_product['product_brand_id'];
					$total_ton											=  	GetTotallenWei($brand_id,$thick,$width_inches,'');
					if($type_id==1){
						$length_feet										= 	$tot_len;
						$product_cal										=   explode("@",GetPdCalc('1',$tot_len));
						$length_meter										= 	$product_cal['3'];
						$ton_qty											= 	$total_ton*$length_feet;
						$kg_qty												= 	$ton_qty*1000;
					}
					else{
						$length_feet										= 	$ton_qty/$total_ton;
						$product_cal										=   explode("@",GetPdCalc('1',$length_feet));
						$length_meter										= 	$product_cal['3'];
					}
					$product_cal										=   explode("@",GetPdCalc('2',$width_inches));
					$width_mm											= 	$product_cal['2'];							
					$product_detail_qty									= 	$product_detail_qty;
					$stock_ledger_entry_type							= 	$entry_type;
					$product_con_entry_godown_id						= 	"2";
					stockLedger('in',$entry_id,$detail_id,$product_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $branch_id,  	$product_con_entry_godown_id, $entry_date, $entry_no,$stock_ledger_entry_type, '2',$width_inches,$width_mm,$color_id,$thick);
			}
}

function GetBranchAccSetup($branch_id){
	
		$select_branch 	= "SELECT 
								* 
						   FROM 
						   		account_setup
						   WHERE 
						   		acS_branchid 			=   '".$branch_id."' ";  
		$result_branch 	= mysql_query($select_branch);
		$row_branch 	= mysql_fetch_array($result_branch);
		return $row_branch;
		
}
function getMasterID($account_id, $type) {
		$select_name = "SELECT account_sub_id FROM account_sub 
						WHERE account_sub_deleted_status =0 AND account_sub_master_id = '".$account_id."' 
						AND account_sub_company_id = '".$_SESSION[SESS.'_session_company_id']."'
						AND account_sub_code_type = '".$type."' "; 
		$result_name = mysql_query($select_name);
		$record_name = mysql_fetch_array($result_name);
		return $record_name['account_sub_id'];
}
function getCurrencyAmt($account_id,$entry_date){
	$select_account = "SELECT 
							currency_detail_amount,
							currency_detail_currency_id,
							currency_name
						FROM
							currency_details
						LEFT JOIN
								currencies 
						ON
								currency_detail_currency_id				= currency_id 
						WHERE
								currency_detail_deleted_status			= '0'	AND
								currency_detail_currency_id	 IN (SELECT 
																				account_sub_currency_id 
																			FROM 
																				account_sub 
																			WHERE 
																				account_sub_deleted_status =0 					AND 
																				account_sub_id = '".$account_id."') 
																		  AND
					    		currency_detail_date <='".$entry_date."'			 
						 ORDER BY 
								currency_detail_date DESC
						LIMIT 0,1";
	$result_account = mysql_query($select_account);
	$record_account = mysql_fetch_array($result_account);
	$currency_amt	= $record_account['currency_detail_amount'];
	$currency_id	= $record_account['currency_detail_currency_id'];
	if($_SESSION[SESS.'_default_currency_id']==$currency_id){
			$currency_amt	= 1;
			$display		= '';
	}
	else{
			$currency_amt	= $record_account['currency_detail_amount'];
	}
	return $currency_amt;
}
function update_transaction($acc_transaction_voucher_id, $acc_transaction_no, $acc_transaction_date,  $acc_transaction_type, $acc_transaction_account_id,
$acc_transaction_account_id1, $acc_transaction_cord, $acc_transaction_amount, $acc_transaction_remark,  $acc_transaction_branch_id,$acc_transaction_amount_mmk='')
{ //echo $acc_transaction_amount_mmk."<br/>";
	$ip = getRealIpAddr();
	$transaction_select="SELECT  acc_transaction_id FROM acc_transaction
						WHERE acc_transaction_company_id 	= '".$_SESSION[SESS.'_session_company_id']."'
						AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
						AND  acc_transaction_voucher_id 	= '".$acc_transaction_voucher_id."'
						AND  acc_transaction_type 			= '".$acc_transaction_type."'
						AND  acc_transaction_cord  		= '".$acc_transaction_cord."'
						AND acc_transaction_deleted_status	= 0 "; 
	$acc_transaction_number = mysql_query($transaction_select) or die(mysql_error());
	$rows_transaction_no = mysql_num_rows($acc_transaction_number);
	if($rows_transaction_no > 0) {
		$record_transaction_no = mysql_fetch_array($acc_transaction_number);
		$update_transaction	="UPDATE acc_transaction  SET
								acc_transaction_voucher_id		= '".$acc_transaction_voucher_id."',  
								acc_transaction_no             = '".$acc_transaction_no."', 
								acc_transaction_date           = '".$acc_transaction_date."', 
								acc_transaction_type           = '".$acc_transaction_type."',
								acc_transaction_account_id     = '".$acc_transaction_account_id."',
								acc_transaction_account_id1    = '".$acc_transaction_account_id1."',
								acc_transaction_cord           = '".$acc_transaction_cord."',
								acc_transaction_amount         = '".$acc_transaction_amount_mmk."',
								acc_transaction_amount_mmk     = '".$acc_transaction_amount."',
								acc_transaction_branch_id      = '".$acc_transaction_branch_id."',
								acc_transaction_remark         = '".$acc_transaction_remark."',
								acc_transaction_modified_by    = '".$_SESSION[SESS.'_session_user_id']."', 
								acc_transaction_modified_on    = UNIX_TIMESTAMP(NOW()), 
								acc_transaction_modified_ip    = '".$ip."' 
								WHERE acc_transaction_id 			= '".$record_transaction_no['acc_transaction_id']."' ";   
								
								//echo $update_transaction;exit;  

		mysql_query($update_transaction) or die(mysql_error());
	} else {
		$insert_transaction = "INSERT INTO acc_transaction(acc_transaction_voucher_id, acc_transaction_no, acc_transaction_date, 
														   acc_transaction_type, acc_transaction_account_id, acc_transaction_account_id1, 
														   acc_transaction_cord, acc_transaction_amount, acc_transaction_remark, 
														   acc_transaction_company_id, acc_transaction_branch_id, acc_transaction_financial_year,
														   acc_transaction_added_by, acc_transaction_added_on, acc_transaction_added_ip,
														   acc_transaction_amount_mmk) 
												VALUES ('".$acc_transaction_voucher_id."', '".$acc_transaction_no."', '".$acc_transaction_date."',
														'".$acc_transaction_type."', '".$acc_transaction_account_id."', '".$acc_transaction_account_id1."', 
														'".$acc_transaction_cord."', '".$acc_transaction_amount_mmk."', '".$acc_transaction_remark."', 
														'".$_SESSION[SESS.'_session_company_id']."', '".$acc_transaction_branch_id."',
														'".$_SESSION[SESS.'_session_financial_year']."',
														'".$_SESSION[SESS.'_session_user_id']."', UNIX_TIMESTAMP(NOW()), '".$ip."',
														'".$acc_transaction_amount."')"; 
														//echo $insert_transaction;exit; 
		mysql_query($insert_transaction) or die(mysql_error());
	}
} 
function DeleteAccountTrasaction($deleted_id,$acc_type){
			$ip 			= getRealIpAddr();
			$update_acc		= sprintf("UPDATE acc_transaction

								  SET    acc_transaction_deleted_by     = '%d',  

										 acc_transaction_deleted_on     = UNIX_TIMESTAMP(NOW()),

										 acc_transaction_deleted_ip     = '%s',

										 acc_transaction_deleted_status= '%d'

								  WHERE  acc_transaction_voucher_id     = '%d' AND 
								  		 acc_transaction_type			= '%s'",
								  $_SESSION[SESS.'_session_user_id'], mysql_real_escape_string($ip),"1",  
								  $deleted_id,$acc_type);
		mysql_query($update_acc);	 
}

function get_township($id){

			 $select_color = "SELECT city_id, city_name FROM cities WHERE city_id = '".$id."' AND city_deleted_status = 0 ORDER BY city_name ASC";
			$result_color = mysql_query($select_color);
			$arr_color    = array();
			
			while($record_color = mysql_fetch_array($result_color)) {
				$arr_color[] = $record_color;
			}
			
			return $arr_color;

}

function get_products_arr($id){

			 $select_color = "SELECT product_id, product_name,product_code FROM products WHERE   product_deleted_status = 0 ORDER BY product_name ASC";
			$result_color = mysql_query($select_color);
			$arr_color    = array();
			
			while($record_color = mysql_fetch_array($result_color)) {
				$arr_color[] = $record_color;
			}
			
			return $arr_color;

}


function createDateRangeArray($strDateFrom,$strDateTo) {
	  $aryRange=array();
	  $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	  $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
	  if ($iDateTo>=$iDateFrom) {
		array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
		while ($iDateFrom<$iDateTo) {
		  $iDateFrom+=86400; // add 24 hours
		  array_push($aryRange,date('Y-m-d',$iDateFrom));
		}
	  }
	  return $aryRange;
	}
function getSupplierList(){

	$select="SELECT * FROM suppliers WHERE supplier_deleted_status = 0";
	
	$query=mysql_query($select);
	while($result=mysql_fetch_array($query)){
	
	$arr_sup[]=$result;
	
	}
	return $arr_sup;

}

function get_pre_bal($cus_id,$inv_id){
	
	 $select_invoice		=	"SELECT 

										SUM(invoice_entry_net_amount+invoice_entry_advance_amount) as invoice_entry_net_amount,

										SUM(IFNULL(rcv_table.rcv_amount,0)+invoice_entry_advance_amount) as received_amt,
										invoice_entry_customer_id

									 FROM 

										invoice_entry
									 
									LEFT JOIN 

										(SELECT 
											collection_entry_detail_invoice_entry_id, 
											SUM(collection_entry_detail_amount) AS rcv_amount 

										FROM 
											collection_entry_details  	
										WHERE 
											collection_entry_detail_deleted_status 				= 0  					
										GROUP BY 
											collection_entry_detail_invoice_entry_id) rcv_table 
									ON 
										collection_entry_detail_invoice_entry_id 				= invoice_entry_id								 
									 WHERE 
										invoice_entry_deleted_status 							= 	0 																						
									AND invoice_entry_id NOT IN(".$inv_id.")
								 ORDER BY 
										invoice_entry_no ASC";
										
		$query=mysql_query($select_invoice);	
		$reuslt=mysql_fetch_array($query);	
		$net=$reuslt['invoice_entry_net_amount'];
		$paid=$reuslt['received_amt'];						

	return $net-$paid;
}

function d_invoice_status($id){
	
	$select="SELECT  * FROM collection_entry_details WHERE collection_entry_detail_invoice_entry_id='".$id."'";
	
	$query=mysql_query($select);
	$result=mysql_num_rows($query);
	
	$row_result=($result==0)?0:1;
	//echo $select;exit;
	return $row_result;
	
}

function editStatus($table_name, $field, $value, $deleted_status){



	$select_status = "SELECT $field FROM $table_name WHERE $field = '".$value."' AND $deleted_status = 0";
//echo $select_status ;exit;


	$result_status = mysql_query($select_status);



	$count_status = mysql_num_rows($result_status);



	if($count_status > 0) {



		return 0; //edit not possible



	} else {



		if($_SESSION[SESS.'_session_user_level'] == 'user') {



			return 0; //edit not possible



		} else {



			return 1; //edit possible



		}	



	}	



}


function deleteStatus(){



   if($_SESSION[SESS.'_session_user_level'] == 'user') {



		return 0; //delete not possible



   } else {



		return 1; //delete possible



   }



}

?>