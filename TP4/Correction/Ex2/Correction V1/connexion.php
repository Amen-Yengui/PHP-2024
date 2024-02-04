<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=shopping', 'root', '');
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
