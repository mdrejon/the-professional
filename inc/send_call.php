<?php
session_start();
if( $_POST['send'] == '1' ){
require_once('../function.php');	
	$db = new database();
	$member_id = $_SESSION['member_id'];
	// $userid = '154';
	$userid = $_POST['userid'];
	$roomNumber = $_POST['roomNumber'];

	// chk Cender Is anoutehr call or not
	 $call_from_member = "SELECT * FROM  ".$db_suffix."member  WHERE  member_id = '".$member_id."' limit 1";
	 $call_from_m = $db->select($call_from_member);
	 $form = mysqli_fetch_object($call_from_m);
	 if ($form->member_call_satus == 0) {
	 	$status = '';
		$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
		$user_last_activity = fetch_user_last_activity($userid, $connect);
		if($user_last_activity > $current_timestamp){
			// receiver is online
			$user_status = 2;
		} else {
			// receiver is ofline
			$user_status = 1;
		}
		 $query= "INSERT INTO ".$db_suffix."call( call_to_user, call_from_user, call_room_id, call_status )  VALUES ('$userid','$member_id','$roomNumber','1'  )";
		 $result = $db->insert($query);
		 if ($result) {
		 	 // $user_status;
		 	if ($user_status == 2) {
		 		$call_to_member = "SELECT * FROM  ".$db_suffix."member  WHERE  member_id = '".$userid."' limit 1";
				 $call_to_m = $db->select($call_to_member);
				 $to = mysqli_fetch_object($call_to_m);
				 if ($form->member_call_satus == 0) {
				 	// update Form status
				 	 $from_up_sql = "UPDATE ".$db_suffix."member SET member_call_satus='1'  WHERE member_id = '".$member_id."'";
					 $from_up_query = $db->update($from_up_sql);
					 // update Form status
				 	 $to_up_sql = "UPDATE ".$db_suffix."member SET member_call_satus='1'  WHERE member_id = '".$userid."'";
					 $to_up_query = $db->update($to_up_sql);
					 if ($to_up_query = ture && $from_up_sql = ture) {
					 	// call is going
					 	$user_status = 1;
					 }

				 }else{
				 	// receiver is ofine
				 	$user_status = 4;
				 }
		 	}
		 }


	 }else{
	 	// caller is anouthe call
	 	$user_status = 3;
	 }

	echo $user_status;
		

}

 ?>