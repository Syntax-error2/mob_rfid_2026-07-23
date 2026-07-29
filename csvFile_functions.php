<?php

//error_reporting(0);
 
include('dbcon3.php');

 if(isset($_POST["Import"])){
    
    $updateCtr=0;
    $insertCtr=0;
    
    $filename=$_FILES["file"]["tmp_name"];    
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
          {
            
            $old_date = date($getData[10]);              // returns Saturday, January 30 10 02:06:34
            $old_date_timestamp = strtotime($old_date);
            $new_date = date('m/d/Y', $old_date_timestamp); 
            
            $SqlCheckRecord = "SELECT RFTag_id FROM personnel_logs WHERE RFTag_id='".$getData[1]."' AND logDate='".$getData[10]."' AND logFlow='".$getData[14]."'";
            $chkRec_result = mysqli_query($conn3, $SqlCheckRecord); 
             
            if (mysqli_num_rows($chkRec_result)>0) {
             
             $sql = "UPDATE personnel_logs SET RFTag_id='".$getData[1]."', img='".$getData[2]."', captured_img='".$getData[3]."', lname='".$getData[4]."', fname='".$getData[5]."', mname='".$getData[6]."', suffix='".$getData[7]."', do_id='".$getData[8]."', shift_id='".$getData[9]."', logDate='".$new_date."', logTime='".$getData[11]."', logTime_sec='".$getData[12]."', late_status='".$getData[13]."', logFlow='".$getData[14]."', client_ip='".$getData[15]."', remarks='".$getData[16]."', travel_leave_code='".$getData[17]."' WHERE RFTag_id='".$getData[1]."' AND logDate='".$new_date."' AND logFlow='".$getData[14]."'";
             mysqli_query($conn3, $sql);
             
             $updateCtr=$updateCtr+1;
             
            }else{
             
             $insertCtr=$insertCtr+1;
             
             $sql = "INSERT INTO personnel_logs
             
             (RFTag_id, img, captured_img, lname, fname, mname, suffix, do_id, shift_id, logDate, logTime, logTime_sec, late_status, logFlow, client_ip, remarks, travel_leave_code)
             
             VALUES
             
             ('".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."','".$getData[9]."','".$new_date."','".$getData[11]."','".$getData[12]."','".$getData[13]."','".$getData[14]."','".$getData[15]."','".$getData[16]."','".$getData[17]."')";
             
             $result = mysqli_query($conn3, $sql);
             
                        
                          
               } 
          }
          
          $insertCtr=$insertCtr-1;
          
          if(!isset($result)){ ?>
          
          <script>
          alert("Invalid File: Please Upload CSV File...");
          window.location = 'csvFile_import.php';
          </script>
          
          <?php }else{ ?>
          
           <script>
           alert("CSV File has been successfully Imported... \n Inserted Rows: <?php echo $insertCtr; ?> \n Updated Rows: <?php echo $updateCtr; ?>");
           window.location = 'csvFile_import.php';
           </script>
                          
           <?php  }
                          
          $sql_del = "DELETE FROM personnel_logs WHERE fname='fname' AND lname='lname'";
          $conn3->query($sql_del);
                          
          $conn3->close();
          fclose($file);  
     }
  }
  
  
  /* function get_all_records(){
    $conn3 = getdb();
    $Sql = "SELECT * FROM personnel_logs";
    $result = mysqli_query($conn3, $Sql);  
    if (mysqli_num_rows($result) > 0) {
     echo "<table id='example' class='table table-striped table-bordered'>
             <thead><tr>  
             
                          <th>EMP ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Registration Date</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Registration Date</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Registration Date</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                        
                        </tr></thead><tbody>";
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr><td>" . $row['log_id']."</td>
                   <td>" . $row['RFTag_id']."</td>
                   <td>" . $row['img']."</td>
                   <td>" . $row['captured_img']."</td>
                   <td>" . $row['lname']."</td>
                   <td>" . $row['fname']."</td>
                   <td>" . $row['mname']."</td>
                   <td>" . $row['suffix']."</td>
                   <td>" . $row['do_id']."</td>
                   <td>" . $row['shift_id']."</td>
                   <td>" . $row['logDate']."</td>
                   <td>" . $row['logTime']."</td>
                   <td>" . $row['late_status']."</td>
                   <td>" . $row['logFlow']."</td>
                   <td>" . $row['client_ip']."</td>
                   <td>" . $row['remarks']."</td></tr>";        
     }
    
     echo "</tbody></table>";
     
} else {
     echo "you have no records";
}
} */
 

 if(isset($_POST["Export"])){
    
      $logDateXportFrom=substr($_POST['logDateFrom'], 5,2).'/'.substr($_POST['logDateFrom'], 8,2).'/'.substr($_POST['logDateFrom'], 0,4);
      $logDateXportTo=substr($_POST['logDateTo'], 5,2).'/'.substr($_POST['logDateTo'], 8,2).'/'.substr($_POST['logDateTo'], 0,4);
      
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=logs_'.$logDateXportFrom.'_to_'.$logDateXportTo.'.csv');  
      $output = fopen("php://output", "w");  
  
      
      
      fputcsv($output, array('log_id', 'RFTag_id', 'img', 'captured_img', 'lname', 'fname', 'mname', 'suffix', 'do_id', 'shift_id', 'logDate', 'logTime', 'logTime_sec', 'late_status', 'logFlow', 'client_ip', 'remarks', 'travel_leave_code', 'ref_log_id'));  
      $query = "SELECT * from personnel_logs WHERE (logDate BETWEEN '$logDateXportFrom' AND '$logDateXportTo') ORDER BY log_id DESC";  
      $result = mysqli_query($conn3, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }   
    
 ?>