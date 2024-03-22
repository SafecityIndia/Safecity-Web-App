var locationPinMapField = (function() {
	
	function nextClick() {

		var answer_id = 0;
		var isAccepted = $("input[name="+currentQuestion.elementId+"checked]").is(':checked');
		var latitude = $("#"+currentQuestion.elementId+"latitude").val();
		var longitude = $("#"+currentQuestion.elementId+"longitude").val();
		var answerJson = {
			"option_id": 0,
			"answer": "",
			"address": {
				"latitude": latitude,
				"longitude": longitude
			},
			"isAccepted": isAccepted
		};

		// Save and proceed
		saveCurrentAnswer(answer_id, answerJson);
	}

	return function(data, lastQuestion) {
		currentQuestion.elementId = "option" + data["question"]["id"];
		var isAccepted = lastQuestion != null ? lastQuestion.currentQuestion.answerJson.isAccepted: false;
		var latitude = lastQuestion != null ? lastQuestion.currentQuestion.answerJson.location.latitude: '';
		var longitude = lastQuestion != null ? lastQuestion.currentQuestion.answerJson.location.longitude: '';
		if(latitude=='' || longitude=='') {
			var prevAnsAdd = selectedAnswers[selectedAnswers.length-1].currentQuestion.answerJson.address;
			latitude = prevAnsAdd.latitude;
			longitude = prevAnsAdd.longitude;

			//$("#dynamicNext").removeAttr("disabled");
		}

		var elementHtml = `
		<div class="text-left">
		<div class="mapouter">
		</div>
		</div>
		<p class="mt-3 lignheight20">
		The information that you share with us anonymously helps shape policy and decision making. Please confirm that you are submitting information true to your knowledge. You can go back and edit your answers before submitting, if needed.
		</p>
		<div class="custom-control custom-checkbox estimate">
		<input type="checkbox" name="option${data["question"]["id"]}checked" class="custom-control-input estimate map_estimate" id="estimate" ${isAccepted?'checked':''} >
		<label class="custom-control-label eLabel" for="estimate">I Confirm</label>
		</div>
		<input type="hidden" id="option${data["question"]["id"]}latitude" name="option${data["question"]["id"]}latitude" value="${latitude}">
		<input type="hidden" id="option${data["question"]["id"]}longitude" name="option${data["question"]["id"]}longitude" value="${longitude}">
		`;
		$("#options").html(elementHtml);

		if(isAccepted && latitude!='' && longitude!='')
			$("#dynamicNext").removeAttr("disabled");

		$('input[name=option'+data["question"]["id"]+'checked]').change(function(event) {
			if($(this).is(':checked'))
				$("#dynamicNext").removeAttr("disabled");
			else
				$("#dynamicNext").attr("disabled", "disabled");
		});

		var location = new google.maps.LatLng(latitude, longitude);
		var options = {
			center: location,
			zoom: 15,
			animation: 'DROP',
			draggable:true,
		    // disableDefaultUI: true,
		    scaleControl: true,
		    fullscreenControl: false,
		    scaleControl: true,
		    // Disable Zoom and pan
		    gestureHandling: 'none',
		    minZoom: 17,
		    maxZoom: 22
		    //zoomControl: false
		};

		// Set map
		var map = new google.maps.Map(document.getElementsByClassName("mapouter")[0], options);

		// Set Marker
		var mapMarker = new google.maps.Marker({
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
			var lat= JSON.stringify(mapMarker.getPosition().lat());
			var lng = JSON.stringify(mapMarker.getPosition().lng());
			$("#option"+data["question"]["id"]+"latitude").val(lat);
			$("#option"+data["question"]["id"]+"longitude").val(lng);
		});

		// Add new event listener
		$("#dynamicNext").off('click').click(function(event) {
			event.preventDefault();
			nextClick();
		});
	}

})();
