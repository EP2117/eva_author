  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$quotation_entry_id	= $_REQUEST['quotation_entry_id'];
	$entry_type			= $_REQUEST['entry_type'];
	$product_type_id	= $_REQUEST['product_type_id'];
	if($entry_type=="1"){
	$m_id = $_GET['m_id'];

	

   	if($m_id == '') {

   		$m_id = '""';

   	}

   		 $select_product 			= "	SELECT  
											quotation_entry_no,
											quotation_entry_date,
											quotation_entry_product_detail_qty,
											quotation_entry_product_detail_id,
											quotation_entry_product_detail_product_id,
											product_thick_ness,
											p_uom.product_uom_name as p_uom_name,
											p_clr.product_colour_name as p_colour_name,
											inv_table.inv_qty AS received_qty,
											product_inches_qty,
											quotation_entry_product_detail_width_inches,
											quotation_entry_product_detail_width_mm,
											quotation_entry_product_detail_s_width_inches,
											quotation_entry_product_detail_s_width_mm,
											quotation_entry_product_detail_sl_feet,
											quotation_entry_product_detail_sl_feet_in,
											quotation_entry_product_detail_sl_feet_mm,
											quotation_entry_product_detail_sl_feet_met,
											quotation_entry_product_detail_s_weight_inches,
											quotation_entry_product_detail_s_weight_mm,
											quotation_entry_product_detail_tot_length,
											quotation_entry_product_detail_rate,
											quotation_entry_product_detail_total,
											quotation_entry_product_detail_qty,
											quotation_entry_product_detail_product_type,
											quotation_entry_product_detail_s_weight_met,
											brand_name,
											p_uom.product_uom_name as p_uom_name,
											p_clr.product_colour_name as p_colour_name,
											inv_table.inv_qty AS received_qty,
											product_code,
											product_name,
											quotation_entry_product_detail_product_thick,
											quotation_entry_product_detail_product_color_id,
											quotation_entry_product_detail_entry_type,
											quotation_entry_product_detail_mother_child_type
										FROM 
											quotation_entry_product_details 
										LEFT JOIN 
											quotation_entry 
										ON 
											quotation_entry_id 												= quotation_entry_product_detail_quotation_entry_id
										LEFT JOIN 
											products 
										ON 
											product_id 												= quotation_entry_product_detail_product_id
										LEFT JOIN 
											product_uoms as p_uom
										ON 
											p_uom.product_uom_id 									= product_product_uom_id
										LEFT JOIN 
											product_colours as p_clr 
										ON 
											p_clr.product_colour_id 								= quotation_entry_product_detail_product_color_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 														= quotation_entry_product_detail_product_brand_id	
										
										LEFT JOIN 
											(SELECT 
												invoice_entry_product_detail_quotation_detail_id, 
												SUM(invoice_entry_product_detail_qty+invoice_entry_product_detail_s_weight_inches) AS inv_qty 
											FROM 
												invoice_entry_product_details
											LEFT JOIN
												invoice_entry
											ON
												invoice_entry_id											= 	 	invoice_entry_product_detail_invoice_entry_id	
											WHERE 
												invoice_entry_product_detail_deleted_status 				= 0	AND
												invoice_entry_type											= '1') as   inv_table					
										ON 
											inv_table.invoice_entry_product_detail_quotation_detail_id 		= quotation_entry_product_detail_id								 
										WHERE 
											quotation_entry_product_detail_deleted_status					=	0 											AND
											quotation_entry_product_detail_mother_child_type				=1												AND
											quotation_entry_product_detail_quotation_entry_id 				IN (".$quotation_entry_id.")					AND 
											quotation_entry_product_detail_id 								NOT IN (".$m_id.") 								AND	
											IFNULL(inv_table.inv_qty,0) 									< (quotation_entry_product_detail_qty+quotation_entry_product_detail_s_weight_inches)			AND									
											quotation_entry_company_id 										= '".$_SESSION[SESS.'_session_company_id']."' ";

	
//echo $select_product;exit;
	$result_product = mysql_query($select_product);

  

?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" ># <input type="checkbox" name="All_check" id="All_check" class="check_all" onclick="GetCheck()" /></th>

				  <th width="12%" >QT.No</th>

				  <th width="10%" >Date</th>	  

				  <th width="12%" >Code</th>

				  <th width="24%" >Product</th>

				  <th width="10%" >UOM</th>

				  <th width="9%" >AD Qty </th>

				  <th width="10%" >DC Qty </th>

				  <th width="8%" >Balance Qty </th>

				  </tr>

			</thead>

			<tbody >

<?php

		while ($record_so_detail = mysql_fetch_array($result_product)){
			$balance_qty = $record_so_detail['quotation_entry_product_detail_qty'] - $record_so_detail['received_qty'];
				/*if($record_so_detail['quotation_entry_product_detail_product_type']==1){*/
					$product_code			= $record_so_detail['product_code'];
					$product_name			= $record_so_detail['product_name'];
					$product_uom_name		= $record_so_detail['p_uom_name'];
					$product_colour_name	= $record_so_detail['p_colour_name'];
					$product_type_id		= $record_so_detail['quotation_entry_product_detail_entry_type'];
				/*}
				else{
					$product_code			= $record_so_detail['product_con_entry_child_product_detail_code'];
					$product_name			= $record_so_detail['product_con_entry_child_product_detail_name'];
					$product_uom_name		= $record_so_detail['c_uom_name'];
					$product_colour_name	= $record_so_detail['c_colour_name'];
				}*/
?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" name="quotation_entry_product_detail_id[]" id="quotation_entry_product_detail_id<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_id']; ?>1"  class="prd_checkbox"/>
				<input type="hidden" name="detail_id" id="detail_id<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_id']; ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >

			<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $product_code ?>" >
			<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $product_uom_name ?>" >
		<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $product_colour_name ?>" >
		<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_product_color_id']; ?>" >
		<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['brand_name'] ?>" >
	<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $arr_thick[number_format($record_so_detail['quotation_entry_product_detail_product_thick'])]; ?>"  >
	<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_product_thick']; ?>"  >

				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_product_id']; ?>" >

				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_s_width_inches" id="product_s_width_inches<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_s_width_mm" id="product_s_width_mm<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_s_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="product_sl_feet<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_sl_feet']; ?>" />

				<input type="hidden" name="product_sl_feet_in" id="product_sl_feet_in<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_sl_feet_in']; ?>" />
				
				<input type="hidden" name="product_sl_feet_mm" id="product_sl_feet_mm<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_sl_feet_mm']; ?>" />
				<input type="hidden" name="product_sl_feet_met" id="product_sl_feet_met<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_sl_feet_met']; ?>" />
				<input type="hidden" name="product_s_weight_inches" id="product_s_weight_inches<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_s_weight_mm" id="product_s_weight_mm<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_s_weight_mm']; ?>" />
                <input type="hidden" name="product_s_weight_met" id="product_s_weight_met<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_s_weight_met']; ?>" />
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo round($record_so_detail['quotation_entry_product_detail_tot_length']); ?>" />
				<input type="hidden" name="product_rate" id="product_rate<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo round($record_so_detail['quotation_entry_product_detail_rate']); ?>" />
				
				
				<input type="hidden" name="product_total_amt" id="product_total_amt<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo round($record_so_detail['quotation_entry_product_detail_total']); ?>" />

				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo round($balance_qty); ?>" />
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $product_type_id; ?>" />
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_product_type']; ?>" />
                 <input type="hidden" name="mother_child_type" id="mother_child_type<?php echo $record_so_detail['quotation_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['quotation_entry_product_detail_mother_child_type']; ?>" />
				</td>

				<td><?=$record_so_detail['quotation_entry_no']?></td>

				<td><?=dateGeneralFormatN($record_so_detail['quotation_entry_date'])?></td>

				<td><?php echo $product_code ?></td>

				<td><?php echo $product_name ?></td>

				<td><?=$record_so_detail['p_uom_name']?></td>

				<td><?=round($record_so_detail['quotation_entry_product_detail_qty'])?></td>

				<td><?=round($record_so_detail['received_qty'])?></td>

				<td><?=round($balance_qty)?></td>

			</tr>

<?php  } ?>
<?php 
   		 $select_product1 			= "	SELECT  
											quotation_entry_no,
											quotation_entry_date,
											quotation_entry_product_detail_qty,
											quotation_entry_product_detail_id,
											quotation_entry_product_detail_product_id,
											quotation_entry_product_detail_product_thick as product_thick_ness,
											p_uom.product_uom_name as p_uom_name,
											p_clr.product_colour_name as p_colour_name,
											inv_table.inv_qty AS received_qty,
											
											quotation_entry_product_detail_width_inches,
											quotation_entry_product_detail_width_mm,
											quotation_entry_product_detail_s_width_inches,
											quotation_entry_product_detail_s_width_mm,
											quotation_entry_product_detail_sl_feet,
											quotation_entry_product_detail_sl_feet_in,
											quotation_entry_product_detail_sl_feet_mm,
											quotation_entry_product_detail_sl_feet_met,
											quotation_entry_product_detail_s_weight_inches,
											quotation_entry_product_detail_s_weight_mm,
											quotation_entry_product_detail_tot_length,
											quotation_entry_product_detail_rate,
											quotation_entry_product_detail_total,
											quotation_entry_product_detail_qty,
											quotation_entry_product_detail_product_type,
											quotation_entry_product_detail_s_weight_met,
											brand_name,
											inv_table.inv_qty AS received_qty,
											product_con_entry_child_product_detail_code as product_code,
											product_con_entry_child_product_detail_name as product_name,
											quotation_entry_product_detail_product_thick,
											quotation_entry_product_detail_product_color_id,
											quotation_entry_product_detail_entry_type,
											quotation_entry_product_detail_mother_child_type
										FROM 
											quotation_entry_product_details 
										LEFT JOIN 
											quotation_entry 
										ON 
											quotation_entry_id 												= quotation_entry_product_detail_quotation_entry_id
										LEFT JOIN 
											product_con_entry_child_product_details 
										ON 
											product_con_entry_child_product_detail_id 						= quotation_entry_product_detail_product_id
										LEFT JOIN 
											product_uoms as p_uom
										ON 
											p_uom.product_uom_id 									= product_con_entry_child_product_detail_uom_id
										LEFT JOIN 
											product_colours as p_clr 
										ON 
											p_clr.product_colour_id 								= quotation_entry_product_detail_product_color_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 														= quotation_entry_product_detail_product_brand_id	
										
										LEFT JOIN 
											(SELECT 
												invoice_entry_product_detail_quotation_detail_id, 
												SUM(invoice_entry_product_detail_qty+invoice_entry_product_detail_s_weight_inches) AS inv_qty 
											FROM 
												invoice_entry_product_details
											LEFT JOIN
												invoice_entry
											ON
												invoice_entry_id											= 	 	invoice_entry_product_detail_invoice_entry_id	
											WHERE 
												invoice_entry_product_detail_deleted_status 				= 0	AND
												invoice_entry_type											= '1') as   inv_table					
										ON 
											inv_table.invoice_entry_product_detail_quotation_detail_id 		= quotation_entry_product_detail_id								 
										WHERE 
											quotation_entry_product_detail_deleted_status					=	0 											AND
											quotation_entry_product_detail_mother_child_type				=2												AND
											quotation_entry_product_detail_quotation_entry_id 				IN (".$quotation_entry_id.")					AND 
											quotation_entry_product_detail_id 								NOT IN (".$m_id.") 								AND	
											IFNULL(inv_table.inv_qty,0) 									< (quotation_entry_product_detail_qty+quotation_entry_product_detail_s_weight_inches)			AND									
											quotation_entry_company_id 										= '".$_SESSION[SESS.'_session_company_id']."' ";

	//echo $select_product1;exit;

	$result_product1 = mysql_query($select_product1);

  

?>


<?php

		while ($record_so_detail1 = mysql_fetch_array($result_product1)){
			$balance_qty = $record_so_detail1['quotation_entry_product_detail_qty'] - $record_so_detail1['received_qty'];
					$product_code			= $record_so_detail1['product_code'];
					$product_name			= $record_so_detail1['product_name'];
					$product_uom_name		= $record_so_detail1['p_uom_name'];
					$product_colour_name	= $record_so_detail1['p_colour_name'];
					$product_type_id		= $record_so_detail1['quotation_entry_product_detail_entry_type'];
				
?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" name="quotation_entry_product_detail_id[]" id="quotation_entry_product_detail_id<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_id']; ?>2"  class="prd_checkbox"/>
				<input type="hidden" name="detail_id" id="detail_id<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_id']; ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >

			<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $product_code ?>" >
			<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $product_uom_name ?>" >
		<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $product_colour_name ?>" >
		<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_product_color_id']; ?>" >
		<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['brand_name'] ?>" >
	<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $arr_thick[number_format($record_so_detail1['quotation_entry_product_detail_product_thick'])]; ?>"  >
	<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_product_thick']; ?>"  >

				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_product_id']; ?>" >

				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_s_width_inches" id="product_s_width_inches<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_s_width_mm" id="product_s_width_mm<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_s_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="product_sl_feet<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_sl_feet']; ?>" />

				<input type="hidden" name="product_sl_feet_in" id="product_sl_feet_in<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_sl_feet_in']; ?>" />
				
				<input type="hidden" name="product_sl_feet_mm" id="product_sl_feet_mm<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_sl_feet_mm']; ?>" />
				<input type="hidden" name="product_sl_feet_met" id="product_sl_feet_met<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_sl_feet_met']; ?>" />
				<input type="hidden" name="product_s_weight_inches" id="product_s_weight_inches<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_s_weight_mm" id="product_s_weight_mm<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_s_weight_mm']; ?>" />
                <input type="hidden" name="product_s_weight_met" id="product_s_weight_met<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_s_weight_met']; ?>" />
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo round($record_so_detail1['quotation_entry_product_detail_tot_length']); ?>" />
				<input type="hidden" name="product_rate" id="product_rate<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo round($record_so_detail1['quotation_entry_product_detail_rate']); ?>" />
				
				
				<input type="hidden" name="product_total_amt" id="product_total_amt<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo round($record_so_detail1['quotation_entry_product_detail_total']); ?>" />

				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo round($balance_qty); ?>" />
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $product_type_id; ?>" />
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_product_type']; ?>" />
                <input type="hidden" name="mother_child_type" id="mother_child_type<?php echo $record_so_detail1['quotation_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['quotation_entry_product_detail_mother_child_type']; ?>" />
				</td>

				<td><?=$record_so_detail1['quotation_entry_no']?></td>

				<td><?=dateGeneralFormatN($record_so_detail1['quotation_entry_date'])?></td>

				<td><?php echo $product_code ?></td>

				<td><?php echo $product_name ?></td>

				<td><?=$record_so_detail1['p_uom_name']?></td>

				<td><?=round($record_so_detail1['quotation_entry_product_detail_qty'])?></td>

				<td><?=round($record_so_detail1['received_qty'])?></td>

				<td><?=round($balance_qty)?></td>

			</tr>

<?php  } ?>

			</tbody>

		</table>

		</form>
<?php
	}
	else{
$m_id = $_GET['m_id'];
   	if($m_id == '') {
   		$m_id = '""';
   	} $select_product 			= "	SELECT  
											advance_entry_no,
											advance_entry_date,
											advance_entry_product_detail_qty,
											advance_entry_product_detail_id,
											advance_entry_product_detail_product_id,
											product_thick_ness,
											inv_table.inv_qty AS received_qty,
											product_inches_qty,
											advance_entry_product_detail_width_inches,
											advance_entry_product_detail_width_mm,
											advance_entry_product_detail_s_width_inches,
											advance_entry_product_detail_s_width_mm,
											advance_entry_product_detail_sl_feet,
											advance_entry_product_detail_sl_feet_in,
											advance_entry_product_detail_sl_feet_mm,
											advance_entry_product_detail_sl_feet_met,
											advance_entry_product_detail_s_weight_inches,
											advance_entry_product_detail_s_weight_mm,
											advance_entry_product_detail_s_weight_met,
											advance_entry_product_detail_tot_length,
											advance_entry_product_detail_rate,
											advance_entry_product_detail_total,
											advance_entry_product_detail_qty,
											brand_name,
											p_uom.product_uom_name as p_uom_name,
										
											p_clr.product_colour_name as p_colour_name,
											inv_table.inv_qty AS received_qty,
											
											product_code,
											product_name,
											advance_entry_product_detail_product_color_id,
											advance_entry_product_detail_product_type,
											advance_entry_product_detail_product_thick,
											advance_entry_product_detail_entry_type,
											advance_entry_product_detail_mother_child_type 
										FROM 
											advance_entry_product_details 
										LEFT JOIN 
											advance_entry 
										ON 
											advance_entry_id 										= advance_entry_product_detail_advance_entry_id
										LEFT JOIN 
											products 
										ON 
											product_id 												= advance_entry_product_detail_product_id
										LEFT JOIN 
											product_uoms as p_uom
										ON 
											p_uom.product_uom_id 									= product_product_uom_id
										
										LEFT JOIN 
											product_colours as p_clr 
										ON 
											p_clr.product_colour_id 								= advance_entry_product_detail_product_color_id
											
										
										LEFT JOIN 
											brands 
										ON 
											brand_id 														= advance_entry_product_detail_product_brand_id	
										
										LEFT JOIN 
											(SELECT 
												invoice_entry_product_detail_quotation_detail_id, 
												SUM(invoice_entry_product_detail_qty+invoice_entry_product_detail_s_weight_inches) AS inv_qty 
											FROM 
												invoice_entry_product_details
											LEFT JOIN
												invoice_entry
											ON
												invoice_entry_id											= 	 	invoice_entry_product_detail_invoice_entry_id	
											WHERE 
												invoice_entry_product_detail_deleted_status 				= 0	AND
												invoice_entry_type											= '1') as   inv_table					
										ON 
											inv_table.invoice_entry_product_detail_quotation_detail_id 		= advance_entry_product_detail_id								 
										WHERE 
											advance_entry_product_detail_deleted_status					=	0 											AND
											advance_entry_product_detail_mother_child_type				=	1 											AND
											advance_entry_product_detail_advance_entry_id 				IN (".$quotation_entry_id.")					AND 
											advance_entry_product_detail_id 								NOT IN (".$m_id.") 							AND	
												IFNULL(inv_table.inv_qty,0) 	< (advance_entry_product_detail_qty+advance_entry_product_detail_s_weight_inches)			AND		
											advance_entry_company_id 										= '".$_SESSION[SESS.'_session_company_id']."' ";

	//echo $select_product;exit;

	$result_product = mysql_query($select_product);

  

?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#<input type="checkbox" name="All_check" id="All_check" class="check_all" onclick="GetCheck()" /></th>

				  <th width="12%" >AD.No</th>

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

			  $balance_qty = $record_so_detail['advance_entry_product_detail_qty'] - $record_so_detail['received_qty'];
			  
				//if($product_type_id==4){
					$product_code			= $record_so_detail['product_code'];
					$product_name			= $record_so_detail['product_name'];
					$product_uom_name		= $record_so_detail['p_uom_name'];
					$product_colour_name	= $record_so_detail['p_colour_name'];
					$product_type_id		= $record_so_detail['advance_entry_product_detail_entry_type'];
				/*}
				else{
					$product_code			= $record_so_detail['product_con_entry_child_product_detail_code'];
					$product_name			= $record_so_detail['product_con_entry_child_product_detail_name'];
					$product_uom_name		= $record_so_detail['c_uom_name'];
					$product_colour_name	= $record_so_detail['c_colour_name'];
				}*/
			  

?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" name="quotation_entry_product_detail_id[]" id="quotation_entry_product_detail_id<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_id']; ?>1" class="prd_checkbox" />
<input type="hidden" name="detail_id" id="detail_id<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_id']; ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >

			<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $product_code ?>" >
			<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $product_uom_name ?>" >
		<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $product_colour_name ?>" >
		<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_product_color_id']; ?>" >
		<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['brand_name'] ?>" >
	<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $arr_thick[number_format($record_so_detail['advance_entry_product_detail_product_thick'])]; ?>" >
	
	<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_product_thick']; ?>" >

				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_product_id']; ?>" >

				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_s_width_inches" id="product_s_width_inches<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_s_width_mm" id="product_s_width_mm<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_s_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="product_sl_feet<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_sl_feet']; ?>" />

				<input type="hidden" name="product_sl_feet_in" id="product_sl_feet_in<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_sl_feet_in']; ?>" />
				
				<input type="hidden" name="product_sl_feet_mm" id="product_sl_feet_mm<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_sl_feet_mm']; ?>" />
				<input type="hidden" name="product_sl_feet_met" id="product_sl_feet_met<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_sl_feet_met']; ?>" />
				
				<input type="hidden" name="product_s_weight_inches" id="product_s_weight_inches<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_s_weight_mm" id="product_s_weight_mm<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_s_weight_mm']; ?>" />
				<input type="hidden" name="product_s_weight_met" id="product_s_weight_met<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_s_weight_met']; ?>" />
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_tot_length']; ?>" />
				<input type="hidden" name="product_rate" id="product_rate<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo round($record_so_detail['advance_entry_product_detail_rate']); ?>" />
				
				
				<input type="hidden" name="product_total_amt" id="product_total_amt<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo round($record_so_detail['advance_entry_product_detail_total']); ?>" />

				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo round($balance_qty); ?>" />
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $product_type_id; ?>" />
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_product_type']; ?>" />
                <input type="hidden" name="mother_child_type" id="mother_child_type<?php echo $record_so_detail['advance_entry_product_detail_id'];?>1" value="<?php echo $record_so_detail['advance_entry_product_detail_mother_child_type']; ?>" />
				</td>

				<td><?=$record_so_detail['advance_entry_no']?></td>

				<td><?=dateGeneralFormatN($record_so_detail['advance_entry_date'])?></td>

				<td><?php echo $product_code ?></td>

				<td><?php echo $product_name ?></td>

				<td><?=$product_uom_name?></td>

				<td><?=round($record_so_detail['advance_entry_product_detail_qty'])?></td>

				<td><?=round($record_so_detail['received_qty'])?></td>

				<td><?=round($balance_qty)?></td>

			</tr>

<?php  } 

   		 $select_product1			= "	SELECT  
											advance_entry_no,
											advance_entry_date,
											advance_entry_product_detail_qty,
											advance_entry_product_detail_id,
											advance_entry_product_detail_product_id,
											advance_entry_product_detail_product_thick as product_thick_ness,
											inv_table.inv_qty AS received_qty,
											advance_entry_product_detail_width_inches,
											advance_entry_product_detail_width_mm,
											advance_entry_product_detail_s_width_inches,
											advance_entry_product_detail_s_width_mm,
											advance_entry_product_detail_sl_feet,
											advance_entry_product_detail_sl_feet_in,
											advance_entry_product_detail_sl_feet_mm,
											advance_entry_product_detail_sl_feet_met,
											advance_entry_product_detail_s_weight_inches,
											advance_entry_product_detail_s_weight_mm,
											advance_entry_product_detail_s_weight_met,
											advance_entry_product_detail_tot_length,
											advance_entry_product_detail_rate,
											advance_entry_product_detail_total,
											advance_entry_product_detail_qty,
											brand_name,
											product_con_entry_child_product_detail_code,
											product_con_entry_child_product_detail_name,
											child_uom.product_uom_name as p_uom_name,
											c_clr.product_colour_name as p_colour_name,
											inv_table.inv_qty AS received_qty,
											product_con_entry_child_product_detail_width_inches,
											product_con_entry_child_product_detail_code as product_code,
											product_con_entry_child_product_detail_name as product_name,
											advance_entry_product_detail_product_color_id,
											advance_entry_product_detail_product_type,
											advance_entry_product_detail_product_thick,
											advance_entry_product_detail_entry_type,
											advance_entry_product_detail_mother_child_type
										FROM 
											advance_entry_product_details 
										LEFT JOIN 
											advance_entry 
										ON 
											advance_entry_id 										= advance_entry_product_detail_advance_entry_id
										
										LEFT JOIN 
											product_con_entry_child_product_details 
										ON 
											product_con_entry_child_product_detail_id				= advance_entry_product_detail_product_id	
										
										LEFT JOIN 
											product_uoms as  child_uom
										ON 
											child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
											
										LEFT JOIN 
											product_colours as c_clr 
										ON 
											c_clr.product_colour_id 								= advance_entry_product_detail_product_color_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 														= advance_entry_product_detail_product_brand_id	
										
										LEFT JOIN 
											(SELECT 
												invoice_entry_product_detail_quotation_detail_id, 
												SUM(invoice_entry_product_detail_qty+invoice_entry_product_detail_s_weight_inches) AS inv_qty 
											FROM 
												invoice_entry_product_details
											LEFT JOIN
												invoice_entry
											ON
												invoice_entry_id											= 	 	invoice_entry_product_detail_invoice_entry_id	
											WHERE 
												invoice_entry_product_detail_deleted_status 				= 0	AND
												invoice_entry_type											= '1') as   inv_table					
										ON 
											inv_table.invoice_entry_product_detail_quotation_detail_id 		= advance_entry_product_detail_id								 
										WHERE 
											advance_entry_product_detail_deleted_status					=	0 										AND
											advance_entry_product_detail_mother_child_type				=	2										AND
											advance_entry_product_detail_advance_entry_id 				IN (".$quotation_entry_id.")				AND 
											advance_entry_product_detail_id 							NOT IN (".$m_id.") 							AND	
											IFNULL(inv_table.inv_qty,0) 	< (advance_entry_product_detail_qty+advance_entry_product_detail_s_weight_inches)		AND		
											advance_entry_company_id 										= '".$_SESSION[SESS.'_session_company_id']."' ";
	//echo $select_product1;exit;
	$result_product1 = mysql_query($select_product1);
  ?>
