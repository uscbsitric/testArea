<?php
	require_once 'prince.php';
	
	$prince = new Prince('/usr/bin/prince');
	
	if(!$prince)
	{
		exit('prince not installed');
	}
	
	$messages = array();
	$prince->addStyleSheet('realestate.css');
	$result = $prince->convert_file('starterTemplate.html', $messages);

	if(!$messages)
	{
		var_dump($messages);
	}