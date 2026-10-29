<?php
session_start();

require_once('../../function.php');	
	$db = new database();
	 $member_id = $_SESSION['member_id'];
	 $userid = $_POST['userid'];
	$roomNumber = $_POST['roomNumber'];
if ($_POST['user_busy'] == 1) {

	  $query2 = "SELECT * FROM   ".$db_suffix."call   WHERE call_room_id = '".$roomNumber."' and call_to_user = '".$userid."' and call_status = '1'";
		$cll_sql2 = $db->select($query2);
		if ($cll_sql2->num_rows == 1) {
			$data = mysqli_fetch_object($cll_sql2);
			 $call_id = $data->call_id;
				
			}	
			if ($call_id !='') {
				
				echo json_encode(Array(
				    'call_status' => '4',
				));
				$query = "UPDATE dir_call SET call_status='4'  WHERE call_id = '$call_id'";
				$db->update($query);
			}
	

// header('Content-Type: application/json');
}