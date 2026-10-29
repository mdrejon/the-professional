<?php
session_start();
require_once("function.php"); 
$db = new database();

if (isset($_POST['search_submit'])) {

	if (isset($_SESSION['member_id'])) {

		$member_id = $_SESSION['member_id'];

		 $member_s = "select * from ".$db_suffix."member where member_id='$member_id'";

		$member_q = $db->select($member_s);

		$member = mysqli_fetch_object($member_q);

		 $member_location_latitude = $member->member_location_latitude;

		 $member_location_longitude = $member->member_location_longitude;

 	}

	if ($_POST['search'] !='') {

		$_SESSION['search'] = $_POST['search'];

	}else{

		unset($_SESSION["search"]);

	}

	if ($_POST['lat'] !='') {

	 	$_SESSION['lat'] = $_POST['lat'];

	}else{

		$_SESSION["lat"] = $member_location_latitude;

	}

	if ($_POST['lng'] !='') {

		 $_SESSION['lng'] = $_POST['lng'];

	}else{

		$_SESSION["lng"] = $member_location_longitude;

	}

	if ($_POST['location'] !='') {

		 $_SESSION['location'] = $_POST['location'];

	}else{

		unset($_SESSION["location"]);

	}

	if ($_POST['Country'] !='') {

		 $_SESSION['Country'] = $_POST['Country'];

	}else{

		unset($_SESSION["Country"]);

	}

	if ($_POST['range'] !='') {

		 $_SESSION['range'] = $_POST['range'];

	}else{

		unset($_SESSION["range"]);

	}

	 

	

}





?>

<?php // include ("function.php"); ?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

	<!-- mobile responsive meta -->

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Seo Tags -->

	<meta name="description" content="Directory" />

	<meta name="keywords" content="Directory"/>

	<!-- <meta name="robots" content="index, follow">  -->



 

	<link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/mmenu.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/all.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/owl.carousel.min.css"> 





    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->



  



    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/jquery.animatedheadline.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/magnific-popup.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/select2.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap-tagsinput.css">

 <!--    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/intlTelInput.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/nice-select.min.css"> -->

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/dropify.min.css">

    

    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/typehead-min.css"> -->

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/style.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/style-new.css">

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/responsive.css">

    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/responsive-2.css"> -->

    

	
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyBLqyqBMRgUe1VQg4ZozSH8ZzM7V39orrg&libraries=places&language=en"></script>
	<script src="https://maps.google.com/maps-api-v3/api/js/47/7a/geocoder.js"></script>
     <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyBLqyqBMRgUe1VQg4ZozSH8ZzM7V39orrg&libraries=places&language=en"></script> -->

    

	

	<script src="<?php echo SITE_URL ?>assets/js/jquery-1.12.4.min.js"></script>

	

	<title><?php echo SITE_NAME; ?></title>

</head>

<body class="<?php if($page != ''){ echo $page; } ?>">

<!--Start of Tawk.to Script-->

<script type="text/javascript">

var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();

(function(){

var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];

s1.async=true;

s1.src='https://embed.tawk.to/603733371c1c2a130d622fed/1evbq04jg';

s1.charset='UTF-8';

s1.setAttribute('crossorigin','*');

s0.parentNode.insertBefore(s1,s0);

})();

</script>

<!--End of Tawk.to Script-->







<div class="overlay-close"></div>





<?php 

	$member_id = $_SESSION['member_id'];

	  $member_sql = "SELECT * FROM ".$db_suffix."member WHERE member_id = $member_id";

	$member_query = $db->select($member_sql);

	$member = mysqli_fetch_object($member_query);



 ?>

<?php if (isset($_SESSION['member_id'] ) && $member->member_document_verification_status != '1'): ?>

	<div class="d-verification-center-header">

		<h6>Your Identity not verified yet. Please <a target="_blank"  href="<?php echo SITE_URL ?>verification-center-home">Click Here</a> And Verify now </h6>

	</div>

<?php endif ?>

