<?php 
session_start();
require_once('../function.php');
$db = new database();
if ($_POST['foget_box'] !='') {
  $response .= '
  <div class="panel-body">
            <div class="text-center">
              
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Forgot Password?</h2>
              <p>You can reset your password here.</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          
                          <input id="forget_email" placeholder="Enter your email address" class="form-control" type="email"  required="">

                        </div>
                        <div id="forget_email_required"></div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="forget_password" value="Send me confirmation email" type="button">
                        <div id="some_div"></div>
<div id="some_div2"></div>
                      </div>
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';

    echo $response;
   die;
}
if(isset($_POST['forget_email'])){
   $email = $_POST['forget_email'];
  if(filter_var($_POST['forget_email'], FILTER_VALIDATE_EMAIL) === false){ //email validation
              $response .= '<div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Forgot Password?</h2>
              <p>You can reset your password here.</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          
                          <input id="forget_email" placeholder="email address" class="form-control" type="email"  required="" value="'.$email.'">

                        </div>
                        <div id="forget_email_required">
                        Please enter a valid email address.
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="forget_password" value="Send me confirmation email" type="button">
                      </div>
                      <div id="some_div"></div>
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
   }
   else if(!isEmail($_POST['forget_email'])){
		$response .= '<div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Forgot Password?</h2>
              <p>You can reset your password here.</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          
                          <input id="forget_email" placeholder="email address" class="form-control" type="email"  required="" value="'.$email.'">

                        </div>
                        <div id="forget_email_required">
                        Please enter a valid email address.
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="forget_password" value="Send me confirmation email" type="button">
                      </div>
                      <div id="some_div"></div>
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
   }
   else{
     $forget_sql = "SELECT * FROM ".$db_suffix."member WHERE member_email = '".$email."' AND member_email_verification = 'yes' limit 1";
      $forget_query = $db->select($forget_sql);
      $forget_count =  $forget_query->num_rows;
       $forget_count;
      if ($forget_count == 1) {

         // "allah mohan"; 
        $row = mysqli_fetch_object($forget_query);
        unset($_SESSION['forget_email'],$_SESSION['member_firstname'],$_SESSION['member_lastname'],$_SESSION['reset_code']);
           // $_SESSION['member_id'] = $row->member_id;

                 $_SESSION['forget_email'] = $row->member_email;
                $_SESSION['member_firstname'] = $row->member_first_name;
                 $_SESSION['member_lastname'] = $row->member_last_name;
                 // $_SESSION['member_lastname'] = $row->member_last_name;
                 $reset_code = mt_rand(100000,999999);
                $_SESSION['reset_code'] = $reset_code;
              
             $response .= '<div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Confirm your email?</h2>
              <p>We send  a verifaction code in your email!</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          
                          <input id="get_otp_code" placeholder="Enter valid verification code" class="form-control" type="text"  required="" value="">
                          <input id="forget_email" class="form-control" type="hidden" value="'.$_SESSION['forget_email'].'">
                          <input id="count_resend" class="form-control" type="hidden" value="1">

                        </div>
                        <div id="forget_email_required">
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="confirm_email" value="Confirm Email" type="button">

                      </div>
                      <div id="some_div"></div>
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
        echo $response;
              // require_once('config/dbconnect.php');
              require_once('../phpmailer/SendMail.php'); 
        // session_start();
        // unset($_SESSION["forget_email"]);
        // session_destroy();
        //Candidate Notification Start
            $TO_ADDRESS = $_SESSION['forget_email'];//$_SESSION['candidate_email'];
            $SUBJECT = "Forget Password Verification";
            $BODY ="";
            $BODY .= "Dear ".$_SESSION['member_firstname'].","."<br><br>";
            $BODY .= "You recently request to reset your password, we need to verify your identity.";
            $BODY .= "Your verification code below:<br><h2>";
            $BODY .= "$reset_code"."</h2><br><br>";

            $BODY .= "Best regards,"."<br>";
            $BODY .= SITE_NAME."<br>";
            $BODY .= "Directory Team<br>";
            $BODY .= SITE_URL;

            SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
            unset($TO_ADDRESS,$SUBJECT,$BODY);
      }
   }

   die;
}
if($_POST['resend_otp'] !='' ){
   $email = $_POST['forget_email2'];
     $forget_sql = "SELECT * FROM ".$db_suffix."member WHERE member_email = '".$email."' AND member_email_verification = 'yes' limit 1";
    $_POST['count_resend'];
    if ($_POST['count_resend'] !='') {
      $count_resend = $_POST['count_resend'] + 1;
    }else{
      $count_resend=1;
    }
      $forget_query = $db->select($forget_sql);
      $forget_count =  $forget_query->num_rows;
       $forget_count;
      if ($forget_count == 1) {
         // "allah mohan"; 
        $row = mysqli_fetch_object($forget_query);

           // $_SESSION['member_id'] = $row->member_id;

                 $_SESSION['member_id'] = $row->member_id;
                 $_SESSION['member_phone'] = $row->member_phone;
                 $_SESSION['forget_email'] = $row->member_email;
                $_SESSION['member_firstname'] = $row->member_first_name;
                 $_SESSION['member_lastname'] = $row->member_last_name;
                 // $_SESSION['member_lastname'] = $row->member_last_name;
                 $reset_code = mt_rand(100000,999999);
                $_SESSION['reset_code'] = $reset_code;
              
             $response .= '<div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Confirm your email?</h2>
              <p>We send  a verifaction code in your email!</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          
                          <input id="get_otp_code" placeholder="Enter valid verification code" class="form-control" type="text"  required="" value="">
                          <input id="forget_email" class="form-control" type="hidden" value="'.$_SESSION['forget_email'].'">
                           <input id="count_resend" class="form-control" type="hidden" value="'.$count_resend.'">

                        </div>
                        <div id="forget_email_required">
                        Confirmation Email has been send again. Please check your email.
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="confirm_email" value="Confirm Email" type="button">

                      </div>';

                      if ($count_resend <= 2) {
                        $response .= '<div id="some_div"></div>';
                      }else{
                        $response .= '<input class="btn btn-lg btn-primary btn-block" id="having_trouble" value="Having Trouble" type="button">';
                      }
                     
                $response .=  '</fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
        echo $response;
              // require_once('config/dbconnect.php');
              require_once('../phpmailer/SendMail.php'); 
        // session_start();
        // unset($_SESSION["forget_email"]);
        // session_destroy();
        //Candidate Notification Start
            $TO_ADDRESS = $_SESSION['forget_email'];//$_SESSION['candidate_email'];
            $SUBJECT = "Forget Password Verification";
            $BODY ="";
            $BODY .= "Dear ".$_SESSION['member_firstname'].","."<br><br>";
            $BODY .= "You recently request to reset your password, we need to verify your identity.";
            $BODY .= " Your verification code below:<br><h2>";
            $BODY .= "$reset_code"."</h2><br><br>";

            $BODY .= "Best regards,"."<br>";
            $BODY .= SITE_NAME."<br>";
            $BODY .= "Directory Team<br>";
            $BODY .= SITE_URL;

            SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
            unset($TO_ADDRESS,$SUBJECT,$BODY);
      }
  }

