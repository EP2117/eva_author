  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$damage_entry_id	= $_REQUEST['damage_entry_id'];
	$m_id = $_GET['m_id'];
	
   	if($m_id == '') {
   		$m_id = '""';
   	}
  $select_product 			= "	SELECT  
   									damage_entry_no,
									damage_entry_date,
									product_code,
									product_name,
									one_uom.product_uom_name as one_prd_uom_name,
									sec_uom.product_uom_name as sec_prd_uom_name,
									damage_entry_product_detail_qty,
									damage_entry_product_detail_id,
									damage_entry_product_detail_product_id,
									damage_entry_product_detail_rate,
									damage_entry_product_detail_amount,
									sus_table.sus_qty AS received_qty

							 	FROM 
									damage_entry_product_details 
							 	LEFT JOIN 
									damage_entry 
								ON 
									damage_entry_id 												= damage_entry_product_detail_damage_entry_id
							 	LEFT JOIN 
									products 
								ON 
									product_id 														= damage_entry_product_detail_product_id
								LEFT JOIN 
									product_uoms  as one_uom
								ON 
									one_uom.product_uom_id 											= product_uom_one_id
								LEFT JOIN 
									product_uoms as sec_uom
								ON 
									sec_uom.product_uom_id 											= product_uom_two_id
								LEFT JOIN 
									(SELECT 
										stock_adjustment_product_detail_damage_entry_detail_id, 
										SUM(stock_adjustment_product_detail_add_qty+stock_adjustment_product_detail_less_qty) AS sus_qty 
									FROM 
										stock_adjustment_product_details  	
									WHERE 
										stock_adjustment_product_detail_deleted_status 				= 0  					
									GROUP BY 
										stock_adjustment_product_detail_damage_entry_detail_id) sus_table 
								ON 
									stock_adjustment_product_detail_damage_entry_detail_id 			= damage_entry_product_detail_id								 
							 	WHERE 
									damage_entry_product_detail_deleted_status						=	0 											AND
							 	 	damage_entry_product_detail_damage_entry_id 					IN (".$damage_entry_id.")						AND 
							  		damage_entry_product_detail_id 									NOT IN (".$m_id.") 								AND	
									IFNULL( sus_table.sus_qty,0) 									< damage_entry_product_detail_qty				AND									
							 	 	damage_entry_company_id 										= '".$_SESSION[SESS.'_session_company_id']."' ";
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
				  <th width="10%" >UOM</th>
				  <th width="10%" >Qty</th>
				  <th width="9%" >Receive Qty</th>
				  <th width="9%" >Bal qty</th>
				  </tr>
			</thead>
			<tbody >
<?php
		while ($record_so_detail = mysql_fetch_array($result_product)){
			  $balance_qty = $record_so_detail['damage_entry_product_detail_qty']-$record_so_detail['received_qty'];
?>
			<tr class="odd gradeX">
				<td>
				<input type="checkbox" name="damage_entry_product_detail_id[]" id="damage_entry_product_detail_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_id']; ?>" />
				<input type="hidden" name="product_name" id="product_name<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo htmlspecialchars(ucfirst($record_so_detail['product_name'])); ?>" >
				<input type="hidden" name="product_code" id="product_code<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['product_code']; ?>" >
				<input type="hidden" name="one_prd_uom_name" id="one_prd_uom_name<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['one_prd_uom_name']; ?>" >
				<input type="hidden" name="sec_prd_uom_name" id="sec_prd_uom_name<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['sec_prd_uom_name']; ?>" >
				<input type="hidden" name="inv_detail_bal_qty" id="inv_detail_bal_qty<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $balance_qty; ?>" >
				<input type="hidden" name="inv_detail_qty" id="inv_detail_qty<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_qty']; ?>" >
				<input type="hidden" name="product_id" id="product_id<?php echo $record_so_detail['damage_entry_product_detail_id'];?>" value="<?php echo $record_so_detail['damage_entry_product_detail_product_id']; ?>" >
				</td>
				<td><?=$record_so_detail['damage_entry_no']?></td>
				<td><?=dateGeneralFormat($record_so_detail['damage_entry_date'])?></td>
				<td><?php echo $record_so_detail['product_code']; ?></td>
				<td><?php echo $record_so_detail['product_name']; ?></td>
				<td><?=$record_so_detail['one_prd_uom_name']?></td>
				<td><?=$record_so_detail['damage_entry_product_detail_qty']?></td>
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