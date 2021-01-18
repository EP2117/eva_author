<?php
// $_GET, $_POST;
/*create in browser session id*/
// $_SESSION['browser_session_id']= session_id(); 
/* 
$time1 = 10;
if (isset($_SESSION['LAST_ACTIVITY']) && ((time() - $_SESSION['LAST_ACTIVITY']) > $time1)) {
	$_SESSION['LAST_ACTIVITY'] = 0;
		session_destroy();
	header("Location:".PROJECT_PATH."/logout.php"); 
	exit();
} 
else{
$_SESSION['LAST_ACTIVITY'] = time();
}
*/

$arr_files = array();
$arr_employee_state = array("tamilnadu"=>"South Indian", "marvadi"=>"Marvadi", "nepali"=>"Nepali ", "others"=>"Others"); 
$arr_original_certificate_status = array("pending"=>"Pending", "approve"=>"Approved", "verify"=>"Verify", "completed"=>"Completed"); 
$nwords = array("", "One", "Two", "Three", "Four", "Five", "Six", 
	      	  	"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
	      	  	"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
	     	  	"Nineteen", "Twenty", 30 => "Thirty", 40 => "Fourty",
                50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eigthy",
                90 => "Ninety" );
    
  //$session_id = session_id();  
function dataValidation($value) 
{
	$value = trim(@htmlspecialchars($value));
	if(get_magic_quotes_gpc()) { 
		$value = stripslashes($value); 
	}  
	$value = mysql_real_escape_string($value); 
	return $value;
}
function getCuurentFinancialYear()
{	
	$select_current_financial_year = "SELECT financial_year_id, financial_year_from, financial_year_to 
							   FROM  financial_years WHERE financial_year_id = '".$_SESSION['session_admin_user_financial_year_id']."'";
		$result_current_financial_year = mysql_query($select_current_financial_year);	
	
	$record_current_financial_year = mysql_fetch_array($result_current_financial_year);
	$current_financial_year = $record_current_financial_year['financial_year_from'].' - '.$record_current_financial_year['financial_year_to'];
	return $current_financial_year;
}
function financialYears()
	{
		$select_financial_years = "SELECT financial_year_id, financial_year_from, financial_year_to 
								   FROM  financial_years WHERE financial_year_delete_status = 0 ORDER BY financial_year_from DESC";
		$result_financial_years = mysql_query($select_financial_years);	
		while ($record_financial_years = mysql_fetch_array($result_financial_years)) {
				$arr_financial_years[] = $record_financial_years;
		}					   
		return $arr_financial_years;
	}
	
function financialYearDateformat($format, $date)
{
	return date("$format", strtotime($date));
}	
// Message alert
function messageAlert()
{
	if(isset($_SESSION['session_msg'])) {
		$_SESSION['session_message'] = $_SESSION['session_msg'];
		$msg_style = 'msg';
	
	} else if(isset($_SESSION['session_alert_msg'])) {
		$_SESSION['session_message'] = $_SESSION['session_alert_msg'];
		$msg_style = 'alert_msg';
	} else if(isset($_SESSION['session_sucess_message'])) {
		$_SESSION['session_message'] = $_SESSION['session_sucess_message'];
		$msg_style = 'sucess_msg';
	} else {
		$_SESSION['session_message'] = '';
		$msg_style = '';
	} 
	return $msg_style;
}
// Message dislay 
function messageDisplay()
{
	echo $_SESSION['session_message'];  
	unset($_SESSION['session_message']); 
	unset($_SESSION['session_alert_msg']);
	unset($_SESSION['session_sucess_message']);
	unset($_SESSION['session_msg']);
}
//Generating CSRF token
function csrfToken()
{
	$token = md5(uniqid(rand(), true));
	$_SESSION['session_csrf_token'] = $token;	
	
	//return array($token, $_SESSION['session_token']);
	return $token;
}
//Generating CSRF token
function generateUniqId()
{
	$uniq_id_md5 = md5(uniqid());
	$uniq_id     = substr($uniq_id_md5,0,7).generateRandomString(3).substr($uniq_id_md5,7,4).generateRandomString(5).substr($uniq_id_md5,11,22);
	return $uniq_id;
}
/*function getEmployeeUniqId($employee_id)
{
	$select_employee_id = "SELECT employee_id FROM employees WHERE employee_uniq_id = '".$uniq_id."'";
	$result_employee_id = mysql_query($select_employee_id);
	$record_employee_id = mysql_fetch_array($result_employee_id);
	return $record_employee_id['employee_id'];
}*/
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
// Get branch IP
function getBranchIP($branch_id) 
{
	$select_branch_ip = "SELECT branch_ip FROM branches WHERE branch_id = '".$branch_id."'";
	$result_branch_ip = mysql_query($select_branch_ip);
	$record_branch_ip = mysql_fetch_array($result_branch_ip);
	return $record_branch_ip['branch_ip'];
}
function getLocalConnection($branch_ip) 
{
	$local_connection = mysql_connect($branch_ip,"root","dacam");
	if (!$local_connection) {
//		cronJobMail('KUMBAKONAM');
	} else {
		mysql_error();
	} 
	return $local_connection;	
}
function getOnlineConnection($host, $user, $pass) 
{
	$online_connection = mysql_connect($host,$user,$pass);
	if (!$online_connection) {
		mysql_error();
	}  
	return $online_connection;	
}
function cronJobMail($branch) 
{
	date_default_timezone_set("Asia/Kolkata");
	$date_time =  date('d/m/Y h:i:s a', time());
	$to = "info@lalithaajewellery.com";
	$subject = "Warning ....... Cron Job - ".$branch." - ".$date_time." - Database not Connect ";
	$message = "Cron Job - ".$branch." - ".$date_time." - Database not Connect ";
	$from = "info@lalithaajewellery.com";
	$headers = "From:admin@lalithaajewellery.com" . $from;
	mail($to,$subject,$message,$headers);
}
// Select query
function selectQuery($select_query)
{
	$select = mysql_query($select_query);
	$count  = mysql_num_rows($select);
	$arr_record = array();
	if($count > 0) {
		while ($record = mysql_fetch_array($select)) {
			$arr_record[] = $record;
		}
		return $arr_record;
	} else {
		return $arr_record;
	}
}
// List record (row) style 
function rowStyle($sno) 
{
	$row = $sno%2;
	if($row==0){
		$style="alt";
	} 
	else{
		$style="";
	}
	return $style;
}
function dateDatabaseFormat($date)
{
	$date = implode('-', array_reverse(explode('/', $date))); 
	return $date;
}
function dateGeneralFormat($date)
{	
	if($date != '0000-00-00') { 
		$date = implode('/', array_reverse(explode('-', $date))); 
	} else {
		$date = '';
	}	
	return $date;
}
function dateDisplayFormat($date)
{
	$date = date("jS M, Y");
	return $date;
}
function dateTimeDisplayFormat($date_time)
{
	return date("D, jS M Y h:i:s A", $date_time);
}
function timeDisplayFormat($time)
{
	return @date("h:i:s A", $time);
}
function monthName($month)
	{
		return date("F", mktime(0, 0, 0, $month, 10));
	}
// Pagination
// Pagination
function pagination($query, $from, $max_results, $pagination) // table_name, where, from, max_results, pagination
{
	
	$myUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	
	$queryString = $_SERVER['QUERY_STRING'];
	
	$url = "$myUrl?$queryString";
	$url= str_replace("&pagination=$pagination", "", $url);
	
	
	//echo $_GET['pagination'].'<br />'; //exit;
	
	$from = (($pagination * $max_results) - $max_results); 
	$pagination_result='';
	//echo $sql = "SELECT COUNT(*) FROM $table_name $where"; 
	$exp=mysql_query($query);
	$total_results = mysql_result($exp,0); 
	// Figure out the total number of pages. Always round up using ceil()
	$total_pages = ceil($total_results / $max_results); 
	
		if($total_pages>1) {
		
		// Build Page Number Hyperlinks.Build Previous Link
		if($pagination > 1) {
			$prev = ($pagination - 1);
			$pagination_result.= "<a href=\"".$url."&pagination=1\" class=paging_link>&lsaquo;&lsaquo;&nbsp;First</a>&nbsp;<a href=\"".$url.
			"&pagination=$prev\" class=paging_link>&lsaquo;&nbsp;Previous</a>&nbsp;&nbsp;";
		}
		for($i = 1; $i <= $total_pages; $i++) {
			$start=$pagination;
			if(($pagination) == $i) {
				$pagination_result.= "<b class='paging_active'>$i</b>";
			} elseif($i < ($start+5) && $i > ($start-5) ) {
			
			
				$pagination_result.="&nbsp;<a class='paging_link' href=\"".$url."&pagination=$i\">$i</a>&nbsp;";
				
			}
		}
		
		// Build Next Link
		if($pagination < $total_pages) {
			$next = ($pagination + 1);
			$pagination_result.= "<a href=\"".$url."&pagination=$next\" class=paging_link>Next&nbsp;&rsaquo;</a>&nbsp;<a href=\"".$url."&pagination=$total_pages\" class=paging_link>Last&nbsp;&rsaquo;&rsaquo;</a>";
		}
		
		
	}
	return $pagination_result;
}
// Shopping cart item count
function cartItemCount() 
{
	$ss_id = session_id();
	$select_product_count = "SELECT SUM(shopping_cart_product_quantity) AS quantity_count FROM shopping_cart WHERE shopping_cart_session_id='".$ss_id."'"; 
	$result_product_count = mysql_query($select_product_count);
	$record_product_count = mysql_fetch_array($result_product_count);
	return $record_product_count['quantity_count'];
}
// CMS Page
function cmsPage($page_id) 
{
	$select_cms_page = "SELECT  cms_page_title, cms_page_content
						FROM     cms_pages 
						WHERE   cms_page_id='".$page_id."' 
						AND cms_page_deleted_status=0";
	$result_cms_page = mysql_query($select_cms_page);
	$record_cms_page = mysql_fetch_array($result_cms_page);
	return array($record_cms_page['cms_page_title'], $record_cms_page['cms_page_content']);
}
// Meta Tag - page title, meta description, meta keyword
function metaTag($meta_tag_id) 
{
	$select_seo_page = "SELECT  meta_tag_id, meta_tag_page_name, meta_tag_page_title, meta_tag_description, meta_tag_keywords 
						FROM    meta_tags 
						WHERE   meta_tag_id='".$meta_tag_id."'";
	$result_seo_page = mysql_query($select_seo_page);
	$record_seo_page = mysql_fetch_array($result_seo_page);
	return array($record_seo_page['meta_tag_page_title'], $record_seo_page['meta_tag_description'], $record_seo_page['meta_tag_keywords']);
}
// Module setting
function siteSetting($module_id) 
{
	$select_site_setting = "SELECT 	site_setting_name ,	site_setting_content  	  
								  FROM  site_settings 
								  WHERE site_setting_public_status ='publish' 
								  AND site_setting_deleted_status =0 AND site_setting_id ='".$site_id."'";
	$result_site_setting = mysql_query($select_site_setting);
	$record_site_setting = mysql_fetch_array($result_site_setting); 
	return $record_site_setting['site_setting_content'];
}
// Random string
function genRandomString($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	$string ='';    
	for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0, strlen($characters))];
	}
	return $string;
}
// Get file name
function getFileName() {
	$file_with_path = $_SERVER["PHP_SELF"];
	
	$parts = explode('/', $file_with_path);
	
	$file_name_extn =  $parts[count($parts) - 1];
	$file_name = explode('.', $file_name_extn);
	$file = $file_name[count($file_name) - 2];
	//echo $file; exit; 
	return $file; 
}
function getFileFolderName() {
	$file_with_path = $_SERVER["PHP_SELF"];
	
	$parts = explode('/', $file_with_path);
//	echo $parts[count($parts) - 2];
	return $parts[count($parts) - 2]; 
}
function generatePassword($password) {
	$password = md5($password);
	$generate_password = substr($password,0,7).generateRandomString(3).substr($password,7,4).generateRandomString(5).substr($password,11,22);
	//$generate_password = substr($password,0,7).'123'.substr($password,7,4).'12345'.substr($password,11,22);
	//echo strlen($password).'<br />'.$password.'<br />'.strlen($generate_password).'<br />'.$generate_password;  exit;
	return $generate_password;
 }
