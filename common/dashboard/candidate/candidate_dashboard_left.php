<div class="col-md-3 col-paddng">
  <div class="dashboard-nav d-none d-md-block d-xl-block d-lg-block" style="min-height: 654px;">
    <div class="dashboard-inner">
      <h4>Main</h4>
      <ul>
        <li class="<?php echo  basename($_SERVER['REQUEST_URI'], '.php') == 'candidate_dashboard' ? 'active' : null; ?>"><a href="candidate_dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
        <!-- <li class="<?php //echo basename($_SERVER['REQUEST_URI'], '.php') == 'candidate_edit_resume' ? 'active' : null; ?>" ><a href="candidate_add_resume.php"><i class="far fa-file"></i>Edit Resume</a></li> -->
        <li><a href="../index.php"><i class="far fa-heart"></i>All Jobs</a></li>
        <li><a href="bookmark.php"><i class="far fa-heart"></i>Bookmark</a></li>
        <li><a href="candidate_edit_resume.php"><i class="far fa-heart"></i>Edit Resume</a></li>
        <li><a href="candidate_resume_view.php"><i class="far fa-heart"></i>View Resume</a></li>
        <li><a href="saved_jobs.php"><i class="far fa-heart"></i>Saved Jobs</a></li>
        <li><a href="candidate_applied.php"><i class="far fa-file"></i>Applied Job</a></li>

        <li><a href="candidate_membership.php"><i class="far fa-envelope"></i>Membership</a></li>
        <li class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'candidate_change_password' ? 'active' : null; ?>"><a href="candidate_change_password.php"><i class="fas fa-lock"></i>Change Password</a></li>
      </ul>
      <h4>Account</h4>
      <ul>
        <li class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'candidate_edit_profile' ? 'active' : null; ?>" ><a href="candidate_edit_profile.php"><i class="fas fa-user-edit"></i>Edit Profile</a></li>
        <li><a href="candidate_logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
      </ul>
    </div>
  </div>
</div>
