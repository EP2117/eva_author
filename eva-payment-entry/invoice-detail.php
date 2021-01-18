  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');
	$m_id = $_GET['m_id'];
	$supplier_name = $_GET['supplier_name'];
   	if($m_id == '') {
   		$m_id = '""';
   	}
   		   $select_product 			= "	SELECT 
											a.*,
											pR_currency_id,
											pR_advanceAmnt,
											pR_advance_amount,
											rcv_amount,
											rcv_amount_cur,
											dn_rcv_amount,
											dn_rcv_amount_cur,
											pR_supplier_id,
											dnp_rcv_amount, 
											dnp_rcv_amount_cur
										FROM 
											purchase_invoice  a
										LEFT JOIN 
											(SELECT 
												pi_invoiceId, 
												SUM(pi_amount+pi_descount_amt) AS rcv_amount,
												SUM(pi_amount_cur) AS rcv_amount_cur
											FROM 
												purchase_payment_details  	
											WHERE 
												pi_deleted_status 				= 0  					
											GROUP BY 
												pi_invoiceId) rcv_table 
										ON 
											pi_invoiceId 							= invoiceId
										LEFT JOIN 
											(SELECT 
												dn_entry_invoice_id, 
												SUM(dne_child_detail_amount) AS dn_rcv_amount,
												SUM(dne_child_detail_amount_cur) AS dn_rcv_amount_cur
											FROM 
												dn_entry_child_details
											LEFT JOIN
												 dn_entry
											ON
												 dn_entry_id									= dne_child_detail_dn_entry_id 	
											WHERE 
												dne_child_detail_deleted_status 				= 0  					
											GROUP BY 
												dn_entry_invoice_id) dn_table 
										ON 
											dn_entry_invoice_id 								= invoiceId	
										LEFT JOIN 
											(SELECT 
												dn_entry_product_detail_invoice_id, 
												SUM(dn_entry_product_detail_tot_amount) AS dnp_rcv_amount,
												SUM(dn_entry_product_detail_tot_amount_cur) AS dnp_rcv_amount_cur
											FROM 
												dn_entry_product_details
											LEFT JOIN
												 dn_entry
											ON
												 dn_entry_id									= dn_entry_product_detail_invoice_id 	
											WHERE 
												dn_entry_product_detail_deleted_status			= 0  					
											GROUP BY 
												dn_entry_product_detail_invoice_id) dnp_table 
										ON 
											dn_entry_product_detail_invoice_id 					= invoiceId		
										LEFT JOIN
											purchase_order
										ON
											purchaseId							= pI_purchaseId 						 
										WHERE 
											pI_deleted_status 						= 0 			AND
											pI_supplier_id							= '".$supplier_name."' AND
											(IFNULL(rcv_table.rcv_amount+dn_table.dn_rcv_amount+dnp_table.dnp_rcv_amount+pR_advanceAmnt,0) 		< pI_invoicetotal OR IFNULL(rcv_table.rcv_amount_cur+dn_table.dn_rcv_amount_cur+dnp_table.dnp_rcv_amount_cur+pR_advanceAmnt,0) 	< pI_invoice_total_amt)";//exit;

	$result_product = mysql_query($select_product);

  

?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#</th>

				  <th width="12%" >Invoice No</th>

				  <th width="24%" >Adv Amt</th>
				  <th width="24%" >Net Amt</th>

				  <th width="10%" >Paid Amt</th>

				  <th width="10%" >Blns Amt</th>

				 

				  </tr>

			</thead>

			<tbody >

