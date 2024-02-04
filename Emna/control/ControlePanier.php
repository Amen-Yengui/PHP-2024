<?php
include("../model/Panier.php");
session_start();

$refArt = $_POST['ref'];
$q = $_POST['qt'];

if (isset($_SESSION['panier'])) {

    $p = $_SESSION['panier'];
    $p->addPanier($refArt, $q);
    $_SESSION['panier'] = $p;
    echo $p;
} else {
    $p = new Panier();
    $p->addPanier($refArt, $q);
    $_SESSION['panier'] = $p;
    echo $p;
}
