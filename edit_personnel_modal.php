                            <?php
                            
                            if($_GET['dept']==='All'){
                            
                            $editPer_query = $conn->query("SELECT * FROM personnels WHERE personnel_id_code LIKE '%$searched%' OR lname LIKE '%$searched%' ORDER BY lname, fname ASC") or die(mysql_error());
                             
                             
                            }else{
                                
                            $editPer_query = $conn->query("SELECT * FROM personnels WHERE do_id='$_GET[dept]' ORDER BY lname, fname ASC") or die(mysql_error());
                             
                            }
                            
                            
                            while ($editPer_row = $editPer_query->fetch()) 
                            { 
                                $personnel_id=$editPer_row['personnel_id'];
                                
                                
                        if($editPer_row['mname']=='')
                        {
                            $finalMName='';
                            
                        }else{
                            
                            if($editPer_row['suffix']=='-') { $suffix=''; }else{ $suffix=$editPer_row['suffix'].' '; }
                            
                            $finalMName=$suffix.substr($editPer_row['mname'], 0,1).'.';
                        } ?>

                        
                        
                        
                        
                <!--Add 201 Files Modal -->
            
                  <div id="add201Files<?php echo $personnel_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                      
                       <form action="save_add_personnel.php?dept=<?php echo $editPer_row['do_id']; ?>" method="POST" enctype="multipart/form-data">
                       
                       
                       <input value="<?php echo $personnel_id; ?>" name="personnel_id" type="hidden" />
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Add 201 File [ <?php echo $editPer_row['lname'].', '.$editPer_row['fname'].' '.$finalMName; ?> ]</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                        </div>
                        
                        <div class="modal-body">
           
                      
                            <div class="form-group row">
                               
                              <div class="col-sm-12">
                              
                              <div class="row">
                                <div class="col-md-12">
                                <input name="RFTag_id" type="hidden" value="<?php echo $editPer_row['RFTag_id']; ?>" />
                                <input class="form-control" name="per_file" type="file" multiple="" />
                                <small>Browse Local Files</small>
                                </div>
                              </div>
                                
                              </div>
                            </div>
                         
    
                        </div>
                        
                        <div class="modal-footer">
                          <a style="color: white;" data-dismiss="modal" class="btn btn-secondary">Cancel</a>
                          <button name="save_add201File" type="submit" class="btn btn-primary">Add</button>
                        </div>
                        
                        </form>
                        
                      </div>
                    </div>
                  </div>
                  <!-- end Add 201 Files Modal -->



                <!--download 201 Files Modal -->
            
                  <div id="download201Files<?php echo $personnel_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Download 201 File [ <?php echo $editPer_row['lname'].', '.$editPer_row['fname'].' '.$finalMName; ?> ]</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                        </div>
                        
                        <div class="modal-body">
           
                      
                            <div class="form-group row">
                              
                              <div class="col-sm-12">
                              
                              <div class="row">
                                <div class="col-md-12">

                                    <table cellspacing="0" class="table table-bordered">
                                        <thead>
                                            <th>File Name</th>
                                            <th>Date Uploaded</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                        <?php
                         
                                        $dl_201_query = $conn->query("SELECT * FROM files INNER JOIN personnels ON files.personnel_id = personnels.personnel_id where personnels.personnel_id = '$personnel_id'");
                                        while($dl201_row=$dl_201_query->fetch()){ ?>
                                        
                                            <tr>
                                            <td><small><?php echo $dl201_row['file_name']; ?></small></td>
                                            <td><small><?php echo $dl201_row['date_time_uploaded']; ?></small></td>
                                            <td>
                                            <center>
                                           
                                            <a title="Download file..." href="download_201.php?download_file=<?php echo $dl201_row['file_name']; ?>"><span class="fa fa-download" aria-hidden="true"></span></a> 
                                            <br />
                                            <a title="Remove file..." href="delete201Files.php?dept=<?php echo $editPer_row['do_id']; ?>&file_id=<?php echo $dl201_row['file_id']; ?>" style="color: red;"><span class="fa fa-times" aria-hidden="true"></span></a>
                                            </center>
                                            </td>
                                            </tr>
                                            
                                        <?php } ?>
                                        
                                        </tbody>
                                    </table>
                                    
                                </div>
                              </div>
                                
                              </div>
                            </div>
                         
    
                        </div>
                        
                       
                        
                        </form>
                        
                      </div>
                    </div>
                  </div>
                  <!-- end download 201 Files Modal -->
                  
                  <!--update Shift Modal -->
            
                  <div id="updateShift<?php echo $personnel_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                      
                       <form action="save_add_personnel.php?dept=<?php echo $editPer_row['do_id']; ?>" method="POST" enctype="multipart/form-data">
                       
                       
                       <input value="<?php echo $personnel_id; ?>" name="personnel_id" type="hidden" />
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Set Shift [ <?php echo $editPer_row['lname'].', '.$editPer_row['fname'].' '.$finalMName; ?> ]</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                        </div>
                        
                        <div class="modal-body">
           
                      
                            <div class="form-group row">
                               
                              <div class="col-sm-12">
                              
                              <div class="row">
                                <div class="col-md-12">
                                <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM shifts WHERE shift_id='$editPer_row[shift_id]'");
                                    $es_row=$emp_stat_query->fetch();
                                    ?>
                                    <select name="shift_id" class="form-control">
                                    <option value="<?php echo $es_row['shift_id']; ?>"><?php echo $es_row['shift_name'].' ( '.$es_row['type'].' )'; ?></option>
                                    <option value="0">-</option>
                                    <?php
                                    $emp_stat_query = $conn->query("SELECT * FROM shifts WHERE do_id='$_GET[dept]' OR do_id=0 ORDER BY shift_name ASC");
                                    while($es_row=$emp_stat_query->fetch()){
                                    ?>
                                    <option value="<?php echo $es_row['shift_id']; ?>"><?php echo $es_row['shift_name'].' ( '.$es_row['type'].' )'; ?></option>
                                    <?php } ?>
                                    
                                    </select>
                                    <small class="form-text">Work-Hour Shift</small>
                                </div>
                              </div>
                                
                              </div>
                            </div>
                         
    
                        </div>
                        
                        <div class="modal-footer">
                          <a style="color: white;" data-dismiss="modal" class="btn btn-secondary">Cancel</a>
                          <button name="set_shift" type="submit" class="btn btn-primary">Update</button>
                        </div>
                        
                        </form>
                        
                      </div>
                    </div>
                  </div>
                  <!-- end update Shift Modal -->
                  
                        <!-- delete student Modal -->
                          <div id="deletePersonnel<?php echo $personnel_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                              <div class="modal-content">
                              <form action="save_add_personnel.php?dept=<?php echo $editPer_row['do_id']; ?>" method="POST">
                              <input name="personnel_id" value="<?php echo $personnel_id; ?>" type="hidden" />
                              
                                <div class="modal-header">
                                  <h5 id="exampleModalLabel" class="modal-title">Delete Personnel</h5>
                                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                </div>
                                
                                <div class="modal-body">
                                   
                                <h4>Are you sure you want to delete personnel:<br /><br /><?php echo $editPer_row['lname'].", ".$editPer_row['fname']." ".$finalMName; ?>?
                                <br />
                                <small class="form-text"> </small>
                                </h4>
                                  
                                </div>
                                
                                <div class="modal-footer">
                                  <a style="color: white;" href="" data-dismiss="modal" class="btn btn-primary">No</a>
                                  <button name="deleteStudent" type="submit" class="btn btn-danger">Yes</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- end delete student Modal -->
                          
                          
                          
    
         
                  
   <?php } ?>               