<?php
include '../Modele/Article.php';
class panier
{
	private $article;

	//construct
	public function __construct()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		if (!isset($_SESSION['panier'])) {
			$_SESSION['panier'] = array();
		}
	}
	//ajout panier
	public function addPanier($ref, $qte)
	{
		$this->article[$ref] = $qte;
	}
	//get
	public function __get($attr)
	{
		if (!isset($this->$attr)) return "erreur";
		else return ($this->$attr);
	}
	//set
	public function __set($attr, $value)
	{
		$this->$attr = $value;
	}
	//affichage
	public function __toString()
	{
		include("../connexion.php");
		$prix = 0;
		$s = "<h3>Contenu du panier : </h3> <table class='tab'><tr><th>Référence</th><th>Libellé</th><th>Prix</th><th>Quantité</th></tr>";
		foreach ($this->article as $ref => $qte) {
			$sql = $conn->query("SELECT * FROM article where ref='$ref'");
			if (!$sql) {
				echo "Lecture impossible, code";
			} else {
				$sql->setFetchMode(PDO::FETCH_OBJ);
				$l = $sql->fetch();
				$p = $l->prix;
				$lib = $l->libelle;
				$prix += $p * $qte;
			}
			$s = $s . "<tr><td>$ref </td><td>$lib </td><td>$p</td><td> $qte</td></tr>";
		}
		$s = $s . "</table> <br><br> prix total = $prix";
		return $s;
	}
	//isset
	public function __isset($name)
	{
		if (isset($this->$name))
			return true;
		return false;
	}
	//prix total
	public function getPrixTotal()
	{
		include("../connexion.php");
		$prix = 0;
		foreach ($this->article as $ref => $qte) {
			$sql = $conn->query("SELECT * FROM article where ref='$ref'");
			if (!$sql) {
				echo "Lecture impossible, code";
			} else {

				$sql->setFetchMode(PDO::FETCH_OBJ);
				$l = $sql->fetch();
				$p = $l->prix;
				$prix += $p * $qte;
			}
		}
		return $prix;
	}
	//mise à jour BD
	public function updateBD()
	{
		include("../connexion.php");
		foreach ($this->article as $ref => $qte) {
			$conn->exec("UPDATE article SET Qt_stock = Qt_stock - $qte WHERE ref='$ref'");
		}
	}
}
//test de la classe article
/*$p=new panier();
	$p->addPanier("RF15",12);
	$p->addPanier("RF02",12);
	echo $p;*/