<?php 
	require_once('../includes/config/config.php');
    //customer ID
$state_id 	= $_GET["state_id"];
$filed_name		= $_GET['filed_name'];

$select_city 	=   "SELECT 
						city_id, 
						city_name 
					 FROM 
					 	cities 
					 WHERE 
					 	city_state_id 			= '".$state_id."' 	AND 
						city_deleted_status 	= 0 
					 ORDER BY 
					 	city_name ASC";	
$result_city 	=  mysql_query($select_city);
$select 		= '<select name="'.$filed_name.'" id="'.$filed_name.'"  class="form-control select2" >
					<option value=""> - Select - </option>';
while($record_city = mysql_fetch_array($result_city)) {
	$select 	.= '<option value="'.$record_city['city_id'].'">'.ucwords($record_city['city_name']).'</option>'; 
}
$select 		.= '</select>';
echo $select;
?>

			 
 
  

 
 