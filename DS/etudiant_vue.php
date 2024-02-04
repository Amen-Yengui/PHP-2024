<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <style>
        .tab,
        .tab th,
        .tab td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h2>Gestion des notes des étudiants </h2><br>
    <form action="etudiant_control.php" method="post">
        <label>Etudiant</label>
        <select name="etud">
            <?php
            include 'etudiant.php';
            Etudiant::getEtudiant();
            ?>

        </select><br><br>

        <label>Matière</label>
        <select name="matiere">
            <option>prog web1</option>
            <option>prog web2</option>
            <option>Statistiques</option>
        </select></p>
        <label>Note</label>
        <input type="text" name="note"></p>
        <input type="submit" value="Ajouter" name="ajouter">
        <input type="submit" value="Afficher les notes de l'étudiant" name="affich">
    </form>

</body>

</html>