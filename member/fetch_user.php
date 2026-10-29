<?php
// session_start();
// require_once('../function.php');
// $bd = new database();


// echo $query = "SELECT * FROM ".$db_suffix."member WHERE member_id != '".$_SESSION['member_id']."'";
// $statement = $bd->select($query);


// while($row = mysqli_fetch_object($statement)){
// $status = '';
		// $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		// $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
		// $user_last_activity = fetch_user_last_activity($row['user_id'], $bd);
		// if($user_last_activity > $current_timestamp){
		// 	$status = '<h2><span class="label label-success">Online</span></h2>';
		// } else {
		// 	$status = '<h2><span class="label label-danger">Offline</span></h2>';
		// }

session_start();
include('../function.php');

 $member_id = $_SESSION['member_id'];
  $query = "SELECT * FROM   ".$db_suffix."chat_message cm left join ".$db_suffix."member m  on cm.from_user_id = m.member_id left join ".$db_suffix."categories ca on m.categories_id = ca.categories_id WHERE cm.to_user_id = '".$_SESSION['member_id']."'   group by m.member_id";
 // echo $query = "SELECT * FROM   ".$db_suffix."chat_message cm left join ".$db_suffix."member m on cm.to_user_id = m.member_id where  cm.to_user_id = '".$member_id."' group by cm.from_user_id";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
// $output = '<table class="table table-bordered table-striped">';
	foreach($result as $row){
		$status = '';
		$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
		$user_last_activity = fetch_user_last_activity($row['member_id'], $connect);
		if($user_last_activity > $current_timestamp){
			$status = '<span class=" active-status " style="color: green;"><i class="fas fa-dot-circle"></i></span></span>';
		} else {
			$status = '<span class=" active-status " style="color: #000;"><i class="fas fa-dot-circle"></i></span></span>';
		}
		
	$output .= '
	<div class="media media-chat"> <img class="avatar" onClick="view_chat();" src="'.SITE_URL.'member/images/'.$row['member_img'].'" alt="...">
            <span > '.count_unseen_message($row['member_id'], $_SESSION['member_id'], $connect).' <button type="button" style="width:auto" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['member_id'].'" data-tousername="'.$row['member_first_name'].'"> '.$row['member_first_name'].' '.$row['member_last_name'].' <br> <span>'.$row['categories_name'].'</span> '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).'</button> '.$status.'</span>
        </div>
	 ';
	}

echo $output;

?>
