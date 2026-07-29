<?php

include('dbcon.php');

    $logCHK_query = $conn->query("SELECT * FROM personnel_logs WHERE log_id='$_POST[log_id]'") or die(mysql_error());
    
    if($logCHK_query->rowCount()>0){
        
    
    $pl_row=$logCHK_query->fetch();

    if($pl_row['captured_img']==='' AND $_POST['image']!=''){
        
        $img = $_POST['image'];
        $folderPath = "upload/";
      
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
      
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpg';
      
        $file = $folderPath . $fileName;
    
        file_put_contents($file, $image_base64);
        
        $conn->query("UPDATE personnel_logs SET captured_img='$fileName' WHERE log_id='$_POST[log_id]'") or die(mysql_error());
        
        } }

$logCHK_query=null;
$pl_row=null;

$sf_query=null;
$conn=null;
           
?>
 