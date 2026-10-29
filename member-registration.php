<?php

session_start();

// ini_set('display_errors', 1); work now

// ini_set('display_startup_errors', 1);

// error_reporting(E_ALL); 

$page = 'reg';

require_once('config/dbconnect.php');

if (isset($_SESSION['member_id'])) {

  // session_destroy();

  // echo '<script src="'.SITE_URL.'assets/js/jquery-1.12.4.min.js"></script>';

  echo '<script>window.location="' . SITE_URL . '";</script>';

  // header('location:');

}

?>

<?php

require_once('function.php');

require_once('phpmailer/SendMail.php');
$categories_id = 0;
if (isset($_POST['register-now'])) {

  $member_first_name        =  trim($_POST['member_first_name']);
  $member_last_name         =  trim($_POST['member_last_name']);
  $member_email =  trim($_POST['member_email']);
  $confirm_email    =  $_POST['confirm_email'];
  // $member_username        =  $_POST['member_username']; 
  $member_phone            =  $_POST['member_phone'];
  $country_code            =  $_POST['country_code'];
  $member_birth_date         =  $_POST['member_birth_date'];
  $member_professional       =  $_POST['member_professional'];
  $member_others_professional = $_POST['member_others_professional'];
  $categories_id     =  trim($_POST['categories_id']);

  if (!is_numeric($categories_id) && $categories_id != "") {

    $member_others_professional = $categories_id;
  }
  $member_contact_email       =  $_POST['member_contact_email'];
  $member_contact_phone            =  $_POST['member_contact_phone'];
  $member_gender            =  $_POST['member_gender'];
  $member_religion          =  $_POST['member_religion'];
  // $member_address            =  $_POST['member_address']; 
  $member_password             =  $_POST['member_password'];
  $member_c_password             =  $_POST['member_c_password'];
  $country_id       =  $_POST['country_id'];
  $region_id       =  $_POST['region_id'];
  $city_id       =  $_POST['city_id'];
  $location       =  $_POST['location'];
  $lat       =  $_POST['lat'];
  $lng       =  $_POST['lng'];
  $member_experience_year    =  $_POST['member_experience_year'];
  $post_code    =  $_POST['post_code'];
  $input_error = array();
  $file_name      = $_FILES['file']['name'];
  $file_size      = $_FILES['file']['size'];
  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION); //get the extension of a picture name 
  $datetime       = date("Ymdhis");
  $final_filename = $datetime . uniqid() . '.' . $file_extension;
  if (empty($member_first_name)) {
    $input_error['member_first_name'] = "First name required";
  }
  if (!preg_match("/^[a-zA-Z ]*$/", $member_first_name)) {
    $input_error['firstname'] = "First name should be alphabet";
  }
  if (strlen($member_first_name) > 20) {
    $input_error['firstname'] = "First name too long";
  }

  if (!isName($_POST['member_first_name'])) {
    $input_error['firstname'] = "First name should be alphabet";
  } 
  // Last name validation

  if (empty($member_last_name)) {
    $input_error['lastname'] = "Last name required";
  }

  if (!preg_match("/^[a-zA-Z ]*$/", $member_last_name)) {
    $input_error['lastname'] = "Last name should be alphabet";
  }

  if (strlen($member_last_name) > 20) {
    $input_error['lastname'] = "Last name too long";
  }

  if (!isName($_POST['member_last_name'])) {
    $input_error['lastname'] = "Last name should be alphabet";
  }
  // Gender validation

  if (strtolower($member_gender) != 'male' && strtolower($member_gender) != 'female' && strtolower($member_gender) != 'others') {
    $input_error['member_gender'] = "Invalid Gender";
  }
  if (empty($member_gender)) {
    $input_error['member_gender'] = "Gender required";
  }
  // Birthdate validation 
  if (empty($member_birth_date)) {
    $input_error['member_birth_date'] = "Age required";
  }
  if ($_POST['member_birth_date'] < 18 || $_POST['member_birth_date'] > 85) {
    $input_error['member_birth_date'] = "Age should be 18-99 ";
  }
  // post_code validation 
  if (empty($post_code)) {
    $input_error['post_code'] = "Post Code is required";
  }
  if (!preg_match("/^([a-zA-Z0-9' -]+)$/", $post_code)) {
    $input_error['post_code'] = "Please enter valid post code";
  }
  // Email validation 
  if (empty($member_email)) {
    $input_error['member_email'] = "Email address is required";
  } else {
    if (filter_var($member_email, FILTER_VALIDATE_EMAIL) === false) { //email validation 
      $input_error['member_email'] = "Invalid Email Address";
    } else {
      $email_check = mysqli_query($db, "SELECT * FROM dir_member WHERE member_email ='$member_email' AND member_email_verification ='yes' AND member_status = '1' ");

      if (mysqli_num_rows($email_check) > 0) {
        $input_error['member_email'] = "Email address already exist";
      }
    }
  }

  if (!isEmail($member_email)) {
    $input_error['member_email'] = "Invalid Email Address";
  }
  // Password Validation

  if (empty($member_password)) {
    $input_error['member_password'] = "Password is required.";
  }
  if (StrongPassword($member_password) != true) {
    $input_error['member_password'] = " password should be alpha, numeric and one letter must be in capital letter.";
  }
  if (empty($member_c_password)) {
    $input_error['member_c_password'] = "Confirm Password is required.";
  } else {
    if ($member_password !== $member_c_password) {
      $input_error['member_c_password'] = "Confirm Password doesn't matches.";
    }
  }
  // Phone Validation 
  if (empty($member_phone)) {
    $input_error['member_phone'] = "Mobile Number is required";
  }
  if (preg_match("/[^0-9\_-]/i", $member_phone)) {

    $input_error['member_phone'] = "Mobile Number should in number";
  }
  $member_contact_email_status = 0;
  $member_contact_phone_status = 0;
  if (!empty($_POST['member_contact_email'])) {
    foreach ($_POST['member_contact_email'] as $value) {
      if ($value == 'email') $member_contact_email_status = 1;
      if ($value == 'phone') $member_contact_phone_status = 1;
    }
  }
  if (empty($member_contact_email_status) && empty($member_contact_phone_status)) {
    $input_error['member_contact'] = "Email or Phone number must be selected";
  }
  // Country Validation 
  if (empty($country_id)) {
    $input_error['country_id'] = "Please select country.";
  }
  // State Validation 
  if (empty($region_id)) {
    $input_error['region_id'] = "Please select region";
  }
  // City Validation 
  if (empty($city_id)) {
    $input_error['city_id'] = "Please select city";
  }
  if (!isset($_POST['agree-option'])) {
    $input_error['agree-option'] = "You must agree the terms & condition.";
  }
  // echo count($input_error); 
  if (count($input_error) == 0) {
    $member_password1 = md5($member_password);
    $activation_code = mt_rand(100000, 999999);

    $query = "INSERT INTO `dir_member` 
          ( `member_first_name`, 
            `member_last_name`, 
            `member_email`,  
            `member_username`,  
            `member_professional`,  
            `member_address`,  
            `member_phone`, 
            `country_code`, 
            `member_birth_date`, 
            `member_contact_email`, 
            `member_contact_phone`, 
            `member_gender`, 
            `member_religion`, 
            `member_cover_photo`, 
            `member_password`, 
            `country_id`, 
            `region_id`, 
            `city_id`, 
            `member_experience_year`, 
            `member_location`, 
            `member_location_latitude`, 
            `member_location_longitude`, 
            `categories_id`, 
            `member_others_professional`, 
            `post_code`, 
            `activation_code`) 
                  VALUES ( 
                    '$member_first_name', 
                    '$member_last_name', 
                    '$member_email', 
                    '', 
                    '', 
                    '', 
                    '$member_phone', 
                    '$country_code', 
                    '$member_birth_date', 
                    '$member_contact_email_status', 
                    '$member_contact_phone_status', 
                    '$member_gender', 
                    '$member_religion', 
                    '$member_cover_photo ', 
                    '$member_password1', 
                    '$country_id', 
                    '$region_id', 
                    '$city_id', 
                    '$member_experience_year', 
                    '$location', 
                    '$lat', 
                    '$lng', 
                    '$categories_id', 
                    '$member_others_professional', 
                    '$post_code', 
                    '$activation_code')";
        $result = mysqli_query($db, $query);

      if ($result) {
        $member_v_id = mysqli_insert_id($db);
        session_start();
        $_SESSION['member_v_id'] = $member_v_id;
        $member_username = '';
        if ($member_username == '') {
          $member_username = $member_first_name . $member_v_id;
          $username_check = mysqli_query($db, "SELECT * FROM dir_member WHERE member_username ='$member_username' AND member_email_verification ='yes' ");
          if (mysqli_num_rows($username_check) != 0) {
            $today = date('y-m-d');
            $today_stamp = strtotime($today);
            $member_username .= '.' . $today_stamp . '';
          }
          $update_username_sql = "UPDATE " . $db_suffix . "member SET member_username = '" . $member_username . "' WHERE  member_id = '$member_v_id'";

          mysqli_query($db, $update_username_sql);
        } else {
          // echo "Not Get Data";
        }

        $TO_ADDRESS = $member_email; //$_SESSION['candidate_email']; 
        $SUBJECT = "Directory Email Verification";
        $BODY = "";
        $BODY .= "Dear " . $member_first_name . "," . "<br><br>";
        $BODY .= "Thanks for your registration. We need to verify your email address to complete your registation, Please confirm your  email address..";
        $BODY .= "Your verification code below:<br><h2>";
        $BODY .= "$activation_code" . "</h2><br><br>";
        $BODY .= " Or click the link:<br><P>";
        $BODY .= SITE_URL . "member_register_verification/" . $activation_code . "</P><br><br>";
        $BODY .= "Best regards," . "<br>";
        $BODY .= SITE_NAME . "<br>";
        $BODY .= "Directory Team<br>";
        $BODY .= SITE_URL;
        SendMail($mailer, $TO_ADDRESS, $SUBJECT, $BODY);

        unset($TO_ADDRESS, $SUBJECT, $BODY); 
        //  echo  "message send"; 
        $_SESSION['member_v_id'];
        echo '<script>window.location="' . SITE_URL . 'member_register_verification";</script>';
      } else { 
        // echo "not get";
      }
    } else { 
      $input_error['data_error_msg'] = "Please check the following errors occurred.";
    }
} 
require_once('common/header.php');
 
