<?php 

	$cookie_file_path = getcwd()."/cookie.txt";
	$email = 'usc_bsit_ric@yahoo.com';
	$password = 'ripe1234';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$email.'&inputPassword='.$password.'&submit=Log%20In');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_REFERER, 'http://www.craigslist.org');

	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);

	$output = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);

	var_dump($output);