<?php
if($this->uri->segment(3)){
	$uniq_id = $this->uri->segment(3);
	$this->session->set_userdata('reg_uniq_id',$uniq_id);
} else if($this->session->userdata('reg_uniq_id')){
	$uniq_id = $this->session->userdata('reg_uniq_id');
} else {
	$uniq_id = '';
}
?>
<?php
	$redirect_urlstring =  uri_string();
	if($redirect_urlstring=="")
	{
	  $redirect_urlstring = 'cashback/index';
	}
	$redirect_endcede = insep_encode($redirect_urlstring);

?>
				
				
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Offline Stores | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>
<style>
.error {
	color:#ff0000 !important;
	font-weight:normal !important;
}
.required_field {
	color:#ff0000 !important;
}

 .map_canvas { float: left; }
      form { width: 300px; float: left; }
      fieldset { width: 320px; margin-top: 20px}
      fieldset label { display: block; margin: 0.5em 0 0em; }
      fieldset input { width: 95%; }
</style>
 
</head>

<body>
<?php $this->load->view('front/header_off');?>

<section class="login-sec clearfix  contacts-index-index">

<div class="container">
<!-- <h3 class="text-center text-uppercase">Add Your Stores</h3>
<div class="bor bg-red"></div> -->
    <div class="row">

      <?php $this->load->view('front/sun_menu'); ?>
	<!-- <div class="login-b content"> -->

 <div class="col-md-9">
            
          
<div class="all clearfix">
           <div class="panel-heading">
                <h4 class="panel-title text-uppercase text-center mar-top10">Add Store</h4>
                <div class="bor bg-red"></div>
              </div>
              <div class="map_canvas"></div>   
              <?php
      $atrtibute = array('role'=>'form','name'=>'regform','id'=>'regform','method'=>'post','class'=>'j-forms','enctype'=>'multipart/form-data');
      echo form_open('cashback/add_offlinestores',$atrtibute);
    ?>
        <div class="fieldset">
            
            <div class="form-list">
            
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Store Name <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
                    <input type="text" id="store_name"  name="store_name"  maxlength="255" class="input-text required-entry form-control" required/>

              <!-- <input type="email" class="form-control" id="exampleInputEmail1"> -->
            </div>
            
            </div>
            
             <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Store Logo <em class="clr-red">*</em> </label>
            
          <div class="col-md-8">  
            <div class="form-group">
              <input type="file" name="store_image" id="store_image"/>
              <p id="display_error_img"></p>

            <!-- <input type="file" id="exampleInputFile"> -->
            </div>
          </div>
            
            </div>
            <input  type="hidden" name="hide_increid" id="hide_increid" value="1">

            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Address <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
             
                <!-- <input id="address1" type="text" placeholder="Type in an address"  name="address" class="input-text required-entry form-control" required> -->
                 <input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text"></input>

                <input id="find" type="button" value="find">
        
          

          <label>Street Number</label>
          <input name="street_number[]" id="street_number1" type="text" value="">


          <label>street address</label>
          <input name="route[]" type="text" id="route1" value="">


          <label>Latitude</label>
          <input name="lat[]" type="text" id="lat1" value="">

          <label>Longitude</label>
          <input name="lng[]" type="text" id="lng1" value="">


          <label>Postal Code</label>
          <input name="postal_code[]" id="postal_code1" type="text" value="">

          <label>Country</label>
          <input name="country[]" id="country1" type="text" value=""> 

                <label>Country</label>
          <input name="locality[]" id="locality1" type="text" value="">



       

          <label>State</label>
          <input name="administrative_area_level_1[]" id="administrative_area_level_11" type="text" value="">

        
      
              
            </div>
            
            </div>



             <div id="main_latdiv"> 

             </div>
            
            <div class="form-group  clearfix">
                <input type="button" id="btnAdd" class="btn btn-danger bor-rad-0 " value="Add New" name="register" onclick="funct_showmorelat();" >
            
            
            </div>

            <div class="form-group  clearfix">
                
            
            <button class="btn btn-success bor-rad-0" value="submit" type="submit"  name="register">Save</button>
            </div>
            
            </div>
            
        </div>
             
            <?php  echo form_close();?>
          <!-- Nav tabs -->
          
        </div>

          
                       
        </div>
</section>

<?php $this->load->view('front/sub_footer');

	$this->load->view('front/site_intro');	
?>
<?php $this->load->view('front/js_scripts'); ?>
 
 <!--
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&libraries=places&callback=initAutocomplete"
        async defer></script> 
    <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number1: 'short_name',
        route1: 'long_name',
        locality1: 'long_name',
        administrative_area_level_11: 'short_name',
        country1: 'long_name',
        postal_code1: 'short_name'
      };  

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
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
 
       $("#lat1").val(latttt); 
       $("#lng1").val(longgggg); 
 
    
  
        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        } 
       
            console.log(place.address_components[0][componentForm['route1']]);  
            $("#route1").val(place.address_components[0][componentForm['route1']]); 
           

              $("#locality1").val(place.address_components[2][componentForm['locality1']]);  
              $("#administrative_area_level_11").val(place.address_components[4][componentForm['administrative_area_level_11']]);  
              $("#country1").val(place.address_components[5][componentForm['country1']]);  
              $("#postal_code1").val(place.address_components[6][componentForm['postal_code1']]);   
  
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
   <!-- 
    <script type="text/javascript" 
   src="https://maps.googleapis.com/maps/api/js?sensor=SET_TO_TRUE_OR_FALSE">
</script> 

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&signed_in=true&libraries=places&callback=iniMap"
        async defer></script>   
    --> 
    
  



<script type="text/javascript">
/* form validation*/
 $(document).ready(function() {
	$("#regform").validate({
		rules: {
			store_name: {
				required: true
			},
			store_image: {
				required: true
			},
      "address[]": "required",
			/*address: {
				required: true
			},*/
			latitude: {
				required: true
			},
			longtitude :{
				required: true
			},	
		},
		messages: {
			store_name: {
				required: "Please enter your Store name."                    
			},
			store_image: {
				required: "Please Upload your Store Image."
				
			},
			address: {
				required: "Please enter  your Address Details."
			},
			latitude: {
				required: "Please enter  your Latitude Details."
			},
			longtitude: {
				required: "Please enter  your Longititude Details."
			},
		}
	});
});

</script>
<script>
  function funct_showmorelat()
  {
      var hide_increid=$("#hide_increid").val(); 
      // alert(hide_increid);
      var nextval=parseInt(hide_increid)+1; 

  	 $.ajax({

     type: "POST",

     url: "<?php echo base_url(); ?>cashback/ajax_morelatdiv",

     data: {'nextval':nextval},

     success: function(msg)
     {  
       	 $("#hide_increid").val(nextval); 
         $('#main_latdiv').append(msg);
          
     }
    });
  }
</script>
<script>
$('#purpose').on('change', function () {
    $("#business").css('display', (this.value == '1') ? 'block' : 'none');
});
</script>
  <script>
        function func_removewings(eleId)
            {
              // alert(eleId);
                var set_ids=parseInt(eleId)-1;
                // alert(set_ids);
                $("#inner_lat_"+eleId).remove();  
            }
  </script>




</body>
</html>
