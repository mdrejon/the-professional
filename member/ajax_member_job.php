<?php 
session_start();


// $conn= mysqli_connect('localhost', 'root', '','ajaxcrud');
require_once('../function.php');
$db = new database();
extract($_POST);
// $name = 'rejon'
// echo $query ="INSERT INTO ".$db_suffix."education ( education_title, member_id,  education_degree, education_org, education_pass_year ) VALUES ('$ecourse_title', '$member_id', '$degree', '$university', '$p_year')";


if (isset($_POST['readrecord'])) {

	 $dispalydata = "SELECT * FROM ".$db_suffix."education WHERE member_id='".$_SESSION['member_id']."'";
	 $education = $db->select($dispalydata);
	while($row = mysqli_fetch_object($education)){
		$data ='
		<li>
			<h6>'.$row->education_title.'  </h6>
			<span class="university">'.$row->education_org.'</span>
			<span class="p-year">Passing Year '.$row->education_pass_year.'</span>

		</li>
		';
		echo $data;
	}
	

}

if (  isset($_POST['ecourse_title'])  &&  isset($_POST['member_id']) && isset($_POST['degree']) && isset($_POST['university'])   && isset($_POST['p_year']) ) {
	$ecourse_title = $_POST['ecourse_title'];
	$member_id = $_POST['member_id'];
	$degree = $_POST['degree'];
	$university = $_POST['university'];
	$p_year = $_POST['p_year'];
	if ($ecourse_title != '' || $member_id != '' || $degree != '' || $university != '' || $p_year != '' ) {
		$query ="INSERT INTO ".$db_suffix."education ( education_title, member_id,  education_degree, education_org, education_pass_year ) VALUES ('$ecourse_title', '$member_id', '$degree', '$university', '$p_year')";
			$db->insert($query);
	}
	// echo $query ="INSERT INTO ".$db_suffix."education (subscriber_email  ) VALUES ('$email')";
	
}
// else{
// 	echo "Not inserted";
// }




// require_once('../function.php');  
// $db = new database();
// // extract($_POST);
// echo $query ="INSERT INTO ".$db_suffix."education ( education_title, member_id,  education_degree, education_org, education_pass_year ) VALUES ('$ecourse_title', '$member_id', '$degree', '$university', '$p_year')";
// if ( isset($_POST['degree']) && isset($_POST['ecourse_title']) && isset($_POST['university'] && isset($_POST['p_year']) &&  isset($_POST['member_id']  ) {
	
// 	echo $query ="INSERT INTO ".$db_suffix."education ( education_title, member_id,  education_degree, education_org, education_pass_year ) VALUES ('$ecourse_title', '$member_id', '$degree', '$university', '$p_year')";
// 	// mysqli_query($conn, $query);
// 	$db->insert($query);
// }

?>
<!-- <a href="#education2" class="edit-edu" data-toggle="modal" data-target="#add-contet2" >
									<i class="fas fa-plus"></i>
								</a> -->