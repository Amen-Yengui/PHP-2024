<?php
include 'connexion.php';
include 'Article.php';
session_start();

if (!isset($_SESSION["user"])) {
    header('Location:authentification.html');
} else {
    $login = $_SESSION["user"];
    echo "Utilisateur : $login <br>";
}
?>
<form action="view_article_client.php" method="POST">
    <input type="submit" name="deconnect" value="Déconnecter">
</form>
<?php
// déconnecter
if (isset($_POST['deconnect'])) {
    session_destroy();
    header("location:authentification.html");
}

// liste articles
$listArt = Article::AfficherArticles();
echo "<h3> La liste de tous les articles</h3>";
echo "<table class='tab'>";
echo "<tr><th>Référence </th> <th>Libellé</th><th>Fournisseur</th><th>Prix</th><th>Qte en stock</th><th>Action</th></tr>";
foreach ($listArt as $Art) {
    echo "<tr><td>" . $Art->reference . "</td>";
    echo "<td>" . $Art->libelle . "</td>";
    echo "<td>" . implode("<br>", $Art->fournisseurs) . "</td>";
    echo "<td>" . $Art->prix . "</td>";
    echo "<td>" . $Art->Qte . "</td>";
    echo "<td><a href='addPanierView.php?refcmd=" . $Art->reference . "'>Ajouter au panier</a></td>";
    echo "</td></tr>";
}
echo "</table>";

?>