<?php

$arr_disilery_status    		= array("1"=>"Pass", "2"=>"Fail", "3"=>"Hold");

$arr_mash_process    		= array("1"=>"YC", "2"=>"PF", "3"=>"FV");

$arr_tank_type    			= array("1"=>"MASH","2"=>"YC", "3"=>"PF", "4"=>"FV", "5"=>"SOUR", "6"=>"Overhead Mash" );

$arr_active_status    		= array("active"=>"Active", "inactive"=>"Inactive");

$arr_sales_type    			= array("1"=>"Cash", "2"=>"Credit");

$arr_supplier_loc    		= array("1"=>"Local", "2"=>" Oversea");

$arr_damage_type    		= array("1"=>"Both", "2"=>" In", "3"=>" Out");

$arr_quotation_type    		= array("1"=>"With Quotation", "2"=>" Without Quotation");

$arr_product_type    		= array("1"=>"Raw", "2"=>"Semi", "3"=>"Finished Product", "4"=>"Gift");

$arr_tax_type    			= array("1"=>"Commercial Tax", "2"=>"With Holding Tax", "3"=>"Income Tax", "4"=>"Other");

$arr_delivery_by    		= array("1"=>"Company", "2"=>"Agent", "3"=>"Customer");

$arr_so_type    			= array("1"=>"Direct", "2"=>"Phone", "3"=>"Email");

$arr_po_type    			= array("1"=>"Direct", "2"=>"Phone", "3"=>"Email", "4"=>"VE");

$arr_payment_mode  			= array("1"=>"Cash", "2"=>"Cheque", "3"=>"Bank", "4"=>"TT");

$arr_promotion_type			= array("1"=>"Discount", "2"=>"Trip", "3"=>"Gift", "4"=>"FOC");

$arr_request_type			= array("1"=>"Internel Sales Transfer", "2"=>"Customer Delivery", "3"=>"Sales Return", "4"=>"Suspens Sales" , "5"=>"Internal Sales Receive",

									"6"=>"Suspens Sales Delivery" );

$arr_mrk_request_type		= array("7"=>"Supplier Product Receive", "8"=>"Supplier Product Return");

										

$arr_damage_type  			= array("1"=>"Demage", "2"=>"Missing Product", "3"=>"Other");									

$arr_reserve    			= array("1"=>"Customer", "2"=>" Sales");	

$arr_lucky_cupon_type		= array("1"=>"Coupon", "2"=>" Luck Draw");								

$arr_pickup_by				= array("1"=>"Company", "2"=>"Customer");

$arr_gin_request_type			= array("1"=>"Internel Sales Transfer", "2"=>"Customer Delivery", "3"=>"Sales Return", "4"=>"Suspens Sales" , "5"=>"Internal Sales Receive",

									"6"=>"Suspens Sales Delivery","9"=>"Disitillery" );

$arr_grn_request_type		= array("3"=>"Sales Return", "5"=>"Internal Sales Receive","7"=>"Internal Warehouse Transfer Receive" ,"8"=>"Purchase");

									

$arr_so_return_type			= array("1"=>"Product Exchange", "2"=>"Cotton Box Demage", "3"=>"Product Demage", "4"=>"Product Seize" , "5"=>"Internal Sales Receive" );

$arr_sf_mode    			= array("1"=>"New Sales Focus", "2"=>"Additional Sales Focus");

$arr_process_entry 			= array("1"=>"MIXING", "2"=>"MASH TANK ENTRY", "3"=>"YEAST CUL ENTRY", "4"=>"PREFERMENTATION ENTRY", "5"=>"FERMENTATION ENTRY", "6"=>"SOUR TANK ENTRY", "7"=>"COLUMN I ENTRY", "8"=>"COLUMN II ENTRY", "9"=>"COLUMN III ENTRY", "10"=>"COLUMN IV ENTRY");


$arr_tc_function    		= array("1"=>"Sales", "2"=>"Marketing", "3"=>"Inventory", "4"=>"Purchase");

$arr_tc_applicable    		= array("1"=>"Quotation", "2"=>"Order", "3"=>"Invoice", "4"=>"GIN", "5"=>"Demage", "6"=>"Transport");





//prakash//vijay

$payment_mode =array("1"=>"Cash","2"=>"Credit Card" );

$vendor_service =array("1"=>"Utilities","2"=>"Vehicle","3"=>"Asset" );

