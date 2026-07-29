<?php

date_default_timezone_set('Asia/Manila');

$servername = "localhost";
$username = "root";
$password = "";
$db = "mob_rfid_dtr";
 
//#=================================================================================

        $conn2=mysql_connect($servername,$username,$password) or die ("DOWN!");
		if ($conn2) {
		  
          mysql_select_db($db,$conn2);
           
		}
		else
		{
			die("DOWN");
		}
        
 

//error_reporting(0);
?>
