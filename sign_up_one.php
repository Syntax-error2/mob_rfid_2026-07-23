<!DOCTYPE html>
<html>

  <?php
  
  include('dbcon.php');
  include('header.php');
  
  ?>
  
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>MUNICIPALITY OF</span> <strong class="text-primary">BINALBAGAN</strong></div>
            <p><strong>HUMAN RESOURCE MANAGEMENT SYSTEM</strong> [ ver. 1.0 ]</p>
            <p>Account Setup - Step 1 of 2</p>
            <form method="POST" action="sign_up_two.php" class="text-left form-validate">
 
              <div class="form-group-material">
                <input id="login-username" type="text" name="fname" required data-msg="Please enter your first name" class="input-material">
                <label for="login-username" class="label-material">First Name</label>
              </div>
              
              <div class="form-group-material">
                <input id="login-password" type="text" name="lname" required data-msg="Please enter your last name" class="input-material">
                <label for="login-password" class="label-material">Last Name</label>
              </div>
              
              <div class="form-group-material">
                <input id="login-password" type="text" name="RFTag_id" required data-msg="Please enter your RFID Tag" class="input-material">
                <label for="login-password" class="label-material">RFID Tag</label>
              <a href="#" title="Get confirmation code to system administrator..." class="forgot-pass">What is a <strong>RFID Tag</strong>?</a>
              </div>
              
              <div class="form-group text-center">
              <a href="index.php" class="btn btn-default" style="color: black;">Cancel</a>
              <button name="stepOneNxt" class="btn btn-primary">Next</button>
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