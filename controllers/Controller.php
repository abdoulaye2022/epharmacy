<?php
session_start();

require_once ('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/epharmacy');
$dotenv->load();

$client = new Google_Client();
$client->setClientId($_ENV['CLIENT_ID_GOOGLE']);
$client->setClientSecret($_ENV['SECRET_CLIENT_GOOGLE']);
$client->setRedirectUri($_ENV['REDIRECT_URL_GOOGLE']);
$client->addScope('openid profile email'); // Ajouter d'autres scopes si nécessaire

$client->setHttpClient(new GuzzleHttp\Client(['verify' => false]));

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

if(isset($_GET['code'])) {
	$code = $_GET['code'];

	// Échanger le code d'autorisation contre un jeton d'accès
	$token = $client->fetchAccessTokenWithAuthCode($code);

	// Récupérer l'adresse e-mail de l'utilisateur
	if (isset($token['id_token'])) {
	    $payload = $client->verifyIdToken($token['id_token']);  

	    if($helper->isValidEmail($payload['email'])) {
			$email = $helper->validateString($payload['email']);

			$user = $auth->login($email);

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
			$error = "E-mail is invalid.";
		}
	}
}
?>