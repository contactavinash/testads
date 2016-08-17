<!-- update_ajax_morelatdiv -->
<div id="inner_lat_<?php echo $nextval; ?>" > 
    	  <div class="form-group  clearfix">
            
            <label class="col-md-4 ">Address <em class="clr-red">*</em> </label>
            
            <div class="col-md-8">
			  <input id="autocomplete_<?php echo $nextval; ?>" data-id="<?php echo $nextval; ?>"placeholder="Enter your address"
              type="text" name="address[]" class="input-text required-entry form-control autos" onFocus="initAutocomplete(<?php echo $nextval; ?>)"></input>
             
            <!--	<textarea id="address" name="address[]"  maxlength="12" class="input-text required-entry form-control"  /></textarea> -->
            	
            
            
               <input name="street_number[]" id="street_number_<?php echo $nextval; ?>" type="hidden" value="">


          <!-- <label>street address</label>-->
          <input name="route[]" type="hidden" id="route_<?php echo $nextval; ?>" value="">


         <!-- <label>Latitude</label> -->
          <input name="lat[]" type="hidden" id="lat_<?php echo $nextval; ?>" value="">

         <!-- <label>Longitude</label> -->
          <input name="lng[]" type="hidden" id="lng_<?php echo $nextval; ?>" value="">


        <!--  <label>Postal Code</label> -->
          <input name="postal_code[]" id="postal_code_<?php echo $nextval; ?>" type="hidden" value="">

         <!-- <label>Country</label> -->
          <input name="country[]" id="country_<?php echo $nextval; ?>" type="hidden" value=""> 

            <!--    <label>City</label> -->
          <input name="locality[]" id="locality_<?php echo $nextval; ?>" type="hidden" value="">



       

        <!--  <label>State</label> -->
          <input name="administrative_area_level_1[]" id="administrative_area_level_1_<?php echo $nextval; ?>" type="hidden" value="">
            
                

     
              <a href="javascript:;" onclick="func_removewings('<?php echo $nextval; ?>');" >
                      <input type="button" id="btnAdd" class="btn btn-danger bor-rad-0 store_add_new" value="delete" name="register">
                </a>
            
       </div></div>
      
   