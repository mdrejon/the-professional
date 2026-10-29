<?php
session_start();
if (isset($_SESSION['member_id'])) {
    // session_destroy();
  echo '<script>window.location="'.SITE_URL.'";</script>';
   // header('location:index.php');
}
require_once('function.php'); 
require_once('config/dbconnect.php');
require_once('phpmailer/SendMail.php');
 $v_code_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';

// if (empty($member_v_id)) {

//   // header('location:index.php');
// 	echo '<script>window.location="'.SITE_URL.'";</script>';
// }

 
 if (isset($_POST['otp_submit'])){
	 $email  =  $_POST['email'];
	 if (empty($email)) {
      $input_error['email']='<div style="margin-top: 5px 20px" class="alert alert-danger" role="alert">Email address is required</div>';
    }else if(!isEmail($email)){
	     $input_error['email']='<div style="margin-top: 5px 20px" class="alert alert-danger" role="alert">Invalid Email address</div>';
	   } 
    else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ //email validation
             $input_error['email']='<div style="margin-top: 5px 20px" class="alert alert-danger" role="alert">Invalid Email address</div>';
        } 
        else {
             $sql =	"SELECT * FROM `dir_member` WHERE `member_email`='$email' and `member_email_verification`  != 'yes' limit 1 ";
				$member_results=mysqli_query($db,$sql);
				$rowsfound = mysqli_num_rows($member_results);
				if($rowsfound > 0) {

					$member_row = mysqli_fetch_object($member_results);
					$categories_id = $member_row->categories_id;
					 $activation_code = $member_row->activation_code;
					 $activation_code = $member_row->activation_code;
					 $_SESSION['member_v_id'] = $member_row->member_id;
					 $_SESSION['resend_otp'] = 'done';
					 $member_first_name = $member_row->member_first_name;
					//echo '<script>window.location="'.ROOT_URL.'/candidate_dashboard.php?id='.$candidate_id.'";</script>';
					$TO_ADDRESS = $email;//$_SESSION['candidate_email'];
			          $SUBJECT = "Directory Email Verification";
			          $BODY ="";
			          $BODY .= "Dear ".$member_first_name.","."<br><br>";
			          $BODY .= "Thank you for your registration.";
			          $BODY .= " Your verification code below:<br><h2>";
			          $BODY .= "$activation_code"."</h2><br><br>";
			          $BODY .= " Or click the link:<br><P>";
			          $BODY .= SITE_URL."member_register_verification/".$activation_code."</P><br><br>";

			          $BODY .= "Best regards,"."<br>";
			          $BODY .= SITE_NAME."<br>";
			          $BODY .= "HRD<br>";
			          $BODY .= SITE_URL;

			          SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
			          unset($TO_ADDRESS,$SUBJECT,$BODY);
			          echo '<script>window.location="'.SITE_URL.'member_register_verification";</script>';
				}
				else {
					$input_error['email']='<div style="margin-top: 5px 20px" class="alert alert-danger" role="alert">Email address already verified or not exist</div>';
				}
        }
    }
     
	// if (empty($email)) {
	// 	$input_error['email']='please enter valid Email address';
	// }
    
 }


require_once('common/header.php');

 ?>

<section  class="candidate_email_verification section-padding">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8">
				<div class="member_v_wrap">
					 <div class="alert alert-success" role="alert">
				    	
					      <h4 class="alert-heading text-center">Resend Verification Code</h4>
					      <p>Please enter your email address and submit for generate OTP.</p>
					      <?php if ($input_error['email'] != ''): ?>
					      	<label class="ah-input-error"><?php if (isset($input_error['email'])){echo $input_error['email'];}?></label>
					      <?php endif ?>
					    
					    
				    </div>
						
						<form method="POST">
								<input type="email" value="<?php echo $email ?>" class="form-control" id="email" placeholder="Enter Your Email*" name="email">
		                        

		                     <div class="v-submit-btn">
		                     	<button type="submit" name="otp_submit" class="border-btn">Resend OTP</button>
		                     	
		                     </div>
						</form>
				</div>
			</div>
		</div>
	</div>
</section>


 <?php require_once('common/footer.php'); ?>