<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');    

try{

	if(isset($_GET['id']) {
		$user_id = $_GET['id'];
		$wpdb->query($wpdb->prepare("UPDATE wpbc_users SET active='1' WHERE ID='%s'", $user_id)); 
		echo 'Your account has been activated, you can now login.';
	}
	else {
		else echo 'The url is either invalid or you already have activated your account.';
	}

	/*if( isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash']) ) {
	    
	    $email = esc_sql($_GET['email']); 
	    $hash = esc_sql($_GET['hash']); 
	    $search = $wpdb->get_results($wpdb->prepare("SELECT email, hash, active FROM wpbc_users WHERE email='%s' AND hash='%s' AND active='0'", $email, $hash)); 
		$match  = $wpdb->num_rows($search);
		if($match > 0){
	    // activate the account
			$wpdb->query($wpdb->prepare("UPDATE wpbc_users SET active='1' WHERE email='%s' AND hash='%s' AND active='0'", $email, $hash)); 
			echo 'Your account has been activated, you can now login.';
		}
		else echo 'The url is either invalid or you already have activated your account.';
	}
	else echo 'Invalid approach, please use the link that has been send to your email.'; */
}
catch(Exception $e) {
  	echo $e;
}

?>