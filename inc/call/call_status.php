<?php
session_start();
require_once('../../function.php');	
	$db = new database();
	 $member_id = $_SESSION['member_id'];
	 $userid = $_POST['userid'];
	$roomNumber = $_POST['roomNumber'];
if ($_POST['call_status'] == 1) {
		 $query = "SELECT * FROM   ".$db_suffix."call  WHERE  call_room_id = '".$roomNumber."' AND call_to_user = '".$userid."'  AND call_status = '2' limit 1";
		 $cll_sql = $db->select($query);

		 $query2 = "SELECT * FROM   ".$db_suffix."call  WHERE  call_room_id = '".$roomNumber."' AND call_to_user = '".$userid."'  AND call_status = '1' limit 1";
		 $cll_sql2 = $db->select($query2);
			if ($cll_sql->num_rows == 1) {
				$data = mysqli_fetch_object($cll_sql);
			  	echo json_encode(Array(
				    'call_status' => $data->call_status,
				));
				// header('Content-Type: application/json');
			}else if($cll_sql2->num_rows = 1){
				$data2 = mysqli_fetch_object($cll_sql2);
				echo json_encode(Array(
				    'call_status' => $data2->call_status,
				));
			}
			else{
				echo json_encode(Array(
				    'call_status' => '3',
				));
			}
		 

		header('Content-Type: application/json');
}

?>