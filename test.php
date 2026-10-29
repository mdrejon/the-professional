<?php
require_once('config/dbconnect.php'); 
function getCategoryTreeIDs($db,$catID) {
        $row = $db->query("SELECT categories_parent FROM dir_categories WHERE categories_id = '$catID'")->fetch();
        $path = array();
        if (!$row['categories_parent'] == 0) {
            $path[] = $row['categories_parent'];
            $path = array_merge($this->getCategoryTreeIDs($row['categories_parent']), $path);
        }
        return $path;
    }

function showCatBreadCrumb($db,$catID) {
 
        $array = $this->getCategoryTreeIDs($db,$catID);
 
        $numItems = count($array);
        for ($i = 0; $i<=$numItems-1; $i++) {
            echo $this->getNameLink($array[$i]) . ' &raquo; ';
        }
    }
	$catID=10;
	showCatBreadCrumb($db,$catID);
//require_once('function.php');



/**

Validate an email address.

Provide email address (raw input)

Returns true if the email address has the email 

address format and the domain exists.

*/

function validEmail($email)

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

(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',

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





function isEmail($email){



  $regExp = '/^\w+@[\w\d.-]{2, }(\.)([a-zA-Z]+)$/iU';

 // $regExp = '/^\[A-Za-z0-9._-]+@[\w\d.-]{2, }(\.)([a-zA-Z]+)$/iU';

  

  return preg_match($regExp, $email) ? TRUE : FALSE;

}

$e = "elias.jabed@gmailfff.com";

if(validEmail($e)){

	echo "Yes";

}

else echo "NO";

/*

function StrongPassword($password){

// Given password





// Validate password strength

$uppercase = preg_match('@[A-Z]@', $password);

$lowercase = preg_match('@[a-z]@', $password);

$number    = preg_match('@[0-9]@', $password);

$specialChars = preg_match('@[^\w]@', $password);

if(strlen($password) < 8){

	//echo "Password should be at least 8 characters in length";

	return false;

}

else if(!$uppercase) {

	return false; //echo "Password should be at least one upper case letter";

}

else if(!$lowercase) {

	return false;//echo "Password should be at least one lower case letter";

}

else if(!$number) {

	return false;//echo "Password should be at least one number";

}

else if(!$specialChars) {

	return false;//echo "Password should be at least one special character";

}



elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6) {

    return false;//echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';

}else{

    return true;//echo 'Strong password.';

}

}

$password = 'aaaaaaaaa1Adfgdfg#';

StrongPassword($password);*/

/*



// session_start();

//require_once('common/header.php');



function create_slug($string){

	 $slug=strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));

	 return $slug;

}

	$sql1 = "SELECT * FROM ".$db_suffix."categories";

	$categories_obj = $db->select($sql1);



	while($subcat_obj = mysqli_fetch_object($categories_obj)){

		 // $categories_slug = create_slug($categories_name);

		echo $slug = $subcat_obj->categories_name ;

		echo "<br>";

		echo $ctg_slug = create_slug($slug);

		echo "<br>";

		echo $ctg_slug;

		echo $sql2 = "UPDATE `dir_categories` SET 

		`categories_slug`= '".$ctg_slug."'  WHERE categories_id = '".$subcat_obj->categories_id."'";

		 $db->update($sql2);

	}

echo $ctg_slug ;

*/

?>



<!-- <html lang="en">

<head>

<meta charset="utf-8">

<title>Detect the Enter Key in a Text Input Field with jQuery</title>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>

    $(document).on("keypress", "input", function(e){

        if(e.which == 13){

            var inputVal = $(this).val();

            alert("You've entered: " + inputVal);

        }

    });

</script>

</head>

<body>

    <p><strong>Note:</strong> Type something in the text input box and press enter key.</p>      

    <p><input type="text"></p>      

</body>

</html>

 -->



<?php

//require_once('common/footer.php');

?>