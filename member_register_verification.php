<?php
session_start();
// $_SESSION['v_status'] = 2;
if (isset($_SESSION['member_id'])) {
    // session_destroy();
  echo '<script>window.location="'.SITE_URL.'";</script>';
   // header('location:index.php');
}
require_once('config/dbconnect.php');
require_once('phpmailer/SendMail.php');
 $v_code_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';

 $member_v_id = $_SESSION['member_v_id'];

// if (isset($_SESSION['member_id']) && isset($_POST['email_verify'])) {
// 	echo $member_v_id = $_SESSION['member_id'];

// 	$activation_code = mt_rand(100000,999999);
// 	$sql =	"SELECT * FROM `dir_member` WHERE `member_id`= $member_v_id limit 1 ";
// 	$member_results = mysqli_query($db,$sql);
// 	$rowsfound = mysqli_num_rows($member_results);
// 	if ($rowsfound > 0) {
// 		 $row = mysqli_fetch_object($member_results);
// 		  $member_email = $row->member_email;
// 		  $member_first_name = $row->member_first_name;
// 		  $member_email = $row->member_email;
// 		  $u_sql = "update dir_member set  activation_code = '$activation_code', pre_activation_code = '' where member_id = '$member_v_id'";
// 		  $v_verifaction_sent = mysqli_query($db,$u_sql);
// 		  if ($v_verifaction_sent) {
// 		  	//Candidate Notification Start
// 	          $TO_ADDRESS = $member_email;//$_SESSION['candidate_email'];
// 	          $SUBJECT = "Directory Email Verification";
// 	          $BODY ="";
// 	          $BODY .= "Dear ".$member_first_name.","."<br><br>";
// 	          $BODY .= "Thank you for your registration.";
// 	          $BODY .= " Your verification code below:<br><h2>";
// 	          $BODY .= "$activation_code"."</h2><br><br>";
// 	          $BODY .= " Or click the link:<br><P>";
// 	          $BODY .= SITE_URL."member_register_verification/".$activation_code."</P><br><br>";

// 	          $BODY .= "Best regards,"."<br>";
// 	          $BODY .= SITE_NAME."<br>";
// 	          $BODY .= "HRD<br>";
// 	          $BODY .= SITE_URL;

// 	          SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
// 	          unset($TO_ADDRESS,$SUBJECT,$BODY);
// 		  }else{
// 		  	echo"mail not sent";
// 		  }
	 
// 	}
	
