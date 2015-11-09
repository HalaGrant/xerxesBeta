<?php

Img_Resize("test.jpg");
  function Img_Resize($path) {

           $x = getimagesize($path);  
           $width  = $x['0'];
           $height = $x['1'];

           $rs_width  = 100;//resize to half of the original width.
           $rs_height = ($height*100)/$width;//resize to half of the original height.

           switch ($x['mime']) {
              case "image/gif":
                 $img = imagecreatefromgif($path);
                 break;
              case "image/jpeg":
                 $img = imagecreatefromjpeg($path);
                 break;
              case "image/png":
                 $img = imagecreatefrompng($path);
                 break;
           }

           $img_base = imagecreatetruecolor($rs_width, $rs_height);
           imagecopyresized($img_base, $img, 0, 0, 0, 0, $rs_width, $rs_height, $width, $height);

           $path_info = pathinfo($path);    
           switch ($path_info['extension']) {
              case "gif":
                 imagegif($img_base, $path);  
                 break;
              case "jpg":
                 imagejpeg($img_base, "images/".$path);  
                 echo "<img src='images/".$path."'>";
//                 unlink("images/".$path);
                 break;
              case "png":
                 imagepng($img_base, $path);  
                 break;
           }

        }
die();
include '';
$thumb = new Imagick();
$thumb->readImage('test.jpg');   
 echo $thumb->resizeImage(320,240,Imagick::FILTER_LANCZOS,1);
$thumb->writeImage('test2.jpg');
$thumb->clear();
$thumb->destroy(); 

?>