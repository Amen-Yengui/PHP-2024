<?php

class Article
{
    private $ref;
    private $libelle;
    private $prix;
    private $qteEnStock;
    private $idfournisseur;

    function __construct($reference, $libelle, $prix, $qteEnStock, $idfournisseur)
    {
        $this->ref = $reference;
        $this->libelle = $libelle;
        $this->prix = $prix;
        $this->qteEnStock = $qteEnStock;
        $this->idfournisseur = $idfournisseur;
    }

    public function __get($attr)
    {
        if (!isset($this->$attr))
            return "erreur";
        else
            return ($this->$attr);
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    // public function __toString()
    // {
    //     $s = "<tr> <td> $this->ref</td><td> $this->libelle </td><td> $this->prix </td><td> $this->qteEnStock </td><td> $this->idfournisseur </td></tr>";
    //     return $s;
    // }

    public function __toString()
    {
        $s = "<tr> <td> $this->ref </td><td> $this->libelle </td><td> $this->prix </td><td> $this->qteEnStock </td><td><ul>";

        foreach ($this->$this->idfournisseur as $f)
            $s = $s . "<li> $f </li>";
        $s = $s . "</ul></td>";
        //foreach ($this->pv as $p)
        //   $s = $s . "<li> $p </li>";


        // $s = $s . "<td> $this->prix </td><td> $this->Qte </td></tr>";
        return $s;
    }
    // Question 1 a.
    public static function ajouterArticle($article)
    {
        include("connexion.php");
        $statement = $conn->prepare("INSERT INTO article(ref, libelle, prix, qte, id_fournisseur) VALUES( ?, ?, ?, ?, ?)") or die(print_r($stmt->errorInfo()));
        $statement->bindParam('1', $article->ref);
        $statement->bindParam('2', $article->libelle);
        $statement->bindParam('3', $article->prix);
        $statement->bindParam('4', $article->qteEnStock);
        $statement->bindParam('5', $article->idfournisseur);
        $statement->execute() or die(print_r($statement->errorInfo()));
    }

    public static function updateArticle($article)
    {
        include("connexion.php");
        $sql = "UPDATE article SET libelle = :libelle, prix = :prix, qte = :qte, id_fournisseur = :idfournisseur  
        WHERE ref = :ref";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':libelle', $_GET['libelle'], PDO::PARAM_STR);
        $stmt->bindParam(':prix', $_GET['prix'], PDO::PARAM_INT);
        $stmt->bindParam(':qte', $_GET['qtestk'], PDO::PARAM_STR);
        $stmt->bindParam(':idfournisseur', $_GET['four'], PDO::PARAM_STR);
        $stmt->bindParam(':ref', $_GET['ref'], PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function supprimerArticle($ref)
    {
        include("connexion.php");
        $sql = "DELETE FROM article WHERE ref = '$ref'";
        $statement = $conn->prepare($sql);
        $statement->execute();
    }
    // fin q1 a.

    // début q3
    public static function AfficherArticle()
    {
        include("connexion.php");
        $listArticles = [];
        //  $resultat = $conn->prepare("select * from article");
        $resultat = $conn->query("select * from article");
        foreach ($resultat as $ar) {
            $listArticles[] = new Article(
                $ar['ref'],
                $ar['libelle'],
                $ar['prix'],
                $ar['qte'],
                $ar['id_fournisseur']
            );
        }
        return $listArticles;
    }



    // fin q3
    public static function filterArticle($sql, $params)
    {
        include("connexion.php");
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        // Affichage des résultats
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td> " . $row['ref'] . "</td>";
                echo "<td> " . $row['libelle'] . "</td>";
                echo "<td> " . $row['prix'] . "</td>";
                echo "<td> " . $row['qte'] . "</td>";
                echo "<td> " . $row['id_fournisseur'] . "</td>";
            }
        }
    }
}