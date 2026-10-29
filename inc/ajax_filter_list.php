<?php 
session_start();
require_once('../function.php');
$db = new database();
 $member_lat = $_SESSION['lat']; 
 $member_lng = $_SESSION['lng'];
 // $member_lng = $_SESSION['member_id'];

// echo "allah Mohan";
// echo $_SESSION['member_id'];
// if (isset($_SESSION['member_id'])) {
// 	echo "allh Mohan";
// }

if (isset($_POST['action'])) {
	if (isset($_SESSION['member_id'])) {
		$sql_distance = $having = ''; 
					  	  $radius_km = 50; 
						   $sql_distance = " ,(((acos(sin((".$member_lat."*pi()/180)) * sin((`member_location_latitude`*pi()/180))+cos((".$member_lat."*pi()/180)) * cos((`member_location_latitude`*pi()/180)) * cos(((".$member_lng."-`member_location_longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
						     
						    $having = " HAVING (distance <= $radius_km) "; 
						     
						    // $order_by = ' distance ASC '; 
		 $query = "SELECT *".$sql_distance." FROM ".$db_suffix."member  WHERE  categories_id !='' AND member_email_verification = 'yes' "; 
	}else{
		$query =  "SELECT * FROM ".$db_suffix."member WHERE  categories_id !='' AND member_email_verification = 'yes' ";
	}
	// $query =  "SELECT * FROM ".$db_suffix."member WHERE  categories_id !='' AND member_email_verification = 'yes' ";
	
	if (isset($_POST['categories'])) {
		 $categories = implode("','", $_POST['categories']);
		$query .="AND categories_id IN('".$categories."') ";
		//echo $query;
	}if (isset($_POST['country'])) {
		 $country = implode("','", $_POST['country']);
		$query .="AND country_id IN('".$country."') ";
		
	}
	
	if (isset($_POST['verified']) && isset($_POST['unverified'])) {
		$query .="AND member_verification_status IN('0','1') ";
	}
	elseif (isset($_POST['verified'])) {
		  $verified = implode("','", $_POST['verified']);
		$query .="AND  member_document_verification_status = '1' ";
		
	}elseif (isset($_POST['unverified'])) {
		 $unverified = implode("','", $_POST['unverified']);
		$query .="AND member_document_verification_status = '0' ";
		
	}

	if (isset($_SESSION['member_id'])) {
		 $order_by = ' distance ASC '; 
		$query .=" $having ORDER BY $order_by";
	}
	 $query;
	  // echo "<div class='d-none'>".$query;."<div>";
	$result = $db->select($query);
	$output = "";
	if ($result->num_rows > 0) {
		while ( $row = mysqli_fetch_object($result)) {
			
			
			 $sql = "SELECT * FROM ".$db_suffix."member m left join ".$db_suffix."categories ca on  m.categories_id = ca.categories_id WHERE member_id ='".$row->member_id."'" ;
			$member_query = $db->select($sql);
			$member = mysqli_fetch_object($member_query);
			$member_img = $member->member_img;
				if ($member_img == '') {
					if ($member->member_gender == 'male') {
						$member_img = 'male-avata.png';
					}elseif ($member->member_gender == 'female'){
						$member_img = 'female-avata.png';
					}
				}
				 $member_desc = substr($member->member_desc, 0, 180);
			 $output .= '
			<div class="single-list">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="single-member-img">
							<img src="'.SITE_URL.'member/images/'.$member_img.'">
						</div>
					</div>
					<div class="col-lg-6 col-md-8">
						<div class="single-member-text">
							<h4 class="single-member-name">'.$member->member_first_name.' '.$member->member_last_name.'</h4>
							<h6 class="member-name-title"><span>'.$member->categories_name.'</span></h6>

							<p>'.$member_desc.'</p>

							<div class="date">';
							
							if ($row->member_document_verification_status == '1') {
						$output .=		'<span class="verify"><i class="fas fa-user-check"></i></span>';
							}
			

						$output .=	'</div>
							<div class="skill">
								<b>Year Experiance : </b>
								<span>'.$member->member_experience_year.' Year</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-12">
						<div class="member-button">

							<button type="button" class="contact" data-toggle="modal" data-target="#contact-popup'.$member->member_id.'">Contact</button>
							<a href="'.SITE_URL.'members/'.$member->member_username.'" class="view-profile">View Profile</a>


						</div>
						<!--
						<div class="social-link">
							<span><a href="https://www.facebook.com/elias.jabed"><i class="fab fa-facebook"></i></a></span>
								<span><a href="#"><i class="fab fa-twitter"></i></a></span>
								<span><a href="#"><i class="fab fa-linkedin"></i></a></span>
							
						</div>
						-->
						<div class="modal fade popup-contact" id="contact-popup'.$member->member_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						    <div id="member_mail_send_status"></div>
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel"><h4 class="single-member-name">'.$member->member_first_name.' '.$member->member_last_name.'</h4></h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="row">';
						        if ($member->member_contact_phone == 1) {
						        	$output .=   '<div class="col-lg-6">
						        		<h6><b>Phone:</b> + '.$member->country_code.' '.$member->member_phone.'</h6>
						        	</div>';
						        }
				      
						        if ($member->member_contact_email == 1) {
						        	$output .=  '<div class="col-lg-6">
						        		<h6><b>Email:</b> '.$member->member_email.'</h6>
						        	</div>';
						        }
					   
						   		$output .= '</div>    
						       	<div class="row">
						       		<form method="POST" action="#">
						       		<div class="col-lg-12">
						       			<input type="text" name="name" class="name" placeholder="Name">
						       			<input type="hidden" readonly name="id" class="member_id" placeholder="Name" value="'.$member->member_id.' ">
						       			<input type="email" name="email" class="email" placeholder="Email">
						       			<input type="text" name="phone" class="phone" placeholder="Phone">
						       			<textarea name="Messages" class="messages"></textarea>
						       				
						       			</textarea>
						       		</div>
						       		<div class="col-lg-12">
						       			<button type="button" class="Contact-submit" >Submit</button>
						       		</div>
						       		</form>
						       	</div>
						       
						      </div>
						    </div>
						  </div>
						</div>

					</div>
				</div>
			</div>
			';
			
		}
		echo  $output;
		//echo $result->num_rows;
	}
	else{
		echo "<span class='no-data'>There is no profession found in this search</span>";
	}
}

 ?>