<?php 
session_start();
$page = 'contact';
require_once('common/header.php');
// require_once("function.php");

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

<?php
require_once('phpmailer/SendMail.php');
	
	
	
	if (isset($_POST['submit'])){

		    $input_error = array();
		  $name        =  trim($_POST['name']);
		  $email        =  trim($_POST['email']);
		  $subject        =  trim($_POST['subject']);
		  $message        =  trim($_POST['message']);
		  $phone        =  trim($_POST['phone']);
		   $website        =  trim($_POST['website']);


		 //  name validation
	    if (empty($name)) {
	      $input_error['name'] = "Name required";
	    }
	    else if(!preg_match("/^[a-zA-Z ]*$/", $name)){
	      $input_error['name'] = "Name should be alphabet";
	    }else if(strlen($name) > 20){
	      $input_error['name'] = "Name too long";
	    } 
	   //  else if(!isName($_POST['name'])){
	   //   $input_error['name'] = "Name should be alphabet";
	   // }


	    if (empty($message)) {
	      $input_error['message'] = "message required";
	    }
	    if (empty($phone)) {
	      $input_error['phone'] = "Phone number required";
	    }if (preg_match("/[^0-9\_-]/i", $phone)) {
	      $input_error['phone']="Mobile number should be number";
	  }
	   	
	    if (empty($subject)) {
	      $input_error['subject'] = "Subject required";
	    }
	    // if (empty($website)) {
	    //   $input_error['website'] = "Website required";
	    // }
	    
	   
	    if(!isEmail($email)){
	     $input_error['email'] = "Invalid Email Address";
	   } 	

	   if (count($input_error)==0) {
		$TO_ADDRESS = '$name';  
		$SUBJECT = "Contact request from $firstname   ";
		$BODY =
		'
		<p style="font-size:17px;"><b>Dear Administrator,</b><br>
		We received below info via contact us. Plz make review on it.<br>
		Info as below:</p>
		<table style="width: 100%;">
		<col width="90">
		<col width="100%">
		<tr>
		<td><b>NAME:</b> </td>
		<td style="padding-left: 20px;">'.$name.'</td>
		</tr>
		<tr>
		<td><b>EMAIL:</b> </td>
		<td style="padding-left: 20px;">'.$email.'</td>
		</tr>
		<tr>
		<td><b>PHONE:</b> </td>
		<td style="padding-left: 20px;">'.$phone.'</td>
		</tr>
		<tr>
		<td><b>Website:</b> </td>
		<td style="padding-left: 20px;">'.$website.'</td>
		</tr>
		<tr>
		<td><b>SUBJECT:</b> </td>
		<td style="padding-left: 20px;">'.$subject.'</td>
		</tr>
		<tr>
		<td style="vertical-align: baseline;"><b>MESSAGE:</b> </td>
		<td style="padding-left: 20px;">'.$message.'</td>
		</tr>
		</table>';
		
		SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
		
		unset($TO_ADDRESS,$SUBJECT,$BODY);
		
		$TO_ADDRESS = $email;
		$SUBJECT = "Directory";
		$BODY =
		'<p style="font-size:17px;"><b>Dear '.$name.',</b><br>
		Thank you for your inquiry. We will back u as early as possible.<br>
		For your reminder the below info you submitted:<br></p>
		<table style="width: 100%;">
		<col width="90">
		<col width="100%">
		<tr>
		<td><b>NAME:</b> </td>
		<td style="padding-left: 20px;">'.$name.'</td>
		</tr>
		<tr>
		<td><b>EMAIL:</b> </td>
		<td style="padding-left: 20px;">'.$email.'</td>
		</tr>
		<tr>
		<td><b>PHONE:</b> </td>
		<td style="padding-left: 20px;">'.$phone.'</td>
		</tr>
		<tr>
		<td><b>SUBJECT:</b> </td>
		<td style="padding-left: 20px;">'.$subject.'</td>
		</tr>
		<tr>
		<td style="vertical-align: baseline;"><b>MESSAGE:</b> </td>									
		<td style="padding-left: 20px;">'.$message.'</td>
		</tr>
		</table><br><br>';
		$BODY .= "Best regards,"."<br>";
		$BODY .= SITE_NAME."<br>";
		$BODY .= "HRD<br>";
		$BODY .= SITE_URL;
		SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
		unset($TO_ADDRESS,$SUBJECT);
		$success =  "<div class='alert alert-success'> massage has been sent <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a></div>";	
		}	
	}

	



 ?>
 <style type="text/css">
 	.contact-form .form-group label span {
    position: relative;
    top: 0 !important;
    margin-right: 15px;
}

