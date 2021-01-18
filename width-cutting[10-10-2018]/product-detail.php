  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$m_id = $_GET['m_id'];
   	if($m_id == '') {
   		$m_id = '""';
   	}

		 $query	="SELECT 
		 				product_con_entry_child_product_detail_id,
		 				product_con_entry_child_product_detail_name,
						product_con_entry_child_product_detail_code,
						product_uom_name,
						product_con_entry_child_product_detail_thick_ness,
						product_colour_name,
						product_con_entry_child_product_detail_uom_id,
						product_con_entry_child_product_detail_color_id,
						product_con_entry_child_product_detail_ton_qty,
						product_con_entry_child_product_detail_length_feet,
						product_con_entry_child_product_detail_length_mm,
						product_con_entry_child_product_detail_width_mm,
						product_con_entry_child_product_detail_width_inches,
						closing_length_feet,
						closing_length_meter,
						closing_weight_tone,
						closing_weight_kg,
						product_con_entry_child_product_detail_product_brand_id,
						brand_name,
						product_con_entry_child_product_detail_product_category_id,
						product_con_entry_child_product_detail_type,
						product_con_entry_osf_length_feet,
						product_con_entry_osf_uom_ton,
						product_con_entry_osf_uom_kg
						
				 FROM 
				 		product_con_entry_child_product_details 
				 LEFT JOIN
				 		(SELECT
							stock_ledger_product_id,
							sum(stock_ledger_product_quantity*stock_ledger_length_feet) as closing_length_feet,
							sum(stock_ledger_product_quantity*stock_ledger_length_meter) as closing_length_meter,
							sum(stock_ledger_product_quantity*stock_ledger_weight_tone) as closing_weight_tone,
							sum(stock_ledger_product_quantity*stock_ledger_weight_kg) as closing_weight_kg
						 FROM
						  	stock_ledger
						 WHERE
						 	stock_ledger_prd_type 		= '2'  												AND
							stock_ledger_status 		= 0 												AND 
							stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' 	AND 
							stock_ledger_company_id 	= '".$_SESSION[SESS.'_session_company_id']."'		AND
							stock_ledger_godown_id		= 	'1'
						  GROUP BY 
						  	stock_ledger_product_id) as stk_table
				 ON
				 		stock_ledger_product_id									=  product_con_entry_child_product_detail_id
				 LEFT JOIN 
				 		product_uoms 
				 ON 
				 		product_uom_id 											= product_con_entry_child_product_detail_uom_id
				 LEFT JOIN 
						product_colours 
				 ON 
						product_colour_id 										= product_con_entry_child_product_detail_color_id
				 LEFT JOIN 
						brands 
				 ON 
						brand_id 												= product_con_entry_child_product_detail_product_brand_id		
				 LEFT JOIN 
				 		products 
				 ON 
				 		product_id 												= product_con_entry_child_product_detail_product_id
				 WHERE 
				 		product_con_entry_child_product_detail_deleted_status	= 0 ";
		$result_product = mysql_query($query);
?>

		<form method="get" name="product_list_form" id="product_list_form"  >

		<table class="table datatable table-bordered" id="product_detail_popup">

			<thead>

				<tr>

				  <th width="5%" >#</th>

				  <th width="12%" >Code</th>

				  <th width="24%" >Product</th>

				  <th width="10%" >UOM</th>

				  <th width="10%" >Color</th>

				  <th width="10%" >Thick</th>

				  </tr>

			</thead>

			<tbody >

<?php

		while ($record_so_detail = mysql_fetch_array($result_product)){
			$product_type= ($record_so_detail['product_con_entry_child_product_detail_type']==3)?"3":($record_so_detail['product_con_entry_child_product_detail_type']+1);		
?>		
			<tr class="odd gradeX">
				<td>
				<input type="radio" name="chk_product_id[]" id="chk_product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_id']; ?>2" />
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_id'])); ?>" >
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_name'])); ?>" >
				<input type="hidden" name="product_brand_id" id="product_brand_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_product_brand_id'])); ?>" >
				<input type="hidden" name="product_category_id" id="product_category_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_con_entry_child_product_detail_product_category_id'])); ?>" >
				<input type="hidden" name="brand_name" id="brand_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['brand_name'])); ?>" >

				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_code']; ?>" >

				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_uom_name']; ?>" >
				<input type="hidden" name="product_uom_id" id="product_uom_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_uom_id']; ?>" >
				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_colour_name']; ?>" >
				<input type="hidden" name="product_colour_id" id="product_colour_id<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_color_id']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $arr_thick[$record_so_detail['product_con_entry_child_product_detail_thick_ness']]; ?>" >
				<input type="hidden" name="product_thick_ness_val" id="product_thick_ness_val<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_thick_ness']; ?>" >
				<input type="hidden" name="product_con_entry_child_product_detail_width_inches" id="product_con_entry_child_product_detail_width_inches<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_width_inches']; ?>" >
				<input type="hidden" name="product_con_entry_child_product_detail_width_mm" id="product_con_entry_child_product_detail_width_mm<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_child_product_detail_width_mm']; ?>" >
				<input type="hidden" name="product_con_entry_child_product_detail_length_mm" id="product_con_entry_child_product_detail_length_mm<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['closing_length_meter']; ?>" >
				<input type="hidden" name="product_con_entry_child_product_detail_length_feet" id="product_con_entry_child_product_detail_length_feet<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['closing_length_feet']; ?>" >
				<input type="hidden" name="product_con_entry_child_product_detail_total" id="product_con_entry_child_product_detail_total<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['closing_weight_tone']; ?>" >
				<input type="hidden" name="product_con_entry_osf_uom_ton" id="product_con_entry_osf_uom_ton<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_osf_uom_ton']; ?>" >
				<input type="hidden" name="product_con_entry_osf_length_feet" id="product_con_entry_osf_length_feet<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_osf_length_feet']; ?>" >
				<input type="hidden" name="product_con_entry_osf_uom_kg" id="product_con_entry_osf_uom_kg<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?php echo $record_so_detail['product_con_entry_osf_uom_kg']; ?>" >
				
				
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['product_con_entry_child_product_detail_id'];?>2" value="<?=$product_type?>" >
				</td>
				<td><?php echo $record_so_detail['product_con_entry_child_product_detail_code']; ?></td>
				<td><?php echo $record_so_detail['product_con_entry_child_product_detail_name']; ?></td>
				<td><?=$record_so_detail['product_uom_name']?></td>
				<td><?=$record_so_detail['product_colour_name']?></td>
				<td><?php echo $arr_thick[$record_so_detail['product_con_entry_child_product_detail_thick_ness']]; ?></td>

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

</script>