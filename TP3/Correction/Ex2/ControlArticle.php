<?php

include 'Article.php';

$ref = $libelle = $prix = $qtestk = "";
$four = $pv = array();

if (isset($_GET["ref"])) {
    $ref = $_GET["ref"];
}

if (isset($_GET["libelle"])) {
    $libelle = $_GET["libelle"];
}

if (isset($_GET["four"]))
    $four = $_GET["four"];

if (isset($_GET["prix"]))
    $prix = $_GET["prix"];

if (isset($_GET["qtestk"]))
    $qtestk = $_GET["qtestk"];

if (isset($_GET["pv"]))
    $pv = $_GET["pv"];

echo "<B>Informations de l'article</B><br>";

$a1 = new Article($ref, $libelle, $prix, $qtestk, $four, $pv);

echo "<br>";
echo "<table border=1>";
echo "<tr><td>Reference</td><td>Libelle</td><td>Fournisseurs</td>
<td>Prix en DT</td><td>Qte en Stock</td> <td> Points de vente </td></tr>";

echo $a1;

echo "</table>";