<?php 
session_start();
$page="write_feed";
require_once('common/header.php');

	$content_query = "SELECT * FROM ".$db_suffix."content WHERE content_id='7'";
	
	$content_sql = $db->select($content_query);
	$result = mysqli_fetch_object($content_sql) ;
	$content_id = $result->content_id;
	$content_title = $result->content_title;
	$content_subtitle = $result->content_subtitle;
	$content_desc = $result->content_desc;
	$content_link = $result->content_link;
	$content_meta_title = $result->content_meta_title;
	$content_meta_desc = $result->content_meta_desc;
	$content_meta_keyword = $result->content_meta_keyword;
	$content_img = SITE_URL.'data/images/content/'.$result->content_img;

?>
<style>
/*
       *  Pure CSS star rating that works without reversing order
       *  of inputs
       *  -------------------------------------------------------
       *  NOTE: For the styling to work, there needs to be a radio
       *        input selected by default. There also needs to be a
       *        radio input before the first star, regardless of
       *        whether you offer a 'no rating' or 0 stars option
       *
       *  This codepen uses FontAwesome icons
       */
.w-100{
  width: 100%;
}
       .rating-group {
     display: inline-flex;
   }

   /* make hover effect work properly in IE */
   .rating__icon {
     pointer-events: none;
   }

   /* hide radio inputs */
   .rating__input {
    position: absolute !important;
    left: -9999px !important;
   }

   /* hide 'none' input from screenreaders */
   .rating__input--none {
     display: none
   }

   /* set icon padding and size */
   .rating__label {
     cursor: pointer;
     padding: 0 0.1em;
     font-size: 2rem;
   }

   /* set default star color */
   .rating__icon--star {
     color: orange;
   }

   /* if any input is checked, make its following siblings grey */
   .rating__input:checked ~ .rating__label .rating__icon--star {
     color: #ddd;
   }

   /* make all stars orange on rating group hover */
   .rating-group:hover .rating__label .rating__icon--star {
     color: orange;
   }

   /* make hovered input's following siblings grey on hover */
   .rating__input:hover ~ .rating__label .rating__icon--star {
     color: #ddd;
   }

.write-feedback-section .form-group label span {
    position: relative;
    top: 0 !important;
    margin-right: 15px;
}

.write-feedback-section .form-group label span b {
    right: 10px;
}
label.rating__label label {
    font-size: 11px !important;
}

.rating-group label {
    font-size: 18px;
    margin: 0;
    padding: 0 !important;
}

.rating-group {
    background-color: #fff;
    padding: 10px;
    border: 1px solid #ddd;
    width: 100%;
}
</style>
<?php
require_once('phpmailer/SendMail.php');

$full_name = '';
$email_address = '';
$phone_number = '';
$company_name = '';
$rating = '';
$message = '';

$err = 0;
$messages = array(
		 'full_name' => array('status' => 'validate_error', 'msg' => ''),
		 'email_address' => array('status' => 'validate_error', 'msg' => ''),
		 'phone_number' => array('status' => 'validate_error', 'msg' => ''),
		 'rating' => array('status' => 'validate_error', 'msg' => ''),
		 'message' => array('status' => 'validate_error', 'msg' => '')
		);
$msg = array("status" => "","msg" => "");	

