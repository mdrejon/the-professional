<?php session_start(); ?>
<?php
require_once('function.php'); 
	$member_sql = "SELECT * FROM ".$db_suffix."member m left join countries c on m.country_id = c.country_id left join states r on m.region_id = r.states_id left join cities ci on m.city_id = ci.city_id  left join ".$db_suffix."categories ca on m.categories_id = ca.categories_id WHERE member_id = '".$member_id."' AND member_email = '".$member_email."'";
	$member_query = $db->select($member_sql);
	$member = mysqli_fetch_object($member_query);
	$memmber_id = $member->member_id;
	$memmber_email = $member->member_email;
	$memmber_country_code = $member->country_code;
	$member_username = $member->member_username;
	$member_first_name = $member->member_first_name;
	$member_last_name = $member->member_last_name;
	
	//$member_professional = $member->member_professional;
	
	$member_contact_email = $member->member_contact_email;
	$member_contact_phone = $member->member_contact_phone;
	$member_gender = $member->member_gender;
	$member_religion = $member->member_religion;
	$member_address = $member->member_address;
	$member_img = $member->member_img;
	$member_cover_photo = $member->member_cover_photo;
	$country_name = $member->country_name;
	$country_id = $member->country_id;
	$region_name = $member->states_name;
	
	$categories_id = $member->categories_id;
	$categories_name = $member->categories_name;
	$member_professional = $categories_name;
	if($categories_id==0){
		$member_professional = $member->member_others_professional;
	}
		$member_others_professional = $member->member_others_professional;
	$member_expertise_fild = $member->member_expertise_fild;
	$city_id = $member->city_id;
	$city_name = $member->city_name;
	$member_experience_year = $member->member_experience_year;
	$member_document_verification_status = $member->member_document_verification_status;
	$member_desc = $member->member_desc;
	$member_email_verification = $member->member_email_verification;
	$expertise_lists = explode("|",$member->expertise_list) ;
	$member_joining_date = strtotime($member->member_joining_date);
	$member_joining_date = date('d F, Y', $member_joining_date);
	$member_birth_date = $member->member_birth_date;

	if (isset($member_id)) {
		 $location_sql = "SELECT * FROM ".$db_suffix."member where member_id = '".$member_id."'";
	$location_query = $db->select($location_sql);
	$location = mysqli_fetch_object($location_query); 
	$location_country_id = $location->country_id;
	$member_location = $location->member_location;
	$member_location_latitude = $location->member_location_latitude;
	$member_location_longitude = $location->member_location_longitude;
	 $location_states_id = $location->region_id;
	 $location_city_id = $location->city_id;
	 $location_country_code = $location->country_code;
	 $location_post_code = $location->post_code;
 
	}
	
	// $member_birth_date = date("Y-m-d", strtotime($member->member_birth_date));
	// $member_birth_date = date_diff(date_create($member_birth_date), date_create('today'))->y;
if ($member_img == '') {
	if ($member_gender == 'male') {
		$member_img = 'male-avata.png';
	}elseif ($member_gender == 'female'){
		$member_img = 'female-avata.png';
	}
}

if (isset($_POST['edit-experiences'])) {
	$member_expertise_fild = $_POST['member_expertise_fild'];
		 $sql = "UPDATE ".$db_suffix."member SET 
				member_expertise_fild = '$member_expertise_fild'
				WHERE member_id = '".$memmber_id."' ";
	$query = $db->update($sql);
}					
if (isset($_POST['edit-experience-year'])) {
	$member_experience_year = $_POST['member_experience_year'];
		$sql = "UPDATE ".$db_suffix."member SET 
				member_experience_year = '$member_experience_year'
				WHERE member_id = '".$memmber_id."' ";
	    $db->update($sql);
}				
if (isset($_POST['edit-expertise'])) {
	$expertise_list = implode("|",$_POST['expertise_list']) ;
	  //$expertise_list;
	  
	 $sql = "UPDATE ".$db_suffix."member SET 
				expertise_list = '$expertise_list'
				WHERE member_id = '".$memmber_id."' ";
	    $db->update($sql);
	$expertise_lists = explode("|",$expertise_list) ;
}	

 ?>

<?php if (!empty($member_cover_photo)): ?>
	<section class="profile-cover" style="background-image: url('<?php echo SITE_URL ?>member/images/<?php echo $member_cover_photo ?>');">
	
</section>
<?php else: ?>
	<section class="profile-cover" style="background-image: url('<?php echo SITE_URL ?>assets/img/cover-pic.jpg');">
	
</section>
<?php endif ?>

	    
	
