<?php
require 'db.php';
$db = ConnexionBase();
    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];
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
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="detail_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="script_artist_ajout.php" method="post" enctype="multipart/form-data">
    <div class="container-fluid" id="fluid-ajout">
        <h1>Modifier un vinyle</h1>
        <br>
        <div class="form-group">
            <label for="titre">Titre </label>
            <input type="text" name="titre" id="titre" placeholder="Entrez le titre ">
        </div>
        <br>
        <div class="row col-12">
            <p id="inputTxt"> Artist </p>
            <select name="artistSelect" id="input2Modif" class="custom-select  custom-select-sm">
                <option selected>Choisir un artiste</option>
                <?php foreach ($artistName as $a) {
                    echo '<option name="artistModif" value="' . $a["artist_id"] . '">' . $a["artist_name"] . '</option>';
                }; ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="annee">Année </label>
            <input type="number" name="annee" id="annee" placeholder="Entrez l'année ">
        </div>
        <br>
        <div class="form-group">
            <label for="genre">Genre </label>
            <input type="text" name="genre" id="genre" placeholder="Entrez le genre (Rock,Pop,Rap...) ">
        </div>
        <br>
        <div class="form-group">
            <label for="label">Label </label>
            <input type="text" name="label" id="label" placeholder="Entrez le label(EMI,Warner,PolyGram,Univers sale...) ">
        </div>
        <br>
        <div class="form-group">
            <label for="prix">Prix </label>
            <input type="number" name="prix" id="prix" placeholder="Entrez le prix ">
        </div>
        <br>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" accept="image/png, image/jpeg">
        </div>
        <br>

        <div class="row " id="pictureModif"><?= '<img src="img/' . $artistID->disc_picture . '" />'  ?></div>       
     </div>
        <div class="container-fluid" id="fluid-disc">
        <!-- <a href="modif_form.php"><button>modifier</button></a> -->
            <a href="discs.php" class="btn btn-dark">Retour</a>
        </div>

    </div>
    </form>
</body>

</html>