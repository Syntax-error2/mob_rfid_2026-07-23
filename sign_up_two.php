<!DOCTYPE html>
<html>

  <?php
  
  include('dbcon.php');
  include('header.php');
  
  ?>
  
  <?php
  
  $get_fname=strtoupper($_POST['fname']);
  $get_lname=strtoupper($_POST['lname']);
  $get_RFTag_id=strtoupper($_POST['RFTag_id']);
  
  $teacher_query = $conn->query("select * FROM personnels WHERE RFTag_id='$get_RFTag_id' AND fname='$get_fname' AND lname='$get_lname'") or die(mysql_error());

 if($teacher_query->rowCount()<=0)
 { ?>
    <script>
    window.alert('Unable to register. The data entered is invalid. Please supply invalid data or contact the system administrator.');
    window.location='sign_up_one.php';
    </script>
 <?php }else{
    $teacher_row = $teacher_query->fetch();
 }
 
 
 
  ?>
  
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>MUNICIPALITY OF</span> <strong class="text-primary">BINALBAGAN</strong></div>
            <p><strong>HUMAN RESOURCE MANAGEMENT SYSTEM</strong> [ ver. 1.0 ]</p>
            <p>Account Setup - Step 2 of 2</p>
            <form method="POST" action="account_signup.php" class="text-left form-validate">
       
                
              <input type="hidden" name="personnel_id" value="<?php echo $teacher_row['personnel_id']; ?>" />
              <input type="hidden" name="fname" value="<?php echo $get_fname; ?>" />
              <input type="hidden" name="lname" value="<?php echo $get_lname; ?>" />
              <input type="hidden" name="do_id" value="<?php echo $teacher_row['do_id']; ?>" />
               
              
              <div class="form-group-material">
                <input id="login-username" type="text" readonly="true" class="input-material" value="<?php echo $get_fname." ".$get_lname; ?>">
                <label for="login-username" class="label-material">Name</label>
              </div>
              
             <div class="form-group-material">
                <input id="login-username" name="email" type="email" value="<?php echo $teacher_row['email']; ?>" required data-msg="Please enter your email" class="input-material">
                <label for="login-username" class="label-material">Email</label>
              </div>
              
              
              <div class="form-group-material">
                <input id="login-username" type="text" name="username" required data-msg="Please enter your username" class="input-material">
                <label for="login-username" class="label-material">Username</label>
              </div>
              <div class="form-group-material">
                <input id="password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                <label for="password" class="label-material">Password</label>
              </div>
              <div class="form-group-material">
                <input id="confirm_password" type="password" required data-msg="Please retype your password" class="input-material">
                <label for="confirm_password" class="label-material">Retype Password</label>
                <small><span id="message"></span></small>
              </div>
              <div class="form-group text-center"><button name="stepTwoSignup" class="btn btn-primary">Register</button>
                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
              </div>
            </form> 
          </div>
          <div class="copyrights text-center">
            <p>Template by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          </div>
        </div>
      </div>
    </div>
    
    <?php include('scripts_files.php'); ?>
    
  </body>
</html>