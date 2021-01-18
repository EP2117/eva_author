<?php 

	function production_orderdetails(){
		
		 $query  = "SELECT production_order_id FROM  production_order
					WHERE production_order_deleted_status 	= 0 AND production_order_status= '2'
					ORDER BY production_order_id DESC";
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}




function dmsInsertUpdate(){
		
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
/*		if(!empty($_REQUEST['dms_type']) && $_REQUEST['dms_type']==1){
*/		
		
			if(empty($_REQUEST['id'])){
				  
				$query = "INSERT INTO damg_missing_scrp_details SET  dms_branchid='".$_REQUEST['branchid']."', dms_warehouseid='".$_REQUEST['warehouseid']."', dms_brandid='".$_REQUEST['brandid']."',dms_product_status='".$_REQUEST['productstatus']."',dms_type='".$_REQUEST['type']."',dms_productid='".$_REQUEST['product']."',dms_date='".NdateDatabaseFormat($_REQUEST['ds_date'])."',dms_colorid='".$_REQUEST['colorid']."',dms_thick='".$_REQUEST['width']."',dms_width='".$_REQUEST['thick']."',dms_po_entrytype='".$_REQUEST['poentrytype']."',dms_company_id='$bC', dms_added_by='$by', dms_added_on=NOW(), dms_added_ip='$ip'";
			
			}else{
			
				$query = "UPDATE damg_missing_scrp_details SET dms_branchid='".$_REQUEST['branchid']."', dms_warehouseid='".$_REQUEST['warehouseid']."', dms_brandid='".$_REQUEST['brandid']."',dms_product_status='".$_REQUEST['productstatus']."',dms_type='".$_REQUEST['type']."',dms_productid='".$_REQUEST['product']."',dms_date='".NdateDatabaseFormat($_REQUEST['ds_date'])."',dms_colorid='".$_REQUEST['colorid']."',dms_thick='".$_REQUEST['width']."',dms_width='".$_REQUEST['thick']."',dms_po_entrytype='".$_REQUEST['poentrytype']."', dms_modified_by='$by', dms_modified_on=NOW(),dms_modified_ip='$ip' WHERE dmgMsgScrpId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=1;$k<=$_REQUEST['mising_dmg_count'];$k++){
				
					$proid = explode(' - ',$_REQUEST['prod_name_'.$k]);
	
					 if(empty($_REQUEST['pid_'.$k])){
					
						$query ="INSERT INTO  damg_missing_scrp_details_products SET dmsP_dmgMsgScrpId='".$last_id."',dmsP_product_id='".$proid[0]."',dmsP_qty='".$_REQUEST['qty_'.$k]."'";
					 
					 }else{
					  
					    $query ="UPDATE  damg_missing_scrp_details_products SET dmsP_product_id='".$proid[0]."', dmsP_qty='".$_REQUEST['qty_'.$k]."' WHERE dmsP_dmgMsgScrpId='".$last_id."' AND dmsProductId='".$_REQUEST['pid_'.$k]."'";
	
						// $query ="UPDATE  damg_missing_scrp_details_products SET dmsP_product_id='".$proid[0]."', dmsP_qty='".$_REQUEST['qty_'.$k]."',dmsP_rate='".str_replace(',', '',$_REQUEST['rate_'.$k])."',dmsP_amount='".str_replace(',', '',$_REQUEST['amount_'.$k])."' WHERE dmsP_dmgMsgScrpId='".$last_id."' AND dmsProductId='".$_REQUEST['pid_'.$k]."'";

					 }
					 
			
						$delivery_entry_no ='123456789'; //generate auto id
			
					 					  				
						$qry = mysql_query($query);
						$incid = mysql_insert_id();
						if(empty($qry)){					
							$rollBack=true;
							break;
						}else{
						
							stockLedger('out',$last_id,$incid,$_REQUEST['length_'.$k],$_REQUEST['width_'.$k],($_REQUEST['qty_'.$k]*-1), $_REQUEST['branchid'], $delivery_entry_customer_id, $_REQUEST['warehouseid'], NdateDatabaseFormat($_REQUEST['ds_date']), $delivery_entry_no,'damage_entry','2');
					
						}
				}
				
			}
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				if(empty($_REQUEST['id'])){
					pageRedirection("damage-missing-production-scrab/index.php?page=add&msg=1");	
				}else{
					pageRedirection("damage-missing-production-scrab/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
			
			
			
		/*
		}elseif(!empty($_REQUEST['dms_type']) && $_REQUEST['dms_type']==2){
			
			
			if(empty($_REQUEST['id'])){
				  
					  
				$query = "INSERT INTO damg_missing_scrp_details SET dms_select_type='".$_REQUEST['dms_type']."', dms_branchid='".$_REQUEST['s_branchid']."', dms_warehouseid='".$_REQUEST['s_warehouseid']."', dms_brandid='".$_REQUEST['s_brandid']."',dms_product_status='".$_REQUEST['s_productstatus']."',dms_type='".$_REQUEST['s_type']."',dms_productid='".$_REQUEST['s_product']."',dms_date='".NdateDatabaseFormat($_REQUEST['s_ds_date'])."',dms_colorid='".$_REQUEST['s_colorid']."',dms_thick='".$_REQUEST['s_width']."',dms_width='".$_REQUEST['s_thick']."',dms_po_entrytype='".$_REQUEST['s_poentrytype']."',dms_production_order_id='".$_REQUEST['production_orderno']."',dms_company_id='$bC', dms_added_by='$by', dms_added_on=NOW(), dms_added_ip='$ip'";
			
			}else{
			
				 $query = "UPDATE damg_missing_scrp_details SET dms_select_type='".$_REQUEST['dms_type']."', dms_branchid='".$_REQUEST['s_branchid']."', dms_warehouseid='".$_REQUEST['s_warehouseid']."', dms_brandid='".$_REQUEST['s_brandid']."',dms_product_status='".$_REQUEST['s_productstatus']."',dms_type='".$_REQUEST['s_type']."',dms_productid='".$_REQUEST['s_product']."',dms_date='".NdateDatabaseFormat($_REQUEST['s_ds_date'])."',dms_colorid='".$_REQUEST['s_colorid']."',dms_thick='".$_REQUEST['s_width']."',dms_width='".$_REQUEST['s_thick']."',dms_po_entrytype='".$_REQUEST['s_poentrytype']."',  dms_modified_by='$by', dms_modified_on=NOW(),dms_modified_ip='$ip' WHERE dmgMsgScrpId ='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=0;$k<$_REQUEST['scrp_count'];$k++){
				
					 if(empty($_REQUEST['idd_'.$k])){
					
						$query ="INSERT INTO  damg_missing_scrp_details_products SET dmsP_dmgMsgScrpId='".$last_id."', dmsP_production_order_product_detail_id='".$_REQUEST['s_productentryid_'.$k]."',dmsP_product_id='".$_REQUEST['s_productid_'.$k]."',dmsP_qty='".$_REQUEST['s_qty_'.$k]."',dmsP_rate='".str_replace(',', '',$_REQUEST['s_rate_'.$k])."',dmsP_amount='".str_replace(',', '',$_REQUEST['s_amount_'.$k])."'";
					 
					 }else{
					  
					  $query ="UPDATE  damg_missing_scrp_details_products SET dmsP_production_order_product_detail_id='".$_REQUEST['s_productentryid_'.$k]."',dmsP_product_id='".$_REQUEST['s_productid_'.$k]."', dmsP_qty='".$_REQUEST['s_qty_'.$k]."',dmsP_rate='".str_replace(',', '',$_REQUEST['s_rate_'.$k])."',dmsP_amount='".str_replace(',', '',$_REQUEST['s_amount_'.$k])."' WHERE dmsP_dmgMsgScrpId='".$last_id."' AND dmsProductId='".$_REQUEST['idd_'.$k]."'";
	
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
					pageRedirection("damage-missing-production-scrab/index.php?page=add&msg=1");	
				}else{
					pageRedirection("damage-missing-production-scrab/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
		
		
		
		
		
		
		
		}*/
	}
	function dmslist(){
		
		 $query  = "SELECT dmgMsgScrpId,dms_select_type,branch_name,godown_name,DATE_FORMAT(dms_date ,'%d/%m/%Y') AS dms_date
				    FROM damg_missing_scrp_details
					LEFT JOIN godowns ON dms_warehouseid =  godown_id
					LEFT JOIN branches ON dms_branchid = branch_id
					ORDER BY dmgMsgScrpId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editdmsdetails($id){
		$query  = "SELECT *,DATE_FORMAT(dms_date ,'%d/%m/%Y') AS dms_date
				    FROM damg_missing_scrp_details 
					WHERE dmgMsgScrpId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editdmsproduct($id,$ds_date){
		
		$query = "SELECT A.*,dmsProductId,product_con_entry_child_product_detail_id,product_con_entry_child_product_detail_name,product_con_entry_child_product_detail_code,product_uom_name,product_colour_name,product_con_entry_child_product_detail_thick_ness,product_con_entry_child_product_detail_width_inches,product_con_entry_child_product_detail_width_inches,IFNULL((SELECT sum(stock_ledger_product_quantity*stock_ledger_product_length_inches) as open_bal
							 FROM 
								stock_ledger
							WHERE 
								stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' 					AND  	
								stock_ledger_status 		= 0																	AND
								stock_ledger_company_id 	= '".$_SESSION[SESS.'_session_company_id']."' 						AND
								stock_ledger_date			<	'".NdateDatabaseFormat($ds_date)."'							    AND
								stock_ledger_product_id		= product_con_entry_child_product_detail_id							AND
								stock_ledger_prd_type		= '2'
							GROUP BY 
								stock_ledger_product_id),0) AS length
					FROM damg_missing_scrp_details_products A
		 			LEFT JOIN product_con_entry_child_product_details ON dmsP_product_id = product_con_entry_child_product_detail_id
					LEFT JOIN product_uoms ON product_uom_id = 	product_con_entry_child_product_detail_uom_id
				    LEFT JOIN product_colours ON product_con_entry_child_product_detail_color_id=product_colour_id
					WHERE 
					dmsP_deleted_status =0 AND
					dmsP_dmgMsgScrpId='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function editShiftMngmntAtnc($id){
		$query  = "SELECT *,DATE_FORMAT(smA_date ,'%d/%m/%Y') AS smA_date 
				    FROM eng_shift_management_attendance
					WHERE smA_shiftManagementId ='$id'";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
	}

	function deteteGatePass(){
		foreach($_REQUEST['deleteCheck'] as $id){
			mysql_query("UPDATE damg_missing_scrp_details SET dms_deleted_status=1 WHERE dmgMsgScrpId ='$id'");
		}
		pageRedirection("gate-pass/index.php?&msg=3");
	}
	
	
    function deleteProductdetail()
   	{
		if((isset($_REQUEST['dmsProductId'])))
		{
			 $dmsProductId 	= $_GET['dmsProductId'];//exit;
			$dms_id = $_GET['dms_id'];
			mysql_query("UPDATE damg_missing_scrp_details_products SET dmsP_deleted_status = 1 
						WHERE dmsProductId = ".$dmsProductId." ");
			header("Location:index.php?page=edit&id=$dms_id");
		}
		
   	}

?>
