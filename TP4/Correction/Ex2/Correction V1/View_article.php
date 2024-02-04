<!DOCTYPE HTML>
<html>

<head>
    <style>
    table {
        border-collapse: collapse;
    }

    .stylTab {
        border: 1px solid black;
    }
    </style>
</head>

<body>
    <?php
    include 'Article.php';
    include 'connexion.php';
    ?>

    <h3 align=center>
        <FONT size="10" align=center> <I><B>Article</B></I></FONT>
    </h3><br><br>
    <form name="form1" action="ControlArticle.php" method="GET">
        <table>
            <tr>
                <td><label for="ref">Référence</label>:</td>
                <td> <input name="ref" type="text" required /> </td>
            </tr>
            <tr>
                <td><label for="libelle">Libellé</label>:</td>
                <td> <input name="libelle" type="text" /> </td>
            </tr>

            <tr>
                <td><label for=" prix">Prix</label>:</td>
                <td> <input name="prix" type="text" /></td>
            </tr>
            <tr>
                <td><label for=" qtestk">Qte en Stock</label>:</td>
                <td> <input name="qtestk" type="text" /></td>
            </tr>
            <tr>
                <td>
                    <label for=" four">Fournisseur</label>:
                </td>
                <td>
                    <select name="four[]" multiple>
                        <!--   q2 -->
                        <?php
                        include 'Fournisseur.php';
                        Fournisseur::getAllFournisseurs();
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
                <td colspan="2"> <input type="submit" name="submit" value="Ajouter article">
                    <!--   q1 c. -->
                    <input type="submit" name="update" value="Modifier article">
                    <!--   q1 b. -->
                    <input type="submit" name="delete" value="Supprimer article"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                </td>
            </tr>
        </table>

    </form>
    <!--  début q3 -->
    <?php
    if (isset($_GET['filter'])) {
        // Initialisation de la requête SQL
        $sql = "SELECT * FROM article WHERE 1 = 1";
        // Récupération des critères de recherche
        $ref1 = isset($_GET['ref1']) ? $_GET['ref1'] : '';
        $libelle1 = isset($_GET['lib1']) ? $_GET['lib1'] : '';
        $prix1 = isset($_GET['pr1']) ? $_GET['pr1'] : 0;
        $c = isset($_GET['p1']) ? $_GET['p1'] : '';
        // Construction dynamique de la requête SQL
        $params = array();
        if (!empty($ref1)) {
            $sql .= " AND ref LIKE :ref";
            $params[':ref'] = '%' . $ref1 . '%';
        }
        if (!empty($libelle1)) {
            $sql .= " AND libelle LIKE :libelle";
            $params[':libelle'] = '%' . $libelle1 . '%';
        }
        if ($c == 1) {
            $sql .= " AND prix <= :prix";
            $params[':prix'] = $prix1;
        }
        if ($c == 2) {
            $sql .= " AND prix = :prix";
            $params[':prix'] = $prix1;
        }
        if ($c == 3) {
            $sql .= " AND prix >= :prix";
            $params[':prix'] = $prix1;
        }
        echo "<h3> Articles filtrés</h3>";
        echo "<table class='stylTab' border>";
        echo "<tr><th>Référence </th> <th>Libellé</th><th>Prix</th><th>Qte en stock</th><th>Fournisseur</th><th> Action </th></tr>";
        Article::filterArticle($sql, $params);
        echo "</table>";
    } else {
        $listArt = Article::AfficherArticle();
        echo "<h3> La liste de tous les articles</h3>";
        echo "<table class='stylTab' border>";
        echo "<tr><th>Référence </th> <th>Libellé</th><th>Prix</th><th>Qte en stock</th><th>Fournisseur</th><th> Action </th></tr>";
        foreach ($listArt as $Art) {
            echo $Art;
        }
        echo "</table>";
    }
    ?>
    <!-- fin q3 -->
    <h3> Filter par : </h3>
    <form name="form2" action="view_article.php" method="GET">
        <table>
            <tr>
                <td>
                    <label for="ref1">Référence</label>: <input name="ref1" type="text" />
                </td>
                <td><label for="lib1">Libellé</label>:
                <td> <input name="lib1" type="text" /> </td>
                <td><label for="pr1">Prix</label>:
                    <select name="p1">
                        <option value="1"> Inférieur à</option>
                        <option value="2"> Egale à</option>
                        <option value="3"> Supérieur à</option>
                    </select>
                    <input name="pr1" type="text" />
                </td>
                <td>
                    <input type="submit" name="filter" value="Filter">
                    <input type="submit" name="afficher" value="Tous articles">
                </td>
            </tr>
        </table>

</body>

</html>