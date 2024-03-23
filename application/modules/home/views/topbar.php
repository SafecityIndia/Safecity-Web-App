<?php
  /*$current_url = current_url();
  $base_url = base_url();
  $callURL = ($current_url == $base_url."help" ? "getHelpCountry" : "getCountry");*/
?>

<script type="text/javascript">
  var baseURL = "<?php echo base_url() ?>";
  var home_city_error = '<?php echo $this->lang->line('home_city_error'); ?>';
  var home_country_error = '<?php echo $this->lang->line('home_country_error'); ?>';
  var home_city_no_data = '<?php echo $this->lang->line('home_city_no_data'); ?>';
</script>

<style>
#country, #city {
  background: White;
}
.active .location-filter .dropdown-item {
  /*color: #16181b;*/
  text-decoration: none;
  background-color: #EBE2F4;
}
.grey_btn.disabled, .grey_btn:disabled {
    color: #fff !important;
    background-color: #EBE2F5 !important;
    border-color: #EBE2F5 !important;
    opacity: 1 !important;
    pointer-events: none !important;
}
/*Pagination CSS*/
</style>

<!-- Filter Start -->
<div class="location-filter mb-3">
  <div class="row ml-0 mr-0">
    <div class="col-md-3 col-sm-12 col-xs-12 width100">
      <p> <?php echo $this->lang->line('select_info'); ?> </p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <input type="hidden" name="auto_country" id="field-country">
      <input type="text" name="country" class="form-control" id="country" data-provide='typeahead' placeholder="<?php echo $this->lang->line('enter_country'); ?>" typeahead-select-on-exact="true" typeahead-select-on-blur="true" autocomplete="auto_country">
      <div class="countryErr"></div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <input type="hidden" name="auto_city" id="field-city">
      <input type="text" name="city" class="form-control" id="city" data-provide='typeahead' placeholder="<?php echo $this->lang->line('enter_city'); ?>" typeahead-select-on-exact="true" typeahead-select-on-blur="true" autocomplete="auto_city">
      <div class="cityErr"></div>
    </div>
    <div class="col-md-1 col-sm-6 col-xs-12">
      <button class="btn btn-primary grey_btn Location-done">
        <?php echo $this->lang->line('button_done'); ?>
      </button>
    </div>
  </div>
</div>
<!-- <div class="loc-information mb-3">You are seeing infromation for Organization, Mumbai, India <button class="change-btn">Change</button> </div> -->
<div class="loc-information mb-3">
  <?php echo $this->lang->line('seeing_info'); ?>
  <span id="loc_info"></span>
  <button class="change-btn"><?php echo $this->lang->line('button_change'); ?></button>
</div>
<!-- Filter end -->

<!-- Filter Start -->
<!-- <div class="location-filter mb-3">
  <div class="row ml-0 mr-0">
    <div class="col-md-3 col-sm-12 col-xs-12 width100">
      <p> <?php echo $this->lang->line('select_info'); ?> </p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <input type="hidden" name="auto_country" id="field-country">
      <input type="text" name="country" class="form-control" id="country" data-provide='typeahead' placeholder="<?php echo $this->lang->line('enter_country'); ?>" typeahead-select-on-exact="true" typeahead-select-on-blur="true" autocomplete="auto_country" style="text-transform: capitalize;">
      <div class="countryErr"></div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <input type="hidden" name="auto_city" id="field-city">
      <input type="text" name="city" class="form-control" id="city" data-provide='typeahead' placeholder="<?php echo $this->lang->line('enter_city'); ?>" typeahead-select-on-exact="true" typeahead-select-on-blur="true" autocomplete="auto_city" style="text-transform: capitalize;">
      <div class="cityErr"></div>
    </div>
    <div class="col-md-1 col-sm-6 col-xs-12">
      <button class="btn btn-primary grey_btn Location-done">
          <?php echo $this->lang->line('button_done'); ?>
      </button>
    </div>
  </div>
</div>

<div class="loc-information mb-3">
  <?php echo $this->lang->line('seeing_info'); ?>
  <span id="loc_info"></span>
  <button class="change-btn"><?php echo $this->lang->line('button_change'); ?></button>
</div> -->
<!-- Filter end -->