<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "usuario";


//Conexão ao banco

//$conn = new PDO("mysql: host=$host;dbname=".$dbname, $user, $pass);

$conection = mysqli_connect($host, $user, $pass, $dbname);
/**
 * 
 * 
 */

$result_usuario = "SELECT DISTINCT email FROM usuarios";
$resultado_usuario = mysqli_query($conection, $result_usuario);

while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
   // echo "E-mail: " . $row_usuario['email'] . "<br><hr>";
}
?>