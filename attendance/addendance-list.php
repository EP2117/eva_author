<?php
require_once('../project-config/utility-function.php');
require_once('../project-config/project-config.php');
// if the 'term' variable is not sent with the request, exit




$term = trim(strip_tags($_GET['term']));

	$rs = mysql_query("SELECT  * FROM 
								  hr_employeess 
							WHERE 
							(employee_name LIKE '%".$term."%')  AND 
							 employee_deleted_status = 0");
 		

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
	while( $row = mysql_fetch_object($rs))
	{
		$data[] = array(
			'value' =>$row->employee_name .' - '.$row->employee_id,
			'employee_id' => $row->employee_id
			
			
		);
	}
}
 	
// Truncate, encode and return the results
$data = array_slice($data, 0, 5);



echo json_encode($data);
flush();


?>