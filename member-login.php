<?php 
session_start();
// session_destroy();
$page='login';
if (isset($_SESSION['member_id'])) {
	// session_destroy();
   // header('location:index');
	echo '<script>window.location="'.SITE_URL.'";</script>';
}
 require_once("function.php"); 
 $db = new database();
// echo $_SESSION['member_id'];

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password_pass = $_POST['password'];
	$password = md5($password_pass);
	 if (empty($email)) {
 		$input_error['email'] = "Email address is required.";

  }else{
  	if (empty($password)) {
      $input_error['password'] = "Password must required";
    }else{
     $login_sql = "SELECT * FROM ".$db_suffix."member WHERE member_email = '".$email."' AND member_password = '".$password."' AND member_status = '1' AND member_email_verification = 'yes'";
		$login_query = $db->select($login_sql);
		// echo login_query ;
		if (mysqli_num_rows($login_query) == 1) {
			$row = mysqli_fetch_object($login_query);

			if ($row->member_email_verification == 'yes') {
				 $_SESSION['member_id'] = $row->member_id;
            	 $_SESSION['member_email'] = $row->member_email;
            	 $_SESSION['member_firstname'] = $row->member_first_name;
            	 $_SESSION['member_lastname'] = $row->member_last_name;
            	 $_SESSION['member_lastname'] = $row->member_last_name;
            	 $_SESSION['member_phone'] = $row->member_phone;
            	 $_SESSION['lat'] = $row->member_location_latitude;
            	 $_SESSION['lng'] = $row->member_location_longitude;
            	$sub_query = "INSERT INTO ".$db_suffix."login_details (user_id) VALUES ('".$row->member_id."')";
            	// $sub_query = "INSERT INTO login_details (user_id) VALUES ('".$row['user_id']."')";
						$statement = $connect->prepare($sub_query);
						$statement->execute();
						$_SESSION['login_details_id'] = $connect->lastInsertId();
            	// $db->insert($sub_query);
            	// $_SESSION['login_details_id'] = $db->lastInsertId();
            	// $_SESSION['login_details_id'] = mysqli_insert_id($db);
            	echo '<script>window.location="'.SITE_URL.'";</script>';
            	echo " allah mohan";
				//header('location: profile.php');
			}
			else{
				$input_error['email'] = "The email address and password  you entered does not exist.";
			}
				
			
		}
		elseif(mysqli_num_rows($login_query) != 1 ){
			$login_sql2 = "SELECT * FROM ".$db_suffix."member WHERE member_phone = '".$email."' AND member_password = '".$password."'";
				$login_query2 = $db->select($login_sql2);
				if (mysqli_num_rows($login_query2) == 1) {
					$row2 = mysqli_fetch_object($login_query2);

					if ($row2->member_email_verification == 'yes') {
						 $_SESSION['member_id'] = $row2->member_id;
		            	 $_SESSION['member_email'] = $row2->member_email;
		            	 $_SESSION['member_firstname'] = $row2->member_first_name;
		            	 $_SESSION['member_lastname'] = $row2->member_last_name;
		            	 $_SESSION['member_lastname'] = $row2->member_last_name;
		            	 $_SESSION['member_phone'] = $row2->member_phone;
                   $_SESSION['member_username'] = $row2->member_username;
		            	 $_SESSION['lat'] = $row2->member_location_latitude;
		            	 $_SESSION['lng'] = $row2->member_location_longitude;
		            	$sub_query2 = "INSERT INTO ".$db_suffix."login_details (user_id) VALUES ('".$row->member_id."')";
		            	// $sub_query = "INSERT INTO login_details (user_id) VALUES ('".$row['user_id']."')";
								$statement = $connect->prepare($sub_query2);
								$statement->execute();
								$_SESSION['login_details_id'] = $connect->lastInsertId();
		            	// $db->insert($sub_query);
		            	// $_SESSION['login_details_id'] = $db->lastInsertId();
		            	// $_SESSION['login_details_id'] = mysqli_insert_id($db);
		            	echo '<script>window.location="'.SITE_URL.'";</script>';
						//header('location: profile.php');
					}
				}else{
					$input_error['email'] = "The Username and password  you entered does not exist.";
				}
			}
		else{
			 $input_error['email'] = "The email address and password  you entered does not match.";
		}
    }

  }

}

require_once('common/header.php');

?>
<style type="text/css">
	#show_hide_password .input-group-prepend {
	position: absolute;
	right: 0;
	top: 7px;
	/*height: 75%;*/
	height: 46px;
}
.input-group #member_password {
	margin-bottom: 13px;
}

