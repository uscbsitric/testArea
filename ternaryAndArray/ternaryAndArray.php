<?php

	$couponCode = 'sampleValuefsdfsad';
	$config = array('description' => 'sampleDesc',
					'card' 	   	  => 'sampleCard',
					'plan' 	   	  => 'samplePlan',
				   );
	(isset($couponCode)) ? ($config['coupon'] = $couponCode) : ($config);

	echo "<pre>";
	var_dump($config);
	
	/*****
	$stripeCustomer = '';
	return Stripe_Customer::create(array(
			'description' => $description,
			'card' => $token,
			'plan' => $plan,
	));
	*****/
?>