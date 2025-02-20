<?php
require 'vendor/autoload.php';

use Google\Client;
use Google\Service\Drive;

function getClient()
{
    $client = new Client();
    $client->setApplicationName("Subida a Google Drive");
    $client->setScopes(Drive::DRIVE_FILE);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    $client->setRedirectUri('http://localhost/Dashboard_index/oauth2callback.php');

    // Cargar el token de acceso, si existe
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // Si no hay un token de acceso válido, redirigir al usuario
    if ($client->isAccessTokenExpired()) {
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Redirigir al usuario a la página de autenticación de Google
            $authUrl = $client->createAuthUrl();
            header('Location: ' . $authUrl);
            exit();
        }
    }
    return $client;
}

// Solo ejecutar la subida del archivo si ya tenemos un token válido
if (file_exists('token.json')) {
    $client = getClient();
    $service = new Drive($client);

    $fileMetadata = new Drive\DriveFile([
        'name' => 'archivo_prueba.txt'
    ]);

    $content = "Este es un archivo de prueba para comprobar la API de Google Drive.";

    $file = $service->files->create($fileMetadata, [
        'data' => $content,
        'mimeType' => 'text/plain',
        'uploadType' => 'multipart'
    ]);

    if ($file) {
        echo "✅ La API funciona correctamente. ID del archivo: " . $file->id;
    } else {
        echo "❌ Error al subir el archivo de prueba.";
    }
} else {
    $client = new Client();
    $client->setAuthConfig('credentials.json');
    $client->setRedirectUri('http://localhost/Dashboard_index/oauth2callback.php');
    $client->setScopes(Drive::DRIVE_FILE);
    $authUrl = $client->createAuthUrl();
    header('Location: ' . $authUrl);
    exit();
}
?>