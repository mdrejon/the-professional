<?php 

session_start();

require_once('common/header.php');
	
?>
<?php 
	 $banner_query = "SELECT * FROM ".$db_suffix."banner WHERE banner_id = '26'";
	
	$banner = $db->select($banner_query);
	if ($banner_datas = mysqli_fetch_object($banner)): ?>
<section class="hero-banner home section-padding" style="background-image: url('<?php echo SITE_URL ?>/<?php echo $banner_datas->banner_image ?>');">
	<div class="hero-banner-wrap">
		<div class="container">
			 
			<div class="row">
			
				<div class="col-lg-8 col-md-8 col-xl-8 col-12">
					<div>
					<?php
						$default_slogan_query = "SELECT * FROM ".$db_suffix."slogan WHERE slogan_position = 'DEFAULT' AND slogan_status = '1' ORDER BY slogan_id desc, slogan_order desc limit 1";
						
						$default_slogan = $db->select($default_slogan_query);
						if ($row = mysqli_fetch_object($default_slogan)): ?>
						<div class="animate-css">
							<svg>
								<text  x="50%" y="50%" fill="transparent" text-anchor="middle">
									<?php echo $row->slogan_title ?>
								</text>
							</svg>
							<h1 data-text="Global Network Global Services">
								
							</h1>
						</div>
					<?php endif; ?>
					</div>
					<div class="hero-content1">
						<div class="single-content-slider">
							<p> Every human being has some talent, excellence and expertise of their own and that expertise has a market value & potential to sell to others. On the other hand, in this busy life, people want ready information in their hand to find an expert to perform a services or job.</p> 
							<a href="#" class="border-btn hero-read-more-btn">Read More</a>
							<div class="hero-content-coups">
								<p>XpertsFinder is one to one direct communication platform, specially designed and developed targeting every individual professional or freelancers or every enterprise in this world, from north to south, east to west, for every corner of the world; where service seeker and service buyer or job seekers and employee seekers can contact each other directly to accomplish their needs. </p>
								
								<p> If you are a professional or has expertise on any field or have any special skills, you may create and keep your profile at XpertsFinder, which is completely free to enrol and keep saved; so that any service seeker can search, check, find and can contact you directly. It is also free for the service seekers who may need services from any individual/ experts. Free for employer to search and contact directly to job seekers for his own or for his organization. </p>
							
								<p> XpertsFinder is also completely free of charges to see contact details, profiles of every individuals/ professionals. Publishing job or services are also free of charges. XpertsFinder do not imply or impose any charges or any commission for publishing or seeing any profiles, contact details, job circular or service posting on the wall.</p>
						
								<p>XpertsFinder is giving you opportunity to present your individual skills/ expertise globally, so that you do not need to hang on to anyone else. Be your own boss. Grave opportunity yourself. </p>
							</div>
								
						</div> 
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xl-4 col-12">
					
					
					
					<!-- <div id="typed-strings">
						  <h1>Global Network <span>Global Services</span></h1>
						  <h1>Local Network  <span>Local Service</span></h1>
						  <h1>Become Listed, <span>Get Business</span></h1>
						  <h1>Become Listed,<span> Get The Job</span></h1>
						  <h1>Site For Worldwide Professionals To Be <span>Hunted</span></h1>
						  <h1>Site For Works <span>Buyer / Sellers</span></h1>
						  <h1>Any Services Any Job Find  <span>The Experts Here</span></h1>
					</div>
						<span id="typed"></span>
					 -->
				<!-- 	<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor </h6> -->
					<?php require_once('common/banner-search-home.php');?>
					<!-- <div class="trending-keywords"> 
						<p><i class="fas fa-paper-plane"></i><span>Trending Keywords: </span>   --> 
							<?php 
								$ctg_sql = "SELECT * FROM ".$db_suffix."categories LIMIT 10";
					
								$ctg_query = $db->select($ctg_sql);
								while ($row = mysqli_fetch_object($ctg_query)): 
							 ?>
						<!-- 	<a href="<?php echo SITE_URL ?>listing/<?php  echo $row->categories_slug ?>"><?php echo $row->categories_name ?> </a>,  -->
							<?php endwhile ?>
							<!-- <a href="#">Ui Designer </a>, <a href="#">Ui Designer </a>, <a href="#">Ui Designer </a>, 
						</p>
					</div> -->
				</div>
				
				
				
				
			</div>
		</div>
	</div>


</section>
<?php endif; ?>
<!-- <section class="slogan-section section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="single-slogan text-center">
					<h3></h3>
				</div>
			</div>
		</div>
	</div>
</section> -->

