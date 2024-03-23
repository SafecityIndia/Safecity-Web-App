<?php 
  $this->load->view('includes/header'); 
  $mapP =  (isset($_COOKIE['mapAddPolice']) && !empty($_COOKIE['mapAddPolice']) ? $_COOKIE['mapAddPolice'] : '');
  $mapP = str_replace('"', '', $mapP);
  // echo $mapH;
  // exit();
?>

<style type="text/css">
    #locationField,
    #controls {
      position: relative;
      width: 480px;
    }

    #autocomplete {
      /*position: absolute;
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

<body> 

 <div class="covering my-auto relativepo">

          <div class="container">
            <div class="text mx-auto primaryForm">
              <div class="questionaire">
                <form>
                
                  <ul class="progress-form">
                                   
                    <div class="Step1">
                       <a href="home" class="pull-left animated fadeInUp show_one back-arrow"><img src="assets/images/icon-feather-arrow-left.svg" class="img-fluid leftIcon"></a>
                      
                       <!-- step1 start -->
                        <li class="form-group animated fadeInUp activate selected " data-color="#E1523D" data-percentage="20%">

                        <label for="nameInput">                  
                            <?php echo $this->lang->line('map_police_find_loc'); ?>
                        </label>
                        <input type="text" name="txtLocation" id="autocomplete" class="form-control inputBox txtLocation" placeholder="<?php echo $this->lang->line('map_placeholder'); ?>" value="<?php echo $mapP; ?>">
                        <span class="mapError"></span>
                      </li>
                      <!-- step1 end-->    

                    </div>

                  </ul>

                </form>
              
                <button href="#" class="btn btn-primary safetyBtn animated nextPage fadeInUp pull-right mt-3 nxt_btn">
                  <?php echo $this->lang->line('button_next'); ?>
                  <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
                <!-- <a href="" class="btn btn-primary nxt_btn animated nextPage fadeInUp pull-right">Next <span class="glyphicon glyphicon-chevron-down"></span></a> -->

              </div> <!-- //questionaire -->
            </div> <!-- //text mx-auto -->

          </div>

          <div class="clearfix"></div>
  
   
</div>
 
<script src="assets/js/jquery-3.3.1.js"  ></script>     
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script-form.js"></script>
<script type="text/javascript" src="assets/js/jquery.cookie.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places&language=<?php echo (isset($_COOKIE['languageSF']) && !empty($_COOKIE['languageSF']) ? $_COOKIE['languageSF'] : 'EN'); ?>"></script>
<script type="text/javascript" src="assets/js/policestation/find_loc.js"></script>
<script type="text/javascript" src="assets/js/language/language_change.js"></script>
</body>
</html>