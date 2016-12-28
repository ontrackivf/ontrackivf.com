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

    // check to see if the user is an employee and should be excluded
    if(isset($_COOKIE['ontrack_webtest_exclude']) && $_COOKIE['ontrack_webtest_exclude'] === 'exclude_me'){
        $exclude = TRUE;
    }else{
        $exclude = FALSE;
    }

    $now = time();

    $r = null;
    $v = null;
    $s = null;

    // get the referrer-valueprop-survey string
    $url = (isset($_GET['url'])) ? $_GET['url'] : FALSE;

    // remove trailing slash
    $url = rtrim($url, '/');

    // strip unwanted characters from url string before saved
    $url = preg_replace("/[^a-zA-Z0-9-\/]/", "", $url);


    if($url === 'learn-more'){
        $v = '3';
    }else{
        $v = '2';
    }


}while(false);

ob_end_flush();

/* HEADER */ require('layout/header1.php');

try{

    if($exclude === FALSE){



        if($db_main){
            // upload tracking info
            $stmt = $db_main->prepare("INSERT INTO webtests(referrer, value_prop, survey, entertime, url, ipaddress, browser, http_referrer) VALUES(?,?,?,?,?,?,?,?)");
            $stmt->bind_param("iiiissss",
                $r,     /* referrer */
                $v,     /* value prop */
                $s,     /* survey */
                $now,   /* enter time */
                $url,   /* url string */
                $_SERVER['REMOTE_ADDR'],    /* ip address */
                $_SERVER['HTTP_USER_AGENT'],/* browser */
                $_SERVER['HTTP_REFERER']    /* browser reported referrer */
            );
            $stmt->execute();
            $stmt->close();

            // get the id of the new user session in order to use for tracking further clicks
            $user_id = $db_main->insert_id;

        }else{

            // log data upload failure to text file, along with the data, and display the page anyways
            $file = HOME_PATH.'logs/t_index_php-'.microtime().'.txt';
            $log = fopen($file, 'w');
            $msg  = 'database error could not save info on original page hit'."\t";
            $msg .= date("Y-m-d h:i:sa",time())."\t";
            $msg .= $url."\t";
            $msg .= $_SERVER['REMOTE_ADDR']."\t";
            $msg .= $_SERVER['HTTP_USER_AGENT']."\t";
            $msg .= $_SERVER['HTTP_REFERER'];
            fwrite($log, $msg);
            fclose($log);

            $user_id = 'db_error';

        }

    }else{
        $user_id = 'false';
    }

}catch(mysqli_sql_exception $e){

    // log data upload failure to text file, along with the data, and display the page anyways
    $file = HOME_PATH.'logs/t_index_php-'.microtime().'.txt';
    $log = fopen($file, 'w');
    $msg  = 'database error could not save info on original page hit'."\t";
    $msg .= date("Y-m-d h:i:sa",time())."\t";
    $msg .= $url."\t";
    $msg .= $_SERVER['REMOTE_ADDR']."\t";
    $msg .= $_SERVER['HTTP_USER_AGENT']."\t";
    $msg .= $_SERVER['HTTP_REFERER'];
    fwrite($log, $msg);
    fclose($log);


    $user_id = FALSE;

}catch(Exception $e){

    // log data upload failure to text file, along with the data, and display the page anyways
    $file = HOME_PATH.'logs/t_index_php-'.microtime().'.txt';
    $log = fopen($file, 'w');
    $msg  = 'database error could not save info on original page hit'."\t";
    $msg .= date("Y-m-d h:i:sa",time())."\t";
    $msg .= $url."\t";
    $msg .= $_SERVER['REMOTE_ADDR']."\t";
    $msg .= $_SERVER['HTTP_USER_AGENT']."\t";
    $msg .= $_SERVER['HTTP_REFERER'];
    fwrite($log, $msg);
    fclose($log);

}



// double check to see that the value prop exists
if(!file_exists(HOME_PATH.'inc/value_props/'.$v.'.php')){
    /*  this should never happen
        it will only happen if the default value prop (1.php)
        is deleted from the server
    */
    echo '<p>value prop missing</p>';
}else{

    // display the value prop
    include 'value_props/'.$v.'.php';

}











/* FOOTER */ require('layout/footer1.php');

/* CLOSE OPEN DATABASES */
if($db_conn_err !== TRUE){
    foreach ($db2use as $db => $used) {
    	if($used){
    		${$db}->close();
    	}
    }
}

?>
