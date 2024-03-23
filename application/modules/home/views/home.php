<?php $this->load->view('../includes/header'); ?>
<main class="">
  <div class="main-content">
    <div class="container">
      <div class="text mx-auto">
        <!-- country & city filter Start -->
        <?php $this->load->view('home/topbar'); ?>
        <!-- country & city filter end -->
        <div class="row">
          <div class="col-md-7"></div>
          <div class="col-md-5">
            <div class="incidence-tabs">
             <ul class="nav nav-tabs">
              <li><a data-toggle="tab" href="#Incidents" class="active border-top-right-radius border-bottom-right-radius"><?php echo $this->lang->line('incidents'); ?></a></li>
              <li><a data-toggle="tab" href="#Safety" class="border-top-left-radius border-bottom-left-radius"><?php echo $this->lang->line('safety_tips'); ?></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--   Incidents tab -->
      <div id="Incidents" class="tab-pane fade in active show">
        <div class="row">
          <div class="col-md-7 col-sm-12 col-xs-12">
            <div class="mapouter mapmain" style="height:342px">
              <div class="search map-search-bar">
                <!-- <div class="ui-widget"> -->
                  <input type="text" class="searchTerm" id="incident_searchBtn" placeholder="<?php echo $this->lang->line('search_area'); ?>">
                  <!-- </div> -->
                  <div class="searchButton">
                    <button type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
                <div id="map" class="gmap_canvas"></div>
                <!-- <div class="gmap_canvas"><iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=mumbai%20hospital&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div> -->
              </div>
              <p>
                <?php echo $this->lang->line('map_incident_info'); ?>
                <a href="<?=base_url('view-data')?>" class="themeColor weight500">
                  <?php echo $this->lang->line('view_more_data'); ?>
                </a>
              </p>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
              <div class="incidence-tabs">

                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content">

                      <div class="scrolbar-main custom-scrolbar">
                        <h1><?php echo $this->lang->line('incident_title'); ?></h1>
                        <p class="mb-4 inc_desc"></p>
                        <a href="onboarding" class="btn w-75 btn_purple mb-5 text-capitalize">
                          <?php echo $this->lang->line('incident_button'); ?>
                        </a>
                        <div class="incient-listing filter1">
                          <h1><?php echo $this->lang->line('incident_shared_community'); ?></h1>
                          <button id="incidents_filter_set" class="filter-pur-btn" data-toggle="modal" data-target="#Incident-share">
                            <?php echo $this->lang->line('home_filter'); ?>
                          </button>
                          <button id="incidents_filter_clr" class="text-danger">
                            <?php echo $this->lang->line('button_clear'); ?>
                          </button>
                          <div class="mb-4"></div>
                        </div>

                        <!-- <div class="no-incident-found">No incidents found for this area.</div> -->

                        <div class="incident-block">
                          <!-- <div class="no-incident-found mb-2">To view incidents reported before 01 Dec 2020, <a href="https://public.tableau.com/profile/mehul.sharma3900#!/vizhome/Safecity_Dashboard_Delhi_final/MumbaiStory">Click here</a></div> -->
                          <div id="incidents_list">
                          </div>
                        </div>

                        <!-- commented incidents saved in incidenthtml file -->
                        <div class="pagination-main pg1 text-right incident-title" id="pagination_div">
                          <span id="incident_showing_record"></span>
                          <span class="pag-btn">
                            <span id="incident_prev" class="prev-btn"><img src="assets/images/left.svg" class="img-fluid" width="10"></span>
                            <span id="incident_next"  class="next-btn"><img src="assets/images/right.svg" class="img-fluid" width="10"></span>
                            <!-- <ul id="pagin"></ul> -->
                            <!-- 1 2 3 4 -->
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Safety tab -->
          <div id="Safety" class="tab-pane fade">
            <div class="row">
              <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="mapouter mapmain" style="height:342px">
                  <div class="search map-search-bar">
                    <input type="text" class="searchTerm" id="safetytip_searchBtn" placeholder="<?php echo $this->lang->line('search_area'); ?>">
                    <div class="searchButton">
                      <button type="submit">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                  <div id="safetytip_map" class="gmap_canvas"></div>
                  <!-- <div class="gmap_canvas"><iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=mumbai%20hospital&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div> -->
                </div>
                <p>
                  <?php echo $this->lang->line('map_safety_tip_info'); ?>
                  <a href="<?=base_url('view-data')?>" class="themeColor weight500">
                    <?php echo $this->lang->line('view_more_data'); ?>
                  </a>
                </p>
              </div>
              <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="incidence-tabs">

                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="tab-content">

                        <div class="scrolbar-main custom-scrolbar">
                          <h1><?php echo $this->lang->line('safety_title'); ?></h1>
                          <p class="mb-4 safety_desc"></p>
                          <a href="shareSafetyTips" class="shareSafetyInfo btn w-75 btn_yellow mb-5 text-capitalize">
                            <?php echo $this->lang->line('safety_button'); ?>
                          </a>
                          <div class="incient-listing filter2">
                            <h1><?php echo $this->lang->line('safety_shared_community'); ?></h1>
                            <button id="safetytip_filter_set" class="filter-pur-btn" data-toggle="modal" data-target="#Safety-tips">
                              <?php echo $this->lang->line('home_all_filters'); ?>
                            </button>
                            <button id="safetytip_filter_clr" class="text-danger">
                              <?php echo $this->lang->line('button_clear'); ?>
                            </button>
                            <div class="mb-4"></div>
                          </div>
                          <div class="incident-block">
                            <div id="safetytip_list"></div>
                          </div>

                          <div class="pagination-main pg2 text-right" id="pagination_safety_div">
                            <span id="safety_showing_record"></span>
                            <span class="pag-btn">
                              <span id="safety_prev" class="prev-btn"><img src="assets/images/left.svg" class="img-fluid" width="10"></span>
                              <span id="safety_next" class="next-btn"><img src="assets/images/right.svg" class="img-fluid" width="10"></span>
                              <!-- <ul id="safety_pagin"></ul> -->
                              <!-- 1 2 3 4 -->
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Incident share -->
  <div id="Incident-share" class="modal fade incident-popup" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" style="max-width:680px !important">
      <!-- Modal content-->
      <div id="incidentshare_filtercontent"></div>

    </div>
  </div>
  <!-- Safety tips -->
  <div id="Safety-tips" class="modal fade incident-popup" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="max-width:680px !important">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?php echo $this->lang->line('home_all_filters'); ?></h4>
          <button type="button" class="close" data-dismiss="modal"> <img src="assets/images/close.svg" class="img-fluid"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="incient-listing text-right">
                <button id="safetytip_filter_apply" class="apply-pur-btn" data-dismiss="modal">
                  <?php echo $this->lang->line('button_apply'); ?>
                </button>
                <button id="safetytip_filter_clear" class="text-danger">
                  <?php echo $this->lang->line('button_clear'); ?>
                </button>
                <div class="mb-4"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12"><ul class="nav nav-tabs">

              <li>
                <a data-toggle="tab" href="#Showsafetytips" class="active">
                  <?php echo $this->lang->line('home_show_safety_tips_from'); ?>
                </a>
              </li>
            </ul></div>
            <div class="col-md-7 col-sm-12 col-xs-12"><div class="tab-content">
              <div id="Showsafetytips" class="tab-pane fade active show">
                <div class="scrolbar-popup custom-scrolbar">
                  <div class="inputGroup custom-control">
                    <input type="radio" id="alltime1" name="showsafetytipfrom" class="custom-control-input" value="All time">
                    <label class="custom-control-label label1" for="alltime1">
                      <?php echo $this->lang->line('home_all_time'); ?>
                    </label>
                  </div>
                  <div class="inputGroup custom-control">
                    <input type="radio" id="today1" name="showsafetytipfrom" class="custom-control-input" value="Today">
                    <label class="custom-control-label label1" for="today1">
                      <?php echo $this->lang->line('home_today'); ?>
                    </label>
                  </div>
                  <div class="inputGroup custom-control">
                    <input type="radio" id="week1" name="showsafetytipfrom" class="custom-control-input" value="This Week">
                    <label class="custom-control-label label1" for="week1">
                      <?php echo $this->lang->line('home_this_week'); ?>
                    </label>
                  </div>
                  <div class="inputGroup custom-control">
                    <input type="radio" id="month1" name="showsafetytipfrom" class="custom-control-input" value="This Month">
                    <label class="custom-control-label label1" for="month1">
                      <?php echo $this->lang->line('home_this_month'); ?>
                    </label>
                  </div>
                  <div class="inputGroup custom-control">
                    <input type="radio" id="year1" name="showsafetytipfrom" class="custom-control-input" value="This Year">
                    <label class="custom-control-label label1" for="year1">
                      <?php echo $this->lang->line('home_this_year'); ?>
                    </label>
                  </div>
                </div>
              </div></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- incident-viewmore data -->
    <div id="incident-viewmore-div">
    </div>

    <div id="safetytip-viewmore-div">
    </div>

  <?php $this->load->view('../includes/footer'); ?>

  <style>
    .homePage .main-content {
      margin-top: 12px !important;
    }
    #country, #city {
      background: White;
    }
    .typeahead>li.active {
      text-decoration: none;
      background-color: #EBE2F4;
    }
    .gmap_canvas {
      height: 400px;  /* The height is 400 pixels */
      width: 100%;  /* The width is the width of the web page */
    }
    /*.active .location-filter .dropdown-item {
      text-decoration: none;
      background-color: #EBE2F4;
    }*/
    .grey_btn.disabled, .grey_btn:disabled {
      color: #fff !important;
      background-color: #EBE2F5 !important;
      border-color: #EBE2F5 !important;
      opacity: 1 !important;
      pointer-events: none !important;
    }
    /*Pagination CSS*/
  </style>

  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
  <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>

  <!-- Google MAP Script -->
  <!-- <script defer src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&amp&libraries=geometry,places">
  </script> -->
  <!-- Incident Tab Script -->
  <script src="<?php echo base_url(); ?>application/modules/home/scripts/home_incidents.js"></script>
  <!-- Safetytip Tab Tab Script -->
  <script src="<?php echo base_url(); ?>application/modules/home/scripts/home_safetytip.js"></script>

  <script type="text/javascript">
    // language variables start
    var home_city_error = '<?php echo $this->lang->line('home_city_error'); ?>';
    var home_country_error = '<?php echo $this->lang->line('home_country_error'); ?>';
    var home_city_no_data = '<?php echo $this->lang->line('home_city_no_data'); ?>';
    var incident_no_data = '<?php echo $this->lang->line('incident_no_data'); ?>';
    var home_days_error = '<?php echo $this->lang->line('home_days_error'); ?>';
    var home_time_error = '<?php echo $this->lang->line('home_time_error'); ?>';
    var incident_additional_details = '<?php echo $this->lang->line('incident_additional_details'); ?>';
    var home_around = '<?php echo $this->lang->line('home_around'); ?>';
    var home_on = '<?php echo $this->lang->line('home_on'); ?>';
    var home_at = '<?php echo $this->lang->line('home_at'); ?>';
    var home_between = '<?php echo $this->lang->line('home_between'); ?>';
    var home_day_ago = '<?php echo $this->lang->line('home_day_ago'); ?>';
    var home_days_ago = '<?php echo $this->lang->line('home_days_ago'); ?>';
    var home_today = '<?php echo $this->lang->line('home_today'); ?>';
    var home_led_attack = '<?php echo $this->lang->line('home_led_attack'); ?>';
    var home_perpetrator = '<?php echo $this->lang->line('home_perpetrator'); ?>';
    var home_medical_help_yes = '<?php echo $this->lang->line('home_medical_help_yes'); ?>';
    var home_medical_help_no = '<?php echo $this->lang->line('home_medical_help_no'); ?>';
    var home_police_filed = '<?php echo $this->lang->line('home_police_filed'); ?>';
    var home_police_not_filed = '<?php echo $this->lang->line('home_police_not_filed'); ?>';
    var home_police_tried_filed = '<?php echo $this->lang->line('home_police_tried_filed'); ?>';
    var home_police_intend_filed = '<?php echo $this->lang->line('home_police_intend_filed'); ?>';
    var home_police_not_sure_filed = '<?php echo $this->lang->line('home_police_not_sure_filed'); ?>';
    var home_showing_pagination = '<?php echo $this->lang->line('home_showing_pagination'); ?>';
    var home_type_assault = '<?php echo $this->lang->line('home_type_assault'); ?>';
    var home_show_incident_from = '<?php echo $this->lang->line('home_show_incident_from'); ?>';
    var home_time_of_day = '<?php echo $this->lang->line('home_time_of_day'); ?>';
    var home_morning = '<?php echo $this->lang->line('home_morning'); ?>';
    var home_afternoon = '<?php echo $this->lang->line('home_afternoon'); ?>';
    var home_evening = '<?php echo $this->lang->line('home_evening'); ?>';
    var home_night = '<?php echo $this->lang->line('home_night'); ?>';
    var home_post_night = '<?php echo $this->lang->line('home_post_night'); ?>';
    var button_apply = '<?php echo $this->lang->line('button_apply'); ?>';
    var button_clear = '<?php echo $this->lang->line('button_clear'); ?>';
    var home_all_filters = '<?php echo $this->lang->line('home_all_filters'); ?>';
    var home_all_time = '<?php echo $this->lang->line('home_all_time'); ?>';
    var home_this_week = '<?php echo $this->lang->line('home_this_week'); ?>';
    var home_this_month = '<?php echo $this->lang->line('home_this_month'); ?>';
    var home_this_year = '<?php echo $this->lang->line('home_this_year'); ?>';
    var home_type = '<?php echo $this->lang->line('home_type'); ?>';
    var home_location = '<?php echo $this->lang->line('home_location'); ?>';
    var home_date_time = '<?php echo $this->lang->line('home_date_time'); ?>';
    var view_more_details = '<?php echo $this->lang->line('view_more_details'); ?>';
    var read_more = '<?php echo $this->lang->line('read_more'); ?>';
    var safety_tip_no_data = '<?php echo $this->lang->line('safety_tip_no_data'); ?>';
    var home_posted = '<?php echo $this->lang->line('home_posted'); ?>';
    var safety_tip_period_error = '<?php echo $this->lang->line('safety_tip_period_error'); ?>';
    var period_error = '<?php echo $this->lang->line('period_error'); ?>';
    var assault_error = '<?php echo $this->lang->line('assault_error'); ?>';
    // language variables end

    //Set Default values for Language, Client ID and City using cookie

    // code change by sonam - 14-10-2020 start
    if(!$.cookie("lang_id")){
      $.cookie("lang_id", 1);
    }
    if(!$.cookie("language_id")){
      $.cookie("language_id", 1);
    }
    if(!$.cookie("client_id")){
      $.cookie("client_id", 1);
    }
    if(!$.cookie("country_id")){
      $.cookie("country_id", 101);
    }
    if(!$.cookie("country")){
      // $.cookie("country", "India");
	  $.cookie("country", "World");
    }
    if(!$.cookie("city")){
      // $.cookie("city", "Mumbai");
	   $.cookie("city", "The");
    }
    if($.cookie("address_safety")){
        $.removeCookie("address_safety");
    }
    if($.cookie("lat_safety")){
        $.removeCookie("lat_safety");
    }
    if($.cookie("longi_safety")){
        $.removeCookie("longi_safety");
    }
    // code change by sonam - 14-10-2020 end
    if(!$.cookie("city_id")){
      $.cookie("city_id", 1325873); // Mumbai
    }

    // code change by sonam - 14-10-2020 end
    var client_id = $.cookie("client_id");
    var language_id = $.cookie("language_id");
    //var lang_id = $.cookie("lang_id");
    var lang_id = language_id;
    var country_id = $.cookie("country_id");
    var country = $.cookie("country");
    var city_id = $.cookie("city_id");
    var city = $.cookie("city");

    var lat = $.cookie('lat') || 19.076090;
    var longi = $.cookie('lng') || 72.877426;
	
	// var lat = $.cookie('lat') || 38.9717;
    // var longi = $.cookie('lng') || 95.2353;
	
    var default_reported_incident_data = {lang_id: lang_id, client_id: client_id, city: city};
    var default_reported_safetytip_data = {lang_id: lang_id, client_id: client_id, city: city};
    $(".location-filter").hide();
    var baseURL = "<?php echo base_url() ?>";

    $(document).ready(function() {
      //$(".location-filter").hide();
      if(city=='The'){
			document.getElementById('loc_info').innerHTML = city+' '+country;
		}else{
			document.getElementById('loc_info').innerHTML = city+', '+country;
		}
      var incident_map_input = document.getElementById('incident_searchBtn');
      incident_autocomplete_init(incident_map_input); //Automplete map search
      var safetytip_map_input = document.getElementById('safetytip_searchBtn');
      safetytip_autocomplete_init(safetytip_map_input); //Automplete map search
      //codeAddress();
      showMap(lat, longi); //Incident Map
      showSafetyTipMap(lat, longi); //Safety Tip Map
      load_categories(lang_id); //Load Categories for shared incident filter modal
      //load_reportedincident(default_reported_incident_data);
      //load_safetytip(default_reported_safetytip_data);
      count_filter(countfilter);
      count_safety_filter(safety_countfilter); //Add Safety filter count span

      //Pagination Start
      //Incident Pagination
      $('#incident_prev').click(function () {
        var reported_incidents = pagination_incident_data_arr['reported_incidents'];
        var reported_incidents_result = pagination_incident_data_arr['reported_incidents_result'];

        var limit = reported_incidents_result.limit;
        var offset = reported_incidents_result.offset;
        var total_record = reported_incidents_result.total;

        if (offset <= 0) {
          $("#incident_prev").css("pointer-events", "none");
        }
        if (offset >= 0) {
          offset = offset-limit;
          $("#incident_next").css("pointer-events", "auto");
          reported_incidents['offset'] = offset;
          load_reportedincident(reported_incidents);
        }
      });

      $('#incident_next').click(function () {
        var reported_incidents = pagination_incident_data_arr['reported_incidents'];
        var reported_incidents_result = pagination_incident_data_arr['reported_incidents_result'];

        var limit = reported_incidents_result.limit;
        var offset = reported_incidents_result.offset;
        var total_record = reported_incidents_result.total;
        var max_offset = offset+limit;

        if (max_offset >= total_record) {
          $("#incident_next").css("pointer-events", "none");
        }
        if (max_offset < total_record) {
          offset = offset+limit;
          $("#incident_prev").css("pointer-events", "auto");
          reported_incidents['offset'] = offset;
          load_reportedincident(reported_incidents);
        }
      });
      //Incident Pagination

      //Safetytip Pagination
      $('#safety_prev').click(function () {
        var reported_safety = pagination_safety_data_arr['reported_safety'];
        var reported_safety_result = pagination_safety_data_arr['reported_safety_result'];

        var limit = reported_safety_result.limit;
        var offset = reported_safety_result.offset;
        var total_record = reported_safety_result.total;

        if (offset <= 0) {
          $("#safety_prev").css("pointer-events", "none");
        }
        if (offset >= 0) {
          offset = offset-limit;
          $("#safety_next").css("pointer-events", "auto");
          reported_safety['offset'] = offset;
          load_safetytip(reported_safety);
        }
      });

      $('#safety_next').click(function () {
        var reported_safety = pagination_safety_data_arr['reported_safety'];
        var reported_safety_result = pagination_safety_data_arr['reported_safety_result'];

        var limit = reported_safety_result.limit;
        var offset = reported_safety_result.offset;
        var total_record = reported_safety_result.total;
        var max_offset = offset+limit;

        if (max_offset >= total_record) {
          $("#safety_next").css("pointer-events", "none");
        }
        if (max_offset < total_record) {
          offset = offset+limit;
          $("#safety_prev").css("pointer-events", "auto");
          reported_safety['offset'] = offset;
          load_safetytip(reported_safety);
        }
      });
      //Safetytip Pagination
      //Pagination End

      //Clear All Filters
      $('#incidents_filter_clr').click(function() {
        $('input:checkbox[name="sexual_violence"]').prop('checked', false);
        $('input:checkbox[name="timeofdayform"]').prop('checked', false);
        $('input:radio[name="showincidentsform"]').prop('checked', false);
        countfilter = 0; //Count zero after removing all selection
        $('.cntfilter').remove(); //Remove filter count span

        if (default_reported_incident_data.hasOwnProperty('categories_ids')) {
          delete default_reported_incident_data['categories_ids'];
        }
        if (default_reported_incident_data.hasOwnProperty('reported_time')) {
          delete default_reported_incident_data['reported_time'];
        }
        if (default_reported_incident_data.hasOwnProperty('reported_on')) {
          delete default_reported_incident_data['reported_on'];
        }
        //load_reportedincident(default_reported_incident_data);
        topIncidentsData = '';
        load_incident_coordinates(default_reported_incident_data);
      });

      //Safety Tip Filter Start
      //On Apply Click of Filter Modal
      $('#safetytip_filter_apply').click(function() {
        console.log("safetytip_filter");
        safetytip_reported_on = "";
        safety_countfilter = 0;

        $('.cntsafetyfilter').remove(); //Remove filter count span

        $('input:radio[name="showsafetytipfrom"]').each(function () {
          var showsafetytip_val = $(this).attr('id');
          var sThisVal = (this.checked ? showsafetytip_val : "");
          if (sThisVal != "") {
            safetytip_reported_on += (safetytip_reported_on=="" ? sThisVal : "," + sThisVal);
            safety_countfilter++;
          }
        });

        count_safety_filter(safety_countfilter);

        if (safetytip_reported_on != "") {
          default_reported_safetytip_data['reported_on'] = safetytip_reported_on.slice(0,-1);
        }

        //Passed filter params to this function to load incident data according to filter
        topSafetytipData = '';
        load_safetytip_coordinates(default_reported_safetytip_data);
      });

      //Clear All Filters from Main
      $('#safetytip_filter_clr').click(function() {
        $('input:radio[name="showsafetytipfrom"]').prop('checked', false);
        safety_countfilter = 0; //Count zero after removing all selection
        $('.cntsafetyfilter').remove(); //Remove filter count span
        if (default_reported_safetytip_data.hasOwnProperty('reported_on')) {
          delete default_reported_safetytip_data['reported_on'];
        }
        topSafetytipData = '';
        load_safetytip_coordinates(default_reported_safetytip_data);
      });

      //Clear All Filters from Modal Clear
      $('#safetytip_filter_clear').click(function() {
        $('input:radio[name="showsafetytipfrom"]').prop('checked', false);
        safety_countfilter = 0; //Count zero after removing all selection
        $('.cntsafetyfilter').remove(); //Remove filter count span
        if (default_reported_safetytip_data.hasOwnProperty('reported_on')) {
          delete default_reported_safetytip_data['reported_on'];
        }
        topSafetytipData = '';
        load_safetytip_coordinates(default_reported_safetytip_data);
      });
      //Safety Tip Filter End

      //code added by sonam - 14-12-2020 start
      function loadIncident_description(){
        $.ajax({
          type: "POST",
          // url: "getIncDesc",
          url: "<?php echo base_url() . 'getIncDesc'; ?>",
          data: {client_id:$.cookie("client_id"), country_id:$.cookie("country_id"), lang_id:$.cookie("language_id")},
          success:function(data) {
            $('.inc_desc').html(data);
          }
        });
      }

      function loadSafetyTip_description(){
        $.ajax({
          type: "POST",
          // url: "getSafetyDesc",
          url: "<?php echo base_url() . 'getSafetyDesc'; ?>",
          data: {client_id:$.cookie("client_id"), country_id:$.cookie("country_id"), lang_id:$.cookie("language_id")},
          success:function(data) {
            $('.safety_desc').html(data);
          }
        });
      }

      loadIncident_description();
      loadSafetyTip_description();
      // code added by sonam - 14-12-2020 end
    });
  </script>
  <!-- Country & City Filter Script -->
  <script src="<?php echo base_url(); ?>application/modules/home/scripts/topbar.js"></script>