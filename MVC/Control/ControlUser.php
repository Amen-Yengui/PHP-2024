<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <?php
	$login = $_POST['login'];
	$password = $_POST['mdp'];
	include("../Modele/User.php");

	$p = new User($login, $password);
	$s = User::connect($login, $password);
	if ($s == true) {
		echo 'Login: ' . $user->login . '<br>';
		//---------------------------
		//************************* Partie à ajouter *********
		/*	//Ecriture des cookies
	setcookie("log", $login, time() + 86400); // 86400 = 1 jour

	setcookie("pass", $mp, time() + 86400);*/

		//-------version2: sessions:----------
		session_start();

		$_SESSION["user"] = $login;
		//------------------------------------
		//echo "vous etes connecté";
		if ($login == "admin")
			header('Location:../Vue/view_article.php');
		else
			header('Location:../Vue/View_article_client.php');
	} else
		header('Location:../authentification.html');



	?>
</body>

</html>