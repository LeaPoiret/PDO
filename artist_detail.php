<?php
    // On se connecte à la BDD via notre fichier db.php :
    require "db.php";
    $db = connexionBase();

    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];
    $requete1 = $db->prepare("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id=?");
    $requete1->execute(array($id));
    $artistID = $requete1->fetch(PDO::FETCH_OBJ);
    $requete1->closeCursor();
    // $requete2 = $db->prepare("SELECT artist_name FROM artist WHERE artist_id = '$artistID->artist_id'");
    // $requete2->execute();
    // $artistName = $requete2->fetch(PDO::FETCH_OBJ);
    // $requete2->closeCursor();
    //var_dump($artistID->artist_id == null);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="detail_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO - Détail</title>
</head>

<body class="cucudetail">
    <div class="hall">
        <div class="titre">
            <h1>Details</h1>
        </div>
        <br>
        <div class="container-fluid" id="fluid-detail">
            <div class="gauche">

                <div class="title">
                    <label for="title ">Title</label>
                    <input type="text" name="title" class="title" id="title" aria-describedby="emailHelp"
                        placeholder="<?=$artistID-> disc_title;?>">
                </div>
                <br>
                <div class="year">
                    <label for="year">Year</label>
                    <input type="text" class="year" name="year" id="year" aria-describedby="emailHelp"
                        placeholder="<?=$artistID-> disc_year;?>">
                </div>
                <br>
                <div class="label">
                    <label for="label ">Label</label>
                    <input type="text" name="label" class="label" id="label" aria-describedby="emailHelp"
                        placeholder="<?=$artistID-> disc_label;?>">
                </div>

            </div>
            <br>

            <div class="droite">
                <div class="artiste">
                    <label for="artiste">Artiste</label>
                    <input type="text" name="artiste" class="artiste" id="artiste"
                        placeholder="<?=$artistID-> artist_name;?>">
                </div>
                <br>
                <div class="genre">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" class="genre" id="genre"
                        placeholder="<?=$artistID-> disc_genre;?>">
                </div>
                <br>
                <div class="price">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="price" id="price"
                        placeholder="<?=$artistID-> disc_price;?>">
                </div>
            </div>
        </div>

        <div class="picture">
            <div class="titre2">
                <label for="picture">Picture</label>
            </div>
            <br>
            <img src="img/<?= $artistID-> disc_picture; ?>" alt="<?= $artistID-> disc_picture;?>"
                title=" <?= $artistID->disc_title; ?>">
        </div>
        <br>

        <a href="modif_form.php?id=<?=$artistID->disc_id; ?>" id="Btn_details"><button class="btn btn-warning">modifier</button></a>
        <a id="suppression" type="submit" href="#"><button class="btn btn-warning">Supprimer</button></a>
        <a href="discs.php"  class="btn btn-warning"><button class="btn btn-warning">Retour</button></a>
        
    </div>

    <script>
var boutonsupp = document.getElementById("suppression");
boutonsupp.addEventListener("click", btnsuppression);

function btnsuppression(event) {
    if (confirm("Voulez vous supprimer ce titre ?")) {
        window.location.href = "script_artist_delete.php?id= <?php echo $artistID->disc_id;?>";
    } else {
        window.location.href = "discs.php";
    }
}
</script>
</body>

</html>