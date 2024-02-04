<?php


try {
    $conn = new PDO('mysql:host=localhost;dbname=shop', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
