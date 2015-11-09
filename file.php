<?php

$IDs= file_get_contents("IDs.txt");
$IDsArr= explode("\n", $IDs);
ECHO count($IDsArr);
foreach ($IDsArr as $ID)
{
	echo $ID.",";
}
//print_r($IDsArr);
//echo $IDs;
?>