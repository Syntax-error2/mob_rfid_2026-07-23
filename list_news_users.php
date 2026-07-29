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
            <li class="breadcrumb-item active">News</li>
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
                  
                  
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><strong style="font-weight: bold !important;">NEWS &amp; ANNOUNCEMENTS</strong></a>
                  
                  
                  
                  </h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxKinder" aria-expanded="true" aria-controls="updates-boxKinder"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="updates-boxKinder" role="tabpanel" class="collapse show">
  
 
                    <table class="table table-bordered" id="example2" style="margin: 8px 8px 8px 8px;">
                     
                      <thead>
                        <tr>
                      
                          <th>Announcement Title<br /> <small>Contents</small></th>
                          <th>Announcement From<br /> <small>Date | Time posted</small></th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      
                            <?php 
                            
                            $subjK_query = $conn->query("select * FROM news ORDER BY news_id DESC") or die(mysql_error());
                            while ($subjK_row = $subjK_query->fetch()) 
                            {
              
                            
                            $news_id=$subjK_row['news_id'];
                            
                            ?>
           
                        <tr>
                        
                          
                          <td><?php echo "<strong>".$subjK_row['news_title']."</strong><br /><p style='word-break: break-all;'>".$subjK_row['news_contents']."</p>"; ?></td>
                           
                          <td><?php echo $subjK_row['posted_by'].' - '.$subjK_row['dateTime']; ?></td>
                           
        
                        </tr>
                       
                        <?php } ?>
                       
                      </tbody>
                    </table>
                </div>
              </div>
              <!-- kinder End-->
              
              
              
            </div>
            
          </div>
        </div>
        
        <?php include('add_news_modal.php'); ?>
                  
      </section>
      
      
      <?php include('footer.php'); ?>
      
    </div>
    
    <?php include('scripts_files.php'); ?>

     
    
  </body>
</html>