// }
 $rowsfound_slug = '';
 if ($v_code_slug !='') {
 	 $chk_slug_sql =	"SELECT * FROM `dir_member` WHERE `activation_code`='$v_code_slug' limit 1 ";
	$chk_slug_results=mysqli_query($db,$chk_slug_sql);
	 $rowsfound_slug = mysqli_num_rows($chk_slug_results);
 }
   
	if($rowsfound_slug != 1 && $v_code_slug !='' ) {
		echo '<script>window.location="'.SITE_URL.'";</script>';
	} 
	else if($v_code_slug =='' && empty($member_v_id) ){
		echo '<script>window.location="'.SITE_URL.'";</script>';
	} 
	else if($rowsfound_slug == 1){
		$member_row = mysqli_fetch_object($chk_slug_results);
		 $categories_id = $member_row->categories_id;
		$member_id = $member_row->member_id;

			$u_sql = "update dir_member set  member_email_verification = 'yes', activation_code = '', pre_activation_code = '$v_code_slug', member_status = '1' where member_id = '$member_id'";
			$v_success = mysqli_query($db,$u_sql);
	    if ($v_success) {
	    	if ($categories_id != 0 ) {
	              $get_ctg_sql = "SELECT  * FROM ".$db_suffix."categories WHERE categories_id = '$categories_id'";
	               // $ctg_get_query = $db->select($get_ctg_sql);
	             $ctg_get_query =  mysqli_query($db,$get_ctg_sql);
	              $get_ctg = mysqli_fetch_object($ctg_get_query);
	                $categories_total_member = $get_ctg->categories_total_member;
	              if ( $categories_total_member != '0' ) {
	               $categories_total_updaet = $categories_total_member + 1 ;
	              }else { 
	                $categories_total_updaet =  1 ; 
	                // echo "string";
	              }
	               $update_ctg_sql = "UPDATE dir_categories SET categories_total_member = ".$categories_total_updaet." WHERE  categories_id = '$categories_id'";
	               mysqli_query($db,$update_ctg_sql);
	              
	            }
	      $_SESSION['v_status']  = 1;
	    }
	}

 if (isset($_POST['v_submit'])){
	 
	 $vcode  =  $_POST['vcode'];
	if (empty($vcode)) {
		$input_error['vcode']='please enter valid code';
	}
    else {
	 $sql =	"SELECT * FROM `dir_member` WHERE `activation_code`='$vcode' limit 1 ";
	$member_results=mysqli_query($db,$sql);
	$rowsfound = mysqli_num_rows($member_results);
	if($rowsfound > 0) {
		$member_row = mysqli_fetch_object($member_results);
		$categories_id = $member_row->categories_id;
		$member_id = $member_row->member_id;
		$country_code = $member_row->country_code;
		
		
		$input_error['vcode']='<div style="margin-top: 10px" class="alert alert-danger" role="alert">done</div>';
		 $u_sql = "update dir_member set  member_email_verification = 'yes', activation_code = 0, pre_activation_code = '$vcode', member_status = '1' where member_id = '$member_id'";
		$v_success = mysqli_query($db,$u_sql);
    	if ($v_success) {
			// $input_error['vcode']='<div style="margin-top: 10px" class="alert alert-danger" role="alert">done</div>';
		$_SESSION['status'] = 1;
    	if ($categories_id != 0 ) {
				$get_ctg_sql = "SELECT  * FROM ".$db_suffix."categories WHERE categories_id = '$categories_id'";
				// $ctg_get_query = $db->select($get_ctg_sql);
				$ctg_get_query =  mysqli_query($db,$get_ctg_sql);
				$get_ctg = mysqli_fetch_object($ctg_get_query);
					$categories_total_member = $get_ctg->categories_total_member;
				if ( $categories_total_member != '0' ) {
				$categories_total_updaet = $categories_total_member + 1 ;
				}else { 
					$categories_total_updaet =  1 ; 
				"string";
				}
				$update_ctg_sql = "UPDATE dir_categories SET categories_total_member = ".$categories_total_updaet." WHERE  categories_id = '$categories_id'";
				mysqli_query($db,$update_ctg_sql);
				
				}
				$_SESSION['status'] = 1;
				echo '<script>window.location="'.ROOT_URL.'profile'.'";</script>';
				// if($country_code == '88'){
				// 	$member_phone = $member_row->member_phone;
				// 	$sms_otp = mt_rand(100000,999999);
				// 	$_SESSION['sms_otp'] = $sms_otp;
				// 	$_SESSION['v_status'] = 2;
				// 	$u_sql = "update dir_member set member_status = '0' where member_id = '$member_id'";
				// 	$v_success = mysqli_query($db,$u_sql);

				// 	$send_message = 'https://smpp.ajuratech.com:7790/sendtext?apikey=84901505c72cd7a0&secretkey=b40d8687&callerID=8801844215566&toUser='.$member_phone.'&messageContent='.$sms_otp.'';
				// 	$ch = curl_init ();
				// 	$timeout = 0; // 100; // set to zero for no timeout	
				// 	curl_setopt ( $ch, CURLOPT_URL, $send_message );
				// 	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
				// 	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
				// 	curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
				// 	if(curl_exec($ch)){
				// 		//echo "Done";
				// 	}
					
				// 	curl_close($ch);	
				// }else{
				// 	$_SESSION['v_status'] = 1;
				// }
		$_SESSION['status'] = 1;
		}
		// echo '<script>window.location="'.ROOT_URL.'/candidate_dashboard.php?id='.$candidate_id.'";</script>';
	}
	else {
		$input_error['vcode']='<div style="margin-top: 10px" class="alert alert-danger" role="alert">Invalid verification code</div>';
	}
   }
 }
if (isset($_POST['sms_submit'])){
	// echo $_SESSION['sms_otp'];
	$otp_code  =  $_POST['otp_code'];
	if (empty($otp_code)) {
		$input_error['otp_code']='please enter valid code';
	}else if($_SESSION['sms_otp'] == $otp_code ){
		$u_sql = "update dir_member set member_status = '1' where member_id = '$member_id'";
		$_SESSION['v_status'] = 1;
	}else {
		$input_error['otp_code']='please enter valid code';
	}
}


require_once('common/header.php');

 ?>

