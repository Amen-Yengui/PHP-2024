<?php

class Article
{
    private $reference;
    private $libelle;
    private $prix;
    private $qteEnStock;
    private $pv;


    function __construct($reference, $libelle, $prix, $qteEnStock, $fournisseurs, $pv)
    {
        $this->reference = $reference;
        $this->libelle = $libelle;
        $this->prix = $prix;
        $this->qteEnStock = $qteEnStock;
        $this->fournisseurs = $fournisseurs;
        $this->pv = $pv;
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
        $s = "<tr> <td> $this->reference </td><td> $this->libelle </td><td><ul>";

        foreach ($this->fournisseurs as $f)
            $s = $s . "<li> $f </li>";
        $s = $s . "</ul></td><td> $this->prix </td><td> $this->qteEnStock </td><td><ul>";
        foreach ($this->pv as $p)
            $s = $s . "<li> $p </li>";
        $s = $s . "</ul></td></tr>";
        return $s;
    }
} // fin de la classe

/*
$a1=new Article(324,"Souris",100,10,"Four1");
$a2=new Article(325,"Tablette",250,70,"Four2");
$a3=new Article(326,"Ecran",470,80,"Four3");
*/
/*
echo "Le libelle est : ".$a1->libelle."<br>";
$a1->reference=5000;
echo "Le prix est : ".$a1->prix."<br>";
*/

/*
echo "<br>";
echo "<table border=1>";
echo "<tr><td>Reference</td><td>libelle</td><td>Prix</td>
<td>qteEnStock</td><td>fournisseur</td></tr>";

echo $a1; 
echo $a2; 
echo $a3; 
echo "</table>";
*/