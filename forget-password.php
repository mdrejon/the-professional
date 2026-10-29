<?php 
session_start();
// unset($_SESSION["forget_email"]);
// 			session_destroy();
require_once('common/header.php');

			// unset($_SESSION["forget_email"]);
			// session_destroy();
if (isset($_SESSION['member_id'])) {
	// session_destroy();
   header('location:index.php');
}
 require_once("function.php"); 
 $db = new database();
// echo $_SESSION['member_id'];
$password_change = '';
if (isset($_POST['submit'])) {
	 $email = $_POST['email'];
	 if (empty($email)) {
 		$input_error['email'] = "Email address required.";

  }else{
     $forget_sql = "SELECT * FROM ".$db_suffix."member WHERE member_email = '".$email."' limit 1";
		$forget_query = $db->select($forget_sql);
		if (mysqli_num_rows($forget_query) == 1) {
			$row = mysqli_fetch_object($forget_query);

				 // $_SESSION['member_id'] = $row->member_id;

            	 $_SESSION['forget_email'] = $row->member_email;
            	 $_SESSION['member_firstname'] = $row->member_first_name;
            	 $_SESSION['member_lastname'] = $row->member_last_name;
            	 $_SESSION['member_lastname'] = $row->member_last_name;
            	 $reset_code = mt_rand(100000,999999);
            	 $_SESSION['reset_code'] = $reset_code;
            
            require_once('config/dbconnect.php');
            require_once('phpmailer/SendMail.php'); 
			// session_start();
			// unset($_SESSION["forget_email"]);
			// session_destroy();
		  //Candidate Notification Start
          $TO_ADDRESS = $_SESSION['forget_email'];//$_SESSION['candidate_email'];
          $SUBJECT = "Directory Email Verification";
          $BODY ="";
          $BODY .= "Dear ".$_SESSION['member_firstname'].","."<br><br>";
          $BODY .= "Thank you for your registration.";
          $BODY .= " Your verification code below:<br><h2>";
          $BODY .= "$reset_code"."</h2><br><br>";

          $BODY .= "Best regards,"."<br>";
          $BODY .= SITE_NAME."<br>";
          $BODY .= "HRD<br>";
          $BODY .= SITE_URL;

          SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
          unset($TO_ADDRESS,$SUBJECT,$BODY);

            // header('location:member_register_verification.php');
		}else{
			 $input_error['email'] = "The email address you entered does not match.";
		}
    

  }

}
if (isset($_POST['otp_submit'])) {
	$verify_otp = $_POST['otp'];

	if ($verify_otp == $_SESSION['reset_code']) {
		 $_SESSION['verify_otp'] = $verify_otp; 
	}
}
if (isset($_POST['change_submit'])) {
	 $member_password = $_POST['member_password'];
	 $member_c_password = $_POST['member_c_password'];
	    // Password Validation
    if (empty($member_password)) {
      $input_error['member_password']="password requird";
    }
    $passlength =  strlen($member_password);
    if ($passlength < 7) {
      $input_error['member_password']="password at least 7 char";
    }
    if (empty($member_c_password)) {
      $input_error['member_c_password']="Confirm password requird";
    }else {
      if ($member_c_password != $member_password) {
        $input_error['member_c_password']="confirm pass not match";
      }else{
      	// require_once('config/dbconnect.php');
      	// $change_sql = "SELECT * FROM ".$db_suffix."member WHERE member_email = '".$email."' limit 1";
      	$member_password = md5($member_password);
      	 $change_sql = "UPDATE ".$db_suffix."member SET member_password = '$member_password'
      	 WHERE member_email='".$_SESSION["forget_email"]."'";
      	  $db->update($change_sql);
      	  $password_change = 'done';
      	  session_start();
      	  	unset($_SESSION["forget_email"]);
      	  	unset($_SESSION["otp"]);
      	  	unset($_SESSION["reset_code"]);
			session_destroy();
      }
    }
}

?>

<!-- New Header section end -->

