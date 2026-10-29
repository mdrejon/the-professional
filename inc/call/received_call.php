<?php
session_start();
require_once('../../function.php');	
	$db = new database();
	 $member_id = $_SESSION['member_id'];
	 $userid = $_POST['userid'];
	$roomNumber = $_POST['roomNumber'];
if ($_POST['send'] == 2) {
		 // $query = "SELECT * FROM   ".$db_suffix."call  WHERE  call_room_id = '".$roomNumber."' AND call_status = '3' limit 1";
		 $query = "UPDATE dir_call SET call_status='2'  WHERE call_room_id = '".$roomNumber."' and call_status = '1' limit 1";
			$cll_sql = $db->update($query);
			
			 $query2 = "SELECT * FROM   ".$db_suffix."call  WHERE  call_room_id = '".$roomNumber."' AND call_status = '2' limit 1";
				$cll_sql2 = $db->select($query2);
				if ($cll_sql2->num_rows == 1) {
					$data = mysqli_fetch_object($cll_sql2);
				  	echo json_encode(Array(
					    'call_status' => $data->call_status,
					));
					// header('Content-Type: application/json');
				}	
			

		header('Content-Type: application/json');
}