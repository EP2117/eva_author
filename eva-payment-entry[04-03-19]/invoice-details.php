<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'get_invoice':invoiceList();
				break;
			case 'invoice_details':invoicetDetails();
				break;
		}
		
	}
	
	
	function invoiceList(){
		$val   = $_REQUEST['val'];
	    $query = "SELECT 
						invoiceNo 
					FROM 
						purchase_invoice 
					LEFT JOIN 
						(SELECT 
							pi_invoiceId, 
							SUM(pi_amount) AS rcv_amount 
						FROM 
							purchase_payment_details  	
						WHERE 
							pi_deleted_status 				= 0  					
						GROUP BY 
							pi_invoiceId) rcv_table 
					ON 
						pi_invoiceId 									= invoiceId								 
				 	WHERE 
						invoiceNo 										LIKE '%$val%' 															AND 
						pI_deleted_status 								= 0 																	AND
						IFNULL(rcv_table.rcv_amount,0) 					< pI_net_total
					LIMIT 15";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function invoicetDetails(){
	
		  $query = "SELECT invoiceId,pI_net_total,pR_advanceAmnt,IFNULL((SELECT SUM(pi_amount) FROM purchase_payment_details WHERE pi_invoiceId='".$_REQUEST['id']."'),0) AS paidamount
					 FROM purchase_invoice 
					 LEFT JOIN purchase_order ON pR_branchid = purchaseId
					 WHERE invoiceNo='".$_REQUEST['id']."' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}	
	
?>

		