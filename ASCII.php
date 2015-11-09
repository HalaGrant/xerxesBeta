<?php 
/**

* Remove any non-ASCII characters and convert known non-ASCII characters

* to their ASCII equivalents, if possible.

*

* @param string $string

* @return string $string

* @author Hala

*/
header('Content-Disposition: attachment; filename="downloaded.xml"');

$data = file_get_contents('hala.xml');

$parsed_data = normalizeToASCII($data);

//echo $parsed_data;
$file ="config.xml";
$xml= file_put_contents($file,$parsed_data);

//$str = preg_replace("|è|", 'e', $data);



function normalizeToASCII($string)

{

// Replace Single Curly Quotes

$search[] = chr(226).chr(128).chr(152);

$replace[] = "'";

$search[] = chr(226).chr(128).chr(153);

$replace[] = "'";

 

// Replace Smart Double Curly Quotes

$search[] = chr(226).chr(128).chr(156);

$replace[] = '"';

$search[] = chr(226).chr(128).chr(157);

$replace[] = '"';

 

// Replace En Dash

$search[] = chr(226).chr(128).chr(147);

$replace[] = '--';

 

// Replace Em Dash

$search[] = chr(226).chr(128).chr(148);

$replace[] = '---';

 

// Replace Bullet

$search[] = chr(226).chr(128).chr(162);

$replace[] = '*';

 

// Replace Middle Dot

$search[] = chr(194).chr(183);

$replace[] = '*';

 

// Replace Ellipsis with three consecutive dots

$search[] = chr(226).chr(128).chr(166);

$replace[] = '...';



// Apply Replacements

$string = str_replace($search, $replace, $string);

 

// Remove any non-ASCII Characters

//$string = preg_replace("/[\x00-\xff]/","", $string);
//$string = preg_replace('/[\x00-\x1F\x80-\xBF]/', '', $string);
//$string = preg_replace('/[^\x0A\x20-\x7E]/','',$string);
$string = preg_replace( '/[^[:print:]^\x0A]/', '',$string);

$string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
$string=str_replace("&", "and", $string);
return $string;

}
?>