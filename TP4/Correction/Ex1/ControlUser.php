<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<?php
			$login=$_GET['login'];
			$password=$_GET['password'];
	 		include("User.php");

			$p= new User($login,$password);
			$s=User::connect($login,$password);
			if($s == false)
				echo "login ou password incorrect";
			else echo $p;
	

		?>
</body>
</html>