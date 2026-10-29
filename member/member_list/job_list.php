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
	$job_vacanciess = $_POST['job_vacanciess']; 
	$job_deadline = $_POST['job_deadline'];  
	$job_desc = $_POST['job_desc']; 

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

	echo $job_sql = "INSERT INTO dir_job 
        (   job_title, job_slug, job_desc, job_img, job_company, country_id, categories_id, regions_id, city_id, job_salary, job_type, job_deadline, job_vacancies, create_date, create_by, update_by)

            VALUES (  '$job_title', '$job_slug', '$job_desc', '$image_name', '$job_company', '$job_country', '$job_categories', '$job_regions', '$job_city', '$job_salary', '$job_type',  '$job_deadline', '$job_vacanciess', '$today', '$memmber_id', '$memmber_id') ";

	$db->insert($job_sql);
}

?>



<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

	<div class="add-list-btn text-right" style="margin-bottom: 20px;">





		<div class="modal fade" id="add_job" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLabel">List Your Job 1</h5>



					</div>

					<div class="modal-body">

						<form method="POST" action="#" enctype="multipart/form-data" id="add_job_form">

							<div class="row">

								<div class="col-lg-6">

									<div class="form-group text-left">

										<label>Job Title <span class="red">*</span></label>

										<input type="text" class="form-control" required name="job_title" id="job_title" placeholder="Entar A job Title">

										<input type="hidden" hi class="form-control" required name="job_type" id="job_type" value="job">

										<input type="hidden" hi class="form-control" required name="job_slug" id="job_slug" value="job">

									</div>

								</div>

								<div class="col-lg-6">

									<div class="form-group text-left">

										<label>Job Company <span class="red">*</span></label>

										<input type="text" class="form-control" required name="job_company" id="job_company" placeholder="Entar Company Name">

									</div>

								</div>

								<div class="col-lg-6">

									<div class="form-group text-left">

										<label>Categories Name <span class="red">*</span></label>

										<select name="expart" placeholder="Experience" value="" class="select2 banner-search-select form-control">

											<option value="0">Select Category</option>

											<?php

											$ctg_parent = "SELECT * FROM " . $db_suffix . "categories WHERE categories_parent = '0'";



											$ctg_parent_query = $db->select($ctg_parent);

											while ($ctg_parent_row = mysqli_fetch_object($ctg_parent_query)) :

											?>

												<!-- <optgroup label="City"> -->

												<option value="<?php echo $ctg_parent_row->categories_id ?>"><?php echo $ctg_parent_row->categories_name ?></option>

												<!-- <option value="HI">Hawaii</option> -->

												<!-- </optgroup> -->

											<?php endwhile; ?>

										</select>

									</div>

								</div>

								<div class="col-lg-6">

									<div class="form-group text-left">

										<label>Country Name <span class="red">*</span></label>

										<select name="job_country" onchange="my_fun(this.value);" id="job_country" required class="select2 banner-search-select form-control">

											<option>select</option>

											<?php

											$sql_parent_menu = "SELECT * FROM " . $db_suffix . "country";



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

									<div class="form-group text-left">

										<label>Regions Name <span class="red">*</span></label>

										<select name="job_regions" onchange="job_regions_fun(this.value);" id="show-regions" required class="select2 banner-search-select form-control">

											<option>select</option>



										</select>

									</div>

								</div>

								<div class="col-lg-6">

									<div class="form-group text-left">

										<label>City Name <span class="red">*</span></label>

										<select name="job_city" id="show-city" required class="select2 banner-search-select form-control">

											<option>select</option>

										</select>

									</div>

								</div>

								<div class="col-lg-6">

									<div class="form-group text-left">

										<label>Salary <span class="red">*</span></label>

										<input type="text" class="form-control" required name="job_salary" id="job_salary" placeholder="Entar Salary Amount">

									</div>

								</div>

								<div class="col-lg-6">

									<div class="form-group text-left">

										<label>Job Vacanciess <span class="red">*</span></label>

										<input type="text" class="form-control" required name="job_vacanciess" id="job_vacanciess" placeholder="Entar number of vacanciess">

									</div>

								</div>

								<div class="col-lg-6">

									<div class="form-group text-left">

										<label>Application End Date <span class="red">*</span></label>

										<input type="date" class="form-control" required name="job_deadline" id="job_deadline" placeholder="Entar Job Deadline">

									</div>

								</div>

								<div class="col-lg-12">

									<div class="form-group text-left">

										<label>Job Image <span class="red">*</span></label>

										<input type="file" class="form-control" required name="job_img" id="job_image">

									</div>

								</div>

								<div class="col-lg-12">

									<div class="form-group text-left">

										<label>Job Description *</label>

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

							<span>Job End Time:<b> <?php echo $job_deadline ?></b></span>



						</div>

					</div>

				</div>

				<div class="col-lg-3 col-md-12">

					<div class="member-button">



						<a href="#job-post<?php echo $row->job_id ?>" class="view-profile=" data-toggle="modal" data-target="#exampleModal">View Job</a>



						<!-- Modal -->

						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

							<div class="modal-dialog" role="document">

								<div class="modal-content">

									<div class="modal-body">

										<div class="container">

											<div class="row">

												<div class="col-lg-12">

													<h4 class="single-member-name"><?php echo $row->job_title ?></h4>

													<h6 class="member-name-title"><span><?php echo $row->job_company ?></span> <!-- <span class="verify"><i class="fas fa-user-check"></i></span> -->
													</h6>

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







						<!-- <a href="<?php echo SITE_URL ?>" class="view-profile">Edit Job</a> -->





					</div>



				</div>

			</div>

		</div>

	<?php endwhile ?>

</div>

<script>
	function my_fun(str) {

		// alert("hello");

		// alert(str)

		if (window.XMLHttpRequest) {

			xmlhttp = new XMLHttpRequest();

		} else {

			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

		}



		xmlhttp.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {

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