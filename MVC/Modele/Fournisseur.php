<html>

<head>

</head>

<body>

    <?php

    class Fournisseur
    {
        private $id;
        private $nomF;

        function __construct($id, $nomF)
        {
            $this->id = $id;
            $this->nomF = $nomF;
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
            $s = "<option value=$this->id>$this->nomF</option>";
            return $s;
        }


        public static function getAllFournisseurs()
        {
            include("../connexion.php");
            $resultat = $conn->query("select * from fournisseur");
            $resultat->setFetchMode(PDO::FETCH_OBJ);
            $news = $resultat->fetchAll();
            foreach ($news as $ligne) {
                echo '<option value=' . $ligne->id . '>' . $ligne->nom . '</option>';
            }
        }
    }

    // $f1=new Fournisseur("four1","fournisseur1");
    // $f2=new Fournisseur("four2","fournisseur2");
    // $f3=new Fournisseur("four3","fournisseur3");

    /*echo "<select>";
echo $f1;
echo $f2;

echo "</select>";*/



    ?>
</body>

</html>