function getRealPassword($password) {
	$real_password = substr($password,0,7).substr($password,10,4).substr($password,19,21); 
	return $real_password;
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
function passwordDecryption($password) {
	echo $password.'<br />';
	echo sha1('Admin123').'<br />'.strlen($password).'<br />';
	
	echo substr($password,0,7); exit;
}
function generateRandomInteger($length) {
	$alphabet = "0123456789";
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < $length; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}
function generateId($id) {
	$random_integer = generateRandomInteger(20);
	$first_random_integer = substr($random_integer,0,12); 
	$last_random_integer  = substr($random_integer,-8); 
	$generate_id = $first_random_integer.$id.$last_random_integer;
	return $generate_id; 
}
function explodeId($id) {
	$str_split = str_split($id,12);
	$str_split_length = strlen($str_split[1]);
	$id_length =  $str_split_length-8;
	$original_id = substr($str_split[1],0,$id_length);
	return $original_id; 
}
// Random string
function generateRandomInteger23($length) {
	echo $length; 
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	$string ='';    
	for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0,strlen($characters))];
	}
	return $string;
}
// Delete single record
function deleteSingleRecord($table_name, $deleted_by, $deleted_on, $deleted_ip, $deleted_status, $deleted_id, $id)
{
	$ip = getRealIpAddr();
	$deleterRecord = sprintf("UPDATE $table_name
							  SET    $deleted_by     = '%d',  
									 $deleted_on     = UNIX_TIMESTAMP(NOW()),
									 $deleted_ip     = '%s',
									 $deleted_status = '1'
							  WHERE  $deleted_id     = '%d'
							  LIMIT 1",
							  $_SESSION['session_admin_user_id'], mysql_real_escape_string($ip), $id); 
	 mysql_query($deleterRecord);  
}
// Delete records 
function deleteRecords($table_name, $deleted_by, $deleted_on, $deleted_ip, $deleted_status, $deleted_id, $status)
{
	
	$checked = $_POST['deleteCheck'];
	$ip = getRealIpAddr();
	$count = count($checked);
	for($i=0; $i < $count; $i++) {
		$deleteCheck = $checked[$i]; 
	 	  $deleterRecord = sprintf("UPDATE $table_name
								  SET    $deleted_by     = '%d',  
										 $deleted_on     = UNIX_TIMESTAMP(NOW()),
										 $deleted_ip     = '%s',
										 $deleted_status = '%d'
								  WHERE  $deleted_id     = '%d'
								  LIMIT 1",
								  $_SESSION['session_admin_user_id'], mysql_real_escape_string($ip),$status,  
								  $deleteCheck);   
		 mysql_query($deleterRecord);  
	}
}
// Upload file
function fileUpload($file_name, $file_tmp_name, $file_rename, $path) 
{
	$file_rename       = preg_replace('/[^a-zA-Z0-9]/s', '-', $file_rename);
	
	$file_extn       = explode('.',$file_name);
	
	$file_name_space = str_replace(' ','-',strtolower($file_rename));
	$file_new_name   = $file_name_space.'-'.@mktime().'.'.$file_extn[1];//echo $file_new_name; exit;
	if(!file_exists($path)) {
		mkdir($path);
	}
	if(move_uploaded_file($file_tmp_name,$path.$file_new_name)) {
		//echo 'upload';
	} else {
		//echo 'Test';
	}
	
	return $file_new_name;	
}
// Create thumbnail image
function imageThumb($image_dir, $image_file, $image_temp_file, $image_name, $image_size) {
	//Image Storage Directory
	
	$img = explode('.', $image_file);
	//Original File
	$originalImage=$image_dir.'original_'.$image_file;
	//Thumbnail file name File
	$image_filePath = $image_temp_file;
	$image_name       = preg_replace('/[^a-zA-Z0-9]/s', '-', $image_name);
	$image_name     = str_replace(' ','-',strtolower($image_name));
	$img_fileName   = $image_name.'-'.time().'-thumb.'.$img[1];
	$img_thumb      = $image_dir.$img_fileName;
	$extension      = strtolower($img[1]);
	//echo $image_filePath; exit; 
	//Check the file format before upload
	if(in_array($extension , array('jpg','jpeg', 'gif', 'png', 'bmp'))) {
	
		//Find the height and width of the image
		list($gotwidth, $gotheight, $gottype, $gotattr)= getimagesize($image_filePath); 	
		
		//---------- To create thumbnail of image---------------
		if($extension=="jpg" || $extension=="jpeg" ) {
			$src = imagecreatefromjpeg($image_temp_file);
		} else if($extension=="png") {
			$src = imagecreatefrompng($image_temp_file);
		} else {
			$src = imagecreatefromgif($image_temp_file);
		}
		list($width,$height) = getimagesize($image_temp_file);
		
		if($gotwidth>=$image_size) {
			$newwidth = $image_size;
		} else {
			$newwidth = $gotwidth;
		}
		$newheight = round(($gotheight*$newwidth)/$gotwidth);
		$tmp = imagecreatetruecolor($newwidth,$newheight);
		$img = imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
		//Create thumbnail image
		$createImageSave = imagejpeg($tmp,$img_thumb,$image_size);
		return $img_fileName; 
	}
}
/*// Upload file
function fileUpload($file_name, $file_tmp_name, $file_rename, $path) 
{
	$file_extn       = explode('.',$file_name);
	$file_name_space = str_replace(' ','-',strtolower($file_rename));
	$file_new_name   = $file_name_space.'-'.mktime().'.'.$file_extn[1];
	if(!file_exists($path)) {
		mkdir($path);
	}
	if(move_uploaded_file($file_tmp_name,$path.$file_new_name)) {
		echo 'upload';
	} else {
		echo 'Test';
	}
	
	return $file_new_name;	
}
// Create thumbnail image
function imageThumb($image_dir, $image_file, $image_temp_file, $image_name, $image_size) {
	//Image Storage Directory
	$img = explode('.', $image_file);
	//Original File
	$originalImage=$image_dir.'original_'.$image_file;
	//Thumbnail file name File
	$image_filePath = $image_temp_file;
	 
	$image_name     = str_replace(' ','-',strtolower($image_name));
	$img_fileName   = $image_name.'-'.time().'.'.$img[1];
	$img_thumb      = $image_dir.$img_fileName;
	$extension      = strtolower($img[1]);
	//echo $image_filePath; exit; 
	//Check the file format before upload
	if(in_array($extension , array('jpg','jpeg', 'gif', 'png', 'bmp'))) {
	
		//Find the height and width of the image
		list($gotwidth, $gotheight, $gottype, $gotattr)= getimagesize($image_filePath); 	
		
		//---------- To create thumbnail of image---------------
		if($extension=="jpg" || $extension=="jpeg" ) {
			$src = imagecreatefromjpeg($image_temp_file);
		} else if($extension=="png") {
			$src = imagecreatefrompng($image_temp_file);
		} else {
			$src = imagecreatefromgif($image_temp_file);
		}
		list($width,$height) = getimagesize($image_temp_file);
		
		if($gotwidth>=$image_size) {
			$newwidth = $image_size;
		} else {
			$newwidth = $gotwidth;
		}
		$newheight = round(($gotheight*$newwidth)/$gotwidth);
		$tmp = imagecreatetruecolor($newwidth,$newheight);
		$img = imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
		//Create thumbnail image
		$createImageSave = imagejpeg($tmp,$img_thumb,$image_size);
		return $img_fileName; 
	}
}*/
// Send E-mail
function sendMail($to, $subject, $message, $from) {
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	// More headers
	$headers .= "From: $from" . "\r\n";
	mail($to,$subject,$message,$headers);
}
// Time different
function getTimeDiff($t1,$t2)
{
	$a1 = explode(":",$t1);
	$a2 = explode(":",$t2);
	$time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
	$time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
	$diff = abs($time1-$time2);
	$hours = floor($diff/(60*60));
	$mins = floor(($diff-($hours*60*60))/(60));
	$secs = floor(($diff-(($hours*60*60)+($mins*60))));
	//$result = $hours.":".$mins.":".$secs;
	$result = $hours.":".$mins;
	return $result;
}
//Function to get Company / Branch address
function getAddress($branch_id)
{
	$select_address = "SELECT branch_code, branch_name, branch_address, branch_contact_no, branch_fax_no,branch_email
						 FROM  branches WHERE branch_id = '".$branch_id."' ";	
	$result_address = mysql_query($select_address);
	$record_address = mysql_fetch_array($result_address);
	$comapny_contact_detail =  'Address :'.$record_address['branch_address'].'<br/>'. 'Contact No: '.$record_address['branch_contact_no'].' ,Fax No: '.$record_address['branch_fax_no'].',Email:'.$record_address['branch_email'];
	return $comapny_contact_detail;
}
//amount convert to words
function number_to_words($number)
{
	if ($number > 999999999)
	{
	   //throw new Exception("Number is out of range");
	   echo "Number is out of range";
	}
	$Gn = floor($number / 10000000);  /* Crore (giga) */
	
	$number -= $Gn * 10000000;
	
	 $Ln = floor($number / 100000);  /* Lakes (giga) */
	 
	
	$number -= $Ln * 100000;
	
	
	$kn = floor($number / 1000);     /* Thousands (kilo) */
	
	$number -= $kn * 1000;
	
	$Hn = floor($number / 100);      /* Hundreds (hecto) */
	$number -= $Hn * 100;
	$Dn = floor($number / 10);       /* Tens (deca) */
	$n = $number % 10;     
	
		   /* Ones */
	$cn = round(($number-floor($number))*100); /* Cents */
	
	$result = ""; 
	
	if ($Gn)
	{  $result .= number_to_words($Gn) . " Crore";  } 
	 if ($Ln)
	{ 
	
		if($Ln>1) {$lak =' Lakhs';
		} else {
			$lak =' Lakh';
		}
	 $result .= (empty($result) ? "" : " ")  . number_to_words($Ln).$lak;  } 
	
	
	
	if ($kn)
	{  $result .= (empty($result) ? "" : " ") . number_to_words($kn) . " Thousand"; } 
	if ($Hn)
	{  $result .= (empty($result) ? "" : " ") . number_to_words($Hn) . " Hundred"; } 
	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
		"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
		"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen",
		"Nineteen");
	$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
		"Seventy", "Eighty", "Ninety"); 
	if ( $Dn || $n)
	{
	   if (!empty($result))
	   {  $result .= " and ";
	   } 
	   if ($Dn < 2 )
	   {  $result .= $ones[$Dn * 10 + $n]; 
	   }
	   else
	   {  $result .= $tens[$Dn]; 
		  if ($n)
		  {  $result .= "-" . $ones[$n]; 
		  }
		  
	   }
	}
	if ($cn)
	{
	   if (!empty($result))
	   {  $result .= ' and ';
	   }
	   $title = $cn==1 ? 'paise ': 'paise';
	   $result .= strtolower(number_to_words($cn)).' '.$title;
	}
	if (empty($result))
	{  $result = "zero";
		
	 } 
	return $result;
}
// Indian rupee format
function formatInIndianStyle($num) 
{
	$pos = strpos((string)$num, ".");
	if ($pos === false) {
		$decimalpart="00";
	}
	if (!($pos === false)) {
		$decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos);
	}
	
	if(strlen($num)>3 & strlen($num) <= 12) {
		$last3digits = substr($num, -3 );
		$numexceptlastdigits = substr($num, 0, -3 );
		$formatted = makeComma($numexceptlastdigits);
		$stringtoreturn = $formatted.",".$last3digits.".".$decimalpart ;
	} elseif(strlen($num)<=3) {
		$stringtoreturn = $num.".".$decimalpart ;
	} elseif(strlen($num)>12) {
		$stringtoreturn = number_format($num, 2);
	}
	
	if(substr($stringtoreturn,0,2)=="-,") {
		$stringtoreturn = "-".substr($stringtoreturn,2 );
	}
	
	return $stringtoreturn;
}
	
function makeComma($input){
	// This function is written by some anonymous person - I got it from Google
	if(strlen($input)<=2) { 
		return $input; 
	}
	$length=substr($input,0,strlen($input)-2);
	$formatted_input = makeComma($length).",".substr($input,-2);
	return $formatted_input;
}
 // Date Difference
function dateDifference($from_date, $to_date)  
{  
	return floor((strtotime($to_date) - strtotime($from_date)) / 86400);  
}
//function to update in stock
function update_stock_availability($trans_type,$product_id,$qty,$branch_id,$year_id) {
		$ip = getRealIpAddr();//To get IP address
		$select_stock_availability 		= "SELECT stock_availability_product_id, stock_availability_product_quantity 
											FROM    stock_availability
											WHERE   stock_availability_product_id        = '".$product_id."' AND stock_availability_branch_id = '".$branch_id."'
											AND stock_availability_financial_year_id = '".$year_id."'";  //Select query to check stock added or not. 
		
		
		$stock_availability_result		= mysql_query($select_stock_availability);
		$count_stock_availability		= mysql_num_rows($stock_availability_result);   
		//echo $count_stock_availability; exit;
		//Condition to check either stock added
		if ($count_stock_availability > 0) {
				
				//To check trans type is A 
				if ($trans_type == 'A'){	
				
				 $update_stock_availability	= "UPDATE stock_availability 
											   SET	  stock_availability_product_quantity = stock_availability_product_quantity + '".$qty."' 
											   WHERE  stock_availability_product_id        = '".$product_id."' AND stock_availability_branch_id = '".$branch_id."'
											   AND stock_availability_financial_year_id = '".$year_id."'";  
											   //exit;
											   //Update query for stock if already exist to add
				} else if ($trans_type == 'L'){	//To check stock type is S
			
					$update_stock_availability	= "UPDATE  stock_availability 
											   SET	   stock_availability_product_quantity = stock_availability_product_quantity - '".$qty."' 	
											   WHERE   stock_availability_product_id    	   = '".$product_id."' AND stock_availability_branch_id = '".$branch_id."'
											   AND stock_availability_financial_year_id = '".$year_id."'"; 
											   
											   //Update query for stock if already exist to delete
											   
				}
					
					
					
				mysql_query($update_stock_availability);//Update query mysql statement 
			} 
		 else {  
			 	$stock_availability_uniq_id			  		= generateUniqId();  
			//If stock already added comes insert part
			  $insert_stock_availability = sprintf("INSERT INTO stock_availability (stock_availability_uniq_id,
			  																			stock_availability_product_id, 
																						stock_availability_product_quantity, 
																						stock_availability_branch_id,
																						stock_availability_financial_year_id) 
														VALUES                       (	'%s',
																						'%d', 
																						'%f',
																						'%d',
																						'%d')",
																						$stock_availability_uniq_id,
																						$product_id, 
																						$qty, $branch_id, $year_id);
																						
																				//Insertion query for newly added product
			mysql_query($insert_stock_availability);//Insertion query mysql statement
			
		} 	
		
		
	}
	
//select visitor
function siteVisitor() {
	$visitor_session_id =session_id();
	
	$select_visitor 		= "SELECT visitor_session_id 
							   FROM    visitors
							   WHERE   visitor_session_id        = '".$visitor_session_id."'";  
	//Select query to check stock added or not. 
	
	
	$visitor_result		= mysql_query($select_visitor);
	$count_visitor		= mysql_num_rows($visitor_result);   
	
	//Condition to check either Visitor
	if ($count_visitor == 0) {
		$ip                               = getRealIpAddr(); 
		$insert_visitor = sprintf("INSERT INTO visitors (visitor_session_id, visitor_added_on,  visitor_added_ip) 
		VALUES                       (	'%s', UNIX_TIMESTAMP(NOW()),  '%s')",
				$visitor_session_id, $ip);
				
		 
		mysql_query($insert_visitor);//Insertion query mysql statement
	
	
	}
}
	
	
// round given no 
function roundGivenNo($given_no)
{
	$whole = $given_no;
	$first_part = floor($given_no);
	$second_part = $whole-$first_part;
	if($second_part>=0.50){
		return $first_part+1;
	} else {
		return $first_part;
	}
	
}	
function getEmployeeId($uniq_id)
{
	$select_employee_id = "SELECT employee_id FROM employees WHERE employee_uniq_id = '".$uniq_id."'";
	$result_employee_id = mysql_query($select_employee_id);
	$record_employee_id = mysql_fetch_array($result_employee_id);
	return $record_employee_id['employee_id'];
}
function getEmployeeBranchId($uniq_id)
{
	$select_employee_id = "SELECT employee_branch_id FROM employees WHERE employee_uniq_id = '".$uniq_id."'";
	$result_employee_id = mysql_query($select_employee_id);
	$record_employee_id = mysql_fetch_array($result_employee_id);
	return $record_employee_id['employee_branch_id'];
}
	// function to get branch name & address for excel & pdf
