<?php
require_once '../includes/connection.php';
require_once '../includes/utility-class.php';

$list_company = getCompanyDetails();
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (PHP_SAPI == 'cli')
	die('This Report should only be run from a Web Browser');

/** Include PHPExcel */
require_once  '../PHPExcel/Classes/PHPExcel.php';

include "invoice-entry-report-model.php"; 
$results = quotationReport();

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
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);

$row =1;

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'F'.$row);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $list_company['company_name']);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);
					
$row = $row + 1;	

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'F'.$row);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,'Daily Sales Report - Invoice Entry'	);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);

$row = $row + 2;
	
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$row, 'No')
			->setCellValue('B'.$row, 'Invoice No.')
			->setCellValue('C'.$row, 'Date')
			->setCellValue('D'.$row, 'Customer')
			->setCellValue('E'.$row, 'SalesMan')
			->setCellValue('F'.$row, 'Total');	


$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'F'.$row)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'F'.$row)->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$row			= $row + 1;
$start			= 1;		
$total_amt		= 0;
	foreach($results as $value) {
		
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, $start++)
					->setCellValue('B'.$row, $value['invoice_entry_no'])
					->setCellValue('C'.$row, dateGeneralFormat($value['invoice_entry_date']))
					->setCellValue('D'.$row, $value['customer_name'].'-'.$value['customer_code'])
					->setCellValue('E'.$row, $value['salesman_name'])
					->setCellValue('F'.$row, $value['invoice_entry_total_amount']);
					
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'E'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$total_amt += $value['invoice_entry_total_amount'];
		$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()->setFormatCode('0.00');
		$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getFont()->setName('Zawgyi-One');
		$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getFont()->setName('Zawgyi-One');
		
		$row = $row + 1;
	} 

$row = $row + 1;

	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'E'.$row);
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Total: ');	
	$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('F'.$row, number_format($total_amt,2,'.',''));
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'F'.$row)->applyFromArray($styleArray2);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'F'.$row)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()->setFormatCode('0.00');
	
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Daily Sales Report - Invoice');
$output_file_name = "Daily Sales Report - Invoice.xlsx";

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->freezePane('G5');


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
