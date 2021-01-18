  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$product_invoice_id	= $_REQUEST['product_invoice_id'];
	$m_id = $_GET['m_id'];
	
   	if($m_id == '') {
   		$m_id = '""';
   	}
  	$select_product 		= "	SELECT  
   									product_invoice_no,
									product_invoice_date,
									product_code,
									product_name,
									product_uom_name,
									product_invoice_product_detail_qty,
									product_invoice_product_detail_id,
									product_invoice_product_detail_product_id,
									sus_table.sus_qty AS received_qty
							 	FROM 
									product_invoice_product_details 
							 	LEFT JOIN 
									product_invoice 
								ON 
									product_invoice_id 													= product_invoice_product_detail_product_invoice_id
							 	LEFT JOIN 
									products 
								ON 
									product_id 															= product_invoice_product_detail_product_id
								LEFT JOIN 
									product_uoms  
								ON 
									product_uom_id 														= product_uom_one_id
								LEFT JOIN 
									(SELECT 
										damage_stock_product_to_detail_product_invoice_detail_id, 
										SUM(damage_stock_product_to_detail_qty) AS sus_qty 
									FROM 
										damage_stock_product_to_details  	
									WHERE 
										damage_stock_product_to_detail_deleted_status 				= 0  					
									GROUP BY 
										damage_stock_product_to_detail_product_invoice_detail_id) sus_table 
								ON 
									damage_stock_product_to_detail_product_invoice_detail_id 		= product_invoice_product_detail_id								 
							 	WHERE 
									product_invoice_product_detail_deleted_status						=	0 												AND
							 	 	product_invoice_product_detail_product_invoice_id 					IN (".$product_invoice_id.")						AND 
							  		product_invoice_product_detail_id 									NOT IN (".$m_id.") 									AND	
									IFNULL( sus_table.sus_qty,0) 										< product_invoice_product_detail_qty				AND									
							 	 	product_invoice_company_id 										= '".$_SESSION[SESS.'_session_company_id']."' ";
									
  $result_product = mysql_query($select_product);
?>
		<form method="get" name="product_list_form" id="product_list_form"  >
		<table class="table datatable table-bordered" id="product_detail_popup">
			<thead>
				<tr>
				  <th width="5%" >#</th>
				  <th width="12%" >Inv.No</th>
				  <th width="10%" >Date</th>	  
				  <th width="12%" >Code</th>
				  <th width="24%" >Product</th>
				  <th width="10%" >UOM1</th>
				  <th width="10%" >Qty</th>
				  <th width="9%" >Receive Qty</th>
				  <th width="9%" >Bal qty</th>
				  </tr>
			</thead>
			<tbody >
<?php
		while ($record_so_detail = mysql_fetch_array($result_product)){
			  $balance_qty = $record_so_detail['product_invoice_product_detail_qty']-$record_so_detail['received_qty'];
?>
			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="product_invoice_product_detail_id[]" id="product_invoice_product_detail_id<?php echo $record_so_detail['product_invoice_product_detail_id'];?>" value="<?php echo $record_so_detail['product_invoice_product_detail_id']; ?>" />
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_invoice_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_name'])); ?>" >
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_invoice_product_detail_id'];?>" value="<?php echo $record_so_detail['product_code']; ?>" >
				<input type="hidden" name="product_uom_name" id="product_uom_name<?php echo $record_so_detail['product_invoice_product_detail_id'];?>" value="<?php echo $record_so_detail['product_uom_name']; ?>" >
				<input type="hidden" name="inv_detail_bal_qty" id="inv_detail_bal_qty<?php echo $record_so_detail['product_invoice_product_detail_id'];?>" value="<?php echo $balance_qty; ?>" >
				<input type="hidden" name="inv_detail_qty" id="inv_detail_qty<?php echo $record_so_detail['product_invoice_product_detail_id'];?>" value="<?php echo $record_so_detail['product_invoice_product_detail_qty']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['product_invoice_product_detail_id'];?>" value="<?php echo $record_so_detail['product_invoice_product_detail_product_id']; ?>" >
				</td>
				<td><?=$record_so_detail['product_invoice_no']?></td>
				<td><?=dateGeneralFormat($record_so_detail['product_invoice_date'])?></td>
				<td><?php echo $record_so_detail['product_code']; ?></td>
				<td><?php echo $record_so_detail['product_name']; ?></td>
				<td><?=$record_so_detail['product_uom_name']?></td>
				<td><?=$record_so_detail['product_invoice_product_detail_qty']?></td>
				<td><?=$record_so_detail['received_qty']?></td>
				<td><?=$balance_qty?></td>
			</tr>
<?php  } ?>
			</tbody>
		</table>
		</form>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$('#product_detail_popup').DataTable( {
					responsive: true
} );
</script>