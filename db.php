<?php

use PhpParser\Node\Expr\Cast\Object_;

define('URL','mysql:host=localhost;charset=utf8;dbname=record');
define('USER','lea');
define('PASS','Alba01Chuck2007');

    function ConnexionBase() {
        try
        {
            $connexion = new PDO(URL, USER, PASS);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connexion;

        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage() . "<br>";
            echo "N° : " . $e->getCode();
            die("Fin du script");
        }
    }
?>