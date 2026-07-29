 <?php


    include('dbcon.php');

    $img = $_POST['image'];
    $folderPath = "upload/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    
    
    $conn->query("UPDATE personnel_logs SET captured_img='$fileName' WHERE log_id='$_GET[log_id]'") or die(mysql_error());


?>

<script>
window.location='updateBlankLogFlow.php?toWindow=rlt1';
</script>
