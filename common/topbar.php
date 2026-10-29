

<div class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-lg-7 col-md-8 col-sm-7 col-6">
        <div class="top-bar-left">
          <ul class="socials-section">
            <li>
              <a class="social-icon" href="#"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li>
              <a class="social-icon" href="#"><i class="fab fa-twitter"></i></a>
            </li>
            <li>
              <a class="social-icon" href="#"><i class="fab fa-linkedin-in"></i></a>
            </li>
            <li>
              <a class="social-icon" href="#"><i class="fab fa-google-plus-g"></i></a>
            </li>
			<!--
            <li class="dropdown currency-select d-xl-inline-block">
              <a href="#" class="" data-toggle="dropdown"><span>Currency <i class="fa fa-caret-down"></i></span></a>
              <div class="dropdown-menu currency-item dropdown-menu-right dropdown-menu-arrow">
                <a href="#" class="dropdown-item"> USD </a>
                <a class="dropdown-item" href="#"> EUR </a>
                <a class="dropdown-item" href="#"> INR </a>
                <a href="#" class="dropdown-item"> GBP </a>
              </div>
            </li> -->
          </ul>
        </div>
      </div>
      <div class="col-xl-6 col-lg-5 col-md-4 col-sm-5 col-6">
        <div class="top-bar-right">
          <ul class="register-section">
<?php
if ($session==0) {
  echo '
  <li>
    <a href="'.SITE_URL.'/candidate_register.php">
      <i class="fa fa-user mr-1"></i>
      <span>Register</span>
    </a>
  </li>
   <li class="dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fas fa-sign-in-alt mr-1"></i><span>Login</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right dashboard-item dropdown-menu-arrow">
        <a href="'.SITE_URL.'/candidate_login.php" class="dropdown-item">
          <i class="dropdown-icon icon icon-user"></i><span>Candidate Login</span>
        </a>
        <a class="dropdown-item" href="'.SITE_URL.'/org_login.php">
          <i class="dropdown-icon icon icon-speech"></i><span>Employer Login</span>
        </a>
      </div>
    </li>';
}
 ?>
<?php
if ($session==1) {
  echo '<li class="">
      <a href="'.SITE_URL.'/candidate_logout.php" data-toggle="">
        <i class="fas fa-sign-in-alt mr-1"></i><span>Logout</span>
      </a>
    </li>
    <li class="dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-home mr-1"></i><span> My Dashboard</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right dashboard-item dropdown-menu-arrow">
        <a href="'.SITE_URL.'/candidate_dashboard.php" class="dropdown-item">
          <i class="dropdown-icon icon icon-user"></i><span> My Profile </span>
        </a>



        <a class="dropdown-item" href="#">
          <i class="dropdown-icon icon icon-power"></i><span> Log out </span>
        </a>
      </div>
    </li>
    ';
}

if ($session==2) {
  echo '<li class="">
      <a href="'.SITE_URL.'/org_logout.php" data-toggle="">
        <i class="fas fa-sign-in-alt mr-1"></i><span>Logout</span>
      </a>
      <li>
        <a href="'.SITE_URL.'/org_dashboard.php" class=""><i class="fab fa-black-tie"></i> <span>Employer Dashboard</span></a>
      </li>


      ';
}
 ?>



          </ul>
        </div>
      </div>
    </div>
  
  </div>

</div>
