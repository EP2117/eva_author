<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'delivery-entry-model.php';
		$branch_list		= getBranchList();
		$customer_list		= getCustomerList();
		$salesman_list		= getSalesmanList();
		$godown_list		= getGodownList();
		if(isset($_POST['do_god_entry_insert'])){
			insertQuotation();
		}
		if(!isset($_REQUEST['page'])) {
			$quotation_list	= listQuotation();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$do_god_entry_edit		= editQuotation();
			$do_god_entry_prd_edit	= editQuotationProductDetail();
		}
		if(isset($_POST['do_god_entry_update'])){
			updateQuotation();
		}
		if(isset($_REQUEST['product_detail_delete'])){
			deleteProductdetail();
		}
		if(isset($_REQUEST['do_god_entry_entry_delete'])){
			deleteInventoryrequest();
		}
	require_once 'delivery-entry-view.php';
?>