$(function () {
    var latitude = $.cookie("lat") || 19.07609;
    var longitude = $.cookie("lng") || 72.877426;
    var map = mapMarker = geocoder = "";
    var building = landmark = area = city = state = country = "";
    var isAccepted = true;

    // Initialize Map and Address Search
    initMap("search_address");

    // On Building Address Changed
    $("#building_address, #area").keyup(function(e){
        if($(this).attr('id')=='building_address')
            building = $(this).val();
        else if($(this).attr('id') == 'area')
            area = $(this).val();
        showAddress();
    });

    $("input[type=text][data-required=true]").keyup(function(event) {
        validateEmpty($(this));
    });

    function validateEmpty($this) {
        if($this.val()=="")
            $this.closest('.form-group').find('.err_msg').text(required_field);
        else
            $this.closest('.form-group').find('.err_msg').text('');
    }

    // On confirmation change
    $("#confirm_address").change(function(event) {
        isAccepted =  $(this).is(':checked');
        showAddress();
    });

    // Add new event listener
    $("#dynamicNext").off('click').click(function(event) {
        event.preventDefault();
        // Set appropriate cookie
        $.cookie('localitySafe', area);
        $.cookie('landmarkSafe', landmark);
        $.cookie('citySafe', city);
        $.cookie('stateSafe', state);
        $.cookie('countrySafe', country);
        $.cookie('address_safety', area+' '+landmark+' '+city+', '+state+', '+country);
        $.cookie('lat_safety', latitude);
        $.cookie('longi_safety', longitude);

        // Add some more cookie just to keep flow runnning
        $.cookie('safety_tip_url', 'shareSafetyTips,shareSafetyMap,shareSafetyTip');
        $.cookie('l_u', 'shareSafetyTip');

        location.replace("shareSafetyTip");
        //nextClick();
    });

    function updateMarker() {
        console.log("updating marker");
        console.log(latitude, longitude);
        var location = new google.maps.LatLng(latitude, longitude);
        mapMarker.setPosition(location);
        map.setCenter(location);
    }

    function initMap(searchFieldId) {
        // Enable autocomplete
        if (google) {
            /////////////
            // Set map //
            /////////////
            var location = new google.maps.LatLng(latitude, longitude);
            var options = {
                center: location,
                zoom: 15,
                animation: "DROP",
                draggable: true,
                fullscreenControl: false,
                scaleControl: true,
            };
            map = new google.maps.Map(
                document.getElementsByClassName("mapouter")[0],
                options
            );

            ////////////////
            // Set Marker //
            ////////////////
            mapMarker = new google.maps.Marker({
                position: location,
                // title: marker.title,
                latitude: latitude,
                longitude: longitude,
                animation: "DROP",
                draggable: true,
            });
            mapMarker.setMap(map);

            // On drag end
            google.maps.event.addListener(mapMarker, "dragend", function () {
                console.log(mapMarker);
                var markerlatlong = mapMarker.getPosition();
                latitude = JSON.stringify(mapMarker.getPosition().lat());
                longitude = JSON.stringify(mapMarker.getPosition().lng());
                // Reverse Geocode to get Address
                geocodeLatLng();
            });

            geocoder = new google.maps.Geocoder();

            ///////////////
            // Searchbox //
            ///////////////

            // Create the search box
            const input = document.getElementById(searchFieldId);
            const searchBox = new google.maps.places.SearchBox(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                console.log(places);
                if (places.length == 0) {
                    resetFields("No results found");
                    return;
                }
                place = places[0];

                // Set Coordinates
                latitude = place.geometry.location.lat();
                longitude = place.geometry.location.lng();
                updateMarker();
                var addcomponent = place.address_components;

                // Set Address
                setAddress(addcomponent);

                /*places.forEach((place) => {
              if (!place.geometry) {
                  console.log("Returned place contains no geometry");
                  return;
              }

                latitude  = place.geometry.location.lat();
                longitude = place.geometry.location.lng();
            });*/
            });
        }
    }

    // Reverse Geocode
    function geocodeLatLng() {
        const latlng = {
            lat: parseFloat(latitude),
            lng: parseFloat(longitude),
        };
        geocoder.geocode({ location: latlng }, (results, status) => {
            console.log(results);
            if (status === "OK") {
                if (results[0]) {
                    // Set Address
                    setAddress(results[0].address_components);
                } else {
                    resetFields("No results found");
                }
            } else {
                resetFields("Geocoder failed due to: " + status);
            }
        });
    }

    function setAddress(addcomponent) {
        // Set Address
        building = landmark = area = city = state = country = "";

        if (addcomponent) {
            var street_number = (route = localbuilding = "");
            for (var i = 0; i < addcomponent.length; i++) {
                if (addcomponent[i].types[0] == "country") {
                    country = addcomponent[i].long_name;
                } else if (
                    addcomponent[i].types[0] == "administrative_area_level_1"
                ) {
                    state = addcomponent[i].long_name;
                } else if (addcomponent[i].types[0] == "locality") {
                    city = addcomponent[i].long_name;
                } else if (
                    addcomponent[i].types[0] == "postal_code" &&
                    landmark == ""
                ) {
                    landmark = addcomponent[i].long_name;
                } else if (addcomponent[i].types[0] == "sublocality_level_1") {
                    area = addcomponent[i].long_name;
                } else if (
                    addcomponent[i].types[0] == "political" &&
                    area == ""
                ) {
                    area = addcomponent[i].long_name;
                } else if (
                    addcomponent[i].types[0] == "sublocality_level_3" ||
                    addcomponent[i].types[0] == "sublocality"
                ) {
                    landmark = addcomponent[i].long_name;
                } else if (addcomponent[i].types[0] == "sublocality_level_2") {
                    localbuilding = addcomponent[i].long_name;
                } else if (addcomponent[i].types[0] == "street_number") {
                    street_number = addcomponent[i].long_name;
                } else if (addcomponent[i].types[0] == "route") {
                    route = addcomponent[i].long_name;
                }
            }
            building = street_number + " " + route;
            building = building.trim() == "" ? localbuilding : building;
        }
        $("#building_address").val(building);
        $("#area").val(area);
        showAddress();
    }

    function resetFields(message) {
        building = landmark = area = city = state = country = "";
        $("#building_address").val("");
        $("#area").val("");
        $(".pinned-add").text("");
        // Show message like Select a valid address
        // Disable next
        $("#dynamicNext").attr("disabled", "disabled");
    }

    function showAddress() {
        var displayaddress =
            building +
            ", " +
            landmark +
            ", " +
            area +
            ", " +
            city +
            ", " +
            state +
            ", " +
            country;
        $(".pinned-add").text(displayaddress.replace(/[, ]{3,}/g, ", "));
        //if(latitude!='' && longitude!='' && area!='' && country!='' && state!='' && isAccepted) {
        if (
            latitude != "" &&
            longitude != "" &&
            area != "" &&
            country != "" &&
            isAccepted
        ) {
            $("#dynamicNext").removeAttr("disabled");
        } else {
            console.log("Country:" + country);
            console.log("State:" + state);
            console.log("Area:" + area);
            console.log("latitude:" + latitude);
            console.log("longitude: " + longitude);
            console.log("isAccepted: " + isAccepted);
            $("#dynamicNext").attr("disabled", "disabled");
        }
    }

});
