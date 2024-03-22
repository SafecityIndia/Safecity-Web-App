<?php  
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('includes/header');  
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
          <div class="add-sidebar" id="map_sidebar"></div>
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

<script type="text/javascript" src="assets/js/hospital/hospital_listing.js"></script>
<script type="text/javascript" src="assets/js/language/language_change.js"></script>