$arr_transport_method 		=array("1"=>"Ship","2"=>"Air","3"=>"Road" );

$status=array("1"=>"Active","2"=>"Inactive" ); 

$owner_type=array("1"=>"Company","2"=>"Vendor" ); 

// Prakash

$arr_utilities_types    			= array("1"=>"Electrical", "2"=>"Stationery" ,"3"=>"Asset","4"=>"Networking","5"=>"Internet","6"=>"Cleaning ","7"=>"Other");

$arr_department    			= array("1"=>"Marketing", "2"=>"Sales" ,"3"=>"Finance","4"=>"HR","5"=>"Purchase","6"=>"Inventory","7"=>"Other");





//Menaka

$request_mode =array("1"=>"Advance","2"=>"Claim" );  //Added by MENAKA on 04-AUG-2017

$request_type=array("1"=>"Service & Maintains","2"=>"Expense","3"=>"Purchase","4"=>"Fuel","5"=>"Other" );   //   Added by MENAKA on 04-AUG-2017








//-------cithravel-------------
$arr_mstrAtnc        = array("1"=>"Office Time", "2"=>"Off Day");
$arr_mstrAtncDays    = array("1"=>"Sunday", "2"=>"Monday","3"=>"Tuesday","4"=>"Wednesday","5"=>"Thursday","6"=>"Friday","7"=>"Saturday");

$arr_mstrLeaveExpire = array("1"=>"Yes", "2"=>"No","3"=>"After a Clander Year");
$arr_mstrLeaveexperience = array("1"=>"1 Year to 2 Year", "2"=>"2 Year to 4 Year","3"=>"4 Year and Above");

$arr_mstrLeaveconditions =array("1"=>"Can leave with Wage Benefits","2"=>"Do not take more than three days at a time","3"=>"Cannot combine with other office permit leave days","4"=>"Annual Leave Days can combine with Next Year Annual Leaves. But HR allow only (21) days for (2) years Annual Leave Conbaniation. Can take annual leaves with salary","5"=>"After a year, HR will count remaining days and calculate amount for that days","6"=>"Cannot combine with next year","7"=>"Can take with Salary and Company will pay the amount for medical","8"=>"After 30 days period, can take combine with Annual Leave","9"=>"Before maternity (42) Days and After Maternity (42) Days","10"=>"Can take with Salary","11"=>"For Sunday Overtime (With Salary)");

$arr_mstrOvertime_rule	 = array("1"=>"Monday to Friday", "2"=>"Saturday", "3"=>"Sunday", "4"=>"Sunday (Full/ Half)", "5"=>"Government Holiday" ,"6" =>"Driver","7"=>"All Overtime");

$arr_mstrgrades			 = array("1"=>"A","2"=>"B","3"=>"C","4"=>"D","5"=>"E");
$arr_mstrmarks			 = array("1"=>"51 - 60","2"=>"61 - 70","3"=>"71 - 80","4"=>"81 - 90","5"=>"91-100");
$arr_mstrDayTypes	  	 = array("1"=>"Full Day", "2"=>"Half Day");
$arr_mstrSalaryDeducttypes	  	 = array("1"=>"Uniform Compensation", "2"=>"Employee ID Card", "3"=>"Income Tax", "4"=>"Uniform", "5"=>"ID Card", "6"=>"Eating Betel", "7"=>"SSB", "8"=>"Travelling Exp Deduction");
$arr_mstrSalaryDeductFines	  	 = array("1"=>"Leave from office", "2"=>"Lost", "3"=>"Tax", "4"=>"Do Not Ware", "5"=>"Eating", "6"=>"SSP Amount", "7"=>"Travelling Allowance");

$salesmode_master = array('1'=>'Distributor','2'=>'Wole seller','3'=>'Retailer');

$incentie_master = array('1'=>'Volume','2'=>'Range Selling','3'=>'New Outlet','4'=>'Township','5'=>'Team Earning');
$iteam_master = array('1'=>'Team 1','2'=>'Team 2','3'=>'Team 3','4'=>'team 4','5'=>'Team 5');


