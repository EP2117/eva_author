<?php 

	function listReport(){
		$where='';
		if(!empty($_REQUEST['brandid'])){
			$where .= " AND product_brand_id='".$_REQUEST['brandid']."'";
		}
		if(!empty($_REQUEST['ps_1'])){
			$where .= "AND product_product_category_id='".$_REQUEST['ps_1']."'";
		}
		if(!empty($_REQUEST['prod_status'])){
			$where .= " AND dms_product_status='".$_REQUEST['prod_status']."'";
		}
		
		 $query = "SELECT writeoffId,DATE_FORMAT(wr_date,'%d-%m-%Y') wr_date,product_code,product_name,product_uom_name,brand_name,wrP_addqty,wrP_lessqty,dms_product_status,product_product_category_id,product_category_name
					  FROM write_off  
					  LEFT JOIN write_off_product_detail ON  writeoffId=wrP_writeoffId
					  LEFT JOIN damg_missing_scrp_details ON wr_dmgMsgScrpId=dmgMsgScrpId
		 			  LEFT JOIN products ON wrP_product_id = product_id
					  LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id
					  LEFT JOIN brands ON brand_id = product_brand_id	
					  LEFT JOIN product_categories ON product_product_category_id=product_category_id	
					  WHERE wr_branchid='".$_REQUEST['branchid']."' AND wr_warehouseid='".$_REQUEST['warehouseid']."' AND (wr_date BETWEEN  '".date('Y-m-d',strtotime($_REQUEST['fromdate']))."' AND '".date('Y-m-d',strtotime($_REQUEST['todate']))."') $where ";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	

?>
