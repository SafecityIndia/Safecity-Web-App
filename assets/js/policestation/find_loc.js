var myVar;

function myFunction() {
  myVar = setInterval(alertFunc, 1);
}

function alertFunc() {
  location.reload();
}

$(document).ready(function(){
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
      
      var inputValue = $(".txtLocation").val();
      if(inputValue==''){
          $(".safetyBtn").attr("disabled", "disabled");
      } else {
          $(".safetyBtn").removeAttr("disabled");
      }

      $('.txtLocation').keyup(function(){
          var inputValue =  $(".txtLocation").val().length;
          if(inputValue > 0){
              $(".safetyBtn").removeAttr("disabled");
          } else {
              $(".safetyBtn").attr("disabled", "disabled");
          }
      });
      
      try {
          console.log('loadSucc');
          console.log( $.cookie() );
          if(google){
              google.maps.event.addDomListener(window, 'load', initAutocomplete);
              initAutocomplete();

              $(document).on('click','.safetyBtn',function(e){
                    var inputValue = $(".txtLocation").val();
                    if(inputValue==''){
                        $(".mapError").html("This field is required").css('color','red').show();
                        return false;
                    } else {
                        $('.mapError').hide();
                        $.cookie("mapLoc", inputValue);

                        var geocoder = new google.maps.Geocoder();
                        var city,hascity,address = inputValue;
                        geocoder.geocode({ 'address': address }, function (results, status) {
                             if (status == google.maps.GeocoderStatus.OK)
                             {
                               address = JSON.stringify(results[0].formatted_address);
                               lat= JSON.stringify(results[0].geometry.location.lat());
                               longi = JSON.stringify(results[0].geometry.location.lng());
                                                          
                               $.cookie("mapLat", lat);
                               $.cookie("mapLong", longi);
                               $.cookie("mapAdd", address);
                               $.cookie("mapAddPolice", address);
                               window.location.href="policestation_map";
                               return false;                      
                            }
                        });
                        console.log( $.cookie() );
                               return false;
                    }
              });

              $(document).on('change','#autocomplete',function(){
                  getlatlong();
              });
          } else {
              console.log('errrr');
              google.maps.event.addDomListener(window, 'load', initAutocomplete);
              // initAutocomplete();
              location.reload();
          }

          function getlatlong() {
              var value = $('.txtLocation').val();
              var geocoder = new google.maps.Geocoder();
              var city, hascity, address = value
              geocoder.geocode({ 'address': address }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  address = JSON.stringify(results[0].formatted_address);
                  lat = JSON.stringify(results[0].geometry.location.lat());
                  longi = JSON.stringify(results[0].geometry.location.lng());

                  $.cookie('mapLat',lat)                                 
                  $.cookie('mapLong',longi) 
                  $.cookie('mapAdd',address)
                  $.cookie('mapAddPolice',address)
                }
              });
          }

          //autocomplete code
          function initAutocomplete() {
              // Create the autocomplete object, restricting the search predictions to
              // geographical location types.
              autocomplete = new google.maps.places.Autocomplete(
                // document.getElementById('autocomplete').getElementsByTagName('input')[0],
                document.getElementById("autocomplete"),
                // { types: ["geocode"] ,componentRestrictions: {country: 'in'}}
              );
          
              // Avoid paying for data that you don't need by restricting the set of
              // place fields that are returned to just the address components.
              autocomplete.setFields(["address_component"]);
            
              // When the user selects an address from the drop-down, populate the
              // address fields in the form.
              autocomplete.addListener("place_changed", fillInAddress =>{
                    autoaddress = []
                    autocomplete.getPlace();
                    var  autoadd = autocomplete.getPlace();
                     autoadd1 = autoadd.address_components;
                    for(var i = 0 ; i < autoadd1.length ; i++)
                    {
                      autoaddress.push(autoadd1[i].long_name)
                    }
                   var final_result = autoaddress.join(',')
                    document.getElementById('autocomplete').value = '';
                    document.getElementById('autocomplete').value = final_result;
              });
          }
      }
      catch(err) {
          console.log(err.message);
          location.reload();
      }
  });