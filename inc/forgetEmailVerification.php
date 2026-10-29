<?php
require_once('../function.php');
$db = new database();
$status='success';
if(isset($_POST['forget_email'])){
   if(filter_var($_POST['forget_email'], FILTER_VALIDATE_EMAIL) === false){ //email validation
     $status='error';
   }
   else if(!isEmail($_POST['forget_email'])){
	   $status='error';
   }   
   else{
      $sql = "SELECT * FROM ".$db_suffix."member WHERE member_email ='".$_POST['forget_email']."' limit 1";
      $result = $db->select($sql);
      $row =  $result->num_rows;

      if ($row > 0) {
         // $response = "<span style='color: red;'>Not Available.</span>";
        $status='success';
      }else{
        $status='error3';
      }
   }
   

   echo $status;
   die;
}