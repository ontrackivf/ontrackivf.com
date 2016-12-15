<?php

/* SITE CONFIGURATION */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);			// Use Exceptions for MySqli queries.
set_include_path('/home/174108/domains/ontrackivf.com/inc');		// Do not include trailing slash.
define('HOME_PATH', '/home/174108/domains/ontrackivf.com/');		// for file exist checks, include trailing slash
date_default_timezone_set('America/Detroit');						// Set the site's time zone.
define('COOKIE_DOMAIN', '.ontrackivf.com');							// Set the login cookie domain, do not forget the preceding dot.
$site = 'ontrackivf.com';											// Do not include trailing slash. Do not include protocol.
$protocol = ($use_https) ? 'https://' : 'http://';					// $usehttps is defined in root_settings.php




/* API KEYS */




/* DATABASE CREDENTIALS */
$database_creds = array(
	'db_main' =>
	array(
		'label'	=> "db_main",
		'host'  => "localhost",
		'uname' => "db174108_ot",
		'pword' => "UcnTnoL7bTWvZCbb(",
		'dbase' => "db174108_ot_main"
	)
);



/* CONNECT TO THE REQUIRED DATABASES (mysqli) */
$db_conn_err = FALSE;
$db_conn_msg = '';
foreach ($database_creds as $db){
	if($db2use[$db['label']] === TRUE){
		try{
			${$db['label']} = new mysqli($db['host'], $db['uname'], $db['pword'], $db['dbase']);
		}catch (mysqli_sql_exception $e) {
			$db_conn_msg .= 'Could not connect to database: '.$db['label'].'<br/>';
			$db_conn_err = TRUE;
		}
	}
}
if($db_conn_err){ print '<p>'.$db_conn_msg.'</p>'; exit; }


?>
