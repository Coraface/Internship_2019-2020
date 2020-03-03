<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');    //You may need some data validation here

    $user = ( isset($_GET['uname']) ? esc_sql($_GET['uname']) : '' );
    $pass = ( isset($_GET['upass']) ? esc_sql($_GET['upass']) : '' );
    $email = ( isset($_GET['uemail']) ? esc_sql($_GET['uemail']) : '' );


		if( $user != '' ) {
			if ( is_email( $email ) ) {
				if ( !username_exists( $user ) ) {
					if( !email_exists( $email ) ) {
						if( $pass != '') {
                            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                            $hash = password_hash(rand(0,10000), PASSWORD_DEFAULT);
                            $data = array('user_login' => $user, 'user_pass' => $hashed_pass, 'hash' => $hash, 'user_email' => $email);
                            $format = array('%s','%s','%s','%s');
                            //$user_id = wp_create_user( $user, $hashed_pass, $email );
                            //$user_id = $wpdb->query($wpdb->prepare("INSERT INTO wpbc_users (user_login, user_pass, hash, user_email) VALUES ('%s', '%s', '%s', '%s')", $user, $hashed_pass, $hash, $email));
                            $wpdb->insert("wpbc_users",$data,$format);
                            $user_id = $wpdb->insert_id;
							try{
							    $to = $email; // Send email to our user
                                $subject = 'Signup - Verification'; // Give the email a subject 
                                $message = '
                                
                                Thanks for signing up!
                                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                                
                                ------------------------
                                Username: '.$user.'
                                Password: '.$pass.'
                                ------------------------
                                
                                Please click this link to activate your account:
                                http://www.sustainability4you.com/email-verification?id='.$user_id.'
                                '; // Our message above including the link
                                
                                //http://www.sustainability4you.com/email-verification?email='.$email.'&hash='.$hash.'

                                $headers = 'From: noreply@sustainability4you.com' . "\r\n"; // Set from headers
                                mail($to, $subject, $message, $headers); // Send our email 

                                echo "Success ".$user_id;
							    
							} catch(Exception $e){
							    //Something went bad
							    echo "Failed";
							}

							
							/*if( !is_wp_error($user_id) ) {
							   //user has been created
							   $user = new WP_User( $user_id );
							   $user->set_role( 'subscriber' );
							   echo "Success";
							   exit;
							} else {
							  	wp_redirect( 'http://sustainability4you.com/error/' );
								exit;
							}*/
						}
						else echo "Password";
					}
					else echo "Email exists";
				}
				else echo "Username exists";
			}
			else echo "Not Valid email";
		}
		else echo "Username";

?>
