var latlong_safetytip = []; //safety tip tab
var markersListSafetyTip = [];
var clusterListSafetyTip = [];
var country_id = null;
var city_id = null;                
var safetytip_reported_on = "";
var safety_countfilter = 0;
var pagination_safety_data_arr = {};

function getTimeFromDate(datetime) {
  var datetime = new Date(datetime);
  var hours   = datetime.getHours(); //returns 0-23
  var minutes = datetime.getMinutes(); //returns 0-59
  var seconds = datetime.getSeconds(); //returns 0-59

  time = hours + ':' + minutes + ':' + seconds
  return time
}

//filter count number for safety start
function count_safety_filter(safety_countfilter) {
  if (safety_countfilter > 0) {
    $('#safetytip_filter_set').append('<span class="number-circle cntsafetyfilter">'+safety_countfilter+'</span>');
  }
  else {
    $('.cntsafetyfilter').remove();
  }
}
//filter count number for safety end

//Safety API
var topSafetytipData = '';
function load_safetytip(reported_safetytip_data) {
  console.log("load reported_safetytip_data: ", reported_safetytip_data);
  if(topSafetytipData!='' && reported_safetytip_data['map_zoom']<=15) {
      setSafetytipListings(reported_safetytip_data, topSafetytipData);
      return true;
  }
  $.ajax({
    type: "POST",
    url: baseURL+'api/get-safety-tips',
    data: reported_safetytip_data,
    success:function(data) {
      if(reported_safetytip_data['map_zoom']<=15)
        topSafetytipData = data;
        setSafetytipListings(reported_safetytip_data, data);
    }
  });
}

function setSafetytipListings(reported_safetytip_data, data) {
  console.log("load_reportedincident success: ", reported_safetytip_data, data);
  if(data.total == 0) {
      $('#pagination_safety_div').css('display','none');
      if ("reported_on" in reported_safetytip_data) {
        $("#safetytip_list").html('<div class="no-safetytip-found">'+safety_tip_period_error+'</div>');
      } else {
        $("#safetytip_list").html('<div class="no-safetytip-found">'+safety_tip_no_data+'</div>');
      }
      //$('#safety_next').css('display','none');
      //$('#safety_prev').css('display','none');
  } else {
    $('#pagination_safety_div').css('display','block');
  }

  //removeSafetyTipMarkers();
  if (data.total > 0) {
    if (data.data) {
      var datalen = data.data.length;
    }
    if (datalen > 0) {
      lat = data.data[0].latitude;
      longi = data.data[0].longitude;
      markers = data.data[0];

      safetytipReport(data);
      pagination_safety_data_arr = {'reported_safety': reported_safetytip_data, 'reported_safety_result': data};
    }
  }
  //loadMap(data.map_data);
}

//api/safety-tip/map-coordinates/
//api/safety-tip/details

/*function load_safetytip(reported_safetytip_data) {                    
  // console.log("safety tip: ", reported_safetytip_data);
  $.ajax({
    type: "POST",
    url: baseURL+'api/get-safety-tips',
    // url: "http://101.53.143.7/~dataduck/safecity_webapp/api/get-safety-tips",
    data: reported_safetytip_data,
    success:function(data) {
      // console.log("safety tips view: ",data);

      //$("#safety_showing_record").text('');
      if(data.total == 0) {
          $('#pagination_safety_div').css('display','none');
          if ("reported_on" in reported_safetytip_data) {
            $("#safetytip_list").html('<div class="no-safetytip-found">'+safety_tip_period_error+'</div>');
          } else {
            $("#safetytip_list").html('<div class="no-safetytip-found">'+safety_tip_no_data+'</div>');
          }
          //$('#safety_next').css('display','none');
          //$('#safety_prev').css('display','none');
      } else {
        $('#pagination_safety_div').css('display','block');
      }
      // code change by mahesh - 28-10-2020 end

      removeSafetyTipMarkers();
      if (data.total > 0) {
        if (data.data) {
          var datalen = data.data.length;
        }
        if (datalen > 0) {
          lat = data.data[0].latitude;
          longi = data.data[0].longitude;
          markers = data.data[0];

          safetytipReport(data);
          pagination_safety_data_arr = {'reported_safety': reported_safetytip_data, 'reported_safety_result': data};
        }
      }
    }
  });                    
}*/

