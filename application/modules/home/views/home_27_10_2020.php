<?php $this->load->view('../includes/header'); ?>
<main class="">
  <div class="main-content">
    <div class="container">
      <div class="text mx-auto">
        <!-- Filter Start -->
        <div class="location-filter mb-3">
          <div class="row ml-0 mr-0">
            <div class="col-md-3 col-sm-12 col-xs-12 width100">
              <p>  Please select your location for a better experience</p>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <input type="hidden" name="auto_country" id="field-country">
              <input type="text" name="country" class="form-control" id="country" data-provide='typeahead' placeholder="Enter Country" typeahead-select-on-exact="true" typeahead-select-on-blur="true" autocomplete="off">
              <div class="countryErr"></div>
              <!-- <select id="Country" class="js-states form-control">
                <option>India</option>
                <option>Australia</option>
              </select> -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <input type="hidden" name="auto_city" id="field-city">
              <input type="text" name="city" class="form-control" id="city" data-provide='typeahead' placeholder="Enter City" typeahead-select-on-exact="true" typeahead-select-on-blur="true" autocomplete="off">
              <div class="cityErr"></div>
              <!-- <input type="text" name="city" class="form-control" id="city" placeholder="Enter City"> -->
              <!-- <select id="city" class="js-states form-control">
                <option>Mumbai</option>
                <option>Pune</option>
              </select> -->
            </div>
            <div class="col-md-1 col-sm-6 col-xs-12">
              <button class="btn btn-primary grey_btn Location-done">Done </button>
            </div>
          </div>
        </div>
        <!-- <div class="loc-information mb-3">You are seeing infromation for Organization, Mumbai, India <button class="change-btn">Change</button> </div> -->
        <div class="loc-information mb-3">You are seeing information for <span id="loc_info"></span> <button class="change-btn">Change</button> </div>
        <!-- Filter end -->
        <div class="row">
          <div class="col-md-7"></div>
          <div class="col-md-5">
            <div class="incidence-tabs">
             <ul class="nav nav-tabs">
              <li><a data-toggle="tab" href="#Incidents" class="active border-top-right-radius border-bottom-right-radius">Incidents</a></li>
              <li><a data-toggle="tab" href="#Safety" class="border-top-left-radius border-bottom-left-radius">Safety tips</a></li>
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
                <input type="text" class="searchTerm" id="incident_searchBtn" placeholder="Search Area">
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
              Visualised above is the mapping of incidents of sexual violence submitted by thousands of people from around the world. We use this data to understand patterns of sexual violence and bring about policy reform <a href="#" class="themeColor weight500">View more data</a>
            </p>
          </div>
          <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="incidence-tabs">
             
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="tab-content">
                    
                    <div class="scrolbar-main custom-scrolbar">
                      <h1>Have you been sexually harassed?</h1>
                      <p class="mb-4 inc_desc">
                          <!-- <?php echo $incident_data[0]['content']; ?> -->
                      </p>
                      <a href="onboarding" class="btn w-75 btn_purple mb-5 text-capitalize">Share Incident Anonymously</a>
                      <div class="incient-listing filter1">
                        <h1>Incident share by community</h1>
                        <button id="incidents_filter_set" class="filter-pur-btn" data-toggle="modal" data-target="#Incident-share">filter <!-- <span class="number-circle">3</span> --></button> <button id="incidents_filter_clr" class="text-danger">Clear</button>
                        <div class="mb-4"></div>
                      </div>

                      <!-- <div class="no-incident-found">No incidents found for this area.</div> -->
                  
                      <div class="incident-block">
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
                        <input type="text" class="searchTerm" id="safetytip_searchBtn" placeholder="Search Area">
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
                      Visualised above is the mapping of safety tips submitted by our community, telling us ways they keep themselves safe, so that others can do the same <a href="#" class="themeColor weight500">View more data</a>
                    </p>
                  </div>
                  <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="incidence-tabs">
                     
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="tab-content">
                            
                            <div class="scrolbar-main custom-scrolbar">
                              <h1>How do you navigate public places safely?</h1>
                              <p class="mb-4 safety_desc">
                                  <!-- <?php echo $safetytip_data[0]['content']; ?> -->
                              </p>
                              <a href="shareSafetyTips" class="shareSafetyInfo btn w-75 btn_yellow mb-5 text-capitalize">Share Safe Tips Anonymously</a>
                              <div class="incient-listing filter2">
                                <h1>Safe Tip share by community</h1>
                                <button id="safetytip_filter_set" class="filter-pur-btn" data-toggle="modal" data-target="#Safety-tips">filter <!-- <span class="number-circle">3</span> --></button> <button id="safetytip_filter_clr" class="text-danger">Clear</button>
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
                    <h4 class="modal-title">Filters</h4>
                    <button type="button" class="close" data-dismiss="modal"> <img src="assets/images/close.svg" class="img-fluid"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="incient-listing text-right">
                          <button id="safetytip_filter_apply" class="apply-pur-btn" data-dismiss="modal">Apply</button> <button id="safetytip_filter_clear" class="text-danger">Clear</button>
                          <div class="mb-4"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5 col-sm-12 col-xs-12"><ul class="nav nav-tabs">
                        
                        <li><a data-toggle="tab" href="#Showsafetytips" class="active">Show Safety Tips From</a></li>
                      </ul></div>
                      <div class="col-md-7 col-sm-12 col-xs-12"><div class="tab-content">
                        <div id="Showsafetytips" class="tab-pane fade active show">
                          <div class="scrolbar-popup custom-scrolbar">
                            <div class="inputGroup custom-control">
                              <input type="radio" id="alltime1" name="showsafetytipfrom" class="custom-control-input" value="All time">
                              <label class="custom-control-label label1" for="alltime1">All time</label>
                            </div>
                            <div class="inputGroup custom-control">
                              <input type="radio" id="today1" name="showsafetytipfrom" class="custom-control-input" value="Today">
                              <label class="custom-control-label label1" for="today1">Today</label>
                            </div>
                            <div class="inputGroup custom-control">
                              <input type="radio" id="week1" name="showsafetytipfrom" class="custom-control-input" value="This Week">
                              <label class="custom-control-label label1" for="week1">This Week</label>
                            </div>
                            <div class="inputGroup custom-control">
                              <input type="radio" id="month1" name="showsafetytipfrom" class="custom-control-input" value="This Month">
                              <label class="custom-control-label label1" for="month1">This Month</label>
                            </div>
                            <div class="inputGroup custom-control">
                              <input type="radio" id="year1" name="showsafetytipfrom" class="custom-control-input" value="This Year">
                              <label class="custom-control-label label1" for="year1">This Year</label>
                            </div>
                          </div>
                        </div></div></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <?php $this->load->view('../includes/footer'); ?>

              <style>
                .homePage .main-content {
                  margin-top: 12px !important;
                }
                #country, #city {
                  background: White;
                }
                .gmap_canvas {
                  height: 400px;  /* The height is 400 pixels */
                  width: 100%;  /* The width is the width of the web page */
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
              
              <!-- Google MAP Script -->
              <script defer src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&amp&libraries=geometry,places">
              </script>
              <!-- Incident Tab Script -->
              <script src="<?php echo base_url(); ?>application/modules/home/scripts/home_incidents.js"></script>
              <!-- Safetytip Tab Tab Script -->
              <script src="<?php echo base_url(); ?>application/modules/home/scripts/home_safetytip.js"></script>

              <script type="text/javascript">
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
                    $.cookie("country_id", 102);
                }     
                if(!$.cookie("country")){
                    $.cookie("country", "India");
                }     
                if(!$.cookie("city")){
                    $.cookie("city", "Mumbai");
                }     
                // code change by sonam - 14-10-2020 end

                var lang_id = $.cookie("lang_id");
                var language_id = $.cookie("language_id");
                var country = $.cookie("country");
                var client_id = $.cookie("client_id");
                var city = $.cookie("city");

                // code change by sonam - 14-10-2020 start
                var country_id = $.cookie("country_id");
                // $('#country').val(country);
                // $('#city').val(city);
                // code change by sonam - 14-10-2020 end



                var lat = 19.076090;
                var longi = 72.877426;
                var default_reported_incident_data = {lang_id: lang_id, client_id: client_id, city: city};
                $(".location-filter").hide();
                var baseURL = "<?php echo base_url() ?>";
                
                $(document).ready(function() {
                  //$(".location-filter").hide();
                  document.getElementById('loc_info').innerHTML = city+', '+country;                  
                  var incident_map_input = document.getElementById('incident_searchBtn');
                  map_autocomplete_init(incident_map_input); //Automplete map search
                  var safetytip_map_input = document.getElementById('safetytip_searchBtn');
                  map_autocomplete_init(safetytip_map_input); //Automplete map search
                  showMap(lat, longi); //Incident Map
                  showSafetyTipMap(lat, longi); //Safety Tip Map
                  load_categories(); //Load Categories for shared incident filter modal
                  load_reportedincident(default_reported_incident_data);
                  load_safetytip(default_reported_incident_data);
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

                  var country_arr = city_arr = new Array();
                  
                  $(".Location-done").click(function() {
                    if(cityLen!=0){
                        $('.validdation_city').remove();
                        $('.validdation_country').remove();
                        var country_id = $('#field-country').val();
                        var country = $('#country').val();
                        var city_id = $('#field-city').val();
                        var city = $('#city').val();

                        if(jQuery.inArray(country, country_arr) !== -1){
                            if(jQuery.inArray(city, city_arr) !== -1){
                                if(country == '' && city == '') {
                                  $('input#country').after('<div class="validdation_country" style="color:white;">Please Select Country</div>');
                                  $('input#city').after('<div class="validdation_city" style="color:white;">Please Select City</div>');
                                  return false;
                                }
                                else if(country == '') {
                                  $('input#country').after('<div class="validdation_country" style="color:white;">Please Select Country</div>');
                                  return false;
                                }
                                else if(city == '') {
                                  $('input#city').after('<div class="validdation_city" style="color:white;">Please Select City</div>');
                                  return false;
                                }
                                else {
                                  document.getElementById('loc_info').innerHTML = city+', '+country;
                                  $(".loc-information").show();
                                  $(".location-filter").hide();
                                  
                                  $.cookie("country", country);
                                  $.cookie("country_id", country_id);                      
                                  $.cookie("city_id", city_id);
                                  $.cookie("city", city);

                                  default_reported_incident_data['city'] = city;
                                  load_reportedincident(default_reported_incident_data);
                                  load_safetytip(default_reported_incident_data);

                                  // code changed by sonam - 19-10-2020 start
                                  loadIncident_description();
                                  loadSafetyTip_description();
                                  // code changed by sonam - 19-10-2020 end

                                  // console.log($.cookie());
                                  $('.Location-done').removeAttr('disabled');
                                }
                            }else {
                                $('.cityErr').html('<div class="validdation_country" style="color:white;">Please Select City</div>');
                            }
                        } else {
                              $('.countryErr').html('<div class="validdation_country" style="color:white;">Please Select Country</div>');
                              $('.Location-done').attr('disabled','disabled');
                        }
                    } else {
                        $('.cityErr').html('<div class="validdation_city" style="color:white;">No city found</div>');
                        $('.Location-done').attr('disabled','disabled');
                    }
                  });

                  //Clear All Filters
                  $('#incidents_filter_clr').click(function() {
                    $('input:checkbox[name="sexual_violence"]').prop('checked', false);
                    $('input:checkbox[name="timeofdayform"]').prop('checked', false);
                    $('input:radio[name="showincidentsform"]').prop('checked', false);
                    countfilter = 0; //Count zero after removing all selection
                    $('.cntfilter').remove(); //Remove filter count span

                    //var default_reported_incident_data = {lang_id: lang_id, client_id: client_id, city: city};
                    load_reportedincident(default_reported_incident_data);

                  });

                  // To Change Change Country and City
                  $(".change-btn").click(function() {
                    document.getElementById('loc_info').innerHTML = '';
                    $(".loc-information").hide();
                    $(".location-filter").show();
                  });

                  //Country List
                  if ($('input#country').length > 0) {
                    //$('input#country').css('color','black');                    
                    $('input#country').typeahead({
                      highlight: true,
                      hint: true,
                      //blurOnTab: true,
                      //backdrop: true,
                      displayText: function(item) {
                        country_arr.push(item.country_name);
                        if(item.country_name != $("#country").val()){
                            $('.countryErr').html('<div class="validdation_country" style="color:white;">Please Select Country</div>');
                        } else {
                            $('.countryErr').empty();
                        }
                        return item.country_name                        
                      },
                      afterSelect: function(item) {
                        this.$element[0].value = item.country_name;
                        $("input#field-country").val(item.country_id);
                        country_id = item.country_id;
                        $('.validdation_country').remove();
                      },
                      source: function (query, process) {                        
                        $.ajax({
                          url: "<?php echo base_url() . 'home/getCountryAutocomplete'; ?>",
                          data: {query:query},
                          dataType: "json",
                          type: "POST",
                          success: function (data) {
                              process(data);
                          }
                        })
                      }
                    });
                  }

                  var cityLen = 0;

                  //City List
                  if ($('input#country').length > 0) {
                    $('input#city').typeahead({
                      displayText: function(item) {
                        $('.Location-done').removeAttr('disabled');
                        city_arr.push(item.city_name);
                        if(item.city_name.toLowerCase() != $("#city").val()){
                            $('.cityErr').html('<div class="validdation_country" style="color:white;">Please Select City</div>');
                        } else {
                            $('.cityErr').empty();
                            $('.Location-done').removeAttr('disabled');
                        }
                        return item.city_name
                      },
                      afterSelect: function(item) {
                        this.$element[0].value = item.city_name;
                        $("input#field-city").val(item.city_id);
                        city_id = item.city_id;
                        $('.validdation_city').remove();
                      },
                      source: function (query, process) {
                        $.ajax({
                          url: "<?php echo base_url() . 'home/getCityAutocomplete'; ?>",
                          data: {query:query, country_id:country_id},
                          dataType: "json",
                          type: "POST",
                          success: function (data) {
                              process(data);
                              cityLen = data.length;
                          }
                        })
                      }   
                    });
                  }

                  //Safety Tip Filter Start
                  //On Apply Click of Filter Modal
                  $('#safetytip_filter_apply').click(function() {
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
                    
                    var area = '';
                    /*var lang_id = 1;
                    var client_id = 1;
                    var area = '';
                    var city = 'Mumbai';*/
                    
                    var filtered_reported_safety_data = {lang_id: lang_id, client_id: client_id, city: city};

                    if (area != "") {
                      filtered_reported_safety_data['area'] = area;
                    }
                    if (safetytip_reported_on != "") {
                      // console.log("Safety Tip Reported On: ",safetytip_reported_on.slice(0,-1));
                      filtered_reported_safety_data['reported_on'] = safetytip_reported_on.slice(0,-1);
                    }

                    //Passed filter params to this function to load incident data according to filter
                    load_safetytip(filtered_reported_safety_data);

                  });

                  //Clear All Filters from Main
                  $('#safetytip_filter_clr').click(function() {
                    $('input:radio[name="showsafetytipfrom"]').prop('checked', false);
                    safety_countfilter = 0; //Count zero after removing all selection
                    $('.cntsafetyfilter').remove(); //Remove filter count span
                    load_safetytip(default_reported_incident_data);
                  });

                  //Clear All Filters from Modal Clear
                  $('#safetytip_filter_clear').click(function() {
                    $('input:radio[name="showsafetytipfrom"]').prop('checked', false);
                    safety_countfilter = 0; //Count zero after removing all selection
                    $('.cntsafetyfilter').remove(); //Remove filter count span
                    load_safetytip(default_reported_incident_data);
                  });
                  //Safety Tip Filter End

                  // code added by sonam - 14-12-2020 start
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
              
    

