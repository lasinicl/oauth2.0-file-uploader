<!--IT15025722 Liyanage L.C.-->
<?php

	session_start();
	$url_array = explode('?', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI'].'upload.php');
	$url = $url_array[0];

	require_once 'google-api-php-client/src/Google_Client.php';
	require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
	//create new Google_Client object
	$google_client = new Google_Client();
	//set credential obtained for the application
	$google_client->setClientId('92504786136-5tud7r80as4uiklikddqiuer3b0eg1ks.apps.googleusercontent.com');
	$google_client->setClientSecret('ue6PLeGMFeN4tXmQd-r3AXYo');
	$google_client->setRedirectUri($url);
	//full, permissive scope to access all of a user's files, excluding the Application Data folder. 
	$google_client->setScopes(array('https://www.googleapis.com/auth/drive'));

	if (isset($_GET['code'])) 
	{
		//exchange an authorization code for an access token
		$_SESSION['access_token'] = $google_client->authenticate($_GET['code']);
		header('location: upload.php');
		exit();
	} 
	elseif (!isset($_SESSION['access_token'])) 
	{
		$google_client->authenticate();
	}


?>



