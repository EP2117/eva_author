<?php 
 require_once '../includes/connection.php'; 
    //customer ID
$state_id = $_GET["state_id"];
 $sQuery =   "SELECT city_id, city_name FROM cities WHERE city_state_id = '".$state_id."' AND city_delete_status = 0 ORDER BY city_name ASC";	
$result =  mysql_query($sQuery);

		$select = '<select name="search_city_id" id="search_city_id"  class="textbox"   tabindex="1" >
					<option value=" "> - Select - </option>';

 while($aValues = mysql_fetch_array($result)) {
		$select .= '<option value="'.$aValues['city_id'].'">'.$aValues['city_name'].'</option>'; 

}
$select .= '</select>'; 
echo $select;
?>
