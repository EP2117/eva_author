<?php


	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
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
		if(isset($_REQUEST['search_entry_no']) && (!empty($_REQUEST['search_entry_no'])))
		 {
			$where .= " AND delivery_customer_no LIKE '%".dataValidation($_REQUEST['search_entry_no'])."%'";
		}
		$select_delivery_customer		=	"SELECT 

												delivery_customer_id,
												delivery_customer_uniq_id,
												delivery_customer_no,
												delivery_customer_date,
												customer_name,product_name,delivery_customer_product_detail_qty,
												delivery_customer_address,SUM(gatepass_entry_product_detail_qty) AS gatepass_entry_product_detail_qty,
												branch_prefix
											 FROM 
												delivery_customer_product_details
												 LEFT JOIN
												delivery_customer
											 ON
												delivery_customer_id		=  delivery_customer_product_detail_delivery_customer_id
												
												 LEFT JOIN
												 
												gatepass_entry_product_details
											 ON
												gatepass_entry_product_detail_delivery_detail_id 		=  delivery_customer_product_detail_id
												
											 LEFT JOIN
												customers
											 ON
												customer_id		=  delivery_customer_customer_id
											 LEFT JOIN
												branches
											 ON
												branch_id					=  delivery_customer_branch_id
											LEFT JOIN 
												products 
												ON 
											    product_id 									= delivery_customer_product_detail_product_id
												
											 WHERE 

												delivery_customer_product_detail_deleted_status 	= 	0 AND gatepass_entry_product_detail_deleted_status=0
												 $where
												
												GROUP BY delivery_customer_id

											 ORDER BY 

												delivery_customer_no ASC";
										//echo $select_delivery_customer;exit;

		$result_delivery_customer		= mysql_query($select_delivery_customer);

		// Filling up the array

		$delivery_customer_data 		= array();

		while ($record_delivery_customer = mysql_fetch_array($result_delivery_customer))

		{

		 $delivery_customer_data[] 	= $record_delivery_customer;

		}

		return $delivery_customer_data;

	}


?>