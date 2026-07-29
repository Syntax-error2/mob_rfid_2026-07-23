
                    <div class="col-lg-12" style="margin-bottom: 12px;">
                    <div class="table-responsive" style="margin-top: 12px;">
                    
                    <table id="" class="display" style="width:100%">
                      
                      <thead>
                        <tr>
                          <th>Action</th>
                          <th>Image<br /><small>ID Code</small></th>
                          <th>[ RFId Tag ] Fullname<br /><small>Current Time-Shift</small></th>
                          <th>Reports</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      
                            <?php
                            
                            $staff_query = $conn->query("SELECT * FROM personnels WHERE do_id='$_GET[dept]' AND (separation_date='' OR separation_date='  /  /    ') ORDER BY lname, fname ASC") or die(mysql_error());
                            while ($staff_row = $staff_query->fetch()){
                                
                            $personnel_id=$staff_row['personnel_id'];
                            
                            ?>
           
                          <tr>
                          <td>
                          <a title="View complete personnel data..." style="color: white !important; margin-top: 3px;" href="list_personnel_individual_details.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $personnel_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i></a>
                          <a title="Delete personnel..." style="color: white !important; margin-top: 3px;" data-toggle="modal" data-target="#deletePersonnel<?php echo $personnel_id; ?>" href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                          </td>
                         
                         
                         
                          <td>
                          <center>
                          <a href="updateStudentImg.php?personnel_id=<?php echo $personnel_id; ?>&dept=<?php echo $_GET['dept']; ?>"><img src="personnelImg/<?php echo $staff_row['img']; ?>" width="80" height="80" class="img-fluid rounded" style="margin-bottom: 8px;" /></a>
                          <br />
                          <small><?php echo $staff_row['personnel_id_code']; ?></small>
                          </center>
                          </td>
                          
                          
                          <td>
                          [ <a title="Edit RFID tag..." href="edit_studentRFIDTag_modal.php?dept=<?php echo $_GET['dept']; ?>&personnel_id=<?php echo $personnel_id; ?>" style="color: green; cursor: pointer;"><i class="fa fa-barcode"></i> <?php echo $staff_row['RFTag_id']; ?> </a> ]
                          
                                    <?php
                          
                 
                                    if($staff_row['suffix']=="-")
                                    {
                                        
                                    echo $staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname'];
                                    
                                    }else{
                                        
                                    echo $staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname']." ".$staff_row['suffix'];
                                    
                                    } ?>
                            <br />
                              <?php
                              $emp_stat_query5 = $conn->query("SELECT * from shifts WHERE shift_id='$staff_row[shift_id]'");
                              $es_row5=$emp_stat_query5->fetch();
                              ?>
                              <a title="Shift settings..." style="<?php if($es_row5['type']==='Regular Shift'){ ?> color: green; <?php }elseif($es_row5['type']==='Night Shift'){ ?> color: blue; <?php }elseif($es_row5['type']==='24 Hours Shift'){ ?> color: brown; <?php }elseif($es_row5['type']==='Open Time'){ ?> color: purple; <?php }else{ ?> color: red; <?php } ?> cursor: pointer; margin-top: 7px;" data-toggle="modal" data-target="#updateShift<?php echo $personnel_id; ?>" href="#"><i class="fa fa-pencil-square-o"></i> <?php if(!empty($es_row5)){ echo $es_row5['shift_name']; }else{ echo "Not Set"; } ?> <small <?php if(empty($es_row5)){?> style="color: red;" <?php } ?>>( <?php if(!empty($es_row5)){ echo $es_row5['type']; }else{ echo "Not Set"; } ?> )</small></a>
                            </td>
                           
                           <td>
                           <button data-toggle="dropdown" type="button" class="btn btn-outline-primary dropdown-toggle"><i class="fa fa-print"></i>  Reports <i class="caret"></i></button>
                            <div class="dropdown-menu">
                            
                            <a title="Print Civil Service Form 48..." data-toggle="modal" data-target="#print_monthly_attendance_csf48<?php echo $staff_row['RFTag_id']; ?>" href="#" class="dropdown-item"><i class="fa fa-print"></i> CSForm 48</a>
                            <a title="Print detailed DTR..." data-toggle="modal" data-target="#print_monthly_attendance<?php echo $staff_row['RFTag_id']; ?>" href="#" class="dropdown-item"><i class="fa fa-print"></i> Detailed DTR <small>(Monthly)</small></a>
                            <a title="Print Log Validations history..." data-toggle="modal" data-target="#print_monthly_LV<?php echo $staff_row['RFTag_id']; ?>" href="#" class="dropdown-item"><i class="fa fa-image"></i> Log Validation History <small>(Monthly)</small></a>

                            <div class="dropdown-divider"></div>
                             
                            <a title="View 201 files..." data-toggle="modal" data-target="#download201Files<?php echo $personnel_id; ?>" href="#" class="dropdown-item"><i class="fa fa-search"></i>  201 File Archive</a>
                            <a title="Add/Upload 201 files..." data-toggle="modal" data-target="#add201Files<?php echo $personnel_id; ?>" href="#" class="dropdown-item"><i class="fa fa-plus"></i> 201 Files</a>
                           
                            </div>
                            
                           </td>
                           
                        </tr>
                        
                        <?php include('print_monthly_attendance_modal_csf48.php'); ?>
                        <?php include('print_monthly_attendance_modal.php'); ?>
                        <?php include('print_monthly_LV_modal.php'); ?>
                        <?php include('print_monthly_DTRNotes_modal.php'); ?>
                        <?php include('print_yearly_DTRSummary_modal.php'); ?>
                        
                         <?php } ?>
                         
                      </tbody>
                      
                    </table>
                    
                    </div>
                    </div>