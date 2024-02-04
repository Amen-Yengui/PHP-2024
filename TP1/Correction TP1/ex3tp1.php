<html>

<head>
    <style>
    table {
        border-collapse: collapse;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }
    </style>
</head>

<body>

    <?php

    echo "<table>";
    echo "<tr><th>nom</th><th>moyenne</th></tr>";
    $tab = array("ali" => 2, "med" => 13, "gtfr" => 12);
    function couleur($m)
    {
        if ($m < 10)
            return 'red';
        else return 'green';
    }
    //affichage avec tableau HTML
    foreach ($tab as $nom => $moy) {
        $chaine = couleur($moy);
        echo "<tr>";
        echo "<td >$nom</td><td style='background-color: $chaine;'>$moy</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>