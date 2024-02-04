<?php


try {
    $dbconn = new PDO('mysql:host=localhost;dbname=notes_etudiant', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
