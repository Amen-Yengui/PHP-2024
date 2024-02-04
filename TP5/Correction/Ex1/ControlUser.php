<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <?php
	$login = $_POST['login'];
	$password = $_POST['mdp'];
	include("User.php");

	$p = new User($login, $password);
	$s = User::connect($login, $password);
	if ($s == true) {
		echo 'Login: ' . $user->login . '<br>';
		//---------------------------
		//************************* Partie à ajouter *********
		//Ecriture des cookies
		setcookie("log", $login, time() + 86400); // 86400 = 1 jour

		setcookie("pass", $password, time() + 86400);

		header('Location:view_article.php');
	} else
		header('Location:authentification.html');



	?>
</body>

</html>