<?php

$login=$_POST["login"];
$mdp=$_POST["mdp"];


if ($login=="admin" && $mdp=="admin")
{
    echo 'Bonjour '.$login.'<br>';
    
    echo "Vous etes connectés";
}

            else  header('Location: authentification2.html');
?>

