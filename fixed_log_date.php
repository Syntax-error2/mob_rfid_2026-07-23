<?php include('session.php');
/*
$upd_ctr = 0;
$transList_query = $conn->query("SELECT * FROM personnel_logs");
while($tList_row=$transList_query->fetch()){ 
    
    $newDate = date('Y-m-d', strtotime($tList_row['logDate']));
    
    $conn->query("UPDATE personnel_logs SET logDate='$newDate' WHERE log_id='$tList_row[log_id]'");
    
    $upd_ctr += 1;
    
    echo $tList_row['logDate']." changed to ".$newDate;
    echo "( ".$upd_ctr." )";
    echo "<br />";
}


$upd_ctr = 0;
$transList_query = $conn->query("SELECT * FROM activity_calendar");
while($tList_row=$transList_query->fetch()){ 
    
    $newDate = date('Y-m-d', strtotime($tList_row['completeDate']));
    
    $conn->query("UPDATE activity_calendar SET completeDate='$newDate' WHERE activity_id='$tList_row[activity_id]'");
    
    $upd_ctr += 1;
    
    echo $tList_row['completeDate']." changed to ".$newDate;
    echo "( ".$upd_ctr." )";
    echo "<br />";
}

*/

$upd_ctr = 0;
$transList_query = $conn->query("SELECT * FROM leave_applicants");
while($tList_row=$transList_query->fetch()){ 
    
    $newDate = date('Y-m-d', strtotime($tList_row['leave_date']));
    
    $conn->query("UPDATE leave_applicants SET leave_date='$newDate' WHERE lap_id='$tList_row[lap_id]'");
    
    $upd_ctr += 1;
    
    echo $tList_row['leave_date']." changed to ".$newDate;
    echo "( ".$upd_ctr." )";
    echo "<br />";
}

$conn=null;
?>
