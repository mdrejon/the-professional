<?php
session_start();
 require_once("function.php"); 
 $db = new database();
// if (isset($_SESSION['member_id'])) {
// 	$member_id = $_SESSION['member_id'];
// }else{
// 	$member_id = '';
// }
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

<!-- 
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">-->

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/owl.carousel.min.css"> 


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  

    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/jquery.animatedheadline.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/intlTelInput.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/nice-select.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/dropify.min.css">
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/typehead-min.css"> -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/style-new.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/responsive.css">
	
     <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyBLqyqBMRgUe1VQg4ZozSH8ZzM7V39orrg&libraries=places&language=en"></script> -->
	 <script src="https://maps.google.com/maps/api/js?key=AIzaSyDg8iOxDVNWPGIsMjaVEgZb-sMG6ERBJg4&libraries=places&language=en"></script>
	<script src="https://maps.google.com/maps-api-v3/api/js/47/7a/geocoder.js"></script>
	
	<script src="<?php echo SITE_URL ?>assets/js/jquery-1.12.4.min.js"></script>
	<title><?php echo SITE_NAME; ?></title>
</head>
<body>
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

<?php include ('leftmenu-2.php'); ?>
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
				<div class="col-lg-3 col-md-3 col-sm-4 col-5">
					<div class="menu-trigger">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<div class="logo">
						<a target=""  href="<?php echo SITE_URL; ?>">
							<img src="https://xpertsfinder.com/assets/images/sitel-logo.jpeg">
							<!-- <h4><?php echo SITE_NAME;  ?></h4> -->

						</a>
						<h6><?php echo SITE_SUBTITLE;  ?></h6>
					</div>
				</div>
				
				<div class="col-lg-9 col-md-9 col-sm-8 col-7  text-right">
					<div class="new-right-menu">
						<ul>
							<?php if (isset($_SESSION['member_id'])): ?>
								
								
								<!-- <li class="border"><a target="_blank"  href="#"><span class="icon"><i class="far fa-comment-dots"></i></span> <span class="border-text">Messages</span>  </a></li> -->
								<li class="border">

									<a href="#"><span class="border-text">Hi, <?php echo $member->member_first_name; ?>  </a>
									<ul class="dropdown">
										<li><a target="_blank"  href="<?php echo SITE_URL ?>profile">Profile</a></li>
										<li><a target="_blank"  href="<?php echo SITE_URL ?>profile/list">View Your List</a></li>
										<li><a target="_blank"  href="<?php echo SITE_URL ?>profile/change-password">Change password</a></li>
										<li><a target="_blank"  href="<?php echo SITE_URL ?>member-logout.php">Log Out</a></li>
									</ul>
								</li>
								<!-- <li class="border"><a target="_blank"  href="<?php echo SITE_URL ?>member-logout.php"><span class="border-text">Sign Out </span><span class="border-icon d-none"><i class="fas fa-sign-in-alt"></i></a> </span> </li> -->
							<?php else: ?>
							<li class="border"><a target="_blank"  href="<?php echo SITE_URL ?>sign-in"><span class="border-icon"><i class="fas fa-sign-in-alt"></i></span><span class="border-text">sign in  </span></a>  </li>


							<li class="border anibate-border"><a target="_blank"  href="<?php echo SITE_URL ?>create-account"><span class="border-icon"><i class="fas fa-user-plus"></i> </span><span class="border-text"> join	Now <span class="its-free">it's Free</span> </a></li>
							
							<?php endif; ?> 
						</ul>
					
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
					<a target="_blank"  href="<?php echo SITE_URL ?>profile/list" class="single-slogan">
				<?php else: ?>
					<a target="_blank"  href="<?php echo SITE_URL ?>create-account" class="single-slogan">
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
				<a href="<?php echo SITE_URL ?>" class="single-slogan prof-search-click">
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
					<a target="_blank"  href="<?php echo SITE_URL ?>profile/list" class="single-slogan">
				<?php else: ?>
					<a target="_blank"  href="<?php echo SITE_URL ?>create-account" class="single-slogan">
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