<section class="section-padding categories-3">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h5>Professional Categories</h5>
				</div>
			</div>
		</div>
		<div class="row">
			<?php 
				$categories_query = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = 0 ORDER BY categories_id asc, categories_order asc";
				
				$categories = $db->select($categories_query);
				while ($row = mysqli_fetch_object($categories)): ?>
			
			<div class="col-lg-2 col-md-3 col-sm-6">
				<a href="<?php echo SITE_URL ?>categories/<?php echo $row->categories_slug ?>" class="single-categories-3 text-center" target="_blank">
					<?php if ($row->categories_icon !=''): ?>
						<!-- <span class="ctg-icon"><?php //echo $row->categories_icon ?></span> -->
						<span class="ctg-icon"><i class="<?php echo $row->categories_icon ?>"></i> </span>
					<?php else: ?>
						<span class="ctg-icon"><img src="<?php echo SITE_URL ?>/<?php echo $row->categories_img ?>"></span>
					<?php endif ?>
					
					<h6><?php echo $row->categories_name; ?> <br> 
						<?php if ($row->categories_total_member != 0 ): ?>
							<span><?php echo $row->categories_total_member ?> People</span>
						<?php endif ?>

						

					</h6>

				</a>
			</div>
		<?php endwhile; ?>

		</div>
		
	</div>
</section> 
<?php  require_once("common/it-works.php");  ?>
<section class="top-slogan t-s-2 section-padding" >
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<?php if (isset($_SESSION['member_id'])): ?>
					<a href="<?php echo SITE_URL ?>profile/list" class="single-slogan">
				<?php else: ?>
					<a href="<?php echo SITE_URL ?>sign-in" class="single-slogan">
				<?php endif ?>
				
					
					<!-- <h4></h4> -->
					<h4><i class="fas fa-briefcase"></i> Post Jobs</h4>
				</a>
			</div>
			<!-- <div class="col-lg-2 col-md-2 col-12"></div> -->
			<div class="col-lg-6 col-md-6 col-12">
				<?php if (isset($_SESSION['member_id'])): ?>
					<a href="<?php echo SITE_URL ?>profile/list" class="single-slogan">
				<?php else: ?>
					<a href="<?php echo SITE_URL ?>sign-in" class="single-slogan">
				<?php endif ?>
					
					<h4><i class="fas fa-cogs"></i> Post Services</h4>
				</a>
			</div>
		</div>
	</div>
</section>





