 <?php include('session.php'); ?>


<?php
if(isset($_POST['deleteDate'])){
    
$logDate=$_GET['logDate'];
$travel_code=$_GET['travel_code'];

$no_of_days=$_POST['no_of_days'];
$travel_date=$_POST['travel_date'];

$event_date=substr($travel_date, 0, 10);
 
                //save to student logs
                $conn->query("DELETE FROM personnel_logs WHERE logDate='$logDate' AND travel_leave_code='$travel_code'");
     
                //save to student logs
                $conn->query("UPDATE personnel_official_travel_logs SET travel_date='$travel_date', numDays='$no_of_days' WHERE travel_code='$travel_code'");
   
                //save to student logs
                $conn->query("UPDATE personnel_seminars SET event_date='$event_date' WHERE entry_type='$travel_code'");

      
?>
 
<script>
window.alert('Date <?php echo $logDate; ?> successfully removed from Travel Order <?php echo $travel_code; ?>...');
window.location='list_travel_order_detailed.php?travel_code=<?php echo $travel_code; ?>'; 
</script> 

<?php } ?>


<?php
if(isset($_POST['addDate'])){
//2019-12-30
$selectedMM=substr($_POST['logDate'], 5,2);
$selectedDD=substr($_POST['logDate'], 8,2);
$selectedYYYY=substr($_POST['logDate'], 0,4);

$logDate=$selectedMM.'/'.$selectedDD.'/'.$selectedYYYY;


$travel_code=$_GET['travel_code'];

$no_of_days=$_POST['no_of_days'];
$travel_date=$_POST['travel_date'];

$event_date=substr($travel_date, 0, 10);
 

                $perData1_query = $conn->query("SELECT personnel_id FROM personnel_official_travel_logs WHERE travel_code='$travel_code'");
                while($pd1_row=$perData1_query->fetch()){
                    
                    $perData2_query = $conn->query("SELECT RFTag_id, img, lname, fname, mname, suffix, do_id, shift_id FROM personnels WHERE personnel_id='$pd1_row[personnel_id]'");
                    $pd2_row=$perData2_query->fetch();
                            
                    $img='personnelImg/'.$pd2_row['img'];
                    
                    $conn->query("INSERT INTO personnel_logs(RFTag_id, img, lname, fname, mname, suffix, do_id, shift_id, logDate, remarks, travel_leave_code)
                    VALUES ('$pd2_row[RFTag_id]', '$img', '$pd2_row[lname]', '$pd2_row[fname]', '$pd2_row[mname]', '$pd2_row[suffix]', '$pd2_row[do_id]', '$pd2_row[shift_id]', '$logDate', '$_GET[remarks]', '$travel_code')");

                }


                //save to student logs
                $conn->query("UPDATE personnel_official_travel_logs SET travel_date='$travel_date', numDays='$no_of_days' WHERE travel_code='$travel_code'");
   
                //save to student logs
                $conn->query("UPDATE personnel_seminars SET event_date='$event_date' WHERE entry_type='$travel_code'");

      
?>
 
<script>
window.alert('Date <?php echo $logDate; ?> successfully added from Travel Order <?php echo $travel_code; ?>...');
window.location='list_travel_order_detailed.php?travel_code=<?php echo $travel_code; ?>'; 
</script> 

<?php } ?>



 