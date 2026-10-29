<?php
require_once('../function.php');
$db = new database();
// extract($_POST);

//$query =  "SELECT * FROM ".$db_suffix."job WHERE job_type = 'job' ORDER BY job_id desc, job_order asc LIMIT ".$start.", ".$limit."";
if (isset($_POST["limit"], $_POST["start"])) {
	$limit = $_POST["limit"];
	$start = $_POST["start"];

	$query =  "SELECT * FROM ".$db_suffix."job WHERE job_type='job' ORDER BY job_id desc, job_order asc LIMIT ".$start.", ".$limit."";
	$job_sql = $db->select($query);

	while($row = mysqli_fetch_object($job_sql)){
		$job_start_strtime = strtotime($row->job_start_date);
		$job_start_date = date('d F, Y', $job_start_date);

		$job_deadline_strtime = strtotime($row->job_deadline);
		$job_deadline = date('d F, Y', $job_deadline);
		echo '
			<div class="single-list">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="single-member-img">
							<img src="'.SITE_URL.'data/images/job/'.$row->job_img.'">
						</div>
					</div>
					<div class="col-lg-6 col-md-8">
						<div class="single-member-text">
							<h4 class="single-member-name">'.$row->job_title.' </h4>
							<h6 class="member-name-title"><span>'.$row->job_company.'</span> </h6>

							<p>'.$row->job_desc.'</p>

							<div class="date">
								<span>Posted:<b> '.$job_start_date.'</b> | </span>
								<span>Dedline:<b> '.$job_deadline.'</b></span>
								
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-12">
						<div class="member-button">
							<a href="#job-post'.$row->job_id.'" class="contact view-profile popup-inline ">View Job</a>


						</div>

					</div>
				</div>

				<div id="job-post'.$row->job_id.'" class=" mfp-hide white-popup">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
				        		<h4 class="single-member-name">'.$row->job_title.'</h4>
								<h6 class="member-name-title"><span>'.$row->job_company.'</span> <!-- <span class="verify"><i class="fas fa-user-check"></i></span> --></h6>
				        	</div>
							<div class="col-lg-12">
				        		<div class="job-details-popup">
				       			'.$row->job_desc.'
				       			</div>
				        	</div>
						</div>
					</div>
				</div>
			</div>

		';
	}

}
// else{
// 	echo "no Data showing";
// }

 ?>