<html>

<head>
    <title>Télécharger une photo</title>
</head>

<body>
    <?php
    if (isset($_GET['refimg']) || isset($_GET['refmdf'])) {
        if (isset($_GET['refimg'])) {
            $ref = $_GET['refimg'];
        } else {
            if (isset($_GET['refmdf'])) {
                $ref = $_GET['refmdf'];
            }
        }
    }
    ?>
    <h2>Télécharger une photo pour l'article</h2>
    <form action="../Control/photo_control.php" method="post" enctype="multipart/form-data">
        <label> Référence : </label>
        <input type="text" name="ref" value="<?= $ref ?>"> <br>
        <label for="photo">Sélectionner une photo:</label>
        <input type="file" name="photo" id="photo">
        <br>
        <input type="submit" name="submit" value="Télécharger">
    </form>
</body>

</html>