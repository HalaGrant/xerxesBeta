<?php

$str="Season 2, Season 2, Episode 102 ";


					$epsiodeNumArr= explode("Episode", $str);
					if(strstr($epsiodeNumArr[1],"-"))
					{
						$epdetailsArr=explode(" - ", $epsiodeNumArr[1]);
						$epsiodeTitle=$epdetailsArr[1];
						$epsiodeNum=$epdetailsArr[0];
					}
					else
					$epsiodeNum=$epsiodeNumArr[1];
					
					if(strstr($epsiodeNumArr[0],"Season")){
						$seasonNumArr= explode("Season", $epsiodeNumArr[0]);
						$seasonNumber= trim(str_replace(",", "",$seasonNumArr[1] ));	
					
					}
				
					echo $epsiodeNum ."  -  $seasonNumber";
				
?>