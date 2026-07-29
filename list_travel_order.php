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
                <li class="breadcrumb-item active">Employee's Travel Order Bulletin</li>
              </ul>
            </div>
          </div>      
 
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
      
      <?php include('add_travel_modal.php'); ?>
      
            <?php
            
            $opt_query = $conn->query("SELECT DISTINCT travel_date FROM personnel_official_travel_logs ORDER BY travel_date DESC") or die(mysql_error());
 
            ?>
            
      
            <!-- TRAVEL ORDER BULLETIN    -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  
                  <form method="POST">
                  <table>
                  <tr>
                  
                  <td style="border: none; background-color: white;">
                  <h4>
                  
                  <a title="Add travel order..." style="color: white !important; margin-top: 3px;" data-toggle="modal" data-target="#addTravelOrder" href="#" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                  
                  LIST OF TRAVEL ORDER
                  
                  </h4>
                  </td>
                  
                  <td style="border: none; background-color: white;">
                  <select name="reportDate" class="form-control">
                  <option><?php echo $filterDate; ?></option>
                  
                  <?php if(date('m/d/Y')===$filterDate){ ?>
                  
                  <?php }else{ ?>
                  
                  <option><?php echo date('m/d/Y'); ?></option>
                  
                  <?php } ?>
                  
                  <?php
                  $currentDate="";
                  $opt_query = $conn->query("SELECT DISTINCT logDate FROM personnel_logs WHERE remarks='SEMINAR' OR remarks='OFFICIAL BUSINESS TRIP' ORDER BY logDate DESC") or die(mysql_error());
                  while ($opt_row = $opt_query->fetch()) 
                  { 
                    if($filterDate==$opt_row['logDate']){
                        
                    }else{ ?>
                    
                    <option><?php echo $opt_row['logDate']; ?></option>
                    
                    <?php
                    
                    $currentDate=$opt_row['logDate'];
                    
                    } } ?>
                  </select>
                  </td>
                  
                  <td style="border: none; background-color: white;">
                  <button name="filterDate" class="btn btn-primary" title="Filter Date"><i class="fa fa-filter"></i></button>

                  <a class="btn btn-info" style="color: white;" data-toggle="modal" data-target="#print_monthly_TO" title="Print Travel Order list..."><i class="fa fa-print"></i></a>
                  </td>
                  </tr>
                  </table>
                  </form>
                  
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxContacts" aria-expanded="true" aria-controls="updates-boxContacts"><i class="fa fa-angle-down"></i></a>
                
                </div>
                
                <div id="updates-boxContacts" role="tabpanel" class="collapse show">
                
                <div class="col-lg-12">
                <div class="table-responsive" style="margin-top: 12px;">
                <table id="" class="display" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>TO CODE<br /><small>Travel Date</small></th>
                          <th>PERSONNEL</th>
                          <th>DETAILS</th>
                          <th></th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      
                      <?php
                      $row_ctr=0;
                               
                      $new_clearance_query = $conn->query("SELECT DISTINCT 
                      travel_code, 
                      travel_date,
                      purpose,
                      description,
                      location,
                      travel_type  FROM personnel_official_travel_logs WHERE travel_date LIKE '%$filterDate%' ORDER BY travel_log_id ASC");
                      while($nc_row = $new_clearance_query->fetch()){
                      $row_ctr=$row_ctr+1;
                      
                      ?>
                      
                        <tr>
                          <td><?php echo $row_ctr; ?></td>
                          
                          <td>
                          <?php echo $nc_row['travel_code']; ?><br />
                          <small><?php echo $nc_row['travel_date']; ?></small>
                          </td>
                          
                          <td>
                          <?php
                          $pi_query = $conn->query("SELECT personnel_id FROM personnel_official_travel_logs WHERE travel_code='$nc_row[travel_code]'");
                          while($pi_row = $pi_query->fetch())
                          {
                          
                          $studData_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$pi_row[personnel_id]'") or die(mysql_error());
                          $sd_row=$studData_query->fetch();
                          
                          if($sd_row['suffix']=="-")
                          {
                            echo $p_name=$sd_row['fname']." ".substr($sd_row['mname'], 0,1).". ".$sd_row['lname'];
                          
                          }else{
                            
                            echo $p_name=$sd_row['fname']." ".substr($sd_row['mname'], 0,1).". ".$sd_row['lname']." ".$sd_row['suffix'];
                          
                          } echo "<br />"; } ?>
                          
                          </td>
                          
                          <td>
                          <strong style="font-weight: bold;">PURPOSE:</strong> <?php echo $nc_row['purpose']; ?><br />
                          <strong style="font-weight: bold;">DESCRIPTION:</strong> <?php echo $nc_row['description']; ?><br />
                          <strong style="font-weight: bold;">LOCATION:</strong> <?php echo $nc_row['location']; ?><br />
                          <strong style="font-weight: bold;">TYPE:</strong> <?php echo $nc_row['travel_type']; ?>
                          </td>
                          
                          
                          <td style="width: 10px;">
                          <a title="View travel details..." style="color: white !important; margin-top: 3px;" href="list_travel_order_detailed.php?travel_code=<?php echo $nc_row['travel_code']; ?>" class="btn btn-info btn-sm">&nbsp;<i class="fa fa-info"></i>&nbsp;</a>
                          <a title="Delete data..." style="color: white !important; margin-top: 3px;" data-toggle="modal" data-target="#deleteTO<?php echo $nc_row['travel_code']; ?>" href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                          </td>
                          
                          
                        </tr>
                      
                      
                      
                       <!-- delete travel Modal -->
                          <div id="deleteTO<?php echo $nc_row['travel_code']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                              <div class="modal-content">
                              <form action="save_add_travel_leave.php?travel_code=<?php echo $nc_row['travel_code']; ?>" method="POST">
                               
                                <div class="modal-header">
                                  <h5 id="exampleModalLabel" class="modal-title">Delete Travel Order</h5>
                                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                </div>
                                
                                <div class="modal-body">
                                   
                                <h4>Are you sure you want to delete TO <?php echo $nc_row['travel_code']; ?>? </h4> <br />
                                
                                <strong style="font-weight: bold;">PURPOSE:</strong> <?php echo $nc_row['purpose']; ?><br />
                                <strong style="font-weight: bold;">DESCRIPTION:</strong> <?php echo $nc_row['description']; ?><br />
                                <strong style="font-weight: bold;">LOCATION:</strong> <?php echo $nc_row['location']; ?><br />
                                <strong style="font-weight: bold;">TYPE:</strong> <?php echo $nc_row['travel_type']; ?>
                               
                                  
                                </div>
                                
                                <div class="modal-footer">
                                  <a style="color: white;" href="" data-dismiss="modal" class="btn btn-primary">No</a>
                                  <button name="deleteTravel" type="submit" class="btn btn-danger">Yes</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- end delete travel Modal -->
                          
                      <?php }?>
                      
                      </tbody>
                      <tfoot>
                      <tr>
                          <td colspan="4">Total Files as of: <strong style="font-size: 20px;"><?php echo $filterDate; ?></strong></td>
                      
                          <td><strong style="font-size: 20px;"><?php echo $new_clearance_query->rowCount(); ?></strong></td>
                        </tr>
                      </tfoot>
                    
                    </table>
                    </div>
                    </div>
 
 
  
                </div>
              </div>
              <!-- TRAVEL ORDER BULLETIN End-->
         
              
              
                </div>
            </div>
        </div>
     </section>
     
      
      
      <?php include('print_monthly_TO_modal.php'); ?>
   
      
      <?php include('footer.php'); ?>
      
    </div>
    
    <?php include('scripts_files.php'); ?>
 
 


    
  </body>
</html>