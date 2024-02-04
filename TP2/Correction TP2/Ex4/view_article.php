<!DOCTYPE HTML>
<html lang="fr">

<head>
    <style>
    .messagErreur {
        color: red;
    }
    </style>
</head>

<body>
    <?php
    $ref = $libelle = $prix = $qtestock = "";
    $four = $PV = array();
    $erreurLibelle = "";
    $erreurReference = "";

    if (isset($_GET["ref"])) {
        if (empty($_GET["ref"])) {
            $erreurReference = " La référence est requise";
        } else
            $ref = $_GET["ref"];
    }

    if (isset($_GET["libelle"])) {
        if (empty($_GET["libelle"])) {
            $erreurLibelle = " Le champ Libellé est requis";
        } else
            $libelle = $_GET["libelle"];
    }

    if (isset($_GET["PV"])) {

        $PV = $_GET["PV"];
    }

    if (isset($_GET["four"])) {

        $four = $_GET["four"];
    }

    if (isset($_GET["prix"])) {

        $prix = $_GET["prix"];
    }

    if (isset($_GET["qtestock"])) {

        $qtestock = $_GET["qtestock"];
    }


    ?>

    <h3 align=center>
        <FONT size="10" align=center>
            <I><B>Saisir un article</B></I>
        </FONT>
    </h3><br><br>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <table>
            <tr>
                <td><label for="ref">référence</label>:</td>
                <td><input name="ref" type="text" /><span class='messagErreur'><?php echo $erreurReference; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="libelle">libell&eacute;</label>:
                </td>
                <td>
                    <input name="libelle" type="text" />
                    <span class='messagErreur'> <?php echo $erreurLibelle; ?></span>
                </td>
            </tr>

            <tr>
                <td><label for="four">Fournisseur</label>:</td>
                <td><select name="four[]" multiple>
                        <option selected="selected" value="fournisseur1">fournisseur1</option>
                        <option value="fournisseur2">fournisseur2</option>
                        <option value="fournisseur3">fournisseur3</option>
                        <option value="fournisseur4">fournisseur4</option>
                    </select> </td>
            </tr>

            <tr>
                <td>
                    <label for="PV">Point de vente:</label>
                </td>
                <td><input type="checkbox" name="PV[]" value="Sfax">Sfax
                    <br>
                    <input type="checkbox" name="PV[]" value="Gabes">Gabes
                </td>
            </tr>

            <tr>
                <td>
                    <label for="prix">Prix</label>:
                </td>
                <td>
                    <input name="prix" type="text" />
                </td>
            </tr>

            <tr>
                <td>
                    <label for="qtestock">Qt en stock</label>:
                </td>
                <td>
                    <input name="qtestock" type="text" />
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>

        </table>
    </form>

    <br><br>
    <B>Informations de l'article</B><br>
    R&eacute;f&eacute;rence: <?php echo $ref; ?><br>
    Libell&eacute;: <?php echo $libelle; ?><br>
    Fournisseurs:
    <ul>
        <?php
        foreach ($four as $f)
            echo "<li> $f </li>";
        ?>
    </ul>

    Points de vente:
    <ul>
        <?php
        foreach ($PV as $p)
            echo "<li> $p </li>";
        ?>
    </ul>

    Prix: <?php echo $prix; ?><br>
    Qte en stock: <?php echo $qtestock; ?><br>

</body>

</html>