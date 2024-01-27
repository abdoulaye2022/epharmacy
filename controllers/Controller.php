<?php
require_once ('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/epharmacy');
$dotenv->load();

require_once "config/DB.php";
require_once "models/Auth.php";

$db = new DB($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
$cn = $db->getConnection();

$auth = new Auth();