function getReportBranchName($branch_id)
{
	$select_branch_name = "SELECT branch_name FROM branches 
						WHERE  branch_id='".$branch_id."' AND   branch_delete_status =0";
	$result_branch_name = mysql_query($select_branch_name);
	$record_branch_name = mysql_fetch_array($result_branch_name);
	$branch_val = $record_branch_name['branch_name'];
	return $branch_val;
}
function getReportAddress()
{
	$address_val = '';
	if($_SESSION['session_admin_user_level']=='admin'){
		
		$address_val = "No: 53, Icon Savithiri Ganesh Building, Habibulla Road,
						T.Nagar, Chennai-600017,
						Phone No: 044-28349860/61.";
		
	} else {
		
		$select_branch = "SELECT branch_address FROM branches 
								WHERE  branch_id='".$_SESSION['session_admin_user_branch_id']."' AND   branch_delete_status =0";
		$result_branch = mysql_query($select_branch);
		$record_branch = mysql_fetch_array($result_branch);
		$address_val = $record_branch['branch_address'];
		
	}
	return $address_val;
}
function getPayslipAddress()
{
	$address_val = '';
	if($_SESSION['session_admin_user_level']=='admin'){
		
		$address_val = "No: 53, Icon Savithiri Ganesh Building, Habibulla Road, T.Nagar, Chennai-600017.";
		
	} else {
		
		$select_branch = "SELECT branch_address FROM branches 
								WHERE  branch_id='".$_SESSION['session_admin_user_branch_id']."' AND   branch_delete_status =0";
		$result_branch = mysql_query($select_branch);
		$record_branch = mysql_fetch_array($result_branch);
		$address_val = $record_branch['branch_address'];
		
	}
	return $address_val;
}
function getPresentDays($trans_month, $trans_year, $employee_id){
		$select_attendance = "SELECT attendance_employee_id, SUM(attendance_lop_days) AS lop_days FROM attendance 
							WHERE attendance_deleted_status =0 AND attendance_employee_id = '".$employee_id."' 
							AND MONTH(attendance_date) = '".$trans_month."'  "; 
		$result_attendance = mysql_query($select_attendance);
		$record_attendance = mysql_fetch_array($result_attendance);
		$absent_days = $record_attendance['lop_days'];
		
		$no_of_working_days = cal_days_in_month(CAL_GREGORIAN, $trans_month, $trans_year);
		return $present_days = $no_of_working_days - $absent_days;
}
function getApproxSalary($trans_month, $trans_year, $employee_id, $present_days){
		$select_employees_salary = "SELECT employee_salary_detail_basic_pay, employee_salary_detail_da, employee_salary_detail_hra, 
									employee_salary_detail_special_allowance, employee_salary_detail_medical_allowance, 
									employee_salary_detail_convenience, employee_salary_detail_insurence_amount, 
									employee_salary_detail_other_allowance, employee_salary_detail_pf_amt,
									employee_salary_detail_pf_status, employee_salary_detail_esi_status ,
									employee_salary_detail_pf_no, employee_salary_detail_esi_no,
									employee_salary_detail_gross_amt, employee_salary_detail_tds_status
									FROM employee_salary_details 
									WHERE employee_salary_detail_employee_id = '".$employee_id."' 
									AND employee_salary_detail_deleted_status=0
									ORDER BY employee_salary_detail_from_date DESC LIMIT 1"; 
		$result_employees_salary = mysql_query($select_employees_salary);									
		$record_employees_salary = mysql_fetch_array($result_employees_salary);
		$employee_basic_pay_amt         = $record_employees_salary['employee_salary_detail_basic_pay'];
		$employee_da_amt                = $record_employees_salary['employee_salary_detail_da'];
		$employee_hra_amt               = $record_employees_salary['employee_salary_detail_hra'];
		$employee_special_allawance_amt = $record_employees_salary['employee_salary_detail_special_allowance'];
		$employee_medical_allawance_amt = $record_employees_salary['employee_salary_detail_medical_allowance'];
		$employee_other_allowance 		= $record_employees_salary['employee_salary_detail_other_allowance'];
		$employee_convenience_amt       = $record_employees_salary['employee_salary_detail_convenience'];
		$employee_insurence_amt         = $record_employees_salary['employee_salary_detail_insurence_amount'];
		$employee_gross_amt            	= $record_employees_salary['employee_salary_detail_gross_amt'];		
		
		$no_of_working_days = cal_days_in_month(CAL_GREGORIAN, $trans_month, $trans_year);
		
		$employee_earning_basic_pay_amt         = roundGivenNo(($employee_basic_pay_amt / $no_of_working_days) * $present_days);
		$employee_earning_da_amt                = roundGivenNo(($employee_da_amt / $no_of_working_days) * $present_days);
		$employee_earning_hra_amt               = roundGivenNo(($employee_hra_amt / $no_of_working_days) * $present_days);
		$employee_earning_special_allawance_amt = roundGivenNo( ($employee_special_allawance_amt / $no_of_working_days) * $present_days);
		$employee_earning_medical_allawance_amt = roundGivenNo(($employee_medical_allawance_amt / $no_of_working_days) * $present_days);
		$employee_earning_convenience_amt       = roundGivenNo(($employee_convenience_amt / $no_of_working_days) * $present_days);
		$employee_earning_other_allowance       = roundGivenNo(($employee_other_allowance / $no_of_working_days) * $present_days);
		
		$payroll_employee_earning = ($employee_earning_basic_pay_amt + $employee_earning_da_amt + $employee_earning_hra_amt + 
									 $employee_earning_special_allawance_amt + $employee_earning_medical_allawance_amt + 
									 $employee_earning_convenience_amt + $employee_earning_other_allowance);	
									 
		$per_day_salary = $payroll_employee_earning / $no_of_working_days;	
		
		$approx_salary = $per_day_salary * $present_days;	
		
		return $approx_salary;					 
}
function getGrossSalary($employee_id, $percentage){
		$select_employees_salary = "SELECT employee_salary_detail_gross_amt FROM employee_salary_details 
									WHERE employee_salary_detail_employee_id = '".$employee_id."' 
									AND employee_salary_detail_deleted_status=0
									ORDER BY employee_salary_detail_from_date DESC LIMIT 1"; 
		$result_employees_salary = mysql_query($select_employees_salary);									
		$record_employees_salary = mysql_fetch_array($result_employees_salary);
		$employee_gross_amt            	= $record_employees_salary['employee_salary_detail_gross_amt'];		
									 
		$approx_salary = ($employee_gross_amt * $percentage) / 100;	
		
		return $approx_salary;					 
}
function countDays($trans_date, $employee_id){
		$month =date("m",strtotime($trans_date));
		$select_attendance = "SELECT SUM(attendance_lop_days) AS absent_days, COUNT(attendance_lop_days) AS no_of_days,
								SUM(CASE WHEN attendance_status = 'absent' THEN 1 ELSE 0 END) AS lop_days FROM attendance 
							WHERE attendance_deleted_status =0 AND attendance_employee_id = '".$employee_id."' 
							AND MONTH(attendance_date) = '".$month."' AND attendance_status != 'relieved'"; 
		$result_attendance = mysql_query($select_attendance);
		$record_attendance = mysql_fetch_array($result_attendance);
		$count_days = array();	
		$count_days['lop_days'] 				= $record_attendance['lop_days'];
		$count_days['absent_days'] 				= $record_attendance['absent_days'];
		$count_days['no_of_days'] 				= $record_attendance['no_of_days'];
		return $count_days;
}
function getEarning($trans_date, $employee_id, $to_date){
		
		$select_employees_salary = "SELECT employee_salary_detail_basic_pay, employee_salary_detail_da, employee_salary_detail_hra, 
									employee_salary_detail_special_allowance, employee_salary_detail_medical_allowance, 
									employee_salary_detail_convenience, employee_salary_detail_insurence_amount, 
									employee_salary_detail_other_allowance, employee_salary_detail_pf_amt,
									employee_salary_detail_pf_status, employee_salary_detail_esi_status ,
									employee_salary_detail_pf_no, employee_salary_detail_esi_no,
									employee_salary_detail_gross_amt, employee_salary_detail_tds_status,
									employee_job_status, employee_doj,  employee_relieved_date, employee_no,
									employee_branch_id, employee_attendance_status
									FROM employee_salary_details 
									LEFT JOIN employees ON employee_salary_detail_employee_id = employee_id
									WHERE employee_salary_detail_employee_id = '".$employee_id."' 
									AND employee_salary_detail_deleted_status=0
									AND employee_salary_detail_from_date <= '".$trans_date."' 
									AND employee_salary_detail_to_date >= '".$trans_date."' "; 
		$result_employees_salary = mysql_query($select_employees_salary);									
		$record_employees_salary = mysql_fetch_array($result_employees_salary);
		$employee_basic_pay_amt         = $record_employees_salary['employee_salary_detail_basic_pay'];
		$employee_da_amt                = $record_employees_salary['employee_salary_detail_da'];
		$employee_hra_amt               = $record_employees_salary['employee_salary_detail_hra'];
		$employee_special_allawance_amt = $record_employees_salary['employee_salary_detail_special_allowance'];
		$employee_medical_allawance_amt = $record_employees_salary['employee_salary_detail_medical_allowance'];
		$employee_other_allowance 		= $record_employees_salary['employee_salary_detail_other_allowance'];
		$employee_convenience_amt       = $record_employees_salary['employee_salary_detail_convenience'];
		$employee_insurence_amt         = $record_employees_salary['employee_salary_detail_insurence_amount'];
		$employee_gross_amt            	= $record_employees_salary['employee_salary_detail_gross_amt'];		
		
		$month =date("m",strtotime($trans_date));
		$year =date("Y",strtotime($trans_date));
/*		$per = 0;
		if($month == '11' && $year=2016) {
			if($employee_gross_amt >= 10501 && $employee_gross_amt <= 20000) {
				$per = 10;
			} else if($employee_gross_amt >= 20001 && $employee_gross_amt <= 30000) {
				$per = 15;
			} else if($employee_gross_amt >= 30001 ) {
				$per = 20;
			}
			$employee_gross_amt = $employee_gross_amt - round(($employee_gross_amt * $per)/100);
			$employee_basic_pay_amt = $employee_basic_pay_amt - round(($employee_basic_pay_amt * $per)/100);
			$employee_da_amt = $employee_da_amt - round(($employee_da_amt * $per)/100);
			$employee_hra_amt = $employee_hra_amt - round(($employee_hra_amt * $per)/100);
			$employee_special_allawance_amt = $employee_special_allawance_amt - round(($employee_special_allawance_amt * $per)/100);
			$employee_medical_allawance_amt = $employee_medical_allawance_amt - round(($employee_medical_allawance_amt * $per)/100);
			$employee_other_allowance = $employee_other_allowance - round(($employee_other_allowance * $per)/100);
			$employee_convenience_amt = $employee_convenience_amt - round(($employee_convenience_amt * $per)/100);
			$employee_insurence_amt = $employee_insurence_amt - round(($employee_convenience_amt * $per)/100);
		}*/
		
		$salary_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$from_date = $year.'-'.$month.'-01'; 
		
		$no_of_working_days = count(createDateRangeArray($from_date, $to_date)); //cal_days_in_month(CAL_GREGORIAN, $month, $year);
		
		$month_last_date = $year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN, $month, $year); 
		
		if($to_date == $month_last_date) {
			$to_date = $month_last_date; 
		}/* else {
			$date = strtotime("-1 days", strtotime($to_date));
			$to_date = trim(date("Y-m-d", $date));
		}*/
		
//		$to_date = $year.'-'.$month.'-31'; 
/*		$count_day_arr = countDays($trans_date, $employee_id);
//		$no_of_working_days 	= $count_day_arr['no_of_days'] ;
		$absent_days 			= $count_day_arr['absent_days'] ;
		$lop_days 				= $count_day_arr['lop_days'] + $count_day_arr['absent_days'];
		$present_days = $count_day_arr['no_of_days'] - $absent_days;*/
		
		 $get_attendance_days  = countAttendanceDays($month, $year, $employee_id, $to_date); 
		 
		 if ($get_attendance_days['half'] > 0) {
			 $half_days 		= $get_attendance_days['half'] / 2;
		 } else {
			 $half_days 		= 0;					 
		 }	 
		 
		 if ($get_attendance_days['weekoffhalf'] > 0) {
			 $weekoffhalf_days 	= $get_attendance_days['weekoffhalf'] / 2;
		 } else {
			 $weekoffhalf_days 	= 0;					 
		 }
		 if ($get_attendance_days['spl_half'] > 0) {
			 $splhalf_days 	= $get_attendance_days['spl_half'] / 2;
		 } else {
			 $splhalf_days 	= 0;					 
		 }
		 
		 $weekoffworking_days 	= $get_attendance_days['weekoffworking'] ;	
		 
		 if($month == '11' && $year=2016 && $record_employees_salary['employee_branch_id']=1) {
			$present_days 			= $get_attendance_days['working'] + $get_attendance_days['present'] + $get_attendance_days['weekoffpresent'] + $weekoffhalf_days + $get_attendance_days['working'] + $get_attendance_days['double_pay'] + $get_attendance_days['casual'] + $weekoffworking_days;	
		 } else {
		 	$present_days 			= $get_attendance_days['present'] + $get_attendance_days['weekoffpresent'] + $weekoffhalf_days + $get_attendance_days['working'] + $get_attendance_days['double_pay'] + $get_attendance_days['casual'] + $weekoffworking_days;	
		 }	 	 
		 	
		 $leave_days 			= $get_attendance_days['leave_days'];
		 $absent_days 			= $get_attendance_days['absent'] ;
		 $weekoff_days 			= $get_attendance_days['weekoff'] ;
		 //$weekoff_days 			= weekdaysCount($month, $year, $record_payroll['payroll_employee_id']); //$get_attendance_days['weekoff'];
		 
							 
		 $special_leave_days 	= $get_attendance_days['spl_leave_days'] + $splhalf_days ;					 
//					 $weekoffhalf_days 		= $get_attendance_days['weekoffhalf'] ;
		 $weekoffpresent_days 	= $weekoffhalf_days; //$get_attendance_days['weekoffpresent'] + $weekoffhalf_days + $get_attendance_days['double_pay'] +  $weekoffworking_days;
		
		 $working_days 			= $get_attendance_days['working'] ;
		 $relieved_days 		= $get_attendance_days['relieved'] ;
		 $total_lop_days 		= $leave_days + $half_days + $absent_days + $absent_days + $special_leave_days + $special_leave_days;
		 $total_paid_days 		= $present_days + $half_days + $weekoff_days + $weekoffpresent_days + $weekoffhalf_days; 	
		 $blank_days = 0;
		
		
					/*if($record_employees_salary['employee_no'] == '02587') {
						echo $total_lop_days; 
						exit;
					}	*/		  
							 
/*		 if($to_date != $month_last_date) {
			$blank_days = count(createDateRangeArray(date("Y-m-d", strtotime("+1 days", strtotime($to_date))), $month_last_date)); 
		 } else {
			$blank_days = 0;
		 }*/
		
								 
/*		if($record_employees_salary['employee_doj'] <> '0000-00-00') {
			if(strtotime($record_employees_salary['employee_doj']) >= strtotime($from_date)) {
				$no_of_working_days = count(createDateRangeArray($record_employees_salary['employee_doj'],$to_date));
			}
		}
		if($record_employees_salary['employee_job_status'] == 'relieved') {
			if(strtotime($record_employees_salary['employee_relieved_date']) >= strtotime($from_date)) {
				$no_of_working_days = count(createDateRangeArray($from_date, $record_employees_salary['employee_relieved_date']));
				$no_of_working_days = $no_of_working_days - 1;
			} 
			if( (date('m', strtotime($record_employees_salary['employee_doj'])) == date('m', strtotime($record_employees_salary['employee_relieved_date']))) && (date('Y', strtotime($record_employees_salary['employee_doj'])) == date('Y', strtotime($record_employees_salary['employee_relieved_date']))) ) {
				$no_of_working_days = count(createDateRangeArray($record_employees_salary['employee_doj'], $record_employees_salary['employee_relieved_date']));
			}
		}
		*/
					if($record_employees_salary['employee_doj'] <> '0000-00-00') {
						if(strtotime($record_employees_salary['employee_doj']) >= strtotime($from_date)) {
							$blank_days = $blank_days + count(createDateRangeArray($from_date, $record_employees_salary['employee_doj']));
							$blank_days = $blank_days - 1;
						} 
					}
					
					if($record_employees_salary['employee_job_status'] == 'relieved') {
						if(strtotime($record_employees_salary['employee_relieved_date']) <= strtotime($to_date)) {
							if(strtotime($record_employees_salary['employee_relieved_date']) >= strtotime($from_date)) {
								$blank_days = $blank_days + count(createDateRangeArray($record_employees_salary['employee_relieved_date'], $to_date));
							}
						}
					}
					if( (date('m', strtotime($record_employees_salary['employee_doj'])) == date('m', strtotime($record_employees_salary['employee_relieved_date']))) && (date('Y', strtotime($record_employees_salary['employee_doj'])) == date('Y', strtotime($record_employees_salary['employee_relieved_date']))) ) {
						if($record_employees_salary['employee_job_status'] == 'relieved') {
							$blank_days = 0;
							$blank_days = $blank_days + count(createDateRangeArray($from_date, $record_employees_salary['employee_doj']))-1;
							$blank_days = $blank_days + count(createDateRangeArray($record_employees_salary['employee_relieved_date'], $to_date));
						}								
					}					
					
	
		 
					 $total_lop_days 		= $total_lop_days + $blank_days ;	
					 $actual_paid_days		= $no_of_working_days - $total_lop_days;
					 $final_paid_days		= ($weekoffpresent_days + $actual_paid_days) ;		 	
		 			 if($record_employees_salary['employee_attendance_status'] == 1){
						$total_lop_days 	= 0;	
						$actual_paid_days	= 0;						 
					 	$final_paid_days 	= $salary_days;
					 }

		
	//	if ($final_paid_days > 0) {
			
			$select_arrears_entry = "SELECT SUM(arrears_entry_amount) as arrears_entry_amount FROM  arrears_entry
									  WHERE arrears_entry_month = '".$month."' 
									  AND arrears_entry_year = '".$year."'
									  AND arrears_entry_employee_id = '".$employee_id."'
									  AND arrears_entry_deleted_status = 0 "; 
	
			$result_arrears_entry = mysql_query($select_arrears_entry);	
			$record_arrears_entry = mysql_fetch_array($result_arrears_entry);
			$arrears_entry_amount = $record_arrears_entry['arrears_entry_amount'];	
	
			$employee_earning_basic_pay_amt         = roundGivenNo(($employee_basic_pay_amt / $salary_days) * $final_paid_days);
			$employee_earning_da_amt                = roundGivenNo(($employee_da_amt / $salary_days) * $final_paid_days);
			$employee_earning_hra_amt               = roundGivenNo(($employee_hra_amt / $salary_days) * $final_paid_days);
			$employee_earning_special_allawance_amt = roundGivenNo( ($employee_special_allawance_amt / $salary_days) * $final_paid_days);
			$employee_earning_medical_allawance_amt = roundGivenNo(($employee_medical_allawance_amt / $salary_days) * $final_paid_days);
			$employee_earning_convenience_amt       = roundGivenNo(($employee_convenience_amt / $salary_days) * $final_paid_days);
			$employee_earning_other_allowance       = roundGivenNo(($employee_other_allowance / $salary_days) * $final_paid_days);
				
			$payroll_employee_earning = roundGivenNo($employee_earning_basic_pay_amt + $employee_earning_da_amt + $employee_earning_hra_amt + 
										 $employee_earning_special_allawance_amt + $employee_earning_medical_allawance_amt + 
										 $employee_earning_convenience_amt + $employee_earning_other_allowance + $arrears_entry_amount);	
										 
			$per_day_salary = $employee_gross_amt / $salary_days;
