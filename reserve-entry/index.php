<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'reserve-entry-model.php';

		$godown_list		= getGodownList();
		$branch_list		= getBranchList();
		if(isset($_POST['reserve_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$reserve_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$reserve_edit 		= editQuotation();

			$reserve_entry_prd_edit	= editQuotationProductDetail();

		}

		if(isset($_POST['reserve_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['reserve_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'reserve-entry-view.php';

?>