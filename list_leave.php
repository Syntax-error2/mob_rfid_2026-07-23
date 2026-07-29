<!DOCTYPE html>
<html>

  <?php
  
   include('session.php');
   
   include('header.php'); 
   
   //include('loaderFX.php'); 
  
    $day=date("l"); //Mon-Sun
    
    if(isset($_POST['filterDate'])){
    $filterDate=$_POST['reportDate'];
     
    }else{
        
    $filterDate=date('m/d/Y');
   
    } ?>
  
  <body>
  
  <?php include('menu_sidebar.php'); ?>
  

    <div class="page">

    <?php include('navbar_header.php'); ?>
    
    
    <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li style="color: blue"><strong style="margin-right: 4px;"><?php echo $schoolName; ?> | </strong></li>
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active">Employee's Leave Data Table</li>
          </ul>
        </div>
      </div>
      
      
      
      
      <!-- SHS Programs section Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
            
             
         
         
         
          <!-- LIST LEAVE  -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display">
                  
                  
                  <form method="POST">
                  <table>
                  <tr>
                  
                  <td style="border: none; background-color: white;">
                  <h4>
                  
                  <a style="color: white !important;" data-toggle="modal" data-target="#addLeave" href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                  
                  LEAVE APPLICATION DATA TABLE
                  
                  </h4>
                  </td>
                  
                  <td style="border: none; background-color: white;">
                  
                  
                  
                  <?php if(date('Y-m-d') == $filterDate){ ?>
                  
                  <input name="reportDate" value="<?php echo $filterDate; ?>" type="date" class="form-control" />
                  
                  <?php }else{ ?>
                  
                  <input name="reportDate" value="<?php echo date('Y-m-d'); ?>" list="date_list" type="date" class="form-control" />

                  <?php } ?>
                  <datalist id="date_list">
                  <?php
                  $currentDate="";
                  $opt_query = $conn->prepare("SELECT DISTINCT logDate FROM personnel_logs WHERE remarks != :remarks_a AND remarks != :remarks_b AND remarks != :remarks_c ORDER BY logDate DESC");
                  $opt_query->execute(['remarks_a' => "", 'remarks_b' => "SEMINAR", 'remarks_c' => "OFFICIAL BUSINESS TRIP"]);
                  while ($opt_row = $opt_query->fetch()) 
                  { 
                    if($filterDate==$opt_row['logDate']){
                        
                    }else{ ?>
            
                    
                    <option><?php echo $opt_row['logDate']; ?></option>
                    
                    <?php
                    
                    $currentDate=$opt_row['logDate'];
                    
                    } } ?> 
                    </datalist>
                  </td>
                  
                  <td style="border: none; background-color: white;">
                  <button name="filterDate" class="btn btn-primary" title="Filter Date"><i class="fa fa-filter"></i></button> 
                  
                  <a class="btn btn-info" style="color: white;" data-toggle="modal" data-target="#print_monthly_TO" title="Print Travel Order list..."><i class="fa fa-print"></i></a></td>
                  </tr>
                  </table>
                  </form>
                   
                  </h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="updates-boxKinder" role="tabpanel" class="collapse show">
               
                <div class="col-lg-12">
                <div class="table-responsive" style="margin-top: 12px;">
                <table id="" class="display" style="width:100%">
                
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Applicant <br /> <small>Dept. / Office</small></th>
                          <th>Leave Type</th>
                          <th>Description</th>
                          <th>Leave Date(s) <br /> <small>Substitute</small></th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            
                            
                      <?php
                      $row_ctr=0;
                               
                      $new_clearance_query = $conn->query("SELECT * FROM leave_applicants WHERE leave_date LIKE '%$filterDate%' ORDER BY lap_id ASC");
                      while($nc_row = $new_clearance_query->fetch()){
                      $row_ctr=$row_ctr+1;
                      
                      ?>
         
           
                        <tr>
                        <td><?php echo $row_ctr; ?></td>
                          
                         <td>
                         <?php
                         $perData1_query = $conn->query("SELECT lname, fname, mname, suffix FROM personnels WHERE personnel_id='$nc_row[applicant_id]'");
                         $pd1_row=$perData1_query->fetch();
                         
                         $do_query = $conn->query("SELECT dept_office_name FROM dept_offices WHERE do_id='$nc_row[do_id]'");
                         $do_row=$do_query->fetch();
                         
                         
                         if($pd1_row['suffix']=="-")
                          {
                            $p_name=$pd1_row['fname']." ".substr($pd1_row['mname'], 0,1).". ".$pd1_row['lname'];
                          
                          }else{
                            
                            $p_name=$pd1_row['fname']." ".substr($pd1_row['mname'], 0,1).". ".$pd1_row['lname']." ".$pd1_row['suffix'];
                          }  
                          
                          
                          echo $p_name."<br /><small>".$do_row['dept_office_name']."</small>";
                         ?>
                         
                         
                         </td>
                          <td><?php echo $nc_row['leave_type']; ?></td>
                          <td><?php echo $nc_row['leave_type_desc']; ?></td>
                          <td><?php echo $nc_row['leave_date']; ?><br /> <small>
                          <?php
                         $perData1_query = $conn->query("SELECT lname, fname, mname, suffix FROM personnels WHERE personnel_id='$nc_row[substitute_id]'");
                         $pd1_row=$perData1_query->fetch();
                          
                         if($pd1_row['suffix']=="-")
                          {
                            $p_name=$pd1_row['fname']." ".substr($pd1_row['mname'], 0,1).". ".$pd1_row['lname'];
                          
                          }else{
                            
                            $p_name=$pd1_row['fname']." ".substr($pd1_row['mname'], 0,1).". ".$pd1_row['lname']." ".$pd1_row['suffix'];
                          }  
                          
                          
                          echo $p_name;
                         ?>
                          
                          
                          </small></td>

                          <td>
                          <a style="color: white !important;" data-toggle="modal" data-target="#deleteLeave<?php echo $nc_row['lap_id']; ?>" href="#" class="btn btn-danger"><i class="fa fa-times"></i></a>
                          </td>
                        </tr>
                        
                        
                         <!-- delete travel Modal -->
                          <div id="deleteLeave<?php echo $nc_row['lap_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                              <div class="modal-content">
                              <form action="save_add_travel_leave.php?lap_id=<?php echo $nc_row['lap_id']; ?>" method="POST">
                               
                                <div class="modal-header">
                                  <h5 id="exampleModalLabel" class="modal-title">Delete Leave Entry</h5>
                                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                </div>
                                
                                <div class="modal-body">
                                   
                                <h4>Are you sure you want to delete Leave Entry? </h4> <br />
                                
                                <strong style="font-weight: bold;">TYPE:</strong> <?php echo $nc_row['leave_type']; ?><br />
                                <strong style="font-weight: bold;">DESCRIPTION:</strong> <?php echo $nc_row['leave_type_desc']; ?>
                               
                                  
                                </div>
                                
                                <div class="modal-footer">
                                  <a style="color: white;" href="" data-dismiss="modal" class="btn btn-primary">No</a>
                                  <button name="deleteLeave" type="submit" class="btn btn-danger">Yes</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- end delete travel Modal -->
                          
                    
                  
                            <?php } ?>
                       
                      </tbody>
                    </table>
                    </div>
                    </div>
                    
                </div>
              </div>
              <!-- LIST LEAVE End-->
 
 
            </div>
            
          </div>
        </div>
         
                          
        <?php include('add_leave_modal.php'); ?>
                  
      </section>
      
 
      <?php include('footer.php'); ?>
      
    </div>
    
    <?php include('scripts_files.php'); ?>
    
  </body>
</html>