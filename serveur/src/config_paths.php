<?php

$rootPath = realpath(__DIR__ . '/../../');

$serveurPath = $rootPath . '/serveur/';
$clientPath = $rootPath . '/client/';


$projectName = basename($rootPath); 
$serveurUrl = '/' . $projectName . '/serveur/';
$clientUrl = '/' . $projectName . '/client/';
?>