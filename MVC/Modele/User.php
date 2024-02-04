<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <?php
	class User
	{
		private $login;
		private $password;

		function __construct($login, $password)
		{
			$this->login = $login;
			$this->password = $password;
		}
		private $data = array();

		public function __get($attr)
		{
			if (!isset($this->$attr)) return "erreur";
			else return ($this->$attr);
		}

		public function __set($attr, $value)
		{
			$this->$attr = $value;
		}
		public function __isset($attr)
		{
			return isset($this->$attr);
		}

		public function __toString()
		{
			$s = "connection avec l'utilisateur $this->login est etablie avec succés";
			return $s;
		}
		public static function connect($login, $password)
		{
			include("../connexion.php");
			// Méthode 1 : mysqli
			// $sql = "SELECT * FROM users WHERE login = '$login' and password='$password'";
			// $statement = $conn->prepare($sql);
			// $resultat = $statement->execute();

			// Méthode 2 : PDO
			$sql = $conn->query("SELECT * FROM users WHERE login = '$login' and password='$password'");
			$sql->setFetchMode(PDO::FETCH_OBJ); // Récupérer sous forme d'objet
			$resultat = $sql->fetch();

			return $resultat;
		}
	}
	?>

</body>

</html>