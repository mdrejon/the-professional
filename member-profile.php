<?php 
error_reporting(1);
session_start();
require_once('common/header.php');


 $member_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';
$member_query = "select * from ".$db_suffix."member where member_username='$member_slug'";
$member_sql = $db->select($member_query);
$row = mysqli_fetch_object($member_sql);
$member_id = $row->member_id;
$country_id = $row->country_id;
$region_id = $row->region_id;
$categories_id = $row->categories_id;
$city_id = $row->city_id;
 $member_query_sql = "select * from ".$db_suffix."member m left join countries c on m.country_id = c.country_id left join states r on m.region_id = r.states_id left join cities ci on m.city_id = ci.city_id left join ".$db_suffix."categories ca on m.categories_id = ca.categories_id where m.member_username='$member_slug'";
 // $member_sql = "SELECT * FROM ".$db_suffix."member m left join countries c on m.country_id = c.country_id left join states r on m.region_id = r.states_id left join ".$db_suffix."categories ca on m.categories_id = ca.categories_id WHERE member_id = '".$member_id."' AND member_email = '".$member_email."'";
$member_query_query = $db->select($member_query_sql);
$result = mysqli_fetch_object($member_query_query);

$member_first_name = $result->member_first_name;
$member_last_name = $result->member_last_name;
$member_email = $result->member_email;
$member_username = $result->member_username;
$member_phone = trim($result->member_phone);
// $member_country_code = trim($result->country_code);

if (isset($member_id)) {
		 $location_sql = "SELECT * FROM ".$db_suffix."member where member_id = '".$member_id."'";
	$location_query = $db->select($location_sql);
	$location = mysqli_fetch_object($location_query); 
	$member_country_code = trim($location->country_code);
	}
            
$tel_text = '';
$tel_text_link = '';        				
 
if($member_country_code!=""){
	$tel_text .= $member_country_code;
}   
if($member_phone!=""){
	$tel_text .= ' '.$member_phone;
	$tel_text_link = '<a href="tel:'.$tel_text.'">+ '.$tel_text.'</a>';
}

$member_birth_date = $result->member_birth_date;
$member_professional = $result->member_professional;
$member_contact_email = $result->member_contact_email;
$member_contact_phone = $result->member_contact_phone;
$member_gender = $result->member_gender;
$member_region = $result->states_name;
$member_document_verification_status = $result->member_document_verification_status;

$country_name = $result->country_name;
$coma = "";
$city_text = trim($result->city_name);
$region_text = trim($result->states_name);
$country_text = trim($result->country_name);
$location_text_update ='';
if(trim($city_text)!=""){
$location_text_update .= $city_text;
$coma = ", ";
}
if($region_text!="" && $region_text !=$city_text){
  $location_text_update .= $coma.$region_text;
   $coma = ", ";
}
if($country_text!=""){
 $location_text_update .= $coma.'<a href="#">'.$country_text.'</a>.';
}

$member_address = $result->member_address;
$member_cover_photo = $result->member_cover_photo;
// $member_img = $result->member_img;

$member_experience_year = $result->member_experience_year;
$member_expertise_fild = $result->member_expertise_fild;
$member_desc = $result->member_desc;

$categories_id = $result->categories_id;
$categories_name = $result->categories_name;
$member_professional = $categories_name;
if($categories_id==0){
	$member_professional = $result->member_others_professional;
}



$expertise_lists = explode("|",$result->expertise_list) ;
$member_joining_date = strtotime($result->member_joining_date);
$member_joining_date = date('d F, Y', $member_joining_date);
   
// $member_birth_date = date("Y-m-d", strtotime($result->member_birth_date));
// $member_birth_date = date_diff(date_create($member_birth_date), date_create('today'))->y; 
$member_img = $row->member_img; 
		if ($member_img == '') {
			if ($row->member_gender == 'male') {
				$member_img = 'male-avata.png';
			}elseif ($row->member_gender == 'female'){
				$member_img = 'female-avata.png';
			}
		}
// $member_joining_date = $result->member_joining_date;

