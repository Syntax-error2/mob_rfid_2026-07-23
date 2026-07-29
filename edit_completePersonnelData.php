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
            <li class="breadcrumb-item"><a href="list_personnel.php?dept=<?php echo $_GET['dept']; ?>">List of Personnel</a></li>
            <li class="breadcrumb-item active">Update Complete Personnel Data</li>
          </ul>
        </div>
      </div>
      
      
      <?php
      $personnel_query = $conn->query("SELECT * FROM personnels WHERE personnel_id='$_GET[personnel_id]'") or die(mysql_error());
      $personnel_row=$personnel_query->fetch();
      ?>
      
      <!-- SHS Programs section Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              
              
              <form action="save_add_personnel.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>" method="POST" enctype="multipart/form-data">
 
              <input type="hidden" name="personnel_id" value="<?php echo $personnel_row['personnel_id']; ?>" />
              
              <!-- PERSONNEL INFORMATION     -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display">
                  
               
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder1" aria-expanded="true" aria-controls="updates-boxKinder1"><strong style="font-weight: bold !important;">PERSONAL INFORMATION</strong></a>
 
                  </h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder1" aria-expanded="true" aria-controls="updates-boxKinder1"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="updates-boxKinder1" role="tabpanel" class="collapse show">
 
                        <div class="modal-body">
             
                        <div class="form-group row">
                            
                              <div class="col-sm-12">
                              
                              <div class="row">
                                <div class="col-md-4">
                                <input value="<?php echo $personnel_row['personnel_id_code']; ?>" name="personnel_id_code" type="text" class="form-control" required="true" />
                                <small>*Employee ID Code</small>
                                </div>
                                
                                <div class="col-md-4">
                                <input value="<?php echo $personnel_row['RFTag_id']; ?>" name="RFTag_id" type="text" class="form-control" readonly="true" />
                                <small>RFID Tag</small>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM shifts WHERE shift_id='$personnel_row[shift_id]'");
                                    $es_row=$emp_stat_query->fetch();
                                    ?>
                                    <select name="shift_id" class="form-control">
                                    <option value="<?php echo $es_row['shift_id']; ?>"><?php echo $es_row['shift_name']; ?></option>
                                    <option value="0">-</option>
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM shifts ORDER BY shift_name ASC");
                                    while($es_row=$emp_stat_query->fetch()){
                                    ?>
                                    <option value="<?php echo $es_row['shift_id']; ?>"><?php echo $es_row['shift_name']; ?></option>
                                    <?php } ?>
                                    
                                    </select>
                                    <small class="form-text">Work-Hour Shift</small>
                                  </div>
                                  
                              </div>
                                
                              </div>
                            </div>
                            
          
                        
                            <div class="form-group row">
                             
                              <div class="col-sm-12">
                              
                              <div class="row">
    
                                <div class="col-md-3">
                                <input value="<?php echo $personnel_row['fname']; ?>" name="fname" type="text" class="form-control" required="true" />
                                <small class="form-text">*First Name</small>
                                </div>
                                 
                                <div class="col-md-3">
                                <input value="<?php echo $personnel_row['mname']; ?>" name="mname" type="text" class="form-control" />
                                <small class="form-text">Middle Name</small>
                                </div>
                                
               
                                <div class="col-md-4">
                                <input value="<?php echo $personnel_row['lname']; ?>" name="lname" type="text" class="form-control" required="true" />
                                <small class="form-text">*Last Name</small>
                                </div>
                                
                                
                                  <div class="col-md-2">
                                     
                                    <select name="suffix" class="form-control">
                                    <option><?php echo $personnel_row['suffix']; ?></option>
                                    <option>-</option>
                                    <option>JR.</option>
                                    <option>SR.</option>
                                    <option>III</option>
                                    <option>IV</option>
                                    </select>
                                    <small class="form-text">Suffix</small>
                                  </div>
                              </div>
                                
                              </div>
                            </div>
                            
                         
                            
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                                <div class="row">
                                  <div class="col-md-4">
                                     
                                    <select name="sex" class="form-control">
                                    <option><?php echo $personnel_row['sex']; ?></option>
                                    <option>-</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    
                                    </select>
                                    <small class="form-text">Sex</small>
                                  </div>
                                  
                                  
                                  <div class="col-md-4">
                                    
                                    <select name="marital_status" class="form-control">
                                    <option><?php echo $personnel_row['marital_status']; ?></option>
                                    <option>-</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Widowed</option>
                                    <option>Separated</option>
                                    
                                    </select>
                                    <small class="form-text">Satus</small>
                                  </div>
                                  
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['bdMM'].'/'.$personnel_row['bdDD'].'/'.$personnel_row['bdYYYY']; ?>" name="birthdate" id="bdate" type="text" class="form-control" />
                                    <small class="form-text">*Date of Birth</small>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            
                            
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                                <div class="row">
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['birth_place']; ?>" name="birth_place" list="search_list_pob" type="text" class="form-control" />
                                    <small class="form-text">*Place of Birth</small>
                                    
                                    <datalist id="search_list_pob">
                                    <?php
                                    
                                    $pobList_query = $conn->query("SELECT DISTINCT birth_place FROM personnels");
                                    while($poblq_row = $pobList_query->fetch()){ ?>
                                    
                                    <option><?php echo $poblq_row['birth_place']; ?></option>
                                    
                                    <?php } ?>
                                    </datalist>
                                    
                                  </div>
                                  
                                  <div class="col-md-8">
                                    <input value="<?php echo $personnel_row['address']; ?>" name="address" list="search_list_address" type="text" class="form-control" />
                                    <small class="form-text">*Complete Address [ Street, Barangay, City/Municipality, Province ]</small>
                                    
                                    <datalist id="search_list_address">
                                    <?php
                                    
                                    $pAddressList_query = $conn->query("SELECT DISTINCT address FROM personnels");
                                    while($pAlq_row = $pAddressList_query->fetch()){ ?>
                                    
                                    <option><?php echo $pAlq_row['address']; ?></option>
                                    
                                    <?php } ?>
                                    </datalist>
                          
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                                <div class="row">
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['email']; ?>" type="email" name="email" class="form-control" />
                                    <small class="form-text">Email Address</small>
                                  </div>
                                  
                                  
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['personal_pnum']; ?>" name="personal_pnum" id="contact_no" type="text" class="form-control" />
                                    <small class="form-text">*Personal No.</small>
                                  </div>
                                  
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['emergency_pnum']; ?>" name="emergency_pnum" id="contact_no2" type="text" class="form-control" />
                                    <small class="form-text">Contact Person No.</small>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group row">
                             
                              <div class="col-sm-12">
                              
                              <div class="row">
    
                                <div class="col-md-3">
                                <input value="<?php echo $personnel_row['conPerson_fname']; ?>" name="conPerson_fname" type="text" class="form-control" />
                                <small class="form-text">*Contact Person First Name</small>
                                </div>
                                 
                                <div class="col-md-3">
                                <input value="<?php echo $personnel_row['conPerson_mname']; ?>" name="conPerson_mname" type="text" class="form-control" />
                                <small class="form-text">Contact Person Middle Name</small>
                                </div>
                                
               
                                <div class="col-md-4">
                                <input value="<?php echo $personnel_row['conPerson_lname']; ?>" name="conPerson_lname" type="text" class="form-control" />
                                <small class="form-text">*Contact Person Last Name</small>
                                </div>
                                
                                
                                  <div class="col-md-2">
                                     
                                    <select name="conPerson_relationship" class="form-control">
                                    <option><?php echo $personnel_row['conPerson_relationship']; ?></option>
                                    <option>-</option>
                                    <option>Parent</option>
                                    <option>Spouse</option>
                                    <option>Child</option>
                                    <option>Relative</option>
                                    <option>Neighbor</option>
                                    </select>
                                    <small class="form-text">Relationship</small>
                                  </div>
                              </div>
                                
                              </div>
                            </div>
                            
                            
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                                <div class="row">
                                  <div class="col-md-6">
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM dept_offices WHERE do_id='$personnel_row[do_id]'");
                                    $es_row=$emp_stat_query->fetch();
                                    ?>
                                    <select name="do_id" class="form-control">
                                    <option value="<?php echo $es_row['do_id']; ?>"><?php echo $es_row['dept_office_name']; ?></option>
                                    <option>-</option>
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM dept_offices ORDER BY dept_office_name ASC");
                                    while($es_row=$emp_stat_query->fetch()){
                                    ?>
                                    <option value="<?php echo $es_row['do_id']; ?>"><?php echo $es_row['dept_office_name']; ?></option>
                                    <?php } ?>
                                    
                                    </select>
                                    <small class="form-text">Department</small>
                                  </div>
                                  
                                  
                                  <div class="col-md-6">
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM designation WHERE des_id='$personnel_row[des_id]'");
                                    $es_row=$emp_stat_query->fetch();
                                    ?>
                                    <select name="des_id" class="form-control">
                                    <option value="<?php echo $es_row['des_id']; ?>"><?php echo $es_row['des_name']; ?></option>
                                    <option>-</option>
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM designation ORDER BY des_name ASC");
                                    while($es_row=$emp_stat_query->fetch()){
                                    ?>
                                    <option value="<?php echo $es_row['des_id']; ?>"><?php echo $es_row['des_name']; ?></option>
                                    <?php } ?>
                                    
                                    </select>
                                    <small class="form-text">Designation</small>
                                  </div>
                            
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                                <div class="row"> 
                                  <div class="col-md-7">
                                  
                                    <div class="row">
                                        
                                        <div class="col-3">
                                        <input name="sal_grade" value="<?php echo $personnel_row['sal_grade']; ?>" type="number" min="1" step="1" class="form-control" />
                                        <small class="form-text">Salary Grade</small>
                                        </div>
                                        
                                        <div class="col-3">
                                        <input name="sal_step" value="<?php echo $personnel_row['sal_step']; ?>" type="number" min="1" step="1" class="form-control" />
                                        <small class="form-text">Step</small>
                                        </div>
                                        
                                        <div class="col-3">
                                        <input name="sal_level" value="<?php echo $personnel_row['sal_level']; ?>" type="number" min="1" step="1" class="form-control" />
                                        <small class="form-text">Level</small>
                                        </div>
                                        
                                        <div class="col-3">
                                        <input name="rate_per_day" value="<?php echo $personnel_row['rate_per_day']; ?>" type="number" min="0.01" step="0.01" class="form-control" />
                                        <small class="form-text">Rate/Day</small>
                                        </div>
                                        
                                    </div>
                                    
                                  </div>
                                  
                                  <div class="col-md-5">
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM emp_status WHERE empStat_id='$personnel_row[empStat_id]'");
                                    $es_row=$emp_stat_query->fetch();
                                    ?>
                                    <select name="empStat_id" class="form-control">
                                    <option value="<?php echo $es_row['empStat_id']; ?>"><?php echo $es_row['emp_stat_name']; ?> | <?php echo $es_row['position_class']; ?></option>
                                    <option>-</option>
                                    
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM emp_status ORDER BY emp_stat_name ASC");
                                    while($es_row=$emp_stat_query->fetch()){
                                    ?>
                                    <option value="<?php echo $es_row['empStat_id']; ?>" <?php if($es_row['status']==='Active'){ ?> style="color: green;" <?php }else{ ?> style="color: red;" <?php } ?>><?php echo $es_row['emp_stat_name']; ?> | <?php echo $es_row['position_class']; ?></option>
                                    <?php } ?>
                                    </select>
                                    <small class="form-text">Status of Appointment | Class</small>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            </div>
                            
                            
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                                <div class="row">
                                
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['eligibility']; ?>" name="eligibility" type="text"  class="form-control">
                                    <small class="form-text">Eligibility</small>
                                  </div>
                                  
                                  
                                  <div class="col-md-8">
                                  <div class="row">
                                  
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['plantilla_num']; ?>" name="plantilla_num" type="text"  class="form-control">
                                    <small class="form-text">Plantilla No.</small>
                                  </div> 
                                  
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['appointment_date']; ?>" name="appointment_date" id="appointdate" type="text"  class="form-control" />
                                    <small class="form-text">*Appointment Date</small>
                                  </div>
                                  
                                  <div class="col-md-4">
                                    <input value="<?php echo $personnel_row['separation_date']; ?>" name="separation_date" id="separatedate" type="text"  class="form-control" />
                                    <small class="form-text">*Separation Date</small>
                                  </div>
                                  
                                  </div>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            </div>
                            
                             
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                                <div class="row">
                                   
                                  <div class="col-md-3">
                                    <input value="<?php echo $personnel_row['tin_num']; ?>" name="tin_num" id="tin" placeholder="Ex: XXX-XXX-XXX" type="text" class="form-control" />
                                    <small class="form-text">TIN</small>
                                  </div>
                                  
                                  <div class="col-md-3">
                                    <input value="<?php echo $personnel_row['gsis_num']; ?>" name="gsis_num" id="gsis" placeholder="Ex: XXX-XXX-XXX" type="text"  class="form-control" />
                                    <small class="form-text">GSIS BP No.</small>
                                  </div>
                                  
                                  <div class="col-md-3">
                                    <input value="<?php echo $personnel_row['pagibig_num']; ?>" name="pagibig_num" id="pagibig" placeholder="e.g. XXX-XXX-XXX" type="text"  class="form-control" />
                                    <small class="form-text">Pag-IBIG MID</small>
                                  </div>
                                  
                                  <div class="col-md-3">
                                    <input value="<?php echo $personnel_row['philHealth_num']; ?>" name="philHealth_num" id="philHealth" placeholder="e.g. XXX-XXX-XXX" type="text"  class="form-control" />
                                    <small class="form-text">PhilHealth No.</small>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            </div>
                            
  
                </div>
              </div>
              <!-- End PERSONNEL INFORMATION -->
              
            </div>
            
            <div class="footer" style="margin-bottom: 12px;">
                           
                                                
              <a href="list_personnel_individual_details.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $_GET['personnel_id']; ?>" class="btn btn-secondary" style="color: white; float: left; margin-left: 12px;">Cancel</a>
              <button name="updatePersonnelComplete" type="submit" class="btn btn-primary" style="float: right; margin-right: 12px;">Update</button>
            </div>
            
            </form>
            
          </div>
        </div>
        </div> 
      </section>
      
      <?php include('footer.php'); ?>
      
    </div>
    
    <!-- JavaScript files-->
    
    <script src="js/formatter.js"></script>
     <?php include('scripts_files.php'); ?>
    <script src = "js/admin.js"></script>
     
    <script>
    
    var bdate = new Formatter (document.getElementById('bdate'), {
      'pattern': '{{99}}/{{99}}/{{9999}}',
      'persistent': true
      });
    
    var separatedate = new Formatter (document.getElementById('separatedate'), {
      'pattern': '{{99}}/{{99}}/{{9999}}',
      'persistent': true
      });
    
    var appointdate = new Formatter (document.getElementById('appointdate'), {
      'pattern': '{{99}}/{{99}}/{{9999}}',
      'persistent': true
      });
      
        
    var contanct_no = new Formatter (document.getElementById('contact_no'), {
      'pattern': '+639{{999999999}}',
      'persistent': true
      });
      
    var contanct_no2 = new Formatter (document.getElementById('contact_no2'), {
      'pattern': '+639{{999999999}}',
      'persistent': true
      });
      
    var pagibig = new Formatter (document.getElementById('pagibig'), {
      'pattern': '{{999}}-{{999}}-{{999}}-{{999}}',
      'persistent': true
      });
      
    var philHealth = new Formatter (document.getElementById('philHealth'), {
      'pattern': '{{99}}-{{999999999}}-{{9}}',
      'persistent': true
      });
      
    var tin = new Formatter (document.getElementById('tin'), {
      'pattern': '{{999}}-{{999}}-{{999}}',
      'persistent': true
    });
    
    var gsis = new Formatter (document.getElementById('gsis'), {
      'pattern': '{{9999}}-{{999}}-{{999}}',
      'persistent': true
    });
    </script>
     
    
  </body>
</html>