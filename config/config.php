<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'wellnessexpert');
 
/* Attempt to connect to MySQL database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}*/

function Abrirdb()
{
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "wellnessexpert";

    return new mysqli($server,$user,$password,$database);

}

function Cerrardb($conn){
    $conn -> close();
}



?>
