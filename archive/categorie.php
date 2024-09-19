<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';

//Récupération de la recette  grace à l'id transmis dans le GET
//ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement

$id_categorie = isset($_GET['id_categorie'])?$_GET['id_categorie']:null;

//connexion à la base de données
$pdo= Bd::getInstance()->getConnexion();
 

//Récupération de la catégorie
$managerCategorie = new CategorieDao($pdo);
$categorie = $managerCategorie->find($id_categorie);


$template = $twig->load('categorie.html.twig');
 echo $template->render(array(
        'categorie' => $categorie,
    ));