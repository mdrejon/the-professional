<?php

require_once('../function.php');
$db = new database();

  $categories_parent  = $_GET["value"];

if (!empty($categories_parent)) {
   $sql="SELECT * FROM dir_categories WHERE categories_parent  ='".$categories_parent."'";
	$result = $db->select($sql);

if (mysqli_num_rows($result)>0) {

	?> 
  <option value="0" selected hidden>Select One Sub Categories  </option>
  <?php
  while ($rows= mysqli_fetch_assoc($result)) {
    ?>
   <option value="<?php echo $rows['categories_id'] ?>"><?php echo $rows['categories_name'] ?></option>
    <?php
  }


   
} else {
  echo "
      <option>No Sub Categories Found</option>
   ";
}
}
$regions_id  = $_GET["value2"];

if (!empty($regions_id)) {
	  $sql="SELECT * FROM cities WHERE states_id ='".$regions_id."'";
	$result = $db->select($sql);
if (mysqli_num_rows($result)>0) {
  while ($rows= mysqli_fetch_assoc($result)) {
    ?>
   <option value="<?php echo $rows['city_id'] ?>"><?php echo $rows['city_name'] ?></option>
    <?php
  }
} else {
  echo "
      <option>Select One City </option>
   ";
}

}

?>