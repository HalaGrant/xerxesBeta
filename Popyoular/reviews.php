<?php
function getReview($title){
$xml = new DOMDocument;
$xsl = new DOMDocument;
$popyoular="popyoular.xml";
unlink($popyoular);
$handle = fopen($popyoular, "a");
$text=file_get_contents("http://apiv2.popyoular.se/movies/match/$title/reviews/shared/english/aggregated?include-reviews=100&max-quotes=100&include-awards=international&locale=ar_EG&username=babeleye&password=MH4FsB&review-sort=source-priority&quote-sort=source-priority");
	
//die($text);
fwrite($handle,$text);
	fclose($handle);

	$xml->load($popyoular);
	$xsl->load('popyoular.xsl');
	$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // attach the xsl rules
return  $proc->transformToXML($xml);
}

//echo getReview("I%20am%20Number%20Four");
?>