$arr_employee_type    = array("1"=>"Permanent", "2"=>"Temporary");
$arr_meritalStatus	  = array("1"=>"Single", "2"=>"Married","3"=>"Divorced", "4"=>"Widowed");
$arr_replceAditional  = array("1"=>"Replace", "2"=>"Additional");
$arr_lanuages         = array("1"=>"English", "2"=>"Burmese");
$arr_lanuages_values  = array("1"=>"Elementary", "2"=>"Intermediate","3"=>"Advance");
$arr_eductional		  = array("1"=>"School", "2"=>"University");
$arr_bloodGroup		  = array("1"=>"O+", "2"=>"O-","3"=>"A+", "4"=>"A-","5"=>"B+","6"=>"B-","7"=>"AB+","8"=>"AB-");

$arr_confirmation	  = array("1"=>"Self Management", "2"=>"Problem Solving Skills","3"=>"Timely Completion of Assignment", "4"=>"Understanding of Duties & Responsibillities","5"=>"Quality of Work","6"=>"Reporting","7"=>"Team Work","8"=>"Communication & Relationship with other","9"=>"Discipline","10"=>"Attendance","11"=>"Punctuality","12"=>"Suitability of Position");
$arr_leaveType	  	  = array("1"=>"Full Day", "2"=>"Half Day");
$arr_leaveReason	  = array("1"=>"Unexpectedly", "2"=>"Annual Leave","3"=>"Medical Leave", "4"=>"Maternity Leave","5"=>"Paternity Leave","6"=>"Married Leave","7"=>"Without Pay","8"=>"Sunday Working");
$arr_leaveHistory	  = array("1"=>"Entitled Days", "2"=>"Leave Already Taken","3"=>"Current Leave Balance", "4"=>"No. of Day(s) Apply","5"=>"New Leave Balance");

$arr_travelMode	      = array("1"=>"Air", "2"=>"Bus","3"=>"Ship", "4"=>"Train","5"=>"Other");

$arr_perfomaEvaluation= array("1"=>"LEADERSHIP", "2"=>"COMMITMENT","3"=>"SKILLS", "4"=>"ACCOUNTABILITY","5"=>"ABILITY TO LEARN","6"=>"EFFORT","7"=>"INNOVATION","8"=>"DISCIPLINE","9"=>"CONTRIBUTION TO OTHERS","10"=>"COMMUNICATION");
$arr_perfomaEvlSub    =array('1'=>'Leader by action, Can motivate staff, Fairness in decisions, Reach goals, Overcome difficulties without excuses','2'=>'Available at all times, Willing to work extra hours, Always positive, Do want needs to be done without being told','3'=>'Technical know - how in job, Accuracy, Thoroughness, Neatness,of work, Can accomplish work on time');
///prakash
$arr_overtime_rule	  = array("1"=>"Monday to Friday", "2"=>"Saturday", "3"=>"Sunday", "4"=>"Sunday (Full/ Half)", "5"=>"Government Holiday" ,"6" =>"Driver");
$arr_day_type		  = array("1"=>"Full", "2"=>"Half");
$arr_dedudtion_type	  = array("1"=>"Employee ID Card", "2"=>"Income Tax", "3"=>"Uniform", "4"=>"ID Card", "5"=>"Eating Betel" ,"6" =>"SSP","7" =>"Loan","8" =>"Travelling Allowance");
$arr_allownace_type	  = array("1"=>"Loan", "2"=>"Bonus");
//-----------------------------


//Login Authendication

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

$date = implode('-', array_reverse(explode('/', $date)));

return $date;

}

//Date Display Format

