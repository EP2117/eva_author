<?php
require_once '../includes/connection.php'; 
// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
	exit;


// query the database table for zip codes that match 'term'
$rs = mysql_query("SELECT product_id, product_code, product_name, product_uom_name, product_cost_price  FROM products
					 LEFT JOIN product_uoms ON product_uom_id = product_uom
					WHERE product_name LIKE '%".$_REQUEST['term']."%'
					 AND product_company_id =  '".$_SESSION[SESS.'_session_company_id']."'
					ORDER BY product_name ASC LIMIT 0,10");
 
// loop through each zipcode returned and format the response for jQuery
$data = array();
if ( $rs && mysql_num_rows($rs) )
{
	while( $row = mysql_fetch_object($rs) )
	{
		$data[] = array(
			'value' =>$row->product_code.' - '.$row->product_name,
			'product_id' => $row->product_id,
			'uom' => $row->product_uom_name,
			'price' => round($row->product_cost_price,2)
			
		);
	}
}
 
// jQuery wants JSON data
echo json_encode($data);
flush();
?>