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
							product_con_entry_child_product_detail_id,
							product_con_entry_child_product_detail_product_con_entry_id,
							product_con_entry_child_product_detail_color_id,
							product_con_entry_child_product_detail_uom_id,
							product_id, product_name, product_code,
							product_type,
							product_uom_name,
							product_colour_id,product_con_entry_child_product_detail_color_id,product_colour_name,
							DATE_FORMAT(pI_invoice_date ,'%d/%m/%Y') pI_invoice_date,
							product_con_entry_child_product_detail_width_inches,
							product_con_entry_child_product_detail_width_mm,
							product_con_entry_child_product_detail_length_mm,
							product_con_entry_child_product_detail_length_feet,
							product_con_entry_child_product_detail_ton_qty,
							product_con_entry_child_product_detail_kg_qty,product_thick_ness,
							piP_rate,
							piP_frgn_rate,piP_product_id
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
							product_uom_id 					= product_product_uom_id 
						LEFT JOIN 
							product_colours 
						ON 
							product_colour_id 				= product_product_colour_id 
				   	WHERE
					   		invoiceId 						= '".$po_id."'		AND
							pI_deleted_status				= 0			
					GROUP BY
							product_con_entry_child_product_detail_id"; 
									  
				 // echo $inv_qry;exit;
			$result = mysql_query($inv_qry);
?>

		<form method="get" name="child_product_list_form" id="child_product_list_form"  >

		<table class="table datatable table-bordered" id="child_product_detail_popup">

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
?>
			<tr class="odd gradeX">
				<td>
					<input type="checkbox" name="chk_child_product_id[]" id="chk_child_product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_id']; ?>" class="prd_checkbox" />
				<input type="hidden" name="product_id[]" id="product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_id']; ?>" />
				<input type="hidden" name="invoiceId[]" id="invoiceId<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['invoiceId']; ?>" />


				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_code']; ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_name']; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_uom_name']; ?>" >
				<input type="hidden" name="product_uom_id" id="product_uom_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_uom_id']; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_colour_name']; ?>" >
				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_color_id']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $arr_thick[$record_so_detail['product_thick_ness']]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >
				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_width_inches']; ?>" >
				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_width_mm']; ?>" >
				
				<input type="hidden" name="product_length_mm" id="product_length_mm<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_length_mm']; ?>" >
				<input type="hidden" name="product_length_feet" id="product_length_feet<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_length_feet']; ?>" >
				<input type="hidden" name="product_ton_qty" id="product_ton_qty<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_ton_qty']; ?>" >
				<input type="hidden" name="product_kg_qty" id="product_kg_qty<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_kg_qty']; ?>" >
				<input type="hidden" name="product_rate" id="product_rate<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['piP_rate']; ?>" >
				<input type="hidden" name="product_frgn_rate" id="product_frgn_rate<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['piP_frgn_rate']; ?>" >
				</td>

				<td><?php echo $record_so_detail['product_code']; ?></td>

				<td><?php echo $record_so_detail['product_name']; ?></td>

				<td><?=$record_so_detail['product_uom_name']?></td>

				<td><?=$record_so_detail['product_colour_name']?></td>

				<td><?=$arr_thick[$record_so_detail['product_thick_ness']]?></td>

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

$('#child_product_detail_popup').DataTable( {

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

