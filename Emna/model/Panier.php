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


    class Panier
    {
        //tableau associatif contenant les articles	commandés
        private $ar_commandes;

        public function __construct()
        {
            $this->ar_commandes = array();
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

        public function addPanier($ref, $q)
        {
            //$a: la référence de l'article commandé
            $q_Deja_commandee = 0;
            if (array_key_exists($ref, $this->ar_commandes)) {
                $q_Deja_commandee = $this->ar_commandes[$ref];
            }
            $this->ar_commandes[$ref] = $q + $q_Deja_commandee;
        }


        public function getPrixTotal()
        {
            include("../connexion.php");
            $prixTot = 0;
            foreach ($this->ar_commandes as $a => $q) {

                $sql = $conn->query("select * FROM article where ref='$a'");
                $Ar = $sql->fetch();
                $p = $Ar['prix'];
                $prixTot += $p * $q;
            }
            return $prixTot;
        }

        public function __toString()
        {
            include("../connexion.php");

            $s = "Les articles du panier :<table class='tab'><tr><th>reference</th><th>libellé</th><th>prix</th><th>Quantité</th></tr>";
            foreach ($this->ar_commandes as $a => $q) {

                $sql = $conn->query("select * FROM article where ref='$a'");
                $Ar = $sql->fetch();
                $p = $Ar['prix'];
                $lib = $Ar['libelle'];


                $s = $s . "<tr><td>$a </td><td>$lib </td><td>$p</td><td> $q</td></tr>";
            }
            $s = $s . "</table>Le prix total de la commande =" . $this->getPrixTotal();
            return $s;
        }
    }
    ?>
</body>

</html>