if(isset($_POST['submit']))
{
	extract($_POST);
	$full_name = trim($full_name);
	$email_address = trim($email_address);
	$phone_number = trim($phone_number);
	$rating = trim($rating3);
    $message = trim($message);
	$company_name = trim($company_name);
	
	$details = "Submited Information:"."\n";
	
	if(trim($full_name)!="")
		$details .="Name: ".$full_name."\n";
	
	if(trim($email_address)!="")
		$details .="Email Address: ".$email_address."\n";
	
	if(trim($phone_number)!="")
		$details .="Phone/Mobile No.: ".$phone_number."\n";
	
	if(trim($company_name)!="")
		$details .="Company: ".$company_name."\n";

	if(trim($message)!="")
	{
		$details .="Message: "."\n";
		$details .=$message."\n\n";
	}
	
	if($full_name == "")
	{
		$messages["full_name"]["msg"] = '<div class="invalid-feedback">Your name is required.</div>';
		$err++;
	}		
	else if(!isName($full_name))
	{
		$messages["full_name"]["msg"] = '<div class="invalid-feedback">Enter a valid name.</div>';
		$err++;
	}
	
	if($email_address == "")
	{
		$messages["email_address"]["msg"] = '<div class="invalid-feedback">Email address is required.</div>';
		$err++;
	}
	else if(!isEmail($email_address))
	{
		$messages["email_address"]["msg"] ='<div class="invalid-feedback">Enter a valid email address.</div>';
		$err++;
	}
	
	if($message == "")
	{
		$messages["message"]["msg"] = '<div class="invalid-feedback">Message is required.</div>';
		$err++;
	}
	
	// Phone Validation
    if (!empty($phone_number)) {
		if (preg_match("/[^0-9\_-]/i", $phone_number)) {
			echo $messages["phone_number"]["msg"] ='<div class="invalid-feedback">Enter a valid phone number.</div>';
			$err++;
		}
	}
	
   
	if($err == 0)
	{
		
		$insert_sql = "INSERT INTO dir_testimonial (testimonial_name, testimonial_email, testimonial_phone, testimonial_company_name, testimonial_rating, testimonial_message, testimonial_status) VALUES (
		'$full_name','$email_address','$phone_number','$company_name','$rating3','$message','1')";
				   
		// $run_query = mysqli_query($db,$insert_sql);
		$run_query = $db->insert($insert_sql);	
		//$max_id=mysqli_insert_id($db);
		if($run_query)
		{
			$msg['msg'] = '<div class="alert alert-success">Thank you, Your reviews has been send successfully.<button class="close"></button></div>';
			$msg['status']=1;

			$company_name = SITE_NAME;

			$em_sql= "SELECT * FROM dir_email_setting WHERE email_type= 'REGISTRATION' and email_status='1' limit 1";
			$run_em_sql = mysqli_query($db,$em_sql);
			$check = mysqli_num_rows($run_em_sql);
			if($check >0)
			{
				$em_row = mysqli_fetch_assoc($run_em_sql);
				$email_subject= $em_row['email_subject'];
				$email_body = $em_row['email_body'];
			}
			else {
				$email_subject = "Thanks for submitting your review";
				$email_body = '
				Dear FULL_NAME<br>
				Thanks for your feedback.<br>
				<p>As a reminder, please find details of your submited below:</p>

				FORM_DATA
				
				Stay connected with us.<br>
				Best Regards,<br>
				Member Directory';
			}

			$email_body = str_replace("FULL_NAME",$full_name,$email_body);
			$email_body = str_replace("FORM_DATA",$details,$email_body);

			$TO_ADDRESS = $email_address;
			$BCC = "jabed.sf@gmail.com";
			$SUBJECT = $email_subject;
			$BODY ="";
			$BODY .= $email_body;
			
			SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY,'',$BCC);
			unset($TO_ADDRESS,$SUBJECT,$BODY);
			
			//Admin Email start
			$TO_ADDRESS = "elias.jabed@gmail.com";
			$BCC = "jabed.sf@gmail.com";
			$SUBJECT = "New Review Received";
			$BODY ="";
			$BODY .= "Dear Administrator, <br />
			Name: ".$full_name." has been send review. <br />
			
			<p>As a reminder, please find details of your submited below:</p>

				FORM_DATA
				
			<br />
			Have a look on this.<br />
			
			<br />
			Thank you.
			";
			$BODY = str_replace("FORM_DATA",$details,$BODY);

			SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY,'',$BCC);
			unset($TO_ADDRESS,$SUBJECT,$BODY);
			//Admin Email End

			$full_name = '';
			$email_address = '';
			$phone_number = '';
			$company_name = '';
			$rating = '';
			$message = '';
		}
		else
		{
			$msg['msg'] = '<div class="alert alert-warning">
									<b>Oh snap!</b> Change a few things up and try submitting again. Error..
							<button class="close"></button>

						</div>';
			$msg['status'] = 'error';

		}
	}
	else
	{
		$msg['msg'] = '<div class="alert alert-warning">

									<b>Oh snap!</b> Change a few things up and try submitting again. 

									<button class="close"></button>

								</div>';
		$msg['status'] = 'error';

	}

	}
?>
<style type="text/css">

