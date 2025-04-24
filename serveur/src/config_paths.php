<?php
if (!defined('SECURE_ACCESS')) {
    http_response_code(403);
    exit('Accès interdit.');
}


$rootPath = realpath(__DIR__ . '/../../');
$serveurPath = $rootPath . '/serveur/';
$clientPath = $rootPath . '/client/';


$scriptName = $_SERVER['SCRIPT_NAME'];
$realDir = str_replace('\\', '/', realpath(__DIR__ . '/../../'));
$documentRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']));
$relativeUrl = str_replace($documentRoot, '', $realDir);
if ($relativeUrl === '') $relativeUrl = '/';

$baseUrl = rtrim($relativeUrl, '/') . '/';

$serveurUrl = $baseUrl . 'serveur/';
$clientUrl  = $baseUrl . 'client/';
?>