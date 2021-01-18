<?php
require_once '../includes/connection.php'; 
require_once '../includes/utility-class.php'; 



/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


if (PHP_SAPI == 'cli')
	die('This Report should only be run from a Web Browser');

/** Include PHPExcel */
require_once  '../PHPExcel/Classes/PHPExcel.php';


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


$row =1;
$list_company = getCompanyDetails();

$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$row, $list_company['company_name']);	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'A'.$row)->getFont()->setBold(true);			
$row = $row + 1;	

$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$row, 'Township Report ');	
$row = $row + 1;		
					
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$row, 'ID')
			->setCellValue('B'.$row, 'Township')
			->setCellValue('C'.$row, 'State');	
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".'E'.$row)->getFont()->setBold(true);	
$row = $row + 1;			
$start = $row;		
			
						


  $select_product ="SELECT city_id,city_name,city_active_status,state_name,country_name FROM cities 
					   LEFT JOIN countries ON country_id = city_country_id
					   LEFT JOIN states ON state_id = city_state_id
					   WHERE city_delete_status = 0
					   ORDER BY city_name";
$result_product = mysql_query($select_product);
$count_product  = mysql_num_rows($result_product);
if($count_product > 0) { 
	$s_no = 1; 
	while($record_product 	= mysql_fetch_array($result_product)) {
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$row, $record_product['city_id'])
					->setCellValue('B'.$row, $record_product['city_name'])
					->setCellValue('C'.$row, $record_product['state_name']);	
		$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getFont()->setName('Zawgyi-One');;	
		$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getFont()->setName('Zawgyi-One');;	
		$row = $row + 1;
	} 
					

}





// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Township Report');
$output_file_name = "Township_Report.xlsx";


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Save Excel 2007 file
#echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
// We'll be outputting an excel file
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// It will be called file.xls
header('Content-Disposition: attachment; filename="Township_Report.xlsx"');
$objWriter->save('php://output');
exit;
