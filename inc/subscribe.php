<?php 
// $conn= mysqli_connect('localhost', 'root', '','ajaxcrud');
require_once('../function.php');
$db = new database();
extract($_POST);
// $name = 'rejon'
 // $query ="INSERT INTO dir_subscriber (email ) VALUES ('$email')";

if (  isset($_POST['email'])  ) {
	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){ //email validation
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  Invalid email format
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
             
   } else if(!isEmail($_POST['email'])){
   	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  Invalid email format
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
   }
   else{
   $email_check = $db->select("SELECT * FROM dir_subscriber WHERE subscriber_email ='$email'");
   // echo $email_check->num_rows;
            if ( $email_check->num_rows > 0) {
            	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					This email address already registered in our newsletter
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
              // $input_error['member_email'] = "Email already exist";
              // $row = mysqli_fetch_object($email_check);
              // if ($row->member_email_verification == 'yes') {
                
              // }
          }else{
          	$query ="INSERT INTO dir_subscriber (subscriber_email  ) VALUES ('$email')";
				$db->insert($query);
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  Success you are now in our newsletter list
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
          }
                
		 
	}
}

?>