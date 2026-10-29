<?php 
require_once('../function.php');
$db = new database();

	if (isset($_POST['action'])) {
		$today = date("Y-m-d");
		$query =  "SELECT * FROM ".$db_suffix."job WHERE  job_type ='service' and  job_start_date <='$today' and job_deadline >='$today' ";
		if (isset($_POST['categories'])) {
			 $categories = implode("','", $_POST['categories']);
			$query .="AND categories_id IN('".$categories."') ";
			//echo $query;
		}if (isset($_POST['country'])) {
			 $country = implode("','", $_POST['country']);
			$query .="AND country_id IN('".$country."') ";
			
		}if (isset($_POST['re_added'])) {
			 $re_added = implode("','", $_POST['re_added']);
			$query .="AND country_id IN('".$re_added."') ";
		}if (isset($_POST['all_job'])) {
			 $all_job = implode("','", $_POST['all_job']);
			$query .="AND country_id IN('".$all_job."') ";
		}
		 $query .=" ORDER BY job_id desc, job_order asc";
		 
		$result = $db->select($query);
		$output = "";
		if ($result->num_rows > 0) {
			  $result->num_rows;
			while ( $row = mysqli_fetch_object($result)) {
				$job_start_strtime = strtotime($row->job_start_date);
				$job_start_date = date('d F, Y', $job_start_strtime);

				$job_deadline_strtime = strtotime($row->job_deadline);
				$job_deadline = date('d F, Y', $job_deadline_strtime);
				 $output .= '
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

							<p>'.substr($row->job_desc, 0, 201).'</p>

							<div class="date">
								<span>Posted:<b> '.$job_start_date.'</b> | </span>
								<span>Dedline:<b> '.$job_deadline.'</b></span>
								
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-12">
						<div class="member-button">
							
							<button type="button" class="contact" data-toggle="modal" data-target="#contact-popup'.$row->job_id.'">View Service</button>

						</div>

					</div>
				</div>
				<div class="modal fade popup-contact" id="contact-popup'.$row->job_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      
				      <div class="modal-body">
				      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      	<h4 class="single-member-name">'.$row->job_title.'</h4>
				      	<h6 class="member-name-title"><span>'.$row->job_company.'</span> <!-- <span class="verify"><i class="fas fa-user-check"></i></span> --></h6>
							<span class="job-meta"><b>Type:</b> '.$row->job_type.'</span>
							
							<span class="job-meta"><b>Expart In:</b> '.$row->categories_name.'</span>
							<span class="job-meta"><b>Number of vacancies: </b>  '.$row->job_vacancies.'</span>
							<span class="job-meta"><b>Experience: </b> '.$row->job_experience.' years</span>
							<span class="job-meta"><b>salary: </b>'.$row->job_salary.' </span>

						<div class="job-details-popup">
			       				'.$row->job_desc.'
			       			</div>
				       
				      </div>
				    <!--   <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
				      </div> -->
				    </div>
				  </div>
				</div>
			</div>
				';

			}
			echo  $output;
			//echo $result->num_rows;
		}
		else{echo '<span class="no-data">There is no service found in this search</span>' ;}
	}

 ?>