<section class="header-new">

	

	<div class="new-bottom-header">

		<div class="container">

			<div class="row">

				<div class="col-lg-3 col-md-4 col-sm-7 col-7"> 
					
					<!-- <div class="mobile-search-icon"> 
						<i class="fas fa-search"></i>

					</div> --> 
					<?php //include ('leftmenu-3.php'); ?> 
					
					<?php include ('leftmenu-4.php'); ?> 
					<div class="logo"> 
						<a target=""  href="<?php echo SITE_URL; ?>"> 
							<img src="https://xpertsfinder.com/assets/images/site-logo.png"> 
							<!-- <h4><?php echo SITE_NAME;  ?></h4> --> 
						</a>  
					</div>

				</div>

				<div class="col-lg-9 col-md-8 col-sm-5 col-5  text-right"> 
					<div class="top-slogan new-header-slogain"> 
						<ul> 
							<li><li class=""> 
								<?php  
									$left_slogan_query = "SELECT * FROM ".$db_suffix."slogan WHERE slogan_position = 'TOP_LEFT' limit 1";
 
									$left_slogan = $db->select($left_slogan_query);

									if ($row = mysqli_fetch_object($left_slogan)): ?>

										<?php if (isset($_SESSION['member_id'])): ?>

											<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>profile/list" class="" >

										<?php else: ?>

											<?php if ($page == 'reg'): ?>

												<a href="#" title="Click here to <?php echo $row->slogan_title ?>" class="slogan_click">

												<!-- <a target=""  href="" class="single-slogan"> -->

											<?php else: ?>

												<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>create-account" class=""> 
											<?php endif ?> 
										<?php endif ?> 

											<!-- <span><i class="fas fa-bahai"></i></span> -->

											 <?php echo $row->slogan_title ?> 

										</a>

									<?php endif; ?>

								<!-- <a href="">Become Listed, Get Business</a> -->

							</li>

							<li class=""> 
								<?php 

									$center_slogan_query = "SELECT * FROM ".$db_suffix."slogan WHERE slogan_position = 'TOP_CENTER' limit 1"; 
									$center_slogan = $db->select($center_slogan_query);

									if ($row = mysqli_fetch_object($center_slogan)): ?>

										<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>" href="<?php echo SITE_URL ?>categories" class="" >

											 <?php echo $row->slogan_title ?> 

										</a>

								

									<?php endif; ?>

									

							</li>

							<li class="">

								<?php 

									$right_slogan_query = "SELECT * FROM ".$db_suffix."slogan WHERE slogan_position = 'TOP_RIGHT' limit 1";

									

									$right_slogan = $db->select($right_slogan_query);

									if ($row = mysqli_fetch_object($right_slogan)): ?> 

										<?php if (isset($_SESSION['member_id'])): ?>

											<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>profile/list" class="">

										<?php else: ?>

											<?php if ($page == 'reg'): ?>

												<a href="#" title="Click here to <?php echo $row->slogan_title ?>" class="slogan_click" >

											<?php else: ?>

												<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>create-account " class="">

											<?php endif ?>

											

										<?php endif ?>

											<!-- <span><i class="fas fa-bahai"></i></span> -->

											 <?php echo $row->slogan_title ?> 

										</a>

									 

									<?php endif; ?>

								<!-- <a href="">Become Listed, Get Your Dream Job</a> -->

							</li></li>

						</ul>

					</div>

					<div class="top-header-search">

						<form  method="POST" class="range-field my-4 w-100" action="<?php echo SITE_URL ?>listing" target="_blank">

							<div class="row">

								<div class="col-lg-5 col-md-5 col-sm-5 col-5 from-group">

									  <div class="head-search-form-input">

					                    <input type="text" autocomplete="off" value="<?php echo $_SESSION['search'] ?>" placeholder="Type keywords to find experts" class="txtCountry3" id="txtCountry" class="form-control typeahead"  name="search">

					                  </div>

								</div>

								<div class="col-lg-5 col-md-5 col-sm-5 col-5 from-group">

									

									<div class="abs-search-icon">

										 

										<input type="text" id="CurrentLocation" required placeholder="Type your desired location" value="<?php echo $_SESSION['location'] ?>" name="location" class="form-control" >

										<input id="lat" name="lat" value="<?php echo $_SESSION['lat'] ?>" type="hidden">

										<input id="lng" name="lng" value="<?php echo $_SESSION['lng'] ?>" type="hidden">

										<input id="Country" name="Country" value="<?php echo $_SESSION['Country'] ?>" type="hidden">

										<input name="from_page" value="home" type="hidden">

										<div class="range range1">

											<input id="slider11" class="border-0" type="range" name="range" min="0" max="180"  />

											<div class="">

												<span class="distance"> KM</span>  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>

											</div>

										</div>

										<span class="location-track-icon"><i class="fas fa-map-marker-alt"></i></span>

										<span class="search-location search-location1"><i class="fas fa-globe location-track-icon"></i></span>

									</div>

								</div>

							 	<div class="col-lg-2 col-md-2 col-sm-2 col-2 from-group">

									<input type="submit" class="search_submit" name="search_submit" placeholder="" value="Search">

								</div>

							</div>

						</form>

					</div> 

					<div class="new-right-menu new">

						<ul>

							<?php if (isset($_SESSION['member_id'])): ?>

								

								

								<!-- <li class="border"><a target="_blank"  href="#"><span class="icon"><i class="far fa-comment-dots"></i></span> <span class="border-text">Messages</span>  </a></li> -->



								<li class="border ">



									<a href="#" style="width: 122px;font-size: 16px;text-align: center;"><span class="border-text">Hi, <?php echo $member->member_first_name; ?>  </a>

									<ul class="dropdown">

										<li><a target="_blank"  href="<?php echo SITE_URL ?>profile">Profile</a></li>

										<li><a target="_blank"  href="<?php echo SITE_URL ?>profile/list">View Your List</a></li>

										<li><a target="_blank"  href="<?php echo SITE_URL ?>profile/change-password">Change password</a></li>

										<li><a target=""  href="<?php echo SITE_URL ?>member-logout.php">Log Out</a></li>

									</ul>

								</li>

								<!-- <li class="border"><a target="_blank"  href="<?php echo SITE_URL ?>member-logout.php"><span class="border-text">Sign Out </span><span class="border-icon d-none"><i class="fas fa-sign-in-alt"></i></a> </span> </li> -->

							<?php else: ?>
								<?php if ($page == 'login'): ?>
									<li class="border"><a   href="<?php echo SITE_URL ?>sign-in#login_page"><span class="border-icon"><i class="fas fa-sign-in-alt"></i></span><span class="border-text">sign in  </span></a>  </li>
								<?php else: ?>
									<li class="border"><a target="_blank"  href="<?php echo SITE_URL ?>sign-in#login_page"><span class="border-icon"><i class="fas fa-sign-in-alt"></i></span><span class="border-text">sign in  </span></a>  </li>
								<?php endif; ?>


								<?php if ($page == 'reg'): ?>
									<li class="border anibate-border"><a  href="<?php echo SITE_URL ?>create-account#reg_page_section"><span class="border-icon"><i class="fas fa-user-plus"></i> </span><span class="border-text"> join	Now <span class="its-free">it's Free</span> </a></li>
								<?php else: ?>
									<li class="border anibate-border"><a target="_blank"  href="<?php echo SITE_URL ?>create-account#reg_page_section"><span class="border-icon"><i class="fas fa-user-plus"></i> </span><span class="border-text"> join	Now <span class="its-free">it's Free</span> </a></li>
								<?php endif; ?>

							

							<?php endif; ?> 

						</ul>

					

					</div>



				</div>

			</div>

			<div class="row">

				<div class="col-lg-12">

					<div class="top-header-search mobile-search">

						<form  method="POST" class="range-field my-4 w-100" action="<?php echo SITE_URL ?>listing" target="_blank">

							<div class="row">

								<div class="col-lg-5 col-md-5 col-sm-5 col-5 from-group">

									  <div class="head-search-form-input">

					                    <input type="text" autocomplete="off" value="<?php echo $_SESSION['search'] ?>" placeholder="Type keywords to find experts" id="txtCountry3" class="form-control typeahead"  name="search">

					                  </div>

								</div>

								<div class="col-lg-5 col-md-5 col-sm-5 col-5 from-group">

									

									<div class="abs-search-icon">

										 

										<input type="text" id="CurrentLocation3" required placeholder="Type your desired location" value="<?php echo $_SESSION['location'] ?>" name="location" class="form-control" >

										<input id="lat" name="lat" value="<?php echo $_SESSION['lat'] ?>" type="hidden">

										<input id="lng" name="lng" value="<?php echo $_SESSION['lng'] ?>" type="hidden">

										<input id="Country" name="Country" value="<?php echo $_SESSION['Country'] ?>" type="hidden">

										<input name="from_page" value="home" type="hidden">

										<div class="range range3">

											<input id="slider13" class="border-0" type="range" name="range" min="0" max="180"  />

											<div class="">

												<span class="distance"> KM</span>  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan3"></span>

											</div>

										</div>

										<span class="location-track-icon"><i class="fas fa-map-marker-alt"></i></span>

										<span class="search-location search-location3"><i class="fas fa-globe location-track-icon"></i></span>

									</div>

								</div>

							 	<div class="col-lg-2 col-md-2 col-sm-2 col-2 from-group">

									<input type="submit" class="search_submit" name="search_submit" placeholder="" value="Search">

								</div>

							</div>

						</form>

					</div>

				</div>

			</div>



		</div>

		

	</div>



