<?php
include("Article.php");
include("Fournisseur.php");

// Ajout d'un article
if (isset($_POST['ajouter'])) {
    if (isset($_POST['frs']) && isset($_POST['pv']) && !empty($_POST['ref']) && !empty($_POST['lib']) && !empty($_POST['pr']) && !empty($_POST['qt'])) {
        $ref = $_POST['ref'];
        $lib = $_POST['lib'];
        $frs = $_POST['frs'];
        $pv = $_POST['pv'];
        $pr = $_POST['pr'];
        $qt = $_POST['qt'];

        $Ar = new Article($ref, $lib, $frs, $pr, $qt);
        $nb = Article::ajouterArticle($Ar);
        if ($nb > 0) {
            echo '<script>alert("Article ajouté")</script>';

            echo "<h2> Informations de l'article</h2><br><br>";
            echo "<table class='tab'>";
            echo "<tr> <th> Reference </th><th> Libelle </th><th> Fournisseur </th><th> Prix </th><th> Qte </th></tr>";

            echo $Ar;
            echo "</table>";
        } else {
            echo "échec de l'insertion de l'article";
        }
    } else
        header('Location:viewarticle.php');
}

// Suppression d'un article
if (isset($_POST['supprimer']) || isset($_GET['refsupp'])) {
    if (isset(($_POST['supprimer'])))
        $ref = $_POST['ref'];
    else
        $ref = $_GET['refsupp'];

    if ($ref != null) {
        $nb = Article::supprimerArticle($ref);
        if ($nb > 0) {
            echo '<script>alert("Article supprimé")</script>';
        }
    }
    //retourner à la page "view_article.php" après suppression
    echo '<script> document.location.href="viewarticle.php"</script>';
}

// Modification d'un article
if (isset($_POST['modifier'])) {
    if (isset($_POST['frs']) && isset($_POST['pv']) && !empty($_POST['ref']) && !empty($_POST['lib']) && !empty($_POST['pr']) && !empty($_POST['qt'])) {
        $ref = $_POST['ref'];
        $lib = $_POST['lib'];
        $frs = $_POST['frs'];
        $pv = $_POST['pv'];
        $pr = $_POST['pr'];
        $qt = $_POST['qt'];

        $Ar = new Article($ref, $lib, $frs, $pv, $pr, $qt);
        $nb = Article::modifierArticle($Ar);
        if ($nb > 0) {
            echo '<script>alert("Article' . $ref . ' modifié")</script>';

            echo "<h2> Informations de l'article</h2><br><br>";
            echo "<table class='tab'>";
            echo "<tr> <th> Reference </th><th> Libelle </th><th> Fournisseur </th><th> Points de vente </th><th> Prix </th><th> Qte </th></tr>";

            echo $Ar;
            echo "</table>";
        } else {
            header('Location:viewarticle.php');
        }
    } else {
        echo '<script>alert("il faut remplir tous les champs")</script>';
        echo '<script> document.location.href="viewarticle.php"</script>';
    }
}
