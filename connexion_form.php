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
            case 'notcreate':
    ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Votre compte n'existe pas, inscrivez-vous :)
                </div>
            <?php
                break;

            case 'vide':
            ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Complétez les champs :D
                </div>
            <?php
                break;

            case 'already':
            ?>
                <div class='alert alert-danger'>
                    <strong>Erreur</strong> Votre mot de passe ou email n'est pas valide !
                </div>
    <?php
                break;
        }
    }
    ?>
    <div class="boxcomplete">
        <div class="box">
            <h2>Connexion</h2>

            <br /><br />
            <form method="POST" action="script_connexion.php">
                <input type="email" class="inputconnect" name="mailconnect" placeholder="Mail">
                <input type="password" class="inputconnect" name="mdpconnect" placeholder="Mot de passe">
                
                    <input class="btn btn-dark" type="submit" name="formconnexion" value="Se Connecter">
                    <a href="inscription_form.php" class="btn btn-dark"> Inscription</a>
                
            </form>
        </div>


        <div class="background"></div>
    </div>
</body>

</html>