?>
<script>
$(document).ready(function(){ 
    var maxLength = 200;
    $(".show-read-more").each(function(){
        var myStr = $(this).text(); //alert(myStr);
        if($.trim(myStr).length > maxLength){
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append('<a href="javascript:void(0);" class="read-more">read more...</a>');
			//alert(removedStr);
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function(){
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });
});
</script> 
<style>
    .show-read-more .more-text{
        display: none;
    }
    .padding-0 a {
	padding: 0 !important;
}
</style>   
<!-- New Header section end -->

<section class="profile-cover" style="background-image: url('<?echo SITE_URL ?>assets/img/cover-pic.jpg');">
	
</section>
<section class="profile">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="profile-details">
					<div class="row">
						<div class="col-lg-3">
							<div class="profile-img">
								<img src="<?php echo SITE_URL ?>member/images/<?php echo  $member_img; ?>">
							</div>
							<div class="profile-info">
								<ul>
									<?php
										$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
										$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
										$user_last_activity = fetch_user_last_activity($member_id, $connect);
										if($user_last_activity > $current_timestamp){
											// receiver is online
											// $user_status = 2;
											?>
											<li class="online"><span><i class="fas fa-circle"></i></span> I'm Online</li>
											<?php
										} else {
											// receiver is ofline
											// $user_status = 0;
										}

									 ?>
									<!-- <li class="online"><span><i class="fas fa-circle"></i></span> I'm Online</li> -->
									<?php 
									 
								   ?>
									
									
									<li class="country"><span> </span> <?php echo $location_text_update ?></li>
									<li class=""><span> </span>Joined: <?php echo $member_joining_date ?></li>
									<li class="gender"><span> </span><?php echo $member_gender ?>, Age: <?php echo $member_birth_date ?></li>
									<!-- <li class="age"><span> </span>Age: </li> -->
									<?php  if (isset($_SESSION['member_id'])): ?>
										<?php if ($member_contact_email == 1): ?>
											<li class=""><span> </span>Email: 
											<a class="show-hide1"  onclick="return false"   href="#">Click To View</a>
												<span class="hide1 ">
													<?php echo $member_email ?>
												</span> 
											</li>
										<?php endif ?>
										<?php if ($member_contact_phone == 1): 
										if($tel_text_link!=""){
										?>
											<li class="padding-0" ><span> </span>Phone: 
												<a class="show-hide2"  onclick="return false"   href="#">Click To View</a>
												<span class="hide2 ">
													<?php 
														echo $tel_text_link;
													?>
												</span>
											</li>
										<?php 
										}
										endif ?>
									<?php else: ?>
										<li class=""><span> </span>Email:  <a  target="_blank" href="<?php echo SITE_URL ?>member-login.php">Click To View</a></li>
										<li class=""><span> </span>Phone: <a   target="_blank" href="<?php echo SITE_URL ?>member-login.php">Click To View</a>
											
										</li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="profile-title">
								<h4><?php echo $member_first_name ?>  <?php echo $member_last_name ?></h4>
								<?php //echo $categories_id ?>
								<?php if ($member_professional != ""): ?>
									<h6>Profession : <?php echo $member_professional  ?> </h6>
								<?php endif ?>
								

							</div>
							<div class="single-side-profile new">
								<h5>Expertise <!-- <a href="" class="edit-btn relative"><i class="fas fa-plus"></i></a> --></h5>
								
								<p>
									<?php if (empty($row->expertise_list)) : ?>
										No Expertise Added here
									<?php else: ?>
										<?php foreach ($expertise_lists as $expertise_list): ?>
											<span><?php echo $expertise_list ?></span>
										<?php endforeach ?>
									<?php endif; ?>


								</p>
							</div>
							<div class="single-side-profile new">
								<h5>Year Of Experience  <!-- <a href="#popup-content" class="edit-btn"> <i class="fas fa-plus"></i></a> --></h5>
								<div class="side-profile-desc">
									<?php if (!empty($member_experience_year)): ?>
										<p><?php echo $member_experience_year ?> Years</p>
									<?php else: ?>
										<p>No Experience </p>
									<?php endif; ?>
								</div>
							</div>
							<div class="single-side-profile new">
								<h5>Field of Experiences <!-- <a href="#experiences" class="edit-btn popup-inline edit-popup"> <i class="fas fa-plus"></i></a> --></h5>
								<div class="side-profile-desc">
									<p><?php echo $member_expertise_fild ?></p>
								</div>

							</div>
						
							<?php 
							$education_query = "select * from ".$db_suffix."education e left join ".$db_suffix."degree d on e.education_degree = d.degree_title where e.member_id='$member_id' order by d.degree_order desc";
							$education_sql = $db->select($education_query);
							if ($education_sql->num_rows > 0) { 
							?>
							<div class="single-side-profile new">
								<h5>Educational Background <!-- <a href="#education" class="edit-btn popup-inline edit-popup"><i class="fas fa-plus"></i></a> --></h5>
									
									<div class="side-profile-desc">
										<ul>
											<?php 
											while ($row = mysqli_fetch_object($education_sql)): 
											 ?>

											<li>
												<h6><?php echo $row->education_title; ?></h6>

												<span class="university"><?php echo $row->education_org ?></span>
												<span class="p-year">Passing year <?php echo $row->education_pass_year ?></span>


											</li>
										<?php endwhile; ?>
										</ul>
									</div>

							</div>
							
							<?php } ?>
							<div class="profile-desc">
								<div class="show-read-more"><?php echo trim($member_desc); ?></div>
							</div>
						</div> 

					</div>
					<!-- <a href="" class="edit-btn"> <i class="fas fa-plus"></i> Edit Profile</a> -->
				</div>
			</div>
			<div class="col-lg-3">
				<div class="single-side-profile border-radius">
					<h4>Verifications</h4>

					<ul> 
					<?php  if ($member_document_verification_status == '1'): ?>
					   	<li class=""><span class="icon "><i class="fas fa-user"></i></span> Document Verified  <span class="right">
							<!-- <a href="#">Verify </a> -->      
							<i class="fas fa-check"></i> 
						</span></li>
					   <?php else: ?>   
					   		<li class="not-verify" ><span class="icon "><i class="fas fa-user"></i></span> Document Verified  <span class="right">
							<!-- <a href="#">Verify </a> -->      
							<i class="fas fa-check"></i> 
						</span></li>
					   <?php endif ?>   
						
					
						<li><span class="icon"><i class="fas fa-envelope"></i></span>   Email Verified    <span class="right"><i class="fas fa-check"></i></span></li>
						<li class="chat-with">
							<?php if (isset($_SESSION['member_id'])): ?>
								<?php if ($member_id != $_SESSION['member_id']): ?>
									<button type="button"  class="start_chat" data-touserid="<?php echo $member_id ?>" data-tousername="<?php echo $member_first_name ?>"><span class="icon"><i class="far fa-comment-alt"></i></span> <span class="border-text">Chat</span></button>
								<?php endif ?>
								<!-- <button><span class="icon"><i class="far fa-comment-dots"></i></span> <span class="border-text">Messages</span></button> -->
								
							<?php else: ?>
								<button type="button" class="start_chat not-logged" onclick="window.location.href='<?php echo SITE_URL ?>member-login.php';" ><span class="not-logged-trip">Please login to chat or call</span><span class="icon"><i class="far fa-comment-alt"></i></span> <span class="border-text">Chat</span></button>
							<?php endif; ?>
							
						
						</li>
						<li class="chat-with">
							<?php  if (isset($_SESSION['member_id'])): ?>
								<?php if ($member_id != $_SESSION['member_id']): ?>
									<input class="roomNumber" hidden="" type="text" value="<?php echo $_SESSION['member_id']."-".$member_id ?>" />
       									<input class="userid" hidden="" type="text" value="<?php echo $member_id ?>" />
									<button type="button" id="goRoom_id" class="go-to-room goRoom_id2"><span class="icon"><i class="fas fa-phone-volume"></i></span> <span class="border-text">Call</span></button>
									<div id="call_response"></div>
										
								<?php endif ?>
								<!-- <button><span class="icon"><i class="far fa-comment-dots"></i></span> <span class="border-text">Messages</span></button> -->
								
							<?php else: ?>
								<button type="button" class="go-to-room not-logged" onclick="window.location.href='<?php echo SITE_URL ?>member-login.php';" ><span class="not-logged-trip">Please login to chat or call</span><span class="icon"><i class="fas fa-phone-volume"></i></span> <span class="border-text">Call</span></button>
							<?php endif; ?>
							
						
						</li>
					</ul>
				</div>
				
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(".show-hide2").click(function(){ 
		$(".show-hide2").hide();
		$(".hide2").addClass('active');
	});
	$(".show-hide1").click(function(){ 
		$(".show-hide1").hide();
		$(".hide1").addClass('active');
	});
</script>
<!-- <script type="text/javascript">
	$(document).ready(function () {
		// alert('allah mohan');
	  $("#goRoom_id").click(function(){
	   	  alert('allah mohan');

	      var userid = $('#userid').val().trim();
	      var roomNumber = $('#roomNumber').val().trim();
	      var send = '1';
	      // alert(userid);

	      // alert('email')

      if(userid != '' && roomNumber !='' && send =='1'){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/send_call.php',
            type: 'post',
            data: {userid: userid, roomNumber: roomNumber, send: send},
            success: function(response){
                // $('#call_response').html(response);
                // alert(response);
                if (response == 1) {
                	// alert('calling')
            	  	// roomNumber = roomNumber.value
    				//  roomNumber = inputRoomNumber.value
    				// 	next();
    				// 	function next() {
				    //     socket.emit('create or join', roomNumber);
				    // }
                }
                else if(response == 0 ){
                	alert('user not active')
                }
             }

         });

      }else{

         $("#email_response").html("");

      }

    });
});
</script> -->

<?php 
require_once('common/footer.php');
?>
