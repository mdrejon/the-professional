<?php
session_start();
require_once('../function.php');	
	$db = new database();
	 $member_id = $_SESSION['member_id'];
	//  $userid = $_POST['userid'];
	// $roomNumber = $_POST['roomNumber'];
// echo json_encode(Array(
// 		    'call_room_id' => $data->call_room_id,
// 		    'phone' => "1234567890",
// 		    'details' => "Details about..."
// 		));
if ($_POST['send'] == 1) {
		 $query = "SELECT * FROM   ".$db_suffix."call  WHERE  call_to_user = '".$member_id."' AND call_status = '1' limit 1";
			$cll_sql = $db->select($query);
			if ($cll_sql->num_rows == 1) {
				$data = mysqli_fetch_object($cll_sql);
				$query2 = "SELECT * FROM   ".$db_suffix."member  WHERE  member_id = '".$data->call_from_user."' limit 1";
				$cll_sql2 = $db->select($query2);
				$from = mysqli_fetch_object($cll_sql2);
				  echo json_encode(Array(
				    'call_room_id' => $data->call_room_id,
				    'from_id' => $from->member_id,
				    'member_first_name' => $from->member_first_name,
				    'member_last_name' => $from->member_last_name,
				    'member_img' => $from->member_img,
				    // 'call_status' => $data->call_status,
				    // 'call_room_id' => $data->call_room_id,
				));
			}

		header('Content-Type: application/json');
}


 ?>