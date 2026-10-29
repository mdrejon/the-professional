<?php
require_once('../function.php');
$db = new database();


if(isset($_POST['username'])){
   $sql = "SELECT * FROM ".$db_suffix."member WHERE member_username ='".$_POST['username']."' AND  member_email_verification = 'yes' limit 1";
   $result = $db->select($sql);
   $row =  $result->num_rows;

   if ($row > 0) {
      // $response = "<span style='color: red;'>Not Available.</span>";
      $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }else{
      // $response = "<span style='color: green;'>Available.</span>";
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
   }

   echo $response;
   die;
}