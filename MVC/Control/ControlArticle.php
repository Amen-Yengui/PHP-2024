<html>

<head></head>

<body>
    <?php
    include("../Modele/Article.php");
    include("../Modele/Fournisseur.php");

    $ref = $libelle = "";
    $four = array();
    $prix = "";
    $qtestk = "";

    if (isset($_POST["ref"])) $ref = $_POST["ref"];
    if (isset($_POST["lib"])) $libelle = $_POST["lib"];
    if (isset($_POST["four"]))    $four = $_POST["four"];
    if (isset($_POST["pr"]))    $prix = $_POST["pr"];
    if (isset($_POST["qt"]))    $qtestk = $_POST["qt"];

    // Ajout d'un article
    if (isset($_POST['submit'])) {
        if ($ref != null && $libelle != null && $prix != null && $qtestk != null) {
            $Ar = new Article($ref, $libelle, $four, $prix, $qtestk);
            $nb = Article::ajouterArticle($Ar);
            if ($nb > 0) {
                echo '<script>alert("Article ajouté")</script>';
            } else {
                echo '<script>alert("Article non ajouté")</script>';
            }
            header('Location:../Vue/view_article.php');
        }
    }


    // // Suppression d'un article
    if (isset($_POST['delete']) || isset($_GET['refsupp'])) {
        if (isset($_GET['refsupp']))
            $ref = $_GET['refsupp'];
        else
            $ref = $_POST['ref'];

        if ($ref != null) {
            $nb = Article::supprimerArticle($ref);

            if ($nb > 0) {
                echo '<script>alert("Article supprimé")</script>';
                $image_name = "photo_$ref";

                $image_directory = "../photo/";

                $image_pattern = $image_directory . $image_name . '.*';

                $files = glob($image_pattern);

                if ($files) {
                    foreach ($files as $file) {
                        unlink($file);
                    }
                }
            }
        }
        //retourner à la page "view_article.php" après suppression
        echo '<script> document.location.href="../Vue/viewarticle.php"</script>';
    }

    // Modification d'un article
    if (isset($_POST['update'])) {
        $Ar = new Article($ref, $libelle, $four, $prix, $qtestk);
        $nb = Article::modifierArticle($Ar);
        if ($nb > 0) {
            echo '<script>alert("Article' . $ref . ' modifié")</script>';
            header('Location:../Vue/view_article.php');
        }
    } else {
        echo '<script>alert("il faut remplir tous les champs")</script>';
        header('Location:../Vue/view_article.php');
    }

    ?>
</body>

</html>