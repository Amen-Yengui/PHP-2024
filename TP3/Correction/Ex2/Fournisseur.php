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
}

$f0 = new Fournisseur(null, null);
$f1 = new Fournisseur(324, "ISG");
$f2 = new Fournisseur(325, "AMG");
$f3 = new Fournisseur(326, "FST");

/*
echo "L'identifiant est : " . $f1->id . "<br>";
$f1->nom = "SmartIT";
echo "Le nom est : " . $f1->nom . "<br>";
echo $f1;*/