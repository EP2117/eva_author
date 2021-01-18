<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

$list_company = getCompanyDetails();
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (PHP_SAPI == 'cli') 
	die('This Report should only be run from a Web Browser');

/** Include PHPExcel */
require_once  '../PHPExcel/Classes/PHPExcel.php';

	require_once 'stock-available-model.php';		
	$stockList = stockDetailsList();
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator('')
							 ->setLastModifiedBy('')
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Report file");

$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$styleArray2 = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THICK
    )
  )
);
$styleArray3 = array(
  'borders' => array(
    'outline' => array(
      'style' => PHPExcel_Style_Border::BORDER_THICK
    )
  )
);

/*$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);*/

$row =1;

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'T'.$row);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'T'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $list_company['company_name']);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);
					
$row = $row + 1;	

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'T'.$row);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'T'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,'STOCK AVAILABILITY'	);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);

$row = $row + 2;
$product_status		= (isset($_REQUEST['product_status']))?$_REQUEST['product_status']:''; 
if($product_status==2){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, 'No')
					->setCellValue('B'.$row, 'Product code')
					->setCellValue('C'.$row, 'Brand')
					->setCellValue('D'.$row, 'Product name')
					->setCellValue('E'.$row, 'Color')
					->setCellValue('F'.$row, 'Thick')
					->setCellValue('G'.$row, 'Width')
					->setCellValue('I'.$row, 'Pur length')
					->setCellValue('K'.$row, 'Pur Weight')
					->setCellValue('M'.$row, 'Sale length')
					->setCellValue('O'.$row, 'Sale Weight')
					->setCellValue('Q'.$row, 'Clo length')
					->setCellValue('S'.$row, 'Clo Weight');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.":".'H'.$row);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$row.":".'J'.$row);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K'.$row.":".'L'.$row);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('M'.$row.":".'N'.$row);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('O'.$row.":".'P'.$row);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('Q'.$row.":".'R'.$row);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('S'.$row.":".'T'.$row);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'T'.$row)->getFont()->setBold(true);
$row = $row + 1;	
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('G'.$row, 'INCHES')
					->setCellValue('H'.$row, 'MM')
					->setCellValue('I'.$row, 'FEET')
					->setCellValue('J'.$row, 'METER')
					->setCellValue('K'.$row, 'TONE')
					->setCellValue('L'.$row, 'KG')
					->setCellValue('M'.$row, 'FEET')
					->setCellValue('N'.$row, 'METER')
					->setCellValue('O'.$row, 'TONE')
					->setCellValue('P'.$row, 'KG')
					->setCellValue('Q'.$row, 'FEET')
					->setCellValue('R'.$row, 'METER')
					->setCellValue('S'.$row, 'TONE')
					->setCellValue('T'.$row, 'KG');
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'T'.$row)->getFont()->setBold(true);
				
}elseif($product_status==3){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, 'No')
					->setCellValue('B'.$row, 'Product code')
					->setCellValue('C'.$row, 'Brand')
					->setCellValue('D'.$row, 'Product name')
					->setCellValue('E'.$row, 'Color')
					->setCellValue('F'.$row, 'Thick')
					->setCellValue('G'.$row, 'Width')
					->setCellValue('I'.$row, 'length')
					->setCellValue('K'.$row, 'Weight')
					->setCellValue('M'.$row, 'Pur Qty')
					->setCellValue('N'.$row, 'Sale Qty')
					->setCellValue('O'.$row, 'Closing Qty');
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.":".'H'.$row);
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$row.":".'J'.$row);
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K'.$row.":".'L'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'T'.$row)->getFont()->setBold(true);
		$row = $row + 1;
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('G'.$row, 'INCHES')
					->setCellValue('H'.$row, 'MM')
					->setCellValue('I'.$row, 'FEET')
					->setCellValue('J'.$row, 'METER')
					->setCellValue('K'.$row, 'TONE')
					->setCellValue('L'.$row, 'KG');
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'T'.$row)->getFont()->setBold(true);
				
}elseif($product_status==1){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, 'No')
					->setCellValue('B'.$row, 'Product code')
					->setCellValue('C'.$row, 'Brand')
					->setCellValue('D'.$row, 'Product name')
					->setCellValue('E'.$row, 'Pur Qty')
					->setCellValue('F'.$row, 'Sale Qty')
					->setCellValue('G'.$row, 'Closing Qty');
}
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'T'.$row)->getFont()->setBold(true);

