<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();

	require_once 'width-cutting-model.php';

		$branch_list		= getBranchList();
		$godown_list		= getGodownList();

		if(isset($_POST['recycle_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$recycle_entry_edit			= editQuotation();
			$recycle_entry_prd_edit		= editQuotationProductDetail();
			$recycle_entry_width_edit	= editWidthDetail();
			$product_con_entry_child_prd_edit	= editChildProductDetail();
		}

		if(isset($_POST['recycle_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['recycle_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'width-cutting-view.php';

?>