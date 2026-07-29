    
    
    <?php
  
  
    $day=date("l"); //Mon-Sun
    
    $studData_query = $conn->query("select * FROM personnels WHERE personnel_id='$user_personnel_id'") or die(mysql_error());
    $studData_row=$studData_query->fetch();
                    
    if(isset($_POST['filterDate'])){
    $filterDate=$_POST['reportDate'];
     
    }else{
        
    $filterDate=date('m/Y');
   
    }
    
    if(isset($_POST['print_daily_LV'])){ ?>
    
    <script>
    window.open('print_daily_preview_LogValidation.php?dateFrom=<?php echo $filterDate; ?>', '_blank');
    window.location='home.php';
    </script>
    
    
    <?php } ?>
    
    <style>

     
    
    * {
      box-sizing: border-box;
    }
    
    
    #myTable {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #ddd;
      font-size: 12px;
    }
    
    #myTable th, #myTable td {
      text-align: left;
      padding: 6px;
    }
    
    #myTable tr, td {
      border: 1px solid #ddd;
      
    }
    
    #myTable tr.header, #myTable tr:hover {
      background-color: #f1f1f1;
    }
    
    .pb{
        page-break-after: always;
         
    }
    </style>

    
    
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li style="color: blue"><strong style="margin-right: 4px;"><?php echo $schoolName; ?> | </strong></li>
             
            <li class="breadcrumb-item active">Home</li>
          </ul>
        </div>
      </div>
      
      
      
      
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
            <!-- kinder 1     -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  
                  <table>
                  <tr style="border: none;">
                  
                  <td style="border: none;">
                  <h4>MONTHLY LOG DATA TABLE</h4>
                  </td>
                  
                  
                  
                  <td style="border: none;">&nbsp;</td>
                  <form method="POST">
      
                  <td style="border: none;">&nbsp;</td>
                  <td style="border: none;">
                  <select name="reportDate" class="form-control">
                  <option><?php echo $filterDate; ?></option>
                   
                  <?php
                  $currentDate="";
                  $opt_query = $conn->query("SELECT DISTINCT logDate FROM personnel_logs WHERE RFTag_id='$studData_row[RFTag_id]' ORDER BY logDate DESC") or die(mysql_error());
                  while ($opt_row = $opt_query->fetch()) 
                  { 
                    if($filterDate==substr($opt_row['logDate'], 0,2).'/'.substr($opt_row['logDate'], 6,4)){
                        
                    }else{ ?>
                    
                    <option><?php echo substr($opt_row['logDate'], 0,2).'/'.substr($opt_row['logDate'], 6,4); ?></option>
                    
                    <?php
                    
                    $currentDate=$opt_row['logDate'];
                    
                    } } ?>
                  </select>
                  </td>
                  <td style="border: none;">&nbsp;</td>
                  <td style="border: none;"><button name="filterDate" class="btn btn-primary" title="Filter Date"><i class="fa fa-filter"></i></button></td>
                  
                  <td style="border: none;">&nbsp;</td>
                  <!-- <td style="border: none;"><button name="print_daily_LV" class="btn btn-info" style="color: white;" title="Print daily log validation list..."><i class="fa fa-print"></i></button></td>-->
                  </tr>
                  </table>
                  </form>
                  <a data-toggle="collapse" data-parent="#new-updates" href="#updates-boxContacts" aria-expanded="true" aria-controls="updates-boxContacts"><i class="fa fa-angle-down"></i></a>
                </div>
                
                
                
                
                
                <div id="updates-boxContacts" role="tabpanel" class="collapse show">
                
                    <?php
                    
                      
                      $selectedMM=substr($filterDate, 0,2);
                      $selectedYYYY=substr($filterDate, 3,4);
                      $grandTotalTRHr=0;
                      $grandTotalTRMin=0;
                      
                      $grandTotalamLateMin=0;
                      $grandTotalpmLateMin=0;
                      
                      $grandTotalamUTimeMin=0;
                      $grandTotalpmUTimeMin=0;
                      
                      
                if($selectedMM=="01")
                {
                    
                    $mmWords="January";
                    $MMmaxDay=32;
                }
                
                if($selectedMM=="02")
                {
                    $mmWords="February";
                    
                    $leap = date('L', mktime(0, 0, 0, 1, 1, $selectedYYYY));
            
                    if($leap==0)
                    {
                    $MMmaxDay=29;    
                    }else{
                    $MMmaxDay=30;        
                    }
                    
                }
                
                
                if($selectedMM=="03")
                {
                    $mmWords="March";
                    $MMmaxDay=32;    
                }
                
                
                if($selectedMM=="04")
                {
                    $mmWords="April";
                    $MMmaxDay=31;    
                }
                
                
                if($selectedMM=="05")
                {
                    $mmWords="May";
                    $MMmaxDay=32;

                }
                
                
                if($selectedMM=="06")
                {
                    $mmWords="June";
                    $MMmaxDay=31;
                }
                
                
                
                if($selectedMM=="07")
                {
                    $mmWords="July";
                    $MMmaxDay=32;
                }
                
                
                if($selectedMM=="08")
                {
                    $mmWords="August";
                    $MMmaxDay=32;
                }
                
                
                if($selectedMM=="09")
                {
                    $mmWords="September";
                    $MMmaxDay=31;
                }
                
                
                if($selectedMM=="10")
                {
                    $mmWords="October";
                    $MMmaxDay=32;
                }
                
                
                if($selectedMM=="11")
                {
                    $mmWords="November";
                    $MMmaxDay=31;
                }
                
                
                if($selectedMM=="12")
                {
                    $mmWords="December";
                    $MMmaxDay=32;
                }
                
                ?>
                    
   
                    <table id="myTable">
                    
                      <tr style="font-weight: light; font-size: 14px">
                        
                        <td style="width:8%;"><center><strong>DATE</strong></center></td>
                        
                        <td style="width:18%;"><center><strong>AM IN</strong></center></td>
                        <td style="width:18%;"><center><strong>AM OUT</strong></center></td>
                        <td style="width:18%;"><center><strong>PM IN</strong></center></td>
                        <td style="width:18%;"><center><strong>PM OUT</strong></center></td>
                        <td style="width:10%;"><center><strong>TARDINESS</strong></center></td>
                        <td style="width:10%;"><center><strong>UNDERTIME</strong></center></td>
                      </tr>
                     
                    <?php
                     
                        $RFTag_id=$studData_row['RFTag_id'];
                     
                        $amPresentCtr=0;
                        $pmPresentCtr=0;
                        
                        $amLateCtr=0;
                        $pmLateCtr=0;
                        
                        $amUTimeCtr=0;
                        $pmUTimeCtr=0;
                        
                        $amAbsentCtr=0;
                        $pmAbsentCtr=0;
                        
                        $leaveCtr=0;
                        
                        
                        for($d=1; $d<$MMmaxDay; $d++){
                            
                            $dailyLate=0;
                            $dailyUTime=0;
                            if($d<10){
                            $logDateCtr=$selectedMM.'/0'.$d.'/'.$selectedYYYY;
                            }else{
                            $logDateCtr=$selectedMM.'/'.$d.'/'.$selectedYYYY;
                            }
                     
                        ?>
                        
                      <tr>
                     
                        
                        <?php
                      $SC_query3 = $conn->query("select * FROM activity_calendar WHERE completeDate='$logDateCtr' AND status='Display to DTR'") or die(mysql_error());
                          
                          if($SC_query3->rowCount()>0){
                          
                      ?>
                      <td rowspan="2">
                        <?php
                        
                        $timestamp = strtotime($logDateCtr);
                        $dayName=date('l', $timestamp);
                        $dayName2=substr($dayName, 0,3);
                        echo substr($logDateCtr, 0, 6).substr($logDateCtr, 8, 2)." <sup>".$dayName2."</sup>";
                        
                        ?>
                        </td>
                      <?php }else{?>
                      <td>
                        <?php
                        
                        $timestamp = strtotime($logDateCtr);
                        $dayName=date('l', $timestamp);
                        $dayName2=substr($dayName, 0,3);
                        echo substr($logDateCtr, 0, 6).substr($logDateCtr, 8, 2)." <sup>".$dayName2."</sup>";
                        
                        ?>
                        </td>
                      <?php } ?>
                      
                         
                        
                        
                        <?php
                        
                        $studLogs_remarks_query = $conn->query("select * FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logDate='$logDateCtr' AND (remarks!='' AND remarks!='Updated' AND remarks!='Inserted')") or die(mysql_error());
                        if($studLogs_remarks_query->rowCount()>0){ 
                        $SRQ_row=$studLogs_remarks_query->fetch();
                        $leaveCtr=$leaveCtr+1;
                        
                        ?> 
                        <td colspan="7" style="background-color: #b8ffd9;"><center><strong><?php echo $SRQ_row['remarks']; ?></strong></center></td>
                         
                          <?php }else{
                            
                        $studLogs_sat_query = $conn->query("select * FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logDate='$logDateCtr'") or die(mysql_error());
                        if($studLogs_sat_query->rowCount()==0 AND ($dayName2=='Sat' OR $dayName2=='Sun')){ ?> 
                        
                        <td colspan="6" style="background-color: #ececec;"><center><strong><?php if($dayName2=='Sat'){ echo "S A T U R D A Y"; } if($dayName2=='Sun'){ echo "S U N D A Y"; } ?></strong></center></td>
                         
                          <?php }else{
                         
                          $SC_query = $conn->query("select * FROM activity_calendar WHERE completeDate='$logDateCtr' AND status!='Display to DTR'") or die(mysql_error());
                          
                          if($SC_query->rowCount()>0){
                          $SC_row=$SC_query->fetch();
                          ?>
                            
                          <td colspan="6" style="background-color: #ffbac5;"><center><strong><?php echo $SC_row['event_title'].'</strong> [ '.$SC_row['act_type'].' ]'; ?></strong></center></td>
                          
                          <?php }else{ ?> 
                     
                        
                        
                        <!-- AM IN -->
                        <td>
                        <?php
                        $studLogs_query_AM_IN = $conn->query("select * FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logFlow='AM IN' AND logDate='$logDateCtr'") or die(mysql_error());
                        $studLogs_AM_IN_row=$studLogs_query_AM_IN->fetch();
                        ?>
                        
                        <?php
                        if($studLogs_query_AM_IN->rowCount()>0){
                        
                        $str_time_am_in= date("H:i:s", strtotime($studLogs_AM_IN_row['logTime']));
                        $str_time_am_in = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_am_in);
                        sscanf($str_time_am_in, "%d:%d:%d", $hours, $minutes, $seconds);
                        $time_seconds_time_am_in = ($hours * 3600) + $minutes * 60 + $seconds;
                            
                        ?>
                        
                        
                        <?php
                        if($studLogs_AM_IN_row['late_status']==='on'){
                            
                            $sched_query = $conn->query("SELECT am_IN_co FROM time_schedules WHERE school_id='$school_id' AND do_id='$studData_row[do_id]' AND shift_id='$studData_row[shift_id]' AND day='$dayName'") or die(mysql_error());
                            $sq_row=$sched_query->fetch();
                     
                            $str_time_sched_am_in_late= date("H:i:s", strtotime($sq_row['am_IN_co']));
                            $str_time_sched_am_in_late = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_sched_am_in_late);
                            sscanf($str_time_sched_am_in_late, "%d:%d:%d", $hours, $minutes, $seconds);
                            $time_seconds_time_am_in_late = ($hours * 3600) + $minutes * 60 + $seconds;
                            
                            $am_in_late_min=($time_seconds_time_am_in-$time_seconds_time_am_in_late)/60;
                            
                            $grandTotalamLateMin=$grandTotalamLateMin+$am_in_late_min;
                            
                            $amLateCtr=$amLateCtr+1;
                            $amPresentCtr=$amPresentCtr+1;
                            
                            $dailyLate=$dailyLate+$am_in_late_min;
                            ?>
                            <p style="background-color: #ffe57e; margin: 0px;">&nbsp;<i class="fa fa-check"></i>&nbsp;&nbsp;Late [ <?php echo $studLogs_AM_IN_row['logTime']; ?> ]</p>
                        <?php }else{ 
                            
                            $dailyLate=$dailyLate+0;
                            $amPresentCtr=$amPresentCtr+1;
                            
                            ?>
                            <p style="background-color: white; margin: 0px;"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ <?php echo $studLogs_AM_IN_row['logTime']; ?> ]</p>
                        <?php } ?>
                    
                        <!-- time in seconds AM_IN -->
                        <?php
                        
                        
                        
                        
                        
                        ?>
                        
                        <?php }else{ $time_seconds_time_am_in=0;  
                        
                           $amAbsentCtr=$amAbsentCtr+1; ?>
                           
                            <p style="margin: 0px;">--:--</p>   
                        <?php } ?>
                        
                        </td>
                        
                        
                        <!-- AM OUT -->
                        <td>
                        <?php
                        $studLogs_query_AM_OUT = $conn->query("select * FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logFlow='AM OUT' AND logDate='$logDateCtr'") or die(mysql_error());
                        $studLogs_AM_OUT_row=$studLogs_query_AM_OUT->fetch();
                        ?>
                        
                        <?php
                        if($studLogs_query_AM_OUT->rowCount()>0){ 
                            
                        $str_time_am_out= date("H:i:s", strtotime($studLogs_AM_OUT_row['logTime']));
                        $str_time_am_out = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_am_out);
                        sscanf($str_time_am_out, "%d:%d:%d", $hours, $minutes, $seconds);
                        $time_seconds_time_am_out = ($hours * 3600) + $minutes * 60 + $seconds;
                        
                        ?>
                        
                        <?php
                        if($studLogs_AM_OUT_row['late_status']==='on'){
                            
                            $sched_query = $conn->query("SELECT am_OUT FROM time_schedules WHERE school_id='$school_id' AND do_id='$studData_row[do_id]' AND shift_id='$studData_row[shift_id]' AND day='$dayName'") or die(mysql_error());
                            $sq_row=$sched_query->fetch();
                            
                            $str_time_sched_am_out_utime= date("H:i:s", strtotime($sq_row['am_OUT']));
                            $str_time_sched_am_out_utime = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_sched_am_out_utime);
                            sscanf($str_time_sched_am_out_utime, "%d:%d:%d", $hours, $minutes, $seconds);
                            $time_seconds_time_am_out_utime = ($hours * 3600) + $minutes * 60 + $seconds;
                            
                            $am_out_utime_min=($time_seconds_time_am_out_utime-$time_seconds_time_am_out)/60;
                            
                            $grandTotalamUTimeMin=$grandTotalamUTimeMin+$am_out_utime_min;
                            
                            $amUTimeCtr=$amUTimeCtr+1;
                            
                            $dailyUTime=$dailyUTime+$am_out_utime_min;
                                
                        ?>
                            <p style="background-color: #ffe57e; margin: 0px;">&nbsp;<i class="fa fa-check"></i>&nbsp;&nbsp;Undertime [ <?php echo $studLogs_AM_OUT_row['logTime']; ?> ]</p>
                        <?php }else{
                            
                            $dailyUTime=$dailyUTime+0; ?>
                            
                            <p style="background-color: white; margin: 0px;"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ <?php echo $studLogs_AM_OUT_row['logTime']; ?> ]</p>
                        
                        <?php } ?>
                    
                        <!-- time in seconds AM_OUT -->
                        
                        
                        <?php }else{ $time_seconds_time_am_out=0; 
                        
                        $studLogs_query_PM_OUT_chk = $conn->query("select * FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logFlow='PM OUT' AND logDate='$logDateCtr'") or die(mysql_error());
                        
                        if($studLogs_query_PM_OUT_chk->rowCount()>0 AND $studLogs_query_AM_IN->rowCount()>0){ }else{ ?>
                        
                        <p style="margin: 0px;">--:--</p>   
                        
                        <?php } } ?>
                        
                        
                        </td>
                        
                        
                        <!-- PM IN -->
                        <td>
                        <?php
                        $studLogs_query_PM_IN = $conn->query("select * FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logFlow='PM IN' AND logDate='$logDateCtr'") or die(mysql_error());
                        $studLogs_PM_IN_row=$studLogs_query_PM_IN->fetch();
                        ?>
                        
                        <?php
                        if($studLogs_query_PM_IN->rowCount()>0){ ?>
                        
                        <!-- time in seconds PM_IN -->
                        <?php
                        
                        $str_time_pm_in= date("H:i:s", strtotime($studLogs_PM_IN_row['logTime']));
                        $str_time_pm_in = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_pm_in);
                        sscanf($str_time_pm_in, "%d:%d:%d", $hours, $minutes, $seconds);
                        $time_seconds_time_pm_in = ($hours * 3600) + $minutes * 60 + $seconds;
                        
                        ?>
                        
                        <?php
                        if($studLogs_PM_IN_row['late_status']==='on'){
                            
                            $sched_query = $conn->query("SELECT pm_IN_co FROM time_schedules WHERE school_id='$school_id' AND do_id='$studData_row[do_id]' AND shift_id='$studData_row[shift_id]' AND day='$dayName'") or die(mysql_error());
                            $sq_row=$sched_query->fetch();
                     
                            $str_time_sched_pm_in_late= date("H:i:s", strtotime($sq_row['pm_IN_co']));
                            $str_time_sched_pm_in_late = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_sched_pm_in_late);
                            sscanf($str_time_sched_pm_in_late, "%d:%d:%d", $hours, $minutes, $seconds);
                            $time_seconds_time_pm_in_late = ($hours * 3600) + $minutes * 60 + $seconds;
                            
                            $pm_in_late_min=($time_seconds_time_pm_in-$time_seconds_time_pm_in_late)/60;
                            
                            $grandTotalpmLateMin=$grandTotalpmLateMin+$pm_in_late_min;
                            
                            $pmLateCtr=$pmLateCtr+1;
                            $pmPresentCtr=$pmPresentCtr+1;
                            
                            
                            $dailyLate=$dailyLate+$pm_in_late_min;
                            ?>
                            <p style="background-color: #ffe57e; margin: 0px;">&nbsp;<i class="fa fa-check"></i>&nbsp;&nbsp;Late [ <?php echo $studLogs_PM_IN_row['logTime']; ?> ]</p>
                        <?php }else{ 
                            $dailyLate=$dailyLate+0;
                            $pmPresentCtr=$pmPresentCtr+1;
                            
                            ?>
                            <p style="background-color: white; margin: 0px;"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ <?php echo $studLogs_PM_IN_row['logTime']; ?> ]</p>
                        <?php } ?>
                     
                        <?php }else{ $time_seconds_time_pm_in=0; ?>
                        
                        <?php
                        
                        $studLogs_query_PM_OUT_chk = $conn->query("select * FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logFlow='PM OUT' AND logDate='$logDateCtr'") or die(mysql_error());
                        
                        if($studLogs_query_PM_OUT_chk->rowCount()>0 AND $studLogs_query_AM_IN->rowCount()>0){ $pmPresentCtr=$pmPresentCtr+1; }else{ 
                            
                            $pmAbsentCtr=$pmAbsentCtr+1;
                            
                            ?>
                        
                        <p style="margin: 0px;">--:--</p>   
                        
                        <?php } } ?>
                        
                        </td>
                        
                        
                        <!-- PM OUT -->
                        <td>
                        <?php
                        $studLogs_query_PM_OUT = $conn->query("select * FROM personnel_logs WHERE RFTag_id='$RFTag_id' AND logFlow='PM OUT' AND logDate='$logDateCtr'") or die(mysql_error());
                        $studLogs_PM_OUT_row=$studLogs_query_PM_OUT->fetch();
                        ?>
                        
                        <?php
                        if($studLogs_query_PM_OUT->rowCount()>0){ 
                        
                        $str_time_pm_out= date("H:i:s", strtotime($studLogs_PM_OUT_row['logTime']));
                        $str_time_pm_out = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_pm_out);
                        sscanf($str_time_pm_out, "%d:%d:%d", $hours, $minutes, $seconds);
                        $time_seconds_time_pm_out = ($hours * 3600) + $minutes * 60 + $seconds;
                         
                        if($studLogs_PM_OUT_row['late_status']=="on"){
                            
                            $sched_query = $conn->query("SELECT pm_OUT FROM time_schedules WHERE school_id='$school_id' AND do_id='$studData_row[do_id]' AND shift_id='$studData_row[shift_id]' AND day='$dayName'") or die(mysql_error());
                            $sq_row=$sched_query->fetch();
                            
                            $str_time_sched_pm_out_utime= date("H:i:s", strtotime($sq_row['pm_OUT']));
                            $str_time_sched_pm_out_utime = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_sched_pm_out_utime);
                            sscanf($str_time_sched_pm_out_utime, "%d:%d:%d", $hours, $minutes, $seconds);
                            $time_seconds_time_pm_out_utime = ($hours * 3600) + $minutes * 60 + $seconds;
                            
                            $pm_out_utime_min=($time_seconds_time_pm_out_utime-$time_seconds_time_pm_out)/60;
                            
                            $grandTotalpmUTimeMin=$grandTotalpmUTimeMin+$pm_out_utime_min;
                            
                            $pmUTimeCtr=$pmUTimeCtr+1;
                            
                            $dailyUTime=$dailyUTime+$pm_out_utime_min;
                                
                        ?>
                            <p style="background-color: #ffe57e; margin: 0px;">&nbsp;<i class="fa fa-check"></i>&nbsp;&nbsp;Undertime [ <?php echo $studLogs_PM_OUT_row['logTime']; ?> ]</p>
                        <?php }else{
                            
                        $dailyUTime=$dailyUTime+0;
                        
                        ?>
                            <p style="background-color: white; margin: 0px;"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ <?php echo $studLogs_PM_OUT_row['logTime']; ?> ]</p>
                        <?php } ?>
                        
                        
                        <!-- time in seconds PM_OUT -->
                        <?php }else{ $time_seconds_time_pm_out=0; ?>
                        
                            <p style="margin: 0px;">--:--</p>  
                             
                        <?php } ?>
                        
                        </td>
                        
                        
                        <?php
                        $SC_query3 = $conn->query("select * FROM activity_calendar WHERE completeDate='$logDateCtr' AND status='Display to DTR'") or die(mysql_error());
                        if($SC_query3->rowCount()>0){
                            
                        ?>
                        <!-- Late -->
                        <td rowspan="2">
                        
                        <?php echo $dailyLate.' minute(s)'; ?>
                    
                        </td>
                        <!-- end Late -->
                        
                        
                        <!-- Undertime -->
                        <td rowspan="2">
                        <?php echo $dailyUTime.' minute(s)'; ?>
                        </td>
                        <!-- end Undertime -->
                      <?php }else{?>
                        <!-- Late -->
                        <td>
                        
                        <?php echo $dailyLate.' minute(s)'; ?>
                    
                        </td>
                        <!-- end Late -->
                        
                        
                        <!-- Undertime -->
                        <td>
                        <?php echo $dailyUTime.' minute(s)'; ?>
                        </td>
                        <!-- end Undertime -->
                      <?php } ?>
                      
                        
                        <?php } } } ?>
                        
                      <?php
                      $SC_query4 = $conn->query("select * FROM activity_calendar WHERE completeDate='$logDateCtr' AND status='Display to DTR'") or die(mysql_error());
                          
                          if($SC_query4->rowCount()>0){
                         
                      ?>
                        
                     
                      <?php }else{ ?>
                      
                       
                      
                      <?php } ?>
                      </tr>
                      
                      <?php
                      $SC_query2 = $conn->query("select * FROM activity_calendar WHERE completeDate='$logDateCtr' AND status='Display to DTR'") or die(mysql_error());
                          
                          if($SC_query2->rowCount()>0){
                          $SC_row2=$SC_query2->fetch();
                      ?>
                      <tr>
                       
                        <td colspan="4" style="background-color: #b8ffd9;"><center><small><?php echo strtoupper($SC_row2['event_title']); ?></small></center></td>
                     
                      </tr>
                      <?php } ?>
                    <?php } ?>
                    
                    
                    <?php
                    
                    $grandTotalLateMin=$grandTotalamLateMin+$grandTotalpmLateMin;
                    $final_lateHr=$grandTotalLateMin/60;
                    $final_lateHr=substr($grandTotalLateMin/60, 0,1);
                    
                    $final_lateMin=substr($grandTotalLateMin/60, 1)/100*60;
                    $final_lateMin=number_format($final_lateMin, 2, '.', '');
                    
                    $final_lateMin=substr($final_lateMin, 2);
                     
                    
                    
                    $grandTotalUTimeMin=$grandTotalamUTimeMin+$grandTotalpmUTimeMin;
                    $final_uTimeHr=$grandTotalUTimeMin/60;
                    $final_uTimeHr=substr($grandTotalUTimeMin/60, 0,1);
                    
                    $final_uTimeMin=substr($grandTotalUTimeMin/60, 1)/100*60;
                    $final_uTimeMin=number_format($final_uTimeMin, 2, '.', '');
                    $final_uTimeMin=substr($final_uTimeMin, 2);
                     
                    
                    
                    ?>
                    
                    
                    <tr>
                    <td colspan="5"><strong class="pull-right">TOTAL</strong></td>
                    <td style="background-color: lightgoldenrodyellow;"><strong><?php echo $grandTotalLateMin; ?> minute(s)</strong></td>
                    <td style="background-color: lightgoldenrodyellow;"><strong><?php echo $grandTotalUTimeMin; ?> minute(s)</strong></td>
                    </tr>
                    
                    
                    
                    
                    
                    
                    <tr>
                    <td colspan="7">
                    <table id="myTable">
                    <thead>
                    <tr>
                    <th colspan="15"><center>M O N T H L Y &nbsp;&nbsp;&nbsp; S U M M A R Y</center></th>
                    </tr>
                    </thead>
                     
                    
                     
                    
                    <tbody>
                    
                    <tr>
                    <td colspan="3"><strong>Days Present</strong></td>
                    <td colspan="4"><strong>Late</strong></td>
                    <td colspan="4"><strong>Undertime</strong></td>
                    <td colspan="3"><strong>Days Absent</strong></td>
                    <td><strong><center>Days Leave</center></strong></td>
                    </tr>
                    
                    
                    <tr>
                    <td style="width: 7%;">AM</td>
                    <td style="width: 7%;">PM</td>
                    <td style="width: 7%;">Total</td>
                    
                    <td style="width: 4%;">AM</td>
                    <td style="width: 4%;">PM</td>
                    <td style="width: 4%;">Total #</td>
                    <td style="width: 12%;">Total Time</td>
                    
                    <td style="width: 4%;">AM</td>
                    <td style="width: 4%;">PM</td>
                    <td style="width: 4%;">Total #</td>
                    <td style="width: 12%;">Total Time</td>
                    
                    <td style="width: 7%;">AM</td>
                    <td style="width: 7%;">PM</td>
                    <td style="width: 7%;">Total</td>
                    
                    <td rowspan="2" style="width: 10%; font-size: 24px;"><center><strong><?php echo $leaveCtr; ?></strong></center></td>
                    </tr>
                    
                    
                    <tr>
                    <td><?php echo $amPresentCtr; ?></td>
                    <td><?php echo $pmPresentCtr; ?></td>
                    <td><?php echo ($amPresentCtr+$pmPresentCtr)/2 ?></td>
                    
                    <td><?php echo $amLateCtr; ?></td>
                    <td><?php echo $pmLateCtr; ?></td>
                    <td><?php echo ($amLateCtr+$pmLateCtr); ?></td>
                    <td><?php echo  $grandTotalLateMin.' min(s) or <br /> '.$final_lateHr.':'.$final_lateMin; ?> hr(s) </td>
                    
                    <td><?php echo $amUTimeCtr; ?></td>
                    <td><?php echo $pmUTimeCtr; ?></td>
                    <td><?php echo ($amUTimeCtr+$pmUTimeCtr); ?></td>
                    <td><?php echo  $grandTotalUTimeMin.' min(s) or <br /> '.$final_uTimeHr.':'.$final_uTimeMin; ?> hr(s) </td>
                    
                    <td><?php echo $amAbsentCtr; ?></td>
                    <td><?php echo $pmAbsentCtr; ?></td>
                    <td><?php echo ($amAbsentCtr+$pmAbsentCtr)/2; ?></td>
                    
                    
                    
                    <?php
                    
                    $tot_num_present=($amPresentCtr+$pmPresentCtr)/2;
                    
                    $tot_num_late=($amLateCtr+$pmLateCtr)/2;
                    $tot_TimeLate=$final_lateHr.':'.$final_lateMin;
                    
                    $tot_num_uTime=($amUTimeCtr+$pmUTimeCtr)/2;
                    $totTimeUtime=$final_lateHr.':'.$final_lateMin;
                    
                    $tot_num_absent=($amAbsentCtr+$pmAbsentCtr)/2;
                    
                    
                    
                    $YDS_query = $conn->query("SELECT yDTRs_id FROM yearly_dtr_summary WHERE personnel_id='$user_personnel_id' AND ys_month='$selectedMM' AND ys_year='$selectedYYYY'") or die(mysql_error());
                    
                    if($YDS_query->rowCount()>0){
                    
                    $YDS_row=$YDS_query->fetch();
                    
                    $conn->query("UPDATE yearly_dtr_summary SET
                    
                 
                    personnel_id='$user_personnel_id',
                    ys_month='$selectedMM',
                    ys_year='$selectedYYYY',
                 
                    day_present_AM='$amPresentCtr',
                    day_present_PM='$pmPresentCtr',
                    day_present_Total='$tot_num_present',
                    
                    late_AM='$amLateCtr',
                    late_PM='$pmLateCtr',
                    late_Total_num='$tot_num_late',
                    late_Total_mins='$grandTotalLateMin',
                    late_Total_time='$tot_TimeLate',
 
                    
                    
                   	uTime_AM='$amUTimeCtr',
                   	uTime_PM='$pmUTimeCtr',
                   	uTime_Total_num='$tot_num_uTime',
                   	uTime_Total_mins='$grandTotalUTimeMin',
                   	uTime_Total_time='$totTimeUtime',
                    
                    day_absent_AM='$amAbsentCtr',
                    day_absent_PM='$pmAbsentCtr',
                    day_absent_Total='$tot_num_absent',
                    
                    total_num_leave='$leaveCtr' WHERE yDTRs_id='$YDS_row[yDTRs_id]'");
                    
                    
                    }else{
                     
                    $conn->query("INSERT INTO yearly_dtr_summary
                    
                    (
                    personnel_id,
                    ys_month,
                    ys_year,
                    
                    day_present_AM,
                    day_present_PM,
                    day_present_Total,
                    
                    late_AM,
                    late_PM,
                    late_Total_num,
                    late_Total_mins,
                    late_Total_time,
                    
                   	uTime_AM,
                   	uTime_PM,
                   	uTime_Total_num,
                   	uTime_Total_mins,
                   	uTime_Total_time,
                    
                    day_absent_AM,
                    day_absent_PM,
                    day_absent_Total,
                    
                    total_num_leave
                    )
                    
                    VALUES
                    
                    (
                    '$user_personnel_id',
                    '$selectedMM',
                    '$selectedYYYY',
                    
                    '$amPresentCtr',
                    '$pmPresentCtr',
                    '$tot_num_present',
                    
                    '$amLateCtr',
                    '$pmLateCtr',
                    '$tot_num_late',
                    '$grandTotalLateMin',
                    '$tot_TimeLate',
                    
                    '$amUTimeCtr',
                    '$pmUTimeCtr',
                    '$tot_num_uTime',
                    '$grandTotalUTimeMin',
                    '$totTimeUtime',
                    
                    '$amAbsentCtr',
                    '$pmAbsentCtr',
                    '$tot_num_absent',
                    
                    '$leaveCtr'
                    )");
                    
                    }
                    
                    
                    ?>
                
                 
                    </tr>
 
                     
                    </tbody>
                    </table>
                    
                    </td>
                    </tr>
                    </table>
              
 
 
  
                </div>
              </div>
              <!-- kinder End-->
                </div>
            </div>
        </div>
     </section>
      
     <?php
     
     $total_yearly_present_AM=0;
     $total_yearly_present_PM=0;
     $total_yearly_present=0;
     
     $total_yearly_late_AM=0;
     $total_yearly_late_PM=0;
     $total_yearly_late_num=0;
     $total_yearly_late_min=0;
     
     $total_yearly_uTime_AM=0;
     $total_yearly_uTime_PM=0;
     $total_yearly_uTime_num=0;
     $total_yearly_uTime_min=0;
     
     $total_yearly_absent_AM=0;
     $total_yearly_absent_PM=0;
     $total_yearly_absent=0;
     
     $total_yearly_leave=15;
     $total_used_leave=0;
     
     $YDSummary_query = $conn->query("SELECT * FROM yearly_dtr_summary WHERE personnel_id='$user_personnel_id' AND ys_year='$selectedYYYY'") or die(mysql_error());
     while($ydsSummary_row=$YDSummary_query->fetch()){
        
        $total_yearly_present_AM=$total_yearly_present_AM+$ydsSummary_row['day_present_AM'];
        $total_yearly_present_PM=$total_yearly_present_PM+$ydsSummary_row['day_present_PM'];
        $total_yearly_present=$total_yearly_present+$ydsSummary_row['day_present_Total'];
        
        
        $total_yearly_late_AM=$total_yearly_late_AM+$ydsSummary_row['late_AM'];
        $total_yearly_late_PM=$total_yearly_late_PM+$ydsSummary_row['late_PM'];
        $total_yearly_late_min=$total_yearly_late_min+$ydsSummary_row['late_Total_mins'];
        
        
        $total_yearly_uTime_AM=$total_yearly_uTime_AM+$ydsSummary_row['uTime_AM'];
        $total_yearly_uTime_PM=$total_yearly_uTime_PM+$ydsSummary_row['uTime_PM'];
        $total_yearly_uTime_min=$total_yearly_uTime_min+$ydsSummary_row['uTime_Total_mins'];
 
        
        $total_yearly_absent_AM=$total_yearly_absent_AM+$ydsSummary_row['day_absent_AM'];
        $total_yearly_absent_PM=$total_yearly_absent_PM+$ydsSummary_row['day_absent_PM'];
        $total_yearly_absent=$total_yearly_absent+$ydsSummary_row['day_absent_Total'];
        
        $total_used_leave=$total_used_leave+$ydsSummary_row['total_num_leave'];
        
     }
     
     $total_yearly_late_num=$total_yearly_late_AM+$total_yearly_late_PM;
     $total_yearly_uTime_num=$total_yearly_uTime_AM+$total_yearly_uTime_PM;
     
     
     $late_in_hr=$total_yearly_late_min/60;
     
     if($late_in_hr<10){
        $late_in_hr='0'.substr($late_in_hr, 0,1);
     }else{
        $late_in_hr=substr($late_in_hr, 0,2);
     }
     
     
     $late_in_min=$total_yearly_late_min-($late_in_hr*60);
     if($late_in_min<10){
        $late_in_min='0'.substr($late_in_min, 0,1);
     }else{
        $late_in_min=substr($late_in_min, 0,2);
     }
     
     $uTime_in_hr=$total_yearly_uTime_min/60;
     
     if($uTime_in_hr<10){
        $uTime_in_hr='0'.substr($uTime_in_hr, 0,1);
     }else{
        $uTime_in_hr=substr($uTime_in_hr, 0,2);
     }
     
     
     $uTime_in_min=$total_yearly_uTime_min-($uTime_in_hr*60);
     if($uTime_in_min<10){
        $uTime_in_min='0'.substr($uTime_in_min, 0,1);
     }else{
        $uTime_in_min=substr($uTime_in_min, 0,2);
     }
     
     include('quick_count_user.php'); ?>