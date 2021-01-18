<?php
	function listQuotation()
	{
	$where	= '';
		if((isset($_REQUEST['search_branch_id']))&& !empty($_REQUEST['search_branch_id'])){
			$where	.=" AND delivery_customer_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND delivery_customer_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['customerid']))&& !empty($_REQUEST['customerid']))
		{
		$where.="AND delivery_customer_customer_id ='".$_REQUEST['customerid']."'";
		}
		if(isset($_REQUEST['search_type_id']) && (!empty($_REQUEST['search_type_id']))) {
			
			$where .= " AND invoice_entry_direct_type = '".$_REQUEST['search_type_id']."'";
		}
		if(isset($_REQUEST['product_categoryid']) && (!empty($_REQUEST['product_categoryid']))) {
			
			$where .= " AND product_product_category_id = '".$_REQUEST['product_categoryid']."'";
		}
		 $select_delivery_entry		=	"SELECT 
												delivery_customer_id,
												delivery_customer_uniq_id,
												delivery_customer_no,product_category_name,
												delivery_customer_date,invoice_entry_product_detail_total,
												customer_name,invoice_entry_direct_type,
												delivery_customer_address,product_product_category_id,
												branch_prefix
											 FROM 
												delivery_customer_product_details
												 LEFT JOIN
												delivery_customer
											 ON
												delivery_customer_id		=  delivery_customer_product_detail_delivery_customer_id
												
												LEFT JOIN 
												products 
													ON 
												product_id 		= delivery_customer_product_detail_product_id
												
												LEFT JOIN 
												
												product_categories 
													ON 
												product_category_id 		= product_product_category_id
												
														
											 LEFT JOIN
												customers
											 ON
												customer_id		=  delivery_customer_customer_id
												 
											 LEFT JOIN
												invoice_entry_product_details
											 ON
												invoice_entry_product_detail_id		=  delivery_customer_product_detail_invoice_detail_id	
											LEFT JOIN
												invoice_entry
											 ON
												invoice_entry_id		=  invoice_entry_product_detail_invoice_entry_id	
												
											 LEFT JOIN
												branches
											 ON
												branch_id					=  delivery_customer_branch_id
											 WHERE 
												delivery_customer_product_detail_deleted_status 	= 	0 $where
											  GROUP BY product_category_id,delivery_customer_product_detail_product_id,invoice_entry_direct_type ASC";
												//echo $select_delivery_entry;exit;
		$result_delivery_entry		= mysql_query($select_delivery_entry);
		// Filling up the array
		$delivery_entry_data 		= array();
		while ($record_delivery_entry = mysql_fetch_array($result_delivery_entry))
		{
		 $delivery_entry_data[] 	= $record_delivery_entry;
		}
		return $delivery_entry_data;
	}
?>