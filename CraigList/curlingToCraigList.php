<?php
	// 50 states of america:
	/*****
		* Alabama
		* Alaska
		* Arizona
		* Arkansas
		* California
		* Colorado
		* Connecticut
		* Delaware
		* Florida
		* Georgia
		* Hawaii
		* Idaho
		* Illinois
		* Indiana
		* Iowa
		* Kansas
		* Kentucky
		* Louisiana
		* Maine
		* Maryland
		* Massachusetts
		* Michigan
		* Minnesota
		* Mississippi
		* Missouri
		* Montana
		* Nebraska
		* Nevada
		* New Hampshire
		* New Jersey
		* New Mexico
		* New York
		* North Carolina
		* North Dakota
		* Ohio
		* Oklahoma
		* Oregon
		* Pennsylvania
		* Rhode Island
		* South Carolina
		* South Dakota
		* Tennessee
		* Texas
		* Utah
		* Vermont
		* Virginia
		* Washington
		* West Virginia
		* Wisconsin
		* Wyoming 
	 *****/
	// requirements: writable cookie.txt
	include('phpQuery-onefile.php');
	include('AlabamaConfiguration.php');

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

		// getting the cryptedStepCheck
		phpQuery::newDocument($output);
		$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();

		if(0 == strlen($cryptedStepCheck) && isset($postVars['cryptedStepCheck']))
		{
			$cryptedStepCheck = $postVars['cryptedStepCheck'];
		}

		return array('random22' => (isset($random22)) ? $random22 : NULL,
					 'random5'  => (isset($random5)) ? $random5 : NULL,
					 'cryptedStepCheck' => (isset($cryptedStepCheck)) ? $cryptedStepCheck : NULL,
					 'markup'   => $output
					);
	}


	function postToCraigList(array $stepsAndConfiguration, $debug)
	{
		$stepCounter = 0; // login step
		$keys = array_keys($stepsAndConfiguration);

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
				echo '<div id="loginResult" style="width: 500; height: 500; overflow: hidden;">
						'.$curlRequestResult['markup'].'
					  </div>';
			}
			
			$stepCounter++;

			if($curlRequestResult['random22'] || $curlRequestResult['random5'] || $curlRequestResult['cryptedStepCheck'])
			{
				$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['random22'] 		= $curlRequestResult['random22'];
				$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['random5']  		= $curlRequestResult['random5'];
				$stepsAndConfiguration[$keys[$stepCounter]]['postVars']['cryptedStepCheck'] = $curlRequestResult['cryptedStepCheck'];
			}
		}

		return 1;
	}






	$cookieFilePath   = getcwd()."/cookie.txt";
	// LOGIN credentials
	$inputEmailHandle = 'usc_bsit_ric@yahoo.com'; // from $_POST, meaning, user input;
	$inputPassword    = 'ripe1234'; 			  // from $_POST, meaning, user input;
	// LOGIN credentials 
	// SELECT LOCATION credentials
	$areaabb   		  = 'mnl'; 				      // from $_POST, meaning, user input;
	// SELECT LOCATION credentials
	// CHOOSE TYPE credentials
	$chooseTypeId	  = 'ho';					  // from $_POST, meaning, user input;
	// CHOOSE TYPE credentials
	// CHOOSE CATEGORY credentials
	$chooseCategoryId = '143';					  // from $_POST, meaning, uesr input;
	// CHOOSE CATEGORY credentials
	//POST PROPERTY credentials
	$FromEmail		  = 'usc_bsit_ric';			  // from $_POST, meaning, user input;
	$Privacy 		  = 'C';					  // from $_POST, meaning, user input;
	$contact_phone_ok = 1;						  // from $_POST, meaning, user input;
	$contact_text_ok  = 1;						  // from $_POST, meaning, user input;
	$contact_phone	  = '09161528603';			  // from $_POST, meaning, user input;
	$contact_name	  = 'frederick sandalo';	  // from $_POST, meaning, user input;
	$PostingTitle	  = 'Tower1 Plaza';			  // from $_POST, meaning, user input;
	$GeographicArea   = '';						  // from $_POST, meaning, user input; //40 characters only
	$postal		  	  = '1006';					  // from $_POST, meaning, user input; //15 characters only 
	$PostingBody	  = 'Tower1 Plaza Posting Body'; // from $_POST, meaning, user input;
	$Sqft			  = '80';					  // from $_POST, meaning, user input; //6 characters only
	$Ask			  = '50000';				  // from $_POST, meaning, user input; //11 characters only
	$Bedrooms		  = '2';					  // from $_POST, meaning, user input; //1-8
	$bathrooms		  = '2'; 					  // from $_POST, meaning, user input; //1-19
	$housing_type	  = '1';					  // from $_POST, meaning, user input;
	$laundry		  = '1';					  // from $_POST, meaning, user input;
	$parking		  = '1';					  // from $_POST, meaning, user input;
	$wheelaccess	  = '1';					  // from $_POST, meaning, user input;
	$no_smoking	  	  = '1';					  // from $_POST, meaning, user input;
	$is_furnished	  = '1';					  // from $_POST, meaning, user input;
	$outsideContactOK = '1';					  // from $_POST, meaning, user input;
	// POST PROPERTY credentials
	// GEOVERIFY credentials
	$xstreet0		  = '';
	$xstreet1		  = '';
	$city			  = '';
	$region			  = '';
	$postal			  = '';
	// GEOVERIFY credentials
	// POSTIMAGE credentials
	$aPostImages      = 'add';					  // from $_POST, some flagging mechanism
	$filePostImages   = '@' . __DIR__ . '/ranch.JPG'; // from $_POST, meaning, user input;
	// POSTIMAGE credentials
	// DONEWITHIMAGES credentials
	$aDoneWithImages  = 'fin';					  // from $_POST, some flagging mechanism
	$goDoneWithImages = 'Done with Images';		  // from $_POST, some flagging mechanism
	// DONEWITHIMAGES credentials
	// PUBLISH credentials
	$continuePublish  = 'y';					  // from $_POST, some flagging mechanism
	$goPublish		  = 'Continue';				  // from $_POST, some flagging mechanism
	// PUBLISH credentials
	// SENDVERIFICATIONCODE credentials
	
	// SENDVERIFICATIONCODE credentials
	
	$userAgent 		  = 'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)'; // wont likely change
	$stepsAndConfiguration = array('login' 			=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
																					  'CURLOPT_RETURNTRANSFER' => 1,
																					  'CURLOPT_COOKIEJAR'  	   => $cookieFilePath,
																					  'CURLOPT_COOKIEFILE' 	   => $cookieFilePath,
																					  'CURLOPT_REFERER'    	   => 'http://www.craigslist.org',
																					  'CURLOPT_USERAGENT'  	   => $userAgent,
																					  'formatURL'			   => false
																					 ),
															 'postVars'		 => array()
															),
								   'selectLocation' => array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login/pstrdr?areaabb='.$areaabb.'',
																					  'CURLOPT_RETURNTRANSFER' => 1,
																					  'CURLOPT_COOKIEJAR'  	   => $cookieFilePath,
																					  'CURLOPT_COOKIEFILE' 	   => $cookieFilePath,
																					  'CURLOPT_REFERER'    	   => 'http://accounts.craigslist.org',
																					  'CURLOPT_USERAGENT'  	   => $userAgent,
																					  'formatURL'			   => false
								   													 ),
								   							 'postVars'		 => array()
								   							),
								   'chooseType'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://post.craigslist.org/k/%s/%s',
																					  'CURLOPT_RETURNTRANSFER' => 1,
																					  'CURLOPT_COOKIEJAR'  	   => $cookieFilePath,
																					  'CURLOPT_COOKIEFILE' 	   => $cookieFilePath,
																					  'CURLOPT_REFERER'    	   => 'https://accounts.craigslist.org/k/%s/%s?s=type',
																					  'CURLOPT_USERAGENT'  	   => $userAgent,
																					  'CURLOPT_POST'		   => true,
																					  'CURLOPT_FOLLOWLOCATION' => true,
																					  'formatURL'			   => true,
																					  'formatReferer'		   => true
								   													 ),
								   							 'postVars'		 => array('id' => $chooseTypeId)
								   							),
								   'chooseCategory' => array('configuration' => array('CURLOPT_URL' 	   	   => 'https://post.craigslist.org/k/%s/%s',
																					  'CURLOPT_RETURNTRANSFER' => 1,
																					  'CURLOPT_COOKIEJAR'  	   => $cookieFilePath,
																					  'CURLOPT_COOKIEFILE' 	   => $cookieFilePath,
																					  'CURLOPT_REFERER'    	   => 'https://accounts.craigslist.org/k/%s/%s?s=hcat',
																					  'CURLOPT_USERAGENT'  	   => $userAgent,
																					  'CURLOPT_POST'		   => true,
																					  'CURLOPT_FOLLOWLOCATION' => true,
																					  'formatURL'			   => true,
																					  'formatReferer'		   => true
								   													 ),
								   							 'postVars'		 => array('id' => $chooseCategoryId)
								   							),
								   'postProperty'   => array('configuration' => array('CURLOPT_URL' 	   	   => 'https://post.craigslist.org/k/%s/%s',
																					  'CURLOPT_RETURNTRANSFER' => 1,
																					  'CURLOPT_COOKIEJAR'  	   => $cookieFilePath,
																					  'CURLOPT_COOKIEFILE' 	   => $cookieFilePath,
																					  'CURLOPT_REFERER'    	   => 'https://accounts.craigslist.org/k/%s/%s?s=edit',
																					  'CURLOPT_USERAGENT'  	   => $userAgent,
																					  'CURLOPT_POST'		   => true,
																					  'CURLOPT_FOLLOWLOCATION' => true,
																					  'formatURL'			   => true,
																					  'formatReferer'		   => true
								   													 ),
								   							 'postVars'		 => array('FromEmail' 		 => 'usc_bsit_ric@yahoo.com',
																					  'Privacy' 		 => 'C',
																					  'contact_phone_ok' => 1,
																				   	  'contact_text_ok'	 => 1,
																				   	  'contact_phone'	 => '09161528603',
																					  'contact_name'	 => 'frederick sandalo',
																					  'PostingTitle'	 => 'Tower2 Plaza',
																					  'GeographicArea'	 => '',		//40 characters only
																					  'postal'			 => '1006',	//15 characters only
																					  'PostingBody'		 => 'Tower2 Plaza Posting Body',
																					  'Sqft'			 => '80',	//6 characters only
																					  'Ask'				 => '50000',//11 characters only
																					  'Bedrooms'		 => '2',	//1-8
																					  'bathrooms'		 => '2',	//1-19
																					  'housing_type'	 => '1',
																					  'laundry'			 => '1',
																					  'parking'			 => '1',
																					  'wheelaccess'		 => '1',
																					  'no_smoking'		 => '1',
																					  'is_furnished'	 => '1',
																					  'outsideContactOK' => '1',
								   													 )
								   							),
								   'postImage'		=> array('configuration'	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
																						 'CURLOPT_RETURNTRANSFER' => 1,
																						 'CURLOPT_COOKIEJAR'  	  => $cookieFilePath,
																						 'CURLOPT_COOKIEFILE' 	  => $cookieFilePath,
																						 'CURLOPT_REFERER'    	  => 'https://post.craigslist.org/k/%s/%s?s=editimage',
																						 'CURLOPT_USERAGENT'  	  => $userAgent,
																						 'CURLOPT_POST'		   	  => true,
																						 'CURLOPT_FOLLOWLOCATION' => true,
																						 'formatURL'			  => true,
																						 'formatReferer'		  => true
								   														),
								   							 'postVars'			=> array('a' 	=> $aPostImages,
								   							 							 'file' => $filePostImages
								   														)
								   							),
								   'doneWithImages'	=> array('configuration'	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
																						 'CURLOPT_RETURNTRANSFER' => 1,
																						 'CURLOPT_COOKIEJAR'  	  => $cookieFilePath,
																						 'CURLOPT_COOKIEFILE' 	  => $cookieFilePath,
																						 'CURLOPT_REFERER'    	  => 'https://accounts.craigslist.org/k/%s/%s?s=editimage',
																						 'CURLOPT_USERAGENT'  	  => $userAgent,
																						 'CURLOPT_POST'		      => true,
																						 'CURLOPT_FOLLOWLOCATION' => true,
																						 'formatURL'			  => true,
																						 'formatReferer'		  => true
								   														),
															 'postVars'			=> array('a' => $aDoneWithImages,
															 							 'go' => $goDoneWithImages
								   														)
								   							),
								   'publish'		=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
																						 'CURLOPT_RETURNTRANSFER' => 1,
																						 'CURLOPT_COOKIEJAR'  	  => $cookieFilePath,
																						 'CURLOPT_COOKIEFILE' 	  => $cookieFilePath,
																						 'CURLOPT_REFERER'    	  => 'https://post.craigslist.org/k/%s/%s?s=preview',
																						 'CURLOPT_USERAGENT'  	  => $userAgent,
																						 'CURLOPT_POST'		      => true,
																						 'CURLOPT_FOLLOWLOCATION' => true,
																						 'formatURL'			  => true,
																						 'formatReferer'		  => true
								   														),
								   							'postVars'			=> array('continue' => $continuePublish,
								   														 'go'		=> $goPublish
								   														)
								   							)
								  );
	

	$postToCraigListResult = postToCraigList($stepsAndConfiguration, true);
