<?php
// require_once('function.php');
require_once('config/dbconnect.php');

function create_slug($string){

	 $slug=strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));

	 return $slug;

}

	echo $sql1 = "SELECT * FROM ".$db_suffix."categories";

	// $categories_obj = $db->select($sql1);
	$banner_query = mysqli_query($db,$sql1);



	while($subcat_obj = mysqli_fetch_object($banner_query)){

		 // $categories_slug = create_slug($categories_name);

			echo $slug = $subcat_obj->categories_name ;

			echo "<br>";

			echo $ctg_slug2 = create_slug($slug);

			$sql3 = "SELECT * FROM ".$db_suffix."categories";

			$banner_query3 = mysqli_query($db,$sql3);
			while($subcat_obj2 = mysqli_fetch_object($banner_query3)){
					$categories_slug =  $subcat_obj2->categories_slug;
					if($ctg_slug == $categories_slug){
						$ctg_slug = "sub_".$ctg_slug2;
						echo $sql2 = "UPDATE `dir_categories` SET 

						`categories_slug`= '".$ctg_slug."'  WHERE categories_id = '".$subcat_obj->categories_id."'";

						//  $db->update($sql2);
						mysqli_query($db,$sql2);
					}else{
						$ctg_slug = $ctg_slug2;
						echo $sql2 = "UPDATE `dir_categories` SET 

						`categories_slug`= '".$ctg_slug."'  WHERE categories_id = '".$subcat_obj->categories_id."'";

						//  $db->update($sql2);
						mysqli_query($db,$sql2);
					}
			}

			echo "<br>";

		// echo $ctg_slug;

		

	}

// echo $ctg_slug ;

// */

?>