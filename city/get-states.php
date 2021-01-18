<?php 
 require_once '../includes/connection.php'; 
    //customer ID
$country_id = $_GET["country_id"];
 $sQuery =   "SELECT state_id, state_name FROM states WHERE state_country_id = '".$country_id."' 
 				AND state_deleted_status = 0 AND state_active_status = 'active' ORDER BY state_name ASC";	
$result =  mysql_query($sQuery);

		$select = '<select name="city_state_id" id="city_state_id"  class="textbox"   tabindex="1" onChange="getCity(this.value)" required>
					<option value=""> - Select - </option>';

 while($aValues = mysql_fetch_array($result)) {
		$select .= '<option value="'.$aValues['state_id'].'">'.ucwords($aValues['state_name']).'</option>'; 

}
$select .= '</select>';
echo $select;
?>

			 
 
  

 
 