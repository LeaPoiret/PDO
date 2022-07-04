<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="detail_style.css">
</head>

<body>
    <?php
    if (isset($_GET['login_err'])) {
        $err = htmlspecialchars($_GET['login_err']);

        switch ($err) {
            case 'mdpfail':
    ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Vos mots de passes ne correspondent pas.
                </div>
            <?php
                break;

            case 'mailutilise':
            ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Adresse mail déjà utilisée.
                </div>
            <?php
                break;

            case 'mailfail':
            ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Votre adresse mail n'est pas valide.
                </div>
            <?php
                break;

            case 'mailfail2':
            ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Vos adresses ne correspondent pas.
                </div>
            <?php
                break;

            case 'pseudofail':
            ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Votre pseudo ne doit pas dépasser 255 caractères.
                </div>
            <?php
                break;

            case 'champsvides':
            ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Tous les champs doivent être complétés.
                </div>
    <?php
                break;
        }
    }
    ?>
    <div class="boxcomplete2">
        <div class="box2">
            <div class="boxform">
                <h2>Inscription</h2>
                <br /><br />
                <form  class="inscriptionbox" method="POST" action="script_inscription.php">

                                <label for="pseudo"></label>

                                <input type="text" placeholder="Entrez un pseudo" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) {
                                                                                                                        echo $pseudo;
                                                                                                                    } ?>" />

                                <label for="mail"></label>

                                <input type="text" placeholder="Entrez votre mail" id="mail" name="mail" value="<?php if (isset($mail)) {
                                                                                                                    echo $mail;
                                                                                                                } ?>" />
 
                                <label for="mail2"></label>
               
                                <input type="email" placeholder="Confirmer votre mail" id="mail2" name="mail2" value="<?php if (isset($mail2)) {
                                                                                                                            echo $mail2;
                                                                                                                        } ?>" />
                     
                                <label for="mdp"></label>
                      
                                <input type="password" placeholder="Entrez un mot de passe" id="mdp" name="mdp" />
                       
                                <label for="mdp2"></label>
                      
                                <input type="password" placeholder="Confirmer le mot de passe" id="mdp2" name="mdp2" />
                      
                                <br />
                                <input type="submit" class="btninscription" name="forminscription" value="Je m'inscris" />
                     
                </form>

            </div>
        </div>
        <div class="background2"></div>
    </div>
</body>

</html>