<?php

		// frederick sandalo
		$connection = mysqli_connect('localhost', 'lhstage', 'landhub$55', 'data_synd_platform');
										$newValue = hash_hmac('sha256', 'password123', 'b315$4acfaa3a417007ad11bdb5fff308732f@679a#1919z716a02');
										$query = "update users set password='$newValue' where id=7490";
										var_dump($query);
										exit();
		
		$query = 'select id, password from users';
		$result = mysqli_query($connection, $query);
		
		
		while($row = mysqli_fetch_assoc($result))
		{
			$newValue = hash_hmac('sha256', $row['password'], 'b315$4acfaa3a417007ad11bdb5fff308732f@679a#1919z716a02');
			$query = "update users set password='$newValue' where id=".$row['id']."";
		
			mysqli_query($connection, $query);
		}



	$query = 'select password from users limit 0,5';
	$result = mysqli_query($connection, $query);
	
	while($column = mysqli_fetch_assoc($result))
	{
		var_dump($column);
		echo "<br>";	
	}
