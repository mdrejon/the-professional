

<section class="how-it-works section-padding" style="background-image: url('assets/img/it-works.jpg')">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8">
				<div class="section-title">
					<h6> </h6>
					<h5> How it works </h5>


				</div>
			</div>
			
		</div>
		<div class="row">
			<?php  

				$about_query = "SELECT * FROM ".$db_suffix."content WHERE content_parent='4' order by content_order asc"; 
				$about_sql = $db->select($about_query);
				while ($row = mysqli_fetch_object($about_sql)) {
					
				?>

			<div class="col-lg-6 col-md-6">
				<div class="it-works">
					<!-- <img src="" alt="It Works"> -->
					
					
					<span class="its-works-icon"><i class="<?php echo $row->content_link ?>"></i></span>
					<div class="its-works-desc">
						<h4><?php echo $row->content_title; ?></h4>
						<p><?php echo $row->content_desc ?></p>
					</div>
					<?php if ($row->content_order !=''): ?>
					<div class="absulate"> 
						<?php echo $row->content_order ?>
					</div>
				<?php endif ?>
						
				</div>
			</div>
			<?php } ?>
			<!-- <div class="col-lg-6 col-md-6">
				<div class="it-works">
					
					<span class="its-works-icon"><i class="far fa-address-card"></i></span>
					<div class="its-works-desc">
						<h4>Complete Your Profile</h4>
						<p>Complete Your Profile Details</p>
					</div>
					<div class="absulate">2</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="it-works">
					
					<span class="its-works-icon"><i class="fas fa-list"></i></span>
					<div class="its-works-desc">
						<h4>List Your Profession And Skill</h4>
						<p>Select your skill and experience for listing your profile.</p>
					</div>
					<div class="absulate">3</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="it-works">
					
					<span class="its-works-icon"><i class="far fa-thumbs-up"></i></span>
					<div class="its-works-desc">
						<h4>Your Profile In Our Directory</h4>
						<p>All set your profile is now Listed.</p>
					</div>
					<div class="absulate">4</div>
				</div>
			</div> -->
			<div class="col-lg-12  text-center">
				
				<a href="<?php echo SITE_URL; ?>user-guide" class="border-btn">User Guide <span><i class="fas fa-chevron-right"></i></span></a>
			</div>
		</div>
	</div>
</section>
