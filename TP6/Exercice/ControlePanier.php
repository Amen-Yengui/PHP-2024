<?php
include("panier.php");
include("connexion.php");
session_start();
//ajouter article
if (isset($_POST['submit'])) {

	$ref = $_POST['ref'];
	$qte = $_POST['qte'];


	$sql = $conn->query("SELECT * FROM article where ref='$ref'");
	$sql->setFetchMode(PDO::FETCH_OBJ);
	$l = $sql->fetch();
	if (!isset($_SESSION['panier'])) {
		$pan = new panier();
		$pan->addPanier($ref, $qte);
		$_SESSION['panier'] = $pan;
		echo $pan;
	} else {
		$pan = $_SESSION['panier'];
		$pan->addPanier($ref, $qte);
		$_SESSION['panier'] = $pan;
		echo $pan;
	}
}

// //consulter panier
// if (isset($_GET['consulte'])) {
// 	if (!isset($_SESSION['panier'])) {
// 		echo "Votre panier est vide";
// 	} else {
// 		$p = $_SESSION['panier'];
// 		echo $p;
// 	}
// 
?>

<br><br>
<form name="form1" action="ControlePanier.php" method="POST">
    <input type="submit" name="ajout" value="Ajouter un article">
    <input type="submit" name="commade" value="Valider commande">
    <input type="submit" name="annuler" value="Annuler commande">

</form>

<?php

if (isset($_POST['annuler'])) {
	unset($_SESSION['panier']);
	header('Location:View_article_client.php');
}

if (isset($_POST['ajout'])) {
	header('Location:View_article_client.php');
}

if (isset($_POST['commade'])) {
	if (!isset($_SESSION['panier'])) {
		echo '<script> alert("votre panier est vide") </script>';
	} else {
		$_SESSION['panier']->updateBD();
		echo '<script> alert("votre commande est bien confirmée") </script>';
		unset($_SESSION['panier']);
		header('Location:View_article_client.php');
	}
}