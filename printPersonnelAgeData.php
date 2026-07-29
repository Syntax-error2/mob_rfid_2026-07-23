<!DOCTYPE html>
<html>

<?php
include('session.php');  
//error_reporting(0);

  $ageFrom=$_GET['ageFrom'];
  $ageTo=$_GET['ageTo'];
  $empStat_id=$_GET['empStat_id'];
        
include('header_print.php');

?>
 
<body>
                    
                    
                    <!-- MALE LIST --><!-- MALE LIST -->
                    <?php if($_GET['print_output']==='Male Only'){ ?>
                    <div class="row">
                    <div class="col-lg-12">
                    
                    <?php include('header_print_letterHead.php'); ?>
                    
                    <center>
                    <h3 style="font-weight: bold;">MALE PERSONNELS AGE with DATE OF BIRTH</h3><h4><?php echo 'Ages '.$ageFrom.' - '.$ageTo; ?></h4>
                    </center>
                    
                    <table style="width:99%; margin: 8px;">
                 
                      <thead>
                        <tr>
                          <th style="width: 20%;">PERSONNEL</th>
                          <th style="width: 25%;">OFFICE/DEPARTMENT</th>
                          <th style="width: 25%;">DESIGNATION</th>
                          <th style="width: 15%;">STATUS</th>
                          <th style="width: 20%;">DATE OF BIRTH</th>
                          <th style="width: 10%;">AGE</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      $list_ctr=0;
                      if($empStat_id>0){
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE sex='Male' AND (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') AND empStat_id='$empStat_id' ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }else{
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE sex='Male' AND (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }
                      
                      while($printDA_row=$printDataAge_query->fetch()){
                        
                      $list_ctr+=1;
                      
                      ?>
                      
                      <tr>
                      <td>
                      <?php
                      
                      if($printDA_row['mname']==='' OR $printDA_row['mname']==='-'){
                        $final_mname='';
                      }else{
                        $final_mname=substr($printDA_row['mname'], 0,1).". ";
                      }
                                    
                            
                      if($printDA_row['suffix']=="-")
                      {
                                    
                        echo $list_ctr.'. '.$printDA_row['lname'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      }else{
                                        
                        echo $list_ctr.'. '.$printDA_row['lname']." ".$printDA_row['suffix'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      } ?>
                      </td>
                      <td>
                      <?php
                      
                      $emp_stat_query2 = $conn->query("SELECT dept_office_name from dept_offices WHERE do_id='$printDA_row[do_id]'");
                      $es_row2=$emp_stat_query2->fetch();
                     
                      echo $es_row2['dept_office_name'];
                      
                      ?>
                      
                      </td>
                      <td>
                      <?php
                      
                      
                      $emp_stat_query1 = $conn->query("SELECT des_name from designation WHERE des_id='$printDA_row[des_id]'");
                      $es_row1=$emp_stat_query1->fetch();
 
                     
                      echo $es_row1['des_name'];
                      
                      ?>
                      
                      </td>
                      <td>
                      <?php
                      
                     
                      $empStat_query = $conn->query("SELECT * FROM emp_status WHERE empStat_id='$printDA_row[empStat_id]'") or die(mysql_error());
                      $empStat_row = $empStat_query->fetch(); 
                     
                      echo $empStat_row['emp_stat_name'];
                      
                      ?>
                      
                      </td>
                      
                      <td><?php echo $printDA_row['bdMM']; ?>/<?php echo $printDA_row['bdDD']; ?>/<?php echo $printDA_row['bdYYYY']; ?></td>
                      
                      <td>
                      <?php
                      if($printDA_row['age']==0){ ?>
                        Set Up Date of Birth
                      <?php }else{ echo $printDA_row['age']; } ?>
                      
                      </td>
                      </tr>
                    
                      <?php } ?>
                      </tbody>
                      
                 </table>
               
                </div>
                </div>
                
                <?php include('footer_print.php'); ?>
                    <?php } ?>
                    <!-- END MALE LIST --><!-- END MALE LIST -->
                    
                    <!-- FEMALE LIST --><!-- FEMALE LIST -->
                    <?php if($_GET['print_output']==='Female Only'){ ?>
                <div class="row">
                <div class="col-lg-12">
                
                <?php include('header_print_letterHead.php'); ?>
                    
                <center>
                <h3 style="font-weight: bold;">FEMALE PERSONNELS AGE with DATE OF BIRTH</h3><h4><?php echo 'Ages '.$ageFrom.' - '.$ageTo; ?></h4>
                </center>
                
                <table style="width:99%; margin: 8px;">
                 
                      <thead>
                        <tr>
                          <th style="width: 20%;">PERSONNEL</th>
                          <th style="width: 25%;">OFFICE/DEPARTMENT</th>
                          <th style="width: 25%;">DESIGNATION</th>
                          <th style="width: 15%;">STATUS</th>
                          <th style="width: 20%;">DATE OF BIRTH</th>
                          <th style="width: 10%;">AGE</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $list_ctr=0;
                      
                      if($empStat_id>0){
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE sex='Female' AND (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') AND empStat_id='$empStat_id' ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }else{
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE sex='Female' AND (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }
                     
                      while($printDA_row=$printDataAge_query->fetch()){
                      
                      $list_ctr+=1;
                      
                      ?>
                      
                      <tr>
                      <td>
                      <?php
                      
                      if($printDA_row['mname']==='' OR $printDA_row['mname']==='-'){
                        $final_mname='';
                      }else{
                        $final_mname=substr($printDA_row['mname'], 0,1).". ";
                      }
                                    
                            
                      if($printDA_row['suffix']=="-")
                      {
                                    
                        echo $list_ctr.'. '.$printDA_row['lname'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      }else{
                                        
                        echo $list_ctr.'. '.$printDA_row['lname']." ".$printDA_row['suffix'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      } ?>
                      </td>
                      <td>
                      <?php
                      
                      $emp_stat_query2 = $conn->query("SELECT dept_office_name from dept_offices WHERE do_id='$printDA_row[do_id]'");
                      $es_row2=$emp_stat_query2->fetch();
                      
                      echo $es_row2['dept_office_name'];
                      
                      ?>
                      </td>
                       <td>
                      <?php
                      
                      $emp_stat_query1 = $conn->query("SELECT des_name from designation WHERE des_id='$printDA_row[des_id]'");
                      $es_row1=$emp_stat_query1->fetch();
                      
                      echo $es_row1['des_name'];
                      
                      ?>
                      </td>
                       <td>
                      <?php
                      
                      $empStat_query = $conn->query("SELECT * FROM emp_status WHERE empStat_id='$printDA_row[empStat_id]'") or die(mysql_error());
                      $empStat_row = $empStat_query->fetch(); 
                     
                      echo $empStat_row['emp_stat_name'];
                      
                      ?>
                      </td>
                      
                      <td><?php echo $printDA_row['bdMM']; ?>/<?php echo $printDA_row['bdDD']; ?>/<?php echo $printDA_row['bdYYYY']; ?></td>
                      
                      <td>
                      <?php
                      if($printDA_row['age']==0){ ?>
                        Set Up Date of Birth
                      <?php }else{ echo $printDA_row['age']; } ?>
                      
                      </td>
                      </tr>
                    
                      <?php } ?>
                      </tbody>
                      
                 </table>
                 
                 </div>
                 </div>
                <?php include('footer_print.php'); ?>
                    <?php } ?>
                    <!-- END FEMALE LIST --><!-- END FEMALE LIST -->
                    
                    
                    
                    <!-- MALE-FEMALE LIST --><!-- MALE-FEMALE LIST -->
                    <?php if($_GET['print_output']==='Male-Female'){ ?>
                    <div class="row">
                    <div class="col-lg-12">
                    
                    <?php include('header_print_letterHead.php'); ?>
                    
                    <center>
                    <h3 style="font-weight: bold;">MALE PERSONNELS AGE with DATE OF BIRTH</h3><h4><?php echo 'Ages '.$ageFrom.' - '.$ageTo; ?></h4>
                    </center>
                    
                    <table style="width:99%; margin: 8px;">
                 
                      <thead>
                        <tr>
                          <th style="width: 20%;">PERSONNEL</th>
                          <th style="width: 25%;">OFFICE/DEPARTMENT</th>
                          <th style="width: 25%;">DESIGNATION</th>
                          <th style="width: 15%;">STATUS</th>
                          <th style="width: 20%;">DATE OF BIRTH</th>
                          <th style="width: 10%;">AGE</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      $list_ctr=0;
                      
                      if($empStat_id>0){
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE sex='Male' AND (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') AND empStat_id='$empStat_id' ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }else{
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE sex='Male' AND (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }
                      
                      while($printDA_row=$printDataAge_query->fetch()){
                      
                      $list_ctr+=1;
                        
                      ?>
                      
                      <tr>
                      <td>
                      <?php
                      
                      if($printDA_row['mname']==='' OR $printDA_row['mname']==='-'){
                        $final_mname='';
                      }else{
                        $final_mname=substr($printDA_row['mname'], 0,1).". ";
                      }
                                    
                            
                      if($printDA_row['suffix']=="-")
                      {
                                    
                        echo $list_ctr.'. '.$printDA_row['lname'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      }else{
                                        
                        echo $list_ctr.'. '.$printDA_row['lname']." ".$printDA_row['suffix'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      } ?>
                      </td>
                      <td>
                      <?php
                      
                      
                      $emp_stat_query2 = $conn->query("SELECT dept_office_name from dept_offices WHERE do_id='$printDA_row[do_id]'");
                      $es_row2=$emp_stat_query2->fetch();
                    
                      echo $es_row2['dept_office_name'];
                      
                      ?>
                      
                      </td><td>
                      <?php
                      
                      
                      $emp_stat_query1 = $conn->query("SELECT des_name from designation WHERE des_id='$printDA_row[des_id]'");
                      $es_row1=$emp_stat_query1->fetch();
                     
                      echo $es_row1['des_name'];
                      
                      ?>
                      
                      </td>
                      <td>
                      <?php
                      
                     
                      $empStat_query = $conn->query("SELECT * FROM emp_status WHERE empStat_id='$printDA_row[empStat_id]'") or die(mysql_error());
                      $empStat_row = $empStat_query->fetch(); 
                     
                      echo $empStat_row['emp_stat_name'];
                      
                      ?>
                      
                      </td>
                      
                      <td><?php echo $printDA_row['bdMM']; ?>/<?php echo $printDA_row['bdDD']; ?>/<?php echo $printDA_row['bdYYYY']; ?></td>
                      
                      <td>
                      <?php
                      if($printDA_row['age']==0){ ?>
                        Set Up Date of Birth
                      <?php }else{ echo $printDA_row['age']; } ?>
                      
                      </td>
                      </tr>
                    
                      <?php } ?>
                      </tbody>
                      
                 </table>
               
                </div>
                </div>
                
                <?php include('footer_print.php'); ?>
                
                <div class="pb" style="margin-top: 24px;"></div>
                
                <div class="row">
                <div class="col-lg-12">
                
                <?php include('header_print_letterHead.php'); ?>
                    
                <center>
                <h3 style="font-weight: bold;">FEMALE PERSONNELS AGE with DATE OF BIRTH</h3><h4><?php echo 'Ages '.$ageFrom.' - '.$ageTo; ?></h4>
                </center>
                
                <table style="width:99%; margin: 8px;">
                 
                      <thead>
                        <tr>
                          <th style="width: 20%;">PERSONNEL</th>
                          <th style="width: 25%;">OFFICE/DEPARTMENT</th>
                          <th style="width: 25%;">DESIGNATION</th>
                          <th style="width: 15%;">STATUS</th>
                          <th style="width: 20%;">DATE OF BIRTH</th>
                          <th style="width: 10%;">AGE</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      $list_ctr=0;
                      
                      if($empStat_id>0){
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE sex='Female' AND (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') AND empStat_id='$empStat_id' ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }else{
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE sex='Female' AND (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }
                       
                      while($printDA_row=$printDataAge_query->fetch()){
                      
                      $list_ctr+=1;
                      
                      ?>
                      
                      <tr>
                      <td>
                      <?php
                      
                      if($printDA_row['mname']==='' OR $printDA_row['mname']==='-'){
                        $final_mname='';
                      }else{
                        $final_mname=substr($printDA_row['mname'], 0,1).". ";
                      }
                                    
                            
                      if($printDA_row['suffix']=="-")
                      {
                                    
                        echo $list_ctr.'. '.$printDA_row['lname'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      }else{
                                        
                        echo $list_ctr.'. '.$printDA_row['lname']." ".$printDA_row['suffix'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      } ?>
                      </td>
                      <td>
                      <?php
                      
                      $emp_stat_query2 = $conn->query("SELECT dept_office_name from dept_offices WHERE do_id='$printDA_row[do_id]'");
                      $es_row2=$emp_stat_query2->fetch();
                
                     
                      echo $es_row2['dept_office_name'];
                      
                      ?>
                      
                      </td>
                      <td>
                      <?php
                      
                      
                      $emp_stat_query1 = $conn->query("SELECT des_name from designation WHERE des_id='$printDA_row[des_id]'");
                      $es_row1=$emp_stat_query1->fetch();
                 
                     
                      echo $es_row1['des_name'];
                      
                      ?>
                      
                      </td>
                      <td>
                      <?php
                      
                      $empStat_query = $conn->query("SELECT * FROM emp_status WHERE empStat_id='$printDA_row[empStat_id]'") or die(mysql_error());
                      $empStat_row = $empStat_query->fetch(); 
                     
                      echo $empStat_row['emp_stat_name'];
                      
                      ?>
                      
                      </td>
                      
                      <td><?php echo $printDA_row['bdMM']; ?>/<?php echo $printDA_row['bdDD']; ?>/<?php echo $printDA_row['bdYYYY']; ?></td>
                      
                      <td>
                      <?php
                      if($printDA_row['age']==0){ ?>
                        Set Up Date of Birth
                      <?php }else{ echo $printDA_row['age']; } ?>
                      
                      </td>
                      </tr>
                    
                      <?php } ?>
                      </tbody>
                      
                 </table>
                 
                 </div>
                 </div>
                <?php include('footer_print.php'); ?>
                    <?php } ?>
                    <!-- END MALE-FEMALE LIST --><!-- END MALE-FEMALE LIST -->
                    
                    
                    <!-- ALL-MIXED LIST --><!-- ALL-MIXED LIST -->
                    <?php if($_GET['print_output']==='All-Mixed'){ ?>
                    <div class="row">
                    <div class="col-lg-12">
                    
                    <?php include('header_print_letterHead.php'); ?>
                    
                    <center>
                    <h3 style="font-weight: bold;">PERSONNELS AGE with DATE OF BIRTH</h3><h4><?php echo 'Ages '.$ageFrom.' - '.$ageTo; ?></h4>
                    </center>
                    
                    <table style="width:99%; margin: 8px;">
                 
                      <thead>
                        <tr>
                          <th style="width: 20%;">PERSONNEL</th>
                          <th style="width: 25%;">OFFICE/DEPARTMENT</th>
                          <th style="width: 25%;">DESIGNATION</th>
                          <th style="width: 15%;">STATUS</th>
                          <th style="width: 20%;">DATE OF BIRTH</th>
                          <th style="width: 10%;">AGE</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      $list_ctr=0;
                      
                      if($empStat_id>0){
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') AND empStat_id='$empStat_id' ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }else{
                        
                        $printDataAge_query = $conn->query("SELECT personnel_id, lname, fname, mname, suffix, age, do_id, des_id, empStat_id, bdMM, bdDD, bdYYYY FROM personnels WHERE (age BETWEEN '$ageFrom' AND '$ageTo') AND (separation_date='' OR separation_date='  /  /    ') ORDER BY age, lname, fname ASC") or die(mysql_error());
                      
                      }
                   
                      while($printDA_row=$printDataAge_query->fetch()){
                      
                      $list_ctr+=1;
                      
                      ?>
                      
                      <tr>
                      <td>
                      <?php
                      
                      if($printDA_row['mname']==='' OR $printDA_row['mname']==='-'){
                        $final_mname='';
                      }else{
                        $final_mname=substr($printDA_row['mname'], 0,1).". ";
                      }
                                    
                            
                      if($printDA_row['suffix']=="-")
                      {
                                    
                        echo $list_ctr.'. '.$printDA_row['lname'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      }else{
                                        
                        echo $list_ctr.'. '.$printDA_row['lname']." ".$printDA_row['suffix'].', '.$printDA_row['fname']." ".$final_mname;
                                    
                      } ?>
                      </td>
                      <td>
                      <?php
                      
                                         
                      
                      $emp_stat_query2 = $conn->query("SELECT dept_office_name from dept_offices WHERE do_id='$printDA_row[do_id]'");
                      $es_row2=$emp_stat_query2->fetch();
                      
                     
                      echo $es_row2['dept_office_name'];
                      
                      ?>
                      
                      </td> 
                      <td>
                      <?php
                      
                      
                      $emp_stat_query1 = $conn->query("SELECT des_name from designation WHERE des_id='$printDA_row[des_id]'");
                      $es_row1=$emp_stat_query1->fetch();
                      
                      
                      echo $es_row1['des_name'];
                      
                      ?>
                      
                      </td>
                      <td>
                      <?php
                      
                      
                      $emp_stat_query1 = $conn->query("SELECT des_name from designation WHERE des_id='$printDA_row[des_id]'");
                      $es_row1=$emp_stat_query1->fetch();
                      
                      $emp_stat_query2 = $conn->query("SELECT dept_office_name from dept_offices WHERE do_id='$printDA_row[do_id]'");
                      $es_row2=$emp_stat_query2->fetch();
                      
                      $empStat_query = $conn->query("SELECT * FROM emp_status WHERE empStat_id='$printDA_row[empStat_id]'") or die(mysql_error());
                      $empStat_row = $empStat_query->fetch(); 
                     
                      echo $empStat_row['emp_stat_name'];
                      
                      ?>
                      
                      </td>
                      
                      <td><?php echo $printDA_row['bdMM']; ?>/<?php echo $printDA_row['bdDD']; ?>/<?php echo $printDA_row['bdYYYY']; ?></td>
                      
                      <td>
                      <?php
                      if($printDA_row['age']==0){ ?>
                        Set Up Date of Birth
                      <?php }else{ echo $printDA_row['age']; } ?>
                      
                      </td>
                      </tr>
                    
                      <?php } ?>
                      </tbody>
                      
                 </table>
               
                </div>
                </div>
                
                <?php include('footer_print.php'); ?>
                    <?php } ?>
                    <!-- END MALE LIST --><!-- END MALE LIST -->
                    
                    

</body>
</html>