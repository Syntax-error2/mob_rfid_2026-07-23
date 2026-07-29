<?php

 
include('session.php');
 
$do_id=$_GET['do_id'];
$shift_id=$_GET['shift_id'];
$shift=$_GET['shift'];
$type=$_GET['type'];
  
?>


<?php

if(isset($_POST['addSchedule']))
{
    
  
   
    $am_in_hr=$_POST['am_in_hr'];
    $am_in_min=$_POST['am_in_min'];
    $am_in_ampm=strtoupper($_POST['am_in_ampm']);
    $am_IN=$am_in_hr.":".$am_in_min." ".$am_in_ampm;
    
    $am_in_hr_late=$_POST['am_in_hr_late'];
    $am_in_min_late=$_POST['am_in_min_late'];
    $am_in_ampm_late=strtoupper($_POST['am_in_ampm_late']);
    $am_IN_co=$am_in_hr_late.":".$am_in_min_late." ".$am_in_ampm_late; 
    
    
    $am_out_hr=$_POST['am_out_hr'];
    $am_out_min=$_POST['am_out_min'];
    $am_out_ampm=strtoupper($_POST['am_out_ampm']);
    $am_OUT=$am_out_hr.":".$am_out_min." ".$am_out_ampm;
    
    //$am_out_hr_late=$_POST['am_out_hr_late'];
    //$am_out_min_late=$_POST['am_out_min_late'];
    //$am_out_ampm_late=$_POST['am_out_ampm_late'];
    //$am_OUT_co=$am_out_hr_late.":".$am_out_min_late." ".$am_out_ampm_late; 
     
    $pm_in_hr=$_POST['pm_in_hr'];
    $pm_in_min=$_POST['pm_in_min'];
    $pm_in_ampm=strtoupper($_POST['pm_in_ampm']);
    $pm_IN=$pm_in_hr.":".$pm_in_min." ".$pm_in_ampm;
    
    $pm_in_hr_late=$_POST['pm_in_hr_late'];
    $pm_in_min_late=$_POST['pm_in_min_late'];
    $pm_in_ampm_late=strtoupper($_POST['pm_in_ampm_late']);
    $pm_IN_co=$pm_in_hr_late.":".$pm_in_min_late." ".$pm_in_ampm_late; 
     
    
    
    $pm_out_hr=$_POST['pm_out_hr'];
    $pm_out_min=$_POST['pm_out_min'];
    $pm_out_ampm=strtoupper($_POST['pm_out_ampm']);
    $pm_OUT=$pm_out_hr.":".$pm_out_min." ".$pm_out_ampm;
    
    //$pm_out_hr_late=$_POST['pm_out_hr_late'];
    //$pm_out_min_late=$_POST['pm_out_min_late'];
    //$pm_out_ampm_late=$_POST['pm_out_ampm_late'];
    //$pm_OUT_co=$pm_out_hr_late.":".$pm_out_min_late." ".$pm_out_ampm_late; 
    
    
    $day = $_POST['checkbox2'];
    
    $conflictCtr=0;
    $conflictDaysCtr="";
    for($j=0;$j<count($day);$j++)
    {
        
    $dayz = $day[$j];
 
    $checkbox = $_POST['checkbox'];

    for($i=0;$i<count($checkbox);$i++)
    {
        
    $cb_do_id = $checkbox[$i];
     
     
    $sckClassSched_query = $conn->query("SELECT * FROM time_schedules WHERE day='$dayz' AND do_id='$cb_do_id' AND shift_id='$shift_id'") or die(mysql_error());
    if($sckClassSched_query->rowCount()>0)
    {
        
    $conflictCtr=$conflictCtr+1;
    $conflictDaysCtr=$conflictDaysCtr."[". $dayz ."] ";
    
    }else{
 
    $conn->query("INSERT INTO time_schedules(school_id, day, am_IN, am_IN_co, am_OUT, pm_IN, pm_IN_co, pm_OUT, do_id, shift_id, type)
    VALUES('$school_id', '$dayz', '$am_IN', '$am_IN_co', '$am_OUT', '$pm_IN', '$pm_IN_co', '$pm_OUT', '$cb_do_id', '$shift_id', '$type')");
    
    
    }
    
    }
    
    }
?>

<?php
if($sckClassSched_query->rowCount()>0)
{ ?>
<script>
window.alert('There are (<?php echo $conflictCtr; ?>) schedule conflicts... <?php echo $conflictDaysCtr; ?>. Those data was not saved.');
window.location='schedule_preferences.php?do_id=<?php echo $do_id; ?>&shift_id=<?php echo $shift_id; ?>&shift=<?php echo $shift; ?>&type=<?php echo $type; ?>'; 
</script>
<?php }else{ ?>
<script>
window.location='schedule_preferences.php?do_id=<?php echo $do_id; ?>&shift_id=<?php echo $shift_id; ?>&shift=<?php echo $shift; ?>&type=<?php echo $type; ?>'; 
</script>
<?php } } ?>





<?php

if(isset($_POST['updateTimeSched']))
{
 
    $am_in_hr=$_POST['am_in_hr'];
    $am_in_min=$_POST['am_in_min'];
    $am_in_ampm=strtoupper($_POST['am_in_ampm']);
    $am_IN=$am_in_hr.":".$am_in_min." ".$am_in_ampm;
    
    $am_in_hr_late=$_POST['am_in_hr_late'];
    $am_in_min_late=$_POST['am_in_min_late'];
    $am_in_ampm_late=strtoupper($_POST['am_in_ampm_late']);
    $am_IN_co=$am_in_hr_late.":".$am_in_min_late." ".$am_in_ampm_late; 
    
    
    $am_out_hr=$_POST['am_out_hr'];
    $am_out_min=$_POST['am_out_min'];
    $am_out_ampm=strtoupper($_POST['am_out_ampm']);
    $am_OUT=$am_out_hr.":".$am_out_min." ".$am_out_ampm;
 
 
    $pm_in_hr=$_POST['pm_in_hr'];
    $pm_in_min=$_POST['pm_in_min'];
    $pm_in_ampm=strtoupper($_POST['pm_in_ampm']);
    $pm_IN=$pm_in_hr.":".$pm_in_min." ".$pm_in_ampm;
    
    $pm_in_hr_late=$_POST['pm_in_hr_late'];
    $pm_in_min_late=$_POST['pm_in_min_late'];
    $pm_in_ampm_late=strtoupper($_POST['pm_in_ampm_late']);
    $pm_IN_co=$pm_in_hr_late.":".$pm_in_min_late." ".$pm_in_ampm_late; 
     
    
    
    $pm_out_hr=$_POST['pm_out_hr'];
    $pm_out_min=$_POST['pm_out_min'];
    $pm_out_ampm=strtoupper($_POST['pm_out_ampm']);
    $pm_OUT=$pm_out_hr.":".$pm_out_min." ".$pm_out_ampm;


    $conn->query("UPDATE time_schedules SET am_IN='$am_IN', am_IN_co='$am_IN_co', am_OUT='$am_OUT', pm_IN='$pm_IN', pm_IN_co='$pm_IN_co', pm_OUT='$pm_OUT' WHERE schedule_id='$_POST[schedule_id]'");
                                                                                                                              
?>
<script>
window.alert('<?php echo $_POST['day']; ?> schedule updated successfully.');
window.location='schedule_preferences.php?do_id=<?php echo $do_id; ?>&shift_id=<?php echo $shift_id; ?>&shift=<?php echo $shift; ?>&type=<?php echo $type; ?>'; 
</script>
<?php } ?>





<?php

if(isset($_POST['deleteSched']))
{
    
    $conn->query("DELETE FROM time_schedules WHERE schedule_id='$_POST[schedule_id]'");
?>


<script>
window.alert('<?php echo $_POST['day']; ?> schedule deleted successfully.');
window.location='schedule_preferences.php?do_id=<?php echo $do_id; ?>&shift_id=<?php echo $shift_id; ?>&shift=<?php echo $shift; ?>&type=<?php echo $type; ?>';  

</script>

<?php } ?>
 
