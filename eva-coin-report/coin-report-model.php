<?php 
function searchdata(){
$where ="";
if(!empty($_REQUEST['branchid_rcpt'])){
$where .="AND product_con_entry_branch_id ='".$_REQUEST['branchid_rcpt']."'";
}

if(!empty($_REQUEST['from_date_rcpt']) && (!empty($_REQUEST['to_date_rcpt']))){
$where .=" AND  product_con_entry_date  BETWEEN '".NdateDatabaseFormat($_REQUEST['from_date_rcpt'])."' AND '".NdateDatabaseFormat($_REQUEST['to_date_rcpt'])."'"; 
}
   $query  = "SELECT *
				    FROM  product_con_entry_product_details
					LEFT JOIN  product_con_entry ON product_con_entry_id = product_con_entry_product_detail_product_con_entry_id
					LEFT JOIN products ON product_id = product_con_entry_product_detail_product_id
					LEFT JOIN product_uoms ON product_uom_id = product_purchase_uom_id
					WHERE product_con_entry_product_detail_deleted_status = 0 $where
					ORDER BY product_con_entry_product_detail_id DESC";//exit;
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;

}
	
	
	

?>
