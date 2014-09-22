<?php
	/*****
	 * 	Line 27: <option  value="aub" >auburn, al, us</option>
		Line 61: <option  value="bhm" >birmingham, al, al, us</option>
		Line 171: <option value="dhn" >dothan, al, al, us</option>
		Line 234: <option value="anb" >gadsden, al, us</option>
		Line 289: <option value="hsv" >huntsville, al, us</option>
		Line 402: <option value="mob" >mobile, al, us</option>
		Line 410: <option value="mgm" >montgomery, al, us</option>
		Line 629: <option value="msl" >the shoals, al, us</option>
		Line 648: <option value="tsc" >tuscaloosa, al, us</option>
	 *****/
	class AlabamaConfiguration
	{
		public function returnAuburnConfiguration($postVarsAndConfigurations)
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	    => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
																						   'CURLOPT_RETURNTRANSFER' => 1,
																						   'CURLOPT_COOKIEJAR'      => $cookieFilePath,
																						   'CURLOPT_COOKIEFILE'     => $cookieFilePath,
																						   'CURLOPT_REFERER'        => 'http://www.craigslist.org',
																						   'CURLOPT_USERAGENT'      => $userAgent,
																						   'formatURL'			    => false
																						 ),
																 'postVars'		 => array()
																),
											'selectLocation' => array('configuration' => array('CURLOPT_URL' 	   	   	   => 'https://accounts.craigslist.org/login/pstrdr?areaabb='.$areaabb.'',
																								'CURLOPT_RETURNTRANSFER'   => 1,
																								'CURLOPT_COOKIEJAR'  	   => $cookieFilePath,
																								'CURLOPT_COOKIEFILE' 	   => $cookieFilePath,
																								'CURLOPT_REFERER'    	   => 'http://accounts.craigslist.org',
																								'CURLOPT_USERAGENT'  	   => $userAgent,
																								'formatURL'			   	   => false
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
											'chooseCategory' => array('configuration' => array('CURLOPT_URL' 	   	   	 => 'https://post.craigslist.org/k/%s/%s',
																								'CURLOPT_RETURNTRANSFER' => 1,
																								'CURLOPT_COOKIEJAR'  	 => $cookieFilePath,
																								'CURLOPT_COOKIEFILE' 	 => $cookieFilePath,
																								'CURLOPT_REFERER'    	 => 'https://accounts.craigslist.org/k/%s/%s?s=hcat',
																								'CURLOPT_USERAGENT'  	 => $userAgent,
																								'CURLOPT_POST'		     => true,
																								'CURLOPT_FOLLOWLOCATION' => true,
																								'formatURL'			     => true,
																								'formatReferer'		   	 => true
																							 ),
																	  'postVars'	  => array('id' => $chooseCategoryId)
																	 ),
											'postProperty'   => array('configuration' => array('CURLOPT_URL' 	   	    => 'https://post.craigslist.org/k/%s/%s',
																							   'CURLOPT_RETURNTRANSFER' => 1,
																							   'CURLOPT_COOKIEJAR'  	=> $cookieFilePath,
																							   'CURLOPT_COOKIEFILE' 	=> $cookieFilePath,
																							   'CURLOPT_REFERER'    	=> 'https://accounts.craigslist.org/k/%s/%s?s=edit',
																							   'CURLOPT_USERAGENT'  	=> $userAgent,
																							   'CURLOPT_POST'		    => true,
																							   'CURLOPT_FOLLOWLOCATION' => true,
																							   'formatURL'			    => true,
																							   'formatReferer'		    => true
																							 ),
																	  'postVars'		 => array('FromEmail' 		 => '',
																							  	  'Privacy' 		 => '',
																							  	  'contact_phone_ok' => '',
																							  	  'contact_text_ok'	 => '',
																							  	  'contact_phone'	 => '',
																							  	  'contact_name'	 => '',
																							  	  'PostingTitle'	 => '',
																							  	  'GeographicArea'	 => '',		//40 characters only
																							  	  'postal'			 => '',	//15 characters only
																							  	  'PostingBody'		 => '',
																							  	  'Sqft'			 => '',	//6 characters only
																							  	  'Ask'				 => '',//11 characters only
																							  	  'Bedrooms'		 => '',	//1-8
																							  	  'bathrooms'		 => '',	//1-19
																							  	  'housing_type'	 => '',
																							  	  'laundry'			 => '',
																							  	  'parking'			 => '',
																							  	  'wheelaccess'		 => '',
																							  	  'no_smoking'		 => '',
																							  	  'is_furnished'	 => '',
																							  	  'outsideContactOK' => '',
																							 	  )
																	),
											'geoverify'		=> array('configuration' 	=> array('CURLOPT_URL' 	   	      => 'https://post.craigslist.org/k/%s/%s',
																							   	 'CURLOPT_RETURNTRANSFER' => 1,
																							   	 'CURLOPT_COOKIEJAR'  	  => $cookieFilePath,
																							   	 'CURLOPT_COOKIEFILE' 	  => $cookieFilePath,
																							   	 'CURLOPT_REFERER'    	  => 'https://post.craigslist.org/k/%s/%s?s=geoverify',
																							   	 'CURLOPT_USERAGENT'  	  => $userAgent,
																							   	 'CURLOPT_POST'		      => true,
																							   	 'CURLOPT_FOLLOWLOCATION' => true,
																							   	 'formatURL'			  => true,
																							   	 'formatReferer'		  => true),
																	 'postVars'			=> array('xstreet0' 		  => '',
																	 							 'xstreet1' 		  => '',
																	 							 'city'				  => '',
																	 							 'region'			  => '',
																	 							 'postal'			  => '',
																	 							 'lat'				  => '',
																	 							 'lng'				  => '',
																	 							 'AreaID' 	 		  => '',
																	 							 'seenmap'			  => '1',
																	 							 'draggedpin' 		  => '0',
																	 							 'clickedinclude' 	  => '0',
																	 							 'geocoder_latitude'  => '',
																	 							 'geocoder_longitude' => '',
																	 							 'geocoder_accuracy'  => '',
																	 							 'geocoder_version'	  => ''
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
											'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
																		),
										   'sendVerificationPhone' => array('configuration' => array('CURLOPT_URL' 	   	   	 => 'https://post.craigslist.org/k/%s/%s',
																									'CURLOPT_RETURNTRANSFER' => 1,
																									'CURLOPT_COOKIEJAR'  	 => $cookieFilePath,
																									'CURLOPT_COOKIEFILE' 	 => $cookieFilePath,
																									'CURLOPT_REFERER'    	 => 'https://post.craigslist.org/k/%s/%s?s=pn',
																									'CURLOPT_USERAGENT'  	 => $userAgent,
																									'CURLOPT_POST'		     => true,
																									'CURLOPT_FOLLOWLOCATION' => true,
																									'formatURL'			  	 => true,
																									'formatReferer'		  	 => true
										   															),
										   								    'postVars'	   => array('n' 	   => '',
										   								   							'n2' 	   => '',
										   								   							'n3' 	   => '',
										   								   							'callType' => 'sms',
										   								   							'callLang' => '',
										   								   							'go'	   => 'send the code!'
										   								   						   )
										   								  ),
										   'sendVerificationCode'  => array('configuration' => array(),
										   									'postVars'		=> array()
										   									)
									);
			
			return $stepsAndConfiguration;
		}
		
		public function returnBirminghamConfiguration()
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
					'CURLOPT_RETURNTRANSFER' => 1,
					'CURLOPT_COOKIEJAR'     => $cookieFilePath,
					'CURLOPT_COOKIEFILE'    => $cookieFilePath,
					'CURLOPT_REFERER'       => 'http://www.craigslist.org',
					'CURLOPT_USERAGENT'     => $userAgent,
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
							'postVars'	  => array('id' => $chooseCategoryId)
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
					'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
				
			return $stepsAndConfiguration;
		}
		
		public function returnDothanConfiguration()
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
					'CURLOPT_RETURNTRANSFER' => 1,
					'CURLOPT_COOKIEJAR'     => $cookieFilePath,
					'CURLOPT_COOKIEFILE'    => $cookieFilePath,
					'CURLOPT_REFERER'       => 'http://www.craigslist.org',
					'CURLOPT_USERAGENT'     => $userAgent,
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
							'postVars'	  => array('id' => $chooseCategoryId)
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
					'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
				
			return $stepsAndConfiguration;
		}

		public function returnGadsdenConfiguration()
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
					'CURLOPT_RETURNTRANSFER' => 1,
					'CURLOPT_COOKIEJAR'     => $cookieFilePath,
					'CURLOPT_COOKIEFILE'    => $cookieFilePath,
					'CURLOPT_REFERER'       => 'http://www.craigslist.org',
					'CURLOPT_USERAGENT'     => $userAgent,
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
							'postVars'	  => array('id' => $chooseCategoryId)
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
					'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
		
			return $stepsAndConfiguration;
		}
		
		public function returnHuntsvilleConfiguration()
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
					'CURLOPT_RETURNTRANSFER' => 1,
					'CURLOPT_COOKIEJAR'     => $cookieFilePath,
					'CURLOPT_COOKIEFILE'    => $cookieFilePath,
					'CURLOPT_REFERER'       => 'http://www.craigslist.org',
					'CURLOPT_USERAGENT'     => $userAgent,
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
							'postVars'	  => array('id' => $chooseCategoryId)
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
					'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
		
			return $stepsAndConfiguration;
		}
		
		public function returnMobileConfiguration()
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
					'CURLOPT_RETURNTRANSFER' => 1,
					'CURLOPT_COOKIEJAR'     => $cookieFilePath,
					'CURLOPT_COOKIEFILE'    => $cookieFilePath,
					'CURLOPT_REFERER'       => 'http://www.craigslist.org',
					'CURLOPT_USERAGENT'     => $userAgent,
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
							'postVars'	  => array('id' => $chooseCategoryId)
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
					'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
		
			return $stepsAndConfiguration;
		}
		

		public function returnMontgomeryConfiguration()
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
					'CURLOPT_RETURNTRANSFER' => 1,
					'CURLOPT_COOKIEJAR'     => $cookieFilePath,
					'CURLOPT_COOKIEFILE'    => $cookieFilePath,
					'CURLOPT_REFERER'       => 'http://www.craigslist.org',
					'CURLOPT_USERAGENT'     => $userAgent,
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
							'postVars'	  => array('id' => $chooseCategoryId)
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
					'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
		
			return $stepsAndConfiguration;
		}
		
		public function returnTheSholesConfiguration()
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
					'CURLOPT_RETURNTRANSFER' => 1,
					'CURLOPT_COOKIEJAR'     => $cookieFilePath,
					'CURLOPT_COOKIEFILE'    => $cookieFilePath,
					'CURLOPT_REFERER'       => 'http://www.craigslist.org',
					'CURLOPT_USERAGENT'     => $userAgent,
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
							'postVars'	  => array('id' => $chooseCategoryId)
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
					'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
		
			return $stepsAndConfiguration;
		}
		
		public function returnTuscaloosaConfiguration()
		{
			$stepsAndConfiguration = array('login'		=> array('configuration' => array('CURLOPT_URL' 	   	   => 'https://accounts.craigslist.org/login?LoginType=L&step=confirmation&originalURI=%2Flogin&rt=&rp=&inputEmailHandle='.$inputEmailHandle.'&inputPassword='.$inputPassword.'&submit=Log%20In',
					'CURLOPT_RETURNTRANSFER' => 1,
					'CURLOPT_COOKIEJAR'     => $cookieFilePath,
					'CURLOPT_COOKIEFILE'    => $cookieFilePath,
					'CURLOPT_REFERER'       => 'http://www.craigslist.org',
					'CURLOPT_USERAGENT'     => $userAgent,
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
							'postVars'	  => array('id' => $chooseCategoryId)
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
					'publish'			=> array('configuration' 	=> array('CURLOPT_URL' 	   	   	  => 'https://post.craigslist.org/k/%s/%s',
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
		
			return $stepsAndConfiguration;
		}

		
		
		public function selectCity($city)
		{
			switch($city)
			{
				case 'aub':
					$this->returnAuburnConfiguration();
					break;
				case 'bhm':
					$this->returnBirminghamConfiguration();
					break;
				case 'dhn':
					$this->returnDothanConfiguration();
					break;
				case 'anb':
					$this->returnGadsdenConfiguration();
					break;
				case 'hsv':
					$this->returnHuntsvilleConfiguration();
					break;
				case 'mob':
					$this->returnMobileConfiguration();
					break;
				case 'mgm':
					$this->returnMontgomeryConfiguration();
					break;
				case 'msl':
					$this->returnTheSholesConfiguration();
					break;
				case 'tsc':
					$this->returnTuscaloosaConfiguration();
					break;
				default:
					return false;
					break;
			}
		}
	}