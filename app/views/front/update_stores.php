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
<title>Update Offline Stores | <?php $admis = $this->front_model->getadmindetails_main(); echo $admis->site_name; ?></title>
<?php $this->load->view('front/css_script'); ?>
<style>
.error {
  color:#ff0000 !important;
  font-weight:normal !important;
}
.required_field {
  color:#ff0000 !important;
}
</style>
</head>

<body>
<?php $this->load->view('front/header_off');?>

<section class="login-sec clearfix contacts-index-index">

<div class="container">
<!-- <h3 class="text-center text-uppercase">Update Your Stores</h3>
<div class="bor bg-red"></div> -->
    <div class="row">
    <?php $this->load->view('front/sun_menu'); ?>
    <div class="col-md-9">

      <div class="all clearfix">
           <div class="panel-heading">
                <h4 class="panel-title text-uppercase text-center mar-top10">Update Store</h4>
                <div class="bor bg-red"></div>
              </div>
          
         <?php $error = $this->session->flashdata('error');
       if($error!="") {
        echo '<div class="alert alert-danger">
        <button data-dismiss="alert" class="close">x</button>
        <strong>'.$error.'</strong></div>';
      } ?>
    <?php
      $success = $this->session->flashdata('success');
        if($success!="") {
        echo '<div class="alert alert-success">
          <button data-dismiss="alert" class="close">x</button>
          <strong>'.$success.' </strong></div>';
      } ?>
    <?php
      $atrtibute = array('role'=>'form','name'=>'regform','id'=>'regform','method'=>'post','class'=>'j-forms','enctype'=>'multipart/form-data');
      echo form_open('update_offline_stores',$atrtibute);
    ?>
        
        <div class="fieldset">
            <h4>Store Information</h4>
            <hr>
            <div class="form-list">
            
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Store Name <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
        <input type="text" id="store_name" value="<?php echo $result->store_name; ?>"  name="store_name"  maxlength="255" class="input-text required-entry form-control"  />
            </div>
            
            </div>
               <div class="form-group  clearfix">
                <label class="col-md-4 ">Store Logo <em class="clr-red">*</em></label>
                <div class="col-md-8">
                  <input type="file" name="store_image" value="<?php echo $result->store_logo; ?>" id="store_image" />
                  <p id="display_error_img"></p>
                </div>
              </div>
			  
             <div class="form-group clearfix"> 
            <label class="col-md-4 ">&nbsp;</label>		
