<?php  

function listBranch()
{
	$select_branch = "SELECT branch_id, branch_name FROM branches WHERE branch_active_status ='active'  AND branch_deleted_status =0 ORDER BY branch_name ASC";
	$result_branch = mysql_query($select_branch);
	$arr_branch    = array();
	
	while($record_branch = mysql_fetch_array($result_branch)) {
		$arr_branch[] = $record_branch;
	}
	
	return $arr_branch;
}
function listcurrency()
{
	$select_currency = "SELECT currency_id, currency_name,currency_contact_number FROM currencys WHERE currency_active_status ='active'  AND currency_deleted_status =0
						AND currency_company_id = '".$_SESSION[SESS.'_session_company_id']."' ORDER BY currency_name ASC";
	$result_currency = mysql_query($select_currency);
	$arr_currency    = array();
	while($record_currency = mysql_fetch_array($result_currency)) {
		$arr_currency[] = $record_currency;
	}
	return $arr_currency;
}

	function listCustomer()
	{
		$select_supplier = "SELECT supplier_id, supplier_code, supplier_name, city_name
							FROM suppliers 
							LEFT JOIN cities ON city_id = supplier_city_id
							WHERE supplier_active_status = 'active' 
							AND  supplier_deleted_status =0 
							AND supplier_company_id = '".$_SESSION[SESS.'_session_company_id']."'  ORDER BY supplier_name ASC";
		$result_supplier = mysql_query($select_supplier);
		$arr_supplier    = array();
		
		while($record_supplier = mysql_fetch_array($result_supplier)) {
			$arr_supplier[] = $record_supplier;
		}
		
		return $arr_supplier;
	}
	

	function reserveReport()
	{
		
	
		$where = " WHERE stock_transfer_deleted_status  =0 AND stock_transfer_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND stock_transfer_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
		
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND stock_transfer_product_detail_branch_id	 = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		if(isset($_REQUEST['search_date']) && (!empty($_REQUEST['search_date']))) {
			$where .= " AND stock_transfer_date = '".dataValidation($_REQUEST['search_date'])."'";
		}		
		if(isset($_REQUEST['stock_transfer_from_godown_id']) && (!empty($_REQUEST['stock_transfer_from_godown_id']))) {
			$where .= " AND stock_transfer_from_godown_id = '".dataValidation($_REQUEST['stock_transfer_from_godown_id'])."'";
		}
		if(isset($_REQUEST['stock_transfer_to_godown_id']) && (!empty($_REQUEST['stock_transfer_to_godown_id']))) {
			$where .= " AND stock_transfer_to_godown_id = '".dataValidation($_REQUEST['stock_transfer_to_godown_id'])."'";
		}
		
/*		if(isset($_REQUEST['search_product_id']) && (!empty($_REQUEST['search_product_id']))) {
			$where .= " AND stock_transfer_product_detail_product_id = '".dataValidation($_REQUEST['search_product_id'])."'";
		}
		if(isset($_REQUEST['search_brand_id']) && (!empty($_REQUEST['search_brand_id']))) {
			$where .= " AND product_brand_id = '".dataValidation($_REQUEST['search_brand_id'])."'";
		} */
								  
		$select_reserve	 		= "SELECT  	stock_transfer_id,
											stock_transfer_uniq_id,
											stock_transfer_no,
											stock_transfer_date,			
											product_code, product_name,
											fromGodown.godown_name as fromWarehouse,
											toGodown.godown_name as toWarehouse,
											masterUOM.product_uom_name as UOM1,
											stock_transfer_product_detail_qty
								  		FROM 
											stock_transfer
										LEFT JOIN stock_transfer_product_details ON stock_transfer_product_detail_stock_transfer_id = stock_transfer_id											
										LEFT JOIN godowns as fromGodown ON  fromGodown.godown_id	= stock_transfer_from_godown_id										 
										LEFT JOIN godowns as toGodown  ON 	toGodown.godown_id		= stock_transfer_to_godown_id
										LEFT JOIN products ON product_id 		    = stock_transfer_product_detail_product_id
										LEFT JOIN brands ON brand_id 			    = product_brand_id									
										LEFT JOIN product_uoms as masterUOM ON  masterUOM.product_uom_id  	= product_uom_one_id										
									
									 $where
									  
									 ORDER BY 
												stock_transfer_id, stock_transfer_no ASC";
																			  
		$result_reserve = mysql_query($select_reserve);
		$count_reserve  = mysql_num_rows($result_reserve);
		$arr_reserve    = array();
		while($record_reserve = mysql_fetch_array($result_reserve)) {
			
			$arr_reserve[] = $record_reserve;
		}
		
		return $arr_reserve;
			
		
	}
	
   

?>
