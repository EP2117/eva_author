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

include "leave-model.php"; 
$results = listLeave();

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
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,'Leave Entry'	);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);

$row = $row + 2;
	
$objPHPExcel->setActiveSheetIndex(0)

			
			->setCellValue('A'.$row, 'S.No')
			->setCellValue('B'.$row, 'Employee')
			->setCellValue('C'.$row, 'Branch')
			->setCellValue('D'.$row, 'Start date')
			->setCellValue('E'.$row, 'End date')
			->setCellValue('F'.$row, 'Date')
			->setCellValue('G'.$row, 'Leave')
			->setCellValue('H'.$row, 'Leave Type')
			->setCellValue('I'.$row, 'Salary Type')
			->setCellValue('J'.$row, 'Payment');	


$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'J'.$row)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'J'.$row)->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.":".'J'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$row			= $row + 1;
$start			= 1;		
$total_amt		= 0;
	foreach($results as $value) {
		
		$val='';
		if($value['lv_leave']==1){ $val="Full"; }elseif($value['lv_leave']==2){ $val= "Half"; }else{ $val= "";} 
		
		$res='';
		if($value['lv_leave_salary_type']==1){ $res= "Supporting Pay"; }elseif($value['lv_leave_salary_type']==2){ $res= "Without Leave Bonus "; }elseif($value['lv_leave_salary_type']==3){ $res= "Basic Salary"; }else{ $res= "";}
		
		
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, $start++)
					->setCellValue('B'.$row, $value['employee_name'])
					->setCellValue('C'.$row, $value['branch_name'])
					->setCellValue('D'.$row, dateGeneralFormat($value['lv_fromdate']))
					->setCellValue('E'.$row, dateGeneralFormat($value['lv_todate']))
					->setCellValue('F'.$row, dateGeneralFormat($value['lv_date']))
					->setCellValue('G'.$row, $val)
					->setCellValue('H'.$row, $arr_leaveType[$value['lv_leavetype']])
					->setCellValue('I'.$row, $res)
					->setCellValue('J'.$row, $payment[$value['lv_paymentid']]);
					

		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		
		
		$row = $row + 1;
	} 

$row = $row + 1;

	
	
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Leave Entry');
$output_file_name = "Leave Entry.xlsx";

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
