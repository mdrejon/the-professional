<?php
$keyword = strval($_POST['query']);
// $search_param = "%{$keyword}%";
$search_param = "%{$keyword}%";
	$db = new mysqli("localhost","hostlive_directory","ls)A=}_4(8Lk","hostlive_directory");

$sql = $db->prepare("SELECT * FROM dir_categories WHERE categories_name LIKE ?");
$sql->bind_param("s",$search_param);
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  $countryResult[] = $row["categories_name"];
  }
  echo json_encode($countryResult);
}
$db->close();

?>