function dateGeneralFormat($date){

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

								company_deleted_status 	= 0					AND

								company_id				= '".$company_id."' 

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

function getId($table_name, $pid, $uid ,$uniq_id)

{

	$select_id = "SELECT $pid FROM $table_name WHERE $uid = '".$uniq_id."'";

	$result_id = mysql_query($select_id);

	$record_id = mysql_fetch_array($result_id);

	return $record_id["$pid"];

}

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

//Brand List

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

function getCustomerList(){

	$select_customer		=	"SELECT 

									customer_id,

									customer_name 

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

function getSupplierList(){

	$select_supplier		=	"SELECT 

									supplier_id,

									supplier_name 

								 FROM 

									suppliers 

								 WHERE 

									supplier_deleted_status 	= 	0 AND 

									supplier_active_status 	=	'active'

								 ORDER BY 

									supplier_name ASC";

	$result_supplier 		= mysql_query($select_supplier);

	// Filling up the array

	$supplier_data 	= array();

	while ($record_supplier = mysql_fetch_array($result_supplier))

	{

	 $supplier_data[] 	= $record_supplier;

	}

	return $supplier_data;

}

function getAgentList(){

	$select_agent		=	"SELECT 

									agent_id,

									agent_name 

								 FROM 

									agents 

								 WHERE 

									agent_deleted_status 	= 	0 AND 

									agent_active_status 	=	'active'

								 ORDER BY 

									agent_name ASC";

	$result_agent 		= mysql_query($select_agent);

	// Filling up the array

	$agent_data 	= array();

	while ($record_agent = mysql_fetch_array($result_agent))

	{

	 $agent_data[] 	= $record_agent;

	}

	return $agent_data;

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

function getSuppliertypeList(){

	$select_supplier_type		=	"SELECT 

										supplier_type_id,

										supplier_type_name 

									 FROM 

										supplier_types 

									 WHERE 

										supplier_type_deleted_status 	= 	0 			AND 

										supplier_type_active_status 	=	'active'

									 ORDER BY 

										supplier_type_name ASC";

	$result_supplier_type 		= mysql_query($select_supplier_type);

	// Filling up the array

	$supplier_type_data 	= array();

	while ($record_supplier_type = mysql_fetch_array($result_supplier_type))

	{

	 $supplier_type_data[] 	= $record_supplier_type;

	}

	return $supplier_type_data;

}

function getProductrate($brnch_id,$prd_id,$sal_mode,$so_type){

	$select_selling_price		=	"SELECT 

										product_detail_selling_price

									 FROM 

										product_details 

									 WHERE 

										product_detail_branch_id 		= '".$brnch_id."'		AND

										product_detail_product_id 		= '".$prd_id."' 		AND 

										product_detail_salesmode_id		= '".$sal_mode."'		AND

										product_detail_sales_type		= '".$so_type."'		AND

										product_detail_deleted_status	= '0'";

	$result_selling_price 		= mysql_query($select_selling_price);

	$record_selling_price 		= mysql_fetch_array($result_selling_price);

	return $record_selling_price['product_detail_selling_price'];

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

function getproductList(){

	 $select_product		=	"SELECT 

								product_condition_id,

								product_condition_name	 

							 FROM 

								product_condition 

							 WHERE 

								product_condition_deleted_status 	= 0 					

							 ORDER BY 

								product_condition_name ASC";

								

	$result_product 	= mysql_query($select_product);

	// Filling up the array

	$product_data 	= array();

	while ($record_product = mysql_fetch_array($result_product))

	{

	 $product_data[] 	= $record_product;

	}

	return $product_data;

}



function getPromotionList(){

	$select_promotion		=	"SELECT 

									promotion_id,

									promotion_name 

								 FROM 

									promotions 

								 WHERE 

									promotion_deleted_status 	= 	0 AND 

									promotion_active_status 	=	'active'

								 ORDER BY 

									promotion_name ASC";

	$result_promotion 		= mysql_query($select_promotion);

	// Filling up the array

	$promotion_data 	= array();

	while ($record_promotion = mysql_fetch_array($result_promotion))

	{

	 $promotion_data[] 		= $record_promotion;

	}

	return $promotion_data;

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

function getTruckList(){

	$select_truck		=	"SELECT 

								vehicle_id,

								vehicle_number 

							 FROM 

								vehicles 

							 WHERE 

								vehicle_status 		= 	0 

							 ORDER BY 

								vehicle_number ASC";

	$result_truck 		= mysql_query($select_truck);

	// Filling up the array

	$truck_data 	= array();

	while ($record_truck = mysql_fetch_array($result_truck))

	{

	 $truck_data[] 		= $record_truck;

	}

	return $truck_data;

}

function getDriverList(){

	 $select_driver = "SELECT  driver_id, driver_name FROM drivers WHERE driver_deleted_status=0 ORDER BY driver_name ASC "; 

	$result_driver = mysql_query($select_driver);

	$driver_data = array();

	while($record_driver = mysql_fetch_array($result_driver)){

		$driver_data[] = $record_driver;		

	}

	return $driver_data;	

}



function getRouteList(){

	$select_route		=	"SELECT 

								route_id,

								route_name 

							 FROM 

								routes 

							 WHERE 

								route_deleted_status 	= 	0 AND 

								route_active_status 	=	'active'

							 ORDER BY 

								route_name ASC";

	$result_route 		= mysql_query($select_route);

	// Filling up the array

	$route_data 	= array();

	while ($record_route = mysql_fetch_array($result_route))

	{

	 $route_data[] 		= $record_route;

	}

	return $route_data;

}

function getSaleschannelList($salesmode_id=''){

	$where						= ($salesmode_id!='')?" AND sales_channel_salesmode_id = '".$salesmode_id."'":'';

	$select_sales_channel		=	"SELECT 

										sales_channel_id,

										sales_channel_name 

									 FROM 

										sales_channels 

									 WHERE 

										sales_channel_deleted_status 	= 	0 			AND 

										sales_channel_active_status 	=	'active'

										".$where."

									 ORDER BY 

										sales_channel_name ASC";

	$result_sales_channel 		= mysql_query($select_sales_channel);

	// Filling up the array

	$sales_channel_data 	= array();

	while ($record_sales_channel = mysql_fetch_array($result_sales_channel))

	{

	 $sales_channel_data[] 		= $record_sales_channel;

	}

	return $sales_channel_data;

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

function getBudgetList(){

	$select_budget		=	"SELECT 

									budget_entry_id,

									budget_entry_ac_head_name 

								 FROM 

									budget_entry 

								 WHERE 

									budget_entry_deleted_status	 	= 	0  			AND

									budget_entry_active_status 		=	'active'

								 ORDER BY 

									budget_entry_ac_head_name ASC";

	$result_budget 	= mysql_query($select_budget);

	// Filling up the array

	$budget_data 	= array();

	while ($record_budget = mysql_fetch_array($result_budget))

	{

	 $budget_data[] 	= $record_budget;

	}

	return $budget_data;

}

function getPositionList(){

	$select_position		=	"SELECT 

									position_id,

									position_name 

								 FROM 

									positions 

								 WHERE 

									position_deleted_status	 	= 	0  		AND

									position_active_status 		=	'active'



									

								 ORDER BY 

									position_name ASC";

	$result_position 	= mysql_query($select_position);

	// Filling up the array

	$position_data 	= array();

	while ($record_position = mysql_fetch_array($result_position))

	{

	 $position_data[] 	= $record_position;

	}

	return $position_data;

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

								  $id);  

		 mysql_query($deleterRecord);  

	}

}

// iNVENTORY



function stockLedger($stock_ledger_type,$stock_ledger_entry_id,$stock_ledger_entry_detail_id,$stock_ledger_product_id,$stock_ledger_date,$stock_ledger_godown_id,$stock_ledger_sku_id,$stock_ledger_product_quantity,$stock_ledger_trans_no,$stock_ledger_entry_type,$stock_ledger_issue_type,$stock_ledger_branch_id){

		$ip				= getRealIpAddr();

		$select_ledger	= "	Select

								*

							FROM

								 stock_ledger

							WHERE

								stock_ledger_status				= '0'												AND

								stock_ledger_company_id			= '".$_SESSION[SESS.'_session_company_id']."'		AND

								stock_ledger_financial_year		= '".$_SESSION[SESS.'_session_financial_year']."'	AND

								stock_ledger_branch_id			= '".$stock_ledger_branch_id."'						AND

								stock_ledger_entry_id			= '".$stock_ledger_entry_id."'						AND

								stock_ledger_entry_detail_id	= '".$stock_ledger_entry_detail_id."'				AND

								stock_ledger_product_id			= '".$stock_ledger_product_id."'					AND	

								stock_ledger_entry_type			= '".$stock_ledger_entry_type."'					AND

								stock_ledger_issue_type			= '".$stock_ledger_issue_type."'";

		$result_ledger	= mysql_query($select_ledger);

		$rows_ledger	= mysql_num_rows($result_ledger);

		if($rows_ledger==0){

			$insert_ledger 	= sprintf("INSERT INTO stock_ledger    (stock_ledger_type, stock_ledger_entry_id,stock_ledger_entry_detail_id,

																	stock_ledger_product_id,stock_ledger_date,stock_ledger_godown_id,

																	stock_ledger_sku_id,stock_ledger_product_quantity,stock_ledger_trans_no,

																	stock_ledger_entry_type,stock_ledger_issue_type,stock_ledger_company_id,

																	stock_ledger_branch_id,stock_ledger_financial_year,stock_ledger_added_by, 

																	stock_ledger_added_on,stock_ledger_added_ip) 

															VALUES ('%s', '%d', '%d',

																	'%d', '%s', '%d',

																	'%d', '%f',	'%s',

																	'%s', '%d', '%d',

																	'%d', '%d', '%d',

																	UNIX_TIMESTAMP(NOW()),'%s')", 

																	$stock_ledger_type, $stock_ledger_entry_id,$stock_ledger_entry_detail_id,

																	$stock_ledger_product_id,$stock_ledger_date,$stock_ledger_godown_id,

																	$stock_ledger_sku_id,$stock_ledger_product_quantity,$stock_ledger_trans_no,

																	$stock_ledger_entry_type,$stock_ledger_issue_type,$_SESSION[SESS.'_session_company_id'], 

																	$stock_ledger_branch_id,$_SESSION[SESS.'_session_financial_year'],$_SESSION[SESS.'_session_user_id'],

																	$ip);

			mysql_query($insert_ledger);

		}

		else{

			$update_ledger		= sprintf("	UPDATE 

												stock_ledger 

											SET 

												stock_ledger_product_id 			= '%d',

												stock_ledger_date 					= '%s',

												stock_ledger_godown_id 				= '%d',

												stock_ledger_sku_id 				= '%d',

												stock_ledger_product_quantity 		= '%f',

												stock_ledger_date 					= '%s',

												stock_ledger_modified_by 			= '%d',

												stock_ledger_modified_on 			= UNIX_TIMESTAMP(NOW()),

												stock_ledger_modified_ip			= '%s'

											WHERE               

												stock_ledger_id             		= '%d'", 

												$stock_ledger_product_id,

												$stock_ledger_date,

												$stock_ledger_godown_id,

												$stock_ledger_sku_id,

												$stock_ledger_product_quantity,

												$stock_ledger_date,

												$_SESSION[SESS.'_session_user_id'], 

												$ip, 

												$stock_ledger_id);

			mysql_query($update_ledger);

		}

}



function dep($dep_id){



if($dep_id == 1){

		

		$department_name = 'Sales';

		

		

		}elseif($dep_id == 2){

		

		$department_name = 'Marketing';

		

		}elseif($dep_id == 3){

		

		$department_name = 'Inventory';

		

		

		}elseif($dep_id == 4){

		

		$department_name = 'Admin';

		

		}elseif($dep_id == 5){

		

		$department_name = 'Purchase';

		

		}elseif($dep_id == 6){

		

		$department_name = 'Finance';		

		}elseif($dep_id == 7){

		

		$department_name = 'HR';

		}elseif(dep_id == 8){

		

		$department_name = 'Production';

		}elseif($dep_id == 9){

		

		$department_name = 'Other';		

		}else{

		$department_name = '';			

		}

		

		return $department_name;

}

// Ubenthiran

function getTank($type=''){

	$where	= '';

	if($type!=''){

		$where	.= "	AND tank_type						= 	'".$type."'";	

	}

	$select_tank		=	"SELECT 

								tank_id,

								tank_name 

							 FROM 

								tanks 

							 WHERE 

								tank_deleted_status 		= 0 					AND 

								tank_active_status 			= 'active'				$where						

							 ORDER BY 

								tank_name ASC";

								

	$result_tank 		= mysql_query($select_tank);

	// Filling up the array

	$tank_data 			= array();

	while ($record_tank = mysql_fetch_array($result_tank))

	{

	 $tank_data[] 		= $record_tank;

	}

	return $tank_data;

}

function GettankOpening($type,$tank_id,$mash_type=''){

	if($type==1){

			$where_sub	= '';

			if($mash_type=="PF"){

				$where_sub	= " AND mash_process_tank_detail_next_process	= '2'";

			}

			if($mash_type=="YC"){

				$where_sub	= " AND mash_process_tank_detail_next_process	= '1'";

			}

			if($mash_type=="FV"){

				$where_sub	= " AND mash_process_tank_detail_next_process	= '3'";

			}

		$select_route_detail 	=   "SELECT 

										tank_id, 

										product_uom_name,

										mash_qty,

										yc_receive_qty,

										pf_receive_qty,

										fv_receive_qty

									 FROM 

										tanks 

									 LEFT JOIN

										product_uoms

									 ON

										product_uom_id					= tank_uom_id

									 LEFT JOIN

										(SELECT

											sum(mash_process_tank_detail_qty) as mash_qty,

											mash_process_tank_detail_tank_id

										 FROM

											mash_process_tank_details

										 WHERE

											mash_process_tank_detail_deleted_status	= '0' $where_sub

										 GROUP BY

											mash_process_tank_detail_tank_id) as mash_tank

									 ON

										mash_process_tank_detail_tank_id		= tank_id

									 LEFT JOIN

										(SELECT

											sum(yc_process_tank_qty) as yc_receive_qty,

											yc_process_mash_tank_id

										 FROM

											yc_process

										 WHERE

											yc_process_deleted_status			= '0'

										 GROUP BY

											yc_process_mash_tank_id) as yc_tank

									 ON

										yc_process_mash_tank_id					= tank_id

									 LEFT JOIN

										(SELECT

											sum(pf_process_mash_tank_qty) as pf_receive_qty,

											pf_process_mash_tank_id

										 FROM

											pf_process

										 WHERE

											pf_process_deleted_status			= '0'

										 GROUP BY

											pf_process_mash_tank_id) as pf_tank

									 ON

										pf_process_mash_tank_id					= tank_id

									 LEFT JOIN

										(SELECT

											sum(fv_process_mash_tank_qty) as fv_receive_qty,

											fv_process_mash_tank_id

										 FROM

											fv_process

										 WHERE

											fv_process_deleted_status			= '0'

										 GROUP BY

											fv_process_mash_tank_id) as fv_tank

									 ON

										fv_process_mash_tank_id					= tank_id

									 WHERE 

										tank_id 								= '".$tank_id."' 	AND 

										tank_deleted_status 					= 0 

									GROUP BY 

										tank_id

									 ORDER BY 

										tank_name ASC";	

				$result_route_detail 	=  mysql_query($select_route_detail);

				$record_route_detail 	= mysql_fetch_array($result_route_detail);

				$opening_qty			= $record_route_detail['mash_qty']-($record_route_detail['yc_receive_qty']+$record_route_detail['pf_receive_qty']);

	}

	else if($type==2){

		$select_route_detail 	=   "SELECT 

										tank_id, 

										product_uom_name,

										yc_qty,

										yc_receive_qty

									 FROM 

										tanks 

									 LEFT JOIN

										product_uoms

									 ON

										product_uom_id					= tank_uom_id

									 LEFT JOIN

										(SELECT

											sum(yc_process_total_qty) as yc_qty,

											yc_process_tank_id

										 FROM

											yc_process

										 WHERE

											yc_process_deleted_status			= '0'

										 GROUP BY

											yc_process_mash_tank_id) as yc_tank

									 ON

										yc_process_tank_id					= tank_id

									 LEFT JOIN

										(SELECT

											sum(pf_process_yc_tank_qty) as yc_receive_qty,

											pf_process_yc_tank_id

										 FROM

											pf_process

										 WHERE

											pf_process_deleted_status			= '0'

										 GROUP BY

											pf_process_yc_tank_id) as pf_tank

									 ON

										pf_process_yc_tank_id					= tank_id

									 WHERE 

										tank_id 								= '".$tank_id."' 	AND 

										tank_deleted_status 					= 0 

									GROUP BY 

										tank_id

									 ORDER BY 

										tank_name ASC";	

		$result_route_detail 	=  mysql_query($select_route_detail);

		$record_route_detail 	= mysql_fetch_array($result_route_detail);

		$opening_qty			= $record_route_detail['yc_qty']-$record_route_detail['yc_receive_qty'];

	}

	else if($type==3){

	$select_route_detail 	=   "SELECT 

									tank_id, 

									product_uom_name,

									pf_qty,

									pf_receive_qty

								 FROM 

									tanks 

								 LEFT JOIN

									product_uoms

								 ON

									product_uom_id					= tank_uom_id

								 LEFT JOIN

									(SELECT

										sum(pf_process_total_qty) as pf_qty,

										pf_process_tank_id

									 FROM

										pf_process

									 WHERE

										pf_process_deleted_status			= '0'

									 GROUP BY

										pf_process_mash_tank_id) as yc_tank

								 ON

									pf_process_tank_id					= tank_id

								 LEFT JOIN

									(SELECT

										sum(fv_process_pf_tank_qty) as pf_receive_qty,

										fv_process_pf_tank_id

									 FROM

										fv_process

									 WHERE

										fv_process_deleted_status			= '0'

									 GROUP BY

										fv_process_pf_tank_id) as pf_tank

								 ON

									fv_process_pf_tank_id					= tank_id

								 WHERE 

									tank_id 								= '".$tank_id."' 	AND 

									tank_deleted_status 					= 0 

								GROUP BY 

									tank_id

								 ORDER BY 

									tank_name ASC";	

	$result_route_detail 	=  mysql_query($select_route_detail);

	$record_route_detail 	= mysql_fetch_array($result_route_detail);

	$opening_qty			= $record_route_detail['pf_qty']-$record_route_detail['pf_receive_qty'];

	}

	else if($type==4){

		$select_route_detail 	=   "SELECT 

										tank_id, 

										product_uom_name,

										pf_qty,

										pf_receive_qty

									 FROM 

										tanks 

									 LEFT JOIN

										product_uoms

									 ON

										product_uom_id					= tank_uom_id

									 LEFT JOIN

										(SELECT

											sum(fv_process_total_qty) as pf_qty,

											fv_process_tank_id

										 FROM

											fv_process

										 WHERE

											fv_process_deleted_status			= '0'

										 GROUP BY

											fv_process_mash_tank_id) as yc_tank

									 ON

										fv_process_tank_id					= tank_id

									 LEFT JOIN

										(SELECT

											sum(sour_process_detail_fv_tank_qty) as pf_receive_qty,

											sour_process_detail_fv_tank_id

										 FROM

											sour_process_details

										 WHERE

											sour_process_detail_deleted_status			= '0'

										 GROUP BY

											sour_process_detail_fv_tank_id) as pf_tank

									 ON

										sour_process_detail_fv_tank_id					= tank_id

									 WHERE 

										tank_id 								= '".$tank_id."' 	AND 

										tank_deleted_status 					= 0 

									GROUP BY 

										tank_id

									 ORDER BY 

										tank_name ASC";	

		$result_route_detail 	=  mysql_query($select_route_detail);

		$record_route_detail 	= mysql_fetch_array($result_route_detail);

		$opening_qty			= $record_route_detail['pf_qty']-$record_route_detail['pf_receive_qty'];

	}else if($type==5){

		$select_route_detail 	=   "SELECT 

										tank_id, 

										product_uom_name,

										sour_qty,

										over_receive_qty

									 FROM 

										tanks 

									 LEFT JOIN

										product_uoms

									 ON

										product_uom_id										= tank_uom_id

									 LEFT JOIN

										(SELECT

											sum(sour_process_total_qty) as sour_qty,

											sour_process_tank_id

										 FROM

											sour_process

										 WHERE

											sour_process_deleted_status			= '0'

										 GROUP BY

											sour_process_tank_id) as sour_tank

									 ON

										sour_process_tank_id					= tank_id

									 LEFT JOIN

										(SELECT

											sum(overhead_process_detail_sour_tank_qty) as over_receive_qty,

											overhead_process_detail_sour_tank_id

										 FROM

											overhead_process_details

										 WHERE

											overhead_process_detail_deleted_status			= '0'

										 GROUP BY

											overhead_process_detail_sour_tank_id) as over_tank

									 ON

										overhead_process_detail_sour_tank_id				= tank_id

									 WHERE 

										tank_id 											= '".$tank_id."' 	AND 

										tank_deleted_status 								= 0 

									GROUP BY 

										tank_id

									 ORDER BY 

										tank_name ASC";	

		$result_route_detail 	=  mysql_query($select_route_detail);

		$record_route_detail 	= mysql_fetch_array($result_route_detail);

		$opening_qty			= $record_route_detail['sour_qty']-$record_route_detail['over_receive_qty'];

					}	

	return $opening_qty;

}



//cithravel
function getDepartment(){
	$select_departMent = "SELECT department_id, department_name FROM departments WHERE department_status = 0 ORDER BY department_name ASC ";
	$result_department = mysql_query($select_departMent);
	$department_data = array();
	while($record_department = mysql_fetch_array($result_department)){
		$department_data[] = $record_department;		
	}
	return $department_data;	
}

function getEmployee(){
	$select_employee = "SELECT  employee_id, employee_name, employee_deleted_status FROM  hr_employees WHERE employee_deleted_status=0 ORDER BY employee_name ASC ";

	$result_employee = mysql_query($select_employee);
	$employee_data = array();
	while($record_employee = mysql_fetch_array($result_employee)){
		$employee_data[] = $record_employee;		
	}
	return $employee_data;	
}

?>