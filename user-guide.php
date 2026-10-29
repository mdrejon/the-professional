<?php 
require_once('common/header.php');
	
?>
<!-- New Header section end -->

<!-- New Header section end -->
<section class="section-padding bredcumb" style="background-image: url('assets/img/bannar-4.jpg');">
	<div class="container">
		
		<div class="row text-center">
			<div class="col-lg-12">
			<?php require_once('common/banner-search.php'); ?>
				<!-- <h4 class="bredcumb-title">Listing</h4> -->
				<p><a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home <span></a><i class="fas fa-arrow-circle-right"></i></span>  User Guide </p>	
			</div>
		</div>
	</div>
</section>

<section class="user-guide section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h5>User Guide</h5>
				</div>
			</div>
		</div>

		<div class="row">
			<?php
				$job_guide_query = "SELECT * FROM ".$db_suffix."content WHERE content_id = '11' ORDER BY content_id desc, content_order asc";
				
				$job_guide_sql = $db->select($job_guide_query);
				$job_guide = mysqli_fetch_object($job_guide_sql)
			?>
			<div class="col-lg-6">
				<div class="guide-title">
					<h6> <?php echo $job_guide->content_title; ?></h6>

				</div>

				<div class="guide-text">
					 <?php echo $job_guide->content_desc; ?>

					<div id="accordion" class="custom-accordion">
					<?php
						$job_guide_step_query = "SELECT * FROM ".$db_suffix."content WHERE content_parent = '".$job_guide->content_id."' ORDER BY content_id desc, content_order asc";
						
						$job_guide_step_sql = $db->select($job_guide_step_query);
						
					?>
					<?php while($row = mysqli_fetch_object($job_guide_step_sql)): ?>
					  <div class="card">
					    <div class="card-header" id="heading<?php echo $row->content_id; ?>">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $row->content_id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row->content_id; ?>">
					          <?php echo $row->content_title; ?>
					        </button>
					      </h5>
					    </div>

					    <div id="collapse<?php echo $row->content_id; ?>" class="collapse" aria-labelledby="heading<?php echo $row->content_id; ?>" data-parent="#accordion">
					      <div class="card-body">
					       <?php echo $row->content_desc; ?>
					      </div>
					    </div>
					  </div>
					  <?php endwhile; ?>
					</div>
				</div>
			</div>
			<?php
				$buyer_guide_query = "SELECT * FROM ".$db_suffix."content WHERE content_id = '13' ORDER BY content_id desc, content_order asc";
				
				$buyer_guide_sql = $db->select($buyer_guide_query);
				$buyer_guide = mysqli_fetch_object($buyer_guide_sql)
			?>
			<div class="col-lg-6">
				<div class="guide-title">
					<h6> <?php echo $buyer_guide->content_title; ?></h6>

				</div>

				<div class="guide-text">
					 <?php echo $buyer_guide->content_desc; ?>

					<div id="accordion" class="custom-accordion">
					<?php
						$buyer_guide_step_query = "SELECT * FROM ".$db_suffix."content WHERE content_parent = '".$buyer_guide->content_id."' ORDER BY content_id desc, content_order asc";
						
						$buyer_guide_step_sql = $db->select($buyer_guide_step_query);
						
					?>
					<?php while($row = mysqli_fetch_object($buyer_guide_step_sql)): ?>
					  <div class="card">
					    <div class="card-header" id="heading<?php echo $row->content_id; ?>">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $row->content_id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row->content_id; ?>">
					          <?php echo $row->content_title; ?>
					        </button>
					      </h5>
					    </div>

					    <div id="collapse<?php echo $row->content_id; ?>" class="collapse" aria-labelledby="heading<?php echo $row->content_id; ?>" data-parent="#accordion">
					      <div class="card-body">
					       <?php echo $row->content_desc; ?>
					      </div>
					    </div>
					  </div>
					  <?php endwhile; ?>
					</div>
				</div>
			</div>
		<!--	<div class="col-lg-6">
				<div class="guide-title">
					<h6>Service buyer and employment guide</h6>

				</div>

				<div class="guide-text">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

					<div id="accordion2" class="custom-accordion">
					  <div class="card">
					    <div class="card-header" id="heading4">
					      <h5 class="mb-0">
					        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
					          Step 1
					        </button>
					      </h5>
					    </div>

					    <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordion">
					      <div class="card-body">
					        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="heading5">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
					         Step 2
					        </button>
					      </h5>
					    </div>
					    <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
					      <div class="card-body">
					        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="heading6">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
					         Step 3
					        </button>
					      </h5>
					    </div>
					    <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
					      <div class="card-body">
					        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
					      </div>
					    </div>
					  </div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</section>

<?php 
require_once('common/footer.php');
    
?>