<?php

		while ($record_so_detail = mysql_fetch_array($result_product)){
			if($record_so_detail['pR_currency_id']>0){
				$type	= 1;
				$rcv_amount			= ($record_so_detail['rcv_amount_cur']!='')?$record_so_detail['rcv_amount_cur']:0.00;
				
				$pI_invoicetotal		= $record_so_detail['pI_invoicetotal'];
				$advane_amt			= $record_so_detail['pR_advanceAmnt'];
				$balance_amt		= $pI_invoicetotal-($record_so_detail['rcv_amount']+$advane_amt+$record_so_detail['rcv_amount']);
			}
			else{
				$type	= 2;
				$rcv_amount		= $record_so_detail['rcv_amount'];
				$pI_invoicetotal	= $record_so_detail['pI_invoicetotal'];
				$advane_amt			= $record_so_detail['pR_advanceAmnt'];
				$balance_amt		= $pI_invoicetotal-($record_so_detail['rcv_amount']+$advane_amt);
				
			}
			
			$rcv_amount_cur			= ($record_so_detail['rcv_amount_cur']!='')?$record_so_detail['rcv_amount_cur']:0.00;
			$rcv_amount				= ($record_so_detail['rcv_amount']!='')?$record_so_detail['rcv_amount']:0.00;
			
			$dn_rcv_amount_cur		= ($record_so_detail['dn_rcv_amount_cur']!='')?($record_so_detail['dn_rcv_amount_cur']):0.00;
			$dn_rcv_amount			= ($record_so_detail['dn_rcv_amount']!='')?($record_so_detail['dn_rcv_amount']):0.00;
			
			$dnp_rcv_amount_cur		= ($record_so_detail['dnp_rcv_amount_cur']!='')?($record_so_detail['dnp_rcv_amount_cur']):0.00;
			$dnp_rcv_amount			= ($record_so_detail['dnp_rcv_amount']!='')?($record_so_detail['dnp_rcv_amount']):0.00;
			
			$rcv_amount_cur			= $rcv_amount_cur+$dn_rcv_amount_cur+$dnp_rcv_amount_cur;
			$rcv_amount				= $rcv_amount+$dn_rcv_amount+$dnp_rcv_amount;
			$balance_amt		= $record_so_detail['pI_invoicetotal']-$rcv_amount;
			
?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" name="invoiceId[]" id="invoiceId<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['invoiceId']; ?>" />
				
				<input type="hidden" name="invoiceNo[]" id="invoiceNo<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['invoiceNo']; ?>" />
				<input type="hidden" name="pR_advanceAmnt[]" id="pR_advanceAmnt<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['pR_advanceAmnt']; ?>" />

				<input type="hidden" name="pI_invoice_mmk[]" id="pI_invoice_mmk<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['pI_invoicetotal']; ?>" />
				<input type="hidden" name="pI_invoice_frgn[]" id="pI_invoice_frgn<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['pI_invoice_total_amt']; ?>" />
				<input type="hidden" name="pI_advance_mmk[]" id="pI_advance_mmk<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['pR_advanceAmnt']; ?>" />
				<input type="hidden" name="pI_advance_frgn[]" id="pI_advance_frgn<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['pR_advance_amount']; ?>" />
		<input type="hidden" name="pR_supplier_id[]" id="pR_supplier_id<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['pR_supplier_id']; ?>" />
				
				<input type="hidden" name="rcv_amount[]" id="rcv_amount<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $rcv_amount; ?>" >
				<input type="hidden" name="rcv_amount_cur[]" id="rcv_amount_cur<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $rcv_amount_cur; ?>" >

				<input type="hidden" name="blan_name[]" id="blan_name<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $record_so_detail['pI_invoicetotal'] -$record_so_detail['rcv_amount']; ?>" >
				<input type="hidden" name="invoice_type[]" id="invoice_type<?php echo $record_so_detail['invoiceId'];?>" value="<?php echo $type; ?>" >
				

				</td>

				<td><?php echo $record_so_detail['invoiceNo']; ?></td>
				<td><?php echo $advane_amt; ?></td>

				<td><?php echo $pI_invoicetotal; ?></td>

				<td><?=$rcv_amount?></td>

				<td><?=$balance_amt?></td>


			</tr>

<?php  }?>

		
			</tbody>

		</table>

		</form>

<?php 

function invoicetDetails($id,$no){
	
		   $query = "SELECT invoiceId,pI_invoicetotal,pR_advanceAmnt,IFNULL((SELECT SUM(pi_amount) FROM purchase_payment_details WHERE pi_invoiceId='".$id."'),0) AS paidamount
					 FROM purchase_invoice 
					 LEFT JOIN purchase_order ON pR_branchid = purchaseId
					 WHERE invoiceNo='".$no."'  AND pI_deleted_status=0";
			$result = mysql_query($query);
			$response =array();
			$resultData = mysql_fetch_array($result);	 
				
		echo $resultData['pR_advanceAmnt'];
	}
?>

<!-- DataTables -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$('#product_detail_popup').DataTable( {

					responsive: true

} );

</script>