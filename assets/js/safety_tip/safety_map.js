
$(document).ready(function() {
      var infoWindows = [];
      try{
          // console.log(11,google);
          if(google){
              google.maps.event.addDomListener(window, 'load', showMap);
              showMap();

              $(document).on('click','.backLocation',function(){
                  location.replace("shareSafetyTips");
              });

              $(document).on('click','.shareMap',function(){
                  $.cookie('safety_tip_url', 'shareSafetyTips,shareSafetyMap,shareSafetyTip');
                  $.cookie('l_u', 'shareSafetyTip');
                  location.replace("shareSafetyTip");
              });
          } else {
              console.log('errrr');
              google.maps.event.addDomListener(window, 'load', showMap);
              showMap();
              // location.reload();
          }

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
                        // console.log(mapMarker)
                        var markerlatlong = mapMarker.getPosition();

                        // console.log("latlong   "+markerlatlong);
                        // console.log("lat    "+mapMarker.getPosition().lat());
                        // console.log("long   "+mapMarker.getPosition().lng());


                        var lat= JSON.stringify(mapMarker.getPosition().lat());
                        var longi = JSON.stringify(mapMarker.getPosition().lng());

                        // localStorage.setItem('lat_report',lat)                                 
                        // localStorage.setItem('longi_report',longi) 
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
                                // localStorage.setItem('address_report',this.title)
                                $.cookie('address_safety',title);
                                $.cookie('lat_safety',mapMarker.getPosition().lat());
                                $.cookie('longi_safety',mapMarker.getPosition().lng());

                                console.log( $.cookie() );

                                 //this.markers = [];
                                // var title = localStorage.getItem('address_report')

                                // var lat1 = localStorage.getItem('lat_report') ;                                
                                // var longi1 = localStorage.getItem('longi_report') 
                                // console.log(title)

                                let position = new google.maps.LatLng(mapMarker.getPosition().lat(), mapMarker.getPosition().lng());
                                  
                                mapMarker.position = position,
                                mapMarker.title = title,
                                mapMarker.latitude = mapMarker.getPosition().lat(),
                                mapMarker.longitude = mapMarker.getPosition().lng(),
                                mapMarker.animation = 'DROP',
                                mapMarker.draggable =true, 
                        

                                mapMarker.setMap(map);
                                //var self = this;
                                addInfoWindowToMarker(mapMarker);

                                var data = {'latitude' : mapMarker.getPosition().lat(), 'longitude' : mapMarker.getPosition().lng(), 'title' : title}
                                markers = data;
                                // console.log('3',markers)
                            
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

                /*marker.addListener('click', () => {
                  closeAllInfoWindows();
                  // infoWindow.open(map, marker);
                });*/
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

          function showMap() {
                // console.log('showMapFunction');
                  var mainLat = $.cookie('lat_safety');
                  var mainLong = $.cookie('longi_safety');
                  var mainAdd = $.cookie('address_safety');
                  // console.log(mainLat,"===",mainLong,"====",mainAdd);
                 // if(google!=''){
                      const location = new google.maps.LatLng(mainLat, mainLong);
                      const options = {
                        center: location,
                        zoom: 15,
                        animation: 'DROP',
                        draggable:true,
                        // disableDefaultUI: true,
                        scaleControl: true,
                        fullscreenControl: false,
                        scaleControl: true
                      }
                      // console.log(options)
                      var map = new google.maps.Map(document.getElementById("mapouter"), options);
               
                      // console.log('3',this.markers)
                      var markersArr = [{
                          'title' : mainAdd,
                          'latitude' : mainLat,
                          'longitude' : mainLong
                      }];

                      addMarkersToMap(markersArr,map);
                  // } else {
                  //     setTimeout(function(){ location.reload(); }, 1000);
                  // }
          }
      }
      catch(err) {
          console.log(err.message);
          location.reload();
      }

  });