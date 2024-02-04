<?php


try {
    $conn = new PDO('mysql:host=localhost;dbname=shopping1', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
