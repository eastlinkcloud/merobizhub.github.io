<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'sales';

$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
?>