<style type="text/css">
	
.contact-via {
  display: inline-block;
  width: 120px;
  text-align: left !important;
}
.contact-via input {
  width: auto;
}

.form-group.form-label.abs-search-icon {
}
.abs-search-icon span {
  top: 40px !important;
}
#CurrentLocation2 {
  padding: 10px 27px;
}
.pac-container.pac-logo {
	z-index: 99999999999 !important;
}
</style>
<script>
$(document).ready(function(){ 
    var maxLength = 200;
    $(".show-read-more").each(function(){
        var myStr = $(this).text(); //alert(myStr);
        if($.trim(myStr).length > maxLength){
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append('<a href="javascript:void(0);" class="read-more">read more...</a>');
			//alert(removedStr);
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function(){
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });
});
</script> 
<style>
    .show-read-more .more-text{
        display: none;
    }
    .padding-0 a {
	padding: 0 !important;
}
</style> 
<section class="profile">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="profile-details">
					<div class="row">
						<div class="col-lg-4">
							<div class="profile-img">
								<img src="<?php echo SITE_URL?>member/images/<?php echo $member_img ?>">
							</div>
							<div class="profile-info">
								<ul>
									
									<?php require_once('edit_location.php');  ?>
									<!-- <li class="online"><span><i class="fas fa-circle"></i></span> I'm Online</li> -->
									<li class="country"><span> </span> 
										<?php if ($city_name != ''): ?>
											<?php echo $city_name; ?>, 
										<?php endif ?>
										<?php if ($region_name != ''): ?>
											<?php echo $region_name; ?>,
										<?php endif ?>
										<?php if ($country_name != ''): ?>
											<a href="#"><?php echo $country_name ?></a> 
										<?php endif ?>
										
										
										
										<a href="#edit_location" class=" popup-inline edit-popup"> <span id=""><i class="fas fa-edit"></i></span></a> </li>
									
									<li class="change"><span> </span>Email: <?php echo $member_email ?>
								

									</li>
									<li class=""><span> </span>Joined <?php echo $member_joining_date ?></li>
									<li class="gender"><span> </span><?php echo $member_gender ?>, Age: <?php echo $member_birth_date ?></li>

								</ul>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="profile-title">
								<h4><?php echo $member_first_name ?> <?php echo $member_last_name ?> </h4>
								<h6>Profession : <?php echo $member_professional ?> </h6>

							</div>
							<div class="single-side-profile new">
								<h5>Expertise <a href="#expertise" class="edit-btn popup-inline edit-popup"> <i class="fas fa-plus"></i></a></h5>
								
								<p>
									<?php if (empty($member->expertise_list)) : ?>
										Add your expertise skills.
									<?php else: ?>
										<?php foreach ($expertise_lists as $expertise_list): ?>
											<span><?php echo $expertise_list ?></span>
										<?php endforeach ?>
									<?php endif; ?>
									


								</p>
								
								<div id="expertise" class=" mfp-hide white-popup">
									<div class="container">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-content">
												
													<form method="POST" accept="">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<h5>Update your expertise to work</h5>
																	<select class="mb-10 select2-multiple selectExpertiseSkills" name="expertise_list[]" style="width: 100%" multiple="multiple" data-placeholder="Choose">
						<?php
							$sql_parent_menu = "SELECT e.expertise_title as expertise_title FROM dir_expertise e  union select c.categories_name as expertise_title from dir_categories c";

						   $parent_query = $db->select($sql_parent_menu);

							while($parent_obj = mysqli_fetch_object($parent_query)):
							$selected = '';
							if(in_array($parent_obj->expertise_title, $expertise_lists)) {
								$selected = ' selected="selected"';
							}
						 ?>
						 
							<option <?php echo $selected;?> value="<?php echo $parent_obj->expertise_title ?>"><?php echo $parent_obj->expertise_title ?></option>
						  <?php endwhile; ?>
						  <?php foreach ($expertise_lists as $expertise_list): ?>
											<option selected="selected" value="<?php echo $expertise_list ?>"><?php echo $expertise_list ?></option>
										<?php endforeach ?>
                           </select>
																	
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group">
																	<button type="submit" name="edit-expertise">Update Expertise</button>
																	
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="single-side-profile new">
								<h5>Year Of Experience  <a href="#experience-year" class="edit-btn popup-inline edit-popup"> <i class="fas fa-plus"></i></a></h5>
								<div class="side-profile-desc">
									<?php if ($member_experience_year == '0' || $member_experience_year =='') {?>
										<p>No experience</p>
									<?php }else if ($member_experience_year !=''){ ?>
										<p><?php echo $member_experience_year ?> Years</p>
									
									<?php } ?>
									
								</div>
								<div id="experience-year" class=" mfp-hide white-popup">
									<div class="container">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-content">
													<form method="POST" accept="">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<label>Year Of Experience</label>
																
																	<input type="number" required name="member_experience_year" min="0" max="99" step="1" value="<?php echo $member_experience_year ?>" placeholder="0">
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group">
																	<button type="edit-experience-year" name="edit-experience-year">Update Experience</button>
																	
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="single-side-profile new">
								<h5>Field of Experiences <a href="#experiences" class="edit-btn popup-inline edit-popup"> <i class="fas fa-plus"></i></a></h5>
								
								<div class="side-profile-desc">
									<?php if ($member_expertise_fild !='' ): ?>
										<p><?php echo $member_expertise_fild ?></p>
									<?php else: ?>
										<p>Add Field of Experiences Details</p>
									<?php endif; ?>
								</div>
								<div id="experiences" class=" mfp-hide white-popup">
									<div class="container">

										<div class="row">
											<div class="col-lg-12">
												<div class="form-content">
													<form method="POST" action="">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<label>Field of Experiences </label>
																	<textarea name="member_expertise_fild" rows="5"><?php echo $member_expertise_fild ?></textarea>
																	
																</div>
															</div>
															
															<div class="col-lg-12">

																<div class="form-group">
																	<button type="submit" name="edit-experiences">Update Experiences</button>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="single-side-profile new">
								<h5>Educational Background <a href="#education" class="edit-btn" data-toggle="modal" data-target="#add-contet" >
									<i class="fas fa-plus"></i>
								</a></h5>
									
									<div class="side-profile-desc">
										<ul id="show-content">

											
										</ul>
									</div>
									<?php require_once('add_education.php');  ?>
							</div>
							<div class="profile-desc">
								
									<div class="show-read-more"><?php echo trim($member_desc); ?></div>
								<?php // echo $member_desc; ?>
								 
								 <!-- <a href="#demo" data-toggle="collapse">View More</a> -->
							</div>
						</div>

					</div>
					<a href="#edit_profile" class="edit-btn popup-inline edit-popup"> <i class="fas fa-plus"></i> Edit Profile</a>
				</div>
				<?php require_once('edit_profile.php');  ?>
			</div>
			<div class="col-lg-3">
				<div class="single-side-profile border-radius">
					<h4>Verifications</h4>

					<ul>
						<?php if ($member_document_verification_status !='1'): ?>
							<li class="not-verify"><span class="icon"><i class="fas fa-user"></i></span> Identity  <span class="right"><a href="<?php echo SITE_URL ?>verification-center-home">Verify Now</a></span></li>
						<?php else: ?>
							<li class="not-verify"><span class="icon"><i class="fas fa-user"></i></span>   Document Verified   <span class="right"><i class="fas fa-check"></i></span></li>
						<?php endif; ?>
						
						<!-- <li><span class="icon"><i class="fas fa-phone-alt"></i></span>   Phone Verified   <span class="right"><i class="fas fa-check"></i></span></li> -->

						<?php if ($member_email_verification !='yes'): ?>
							<form method="POST" action="<?php echo SITE_URL ?>member_register_verification">
								<li><span class="icon"><i class="fas fa-envelope"></i></span>   Email Verified    <span class="right">
									<!-- <a href="<?php echo SITE_URL ?>verify-email">Verify Now</a> -->
									<button type="submit" name="email_verify" class="border-btn">Verify Now</button>
								</span></li>
							</form>
							
						<?php else: ?>
							<li><span class="icon"><i class="fas fa-envelope"></i></span>   Email Verified    <span class="right"><i class="fas fa-check"></i></span></li>
						<?php endif ?>
						
					</ul>
				</div>
				<div class="single-side-profile member-list-btn border-radius">
					<h4 class="list-job-service">Accounts settings </h4>

						<ul>
							<li><a target="_blank" href="<?php echo SITE_URL ?>members/<?php echo $member_username ?>" > View Your Profile  </a></li>
							<li><a href="<?php echo SITE_URL ?>profile/list" > View Your Listed  </a></li>
							<li><a href="<?php echo SITE_URL ?>profile/change-email" > Change Email  </a></li>
							<li><a href="<?php echo SITE_URL ?>profile/change-password" > Change Password  </a></li>
						</ul>
				</div>
				
			</div>
		</div>
	</div>
</section>

<?php //require_once('chat.php');  ?>