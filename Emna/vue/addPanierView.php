<?php
session_start();
include("../model/Article.php");
//affichage de la description de l'article:
$ref = $_GET['refajou'];
$art = Article::chercherArticle($ref);
echo "<table class='tab'> <tr>
<th>référence</th>
<th>Libellé</th>
<th>fournisseurs</th>
<th>Prix</th>
<th>Qte stock</th>
</tr>";
echo $art;
echo "</table>";

?>

<form action="../control/ControlePanier.php" method="post">
    <br><label for="ref">Référence de l'article : </label>
    <br><input type="text" name="ref" value="<?php echo $ref ?>">
    <br><label for="qte">Quantité à commander : </label>
    <br><input type="number" name="qt" min="0"><br>

    <br><input type="submit" value="Ajouter" name="ajouter">
</form>