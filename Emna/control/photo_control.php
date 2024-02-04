<?php
$ref = $_POST["ref"];

if (isset($_FILES['mon_fichier']) && $_FILES['mon_fichier']['error'] == 0) {

    $nom_fichier = $_FILES['mon_fichier']['name'];
    $fichier = $_FILES['mon_fichier'];
    // autoriser jpeg
    $allowed_file_types = array('jpg');
    $file_info = pathinfo($fichier['name']);
    if (!in_array(strtolower($file_info['extension']), $allowed_file_types)) {
        echo 'Type de fichier non autorisé.';
        exit;
    }
    //Taille maximale: 5MO
    if ($_FILES['mon_fichier']['size'] > 5000000) {
        echo "Désolé, le fichier est volumineux.";
    }

    $destination = '../Article_photo/' . 'photo_' . $ref . '.jpg';
    // Déplace le fichier de l'emplacement temporaire vers le répertoire permanent.    
    if (move_uploaded_file($_FILES['mon_fichier']['tmp_name'],     $destination)) {
        echo 'Fichier téléchargé avec succès.';
    } else {
        echo 'Une erreur est survenue lors du téléchargement.';
    }
} else {
    echo 'Une erreur est survenue lors du téléchargement du fichier.';
}
