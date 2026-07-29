<!DOCTYPE html>
<html>

  <?php
  
   include('session.php');
   //include('dbcon2.php');
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
            <li class="breadcrumb-item active">Database File Manager</li>
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
                  
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder">DATABASE FILE MANAGER</a>
                  
                  </h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="updates-boxKinder" role="tabpanel" class="collapse show">
               
                    
                    <form action="list_dbFiles_manager_backup.php" method="post" style="margin-left: 55px; margin-top: 12px;">
                        
                        <?php
                        /*
                        $id = mysql_query("select MAX(ID) as max_cusid from backup_dbname");                                       
                        $row = mysql_fetch_array($id);
                        */
                        
                        $id = $conn->query("SELECT MAX(ID) AS max_cusid FROM backup_dbname") or die(mysql_error());
                        $row = $id->fetch();
                            
                        ?>
                        <input type="hidden" id="ID" name="ID" value="<?php echo $row['max_cusid'] + 1; ?>" />
                                               
                        <button type="submit" class="btn btn-success"><i class="fa fa-database"></i> FULL BACK-UP</button>
                     
                    </form>
                    
                     <hr />
                    
                    <div class="col-lg-12">
                        <div class="table-responsive" style="margin-top: 12px;">
                            <table id="" class="display" style="width:100%">
                                <thead>
                                <tr>
                                <th>DATABASE BACK-UP FILENAME</th>
                                <th>BACK-UP DATE | TIME</th>
                                <th>DOWNLOAD</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                <?php
                                /*
                                $user_query=mysql_query("select * from backup_dbname")or die(mysql_error());
                                while($row=mysql_fetch_array($user_query)){
                                */
                                
                                $user_query = $conn->query("SELECT * FROM backup_dbname") or die(mysql_error());
                                while($row = $user_query->fetch()){
                                ?>
                                <tr>
                                
                                <td><?php echo $row['Name']; ?></td>
                                <td><?php echo $row['Date']; ?></td>
                                <td style="width: 10px;">
                                
                                <form action="Backup_Data/download.php" method="POST">
                                <input type="hidden" name="file" value="<?php echo $row['Name'].'.sql'; ?>" />
                                <button class="btn btn-primary"><i class="fa fa-download"></i></button>
                                </form>
                                
                                </td>
                                </tr>
                                <?php  }  ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
    
   <!-- iframe src="print_database.php" height="500px" width="100%"></iframe-->
                 
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
 
 