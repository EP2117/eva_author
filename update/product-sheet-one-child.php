<?php 
	require('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php 
if (isset($_FILES['file'])) {
	
	require_once "simplexlsx.class.php";
	
	$xlsx = new SimpleXLSX( $_FILES['file']['tmp_name'] );
?>
<table border="1" cellpadding="3" style="border-collapse: collapse">
	<?php
	$i=1;
	list($cols,) = $xlsx->dimension();
	//echo "<pre>";
	//print_r($xlsx->rows()); exit;
	$a= 0;
	foreach( $xlsx->rows() as $k => $r) {
	?> 
  <tr>
    <?php 
		$rows = 0;
		if(!empty($r[1]) && $r[3]!= 'Color') {
			$product_brand 					= trim($r[2]);
			$product_code 					= trim($r[0]);
			$product_name 					= trim($r[1]);
			$product_colour_name			= trim($r[3]);
			$produc_thick					= trim($r[4]);
			$product_width 					= trim($r[5]);
			$product_width_mm				= number_format(($product_width*25.4),'4','.','');
			$product_feet 					= trim($r[6]);
			$product_feet_mm				= number_format(($product_feet*304.8),'4','.','');
			$product_weight_kg 				= trim($r[7]);
			$product_weight_ton				= number_format(($product_weight_kg/1000),'4','.','');
			
			$osf_feet						= "1";
			$osf_feet_mm					= number_format(($osf_feet*304.8),'4','.','');
			
			$osf_ton						= ($osf_feet/$product_feet)*$product_weight_ton;
			$osf_ton_kg						= $osf_ton*1000;
			
			$product_uom_id					= '1';
			$select="select * FROM brands WHERE brand_name ='".$product_brand."'";
			$query=mysql_query($select);
			$result=mysql_fetch_array($query);
			$brand_id=$result['brand_id'];
			if($brand_id=='' || $brand_id==0){
			$insert="insert into brands(brand_name)values('".$product_brand."')";
			mysql_query($insert);
			
			$brands_id=mysql_insert_id();
			
			}
			
			if($brand_id=='' || $brand_id==0){
			$pro_brand_id =$brands_id;
			}else{
			$pro_brand_id =$brand_id;
			}
			
			$select="select * FROM product_colours WHERE product_colour_name ='".$product_colour_name."'";
			$query=mysql_query($select);
			$result=mysql_fetch_array($query);
			$product_colour_id=$result['product_colour_id'];
			if($product_colour_id=='' || $product_colour_id==0){
			$product_colour_uniq_id 	= generateUniqId();
			$insert="insert into product_colours(product_colour_uniq_id,product_colour_name)values('".$product_colour_uniq_id."','".$product_colour_name."')";
			mysql_query($insert);
			
			$product_colour_id=mysql_insert_id();
			
			}
			
			$produc_thick_val		= str_replace("mm",'',$produc_thick);
			$select="select * FROM thickness WHERE REPLACE(`thick_val`,'mm','') ='".$produc_thick."'";
			$query=mysql_query($select);
			$result=mysql_fetch_array($query);
			$thick_id=$result['thick_id'];
			if($thick_id=='' || $thick_id==0){
				$insert="insert into thickness(thick_val)values('".$produc_thick."')";
				mysql_query($insert);
				$thick_id	=	mysql_insert_id();
			}
			
			
			 $select_uom="select product_id	FROM products WHERE product_brand_id ='".$pro_brand_id."' AND product_name = '".$product_name."'";
			$query_uom=mysql_query($select_uom);
			$result_uom=mysql_fetch_array($query_uom);
			$product_id=$result_uom['product_id'];
			
			if($product_id=='' || $product_id==0){
				$product_uniq_id 	= generateUniqId();
				$select_product_code 	=	"SELECT 
												SUBSTRING( MAX( product_code ) , 3, 6 )  AS product_code  
											 FROM 
												products
											 WHERE 
												product_code  				LIKE 'PR%' 											AND
												product_deleted_status 		= 0";
				$result_product_code 	= mysql_query($select_product_code);
				$record_product_code   	= mysql_fetch_array($result_product_code);					
				$max_product_code 		= $record_product_code['product_code'];
				$pro_product_code		= 'PR'.substr(('000000'.++$max_product_code),-6);
					
			 	$insert_customer 	=   "INSERT INTO products( product_uniq_id,product_brand_id,
															  product_code,
															  product_name,
															  product_purchase_uom_id,
															  product_type) 
														VALUES ('".$product_uniq_id."',
																'".$pro_brand_id."',
																'".$pro_product_code."',
																'".$product_name."',
																'".$product_uom_id."',
																 '1')";
				mysql_query($insert_customer);	
				$product_id=mysql_insert_id();
				
			}
			$mas_product_id	 = $product_id;
				$product_uniq_id 	= generateUniqId();
			 	$insert_customer 	=   "INSERT INTO product_con_entry_child_product_details( product_con_entry_child_product_detail_uniq_id,
															  product_con_entry_child_product_detail_product_id,
															  product_con_entry_child_product_detail_product_brand_id,
															  product_con_entry_child_product_detail_mas_product_id,
															  product_con_entry_child_product_detail_code,
															  product_con_entry_child_product_detail_name,
															  product_con_entry_child_product_detail_color_id,
															  product_con_entry_child_product_detail_thick_ness,
															  product_con_entry_child_product_detail_width_inches,
															  product_con_entry_child_product_detail_width_mm,
															  product_con_entry_child_product_detail_length_mm,
															  product_con_entry_child_product_detail_length_feet,
															  product_con_entry_child_product_detail_ton_qty,
															  product_con_entry_child_product_detail_kg_qty,
															  product_con_entry_child_product_detail_uom_id,
															  product_con_entry_osf_width_inches,
															  product_con_entry_osf_width_mm,
															  product_con_entry_osf_length_feet,
															  product_con_entry_osf_length_m,
															  product_con_entry_osf_uom_ton,
															  product_con_entry_osf_uom_kg,
															  product_con_entry_child_product_detail_type) 
														VALUES ('".$product_uniq_id."',
																'".$product_id."',
																'".$pro_brand_id."',
																'".$product_id."',
																'".$product_code."',
																'".$product_name."',
																'".$product_colour_id."',
																'".$thick_id."',
																'".$product_width."',
																'".$product_width_mm."',
																'".$product_feet_mm."',
																'".$product_feet."',
																'".$product_weight_ton."',
																'".$product_weight_kg."',
																'".$product_uom_id."',
																'".$product_width."',
																'".$product_width_mm."',
																'".$osf_feet."',
																'".$osf_feet_mm."',
																'".$osf_ton."',
																'".$osf_ton_kg."',
																'2')"; 
				$ins_cus	= mysql_query($insert_customer);	
				if($ins_cus){
				$product_id=mysql_insert_id();
					$branchid			= '1';	
					$product_con_entry_godown_id						= 	"1";
					stockLedger('in',$product_id,$product_id,$product_id,$product_feet,$product_feet_mm,$product_weight_ton,$product_weight_kg,'1', $branchid,  $product_con_entry_godown_id, '2018-09-01',$product_code,'OPEN-ENTRY', '2',$product_width,$product_width_mm,$product_colour_id,$thick_id);
					$product_con_entry_godown_id						= 	"2";
					stockLedger('in',$product_id,$product_id,$mas_product_id,$product_feet,$product_feet_mm,$product_weight_ton,$product_weight_kg,'1', $branchid,  $product_con_entry_godown_id, '2018-09-01',$product_code,'OPEN-ENTRY', '2',$product_width,$product_width_mm,$product_colour_id,$thick_id);
					
				}
				else{
					echo $product_code."<br>";
				}
		}
		 $i=$i +1;
 	?>
  </tr>
 <?php $a = $a +1; } ?>
</table>
<?php } ?>
<h1>Upload</h1>
<form method="post" enctype="multipart/form-data">
*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>

</body>
</html>
