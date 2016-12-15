<?php

/* ROOT SETTINGS */ require($_SERVER['DOCUMENT_ROOT'].'/root_settings.php');

/* WHICH DATABASES DO WE NEED */
$db2use = array(
    'db_main'		=> FALSE
);

/* GET KEYS TO SITE */ require(PATH_TO_KEYS);


header('Location: '.$protocol.$site.'/t/r1/v1/s1',TRUE,303);

?>