/*		} else {
			$employee_earning_basic_pay_amt         = 0;
			$employee_earning_da_amt                = 0;
			$employee_earning_hra_amt               = 0;
			$employee_earning_special_allawance_amt = 0;
			$employee_earning_medical_allawance_amt = 0;
			$employee_earning_convenience_amt       = 0;
			$employee_earning_other_allowance       = 0;
			$payroll_employee_earning 				= 0;	
			$per_day_salary 						= 0;		
		}
*/		
		
		
		$earn_salary = array();	
		$earn_salary['no_of_working_days'] 	= $no_of_working_days;
		$earn_salary['present_days'] 		= $final_paid_days;
		$earn_salary['absent_days'] 		= $absent_days;
		$earn_salary['lop_days'] 			= $total_lop_days;
		$earn_salary['per_day_salary'] 		= number_format($per_day_salary,2,'.','');
		$earn_salary['basic_pay_amt'] 		= roundGivenNo($employee_earning_basic_pay_amt);
		$earn_salary['da_amt'] 				= roundGivenNo($employee_earning_da_amt);
		$earn_salary['hra_amt'] 			= roundGivenNo($employee_earning_hra_amt);
		$earn_salary['special_alw_amt'] 	= roundGivenNo($employee_earning_special_allawance_amt);
		$earn_salary['medical_alw_amt'] 	= roundGivenNo($employee_earning_medical_allawance_amt);
		$earn_salary['convenience_amt'] 	= roundGivenNo($employee_earning_convenience_amt);
		$earn_salary['other_alw_amt'] 		= roundGivenNo($employee_earning_other_allowance);
		$earn_salary['total_earn_amt'] 		= roundGivenNo($payroll_employee_earning);
		$earn_salary['paid_days'] 			= $final_paid_days;
		$earn_salary['total_paid_days'] 	= $total_paid_days;
		$earn_salary['arrears_amount'] 		= $arrears_entry_amount;
		
		return $earn_salary;					 
}
function getDeductions($trans_date, $payroll_upto, $earn_amt, $employee_id, $pf_amt, $esi_amt, $branch_id, $paid_days){
		$select_payroll_settings = "SELECT  payroll_setting_employee_esi, payroll_setting_employer_esi, 
											payroll_setting_employee_pf, payroll_setting_employer_pf, 
											payroll_setting_fpf  
									FROM payroll_settings WHERE payroll_setting_id=1";
		$result_payroll_settings = mysql_query($select_payroll_settings);
		$record_payroll_settings = mysql_fetch_array($result_payroll_settings);
		$payroll_setting_employee_pf  = $record_payroll_settings['payroll_setting_employee_pf'];
		$payroll_setting_employer_pf  = $record_payroll_settings['payroll_setting_employer_pf'];
		$payroll_setting_fpf  		  = $record_payroll_settings['payroll_setting_fpf'];
		$employee_esi_per 			  = $record_payroll_settings['payroll_setting_employee_esi'];
		$employer_esi_per             = $record_payroll_settings['payroll_setting_employer_esi'];
				
		$select_employees_salary = "SELECT employee_pf_status, employee_esi_status, employee_tds_status, employee_doj,
									employee_salary_detail_gross_amt FROM employee_salary_details 
									LEFT JOIN employees ON employee_salary_detail_employee_id = employee_id
									WHERE employee_salary_detail_employee_id = '".$employee_id."' 
									AND employee_salary_detail_deleted_status=0
									AND employee_salary_detail_from_date <= '".$trans_date."' 
									AND employee_salary_detail_to_date >= '".$trans_date."'"; 
		$result_employees_salary = mysql_query($select_employees_salary);									
		$record_employees_salary = mysql_fetch_array($result_employees_salary);
		$employee_pf_status             = $record_employees_salary['employee_pf_status'];
		$employee_esi_status            = $record_employees_salary['employee_esi_status'];
		$employee_tds_status            = $record_employees_salary['employee_tds_status'];
		$employee_gross_amt             = $record_employees_salary['employee_salary_detail_gross_amt'];
		
		$month =date("m",strtotime($trans_date));
		$year =date("Y",strtotime($trans_date));
/*		$per = 0;
		if($month == '11' && $year=2016) {
			if($employee_gross_amt >= 10501 && $employee_gross_amt <= 20000) {
				$per = 10;
			} else if($employee_gross_amt >= 20001 && $employee_gross_amt <= 30000) {
				$per = 15;
			} else if($employee_gross_amt >= 30001 ) {
				$per = 20;
			}
			$employee_gross_amt = $employee_gross_amt - round(($employee_gross_amt * $per)/100);
		}	*/	
				
		if($employee_pf_status!=0) { 
			if($pf_amt <= 15000) {
				$employee_pf = roundGivenNo(($pf_amt * $payroll_setting_employee_pf) / 100);
				$employer_pf = roundGivenNo(($pf_amt * $payroll_setting_employer_pf) / 100);
				$fpf 		 = roundGivenNo(($pf_amt * $payroll_setting_fpf) / 100);			
			} else{
				$employee_pf = 1800;
				$employer_pf = 0;
				$fpf 		 = 0;				
			}		
		} else {
			$employee_pf = 0;
			$employer_pf = 0;
			$fpf 		 = 0;
		}	
		
		if($year >= 2017){
			$gamt = 21000;
		} else {
			$gamt = 15000;
		}
		
		if($employee_esi_status!=0) { 
			if($employee_gross_amt <= $gamt) {
				$employee_esi = ($esi_amt * $employee_esi_per) / 100;
				$employee_esi_arr = explode(".",$employee_esi);
				if(!empty($employee_esi_arr[1]) > 0) {
					if($employee_esi_arr[1] > 0) {
						$employee_esi = $employee_esi_arr[0] + 1;
					}
				}
				$employer_esi = ($esi_amt  * $employer_esi_per) / 100;
				$employer_esi_arr = explode(".",$employer_esi);
				if($employer_esi_arr[1] > 0) {
					$employer_esi = $employer_esi_arr[0] + 1;
				}				
			} else {
				$employee_esi = 0;
				$employer_esi = 0; 
			}
		} else {
			$employee_esi = 0;
			$employer_esi = 0; 
		}	
		
			
		
/*		$select_esi = "SELECT esi_slab_amount FROM esi_slab 
						WHERE esi_slab_type = 'employee' AND esi_slab_deleted_status=0 AND
						IF(esi_slab_to_date = '0000-00-00', esi_slab_from_date <= '".$trans_date."',
									 esi_slab_from_date <='".$trans_date."' 
									 and esi_slab_to_date >= '".$trans_date."' ) "; 
											
		$result_esi = mysql_query($select_esi);									
		$record_esi = mysql_fetch_array($result_esi);
		$employee_esi_per = $record_esi['esi_slab_amount'];		
		
		$select_esi = "SELECT esi_slab_amount FROM esi_slab 
						WHERE esi_slab_type = 'employer' AND esi_slab_deleted_status=0 AND
						IF(esi_slab_to_date = '0000-00-00', esi_slab_from_date <= '".$trans_date."',
									 esi_slab_from_date <='".$trans_date."' 
									 and esi_slab_to_date >= '".$trans_date."' ) "; 
											
		$result_esi = mysql_query($select_esi);									
		$record_esi = mysql_fetch_array($result_esi);
		$employer_esi_per = $record_esi['esi_slab_amount'];			
				
		if($employee_esi_status!=0) { 
			if ($employee_gross_amt <= 15000) {
				$employee_esi = floor(($earn_amt  * $employee_esi_per) / 100);
				if($employee_esi > 0) {
					$employee_esi = $employee_esi + 1;
				}
				$employer_esi = floor(($earn_amt  * $employer_esi_per) / 100);
				if($employer_esi > 0) {
					$employer_esi = $employer_esi + 1;
				}				
			} else {
				$employee_esi = 0;
				$employer_esi = 0; 			
			}
		} else {
			$employee_esi = 0;
			$employer_esi = 0; 
		}		
*/		
		$month =date("m",strtotime($trans_date));
		$year =date("Y",strtotime($trans_date));
		$last_date = $year.'-'.$month.'-31';
		
/*		$select_branch = "SELECT employee_branch_detail_branch_id FROM employee_branch_details 
									WHERE employee_branch_detail_employee_id = '".$employee_id."' 
									AND employee_branch_detail_deleted_status=0 AND
									IF(employee_branch_detail_to_date = '0000-00-00', employee_branch_detail_from_date <= '".$trans_date."',
												 employee_branch_detail_from_date <='".$trans_date."' 
												 and employee_branch_detail_to_date >= '".$trans_date."' ) "; 
											
		$result_branch = mysql_query($select_branch);									
		$record_branch = mysql_fetch_array($result_branch);
		$employee_branch_detail_branch_id = $record_branch['employee_branch_detail_branch_id'];	*/	
		$pt_amount =0;
		if($esi_amt>0){
			$select_professional_tax = "SELECT professional_tax_slab_amount FROM professional_tax_slab 
										WHERE professional_tax_slab_branch_id = '".$branch_id."' 
										AND professional_tax_slab_deleted_status=0
										AND professional_tax_slab_from_date <= '".$trans_date."'
										AND professional_tax_slab_to_date >= '".$trans_date."'
										AND IF(professional_tax_slab_amount_type = 'gross', professional_tax_slab_from <= '".$employee_gross_amt."'
																							AND professional_tax_slab_to >= '".$employee_gross_amt."',
																							professional_tax_slab_from <= '".$esi_amt."'
																							AND professional_tax_slab_to >= '".$esi_amt."')  "; 
			$result_professional_tax = mysql_query($select_professional_tax);									
			$record_professional_tax = mysql_fetch_array($result_professional_tax);
			$pt_amount            	 = $record_professional_tax['professional_tax_slab_amount'];
		} else {
			$pt_amount =0;
		}
		
		if($branch_id == 4){
			$select_professional_tax = "SELECT professional_tax_slab_amount FROM professional_tax_slab 
										WHERE professional_tax_slab_branch_id = '".$branch_id."' 
										AND professional_tax_slab_deleted_status=0
										AND professional_tax_slab_from_date <= '".$trans_date."'
										AND professional_tax_slab_to_date >= '".$trans_date."'
										AND IF(professional_tax_slab_amount_type = 'gross', professional_tax_slab_from <= '".$employee_gross_amt."'
																							AND professional_tax_slab_to >= '".$employee_gross_amt."',
																							professional_tax_slab_from <= '".$earn_amt."'
																							AND professional_tax_slab_to >= '".$earn_amt."')  "; 
			$result_professional_tax = mysql_query($select_professional_tax);									
			$record_professional_tax = mysql_fetch_array($result_professional_tax);
			$pt_amount            	 = $record_professional_tax['professional_tax_slab_amount'];
			if($month == '02' && $year=2017) {
				$select_pay = "SELECT payroll_final_paid_days FROM payroll
								  WHERE payroll_employee_id = '".$employee_id."'
								  AND payroll_month = '".$month."' 
								  AND payroll_year = '".$year."' 
								  AND payroll_deleted_status = 0"; 
				$result_pay = mysql_query($select_pay);	
				$record_pay = mysql_fetch_array($result_pay);
				if($record_pay['payroll_final_paid_days'] > 1){	
					if(strtotime($record_employees_salary['employee_doj']) <= strtotime('2017-01-31')	) {
						$pt_amount = 250;
					} else {
						$pt_amount = 0;
					}	
				} else {
					$pt_amount = 0;
				}	
			}
		}				
		
		// Calculate employee TDS amount
		$month =date("m",strtotime($trans_date));
		$year =date("Y",strtotime($trans_date));
		$payroll_mm_yyyy = $month.'/'.$year;
		
		
		
		$select_deduction = "SELECT all_deduction_tds_amount, all_deduction_advance_amount, all_deduction_food_amount,
									  all_deduction_cug_amount, all_deduction_cash_card_amount, all_deduction_others_amount,
									  all_deduction_uniform_amount, all_deduction_id_card_amount, all_deduction_lwf_amount
								  FROM  all_deduction
								  WHERE all_deduction_mm_yyyy = '".$payroll_mm_yyyy."' 
								  AND all_deduction_employee_id = '".$employee_id."'
								  AND all_deduction_deleted_status = 0"; 
		$result_deduction = mysql_query($select_deduction);	
		$record_deduction = mysql_fetch_array($result_deduction);
		$cashcard_amount = $record_deduction['all_deduction_cash_card_amount'];
	//	$salary_advance_amount = $record_deduction['all_deduction_advance_amount'];	
		$other_deduction_amount = $record_deduction['all_deduction_others_amount'];	
		$cug_deduction_amount = $record_deduction['all_deduction_cug_amount'];	
		$tds_amount = $record_deduction['all_deduction_tds_amount'];
		$uniform_amount = $record_deduction['all_deduction_uniform_amount'];
		$id_card_amount = $record_deduction['all_deduction_id_card_amount'];
			
		
		//$lwf_amount = $record_deduction['all_deduction_lwf_amount'];	
	//	$fine_amount = $record_deduction['all_deduction_food_amount'];
		$general_deduction_amount = 0;				
		$select_salary_advance = "SELECT SUM(salary_advance_deduction_amount) as salary_advance_amount FROM salary_advance_deduction
								  WHERE salary_advance_deduction_mm_yyyy = '".$payroll_mm_yyyy."' 
								  AND salary_advance_deduction_employee_id = '".$employee_id."'
								  AND salary_advance_deduction_type = 'deduction'
								  AND salary_advance_deduction_deleted_status = 0"; 
		$result_salary_advance = mysql_query($select_salary_advance);	
		$record_salary_advance = mysql_fetch_array($result_salary_advance);
		$salary_advance_amount = $record_salary_advance['salary_advance_amount'];
		
		if($month == 12){
			if($paid_days > 1){
				if($branch_id == 4){
					$lwf_amount = 0;	
				} else if( ($branch_id == 5) || ($branch_id == 19) ) {  //karnatka
					$lwf_amount = 6;	
				} else if( ($branch_id == 12) || ($branch_id == 16) ) { //andhra
					$lwf_amount = 30;	
				} else {
					$lwf_amount = 10;
				}
			} else {
				$lwf_amount  = 0;
			}
		} else {
			$lwf_amount  = 0;
		}		
		
		/*if($employee_tds_status!=0) { 
			 $select_tds = "SELECT SUM(tds_amount) as tds_amount FROM  tds
									  WHERE tds_mm_yyyy = '".$payroll_mm_yyyy."' 
									  AND tds_employee_id = '".$employee_id."'
									  AND tds_deleted_status = 0";  
			$result_tds = mysql_query($select_tds);	
			$record_tds = mysql_fetch_array($result_tds);
			$tds_amount = $record_tds['tds_amount'];							
		} else {
			$tds_amount = 0;
		}	
		
		// Calculate employee Salary Advance
		$select_salary_advance = "SELECT SUM(salary_advance_deduction_amount) as salary_advance_amount FROM salary_advance_deduction
								  WHERE salary_advance_deduction_mm_yyyy = '".$payroll_mm_yyyy."' 
								  AND salary_advance_deduction_employee_id = '".$employee_id."'
								  AND salary_advance_deduction_deleted_status = 0"; 
		$result_salary_advance = mysql_query($select_salary_advance);	
		$record_salary_advance = mysql_fetch_array($result_salary_advance);
		$salary_advance_amount = $record_salary_advance['salary_advance_amount'];	
		
		// Calculate employee Other Deduction amount
		$select_other_deduction = "SELECT SUM(other_deduction_amount) as other_deduction_amount FROM  other_deduction
								  WHERE other_deduction_mm_yyyy = '".$payroll_mm_yyyy."' 
								  AND other_deduction_employee_id = '".$employee_id."'
								  AND other_deduction_deleted_status = 0 "; 
		$result_other_deduction = mysql_query($select_other_deduction);	
		$record_other_deduction = mysql_fetch_array($result_other_deduction);
		$other_deduction_amount = $record_other_deduction['other_deduction_amount'];								
		
		// Calculate employee General Deduction amount
		$select_general_deduction = "SELECT SUM(general_deduction_amount) as general_deduction_amount FROM  general_deduction
								  WHERE general_deduction_mm_yyyy = '".$payroll_mm_yyyy."' 
								  AND general_deduction_employee_id = '".$employee_id."'
								  AND general_deduction_deleted_status = 0"; 
		$result_general_deduction = mysql_query($select_general_deduction);	
		$record_general_deduction = mysql_fetch_array($result_general_deduction);
		$general_deduction_amount = $record_general_deduction['general_deduction_amount'];	
		
		// Calculate employee cug_deduction Deduction amount
		$select_cug_deduction = "SELECT SUM(cug_deduction_amount) as cug_deduction_amount FROM  cug_deduction
								  WHERE cug_deduction_mm_yyyy = '".$payroll_mm_yyyy."' 
								  AND cug_deduction_employee_id = '".$employee_id."'
								  AND cug_deduction_deleted_status = 0"; 
		$result_cug_deduction = mysql_query($select_cug_deduction);	
		$record_cug_deduction = mysql_fetch_array($result_cug_deduction);
		$cug_deduction_amount = $record_cug_deduction['cug_deduction_amount'];		
		
		// Calculate employee cug_deduction Deduction amount
		$select_cashcard_deduction = "SELECT SUM(cashcard_deduction_amount) as cashcard_deduction_amount FROM  cashcard_deduction
								  WHERE cashcard_deduction_mm_yyyy = '".$payroll_mm_yyyy."' 
								  AND cashcard_deduction_employee_id = '".$employee_id."'
								  AND cashcard_deduction_deleted_status = 0"; 
		$result_cashcard_deduction = mysql_query($select_cashcard_deduction);	
		$record_cashcard_deduction = mysql_fetch_array($result_cashcard_deduction);
		$cashcard_deduction_amount = $record_cashcard_deduction['cashcard_deduction_amount'];		*/		
		
		$payroll_date = $year.'-'.$month.'-01'; 
		$payroll_upto = dateDatabaseFormat($payroll_upto);
		$fine_amount = 0;
		
		$select_fine_amt = "SELECT SUM(attendance_fine_tot_amount) as fine_amount FROM  attendance
								  WHERE attendance_employee_id = '".$employee_id."'
								  AND attendance_date BETWEEN '".$payroll_date."' AND '".$payroll_upto."'
								  AND attendance_deleted_status = 0"; 
								  
		$result_fine_amt = mysql_query($select_fine_amt);	
		$record_fine_amt = mysql_fetch_array($result_fine_amt);
		$fine_amount = $record_fine_amt['fine_amount'];	
		
		/*if($branch_id <> 1) {
			$select_fine_amt = "SELECT SUM(attendance_fine_tot_amount) as fine_amount FROM  attendance
									  WHERE attendance_employee_id = '".$employee_id."'
									  AND attendance_date BETWEEN '".$payroll_date."' AND '".$payroll_upto."'
									  AND attendance_deleted_status = 0"; 
			$result_fine_amt = mysql_query($select_fine_amt);	
			$record_fine_amt = mysql_fetch_array($result_fine_amt);
			$fine_amount = $record_fine_amt['fine_amount'];	
		} else {
			$select_fine_amt = "SELECT SUM(attendance_fine_in_amount) as fine_amount FROM  attendance
									  WHERE attendance_employee_id = '".$employee_id."'
									  AND attendance_date BETWEEN '".$payroll_date."' AND '".$payroll_upto."'
									  AND attendance_deleted_status = 0"; 
			$result_fine_amt = mysql_query($select_fine_amt);	
			$record_fine_amt = mysql_fetch_array($result_fine_amt);
			$fine_amount = $record_fine_amt['fine_amount'];			
		}	*/	
		if($month == '11' && $year=2016) {
			$fine_amount = 0;
		}
		if($branch_id == 21){
			if($month == '4' && $year=2017) {
				$fine_amount = 0;
			}		
		}
		if($branch_id == 20){
			if($month == '8' && $year=2017) {
				$fine_amount = 0;
			}		
		}
		
		echo '<br/>';
		$total_deduction  =  $employee_pf + $employee_esi  + $salary_advance_amount + $tds_amount + $other_deduction_amount + $general_deduction_amount + $pt_amount + $cug_deduction_amount + $cashcard_amount + $fine_amount + $uniform_amount + $id_card_amount + $lwf_amount; 				
			
		$deductions_salary = array();	
		$deductions_salary['employee_pf_per'] 		= $payroll_setting_employee_pf;
		$deductions_salary['employee_pf'] 			= $employee_pf;
		$deductions_salary['employer_pf_per'] 		= $payroll_setting_employer_pf;
		$deductions_salary['employer_pf'] 			= $employer_pf;
		$deductions_salary['fpf'] 					= $fpf;
		$deductions_salary['employee_esi_per'] 		= $employee_esi_per;
		$deductions_salary['employee_esi'] 			= $employee_esi;
		$deductions_salary['employer_esi_per'] 		= $employer_esi_per;
		$deductions_salary['employer_esi'] 			= $employer_esi;	
		$deductions_salary['tds_amount'] 			= $tds_amount;	
		$deductions_salary['pt_amount'] 			= $pt_amount;	
		$deductions_salary['salary_advance'] 		= $salary_advance_amount;
		$deductions_salary['other_deduction'] 		= $other_deduction_amount;	
		$deductions_salary['cug_deduction'] 		= $cug_deduction_amount;
		$deductions_salary['cashcard_deduction'] 	= $cashcard_amount;
		$deductions_salary['general_deduction'] 	= $general_deduction_amount;
		$deductions_salary['fine_amount'] 			= $fine_amount;
		$deductions_salary['uniform_amount'] 		= $uniform_amount;
		$deductions_salary['id_card_amount'] 		= $id_card_amount;
		
		$deductions_salary['lwf_amount'] 			= $lwf_amount;
		$deductions_salary['total_deduction'] 		= $total_deduction;
		
		return $deductions_salary;	
			 
}
// for leave entry Detail 
function getDayoftheDate($date)
{
	$date = strtotime($date);
	return date("l", $date);
}
function getFirstSunday($date)
{
	return date('Y-m-d',strtotime($date. 'first sunday'));
}	
function getSecondSunday($date)
{
	return date('Y-m-d',strtotime($date. 'second sunday'));
}	
function getThirdSunday($date)
{
	return date('Y-m-d',strtotime($date. 'third sunday'));
}
function getFouthSunday($date)
{
	return date('Y-m-d',strtotime($date. 'fourth sunday'));
}		
function getday($month, $year, $day, $position)
{
	$str = $position.' '.$day.' of '.$month.' '.$year; 
	return date('Y-m-d',strtotime($str));
//	return strftime("%d/%m/%y", strtotime($str));
}	
// Leave entry status	
function findLeaveStatus($emp_id, $leave_date, $online_connection, $online_db)
{
	// date format should be yyyy-mm-dd
	$attendance_status = '';
    $select_employee_leave = "SELECT leave_entry_detail_status  FROM $online_db.leave_entry_detail 
								LEFT JOIN $online_db.employees on employee_id = leave_entry_detail_employee_id 
								   WHERE leave_entry_detail_employee_id = '".$emp_id."'
								   AND leave_entry_detail_date = '".$leave_date."'
								   AND leave_entry_detail_status IN ('leave', 'half', 'spl_leave', 'spl_half', 'casual', 'weekoff-half')
								   AND leave_entry_detail_deleted_status = 0
								   AND leave_entry_detail_date >= employee_doj "; 
								   
/*    $select_employee_leave = "SELECT leave_entry_detail_status  FROM $online_db.leave_entry_detail 
 								LEFT JOIN $online_db.leave_entry on leave_entry_id = leave_entry_detail_leave_entry_id 
								LEFT JOIN $online_db.employees on employee_id = leave_entry_detail_employee_id 
								   WHERE leave_entry_detail_employee_id = '".$emp_id."'
								   AND leave_entry_detail_date = '".$leave_date."'
								   AND leave_entry_detail_status IN ('leave', 'half', 'spl_leave', 'spl_half', 'casual', 'weekoff-half')
								   AND leave_entry_detail_deleted_status = 0
									AND leave_entry_deleted_status =0
								   AND leave_entry_detail_date >= employee_doj "; */
								   								   
	$result_employee_leave = mysql_query($select_employee_leave, $online_connection);
	$row_employee_leave    = @mysql_num_rows($result_employee_leave); 
	if($row_employee_leave > 0) {
		$record_employee_leave = mysql_fetch_array($result_employee_leave);
		$attendance_status = $record_employee_leave['leave_entry_detail_status'];
	} else {
		$attendance_status = '';
	}	
	return $attendance_status; 			
	
}	
// Week Off status	
function findWeekOffStatus($emp_id, $leave_date, $online_connection, $online_db)
{
	// date format should be yyyy-mm-dd
	$attendance_status = '';
	
	 $select_weekoff = "SELECT weekoff_id FROM $online_db.weekoff 
						WHERE weekoff_employee_id  = '".$emp_id."' 
						AND weekoff_date  =  '".$leave_date."' 
						AND weekoff_deleted_status =0";
	$result_weekoff = mysql_query($select_weekoff, $online_connection);
	$count_weekoff  = mysql_num_rows($result_weekoff);
	if($count_weekoff > 0) {
		$attendance_status = 'weekoff-entry'; //force to weekoff entry
	} else {
		$select_employee_weekoff = "SELECT employee_week_off_detail_type, employee_week_off_detail_type_detail  FROM $online_db.employee_week_off_details 
									   WHERE if(employee_week_off_detail_to_date = '0000-00-00', employee_week_off_detail_from_date <= '".$leave_date."',
													 employee_week_off_detail_from_date <='".$leave_date."' 
													 and employee_week_off_detail_to_date >= '".$leave_date."' )
									   AND employee_week_off_detail_employee_id = '".$emp_id."' 
									   AND employee_week_off_detail_deleted_status = 0"; 
		$result_employee_weekoff = mysql_query($select_employee_weekoff, $online_connection);
		$row_employee_weekoff    = @mysql_num_rows($result_employee_weekoff);
		if($row_employee_weekoff > 0) {
			$record_employee_weekoff = mysql_fetch_array($result_employee_weekoff);
			$employee_week_off_type = $record_employee_weekoff['employee_week_off_detail_type'];
			$employee_week_off_detail_type_detail = $record_employee_weekoff['employee_week_off_detail_type_detail'];
			$week_off_type = explode(',',$employee_week_off_detail_type_detail);
			$count = sizeof($week_off_type);
	
			if($employee_week_off_type != 'no week off'){
				if($week_off_type[0] == 'all'){
					if (getDayoftheDate($leave_date) == ucwords($employee_week_off_type)) {
						$attendance_status = 'weekoff';
					} else {
						$attendance_status = '';
					}	
					
				} else {
					for($i=0; $i<$count; $i++){
						if($week_off_type[$i] == '1'){
							$first_day = getday(date("M", strtotime($leave_date)), date("Y", strtotime($leave_date)), date("l", strtotime($leave_date)), 'first');
							if($first_day == $leave_date) {
								if (getDayoftheDate($leave_date) == ucwords($employee_week_off_type)) {
									$attendance_status = 'weekoff';
								} else {
									$attendance_status = '';
								}					
							}					
						}
						if($week_off_type[$i] == '2'){
							$second_day = getday(date("M", strtotime($leave_date)), date("Y", strtotime($leave_date)), date("l", strtotime($leave_date)), 'second');
							if($second_day == $leave_date) {
								if (getDayoftheDate($leave_date) == ucwords($employee_week_off_type)) {
									$attendance_status = 'weekoff';
								} else {
									$attendance_status = '';
								}					
							}					
						}
						if($week_off_type[$i] == '3'){
							$third_day = getday(date("M", strtotime($leave_date)), date("Y", strtotime($leave_date)), date("l", strtotime($leave_date)), 'third');
							if($third_day == $leave_date) {
							
								if (getDayoftheDate($leave_date) == ucwords($employee_week_off_type)) {
									$attendance_status = 'weekoff';
								} else {
									$attendance_status = '';
								}
													
							}					
						} 
						if($week_off_type[$i] == '4'){
							$forth_day = getday(date("M", strtotime($leave_date)), date("Y", strtotime($leave_date)), date("l", strtotime($leave_date)), 'fourth');
							if($forth_day == $leave_date) {
								if (getDayoftheDate($leave_date) == ucwords($employee_week_off_type)) {
									$attendance_status = 'weekoff';
								} else {
									$attendance_status = '';
								}					
							}					
						}
						if($week_off_type[$i] == '5'){
							$fifth_day = getday(date("M", strtotime($leave_date)), date("Y", strtotime($leave_date)), date("l", strtotime($leave_date)), 'fifth');
							if($fifth_day == $leave_date) {
								if (getDayoftheDate($leave_date) == ucwords($employee_week_off_type)) {
									$attendance_status = 'weekoff';
								} else {
									$attendance_status = '';
								}					
							}					
						}
					} //for loop end
				}
			}
	/*		if($employee_week_off_type == '2nd & 4th sunday'){
				$second_sunday = getSecondSunday($leave_date);
				if($second_sunday == $leave_date) {
					if (getDayoftheDate($second_sunday) == 'Sunday') {
						$attendance_status = 'weekoff';
					}						
				}
				$fourth_sunday = getFouthSunday($leave_date);
				if($fourth_sunday == $leave_date) { 
					if (getDayoftheDate($fourth_sunday) == 'Sunday') {
						$attendance_status = 'weekoff';
					}						
				}
			} else if (getDayoftheDate($leave_date) == ucwords($employee_week_off_type)) {
				$attendance_status = 'weekoff';
			}*/
			
			if($attendance_status == 'weekoff') {
				$from_date  =  date("Y-m-d",strtotime($leave_date."-1 days")); 
				$to_date    =  date("Y-m-d",strtotime($leave_date."-1 days")); 
				$paid_days1  = weekoffEligibleDays($from_date, $emp_id, $to_date, $online_connection, $online_db); 
				
				$from_date 	=  date("Y-m-d",strtotime($leave_date."+1 days")); 
				$to_date 	=  date("Y-m-d",strtotime($leave_date."+1 days")); 
				
				$paid_days2  = weekoffEligibleDays($from_date, $emp_id, $to_date, $online_connection, $online_db); 
				
				
			    $tot_days =	$paid_days1 + $paid_days2;
				if($tot_days >= 0) {
					if((float)$tot_days >= 0.5) {
						$attendance_status = 'weekoff';
					} else {
						$attendance_status = '';	
					}
				}
				
			}
			
			if($attendance_status == 'weekoff') {
				$from_date  =  date("Y-m-d",strtotime($leave_date."-6 days")); 
				$to_date 	=  date("Y-m-d",strtotime($leave_date."-1 days")); 
				$paid_days  = weekoffEligibleDays($from_date, $emp_id, $to_date, $online_connection, $online_db); 
				if($paid_days >= 0) {
					if((float)$paid_days >= 3) {
						$attendance_status = 'weekoff';
					} else {
						$attendance_status = 'weekoff-leave';	
					}
				}
				
			}
			
		}	
	}
	
	
	return $attendance_status; 			
	
}	
function findDoublePayStatus($emp_id, $trans_date, $online_connection, $online_db)
{
	// date format should be yyyy-mm-dd
	$attendance_status = '';
    $select_employee_pay = "SELECT count(double_pay_id) AS cnt  FROM $online_db.double_pay 
								   WHERE double_pay_employee_id = '".$emp_id."'
								   AND double_pay_date = '".$trans_date."'
								   AND double_pay_deleted_status = 0 ";  
	$result_employee_pay = mysql_query($select_employee_pay, $online_connection);
	$row_employee_pay    = @mysql_fetch_array($result_employee_pay); 
	if($row_employee_pay['cnt'] > 0) {
		$attendance_status = 'double_pay';
	} else {
		$attendance_status = '';
	}	
	return $attendance_status; 			
	
}
	