if ($_POST['member_password'] !='' && $_POST['member_c_password'] !='' ) {

  if ($_POST['member_password'] != $_POST['member_c_password']) {
     $response .= '<div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">create your your new password</h2>
              <p>Please type your new password</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input type="password"  class="form-control" name="member_password" id="member_password" onKeyUp="checkPasswordStrength();"  value="" placeholder="Enter New Password">
                          <div id="password-strength-status"></div
                          <div id="member_password_response"></div

                        </div>
                        <div class="input-group">
                           <input type="password" class="form-control"  name="member_c_password" onKeyUp="checkPasswordStrength2();" id="member_c_password" value="" placeholder="Confirm New Password">
                           <div id="password-c-strength-status"></div>
                           <div id="member_password_response"></div>
                        </div>
                        <div id="forget_email_required">
                        password does not match
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="change_password" value="Change Password" type="button">

                      </div>
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
        echo $response;
   die;
  } else if(StrongPassword($_POST['member_password']) != true){
     $response .= '<div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">create your your new password</h2>
              <p>Please type your new password</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input type="password"  class="form-control" name="member_password" id="member_password" onKeyUp="checkPasswordStrength();"  value="" placeholder="Enter New Password">
                          <div id="password-strength-status"></div
                          <div id="member_password_response"></div

                        </div>
                        <div class="input-group">
                           <input type="password" class="form-control"  name="member_c_password" onKeyUp="checkPasswordStrength2();" id="member_c_password" value="" placeholder="Confirm New Password">
                           <div id="password-c-strength-status"></div>
                           <div id="member_password_response"></div>
                        </div>
                        <div id="forget_email_required">
                         password should be alpha, numeric and one letter must be in capital letter.
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="change_password" value="Change Password" type="button">

                      </div>
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
        echo $response;
   die;
  }
  else{
     $_POST['member_password'];
     
     $member_password = md5($_POST['member_password']);
     $change_sql = "UPDATE ".$db_suffix."member SET member_password = '$member_password'
    WHERE member_email='".$_SESSION["forget_email"]."'";
    $db->update($change_sql);
    $password_change = 'done';
    session_start();
    unset($_SESSION["forget_email"]);
    unset($_SESSION["otp"]);
    unset($_SESSION["reset_code"]);
    session_destroy();

  $response .= '<div class="panel-body">
            <div class="text-center">
              <h3 class="green"><i class="fas fa-check-circle"></i></h3>
              <h2 class="text-center">congrats!</h2>
              <p>You are successfully done reset your password</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <input class="btn btn-lg btn-primary btn-block " data-dismiss="modal" aria-label="Close" id="confirm_email" value="Login" type="button">
                          

                        </div>
                      </div>
                        
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
        echo $response;
   die;
  }
}

