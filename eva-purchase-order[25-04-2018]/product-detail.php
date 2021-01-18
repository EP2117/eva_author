<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'get_prodname':prductList();
				break;
			case 'prod_details':productDetails();
				break;
		}
		
	}
	function prductList(){
		$val   = $_REQUEST['val'];
		$brand_id   = $_REQUEST['brand_id'];
		$where		= '';
		if($brand_id!=''){
			$where	.=" AND product_brand_id = '".$brand_id."'";
		}
	    $query = "SELECT product_id,product_name
				 FROM products 
				 LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 	
				 WHERE product_deleted_status=0 AND product_active_status='active' and product_name LIKE '%$val%' $where LIMIT 15";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function productDetails(){
	
		 $query	="SELECT product_id,product_name,product_code,product_type,product_uom_name,brand_name
				 FROM products 
				 LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id
				 LEFT JOIN brands ON brand_id = product_brand_id	
				 WHERE product_deleted_status=0 AND product_active_status='active' and product_id='".$_REQUEST['id']."' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}	
	
?>

		