// get employee name from given employee uniq_id	
function getEmployeeName($uniq_id)
{
	$select_employee_id = "SELECT employee_name FROM employees WHERE employee_uniq_id = '".$uniq_id."'";
	$result_employee_id = mysql_query($select_employee_id);
	$record_employee_id = mysql_fetch_array($result_employee_id);
	return ucwords($record_employee_id['employee_name']);
}
// get employee no from given employee uniq_id
function getEmployeeNo($uniq_id)
{
	$select_employee_id = "SELECT employee_no FROM employees WHERE employee_uniq_id = '".$uniq_id."'";
	$result_employee_id = mysql_query($select_employee_id);
	$record_employee_id = mysql_fetch_array($result_employee_id);
	return $record_employee_id['employee_no'];
}
// Leave entry status	
function countLOP($attendance_status)
{
	$lop_day = 0;
	if($attendance_status == 'present') {
		$lop_day = 0;
	} else if($attendance_status == 'double_pay') {
		$lop_day = 0;
	} else if($attendance_status == 'absent') {
		$lop_day = 1;
	} else if($attendance_status == 'leave') {
		$lop_day = 1;
	} else if($attendance_status == 'half') {
		$lop_day = 0.5;
	} else if($attendance_status == 'weekoff') {
		$lop_day = 0;
	} else if($attendance_status == 'weekoff-present') {
		$lop_day = 0;
	} else if($attendance_status == 'weekoff-half') {
		$lop_day = 0;
	} else if($attendance_status == 'working') {
		$lop_day = 1;
	} else if($attendance_status == 'spl_leave') {
		$lop_day = 1;
	} else if($attendance_status == 'spl_half') {
		$lop_day = 0.5;
	} else if($attendance_status == 'compoff') {
		$lop_day = 0;
	}		
	return $lop_day;
}	
function updateAttendanceStatus($month, $year, $employee_id, $employee_device_id, $branch_id, $field_name, $status, $connection, $db)
{	 
							
	$month = intval($month);
	$year  = intval($year);
	$select_attendance_status = "SELECT attendance_status_id FROM $db.attendance_status 
								WHERE attendance_status_employee_id = '".$employee_id."'
								AND attendance_status_month = '".$month."'
								AND attendance_status_year = '".$year."' "; 
	$result_attendance_status = mysql_query($select_attendance_status, $connection);
	$row_attendance_status    = @mysql_num_rows($result_attendance_status); 
	if($row_attendance_status > 0){
			$record_attendance_status = mysql_fetch_array($result_attendance_status);
			$attendance_status_id = $record_attendance_status['attendance_status_id'];
		
			$update_attendance_status = "UPDATE $db.attendance_status  SET $field_name = '".$status."' 
													WHERE attendance_status_id = '".$attendance_status_id."' ";
			mysql_query($update_attendance_status, $connection);
			historyAction($employee_id, $employee_device_id, 'update', 'attendance_status', $attendance_status_id, 0, str_replace("'","",$update_attendance_status), $connection, $db);														
	} else {
			$uniq_id  = generateUniqId();	
		     $insert_attendance_status = sprintf("INSERT INTO $db.attendance_status (attendance_status_uniq_id,
			  																	attendance_status_device_emp_id, 
																				attendance_status_employee_id,
																				attendance_status_month,
																				attendance_status_year,
																				attendance_status_branch_id,
																				$field_name) 
																		VALUES  ('%s', '%d', '%d', '%d', '%d', '%d','%s')",
																				$uniq_id,
																				$employee_device_id, 
																				$employee_id, 
																				$month,
																				$year,
																				$branch_id, 
																				$status); 
			mysql_query($insert_attendance_status, $connection);	
			$attendance_status_id = mysql_insert_id();
			historyAction($employee_id, $employee_device_id, 'insert', 'attendance_status', $attendance_status_id, 0, str_replace("'","",$insert_attendance_status), $connection, $db);	
	}
	
}
function getAttendanceStatus($month, $year, $employee_id, $connection, $db)
{
		$myarr    = array();
  		$select_attendance_status = "SELECT attendance_status_01, attendance_status_02, attendance_status_03, attendance_status_04, attendance_status_05, 
											attendance_status_06, attendance_status_07, attendance_status_08, attendance_status_09, attendance_status_10, 	
											attendance_status_11, attendance_status_12, attendance_status_13, attendance_status_14, attendance_status_15, 	
											attendance_status_16, attendance_status_17, attendance_status_18, attendance_status_19, attendance_status_20, 
											attendance_status_21, attendance_status_22, attendance_status_23, attendance_status_24, attendance_status_25, 
											attendance_status_26, attendance_status_27, attendance_status_28, attendance_status_29,	attendance_status_30, 
											attendance_status_31 FROM   $db.attendance_status 
										WHERE attendance_status_employee_id = '".$employee_id."'
										AND  attendance_status_month = '".$month."' AND attendance_status_year = '".$year."' ";
		$result_attendance_status = mysql_query($select_attendance_status, $connection);
		$row_attendance_status    = mysql_num_rows($result_attendance_status); 
		if($row_attendance_status > 0){
			$record_attendance_status = mysql_fetch_array($result_attendance_status);
			$myarr=array($record_attendance_status['attendance_status_01'], $record_attendance_status['attendance_status_02'], 
						 $record_attendance_status['attendance_status_03'], $record_attendance_status['attendance_status_04'], 
						 $record_attendance_status['attendance_status_05'], $record_attendance_status['attendance_status_06'], 
						 $record_attendance_status['attendance_status_07'], $record_attendance_status['attendance_status_08'], 
						 $record_attendance_status['attendance_status_09'], $record_attendance_status['attendance_status_10'], 
						 $record_attendance_status['attendance_status_11'], $record_attendance_status['attendance_status_12'], 
						 $record_attendance_status['attendance_status_13'], $record_attendance_status['attendance_status_14'], 
						 $record_attendance_status['attendance_status_15'], $record_attendance_status['attendance_status_16'], 
						 $record_attendance_status['attendance_status_17'], $record_attendance_status['attendance_status_18'], 
						 $record_attendance_status['attendance_status_19'], $record_attendance_status['attendance_status_20'], 
						 $record_attendance_status['attendance_status_21'], $record_attendance_status['attendance_status_22'], 
						 $record_attendance_status['attendance_status_23'], $record_attendance_status['attendance_status_24'], 
						 $record_attendance_status['attendance_status_25'], $record_attendance_status['attendance_status_26'], 
						 $record_attendance_status['attendance_status_27'], $record_attendance_status['attendance_status_28'], 
						 $record_attendance_status['attendance_status_29'], $record_attendance_status['attendance_status_30'], 
						 $record_attendance_status['attendance_status_31']);	
						
			return 	$myarr;
			
		} 	
}
function getAttendanceStatusShort($a_status) 
{
	$a_val = '';
	if($a_status =='absent') {
		$a_val ="A";
	} else if($a_status =='half') {
		$a_val ="H";
	} else if ($a_status =='leave') {
		$a_val ="L";
	} else if($a_status =='present') {
		$a_val ="P";
	} else if($a_status =='double_pay') {
		$a_val ="D/P";
	} else if($a_status =='weekoff') {
		$a_val ="W/O";
	} else if($a_status =='weekoff-present') {
		$a_val ="W/P";
	} else if($a_status =='weekoff-working') {
		$a_val ="W/W";
	} else if($a_status =='weekoff-half') {
		$a_val ="W/H";
	} else if($a_status =='working') {
		$a_val ="W";
	} else if($a_status =='relieved') {
		$a_val ="R";
	} else if($a_status =='spl_leave') {
		$a_val ="S/L";
	} else if($a_status =='spl_half') {
		$a_val ="S/H";
	} else if ($a_status =='casual') {
		$a_val ="CL";
	} else if ($a_status =='compoff') {
		$a_val ="C/O";
	} else {
		$a_val = "-";
	}
	
	return $a_val;
}

