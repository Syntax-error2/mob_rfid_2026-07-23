<?php

include('session.php');


if(isset($_POST['update_pref']))
{
    
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    
    $file_loc = $_FILES['file']['tmp_name'];
 
	$folder="img/";
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
    
    
    $final_file=str_replace(' ','-',$new_file_name);
    
    
    
    $upd_deped_id=$_POST['deped_id'];
 
    $upd_region=$_POST['region'];
    $upd_division=$_POST['division'];
    $upd_schoolName=$_POST['schoolName'];
    $upd_address=$_POST['address'];
    $upd_emailAddress=$_POST['emailAddress'];
    $upd_contactNumber=$_POST['contactNumber'];
    
 
    
        
    if($_FILES['file']['name']=="")
    {
        
       $conn->query("UPDATE school_preferences SET deped_id='$upd_deped_id', region='$upd_region', division='$upd_division', schoolName='$upd_schoolName', address='$upd_address', emailAddress='$upd_emailAddress', contactNumber='$upd_contactNumber' WHERE school_id='$school_id'");
  
    }else{
        
        
    if(move_uploaded_file($file_loc,$folder.$final_file)){
        
    $conn->query("UPDATE school_preferences SET deped_id='$upd_deped_id', logo='$final_file', region='$upd_region', division='$upd_division', schoolName='$upd_schoolName', address='$upd_address', emailAddress='$upd_emailAddress', contactNumber='$upd_contactNumber' WHERE school_id='$school_id'");
 
    
    }else{ ?>
        
        <script>
        window.alert("Error uploading image (Invalid format/File size too large), Please try again.");
        window.location='school_preferences.php?sfp_stat=xEdit';
        </script> 
    
    <?php } } ?>

<script> window.location='school_preferences.php?sfp_stat=xEdit'; </script>

<?php } ?>
 
 
<?php

if(isset($_POST['activateSY']))
{
    $activateSY=$_POST['schoolYear'];
    
    $conn->query("update school_preferences set activeSchoolYear='$activateSY' where school_id='$school_id'");
                                
?>

<script> window.location='school_preferences.php?sfp_stat=xEdit'; </script>

<?php } ?>



<?php


if(isset($_POST['addSY']))
{
   $newSY=$_POST['newSY'];
    
   $conn->query("insert into school_year(school_id,schoolYear,status)values('$school_id','$newSY','Inactive')");


?>

<script> window.location='school_preferences.php?sfp_stat=xEdit'; </script>

<?php } ?>



<?php

if(isset($_POST['activateSem']))
{
    $activateSemester=$_POST['semester'];
    
    $conn->query("update school_preferences set activeSemester='$activateSemester' where school_id='$school_id'");


?>

<script> window.location='school_preferences.php?sfp_stat=xEdit'; </script>

<?php } ?>


<?php

if(isset($_POST['activateQtr']))
{
    $activeQuarter=$_POST['quarter'];
    
    $conn->query("update school_preferences set activeQuarter='$activeQuarter' where school_id='$school_id'");


?>

<script> window.location='school_preferences.php?sfp_stat=xEdit'; </script>

<?php } ?>


<?php 
if(isset($_POST['noClassDays']))
{
    $conn->query("update school_preferences set jan='$_POST[jan]', feb='$_POST[feb]', mar='$_POST[mar]', apr='$_POST[apr]', may='$_POST[may]', jun='$_POST[jun]', jul='$_POST[jul]', aug='$_POST[aug]', sep='$_POST[sep]', oct='$_POST[oct]', nov='$_POST[nov]', dece='$_POST[dece]' where school_id='$school_id'");
?>

<script> window.location='school_preferences.php?sfp_stat=xEdit'; </script>

<?php } ?>
