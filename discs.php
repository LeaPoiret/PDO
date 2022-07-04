<?php
session_start();
if(!isset($_SESSION['membre_mail']) and !isset($_SESSION['membre_pass']))
{
    header("Location: connexion_form.php");
}

include 'db.php';
$db = ConnexionBase();
$requete = $db->prepare("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id");
$requete->execute();
$tableau = $requete->fetchAll(PDO::FETCH_OBJ);
$cd = 0;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="cucu">

    <div class="container-fluid" id="fluid-disc">
        <div class="row">
            <?php foreach ($tableau as $disc) : $cd++; ?> <?php endforeach; ?>
            <h1 class="title col-10">Liste des disques (<?php echo $cd ?>)</h1>

            <div class="btn-group">
                <div class="">
                <a href="deconnexion_script.php"class="btn btn-dark">Déconnexion</a>

                    </select><br>
                </div>
                <div class="">
                    <a href="ajout_form.php"><button class="btn btn-dark">Ajouter</button></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-6">
                <?php
                foreach ($tableau as $a) {
                ?>
                    <div class="row">
                        <div class="card border-0 align-left col-5" id="card" style="width: 30%;">
                            <div id="img" class="row col-">
                                <img class="col-6 max-width:20%" src="img/<?= $a->disc_picture; ?>" alt="<?= $a->disc_picture; ?>" title=" <?= $a->disc_picture; ?>">
                                <div class="card-body col-">
                                    <p class="card-title text-right col-"><small><b><?= $a->disc_title; ?></b></small>
                                    <p class="car-subtitle  text-right col-" id="artistName"><?= $a->artist_name; ?>
                                    <p class="card-text text-right col-"><b>Label :</b> <?= $a->disc_label; ?> </p>
                                    <?= '<p class="card-text text-right col-"><small><b>Année : </b>' . $a->disc_year . '</p></small>'; ?>
                                    <?= '<p class="card-text text-right col-"><small><b>Style : </b>' . $a->disc_genre . '</small></br>'; ?>
                                    <div class="bouton-detail">
                                        <a href="artist_detail.php?id=<?php echo $a->disc_id; ?>" id="Btn_details" class="btn btn-dark  col-">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>

    </div>
</body>

</html>