function getAttendanceStatusName($a_status) 
{
	$a_val = '';
	if($a_status =='absent') {
		$a_val ="Absent";
	} else if($a_status =='half') {
		$a_val ="Half";
	} else if ($a_status =='leave') {
		$a_val ="Leave";
	} else if($a_status =='present') {
		$a_val ="Present";
	} else if($a_status =='double_pay') {
		$a_val ="Double Pay";
	} else if($a_status =='weekoff') {
		$a_val ="Weekoff";
	} else if($a_status =='weekoff-present') {
		$a_val ="Weekoff Present";
	} else if($a_status =='weekoff-working') {
		$a_val ="Weekoff Working";
	} else if($a_status =='weekoff-half') {
		$a_val ="Weekoff Half";
	} else if($a_status =='working') {
		$a_val ="Working";
	} else if($a_status =='relieved') {
		$a_val ="Relieved";
	} else if($a_status =='spl_leave') {
		$a_val ="Special Leave";
	} else if($a_status =='spl_half') {
		$a_val ="Special Half";
	} else if ($a_status =='casual') {
		$a_val ="Casual";
	} else if ($a_status =='compoff') {
		$a_val ="Compoff";
	} else {
		$a_val = "-";
	}
	
	return $a_val;
}
	
	
	
function countAttendanceDays($month, $year, $employee_id, $to_date){
		
		$myarr    = array();
		$from_date = $year.'-'.$month.'-01'; 
  		 $select_attendance_days = "SELECT COUNT(if(attendance_status= 'present', attendance_status, NULL)) AS present,
											COUNT(if(attendance_status= 'leave', attendance_status, NULL)) AS leave_days,
											COUNT(if(attendance_status= 'absent', attendance_status, NULL)) AS absent,
											COUNT(if(attendance_status= 'half', attendance_status, NULL)) AS half,
											COUNT(if(attendance_status= 'weekoff', attendance_status, NULL)) AS weekoff,
											COUNT(if(attendance_status= 'weekoff-half', attendance_status, NULL)) AS weekoffhalf,
											COUNT(if(attendance_status= 'weekoff-present', attendance_status, NULL)) AS weekoffpresent,
											COUNT(if(attendance_status= 'weekoff-working', attendance_status, NULL)) AS weekoffworking,
											COUNT(if(attendance_status= 'working', attendance_status, NULL)) AS working,
											COUNT(if(attendance_status= 'spl_leave', attendance_status, NULL)) AS spl_leave_days,
											COUNT(if(attendance_status= 'spl_half', attendance_status, NULL)) AS spl_half,
											COUNT(if(attendance_status= 'casual', attendance_status, NULL)) AS casual,
											COUNT(if(attendance_status= 'double_pay', attendance_status, NULL)) AS double_pay,
											COUNT(if(attendance_status= 'compoff', attendance_status, NULL)) AS compoff,
											COUNT(if(attendance_status= 'relieved', attendance_status, NULL)) AS relieved
									FROM attendance
									WHERE attendance_employee_id ='".$employee_id."'
									AND attendance_date BETWEEN '".$from_date."' AND '".$to_date."'
									AND attendance_deleted_status = 0"; 
		$result_attendance_days = mysql_query($select_attendance_days);
		$row_attendance_days    = mysql_num_rows($result_attendance_days); 
		if($row_attendance_days > 0){
			$record_attendance_days = mysql_fetch_array($result_attendance_days);
			$myarr['present'] 			= $record_attendance_days['present'];
			$myarr['leave_days'] 		= $record_attendance_days['leave_days'];
			$myarr['absent'] 			= $record_attendance_days['absent'];
			$myarr['half'] 				= $record_attendance_days['half'];
			$myarr['weekoff'] 			= $record_attendance_days['weekoff'];
			$myarr['weekoffhalf'] 		= $record_attendance_days['weekoffhalf'];	
			$myarr['weekoffpresent']	= $record_attendance_days['weekoffpresent'];
			$myarr['weekoffworking']	= $record_attendance_days['weekoffworking'];
			$myarr['working'] 			= $record_attendance_days['working'];
			$myarr['spl_leave_days'] 	= $record_attendance_days['spl_leave_days'];
			$myarr['spl_half'] 			= $record_attendance_days['spl_half'];
			$myarr['relieved'] 			= $record_attendance_days['relieved'];
			$myarr['double_pay'] 		= $record_attendance_days['double_pay'];
			$myarr['casual'] 			= $record_attendance_days['casual'];
			$myarr['compoff'] 			= $record_attendance_days['compoff'];
	
			return 	$myarr;
		}
		 	
}	
function countPaidDays($from_date, $employee_id, $to_date, $con, $db){
  		$select_attendance_days = "SELECT COUNT(if(attendance_status= 'present', attendance_status, NULL)) AS present,
											COUNT(if(attendance_status= 'leave', attendance_status, NULL)) AS leave_days,
											COUNT(if(attendance_status= 'absent', attendance_status, NULL)) AS absent,
											COUNT(if(attendance_status= 'half', attendance_status, NULL)) AS half,
											COUNT(if(attendance_status= 'weekoff', attendance_status, NULL)) AS weekoff,
											COUNT(if(attendance_status= 'weekoff-half', attendance_status, NULL)) AS weekoffhalf,
											COUNT(if(attendance_status= 'weekoff-present', attendance_status, NULL)) AS weekoffpresent,
											COUNT(if(attendance_status= 'weekoff-working', attendance_status, NULL)) AS weekoffworking,
											COUNT(if(attendance_status= 'working', attendance_status, NULL)) AS working,
											COUNT(if(attendance_status= 'spl_leave', attendance_status, NULL)) AS spl_leave_days,
											COUNT(if(attendance_status= 'spl_half', attendance_status, NULL)) AS spl_half,
											COUNT(if(attendance_status= 'casual', attendance_status, NULL)) AS casual,
											COUNT(if(attendance_status= 'double_pay', attendance_status, NULL)) AS double_pay,
											COUNT(if(attendance_status= 'relieved', attendance_status, NULL)) AS relieved
									FROM $db.attendance
									WHERE attendance_employee_id ='".$employee_id."'
									AND attendance_date BETWEEN '".$from_date."' AND '".$to_date."'
									AND attendance_deleted_status = 0";
		$result_attendance_days = mysql_query($select_attendance_days,$con);
		$row_attendance_days    = mysql_num_rows($result_attendance_days); 
		if($row_attendance_days > 0){
			$record_attendance_days = mysql_fetch_array($result_attendance_days);
				if ($record_attendance_days['half'] > 0) {
					 $half_days 		= $record_attendance_days['half'] / 2;
				 } else {
					 $half_days 		= 0;					 
				 }	 
		 
				 if ($record_attendance_days['weekoffhalf'] > 0) {
					 $weekoffhalf_days 	= $record_attendance_days['weekoffhalf'] / 2;
				 } else {
					 $weekoffhalf_days 	= 0;					 
				 }
				 if ($record_attendance_days['spl_half'] > 0) {
					 $splhalf_days 	= $record_attendance_days['spl_half'] / 2;
				 } else {
					 $splhalf_days 	= 0;					 
				 }
		 
				 $weekoffworking_days 	= $record_attendance_days['weekoffworking'] ;		 
				 $present_days 			= $record_attendance_days['present'] + $record_attendance_days['weekoffpresent'] + $weekoffhalf_days + $record_attendance_days['working'] + $record_attendance_days['double_pay'] + $record_attendance_days['casual'] + $weekoffworking_days;		
				 $leave_days 			= $record_attendance_days['leave_days'];
				 $absent_days 			= $record_attendance_days['absent'] ;
				 $weekoff_days 			= $record_attendance_days['weekoff'] ;
				 $special_leave_days 	= $record_attendance_days['spl_leave_days'] + $splhalf_days ;					 
				 $weekoffpresent_days 	= $record_attendance_days['weekoffpresent'] + $weekoffhalf_days + $record_attendance_days['double_pay'] +  $weekoffworking_days;
				 $working_days 			= $record_attendance_days['working'] ;
				 $relieved_days 		= $record_attendance_days['relieved'] ;
				 $total_lop_days 		= $leave_days + $half_days + $absent_days + $absent_days + $special_leave_days + $special_leave_days;
				 $total_paid_days 		= $present_days + $half_days + $weekoff_days + $weekoffpresent_days + $weekoffhalf_days;
				 return $total_paid_days ;			
		 } else {
		 	return 0 ;
		 }	
		 
}	
function weekoffEligibleDays($from_date, $employee_id, $to_date, $con, $db){
  		$select_attendance_days = "SELECT COUNT(if(attendance_status= 'present', attendance_status, NULL)) AS present,
											COUNT(if(attendance_status= 'leave', attendance_status, NULL)) AS leave_days,
											COUNT(if(attendance_status= 'absent', attendance_status, NULL)) AS absent,
											COUNT(if(attendance_status= 'half', attendance_status, NULL)) AS half,
											COUNT(if(attendance_status= 'weekoff', attendance_status, NULL)) AS weekoff,
											COUNT(if(attendance_status= 'weekoff-half', attendance_status, NULL)) AS weekoffhalf,
											COUNT(if(attendance_status= 'weekoff-present', attendance_status, NULL)) AS weekoffpresent,
											COUNT(if(attendance_status= 'weekoff-working', attendance_status, NULL)) AS weekoffworking,
											COUNT(if(attendance_status= 'working', attendance_status, NULL)) AS working,
											COUNT(if(attendance_status= 'spl_leave', attendance_status, NULL)) AS spl_leave_days,
											COUNT(if(attendance_status= 'spl_half', attendance_status, NULL)) AS spl_half,
											COUNT(if(attendance_status= 'casual', attendance_status, NULL)) AS casual,
											COUNT(if(attendance_status= 'double_pay', attendance_status, NULL)) AS double_pay,
											COUNT(if(attendance_status= 'relieved', attendance_status, NULL)) AS relieved,
											COUNT(if(attendance_status= 'compoff', attendance_status, NULL)) AS compoff
									FROM $db.attendance
									WHERE attendance_employee_id ='".$employee_id."'
									AND attendance_date BETWEEN '".$from_date."' AND '".$to_date."'
									AND attendance_deleted_status = 0";
		$result_attendance_days = mysql_query($select_attendance_days,$con);
		$row_attendance_days    = mysql_num_rows($result_attendance_days); 
		if($row_attendance_days > 0){
			$record_attendance_days = mysql_fetch_array($result_attendance_days);
				if ($record_attendance_days['half'] > 0) {
					 $half_days 		= $record_attendance_days['half'] / 2;
				 } else {
					 $half_days 		= 0;					 
				 }	 
		 
				 if ($record_attendance_days['weekoffhalf'] > 0) {
					 $weekoffhalf_days 	= $record_attendance_days['weekoffhalf'] / 2;
				 } else {
					 $weekoffhalf_days 	= 0;					 
				 }
				 if ($record_attendance_days['spl_half'] > 0) {
					 $splhalf_days 	= $record_attendance_days['spl_half'] / 2;
				 } else {
					 $splhalf_days 	= 0;					 
				 }
		 
				 $weekoffworking_days 	= $record_attendance_days['weekoffworking'] ;		 
				 $present_days 			= $record_attendance_days['present'] + $record_attendance_days['weekoffpresent'] + $weekoffhalf_days + $record_attendance_days['working'] + $record_attendance_days['double_pay'] + $record_attendance_days['casual'] + $weekoffworking_days;		
				 $leave_days 			= $record_attendance_days['leave_days'];
				 $absent_days 			= $record_attendance_days['absent'] ;
				 $weekoff_days 			= $record_attendance_days['weekoff'] ;
				 $special_leave_days 	= $record_attendance_days['spl_leave_days'] + $splhalf_days ;					 
				 $weekoffpresent_days 	= $record_attendance_days['weekoffpresent'] + $weekoffhalf_days + $record_attendance_days['double_pay'] +  $weekoffworking_days;
				 $working_days 			= $record_attendance_days['working'] ;
				 $relieved_days 		= $record_attendance_days['relieved'] ; 
				 $compoff 				= $record_attendance_days['compoff'] ;
				 $total_lop_days 		= $leave_days + $half_days + $absent_days + $absent_days + $special_leave_days;
				 $total_paid_days 		= $present_days + $half_days + $weekoff_days + $weekoffpresent_days + $weekoffhalf_days + $splhalf_days+$compoff;
				 
				 return $total_paid_days ;			
		 } else {
		 	return 0 ;
		 }	
		 
}


