<?php 
$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'login_php';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
} catch (PDOException $e){
    die('Connected Failed:'.$e->getMessage());

}




?>