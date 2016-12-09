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
do{

    $r = null;
    $v = null;
    $s = null;

    // get the referrer-valueprop-survey string
    $rvs = (isset($_GET['rvs'])) ? $_GET['rvs'] : FALSE;

    // set referrer, value prop, survey if page directly accessed
    if($rvs === FALSE){
        $r = '1';
        $v = '1';
        $s = '1';
        break;
    }

    // remove trailing slash
    $rvs = rtrim($rvs, '/');

    // check for invalid characters
    if(preg_match('/[^rvs0-9\/]+/',$rvs)===1){
        // if found set referr, value prop, and survey to error codes
        $r = '0';
        $v = '1';
        $s = '1';
        break;
    }

    // extract individual values for referrer, value prop, survey
    $a_rvs = explode('/', $rvs);

    // check to see if there more than 3 values
    if( count($a_rvs) !== 3 ){
        // if there are too many or too few values set referr, value prop, and survey to error codes
        $r = '0';
        $v = '1';
        $s = '1';
        break;
    }

    // check to see if values are formatted correctly

    // make new array with first character the key and the rest the value
    $ids = array();
    foreach( $a_rvs as $value ){
        $k = substr($value,0,1);
        $v = substr($value,1,strlen($value)-1);
        // check to make sure $k is one of the letters, and $v is numbers
        if(preg_match('/[^0-9]+/',$v)===1){
            // if not set referr, value prop, and survey to error codes
            $r = '0';
            $v = '1';
            $s = '1';
            break 2; // all the way out
        }
        if(preg_match('/[^rvs]+/',$k)===1){
            // if not set referr, value prop, and survey to error codes
            $r = '0';
            $v = '1';
            $s = '1';
            break 2; // all the way out
        }

        $ids[$k] = $v;
    }

    // make sure there is one of each
    if( count($ids) !== 3 ){
        // if there was not one of each the count will not equal to 3 becuase a value will have been overwritten
        $r = '0';
        $v = '1';
        $s = '1';
        break;
    }

    // set the referrer, value prop, survey
    $r = $ids['r'];
    $v = $ids['v'];
    $s = $ids['s'];

}while(false);


// upload data and display value prop
try{

    // check to make sure the value prop is there
    

}catch(mysqli_sql_exception $e){

}catch(Exception $e){

}




/* CLOSE OPEN DATABASES */
foreach ($db2use as $db => $used) {
	if($used){
		${$db}->close();
	}
}

?>
