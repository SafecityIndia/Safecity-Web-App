$(document).ready(function() {
      $(document).on('click','.main_menu',function(){
          $.cookie("menu_police", '');
          $.cookie("fir_menu", '');
      });
      $(document).on('click','.dropdown_menu',function(){
          // $.cookie("fir_menu", '');
      });
      $(document).on('click','.police_dropdown',function(){
          $.cookie("menu_police", 'yes');
          $.cookie("fir_menu", '');
      });
      $(document).on('click','.fir_menu',function(){
          $.cookie("fir_menu", 'yes');
      });
      
      try {
          console.log('load');
          var mainLat = $.cookie('mapLat');
          var mainLong = $.cookie('mapLong');
          var mainAdd = $.cookie('mapAdd');
          var radius = 3000;

          const location1 = new google.maps.LatLng(mainLat, mainLong);
          const options = {
            center: location1,
            zoom: 15,
            animation: 'DROP',
            draggable:true,
            // disableDefaultUI: true,
            scaleControl: true,
            fullscreenControl: false,
            scaleControl: true
          }
          var map = new google.maps.Map(document.getElementById("mapouter"), options);
          var infoWindows = [];
          showMap(mainLat,mainLong,mainAdd);

          $(document).on('click','.btnSubmit',function(){
              window.location.href="policestation_listing";
          });

          function addMarkersToMap(markers,map) {
              for (let marker of markers) {
                  let position = new google.maps.LatLng(marker.latitude, marker.longitude);
                  let mapMarker = new google.maps.Marker({
                    position: position,
                    title: marker.title,
                    latitude: marker.latitude,
                    longitude: marker.longitude,
                    animation: 'DROP',
                     draggable:true, 
                  });

                  mapMarker.setMap(map);

                  google.maps.event.addListener(mapMarker, 'dragend', function()
                  {
                      var markerlatlong = mapMarker.getPosition();
                      var lat= JSON.stringify(mapMarker.getPosition().lat());
                      var longi = JSON.stringify(mapMarker.getPosition().lng());

                      $.cookie('mapLat',lat)                                 
                      $.cookie('mapLong',longi) 
                      //code for getting formatted address from the selected latitude and longitude 

                      var geocoder = new google.maps.Geocoder();
                      const latlng = {
                        lat: parseFloat(lat),
                        lng: parseFloat(longi)
                      };
                      geocoder.geocode(
                        { location: latlng },
                        (
                          results,
                          status
                        ) => {
                          if (status === "OK") {
                            if (results[0]) {
                              
                              title =  results[0].formatted_address;
                              $.cookie('mapAdd',title)

                              let position = new google.maps.LatLng(mapMarker.getPosition().lat(), mapMarker.getPosition().lng());
                                
                              mapMarker.position = position,
                              mapMarker.title = title,
                              mapMarker.latitude = mapMarker.getPosition().lat(),
                              mapMarker.longitude = mapMarker.getPosition().lng(),
                              mapMarker.animation = 'DROP',
                              mapMarker.draggable =true, 

                              mapMarker.setMap(map);
                              addInfoWindowToMarker(mapMarker);

                              var data = {'latitude' : mapMarker.getPosition().lat(), 'longitude' : mapMarker.getPosition().lng(), 'title' : title}
                              markers = data;
                          
                            } else {
                              window.alert("No results found");
                            }
                          } else {
                            window.alert("Geocoder failed due to: " + status);
                          }
                        }
                      );
                
                  });

                  addInfoWindowToMarker(mapMarker);
              }
          }

          function addInfoWindowToMarker(marker) {
              let infoWindowContent = '<div id="content">' +
                                        '<h5 id="firstHeading" class"firstHeading">' + marker.title + '</h5>' +
                                        '<p>Latitude: ' + marker.latitude + '</p>' +
                                        '<p>Longitude: ' + marker.longitude + '</p>' +
                                      '</div>';

              let infoWindow = new google.maps.InfoWindow({
                content: infoWindowContent
              });
              infoWindows.push(infoWindow);
          }

          function closeAllInfoWindows() {
            for(let window of infoWindows) {
              window.close();
            }
          }

          function placeMarkerAndPanTo(latLng,map) {
            new google.maps.Marker({
              position: latLng,
              map: map
            });
            map.panTo(latLng);
          }

          function showMap(lat,long,address) {
             if(google!=''){
                  var markersArr = [{
                      'title' : mainAdd,
                      'latitude' : mainLat,
                      'longitude' : mainLong
                  }];

                  addMarkersToMap(markersArr,map);
              } else {
                  setTimeout(function(){ location.reload(); }, 1000);
              }
          }

      }
      catch(err) {
          console.log(err.message);
          location.reload();
      }
});