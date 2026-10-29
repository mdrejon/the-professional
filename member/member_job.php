<?php session_start(); ?>

<?php

$member_sql = "SELECT * FROM " . $db_suffix . "member m left join " . $db_suffix . "country c on m.country_id = c.country_id left join " . $db_suffix . "regions r on m.region_id = r.regions_id left join " . $db_suffix . "categories ca on m.categories_id = ca.categories_id WHERE member_id = '" . $member_id . "' AND member_email = '" . $member_email . "'";

$member_query = $db->select($member_sql);

$member = mysqli_fetch_object($member_query);

$memmber_id = $member->member_id;

$memmber_email = $member->member_email;

$member_username = $member->member_username;

$member_first_name = $member->member_first_name;

$member_last_name = $member->member_last_name;



$member_professional = $member->member_professional;

$member_contact_email = $member->member_contact_email;

$member_contact_phone = $member->member_contact_phone;

$member_gender = $member->member_gender;

$member_religion = $member->member_religion;

$member_address = $member->member_address;

$member_img = $member->member_img;

$member_cover_photo = $member->member_cover_photo;

$country_name = $member->country_name;

$region_name = $member->regions_name;

$categories_name = $member->categories_name;

$member_expertise_fild = $member->member_expertise_fild;

$city_id = $member->city_id;

$member_experience_year = $member->member_experience_year;

$member_document_verification_status = $member->member_document_verification_status;

$member_desc = $member->member_desc;

$member_email_verification = $member->member_email_verification;

$expertise_lists = explode(",", $member->expertise_list);

$member_joining_date = strtotime($member->member_joining_date);

$member_joining_date = date('d F, Y', $member_joining_date);

$member_birth_date = $member->member_birth_date; 
// $member_sql = "SELECT * FROM ".$db_suffix."member m left join ".$db_suffix."country c on m.country_id = c.country_id left join ".$db_suffix."regions r on m.region_id = r.regions_id left join ".$db_suffix."categories ca on m.categories_id = ca.categories_id WHERE member_id = '".$member_id."' AND member_email = '".$member_email."'";

// $member_query = $db->select($member_sql);

// $member = mysqli_fetch_object($member_query);

// $memmber_id = $member->member_id;

// $memmber_email = $member->member_email;

// $member_username = $member->member_username;

// $member_first_name = $member->member_first_name;

// $member_last_name = $member->member_last_name;

// $member_cover_photo = $member->member_cover_photo; 
?>

<?php

if (isset($_POST['submit_job'])) { 
	$job_type = $_POST['job_type']; 
	$job_title = $_POST['job_title']; 
	$job_company = $_POST['job_company']; 
	$job_categories = $_POST['job_categories']; 
	$job_country = $_POST['job_country']; 
	$job_regions = $_POST['job_regions']; 
	$job_city = $_POST['job_city']; 
	$job_salary = $_POST['job_salary']; 
	// $job_type = $_POST['job_type']; 
	$job_vacanciess = $_POST['job_vacanciess']; 
	$job_deadline = $_POST['job_deadline']; 
	// $job_image = $_POST['job_image']; 
	$job_desc = $_POST['job_desc']; 
	$input_error = array(); 

	// job_type

	if (empty($job_salary)) { 
		$input_error['job_salary'] = "Amount number requird";
	}
	if (preg_match("/[^0-9\_-]/i", $job_salary)) { 
		$input_error['job_salary'] = "Amount should be number";
	}

	// job_vacanciess

	if ($job_type == 'job') {  
		if (empty($job_vacanciess)) { 
			$input_error['job_vacanciess'] = "Vacanciess number requird";
		}
		if (preg_match("/[^0-9\_-]/i", $job_vacanciess)) {

			$input_error['job_vacanciess'] = "Vacanciess number should be number";
		}
	} 

	if ($_POST['job_slug'] == "") { 
		$job_slug = create_slug($job_title);
	}

	$today = date('y-m-d'); 
	$image_name = '';  
	if ($_FILES['job_img']['name'] != '') { 
		$image_name = rand(10, 1000) . "-" . $_FILES['job_img']['name']; 
		$image_temp = $_FILES['job_img']['tmp_name']; 
		$image_dir = "data/images/job/"; 
		$move_img = $image_dir . $image_name; 
		move_uploaded_file($image_temp, $move_img);
	}

	count($input_error);

	if (count($input_error) == 0) { 
		 $job_sql = "INSERT INTO dir_job 
        ( job_title, job_slug, job_desc, job_img, job_company, country_id, categories_id, regions_id, city_id, job_salary, job_type, job_deadline, job_vacancies, create_date, update_date, job_start_date, job_experience, job_order, job_status, job_feature, create_by, update_by) 
        VALUES (  '$job_title', '$job_slug', '$job_desc', '$image_name', '$job_company', '$job_country', '$job_categories', '$job_regions', '$job_city', '$job_salary', '$job_type',  '$job_deadline', '$job_vacanciess', '$today', '$today', '$today', 
		'', '0', '0', '0', '$memmber_id', '$memmber_id')";

		$db->insert($job_sql);
	} else {

		$worng = "<span class='bottom' style='color: red;'>Your list not added !</span>";
	}
} 
?>

