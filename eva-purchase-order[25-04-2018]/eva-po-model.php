<?php 

function get_supplier(){

	$select="SELECT * FROM suppliers WHERE supplier_deleted_status = 0";
	
	$query=mysql_query($select);
	while($result=mysql_fetch_array($query)){
	
	$arr_sup[]=$result;
	
	}
	return $arr_sup;

}

	function purchaseOrderInsertUpdate(){
		
		
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		
		$select_purchase_entry_no						= "SELECT 

																MAX(purchase_no) AS maxval 

														   FROM 

																purchase_order 

														   WHERE 

																pR_deleted_status 	= 0 												AND

															
																pR_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_collection_entry_no 						= mysql_query($select_purchase_entry_no);

		$record_collection_entry_no 						= mysql_fetch_array($result_collection_entry_no);	

		$maxval 										= $record_collection_entry_no['maxval']; 

		if($maxval > 0) {

			$purchase_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$purchase_no 							= substr(('00000'.++$maxval),-5);

		}
		
		//print_r($_REQUEST);
			if(empty($_REQUEST['id'])){
				  
				 $query = "INSERT INTO purchase_order SET  pR_branchid='".$_REQUEST['branchid']."', pR_supplier_location='".$_REQUEST['supplier_location']."', pR_supplier_id='".$_REQUEST['supplier_name']."',pR_currency_id='".$_REQUEST['currency']."',pR_rate='".$_REQUEST['rate']."',pR_purchase_date='".NdateDatabaseFormat($_REQUEST['purchase_date'])."',pR_purchase_od_method='".$_REQUEST['purchase_od_method']."',pR_payment_terms='".$_REQUEST['payment_terms']."',pR_shipment_id='".$_REQUEST['shipment_id']."',pR_arrival_date='".NdateDatabaseFormat($_REQUEST['arrival_date'])."',pR_brand_id='".$_REQUEST['po_brand_id']."', pR_totalAmnt='".str_replace(',','',$_REQUEST['total_amnt'])."',pR_advanceAmnt='".$_REQUEST['advance_amnt']."',pR_net_total_amnt='".$_REQUEST['net_total_amnt']."', pR_tot_amount='".str_replace(',','',$_REQUEST['tot_amount'])."',pR_advance_amount='".$_REQUEST['advance_amount']."',pR_net_total_amount='".$_REQUEST['net_tot_amount']."',pR_remarks='".$_REQUEST['remarks']."',pR_company_id='$bC', pR_added_by='$by', pR_added_on=NOW(), pR_added_ip='$ip',purchase_no='".$purchase_no."'";//exit;
			
			}else{
			
				    $query = "UPDATE purchase_order SET pR_branchid='".$_REQUEST['branchid']."', pR_supplier_location='".$_REQUEST['supplier_location']."', pR_supplier_id='".$_REQUEST['supplier_name']."',pR_currency_id='".$_REQUEST['currency']."',pR_rate='".$_REQUEST['rate']."',pR_purchase_date='".NdateDatabaseFormat($_REQUEST['purchase_date'])."',pR_purchase_od_method='".$_REQUEST['purchase_od_method']."',pR_payment_terms='".$_REQUEST['payment_terms']."',pR_shipment_id='".$_REQUEST['shipment_id']."',pR_arrival_date='".NdateDatabaseFormat($_REQUEST['arrival_date'])."',pR_brand_id='".$_REQUEST['po_brand_id']."',pR_totalAmnt='".str_replace(',','',$_REQUEST['total_amnt'])."',pR_advanceAmnt='".$_REQUEST['advance_amnt']."',pR_net_total_amnt='".$_REQUEST['net_total_amnt']."',pR_remarks='".$_REQUEST['remarks']."', pR_modified_by='$by', pR_modified_on=NOW(),pR_modified_ip='$ip', pR_tot_amount='".str_replace(',','',$_REQUEST['tot_amount'])."',pR_advance_amount='".$_REQUEST['advance_amount']."',pR_net_total_amount='".$_REQUEST['net_tot_amount']."' WHERE purchaseId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				for($k=1;$k<=count($_REQUEST['arr_count']);$k++){ 
					$proid = $_REQUEST['prod_id_'.$k];
					 if(!empty($_REQUEST['pid_'.$k])){ 
					 $query ="UPDATE purchase_order_products SET pRp_product_id='".$proid."',pRp_rate='".$_REQUEST['rate_'.$k]."', pRp_frignrate='".$_REQUEST['frignrate_'.$k]."',pRp_ton='".$_REQUEST['prod_ton_'.$k]."',pRp_kg='".$_REQUEST['prod_kg_'.$k]."',pRp_qty='".$_REQUEST['qty_'.$k]."',pRp_unitprice='".str_replace(',','',$_REQUEST['unitprice_'.$k])."',pRp_rate_by_currency='".str_replace(',','',$_REQUEST['rate_by_currency_'.$k])."' WHERE pRp_purchaseId='".$last_id."' AND purOrdPorductId='".$_REQUEST['pid_'.$k]."'";
						
					 }else{
					     $query ="INSERT INTO purchase_order_products SET pRp_purchaseId='".$last_id."', pRp_product_id='".$proid."',pRp_rate='".$_REQUEST['rate_'.$k]."',pRp_frignrate='".$_REQUEST['frignrate_'.$k]."',pRp_ton='".$_REQUEST['prod_ton_'.$k]."',pRp_kg='".$_REQUEST['prod_kg_'.$k]."',pRp_qty='".$_REQUEST['qty_'.$k]."',pRp_unitprice='".str_replace(',','',$_REQUEST['unitprice_'.$k])."',pRp_rate_by_currency='".str_replace(',','',$_REQUEST['rate_by_currency_'.$k])."'"; 
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
					pageRedirection("eva-purchase-order/index.php?page=add&msg=1");	
				}else{
					pageRedirection("eva-purchase-order/index.php?page=edit&id=".$_REQUEST['id']."&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
	}
	function listpurchase(){
		$query  = "SELECT purchaseId,branch_name,supplier_name, pR_purchase_date, pR_arrival_date,purchase_no
				    FROM purchase_order
					LEFT JOIN branches ON pR_branchid = branch_id	
					LEFT JOIN suppliers ON pR_supplier_id = supplier_id
					WHERE pR_deleted_status=0
					ORDER BY purchaseId DESC";
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
	}
	
	function editpurchase($id){
		 $query  = "SELECT *,DATE_FORMAT(pR_purchase_date ,'%d/%m/%Y') AS pR_purchase_date,DATE_FORMAT(pR_arrival_date ,'%d/%m/%Y') AS pR_arrival_date
				    FROM purchase_order 
					WHERE 
					pR_deleted_status =0 AND
					purchaseId ='$id'"; 
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editpurchaseproduct($id){
		
		$query = "SELECT A.*,product_name,product_uom_name,product_code,brand_name
					FROM purchase_order_products A
		 			LEFT JOIN products ON pRp_product_id = product_id
					LEFT JOIN product_uoms ON product_uom_id = product_purchase_uom_id
					LEFT JOIN brands ON brand_id = product_brand_id
					WHERE
					pRp_deleted_status =0 AND
					 pRp_purchaseId='$id'"; 
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function editsupplier($id){
		  $query = "SELECT supplier_id,supplier_name
						 FROM suppliers							  	
						 WHERE supplier_deleted_status=0 AND  supplier_location = '".$id."' "; 
			$result = mysql_query($query);
			$array_result =array();
			while($resultData = mysql_fetch_array($result)){		 
				$array_result[]= $resultData;
			}			
			return $array_result;
	}
	
function evo_po_delete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		  $delete_budget_entry ="UPDATE  purchase_order SET pR_deleted_status = 1 ,
		 												pR_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														pR_deleted_on	 = UNIX_TIMESTAMP(NOW()),
														pR_deleted_ip = '".$ip."'
						WHERE purchaseId = '".$_REQUEST['select_all'][$i]."' ";//exit;
		
		mysql_query($delete_budget_entry);
			header("Location:index.php");
		
		
		}
	
	}
	
	}
	
	 function deleteProductdetail()

   {

		if((isset($_REQUEST['purOrdPorductId'])) && (isset($_REQUEST['purchaseId'])))

		{
$ip												= getRealIpAddr();
		$purOrdPorductId 	= $_GET['purOrdPorductId'];

			$purchaseId = $_GET['purchaseId'];
			
			$select ="SELECT * FROM purchase_order WHERE purchaseId ='".$purchaseId."'";
			$query=mysql_query($select);
			$result = mysql_fetch_array($query);
			$pR_totalAmnt 	= $result['pR_totalAmnt'];
			$pR_advanceAmnt 	= $result['pR_advanceAmnt'];
			
			
			$select_details="SELECT * FROM purchase_order_products WHERE purOrdPorductId ='".$purOrdPorductId."'";
			
			$query_details=mysql_query($select_details);
			$result_details = mysql_fetch_array($query_details);
			
			 $pRp_unitprice 	= $result_details['pRp_unitprice'];
			 
			 $total_gross = $pR_totalAmnt - $pRp_unitprice; //echo "</br>";
			 $total_net = $total_gross - $pR_advanceAmnt;
			 
			 
			 $update = "UPDATE purchase_order SET pR_totalAmnt ='".$total_gross."',pR_net_total_amnt ='".$total_net."'
			 WHERE purchaseId ='".$purchaseId."'  ";//exit;
			
			 mysql_query($update);
			
			$delete = "UPDATE  purchase_order_products SET pRp_deleted_status = '1' ,
								pRp_deleted_by ='".$_SESSION[SESS.'_session_user_id']."',
								pRp_deleted_on =UNIX_TIMESTAMP(NOW()),
								pRp_deleted_ip ='".$ip."'
						WHERE purOrdPorductId	 = '".$purOrdPorductId."' ";//exit;
			mysql_query($delete);

			header("Location:index.php?page=edit&id=$purchaseId");

		}

		

   } 
	
?>
