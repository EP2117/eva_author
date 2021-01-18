<?php 

	require_once('../includes/config/config.php');

    //supplier ID

	$calculation_id  	= $_GET["calculation_id"];

	$calc_amount  		= $_GET["calc_amount"];
	$pr_id  			= isset($_GET["pr_id"])?$_GET["pr_id"]:'';
	$child_type  			= isset($_GET["child_type"])?$_GET["child_type"]:'';
	$thick  			= isset($_GET["thick"])?$_GET["thick"]:'';
	$brand_id  			= isset($_GET["brand_id"])?$_GET["brand_id"]:'';
	$width_inches  			= isset($_GET["width_inches"])?$_GET["width_inches"]:'';
	//echo $child_type ;exit;
	//echo number_format($record_supplier['product_calculation_fleet']*$calc_amount,'4','.','')."@".$record_supplier['product_calculation_inches']*$calc_amount."@".$record_supplier['product_calculation_mm']*$calc_amount."@".$record_supplier['product_calculation_meter']*$calc_amount;

	if($calculation_id==1 ){
		
		echo number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format(($calc_amount*304.8),'4','.','')."@".number_format(($calc_amount*0.3048),'4','.','')."@".number_format(($calc_amount*10),'2','.','')."@".number_format((($calc_amount*10)*1000),'2','.','');

	}

	if($calculation_id==2){

		echo number_format(($calc_amount/12),'4','.','')."@".number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*25.4),'4','.','')."@".number_format(($calc_amount*0.0254),'4','.','');

	}

	if($calculation_id==3){

		echo number_format(($calc_amount/304.8),'4','.','')."@".number_format(($calc_amount/25.4),'4','.','')."@".number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*0.001),'4','.','');

	}

	if($calculation_id==4){

		echo number_format(($calc_amount/0.3048),'4','.','')."@".number_format(($calc_amount/0.0254),'4','.','')."@".number_format(($calc_amount*1000),'4','.','')."@".number_format(($calc_amount*1),'4','.','');

	}
	
	if($calculation_id==5){

		echo number_format(($calc_amount/12),'4','.','')."@".number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*25.4),'4','.','')."@".number_format(($calc_amount*0.0254),'4','.','');

	}

	if($calculation_id==6){

		echo number_format(($calc_amount/304.8),'4','.','')."@".number_format(($calc_amount/25.4),'4','.','')."@".number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*0.001),'4','.','');

	}
	
	if($calculation_id==7){

		echo number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format(($calc_amount*304.8),'4','.','')."@".number_format(($calc_amount*0.3048),'4','.','');

	}
	
	if($calculation_id==8){

		echo number_format(($calc_amount/0.3048),'4','.','')."@".number_format(($calc_amount/0.0254),'4','.','')."@".number_format(($calc_amount*1000),'4','.','')."@".number_format(($calc_amount*1),'4','.','');

	} if($calculation_id==9 ||  $calculation_id==10){
	
	if($child_type==1){
		if($calculation_id==10){
	 $select="SELECT * FROM weight_calulation WHERE wc_brand_id='".$brand_id."' AND wc_thickid='".$thick."'  AND wc_wight_inches='".$width_inches."' LIMIT 1";
	 //echo $select;exit;
		$query=mysql_query($select);
		$result=mysql_fetch_array($query);
	
	echo number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format((304.8*$calc_amount),'4','.','')."@".number_format((0.3048*$calc_amount),'4','.','')."@".number_format(($result['wc_weight_ton']*$calc_amount),'4','.','')."@".number_format(($result['wc_weight_mm']*$calc_amount),'2','.','');
	}else{
	$select="SELECT * FROM weight_calulation WHERE wc_brand_id='".$brand_id."' AND wc_thickid='".$thick."'  AND wc_wight_inches='".$width_inches."' LIMIT 1";
	 //echo $select;exit;
		$query=mysql_query($select);
		$result=mysql_fetch_array($query);
	
	echo number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format(($result['wc_length_feet']*$calc_amount),'4','.','')."@".number_format(($result['wc_length_mm']*$calc_amount),'4','.','')."@".number_format(($result['wc_weight_ton']*$calc_amount),'4','.','')."@".number_format(($result['wc_weight_mm']*$calc_amount),'2','.','');
	}
	
	}else{
	 $select="SELECT product_con_entry_osf_width_inches,product_con_entry_osf_width_mm,product_con_entry_osf_length_feet,product_con_entry_osf_length_m,product_con_entry_osf_uom_ton,product_con_entry_osf_uom_kg,product_con_entry_child_product_detail_length_feet,product_con_entry_child_product_detail_ton_qty,product_con_entry_child_product_detail_length_mm FROM product_con_entry_child_product_details WHERE product_con_entry_child_product_detail_id='".$pr_id."' ";
		//echo $select;exit;
		$query=mysql_query($select);
		$result=mysql_fetch_array($query);
		//echo $select;exit;
		/*echo number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format(($calc_amount*304.8),'4','.','')."@".number_format(($calc_amount*0.3048),'4','.','')."@".number_format(($calc_amount*10),'2','.','')."@".number_format((($calc_amount*10)*1000),'2','.','');*/
		
		if($calculation_id==9){
		echo number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format(($calc_amount*($result['product_con_entry_child_product_detail_length_feet']/$result['product_con_entry_child_product_detail_ton_qty'])),'4','.','')."@".number_format((0),'4','.','')."@".number_format(($calc_amount*($result['product_con_entry_child_product_detail_length_mm']/$result['product_con_entry_child_product_detail_ton_qty'])),'4','.','')."@".number_format(($calc_amount*($result['product_con_entry_osf_length_m']/$result['product_con_entry_child_product_detail_ton_qty'])),'4','.','');
		}else{
			echo number_format(($calc_amount*1),'4','.','')."@".number_format(($calc_amount*12),'4','.','')."@".number_format(($calc_amount*($result['product_con_entry_osf_length_feet'])),'4','.','')."@".number_format(($calc_amount*$result['product_con_entry_osf_length_m']),'4','.','')."@".number_format(($calc_amount*$result['product_con_entry_osf_uom_ton']),'2','.','')."@".number_format((($calc_amount*$result['product_con_entry_osf_uom_kg'])),'2','.','');	
		}
		
	}		
	}

?>



			 

 

  



 

 