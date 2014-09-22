	<?php
			// requirements: writable cookie.txt
			include('phpQuery-onefile.php');

			function curlLogin(array $postVars)
			{
				// New Cookie file
				/*****
				if(!is_dir('/var/www/testArea/craiglistCookies'))
				{
					mkdir("/var/www/testArea/craiglistCookies", 0777);
					chmod("/var/www/testArea/craiglistCookies", 0777);
				}

				$ckfile = tempnam("/var/www/testArea/craiglistCookies", $postVars['inputEmailHandle']); // creates a file with unique filename.
				$postVars = http_build_query($postVars);
				*****/

				$cookie_file_path = getcwd()."/cookie.txt";
				$url = 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$postVars['inputEmailHandle'].'&inputPassword='.$postVars['inputPassword'].'&submit=Log%20In';
				$referer = 'http://www.craigslist.org';
				$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_REFERER, $referer);
				curl_setopt($ch, CURLOPT_USERAGENT, $agent);
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
				$output = curl_exec($ch);
				$info   = curl_getinfo($ch);
				curl_close($ch);


				return array('random22' => NULL,
							 'random5'  => NULL,
							 'cryptedStepCheck' => NULL,
							 'markup' => $output
							);
			}
			
			function curlSelectLocation(array $postVars)
	   		{
	         	$cookie_file_path = getcwd()."/cookie.txt";
	         	$url = 'https://accounts.craigslist.org/login/pstrdr?areaabb='.$postVars['areaabb'].'';
	         	$referer = 'http://accounts.craigslist.org';
	         	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
    			$ch = curl_init();
    			curl_setopt($ch, CURLOPT_URL, $url);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    			curl_setopt($ch, CURLOPT_REFERER, $referer);
    			curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
            	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    			$output = curl_exec($ch);
    			$info   = curl_getinfo($ch);
    			curl_close($ch);
    			
    			//  https://post.craigslist.org/k/ChX9h8CX4xGvpuZ9wPCbyw/egFZx?s=type
    			// getting the random22 and the random5
    			$subject = $info['url'];
    			$exploded = explode('/', $subject);
    			$random22 = $exploded[4];
    			$dummy = $exploded[5];
    			$dummy = explode('?', $dummy);
    			$random5 = $dummy[0];
    			
    			// getting the cryptedStepCheck
    			phpQuery::newDocument($output);
    			$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();
    			
    			return array('random22' => $random22,
	    					 'random5'  => $random5,
	    					 'cryptedStepCheck' => $cryptedStepCheck,
	    					 'markup' => $output
    						);
	   		}

	   		function curlChooseType(array $configuration, array $postVars)
	   		{
	   			$cookie_file_path = getcwd()."/cookie.txt";
	   			$url = 'https://post.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'];
	   			$referer = 'https://accounts.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'] . '?' . 's=type';
	   			$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
	   			
	   			$postVars = http_build_query($postVars);
	   			
	   			$ch = curl_init();
	   			curl_setopt($ch, CURLOPT_URL, $url);
	   			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   			
	   			if($referer)
	   			{
	   				curl_setopt($ch, CURLOPT_REFERER, $referer);
	   			}
	   			
	   			if($agent)
	   			{
	   				curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	   			}
	   			
	   			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
	   			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	   			
	   			if($postVars)
	   			{
	   				curl_setopt($ch, CURLOPT_POST, 1);
	   				curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
	   			}
	   			
	   			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	   			$output = curl_exec($ch);
	   			$info   = curl_getinfo($ch);
	   			curl_close($ch);
	   			
	   			$subject = $info['url'];
	   			$exploded = explode('/', $subject);
	   			$random22 = $exploded[4];
	   			$dummy = $exploded[5];
	   			$dummy = explode('?', $dummy);
	   			$random5 = $dummy[0];
	   			 
	   			// getting the cryptedStepCheck
	   			phpQuery::newDocument($output);
	   			$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();
	   			 
	   			return array('random22' => $random22,
		   					 'random5'  => $random5,
		   					 'cryptedStepCheck' => $cryptedStepCheck,
		   					 'markup'   => $output
		   					);
	   		}
	   		
	   		function curlChooseCategory(array $configuration, array $postVars)
	   		{
	   			$cookie_file_path = getcwd()."/cookie.txt";
	   			$url = 'https://post.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'];
	   			$referer = 'https://accounts.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'] . '?' . 's=hcat';
	   			$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
	   			$postVars = http_build_query($postVars);
	   			 
	   			$ch = curl_init();
	   			curl_setopt($ch, CURLOPT_URL, $url);
	   			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   			 
	   			if($referer)
	   			{
	   				curl_setopt($ch, CURLOPT_REFERER, $referer);
	   			}
	   			 
	   			if($agent)
	   			{
	   				curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	   			}
	   			 
	   			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
	   			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	   			 
	   			if($postVars)
	   			{
	   				curl_setopt($ch, CURLOPT_POST, 1);
	   				curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
	   			}
	   			 
	   			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	   			$output = curl_exec($ch);
	   			$info   = curl_getinfo($ch);
	   			curl_close($ch);
	   			 
	   			$subject = $info['url'];
	   			$exploded = explode('/', $subject);
	   			$random22 = $exploded[4];
	   			$dummy = $exploded[5];
	   			$dummy = explode('?', $dummy);
	   			$random5 = $dummy[0];
	   			
	   			// getting the cryptedStepCheck
	   			phpQuery::newDocument($output);
	   			$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();
	   			
	   			return array('random22' => $random22,
		   					 'random5'  => $random5,
		   					 'cryptedStepCheck' => $cryptedStepCheck,
		   					 'markup'   => $output
		   					);
	   		}
			
			function curlPostProperty(array $configuration, array $postVars)
			{
				$cookie_file_path = getcwd()."/cookie.txt";
				$url = 'https://post.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'];
				$referer = 'https://accounts.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'] . '?' . 's=edit';
				$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
				$postVars = http_build_query($postVars);

	   			$ch = curl_init();
	   			curl_setopt($ch, CURLOPT_URL, $url);
	   			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				if($referer)
	   			{
	   				curl_setopt($ch, CURLOPT_REFERER, $referer);
	   			}
	   			 
	   			if($agent)
	   			{
	   				curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	   			}
	   			 
	   			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
	   			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	   			 
	   			if($postVars)
	   			{
	   				curl_setopt($ch, CURLOPT_POST, 1);
	   				curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
	   			}

	   			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	   			$output = curl_exec($ch);
	   			$info   = curl_getinfo($ch);
	   			curl_close($ch);

	   			$subject = $info['url'];
	   			$exploded = explode('/', $subject);
	   			$random22 = $exploded[4];
	   			$dummy = $exploded[5];
	   			$dummy = explode('?', $dummy);
	   			$random5 = $dummy[0];
	   			
	   			// getting the cryptedStepCheck
	   			phpQuery::newDocument($output);
	   			$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();
	   			
	   			return array('random22' => $random22,
		   					 'random5'  => $random5,
		   					 'cryptedStepCheck' => $cryptedStepCheck,
		   					 'markup'   => $output
		   					);
			}
			
			function curlPostImage($configuration, $postVars)
			{
				$cookie_file_path = getcwd()."/cookie.txt";
				$url = 'https://post.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'];
				$referer = 'https://post.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'] . '?' . 's=editimage';
				$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
				//$postVars = http_build_query($postVars);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				
				if($referer)
				{
					curl_setopt($ch, CURLOPT_REFERER, $referer);
				}
				
				if($agent)
				{
					curl_setopt($ch, CURLOPT_USERAGENT, $agent);
				}
				
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
				
				if($postVars)
				{
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
				}
				
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				$output = curl_exec($ch);
				$info   = curl_getinfo($ch);
				curl_close($ch);
				
				$subject = $info['url'];
				$exploded = explode('/', $subject);
				$random22 = $exploded[4];
				$dummy = $exploded[5];
				$dummy = explode('?', $dummy);
				$random5 = $dummy[0];
				 
				// getting the cryptedStepCheck
				phpQuery::newDocument($output);
				$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();
				
				if(0 == strlen($cryptedStepCheck))
				{
					$cryptedStepCheck = $postVars['cryptedStepCheck'];
				}
				 
				return array('random22' => $random22,
							 'random5'  => $random5,
							 'cryptedStepCheck' => $cryptedStepCheck,
							 'markup'   => $output
							);
			}

			function curlDoneWithImages($configuration, $postVars)
			{
				$cookie_file_path = getcwd()."/cookie.txt";
				$url = 'https://post.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'];
				$referer = 'https://accounts.craigslist.org/k/' . $postVars['random22'] . '/' . $postVars['random5'] . '?' . 's=editimage';
				$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
				$postVars = http_build_query($postVars);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				
				if($referer)
				{
					curl_setopt($ch, CURLOPT_REFERER, $referer);
				}
				
				if($agent)
				{
					curl_setopt($ch, CURLOPT_USERAGENT, $agent);
				}
				
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
				
				if($postVars)
				{
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
				}
				
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				$output = curl_exec($ch);
				$info   = curl_getinfo($ch);
				curl_close($ch);
				
				$subject = $info['url'];
				$exploded = explode('/', $subject);
				$random22 = $exploded[4];
				$dummy = $exploded[5];
				$dummy = explode('?', $dummy);
				$random5 = $dummy[0];
					
				// getting the cryptedStepCheck
				phpQuery::newDocument($output);
				$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();
					
				return array('random22' => $random22,
							 'random5'  => $random5,
							 'cryptedStepCheck' => $cryptedStepCheck,
							 'markup'   => $output
							);
			}
			
			
			function curlPublish(array $configuration, array $postVars)
			{
				$cookie_file_path = getcwd()."/cookie.txt";
				$url = 'https://post.craigslist.org/k/' . $configuration['random22'] . '/' . $configuration['random5'];
				$referer = 'https://post.craigslist.org/k/' . $configuration['random22'] . '/' . $configuration['random5'] . '?' . 's=preview';
				$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
				$postVars = http_build_query($postVars);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				
				if(isset($referer))
				{
					curl_setopt($ch, CURLOPT_REFERER, $referer);
				}
				
				if(isset($agent))
				{
					curl_setopt($ch, CURLOPT_USERAGENT, $agent);
				}
				
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
				
				if($postVars)
				{
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
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
				
				$output = curl_exec($ch);
				$info   = curl_getinfo($ch);
				curl_close($ch);
				
				$subject = $info['url'];
				$exploded = explode('/', $subject);
				$random22 = $exploded[4];
				$dummy = $exploded[5];
				$dummy = explode('?', $dummy);
				$random5 = $dummy[0];
					
				// getting the cryptedStepCheck
				phpQuery::newDocument($output);
				$cryptedStepCheck = pq("input:hidden[name=cryptedStepCheck]")->val();
					
				return array('random22' => $random22,
							 'random5'  => $random5,
							 'cryptedStepCheck' => $cryptedStepCheck,
							 'markup'   => $output
							);
			}

			
			
	?>


	
	
	
	

		<?php
			// login
			$inputEmailHandle = 'usc_bsit_ric@yahoo.com';
			$inputPassword	  = 'ripe1234';
			$postVars = array('inputEmailHandle' => $inputEmailHandle,
							  'inputPassword'	 => $inputPassword
							 );

			$cURLRequest = curlLogin( $postVars );

			if( $cURLRequest )
			{
				echo '<div id="loginResult" style="width: 500; height: 500; overflow: hidden;">
							'.$cURLRequest['markup'].'
						</div>';
			}
			// login


			// select location
			$areaabb = 'mnl';
			$postVars = array('areaabb' => $areaabb);
			$cURLRequest = curlSelectLocation($postVars);


			if($cURLRequest) 
			{
				echo '<div id="selectLocationResult" style="width: 500; height: 500; overflow: hidden;">
							'.$cURLRequest['markup'].'
						</div>';
			}
			// select location
			
			
			// choose type
			$id = 'ho';
			$postVars = array('id' 				 => $id,
							  'random22' 		 => $cURLRequest['random22'],
							  'random5'	 		 => $cURLRequest['random5'],
							  'cryptedStepCheck' => $cURLRequest['cryptedStepCheck']
							 );
			$cURLRequest = curlChooseType(array(), $postVars);
			
			if($cURLRequest)
			{
				echo '<div id="chooseType" style="width: 500; height: 500; overflow: hidden;">
							'.$cURLRequest['markup'].'
						</div>';
			}
			// choose type

			
			// choose category
			$id = 143;
			$postVars = array('id' 				 => $id,
							  'random22'		 => $cURLRequest['random22'],
							  'random5'			 => $cURLRequest['random5'],
							  'cryptedStepCheck' => $cURLRequest['cryptedStepCheck']
							 );
			$cURLRequest = curlChooseCategory(array(), $postVars);
			
			if($cURLRequest)
			{
				echo '<div id="chooseCategory" style="width: 500; height: 500; overflow: hidden;">
							'.$cURLRequest['markup'].'
						</div>';
			}
			// choose category
			
		
			// post land details
			// zip code manila 1006
			$postVars = array('FromEmail' 		 => 'usc_bsit_ric@yahoo.com',
							  'Privacy' 		 => 'C',
							  'contact_phone_ok' => 1,
						   	  'contact_text_ok'	 => 1,
						   	  'contact_phone'	 => '09161528603',
							  'contact_name'	 => 'frederick sandalo',
							  'PostingTitle'	 => 'Tower1 Plaza',
							  'GeographicArea'	 => '',	//40 characters only
							  'postal'			 => '1006',	//15 characters only
							  'PostingBody'		 => 'Tower1 Plaza Posting Body',
							  'Sqft'			 => '80',	//6 characters only
							  'Ask'				 => '50000',	//11 characters only
							  'Bedrooms'		 => '2',	//1-8
							  'bathrooms'		 => '2',	//1-19
							  'housing_type'	 => '1',
							  'laundry'			 => '1',
							  'parking'			 => '1',
							  'wheelaccess'		 => '1',
							  'no_smoking'		 => '1',
							  'is_furnished'	 => '1',
							  'outsideContactOK' => '1',
							  'random22'		 => $cURLRequest['random22'],
							  'random5'			 => $cURLRequest['random5'],
							  'cryptedStepCheck' => $cURLRequest['cryptedStepCheck']										 
 		   					 );

			$randoms = array('random22' => $cURLRequest['random22'],
							 'random5'	  => $cURLRequest['random5']
							);

			$cURLRequest = curlPostProperty(array(),$postVars);

			if( $cURLRequest )
			{
				echo '<div id="postPropertyResult" style="width: 500; height: 500; overflow: hidden;">
							'.$cURLRequest['markup'].'
						</div>';
			}
			// post land details
			
			
			// done with images  https://post.craigslist.org/k/_I1nVQ2Z4xGq45zkEJxeTw/CtTJF?s=editimage
			$postVars = array('a'        		 => 'add',
							  'file'	 		 => '@' . __DIR__ . '/ranch.JPG',
							  'random22' 		 => $cURLRequest['random22'],
							  'random5'	 		 => $cURLRequest['random5'],
							  'cryptedStepCheck' => $cURLRequest['cryptedStepCheck']
							 );
			$configuration = array('enctype' => 'multipart/form-data');

			$cURLRequest = curlPostImage($configuration, $postVars);
			
			if($cURLRequest)
			{
				echo 'done with images';
				echo '<div id="postImage" style="width: 500; height: 500; overflow: hidden;">
							'.$cURLRequest['markup'].'
					  </div>'; 
			}
		    // done with images  https://post.craigslist.org/k/_I1nVQ2Z4xGq45zkEJxeTw/CtTJF?s=editimage
			
			// preview https://post.craigslist.org/k/_I1nVQ2Z4xGq45zkEJxeTw/CtTJF?s=preview  WARNING 2-Steps here
			$postVars = array('a' 				 => 'fin',
							  'go' 				 => 'Done with Images',
							  'random22' 		 => $cURLRequest['random22'],
							  'random5'	 		 => $cURLRequest['random5'],
							  'cryptedStepCheck' => $cURLRequest['cryptedStepCheck']
							 );
			
			$cURLRequest = curlDoneWithImages(array(), $postVars);
				
			if($cURLRequest)
			{
				echo 'preview';
				echo '<div id="doneWithImages" style="width: 500; height: 500; overflow: hidden;">
							'.$cURLRequest['markup'].'
					  </div>';
			}
			// preview https://post.craigslist.org/k/_I1nVQ2Z4xGq45zkEJxeTw/CtTJF?s=preview

			
			// publish
			$postVars = array('cryptedStepCheck' => $cURLRequest['cryptedStepCheck'],
							  'continue'		 => 'y',
							  'go'				 => 'Continue'
							 );
			$configuration = array('CURLOPT_PROTOCOLS'         => CURLPROTO_HTTPS,
								   'CURLOPT_FOLLOWLOCATION'    => true,
								   'CURLOPT_SSL_VERIFYPEER'    => true,
								   'CURLOPT_SSL_VERIFYHOST'    => true,
								   'CURLOPT_UNRESTRICTED_AUTH' => true,
								   'random22'	       		   => $cURLRequest['random22'],
							  	   'random5'			 	   => $cURLRequest['random5'], 
								  );

			$cURLRequest = curlPublish($configuration, $postVars);
			
			if($cURLRequest)
			{
				echo 'publish';
				echo '<div id="publish" style="width: 500; height: 500; overflow: hidden;">
							'.$cURLRequest['markup'].'
					  </div>';
			}
			exit('frederick debugging here');
			// publish

		?>

<html>
	<head>
		<title>sample</title>
	</head>
	<body>
		sample body
	</body>
</html>