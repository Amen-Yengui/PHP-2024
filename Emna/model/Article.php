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
            //foreach ($this->pv as $p)
            //   $s = $s . "<li> $p </li>";


            $s = $s . "<td> $this->prix </td><td> $this->Qte </td></tr>";
            return $s;
        }

        public static function ajouterArticle($article)
        {
            include("../connexion.php");

            $nb = $conn->exec("insert into article values('$article->reference','$article->libelle',$article->prix,$article->Qte)") or die(print_r($conn->errorInfo()));

            foreach ($article->fournisseurs as $f) {

                $conn->exec("insert into article_fournisseur values('$article->reference','$f')") or die(print_r($conn->errorInfo()));
            }
            return $nb;
        }

        public static function supprimerArticle($ref)
        {
            include("../connexion.php");
            $nb = $conn->exec("delete from article where ref='$ref'");
            return $nb;
        }
        public static function modifierArticle($art)
        {
            include("../connexion.php");
            $nb = $conn->exec("update article SET ref = '$art->reference', libelle = '$art->libelle', prix = $art->prix, Qt_stock=$art->Qte WHERE ref = '$art->reference'") or die(print_r($conn->errorInfo()));

            if ($nb > 0) {
                $conn->exec("delete from article_fournisseur where ref='$art->reference'");
                foreach ($art->fournisseurs as $f) {

                    $conn->exec("insert into article_fournisseur values('$art->reference','$f')") or die(print_r($conn->errorInfo()));
                }
            }
            return $nb;
        }

        public static function AfficherArticles()
        {

            include("../connexion.php");
            $listArticles = [];
            $reqprep1 = $conn->prepare("select * from article");
            $reqprep1->execute();


            $resultat = $reqprep1->fetchAll();

            foreach ($resultat as $ar) {

                $reqprep2 = $conn->prepare("select * from article_fournisseur where ref=:ref");
                $reqprep2->bindParam(':ref', $ar[0]);
                $reqprep2->execute();
                $resultatF = $reqprep2->fetchAll();

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
        }

        public static function chercherArticles($refLib, $pmin, $pmax)
        {

            include("../connexion.php");
            $listArticles = [];
            // requete
            $req = "SELECT * FROM article WHERE 1=1";
            if ($refLib != '') {
                $req .= " AND ref LIKE '%$refLib%' OR libelle LIKE '%$refLib%'";
            }

            if ($pmin != '') {
                $req .= " AND prix >= $pmin";
            }
            if ($pmax != '') {
                $req .= " AND prix <= $pmax";
            }
            $sql = $conn->query($req);
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
        }
        // Fonction qui récupère un article par sa référence:
        public static function chercherArticle($ref)
        {

            include("../connexion.php");

            $sql = $conn->query("select * FROM article where ref='$ref'");
            $Ar = $sql->fetch();

            $sqlF = $conn->query("select * from article_fournisseur where ref='{$Ar['ref']}'");
            $resultatF = $sqlF->fetchAll();
            //récupérer le tableau des fournisseurs de l'article
            $listFour = [];
            foreach ($resultatF as $ligneF) {
                $listFour[] = $ligneF['id'];
            }

            $art = new Article(
                $Ar['ref'],
                $Ar['libelle'],
                $listFour,
                $Ar['prix'],
                $Ar['Qt_stock']
            );

            return $art;
        }
    }

    ?>
</body>

</html>