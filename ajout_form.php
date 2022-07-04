<?php
require 'db.php';
$db = ConnexionBase();
$requete = $db->prepare("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id");

$requete -> execute();
$tableau = $requete->fetchAll(PDO::FETCH_OBJ);
$requete2 = $db -> query("SELECT artist_name , artist_id FROM artist");
    $name = $requete2 ->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail_style.css">
    <title>Document</title>
</head>

<body>
    <form action="script_artist_ajout.php" method="post" enctype="multipart/form-data">
    <div class="container-fluid" id="fluid-ajout">
        <h1>Ajouter un vinyle</h1>
        <br>
        <div class="form-group">
            <label for="titre">Titre </label>
            <input type="text" name="titre" id="titre" placeholder="Entrez le titre ">
        </div>
        <br>
        <div class="artist">
            <label for="artiste">Ariste </label>
            <select id="artiste" name="artiste">
                <?php foreach ($name as $a ){
                    echo '<option name="artist" value="'.$a["artist_id"].'">'.$a["artist_name"].'</option>';
                };?>
            </select><br>
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
        <div class="bouton">
            <button type="submit" class="btn btn-dark">Ajouter</button>
            <a href="discs.php" class="btn btn-dark">Retour</a>
        </div>
    </div>
    </form>
</body>

</html>