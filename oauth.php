<?php
//start session
session_start();

include 'config.php';
include $includesDir . 'database.php';
//include google api files
include_once 'vendor/autoload.php';


// Enable error reporting
if ($debugEnable == "true"){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}


// New Google client
$gClient = new Google_Client();
$gClient->setApplicationName('Earl Greyders');
$gClient->setAuthConfigFile('client_secret.json');
$gClient->addScope(Google_Service_Oauth2::USERINFO_PROFILE);
$gClient->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
// New Google Service
$google_oauthV2 = new Google_Service_Oauth2($gClient);
// LOGOUT?
if (isset($_REQUEST['logout']))
{
	unset($_SESSION["auto"]);
	unset($_SESSION['token']);
	$gClient->revokeToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}
// GOOGLE CALLBACK?
if (isset($_GET['code']))
{
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
    return;
}
// PAGE RELOAD?
if (isset($_SESSION['token']))
{
    $gClient->setAccessToken($_SESSION['token']);
}
// Autologin?
if(isset($_GET["auto"]))
{
	$_SESSION['auto'] = $_GET["auto"];
}
// LOGGED IN?
if ($gClient->getAccessToken()) // Sign in
{
	//For logged in user, get details from google using access token
	try {
		$user = $google_oauthV2->userinfo->get();
		$user_id              = $user['id'];
		$first_name            = filter_var($user['givenName'], FILTER_SANITIZE_SPECIAL_CHARS);
		$last_name            = filter_var($user['familyName'], FILTER_SANITIZE_SPECIAL_CHARS);
		$email                = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
		$gender               = filter_var($user['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
		$profile_url          = filter_var($user['link'], FILTER_VALIDATE_URL);
		$profile_image_url    = filter_var($user['picture'], FILTER_VALIDATE_URL);
		$personMarkup         = "$email<div><img src='$profile_image_url?sz=50'></div>";
		$_SESSION['token']    = $gClient->getAccessToken();
		$_SESSION['google_userid']	= $user_id;

		// Show user


		$boolarray = Array(false => 'false', true => 'true');

		// time to check if they exist
		$query = "SELECT * FROM users WHERE google_userid = '$user_id'";
		if ($result = $conn->query($query)){
		  $row_cnt = $result->num_rows;
		  if ($row_cnt < 1){
				// we don't know them
				// here is where we insert to database as level 0, not approved
		    $query = "INSERT INTO `users` (google_userid, email, firstname, lastname, seen, level)".
								 "VALUES ('$user_id', '$email', '$first_name', '$last_name', now(), '0')";
				if ($conn->query($query) === TRUE) {
					if ($debugEnable == "true"){
				 		echo "Created User successfully\n";
				 	}
				} else {
				 	if ($debugEnable == "true"){
			    	echo "Insert failed!\n";
				 	  echo "Error: " . $query . "\n" . $conn->error . "\n";
				 	}
				}
				echo '<br /><a class="logout" href="?logout=1">Logout</a>';
		  }
		  else if ($row_cnt > 1){
				// they exist multiple times? Shouldn't happen
		    printf ("multiple hits, wut?\n");
		  }
		  else{
				//we've seen them before

		    $obj = $result->fetch_object();
				echo '<br /><a href="'.$profile_url.'" target="_blank"><img src="'.$profile_image_url.'?sz=100" /></a>';
 	 			echo '<br /><a class="accounts" href="accounts.php">Accounts</a>';
				echo '<br /><a class="logout" href="?logout=1">Logout</a>';
				if ($debugEnable == "true"){
					echo "<br /><br />User exists...\n";
				}
		  }
			$result->close();
		}

		//list all user details
		if ($debugEnable == "true"){
			echo '<p>Was automatic login? '.$boolarray[isset($_SESSION["auto"])].'</p>';
			echo '<pre>';
			print_r($user);
			echo '</pre>';
		}
	} catch (Exception $e) {
		// The user revoke the permission for this App! Therefore reset session token
		unset($_SESSION["auto"]);
		unset($_SESSION['token']);
		header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	}
}
else // Sign up
{
    //For Guest user, get google login url
    $authUrl = $gClient->createAuthUrl();

	// Fast access or manual login button? call this with ?auto
	if(isset($_GET["auto"]))
	{
		header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
	}
	else
	{
		echo '<p>Login?</p>';
		echo '<a class="login" href="'.$authUrl.'"><img src="images/google-login-button.png" /></a>';
	}
}
?>