//Safety Tip data load start
function safetytipReport(data) {
  var elementHtml = '';
  var safetytiplength = data.data.length;
  //latlong_safetytip = [];
  //latlong_safetytips = [];

  /*if (safetytiplength > 0) {*/
    for (var i=0; i<safetytiplength; i++) {
      var safetydata = data.data != null ? data.data[i] : "";
      var safety_tip_title = safetydata.safety_tip_title != null ? safetydata.safety_tip_title : "";
      var safety_tip_desc = safetydata.safety_tip_desc != null ? safetydata.safety_tip_desc : "";
      var safety_tip_id = safetydata.id != null ? safetydata.id : "";
      var safety_tip_country = safetydata.country != null ? safetydata.country : "";
      var safety_tip_state = safetydata.state != null ? safetydata.state : "";
      var safety_tip_city = safetydata.city != null ? safetydata.city : "";
      var safety_tip_location = safetydata.location != null ? safetydata.location : "";
      var safety_tip_exact_location = safetydata.exact_location != null ? safetydata.exact_location : "";
      var safety_tip_landmark = safetydata.landmark != null ? safetydata.landmark : "";

      // code changed by sonam - 20-10-2020 start
      var safety_tip_added_date = safetydata.added_date != null ? safetydata.added_date : "";
      var dayBetween = days_between(safety_tip_added_date);
      var getDaysAgo = (dayBetween > 7 ? ChangeDateFormat(safety_tip_added_date,1) : (dayBetween==0) ? home_today : (dayBetween==1) ? dayBetween+' '+home_day_ago : dayBetween+' '+home_day_ago);
      // code changed by sonam - 20-10-2020 end

      //latlong_safetytip[i] = {"city":safetydata.city, "area":safetydata.location, "latitude":safetydata.map_lat, "longitude":safetydata.map_lon, "safety_tip_title":safety_tip_title};
      //latlong_safetytips[i] = {"city":safetydata.city, "area":safetydata.location, "lat":parseFloat(safetydata.map_lat), "lng":parseFloat(safetydata.map_lon), "safety_tip_title":safety_tip_title};

      elementHtml += `
                <!-- Short Desc Start -->
                <div class="text shortDesc_saftey" data-id="${safety_tip_id}">
                  <div class="incident-title">${safety_tip_title}</div>
                  <div class="place-time">
                    at ${safety_tip_location}  <span class="sepration">.</span> ${home_posted} ${getDaysAgo}
                  </div>
                  <div class="text1">
                    <span class="ellipsis">${safety_tip_desc}</span>
                    <span>
                      <button class="themeColor toggleThis_saftey readbtn mb-3 ml-1" data-id="${safety_tip_id}">${read_more}</button>
                    </div>
                  </div>
                  <!-- Short Desc End -->
                  <!-- Long Desc Start -->
                  <div class="longDesc_saftey" data-id="${safety_tip_id}">
                    <button class="toggleUp_saftey shwobtn" data-id="${safety_tip_id}">
                      <img src="assets/images/icon-feather-arrow-left.svg" class="img-fluid leftIcon">
                    </button>
                    <div class="incident-title">${safety_tip_title}</div>
                    <div class="mb-3"></div>
                    
                    <div class="otherDetails">
                      
                      <div class="row mb-3">
                        <div class="col-md-12">
                          <div class="location">
                            <img src="assets/images/location.svg" class="img-fluid">
                            ${safety_tip_location}
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-12">
                          <div class="iDate">
                            <img src="assets/images/calendar-date-of-incident.svg" class="img-fluid">
                              Posted ${getDaysAgo}
                          </div>
                        </div>
                      </div>
                    </div>
                    <p>${safety_tip_desc}</p>
                    
                  </div>
                  <!-- Long Desc End -->
      `;
    }
  /*}
  else {
    elementHtml = `<div class="incident-title">No incidents are found for this Area</div>`;
  }*/

  //add elementHtml to incidents_list div
  $("#safetytip_list").html(elementHtml);

  //pagination showing current and total records e.g. 1 to 3 of 17
  // $("#safety_showing_record").text(data.showing);
  // code change by sonam - 14-10-2020 start
  $("#safety_showing_record").text('Showing '+data.showing);
  // code change by sonam - 14-10-2020 end

  //If No prev data to show on prev click
  if (data.offset <= 0) {
    $("#safety_prev").css("pointer-events", "none");
  }
  
  //Default Hide Long Description
  $(".longDesc_saftey").hide();

  $( ".toggleType" ).click(function() {     
      $(".toggleContent").toggle("fast");
  });

  $(".toggleThis_saftey").on("click",function() {
      var btnId = $(this).data('id');
      // alert(btnId);
      $('.filter2').hide('fast');
      $('.shortDesc_saftey').hide('fast');
      $('.pg2').hide('fast');
      //$('.shortDesc_saftey[data-id=' + btnId + ']').hide('fast');
      $('.longDesc_saftey[data-id=' + btnId + ']').show('fast');
  });
  
  $(".toggleUp_saftey").on("click",function() {
      var btnId = $(this).data('id');
      $('.longDesc_saftey[data-id=' + btnId + ']').hide('fast');
      //$('.shortDesc_saftey[data-id=' + btnId + ']').show('fast');
      $('.filter2').show('fast');
      $('.shortDesc_saftey').show('fast');
      $('.pg2').show('fast');
  });

  $('#accordion').on('show.bs.collapse', function () {
    //$('.filter2').hide();
    $('.shortDesc_saftey').hide();
    $('.longDesc_saftey').show();
  });

  $('#accordion').on('hide.bs.collapse', function () {
    //$('.filter2').show();
    $('.shortDesc_saftey').show();
    $('.longDesc_saftey').hide();
  });

  //addMarkersToMapSafetyTip(latlong_safetytip);
  //addClusterSafetyMarkersToMap(latlong_safetytips);
}
//Safety Tip data load end

