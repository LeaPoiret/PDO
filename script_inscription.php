<?php
require "db.php";
$db = ConnexionBase();
session_start();

if (isset($_POST['forminscription'])) {
    $pseudo = htmlspecialchars(($_POST['pseudo']));
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    /*/////////////////////////////////////problème pseudo!!!!/////////////////////////////////////////////////////////////////////////////////////////////*/
    if (!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2'])) {
        $pseudolength = strlen($pseudo);
        if ($pseudolength <= 255) {
            $reqpseudo = $db->prepare("SELECT * FROM membres WHERE membre_pseudo = ?");
            $reqpseudo->execute(array($pseudo));
            $pseudoexist = $reqpseudo->rowCount();
            if ($pseudoexist == 0) {
            } else {
                $erreur = "Pseudo déjà utilisée !";
            }
            if ($mail == $mail2) {
                if (filter_var($mail,    FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $db->prepare("SELECT * FROM membres WHERE membre_mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) {
                        if ($mdp == $mdp2) {
                            $insertmbr = $db->prepare("INSERT INTO membres(membre_pseudo, membre_mail,membre_pass) VALUES(?,?,?)");
                            $insertmbr->execute(array($pseudo, $mail, $mdp));
                            $erreur = "Votre compte à bien été créé !" ?> <a href="connexion_form.php"> Me connecter</a>";
<?php
                            header('location: discs.php');
                        } 
                        else 
                        {
                            header('Location:inscription_form.php?login_err=mdpfail');
                        }
                    } 
                    else
                    {
                        header('Location:inscription_form.php?login_err=mailutilise');
                    }
                } 
                else 
                {
                    header('Location:inscription_form.php?login_err=mailfail');
                }
            } 
            else 
            {
                header('Location:inscription_form.php?login_err=mailfail2');
            }
        } 
        else 
        {
            header('Location:inscription_form.php?login_err=pseudofail');
        }
    } 
    else 
    {
        header('Location:inscription_form.php?login_err=champsvides');
    }


    }



?>