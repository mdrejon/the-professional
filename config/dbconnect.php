<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();
date_default_timezone_set('Etc/GMT-6');

// define('DB_HOST', 'localhost');
// define('DB_USER', 'nd85bf5_website_db_user');
// define('DB_PASS', 'ls)A=}_4(8Lk');
// define('DB_NAME', 'nd85bf5_website_db');


// $connect = new PDO("mysql:host=localhost;dbname=nd85bf5_website_db", "nd85bf5_website_db_user", "ls)A=}_4(8Lk");

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'the_professional');


$connect = new PDO("mysql:host=localhost;dbname=the_professional", "root", "");
date_default_timezone_set('Europe/Zagreb');
// // // // // // // // // // // // // // // // // // //
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$db_name = DB_NAME;



$db = mysqli_connect("$host", "$user", "$pass", "$db_name");
if (!($db))
	trigger_error("Could not connect to the database", E_USER_ERROR);
// 
// if($db)
//    	echo "connection done";

$db_suffix = 'dir_';
mysqli_set_charset($db, "utf8");

//mysql_query('SET CHARACTER SET utf8');
//mysql_query("SET SESSION collation_connection ='utf8_general_ci'");
$config_sql = "SELECT * FROM dir_config";
$config_query = mysqli_query($db, $config_sql);
while ($site_obj = mysqli_fetch_object($config_query)) {
	if (trim($site_obj->config_name) == 'SITE_NAME')
		$site_name = $site_obj->config_value;
	if (trim($site_obj->config_name) == 'SITE_URL')
		$site_url = $site_obj->config_value;
	if (trim($site_obj->config_name) == 'DB_SUFFIX')
		$db_suffix = $site_obj->config_value;
	define($site_obj->config_name, $site_obj->config_value);
	//echo $site_obj->config_name; echo "<br />";
	//echo $site_obj->config_value; echo "<br />";

}
unset($config_sql, $config_query);
//echo ADVANCED_JOB_CATEGORY_PARENT_ID;
define('ROOT_URL', $site_url);
define('THEME_DIR', 'theme/smart_nutajir/');
define('THEME_URI', SITE_URL . '/theme/smart_nutajir/');
error_reporting(1);
