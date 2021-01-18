  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$po_id = $_REQUEST['po_id'];
	$m_id = $_GET['m_id'];
   	if($m_id == '') {
   		$m_id = '""';
   	}
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
							piP_rate,
							piP_frgn_rate,
							piP_feet_per_qty ,
							product_colour_name,
							product_thick_ness,
							piP_po_ton,
							pR_rate 
							 
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
							product_uom_id 					= product_purchase_uom_id 
						LEFT JOIN 
							product_colours 
						ON 
							product_colour_id 					= product_product_colour_id
					   	LEFT JOIN	
					   		purchase_order 
						ON 
							purchaseId						= pI_purchaseId 
							
						LEFT JOIN 
							suppliers 
						ON 
							pR_supplier_id 					= supplier_id
						
					   	WHERE
					   		invoiceId 						= '".$po_id."'		AND
							product_type					IN('2','3')				AND
							pI_deleted_status				= 0"; 			  
				  
			$result = mysql_query($inv_qry);
		//echo $inv_qry;
?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#<input type="checkbox" name="All_check" id="All_check" class="check_all" onclick="GetCheck()" /></th>

				  <th width="12%" >Code</th>

				  <th width="24%" >Product</th>

				  <th width="10%" >UOM</th>

				  <th width="10%" >Color</th>

				  <th width="10%" >Thick</th>

				  </tr>

			</thead>

			<tbody >

<?php
		while ($record_so_detail = mysql_fetch_array($result)){
		$piP_po_qty	= ($record_so_detail['piP_po_qty']>0)?$record_so_detail['piP_po_qty']:$record_so_detail['piP_po_ton'];
?>
			<tr class="odd gradeX">
				<td>
					<input type="checkbox" name="chk_product_id[]" id="chk_product_id<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['invoiceProductId']; ?>"  class="prd_checkbox" />
				<input type="hidden" name="product_id[]" id="product_id<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_id']; ?>" />
				<input type="hidden" name="invoiceId[]" id="invoiceId<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['invoiceId']; ?>" />


				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_code']; ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_name']; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_uom_name']; ?>" >

				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_colour_name']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['invoiceProductId'];?>" value="" >
				<input type="hidden" name="product_inches" id="product_inches<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['product_inches_qty']; ?>" >
				<input type="hidden" name="brand_name" id="brand_name<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['brand_name']; ?>" >
				
				<input type="hidden" name="piP_rate" id="piP_rate<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['piP_rate']; ?>" >
				<input type="hidden" name="pR_rate" id="pR_rate<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['pR_rate']; ?>" >
				<input type="hidden" name="piP_frgn_rate" id="piP_frgn_rate<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['piP_frgn_rate']; ?>" >
				<input type="hidden" name="piP_po_qty" id="piP_po_qty<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $piP_po_qty; ?>" >
				<input type="hidden" name="piP_feet_per_qty" id="piP_feet_per_qty<?php echo $record_so_detail['invoiceProductId'];?>" value="<?php echo $record_so_detail['piP_feet_per_qty']; ?>" >
				</td>

				<td><?php echo $record_so_detail['product_code']; ?></td>

				<td><?php echo $record_so_detail['product_name']; ?></td>

				<td><?=$record_so_detail['product_uom_name']?></td>

				<td><?=$record_so_detail['product_colour_name']?></td>

				<td><?=$record_so_detail['product_thick_ness']?></td>

			</tr>

<?php  } 

 ?>
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
function GetCheck(){
	if(document.getElementById('All_check').checked==true){
		$('.prd_checkbox').each(function(){ this.checked = true; });
	}
	else{
		$('.prd_checkbox').each(function(){ this.checked = false; });
	}
}

</script>

