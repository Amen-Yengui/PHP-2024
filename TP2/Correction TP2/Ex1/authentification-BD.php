<?php

$login=$_POST["login"];
$mdp=$_POST["mdp"];

include("connexion.php");

$sql = $conn->query("SELECT * FROM users WHERE login = '$login' and passwd='$mdp'");
/*$sql->setFetchMode(PDO::FETCH_OBJ);// R�cup�rer sous forme d�objet
$user=$sql->fetch();
if ($sql->rowCount()>0) //si l'utilisateur existe dans la base
{
    echo 'login: '.$user->login.'<br>';

            echo "Vous etes connect�s";
}*/

//ou:
$user=$sql->fetch(PDO::FETCH_NUM);
if ($sql->rowCount()>0) //si l'utilisateur existe dans la base
{
    echo 'login: '.$user[0].'<br>';
    
    echo "Vous etes connect�s";
}

            else  header('Location: authentification.html');
?>

