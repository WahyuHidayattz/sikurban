<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$server     = "localhost";
$username   = "wahyu";
$password   = "123";
$database   = "sikurban";

$koneksi = mysqli_connect($server, $username, $password, $database);