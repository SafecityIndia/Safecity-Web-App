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
      
      try{
          // console.log( $.cookie() );

          var mainLat = $.cookie('mapLat');
          var mainLong = $.cookie('mapLong');
          var mainAdd = $.cookie('mapAdd');

          $.cookie('mapAddHospital',mainAdd);

          var radius = 3000;
          var hospitalHTML = startHTML = locHTML = data = markersLen = "";

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
          var infoWindows = markersArr = [];

          listing();

          function listing() {          
              var title = $.cookie('mapAdd');
              var lat1 = $.cookie('mapLat');                                
              var longi1 = $.cookie('mapLong');

              var pyrmont = new google.maps.LatLng(lat1,longi1);
              var request = {
                location: pyrmont,
                radius: radius,
                type: ['hospital']
              };
            
              var service = new google.maps.places.PlacesService(map);
              service.nearbySearch(request,callback =>{
                    console.log(callback);
                    markers = callback;
                    if(markers.length < 3)
                    {
                        radius = radius + 2000
                        listing();
                        return;
                    }

                        // console.log(markers);
                    markersLen = markers.length;
                    for (var i = 0; i < markers.length; i++) {
                        var j = i+1
                        markers[i].imgsrc = 'assets/images/icons/numberlisting/number' + j +'.png'; 
                        markers[i].pinicon = 'assets/images/icons/markericons/number' + j +'.png'; 
                        markers[i].latitude = markers[i].geometry.location.lat(); 
                        markers[i].longitude = markers[i].geometry.location.lng();

                        var vaHtml = startHTML+j;
                        var vaHtml = rating = user_ratings_total = hName = hAdd = '';

                        if(markers[i].rating){
                            rating = markers[i].rating;
                            for (var k = 1; k <= markers[i].rating; k++) {
                                vaHtml += '<span class="fa fa-star checkedrating"></span>';
                            }
                            if(rating % 1 !== 0){
                                vaHtml += '<span class="fas fa-star-half-alt halfstar"></span>';
                            }

                            var blankStar = 5 - markers[i].rating;
                            blankStar1 = blankStar.toString();
                            var array = blankStar1.split(/\.(?=[^\.]+$)/);
                            for (var h = 1; h <= array[0]; h++) {
                                vaHtml += '<span class="fa fa-star uncheckedrating"></span>';
                            }
                        } else {
                              rating = '';
                              vaHtml = '';
                        }

                        if(markers[i].user_ratings_total){
                            user_ratings_total = "("+markers[i].user_ratings_total+")";
                        } else {
                            user_ratings_total = '';
                        }

                        if(markers[i].name){
                            hName = markers[i].name;
                        } else {
                            hName = '';
                        }

                        if(markers[i].vicinity){
                            hAdd = markers[i].vicinity;
                        } else {
                            hAdd = 'Hospital name not found';
                        }

                        var latLong = lat1+','+longi1;
                        var latLong1 = markers[i].latitude+','+markers[i].longitude;
                        // console.log(vaHtml);

                        //var destinationUrl = 'http://maps.google.com/maps?saddr='+latLong+'&daddr='+latLong1;
                        // Updated By Alok to fix incorrect location name
                        var destinationUrl = 'https://www.google.com/maps/dir/?api=1&origin='+latLong;
                        if(markers[i].place_id!=undefined) {
                          destinationUrl += '&destination_place_id='+markers[i].place_id;
                          destinationUrl += '&destination='+escape(markers[i].name);
                        }
                        else {
                          destinationUrl += '&destination='+latLong1;
                        }
                        hospitalHTML += "<div class='add-main'>"+
                                                "<div class='add-title'>"+
                                                    "<img src='"+markers[i].imgsrc+"' class='img-fluid'>"+hName+
                                                "</div>"+
                                                "<div class='rating'>"+rating+vaHtml+user_ratings_total+"</div>"+
                                                "<div class='address'>"+hAdd+
                                                    "<div class='updateMNbr_"+markers[i].place_id+"' style='display:none;'>"+myfunction(markers[i],markers[i].place_id,service)+"</div>"+
                                                "</div>"+
                                                "<div class='direction-icon text-center'>"+
                                                  "<a href='"+destinationUrl+"'>"+
                                                    "<img src='assets/images/direction.svg' class='img-fluid'>"+
                                                  "</a><br>"+map_direction+""+
                                                "</div>"+
                                              "</div>";

                                              // $('.updateMNbr_'+markers[i].place_id).html("");
                    }

                    $('#map_sidebar').append(hospitalHTML);

                    locHTML += map_location+" : "+mainAdd+" <a href='hospital_loc' style='padding-left: 10px;color: #592d8d'>"+map_edit_option+"</a>";
                    $('#mapLocation').append(locHTML);

                    addMarkersToMap(markers);
              },err =>{

              });
          }

              function myfunction(markers,place_id,service)
              {
                  setTimeout(function(){ 
                      // $('.updateMNbr_'+place_id).html("");
                      var placeId = '';
                      // console.log('111',markers);
                      // console.log('222',place_id);
                      var req = {
                        placeId:place_id
                      }
                      // console.log('333',req);

                      service.getDetails(req,callback =>{
                        data = callback;
                        // console.log(data);
                        if(data){
                            var formatted_phone_number = data.formatted_phone_number;
                            // var formatted_phone_number = JSON.stringify(data.formatted_phone_number);
                        } else {
                            myfunction(markers,place_id,service);
                            var formatted_phone_number = '';
                        }

                        /*if(data.formatted_address){
                            var formatted_address = JSON.stringify(data.formatted_address);
                        } else {
                            var formatted_address = '';
                        }*/
                        if(formatted_phone_number){
                            $('.updateMNbr_'+place_id).css('display','block').html(formatted_phone_number);
                        } else {
                            $('.updateMNbr_'+place_id).html("");
                        }
                        // console.log(formatted_phone_number);
                        // return formatted_phone_number;
                      },err=>{
                          myfunction(markers,place_id,service);
                      })
                  }, 1);
              }

          function addMarkersToMap(markers) {
              // console.log(markers);
              for (let marker of markers) {
                  let position = new google.maps.LatLng(marker.latitude, marker.longitude);
                  let mapMarker = new google.maps.Marker({
                    position: position,
                    title: marker.title,
                    latitude: marker.latitude,
                    longitude: marker.longitude,
                    animation: 'DROP',
                    // draggable:true, 
                    icon : marker.pinicon,
                  });

                  mapMarker.setMap(map);

                  google.maps.event.addListener(mapMarker, 'dragend', function()
                  {
                      var markerlatlong = mapMarker.getPosition();
                      var lat= JSON.stringify(mapMarker.getPosition().lat());
                      var longi = JSON.stringify(mapMarker.getPosition().lng());
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

      }
      catch(err) {
          console.log(err.message);
          location.reload();
      }
});