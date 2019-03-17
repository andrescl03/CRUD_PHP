<?php

$host = 'localhost';
$user = 'root';
$password ='mysql';
$database = 'bd_alumno';
$port= 3306;

 $db = mysqli_connect($host, $user, $password, $database, $port);
 mysqli_query($db , "SET NAMES 'utf8' ");
 
 
?>