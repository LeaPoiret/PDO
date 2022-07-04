<?php
require "db.php";
$db = ConnexionBase();
session_start();

if(isset($_GET['membre_id']) AND $_GET['membre_id'] > 0)
{
$getid = intval($_GET['membre_id']);
$requser = $db->prepare('SELECT * FROM membres WHERE membre_id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div align="center">
        <h2>Profil de <?php echo $userinfo ['membre_pseudo']; ?></h2>
        <br /><br />
    Pseudo = <?php echo $userinfo ['membre_pseudo']; ?>
    <br />
    Mail = <?php echo $userinfo ['membre_mail']; ?>
    <br />
   <?php
   if(isset($_SESSION['membre_id']) AND $userinfo['membre_id'] == $_SESSION['membre_id'])
   {
    ?>
    <br />
<a href="#">Editer mon profil</a>
    <?php
   }
   ?>
    </div>
</body>
</html> 
