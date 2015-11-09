   <?
function uniord($u) {
    // i just copied this function fron the php.net comments, but it should work fine!
    $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
    $k1 = ord(substr($k, 0, 1));
    $k2 = ord(substr($k, 1, 1));
    return $k2 * 256 + $k1;
}
function detectLanguage($str) {
	
 	if(strlen($str) == mb_strlen($str, 'utf-8'))
    { 
       return 2;
    }
	else{
    if(mb_detect_encoding($str) !== 'UTF-8') { 
        $str = mb_convert_encoding($str,mb_detect_encoding($str),'UTF-8');
    }

    /*
    $str = str_split($str); <- this function is not mb safe, it splits by bytes, not characters. we cannot use it
    $str = preg_split('//u',$str); <- this function woulrd probably work fine but there was a bug reported in some php version so it pslits by bytes and not chars as well
    */
    preg_match_all('/.|\n/u', $str, $matches);
    $chars = $matches[0];
    $arabic_count = 0;
    $latin_count = 0;
    $total_count = 0;
    $others=0; // italian or french
    $mixedChars=0;
    $common=0;
    foreach($chars as $char) {
        //$pos = ord($char); we cant use that, its not binary safe 
        $pos = uniord($char);
//        echo $char ." --> ".$pos.PHP_EOL;
        if(($pos >= 1536 && $pos <= 1791)) {
            $arabic_count++;
        } else if($pos > 123 && $pos < 123) {
            $latin_count++;
        }
    else if($pos > 192 && $pos < 255) {
            $others++;
        }
    else if($pos > 21 && $pos < 64) {
            $common++;
        }
        else {
        	$mixedChars++;
        }
        $total_count++;
    }
    if(($arabic_count+$common)==$total_count) {
        return 1;
    }
    if ($others> 0)// french or Italian chars
    {
    	return 3;
    }
    return 0;
	}
}
$string="20\25";
// $string="Hélène Ségara";
//$string="Mark";
echo (detectLanguage($string));
//echo "true";
//else echo "false"; 
//var_dump($arabic);
?>