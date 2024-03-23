<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('../includes/header');
?>

<body class="bgColor relativepo"> 
   <div class="count float-right">
            <h5 class="progress-text">0% Completed </h5>
            <div class="progress">
              <div class="progress-bar" style="width: 0%;"> </div>
            </div>
          </div>
    <div class="covering my-auto">

        <div class="container">
            <div class="text mx-auto width95" style="width: 62%;">
              <div class="questionaire">
                <form>
                
                  <ul class="progress-form">
                  
                    <div class="Step1">
                        <a id="dynamicBack" href="javascript:void(0);" class="pull-left animated fadeInUp dynamic_back"><img src="<?php echo base_url() ?>assets/images/icon-feather-arrow-left.svg" class="img-fluid leftIcon"></a>
                   
                      <!-- Dynamic questions start -->
                      <li class="form-group animated fadeInUp activate selected singleColumn" data-color="#7C6992" data-percentage="100%">
                        <label>
                          <span id="question_span"><!-- Placeholder for dynamic questions --></span><span class="error">*</span><br>
                          <span class="themeColor" id="subtext_span"><!-- Placeholder for dynamic sub text --></span>
                        </label>                  

                        <div id="options">
                          <!-- Placeholder for dynamic options -->
                        </div>


                        <span class="sharingForInfo"></span>
                      </li>
                      <!-- Dynamic questions end -->
 
                    </div>

                  </ul>
                  
                </form>
              
               <button id="dynamicNext" class="btn btn-primary nxt_btn animated nextPage fadeInUp pull-right mt-4" ><?php echo $this->lang->line('apply_to_next_btn'); ?><span class="glyphicon glyphicon-chevron-down"></span></button>                

              </div> <!-- //questionaire -->
              <div class="thankyou-section" style="display:none">
         
            
                  <div class="text mx-auto width100" style="width: 58%;">
                    <h4 class="mb-4 text-center textColor dynamic-success-title">Thank you for submitting your report!</h4>
                    <div class="text-center">
                      <img src="<?php echo base_url() ?>assets/images/thank-you-check.png" class="img-fluid checkIcon">
                    </div>

                    <div class="text mb-5 dynamic-success-content">
                      <p>By sharing your experience with us, you are helping prevent 3 others from experiencing something similar.</p>

                      <p>If you have 5-10 minutes, we would like to know more about the incident to understand other factors that play a role in sexual violence. By answering a few questions, you will help us build safer cities.</p>        
                    </div>

                    <div class="text-center mt-4 dynamic-success-link">                  
                      <a href="#" class="btn w-75 width100 btn_p_white mb-4">YES, I WANT TO HELP</a>
                      <a href="home" class="btn w-75 width100 btn_purple ">NO, I'M DONE</a>
                    </div>

                  </div>
              </div>
            </div> <!-- //text mx-auto -->

        </div>

       

          <div class="clearfix"></div>
    </div>
 
  <?php $this->load->view('../includes/footer'); ?>

  <script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places" async></script>
 
    <script type="text/javascript">
      var baseURL = "<?php echo base_url() ?>";
      var clientForms = <?php echo $forms ?>;
      var dynamicQuestionOptionJson = <?php echo $questions ?>;
      var categories = <?php echo $categories ?>;
      var lang_id    = $.cookie("language_id") || 1;

	  console.log(dynamicQuestionOptionJson);
	  
      //Language based text
      var dateform_select_date = "<?php echo $this->lang->line('dateform_select_date'); ?>";
      var this_is_an_estimate = "<?php echo $this->lang->line('this_is_an_estimate'); ?>";
      var timeform_select_time = "<?php echo $this->lang->line('timeform_select_time'); ?>";
      var timeform_select_a_time_range = "<?php echo $this->lang->line('timeform_select_a_time_range'); ?>";
      var timeform_clear_time = "<?php echo $this->lang->line('timeform_clear_time'); ?>";
      var timeform_clear_time_range = "<?php echo $this->lang->line('timeform_clear_time_range'); ?>";
      var timeform_time_or = "<?php echo $this->lang->line('timeform_time_or'); ?>";
      var address_locate_on_map = "<?php echo $this->lang->line('address_locate_on_map'); ?>";
      var address_locate_on_map_subtext = "<?php echo $this->lang->line('address_locate_on_map_subtext'); ?>";
      var address_pin_exact_location = "<?php echo $this->lang->line('address_pin_exact_location'); ?>";
      var map_start_typing = "<?php echo $this->lang->line('map_start_typing'); ?>";
      var address_pin_exact_location_subtext = "<?php echo $this->lang->line('address_pin_exact_location_subtext'); ?>";
      var address_pinned_on_map = "<?php echo $this->lang->line('address_pinned_on_map'); ?>";
      var address_area = "<?php echo $this->lang->line('address_area'); ?>";
      var address_area_subtext = "<?php echo $this->lang->line('address_area_subtext'); ?>";
      var address_build_loc = "<?php echo $this->lang->line('address_build_loc'); ?>";
      var address_build_loc_subtext = "<?php echo $this->lang->line('address_build_loc_subtext'); ?>";
      var address_i_confirm_msg = "<?php echo $this->lang->line('address_i_confirm_msg'); ?>";
      var address_i_confirm = "<?php echo $this->lang->line('address_i_confirm'); ?>";
      var someone_else_popup_msg = "<?php echo $this->lang->line('someone_else_popup_msg'); ?>";
      var someone_else_popup_ok = "<?php echo $this->lang->line('someone_else_popup_ok'); ?>";
      var required_field = "<?php echo $this->lang->line('required_field'); ?>";

      var country_id = $.cookie("country_id")??"101";
      
    </script>
    <script src="<?php echo base_url() ?>application/modules/report_incident/scripts/dynamic_forms.js?v=2"></script>
    <!-- Load Custom Components -->
    <script src="<?php echo base_url() ?>application/modules/report_incident/scripts/components/TextField.js"></script>
    <script src="<?php echo base_url() ?>application/modules/report_incident/scripts/components/RadioField.js"></script>
    <script src="<?php echo base_url() ?>application/modules/report_incident/scripts/components/CheckboxField.js"></script>
    <script src="<?php echo base_url() ?>application/modules/report_incident/scripts/components/EstimateTimeRangePickerField.js"></script>
    <script src="<?php echo base_url() ?>application/modules/report_incident/scripts/components/EstimateDatepickerField.js"></script>
    <script src="<?php echo base_url() ?>application/modules/report_incident/scripts/components/AddressFormField.js"></script>
    <script src="<?php echo base_url() ?>application/modules/report_incident/scripts/components/LocationPinMapField.js"></script>
	<script src="<?php echo base_url() ?>assets/js/language/language_change.js"></script>
</body>

</html>
