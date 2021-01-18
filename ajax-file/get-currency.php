<?php 
	require_once('../includes/config/config.php');
    //customer ID
$filed_name			= $_GET['filed_name'];
$fld_cnt			= $_GET['fld_cnt'];
$select_currency 	=   "SELECT 
							currency_id, 
							currency_name 
						 FROM 
							currencies 
						 WHERE 
							currency_deleted_status 	= 0 		AND
							currency_active_status		= 'active'
						 ORDER BY 
							currency_name ASC";	
$result_currency 	=  mysql_query($select_currency);
$select 		= '<select name="'.$filed_name.'" id="'.$filed_name.'"  class="form-control select2"   tabindex="1"  onChange="GetRate('.$fld_cnt.');" >
					<option value=""> - Select - </option>';
while($record_currency = mysql_fetch_array($result_currency)) {
	$select 	.= '<option value="'.$record_currency['currency_id'].'">'.ucwords($record_currency['currency_name']).'</option>'; 
}
$select 		.= '</select>';
echo $select;
?>

			 
 
  

 
 