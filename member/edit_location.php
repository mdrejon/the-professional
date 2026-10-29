<?php 
 if (isset($_POST['edit_location'])) {
	$country_id = $_POST['country_id'];
	$region_id = $_POST['region_id'];
	$city_id = $_POST['city_id'];
	$current_location = $_POST['current_location'];
	$lat       =  $_POST['lat'];
    $lng       =  $_POST['lng'];
    $member_address = $_POST['member_address'];
    $post_code = $_POST['post_code'];
    $input_error = array();
	   // First name validation

	    if($current_location == ''){

	      $input_error['current_location'] = "Current location is required";

	    }
		    if (!preg_match("/^([a-zA-Z0-9' -]+)$/", $post_code)) {
	      $input_error['post_code'] = "Please enter valid postal code";
	    }
    
	    // echo count($input_error);
	    if (count($input_error)==0) {

			$sql = "UPDATE ".$db_suffix."member SET 

				country_id = '$country_id',

				region_id = '$region_id',

				city_id = '$city_id',
				member_address = '$member_address',
				post_code = '$post_code',

				member_location = '$current_location',

				member_location_latitude = '$lat',

				member_location_longitude = '$lng'

				WHERE member_id = '".$memmber_id."' ";

	   	 $reslult = $db->update($sql);
	   	 $select_location_sql = "SELECT * FROM ".$db_suffix."member m left join countries c on m.country_id = c.country_id left join states r on m.region_id = r.states_id left join cities ci on m.city_id = ci.city_id  left join ".$db_suffix."categories ca on m.categories_id = ca.categories_id WHERE member_id = '".$member_id."'";
			 $member_location_query = $db->select($select_location_sql);
			$member_location_r = mysqli_fetch_object($member_location_query);
			$country_name = $member_location_r->country_name;
			$region_name = $member_location_r->states_name;
			$city_name = $member_location_r->city_name;
			$location_country_id = $member_location_r->country_id;
			$location_states_id = $member_location_r->region_id;
			$location_city_id = $member_location_r->city_id;
			$member_location = $member_location_r->member_location;
			$member_location_latitude = $member_location_r->member_location_latitude;
			$member_location_longitude = $member_location_r->member_location_longitude;
			$member_address = $member_location_r->member_address;
			$location_post_code = $member_location_r->post_code;

			// $country_name = $member_location_r->country_name;


	 }
}

?>

<style type="text/css">

	.form-content .form-group .user-chk {

		position: absolute;

		top: 40px !important;

	}

	.form-content .form-group {

		position: relative;

	}



</style>

