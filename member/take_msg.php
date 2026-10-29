<?php
session_start();
include('../function.php');
 $db = new database();

$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $_SESSION['member_id']
);
$from_user_id = $_SESSION['member_id'];
$to_user_id = $_POST['to_user_id'];
///
// update notifications < - 
$query2 = "UPDATE ".$db_suffix."chat_message SET status = '0' WHERE from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."' AND status = '1'";
	$statement2 = $connect->prepare($query2);
	$statement2->execute();
 "<br>";

// messages 
 $query = "SELECT * FROM ".$db_suffix."chat_message WHERE from_user_id = :from_user_id AND to_user_id = :to_user_id OR from_user_id = :to_user_id AND to_user_id = :from_user_id ORDER BY timestamp asc";


$statement = $connect->prepare($query);
$statement->execute($data);
$result = $statement->fetchAll();

 $member_sql = "SELECT * FROM ".$db_suffix."member WHERE member_id = '".$_SESSION['member_id']."'";
$member_query = $db->select($member_sql);
$member_data  = mysqli_fetch_object($member_query);
 $member_img = $member_data->member_img;
 if ($member_img == '') {
		if ($member_data->member_gender == 'male') {
			$member_img = 'male-avata.png';
		}elseif ($member_data->member_gender == 'female'){
			$member_img = 'female-avata.png';
		}
	}


  $user_sql = "SELECT * FROM ".$db_suffix."member WHERE member_id = '".$to_user_id."'";
$user_query = $db->select($user_sql);
$user_data  = mysqli_fetch_object($user_query);
 $user_image = $user_data->member_img;

	
// $result = $statement->fetchAll();

$output = '<ul class="list-unstyled cht-histry">';
	foreach($result as $row){
		$user_name = '';
		$chat_date = strtotime($row['timestamp']);
$chat_date = date('d F, Y h:i a', $chat_date);
	if($row["from_user_id"] == $from_user_id) {
		// $user_name = '<b class="text-success">You</b>';
		$user_name = '<div class="media media-chat user_chat"  style="color: #000;"> <img class="avatar" src="'.SITE_URL.'member/images/'.$member_img .'" alt="...">
				';
	} else {
		// $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
		$user_name = '<div class="media media-chat media-chat-reverse style="color: #000 !important;" "><img class="avatar" src="'.SITE_URL.'member/images/'.$user_image .'" alt="...">
                            ';
	}
$output .= '
  '.$user_name.'
   <div class="media-body ">
        <p>'.$row["chat_message"].'</p>
        <p class="meta">'.$chat_date.'</p>
    </div>
</div>
  ';
}
	// $output .= '</ul>';
	echo $output;
?>
