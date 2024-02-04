<!DOCTYPE HTML>
<html>

<head>
</head>

<body>
    <?php

    include 'Fournisseur.php';
    include 'Article.php';

    ?>


    <h3 align=center>
        <FONT size="10" align=center> <I><B>Saisir un article</B></I></FONT>
    </h3><br><br>
    <form name="f" action="ControlArticle.php" method="GET">
        <table>
            <tr>
                <td><label for="ref">Référence</label>:</td>
                <td> <input name="ref" type="text" required /></td>
            </tr>
            <tr>
                <td><label for="libelle">Libellé</label>:</td>
                <td> <input name="libelle" type="text" required /></td>
            </tr>

            <tr>
                <td><label for="prix">Prix</label>:</td>
                <td> <input name="prix" type="text" required /></td>
            </tr>
            <tr>
                <td><label for="QtStk">Qte en Stock</label>:</td>
                <td> <input name="qtestk" type="text" required /></td>
            </tr>

            <tr>
                <td>
                    <label for="four">Fournisseur</label>:
                </td>
                <td>

                    <select name="four[]" multiple>
                        <?php
                        echo $f0;
                        echo $f1;
                        echo $f2;
                        echo $f3;
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td> <label for="pv">Point de vente</label></td>
                <td>
                    <input type="checkbox" name="pv[]" value="Sfax">Sfax
                    <br>
                    <input type="checkbox" name="pv[]" value="Gabes">Gabes
                    <br>
                    <input type="checkbox" name="pv[]" value="Tunis">Tunis
                </td>
            </tr>
            <tr>
                <td> <input type="submit" name="submit" value="Submit"> </td>

            </tr>

        </table>
    </form>

</body>

</html>