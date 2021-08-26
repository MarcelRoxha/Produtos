<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "produtos";


//Conexão ao banco

//$conn = new PDO("mysql: host=$host;dbname=".$dbname, $user, $pass);

$conection = mysqli_connect($host, $user, $pass, $dbname);

?>