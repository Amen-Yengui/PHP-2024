<?php
/*$conn = mysqli_connect('localhost','root','','commerciale');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}*/

try
{
    $conn= new PDO('mysql:host=localhost;dbname=shopping','root','');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>