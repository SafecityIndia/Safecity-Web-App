<?php
  if(isset($_COOKIE['safety_tip_url']) && !empty($_COOKIE['safety_tip_url'])){
      $explodeVal = explode(',', $_COOKIE['safety_tip_url']);
  }
  if(isset($explodeVal) && !empty($explodeVal) && in_array('shareSafetyTips', $explodeVal)){
      $this->load->view('includes/header');

      $countryC = (isset($_COOKIE['countrySafe']) && !empty($_COOKIE['countrySafe']) ? $_COOKIE['countrySafe'] : '');
      $country = (isset($_COOKIE['country']) && !empty($_COOKIE['country']) ? $_COOKIE['country'] : '');

      $cityC = (isset($_COOKIE['citySafe']) && !empty($_COOKIE['citySafe']) ? $_COOKIE['citySafe'] : '');
      $city = (isset($_COOKIE['city']) && !empty($_COOKIE['city']) ? $_COOKIE['city'] : '');
?>
  
  <style type="text/css">
    #locationField,
    #controls {
      position: relative;
      width: 480px;
    }

    #autocomplete {
     /* position: absolute;
      top: 0px;
      left: 0px;
      width: 99%;*/
    }

    .label {
      text-align: right;
      font-weight: bold;
      width: 100px;
      color: #303030;
      font-family: "Roboto", Arial, Helvetica, sans-serif;
    }

    #address {
      border: 1px solid #000090;
      background-color: #f0f9ff;
      width: 480px;
      padding-right: 2px;
    }

    #address td {
      font-size: 10pt;
    }

    .field {
      width: 99%;
    }

    .slimField {
      width: 80px;
    }

    .wideField {
      width: 200px;
    }

    #locationField {
      height: 20px;
      margin-bottom: 2px;
    }
  </style>

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
                          <a class="nav-link" href="javascript:void(0);">
                            <?php echo $this->lang->line('safety_location'); ?>
                          </a>
                      </li>
                      <li class="nav-item">
                          <div class="box"></div>
                          <a class="nav-link mo-d-none" href="javascript:void(0);">
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
               <form method="post" class="shareTips" id="shareTips">

                <ul class="progress-form">

                  <div class="Step1">
                   <a href="home" class="pull-left animated fadeInUp show_one back-arrow"><img src="assets/images/icon-feather-arrow-left.svg" class="img-fluid leftIcon"></a>
                   <!-- step1 start -->
                   <li class="form-group animated fadeInUp activate selected singleColumn" data-color="#7C6992" data-percentage="100%">

                    <label>
                      <h5 class="textColor"><?php echo $this->lang->line('safety_tips_info'); ?><br>
                        <?php echo $this->lang->line('safety_tips_relevant_info'); ?>
                      </h5>
                    </label>

                    <div class="form-group">
                      <label class="mb-0 pb-1">
                        <?php echo $this->lang->line('safety_locality'); ?>
                        <span class="error">*</span>
                      </label>
                      <input class="form-control locality getLatLong" autocomplete="off" id="autocomplete" name="locality" placeholder="<?php echo $this->lang->line('safety_locality_placeholder'); ?>" cols="25" rows="3" value="">
                      <span class="localityErr"></span>
                    </div>

                    <div class="form-group">
                      <label class="mb-0 pb-1">
                        <?php echo $this->lang->line('safety_landmark'); ?>
                        <span class="error">*</span>
                      </label>
                      <input type="text" class="form-control landmark getLatLong" autocomplete="off" name="landmark" id="landmark" placeholder="<?php echo $this->lang->line('safety_landmark_placeholder'); ?>" value="">
                      <span class="landmarkErr"></span>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="mb-0 pb-1">
                            <?php echo $this->lang->line('safety_city'); ?>
                            <span class="error">*</span>
                          </label>
                          <input type="text" class="form-control city getLatLong" name="city" id="city" placeholder="<?php echo $this->lang->line('safety_city_placeholder'); ?>" value="">
                          <span class="cityErr"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="mb-0 pb-1">
                            <?php echo $this->lang->line('safety_state'); ?>
                            <span class="error">*</span>
                          </label>
                          <input type="text" class="form-control state getLatLong" name="state" id="state" placeholder="<?php echo $this->lang->line('safety_state_placeholder'); ?>" value="">
                          <span class="stateErr"></span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="mb-0 pb-1">
                        <?php echo $this->lang->line('safety_country'); ?>
                        <span class="error">*</span>
                      </label>
                      <input type="text" class="form-control country getLatLong" name="country" id="country" placeholder="<?php echo $this->lang->line('safety_country_placeholder'); ?>" value="">
                      <span class="countryErr"></span>
                    </div>

                  </li>
                  <!-- step1 end -->

                </div>

              </ul>

            </form>

            <div class="text-left">
              <!-- <a href="shareSafetyMap" class="btn btn-primary safetyBtn mb-3 btn_purple1 btnNext shareLoc mx-auto fadeInUp mt-3">Next <span class="glyphicon glyphicon-chevron-down"></span></a> -->
              <button class="btn btn-primary safetyBtn shareLoc animated nextPage fadeInUp pull-right mt-3 nxt_btn" disabled="disabled">
                <?php echo $this->lang->line('button_next'); ?>
                <span class="glyphicon glyphicon-chevron-down"></span>
              </button>
            </div>


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
<script type="text/javascript" src="assets/js/safety_tip/safety_location.js"></script>

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
