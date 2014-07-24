<?php
	
	function extractVerificationCodeVersion2($transcription)
	{
		$explodedTranscription = explode(' ', $transcription);
		$verificationCode = array();

		foreach($explodedTranscription as $word)
		{
			switch($word)
			{
				case 'zero':
					$verificationCode[] = 0;
					break;
				case 'one':
					$verificationCode[] = 1;
					break;
				case 'two';
					$verificationCode[] = 2;
					break;
				case 'three':
					$verificationCode[] = 3;
					break;
				case 'four':
					$verificationCode[] = 4;
					break;
				case 'five':
					$verificationCode[] = 5;
					break;
				case 'six':
					$verificationCode[] = 6;
					break;
				case 'seven':
					$verificationCode[] = 7;
					break;
				case 'eight':
					$verificationCode[] = 8;
					break;
				case 'nine':
					$verificationCode[] = 9;
					break;
				default:
					continue;
					break;
			}
		}

		$verificationCode = array_slice($verificationCode, 0, count($verificationCode)/2 ); // first half would do
		$verificationCode = implode('', $verificationCode);
		
		return $verificationCode;
	}

	$transcription = "Liz pass code for any reason any requests for it is a scam your Craig's List secret pass code is five five two zero five Once again your code is five five two zero five If you are not validating a Craigslist account please disregard.";
	
	echo "<pre>";
	var_Dump( extractVerificationCodeVersion2($transcription) );
?>