<div class="col-md-8">			
			 <img src="<?php echo base_url();?>uploads/offline_stores/<?php echo $result->store_logo; ?>" style="height:100px;width:100px;">
			 </div>
            </div>
    <!--   <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Store Logo <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
              <input type="file" id="store_image" name="store_image" class=""  /></div>
            
            </div> -->
            
       
            <input type="hidden" value="<?php echo $count; ?>" id="addr_count">   
                   <input  type="hidden" name="hide_increid" id="hide_increid" value="<?php echo $count; ?>">  
             
            <?php if($row)
              {
              	              //  print_r($row);
                  $i=0;
                  foreach($row as $res)
                  {
                    $i++;
             ?>
             <div id="inner_lat_<?php echo $i; ?>" > 
            <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Address<em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
                <input id="autocomplete_<?php echo $i;?>"  data-id='<?php echo $i;?>' placeholder="Enter your address" onFocus="initAutocomplete(<?php echo $i;?>)" type="text" name="address[]" class="input-text required-entry form-control autos" value="<?php echo $res->address; ?>" >
            </input>
              <!-- <textarea id="address" name="address[]" value="<?php echo $res->address; ?>"   class="input-text required-entry form-control"  />-->
                <?php //echo $res->address; ?>
              </textarea>
            </div>
            <input name="street_number[]" id="street_number_<?php echo $i;?>" type="hidden" value="<?php echo $res->street_address; ?>">
            <input name="route[]" type="hidden" id="route_<?php echo $i;?>" value="<?php echo $res->street_address; ?>">
            <input name="lat[]" type="hidden" id="lat_<?php echo $i;?>" value="<?php echo $res->latitude; ?>">
            <input name="lng[]" type="hidden" id="lng_<?php echo $i;?>" value="<?php echo $res->longtitude; ?>">
            <input name="postal_code[]" id="postal_code_<?php echo $i;?>" type="hidden" value="<?php echo $res->postal_code; ?>">
            <input name="country[]" id="country_<?php echo $i;?>" type="hidden" value="<?php echo $res->country; ?>"> 
            <input name="locality[]" id="locality_<?php echo $i;?>" type="hidden" value="<?php echo $res->city; ?>">
            <input name="administrative_area_level_1[]" id="administrative_area_level_1_<?php echo $i;?>" type="hidden" value="<?php echo $res->state; ?>">
            </div>
              
              <!-- <div class="form-group  clearfix">
            
            <label class="col-md-4 ">latitude <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
              <input type="text" id="latitude" name="latitude[]" value="<?php echo $res->latitude ?>"  maxlength="12" class="input-text required-entry form-control"  /></div>
            
            </div>
              <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Longtitude <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
              <input type="text" id="longtitude" value="<?php echo $res->longtitude; ?>" name="longtitude[]"  maxlength="12" class="input-text required-entry form-control"  /></div>
            
            </div> -->

           <?php if($i!='1')
       {?>
  <a href="javascript:;" onclick="func_removewings('<?php echo $i; ?>');" >
                      <input type="button" id="btnAdd" class="btn btn-danger bor-rad-0" value="delete" name="register">
              </a><?php }?> 
             <input type="hidden" name="store_id" value="<?php echo $result->store_id; ?>">
             <?php }?></div><?php } else{ ?>
                No Address Details Found
             <?php } ?>
             <div id="main_latdiv"> 

             </div>
              <div class="form-group  clearfix">
       
            <label class="col-md-4 "></label>
            <div class="col-md-8">
                    <input type="button" id="btnAdd" class="btn btn-danger bor-rad-0 " value="Add New" name="register" onclick="funct_showmorelat();" >
            
            </div>
      
            
          
            </div>

            
        </div>
		<div class="form-group  clearfix">
       
            <label class="col-md-6 "></label>
            <div class="col-md-6">
         <input type="submit" class="btn btn-success bor-rad-0 " value="Save" name="register">
		 </div></div>
            
              <?php  echo form_close();?>
        
      </div><!-- field set -->
</div>
    
</div>
</section>

<?php $this->load->view('front/sub_footer');

  $this->load->view('front/site_intro');  
?>
<?php $this->load->view('front/js_scripts'); ?>
<?php $this->load->view('front/js_getscrript'); ?>
<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete(id) {
	        // Create the autocomplete object, restricting the search to geographical
        // location types.
		var search_id = id;
		 $('#addr_count').val(parseInt(search_id));
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete_'+id)),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
		var addr_count = parseInt(document.getElementById('addr_count').value);
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

   var geo = String(place.geometry.location);
var geo_re = geo.substring(1, geo.length-1);
     // console.log(geo_re);  
       var latttt = geo_re.split(",", 1);   
       // alert(latttt);
       // var longgggg = geo_re.split(","); 
       var longgggg = geo_re.split(",");   
       // alert(longgggg);
     //  var lngs=longgggg.split(',');

       $("#lat_"+addr_count).val(latttt); 
       $("#lng_"+addr_count).val(longgggg[1]); 
       
        for (var component in componentForm) {
          document.getElementById(component+'_'+addr_count).value = '';
          /*document.getElementById(component).disabled = false;*/
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.

        for (var i = 0; i < place.address_components.length; i++) {
        	//alert(i);
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) 
		  {
           		var val = place.address_components[i][componentForm[addressType]];
           		//alert(val);
	            document.getElementById(addressType+'_'+addr_count).value = val;
          }
		  else
		  {
			  /*alert(addressType);
			  document.getElementById(addressType+'_'+addr_count).value = '';*/
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
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
	  
	  

    </script>  
<script src="<?php echo base_url();?>front/js/jquery.validate.min.js"></script> 
<script type="text/javascript">
/* form validation*/
 $(document).ready(function() {
  $("#regform").validate({
    rules: {
      store_name: {
        required: true
      },
      
      address: {
        required: true
      },
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
    //alert(nextval);
	var get_script = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&libraries=places&callback=initAutocomplete";
     $.ajax({

     type: "POST",

     url: "<?php echo base_url(); ?>cashback/update_ajax_morelatdiv",

     data: {'nextval':nextval},

     success: function(msg)
     {  
		 //$.getScript(get_script);
        
         $('#main_latdiv').append(msg);
          $("#hide_increid").val(nextval); 
           $('#addr_count').val(nextval);
        // $('script').last().remove();
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
