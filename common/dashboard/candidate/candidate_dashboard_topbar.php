<?php
if (isset($_SESSION['candidate_id']) && !empty($_SESSION['candidate_id'])) {
  $get_id = $_SESSION['candidate_id'];
  $query = mysqli_query($db,"SELECT * FROM ah_candidate WHERE candidate_id ='$get_id' ");
  if (mysqli_num_rows($query) == 1) {
    $candidate = mysqli_fetch_assoc($query);
    $candidate_first_name       = $candidate['candidate_first_name'];
    $candidate_candidate_image  = $candidate['candidate_image'];
  }
}





?>
<header class="main-header header-2 fixed-header">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand logo pad-0" href="index.php">
        <img src="img/logo.jpeg" alt="logo">
      </a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
        <ul class="navbar-nav ml-auto d-lg-none d-xl-none">
          <li class="nav-item dropdown">
            <a href="candidate_dashboard.php" class="nav-link">Dashboard</a>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link" href="candidate_edit_resume.php">Edit Resume</a>
          </li>
          <li><a class="nav-link" href="candidate_resume_view.php">View Resume</a></li>
          <li><a class="nav-link" href="saved_jobs.php">Saved Jobs</a></li>
          <li><a class="nav-link" href="candidate_applied.php">Applied Job</a></li>


          <li class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'candidate_change_password' ? 'active' : null; ?>"><a class="nav-link" href="candidate_change_password.php">Change Password</a></li>



          <li class="nav-item dropdown">
            <a href="candidate_edit_profile.php" class="nav-link">Edit Profile</a>
          </li>
          <li class="nav-item dropdown">
            <a href="candidate_logout.php" class="nav-link">Logout</a>
          </li>
        </ul>
        <div class="navbar-buttons head-right-btn ml-auto d-none d-xl-block d-lg-block">
          <ul>
            <li>
              <div class="dropdown btns ">
                <a class="dropdown-toggle author-drop" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo !empty(trim($candidate_candidate_image)) ? SITE_URL.'/files/'.$candidate_candidate_image : SITE_URL.'/img/man.png' ; ?>">
                  Hi, <?php echo $candidate_first_name;  ?>
                </a>
                <div class="dropdown-menu">

                  <a class="dropdown-item" href="candidate_edit_profile.php">Edit profile</a>
                  <a class="dropdown-item" href="candidate_logout.php">Logout</a>
                </div>
              </div>
            </li>
            <!--
            <li>
              <a href="employer-dashboard-post-job.php" class="btn post-job-btn-dash btn-md"><i class="fas fa-plus"></i> Post a Job</a>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <div style="text-align: center;color:white; background:red;" id="noscriptmsg">
    JavaScript seems to be disabled in your browser. For the best experience on our site, be sure to turn on Javascript.
  </div>
</header>