function countAttendanceStatusTotal($date, $branch_id){
		
		$myarr    = array();
		
  		 $select_attendance_days = "SELECT attendance_status, COUNT(*) AS cnt
									FROM attendance
									WHERE attendance_branch_id ='".$branch_id."'
									AND attendance_date = '".$date."' 
									AND attendance_deleted_status = 0
									GROUP BY attendance_status 
									ORDER BY attendance_status ASC"; 
		$result_attendance_days = mysql_query($select_attendance_days);
		while($record_attendance_days = mysql_fetch_array($result_attendance_days)){
			$myarr[] = $record_attendance_days;
		}
		return 	$myarr;
		
}	


	function createDateRangeArray($strDateFrom,$strDateTo) {
		  // takes two dates formatted as YYYY-MM-DD and creates an
		  // inclusive array of the dates between the from and to dates.
		
		  // could test validity of dates here but I'm already doing
		  // that in the main script
		
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
	
	
function weekdaysCount($month, $year, $emp_id) {
	
	$select_employee_weekoff = "SELECT employee_week_off_detail_type, employee_week_off_detail_from_date, 
										employee_week_off_detail_to_date, employee_week_off_detail_type_detail  FROM employee_week_off_details 
								   WHERE MONTH(employee_week_off_detail_from_date) ='".$month."' 
								   AND YEAR(employee_week_off_detail_from_date) ='".$year."'
								   AND employee_week_off_detail_employee_id = '".$emp_id."' 
								   AND employee_week_off_detail_deleted_status = 0"; 
	$result_employee_weekoff = mysql_query($select_employee_weekoff);
	$row_employee_weekoff    = mysql_num_rows($result_employee_weekoff);
	if($row_employee_weekoff > 0) {
		$record_employee_weekoff = mysql_fetch_array($result_employee_weekoff);	
		if($record_employee_weekoff['employee_week_off_detail_type'] == 'no week off') {
			return 0;
		} else {
			$tot = 0;
			$arr = createDateRangeArray($record_employee_weekoff['employee_week_off_detail_from_date'],$record_employee_weekoff['employee_week_off_detail_to_date']);
			for($i=0; $i<count($arr); $i++){
				if(ucfirst($record_employee_weekoff['employee_week_off_detail_type']) == getDayoftheDate($arr[$i]) ) {
					$tot++;
				}	
			}
			return $tot;	
		}
	} else {
		return 0;
	}
}
function getWorkingHour($trans_date, $emp_id){
	
	$select = "SELECT employee_working_hour_detail_weekday_working_hour_id, employee_working_hour_detail_weekend_working_hour_id,
				wd.working_hour_from AS wd_working_hour_from, wd.working_hour_to AS wd_working_hour_to, 
				we.working_hour_from AS we_working_hour_from, we.working_hour_to AS we_working_hour_to
				FROM employee_working_hour_details 
				LEFT JOIN working_hours AS wd ON wd.working_hour_id = employee_working_hour_detail_weekday_working_hour_id
				LEFT JOIN working_hours AS we ON we.working_hour_id = employee_working_hour_detail_weekend_working_hour_id
				WHERE if(employee_working_hour_detail_to_date = '0000-00-00', employee_working_hour_detail_from_date <= '".$trans_date."',
												 employee_working_hour_detail_from_date <='".$trans_date."' 
												 and employee_working_hour_detail_to_date >= '".$trans_date."' )
								   AND employee_working_hour_detail_employee_id = '".$emp_id."' 
								   AND employee_working_hour_detail_deleted_status = 0"; 
	$result = mysql_query($select);
	$record = mysql_fetch_array($result);
	if(empty($record['wd_working_hour_from'])) {
		$from = 'N/A';
	} else {
		$from = date('H:i', strtotime($record['wd_working_hour_from']));
	}
	
	if(empty($record['wd_working_hour_to'])) {
		$to = 'N/A';
	} else {
		$to = date('H:i', strtotime($record['wd_working_hour_to']));
	}
		
	return $from.'-'.$to;
}
function LateComing($trans_date, $emp_id, $in_time, $connection, $db){
	
	$weekdays_array = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
	$weekend_array = array("Sunday", "Saturday");	
	$day = getDayoftheDate($trans_date);
	$select = "SELECT employee_working_hour_detail_weekday_working_hour_id, employee_working_hour_detail_weekend_working_hour_id,
				wd.working_hour_from AS wd_working_hour_from, wd.working_hour_to AS wd_working_hour_to, 
				we.working_hour_from AS we_working_hour_from, we.working_hour_to AS we_working_hour_to
				FROM $db.employee_working_hour_details 
				LEFT JOIN $db.working_hours AS wd ON wd.working_hour_id = employee_working_hour_detail_weekday_working_hour_id
				LEFT JOIN $db.working_hours AS we ON we.working_hour_id = employee_working_hour_detail_weekend_working_hour_id
				WHERE if(employee_working_hour_detail_to_date = '0000-00-00', employee_working_hour_detail_from_date <= '".$trans_date."',
												 employee_working_hour_detail_from_date <='".$trans_date."' 
												 and employee_working_hour_detail_to_date >= '".$trans_date."' )
								   AND employee_working_hour_detail_employee_id = '".$emp_id."' 
								   AND employee_working_hour_detail_deleted_status = 0"; 
	$result = mysql_query($select,$connection);
	$record = mysql_fetch_array($result);
	
	$in_time = date('H:i', strtotime($in_time));
	
	
	if (in_array($day, $weekdays_array)) {
		
		if($in_time != '00:00:00') {
			if(!empty($record['wd_working_hour_from'])){ 
				$late_min = round(strtotime($record['wd_working_hour_from']) - strtotime($in_time)) /60;
			} else {
				$late_min =0;
			}	
		} else {
			$late_min =0;
		}
			
		if($late_min < 0) {
			return array($record['wd_working_hour_from'], round($late_min * -1), $record['employee_working_hour_detail_weekday_working_hour_id']);
		} else {
			return array($record['wd_working_hour_from'], 0, $record['employee_working_hour_detail_weekday_working_hour_id']);
		}		
	} else {
	
		if($in_time != '00:00:00') {
			if(!empty($record['we_working_hour_from'])){ 
				$late_min = round(strtotime($record['we_working_hour_from']) - strtotime($in_time)) /60;	
			} else {
				$late_min =0;
			}	
		} else {
			$late_min =0;
		}	
		
		if($late_min < 0) {
			return array($record['we_working_hour_from'], round($late_min * -1), $record['employee_working_hour_detail_weekend_working_hour_id']);
		} else {
			return array($record['we_working_hour_from'], 0, $record['employee_working_hour_detail_weekend_working_hour_id']);
		}		
	} 
}
function EarlyGoing($trans_date, $emp_id, $out_time, $connection, $db){
	
	$weekdays_array = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
	$weekend_array = array("Sunday", "Saturday");	
	$day = getDayoftheDate($trans_date);
	$select = "SELECT employee_working_hour_detail_weekday_working_hour_id, employee_working_hour_detail_weekend_working_hour_id,
				wd.working_hour_from AS wd_working_hour_from, wd.working_hour_to AS wd_working_hour_to, 
				we.working_hour_from AS we_working_hour_from, we.working_hour_to AS we_working_hour_to
				FROM $db.employee_working_hour_details 
				LEFT JOIN $db.working_hours AS wd ON wd.working_hour_id = employee_working_hour_detail_weekday_working_hour_id
				LEFT JOIN $db.working_hours AS we ON we.working_hour_id = employee_working_hour_detail_weekend_working_hour_id
				WHERE if(employee_working_hour_detail_to_date = '0000-00-00', employee_working_hour_detail_from_date <= '".$trans_date."',
												 employee_working_hour_detail_from_date <='".$trans_date."' 
												 and employee_working_hour_detail_to_date >= '".$trans_date."' )
								   AND employee_working_hour_detail_employee_id = '".$emp_id."' 
								   AND employee_working_hour_detail_deleted_status = 0"; 
	$result = mysql_query($select,$connection);
	$record = mysql_fetch_array($result);
	
	if (in_array($day, $weekdays_array)) {
		
		if($out_time != '00:00:00') {
			if(!empty($record['wd_working_hour_to'])){ 
				$late_min = round(strtotime($record['wd_working_hour_to']) - strtotime($out_time)) /60;
			} else {
				$late_min =0;
			}	
		} else {
			$late_min =0;
		}	
		if($late_min > 0) {
			return array($record['wd_working_hour_to'], round($late_min), $record['employee_working_hour_detail_weekday_working_hour_id']);
		} else {
			return array($record['wd_working_hour_to'], 0, $record['employee_working_hour_detail_weekday_working_hour_id']);
		}		
	} else {
		if($out_time != '00:00:00') {
			if(!empty($record['we_working_hour_to'])){ 
				$late_min = round(strtotime($record['we_working_hour_to']) - strtotime($out_time)) /60;	
			} else {
				$late_min =0;
			}	
		} else {
			$late_min =0;
		}	
		
		if($late_min > 0) {
			return array($record['we_working_hour_to'], round($late_min), $record['employee_working_hour_detail_weekend_working_hour_id']);
		} else {
			return array($record['we_working_hour_to'], 0, $record['employee_working_hour_detail_weekend_working_hour_id']);
		}		
	} 
}
function getFineTariffAmt($late_min, $working_hour_id, $connection, $db){
			$select_working_hour = "SELECT working_hour_detail_amount FROM $db.working_hour_details 
								 	WHERE working_hour_detail_working_hour_id = '".$working_hour_id."' 
								 	AND working_hour_detail_deleted_status = 0 
								 	AND working_hour_detail_from <= '".$late_min."' 
								 	AND working_hour_detail_to >= '".$late_min."' "; 
			$result_working_hour = mysql_query($select_working_hour, $connection);		
			$count_working_hour = mysql_num_rows($result_working_hour);
			if($count_working_hour > 0) {
				$record_working_hour = mysql_fetch_array($result_working_hour);
				$fine_amt = $record_working_hour['working_hour_detail_amount'];
				return $fine_amt;
			} else {
				return 0;
			}
}	
function getFineAmt($fine_date, $employee_id, $type){
			$select_fine_amt = "SELECT fine_amount, fine_edit_status, fine_minute, fine_in_amount, fine_out_amount, 
									   fine_in_minute, fine_out_minute FROM fine 
								 WHERE fine_employee_id = '".$employee_id."' 
								 AND fine_deleted_status = 0 
								 AND fine_date = '".$fine_date."' "; 
			$result_fine_amt = mysql_query($select_fine_amt);		
			$record_fine_amt = mysql_fetch_array($result_fine_amt);
			if($type == 'in') {
				$fine_amt = $record_fine_amt['fine_in_amount'];
				$fine_minute = $record_fine_amt['fine_in_minute'];
			}
			if($type == 'out') {
				$fine_amt = $record_fine_amt['fine_out_amount'];
				$fine_minute = $record_fine_amt['fine_out_minute'];
			}			
			return array($record_fine_amt['fine_edit_status'], $fine_amt, $fine_minute);	
}	
function getAttendanceFineAmt($copy_date, $employee_id, $in_time, $out_time, $lop_days, $connection, $db){
	
			//minute
			list($off_in_time, $late_in_min, $working_hour_id) = LateComing($copy_date, $employee_id, $in_time, $connection, $db);
			list($off_out_time, $late_out_min, $out_working_hour_id) = EarlyGoing($copy_date, $employee_id, $out_time, $connection, $db);
			//Status
			$select_fine_amt = "SELECT attendance_fine_in_minute, attendance_fine_out_minute, attendance_fine_in_amount,  
									   attendance_fine_out_amount, attendance_fine_tot_amount, attendance_fine_edit_status,
									   employee_fine_status, attendance_status, attendance_branch_id, employee_branch_detail_branch_id FROM $db.attendance 
								 LEFT JOIN $db.employees ON employee_id = attendance_employee_id	
								 LEFT JOIN $db.employee_branch_details ON employee_branch_detail_employee_id = employee_id   
								 WHERE attendance_employee_id = '".$employee_id."' 
								 AND attendance_deleted_status = 0  AND employee_branch_detail_deleted_status = 0
								 AND attendance_date = '".$copy_date."'
								 AND IF(employee_branch_detail_to_date = '0000-00-00', employee_branch_detail_from_date <= '".$copy_date."',
												 employee_branch_detail_from_date <='".$copy_date."' 
												 and employee_branch_detail_to_date >= '".$copy_date."') "; 
			$result_fine_amt = mysql_query($select_fine_amt, $connection);		
			$count_fine_amt = mysql_num_rows($result_fine_amt);
			if($count_fine_amt > 0) {
				$record_fine_amt = mysql_fetch_array($result_fine_amt);
			
				$select_fine_date = "SELECT fine_date_branch_id  FROM $db.fine_date 
									 WHERE fine_date_branch_id  = '".$record_fine_amt['employee_branch_detail_branch_id']."' 
									 AND fine_date_deleted_status = 0 
									 AND fine_date_date = '".$copy_date."' "; 
				$result_fine_date = mysql_query($select_fine_date, $connection);	
				$count_fine_date = mysql_num_rows($result_fine_date); 
				if($count_fine_date == 0) {				
					$in_fine_amt = $record_fine_amt['attendance_fine_in_amount'];
					$in_fine_minute = $record_fine_amt['attendance_fine_in_minute'];
					$out_fine_amt = $record_fine_amt['attendance_fine_out_amount'];
					$out_fine_minute = $record_fine_amt['attendance_fine_out_minute'];
					$status = $record_fine_amt['attendance_fine_edit_status'];
					$fine_amt =  $in_fine_amt + $out_fine_amt;
					//echo 'test';
					//amount
					
					if($status == 0) {
						if($record_fine_amt['employee_fine_status'] == 1) {
							$in_fine_amt = getFineTariffAmt($late_in_min, $working_hour_id, $connection, $db);
							$out_fine_amt = getFineTariffAmt($late_out_min, $out_working_hour_id, $connection, $db);
						} else {
							$in_fine_amt = 0;
							$out_fine_amt = 0;					
						}
						$fine_amt =  $in_fine_amt + $out_fine_amt;
						$in_fine_minute = $late_in_min;
						$out_fine_minute = $late_out_min;
						
					}
				} else {
					$in_fine_minute = 0;
					$out_fine_minute = 0;			
					$in_fine_amt = 0;
					$out_fine_amt = 0;
					$fine_amt =  0;		
					$status = 0;
				}
				
			} else {
				$select_employee = "SELECT employee_fine_status FROM $db.employees 
									 WHERE attendance_employee_id = '".$employee_id."' 
									 AND employee_deleted_status = 0  "; 
				$result_employee = mysql_query($select_employee, $connection);
				$record_employee = mysql_fetch_array($result_employee);
				if($record_employee['employee_fine_status'] == 1) {		
					$in_fine_amt = getFineTariffAmt($late_in_min, $working_hour_id, $connection, $db);
					$out_fine_amt = getFineTariffAmt($late_out_min, $out_working_hour_id, $connection, $db);
				} else {
					$in_fine_amt = 0;
					$out_fine_amt = 0;					
				}	
				$fine_amt =  $in_fine_amt + $out_fine_amt;	
				$in_fine_minute = $late_in_min;
				$out_fine_minute = $late_out_min;
				$status = 0;
			}
			//echo $count_fine_amt; 
			if($count_fine_amt > 0) {
				$att_status = array("leave", "absent", "weekoff", "spl_leave", "half", "spl_half", "weekoff-half", "compoff");
				if (in_array($record_fine_amt['attendance_status'], $att_status)) {
					$in_fine_minute = 0;
					$out_fine_minute = 0;			
					$in_fine_amt = 0;
					$out_fine_amt = 0;
					$fine_amt =  0;
					$status = 0;
				}
			}
		//	  exit;
			return array($status, $in_fine_minute, $out_fine_minute, $in_fine_amt, $out_fine_amt, $fine_amt);	
}
function dateLock($entry_date){
	
		
	/*$edit_user = "SELECT admin_user_id, admin_user_lock_days, branch_name, admin_user_username FROM admin_users
					LEFT JOIN branches ON branch_id = admin_user_branch_id
					WHERE admin_user_delete_status = 0
					AND admin_user_active_status = 'active'
					AND admin_user_id='".$_SESSION['session_admin_user_id']."'";
	$result_user = mysql_query($edit_user);
	$record_user = mysql_fetch_array($result_user);
	$admin_user_lock_days = $record_user['admin_user_lock_days'];*/
	
	$admin_user_lock_days = $_SESSION['admin_user_lock_days'];
	$admin_user_lock_status = $_SESSION['admin_user_lock_status'];
	
	if($admin_user_lock_status == 1) {
		if($admin_user_lock_days > 0) {
			$lock_days = $admin_user_lock_days + 1;
			$lock_date =  date("Y-m-d",strtotime("-".$lock_days." days")); 
			//return $lock_date; 
			if(strtotime($entry_date) <= strtotime($lock_date)) {
				return 'lock';
			} else {
				return 'unlock';
			} 
		} else {
			return 'unlock';
		}
	} else {
		return 'unlock';
	}		
				
}
function dateLockOld($entry_date){
	if( ($_SESSION['session_admin_user_branch_id'] != 12) && ($_SESSION['session_admin_user_branch_id'] != 13) && ($_SESSION['session_admin_user_branch_id'] != 14) && ($_SESSION['session_admin_user_branch_id'] != 15)  && ($_SESSION['session_admin_user_branch_id'] != 9) && ($_SESSION['session_admin_user_branch_id'] != 11) ){
		$usel_level = $_SESSION['session_admin_user_level'];
		$user_level_arr = array("branch", "bm", "hr", "floor", "audit");
		$lock_date =  date("Y-m-d",strtotime("-3 days"));
		//return 'unlock';
		if (in_array($usel_level, $user_level_arr)) {
	
			if(strtotime($entry_date) <= strtotime($lock_date)) {
				return 'lock';
			} else {
				return 'unlock';
			}
		} else if($usel_level == 'head-office') {
			return 'unlock';
	/*		$day = date("d",strtotime($entry_date));
			
			if( ($day >= 1) && ($day <= 10) ) {
				if( (date("d") >= 1) && (date("d") <= 12) ) {
					return 'unlock';
				} else {
					return 'lock';
				}
			} else if( ($day >= 11) && ($day <= 20) ) {
				if( (date("d") >= 11) && (date("d") <= 22) ) {
					return 'unlock';
				} else {
					return 'lock';
				}
			} else if( ($day >= 21) && ($day <= 31) ) {
				if( ((date("d") >= 21) && (date("d") <= 31)) || (date("d") == 1) || (date("d") == 2) ) {
					return 'unlock';
				} else {
					return 'lock';
				}
			} else{
				return 'lock';
			}*/	
		} else {
			return 'unlock';
		}
	} else {
		return 'unlock';
	}	
}
function leavePersonInAlert()
{
	$today = date('Y-m-d');
	//$today = '2015-06-19';
	$where = " WHERE attendance_deleted_status = 0 AND attendance_date = '".$today."' AND attendance_status = 'leave' AND NOT attendance_in_time = '00:00:00' ";
	$branch_id = $_SESSION['session_admin_user_branch_id'];
	if($branch_id != 0)
	{
		$where .= " AND attendance_branch_id = ".$branch_id." ";
	}
	
	$select_query = " SELECT attendance_status
				FROM	attendance
				$where
	";
	$result_query = mysql_query($select_query);
	$arr_leave    = array();
	
	while ($record_attendance = mysql_fetch_array($result_query)) {
		$arr_leave[]  = $record_attendance;
	}
	
	return $arr_leave;
}
function newEmployeeAlert()
{
	$today = date('Y-m-d');
	//$today = '2015-06-19';
	$where = " WHERE employee_deleted_status = 0 AND  DATE_FORMAT( FROM_UNIXTIME( employee_added_on ) , '%Y-%m-%d' )  = '".$today."' AND employee_job_status = 'permanent'  ";
	$branch_id = $_SESSION['session_admin_user_branch_id'];
	if($branch_id != 0)	{
		$where .= " AND employee_branch_id = ".$branch_id." ";
	}
	$select_query = " SELECT employee_no, employee_name, designation_name, employee_doj FROM employees
		 			  LEFT JOIN designations ON designation_id=employee_designation_id
				      $where
					  ORDER BY employee_no";
	$result_query = mysql_query($select_query);
	$arr_leave    = array();
	$record_attendance = mysql_fetch_array($result_query);
	return $record_attendance;
}
function getLastWorkingDate($emp_id, $connection, $db){
	$select_attendance = "SELECT attendance_date FROM $db.attendance 
							WHERE attendance_deleted_status =0 AND attendance_employee_id = '".$emp_id."' 
							AND attendance_status = 'present'
							ORDER BY attendance_date DESC LIMIT 1 "; 
	$result_attendance = mysql_query($select_attendance, $connection);
	$record_attendance = mysql_fetch_array($result_attendance);
	$attendance_date = $record_attendance['attendance_date'];
	return $attendance_date;
}
function getGatePassCount($type, $month, $year, $emp_id, $connection, $db){
	$select_gatepass = "SELECT gate_pass_id FROM $db.gate_pass 
							WHERE gate_pass_deleted_status =0 
							AND gate_pass_employee_id = '".$emp_id."' 
							AND gate_pass_type = '".$type."' 
							AND MONTH(gate_pass_date) = '".$month."'
							AND YEAR(gate_pass_date) = '".$year."'  "; 
	$result_gatepass = mysql_query($select_gatepass, $connection);
	$record_gatepass = mysql_num_rows($result_gatepass);
	return $record_gatepass;
}
function getYear($month){
	$fyear = getCuurentFinancialYear();
	if(intval($month) == 1) {
		$fyear = substr($fyear,7,4);	
	} else if(intval($month) == 2) {
		$fyear = substr($fyear,7,4);	
	} else if(intval($month) == 3) {
		$fyear = substr($fyear,7,4);	
	} else if(intval($month) == 4) {
		$fyear = substr($fyear,0,4);	
	} else if(intval($month) == 5) {
		$fyear = substr($fyear,0,4);	
	} else if(intval($month) == 6) {
		$fyear = substr($fyear,0,4);	
	} else if(intval($month) == 7) {
		$fyear = substr($fyear,0,4);	
	} else if(intval($month) == 8) {
		$fyear = substr($fyear,0,4);	
	} else if(intval($month) == 9) {
		$fyear = substr($fyear,0,4);	
	} else if(intval($month) == 10) {
		$fyear = substr($fyear,0,4);	
	} else if(intval($month) == 11) {
		$fyear = substr($fyear,0,4);	
	} else if(intval($month) == 12) {
		$fyear = substr($fyear,0,4);	
	}
	return $fyear;
}
function documentIssueAlert($trans_date, $emp_id, $connection, $db)
{
	
	$where = " WHERE attendance_deleted_status = 0 AND attendance_date > '".$trans_date."' AND NOT attendance_in_time <> '00:00:00'  AND attendance_document_status ='issue' ";
	$select_query = " SELECT attendance_document_status
				FROM	$db.attendance
				$where
	";
	$result_query = mysql_query($select_query, $connection);
	$arr_leave    = array();
	
	while ($record_attendance = mysql_fetch_array($result_query)) {
		$arr_leave[]  = $record_attendance;
	}
	
	return $arr_leave;
}
function historyAction($history_employee_id, $history_employee_device_id, $history_action, $history_table_name, $history_master_id, $history_detail_id, $history_query, $connection, $db) 
{
        $myUrl = getFileFolderName();
		$ip = getRealIpAddr();
		$actionRecord = sprintf("INSERT INTO $db.history (history_user_id, history_date, history_action,
										 			  history_page_name, history_table_name, history_master_id,
										  			  history_detail_id, history_query, history_company_id,
										  			  history_financial_year, history_ip, history_employee_id,
													  history_employee_device_id) 
										  	  VALUES ('%d', UNIX_TIMESTAMP(NOW()), '%s', 
											  		  '%s', '%s', '%d',
													  '%d', '%s', '%d', 
													  '%d', '%s', '%d', '%d')", 
										  $_SESSION['session_admin_user_id'], $history_action, 
										  $myUrl, $history_table_name, $history_master_id,
										  $history_detail_id, $history_query, 1, 
										  $_SESSION['session_admin_user_financial_year_id'], $ip, $history_employee_id, $history_employee_device_id); 
		
		mysql_query($actionRecord, $connection);
}
function ageCalculator($dob){
    if(!empty($dob)){
		if($dob == date('d/m/Y')) {
			 return 0;
		} else {
			$birthdate = new DateTime($dob);
			$today   = new DateTime('today');
			$age = $birthdate->diff($today)->y;
			return $age;
		}	
    }else{
        return 0;
    }
}
function decimal_to_words($x)
{
	$x = str_replace(',','',$x);
	$pos = strpos((string)$x, ".");
	if ($pos !== false) { $decimalpart= substr($x, $pos+1, 2); $x = substr($x,0,$pos); }
	$tmp_str_rtn = amount_to_words ($x);
	if(!empty($decimalpart))
		$tmp_str_rtn .= ' and '  . amount_to_words ($decimalpart) . ' paise';
	return   $tmp_str_rtn . ' Only';
} 
function amount_to_words ($x)
{
     global $nwords; 
     if(!is_numeric($x))
     {
         $w = '#';
     }else if(fmod($x, 1) != 0)
     {
         $w = '#';
     }else{
         if($x < 0)
         {
             $w = 'minus ';
             $x = -$x;
         }else{
             $w = '';
         }
         if($x < 21)
         {
             $w .= $nwords[$x];
         }else if($x < 100)
         {
             $w .= $nwords[10 * floor($x/10)];
             $r = fmod($x, 10);
             if($r > 0)
             {
                 $w .= ' '. $nwords[$r];
             }
         } else if($x < 1000)
         {
		
             $w .= $nwords[floor($x/100)] .' Hundred';
             $r = fmod($x, 100);
             if($r > 0)
             {
                 $w .= ' '. amount_to_words($r);
             }
         } else if($x < 100000)
         {
         	$w .= amount_to_words(floor($x/1000)) .' Thousand';
             $r = fmod($x, 1000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $w .= ' ';
                 }
                 $w .= amount_to_words($r);
             }
         } else {
             $w .= amount_to_words(floor($x/100000)) .' lacs';
             $r = fmod($x, 100000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $word .= ' ';
                 }
                 $w .= amount_to_words($r);
             }
         }
     }
     return $w;
} 


