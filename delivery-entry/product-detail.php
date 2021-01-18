  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$invoice_entry_id	= $_REQUEST['invoice_entry_id'];

	$m_id = $_GET['m_id'];

	

   	if($m_id == '') {

   		$m_id = '""';

   	}

   		 $select_product 			= "	SELECT  
											invoice_entry_no,
											invoice_entry_date,
											invoice_entry_product_detail_qty,
											invoice_entry_product_detail_id,
											invoice_entry_product_detail_product_id,
											invoice_entry_product_detail_width_inches,invoice_entry_product_detail_width_mm,
											invoice_entry_product_detail_sale_length, invoice_entry_product_detail_s_width_inches,invoice_entry_product_detail_s_width_mm,
											invoice_entry_product_detail_sl_feet,invoice_entry_product_detail_sl_feet_in,
											invoice_entry_product_detail_sl_feet_mm,invoice_entry_product_detail_sl_feet_met,
											invoice_entry_product_detail_s_weight_inches,
											invoice_entry_product_detail_s_weight_mm,invoice_entry_product_detail_tot_length,
											invoice_entry_product_detail_rate,
											invoice_entry_product_detail_total,
											invoice_entry_product_detail_product_thick as product_thick_ness,
											invoice_entry_product_detail_sale_by,
											invoice_entry_product_detail_sale_feet,
											invoice_entry_type,
											product_name,
											product_is_opp,
											product_code,
											p_uom.product_uom_name as p_uom_name,
											p_clr.product_colour_name as p_colour_name,
											a_clr.product_colour_name as a_colour_name,
											i_clr.product_colour_name as i_colour_name,
											brand_name,
											inv_table.inv_qty AS received_qty,
											invoice_entry_type_id,
											invoice_entry_product_detail_entry_type	
										FROM 
											invoice_entry_product_details 
										LEFT JOIN 
											invoice_entry 
										ON 
											invoice_entry_id 							= invoice_entry_product_detail_invoice_entry_id
										LEFT JOIN 
											product_colours as i_clr 
										ON 
											i_clr.product_colour_id 					= invoice_entry_product_detail_color_id
										LEFT JOIN 
											quotation_entry_product_details 
										ON 
											quotation_entry_product_detail_id 			= invoice_entry_product_detail_quotation_detail_id
										LEFT JOIN 
											product_colours as p_clr 
										ON 
											p_clr.product_colour_id 					= quotation_entry_product_detail_product_color_id
										LEFT JOIN 
											advance_entry_product_details 
										ON 
											advance_entry_product_detail_id 			= invoice_entry_product_detail_quotation_detail_id
										LEFT JOIN 
											product_colours as a_clr 
										ON 
											a_clr.product_colour_id 					= advance_entry_product_detail_product_color_id
										LEFT JOIN 
											products 
										ON 
											product_id 									= invoice_entry_product_detail_product_id
										LEFT JOIN 
											product_uoms as p_uom
										ON 
											p_uom.product_uom_id 						= product_purchase_uom_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 									= product_brand_id
											LEFT JOIN 
											(SELECT 
												delivery_entry_product_detail_invoice_detail_id	, 
												SUM(delivery_entry_product_detail_qty) AS inv_qty 
											FROM 
												delivery_entry_product_details  	
											WHERE 
												delivery_entry_product_detail_deleted_status 				= 0  					
											GROUP BY 
												delivery_entry_product_detail_invoice_detail_id	) inv_table 
										ON 
											 	delivery_entry_product_detail_invoice_detail_id 	= invoice_entry_product_detail_id		
											
										WHERE 
											invoice_entry_product_detail_deleted_status				=	0 											AND
											invoice_entry_product_detail_invoice_entry_id 			IN (".$invoice_entry_id.")							AND 
											invoice_entry_product_detail_id 						NOT IN (".$m_id.") 								AND	
											IFNULL(inv_table.inv_qty,0) 							< (invoice_entry_product_detail_qty+invoice_entry_product_detail_s_weight_inches)			AND	
											invoice_entry_company_id 								= '".$_SESSION[SESS.'_session_company_id']."' "; //exit;

	
	//echo $select_product; exit;
	$result_product = mysql_query($select_product);

  

?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#<input type="checkbox" name="All_check" id="All_check" class="check_all" onclick="GetCheck()" /></th>

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
			  $balance_qty = $record_so_detail['invoice_entry_product_detail_qty'] - $record_so_detail['received_qty'];
									
					$product_code			= $record_so_detail['product_code'];
					$product_name			= $record_so_detail['product_name'];
					$product_uom_name		= $record_so_detail['p_uom_name'];
					
					if($record_so_detail['invoice_entry_type']==1){
						$product_colour_name	= $record_so_detail['p_colour_name'];
					}
					elseif($record_so_detail['invoice_entry_type']==2){
						$product_colour_name	= $record_so_detail['a_colour_name'];
					}
					else{
						$product_colour_name	= $record_so_detail['i_colour_name'];
					}
			
?>

			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_id']; ?>"  class="prd_checkbox" />
				
				<input type="hidden" name="product_is_opp" id="product_is_opp<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['product_is_opp']; ?>" >
				<input type="hidden" name="product_sale_by" id="product_sale_by<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_sale_by']; ?>" >
				<input type="hidden" name="product_sale_feet" id="product_sale_feet<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_sale_feet']; ?>" >
				
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $product_code; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $product_uom_name; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $product_colour_name; ?>" >
				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['brand_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $arr_thick[$record_so_detail['product_thick_ness']]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_s_width_inches" id="product_s_width_inches<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_s_width_mm" id="product_s_width_mm<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_s_width_mm']; ?>" />
				
				<input type="hidden" name="product_sale_length" id="product_sale_length<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo htmlspecialchars($record_so_detail['invoice_entry_product_detail_sale_length']); ?>" />

				<input type="hidden" name="product_sl_feet" id="product_sl_feet<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_sl_feet']; ?>" />

				<input type="hidden" name="product_sl_feet_in" id="product_sl_feet_in<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_sl_feet_in']; ?>" />
				
				<input type="hidden" name="product_sl_feet_mm" id="product_sl_feet_mm<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_sl_feet_mm']; ?>" />
				<input type="hidden" name="product_sl_feet_met" id="product_sl_feet_met<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_sl_feet_met']; ?>" />
				
				<input type="hidden" name="product_s_weight_inches" id="product_s_weight_inches<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_s_weight_mm" id="product_s_weight_mm<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_s_weight_mm']; ?>" />
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_tot_length']; ?>" />
				<input type="hidden" name="product_rate" id="product_rate<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_rate']; ?>" />
				<input type="hidden" name="product_total_amt" id="product_total_amt<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_total']; ?>" />

				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $balance_qty; ?>" />
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail['invoice_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['invoice_entry_product_detail_entry_type']; ?>" />
				</td>
				<td><?=$record_so_detail['invoice_entry_no']?></td>
				<td><?=dateGeneralFormat($record_so_detail['invoice_entry_date'])?></td>
				<td><?php echo $product_code; ?></td>
				<td><?php echo $product_name; ?></td>
				<td><?=$product_uom_name?></td>
				<td><?=$record_so_detail['invoice_entry_product_detail_qty']?></td>
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
function GetCheck(){
	if(document.getElementById('All_check').checked==true){
		$('.prd_checkbox').each(function(){ this.checked = true; });
	}
	else{
		$('.prd_checkbox').each(function(){ this.checked = false; });
	}
}
</script>
