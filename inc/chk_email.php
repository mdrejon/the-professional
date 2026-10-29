<?php
require_once('../function.php');
$db = new database();

if(isset($_POST['email'])){
   if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){ //email validation
              $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }
   else if(!isEmail($_POST['email'])){
	   $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }   
   else{
      $sql = "SELECT * FROM ".$db_suffix."member WHERE member_email ='".$_POST['email']."'  AND  member_email_verification = 'yes' AND member_status = '1' limit 1";
      $result = $db->select($sql);
      $row =  $result->num_rows;

      if ($row > 0) {
         // $response = "<span style='color: red;'>Not Available.</span>";
         $response .= "<span class=' chk-email' style='color: red;'>Email already exists</span>";
         $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
      }else{
         // $response = "<span style='color: green;'>Available.</span>";
         $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
      }
   }
   

   echo $response;
   die;
}
if(isset($_POST['email2'])){
   if(filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL) === false){ //email validation
              $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }
   else if(!isEmail($_POST['email2'])){
      $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }   
   else{
         // $response = "<span style='color: green;'>Available.</span>";
         $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
      }
   

   echo $response;
   die;
}