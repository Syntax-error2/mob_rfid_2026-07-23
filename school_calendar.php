<!DOCTYPE html>
<html>

  <?php
  
  include('session.php');
  include('header.php');
  
  ?>

         <?php
        if(isset($_POST['selectYear'])){
        
        $selected_yyyy=$_GET['yyyy']; 
        ?>
        
        <script>
        window.location='school_calendar.php?mm=<?php echo $_GET['mm']; ?>&yyyy=<?php echo $_POST['selected_yyyy']; ?>'
        </script>
       
        <?php }else{
            
        $selected_yyyy=$_GET['yyyy'];
        
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
            <li class="breadcrumb-item active">Municipal Calendar</li>
          </ul>
        </div>
      </div>
      
      
      
      
      <!-- SHS Programs section Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
            
                <form method="POST">
                <table>
                <tr>
                <td style="border: none;">
                <select name="selected_yyyy" class="form-control">
                <option><?php echo $selected_yyyy; ?></option>
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
                <option>2023</option>
                <option>2024</option>
                <option>2025</option>
                <option>2026</option>
                <option>2027</option>
                <option>2028</option>
                <option>2029</option>
                <option>2030</option>
                </select>
                </td>
                
                <td style="border: none;">
                <button name="selectYear" class="btn btn-success">Browse Calendar Year</button>
                </td>
                </tr>
                </table>
                </form>
                
                <hr />
                
                <div class="tab">
                
                <?php if($_GET['mm']=="01"){ ?>
                <a href="school_calendar.php?mm=01&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Jan</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=01&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Jan</a>
                <?php } ?>
                
                <?php if($_GET['mm']=="02"){ ?>
                <a href="school_calendar.php?mm=02&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Feb</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=02&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Feb</a>
                <?php } ?>
                
                
                <?php if($_GET['mm']=="03"){ ?>
                <a href="school_calendar.php?mm=03&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Mar</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=03&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Mar</a>
                <?php } ?>
                
                <?php if($_GET['mm']=="04"){ ?>
                <a href="school_calendar.php?mm=04&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Apr</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=04&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Apr</a>
                <?php } ?>
                
                <?php if($_GET['mm']=="05"){ ?>
                <a href="school_calendar.php?mm=05&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">May</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=05&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">May</a>
                <?php } ?>
                
                <?php if($_GET['mm']=="06"){ ?>
                <a href="school_calendar.php?mm=06&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Jun</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=06&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Jun</a>
                <?php } ?>
                
                <?php if($_GET['mm']=="07"){ ?>
                <a href="school_calendar.php?mm=07&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Jul</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=07&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Jul</a>
                <?php } ?>
                
                
                <?php if($_GET['mm']=="08"){ ?>
                <a href="school_calendar.php?mm=08&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Aug</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=08&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Aug</a>
                <?php } ?>
                
                
                <?php if($_GET['mm']=="09"){ ?>
                <a href="school_calendar.php?mm=09&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Sep</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=09&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Sep</a>
                <?php } ?>
                
                
                <?php if($_GET['mm']=="10"){ ?>
                <a href="school_calendar.php?mm=10&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Oct</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=10&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Oct</a>
                <?php } ?>
                
                <?php if($_GET['mm']=="11"){ ?>
                <a href="school_calendar.php?mm=11&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Nov</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=11&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Nov</a>
                <?php } ?>
                
                
                <?php if($_GET['mm']=="12"){ ?>
                <a href="school_calendar.php?mm=12&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks active" style="font-weight: bolder;">Dec</a>
                <?php }else{?>
                <a href="school_calendar.php?mm=12&yyyy=<?php echo $_GET['yyyy']; ?>" class="tablinks">Dec</a>
                <?php } ?>
                
                <?php
                
                $mm=$_GET['mm'];
                if($mm==1)
                {
                    $mmWords="January";
                }
                
                if($mm==2)
                {
                    $mmWords="February";
                }
                
                
                if($mm==3)
                {
                    $mmWords="March";
                }
                
                
                if($mm==4)
                {
                    $mmWords="April";
                }
                
                
                if($mm==5)
                {
                    $mmWords="May";
                }
                
                
                if($mm==6)
                {
                    $mmWords="June";
                }
                
                
                
                if($mm==7)
                {
                    $mmWords="July";
                }
                
                
                if($mm==8)
                {
                    $mmWords="August";
                }
                
                
                if($mm==9)
                {
                    $mmWords="September";
                }
                
                
                if($mm==10)
                {
                    $mmWords="October";
                }
                
                
                if($mm==11)
                {
                    $mmWords="November";
                }
                
                
                if($mm==12)
                {
                    $mmWords="December";
                }
                
                ?>
                </div>
                
              <!-- kinder 1     -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display">
                  
                  <a style="color: white !important;" data-toggle="modal" data-target="#addSubjKinder" href="#addSubjKinder" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
                  
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><strong style="font-weight: bolder;">Activities for the Month of <?php echo $mmWords; ?> - <?php echo $_GET['yyyy']; ?></strong></a>
                  
                  </h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><i class="fa fa-angle-down"></i></a>
                </div>
                
                <div id="updates-boxKinder" role="tabpanel" class="collapse show">
                  
                    <div class="col-lg-12">
                    <div class="table-responsive" style="margin-top: 12px;">
                    <table id="" class="display" style="width:100%">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Type</th>
                          <th>Add to work days</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                            <?php
                            $subjK_ctr=0;
                 
                                $calendar_query = $conn->query("select * FROM activity_calendar WHERE actMM='$_GET[mm]' AND actYYYY='$selected_yyyy' ORDER BY actDD, activity_id ASC") or die(mysql_error());
                                while ($cal_row = $calendar_query->fetch()) 
                                { 
                                    
                                $activity_id=$cal_row['activity_id'];
                                ?>
           
                        <tr>
                    
                          <td><?php echo $cal_row['completeDate']; ?></td>
                          <td><?php echo $cal_row['event_title']; ?></td>
                          <td><?php echo $cal_row['event_description']; ?></td>
                          <td><?php echo $cal_row['act_type']; ?></td>
                          
                          <td>
                          <?php if($cal_row['status']==='Add as working day') { echo 'YES'; }else{ echo 'NO'; } ?></td>
                           
                          <td>
                          
                          <a style="color: white !important;" data-toggle="modal" data-target="#editActivity<?php echo $activity_id; ?>" href="#editTeacher<?php echo $activity_id; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                          <a style="color: white !important;" data-toggle="modal" data-target="#deleteActivity<?php echo $activity_id; ?>" href="#deleteTeacher<?php echo $activity_id; ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
                          
                          </td>
                        </tr>
                 
                <!-- delete activity Modal -->
                  <div id="deleteActivity<?php echo $activity_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                      <form action="save_add_activity.php?mm=<?php echo $_GET['mm']; ?>&yyyy=<?php echo $_GET['yyyy']; ?>" method="POST">
                      <input name="activity_id" value="<?php echo $activity_id; ?>" type="hidden" />
                      
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Delete Activity</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                        </div>
                        
                        <div class="modal-body">
                           
                        <h4>Are you sure you want to delete activity:<br /><br /><?php echo $cal_row['event_title'].'?'; ?></h4>
                        <small><?php echo $cal_row['event_description'].' [ '.$cal_row['completeDate'].' ]'; ?></small> 
                        </div>
                        
                        <div class="modal-footer">
                          <a style="color: white;" href="" data-dismiss="modal" class="btn btn-primary">No</a>
                          <button name="deleteActivity" type="submit" class="btn btn-danger">Yes</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- end delete activity Modal -->
                  
                        
            
            <!-- edit activity Modal -->
                  <div id="editActivity<?php echo $activity_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Edit Activity</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                        </div>
                       
                        
                        <form action="save_add_activity.php?mm=<?php echo $_GET['mm']; ?>&yyyy=<?php echo $_GET['yyyy']; ?>&activity_id=<?php echo $activity_id; ?>" method="POST">
                        <div class="modal-body">
                        
                        
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <input value="<?php echo $cal_row['event_title']; ?>" name="event_title" type="text" class="form-control">
                                 <small>Activity / Event Title</small>
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <input name="event_description" value="<?php echo $cal_row['event_description']; ?>" type="text" class="form-control"> 
                                 <small>Activity / Event Description</small>
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <input name="activity_date" value="<?php echo $cal_row['completeDate']; ?>" type="date" class="form-control" required="true" />
                                <small>Date of Activity</small>
                              </div>
                            </div>
                            
                            <div class="form-group row">
                   
                              <div class="col-sm-12">
                                <div class="row">
                                   
                                  <div class="col-md-12">
                                    <select name="act_type" class="form-control">
                                    <option><?php echo $cal_row['act_type']; ?></option>
                                    <option>-</option>
                                    <option>Legal Holiday</option>
                                    <option>Special Non-Working Holiday</option>
                                    <option>Special Working Holiday</option>
                                    <option>Municipal Activity</option>
                                    <option>Work Suspension</option>
                                    </select>
                                    <small class="form-text">Type</small>
                                  </div>
                                  
                                  <div class="col-md-12">
                                    <select name="status" class="form-control">
                                    <option><?php echo $cal_row['status']; ?></option>
                                    <option>-</option>
                                    <option>Add as working day</option>
                                    </select>
                                    <small class="form-text">Status</small>
                                  </div>
                         
                                  
                                </div>
                              </div>
                            </div>
                            
                            
                             
                        </div>
                        
                        <div class="modal-footer">
                          <a href="" data-dismiss="modal" class="btn btn-secondary" style="color: white;">Cancel</a>
                          <button name="editActivity" type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- end edit activity Modal -->
                  
                  
                  
                      
                            <?php } ?>
                       
                      </tbody>
                    </table>
                    </div>
                    </div>
                   
                </div>
              </div>
              <!-- kinder End-->
             
            </div>
            
          </div>
        </div>
        
        <?php include('add_activity_modal.php'); ?>
                  
      </section> 
      
      <?php include('footer.php'); ?>
      
    </div>
    
    <?php include('scripts_files.php'); ?>

 
    
  </body>
</html>