<div id="edit_location" class=" mfp-hide white-popup">
	<div class="container">

		<div class="row">

			<div class="col-lg-12">

				<div class="form-content">

					<form method="POST" accept="#" enctype="multipart/form-data">

						<div class="row">

							<div class="col-lg-6">
								 <div class="form-group form-label country_id_search">
	                              <label class="active" for="country_id">Select Country</label>
	                                <select required class="form-control profession select2 country_id" id="country_id2" name="country_id" onchange="my_fun(this.value);">
	                                    <option>Please select Country</option>
	                                   
	                                    <?php
	                                           $sql_parent_menu = "SELECT * FROM countries";

	                                           $parent_query = $db->select($sql_parent_menu);
	                                          while($parent_obj = mysqli_fetch_object($parent_query))
	                                          {
	                                            if($parent_obj->country_id == $location_country_id)

	                                            {
	                                              echo '<option selected="selected" value="'.$parent_obj->country_id.'">'.$parent_obj->country_name.'</option>';
	                                            }
	                                            else

	                                            {
	                                              echo '<option value="'.$parent_obj->country_id.'">'.$parent_obj->country_name.'</option>';
	                                            }
	                                          }

	                                    ?>
	                                </select>
	                                <?php if (isset($input_error['country_id'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['country_id'].'</label>' ; } ?>
	                            </div>
							</div>
							<div class="col-lg-6">
								 <div class="form-group form-label region_id_search">
	                              <label class="active" for="show-regions">Region/States</label>
	                                <select class="form-control profession select2 region_id" name="region_id" onchange="job_regions_fun(this.value);" id="show-regions">

	                                  <?php
	                                  if (isset($location_country_id)) {
	                                      $sql_parent_menu = "SELECT * FROM states where country_id = '".$location_country_id."'";

	                                           $parent_query = $db->select($sql_parent_menu);
	                                          while($parent_obj = mysqli_fetch_object($parent_query))
	                                          {
	                                            if($parent_obj->states_id == $location_states_id)

	                                            {
	                                              echo '<option selected="selected" value="'.$parent_obj->states_id.'">'.$parent_obj->states_name.'</option>';
	                                            }
	                                            else

	                                            {
	                                              echo '<option value="'.$parent_obj->states_id.'">'.$parent_obj->states_name.'</option>';
	                                            }
	                                          }

	                                  }
	                                  else{
	                                    echo '<option required class="" name=""  selected >Please select region</option>';
	                                  }
	                                          
	                                    ?>
	                                    <!-- <option required class="" name=""  selected >Please Select Your Region</option> -->
	                                    <!-- <option required class="" name=""  selected >Please Select Your Region</option> -->
	                                   <!-- <option>select</option>
	                                    <option>Doctor</option>
	                                    <option>Web Developer</option -->>
	                                </select>
	                                <?php if (isset($input_error['region_id'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['region_id'].'</label>' ; } ?>
	                            </div>
							</div>
							<div class="col-lg-6">
								 <div class="form-group form-label city_id_search">
	                              <label class="active" for="show-city">City</label>
	                                <select name="city_id" class="form-control profession city_id select2" id="show-city"> 
	                                  <?php
	                                  if (isset($location_states_id)) {
	                                    $sql_parent_menu = "SELECT * FROM cities where states_id = '".$location_states_id."'";
	                                           $parent_query = $db->select($sql_parent_menu);
	                                          while($parent_obj = mysqli_fetch_object($parent_query))
	                                          {
	                                            if($parent_obj->city_id == $location_city_id)
	                                            {
	                                              echo '<option selected="selected" value="'.$parent_obj->city_id.'">'.$parent_obj->city_name.'</option>';
	                                            }
	                                            else
	                                            {
	                                              echo '<option value="'.$parent_obj->city_id.'">'.$parent_obj->city_name.'</option>';
	                                            }
	                                          }

	                                  }
	                                  else{
	                                    echo '<option required class="" selected >Please select city</option>';
	                                  }

	                                  ?>
	                                  <!-- <option required class="" selected >Please Select Your City</option> -->
	                                    
	                                   <!-- <option>select</option>
	                                    <option>Doctor</option>
	                                    <option>Web Developer</option> -->
	                                </select>
	                                <?php if (isset($input_error['city_id'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['city_id'].'</label>' ; } ?>
	                            </div>
							</div>
							<div class="col-lg-6">
								<div class="form-group form-label">
	                              <label for="post_code" class="active">Post Code *</label>
	                                <input required type="text" placeholder="Post Code"  name="post_code" id="post_code" class="form-control box" value="<?php echo $location_post_code ?>" />
	                                <div id="post_code_response"></div>
	                                <?php if (isset($input_error['post_code'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['post_code'].'</label>' ; } 
	                                
	                                ?>
	                            </div> 
							</div>
							<div class="col-lg-6">

								<div class="form-group">

									<label>Address </label>

									<input type="text" name="member_address" value="<?php echo $member_address; ?>"   placeholder="Address">

								</div>

							</div>
							<div class="col-lg-6">

								 <div class="form-group form-label abs-search-icon">
	                              <label class="active" for="CurrentLocation2">Locate Your Location</label>
	                              <input type="text" id="CurrentLocation2" value="<?php echo $member_location; ?>"  placeholder="Locate Your Location" name="current_location" class="form-control box" >
	                                    <input id="2lat" name="lat" value="<?php echo $member_location_latitude; ?>" type="hidden">
	                                    <input id="2lng" name="lng" value="<?php echo $member_location_latitude; ?>" type="hidden">
	                                    <input id="sCountry" name="Country" value="" type="hidden">
	                                    <input name="from_page" value="home" type="hidden">
	                                    <!-- <div class="range">
	                                      <input id="slider11" class="border-0" type="range" min="0" max="180"  />
	                                      <div class="">
	                                        <span class="distance"> KM</span>  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>
	                                      </div>
	                                    </div> -->
	                                    <span class="location-track-icon2"><i class="fas fa-map-marker-alt location-track-icon"></i></span>
	                                    <!-- <span class="search-location "><i class="fas fa-globe location-track-icon"></i></span> -->
	                                    <?php if (isset($input_error['current_location'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['current_location'].'</label>' ; } ?>
	                               <!--  <div class="">
	                                  </div> -->
	                        
	                            </div>

							</div>



							<div class="col-lg-12">

								<div class="form-group">

									<button type="submit" name="edit_location">Update</button>

									

								</div>

							</div>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>



<script>
function my_fun(str) {
  
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();

  } else{
    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

  }

  xmlhttp.onreadystatechange= function(){

    if (this.readyState==4 && this.status==200) {
      // alert(str);
      document.getElementById('show-regions').innerHTML = this.responseText;
    }
  }
  xmlhttp.open("GET","<?php echo SITE_URL ?>inc/load_location.php?value="+str, true);
  xmlhttp.send();

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();

  } else{
    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

  }

  xmlhttp.onreadystatechange= function(){

    if (this.readyState==4 && this.status==200) {
      // alert(str);
      document.getElementById('show-code').innerHTML = this.responseText;
    }
  }
  xmlhttp.open("GET","<?php echo SITE_URL ?>inc/load_location.php?valuecode="+str, true);
  xmlhttp.send();

}

function job_regions_fun(str) {
   // alert(str)
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else{
    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange= function(){
    if (this.readyState==4 && this.status==200) {
      document.getElementById('show-city').innerHTML = this.responseText;
    }
  }
   xmlhttp.open("GET","<?php echo SITE_URL ?>inc/load_location.php?value2="+str, true);
  xmlhttp.send();

}
</script>