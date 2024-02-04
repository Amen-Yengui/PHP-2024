<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		class User{
			private $login;
			private $password;

			function __construct($login,$password){
				$this->login = $login;
				$this->password = $password;

			}	
			private $data =array();

			public function __get($attr) {
				if (!isset($this->$attr)) return "erreur";
				else return ($this->$attr);
			}
			
			public function __set($attr,$value) {
				$this->$attr = $value;
			 }
			public function __isset($attr) {
				return isset($this->$attr ); 
			}
	
			public function __toString() {
				$s="connection avec l'utilisateur $this->login est etablie avec succés";
				return $s;
			}
			public static function connect($login,$password){
				if($login != "admin" || $password != "admin")
				
					return false;
				return true;


			}
		} 



	?>

</body>
</html>