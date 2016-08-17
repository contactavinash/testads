<div id="inner_lat_<?php echo $nextval; ?>" > 

    <input type="hidden" name="nextval" id="nextval" value="<?php echo $nextval; ?>">
        
    	 <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Address <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
             <input class="input-text required-entry form-control autos" id="autocomplete<?php echo $nextval; ?>" data-id="<?php echo $nextval; ?>"placeholder="Enter your address"
             onFocus="geolocate()" type="text" name="address[]"></input>

             <!--   <input id="find" type="button" value="find"> -->
        
          

        <!--  <label>Street Number</label> -->
          <input name="street_number[]" id="street_number<?php echo $nextval; ?>" type="hidden" value="">


          <!-- <label>street address</label>-->
          <input name="route[]" type="hidden" id="route<?php echo $nextval; ?>" value="">


         <!-- <label>Latitude</label> -->
          <input name="lat[]" type="hidden" id="lat<?php echo $nextval; ?>" value="">

         <!-- <label>Longitude</label> -->
          <input name="lng[]" type="hidden" id="lng<?php echo $nextval; ?>" value="">


        <!--  <label>Postal Code</label> -->
          <input name="postal_code[]" id="postal_code<?php echo $nextval; ?>" type="hidden" value="">

         <!-- <label>Country</label> -->
          <input name="country[]" id="country<?php echo $nextval; ?>" type="hidden" value=""> 

            <!--    <label>City</label> -->
          <input name="locality[]" id="locality<?php echo $nextval; ?>" type="hidden" value="">



       

        <!--  <label>State</label> -->
          <input name="administrative_area_level_1[]" id="administrative_area_level_11" type="hidden" value="">

           
                  <a href="javascript:;" onclick="func_removewings('<?php echo $nextval; ?>');" >
                      <input type="button" id="btnAdd" class="btn btn-danger bor-rad-0 store_add_new" value="delete" name="register">
                </a>

            </div>


    <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var id = $('#hide_increid').val();
      var placeSearch, autocomplete;
      var componentForm = {
        street_number1: 'short_name',
        route1: 'long_name',
        locality1: 'long_name',
        administrative_area_level_11: 'short_name',
        country1: 'long_name',
        postal_code1: 'short_name'
      };  
    //  alert(componentForm) ;

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete'+id)),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);  
       //    autocomplete.addListener('place_changed', fillInAddress,'componentForm'); 
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var lattttsss=place.geometry.location;
    
     // console.log(place); 
     // console.log(lattttsss);  
      // console.log(place.geometry.location.lat);  
    
  
        var geo = String(place.geometry.location);
        var geo_re = geo.substring(1, geo.length-1);
     // console.log(geo_re);  
        var latttt = geo_re.split(",", 1);   
        var longgggg = geo_re.split(",", 2);   
 
        $("#lat"+id).val(latttt); 
        $("#lng"+id).val(longgggg[1]); 
 
    
  
        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        } 
       
            console.log(place.address_components[0][componentForm['route1']]);  
            $("#route"+id).val(place.address_components[0][componentForm['route1']]); 
           

              $("#locality"+id).val(place.address_components[2][componentForm['locality1']]);  
              $("#administrative_area_level_1"+id).val(place.address_components[4][componentForm['administrative_area_level_11']]);  
              $("#country"+id).val(place.address_components[5][componentForm['country1']]);  
              $("#postal_code"+id).val(place.address_components[6][componentForm['postal_code1']]);   
  
  /*         
 route
 sublocality_level_1
 locality
 administrative_area_level_2
 administrative_area_level_1
 country
 postal_code

 */
     // console.log(place.address_components[1][componentForm[sublocality_level_1]]);   
       
         // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {  
       
         
          
          var addressType = place.address_components[i].types[0];
             console.log(addressType); 
          if (componentForm[addressType]) { 
            var val = place.address_components[i][componentForm[addressType]];
        alert(val);  
           
            document.getElementById(addressType).value = val; 
          }
        }
      } 

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
             // autocomplete.setBounds(circle.getBounds());
          });
        }
      } 
</script>
