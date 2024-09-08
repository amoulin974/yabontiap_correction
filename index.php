<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';
$pdo = Bd::getInstance()->getConnexion();

//recupération des catégories
$managerCategorie = new CategorieDao($pdo);
$tableau = $managerCategorie->findAllAssoc();
$categories = $managerCategorie->hydrateAll($tableau);

//Choix du template
$template = $twig->load('index.html.twig');


//Affichage de la page
echo $template->render(array(
    'categories' => $categories,
    'menu' => 'categories',
    // 'description' => "Le site des recettes de cuisine de l'IUT de Bayonne"
));
