<?php
//---------version2: sessions:--------------

session_start();

//--------------------------------
include("../model/User.php");
$login = addslashes($_POST["login"]);
$mp = addslashes($_POST["mdp"]);

$Usr = new User($login, $mp);
if ($Usr->connect()) {
	//---------version1: cookies:--------------
	//Ecriture des cookies
	// setcookie("log", $login, time() + 86400); // 86400 = 1 jour

	// setcookie("pass", $mp, time() + 86400);
	//--------------------------------
	//-------version2: sessions:----------

	$_SESSION["user"] = $login;
	//------------------------------------
	echo $Usr;
	header('Location:../vue/viewarticle.php');
} else
	header('Location:../vue/authentification.html');
