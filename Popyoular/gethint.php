<?php
// Test CVS

include_once  'Excel/reader.php';

// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/

$data->read('jxlrwtest.xls');

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

error_reporting(E_ALL ^ E_NOTICE);


$numRows=$data->sheets[0]['numRows'];
$cells= $data->sheets[0]['cells'];
$string = $_GET['q'];
autoComplete($numRows,$cells,$string);



function autoComplete($numRows,$cells,$string) {
	$num=count($cells);
	$results=array_fill(0, $num, null);
	$j=0;
	
	for ($i = 1; $i <= $numRows; $i++) {
		preg_match_all("|^$string.*|i", $cells[$i][3], $matches);
				
		if (($matches[0][0])!= null) {
			$results[$j]= $matches[0][0];
			$j++;
		}
		
	}
	$results = array_filter($results);
	for ($k = 0; $k < count($results) ; $k++) {
		echo '<span style="cursor:default;" onClick="complete_txt('."'".$results[$k]."'".')">'.$results[$k].'</span><br />';
	}
}
?>