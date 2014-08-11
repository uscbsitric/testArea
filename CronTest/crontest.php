<?php
	$mysqli = new mysqli('localhost', 'root', 'GATX105Strike', 'crontest');


	$mysqli->query("insert into testable(`message`) values('sample message ".date('Y F d h:i:s')."')");