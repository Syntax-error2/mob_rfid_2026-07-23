<?php

include('dbcon.php');
 
if(isset($_POST['stepTwoSignup']))
{
    
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
   
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    $safe_pass=md5($password);
    $salt="a1Bz20ydqelm8m1wql";
    $final_pass=$salt.$safe_pass;
        
    $personnel_id=$_POST['personnel_id'];
    $do_id=$_POST['do_id'];
    
    
    $perDataCHK_query = $conn->query("SELECT * FROM useraccount WHERE personnel_id='$personnel_id' OR (fname='$fname' AND lname='$lname') OR (username='$username' AND password='$final_pass')") or die(mysql_error());
    if($perDataCHK_query->rowCount()>0){
        
         ?>
 
        <script>
        window.alert('User already exist...');
        window.location='index.php'; 
        </script>    
        
        <?php

    }else{ 
        
        
    $conn->query("INSERT INTO useraccount(school_id, personnel_id, fname, lname, email, username, password, access, do_id)
    VALUES('1', '$personnel_id', '$fname', '$lname', '$email', '$username', '$final_pass', 'User', '$do_id')");
    
    
    ?>
    
        <script>
        window.alert('Success! You can login your account.');
        window.location='index.php';
        </script>
    
    
    
    <?php   } } ?>
    
<?php

if(isset($_POST['sendFUA']))
{

        function randomcode() {
        $var = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $code = '';
        while ($i <= 9) {
        $num = rand() % 33;
        $tmp = substr($var, $num, 1);
        $code = $code . $tmp;
        $i++;
        }
        return $code;
        }
         
    $conf_code=randomcode();
        
    $mobileNumber=$_POST['mobileNumber'];
    $access=$_POST['access'];
    
    $staff_query = $conn->query("SELECT * FROM staff WHERE mobileNumber='$mobileNumber' ORDER BY lname, fname ASC") or die(mysql_error());
    
    
    if($staff_query->rowCount()>0){
    $staff_row = $staff_query->fetch();
    
    $chk_user_query = $conn->query("SELECT * FROM useraccount WHERE staff_id='$staff_row[staff_id]' AND access='$access'");
    if($chk_user_query->rowCount()>0){
        
    
    
    $chk_user_row = $chk_user_query->fetch();
    
    
                                if($staff_row['extension']=="")
                                {
                                    if($staff_row['suffix']=="-")
                                    {
                                        
                                    $classAdviser=$staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname'];
                                    
                                    }else{
                                        
                                    $classAdviser=$staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname']." ".$staff_row['suffix'].", ".$staff_row['extension'];
                                    
                                    }
                                
                                
                              
                                }else{
                                    
                                    
                                    if($staff_row['suffix']=="-")
                                    {
                                        
                                    $classAdviser=$staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname'].", ".$staff_row['extension'];
                                    
                                    }else{
                                        
                                    $classAdviser=$staff_row['fname']." ".substr($staff_row['mname'], 0,1).". ".$staff_row['lname']." ".$staff_row['suffix'].", ".$staff_row['extension'];
                                    
                                    }
                                     
                                
                                }
                                
    $messageText='STC BAUAN '."\r\r".'Good day! '.$classAdviser.', please take note your RAS login data below.'."\r\r".'Username: '.$chk_user_row['username']."\r\r".'Password: '.$chk_user_row['password']."\r\r".'Happy to serve you!'."\r\r".'Regards,'."\r".'RAS Account Helper'."\r\r".'Please do not reply.'."\r".'Ref: RASAH'.substr($conf_code, 0,5);
    
    //save to sms server =x=x=x=x=x=x=x=x=x=x=x

    $conn->query("INSERT INTO messageout(MessageTo, MessageText)VALUES('$mobileNumber', '$messageText')");
    
    ?>
    
    <script>
    
    window.alert('Request sent! Please wait for the SMS from RAS Account Helper.');
    window.location='index.php';
    
    </script>
    
    <?php
    
    }else{
    ?>
    
    <script>
    
    window.alert('User access not matched... Please try again.');
    window.location='index.php';
    
    </script>
    
    <?php
    }
    
    
    }else{
?>

<script>

window.alert('Mobile Number not found/Incorrect format... Please try again with registered & valid format mobile number.');
window.location='index.php';

</script>

<?php
    }

}
    