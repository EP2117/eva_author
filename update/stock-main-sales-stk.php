<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

			
			
			$select_branch		=	"SELECT 
										*
									 FROM 
										stock_ledger
									LEFT JOIN 
										product_con_entry_child_product_details 
									ON 
										product_con_entry_child_product_detail_id				= stock_ledger_product_id	
									 WHERE 
										stock_ledger_status 		= 	0 			AND
										stock_ledger_godown_id		= '1'			AND
										stock_ledger_prd_type 		= '2'			AND
										stock_ledger_entry_type		= 'OPEN-ENTRY'
									 ORDER BY 
										stock_ledger_id ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$customer_data 		= array();
        $sno =1;
		while ($record_branch = mysql_fetch_array($result_branch))
		{
		
					$branchid			= '1';	
					$product_con_entry_godown_id						= 	"2";
					$entry_id					= $record_branch['stock_ledger_id'];
					$detail_id					= $record_branch['stock_ledger_id'];
					$product_id					= $record_branch['product_con_entry_child_product_detail_product_id'];
					$product_feet				= $record_branch['stock_ledger_length_feet'];
					$product_feet_mm			= $record_branch['stock_ledger_length_meter'];
					$product_weight_ton			= $record_branch['stock_ledger_weight_tone'];
					$product_weight_kg			= $record_branch['stock_ledger_weight_kg'];
					$prd_qty					= $record_branch['stock_ledger_product_quantity'];
					$branchid					= $record_branch['stock_ledger_branch_id'];
					$product_code				= $record_branch['stock_ledger_trans_no'];
					$stock_ledger_prd_type		= $record_branch['stock_ledger_prd_type'];
					$product_width				= $record_branch['stock_ledger_width_inches'];
					$product_width_mm			= $record_branch['stock_ledger_width_mm'];
					$product_colour_id			= $record_branch['stock_ledger_colour_id'];
					$thick_id					= $record_branch['stock_ledger_thick_ness'];
					stockLedger('in',$entry_id,$detail_id,$product_id,$product_feet,$product_feet_mm,$product_weight_ton,$product_weight_kg,$prd_qty, $branchid,  $product_con_entry_godown_id, '2018-09-01',$product_code,'OPEN-ENTRY', $stock_ledger_prd_type,$product_width,$product_width_mm,$product_colour_id,$thick_id);
		
        
		}  exit;



?>

