<?php
include 'Article.php';
$listArt = Article::AfficherArticles();
echo "<h3> La liste de tous les articles</h3>";
echo "<table class='tab'>";
echo "<tr><th>Référence </th> <th>Libellé</th><th>Fournisseur</th><th>Prix</th><th>Qte en stock</th></tr>";
foreach ($listArt as $Art) {
    echo $Art;
}
echo "</table>";