<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL|E_STRICT);
$servername = "store-database";
$username = "root";
$password = "123";
$dbname = "estore";
var_dump("env", getenv('MYSQL_SERVER'));
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

return $conn;
