<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';

//Récupération de la recette  grace à l'id transmis dans le GET
//ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement

$id_categorie = isset($_GET['id_categorie'])?$_GET['id_categorie']:null;




//Construction de la requête
$sql = "SELECT * FROM " . PREFIXE_TABLE . "categorie C WHERE C.id=:id_categorie";

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->execute(array(':id_categorie' => $id_categorie));
$categorie = $pdoStatement->fetch(PDO::FETCH_ASSOC);


$template = $twig->load('categorie.html.twig');
 echo $template->render(array(
        'categorie' => $categorie,
    ));