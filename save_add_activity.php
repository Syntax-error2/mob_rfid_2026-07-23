<?php

 
include('session.php');

?>


<?php

if(isset($_POST['addActivity']))
{
    
    $completeDate=$_POST['activity_date'];
    
    $actMM=substr($_POST['activity_date'], 5,2);
    $actDD=substr($_POST['activity_date'], 8,2);
    $actYYYY=substr($_POST['activity_date'], 0,4);
    
    
    $title=addslashes($_POST['event_title']);
    $description=addslashes($_POST['event_description']);
    
    $act_type=$_POST['act_type'];
    $status=$_POST['status'];
  
 
    $conn->query("INSERT INTO activity_calendar(actMM, actDD, actYYYY, completeDate, event_title, 	event_description, act_type, status)
    VALUES('$actMM', '$actDD', '$actYYYY', '$completeDate', '$title', '$description', '$act_type', '$status')");
    
?>

<script>
window.alert('Activity added successfully...');
window.location='school_calendar.php?mm=<?php echo $actMM; ?>&yyyy=<?php echo $actYYYY; ?>';
</script>

<?php } ?>

 

<?php

if(isset($_POST['editActivity']))
{

    $completeDate=$_POST['activity_date'];
    
    $actMM=substr($_POST['activity_date'], 5,2);
    $actDD=substr($_POST['activity_date'], 8,2);
    $actYYYY=substr($_POST['activity_date'], 0,4);
    
    $title=addslashes($_POST['event_title']);
    $description=addslashes($_POST['event_description']);
    
    $act_type=$_POST['act_type'];
    $status=$_POST['status'];
  
 
    $conn->query("UPDATE activity_calendar SET actMM='$actMM', actDD='$actDD', actYYYY='$actYYYY', completeDate='$completeDate', event_title='$title', event_description='$description', act_type='$act_type', status='$status' WHERE activity_id='$_GET[activity_id]'");
?>

<script>
window.alert('Activity updated successfully...');
window.location='school_calendar.php?mm=<?php echo $actMM; ?>&yyyy=<?php echo $actYYYY; ?>';
</script>

<?php } ?>


<?php

if(isset($_POST['deleteActivity']))
{   
    $activity_id=$_POST['activity_id'];
    
    $conn->query("DELETE FROM activity_calendar WHERE activity_id='$activity_id'");
?>

<script>
window.alert('Activity deleted successfully...');
window.location='school_calendar.php?mm=<?php echo $_GET['mm']; ?>&yyyy=<?php echo $_GET['yyyy']; ?>';
</script>

<?php } ?>
 
 


