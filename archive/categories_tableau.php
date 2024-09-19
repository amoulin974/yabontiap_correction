<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';


//Connexion à la base de données
$pdo = Bd::getInstance()->getConnexion();

 
//recuperation de toutes les categories
$managerCategorie = new CategorieDao($pdo);
$categories = $managerCategorie->findAll();


//Génération de la vue
 $template = $twig->load('categories_tableau.html.twig');
 echo $template->render(array(
        'categories' => $categories,
        'menu' => 'categories_tableau'
    ));