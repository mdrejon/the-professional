<?php
session_start();
require_once('common/header.php'); 
$member_id = $_SESSION['member_id'];
$member_email = $_SESSION['member_email']; 
$member_firstname = $_SESSION['member_firstname']; 
$member_lastname = $_SESSION['member_lastname'];  
$member_phone = $_SESSION['member_phone'];

if (!isset($member_id)) {

	 echo '<script>window.location="'.SITE_URL.'sign-in#login_page";</script>';
}else{



require_once('member/profile.php'); 

?>


<?php require_once('common/footer.php'); } ?>

   