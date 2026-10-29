<?php
session_start();
if( $_POST['send'] == '1' ){
require_once('../function.php');	
	$db = new database();
	 $member_id = $_SESSION['member_id'];
	 $userid = $_POST['userid'];
	$roomNumber = $_POST['roomNumber'];

	// $query2 = "SELECT * FROM   ".$db_suffix."chat_message cm left join ".$db_suffix."member m  on cm.from_user_id = m.member_id left join ".$db_suffix."categories ca on m.categories_id = ca.categories_id WHERE cm.to_user_id = '".$_SESSION['member_id']."'   group by m.member_id";
if (isset($userid) && isset($roomNumber) && isset($user_status) ) {
	// call from user
	 $call_from_sql = "SELECT * FROM   ".$db_suffix."call  WHERE  call_from_user = '".$member_id."' AND call_status = '2' limit 1";
	 $call_from_r = $db->select($call_from_sql);

	 // call to
	 $call_to_sql = "SELECT * FROM   ".$db_suffix."call  WHERE  call_to_user = '".$userid."' AND call_status = '2' limit 1";
	 $call_to_r = $db->select($call_to_sql);
	 if ($call_to_r->num_rows == 1) {
	 	$user_status = 2;

	 } else if($call_from_r->num_rows == 1){
	 	$user_status = 3;
	 }else{
	 	$status = '';
		$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
		$user_last_activity = fetch_user_last_activity($userid, $connect);
		if($user_last_activity > $current_timestamp){
			$user_status = 1;
		} else {
			$user_status = 0;
		}
		 $query= "INSERT INTO ".$db_suffix."call( call_to_user, call_from_user, call_room_id, call_status )  VALUES ('$userid','$member_id','$roomNumber','$user_status'  )";
		 $result = $db->insert($query);
		 if ($result) {
		 	echo $user_status;
		 }


	 }

}
		

}

 ?>