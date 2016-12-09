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





/* CLOSE OPEN DATABASES */
foreach ($db2use as $db => $used) {
	if($used){
		${$db}->close();
	}
}

?>
