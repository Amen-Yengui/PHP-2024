<html>

<head></head>

<body>
    <?php
    include("etudiant.php");
    include("note.php");

    $etud = $matière = $note = "";

    if (isset($_POST["etud"])) $etud = $_POST["etud"];
    if (isset($_POST["matiere"])) $matiere = $_POST["matiere"];
    if (isset($_POST["note"]))    $note = $_POST["note"];

    // Ajout une note
    if (isset($_POST['ajouter'])) {
        if ($etud != null && $matiere != null && $note != null) {
            $nt = new note($note, $matiere, $etud);
            $nb = note::ajouter($nt);
            if ($nb > 0) {
                echo '<script>alert("note ajoutée")</script>';
            } else {
                echo '<script>alert("note non ajoutée")</script>';
            }
            header('Location:etudiant_vue.php');
        }
    }

    // afficher notes d'un étudiant

    if (isset($_POST['affich'])) {
        include "connexion.php";
        $listnote = Note::getNote($etud);
        echo "<h1> Informations de l'étudiant </h1>";
        echo "<h3>Matricule:  $etud  </h3>";
        $sql = $dbconn->query("select * from etudiant where matricule=$etud");
        $resultat = $sql->fetch();
        echo "<h3> Nom :" . $resultat['nom'] . " " . $resultat['prenom'];
        echo "<br><br>";
        echo "<table class='tab' border>";
        echo "<tr><th>Nom matière</th><th>Note</th>";
        foreach ($listnote as $nt) {
            echo "<tr><td>" . $nt->nomMatiere . "</td>";
            echo "<td>" . $nt->note . "</td></tr>";
        }
        echo "</table>";
    }

    ?>