//Safetytip Map View Start
//Show Sefetytip Map Start
function showSafetyTipMap(latitude, longitude) {
  this.lat = latitude;
  this.longi = longitude;
  const location = new google.maps.LatLng(this.lat, this.longi);
  const options = {
    disableDefaultUI: true, // hide all controls of map
    //mapTypeControl: true,
    //scaleControl: true,
    zoomControl: true,
    center: location,
    zoom: 10,
    animation: google.maps.Animation.DROP,
    draggable: true,
    streetViewControl: false,
    // disableDefaultUI: true,
    scaleControl: true,
    fullscreenControl: false
  }
  this.safetytip_map = new google.maps.Map(document.getElementById("safetytip_map"), options);
  
  safetytip_map.addListener('idle', function() {
    var map_current_bounds = [];
    let zoomLevel = safetytip_map.getZoom();
    let edgebounds = safetytip_map.getBounds();
    let ne = edgebounds.getNorthEast(); // Coords of the northeast corner
    let sw = edgebounds.getSouthWest(); // Coords of the southwest corner
    let nw = new google.maps.LatLng(ne.lat(), sw.lng()); // Coords of the NW corner
    let se = new google.maps.LatLng(sw.lat(), ne.lng()); // Coords of the SE corner

    //creating array to pass in API
    //mapedges = {'ne': ne.toString(), 'sw': sw.toString(), 'nw': nw.toString(), 'se': se.toString()};
    //mapedges_bounds = {'edgebounds': edgebounds}
    mapedges = {
      'ne': {lat: ne.lat(), lng: ne.lng()}, 
      'sw': {lat: sw.lat(), lng: sw.lng()}, 
      'nw': {lat: nw.lat(), lng: nw.lng()}, 
      'se': {lat: se.lat(), lng: se.lng()}
    };

    default_reported_safetytip_data['map_zoom'] = zoomLevel;
    default_reported_safetytip_data['map_bound'] = mapedges;
    load_safetytip_coordinates(default_reported_safetytip_data);
    //load_safetytip(default_reported_safetytip_data);
  });

  /*google.maps.event.addListener(safetytip_map, 'idle', function() {
    console.log("Map Event Changed");
  });*/
}
//Show Sefetytip Map End

