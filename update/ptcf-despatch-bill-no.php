<?php
	require('../includes/config/config.php');
	
		$select_ledger	= "	Select
								*
							FROM
								 product_con_entry_child_product_details
							WHERE
								product_con_entry_child_product_detail_deleted_status				= '0'       AND
								product_con_entry_child_product_detail_total                        > 0"; 
		$result_ledger	= mysql_query($select_ledger);
		while($record_ledger	= mysql_fetch_array($result_ledger)){
		$osf_feet						= 1;
		$product_feet					= $record_ledger['product_con_entry_child_product_detail_length_feet'];
		$product_weight_ton				= $record_ledger['product_con_entry_child_product_detail_total'];
		$product_weight_kg				= $record_ledger['product_con_entry_child_product_detail_total']*1000;
		
		$osf_ton						= ($osf_feet/$product_feet)*$product_weight_ton;
		$osf_ton_kg						= $osf_ton*1000;
		
		echo $product_weight_ton."</br>";
						echo  $update_stock_ledger = "UPDATE product_con_entry_child_product_details SET 
														product_con_entry_osf_uom_ton			        	=	'".$osf_ton."',
														product_con_entry_osf_uom_kg				        =	'".$osf_ton_kg."',
														product_con_entry_child_product_detail_ton_qty		=	'".$product_weight_ton."',
														product_con_entry_child_product_detail_kg_qty      	=	'".$product_weight_kg."'
														
												WHERE	
														product_con_entry_child_product_detail_id	=	'".$record_ledger['product_con_entry_child_product_detail_id']."' ";   

						
						mysql_query($update_stock_ledger);		

		}
?> 

