 <?php include('session.php'); ?>

<?php
if(isset($_POST['deletePersonnel'])){
    

$personnel_id=$_GET['personnel_id'];
$travel_code=$_GET['travel_code'];

$perData1_query = $conn->query("SELECT RFTag_id FROM personnels WHERE personnel_id='$personnel_id'");
$pd1_row=$perData1_query->fetch();

   
                //save to student logs
                $conn->query("DELETE FROM personnel_logs WHERE RFTag_id='$pd1_row[RFTag_id]' AND travel_leave_code='$travel_code'");
     
                //save to student logs
                $conn->query("DELETE FROM personnel_official_travel_logs WHERE personnel_id='$personnel_id' AND travel_code='$travel_code'");
     
                //save to student logs
                $conn->query("DELETE FROM personnel_seminars WHERE personnel_id='$personnel_id' AND entry_type='$travel_code'");
      
?>
 
<script>
window.alert('Personnel successfully removed from Travel Order <?php echo $travel_code; ?>...');
window.location='list_travel_order_detailed.php?travel_code=<?php echo $travel_code; ?>'; 
</script> 


<?php } ?>



<?php
if(isset($_POST['addPersonnel'])){

$travel_code=$_GET['travel_code'];
$RFTag_id=substr($_POST['personnel_RFTag_id'], 0, 8);

                    
                    $perData1_query = $conn->query("SELECT DISTINCT logDate, remarks FROM personnel_logs WHERE travel_leave_code='$travel_code'");
                    while($pd1_row=$perData1_query->fetch()){
                    
                    $perData1CHK_query = $conn->query("SELECT log_id FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logDate='$pd1_row[logDate]'");
                    if($perData1CHK_query->rowCount()>0){
                        $logStat="Exist";
                    }else{
                        
                        $perData2_query = $conn->query("SELECT personnel_id, img, lname, fname, mname, suffix, do_id, shift_id FROM personnels WHERE RFTag_id='$RFTag_id'");
                        $pd2_row=$perData2_query->fetch();
                                
                        $img='personnelImg/'.$pd2_row['img'];
                        
                        $conn->query("INSERT INTO personnel_logs(RFTag_id, img, lname, fname, mname, suffix, do_id, shift_id, logDate, remarks, travel_leave_code)
                        VALUES ('$RFTag_id', '$img', '$pd2_row[lname]', '$pd2_row[fname]', '$pd2_row[mname]', '$pd2_row[suffix]', '$pd2_row[do_id]', '$pd2_row[shift_id]', '$pd1_row[logDate]', '$pd1_row[remarks]', '$travel_code')");
                        
                        $logStat="Ok";
                        
                    }
                    
                    }
                
                        
                        $perData2_query = $conn->query("SELECT personnel_id FROM personnels WHERE RFTag_id='$RFTag_id'");
                        $pd2_row=$perData2_query->fetch();
                        
                        $potLogsCHK_query = $conn->query("SELECT travel_log_id FROM personnel_official_travel_logs WHERE travel_code='$travel_code' AND personnel_id='$pd2_row[personnel_id]'");
                        if($potLogsCHK_query->rowCount()>0){
                          
                        }else{
                        $potLogs_query = $conn->query("SELECT travel_code, purpose, description, location, travel_date, travel_type, numDays FROM personnel_official_travel_logs WHERE travel_code='$travel_code'");
                        $pLogs_row=$potLogs_query->fetch();
                        
                        //ADD TO TRAVEL ORDER
                        $conn->query("INSERT INTO personnel_official_travel_logs(personnel_id, travel_code, purpose, description, location, travel_date, travel_type, numDays)
                        VALUES ('$pd2_row[personnel_id]', '$travel_code', '$pLogs_row[purpose]', '$pLogs_row[description]', '$pLogs_row[location]', '$pLogs_row[travel_date]', '$pLogs_row[travel_type]', '$pLogs_row[numDays]')");

                        }
                                            
                        $pSemCHK_query = $conn->query("SELECT ps_id FROM personnel_seminars WHERE entry_type='$travel_code' AND personnel_id='$pd2_row[personnel_id]'");
                        
                        if($pSemCHK_query->rowCount()>0){
                         
                        }else{
                            
                        $pSem_query = $conn->query("SELECT seminar_title, seminar_desc, seminar_venue, event_date FROM personnel_seminars WHERE entry_type='$travel_code'");
                        $pSem_row=$pSem_query->fetch();
                        
                        //ADD TO 201 SEMINAR RECORDS
                        $conn->query("INSERT INTO personnel_seminars(personnel_id, seminar_title, seminar_desc, seminar_venue, event_date, entry_type)
                        VALUES ('$pd2_row[personnel_id]', '$pSem_row[seminar_title]', '$pSem_row[seminar_desc]', '$pSem_row[seminar_venue]', '$pSem_row[event_date]', '$travel_code')");
                        
                        
                        
                        }
                
                
                
                
                


if($logStat=="Ok"){
?>
 
<script>
window.alert('Personnel successfully added from Travel Order <?php echo $travel_code; ?>...');
window.location='list_travel_order_detailed.php?travel_code=<?php echo $travel_code; ?>'; 
</script> 


<?php 
}else{

?>
 
<script>
window.alert('Personnel has existing logs...');
window.location='list_travel_order_detailed.php?travel_code=<?php echo $travel_code; ?>'; 
</script> 


<?php } } ?>


 