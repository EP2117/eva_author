  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$production_entry_id	= $_REQUEST['production_entry_id'];

	$m_id = $_GET['m_id'];

	

   	if($m_id == '') {

   		$m_id = '""';

   	}
   		  $select_product 			= "	SELECT  
											production_entry_no,
											production_entry_date,
											production_entry_product_detail_qty,
											production_entry_product_detail_id,
											production_entry_product_detail_product_id,
											production_entry_product_detail_width_inches,production_entry_product_detail_width_mm,
											production_entry_product_detail_s_width_inches,production_entry_product_detail_s_width_mm,
											production_entry_product_detail_sl_feet,production_entry_product_detail_sl_feet_in,
											production_entry_product_detail_sl_feet_mm,production_entry_product_detail_sl_feet_met,
											production_entry_product_detail_ext_feet,production_entry_product_detail_ext_feet_in,
											production_entry_product_detail_ext_feet_mm,production_entry_product_detail_ext_feet_met,
											production_entry_product_detail_tot_feet,production_entry_product_detail_tot_meter,
											production_entry_product_detail_product_colour_id,
											production_entry_product_detail_s_weight_inches,
											production_entry_product_detail_s_weight_mm,production_entry_product_detail_tot_length,
											production_entry_product_detail_product_thick,
											product_name,
											product_code,
											p_uom.product_uom_name as p_uom_name,
											p_clr.product_colour_name as p_colour_name,
											brand_name,
											inv_table.inv_qty AS received_qty,
											production_entry_type_id,
											production_entry_product_detail_product_type,
											product_product_uom_id,
											production_entry_product_detail_mother_child_type
										FROM 
											production_entry_product_details 
										LEFT JOIN 
											production_entry 
										ON 
											production_entry_id 									= production_entry_product_detail_production_entry_id
										LEFT JOIN 
											products 
										ON 
											product_id 										= production_entry_product_detail_product_id
										LEFT JOIN 
											brands 
										ON 
											brand_id 										= product_brand_id
										LEFT JOIN 
											product_uoms as p_uom
										ON 
											p_uom.product_uom_id 							= product_product_uom_id
										LEFT JOIN 
											product_colours as p_clr 
										ON 
											p_clr.product_colour_id 						= production_entry_product_detail_product_colour_id
										LEFT JOIN 
											(SELECT 
												prn_entry_product_detail_production_detail_id	, 
												SUM(prn_entry_product_detail_qty+prn_entry_product_detail_s_weight_inches) AS inv_qty 
											FROM 
												prn_entry_product_details  	
											WHERE 
												prn_entry_product_detail_deleted_status 				= 0  					
											GROUP BY 
												prn_entry_product_detail_production_detail_id	) inv_table 
										ON 
											 	prn_entry_product_detail_production_detail_id 			= production_entry_product_detail_id		
											
										WHERE 
											production_entry_product_detail_deleted_status				=	0 												AND
											production_entry_product_detail_production_entry_id 			IN (".$production_entry_id.")									AND 
											production_entry_product_detail_id 					NOT IN (".$m_id.") 								AND	
											IFNULL(inv_table.inv_qty,0) 					<(production_entry_product_detail_qty+production_entry_product_detail_s_weight_inches)				AND											
											production_entry_company_id 								= '".$_SESSION[SESS.'_session_company_id']."' "; //exit;

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
			  $balance_qty = $record_so_detail['production_entry_product_detail_qty'] - $record_so_detail['received_qty'];
				$product_code				= $record_so_detail['product_code'];
				$product_name				= $record_so_detail['product_name'];
				$product_uom_name			= $record_so_detail['p_uom_name'];
				$product_colour_name		= $record_so_detail['p_colour_name'];
				
?>

			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="production_entry_product_detail_id[]" id="production_entry_product_detail_id<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_id']; ?>"  class="prd_checkbox" />
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($product_name)); ?>" >
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $product_code; ?>" >
				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $product_uom_name; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $product_colour_name; ?>" >
				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_product_colour_id']; ?>" >
				<input type="hidden" name="product_brand_name" id="product_brand_name<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['brand_name']; ?>" >
				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $arr_thick[$record_so_detail['production_entry_product_detail_product_thick']]; ?>" >
				<input type="hidden" name="product_thick_ness_id" id="product_thick_ness_id<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_product_thick']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_product_id']; ?>" >
				<input type="hidden" name="product_width_inches" id="product_width_inches<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_width_inches']; ?>" />

				<input type="hidden" name="product_width_mm" id="product_width_mm<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_width_mm']; ?>" />

				<input type="hidden" name="product_s_width_inches" id="product_s_width_inches<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_s_width_inches']; ?>" />

				<input type="hidden" name="product_s_width_mm" id="product_s_width_mm<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_s_width_mm']; ?>" />

				<input type="hidden" name="product_sl_feet" id="product_sl_feet<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_sl_feet']; ?>" />

				<input type="hidden" name="product_sl_feet_in" id="product_sl_feet_in<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_sl_feet_in']; ?>" />
				
				<input type="hidden" name="product_sl_feet_mm" id="product_sl_feet_mm<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_sl_feet_mm']; ?>" />
				
				<input type="hidden" name="product_sl_feet_met" id="product_sl_feet_met<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_sl_feet_met']; ?>" />
				
				<input type="hidden" name="product_ext_feet" id="product_ext_feet<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_ext_feet']; ?>" />

				<input type="hidden" name="product_ext_feet_in" id="product_ext_feet_in<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_ext_feet_in']; ?>" />
				
				<input type="hidden" name="product_ext_feet_mm" id="product_ext_feet_mm<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_ext_feet_mm']; ?>" />
				
				<input type="hidden" name="product_ext_feet_met" id="product_ext_feet_met<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_ext_feet_met']; ?>" />
				
				
				<input type="hidden" name="product_s_weight_inches" id="product_s_weight_inches<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_s_weight_inches']; ?>" />
				<input type="hidden" name="product_s_weight_mm" id="product_s_weight_mm<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_s_weight_mm']; ?>" />
				<input type="hidden" name="product_tot_length" id="product_tot_length<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_tot_length']; ?>" />
				<input type="hidden" name="product_tot_feet" id="product_tot_feet<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_tot_feet']; ?>" />
				<input type="hidden" name="product_tot_meter" id="product_tot_meter<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_tot_meter']; ?>" />
				<input type="hidden" name="product_detail_qty" id="product_detail_qty<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $balance_qty; ?>" />
				<input type="hidden" name="product_type_id" id="product_type_id<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_type_id']; ?>" />
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_product_type']; ?>" />
				<input type="hidden" name="uom_id" id="uom_id<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['product_product_uom_id']; ?>" />
                
                
                <input type="hidden" name="product_mother_child_type" id="product_mother_child_type<?php echo $record_so_detail['production_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['production_entry_product_detail_mother_child_type']; ?>" />
                
				</td>
				<td><?=$record_so_detail['production_entry_no']?></td>
				<td><?=dateGeneralFormatN($record_so_detail['production_entry_date'])?></td>
				<td><?php echo $product_code; ?></td>
				<td><?php echo $product_name; ?></td>
				<td><?=$product_uom_name?></td>
				<td><?=$record_so_detail['production_entry_product_detail_qty']?></td>
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