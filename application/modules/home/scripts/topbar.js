var lang_id = $.cookie("lang_id");
var client_id = $.cookie("client_id");
var country = $.cookie("country");
var country_id = $.cookie("country_id");
var city = $.cookie("city");
var city_id = $.cookie("city_id");

//var country_arr = city_arr = new Array();
$("#city").prop('disabled',true);

// $('#country').val(country);
// $('#city').val(city);

function reverseGeocode(city, country) {
  var geoLat = 19.076090;
  var geoLng = 72.877426;
  var geocoder =  new google.maps.Geocoder();
  geocoder.geocode( { 'address': city+', '+country}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        geoLat = results[0].geometry.location.lat();
        geoLng = results[0].geometry.location.lng();
        $.cookie('lat', geoLat);
        $.cookie('lng', geoLng);
        location.reload();
        //setCityMap([geoLat, geoLng]);
    } else {
      console.log('failed to get lat lng with status', status);
      location.reload();
      //setCityMap([geoLat, geoLng]);
    }
  });
}

function setCityMap(coordinates) {
  showMap(coordinates[0], coordinates[1]); //Incident Map
  showSafetyTipMap(coordinates[0], coordinates[1]); //Safety Tip Map
}

$(".location-filter").hide();
// document.getElementById('loc_info').innerHTML = city+', '+country;
if(city=='The'){
	document.getElementById('loc_info').innerHTML = city+' '+country;
}else{
	document.getElementById('loc_info').innerHTML = city+', '+country;
}

// To Change Change Country and City
$(".change-btn").click(function() {
  document.getElementById('loc_info').innerHTML = '';
  //div show or hide
  $(".loc-information").hide();
  $(".location-filter").show();
  //set cookies values to country and city
  if($.cookie("country")=='World'){ 
	  $('input#country').val();
	$('input#city').val(); 
  }else{
	$('input#country').val($.cookie("country"));
	$('input#city').val($.cookie("city"));
  }
  $('.Location-done').attr('disabled','disabled'); //Disable Done button
  $("#city").prop('disabled',false); //Remove Disable prop of city
  console.log("country and city: ",$.cookie("country_id"),$.cookie("country"),$.cookie("city_id"),$.cookie("city"));
});

$(".Location-done").click(function() {
  if(cityLen!=0){
    $('.validdation_city').remove();
    $('.validdation_country').remove();

    if(country == '' && city == '') {
      $('input#country').after('<div class="validdation_country" style="color:white;">'+home_country_error+'</div>');
      $('input#city').after('<div class="validdation_city" style="color:white;">'+home_city_error+'</div>');
      return false;
    }
    else if(country == '') {
      $('input#country').after('<div class="validdation_country" style="color:white;">'+home_country_error+'</div>');
      return false;
    }
    else if(city == '') {
      $('input#city').after('<div class="validdation_city" style="color:white;">'+home_city_error+'</div>');
      return false;
    }
    else {
      if(city=='The'){
			document.getElementById('loc_info').innerHTML = city+' '+country;
		}else{
			document.getElementById('loc_info').innerHTML = city+', '+country;
		}
      $(".loc-information").show();
      $(".location-filter").hide();

      $.cookie("country", country);
      $.cookie("country_id", country_id);
      $.cookie("city_id", city_id);
      $.cookie("city", city);
      lat = $.cookie('lat') || 19.076090;
      longi = $.cookie('lng') || 72.877426;

      console.log("latlong:", lat, longi);

      /*default_reported_incident_data['city'] = city;
      default_reported_safetytip_data['city'] = city;*/

      reverseGeocode(city, country);
      console.log("latlong:", lat, longi);
      /*loadIncident_description();
      loadSafetyTip_description();*/

      $('.Location-done').removeAttr('disabled');
      //location.reload();
    }
  } else {
    $('.cityErr').html('<div class="validdation_city" style="color:white;">'+home_city_no_data+'</div>');
    $('.Location-done').attr('disabled','disabled');
  }
});

//Country List
if ($('input#country').length > 0) {
  $('input#country').typeahead({
    highlight: true,
    hint: true,
    //blurOnTab: true,
    //backdrop: true,
    displayText: function(item) {
      return item.country_name
    },
    afterSelect: function(item) {
      $("#city").prop('disabled',false);
      this.$element[0].value = item.country_name;
      $("input#field-country").val(item.country_id);
      $("input#country").val(item.country_name);
      $("input#field-city").val('');
      $("input#city").val('');
      //country_id = item.country_id;
      $('.validdation_country').remove();
      /*$.cookie("country", item.country_name);
      $.cookie("country_id", item.country_id);
      country_id = $.cookie("country_id");*/
      country = item.country_name;
      country_id = item.country_id;
      console.log(country_id);
    },
    source: function (query, process) {
      $.ajax({
        url: baseURL + 'home/getCountryAutocomplete',
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
      return item.city_name
    },
    afterSelect: function(item) {
      this.$element[0].value = item.city_name;
      $("input#field-city").val(item.city_id);
      city_id = item.city_id;
      $('.validdation_city').remove();
      $('.cityErr').empty();
      $('.Location-done').removeAttr('disabled');
      /*$.cookie("city_id", item.city_id);
      $.cookie("city", item.city_name);
      country_id = $.cookie("country_id");*/
      city    = item.city_name;
      city_id = item.city_id;
    },
    source: function (query, process) {
      $.ajax({
        url: baseURL + 'home/getCityAutocomplete',
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