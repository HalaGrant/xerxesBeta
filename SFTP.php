<?php


$filesToBeSentToTheClinet=$_GET["files"];
$files= explode(",",$filesToBeSentToTheClinet);

$connection = ssh2_connect('83.111.151.246', 22);
$returnVal="";
if($connection){

	$hostServer="192.168.1.15";
//$hostServer="41.32.112.2";
//$port= 58257;
$user="delmundev1";
$pass="delmundev15tac3ppa";
$directory="SFTP_Temp/";
$path="public_html/dropops/eti/";

 $ftpConnection = ftp_connect($hostServer);//,$port);	//connect to ftp
$loginDetails = ftp_login($ftpConnection, $user, $pass);
ftp_pasv($ftpConnection, true); 
 $numOfFiles=count($files);
 for($i=0; $i<$numOfFiles; $i++)
 {
 	

 	
$connection = ssh2_connect('83.111.151.246', 22);

//$files[$i]= str_replace($path, "", $files[$i]);

 @ftp_get($ftpConnection, $directory.$files[$i], $path.$files[$i], FTP_ASCII);
// ftp_delete($ftpConnection, $path.$files[$i]);				
$userName='eurostar2';
$password='eurostar12345';




ssh2_auth_password($connection, $userName,$password );
$sftp = ssh2_sftp($connection);

//This is to copy the stream  from a local file to a remote file:
$stream = @fopen("ssh2.sftp://$sftp/var/www/html/Providers/eurostar2/Upload/".$files[$i], 'w');


$data_to_send = file_get_contents($directory.$files[$i]);

if(fwrite($stream, $data_to_send))
$returnVal.= $files[$i].",";
else
$returnVal.= "2FAILED_AT_TRANSFERING_FILES_TO_THE_CLIENT,";


unlink($directory.$files[$i]);
}


}
else
$returnVal.= "1FAILED_AT_TRANSFERING_FILES_TO_THE_CLIENT,";


echo substr($returnVal,0,-1);
?>
