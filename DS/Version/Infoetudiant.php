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
        <h2>Ajouter les informations d'un étudiant </h2><br>
        <form>
            <label>Matricule</label>
                        <p><input type="text" name="mat"></p>
            <label>Nom</label>
                        <p><input type="text" name="nom"></p>
            <label>Prénom</label>
                        <p><input type="text" name="prm"></p>
                <label>Matière</label>
                <p><select name="matiere">
                    
                </select></p>
                <label>Note</label>
                <p><input type="text" name="note"></p>
                <input type="submit" value="AJOUTER" name="ajouter">
        </form>
        
</body>
</html>