<?php
session_start();

require_once ('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['DOCUMENT_ROOT'] . '/epharmacy/' : $_SERVER['DOCUMENT_ROOT'] . "/");
$dotenv->load();

$client = new Google_Client();
$client->setClientId($_ENV['CLIENT_ID_GOOGLE']);
$client->setClientSecret($_ENV['SECRET_CLIENT_GOOGLE']);
$client->setRedirectUri($_ENV['REDIRECT_URL_GOOGLE']);
$client->addScope('openid profile email');

$login_url = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize";

$params = array (
	'client_id' => $_ENV['CLIENT_ID_OUTLOOK'],
	'clientSecret' => $_ENV['SECRET_ID_OUTLOOK'],
	'redirect_uri' => $_ENV['REDIRECT_URL_OUTLOOK'],
	'response_type' =>'code',
	'response_mode' => 'query',
	'scope' => 'openid profile email User.Read offline_access Calendars.ReadWrite',
	'state' => 12345
);

$client->setHttpClient(new GuzzleHttp\Client(['verify' => false]));

$sso_email = null;

if(isset($_GET['code']) && !isset($_GET['state'])) {
	$code = $_GET['code'];

	// Échanger le code d'autorisation contre un jeton d'accès
		$token = $client->fetchAccessTokenWithAuthCode($code);

	// Récupérer l'adresse e-mail de l'utilisateur
	if (isset($token['id_token'])) {
	    $payload = $client->verifyIdToken($token['id_token']);  
	    $sso_email = $payload['email'];
	    
	}
} else if(isset($_GET['code']) && isset($_GET['state'])) {
	$clientId = urlencode($_ENV['CLIENT_ID_OUTLOOK']);
	$clientSecret = urlencode($_ENV['SECRET_ID_OUTLOOK']);
	$redirectUri = urlencode($_ENV['REDIRECT_URL_OUTLOOK']);

	$data = "client_id=$clientId&client_secret=$clientSecret&grant_type=authorization_code&scope=https://graph.microsoft.com/User.Read&code={$_GET['code']}&redirect_uri=$redirectUri";

	$ch = curl_init ();
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/x-www-form-urlencoded'
	));

	curl_setopt($ch, CURLOPT_URL, "https://login.microsoftonline.com/common/oauth2/v2.0//token");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$rez = json_decode (curl_exec($ch), 1);

	var_dump($rez); die;

	// recupere l'adresse courriel de l'utilisateur
	$ch = curl_init ();

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$rez['access_token'],
			'Content-Type: application/json'
		));

	curl_setopt($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$rez = json_decode(curl_exec($ch), 1);
	echo $rez['userPrincipalName']; die;
}

require_once "config/DB.php";
require_once "helpers/Helper.php";

require_once "models/Auth.php";
require_once "models/User.php";
require_once "models/Profil.php";

if (!isset($_SESSION['id']) && $_SERVER['REQUEST_URI'] != "/epharmacy/index.php" && $_GET['code'] == null) {
   	header("location: index.php");
   	exit();
};


$db = new DB($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
$cn = $db->getConnection();

$helper = new Helper();
$auth = new Auth($cn);
$user = new User($cn);

$error = "";

if(isset($sso_email) && !empty($sso_email)) {
	if($helper->isValidEmail($sso_email)) {
		$email = $helper->validateString($sso_email);

		$user = $auth->login($email);

		if($user) {
			if(!$auth->userAccountIsBlock($email)) {
				if($user['role_id'] == 1 || $user['role_id'] == 2) {
					header("location: dashboard.php");
					exit();
				} else if($user['role_id'] == 3) {
					header("location: home.php");
					exit();
				} else {
					$error = "An error occurred. Please try again.";
				}
			} else {
				$error = "Your account has been blocked. Please contact the administrator for assistance.";
			}
		} else {
			if(isset($_GET['code'])) {
				header("location: index.php?error=1");
				exit();
			}
			$error = "Invalid credentials. Please check your email address and password.";
		}
	} else {
		$error = "E-mail is invalid.";
	}
}
?>