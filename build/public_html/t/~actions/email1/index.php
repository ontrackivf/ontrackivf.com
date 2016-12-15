<?php
ob_start();

/* ROOT SETTINGS */ require($_SERVER['DOCUMENT_ROOT'].'/root_settings.php');

/* WHICH DATABASES DO WE NEED */
$db2use = array(
    'db_main'		=> TRUE
);

/* GET KEYS TO SITE */ require(PATH_TO_KEYS);


/* LOAD FUNCTIONS, CLASSES, LIBRARIES */


/* PAGE VARIABLES */
$error = null;
$return = null;
$user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : null;
$data1 = (isset($_GET['data1'])) ? $_GET['data1'] : null;


try{
    // check to see if the user is an employee and should be excluded
    if(isset($_COOKIE['ontrack_webtest_exclude']) && $_COOKIE['ontrack_webtest_exclude'] === 'exclude_me'){
        $exclude = TRUE;
    }else{
        $exclude = FALSE;
    }


	// verify email
	if(filter_var($data1, FILTER_VALIDATE_EMAIL)){
		if($exclude === FALSE){

			$email = $data1;

			// upload tracking info
			$stmt = $db_main->prepare("UPDATE webtests SET `email`=? WHERE `id`=$user_id LIMIT 1");
			$stmt->bind_param("s", $email);
			$stmt->execute();
		}else{
			$user_id = FALSE;
		}

		$error = 0;

	}else{

		$error = 3;

	}




}catch(mysqli_sql_exception $e){
	$error = 1;
	echo $e->getMessage();
}catch(Exception $e){
	$error = 2;
}

/* CLOSE OPEN DATABASES */
foreach ($db2use as $db => $used) {
	if($used){
		${$db}->close();
	}
}


$json = array(
    'error'     => $error,
    'return'    => $return
);


header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json');
print json_encode($json);
ob_end_flush();
?>
