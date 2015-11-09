<?php
include 'PHPExcel.php';


 			$objPHPExcel = new PHPExcel();
	 		$sheet1=new PHPExcel_Worksheet();
 			$sheet1->setTitle("xxx");
 			$objPHPExcel->addSheet($sheet1);
            $objPHPExcel->setActiveSheetIndex(1); 
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.'1', 'Firm'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.'1', 'SFUFORMU - FR.PS.21'); 
            
            $sheet1=new PHPExcel_Worksheet();
 			$sheet1->setTitle("dddd");
 			
            $objPHPExcel->addSheet($sheet1);
            $objPHPExcel->setActiveSheetIndex(2);  
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.'1', 'Hala'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.'1', 'grant'); 
			$sheet2=new PHPExcel_Worksheet();
			$sheet2->setTitle("ccc");
 
            
                      $objPHPExcel->addSheet($sheet2);
              $objPHPExcel->setActiveSheetIndex(3);  
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.'1', 'Sameh'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.'1', 'Nagy'); 
            
                 
            $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 
            $objWriter->save('some_excel_file.xls'); 



die();
    $filenames = array('x1.csv', 'x2.csv');

    $bigExcel = new PHPExcel();
    $bigExcel->removeSheetByIndex(0);

    $reader = PHPExcel_IOFactory::createReader("CSV");

    foreach ($filenames as $filename) {
        $excel = $reader->load($filename);

        foreach ($excel->getAllSheets() as $sheet) {
            $bigExcel->addExternalSheet($sheet);
        }

        foreach ($excel->getNamedRanges() as $namedRange) {
            $bigExcel->addNamedRange($namedRange);
        }
    }

    $writer = PHPExcel_IOFactory::createWriter($bigExcel, 'CSV');

    $file_creation_date = date("Y-m-d");

    // name of file, which needs to be attached during email sending
    $saving_name = "test.csv";


    // save file at some random location    
    $writer->save( $saving_name);

    // More Detail : with different object: 


die();


//First sheet
	$objPHPExcel= new PHPExcel();
    $sheet = $objPHPExcel->getActiveSheet();

    //Start adding next sheets
    $i=0;
    while ($i < 10) {
    // Add new sheet
    $objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating

    //Write cells
    $objWorkSheet->setCellValue('A1', 'Hello'.$i)
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

    // Rename sheet
    $objWorkSheet->setTitle("$i");

    $i++;
    }
    
    $objPHPExcelWriter = PHPExcel_IOFactory::createWriter($objWorkSheet,"CSV");
$objPHPExcelWriter->save("Hala");
    

  die();


/*$finalTemplate ="\n hala,grant\n";
		$handle = fopen ( "x1.csv" , "a" );
		fwrite ( $handle, $finalTemplate );
		fclose ( $handle );
		
		
		$finalTemplate ="\nsameh,nagy\n";
		$handle = fopen ( "x2.csv" , "a" );
		fwrite ( $handle, $finalTemplate );
		fclose ( $handle );
		
		*/
		
		$file1="x1.csv";
$file2="x2.csv";
$outputFile = "final.xls";
$inputFileType1 = 'CSV';
$inputFileName1 = $file1;
$inputFileType2 = 'CSV';
$inputFileName2 = $file2;
$outputFileType = 'CSV';
$outputFileName = 'outputData.csv';




$filenames = array($file1, $file2);

    $bigExcel = new PHPExcel();
    $bigExcel->removeSheetByIndex(0);

    $reader = PHPExcel_IOFactory::createReader("CSV");

    foreach ($filenames as $filename) {
        $excel = $reader->load($filename);

        foreach ($excel->getAllSheets() as $sheet) {
            $bigExcel->addExternalSheet($sheet);
        }

        foreach ($excel->getNamedRanges() as $namedRange) {
            $bigExcel->addNamedRange($namedRange);
        }
    }

    $writer = PHPExcel_IOFactory::createWriter($bigExcel, 'Excel5');

    $file_creation_date = date("Y-m-d");

    // name of file, which needs to be attached during email sending
    $saving_name = "Report_Name" . $file_creation_date . '.csv';


    // save file at some random location    
    $writer->save($saving_name);


die();
// Load the first workbook (an xlsx file)
$objPHPExcelReader1 = PHPExcel_IOFactory::createReader($inputFileType1);
$objPHPExcel1 = $objPHPExcelReader1->load($inputFileName1);

// Load the second workbook (an xls file)
$objPHPExcelReader2 = PHPExcel_IOFactory::createReader($inputFileType2);
$objPHPExcel2 = $objPHPExcelReader2->load($inputFileName2);

// Merge the second workbook into the first
$objPHPExcel2->getActiveSheet()->setTitle('Unique worksheet name');
$objPHPExcel1->addExternalSheet($objPHPExcel2->getActiveSheet());

// Save the merged workbook under a new name (could save under the original name)
// as an xls file
$objPHPExcelWriter = PHPExcel_IOFactory::createWriter($objPHPExcel1,$outputFileType);
$objPHPExcelWriter->save($outputFileName);
?>