function load_safetytip_coordinates(reported_safetytip_data) {
  //removeMarkers();
  $.ajax({
    type: "POST",
    url: baseURL+'api/safety-tip/map-coordinates',
    data: reported_safetytip_data,
    success:function(data) {
      removeSafetyTipMarkers();
      if ((data.status == true)) {
        if (data.data) {
          var datalen = data.data.length;
        }
        if (datalen > 0) {
          lat = data.data[0].latitude;
          longi = data.data[0].longitude;
          markers = data.data[0];
          
          // Set Marker Data
          latlongs = [];
          var safetytipdata = data.data;
          //console.log(safetytipdata);
          for (var i=0; i<datalen; i++) {
            latlongs[i] = {"safetytip_id": safetytipdata[i].id, "lat":parseFloat(safetytipdata[i].latitude), "lng":parseFloat(safetytipdata[i].longitude)};
          }
          addClusterSafetyMarkersToMap(latlongs);
        }
      }
      load_safetytip(reported_safetytip_data);
    }
  });
}

/*//Add Marker to Sefetytip Map Start
function addMarkersToMapSafetyTip(markers) {
  //create empty Safetytip LatLngBounds object for zoom
  var safetytip_bounds = new google.maps.LatLngBounds();
  for (let marker of markers) {
    geocoder1 = new google.maps.Geocoder();
    infowindow1 = new google.maps.InfoWindow();
    //console.log(marker.latitude, marker.longitude, marker.area);
    let position = new google.maps.LatLng(marker.latitude, marker.longitude);
    let mapMarker = new google.maps.Marker({
      position: position,
      map: safetytip_map,
      title: marker.area,
      latitude: marker.latitude,
      longitude: marker.longitude,
      html: marker.safety_tip_title+'<br>'+marker.area+', '+marker.city,
      animation: google.maps.Animation.DROP,
      //animation: 'DROP',
      draggable: true,
      icon: 'assets/images/Safetytip_icon.svg',
    });
    markersListSafetyTip.push(mapMarker);
    //extend the bounds to include each marker's position
    safetytip_bounds.extend(mapMarker.position);
    google.maps.event.addListener(mapMarker, 'click', function(event) {
        infowindow1.setContent(this.html);
        //infowindow1.setContent(this.city);
        infowindow1.setPosition(event.latLng);
        infowindow1.open(safetytip_map, this);
    });
  }
  //safetytip_map.setOptions({draggable: false});
  safetytip_map.fitBounds(safetytip_bounds);       // auto-zoom
  safetytip_map.panToBounds(safetytip_bounds);     // auto-center
};
//Add Marker to Sefetytip Map End*/

//MAP Autocomplete Start
function safetytip_autocomplete_init(safetytip_searchtext) {
  var options = {};
  var autocomplete = new google.maps.places.Autocomplete(safetytip_searchtext, options);
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var safety_address = document.getElementById('safetytip_searchBtn').value;
      geocoder = new google.maps.Geocoder();  
      geocoder.geocode( { 'address': safety_address}, function(results, status) {
        if (status == 'OK') {
          safetytip_map.setCenter(results[0].geometry.location);
          safetytip_map.setZoom(20);
          /*var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
          });*/
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
      });
  });
}
//MAP Autocomplete End

