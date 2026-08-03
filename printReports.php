<!DOCTYPE html>
<html>

  <?php
  
   include('session.php');
   
   include('header.php');
   
   
   ?>
  
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
            <li class="breadcrumb-item active">Print Reports</li>
          </ul>
        </div>
      </div>
      
      
      
      
      <!-- SHS Programs section Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              
              
              <!-- kinder 1     -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display">
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><strong style="font-weight: bold !important;">REPORTS</strong></a>
                  </h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="updates-boxKinder" role="tabpanel" class="collapse show">
                    
                    <table>
                    <tr>
                    <td style="background-color: white;  border: none;">
                    
                        <div class="dropdown" style="margin-left: 8px;"><a href="printReports.php" class="dropbtn" style="color: white;">ATTENDANCE REPORTS</a></div>
                        
                        <div class="dropdown" style="margin-left: 8px;">
                        
                          <button class="dropbtn">PERSONNEL REPORTS</button>
                          
                          <div class="dropdown-content">
                            <a href="printReports_byAge.php?crw=AGE">Age with Date of Birth</a>
                            <a href="printReports_byEduc.php?crw=EDUCATION">Educational Attainment</a>
                            <a href="printReports_bySeminar.php?crw=SEMINAR">Seminars Attended</a>
                            <a href="printReports_byService.php?crw=SERVICE">Date Hired with No. of Years</a>
                          </div>
                          
                        </div>
                        
                        <div class="dropdown" style="margin-left: 8px;">
                        
                          <button class="dropbtn">COMPANY REPORTS</button>
                          
                          <div class="dropdown-content">
                            <a href="#">Calendar</a>
                          </div>
                          
                        </div>
                        
                    </td>
                    </tr>
                    
                    <tr>
                    <td style="background-color: white;  border: none;">
                    <strong style="margin-left: 8px; font-size: 18px;">ATTENDANCE REPORTS</strong>
                    </td>
                    </tr>
                    </table>
                    
                
                <form action="checkPrintDetails.php" method="POST">
                
                <div style="margin: 10px 10px 10px 12px;" class="form-group row">
                <div class="col-lg-12">
                
                                        <div class="row">
                                          <div class="col-md-4">
                                             <label>Date ( MM/YYYY )</label>
                                            <input type="month" name="dateFrom" value="<?php echo date('Y-m'); ?>" class="form-control" />
                                          </div>
                                          
                                          
                                          <div class="col-md-4">
                                             <label>Type of Report</label>
                                            <select name="doc_type" class="form-control">
                                            <optgroup label="Log Reports"></optgroup>
                                            <option>CS Form 48 (1-15)</option>
                                            <option>CS Form 48 (16-31)</option>
                                            <option>CS Form 48</option>
                                            <option>Detailed DTR</option>
                                            <option>Log Validation History</option>
                                            <optgroup label="Leave, Travel/Seminar Reports"></optgroup>
                                            <option>Leave Application Forms</option>
                                            <option>Leave Summary</option>
                                            </select>
                                          </div>
                                          
                                          
                                          <div class="col-md-4">
                                            <label>Department / Office</label>
                                            <select name="do_id" class="form-control">
                                            <option value="print_all">All</option>
                                            <?php
                                            $emp_stat_query = $conn->query("select * from dept_offices ORDER BY dept_office_name ASC");
                                            while($es_row=$emp_stat_query->fetch()){
                                            ?>
                                            <option value="<?php echo $es_row['do_id']; ?>"><?php echo $es_row['dept_office_name']; ?></option>
                                            <?php } ?>
                                            </select>
                                            
                                          </div>
                                        </div>
                </div>
                </div>
                
                <div class="modal-footer">
                <button name="print_monthly_dtr" type="submit" class="btn btn-primary">Print Preview</button>
                </div>
                </form>
                
                 
                </div>
              </div>
              <!-- kinder End-->
              
              <!-- Custom Personnel Report Form -->
              <div id="custom-report-card" class="card updates recent-updated mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display">
                  <a data-toggle="collapse" href="#customReportBox" aria-expanded="true"><strong style="font-weight: bold !important;">CUSTOM PERSONNEL REPORT</strong></a>
                  </h2><a data-toggle="collapse" href="#customReportBox" aria-expanded="true"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="customReportBox" role="tabpanel" class="collapse show">
                  <form action="printPersonnelCustomReport.php" method="POST" target="_blank">
                    <div style="margin: 15px;" class="form-group row">
                      <div class="col-lg-12">
                        
                        <div class="row mb-4">
                          <div class="col-md-4">
                            <label style="font-weight: bold;">Grouping Options</label>
                            <select name="group_by" class="form-control">
                              <option value="mixed">Mixed (Alphabetical)</option>
                              <option value="male_only">Male Only</option>
                              <option value="female_only">Female Only</option>
                              <option value="department">Group By Department</option>
                              <option value="employment_status">Group By Employment Status</option>
                            </select>
                          </div>
                        </div>

                        <label style="font-weight: bold; margin-bottom: 10px; display: block;">Select Columns to Display:</label>
                        <div class="row">
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_fullname" type="checkbox" value="1" checked disabled class="checkbox-template">
                              <label for="col_fullname">Full Name (Default)</label>
                              <input type="hidden" name="cols[]" value="fullname">
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_sex" name="cols[]" type="checkbox" value="sex" class="checkbox-template">
                              <label for="col_sex">Sex</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_age" name="cols[]" type="checkbox" value="age" class="checkbox-template">
                              <label for="col_age">Age</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_dob" name="cols[]" type="checkbox" value="dob" class="checkbox-template">
                              <label for="col_dob">Date of Birth</label>
                            </div>
                          </div>
                          
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_pob" name="cols[]" type="checkbox" value="pob" class="checkbox-template">
                              <label for="col_pob">Place of Birth</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_address" name="cols[]" type="checkbox" value="address" class="checkbox-template">
                              <label for="col_address">Home Address</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_contact" name="cols[]" type="checkbox" value="contact" class="checkbox-template">
                              <label for="col_contact">Contact Number</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_email" name="cols[]" type="checkbox" value="email" class="checkbox-template">
                              <label for="col_email">Email</label>
                            </div>
                          </div>

                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_department" name="cols[]" type="checkbox" value="department" class="checkbox-template">
                              <label for="col_department">Department / Office</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_designation" name="cols[]" type="checkbox" value="designation" class="checkbox-template">
                              <label for="col_designation">Designation</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_emp_status" name="cols[]" type="checkbox" value="emp_status" class="checkbox-template">
                              <label for="col_emp_status">Employment Status</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_salary_grade" name="cols[]" type="checkbox" value="salary_grade" class="checkbox-template">
                              <label for="col_salary_grade">Salary Grade / Step</label>
                            </div>
                          </div>
                          
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_monthly_salary" name="cols[]" type="checkbox" value="monthly_salary" class="checkbox-template">
                              <label for="col_monthly_salary">Monthly Salary</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_date_hired" name="cols[]" type="checkbox" value="date_hired" class="checkbox-template">
                              <label for="col_date_hired">Date Hired</label>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2">
                            <div class="i-checks">
                              <input id="col_separation_date" name="cols[]" type="checkbox" value="separation_date" class="checkbox-template">
                              <label for="col_separation_date">Separation Date</label>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print Preview</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Custom Report End -->
              
              
              
            </div>
            
          </div>
        </div>
        
        <?php include('add_client_comp_modal.php'); ?>
                  
      </section>
      
      
      <?php include('footer.php'); ?>
      
    </div>
    
    <?php include('scripts_files.php'); ?>

     
    
  </body>
</html>