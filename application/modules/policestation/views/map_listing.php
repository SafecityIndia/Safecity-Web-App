<?php  

  defined('BASEPATH') OR exit('No direct script access allowed');

  $this->load->view('includes/header');  

  $current_url = current_url();
  $explode_url = explode('/', $current_url);
  $cntArr = count($explode_url);
  $getLastfield = $explode_url[$cntArr-1];

  if($cntArr == 4){
    $assetsVal = 'assets';
  } else {
    $assetsVal = '../assets';
  }
?>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places&language=<?php echo (isset($_COOKIE['languageSF']) && !empty($_COOKIE['languageSF']) ? $_COOKIE['languageSF'] : 'EN'); ?>"></script>

<script type="text/javascript">
  var map_edit_option = '<?php echo $this->lang->line("map_edit_option"); ?>';
  var map_location = '<?php echo $this->lang->line("map_location"); ?>';
  var map_direction = '<?php echo $this->lang->line("map_direction"); ?>';
</script>

<main class="contentCenter mb-4 mt-4">
  <div class="main-content">
    <div class="container">

      <!--  location details start -->
      <div class="row">
        <div class="col-md-12 mb-3 mapLocation" id="mapLocation">
          <!-- Location : xyz Building, ABC Area <a href="#" style="padding-left: 10px;color: #592d8d">edit</a> -->
        </div>
      </div>
      <!--  location details end -->

      <div class="row">
        <div class="col-md-4 no-padding-right right-box-shadow zindex" id="first-row">

          <!-- <div class="search">
            <input type="text" class="searchTerm" placeholder="Search Here">
            <div  class="searchButton">
                <button type="submit" class="border-right-search">
                  <i class="fa fa-search"></i> 
                </button>
               <button type="submit">
                   <i class="fa fa-times"></i>
               </button>
            </div>
          </div> -->

          <!-- <div>Current list of hospitals</div> -->

          <div class="add-sidebar" id="map_sidebar">
               <!-- <div class="add-main">
                    <div class="add-title">  Gov. Hospital</div>

                    <div class="rating">
                     	  <span class="checkedrating">3.4</span>
                        <span class="fa fa-star checkedrating"></span>
                        <span class="fa fa-star checkedrating"></span>
                        <span class="fa fa-star checkedrating"></span>
                        <span class="fa fa-star uncheckedrating"></span>
                        <span class="fa fa-star uncheckedrating"></span>
                        <span class="uncheckedrating">(73)</span>
                    </div>

                    <div class="address">
                        Hospital D-5 Military Road Hospital D-5 Military Road Hospital D-5 Military RoadHospital D-5 Military Road
                    </div>

                    <div class="direction-icon text-center">
                        <a href="http://maps.google.com/maps?saddr='+source + '&daddr='+destination">
                            <img src="<?php echo $assetsVal; ?>/images/direction.svg" class="img-fluid">
                        </a>
                        <br>
                          Direction
                    </div>
               </div> -->
          </div>
        </div>

        <div class="col-md-8 no-padding-left no-padding-right" id="second-row">
          <div class="mapouter" id="mapouter">
          </div>
        </div>

      </div>
    </div>
  </div>
</main>
 
<?php  
    $this->load->view('includes/footer'); 
?>

<script type="text/javascript" src="assets/js/policestation/policestation_listing.js"></script>
<script type="text/javascript" src="assets/js/language/language_change.js"></script>