function safetytip_viewmore_init(safetytip_id, infoWin) {
  $.ajax({
    type: "POST",
    url: baseURL+'api/safety-tip/details',
    data: {safety_tip_id: safetytip_id},
    success:function(data) {
      if(data.data.id == safetytip_id) {
        map_data = data.data;
        if(map_data) {
          /*var incidents_date = map_data.incident_date != null ? map_data.incident_date : "";
          var incidents_time = '';
          if(map_data.time_to === null) {
            incidents_time = " at " + timeConvert(map_data.time_from);
          }
          else {
            incidents_time = " between " + timeConvert(map_data.time_from)+" - "+timeConvert(map_data.time_to);
          }*/
          //map_htmlContent = "<div style='max-width:200px;'><span class='map-grey'>Type : </span><span class='map-grey map-dark'>#"+map_data.id+' '+map_data.categories+'</span><br>'+"<span class='map-grey'>Location : </span><span class='map-grey map-dark'>"+map_data.area+', '+map_data.city+'</span><br>'+"<span class='map-grey'>Date & Time : </span><span class='map-grey map-dark'>"+ChangeDateFormat(incidents_date,0)+incidents_time+'</span>'+'<br><span class="map-grey"><a href="#" data-toggle="modal" data-target="#incident-viewmore-'+map_data.id+'">View more details</a></span></div>';
          safetytip_map_htmlContent = "<div style='max-width:200px;'><span class='map-grey'>Title : </span><span class='map-grey map-dark'>#"+map_data.safety_tip_title+'</span><br>'+"<span class='map-grey'>Location : </span><span class='map-grey map-dark'>"+map_data.exact_location+'</span><br>'+"<span class='map-grey'>Date & Time : </span><span class='map-grey map-dark'>"+map_data.updated_date+'</span>'+'<br><span class="map-grey"><a href="#" data-toggle="modal" data-target="#safetytip-viewmore-'+map_data.id+'">View more details</a></span></div>',
          infoWin.setContent(safetytip_map_htmlContent);
          safetytip_viewmore(data);
        }
      }
    }
  });
}

function addClusterSafetyMarkersToMap(locations) {
  var infoWin = new google.maps.InfoWindow({disableAutoPan: true});
  // Add some markers to the safetytip_map.
  var markers = locations.map(function(location, i) {
    var marker = new google.maps.Marker({
      position: location,
      //animation: google.maps.Animation.DROP,
      //html: "<span class='map-grey'>Type : </span><span class='map-grey map-dark'>#"+locations[i].city+' '+locations[i].city+'</span><br>'+"<span class='map-grey'>Location : </span><span class='map-grey map-dark'>"+locations[i].area+', '+locations[i].city+'</span><br>'+"<span class='map-grey'>Date & Time : </span><span class='map-grey map-dark'>"+locations[i].dateTime+'</span>'+'<br><span class="map-grey"><a href="#" data-toggle="modal" data-target="#incident-viewmore'+locations[i].safetytip_viewmore_id+'">View more details</a></span>',
      icon: 'assets/images/Safetytip_icon.svg',
    });

    markersListSafetyTip.push(marker);
    marker.set("id", locations[i].safetytip_id);

    google.maps.event.addListener(marker, 'click', function(evt) {
      safetytip_viewmore_init(this.id, infoWin); //To show details of incident
      infoWin.open(map, marker);
      //infoWin.setContent(location.info);
      //infoWin.open(safetytip_map, marker);
      //infoWin.setContent(this.html);
      //infoWin.setContent(this.city);
      //infoWin.setPosition(event.latLng);
      //infoWin.open(safetytip_map, this);
    });

    /*google.maps.event.addListener(marker, 'mouseout', function(evt) {
      infoWin.close();
    });*/
    
    return marker;
  });

  // Options to pass along to the marker clusterer
  const clusterOptions = {
    imagePath: "assets/images/safetytips-cluster",
    maxZoom: 15
    //imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
    //gridSize: 30,
    //zoomOnClick: true,
    //maxZoom: 10,
  };

  // Add a marker clusterer to manage the markers.
  const markerClusterer = new MarkerClusterer(safetytip_map, markers, clusterOptions);
  clusterListSafetyTip.push(markerClusterer);

  // Change styles after cluster is created
  const styles = markerClusterer.getStyles();
  for (let i=0; i<styles.length; i++) {
    styles[i].textColor = "black";
    //styles[i].textSize = 14;
    // To center the text
    styles[i].height = 53;
    styles[i].width = 53;
    styles[i].textLineHeight = 53;
  }
}

