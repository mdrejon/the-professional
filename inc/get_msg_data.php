<?php 
require_once('../function.php');
$db = new database();
if (isset($_POST['get_msg_data'])) {
	 $sql = "SELECT * FROM ".$db_suffix."chat_message WHERE to_user_id ='".$_POST['get_msg_data']."'  AND  status = '1'";
	$result = $db->select($sql);
      $row =  $result->num_rows;
      if ($row > 0) {
      	echo "active";
      }
}


 ?>