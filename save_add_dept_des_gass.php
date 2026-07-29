<?php

 
include('session.php');

?>
 
<?php

if(isset($_POST['leave_application']))
{
    $lap_code=$_POST['lap_code'];
    $application_date=date('m/d/Y');
    $leave_type=$_POST['leave_type']; 
    $leave_type_desc=$_POST['leave_type_desc']; 
 
    $conn->query("INSERT INTO leave_applicants(lap_code, application_date, leave_type, leave_type_desc, applicant_id, do_id, noted_by_id, approved_by_id, status)
    VALUES('$lap_code', '$application_date', '$leave_type', '$leave_type_desc', '$user_personnel_id', '$user_dept', 0, 0, 'Pending')");
?>

<script>
window.alert('Application for <?php echo $leave_type; ?> successfully added, this will be reviewed by your office and HR head and check this page for application status...');
window.location='list_leave.php?cw=list_leave';
</script>

<?php } ?>


<?php

if(isset($_POST['updateLAP']))
{
    $lap_code=$_POST['lap_code'];
    $application_date=date('m/d/Y');
    $leave_type=$_POST['leave_type']; 
    $leave_type_desc=$_POST['leave_type_desc']; 
 
    $conn->query("UPDATE leave_applicants SET application_date='$application_date', leave_type='$leave_type', leave_type_desc='$leave_type_desc', noted_by_id=0, approved_by_id=0, status='Pending' WHERE lap_code='$lap_code'");

?>

<script>
window.alert('Application for <?php echo $leave_type; ?> successfully updated, this will be reviewed by your office and HR head and check this page for application status...');
window.location='list_leave.php?cw=list_leave';
</script>

<?php } ?>


<?php

if(isset($_POST['updateNotedLAP']))
{
    $lap_code=$_POST['lap_code'];
    $noted_by_id=$_POST['noted_by_id'];
    
        if($noted_by_id>0){
        $conn->query("UPDATE leave_applicants SET noted_by_id='$noted_by_id' WHERE lap_code='$lap_code'");
        }else{
        $conn->query("UPDATE leave_applicants SET noted_by_id='$noted_by_id', approved_by_id=0, status='Pending' WHERE lap_code='$lap_code'");
        
        $LAPData_query = $conn->query("SELECT * FROM leave_applicants WHERE lap_code='$lap_code'");
        $lapdq_row=$LAPData_query->fetch();
        
        $perData_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$lapdq_row[applicant_id]'");
        $pdq_row=$perData_query->fetch();
        
        $lapNoD_query = $conn->query("SELECT * FROM lap_dates WHERE lap_code='$lap_code' ORDER BY leave_date_mm, leave_date_dd, leave_date_yyyy ASC") or die(mysql_error());
        while ($lapNoD_row = $lapNoD_query->fetch())
        {
        
        $logDate=$lapNoD_row['leave_date_mm'].'/'.$lapNoD_row['leave_date_dd'].'/'.$lapNoD_row['leave_date_yyyy'];
        //save to student logs
        $conn->query("DELETE FROM personnel_logs WHERE RFTag_id='$pdq_row[RFTag_id]' AND logDate='$logDate' AND remarks='On Leave'");
        
        } 
        
        }
    
    

?>

<script>
window.alert('Dept. / Office Head Level application status updated...');
window.location='list_leave.php?cw=list_leave';
</script>

<?php } ?>


<?php

if(isset($_POST['updateApprovedLAP']))
{
    $lap_code=$_POST['lap_code'];
    $approved_by_id=$_POST['approved_by_id'];
    
    if($approved_by_id>0){
        $conn->query("UPDATE leave_applicants SET approved_by_id='$approved_by_id', status='Approved' WHERE lap_code='$lap_code'");
        
        
        $LAPData_query = $conn->query("SELECT * FROM leave_applicants WHERE lap_code='$lap_code'");
        $lapdq_row=$LAPData_query->fetch();
        
        $perData_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$lapdq_row[applicant_id]'");
        $pdq_row=$perData_query->fetch();
        
        $lapNoD_query = $conn->query("SELECT * FROM lap_dates WHERE lap_code='$lap_code' ORDER BY leave_date_mm, leave_date_dd, leave_date_yyyy ASC") or die(mysql_error());
        while ($lapNoD_row = $lapNoD_query->fetch())
        {
        
        $logDate=$lapNoD_row['leave_date_mm'].'/'.$lapNoD_row['leave_date_dd'].'/'.$lapNoD_row['leave_date_yyyy'];
        //save to student logs
        $conn->query("INSERT INTO personnel_logs(RFTag_id, logDate, remarks) VALUES ('$pdq_row[RFTag_id]', '$logDate', 'On Leave')"); 
        
        }
        
        
        
        
        //SEND EMAIL
        /* $to = $pdq_row['email'];
        $subject = "BCC - HR [ Leave Application Notification ]";
        
        $message = "
        <html>
        <head>
        <title>BCC - HR Leave Application Notification</title>
        </head>
        <body>
        <p>Leave Application Details</p>
        <table>
        
        <tr>
        <th>Date Applied</th>
        <td>".$lapdq_row['application_date']."</td>
        </tr>
        
        <tr>
        <th>Type of Leave</th>
        <td>".$lapdq_row['leave_type']."</td>
        </tr>
        
        <tr>
        <th>Description</th>
        <td>".$lapdq_row['leave_type_desc']."</td>
        </tr>
        
        <tr>
        <th>Number of days:</th>
        <td>".$lapNoD_query->rowCount()."</td>
        </tr>
        
        <tr>
        <th>Status</th>
        <td><strong>Approved</strong></td>
        </tr>
        
        </table>
        </body>
        </html>
        ";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: Binalbagan Catholic College - HR' . "\r\n";
        $headers .= 'Cc: emiloimagtolis@gmail.com' . "\r\n";
        
        mail($to,$subject,$message,$headers); */
        
        //END SEND EMAIL
        
        
        
    }else{
        
        $conn->query("UPDATE leave_applicants SET approved_by_id='$approved_by_id', status='Pending' WHERE lap_code='$lap_code'");
        
        $LAPData_query = $conn->query("SELECT * FROM leave_applicants WHERE lap_code='$lap_code'");
        $lapdq_row=$LAPData_query->fetch();
        
        $perData_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$lapdq_row[applicant_id]'");
        $pdq_row=$perData_query->fetch();
        
        $lapNoD_query = $conn->query("SELECT * FROM lap_dates WHERE lap_code='$lap_code' ORDER BY leave_date_mm, leave_date_dd, leave_date_yyyy ASC") or die(mysql_error());
        while ($lapNoD_row = $lapNoD_query->fetch())
        {
        
        $logDate=$lapNoD_row['leave_date_mm'].'/'.$lapNoD_row['leave_date_dd'].'/'.$lapNoD_row['leave_date_yyyy'];
        //save to student logs
        $conn->query("DELETE FROM personnel_logs WHERE RFTag_id='$pdq_row[RFTag_id]' AND logDate='$logDate' AND remarks='On Leave'"); 
        
        }
        
        
        //SEND EMAIL
        /* $to = $pdq_row['email'];
        $subject = "BCC - HR [ Leave Application Notification ]";
        
        $message = "
        <html>
        <head>
        <title>BCC - HR Leave Application Notification</title>
        </head>
        <body>
        <p>Leave Application Details</p>
        <table>
        
        <tr>
        <th>Date Applied</th>
        <td>".$lapdq_row['application_date']."</td>
        </tr>
        
        <tr>
        <th>Type of Leave</th>
        <td>".$lapdq_row['leave_type']."</td>
        </tr>
        
        <tr>
        <th>Description</th>
        <td>".$lapdq_row['leave_type_desc']."</td>
        </tr>
        
        <tr>
        <th>Number of days:</th>
        <td>".$lapNoD_query->rowCount()."</td>
        </tr>
        
        <tr>
        <th>Status</th>
        <td><strong>Pending</strong></td>
        </tr>
        
        </table>
        </body>
        </html>
        ";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: Binalbagan Catholic College - HR' . "\r\n";
        $headers .= 'Cc: emiloimagtolis@gmail.com' . "\r\n";
        
        mail($to,$subject,$message,$headers); */
        
        //END SEND EMAIL
        
    }
    
?>

<script>
window.alert('HR Head level application status updated...');
window.location='home.php';
</script>

<?php } ?>

<?php

if(isset($_POST['deleteLAP']))
{   
    $lap_code=$_POST['lap_code']; 
    
    $conn->query("DELETE FROM leave_applicants WHERE lap_code='$lap_code'");
?>

<script>
window.alert('Leave application successfully deleted...');
window.location='list_leave.php?cw=list_leave';
</script>

<?php } ?>


<?php

if(isset($_POST['addLAPDate']))
{
    $lap_code=$_POST['lap_code'];
    
    $leave_date_mm=substr($_POST['leave_date'], 5,2);
    $leave_date_dd=substr($_POST['leave_date'], 8,2);
    $leave_date_yyyy=substr($_POST['leave_date'], 0,4);
 
    $conn->query("INSERT INTO lap_dates(lap_code, leave_date_mm, leave_date_dd, leave_date_yyyy)
    VALUES('$lap_code', '$leave_date_mm', '$leave_date_dd', '$leave_date_yyyy')");
?>

<script>
window.alert('Leave date <?php echo $leave_date_mm.'/'.$leave_date_dd.'/'.$leave_date_yyyy; ?> successfully added...');
window.location='list_leave.php?cw=list_leave';
</script>

<?php } ?>


<?php

if(isset($_POST['updateLAPDate']))
{
    $lap_dates_id=$_POST['lap_dates_id'];
    
    $leave_date_mm=substr($_POST['leave_date'], 5,2);
    $leave_date_dd=substr($_POST['leave_date'], 8,2);
    $leave_date_yyyy=substr($_POST['leave_date'], 0,4);
 
    $conn->query("update lap_dates SET leave_date_mm='$leave_date_mm', leave_date_dd='$leave_date_dd', leave_date_yyyy='$leave_date_yyyy' WHERE lap_dates_id='$lap_dates_id'");
?>

<script>
window.alert('Leave date <?php echo $leave_date_mm.'/'.$leave_date_dd.'/'.$leave_date_yyyy; ?> successfully updated...');
window.location='list_leave.php?cw=list_leave';
</script>

<?php } ?>

 
<?php

if(isset($_POST['deleteLAPDate']))
{   
    $lap_dates_id=$_POST['lap_dates_id'];
    
    $conn->query("DELETE FROM lap_dates WHERE lap_dates_id='$lap_dates_id'");
?>

<script>
window.alert('Leave date successfully deleted...');
window.location='list_leave.php?cw=list_leave';
</script>

<?php } ?>


<?php

if(isset($_POST['addDept']))
{
    $dept_office_name=addslashes($_POST['dept_office_name']); 
 
    $conn->query("INSERT INTO dept_offices(dept_office_name)VALUES('$dept_office_name')");
?>

<script>
window.alert('Department / Office: <?php echo $dept_office_name; ?> successfully added...');
window.location='list_dept.php';
</script>

<?php } ?>



<?php

if(isset($_POST['updateDept']))
{
    
    $do_id=$_POST['do_id'];
    $dept_office_name=addslashes($_POST['dept_office_name']); 
     
    $conn->query("UPDATE dept_offices SET dept_office_name='$dept_office_name' WHERE do_id='$do_id'");
?>

<script>
window.alert('Department / Office: <?php echo $dept_office_name; ?> successfully updated...');
window.location='list_dept.php';
</script>

<?php } ?>


<?php

if(isset($_POST['deleteDept']))
{   
    $do_id=$_POST['do_id'];
    $dept_office_name=$_POST['dept_office_name'];
    
    $conn->query("DELETE FROM dept_offices WHERE do_id='$do_id'");
?>

<script>
window.alert('Department / Office: <?php echo $dept_office_name; ?> successfully deleted...');
window.location='list_dept.php';
</script>

<?php } ?>












<?php

if(isset($_POST['addDes']))
{
    $des_name=addslashes($_POST['des_name']); 
 
    $conn->query("INSERT INTO designation(des_name)VALUES('$des_name')");
?>

<script>
window.alert('Designation: <?php echo $des_name; ?> successfully added...');
window.location='list_designation.php';
</script>

<?php } ?>



<?php

if(isset($_POST['updateDes']))
{
    
    $des_id=$_POST['des_id'];
    $des_name=addslashes($_POST['des_name']); 
     
    $conn->query("UPDATE designation SET des_name='$des_name' WHERE des_id='$des_id'");
?>

<script>
window.alert('Designation: <?php echo $des_name; ?> successfully updated...');
window.location='list_designation.php';
</script>

<?php } ?>


<?php

if(isset($_POST['deleteDes']))
{   
    $des_id=$_POST['des_id'];
    $des_name=$_POST['des_name']; 
    
    $conn->query("DELETE FROM designation WHERE des_id='$des_id'");
?>

<script>
window.alert('Designation: <?php echo $des_name; ?> successfully deleted...');
window.location='list_designation.php';
</script>

<?php } ?>














<?php

if(isset($_POST['addGASS']))
{
     
    $gass_name=$_POST['gass_name']; //salary grade
    
    if($gass_name<=10){
        $level="First Level";
    }elseif($gass_name<=24 AND $gass_name>10){
        $level="Second Level";
    }elseif($gass_name<=38 AND $gass_name>24){
        $level="Executive / Managerial";
    }elseif($gass_name<=52 AND $gass_name>38){
        $level="Third Level";
    }
    
     
    $ratePerDay=$_POST['ratePerDay'];
    
    $conn->query("INSERT INTO gass(gass_name, level, step, ratePerDay)VALUES
    ('$gass_name', '$level', '1', '$ratePerDay'),
    ('$gass_name', '$level', '2', '$ratePerDay'),
    ('$gass_name', '$level', '3', '$ratePerDay'),
    ('$gass_name', '$level', '4', '$ratePerDay'),
    ('$gass_name', '$level', '5', '$ratePerDay'),
    ('$gass_name', '$level', '6', '$ratePerDay'),
    ('$gass_name', '$level', '7', '$ratePerDay'),
    ('$gass_name', '$level', '8', '$ratePerDay')");
?>

<script>
window.alert('Salary Grade: <?php echo $gass_name; ?> | Level: <?php echo $level; ?> | Step: <?php echo $step; ?> | Rate per day: <?php echo $ratePerDay; ?>  successfully added...');
window.location='list_gass.php';
</script>

<?php } ?>



<?php

if(isset($_POST['updateGASS']))
{
    
    $gass_id=$_POST['gass_id'];
    
    $gass_name=$_POST['gass_name']; //salary grade
    
    if($gass_name<=10){
        $level="First Level";
    }elseif($gass_name<=24 AND $gass_name>10){
        $level="Second Level";
    }elseif($gass_name<=38 AND $gass_name>24){
        $level="Executive / Managerial";
    }elseif($gass_name<=52 AND $gass_name>38){
        $level="Third Level";
    }
    
    $step=$_POST['step'];
    $ratePerDay=$_POST['ratePerDay'];
     
    $conn->query("UPDATE gass SET gass_name='$gass_name', level='$level', step='$step', ratePerDay='$ratePerDay' WHERE gass_id='$gass_id'");
?>

<script>
window.alert('Salary Grade: <?php echo $gass_name; ?> | Level: <?php echo $level; ?> | Step: <?php echo $step; ?> | Rate per day: <?php echo $ratePerDay; ?>  successfully updated...');
window.location='list_gass.php';
</script>

<?php } ?>


<?php

if(isset($_POST['deleteGASS']))
{   
    $gass_id=$_POST['gass_id'];
    
    
    $subjK_query = $conn->query("SELECT * FROM gass WHERE gass_id='$gass_id'") or die(mysql_error());
    $subjK_row = $subjK_query->fetch();
    
    $conn->query("DELETE FROM gass WHERE gass_id='$gass_id'");
?>

<script>
window.alert('Salary Grade: <?php echo $subjK_row['gass_name']; ?> | Level: <?php echo $subjK_row['level']; ?> | Step: <?php echo $subjK_row['step']; ?> | Rate per day: <?php echo $subjK_row['ratePerDay']; ?>  successfully deleted...');
window.location='list_gass.php';
</script>

<?php } ?>
 







<?php

if(isset($_POST['addShift']))
{   
    $do_id=$_POST['do_id'];
    $shift_name=addslashes($_POST['shift_name']); 
    $type=$_POST['type'];
    
    
    $conn->query("INSERT INTO shifts(do_id, shift_name, type)VALUES('$do_id', '$shift_name', '$type')");
?>

<script>
window.alert('Shift: <?php echo $shift_name; ?> successfully added...');
window.location='list_shift.php';
</script>

<?php } ?>



<?php

if(isset($_POST['updateShift']))
{
    
    $shift_id=$_POST['shift_id'];
    $do_id=$_POST['do_id'];
    $shift_name=addslashes($_POST['shift_name']); 
    $type=$_POST['type'];
    
    $conn->query("UPDATE shifts SET do_id='$do_id', shift_name='$shift_name', type='$type' WHERE shift_id='$shift_id'");
?>

<script>
window.alert('Shift: <?php echo $shift_name; ?> successfully updated...');
window.location='list_shift.php';
</script>

<?php } ?>


<?php

if(isset($_POST['deleteShift']))
{   
    $shift_id=$_POST['shift_id'];
    $shift_name=addslashes($_POST['shift_name']); 
    
    $conn->query("DELETE FROM shifts WHERE shift_id='$shift_id'");
?>

<script>
window.alert('Shift: <?php echo $shift_name; ?> successfully deleted...');
window.location='list_shift.php';
</script>

<?php } ?>








<?php

if(isset($_POST['addEmpStatus']))
{
    $emp_stat_name=addslashes($_POST['emp_stat_name']); 
    $status=$_POST['status']; 
    $position_class=$_POST['position_class']; 
    
    $conn->query("INSERT INTO emp_status(emp_stat_name, position_class, status)VALUES('$emp_stat_name', '$position_class', '$status')");
?>

<script>
window.alert('Appointment status: <?php echo $emp_stat_name; ?> | Class: <?php echo $position_class; ?> | Type: <?php echo $status; ?> successfully added...');
window.location='list_EStatus.php';
</script>

<?php } ?>



<?php

if(isset($_POST['updateEmpStatus']))
{
    
    $empStat_id=$_POST['empStat_id'];
    $emp_stat_name=addslashes($_POST['emp_stat_name']); 
    $status=$_POST['status']; 
    $position_class=$_POST['position_class']; 
    
    $conn->query("UPDATE emp_status SET emp_stat_name='$emp_stat_name', position_class='$position_class', status='$status' WHERE empStat_id='$empStat_id'");
?>

<script>
window.alert('Appointment status: <?php echo $emp_stat_name; ?> | Class: <?php echo $position_class; ?> | Type: <?php echo $status; ?> successfully updated...');
window.location='list_EStatus.php';
</script>

<?php } ?>


<?php

if(isset($_POST['deleteEmpStatus']))
{   
    $empStat_id=$_POST['empStat_id'];
    
    $subjK_query = $conn->query("SELECT * FROM emp_status WHERE empStat_id='$empStat_id'") or die(mysql_error());
    $subjK_row = $subjK_query->fetch();
                            
    $conn->query("DELETE FROM emp_status WHERE empStat_id='$empStat_id'");
?>

<script>
window.alert('Appointment status: <?php echo $subjK_row['emp_stat_name']; ?> | Class: <?php echo $subjK_row['position_class']; ?> | Type: <?php echo $subjK_row['status']; ?> successfully deleted...');
window.location='list_EStatus.php';
</script>

<?php } ?>