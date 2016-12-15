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

    // get the old action data
    $r_old_data = $db_main->query("SELECT `action_data` FROM webtests WHERE `id`=$user_id");
    $a_old_data = $r_old_data->fetch_assoc();
    $old_data = $a_old_data['action_data'];

    // convert old data to an array
    $old_data = json_decode($old_data);

    // get the new data
    $new_data = $data1;
    // add the time to the action data
    $new_data['time'] = $now;

    // add the new data to the old data
    $old_data[] = $new_data;

    // encode the action data into json
    $action_data = json_encode($old_data);


    if($exclude === FALSE){
        // upload tracking info
        $stmt = $db_main->prepare("UPDATE webtests SET `action_data`=? WHERE `id`=$user_id LIMIT 1");
        $stmt->bind_param("s", $action_data);
        $stmt->execute();
    }else{
        $user_id = FALSE;
    }

    $error = 0;

}catch(mysqli_sql_exception $e){
	$error = 1;
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
