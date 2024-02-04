<?php

$login=$_GET["login"];
$mdp=$_GET["mdp"];


if ($login=="admin" && $mdp=="admin")
{
    echo 'Bonjour '.$login.'<br>';
    
    echo "Vous etes connectés";
}

else  
	header('Location: authentification.html');
?>