//Safetytip Map Remove Start
function removeSafetyTipMarkers() {
    for(j=0; j<clusterListSafetyTip.length; j++) {
        clusterListSafetyTip[j].setMap(null);
    }
    for(i=0; i<markersListSafetyTip.length; i++) {
        markersListSafetyTip[i].setMap(null);
    }
    clusterListSafetyTip = [];
    markersListSafetyTip = [];
}
//Safetytip Map Remove End

//Load incidents reports
function safetytip_viewmore(data) {
  var elementHtml = '';

  var safetydata = data.data != null ? data.data : "";
  console.log("safetydata: ", safetydata);
  var safety_tip_title = safetydata.safety_tip_title != null ? safetydata.safety_tip_title : "";
  var safety_tip_desc = safetydata.safety_tip_desc != null ? safetydata.safety_tip_desc : "";
  var safety_tip_id = safetydata.id != null ? safetydata.id : "";
  var safety_tip_country = safetydata.country != null ? safetydata.country : "";
  var safety_tip_state = safetydata.state != null ? safetydata.state : "";
  var safety_tip_city = safetydata.city != null ? safetydata.city : "";
  var safety_tip_location = safetydata.location != null ? safetydata.location : "";
  var safety_tip_exact_location = safetydata.exact_location != null ? safetydata.exact_location : "";
  var safety_tip_landmark = safetydata.landmark != null ? safetydata.landmark : "";

  // code changed by sonam - 20-10-2020 start
  var safety_tip_added_date = safetydata.added_date != null ? safetydata.added_date : "";
  var dayBetween = days_between(safety_tip_added_date);
  var getDaysAgo = (dayBetween > 7 ? ChangeDateFormat(safety_tip_added_date,1) : (dayBetween==0) ? home_today : (dayBetween==1) ? dayBetween+' '+home_day_ago : dayBetween+' '+home_day_ago);
  // code changed by sonam - 20-10-2020 end

  elementHtml += `
          <div id="safetytip-viewmore-${safety_tip_id}" class="modal fade incident-popup" role="dialog" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" style="max-width:631px !important">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <h4 class="modal-title">Filters</h4> -->
                  <button type="button" class="close" data-dismiss="modal"> <img src="assets/images/close.svg" class="img-fluid"></button>
                </div>
                <div class="modal-body">
                 <div class="longDesc1">
                  <div class="incident-title mb-1">${safety_tip_title}</div>
                  <p>${safety_tip_desc}</p>
                  <div class="otherDetails">
                  <div class="row mb-3">
                      <div class="col-md-12">
                        <div class="location">
                          <img src="assets/images/location.svg" class="img-fluid">
                          ${safety_tip_location}
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-12">
                        <div class="iDate">
                          <img src="assets/images/calendar-date-of-incident.svg" class="img-fluid">
                          ${ConverttoLongDate(safety_tip_added_date)}
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-12">
                        <div class="iTime">
                          <img src="assets/images/time-of-incident.svg" class="img-fluid">
                          ${getTimeFromDate(safety_tip_added_date)}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
  $("#safetytip-viewmore-div").html(elementHtml);
  //$("#safetytip-viewmore").modal('show');
}