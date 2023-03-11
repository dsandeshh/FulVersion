<?php
$dbhost ="localhost";
$dbuser ="root";
$dbpass ="";
$dbname="quizz";

$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
//if some connection is not real or match to real then it should show error

if(mysqli_connect_errno()){ 
    die("Database Connection Failed" . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
}

?>