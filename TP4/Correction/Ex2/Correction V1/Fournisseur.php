<?php

class Fournisseur
{
    private $id;
    private $nom;

    function __construct($id, $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    //private $data=array();

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

    public function __toString()
    {
        $s = "<option value=$this->id>$this->nom</option>";
        return $s;
    }

    public static function getAllFournisseurs()
    {
        include("connexion.php");
        $resultat = $conn->query("select * from fournisseur");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        $news = $resultat->fetchAll();
        foreach ($news as $ligne) {
            echo '<option value=' . $ligne->id . '>' . $ligne->nom . '</option>';
        }
    }
}