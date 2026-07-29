<!DOCTYPE html>
<html>

  <?php
  
   include('session.php');
   
   include('header.php');
   
   ?>

  <?php
  
 
  $get_dept=$_GET['dept'];
  
  if(isset($_POST['filterPosition'])){
  $filterPosition=$_POST['filter'];
  }else{
  $filterPosition='All';
  } ?>
    
    
  <body>
  
  <?php include('menu_sidebar.php'); ?>
  

    <div class="page">

    <?php include('navbar_header.php'); ?>
    
    <?php
    $staff_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$_GET[personnel_id]'") or die(mysql_error());
    $staff_row = $staff_query->fetch();
    
    $emp_stat_query5 = $conn->query("SELECT * from shifts WHERE shift_id='$staff_row[shift_id]'");
    $es_row5=$emp_stat_query5->fetch();
    ?>
    <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li style="color: blue"><strong style="margin-right: 4px;"><?php echo $schoolName; ?> | </strong></li>
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <?php if($session_access==='Administrator') { ?>
            <li class="breadcrumb-item"><a href="list_personnel.php?dept=<?php echo $_GET['dept']; ?>">List of Personnel</a></li>
            <?php } ?>
            <li class="breadcrumb-item active">Personal Information</li>
          </ul>
        </div>
      </div>
      
      
      
      
      <!-- SHS Programs section Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
            
            
            <?php include('encode_daily_log_modal.php'); ?>
            <?php include('restDay_modal.php'); ?>
            <?php include('updateMonthlyLog_modal.php'); ?>
            <?php include('print_monthly_attendance_modal_csf48.php'); ?>
            <?php include('print_monthly_attendance_modal.php'); ?>
            <?php include('print_monthly_LV_modal.php'); ?>
                       
            
              <!-- kinder 1     -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display">
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder">
                  <h4>
                  <img src="personnelImg/<?php echo $staff_row['img']; ?>" width="50" height="50" class="img-fluid" style="margin-bottom: 8px; border: 2px solid green;" />
                                    <?php
                          
                 
                                    if($staff_row['suffix']=="-")
                                    {
                                        
                                    echo $staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname'];
                                    
                                    }else{
                                        
                                    echo $staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname']." ".$staff_row['suffix'];
                                    
                                    } ?> <small style="<?php if($es_row5['type']==='Regular Shift'){ ?> color: green; <?php }elseif($es_row5['type']==='Night Shift'){ ?> color: blue; <?php }elseif($es_row5['type']==='24 Hours Shift'){ ?> color: brown; <?php }elseif($es_row5['type']==='Open Time'){ ?> color: purple; <?php }else{ ?> color: red; <?php } ?>">( <?php echo $es_row5['shift_name']; ?> - <?php echo $es_row5['type']; ?> )</small>
                                    
                  </h4>
                  </a>
                  </h2>
                  
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><i class="fa fa-angle-down"></i></a>
                </div>
                
                <div id="updates-boxKinder" role="tabpanel" class="collapse show">
                
                
                
                <div class="col-lg-12" style="margin-top: 12px;">
                
                <a title="Encode log..." style="color: black !important; margin-top: 3px;" data-toggle="modal" data-target="#encodeDL<?php echo $staff_row['RFTag_id']; ?>" href="#" class="btn btn-warning btn-sm"><i class="fa fa-clock-o"></i> ENCODE DAILY LOG</a> 
                
                <a title="Rest day settings..." style="color: black !important; margin-top: 3px;" data-toggle="modal" data-target="#restDaySetup<?php echo $staff_row['RFTag_id']; ?>" href="#" class="btn btn-info btn-sm"><i class="fa fa-heartbeat"></i> SET REST DAY</a> 
                
    
                <button data-toggle="dropdown" type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" style="margin-top: 3px;"><i class="fa fa-print"></i>  REPORTS <i class="caret"></i></button>
                            
                <div class="dropdown-menu">
                            
                <a title="Print Civil Service Form 48..." data-toggle="modal" data-target="#print_monthly_attendance_csf48<?php echo $staff_row['RFTag_id']; ?>" href="#" class="dropdown-item"><i class="fa fa-print"></i> CSForm 48</a>
                <a title="Print detailed DTR..." data-toggle="modal" data-target="#print_monthly_attendance<?php echo $staff_row['RFTag_id']; ?>" href="#" class="dropdown-item"><i class="fa fa-print"></i> Detailed DTR <small>(Monthly)</small></a>
                <a title="Print Log Validations history..." data-toggle="modal" data-target="#print_monthly_LV<?php echo $staff_row['RFTag_id']; ?>" href="#" class="dropdown-item"><i class="fa fa-image"></i> Log Validation History <small>(Monthly)</small></a>
                
                </div>
                
                </div>
                
                
                
                <div class="col-lg-12" style="margin-top: 12px;">
                <a class="btn btn-primary" style="color: white; font-weight: bold;" href="list_personnel_individual_details.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>"> PERSONAL INFORMATION</a>
                <a class="btn btn-outline-primary" href="list_personnel_individual_details_EB.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>"> EDUCATIONAL BACKGROUND</a>
                <a class="btn btn-outline-primary" href="list_personnel_individual_details_SA.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>"> SEMINARS ATTENDED</a> 
                <a class="btn btn-outline-primary" href="list_personnel_individual_details_SR.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>"> SERVICE RECORD</a>
                <a class="btn btn-info" style="color: white;" title="Print personnel data sheet..." href="printPersonnelDataSheet_detailed.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>&pDataReportType=PERSONAL INFORMATION" target="_blank"><i class="fa fa-print"></i></a>  
                </div>      
                
                <div class="col-lg-12" style="margin-top: 12px;">
                <a class="btn btn-primary" style="color: white;" href="edit_completePersonnelData.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>"><i class="fa fa-pencil"></i> PERSONAL INFORMATION</a>
                <a class="btn btn-info" style="color: white;" title="Print personal information..." href="printPersonnelDataSheet_detailed_PI.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>&pDataReportType=PERSONAL INFORMATION" target="_blank"><i class="fa fa-print"></i></a>
                </div>
                   
                    <table class="table table-bordered" style="margin: 8px; width: 98%;">
                      
                      <tbody>
                      
                        <tr>
                        <td>
                          
                          <table style="width: 100%; margin: 8px;">
                          <tr>
                           
                          <td style="padding: 0px; border: none; font-size: medium; width: 25%;"><?php echo $staff_row['fname']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium; width: 25%;"><?php echo $staff_row['mname']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium; width: 25%;"><?php echo $staff_row['lname']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium; width: 25%;"><?php echo $staff_row['suffix']; ?></td>
                          </tr>
                          
                          <tr>
                          <td style="font-size: smaller; padding: 0px; border: none;">First Name</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Middle Name</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Last Name</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Suffix</td>
                          </tr>
                          
                          <tr><td colspan="4" style="font-size: smaller; padding: 8px; border: none;"></td></tr>
                          
                          <tr>
                        
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['age']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['sex']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['marital_status']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"></td>
                          </tr>
                          
                          <tr>
                          <td style="font-size: smaller; padding: 0px; border: none;">Age</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Sex</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Marital Status</td>
                          <td style="font-size: smaller; padding: 0px; border: none;"></td>
                          </tr>
                          
                          <tr><td colspan="4" style="font-size: smaller; padding: 8px; border: none;"></td></tr>
                          
                          <tr>
                        
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['bdMM'].'/'.$staff_row['bdDD'].'/'.$staff_row['bdYYYY']; ?></td>
                          <td colspan="3" style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['birth_place']; ?></td>
                          
                          </tr>
                          
                          <tr>
                          <td style="font-size: smaller; padding: 0px; border: none;">Date of Birth</td>
                          <td colspan="3" style="font-size: smaller; padding: 0px; border: none;">Place of Birth</td>
                          </tr>
                          
                          
                          <tr><td colspan="4" style="font-size: smaller; padding: 8px; border: none;"></td></tr>
                          
                          <tr>
                          <td colspan="2" style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['address']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['email']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['personal_pnum']; ?></td>
                          </tr> 
                          
                          <tr>
                          <td colspan="2" style="font-size: smaller; padding: 0px; border: none;">Home Address</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Email Address</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Contact Number</td>
                          </tr>
                          
                          <tr><td colspan="4" style="font-size: smaller; padding: 8px; border: none;"></td></tr>
                          
                          <tr>
                           
                          <td colspan="2" style="padding: 0px; border: none; font-size: medium; width: 25%;"><?php echo $staff_row['conPerson_fname'].' '.$staff_row['conPerson_mname'].' '.$staff_row['conPerson_lname']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium; width: 25%;"><?php echo $staff_row['conPerson_relationship']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium; width: 25%;"><?php echo $staff_row['emergency_pnum']; ?></td>
               
                          </tr>
                          <tr>
                          <td colspan="2" style="font-size: smaller; padding: 0px; border: none;">Contact Person's Fullname</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Relationship</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Contact #</td>
                          </tr>
                          
                          <tr><td colspan="4" style="font-size: smaller; padding: 8px; border: none;"></td></tr>
                          
                          <?php
                           
                           $emp_stat_query = $conn->query("SELECT * from dept_offices WHERE do_id='$staff_row[do_id]'");
                           $es_row=$emp_stat_query->fetch();
                           
                           $emp_stat_query2 = $conn->query("SELECT * from designation WHERE des_id='$staff_row[des_id]'");
                           $es_row2=$emp_stat_query2->fetch();
                           
                           $emp_stat_query4 = $conn->query("SELECT * from emp_status WHERE empStat_id='$staff_row[empStat_id]'");
                           $es_row4=$emp_stat_query4->fetch();
                           
                           $salary_query = $conn->query("SELECT salary from service_record WHERE personnel_id='$_GET[personnel_id]' ORDER BY sr_id DESC");
                           $salary_row=$salary_query->fetch();
                           
                           /*$serv_date_from_query = $conn->query("SELECT serv_date_from from service_record WHERE personnel_id='$_GET[personnel_id]' ORDER BY sr_id DESC");
                           $serv_date_from_row=$serv_date_from_query->fetch(); */
                           
                           ?>
                           
                          <tr>
                        
                          <td colspan="2" style="padding: 0px; border: none; font-size: medium;"><?php echo $es_row['dept_office_name']; ?></td>
                          <td colspan="2" style="padding: 0px; border: none; font-size: medium;"><?php echo $es_row2['des_name']; ?></td>
                          </tr>
                          
                          <tr>
                          <td colspan="2" style="font-size: smaller; padding: 0px; border: none;">Office / Department</td>
                          <td colspan="2" style="font-size: smaller; padding: 0px; border: none;">Designation</td>
                          </tr>
                          
                          
                          <tr><td colspan="4" style="font-size: smaller; padding: 8px; border: none;"></td></tr>
                          
                          <tr>
                          
                          <td colspan="2" style="padding: 0px; border: none; font-size: medium;">
                          <strong style="font-weight: bolder;">Salary Grade <?php echo $staff_row['sal_grade']; ?></strong> / <strong style="font-weight: bolder;">Step <?php echo $staff_row['sal_step']; ?></strong> | <strong style="font-weight: bolder;"> Level <?php echo $staff_row['sal_level']; ?></strong> | <strong style="font-weight: bolder;"><?php echo $staff_row['rate_per_day']; ?></strong>
                          </td>
                          
                          <td colspan="2" style="padding: 0px; border: none; font-size: medium;"><strong style="font-weight: bolder;"><?php echo $es_row4['emp_stat_name']; ?></strong> | <strong style="font-weight: bolder;"><?php echo $es_row4['position_class']; ?></strong> | <strong style="font-weight: bolder;"><?php echo $es_row4['status']; ?></strong></td>
                          </tr>
                          
                          <tr>
                          <td colspan="2" style="font-size: smaller; padding: 0px; border: none;">Salary Grade / Step | Level | Rate/Day</td>
                          <td colspan="2" style="font-size: smaller; padding: 0px; border: none;">Status of Appointment | Class | Type</td>
                          </tr>
                          
                          
                          <tr><td colspan="4" style="font-size: smaller; padding: 8px; border: none;"></td></tr>
                          
                          
                          <tr>
                        
                         
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['eligibility']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['plantilla_num']; ?></td>
                          <td colspan="2" style="padding: 0px; border: none; font-size: medium;">
                          
                          <?php
                          if($es_row4['status'] == "Active"){
                            echo $staff_row['appointment_date'].' - Present';
                          }else{
                            echo $staff_row['appointment_date'].' - '.$staff_row['separation_date'];
                          }
                          ?>
                           
                           <?php
                            if($staff_row['appointment_date']=='' OR $staff_row['appointment_date']=='  /  /    '){
                                
                            }else{
                                
                                if($staff_row['separation_date']=='' OR $staff_row['separation_date']=='  /  /    '){
                                    $diff = date_diff(date_create($staff_row['appointment_date']), date_create(date("m/d/Y")));
                                }else{
                                    $diff = date_diff(date_create($staff_row['appointment_date']), date_create(date($staff_row['separation_date'])));
                                }
                                
                                echo '('.$diff->format('%y').' yrs.)';
                            }
                            ?>
                            </td>
                          </tr>
                          
                          <tr>
                      
                          <td style="font-size: smaller; padding: 0px; border: none;">Eligibiity</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Plantilla Number</td>
                          <td colspan="2" style="font-size: smaller; padding: 0px; border: none;">
                          <?php
                          if($staff_row['separation_date']=='' OR $staff_row['separation_date']=='  /  /    '){ ?>
                            Appointment Date - Present (No. of years)
                          <?php }else{ ?>
                            Appointment Date - Separation Date (No. of years)
                          <?php } ?>
                          </td>
                          </tr>
                          
                          
                          <tr><td colspan="4" style="font-size: smaller; padding: 8px; border: none;"></td></tr>
                          
                          <tr>
                        
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['tin_num']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['gsis_num']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['pagibig_num']; ?></td>
                          <td style="padding: 0px; border: none; font-size: medium;"><?php echo $staff_row['philHealth_num']; ?></td>
                          </tr>
                          
                          <tr>
                          <td style="font-size: smaller; padding: 0px; border: none;">TIN</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">SSS/GSIS</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">Pag-IBIG MID</td>
                          <td style="font-size: smaller; padding: 0px; border: none;">PhilHealth</td>
                          </tr>
                          
                          </table>
                          
                          </td>
                          </tr>
                        
                        
                         

                      </tbody>
                    </table>


                        <div class="col-lg-12">

                        <!-- ADD FAMILY MEMBER MODAL -->
                          <div id="add_fam_bg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                              <div class="modal-content">
                              <form action="save_add_personnel_tables.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>" method="POST">
                              
                                <div class="modal-header">
                                  <h5 id="exampleModalLabel" class="modal-title">ADD FAMILY MEMBER</h5>
                                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                </div>
                                
                                <div class="modal-body">
                                
                                    <div class="form-group row">
                                    
                                        <div class="col-sm-12">
                                            <div class="row">
                                            
                                                <div class="col-md-12">
                                                <input name="fullname" type="text" class="form-control" placeholder="Enter Lastname, First Name, Middle Name" required="" />
                                                <small class="form-text">Family Member's Fullname</small>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                <select name="sex" class="form-control">
                                                <option>-</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                                </select>
                                                <small class="form-text">Sex</small>
                                                </div>
                                                
                                                <div class="col-md-8">
                                                <select name="relationship" class="form-control">
                                                <option>-</option>
                                                <option>Spouse</option>
                                                <option>Child</option>
                                                <option>Parents</option>
                                                <option>Siblings</option>
                                                </select>
                                                <small class="form-text">Relationship</small>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                <input name="contact_num" type="text" class="form-control" placeholder="Enter contact number..." />
                                                <small class="form-text">Contact Number (Optional)</small>
                                                </div>
                                                  
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                                
                                <div class="modal-footer">
                                  <a style="color: white;" href="" data-dismiss="modal" class="btn btn-secondary">Cancel</a>
                                  <button name="save_add_fam_bg" type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- END ADD FAMILY MEMBER MODAL -->
                          
                        <div class="table-responsive" style="margin-top: 12px;">
                        <a title="Click to add family members..." style="color: white !important; margin-top: 12px; margin-bottom: 12px;" data-toggle="modal" data-target="#add_fam_bg" href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add Family Member</a>
                        
                        <table id="" class="display" style="width:100%">
                          <thead>
                            <tr>
                            <th>ACTION</th>
                            <th style="font-weight: bold; width: 40%;">FULLNAME</th>
                            <th style="font-weight: bold;">SEX</th>
                            <th style="font-weight: bold; width: 20%;">RELATIONSHIP</th>
                            <th style="font-weight: bold; width: 20%;">CONTACT #</th>
                            </tr>
                          </thead>
                          <tbody>
                          
                                <?php
                                $subjK_ctr=0;
                                
                                $ps_query = $conn->query("SELECT * FROM personnel_fam_bg WHERE personnel_id='$_GET[personnel_id]' ORDER BY relationship ASC") or die(mysql_error());
                                while ($ps_row = $ps_query->fetch())
                                {
                                    ?>
                                    
     
               
                            <tr>
                            
                                <td style="width: 80px;">
                                <a title="Edit data..." style="color: white !important; margin-top: 3px;" data-toggle="modal" data-target="#editPersonnel_seminars<?php echo $ps_row['fm_id']; ?>" href="#" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                <a title="Delete data..." style="color: white !important; margin-top: 3px;" data-toggle="modal" data-target="#deletePersonnel_seminars<?php echo $ps_row['fm_id']; ?>" href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                </td>
                            
                            
                            <td><?php echo $ps_row['fullname']; ?></td>
                            <td><?php echo $ps_row['sex']; ?></td>
                            <td><?php echo $ps_row['relationship']; ?> <?php if($ps_row['relationship']==='Parents'){ if($ps_row['sex']==='Male'){ echo "(Father)"; }else{ echo "(Mother)"; } } ?></td>
                            <td><?php echo $ps_row['contact_num']; ?></td>
                            </tr>
                            
                            <?php include('edit_personnel_fam_bg_modal.php'); ?>
                            
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
     
        
                  
      </section>
      
      
      <?php include('footer.php'); ?>
      
    </div>


    <?php include('scripts_files.php'); ?>


  </body>
</html>