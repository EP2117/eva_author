<?php 
require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
    //customer ID
	
	if($_GET['type']==2){
	
$state_id = $_GET["id"];
  $sQuery =   "SELECT product_id, product_name FROM products WHERE product_brand_id = '".$state_id."' AND product_deleted_status = 0 ORDER BY product_name ASC";	
$result =  mysql_query($sQuery);

		$select = '<option value=" "> - Select - </option>';

 while($aValues = mysql_fetch_array($result)) { 
		$select .= '<option value="'.$aValues['product_id'].'" > '.$aValues['product_name'].'</option>'; 

}

echo $select;

}else{

$state_id = $_GET["id"];
  $sQuery =   "SELECT city_id, city_name FROM cities WHERE city_state_id = '".$state_id."' AND city_deleted_status = 0 ORDER BY city_name ASC";	
$result =  mysql_query($sQuery);

		$select = '<option value=" "> - Select - </option>';

 while($aValues = mysql_fetch_array($result)) { 
		$select .= '<option value="'.$aValues['city_id'].'" > '.$aValues['city_name'].'</option>'; 

}

echo $select;
}
?>
