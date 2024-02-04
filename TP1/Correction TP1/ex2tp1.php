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

    $tab = array("ali" => 12, "med" => 13, "Samir" => 12);
    echo "<table>";
    echo "<tr><th>nom</th><th>moyenne</th></tr>";
    //affichage avec tableau HTML
    foreach ($tab as $cle => $val) {
        echo "<tr>";
        echo "<td>$cle</td><td>$val</td>";
        //echo $val;
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>