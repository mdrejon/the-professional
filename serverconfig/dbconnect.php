<?php
	if (!isset($_SESSION)) {
	session_start();
	}
    ///ob_start();
	date_default_timezone_set('Etc/GMT-6');
	$db = mysqli_connect("localhost","smart323_ahub","^%iuMw!!BUOP","smart323_ahub");
	if(!($db))
     	trigger_error("Could not connect to the database", E_USER_ERROR);
  // 
  // if($db)
      	//echo "connection done";

	$db_suffix='ah_';
	mysqli_set_charset($db,"utf8");

	//mysql_query('SET CHARACTER SET utf8');
	//mysql_query("SET SESSION collation_connection ='utf8_general_ci'");




	 $config_sql = "SELECT * FROM ah_config";
    $config_query = mysqli_query($db,$config_sql);

    while($site_obj = mysqli_fetch_object($config_query))
    {
        if(trim($site_obj->config_name) == 'SITE_NAME')
            $site_name = $site_obj->config_value;
        if(trim($site_obj->config_name) == 'SITE_URL')
            $site_url = $site_obj->config_value;
		if(trim($site_obj->config_name) == 'DB_SUFFIX')
           $db_suffix = $site_obj->config_value;
		define($site_obj->config_name,$site_obj->config_value);
		 // $site_obj->config_value; echo "<br />";

    }



  unset($config_sql,$config_query);

	define('ROOT_URL', $site_url);
	define('THEME_DIR', 'theme/smart_nutajir/');
	define('THEME_URI', SITE_URL.'/theme/smart_nutajir/');
	error_reporting(1);



?>
