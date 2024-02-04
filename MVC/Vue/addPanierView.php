<?php
include "../Modele/article.php";
if (isset($_GET['refcmd'])) {
    $ref = $_GET['refcmd'];
} else
    header('Location:../Vue/View_article_client.php');

include("../connexion.php");
$sql = $conn->query("SELECT * FROM article where ref='$ref'");
if (!$sql) {
    echo "Lecture impossible, code";
} else {
    $sql->setFetchMode(PDO::FETCH_OBJ);
    $l = $sql->fetch();
}
echo "<h3> Description de l'article commandé </h3>";
echo "<table class='tab'>";
echo "<tr><th>Référence </th> <th>Libellé</th><th>Prix</th><th>Qte en stock</th><th>Image</th></tr>";
echo  "<tr><td>$l->ref </td><td>$l->libelle </td><td>$l->prix</td><td> $l->Qt_stock</td>";
$photo = "photo_$l->ref";
echo "<td><img src=../Photo/$photo.jpg width=150px></td>";
echo "</tr>";
echo "</table>";


?>
<br><br>
<form action="../Control/ControlePanier.php" method="POST">
    <table>
        <tr>
            <td><label for="ref">Référence</label>:</td>
            <td> <input name="ref" type="text" value="<?= $ref ?>" /> </td>
        </tr>
        <tr>
            <td><label for="qte">Quantité à commander</label>:</td>
            <td> <input name="qte" type="number" min="1" max="<?= $l->Qt_stock ?>" /> </td>
        </tr>
        <tr>
            <td colspan="2"> <input type="submit" name="submit" value="Ajouter au panier">

        </tr>
    </table>
</form>