<?php if (!empty($member_cover_photo)) : ?>

	<section class="profile-cover" style="background-image: url('<?php echo SITE_URL ?>member/images/<?php echo $member_cover_photo ?>');">
 
	</section>

<?php else : ?> 
	<section class="profile-cover" style="background-image: url('assets/img/cover-pic.jpg');"> 
	</section>

<?php endif ?>

<style type="text/css">
	.modal-dialog { 
		max-width: 730px !important; 
	} 
	#add_job_form .form-group { 
		position: relative; 
	}

	#add_job_form .form-group .user-chk { 
		top: 36px !important; 
	} 
	.col-lg-6.job_vacanciess_hide.hide { 
		display: none; 
		visibility: hidden; 
	}
</style> 
<section class="profile"> 
	<div class="container"> 
		<div class="row"> 
			<div class="col-lg-9"> 
				<div class="profile-details"> 
					<div class="member-list job-section"> 
						<div class="search-bar"> 
							<?php if (isset($worng)) { 
								echo $worng;
							} ?> 
							<a href="" class="border-btn" data-toggle="modal" data-target="#add_job">Add your list</a> 
							<div class="modal fade" id="add_job" role="dialog" class="modal_parent" style="overflow:hidden;" aria-labelledby="exampleModalLabel" aria-hidden="true">

								<div class="modal-dialog" role="document">

									<div class="modal-content">

										<div class="modal-header">

											<h5 class="modal-title" id="exampleModalLabel">Add your List</h5>



										</div>

										<div class="modal-body ">

											<form method="POST" action="#" enctype="multipart/form-data" id="add_job_form">

												<div class="row">

													<div class="col-lg-6">

														<div class="form-group text-left">

															<label>List Title <span class="red">*</span></label>

															<input type="text" class="form-control" required name="job_title" id="job_title" placeholder="Enter your list a title">

															<input type="hidden" hi class="form-control" required name="job_slug" id="job_slug" value="job">

															<div id="job_title_response"></div>

															<?php if (isset($input_error['job_title'])) {
																echo '<span class="ah-input-error" style="color: red;">' . $input_error['job_title'] . '</span>';
															} ?>

														</div>

													</div>

													<div class="col-lg-6">

														<div class="form-group text-left">

															<label>List Type <span class="red">*</span></label>

															<select placeholder="Experience" name="job_type" value="" id="job_type" class="select2 banner-search-select form-control">

																<option value="job">Job</option>

																<option value="service">Service</option>

															</select>

														</div>

													</div>

													<div class="col-lg-6">

														<div class="form-group text-left">

															<label>Company <span class="red">*</span></label>

															<input type="text" class="form-control" required name="job_company" id="job_company" placeholder="Enter Company Name">

															<div id="job_company_response"></div>

															<?php if (isset($input_error['job_company'])) {
																echo '<span class="ah-input-error" style="color: red;">' . $input_error['job_company'] . '</span>';
															} ?>

														</div>

													</div>

													<div class="col-lg-6">

														<div class="form-group text-left select-2-search">

															<label>Select Profession <span class="red">*</span></label>

															<select name="job_categories" id="job_categories" placeholder="Experience" value="" class="select2 banner-search-select categories_id form-control">

																<!-- <option value="0">Select Category</option> -->
																<option hidden="hidden" value="0" selected>Select Category</option>

																<?php

																$ctg_parent = "SELECT * FROM " . $db_suffix . "categories WHERE categories_parent = '0'";
																$ctg_parent_query = $db->select($ctg_parent);
																while ($ctg_parent_row = mysqli_fetch_object($ctg_parent_query)) :

																?>
																	<optgroup label="<?php echo $ctg_parent_row->categories_name ?>">
																		<?php $ctg_sql = "SELECT * FROM " . $db_suffix . "categories WHERE categories_parent = '" . $ctg_parent_row->categories_id . "'";
																		$ctg_query = $db->select($ctg_sql);
																		while ($row = mysqli_fetch_object($ctg_query)) :
																			$ctg_sql2 = "SELECT * FROM " . $db_suffix . "categories WHERE categories_parent = '" . $row->categories_id . "'";
																			$ctg_query2 = $db->select($ctg_sql2);
																			$ctg_count  = $ctg_query2->num_rows;
																			if ($ctg_count > 0) {

																		?>
																	<optgroup label="-<?php echo $row->categories_name ?>">
																		<?php while ($row2 = mysqli_fetch_object($ctg_query2)) : ?>
																			<?php if ($job_categories == $row2->categories_id) : ?>
																				<option selected value="<?php echo $row2->categories_id ?>">-- <?php echo $row2->categories_name ?></option>
																			<?php else : ?>

																				<option value="<?php echo $row2->categories_id ?>">-- <?php echo $row2->categories_name ?></option>
																			<?php endif ?>
																		<?php endwhile; ?>
																	</optgroup>
																<?php } else { ?>
																	<?php if ($job_categories == $row2->categories_id) : ?>
																		<option selected value="<?php echo $row->categories_id ?>">- <?php echo $row->categories_name ?></option>
																	<?php else : ?>

																		<option value="<?php echo $row->categories_id ?>">- <?php echo $row->categories_name ?></option>
																	<?php endif ?>
																<?php } ?>
															<?php endwhile; ?>
															</optgroup>
														<?php endwhile; ?>

														<option value="0">Others</option>

															</select>

														</div>

													</div>

													<div class="col-lg-6">

														<div class="form-group text-left country_id_search">

															<label>Country Name <span class="red">*</span></label>

															<select name="job_country" onchange="my_fun(this.value);" id="job_country" required class="select2 banner-search-select country_id form-control">

																<option>select</option>

																<?php

																$sql_parent_menu = "SELECT * FROM countries";



																$parent_query = $db->select($sql_parent_menu);

																while ($parent_obj = mysqli_fetch_object($parent_query)) {

																	if ($parent_obj->country_id == $country_id) {

																		echo '<option selected="selected" value="' . $parent_obj->country_id . '">' . $parent_obj->country_name . '</option>';
																	} else {

																		echo '<option value="' . $parent_obj->country_id . '">' . $parent_obj->country_name . '</option>';
																	}
																}



																?>

															</select>

														</div>

													</div>

													<div class="col-lg-6">

														<div class="form-group text-left region_id_search">

															<label>Regions Name <span class="red">*</span></label>

															<select name="job_regions" onchange="job_regions_fun(this.value);" id="show-regions" required class="select2 banner-search-select region_id form-control">

																<option>select</option>



															</select>

														</div>

													</div>

													<div class="col-lg-6">

														<div class="form-group text-left city_id_search">

															<label>City Name <span class="red">*</span></label>

															<select name="job_city" id="show-city" required class="select2 city_id banner-search-select form-control">

																<option>select</option>

															</select>

														</div>

													</div>

													<div class="col-lg-6">

														<div class="form-group text-left">

															<label>Amount <span class="red">*</span></label>

															<input type="text" maxlength="10" class="form-control" required name="job_salary" id="job_salary" id="job_salary" placeholder="Enter a Amount">

															<div id="job_salary_response"></div>

															<?php if (isset($input_error['job_salary'])) {
																echo '<span class="ah-input-error" style="color: red;">' . $input_error['job_salary'] . '</span>';
															} ?>

														</div>

													</div>

													<div class="col-lg-6 job_vacanciess_hide">

														<div class="form-group text-left">

															<label>Vacanciess <span class="red">*</span></label>

															<input type="text" maxlength="3" class="form-control" name="job_vacanciess" id="job_vacanciess" placeholder="Enter number of vacanciess">

															<div id="job_vacanciess_response"></div>

															<?php if (isset($input_error['job_vacanciess'])) {
																echo '<span class="ah-input-error" style="color: red;">' . $input_error['job_vacanciess'] . '</span>';
															} ?>

														</div>

													</div>

													<div class="col-lg-6">

														<div class="form-group text-left">

															<label>Application End Date <span class="red">*</span></label>

															<input type="date" class="form-control" required name="job_deadline" value="<?php echo $today ?>" id="job_deadline" placeholder="Enter Deadline">

														</div>

													</div>

													<div class="col-lg-12">

														<div class="form-group text-left">

															<label>Image <span class="red">*</span></label>

															<input type="file" class="form-control" required name="job_img" id="job_image">

														</div>

													</div>

													<div class="col-lg-12">

														<div class="form-group text-left">

															<label>Description *</label>

															<textarea name="job_desc" class="form-control" required id="job_desc"></textarea>

														</div>

													</div>

												</div>

										</div>

										<div class="modal-footer">



											<input type="submit" name="submit_job" id="submit_job" class="border-btn" value="submit">

											<button type="button" class="border-btn" data-dismiss="modal">Close</button>

										</div>

										</form>

									</div>

								</div>

							</div>

						</div>

						<ul class="nav nav-tabs member-tabs" id="myTab" role="tablist">

							<li class="nav-item">

								<a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Job List</a>

							</li>

							<li class="nav-item">

								<a class="nav-link" id="verified-tab" data-toggle="tab" href="#verified" role="tab" aria-controls="verified" aria-selected="false">Service List</a>

							</li>



						</ul>

						<div class="tab-content" id="myTabContent">



							<?php //require_once('member_list/job_list.php'); 
							?>

							<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

								<div class="add-list-btn text-right" style="margin-bottom: 20px;">







								</div>

								<?php

								$job_select_sql = "SELECT *  FROM " . $db_suffix . "job  WHERE create_by=" . $member_id . " AND job_type ='job' order by job_id desc";

								$job_select_query = $db->select($job_select_sql);

								while ($row = mysqli_fetch_object($job_select_query)) :

									$job_deadline2 = strtotime($row->job_deadline);

									$job_deadline = date('d F, Y', $job_deadline2);



								?>

									<div class="single-list">

										<div class="row">

											<div class="col-lg-3 col-md-4">

												<div class="single-member-img">

													<img src="<?php echo SITE_URL ?>data/images/job/<?php echo $row->job_img ?>">

												</div>

											</div>

											<div class="col-lg-6 col-md-8">

												<div class="single-member-text">

													<h4 class="single-member-name"><?php echo $row->job_title ?> </h4>

													<h6 class="member-name-title"><span><?php echo $row->job_company ?></span> <span class="verify"><i class="fas fa-user-check"></i></span></h6>



													<p><?php echo $row->job_desc ?></p>



													<div class="date">

														<span>Deadline:<b> <?php echo $job_deadline ?></b></span>

													</div>

												</div>

											</div>

											<div class="col-lg-3 col-md-12">

												<div class="member-button">

													<a href="#job-post<?php echo $row->job_id ?>" class="view-profile=" data-toggle="modal" data-target="#exampleModal<?php echo $row->job_id ?>">View Job</a>

													<!-- Modal -->

													<div class="modal fade" id="exampleModal<?php echo $row->job_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

														<div class="modal-dialog" role="document">

															<div class="modal-content">

																<div class="modal-body">

																	<div class="container">

																		<div class="row">

																			<div class="col-lg-12">

																				<h4 class="single-member-name"><?php echo $row->job_title ?></h4>

																				<h6 class="member-name-title"><span><?php echo $row->job_company ?></span> <!-- <span class="verify"><i class="fas fa-user-check"></i></span> -->
																				</h6>

																				<?php

																				if ($row->categories_name != '') {

																					echo '<span class="job-meta"><b>Expart In:</b> ' . $row->categories_name . '</span>';
																				}

																				if ($row->job_vacancies != '') {

																					echo '<span class="job-meta"><b>Number of vacancies: </b>  ' . $row->job_vacancies . '</span>';
																				}

																				if ($row->job_experience != '') {

																					echo '<span class="job-meta"><b>Experience: </b> ' . $row->job_experience . ' years</span>';
																				}

																				if ($row->job_salary != '') {

																					echo '<span class="job-meta"><b>salary: </b>' . $row->job_salary . ' </span>';
																				}



																				?>

																			</div>

																			<div class="col-lg-12">

																				<div class="job-details-popup">

																					<?php echo $row->job_desc; ?>

																				</div>

																			</div>

																		</div>

																	</div>

																</div>

																<div class="modal-footer">

																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

																</div>

															</div>

														</div>

													</div>

												</div>



											</div>

										</div>

									</div>

								<?php endwhile ?>

							</div>



							<?php // require_once('member_list/service_list.php'); 
							?>

							<div class="tab-pane fade show " id="verified" role="tabpanel" aria-labelledby="verified-tab">

								<?php

								$job_select_sql = "SELECT *  FROM " . $db_suffix . "job  WHERE create_by=" . $member_id . " AND job_type ='service' order by job_id desc";

								$job_select_query = $db->select($job_select_sql);

								while ($row = mysqli_fetch_object($job_select_query)) :

									$job_deadline2 = strtotime($row->job_deadline);

									$job_deadline = date('d F, Y', $job_deadline2);

								?>

									<div class="single-list">

										<div class="row">

											<div class="col-lg-3 col-md-4">

												<div class="single-member-img">

													<img src="<?php echo SITE_URL ?>data/images/job/<?php echo $row->job_img ?>">

												</div>

											</div>

											<div class="col-lg-6 col-md-8">

												<div class="single-member-text">

													<h4 class="single-member-name"><?php echo $row->job_title ?> </h4>

													<h6 class="member-name-title"><span><?php echo $row->job_company ?></span> <span class="verify"><i class="fas fa-user-check"></i></span></h6>

													<p><?php echo $row->job_desc ?></p>

													<div class="date">

														<span>Deadline: <b> <?php echo $job_deadline ?></b></span>



													</div>

												</div>

											</div>

											<div class="col-lg-3 col-md-12">

												<div class="member-button">

													<a href="#job-post<?php echo $row->job_id ?>" class="view-profile=" data-toggle="modal" data-target="#exampleModal2">View Service</a>

													<!-- Modal -->

													<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

														<div class="modal-dialog" role="document">

															<div class="modal-content">

																<div class="modal-body">

																	<div class="container">

																		<div class="row">

																			<div class="col-lg-12">

																				<h4 class="single-member-name"><?php echo $row->job_title ?></h4>

																				<h6 class="member-name-title"><span><?php echo $row->job_company ?></span> <!-- <span class="verify"><i class="fas fa-user-check"></i></span> -->
																				</h6>

																				<?php

																				if ($row->categories_name != '') {

																					echo '<span class="job-meta"><b>Expart In:</b> ' . $row->categories_name . '</span>';
																				}



																				if ($row->job_experience != '') {

																					echo '<span class="job-meta"><b>Experience: </b> ' . $row->job_experience . ' years</span>';
																				}



																				if ($row->job_salary != '') {

																					$output .= '<span class="job-meta"><b>salary: </b>' . $row->job_salary . ' </span>';
																				}







																				?>



																			</div>

																			<div class="col-lg-12">

																				<div class="job-details-popup">

																					<?php echo $row->job_desc; ?>

																				</div>

																			</div>

																		</div>

																	</div>

																</div>

																<div class="modal-footer">

																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

																</div>

															</div>

														</div>

													</div>

												</div>



											</div>

										</div>

									</div>

								<?php endwhile ?>

							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="col-lg-3">

				<div class="single-side-profile border-radius">

					<h4>Verifications</h4>



					<ul>

						<?php if ($member_document_verification_status != '1') : ?>

							<li class="not-verify"><span class="icon"><i class="fas fa-user"></i></span> Identity <span class="right"><a href="<?php echo SITE_URL ?>verification-center-home">Verify Now</a></span></li>

						<?php else : ?>

							<li class="not-verify"><span class="icon"><i class="fas fa-user"></i></span> Document Verified <span class="right"><i class="fas fa-check"></i></span></li>

						<?php endif; ?>



						<!-- <li><span class="icon"><i class="fas fa-phone-alt"></i></span>   Phone Verified   <span class="right"><i class="fas fa-check"></i></span></li> -->



						<?php if ($member_email_verification != 'yes') : ?>

							<form method="POST" action="<?php echo SITE_URL ?>member_register_verification">

								<li><span class="icon"><i class="fas fa-envelope"></i></span> Email Verified <span class="right">

										<!-- <a href="<?php echo SITE_URL ?>verify-email">Verify Now</a> -->

										<button type="submit" name="email_verify" class="border-btn">Verify Now</button>

									</span></li>

							</form>



						<?php else : ?>

							<li><span class="icon"><i class="fas fa-envelope"></i></span> Email Verified <span class="right"><i class="fas fa-check"></i></span></li>

						<?php endif ?>



					</ul>

				</div>

			</div>

		</div>

	</div>