.contact-form .form-group label {
  padding: ;
  padding-bottom: 10px;
  font-weight: 700;
  color: #264950;
}
.contact-form .form-group label b {
  padding-right: 10px;
  color: red;
}
</style>
<section class="write-feedback-section contact-page section-padding">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="section-title">
					<h5>Please tell us about your experience with our platform. </h5>
					
					<?php 
					if($msg['status']==1){
						echo $msg['msg'];
					}
					?>
					
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<form class="contact-form" method="POST" action="">
					
					<div class="form-group">
					<?php 
					$is_invalid = "";
					if(trim($messages["full_name"]["msg"])!=""){
						$is_invalid = " is-invalid";
					}
					?>
						<input required type="text" class="form-control<?php echo $is_invalid;?> " name="full_name" id="full_name" placeholder="Enter your Name*" 
						<?php 
						if(!empty($full_name)){ 
						?>
							value="<?php echo $full_name;?>"
						<?php }
						?>>
						<span class="icons"><i class="far fa-user"></i></span>
						<div id="first_name_response"></div>
						
						<?php  echo $messages["full_name"]["msg"];?>
						
					</div>
					<div class="form-group">
					<?php 
					$is_invalid = "";
					if(trim($messages["email_address"]["msg"])!=""){
						$is_invalid = " is-invalid";
					}
					?>
						<input required type="email" class="form-control<?php echo $is_invalid;?>" name="email_address" id="email" placeholder="Enter your Email Address*"
						<?php 
						if(!empty($email_address)){ 
						?>
							value="<?php echo $email_address;?>"
						<?php }
						?>>
						<span class="icons"><i class="far fa-envelope"></i></span>
						<div id="email_response"></div>
						
						<?php  echo $messages["email_address"]["msg"];?>
						
						
					</div>
					<div class="form-group">
					<?php 
					$is_invalid = "";
					if(trim($messages["phone_number"]["msg"])!=""){
						$is_invalid = " is-invalid";
					}
					?>
						<input type="tel" class="form-control<?php echo $is_invalid;?>" name="phone_number" id="phone" placeholder="Enter your Phone/Mobile Number"
						<?php 
						if(!empty($phone_number)){ 
						?>
							value="<?php echo $phone_number;?>"
						<?php }
						?>>
						<span class="icons"><i class="fas fa-phone-alt"></i></span>
						
						<?php  echo $messages["phone_number"]["msg"];?>
					</div>
					<div class="form-group">
						<input type="text" name="company_name" placeholder="Designation, Company Name" 
						<?php 
						if(!empty($company_name)){ 
						?>
							value="<?php echo $company_name;?>"
						<?php }
						?>> 
						<span class="icons"> <i class="fas fa-award"></i></span>
						
					</div>
					<div class="form-group">
						<label><span class="icons"> <i class="far fa-star"></i></span> Ratings<b>*</b></label>
					<div id="full-stars-example-two">
						<div class="rating-group">
							 <label aria-label="1 star" class="rating__label" for="rating3-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
								<input required class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
								<label aria-label="2 stars" class="rating__label" for="rating3-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
								<input required class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
								<label aria-label="3 stars" class="rating__label" for="rating3-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
								<input required class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
								<label aria-label="4 stars" class="rating__label" for="rating3-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
								<input required class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">
								<label aria-label="5 stars" class="rating__label" for="rating3-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
								<input required checked class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">
						</div>
				  </div>
				<style>.switch{position:relative;display:inline-block;width:50px;height:23px}.switch input{opacity:0;width:0;height:0}.slider{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:#ccc;-webkit-transition:.4s;transition:.4s}.slider:before{position:absolute;content:"";height:15px;width:15px;left:4px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s}input:checked+.slider{background-color:#2196f3}input:focus+.slider{box-shadow:0 0 1px #2196f3}input:checked+.slider:before{-webkit-transform:translateX(26px);-ms-transform:translateX(26px);transform:translateX(26px)}.slider.round{border-radius:34px}.slider.round:before{border-radius:50%}</style>
											
					</div>						
					
					<div class="form-group">
					<?php 
					$is_invalid = "";
					if(trim($messages["message"]["msg"])!=""){
						$is_invalid = " is-invalid";
					}
					?>
						<label><span class="icons"> <i class="fas fa-pen-square"></i></span> Write Review<b>*</b></label>
						<textarea required class="form-control<?php echo $is_invalid;?>" name="message" placeholder="Write your review to help others to learn about our platform"><?php echo $message;?></textarea>
						
						<?php  echo $messages["message"]["msg"];?>
						
					</div>
					<div class="form-group responsive-center">
						<button type="submit" name="submit" class="boxed-btn bg">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
$(document).ready(function(){	
   $("#full_name").keyup(function(){
      var member_first_name = $(this).val().trim();
	 // alert(member_first_name);
      if(member_first_name != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_name.php',
            type: 'post',
            data: {member_first_name: member_first_name},
            success: function(response){
                $('#first_name_response').html(response);
             }
         });
      }else{
         $("#first_name_response").html("");
      }
    });
   $("#email").keyup(function(){
      var email2 = $(this).val().trim();
      // alert('email')
      if(email2 != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_email.php',
            type: 'post',
            data: {email2: email2},
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

<?php 
require_once('common/footer.php');
    
?>