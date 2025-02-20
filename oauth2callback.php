<?php
require 'vendor/autoload.php';

$client = new Google\Client();
$client->setAuthConfig('credentials.json');
$client->setRedirectUri('http://localhost/Dashboard_index/oauth2callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    file_put_contents('token.json', json_encode($token));
    header('Location: test_drive.php');
    exit;
}