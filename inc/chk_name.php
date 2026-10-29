<?php
require_once('../function.php');
$db = new database();
if(isset($_POST['member_first_name'])){
  if(!isName($_POST['member_first_name'])){
	   $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }   
   else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
   }
   echo $response;
   die;
}
if(isset($_POST['member_last_name'])){
  if(!isName($_POST['member_last_name'])){
	   $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }   
   else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
   }
   

   echo $response;
   die;
}