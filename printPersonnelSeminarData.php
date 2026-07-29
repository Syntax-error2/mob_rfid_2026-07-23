<!DOCTYPE html>
<html>

<?php

 
include('session.php');  
//error_reporting(0);

  $dateFrom=$_GET['dateFrom'];
  $dateTo=$_GET['dateTo'];
   
        
include('header_print.php');

?>
 

<body>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                title: '<?php include('header_print_letterHead.php'); ?>',
                messageTop: '<center><h3>PERSONNELS SEMINARS DATA</h3><h4><?php echo 'Date '.$dateFrom.' - '.$dateTo; ?></h4></center><hr />',
                messageBottom: '<center>Municipality of Binalbagan - Human Resource Management Office</center>'
            }
        ]
    } );
} );
</script>
 

                    <div class="row">
                    <div class="col-lg-12">
                    <?php include('header_print_letterHead.php'); ?>
                    
                    <center>
                    <h3>PERSONNELS SEMINAR'S DATA</h3>
                    <h4><?php echo 'Date '.$dateFrom.' - '.$dateTo; ?></h4>
                    </center>
                    
                    <div class="table-responsive" style="margin-top: 12px;">
                    <table id="example" class="display" style="width:100%">
                          <thead>
                            <tr>
                              <th style="width: 25% !important;">PERSONNEL</th>
                              <th>TITLE</th>
                              <th>DESCRIPTION</th>
                              <th>VENUE</th>
                              <th>DATE</th>
                            </tr>
                          </thead>
                          <tbody> 
                                <?php
                                $printSeminarData_query = $conn->query("SELECT personnel_id, seminar_title, seminar_desc, seminar_venue, event_date FROM personnel_seminars WHERE event_date BETWEEN '$dateFrom' AND '$dateTo' ORDER BY ps_id ASC") or die(mysql_error());
                                while($printSD_row=$printSeminarData_query->fetch()){  
                                
                                
                                $staff_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$printSD_row[personnel_id]' AND (separation_date='' OR separation_date='  /  /    ')") or die(mysql_error());
                                $staff_row = $staff_query->fetch(); ?>
     
                                    
     
               
                            <tr>
 
                            <td>
                              <?php
                              if(!empty($staff_row)){
                              if($staff_row['suffix']=="-")
                              {
                                echo $staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname'];
                                            
                              }else{
                                echo $staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname']." ".$staff_row['suffix'];
                                            
                              } }else{
                                echo "<span class='badge badge-danger'>Unidentified Personnel</span>";
                              } ?>
                            </td>
                            <td><p style="word-wrap: break-word !important;"><?php echo $printSD_row['seminar_title']; ?></p></td>
                            <td><p style="word-wrap: break-word !important;"><?php echo $printSD_row['seminar_desc']; ?></p></td>
                            <td><p style="word-wrap: break-word !important;"><?php echo $printSD_row['seminar_venue']; ?></p></td>
                            <td><?php echo $printSD_row['event_date']; ?><?php //echo $printSD_row['event_date_to']; ?></td>
                            </tr> 
                             <?php } ?>
                           
                          </tbody>
                        </table>
                 
                        </div>
                        </div>
                        </div>
<?php include('footer_print.php'); ?>

</body>
</html>
       
            