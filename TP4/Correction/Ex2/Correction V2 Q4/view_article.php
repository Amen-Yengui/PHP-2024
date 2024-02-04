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
                    <input type="submit" name="delete" value="Supprimer article"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                </td>
            </tr>
        </table>
    </form>



    <?php
    include("Article.php");
    include("connexion.php");
    // début question 4
    // if (isset($_POST['afficher'])) {
    //     header('Location:view_article.php');
    // }
    if (isset($_POST['filter'])) {
        $reference = isset($_POST['ref1']) ? $_POST['ref1'] : '';
        $libelle = isset($_POST['lib1']) ? $_POST['lib1'] : '';
        $prix_min = isset($_POST['prix_min']) ? $_POST['prix_min'] : '';
        $prix_max = isset($_POST['prix_max']) ? $_POST['prix_max'] : '';
        $listArt = Article::filterArticle($reference, $libelle, $prix_min, $prix_max);
        echo "<h3>La liste des articles filtrés</h3>";
        echo "<table class='tab'>";
        echo "<tr><th>référence</th><th>Libellé</th><th>fournisseurs</th><th>Prix</th><th>Qte stock</th><th>Action</th></tr>";
        foreach ($listArt as $Art) {
            echo $Art;
        }
        echo "</table>";
    } else {
        // début question 3
        $listArt = Article::AfficherArticles();
        echo "<h3>La liste de tous les articles</h3>";
        echo "<table class='tab'>";
        echo "<tr><th>référence</th><th>Libellé</th><th>fournisseurs</th><th>Prix</th><th>Qte stock</th><th>Action</th></tr>";
        foreach ($listArt as $Art) {
            echo $Art;
        }
        echo "</table>";
    }
    ?>
    <!-- formulaire question 4 -->
    <h3> Filter par : </h3>
    <form name="form2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <tr>
                <td>
                    <label for="ref1">Référence</label>: <input name="ref1" type="text" />
                </td>
                <td><label for="lib1">Libellé</label>:
                <td> <input name="lib1" type="text" /> </td>
                <td><label for="prix_min">Prix minimal</label>:
                    <input name="prix_min" type="number" />
                </td>
                <td><label for="prix_max">Prix maximal</label>:
                    <input name="prix_max" type="number" />
                </td>
                <td>
                    <input type="submit" name="filter" value="Filter">
                    <input type="submit" name="afficher" value="Tous articles">
                </td>
            </tr>
        </table>
    </form>

</body>

</html>