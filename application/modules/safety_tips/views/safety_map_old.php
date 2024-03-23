<?php
  if(isset($_COOKIE['safety_tip_url']) && !empty($_COOKIE['safety_tip_url'])){
      $explodeVal = explode(',', $_COOKIE['safety_tip_url']);
  }
  if(isset($explodeVal) && !empty($explodeVal) && in_array('shareSafetyTips', $explodeVal) && in_array('shareSafetyMap', $explodeVal)){
      $this->load->view('includes/header');
?>

  <div class="covering my-auto pt-4 pb-4 shareSafetyTips">  
    <div class="container">
      <div class="text mx-auto">

        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="row">

            <div class="col-md-3 pl-0 my-auto">
              <!-- <?php $this->load->view('sidebar'); ?> -->
              <div class="navList1">
                <ul class="nav flex-column"> 
                    <li class="nav-item">     
                        <div class="box active"></div>               
                        <a class="nav-link mo-d-none" href="javascript:void(0);">
                          <?php echo $this->lang->line('safety_location'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="box active"></div>
                        <a class="nav-link" href="javascript:void(0);">
                          <?php echo $this->lang->line('safety_map'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="box"></div>
                        <a class="nav-link mo-d-none" href="javascript:void(0);">
                          <?php echo $this->lang->line('write_safety_tip'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="box"></div>
                        <a class="nav-link mo-d-none" href="javascript:void(0);">
                          <?php echo $this->lang->line('title_safety_tip'); ?>
                        </a>
                    </li>
                </ul>
              </div>
            </div>

            <div class="col-md-9 pl-0">

              <div class="questionaire">
                <form>

                  <ul class="progress-form">

                    <div class="Step1">

                      <a href="shareSafetyTips" class="pull-left animated fadeInUp show_one  back-arrow"><img src="assets/images/icon-feather-arrow-left.svg" class="img-fluid leftIcon"></a>
                                            
                      <!-- step2 start -->
                      <li class="form-group animated fadeInUp activate selected" data-color="#7C6992" data-percentage="100%">
                                
                         <label>
                      <h5 class="textColor"><?php echo $this->lang->line('safety_exact_location'); ?></h5>
                    </label>     
                        <div class="text-left">
                         
                          <div class="mapouter w-60 width100" id="mapouter" style="height: 400px;">

                          </div>
                        </div>

                      </li>
                      <!-- step2 end -->
                      <div class="text-left w-60">
                        <a href="shareSafetyTip" class="btn btn-primary mb-3 btn_purple1 nxt_btn shareMap btnNext safetyBtn fadeInUp mt-3 ml-30">
                          <?php echo $this->lang->line('button_next'); ?>
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                     </div>
                    </div>

                  </ul>

                </form>
                

             </div> <!-- //questionaire -->
           </div>

         </div>
       </div>



     </div> <!-- //text mx-auto -->

   </div>


 </div>


 <div class="clearfix"></div>

<?php
  $this->load->view('includes/footer');
?>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places"></script>
<script type="text/javascript" src="assets/js/safety_tip/safety_map.js"></script>

<?php
  } 
  else 
  {
      if(isset($_COOKIE['l_u']) && !empty($_COOKIE['l_u'])){
          redirect($_COOKIE['l_u']);
      } else {
          redirect('home');
      }
  }
?>
