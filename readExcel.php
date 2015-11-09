<?php

print_r(getAllWorksheets("Globecast.xls"));
function getAllWorksheets($inputFileName){
	set_time_limit(0);
	
	/** Include path **/
	set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
	
	/** PHPExcel_IOFactory */
	include 'PHPExcel/IOFactory.php';
	

	$inputFileType = 'Excel5';
	//	$inputFileType = 'Excel2007';
	//	$inputFileType = 'Excel2003XML';
	//	$inputFileType = 'OOCalc';
	//	$inputFileType = 'Gnumeric';
	//	$inputFileName = 'Globecast.xls';
	//$sheetnames = array('Data Sheet #1','Data Sheet #3');
	
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	
	//$objReader->setLoadSheetsOnly($sheetnames);
	
	$objReader->setLoadAllSheets();
	$objPHPExcel = $objReader->load($inputFileName);
	
	$loadedSheetNames = $objPHPExcel->getSheetNames();
	$result = array();
	foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
	//	echo $sheetIndex,' -> ',$loadedSheetName,'<br />';
		$sheetData = $objPHPExcel->getSheet($sheetIndex)->toArray(null,true,true,true);
	//	print_r($sheetData);
		
		if (trim($loadedSheetName) == "Worksheet")	continue;
		
		foreach ($sheetData as $key=>$value) {
			if ((trim($value["E"]) == "Date") || (trim($value["G"]) == "Starting Time"))	continue;
			
			$dateTime = trim($value["E"]) . " " . trim($value["G"]);
			$result[trim($loadedSheetName)][$dateTime]["Title"] = $value["H"];
			$result[trim($loadedSheetName)][$dateTime]["Channel genre"] = $value["B"];
			$result[trim($loadedSheetName)][$dateTime]["Language"] = $value["C"];
			$result[trim($loadedSheetName)][$dateTime]["Airing language"] = $value["D"];
			$result[trim($loadedSheetName)][$dateTime]["Schedule type"] = $value["F"];
			$result[trim($loadedSheetName)][$dateTime]["Genre"] = $value["I"];
			$result[trim($loadedSheetName)][$dateTime]["Description 1"] = $value["J"];
			$result[trim($loadedSheetName)][$dateTime]["Media"] = $value["K"];
		}
	}
	
	return $result;
}
?>
