<?php 
	require_once('../includes/config/config.php');
    //customer ID
$salesmode_id 	= $_GET["salesmode_id"];
$filed_name		= $_GET['filed_name'];

$select_sales_channel 	=   "SELECT 
								sales_channel_id, 
								sales_channel_name 
							 FROM 
								sales_channels 
							 WHERE 
								sales_channel_salesmode_id 		= '".$salesmode_id."' 	AND 
								sales_channel_deleted_status 	= 0 
							 ORDER BY 
								sales_channel_name ASC";	
$result_sales_channel 	=  mysql_query($select_sales_channel);
$select 		= '<select name="'.$filed_name.'" id="'.$filed_name.'"  class="form-control select2"   tabindex="1">
					<option value=""> - Select - </option>';
while($record_sales_channel = mysql_fetch_array($result_sales_channel)) {
	$select 	.= '<option value="'.$record_sales_channel['sales_channel_id'].'">'.ucwords($record_sales_channel['sales_channel_name']).'</option>'; 
}
$select 		.= '</select>';
echo $select;
?>

			 
 
  

 
 