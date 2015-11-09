<?php

$str="Serie, Drama, Women (Syria). Based on a true story in Damascus, a father brings a necklace for his little beloved girl, Set Al Sham, but his wife advises him to distribute the necklace rings between all . . . Actor: Rasheed Aassaf, Mona ...";
$str="MV0000356660000";
echo strlen($str);
die();
$title="LE JOURNAL (649)";
if (strstr ( $title, "(" )&&strstr ( $title, ")" )) {
							echo $title;
							$title_ep = explode ( $title, " (6" );
							print_r($title_ep);
						}

						
						die();

$srt= "<div class='col-xs-10 info'>
<a data-track-array-click='today,cross_link,043545-002_iberiquement-votre,,today,043545-002_iberiquement-votre,cross_link,N' href='/guide/fr/043545-002/iberiquement-votre' title='Arte.tv Primetime | IbÃ©riquement vÃ´tre'>
<span class='title'>
<span class='ellipsis'>
<span class='badge-arte7'>ARTE+7</span>
IbÃ©riquement vÃ´tre
</span>
</span>";

$title=preg_replace("|<span class='badge.*>(.*)</span>|Us", "", $srt);
		echo $title;
		die();

echo strtotime("2015-04-10")."</br>";
echo date("Y-m-d H:i:s",1428640239);
die();

echo "<img src='https://s3-eu-west-1.amazonaws.com/babeleye/programs/223.jpg'/>";
die();

$string="21225
21763
25628
21336
20642
21583
20644
21551
28117
23387
22504
21769
25225
21077
22066
22112
22113
25224
22046
24428
17526
21308
27749
14102
13882
17793
20555
19152
17802
17161
17486
17026
17376
17581
17706
16772
17162
25933
17114
16995
17682
22672
23737
18190
17113
18002
24163
18892
21075
25112
21470
28874 
23717
9227
21227
28678
17076
17986
28333
17612
28682
17038
11374
25196
28480 
17279
17074
17501
20349
16906
21276
17290
19361 
28479
26167
19390 
27945 
28708
28708
19228 
19326
8254
15583
27614
18348
11394
20120
27060
28420
27743
28876
28463
20692
28870
22759
25625
20698
27521
17791
28357";

echo  implode(",",(explode("\n", $string)));
die();
  $string="Hélène Ségara";

    if(strlen($string) != mb_strlen($string, 'utf-8'))
    { 
        echo "Please enter English words only:(";
    }
    else {
        echo "OK, English Detected!";
    }
die();
$title = "Talk to Al Jazeera: Fighting for Love and Gore: David Boies";
	$position = strpos ( $title, ":" );
	$episodeTitle= substr ( $title, $position+1 );
	$title=substr ( $title, 0,$position );
//	
//$title_episode = explode ( ":", $title );
//$episodeTitle = trim ( $title_episode [1] );
//$title = trim ( $title_episode [0] );

echo $title . "  -  " . $episodeTitle;

die ();
$title = "THE SIMPSONS  S14: EP 16";
if (strstr ( $title, " S" ) && strstr ( $title, ":" ) && strstr ( $title, "EP" )) // title contains ep and season
{
	$position = strrpos ( $title, " S" );
	$ep_season = explode ( ":", substr ( $title, $position ) );
	$title = substr ( $title, 0, $position );
	$epNum = trim ( str_replace ( "EP", "", $ep_season [1] ) );
	$seasonNum = trim ( str_replace ( "S", "", $ep_season [0] ) );
	
	echo $epNum . "  -  $seasonNum";

}
?>