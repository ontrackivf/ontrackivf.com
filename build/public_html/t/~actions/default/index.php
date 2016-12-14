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

    $now = time();

    if($exclude === FALSE){
        // upload tracking info
        $stmt = $db_main->prepare("UPDATE webtests SET ");
        $stmt->bind_param("iiiissss",
            $now,   /* enter time */
        );
        $stmt->execute();

        // get the id of the new user session in order to use for tracking further clicks
        $user_id = $db_main->insert_id;
    }else{
        $user_id = FALSE;
    }






    $error = 0;

}catch(mysqli_sql_exception $e){
	$error = 1;
}catch(Exception $e){
	$error = 1;
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
