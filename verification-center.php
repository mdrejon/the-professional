<?php 
session_start();
require_once('common/header.php');
$member_id = $_SESSION['member_id'];
if (!isset($_SESSION['member_id'])) {
  header('location:sign-in');
}
// else{
//    $chk_varifaction_center = "SELECT * FROM ".$db_suffix."member_verification WHERE member_id = '$member_id' limit 1";  
//   $chk = $db->select($chk_varifaction_center);
  
//   if(count($chk) > 0){
//     $status = mysqli_fetch_object($chk);
//     print_r($member);
//     if($status->verification_status == 'approve'){
      
//     }

//   }
  
// }
// header("Location:verification-sucsess");

// $verification_identity_type = '';
// $verification_identity_number = '';
// $verification_address_country = '';
// $verification_address_type = '';
// $verification_address_number = '';
// $verification_address_expiration = '';
// $verification_status = 'pending';
// $verification_apply_date = date('y-m-d');
// $verification_update_date = date('y-m-d');
// $update_by = '';
// $err = 0;
 $input_error = array();

// $messages = array(

//           'verification_identity_type' => array('status' => 'validate_error', 'msg' => ''),
//           'verification_identity_number' => array('status' => 'validate_error', 'msg' => ''),
//           'verification_identity_front' => array('status' => 'validate_error', 'msg' => ''),
//           'verification_identity_back' => array('status' => 'validate_error', 'msg' => ''),
//           'verification_address_country' => array('status' => 'validate_error', 'msg' => ''),
//           'verification_address_type' => array('status' => 'validate_error', 'msg' => ''),
//           'verification_address_number' => array('status' => 'validate_error', 'msg' => ''),
//           'verification_address_expiration' => array('status' => 'validate_error', 'msg' => ''),
//           'verification_address_file' => array('status' => 'validate_error', 'msg' => ''),
//         );  
// $msg = array("status" => "error1","msg" => "");
if (isset($_POST['submit'])) {
    // echo "data Get";
    $verification_identity_type = $_POST['verification_identity_type'];
    $verification_identity_number = $_POST['verification_identity_number'];
    // $verification_identity_front = $_POST['verification_identity_front'];
    // $verification_identity_back = $_POST['verification_identity_back'];
    $verification_identity_country = $_POST['verification_identity_country'];
    $verification_address_type = $_POST['verification_address_type'];
    $verification_address_number = $_POST['verification_address_number'];
    $verification_address_expiration = $_POST['verification_address_expiration'];
    $verification_status = 'pending';
    $verification_apply_date = date('y-m-d');
    $verification_update_date = date('y-m-d');
    $update_by = '';
    // $verification_address_file = $_POST['verification_address_file'];
    // $verification_status = $_POST['verification_status'];

    if (empty($verification_identity_type)) {
       $input_error['verification_identity_number']="Identity type requird";
      }
    if (empty($verification_identity_country)) {
       $input_error['verification_identity_country']="Country requird";
      }
    if (empty($verification_identity_number)) {
       $input_error['verification_identity_number']="Identity number requird";
      }
    if (preg_match("/[^0-9\_-]/i", $verification_identity_number)) {
        $input_error['verification_identity_number']="Identity number should be number";

     }

    $verification_identity_front ='';
    if($_FILES['verification_identity_front']['name'] != '')
    {

      $verification_identity_front = rand(10, 1000)."-".$_FILES['verification_identity_front']['name'];
      $image_temp =$_FILES['verification_identity_front']['tmp_name'];
      $image_dir = "member/images/verification/";
      $move_img = $image_dir.$verification_identity_front;
      move_uploaded_file($image_temp, $move_img);

    }
    $verification_identity_back ='';
    if($_FILES['verification_identity_back']['name'] != '')
    {

      $verification_identity_back = rand(10, 1000)."-".$_FILES['verification_identity_back']['name'];
      $image_temp =$_FILES['verification_identity_back']['tmp_name'];
      $image_dir = "member/images/verification/";
      $move_img = $image_dir.$verification_identity_back;
      move_uploaded_file($image_temp, $move_img);

    }
    $verification_address_file ='';
    if($_FILES['verification_address_file']['name'] != '')
    {

      $verification_address_file = rand(10, 1000)."-".$_FILES['verification_address_file']['name'];
      $image_temp =$_FILES['verification_address_file']['tmp_name'];
      $image_dir = "member/images/verification/";
      $move_img = $image_dir.$verification_address_file;
      move_uploaded_file($image_temp, $move_img);

    } 
     if (count($input_error)==0) {
     $sql = "INSERT INTO ".$db_suffix."member_verification ( member_id, verification_identity_type, verification_identity_number, verification_identity_front, verification_identity_back, verification_address_country, verification_address_type, verification_address_number, verification_address_expiration, verification_address_file,   verification_status, verification_apply_date, verification_update_date, verification_identity_country, update_by)

      VALUES ('$member_id','$verification_identity_type', '$verification_identity_number', '$verification_identity_front','$verification_identity_back', '$verification_identity_country', '$verification_address_type', '$verification_address_number', '$verification_address_expiration','$verification_address_file','$verification_status', '$verification_apply_date', '$verification_update_date', '$verification_identity_country', '$member_id')";
       $result = $db->insert($sql);
       if ($result) {
         $sucsess  = 1;
       }
       // header("Location:verification-sucsess.php ");
       // echo '<script>window.location="verification-sucsess";</script>';
       
  }

}

