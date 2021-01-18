<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();

	require_once 'width-cutting-model.php';

		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		
		$brand_list			= getBrandList();

		if(isset($_POST['width_cutting_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$width_cutting_edit			= editQuotation();
			$width_cutting_prd_edit		= editQuotationProductDetail();
			$width_cutting_width_edit	= editWidthDetail();
			$product_con_entry_child_prd_edit	= editChildProductDetail();
		}

		if(isset($_POST['width_cutting_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['width_cutting_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'width-cutting-view.php';

?>