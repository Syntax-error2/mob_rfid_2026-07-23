<?php


include('session.php');
  
$conn->query("DELETE FROM files WHERE file_id='$_GET[file_id]'");
 
?>

<script>
window.alert('File deleted successfully...');
window.location='list_personnel.php?dept=<?php echo $_GET['dept']; ?>';
</script>    
