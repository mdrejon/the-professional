<?php
session_start();
$_SESSION['org_login'];
$_SESSION['org_logo'];
$_SESSION['company_name'];
$session_emp_id = $_SESSION['employer_id'];
$org_logo=$_SESSION['org_logo'];
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
            <a href="dashboard.php" class="nav-link">Dashboard</a>
          </li>

          <li class="nav-item dropdown">
            <a href="org_add_post.php" class="nav-link">Create Job Post</a>
          </li>
          <li class="nav-item dropdown">
            <a href="org_approve_jobs.php" class="nav-link">Manage Jobs</a>
          </li>
          <li class="nav-item dropdown">
            <a href="org_pending_jobs.php" class="nav-link">Pending Jobs</a>
          </li>
          <li class="nav-item dropdown">
            <a href="org_bookmark.php" class="nav-link">Bookmarks</a>
          </li>



          <li class="nav-item dropdown">
            <a href="https://academichub.hostdivine.com/org_edit_profile.php" class="nav-link">Edit Profile</a>
          </li>
		  <li class="nav-item dropdown">
            <a href="org_change_password.php" class="nav-link">Change Password</a>
          </li>
          <li class="nav-item dropdown">
            <a href="org_logout.php" class="nav-link">Logout</a>
          </li>
        </ul>
        <div class="navbar-buttons head-right-btn ml-auto d-none d-xl-block d-lg-block">
          <ul>
            <li>
              <div class="dropdown btns ">
                <a class="dropdown-toggle author-drop" data-toggle="dropdown" aria-expanded="false">
                  <img src="files/<?php echo $org_logo;?>" alt="avatar">
                  <?php echo $_SESSION['company_name']; ?>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="org_dashboard.php">Dashboard</a>
                  <a class="dropdown-item" href="org_edit_profile.php">Edit profile</a>
				  <a class="dropdown-item" href="org_change_password.php">Change Password</a>
                  <a class="dropdown-item" href="org_logout.php">Logout</a>
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
