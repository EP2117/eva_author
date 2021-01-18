  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">



<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$po_id = $_REQUEST['po_id'];
	$m_id = $_GET['m_id'];
	$product_type = $_GET['product_type'];

   	if($m_id == '') {

   		$m_id = '""';

   	}
	$where		= '';
	if($product_type==2){
		$where  .="  product_type NOT IN('3') AND ";
	}
	elseif($product_type==3){
		$where  .="  product_type IN('3') AND ";
	}
	 $select_product	="SELECT 
	   					purOrdPorductId,
	  					pRp_product_id,
	   					pRp_qty,
						pRp_rate,
						pRp_frignrate,
						product_id,
						product_name,
						product_code,
						product_type,
						product_uom_name,
						supplier_name,
						supplier_location,
						DATE_FORMAT(pR_purchase_date ,'%d/%m/%Y') pR_purchase_date,
						supplier_total_credit_limit,
						pR_rate,
						pRp_unitprice,
						pRp_ton,
						pRp_kg,
						product_colour_name,
						brand_name,
						product_thick_ness,
						pRp_rate_by_currency 
				  FROM 
				  		purchase_order_products 
				  LEFT JOIN 
				  		purchase_order
				  ON 
				  		purchaseId = pRp_purchaseId
				  LEFT JOIN 
						(SELECT 
							SUM(piP_po_ton+piP_po_qty) AS rc_qty,
							piP_po_detail_id
						FROM 
							purchase_invoice_products
						WHERE 
							piP_deleted_status 				= 0  						
						GROUP BY 
							piP_product_id) rcv_table
				  ON	
				  		piP_po_detail_id = purOrdPorductId
				  LEFT JOIN 
				  		products 
				  ON 
				  		pRp_product_id = product_id
				  LEFT JOIN 
				  		product_uoms 
				  ON 
				  		product_uom_id = product_purchase_uom_id 
					LEFT JOIN 
						product_colours 
					ON 
						product_colour_id 					= product_product_colour_id
					LEFT JOIN 
						brands 
					ON 
						brand_id 							= product_brand_id		
				  LEFT JOIN 
				  		suppliers 
				  ON 
				  		pR_supplier_id = supplier_id
				  			
				  WHERE 
				  		purchaseId 								= '".$po_id."'  				AND
						IFNULL(rcv_table.rc_qty,0) 				< (pRp_ton+pRp_qty)					AND 
						product_deleted_status					= 0 							AND  
						product_active_status					= 'active'						AND 
						$where
						purOrdPorductId 			NOT IN (".$m_id.") ";

	

	$result_product = mysql_query($select_product);

  

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

		while ($record_so_detail = mysql_fetch_array($result_product)){

?>

			<tr class="odd gradeX">

				<td>
					<input type="checkbox" name="chk_product_id[]" id="chk_product_id<?php echo $record_so_detail['purOrdPorductId'];?>" value="<?php echo $record_so_detail['purOrdPorductId']; ?>1"  class="prd_checkbox"  />
				<input type="hidden" name="purOrdPorductId[]" id="purOrdPorductId<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['purOrdPorductId']; ?>" />	
				<input type="hidden" name="product_id[]" id="product_id<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['product_id']; ?>" />

				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo ucfirst($record_so_detail['product_name']); ?>" >

				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['product_code']; ?>" >

				<input type="hidden" name="product_uom" id="product_uom<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['product_uom_name']; ?>" >

				<input type="hidden" name="product_colour_name" id="product_colour_name<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['product_colour_name']; ?>" >

				<input type="hidden" name="product_thick_ness" id="product_thick_ness<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['product_thick_ness']; ?>" >
				<input type="hidden" name="product_type" id="product_type<?php echo $record_so_detail['purOrdPorductId'];?>1" value="1" >
				<input type="hidden" name="product_prd_type" id="product_prd_type<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['product_type']; ?>" >
				
				<input type="hidden" name="product_inches" id="product_inches<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['product_inches_qty']; ?>" >
				<input type="hidden" name="brand_name" id="brand_name<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['brand_name']; ?>" >
				
				<input type="hidden" name="pRp_qty" id="pRp_qty<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['pRp_qty']; ?>" >
				<input type="hidden" name="pRp_rate" id="pRp_rate<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['pRp_rate']; ?>" >
				<input type="hidden" name="pRp_frignrate" id="pRp_frignrate<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['pRp_frignrate']; ?>" >
				<input type="hidden" name="pRp_ton" id="pRp_ton<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['pRp_ton']; ?>" >
				<input type="hidden" name="pRp_kg" id="pRp_kg<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['pRp_kg']; ?>" >
				<input type="hidden" name="pRp_unitprice" id="pRp_unitprice<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['pRp_unitprice']; ?>" >
				<input type="hidden" name="pRp_rate_by_currency" id="pRp_rate_by_currency<?php echo $record_so_detail['purOrdPorductId'];?>1" value="<?php echo $record_so_detail['pRp_rate_by_currency']; ?>" >
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