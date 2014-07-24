<?php


	function cURLRequest(array $configuration, array $postVars)
	{
		//$url = 'https://post.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'];
		//$cookie_file_path = getcwd()."/cookie.txt";
		//$referer = 'https://accounts.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'] . '?' . 's=hcat';
		//$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
		$postVars = http_build_query($postVars);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $configuration['CURLOPT_URL']);

		if(isset($configuration['CURLOPT_POST']) && true == $configuration['CURLOPT_POST'])
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
		}
		
		if(isset($configuration['CURLOPT_COOKIEJAR']))
		{
			curl_setopt($ch, CURLOPT_COOKIEJAR, $configuration['CURLOPT_COOKIEJAR']);			
		}
		
		if(isset($configuration['CURLOPT_COOKIEFILE']))
		{
			curl_setopt($ch, CURLOPT_COOKIEFILE, $configuration['CURLOPT_COOKIEFILE']);			
		}
		
		if(isset($configuration['CURLOPT_USERAGENT']))
		{
			curl_setopt($ch, CURLOPT_USERAGENT, $configuration['CURLOPT_USERAGENT']);
		}
		
		if(isset($configuration['CURLOPT_REFERER']))
		{
			curl_setopt($ch, CURLOPT_REFERER, $configuration['CURLOPT_REFERER']);
		}
		
		if(isset($configuration['CURLOPT_RETURNTRANSFER']))
		{
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, $configuration['CURLOPT_RETURNTRANSFER']);
		}

		if(isset($configuration['CURLOPT_FOLLOWLOCATION']))
		{
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $configuration['CURLOPT_FOLLOWLOCATION']);
		}

		if(isset($configuration['CURLOPT_PROTOCOLS']))
		{
			curl_setopt($ch, CURLOPT_PROTOCOLS, $configuration['CURLOPT_PROTOCOLS']);
		}

		if(isset($configuration['CURLOPT_SSL_VERIFYPEER']))
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $configuration['CURLOPT_SSL_VERIFYPEER']);
		}

		if(isset($configuration['CURLOPT_SSL_VERIFYHOST']))
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $configuration['CURLOPT_SSL_VERIFYHOST']);
		}

		if(isset($configuration['CURLOPT_UNRESTRICTED_AUTH']))
		{
			curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, $configuration['CURLOPT_UNRESTRICTED_AUTH']);
		}

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$output = curl_exec($ch);
		$info   = curl_getinfo($ch);
		curl_close($ch);

		$subject = $info['url'];
		$exploded = explode('/', $subject);
		
		if(isset($exploded[4]))
		{
			$random22 = $exploded[4];
			$dummy = $exploded[5];
			$dummy = explode('?', $dummy);
			$random5 = $dummy[0];
		}



		return array('random22' => (isset($random22)) ? $random22 : NULL,
					 'random5'  => (isset($random5)) ? $random5 : NULL,
					 'markup'   => $output
					);
	}


	function post($debug, $stepsAndConfiguration)
	{
		$stepCounter = 0;
		$keys = array_keys($stepsAndConfiguration);
		$error = false;
		
		foreach($stepsAndConfiguration as $step => &$configuration)
		{
			if($configuration['configuration']['formatURL'])
			{
				$url = sprintf($configuration['configuration']['CURLOPT_URL'], $configuration['postVars']['random22'], $configuration['postVars']['random5']);
				$configuration['configuration']['CURLOPT_URL'] = $url;
			}
		
			if( isset($configuration['configuration']['formatReferer']) && true == $configuration['configuration']['formatReferer'] )
			{
				$referer = sprintf($configuration['configuration']['CURLOPT_REFERER'], $configuration['postVars']['random22'], $configuration['postVars']['random5']);
				$configuration['configuration']['CURLOPT_REFERER'] = $referer;
			}
		
			$curlRequestResult = cURLRequest($configuration['configuration'], $configuration['postVars']);
		
			if($debug && $curlRequestResult)
			{
				echo "Newest Test Edition<br>";
				echo $step;
				echo "<br>";
				echo '<div id="loginResult" style="width: 800; height: 900; overflow: hidden;">
							'.$curlRequestResult['markup'].'
					 </div>';
				echo '<div>'.$curlRequestResult['random22'].'</div>';
				echo '<div>'.$curlRequestResult['random5'].'</div>';

				if(isset($curlRequestResult['cryptedStepCheck']))
				{
					echo '<div>'.$curlRequestResult['cryptedStepCheck'].'</div>';
				}
				else
				{
					echo '<div>cryptedStepCheck not available</div>';
				}
			}
			
			if(strpos($curlRequestResult['markup'], 'Please use the links we emailed you to manage this posting')) // this means, verification code is already used
			{
				$error = true;
				break;
			}
		
			$stepCounter++;
		
			if(isset($keys[$stepCounter]))
			{
				if($curlRequestResult['random22'] || $curlRequestResult['random5'] || $curlRequestResult['cryptedStepCheck'])
				{
					$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['random22'] 		= $curlRequestResult['random22'];
					$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['random5']  		= $curlRequestResult['random5'];
					$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['cryptedStepCheck'] = $curlRequestResult['cryptedStepCheck'];
				}
			}
		}
		
		return array('error' 			=> $error,
					 'step'				=> $step,
					 'random22' 		=> $curlRequestResult['random22'],
					 'random5'			=> $curlRequestResult['random5'],
					 'cryptedStepCheck' => (isset($curlRequestResult['cryptedStepCheck'])) ? $curlRequestResult['cryptedStepCheck']: NULL
					);
	}
	
	
	
	
	


	function postVerificationCodeAssembler($urlToPost, $verificationCode, $cryptedStepCheck)
	{
		$cookieFilePath  = getcwd()."/cookie.txt";
		$authstep		 = 'redeem';
		$goSubmitVerCode = 'submit verification code';
		
		

		$exploded = explode('/', $urlToPost);

		if(isset($exploded[4]))
		{
			$random22 = $exploded[4];
			$dummy = $exploded[5];
			$dummy = explode('?', $dummy);
			$random5 = $dummy[0];
		}

		$userAgent 		  = 'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)'; // wont likely change
		$stepsAndConfiguration = array('postVerificationCodeAssembler' => array('configuration' => array('CURLOPT_URL' 		  	 => $urlToPost,
																										 'CURLOPT_RETURNTRANSFER'=> 1,
																										 'CURLOPT_COOKIEJAR'  	 => $cookieFilePath,
																										 'CURLOPT_COOKIEFILE' 	 => $cookieFilePath,
																										 'CURLOPT_REFERER'    	 => 'https://post.craigslist.org/k/%s/%s?s=pc',
																										 'CURLOPT_USERAGENT'  	 => $userAgent,
																										 'CURLOPT_POST'		  	 => true,
																										 'CURLOPT_FOLLOWLOCATION'=> true,
																										 'formatURL'			 => false,
																										 'formatReferer'		 => true
																										),
																				'postVars'		=> array('cryptedStepCheck' => $cryptedStepCheck,
																										 'random22'			=> $random22,
																										 'random5'			=> $random5,
																										 'authstep'			=> $authstep,
																										 'userCode'			=> $verificationCode,
																										 'go'				=> $goSubmitVerCode
																										)
																				)
									  );
		
		return $stepsAndConfiguration;
	}


	// SENDVERIFICATIONCODE credentials
	
	// SENDVERIFICATIONCODE credentials
	

	
