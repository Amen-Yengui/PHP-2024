<?php
include '../connexion.php';
include '../Modele/Article.php';
session_start();

if (!isset($_SESSION["user"])) {
    header('Location:../authentification.html');
} else {
    $login = $_SESSION["user"];
    echo "Utilisateur : $login <br>";
}
?>
<form action="../Vue/view_article_client.php" method="POST">
    <input type="submit" name="deconnect" value="Déconnecter">
</form>
<?php
// déconnecter
if (isset($_POST['deconnect'])) {
    session_destroy();
    header("location:../authentification.html");
}

// liste articles

if (isset($_POST['filter'])) {
    $reference = isset($_POST['ref1']) ? $_POST['ref1'] : '';
    $libelle = isset($_POST['lib1']) ? $_POST['lib1'] : '';
    $prix_min = isset($_POST['prix_min']) ? $_POST['prix_min'] : '';
    $prix_max = isset($_POST['prix_max']) ? $_POST['prix_max'] : '';
    $listArticles = Article::filterArticle($reference, $libelle, $prix_min, $prix_max);
    echo "<h3>La liste des articles filtrés</h3>";
    echo "<table class='tab'>";
    echo "<tr><th>référence</th><th>Libellé</th><th>fournisseurs</th><th>Prix</th><th>Qte stock</th><th>Image</th><th>Action</th></tr>";
    foreach ($listArticles as $Art) {
        echo "<tr><td>" . $Art->reference . "</td>";
        echo "<td>" . $Art->libelle . "</td>";
        echo "<td>" . implode("<br>", $Art->fournisseurs) . "</td>";
        echo "<td>" . $Art->prix . "</td>";
        echo "<td>" . $Art->Qte . "</td>";

        // photo
        $image_name = "photo_$Art->reference";
        $image_directory = "../photo/";
        $image_pattern = $image_directory . $image_name . '.*';

        // Rechercher tous les fichiers image qui correspondent au motif donné
        $image_files = glob($image_pattern);

        // Vérifier si un fichier image existe
        if (!empty($image_files)) {
            // Récupérer le nom du premier fichier image
            $first_image = $image_files[0];
            // Afficher l'image
            echo "<td><img src= $first_image width=150px></td>";
        }

        echo "<td><a href='../Vue/addPanierView.php?refcmd=" . $Art->reference . "'>Ajouter au panier</a></td>";

        echo "</td></tr>";
    }
    echo "</table>";
} else {



    $listArt = Article::AfficherArticles();
    echo "<h3> La liste de tous les articles</h3>";
    echo "<table class='tab'>";
    echo "<tr><th>Référence </th> <th>Libellé</th><th>Fournisseur</th><th>Prix</th><th>Qte en stock</th><th>Image</th><th>Action</th></tr>";
    foreach ($listArt as $Art) {
        echo "<tr><td>" . $Art->reference . "</td>";
        echo "<td>" . $Art->libelle . "</td>";
        echo "<td>" . implode("<br>", $Art->fournisseurs) . "</td>";
        echo "<td>" . $Art->prix . "</td>";
        echo "<td>" . $Art->Qte . "</td>";

        // photo
        $image_name = "photo_$Art->reference";
        $image_directory = "../photo/";
        $image_pattern = $image_directory . $image_name . '.*';

        // Rechercher tous les fichiers image qui correspondent au motif donné
        $image_files = glob($image_pattern);

        // Vérifier si un fichier image existe
        if (!empty($image_files)) {
            // Récupérer le nom du premier fichier image
            $first_image = $image_files[0];
            // Afficher l'image
            echo "<td><img src= $first_image width=150px></td>";
        }

        echo "<td><a href='../Vue/addPanierView.php?refcmd=" . $Art->reference . "'>Ajouter au panier</a></td>";
        echo "</td></tr>";
    }
    echo "</table>";
}
?>
<!-- formulaire question 4 -->
<h3> Filter par : </h3>
<form name="form2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
        <tr>
            <td>
                <label for="ref1">Référence</label>: <input name="ref1" type="text" />
            </td>
            <td><label for="lib1">Libellé</label>:
            <td> <input name="lib1" type="text" /> </td>
            <td><label for="prix_min">Prix minimal</label>:
                <input name="prix_min" type="number" />
            </td>
            <td><label for="prix_max">Prix maximal</label>:
                <input name="prix_max" type="number" />
            </td>
            <td>
                <input type="submit" name="filter" value="Filter">
                <input type="submit" name="afficher" value="Tous articles">
            </td>
        </tr>
    </table>
</form>