<?php
	$_charge_id = trim( htmlentities( $_POST['charge_id'] ) );
	$_last4 = trim( htmlentities( $_POST['last4'] ) );
	if ( empty( $_charge_id ) || empty( $_last4 ) ) {
		echo "正しくありませんね";
		exit();
	}
	
	require './config.php';
	require './vendor/autoload.php';
	
	\Stripe\Stripe::setApiKey( API_KEY );

// 取引IDとカード下4桁で照合したい的な
	$stripe = new \Stripe\StripeClient( API_KEY );
	try {
		$charge_obj = $stripe->charges->retrieve( $_charge_id, [] );
		
		$_customer_id  = $charge_obj->customer;
		$_verify_last4 = $charge_obj->payment_method_details->card->last4;
		
		if ( $_verify_last4 === $_last4 ) {
			// Authenticate your user.
			$session = \Stripe\BillingPortal\Session::create( [
				'customer'   => $_customer_id,
				'return_url' => RETURN_URL,	// config.php で定義
			] );
			
			// Redirect to the customer portal.
			header( "Location: " . $session->url );
			exit();
		}
	} catch ( Exception $e ) {
		// N/A
	}
	echo "データ不整合";
	exit();