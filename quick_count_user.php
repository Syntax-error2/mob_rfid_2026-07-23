 <section class="statistics">
         <div class="container-fluid">
         <h1>YEARLY SUMMARY</h1>
          <div class="row d-flex">
            <div class="col-lg-2">
              <!-- User Actibity-->
              <div class="card user-activity">
                <h2 class="display h4">PRESENT</h2>
                <div class="number"><?php echo $total_yearly_present; ?></div>
                <h3 class="h4 display">Total</h3>
                
                <div class="page-statistics d-flex justify-content-between">
                  <div class="page-statistics-left"><span>AM</span><strong><?php echo $total_yearly_present_AM; ?></strong></div>
                  <div class="page-statistics-right"><span>PM</span><strong><?php echo $total_yearly_present_PM; ?></strong></div>
                </div>
              </div>
            </div>
            
            
            <div class="col-lg-3">
              <!-- User Actibity-->
              <div class="card user-activity">
                <h2 class="display h4">LATE <strong style="font-size: small;"><?php echo $total_yearly_late_num; ?> time(s)</strong></h2>
                <div class="number"><?php echo $late_in_hr.':'.$late_in_min; ?> <strong style="font-size: medium;">[ <?php echo $total_yearly_late_min; ?> min. ]</strong></div>
                <h3 class="h4 display">Total Time</h3>
                
                <div class="page-statistics d-flex justify-content-between">
                  <div class="page-statistics-left"><span>AM</span><strong><?php echo $total_yearly_late_AM; ?></strong></div>
                  <div class="page-statistics-right"><span>PM</span><strong><?php echo $total_yearly_late_PM; ?></strong></div>
                </div>
              </div>
            </div>
            
          
            <div class="col-lg-3">
              <!-- User Actibity-->
              <div class="card user-activity">
                <h2 class="display h4">UNDERTIME <strong style="font-size: small;"><?php echo $total_yearly_uTime_num; ?> time(s)</strong></h2>
                <div class="number"><?php echo $uTime_in_hr.':'.$uTime_in_min; ?> <strong style="font-size: medium;">[ <?php echo $total_yearly_uTime_min; ?> min. ]</strong></div>
                <h3 class="h4 display">Total Time</h3>
                
                <div class="page-statistics d-flex justify-content-between">
                  <div class="page-statistics-left"><span>AM</span><strong><?php echo $total_yearly_uTime_AM; ?></strong></div>
                  <div class="page-statistics-right"><span>PM</span><strong><?php echo $total_yearly_uTime_PM; ?></strong></div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-2">
              <!-- User Actibity-->
              <div class="card user-activity">
                <h2 class="display h4">ABSENT</h2>
                <div class="number"><?php echo $total_yearly_absent; ?></div>
                <h3 class="h4 display">Total</h3>
                
                <div class="page-statistics d-flex justify-content-between">
                  <div class="page-statistics-left"><span>AM</span><strong><?php echo $total_yearly_absent_AM; ?></strong></div>
                  <div class="page-statistics-right"><span>PM</span><strong><?php echo $total_yearly_absent_PM; ?></strong></div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-2">
              <!-- User Actibity-->
              <div class="card user-activity">
             
                <h2 class="display h4">LEAVE</h2>
                <div class="number"><?php echo $total_yearly_leave-$total_used_leave; ?></div>
                <h3 class="h4 display">Remaining</h3>
                
                <div class="page-statistics d-flex justify-content-between">
                  <div class="page-statistics-left"><span>Total</span><strong><?php echo $total_yearly_leave; ?></strong></div>
                  <div class="page-statistics-right"><span>Used</span><strong><?php echo $total_used_leave; ?></strong></div>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
      </section>