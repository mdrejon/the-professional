<?php
require_once('../function.php');
$db = new database();
 $member_lat = $_SESSION['lat']; 
 $member_lng = $_SESSION['lng'];
 //echo $_SESSION['range']; 
 
 if ($_SESSION['range'] !='') {
			$radius_km = $_SESSION['range']; 
		}else{
			$radius_km = 500;
		}
		//echo $radius_km;
		
/*$location = trim($_SESSION['location']);
 $location_array = array();
 $location_where = '';
 if($location !="") 
 {
	 $location_array = explode(',',$location);
	 $words_count = count($location_array);
	 $ij=0;
	 foreach ($location_array as $value){
		$ij++;
		$value =trim($value);
		$location_where .= " cty.city_name like '%".$value."%' or r.states_name like '%".$value."%' or c.country_name like '%".$value."%' "; 
		$words_count--;
		if($words_count>0) $location_where .= " or ";
	 }
	 if($ij>0){
		$location_where = " (". $location_where." )"; 
	 }
 }*/
 
if(isset($_POST["limit"], $_POST["start"]))
{
	$start	= $_POST["start"];
	$limit	= $_POST["limit"];
	if (isset($_SESSION['member_id']) || isset($member_lat) && isset($member_lng) ) {
		$sql_distance = $having = ''; 

					  	  
						   $sql_distance = " ,if(m.member_location_latitude !='' && m.member_location_longitude !='',111.1111 *
    DEGREES(ACOS(LEAST(1.0, COS(RADIANS(".$member_lat."))
         * COS(RADIANS(m.member_location_latitude))
         * COS(RADIANS(".$member_lng.") - RADIANS(m.member_location_longitude))
         + SIN(RADIANS(".$member_lat."))
         * SIN(RADIANS(m.member_location_latitude))))),500) as distance "; 
						     
						    $having = " HAVING (distance <= ".$radius_km.") "; 
						     
						    // $order_by = ' distance ASC '; 
		 $query = "SELECT m.*,m.country_code as phone_country_code,CONCAT_WS(' ',m.country_code,m.member_phone) as member_full_phone, c.country_name,c.country_code as countryCode,r.states_name,cty.city_name,
if(m.categories_id !=0,cat.categories_name,m.member_others_professional) as categories_name,CONCAT_WS(',',cty.city_name,r.states_name,c.country_name) as member_full_location ".$sql_distance." FROM ".$db_suffix."member m 
left join countries c on c.country_id = m.country_id
	left join states r on r.states_id = m.region_id 
	left join cities cty on cty.city_id = m.city_id
	left join dir_categories cat on m.categories_id = cat.categories_id
		 WHERE  (m.categories_id !=0 or m.member_others_professional !='') AND ( m.member_email_verification = 'yes' AND m.member_status = '1') "; 
	}else{
		$query =  "SELECT m.*,m.country_code as phone_country_code,CONCAT_WS(' ',m.country_code,m.member_phone) as member_full_phone, c.country_name,c.country_code as countryCode,r.states_name,cty.city_name, if(m.categories_id !=0,cat.categories_name,m.member_others_professional) as categories_name,CONCAT_WS(',',cty.city_name,r.states_name,c.country_name) as member_full_location FROM ".$db_suffix."member m 
		left join countries c on c.country_id = m.country_id
	left join states r on r.states_id = m.region_id 
	left join cities cty on cty.city_id = m.city_id
	left join dir_categories cat on m.categories_id = cat.categories_id
		WHERE  (m.categories_id !=0 or m.member_others_professional !='') AND ( m.member_email_verification = 'yes' AND m.member_status = '1') ";
	}
	// $query =  "SELECT * FROM ".$db_suffix."member WHERE  categories_id !='' AND member_email_verification = 'yes' ";
	if($location !="")  
	{
		//$query .=" AND ".$location_where;	
	}
	
	if (isset($_POST['categories'])) {
		 $categories = implode("','", $_POST['categories']);
		$query .="AND m.categories_id IN('".$categories."') ";
		//echo $query;
	}
	if (isset($_POST['country'])) {
		 $country = implode("','", $_POST['country']);
		$query .="AND m.country_id IN('".$country."') ";
		
	}
	
	if (isset($_POST['verified']) && isset($_POST['unverified'])) {
		$query .="AND m.member_document_verification_status IN('0','1') ";
	}
	elseif (isset($_POST['verified'])) {
		  $verified = implode("','", $_POST['verified']);
		$query .="AND  m.member_document_verification_status = '1' ";
		
	}elseif (isset($_POST['unverified'])) {
		 $unverified = implode("','", $_POST['unverified']);
		$query .="AND m.member_document_verification_status = '0' ";
		
	}

	if (isset($_SESSION['member_id']) || isset($member_lat) && isset($member_lng)) {
		 $order_by = ' distance ASC,cty.city_name asc '; 
		$query .=" $having ORDER BY $order_by ";
	}
	$query .= " LIMIT ".$start.", ".$limit;
	// echo $query;
	  // echo "<div class='d-none'>".$query;."<div>";
	$result = $db->select($query);
	$output = "";
	if ($result->num_rows > 0) {
		while ( $row = mysqli_fetch_object($result)) {
			$member_img = $row->member_img;
			$member_desc = $row->member_desc;
			$member_desc = substr($member_desc, 0, 180);
			if(trim($member_desc)!="") $member_desc = '<p>'.$member_desc.'</p>';
			
			$member_username = $row->member_username;
					
			
			/* $sql = "SELECT * FROM ".$db_suffix."member m left join ".$db_suffix."categories ca on  m.categories_id = ca.categories_id WHERE member_id ='".$row->member_id."'" ;
			$member_query = $db->select($sql);
			$member = mysqli_fetch_object($member_query);
			$member_img = $member->member_img;*/
				if ($member_img == '') {
					if ($row->member_gender == 'male') {
						$member_img = 'male-avata.png';
					}elseif ($row->member_gender == 'female'){
						$member_img = 'female-avata.png';
					}
				}
				// $member_desc = substr($member->member_desc, 0, 180);
			 $output .= '
			<div class="single-list">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="single-member-img">
							<img src="'.SITE_URL.'member/images/'.$member_img.'">
						</div>
					</div>
					<div class="col-lg-6 col-md-9 col-sm-6">
						<div class="single-member-text">
							<h4 class="single-member-name"><a href="'.SITE_URL.'members/'.$row->member_username.'">'.$row->member_first_name.' '.$row->member_last_name.'</a></h4>
							<h6 class="member-name-title"><span>'.$row->categories_name.'</span></h6>

							'.$member_desc.'

							<div class="date">';
							
							if ($row->member_document_verification_status == '1') {
						$output .=		'<span class="verify"><i class="fas fa-user-check"></i></span>';
							}
			

						$output .=	'</div>
							<div class="skill">
								<b>Year Experiance : </b>
								<span>'.$row->member_experience_year.' Year</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-12 col-sm-3">
						<div class="member-button">

							<button type="button" class="contact" data-toggle="modal" data-target="#contact-popup'.$row->member_id.'">Contact</button>
							<a href="'.SITE_URL.'members/'.$row->member_username.'" class="view-profile">View Profile</a>


						</div>
						<!--
						<div class="social-link">
							<span><a href="https://www.facebook.com/elias.jabed"><i class="fab fa-facebook"></i></a></span>
								<span><a href="#"><i class="fab fa-twitter"></i></a></span>
								<span><a href="#"><i class="fab fa-linkedin"></i></a></span>
							
						</div>
						-->
						<div class="modal fade popup-contact" id="contact-popup'.$row->member_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						    <div class="member_mail_send_status"></div>
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel"><h4 class="single-member-name">'.$row->member_first_name.' '.$row->member_last_name.'</h4></h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="row">
						       		';

						        if ($row->member_contact_phone == 1) {
						        	$output .=   '<div class="col-lg-6">
						        		<h6><b>Phone:</b> + '.$row->phone_country_code.' '.$row->member_phone.'</h6>
						        	</div>';
						        }
				      
						        if ($row->member_contact_email == 1) {
						        	$output .=  '<div class="col-lg-6">
						        		<h6><b>Email:</b> '.$row->member_email.'</h6>
						        	</div>';
						        }
					   
						   		$output .= '</div>    
						       	<div class="row">
						       		<form method="POST" action="#">
						       		<div class="col-lg-12">
						       			<input type="text" name="name" class="name" id="name" placeholder="Name">
						       			<input type="hidden" readonly name="id" id="member_id" class="member_id" placeholder="Name" value="'.$row->member_id.' ">
						       			<input type="email" name="email" class="email" placeholder="Email">
						       			<input type="text" name="phone" class="phone" placeholder="Phone">
						       			<textarea name="Messages" class="messages"></textarea>
						       				
						       			</textarea>
						       		</div>
						       		<div class="col-lg-12">

						       			<button type="button" class="Contact-submit contact_with_member" >Submit</button>
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
	// else{
	// 	echo "<span class='no-data'>There is no profession found in this search</span>";
	// }
}
?>