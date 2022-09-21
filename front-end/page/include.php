<?php

	//Temporary configuration placeholder
	$conf = [];

	//Define directory root constant
	define('ROOT', str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . ($conf['root'] ?? '/')));

	//Define other properties
	const RECAPTCHA_API_KEY = '6LcTQIEeAAAAAGvsprOZVyMEp6FT_mSjeU6MWIkc';
	const RECAPTCHA_API_SECRET = '6LcTQIEeAAAAAMtKCBAkqlh9ky-kWEi0sIc5malc';
	const GOOGLE_MAPS_API_KEY = '';

	//Include required files
	require_once ROOT . 'page/PageComponents.class.php';

	//User state
	if(true) {
		\Page\PageComponents::$loggedInUserData = [
			'id' => 6757,
			'is_company' => true,
			'name_first' => 'Janez',
			'name_last' => 'Novak'
		];
	}

	/**
	 * @param bool $trim
	 *
	 * @return string
	 */
	function guid($trim = true) {
		// Windows
		if(function_exists('com_create_guid') === true) {
			if($trim === true)
				return trim(com_create_guid(), '{}');
			else
				return com_create_guid();
		}

		// OSX/Linux
		if(function_exists('openssl_random_pseudo_bytes') === true) {
			$data = openssl_random_pseudo_bytes(16);
			$data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
			$data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
			return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
		}

		mt_srand((double) microtime() * 10000);
		$charid = strtolower(md5(uniqid(rand(), true)));
		$hyphen = chr(45);                  // "-"
		$lbrace = $trim ? "" : chr(123);    // "{"
		$rbrace = $trim ? "" : chr(125);    // "}"
		$guidv4 = $lbrace .
			substr($charid, 0, 8) . $hyphen .
			substr($charid, 8, 4) . $hyphen .
			substr($charid, 12, 4) . $hyphen .
			substr($charid, 16, 4) . $hyphen .
			substr($charid, 20, 12) .
			$rbrace;
		return $guidv4;
	}