if ($_POST['having_trouble'] !='') {
     if (isset($_SESSION['forget_email']) && isset($_SESSION['member_id']) && isset($_SESSION['member_phone']) && isset($_SESSION['member_firstname']) &&  isset($_SESSION['member_lastname']) ) {
      echo $_SESSION['forget_email'];
       require_once('../phpmailer/SendMail.php'); 
           $TO_ADDRESS = $_SESSION['forget_email'];//$_SESSION['candidate_email'];
           // send to user
            $SUBJECT = "Directory Forget password Issue";
            $BODY ="";
            $BODY .= "Dear ".$_SESSION['member_firstname'].","."<br><br>";
            $BODY .= "We are extremely sorry for troubling reset your password. we are taking action on this issue. our support team contact with you as early as possible <br>";
            $BODY .= " your submitting information:<br><h2>";
            $BODY .= "Name: ".$_SESSION['member_firstname']." ".$_SESSION['member_lastname']."<br>";
            $BODY .= "Email: ".$_SESSION['forget_email']."<br>";
            $BODY .= "Phone: ".$_SESSION['member_phone']." <br><br>";

            $BODY .= "Best regards,"."<br>";
            $BODY .= SITE_NAME."<br>";
            $BODY .= "Support Team<br>";
            $BODY .= SITE_URL;
            echo $BODY;

            SendMail($mailer,$TO_ADDRESS,$SUBJECT,$BODY);
            unset($TO_ADDRESS,$SUBJECT,$BODY);

            // send to user
     }

  $response .= '<div class="panel-body">
            <div class="text-center">
              <h3 class="green"><i class="fas fa-check-circle"></i></h3>
              <h2 class="text-center">Congrates!</h2>
              <p>Your password has been rest successfully.</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <input class="btn btn-lg btn-primary btn-block " data-dismiss="modal" aria-label="Close" id="confirm_email" value="Login" type="button">
                          

                        </div>
                      </div>
                        
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
        echo $response;
   die;
}

if ($_POST['get_otp_code'] !='' && $_POST['get_otp_code'] ==  $_SESSION['reset_code'] && isset($_SESSION['forget_email']) && isset($_SESSION['reset_code'])) {
  $response .= '<div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">create your your new password</h2>
              <p>Please type your new password</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input type="password"  class="form-control" name="member_password" id="member_password" onKeyUp="checkPasswordStrength();"  value="" placeholder="Enter New Password">
                          <div id="password-strength-status"></div
                          <div id="member_password_response"></div

                        </div>
                        <div class="input-group">
                           <input type="password" class="form-control"  name="member_c_password" onKeyUp="checkPasswordStrength2();" id="member_c_password" value="" placeholder="Confirm New Password">
                           <div id="password-c-strength-status"></div>
                           <div id="member_password_response"></div>
                        </div>
                        <div id="forget_email_required">
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="change_password" value="Change Password" type="button">

                      </div>
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
        echo $response;
   die;
}else if($_POST['get_otp_code'] !=  $_SESSION['reset_code']){
    $response .= '<div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Confirm your email?</h2>
              <p>We send  a verifaction code in your email!</p>
                <div class="panel-body">
                  
                  <form class="form">
                    <fieldset>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          
                          <input id="get_otp_code" placeholder="Enter valid verification code" class="form-control" type="text"  required="" value="">
                          <input id="forget_email" class="form-control" type="hidden" value="'.$_SESSION['forget_email'].'">
                          <input id="count_resend" class="form-control" type="hidden" value="1">

                        </div>
                        <div id="forget_email_required">
                           Enter valid verification code
                      </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block" id="confirm_email" value="Confirm Email" type="button">

                      </div>
                      <div id="some_div"></div>
                    </fieldset>
                  </form>
                  
                </div>
            </div>
        </div>';
        echo $response;
      }
// else{
//   $response .= '<div class="panel-body">
//             <div class="text-center">
//               <h3><i class="fa fa-lock fa-4x"></i></h3>
//               <h2 class="text-center">Confirm your email?</h2>
//               <p>We send  a verifaction code in your email!</p>
//                 <div class="panel-body">
                  
//                   <form class="form">
//                     <fieldset>
//                       <div class="form-group">
//                         <div class="input-group">
//                           <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          
//                           <input id="get_otp_code" placeholder="Enter valid verification code" class="form-control" type="text"  required="" value="">

//                         </div>
//                         <div id="forget_email_required">
//                           Enter valid verification code
//                         </div>
//                       </div>
//                       <div class="form-group">
//                         <input class="btn btn-lg btn-primary btn-block" id="confirm_email" value="Confirm Email" type="button">

//                       </div>
//                       <div id="some_div"></div>
//                     </fieldset>
//                   </form>
                  
//                 </div>
//             </div>
//         </div>';
//         echo $response;
//         die;
// }

?>