<!DOCTYPE html>
<html>

<?php

 
include('session.php');  
//error_reporting(0);

  $ageFrom=$_GET['ageFrom'];
  $ageTo=$_GET['ageTo'];
   
        
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
                messageTop: '<center><h3>YEARS OF SERVICE DATA</h3><h4><?php echo 'Year '.$ageFrom.' - '.$ageTo; ?></h4></center><hr />',
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
                    <h3>YEARS OF SERVICE DATA</h3>
                    <h4><?php echo 'Year '.$ageFrom.' - '.$ageTo; ?></h4>
                    </center>
                    
                    <div class="table-responsive" style="margin-top: 12px;">
                    <table id="example" class="display" style="width:100%">
                 
                      <thead>
                        <tr>
                          <th>Personnel</th>
                          <th>Office/Department</th>
                          <th>Designation</th>
                          <th>Date Hired</th>
                          <th>No. of Years</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, do_id, des_id, appointment_date, num_of_yrs FROM personnels WHERE num_of_yrs BETWEEN '$ageFrom' AND '$ageTo' ORDER BY lname, fname ASC") or die(mysql_error());
                      
                      while($printDA_row=$printDataAge_query->fetch()){ ?>
                      
                      <tr>
                      <td>
                      <?php
                          
                 
                                    if($printDA_row['suffix']=="-")
                                    {
                                        
                                    echo $printDA_row['lname'].", ".$printDA_row['fname']." ".substr($printDA_row['mname'], 0,1).".";
                                    
                                    }else{
                                        
                                    echo $printDA_row['lname'].", ".$printDA_row['fname']." ".$printDA_row['suffix']." ".substr($printDA_row['mname'], 0,1).". ";
                                    
                                    } ?>
                      </td>
                      <td>
                      <?php
                      
                      $emp_stat_query2 = $conn->query("select dept_office_name from dept_offices WHERE do_id='$printDA_row[do_id]'");
                      $es_row2=$emp_stat_query2->fetch();
                      
                      echo $es_row2['dept_office_name'];
                      
                      ?>
                      
                      </td>
                      <td>
                      <?php
                      
                      $emp_stat_query1 = $conn->query("select des_name from designation WHERE des_id='$printDA_row[des_id]'");
                      $es_row1=$emp_stat_query1->fetch();

                      
                      if(!empty($es_row1)){
                        echo $es_row1['des_name'];
                      }else{
                        echo "Not Set";
                      }
                      
                      ?>
                      
                      </td>
                      <td>
                      <?php
                      if($printDA_row['appointment_date']=='' OR $printDA_row['appointment_date']=='  /  /    '){ ?>
                        <div class="alert alert-danger">Set-up every personnel date hired first, to generate no. of years rendered...</div>
                      <?php }else{ echo $printDA_row['appointment_date']; } ?>
                      
                      </td>
                      
                      <td>
                      <?php
                      
                      echo $printDA_row['num_of_yrs'];
                     
                      ?>
                      
                      </td>
                      
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
       
            