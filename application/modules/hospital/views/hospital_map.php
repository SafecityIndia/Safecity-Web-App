<?php
  $this->load->view('includes/header'); 
?>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places&language=<?php echo (isset($_COOKIE['languageSF']) && !empty($_COOKIE['languageSF']) ? $_COOKIE['languageSF'] : 'EN'); ?>"></script>

  <div class="covering m-padding my-auto">

          <div class="container">
            <div class="text mx-auto width100" style="width: 62%;">
              <div class="questionaire">
                <form>
                
                  <ul class="progress-form">
                   
                    <div class="Step1">

                      <a href="hospital_loc" class="pull-left animated fadeInUp show_one back-arrow"><img src="assets/images/icon-feather-arrow-left.svg" class="img-fluid leftIcon"></a>
                      
                      
                      <!-- step2 start -->
                      <li class="form-group animated fadeInUp activate selected" data-color="#7C6992" data-percentage="100%">
                        <label for="exampleInputEmail1">
                          <?php echo $this->lang->line('map_move_pin'); ?>
                        </label>                  
                        <div class="text-left">
                       
                          <div class="mapouter" id="mapouter" style="height: 400px;">
                            <!-- append html -->
                          </div>
                        </div>

                      </li>
                      <!-- step2 end -->

                </div>

              </ul>

            </form>
            <button class="btn btn-primary mt-4 nxt_btn animated pull-right mr_20 btnSubmit">
              <?php echo $this->lang->line('button_next'); ?>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>

            <!-- <a href="https://www.google.com/maps/search/<?php //echo $place; ?>%20near%20me%20<?php //echo $location; ?>"></a> -->

          </div> <!-- //questionaire -->
        </div> <!-- //text mx-auto -->

      </div>

      <div class="clearfix"></div>

</div>

  <script src="assets/js/jquery-3.3.1.js"></script>     
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/script-form.js"></script>
<!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places" async defer></script> -->
<script type="text/javascript" src="assets/js/jquery.cookie.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="assets/js/hospital/hospital_map.js"></script>
<script type="text/javascript" src="assets/js/language/language_change.js"></script>

</body>
</html>