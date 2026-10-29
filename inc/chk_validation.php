<?php
require_once('../function.php');
$db = new database();


if(isset($_POST['member_password'])){
   
    $passlength =  strlen($_POST['member_password']);
    if ($passlength < 7) {
      // $response .= "<span class='bottom' style='color: red;'>password at least 7 char</span>";
      // $input_error['member_password']="password at least 7 char";
    }else{
      if (preg_match('/\s/', $_POST['member_password'])) {
      // echo "password has whitespace";
         $response .= "<span class='bottom' style='color: red;'>password has whitespace</span>";
       }
      else{
         $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
       }
    }
   
   // if ($row > 0) {
   //    // $response = "<span style='color: red;'>Not Available.</span>";
   //    
   // }else{
   //    // $response = "<span style='color: green;'>Available.</span>";
   //    $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
   // }

   echo $response;
   die;
}
if(isset($_POST['member_c_password'])){
   
      if ($_POST['member_c_password'] !== $_POST['member_password_c']) {
        // $input_error['member_c_password']="confirm password not match";
         // $response .= "<span class='bottom' style='color: red;'>confirm password not match</span>";
      }else{
         $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
      }
   

   echo $response;
   die;
}
if(isset($_POST['post_code'])){
   

       if (!preg_match("/^([a-zA-Z0-9' -]+)$/", $_POST['post_code'])) {
         $response .= "<span class='bottom' style='color: red;'>Please enter valid postal code</span>";
       }
       else{
         $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
       }
       

   echo $response;
   die;
}
if(isset($_POST['member_birth_date'])){
   
   if (preg_match("/[^0-9\_-]/i", $_POST['member_birth_date'])) {
      $response .= "<span class='bottom' style='color: red;'>Age should be in  number </span>";

   } 
      else{

         if ($_POST['member_birth_date'] < 18 || $_POST['member_birth_date'] > 85) {
             $response .= "<span class='bottom' style='color: red;'>Age should between 18 to 85</span>";
          }
          else{
            $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>"; 
          }
      }
       
   echo $response;
   die;
}
if(isset($_POST['member_experience_year'])){
   
   if (preg_match("/[^0-9\_-]/i", $_POST['member_experience_year'])) {
      $response .= "<span class='bottom' style='color: red;'>Year Of Experience should be in number</span>";

   }
      else{

         if ($_POST['member_experience_year'] < 0 || $_POST['member_experience_year'] > 99) {
             $response .= "<span class='bottom' style='color: red;'>Year Of Experience should between 0 to 99</span>";
          }
          else{
            $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
          }
      }
       

       

   echo $response;
   die;
}
if(isset($_POST['member_phone'])){
   
   if (preg_match("/[^0-9\_-]/i", $_POST['member_phone'])) {
      $response .= "<span class='bottom' style='color: red;'>Mobile number should be number </span>";

   }
    else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
    }

       

   echo $response;
   die;
}
if(isset($_POST['verification_identity_number'])){
   
   if (preg_match("/[^0-9\_-]/i", $_POST['verification_identity_number'])) {
      $response .= "<span class='bottom' style='color: red;'>Identity number should be number </span>";

   }
    else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
    }

       

   echo $response;
   die;
}


// job_salary_response
if(isset($_POST['job_salary'])){
   
   if (preg_match("/[^0-9\_-]/i", $_POST['job_salary'])) {
      $response .= "<span class='bottom' style='color: red;'>Amount should be  in number </span>";

   }
    else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
    }

       

   echo $response;
   die;
}
// job_salary_response
// job_vacanciess
if(isset($_POST['job_vacanciess'])){
   
   if (preg_match("/[^0-9\_-]/i", $_POST['job_vacanciess'])) {
      $response .= "<span class='bottom' style='color: red;'>Vacancy should be  in number </span>";

   }
    else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
    }

       

   echo $response;
   die;
}
// job_vacanciess
// job_title
if(isset($_POST['job_title'])){
   // echo "hello";
   if (!isName($_POST['job_title'])) {
      $response .= "<span class='bottom' style='color: red;'>Title should be alphabet </span>";

   }
    else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
    }

       

   echo $response;
   die;
}
// job_title
// job_company
if(isset($_POST['job_company'])){
   // echo "hello";
   if (!isName($_POST['job_company'])) {
      $response .= "<span class='bottom' style='color: red;'>Company Name should be alphabet </span>";

   }
    else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i> </span>";
    }

       

   echo $response;
   die;
}
// job_company

if(isset($_POST['login_email'])){

    if (!preg_match("/[^0-9\_-]/i", $_POST['login_email'])) {
       $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";

   }
  else if(filter_var($_POST['login_email'], FILTER_VALIDATE_EMAIL) === false){ //email validation
              $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }

   else{
         // $response = "<span style='color: green;'>Available.</span>";
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
   }
   
       

   echo $response;
   die;
}

if(isset($_POST['member_religion'])){
  if(!isName($_POST['member_religion'])){
     $response .= "<span class='user-chk' style='color: red;'><i class='fas fa-times-circle'></i></span>";
   }   
   else{
      $response .= "<span class='user-chk' style='color: green;'><i class='fas fa-check-circle'></i></span>";
   }
   echo $response;
   die;
}