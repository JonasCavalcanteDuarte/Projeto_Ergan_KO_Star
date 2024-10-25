<?php

$host="localhost";
$user="root";
$pass="123";
$bd="Proj_Rafa";

$conn = new mysqli($host, $user, $pass, $bd);

/*Check connection*/
if ($conn->connect_errno){
    die("Connect failed: ".$conn->connect_error);
    mysqli_close($conn);
    exit();
}
?>