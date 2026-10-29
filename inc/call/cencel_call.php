<?php
session_start();
require_once('../../function.php');	
	$db = new database();
	 $member_id = $_SESSION['member_id'];
	 $userid = $_POST['userid'];
	$roomNumber = $_POST['roomNumber'];
if ($_POST['send'] == 3) {
		 // $query = "SELECT * FROM   ".$db_suffix."call  WHERE  call_room_id = '".$roomNumber."' AND call_status = '3' limit 1";
		 $query = "UPDATE dir_call SET call_status='3'  WHERE call_room_id = '".$roomNumber."'";
			$cll_sql = $db->update($query);
			
			 $query2 = "SELECT * FROM   ".$db_suffix."call  WHERE  call_room_id = '".$roomNumber."' AND call_status = '3' limit 1";
				$cll_sql2 = $db->select($query2);
				if ($cll_sql2->num_rows == 1) {
					
					// update Form status
				 	 $from_up_sql = "UPDATE ".$db_suffix."member SET member_call_satus='0'  WHERE member_id = '".$member_id."'";
					 $from_up_query = $db->update($from_up_sql);
					 // update Form status
				 	 $to_up_sql = "UPDATE ".$db_suffix."member SET member_call_satus='0'  WHERE member_id = '".$userid."'";
					 $to_up_query = $db->update($to_up_sql);
					 if ($to_up_query = ture && $from_up_sql = ture) {
					 	// call is going
					 	$data = mysqli_fetch_object($cll_sql2);
					 		echo json_encode(Array(
						    'call_status' => $data->call_status,
						    'call_room_id' => $data->call_room_id,
						));
					 }
				  
					// header('Content-Type: application/json');
				}	
			

		header('Content-Type: application/json');
}

