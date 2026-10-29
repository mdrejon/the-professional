<?php session_start(); ?>
<?php
require_once('function.php'); 

	$member_sql = "SELECT * FROM ".$db_suffix."member m left join ".$db_suffix."country c on m.country_id = c.country_id left join ".$db_suffix."regions r on m.region_id = r.regions_id left join ".$db_suffix."categories ca on m.categories_id = ca.categories_id WHERE member_id = '".$member_id."' AND member_email = '".$member_email."'";
	$member_query = $db->select($member_sql);
	$member = mysqli_fetch_object($member_query);
	$memmber_id = $member->member_id;
	$memmber_email = $member->member_email;
	$member_username = $member->member_username;
	$member_first_name = $member->member_first_name;
	$member_last_name = $member->member_last_name;
	$member_cover_photo = $member->member_cover_photo;
	$sucsess = "";


 ?>
<?php
if (isset($_POST['submit'])) {
  $change_email = $_POST['change_email'];
  $memmber_email = $_POST['change_email'];
 	 $_SESSION['change_email'] = $change_email;
	if (empty($change_email)) {
		$input_error['change_email']="Email address requird";
	}
	if(!isEmail($change_email)){
     $input_error['change_email'] = "Invalid Email Address";
   }   
// count($input_error);
if (count($input_error) == 0) {
	if (isset($change_email )) {
		 $email_sql = "SELECT * FROM ".$db_suffix."member WHERE member_id = '".$memmber_id."' AND member_email_verification = 'yes' limit 1";
		$email_query = $db->select($email_sql);
		$row = mysqli_fetch_object($email_query);
		if ($row->member_email == $change_email ) {
			$sucsess = '<div class="alert alert-danger" role="alert">
					      <h4 class="alert-heading">Worng!</h4>
					      <p>This is your old Email!</p>
					     
					    </div>';
		}else{
			
			 $change_email_sql = "SELECT * FROM ".$db_suffix."member WHERE member_email = '".$change_email."' AND member_email_verification = 'yes' AND member_status = '1' ";
			$change_email_query = $db->select($change_email_sql);

            if ($change_email_query->num_rows > 0) {
              $sucsess = '<div class="alert alert-danger" role="alert">
					      <h4 class="alert-heading">Worng!</h4>
					      <p>This email address already have in our directory</p>
					     
					    </div>';
                
            }else{
            	// session_start(); 
            require_once('phpmailer/SendMail.php');
            	$activation_code = mt_rand(100000,999999);
				  $re_vu_sql = "UPDATE ".$db_suffix."member SET activation_code = '".$activation_code."' WHERE  member_id = '$memmber_id'";

					// $re_vu_query =  mysqli_query($db,$re_vu_sql);
					$re_vu_query = $db->update($re_vu_sql);
					$email_reset = "SELECT * FROM ".$db_suffix."member WHERE member_id = '$memmber_id'";
						$email_reset_query = $db->select($email_reset);
					  	$re_v_row = mysqli_fetch_object($email_reset_query);
					    $member_old_email = $re_v_row->member_email;
					     $member_activation_code = $re_v_row->activation_code;
					      $_SESSION['member_activation_code'] = $member_activation_code;
							  	 //Candidate Notification Start
		        $TO_ADDRESS = $change_email;//$_SESSION['candidate_email'];
		          $SUBJECT = "Directory Email Verification";
		          $BODY ="";
		          $BODY .= "Dear ".$member_first_name.","."<br><br>";
		          $BODY .= "We Have received a reqest to change your email address, 
please confirm your new email address with the following
verification code.";
		          $BODY .= " Your verification code below:<br><h2>";
		          $BODY .= "$activation_code"."</h2><br><br>";

		          $BODY .= "Best regards,"."<br>";
		          $BODY .= SITE_NAME."<br>";
		          $BODY .= "HRD<br>";
		          $BODY .= SITE_URL;

		          SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
		          unset($TO_ADDRESS,$SUBJECT,$BODY);

		            $sucsess = '<div class="alert alert-danger" role="alert">
							      <p>An email send in your new email address, </p>
							     
							    </div>';
            }
	      	 
		}
	}
}
}

if (isset($_POST['submit2'])) {
	 $chk_code = $_POST['chk_code'];
	 $_SESSION['member_activation_code'];
	if ($_SESSION['member_activation_code'] == $chk_code) {
		$re_vu_sql = "UPDATE ".$db_suffix."member SET member_email = '".$_SESSION['change_email']."' WHERE  member_id = '$memmber_id'";

					// $re_vu_query =  mysqli_query($db,$re_vu_sql);
					$re_vu_query = $db->update($re_vu_sql);
					$email_reset = "SELECT * FROM ".$db_suffix."member WHERE member_id = '$memmber_id'";
		session_start();
	unset($_SESSION["member_id"]);
	session_destroy();
	$sucsess = '<div class="alert alert-danger" role="alert">
							      <p>Your Email successfully change</p>
							     
							    </div>';
	// header('localhost/directory-final/sign-in');
	echo '<script>window.location="'.SITE_URL.'sign-in";</script>';
	}
	else{
		$sucsess = '<div class="alert alert-danger" role="alert">
							      <p>Worng OTP</p>
							     
							    </div>';
	}

}
if (isset($_POST['back_profile'])) {
	session_start();
	unset($_SESSION["member_activation_code"]);
	unset($_SESSION['change_email'] );
	echo '<script>window.location="'.SITE_URL.'profile";</script>';


}

