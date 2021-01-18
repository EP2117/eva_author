<?php 
	require_once('../includes/config/config.php');
    //customer ID
$country_id 	= $_GET["country_id"];
$filed_name		= $_GET['filed_name'];

$select_state 	=   "SELECT 
						state_id, 
						state_name 
					 FROM 
					 	states 
					 WHERE 
					 	state_country_id 		= '".$country_id."' 	AND 
						state_deleted_status 	= 0 
					 ORDER BY 
					 	state_name ASC";	
$result_state 	=  mysql_query($select_state);
$select 		= '<select name="'.$filed_name.'" id="'.$filed_name.'"  class="form-control select2"   tabindex="1" onChange="getCity(this.value)">
					<option value=""> - Select - </option>';
while($record_state = mysql_fetch_array($result_state)) {
	$select 	.= '<option value="'.$record_state['state_id'].'">'.ucwords($record_state['state_name']).'</option>'; 
}
$select 		.= '</select>';
echo $select;
?>

			 
 
  

 
 