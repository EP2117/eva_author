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

include "overtime-model.php"; 
$results = listOvertime();

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
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
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
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,'Overtime Entry'	);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);

$row = $row + 2;
	
$objPHPExcel->setActiveSheetIndex(0)

			
			->setCellValue('A'.$row, 'S.No')
			->setCellValue('B'.$row, 'Employee')
			->setCellValue('C'.$row, 'Branch')
			->setCellValue('D'.$row, 'OT type')
			->setCellValue('E'.$row, 'In-Time')
			->setCellValue('F'.$row, 'Out-Time')
			->setCellValue('G'.$row, 'Date')
			->setCellValue('H'.$row, 'Rate')
			->setCellValue('I'.$row, 'Amount')
			->setCellValue('J'.$row, 'Total Hrs');	


$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'J'.$row)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'J'.$row)->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'J'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$row			= $row + 1;
$start			= 1;		
$total_amt		= 0;
	foreach($results as $value) {
		
	
		$res='';
		if($value['ot_type_id']==1){ $res="Noraml"; }elseif($value['ot_type_id']==2){ $res="Sat"; }else{ $res= "";} 
		
		
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, $start++)
					->setCellValue('B'.$row, $value['employee_name'])
					->setCellValue('C'.$row, $value['branch_name'])
					->setCellValue('D'.$row, $res)
					->setCellValue('E'.$row, $value['ot_starttime'])
					->setCellValue('F'.$row, $value['ot_endtime'])
					->setCellValue('G'.$row, $value['ot_date'])
					->setCellValue('H'.$row, $value['ot_rate'])
					->setCellValue('I'.$row, $value['ot_amount'])
					->setCellValue('J'.$row, $value['diftime']);
					

		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		
		
		$row = $row + 1;
	} 

$row = $row + 1;

	
	
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Overtime Entry');
$output_file_name = "Overtime Entry.xlsx";

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
