<?php
session_start();
require_once('config/dbconnect.php');
unset($_SESSION["member_id"]);
session_destroy();
// header('location:https://hostdivine.com/clients/directory-admin/');
echo '<script>window.location="'.SITE_URL.'";</script>';
 ?>
