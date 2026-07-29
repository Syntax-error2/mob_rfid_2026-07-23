<?php

 
include('session.php');
 
if(isset($_POST['addNews']))
{
    $news_title=addslashes($_POST['news_title']);
    $news_contents=addslashes($_POST['news_contents']);
    $dateTime=date('m/d/Y').' | '.date('h:i:s A');
    $posted_by=$_POST['posted_by'];
    
    $checkbox = $_POST['checkbox'];

    for($i=0;$i<count($checkbox);$i++)
    {
        
    $ipAddress = $checkbox[$i];
    
    $conn->query("INSERT INTO news(news_title, news_contents, dateTime, posted_by, ipAddress)
    VALUES('$news_title', '$news_contents', '$dateTime', '$posted_by', '$ipAddress')");
    
    }
?>

<script> window.location='list_news.php'; </script>

<?php } ?>
 
 
 
<?php
 
if(isset($_POST['editNews']))
{
     
 
    $conn->query("UPDATE news SET news_title='$_POST[news_title]', news_contents='$_POST[news_contents]', posted_by='$_POST[posted_by]', ipAddress='$_POST[ipAddress]' WHERE news_id='$_GET[news_id]'");

?>

<script> window.location='list_news.php'; </script>

<?php } ?>




 
<?php
 
if(isset($_POST['deleteNews']))
{

    $conn->query("DELETE FROM news WHERE news_id='$_GET[news_id]'");

?>

<script> window.location='list_news.php'; </script>

<?php } ?>

