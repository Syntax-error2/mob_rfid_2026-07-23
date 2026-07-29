<!DOCTYPE html>
<html>

<?php
include('session.php');  
//error_reporting(0);
   
include('header_print.php');

?>

<body>

<?php include('header_print_letterHead.php'); ?>
 
<?php

$subjK_query = $conn->query("SELECT * FROM leave_applicants WHERE lap_code='$_GET[lap_code]'") or die(mysql_error());
$subjK_row = $subjK_query->fetch();

?>

<br />
<center>
<h1>LEAVE FORM</h1>
</center>
<hr />
<br />
<table style="width: 100%; margin-left: 24px;">
 

<tr>
<td colspan="2">




 <strong>Date Applied:</strong> <?php echo $subjK_row['application_date']; ?>
 <br /><br />
 <strong>Type of Leave:</strong> <?php echo $subjK_row['leave_type']; ?>
 <br /><br />
 <strong>Description:</strong> <?php echo $subjK_row['leave_type_desc']; ?>
 <br /><br />
                          
                          <?php
                          $lapNoD_query = $conn->query("SELECT * FROM lap_dates WHERE lap_code='$subjK_row[lap_code]' ORDER BY leave_date_mm, leave_date_dd, leave_date_yyyy ASC") or die(mysql_error());
                          ?>
                          <strong>Number of days:</strong> <?php echo $lapNoD_query->rowCount(); ?>
                          <br /><br />
                          <strong>Dates: </strong>
                          <?php while ($lapNoD_row = $lapNoD_query->fetch()){  
                          
                          if($lapNoD_query->rowCount()>1){
                          echo '<span style="text-decoration-line: underline;">'.$leaveDates=$lapNoD_row['leave_date_mm'].'/'.$lapNoD_row['leave_date_dd'].'/'.$lapNoD_row['leave_date_yyyy'].'</span> &middot; ';
                        
                          }else{
                          echo $leaveDates=$lapNoD_row['leave_date_mm'].'/'.$lapNoD_row['leave_date_dd'].'/'.$lapNoD_row['leave_date_yyyy'];
                          }
                          
                          }  ?> 
                        
                         
                   
                    
</td>
</tr>


<tr>
<td>
<br />
<br />
<br />
<p style="text-decoration-line: underline; margin-bottom: 0px; font-weight: bold;">
                        <?php
                          $perData_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$subjK_row[applicant_id]'");
                          $pdq_row=$perData_query->fetch();
                          
                 
                                    if($pdq_row['suffix']=="-")
                                    {
                                        
                                    echo $pdq_row['fname']." ".substr($pdq_row['mname'], 0,1).". ".$pdq_row['lname'];
                                    
                                    }else{
                                        
                                    echo $pdq_row['fname']." ".substr($pdq_row['mname'], 0,1).". ".$pdq_row['lname']." ".$pdq_row['suffix'];
                                    
                                    }  
                          ?>
                        
</p>               
Leave Applicant                    
</td>

<td>
<br />
<br />
<br />
<p style="text-decoration-line: underline; margin-bottom: 0px; font-weight: bold;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>               
Substitue                    
</td>
</tr>


<tr>
<td style="width: 55%;">
<br />
<br />
<br />
NOTED:
<br />
<br />
<br />
<p style="text-decoration-line: underline; margin-bottom: 0px; font-weight: bold;">
                        <?php
                          $perData_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$subjK_row[noted_by_id]'");
                          $pdq_row=$perData_query->fetch();
                          
                 
                                    if($pdq_row['suffix']=="-")
                                    {
                                        
                                    echo $pdq_row['fname']." ".substr($pdq_row['mname'], 0,1).". ".$pdq_row['lname'];
                                    
                                    }else{
                                        
                                    echo $pdq_row['fname']." ".substr($pdq_row['mname'], 0,1).". ".$pdq_row['lname']." ".$pdq_row['suffix'];
                                    
                                    }  
                          ?>
                        
</p>               
Department/Office Head                    
</td>
 
<td>
<br />
<br />
<br />
APPROVED:
<br />
<br />
<br />
<p style="text-decoration-line: underline; margin-bottom: 0px; font-weight: bold;">
                        <?php
                          $perData_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$subjK_row[approved_by_id]'");
                          $pdq_row=$perData_query->fetch();
                          
                 
                                    if($pdq_row['suffix']=="-")
                                    {
                                        
                                    echo $pdq_row['fname']." ".substr($pdq_row['mname'], 0,1).". ".$pdq_row['lname'];
                                    
                                    }else{
                                        
                                    echo $pdq_row['fname']." ".substr($pdq_row['mname'], 0,1).". ".$pdq_row['lname']." ".$pdq_row['suffix'];
                                    
                                    }  
                          ?>
                        
</p>               
Human Resource Head                   
</td>
</tr>
</table>
 
<br />
<br />
<br />
<br /> 
 
<?php include('footer_print.php'); ?>

</body>
</html>
       
            