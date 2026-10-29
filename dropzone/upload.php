<?php
	require_once('../config/dbconnect.php');
	// ----------------- Database connection ----------------
	$hostname 			=			"localhost";
	$username			=			"hostlive_achub";
	$password 			=			"v)aDvI_N1n}]";
	$dbname 			=			"hostlive_achub";
	
	//$conn				=			mysqli_connect($hostname, $username, $password, $dbname) or die("Db connect error" .mysqli_connect_error());

    $candidate_id = $_SESSION['candidate_id'];
	// ------------- Check if file is not empty ------------
	if(!empty($_FILES)) {

		$fileName 				=			$_FILES['file']['name'];

		$source_path 			=			$_FILES['file']['tmp_name'];

		$fileExtension			=			pathinfo($fileName, PATHINFO_EXTENSION);

		
		$targetFile				=			time()."-".time()."-".strtolower(str_replace(" ","-",$fileName));

		$target_path 			    =			"../data/uploads/".$targetFile;
		$file_url = SITE_URL.'/data/uploads/'.$targetFile;

		if(move_uploaded_file($source_path, $target_path)) {

			$sql 			=			"INSERT INTO ah_file_upload (file_url,candidate_id) VALUES ('".$file_url."','".$candidate_id."')";

			$result 		=			mysqli_query($db, $sql);
			if($result) {
				echo "File uploaded successfully";
			}
			
		}		
	}
?>