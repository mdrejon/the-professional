<?php session_start(); ?>
<style type="text/css">
	
	#show_hide_password {
  position: relative;
}
#show_hide_password .input-group-prepend {
  position: absolute;
  top: 39px;
  padding: ;
  right: 0;
  height: 44px;
}
  
#password-strength-status, #password-c-strength-status {
  font-size: 12px;
  padding: 5px;
}
#password-strength-status.medium-password {
  color: #B7D60A;
}
.strong-password {
  color: #12CC1A;
}
.weak-password {
  color: #CE1D14
}
#member_password_response span {
  top: 12px !important;
  right:  !important;
}
#member_c_password_response {
	position: absolute;
	right: 5px;
	top: 93px;
}

#member_password_response {
  top: 15px !important;
  position: absolute;
  right: 0;
}
</style>
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
 $old_password = $_POST['old_password'];
 $new_password = $_POST['new_password'];
 $new_c_password = $_POST['new_c_password'];
	if (empty($old_password)) {
		$input_error['old_password']="Old password requird";
	}
	if (empty($new_password)) {
		$input_error['new_password']="New password requird";
	}
	
	if (isset($new_password) && isset($new_c_password)) {
		if ($new_password != $new_c_password ) {
			$input_error['new_c_password']="Confirm password doesn't match";
		}
	}
   if(StrongPassword($new_password) != true){
       $input_error['member_password']="password should be alpha, numeric and one letter must be in capital letter.";
    }
    if (empty($new_c_password)) {
		$input_error['new_c_password']="Confirm new password requird";
	}else {
      if ($new_password !== $new_c_password) {
        $input_error['member_c_password']="Confirm Password doesn't matches.";
      }
    }

	  // $passlength =  strlen($new_password);
   //  if ($passlength < 7) {
   //    $input_error['new_password']="New password at least 7 char";
   //  }
// count($input_error);
if (count($input_error) == 0) {
	if (isset($old_password )) {
		 $old_password;
		 $old_password = md5($old_password);
		 $password_sql = "SELECT * FROM ".$db_suffix."member WHERE  member_id = '".$memmber_id."' AND member_email_verification = 'yes' limit 1";
		$password_query = $db->select($password_sql);
		$row = mysqli_fetch_object($password_query);
		if ($row->member_password == $old_password ) {
				$new_password = md5($new_password);
		      $change_sql = "UPDATE ".$db_suffix."member SET member_password = '$new_password'
		      	 WHERE member_id='".$memmber_id."'";
		      	 $db->update($change_sql);
		      	 $sucsess = '<div class="alert alert-success" role="alert">
					      <h4 class="alert-heading">Well done!</h4>
					      <p>You successfully Change your Password!</p>
					     
					    </div>';
		}else{
			$sucsess = '<div class="alert alert-danger" role="alert">
					      <h4 class="alert-heading">Worng!</h4>
					      <p>Your old password not match!</p>
					     
					    </div>';
		}
	}
}
	
//  <hr>
// <p class="mb-2">You can Login Now</p>
// <a href="'.SITE_URL.'sign-in" class="btn btn-success">LOGIN</a>
}

?>
<?php if (!empty($member_cover_photo)): ?>
	<section class="profile-cover" style="background-image: url('<?php echo SITE_URL ?>member/images/<?php echo $member_cover_photo ?>');">
	
</section>
<?php else: ?>
	<section class="profile-cover" style="background-image: url('assets/img/cover-pic.jpg');">
	
</section>
<?php endif ?>



<section class="profile">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				
				<div class="profile-details">
					<div class="section-title text-center">
						<h4>Change Your Password</h4>
					</div>
					<?php if ($sucsess !=""): ?>
						<?php echo $sucsess; ?>
					<?php endif ?>
					<div class="member-list job-section">
						
						<div class="login-form">
					<form action="" method="POST">
						<div class="form-group" id="show_hide_password"> 
							<label>Old Password</label>
							<input required type="password" name="old_password" value="" placeholder="Enter your old password *">
							 <?php if (isset($input_error['old_password'])){
		                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["old_password"].'</span>';
		                  } ?>
		                  <div class="input-group-prepend ">
                                <div class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></div>
                            </div>
						</div>	
						<div class="form-group" id="show_hide_password">
							<label>New Password</label>
							<input required type="password" name="new_password" onKeyUp="checkPasswordStrength();" id="new_password" value="" placeholder="Enter a new password *">
							 <?php if (isset($input_error['new_password'])){
		                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["new_password"].'</span>';
		                  } ?>
		                   <div class="input-group-prepend ">
                                <div class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></div>
                            </div>
                            <div id="password-strength-status"></div>
                            <div id="member_password_response"></div>
						</div>
						<div class="form-group" id="show_hide_password">
							<label>New Confirm Password</label>
							<input required type="password" name="new_c_password" onKeyUp="checkPasswordStrength2();" id="new_c_password" value="" placeholder="Enter new confirm password *">
							 <?php if (isset($input_error['new_c_password'])){
		                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["new_c_password"].'</span>';
		                  } ?>
		                   <div class="input-group-prepend ">
                                <div class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></div>
                            </div>
                            <div id="member_c_password_response"></div>
                            <div id="password-c-strength-status"></div>
                            
						</div>	
						<div class="form-group">
							<button type="submit" name="submit" class="boxed-btn bg">Change Password</button>
							<a href="<?php echo SITE_URL ?>profile "class="boxed-btn bg" style="width: 100%; text-align: center;" >Back To Profile</a>
							
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
					
				
					</div>
				</div>
				
			</div>
			
		</div>
	</div>
</section>

<script type="text/javascript">
  function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var upalphabets = /([A-Z])/;
            // var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
    //         if ($('#member_password').val().length < 8) {
    //             $('#password-strength-status').removeClass();
    //             $('#password-strength-status').addClass('weak-password');
    //             $('#password-strength-status').html("Weak (should be atleast 8 characters.)");
				// $('#member_password_response').html("");
    //         } 
            if (!$('#new_password').val().match(upalphabets)) {
              $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Weak (should be at least one capital letter.)");
                $('#member_password_response').html("");
            }
            else {
                if ($('#new_password').val().match(number) && $('#new_password').val().match(alphabets)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Strong");
					$('#member_password_response').html("<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>");
					
					
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html("Medium (should include alphabets and numbers)");
					$('#member_password_response').html("");
                }
            }
      
        }
      
      
  function checkPasswordStrength2() {   
      
      if ($('#new_c_password').val() !=$('#new_password').val()) {
                  $('#password-c-strength-status').removeClass();
                  $('#password-c-strength-status').addClass('weak-password');
                  $('#password-c-strength-status').html("Password Mismatch.");
				  $('#member_c_password_response').html("");
              }
      else 
      {
         $('#password-c-strength-status').removeClass();
                      $('#password-c-strength-status').addClass('strong-password');
                      $('#password-c-strength-status').html("Password Matches.");
					  $('#member_c_password_response').html("<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>"); 
      }     
          
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    // $(".box").on("focusin", function(){
    //   $(this).parent().find("label").addClass("active");
    // });
    // $(".box").on("focusout", function(){
    //   if (!this.value) {
    //   $(this).parent().find("label").removeClass("active");
    //   }
    // });
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password .input-group-prepend svg').addClass( "fa-eye-slash" );
            $('#show_hide_password .input-group-prepend svg').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password .input-group-prepend svg').removeClass( "fa-eye-slash" );
            $('#show_hide_password .input-group-prepend svg').addClass( "fa-eye" );
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


