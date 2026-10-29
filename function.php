<?php 
require_once('config/dbconnect.php');
/**
 * 
 */
class database 
{
	public $host = DB_HOST;
	public $user = DB_USER;
	public $pass = DB_PASS;
	public $db_name = DB_NAME;

	public $link;
	private function connect(){
		$this->link = new mysqli($this->host,$this->user, $this->pass, $this->db_name);
	}
    public	function __construct()
	{
		$this->connect();
	}
	public function select($query){
		$result = $this->link->query($query);
		if ($result->num_rows > 0) {
			return $result;

		}
		else {
			return false;
		}
 
	}
	public function insert($query){
		$insert = $this->link->query($query);
		 if ($insert) {
		 	return true;
		 }else{
			return false;
		}
	}
	public function update($query){
		$update = $this->link->query($query);
		if ($update) {
		 	return true;
		 }else{
			return false;
		}
	}
	public function last_id(){
		return $lastid = $this->link->mysqli_insert_id();
	}
	

}


function fetch_user_last_activity($user_id, $connect){
	$query = "SELECT * FROM dir_login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row) {
		return $row['last_activity'];
	}
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect){
	$query = "SELECT * FROM dir_chat_message WHERE (from_user_id = '".$from_user_id."' AND to_user_id = '".$to_user_id."') OR (from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."') ORDER BY timestamp DESC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<ul class="list-unstyled">';
		foreach($result as $row){
			$user_name = '';
			if($row["from_user_id"] == $from_user_id){
				$user_name = '<b class="text-success">You</b>';
			} else {
				$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
			}
			$output .= '
		  <li style="border-bottom:1px dotted #ccc">
		   <p>'.$user_name.' - '.$row["chat_message"].'
			<div align="right">
			 - <small><em>'.$row['timestamp'].'</em></small>
			</div>
		   </p>
		  </li>
		  ';
		}
	$output .= '</ul>';
	return $output;
}

function get_user_name($user_id, $connect){
	$query = "SELECT username FROM dir_member WHERE member_id = '$user_id'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row){
		return $row['username'];
	}
}

function count_unseen_message($from_user_id, $to_user_id, $connect){
	$query = "SELECT * FROM dir_chat_message WHERE from_user_id = '$from_user_id' AND to_user_id = '$to_user_id' AND status = '1'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$count = $statement->rowCount();
	$output = '';
	if($count > 0){
		$output = '<span class="label get_msg_count label-success">'.$count.'</span>';
	}
	return $output;
}

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function isEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
	  else if (preg_match('/\\-\\-/', $local))
      {
         // local part has two consecutive -
         $isValid = false;
      }
	  
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9_\\.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}


function isZipCode($givenName)
{
	$regExp = "/^([a-zA-Z0-9' -]+)$/";
	if(preg_match($regExp,$givenName)){
		return true;
	}
	else { 
		return false;
	}
}
function isName($givenName)
{
	$regExp = "/^([a-zA-Z' .]+)$/";
	if(preg_match($regExp,$givenName)){
		return true;
	}else{
		return false;
	}
}
function StrongPassword($password){
// Given password
 
// Validate password strength
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-zA-Z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
// if(strlen($password) < 8){
// 	//echo "Password should be at least 8 characters in length";
// 	return false;
// }
// // else 
if(!$uppercase) {
	return false; //echo "Password should be at least one upper case letter";
}
else
if(!$lowercase) {
	return false;//echo "Password should be at least one lower case letter";
}
else if(!$number) {
	return false;//echo "Password should be at least one number";
}
// else if(!$specialChars) {
// 	return false;//echo "Password should be at least one special character";
// }

elseif(!$lowercase || !$number || !$uppercase) {
    return false;//echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
}else{
    return true;//echo 'Strong password.';
}
}
?>

