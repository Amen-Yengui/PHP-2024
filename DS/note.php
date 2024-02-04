<?php

class Note
{

    private $note;
    private $nomMatiere;
    private $matricule;

    public function __construct($note, $nomMatiere, $matricule)
    {
        $this->note = $note;
        $this->nomMatiere = $nomMatiere;
        $this->matricule = $matricule;
    }

    public function __get($attr)
    {
        if (!isset($this->$attr)) return "erreur";
        else return ($this->$attr);
    }
    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }


    public static function ajouter($note)
    {
        include "connexion.php";
        $stmt = $dbconn->prepare("INSERT INTO NOTE (Note, nomMatiere, Matricule) VALUES (:note, :nomMatiere, :matricule)");
        $stmt->bindParam(':note', $note->note);
        $stmt->bindParam(':nomMatiere', $note->nomMatiere);
        $stmt->bindParam(':matricule', $note->matricule);
        $nb = $stmt->execute()  or die(print_r($dbconn->errorInfo()));;
        return $nb;
    }

    // public static function supprimer($matricule)
    // {
    //     include "connexion.php";
    //     $stmt = $dbconn->prepare("DELETE FROM NOTE WHERE #Matricule = :matricule");
    //     $stmt->bindParam(':matricule', $matricule);
    //     $stmt->execute();
    // }

    public static function getNote($matricule)
    {
        include "connexion.php";
        $notes = [];
        $stmt = $dbconn->prepare("SELECT * FROM NOTE WHERE matricule = :matricule");
        $stmt->bindParam(':matricule', $matricule);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $notes = array();
        foreach ($result as $row) {
            $note = new Note($row['note'], $row['nomMatiere'], $row['matricule']);
            $notes[] = $note;
        }
        return $notes;
    }


    public function __toString()
    {
        return "<tr><td>" . $this->nomMatiere . "</td><td>" . $this->note . "</td></tr>";
    }
}
