<?php

	# Start the session
    if(!isset($_SESSION)){session_start();}

    include'../conn.php';
	# Autoload the required files
	require_once __DIR__ . '../../vendor/autoload.php';

	# Set the default parameters
	$fb = new Facebook\Facebook([
		'app_id' => '389979551384187',
		'app_secret' => 'c3acae31b607cc6f7182fa2234be6cf2',
		'default_graph_version' => 'v2.4',
	]);
	$redirect = 'http://msccoiffeur.com.br/formViewsDB/userFbCRUD.php';
//    $redirect = 'http://localhost/fbLogin/';

	# Create the login helper object
	$helper = $fb->getRedirectLoginHelper();

	# Get the access token and catch the exceptions if any
	try {
		$accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	# If the
	if (isset($accessToken)) {
		// Logged in!
		// Now you can redirect to another page and use the
		// access token from $_SESSION['facebook_access_token']
		// But we shall we the same page

		// Sets the default fallback access token so
		// we don't have to pass it to each request
		$fb->setDefaultAccessToken($accessToken);

		try {
			$response = $fb->get('/me?fields=email,name');
			$userNode = $response->getGraphUser();
		}catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

        // SET SESSION USER DETAILS
        $_SESSION ['userIdFb'] = (int) $userNode->getId();
        $_SESSION ['userNameFb'] =  $userNode->getName();
        $_SESSION ['userEmailFb'] = $userNode->getProperty('email');
        $_SESSION ['userImageFb'] = 'https://graph.facebook.com/'.$userNode->getId().'/picture?width=100';


        //Print the user Details
//        echo $_SESSION ['userNameFb'].'<br>';
//        echo $_SESSION ['userIdFb'].'<br>';
//        echo $_SESSION ['userEmailFb'].'<br>';
//        echo "<img src=".$_SESSION ['userImageFb']." /><br><br>";

	}else{
		$permissions  = ['email'];
		$loginUrl = $helper->getLoginUrl($redirect,$permissions);
		/*/echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';*/
	}
