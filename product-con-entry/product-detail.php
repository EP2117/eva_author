  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$purchase_invoice_id	= $_REQUEST['purchase_invoice_id'];
	$m_id = $_GET['m_id'];
   	if($m_id == '') {
   		$m_id = '""';
   	}

   	$select_product 			= "	SELECT  
											invoiceNo,
											pI_invoice_date	,
											product_code,
											product_name,
											product_uom_name,
											product_colour_name,
											piP_po_qty,
											invoiceProductId,
											piP_product_id,
											product_thick_ness
										FROM 
											purchase_invoice_products 
										LEFT JOIN 
											purchase_invoice 
										ON 
											invoiceId 								= piP_invoiceId
										LEFT JOIN 
											products 
										ON 
											product_id 								= piP_product_id
										LEFT JOIN 
											product_uoms 
										ON 
											product_uom_id 							= product_product_uom_id
										LEFT JOIN 
											product_colours 
										ON 
											product_colour_id 						= product_product_colour_id
										WHERE 
											invoiceProductId 						NOT IN (".$m_id.")						AND
											piP_invoiceId							= '".$purchase_invoice_id."' ";
	$result_product = mysql_query($select_product);
?>

		<form method="get" name="product_list_form" id="product_list_form"  >
		<table class="table datatable table-bordered" id="product_detail_popup">
			<thead>
				<tr>
				  <th width="5%" >#</th>
				  <th width="12%" >SO.No</th>
				  <th width="10%" >Date</th>	  
				  <th width="12%" >Code</th>
				  <th width="24%" >Product</th>
				  <th width="10%" >UOM</th>
				  <th width="9%" >SO Qty </th>
				  <th width="10%" >DC Qty </th>
				  <th width="8%" >Balance Qty </th>
				  </tr>
			</thead>

			<tbody >

<?php

		while ($record_so_detail = mysql_fetch_array($result_product)){

			  $balance_qty = $record_so_detail['piP_po_qty'] - 0;

?>

			<tr class="odd gradeX">

				<td>

				<input type="radio" name="invoiceProductId[]" id="invoiceProductId<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['invoiceProductId']; ?>" />

				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_name'])); ?>" >

				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_code']; ?>" >

				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_uom_name']; ?>" >

				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_colour_name']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >

				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['piP_product_id']; ?>" >
				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $balance_qty; ?>" />

				</td>

				<td><?=$record_so_detail['invoiceNo']?></td>

				<td><?=dateGeneralFormat($record_so_detail['pI_invoice_date'])?></td>

				<td><?php echo $record_so_detail['product_code']; ?></td>

				<td><?php echo $record_so_detail['product_name']; ?></td>

				<td><?=$record_so_detail['product_uom_name']?></td>

				<td><?=$record_so_detail['piP_po_qty']?></td>

				<td>0.00</td>

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

