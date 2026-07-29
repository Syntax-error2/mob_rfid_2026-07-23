<?php

include('session.php');

if(isset($_POST['setDH'])){
    

$RFTag_id=substr($_POST['RFTag_id'], 0, 8);

$fnameList_query = $conn->query("SELECT personnel_id FROM personnels WHERE RFTag_id='$RFTag_id'");
$fnlq_row = $fnameList_query->fetch();
                                                
$conn->query("UPDATE dept_offices SET officeHead_id='$fnlq_row[personnel_id]' WHERE do_id='$_GET[do_id]'");

?>

<script>
window.alert('Department / Office head successfully updated...');
window.location='home.php';
</script>

<?php } ?>