<?php
		while ($record_so_detail1 = mysql_fetch_array($result_product1)){
			  $balance_qty = $record_so_detail1['advance_entry_product_detail_qty'] - $record_so_detail1['received_qty'];
				//if($product_type_id==4){
					$product_code			= $record_so_detail1['product_code'];
					$product_name			= $record_so_detail1['product_name'];
					$product_uom_name		= $record_so_detail1['p_uom_name'];
					$product_colour_name	= $record_so_detail1['p_colour_name'];
					$product_type_id		= $record_so_detail1['advance_entry_product_detail_entry_type'];
				/*}
				else{
					$product_code			= $record_so_detail['product_con_entry_child_product_detail_code'];
					$product_name			= $record_so_detail['product_con_entry_child_product_detail_name'];
					$product_uom_name		= $record_so_detail['c_uom_name'];
					$product_colour_name	= $record_so_detail['c_colour_name'];
				}*/
			  

?>

			<tr class="odd gradeX">

				<td>

				<input type="checkbox" name="quotation_entry_product_detail_id[]" id="quotation_entry_product_detail_id<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_id']; ?>2" class="prd_checkbox" />
				<input type="hidden" name="detail_id" id="detail_id<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_id']; ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >

			<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $product_code ?>" >
			<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $product_uom_name ?>" >
		<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $product_colour_name ?>" >
		<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_product_color_id']; ?>" >
		<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['brand_name'] ?>" >
	<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $arr_thick[number_format($record_so_detail1['advance_entry_product_detail_product_thick'])]; ?>" >
	
	<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_product_thick']; ?>" >

				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_product_id']; ?>" >

				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail['advance_entry_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_s_width_inches" id="product_s_width_inches<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_s_width_mm" id="product_s_width_mm<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_s_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="product_sl_feet<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_sl_feet']; ?>" />

				<input type="hidden" name="product_sl_feet_in" id="product_sl_feet_in<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_sl_feet_in']; ?>" />
				
				<input type="hidden" name="product_sl_feet_mm" id="product_sl_feet_mm<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_sl_feet_mm']; ?>" />
				<input type="hidden" name="product_sl_feet_met" id="product_sl_feet_met<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_sl_feet_met']; ?>" />
				
				<input type="hidden" name="product_s_weight_inches" id="product_s_weight_inches<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_s_weight_mm" id="product_s_weight_mm<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_s_weight_mm']; ?>" />
				<input type="hidden" name="product_s_weight_met" id="product_s_weight_met<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_s_weight_met']; ?>" />
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_tot_length']; ?>" />
				<input type="hidden" name="product_rate" id="product_rate<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo round($record_so_detail1['advance_entry_product_detail_rate']); ?>" />
				
				
				<input type="hidden" name="product_total_amt" id="product_total_amt<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo round($record_so_detail1['advance_entry_product_detail_total']); ?>" />

				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo round($balance_qty); ?>" />
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $product_type_id; ?>" />
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_product_type']; ?>" />
                <input type="hidden" name="mother_child_type" id="mother_child_type<?php echo $record_so_detail1['advance_entry_product_detail_id'];?>2" value="<?php echo $record_so_detail1['advance_entry_product_detail_mother_child_type']; ?>" />
				</td>

				<td><?=$record_so_detail1['advance_entry_no']?></td>

				<td><?=dateGeneralFormatN($record_so_detail1['advance_entry_date'])?></td>

				<td><?php echo $product_code ?></td>

				<td><?php echo $product_name ?></td>

				<td><?=$product_uom_name?></td>

				<td><?=round($record_so_detail1['advance_entry_product_detail_qty'])?></td>

				<td><?=round($record_so_detail1['received_qty'])?></td>

				<td><?=round($balance_qty)?></td>

			</tr>

<?php  } ?>

			</tbody>

		</table>

		</form>	
	<?php	
	}
?>

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