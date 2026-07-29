<?php

 
include('session.php');
 
if(isset($_POST['addClientComp']))
{
    $ipAddress=$_POST['ipAddress'];
    $compName=$_POST['compName'];
    
    $description=$_POST['description'];
    $clientNumber=$_POST['clientNumber'];
    
    $conn->query("INSERT INTO client_computer(ipAddress, compName, description, clientNumber)VALUES('$ipAddress', '$compName', '$description', '$clientNumber')");

?>

<script> window.location='list_client_comp.php'; </script>

<?php } ?>
 
<?php
 
if(isset($_POST['editClientComp']))
{
 
    $conn->query("UPDATE client_computer SET description='$_POST[description]', clientNumber='$_POST[clientNumber]' WHERE client_id='$_GET[client_id]'");

?>

<script> window.location='list_client_comp.php'; </script>

<?php } ?>

 
 
<?php
 
if(isset($_POST['deleteClient']))
{

    $conn->query("DELETE FROM client_computer WHERE client_id='$_GET[client_id]'");

?>

<script> window.location='list_client_comp.php'; </script>

<?php } ?>


