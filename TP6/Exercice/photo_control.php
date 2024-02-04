<?php
// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {
    $ref = $_POST['ref']; // Récupère l'identifiant de l'article
    $file_name = $_FILES['photo']['name']; // Récupère le nom du fichier
    $file_size = $_FILES['photo']['size']; // Récupère la taille du fichier
    $file_tmp = $_FILES['photo']['tmp_name']; // Récupère le nom temporaire du fichier
    $file_type = $_FILES['photo']['type']; // Récupère le type du fichier
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // Récupère l'extension du fichier
    $extensions = array("jpeg", "jpg"); // Liste des extensions autorisées

    if (!in_array(strtolower($file_ext), $extensions)) { // vérifier type
        echo 'Type de fichier non autorisé.';
        exit;
    } else {
        if ($file_size > 5242880) { // vérifier taille
            echo "la taille autorisée est dépassée";
            exit;
        } else {

            $new_file_name = "photo_" . $ref . "." . $file_ext; // Construit le nouveau nom de fichier
            $upload_path = '../Photo/' . $new_file_name; // Chemin complet pour enregistrer le fichier  
            // $upload_path = 'uploads/' . $new_file_name; // Chemin complet pour enregistrer le fichier    
            if (move_uploaded_file($file_tmp,  $upload_path)) {
                echo 'Fichier téléchargé avec succès.';
                header("Location: view_article.php?refimg=" . $ref . "&photo=" . $new_file_name);
            } else {
                echo 'Une erreur est survenue lors du téléchargement.';
            }
        }
    }
}