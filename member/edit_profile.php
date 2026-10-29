<?php 

 if (isset($_POST['edit-profile'])) {

	$member_first_name = $_POST['member_first_name'];

	$member_last_name = $_POST['member_last_name'];

	$member_phone = $_POST['member_phone'];

	$member_religion = $_POST['member_religion'];

	$member_address = $_POST['member_address'];
	$country_code = $_POST['country_code'];

	$categories_id = $_POST['categories_id'];

	$member_description = $_POST['member_description'];

	$member_birth_date = $_POST['member_birth_date'];
	$member_contact_email = $_POST['member_contact_email'];
	$member_contact_phone = $_POST['member_contact_phone'];
	$member_gender = $_POST['member_gender'];
	$member_others_professional = $_POST['member_others_professional'];
	$input_error = array();

	if (isset($member_contact_email)) {
		$member_contact_email = '1' ;
	}else {
		$member_contact_email = '0' ;
	}
	if (isset($member_contact_phone)) {
		 $member_contact_phone = '1' ;
	}else {
		 $member_contact_phone = '0' ;
	}

	

	if($_FILES['member_img']['name'] != '')

        {



            $image_name = rand(10, 1000)."-".$_FILES['member_img']['name'];

      $image_temp =$_FILES['member_img']['tmp_name'];

            $image_dir = "member/images/";

      $move_img = $image_dir.$image_name;

      move_uploaded_file($image_temp, $move_img);



        }else{

        	 $image_name = $_POST['old_member_img'];

        }

	if($_FILES['member_cover_photo']['name'] != '')

        {



            $cover_image_name = rand(10, 1000)."-".$_FILES['member_cover_photo']['name'];

	      $image_temp =$_FILES['member_cover_photo']['tmp_name'];

	            $image_dir = "member/images/";

	      $move_img = $image_dir.$cover_image_name;

	      move_uploaded_file($image_temp, $move_img);



        }else{

        	 $cover_image_name = $_POST['old_member_cover_photo'];

        }

        // Birthdate validation

	    // if (empty($member_birth_date)) {

	    //   $input_error['member_birth_date'] = "Age required";

	    // }

	    if ($_POST['member_birth_date'] < 18 || $_POST['member_birth_date'] > 85) {

	      $input_error['member_birth_date'] = "Age should be 18-99 ";   

	    }

	    // Phone Validation

	    // if (empty($member_phone)) {

	    //   $input_error['member_phone']="phone number requird";

	    // }
	    if (preg_match("/[^0-9\_-]/i", $member_phone)) {

	      $input_error['member_phone']="Mobile number should be number";



	   }

	   // First name validation

	    if (empty($member_first_name)) {

	      $input_error['member_first_name']="First name required";

	    }

	    if(!preg_match("/^[a-zA-Z ]*$/", $member_first_name)){

	      $input_error['firstname']="First name should be alphabet";

	    }

	    if(strlen($member_first_name) > 20){

	      $input_error['firstname']="First name too long";

	    }
	   //  if(!isName($_POST['member_first_name'])){

	   //    $input_error['firstname']="First name should be alphabet";

	   // }  
	      if (empty($member_contact_email) && empty($member_contact_phone)) {
	      $input_error['member_contact']="Email or Phone number must be selected";
	    }


	    // Last name validation

	    if (empty($member_last_name)) {

	      $input_error['lastname'] = "Last name required";

	    }

	    if(!preg_match("/^[a-zA-Z ]*$/", $member_last_name)){

	      $input_error['lastname'] = "Last name should be alphabet";

	    }

	    if(strlen($member_last_name) > 20){

	      $input_error['lastname'] = "Last name too long";

	    }
	   //  if(!isName($_POST['member_last_name'])){

	   //   $input_error['lastname'] = "Last name should be alphabet";

	   // } 



	    // Religion name validation

	    // if (empty($member_religion)) {

	    //   $input_error['member_religion'] = "Last name required";

	    // }

	    // if(!preg_match("/^[a-zA-Z ]*$/", $member_religion)){

	    //   $input_error['member_religion'] = "Last name should be alphabet";

	    // }

	    // if(strlen($member_religion) > 20){

	    //   $input_error['member_religion'] = "Religion too long";

	    // }

		    // First name validation
	    if (empty($member_first_name)) {
	      $input_error['member_first_name']="First name required";
	    }
	    if(!preg_match("/^[a-zA-Z ]*$/", $member_first_name)){
	      $input_error['member_first_name']="First name should be alphabet";
	    }
	    if(strlen($member_first_name) > 20){
	      $input_error['member_first_name']="First name too long";
	    }
	    if(!isName($_POST['member_first_name'])){
	      $input_error['member_first_name']="First name should be alphabet";
	   }  

	    // Last name validation
	    if (empty($member_last_name)) {
	      $input_error['member_last_name'] = "Last name required";
	    }
	    if(!preg_match("/^[a-zA-Z ]*$/", $member_last_name)){
	      $input_error['member_last_name'] = "Last name should be alphabet";
	    }
	    if(strlen($member_last_name) > 20){
	      $input_error['member_last_name'] = "Last name too long";
	    }
	    if(!isName($_POST['member_last_name'])){
	     $input_error['member_last_name'] = "Last name should be alphabet";
	   } 
	   //  if(!isName($_POST['member_religion'])){

	   //   $input_error['member_religion'] = "Religion should be alphabet";

	   // } 

	    if (count($input_error)==0) {

			  $sql = "UPDATE ".$db_suffix."member SET 

				member_first_name = '$member_first_name',

				member_last_name = '$member_last_name',

				member_phone = '$member_phone',
				country_code = '$country_code',

				member_img = '$image_name',
				member_gender = '$member_gender',

				member_cover_photo = '$cover_image_name',

				member_birth_date = '$member_birth_date',
				member_contact_phone = '$member_contact_phone',

				member_contact_email = '$member_contact_email',
				member_others_professional = '$member_others_professional',

				categories_id = '$categories_id',
				member_desc = '$member_description'
				WHERE member_id = '".$memmber_id."' ";
	   	 $db->update($sql);
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

.maxl input {
  width: auto;
  margin-top: 7px;
}
.maxl .radio.inline {
  width: auto;
}


</style>

<div id="edit_profile" class=" mfp-hide white-popup">
	<div class="container">

		<div class="row">

			<div class="col-lg-12">

				<div class="form-content">

					<form method="POST" accept="#" enctype="multipart/form-data">

						<div class="row">

							<div class="col-lg-6">
								<div class="form-group">
									<label>Frist Name <span style="color: red">*</span></label>
									<input type="text" required  name="member_first_name" id="member_first_name" value="<?php echo $member_first_name; ?>" placeholder="Fist Name">
									<div id="first_name_response"></div>
									<?php if (isset($input_error['member_first_name'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['member_first_name'].'</label>' ; } ?>

								</div>

							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label>Last Name <span style="color: red">*</span></label>
									<input type="text" required name="member_last_name" id="member_last_name" value="<?php echo $member_last_name; ?>" placeholder="Last Name">
									<div id="last_name_response"></div>
									<?php if (isset($input_error['member_last_name'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['member_last_name'].'</label>' ; } ?>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group form-label input-group country-code-css country_code_search">
                              <label for="member_phone">Mobile Number <span style="color: red">*</span></label>
                                <div class="input-group cc_code">
                                   <!--  
                                	<input type="text" readonly="" name="country_code" value=" + <?php echo $memmber_country_code ?>"  style="max-width: 100px;"> -->
                                  <select class="custom-select select2 country_code" id="show-code" name="country_code" style="max-width: 140px;">
                                    <!-- <option>Choose Code</option> -->
                                    <?php $country_sql = "SELECT * FROM ".$db_suffix."member where member_id = '".$member_id."'";
										$country_query = $db->select($country_sql);
										$country_code = mysqli_fetch_object($country_query); 
										$location->country_code;
										?>
                                        <?php
                                           $sql_parent_menu = "SELECT * FROM countries order by country_id";

                                           $parent_query = $db->select($sql_parent_menu);
                                          while($parent_obj = mysqli_fetch_object($parent_query))
                                          {
                                            if($parent_obj->country_code == $location_country_code)

                                            {
                                              echo '<option selected="selected" value="'.$parent_obj->country_code.'"> '.$parent_obj->country_name.' (+'.$parent_obj->country_code.')</option>';
                                            }
                                            else

                                            {
                                              echo '<option value="'.$parent_obj->country_code.'">'.$parent_obj->country_name.' (+'.$parent_obj->country_code.')</option>';
                                            }
                                          }

                                    ?>
                                   <!--    <option selected="">+971</option>
                                      <option value="1">+972</option>
                                      <option value="2">+198</option>
                                      <option value="3">+701</option> -->
                                  </select>
                                  <input required type="tel" id="member_phone" name="member_phone" minlength="5" maxlength="11" class="form-control box" placeholder="Type Phone Number" value="<?php echo $member_phone ?>" />
                                  <div id="member_phone_response"></div>
                                <?php if (isset($input_error['member_phone'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['member_phone'].'</label>' ; } ?>
                                    <!-- <input name="" class="form-control" placeholder="Phone number" type="text"> -->
                                  </div> <!-- form-group// -->
                            </div>

							</div>

							<div class="col-lg-6">

								<div class="form-group">

									<label>Age <span style="color: red">*</span></label>

									<input type="text" required name="member_birth_date" id="member_birth_date" value="<?php echo $member->member_birth_date; ?>"   placeholder="Age *">

									<div id="member_birth_date_response"></div>

									<?php if (isset($input_error['member_birth_date'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['member_birth_date'].'</label>' ; } ?>

								</div>

							</div>

							<div class="col-lg-6">

								<div class="form-group" style="margin-top: 10px">
                                <div class="maxl">
                                   <h6> Gender <span style="color: red">*</span></h6>
                                    <label class="radio inline"> 
                                        <input required type="radio" name="member_gender" value="male"  <?php if($member_gender == 'male') {echo 'checked'; } ?> >
                                        <span> Male </span> 
                                    </label>
                                    <label class="radio inline"> 
                                        <input type="radio" name="member_gender" <?php if($member_gender == 'female') {echo 'checked'; } ?> value="female">
                                        <span>Female </span> 
                                    </label>
                                    <label class="radio inline"> 
                                        <input type="radio" name="member_gender" <?php if($member_gender == 'others') {echo 'checked'; } ?> value="others">
                                        <span>Others </span> 
                                    </label>
                                     <?php if (isset($input_error['member_gender'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['member_gender'].'</label>' ; } ?>
                                </div>
                            </div>

							</div>
							<div class="col-lg-6">

								<div class="form-group select-2-search">

									<label>Professional <span style="color: red">*</span></label>

									<select required name="categories_id"  class="form-control profession2 categories_id profession select2">
										<?php if ($categories_id == 0): ?>
											<option selected  value="0"><?php echo $member_others_professional ?></option>
										<?php endif ?>
										
	                                    <!-- <option class="" hidden value="<?php echo $member->categories_id ?>"  selected ><?php echo $categories_name ?></option> -->

	                                   <?php 
                                   $ctg_parent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '0'";
                                    
                                    $ctg_parent_query = $db->select($ctg_parent);
                                    while ($ctg_parent_row = mysqli_fetch_object($ctg_parent_query) ):
                                   ?>
                                             <optgroup label="<?php echo $ctg_parent_row->categories_name ?>">
		                                        <?php $ctg_sql = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '".$ctg_parent_row->categories_id."'"; 
		                                          $ctg_query = $db->select($ctg_sql);
		                                          while ($row = mysqli_fetch_object($ctg_query)):
		                                            $ctg_sql2 = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '".$row->categories_id."'"; 
		                                                $ctg_query2 = $db->select($ctg_sql2);
		                                                $ctg_count  = $ctg_query2->num_rows;
		                                                if ($ctg_count > 0 )  {
		                                                 
		                                        ?>
		                                          <optgroup label="-<?php echo $row->categories_name ?>">
		                                            <?php while ($row2 = mysqli_fetch_object($ctg_query2) ): ?>
		                                             <?php if ($categories_id == $row2->categories_id): ?>
		                                                <option selected  value="<?php echo $row2->categories_id ?>">-- <?php echo $row2->categories_name ?></option>
		                                              <?php else: ?>
		                                             
		                                                <option value="<?php echo $row2->categories_id ?>">-- <?php echo $row2->categories_name ?></option>
		                                                <?php endif ?>
		                                              <?php endwhile; ?>
		                                              </optgroup>
		                                          <?php }else{ ?>
		                                               <?php if ($categories_id == $row2->categories_id): ?>
		                                                  <option selected  value="<?php echo $row->categories_id ?>">- <?php echo $row->categories_name ?></option>
		                                                <?php else: ?>
		                                               
		                                                  <option value="<?php echo $row->categories_id ?>">- <?php echo $row->categories_name ?></option>
		                                                  <?php endif ?>
		                                          <?php } ?>
		                                        <?php endwhile; ?>
		                                      </optgroup>
                                  <?php endwhile; ?> 

	                                </select>
	                                <?php if ($categories_id == 0): ?>
	                                	<input type="text" style="margin-top: 10px;"  name="member_others_professional" class="form-control others-profession" value="<?php  echo $member_others_professional ?>" placeholder="Type Your Profession " value="" />
	                                <?php else: ?>
	                                	 <input type="text" style="margin-top: 10px;"  name="member_others_professional" class="form-control others-profession" value="" placeholder="Type Your Profession " value="" />
	                                <?php endif ?>
	                               

								</div>

							</div>

							<!-- <div class="col-lg-6">

								<div class="form-group">

									<label>Religion </label>

									<input type="text" required name="member_religion" id="member_religion" value="<?php echo $member_religion; ?>"   placeholder="Religion">

									<div id="religion_response"></div>

									<?php if (isset($input_error['member_religion'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['member_religion'].'</label>' ; } ?>

								</div>

							</div> -->
<!-- 
							<div class="col-lg-6">

								<div class="form-group">

									<label>Address </label>

									<input type="text" name="member_address" value="<?php echo $member_address; ?>"   placeholder="Address">

								</div>

							</div> -->

							<div class="col-lg-6">

								<div class="form-group">

									<label>Photo (size: 300 X 300) </label>

									<input type="file" name="member_img"   placeholder="Image">

									<input type="hidden" name="old_member_img" value="<?php echo $member_img ?>" name="">

								</div>

							</div>

							<div class="col-lg-6">

								<div class="form-group">

									<label>Cover Photo </label>

									<input type="file" name="member_cover_photo">

									<input type="hidden" name="old_member_cover_photo" value="<?php echo $member_cover_photo ?>" name="">

								</div>

							</div>

								
							<div class="col-lg-6">
								<div class="form-group" style="margin-bottom: 0">
                                <div class="maxl checkboxGroup">
                                   <h6> In which way want to other people contact you. *</h6>
                                   	<?php 
								   $contact_via = 'required';
								   if($member_contact_email_status==1  ||  $member_contact_phone_status==1)
								   {
									   $contact_via = '';
								   }
								   //echo $member_contact_email;
								   //echo $member_contact_phone;
								   ?>
                                        
                                        <span class="contact-via"> <input type="checkbox"  name="member_contact_email" value="1" <?php if( $member_contact_email == 1) { echo 'checked="checked"'; } ?> 
                                        <?php  echo $contact_via; ?>
                                       > Email </span> 
                                        
                                        <span class="contact-via"><input type="checkbox"  name="member_contact_phone" value="1" <?php if( $member_contact_phone == 1 ) {echo 'checked="checked"'; } ?> <?php  echo $contact_via; ?>> Phone  </span> 

                                    <?php if (isset($input_error['member_contact'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['member_contact'].'</label>' ; } ?>
                                </div>
                            </div>
							</div>

							<div class="col-lg-12">

								<div class="form-group">

									<label>Write About yourself </label>

									<textarea name="member_description" rows="5"><?php echo $member_desc; ?></textarea>

									

								</div>

							</div>

							<div class="col-lg-12">

								<div class="form-group">

									<button type="submit" name="edit-profile">Update</button>

									

								</div>

							</div>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>





<script type="text/javascript">

	 $("#member_first_name").keyup(function(){

      var member_first_name = $(this).val().trim();

      if(member_first_name != ''){

         $.ajax({

            url: '<?php echo SITE_URL ?>inc/chk_name.php',

            type: 'post',

            data: {member_first_name: member_first_name},

            success: function(response){

                $('#first_name_response').html(response);

             }

         });

      }else{

         $("#first_name_response").html("");

      }

    });

   $("#member_last_name").keyup(function(){

      var member_last_name = $(this).val().trim();

      if(member_last_name != ''){

         $.ajax({

            url: '<?php echo SITE_URL ?>inc/chk_name.php',

            type: 'post',

            data: {member_last_name: member_last_name},

            success: function(response){

                $('#last_name_response').html(response);

             }

         });

      }else{

         $("#last_name_response").html("");

      }

    });



   // member_religion

   $("#member_religion").keyup(function(){

      var member_religion = $(this).val().trim();

      if(member_religion != ''){

         $.ajax({

            url: '<?php echo SITE_URL ?>inc/chk_validation.php',

            type: 'post',

            data: {member_religion: member_religion},

            success: function(response){

                $('#religion_response').html(response);

             }

         });

      }else{

         $("#religion_response").html("");

      }

    });

$(document).ready(function(){

	  $("#member_phone").keyup(function(){

	  	// alert('hello');

      var member_phone = $(this).val().trim();

      // alert(member_phone);

      if(member_phone != ''){

         $.ajax({

            url: '<?php echo SITE_URL ?>inc/chk_validation.php',

            type: 'post',

            data: {member_phone: member_phone},

            success: function(response){

                $('#member_phone_response').html(response);

             }

         });

      }else{

         $("#member_phone_response").html("");

      }

    });



	 // age 

	 $("#member_birth_date").keyup(function(){

      var member_birth_date = $(this).val().trim();

      if(member_birth_date != ''){

         $.ajax({

            url: '<?php echo SITE_URL ?>inc/chk_validation.php',

            type: 'post',

            data: {member_birth_date: member_birth_date},

            success: function(response){

                $('#member_birth_date_response').html(response);

             }

         });

      }else{

         $("#member_birth_date_response").html("");

      }

    });

	var requiredCheckboxes = $('.checkboxGroup :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
	

});

</script>
<script type="text/javascript">
      
    $('body').on('change', '.profession', function () {
      
      var relgtype = $(".profession2 option:selected").text();
      // alert(relgtype);
      if (relgtype == "Others") {
        // alert('');
          $('.others-profession').addClass('show');
      }
      else {
          $('.others-profession').removeClass('show');
      }
  });

</script>