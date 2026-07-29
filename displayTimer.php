<?php

include('dbcon.php');
include('myFunctions.php');

$cc_query = $conn->query("select * from client_computer WHERE ipAddress='".get_client_ip()."'");
$cc_row = $cc_query->fetch();

if($cc_row['display_time']<15){
    
$display_time=$cc_row['display_time']+1;
$conn->query("UPDATE client_computer SET display_time='$display_time', announcement_img=0 WHERE ipAddress='".get_client_ip()."'");

}

if($cc_row['display_time']==15){


if($cc_row['announcement_img']<150){
    
$announcement_img_time=$cc_row['announcement_img']+1;

$conn->query("UPDATE client_computer SET announcement_img='$announcement_img_time' WHERE ipAddress='".get_client_ip()."'");
 
}

}

if($cc_row['announcement_img']==150)
    {
    $conn->query("UPDATE client_computer SET announcement_img=0 WHERE ipAddress='".get_client_ip()."'");
    }

$cc_query=null;
$cc_row=null;

$conn=null;

?>