?> 
<style type="text/css">
  .ah-input-error { 
    position: relative !important; 
  }
</style>

<style type="text/css">
  #password-strength-status,
  #password-c-strength-status { 
    font-size: 12px; 
    padding: 5px; 
  } 
  #password-strength-status.medium-password { 
    color: #B7D60A; 
  } 
  .strong-password { 
    color: #12CC1A; 
  } 
  .weak-password { 
    color: #CE1D14
  } 
  #member_password_response span { 
    top: 12px !important;
  } 
  .reg .form-error { 
    margin-bottom: 0 !important; 
  }
</style>

<section class="signup2 section-padding" id="reg_page_section">

  <div class="container register">

    <div class="row">

      <div class="col-md-3 register-left">

        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />

        <h3>Welcome</h3>

        <p>Already have an account!</p>

        <a href="<?php echo SITE_URL ?>sign-in" class="border-btn">Log In</a><br />

      </div>

      <div class="col-md-9 register-right">

        <h3 class="register-heading">Create your Profile / Account</h3>

        <form method="POST" action="<?php echo SITE_URL; ?>create-account" enctype="multipart/form-data" autocomplete="on">



          <div class="row register-form">

            <?php if (isset($input_error['data_error_msg'])) {
              echo '<div  class="form-error text-center" style="color: red;">' . $input_error['data_error_msg'] . '</div>';
            }



            ?>

            <div class="form-group form-label">

              <label class="active" for="country_id">Select Country *</label>

              <select required class="form-control profession select2" id="country_id" name="country_id">

                <option value="">Please select Country</option>



                <?php

                $sql_parent_menu = "SELECT * FROM countries";



                $parent_query = $db->select($sql_parent_menu);

                while ($parent_obj = mysqli_fetch_object($parent_query)) {

                  if ($parent_obj->country_id == $country_id) {

                    echo '<option selected="selected" value="' . $parent_obj->country_id . '">' . $parent_obj->country_name . '</option>';
                  } else {

                    echo '<option value="' . $parent_obj->country_id . '">' . $parent_obj->country_name . '</option>';
                  }
                }



                ?>

              </select>

              <?php if (isset($input_error['country_id'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['country_id'] . '</label>';
              } ?>

            </div>

            <div class="form-group form-label">

            </div>

            <div class="form-group form-label">



              <label for="member_email" class="active">Email Address *</label>

              <input required type="email" name="member_email" id="member_email" class="form-control box" placeholder="Enter your Personal Email Address" value="<?php echo $member_email ?>" autocomplete="off" />

              <div id="email_response"></div>

              <?php if (isset($input_error['member_email'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_email'] . '</label>';
              } ?>

            </div>

            <div class="form-group form-label input-group country-code-css">

              <label class="active" for="member_phone">Mobile Number *</label>

              <div class="input-group cc_code">





                <select class="custom-select select2 countrycode" name="country_code" style="max-width: 140px;">

                  <option value='0'>Choose Code</option>



                  <?php

                  $sql_parent_menu = "SELECT * FROM countries order by country_id";



                  $parent_query = $db->select($sql_parent_menu);

                  while ($parent_obj = mysqli_fetch_object($parent_query)) {

                    if ($parent_obj->country_id == $country_id) {

                      echo '<option selected="selected" value="' . $parent_obj->country_code . '" data-value="' . $parent_obj->country_id . '"> ' . $parent_obj->country_name . ' (+' . $parent_obj->country_code . ')</option>';
                    } else {

                      echo '<option value="' . $parent_obj->country_code . '" data-value="' . $parent_obj->country_id . '">' . $parent_obj->country_name . ' (+' . $parent_obj->country_code . ')</option>';
                    }
                  }



                  ?>

                </select>

                <input required type="tel" id="member_phone" name="member_phone" minlength="5" maxlength="11" class="form-control box" placeholder="Type Phone Number" value="<?php echo $member_phone ?>" />

                <div id="member_phone_response"></div>

                <?php if (isset($input_error['member_phone'])) {
                  echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_phone'] . '</label>';
                } ?>

              </div> <!-- form-group// -->

            </div>

            <div class="form-group form-label">

              <label for="member_first_name" class="active">First Name *</label>

              <input required type="text" placeholder="First Name" id="member_first_name" name="member_first_name" id="member_first_name" class="form-control box" value="<?php echo $member_first_name ?>" />

              <div id="first_name_response"></div>

              <?php if (isset($input_error['firstname'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['firstname'] . '</label>';
              }



              ?>

            </div>

            <div class="form-group form-label">

              <label for="member_last_name" class="active">Last Name *</label>

              <input required type="text" name="member_last_name" id="member_last_name" class="form-control box" placeholder="Last Name" value="<?php echo $member_last_name ?>" />

              <div id="last_name_response"></div>

              <?php if (isset($input_error['lastname'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['lastname'] . '</label>';
              } ?>

            </div>







            <div class="form-group form-label">

              <label for="member_password" class="active">Password *</label>

              <div class="input-group box" id="show_hide_password">



                <input required id="member_password" onKeyUp="checkPasswordStrength();" type="password" id="member_password" name="member_password" class="form-control " placeholder="Password" value="<?php echo $member_password ?>" autocomplete="off" />



                <div class="input-group-prepend ">

                  <div class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></div>

                </div>



              </div>

              <div id="member_password_response"></div>

              <div id="password-strength-status">

                <?php if (isset($input_error['member_password'])) {
                  echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_password'] . '</label>';
                } ?>

              </div>



            </div>

            <div class="form-group form-label">

              <label for="member_c_password" class="active">Confirm Password *</label>

              <div class="input-group box" id="show_hide_password">



                <input required type="password" name="member_c_password" onKeyUp="checkPasswordStrength2();" id="member_c_password" class="form-control box" placeholder="Confirm Password" value="<?php echo $member_c_password ?>" autocomplete="off" />

                <div class="input-group-prepend ">

                  <div class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></div>

                </div>





              </div>

              <div id="password-c-strength-status">

                <?php if (isset($input_error['member_c_password'])) {
                  echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_c_password'] . '</label>';
                } ?>

              </div>

              <div id="member_c_password_response"></div>







            </div>



            <div class="form-group form-label">

              <label class="active" for="show-regions">Region/States</label>

              <select class="form-control profession select2" required name="region_id" onchange="job_regions_fun(this.value);" id="show-regions">



                <?php

                if (isset($country_id)) {

                  $sql_parent_menu = "SELECT * FROM states where country_id = '" . $country_id . "'";



                  $parent_query = $db->select($sql_parent_menu);

                  while ($parent_obj = mysqli_fetch_object($parent_query)) {

                    if ($parent_obj->states_id == $region_id) {

                      echo '<option selected="selected" value="' . $parent_obj->states_id . '">' . $parent_obj->states_name . '</option>';
                    } else {

                      echo '<option value="' . $parent_obj->states_id . '">' . $parent_obj->states_name . '</option>';
                    }
                  }
                } else {

                  echo '<option>Please select region</option>';
                }



                ?>

              </select>

              <?php if (isset($input_error['region_id'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['region_id'] . '</label>';
              } ?>

            </div>

            <div class="form-group form-label">

              <label class="active" for="show-city">City</label>

              <select name="city_id" class="form-control profession select2" id="show-city">

                <option>Please select city</option>

                <?php

                if (isset($region_id)) {

                  $sql_parent_menu = "SELECT * FROM cities where states_id = '" . $region_id . "'";

                  $parent_query = $db->select($sql_parent_menu);

                  while ($parent_obj = mysqli_fetch_object($parent_query)) {

                    if ($parent_obj->city_id == $city_id) {

                      echo '<option selected="selected" value="' . $parent_obj->city_id . '">' . $parent_obj->city_name . '</option>';
                    } else {

                      echo '<option value="' . $parent_obj->city_id . '">' . $parent_obj->city_name . '</option>';
                    }
                  }
                }

                ?>

              </select>

              <?php if (isset($input_error['city_id'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['city_id'] . '</label>';
              } ?>

            </div>

            <div class="form-group form-label">

              <label for="post_code" class="active">Post Code *</label>

              <input required type="text" placeholder="Post Code" name="post_code" id="post_code" class="form-control box" value="<?php echo $post_code ?>" />

              <div id="post_code_response"></div>

              <?php if (isset($input_error['post_code'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['post_code'] . '</label>';
              }



              ?>

            </div>

            <div class="form-group form-label abs-search-icon">

              <label class="active" for="SignupCurrentLocation">Locate Your Location</label>

              <input type="text" id="SignupCurrentLocation" placeholder="Locate Your Location" name="location" class="form-control box">

              <input id="slat" name="lat" value="" type="hidden">

              <input id="slng" name="lng" value="" type="hidden">

              <input id="sCountry" name="Country" value="" type="hidden">

              <input name="from_page" value="home" type="hidden">

              <div class="range">

                <input id="slider11" class="border-0" type="range" min="0" max="180" />
                <div class="">
                  <span class="distance"> KM</span> <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>
                </div>
              </div>
              <span class="location-track-icon"><i class="fas fa-map-marker-alt "></i></span>
              <span class="search-location "><i class="fas fa-globe location-track-icon"></i></span>
              <!--  <div class="">
                                  </div> -->
            </div>
            <!-- <div class="form-group form-label">
                              <label class="active" for="member_address">Address</label>
                                <input type="text" name="member_address" id="member_address" class="form-control box"  placeholder="Type Your Address" value="<?php echo $member_address ?>" />
                                <?php if (isset($input_error['member_address'])) {
                                  echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_address'] . '</label>';
                                } ?>
                            </div> -->
            <div class="form-group form-label">
              <label class="active" for="categories_id">Your Profession *</label>
              <select required class="form-control profession profession2 selectProfession" name="categories_id">
                <option value="0" selected >Specify Your Profession </option>
                <?php
                $ctg_parent = "SELECT * FROM " . $db_suffix . "categories WHERE categories_parent = '0'";
                $ctg_parent_query = $db->select($ctg_parent);
                while ($ctg_parent_row = mysqli_fetch_object($ctg_parent_query)) :
                ?>
                  <optgroup label="<?php echo $ctg_parent_row->categories_name ?>">
                    <?php $ctg_sql = "SELECT * FROM " . $db_suffix . "categories WHERE categories_parent = '" . $ctg_parent_row->categories_id . "'";
                    $ctg_query = $db->select($ctg_sql);
                    while ($row = mysqli_fetch_object($ctg_query)) :
                      $ctg_sql2 = "SELECT * FROM " . $db_suffix . "categories WHERE categories_parent = '" . $row->categories_id . "'";
                      $ctg_query2 = $db->select($ctg_sql2);
                      $ctg_count  = $ctg_query2->num_rows;
                      if ($ctg_count > 0) {

                    ?>
                  <optgroup label="-<?php echo $row->categories_name ?>">
                    <?php while ($row2 = mysqli_fetch_object($ctg_query2)) : ?>
                      <?php if ($categories_id == $row2->categories_id) : ?>
                        <option value="<?php echo $row2->categories_id ?>">-- <?php echo $row2->categories_id ?></option>
                      <?php else : ?>

                        <option value="<?php echo $row2->categories_id ?>">-- <?php echo $row2->categories_name ?></option>
                      <?php endif ?>
                    <?php endwhile; ?>
                  </optgroup>
                <?php } else { ?>
                  <?php if ($categories_id == $row2->categories_id) : ?>
                    <option value="<?php echo $row->categories_id ?>">- <?php echo $row->categories_name ?></option>
                  <?php else : ?>

                    <option value="<?php echo $row->categories_id ?>">- <?php echo $row->categories_name ?></option>
                  <?php endif ?>
                <?php } ?>
              <?php endwhile; ?>
              </optgroup>
            <?php endwhile; ?>
            <option value="0">Others</option>
            <?php
            if (!is_numeric($categories_id) && $categories_id != "") {
            ?>
              <option selected value="<?php echo $categories_id; ?>"><?php echo $categories_id; ?></option>

            <?php

            }

            ?>
              </select>

              <input type="text" style="margin-top: 10px;" name="member_others_professional" class="form-control others-profession" placeholder="Type Your Profession " value="" />

              <?php if (isset($input_error['categories_id'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['categories_id'] . '</label>';
              } ?>

            </div>



            <div class="form-group form-label">

              <label for="member_experience_year" class="active">Year Of Experience </label>

              <input type="text" name="member_experience_year" maxlength="2" id="member_experience_year" class="form-control box" placeholder="Year Of Experience" value="<?php echo $member_experience_year ?>" />

              <div id="member_experience_year_response"></div>

              <?php if (isset($input_error['member_experience_year'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_experience_year'] . '</label>';
              } ?>

            </div>

            <div class="form-group form-label" style="margin-bottom: 0">

              <label for="member_birth_date" class="active">Age *</label>

              <input required type="text" min="2" maxlength="2" name="member_birth_date" id="member_birth_date" class="form-control" placeholder="Type your age" value="<?php echo $member_birth_date; ?>" />

              <div id="member_birth_date_response"></div>

              <?php if (isset($input_error['member_birth_date'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_birth_date'] . '</label>';
              } ?>





            </div>

            <div class="form-group" style="margin-bottom: 0">

              <div class="maxl checkboxGroup">

                <h6> In which way want to other people contact you. *</h6>



                <?php

                $contact_via = 'required';

                if ($member_contact_email_status == 1  ||  $member_contact_phone_status == 1) {

                  $contact_via = '';
                }

                //echo $member_contact_email;

                //echo $member_contact_phone;

                ?>



                <label class="radio inline">

                  <input type="checkbox" id="member_contact_email" name="member_contact_email[]" value="email" <?php if ($member_contact_email_status == 1) {
                                                                                                                  echo 'checked="checked"';
                                                                                                                }
                                                                                                                echo $contact_via; ?>>

                  <span> Email </span>



                </label>

                <label class="radio inline">

                  <input type="checkbox" id="member_contact_phone" name="member_contact_email[]" value="phone" <?php if ($member_contact_phone_status == 1) {
                                                                                                                  echo 'checked="checked"';
                                                                                                                }
                                                                                                                echo $contact_via; ?>>

                  <span>Phone </span>

                </label>



                <?php if (isset($input_error['member_contact'])) {
                  echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_contact'] . '</label>';
                } ?>

              </div>

            </div>



            <div class="form-group" style="margin-top: 10px">

              <div class="maxl">

                <h6> Gender *</h6>

                <label class="radio inline">

                  <input required type="radio" name="member_gender" value="male" <?php if ($member_gender == 'male') {
                                                                                    echo 'checked';
                                                                                  } ?>>

                  <span> Male </span>

                </label>

                <label class="radio inline">

                  <input type="radio" name="member_gender" <?php if ($member_gender == 'female') {
                                                              echo 'checked';
                                                            } ?> value="female">

                  <span>Female </span>

                </label>

                <label class="radio inline">

                  <input type="radio" name="member_gender" <?php if ($member_gender == 'others') {
                                                              echo 'checked';
                                                            } ?> value="others">

                  <span>Others </span>

                </label>

                <?php if (isset($input_error['member_gender'])) {
                  echo '<label class="ah-input-error" style="color: red;">' . $input_error['member_gender'] . '</label>';
                } ?>

              </div>

            </div>

            <div class="form-group text-center full">

              <div class="maxl">

                <input required type="checkbox" name="agree-option" id="agree-option">

                <label for="agree-option">I agreed to the <a href="<?php echo SITE_URL ?>terms-conditions" class="check_box_anchr">Terms and Conditions</a> governing the use of Member Directory</label>



              </div>

              <?php if (isset($input_error['agree-option'])) {
                echo '<label class="ah-input-error" style="color: red;">' . $input_error['agree-option'] . '</label>';
              } ?>



            </div>



            <div class="col-lg-12">

              <div class="form-group text-center full">

                <input type="submit" name="register-now" class="btnRegister" value="Register" />

              </div>



            </div>

            <div class="col-lg-12">



              <div class="form-group text-center full">

                <div class="maxl">

                  <h6 style="margin-top: 10px;">* We taking your information as encrypted in our system, we don't disclose it. </h6>



                </div>

              </div>

            </div>

          </div>

        </form>



      </div>

    </div>



  </div>

</section>



<script type="text/javascript">
  function checkPasswordStrength() {

    var number = /([0-9])/;

    var alphabets = /([a-zA-Z])/;

    var upalphabets = /([A-Z])/;

    // var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

    //         if ($('#member_password').val().length < 8) {

    //             $('#password-strength-status').removeClass();

    //             $('#password-strength-status').addClass('weak-password');

    //             $('#password-strength-status').html("Weak (should be atleast 8 characters.)");

    // $('#member_password_response').html("");

    //         } 

    if (!$('#member_password').val().match(upalphabets)) {

      $('#password-strength-status').removeClass();

      $('#password-strength-status').addClass('weak-password');

      $('#password-strength-status').html("Weak (should be at least one capital letter.)");

      $('#member_password_response').html("");

    } else {

      if ($('#member_password').val().match(number) && $('#member_password').val().match(alphabets)) {

        $('#password-strength-status').removeClass();

        $('#password-strength-status').addClass('strong-password');

        $('#password-strength-status').html("Strong");

        $('#member_password_response').html("<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>");





      } else {

        $('#password-strength-status').removeClass();

        $('#password-strength-status').addClass('medium-password');

        $('#password-strength-status').html("Medium (should include alphabets and numbers)");

        $('#member_password_response').html("");

      }

    }



  }



  function checkPasswordStrength2() {



    if ($('#member_c_password').val() != $('#member_password').val()) {

      $('#password-c-strength-status').removeClass();

      $('#password-c-strength-status').addClass('weak-password');

      $('#password-c-strength-status').html("Password Mismatch.");

      $('#member_c_password_response').html("");

    } else

    {

      $('#password-c-strength-status').removeClass();

      $('#password-c-strength-status').addClass('strong-password');

      $('#password-c-strength-status').html("Password Matches.");

      $('#member_c_password_response').html("<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>");

    }



  }
</script>

<script>
  $('#country_id').on('change', function() {

    if (this.value == "0") {



      $(".countrycode").val("0").change();

      $(".countrycode").trigger('change.select2');

    } else {

      $(".countrycode option:selected").each(function() {

        $(this).removeAttr('selected');

      });

      $(".countrycode option[data-value='" + this.value + "']").prop("selected", true);;

      $(".countrycode").trigger('change.select2');

    }

    my_fun(this.value);



  });
</script>

<script>
  function my_fun(str) {



    if (window.XMLHttpRequest) {

      xmlhttp = new XMLHttpRequest();



    } else {

      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");



    }



    xmlhttp.onreadystatechange = function() {



      if (this.readyState == 4 && this.status == 200) {

        // alert(str);

        document.getElementById('show-regions').innerHTML = this.responseText;

      }

    }

    xmlhttp.open("GET", "<?php echo SITE_URL ?>inc/load_location.php?value=" + str, true);

    xmlhttp.send();



    if (window.XMLHttpRequest) {

      xmlhttp = new XMLHttpRequest();



    } else {

      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");



    }



    xmlhttp.onreadystatechange = function() {



      if (this.readyState == 4 && this.status == 200) {

        // alert(str);

        document.getElementById('show-code').innerHTML = this.responseText;

      }

    }

    xmlhttp.open("GET", "<?php echo SITE_URL ?>inc/load_location.php?valuecode=" + str, true);

    xmlhttp.send();



  }



  function job_regions_fun(str) {

    // alert(str)

    if (window.XMLHttpRequest) {

      xmlhttp = new XMLHttpRequest();

    } else {

      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

    }



    xmlhttp.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

        document.getElementById('show-city').innerHTML = this.responseText;

      }

    }

    xmlhttp.open("GET", "<?php echo SITE_URL ?>inc/load_location.php?value2=" + str, true);

    xmlhttp.send();



  }
</script>

<script>
  $(document).ready(function() {

    $("#txt_username").keyup(function() {

      var username = $(this).val().trim();

      if (username != '') {

        $.ajax({

          url: '<?php echo SITE_URL ?>inc/chk_username.php',

          type: 'post',

          data: {
            username: username
          },

          success: function(response) {

            $('#uname_response').html(response);

          }

        });

      } else {

        $("#uname_response").html("");

      }

    });

    $("#member_first_name").keyup(function() {

      var member_first_name = $(this).val().trim();

      if (member_first_name != '') {

        $.ajax({

          url: '<?php echo SITE_URL ?>inc/chk_name.php',

          type: 'post',

          data: {
            member_first_name: member_first_name
          },

          success: function(response) {

            $('#first_name_response').html(response);

          }

        });

      } else {

        $("#first_name_response").html("");

      }

    });

    $("#member_last_name").keyup(function() {

      var member_last_name = $(this).val().trim();

      if (member_last_name != '') {

        $.ajax({

          url: '<?php echo SITE_URL ?>inc/chk_name.php',

          type: 'post',

          data: {
            member_last_name: member_last_name
          },

          success: function(response) {

            $('#last_name_response').html(response);

          }

        });

      } else {

        $("#last_name_response").html("");

      }

    });

    $("#member_email").keyup(function() {

      var email = $(this).val().trim();

      // alert('email')

      if (email != '') {

        $.ajax({

          url: '<?php echo SITE_URL ?>inc/chk_email.php',

          type: 'post',

          data: {
            email: email
          },

          success: function(response) {

            $('#email_response').html(response);

          }

        });

      } else {

        $("#email_response").html("");

      }

    });

    /*$("#member_password").keyup(function(){

       var member_password = $(this).val().trim();

       // alert('email')

       if(member_password != ''){

          $.ajax({

             url: '<?php echo SITE_URL ?>inc/chk_validation.php',

             type: 'post',

             data: {member_password: member_password},

             success: function(response){

                 $('#member_password_response').html(response);

              }

          });

       }else{

          $("#member_password_response").html("");

       }

     });

     $("#member_c_password").keyup(function(){

       var member_c_password = $(this).val().trim();

       var member_password_c = $('#member_password').val().trim();

       // alert(member_password_c)

       if(member_c_password != ''){

          $.ajax({

             url: '<?php echo SITE_URL ?>inc/chk_validation.php',

             type: 'post',

             data: {member_c_password: member_c_password, member_password_c: member_password_c},

             success: function(response){

                 $('#member_c_password_response').html(response);

              }

          });

       }else{

          $("#member_c_password_response").html("");

       }

     });*/

    $("#post_code").keyup(function() {

      var post_code = $(this).val().trim();

      // alert(member_password_c)

      if (post_code != '') {

        $.ajax({

          url: '<?php echo SITE_URL ?>inc/chk_validation.php',

          type: 'post',

          data: {
            post_code: post_code
          },

          success: function(response) {

            $('#post_code_response').html(response);

          }

        });

      } else {

        $("#post_code_response").html("");

      }

    });

    $("#member_birth_date").keyup(function() {

      var member_birth_date = $(this).val().trim();

      if (member_birth_date != '') {

        $.ajax({

          url: '<?php echo SITE_URL ?>inc/chk_validation.php',

          type: 'post',

          data: {
            member_birth_date: member_birth_date
          },

          success: function(response) {

            $('#member_birth_date_response').html(response);

          }

        });

      } else {

        $("#member_birth_date_response").html("");

      }

    });

    $("#member_experience_year").keyup(function() {

      var member_experience_year = $(this).val().trim();

      if (member_experience_year != '') {

        $.ajax({

          url: '<?php echo SITE_URL ?>inc/chk_validation.php',

          type: 'post',

          data: {
            member_experience_year: member_experience_year
          },

          success: function(response) {

            $('#member_experience_year_response').html(response);

          }

        });

      } else {

        $("#member_birth_date_response").html("");

      }

    }); 
    $("#member_phone").keyup(function() {

      var member_phone = $(this).val().trim();

      // alert(member_phone);

      if (member_phone != '') {

        $.ajax({

          url: '<?php echo SITE_URL ?>inc/chk_validation.php',

          type: 'post',

          data: {
            member_phone: member_phone
          },

          success: function(response) {

            $('#member_phone_response').html(response);

          }

        });

      } else {

        $("#member_phone_response").html("");

      }

    }); 

    var requiredCheckboxes = $('.checkboxGroup :checkbox');

    requiredCheckboxes.change(function() {

      if (requiredCheckboxes.is(':checked')) {

        requiredCheckboxes.removeAttr('required');

      } else {

        requiredCheckboxes.attr('required', 'required');

      }

    }); 

  });
</script>

<script type="text/javascript">
  $(document).ready(function() { 

    $("#show_hide_password a").on('click', function(event) {

      event.preventDefault();

      if ($('#show_hide_password input').attr("type") == "text") {

        $('#show_hide_password input').attr('type', 'password');

        $('#show_hide_password svg').addClass("fa-eye-slash");

        $('#show_hide_password svg').removeClass("fa-eye");

      } else if ($('#show_hide_password input').attr("type") == "password") {

        $('#show_hide_password input').attr('type', 'text');

        $('#show_hide_password svg').removeClass("fa-eye-slash");

        $('#show_hide_password svg').addClass("fa-eye");

      }

    });

  });
</script>



<script type="text/javascript">
  $('body').on('change', '.profession', function() { 
    var relgtype = $(".profession2 option:selected").text(); 
    if (relgtype == "Others") { 
      $('.others-profession').addClass('show'); 
    } else { 
      $('.others-profession').removeClass('show');

    } 
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#member_email").focus();

  });
</script>

<script type="text/javascript">



</script>

<?php

require_once('common/footer.php');

?>