#some_div span {
  background-color: #0C082D;
  display: inline-block;
  width: 100%;
  padding: 8px;
  color: #fff;
}
.form-group input[type=button], #resend_otp, #having_trouble {
  font-size: 15px;
  background-color: ;
  background: radial-gradient(circle, rgba(43,77,119,1) 0%, rgba(5,30,41,1) 100%);
  outline: none;
  border: none;
  border-radius: 0px;
}
.form-group {
}
.green {
  font-size: 60px;
  color: green;
}
</style>
<!-- New Header section end -->

<section class="login section-padding" id="login_page" >
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="login-text">
						<h2><span>3,0000+ </span> member listed in our directory</h2>
					<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor </h6>

				</div>
			</div>	
			<div class="col-lg-5">
				<div class="login-form">
					<form action="member-login.php" method="POST">
						<div class="form-group">
							<label>Enter your Email/Mobile no</label>
							<input type="text" name="email" id="login_email" value="<?php echo isset($email) ? $email : '' ; ?>" placeholder="Enter your email address / mobile number">
							<div id="login_email_response"></div>
							 <?php if (isset($input_error['email'])){
		                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["email"].'</span>';
		                  } ?>
						</div>	
						 <div class="form-group form-label">
                              <label>Password</label>
							<span class="forget" id="foget_box"  data-toggle="modal" data-target="#exampleModal"><a href="#">Forget Password ?</a></span>
							
                            <div class="input-group box"  id="show_hide_password" >
                                
                                <input type="password" name="password" value="<?php echo isset($password_pass) ? $password_pass : '' ; ?>" id="password" name="password" placeholder="Password">
                                <span class="stay"><input type="checkbox" name="stay"> Stay Signed in</span>
                                <div class="input-group-prepend ">
                                  <div class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></div>
                                </div>
                              
                              </div>
                              <?php if (isset($input_error['password'])){
				                    echo '<span style="color:red;" class="ah-input-error">'.$input_error["password"].'</span>';
				                  } ?>
                            </div>
						<div class="form-group">
							<button type="submit" name="login" class="boxed-btn bg">Sign in</button>
							<span class="join"> <a href="<?php echo SITE_URL ?>create-account">If you have not registered please join</a></span>

						</div>	
					</form>
				<!-- 	<div class="top-social-login">
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
</section>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
 -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
       <div class="panel panel-default" id="show_forget_data">
        
    </div>
      </div>
    </div>
  </div>
</div>

<!-- <script type="text/javascript">
	$( "#forget_password" ).click(function() {
		alert('sdfsdf');
		 var forget_email = get_filter_text('forget_email');	
	  alert(forget_email);
	  
	});
</script> -->
<script type="text/javascript">
$(document).ready(function(){
	 $( "#foget_box" ).click(function() {
	// $("#forget_password").click(function(){
      // var forget_email = $('$forget_email').val().trim();
      var foget_box = 'foget_box';
      // alert(foget_box);
      // alert(login_email);
      if(foget_box != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/forget_validation.php',
            type: 'post',
            data: {foget_box: foget_box},
            success: function(response){
                $('#show_forget_data').html(response);
             }
         });
      }else{
         $("#show_forget_data").html('notget');
      }
    });

});
</script>

<script type="text/javascript">
	
$(document).ready(function(){
	function emailVerification(forget_email){
  		var forget_email = forget_email;
		var res = 0;
		//alert(forget_email);
  		$.ajax({
  			url:"inc/forgetEmailVerification.php",
  			type: "post",
  			data:{forget_email: forget_email},
			dataType: "html",
			async: false,
  			success:function(result){
				
  				if (result.trim() == 'success')
                { 
					res = 1;
				}
				else {
					res = 0;
				}
  			},
			error: function (result) {
				res = 0;
			}
  		});
		return res;
  	}
	 $('body').delegate('#forget_password', 'click', function () {
	 	// resend password timmer
	 	var emailVerified = 0;
        var forget_email = $('#forget_email').val().trim();
      // alert(login_email);
	  if(forget_email != ''){
	   emailVerified = emailVerification(forget_email);
	   //alert(emailVerified);
	  }
      if(emailVerified){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/forget_validation.php',
            type: 'post',
            data: {forget_email: forget_email},
            success: function(response){
                $('#show_forget_data').html(response);
                var timeLeft = 60;
				var elem = document.getElementById('some_div');
				var timerId = setInterval(countdown, 1000);

				function countdown() {
				    if (timeLeft == -1) {
				        clearTimeout(timerId);
				        doSomething();
				    } else {
				        elem.innerHTML = '<span> Resend code after '+timeLeft+' secend</span>';
				        timeLeft--;
				    }
				}

				function doSomething() {
				     elem.innerHTML = ' <input class="btn btn-lg btn-primary btn-block" id="resend_otp" value="Resend confirmation email" type="button">';
				}
             }
         });
      }else{
         $("#forget_email_required").html("Enter your valid email address");
      }
    });

});
</script>
<script type="text/javascript">
	
