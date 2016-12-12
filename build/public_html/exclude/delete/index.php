<?php

	/* ROOT SETTINGS */ require($_SERVER['DOCUMENT_ROOT'].'/root_settings.php');

	/* WHICH DATABASES DO WE NEED */
	$db2use = array(
		'db_main'		=> FALSE
	);

	/* GET KEYS TO SITE */ require(PATH_TO_KEYS);

	setcookie('ontrack_webtest_exclude', '', time()-60*60*7, '/', COOKIE_DOMAIN );

	echo '<p>Cookie Deleted.</p><p><a href="/exclude/test/">test your cookie</a></p><p><a href="/exclude/">set your cookie</a></p>';

?>
