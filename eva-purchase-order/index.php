<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'eva-po-model.php';		
		$branch_list		= getBranchList();
		$supplier_list		= get_supplier();
	    $country_list		= getCountryList();
		$currency_list		= getCurrencyList();
		$brand_list			= getBrandList();
		$purchasemethod_array =array("1"=>"CIF","2"=>"FOB","3"=>"CNF");
		$paymentterms_array =array("1"=>"CASH","2"=>"TT","3"=>"LC");

		if(isset($_POST['purchaseorder'])){
			purchaseOrderInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$purchaseList =listpurchase();
		}
		if(isset($_REQUEST['id'])) {
			$editPurchase  = editpurchase($_REQUEST['id']);	
			$editpurchaseProd  = editpurchaseproduct($_REQUEST['id']);	
			$supplier_list  = editsupplier($editPurchase['pR_supplier_location']);	
				
		}	
		
		if(isset($_REQUEST['po_delete'])){
			evo_po_delete();
		}
		
		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}	
	require_once 'eva-po-view.php';
?>