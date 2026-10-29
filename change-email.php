<?php
session_start();
$member_id = $_SESSION['member_id'];
$member_email = $_SESSION['member_email']; 
$member_firstname = $_SESSION['member_firstname']; 
$member_lastname = $_SESSION['member_lastname'];  
$member_phone = $_SESSION['member_phone'];

if (!isset($member_id)) {

	header('location:sign-in');
}else{

require_once('config/dbconnect.php');
require_once('common/header.php');
require_once('member/change-email.php'); 
 

?>


<?php require_once('common/footer.php'); } ?>

   