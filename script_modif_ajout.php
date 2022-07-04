<?php
var_dump($_FILES);
var_dump($_POST);
// die;

// IMG
$upload = false;
$sizeMax =  1048576;
$fileName = basename($_FILES["imageUploadModif"]["name"]);
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
var_dump($fileType);
$fileSize = $_FILES["imageUploadModif"]["size"];
var_dump($fileSize);
$fileEmp = $_FILES["imageUploadModif"]["tmp_name"]; // Emplacement du fichier de maniere temporaire sur le serveur
var_dump($fileEmp);
$fileError = $_FILES["imageUploadModif"]["error"];
var_dump($fileError);
$path = $_SERVER['DOCUMENT_ROOT'] . "/img/";
if (isset($_FILES['imageUploadModif'])) {
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
    if (isset($_POST['titleModif']) && $_POST['titleModif'] != "") {
        $Titre = $_POST['titleModif'];
    }
    else {
        $Titre= Null;
    }

    // Récupération de l'URL (même traitement, avec une syntaxe abrégée)
    $Annee = (isset($_POST['yearModif']) && $_POST['yearModif'] != "") ? $_POST['yearModif'] : Null;
    $Label = (isset($_POST['labelModif']) && $_POST['labelModif'] != "") ? $_POST['labelModif'] : Null;
    $Artiste = (isset($_POST['artistSelect']) && $_POST['artistSelect'] != "") ? $_POST['artistSelect'] : Null;
    $Genre = (isset($_POST['genreModif']) && $_POST['genreModif'] != "") ? $_POST['genreModif'] : Null;
    $Prix = (isset($_POST['priceModif']) && $_POST['priceModif'] != "") ? $_POST['priceModif'] : Null;
    $Id =  (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;
var_dump($Id);
var_dump($Artiste);
    // En cas d'erreur, on renvoie vers le formulaire
    if ($Id == Null || $Titre == Null || $Genre == Null || $Annee == Null || $Label == Null || $Artiste == Null || $Prix == Null || $upload == false) {
var_dump($Id);
var_dump($Titre);
var_dump($Genre);
var_dump($Annee);
var_dump($Label);
var_dump($Artiste);
var_dump($Prix);
var_dump($upload);

        echo "coucou";
        exit;
    }

    try {

    require 'db.php';
    $db = ConnexionBase();
//         $requete = $db->prepare("UPDATE disc SET disc_title = '$Titre' , disc_year = '$Annee' , disc_picture = '$fileName' , disc_label = '$Label' , disc_genre = '$Genre' , disc_price = '$Prix' WHERE disc_id = '$id'" );
// $requete->execute();
// $requete->closeCursor();
        // Construction de la requête INSERT sans injection SQL :
        $requete = $db->prepare("UPDATE disc SET disc_title = :titre , disc_year = :annee , disc_picture = :filename , disc_label = :label , disc_genre = :genre , disc_price = :prix, artist_id = :artiste WHERE disc_id = '$Id'" );
        
        // Association des valeurs aux paramètres via bindValue() :
        $requete->bindValue(":titre", $Titre, PDO::PARAM_STR);
        $requete->bindValue(":genre", $Genre, PDO::PARAM_STR);
        $requete->bindValue(":annee", $Annee, PDO::PARAM_STR);
        $requete->bindValue(":prix", $Prix, PDO::PARAM_STR);
        $requete->bindValue(":label", $Label, PDO::PARAM_STR);
        $requete->bindValue(":artiste", $Artiste, PDO::PARAM_STR);
        $requete->bindValue(":filename", $fileName, PDO::PARAM_STR);
        $requete->execute();
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