//==================================================================================================================================================================================
//==================================================================================================================================================================================
	$verificationCode = '74323';
	$craigslistUrlsAndCryptedStepCheck = array('https://post.craigslist.org/k/jjwDBgrn4xGxBYSHbjF5pg/885ku' => 'U2FsdGVkX18yNTY4MjI1NjARdx-ZYFLbO37v3XYFTA0V903xHeRZ8y6o3pJz67VK',
											   'https://post.craigslist.org/k/hsuGeRjn4xGEyy3R2VWjmA/f4v92' => 'U2FsdGVkX18yNTIyNzI1MrkDX3IkET9J3Gx6MuWfoHBSASDFUoWzxjH_mrap5n5T',
											   'https://post.craigslist.org/k/3loYORzn4xG4B2ED--FJ2g/47z3y' => 'U2FsdGVkX182NTczNjU3MyXnklUDTk7OJ1uCwJwPLGH7kYfqLOTj-vhhHbbzZHgT',
											   'https://post.craigslist.org/k/7rtdUyjn4xGyg3PKVInhMw/y8z3h' => 'U2FsdGVkX18xNDYyNzE0NuBFuetzQvIOJi_NNXcvwIcINRQ4kGO0nFwGOYmaG69T'
											  );
//==================================================================================================================================================================================
//==================================================================================================================================================================================
	// ...actual code excerpt from public function postToCraigsListPart2($verificationCode) in CraigsListsHandler.php model
	//   foreach($craigslistUrls as $craigslistUrl)
	//   {
	// 		$stepsAndConfiguration = $this->postVerificationCodeAssembler($craigslistUrl->url_to_post, $verificationCode, $craigslistUrl->crypted_step_check);
	//		...
	//	 }
	
	//foreach($craigslistUrls as $craigslistUrl)
	foreach($craigslistUrlsAndCryptedStepCheck as $craigslistUrl => $cryptedStepCheck)
	{
		$stepsAndConfiguration = postVerificationCodeAssembler($craigslistUrl, $verificationCode, $cryptedStepCheck);
		$postingResults = post(true, $stepsAndConfiguration);
		
		if($postingResults['error'])
		{
			$sample = 1;
		}
	}
//==================================================================================================================================================================================
//==================================================================================================================================================================================	


