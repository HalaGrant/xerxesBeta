<?php

		$ftpConnection = ftp_connect("ftp.beinsports.net");	//connect to ftp
        $loginDetails = ftp_login($ftpConnection, "beIN_Movies", "E3er#4etLd");
        
        if($loginDetails)	echo "connected  ";
        else echo "failed";
        
        
        $path ="beIN_Movies";
        $value="tst.txt";
        $fileNameFullPath= "/$path/$value";
        echo "</br>".$fileNameFullPath;
        $handle = fopen("$value","r");	//read contents of file
               
       if(ftp_fput($ftpConnection, $fileNameFullPath, $handle, FTP_ASCII, 0))	 echo "transfered";
       else echo "failed";
        
//    $handle = fopen("tst.txt","r");	//read contents of file
//            
//	if(ftp_fput($ftpConnection, "tst.txt", $handle, FTP_ASCII, 0))   echo "success";
//	echo "failed";
	
?>