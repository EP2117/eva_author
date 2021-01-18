<?php 
	require_once('../includes/config/config.php');
    //customer ID
$production_section_id 	= $_GET["section_id"];
$id 					= $_GET["id"];
$select_production_machine 	=   "SELECT 
								production_machine_id, 
								production_machine_name 
							 FROM 
								production_machines 
							 WHERE 
								production_machine_production_section_id 		= '".$production_section_id."' 	AND 
								production_machine_deleted_status 	= 0 
							 ORDER BY 
								production_machine_name ASC";	
$result_production_machine 	=  mysql_query($select_production_machine);
$select 		= '<select name="production_entry_work_detail_production_machine_id[]" id="production_entry_work_detail_production_machine_id'.$id.'"  class="form-control select2"   tabindex="1">
					<option value=""> - Select - </option>';
while($record_production_machine = mysql_fetch_array($result_production_machine)) {
	$select 	.= '<option value="'.$record_production_machine['production_machine_id'].'">'.ucwords($record_production_machine['production_machine_name']).'</option>'; 
}
$select 		.= '</select>';
echo $select;
?>

			 
 
  

 
 