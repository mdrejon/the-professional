<?php
require_once('../function.php');
$db = new database();

$country_id  = $_GET["value"];

if (!empty($country_id)) {
  $sql="SELECT * FROM states WHERE country_id  ='".$country_id."'";
	$result = $db->select($sql);

if (mysqli_num_rows($result)>0) {

	?> <?php
  echo "<option >Please select region</option>";
  while ($rows= mysqli_fetch_assoc($result)) {
    ?>
   <option value="<?php echo $rows['states_id'] ?>"><?php echo $rows['states_name'] ?></option>
    <?php
  }


   
} else {
 echo "<option >Please select region</option>";
}
}
$regions_id  = $_GET["value2"];

if (!empty($regions_id)) {

	  $sql="SELECT * FROM cities WHERE states_id ='".$regions_id."'";
	$result = $db->select($sql);
if (mysqli_num_rows($result)>0) {
  echo "<option >Please select city</option>";
  while ($rows= mysqli_fetch_assoc($result)) {
    ?>
   <option value="<?php echo $rows['city_id'] ?>"><?php echo $rows['city_name'] ?></option>
    <?php
  }
} else {
  echo "<option >Please select city</option>";
}

}

$country_code_id  = $_GET["valuecode"];
if (!empty($country_code_id)) {
    $sql="SELECT * FROM countries";
  $result = $db->select($sql);
if (mysqli_num_rows($result)>0) {
	?>
<option>Choose Code </option>	
	<?php
  while ($rows= mysqli_fetch_assoc($result)) {
    ?>

    <?php if ($country_code_id == $rows['country_id']): ?>
       <option selected value="<?php echo $rows['country_code'] ?>"><?php echo $rows['country_name']  ?> (+<?php echo $rows['country_code'] ?>) </option>
    <?php else: ?>
   <option value="<?php echo $rows['country_code'] ?>"><?php echo $rows['country_name']  ?> (+<?php echo $rows['country_code'] ?>) </option>
   <?php endif ?>
    <?php
  }
} else {
  echo "
      <option>Select Country Code </option>
   ";
}

}

?>