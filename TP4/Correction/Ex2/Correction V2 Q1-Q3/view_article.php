<html>

<head>
    <title>Article</title>
    <meta charset="utf-8" />

    <style>
        .msgRed {
            color: red;
        }
    </style>


</head>

<body>
    <h1>
        <center><B>Article</B></center>
    </h1><br><br>
    <form action="ControlArticle.php" method="POST">
        <table>
            <tr>
                <td><label for="ref">Référence</label>:</td>
                <td> <input name="ref" type="text" required /> </td>
            </tr>
            <tr>
                <td><label for="lib">Libellé</label>:</td>
                <td> <input name="lib" type="text" /> </td>
            </tr>
            <tr>
                <td><label for="pr">Prix</label>:</td>
                <td> <input name="pr" min="0" type="text" /></td>
            </tr>
            <tr>
                <td><label for="qt">Qte en Stock</label>:</td>
                <td> <input name="qt" min="0" type="text" /></td>
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
                    <input type="submit" name="delete" value="Supprimer article" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                </td>
            </tr>
        </table>
    </form>

    <?php
    include("Article.php");
    //affichage de tous les articles
    $listArt = Article::AfficherArticles();
    echo "<h3>La liste de tous les articles</h3>";
    echo "<table class='tab'>";
    echo "<tr><th>référence</th><th>Libellé</th><th>fournisseurs</th><th>Prix</th><th>Qte stock</th></tr>";
    foreach ($listArt as $Art) {
        echo $Art;
    }
    echo "</table>";
    ?>
</body>

</html>