</section>



<script type="text/javascript">
	$('body').on('change', '#job_type', function() {



		var relgtype = $("#job_type option:selected").text();

		// alert(relgtype);

		if (relgtype == "Service") {



			// alert('');

			$('.job_vacanciess_hide').addClass('hide');

		} else {

			$('.job_vacanciess_hide').removeClass('hide');

		}

	});
</script>

<script>
	function my_fun(str) {



		if (window.XMLHttpRequest) {

			xmlhttp = new XMLHttpRequest();



		} else {

			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");



		}



		xmlhttp.onreadystatechange = function() {



			if (this.readyState == 4 && this.status == 200) {

				// alert(str);

				document.getElementById('show-regions').innerHTML = this.responseText;

			}

		}

		xmlhttp.open("GET", "<?php echo SITE_URL ?>inc/load_location.php?value=" + str, true);

		xmlhttp.send();



	}

	function job_regions_fun(str) {

		// alert(str)

		if (window.XMLHttpRequest) {

			xmlhttp = new XMLHttpRequest();

		} else {

			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

		}



		xmlhttp.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {

				document.getElementById('show-city').innerHTML = this.responseText;

			}

		}

		xmlhttp.open("GET", "<?php echo SITE_URL ?>inc/load_location.php?value2=" + str, true);

		xmlhttp.send();



	}
