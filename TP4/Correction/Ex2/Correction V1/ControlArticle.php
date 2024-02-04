<?php

include 'Article.php';
include 'connexion.php';

$ref = $libelle = "";
$four = "";
$prix = "";
$qtestk = "";


if (isset($_GET["ref"])) $ref = $_GET["ref"];
if (isset($_GET["libelle"])) $libelle = $_GET["libelle"];
if (isset($_GET["four"]))	$four = $_GET["four"];
if (isset($_GET["prix"]))	$prix = $_GET["prix"];
if (isset($_GET["qtestk"]))	$qtestk = $_GET["qtestk"];

// début q1 d.
//insertion de l'article dans la table "article"
if ($ref != null && $libelle != null && $prix != null && $qtestk != null) {
	$Ar = new Article($ref, $libelle, $prix, $qtestk, $four);
	if (isset($_GET["submit"])) {
		Article::ajouterArticle($Ar);
		header('Location:View_article.php');
	}
}
//supprimer un article de la table "article"
if (isset($_GET['delete']) and isset($_GET['ref'])) {
	Article::supprimerArticle($ref);
	echo '<script> alert("Suppression avec succés"); </script>';
	header('Location:View_article.php');
}
// modifier article dans la table "article"
if (isset($_GET['update'])) {
	Article::updateArticle($Ar);
	header('Location:View_article.php');
}
// fin q1 d.
?>
<!-- début q4 -->
<!-- <?php
		// if (isset($_GET['filter'])) {
		// 	// Initialisation de la requête SQL
		// 	$sql = "SELECT * FROM article WHERE 1 = 1";
		// 	// Récupération des critères de recherche
		// 	$ref = isset($_GET['ref1']) ? $_GET['ref1'] : '';
		// 	$libelle = isset($_GET['lib1']) ? $_GET['lib1'] : '';
		// 	$prix = isset($_GET['pr1']) ? $_GET['pr1'] : 0;
		// 	$c = isset($_GET['p1']) ? $_GET['p1'] : '';
		// 	// Construction dynamique de la requête SQL
		// 	$params = array();
		// 	if (!empty($ref)) {
		// 		$sql .= " AND ref LIKE :ref";
		// 		$params[':ref'] = '%' . $ref . '%';
		// 	}
		// 	if (!empty($libelle)) {
		// 		$sql .= " AND libelle LIKE :libelle";
		// 		$params[':libelle'] = '%' . $libelle . '%';
		// 	}
		// 	if ($c == 1) {
		// 		$sql .= " AND prix <= :prix";
		// 		$params[':prix'] = $prix;
		// 	}
		// 	if ($c == 2) {
		// 		$sql .= " AND prix = :prix";
		// 		$params[':prix'] = $prix;
		// 	}
		// 	if ($c == 3) {
		// 		$sql .= " AND prix >= :prix";
		// 		$params[':prix'] = $prix;
		// 	}

		// 	Article::filterArticle($sql, $params);
		// Préparation de la requête SQL
		// $stmt = $conn->prepare($sql);
		// $stmt->execute($params);
		// // Affichage des résultats
		// if ($stmt->rowCount() > 0) {
		// 	echo "<table class='stylTab'>";
		// 	echo "<tr><th>Référence </th> <th>Libellé</th><th>Prix</th><th>Qte en stock</th><th>Fournisseur</th><th> Action </th></tr>";
		// 	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// 		//Affichage des informations de chaque article
		// 		echo "<tr><td> " . $row['ref'] . "</td>";
		// 		echo "<td> " . $row['libelle'] . "</td>";
		// 		echo "<td> " . $row['prix'] . "</td>";
		// 		echo "<td> " . $row['qte'] . "</td>";
		// 		echo "<td> " . $row['id_fournisseur'] . "</td>";
		// 		//echo "<td><a href=" . Article::supprimerArticle($row['ref']) . ">supprimer </a></td></tr>";
		// 	}
		// 	echo "</table>";
		// } else {
		// 	echo "aucun article correspondant à votre echerche";
		//}
		//}
		?> -->
<!-- fin q4 -->

</form>