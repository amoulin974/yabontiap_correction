<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';



//Récupération de la recette  grace à l'id transmis dans le GET
//ATTENTION Cette méthode de travail n'est pas sécurisée. LA bonne méthode sera abordée ultérieurement
$id_recette = isset($_GET['id_recette'])?$_GET['id_recette']:null;

//Connexion à la base de données
$pdo= Bd::getInstance()->getConnexion();

//Recupere les recettes à l'aide de la méthode findWithDetail() de RecetteDao
$managerRecette = new RecetteDao($pdo);
$recette = $managerRecette->findWithDetail($id_recette);

//Génération de la vue
$template = $twig->load('recette.html.twig');

echo $template->render(array(
    'recette' => $recette,
    'menu' => 'recettes'
));

