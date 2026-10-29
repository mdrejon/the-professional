
                <?php if (isset($_POST['person_registration'])){

                  if(!empty($_POST['job_type'])) {
                  }
                  else{
                  echo "<b>Please Select Atleast One Option.</b>";

                  }


              $name  =  $_POST['username'];
              $email  =  $_POST['email'];
              $password  =  $_POST['pswd'];
              $c_password  =  $_POST['pswdtwo'];
              $c_location  =  $_POST['current_location'];
              $phone  =  $_POST['phone'];
              $file_name = $_FILES['file']['name'];
              $file_size = $_FILES['file']['size'];


              // make slug for file name
              function create_slug($string){
                 $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
                 return $slug;
              }
              $slugname = create_slug($name);

              $file_explode=explode('.',$_FILES['file']['name']) ;
              $file_extension = end($file_explode);
              $final_filename=$slugname.'.'.$file_extension;
              echo $final_filename;



              $input_error=array();
              if (empty($name)) {
                $input_error['name']="name requird";
              }
              if (empty($email)) {
                $input_error['email']="email requird";
              }

              if (empty($password)) {
                $input_error['password']="password requird";
              }
              if (empty($c_password)) {
                $input_error['c_password']="c_password requird";
              }

















              $db = mysqli_connect("localhost", "root", "", "academic_hub");


              if($db === false){
                  die("ERROR: Could not connect. " . mysqli_connect_error());
              }


              $sql = "INSERT INTO ah_candidate (candidate_first_name,candidate_last_name) VALUES ('$name', '$email')";
              if(mysqli_query($db, $sql)){
                  echo "Records inserted successfully.";
              } else{
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
              }


              mysqli_close($db);






                }

                ?>
