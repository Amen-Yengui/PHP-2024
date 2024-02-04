<?php
session_start();

$ref = $_GET['ref'];

?>

<form action="../control/photo_control.php" method="post" enctype="multipart/form-data">

    <br><label for="mon_fichier">Sélectionnez une photo de l'article :</label>
    <br><input type="file" name="mon_fichier" id="mon_fichier">
    <br><input type="hidden" name="ref" value="<?php echo $ref ?>" />

    <br> <input type="submit" value="Uploader">
</form>