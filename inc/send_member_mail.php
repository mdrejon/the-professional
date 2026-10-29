<?php
session_start();				
require_once("../function.php");
$db = new database();
$member_id = $_SESSION['member_id'];
$member_id = $_POST['member_id'];
$member_s = "select * from ".$db_suffix."member where member_id='$member_id'";
$member_q = $db->select($member_s);
$member = mysqli_fetch_object($member_q);
 // echo $member_username = $member->member_username;
$member_username = $_SESSION['member_username'];
$msg['status']='';
$msg['data']='';

// $name        = $_POST['name'];
	if ($_POST['name'] !='' && $_POST['email'] !='' && $_POST['phone'] !='' && $_POST['message'] !='') {
		$name        =  trim($_POST['name']);
		$email        =  trim($_POST['email']);
		$phone        =  trim($_POST['phone']);
		$message        =  trim($_POST['message']);
		
		$profile_url = '';
		if(isset($_SESSION['member_id']) && trim($_SESSION['member_username'])!="" ){
			$profile_url = SITE_URL.'members/'.trim($_SESSION['member_username']);
		}
		else {
			$find_sql = "select * from ".$db_suffix."member where member_email='$email' or member_phone = '$phone' limit 1";
			$find_result = $db->select($find_sql);
			if($find_result->num_rows >0){
				$sender_obj = mysqli_fetch_object($find_result);
				$sender_obj->member_username;
				$profile_url = SITE_URL.'members/'.$sender_obj->member_username;
			}
		}
		
		
		require_once('../phpmailer/SendMail.php');
		 
		$TO_ADDRESS = $member->member_email;  
		$SUBJECT = "Contact request from $name";
		  $BODY =
		'
		<p style="font-size:17px;"><b>Dear '.$member->member_first_name.',</b><br>
		We received below info via contact us. Please make a reply.<br>
		Submited information as below:</p>
		<table style="width: 100%;">
		<col width="90">
		<col width="100%">
		<tr>
		<td><b>NAME:</b> </td>
		<td style="padding-left: 20px;">'.$name.'</td>
		</tr>
		';
		
		

		$BODY .='
		<tr>
		<td><b>Email address:</b> </td>
		<td style="padding-left: 20px;">'.$email.'</td>
		</tr>
		<tr>
		<td><b>Contact Number:</b> </td>  
		<td style="padding-left: 20px;">'.$phone.'</td>
		</tr>
		<tr>
		<td style="vertical-align: baseline;"><b>Message:</b> </td>
		<td style="padding-left: 20px;">'.$message.'</td>
		</tr>';
		
		if ($profile_url !='') {
			$BODY .='
			<tr><td><b>Member Profile:</b> </td>
			<td style="padding-left: 20px;"> <a href="'.$profile_url.'" target="_blank">Click to View Profile</a>   </td></tr>
			';
		}else{
			$BODY .='
			<tr><td><b>Member profile link:</b> </td>
			<td style="padding-left: 20px;">The sender is not listed yet in directory.</td></tr>
			';
		}
		
		$BODY .='</table>';
		
		SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
		
		unset($TO_ADDRESS,$SUBJECT,$BODY);
		$TO_ADDRESS = $email;
		
		$msg['status'] = 'success';

		$msg['data'] = "<div class='alert alert-success'>Your messages has been sent successfully, thanks for using our services.</div>";	

	}else{
		$msg['status'] = 'error';

		$msg['data'] = "<div class='alert alert-danger'> Please enter all Information<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a></div>";	
	}
echo json_encode($msg);
?>