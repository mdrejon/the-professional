

<div class="tab-pane fade show active" id="verified" role="tabpanel" aria-labelledby="all-tab">
  	<div class="add-list-btn text-right" style="margin-bottom: 20px;">
  		
  	<?php 
  		$job_select_sql = "SELECT *  FROM ".$db_suffix."job  WHERE create_by=".$member_id." AND job_type ='service' order by job_id desc";
  		$job_select_query = $db->select($job_select_sql);
	while ($row = mysqli_fetch_object($job_select_query)):	
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
					 
						<a href="#job-post<?php echo $row->job_id ?>" class="view-profile=" data-toggle="modal" data-target="#exampleModal" >View Job</a>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-body">
						       <div class="container">
									<div class="row">
										<div class="col-lg-12">
							        		<h4 class="single-member-name"><?php echo $row->job_title ?></h4>
											<h6 class="member-name-title"><span><?php echo $row->job_company ?></span> <!-- <span class="verify"><i class="fas fa-user-check"></i></span> --></h6>
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