.contact-form .form-group label span b {
    right: 10px;
}


 </style>
<!-- New Header section end -->

<section class="section-padding bredcumb" style="background-image: url('assets/img/bannar-4.jpg');">
	<div class="container">
		
		<div class="row text-center">
			<div class="col-lg-12">
			<?php require_once('common/banner-search.php'); ?>
				<!-- <h4 class="bredcumb-title">Listing</h4> -->
				<p><a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home <span></a><i class="fas fa-arrow-circle-right"></i></span>  <?php echo $content_title; ?> </p>	
			</div>
		</div>
	</div>
</section>

<section class="contact-page section-padding" id="contact_page_section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">   
				<h4><?php echo $content_subtitle ?></h4>

				<div class="contact-address-wrap">
					<span><i class="<?php echo $content_link ?>"></i></span>
					<h6> <?php echo $content_desc; ?></h6>
				</div>
			<!-- 	<div class="contact-address-wrap">
					<span><i class="fas fa-mobile-alt"></i></span>
					<h6>+880-1863-224688 <br>
						+880-1819-842010</h6>
				</div>
				<div class="contact-address-wrap">
					<span><i class="fas fa-envelope"></i></span>
					<h6>info@smartframeworkbd.com</h6>
				</div> -->
			</div>
			<div class="col-lg-6">
				<h4>Contact Us</h4>
				<?php if ($success != ''): ?>
					<?php echo $success; ?>
				<?php endif ?> 
				<form class="contact-form" method="POST" action="#">
					<div class="form-group">
						<span class="icons"><i class="far fa-edit"></i></span>
						<input type="text" name="subject" placeholder="Your Subject ">
						<?php if (isset($input_error['subject'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['subject'].'</label>' ; } ?>
					</div>
					<div class="form-group">
						<input type="text" name="name" id="name" placeholder="Enter your Name*">
						<span class="icons"><i class="far fa-user"></i></span>
						<div id="first_name_response"></div>
						<?php if (isset($input_error['name'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['name'].'</label>' ; } ?>
					</div>
					<div class="form-group">
						<input type="email" name="email" id="email" placeholder="Enter your Email Address*">
						<span class="icons"><i class="far fa-envelope"></i></span>
						<div id="email_response"></div>
						<?php if (isset($input_error['email'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['email'].'</label>' ; } ?>
					</div>
					<div class="form-group">
						<input type="tel" name="phone" id="phone" placeholder="Enter your Phone/Mobile Number*">
						<span class="icons"><i class="fas fa-phone-alt"></i></span>
						<div id="member_phone_response"></div>
						<?php if (isset($input_error['phone'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['phone'].'</label>' ; } ?>
					</div>
					
					<div class="form-group">
						<input type="website" name="website" placeholder="Your Website (If Any)">
						<span class="icons">  <i class="fab fa-wordpress"></i></span>
						<?php if (isset($input_error['website'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['website'].'</label>' ; } ?>
					</div>
					<div class="form-group">
						<label><span class="icons"> <i class="fas fa-pen-square"></i></span> Type your message<b>*</b></label>
						<!-- <label><b>*</b> Type your message</label> -->
						<textarea name="message"></textarea>
						<?php if (isset($input_error['message'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['message'].'</label>' ; } ?>
					</div>
					<div class="form-group responsive-center">
						<button type="submit" name="submit" class="boxed-btn bg">Submit</button>
					</div>
				</form>
			</div>
		</div>

		
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="maps">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29523.813929943022!2d91.79471703955078!3d22.3356208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd89be03db74b%3A0xa37fbed7e29c4312!2sSmart%20Framework!5e0!3m2!1sen!2sbd!4v1608353664616!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				</div>
			</div>
		</div>
	</div>

</section>
<script type="text/javascript">
$(document).ready(function(){	
   $("#name").keyup(function(){
      var member_first_name = $(this).val().trim();
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
    $("#phone").keyup(function(){
      var member_phone = $(this).val().trim();
      // alert(member_phone);
      if(member_phone != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {member_phone: member_phone},
            success: function(response){
                $('#member_phone_response').html(response);
             }
         });
      }else{
         $("#member_phone_response").html("");
      }
    });


   });
</script>

<?php 
require_once('common/footer.php');
    
?>