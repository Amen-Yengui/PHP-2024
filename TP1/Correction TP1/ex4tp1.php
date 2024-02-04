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
    require 'util.php'; //require

    echo "<table>";
    echo "<tr><th>nom</th><th>moyenne</th></tr>";

    //affichage avec tableau HTML
    foreach ($tab as $nom => $moy) {
        $chaine = couleur($moy);
        echo "<tr>";
        echo "<td>$nom</td><td style='background-color: $chaine;'>$moy</td>";
        echo "</tr>";
    }
    echo "</table>";

    function couleur($m)
    {
        if ($m < 10)
            return 'red';
        else
            return '#4CAF50';
    }



    ?>


</body>

</html>