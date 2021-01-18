<?php 

	
	function purchaseOrderdetails(){
		 $query  = " SELECT 
		 				invoiceId,
						invoiceNo,
						supplier_name 
					 FROM  
						purchase_invoice
					 LEFT JOIN	
					 	purchase_order 
					 ON 
					 	purchaseId	= pI_purchaseId 
					 LEFT JOIN 
					 	suppliers 
					 ON 
					 	supplier_id = pR_supplier_id
		 			 WHERE 
					 	pR_deleted_status = 0 
					ORDER BY 
						purchaseId DESC";
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}



	function debitInsertUpdate(){
		
		
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
			if(empty($_REQUEST['id'])){
				  
				$query = "INSERT INTO purchase_debit_note SET d_purchaseId='".$_REQUEST['purchaseid']."', d_branchid='".$_REQUEST['branchid']."', d_type='".$_REQUEST['type']."', d_debitdate='".NdateDatabaseFormat($_REQUEST['debitdate'])."',d_remark='".$_REQUEST['remark']."',d_company_id='$bC', d_added_by='$by', d_added_on=NOW(), d_added_ip='$ip'";
			
			}else{
			
				$query = "UPDATE purchase_debit_note SET d_purchaseId='".$_REQUEST['purchaseid']."', d_branchid='".$_REQUEST['branchid']."', d_type='".$_REQUEST['type']."', d_debitdate='".NdateDatabaseFormat($_REQUEST['debitdate'])."',d_remark='".$_REQUEST['remark']."', d_modified_by='$by', d_modified_on=NOW(),d_modified_ip='$ip' WHERE debitnoteId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=0;$k<$_REQUEST['debit_count'];$k++){
				
					 if(empty($_REQUEST['pid_'.$k])){
					
						 $query ="INSERT INTO purchase_debit_note_products SET dp_debitnoteId='".$last_id."', dp_product_id='".$_REQUEST['productid_'.$k]."',dp_poqty='".$_REQUEST['poqty_'.$k]."',dp_rate='".$_REQUEST['rate_'.$k]."',dp_qty='".$_REQUEST['qty_'.$k]."',dp_amount='".$_REQUEST['amount_'.$k]."'";
					 
					 }else{
					  
					  $query ="UPDATE purchase_debit_note_products SET dp_product_id='".$_REQUEST['productid_'.$k]."',dp_poqty='".$_REQUEST['poqty_'.$k]."',dp_rate='".$_REQUEST['rate_'.$k]."',dp_qty='".$_REQUEST['qty_'.$k]."',dp_amount='".$_REQUEST['amount_'.$k]."' WHERE dp_debitnoteId='".$last_id."' AND debitProductId='".$_REQUEST['pid_'.$k]."'";
	
					 }					  				
						$qry = mysql_query($query);
						if(empty($qry)){					
							$rollBack=true;
							break;
						}
				}
				
			}
			
				$purchase_debit_note_child_product_product_id		= $_REQUEST['purchase_debit_note_child_product_product_id'];	
				$purchase_debit_note_child_product_id				= $_REQUEST['purchase_debit_note_child_product_id']; 
				$purchase_debit_note_child_product_inv_detail_id		= $_REQUEST['purchase_debit_note_child_product_inv_detail_id'];
				$purchase_debit_note_child_product_code				= $_REQUEST['purchase_debit_note_child_product_code'];	
				$purchase_debit_note_child_product_name				= $_REQUEST['purchase_debit_note_child_product_name'];
				$purchase_debit_note_child_product_color_id			= $_REQUEST['purchase_debit_note_child_product_color_id'];	
				$purchase_debit_note_child_product_thick_ness		= $_REQUEST['purchase_debit_note_child_product_thick_ness'];
				$purchase_debit_note_child_product_uom_id			= $_REQUEST['purchase_debit_note_child_product_uom_id'];	 
				$purchase_debit_note_child_product_width_inches		= $_REQUEST['purchase_debit_note_child_product_width_inches'];
				$purchase_debit_note_child_product_width_mm			= $_REQUEST['purchase_debit_note_child_product_width_mm'];	
				$purchase_debit_note_child_product_length_feet		= $_REQUEST['purchase_debit_note_child_product_length_feet'];
				$purchase_debit_note_child_product_length_mm			= $_REQUEST['purchase_debit_note_child_product_length_mm'];	
				$purchase_debit_note_child_product_ton_qty			= $_REQUEST['purchase_debit_note_child_product_ton_qty'];
				$purchase_debit_note_child_product_kg_qty			= $_REQUEST['purchase_debit_note_child_product_kg_qty'];	
				 
				for($l=0; $l < count($purchase_debit_note_child_product_product_id); $l++){
						$child_uniq_id = generateUniqId(); 	
							if(empty($purchase_debit_note_child_product_id[$l])){
							//echo $purchase_debit_note_child_product_uom_id[$l]; exit;
		$insert_child	= sprintf("INSERT INTO    purchase_debit_note_child_products (purchase_debit_note_child_product_uniq_id, purchase_debit_note_child_product_product_id,
												  purchase_debit_note_child_product_code, purchase_debit_note_child_product_name,
												  purchase_debit_note_child_product_grn_id, purchase_debit_note_child_product_inv_detail_id, 
												  purchase_debit_note_child_product_color_id,
												  purchase_debit_note_child_product_thick_ness, purchase_debit_note_child_product_uom_id, 
												  purchase_debit_note_child_product_width_inches,
												  purchase_debit_note_child_product_width_mm, purchase_debit_note_child_product_length_feet,
												  purchase_debit_note_child_product_length_mm,
												  purchase_debit_note_child_product_ton_qty, purchase_debit_note_child_product_kg_qty,
												  purchase_debit_note_child_product_company_id, purchase_debit_note_child_product_branch_id,
												  purchase_debit_note_child_product_financial_year,
												  purchase_debit_note_child_product_added_by, purchase_debit_note_child_product_added_on, 
												  purchase_debit_note_child_product_added_ip)
										  VALUES 	 ('%s', '%d', 
										  			  '%s', '%s',
										  			  '%d', '%d', '%d',
													  '%f', '%d', '%f', 
													  '%f', '%f', '%f',
													  '%f', '%f',
													  '%d', '%d', '%d', 
													  '%d', UNIX_TIMESTAMP(NOW()), '%s' )",
												 $child_uniq_id,$purchase_debit_note_child_product_product_id[$l],
												 $purchase_debit_note_child_product_code[$l],$purchase_debit_note_child_product_name[$l],
												 $last_id, $purchase_debit_note_child_product_inv_detail_id[$l],$purchase_debit_note_child_product_color_id[$l],
												 $purchase_debit_note_child_product_thick_ness[$l],
												 $purchase_debit_note_child_product_uom_id[$l],
												 $purchase_debit_note_child_product_width_inches[$l],
												 $purchase_debit_note_child_product_width_mm[$l],
												 $purchase_debit_note_child_product_length_feet[$l],$purchase_debit_note_child_product_length_mm[$l],
												 $purchase_debit_note_child_product_ton_qty[$l],$purchase_debit_note_child_product_kg_qty[$l],
												 $_SESSION[SESS.'_session_company_id'],$_REQUEST['branchid'],$_SESSION[SESS.'_session_financial_year'],
												 $_SESSION[SESS.'_session_user_id'], $ip );
												// echo $insert_child; exit;
						$qry_child = mysql_query($insert_child);	
						
						$product_con_entry_child_product_detail_id = mysql_insert_id();
								
							}else{
							
			   $update_child	= "UPDATE purchase_debit_note_child_products SET
										  purchase_debit_note_child_product_width_inches	= '".$purchase_debit_note_child_product_width_inches[$l]."',
										  purchase_debit_note_child_product_width_mm		= '".$purchase_debit_note_child_product_width_mm[$l]."',
										  purchase_debit_note_child_product_length_feet		= '".$purchase_debit_note_child_product_length_feet[$l]."',
										  purchase_debit_note_child_product_length_mm		= '".$purchase_debit_note_child_product_length_mm[$l]."',
										  purchase_debit_note_child_product_ton_qty			= '".$purchase_debit_note_child_product_ton_qty[$l]."',
										  purchase_debit_note_child_product_kg_qty			= '".$purchase_debit_note_child_product_kg_qty[$l]."',
										  purchase_debit_note_child_product_modified_by		= '".$_SESSION[SESS.'_session_user_id']."',
										  purchase_debit_note_child_product_modified_on		= UNIX_TIMESTAMP(NOW()),
										  purchase_debit_note_child_product_modified_ip		= '".$ip."'
									WHERE
										  purchase_debit_note_child_product_id				= '".$purchase_debit_note_child_product_id[$l]."' ";
									$product_con_entry_child_product_detail_id 	= $purchase_debit_note_child_product_id[$l];
						mysql_query($update_child);	
							
							}
				
						$length_inches										= 	$purchase_debit_note_child_product_length_feet[$i];
						$width_inches										= 	$purchase_debit_note_child_product_width_inches[$i];
						$product_detail_qty									= 	"1";
						$stock_ledger_prd_type								= 	"debit-note-entry";
						$product_con_entry_godown_id						= 	"1";
						stockLedger('out',$last_id,$product_con_entry_child_product_detail_id,$product_con_entry_child_product_detail_id,$length_inches,$width_inches,($product_detail_qty*-1), $_REQUEST['branchid'], $product_con_entry_godown_id, $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['debitdate']), '',$stock_ledger_prd_type, '2');
						
				
				
				}
				
				
				if(empty($rollBack)){	
				mysql_query("COMMIT");
			
				if(empty($_REQUEST['id'])){
					pageRedirection("eva-debit-note/index.php?page=add&msg=1");	
				}else{
					pageRedirection("eva-debit-note/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
				
			}
	}
	function listDebit(){
		
		$query  = "SELECT debitnoteId,d_purchaseId,branch_name,d_type,DATE_FORMAT(d_debitdate ,'%d/%m/%Y') AS d_debitdate
				    FROM purchase_debit_note
					LEFT JOIN branches ON d_branchid = branch_id
					WHERE d_deleted_status=0	
					ORDER BY debitnoteId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function debitEdit($id){
		$query  = "SELECT A.*,supplier_name,supplier_location,DATE_FORMAT(d_debitdate ,'%d/%m/%Y') AS d_debitdate,DATE_FORMAT(pR_purchase_date ,'%d/%m/%Y') AS pR_purchase_date
				    FROM purchase_debit_note  A
					JOIN purchase_order ON d_purchaseId = purchaseId
					LEFT JOIN suppliers ON pR_supplier_id = supplier_id
					WHERE debitnoteId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function debitEditProduct($id){
		
		$query = "SELECT A.*,product_name,product_uom_name,product_code
					FROM purchase_debit_note_products A
		 			JOIN products ON dp_product_id = product_id
					JOIN product_uoms ON product_uom_id = product_product_uom_id
					WHERE dp_debitnoteId='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function editReceiptproductChild($id){
		
		 $query = "SELECT *,product_uom_name, product_colour_name
					FROM purchase_debit_note_child_products
					LEFT JOIN product_uoms ON product_uom_id = purchase_debit_note_child_product_uom_id
					LEFT JOIN product_colours ON product_colour_id = purchase_debit_note_child_product_color_id
					WHERE
					purchase_debit_note_child_product_deleted_status = 0 AND
					 purchase_debit_note_child_product_grn_id ='$id'"; 
				//	echo $query; exit;
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function debitdelete(){
	
	
	if(isset($_REQUEST['deleteCheck']))
		{//echo 'sdf54';exit;
			
				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck = $checked[$i]; 
					$ip 	= getRealIpAddr();
					
					
					     $update_addend 	= "UPDATE  purchase_debit_note
									SET 
										d_deleted_status    = '1',
										d_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
		                                d_deleted_on        = UNIX_TIMESTAMP(NOW()),
		                                d_deleted_ip	        = '".$ip."'
								WHERE               
										debitnoteId             	= '".$deleteCheck."' ";
										//print_r($update_overtime);//exit;
				mysql_query($update_addend);
				
				
					
				}	
				header("Location:index.php");
		}else{header("Location:index.php");}
		
	
	
	}

?>
