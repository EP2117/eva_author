<?php 

	function productiondelivery(){
		
		 $query  = "SELECT pdo_entry_id FROM  pdo_entry
					WHERE pdo_entry_deleted_status=0 ORDER BY pdo_entry_id DESC";
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}




	function gatepassInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
			if(empty($_REQUEST['id'])){
				  
				  $query = "INSERT INTO gate_pass SET gp_pdo_entry_id='".$_REQUEST['gatepassno']."', gp_branchid='".$_REQUEST['branchid']."', gp_date='".NdateDatabaseFormat($_REQUEST['gate_passdate'])."',gp_company_id='$bC', gp_added_by='$by', gp_added_on=NOW(), gp_added_ip='$ip'";//exit;
		
			}else{
			
				$query = "UPDATE gate_pass SET gp_pdo_entry_id='".$_REQUEST['gatepassno']."', gp_branchid='".$_REQUEST['branchid']."',gp_date='".NdateDatabaseFormat($_REQUEST['gate_passdate'])."',gp_modified_by='$by', gp_modified_on=NOW(),gp_modified_ip='$ip' WHERE gatePassId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=0;$k<$_REQUEST['prod_count'];$k++){
			
					if(empty($_REQUEST['pid_'.$k])){
				
						$query ="INSERT INTO gate_pass_product_details SET gpP_gatePassId='".$last_id."',gpP_pdo_entry_product_detail_id='".$_REQUEST['pdo_entryid_'.$k]."',gpP_product_id='".$_REQUEST['productid_'.$k]."',gpP_qty='".$_REQUEST['qty_'.$k]."'";
				
					 }else{
				  
					 $query ="UPDATE gate_pass_product_details SET gpP_pdo_entry_product_detail_id='".$_REQUEST['pdo_entryid_'.$k]."',gpP_product_id='".$_REQUEST['productid_'.$k]."',gpP_qty='".$_REQUEST['qty_'.$k]."' WHERE gpP_gatePassId='".$last_id."' AND gpProductdetailsId='".$_REQUEST['pid_'.$k]."'";

					 }	
												
					$qry = mysql_query($query);
					if(empty($qry)){					
						$rollBack=true;
						break;
					}
				}
				
			}
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
			
				if(empty($_REQUEST['id'])){
					pageRedirection("gate-pass/index.php?page=add&msg=1");	
				}else{
					pageRedirection("gate-pass/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
				
			}
			
			
			
		
		
	}
	function listGatepass(){
		
		$query  = "SELECT gatePassId,gp_pdo_entry_id,customer_name,pdo_entry_delivery_type,godown_name,DATE_FORMAT(gp_date ,'%d/%m/%Y') AS gp_date
				    FROM gate_pass
					LEFT JOIN pdo_entry ON gp_pdo_entry_id = pdo_entry_id	
					LEFT JOIN customers ON customer_id = pdo_entry_customer_id
					LEFT JOIN godowns ON pdo_entry_godown_id = godown_id	
					ORDER BY gatePassId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editgpdetails($id){
		$query  = "SELECT gatePassId,gp_pdo_entry_id,gp_branchid,customer_name,pdo_entry_delivery_type,pdo_entry_vehicle_no,pdo_entry_driver_name,godown_name,DATE_FORMAT(gp_date ,'%d/%m/%Y') AS gp_date
				    FROM gate_pass
					LEFT JOIN pdo_entry ON gp_pdo_entry_id = pdo_entry_id	
					LEFT JOIN customers ON customer_id = pdo_entry_customer_id
					LEFT JOIN godowns ON pdo_entry_godown_id = godown_id	
					WHERE gatePassId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editgpdetailsproduct($id){
		
		 $query = "SELECT pdo_entry_product_detail_product_id,product_name,product_code,product_colour_name,product_thick_ness,pdo_entry_product_detail_width_inches,pdo_entry_product_detail_width_mm,pdo_entry_product_detail_width_inches,pdo_entry_product_detail_length_feet,product_uom_name,pdo_entry_product_detail_qty
					FROM gate_pass_product_details A
		 			LEFT JOIN pdo_entry_product_details ON gpP_pdo_entry_product_detail_id = pdo_entry_product_detail_id
					LEFT JOIN products ON pdo_entry_product_detail_product_id = product_id
					LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 
					LEFT JOIN product_colours ON product_colour_id = product_product_colour_id
					WHERE gpP_gatePassId='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	function deteteGatePass(){
		foreach($_REQUEST['deleteCheck'] as $id){
			mysql_query("UPDATE gate_pass SET gp_deleted_status=1 WHERE gatePassId ='$id'");
		}
		pageRedirection("gate-pass/index.php?&msg=3");
	}

?>