?>
<?php if (!empty($member_cover_photo)): ?>
	<section class="profile-cover" style="background-image: url('<?php echo SITE_URL ?>member/images/<?php echo $member_cover_photo ?>');">
	
</section>
<?php else: ?>
	<section class="profile-cover" style="background-image: url('assets/img/cover-pic.jpg');">
	
</section>
<?php endif ?>

<style type="text/css">
	
#change_email .user-chk {
  top: 0;
}
#change_email {
  position: relative;
}
.form-group .user-chk {
  position: absolute;
  top: 50px !important;
}
</style>

<section class="profile">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				
				<div class="profile-details">
					<div class="section-title text-center">
						<h4>Change Your Email Address</h4>
					</div>
					<?php if ($sucsess !=""): ?>
						<?php echo $sucsess; ?>
					<?php endif ?>
					<div class="member-list job-section">
						
					<div class="login-form">
						<?php if (isset($_SESSION['member_activation_code'])): ?>
							<form action="" method="POST">
								<div class="form-group">
									<label>Email verification code</label>
									<input type="text" required name="chk_code" value="" placeholder="Enter the code">
									 <?php if (isset($input_error['change_email'])){
				                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["change_email"].'</span>';
				                  } ?>
								</div>	
								<div class="form-group">
									<button type="submit" name="submit2" class="boxed-btn bg">Confirm OTP</button>
									</form>
									<form action="" method="POST">
									<button type="submit" name="back_profile" class="boxed-btn bg">Back To Profile</button>
									
								</div>	
							</form>
						<?php else: ?>

					<form action="" method="POST">
						<div class="form-group">
							<label>Type Your New Email</label>
							<input type="email" required name="change_email" id="change_email" value="<?php echo $memmber_email ?>" placeholder="Enter your old password">
							 <?php if (isset($input_error['change_email'])){
		                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["change_email"].'</span>';
		                  } ?>
		                  <div id="email_response"></div>
						</div>	
						<div class="form-group">
							<button type="submit" name="submit" class="boxed-btn bg">Update Email</button>
							</form>
									<form action="" method="POST">
									<button type="submit" name="back_profile" class="boxed-btn bg">Back To Profile</button>
							
							
						</div>	
					</form>
				<?php endif; ?>
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
					
				
					</div>
				</div>
				
			</div>
			
		</div>
	</div>
</section>


<script type="text/javascript">
	$(document).ready(function(){
		$("#change_email").keyup(function(){
	      var email = $(this).val().trim();
	      // alert('email')
	      if(email != ''){
	         $.ajax({
	            url: '<?php echo SITE_URL ?>inc/chk_email.php',
	            type: 'post',
	            data: {email: email},
	            success: function(response){
	                $('#email_response').html(response);
	             }
	         });
	      }else{
	         $("#email_response").html("");
	      }
	    });
	  });
</script>
<!-- <script type="text/javascript">
	$(document).ready(function(){
		readEducation();
	});
  	function readEducation(){
  		var readrecord = 'readrecord';
  		$.ajax({
  			url:"member/ajax_education.php",
  			type: "post",
  			data:{readrecord: readrecord},
  			success:function(data,status){
  				$('#show-content').html(data);
  			}
  		})
  	}
  	$('#add_job_form').on('submit', function(){
  		
  		function addEducation(){
  	
  			var submit_job = $("#submit_job").val();
  			var job_type = $("#job_type").val();
  			var job_title = $("#job_title").val();
  			var job_company = $("#job_company").val();
  			var categories = $("#categories").val();
  			var country = $("#country").val();
  			var regions = $("#regions").val();
  			var city = $("#city").val();
  			var salary = $("#salary").val();
  			var vacanciess = $("#vacanciess").val();
  			var deadline = $("#deadline").val();
  			var job_image = $("#job_image").val();
  			var job_desc = $("#job_desc").val();
	  		alert(submit_job);
	  		$.ajax({
	  			url:"<?php echo SITE_URL ?>member/ajax_member_job.php",
	  			type:"post",
	  			data: {
	  				degree: degree,
	  				ecourse_title: ecourse_title,
	  				university: university,
	  				p_year: p_year,
	  				member_id: member_id

	  			},
	  			success:function(data,status){
	  				readEducation()
	  			}
	  		});

  	}



  	});
  	
  </script> -->