<section class="section-padding job-section j-s-2" style="background-image: url('assets/img/recent-job-3.jpg');">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h5>Recent  Job</h5>
						</div>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-lg-12">
						<?php 
						 	$service_query = "SELECT * FROM ".$db_suffix."job WHERE job_type='job' and job_status = '1' ORDER BY categories_id desc, job_order asc";
							
							$service_sql = $db->select($service_query);
							while ($row = mysqli_fetch_object($service_sql)):
								$job_deadline = strtotime($row->job_deadline);
								$job_deadline = date('d F, Y', $job_deadline);
							 ?>
						<div class="single-list">
							<div class="row">
								<div class="col-lg-5 col-md-5 col-5">
									<div class="single-member-img">
										<img src="<?php echo SITE_URL ?>data/images/job/<?php echo $row->job_img ?>">
									</div>
								</div>
								<div class="col-lg-7 col-md-7 col-7">
									<div class="single-member-text">
										<h4 class="single-member-name"><?php echo $row->job_title ?> </h4>
										<h6 class="member-name-title"><span><?php echo $row->job_company ?></span><!--  <span class="verify"><i class="fas fa-user-check"></i></span> --></h6>

										<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p> -->
										
										<div class="date">
											<span> Deadline: <b><?php echo $job_deadline ?></b></span>
										</div>
										<div class="member-button">
										<!-- <a href="#" class="view-profile">View Job</a> -->
											<!-- <button type="button" class="contact view-profile" data-toggle="modal" data-target="#job-popup">View Job</button> -->
											<a href="#job-post<?php echo $row->job_id ?>" class="contact view-profile popup-inline ">View Job</a>
										</div>
									</div>
								</div>
							</div>
							<div id="job-post<?php echo $row->job_id ?>" class=" mfp-hide white-popup">
								<div class="container">
									<div class="row">
										<div class="col-lg-12">
							        		<h4 class="single-member-name"><?php echo $row->job_title ?></h4>
											<h6 class="member-name-title"><span><?php echo $row->job_company ?></span> <!-- <span class="verify"><i class="fas fa-user-check"></i></span> --></h6>
											<?php 
												if ($row->categories_name != '') {
									      		echo '<span class="job-meta"><b>Expart In:</b> '.$row->categories_name.'</span>';
											      	}
										      	if ($row->job_vacancies != '') {
										      		echo '<span class="job-meta"><b>Number of vacancies: </b>  '.$row->job_vacancies.'</span>';
										      	}
										      	if ($row->job_experience != '') {
										      		echo '<span class="job-meta"><b>Experience: </b> '.$row->job_experience.' years</span>';
										      	}
										      	if ($row->job_salary != '') {
										      		echo '<span class="job-meta"><b>salary: </b>'.$row->job_salary.' </span>';
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
						</div>
					<?php endwhile ?>
					
						
					</div>
					<div class="col-lg-12 text-center">
						<a href="<?php echo SITE_URL ?>jobs" class="border-btn">View All Job Post <span><i class="fas fa-chevron-right"></i></span></a>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h5>Recent  Service</h5>
						</div>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-lg-12">
						<?php 
						 	$service_query = "SELECT * FROM ".$db_suffix."job WHERE job_type='service' and job_status = '1' ORDER BY categories_id desc, job_order asc";
							
							$service_sql = $db->select($service_query);
							while ($row = mysqli_fetch_object($service_sql)): 
								$job_deadline = strtotime($row->job_deadline);
								$job_deadline = date('d F, Y', $job_deadline);

								?>
						<div class="single-list">
							<div class="row">
								<div class="col-lg-5 col-md-5 col-5">
									<div class="single-member-img">
										<img src="<?php echo SITE_URL ?>data/images/job/<?php echo $row->job_img ?>">
									</div>
								</div>
								<div class="col-lg-7 col-md-7 col-7">
									<div class="single-member-text">
										<h4 class="single-member-name"><?php echo $row->job_title ?> </h4>
										<h6 class="member-name-title"><span><?php echo $row->job_company ?></span><!--  <span class="verify"><i class="fas fa-user-check"></i></span> --></h6>

										<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p> -->
										
										<div class="date">
											<span> Deadline: <b><?php echo $job_deadline ?></b></span>
										</div>
										<div class="member-button">
										<!-- <a href="#" class="view-profile">View Job</a> -->
											<!-- <button type="button" class="contact view-profile" data-toggle="modal" data-target="#job-popup">View Job</button> -->
											<a href="#job-post<?php echo $row->job_id ?>" class="contact view-profile popup-inline ">View Job</a>
										</div>
									</div>
								</div>
							</div>
							<div id="job-post<?php echo $row->job_id ?>" class=" mfp-hide white-popup">
								<div class="container">
									<div class="row">
										<div class="col-lg-12">
							        		<h4 class="single-member-name"><?php echo $row->job_title ?></h4>
											<h6 class="member-name-title"><span><?php echo $row->job_company ?></span>
											<!-- <span class="verify"><i class="fas fa-user-check"></i></span> --></h6>
											<?php 
												if ($row->categories_name !='') {
														echo '<span class="job-meta"><b>Expart In:</b> '.$row->categories_name.'</span>';
													}
											
													if ($row->job_experience !='') {
														echo '<span class="job-meta"><b>Experience: </b> '.$row->job_experience.' years</span>';
													}
											
													if ($row->job_salary !='') {
														$output .= '<span class="job-meta"><b>salary: </b>'.$row->job_salary.' </span>';
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
						</div>
						<?php endwhile; ?>
						
					</div>
					<div class="col-lg-12 text-center">
						<a href="<?php echo SITE_URL ?>services" class="border-btn">View All Service Post <span><i class="fas fa-chevron-right"></i></span></a>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="row justify-content-center">
			<div class="col-lg-10 col-md-10">
				<div class="single-job">
					<div class="row">
						<div class="col-lg-3">
							<div class="job-thumb">
								<img src="assets/img/job-post.jpg" alt="job-post">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="job-details">
								<h4 class="job-title">Project Leader – Information Technology</h4>
								<span class="job-company"><i class="fas fa-briefcase"></i> Smart Framework</span>
								<span class="location"><i class="fas fa-map-marker-alt"></i>USA</span>
								<span class="job-post-date">posted 3 days ago</span>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="job-action">
								<span class="job-types">Part Time</span>
								<a href="" class="boxed-btn bg">View Details</a>
								
							</div>
						</div>
					</div>
				</div>
			</div> 
			<div class="col-lg-10 text-center">
				<a href="#" class="border-btn"> View All</a>
			</div>
		</div> -->
	</div>
</section> 


<script>
	$(".hero-read-more-btn").click(function(){
		$(".hero-content-coups").addClass("active");
		$(".hero-read-more-btn").addClass("hide");
	});
</script>
<?php 
require_once('common/blog-section.php');
    
?><?php 
require_once('common/footer.php');
    
?>