</script> 
<script type="text/javascript">
	$(document).ready(function() {

		$("#job_salary").keyup(function() {

			// alert('hello');

			var job_salary = $(this).val().trim();

			// alert(member_phone);

			if (job_salary != '') {

				$.ajax({

					url: '<?php echo SITE_URL ?>inc/chk_validation.php',

					type: 'post',

					data: {
						job_salary: job_salary
					},

					success: function(response) {

						$('#job_salary_response').html(response);

					}

				});

			} else {

				$("#job_salary_response").html("");

			}

		});

		$("#job_vacanciess").keyup(function() {

			// alert('hello');

			var job_vacanciess = $(this).val().trim();

			// alert(member_phone);

			if (job_vacanciess != '') {

				$.ajax({

					url: '<?php echo SITE_URL ?>inc/chk_validation.php',

					type: 'post',

					data: {
						job_vacanciess: job_vacanciess
					},

					success: function(response) {

						$('#job_vacanciess_response').html(response);

					}

				});

			} else {

				$("#job_vacanciess_response").html("");

			}

		});

		$("#job_title").keyup(function() {

			// alert()

			// alert('hello');

			var job_title = $(this).val().trim();

			// alert(member_phone);

			if (job_title != '') {

				// alert()

				$.ajax({

					url: '<?php echo SITE_URL ?>inc/chk_validation.php',

					type: 'post',

					data: {
						job_title: job_title
					},

					success: function(response) {

						$('#job_title_response').html(response);

					}

				});

			} else {

				$("#job_title_response").html("");

			}

		});

		$("#job_company").keyup(function() {

			// alert()

			// alert('hello');

			var job_company = $(this).val().trim();

			// alert(member_phone);

			if (job_company != '') {

				// alert()

				$.ajax({

					url: '<?php echo SITE_URL ?>inc/chk_validation.php',

					type: 'post',

					data: {
						job_company: job_company
					},

					success: function(response) {

						$('#job_company_response').html(response);

					}

				});

			} else {

				$("#job_company_response").html("");

			}

		}); 
	});
</script>