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

include "sales-quotation-product-report-model.php"; 
$results = quotationtypeone();

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

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$f='G';
for($i=0;$i<10;$i++){

$objPHPExcel->getActiveSheet()->getColumnDimension($f++)->setWidth(15);
}

$row =1;

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'F'.$row);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $list_company['company_name']);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);
					
$row = $row + 1;	

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'F'.$row);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,'Daily Sales Report - quotation product'	);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);

$row = $row + 2;
	$cou_a='A';
$objPHPExcel->setActiveSheetIndex(0)//->//mergeCells('G4:H4');
			->setCellValue($cou_a++.$row, 'SNo')
			->setCellValue($cou_a++.$row, 'Invoice No.')
			->setCellValue($cou_a++.$row, 'Date')
			->setCellValue($cou_a++.$row, 'Customer')
			->setCellValue($cou_a++.$row, 'BRAND')
			->setCellValue($cou_a++.$row, 'UOM')
			->setCellValue($cou_a++.$row, 'WIDTH')
			->setCellValue($cou_a++.$row, '')
			->setCellValue($cou_a++.$row, 'LENGTH')
			->setCellValue($cou_a++.$row, '')
			->setCellValue($cou_a++.$row, 'WEIGHT')
			->setCellValue($cou_a++.$row, '')
			->setCellValue($cou_a.$row, 'QTY');
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".$cou_a.$row)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".$cou_a.$row)->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".$cou_a.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
$row = $row + 1;			
$cou_aa='A';
$objPHPExcel->setActiveSheetIndex(0)//->//mergeCells('G4:H4'); 
			->setCellValue($cou_aa++.$row, '')
			->setCellValue($cou_aa++.$row, '')
			->setCellValue($cou_aa++.$row, '')
			->setCellValue($cou_aa++.$row, '')
			->setCellValue($cou_aa++.$row, '')
			->setCellValue($cou_aa++.$row, '')
			->setCellValue($cou_aa++.$row, 'INCHES')
			->setCellValue($cou_aa++.$row, 'MILI')
			->setCellValue($cou_aa++.$row, 'FEET')
			->setCellValue($cou_aa++.$row, 'METER')
			->setCellValue($cou_aa++.$row, 'TON')
			->setCellValue($cou_aa.$row, 'KG');			


$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".$cou_a.$row)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".$cou_a.$row)->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".$cou_a.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$row			= $row + 1;
$start			= 1;		
$total_amt		= 0;
$customer_id	='';
$total_grand		= 0;

$cou_a1='A';
	foreach($results as $value) {
		if($customer_id !=$value['quotation_entry_product_detail_product_id'])

			{

			if($start!='1'){
				

			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'L'.$row);
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'L'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Sub Total: ');	
	$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('M'.$row, number_format($total_amt,2,'.',''));
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'M'.$row)->applyFromArray($styleArray2);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'M'.$row)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('M'.$row)->getNumberFormat()->setFormatCode('0.000');

		


					$row			= $row + 1;	

				}

				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'M'.$row);

				$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'M'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$value['product_name']);	

				$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true); 

				

				$total_amt 		= 0;

				
				$row					= $row + 1;

			$customer_id =$value['quotation_entry_product_detail_product_id'];

			}
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($cou_a1++.$row, $start++)
					->setCellValue($cou_a1++.$row, $value['quotation_entry_no'])
					->setCellValue($cou_a1++.$row, dateGeneralFormatN($value['quotation_entry_date']))
					->setCellValue($cou_a1++.$row, $value['customer_name'].'-'.$value['customer_code'])
					->setCellValue($cou_a1++.$row, $value['brand_name'])
					->setCellValue($cou_a1++.$row, $value['product_uom_name'])
					->setCellValue($cou_a1++.$row, $value['quotation_entry_product_detail_s_width_inches'])
					->setCellValue($cou_a1++.$row, $value['quotation_entry_product_detail_s_width_mm'])
					->setCellValue($cou_a1++.$row, $value['quotation_entry_product_detail_sl_feet'])
					->setCellValue($cou_a1++.$row, $value['quotation_entry_product_detail_sl_feet_met'])
					->setCellValue($cou_a1++.$row, $value['quotation_entry_product_detail_s_weight_inches'])
					->setCellValue($cou_a1++.$row, $value['quotation_entry_product_detail_s_weight_mm'])
					->setCellValue($cou_a1++.$row, $value['quotation_entry_product_detail_qty']);
					
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".$cou_a1++.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$total_amt += $value['quotation_entry_product_detail_qty'];
		$total_grand += $value['quotation_entry_product_detail_qty'];
		$objPHPExcel->getActiveSheet()->getStyle('M'.$row)->getNumberFormat()->setFormatCode('0.000');
		$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getFont()->setName('Zawgyi-One');
		$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getFont()->setName('Zawgyi-One');
		
		$row = $row + 1;
	} 

$row = $row + 1;

	
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'L'.$row);
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'L'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Sub Total: ');	
	$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('M'.$row, number_format($total_amt,2,'.',''));
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'M'.$row)->applyFromArray($styleArray2);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'M'.$row)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('M'.$row)->getNumberFormat()->setFormatCode('0.000');

	
	$row = $row + 1;

	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'L'.$row);
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'L'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Net Total: ');	
	$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('M'.$row, number_format($total_grand,2,'.',''));
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'M'.$row)->applyFromArray($styleArray2);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'M'.$row)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('M'.$row)->getNumberFormat()->setFormatCode('0.000');	
	
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Daily Sales Report - product');
$output_file_name = "Daily Sales Report - quotation product.xlsx";

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->freezePane();


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
