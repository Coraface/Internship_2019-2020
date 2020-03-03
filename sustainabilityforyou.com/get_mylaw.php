<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$s=(isset($_GET['username']) ? $_GET['username'] : '');//$_COOKIE["usernameCookie"] ;
if ( $s != '' ) { 
    
	$year = ( isset( $_GET['year'] ) ? $_GET['year'] : '');
	$keyword = ( isset( $_GET['keyword'] ) ? $_GET['keyword'] : '');

	if( $year != '' ) { 
		
		$res = [];
		$results = $wpdb->get_results($wpdb->prepare("SELECT law, description, pdfId FROM wpbc_userlaws WHERE user_login = '%s' AND year='%s'", $s, $year)); 
		foreach ( $results as $page ) { 	
			array_push($res, $page);
		} 
        $jsonData = json_encode($res); 
		echo $jsonData;
	}
	else if( $year == '' ){ 
		$res = [];
		$results = $wpdb->get_results($wpdb->prepare("SELECT law, description, pdfId FROM wpbc_userlaws WHERE user_login = '%s'", $s)); 

		foreach ( $results as $page ) { 
			array_push($res, $page);
		} 
		$jsonData = json_encode($res); 
		echo $jsonData;
		//echo "Year not found";
	}
    else if( !is_numeric($year) ) echo "Year not found";

    if( $keyword != '' ) { 
		
		$res = [];
		$results = $wpdb->get_results($wpdb->prepare("SELECT law, description, pdfId FROM wpbc_userlaws WHERE user_login = '%s' AND keyword='%s'", $s, $keyword)); 
		foreach ( $results as $page ) { 	
			array_push($res, $page);
		} 
        $jsonData = json_encode($res); 
		echo $jsonData;
	}
	else if( $keyword == '' ){ 
		$res = [];
		$results = $wpdb->get_results($wpdb->prepare("SELECT law, description, pdfId FROM wpbc_userlaws WHERE user_login = '%s'", $s)); 

		foreach ( $results as $page ) { 
			array_push($res, $page);
		} 
		$jsonData = json_encode($res); 
		echo $jsonData;
		//echo "keyword not found";
	}

}
else echo "User not found";
?>