<section  class="candidate_email_verification section-padding">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8">
				<div class="member_v_wrap">
					 <?php
						//  echo $member_v_id;
						// echo $v_code_slug; 
						 $_SESSION['v_status'];
					if ($_SESSION['v_status'] == 1) {
					  echo '<div class="alert alert-success" role="alert">
					      <h4 class="alert-heading">Congratulations!</h4>
					      <p>Youir email address has been verified successfully.!</p>
					      <hr>
					      <p class="mb-2">You can login now</p>
					      <a href="'.SITE_URL.'sign-in" class="btn btn-success">LOGIN</a>
					    </div>';
					    session_destroy();
					    } else if($_SESSION['v_status'] == 2){ ?>
							<div class="alert alert-success" role="alert">
							    	<?php if (isset($_POST['re_v_submit'])){?>
							    		<h4 class="alert-heading">Congratulations!</h4>
								      <p>Your verification code has been send again. Please check the email And verify your email address.</p>   

							    	<?php }else if (isset($_SESSION['resend_otp'])){ ?>
							    		<h4 class="alert-heading">Resend verification code has been sent!</h4>
							    		
							    	<p> Please check your email account and submit your OTP code.</p>
							    	<?php }else{ ?>
							    	
								      <h4 class="alert-heading">Congratulations!</h4>
								      <p>Your Email varifaction succesfully done. We need to verify also your mobile number to complete your registation, We'hv sent an SMS with verification code. Please check the Phone and verify your phone number.</p>
								      <?php }?>
								    
							    </div>
								<form method="POST">
										<?php if ($v_code_slug !=''): ?>
											
											<input type="text" value="<?php echo $v_code_slug ?>" class="form-control" id="uservcode" placeholder="Enter Your code*" name="otp_code">

										<?php else: ?>
											<input type="text" required  value="<?php if (isset($_POST['vcode'])) {echo $_POST['vcode'];} ?>" class="form-control" id="uservcode" placeholder="Enter Your code*" name="otp_code">
										<?php endif ?>
										
					                        <label class="ah-input-error"><?php if (isset($input_error['otp_code'])){echo $input_error['otp_code'];}?></label>

					                     <div class="v-submit-btn">
					                     	<button type="submit" name="sms_submit" class="border-btn">Verify Now</button>
					                     	<a class="border-btn" href="<?php echo SITE_URL ?>member_resend_otp">Resend Verification Code</a>
					                    <!--  	<?php if (isset($member_v_id)): ?>
					                     		<button type="submit" name="re_v_submit" class="border-btn">Resend Verification Code</button>
					                     	<?php endif ?> -->
					                     	
					                     </div>
									</form>
									
						<?php }else {  ?>
							    <div class="alert alert-success" role="alert">
							    	<?php if (isset($_POST['re_v_submit'])){?>
							    		<h4 class="alert-heading">Congratulations!</h4>
								      <p>Your verification code has been send again. Please check the email And verify your email address.</p>   

							    	<?php }else if (isset($_SESSION['resend_otp'])){ ?>
							    		<h4 class="alert-heading">Resend verification code has been sent!</h4>
							    		
							    	<p> Please check your email account and submit your OTP code.</p>
							    	<?php }else{ ?>
							    	
								      <h4 class="alert-heading">Congratulations!</h4>
								      <p>Thanks for your registration. We need to verify your email address to complete your registation, We'hv sent an email with verification code. Please check the email and verify your email address.</p>
								      <?php }?>
								    
							    </div>
									
									<form method="POST">
										<?php if ($v_code_slug !=''): ?>
											
											<input type="text" value="<?php echo $v_code_slug ?>" class="form-control" id="uservcode" placeholder="Enter Your code*" name="vcode">

										<?php else: ?>
											<input type="text" required  value="<?php if (isset($_POST['vcode'])) {echo $_POST['vcode'];} ?>" class="form-control" id="uservcode" placeholder="Enter Your code*" name="vcode">
										<?php endif ?>
										
					                        <label class="ah-input-error"><?php if (isset($input_error['vcode'])){echo $input_error['vcode'];}?></label>

					                     <div class="v-submit-btn">
					                     	<button type="submit" name="v_submit" class="border-btn">Verify Now</button>
					                     	<a class="border-btn" href="<?php echo SITE_URL ?>member_resend_otp">Resend Verification Code</a>
					                    <!--  	<?php if (isset($member_v_id)): ?>
					                     		<button type="submit" name="re_v_submit" class="border-btn">Resend Verification Code</button>
					                     	<?php endif ?> -->
					                     	
					                     </div>
									</form>
					    <?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>


 <?php require_once('common/footer.php'); ?>