<html>

<head>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <?php

    class User
    {
        // private $login;
        // private $password;
        private $data = array();

        function __construct($login, $password)
        {
            $this->data['login'] = $login;
            $this->data['password'] = $password;
        }

        public function __get($attr)
        {
            if (!isset($this->data[$attr])) return "erreur";
            else return ($this->data[$attr]);
        }
        public function __set($attr, $value)
        {
            $this->data[$attr] = $value;
        }


        public function __toString()
        {
            $s = "Utilisateur <span style='font-weight:bold;'>" . $this->data['login'] . "</span> est bien connecté";
            return $s;
        }

        public function connect()
        {
            include("../connexion.php");

            $sql = $conn->query("select * from users where login= '{$this->data['login']}' and password='{$this->data['password']}'");

            if ($sql->rowCount() > 0)
                return true;
            return false;
        }
    }

    ?>
</body>

</html>