</section>





<section class="top-slogan">

	<div class="container">

		<div class="row">

			<?php 

			$left_slogan_query = "SELECT * FROM ".$db_suffix."slogan WHERE slogan_position = 'TOP_LEFT' limit 1";

			

			$left_slogan = $db->select($left_slogan_query);

			if ($row = mysqli_fetch_object($left_slogan)): ?>

			<div class="col-lg-3 col-md-4 col-12">

				<?php if (isset($_SESSION['member_id'])): ?>

					<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>profile/list" class="single-slogan ">

				<?php else: ?>

					<?php if ($page == 'reg'): ?>

						<a href="#" title="Click here to <?php echo $row->slogan_title ?>" class="single-slogan slogan_click">

						<!-- <a target=""  href="" class="single-slogan"> -->

					<?php else: ?>

						<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>create-account" class="single-slogan">

					<?php endif ?>

				<?php endif ?>

				

					<!-- <span><i class="fas fa-bahai"></i></span> -->

					<h4><?php echo $row->slogan_title ?></h4>

				</a>

			</div>

			<?php endif; ?>

			

			<?php 

			$center_slogan_query = "SELECT * FROM ".$db_suffix."slogan WHERE slogan_position = 'TOP_CENTER' limit 1";

			

			$center_slogan = $db->select($center_slogan_query);

			if ($row = mysqli_fetch_object($center_slogan)): ?>

			<div class="col-lg-5 col-md-4 col-12 ">

				

				<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>categories" class="single-slogan">

					<!-- <span><i class="fas fa-bahai"></i></span> -->

					<h4><?php echo $row->slogan_title ?></h4>

				</a>

			</div>

			<?php endif; ?>



			<?php 

			$right_slogan_query = "SELECT * FROM ".$db_suffix."slogan WHERE slogan_position = 'TOP_RIGHT' limit 1";

			

			$right_slogan = $db->select($right_slogan_query);

			if ($row = mysqli_fetch_object($right_slogan)): ?> 

			<div class="col-lg-4 col-md-4 col-12">

				<?php if (isset($_SESSION['member_id'])): ?>

					<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>profile/list" class="single-slogan">

				<?php else: ?>

					<?php if ($page == 'reg'): ?>

						<a href="#" title="Click here to <?php echo $row->slogan_title ?>" class="single-slogan slogan_click">

					<?php else: ?>

						<a target="_blank" title="Click here to <?php echo $row->slogan_title ?>"  href="<?php echo SITE_URL ?>create-account " class="single-slogan">

					<?php endif ?>

					

				<?php endif ?>

					<!-- <span><i class="fas fa-bahai"></i></span> -->

					<h4><?php echo $row->slogan_title ?></h4>

				</a>

			</div>

			<?php endif; ?>

			

		</div>

	</div>

</section>

<!-- New Header section end -->