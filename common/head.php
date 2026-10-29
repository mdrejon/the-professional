<?php
session_start();
if (isset($_SESSION['employer_id'])) {
      $session=2;
   }elseif (isset($_SESSION['candidate_id'])) {
     $session=1;
   }else{
     $session=0;
   }
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Academic Hub</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="<?php echo SITE_URL;?>/img/logo.jpeg">
  <!-- Place favicon.ico in the root directory -->

  <!-- Bootstrap Css file -->
  <link rel="stylesheet" href="<?php echo SITE_URL;?>/css/bootstrap.min.css">
  <!-- Fontawsome Css -->
  <link rel="stylesheet" href="<?php echo SITE_URL;?>/css/all.min.css">
  <!-- Nav Css -->
  <link rel="stylesheet" href="<?php echo SITE_URL;?>/css/stellarnav.css">

   <!-- Owl Carousel Css -->
  <link rel="stylesheet" href="<?php echo SITE_URL;?>/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo SITE_URL;?>/css/owl.theme.default.min.css">

  <!-- Custome Css -->
  <link rel="stylesheet" href="<?php echo SITE_URL;?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo SITE_URL;?>/hdadmin/assets/plugins/select2/select2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo SITE_URL;?>/css/main.css">
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyBLqyqBMRgUe1VQg4ZozSH8ZzM7V39orrg&libraries=places&language=en"></script>
  <meta name="theme-color" content="#fafafa">
</head>
