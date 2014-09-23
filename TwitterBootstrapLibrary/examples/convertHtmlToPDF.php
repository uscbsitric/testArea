<?php
	/// comment only
	require_once 'prince.php';
	
	$prince = new Prince('/usr/bin/prince');
<<<<<<< HEAD
	
=======

>>>>>>> 4417c8404e92e4b2eeff6f6ebf5bb96ebd17085b
	if(!$prince)
	{
		exit('prince not installed');
	}
<<<<<<< HEAD
	
	$messages = array();
	$prince->addStyleSheet('realestate.css');
	$result = $prince->convert_file('starterTemplate.html', $messages);
=======

	$messages = array();
	$prince->addStyleSheet('realestate.css');
	$result = $prince->convert_file('starterTemplate.html', $messages, 'images/giAtay.pdf');
>>>>>>> 4417c8404e92e4b2eeff6f6ebf5bb96ebd17085b

	if(!$messages)
	{
		var_dump($messages);
	}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 4417c8404e92e4b2eeff6f6ebf5bb96ebd17085b
