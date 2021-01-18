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
	/*echo "<pre>";
	print_r($xlsx->rows()); exit;*/
	$a= 0;
	foreach( $xlsx->rows() as $k => $r) {
	
	?> 
 
  <tr>
    <?php 
	
		$rows = 0;
		
		if($r[0]!='' && $r[0]!= 'Prd Name') {
			$product_brand 					= trim($r[0]);
			$product_code 					= trim($r[1]);
			$product_name 					= trim($r[2]);
			$product_uom 					= trim($r[3]);
			$product_qty 					= trim($r[4]);
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
			$product_uom_id			= '2';
			$product_uniq_id 	= generateUniqId();
			$insert_customer =   "INSERT INTO products( product_uniq_id,product_brand_id,
														  product_code,
														  product_name,
														  product_purchase_uom_id,
														  product_type) 
													VALUES ('".$product_uniq_id."',
															'".$pro_brand_id."',
															'".$product_code."',
															'".$product_name."',
															'".$product_uom_id."',
															 '2')";
			$result	= mysql_query($insert_customer);
			if($result){
			
			}
			else{
				$product_code."==".$product_name."<br>";
			}
			$product_id		= mysql_insert_id();	
			
					$branchid			= '1';	
					$product_con_entry_godown_id						= 	"1";
					$product_feet			= '1';
					$product_feet_mm		= '1';
					$product_weight_ton		= '1';
					$product_weight_kg		= '1';
					$product_width_mm		= '1';
					$product_colour_id		= '1';
					$thick_id				= '1';
					$product_feet_mm		= '1';
					$product_feet_mm		= '1';
					$product_feet_mm		= '1';
					$product_width			= '1';
					stockLedger('in',$product_id,$product_id,$product_id,$product_feet,$product_feet_mm,$product_weight_ton,$product_weight_kg,$product_qty, $branchid,  $product_con_entry_godown_id, '2018-06-01',$product_code,'OPEN-ENTRY', '1',$product_width,$product_width_mm,$product_colour_id,$thick_id);
			
		}
		 $i=$i +1;


	
	
 	?>
  </tr>
 <?php $a = $a +1; } 	 
 ?>
</table>
<?php } ?>
<h1>Upload</h1>
<form method="post" enctype="multipart/form-data">
*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>

</body>
</html>
