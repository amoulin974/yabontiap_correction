<?php
try{
    $pdo = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME , DB_USER, DB_PASS);
}catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ".$e->getMessage();
    die();
}