<section class="login section-padding" >
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="login-text text-center" style="padding-top: 0px !important">
					<?php //echo $_SESSION['forget_email']; ?>
					<?php //echo $_SESSION['reset_code']; ?>
						<h2>Forget Password ? </h2>
					<h6>Write your Registered Email </h6>

				</div>
			</div>	
			
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-5">
				<?php if ($password_change == 'done'): ?>
					<div class="login-form">
						<div class="alert alert-success" role="alert">
						  your password has been reset you can <a href="<?php echo SITE_URL ?>sign-in">login now</a> !!
						</div>
					</div>
				<?php endif ?>
				<?php if (!isset($_SESSION['forget_email'])): ?>
					<div class="login-form">
					<form action="" method="POST">
						<div class="form-group">
							<label>Email Or Phone</label>
							<input type="text" name="email" value="<?php echo isset($email) ? $email : '' ; ?>" placeholder="Email Address / Mobile No ">
							 <?php if (isset($input_error['email'])){
		                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["email"].'</span>';
		                  } ?>
		                  <span class="forget"><a href="<?php echo SITE_URL ?>member-login"> Log In</a></span>
						</div>	
						<div class="form-group">
							<button type="submit" name="submit" class="boxed-btn bg">Resate Passowd</button>
							<span class="join"> <a href="<?php echo SITE_URL ?>member-registration.php">If you have not registered please join</a></span>
						</div>	
					</form>
					<!-- <div class="top-social-login">
						<span>Continue with:</span>

						<ul>
							<li><a href=""><i class="fab fa-facebook"></i></a></li>
							<li><a href=""><i class="fab fa-google"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
						</ul>
					</div> -->
				</div>
				<?php elseif(isset($_SESSION['forget_email']) && isset($_SESSION['verify_otp'])): ?>
					<div class="login-form">
						<form action="" method="POST">
							<div class="form-group">
								<label style="width: 100% !important; color: #28506F;" >Enter New Password </label>
								<input type="password" name="member_password" value="" placeholder="Enter New Password">
								 <?php if (isset($input_error['member_password'])){
			                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["member_password"].'</span>';
			                  } ?>
							</div>	
							<div class="form-group">
								<label style="width: 100% !important; color: #28506F;" >Confirm New Password </label>
								<input type="password" name="member_c_password" value="" placeholder="Confirm New Password">
								 <?php if (isset($input_error['member_c_password'])){
			                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["member_c_password"].'</span>';
			                  } ?>
			                 
							</div>	
							<div class="form-group">
								<button type="submit" name="change_submit" class="boxed-btn bg">Change New Password</button>
								<span class="join"> <a href="<?php echo SITE_URL ?>member-registration.php">If you have not registered please join</a></span>
							</div>	
						</form>
						<!-- <div class="top-social-login">
							<span>Continue with:</span>

							<ul>
								<li><a href=""><i class="fab fa-facebook"></i></a></li>
								<li><a href=""><i class="fab fa-google"></i></a></li>
								<li><a href=""><i class="fab fa-linkedin"></i></a></li>
								<li><a href=""><i class="fab fa-twitter"></i></a></li>
							</ul>
						</div> -->
					</div>
				<?php elseif(isset($_SESSION['forget_email'])): ?>
					<div class="login-form">
						<form action="" method="POST">
							<div class="form-group">
								<label>OTP</label>
								<input type="text" name="otp" value="" placeholder="Enter OTP">
								 <?php if (isset($input_error['otp'])){
			                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["otp"].'</span>';
			                  } ?>
			                  <span class="forget"><a href="<?php echo SITE_URL ?>member-login"> Log In</a></span>
							</div>	
							<div class="form-group">
								<button type="submit" name="otp_submit" class="boxed-btn bg">Resate Passowd</button>
								<span class="join"> <a href="<?php echo SITE_URL ?>member-registration.php">If you have not registered please join</a></span>
							</div>	
						</form>
						<!-- <div class="top-social-login">
							<span>Continue with:</span>

							<ul>
								<li><a href=""><i class="fab fa-facebook"></i></a></li>
								<li><a href=""><i class="fab fa-google"></i></a></li>
								<li><a href=""><i class="fab fa-linkedin"></i></a></li>
								<li><a href=""><i class="fab fa-twitter"></i></a></li>
							</ul>
						</div> -->
					</div>
				
				<?php endif ?>
				
				
			</div>
		</div>
	</div>
</section>



<?php 
require_once('common/footer.php');
?>