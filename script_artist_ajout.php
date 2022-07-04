<?php
var_dump($_FILES);
var_dump($_POST);
// die;

// IMG
$upload = false;
$sizeMax =  1048576;
$fileName = basename($_FILES["photo"]["name"]);
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
var_dump($fileType);
$fileSize = $_FILES["photo"]["size"];
var_dump($fileSize);
$fileEmp = $_FILES["photo"]["tmp_name"]; // Emplacement du fichier de maniere temporaire sur le serveur
var_dump($fileEmp);
$fileError = $_FILES["photo"]["error"];
var_dump($fileError);
$path = $_SERVER['DOCUMENT_ROOT'] . "/img/";
if (isset($_FILES['photo'])) {
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "PNG") {
        echo "Erreur de l'extension";
    } else if ($fileSize > $sizeMax) {
        echo "Fichier trop grand !";
    } else {
        //Si tout est validé , envoie vers le dossier
        move_uploaded_file($fileEmp, $path . $fileName);
        echo "Upload reussi";
        $upload = true;
    }
}

    // Récupération du Nom :
    if (isset($_POST['titre']) && $_POST['titre'] != "") {
        $Titre = $_POST['titre'];
    }
    else {
        $Titre= Null;
    }

    // Récupération de l'URL (même traitement, avec une syntaxe abrégée)
    $Annee = (isset($_POST['annee']) && $_POST['annee'] != "") ? $_POST['annee'] : Null;
    $Label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
    $Artiste = (isset($_POST['artiste']) && $_POST['artiste'] != "") ? $_POST['artiste'] : Null;
    $Genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
    $Prix = (isset($_POST['prix']) && $_POST['prix'] != "") ? $_POST['prix'] : Null;
    // $Id =  (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;
// var_dump($Id);
    // En cas d'erreur, on renvoie vers le formulaire
    if ($Titre == Null || $Genre == Null || $Annee == Null || $Label == Null || $Artiste == Null || $Prix == Null || $upload == false) {


        exit;
    }
    require 'db.php';
$db = ConnexionBase();
    try {
        // Construction de la requête INSERT sans injection SQL :
        $requete = $db->prepare("INSERT INTO disc (disc_title, disc_genre, disc_year, disc_price, disc_label, artist_id, disc_picture)
        VALUES ( :titre, :genre , :annee, :prix, :label, :artiste, :filename)");
    
        // Association des valeurs aux paramètres via bindValue() :
        $requete->bindValue(":titre", $Titre, PDO::PARAM_STR);
        $requete->bindValue(":genre", $Genre, PDO::PARAM_STR);
        $requete->bindValue(":annee", $Annee, PDO::PARAM_STR);
        $requete->bindValue(":prix", $Prix, PDO::PARAM_STR);
        $requete->bindValue(":label", $Label, PDO::PARAM_STR);
        $requete->bindValue(":artiste", $Artiste, PDO::PARAM_STR);
        $requete->bindValue(":filename", $fileName, PDO::PARAM_STR);
        $requete->execute();
    
        // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
        $requete->closeCursor();
    }
    
    // Gestion des erreurs
    catch (Exception $e) {
        var_dump($requete->queryString);
        var_dump($requete->errorInfo());
        echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
        die("Fin du script (script_modif_ajout.php)");
    }
    header("Location: discs.php?id=" . $Id);
    // Fermeture du script
    exit;
    
    

    // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
?>    
