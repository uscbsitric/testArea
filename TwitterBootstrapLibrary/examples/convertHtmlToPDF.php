<?php
	/// comment only
	require_once 'prince.php';
	
	$prince = new Prince('/usr/bin/prince');

	if(!$prince)
	{
		exit('prince not installed');
	}

	$messages = array();
	$prince->addStyleSheet('realestate.css');
	$result = $prince->convert_file('starterTemplate.html', $messages, 'images/giAtay.pdf');

	if(!$messages)
	{
		var_dump($messages);
	}
?>
