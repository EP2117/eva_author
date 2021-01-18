<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'request_details':requestDetails();
				break;
			case 'child_prod_details':requestDetailsNext(); 
				break;	
			case 'get_prodname':prductList();
				break;
			case 'prod_details':productDetails();
				break;
			case 'po':podetail();
				break;
		}
		
	}
	
	function requestDetails(){
		 $inv_qry	= "	SELECT
							invoiceId,
							invoiceProductId,
							piP_po_qty,
							product_id,
							product_name,
							product_code,
							product_type,
							product_uom_name,
							supplier_name,
							supplier_location,
							DATE_FORMAT(pI_invoice_date ,'%d/%m/%Y') pI_invoice_date,
							received_qty,
							piP_rate
					   	FROM
					   		purchase_invoice
					   	LEFT JOIN
					   		purchase_invoice_products
					   	ON
					   		piP_invoiceId					= invoiceId	AND	piP_deleted_status	= 0
						LEFT JOIN 
							products 
						ON 
							piP_product_id					= product_id
						LEFT JOIN 
							product_uoms 
						ON 
							product_uom_id 					= product_product_uom_id 
					   	LEFT JOIN	
					   		purchase_order 
						ON 
							purchaseId						= pI_purchaseId 
							
						LEFT JOIN 
							suppliers 
						ON 
							pR_supplier_id 					= supplier_id
						LEFT JOIN
							(SELECT
								grnP_podetail_id,
								SUM(grnP_poqty) as received_qty
							 FROM
							 	grn_details_products
							 WHERE
							  	grnP_deleted_status			= 0 
							 GROUP BY
							 	grnP_podetail_id) as grn_prd
						ON
							grnP_podetail_id				= invoiceProductId	
					   	WHERE
					   		invoiceId 						= '".$_REQUEST['poid']."'		AND
							pI_deleted_status				= 0"; 			  
				  echo $inv_qry;exit;
			$result = mysql_query($inv_qry);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	
	function requestDetailsNext(){
		 $inv_qry	= "	SELECT
							invoiceId,
							product_con_entry_child_product_detail_id,
							product_con_entry_child_product_detail_product_con_entry_id,
							product_con_entry_child_product_detail_color_id,
							product_con_entry_child_product_detail_uom_id,
							product_id,
							product_con_entry_child_product_detail_name AS product_name,
							product_con_entry_child_product_detail_code AS product_code,
							product_type,
							product_uom_name,
							supplier_name,
							supplier_location,
							product_colour_id,product_con_entry_child_product_detail_color_id,product_colour_name,
							DATE_FORMAT(pI_invoice_date ,'%d/%m/%Y') pI_invoice_date,
							product_con_entry_child_product_detail_width_inches,
							product_con_entry_child_product_detail_width_mm,
							product_con_entry_child_product_detail_length_mm,
							product_con_entry_child_product_detail_length_feet,
							product_con_entry_child_product_detail_ton_qty,
							product_con_entry_child_product_detail_kg_qty,
							product_con_entry_child_product_detail_thick_ness
					   	FROM
					   		purchase_invoice
						LEFT JOIN 
							purchase_invoice_products
						ON 
							piP_invoiceId		= invoiceId
					   	LEFT JOIN
					   		product_con_entry_child_product_details
					   	ON
					   		product_con_entry_child_product_detail_product_con_entry_id	= invoiceId	AND	product_con_entry_child_product_detail_deleted_status	= 0
						LEFT JOIN 
							products 
						ON 
							piP_product_id					= product_id
						LEFT JOIN 
							product_uoms 
						ON 
							product_uom_id 					= product_con_entry_child_product_detail_uom_id 
						LEFT JOIN 
							suppliers 
						ON 
							supplier_id 					= pI_purchaseId 
						LEFT JOIN 
							product_colours 
						ON 
							product_colour_id 				= product_con_entry_child_product_detail_color_id 
				   	WHERE
					   		invoiceId 						= '".$_REQUEST['poid']."'		AND
							pI_deleted_status				= 0"; 			  
				  //echo $inv_qry;exit;
			$result = mysql_query($inv_qry);
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
	function podetail(){
	
	$branch_id=$_REQUEST['branch_id'];
	
	$query  = "SELECT 
		 				invoiceId,
						invoiceNo,
						supplier_name,
						DATE_FORMAT(pI_invoice_date ,'%d/%m/%Y') AS pI_invoice_date 
						FROM  purchase_invoice
					LEFT JOIN 
						suppliers 
					ON 
						pI_supplier_id = supplier_id
					LEFT JOIN
						(SELECT
							SUM(piP_po_qty+piP_po_ton) as piP_qty,
							 piP_invoiceId
						 FROM
						 	purchase_invoice_products
						 WHERE
						 	piP_deleted_status			= 0
						 GROUP BY 
						 	piP_invoiceId) as po_detail
					ON
						piP_invoiceId		= invoiceId
					LEFT JOIN 
						(SELECT 
							SUM(grn_child_product_detail_ton_qty+grn_child_product_detail_kg_qty) AS inv_qty,
							grn_child_product_detail_invoice_id
						FROM 
							 grn_child_product_details
						WHERE 
							grn_child_product_detail_deleted_status 				= 0  		 						
						GROUP BY 
							grn_child_product_detail_invoice_id) rcv_table
				  ON	
				  		grn_child_product_detail_invoice_id = invoiceId
						
						LEFT JOIN 
						(SELECT 
							SUM(grnP_poqty) AS grn_qty,
							grnP_invoice_id
						FROM 
							 grn_details_products
						WHERE 
							grnP_deleted_status 				= 0  		 						
						GROUP BY 
							grnP_invoice_id) grn_table
				  ON	
				  		grnP_invoice_id = invoiceId
							
		 			WHERE pI_deleted_status = 0  AND
					IFNULL(rcv_table.inv_qty,0) 	< po_detail.piP_qty	
					AND IFNULL(grn_table.grn_qty,0) 	< po_detail.piP_qty	
					AND pI_branchid='".$branch_id."' 				 
					ORDER BY invoiceId DESC";
				//	echo $query; exit;
		$result = mysql_query($query);
		$array_result = "<option> -- Select --</option>";
		
		while($resultData = mysql_fetch_array($result)){
			$array_result .= "<option value='".$resultData['invoiceId']."'>".$resultData['invoiceNo']." - ".$resultData['pI_invoice_date']." - ".$resultData['supplier_name']."</option>";
		}
		
		echo $array_result;
	
	}
	
?>

		