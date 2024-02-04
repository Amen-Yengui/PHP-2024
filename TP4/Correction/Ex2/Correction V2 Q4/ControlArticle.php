<html>

<head></head>

<body>
    <?php
    include("Article.php");
    include("Fournisseur.php");

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
            header('Location:view_article.php');
        }
    }


    // Suppression d'un article
    if (isset($_POST['delete'])) {
        $ref = $_POST['ref'];

        if ($ref != null) {
            $nb = Article::supprimerArticle($ref);
            if ($nb > 0) {
                echo '<script>alert("Article supprimé")</script>';
                header('Location:view_article.php');
            }
        }
    }

    // Modification d'un article
    if (isset($_POST['update'])) {
        $Ar = new Article($ref, $libelle, $four, $prix, $qtestk);
        $nb = Article::modifierArticle($Ar);
        if ($nb > 0) {
            echo '<script>alert("Article' . $ref . ' modifié")</script>';
            header('Location:view_article.php');
        }
    } else {
        echo '<script>alert("il faut remplir tous les champs")</script>';
        header('Location:view_article.php');
    }

    ?>
</body>

</html>