$row = $row + 1;
$s_no		= 1;	
foreach($stockList as $result){
	if($product_status==2){
		$product_code			= $result['product_con_entry_child_product_detail_code'];
		$product_name			= $result['product_con_entry_child_product_detail_name'];
		$product_uom_name		= $result['product_uom_name'];
		$product_width_inches	= $result['product_con_entry_child_product_detail_width_inches'];
		$product_width_mm		= $result['product_con_entry_child_product_detail_width_mm'];
		$product_thick_ness		= ($result['product_con_entry_child_product_detail_thick_ness']==0)?'':$arr_thick[$result['product_con_entry_child_product_detail_thick_ness']];
	
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, $s_no++)
					->setCellValue('B'.$row, $product_code)
					->setCellValue('C'.$row, $result['brand_name'])
					->setCellValue('D'.$row, $product_name)
					->setCellValue('E'.$row, $result['product_colour_name'])
					->setCellValue('F'.$row, $product_thick_ness)
					->setCellValue('G'.$row, $product_width_inches)
					->setCellValue('H'.$row, $product_width_mm)
					->setCellValue('I'.$row, number_format($result['pur_length_feet'],2,'.',''))
					->setCellValue('J'.$row, number_format($result['pur_length_feet']*0.3048,2,'.',''))
					->setCellValue('K'.$row, number_format($result['pur_weight_tone'],2,'.',''))
					->setCellValue('L'.$row, number_format($result['pur_weight_kg'],2,'.',''))
					->setCellValue('M'.$row, number_format($result['sal_length_feet'],2,'.',''))
					->setCellValue('N'.$row, number_format($result['sal_length_feet']*0.3048,2,'.',''))
					->setCellValue('O'.$row, number_format($result['sal_weight_tone'],2,'.',''))
					->setCellValue('P'.$row, number_format($result['sal_weight_kg'],2,'.',''))
					->setCellValue('Q'.$row, number_format($result['closing_length_feet'],2,'.',''))
					->setCellValue('R'.$row, number_format($result['closing_length_meter']*0.3048,2,'.',''))
					->setCellValue('S'.$row, number_format($result['closing_weight_tone'],2,'.',''))
					->setCellValue('T'.$row, number_format($result['closing_weight_kg'],2,'.',''));
	}elseif($product_status==3){
	
		$product_code			= $result['product_con_entry_child_product_detail_code'];
		$product_name			= $result['product_con_entry_child_product_detail_name'];
		$product_uom_name		= $result['product_uom_name'];
		$product_width_inches	= $result['product_con_entry_child_product_detail_width_inches'];
		$product_width_mm		= $result['product_con_entry_child_product_detail_width_mm'];
		$product_thick_ness		= ($result['product_con_entry_child_product_detail_thick_ness']==0)?'':$arr_thick[$result['product_con_entry_child_product_detail_thick_ness']];
	
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, $s_no++)
					->setCellValue('B'.$row, $product_code)
					->setCellValue('C'.$row, $result['brand_name'])
					->setCellValue('D'.$row, $product_name)
					->setCellValue('E'.$row, $result['product_colour_name'])
					->setCellValue('F'.$row, $product_thick_ness)
					->setCellValue('G'.$row, $product_width_inches)
					->setCellValue('H'.$row, $product_width_mm)
					->setCellValue('I'.$row, number_format($result['stock_ledger_length_feet'],2,'.',''))
					->setCellValue('J'.$row, number_format($result['stock_ledger_length_feet']*0.3048,2,'.',''))
					->setCellValue('K'.$row, number_format($result['stock_ledger_weight_tone'],2,'.',''))
					->setCellValue('L'.$row, number_format($result['stock_ledger_weight_kg'],2,'.',''))
					->setCellValue('M'.$row, number_format($result['pur_qty'],2,'.',''))
					->setCellValue('N'.$row, number_format($result['sal_qty'],2,'.',''))
					->setCellValue('O'.$row, number_format($result['closing_qty'],2,'.',''));
	}elseif($product_status==1){
		$product_code			= $result['product_code'];
		$product_name			= $result['product_name'];
		$product_uom_name		= $result['product_uom_name'];
	
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, $s_no++)
					->setCellValue('B'.$row, $product_code)
					->setCellValue('C'.$row, $result['brand_name'])
					->setCellValue('D'.$row, $product_name)
					->setCellValue('E'.$row, number_format($result['pur_qty'],2,'.',''))
					->setCellValue('F'.$row, number_format($result['sal_qty'],2,'.',''))
					->setCellValue('G'.$row, number_format($result['closing_qty'],2,'.',''));
	}
$row = $row + 1;				
}	
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('STOCK AVAILABILITY');
$output_file_name = "Stock Available.xlsx";

// Set active sheet index to the first sheet, so Excel opens this as the first sheet

// Save Excel 2007 file
#echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
// We'll be outputting an excel file
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// It will be called file.xls
header('Content-Disposition: attachment; filename="'.$output_file_name.'"');
$objWriter->save('php://output');
exit;