$(document).ready(function(){

	 $('body').delegate('#having_trouble', 'click', function () {
	 	// resend password timmer
		// resend password timmer
      var having_trouble = 'having_trouble';
      // alert(having_trouble)
      if(having_trouble != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/forget_validation.php',
            type: 'post',
            data: {having_trouble: having_trouble},
            success: function(response){
                $('#show_forget_data').html(response);
                
             }
         });
      }else{
         $("#forget_email_required").html("Email is required");
      }
    });

});
</script>

<script type="text/javascript">
	
$(document).ready(function(){

	 $('body').delegate('#resend_otp', 'click', function () {
	 	// resend password timmer
	 	

		// resend password timmer
	// $("#forget_password").click(function(){
      var forget_email2 = $('#forget_email').val().trim();
      var count_resend = $('#count_resend').val().trim();
      // alert(count_resend)
      // alert(forget_email2);
      var resend_otp = 'resend_otp';
      // alert(login_email);
      if(resend_otp != '' && forget_email2 !=''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/forget_validation.php',
            type: 'post',
            data: {resend_otp: resend_otp, forget_email2: forget_email2, count_resend: count_resend},
            success: function(response){
                $('#show_forget_data').html(response);
               $('#show_forget_data').html(response);
                var timeLeft = 60;
				var elem = document.getElementById('some_div');
				var timerId = setInterval(countdown, 1000);

				function countdown() {
				    if (timeLeft == -1) {
				        clearTimeout(timerId);
				        doSomething();
				    } else {
				        elem.innerHTML = '<span> Resend code after '+timeLeft+'</span>';
				        timeLeft--;
				    }
				}

				function doSomething() {
				     elem.innerHTML = ' <input class="btn btn-lg btn-primary btn-block" id="resend_otp" value="Resend confirmation email" type="button">';
				}
             }
         });
      }else{
         $("#forget_email_required").html("Enter valid verification code");
      }
    });
 
});
</script>

<script type="text/javascript">
	
$(document).ready(function(){

	 $('body').delegate('#confirm_email', 'click', function () {
	 	// resend password timmer
	 	

		// resend password timmer
	// $("#forget_password").click(function(){
      // var forget_email = $('$forget_email').val().trim();
      var get_otp_code = $('#get_otp_code').val().trim();
      // alert(login_email);
      if(get_otp_code != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/forget_validation.php',
            type: 'post',
            data: {get_otp_code: get_otp_code},
            success: function(response){
                $('#show_forget_data').html(response);
               
             }
         });
      }else{
         $("#forget_email_required").html("Enter valid verification code");
      }
    });

});
</script>

<script type="text/javascript">
	
$(document).ready(function(){

	 $('body').delegate('#change_password', 'click', function () {
	 	// resend password timmer
	 	
	 	// alert("hello")
		// resend password timmer
	// $("#forget_password").click(function(){
      // var forget_email = $('$forget_email').val().trim();
      var member_password = $('#member_password').val().trim();
      var member_c_password = $('#member_c_password').val().trim();
      // alert()
      // alert(login_email);
      if(member_password != '' && member_c_password !='' ){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/forget_validation.php',
            type: 'post',
            data: {member_password: member_password, member_c_password: member_c_password},
            success: function(response){
                $('#show_forget_data').html(response);
                
             }
         });
      }else{
         $("#forget_email_required").html("Enter all fields");
      }
    });

});
</script>
<script type="text/javascript">
	
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#login_email").keyup(function(){
      var login_email = $(this).val().trim();
      // alert(login_email);
      if(login_email != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {login_email: login_email},
            success: function(response){
                $('#login_email_response').html(response);
             }
         });
      }else{
         $("#login_email_response").html("");
      }
    });

});
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
        if($('#show_hide_password #password').attr("type") == "text"){
            $('#show_hide_password #password').attr('type', 'password');
            $('#show_hide_password svg').addClass( "fa-eye-slash" );
            $('#show_hide_password svg').removeClass( "fa-eye" );
        }else if($('#show_hide_password #password').attr("type") == "password"){
            $('#show_hide_password #password').attr('type', 'text');
            $('#show_hide_password svg').removeClass( "fa-eye-slash" );
            $('#show_hide_password svg').addClass( "fa-eye" );
        }
    });
});
</script>
<?php 
require_once('common/footer.php');
?>