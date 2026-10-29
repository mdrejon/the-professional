<?php 
session_start();
$member_id = $_SESSION["member_id"];

// $conn= mysqli_connect('localhost', 'root', '','ajaxcrud');
require_once('../function.php');
$db = new database();
extract($_POST);

$degree_sql = "SELECT * FROM ".$db_suffix."degree WHERE degree_status='1' order by degree_order";
$degree_query = $db->select($degree_sql);
$degreeOptionsArray = array();
while($degree_data = mysqli_fetch_object($degree_query)){
	$degreeOptionsArray[$degree_data->degree_title] = $degree_data->degree_title;
}

//print_r($degreeOptionsArray);
// $name = 'rejon'
// echo $query ="INSERT INTO ".$db_suffix."education ( education_title, member_id,  education_degree, education_org, education_pass_year ) VALUES ('$ecourse_title', '$member_id', '$degree', '$university', '$p_year')";


if (isset($_POST['readrecord'])) {

	 $dispalydata = "SELECT * FROM ".$db_suffix."education e left join ".$db_suffix."degree d on e.education_degree = d.degree_title WHERE e.member_id='".$_SESSION['member_id']."' order by d.degree_order desc";
	 $education = $db->select($dispalydata);
	 if ($education->num_rows > 0) { 
	while($row = mysqli_fetch_object($education)){
		
		$degree_options = '';
		foreach ($degreeOptionsArray as $degreeOption){
			$selected = '';
			if($row->education_degree == $degreeOption){
				$selected = 'selected';
			}
			$degree_options .='<option '.$selected.' value="'.$degreeOption.'">'.$degreeOption.'</option>';
		}
		


		$data ='
		<li>
			<h6>'.$row->education_title.'  </h6>
			<span class="university">'.$row->education_org.'</span>
			<span class="p-year">Passing Year '.$row->education_pass_year.'</span>
			<div class="education-action">
			<a href="#education" data-toggle="modal" data-target="#edit_contet'.$row->education_id.'" >
				<span><i class="fas fa-edit"></i></span>
			</a>
				
			</div>
			<div id="edit_contet'.$row->education_id.'" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
					<h5 class="modal-title">Edit Education</h5>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>

			      </div>
			      <div class="modal-body">
			       <div class="row">
						<div class="col-lg-12">
							<div class="form-content">
								<div class="show_error2"></div>
								<!-- <form method="POST" accept="#"> -->
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Qualification<span class="red">*</span></label>
												<select class="degree" >
													<option selected value="'.$row->education_degree.'">'.$row->education_degree.'</option>
													<option disabled selected="selected">Select  your qualification</option>
													'.$degree_options.'
												</select>

											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Course Title <span class="red">*</span></label>
												<input type="text" required class="course-title" value="'.$row->education_title.'" placeholder="Course Title ">

												<input type="hidden" class="education_id" value="'.$row->education_id.'"">
												
												
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>University/College/Institute <span class="red">*</span></label>
												<input type="text" required value="'.$row->education_org.'" class="university" placeholder="Type Your University/College  ">
												
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Passing year<span class="red">*</span></label>
												<select  required name="p-year2"  class="p-year" >
										<option disabled selected="selected">Select  your passing year</option>
										';
										$year = date("Y");
										for ($x = 1951; $x <= $year; $x++) {
											if ($row->education_pass_year == $x) {
												$data .= '<option  selected="selected" value="'.$x.'">'.$x.'</option>';
											}else{
												$data .= '<option value="'.$x.'">'.$x.'</option>';
											}
										 
										}

											$data .='</select>
												
											</div> 
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												
												
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>
			      </div>
			      <div class="modal-footer">
			      	<button type="submit" class="editEducation">Update Education</button>
			      	<button type="button" onclick="deleteEducation('.$row->education_id.')">Delete Education</button>
			      </div>
			    </div>

			  </div>
			</div>
		</li>
		';
		echo $data;
	}
	 }
	 else {
		 echo "Your education details helps to get opportunities.";
	 }
	

}
if ( $_POST['set_data'] == 'set_data') {
	$msg['data']='';
	$msg['status']='error';
	$data ='';
	
	if (  $_POST['ecourse_title2'] !=''  &&  $_POST['member_id2'] !='' &&  $_POST['degree2'] !='' && $_POST['university2'] !=''   && $_POST['p_year2'] !='' ) {

		
	$ecourse_title = $_POST['ecourse_title2'];
	$member_id = $_POST['member_id2'];
	$degree = $_POST['degree2'];
	$university = $_POST['university2'];
	$p_year = $_POST['p_year2'];
	$input_error = array();
	// if(!preg_match("/^[a-zA-Z ]*$/", $ecourse_title)){
	if (!preg_match("/^([a-zA-Z' .&]+)$/", $ecourse_title)) {
	      $input_error['ecourse_title'] = "<span>Course Title should be alphabet.</span>";
	      $data .= $input_error['ecourse_title'];
	}
	
	if (!preg_match("/^([a-zA-Z' .&]+)$/", $university)) {
	      $input_error['university'] = "<span>University/College/Institute should be alphabet.</span>";
	      $data .= $input_error['university'];
	}
	  if (isset($degree)) {
	  	// $email_degree = mysqli_query($db,);
	  	$chk_degree = $db->select("SELECT * FROM ".$db_suffix."education WHERE education_degree ='$degree' AND member_id = '$member_id limit 1'");
	  // echo 	"SELECT * FROM ".$db_suffix."education WHERE education_degree ='$degree' AND member_id = '$member_id'";
	  		// $data = mysqli_num_rows($chk_degree);
	  		$degree_query = mysqli_fetch_object($chk_degree);
	  		// echo $degree_query->education_degree;
            if ($degree == $degree_query->education_degree) {
            	$input_error['degree'] = "<span>Qualification already added.</span>";
            	$data .= $input_error['degree'];
            }
	  }
	  if(is_numeric($p_year) && $p_year >=1950 && $p_year <=date("Y"))
	  {
		  
	  }
	  else {
		  $input_error['p_year'] = "<span>Please enter a year between 1950-".date("Y")."</span>";
		  $data .= $input_error['p_year'];
	  }
	  // echo count($input_error);
	  if (count($input_error) == 0) {
	  		if ($ecourse_title != '' || $member_id != '' || $degree != '' || $university != '' || $p_year != '' ) {
				$query ="INSERT INTO ".$db_suffix."education ( education_title, member_id,  education_degree, education_org, education_pass_year ) VALUES ('$ecourse_title', '$member_id', '$degree', '$university', '$p_year')";
					$db->insert($query);
			}
			// echo $query ="INSERT INTO ".$db_suffix."education (subscriber_email  ) VALUES ('$email')";
			
			$data = '<div class="alert alert-success alert-dismissible fade show" role="alert"><p>Your Education information has been added.</p></div>';
			$msg['data']=$data;
			$msg['status']='success';
			
	  }
	  else {
		 $msg['data']=$data;
		 $msg['status']='error'; 
	  }

	
	}else{
		$data= "<span>All (*) fields is required</span>";
		$msg['data']=$data;
		$msg['status']='error'; 
	}
	echo json_encode($msg);
}
if ($_POST['set_data'] == 'update_data') {
	if (  $_POST['ecourse_title'] !=''  &&  $_POST['education_id'] !='' &&  $_POST['degree'] !='' && $_POST['university'] !=''   && $_POST['p_year'] !='' ) {
	$msg['data']='';
	$msg['status']='error';
	$data ='';
		
	$ecourse_title = $_POST['ecourse_title'];
	//$member_id = $_POST['member_id'];
	$degree = $_POST['degree'];
	$university = $_POST['university'];
	$p_year = $_POST['p_year'];
	$education_id = $_POST['education_id']; 
	$input_error = array();
	if (!preg_match("/^([a-zA-Z' .&]+)$/", $ecourse_title)) {
	      $input_error['ecourse_title'] = "<span>Course Title should be alphabet.</span>";
	      $data .= $input_error['ecourse_title'];
	  }
	// if (preg_match("/[^0-9\_-]/i", $p_year)) {
	//       $input_error['p_year'] = "<span>Year should be Number</span>";
	//       echo $data = $input_error['p_year'];
	//   }
	if (!preg_match("/^([a-zA-Z' .&]+)$/", $university)) {
	      $input_error['university'] = "<span>University/College/Institute should be alphabet.</span>";
	      $data .= $input_error['university'];
	  }
	  
	if(is_numeric($p_year) && $p_year >=1950 && $p_year <= date("Y"))
	{
		
	}
	else {
		$input_error['p_year'] = "<span>Please enter a year between 1950-".date("Y")."</span>";
	      $data .= $input_error['p_year'];
	}
	  // if (isset($degree)) {
	  // 	// $email_degree = mysqli_query($db,);
	  // 	$chk_degree = $db->select("SELECT * FROM ".$db_suffix."education WHERE education_degree ='$degree' AND member_id = '$member_id limit 1'");
	  // // echo 	"SELECT * FROM ".$db_suffix."education WHERE education_degree ='$degree' AND member_id = '$member_id'";
	  // 		// $data = mysqli_num_rows($chk_degree);
	  // 		$degree_query = mysqli_fetch_object($chk_degree);
	  // 		// echo $degree_query->education_degree;
   //          if ($degree == $degree_query->education_degree) {
   //          	$input_error['degree'] = "<span>Degree already added.</span>";
   //          	echo  $data = $input_error['degree'];
   //          }
	  // }
	  // echo count($input_error);
	  if (count($input_error) == 0) {
	  		if ($ecourse_title != '' || $member_id != '' || $degree != '' || $university != '' || $p_year != '' ) {
				$query ="UPDATE ".$db_suffix."education SET education_title = '".$ecourse_title."', education_degree = '".$degree."', education_org = '".$university."', education_pass_year = '".$p_year."' WHERE  education_id = '$education_id' and member_id='$member_id'";
					$db->update($query);

				$data = '<div class="alert alert-success alert-dismissible fade show" role="alert"><p>Your Education information has been updated.</p></div>';
				$msg['data']=$data;
				$msg['status']='success';
				//echo '<script>window.location="'.SITE_URL.'profile";</script>';
			}
			// echo $query ="INSERT INTO ".$db_suffix."education (subscriber_email  ) VALUES ('$email')";
			
	  }
	  else {
		 $msg['data']=$data;
		 $msg['status']='error'; 
	  }

	
	}else{
		$data= "<span>All (*) fields is required</span>";
		$msg['data']=$data;
		 $msg['status']='error'; 
		// echo $ecourse_title;
	}
	echo json_encode($msg);
}
if ($_POST['set_data'] == 'delete_data') {
	$msg['data']='';
		 $msg['status']='error';
	if (  $_POST['education_id'] !='') {
		$education_id = $_POST['education_id'];
				$query ="delete FROM ".$db_suffix."education WHERE  education_id = '$education_id' and member_id='$member_id'";
					$db->update($query);
				$data = '<div class="alert alert-success alert-dismissible fade show" role="alert"><p>Qualification has been deleted.</p></div>';
				$msg['data']=$data;
		 $msg['status']='success';

	
	}else{
		$data= "<span>Unable to delete.</span>";
		$msg['data']=$data;
		 $msg['status']='error';
	}
	echo json_encode($msg);
}

?>