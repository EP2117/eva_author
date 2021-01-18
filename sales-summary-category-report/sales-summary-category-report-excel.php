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

require_once "sales-summary-category-pdf-model.php"; 
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
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);

$row =1;

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'D'.$row);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $list_company['company_name']);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);
					
$row = $row + 1;	

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'D'.$row);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,'Daily Sales Report - quotation Entry'	);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);

$row = $row + 2;
	
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$row, 'No')
			->setCellValue('B'.$row, 'Category')
			->setCellValue('C'.$row, 'Type')
			->setCellValue('D'.$row, 'Amount');	


$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'D'.$row)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'D'.$row)->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$row			= $row + 1;
$start			= 1;		
$total_amt		= 0;
$customer_id	='';
$total_grand		= 0;
	foreach($results as $value) {
	
	if($customer_id !=$value['quotation_entry_date'])

			{

			if($start!='1'){
				
					$objPHPExcel->setActiveSheetIndex(0)

				
				->setCellValue('E'.$row, number_format($total_amt,2,'.',''));

		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'D'.$row)->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getNumberFormat()->setFormatCode('0.00');

		


					$row			= $row + 1;	

				}

				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'D'.$row);

				$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,dateGeneralFormatN($value['quotation_entry_date']))	;	

				$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true); 

				

				$total_amt 		= 0;

				
				$row					= $row + 1;

			$customer_id =$value['quotation_entry_date'];

			}
		if($value['invoice_entry_direct_type']==1){ $type = 'Direct Invoice'; }else{ $type = 'Invoice'; }
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, $start++)
					->setCellValue('B'.$row, $value['product_category_name'])
					->setCellValue('C'.$row, $type)
					->setCellValue('D'.$row, $value['invoice_entry_net_amount']);
					
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'C'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$total_grand += $value['invoice_entry_net_amount'];
		$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getNumberFormat()->setFormatCode('0.00');
		$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getFont()->setName('Zawgyi-One');
		$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getFont()->setName('Zawgyi-One');
		
		$row = $row + 1;
	} 
	
	$row = $row + 1;

	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.":".'C'.$row);
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Total: ');	
	$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('D'.$row, number_format($total_grand,2,'.',''));
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'C'.$row)->applyFromArray($styleArray2);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'C'.$row)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getNumberFormat()->setFormatCode('0.00');
	
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Daily Sales Report - quotation');
$output_file_name = "Daily Sales Report - quotation.xlsx";

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
