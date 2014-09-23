function markupBuilder(array $placeHolderValues, $htmlTemplateLocation, $propertyID)
{
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	
	$markup = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
				   <html>
					   <head>
							<title></title>
							<meta name="robots" content="noindex,nofollow">
							<link href="'.$placeHolderValues['mystyleCSS'].'" rel="stylesheet" type="text/css">
						</head>
						<body>
							<!--header-->
							<div class="header">
								<div class="header-container">
									<a href=""><img class="logo" src="'.HTTP_ROOT.'images/logo_rural.png"/></a>
								<!--
									<ul class="main-nav">
									<li class="current">BUYING</li>
									<li>SELLING</li>
									<li>MOVING</li>
									<li>INSURANCE</li>
									<li>CONTACT</li>
									</ul>
								-->
								</div>
							</div>

							<!--content body-->
							<div class="content">';

							if($placeHolderValues['status'])
							{
								$markup .= '<div style="color: #990033; font-size: 23px; margin: 10px 0;">';

								if($placeHolderValues['status'] == 'pending')
								{
									$markup .= 'Sale Pending';
								}

								if($placeHolderValues['status'] == 'sold')
								{
									$markup .= 'Sold!';
								}

								$markup .= '</div>';
							}

	$markup .= 				'<div class="property-title">';
	$markup .=					'<h2>';
									($placeHolderValues['address']) ? $markup .= $placeHolderValues['address']: $markup .= 'n/a';
	$markup .=					'</h2>';
	$markup .=					'<p class="h2 price">';
									($placeHolderValues['price'] < 0 ) ? $markup .= 'Contact seller for price' : $markup .= $placeHolderValues['price'];
	$markup .=					'</p>';
	$markup .=					'<p>apartment
								 <span class="beds">beds/bath: 
								';
									if($placeHolderValues['bed'] || $placeHolderValues['bath'])
									{
										if($placeHolderValues['bed'])
										{
											$markup .= $placeHolderValues['bed'] . ' bed';
										}
									
										if($placeHolderValues['bed'] && $placeHolderValues['bath'])
										{
											$markup .= '/';
										}
									
										if($placeHolderValues['bath'])
										{
											$markup .= $placeHolderValues['bath'] . ' bath';
										}
									}
									else
									{
										$markup .= 'n/a';
									}
	$markup .=					'</span>';
	$markup .=					'<span class="parking">parking lot: 1</span>';
	$markup .=					'</p>';
	$markup .= 				'</div>';
	$markup .= 				'<hr style="color: white;"/>';

							$sql 			= "select * from photos where ptid = ". $placeHolderValues['id'] . " order by porder asc";
							$photo 			= mysql_query($sql, $placeHolderValues['myConn']) or die(mysql_error());
							$imagePath 		= '/admin/photos/uploads/thumbs/';
							$smallImagePath = '/admin/photos/uploads/small_thumbs/';


	$markup .=				'<table class="main-content">';
	$markup .=					'<tr>';
	$markup .=						'<td class="photo">';
	$markup .=							'<div class="photo-content">';
											$counter = 1;
											$photoMarkup = '';
											
											while($row_photos = mysql_fetch_assoc($photo))
											{
												if($counter > 1)
												{
													$photoMarkup = '<div class="slide2">
																		<img src="'.$imagePath . $row_photos['location'].'"/>
																	</div>
																   ';
												}
												else
												{
													$markup .= '<div class="photo1">
																	<div class="slide1">
																		<img style="height: 435px;" src="'.$imagePath . $row_photos['location'].'"/>
																	</div>
																</div>
															   ';
												}
												
												if($counter == 5)
												{
													break;
												}
												
												$counter++;
											}
											
	$markup .=								'<div class="photo2">
												'.$photoMarkup.'
											 </div>
											';											
	$markup .=							'</div><!-- class="photo-content" -->';
	$markup .=						'</td><!-- class="photo" -->';
	
	$markup .=						'<td class="sidebar">
										<div class="agent-information">
											<table>
												<tr>
									';
	$markup .=										'<td>
														<img src="images/agentpicture.svg" style="visibility: hidden"/>
													 </td>
													';
	$markup .= 										'<td>';
	$markup .=											'<p class="h3">
															'.$placeHolderValues['sellerName'].'
														</p>';
	$markup .=											'<p class="phone">';
															( isset($placeHolderValues['sellerName']) && isset($placeHolderValues['sellerPhone']) ) ? $markup .= $placeHolderValues['sellerPhone']: $markup .= 'No Phone Number';
	$markup .=											'</p>';
	$markup .=										'</td>';
	$markup .=						'			</tr>
											</table>
										 <div><!-- class="agent-information" -->
									</td><!-- sidebar -->';
	
	$markup .=					'</tr>';
	$markup .=				'</table>';


	$markup .= 				'</div>
							<!--content body-->					
						</body>
					</html>
				  ';

	//write markup to a file
	$fileName = 'htmlTemplate/' . $propertyID . '.html';
	unlink($fileName);
	$htmlFile = fopen($fileName, 'w') or die('unable to write file');
	fwrite($htmlFile, $markup);
	fclose($htmlFile);

	return $fileName;
}