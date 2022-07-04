<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-12">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>artist-details</title>
</head>
<?php
require 'db.php';
$db = ConnexionBase();
$id = $_GET['id'];
// Requete 1 
$requete1 = $db->prepare("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id=?");
$requete1->execute(array($id));
$artistID = $requete1->fetch(PDO::FETCH_OBJ);
$requete1->closeCursor();

//Requete 2 
$requete2 = $db->prepare("SELECT artist_id , artist_name FROM artist");
$requete2->execute(array($id));
$artistName = $requete2->fetchAll();
$requete2->closeCursor();



?>
<h1> Le formulaire de modification </h1><hr>
<h2> Modifier un vinyle </h2>

<form method="post" action="script_modif_ajout.php"  enctype="multipart/form-data">

    <div class="row">
        <div class="row col-12">
            <p id="inputTxt"> Title </p>
            <input class="form-control" name="titleModif" type="text" id="input" placeholder="Entrez un titre" value="<?php echo $artistID->disc_title ?>">
        </div>

        <div class="row col-12">
            <p id="inputTxt"> Artist </p>
            <select name="artistSelect" id="input2Modif" class="custom-select  custom-select-sm">
                <option selected>Choose artist</option>
                <?php foreach ($artistName as $a) {
                    echo '<option name="artistModif" value="' . $a["artist_id"] . '">' . $a["artist_name"] . '</option>';
                }; ?>
            </select>
        </div>
        <input id="prodId" name="id" type="hidden" value="<?php echo $artistID -> disc_id ?>">

        <div class="row col-12">
            <p id="inputTxt"> Year </p>

            <input class="form-control" name="yearModif" type="text" id="inputModif" placeholder="Entrez une année" value="<?php echo $artistID->disc_year ?>" >
        </div>


        <div class="row col-12">
            <p id="inputTxt"> Genre </p>
            <input class="form-control " name="genreModif" type="text" id="input2Modif" placeholder="Entrez un genre" value="<?php echo $artistID->disc_genre ?>" >
        </div>

        <div class="row col-12">
            <p id="inputTxt"> Label </p>
            <input class="form-control" type="text" name="labelModif" id="inputModif" placeholder="Entrez un label" value="<?php echo $artistID->disc_label ?>" >
        </div>

        <div class="row col-12">
            <p id="inputTxt"> Price </p>
            <input class="form-control " name="priceModif" type="text" id="input2Modif" placeholder="rentrez un prix" value="<?php echo $artistID->disc_price ?>" >
        </div>
    
    </div>
    </div>

    <p class="col-" id="inputTxtPicture">Picture</p>
    <div class="inputFile">
            <input type="file"  id="imgModif" name="imageUploadModif" id="buttonFile">

    <div class="row " id="pictureModif"><?= '<img src="img/' . $artistID->disc_picture . '" />'  ?></div>
    <div class="row" id="buttonModif">
    <button class="btn btn-primary" id="modifButton" type="submit">Modifier</button>
        <a class="btn btn-primary" id="retourButton" href="discs.php" role="button">Retour</a>
        <div>
</form>


</body>

</html>