<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'request_details':requestDetails();
				break;
			case 'get_prodname':prductList();
				break;
			case 'prod_details':productDetails();
				break;
				case 'po':damageDetails();
				break;
		}
		
	}
	
	
	function damageDetails(){ $damage = unserialize(DAMAGE);
	    $query	="SELECT damage_entry_id,damage_entry_no,damage_entry_date,damage_entry_type_id FROM damage_entry WHERE 
				  		damage_entry_branch_id = '".$_REQUEST['branch_id']."' AND  damage_entry_deleted_status = 0 ORDER BY damage_entry_id DESC ";
						//echo $query;exit;
			$result = mysql_query($query);
		$array_result = "<option> -- Select --</option>";
		
		while($resultData = mysql_fetch_array($result)){ 
			$type_id = $resultData['damage_entry_type_id']; 
			$array_result .= "<option value='".$resultData['damage_entry_id']."'>".$resultData['damage_entry_no']." - ".$resultData['damage_entry_date']." - ".$damage[$type_id]."</option>";
		}
		
		echo $array_result;
	
	}
	
	function requestDetails(){
	    $query	="SELECT damage_entry_id,damage_entry_no,damage_entry_date,damage_entry_type_id FROM damage_entry WHERE 
				  		damage_entry_id = '".$_REQUEST['poid']."' AND  damage_entry_deleted_status = 0 ORDER BY damage_entry_id DESC ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function prductList(){
		
		$val   = $_REQUEST['val'];
	    $query = "SELECT product_id,product_name
				 FROM products 
				 LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 	
				 WHERE product_deleted_status=0 AND product_active_status='active' and product_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function productDetails(){
	
		 $query	="SELECT product_id,product_name,product_code,product_type,product_uom_name
				 FROM products 
				 LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 	
				 WHERE product_deleted_status=0 AND product_active_status='active' and product_id='".$_REQUEST['id']."' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}	
	
?>

		