<?php

class Etudiant
{
    private $matricule;
    private $nom;
    private $prenom;

    public function __construct($matricule, $nom, $prenom)
    {
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
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

    public static function getEtudiant()
    {
        include("connexion.php");
        $resultat = $dbconn->query("SELECT * from etudiant");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        $news = $resultat->fetchAll();
        foreach ($news as $ligne) {
            echo '<option value=' . $ligne->matricule . '>' . $ligne->nom . " " . $ligne->prenom . '</option>';
        }
    }



    public function __toString()
    {
        return "<option value=\"$this->matricule\">$this->nom $this->prenom</option>";
    }
}
