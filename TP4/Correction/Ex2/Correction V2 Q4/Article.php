<html>

<head>
    <style>
        .tab,
        .tab th,
        .tab td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <?php

    class Article
    {
        private $reference;
        private $libelle;
        private $fournisseurs;
        // private $pv;
        private $prix;
        private $Qte;

        function __construct($reference, $libelle, $fournisseurs, $prix, $Qte)
        {
            $this->reference = $reference;
            $this->libelle = $libelle;
            $this->fournisseurs = $fournisseurs;
            //  $this->pv = $pv;
            $this->prix = $prix;
            $this->Qte = $Qte;
        }

        public function __get($attr)
        {
            if (!isset($this->$attr)) return "erreur";
            else return ($this->$attr);
        }
        public function __set($attr, $value)
        {
            $this->$attr = $value;
        }

        public function __toString()
        {
            $s = "<tr> <td> $this->reference </td><td> $this->libelle </td><td><ul>";
            foreach ($this->fournisseurs as $f)
                $s = $s . "<li> $f </li>";
            $s = $s . "</ul></td>";
            $s = $s . "<td> $this->prix </td><td> $this->Qte </td></tr>";
            return $s;
        }

        // Méthode 1 ajouterArticle()
        public static function ajouterArticle($article)
        {
            include("connexion.php");
            $nb = $conn->exec("insert into article values('$article->reference','$article->libelle',$article->prix,$article->Qte)") or die(print_r($conn->errorInfo()));
            foreach ($article->fournisseurs as $f) {
                $conn->exec("insert into article_fournisseur values('$article->reference','$f')") or die(print_r($conn->errorInfo()));
            }
            return $nb;
        }
        // Méthode 2 ajouterArticle()
        /* public static function ajouterArticle($article)
        {
            include("connexion.php");
            $query = $conn->prepare("INSERT INTO article VALUES (:reference, :libelle, :prix, :quantite)");
            $query->bindParam(":reference", $article->reference);
            $query->bindParam(":libelle", $article->libelle);
            $query->bindParam(":prix", $article->prix);
            $query->bindParam(":quantite", $article->Qte);
            $nb = $query->execute() or die(print_r($conn->errorInfo()));
            foreach ($article->fournisseurs as $f) {
                $query2 = $conn->prepare("INSERT INTO article_fournisseur VALUES (:reference, :fournisseur)");
                $query2->bindParam(":reference", $article->reference);
                $query2->bindParam(":fournisseur", $f);
                $query2->execute() or die(print_r($conn->errorInfo()));
            }
            return $nb;
        }*/


        // Méthode 1 supprimerArticle()
        public static function supprimerArticle($ref)
        {
            include("connexion.php");
            $nb = $conn->exec("delete from article where ref='$ref'");
            if ($nb > 0) {
                $conn->exec("delete from article_fournisseur where ref='$ref'");
            }
            return $nb;
        }
        //Méthode 2 supprimerArticle()
        /*public static function supprimerArticle($ref)
        {
            include("connexion.php");
            $query = $conn->prepare("DELETE FROM article WHERE ref=:reference");
            $query->bindParam(":reference", $ref);
            $nb = $query->execute();
            if ($nb > 0) {
                $conn->exec("delete from article_fournisseur where ref='$art->reference'");
            }
            return $nb;
        }*/


        // Méthode 1 modifierArticle()
        public static function modifierArticle($art)
        {
            include("connexion.php");
            $nb = $conn->exec("update article SET ref = '$art->reference', libelle = '$art->libelle', prix = $art->prix, Qt_stock=$art->Qte WHERE ref = '$art->reference'") or die(print_r($conn->errorInfo()));
            if ($nb > 0) {
                $conn->exec("delete from article_fournisseur where ref='$art->reference'");
                foreach ($art->fournisseurs as $f) {
                    $conn->exec("insert into article_fournisseur values('$art->reference','$f')") or die(print_r($conn->errorInfo()));
                }
            }
            return $nb;
        }
        //Méthode 2 modifierarticle()
        /* public static function modifierArticle($art)
        {
            include("connexion.php");
            $query = $conn->prepare("UPDATE article SET ref = :reference, libelle = :libelle, prix = :prix, Qt_stock = :quantite WHERE ref = :reference");
            $query->bindParam(":reference", $art->reference);
            $query->bindParam(":libelle", $art->libelle);
            $query->bindParam(":prix", $art->prix);
            $query->bindParam(":quantite", $art->Qte);
            $nb = $query->execute() or die(print_r($conn->errorInfo()));
            if ($nb > 0) {
                $conn->exec("delete from article_fournisseur where ref='$art->reference'");
                foreach ($art->fournisseurs as $f) {
                    $query2 = $conn->prepare("INSERT INTO article_fournisseur VALUES (:reference, :fournisseur)");
                    $query2->bindParam(":reference", $art->reference);
                    $query2->bindParam(":fournisseur", $f);
                    $query2->execute() or die(print_r($conn->errorInfo()));
                }
            }
            return $nb;
        }*/


        // Méthode 1 AfficherArticles()
        /* public static function AfficherArticles()
        {
            include("connexion.php");
            $listArticles = [];
            $sql = $conn->query("select * from article");
            $resultat = $sql->fetchAll();
            foreach ($resultat as $ar) {
                $sqlF = $conn->query("select * from article_fournisseur where ref='{$ar['ref']}'");
                $resultatF = $sqlF->fetchAll();
                //récupérer le tableau des fournisseurs de l'article
                $listFour = [];
                foreach ($resultatF as $ligneF) {
                    $listFour[] = $ligneF['id'];
                }
                $listArticles[] = new Article(
                    $ar['ref'],
                    $ar['libelle'],
                    $listFour,
                    $ar['prix'],
                    $ar['Qt_stock']
                );
            }
            return $listArticles;
        }*/
        // Méthode 2 AfficherArticles()
        public static function AfficherArticles()
        {
            include("connexion.php");
            $listArticles = [];
            $sql = $conn->prepare("select * from article");
            $sql->execute();
            $resultat = $sql->fetchAll();
            foreach ($resultat as $ar) {
                $sqlF = $conn->prepare("select * from article_fournisseur where ref=:ref");
                $sqlF->bindParam(':ref', $ar['ref']);
                $sqlF->execute();
                $resultatF = $sqlF->fetchAll();
                $listFour = [];
                foreach ($resultatF as $ligneF) {
                    $listFour[] = $ligneF['id'];
                }
                $listArticles[] = new Article(
                    $ar['ref'],
                    $ar['libelle'],
                    $listFour,
                    $ar['prix'],
                    $ar['Qt_stock']

                );
            }
            return $listArticles;
        }


        public static function filterArticle($reference, $libelle, $prix_min, $prix_max)
        {
            include("connexion.php");
            // Construire la requête de recherche dynamique
            $sql = "SELECT * FROM article WHERE 1=1";
            if (!empty($reference)) {
                $sql .= " AND ref LIKE :reference";
            }
            if (!empty($libelle)) {
                $sql .= " AND libelle LIKE :libelle";
            }
            if (!empty($prix_min)) {
                $sql .= " AND prix >= :prix_min";
            }
            if (!empty($prix_max)) {
                $sql .= " AND prix <= :prix_max";
            }
            // Préparer la requête de recherche
            $stmt = $conn->prepare($sql);
            // Attribuer les valeurs aux paramètres de la requête
            if (!empty($reference)) {
                $stmt->bindValue(':reference', "%$reference%", PDO::PARAM_STR);
            }
            if (!empty($libelle)) {
                $stmt->bindValue(':libelle', "%$libelle%", PDO::PARAM_STR);
            }
            if (!empty($prix_min)) {
                $stmt->bindValue(':prix_min', $prix_min, PDO::PARAM_INT);
            }
            if (!empty($prix_max)) {
                $stmt->bindValue(':prix_max', $prix_max, PDO::PARAM_INT);
            }
            // Exécuter la requête de recherche
            $stmt->execute();
            // Vérifier si la requête a renvoyé des résultats
            $resultat = $stmt->fetchAll();
            foreach ($resultat as $ar) {
                $sqlF = $conn->prepare("select * from article_fournisseur where ref=:ref");
                $sqlF->bindParam(':ref', $ar['ref']);
                $sqlF->execute();
                $resultatF = $sqlF->fetchAll();
                $listFour = [];
                foreach ($resultatF as $ligneF) {
                    $listFour[] = $ligneF['id'];
                }
                $listArticles[] = new Article(
                    $ar['ref'],
                    $ar['libelle'],
                    $listFour,
                    $ar['prix'],
                    $ar['Qt_stock']

                );
            }
            return $listArticles;
        }
    }

    ?>
</body>

</html>