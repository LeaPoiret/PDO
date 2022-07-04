<?php
require "db.php";
$db = ConnexionBase();
session_start();

if(isset($_POST['formconnexion']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if(!empty($mailconnect) AND !empty($mdpconnect))
    {
      $requser = $db->prepare("SELECT * FROM membres WHERE membre_mail = ? AND membre_pass = ?");
      $requser -> execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1)
      {
        $userinfo = $requser->fetch();
        $_SESSION['membre_id'] = $userinfo['membre_id'];
        $_SESSION['membre_pseudo'] = $userinfo['membre_pseudo'];
        $_SESSION['membre_mail'] = $userinfo['membre_mail'];
        header("Location: discs.php");

      }
      else
      {
            header('Location:connexion_form.php?login_err=notcreate');
      }
    }
    else
     {
        header('Location:connexion_form.php?login_err=vide');

}
}
else{
  header('Location:connexion_form.php?login_err=already');
}
?>

