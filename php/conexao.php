<?php

require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

$host=$_ENV['HOST'];
$user=$_ENV['USER'];
$pass=$_ENV['PASS'];
$bd=$_ENV['DATABASE'];

$conn = new mysqli($host, $user, $pass, $bd);

/*Check connection*/
if ($conn->connect_errno){
    die("Connect failed: ".$conn->connect_error);
    mysqli_close($conn);
    exit();
}
?>