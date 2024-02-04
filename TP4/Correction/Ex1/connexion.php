<?php
// Méthode 1 : mysqli
// $conn = mysqli_connect('localhost', 'root', '', 'shopping');

// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Méthode 2 : PDO
try {
    $conn = new PDO('mysql:host=localhost;dbname=shopping', 'root', '');
    // set the PDO error mode to exception
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}