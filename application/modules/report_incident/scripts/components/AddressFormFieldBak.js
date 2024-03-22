var addressFormField = (function() {

	var latitude  = '19.076090';
	var longitude = '72.877426';
	var map = mapMarker ='';

	function nextClick() {

		var properties = JSON.parse(currentQuestion.properties);
		var answer_id = 0;
		var building = $("input[name="+currentQuestion.elementId+"building]").val();
		var landmark = $("input[name="+currentQuestion.elementId+"landmark]").val();
		var area = $("input[name="+currentQuestion.elementId+"area]").val();
		var city = $("input[name="+currentQuestion.elementId+"city]").val();
		var state = $("input[name="+currentQuestion.elementId+"state]").val();
		var country = $("input[name="+currentQuestion.elementId+"country]").val();
		var latitude = $("input[name="+currentQuestion.elementId+"latitude]").val();
		var longitude = $("input[name="+currentQuestion.elementId+"longitude]").val();

		if (building == "" || landmark == "" || area == "" || city == "" || state == "" || country == "") {
			if (building == "") {
				if(!$('.locality').next('.validdation_locality').length) {
					$('.locality').after('<div class="validdation_locality" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				}
			}
			if (landmark == "") {
				if(!$('.landmark').next('.validdation_landmark').length) {
					$('.landmark').after('<div class="validdation_landmark" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				}
			}
			if (area == "") {
				if(!$('.suburb').next('.validdation_suburb').length) {
					$('.suburb').after('<div class="validdation_suburb" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				}	
			}
			if (city == "") {
				if(!$('.city').next('.validdation_city').length) {
					$('.city').after('<div class="validdation_city"><div style="color:red;">'+properties.validations[0]["message"]+'</div>');
				}
			}
			if (state == "") {
				if(!$('.state').next('.validdation_state').length) {
					$('.state').after('<div class="validdation_state" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				}
			}
			if (country == "") {
				if(!$('.country').next('.validdation_country').length) {
					$('.country').after('<div class="validdation_country" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				}
			}
			$("#dynamicNext").attr("disabled", "disabled");
			return false;
		}
		else {
			$("#dynamicNext").removeAttr("disabled");
		}
		
		var answerJson = {
			"option_id": answer_id,
			"answer": "",
			"address": {
				"building": building, 
				"landmark": landmark, 
				"area": area, 
				"city": city, 
				"state": state, 
				"country": country,
				"latitude": latitude,
				"longitude": longitude
			}
		};

		// Save and proceed
		saveCurrentAnswer(answer_id, answerJson);
	}

	function updateMarker() {
		var location = new google.maps.LatLng(latitude, longitude);
		mapMarker.setPosition(location);
		map.setCenter(location);
	}
	
	function initAutoComplete(elementInitial) {
		// Create the autocomplete object, restricting the search predictions to
	    // geographical location types.
	    var autocomplete = new google.maps.places.Autocomplete(
	      // document.getElementById('autocomplete').getElementsByTagName('input')[0],
	      document.getElementById(elementInitial+'building'),
	      { componentRestrictions: {country: ["in", "uk"]} }
	    );

	    // Avoid paying for data that you don't need by restricting the set of
	    // place fields that are returned to just the address components.
	    //autocomplete.setFields(["address_component", "geometry"]);
	    autocomplete.setFields(["geometry"]);
	  
	    // When the user selects an address from the drop-down, populate the
	    // address fields in the form.
	    autocomplete.addListener("place_changed", function() {
	        var  place = autocomplete.getPlace();
	        console.log(place);
	        latitude  = place.geometry.location.lat();
	        longitude = place.geometry.location.lng();
	        updateMarker();

	        /*var latitude  = place.geometry.location.lat();
	        var longitude = place.geometry.location.lng();
	        document.getElementById(elementInitial+'latitude').value  = latitude;
	        document.getElementById(elementInitial+'longitude').value = longitude;

	        document.getElementById(elementInitial+'country').value = '';
	        document.getElementById(elementInitial+'city').value = '';
	        document.getElementById(elementInitial+'state').value = '';
	        document.getElementById(elementInitial+'area').value = '';	        
	        document.getElementById(elementInitial+'landmark').value = '';
	        //document.getElementById(elementInitial+'building').value = '';
	        
	        var addcomponent = place.address_components;
	        for(var i = 0 ; i < addcomponent.length ; i++)
	        {
	            if(addcomponent[i].types[0] == 'country') {
	              document.getElementById(elementInitial+'country').value = addcomponent[i].long_name;
	            }
	            else if(addcomponent[i].types[0] == 'locality') {
	              document.getElementById(elementInitial+'city').value = addcomponent[i].long_name;
	            }
	            else if(addcomponent[i].types[0] == 'administrative_area_level_1') {
	              document.getElementById(elementInitial+'state').value = addcomponent[i].long_name;
	            }
	            else if(addcomponent[i].types[0] == 'sublocality_level_1') {
	              document.getElementById(elementInitial+'area').value = addcomponent[i].long_name;
	            }
	            else if(addcomponent[i].types[0] == 'sublocality_level_2') {
	              document.getElementById(elementInitial+'building').value = addcomponent[i].long_name;
	            }
	            else if(addcomponent[i].types[0] ==  'postal_code') {
	              document.getElementById(elementInitial+'landmark').value = addcomponent[i].long_name;
	            }
	        }*/

	    });
	}
	
	return function(data, properties, lastQuestion) {	
		currentQuestion.elementId = "option" + data["question"]["id"];
		var answerJson = lastQuestion != null ? lastQuestion.currentQuestion.answerJson : "";
		var building = answerJson != "" ? answerJson.address.building: "";
		var landmark = answerJson != "" ? answerJson.address.landmark: "";
		var area = answerJson != "" ? answerJson.address.area: "";
		var city = answerJson != "" ? answerJson.address.city: "";
		var state = answerJson != "" ? answerJson.address.state: "";
		var country = answerJson != "" ? answerJson.address.country: "";
		var latitude = answerJson != "" ? answerJson.address.latitude: "";
		var longitude = answerJson != "" ? answerJson.address.longitude: "";
		// var elementHtml = `
		// 	<div class="form-group">
		// 	  <label class="themeColor">Enter Address<span class="error">*</span></label>
		// 	  <input type="text" class="form-control locality" id="option${data["question"]["id"]}building" name="option${data["question"]["id"]}building" placeholder="Write here" value="${building}">
		// 	</div>
		// 	<span class="localityInfo"></span>
		// 	<div class="form-group">
		// 	  <label class="themeColor">Landmark<span class="error">*</span></label>
		// 	  <input type="text" class="form-control landmark" id="option${data["question"]["id"]}landmark" name="option${data["question"]["id"]}landmark" placeholder="Write here" value="${landmark}">
		// 	</div>
		// 	<span class="landmarkInfo"></span>
		// 	<div class="row">
		// 	  	<div class="col-md-6 col-sm-12 col-xs-12">
		// 			<div class="form-group">
		// 			  <label class="themeColor">Area/Suburb<span class="error">*</span></label>
		// 			  <input type="text" class="form-control suburb" id="option${data["question"]["id"]}area" name="option${data["question"]["id"]}area" placeholder="Write here" value="${area}">
		// 			</div>
		// 			<span class="suburbInfo"></span>
		// 		</div>
		// 		<div class="col-md-6 col-sm-12 col-xs-12">
		// 			<div class="form-group">
		// 			  <label class="themeColor">City<span class="error">*</span></label>
		// 			  <input type="text" class="form-control city" id="option${data["question"]["id"]}city" name="option${data["question"]["id"]}city" placeholder="Write here" value="${city}">
		// 			</div>
		// 			<span class="cityInfo"></span>
		// 		</div>
		// 	</div>
		// 	<div class="row">
	 //            <div class="col-md-6 col-sm-12 col-xs-12">
		// 			<div class="form-group">
		// 		  		<label class="themeColor">State<span class="error">*</span></label>
		// 		  		<input type="text" class="form-control state" id="option${data["question"]["id"]}state" name="option${data["question"]["id"]}state" placeholder="Write here" value="${state}">
		// 			</div>
		// 			<span class="stateInfo"></span>
		// 		</div>
		// 		<div class="col-md-6 col-sm-12 col-xs-12">
		// 			<div class="form-group">
		// 			  <label class="themeColor">Country<span class="error">*</span></label>
		// 			  <input type="text" class="form-control country" id="option${data["question"]["id"]}country" name="option${data["question"]["id"]}country" placeholder="Write here" value="${country}">
		// 			</div>
		// 			<span class="countryInfo"></span>
		// 		</div>
		// 		<input type="hidden" id="option${data["question"]["id"]}latitude" name="option${data["question"]["id"]}latitude" value="${latitude}">
		// 		<input type="hidden" id="option${data["question"]["id"]}longitude" name="option${data["question"]["id"]}longitude" value="${longitude}">
		// 	</div>
		// 	<div class="noteColor mt-3 mb-3">
		// 	  <label>An exact location will help us identify patterns of violence across the city.</label>
		// 	</div>
		// `;
		 var elementHtml = `
		 <div class="form-group mb-4">
		 	  <label class="themeColor m-0 p-0 d-block">${locate_address_on_map}<span class="error">*</span></label>
		 	   <label class="mb-2 p-0 sub-label d-block">Start typing and select your location/nearest location from suggestions</label>
		 	  <input type="text" class="form-control form-text" id="option${data["question"]["id"]}building" name="" placeholder="Start Typing" value="">
			</div>

			<div class="form-group mb-4">
		 	  <label class="themeColor m-0 p-0 d-block">Please move the pin to the exact location</label>
		 	   <label class="mb-3 p-0 sub-label d-block">An exact location will help us identify patterns of violence across the city</label>
				<div class="mapouter" style="height:467px">
				<!-- image placeholder -->
				<!-- <img src="assets/images/map1.jpg" class="img-fluid" alt="remove image and add map code here. map height should be 467px"> -->
				</div>
			</div>

			<div class="form-group mb-4">
		 	  <label class="themeColor m-0 p-0 d-block">Address pinned on map:</label>
		 	   <p class="m-0 pt-0 pinned-add">University of Gloucestershire Oxstalls Campus, Oxstalls Ln, Longlevens GL2 9HW, United Kingdom</p>
			</div>

			 <div class="form-group mb-4">
		 	  <label class="themeColor mb-2 p-0 d-block">Enter Building/Street/Locality</label>
		 	  <input type="text" class="form-control form-text" id="" name="" placeholder="Example: A wing, Pratap Apartments, Kurla Road" value="">
			</div>

			<p class="mt-4 pt-2 lignheight20">
		The information that you share with us anonymously helps shape policy and decision making. Please confirm that you are submitting information true to your knowledge. You can go back and edit your answers before submitting, if needed.
		</p>

		<div class="custom-control custom-checkbox estimate mt-1">
		<input type="checkbox" name="option15checked" class="custom-control-input estimate map_estimate" id="estimate">
		<label class="custom-control-label eLabel" for="estimate">I confirm</label>
		</div>
		 `;
		$("#options").html(elementHtml);
		//$(".locality").focus();
		$("#options input:text").eq(0).focus();
		
		$("#dynamicNext").removeAttr("disabled");

		$(".locality").keyup(function(e){
			$('.validdation_locality').remove();
			$('.validdation_landmark').remove();
			$('.validdation_suburb').remove();
			$('.validdation_city').remove();
			$('.validdation_state').remove();
			$('.validdation_country').remove();
			if (($(".locality").val()) != "") {
				$('.validdation_locality').remove();
				$("#dynamicNext").removeAttr("disabled");
			}
			else {
				$('.locality').after('<div class="validdation_locality" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				$("#dynamicNext").attr("disabled", "disabled");
			}
	    });

	    $(".landmark").keyup(function(e){
			$('.validdation_landmark').remove();
			if (($(".landmark").val()) != "") {
				$('.validdation_landmark').remove();
				$("#dynamicNext").removeAttr("disabled");
			}
			else {
				$('.landmark').after('<div class="validdation_landmark" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				$("#dynamicNext").attr("disabled", "disabled");
			}
	    });

		$(".suburb").keyup(function(e){
			$('.validdation_suburb').remove();
			if ($(".suburb").val() != "") {
				$("#dynamicNext").removeAttr("disabled");
			}
			else {
				$('.suburb').after('<div class="validdation_suburb" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				$("#dynamicNext").attr("disabled", "disabled");
			}
	    });

	    $(".city").keyup(function(e){
	    	$('.validdation_city').remove();
			if ($(".city").val() != "") {
				$("#dynamicNext").removeAttr("disabled");
			}
			else {
				$('.city').after('<div class="validdation_city" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				$("#dynamicNext").attr("disabled", "disabled");
			}
	    });

	    $(".state").keyup(function(e){
	    	$('.validdation_state').remove();
			if ($(".state").val() != "") {
				$("#dynamicNext").removeAttr("disabled");
			}
			else {
				$('.state').after('<div class="validdation_state" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				$("#dynamicNext").attr("disabled", "disabled");
			}
	    });

	    $(".country").keyup(function(e){
	    	$('.validdation_country').remove();
			if ($(".country").val() != "") {
				$("#dynamicNext").removeAttr("disabled");
			}
			else {
				$('.country').after('<div class="validdation_country" style="color:red;">'+properties.validations[0]["message"]+'</div>');
				$("#dynamicNext").attr("disabled", "disabled");
				
			}
	    });

	    // Enable autocomplete
	    if(google) {
	    	initAutoComplete('option'+data["question"]["id"]);

			// Set map
		    var location = new google.maps.LatLng(latitude, longitude);
		    var options = {
				center: location,
				zoom: 15,
				animation: 'DROP',
				draggable:true,
			    fullscreenControl: false,
			    scaleControl: true,
			};
			map = new google.maps.Map(document.getElementsByClassName("mapouter")[0], options);

			// Set Marker
			mapMarker = new google.maps.Marker({
				position: location,
                // title: marker.title,
                latitude: latitude,
                longitude: longitude,
                animation: 'DROP',
                draggable:true, 
            });
			mapMarker.setMap(map);

			// On drag end
			google.maps.event.addListener(mapMarker, 'dragend', function() {
				var markerlatlong = mapMarker.getPosition();
				var latitude = JSON.stringify(mapMarker.getPosition().lat());
				var longitude = JSON.stringify(mapMarker.getPosition().lng());
			});
	    }

	    // Add new event listener
	    $("#dynamicNext").off('click').click(function(event) {
	    	event.preventDefault();
	    	nextClick();
	    });
	}

})();
