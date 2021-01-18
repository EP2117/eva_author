<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'payment-invoice-model.php';		
		$branch_list		= getBranchList();
		$country_list		= getCountryList();
		$arr_supplier		= get_supplier();
		$arr_bank			= getBankList();
		$arr_curr			= getCurrencyList();
		if(isset($_POST['payment_insrtUpdate'])){
			paymentInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$paymentList =listPayment();
		}
		if(isset($_REQUEST['id'])) {
			$editPayment  = paymentEdit($_REQUEST['id']);	
			$editPaymentdetails  = paymentDtailsEdit($_REQUEST['id']);			
		}
		
		if(isset($_REQUEST['payment_invoice_delete'])){
		paymentdelete();
		
		}if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}			
	require_once 'payment-invoice-view.php';
?>