function updateCompoffAssignEntry($date, $employee_id, $status, $connection, $db)
{	 
	$ip                   		   = getRealIpAddr(); 
	$select_compoff = "SELECT compoff_assign_entry_id FROM $db.compoff_assign_entry 
								WHERE compoff_assign_entry_employee_id = '".$employee_id."'
								AND compoff_assign_entry_date = '".$date."'
								AND compoff_assign_entry_deleted_status = 0 "; 
	$result_compoff = mysql_query($select_compoff, $connection);
	$row_compoff    = @mysql_num_rows($result_compoff); 
	if($row_compoff > 0){
			$record_compoff = mysql_fetch_array($result_compoff);
			$compoff_assign_entry_id = $record_compoff['compoff_assign_entry_id'];
		
			$update_compoff = "UPDATE $db.compoff_assign_entry  SET compoff_assign_entry_status = '".$status."' 
							   WHERE compoff_assign_entry_id = '".$compoff_assign_entry_id."' ";
			mysql_query($update_compoff, $connection);
	} else {
			$uniq_id  = generateUniqId();	
		    $insert_compoff = sprintf("INSERT INTO compoff_assign_entry(compoff_assign_entry_uniq_id, compoff_assign_entry_date, compoff_assign_entry_employee_id, compoff_assign_entry_status,
																		compoff_assign_entry_added_by, compoff_assign_entry_added_on, compoff_assign_entry_added_ip) 
														VALUES   ('%s', '%s', '%d', '%s', '%d', UNIX_TIMESTAMP(NOW()), '%s')",  $uniq_id, $date,  $employee_id, $status,
														$_SESSION['session_admin_user_id'], $ip);   
			mysql_query($insert_compoff, $connection);	
			$attendance_status_id = mysql_insert_id();
	}
	
}	



function checkHoldList($month, $year, $employee_id)
{	 

	$select_salary_hold_entry = "SELECT salary_hold_entry_id FROM   salary_hold_entry 
								 WHERE salary_hold_entry_deleted_status = 0 
								 AND salary_hold_entry_release_date = '0000-00-00'
								 AND salary_hold_entry_month = '".$month."'
								 AND salary_hold_entry_year = '".$year."'
								 AND salary_hold_entry_employee_id = '".$employee_id."' ";
	$result_salary_hold_entry = mysql_query($select_salary_hold_entry);
	$record_salary_hold_entry = mysql_fetch_array($result_salary_hold_entry);
	return $record_salary_hold_entry['salary_hold_entry_id'] ;
}	

function sentMailCommonFormat($to, $subject, $msg)
{	 
	echo $to;
	$mail = new PHPMailer;
	$mail->setFrom('payroll@lalithaajewellery.com', 'HRD Corporate');
	$mail->addAddress($to);
	$mail->isHTML(true);
//	$mail->AddAttachment('Employee Attendance Report.xlsx');
	$mail->Subject = $subject;
	$mail->Body = $msg;
	$mail->AltBody = "This is the plain text version of the email content";
	
	if(!$mail->send()) 
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
		echo "Message has been sent successfully";
	}
}

function getEmployeeIDandName($id)
{
	$select_employee_id = "SELECT employee_name, employee_no, designation_name FROM employees LEFT JOIN designations ON employee_designation_id = designation_id
							 WHERE employee_id = '".$id."'";
	$result_employee_id = mysql_query($select_employee_id);
	$record_employee_id = mysql_fetch_array($result_employee_id);
	return array($record_employee_id['employee_no'], ucwords($record_employee_id['employee_name']), ucwords($record_employee_id['designation_name']));
}
?>