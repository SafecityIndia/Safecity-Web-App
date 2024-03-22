/*var myVar;

function myFunction() {
  myVar = setInterval(alertFunc, 1);
}

function alertFunc() {
  location.reload();
}*/



$(document).ready(function() {
      var localitySafe = $(".locality").val();
      var landmarkSafe = $(".landmark").val();
      var citySafe = $(".city").val();
      var stateSafe = $(".state").val();
      var countrySafe = $(".country").val();
      if(localitySafe!='' && landmarkSafe!='' && citySafe!='' && stateSafe!='' && countrySafe!=''){
        $(".safetyBtn").removeAttr("disabled");
      } else {
        $(".safetyBtn").attr("disabled", "disabled");      
      }

      $('.landmark').keyup(function(){
          var inputValue =  $(".landmark").val().length;
          var localValue =  $(".locality").val().length;
          console.log(localValue,"===");
          if(inputValue > 0 && localValue > 0){
              $(".safetyBtn").removeAttr("disabled");
          } else {
              $(".safetyBtn").attr("disabled", "disabled");
          }

          if(inputValue > 0){
              $('.landmarkErr').hide();
          } else {
              $(".landmarkErr").html("This field is required").css('color','red').show();
          }
      });

      $('.locality').keyup(function(){
          var inputValue =  $(".locality").val().length;
          var localValue =  $(".landmark").val().length;
          if(inputValue > 0 && localValue > 0){
              $(".safetyBtn").removeAttr("disabled");
          } else {
              $(".safetyBtn").attr("disabled", "disabled");
          }

          if(inputValue > 0){
              $('.localityErr').hide();
          } else {
              $(".localityErr").html("This field is required").css('color','red').show();
          }
      });

      try{
          if(google){
              google.maps.event.addDomListener(window, 'load', initAutocomplete);
              initAutocomplete();

              // share safety tips start
                  $(document).on('click','.shareLoc',function(){
                      var localitySafe = $(".locality").val();
                      var landmarkSafe = $(".landmark").val();
                      var citySafe = $(".city").val();
                      var stateSafe = $(".state").val();
                      var countrySafe = $(".country").val();
                      if(localitySafe==''){
                        $(".localityErr").html("This field is required").css('color','red').show();
                        return false;
                      } else {
                          $('.localityErr').hide();
                          $.cookie("localitySafe", localitySafe);
                      }
                      if(landmarkSafe==''){
                          $(".landmarkErr").html("This field is required").css('color','red').show();
                          return false;
                      } else {
                          $('.landmarkErr').hide();
                          $.cookie("landmarkSafe", landmarkSafe);
                      }
                      if(citySafe==''){
                          $(".cityErr").html("This field is required").css('color','red').show();
                          return false;
                      } else {
                          $('.cityErr').hide();
                          $.cookie("citySafe", citySafe);
                      }
                      if(stateSafe==''){
                          $(".stateErr").html("This field is required").css('color','red').show();
                          return false;
                      } else {
                          $('.stateErr').hide();
                          $.cookie("stateSafe", stateSafe);
                      }
                      if(countrySafe==''){
                          $(".countryErr").html("This field is required").css('color','red').show();
                          return false;
                      } else {
                          $('.countryErr').hide();
                          $.cookie("countrySafe", countrySafe);
                      }
                      if(localitySafe!='' && landmarkSafe!='' && citySafe!='' && stateSafe!='' && countrySafe!=''){
                        $.cookie('safety_tip_url', 'shareSafetyTips,shareSafetyMap');
                        $.cookie('l_u', 'shareSafetyMap');
                        window.location.href="shareSafetyMap";
                      }
                  });

                  /*$(".locality").keypress(function (e) {
                      $('.localityErr').hide();
                  });
                  $(".landmark").keypress(function (e) {
                      $('.landmarkErr').hide();
                  }); 
                  $(".city").keypress(function (e) {
                      $('.cityErr').hide();
                  });
                  $(".state").keypress(function (e) {
                      $('.stateErr').hide();
                  });
                  $(".country").keypress(function (e) {
                      $('.countryErr').hide();
                  });*/
              // share safety tips End

              $(document).on('change','.getLatLong',function(){
                  getlatlong();
              });
              
          } else {
              console.log('errrr');
              google.maps.event.addDomListener(window, 'load', initAutocomplete);
              initAutocomplete();
              // location.reload();
          }

          var country_disable = false;
          var city_disable = false;
          var state_disable = false;
          var locality_disable = false;
          var landmark_disable = false;
          var suburb_disable = false;

          function initAutocomplete() {
            // alert(1);
                // Create the autocomplete object, restricting the search predictions to
                // geographical location types.
                var autocomplete = new google.maps.places.Autocomplete(
                  // document.getElementById('autocomplete').getElementsByTagName('input')[0],
                  document.getElementById("autocomplete"),
                  // { types: ["geocode"] ,componentRestrictions: {country: 'in'}}
                  { types: ["geocode"]}
                );
                
                // console.log(111,'===',autocomplete);

                // Avoid paying for data that you don't need by restricting the set of
                // place fields that are returned to just the address components.
                autocomplete.setFields(["address_component"]);
              
                // When the user selects an address from the drop-down, populate the
                // address fields in the form.
                autocomplete.addListener("place_changed", fillInAddress =>{
                      var  autoadd = autocomplete.getPlace();
                        var autoadd1 = autoadd.address_components;
                      // console.log(autoadd1)
                      for(var i = 0 ; i < autoadd1.length ; i++)
                      { 
                            if(autoadd1[i].types[0] == 'country')
                            {
                              // safetyForm.controls['country'].setValue(autoadd1[i].long_name)
                              document.getElementById('country').value = autoadd1[i].long_name;
                              country_disable = true
                            }
                            else if(autoadd1[i].types[0] == 'locality')
                            {
                              // safetyForm.controls['city'].setValue(autoadd1[i].long_name)
                              document.getElementById('city').value = autoadd1[i].long_name;
                              city_disable = true
                            }
                            else if(autoadd1[i].types[0] == 'administrative_area_level_1')
                            {
                              // safetyForm.controls['state'].setValue(autoadd1[i].long_name)
                              document.getElementById('state').value = autoadd1[i].long_name;
                              state_disable = true
                            }
                            else if(autoadd1[i].types[0] == 'sublocality_level_2')
                            {
                              // safetyForm.controls['landmark'].setValue(autoadd1[i].long_name);
                              document.getElementById('autocomplete').value = autoadd1[i].long_name;
                              landmark_disable = true;
                            }
                            else if(autoadd1[i].types[0] ==  'postal_code')
                            {
                              // safetyForm.controls['suberb'].setValue(autoadd1[i].long_name);
                              // document.getElementById('landmark').value = autoadd1[i].long_name;
                              // suburb_disable = true
                            }
                      }
                });
          }

          function getlatlong() {
                var address2 = $('.locality').val() +','+ $('.landmark').val() +','+ $('.city').val() +','+ $('.state').val() +','+ $('.country').val()
                  // console.log(address2)
                  var geocoder = new google.maps.Geocoder();
                  var city,hascity,address = address2
                  geocoder.geocode({ 'address': address }, function (results, status) {
                      if (status == google.maps.GeocoderStatus.OK)
                      {
                         // console.log(results)
                         var address = JSON.stringify(results[0].formatted_address);
                         var lat= JSON.stringify(results[0].geometry.location.lat());
                         var longi = JSON.stringify(results[0].geometry.location.lng()); 
                         
                         //locations = new google.maps.LatLng(lat, longi);
                         
                         console.log(lat)
                         console.log(longi)       
                         console.log(address);
                         $.cookie('lat_safety',lat)                                 
                         $.cookie('longi_safety',longi) 
                         $.cookie('address_safety',address)                                 
                      }
                  });
          }
      }
      catch(err) {
          console.log(err.message);
          location.reload();
      }

  });