?>
<style type="text/css">
  
.setup-content .user-chk {
  top: 38px !important;
}
.setup-content .form-group {
  position: relative;
}.single-side-profile .form-group select{
  padding: 0 10px !important;
}
</style>
<!-- Steps form -->
<section class="v-center section-padding">
  <div class="container">
    <div class="row">
      <!-- <div class="col-lg-4">
        
      </div> -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="single-side-profile">
          <?php 
             $varification_sql = "SELECT * FROM ".$db_suffix."member_verification WHERE member_id = '".$member_id."' limit 1";  
            $varification_query = $db->select($varification_sql);
            $result = mysqli_fetch_object($varification_query);

          if ($result->member_id == $member_id && $result->verification_status == 'pending'): ?>
            <div class="alert alert-warning text-center" role="alert">
                We received your Identity verification documents, our team will reviewed and take necessary actions.
            </div>
          <?php elseif($result->member_id == $member_id && $result->verification_status == 'approve'): ?>  
            <div class="alert alert-success text-center" role="alert">
                Your Identity verification already approved.
            </div>
          <?php else: ?>
         
          <?php if ($sucsess  == 1): ?>
            <div class="alert text-center alert-primary" role="alert">
            Thanks for submitting your Identity. We review it as early as possibale
           </div>
          <?php else: ?>
          <div class="card">
            <div class="card-body mb-4">
              <?php echo  $sucsess; ?>
              <h2 class="text-center font-weight-bold pt-4 pb-5"><strong>Identity Verification Center</strong></h2>

              <!-- <hr class="my-5"> -->
              <!-- Stepper -->
              <div class="steps-form">
                <div class="steps-row setup-panel">
                  <div class="steps-step">
                    <a href="#step-9" type="button" class="btn btn-indigo btn-circle">1</a>
                    <p>Proof Of Identity</p>
                  </div>
                 <!--  <div class="steps-step">
                    <a href="#step-10" type="button" class="btn btn-primary btn-circle" disabled="disabled">2</a>
                    <p>Proof Of Address</p>
                  </div> -->
                  <!-- <div class="steps-step">
                    <a href="#step-11" type="button" class="btn btn-primary btn-circle" disabled="disabled">3</a>
                    <p>Step 3</p>
                  </div> -->
                </div>
              </div>

              <form role="form" action="" method="POST" enctype="multipart/form-data">

                <!-- First Step -->
                <div class="row setup-content" id="step-9">
                  <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>Proof Of Identity</strong></h3>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-12 col-sm-12">
                        <div class="form-group md-form">
                          <label for="verification_identity_type " data-error="wrong" data-success="right">Identity Type</label>
                          <select id="verification_identity_type " required name="verification_identity_type" class="form-control validate">
                            <option selected value="">Select One</option>
                            <option value="National ID Card">National ID Card </option>
                            <option value="Passport">Passport </option>
                            <option value="Driver's License">Driver's License </option>
                            <option value="Tax ID">Tax ID </option>
                            <option value="Govt. Issued Health Cards">Govt. Issued Health Cards </option>
                            <option value="Others Govt. Issued">Others Govt. Issued </option>
                          </select>

                           <?php if (isset($input_error['verification_identity_type'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['verification_identity_type'].'</label>' ; } ?>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-12 col-sm-12">
                        <div class="form-group md-form">
                          <label for="verification_identity_number" data-error="wrong" data-success="right">Identity Number</label>
                          <input id="verification_identity_number" required placeholder="Identity Number" type="text" name="verification_identity_number" class="form-control validate">
                          <div id="verification_identity_number_response"></div>
                          <?php if (isset($input_error['verification_identity_number'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['verification_identity_number'].'</label>' ; } ?>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-12 col-sm-12">
                        <div class="form-group md-form">
                          <label for="verification_identity_country" data-error="wrong" data-success="right">Select Country</label>
                              <!-- <label class="active" for="country_id">Select Country</label> -->
                                <select required class="form-control profession select2" id="verification_identity_country" name="verification_identity_country">
                                    <option selected value="">Please select Country</option>
                                   
                                    <?php
                                           $sql_parent_menu = "SELECT * FROM countries";

                                           $parent_query = $db->select($sql_parent_menu);
                                          while($parent_obj = mysqli_fetch_object($parent_query))
                                          {
                                            if($parent_obj->country_id == $country_id)

                                            {
                                              echo '<option selected="selected" value="'.$parent_obj->country_id.'">'.$parent_obj->country_name.'</option>';
                                            }
                                            else

                                            {
                                              echo '<option value="'.$parent_obj->country_id.'">'.$parent_obj->country_name.'</option>';
                                            }
                                          }

                                    ?>
                                </select>
                                <?php if (isset($input_error['verification_identity_country'])){ echo '<label class="ah-input-error" style="color: red;">'.$input_error['verification_identity_country'].'</label>' ; } ?>
                           
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12 col-sm-12" >
                        <div class="form-group md-form">
                         <label for="verification_identity_front" data-error="wrong" data-success="right">Front Side Of ID Card</label>
                          <input type="file" id="verification_identity_front" required name="verification_identity_front" class="validate form-control dropify" />
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12 col-sm-12" >
                       <div class="form-group md-form">
                         <label for="verification_identity_back" data-error="wrong" data-success="right">Back Side Of ID Card</label>
                          <input type="file" id="verification_identity_back" required name="verification_identity_back" class="validate form-control dropify" />
                        </div>
                      </div>
                    </div>
                    
                    
                    <button class="btn btn-submit btn-rounded float-right" name="submit" type="Submit">Submit</button>
                  </div>
                </div>
              </form>
<?php /*
                <!-- Second Step -->
                <div class="row setup-content" id="step-10">
                  <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>Proof Of Address</strong></h3>

                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="form-group md-form">
                          <label for="verification_address_country" data-error="wrong" data-success="right">ID Issuing Country</label>
                          <select id="verification_address_country" name="verification_address_country" class="form-control validate">
                            <option value="Bangladesh">Bangladesh </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="form-group md-form">
                          <label for="verification_address_type" data-error="wrong" data-success="right">ID Issuing Type</label>
                          <select id="verification_address_type" name="verification_address_type" class="form-control validate">
                            <option value="Utility">Utility </option>
                            <option value="Gas Bill">Gas Bill </option>
                            <option value="Electricity Bill">Electricity Bill </option>
                            <option value="Bank Statement">Bank Statement </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="form-group md-form">
                          <label for="verification_address_number" data-error="wrong" data-success="right">ID Number</label>
                          <input id="verification_address_number" type="text" name="verification_address_number" class="form-control validate">
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="form-group md-form mt-3" style="margin-top: 0 !important;">
                          <label for="verification_address_expiration" data-error="wrong" data-success="right">Id Expiration Date</label>
                          <input id="verification_address_expiration" name="verification_address_expiration" type="date"  class="form-control validate">
                        </div>
                      </div>
                    </div>
                    <div class="form-group md-form" >
                     <label for="verification_address_file" data-error="wrong" data-success="right">ID Issuing File</label>
                      <input type="file" id="verification_address_file" name="verification_address_file" class="validate form-control dropify" />
                    </div>
                   
                    <button class="btn btn-submit btn-rounded prevBtn float-left" type="button">Previous</button>
                    <button class="btn btn-submit btn-rounded nextBtn float-right" name="submit" type="submit">Submit</button>
                  </div>
                </div> */?>

            

            </div>
          </div>
        <?php endif; ?>
        <?php endif; ?>
        </div>
      </div>
  </div>
</section>
<!-- Steps form -->
<script type="text/javascript">
  
$(document).ready(function(){
    $("#verification_identity_number").keyup(function(){
      var verification_identity_number = $(this).val().trim();
      // alert(member_phone);
      if(verification_identity_number != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {verification_identity_number: verification_identity_number},
            success: function(response){
                $('#verification_identity_number_response').html(response);
             }
         });
      }else{
         $("#verification_identity_number_response").html("");
      }
    });

 });
</script>

<?php 
require_once('common/footer.php');

?>

